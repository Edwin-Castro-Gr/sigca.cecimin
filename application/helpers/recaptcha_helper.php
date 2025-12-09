<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Helper para manejar reCAPTCHA
 */

/**
 * Genera el código HTML para el widget de reCAPTCHA
 */
// function render_recaptcha() {
//     $CI =& get_instance();
//     $siteKey = $CI->config->item('recaptcha_site_key');
//     return '<div class="g-recaptcha" data-sitekey="' . $siteKey . '"></div>';
// }

/**
 * Valida la respuesta de reCAPTCHA
 */
if (!function_exists('validate_recaptcha')) {
    function validate_recaptcha($secret_key, $token) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secret_key,
            'response' => $token
        ];

        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }
}