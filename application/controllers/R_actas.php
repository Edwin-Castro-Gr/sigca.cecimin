<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class R_actas extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');

		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect(base_url());			
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
		}
	}
	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$this->session->set_userdata('archivo_origen','');
			
			$this->session->set_userdata('archivo_origen_tipo','');
			
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Actas";
			$data_usua['origen']="Registros";
			$data_usua['contenido']='actas/index';
			$data_usua['entrada_js']='_js/r_actas.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">';

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
    		';

			$this->load->view('template',$data_usua);
		}
	}
	
	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {

			$this->session->set_userdata('archivo_origen','');
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');
			$data_usua['usuarioactual']=$this->session->userdata('C_id_usuario');

			$data_usua['titulo']="Nueva Acta";
			$data_usua['origen']="Registros";
			$data_usua['contenido']='actas/nuevo';
			$data_usua['entrada_js']='_js/r_actas.js';
			$data_usua['librerias_css']='<!-- DataTables -->

			<link rel="stylesheet" type="text/css" href="'.base_url('dist/css/signature-pad.css').'">


			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">

    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-markdown@2.10.0/css/bootstrap-markdown.min.css">


			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
			
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>

    		<!-- canvas de Firma  -->
    		<!--<script src="'.base_url('plugins/signature/jSignature.min.js').'"></script>
    		<script src="'.base_url('plugins/signature/modernizr.js').'"></script>-->
    		<script src="'.base_url('dist/js/signature_pad.js').'"></script>

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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>

		    <!-- include vendor scripts used in "Wysiwyg & Markdown" page. see "/views//pages/partials/form-wysiwyg/@vendor-scripts.hbs" -->
		    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/jquery.hotkeys@0.1.0/jquery.hotkeys.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-wysiwyg@2.0.1/js/bootstrap-wysiwyg.min.js"></script>

		    <script src="_js/dom.js"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function modificar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$this->session->set_userdata('archivo_origen','');
			
			$this->session->set_userdata('archivo_origen_tipo','');			

			$data_usua['c_idActa'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_nombre_usuario_a'] = $this->session->userdata('C_nombre_usuario');
			$data_usua['c_tipo_solicitud'] = '';
			$data_usua['c_fecha_reunion'] = '';
			$data_usua['c_hora_inicio'] = '';
			$data_usua['c_hora_final'] = '';
			$data_usua['c_lugar'] ='';
			$data_usua['c_proceso'] = '';
			$data_usua['c_otro_nombre'] ='';
			$data_usua['c_motivo_reunion'] = '';
			$data_usua['c_id_responsable'] = '';
			$data_usua['c_objetivos_reunion'] = '';
			$data_usua['c_segumiento_actas'] = '';
			
			$data_usua['c_detalle_temas'] = '';
			$data_usua['c_detalle_decisiones'] = '';

			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$query=$this->general_model->select_where('id_acta, fecha_reunion, hora_inicio, hora_final, lugar, proceso, nombre_reunion, otro_nombre, motivo_reunion, id_responsabe, objetivos_reunion, segumiento_actas, detalle_temas, detalle_decisiones, usuario_registro, estado','actas',array('id_acta' => $id));
			foreach ($query->result_array() as $row)
			{
				
				
				$data_usua['c_fecha_reunion'] = $row['fecha_reunion'];
				$data_usua['c_hora_inicio'] = $row['hora_inicio'];
				$data_usua['c_hora_final'] =$row['hora_final'];
				$data_usua['c_lugar'] =$row['lugar'];
				$data_usua['c_proceso'] = $row['proceso'];

				$data_usua['c_nombre_reunion'] =$row['nombre_reunion'];
				$data_usua['c_otro_nombre'] =$row['otro_nombre'];
				$data_usua['c_motivo_reunion'] = $row['motivo_reunion'];
				$data_usua['c_id_responsable'] =$row['id_responsabe'];
				$data_usua['c_objetivos_reunion'] = $row['objetivos_reunion'];
				$data_usua['c_segumiento_actas'] = $row['segumiento_actas'];

				$data_usua['c_detalle_temas'] =$row['detalle_temas'];
				$data_usua['c_detalle_decisiones'] = $row['detalle_decisiones'];

				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_id_usuario'] = $row['usuario_registro'];
			}
				
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Modificacion de Actas";
			$data_usua['origen']="Registros";
			$data_usua['contenido']='actas/modificar';
			$data_usua['entrada_js']='_js/r_actas.js';
			$data_usua['librerias_css']='<!-- DataTables -->

			<link rel="stylesheet" type="text/css" href="'.base_url('dist/css/signature-pad.css').'">


			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">

    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-markdown@2.10.0/css/bootstrap-markdown.min.css">


			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
			
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>

    		<!-- canvas de Firma  -->
    		<!--<script src="'.base_url('plugins/signature/jSignature.min.js').'"></script>
    		<script src="'.base_url('plugins/signature/modernizr.js').'"></script>-->
    		<script src="'.base_url('dist/js/signature_pad.js').'"></script>

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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>

		    <!-- include vendor scripts used in "Wysiwyg & Markdown" page. see "/views//pages/partials/form-wysiwyg/@vendor-scripts.hbs" -->
		    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/jquery.hotkeys@0.1.0/jquery.hotkeys.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-wysiwyg@2.0.1/js/bootstrap-wysiwyg.min.js"></script>

		    <script src="'.base_url('_js/dom.js').'"></script>
		    ';

			$this->load->view('template',$data_usua);
		}
	}

	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$usuario=$this->session->userdata('C_id_usuario');
				$this->load->helper('funciones_tabla');
				echo listar_actasR_tabla('WEB',$usuario);
			}
		}
	}

	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				//echo "ingreso";
				//
				$numTarea = $this->input->post('cantTarea');
				$numAsistentes = $this->input->post('cantPart');
				$usuario = $this->session->userdata('C_id_usuario');

				$registro=array(
						
					'fecha_reunion'=> $this->input->post('fechaR'), 
					'hora_inicio'=>$this->input->post('horaI'), 
					'hora_final'=>$this->input->post('horaF'), 		
					'lugar'=>$this->input->post('lugar'), 					
					'proceso'=>$this->input->post('proceso'), 
					'nombre_reunion'=>$this->input->post('Ncomite'),
					'otro_nombre'=>$this->input->post('otroNC'),
					'motivo_reunion'=>$this->input->post('motivo'), 
					'id_responsabe'=>$this->input->post('empleados_responsable'), 
					'objetivos_reunion'=>$this->input->post('objetivo'),
					'segumiento_actas'=>$this->input->post('seguimiento'),
					'detalle_temas'=>$this->input->post('temasD'),
					'detalle_decisiones'=>$this->input->post('decisionesD'),
					'usuario_registro'=>$usuario,
					'estado'=>'1'
				);	
				$query = $this->general_model->insert('actas', $registro);

				if($query >= 1) {
					$i = 1;
					while ($i <= $numTarea){
						
						$registro=array(
						
							'id_acta'=>$query, 
							'id_responsable'=>$this->input->post('idparticipanteT'.$i.''), 
							'descripcion_tarea'=>$this->input->post('tareasAsignadas'.$i.''), 						
							'fecha'=>date("Y-m-d", strtotime($this->input->post('fechaT'.$i.'')))
						);	

						$query1 = $this->general_model->insert('actas_tareas', $registro);
						$i++;
					}
				}
				
				if($query1 >= 1) {

					// ----------- ESTABLECER LA RUTA DONDE SE VA A GUARDAR EL ARCHIVO ----------- //
				
					$dir = 'archivo_actas';

			 		
					$ia = 1;
					while ($ia <= $numAsistentes){						
												
						$fecha = date('Y-m-d');

						$registro=array(
							
							'id_acta '=>$query,
							'idparticipanteP' =>$this->input->post('idparticipanteP'.$ia.''),
							'asistente'=>$this->input->post('participanteP'.$ia.''), 
							'cargo'=>$this->input->post('cargo'.$ia.''), 
							'firma'=>'0',  							
							'firmaBase64'=>''
						);				

						$query2 = $this->general_model->insert('actas_asistentes', $registro);						
						$ia++ ;	
					}
				}
				
				if($query >= 1) {
					echo '1';
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
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
				$fecha = date('Y-m-d');
				$id_acta = $this->input->post('idActa');
				$usuarioactual = $this->session->userdata('C_id_usuario');
				$numTarea = $this->input->post('cantTarea');
				$tareasDB = $this->input->post('tareasDB');
				$numAsistentes = $this->input->post('cantPart');

				$registro=array(
						
					'fecha_reunion'=> $this->input->post('fechaR'), 
					'hora_inicio'=>$this->input->post('horaI'), 
					'hora_final'=>$this->input->post('horaF'), 		
					'lugar'=>$this->input->post('lugar'), 					
					'proceso'=>$this->input->post('proceso'), 
					'nombre_reunion'=>$this->input->post('Ncomite'),
					'otro_nombre'=>$this->input->post('otroNC'),
					'motivo_reunion'=>$this->input->post('motivo'), 
					'id_responsabe'=>$this->input->post('empleados_responsable'), 
					'objetivos_reunion'=>$this->input->post('objetivo'),
					'segumiento_actas'=>$this->input->post('seguimiento'),
					'detalle_temas'=>$this->input->post('temasD'),
					'detalle_decisiones'=>$this->input->post('decisionesD'),
					'estado'=>'1'
				);	

				$query = $this->general_model->update('actas', 'id_acta', $id_acta, $registro);

				if($query == "OK"){
					if($tareasDB != $numTarea){
						$i = $tareasDB;
						while ($i <= $numTarea){
							$i++;
							$registro=array(
							
								'id_acta'=>$query, 
								'id_responsable'=>$this->input->post('idparticipanteT'.$i.''), 
								'descripcion_tarea'=>$this->input->post('tareasAsignadas'.$i.''), 						
								'fecha'=>date("Y-m-d", strtotime($this->input->post('fechaT'.$i.'')))
							);	

							$query1 = $this->general_model->insert('actas_tareas', $registro);
							
						}
					}
				
				
					echo "1";								
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}										
			}
		}

	}

	public function guardar_firma() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
								
				$fecha = date('Y-m-d H:i:s');
				$id_acta = $this->input->post('idActa');
				$usuariofirma = $this->input->post('usuariofirma');
			
				$sql_update="UPDATE actas_asistentes SET firma ='1', fecha_firma='$fecha' WHERE id_acta =".$id_acta." AND idparticipanteP='".$usuariofirma."'";
				$query = $this->general_model->consulta_select($sql_update); 
				
				if($query=="OK"){
					echo "1";								
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}										
			}
		}

	}

	public function guardar_aprobacion() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
								
				$fecha = date('Y-m-d H:i:s');
				$id_acta = $this->input->post('idActa');
				$usuariofirma = $this->input->post('usuariofirma');
			
				$sql_update="UPDATE actas_asistentes SET firma ='1', fecha_firma='$fecha' WHERE id_acta =".$id_acta." AND idparticipanteP='".$usuariofirma."'";
				$query1 = $this->general_model->consulta_select($sql_update); 

				$sql_update="UPDATE actas SET estado ='2' WHERE id_acta = ".$id_acta."";
				$query = $this->general_model->consulta_select($sql_update); 

				
				if($query=="OK"){
					echo "1";								
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}										
			}
		}
	}

	public function guardar_Observaciones() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
								
				$fecha = date('Y-m-d');
				$id_acta = $this->input->post('idActa');
				$usuarioactual= $this->input->post('usuarioActual');
				$id_responsableR = $this->input->post('usuarioResponsable');
				$nunObservaciones = $this->input->post('cantObser');
			
				$ia = $this->input->post('cantObser');
					
				$respoObservacion = $this->input->post('idempleadoObs'.$ia.'');
				
				$registro=array(							
					'id_acta'=> $id_acta, 
					'observacion'=>$this->input->post('observaciones'.$ia.''), 
					'responsable'=>$respoObservacion, 		
					'fecha_registro'=>$fecha, 
					'estado'=>'1'
				);	
				$query = $this->general_model->insert('actas_observaciones', $registro);										
				
				if($query >= 1) {
					echo "1";								
				}else{
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}										
			}
		}

	}

	private function addPdfHeader($pdf) {
	    $pdf->SetFont('helvetica','B',10);
        $pdf->SetTextColor(0,0,0);
        $pdf->Image('assets/image/acta-cecimin.PNG',25,10,160,0,'PNG');
        $pdf->Ln(30);
	}
	public function acta_pdf($id_acta) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			 // Limpiar buffers completamente

        	while (ob_get_level()) {
            	ob_end_clean();
        	}

			header('Content-Type: application/pdf; charset=UTF-8');
    		header('Cache-Control: no-cache, no-store, must-revalidate');
    		header('Pragma: no-cache');
    		header('Expires: 0');
    
		    try {

        	$this->load->library('AdvancedHtmlToPdf');
			//$this->load->library('Pdffpdf');
	        $pdf = new AdvancedHtmlToPdf ('P', 'mm', 'LETTER');
	        $pdf->tipo = "0";
	        $pdf->AliasNbPages();
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Acta de Reunión", true);
	        $pdf->SetAutoPageBreak(true, 15);
       		$pdf->SetMargins(15, 15, 15);
	         // === Página 1 ===
	        $pdf->AddPage('P', 'LETTER');
	         //Encabezado informe
	        $this->addPdfHeader($pdf);        
       		

       		$campos ='ac.id_acta, ac.fecha_reunion, ac.hora_inicio, ac.hora_final, CASE WHEN ac.lugar="1" THEN "Presencial" ELSE "Virtual (Meet)" END AS "Lugar", ac.proceso, t.nombre as "Reunion", ac.otro_nombre, ac.motivo_reunion, IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS "resposable", ca.nombre AS "Cargo", ac.objetivos_reunion, ac.segumiento_actas,  ac.detalle_temas, ac.detalle_decisiones, IFNULL(CONCAT(ep.nombres, " ", ep.apellidos)," ") AS "proyecta"';
            $query = $this->general_model->consulta_personalizada($campos, 'actas ac LEFT JOIN empleados e ON ac.id_responsabe = e.id_empleado INNER JOIN empleados ep ON ac.usuario_registro = ep.id_empleado INNER JOIN cargos ca ON e.id_cargo = ca.id_cargo INNER JOIN actas_tiporeunion t ON ac.nombre_reunion = t.id_tipo', 'ac.id_acta='.$id_acta.'', '', 0, 0);
        	
        	$data_acta = $query->result();
            
            foreach ($data_acta as $row) {

		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(55, 6, 'FECHA DE LA REUNION', 1, 0, 'C');
		        $pdf->Cell(40, 6, 'HORA INICIO', 1, 0, 'C');
		        $pdf->Cell(40, 6, 'HORA FIN', 1, 0, 'C');
		        $pdf->Cell(0, 6, 'LUGAR', 1, 1, 'C');
				$pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(55, 6,($row->fecha_reunion), 1, 0, 'C');
		        $pdf->Cell(40, 6,($row->hora_inicio), 1, 0, 'C');
		        $pdf->Cell(40, 6,($row->hora_final), 1, 0, 'C');
		        $pdf->Cell(0, 6,utf8_decode($row->Lugar), 1, 1, 'C');
		        $pdf->Ln(5);

		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(70, 6, 'PROCESO O AREA', 1, 0, 'L');
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(0, 6, utf8_decode($row->proceso), 1, 1, 'L');
		        
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(70, 6, 'NOMBRE DEL COMITE O REUNION', 1, 0, 'L');
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(0, 6, utf8_decode($row->Reunion), 1, 1, 'L');
		        
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(70, 6, 'MOTIVO DEL COMITE O REUNION', 1, 0, 'L');
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->MultiCell(0, 6, utf8_decode($row->motivo_reunion), 1,  'L');
		        $pdf->Ln(5);

	       		//Responsable
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(70, 6, 'NOMBRE DEL RESPONSABLE', 1, 0, 'L');
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(0, 6, utf8_decode($row->resposable), 1, 1, 'L');
		        
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(70, 6, 'CARGO DEL RESPONSABLE', 1, 0, 'L');
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(0, 6, utf8_decode($row->Cargo), 1, 1, 'L');
		        $pdf->Ln(5);

		        //DESARROLLO DE LA REUNION
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->SetFillColor(200,220,255);
		        $pdf->Cell(0, 6, 'DESARROLLO', 1, 1, 'C',true);
		        $pdf->SetFillColor(0,0,0);
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(0, 6, 'OBJETIVO DE LA REUNION', 1, 1, 'L'); 
		        $pdf->SetFont('Arial', '', 11);
		        $pdf->MultiCell(0, 6, utf8_decode($row->objetivos_reunion), 'LTRB', 'L');
		       
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(0, 6, 'SEGUIMIENTO ACTAS ANTERIORES','LTRB', 1, 'L');
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(0, 6, utf8_decode($row->segumiento_actas), 'LTRB', 1, 'L');
		        
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(0, 6, 'TEMAS TRATADOS', 'LTRB', 1, 'L');
		        $pdf->SetFont('Arial', '', 11);
		        if (!mb_check_encoding($row->detalle_temas, 'UTF-8')) {
    				$row->detalle_temas = mb_convert_encoding($row->detalle_temas, 'UTF-8');
				}
		        
	            $pdf->procesarContenidoCompleto($row->detalle_temas);

		        $pdf->Ln(5);
		         //DECISIONES 
		        $pdf->SetFont('Arial', 'B', 10);
		        $pdf->Cell(0, 6, 'DECISIONES', 'LTRB', 1, 'L');
		        $pdf->SetFont('Arial', '', 11);
		        $pdf->MultiCell(0, 6, utf8_decode($row->detalle_decisiones), 'LTRB', 'L');
		        $pdf->Ln(5);
		        
                
                if($pdf->GetY() > 180) { // Ajustar para romper la página antes del final
					$pdf->AddPage('P', 'LETTER');
                	$this->addPdfHeader($pdf);
	            }   
			       
		       		
	       		//TAREAS
	       		
	       		$pdf->SetFont('Arial', 'B', 9);
		        $pdf->SetFillColor(200,220,255);
		        $pdf->Cell(0, 6, 'TAREAS ASIGNADAS','LTRB', 1, 'C',true);        
		        // Cabecera de la tabla
		        $pdf->SetFillColor(0,0,0);
		        $pdf->Cell(10, 6, 'No.', 1, 0, 'C');
		        $pdf->Cell(58, 6, 'RESPONSABLE', 1, 0, 'C');
		        $pdf->SetFont('Arial', 'B', 9);
		        $pdf->Cell(102, 6, 'DESCRIPCION DE TAREAS ASIGNADAS Y COMPROMISOS', 1, 0, 'C');
		        $pdf->SetFont('Arial', 'B', 9);	
		        $pdf->Cell(0, 6, 'FECHA', 1, 1, 'C');
	

                $campos_tareas ='act.id_tarea AS "id_tarea", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Responsable", act.descripcion_tarea AS "Tarea", act.fecha AS "Fecha"';
                $query_tarea = $this->general_model->consulta_personalizada($campos_tareas, 'actas_tareas act INNER JOIN empleados em ON act.id_responsable=em.id_empleado', 'act.id_acta='.$id_acta.'', '', 0, 0);

                $data_tareas = $query_tarea->result();
                $cont = 0;

                // Primero, calculamos la altura máxima necesaria para cada fila
				$alturas = [];
				foreach ($data_tareas as $row1) {
				    // Calcular número de líneas que ocupará la tarea
				    $pdf->SetFont('Arial', '', 8);
				    $numLineas = $pdf->NbLines(102, utf8_decode($row1->Tarea));
				    $alturas[] = $numLineas * 5; // 5 es la altura de línea
				}

                foreach ($data_tareas as $index => $row1) {
				    $cont++;
				    $alturaFila = max(5, $alturas[$index]); // Mínimo 5mm de altura
				    
				    // Número
				    $pdf->SetFont('Arial', '', 8);
				    $pdf->Cell(10, $alturaFila, $cont, 1, 0, 'C');
				    
				    // Responsable
				    $pdf->Cell(58, $alturaFila, utf8_decode($row1->Responsable), 1, 0, 'L');
				    
				    // Tarea (Multicell)
				    $x = $pdf->GetX();
				    $y = $pdf->GetY();
				    $pdf->MultiCell(102, 5, utf8_decode($row1->Tarea), 1, 'L');
				    
				    // Ajustar posición para las siguientes celdas
				    $nuevaY = $pdf->GetY();
				    $pdf->SetXY($x + 102, $y);
				    
				    // Fecha
				    $pdf->Cell(0, $alturaFila, utf8_decode($row1->Fecha), 1, 1, 'C');
				    
				    // Asegurarnos de que el cursor queda en la posición correcta
				    $pdf->SetY($nuevaY);
				}

                if($cont<3){
                    // Filas vacías
                    for ($i = 1; $i <= $cont; $i++) {
                        $pdf->Cell(10, 6, $cont+$i, 1, 0, 'C');
                        $pdf->Cell(58, 6, '', 1, 0, 'L');
                        $pdf->Cell(102, 6, '', 1, 0, 'L');
                        $pdf->Cell(0, 6, '', 1, 1, 'C');
                    }
                }
		        $pdf->Ln(5);

		        $campos_part ='id_asistentes AS "Id", asistente AS "Asistente", idparticipanteP AS "idparticipanteP", cargo AS "Cargo", firma AS "Firma", DATE(fecha_firma) AS "Fecha_Firma"';
				$query_part = $this->general_model->consulta_personalizada($campos_part,'actas_asistentes',' id_acta = "'.$id_acta.'" ', '', 0, 0);

				$data_part = $query_part->result();

				$contp = 0;

		        //PARTICIPANTES
		        $pdf->SetFont('Arial', 'B', 8);
		        $pdf->SetFillColor(200,220,255);
		        $pdf->Cell(0, 6, 'PARTICIPANTES', 1, 1, 'C',true);
		        		        
		        // Cabecera de la tabla
		        $pdf->SetFillColor(0,0,0);
		        $pdf->Cell(10, 6, 'No.', 1, 0, 'C');
		        $pdf->Cell(70, 6, 'NOMBRE Y APELLIDO', 1, 0, 'C');
		        $pdf->Cell(90, 6, 'CARGO', 1, 0, 'C');
		        $pdf->Cell(0, 6, 'FIRMA', 1, 1, 'C');
		        
		        foreach ($data_part as $row1) {
		        	$contp++;
		        // Fila 1
			        $pdf->SetFont('Arial', '', 8);
			        $pdf->Cell(10, 6, $contp, 1, 0, 'C');
			        $pdf->Cell(70, 6, utf8_decode($row1->Asistente), 1, 0, 'L');
			        $pdf->Cell(90, 6, utf8_decode($row1->Cargo), 1, 0, 'L');
			        $pdf->SetFont('Arial', 'B', 6);
			        $pdf->Cell(0, 6, utf8_decode($row1->Fecha_Firma), 1, 1, 'C');
			        
			    }    
		        
		        // Fila vacía
		        $pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(10, 6, '4', 1, 0, 'C');
		        $pdf->Cell(70, 6, '', 1, 0, 'L');
		        $pdf->Cell(90, 6, '', 1, 0, 'L');
		        $pdf->Cell(0, 6, '', 1, 1, 'C');
		        $pdf->Ln(7);
		        // FINAL DE ACTA 
				$pdf->SetFont('Arial', '', 10);
		        $pdf->Cell(0, 6, 'Proyectada por: '.utf8_decode($row->proyecta), 0, 1, 'L');
		        $pdf->Ln(15);

		        $pdf->SetFont('Arial', '', 10);

		        date_default_timezone_set('America/Bogota');
				setlocale(LC_TIME, 'es_ES.UTF-8'); // Configurar localización en español

				$fecha = new DateTime($row->fecha_reunion);
				$fecha_acta = strftime('%d de %B de %Y', $fecha->getTimestamp());

				$pdf->Cell(0, 6, utf8_decode('Para constancia se firma el día ').$fecha_acta.'.', 0, 1, 'L');
	        	
	        // Salida del PDF
	        $pdf->Output('acta_reunion.pdf', 'I');
	      }
	      } catch (Exception $e) {
		        die("Error al generar el PDF: " . $e->getMessage());
		  }

		}//-Valida Inicio de Session
	}

	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('P', 'mm', 'LETTER');
	        $pdf->AliasNbPages();
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Listado de Solicitudes", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('P', 'LETTER');
            
            $pdf->Ln(10);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE SOLICITUDES'), 0, 0, 'C', false);
            $pdf->Ln(10);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(195,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(5);

            $campos =' d.tipo_solicitud AS "Tipo", td.nombre AS "TipoDocumento", d.nombre_documento AS "Nombre", p.nombre AS "Proceso", IFNULL(CONCAT(e.nombres, e.apellidos),"") AS "Responsable", d.fecha AS "Fecha_Solicitud" CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
            $query = $this->general_model->consulta_personalizada($campos, 'solicitud_documentos d LEFT JOIN  procesos p ON d.id_proceso = p.id_proceso LEFT JOIN empleados e ON p.id_responsable = e.id_empleado LEFT JOIN tipos_documentos td ON td.id_tipo = d.id_tipo_documento', '', 'd.fecha', 0, 0);

            $encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Cell(15,5,utf8_decode("TIPO DE SOLICITUD"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("TIPO DE DOCUMENTO"),'LTRB',0,'C',$fill);
			$pdf->Cell(50,5,utf8_decode("NOMBRE"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("PROCESO"),'LTRB',0,'C',$fill);
			$pdf->Cell(50,5,utf8_decode("RESPONSABLE"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("FECHA"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(4,5,' ',0,0,'C',false);
                $pdf->Cell(15,5,($row->Tipo),'LTRB',0,'C',$fill);
                $pdf->Cell(15,5,utf8_decode($row->TipoDocumento),'LTRB',0,'C',$fill);
                $pdf->Cell(50,5,utf8_decode($row->Nombre),'LTRB',0,'C',$fill);                
                $pdf->Cell(25,5,utf8_decode($row->Proceso),'LTRB',0,'C',$fill);
                $pdf->Cell(50,5,utf8_decode($row->Responsable),'LTRB',0,'C',$fill);
                $pdf->Cell(15,5,utf8_decode($row->Fecha_Solicitud),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(4,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Solicitudes.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$usuario = $this->session->userdata('C_id_usuario');
			$filename = "Listado_actas.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL ACTAS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_actasR_tabla('EXCEL',$usuario)); 
            echo '</table>';			
		}//-Valida Inicio de Session
	}

	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $this->input->post('idreg'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
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

				$campos = ' d.tipo_solicitud AS "Tipo", td.nombre AS "TipoDocumento", d.nombre_documento AS "Nombre", p.nombre AS "Proceso", IFNULL(CONCAT(e.nombres, " " e.apellidos, " "),"") AS "Responsable", d.fecha AS "Fecha_Solicitud" CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'solicitud_documentos d LEFT JOIN  procesos p ON d.id_proceso = p.id_proceso LEFT JOIN empleados e ON p.id_responsable = e.id_empleado LEFT JOIN tipos_documentos td ON td.id_tipo = d.id_tipo_documento', ' d.id_solicitud = "'.$idreg.'" ', '', 0, 0);
		      
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

	public function cargar_asistentes(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id_acta = $this->input->post('idActa');

				$campos ='id_asistentes AS "Id", asistente AS "Asistente", idparticipanteP AS "idparticipanteP", cargo AS "Cargo", firma AS "Firma", fecha_firma AS "Fecha Firma"';
				$query = $this->general_model->consulta_personalizada($campos,'actas_asistentes',' id_acta = "'.$id_acta.'" ', '', 0, 0);

				$tabla ='';
				$cont =1;	
				foreach ($query->result_array() as $row)
				{
										
					$tabla .='<tr><td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><span>'.$cont.'</span></td><td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><input type="text" name="participanteP'.$cont.'" id="participanteP'.$cont.'" autocomplete="off" placeholder="Nombres y Apellidos" class="form-control col-sm-12" readonly="readonly", value="'.$row['Asistente'].'"><input type="hidden" name="idparticipanteP'.$cont.'" id="idparticipanteP'.$cont.'" autocomplete="off" value="'.$row['idparticipanteP'].'"></td><td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><input type="text" id="cargo'.$cont.'" name="cargo'.$cont.'" autocomplete="off" class="form-control col-sm-12" readonly="readonly", value="'.$row['Cargo'].'"></td>';

					if($row['Firma']=="0"){
						$tabla .='<td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><input type="checkbox" id="checkboxFirma_'.$cont.'" name="checkboxFirma_'.$cont.'" class="input-lg bgc-blue"><input type="hidden" name="idusuarioFir'.$cont.'" id="idusuarioFir'.$cont.'" autocomplete="off" value="00"></td>';
					}else{
						$tabla .='<td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><input type="checkbox" id="checkboxFirma_'.$cont.'" name="checkboxFirma_'.$cont.'" class="input-lg bgc-blue", checked><input type="hidden" name="idusuarioFir'.$cont.'" id="idusuarioFir'.$cont.'" autocomplete="off" value="'.$row['idparticipanteP'].'"></td>';
					}

					$tabla .='<td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><a href="javascript:void(0)" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger"><i class="fa fa-trash-alt"></i></a></td></tr>';
					$cont++;
				}	
				$tabla .='<input type="hidden" name="cantPart" value="'.$cont.'" id="cantPart">';
				echo $tabla;
			}
		}
	}

	public function cargar_tareas(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id_acta = $this->input->post('idActa');

				$campos1 ='act.id_tarea AS "Id", act.id_responsable AS "id_responsable", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Funcionario", act.descripcion_tarea AS "DescripcionT", act.fecha AS "Fecha"';
				$query1 = $this->general_model->consulta_personalizada($campos1,'actas_tareas act INNER JOIN empleados em ON act.id_responsable = em.id_empleado','act.id_acta = "'.$id_acta.'" ', '', 0, 0);

				
				$cont = 0;	
				$tabla ='';
				foreach ($query1->result_array() as $row1)
				{
					$cont++;
					$tabla .='<tr><td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"> <span>'.$cont.'</span></td>
					<td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><input type="hidden" name="idparticipanteT'.$cont.'" id="idparticipanteT'.$cont.'" value="'.$row1['id_responsable'].'"><input type="text" name="participanteT'.$cont.'" id="participanteT'.$cont.'" class="form-control col-sm-12" value="'.$row1['Funcionario'].'" readonly="readonly">
					</td>
					<td><textarea rows="2" id="tareasAsignadas'.$cont.'" name="tareasAsignadas'.$cont.'" autocomplete="off" placeholder="Describa la tarea asignada" class="form-control col-sm-12" value='.$row1['DescripcionT'].' readonly="readonly">'.$row1['DescripcionT'].'</textarea></td>
					<td><input type="date" id="fechaT'.$cont.'" name="fechaT'.$cont.'" class="form-control tinyDate col-sm-8" value="'.$row1['Fecha'].'", readonly="readonly">
					</td>
					<td><a href="javascript:void(0)" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger", id="eliminarTa_'.$row1['Id'].'">
							<i class="fa fa-trash-alt",id="eliminarTa_'.$row1['Id'].'"></i>
						</a>
					</td>	
					</tr>';
					
				}	
				$tabla .='<input type="hidden" name="cantTarea" value="'.$cont.'" id="cantTarea">';
				echo $tabla;
			}
		}

	}

	public function cargar_observaciones(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id_acta = $this->input->post('idActa');

				$campos ='act.id_observacion AS "Id", act.observacion AS "Observaciones", act.responsable AS "Id_responsabe", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Funcionario", DATE(act.fecha_registro) AS "Fecha"';
				$query = $this->general_model->consulta_personalizada($campos,'actas_observaciones act INNER JOIN empleados em ON act.responsable = em.id_empleado ','act.id_acta = "'.$id_acta.'" ', '', 0, 0);

				$cont = 0;	
				$tabla ='';
				foreach ($query->result_array() as $row)
				{
					$cont++;
					$tabla .='<tr><td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"> <span>'.$cont.'</span></td>
					<td class="border-0 bgc-white bgc-h-grey-l3 shadow-sm text-center pr-0"><input type="hidden" name="Id_observaciones'.$cont.'" id="Id_observaciones'.$cont.'" value="'.$row['Id'].'"><input type="text" name="observaciones'.$cont.'" id="observaciones'.$cont.'" class="form-control col-sm-12" value="'.$row['Observaciones'].'" readonly="readonly">
					</td>
					<td><input type="text" name="empleadoObs'.$cont.'" id="empleadoObs'.$cont.'" autocomplete="off" placeholder="Nombres y Apellidos" class="form-control col-sm-12" readonly="readonly", value="'.$row['Funcionario'].'"><input type="hidden" name="idempleadoObs'.$cont.'" id="idempleadoObs'.$cont.'" autocomplete="off" value="'.$row['Id_responsabe'].'"></td>
					
					<td><a href="javascript:void(0)" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger", id="eliminarObs_'.$row['Id'].'", name="eliminarObs_'.$row['Id'].'">
							<i class="fa fa-trash-alt",id="eliminarObs_'.$row['Id'].'_'.$id_acta.'", name="eliminarObs_'.$row['Id'].'_'.$id_acta.'"></i>
						</a>
					</td>	
					</tr>';
					
				}	
				$tabla .='<input type="hidden" name="cantObser" value="'.$cont.'" id="cantObser">';
				$tabla .='<input type="hidden" name="newObser" value="0" id="newObser">';
				echo $tabla;
			}
		}

	}

	public function eliminar_observaciones(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id_observacion = $this->input->post('idObser');

				$registro=array(							
					'id_observacion'=> $id_observacion
				);	

				$query = $this->general_model->delete('actas_observaciones',$registro);
			}
		}
	}

	public function cargarCargo(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				header('Content-Type: application/json');
				$id_emprleado = $this->input->post('idreg');

				$query = $this->general_model->consulta_personalizada('c.nombre','empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo', 'e.estado = "1" AND e.id_empleado ="'.$id_emprleado.'"', '', 0, 0);

				$row = $query->row_array();

				$arr['cargo'] = array('nombre'=>$row['nombre']);
											
				echo json_encode($arr);	
			} //-Valida Envio por ajax	
		}
	}


	public function cargar_select_empleados(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
			
				$campos='id_empleado AS "Id", IFNULL(CONCAT(nombres, " ", apellidos),"") AS "Empleado"';
				$query = $this->general_model->consulta_personalizada($campos,'empleados', 'estado = "1"', '', 0, 0);

				$arr = '<option value="" selected>NO APLICA</option>';

				foreach($query->result_array() as $row) {
					$arr .= '<option value="'.$row['Id'].'">'.$row['Empleado'].'</option>';
				}								
				echo $arr;	
			} //-Valida Envio por ajax	
		}
	}
	
}