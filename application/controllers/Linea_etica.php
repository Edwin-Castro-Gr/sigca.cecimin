<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Linea_etica extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');		
	}
	
	public function index()	
	{

		$this->session->sess_destroy();
		$this->load->view('lineaEtica/index');
	}
	
	public function guardar()
	{
		if(!$this->input->is_ajax_request()) {
			redirect();
		} else {
			$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 
			$data ='';

			$this->session->set_userdata($datos_session2); 
			
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').';');
			
			// CREAR DIRECTORIO DE ARCHIVOS DE LINEA ETICA //
			if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
		 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
		 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/')) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/', 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/denuncias/')) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/denuncias/', 0777, true);
				 	}
			 	}
		 	} elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/')) {
			 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/', 0777, true);
		 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/denuncias/')) {
				mkdir('archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/denuncias/', 0777, true);
		 	}

			$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/denuncias/';  
			$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/linea_etica/denuncias/';
				

			//CARGAR ARCHIVO VISUAL
			$config = [
				"upload_path" => $ruta,
				"allowed_types" => "*"
			];
			//****************************************/
			$this->load->library("upload",$config);

			$fecha =	 date('Y-m-d H:i:s');
			$id_empleado = 6;
			$empleado = "";
			$correo_empleado = "";
			$radicado = "";
			$mensaje = $this->input->post('txtmensaje');
			$email = $this->input->post('email');
			$telefono=$this->input->post('fijo');
			$contacto = $this->input->post('txtnombres'). " ".$this->input->post('apellidos');
			$registro=array(
				'tipo_denuncia'=>$this->input->post('txttdenuncia'), 
				'otigen_denuncia'=>$this->input->post('txtorigend'),
				'descipcion_denuncia'=>$this->input->post('txtmensaje'),				
				'fecha_hecho'=>$this->input->post('txtfecha_hecho'),
				'hora_hecho'=>$this->input->post('txthora_hecho'),
				'nombres'=>$this->input->post('nombres'),
				'apellidos'=>$this->input->post('apellidos'),
				'telefono'=>$this->input->post('fijo'),				
				'email'=>$this->input->post('email'),
				'politica_datos'=>$this->input->post('poli_protdatos'),	
				'fecha_registro'=>$fecha,			
				'estado'=>'1'
			);				

			$query = $this->general_model->insert('linea_etica', $registro);
			
			if($query >= 1) {
				if ($this->upload->do_upload('archivoevi')){
					$data = array('upload_data' => $this->upload->data());
					$radicado = "LE-DE-000".$query;
					$registro1=array(
						'id_linea_etica'=>$query,
						'ruta'=>$rutag,
						'archivo'=>$data['upload_data']['file_name'], 
						'fecha_registro'=>$fecha
					);
					$query = $this->general_model->insert('linea_etica_anexos', $registro1);

					// Si la carga es exitosa, continúa con el envío del correo
		            $data1 = $this->upload->data();
		            $ruta_archivo = $data1['full_path'];

		            // Configurar el correo
		            // $para = 'Edwin Castro <edwincas_17@hotmail.com>';
		            $para = 'Linea Etica<lineaeticacecimin@saludinteligente.com>';

		            $asunto = "Denunacia por Linea Etica -  Radicado N°'".$radicado."' - fecha: '".$fecha."";
		            
		            // Generar el contenido del archivo adjunto
		            $archivo = file_get_contents($ruta_archivo);
		            $archivo_adjunto = chunk_split(base64_encode($archivo));
		            $nombre_archivo = $data1['file_name'];

		            // Crear los encabezados del correo
		            $boundary = md5(uniqid(time()));
		            $headers = "From: ".$email."\r\n";
		            $headers .= "CC:  ".$email."\r\n"; // Con copia
					// $headers .= "BCC: copia_oculta@example.com\r\n"; // Con copia oculta
		            $headers .= "MIME-Version: 1.0\r\n";
		            $headers .= "Content-Type: multipart/alter; boundary=\"".$boundary."\"\r\n";

		            // Cuerpo del correo
		            $cuerpo = "--".$boundary."\r\n";
		            $cuerpo .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
		            $cuerpo .= "Content-Transfer-Encoding: 7bit\r\n\r\n"; 		            
 		            $cuerpo .= "<div><font size='3'>Señores,</font></div>\r\n";				
					$cuerpo .= "<div><font size='3'>CECIMIN S.A.S.,</font></div>\r\n";				
					$cuerpo .= "<div><font size='3'>Atte: Linea Etica,</font></div>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<div><font size='4'></font></div>\r\n";
					$cuerpo .= "<br>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Descripción de los Hechos denunciados:</b></font></div>\r\n";
				    $cuerpo .= "<div><font size='3'>".$mensaje."</font></div>\r\n";
				    $cuerpo .= "<br>\r\n";
					$cuerpo .= "<div><font size='4'><b>Datos del denunciante</b></font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Nombres y Apellidos:</b> ".$contacto."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Correo Electrónico:</b> ".$email."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Telefono de Contacto:</b> ".$telefono."</font></div>\r\n";
				    $cuerpo .= "<br>\r\n";		
				    $cuerpo .= "<br>\r\n";		    
				    $cuerpo .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
				    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";		
 		            $cuerpo .= "\r\n\r\n\r\n";

		            $cuerpo .= "--".$boundary."\r\n";
		            $cuerpo .= "Content-Type: application/octet-stream; name=\"".$nombre_archivo."\"\r\n";
		            $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
		            $cuerpo .= "Content-Disposition: attachment; filename=\"".$nombre_archivo."\"\r\n\r\n";
		            $cuerpo .= $archivo_adjunto."\r\n\r\n";
		            $cuerpo .= "--".$boundary."--";
					
					$msg = $this->sendEmail2($para, $asunto, $cuerpo, $headers);
					if($msg=1){
						$query = 1;
					}else{
						$query =-999;						
					}

				}else{

					$error = array('error' => $this->upload->display_errors());
            		$msg = $this->load->view('upload_form', $error);
					$query = "-998";
				}
			}
			if($query >= 1) {			
				echo $query;
			}else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>'.$query.'¡Error!</strong><br>';
				switch($query) {
					case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					case "-998": echo "Error:".$msg."; Por favor verifique los datos del correo!"; break;
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
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
				// $usuario_perfil = $this->session->userdata('C_perfil');
				// $usuario = $this->session->userdata('C_id_usuario');
				
				$tabla = '';
    
			    $campos = ' "..", id_contacto AS "Id", CASE WHEN motivo="0" THEN "Felicitaciones" WHEN motivo="1" THEN  "Sugerencia" WHEN motivo="2" THEN "Queja" WHEN motivo="3" THEN  "Reclamo" ELSE "Petición"  END AS "Motivo", IFNULL(CONCAT(nombres, " ",apellidos),"") AS "Contacto", DATE_FORMAT(fecha_registro, "%d/%m/%Y") AS "Fecha", CASE WHEN estado="1" THEN "Recibida" WHEN estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado", "" AS "Acción" ';
			      
			    			    
			    $query = $this->general_model->consulta_personalizada($campos, 'contactenos', 'estado="1" || estado="2"', 'fecha_registro desc', 0, 0);
			    
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
			$campos = '"Orden", c.fecha_registro AS "Fecha_registro", CASE WHEN c.motivo="0" THEN "Felicitaciones" WHEN c.motivo="1" THEN  "Sugerencia" WHEN c.motivo="2" THEN "Queja" WHEN c.motivo="3" THEN  "Reclamo" ELSE "Petición"  END AS "Motivo", IFNULL(CONCAT(c.nombres, " ",c.apellidos),"") AS "Contacto", c.documento_identidad AS "Cedula", c.email AS "Email", c.telefono AS "Teléfono", c.direccion_residencia AS "Direccion", CASE WHEN c.entidad_EPS = "1" THEN "Colsanitas" WHEN c.entidad_EPS = "2" THEN "Medisanitas" WHEN c.entidad_EPS = "3" THEN "EPS Sanitas" WHEN c.entidad_EPS = "4" THEN "ARL Sura" WHEN c.entidad_EPS = "5" THEN "Seguros Bolívar" WHEN c.entidad_EPS = "6" THEN "Unisalud" WHEN c.entidad_EPS = "7" THEN "Particular" WHEN c.entidad_EPS = "8" THEN c.otra_entidad END AS "Entidad", s.nombre AS "Servicio", c.mensaje AS "Mensaje", IFNULL(c.observaciones_cierre,"") AS "Observaciones", IFNULL(c.accion_mejora,"") AS "Accion de Mejora", CASE WHEN c.estado="1" THEN "Recibida" WHEN c.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';
			
			$query = $this->general_model->consulta_personalizada($campos, 'contactenos c INNER JOIN servicios s ON c.servicio = s.id_servicio', 'YEAR(c.fecha_registro)="'.$idfecha[0].'" AND MONTH(c.fecha_registro) = "'.$idfecha[1].'"', 'c.id_contacto', 0, 0);
			

			$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			$td = '<tr class="d-style bgc-h-default-l4">';
		    foreach ($query->list_fields() as $campo)
		    {				      
		        $tabla .= '<th>'.($campo).'</th>';	
		        		    
			}
			$tabla .= '</tr></thead><tbody class="pos-rel">';
			
			foreach ($query->result_array() as $row1)
			{
				$count++;
				$tabla .= '<tr><td>'.$count.'</td><td>'.$row1['Fecha_registro'].'</td><td>'.$row1['Motivo'].'</td><td>'.$row1['Contacto'].'</td><td>'.$row1['Cedula'].'</td><td>'.$row1['Email'].'</td><td>'.$row1['Teléfono'].'</td><td>'.$row1['Direccion'].'</td><td>'.$row1['Entidad'].'</td><td>'.$row1['Servicio'].'</td><td>'.$row1['Mensaje'].'</td><td>'.$row1['Observaciones'].'</td><td>'.$row1['Accion de Mejora'].'</td><td>'.$row1['Estado'].'</td></tr>';    					
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


			$campos='motivo AS "Motivo", IFNULL(CONCAT(nombres, " ",apellidos),"") AS "Contacto", documento_identidad AS "Cedula", email AS "Email", telefono AS "Telefono", direccion_residencia AS "Direccion", entidad_EPS AS "Entidad", otra_entidad AS "Otraentidad", servicio AS "Servicio", mensaje AS "Mensaje", fecha_hecho AS "Fecha_hecho", hora_hecho AS "Hora_hecho", IFNULL(accion_mejora,"") AS "Accion", IFNULL(observaciones_cierre,"") AS "Observaciones", fecha_registro AS "Fecha_reg", estado AS "Estado"';

			$query = $this->general_model->consulta_personalizada($campos,'contactenos', 'id_contacto ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				
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
	public function cargar_origen() {
		if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				if(!$this->input->is_ajax_request()) {
					redirect();
				} else {
					$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 
						
					$this->session->set_userdata($datos_session2); 
					
					$this->load->database();
					$this->db->query('USE '.$this->session->userdata('C_basedatos').';');

				
				$arr="";			
				
				$campos = ' id_origen, nombre ';
				$query = $this->general_model->consulta_personalizada($campos, 'linea_etica_origen','estado = "1" ', 'id_origen', 0, 0);
				//echo $this->db->last_query();
				$arr = '<option value="999" selected>Selecciona una Opción </option>';
				foreach($query->result_array() as $row) {
					$arr .= '<option value="'.$row['id_origen'].'">'.$row['nombre'].'</option>';
				}
				echo $arr;								
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
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
			
			if($estado == "2"){
				$registro=array(
					'accion_mejora'=>$this->input->post('accion'), 
					'fecha_accion'=>$fecha,	
					'usuario_accion'=>$this->session->userdata('C_id_usuario'),					
					'estado'=>'2'
				);					
			}else if($estado == "0"){

				$registro=array(
					'accion_mejora'=>$this->input->post('accion'), 
					'observaciones_cierre'=>$this->input->post('observaciones'), 
					'usuario_cierre'=>$this->session->userdata('C_id_usuario'),		
					'fecha_cierre'=>$fecha,						
					'estado'=>'0'
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
	