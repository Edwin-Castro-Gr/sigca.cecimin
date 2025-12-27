<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    private $db_name = 'u610593899_sigca';
    private $encryption_key = '-Qsc.725943!';
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->load->helper(['recaptcha', 'security']);
        $this->load->library('session');
        $this->load->model('general_model');
    }
    
    public function index() {
        $this->session->sess_destroy();
        $this->setSecureSessionCookie();
        $this->load->view('login/index');
    }
    
    private function setSecureSessionCookie() {
        $cookie_name = 'session_cookie';
        $cookie_value = bin2hex(random_bytes(16));
        $cookie_expire = time() + 3600;
        
        setcookie(
            $cookie_name,
            $cookie_value,
            [
                'expires' => $cookie_expire,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            ]
        );
    }
    
    public function cambiar($id) {
        $data_usua['c_id_usuario'] = $id;    
        $this->load->view('login/cambiar_password', $data_usua);
    }
    
    public function reset($hash) {
        $this->initializeDatabase();
        
        $hash_details = $this->general_model->get_hash_details($hash);
        
        if (!$hash_details) {
            $this->showError('Token inválido o expirado');
            return;
        }
        
        $current_date = date('Y-m-d H:i:s');
        if ($current_date > $hash_details->hash_expiry) {
            $this->showError('El token ha expirado');
            return;
        }
        
        $data_usua['c_hash'] = $hash;
        $this->load->view('login/reset_password', $data_usua);
    }
    
    public function guardar_nuevaClave() {
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
            return;
        }
        
        $this->initializeDatabase();
        $hash = $this->input->post('hashrecov');
        $password = $this->input->post('password');
        
        $result = $this->general_model->update_password_by_hash($hash, $password, $this->encryption_key);
        
        $this->sendJsonResponse($result);
    }
    
    public function actualizar_clave() {
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
            return;
        }
        
        $this->initializeDatabase();
        $usuario = $this->input->post('idreg');
        $password = $this->input->post('password');
        
        $result = $this->general_model->update_user_password($usuario, $password, $this->encryption_key);
        
        $this->sendJsonResponse($result);
    }
    
    public function verificar() {
        if (!$this->input->is_ajax_request()) {
            redirect();
            return;
        }
        
        // Validar reCAPTCHA
        if (!$this->validateRecaptcha()) {
            echo "5=!";
            return;
        }
        
        $this->initializeDatabase();
        
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('contrasena');
        
        $user_data = $this->general_model->get_user_by_username($usuario);
        
        if (!$user_data) {
            echo "4=!";
            return;
        }
        
        $user = $user_data[0];
        
        if ($user->estado != "1") {
            echo "3=!";
            return;
        }
        
        if ($user->clave != $password) {
            echo "2=!";
            return;
        }
        
        if ($user->cambio_clave != '1') {
            echo "1=Debe Cambiar su Contraseña";
            return;
        }
        
        // Verificar si 2FA está habilitado
        if ($user->two_factor_enabled == 1) {
            // Generar y enviar código 2FA
            $verification_code = $this->generate2FACode();
            $this->session->set_tempdata('2fa_user_id', $user->id_usuario, 300);
            $this->session->set_tempdata('2fa_code', $verification_code, 300);
            
            // Enviar código por email
            $this->send2FACode($user->email, $verification_code);
            
            echo "6=" . $user->id_usuario; // Código para redirigir a verificación 2FA
            return;
        }
        
        // Si no tiene 2FA, continuar con login normal
        $this->createUserSession($user);
        echo "0=" . $user->nom_usuario . " " . $user->ape_usuario;
    }
    
    // NUEVO: Página para verificar código 2FA
    public function verify_2fa($user_id = null) {
        if ($user_id) {
            $data['user_id'] = $user_id;
            $this->load->view('login/verify_2fa', $data);
        } else {
            redirect('login');
        }
    }
    
    // NUEVO: Validar código 2FA
    public function validate_2fa_code() {
        if (!$this->input->is_ajax_request()) {
            redirect('login');
            return;
        }
        
        $user_id = $this->input->post('user_id');
        $code = $this->input->post('code');
        
        $stored_code = $this->session->tempdata('2fa_code');
        $stored_user_id = $this->session->tempdata('2fa_user_id');
        
        if ($stored_user_id != $user_id || $stored_code != $code) {
            echo json_encode(['success' => false, 'message' => 'Código inválido']);
            return;
        }
        
        // Código válido, obtener usuario y crear sesión
        $this->initializeDatabase();
        $user_data = $this->general_model->get_user_by_id($user_id);
        
        if ($user_data) {
            $user = $user_data[0];
            $this->createUserSession($user);
            $this->session->unset_tempdata('2fa_code');
            $this->session->unset_tempdata('2fa_user_id');
            
            echo json_encode(['success' => true, 'message' => 'Autenticación exitosa']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }
    }
    
    // NUEVO: Reenviar código 2FA
    public function resend_2fa_code() {
        if (!$this->input->is_ajax_request()) {
            redirect('login');
            return;
        }
        
        $user_id = $this->input->post('user_id');
        $verification_code = $this->generate2FACode();
        
        $this->session->set_tempdata('2fa_code', $verification_code, 300);
        
        // Obtener email del usuario
        $this->initializeDatabase();
        $user_email = $this->general_model->get_user_email($user_id);
        
        if ($user_email) {
            $this->send2FACode($user_email, $verification_code);
            echo json_encode(['success' => true, 'message' => 'Código reenviado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al reenviar código']);
        }
    }
    
    public function recuperar_password() {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
            return;
        }
        
        $this->initializeDatabase();
        
        $email = $this->input->post('email');
        
        if (empty($email)) {
            echo '4';
            return;
        }
        
        $user = $this->general_model->verify_email($email);
        
        if (!$user) {
            echo '3';
            return;
        }
        
        $hash_string = hash('sha256', time() . $user->id_usuario . $email);
        $hash_expiry = date('Y-m-d H:i:s', strtotime("30 minutes"));
        
        $data = [
            'hash_key' => $hash_string,
            'hash_expiry' => $hash_expiry
        ];
        
        $reset_link = base_url() . 'login/reset?hash=' . $hash_string;
        $message = "Para recuperar la contraseña:\n <a href='" . $reset_link . "'>haga click aquí</a>";
        $subject = "Recuperar contraseña";
        
        if ($this->sendEmail($email, $subject, $message)) {
            $this->general_model->update('usuarios', 'email', $email, $data);
            echo '1';
        } else {
            echo '2';
        }
    }
    
    private function initializeDatabase() {
        $datos_session2 = ['C_basedatos' => $this->db_name];
        $this->session->set_userdata($datos_session2);
        $this->load->database();
        $this->db->query('USE ' . $this->session->userdata('C_basedatos') . ';');
    }
    
    private function validateRecaptcha() {
        $this->load->helper('recaptcha');
        $token = $this->input->post('recaptchaToken');
        $secret_key = $this->config->item('recaptcha_secret_key');
        $recaptcha_response = validate_recaptcha($secret_key, $token);
        
        return $recaptcha_response["success"] && 
               $recaptcha_response["action"] == 'login' && 
               $recaptcha_response["score"] > '0.6';
    }
    
    private function createUserSession($user) {
        $perfil_names = [
            '0' => 'Administrador',
            '1' => 'Gerencia',
            '2' => 'Coordinadores',
            '3' => 'Cirujanos',
            '4' => 'Costos/contratos',
            '5' => 'Asistenciales',
            '6' => 'Cirugia',
            '7' => 'Auditoria',
            '8' => 'Instrumentadoras'
        ];
        
        $tipo = $perfil_names[$user->perfil] ?? 'Usuario';
        
        $datos_session = [
            'C_id_usuario' => $user->id_usuario,
            'C_id_empleado' => $user->id_empleado,
            'C_nombre_usuario' => $user->nombre_usuario,
            'C_nom_usuario' => $user->nom_usuario,
            'C_perfil' => $user->perfil,
            'C_tipo' => $tipo,
            'C_foto' => $user->foto,
            'C_origen' => $this->session->userdata('C_basedatos')
        ];
        
        $this->session->set_userdata($datos_session);
    }
    
    private function generate2FACode() {
        return sprintf('%06d', random_int(0, 999999));
    }
    
    private function send2FACode($email, $code) {
        $subject = "Código de verificación de dos factores";
        $message = "Su código de verificación es: <strong>$code</strong><br><br>";
        $message .= "Este código expirará en 5 minutos.";
        
        return $this->sendEmail($email, $subject, $message);
    }
    
    private function sendEmail($email, $subject, $message) {
        $config = [
            'protocol' => 'sendmail',
            'mailpath' => '/usr/sbin/sendmail',
            'charset' => 'utf-8',
            'mailtype' => 'html',
            'wordwrap' => TRUE
        ];
        
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('admin@ceciminsigca.com', 'Administrador del Sistema');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        
        return $this->email->send();
    }
    
    private function showError($message) {
        echo "<script>alert('$message'); window.location.href = '" . base_url() . "';</script>";
    }
    
    private function sendJsonResponse($result) {
        if ($result) {
            echo '1';
        } else {
            $error = $this->db->error();
            echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
            if ($error['code'] == 1062) {
                echo "la identificación ingresada, ya se encuentra registrada; Por favor verifique los datos!";
            } else {
                echo "Error: " . $error['code'] . " => " . $error['message'];
            }
            echo '</div>';
        }
    }
}