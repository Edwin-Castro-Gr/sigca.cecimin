
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SecurityHeaders
{
    public function add()
    {
        $CI =& get_instance();

        // Sólo aplica HSTS si el request es HTTPS
        $isHttps = (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        );

        // ---- Cabeceras base (hardening) ----
        if ($isHttps) {
            header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
        }

        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: SAMEORIGIN");
        header("Referrer-Policy: no-referrer-when-downgrade");

        // Permissions-Policy (ex-Feature-Policy): deshabilita por defecto
        header("Permissions-Policy: camera=(), microphone=(), geolocation=()");

        // ---- Content-Security-Policy (CSP) ----
        // Ajusta esta política a tus recursos reales:
        // - Si usas jQuery/Bootstrap desde CDN, inclúyelos explícitamente.
        // - Si usas reCAPTCHA v3, añade sus dominios.
        // - Si generas QR desde api.qrserver.com, habilita img-src https:.

        $csp = [
            "default-src 'self'",
            "img-src 'self' data: https:",
            "font-src 'self' https:",
            // Evita 'unsafe-inline' idealmente; si hoy lo necesitas por estilos inline, mantenlo temporalmente.
            "style-src 'self' 'unsafe-inline' https:",
            "script-src 'self' 'unsafe-inline' https:",
            "connect-src 'self' https:",
            "frame-ancestors 'self'" // protege contra embedding por terceros
        ];

        // Si utilizas Google reCAPTCHA v3:
        // - scripts: https://www.google.com/recaptcha/, https://www.gstatic.com/recaptcha/
        // - frames: https://www.google.com/
        // - connect: https://www.google.com/
        // Añádelo así:
        $usesRecaptcha = true; // cámbialo si no aplicara
        if ($usesRecaptcha) {
            $csp[] = "script-src 'self' 'unsafe-inline' https://www.google.com/recaptcha/ https://www.gstatic.com/recaptcha/";
            $csp[] = "frame-src 'self' https://www.google.com/"; // CI3 usa frame-src para iframes; en CSPv3 usa child-src/frame-src
            $csp[] = "connect-src 'self' https://www.google.com/";
        }

        // Si usas QR desde api.qrserver.com (como en Twofa/setup):
        $usesQrServer = true;
        if ($usesQrServer) {
            $csp[] = "img-src 'self' data: https: https://api.qrserver.com";
        }

        // Si cargas jQuery/Bootstrap desde CDN (ejemplos; ajusta a los que realmente uses):
        $usesCDN = false; // pon true y añade tus CDNs
        if ($usesCDN) {
            $csp[] = "script-src 'self' 'unsafe-inline' https://code.jquery.com https://cdn.jsdelivr.net";
            $csp[] = "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://stackpath.bootstrapcdn.com";
            $csp[] = "font-src 'self' https://fonts.gstatic.com";
            $csp[] = "img-src 'self' data: https: https://cdn.jsdelivr.net https://stackpath.bootstrapcdn.com";
        }

        // Une y envía la CSP final
        $cspHeader = "Content-Security-Policy: " . implode("; ", array_unique($csp));
        header($cspHeader);

        // Sincroniza con el Output de CI si ya existe (opcional)
        if (isset($CI->output)) {
            if ($isHttps) $CI->output->set_header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
            $CI->output->set_header("X-Content-Type-Options: nosniff");
            $CI->output->set_header("X-Frame-Options: SAMEORIGIN");
            $CI->output->set_header("Referrer-Policy: no-referrer-when-downgrade");
            $CI->output->set_header("Permissions-Policy: camera=(), microphone=(), geolocation=()");
            $CI->output->set_header($cspHeader);
        }
    }
}
