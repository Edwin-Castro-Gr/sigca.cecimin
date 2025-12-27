<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');

		$this->load->helper('recaptcha'); // Carga el helper de reCAPTCHA
		$ghash ="";
	}
	
	public function index()	{

		$this->session->sess_destroy();

		// Datos de la cookie
        $cookie_name = 'session_cookie'; // Nombre de la cookie
        $cookie_value = bin2hex(random_bytes(16)); // Valor único para la cookie
        $cookie_expire = time() + 3600; // Expira en 1 hora

        // Establece la cookie manualmente con los atributos necesarios
        header('Set-Cookie: ' . $cookie_name . '=' . $cookie_value . '; Expires=' . gmdate('D, d M Y H:i:s T', $cookie_expire) . '; Path=/; Secure; SameSite=None; Partitioned;');
		$this->load->view('login/index');
	}
	
	public function cambiar(){
		$id = $this->input->get('idreg');
		$data_usua['c_id_usuario'] = $id;	
		$this->load->view('login/cambiar_password',$data_usua);
	}

	public function reset()	{
		
		switch( strtolower("sigca") ) {
			case 'sigca': $datos_session2 = array('C_basedatos'=>'u610593899_sigca'); break;
			
			default: echo "ERROR=El Código no es valido...!"; exit(); break;
		}
		$this->session->set_userdata($datos_session2); 
		$this->load->database();
		$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
		
		if($this->input->get('hash')){
			$hash =$this->input->get('hash');
			
			$data_usua['c_hash'] = $hash;
			$getHashDetails = $this->general_model->select_hash("*","usuarios","hash_key ='".$hash."'");
			if($getHashDetails!=false)
			{
				$hash_expiry = $getHashDetails->hash_expiry;
				$currentDate = date('Y-m-d H:i');
				if($currentDate < $hash_expiry)
				{
					
					$this->load->view('login/reset_password',$data_usua);				
				}else{
					echo "2"; //Tocken Invalido
				}
			}
		}	
	}

	public function guardar_nuevaClave(){
		if(!$this->input->is_ajax_request()) {
			redirect(base_url());
		} else {
			switch( strtolower("sigca") ) {
				case 'sigca': $datos_session2 = array('C_basedatos'=>'u610593899_sigca'); break;
				
				default: echo "ERROR=El Código no es valido...!"; exit(); break;
			}
			$this->session->set_userdata($datos_session2); 
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			$ghash = $this->input->post('hashrecov');
			$clave_cod = "AES_ENCRYPT('".$this->input->post('password')."', '-Qsc.725943!')";

			$sql_update="UPDATE usuarios SET clave =".$clave_cod.", hash_key='null', hash_expiry='null' WHERE hash_key ='".$ghash."'";
			
			$query = $this->general_model->consulta_select($sql_update); 
			if($query)
				echo '1';
			else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
				switch($query) {
					case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
				}
				echo '</div>';
			}
		}
	}

	public function actualizar_clave(){
		if(!$this->input->is_ajax_request()) {
			redirect(base_url());
		} else {
		
			$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 
			
			$this->session->set_userdata($datos_session2); 
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			$usuario = $this->input->post('idreg');

			$clave_cod = "AES_ENCRYPT('".$this->input->post('password')."', '-Qsc.725943!')";
			
			$sql_update="UPDATE usuarios SET clave =".$clave_cod.", cambio_clave='1', politica_proteccion_datos='1' WHERE usuario ='".$usuario."'";
			$query = $this->general_model->consulta_select($sql_update);  
			// $query = $this->general_model->update('usuarios', 'usuario', $usuario, $registro);
			if($query)
				echo '1';
			else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
				switch($query) {
					case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
				}
				echo '</div>';
			}
		}
	}

	public function verificar() {
		if(!$this->input->is_ajax_request()) {
			redirect();
		} else {
			$this->load->helper('recaptcha'); // Cargar helper

			$token = $this->input->post('recaptchaToken');
            $secret_key = $this->config->item('recaptcha_secret_key');
            //var_dump($token);

            $recaptcha_response = validate_recaptcha($secret_key, $token);			
			//var_dump($recaptcha_response);
			// Validar reCAPTCHA
            
			if (!empty($recaptcha_response["success"]) &&
				($recaptcha_response["action"] ?? '') === 'login' &&
				floatval($recaptcha_response["score"] ?? 0) > 0.6) {

		        // Continuar con la lógica de autenticación
				$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 			
				$this->session->set_userdata($datos_session2); 
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
				
				
				// Nuevo método seguro
				$resu = $this->general_model->get_user_by_usuario($this->input->post('usuario'));
				$temp_usuario = 0;

				foreach ($resu as $row) {
					$temp_usuario = 1;
					if ($row->estado == "1") {
						if ($row->clave == $this->input->post('contrasena')) {

							// Si 2FA está habilitado, pedir código (estado 6)
							if (intval($row->is_2fa_enabled) === 1 && !empty($row->totp_secret)) {
								// Guardar usuario pendiente en sesión (para el segundo factor)
								$this->session->set_userdata('pending_2fa_user_id', $row->id_usuario);
								echo "6=Se requiere verificación de segundo factor";
								return;
							}

							// ---- SIN 2FA: Login normal (tu flujo actual) ----
							$cambio_clave = $row->cambio_clave;
							if ($cambio_clave == '1'){
								$id_usuario   = $row->id_usuario;
								$id_empleado  = $row->id_empleado;
								define('CON_id_usuario', $id_usuario);
								$nombre_usuario = $row->nombre_usuario;
								$nom_usuario    = $row->nom_usuario;
								$ape_usuario    = $row->ape_usuario;
								$foto           = $row->foto;
								$perfil         = $row->perfil;
								switch($perfil) {
									case '0': $tipo = 'Administrador'; break;
									case '1': $tipo = 'Gerencia'; break;
									case '2': $tipo = 'Coordinadores'; break;
									case '3': $tipo = 'Cirujanos'; break;
									case '4': $tipo = 'Costos/contratos'; break;
									case '5': $tipo = 'Asistenciales'; break;
									case '6': $tipo = 'Cirugia'; break;
									case '7': $tipo = 'Auditoria'; break;
									case '8': $tipo = 'Instrumentadoras'; break;
								}
								$datos_session= array(
									'C_id_usuario'    => $id_usuario,
									'C_id_empleado'   => $id_empleado,
									'C_nombre_usuario'=> $nombre_usuario,
									'C_nom_usuario'   => $nom_usuario,
									'C_perfil'        => $perfil,
									'C_tipo'          => $tipo,
									'C_foto'          => $foto,
									'C_origen'        => $this->session->userdata('C_basedatos'));
								$this->session->set_userdata($datos_session);
								echo "0=".$nom_usuario." ".$ape_usuario;
							} else {
								echo "1=Debe Cambiar su Contraseña";
							}

						} else {
							echo "2=!"; // usuario/clave incorrectos
						}
					} else {
						echo "3=!"; // suspendido
					}
				}

				if ($temp_usuario == 0) {
					echo "4=!"; // no existe
				}

			} else {
				echo "5=!"; // reCAPTCHA no pasó
			}
		}
	}

	
	public function verificar_2fa()
	{
		if (!$this->input->is_ajax_request()) { redirect(); }

		// BD (sigca) como tu flujo
		$datos_session2 = array('C_basedatos'=>'u610593899_sigca');
		$this->session->set_userdata($datos_session2);
		$this->load->database();
		$this->db->query('USE '.$this->session->userdata('C_basedatos').';');

		$pendingId = $this->session->userdata('pending_2fa_user_id');
		if (!$pendingId) { echo "7= Sesión 2FA expirada"; return; }

		$code = $this->input->post('code', TRUE);
		$user = $this->general_model->get_user_by_id($pendingId);
		if (!$user || intval($user->is_2fa_enabled) !== 1 || empty($user->totp_secret)) {
			echo "8= 2FA no configurado";
			return;
		}

		$this->load->library('totp');
		$isValid = $this->totp->verify($user->totp_secret, $code, 1);

		// Intento con códigos de respaldo (hashados)
		if (!$isValid && !empty($user->totp_backup_codes)) {
			$backup = explode("\n", trim($user->totp_backup_codes));
			foreach ($backup as $idx => $hash) {
				if (password_verify($code, $hash)) {
					$isValid = true;
					// invalidar el usado
					unset($backup[$idx]);
					$this->general_model->update_backup_codes($pendingId, implode("\n", $backup));
					break;
				}
			}
		}

		if ($isValid) {
			// completar login idéntico a tu flujo de éxito
			$this->session->unset_userdata('pending_2fa_user_id');

			// reconstruir datos de sesión
			$perfil = $user->perfil;
			switch($perfil) {
				case '0': $tipo = 'Administrador'; break;
				case '1': $tipo = 'Gerencia'; break;
				case '2': $tipo = 'Coordinadores'; break;
				case '3': $tipo = 'Cirujanos'; break;
				case '4': $tipo = 'Costos/contratos'; break;
				case '5': $tipo = 'Asistenciales'; break;
				case '6': $tipo = 'Cirugia'; break;
				case '7': $tipo = 'Auditoria'; break;
				case '8': $tipo = 'Instrumentadoras'; break;
			}
			$datos_session= array(
				'C_id_usuario'     => $user->id_usuario,
				'C_id_empleado'    => $user->id_empleado,
				'C_nombre_usuario' => $user->nombre.' '.$user->apellido,
				'C_nom_usuario'    => $user->nombre,
				'C_perfil'         => $perfil,
				'C_tipo'           => $tipo,
				'C_foto'           => $user->foto,
				'C_origen'         => $this->session->userdata('C_basedatos'));
			$this->session->set_userdata($datos_session);

			$this->general_model->set_last_2fa($user->id_usuario);
			echo "0=".$user->nombre." ".$user->apellido;
		} else {
			echo "7= Código 2FA inválido";
		}
	}

	
	public function recuperar_password() {
		if(!$this->input->is_ajax_request()) {
			redirect('404');
		} else {
			switch( strtolower("sigca") ) {
				case 'sigca': $datos_session2 = array('C_basedatos'=>'u610593899_sigca'); break;
				
				default: echo "ERROR=El Código no es valido...!"; exit(); break;
			}
			$this->session->set_userdata($datos_session2); 
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			if($_SERVER['REQUEST_METHOD']=='POST')
				{
				$this->form_validation->set_rules('email','Email','required');
				if($this->form_validation->run()==TRUE)
				{
					$email = $this->input->post('email');
					$resu = $this->general_model->select_verificarEmail($email);
					if($resu!=false){
						$row = $resu;
						$usuario_id = $row->id_usuario;
						$string = time().$usuario_id.$email;
						$hash_string = hash('sha256',$string);
						$currentDate = date('Y-m-d H:i');
						$hash_expiry = date('Y-m-d H:i', strtotime("30 minutes"));
						$data = array(
							'hash_key'=> $hash_string,
							'hash_expiry'=>$hash_expiry
						);

						$resetLink = base_url().'login/reset?hash='.$hash_string;
						
						$message = "Para recuperar la contraseña:\n <a href='".$resetLink."'>haga click aquí</a>" ;
						$subject = "Recuperar contraseña";
						$sentStatus = $this->sendEmail($email,$subject,$message);
						
						if($sentStatus==true){
							$this->general_model->update('usuarios','email',$email,$data);							
							echo '1';
						}else{							
							echo '2';
						}

					}else{						
						echo '3';	
					}

				}else{
					echo '4';	
				}
			}else{
				echo '5';	
			}
		}
	}

	public function sendEmail($email,$subject,$message)
    {
    	
    	/*CONFIGURACION DE SENMAIL SMTP*/
	    $config = Array(
	    	'protocol'=> 'sendmail',
			'mailpath'=> '/usr/sbin/sendmail',
			'charset'=> 'utf-8',
			'mailtype'  => 'html',
			'wordwrap'=> TRUE
	    );

	    $this->email->initialize($config);


      	$this->load->library('email', $config);
      	$this->email->set_newline("\r\n");
      	$this->email->from('admin@sigca.cecimin.com.co','Administrador del Sistema');
      	$this->email->to($email);
      	$this->email->subject($subject);
     	$this->email->message($message);
      
      	if($this->email->send()){
       		return true;
	    }else{
	     	return false;
	    }
    }

}
	