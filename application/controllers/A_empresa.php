<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_empresa extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');

		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());			
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').';');
		}
	}
	
	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$id =$this->session->userdata('C_id_usuario');
			
			$this->load->helper('funciones_select');
			$data_usua['titulo']="Empresa";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='empresa/index';
			$data_usua['entrada_js']='_js/empresa.js';
			$data_usua['librerias_css']='
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.css">
    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/css/ion.rangeSlider.min.css">
    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">

    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';			
			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>
    		<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
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


		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    		';

			$this->load->view('template',$data_usua);
		}
	}

	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$query0 = $this->general_model->consulta_select('DELETE FROM empresa');

				$fecha = date('Y-m-d H:i:s');
				
				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/documentos_institucionales/';
				$rutag = '/archivos/'.$this->session->userdata('C_basedatos').'/documentos_institucionales/';
				$filename = "";
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];

				$this->load->library("upload",$config);
				
				if ($this->upload->do_upload('logo')){
					$data = array('upload_data' => $this->upload->data());
					$filename = $rutag.$data['upload_data']['file_name'];
				}
				$registro=array(
					'id_empresa'=>1,
					'nit'=>$this->input->post('nit'), 
					'codigoh'=>$this->input->post('codigo_habilitacion'),
					'razon_social'=>$this->input->post('nombre'), 
					'direccion'=>$this->input->post('direccion'), 					
					'telefono'=>$this->input->post('telefono'),
					'celular'=>$this->input->post('celular'),  
					'email'=>$this->input->post('email'), 
					'id_municipio'=>$this->input->post('municipio'), 
					'logo'=>$filename,
					'actividad_economica'=>$this->input->post('actividad'),					 
					'ciiu'=>$this->input->post('ciiu'),
					'riesgo'=>$this->input->post('riesgo'),
					'arl'=>$this->input->post('arl'),
					'caja'=>$this->input->post('caja'),
					'mision'=>$this->input->post('mision'),
					'vision'=>$this->input->post('vision'),						
					'fecha_registro'=>$fecha, 
					'id_usuario'=>$this->session->userdata('C_id_usuario')
				);

				$query = $this->general_model->insert('empresa', $registro);
					
				if($query >= 1) {
					
					$registro0=array(											
						'usuario_temp'=>''
					);		
					$query0 = $this->general_model->update('empresa_anexos', 'usuario_temp', $this->session->userdata('C_id_usuario'), $registro0);
				}if($query0 =="OK") {	
				  echo '1';
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "La Empresa ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}			
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function guardar_documentos_anexos(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				
				$fecha = date('Y-m-d H:i:s');
				$id_usuario = $this->session->userdata('C_id_usuario');
				$filename ='';
				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/documentos_institucionales/';
				$rutag = 'archivos/'.$this->session->userdata('C_basedatos').'/documentos_institucionales/';
				
				$registro=array(
					'id_empresa'=>1,	
					'nombre_archivo'=>$this->input->post('nombre_archivo'),					
					'fecha_documento'=>$this->input->post('fecha_inicio'),	
					'fecha_registro'=>$fecha,
					'usuario_registra'=>$id_usuario,
					'estado'=>'1'   
				);
				$query = $this->general_model->insert('empresa_anexos', $registro);	

				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];

				if(!empty($_FILES['archivo']['name']) && count(array_filter($_FILES['archivo']['name'])) > 0){ 
        			$filesCount = count($_FILES['archivo']['name']); 
        			$this->load->library('upload',$config);
					$this->upload->initialize($config);
	        		$var_file = $_FILES; 
	        		for($i = 0; $i < $filesCount; $i++){
	        			
	        			$_FILES['archivo']['name'] = $var_file['archivo']['name'][$i];
	        			$_FILES['archivo']['type'] = $var_file['archivo']['type'][$i];
	        			$_FILES['archivo']['tmp_name'] = $var_file['archivo']['tmp_name'][$i];
	        			$_FILES['archivo']['error'] = $var_file['archivo']['error'][$i];
	        			$_FILES['archivo']['size'] = $var_file['archivo']['size'][$i];
						
						if ($this->upload->do_upload('archivo')){							
							$data = array('upload_data' => $this->upload->data());
							$filename = $rutag.$data['upload_data']['file_name'];	
							$registro=array(
								'id_anexo'=>$query,								
								'ruta'=> $filename,
								'fecha_anexo'=>$this->input->post('fecha_inicio'),	
								'fecha_registro'=>$fecha,								
								'estado'=>'1'   
							);
							$query1 = $this->general_model->insert('empresa_anexos_archivos', $registro);				
						}else{
							$query ="error_file";
						}
					}
					
				}				

			 	if($query >=1){
			     	echo $query; 
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "La Empresa ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "error_file": echo $this->upload->display_errors(); break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}
			}
		}
	}

	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				
				$registro=array(
					'nit'=>$this->input->post('nit'), 
					'codigoh'=>$this->input->post('codigo_habilitacion'),
					'razon_social'=>$this->input->post('nombre'), 
					'direccion'=>$this->input->post('direccion'), 					
					'telefono'=>$this->input->post('telefono'),
					'celular'=>$this->input->post('celular'),  
					'email'=>$this->input->post('email'), 
					'id_municipio'=>$this->input->post('municipio'), 
					'actividad_economica'=>$this->input->post('actividad'),					 
					'ciiu'=>$this->input->post('ciiu'),
					'riesgo'=>$this->input->post('riesgo'),
					'arl'=>$this->input->post('arl'),
					'caja'=>$this->input->post('caja'),
					'mision'=>$this->input->post('mision'),
					'vision'=>$this->input->post('vision')
				);

				$query = $this->general_model->update('empresa', 'id_empresa', $this->input->post('idregistro'), $registro);
				
				if($query=="OK"){
					echo '1';
				}else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "La Empresa ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function cargar_empresa() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				
				header('Content-Type: application/json');

				$campos = 'e.id_empresa, e.nit, e.codigoh, e.razon_social, e.direccion, e.telefono, e.celular, e.email, e.id_municipio, e.logo, e.actividad_economica, e.ciiu, e.riesgo, e.arl, e.caja, e.mision, e.vision, m.id_departamento';
				$query = $this->general_model->consulta_personalizada($campos, 'empresa e LEFT JOIN municipios m ON e.id_municipio = m.id_municipio', '', '', 1, 0);

				$row = $query->row_array();
					
				$arr['empresa'] = array('id_empresa'=>$row['id_empresa'], 'nit'=>$row['nit'], 'codigoh'=>$row['codigoh'], 'nombre'=>$row['razon_social'], 'direccion'=>$row['direccion'], 'telefono'=>$row['telefono'], 'celular'=>$row['celular'], 'email'=>$row['email'], 'id_municipio'=>$row['id_municipio'], 'logo'=> $row['logo'],'actividad_economica'=>$row['actividad_economica'], 'ciiu'=>$row['ciiu'],'riesgo'=>$row['riesgo'],'arl'=>$row['arl'],'caja'=>$row['caja'],'mision'=>$row['mision'], 'vision'=>$row['vision'], 'id_departamento'=>$row['id_departamento']);
				
				echo json_encode($arr);
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function cargar_politica() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				echo cargar_politicas_acord();
			}			
		}
	}


	public function cargar_anexos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idempre = '1';
				$accordion = '';
				$campos = 'ea.id_anexo AS "Id", ea.nombre_archivo AS "Nombre",ea.fecha_documento AS "fechainicio",ea.fecha_registro AS "Fechafin"';
				$query = $this->general_model->consulta_personalizada($campos, 'empresa_anexos ea', 'id_empresa='.$idempre.'', '', 0, 0);

				$accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5"><table>';
				foreach ($query->result_array() as $row)
			    {      
			    	$campos1 ='id_archivo AS "Id", ruta AS "Archivo"';
			    	$query1 = $this->general_model->consulta_personalizada($campos1, 'empresa_anexos_archivos', 'id_anexo='.$row['Id'].'', '', 0, 0);

			    	$accordion .='<tr><td width="55%"><div class="form-group row" id="div_archivo'.$row['Id'].'">
		                          	<div class="col-sm-4 col-form-label text-sm-left pr-0">'.
		                            	form_label(''.$row['Nombre'],'archivo_'.$row['Id'].'', array('class'=>'mb-0')).'
		                          	</div></td>';
			        foreach ($query1->result_array() as $row1)
				    {
				    	$accordion .='<td width="10%"><div class="col-sm-1" id="archivo_'.$row1['Id'].'">
	                   					'.anchor(base_url().$row1['Archivo'], '<i class="fa fa-file-pdf"></i>', array('classid'=>'btn btn-circle btn-outline-danger','style'=>'width: 30px; height: 30px; padding: 2px 0px;font-size: 18px;','target'=>'_blank')).'

	                  				  </div></td>';
				    }		                          
		                          	
                  	$accordion .='</div><td width="35%">
                  					<div class="form-group row d-flex justify-content-between">
			                          	<span class="col-sm-6">'.
			                            	form_label('Fecha Documento ','fecha_inicio_'.$row['Id'], array('class'=>'mb-0 class="col-sm-12 col-form-label text-sm-right pr-0"')).'
			                          	</span>
		                          		<span class="col-sm-5">'.
		                            		form_input(array('type'=>'date', 'name'=>'fecha_inicio_'.$row['Id'], 'id'=>'fecha_inicio_'.$row['Id'], 'class'=>'form-control col-sm-12', 'value'=>$row['fechainicio'])).'
		                          		</span>

		                          		<div class="col-sm-1">
		                          		<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 
		                          		</div>';
			                    
			    	$accordion .= '</div></td></tr> <hr>';
			    }
			    $accordion .= '</div>';

			    echo $accordion;

			}
		}
	}

  	public function modificar_anexos(){
	  	if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
				redirect();
		else 
		{
			if(!$this->input->is_ajax_request()) 
			{
				redirect();
			} 
			else 
			{
				header('Content-Type: application/json');
				$id = $this->input->post('idreg');
				
				//$sql="SELECT nombre, id_responsable, estado  FROM centroscostos WHERE id_centrocosto = '$id' ";
				$query=$this->general_model->select_where('id_anexo, nombre_archivo, fecha_documento, estado', 'empresa_anexos', array('id_anexo' => $id) );
				$row = $query->row_array();
					
				$arr['anexos'] = array('id'=>$row['id_anexo'], 'nombre'=>$row['nombre_archivo'],'fecha'=>$row['fecha_documento'],'estado'=>$row['estado']);
				echo json_encode( $arr );

			}
		}
  	}


	public function actualizar_anexos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$fecha = date('Y-m-d H:i:s');

				$id_anexo = $this->input->post('idreg_anexo');
				$id_usuario = $this->session->userdata('C_id_usuario');
				$filename ='';
				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/documentos_institucionales/';
				$rutag = 'archivos/'.$this->session->userdata('C_basedatos').'/documentos_institucionales/';
				
				$registro=array(
									
					'fecha_documento'=>$this->input->post('fecha_inicio'),	
					'fecha_registro'=>$fecha
				);
				$query = $this->general_model->update('empresa_anexos', 'id_anexo', $id_anexo, $registro);
			
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];

				if(!empty($_FILES['archivo']['name']) && count(array_filter($_FILES['archivo']['name'])) > 0){ 
        			$filesCount = count($_FILES['archivo']['name']); 
        			$this->load->library('upload',$config);
					$this->upload->initialize($config);
	        		$var_file = $_FILES; 
	        		for($i = 0; $i < $filesCount; $i++){
	        			
	        			$_FILES['archivo']['name'] = $var_file['archivo']['name'][$i];
	        			$_FILES['archivo']['type'] = $var_file['archivo']['type'][$i];
	        			$_FILES['archivo']['tmp_name'] = $var_file['archivo']['tmp_name'][$i];
	        			$_FILES['archivo']['error'] = $var_file['archivo']['error'][$i];
	        			$_FILES['archivo']['size'] = $var_file['archivo']['size'][$i];
						
						if ($this->upload->do_upload('archivo')){							
							$data = array('upload_data' => $this->upload->data());
							$filename = $rutag.$data['upload_data']['file_name'];	
							$registro=array(
								'id_anexo'=>$id_anexo,								
								'ruta'=> $filename,
								'fecha_anexo'=>$this->input->post('fecha_inicio'),	
								'fecha_registro'=>$fecha,								
								'estado'=>'1'   
							);
							$query = $this->general_model->insert('empresa_anexos_archivos', $registro);				
						}else{
							$query ="error_file";
						}
					}
					
				}				

			 	if($query >=1){
			     	echo $query; 
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "La Empresa ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "error_file": echo $this->upload->display_errors(); break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}


	public function cargar_municipio() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$campos = ' m.id_municipio, m.nombre ';
				$query = $this->general_model->consulta_personalizada($campos, 'municipios m','m.id_departamento = "'.$this->input->post('depa').'" ', 'm.nombre', 0, 0);
				//echo $this->db->last_query();
				$arr = '<option value="0" selected>Seleccione un municipio</option>';
				foreach($query->result_array() as $row) {
					$arr .= '<option value="'.$row['id_municipio'].'">'.$row['nombre'].'</option>';
				}
				
				echo $arr;
				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	

	public function eliminar_archivo($id){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$campos = 'urlarchivo AS "Arvhivo"';
				$query = $this->general_model->consulta_personalizada($campos, 'empresa_anexo', 'usuario_temp='.$id.'', '', 0, 0);
				foreach ($query->result_array() as $row)
			    { 
			    	unlink($row['Arvhivo']);
			    }
				echo '0';
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}
	
}