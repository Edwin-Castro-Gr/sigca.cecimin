<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Helper que carga todas las listas desplegables segun el perfil
 **/
function cellWithImage($pdf, $imagePath, $cellWidth, $cellHeight, $x, $y, $imageWidth = 0, $border = 0) {
    if ($border) {
        $pdf->Rect($x, $y, $cellWidth, $cellHeight);
    }
    
    // Calcular dimensiones manteniendo proporciones si no se especifica ancho
    if ($imageWidth == 0) {
        list($origWidth, $origHeight) = getimagesize($imagePath);
        $imageWidth = $cellWidth * 0.8; // 80% del ancho del cell
        $imageHeight = $origHeight * ($imageWidth / $origWidth);
    } else {
        $imageHeight = 0; // Se calculará automáticamente
    }
    
    // Centrar la imagen en el cell
    $imageX = $x + ($cellWidth - $imageWidth) / 2;
    $imageY = $y + ($cellHeight - $imageHeight) / 2;
    
    $pdf->Image($imagePath, $imageX, $imageY, $imageWidth);
    
    // Devolver la posición Y después del cell
    return $y + $cellHeight;
}
