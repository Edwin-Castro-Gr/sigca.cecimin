
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * TOTP library (RFC 6238) - SHA1, 30s, 6 digits
 * Uso:
 *   $this->load->library('totp');
 *   $secret = $this->totp->generateSecret();              // para activar
 *   $uri    = $this->totp->provisioningUri($secret, $label, $issuer);
 *   $ok     = $this->totp->verify($secret, $code, 1);     // window=1 (±30s)
 */
class Totp {

    private $period = 30;    // seconds
    private $digits = 6;
    private $algo   = 'sha1';

    public function generateSecret($length = 20) {
        // genera bytes aleatorios y codifica en Base32
        $bytes = random_bytes($length);
        return $this->base32_encode($bytes);
    }

    public function provisioningUri($secret, $label, $issuer) {
        $label_enc  = rawurlencode($issuer . ':' . $label);
        $issuer_enc = rawurlencode($issuer);
        $params = http_build_query([
            'secret'    => $secret,
            'issuer'    => $issuer,
            'algorithm' => strtoupper($this->algo),
            'digits'    => $this->digits,
            'period'    => $this->period
        ]);
        return "otpauth://totp/{$label_enc}?{$params}";
    }

    public function verify($secret, $code, $window = 1) {
        $code = trim($code);
        if (!ctype_digit($code) || strlen($code) !== $this->digits) return false;

        $timeCounter = floor(time() / $this->period);
        for ($i = -$window; $i <= $window; $i++) {
            if ($this->totp_code($secret, $timeCounter + $i) === $code) {
                return true;
            }
        }
        return false;
    }

    private function totp_code($secret, $counter) {
        $key  = $this->base32_decode($secret);
        $binCounter = pack('N*', 0) . pack('N*', $counter);
        $hash = hash_hmac($this->algo, $binCounter, $key, true);
        $offset = ord($hash[19]) & 0x0F;
        $truncatedHash = (
            ((ord($hash[$offset])     & 0x7F) << 24) |
            ((ord($hash[$offset + 1]) & 0xFF) << 16) |
            ((ord($hash[$offset + 2]) & 0xFF) << 8)  |
            (ord($hash[$offset + 3])  & 0xFF)
        );
        $code = $truncatedHash % (10 ** $this->digits);
        return str_pad((string)$code, $this->digits, '0', STR_PAD_LEFT);
    }

    // ---------------- Base32 helpers ----------------

    private function base32_decode($b32) {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $b32 = strtoupper($b32);
        $buffer = 0;
        $bitsLeft = 0;
        $output = '';

        foreach (str_split($b32) as $c) {
            if ($c === '=') break;
            $val = strpos($alphabet, $c);
            if ($val === false) continue;
            $buffer = ($buffer << 5) | $val;
            $bitsLeft += 5;
            if ($bitsLeft >= 8) {
                $bitsLeft -= 8;
                $output .= chr(($buffer >> $bitsLeft) & 0xFF);
            }
        }
        return $output;
    }

    private function base32_encode($data) {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $buffer = 0;
        $bitsLeft = 0;
        $out = '';

        foreach (str_split($data) as $c) {
            $buffer = ($buffer << 8) | ord($c);
            $bitsLeft += 8;
            while ($bitsLeft >= 5) {
                $bitsLeft -= 5;
                $out .= $alphabet[($buffer >> $bitsLeft) & 0x1F];
            }
        }
        if ($bitsLeft > 0) {
            $out .= $alphabet[($buffer << (5 - $bitsLeft)) & 0x1F];
        }
        return $out;
    }
}
