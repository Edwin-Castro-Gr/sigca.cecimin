<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class A_usuarios extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');
		
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());			
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
		}
	}
	
	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			/*$query = $this->general_model->select_where('id_tipo_usuario, nombre ', 'tipos_usuarios', array('estado'=>'1'));
			$data_usua['c_tipos_usuarios'][0] = 'Seleccione un Perfil';
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_tipos_usuarios'][$row['id_tipo_usuario']] = $row['nombre'];
			}*/
			$this->load->helper('funciones_select');

			$data_usua['titulo']="Usuarios";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='a_usuarios/index';
			$data_usua['entrada_js']='_js/a_usuarios.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>

    		<!-- DataTables  -->
    		<script src="'.base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js').'"></script>
    		<script src="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js').'"></script>';

			$this->load->view('template',$data_usua);
		} //-Valida Inicio de Session
	}

	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				echo listar_usuarios_tabla('WEB');
			}
		}
	}

	public function cargar_empleado() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');

				$id = $this->input->post('idempl');
				
				// $sql = "SELECT id_empleado AS 'id_usuario', LOWER(CONCAT(TRIM( SUBSTRING( nombres, 1, 1)) , TRIM( SUBSTRING(nombres, locate(' ', nombres), 2)) , TRIM(SUBSTRING_INDEX(apellidos,' ', 1))))AS 'usuario', CONCAT(UPPER(LEFT((TRIM(SUBSTRING(nombres, 1))),1)),LOWER(SUBSTRING(TRIM(SUBSTRING_INDEX(nombres,' ', 1)),2))) AS 'nombres', CONCAT(UPPER(LEFT((TRIM(SUBSTRING_INDEX(apellidos, ' ', 1))),1)),LOWER(SUBSTRING(TRIM(SUBSTRING_INDEX(apellidos, ' ', 1)),2))) AS 'apellidos', email AS 'email', telefono AS 'telefono', cedula AS 'clave'  FROM empleados WHERE id_empleado = '$id'";
				$sql = "SELECT id_empleado AS 'id_usuario', cedula AS 'usuario', CONCAT(UPPER(LEFT((TRIM(SUBSTRING(nombres, 1))),1)),LOWER(SUBSTRING(TRIM(SUBSTRING_INDEX(nombres,' ', 1)),2))) AS 'nombres', CONCAT(UPPER(LEFT((TRIM(SUBSTRING_INDEX(apellidos, ' ', 1))),1)),LOWER(SUBSTRING(TRIM(SUBSTRING_INDEX(apellidos, ' ', 1)),2))) AS 'apellidos', email AS 'email', telefono AS 'telefono', cedula AS 'clave'  FROM empleados WHERE id_empleado = '$id'";
				
				
				$query=$this->general_model->consulta_select($sql);
				$row = $query->row_array();
				
				$arr['empleado'] = array('clave'=>$row['clave'], 'usuario'=>$row['usuario'], 'nombres'=>$row['nombres'], 'apellidos'=>$row['apellidos'], 'email'=>$row['email'], 'telefono'=>$row['telefono']);			

				echo json_encode( $arr );
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}


	public function verificar_usuario() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');

				$id = $this->input->post('idempl');
				
				$sql = "SELECT id_usuario AS 'id_usuario', usuario AS 'usuario', IFNULL(CONCAT(nombre, ' ', apellido),'') AS 'Empleado' FROM usuarios WHERE id_empleado = '$id'";					

				$query=$this->general_model->consulta_select($sql);
				$row = $query->row_array();
				
				$arr['usuario'] = array('id_usuario'=>$row['id_usuario'],'usuario'=>$row['usuario'], 'nombreUsuario'=>$row['Empleado']);			

				echo json_encode( $arr );
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}
	
	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else{
			if(!$this->input->is_ajax_request()) {
				redirect();
			}else{

				//'AES_ENCRYPT('.$this->input->post('clave').'), "-Qsc.725943!")';
				$clave_cod = 'AES_ENCRYPT('.$this->db->escape($this->input->post('clave')).', "-Qsc.725943!")';
				$fecha = date('Y-m-d H:i:s');

				
				$sql_inser="INSERT INTO usuarios VALUES ('".$this->input->post('empleados_usuarios')."','".$this->input->post('usuario')."',$clave_cod,'".$this->input->post('nombres')."','".$this->input->post('apellidos')."','".$this->input->post('telefono')."','".$this->input->post('email')."','".$this->input->post('empleados_usuarios')."','".$this->input->post('perfil')."',NULL,NULL,NULL,'0','0','".$fecha."', '1')";
				
				$query = $this->general_model->consulta_select($sql_inser);

					if($query){
						$msg='';
						$usuario = '';

						$funcionario = $this->input->post('nombres')." ".$this->input->post('apellidos') ;
						$correo_funcionario = $this->input->post('email');

						$de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
					    
						$Para ="".$funcionario." <".$correo_funcionario.">";
						// $Para ="Edwin Castro <edwincas_17@hotmail.com>";
						$Asunto ="Socialización de acceso a SIGCA";

						$Cabeceras = "From:".$de."\r\n"; 
						$Cabeceras = "CC:Ana samantha Rodriguez pacheco <asrodriguez@saludinteligente.com>\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n";					
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
							
						$cuerpo = "<div><font size='3'>Estimado(a) Funcionario,</font></div>\r\n";				
						$cuerpo .= "<div><font size='3'>".$funcionario.",</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>La presente es con el fin de socializar Usuario y Contraseña de Acceso a SIGCA:</font></div>\r\n";									
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'>Usuario y Contraseña es su documento de identidad:".$this->input->post('cedula')."</font></div>\r\n";	
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'>Agradeciendo su atención, </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'>Atentamente, </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'>Samantha Rodriguez Pacheco</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Coordinadora de Calidad</font></div>\r\n";
					    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";				
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='1' color:'#20A491' >MEDIO AMBIENTE: ¿Necesita realmente imprimir este correo? CONFIDENCIALIDAD: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su destinatario. </font></div>\r\n";									
						
						$msg = $this->sendEmail($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}
					
					echo '1';
				}else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}
			}
		} //-Valida Envio por ajax
	}//-Valida Inicio de Session
	
	
	public function cargar_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				header('Content-Type: application/json');

				$id = $this->input->post('idreg');
				$campos = ' u.id_usuario, u.usuario, e.cedula AS clave, u.nombre, u.apellido, u.telefono, u.email, u.id_empleado, u.perfil, u.estado';
				$query = $this->general_model->consulta_personalizada($campos, 'usuarios u INNER JOIN empleados e ON u.id_usuario = e.id_empleado', ' u.id_usuario = "'.$id.'" ', '', 0, 0);
				
				$row = $query->row_array();
				
				$arr['usuario'] = array('id_usuario'=>$row['id_usuario'], 'user'=>$row['usuario'], 'clave'=>$row['clave'],'nombre'=>$row['nombre'],'apellido'=>$row['apellido'],'telefono'=>$row['telefono'],'email'=>$row['email'], 'perfil'=>$row['perfil'],'estado'=>$row['estado']);
				
				echo json_encode($arr);
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				if($this->input->post('clave2') != ""){
					$clave_cod = "AES_ENCRYPT(".$this->db->escape($this->input->post('clave')).", '-Qsc.725943!')";
					$sql_inser="UPDATE usuarios SET email = '".$this->input->post('email')."', clave = $clave_cod, id_empleado = '".$this->input->post('nombre')."', estado = '".$this->input->post('estado')."' WHERE id_usuario = '".$this->input->post('idusuario')."' ";
				} else {
					$sql_inser="UPDATE usuarios SET email = '".$this->input->post('email')."', id_empleado = '".$this->input->post('nombre')."', estado = '".$this->input->post('estado')."' WHERE id_usuario = '".$this->input->post('idusuario')."' ";
				}
				$query = $this->general_model->consulta_select($sql_inser);
				
					if($query){
						if($query){
						$msg='';
						$usuario = '';

						$funcionario = $this->input->post('nombres')." ".$this->input->post('apellidos') ;
						$correo_funcionario = $this->input->post('email');

						$de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
					    
						$Para ="".$funcionario." <".$correo_funcionario.">";
						// $Para ="Edwin Castro <edwincas_17@hotmail.com>";
						$Asunto ="Socialización de acceso a SIGCA";

						$Cabeceras = "From:".$de."\r\n"; 
						$Cabeceras = "CC:Ana samantha Rodriguez pacheco <asrodriguez@saludinteligente.com>\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n";					
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
							
						$cuerpo = "<div><font size='3'>Estimado(a) Funcionario,</font></div>\r\n";				
						$cuerpo .= "<div><font size='3'>".$funcionario.",</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>La presente es con el fin de socializar Usuario y Contraseña de Acceso a SIGCA:</font></div>\r\n";									
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'>Usuario y Contraseña es su documento de identidad:".$this->input->post('cedula')."</font></div>\r\n";	
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'>Agradeciendo su atención, </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'>Atentamente, </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'>Samantha Rodriguez Pacheco</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Coordinadora de Calidad</font></div>\r\n";
					    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";				
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='1' color:'#20A491' >MEDIO AMBIENTE: ¿Necesita realmente imprimir este correo? CONFIDENCIALIDAD: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su destinatario. </font></div>\r\n";									
						
						$msg = $this->sendEmail($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}
					}
					echo '1';
				}else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_usuarios.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="5">LISTADO GENERAL DE USUARIOS DE EMPLEADOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_usuarios_tabla('EXCEL')); 
            echo '</table>';			
		}//-Valida Inicio de Session
	}


	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('usuarios', 'id_usuario', $this->input->post('idreg'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo $query;
				}
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

				$campos ='u.id_usuario AS "Id", CONCAT(e.nombre_1, " ", e.apellido_1) AS "Nombre", t.nombre AS "Perfil", u.email AS "Email", e.movil AS "Teléfono", CASE WHEN u.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"  ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'usuarios u INNER JOIN tipos_usuarios t ON u.perfil = t.id_tipo_usuario LEFT JOIN empleados e ON u.id_empleado = e.id_empleado', ' u.id_usuario = "'.$idreg.'" ', '', 0, 0);
		      
				$encabezado = array();
				$i = 0;
				foreach ($query->list_fields() as $campo)
				{
					$encabezado[$i] = $campo;
					$i++;
				}
				
				$row = $query->row_array();
				
				$tabla = '<div class="col-md-12">';
				for($k=0; $k<$i; $k++) {
					$tabla .= '<div class="row col-12">';
					$tabla .= form_label($encabezado[$k].': ','', array('class'=>'control-label text-right col-md-4')).'<div class="col-md-8"><h4 class="text-primary">'.$row[$encabezado[$k]].'</h4></div>';
					$tabla .= '</div>';
				}
				$tabla .= '</div>';
				echo $tabla;
			}
		}
	}


	public function sendEmail($Para, $Asunto, $cuerpo, $Cabeceras){
		if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
			$msg = 1;				
		}else{
			$msg = $this->email->print_debugger();	
		}
		return $msg;
	}
}