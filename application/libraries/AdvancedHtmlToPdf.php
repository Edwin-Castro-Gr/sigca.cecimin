<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/fpdf/fpdf.php";

class AdvancedHtmlToPdf extends FPDF {
    private $tempFiles = [];
    private $listIndent = 8;
    private $currentListLevel = 0;
    private $bulletChar = '*';
    private $tableData = [];
    private $tableConfig = [];

    public function __construct() {
        parent::__construct('P', 'mm', 'A4');
        $this->SetAutoPageBreak(true, 15);
        $this->SetMargins(15, 15, 15);
        $this->AliasNbPages(); // Necesario para el total de páginas
    }

    public function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-20);
        
        // Configurar fuente
        $this->SetFont('helvetica', 'I', 8);
        
        // Color del texto en gris
        $this->SetTextColor(128);
        
        // Número de página centrado
        //$this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().' de {nb}', 0, 0, 'R');
        
        // Opcional: línea superior
        $this->Line($this->lMargin, $this->GetY() + 10, 
                   $this->w - $this->rMargin, $this->GetY() + 10);
    }
    
    public function __destruct() {
        foreach ($this->tempFiles as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        }
    }
   
    public function procesarContenidoCompleto($html) {
         // Convertir entidades HTML a caracteres reales
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Eliminar espacios no separables
        $html = str_replace(['&nbsp;', '&#160;'], '', $html);

        // Eliminar espacios no separables
        $html = str_replace(['<p><img'], '<img', $html);

        // Eliminar espacios no separables
        $html = str_replace(['<br></p>'], ' ', $html);

        // Normalizar saltos de línea
        $html = str_replace(["\r\n", "\r"], "\n", $html);
        
        // Procesar por bloques manteniendo el orden original
        $patron = '/(<p[^>]*>.*?<\/p>|<ul[^>]*>.*?<\/ul>|<ol[^>]*>.*?<\/ol>|<img[^>]+>|<table[^>]*>.*?<\/table>)/si';
        $bloques = preg_split($patron, $html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        
        foreach ($bloques as $bloque) {
            if (strpos($bloque, '<p') === 0) {
                $this->procesarParrafo($bloque);
            } elseif (strpos($bloque, '<ul') === 0) {
                $this->procesarLista($bloque, 'ul');
            } elseif (strpos($bloque, '<ol') === 0) {
                $this->procesarLista($bloque, 'ol');
            } elseif (strpos($bloque, '<img') === 0) {
                $this->procesarImagen($bloque);
            } elseif (strpos($bloque, '<table') === 0) {
                $this->procesarTabla($bloque);
            }
        }
    }
    
    private function procesarParrafo($html) {
        $texto = strip_tags($html);
        $texto = $this->corregirCaracteres($texto);
        $texto = trim($texto);
        
        if (!empty($texto)) {
            $this->MultiCell(0, 6, utf8_decode($texto));
            $this->Ln(4);
        }
    }
    
    private function procesarLista($html, $tipo) {
        $this->currentListLevel++;
        
        preg_match_all('/<li[^>]*>(.*?)<\/li>/si', $html, $items);
        
        foreach ($items[1] as $item) {
            $texto = $this->limpiarTextoLista($item);
            
            // Sangría
            $this->Cell($this->listIndent * $this->currentListLevel);
            
            // Viñeta o número
            if ($tipo === 'ul') {
                $this->Cell(5, 5, $this->bulletChar, 0, 0, 'L');
            } else {
                static $itemNumber = 1;
                $this->Cell(5, 5, $itemNumber++.'.', 0, 0, 'L');
            }
            
            // Procesar texto
            $x = $this->GetX() + 2;
            $y = $this->GetY();
            
            $this->MultiCell(0, 5, utf8_decode($texto), 0, 'L', false, 1, $x, $y);
            $this->Ln(4);
        }
        
        $this->currentListLevel--;
        $this->Ln(8);
    }
    
    private function limpiarTextoLista($texto) {
        $texto = strip_tags($texto);
        $texto = $this->corregirCaracteres($texto);
        $texto = preg_replace('/\s+/', ' ', $texto);
        $texto = preg_replace('/â€¢|&#8226;|&bull;/u', ' ', $texto);
        return trim($texto);
    }
    
    private function procesarImagen($imgTag) {
        error_log("Procesando imagen: " . $imgTag); // Log para depuración
    
        preg_match('/src="([^"]*)"/i', $imgTag, $matches);
        $src = $matches[1] ?? '';
        
        error_log("SRC encontrado: " . $src); // Log para depuración

        if (strpos($src, 'data:image') === 0) {
            error_log("Imagen base64 detectada"); // Log para depuración
            $this->insertarImagenBase64($src);

        } elseif (filter_var($src, FILTER_VALIDATE_URL)) {
            $this->insertarImagenRemota($src);
            error_log("Tipo de imagen no soportado: " . substr($src, 0, 50)); // Log para depuración
        }
    }
    
    private function procesarTabla($html) {
        preg_match_all('/<tr[^>]*>(.*?)<\/tr>/si', $html, $filas);
        
        foreach ($filas[1] as $fila) {
            preg_match_all('/<(td|th)[^>]*>(.*?)<\/\1>/si', $fila, $celdas);
            
            foreach ($celdas[2] as $celda) {
                $texto = strip_tags($celda);
                $texto = $this->corregirCaracteres($texto);

                $this->Cell(40, 6, utf8_decode($texto),1);
            }
            $this->Ln();
        }
        $this->Ln(10);
    }
    
    private function corregirCaracteres($texto) {
        $texto = mb_convert_encoding($texto, 'UTF-8', 'UTF-8');
        // Reemplazar viñetas problemáticas
        
        $sustituciones = [
            'â€¢' => '•',
            'â€“' => '-',
            'â€œ' => '"',
            'â€' => '"',
            'Â' => '',
            'Ã±' => 'ñ',
            'Ã¡' => 'á',
            'Ã©' => 'é',
            'Ã­' => 'í',
            'Ã³' => 'ó',
            'Ãº' => 'ú',
            'Ã±' => 'ñ',
            'Ã‘' => 'Ñ'
        ];
        return str_replace(array_keys($sustituciones), array_values($sustituciones), $texto);
    }
    
    private function insertarImagenBase64($base64) {
       try {
            // Validar que el string base64 tenga el formato correcto
            if (strpos($base64, 'data:image') !== 0) {
                throw new Exception('Formato de imagen base64 no válido');
            }

            // Separar metadatos y datos de la imagen
            list($meta, $datos) = explode(',', $base64, 2);
            
            // Extraer el tipo de imagen (png, jpeg, gif)
            preg_match('/data:image\/([a-z]+);base64/i', $meta, $matches);
            $tipo = isset($matches[1]) ? strtolower($matches[1]) : 'jpeg';
            
            // Validar tipos de imagen soportados
            $tiposSoportados = ['png', 'jpeg', 'jpg', 'gif'];
            if (!in_array($tipo, $tiposSoportados)) {
                throw new Exception("Tipo de imagen no soportado: $tipo");
            }

            // Decodificar la imagen
            $binario = base64_decode($datos);
            if ($binario === false) {
                throw new Exception('Error al decodificar imagen base64');
            }

            // Crear archivo temporal
            $tempFile = tempnam(sys_get_temp_dir(), 'img') . '.' . $tipo;
            if (file_put_contents($tempFile, $binario) === false) {
                throw new Exception('No se pudo crear el archivo temporal');
            }
            $this->tempFiles[] = $tempFile;

            // Obtener dimensiones de la imagen
            $dimensiones = @getimagesize($tempFile);
            if ($dimensiones === false) {
                throw new Exception('No se pudieron obtener las dimensiones de la imagen');
            }

            list($anchoOriginal, $altoOriginal) = $dimensiones;
            $ratio = $anchoOriginal / $altoOriginal;

            // Calcular tamaño máximo permitido (150mm o ancho disponible)
            $anchoMax = min(150, $this->w - $this->lMargin - $this->rMargin);
            $altoCalculado = $anchoMax / $ratio;

            // Si la altura calculada es mayor que la disponible en la página
            $altoDisponible = $this->h - $this->GetY() - $this->bMargin;
            if ($altoCalculado > $altoDisponible) {
                // Reducir proporcionalmente
                $factorReduccion = $altoDisponible / $altoCalculado;
                $anchoMax *= $factorReduccion;
                $altoCalculado = $anchoMax / $ratio;
            }

            // Centrar la imagen horizontalmente
            $x = ($this->w - $anchoMax) / 2;
            $y = $this->GetY();

            // Insertar la imagen
            $this->Image(
                $tempFile,
                $x,
                $y,
                $anchoMax,
                $altoCalculado,
                strtoupper($tipo)
            );

            // Mover el cursor después de la imagen
            $this->SetY($y + $altoCalculado + 5); // 5mm de espacio adicional
            $this->Ln(5);

        } catch (Exception $e) {
            // Registrar el error y mostrar un mensaje en el PDF
            error_log('Error al procesar imagen base64: ' . $e->getMessage());
            
            // Mostrar un marcador de posición en el PDF
            $this->SetFillColor(240, 240, 240);
            $this->Cell(0, 20, '[Imagen no disponible]', 1, 1, 'C', true);
            $this->Ln(5);
        }
    }    
    public function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if($w==0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb) {
            $c = $s[$i];
            if($c=="\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if($l>$wmax) {
                if($sep==-1) {
                    if($i==$j) {
                        $i++;
                    }
                } else {
                    $i = $sep+1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
    

}