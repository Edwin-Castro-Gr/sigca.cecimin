
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twofa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->load->library(['session','totp']);
        $this->load->model('general_model');
    }

    public function setup() {
        // requiere login
        $id = $this->session->userdata('C_id_usuario');
        if (!$id) { redirect('login'); }

        $user = $this->general_model->get_user_by_id($id);
        if (intval($user->is_2fa_enabled) === 1) {
            $this->session->set_flashdata('msg', '2FA ya está activo.');
            redirect('/home/index');
        }

        $secret = $this->totp->generateSecret();
        $this->session->set_tempdata('totp_secret_pending', $secret, 600); // 10 min
        $issuer = 'SIGCA';
        $label  = $user->usuario; // o email si lo tienes
        $otpauth = $this->totp->provisioningUri($secret, $label, $issuer);

        // Genera QR con un servicio o librería local; por simplicidad usamos api.qrserver
        $data['qr_src'] = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' . urlencode($otpauth);
        $data['secret'] = $secret;
        $this->load->view('login/twofa_setup', $data);
    }

    public function confirm() {
        $id = $this->session->userdata('C_id_usuario');
        if (!$id) { redirect('login'); }

        $code   = $this->input->post('code', TRUE);
        $secret = $this->session->tempdata('totp_secret_pending');
        if (!$secret) {
            $this->session->set_flashdata('msg', 'Sesión expirada. Genera nuevamente el QR.');
            redirect('twofa/setup');
        }

        if ($this->totp->verify($secret, $code, 1)) {
            // Generar 8 códigos de respaldo (planos mostrados una vez; guardar hashes)
            $plain = [];
            $hashes = [];
            for ($i=0; $i<8; $i++) {
                $p = bin2hex(random_bytes(4)); // ej. "9a7c3f12"
                $plain[] = $p;
                $hashes[] = password_hash($p, PASSWORD_DEFAULT);
            }
            $this->general_model->enable_2fa($id, $secret, implode("\n", $hashes));
            $this->session->unset_tempdata('totp_secret_pending');

            $this->session->set_flashdata('backup_codes_plain', implode("\n", $plain));
            $this->session->set_flashdata('msg', '2FA activado. Guarda tus códigos de respaldo.');
            redirect('/home/index'); // o a una vista que muestre los códigos
        } else {
            $this->session->set_flashdata('msg', 'Código inválido.');
            redirect('twofa/setup');
        }
    }
}
