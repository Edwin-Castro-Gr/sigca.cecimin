<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactenos extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');	
		$this->load->helper('email');	
	}
	
	public function index()	
	{

		$this->session->sess_destroy();
		$this->load->view('contactenos/index');
	}

	
	public function pqrs()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

		$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "PQRS";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'contactenos/pqrs';
			$data_usua['entrada_js'] = '_js/contactenos.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->

			<!-- Animate CSS for the css animation support if needed -->
			<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
			
			<!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->
			<link href="/dist/css/demo.css" rel="stylesheet" type="text/css" />
			<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
		
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">			
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">


    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->

			 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

			<!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->
			<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
			<!-- <script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script> -->
		
			<script src="./dist/js/demo.js"></script>
			<script src="./dist/js/demo.min.js"></script>
			
    		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>
    		<!-- DataTables  -->
    		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    		<script src="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/js/star-rating.min.js"></script>
    		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>
			<script src="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.js') . '"></script>
    		<script src="' . base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js') . '"></script>
			<script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/tiny-date-picker@3.2.8/dist/date-range-picker.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/src/js/bootstrap-datetimepicker.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/js/bootstrap-colorpicker.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template', $data_usua);
		}
	}
	// End Function PQRS----------------------------------------------------------------



	
	public function guardar()
	{
		if(!$this->input->is_ajax_request()) {
			redirect();
		} else {
			$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 
				
			$this->session->set_userdata($datos_session2); 
			
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').';');


			$fecha = date('Y-m-d H:i:s');
			$id_empleado = 6;
			$empleado = "";
			$correo_empleado = "";
			$email=$this->input->post('txtemail');
			$contacto = $this->input->post('txtnombres')." ".$this->input->post('txtapellidos');
			$cedula = $this->input->post('txtdocumento');
			$direccion = $this->input->post('txtdireccion');
			$telefono = $this->input->post('txttelefono');

			$motivo = $this->input->post('txtmotivo');
			$mensaje = $this->input->post('txtmensaje');
			$entidad = $this->input->post('txtentidad');
			$servicio = $this->input->post('txtservicio');
			$radicado = "";

			$textservicio = '';

			switch($servicio){
			case "1":
				$textservicio = "Cirugía";
				break;
			case "2":
				$textservicio = "Procedimiento Menores";
				break;
			case "3":
				$textservicio = "Consulta de Ortopedia";
				break;
			case "4": 
				$textservicio = "Radiología";
				break;
			case "5":
				$textservicio = "Laboratorio Clínica";
				break;
			case "6":
				$textservicio = "Espirometría";
				break;
			case "7":
				$textservicio = "Audiometría";
				break;
			case "8":
				$textservicio = "Consulta de Ortopedia";
				break;
			case "9":
				$textservicio = "Oncología";
				break;
			case "10":
				$textservicio = "Quimioterapia";
				break;
			case "11":
				$textservicio = "Administración de Medicamentos";
				break;
			case "12":
				$textservicio = "Fisioterapía";
				break;
			}

			$textentidad ='';
			if($entidad =="1"){
				$textentidad = "Colsanitas";
			}else if($entidad =="2"){
				$textentidad = "Medisanitas";
			}else if($entidad =="3"){
				$textentidad = "EPS Sanitas";
			}else if($entidad =="4"){
				$textentidad = "ARL Sura";
			}else if($entidad =="5"){
				$textentidad = "Seguros Bolivar";
			}else if($entidad =="6"){
				$textentidad = "Unisalud";
			}else if($entidad =="7"){
				$textentidad = "Particular";
			}else {
				$textentidad = "Otra";
			}
			
			$textmotivo = '';
			if($motivo =="0"){
				$textmotivo = "Felicitaciones";
			}else if($motivo =="1"){
				$textmotivo = "Sugerencia";
			}else if($motivo =="2"){
				$textmotivo = "Queja";
			}else {
				$textmotivo = "Reclamo";
			}

			$campos1='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Empleado", email AS "Correo"';
			$query11 = $this->general_model->consulta_personalizada($campos1,'empleados', 'id_empleado = "'.$id_empleado.'"', '', 0, 0);
			foreach ($query11->result_array() as $row1)
			{
				$empleado = $row1['Empleado'];
				$correo_empleado = $row1['Empleado'];
			}			

			$registro=array(
				'motivo'=>$this->input->post('txtmotivo'), 
				'nombres'=>$this->input->post('txtnombres'),
				'apellidos'=>$this->input->post('txtapellidos'),
				'documento_identidad'=>$this->input->post('txtdocumento'),
				'email'=>$this->input->post('txtemail'),				
				'direccion_residencia'=>$this->input->post('txtdireccion'),
				'telefono'=>$this->input->post('txttelefono'),				
				'entidad_EPS'=>$this->input->post('txtentidad'),
				'otra_entidad'=>$this->input->post('txtotraentidad'),				
				'servicio'=>$this->input->post('txtservicio'), 
				'mensaje'=>$this->input->post('txtmensaje'),
				'fecha_hecho'=>$this->input->post('txtfecha_hecho'),
				'hora_hecho'=>$this->input->post('txthora_hecho'),	
				'tratamiento_datos'=>$this->input->post('txtpolitica'),	
				'fecha_registro'=>$fecha,			
				'estado'=>'1'
			);				

			$query = $this->general_model->insert('contactenos', $registro);			

			if($query >= 1) { //ENVIAR CORREO A CRISTINA 
				$qradicado = $query;

				// Configurar el correo					
				$qradicado = $radicado.$query;
				
				$correo_remitente ='Contactenos';
	            $correo_usuario = 'contactenos@ceciminsigca.com';
	            $correo_cc = 'infocecimin@colsanitas.com';
				
				$asunto ="'".$textmotivo.' de '.$contacto.' - fecha: '.$fecha."'";

				$mensaje = "<div><font size='3'>Señores,</font></div>\r\n";				
				$mensaje .= "<div><font size='3'>CECIMIN S.A.S.,</font></div>\r\n";				
				$mensaje .= "<div><font size='3'>Atte: Atención al Usuario,</font></div>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<div><font size='4'>".$textmotivo."</font></div>\r\n";
				$mensaje .= "<br>\r\n";
			    $mensaje .= "<div><font size='3'><b>Mensaje:</b>".$mensaje."</font></div>\r\n";
			    $mensaje .= "<br>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<div><font size='4'><b>Datos</b></font></div>\r\n";
			    $mensaje .= "<div><font size='3'><b>Nombres y Apellidos:</b> ".$contacto."</font></div>\r\n";			   
			    $mensaje .= "<div><font size='3'><b>Cédula:</b> ".$cedula."</font></div>\r\n";
			    $mensaje .= "<div><font size='3'><b>Correo Electrónico:</b> ".$email."</font></div>\r\n";
			    $mensaje .= "<div><font size='3'><b>Dirección:</b> ".$direccion."</font></div>\r\n";
			    $mensaje .= "<div><font size='3'><b>Telefono de Contacto:</b> ".$telefono."</font></div>\r\n";			    
			    $mensaje .= "<div><font size='3'><b>Entidad:</b> ".$textentidad."</font></div>\r\n";			    
			    $mensaje .= "<div><font size='3'><b>Servicio:</b> ".$textservicio."</font></div>\r\n";
			    $mensaje .= "<br>\r\n";		
			    $mensaje .= "<br>\r\n";
			    $mensaje .= "<br>\r\n";		    
			    $mensaje .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
			    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://ceciminsigca.com/assets/image/logo-cecimin.png'/>";					
				$mensaje .= "<br>\r\n";
					
				// Archivos a adjuntar
            	$adjuntos =  Null;		            	

	            // Enviar el correo utilizando el buzón de contactenos
	            $responseCorreo = (enviar_correo($correo_usuario, $asunto, $mensaje, 'contactenos',  $correo_remitente, $adjuntos, $correo_cc));
	            if ($responseCorreo) {
	                echo "1";
	                $query = 1;
	            } else {
	                $msg = "$responseCorreo";
	                $query =-999;	
	            }						
							
				if($query >= 1) {
					if($motivo == "2" || $motivo == "3"){
						$radicado = "Q-00".$qradicado;


						// Configurar el correo					
						$qradicado = $radicado.$query;
						
						$correo_remitente ='Contactenos';
			            $correo_usuario = $email;
			            $correo_cc = 'contactenos@ceciminsigca.com';				
						
						$asunto ="Radicado No".$radicado." de ".$textmotivo." - fecha: ".$fecha."";

						$mensaje = "<div><font size='3'>Señor(a),</font></div>\r\n";				
						$mensaje .= "<div><font size='3'>".$contacto.",</font></div>\r\n";			
						$mensaje .= "<div><font size='3'>".$direccion.",</font></div>\r\n";
						$mensaje .= "<br>\r\n";
						$mensaje .= "<br>\r\n";
						$mensaje .= "<br>\r\n";
						$mensaje .= "<div><font size='4'>Le informamos que su ".$textmotivo.", fue radicada bajo el consecutivo N°".$radicado.".</font></div>\r\n";
						$mensaje .= "<div><font size='4'>Gracias por contactanos, estaremos dando respuesta a su comunicación dentro de los terminos establecidos por ley. 
						Por este mismo medio le estaremos dando respuesta, o puede comunicarse al 3759000 en Bogotá o al 018000919100 en el resto del país (opción 4) </font></div>\r\n";
						$mensaje .= "<br>\r\n";				    
					    $mensaje .= "<br>\r\n";
						$mensaje .= "<br>\r\n";
					    $mensaje .= "<div><font size='3'style='color:#1C4B62'><b>Nancy Cristina Acevedo Arias</b></font></div>\r\n";		   
					    $mensaje .= "<div><font size='3'>Coordinadora de Mercadeo y atención al Usuario</font></div>\r\n";
					    $mensaje .= "<div><font size='3'>Avenida Carrera 45 N°104-73 Piso 7</font></div>\r\n";
					    $mensaje .= "<div><font size='2'>(601) 6002555 ext.1172 </font></div>\r\n";
					    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px' src='https://ceciminsigca.com/assets/image/logo-cecimin.png'/>";					
						$mensaje .= "<br>\r\n";
					
						// Archivos a adjuntar
		            	$adjuntos =  Null;		            	

			            // Enviar el correo utilizando el buzón de contactenos
			            $responseCorreo = (enviar_correo($correo_usuario, $asunto, $mensaje, 'contactenos',  $correo_remitente, $adjuntos, $correo_cc));
			            if ($responseCorreo) {
			                echo "1";
			                $query = 1;
			            } else {
			               	$msg = "$responseCorreo";
			                $query =-999;	
			            }				
					}
				}
				echo '1';
			}else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>'.$query.'¡Error!</strong><br>';
				switch($query) {
					case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
					default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
				}
				echo '</div>';
			}
			
		}
	}

	public function reporte()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');


			$this->load->helper('funciones_select');
			$data_usua['titulo']="Encuestas de Satisfacción";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contactenos/reporte';
			$data_usua['entrada_js']='_js/contactenos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'"> ';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>
    		<!-- DataTables  -->
    		<script src="'.base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js').'"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function listar_tabla() 
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$valorS = $this->input->post('vswitch');
				
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
				// $usuario_perfil = $this->session->userdata('C_perfil');
				// $usuario = $this->session->userdata('C_id_usuario');
				
				$tabla = '';
    
			    $campos = ' "..", id_contacto AS "Id", CASE WHEN motivo="0" THEN "Felicitaciones" WHEN motivo="1" THEN  "Sugerencia" WHEN motivo="2" THEN "Queja" WHEN motivo="3" THEN  "Reclamo" ELSE "Petición"  END AS "Motivo", IFNULL(CONCAT(nombres, " ",apellidos),"") AS "Contacto", DATE_FORMAT(fecha_registro, "%d/%m/%Y") AS "Fecha", CASE WHEN estado="1" THEN "Recibida" WHEN estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado", "" AS "Acción" ';
			      
			    if($valorS == "false"){
			    	$query = $this->general_model->consulta_personalizada($campos, 'contactenos', 'estado="1" || estado="2"', 'fecha_registro desc', 0, 0);			    	
			    }else{
			    	$query = $this->general_model->consulta_personalizada($campos, 'contactenos', '', 'fecha_registro desc', 0, 0);	
			    }
			    
			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			      if($campo != ".." && $campo != "Acción")
			        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
			      else
			        $tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    //$tabla = '<tbody class="mt-1">';

			    foreach ($query->result_array() as $row)
			    {
				    if($row['Estado'] == "Recibida")
				        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Recibida</span>';
				    elseif($row['Estado'] == "Gestionada")
       					 $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">Gestionada</span>'; 
      				elseif($row['Estado'] == "Cerrada")
        				$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Cerrada</span>'; 		

				    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Motivo'].'</td><td>'.$row['Contacto'].'</td><td>'.$row['Fecha'].'</td><td>'.$estado.'</td>';

		        	$tabla .= '<td class="text-nowrap"><div class="action-buttons">';
		          	
	          		$tabla .= '<a href="#" class="text-success mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip'.$row['Id'].'" id="btngestionar_'.$row['Id'].'"> <i  id="btngestionar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Contacto'].'" /> </i> </a> ';
		          	
		          	$tabla .= '
		          	<!--<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a> -->

		          	<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
		          	</div></td>';

			     	$tabla .= '</tr>';        
			    }
			    $tabla .= '</tbody>';   
			    
			    echo $tabla;
			}
		}
	}
	public function excel($fecha) 
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
		redirect(base_url());
		} else {				

			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			// $fecha =$this->input->get('fecha');
			$idfecha = explode('-',$fecha);	
			// var_dump($idfecha);
			$tabla = '';
			$count = 0;
			$radicado = "Q-00";
			$campos = 'id_contacto AS "Radicado", c.fecha_registro AS "Fecha_registro", CASE WHEN c.motivo="0" THEN "Felicitaciones" WHEN c.motivo="1" THEN  "Sugerencia" WHEN c.motivo="2" THEN "Queja" WHEN c.motivo="3" THEN  "Reclamo" ELSE "Petición"  END AS "Motivo", IFNULL(CONCAT(c.nombres, " ",c.apellidos),"") AS "Contacto", c.documento_identidad AS "Cedula", c.email AS "Email", c.telefono AS "Teléfono", c.direccion_residencia AS "Direccion", CASE WHEN c.entidad_EPS = "1" THEN "Colsanitas" WHEN c.entidad_EPS = "2" THEN "Medisanitas" WHEN c.entidad_EPS = "3" THEN "EPS Sanitas" WHEN c.entidad_EPS = "4" THEN "ARL Sura" WHEN c.entidad_EPS = "5" THEN "Seguros Bolívar" WHEN c.entidad_EPS = "6" THEN "Unisalud" WHEN c.entidad_EPS = "7" THEN "Particular" WHEN c.entidad_EPS = "8" THEN c.otra_entidad END AS "Entidad", s.nombre AS "Servicio", c.mensaje AS "Mensaje", IFNULL(c.observaciones_cierre,"") AS "Observaciones", IFNULL(c.accion_mejora,"") AS "Accion de Mejora", CASE WHEN c.estado="1" THEN "Recibida" WHEN c.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';



			$query = $this->general_model->consulta_personalizada($campos, 'contactenos c INNER JOIN servicios s ON c.servicio = s.id_servicio', 'YEAR(c.fecha_registro)="' . $idfecha[0] . '" AND MONTH(c.fecha_registro) = "' . $idfecha[1] . '" AND t_gestion IS null', 'c.id_contacto', 0, 0);


			$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			$td = '<tr class="d-style bgc-h-default-l4">';
		    foreach ($query->list_fields() as $campo)
		    {				      
		        $tabla .= '<th>'.($campo).'</th>';	
		        		    
			}
			$tabla .= '</tr></thead><tbody class="pos-rel">';
			
			foreach ($query->result_array() as $row1)
			{
				$radicado = "Q-00" . $row1['Radicado'];
				$tabla .= '<tr><td>' . $radicado . '</td><td>' . $row1['Fecha_registro'] . '</td><td>' . $row1['Motivo'] . '</td><td>' . $row1['Contacto'] . '</td><td>' . $row1['Cedula'] . '</td><td>' . $row1['Email'] . '</td><td>' . $row1['Teléfono'] . '</td><td>' . $row1['Direccion'] . '</td><td>' . $row1['Entidad'] . '</td><td>' . $row1['Servicio'] . '</td><td>' . $row1['Mensaje'] . '</td><td>' . $row1['Observaciones'] . '</td><td>' . $row1['Accion de Mejora'] . '</td><td>' . $row1['Estado'] . '</td></tr>';  					
			}						
			
			$tabla .= '</tbody>'; 
			$filename = "Listado_de PQRS.xls";
			$usuario = $this->session->userdata('C_id_usuario');
		    header ("Content-Disposition: attachment; filename=".$filename );
			header ("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL PQRS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode($tabla);
            echo '</table>';		
		}
	}

	public function gestion($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');

			$data_usua['c_id_contacto'] = $id;
			$data_usua['c_motivo'] = '';
			$data_usua['c_nombres'] = '';
			$data_usua['c_identificacion'] = '';
			$data_usua['c_email'] = '';
			$data_usua['c_telefono'] = '';
			$data_usua['c_direccion'] = '';
			$data_usua['c_entidad'] = '';
			$data_usua['c_otraentidad'] = '';
			$data_usua['c_servicio'] = '';
			$data_usua['c_mensaje'] = '';
			$data_usua['c_fecha_hecho'] = '';
			$data_usua['c_hora_hecho'] = '';
			$data_usua['c_accion_mejora'] = '';
			$data_usua['c_observaciones'] = '';
			$data_usua['c_fecha_reg'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_t_gestion'] = '';



			$campos = 'motivo AS "Motivo", IFNULL(CONCAT(nombres, " ",apellidos),"") AS "Contacto", documento_identidad AS "Cedula", email AS "Email", 
			telefono AS "Telefono", direccion_residencia AS "Direccion", entidad_EPS AS "Entidad", otra_entidad AS "Otraentidad", servicio AS "Servicio", 
			mensaje AS "Mensaje", fecha_hecho AS "Fecha_hecho", hora_hecho AS "Hora_hecho", IFNULL(accion_mejora,"") AS "Accion", IFNULL(observaciones_cierre,"") 
			AS "Observaciones", fecha_registro AS "Fecha_reg", estado AS "Estado", t_gestion AS "Gestion"';

			$query = $this->general_model->consulta_personalizada($campos, 'contactenos', 'id_contacto ="' . $id . '" ', '', 0, 0);

			foreach ($query->result_array() as $row) {

				$data_usua['c_motivo'] = $row['Motivo'];
				$data_usua['c_nombres'] = $row['Contacto'];
				$data_usua['c_identificacion'] =  $row['Cedula'];
				$data_usua['c_email'] =  $row['Email'];
				$data_usua['c_telefono'] = $row['Telefono'];
				$data_usua['c_direccion'] = $row['Direccion'];
				$data_usua['c_entidad'] = $row['Entidad'];
				$data_usua['c_otraentidad'] = $row['Otraentidad'];
				$data_usua['c_servicio'] = $row['Servicio'];
				$data_usua['c_mensaje'] = $row['Mensaje'];
				$data_usua['c_fecha_hecho'] = $row['Fecha_hecho'];
				$data_usua['c_hora_hecho'] = $row['Hora_hecho'];
				$data_usua['c_accion_mejora'] = $row['Accion'];
				$data_usua['c_observaciones'] = $row['Observaciones'];
				$data_usua['c_fecha_reg'] = $row['Fecha_reg'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_t_gestion'] = $row['Gestion'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Gestión PQRS";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contactenos/gestion';
			$data_usua['entrada_js']='_js/contactenos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">


    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
			
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>
    		<!-- DataTables  -->
    		<script src="'.base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js').'"></script>
    		<script src="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/js/star-rating.min.js"></script>
    		<script src="'.base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js').'"></script>
			<script src="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.js').'"></script>
    		<script src="'.base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js').'"></script>
			<script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/tiny-date-picker@3.2.8/dist/date-range-picker.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/src/js/bootstrap-datetimepicker.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/js/bootstrap-colorpicker.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template',$data_usua);

		}
		
	}

	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');

				
				$idreg = $this->input->post('idreg');


				$campos = '"Orden", CASE WHEN c.motivo="0" THEN "Felicitaciones" WHEN c.motivo="1" THEN  "Sugerencia" WHEN c.motivo="2" THEN "Queja" WHEN c.motivo="3" THEN  "Reclamo" ELSE "Petición"  END AS "Motivo", IFNULL(CONCAT(c.nombres, " ",c.apellidos),"") AS "Contacto", c.documento_identidad AS "Cedula", c.email AS "Email", c.telefono AS "Teléfono", c.direccion_residencia AS "Direccion", CASE WHEN c.entidad_EPS = "1" THEN "Colsanitas" WHEN c.entidad_EPS = "2" THEN "Medisanitas" WHEN c.entidad_EPS = "3" THEN "EPS Sanitas" WHEN c.entidad_EPS = "4" THEN "ARL Sura" WHEN c.entidad_EPS = "5" THEN "Seguros Bolívar" WHEN c.entidad_EPS = "6" THEN "Unisalud" WHEN c.entidad_EPS = "7" THEN "Particular" WHEN c.entidad_EPS = "8" THEN c.otra_entidad END AS "Entidad", s.nombre AS "Servicio", c.mensaje AS "Mensaje", c.fecha_hecho AS "Fecha_hecho", c.hora_hecho AS "Hora_hecho", IFNULL(c.accion_mejora,"") AS "Accion de Mejora", IFNULL(c.observaciones_cierre,"") AS "Observaciones", c.fecha_registro AS "Fecha_registro",  CASE WHEN c.estado="1" THEN "Recibida" WHEN c.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';
			
				$query = $this->general_model->consulta_personalizada($campos, 'contactenos c INNER JOIN servicios s ON c.servicio = s.id_servicio', 'c.id_contacto='.$idreg.'', '', 0, 0);
			
		      	//echo $this->db->last_query();
				$encabezado = array();
				$i = 0;
				foreach ($query->list_fields() as $campo)
				{
					$encabezado[$i] = $campo;
					$i++;
				}
				
				$tabla = '';
				$row = $query->row_array();				

				for($k=0; $k<$i; $k++) {
					$tabla .= '
					<div class="row">'.
		            	form_label($encabezado[$k].': ','', array('class'=>'control-label text-right col-md-4'))
		              	.'<div class="col-md-8 text-primary"><strong>'.$row[$encabezado[$k]].'</strong></div>
		            </div>';
				}			

		      	echo $tabla;
			}
		}
	}

	public function guardar_gestion() {
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			$fecha = date('Y-m-d H:i:s');
			$id_contrato = $this->input->post('idregistro');
			$estado = $this->input->post('estado');
			
			if ($estado == "2") {
				$registro = array(
					'accion_mejora' => $this->input->post('accion'),
					'observaciones_cierre' => $this->input->post('observaciones'),
					'fecha_accion' => $fecha,
					'usuario_accion' => $this->session->userdata('C_id_usuario'),
					'estado' => '2',
					't_gestion' => $this->input->post('t_gestion'),
				);
			} else if ($estado == "0") {

				$registro = array(
					'accion_mejora' => $this->input->post('accion'),
					'observaciones_cierre' => $this->input->post('observaciones'),
					'usuario_cierre' => $this->session->userdata('C_id_usuario'),
					'fecha_cierre' => $fecha,
					'estado' => '0'
				);
			}
			$query = $this->general_model->update('contactenos', 'id_contacto', $id_contrato, $registro);
			
			if($query =="OK"){
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
	}

	public function sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras){
	
				
		$this->load->database();
		$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');

		if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
			$msg = 1;				
		}else{
			$msg = $this->email->print_debugger();	
		}
		return $msg;
		
	
	}
}
	