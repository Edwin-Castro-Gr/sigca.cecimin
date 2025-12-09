<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_programacion extends CI_Controller {
	
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
	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$usuario_perfil = $this->session->userdata('C_perfil');
				$usuario = $this->session->userdata('C_id_usuario');
				$this->load->helper('funciones_tabla');
				echo listar_programacion_tabla('WEB',$usuario,$usuario_perfil);
			}
		}
	}

	public function listar_solicitudes() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {	
				$usuario_perfil = $this->session->userdata('C_perfil');	
			    $usuario = $this->session->userdata('C_id_usuario');		
				$this->load->helper('funciones_tabla');
				echo listar_programacionR_tabla('WEB',$usuario,$usuario_perfil);
			}
		}
	}

	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {
			
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Programación Cirugía";
			$data_usua['origen']="Cirugia";
			$data_usua['contenido']='programacion/index';
			$data_usua['entrada_js']='_js/programacion.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
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

			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
    		<script src="'.base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js').'"></script>
		    <script src="'.base_url('dist/js/jquery.datetimepicker.full.min.js').'"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function agenda() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {
			
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Agenda de Cirugía";
			$data_usua['origen']="Cirugia";
			$data_usua['contenido']='programacion/cx_calendar';
			$data_usua['entrada_js']='_js/f_calendar.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'

			<!-- -->
			<link rel="stylesheet" type="text/css" href="'.base_url('dist/css/calendar.css').'">

			';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
			<script src="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.js').'"></script>
			<!--
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.0/main.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.0/main.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.0/main.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.0/main.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-common@4.4.0/main.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-daygrid@4.4.0/main.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/resource-timegrid@4.4.0/main.min.js"></script>
			-->
			cfullcalendar  -->

			<script src="'.base_url('plugins/fullcalendar-scheduler-6.1.4/dist/index.global.js').'"></script>
			<script src="'.base_url('dist/js/moment.min.js').'"></script>

    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>
    		<script src="'.base_url('plugins/bootbox@5.5.2/bootbox.all.min.js').'"></script>
    		<!-- DataTables  -->
    		

			';

			$this->load->view('template',$data_usua);
		}
	}
	
	public function reporte() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		}else {
			
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Reporte";
			$data_usua['origen']="Cirugia";
			$data_usua['contenido']='programacion/reporte';
			$data_usua['entrada_js']='_js/programacion.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
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

			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
    		<script src="'.base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js').'"></script>
		    <script src="'.base_url('dist/js/jquery.datetimepicker.full.min.js').'"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$registro=array(
			'id_usuario_temp '=>$this->session->userdata('C_id_usuario')
			);
			$query = $this->general_model->delete('programacion_procedimientos', $registro);

			$data_usua['c_usuario']=$this->session->userdata('C_id_usuario');
			$data_usua['c_perfil']=$this->session->userdata('C_perfil');
			$data_usua['titulo']="Programación Cirugía";
			$data_usua['origen']="Cirugias";
			$data_usua['contenido']='programacion/nuevo';
			$data_usua['entrada_js']='_js/programacion.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<!--link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'" -->
			<!--link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'" -->

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			
			<!-- DateTimePicker  -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css').'">
			<!-- ColorPicker  -->
			
			';

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
			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>


		    <script src="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.js').'"></script> 
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    
		    
		    
		   <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function revisar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
		redirect(base_url());
		else {

			$data_usua['c_id_programacion'] = '';
			$data_usua['c_usuario_a'] = '';
			$data_usua['c_id_procedimiento'] = '';
			$data_usua['c_id_paciente'] = '';
			$data_usua['c_cedula_paciente'] = '';
			$data_usua['c_nombre_paciente'] = '';
			$data_usua['c_fecha_programacion'] = '';
			$data_usua['c_hora_programacion'] = '';
			$data_usua['c_tipo_anestesia'] = '';
			$data_usua['c_lateralidad'] = '';
			$data_usua['c_tiempoqxh'] = '';		
			$data_usua['c_id_cirujano'] = '';		
			$data_usua['c_id_2cirujano'] = '';
			$data_usua['c_observaciones'] = '';			
			$data_usua['c_observaciones_r'] = '';
			$data_usua['c_salaQx'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_otros'] = '';
			$data_usua['c_proveedor_material'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos ='p.id_programacion, p.id_paciente, pa.numero_id, IFNULL(CONCAT(pa.nombres, " ", pa.apellidos),"") AS "paciente", p.fecha_programacion, p.hora_programacion, p.tipo_anestesia, p.lateralidad, p.tiempoQxh, p.id_cirujano, p.id_2cirujano, p.observaciones, p.observaciones_r, p.salaQx, pp.id_procedimiento, pp.materiales, pp.otros, pp.proveedor_material, p.estado, p.id_usuario';
			$query = $this->general_model->consulta_personalizada($campos,'programacion p LEFT JOIN programacion_procedimientos pp ON p.id_programacion = pp.id_programacion INNER JOIN pacientes pa ON p.id_paciente=pa.id_paciente', 'p.id_programacion = "'.$id.'"', '', 0, 0);
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_programacion'] = $id;
				$data_usua['c_usuario_a'] = $row['id_usuario'];
				$data_usua['c_id_procedimiento'] = $row['id_procedimiento'];
				$data_usua['c_id_paciente'] = $row['id_paciente'];
				$data_usua['c_cedula_paciente'] = $row['numero_id'];
				$data_usua['c_nombre_paciente'] = $row['paciente'];
				$data_usua['c_fecha_programacion'] = $row['fecha_programacion'];
				$data_usua['c_hora_programacion'] = $row['hora_programacion'];
				$data_usua['c_tipo_anestesia'] = $row['tipo_anestesia'];
				$data_usua['c_lateralidad'] = $row['lateralidad'];				
				$data_usua['c_tiempoqxh'] = $row['tiempoQxh'];		
				$data_usua['c_id_cirujano'] = $row['id_cirujano'];		
				$data_usua['c_id_2cirujano'] = $row['id_2cirujano'];	
				$data_usua['c_observaciones'] = $row['observaciones'];					
				$data_usua['c_observaciones_r'] = $row['observaciones_r'];
				$data_usua['c_salaQx'] = $row['salaQx'];
				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_otros'] = $row['otros'];
				$data_usua['c_proveedor_material'] = $row['proveedor_material'];
				$data_usua['c_id_usuario'] = $this->session->userdata('C_id_usuario');
			}			

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['c_perfil']=$this->session->userdata('C_perfil');
			$data_usua['titulo']="Agendamiento Salas de Cirugía";
			$data_usua['origen']="Cirugias";
			$data_usua['contenido']='programacion/revisar';
			$data_usua['entrada_js']='_js/programacion.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<!--link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'" -->
			<!--link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'" -->

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			
			<!-- DateTimePicker  -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css').'">
			<!-- ColorPicker  -->
			
			<link rel="stylesheet" type="text/css" href=" '.base_url('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css').'">
			';

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
			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>


		    <script src="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.js').'"></script> 
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    


		    <script src="'.base_url('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js').'"></script>

		    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function enviar_solicitud($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
		redirect(base_url());
		else {

			$data_usua['c_id_programacion'] = '';
			$data_usua['c_usuario_a'] = '';
			$data_usua['c_id_procedimiento'] = '';
			$data_usua['c_id_paciente'] = '';
			$data_usua['c_cedula_paciente'] = '';
			$data_usua['c_nombre_paciente'] = '';
			$data_usua['c_fecha_programacion'] = '';
			$data_usua['c_hora_programacion'] = '';
			$data_usua['c_tipo_anestesia'] = '';
			$data_usua['c_lateralidad'] = '';
			$data_usua['c_tiempoqxh'] = '';			
			$data_usua['c_id_cirujano'] = '';		
			$data_usua['c_id_2cirujano'] = '';
			$data_usua['c_observaciones'] = '';
			$data_usua['c_observaciones_r'] = '';
			$data_usua['c_observaciones_s'] = '';
			$data_usua['c_salaQx'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_otros'] = '';
			$data_usua['c_proveedor_material'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos ='p.id_programacion, p.id_paciente, pa.numero_id, IFNULL(CONCAT(pa.nombres, " ", pa.apellidos),"") AS "paciente", p.fecha_programacion, p.hora_programacion, p.tipo_anestesia, p.lateralidad, p.tiempoQxh, p.id_cirujano, p.id_2cirujano, p.observaciones, p.observaciones_r, p.observaciones_sm, p.salaQx, p.estado, p.id_usuario';
			$query = $this->general_model->consulta_personalizada($campos,'programacion p INNER JOIN pacientes pa ON p.id_paciente=pa.id_paciente', 'p.id_programacion = "'.$id.'"', '', 0, 0);
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_programacion'] = $id;
				$data_usua['c_usuario_a'] = $row['id_usuario'];
				
				$data_usua['c_id_paciente'] = $row['id_paciente'];
				$data_usua['c_cedula_paciente'] = $row['numero_id'];
				$data_usua['c_nombre_paciente'] = $row['paciente'];
				$data_usua['c_fecha_programacion'] = $row['fecha_programacion'];
				$data_usua['c_hora_programacion'] = $row['hora_programacion'];
				$data_usua['c_tipo_anestesia'] = $row['tipo_anestesia'];
				$data_usua['c_lateralidad'] = $row['lateralidad'];				
				$data_usua['c_tiempoqxh'] = $row['tiempoQxh'];	
				$data_usua['c_id_cirujano'] = $row['id_cirujano'];					
				$data_usua['c_id_2cirujano'] = $row['id_2cirujano'];
				$data_usua['c_observaciones'] = $row['observaciones'];
				$data_usua['c_observaciones_r'] = $row['observaciones_r'];
				$data_usua['c_observaciones_s'] = $row['observaciones_sm'];
				$data_usua['c_salaQx'] = $row['salaQx'];
				$data_usua['c_estado'] = $row['estado'];			
				$data_usua['c_id_usuario'] = $this->session->userdata('C_id_usuario');
			}			

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');
			$data_usua['c_perfil']=$this->session->userdata('C_perfil');

			$data_usua['titulo']="Solicitud Materiales Agendamiento Salas de Cirugía";
			$data_usua['origen']="Cirugias";
			$data_usua['contenido']='programacion/solicitar';
			$data_usua['entrada_js']='_js/programacion.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<!--link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'" -->
			<!--link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'" -->

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			
			<!-- DateTimePicker  -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css').'">
			<!-- ColorPicker  -->
			
			<link rel="stylesheet" type="text/css" href=" '.base_url('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css').'">';

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
			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>


		    <script src="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.js').'"></script> 
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    


		    <script src="'.base_url('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js').'"></script>

		    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$fecha = date('Y-m-d H:i:s');
				$registro=array(
					'id_paciente'=>$this->input->post('idpaciente'),
					'fecha_programacion'=>$this->input->post('val_fechapro'),
					'hora_programacion'=>$this->input->post('horaprogramacion'),
					'tipo_anestesia'=>$this->input->post('tipoanestesia'),
					'lateralidad'=>$this->input->post('lateralidad'),
					'tiempoQxh'=>$this->input->post('tiempohoras'),
					'id_cirujano'=>$this->input->post('id_cirujano'),				
					'id_2cirujano'=>$this->input->post('cirujano_programacion'),
					'observaciones'=>$this->input->post('observaciones'),
					'fecha_registro'=>$fecha,
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'0'
				);
				//echo var_dump($registro);
				$query = $this->general_model->insert('programacion', $registro);
				// echo '1';
				if($query >= 1) {
					$registro0 = array(
						'id_programacion'=>$query,
						'id_usuario_temp '=>''
					);
					$query0 = $this->general_model->update('programacion_procedimientos', 'id_usuario_temp', $this->session->userdata('C_id_usuario'), $registro0);
					// echo '1';
				}
				if($query0 =="OK") {
					$id_solicitud = $query;
					$tipo_notificacion="1";
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					$id_usuario_2 = '';
					$observacion ="Solicitud de Agendamiento Sala Qx N".$id_solicitud;

					$campos = 'id_empleado';
					$query = $this->general_model->consulta_personalizada($campos,'usuarios','perfil ="6"','',0,0);
					foreach ($query->result_array() as $row){
						
						$registro2=array(
							'tipo_notificacion'=>$tipo_notificacion,
							'id_solicitud' =>$id_solicitud,
							'id_usuario_notifica'=>$id_usuario_notifica,
							'id_usuario_2'=>$row['id_empleado'],
							'observacion'=>$observacion,
							'estado'=>'0',
							'fecha_registro'=>$fecha
						);

						$query1 = $this->general_model->insert('notificaciones', $registro2);
						//Guardar Tarea
					
						$descripcion="Gestionar Solicitud de Agendamiento Sala Qx No.:".$id_solicitud;
						$id_usuario_asigna = $this->session->userdata('C_id_usuario');	
						$id_usuario_tarea = '';				

						$registro3=array(
							'tipo_tarea' =>'Gestionar Solicitud',
							'id_modulo' =>'1',
							'descripcion'=>$descripcion,
							'id_solicitud' =>$id_solicitud,
							'id_usuario_asigna'=>$id_usuario_asigna,
							'id_usuario_tarea'=>$row['id_empleado'],					
							'estado'=>'0',
							'fecha_registro'=>$fecha
						);

						$query2 = $this->general_model->insert('tareas', $registro3);
					}
				}
				if($query2 >= 1) {
					
					$fecha = date('Y-m-d H:i:s');
					$msg='';
					$usuario ='';
					$correo_cirujano='';
					$id_usuario = $this->session->userdata('C_id_usuario');
					$paciente = $this->input->post('paciente');
					$cedula = $this->input->post('cedula');
					$fecha_programacion = $this->input->post('fechaprogramacion');
					$hora_programacion = $this->input->post('horaprogramacion');
					$cirujano ='';
					$id_cirujano = $this->input->post('id_cirujano');
					$procedimiento = implode(',', (array)$this->input->post('procedimiento'));

					$campos1='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Cirujano", email AS "Correo"';
					$query11 = $this->general_model->consulta_personalizada($campos1,'empleados', 'id_empleado = "'.$id_cirujano.'"', '', 0, 0);
					foreach ($query11->result_array() as $row1)
					{
						$cirujano = $row1['Cirujano'];
						$correo_cirujano = $row1['Correo'];
					}

					$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
					$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
					foreach ($query12->result_array() as $row)
					{
						$usuario = $row['Usuario'];
					}

					$de=$cirujano."<".$correo_cirujano.">";
				    
					$Para ="cirugia@sigca.cecimin.com.co,secirugia@colsanitas.com";
					//$Para ="germanparra2022@gmail.com,castonino17@gmail.com";
					$Asunto ="Solicitud Agendamiento Dr(a).".$cirujano.", Paciente: '".$paciente."'";

					$Cabeceras = "From:".$de."\r\n"; 
					$Cabeceras .= "MIME-Version: 1.0\r\n";					
					$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
						
					$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";				
					$cuerpo .= "<div><font size='3'>Programación de Cirugias,</font></div>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<div><font size='3'>El presente es para solicitar la programacion un cupo con los siguientes datos:</font></div>\r\n";
					$cuerpo .= "<br>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Especialista:</b> ".$cirujano."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'><b>Cirugía:</b> ".$procedimiento."</font></div>\r\n";
				    $cuerpo .= "<br>\r\n";		
				    $cuerpo .= "<br>\r\n";
				    $cuerpo .= "<br>\r\n";	
				    $cuerpo .= "<div><font size='3'><b>Solicita:</b> ".$usuario."</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'>Por favor Gestionar solicitud</font></div>\r\n";
				    $cuerpo .= "<div><font size='3'>Gracias por su colaboración y gestión</font></div>\r\n";
				    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";					
					$cuerpo .= "<br>\r\n";
					
					$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
					if($msg=1){
						$query = 1;
					}else{
						$query =-999;						
					}
					echo '1';					
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function guardar_revision() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$fecha = date('Y-m-d H:i:s');
				$idprog = $this->input->post('idreg');
				$estado = $this->input->post('estado');
				$id_paciente = $this->input->post('idpaciente');
				$registro=array(

					'id_usuario_r'=>$this->session->userdata('C_id_usuario'),
					'observaciones_r'=>$this->input->post('observaciones_r'),
					'salaQx'=>$this->input->post('salaqx'),
					'fecha_revision'=>$fecha,
					'estado'=>$this->input->post('estado')
				);
				//echo var_dump($registro);

				$query = $this->general_model->update('programacion', 'id_programacion', $idprog, $registro);
				
				if($query=="OK"){
					//Cambiar el estado visto a la notificacion.
					$usuarioactual = $this->session->userdata('C_id_usuario');
					$idnotificacion ="";
					$campos= 'id_notificacion';
					$query1 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$idprog.'" AND tipo_notificacion = "1" AND estado = "0"','', 0, 0);
					foreach ($query1->result_array() as $row){
						
						$idnotificacion =$row['id_notificacion'];					

						$registro1=array(									
							'estado'=>'1',
							'fecha_visto'=>$fecha							
						);

						$query = $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);
					}
					
					$idtarea="";
					$idmodulo="1";	
					$campos= 'id_tareas';	

					$query1 = $this->general_model->consulta_personalizada($campos,'tareas',' id_solicitud = "'.$idprog.'" AND id_modulo = "'.$idmodulo.'" and estado="0"','', 0, 0);
					foreach ($query1->result_array() as $row){
						
						$idtarea =$row['id_tareas'];
					

						$registro1=array(
							'estado'=>'1',
							'fecha_visto'=>$fecha							
						);

						$query = $this->general_model->update('tareas', 'id_tareas', $idtarea, $registro1);
					
					}					
					
				}if($query=="OK"){
					if($estado == '1'){
					 //SI EXISTEN MATERIALES PASA LA NOTIFICACION A LAS INSTRUMENTADORAS 
				    	$id_solicitud = $idprog;
						$tipo_notificacion="1";
						$id_usuario_notifica = $this->session->userdata('C_id_usuario');
						$observacion ="Solicitar Materiales para el cupo de Agendamiento Sala Qx No.".$idprog." ";
						
						$campos = 'id_empleado';
						$query = $this->general_model->consulta_personalizada($campos,'usuarios','perfil ="8"','',0,0);
						foreach ($query->result_array() as $row){
							
							$registro2=array(
								'tipo_notificacion'=>$tipo_notificacion,
								'id_solicitud'=>$id_solicitud,
								'id_usuario_notifica'=>$id_usuario_notifica,
								'id_usuario_2'=>$row['id_empleado'],
								'observacion'=>$observacion,
								'estado'=>'0',
								'fecha_registro'=>$fecha
							);

							$query = $this->general_model->insert('notificaciones', $registro2);

							$descripcion="Gestionar Solicitud Materiales para el cupo de Agendamiento Sala Qx No.:".$idprog;
							$id_usuario_asigna = $this->session->userdata('C_id_usuario');
							$id_usuario_tarea =	$row['id_empleado'];				

							$registro3=array(
								'tipo_tarea' =>'Gestionar Solicitud',
								'id_modulo' =>'1',
								'descripcion'=>$descripcion,
								'id_solicitud' =>$id_solicitud,
								'id_usuario_asigna'=>$id_usuario_asigna,
								'id_usuario_tarea'=>$id_usuario_tarea,						
								'estado'=>'0',
								'fecha_registro'=>$fecha
							);

							$query = $this->general_model->insert('tareas', $registro3);
						}
							
					}elseif($estado == '2'){	
					//<---- NO EXISTEN MATERIALES PASA LA NOTIFICACION AL CIRUJANO ----> //	
											
					  	$id_solicitud = $idprog;
						$tipo_notificacion="1";
						$id_usuario_notifica = $this->session->userdata('C_id_usuario');
						$id_usuario_2 = $this->input->post('usuario_crea');
						$observacion ="Solicitud de Agendamiento Sala Qx N".$idprog." fue Confirmada";

						$registro2=array(
							'tipo_notificacion'=>$tipo_notificacion,
							'id_solicitud'=>$id_solicitud,
							'id_usuario_notifica'=>$id_usuario_notifica,
							'id_usuario_2'=>$id_usuario_2,
							'observacion'=>$observacion,
							'estado'=>'0',
							'fecha_registro'=>$fecha
						);

						$query = $this->general_model->insert('notificaciones', $registro2);

						//<<-------- ENVIA CORREO AL CIRUJANO ------->>//				
						if($query >=1){

							$id_usuario = $this->session->userdata('C_id_usuario');
							$paciente = $this->input->post('paciente');
							$cedula = $this->input->post('cedula');
							
							$fecha_programacion = $this->input->post('fechaprogramacion');
							$hora_programacion = $this->input->post('horaprogramacion');

							$hora_llegada = strtotime('-90 minute', strtotime ($hora_programacion));
							$hora_llegada = date('H:i:s', $hora_llegada);
							$cirujano ='';
							$id_cirujano = $this->input->post('id_cirujano');
							$observaciones_r = $this->input->post('observaciones_r');
							$procedimiento = implode(",", $this->input->post('procedimiento'));

							$materiales = implode(",",$this->input->post('materiales'));
							$Materiales="";
							if($Materiales!=""){
								$query1 = $this->general_model->consulta_personalizada('GROUP_CONCAT(m.nombre_material) AS "Materiales"','materiales_qx', 'FIND_IN_SET( m.id_material,'.$materiales.')', '', 0, 0);
								foreach ($query1->result_array() as $row)
								{
									$Materiales=$row['Materiales'];
								}
							}
							
							$campos='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Cirujano", email AS "Correo"';
							$query1 = $this->general_model->consulta_personalizada($campos,'empleados', 'id_empleado = "'.$id_cirujano.'"', '', 0, 0);
							foreach ($query1->result_array() as $row)
							{
								$cirujano = $row['Cirujano'];
								$correo_cirujano = $row['Correo'];
							}

							$campos='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
							$query = $this->general_model->consulta_personalizada($campos,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
							foreach ($query->result_array() as $row)
							{
								$usuario = $row['Usuario'];
							}

							$de='Cirugia CECIMIN <secirugia@colsanitas.com>';
							$Para ="'".$cirujano."-<$correo_cirujano>";
							//$Para ='germanparra2022@gmail.com,castonino17@gmail.com';
							$Asunto ='Confirmación de cupo asignado al Paciente: "'.$paciente.'"';

							$Cabeceras = "From:".$de."\r\n";
							$Cabeceras .= "MIME-Version: 1.0\r\n"; 
							$Cabeceras .= "Content-type: text/html; charset=utf-8\n";//para enviar archivo adjunto al correo electronico							
							$cuerpo = "<div><font size='3'>Doctor(a),</font></div>\r\n";
							$cuerpo .= "<div><font size='3'>".$cirujano."</font></div>\r\n";				
							$cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";
							$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
							$cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";	
							$cuerpo .= "<div><font size='3'>Por medio de la presente nos permitimos informar que el cupo solicitado con los siguientes datos, fue confirmado.</font></div>\r\n";
							$cuerpo .= "<br>\r\n";
							$cuerpo .= "<div><font size='4'><b>Datos del Procedimiento Quirurgico</b></font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Cirujano:</b> ".$cirujano."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Procedimiento Quirurgico:</b> ".$procedimiento."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Remisión:</b> ".$Materiales." </font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Observaciones:</b> ".$observaciones_r." </font></div>\r\n";
						    $cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";
						    $cuerpo .= "<br>\r\n";	
						    $cuerpo .= "<div><font size='3'><b>Confirmado por:</b> ".$usuario."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Programación de Cirugias Ambulatoria</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 No. 104-76 piso 3</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>(601) 6196253</font></div>\r\n";						    
						    $cuerpo .= "<div><font size='3'>(601) 6002555 ext. 109-158</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>3153931960</font></div>\r\n";		
							$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px' src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>\r\n";		
							$cuerpo .= "\r\n";
							
							$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
							if($msg=1){
								$query = 1;
								
							}else{
								$query =-999;
													
							}

							$campos = 'IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Paciente", correo AS "Correo"';
							$query1 = $this->general_model->consulta_personalizada($campos,'pacientes', 'id_paciente = "'.$id_paciente.'"', '', 0, 0);
							foreach ($query1->result_array() as $row)
							{
								$paciente = $row['Paciente'];
								$correo_paciente = $row['Correo'];
							}

							$de='Cirugia CECIMIN <secirugia@colsanitas.com>';
							$Para ="'".$paciente."-<$correo_paciente>";
							
							$Asunto ='Reconfirmación de Cirugia: "'.$procedimiento.'"';

							$Cabeceras = "From:".$de."\r\n";
							$Cabeceras .= "MIME-Version: 1.0\r\n"; 
							$Cabeceras .= "Content-type: text/html; charset=utf-8\n";//para enviar archivo adjunto al correo electronico							
							$cuerpo = "<div><font size='3'>Señor(a),</font></div>\r\n";
							$cuerpo .= "<div><font size='3'>".$paciente."</font></div>\r\n";				
							$cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";
							$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
							$cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";	
							$cuerpo .= "<div><font size='3'>Señor(a) '".$paciente."', Le escribimos la Unidad Médica CECIMIN SAS de cirugía ambulatoria, para reconfirmar su procedimiento '".$procedimiento."' con el Doctor(a) '".$cirujano."', a realizar el '".$fecha_programacion."' a las '".$hora_programacion."', recuerde que debe presentarse favor debe presentarse a las '".$hora_llegada."', en la recepción del primer piso,  en ayunas según recomendación de anestesia,  con ropa cómoda, no traer objetos de valor, venir sin maquillaje y sin esmalte en uñas de manos y pies. Dirección Avenida Carrera 45 No. 104-76. Es importante que asista con un solo acompañante que no sea mayor de 60 años ni menor de 18 años de edad</font></div>\r\n";
							$cuerpo .= "<br>\r\n";
							$cuerpo .= "<div><font size='4'>1. Recuerde: si su cirugía es por medicina prepagada, radicar la orden de la cirugía, con la entidad prepagada (Colsanitas, Medianitas, Banco República, Seguros Bolívar póliza, Unisalud).</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>2. Solicitar lo antes posible, la cita de valoración de anestesia en la línea 3759333.</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>3. ¿Por favor nos puede confirmar si ya recibió el esquema de vacunación para COVID -19.(Dosis y fecha de aplicacion cada dosis)? </font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>“RECUERDE TRAER TODO LOS DOCUMENTOS EN FISICO QUE LE ENTREGO EL ESPECIALISTA Y SI YA FUE VACUNADO TRAER FOTOCOPIA DEL CARNET DE VACUNA COVID”.</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Si el paciente requiere PCR, se le envía adicionalmente este mensaje </font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>“RECUERDE POR FAVOR EL RESULTADO DE LA PRUEBA MOLECULAR RT-PCR (COVID-19), ESTA ES MUY IMPORTANTE PARA PODER REALIZAR SU CIRUGÍA POR FAVOR, SI ES POSIBLE ENVIAR EL RESULTADO POR ESTE MEDIO, ESTA SE DEBE TOMAR POR FAVOR  48 HORAS ANTES DE LA CIRUGÍA”</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'><b>POR FAVOR CONFIRMAR ESTE MENSAJE GRACIAS.</b></font></div>\r\n";
						    $cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";
						    $cuerpo .= "<br>\r\n";	
						    $cuerpo .= "<div><font size='3'><b>Confirmado por:</b> ".$usuario."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Programación de Cirugias Ambulatoria</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>(601) 6196253</font></div>\r\n";						    
						    $cuerpo .= "<div><font size='3'>(601) 6002555 ext. 109-158</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>3153931960</font></div>\r\n";		
							$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px' src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>\r\n";		
							$cuerpo .= "\r\n";
							
							$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
							if($msg=1){
								$query = 1;								
							}else{
								$query =-999;													
							}
						}
					}else if($estado == "3"){ //RECHAZA LA SOLICITUD

						$id_solicitud = $idprog;
						$tipo_notificacion="1";
						$id_usuario_notifica = $this->session->userdata('C_id_usuario');
						$id_usuario_2 = $this->input->post('usuario_crea');
						$observacion ="Solicitud de Agendamiento Sala Qx N".$idprog." fue Rechazada";

						$registro2=array(
							'tipo_notificacion'=>$tipo_notificacion,
							'id_solicitud'=>$id_solicitud,
							'id_usuario_notifica'=>$id_usuario_notifica,
							'id_usuario_2'=>$id_usuario_2,
							'observacion'=>$observacion,
							'estado'=>'0',
							'fecha_registro'=>$fecha
						);

						$query = $this->general_model->insert('notificaciones', $registro2);
					
						if($query >= 1) {

							$id_usuario = $this->session->userdata('C_id_usuario');
							$paciente = $this->input->post('paciente');
							$cedula = $this->input->post('cedula');
							$fecha_programacion = $this->input->post('fechaprogramacion');
							$hora_programacion = $this->input->post('horaprogramacion');
							$observaciones_R = $this->input->post('observaciones');
							$cirujano ='';
							$id_cirujano = $this->input->post('id_cirujano');
							$procedimiento = implode(",", $this->input->post('procedimiento'));
							
							$campos='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Cirujano", email AS "Correo"';
							$query1 = $this->general_model->consulta_personalizada($campos,'empleados', 'id_empleado = "'.$id_cirujano.'"', '', 0, 0);
							foreach ($query1->result_array() as $row)
							{
								$cirujano = $row['Cirujano'];
								$correo_cirujano = $row['Correo'];
							}

							$campos='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
							$query1 = $this->general_model->consulta_personalizada($campos,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
							foreach ($query1->result_array() as $row)
							{
								$usuario = $row['Usuario'];
							}

							$de='Cirugia CECIMIN <secirugia@colsanitas.com>';
							$Para ="'".$cirujano."-<$correo_cirujano>";
							//$Para ="germanparra2022@gmail.com";
							$Asunto ="Rechazo de cupo asignado al Paciente: '".$paciente."'";
								
							$Cabeceras = "From:".$de."\r\n"; 
							$Cabeceras .= "MIME-Version: 1.0\r\n";
							$Cabeceras .= "Content-type: text/html; charset=utf-8\n";
								
							$cuerpo = "<div><font size='3'>Doctor,</font></div>\r\n";	
							$cuerpo .= "<div><font size='3'><b>".$cirujano."</b>,</font></div>\r\n";	
							$cuerpo .= "<br>\r\n";
							$cuerpo .= "<br>\r\n";
							$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
							$cuerpo .= "<br>\r\n";
							$cuerpo .= "<br>\r\n";
							$cuerpo .= "<div><font size='3'>Por medio de la presente le estamos rechazando su solicitud del cupo solicitado para el paciente ".$paciente.", por las siguientes razones:</font></div>\r\n";
							$cuerpo .= "<div><font size='3'>".$observaciones_R."</font></div>\r\n";
						    $cuerpo .= "<br>\r\n";		
						    $cuerpo .= "<br>\r\n";
						    $cuerpo .= "<div><font size='3'><b>Rechazada por:</b> ".$usuario."</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Programación de Cirugias Ambulatoria</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>(601) 6196253</font></div>\r\n";						    
						    $cuerpo .= "<div><font size='3'>(601) 6002555 ext. 109-158</font></div>\r\n";
						    $cuerpo .= "<div><font size='3'>3153931960</font></div>\r\n";						
							$cuerpo .= "\r\n";
							
							$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
							if($msg=1){
								$query = 1;
							}else{
								$query =-999;						
							}							
						}						
					}
					echo "1";
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function guardar_solicitud() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$fecha = date('Y-m-d H:i:s');
				$idprog = $this->input->post('idreg');
				$estado = $this->input->post('estado');

				//Correo Casas Comerciales
				$correo1 = $this->input->post('email_casa1');
				$val_correo1 = implode(',', (array) $correo1);
				
				if (null!== $this->input->post('email_casa2')){
					$correo2 = $this->input->post('email_casa2');
					$val_correo2 = implode(',', (array) $correo2);
				}else{
					$correo2 ='';
				}
				if (null!==$this->input->post('email_casa3')){
					$correo3 = $this->input->post('email_casa3');
					$val_correo3 = implode(',', (array) $correo3);
				}else{
					$correo3 ='';
				}
				if (null!==$this->input->post('email_casa4')){
					$correo4 = $this->input->post('email_casa4');
					$val_correo4 = implode(',', (array) $correo4);
				}else{
					$correo4 ='';
				}

				$casa1='';
				$correosc1 ='';
				$casa2='';
				$correosc2 ='';
				$casa3='';
				$correosc3 ='';
				$casa4='';
				$correosc4 ='';
				$msg='';
				$usuario ='';
				
				$id_usuario = $this->session->userdata('C_id_usuario');
				$id_paciente = $this->input->post('idpaciente');
				$paciente = $this->input->post('paciente');
				$cedula = $this->input->post('cedula');
				$fecha_programacion = $this->input->post('fechaprogramacion');
				$hora_programacion = $this->input->post('horaprogramacion');
				$hora_llegada = strtotime('-90 minute', strtotime ($hora_programacion));
				$hora_llegada = date('H:i:s', $hora_llegada);
				$cirujano ='';
				$correo_cirujano = '';
				$id_cirujano = $this->input->post('id_cirujano');
				$procedimiento = implode(",", $this->input->post('procedimiento'));

				$campos='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Cirujano", email AS "Correo"';
				$query1 = $this->general_model->consulta_personalizada($campos,'empleados', 'id_empleado = "'.$id_cirujano.'"', '', 0, 0);
				foreach ($query1->result_array() as $row)
				{
					$cirujano = $row['Cirujano'];
					$correo_cirujano = $row['Correo'];
				}

				$campos='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
				$query = $this->general_model->consulta_personalizada($campos,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
				foreach ($query->result_array() as $row)
				{
					$usuario = $row['Usuario'];
				}	

				if($estado=="2"){

					$de="instrumenta@saludinteligente.com";

					//<<<-------- ENVIO DE EMAIL CASA COMERCIAL 1------->>>//
					if($correo1!="" || $correo1.length!= 0){ 

						$idcasa=$this->input->post('proveedoresQx_agendamiento1');
						
						$campos='t.razon_social as "Nombre", GROUP_CONCAT(tc.correo) as "Correos"';
						$query1 = $this->general_model->consulta_personalizada($campos,'terceros t INNER JOIN terceros_correos tc ON t.id_tercero = tc.id_tercero','tc.id_tercero = "'.$idcasa.'" GROUP BY t.id_tercero','', 0, 0);
						foreach ($query1->result_array() as $row)
						{
							$casa1 = $row['Nombre'];
							$correosc1 =$row['Correos'];	
						}
						
						$Para =$correosc1;
						//$Para ="castonino17@gmail.com";
						$Asunto ="Cx Dr.'".$cirujano."' ,CECIMIN SAS";
							
						$Cabeceras = "From:".$de."\r\n";							
						// $Cabeceras .= "Cc:'".$cirujano." <".$correo_cirujano.">', instrumenta@saludinteligente.com\r\n";
						// $Cabeceras .= "Cc: germanparra2022@gmail.com\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n";				
						$Cabeceras .= "Content-type: text/html; charset=utf-8\r\n"; 

						$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'><b>".$casa1."</b></font></div>\r\n";
						$cuerpo .= "<div><font size='3'>A quien corresponda.</font></div>\r\n";				
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";	
						$cuerpo .= "<div><font size='3'>El presente es para solicitar la siguiente remisión:</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Especialista:</b> ".$cirujano."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Cirugía:</b> ".$procedimiento."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Remisión:</b> ".$this->input->post('materiales1')." </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'><b>Solicita:</b> ".$usuario."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Por favor confirmar solicitud</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Gracias por su colaboración y gestión</font></div>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";					    
					    $cuerpo .= "<div><font size='3'><b>Instrumentación Quirúrgica</b> </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Salas de Cirugia</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Tel.: 6196253/ 6002555 EXT 158/109</font></div>\r\n";
					    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/></div>\r\n";				
						
						$cuerpo .= "\r\n";
						
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}						
					}
					if($correo2!=""){ //<<<-------- ENVIO DE EMAIL CASA COMERCIAL 2------->>>//

						$idcasa=$this->input->post('proveedoresQx_agendamiento2');
						$campos="t.razon_social as 'Nombre', GROUP_CONCAT(tc.correo) as 'Correos'";
						$query1 = $this->general_model->consulta_personalizada($campos,"terceros t INNER JOIN terceros_correos tc ON t.id_tercero = tc.id_tercero", "tc.id_tercero = '".$idcasa."' GROUP BY t.id_tercero",'', 0, 0);
						foreach ($query1->result_array() as $row)
						{
							$casa2 = $row['Nombre'];
							$correosc2 =$row['Correos'];
						}
												
						$Para =$correosc2;
						//$Para ="castonino17@gmail.com";
						$Asunto ="Cx Dr. ".$cirujano." , CECIMIN S.A.S";

						$Cabeceras = "From:".$de."\r\n";
						// $Cabeceras .= "Cc:'".$cirujano." <".$correo_cirujano.">', instrumenta@saludinteligente.com\r\n";
						$Cabeceras .= "Cc: edwincas_17@hotmail.com\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n";						
						$Cabeceras .= "Content-type: text/html; charset=utf-8\r\n";				
						
						$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'><b>".$casa2."</b></font></div>\r\n";
						$cuerpo .= "<div><font size='3'>A quien corresponda.</font></div>\r\n";				
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>El presente es para solicitar la siguiente remisión:</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Especialista:</b> ".$cirujano."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Cirugía:</b> ".$procedimiento."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Remisión:</b> ".$this->input->post('materiales2')." </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'><b>Solicita:</b> ".$usuario."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Por favor confirmar solicitud</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Gracias por su colaboración y gestión</font></div>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";					    
					    $cuerpo .= "<div><font size='3'><b>Instrumentación Quirúrgica</b> </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Salas de Cirugia</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";					    
					    $cuerpo .= "<div><font size='3'>Tel.: 6196253/ 6002555 EXT 158/109</font></div>\r\n";			
						$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/></div>\r\n";	
						$cuerpo .= "\r\n";
						
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}
					}
					//<<<-------- ENVIO DE EMAIL CASA COMERCIAL 3------->>>//
					if($correo3!=""){ 
						
						$idcasa=$this->input->post('proveedoresQx_agendamiento3');
						$campos='t.razon_social as "Nombre", GROUP_CONCAT(tc.correo) as "Correos3"';
						$query1 = $this->general_model->consulta_personalizada($campos,'terceros t INNER JOIN terceros_correos tc ON t.id_tercero = tc.id_tercero', 'tc.id_tercero = "'.$idcasa.'" GROUP BY t.id_tercero','', 0, 0);
						foreach ($query1->result_array() as $row)
						{
							$casa3 = $row['Nombre'];
							$correosc3 =$row['Correos3'];
						}

						$Para =$correosc3;
						//$Para ="germanparra2022@gmail.com,castonino17@gmail.com";
						$Asunto ="Cx Dr. ".$cirujano.", CECIMIN S.A.S";
							
						$Cabeceras = "From:".$de."\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n"; 
						// $Cabeceras .= "Cc:'".$cirujano." <".$correo_cirujano.">', instrumenta@saludinteligente.com\r\n";
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n";//para enviar archivo adjunto al correo electronico							
						$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'><b>".$casa3."</b></font></div>\r\n";
						$cuerpo .= "<div><font size='3'>A quien corresponda.</font></div>\r\n";				
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";	
						$cuerpo .= "<div><font size='3'>El presente es para solicitar la siguiente remisión:</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Especialista:</b> ".$cirujano."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Cirugía:</b> ".$procedimiento."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Remisión:</b> ".$this->input->post('materiales3')." </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'><b>Solicita:</b> ".$usuario."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Por favor confirmar solicitud</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Gracias por su colaboración y gestión</font></div>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";					    
					    $cuerpo .= "<div><font size='3'><b>Instrumentación Quirúrgica</b> </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Salas de Cirugia</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Tel.: 6196253/ 6002555 EXT 158/109</font></div>\r\n";			
						$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/></div>\r\n";	
						$cuerpo .= "\r\n";
						
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}
					}
					//<<<-------- ENVIO DE EMAIL CASA COMERCIAL 3------->>>//
					if($correo4!=""){ 
						
						$idcasa=$this->input->post('proveedoresQx_agendamiento4');
						$campos='t.razon_social as "Nombre", GROUP_CONCAT(tc.correo) as "Correos4"';
						$query1 = $this->general_model->consulta_personalizada_a($campos,'terceros t INNER JOIN terceros_correos tc ON t.id_tercero = tc.id_tercero', 'tc.id_tercero = "'.$idcasa.'" GROUP BY t.id_tercero','', 0, 0);
						foreach ($query1->result_array() as $row)
						{
							$casa4 = $row['Nombre'];
							$correosc4 =$row['Correos4'];
						}

						$Para =$correosc4;
						//$Para ="castonino17@gmail.com";
						$Asunto ="Cx Dr. ".$cirujano.", CECIMIN S.A.S";
	
						$Cabeceras = "From:".$de."\r\n";

						$Cabeceras .= "MIME-Version: 1.0\r\n"; 
						// $Cabeceras .= "Cc:'".$cirujano." <".$correo_cirujano.">', instrumenta@saludinteligente.com\r\n";
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n";//para enviar archivo adjunto al correo electronico							
						$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'><b>".$casa4."</b></font></div>\r\n";
						$cuerpo .= "<div><font size='3'>A quien corresponda.</font></div>\r\n";				
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";	
						$cuerpo .= "<div><font size='3'>El presente es para solicitar la siguiente remisión:</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Especialista:</b> ".$cirujano."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Cirugía:</b> ".$procedimiento."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Remisión:</b> ".$this->input->post('materiales4')." </font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'><b>Solicita:</b> ".$usuario."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Por favor confirmar solicitud</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Gracias por su colaboración y gestión</font></div>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";					    
					    $cuerpo .= "<div><font size='3'><b>Instrumentación Quirúrgica</b> </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Salas de Cirugia</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Tel.: 6196253/ 6002555 EXT 158/109</font></div>\r\n";			
						$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/></div>\r\n";	
						$cuerpo .= "\r\n";
						
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}
					}

					if($query >=1){

						$campos = 'IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Paciente", correo AS "Correo"';
						$query1 = $this->general_model->consulta_personalizada($campos,'pacientes', 'id_paciente = "'.$id_paciente.'"', '', 0, 0);
						foreach ($query1->result_array() as $row)
						{
							$paciente = $row['Paciente'];
							$correo_paciente = $row['Correo'];
						}

						$de='Cirugia CECIMIN <secirugia@colsanitas.com>';
						$Para ="'".$paciente."-<$correo_paciente>";
						//$Para ="edwincas_17@hotmail.com";
						$Asunto ='Reconfirmación de Cirugia: "'.$procedimiento.'"';

						$Cabeceras = "From:".$de."\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n"; 
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n";//para enviar archivo adjunto al correo electronico							
						$cuerpo = "<div><font size='3'>Señor(a),</font></div>\r\n";
						$cuerpo .= "<div><font size='3'>".$paciente."</font></div>\r\n";				
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";	
						$cuerpo .= "<div><font size='3'>Señor(a) ".$paciente.", Le escribimos la Unidad Médica CECIMIN SAS de cirugía ambulatoria, para reconfirmar su procedimiento ".$procedimiento." con el Doctor(a) ".$cirujano.", a realizar el  ".$fecha_programacion."  a las ".$hora_programacion.", recuerde que debe presentarse a las  ".$hora_llegada.", en la recepción del primer piso,  en ayunas según recomendación de anestesia,  con ropa cómoda, no traer objetos de valor, venir sin maquillaje y sin esmalte en uñas de manos y pies. Dirección Avenida Carrera 45 No. 104-76. Es importante que asista con un solo acompañante que no sea mayor de 60 años ni menor de 18 años de edad</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='4'>1. Recuerde: si su cirugía es por medicina prepagada, radicar la orden de la cirugía, con la entidad prepagada (Colsanitas, Medianitas, Banco República, Seguros Bolívar póliza, Unisalud).</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>2. Solicitar lo antes posible, la cita de valoración de anestesia en la línea 3759333.</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>3. ¿Por favor nos puede confirmar si ya recibió el esquema de vacunación para COVID -19.(Dosis y fecha de aplicacion cada dosis)? </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>“RECUERDE TRAER TODO LOS DOCUMENTOS EN FISICO QUE LE ENTREGO EL ESPECIALISTA Y SI YA FUE VACUNADO TRAER FOTOCOPIA DEL CARNET DE VACUNA COVID”.</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Si el paciente requiere PCR, se le envía adicionalmente este mensaje </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>“RECUERDE POR FAVOR EL RESULTADO DE LA PRUEBA MOLECULAR RT-PCR (COVID-19), ESTA ES MUY IMPORTANTE PARA PODER REALIZAR SU CIRUGÍA POR FAVOR, SI ES POSIBLE ENVIAR EL RESULTADO POR ESTE MEDIO, ESTA SE DEBE TOMAR POR FAVOR  48 HORAS ANTES DE LA CIRUGÍA”</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'><b>POR FAVOR CONFIRMAR ESTE MENSAJE GRACIAS.</b></font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";	
					    $cuerpo .= "<div><font size='3'><b>Confirmado por:</b> ".$usuario."</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Programación de Cirugias Ambulatoria</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>(601) 6196253</font></div>\r\n";						    
					    $cuerpo .= "<div><font size='3'>(601) 6002555 ext. 109-158</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>3153931960</font></div>\r\n";		
						$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px' src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/><div>\r\n";		
						$cuerpo .= "\r\n";
						
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
							
						}else{
							$query =-999;												
						}
					}

					if($query >=1){ //<<<-------- ACTUALIZANDO TABLA DE PROGRAMACION ------->>>//

						$registro=array(
							'id_usuario_SM'=>$this->session->userdata('C_id_usuario'),					
							'fecha_solicitud_materiales'=>$fecha,
							'observaciones_sm'=>$this->input->post('observaciones_s'),
							'estado'=>'2'
						);
						$query = $this->general_model->update('programacion', 'id_programacion', $idprog, $registro);
					}
				}elseif($estado=="3"){

				 	$id_solicitud = $idprog;
					$tipo_notificacion="1";
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					$id_usuario_2 = $this->input->post('usuario_crea');
					$observacion ="Solicitud de Agendamiento Sala Qx N".$idprog." fue Rechazada";
					$observaciones = $this->input->post('observaciones_s');
					$registro2=array(
						'tipo_notificacion'=>$tipo_notificacion,
						'id_solicitud'=>$id_solicitud,
						'id_usuario_notifica'=>$id_usuario_notifica,
						'id_usuario_2'=>$id_usuario_2,
						'observacion'=>$observacion,
						'estado'=>'0',
						'fecha_registro'=>$fecha
					);

					$query = $this->general_model->insert('notificaciones', $registro2);
				
					if($query >= 1) {

						$de='Cirugia CECIMIN <instrumenta@saludinteligente.com>';
						$Para ="".$cirujano." <".$correo_cirujano.">";
						$Asunto ="Rechazo de cupo asignado al Paciente: '".$paciente."'";
							
						$Cabeceras = "From:".$de."\r\n"; 
						$Cabeceras .= "MIME-Version: 1.0\r\n";
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n";
							
						$cuerpo = "<div><font size='3'>Doctor,</font></div>\r\n";	
						$cuerpo .= "<div><font size='3'><b>".$cirujano."</b>,</font></div>\r\n";	
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='3'>Por medio de la presente le estamos rechazando su solicitud del cupo solicitado para el paciente ".$paciente.", por las siguientes razones:</font></div>\r\n";
						$cuerpo .= "<div><font size='3'>".$observaciones."</font></div>\r\n";
					    $cuerpo .= "<br>\r\n";		
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<div><font size='3'><b>Rechazada por:</b> ".$usuario."</font></div>\r\n";
					    $cuerpo .= "<br>\r\n";
					    $cuerpo .= "<br>\r\n";					    
					    $cuerpo .= "<div><font size='3'><b>Instrumentación Quirúrgica</b> </font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Salas de Cirugia</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Avenida Carrera 45 #104-76 piso 3</font></div>\r\n";
					    $cuerpo .= "<div><font size='3'>Tel.: 6196253/ 6002555 EXT 158/109</font></div>\r\n";
					    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/></div>\r\n";	
						$cuerpo .= "\r\n";
						
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if($msg=1){
							$query = 1;
						}else{
							$query =-999;						
						}							
					}
				}

				if($query >=1){ //<<<-------- ACTUALIZANDO TABLA DE PROGRAMACION ------->>>//

					$registro=array(
						'id_usuario_SM'=>$this->session->userdata('C_id_usuario'),					
						'fecha_solicitud_materiales'=>$fecha,
						'observaciones_sm'=>$this->input->post('observaciones_s'),
						'estado'=>'3'
					);

					$query1 = $this->general_model->update('programacion', 'id_programacion', $idprog, $registro);
				}

				if($query1=="OK"){ //<<<-------- CAMBIANDO EL ESTADO A LAS NOTIFICACIONES Y TAREAS DEL USUARIO ------->>>//
					
					$usuarioactual = $this->session->userdata('C_id_usuario');
					$campos= 'id_notificacion';
					$idnotificacion ="";
					$query1 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$idprog.'" AND tipo_notificacion = "1" AND estado = "0"','', 0, 0);
					foreach ($query1->result_array() as $row){
						
						$idnotificacion =$row['id_notificacion'];					

						$registro1=array(									
							'estado'=>'1',
							'fecha_visto'=>$fecha							
						);

						$query = $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);
					}

					$campos= 'id_tareas';
					$idtarea="";
					$idmodulo="1";
					$query1 = $this->general_model->consulta_personalizada($campos,'tareas',' id_solicitud = "'.$idprog.'" AND id_modulo = "'.$idmodulo.'" and estado="0"','', 0, 0);
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
					$registro=array(
						'id_programacion'=>$this->input->post('idreg'),
						'material1'=>$this->input->post('materiales1'),
						'casa1'=>$casa1,
						'correo1'=>$correosc1,
						'observaciones1'=>$this->input->post('observaciones_instru1'),					
						'material2'=>$this->input->post('materiales2'),
						'casa2'=>$casa2,
						'correo2'=>$correosc2,
						'observaciones2'=>$this->input->post('observaciones_instru2'),					
						'material3'=>$this->input->post('materiales3'),
						'casa3'=>$casa3,
						'correo3'=>$correosc3,
						'observaciones3'=>$this->input->post('observaciones_instru3'),
						'fecha_registro'=>$fecha,
						'id_usuario'=>$usuario
					);	
					$query = $this->general_model->insert('programacion_envio_correo', $registro);
					echo '1';
				}else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					    case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function guardar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				//echo "ingreso";
				$registro=array(

					'id_tipodocumento'=>$this->input->post('Tipo_docidentidad_pacientes'),
					'numero_id'=>$this->input->post('numero_id1'),
					'nombres'=>$this->input->post('nombres'),
					'apellidos'=>$this->input->post('apellidos'),
					'edad'=>$this->input->post('edad'),
					'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),
					'id_entidad_salud'=>$this->input->post('eps_pacientes'),
					'otra_entidad_salud'=>$this->input->post('otra_eps'),
					'telefono'=>$this->input->post('telefono'),
					'correo'=>$this->input->post('correo'),
					'fecha_registro'=>date('Y-m-d H:i:s'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'1'
				);

				$query = $this->general_model->insert('pacientes', $registro);
				//var_dump($query);

				if($query >= 1)
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
	}

	public function modificar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');
			
			//$sql="SELECT nombre, id_responsable, estado  FROM centroscostos WHERE id_centrocosto = '$id' ";
			$query=$this->general_model->select_where('id_paciente, id_tipodocumento, numero_id, nombres, apellidos, fecha_nacimiento, id_entidad_salud, otra_entidad_salud, telefono, correo, estado', 'pacientes', array('id_paciente' => $id));
			$row = $query->row_array();
				
			$arr['pacientes'] = array('id_paciente'=>$row['id_paciente'], 'id_tipodocumento'=>$row['id_tipodocumento'], 'numero_id'=>$row['numero_id'],'nombres'=>$row['nombres'],'apellidos'=>$row['apellidos'], 'fecha_nacimiento'=>$row['fecha_nacimiento'], 'id_entidad_salud'=>$row['id_entidad_salud'], 'otra_entidad_salud'=>$row['otra_entidad_salud'], 'telefono'=>$row['telefono'], 'correo'=>$row['correo'],  'estado'=>$row['estado']);
			echo json_encode( $arr );
		}
	}

	public function actualizar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		}else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}else {
				//echo "ingreso";
				$id=$this->input->post('idregistropa');

				$registro=array(

					'id_tipodocumento'=>$this->input->post('Tipo_docidentidad_pacientes'),
					'numero_id'=>$this->input->post('numero_id'), 
					'nombres'=>$this->input->post('nombres'), 
					'apellidos'=>$this->input->post('apellidos'),
					'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),	
					'id_entidad_salud'=>$this->input->post('eps_pacientes'),
					'otra_entidad_salud'=>$this->input->post('otra_eps'),
					'telefono'=>$this->input->post('telefono'),				
					'correo'=>$this->input->post('correo'),
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 					
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('pacientes', 'id_paciente', $id, $registro);
				if($query=="OK")
					echo '1';
				else {
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



	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('P', 'mm', 'LETTER');
	        $pdf->AliasNbPages();

	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Listado de Contratos con Terceros", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);

	        $pdf->AddPage('P', 'LETTER');

            $pdf->Ln(10);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE CONTRATOS CON TERCEROS'), 0, 0, 'C', false);
            $pdf->Ln(10);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(195,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(5);

            $campos =' ct.id_contrato_tercero AS "id", CASE WHEN te.tipo_tercero="0" THEN "Proveedor" ELSE "Cliente" END AS "Tipotercero", te.razon_social AS "tercero", CASE WHEN ct.area="0" THEN "Asistencial" ELSE "Administrativa" END AS "Area", ct.objeto_contrato AS Objeto, ct.fecha_inicio AS "FechaInicio", ct.fecha_final AS "FechaFinal", CASE WHEN ct.prorroga="0" THEN "No" ELSE "Si" END AS "Prorroga", CASE WHEN c.estado="0" THEN "Vigente" WHEN c.estado="1" THEN "Terminado" ELSE "Prorogado" END AS "Estado" ';
            $query = $this->general_model->consulta_personalizada($campos, 'contratos_terceros ct INNER JOIN terceros te ON ct.id_tercero = te.id_tercero', '', '', 0, 0);

            $encabezados = $query->result();

			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Cell(15,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("TIPO TERCERO"),'LTRB',0,'C',$fill);
			$pdf->Cell(80,5,utf8_decode("RAZON SOCIAL"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("AREA"),'LTRB',0,'C',$fill);
			$pdf->Cell(100,5,utf8_decode("OBJETO"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("FECHA INICIO"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("FECHA FINAL"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("PRORROGA"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(4,5,' ',0,0,'C',false);
                $pdf->Cell(15,5,($row->id),'LTRB',0,'C',$fill);
                $pdf->Cell(25,5,utf8_decode($row->Tipotercero),'LTRB',0,'C',$fill);
                $pdf->Cell(80,5,utf8_decode($row->tercero),'LTRB',0,'C',$fill);
                $pdf->Cell(25,5,utf8_decode($row->Area),'LTRB',0,'C',$fill);
                $pdf->Cell(100,5,utf8_decode($row->Objeto),'LTRB',0,'C',$fill);
                $pdf->Cell(15,5,utf8_decode($row->FechaInicio),'LTRB',0,'C',$fill);
                $pdf->Cell(15,5,utf8_decode($row->FechaFinal),'LTRB',0,'C',$fill);
                $pdf->Cell(15,5,utf8_decode($row->Prorroga),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(15,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(15,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(4,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }

	        $pdf->Output('I', "Listado_Contratos_Terceros.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			$filename = "Listado_Documentos.xls";
			$usuario = $this->session->userdata('C_id_usuario');
		    header ("Content-Disposition: attachment; filename=".$filename );
			header ("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL SOLICITUDES DE CUPOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_programacion_tabla('EXCEL',$usuario));
            echo '</table>';
		}//-Valida Inicio de Session
	}

	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ){
			redirect();
		}else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}else {
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('programacion', 'id_programacion', $this->input->post('idreg'), $registro);
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

	public function cargar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('paci');

			$query=$this->general_model->select_where('p.id_paciente AS "Id",IFNULL(CONCAT(p.nombres, " ", p.apellidos),"") AS "Paciente"', 'pacientes p', array('p.numero_id' => $id) );
			$row = $query->row_array();

			$arr['pacientes'] = array('id_paciente'=>$row['Id'], 'paciente'=>$row['Paciente']);
			echo json_encode( $arr );
		}
	}

	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

				$campos ='pg.id_programacion AS "Id", pa.numero_id AS "Cedula", IFNULL(CONCAT(pa.nombres, " ", pa.apellidos), " ") AS "Paciente", IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Cirujano", GROUP_CONCAT(pr.nombre) AS "Procedimiento", (SELECT GROUP_CONCAT(m.nombre_material) from programacion_procedimientos pgp LEFT JOIN materiales_qx m ON FIND_IN_SET( m.id_material, pgp.materiales)WHERE pgp.id_programacion= "'.$idreg.'") AS "Materiales", pg.fecha_programacion AS "Fecha programacion", pg.hora_programacion AS "Hora", CASE WHEN pg.estado="0" THEN "Pendiente" WHEN pg.estado="1" THEN "Gestinada" WHEN pg.estado="2" THEN "Confirmada" ELSE "Rechazada" END AS "Estado",pg.observaciones AS "Observaciones", pg.fecha_revision AS "Fecha Revisión",pg.observaciones_r AS "Observaciones Programación", pg.fecha_solicitud_materiales AS "Fecha Solicitud Materiales", pg.observaciones_sm AS "Observaciones Instrumentación"';

            	$query = $this->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado INNER JOIN programacion_procedimientos pgp ON pg.id_programacion = pgp.id_programacion INNER JOIN procedimientos pr ON pgp.id_procedimiento = pr.id_procedimiento', 'pg.id_programacion = "'.$idreg.'"', '', 0, 0);
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

	//**************************** PERSONAL PROCEDIMIENTOS ******************************************************

	public function cargar_Dprocedimientos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$campos = 'pp.id_procedimiento_prog AS "ACCIONES", pp.id_programacion AS "ID", cx.nombre AS "PROCEDIMIENTO", IFNULL(pp.materiales,"") AS "MATERIALES", IFNULL(pp.otros,"") AS "OTROS",GROUP_CONCAT(te.razon_social,"") AS "PROVEEDOR"';

			    $query = $this->general_model->consulta_personalizada($campos, 'programacion_procedimientos pp INNER JOIN procedimientos cx ON pp.id_procedimiento=cx.id_procedimiento LEFT JOIN terceros te ON te.id_tercero=pp.proveedor_material', 'pp.id_usuario_temp = "'.$this->session->userdata('C_id_usuario').'" ', 'pp.id_programacion', 0, 0);

			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			    	$tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    $i=0;
			    foreach ($query->result_array() as $row)
			    {
			    	$i++;
			    	$acciones='<select name="botones_'.$row['ACCIONES'].'" id="botones_'.$row['ACCIONES'].'" class="form-control">
			    				<option value="0">--</option>
			    				<option value="1">Modificar</option>
			    				<option value="2">Eliminar</option></select>'; 
			    	$materiales = explode(',', $row['MATERIALES']);
			    	$material = '';
			    	If($row['MATERIALES']!=""){					    
					    $query1 = $this->general_model->consulta_personalizada('nombre_material', 'materiales_qx', ' estado = "1" AND id_material IN ('.$row['MATERIALES'].')', 'nombre_material', 0, 0);
					    foreach ($query1->result_array() as $row1)
					    {
					        if($material != '')
					        	$material .= ', ';
					        	$material .= $row1['nombre_material'];
					    }
				    }
			      	$tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$acciones.'</td><td>'.$i.'</td><td>'.$row['PROCEDIMIENTO'].'</td><td>'.$material.'</td><td>'.$row['OTROS'].'</td><td>'.$row['PROVEEDOR'].'</td><input type="hidden" id="procedimiento_'.$i.'" name="procedimiento[]" value="'.$row['PROCEDIMIENTO'].'"><input type="hidden" id="materiales_'.$i.'" name="materiales[]" value="'.$row['MATERIALES'].'"></tr>';
			    }			    
			    
			    $tabla .= '</tbody>';

			    echo $tabla;
			}
		}
	}

	public function cargar_Dprocedimientosf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$idprog = $this->input->post('idprog');
				$campos = 'pp.id_procedimiento_prog AS "ACCIONES", pp.id_programacion AS "ID", cx.nombre AS "PROCEDIMIENTO", IFNULL(pp.materiales,"") AS "MATERIALES", IFNULL(pp.otros,"") AS "OTROS",GROUP_CONCAT(te.razon_social,"") AS "PROVEEDOR"';

			    $query = $this->general_model->consulta_personalizada($campos, 'programacion_procedimientos pp INNER JOIN procedimientos cx ON pp.id_procedimiento=cx.id_procedimiento LEFT JOIN terceros te ON FIND_IN_SET( te.id_tercero, pp.proveedor_material)', ' pp.id_programacion = "'.$idprog.'"', '', 0, 0);

			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			    	$tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    $i=0;
			    foreach ($query->result_array() as $row)
			    {
			    	$i++;
			    	
			    	$acciones='<select name="botones_'.$row['ACCIONES'].'" id="botones_'.$row['ACCIONES'].'" class="form-control" >
			    				<option value="0">--</option>
			    				<option value="1">Modificar</option>
			    				<option value="2">Eliminar</option></select>';

			    	$materiales = explode(',', $row['MATERIALES']);
			    	$material = '';
			    	If($row['MATERIALES']!=""){					    
					    $query1 = $this->general_model->consulta_personalizada('nombre_material', 'materiales_qx', ' estado = "1" AND id_material IN ('.$row['MATERIALES'].')', 'nombre_material', 0, 0);
					    foreach ($query1->result_array() as $row1)
					    {
					        if($material != '')
					        	$material .= ', ';
					        	$material .= $row1['nombre_material'];
					    }
				    }
			      	$tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$acciones.'</td><td>'.$i.'</td><td>'.$row['PROCEDIMIENTO'].'</td><td>'.$material.'</td><td>'.$row['OTROS'].'</td><td>'.$row['PROVEEDOR'].'</td></td> <input type="hidden" id="procedimiento_'.$i.'" name="procedimiento[]" value="'.$row['PROCEDIMIENTO'].'"><input type="hidden" id="materiales_'.$i.'" name="materiales[]" value="'.$row['MATERIALES'].'"></tr>';
			    }
			    $tabla .= '</tbody>';

			    echo $tabla;
			}
		}
	}

	public function guardar_procedimientos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$materiales = $this->input->post('chk_materiales');
				$val_material = implode(',', (array) $materiales);

				$proveedor = $this->input->post('tercerosM_agendamiento');
				$val_proveedor = implode(',', (array) $proveedor);

				$procedimientoqx= $this->input->post('procedimientos_agendamiento');
				if($procedimientoqx=="" && $this->input->post('descripcion')!=""){
					$registro0 = array(
						'nombre'=>$this->input->post('descripcion'),
						'fecha_registro'=>date('Y-m-d H:i:s'),
						'estado'=>'1'
					);
					$query = $this->general_model->insert('procedimientos', $registro0);
					$procedimientoqx = $query;
				}
				$registro=array(
					'id_programacion'=>$this->session->userdata('C_id_usuario'),
					'id_procedimiento'=>$procedimientoqx,
					'descripcion_px' => '',
					'materiales'=>$val_material,
					'otros'=>$this->input->post('otros'),
					'proveedor_material'=>$val_proveedor,
					'fecha_registro'=>date('Y-m-d H:i:s'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'id_usuario_temp'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'1'
				);
				//echo var_dump($registro);

				$query = $this->general_model->insert('programacion_procedimientos', $registro);
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

	public function modificar_procedimiento(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');

				$id_proce_progamacion = $this->input->post('idreg');

				$campos='pgp.id_procedimiento_prog AS "Id", pgp.id_programacion AS "Id_programacion", pgp.id_procedimiento AS "Id_procedimiento",px.nombre AS "Procedimiento", pgp.materiales AS "Id_Materiales", (GROUP_CONCAT(m.nombre_material)) AS "Materiales", pgp.otros AS "Otros", m.id_grupo AS "Grupo", pgp.proveedor_material AS "Proveedores"';

				$query = $this->general_model->consulta_personalizada($campos, 'programacion_procedimientos pgp INNER JOIN procedimientos px ON pgp.id_procedimiento=px.id_procedimiento LEFT JOIN materiales_qx m ON FIND_IN_SET( m.id_material, pgp.materiales)', 'id_procedimiento_prog ='.$id_proce_progamacion.'', 'id_procedimiento_prog', 0, 0);

				$row = $query->row_array();
				
				$arr['procedimiento'] = array('Id'=>$row['Id'], 'Id_programacion'=>$row['Id_programacion'],'Id_procedimiento'=>$row['Id_procedimiento'],'Procedimiento'=>$row['Procedimiento'], 'Grupo'=>$row['Grupo'],'Id_Materiales'=>$row['Id_Materiales'],'Materiales'=>$row['Materiales'],'Otros'=>$row['Otros'],'Proveedores'=>$row['Proveedores']);
				echo json_encode( $arr );
			}
		}
	}

	public function actualizar_proc() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$materiales = $this->input->post('chk_materiales');
				$val_material = implode(',', (array) $materiales);

				$proveedores = $this->input->post('tercerosM_agendamiento');
				$val_proveedores = implode(',', (array) $proveedores);

				$procedimientoqx= $this->input->post('procedimientos_agendamiento');

				if($procedimientoqx=="" && $this->input->post('descripcion')!=""){
					$registro0 = array(
						'nombre'=>$this->input->post('descripcion'),
						'fecha_registro'=>date('Y-m-d H:i:s'),
						'estado'=>'1'
					);
					$query = $this->general_model->insert('procedimientos', $registro0);
					$procedimientoqx = $query;
				}
				
				$registro=array(
					'id_programacion'=>$this->input->post('id_programacion'),	
					'materiales'=>$val_material,
					'otros'=>$this->input->post('otros'),
					'proveedor_material'=>$val_proveedores,					
					'estado'=>'1'
				);
				//echo var_dump($registro);
				$query = $this->general_model->update('programacion_procedimientos', 'id_procedimiento_prog', $this->input->post('idregistro'), $registro);
				
				if($query=="OK") {
					echo '1';
				} else {
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

	public function eliminar_dprocedimiento() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";

				$registro=array(
					'id_procedimiento_prog'=>$this->input->post('idreg')
				);
				$query = $this->general_model->delete('programacion_procedimientos', $registro);
			}
		}
	}

	public function cargar_materiales() {
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		}else {
			if (!$this->input->is_ajax_request()) {
			redirect();
			} else {
				$tabla = '';
				$opc = 'nue';
				$tabla_ver = 'materiales';
				$id_pro = $this->input->post('proc');
				$id_material=$this->input->post('mate');

				// $CI =& get_instance();
				// $CI->load->model('general_model');

				// if($opc == 'nue') {
				$campos = ' m.id_material AS "chk", m.nombre_material AS "marcado" ';
				$query = $this->general_model->consulta_personalizada($campos, 'materiales_qx m LEFT JOIN materiales_grupos cx ON m.id_grupo=cx.id_grupo', 'm.id_grupo="'. $this->input->post('proc').'" AND m.estado="1" GROUP BY m.id_material', '', 0, 0);
				$tabla = '<div class="list-group" style=" justify-content:flex-start;">';
				$i = -1;

				$selectArray = explode(",", $id_material);
				$check = '';
				$disable = '';
				foreach ($query->result_array() as $row) {
					$i++;
					if(is_array($selectArray)){
        				        
	          				if(in_array($row['chk'],$selectArray)){
						       	$check = ' checked ';
				          		$disable = '';				          		
				        	} else {
				          		$check = '';
				          		$disable = '';				          		
				        	}
				        	$tabla .='<label> <input type="checkbox" value="'.$row['chk'].'" name="chk_materiales[]" id="chk_materiales" '.$check.' '.$disable.'>'.$row['marcado'].'</label>';  				        				        	
												
					}else {
						
						if($id_material === $row['chk']){
					       	$check = ' checked ';
			          		$disable = ' disabled ';
			          		
			        	} else {
			          		$check = '';
			          		$disable = '';
			          		
			        	}	
			        	$tabla .='<label> <input type="checkbox" value="'.$row['chk'].'" name="chk_materiales[]" id="chk_materiales" '.$check.' '.$disable.'>'.$row['marcado'].'</label>';				
											
					}					
				}
				 $tabla .= '</div><input type="hidden" name="cant_chk_materiales" id="cant_chk_materiales" value="'.$i.'" />';
				echo $tabla;
			}
		}
	}

	public function sendEmail($email,$from,$subject,$message){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$msg ="";
				/*CONFIGURACION DE SENMAIL SMTP*/
				$config = array(
					'protocol' => 'sendmail',
					'mailpath' => '/usr/sbin/sendmail',
					'charset'  => 'utf-8',
					'mailtype' => 'html',
					'wordwrap' => true
				);

				$this->email->initialize($config);

				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from($from);
				$this->email->to($email);
				$this->email->subject($subject);
				$this->email->message($message);

				if ($this->email->send()) {
					$msg = "Email enviado con exito";
					return $msg;
				} else {
					$msg = $this->email->print_debugger();
					return $msg;
				}
			}
		}
	}

	public function cargar_agenda(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');
				$id_cirujano = $this->input->post('idciruj');

				$campos='id_dia AS "Dia", hora_inicio AS "Inicio", hora_final AS "Final"';
				$query = $this->general_model->consulta_personalizada($campos, 'programacion_agenda_cirujano', 'id_cirujano="'.$id_cirujano.'" AND estado="1"', '', 0, 0);

				$row = $query->row_array();
				
				$arr['agenda_cx'] = array('Dia'=>$row['Dia'], 'Inicio'=>$row['Inicio'],'Final'=>$row['Final']);
				echo json_encode( $arr );
			}
		}
	}

	public function calcular_hora(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');
				$id_cirujano = $this->input->post('idciruj');
				$id_fechapro = $this->input->post('idfecpr');
				
				$campos='MAX(T1.Hora), pac.hora_inicio AS "Hora_ini",  MAX(T1.Horafinal) AS "Horafinal"';
				$query = $this->general_model->consulta_personalizada($campos, '(SELECT (p.hora_programacion) AS "Hora", p.tiempoQxh, DATE_FORMAT(ADDTIME(STR_TO_DATE((DATE_FORMAT(ADDTIME(STR_TO_DATE(p.hora_programacion, "%H:%i:%s"), p.tiempoQxh), "%H:%i:%s")), "%H:%i:%s"), "00:30:00"), "%H:%i:%s") AS "Horafinal" FROM programacion p WHERE p.id_cirujano="'.$id_cirujano.'" AND fecha_programacion="'.$id_fechapro.'" AND p.estado!="3") T1 LEFT JOIN programacion_agenda_cirujano pac ON pac.id_cirujano = "'.$id_cirujano.'"', '', '', 0, 0);

				$row = $query->row_array();

				$arr['hora'] = array('horasig'=>$row['Horafinal'],'Hora_ini'=>$row['Hora_ini']);
				echo json_encode( $arr );
			}
		}
	}

	public function cargar_email(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$id_casa = $this->input->post('idcasa');
				$seleccion = $this->input->post('idcorreo');
				$campos = ' id_correo AS "Id", Correo AS "Email" ';
				$query = $this->general_model->consulta_personalizada($campos, 'terceros_correos', 'id_tercero="'.$id_casa.'" AND estado = "1" ', '', 0, 0);
				$tabla='';
				$tabla .= '<option value=" ">Seleccione un Email</option>';
				foreach ($query->result_array() as $row)
				{	
				    if($seleccion == $row['Id'])
				        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Email'].'</option>';
				      else
				        $tabla .= '<option value="'.$row['Id'].'">'.$row['Email'].'</option>';
				}
				echo $tabla;
			}
		}		
	}

	public function sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras){
		
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {

				if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
					$msg = 1;				
				}else{
					$msg = $this->email->print_debugger();	
				}
				return $msg;
			}
		}
	}
}