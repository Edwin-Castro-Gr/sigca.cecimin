<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_contratos extends CI_Controller {
	
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

			$data_usua['titulo']="Contratos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contratos/index';
			$data_usua['entrada_js']='_js/contratos.js';
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

			$data_usua['titulo']="Contratos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contratos/nuevo';
			$data_usua['entrada_js']='_js/contratos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('dist/css/demo.css').'">

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

			$data_usua['c_id_contrato'] = $id;
			$data_usua['c_id_ingresop'] = '';			
			$data_usua['c_id_tipocontrato'] = '';
			$data_usua['c_id_funcionario'] = '';
			$data_usua['c_id_cargo'] = '';
			$data_usua['c_id_centrocosto'] = '';
			$data_usua['c_id_departamento'] = '';
			$data_usua['c_id_jefeinm'] = '';
			$data_usua['c_prorroga'] = '';
			$data_usua['c_fecha_inicio'] = '';
			$data_usua['c_fecha_final'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos='id_ingreso AS "IngresoP", id_tipocontrato AS "Tipo", id_funcionario AS "Funcionario", id_cargo AS "Cargo", id_centrocosto AS "Centro costos", id_area AS "Departamento", jefe_inmediato	AS "Jefe", fecha_inicio	AS "FechaInicio", fecha_final AS "FechaFinal", prorroga AS "Prorroga", estado AS "Estado", id_usuario AS "UsuarioCreo"';

			$query = $this->general_model->consulta_personalizada($campos,'contratos', 'id_contrato ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_tipocontrato'] = $row['Tipo'];
				$data_usua['c_id_ingresop'] =  $row['IngresoP'];	
				$data_usua['c_id_funcionario'] = $row['Funcionario'];
				$data_usua['c_id_cargo'] = $row['Cargo'];
				$data_usua['c_id_centrocosto'] = $row['Centro costos'];
				$data_usua['c_id_departamento'] = $row['Departamento'];
				$data_usua['c_id_jefeinm'] = $row['Jefe'];
				$data_usua['c_prorroga'] = $row['Prorroga'];
				$data_usua['c_fecha_inicio'] = $row['FechaInicio'];
				$data_usua['c_fecha_final'] = $row['FechaFinal'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['UsuarioCreo'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Contratos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contratos/modificar';
			$data_usua['entrada_js']='_js/contratos.js';
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

	public function consultas() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Contratos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contratos/consultas';
			$data_usua['entrada_js']='_js/contratos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/free-jqgrid@4.15.5/css/ui.jqgrid.min.css">';

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
			<script src="https://cdn.jsdelivr.net/npm/free-jqgrid@4.15.5/js/jquery.jqgrid.src.min.js"></script>
			<script src="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.js').'"></script>
    		<script src="'.base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js').'"></script>
    		';

			$this->load->view('template',$data_usua);
		}
	}

	public function otrosi($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			//header('Content-Type: application/json');			
			
			$data_usua['c_id_contrato'] = $id;
			$data_usua['c_id_tipocontrato'] = '';
			$data_usua['c_id_funcionario'] = '';
			$data_usua['c_cedula'] = '';
			$data_usua['c_id_cargo'] = '';
			$data_usua['c_id_centrocosto'] = '';
			$data_usua['c_id_departamento'] = '';
			$data_usua['c_id_jefeinm'] = '';
			$data_usua['c_prorroga'] = '';
			$data_usua['c_fecha_inicio'] = '';
			$data_usua['c_fecha_final'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos='ct.id_tipocontrato AS "Tipo", ct.id_funcionario AS "Funcionario", e.cedula AS "Cedula", ct.id_cargo AS "Cargo", ct.id_centrocosto AS "Centro costos", ct.id_area AS "Departamento", ct.jefe_inmediato AS "Jefe", ct.fecha_inicio AS "FechaInicio", ct.fecha_final AS "FechaFinal", ct.prorroga AS "Prorroga", ct.estado AS "Estado", ct.id_usuario AS "UsuarioCreo"';

			$query = $this->general_model->consulta_personalizada($campos,'contratos ct INNER JOIN empleados e ON ct.id_funcionario=e.id_empleado', 'id_contrato ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_tipocontrato'] = $row['Tipo'];
				$data_usua['c_id_funcionario'] = $row['Funcionario'];
				$data_usua['c_cedula'] = $row['Cedula'];
				$data_usua['c_id_cargo'] = $row['Cargo'];
				$data_usua['c_id_centrocosto'] = $row['Centro costos'];
				$data_usua['c_id_departamento'] = $row['Departamento'];
				$data_usua['c_id_jefeinm'] = $row['Jefe'];
				$data_usua['c_prorroga'] = $row['Prorroga'];
				$data_usua['c_fecha_inicio'] = $row['FechaInicio'];
				$data_usua['c_fecha_final'] = $row['FechaFinal'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['UsuarioCreo'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Contratos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='contratos/otrosi';
			$data_usua['entrada_js']='_js/contratos.js';
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
				$this->load->helper('funciones_tabla');
				echo listar_contratos_tabla('WEB');
			}
		}
	}

	public function cargar_ingresop() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				header('Content-Type: application/json');
				$idreg = $this->input->post('id_ingresop');
				
				$campos='ip.id_ingreso AS "Id", em.cedula AS "Cedula", em.id_empleado AS "Id funcionario", IFNULL(CONCAT(em.nombres," ", em.apellidos),"") AS "Empleado", ip.id_tipocontrato AS "id_tipocontrato", tc.nombre AS "Tipo Contrato", ip.id_cargo AS "id_cargo", ca.nombre AS "Cargo", (select id_checklist from ckeklist_contratosp ck where ck.id_cargo=ip.id_cargo AND ck.tipo_contrato=IF(ip.id_tipocontrato ="1" OR ip.id_tipocontrato="7",ip.id_tipocontrato, "1")) AS "Id Checklist", ar.id_area AS "Id Area", ar.nombre AS "Departamento", cc.id_centrocosto AS "Id Centro", cc.nombre As "Centro Costos", lc.id_linea_costos AS "Id Linea Costos", lc.nombre AS "Linea Costos", je.id_empleado AS "Id_JefeI", IFNULL(CONCAT(je.nombres," ", je.apellidos),"") AS "Jefe Inmediato", ip.fecha_inicio AS "Fecha Ingreso", ip.fecha_terminacion AS "Fecha Final"';

				$query = $this->general_model->consulta_personalizada($campos,'ingreso_personal ip INNER JOIN empleados em ON ip.id_empleado = em.id_empleado INNER JOIN cargos ca ON ip.id_cargo = ca.id_cargo INNER JOIN areas ar ON ip.id_area = ar.id_area INNER JOIN centroscostos cc ON ip.id_centrocostos = cc.id_centrocosto INNER JOIN linea_costos lc ON ip.id_linea_costos=lc.id_linea_costos INNER JOIN tipos_contrato tc ON ip.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados AS je ON ip.jefe_inmediato = je.id_empleado', 'ip.id_ingreso ="'.$idreg.'" ', '', 0, 0);
			
				foreach ($query->result_array() as $row)
				{
					$arr['ingresoP'] = array('Empleado'=>$row['Empleado'], 'Cedula'=>$row['Cedula'], 'Id_funcionario'=>$row['Id funcionario'], 'Tipo_Contrato'=>$row['Tipo Contrato'],'id_tipocontrato'=>$row['id_tipocontrato'], 'Cargo'=>$row['Cargo'], 'id_cargo'=>$row['id_cargo'],'Id_Departamento'=>$row['Id Area'],'Departamento'=>$row['Departamento'], 'Id_CentroCostos'=>$row['Id Centro'], 'Centro_Costos'=>$row['Centro Costos'],'Id_LineaCostos'=>$row['Id Linea Costos'], 'Linea_Costos'=>$row['Linea Costos'], 'Id_JefeI'=>$row['Id_JefeI'],'Jefe_Inmediato'=>$row['Jefe Inmediato'],'Fecha_Ingreso'=>$row['Fecha Ingreso'], 'Fecha_Final'=>$row['Fecha Final']);
				echo json_encode($arr);	

				}
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
				//echo "ingreso";
				$fecha = date('Y-m-d H:i:s');

				$ingreso = $this->input->post('ingresosp_contratos');

				if ($ingreso == "00"){
					$estado = $this->input->post('estadoC');
				}else{
					$estado = "0";
				}

				$registro=array(
					'id_ingreso'=>$this->input->post('ingresosp_contratos'),
					'id_tipocontrato'=>$this->input->post('id_tipocontratos'),
					'id_funcionario'=>$this->input->post('id_funcionario'),
					'id_cargo'=>$this->input->post('id_cargos'),
					'id_centrocosto'=>$this->input->post('id_centroscostos'),
					'id_lineacostos'=>$this->input->post('id_lineacostos'),
					'id_area'=>$this->input->post('id_departamentos'),
					'jefe_inmediato'=>$this->input->post('id_jefeinmed'),
					'prorroga'=>$this->input->post('id_prorroga'),
					'fecha_inicio'=>$this->input->post('fecha_inicio'),
					'fecha_final'=>$this->input->post('fecha_final'),
					'fecha_registro'=>$fecha,
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'estado'=>$estado
				);
				$query = $this->general_model->insert('contratos', $registro);

				$registro1=array(
					'estado'=> '3'
				);
				$query1 = $this->general_model->update('ingreso_personal ', 'id_ingreso', $ingreso, $registro1);
				
				if($query >= 1) {
					echo '1';
					if (count($_FILES)>0) {
						$dir ='Cont-'.$query.'-'.$this->input->post('empleados_contratos');
						if (!file_exists('contratos/')) {
							mkdir('contratos/', 0777, true);
							if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/')) {
								mkdir('contratos/'.$this->session->userdata('C_basedatos').'/', 0777, true);
								if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
									mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
								}
							}
						} elseif (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/')) {
							mkdir('contratos/'.$this->session->userdata('C_basedatos').'/', 0777, true);
							if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
								mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
							}
						} else if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
								mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
						}

						$ruta = 'contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';

						$this->session->set_userdata('archivo_origen',"");
						$mensage = '';
						//echo var_dump($_FILES);
						foreach ($_FILES as $inputName => $fileArray) {
	            			$id_check_contrato = explode('_', $inputName);
				            $fieldId = end($id_check_contrato);
				            
				            // Verificar si es múltiple o único
				            if (is_array($fileArray['name'])) {
				                // Procesar múltiples archivos
				                for ($i = 0; $i < count($fileArray['name']); $i++) {
				                    $currentFile = array(
				                        'name' => $fileArray['name'][$i],
				                        'type' => $fileArray['type'][$i],
				                        'tmp_name' => $fileArray['tmp_name'][$i],
				                        'error' => $fileArray['error'][$i],
				                        'size' => $fileArray['size'][$i]
				                    );
				                    
				                    $this->processSingleFile($currentFile, $ruta, $fieldId, $query, $fecha, $mensage);
	             			   	}
	            	
	            			} else {
				                // Procesar archivo único
				                $this->processSingleFile($fileArray, $ruta, $fieldId, $query, $fecha, $mensage);
				            }  
						}

					}
				} 
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

	// Función auxiliar para procesar un solo archivo
	private function processSingleFile($fileData, $ruta, $fieldId, $contratoId, $fecha, &$mensage) {
	    if ($fileData['error'] == UPLOAD_ERR_OK) {
	        $NombreOriginal = $fileData['name'];
	        $temporal = $fileData['tmp_name'];
	        
	        $foo = explode(".", $NombreOriginal);
	        $ext = end($foo);
	        $nombre_img = date("YmdHis").'-'.uniqid().'-'.$NombreOriginal;
	        $nombre = $this->session->userdata('C_id_usuario').'-'.$nombre_img;
	        $Destino = $ruta.$nombre;
	        
	        if (move_uploaded_file($temporal, $Destino)) {
	            $registro1 = array(
	                'id_contrato' => $contratoId,
	                'archivo' => $Destino,
	                'id_checklist_contratos' => $fieldId,
	                'fecha_ini_vigencia' => $this->input->post('fecha_inicio_'.$fieldId),
	                'fecha_fin_vigencia' => $this->input->post('fecha_final_'.$fieldId),
	                'fecha_registro' => $fecha,
	                'id_usuario' => $this->session->userdata('C_id_usuario'),
	                'estado' => '1'
	            );
	            
	            $query1 = $this->general_model->insert('contratos_anexos', $registro1);
	            $mensage .= 'Archivo '.$NombreOriginal.' cargado correctamente. ';
	        } else {
	            $mensage .= 'Error al mover el archivo '.$NombreOriginal.'. ';
	        }
	    } else {
	        // Manejo de errores con nombre seguro
	        $errorFileName = isset($fileData['name']) ? $fileData['name'] : 'archivo desconocido';
	        $mensage .= 'Error con el archivo '.$errorFileName.': '.$this->getUploadErrorMsg($fileData['error']).'. ';
	    }
	}

	// Función para mensajes de error más descriptivos
	private function getUploadErrorMsg($errorCode) {
	    $errors = array(
	        UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño permitido',
	        UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño permitido por el formulario',
	        UPLOAD_ERR_PARTIAL => 'El archivo solo se subió parcialmente',
	        UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo',
	        UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal',
	        UPLOAD_ERR_CANT_WRITE => 'No se pudo escribir el archivo en el disco',
	        UPLOAD_ERR_EXTENSION => 'Una extensión de PHP detuvo la subida del archivo'
	    );
	    
	    return isset($errors[$errorCode]) ? $errors[$errorCode] : 'Error desconocido';
	}

	public function guardarotrosi() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				

				$fecha = date('Y-m-d H:i:s');
				
				$id_contrato = $this->input->post('idregistro');
				$dir = "Cont-".$id_contrato;
				$archivo_otrosi = "";
				// //RESPONSABLE
				// $empleados_contratos = $this->input->post('empleadosM_contratost');
				// $val_responsable = implode(',', (array) $empleados_contratost);


				$registro=array(
					'id_contrato'=>$id_contrato,		
					'observaciones'=>$this->input->post('observaciones'),
					'objeto'=>$this->input->post('objeto'),  					
					'fecha_registro'=>$fecha, 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);
				$query = $this->general_model->insert('contratos_otrosi', $registro);
				echo '1';
						
				if($query >= 1) {
					$otrosi = "Otro Si-".$query;					

					// *************** SECCION PARA EL CARGUE DE ANEXOS *****************************************
					if (!file_exists('contratos/')) {
				 		mkdir('contratos/', 0777, true);
				 		if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/')) {
					 		mkdir('contratos/'.$this->session->userdata('C_basedatos').'/', 0777, true);
					 		if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
					 			mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
					 			if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/'.$otrosi.'/')) {
					 				mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/'.$otrosi.'/', 0777, true);
					 			}
					 		}
					 	}
				 	} elseif (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
					 	mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true); 
					 	if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/'.$otrosi.'/')){
				 			mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$nit.'/'.$otrosi.'/', 0777, true);
				 		}	
				 	}elseif (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/'.$otrosi.'/')){
				 		mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/'.$otrosi.'/', 0777, true);
				 	}

					$ruta = './contratos/'.$this->session->userdata('C_basedatos').'/'.$nit.'/'.$otrosi.'/'; 
					$rutag='contratos/'.$this->session->userdata('C_basedatos').'/'.$nit.'/'.$otrosi.'/';
							
					
					$config = [
						"upload_path" => $ruta,
						"allowed_types" => "*"
					];

					$this->load->library('upload', $config); 
          			$this->upload->initialize($config);
					if($this->upload->do_upload('archivo_otrosi1')){
						$data = array('upload_data' => $this->upload->data());
						$archivo= $rutag.$data['upload_data']['file_name'];
						$archivo_otrosi = $archivo;

						$registro1 = array(					
								'id_otrosi'=>$query, 
								'nombre_anexo'=>"Otro Si", 
								'ruta_archivo'=>$archivo,								
								'fecha_registro'=>$fecha, 
								'id_usuario'=>$this->session->userdata('C_id_usuario')								
							);
							//echo print_r($registro1);
							$query1 = $this->general_model->insert('otrosi_anexos', $registro1);
					}
					echo "1";
				}
				if($query1>=1){
					if(!empty($_FILES['archivo_otrosi2']['name']) && count(array_filter($_FILES['archivo_otrosi2']['name'])) > 0){ 
        				$filesCount = count($_FILES['archivo_otrosi2']['name']); 
        		
		        		for($i = 0; $i < $filesCount; $i++){       			 

		          			$this->load->library('upload', $config); 
		        			$this->upload->initialize($config);

							if($this->upload->do_upload('archivo_otrosi2['.$i.']')){
								$data = array('upload_data' => $this->upload->data());
								$archivo= $rutag.$data['upload_data']['file_name'];
							}
							$registro1 = array(					
								'id_otrosi'=>$query, 
								'nombre_anexo'=>"Otros anexos", 
								'ruta_archivo'=>$archivo,								
								'fecha_registro'=>$fecha, 
								'id_usuario'=>$this->session->userdata('C_id_usuario')								
							);
							//echo print_r($registro1);
							$query1 = $this->general_model->insert('otrosi_anexos', $registro1);																				
						}
					}					
				}
				if($query >= 1) {
					//ACTUALIZAR ESTADO CONTRATOS 	
					if($this->input->post('objeto') == "1") {
						$id_prorroga='';
						$estado_contrato = $this->input->post('estado_contrato');
						if($estado_contrato =='1'){
							$campos ='id_prorroga';
							$query = $this->general_model->consulta_personalizada($campos,'contratos_prorroga', 'id_contrato = "'.$id_contrato.'" AND estado = "1"', '', 0, 0);

							foreach ($query->result_array() as $row){
								$id_prorroga = $row['id_prorroga'];
							}
							$registro = array(					
							'estado'=>'0', 							
							);							
							$query0 = $this->general_model->update('contratos_prorroga', 'id_prorroga', $id_prorroga, $registro);

						}

						$registro1 = array(
							'id_contrato' =>$id_contrato,
							'observaciones' =>$this->input->post('observaciones'),
							'anexo_prorroga' =>$archivo_otrosi,
							'fecha_inicio' =>$this->input->post('fechainicio_p'),
							'fecha_final' =>$this->input->post('fechafinal_p'),
							'fecha_registro'=>$fecha, 
							'id_usuario'=>$this->session->userdata('C_id_usuario'), 
							'estado'=>'1'
						);
						$query1 = $this->general_model->insert('contratos_prorroga', $registro1);	
					
						$registro0 = array(					
							'estado'=>'1', 							
						);							
						$query1 = $this->general_model->update('contratos', 'id_contrato', $id_contrato, $registro0);
						
						if($query1 == "OK") {
							$registro1 = array(
								'id_contrato_tercero'=>$id_contrato,
								'fecha_ini_pro'=>$this->input->post('fechainicio_p'),
								'fecha_fin_pro'=>$this->input->post('fechafinal_p'),
								'fecha_registro'=>$fecha, 								
								'id_usuario'=>$this->session->userdata('C_id_usuario'), 																
								'estado'=>'1'
							);
							$query2 = $this->general_model->insert('contratos_prorroga', $registro1);
						}						
					}
				}	
				//GUARDAR NOTIFICACIONES
				if($query >= 1) {
					$responsable = $this->input->post('jefe_inmediato');  
					$tipo_notificacion=5;
					$id_solicitud = "CT-".$query;
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					
					
					$observacion ="Otro Si al Contrato N°: ".$ncontrato." cargado";
			
					$registro2=array(
						'tipo_notificacion'=>$tipo_notificacion,
						'id_solicitud' =>$id_solicitud,
						'id_usuario_notifica'=>$id_usuario_notifica, 
						'id_usuario_2'=>$responsable, 
						'observacion'=>$observacion, 
						'estado'=>'0',
						'fecha_registro'=>$fecha				
					);

					$query = $this->general_model->insert('notificaciones', $registro2);			
					
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
				$idcontrato = $this->input->post('idregistro');
				$registro=array(

					'id_tipocontrato'=>$this->input->post('tiposcontratos_contratos'),
					'id_cargo'=>$this->input->post('cargos_contratos'),
					'id_centrocosto'=>$this->input->post('centroscostos_contratos'),
					'id_area'=>$this->input->post('areas_contratos'),
					'jefe_inmediato'=>$this->input->post('empleados_jefeinm'),
					'prorroga'=>$this->input->post('idprorroga'),
					'fecha_inicio'=>$this->input->post('fechainicio'),
					'fecha_final'=>$this->input->post('fechafinal'),
					'estado'=>$this->input->post('estado')
				);

				$query = $this->general_model->update('contratos', 'id_contrato', $this->input->post('idregistro'), $registro);
				if($query =="OK"){
					$idregistro = $this->input->post('idregistro');
					$estado = $this->input->post('estado');
					$dir ='Cont-'.$idregistro.'-'.$this->input->post('empleados_contratos');						
					$idingresop = $this->input->post('idingresop');
					$ruta = 'contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
					$rutag = './contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
					if($estado == "2"){
						$idprorroga='';

						$campos ='id_prorroga AS "id"';
						$query0 = $this->general_model->consulta_personalizada($campos,'contratos_prorroga', 'id_contrato ="'.$idcontrato.'" AND estado="1"', '', 0, 0);
						if($query0!=""){
							foreach ($query0->result_array() as $row)
							{
								$idprorroga =$row['id'];
							}

							$registro0=array(
								'estado'=>'0'
							);
							$query1 = $this->general_model->update('contratos_prorroga', 'id_prorroga', $idprorroga, $registro0);
						}	
						$archivo = '';
						$config = [
							"upload_path" => $ruta,
							"allowed_types" => "*"
						];

						$this->load->library('upload', $config); 
          				$this->upload->initialize($config);
						
						if($this->upload->do_upload('anexo_prorroga')){
							$data = array('upload_data' => $this->upload->data());
							$archivo= $rutag.$data['upload_data']['file_name'];
						}

						$registro1 = array(
							'id_contrato'=>$idcontrato,
							'observaciones'=>$this->input->post('observaciones_p'),	
							'anexo_prorroga'=>$archivo,				
							'fecha_inicio'=>$this->input->post('fechainicio_p'),
							'fecha_final'=>$this->input->post('fechafinal_p'),
							'fecha_registro'=>$fecha,
							'id_usuario'=>$this->session->userdata('C_id_usuario'),
							'estado'=>'1'
						);
						$query1 = $this->general_model->insert('contratos_prorroga', $registro1);
					}
				
					if ($this->input->post('idactulizaranexos')){
						if($this->input->post('idingresop') == 00 || $this->input->post('idingresop') == 0){
							$dir ='Cont-'.$idregistro.'-'.$this->input->post('empleados_contratos');	
							if (!file_exists('contratos/')) {
								mkdir('contratos/', 0777, true);
								if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/')) {
									mkdir('contratos/'.$this->session->userdata('C_basedatos').'/', 0777, true);
									if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
										mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
									}
								}
							} elseif (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/')) {
								mkdir('contratos/'.$this->session->userdata('C_basedatos').'/', 0777, true);
								if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
									mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
								}
							} else if (!file_exists('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
									mkdir('contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
							}					

							$ruta = 'contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
							$rutag = './contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
						}else{
							$dir = 'ingreso-' . $idingresop;
						    $baseDir = 'ingresosp/' . $this->session->userdata('C_basedatos') . '/' . $dir . '/';
						    
						    if (!file_exists($baseDir)) {
						        mkdir($baseDir, 0777, true);
						    }
						    $ruta = $baseDir;
						    $rutag = './' . $baseDir;
						}
						

						$this->session->set_userdata('archivo_origen',"");
						$mensage = '';
						//echo var_dump($_FILES);
						foreach ($_FILES as $key1 => $key) //Iteramos el arreglo de archivos
						{
							//echo ($key1);
							if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
							{
								$id_check_contrato = explode('_',$key1); //Nombre del input file

								$NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
								//$tipo = $key['type'];

								$foo = explode(".",$key['name']);
								$bar = count($foo);
								$ext = ($bar > 0)? $foo[$bar - 1]:'';
								$nombre_img = date("YmdHis").'-'.$NombreOriginal;
								$nombre = $this->session->userdata('C_id_usuario').'-'.$nombre_img;

								$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
								$Destino = $rutag.$nombre;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	

								move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada	

								$this->session->set_userdata('archivo_origen',$Destino);
								$mensage .= 'cargado';
								$registro1 = array();

								if($this->input->post('idingresop') == 00 || $this->input->post('idingresop') == 0){
									$registro1 = array(
										'id_contrato'=>$idcontrato,
										'archivo'=>$Destino,
										'id_checklist_contratos'=>$id_check_contrato[1],
										'fecha_ini_vigencia'=>$this->input->post('fecha_inicio_'.$id_check_contrato[1]),
										'fecha_fin_vigencia'=>$this->input->post('fecha_final_'.$id_check_contrato[1]),
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);

									$query1 = $this->general_model->insert('contratos_anexos', $registro1);
								}else{
									$registro1 = array(
	                					'id_ingresop' => $idingresop,
						                'id_checklist_contratos' => $id_check_contrato[1],
						                'archivo' => $Destino,						                
										'fecha_ini_vigencia'=>$this->input->post('fecha_inicio_'.$id_check_contrato[1]),
										'fecha_fin_vigencia'=>$this->input->post('fecha_final_'.$id_check_contrato[1]),
						                'fecha_registro' => $fecha,                                
						                'estado' => '1'
						            );

			            			$this->general_model->insert('ingreso_personal_anexos', $registro1);
								}
							}
							if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
							{
								$mensage .= '-'.$key['error'].'-';
							}
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

	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('L', 'mm', 'LETTER');
	        $pdf->AliasNbPages();
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Listado de Contratos", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('L', 'LETTER');
            
            $pdf->Ln(10);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('     LISTADO GENERAL DE CONTRATOS'), 0, 0, 'C', false);
            $pdf->Ln(10);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(265,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(5);

            $campos =' tc.nombre AS "TipoContrato", IFNULL(CONCAT(e.nombres, e.apellidos),"") AS "Funcionario", ca.nombre AS "Cargo", c.fecha_inicio AS "FechaInicio", c.fecha_final AS "FechaFinal",  cc.nombre AS "CentroCostos", CASE WHEN c.estado="0" THEN "Vigente" WHEN c.estado="1" THEN "Terminado" ELSE "Prorogado" END AS "Estado" ';
            $query = $this->general_model->consulta_personalizada($campos, 'contratos c INNER JOIN  tipos_contrato tc ON c.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON c.id_funcionario = e.id_empleado INNER JOIN cargos ca ON c.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON c.id_centrocosto = cc.id_centrocosto', '', 'c.id_contrato', 0, 0);

            $encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 9);
			$pdf->SetFillColor(200,220,255);
			//$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Cell(35,5,utf8_decode("TIPO DE CONTRATO"),'LTRB',0,'C',$fill);
			$pdf->Cell(60,5,utf8_decode("FUNCIONARIO"),'LTRB',0,'C',$fill);
			$pdf->Cell(50,5,utf8_decode("CARGO"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,utf8_decode("F. INICIO"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,utf8_decode("F. FINAL"),'LTRB',0,'C',$fill);
			$pdf->Cell(65,5,utf8_decode("CENTRO DE COSTOS"),'LTRB',0,'C',$fill);
			$pdf->Cell(15,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			//$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 9);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	//$pdf->Cell(4,5,' ',0,0,'C',false);
                $pdf->Cell(35,5,($row->TipoContrato),'LTRB',0,'C',$fill);
                $pdf->Cell(60,5,utf8_decode($row->Funcionario),'LTRB',0,'C',$fill);
                $pdf->Cell(50,5,utf8_decode($row->Cargo),'LTRB',0,'C',$fill);                
                $pdf->Cell(20,5,utf8_decode($row->FechaInicio),'LTRB',0,'C',$fill);
                $pdf->Cell(20,5,utf8_decode($row->FechaFinal),'LTRB',0,'C',$fill);
                $pdf->Cell(65,5,utf8_decode($row->CentroCostos),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(15,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(15,5,$row->Estado,'LTRB',0,'C',!$fill);
                //$pdf->Cell(4,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Contratos.pdf");
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
			
		    echo utf8_decode('<table border="1"><tr><th colspan="8">LISTADO GENERAL CONTRATOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_contratos_tabla('EXCEL')); 
            echo '</table>';			
		}//-Valida Inicio de Session
	}

	public function consulta_docpend() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename1 = "Listado_Documentos_Pendientes_Contratos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename1 ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO CONTRATOS CON DOCUMENTOS PENDIENTES</th></tr></table><br>');

		    echo '<table border="1">';
		    $campos = 'DISTINCT t1.id_contrato AS "Contrato", t1.cargo AS "Cargo", t1.centro AS "Centro Costos", t1.funcionario AS "Empleado", t1.jefe AS "Jefe", t1.documento AS "Documento", IFNULL(ca.archivo,"") AS "Archivo"';

            $query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ct.id_contrato AS "id_contrato", cg.nombre  AS "cargo", IFNULL(CONCAT(em.nombres," ", em.apellidos),"") AS "funcionario", IFNULL(CONCAT(jf.nombres, jf.apellidos),"") AS "jefe", ce.nombre AS "centro", ld.nombre AS "documento" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN contratos ct ON ct.id_cargo=cc.id_cargo INNER JOIN cargos cg ON cc.id_cargo=cg.id_cargo INNER JOIN empleados em ON ct.id_funcionario=em.id_empleado INNER JOIN empleados jf ON ct.jefe_inmediato = jf.id_empleado INNER JOIN centroscostos ce ON ct.id_centrocosto=ce.id_centrocosto) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_contrato=ca.id_contrato', ' ca.archivo IS NULL', 't1.id_contrato, t1.Id', 0, 0);
            
            echo '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
            foreach ($query->list_fields() as $campo)
			{
			    echo utf8_decode('<th>'.($campo).'</th>');			    
			}
			echo '</tr></thead><tbody class="pos-rel">';
			foreach ($query->result_array() as $row)
    		{
    			echo utf8_decode('<tr class="d-style bgc-h-default-l4"><td>'.$row['Contrato'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Centro Costos'].'</td><td>'.$row['Empleado'].'</td> <td>'.$row['Jefe'].'</td><td>'.$row['Documento'].'</td><td>'.$row['Archivo'].'</td>');
    		}		
            echo '</tr></tbody></table>';			
		}//-Valida Inicio de Session
	}

	public function consulta_general() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename1 = "Listado_General_Contratos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename1 ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL CONTRATOS CON DOCUMENTOS</th></tr></table><br>');

		    echo '<table border="1">';
		    $campos = 'DISTINCT t1.id_contrato AS "Contrato", t1.cargo AS "Cargo", t1.centro AS "Centro Costos", t1.funcionario AS "Empleado", t1.jefe AS "Jefe", t1.documento AS "Documento", IFNULL(ca.archivo,"") AS "Archivo"';

            $query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ct.id_contrato AS "id_contrato", cg.nombre  AS "cargo", IFNULL(CONCAT(em.nombres," ", em.apellidos),"") AS "funcionario", IFNULL(CONCAT(jf.nombres, jf.apellidos),"") AS "jefe", ce.nombre AS "centro", ld.nombre AS "documento" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN contratos ct ON ct.id_cargo=cc.id_cargo INNER JOIN cargos cg ON cc.id_cargo=cg.id_cargo INNER JOIN empleados em ON ct.id_funcionario=em.id_empleado INNER JOIN empleados jf ON ct.jefe_inmediato = jf.id_empleado INNER JOIN centroscostos ce ON ct.id_centrocosto=ce.id_centrocosto) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_contrato=ca.id_contrato', '', 't1.id_contrato, t1.Id', 0, 0);
            
            echo '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
            foreach ($query->list_fields() as $campo)
			{
			    echo utf8_decode('<th>'.($campo).'</th>');			    
			}
			echo '</tr></thead><tbody class="pos-rel">';
			foreach ($query->result_array() as $row)
    		{
    			echo utf8_decode('<tr class="d-style bgc-h-default-l4"><td>'.$row['Contrato'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Centro Costos'].'</td><td>'.$row['Empleado'].'</td> <td>'.$row['Jefe'].'</td><td>'.$row['Documento'].'</td><td>'.$row['Archivo'].'</td>');
    		}		
            echo '</tr></tbody></table>';			
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
				$registro=array('estado'=>'1');
				$query = $this->general_model->update('contratos', 'id_contrato', $this->input->post('idreg'), $registro);
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

				$campos =' tc.nombre AS "Tipo Contrato", IFNULL(CONCAT(e.nombres," ", e.apellidos)," ") AS "Funcionario", ca.nombre AS "Cargo", c.fecha_inicio AS "Fecha Inicio", c.fecha_final AS "Fecha Final",  cc.nombre AS "Centro de Costos", CASE WHEN c.estado="0" THEN "Vigente" WHEN c.estado="1" THEN "Terminado" ELSE "Prorogado" END AS "Estado" ';
            	$query = $this->general_model->consulta_personalizada($campos, 'contratos c INNER JOIN  tipos_contrato tc ON c.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON c.id_funcionario = e.id_empleado INNER JOIN cargos ca ON c.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON c.id_centrocosto = cc.id_centrocosto', ' c.id_contrato = "'.$idreg.'" ', 'c.fecha_registro', 0, 0);

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

				$tabla .= '<hr>'; ////////////////////////////////////////////////////

				$campos ='t1.nombre AS "nombre_documento", IFNULL(ca.archivo,"") AS "<i class=fa fa-file-pdf></i>"';
            	$query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_contrato AS "id_contrato" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) RIGHT JOIN contratos ct ON ct.id_cargo=cc.id_cargo AND ct.id_tipocontrato = cc.tipo_contrato) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_contrato=ca.id_contrato', ' t1.id_contrato = "'.$idreg.'" ', '', 0, 0);

				$encabezado = array();
				$i = 0;
				foreach ($query->result_array() as $row)
				{
					$ancla = '<i class="w-3 text-center fa fa-times text-110 text-danger-m2"></i>';
					if($row['<i class=fa fa-file-pdf></i>'] != "")
						$ancla = anchor(base_url().'/'.$row['<i class=fa fa-file-pdf></i>'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank'));

					$tabla .= '
					<div class="row">'.
		            	form_label($row['nombre_documento'].': ','', array('class'=>'control-label text-right col-md-10'))
		              	.'<div class="col-md-2 text-primary"><strong>'.$ancla.'</strong></div>
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
				$idreg = $this->input->post('id_contratos');
				$tipo_cont= $this->input->post('tipo_cont');
				$id_ingresop = $this->input->post('id_ingresop');
				$t_cont= '7';

 				if($tipo_cont !=7){
					$t_cont = '1';	
				}

				if($id_ingresop == '' || $id_ingresop == 0 || $id_ingresop == 00){
					$campos ='t1.nombre AS "nombre_documento", IFNULL(ca.archivo,"") AS "<i class=fa fa-file-pdf></i>"';
            		$query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_contrato AS "id_contrato", tp.id_tipocontrato AS "tipo_contrato" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN contratos ct ON ct.id_cargo=cc.id_cargo RIGHT JOIN tipos_contrato tp ON tp.id_tipocontrato = cc.tipo_contrato) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos AND t1.id_contrato=ca.id_contrato', ' t1.id_contrato = "'.$idreg.'" AND t1.tipo_contrato = "'.$t_cont.'"', '', 0, 0);				

				}else{
					$campos ='t1.nombre AS "nombre_documento", IFNULL(ca.archivo,"") AS "<i class=fa fa-file-pdf></i>"';
	            	$query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_ingreso AS "id_ingreso", tp.id_tipocontrato AS "tipo_contrato" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN ingreso_personal ct ON ct.id_cargo=cc.id_cargo INNER JOIN tipos_contrato tp ON  tp.id_tipocontrato = cc.tipo_contrato) AS t1 LEFT JOIN ingreso_personal_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_ingreso = ca.id_ingresop', ' t1.id_ingreso = "'.$id_ingresop.'" AND t1.tipo_contrato = "'.$t_cont.'"', '', 0, 0);	
				}				

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

	public function cargar_prorrogas() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('id_contratos');

				$campos ='id_prorroga AS "Id", observaciones AS "Observaciones", IFNULL(anexo_prorroga,"") AS "Anexo", DATE_FORMAT(fecha_inicio,"%d-%m-%Y") AS "Fecha Inicio", DATE_FORMAT(fecha_final,"%d-%m-%Y") AS "Fecha Final"';
            	$query = $this->general_model->consulta_personalizada($campos, 'contratos_prorroga', ' id_contrato = "'.$idreg.'" ', '', 0, 0);

				$encabezado = array();
				$i = 0;
				$tabla='';
				foreach ($query->result_array() as $row)
				{
					$i++;
					$ancla = '<i class="w-3 text-center fa fa-times text-110 text-danger-m2"></i>';
					if($row['Anexo'] != "")
						$ancla = anchor(base_url().'/'.$row['Anexo'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank'));

					$tabla .= '<div class="container">
					<div class="row" >'.
		            	form_label($i.' : '.$row['Observaciones'].' ','', array('class'=>'control-label text-left col-sm-6 col-md-5')).'<div class="col-sm-5 col-md-5 text-primary"><strong>'.$row['Fecha Inicio'].' - '.$row['Fecha Final'].'</strong></div>'.'<div class="col-sm-1 col-md-2 text-primary"><strong>'.$ancla.'</strong></div>
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
			
			$query=$this->general_model->select_where('id_empleado AS "Id", IFNULL(CONCAT(nombres," ", apellidos),"") AS "Empleado" ', 'empleados', array('cedula' => $cedula));
			$row = $query->row_array();
				
			$arr['empleado'] = array('id_empleado'=>$row['Id'], 'nombre_empleado'=>$row['Empleado']);
			echo json_encode($arr);
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
				$cargo = $this->input->post('cargos_contratos');
				$tipoCont = $this->input->post('tipo_contrato');
				echo cargar_anexos_acord($cargo,$tipoCont);
				
			}
		}
	}

	public function consulta_contratos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				
				$campos1 ='DISTINCT t1.id_contrato AS "Contrato", t1.cargo AS "Cargo", t1.centro AS "Centro Costos", t1.funcionario AS "Empleado", t1.jefe AS "Jefe"';

				$query1 = $this->general_model->consulta_personalizada($campos1, '(SELECT ld.id_listado AS "Id", ct.id_contrato AS "id_contrato", cg.nombre  AS "cargo", IFNULL(CONCAT(em.nombres," ", em.apellidos),"") AS "funcionario", IFNULL(CONCAT(jf.nombres, jf.apellidos),"") AS "jefe", ce.nombre AS "centro", ld.nombre AS "documento" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN contratos ct ON ct.id_cargo=cc.id_cargo INNER JOIN cargos cg ON cc.id_cargo=cg.id_cargo INNER JOIN empleados em ON ct.id_funcionario=em.id_empleado INNER JOIN empleados jf ON ct.jefe_inmediato = jf.id_empleado INNER JOIN centroscostos ce ON ct.id_centrocosto=ce.id_centrocosto) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_contrato=ca.id_contrato', '  ca.archivo IS NULL', '', 0, 0);

				$campos ='t1.id_contrato AS "Contrato", t1.cargo AS "Cargo", t1.centro AS "Centro Costos", t1.funcionario AS "Empleado", t1.jefe AS "Jefe", t1.documento AS "Documento", IFNULL(ca.archivo,"") AS "Archivo" ';

				$query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ct.id_contrato AS "id_contrato", cg.nombre  AS "cargo", IFNULL(CONCAT(em.nombres," ", em.apellidos),"") AS "funcionario", IFNULL(CONCAT(jf.nombres, jf.apellidos),"") AS "jefe", ce.nombre AS "centro", ld.nombre AS "documento" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN contratos ct ON ct.id_cargo=cc.id_cargo INNER JOIN cargos cg ON cc.id_cargo=cg.id_cargo INNER JOIN empleados em ON ct.id_funcionario=em.id_empleado INNER JOIN empleados jf ON ct.jefe_inmediato = jf.id_empleado INNER JOIN centroscostos ce ON ct.id_centrocosto=ce.id_centrocosto) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_contrato=ca.id_contrato', '  ca.archivo IS NULL', '', 0, 0);

				$accordion = '<div class="accordion" id="documentospendientes">';
				
				foreach ($query1->result_array() as $row1)
    			{
    				$accordion .= '<div class="card border-0 bgc-green-l5 post-carg" >';
			      	$accordion .= '<div class="card-header border-0 bgc-transparent mb-0" id="heading'.$row1['Contrato'].'">';
			      	$accordion .= '<h2 class="card-title bgc-transparent text-green-d2 brc-green">';
			      	$accordion .= '<a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse'.$row1['Contrato'].'" data-toggle="collapse" aria-expanded="false" aria-controls="collapse'.$row1['Contrato'].'">
			                              '.$row1['Contrato'].' - '.$row1['Cargo'].' - '.$row1['Centro Costos'].' - <strong>'.$row1['Empleado'].'</strong>
			                              <!-- the toggle icon -->
			                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
			                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
			                            </span>
			                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
			                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
			                            </span>
			                            </a></h2></div>';
			        foreach ($query->result_array() as $row)
    			    {    

	    			    if($row1['Contrato']==$row['Contrato']){
				        	$accordion .='<div id="collapse'.$row1['Contrato'].'" class="collapse" aria-labelledby="heading'.$row1['Contrato'].'" data-parent="#documentospendientes">';
						    $accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
						                    '.$row['Documento'].'';
						    $accordion .= '</div></div>';
				        }              
					    
					}
					$accordion .= '</div>';
    			}

    			$accordion .= '</div>';

				echo $accordion;
				
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

	public function notificar_vencimientos()
	{
	    $this->load->database();
	    $this->load->helper('email');
	    $fecha = date('Y-m-d H:i:s');
	    // Paso 1: Obtener todos los documentos próximos a vencer
	    $sql = "

	    		SELECT ca.*, ld.nombre AS nombre_documento, c.id_contrato AS contrato_id, ef.email AS Correo_Funcionario, ej.email AS Correo_Jefe, IFNULL(CONCAT(ef.nombres, ' ', ef.apellidos),'') AS Nombre_Funcionario,IFNULL(CONCAT(ej.nombres, ' ', ej.apellidos),'') AS Nombre_Jefe 
	    		FROM contratos_anexos ca INNER JOIN contratos c ON ca.id_contrato = c.id_contrato 
	    		INNER JOIN empleados ef ON c.id_funcionario = ef.id_empleado INNER JOIN empleados ej ON c.jefe_inmediato = ej.id_empleado 
	    		INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, ca.id_checklist_contratos) 
	    		WHERE ca.fecha_fin_vigencia BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 15 DAY)	        
	    ";
	    $query = $this->db->query($sql);

	    // Paso 2: Agrupar por contrato
	    $contratos = [];

	    foreach ($query->result() as $row) {
	        // Verifica si ya se notificó este documento
	        // 
	       
	        $this->db->where([
	            'id_anexo_contrato' => $row->id_anexo,
	            'fecha_vencimiento' => $row->fecha_fin_vigencia
	        ]);
	        if ($this->db->get('c_notidicaciones_enviadas')->num_rows() > 0) {
	            continue; // ya fue notificado
	        }

	        $contrato_id = $row->contrato_id;
	        if (!isset($contratos[$contrato_id])) {
	            $contratos[$contrato_id] = [
	                'funcionario_email' => $row->Correo_Funcionario,
	                'jefe_email' => $row->Correo_Jefe,
	                'nombre_funcionario' => $row->Nombre_Funcionario,
	                'nombre_jefe' => $row->Nombre_Jefe,
	                'documentos' => []
	            ];
	        }

	        $contratos[$contrato_id]['documentos'][] = [
	            'id' => $row->id_anexo,
	            'nombre' => $row->nombre_documento ?? 'Documento sin nombre',
	            'fecha_vencimiento' => $row->fecha_fin_vigencia
	        ];

	    }

	    // Paso 3: Enviar correos agrupados por contrato
	    foreach ($contratos as $contrato_id => $info) {
	        if (empty($info['documentos'])) continue;

	        $msg='';
			$usuario = '';

			$funcionario = "{$info['nombre_funcionario']}";
			//$correo_funcionario = $info['funcionario_email'];
			$correo_funcionario = 'castonino17@gmail.com';	

			$correo_remitente ='Calidad CECIMIN';
            $correo_usuario = 'edwincas_17@hotmail.com';
			$correo_cc = 'calidad.cecimin@saludinteligente.com';

			// $de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
		    
			// $Para ="".$funcionario." <".$correo_funcionario.">";
			// // $Para ="Edwin Castro <edwincas_17@hotmail.com>";
			$asunto ="Aviso: Documentos del contrato #{$contrato_id} próximos a vencer";

			$mensaje = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
			$mensaje .= "<div><font size='3'>{$info['nombre_funcionario']},</font></div>\r\n";
			$mensaje .= "<br>\r\n";
			$mensaje .= "<br>\r\n";
			$mensaje .= "<div><font size='3'>Reciba un cordial saludo,</font></div>\r\n";
			$mensaje .= "<br>\r\n";
			$mensaje .= "<br>\r\n";
			$mensaje .= "<div><font size='3'>El motivo de la presente es para informarles que los siguientes documentos del contrato <strong>#{$contrato_id}</strong> están próximos a vencer:</font></div>\r\n";									
		    $mensaje .= "<br><ul>";	
		     	foreach ($info['documentos'] as $doc) {
	            	$mensaje .= "<li>ID: <strong>{$doc['id']}</strong>, Documento: {$doc['nombre']}, vence el <strong>{$doc['fecha_vencimiento']}</strong></li>";

	        	}
		    $mensaje .= "</ul><br><br>Por lo que le solicitamos, enviar los documentos actualizados.<br><br>\r\n";	
		    	
		    $mensaje .= "<div><font size='3'>Atentamente, </font></div>\r\n";
		    $mensaje .= "<br>\r\n";		
		    $mensaje .= "<br>\r\n";				   
		    $mensaje .= "<div><font size='3'>Coordinadora de Calidad</font></div>\r\n";
		    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";				
			$mensaje .= "<br>\r\n";
			$mensaje .= "<br>\r\n";		
		    $mensaje .= "<br>\r\n";
		    $mensaje .= "<div><font size='1' color:'#20A491' >MEDIO AMBIENTE: ¿Necesita realmente imprimir este correo? CONFIDENCIALIDAD: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su destinatario. </font></div>\r\n";									
			
			$mensaje .= "\r\n";

			// Archivos a adjuntar
        	$adjuntos =  Null;		            	

            // Enviar el correo utilizando el buzón de citas
            $responseCorreo = (enviar_correo($correo_usuario, $asunto, $mensaje, 'notificacion',  $correo_remitente, $adjuntos, $correo_cc));
            if ($responseCorreo) {
                echo "Enviado";

                foreach ($info['documentos'] as $doc) {
	                $this->db->insert('c_notidicaciones_enviadas', [
	                	'id_contrato' => $contrato_id,
	                    'id_anexo_contrato ' => $doc['id'],
	                    'fecha_vencimiento' => $doc['fecha_vencimiento'],
	                    'fecha_notificacion'=> $fecha,
	                ]);
	            }
            } else {
                echo $msg = "$responseCorreo";                	
            }

	        
	    }
	}

}


