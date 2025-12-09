<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ingresop extends CI_Controller {
	
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
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Ingreso Personal";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='ingresosp/index';
			$data_usua['entrada_js']='_js/ingresos_personal.js';
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
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {
			
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');
			$this->load->helper('email');

			$data_usua['titulo']="Nueva Solicitud de Ingreso";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='ingresosp/nuevo';
			$data_usua['entrada_js']='_js/ingresos_personal.js';
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

	public function modificar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {

			$data_usua['c_id_ingreso'] = $id;
			$data_usua['c_id_tipocontrato'] = '';
			$data_usua['c_id_funcionario'] = '';
			$data_usua['c_cedula'] = '';
			$data_usua['c_nombre_funcionario'] = '';			
			$data_usua['c_id_cargo'] = '';
			$data_usua['c_id_departamento'] = '';
			$data_usua['c_id_linea_costos'] = '';
			$data_usua['c_id_centrocosto'] = '';			
			$data_usua['c_id_jefeinm'] = '';
			$data_usua['c_fecha_inicio'] = '';
			$data_usua['c_fecha_final'] = '';			
			$data_usua['c_id_usuario_gestiona'] = '';
			$data_usua['c_fecha_gestion']='';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos='c.id_empleado AS "Funcionario", e.cedula AS "Cedula",  IFNULL(CONCAT(e.nombres," ", e.apellidos),"") AS "Nombre funcionario", c.id_tipocontrato AS "Tipo Contrato", c.id_cargo AS "Cargo", c.id_area AS "Departamento", c.id_centrocostos AS "Centro costos", c.id_linea_costos AS "Linea costos", c.jefe_inmediato AS "Jefeinm", c.fecha_inicio AS "FechaInicio", c.fecha_terminacion AS "FechaFinal", c.id_usuario_gestiona AS "Usuario Gestiona", c.fecha_gestion AS "Fecha gestion", c.estado AS "Estado", c.id_usuario AS "UsuarioCreo"';

			$query = $this->general_model->consulta_personalizada($campos,'ingreso_personal c INNER JOIN empleados e ON c.id_empleado = e.id_empleado', 'c.id_ingreso ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_tipocontrato'] = $row['Tipo Contrato'];
				$data_usua['c_id_funcionario'] = $row['Funcionario'];
				$data_usua['c_cedula'] =  $row['Cedula'];
				$data_usua['c_nombre_funcionario'] =  $row['Nombre funcionario'];
				$data_usua['c_id_cargo'] = $row['Cargo'];				
				$data_usua['c_id_linea_costos'] = $row['Linea costos'];
				$data_usua['c_id_centrocosto'] = $row['Centro costos'];
				$data_usua['c_id_departamento'] = $row['Departamento'];
				$data_usua['c_id_jefeinm'] = $row['Jefeinm'];
				$data_usua['c_fecha_inicio'] = $row['FechaInicio'];
				$data_usua['c_fecha_final'] = $row['FechaFinal'];
				$data_usua['c_id_usuario_gestiona'] = $row['Usuario Gestiona'];
				$data_usua['c_fecha_gestion']=$row['Fecha gestion'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['UsuarioCreo'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Modificar Ingreso";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='ingresosp/modificar';
			$data_usua['entrada_js']='_js/ingresos_personal.js';
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
			$data_usua['c_id_ingreso'] = $id;
			$data_usua['c_id_tipocontrato'] = '';
			$data_usua['c_id_funcionario'] = '';
			$data_usua['c_cedula'] = '';
			$data_usua['c_nombre_funcionario'] = '';			
			$data_usua['c_id_cargo'] = '';
			$data_usua['c_id_departamento'] = '';
			$data_usua['c_id_linea_costos'] = '';
			$data_usua['c_id_centrocosto'] = '';			
			$data_usua['c_id_jefeinm'] = '';
			$data_usua['c_fecha_inicio'] = '';
			$data_usua['c_fecha_final'] = '';			
			$data_usua['c_id_usuario_gestiona'] = '';
			$data_usua['c_fecha_gestion']='';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos='c.id_empleado AS "Funcionario", e.cedula AS "Cedula",  IFNULL(CONCAT(e.nombres," ", e.apellidos),"") AS "Nombre funcionario", c.id_tipocontrato AS "Tipo Contrato", c.id_cargo AS "Cargo", c.id_area AS "Departamento", c.id_centrocostos AS "Centro costos", c.id_linea_costos AS "Linea costos", c.jefe_inmediato AS "Jefeinm", c.fecha_inicio AS "FechaInicio", c.fecha_terminacion AS "FechaFinal", c.id_usuario_gestiona AS "Usuario Gestiona", c.fecha_gestion AS "Fecha gestion", c.estado AS "Estado", c.id_usuario AS "UsuarioCreo"';

			$query = $this->general_model->consulta_personalizada($campos,'ingreso_personal c INNER JOIN empleados e ON c.id_empleado = e.id_empleado', 'c.id_ingreso ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_tipocontrato'] = $row['Tipo Contrato'];
				$data_usua['c_id_funcionario'] = $row['Funcionario'];
				$data_usua['c_cedula'] =  $row['Cedula'];
				$data_usua['c_nombre_funcionario'] =  $row['Nombre funcionario'];
				$data_usua['c_id_cargo'] = $row['Cargo'];				
				$data_usua['c_id_linea_costos'] = $row['Linea costos'];
				$data_usua['c_id_centrocosto'] = $row['Centro costos'];
				$data_usua['c_id_departamento'] = $row['Departamento'];
				$data_usua['c_id_jefeinm'] = $row['Jefeinm'];
				$data_usua['c_fecha_inicio'] = $row['FechaInicio'];
				$data_usua['c_fecha_final'] = $row['FechaFinal'];
				$data_usua['c_id_usuario_gestiona'] = $row['Usuario Gestiona'];
				$data_usua['c_fecha_gestion']=$row['Fecha gestion'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['UsuarioCreo'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Revisar Ingreso";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='ingresosp/revisar';
			$data_usua['entrada_js']='_js/ingresos_personal.js';
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
				echo listar_ingresosp_tabla('WEB',$usuario);
			}
		}
	}

	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";}

				$this->load->helper('email');
				$fecha = date('Y-m-d H:i:s');
				$id_usuario =$this->input->post('idfuncionario');
				$cargo = $this->input->post('cargos_ingresop');					
				$tipo_contrato = $this->input->post('tiposcontratos_ingresop');
				$usuario =$this->input->post('nombre_empleado');
				$correo = $this->input->post('correo_empleado');
				$id_jefe = $this->input->post('coordinador_jefeinm');
				$correo_remitente = 'admin@sigca.cecimin.com.co'; 
				
				$registro=array(

					'id_empleado'=>$this->input->post('idfuncionario'),
					'id_cargo'=>$this->input->post('cargos_ingresop'),
					'id_area'=>$this->input->post('areas_ingresop'),	
					'id_linea_costos'=>$this->input->post('lineacostos_ingresop'),
					'id_centrocostos'=>$this->input->post('centroscostos_ingresop'),					
					'id_tipocontrato'=>$this->input->post('tiposcontratos_ingresop'),
					'jefe_inmediato'=>$this->input->post('coordinador_jefeinm'),
					'fecha_inicio'=>$this->input->post('fechainicio'),
					'fecha_terminacion'=>$this->input->post('fechafinal'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'fecha_registro'=>$fecha,
					'estado'=>"0"
				);
				$query = $this->general_model->insert('ingreso_personal', $registro);
				
				if($query >= 1){

					$idingreso = $query;
					$correo_cc = 'calidad.cecimin@saludinteligente.com';
					$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario", email AS "Correo"';
					$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_jefe.'"', '', 0, 0);
					foreach ($query12->result_array() as $row)
					{
						$coordinador = $row['Usuario'];
						$correo_coord = $row['Correo'];
					}

					// Datos del correo
					// $correo_remitente =''. $coordinador.'<'.$correo_coord = $row['Correo'].'>';
		            $correo_usuario = $correo;
		            $asunto = 'Proceso de Ingreso a Cecimin S.A.S';
		            $mensaje = "<div><font size='3'>Señor(a),</font></div>\r\n";				
					$mensaje .= "<div><font size='3'>".$usuario."</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>A continuación, nos permitimos relacionar los documentos necesarios para continuar con el proceso de Ingreso a Cecimin:</font></div>\r\n";
					$mensaje .= "<br>\r\n";

					$campos ='ld.id_listado AS "Id", ld.nombre AS "Nombre"';
      
    				$query = $this->general_model->consulta_personalizada($campos, 'ckeklist_contratosp AS cc LEFT JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos)', 'cc.id_cargo ='.$cargo.' AND cc.tipo_contrato  ='.$tipo_contrato.' AND ld.estado = "1"', 'ld.id_listado', 0, 0);
    				$i = 0;
    				foreach ($query->result_array() as $row)
					{
						$i++;
						$mensaje .= "<div><font size='3'><b>".$i."). ".$row['Nombre']."</b></font></div>\r\n";
						
					}
				    $enviarLink = base_url().'c_enviaringresop/index?idcargo='.$cargo.'&idingreso='.$idingreso.'&usuario='.$usuario.'&tipo_contrato='.$tipo_contrato.'&coordinador='.$coordinador.'&correo_coord='.$correo_coord.'';

				    $mensaje .= "<div><font size='3'><a href='".$enviarLink."'>Haga click aquí</a> para abrir el formulario y cargar los documentos en formato PDF</font></div>\r\n";
				    $mensaje .= "<br>\r\n";		
				    $mensaje .= "<br>\r\n";
				    $mensaje .= "<div><font size='3'>Agradeciendo la atención prestada,</font></div>\r\n";
				    $mensaje .= "<br>\r\n";		
				    $mensaje .= "<br>\r\n";
				    $mensaje .= "<div><font size='3'>Cordialmente,</font></div>\r\n";
				    $mensaje .= "<br>\r\n";		
				    $mensaje .= "<br>\r\n";
				    $mensaje .= "<div><font size='3'></font></div>\r\n";
				    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";					
					$mensaje .= "<br>\r\n";
					
		            // Archivos a adjuntar
		            $adjuntos = null;

		            // Enviar el correo utilizando el buzón de citas
		            if (enviar_correo($correo_usuario, $asunto, $mensaje, 'ingreso',  $correo_remitente, $adjuntos, $correo_cc)) {
		                echo "1";
		                $query = 1;
		            } else {
		                echo "0";
		                $query =-999;	
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

	public function guardarRevisar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";}
				$this->load->helper('email');
				$fecha = date('Y-m-d H:i:s');
				$id_usuario =$this->input->post('idfuncionario');

				$idingreso = $this->input->post('idregistro');

				$estado = $this->input->post('estado');
				
				$registro=array(

					'estado'=>$estado
				);
				$this->general_model->update('ingreso_personal', 'id_ingreso', $idingreso, $registro);
				
				if($query =="OK"){

					$idingreso = $query;
					
					if($estado=="2"){

					}else{

						$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario", email AS "Correo"';
						$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_jefe.'"', '', 0, 0);
						foreach ($query12->result_array() as $row)
						{
							$coordinador = $row['Usuario'];
							$correo_coord = $row['Correo'];
						}

						// Datos del correo
						// $correo_remitente =''. $coordinador.'<'.$correo_coord = $row['Correo'].'>';
			            $correo_usuario = $correo;
			            $asunto = 'Proceso de Ingreso a Cecimin S.A.S';
			            $mensaje = "<div><font size='3'>Señor(a),</font></div>\r\n";				
						$mensaje .= "<div><font size='3'>".$usuario."</font></div>\r\n";
						$mensaje .= "<br>\r\n";
						$mensaje .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
						$mensaje .= "<br>\r\n";
						$mensaje .= "<br>\r\n";
						$mensaje .= "<div><font size='3'>A continuación, nos permitimos relacionar los documentos necesarios para continuar con el proceso de Ingreso a Cecimin:</font></div>\r\n";
						$mensaje .= "<br>\r\n";

						$campos ='ld.id_listado AS "Id", ld.nombre AS "Nombre"';
	      
	    				$query = $this->general_model->consulta_personalizada($campos, 'ckeklist_contratosp AS cc LEFT JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos)', 'cc.id_cargo ='.$cargo.' AND cc.tipo_contrato  ='.$tipo_contrato.' AND ld.estado = "1"', 'ld.id_listado', 0, 0);
	    				$i = 0;
	    				foreach ($query->result_array() as $row)
						{
							$i++;
							$mensaje .= "<div><font size='3'><b>".$i."). ".$row['Nombre']."</b></font></div>\r\n";
							
						}
					    $enviarLink = base_url().'c_enviaringresop/index?idcargo='.$cargo.'&idingreso='.$idingreso.'&usuario='.$usuario.'&tipo_contrato='.$tipo_contrato.'&coordinador='.$coordinador.'&correo_coord='.$correo_coord.'';

					    $mensaje .= "<div><font size='3'><a href='".$enviarLink."'>Haga click aquí</a> para abrir el formulario y cargar los documentos en formato PDF</font></div>\r\n";
					    $mensaje .= "<br>\r\n";		
					    $mensaje .= "<br>\r\n";
					    $mensaje .= "<div><font size='3'>Agradeciendo la atención prestada,</font></div>\r\n";
					    $mensaje .= "<br>\r\n";		
					    $mensaje .= "<br>\r\n";
					    $mensaje .= "<div><font size='3'>Cordialmente,</font></div>\r\n";
					    $mensaje .= "<br>\r\n";		
					    $mensaje .= "<br>\r\n";
					    $mensaje .= "<div><font size='3'>Dirección de Recursos Humanos</font></div>\r\n";
					    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";					
						$mensaje .= "<br>\r\n";
						
			            // Archivos a adjuntar
			            $adjuntos = null;

			            // Enviar el correo utilizando el buzón de citas
			            if (enviar_correo($correo_usuario, $asunto, $mensaje, 'ingreso',  $correo_remitente, $adjuntos)) {
			                echo "1";
			                $query = 1;
			            } else {
			                echo "0";
			                $query =-999;	
			            }
					}									
					
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
	public function guardar_empleado() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$registro=array(
					
					'Id_tipdocIdentidad'=>$this->input->post('Tipo_docidentidad_empleados'),
					'cedula'=>$this->input->post('cedula'), 
					'nombres'=>$this->input->post('nombres'), 
					'apellidos'=>$this->input->post('apellidos'),
					'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),
					'direccion'=>$this->input->post('direccion'),
					'telefono'=>$this->input->post('telefono'),
					'email'=>$this->input->post('email'),
					'id_cargo'=>$this->input->post('cargos_empleados'),
					'id_eps'=>$this->input->post('eps_empleados'),
					'arl'=>$this->input->post('arl_empleados'),
					'grupo_sanguineo'=>$this->input->post('gruposanguineo'),
					'nivel_riesgo'=>$this->input->post('nivel_riesgo'),
					'fecha_registro'=>date('Y-m-d H:i:s'),  
					'id_usuario'=>$this->session->userdata('C_id_usuario'),  
					'estado'=>'1'
				);

				$query = $this->general_model->insert('empleados', $registro);
				if($query >= 1){
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
	}

	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$fecha = date('Y-m-d H:i:s');
				$idingreso = $this->input->post('idregistro');

				$estado = $this->input->post('estado');
				
				$registro=array(
					
					'id_cargo'=>$this->input->post('cargos_ingresop'),
					'id_area'=>$this->input->post('areas_ingresop'),	
					'id_linea_costos'=>$this->input->post('lineacostos_ingresop'),
					'id_centrocostos'=>$this->input->post('centroscostos_ingresop'),					
					'id_tipocontrato'=>$this->input->post('tiposcontratos_ingresop'),
					'jefe_inmediato'=>$this->input->post('coordinador_jefeinm'),
					'fecha_inicio'=>$this->input->post('fechainicio'),
					'fecha_terminacion'=>$this->input->post('fechafinal'),					
					'estado'=>$this->input->post('estado')
				);

				$query = $this->general_model->update('ingreso_personal', 'id_ingreso', $idingreso, $registro);

				$ruta = $this->crearDirectorios($idingreso);
	        	$this->manejarArchivos($idingreso, $ruta, $fecha);


				if($query =="OK"){	

					if($estado == "2"){

						$id_solicitud =  $idingreso;
						$usuario_notifica = $this->session->userdata('C_id_usuario');
	      				// $usuario_notificado = $id_empleado;
	      				$usuario_notificado = 83;


	        			$observacion = "Se solicita la creación del contrato para el  ingreso No. " . $idingreso;
	       				$this->crearNotificacion($idingreso, $usuario_notifica, $usuario_notificado, $observacion, $fecha);	
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

	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			// $this->load->library('Pdffpdf');

	        // $pdf = new Pdffpdf('L', 'mm', 'LETTER');
	        // $pdf->AliasNbPages();
	        
	        // $pdf->hoja = 'LETTER';
	        // $pdf->SetTitle("SIGCA - Listado de Contratos", true);
	        // $pdf->SetLeftMargin(7);
	        // $pdf->SetRightMargin(3);
	        
	        // $pdf->AddPage('L', 'LETTER');
            
            // $pdf->Ln(10);
            // $pdf->SetFont('helvetica','B',14);
            // $pdf->SetTextColor(0,0,0);
            // $pdf->Cell(0,0,utf8_decode('     LISTADO GENERAL DE CONTRATOS'), 0, 0, 'C', false);
            // $pdf->Ln(10);

            // $pdf->SetFont('helvetica','B',6);
            // $pdf->Cell(265,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            // $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            // $pdf->Ln(5);

            // $campos =' tc.nombre AS "TipoContrato", IFNULL(CONCAT(e.nombres, e.apellidos),"") AS "Funcionario", ca.nombre AS "Cargo", c.fecha_inicio AS "FechaInicio", c.fecha_final AS "FechaFinal",  cc.nombre AS "CentroCostos", CASE WHEN c.estado="0" THEN "Vigente" WHEN c.estado="1" THEN "Terminado" ELSE "Prorogado" END AS "Estado" ';
            // $query = $this->general_model->consulta_personalizada($campos, 'contratos c INNER JOIN  tipos_contrato tc ON c.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON c.id_funcionario = e.id_empleado INNER JOIN cargos ca ON c.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON c.id_centrocosto = cc.id_centrocosto', '', 'c.id_contrato', 0, 0);

            // $encabezados = $query->result();
			
			// $x = 1;
			// $fill = true;
			// $pdf->SetFont('helvetica','B', 9);
			// $pdf->SetFillColor(200,220,255);
			// //$pdf->Cell(4,5,' ',0,0,'C',false);
			// $pdf->Cell(35,5,utf8_decode("TIPO DE CONTRATO"),'LTRB',0,'C',$fill);
			// $pdf->Cell(60,5,utf8_decode("FUNCIONARIO"),'LTRB',0,'C',$fill);
			// $pdf->Cell(50,5,utf8_decode("CARGO"),'LTRB',0,'C',$fill);
			// $pdf->Cell(20,5,utf8_decode("F. INICIO"),'LTRB',0,'C',$fill);
			// $pdf->Cell(20,5,utf8_decode("F. FINAL"),'LTRB',0,'C',$fill);
			// $pdf->Cell(65,5,utf8_decode("CENTRO DE COSTOS"),'LTRB',0,'C',$fill);
			// $pdf->Cell(15,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			// //$pdf->Cell(4,5,' ',0,0,'C',false);
			// $pdf->Ln(5);
			// $fill = false;
			// $pdf->SetFont('helvetica','', 9);
			// $pdf->SetFillColor(255,180,180);
	        // foreach ($encabezados as $row) {
	        // 	//$pdf->Cell(4,5,' ',0,0,'C',false);
            //     $pdf->Cell(35,5,($row->TipoContrato),'LTRB',0,'C',$fill);
            //     $pdf->Cell(60,5,utf8_decode($row->Funcionario),'LTRB',0,'C',$fill);
            //     $pdf->Cell(50,5,utf8_decode($row->Cargo),'LTRB',0,'C',$fill);                
            //     $pdf->Cell(20,5,utf8_decode($row->FechaInicio),'LTRB',0,'C',$fill);
            //     $pdf->Cell(20,5,utf8_decode($row->FechaFinal),'LTRB',0,'C',$fill);
            //     $pdf->Cell(65,5,utf8_decode($row->CentroCostos),'LTRB',0,'C',$fill);
            //     if($row->Estado == "Activo")
            //     	$pdf->Cell(15,5,$row->Estado,'LTRB',0,'C',$fill);
            //     else
            //     	$pdf->Cell(15,5,$row->Estado,'LTRB',0,'C',!$fill);
            //     //$pdf->Cell(4,5,' ',0,0,'C',false);

	        //     $pdf->Ln(5);
	        // }
	    
	        // $pdf->Output('I', "Listado_Contratos.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_Contratos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="8">LISTADO GENERAL INGRESOS PERSONAL</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_ingresos_tabla('EXCEL')); 
            echo '</table>';			
		}//-Valida Inicio de Session
	}

// ************* <<===== Excel de Consulta Documentos pendientes Contrato =====>*************//
	// public function consulta_cont_docpend() {
	// 	if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
	// 		redirect(base_url());
	// 	else {
	// 		$filename = "Documentos_pendientes.xls";			
	// 	    header ("Content-Disposition: attachment; filename=".$filename ); 
	// 		header ("Content-Type: application/vnd.ms-excel");
			
	// 		$this->load->helper('funciones_tabla');
			
	// 	    echo utf8_decode('<table border="1"><tr><th colspan="5">LISTADO CONTRATOS CON DOCUMENTOS PENDIENTES</th></tr></table><br>');
		   
	// 	    echo '<table border="1">';
    //         echo utf8_decode(listar_doc_pend_contratos_tabla('EXCEL')); 
    //         echo '</table>';			
	// 	}//-Valida Inicio de Session
	// }

	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				$registro=array('estado'=>'1');
				$query = $this->general_model->update('ingreso_personal', 'id_ingreso', $this->input->post('idreg'), $registro);
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

				$campos =' i.id_ingreso AS "Id", tc.nombre AS "Tipo Contrato", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Funcionario", ca.nombre AS "Cargo", lc.nombre AS "Linea de Costo", cc.nombre AS "Centro de Costo", a.nombre AS "Departamento", DATE_FORMAT(i.fecha_registro, "%d/%m/%Y %H:%i") AS "Fecha Solicitud", DATE_FORMAT(i.fecha_inicio, "%d/%m/%Y") AS "Fecha Inicio",  DATE_FORMAT(i.fecha_terminacion, "%d/%m/%Y") AS "Fecha Terminacion", IFNULL(CONCAT(ji.nombres, " ", ji.apellidos), "") AS "Jefe Inmediato", DATE_FORMAT(i.fecha_gestion, "%d/%m/%Y") AS "Fecha Gestion", i.obserciones_gestion AS "Observaciones", IFNULL(CONCAT(ig.nombres, " ", ig.apellidos), "") AS "Gestionada por", DATE_FORMAT(i.fecha_cierre, "%d/%m/%Y") AS "Fecha Cierre", IFNULL(CONCAT(ic.nombres, " ", ic.apellidos), "") AS "Cerrada por",CASE WHEN i.estado="0" THEN "Pendiente" WHEN i.estado="1" THEN "Gestinada" WHEN i.estado="2" THEN "Cerrada" WHEN i.estado="3" THEN "Cancelada" END AS "Estado"';
            	$query = $this->general_model->consulta_personalizada($campos, 'ingreso_personal i INNER JOIN tipos_contrato tc ON i.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON i.id_empleado = e.id_empleado INNER JOIN cargos ca ON i.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON i.id_centrocostos = cc.id_centrocosto INNER JOIN linea_costos lc ON i.id_linea_costos = lc.id_linea_costos INNER JOIN areas a ON i.id_area = a.id_area LEFT JOIN empleados ji ON i.jefe_inmediato= ji.id_empleado LEFT JOIN empleados ig ON i.id_usuario_gestiona = ig.id_empleado LEFT JOIN empleados ic ON i.id_usuario_cierre = ic.id_empleado', ' i.id_ingreso = "'.$idreg.'" ', '', 0, 0);

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

	public function listar_anexos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('id_ingreso');
				$tipo_cont=$this->input->post('tipo_cont');
				$t_cont= '7';
 				if($tipo_cont !=7){
					$t_cont = '1';	
				}

				$campos ='t1.nombre AS "nombre_documento", IFNULL(ca.archivo,"") AS "<i class=fa fa-file-pdf></i>"';
            	$query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_ingreso AS "id_ingreso", tp.id_tipocontrato AS "tipo_contrato" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN ingreso_personal ct ON ct.id_cargo=cc.id_cargo INNER JOIN tipos_contrato tp ON  tp.id_tipocontrato = cc.tipo_contrato) AS t1 LEFT JOIN ingreso_personal_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_ingreso =ca.id_ingresop', ' t1.id_ingreso = "'.$idreg.'" AND t1.tipo_contrato = "'.$t_cont.'"', '', 0, 0);

				$encabezado = array();
				$i = 0;
				$tabla='';
				foreach ($query->result_array() as $row)
				{
					$ancla = '<i class="w-3 text-center fa fa-times text-110 text-danger-m2"></i>';
					if($row['<i class=fa fa-file-pdf></i>'] != "")
						$ancla = anchor(base_url().'/'.$row['<i class=fa fa-file-pdf></i>'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank'));

					$tabla .= '<div class="container">
					<div class="row">'.
		            	form_label($row['nombre_documento'].': ','', array('class'=>'control-label text-left col-md-10'))
		              	.'<div class="col-md-2 text-primary"><strong>'.$ancla.'</strong></div>
		            </div></div>';
				}				
		      	echo $tabla;
			}
		}
	}

	public function listar_documentos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$tabla = '';

				$idreg = $this->input->post('cargos_ingresop');

				
				$tipocontrato = $this->input->post('tipocontrato');		

				if($tipocontrato != "7"){

					$tipo_contrato = 1 ;		
				}else {
					$tipo_contrato = $tipocontrato;
				}		

				$campos ='ld.id_listado AS "Id", ld.nombre AS "Nombre"';
      
    			$query = $this->general_model->consulta_personalizada($campos, 'ckeklist_contratosp AS cc LEFT JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos)', 'cc.id_cargo='.$idreg.' AND cc.tipo_contrato ='.$tipo_contrato.' AND ld.estado ="1"', 'ld.id_listado', 0, 0);

				$encabezado = array();
				$i = 1;
				$tabla='';
				foreach ($query->result_array() as $row)
				{
					
					$tabla .= '<div class="container">
					<div class="row">'.
		            	$i++ . form_label($row['Nombre'].' ','', array('class'=>'control-label text-left col-md-10')).'
		              	</div>
		            </div></div>';
				}
				
		      	echo $tabla;
			}
		}
	}

	public function cargar_empleado() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$cedula = $this->input->post('emple');
			
			$query=$this->general_model->select_where('id_empleado AS "Id", IFNULL(CONCAT(nombres," ", apellidos),"") AS "Empleado", email AS "Correo"', 'empleados', array('cedula' => $cedula));
			$row = $query->row_array();
				
			$arr['empleado'] = array('id_empleado'=>$row['Id'], 'nombre_empleado'=>$row['Empleado'], 'email_empleado'=>$row['Correo']);
			echo json_encode($arr);
		}
	}

	public function cargar_centros() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$idlinea = $this->input->get('idlineac'); 
			// $idcargo = implode(",",(array)$id);

			$campos='id_centrocosto AS "Id", nombre AS "Nombre"';
			$query = $this->general_model->consulta_personalizada($campos,'centroscostos', 'id_linea_costos ='.$idlinea.' AND estado ="1"', '', 0, 0);

			$arrjson=[];

			foreach($query->result_array() as $row) {
				$arrjson[] = array('id'=>$row['Id'],'text'=>$row['Nombre']);
			}		
									
			echo json_encode($arrjson);		
		}
	}

	public function cargar_anexos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				$idreg = $this->input->post('id_ingreso');				
				$t_cont = $this->input->post('tipo_cont');

				echo cargar_anexos_acord2($idreg,$t_cont);
				
			}
		}
	}

	public function consultar_empleado(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$idreg = $this->input->post('cedula');

				$query = $this->general_model->select_verificar('empleados', 'cedula = '.$idreg);
				
				if($query != false){
					echo '1';
				}else {
					echo '0';
				}
			} 
		}
	}
	
	public function ver_checklist() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('$idcargo');

				$campos = ' ch.id_cargo, ch.nombre_documento AS "Documento", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'checklist_contratos ch', ' ch.id_cargo = "'.$idreg.'" ', '', 0, 0);
		      
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

	
	private function crearDirectorios($idingresop) {
	    $dir = 'ingreso-' . $idingresop;
	    $baseDir = 'ingresosp/' . $this->session->userdata('C_basedatos') . '/' . $dir . '/';
	    
	    if (!file_exists($baseDir)) {
	        mkdir($baseDir, 0777, true);
	    }
	    
	    return './' . $baseDir;
	}

	private function manejarArchivos($idingresop, $ruta, $fecha) {
	    $this->session->set_userdata('archivo_origen', "");
	    $mensage = '';

	    foreach ($_FILES as $key1 => $key) {
	        if ($key['error'] == UPLOAD_ERR_OK) {
	            $id_check_contrato = explode('_', $key1);
	            $NombreOriginal = $key['name'];
	            $nombre_img = date("YmdHis") . '-' . $NombreOriginal;
	            $nombre = $nombre_img;
	            $temporal = $key['tmp_name'];
	            $Destino = $ruta . $nombre;
	            
	            move_uploaded_file($temporal, $Destino);
	            $this->session->set_userdata('archivo_origen', $Destino);
	            $mensage .= 'cargado';

	            $registro1 = array(
	                'id_ingresop' => $idingresop,
	                'id_checklist_contratos' => $id_check_contrato[1],
	                'archivo' => $Destino,
	                'fecha_registro' => $fecha,                                
	                'estado' => '1'
	            );

	            $this->general_model->insert('ingreso_personal_anexos', $registro1);
	        }
	        
	        if ($key['error'] != '') {
	            $mensage .= '-' . $key['error'] . '-';
	        }
	    }
	}


	private function crearNotificacion($id_solicitud, $usuario_notifica, $usuario_notificado, $observacion, $fecha) {
	    $tipo_notificacion = 9;
	    $registro2 = array(
	        'tipo_notificacion' => $tipo_notificacion,
	        'id_solicitud' => $id_solicitud,
	        'id_usuario_notifica' => $usuario_notifica, 
	        'id_usuario_2' => $usuario_notificado, 
	        'observacion' => $observacion, 
	        'estado' => '0',
	        'fecha_registro' => $fecha
	    );

	    $this->general_model->insert('notificaciones', $registro2);
	}
}


