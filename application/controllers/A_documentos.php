<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
// ;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class A_documentos extends CI_Controller {
	
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
			// $this->session->set_userdata('archivo_origen','');
			$this->session->set_userdata('archivo_visual','');
			// $this->session->set_userdata('archivo_origen_tipo','');
			$this->session->set_userdata('archivo_visual_tipo','');

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Documentos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='documentos/index';
			$data_usua['entrada_js']='_js/documentos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">';

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

	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {

			$this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_visual_tipo','');
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk'); 

			$data_usua['titulo']="Nuevo Documento";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='documentos/nuevo';
			$data_usua['entrada_js']='_js/documentos.js';
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

	public function modificar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ){
			redirect(base_url());
		}else {
			
			// $id = $this->input->post('idreg');

			$data_usua['c_id_documento'] = $id;	
			$data_usua['c_id_solicitud'] = '';
			$data_usua['c_nombre_documento'] = '';
			$data_usua['c_id_tipo_documento'] = '';
			$data_usua['c_tipo_documento'] = '';
			$data_usua['c_id_Macroproceso'] = '';
			$data_usua['c_macroproceso'] = '';
			$data_usua['c_id_proceso'] = '';
			$data_usua['c_proceso'] = '';
			$data_usua['c_id_subproceso'] = '';
			$data_usua['c_subproceso'] = '';
			$data_usua['c_docrelacionado'] = '';
			$data_usua['c_codigo'] = '';				
			$data_usua['c_version'] = '';				
			$data_usua['c_fechaversion'] = '';
			$data_usua['c_archivo_pdf'] = '';
			$data_usua['c_des_empleados'] = '';
			$data_usua['c_des_cargos'] = '';			
			$data_usua['c_des_departamentos'] = '';	
			$data_usua['c_evaluacion'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';
			$docr ='';

			$campos='d.id_documento AS "Documento", d.id_solicitud AS "Solicitud", td.nombre AS "Tipo_doc", d.nombre AS "Documento", d.id_macroproceso AS "Id_macroproceso", m.nombre AS "Macroproceso", d.id_procesomaestro AS "Id_proceso", p.nombre AS "Proceso", d.id_subproceso AS "Id_subproceso", sp.nombre AS "Subproceso", d.docrelacionado AS "Doc_relacionado", CONCAT(dv.ruta,dv.archivo) AS "PDF", d.codigo AS "Codigo", dv.version AS "Version", dv.fecha AS "Fechaversion", d.des_empleados AS "Dest_empleados", d.des_cargos AS "Dest_cargos", d.des_departamentos AS "Dest_departamentos", d.evaluacion AS "Evaluacion", d.estado AS "Estado", d.id_usuario AS "Usuario"';

			$query = $this->general_model->consulta_personalizada($campos,'documentos d LEFT JOIN macroprocesos m ON d.id_macroproceso = m.id_macroproceso LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso=sp.id_subproceso LEFT JOIN tipos_documentos td on d.id_tipo = td.id_tipo LEFT JOIN solicitud_documentos s ON d.id_solicitud = s.id_solicitud LEFT JOIN documentos_versiones dv ON dv.id_documento=d.id_documento', 'd.id_documento ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_solicitud'] = $row['Solicitud'];
				$data_usua['c_nombre_documento'] = $row['Documento'];
				$data_usua['c_tipo_documento'] = $row['Tipo_doc'];
				$data_usua['c_id_Macroproceso'] = $row['Id_macroproceso'];
				$data_usua['c_macroproceso'] = $row['Macroproceso'];
				$data_usua['c_id_proceso'] = $row['Id_proceso'];
				$data_usua['c_proceso'] = $row['Proceso'];
				$data_usua['c_id_subproceso'] = $row['Id_subproceso'];				
				$data_usua['c_subproceso'] = $row['Subproceso'];
				$data_usua['c_docrelacionado'] = $row['Doc_relacionado'];
				$data_usua['c_codigo'] = $row['Codigo'];				
				$data_usua['c_version'] = $row['Version'];				
				$data_usua['c_fechaversion'] = $row['Fechaversion'];
				$data_usua['c_archivo_pdf'] = $row['PDF'];				
				$data_usua['c_evaluacion'] = $row['Evaluacion'];				
				$data_usua['c_des_empleados'] = $row['Dest_empleados'];
				$data_usua['c_des_cargos'] = $row['Dest_cargos'];			
				$data_usua['c_des_departamentos'] = $row['Dest_departamentos'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['Usuario'];

				$docr = $row['Doc_relacionado'];
			}
			$data_usua['c_nom_docrelacionado']= '';
			//$docrela = explode(',', $row['docrelacionado']);
			if($docr !=''){							
	      		$docrela = '';
	      		$prefdoc = '';

	      		$query1 = $this->general_model->consulta_personalizada('nombre,  RIGHT(codigo,5) AS cod', 'documentos', ' estado = "1" AND id_documento IN ('.$docr.') ', 'nombre', 0, 0);
			      foreach ($query1->result_array() as $row1)
			      {
			        if($docrela != '')
			        	$docrela .= ',';
			        $docrela .= $row1['nombre'];

			        if($prefdoc != '')
			          	$prefdoc .= '-';
			        $prefdoc .= $row1['cod'];
			      }
			    $data_usua['c_nom_docrelacionado']= $docrela;
			    $data_usua['c_prefdocrelacionado'] = $prefdoc;
		    }
		    
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Modificar Documentos";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='documentos/modificar';
			$data_usua['entrada_js']='_js/documentos.js';
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

	public function socializar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ){
			redirect(base_url());
		}else {
			
			$data_usua['c_id_documento'] = $id;	
			$data_usua['c_id_solicitud'] = '';
			$data_usua['c_nombre_documento'] = '';
			$data_usua['c_id_tipo_documento'] = '';
			$data_usua['c_tipo_documento'] = '';
			$data_usua['c_id_Macroproceso'] = '';
			$data_usua['c_macroproceso'] = '';
			$data_usua['c_id_proceso'] = '';
			$data_usua['c_proceso'] = '';
			$data_usua['c_id_subproceso'] = '';
			$data_usua['c_subproceso'] = '';
			$data_usua['c_docrelacionado'] = '';
			$data_usua['c_codigo'] = '';				
			$data_usua['c_version'] = '';				
			$data_usua['c_fechaversion'] = '';
			$data_usua['c_archivo_pdf'] = '';
			$data_usua['c_des_empleados'] = '';
			$data_usua['c_des_cargos'] = '';			
			$data_usua['c_des_departamentos'] = '';	
			$data_usua['c_evaluacion'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';
			$docr ='';

			$campos='d.id_documento AS "Documento", d.id_solicitud AS "Solicitud", td.nombre AS "Tipo_doc", d.nombre AS "Documento", d.id_macroproceso AS "Id_macroproceso", m.nombre AS "Macroproceso", d.id_procesomaestro AS "Id_proceso", p.nombre AS "Proceso", d.id_subproceso AS "Id_subproceso", sp.nombre AS "Subproceso", d.docrelacionado AS "Doc_relacionado", CONCAT(dv.ruta,dv.archivo) AS "PDF", d.codigo AS "Codigo", dv.version AS "Version", dv.fecha AS "Fechaversion", d.des_empleados AS "Dest_empleados", d.des_cargos AS "Dest_cargos", d.des_departamentos AS "Dest_departamentos", d.evaluacion AS "Evaluacion", d.estado AS "Estado", d.id_usuario AS "Usuario"';

			$query = $this->general_model->consulta_personalizada($campos,'documentos d INNER JOIN macroprocesos m ON d.id_macroproceso = m.id_macroproceso LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso=sp.id_subproceso INNER JOIN tipos_documentos td on d.id_tipo = td.id_tipo LEFT JOIN solicitud_documentos s ON d.id_solicitud = s.id_solicitud LEFT JOIN documentos_versiones dv ON dv.id_documento=d.id_documento', 'd.id_documento ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_solicitud'] = $row['Solicitud'];
				$data_usua['c_nombre_documento'] = $row['Documento'];
				$data_usua['c_tipo_documento'] = $row['Tipo_doc'];
				$data_usua['c_id_Macroproceso'] = $row['Id_macroproceso'];
				$data_usua['c_macroproceso'] = $row['Macroproceso'];
				$data_usua['c_id_proceso'] = $row['Id_proceso'];
				$data_usua['c_proceso'] = $row['Proceso'];
				$data_usua['c_id_subproceso'] = $row['Id_subproceso'];				
				$data_usua['c_subproceso'] = $row['Subproceso'];
				$data_usua['c_docrelacionado'] = $row['Doc_relacionado'];
				$data_usua['c_codigo'] = $row['Codigo'];				
				$data_usua['c_version'] = $row['Version'];				
				$data_usua['c_fechaversion'] = $row['Fechaversion'];
				$data_usua['c_archivo_pdf'] = $row['PDF'];				
				$data_usua['c_evaluacion'] = $row['Evaluacion'];				
				$data_usua['c_des_empleados'] = $row['Dest_empleados'];
				$data_usua['c_des_cargos'] = $row['Dest_cargos'];			
				$data_usua['c_des_departamentos'] = $row['Dest_departamentos'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['Usuario'];

				$docr = $row['Doc_relacionado'];
			}
			$data_usua['c_nom_docrelacionado']= '';
			//$docrela = explode(',', $row['docrelacionado']);
			if($docr !=''){							
	      		$docrela = '';
	      		$prefdoc = '';

	      		$query1 = $this->general_model->consulta_personalizada('nombre,  RIGHT(codigo,5) AS cod', 'documentos', ' estado = "1" AND id_documento IN ('.$docr.') ', 'nombre', 0, 0);
			      foreach ($query1->result_array() as $row1)
			      {
			        if($docrela != '')
			        	$docrela .= ',';
			        $docrela .= $row1['nombre'];

			        if($prefdoc != '')
			          	$prefdoc .= '-';
			        $prefdoc .= $row1['cod'];
			      }
			    $data_usua['c_nom_docrelacionado']= $docrela;
			    $data_usua['c_prefdocrelacionado'] = $prefdoc;
		    }

		    
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Socializar Documentos";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='documentos/socializar';
			$data_usua['entrada_js']='_js/documentos.js';
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
	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				echo listar_documentos_tabla('WEB');
			}
		}
	}


	//ASIGNACION DEL CODIGO DEL DOCUMENTO
	public function consecutivo1() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$macro = $this->input->post('macro');				
				$proce = $this->input->post('proce');
				$subproce = $this->input->post('subproce');
				$docrelacionado =$this->input->post('docrela');
				$tipod = $this->input->post('tipod');
				$clase = $this->input->post('clase');
				
				$consec= "";
				$codigo="";		

				if($proce !="null" && $subproce!="null" && $docrelacionado !="null" && $tipod !="null"){
					//CONSECUTIVO DOCUMENTOS DE LOS SUBPRCESOS CON DOCUMENTOS RELACIONADOS
					$valdocrela = explode(",",$docrelacionado);
					$docrela = end($valdocrela);

					$campos ='(SELECT IFNULL(NUll,(codigo)) AS "DocRelacionado" FROM `documentos` WHERE `id_documento`= "'.$docrela.'") AS "Docrela", IFNULL("'.$tipod.'",d.id_tipo) AS "tipo", (COUNT(*) + 1)AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_subproceso ="'.$subproce.'"  AND docrelacionado ="'.$docrela.'" AND id_tipo = "'.$tipod.'"AND d.clase !="5"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];
						$codigo=$row['Docrela']."-".$row['tipo']."-".$consec;
					}
				}elseif($proce !="null" && $subproce!="null" && $docrelacionado ==="null" || $docrelacionado =="" && $tipod !="null"){
					//CONSECUTIVO DOCUMENTOS DE LOS SUBPRCESOS CON SIN DOCUMENTOS RELACIONADOS
					
					$campos ='IFNULL("'.$macro.'",d.id_macroproceso) AS "macro", IFNULL((SELECT prefijo from procesos where id_proceso="'.$proce.'"),p.prefijo) AS "proc", IFNULL((SELECT sp.pref_subproceso FROM subprocesos sp where sp.id_subproceso = "'.$subproce.'"),sp.pref_subproceso)AS "subp", IFNULL("'.$tipod.'",d.id_tipo) AS "tipo", (COUNT(*) + 1)AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_subproceso ="'.$subproce.'"  AND docrelacionado IS NULL AND id_tipo = "'.$tipod.'" AND d.clase !="5"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];
						$codigo=$row['macro']."-".$row['proc']."-".$row['subp']."-".$row['tipo']."-".$consec;
					}
				}elseif($proce !="null"  && $subproce === "null" && $docrelacionado !="null" && $tipod !="null"){
					//CONSECUTIVO PARA TRANSVERSALES DE LOS PROCESOS CON DOCUMENTOS RELACIONADOS
					$valdocrela = explode(",",$docrelacionado);
					$docrela = end($valdocrela);

					$campos ='(SELECT IFNULL(NUll,(codigo)) AS "DocRelacionado" FROM `documentos` WHERE `id_documento`= "'.$docrela.'") AS "Docrela", IFNULL("'.$tipod.'",d.id_tipo) AS "tipo", (COUNT(*) + 1)AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_macroproceso = "'.$macro.'" AND d.id_procesomaestro ="'.$proce.'" AND d.id_subproceso IS NUll AND docrelacionado = "'.$docrela.'"AND id_tipo = "'.$tipod.'"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];
						$codigo=$row['Docrela']."-".$row['tipo']."-".$consec;
					}
				}elseif($proce !="null" && $subproce === "null" || $subproce == ""  && $docrelacionado ==="null" || $docrelacionado =="" && $tipod !=""){
					//CONSECUTIVO PARA TRANSVERSALES DE LOS PROCESOS SIN DOCUMENTOS RELACIONADOS
					
					$campos ='IFNULL("'.$macro.'",d.id_macroproceso) AS "macro", IFNULL((SELECT prefijo from procesos  where id_proceso="'.$proce.'"),p.prefijo) AS "proc", IFNULL("'.$tipod.'",d.id_tipo) AS "tipo", (COUNT(*) + 1)AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_macroproceso = "'.$macro.'" AND d.id_procesomaestro = "'.$proce.'"  AND d.id_subproceso IS NULL AND docrelacionado IS NULL AND id_tipo = "'.$tipod.'"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];

						$codigo=$row['macro']."-".$row['proc']."-".$row['tipo']."-".$consec;
					}
				}elseif($macro !="null" && $proce ==="null" && $subproce ==="null" && $docrelacionado !="null" && $tipod !=""){
					//CONSECUTIVO PARA TRANSVERSALES DE LOS MACROPRCESOS CON DOCUMENTOS RELACIONADOS
					$valdocrela = explode(",",$docrelacionado);
					$docrela = end($valdocrela);

					$campos ='(SELECT RTRIM(codigo) AS "DocRelacionado" FROM `documentos` WHERE `id_documento`= "'.$docrela.'") AS "Docrela", IFNULL("'.$tipod.'",d.id_tipo) AS "tipo", (COUNT(*) + 1) AS "consec" ';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_macroproceso = "'.$macro.'" AND d.id_procesomaestro IS NULL AND d.id_subproceso IS NULL AND docrelacionado ="'.$docrela.'" AND id_tipo = "'.$tipod.'"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];
						$codigo=$row['Docrela']."-".$row['tipo']."-".$consec;
					}					
				}elseif($macro!="null" && $proce ==="null" || $proce =="" && $subproce === "null" || $subproce == ""  && $docrelacionado ==="null" || $docrelacionado =="" && $tipod!=""){
				//CONSECUTIVO PARA TRANSVERSALES DE LOS MACROPRCESOS SIN DOCUMENTOS RELACIONADOS
					$campos ='IFNULL("'.$macro.'",d.id_macroproceso) AS "macro", IFNULL("'.$tipod.'",d.id_tipo) AS "Tipo", (COUNT(*) + 1) AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_macroproceso = "'.$macro.'" AND d.id_procesomaestro IS NULL AND d.id_subproceso IS NULL AND docrelacionado IS NULL AND id_tipo = "'.$tipod.'"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];
						$codigo=$row['macro']."-".$row['Tipo']."-".$consec;
					}	
				}elseif($macro ==="null" && $proce ==="null" &&$docrelacionado ==="null" && $tipod!=""){ 
				//CONSECUTIVO PARA DOCUMENTO EXTERNO
					$campos ='IFNULL("'.$tipod.'",d.id_tipo) AS "tipo", (COUNT(*) + 1) AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_macroproceso IS NULL AND d.id_procesomaestro IS NULL AND d.id_subproceso IS NULL AND docrelacionado IS NULL AND id_tipo = "'.$tipod.'"', '', 0, 0);
		    		foreach ($query->result_array() as $row){								
						
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];

						$codigo=$row['tipo']."-"."E"."-".$consec;								
					}					

				}elseif($proce !="null" && $subproce!="null" && $docrelacionado =="null" && $tipod !="" && $clase == "5"){
					//CONSECUTIVO DOCUMENTOS DE LOS SUBPRCESOS SIN DOCUMENTOS RELACIONADO					

					$campos ='IFNULL("'.$macro.'",d.id_macroproceso) AS "macro", IFNULL((SELECT prefijo from procesos where id_proceso="'.$proce.'"),p.prefijo) AS "proc", IFNULL((SELECT sp.pref_subproceso FROM subprocesos sp where sp.id_subproceso = "'.$subproce.'"),sp.pref_subproceso)AS "subp", IFNULL("'.$tipod.'",d.id_tipo) AS "tipo","E" AS "ext", (COUNT(*) + 1)AS "consec"';
		    		$query = $this->general_model->consulta_personalizada($campos, 'documentos d left join procesos p on d.id_procesomaestro = p.id_proceso left join subprocesos sp on d.id_subproceso = sp.id_subproceso', ' d.id_subproceso ="'.$subproce.'"  AND docrelacionado IS NULL AND id_tipo = "'.$tipod.'" AND d.clase="'.$clase.'"', '', 0, 0);
					foreach ($query->result_array() as $row){
						if($row['consec'] < 10)
							$consec = "00".$row['consec'];
						elseif($row['consec'] >=10 && $row['consec'] < 100)
							$consec = "0".$row['consec'];
						else 
							$consec = $row['consec'];
						$codigo=$row['macro']."-".$row['proc']."-".$row['subp']."-".$row['tipo']."-".$row['ext']."-".$consec;
					}

				}
				
				echo $codigo;
				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				
				//ESTABLECER LA RUTA DONDE SE VA A GUARDAR EL ARCHIVO
				
				$dir = $this->input->post('tipo_documento');

			 	if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/')) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/', 0777, true);
				 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/', 0777, true);
					 	}
				 	}
			 	} elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/')) {
				 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/', 0777, true);
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/')) {
					mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/', 0777, true);
			 	}

				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/';  
				$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/';
				
				//DOCUMENTOS RELACIONADOS
				$doc_relacionados = $this->input->post('doc_relacionado');
				$val_docrela = $doc_relacionados;


				//DESTINATARIOS EMPLEADOS
				$des_empleado = $this->input->post('empleadosMR_documentos');
				$val_empleado = implode(',', (array) $des_empleado);

				//DESTINATARIOS CARGOS
				$des_cargo = $this->input->post('cargos_documentos');
				$val_cargo = implode(',', (array) $des_cargo);

				//DESTINATARIOS DEPARTAMENTOS
				$des_departamento = $this->input->post('departamentos_documentos');
				$val_departamento = implode(',', (array) $des_departamento);

				//CARGAR ARCHIVO VISUAL
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];
				$macroproceso ='';
				$proceso = '';
				$subproceso ='';

				if($this->input->post('macroprocesos_documento')=='999'||$this->input->post('macroprocesos_documento')==''){
					$macroproceso = NULL;					
				}else{
					$macroproceso =$this->input->post('macroprocesos_documento');
				}

				if($this->input->post('proceso_documento')=='999'||$this->input->post('proceso_documento')==''){
					$proceso = NULL;
				}else{
					$proceso =$this->input->post('proceso_documento');
				}

				if($this->input->post('subproceso_documento')=='999'||$this->input->post('subproceso_documento')==''){
					$subproceso = NULL;
				}else{
					$subproceso =$this->input->post('subproceso_documento');
				}

				$iddocumento='';
				$this->load->library("upload",$config);
				// if ($this->upload->do_upload('archivov')){
				// 	$data = array('upload_data' => $this->upload->data());

				$fecha = date('Y-m-d H:i:s');
				$idsolicitud = $this->input->post('solicitudesd_documentos');
				$tipo = $this->input->post('tipo');
				$clase = $this->input->post('clase_documento');
				// ------------ GUARDAR DOCUMENTOS CUANDO NO HAY SOLICITUDES ------------//
				if($idsolicitud=="00"){
					//------ GUARDAR SI EL TIPO DE DOCUMENTOS ES INTERNO -------- //
					if($tipo=="0"){
						$registro=array(
							'id_solicitud'=>Null, 
							'nombre'=>$this->input->post('nombre'),
							'id_tipo'=>$this->input->post('tipodocumentos_documento'),
							'tipo' =>$this->input->post('tipo'),
							'clase'=>"8",
							'id_macroproceso'=>$macroproceso,
							'id_procesomaestro'=>$proceso, 
							'id_subproceso'=>$subproceso, 
							'docrelacionado'=>$doc_relacionados,
							'codigo'=>$this->input->post('codigo'),
							'evaluacion'=>$this->input->post('evalua'),
							'des_empleados'=>$val_empleado,
							'des_cargos'=>$val_cargo,
							'des_departamentos' => $val_departamento,
							'fecha_registro'=>$fecha, 
							'id_usuario'=>$this->session->userdata('C_id_usuario'), 
							'estado'=>'1'
						);
					}else{
						//------ GUARDAR SI EL TIPO DE DOCUMENTOS ES EXTERNO -------- //
						if($clase == "5"){ 
							// ----------------  GUARDAR CUANDO SON Guías de Práctica Clínica ----------------- //
							$registro=array(
								'id_solicitud'=>Null, 
								'nombre'=>$this->input->post('nombre'),
								'id_tipo'=>"OD", 
								'tipo'=>$tipo,
								'clase'=>$clase,
								'expedido_por'=>$this->input->post('expide'), 
								'id_macroproceso'=>$macroproceso,
								'id_procesomaestro'=>$proceso, 
								'id_subproceso'=>$subproceso, 
								'codigo'=>$this->input->post('codigo'),
								'evaluacion'=>$this->input->post('evalua'),
								'des_empleados'=>$val_empleado,
								'des_cargos'=>$val_cargo,
								'des_departamentos' => $val_departamento,
								'fecha_registro'=>$fecha, 
								'id_usuario'=>$this->session->userdata('C_id_usuario'), 
								'estado'=>'1'
							);
						}else{
							$registro=array(

								'id_solicitud'=>Null, 
								'nombre'=>$this->input->post('nombre'),
								'id_tipo'=>"OD", 
								'tipo'=>$tipo,
								'clase'=>$clase,
								'expedido_por'=>$this->input->post('expide'), 								
								'codigo'=>$this->input->post('codigo'),
								'evaluacion'=>$this->input->post('evalua'),
								'des_empleados'=>$val_empleado,
								'des_cargos'=>$val_cargo,
								'des_departamentos' => $val_departamento,
								'fecha_registro'=>$fecha, 
								'id_usuario'=>$this->session->userdata('C_id_usuario'), 
								'estado'=>'1'
							);
						}				
					}
					$query = $this->general_model->insert('documentos', $registro);
					$iddocumento=$query;
				}else{
					// ------------ GUARDAR DOCUMENTOS CUANDO HAY SOLICITUDES PARA CREACION DE DOCUMENTOS ------------//
					$tipo_Solicitud = $this->input->post('Id_Tipo_Solicitud');
					if ($tipo_Solicitud == '1'){

						$registro=array(
							'id_solicitud'=>$this->input->post('solicitudesd_documentos'), 
							'nombre'=>$this->input->post('nombre'),
							'id_tipo'=>$this->input->post('Id_Tipo'), 
							'tipo'=>"0",
							'clase'=>"8",
							'id_macroproceso'=>$this->input->post('Id_macro'),
							'id_procesomaestro'=>$this->input->post('Id_proceso'), 
							'id_subproceso'=>$this->input->post('Id_subproceso'), 
							'docrelacionado'=>$this->input->post('doc_relacionado'),
							'codigo'=>$this->input->post('codigo'),
							'evaluacion'=>$this->input->post('evalua'),
							'des_empleados'=>$val_empleado,
							'des_cargos'=>$val_cargo,
							'des_departamentos' => $val_departamento,
							'fecha_registro'=>$fecha, 
							'id_usuario'=>$this->session->userdata('C_id_usuario'), 
							'estado'=>'1'
						);

						$query = $this->general_model->insert('documentos', $registro);
				
						if($query >= 1) { //Guardar el documento visualización en la Base de Datos
							$iddocumento=$query;

							$registro1=array(							
								'estado'=>'6'
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $idsolicitud, $registro1);
						
						}

					// ------------------- GUARDAR ACTUALIZACION DE LAS NOTICACIONES Y TAREAS ------------- //	
						if($query=="OK"){
						
							$usuarioactual = $this->session->userdata('C_id_usuario');
							$campos= 'id_notificacion';
							$idnotificacion ="";
							$query1 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$idsolicitud.'" AND tipo_notificacion = "0" AND id_usuario_2 = "'.$usuarioactual.'" AND estado=0','', 0, 0);
							foreach ($query1->result_array() as $row){
								
								$idnotificacion =$row['id_notificacion'];
							}

							$registro1=array(
										
								'estado'=>'1',
								'fecha_visto'=>$fecha							
							);

							$query = $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);
							
						}
						if($query=="OK"){
							$campos= 'id_tareas';
							$idtarea="";
							$query1 = $this->general_model->consulta_personalizada($campos,'tareas',' id_solicitud = "'.$idsolicitud.'"  AND id_modulo = "0" AND id_usuario_tarea = "'.$usuarioactual.'" AND estado=0','', 0, 0);
							foreach ($query1->result_array() as $row){
								
								$idtarea =$row['id_tareas'];
							}

							$registro1=array(
								'estado'=>'1',
								'fecha_visto'=>$fecha							
							);

							$query = $this->general_model->update('tareas', 'id_tareas', $idtarea, $registro1);						
						}
					}
					// ------------ GUARDAR DOCUMENTOS CUANDO HAY SOLICITUDES PARA MODIFICACION DE DOCUMENTOS ------------//
					else if($tipo_Solicitud == '2'){


						$nombre_document = $this->input->post('nombre');

						$iddocumento = 0;

						$campos= 'id_documento';

						$query1 = $this->general_model->consulta_personalizada($campos,'documentos',' nombre = "'.$nombre_document.'"','', 0, 0);
						
						foreach ($query1->result_array() as $row){
								
							$iddocumento =$row['id_documento'];
						}
					
						//DESTINATARIOS EMPLEADOS
						$val_empleado ="";
						if(!empty($this->input->post('empleadosMR_documentos'))){
							$des_empleado = $this->input->post('empleadosMR_documentos');
							$val_empleado = implode(',', (array) $des_empleado);
						}

						//DESTINATARIOS CARGOS
						$val_cargo = "";
						if(!empty($this->input->post('cargosm_documentos'))){
						$des_cargo = $this->input->post('cargosm_documentos');
						$val_cargo = implode(',', (array) $des_cargo);
						}

						//DESTINATARIOS DEPARTAMENTOS
						$val_departamento ="";
						if(!empty($this->input->post('cargosm_documentos'))){
						$des_departamento = $this->input->post('departamentosM_documentos');
						$val_departamento = implode(',', (array) $des_departamento);
						}

						$registro=array(

							'des_empleados'=>$val_empleado,
							'des_cargos'=>$val_cargo,
							'des_departamentos' => $val_departamento,
							'evaluacion'=>$this->input->post('evalua'),
							'estado'=>$this->input->post('estado')
						);
						
						$query1 = $this->general_model->update('documentos', 'id_documento', $iddocumento, $registro);
						   
						if($query1=="OK"){

						//------------- Actualizar la versión y el Archivo PDF -------------//				

				            $campos ='id_version AS "Id"';
				            
							$query=$this->general_model->consulta_personalizada($campos, 'documentos_versiones', 'id_documento ="'.$iddocumento.'" AND estado = "1"', '', 0, 0);
							$row = $query->row_array();
							$id_version =$row['Id'];
							
							$registro=array(

								'estado'=>'0'
							);
							$query = $this->general_model->update('documentos_versiones', 'id_version', $id_version, $registro);
							
						}
					}
				}				

				if($query == "OK") {
					if ($this->upload->do_upload('archivov')){
						$data = array('upload_data' => $this->upload->data());
						$registro=array(
							'id_documento'=>$iddocumento, 
							'ruta'=>$rutag,
							'archivo'=>$data['upload_data']['file_name'], 
							'version'=>$this->input->post('version'), 
							'fecha'=>$this->input->post('fechaversion'), 
							'estado'=>'1'
						);
						$query = $this->general_model->insert('documentos_versiones', $registro);

					}else{
						$query = "-998";
					}					
				}if($query >= 1) {
					//GUARDAR DESTINATARIOS EMPLEADOS
					if($val_empleado!=""){
						
						$id_empleado = explode(",", $val_empleado);
						if(is_array($id_empleado)){
    						foreach ($id_empleado as $value) {
    							$idempleado = $value;
    							$registro=array(
    								'id_documento'=>$iddocumento, 
									'id_empleado'=>$idempleado, 									
									'fecha_registro'=>$fecha,
									'id_usuario'=>$this->session->userdata('C_id_usuario'),
									'estado'=>'1'
								);
								$query = $this->general_model->insert('documentos_empleados', $registro);
    						}
    					}else{
    						foreach ((array)$id_empleado as $value) {
    							$idempleado = $value;
    							$registro=array(
    								'id_documento'=>$iddocumento, 
									'id_empleado'=>$idempleado, 									
									'fecha_registro'=>$fecha,
									'id_usuario'=>$this->session->userdata('C_id_usuario'),
									'estado'=>'1'
								);
								$query = $this->general_model->insert('documentos_empleados', $registro);
    						}
    					}
    				}

					//GUARDAR DESTINATARIOS CARGOS
					if($val_cargo !=""){ 
						$id_cargo = explode(",", $val_cargo);
						if(is_array($id_cargo)){
    						foreach ($id_cargo as $value) {
    							$idcargo = $value;
    							$registro=array(
    								'id_documento'=>$iddocumento, 
									'id_cargo'=>$idcargo, 									
									'fecha_registro'=>$fecha,
									'id_usuario'=>$this->session->userdata('C_id_usuario'),
									'estado'=>'1'
								);
								$query = $this->general_model->insert('documentos_cargos', $registro);
    						}
    					}else{
    						foreach ((array)$id_cargo as $value) {
    							$idcargo = $value;
    							$registro=array(
    								'id_documento'=>$iddocumento, 
									'id_cargo'=>$idcargo, 									
									'fecha_registro'=>$fecha,
									'id_usuario'=>$this->session->userdata('C_id_usuario'),
									'estado'=>'1'
								);
								$query = $this->general_model->insert('documentos_cargos', $registro);
    						}
    					}
					}						

					//GUARDAR DESTINATARIOS DEPARTAMENTOS
					if($val_departamento!=""){
						$id_departamento = explode(",", $val_departamento);
						if(is_array($id_departamento)){
    						foreach ($id_departamento as $value) {
    							$iddepartamento = $value;
    							$registro=array(
    								'id_documento'=>$iddocumento, 
									'id_area'=>$iddepartamento, 									
									'fecha_registro'=>$fecha,
									'id_usuario'=>$this->session->userdata('C_id_usuario'),
									'estado'=>'1'
								);
								$query = $this->general_model->insert('documentos_areas', $registro);
    						}
    					}else{
    						foreach ((array)$id_departamento as $value) {
    							$iddepartamento = $value;
    							$registro=array(
    								'id_documento'=>$iddocumento, 
									'id_area'=>$iddepartamento, 									
									'fecha_registro'=>$fecha,
									'id_usuario'=>$this->session->userdata('C_id_usuario'),
									'estado'=>'1'
								);
								$query = $this->general_model->insert('documentos_areas', $registro);
    						}
    					}
					}					
					
					echo '1';
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "-998": echo $this->upload->display_errors($ruta); break;
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

				$dir = $this->input->post('tipodocumento');
				$fecha = date('Y-m-d H:i:s');
			 	
			 	if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/')) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/', 0777, true);
				 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/', 0777, true);
					 	}
				 	}
			 	} elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/')) {
				 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/', 0777, true);
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/')) {
					mkdir('archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/', 0777, true);
			 	}

				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/';  
				$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/visualizacion/'.$dir.'/';

				//CARGAR ARCHIVO VISUAL
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];
					
				$id_solicitud = $this->input->post('idsolicitud');
				$iddocumento = $this->input->post('idregistro');

				//DESTINATARIOS EMPLEADOS
				$val_empleado ="";
				$des_empleado = $this->input->post('empleadosMR_documentos');
				if(!empty($this->input->post('empleadosMR_documentos'))){					
					$val_empleado = implode(',', (array) $des_empleado);
				}

				//DESTINATARIOS CARGOS
				$val_cargo = "";
				if(!empty($this->input->post('cargosm_documentos'))){
				$des_cargo = $this->input->post('cargosm_documentos');
				$val_cargo = implode(',', (array) $des_cargo);
				}

				//DESTINATARIOS DEPARTAMENTOS
				$val_departamento ="";
				if(!empty($this->input->post('cargosm_documentos'))){
				$des_departamento = $this->input->post('departamentosM_documentos');
				$val_departamento = implode(',', (array) $des_departamento);
				}

				$registro=array(

					'des_empleados'=>$val_empleado,
					'des_cargos'=>$val_cargo,
					'des_departamentos' => $val_departamento,
					'evaluacion'=>$this->input->post('evalua'),
					'estado'=>$this->input->post('estado')
				);
				
				$query1 = $this->general_model->update('documentos', 'id_documento', $iddocumento, $registro);
				   
				if($query1=="OK"){

				//------------- Actualizar la versión y el Archivo PDF -------------//				

		            $campos ='id_version AS "Id"';
		            
					$query=$this->general_model->consulta_personalizada($campos, 'documentos_versiones', 'id_documento ="'.$iddocumento.'" AND estado = "1"', '', 0, 0);
					$row = $query->row_array();
					$id_version =$row['Id'];
					
					$registro=array(

						'estado'=>'0'
					);
					$query = $this->general_model->update('documentos_versiones', 'id_version', $id_version, $registro);
					
				}					

				if ($query=="OK"){
						$this->load->library("upload",$config);
						if ($this->upload->do_upload('archivov')){
							$data = array('upload_data' => $this->upload->data());
							$registro=array(
								'id_documento'=>$iddocumento, 
								'ruta'=>$rutag,
								'archivo'=>$data['upload_data']['file_name'], 
								'version'=>$this->input->post('version'), 
								'fecha'=>$this->input->post('fechaversion'), 
								'estado'=>'1'
							);
							$query = $this->general_model->insert('documentos_versiones', $registro);
							
							$registro1=array(							
								'estado'=>'6'
							);
						
							$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $id_solicitud, $registro1);
						}else{
							$query = "-998";
						}

					if($query>=1){
						
						//GUARDAR DESTINATARIOS EMPLEADOS
						if($val_empleado!=""){
							
							$id_empleado = explode(",", $val_empleado);
							if(is_array($id_empleado)){
	    						foreach ($id_empleado as $value) {
	    							$idempleado = $value;
	    							$registro=array(
	    								'id_documento'=>$iddocumento, 
										'id_empleado'=>$idempleado, 									
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);
									$query = $this->general_model->insert('documentos_empleados', $registro);
	    						}
	    					}else{
	    						foreach ((array)$id_empleado as $value) {
	    							$idempleado = $value;
	    							$registro=array(
	    								'id_documento'=>$iddocumento, 
										'id_empleado'=>$idempleado, 									
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);
									$query = $this->general_model->insert('documentos_empleados', $registro);
	    						}
	    					}
	    				}

    					//GUARDAR DESTINATARIOS CARGOS
    					if($val_cargo !=""){ 
    						$id_cargo = explode(",", $val_cargo);
							if(is_array($id_cargo)){
	    						foreach ($id_cargo as $value) {
	    							$idcargo = $value;
	    							$registro=array(
	    								'id_documento'=>$iddocumento, 
										'id_cargo'=>$idcargo, 									
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);
									$query = $this->general_model->insert('documentos_cargos', $registro);
	    						}
	    					}else{
	    						foreach ((array)$id_cargo as $value) {
	    							$idcargo = $value;
	    							$registro=array(
	    								'id_documento'=>$iddocumento, 
										'id_cargo'=>$idcargo, 									
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);
									$query = $this->general_model->insert('documentos_cargos', $registro);
	    						}
	    					}
    					}						

    					//GUARDAR DESTINATARIOS DEPARTAMENTOS
						if($val_departamento!=""){

							$id_departamento = explode(",", $val_departamento);
							if(is_array($id_departamento)){
	    						foreach ($id_departamento as $value) {
	    							$iddepartamento = $value;
	    							$registro=array(
	    								'id_documento'=>$iddocumento, 
										'id_area'=>$iddepartamento, 									
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);
									$query = $this->general_model->insert('documentos_areas', $registro);
	    						}
	    					}else{
	    						foreach ((array)$id_departamento as $value) {
	    							$iddepartamento = $value;
	    							$registro=array(
	    								'id_documento'=>$iddocumento, 
										'id_area'=>$iddepartamento, 									
										'fecha_registro'=>$fecha,
										'id_usuario'=>$this->session->userdata('C_id_usuario'),
										'estado'=>'1'
									);
									$query = $this->general_model->insert('documentos_areas', $registro);
	    						}
	    					}
						}						  					
   					}
   					
					if($query>=1){

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

						$socializar = $this->NofiSocializar($des_empleado);
					}

					echo '1';
				}else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "-998": echo $this->upload->display_errors($ruta); break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				}
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function NofiSocializar($funcionarios){
		if(!$this->input->is_ajax_request()) {
			redirect();
		} else {

			$fecha = date('Y-m-d H:i:s');
			$tipo_notificacion = "8";
			
			//SOCIALIZACION A EMPLEADOS
			$des_empleado = $funcionarios;
			$val_empleado = implode(',', (array) $des_empleado);

			$nombre_documento = $this->input->post('nombre');
			$id_usuario_notifica = $this->session->userdata('C_id_usuario');
			$id_usuario_asigna = $this->session->userdata('C_id_usuario');
			$tipo_tarea ="Leer el documento socializado";
			$observacion ="Socialización del documento ".$nombre_documento."";
			$registro=array(
				'socializacion' => '1',
				'evaluacion' => $this->input->post('evalua')
			);
			$query = $this->general_model->update('documentos', 'id_documento', $this->input->post('idregistro'), $registro);
			if ($query == "OK") {
				//GUARDAR DESTINATARIOS EMPLEADOS
				if($val_empleado!=""){					
					$id_empleado = explode(",", $val_empleado);
					if(is_array($id_empleado)){//Cuando son varios funcionarios
						foreach ($id_empleado as $value) {
							$idempleado = $value;
							$registro=array(
								'id_documento'=>$this->input->post('idregistro'),
								'id_empleado' =>$idempleado,
								'fecha_socializacion' =>$fecha,
								'id_usuario' =>$this->session->userdata('C_id_usuario'),
								'evalua' =>'0'
							);
							$query = $this->general_model->insert('documentos_socializacion', $registro);
							if($query>=1){ //NOTIFICACION DE LA SOCIALIZACION
								$id_solicitud = $query;
								    $usuario2 =	$idempleado;			            
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
							}
							if($query >= 1) {	
								$msg='';
								$id_usuario = $this->session->userdata('C_id_usuario');
								$usuario = '';

								$funcionario ='';
								$correo_funcionario='';
								$id_empleado = $usuario2;									

								$campos1='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Funcionario", email AS "Correo"';
								$query11 = $this->general_model->consulta_personalizada($campos1,'empleados', 'id_empleado = "'.$id_empleado.'"', '', 0, 0);
								foreach ($query11->result_array() as $row1)
								{
									$funcionario = $row1['Funcionario'];
									$correo_funcionario = $row1['Correo'];
								}

								$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
								$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
								foreach ($query12->result_array() as $row)
								{
									$usuario = $row['Usuario'];
								}

								$de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
							    
								$Para ="".$funcionario." <".$correo_funcionario.">";
								//$Para ="Edwin Castro <edwincas_17@hotmail.com>";//
								$Asunto ="Correo de Prueba - Socialización de Documento ".$nombre_documento."";

								$Cabeceras = "From:".$de."\r\n"; 
								$Cabeceras .= "MIME-Version: 1.0\r\n";					
								$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
									
								$cuerpo = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
								$cuerpo .= "<div><font size='3'>".$funcionario.",</font></div>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<div><font size='3'>La presente es con el fin de socializar la publicación oficial del documento ".$nombre_documento.", desde el ".$fecha." el cual podrá visualizar a través de la plataforma SIGCA ingresando al siguiente link: <a <a href=".base_url('home/index').">sigca.cecimin.com.co</a></font></div>\r\n";									
							    $cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='3'>Agradeciendo su atención, </font></div>\r\n";
							    $cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='3'>Atentamente, </font></div>\r\n";
							    $cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='3'>".$usuario."</font></div>\r\n";
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
	    				}		    				
	    			}else{
						foreach ((array)$id_empleado as $value) { //Cuando es un solo funcionario
							$idempleado = $value;
							$registro=array(
								'id_documento'=>$this->input->post('idregistro'),
								'id_empleado' =>$idempleado,
								'fecha_socializacion' =>$fecha,
								'id_usuario' =>$this->session->userdata('C_id_usuario'),
								'evalua' =>$this->input->post('evalua')
							);
							$query = $this->general_model->insert('documentos_socializacion', $registro);
							if($query >= 1){
								$id_solicitud = $query;
								    $usuario2 =	$idempleado;			            
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
							}
							if($query >= 1) {					
								
								$msg='';
								$id_usuario = $this->session->userdata('C_id_usuario');
								$usuario = '';

								$funcionario ='';
								$correo_funcionario='';
								$id_empleado = $usuario2;									

								$campos1='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Funcionario", email AS "Correo"';
								$query11 = $this->general_model->consulta_personalizada($campos1,'empleados', 'id_empleado = "'.$id_empleado.'"', '', 0, 0);
								foreach ($query11->result_array() as $row1)
								{
									$funcionario = $row1['Funcionario'];
									$correo_funcionario = $row1['Correo'];
								}

								$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
								$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
								foreach ($query12->result_array() as $row)
								{
									$usuario = $row['Usuario'];
								}

								$de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
							    
								$Para ="".$funcionario." <".$correo_funcionario.">";
								$Asunto ="Socialización de Documento ".$nombre_documento."";

								$Cabeceras = "From:".$de."\r\n"; 
								$Cabeceras .= "MIME-Version: 1.0\r\n";					
								$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
									
								$cuerpo = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
								$cuerpo .= "<div><font size='3'>".$funcionario.",</font></div>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<br>\r\n";
								$cuerpo .= "<div><font size='3'>La presente es con el fin de socializar la publicación oficial del documento ".$nombre_documento.", desde el ".$fecha." el cual podrá visualizar a través de la plataforma SIGCA ingresando al siguiente link: <a <a href=".base_url('home/index').">sigca.cecimin.com.co</a></font></div>\r\n";									
							    $cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='3'>Agradeciendo su atención, </font></div>\r\n";
							    $cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='3'>Atentamente, </font></div>\r\n";
							    $cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='3'>SAMANTA RODRIGUEZ PACHECO</font></div>\r\n";
							    $cuerpo .= "<div><font size='3'>Coordinadora de Calidad</font></div>\r\n";
							    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";		
							    $cuerpo .= "<br>\r\n";
								$cuerpo .= "<br>\r\n";		
							    $cuerpo .= "<br>\r\n";
							    $cuerpo .= "<div><font size='1'>MEDIO AMBIENTE: ¿Necesita realmente imprimir este correo? CONFIDENCIALIDAD: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su destinatario. </font></div>\r\n";									
								
								$msg = $this->sendEmail($Para, $Asunto, $cuerpo, $Cabeceras);
								if($msg=1){
									$query = 1;
								}else{
									$query =-999;						
								}													
							}			
						}							
					}									
				}
				return $query;
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
	        $pdf->SetTitle("SIGCA - Listado de Documentos", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('P', 'LETTER');
            
            $pdf->Ln(10);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE DOCUMENTOS      '), 0, 0, 'C', false);
            $pdf->Ln(20);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(195,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(5);

            $campos ='c.id_cargo AS "Id", c.nombre AS "Nombre", c.descripcion AS "Descripción", IFNULL(a.nombre,"") AS "Area", CASE WHEN c.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
			$query=$this->general_model->consulta_personalizada($campos, 'cargos c LEFT JOIN areas a ON c.id_area = a.id_area', '', 'c.nombre', 0, 0);
			$encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 11);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(7,5,' ',0,0,'C',false);
			$pdf->Cell(16,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(75,5,utf8_decode("NOMBRE"),'LTRB',0,'C',$fill);
			$pdf->Cell(75,5,utf8_decode("ÁREA"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(7,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(7,5,' ',0,0,'C',false);
                $pdf->Cell(16,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(75,5,utf8_decode($row->Nombre),'LTRB',0,'C',$fill);
                $pdf->Cell(75,5,utf8_decode($row->Area),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(7,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Documentos.pdf");
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
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE DOCUMENTOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_documentos_tabla('EXCEL')); 
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
				$query = $this->general_model->update('documentos', 'id_documento', $this->input->post('idreg'), $registro);
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

				$campos = ' aa.id_proceso AS "Id", aa.nombre AS "Nombre", aa.prefijo AS "Prefijo", aa.descripcion AS "Descripción", IFNULL(CONCAT(e.nombre1, " ", e.nombre2, " ", e.apellido1, " ", e.apellido2)," -- ") AS "Responsable",  CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'procesos aa LEFT JOIN empleados e ON aa.id_responsable = e.id_empleado', ' aa.id_proceso = "'.$idreg.'" ', '', 0, 0);
		      
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

	public function cargarsolicitud(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idsol');
			
			$campos='s.id_solicitud AS "Solicitud", s.tipo_solicitud AS "Tipo Solicitud", s.nombre_documento AS "Documento", td.id_tipo AS "Id_Tipo", td.nombre AS "Tipo_doc", m.id_macroproceso AS "Id_macro", m.nombre AS "Macroproceso", p.id_proceso AS "Id_proceso", p.prefijo AS "Prefijo", p.nombre AS "Proceso", sp.id_subproceso AS "Id_subproceso", sp.pref_subproceso AS "Pref_subproceso",sp.nombre AS "Subproceso", s.documento_relacionado AS "doc_relacionado", s.archivo_original AS "Archivo_Origen"';
			$query = $this->general_model->consulta_personalizada($campos,'solicitud_documentos s INNER JOIN macroprocesos m ON s.id_macroproceso = m.id_macroproceso LEFT JOIN procesos p ON s.id_proceso = p.id_proceso LEFT JOIN subprocesos sp ON s.id_subproceso=sp.id_subproceso LEFT JOIN tipos_documentos td on s.id_tipo_documento = td.id_tipo', 's.id_solicitud ="'.$id.'" ', '', 0, 0);
			$row = $query->row_array();

			$docrela = '';
      		$prefdoc = '';

			if($row['doc_relacionado']!=""){

				// $docrela = explode(',', $row['doc_relacionado']);
			
	      		$query1 = $this->general_model->consulta_personalizada('nombre,  RIGHT(codigo,6) AS cod', 'documentos', ' estado = "1" AND id_documento IN ('.$row['doc_relacionado'].') ', 'nombre', 0, 0);
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

			$arr['solicitud'] = array('Solicitud'=>$row['Solicitud'], 'Tipo_solicitud'=>$row['Tipo Solicitud'], 'Documento'=>$row['Documento'], 'Id_Tipo'=>$row['Id_Tipo'], 'Tipo_doc'=>$row['Tipo_doc'], 'Id_macro'=>$row['Id_macro'], 'Macroproceso'=>$row['Macroproceso'],'Id_proceso'=>$row['Id_proceso'], 'Prefijo'=>$row['Prefijo'], 'Proceso'=>$row['Proceso'], 'Id_subproceso'=>$row['Id_subproceso'], 'Pref_subproceso'=>$row['Pref_subproceso'],'Subproceso'=>$row['Subproceso'], 'docrelacionado'=>$docrela, 'prefdocrela'=>$prefdoc,'doc_relacionado'=>$row['doc_relacionado'],  'Archivo_Origen'=>$row['Archivo_Origen']);
			echo json_encode($arr);
		}
	}

	public function cargar_docrelacionado() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				
				$id_macro = $this->input->post('idmacro');
				$id_proc = $this->input->post('idproc');
				$id_subpro = $this->input->post('idsubpr');
				$id_docrel = $this->input->post('iddocrel');   
				$query=''; 
				
				$campos = ' d.id_documento AS "Id", d.nombre AS "Nombre"';
				if($id_subpro != ""){
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_subproceso ="'.$id_subpro.'" AND d.estado ="1"', 'd.nombre', 0, 0);
				}else if($id_proc !=""){ 
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_procesomaestro ="'.$id_proc.'" AND d.id_subproceso IS NULL AND d.estado ="1"', 'd.nombre', 0, 0);
				}else{
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d','d.id_macroproceso="'.$id_macro.'" AND d.id_procesomaestro IS NULL  AND d.id_subproceso IS NULL AND d.estado ="1"', 'd.nombre', 0, 0);
				};			
				
				
				$arr = '';
				foreach($query->result_array() as $row) {
					if(is_array($vdocrela)){
        				foreach ($vdocrela as $value) {
         					
	          				if($value === $row['Id']){
	          				  	$arr .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
				          	}else{
				           		$arr .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
				          	} 
				        }  

				    }else{
				        foreach ((array)$docrela as $value) {
				         
					        if($value === $row['Id']){
					            $arr .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
					        }else{
					            $arr .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
					        }  
				        }
				    }
				}				
				echo $arr;				
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}

	public function importar_documentos()
	{
		$fecha = date('Y-m-d H:i:s'); 

		$upload_file=$_FILES['upload_file']['name'];
		$extension=pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension=='csv')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if($extension=='xls')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata=$spreadsheet->getActiveSheet()->toArray();
		// echo '<pre>';
		// print_r($sheetdata);
		$sheetcount=count($sheetdata);
		if($sheetcount>1)
		{
			$registro=array();
			for ($i=1; $i < $sheetcount; $i++) { 
				$id_solicitud = $sheetdata[$i][0];
				$id_tipo = $sheetdata[$i][1];
				$nombre = $sheetdata[$i][2];				
				$id_macroproceso = $sheetdata[$i][3];
				$id_procesomaestro = $sheetdata[$i][4];
				$id_subproceso = $sheetdata[$i][5];
				$docrelacionado = $sheetdata[$i][6];
				$codigo = $sheetdata[$i][7];
				$evaluacion = $sheetdata[$i][8];
				$des_empleados = $sheetdata[$i][9];				
				$des_departamentos = $sheetdata[$i][10];
				$des_cargos = $sheetdata[$i][11];
				$des_fecha = $sheetdata[$i][12];
				$registro[]=array(
					'id_solicitud'=>$id_solicitud, 			
					'id_tipo'=>$id_tipo, 
					'nombre'=>$nombre,
					'id_macroproceso'=>$id_macroproceso,
					'id_procesomaestro'=>$id_procesomaestro, 
					'id_subproceso'=>$id_subproceso,
					'docrelacionado' =>$docrelacionado,
					'codigo'=>$codigo,
					'evaluacion'=>$evaluacion,
					'des_empleados'=>$des_empleados,
					'des_departamentos' => $des_departamentos,
					'des_cargos'=>$des_cargos,
					'fecha_registro'=>$des_fecha, 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);
			}
				$query = $this->general_model->insert_batch('documentos', $registro);
				
			if($query >= 1)
			{
				echo $query ;
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

	public function cargarEmpleados(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			header('Content-Type: application/json');
			$idcargo = $this->input->get('idcarg'); 
			
			// $idcargo = implode(",",(array)$id);

			$campos='id_empleado AS "Id", IFNULL(CONCAT(nombres, " ", apellidos),"") AS "Empleado"';
			$query = $this->general_model->consulta_personalizada($campos,'empleados', 'id_cargo IN("'.$idcargo.'")', '', 0, 0);

			$arrjson=[];

			foreach($query->result_array() as $row) {
				$arrjson[] = array('id'=>$row['Id'],'text'=>$row['Empleado']);
			}		
									
			echo json_encode($arrjson);			
		}
	}

	public function archivo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			{
				if (!file_exists('/archivos/datos')) {
					echo "No existe";
			 		//mkdir('/archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
			 	}
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
			
				$id_pro ="";	
				$arr="";			
				
				$campos = 'p.id_proceso, p.nombre ';
				$query1 = $this->general_model->consulta_personalizada($campos, 'procesos p','p.id_macroproceso = "'.$this->input->post('macro').'" AND estado = "1" ', 'p.nombre', 0, 0);
				//echo $this->db->last_query();
				$arr = '<option value="999" selected>NO APLICA</option>';
				foreach($query1->result_array() as $row1) {
					$arr .= '<option value="'.$row1['id_proceso'].'">'.$row1['nombre'].'</option>';
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

				$id_subpro ="";	
				$arr="";			
				
				$campos = ' sp.id_subproceso, sp.nombre ';
				$query = $this->general_model->consulta_personalizada($campos, 'subprocesos sp','sp.id_proceso = "'.$this->input->post('proce').'" AND estado = "1" ', 'sp.nombre', 0, 0);
				//echo $this->db->last_query();
				$arr = '<option value="999" selected>NO APLICA</option>';
				foreach($query->result_array() as $row) {
					$arr .= '<option value="'.$row['id_subproceso'].'">'.$row['nombre'].'</option>';
				}
				echo $arr;								
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}


	public function enviarSocializacion(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$fecha = date('Y-m-d H:i:s');
				$tipo_notificacion = "8";
				
				//SOCIALIZACION A EMPLEADOS
				$des_empleado = $this->input->post('funcionarios');
				$val_empleado = implode(',', (array) $des_empleado);

				$nombre_documento = $this->input->post('nombre');
				$id_usuario_notifica = $this->session->userdata('C_id_usuario');
				$id_usuario_asigna = $this->session->userdata('C_id_usuario');
				$tipo_tarea ="Leer el documento socializado";
				$observacion ="Socialización del documento ".$nombre_documento."";
				$registro=array(
					'socializacion' => '1',
					'evaluacion' => $this->input->post('evalua')
				);
				$query = $this->general_model->update('documentos', 'id_documento', $this->input->post('idregistro'), $registro);
				if ($query == "OK") {
					//GUARDAR DESTINATARIOS EMPLEADOS
					if($val_empleado!=""){					
						$id_empleado = explode(",", $val_empleado);
						if(is_array($id_empleado)){//Cuando son varios funcionarios
							foreach ($id_empleado as $value) {
								$idempleado = $value;
								$registro=array(
									'id_documento'=>$this->input->post('idregistro'),
									'id_empleado' =>$idempleado,
									'fecha_socializacion' =>$fecha,
									'id_usuario' =>$this->session->userdata('C_id_usuario'),
									'evalua' =>'0'
								);
								$query = $this->general_model->insert('documentos_socializacion', $registro);
								if($query>=1){
									$id_solicitud = $query;
	 							    $usuario2 =	$idempleado;			            
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
											'id_modulo' =>$tipo_notificacion,
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
								if($query >= 1) {	
									$msg='';
									$id_usuario = $this->session->userdata('C_id_usuario');
									$usuario = '';

									$funcionario ='';
									$correo_funcionario='';
									$id_empleado = $usuario2;									

									$campos1='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Funcionario", email AS "Correo"';
									$query11 = $this->general_model->consulta_personalizada($campos1,'empleados', 'id_empleado = "'.$id_empleado.'"', '', 0, 0);
									foreach ($query11->result_array() as $row1)
									{
										$funcionario = $row1['Funcionario'];
										$correo_funcionario = $row1['Correo'];
									}

									$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
									$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
									foreach ($query12->result_array() as $row)
									{
										$usuario = $row['Usuario'];
									}

									$de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
								    
									$Para ="".$funcionario." <".$correo_funcionario.">";
									//$Para ="Edwin Castro <edwincas_17@hotmail.com>";//
									$Asunto ="Correo de Prueba - Socialización de Documento ".$nombre_documento."";

									$Cabeceras = "From:".$de."\r\n"; 
									$Cabeceras .= "MIME-Version: 1.0\r\n";					
									$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
										
									$cuerpo = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
									$cuerpo .= "<div><font size='3'>".$funcionario.",</font></div>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<div><font size='3'>La presente es con el fin de socializar la publicación oficial del documento ".$nombre_documento.", desde el ".$fecha." el cual podrá visualizar a través de la plataforma SIGCA ingresando al siguiente link: <a <a href=".base_url('home/index').">sigca.cecimin.com.co</a></font></div>\r\n";									
								    $cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='3'>Agradeciendo su atención, </font></div>\r\n";
								    $cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='3'>Atentamente, </font></div>\r\n";
								    $cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='3'>".$usuario."</font></div>\r\n";
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
		    				}		    				
		    			}else{
							foreach ((array)$id_empleado as $value) { //Cuando es un solo funcionario
								$idempleado = $value;
								$registro=array(
									'id_documento'=>$this->input->post('idregistro'),
									'id_empleado' =>$idempleado,
									'fecha_socializacion' =>$fecha,
									'id_usuario' =>$this->session->userdata('C_id_usuario'),
									'evalua' =>$this->input->post('evalua')
								);
								$query = $this->general_model->insert('documentos_socializacion', $registro);
								if($query >= 1){
									$id_solicitud = $query;
	 							    $usuario2 =	$idempleado;			            
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
											'id_modulo' =>$tipo_notificacion,
											'descripcion'=>$observacion, 
											'id_solicitud' =>$id_solicitud,
											'id_usuario_asignado'=>$id_usuario_asigna, 
											'id_usuario_tarea'=>$usuario2,										
											'estado'=>'0',
											'fecha_registro'=>$fecha
										);
										$query = $this->general_model->insert('tareas', $registro3);
						          	}						        	
								}
								if($query >= 1) {					
									
									$msg='';
									$id_usuario = $this->session->userdata('C_id_usuario');
									$usuario = '';

									$funcionario ='';
									$correo_funcionario='';
									$id_empleado = $usuario2;									

									$campos1='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Funcionario", email AS "Correo"';
									$query11 = $this->general_model->consulta_personalizada($campos1,'empleados', 'id_empleado = "'.$id_empleado.'"', '', 0, 0);
									foreach ($query11->result_array() as $row1)
									{
										$funcionario = $row1['Funcionario'];
										$correo_funcionario = $row1['Correo'];
									}

									$campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
									$query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
									foreach ($query12->result_array() as $row)
									{
										$usuario = $row['Usuario'];
									}

									$de="Calidad CECIMIN <calidad.cecimin@saludinteligente.com>";
								    
									$Para ="".$funcionario." <".$correo_funcionario.">";
									$Asunto ="Socialización de Documento ".$nombre_documento."";

									$Cabeceras = "From:".$de."\r\n"; 
									$Cabeceras .= "MIME-Version: 1.0\r\n";					
									$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
										
									$cuerpo = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
									$cuerpo .= "<div><font size='3'>".$funcionario.",</font></div>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<br>\r\n";
									$cuerpo .= "<div><font size='3'>La presente es con el fin de socializar la publicación oficial del documento ".$nombre_documento.", desde el ".$fecha." el cual podrá visualizar a través de la plataforma SIGCA ingresando al siguiente link: <a <a href=".base_url('home/index').">sigca.cecimin.com.co</a></font></div>\r\n";									
								    $cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='3'>Agradeciendo su atención, </font></div>\r\n";
								    $cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='3'>Atentamente, </font></div>\r\n";
								    $cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='3'>SAMANTA RODRIGUEZ PACHECO</font></div>\r\n";
								    $cuerpo .= "<div><font size='3'>Coordinadora de Calidad</font></div>\r\n";
								    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";		
								    $cuerpo .= "<br>\r\n";
									$cuerpo .= "<br>\r\n";		
								    $cuerpo .= "<br>\r\n";
								    $cuerpo .= "<div><font size='1'>MEDIO AMBIENTE: ¿Necesita realmente imprimir este correo? CONFIDENCIALIDAD: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su destinatario. </font></div>\r\n";									
									
									$msg = $this->sendEmail($Para, $Asunto, $cuerpo, $Cabeceras);
									if($msg=1){
										$query = 1;
									}else{
										$query =-999;						
									}													
								}			
							}							
						}
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



	public function sendEmail($Para, $Asunto, $cuerpo, $Cabeceras){
		if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
			$msg = 1;				
		}else{
			$msg = $this->email->print_debugger();	
		}
		return $msg;
	}
}