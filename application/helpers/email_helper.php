<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('enviar_correo')) {
    /**
     * Envía un correo electrónico utilizando un buzón específico para cada módulo, con opción de adjuntar archivos.
     *
     * @param string $para Dirección de correo del destinatario.
     * @param string $asunto Asunto del correo.
     * @param string $mensaje Contenido del correo.
     * @param string $remitente Módulo que envía el correo (por ejemplo: 'citas', 'ingreso').
     * @param string $correo_remitente Correo electrónico del remitente.
     * @param array|null $adjuntos Lista de rutas de los archivos a adjuntar (opcional).
     * @return bool TRUE si el correo se envió correctamente, FALSE en caso contrario.
     */
    function enviar_correo($para, $asunto, $mensaje, $remitente, $correo_remitente, $adjuntos = NULL, $correo_cc = NULL) {
        $CI =& get_instance();
        $CI->load->library('email');


        // Validar el correo
        if (!filter_var($para, FILTER_VALIDATE_EMAIL)) {
            log_message('error', "Correo inválido: $para");
            return FALSE;
        }

        // Configuración de buzones para cada módulo
        $buzones = [
            'citas' => [
                'smtp_user' => 'citasmedicamentos@ceciminsigca.com',
                'smtp_pass' => 'C1t4s-C3c1m1n@2025',
            ],
            'cirugias' => [
                'smtp_user' => 'cirugia@ceciminsigca.com',
                'smtp_pass' => 'C1rug14s-C3c1m1n@2025',
            ],
            'usuarios' => [
                'smtp_user' => 'admin@ceciminsigca.com',
                'smtp_pass' => '4dm1n-C3c1m1n@2025',
            ],
            'observaciones' => [
                'smtp_user' => 'admin@ceciminsigca.com',
                'smtp_pass' => '4dm1n-C3c1m1n@2025',
            ],            
            'contactenos' => [
                'smtp_user' => 'contactenos@ceciminsigca.com',
                'smtp_pass' => 'C3c1m1n@2025',
            ],
            'ingreso' => [
                'smtp_user' => 'admin@ceciminsigca.com',
                'smtp_pass' => '4dm1n-C3c1m1n@2025',
            ],
            'Resultados_Dx' => [
                'smtp_user' => 'admin@ceciminsigca.com',
                'smtp_pass' => '4dm1n-C3c1m1n@2025',
            ],

            'notificacion' => [
                'smtp_user' => 'admin@ceciminsigca.com',
                'smtp_pass' => '4dm1n-C3c1m1n@2025',
            ],
        ];

        // Configuración común para todos los buzones
        $config_comun = [
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.hostinger.com',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE,
            'newline'   => "\r\n",
            'smtp_crypto' => 'ssl',
        ];

        // Seleccionar la configuración del módulo
        if (!isset($buzones[$remitente])) {
            log_message('error', "Remitente no configurado: $remitente");
            return FALSE;
        }

        $config = array_merge($config_comun, $buzones[$remitente]);

        // Configurar la biblioteca de correos
        $CI->email->initialize($config);

        $CI->email->from($config['smtp_user'], ucfirst($correo_remitente));
        
        if($correo_cc != null){
            
          $CI->email->cc($correo_cc); // Correo copiado a 
        
        }
              
        $CI->email->to($para);
        $CI->email->subject($asunto);
        $CI->email->message($mensaje);

        // Adjuntar archivos si se proporcionan
        if (!empty($adjuntos) && is_array($adjuntos)) {
            foreach ($adjuntos as $archivo) {
                if (file_exists($archivo)) {
                    $CI->email->attach($archivo);
                } else {
                    log_message('error', "Archivo no encontrado: $archivo");
                }
            }
        }

        // Intentar enviar el correo
        if ($CI->email->send()) {
            return TRUE;
        } else {
            $error = log_message('error', $CI->email->print_debugger());
            show_error($CI->email->print_debugger());
            return  $error;
        }
    }
}