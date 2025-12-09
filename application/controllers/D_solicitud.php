<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class D_solicitud extends CI_Controller {
	
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
	
	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {

			$this->session->set_userdata('archivo_origen','');
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Solicitudes";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='solicitud/nuevo';
			$data_usua['entrada_js']='_js/solicitud.js';
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


	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$this->session->set_userdata('archivo_origen','');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo','');
			// $this->session->set_userdata('archivo_visual_tipo','');

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Solicitudes";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='solicitud/index';
			$data_usua['entrada_js']='_js/solicitud.js';
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

	public function modificar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$this->session->set_userdata('archivo_origen','');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo','');

			$data_usua['c_id_solicitud'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_tipo_solicitud'] = '';			
			$data_usua['c_id_tipo_documento'] = '';
			$data_usua['c_nombre_documento'] = '';
			$data_usua['c_id_macroproceso'] = '';
			$data_usua['c_id_proceso'] = '';
			$data_usua['c_id_subproceso'] = '';
			$data_usua['c_id_responsable'] = '';
			$data_usua['c_justificacion'] = '';
			$data_usua['c_documento_relacionado'] = '';
			$data_usua['c_origen_formato'] = '';
			$data_usua['c_id_revisado_por'] = '';
			$data_usua['c_id_aprabo_por'] = '';
			$data_usua['c_archivo_original'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';
			$data_usua['c_correo_usuario_de'] = '';
			$data_usua['c_correo_usuario_para'] = '';
			$data_usua['c_nombre_usuario_de'] = '';
			$data_usua['c_NOMBRE_usuario_para'] = '';

			$query=$this->general_model->select_where('tipo_solicitud, id_tipo_documento, nombre_documento, id_macroproceso, id_proceso,id_subproceso,id_responsable,justificacion,documento_relacionado,origen_formato,id_revisado_por,id_aprabo_por,archivo_original,estado, id_usuario','solicitud_documentos',array('id_solicitud' => $id));
			foreach ($query->result_array() as $row)
			{
				
				$data_usua['c_tipo_solicitud'] = $row['tipo_solicitud'];
				$data_usua['c_id_tipo_documento'] = $row['id_tipo_documento'];
				$data_usua['c_nombre_documento'] = $row['nombre_documento'];
				$data_usua['c_id_macroproceso'] =$row['id_macroproceso'];
				$data_usua['c_id_proceso'] =$row['id_proceso'];
				$data_usua['c_id_subproceso'] =$row['id_subproceso'];
				$data_usua['c_id_responsable'] = $row['id_responsable'];
				$data_usua['c_justificacion'] = $row['justificacion'];
				$data_usua['c_documento_relacionado'] =$row['documento_relacionado'];
				$data_usua['c_origen_formato'] = $row['origen_formato'];
				$data_usua['c_id_revisado_por'] =$row['id_revisado_por'];
				$data_usua['c_id_aprabo_por'] = $row['id_aprabo_por'];
				$data_usua['c_archivo_original'] = $row['archivo_original'];
				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_id_usuario'] = $row['id_usuario'];
			}

			$campos0 = ' p.id_proceso, p.nombre ';
			$query = $this->general_model->consulta_personalizada($campos0, 'procesos p','p.id_macroproceso = "'.$row['id_macroproceso'].'" AND estado = "1" ', 'p.nombre', 0, 0);
			//echo $this->db->last_query();
			$data_usua['c_opc_proceso'][0] = 'Seleccione un Proceso....';
			foreach($query->result_array() as $row0) {
				$data_usua['c_opc_proceso'][$row0['id_proceso']] = $row0['nombre'];
			} 

			$campos1 = ' sp.id_subproceso, sp.nombre ';
			$query = $this->general_model->consulta_personalizada($campos1, 'subprocesos sp','sp.id_proceso = "'.$row['id_proceso'].'" AND estado = "1" ', 'sp.nombre', 0, 0);
			//echo $this->db->last_query();
			$data_usua['c_opc_subproceso'][0] = 'Seleccione un Subproceso....';
			foreach($query->result_array() as $row2) {
				$data_usua['c_opc_subproceso'][$row2['id_subproceso']] = $row2['nombre'];
			} 

			$campos = ' d.id_documento, d.nombre ';
			$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_subproceso = "'.$row['id_subproceso'].'" AND estado = "1" ', 'd.nombre', 0, 0);
			//echo $this->db->last_query();
			$data_usua['c_opc_docrelacionado'][0] = 'Seleccione un Documento';
			foreach($query->result_array() as $row1) {
				$data_usua['c_opc_docrelacionado'][$row1['id_documento']] = $row1['nombre'];
			}	

				
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Modificacion de Solicitud";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='solicitud/modificar';
			$data_usua['entrada_js']='_js/solicitud.js';
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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    		';

			$this->load->view('template',$data_usua);
		}
	}

	public function revisar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {

			
			$data_usua['c_id_solicitud'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_tipo_solicitud'] = '';			
			$data_usua['c_id_tipo_documento'] = '';
			$data_usua['c_nombre_documento'] = '';
			$data_usua['c_id_proceso'] = '';
			$data_usua['c_id_subproceso'] = '';
			$data_usua['c_id_responsable'] = '';
			$data_usua['c_justificacion'] = '';
			$data_usua['c_documento_relacionado'] = '';
			$data_usua['c_origen_formato'] = '';
			$data_usua['c_id_revisado_por'] = '';
			$data_usua['c_id_aprabo_por'] = '';
			$data_usua['c_archivo_original'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$query=$this->general_model->select_where('tipo_solicitud, id_tipo_documento, nombre_documento, id_proceso, id_subproceso, id_responsable, justificacion, documento_relacionado, origen_formato, id_revisado_por, id_aprabo_por, archivo_original, estado, id_usuario','solicitud_documentos',array('id_solicitud' => $id));
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_tipo_solicitud'] = $row['tipo_solicitud'];
				$data_usua['c_id_tipo_documento'] = $row['id_tipo_documento'];
				$data_usua['c_nombre_documento'] = $row['nombre_documento'];
				$data_usua['c_id_proceso'] =$row['id_proceso'];
				$data_usua['c_id_subproceso'] =$row['id_subproceso'];
				$data_usua['c_id_responsable'] = $row['id_responsable'];
				$data_usua['c_justificacion'] = $row['justificacion'];
				$data_usua['c_documento_relacionado'] =$row['documento_relacionado'];
				$data_usua['c_origen_formato'] = $row['origen_formato'];
				$data_usua['c_id_revisado_por'] =$row['id_revisado_por'];
				$data_usua['c_id_aprabo_por'] = $row['id_aprabo_por'];				
				$data_usua['c_archivo_original'] = $row['archivo_original'];
				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_id_usuario'] = $row['id_usuario'];
			}		


			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Revisar de Solicitud";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='solicitud/revisar';
			$data_usua['entrada_js']='_js/solicitud.js';
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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
    		';

			$this->load->view('template',$data_usua);
		}
	}

	public function aprobar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {

			$this->session->set_userdata('archivo_origen','');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo','');

			$data_usua['c_id_solicitud'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_tipo_solicitud'] = '';			
			$data_usua['c_id_tipo_documento'] = '';
			$data_usua['c_nombre_documento'] = '';
			$data_usua['c_id_proceso'] = '';
			$data_usua['c_id_subproceso'] = '';
			$data_usua['c_id_responsable'] = '';
			$data_usua['c_justificacion'] = '';
			$data_usua['c_documento_relacionado'] = '';
			$data_usua['c_origen_formato'] = '';
			$data_usua['c_id_revisado_por'] = '';
			$data_usua['c_id_aprabo_por'] = '';
			$data_usua['c_archivo_original'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$query=$this->general_model->select_where('tipo_solicitud, id_tipo_documento, nombre_documento, id_proceso,id_subproceso,id_responsable,justificacion,documento_relacionado,origen_formato,id_revisado_por,id_aprabo_por,archivo_original,estado, id_usuario','solicitud_documentos',array('id_solicitud' => $id));
			foreach ($query->result_array() as $row)
			{
				
				$data_usua['c_tipo_solicitud'] = $row['tipo_solicitud'];
				$data_usua['c_id_tipo_documento'] = $row['id_tipo_documento'];
				$data_usua['c_nombre_documento'] = $row['nombre_documento'];
				$data_usua['c_id_proceso'] =$row['id_proceso'];
				$data_usua['c_id_subproceso'] =$row['id_subproceso'];
				$data_usua['c_id_responsable'] = $row['id_responsable'];
				$data_usua['c_justificacion'] = $row['justificacion'];
				$data_usua['c_documento_relacionado'] =$row['documento_relacionado'];
				$data_usua['c_origen_formato'] = $row['origen_formato'];
				$data_usua['c_id_revisado_por'] = $row['id_revisado_por'];
				$data_usua['c_id_aprabo_por'] = $row['id_aprabo_por'];							
				$data_usua['c_archivo_original'] = $row['archivo_original'];
				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_id_usuario'] = $row['id_usuario'];
			}		


			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Aprobar de Solicitud";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='solicitud/aprobar';
			$data_usua['entrada_js']='_js/solicitud.js';
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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
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
				echo listar_solicitudes_tabla('WEB',$usuario);
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
				$proceso = NULL;
				$subproceso = NULL;
				$capacitacion = $this->input->post('capacitacion');
				
				if ($this->input->post('proceso')!= "999"){
					$proceso = $this->input->post('proceso');
				}

				if ($this->input->post('subproceso')!= "999"){
					$subproceso = $this->input->post('subproceso');
				}
				
				// ------------- QUIEN REVISA ----------- //
				$qrevisa = $this->input->post('empleadosMR_revisa');
				$val_qrevisa = implode(',', (array) $qrevisa);

				// ----------- DOCUMENTO RELACIONADO ----------- //
				if($this->input->post('idckdocre')=="Si"){		
					$docrela = $this->input->post('doc_relacionado');
				}else{
					$docrela = NULL;
				}	

				//QUIEN APRUEBA
				$qaprueba = $this->input->post('empleadosMR_aprueba');
				$val_qaprueba = implode(',', (array) $qaprueba);

				//FORMATO ORIGEN
				
				$origenFo = null;

				if($this->input->post('tipodocumentos_solicitud')=="FO"){
					$origenFo = $this->input->post('origen_formato');
				}

				// ----------- ESTABLECER LA RUTA DONDE SE VA A GUARDAR EL ARCHIVO ----------- //
				
				$dir = $this->input->post('tipodocumentos_solicitud');

			 	if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/fuente/')) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/fuente/', 0777, true);
				 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/', 0777, true);
					 	}
				 	}
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/fuente/')) {
				 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/fuente/', 0777, true);
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/')) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/', 0777, true);
			 	}

				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/';  
				$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/';
				
				// ---------- CARGAR ARCHIVO VISUAL ----------- //
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];
				
				$this->load->library("upload",$config);
				if ($this->upload->do_upload('archivoorig')){
					$data = array('upload_data' => $this->upload->data());
					$filename = $rutag.$data['upload_data']['file_name'];
				}else{
					//echo $this->upload->display_errors($ruta);
					$filename ="";
				}
					$id_solicitud ="";
					$fecha = date('Y-m-d H:i:s');

					$registro=array(
						
						'tipo_solicitud'=>$this->input->post('tipo_solicitud'), 
						'id_tipo_documento'=>$this->input->post('tipodocumentos_solicitud'), 
						'id_documento'=>$this->input->post('iddocumento'),
						'nombre_documento'=>$this->input->post('nombre'), 						
						'id_macroproceso'=>$this->input->post('macroprocesos_solicitud'), 
						'id_proceso'=>$proceso, 
						'id_subproceso'=>$subproceso, 
						'id_responsable'=>$this->input->post('empleados_autor'), 
						'justificacion'=>$this->input->post('justificacion'), 
						'documento_relacionado'=>$docrela,
						'origen_formato'=>$origenFo,
						'id_revisado_por'=>$val_qrevisa, 
						'id_aprabo_por'=>$val_qaprueba, 
						'archivo_original'=>$filename,
						'capacitacion'=>$capacitacion,		
						'fecha'=>$fecha, 
						'id_usuario'=>$this->session->userdata('C_id_usuario'), 
						'estado'=>'0'
					);				

					$query1 = $this->general_model->insert('solicitud_documentos', $registro);
					
					// ------------- GUARDAR NOTIFICACIÓN -----------// 
					
					if($query1 >= 1) {
						$id_solicitud = $query1;
						$tipo_notificacion="0";
						$id_usuario_notifica = $this->session->userdata('C_id_usuario');
						$id_usuario_2= 571;
						if ($this->input->post('tipo_solicitud')==1){
							$observacion ="Solicitud de Creación documento ".$this->input->post('nombre').", Solicitud N°".$query1;
						} elseif ($this->input->post('tipo_solicitud')==2){
							$observacion ="Solicitud de Modificación documento ".$this->input->post('nombre').", Solicitud N°".$query1;
						} else {						
							$observacion ="Solicitud de Eliminación documento ".$this->input->post('nombre').", Solicitud N°".$query1;
						}	

						$registro2=array(
							'tipo_notificacion'=>$tipo_notificacion,
							'id_solicitud' =>$id_solicitud,
							'id_usuario_notifica'=>$id_usuario_notifica, 
							'id_usuario_2'=>$id_usuario_2, 
							'observacion'=>$observacion, 
							'estado'=>'0',
							'fecha_registro'=>$fecha				
						);

						$query2 = $this->general_model->insert('notificaciones', $registro2);
						 //Guardar Tarea
					}

					// ------ GUARDAR TAREA ----------//
					if($query2 >= 1) {
						
						$descripcion="";
						$id_usuario_asigna = $this->session->userdata('C_id_usuario');
						$id_usuario_tarea = 571;
						if($this->input->post('tipo_solicitud')==1){
							$descripcion ="Gestionar Solicitud documento ".$this->input->post('nombre').", Solicitud N°".$query1;
						}elseif($this->input->post('tipo_solicitud')==2){
							$descripcion ="Gestionar modificacion documento ".$this->input->post('nombre').", Solicitud N°".$query1;
						}else{						
							$descripcion ="Gestionar Solicitud N°".$this->input->post('idreg');
						};								

						$registro3=array(
							'tipo_tarea' =>'Gestionar Solicitud',
							'id_modulo' =>'0',
							'descripcion'=>$descripcion, 
							'id_solicitud' =>$id_solicitud,
							'id_usuario_asigna'=>$id_usuario_asigna, 
							'id_usuario_tarea'=>$id_usuario_tarea, 							
							'estado'=>'0',
							'fecha_registro'=>$fecha
						);
						
						$query = $this->general_model->insert('tareas', $registro3);
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

	public function guardar_revision() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				///QUIEN APRUEBA
				///
				$tipo_notificacion="0";
				$id_usuario_notifica = $this->session->userdata('C_id_usuario');
				$qaprueba = $this->input->post('idusuarioaprueba');
				$val_qaprueba = implode(',', (array) $qaprueba);

				$id_proceso = $this->input->post('idproceso');	
				
				$dir = $this->input->post('tipodocumentos_solicitud');

				$id_solicitud = $this->input->post('idreg');	


				$fecha = date('Y-m-d H:i:s');

				$registro=array(
					'id_solicitud'=>$id_solicitud, 
					'observacion'=>$this->input->post('observaciones'), 					
					'fecha_registro'=>$fecha, 
					'id_usuario'=>$this->session->userdata('C_id_usuario')
									
				);

				$query = $this->general_model->insert('solicitud_revision', $registro);
				echo "1";
				//Actualiza el Estado a la Solicitud
				if($query >= 1){

					$registro1=array(
						'estado'=>'1'
					);

					$idrevision ='';
					$campos= 'id_revision';

					$query1 = $this->general_model->consulta_personalizada($campos,'checklist_revision_sol',' id_solicitud = "'.$id_solicitud.'" AND id_quien_revisa = "'.$this->session->userdata('C_id_usuario').'"','', 0, 0);
					foreach ($query1->result_array() as $row){
						
						$idrevision =$row['id_revision'];
					}

					$query = $this->general_model->update('checklist_revision_sol', 'id_revision', $idrevision, $registro1);
					
				}
					
				if($query == "OK"){

					if($this->input->post('archivoorig') != "") {
						//CARGAR ARCHIVO VISUAL				
						$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/'; 
						$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/';
						
						$config = [
							"upload_path" => $ruta,
							"allowed_types" => "*"
						];
			
						$this->load->library("upload",$config);
						if ($this->upload->do_upload('archivoorig')){
							$data = array('upload_data' => $this->upload->data());

							$registro1=array(							
								'archivo_original'=>$rutag+$data['upload_data']['file_name']
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);

							
						}else{
							echo $this->upload->display_errors($ruta);
						}
					}						
				}
					
				if($query == "OK"){

					$campos1 ='id_quien_revisa AS "quien_revisa", estado AS "revisado"';
					$query = $this->general_model->consulta_personalizada($campos1,'checklist_revision_sol',' id_solicitud = "'.$id_solicitud.'" ', '', 0, 0);
					$i = 0;
					$j = 0;
					
					foreach ($query->result_array() as $row){
						
						if($row['revisado']=='1'){
							$j++;
						}
						$i++;
					}
					
					if($i==$j){

						$tipo_notificacion="0";
						$id_usuario_notifica = $this->session->userdata('C_id_usuario');
						$id_usuario_asigna = $this->session->userdata('C_id_usuario');
						$id_proceso = $this->input->post('idproceso');	

						$id_usuario_2 = explode(",", $val_qaprueba);
						$tipo_tarea ="Gestionar Aprobación";
						$observacion ="Solicitud N°".$id_solicitud." pasa a aprobación";
						
						if($this->input->post('estado')==3){
							
							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){
								if(is_array($id_usuario_2)){
	        						foreach ($id_usuario_2 as $value) {
	     							    $usuario2 =	$value;			            
										$registro2=array(
											'tipo_notificacion'=>$tipo_notificacion, 
											'id_solicitud' =>$id_solicitud,
											'id_usuario_notifica'=>$id_usuario_notifica, 
											'id_usuario_2'=>$usuario2, 
											'observacion'=>$observacion, 
											'estado'=>'0',
											'fecha_registro'=>$fecha
										);

										$query = $this->general_model->insert('notificaciones', $registro2);

										if($query >= 1){
											$registro3=array(
												'tipo_tarea' =>$tipo_tarea,
												'id_modulo'=>"0",
												'descripcion'=>$observacion, 
												'id_solicitud' =>$id_solicitud,
												'id_usuario_asigna'=>$id_usuario_asigna, 
												'id_usuario_tarea'=>$usuario2,
												'estado'=>'0',
												'fecha_registro'=>$fecha
											);
											$query = $this->general_model->insert('tareas', $registro3);
							          	}						        	
							        }    
							       
							    }else{
							        foreach ((array)$id_usuario_2 as $value) {
							         	$usuario2 =	$value;		
							            $registro2=array(
											'tipo_notificacion'=>$tipo_notificacion, 
											'id_solicitud' =>$id_solicitud,
											'id_usuario_notifica'=>$id_usuario_notifica, 
											'id_usuario_2'=>$usuario2, 
											'observacion'=>$observacion, 
											'estado'=>'0',
											'fecha_registro'=>$fecha
										);

										$query= $this->general_model->insert('notificaciones', $registro2);

										if($query >= 1){
											$registro3=array(
												'tipo_tarea' =>$tipo_tarea,
												'id_modulo'=>"0",
												'descripcion'=>$observacion,
												'id_solicitud' =>$id_solicitud, 
												'id_usuario_asigna'=>$id_usuario_asigna, 
												'id_usuario_tarea'=>$usuario2, 
												'estado'=>'0',
												'fecha_registro'=>$fecha
											);
											$query = $this->general_model->insert('tareas', $registro3);
							          	}
							    	}					
								}								
							}
						}elseif($this->input->post('estado')==6){

							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){

								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N° ".$id_solicitud." Codificada";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);

								if($query >= 1){
									$tipo_tarea ="Corregir Solicitud";
									$observacion = "Corregir la Solicitud N° ".$id_solicitud." y volverla a cargar";
									$registro3=array(
										'tipo_tarea' =>$tipo_tarea,
										'id_modulo'=>"0",
										'descripcion'=>$observacion, 
										'id_solicitud' =>$id_solicitud,
										'id_usuario_asigna'=>$id_usuario_asigna, 
										'id_usuario_tarea'=>$usuario2,
										'estado'=>'0',
										'fecha_registro'=>$fecha
									);
									$query = $this->general_model->insert('tareas', $registro3);
					          	}	
							}
							
						}elseif($this->input->post('estado')==2){

							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){
								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N°".$id_solicitud." Rechazada";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
								
							}
						}
					}else{
						if($this->input->post('estado')==6){
							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){

								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N° ".$id_solicitud." Devuelta";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
								
								if($query >= 1){
									$tipo_tarea ="Corregir Solicitud";
									$observacion = "Corregir la Solicitud N° ".$id_solicitud." y volverla a cargar";
									$registro3=array(
										'tipo_tarea' =>$tipo_tarea,
										'id_modulo'=>"0",
										'descripcion'=>$observacion, 
										'id_solicitud' =>$id_solicitud,
										'id_usuario_asigna'=>$id_usuario_notifica, 
										'id_usuario_tarea'=>$id_usuario_2, 
										'estado'=>'0',
										'fecha_registro'=>$fecha
									);
									$query = $this->general_model->insert('tareas', $registro3);
									
					          	}	
							}								
						}elseif($this->input->post('estado')==2){

							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){
								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N°".$id_solicitud." Rechazada";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);
								$query= $this->general_model->insert('notificaciones', $registro2);
								
							}
						}		
					}
					// ---------------- Cambiar notificaciones y tareas a visto ---------------- //
					$usuarioactual = $this->session->userdata('C_id_usuario');
					$campos= 'id_notificacion';
					$idnotificacion ="";
					$query1 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$id_solicitud.'" AND tipo_notificacion = "0" AND id_usuario_2 = "'.$usuarioactual.'"','', 0, 0);
					foreach ($query1->result_array() as $row){
						
						$idnotificacion =$row['id_notificacion'];
					}

					$registro1=array(
								
						'estado'=>'1',
						'fecha_visto'=>$fecha							
					);

					$query = $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);
					
					if($query=="OK"){
						$campos= 'id_tareas';
						$idtarea="";
						$query1 = $this->general_model->consulta_personalizada($campos,'tareas',' id_solicitud = "'.$id_solicitud.'" AND id_modulo = "0" AND id_usuario_tarea = "'.$usuarioactual.'"','', 0, 0);
						foreach ($query1->result_array() as $row){
							
							$idtarea =$row['id_tareas'];
						}

						$registro1=array(
							'estado'=>'1',
							'fecha_visto'=>$fecha							
						);

						$query = $this->general_model->update('tareas', 'id_tareas', $idtarea, $registro1);					
						
					}

					if($query=="OK"){
						//Guardar Observaciones en la tabla observaciones_solicitud
						$registro2=array(										
							'id_solicitud'=>$id_solicitud, 
							'id_usuario'=>$id_usuario_notifica,										
							'q_realiza'=>'2', 
							'descripcion'=>$this->input->post('observaciones'),
							'fecha_registro'=>$fecha							
						);

						$query= $this->general_model->insert('observaciones_solicitud', $registro2);
						echo '1';
					}						
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
	}		

	public function guardar_aprobacion() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
					//echo "ingreso";
				//ASIGNAR EL DIRECTORIO 
				$dir = $this->input->post('tipodocumentos_solicitud');

				$id_solicitud = $this->input->post('idreg'); 
				$id_usuarioactual = $this->session->userdata('C_id_usuario');
				$id_proceso=$this->input->post('idproceso');

				$fecha = date('Y-m-d H:i:s');
				$registro=array(
					'id_solicitud'=>$this->input->post('idreg'), 
					'observacion'=>$this->input->post('observaciones'), 					
					'fecha_registro'=>$fecha, 
					'id_usuario'=>$this->session->userdata('C_id_usuario')
				);

				$query = $this->general_model->insert('solicitud_aprobacion', $registro);
				
				
				if($query >= 1) {
					$id_usuarioactual = $this->session->userdata('C_id_usuario');
					//actualizar estado checklist aprobacion
					$registro1=array(
						'estado'=>'1'
					);
					$idaprobacion ='';
					$campos= 'id_check_apro';
					$query1 = $this->general_model->consulta_personalizada($campos,'checklist_aprobacion_sol',' id_solicitud = "'.$id_solicitud.'" AND id_quien_aprueba = "'.$id_usuarioactual.'"','', 0, 0);

					foreach ($query1->result_array() as $row){
						
						$idaprobacion =$row['id_check_apro'];
					}

					$query = $this->general_model->update('checklist_aprobacion_sol', 'id_check_apro', $idaprobacion, $registro1);
					
					 
				}

				if($query=="OK"){
					//Actualiza el Archivo Origen 
					if($this->input->post('archivoorig') != "") {

						//ESTABLECER LA RUTA DONDE SE GUARDA EL ARCHIVO
						$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/'; 
						$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/';
						
						//CARGAR ARCHIVO VISUAL
						$config = [
							"upload_path" => $ruta,
							"allowed_types" => "*"
						];
						
						$this->load->library("upload",$config);
						if ($this->upload->do_upload('archivoorig')){
							
							$data = array('upload_data' => $this->upload->data());
							
							$registro1=array(
								'estado'=>$this->input->post('estado'),
								'archivo_original'=>$rutag+$data['upload_data']['file_name']
							);
											
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);

						}else{
							echo $this->upload->display_errors($ruta);
						}	
					}						
				}

				if($query=="OK"){
					//VALIDA SI TODOS APROBARON LA SOLICITUD
					$tipo_notificacion="0";
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					$descripcion="";
					$id_usuario_asigna = $this->session->userdata('C_id_usuario');

					$campos1 ='id_quien_aprueba AS "quien_aprueba", estado AS "aprobado"';
					$query = $this->general_model->consulta_personalizada($campos1,'checklist_aprobacion_sol',' id_solicitud = "'.$id_solicitud.'" ', '', 0, 0);
					$i = 0;
					$j = 0;
					
					foreach ($query->result_array() as $row){
						
						if($row['aprobado']=='1'){
							$j++;
						}
						$i++;
					}
					
					if($i==$j){

						if($this->input->post('estado')==4){
							
							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							

							if($query=="OK"){
								//Agregar Notificaciones
								$id_usuario_2 = 571;
								$observacion ="Solicitud N°".$this->input->post('idreg')."fue Aprobada";
								$registro2=array(
								
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query = $this->general_model->insert('notificaciones', $registro2);
								
							}
							if($query >= 1) { //Agregar Tarea
								$id_usuario_tarea = 571;
								$descripcion ="Gestionar Solicitud N°".$this->input->post('idreg');

								$registro3=array(
									'tipo_tarea' =>'Gestionar Codificación',
									'id_modulo'=>"0",
									'id_solicitud' =>$id_solicitud, 
									'descripcion'=>$descripcion, 
									'id_usuario_asigna'=>$id_usuario_asigna, 
									'id_usuario_tarea'=>$id_usuario_tarea,  
									'estado'=>'0',
									'fecha_registro'=>$fecha 

								);
							
							$query = $this->general_model->insert('tareas', $registro3);
							
							}
						}elseif($this->input->post('estado')==6){

							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){ //CARGAR NOTIFICACIÓN SOLICITUD DEVUELTA

								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N° ".$id_solicitud." Devuelta";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
								
								if($query >= 1){ //CARGAR TAREA SOLICITUD DEVUELTA

									$observacion = "Corregir la Solicitud N° ".$id_solicitud." y volverla a cargar";
									$registro3=array(
										'tipo_tarea' =>'Validar Cambios en Solicitud',
										'id_modulo'=>"0",
										'descripcion'=>$observacion, 
										'id_solicitud' =>$id_solicitud,
										'id_usuario_asigna'=>$id_usuario_asigna, 
										'id_usuario_tarea'=>$id_usuario_2,
										'estado'=>'0',
										'fecha_registro'=>$fecha
									);
									$query = $this->general_model->insert('tareas', $registro3);
					          	}	
							}
						}elseif($this->input->post('estado')==2){

							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){

								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N°".$id_solicitud." Rechazada";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
								
							}
						}
					}else{

						if($this->input->post('estado')==6){//SI LA SOLICITUD ES DEVUELTA
							
							$id_usuario_2 =  $this->input->post('idusuarioregsol');

							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							
							if($query=="OK"){ //CARGAR NOTIFICACIÓN SOLICITUD DEVUELTA

								
								$observacion = "Solicitud N° ".$id_solicitud." Devuelta";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
							}
							if($query >= 1){ //CARGAR TAREA SOLICITUD DEVUELTA

								$observacion = "Corregir la Solicitud N° ".$id_solicitud." y volverla a cargar";
								$registro3=array(
									'tipo_tarea' =>$tipo_tarea,
									'id_modulo'=>"0",
									'descripcion'=>$observacion, 
									'id_solicitud' =>$id_solicitud,
									'id_usuario_asigna'=>$id_usuario_asigna, 
									'id_usuario_tarea'=>$usuario2,
									'estado'=>'0',
									'fecha_registro'=>$fecha
								);
								$query = $this->general_model->insert('tareas', $registro3);
				          		
					        }
						}elseif($this->input->post('estado')==2){//SI SE RECHAZA LA SOLICITUD
							
							$registro1=array(							
								'estado'=>$this->input->post('estado')
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
							

							if($query=="OK"){//CARGAR NOTIFICACION DE SOLICITUD RECHAZADA

								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N°".$id_solicitud." Rechazada";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha							
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
								
							}						
						}
					}
				}
				
				if($query >= 1){
					//Guardar Observaciones en la tabla observaciones_solicitud
					$registro2=array(										
						'id_solicitud'=>$id_solicitud, 
						'id_usuario'=>$id_usuario_notifica,										
						'q_realiza'=>'3', 
						'descripcion'=>$this->input->post('observaciones'),
						'fecha_registro'=>$fecha							
					);

					$query= $this->general_model->insert('observaciones_solicitud', $registro2);
					
				}	
				// -------------- Cambiar notificaciones y tareas a visto -------------//
				
				$usuarioactual = $this->session->userdata('C_id_usuario');
				$campos= 'id_notificacion';
				$query1 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$id_solicitud.'" AND tipo_notificacion = "0" AND id_usuario_2 = "'.$usuarioactual.'"','', 0, 0);
				foreach ($query1->result_array() as $row){
					
					$idnotificacion = $row['id_notificacion'];
				}

				$registro1=array(
							
					'estado'=>'1',
					'fecha_visto'=>$fecha							
				);

				$query = $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);
				
				if($query=="OK"){
					$campos= 'id_tareas';
					$query1 = $this->general_model->consulta_personalizada($campos,'tareas',' id_solicitud = "'.$id_solicitud.'" AND id_modulo = "0" AND id_usuario_tarea = "'.$usuarioactual.'"','', 0, 0);
					foreach ($query1->result_array() as $row){
						
						$idtarea =$row['id_tareas'];
					
						$registro1=array(
							'estado'=>'1',
							'fecha_visto'=>$fecha							
						);

						$query = $this->general_model->update('tareas', 'id_tareas', $idtarea, $registro1);
					}				
				}
					
				if($query == "OK") {
					echo "1";
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
	}	

	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$id_proceso ="";
				$q_realiza="";
				$proceso = null;
				$subproceso = null;

				$capacitacion = $this->input->post('capacitacion');				

				if ($this->input->post('proceso')!= "999"){
					$proceso = $this->input->post('proceso');
				}

				if ($this->input->post('subproceso')!= "999"){
					$subproceso = $this->input->post('subproceso');
				}

				//QUIEN REVISA
				$qrevisa = $this->input->post('empleadosMR_revisa');
				$val_qrevisa = implode(',', (array) $qrevisa);

				//QUIEN APRUEBA
				$qaprueba = $this->input->post('empleadosMR_aprueba');
				$val_qaprueba = implode(',', (array) $qaprueba);
				
				//DOCUMENTOS RELACIONADOS 
				$docrela = $this->input->post('iddocrelacionado');
				
				//FORMATO ORIGEN
				
				$origenFo = null;

				if($this->input->post('tipodocumentos_solicitud')=="FO"){
					$origenFo = $this->input->post('origen_formato');
				}

				//ASIGNAR EL DIRECTORIO 
				$dir = $this->input->post('tipodocumentos_solicitud');

				$fecha = date('Y-m-d H:i:s');
				if($this->input->post('archivoorig') != "") { //verifica que actualizaron el archivo
				//ESTABLECER LA RUTA DONDE SE GUARDA EL ARCHIVO
					$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/'; 
					$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/fuente/'.$dir.'/';
		
					//CARGAR ARCHIVO VISUAL
					$config = [
						"upload_path" => $ruta,
						"allowed_types" => "*"
					];
					
					$this->load->library("upload",$config);
					if ($this->upload->do_upload('archivoorig')){
							$data = array('upload_data' => $this->upload->data());
					}else{
							echo $this->upload->display_errors($ruta);
					}
					
					$filename=$rutag+$data['upload_data']['file_name'];

					$registro=array(

						'tipo_solicitud'=>$this->input->post('tipo_solicitud'), 
						'id_tipo_documento'=>$this->input->post('tipodocumentos_solicitud'), 
						'nombre_documento'=>$this->input->post('nombre'),
						'id_macroproceso'=>$this->input->post('macroprocesos_solicitud'),  
						'id_proceso'=>$proceso, 
						'id_subproceso'=>$subproceso, 
						'id_responsable'=>$this->input->post('empleados_solicitud'), 
						'justificacion'=>$this->input->post('justificacion'), 
						'documento_relacionado'=>$docrela,
						'origen_formato'=>$origenFo,
						'id_revisado_por'=>$val_qrevisa, 
						'id_aprabo_por'=>$val_qaprueba, 
						'archivo_original'=>$filename, 					
						'estado'=>$this->input->post('estado')
					);
				}else{//CUANDO NO SE ACTUALIZA EL ARCHIVO FUENTE 
						
					$registro=array(

						'tipo_solicitud'=>$this->input->post('tipo_solicitud'), 
						'id_tipo_documento'=>$this->input->post('tipodocumentos_solicitud'), 
						'nombre_documento'=>$this->input->post('nombre'), 
						'id_macroproceso'=>$this->input->post('macroprocesos_solicitud'),
						'id_proceso'=>$proceso,
						'id_subproceso'=>$subproceso, 
						'id_responsable'=>$this->input->post('empleados_solicitud'), 
						'justificacion'=>$this->input->post('justificacion'), 
						'documento_relacionado'=>$docrela,
						'origen_formato'=>$origenFo,
						'id_revisado_por'=>$val_qrevisa, 
						'id_aprabo_por'=>$val_qaprueba, 
						'estado'=>$this->input->post('estado')
					);
				}
					
				$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $this->input->post('idreg'), $registro);
				if($query=="OK"){
					//ENVIAR NOTIFICACION DE USUARIO A CALIDAD
					$id_solicitud = $this->input->post('idreg');	
					if($this->session->userdata('C_id_usuario')==$this->input->post('idusuarioregsol')){
						$q_realiza = 0;
						$id_usuario_2 = 571;
						$tipo_notificacion = 0;
						$id_usuario_notifica = $this->input->post('idusuarioregsol');
						$observaciones="La solicitud N° '".$id_solicitud."' fue Corregida";		
						
						$registro2=array(
							'tipo_notificacion'=>$tipo_notificacion, 
							'id_solicitud' =>$id_solicitud,
							'id_usuario_notifica'=>$id_usuario_notifica, 
							'id_usuario_2'=>$id_usuario_2, 
							'observacion'=>$observaciones, 
							'estado'=>'0',
							'fecha_registro'=>$fecha
						);

						$query = $this->general_model->insert('notificaciones', $registro2);
						if($query >= 1) 
							//ENVIAR TAREA DE USUARIO A CALIDAD
							$descripcion="Revisar solicitud N° '".$id_solicitud."' Corregida";
							$id_usuario_asigna = $this->session->userdata('C_id_usuario');
							$id_usuario_tarea = $id_usuario_2;
							
							$registro3=array(
								'tipo_tarea' =>'Validar Cambios en Solicitud',
								'id_modulo'=>"0",
								'descripcion'=>$descripcion, 
								'id_solicitud' =>$id_solicitud,
								'id_usuario_asigna'=>$id_usuario_asigna, 
								'id_usuario_tarea'=>$id_usuario_tarea, 
								'estado'=>'0',
								'fecha_registro'=>$fecha
							);
							
							$query = $this->general_model->insert('tareas', $registro3);	
							
					}else{
						$q_realiza=1;
						$estado = $this->input->post('estado');
						$observaciones_a = $this->session->userdata('observaciones');
						$tipo_notificacion=1;
						$id_usuario_notifica = $this->session->userdata('C_id_usuario');						
						$id_usuario_asigna =$this->session->userdata('C_id_usuario');								
						$id_proceso=$this->input->post('procesos_solicitud');

						switch($estado) {
							case '0': //PENDIENTE
								$id_usuario_2 = $this->input->post('idusuarioregsol');
								$observacion ="Corregir solicitud N° '".$id_solicitud."', por:'".$observaciones_a ."'";
								$id_usuario_tarea = $this->input->post('idusuarioregsol');
								$tipo_tarea ="Corregir Solicitud";


								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_solicitud' =>$id_solicitud,
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha
								);

								$query = $this->general_model->insert('notificaciones', $registro2);
								//CREA LA TAREA
								if($query >= 1) 
									
									$registro3=array(
										'tipo_tarea' =>'Validar Cambios en Solicitud',
										'id_modulo'=>"0",
										'descripcion'=>$observacion,
										'id_solicitud' =>$id_solicitud, 
										'id_usuario_asigna'=>$id_usuario_asigna, 
										'id_usuario_tarea'=>$id_usuario_tarea, 
										'estado'=>'0',
										'fecha_registro'=>$fecha
									);
									
								$query1 = $this->general_model->insert('tareas', $registro3);	
								
								break;
							case '1': //ACEPTADA
								
								$id_usuario_2 = explode(",", $val_qrevisa);
								$id_usuarioaprueba = explode(",", $val_qaprueba);
								$observacion ="Solicitud N°".$id_solicitud." Pasa Revisión";
								$id_usuario_tarea = $this->input->post('idusuarioregsol');							
								$tipo_tarea ="Gestionar Revisión";

								if(is_array($id_usuario_2)){
	        						foreach ($id_usuario_2 as $value) {//ITERA PARA NOTIFICAR A QUIENES REVISAN
	     							    $usuario2 =	$value;	
										//AGREGAR NOTIFICACIONES A LA TABLA 
										$registro2=array(
											'tipo_notificacion'=>$tipo_notificacion, 
											'id_solicitud' =>$id_solicitud,
											'id_usuario_notifica'=>$id_usuario_notifica, 
											'id_usuario_2'=>$usuario2, 
											'observacion'=>$observacion, 
											'estado'=>'0',
											'fecha_registro'=>$fecha
										);

										$query = $this->general_model->insert('notificaciones', $registro2);
										
										if($query >= 1){
											//AGREGAR TAREAS A LA TABLA
											$registro3=array(
												'tipo_tarea' =>$tipo_tarea,
												'id_modulo'=>"0",
												'descripcion'=>$observacion, 
												'id_solicitud' =>$id_solicitud,
												'id_usuario_asigna'=>$id_usuario_asigna, 
												'id_usuario_tarea'=>$usuario2, 
												'estado'=>'0',
												'fecha_registro'=>$fecha
											);
											$query = $this->general_model->insert('tareas', $registro3);
							          	}	
							          	if($query >= 1){
							          		//AGREGA EL REGISTRO AL CHECKLIST DE REVISION
											$registro4=array(
												'id_solicitud' =>$this->input->post('idreg'),
												'id_quien_revisa'=>$usuario2, 												
												'estado'=>'0',
											);
											$query = $this->general_model->insert('checklist_revision_sol', $registro4);
							          	}	
									}
						          	 							    	    
							    }else{
							    	//SI SOLO UNO VA A REVISAR LA SOLICITUD
							        foreach ((array)$id_usuario_2 as $value) {
							         	$usuario2 =	$value;		
							            $registro2=array(
											'tipo_notificacion'=>$tipo_notificacion, 
											'id_solicitud' =>$id_solicitud,
											'id_usuario_notifica'=>$id_usuario_notifica, 
											'id_usuario_2'=>$usuario2, 
											'observacion'=>$observacion, 
											'estado'=>'0',
											'fecha_registro'=>$fecha
										);

										$query= $this->general_model->insert('notificaciones', $registro2);

										if($query >= 1){
											$registro3=array(
												'tipo_tarea' =>$tipo_tarea,
												'id_modulo'=>"0",
												'descripcion'=>$observacion, 
												'id_solicitud' =>$id_solicitud,
												'id_usuario_asigna'=>$id_usuario_asigna, 
												'id_usuario_tarea'=>$usuario2,
												'estado'=>'0',
												'fecha_registro'=>$fecha
											);
											$query = $this->general_model->insert('tareas', $registro3);
							          	}
							          	if($query >= 1){// guardar en checklist_revisa
											$registro4=array(
												'id_solicitud' =>$id_solicitud,
												'id_quien_revisa'=>$usuario2, 												
												'estado'=>'0',
											);
											$query = $this->general_model->insert('checklist_revision_sol', $registro4);
							          	}	
							    	}
							    	
							    }
							    if($query >= 1){//CARGA EL CHECKLIST DE APROBACION
						          		
					          		if(is_array($id_usuarioaprueba)){
    									foreach ($id_usuarioaprueba as $value) {
     							    		$usuarioaprueba = $value;
											
											$registro4=array(
												'id_solicitud' =>$id_solicitud,
												'id_quien_aprueba'=>$usuarioaprueba,
												'estado'=>'0',
											);

											$query = $this->general_model->insert('checklist_aprobacion_sol', $registro4);
										}										
										
									}else{
						        		foreach ((array)$id_usuarioaprueba as $value) {
						         			$usuarioaprueba = $value;													
											$registro4=array(
												'id_solicitud' =>$id_solicitud,
												'id_quien_aprueba'=>$usuarioaprueba,
												'estado'=>'0',
											);
											$query = $this->general_model->insert('checklist_aprobacion_sol', $registro4);
										}
						          	}					        	
					        	}													
								
								break;
							case '2': //RECHAZADA
								$id_usuario_2 = $this->input->post('idusuarioregsol');
								
								$observaciones_a = $this->session->userdata('observaciones');
								$descripcion ="Solicitud N°".$this->input->post('idreg')." Fue rechazada, por: '".$observaciones_a."'";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$descripcion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha
								);

								$query= $this->general_model->insert('notificaciones', $registro2);
									if($query >= 1){
										$idDe = 571;
										$idPara = 1;
										$correoDe = '';
										$nombreDe = '';
										$correoPara = '';
										$NombrePara = '';
										$observaciones_a = $this->session->userdata('observaciones');

										$query=$this->general_model->select_where('IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Empleado", e.email AS "Email"','empleados e ',array('e.id_empleado' => $idDe));
										foreach ($query->result_array() as $row)
										{
											$correoDe  = $row['Empleado'];
											$nombreDe = $row['Email'];
										}

										$query=$this->general_model->select_where('IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Empleado", e.email AS "Email"','empleados e ',array('e.id_empleado' => $idPara));
										foreach ($query->result_array() as $row1)
										{
											$correoPara  = $row1['Empleado'];
											$NombrePara = $row1['Email'];
										}


										$de =''.$nombreDe.'<'.$correoDe.'>';
									    //$de ='catonino17@gmail.com';

									    $Para =''.$NombrePara.' - <'.$correoPara.'>';

										//$Para ='edwincas_17@hotmail.com';
										$Asunto =''.$descripcion .'';

										$Cabeceras = "From:".$de."\r\n";
										$Cabeceras .= "MIME-Version: 1.0\r\n";
										$Cabeceras .= "Content-type: text/html; charset=utf-8\r\n";

										$cuerpo = "<div><font size='3'>Señor(a),</font></div>\r\n";
										$cuerpo .= "<div><font size='3'>".$NombrePara.",</font></div>\r\n";
										$cuerpo .= "<div><font size='3'>La ciudad</font></div>\r\n";
										$cuerpo .= "<br>\r\n";
										$cuerpo .= "<br>\r\n";
										$cuerpo .= "<br>\r\n";

										$cuerpo .= "<div><font size='3'>Solicitud N°".$this->input->post('idreg')." Fue rechazada, por: '".$observaciones_a."</font></div>\r\n";
										
									    $cuerpo .= "<br>\r\n";
									    $cuerpo .= "<br>\r\n";

									    $cuerpo .= "<div><font size='3'>Cordialmente,</font></div>\r\n";
									    $cuerpo .= "<br>\r\n";
									   	$cuerpo .= "<br>\r\n";
									    $cuerpo .= "<div><font size='3'>Coordinación de Calidad</font></div>\r\n";
									    $cuerpo .= "<div><font size='3'>'".$nombreDe."'</font></div>\r\n";
									    
									    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 No. 104-76 piso 3</font></div>\r\n";
									    $cuerpo .= "<div><font size='3'> (601) 6002555 Ext.236 </font></div>\r\n";

									    $cuerpo .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
									    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
										$cuerpo .= "<br>\r\n";

										$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
										if($msg=1){
											$query = 1;
										}else{
											$query =-999;
										}
									}
																
								break;
							case '5': //CERRADA
								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N°".$this->input->post('idreg')."Fue cerrada";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha
								);

								$query = $this->general_model->insert('notificaciones', $registro2);
									
								break;
							case '6': //DEVUELTA
								$id_usuario_2 =  $this->input->post('idusuarioregsol');
								$observacion = "Solicitud N°".$this->input->post('idreg')."Fue devuelta, ver documento anexo";

								$registro2=array(
									'tipo_notificacion'=>$tipo_notificacion, 
									'id_usuario_notifica'=>$id_usuario_notifica, 
									'id_usuario_2'=>$id_usuario_2, 
									'observacion'=>$observacion, 
									'estado'=>'0',
									'fecha_registro'=>$fecha
								);

								$query = $this->general_model->insert('notificaciones', $registro2);
								if($query >= 1){
															
									$tipo_tarea ="Corregir Solicitud";

									$registro3=array(
										'tipo_tarea' =>$tipo_tarea,
										'id_modulo'=>"0",
										'descripcion'=>$observacion, 
										'id_solicitud' =>$id_solicitud,
										'id_usuario_asigna'=>$id_usuario_asigna, 
										'id_usuario_tarea'=>$id_usuario_2, 
										'estado'=>'0',
										'fecha_registro'=>$fecha
									);
									$query = $this->general_model->insert('tareas', $registro3);
					          	}	
								break;
						}
						if($query >= 1){
							//Guardar Observaciones en la tabla observaciones_solicitud
							$q_realiza=1;
							$registro2=array(										
								'id_solicitud'=>$id_solicitud, 
								'id_usuario'=>$id_usuario_notifica,										
								'q_realiza'=>$q_realiza, 
								'descripcion'=>$this->input->post('observaciones'),
								'fecha_registro'=>$fecha							
							);

							$query= $this->general_model->insert('observaciones_solicitud', $registro2);
							
						}					
					}
					if($query >= 1){
						//CAMBIAR ESTADO DE NOTIFICACIONES Y TAREAS.
						$idnotificacion='';
						$usuarioactual = $this->session->userdata('C_id_usuario');
						$campos= 'id_notificacion';
						$query1 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$id_solicitud.'" AND tipo_notificacion = "0" AND id_usuario_2 = "'.$usuarioactual.'"','', 0, 0);
						foreach ($query1->result_array() as $row){
							
							$idnotificacion =$row['id_notificacion'];
						}

						$registro1=array(
									
							'estado'=>'1',
							'fecha_visto'=>$fecha							
						);

						$query = $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);
						
						if($query=="OK"){
							$idtarea = '';
							$campos= 'id_tareas';
							$query1 = $this->general_model->consulta_personalizada($campos,'tareas','id_solicitud = "'.$id_solicitud.'" AND id_modulo = "0" AND id_usuario_tarea = "'.$usuarioactual.'"','', 0, 0);
							foreach ($query1->result_array() as $row){
								
								$idtarea = $row['id_tareas'];
							}

							$registro1=array(
								'estado'=>'1',
								'fecha_visto'=>$fecha							
							);

							$query = $this->general_model->update('tareas', 'id_tareas', $idtarea, $registro1);
												
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
			$filename = "Listado_Documentos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL SOLICITUDES DE DOCUMENTOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_solicitudesExcel_tabla('EXCEL',$this->session->userdata('C_id_usuario'))); 
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

	public function select_Document($name) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {

				$campos = ' id_documento AS "id", nombre AS "name" ';
    
    			$query = $this->general_model->consulta_personalizada($campos, 'documentos', ' estado = "1" AND nombre LIKE %'.$name.'% ', 'nombre', 0, 0);
    			$row = $query->result_array();
    			alert($row);
    			$response = [];
    			while($row){
       				$response[] = array("id"=>$row['id'], "name"=>$row['name']);
    			}
 				//alert($response);
   				echo json_encode($response); 
			}
	
		}
	}

	public function cargar_qrevisa(){

		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {

				$campos ='IFNULL(CONCAT(e.nombres," ",e.apellidos),"") AS "quien_revisa", ck.estado AS "Estado"';
				$query = $this->general_model->consulta_personalizada($campos,'checklist_revision_sol ck INNER JOIN empleados e ON ck.id_quien_revisa = e.id_empleado',' ck.id_solicitud = "'.$this->input->post('idreg').'" ', '', 0, 0);
					
				$tabla = '';
				$tabla .= '
						<div class="row border border-primary">'.
			            	form_label('Quien Revisa: ','', array('class'=>'control-label text-left col-md-8 text-primary font-weight-bold'))
			              	.'<div class="col-md-4 text-primary"><strong>Revisado</strong></div><hr>
			            </div>';


				foreach ($query->result_array() as $row)
				{
					
					$estado = '<i class="w-3 text-center fa fa-times text-110 text-danger-m1"></i>';
					if($row['Estado']=='1') 
												
						$estado ='<i class="fa fa-check" aria-hidden="true"></i>';
					
					$tabla .= '
					<div class="row">'.
		            	form_label($row['quien_revisa'].': ','', array('class'=>'control-label text-left col-md-9'))
		              	.'<div class="col-md-2 text-primary"><strong>'.$estado.'</strong></div>
		            </div>';
				}
					
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

				$campos ='os.id_observacion AS "Id",  CASE WHEN os.q_realiza ="0" THEN "Quien Corrigió" WHEN os.q_realiza ="1" THEN "Calidad" WHEN os.q_realiza ="2" THEN "Quien Revisó" ELSE "Quien Aprobó" END AS "Actividad", IFNULL(CONCAT(e.nombres," ",e.apellidos),"") AS "empleado", os.descripcion AS "observacion", os.fecha_registro AS "fecha"';
				$query = $this->general_model->consulta_personalizada($campos,'observaciones_solicitud os INNER JOIN empleados e ON os.id_usuario = e.id_empleado',' os.id_solicitud = "'.$this->input->post('idreg').'" ', '', 0, 0);
					
				$accordion = '<div class="accordion" id="accordioobservacion">';
				$count = 0;
				foreach ($query->result_array() as $row)
				{
					$count = $count+1;
					$accordion .= '<div class="card border-0 bgc-green-l5 post-carg" >';
				  	$accordion .= '<div class="card-header border-0 bgc-transparent mb-0" id="heading'.$row['Id'].'">';
				  	$accordion .= '<h2 class="card-title bgc-transparent text-green-d2 brc-green">';
				  	$accordion .= ' <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse'.$row['Id'].'" data-toggle="collapse" aria-expanded="false" aria-controls="collapse'.$row['Id'].'">
				                          Observación_'.$count.'
				                          <!-- the toggle icon -->
				                          <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
				                            <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
				                        </span>
				                          <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
				                            <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
				                        </span>
				                        </a></h2></div>';
					$accordion .='<div id="collapse'.$row['Id'].'" class="collapse" aria-labelledby="heading'.$row['Id'].'" data-parent="#accordioobservacion">';
					$accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
				                <div class="form-group row" id="div_archivo">
                                            
                                            <div class="col-sm-12">
                                             <p>Observaciones de '.$row['Actividad'].'</p>
                                              <p>Empleado: '.$row['empleado'].' -  Fecha de la Observación: '.$row['fecha'].' Observaciones de '.$row['Actividad'].'</p>
                                            </div>
                                            <div class="col-sm-12">
                                               <p>Descripción: '.$row['observacion'].'</p>
                                            </div>                                            
                                          </div>';
					$accordion .= '</div></div></div>';
				}
					$accordion .= '</div>';
			     echo $accordion;
			}
		}
	}

	public function cargar_qaprueba(){

		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {

				$campos ='IFNULL(CONCAT(e.nombres," ",e.apellidos),"") AS "quien_aprueba", ck.estado AS "Estado"';
				$query = $this->general_model->consulta_personalizada($campos,'checklist_aprobacion_sol ck INNER JOIN empleados e ON ck.id_quien_aprueba = e.id_empleado',' ck.id_solicitud = "'.$this->input->post('idreg').'" ', '', 0, 0);
					
				$tabla = '';
				$tabla .= '
						<div class="row border border-primary">'.
			            	form_label('Quien Aprueba: ','', array('class'=>'control-label text-left col-md-8 text-primary font-weight-bold'))
			              	.'<div class="col-md-4 text-primary"><strong>Aprobado</strong></div><hr>
			            </div>';


				foreach ($query->result_array() as $row)
				{
					
					$estado = '<i class="w-3 text-center fa fa-times text-110 text-danger-m1"></i>';
					if($row['Estado']=='1') 
												
						$estado ='<i class="fa fa-check" aria-hidden="true"></i>';
					
					$tabla .= '
					<div class="row">'.
		            	form_label($row['quien_aprueba'].': ','', array('class'=>'control-label text-left col-md-9'))
		              	.'<div class="col-md-2 text-primary"><strong>'.$estado.'</strong></div>
		            </div>';
				}
					
			     echo $tabla;
			}
		}
	}

	public function cargar_macroprocesos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$id_macro ="";				
				$campo2 = 'id_macroproceso AS "Macro"';
				$query2 = $this->general_model->consulta_personalizada($campo2, 'documentos','id_documento = "'.$this->input->post('iddoc').'" AND estado = "1" ', 'nombre', 0, 0);				
				$arr ="";
				foreach($query2->result_array() as $row2) {
					$id_macro =$row2['Macro'];
				}	
				
				$campos = 'id_macroproceso, nombre ';
				$query1 = $this->general_model->consulta_personalizada($campos, 'macroprocesos','id_macroproceso = "'.$id_macro.'" AND estado = "1" ', 'nombre', 0, 0);
				
				foreach($query1->result_array() as $row1) {
					$arr .= '<option value="'.$row1['id_macroproceso'].'"selected>'.$row1['nombre'].'</option>';
				}				
				echo $arr;
				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function cargar_documentos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				
				header('Content-Type: application/json');
				$id = $this->input->post('iddoc');
			
				$campos='d.id_documento AS "Documento", d.id_solicitud AS "Solicitud", td.nombre AS "Tipo_doc", d.nombre AS "Documento", d.id_macroproceso AS "Id_macroproceso", m.nombre AS "Macroproceso", d.id_procesomaestro AS "Id_proceso", p.nombre AS "Proceso", d.id_subproceso AS "Id_subproceso", sp.nombre AS "Subproceso", d.docrelacionado AS "Doc_relacionado", CONCAT(dv.ruta,dv.archivo) AS "PDF", d.codigo AS "Codigo", dv.version AS "Version", dv.fecha AS "Fechaversion", d.des_empleados AS "Dest_empleados", d.des_cargos AS "Dest_cargos", d.des_departamentos AS "Dest_departamentos", d.evaluacion AS "Evaluacion", d.estado AS "Estado", d.id_usuario AS "Usuario"';
				$query = $this->general_model->consulta_personalizada($campos,'documentos d INNER JOIN macroprocesos m ON d.id_macroproceso = m.id_macroproceso LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso=sp.id_subproceso INNER JOIN tipos_documentos td on d.id_tipo = td.id_tipo LEFT JOIN solicitud_documentos s ON d.id_solicitud = s.id_solicitud LEFT JOIN documentos_versiones dv ON dv.id_documento=d.id_documento AND dv.estado="1"', 'd.id_documento ="'.$id.'"', '', 0, 0);
				$row = $query->row_array();

				$docrela = '';
	      		$prefdoc = '';

				if($row['Doc_relacionado']!=""){
					
		      		$query1 = $this->general_model->consulta_personalizada('nombre,  RIGHT(codigo,6) AS cod', 'documentos', ' estado = "1" AND id_documento IN ('.$row['Doc_relacionado'].') ', 'nombre', 0, 0);
				    foreach ($query1->result_array() as $row1)
					{
				        if($docrela != '')
				        	$docrela .= ',';
				        $docrela .= $row1['nombre'];

				        if($prefdoc != '')
				        	$prefdoc .= '-';
				        $prefdoc .= $row1['cod'];
					}
			    }

				$arr['documento'] = array('Documento'=>$row['Documento'], 'Tipo_doc'=>$row['Tipo_doc'], 'Id_macroproceso'=>$row['Id_macroproceso'], 'Macroproceso'=>$row['Macroproceso'],'Id_proceso'=>$row['Id_proceso'], 'Proceso'=>$row['Proceso'], 'Id_subproceso'=>$row['Id_subproceso'], 'Subproceso'=>$row['Subproceso'], 'Doc_relacionado'=>$row['Doc_relacionado'], 'Pdf'=>$row['PDF'], 'Codigo'=>$row['Codigo'], 'Version'=>$row['Version'], 'Fechaversion'=>$row['Fechaversion'], 'Dest_empleados'=>$row['Dest_empleados'], 'Dest_cargos'=>$row['Dest_cargos'], 'Dest_departamentos'=>$row['Dest_departamentos'], 'Evaluacion'=>$row['Evaluacion']);
				echo json_encode( $arr );
					
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function cargar_procesos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				if($this->input->post('tipo')=="2"|| $this->input->post('tipo')=="3"){
					$id_pro ="";	
					$arr="";			
					$campo2 = 'id_procesomaestro AS "proceso"';
					$query2 = $this->general_model->consulta_personalizada($campo2, 'documentos','id_documento = "'.$this->input->post('iddoc').'" AND estado = "1" ', 'nombre', 0, 0);				

					foreach($query2->result_array() as $row2) {
						$id_pro =$row2['proceso'];
					}	
					$campos = 'id_proceso, nombre';
					$query1 = $this->general_model->consulta_personalizada($campos, 'procesos ','id_proceso = "'.$id_pro.'" AND estado = "1" ', 'nombre', 0, 0);
						//echo $this->db->last_query();
					
					foreach($query1->result_array() as $row1) {
						$arr .= '<option value="'.$row1['id_proceso'].'"selected>'.$row1['nombre'].'</option>';
					}				
					
				}else{

					$campos = 'p.id_proceso, p.nombre ';
					$query1 = $this->general_model->consulta_personalizada($campos, 'procesos p','p.id_macroproceso = "'.$this->input->post('macro').'" AND estado = "1" ', 'p.nombre', 0, 0);
					//echo $this->db->last_query();
					$arr = '<option value="999" selected>NO APLICA</option>';
					foreach($query1->result_array() as $row1) {
						$arr .= '<option value="'.$row1['id_proceso'].'">'.$row1['nombre'].'</option>';
					}
				}								
				echo $arr;				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function cargar_subprocesos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				if($this->input->post('tipo')=="2"){
					$id_subpro ="";	
					$arr="";			
					$campo2 = 'id_subproceso AS "subproceso"';
					$query2 = $this->general_model->consulta_personalizada($campo2, 'documentos','id_documento = "'.$this->input->post('iddoc').'" AND estado = "1" ', 'nombre', 0, 0);				

					foreach($query2->result_array() as $row2) {
						$id_subpro =$row2['subproceso'];
					}	
					$campos = 'p.id_subproceso, p.nombre ';
					$query1 = $this->general_model->consulta_personalizada($campos, 'subprocesos p','p.id_subproceso = "'.$id_subpro.'" AND estado = "1" ', 'p.nombre', 0, 0);
						//echo $this->db->last_query();
					
					foreach($query1->result_array() as $row1) {
						$arr .= '<option value="'.$row1['id_subproceso'].'"selected>'.$row1['nombre'].'</option>';
					}

				}else{
					$campos = ' sp.id_subproceso, sp.nombre ';
					$query = $this->general_model->consulta_personalizada($campos, 'subprocesos sp','sp.id_proceso = "'.$this->input->post('proce').'" AND estado = "1" ', 'sp.nombre', 0, 0);
					//echo $this->db->last_query();
					$arr = '<option value="999" selected>NO APLICA</option>';
					foreach($query->result_array() as $row) {
						$arr .= '<option value="'.$row['id_subproceso'].'">'.$row['nombre'].'</option>';
					}
				}
				echo $arr;				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function cargar_select_documentos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$campos = 'id_documento AS "id", nombre AS "nombre" ';
				$query1 = $this->general_model->consulta_personalizada($campos, 'documentos','id_tipo = "'.$this->input->post('tipo').'" AND estado = "1" ', 'nombre', 0, 0);
				//echo $this->db->last_query();
				$arr = '<option value="" selected>NO APLICA</option>';
				foreach($query1->result_array() as $row1) {
					$arr .= '<option value="'.$row1['id'].'">'.$row1['nombre'].'</option>';
				}				
				echo $arr;
				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function verificar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');
			
			$query=$this->general_model->select_where('id_revisado_por,id_aprabo_por, id_usuario,estado','solicitud_documentos',array('id_solicitud' => $id));
			$row = $query->row_array();

				
			$arr['solicitud'] = array('Revisa'=>$row['id_revisado_por'], 'Aprueba'=>$row['id_aprabo_por'], 'Usuario'=>$row['id_usuario'],'Estado'=>$row['estado']);
			echo json_encode( $arr );
		}
	}
	
	public function cargar_docrelacionado() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$docrela = $this->input->post('iddocrel');
				$id_macro = $this->input->post('idmacro');
				$id_proc = $this->input->post('idproc');
				$id_subpro = $this->input->post('idsubpr');
				$id_docrel = $this->input->post('iddocrel');   
				$query=''; 
				
				$campos = ' d.id_documento AS "Id", d.nombre AS "Nombre"';
				if ($id_docrel != "" || $id_docrel != null){
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_documento  ="'.$docrela.'"', 'd.nombre', 0, 0);
				
				}else if($id_subpro != ""){
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_subproceso ="'.	$id_subpro.'"', 'd.nombre', 0, 0);
				}else if($id_proc !=""){ 
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_procesomaestro ="'.$id_proc.'" AND d.id_subproceso IS NULL', 'd.nombre', 0, 0);
				}else{
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_macroproceso="'.$id_macro.'" AND d.id_procesomaestro IS NULL  AND d.id_subproceso IS NULL', 'd.nombre', 0, 0);
				};			
								
				$arr = '<option value="999" selected>NO APLICA</option>';
				foreach($query->result_array() as $row) {					
					      					
					if($docrela === $row['Id']){
	          		 	$arr .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
				    }else{
				    	$arr .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
				    } 
				    
				}				
				echo $arr;				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
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