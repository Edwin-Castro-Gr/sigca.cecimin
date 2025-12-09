<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdffpdf extends FPDF {
        var $tipo = "1";
        var $hoja;
        var $logo;
        var $dane;
        var $reso;

        private $tempFiles = [];
        
        function __construct() {
            parent::__construct();
        }

        // El encabezado del PDF
        public function Header() {
            $ci = & get_instance();
            
            $this->Image('assets/image/informe-sigca.png',0,0,$this->GetPageWidth(),$this->GetPageHeight()); 
            //$this->Image('assets/image/logo-cecimin.png',150,5,20,0,'PNG');
        }

        // Page footer
        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','IB',8);
            $this->SetTextColor(255,255,255);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'R');
        }

        /**
            * Procesa HTML con imágenes base64
        */
        public function processHtml($html) {
            // Dividir el HTML en segmentos antes y después de las imágenes
            $parts = preg_split('/(<img[^>]+>)/i', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
            
            foreach ($parts as $part) {
                if (strpos($part, '<img') === 0) {
                    // Procesar imagen
                    $this->processImageTag($part);
                } else {
                    // Procesar texto
                    $this->processText($part);
                }
            }
        }
        
        /**
         * Procesa etiquetas de imagen
         */
        private function processImageTag($imgTag) {
            // Extraer atributos de la imagen
            preg_match('/src="([^"]*)"/i', $imgTag, $srcMatch);
            preg_match('/style="[^"]*width:\s*([^%;"]+)/i', $imgTag, $widthMatch);
            
            $base64Data = $srcMatch[1] ?? '';
            $width = isset($widthMatch[1]) ? $this->convertToMm($widthMatch[1]) : 0;
            
            if (strpos($base64Data, 'data:image') === 0) {
                $this->addBase64Image($base64Data, $width);
            }
        }
        
        /**
         * Convierte unidades de ancho a mm
         */
        private function convertToMm($value) {
            if (strpos($value, 'px') !== false) {
                return floatval($value) * 0.264583; // px to mm
            } elseif (strpos($value, '%') !== false) {
                $percent = floatval($value) / 100;
                return ($this->w - $this->lMargin - $this->rMargin) * $percent;
            }
            return floatval($value);
        }
        
        /**
         * Agrega imagen base64 al PDF
         */
        private function addBase64Image($base64Data, $width = 0) {
            try {
                // Separar el encabezado de los datos
                list($meta, $data) = explode(',', $base64Data, 2);
                
                // Obtener tipo de imagen
                $type = str_replace('data:image/', '', strstr($meta, ';', true));
                
                // Decodificar y guardar temporalmente
                $tempFile = tempnam(sys_get_temp_dir(), 'img') . '.' . $type;
                file_put_contents($tempFile, base64_decode($data));
                $this->tempFiles[] = $tempFile;
                
                // Calcular posición X para centrar si es necesario
                $x = $this->lMargin;
                if ($width > 0 && $width < ($this->w - $this->lMargin - $this->rMargin)) {
                    $x = ($this->w - $width) / 2;
                }
                
                // Agregar imagen al PDF
                $this->Image($tempFile, $x, null, $width);
                $this->Ln(10); // Espacio después de la imagen
            } catch (Exception $e) {
                log_message('error', 'Error al procesar imagen: ' . $e->getMessage());
            }
        }
        
        /**
         * Procesa texto HTML
         */
        private function processText($text) {
            // Limpiar y formatear texto
            $text = strip_tags($text);
            $text = html_entity_decode($text);
            $text = str_replace('&nbsp;', ' ', $text);
            $text = trim($text);
            
            if (!empty($text)) {
                $this->MultiCell(0, 6, $text);
                $this->Ln(5); // Espacio entre párrafos
            }
        }
    }
/* application/libraries/Pdf.php */
