<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/third_party/fpdf/fpdf.php";

class AdvancedHtmlToPdf extends FPDF {
    private $tempFiles = [];
    private $listIndent = 8; // Sangría para listas en mm
    private $currentListLevel = 0;
    
    // Agrega al inicio de la clase
    private $bulletChar = '• '; // Definimos el carácter de viñeta directamente en UTF-8

    public function __construct() {
        parent::__construct('P', 'mm', 'A4');
        $this->SetAutoPageBreak(true, 15);
        $this->SetMargins(15, 15, 15);
    }
    
    public function __destruct() {
        foreach ($this->tempFiles as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        }
    }
 
    private function corregirCaracteres($texto) {
        $sustituciones = [            
            'â€¢' => '•',
            'Â' => '',
            // Agrega más sustituciones según necesites
        ];
        return str_replace(array_keys($sustituciones), array_values($sustituciones), $texto);
    }

    // Y usarlo en limpiarTexto:

    public function procesarContenidoCompleto($html) {
        // Procesar listas primero (requiere manejo especial)
        $html = $this->preprocesarListas($html);
        
        // Dividir contenido por imágenes
        $partes = preg_split('/(<img[^>]+>)/i', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        
        foreach ($partes as $parte) {
            if (strpos($parte, '<img') === 0) {
                $this->procesarImagen($parte);
            } else {
                $this->procesarTextoConListas($parte);
            }
        }
    }
    
    private function preprocesarListas($html) {
        // Convertir listas a un formato más manejable
        $html = preg_replace_callback('/<(ul|ol)[^>]*>(.*?)<\/\1>/si', function($matches) {
            $items = preg_replace_callback('/<li[^>]*>(.*?)<\/li>/si', function($itemMatches) {
                return "[[LISTITEM]]" . $itemMatches[1] . "[[ENDLISTITEM]]";
            }, $matches[2]);
            
            return "[[LISTSTART:".$matches[1]."]]" . $items . "[[LISTEND]]";
        }, $html);
        
        return $html;
    }
    
    private function procesarTextoConListas($texto) {
        // Procesar bloques de lista primero
        $texto = preg_replace_callback(
            '/\[\[LISTSTART:(ul|ol)\]\](.*?)\[\[LISTEND\]\]/si',
            function($matches) {
                $this->procesarListaCompleta($matches[1], $matches[2]);
                return '';
            },
            utf8_decode($texto)
        );
        
        // Procesar el resto del texto normal
        $this->procesarTextoSimple(utf8_decode($texto));
    }
    
    private function procesarListaCompleta($tipoLista, $contenido) {
        $this->currentListLevel++;
        $items = explode('[[LISTITEM]]', $contenido);
        
        foreach ($items as $item) {
            if (empty(trim($item))) continue;
            
            $item = str_replace('[[ENDLISTITEM]]', '', $item);
            $item = $this->limpiarTexto($item);
            
            // Sangría
            $this->Cell($this->listIndent * $this->currentListLevel);
            
            // Viñeta o número
            if ($tipoLista === 'ul') {
                $this->Cell(5, 5, $this->bulletChar, 0, 0, 'L');
            } else {
                static $itemNumber = 1;
                $this->Cell(5, 5, $itemNumber++.'.', 0, 0, 'L');
                if ($itemNumber > count($items)) $itemNumber = 1;
            }
            
            // Procesar texto
            $x = $this->GetX() + 2;
            $y = $this->GetY();
            
            $this->MultiCell(
                0, 
                5, 
                $item,
                0,
                'L',
                false,
                1,
                $x,
                $y
            );
            
            $this->Ln(4);
        }
        
        $this->currentListLevel--;
        $this->Ln(8);
    }

    
    private function procesarTextoSimple($texto) {
        $texto = $this->limpiarTexto($texto);
        if (!empty(trim($texto))) {
            $this->MultiCell(0, 6, $texto);
            $this->Ln(4);
        }
    }
    
    private function limpiarTexto($texto) {
        // Convertir entidades HTML a caracteres UTF-8
        $texto = html_entity_decode($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        
        // Reemplazar espacios no separables
        $texto = str_replace(['&nbsp;', "\xc2\xa0"], ' ', $texto);
        
        // Eliminar etiquetas HTML
        $texto = strip_tags($texto);
        
        // Normalizar espacios y saltos de línea
        $texto = preg_replace('/\s+/', ' ', $texto);
        $texto = str_replace(["\r\n", "\n", "\t"], ' ', $texto);
        
        return trim($texto);
    }

    private function procesarImagen($imgTag) {
        preg_match('/src="([^"]*)"/i', $imgTag, $matches);
        $src = $matches[1] ?? '';
        
        if (strpos($src, 'data:image') === 0) {
            $this->insertarImagenBase64($src);
        }
    }
    
    private function insertarImagenBase64($base64) {
        try {
            list($meta, $datos) = explode(',', $base64);
            $tipo = str_replace(['data:image/', ';base64'], '', $meta);
            $binario = base64_decode($datos);
            
            $tempFile = tempnam(sys_get_temp_dir(), 'img') . '.' . $tipo;
            file_put_contents($tempFile, $binario);
            $this->tempFiles[] = $tempFile;
            
            // Obtener dimensiones
            list($ancho, $alto) = getimagesize($tempFile);
            $ratio = $ancho / $alto;
            
            // Ancho máximo (150mm o el ancho disponible)
            $anchoMax = min(150, $this->w - $this->lMargin - $this->rMargin);
            $altoCalculado = $anchoMax / $ratio;
            
            // Centrar imagen
            $x = ($this->w - $anchoMax) / 2;
            
            $this->Image(
                $tempFile,
                $x,
                null,
                $anchoMax,
                $altoCalculado,
                strtoupper($tipo)
            );
            $this->Ln(10);
        } catch (Exception $e) {
            log_message('error', 'Error al procesar imagen: ' . $e->getMessage());
        }
    }

        // Método para calcular número de líneas que ocupará un texto
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