<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_solicitud extends CI_Controller
{


	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Bogota');

		$this->load->helper('email');	

		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
		}
	}

	public function index()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
			$this->session->set_userdata('archivo_origen', '');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo', '');
			// $this->session->set_userdata('archivo_visual_tipo','');

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['current_year'] = date('Y');
			$data_usua['titulo'] = "Solicitudes";
			$data_usua['origen'] = "Mantenimientos";
			$data_usua['contenido'] = 'm_solicitud/index';
			$data_usua['entrada_js'] = '_js/m_solicitud.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->

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
    		';
			$this->load->view('template', $data_usua);
		}
	}

	public function nuevo()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->session->set_userdata('archivo_origen', '');
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Solicitudes";
			$data_usua['origen'] = "Documentos";
			$data_usua['contenido'] = 'm_solicitud/nuevo';
			$data_usua['entrada_js'] = '_js/m_solicitud.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->

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

	public function gestionar($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
			$this->session->set_userdata('archivo_origen', '');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo', '');

			$data_usua['c_id_solicitud'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_id_manterimientor'] = '';
			$data_usua['c_nom_manterimientor'] = '';
			$data_usua['c_id_servicio'] = '';
			$data_usua['c_nom_servicio'] = '';
			$data_usua['c_otros_mantenimientos'] = '';
			$data_usua['c_ubicacion'] = '';
			$data_usua['c_observaciones'] = '';
			$data_usua['c_id_solicitante'] = '';
			$data_usua['c_nom_solicitante'] = '';
			$data_usua['c_correo'] ='';
			$data_usua['c_fecha_solicitud'] = '';
			$data_usua['c_estado'] = '';

			$campos = 'ms.id_manterimientor AS "id_manterimientor", mr.nombre AS "descripcion", ms.id_servicio AS "id_servicio", s.nombre AS "nombre_servicio", ms.otros_mantenimientos AS "otros_mantenimientos", ms.ubicacion AS "ubicacion", ms.observaciones AS "observaciones", ms.id_solicitante AS "id_solicitante", IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Coordinador", e.email AS "Correo", ms.fecha_solicitud, ms.estado';

			$query = $this->general_model->consulta_personalizada($campos, "mantenimientos_solicitudes ms INNER JOIN servicios s ON ms.id_servicio=s.id_servicio INNER JOIN mantenimientos_servicios mr ON ms.id_manterimientor = mr.id_servicio INNER JOIN empleados e ON e.id_empleado = ms.id_solicitante", 'ms.id_solicitud="' . $id . '"', '', 0, 0);

			foreach ($query->result_array() as $row) {
				$data_usua['c_id_manterimientor'] = $row['id_manterimientor'];
				$data_usua['c_nom_manterimientor'] = $row['descripcion'];
				$data_usua['c_id_servicio'] = $row['id_servicio'];
				$data_usua['c_nom_servicio'] = $row['nombre_servicio'];
				$data_usua['c_otros_mantenimientos'] = $row['otros_mantenimientos'];
				$data_usua['c_ubicacion'] = $row['ubicacion'];
				$data_usua['c_observaciones'] =  $row['observaciones'];
				$data_usua['c_id_solicitante'] = $row['id_solicitante'];
				$data_usua['c_nom_solicitante'] = $row['Coordinador'];
				$data_usua['c_correo'] = $row['Correo'];
				$data_usua['c_fecha_solicitud'] = $row['fecha_solicitud'];
				$data_usua['c_estado'] = $row['estado'];
			}

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Gestionar Solicitud Mantenimiento";
			$data_usua['origen'] = "Gestión de Mantenimientos";
			$data_usua['contenido'] = 'm_solicitud/gestionar';
			$data_usua['entrada_js'] = '_js/m_solicitud.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">
    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
    		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->

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
		    <script src="' . base_url('_js/dom.js') . '"></script>
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

			$this->load->view('template', $data_usua);
		}
	}

	public function ejecutar($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
			$this->session->set_userdata('archivo_origen', '');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo', '');

			$data_usua['c_id_solicitud'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_id_manterimientor'] = '';
			$data_usua['c_nom_manterimientor'] = '';
			$data_usua['c_tipoMantenimiento'] = '';
			$data_usua['c_id_servicio'] = '';
			$data_usua['c_nom_servicio'] = '';
			$data_usua['c_otros_mantenimientos'] = '';
			$data_usua['c_ubicacion'] = '';
			$data_usua['c_observaciones'] = '';
			$data_usua['c_observacionesM'] = '';
			$data_usua['c_id_solicitante'] = '';
			$data_usua['c_nom_solicitante'] = '';
			$data_usua['c_correo'] ='';
			$data_usua['c_fecha_solicitud'] = '';
			$data_usua['c_fechaIM'] = '';
			$data_usua['c_fechaFM'] = '';
			$data_usua['c_prioridad'] = '';
			$data_usua['c_estado'] = '';

			$campos = 'ms.id_manterimientor AS "id_manterimientor", mr.nombre AS "descripcion", ms.id_servicio AS "id_servicio", s.nombre AS "nombre_servicio", ms.otros_mantenimientos AS "otros_mantenimientos", ms.ubicacion AS "ubicacion",  mp.tipo_mantenimiento AS "tipoMantenimiento", ms.observaciones AS "observaciones", mp.observaciones_p AS "observacionesP", ms.id_solicitante AS "id_solicitante", IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Coordinador", e.email AS "Correo", ms.fecha_solicitud, DATE(mp.fecha_programacion_I) AS "fechaIP", DATE(mp.fecha_programacion_F) AS "fechaFP", mp.prioridad AS "prioridad", ms.estado AS "estado"';

			$query = $this->general_model->consulta_personalizada($campos, "mantenimientos_solicitudes ms INNER JOIN servicios s ON ms.id_servicio=s.id_servicio INNER JOIN mantenimientos_servicios mr ON ms.id_manterimientor = mr.id_servicio INNER JOIN empleados e ON e.id_empleado = ms.id_solicitante INNER JOIN mantenimientos_programacion mp ON mp.id_solicitudm = ms.id_solicitud", 'ms.id_solicitud="' . $id . '"', '', 0, 0);

			foreach ($query->result_array() as $row) {
				$data_usua['c_id_manterimientor'] = $row['id_manterimientor'];
				$data_usua['c_nom_manterimientor'] = $row['descripcion'];
				$data_usua['c_id_servicio'] = $row['id_servicio'];
				$data_usua['c_nom_servicio'] = $row['nombre_servicio'];
				$data_usua['c_otros_mantenimientos'] = $row['otros_mantenimientos'];
				$data_usua['c_ubicacion'] = $row['ubicacion'];
				$data_usua['c_observaciones'] =  $row['observaciones'];
				$data_usua['c_id_solicitante'] = $row['id_solicitante'];
				$data_usua['c_nom_solicitante'] = $row['Coordinador'];
				$data_usua['c_correo'] = $row['Correo'];
				$data_usua['c_fecha_solicitud'] = $row['fecha_solicitud'];
				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_tipoMantenimiento'] =  $row['tipoMantenimiento'];
				$data_usua['c_observacionesP'] = 'observacionesP';

				$data_usua['c_fechaIM'] = $row['fechaIP'];
				$data_usua['c_fechaFM'] = $row['fechaFP'];
				$data_usua['c_prioridad'] = $row['prioridad'];
			}

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Gestionar Solicitud Mantenimiento";
			$data_usua['origen'] = "Gestión de Mantenimientos";
			$data_usua['contenido'] = 'm_solicitud/ejecutar';
			$data_usua['entrada_js'] = '_js/m_solicitud.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->

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
			<script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
			';

			$this->load->view('template', $data_usua);
		}
	}


	public function recibir($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
			$this->session->set_userdata('archivo_origen', '');
			// $this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_origen_tipo', '');

			$data_usua['c_id_solicitud'] = $id;
			$data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');
			$data_usua['c_id_manterimientor'] = '';
			$data_usua['c_nom_manterimientor'] = '';
			$data_usua['c_tipoMantenimiento'] = '';
			$data_usua['c_id_servicio'] = '';
			$data_usua['c_nom_servicio'] = '';
			$data_usua['c_otros_mantenimientos'] = '';
			$data_usua['c_ubicacion'] = '';
			$data_usua['c_observaciones'] = '';
			$data_usua['c_observacionesM'] = '';
			$data_usua['c_id_solicitante'] = '';
			$data_usua['c_nom_solicitante'] = '';
			$data_usua['c_correo'] ='';
			$data_usua['c_fecha_solicitud'] = '';
			$data_usua['c_fechaIM'] = '';
			$data_usua['c_fechaFM'] = '';
			$data_usua['c_prioridad'] = '';
			$data_usua['c_fechaEM'] = '';
			$data_usua['c_observacionesE'] = '';

			$data_usua['c_estado'] = '';

			$campos = 'ms.id_manterimientor AS "id_manterimientor", mr.nombre AS "descripcion", ms.id_servicio AS "id_servicio", s.nombre AS "nombre_servicio", ms.otros_mantenimientos AS "otros_mantenimientos", ms.ubicacion AS "ubicacion",  mp.tipo_mantenimiento AS "tipoMantenimiento", ms.observaciones AS "observaciones", mp.observaciones_p AS "observacionesP", ms.id_solicitante AS "id_solicitante", IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Coordinador", e.email AS "Correo", ms.fecha_solicitud, DATE(mp.fecha_programacion_I) AS "fechaIP", DATE(mp.fecha_programacion_F) AS "fechaFP", mp.prioridad AS "prioridad", DATE(mp.fecha_ejecucion) AS "FechaEM", mp.observaciones_e AS "ObservacionesE", ms.estado AS "Estado"';

			$query = $this->general_model->consulta_personalizada($campos, "mantenimientos_solicitudes ms INNER JOIN servicios s ON ms.id_servicio=s.id_servicio INNER JOIN mantenimientos_servicios mr ON ms.id_manterimientor = mr.id_servicio INNER JOIN empleados e ON e.id_empleado = ms.id_solicitante INNER JOIN mantenimientos_programacion mp ON mp.id_solicitudm = ms.id_solicitud", 'ms.id_solicitud="' . $id . '"', '', 0, 0);

			foreach ($query->result_array() as $row) {

				$data_usua['c_id_manterimientor'] = $row['id_manterimientor'];
				$data_usua['c_nom_manterimientor'] = $row['descripcion'];
				$data_usua['c_id_servicio'] = $row['id_servicio'];
				$data_usua['c_nom_servicio'] = $row['nombre_servicio'];
				$data_usua['c_otros_mantenimientos'] = $row['otros_mantenimientos'];
				$data_usua['c_ubicacion'] = $row['ubicacion'];
				$data_usua['c_observaciones'] =  $row['observaciones'];
				$data_usua['c_id_solicitante'] = $row['id_solicitante'];
				$data_usua['c_nom_solicitante'] = $row['Coordinador'];
				$data_usua['c_correo'] = $row['Correo'];
				$data_usua['c_fecha_solicitud'] = $row['fecha_solicitud'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_tipoMantenimiento'] =  $row['tipoMantenimiento'];
				$data_usua['c_observacionesP'] = $row['observacionesP'];

				$data_usua['c_fechaIM'] = $row['fechaIP'];
				$data_usua['c_fechaFM'] = $row['fechaFP'];

				$data_usua['c_fechaEM'] = $row['FechaEM'];
				$data_usua['c_observacionesE'] = $row['ObservacionesE'];

				$data_usua['c_prioridad'] = $row['prioridad'];
			}

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Gestionar Solicitud Mantenimiento";
			$data_usua['origen'] = "Gestión de Mantenimientos";
			$data_usua['contenido'] = 'm_solicitud/recibir';
			$data_usua['entrada_js'] = '_js/m_solicitud.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->

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
			<script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
			';

			$this->load->view('template', $data_usua);
		}
	}

	public function listar_tabla()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$usuario = $this->session->userdata('C_id_usuario');
				$this->load->helper('funciones_tabla');
				echo listar_m_solicitudes_tabla('WEB', $usuario);
			}
		}
	}

	public function cargar_serviciosr()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$arr = "";
				$campos = 'id_mantenimiento_r AS "Id", nombre AS "Nombre"';
				$query = $this->general_model->consulta_personalizada(
					$campos,
					'mantenimientos_requeridos',
					'estado = "1"',
					'',
					0,
					0
				);
				$arr = '<option value = "" selected> seleccione una opcion </option>';

				foreach ($query->result_array() as $row) {
					$arr .= '<option value="' . $row['Id'] . '">' . $row['Nombre'] . '</option>';
				}
				echo $arr;
			}
		}
	}

	public function cargar_notas(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id = $this->input->post('idreg');

				$campos = 'descripcion_nota AS "Nota", fecha_nota AS "Fecha Nota"';
				$query = $this->general_model->consulta_personalizada($campos,'mantenimientosp_notas','id_manto_programado='.$id.'','',0,0);

				$tabla = '<table id="simple-table" class="table border-1 table-bordered brc-black-tp11 bgc-white" style="width:100%">';
				$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
				
			    $tabla .= '<th style="width:50px" align="center" >Id</th><th style="width:150px" align="center">Nota</th><th style="width:100px" align="center">Fecha Nota</th>';
			   
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
				
				$i = 0;
				foreach ($query->result_array() as $row)
    			{
    				$i++;
					$tabla .= '<tr class="d-style bgc-h-default-l4"><td style="width:50px">'.$i.'</td><td style="width:150px">'.$row['Nota'].'</td><td style="width:100px">'.$row['Fecha Nota'].'</td></tr>';
				}
				$tabla .= '</tbody></table>';

				echo $tabla;
			}
		}
	}

	public function cargar_servicios()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$arr = "";
				$campos = 'id_servicio AS "Id", nombre AS "Nombre"';
				$query = $this->general_model->consulta_personalizada($campos,'servicios','estado = "1"','',0,0);

				foreach ($query->result_array() as $row) {
					$arr .= '<option value="' . $row['Id'] . '">' . $row['Nombre'] . '</option>';
				}
				echo $arr;
			}
		}
	}

	public function guardar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				//echo "ingreso";
				$this->load->helper('email'); // Cargar el helper de email
				$id_solicitud = "";
				$fecha = date('Y-m-d H:i:s');
				$solicitante = $this->input->post('coordinador_jefeinm');
				$observacion ="";

				$correo_mantenimiento = "";

				$registro = array(
					'tipo_solicitud' => "8",
					'id_manterimientor' => $this->input->post('serviciomto_solicitud'),
					'otros_mantenimientos' => $this->input->post('otroM'),
					'id_servicio' => $this->input->post('servicio'),					
					'ubicacion' => $this->input->post('ubicacion'),
					'observaciones' => $this->input->post('observaciones'),
					'id_solicitante' => $solicitante,
					'fecha_solicitud' => $fecha,
					'estado' => '0'
				);

				$query = $this->general_model->insert('mantenimientos_solicitudes', $registro);

				//---------------- Guardar las evidencias -----------------\\
				$id_solicitud = $query;


				if (isset($_FILES['archivo_evidencia'])) {

				 	if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
				 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/', 0777, true);
					 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/'.$id_solicitud.'/')) {
						 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/'.$id_solicitud.'/', 0777, true);
						 	}
					 	}
				 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/')) {
					 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/', 0777, true);
				 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/'.$id_solicitud.'/')) {
						mkdir('archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/'.$id_solicitud.'/', 0777, true);
					}

					$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/'.$id_solicitud.'/';  
					$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/mantenimiento/'.$id_solicitud.'/';

					$config = [
						"upload_path" => $ruta,
						"allowed_types" => "*"
					];
	
					$files = $_FILES;
	        		$cpt = count($_FILES ['archivo_evidencia'] ['name']);
		        
			        for ($i = 0; $i < $cpt; $i ++) {

			            $name = time().$files ['archivo_evidencia'] ['name'] [$i];
			            $_FILES ['archivo_evidencia'] ['name'] = $name;
			            $_FILES ['archivo_evidencia'] ['type'] = $files ['archivo_evidencia'] ['type'] [$i];
			            $_FILES ['archivo_evidencia'] ['tmp_name'] = $files ['archivo_evidencia'] ['tmp_name'] [$i];
			            $_FILES ['archivo_evidencia'] ['error'] = $files ['archivo_evidencia'] ['error'] [$i];
			            $_FILES ['archivo_evidencia'] ['size'] = $files ['archivo_evidencia'] ['size'] [$i];

			            $this->load->library('upload', $config);
            			$this->upload->initialize($config);
			            
			            if(!($this->upload->do_upload('archivo_evidencia')) || $files ['archivo_evidencia'] ['error'] [$i] !=0)
			            {
			                $file_error = $this->upload->display_errors();
			                $query = 0;
			            }else{

			            	$file_data = $this->upload->data();
			            	$filename = $rutag.$name;
			            	$registro1=array(
								
								'id_solicitud'=>$id_solicitud, 
								'ruta_archivo'=>$filename, 						 						
								'fecha_registro'=>$fecha 
							);
							$query1 = $this->general_model->insert('mantenimientos_anexos', $registro1);
			            }
			        }    
				}


				// --------------- Guardar Notificación  -------------------\\
				if($query >= 1) {
					
					$tipo_notificacion="11";
					$id_usuario_notifica = $this->input->post('coordinador_jefeinm');
					$id_usuario_2 = 3;
											
					$observacion ="Solicitud de Mantenimiento: ".$this->input->post('nombreMantemientoR').", Servicio:".$this->input->post('nombreServicio').", Solicitud N°".$query1;
					
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
				//ENVIAR CORREO A MANTENIMIENTO
				if ($query2 >= 1) {
					
					$correo_solicitante ="";
					$nombre_solicitante ="";
					$cargo_solicitante="";

					$campos = 'IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Solicitante", c.nombre AS "Cargo", e.email AS "Email"';
					$query = $this->general_model->consulta_personalizada($campos, "empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo", 'e.id_empleado ="' . $solicitante . '"', '', 0, 0);
					foreach ($query->result_array() as $row) {
						$correo_solicitante = $row['Email'];
						$nombre_solicitante = $row['Solicitante'];
						$cargo_solicitante = $row['Cargo'];
					}

					$qradicado = $query1;
				 	// $de = '' . $nombre_solicitante . ' - <' . $correo_solicitante . '>';
					// Configurar el correo					
					
					
					$correo_remitente ='Mantenimiento';
		            $correo_usuario = 'fabian.alvarado@colsanitas.com';
		            $correo_cc = 'mantenimiento@cecimin.com.co';			
				 	

					
					$asunto = "Solicitud de Mantenimiento'" . $observacion . "'";					

					$mensaje = "<div><font size='3'>Señores,</font></div>\r\n";
					$mensaje .= "<div><font size='3'>CECIMIN S.A.S.,</font></div>\r\n";
					$mensaje .= "<div><font size='3'>Atte: Mantenimiento,</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='4'>De manera atenta, solicito su valiosa colaboración con la solicitud de <b>".$this->input->post('nombreMantemientoR')."</b>, para el servicio  <b>".$this->input->post('nombreServicio')."</b>, el detalle de la solicitud lo puede  visualizar y gestionar en SIGCA.</font></div>\r\n";
					$mensaje .= "<br>\r\n";					
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
					$mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
					$mensaje .= "<br>\r\n";

					// Archivos a adjuntar
		        	$adjuntos = null;

		        	// Enviar el correo utilizando el buzón de citas
		        	if (enviar_correo($correo_usuario, $asunto, $mensaje, 'ingreso',  $correo_remitente, $adjuntos,$correo_cc)) {
			            echo "1";
			            $query = 1;
		        	} else {
			            echo "0";
			            $query =-999;	
		        	}	     
				}				

				if ($query1 >= 1) {
					echo '1';
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch ($query1) {
						case "1062":
							echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
							break;
						default:
							echo "Error: " . $query1 . " => " . $this->db->_error_message();
							break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function guardar_gestion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				//echo "ingreso";
				$id_solicitud = $this->input->post('idreg');
				$estado = $this->input->post('estado');
				$fecha = date('Y-m-d H:i:s');
				$query = "";
				$query1 = "";

				if ($estado == "1") {

					$claseN = "";
						switch ($this->input->post('tipo_mantenimiento')) {
						case 1:
							$claseN = 'bgc-blue-d1 text-white text-95';
							break;
						case 2:
							$claseN = 'bgc-green-d2 text-white text-95';
							break;
						case 3:
							$claseN = 'bgc-red-d1 text-white text-95';
							break;
						case 4:
							$claseN = 'bgc-purple-d1 text-white text-95';
							break;
						case 5:
							$claseN = 'bgc-orange-d1 text-white text-95';
							break;
					}
					$fechafin = strtotime('+1 day', strtotime($this->input->post('fechaMfin')));
					$registro = array(
						'id_solicitudm' => $id_solicitud,
						'title' => $this->input->post('nombreservicio'),
						'fecha_programacion_I' => $this->input->post('fechaMInicial'),
						'fecha_programacion_F' => $fechafin,
						'classN' => $claseN,
						'observaciones_p' => $this->input->post('observaciones'),
						'fecha_registro' => $fecha,
						'estado' => '0'
					);
					// var_dump($registro);
					$query = $this->general_model->insert('mantenimientos_programacion', $registro);
					if($query >= 1) {
						$cantNota = $this->input->post('cantNota');
						$i = 1;	
						while ($i <= $cantNota){

							$registro1 = array(

								'id_manto_programado'=> $query,	
								'fecha_nota'=> $fecha,
								'descripcion_nota'=> $this->input->post('descripcionNota'.$i.''),
								'usuario_registro'=> $this->session->userdata('C_id_usuario')
							);
							$query1 = $this->general_model->insert('mantenimientosp_notas', $registro1);
							$i++;
						}

					}

					// var_dump($registro);
					// --------------- Guardar Notificación  -------------------\\
					if($query >= 1) {
						$id_solicitud = $id_solicitud ;
						$tipo_notificacion="11";
						$id_usuario_notifica = 3;
						$id_usuario_2 = $this->input->post('idsolicitante');
												
						$observacion ="Mantenimiento: ".$this->input->post('rservicio').", Servicio: ".$this->input->post('nombreservicio').", Programado";
						
						$registro2=array(
							'tipo_notificacion'=>$tipo_notificacion,
							'id_solicitud' =>$id_solicitud,
							'id_usuario_notifica'=>$id_usuario_notifica, 
							'id_usuario_2'=>$id_usuario_2, 
							'observacion'=>$observacion, 
							'estado'=>'0',
							'fecha_registro'=>$fecha				
						);

						$query1 = $this->general_model->insert('notificaciones', $registro2);
						 //Guardar Tarea
					}

					if ($query1 >= 1) {

						$solicitante = $this->input->post('coordinador_jefeinm');
						$correo_solicitante ="";
						$nombre_solicitante ="";
						$cargo_solicitante="";

						$campos = 'IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Solicitante", c.nombre AS "Cargo", e.email AS "Email"';
						$query2 = $this->general_model->consulta_personalizada($campos, "empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo", 'e.id_empleado ="' . $solicitante . '"', '', 0, 0);
						foreach ($query2->result_array() as $row) {
							$correo_solicitante = $row['Email'];
							$nombre_solicitante = $row['Solicitante'];
							$cargo_solicitante = $row['Cargo'];
						}

						$qradicado = $id_solicitud;
					 	$de = '' . $nombre_solicitante . ' - <' . $correo_solicitante . '>';

					 	//$de = "edwincas_17@hotmail.com";

						// Envio envio de correo de notificacion para el servidor
						// $Para = '' . $nombre_solicitante . ' - <' . $correo_solicitante . '>';
						$Para = 'fabian.alvarado@colsanitas.com'; 
						$Asunto = "'" . $observacion . "'";

						$Cabeceras = "From:" . $de . "\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n";
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n";

						$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'>CECIMIN S.A.S.,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'>Atte: Mantenimiento,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='4'>En respuesta a su solictud, me permito informarle que el <b>".$this->input->post('rservicio')."</b>, para el servicio  <b>".$this->input->post('nombreservicio')."</b>, quedo programado así ".$this->input->post('fechaMInicial'). ", le recomendamos tener en cuenta las siguientes rescomendaciones " .$this->input->post('observaciones').".</font></div>\r\n";
						$cuerpo .= "<br>\r\n";					
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
						$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
						$cuerpo .= "<br>\r\n";

						// Correo para el usuraio
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if ($msg = 1) {
							$query = 1;
						} else {
							$query = -999;
						}
					}					
					
				}else if ($estado == "4"){

					// --------------- Guardar Notificación  -------------------\\
				
					$tipo_notificacion="11";
					$id_usuario_notifica = 3;
					$id_usuario_2 = $this->input->post('coordinador_jefeinm');
											
					$observacion ="Su Solicitud de Mantenimiento: ".$this->input->post('nombreMantemientoR')." para el Servicio: ".$this->input->post('nombreServicio').", fue rechazada";
					
					$registro2=array(
						'tipo_notificacion'=>$tipo_notificacion,
						'id_solicitud' =>$id_solicitud,
						'id_usuario_notifica'=>$id_usuario_notifica, 
						'id_usuario_2'=>$id_usuario_2, 
						'observacion'=>$observacion, 
						'estado'=>'0',
						'fecha_registro'=>$fecha				
					);

					$query1 = $this->general_model->insert('notificaciones', $registro2);
					 //Guardar Tarea

					if ($query1 >= 1) {

						$solicitante = $this->input->post('coordinador_jefeinm');
						$correo_solicitante ="";
						$nombre_solicitante ="";
						$cargo_solicitante="";

						$campos = 'IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Solicitante", c.nombre AS "Cargo", e.email AS "Email"';
						$query = $this->general_model->consulta_personalizada($campos, "empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo", 'e.id_empleado ="' . $solicitante . '"', '', 0, 0);
						foreach ($query->result_array() as $row) {
							$correo_solicitante = $row['Email'];
							$nombre_solicitante = $row['Solicitante'];
							$cargo_solicitante = $row['Cargo'];
						}

						$qradicado = $id_solicitud;
					 	// $de = '' . $nombre_solicitante . ' - <' . $correo_solicitante . '>';

					 	$de ='fabian.alvarado@colsanitas.com';

						// Envio envio de correo de notificacion para el servidor
						// $Para = '' . $nombre_solicitante . ' - <' . $correo_solicitante . '>';
						$Para = $correo_solicitante; 
						$Asunto = "'" . $observacion . "'";

						$Cabeceras = "From:" . $de . "\r\n";
						$Cabeceras .= "MIME-Version: 1.0\r\n";
						$Cabeceras .= "Content-type: text/html; charset=utf-8\n";

						$cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'>CECIMIN S.A.S.,</font></div>\r\n";
						$cuerpo .= "<div><font size='3'>Atte: Mantenimiento,</font></div>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='4'>En respuesta a su solictud, me permito informarle que el <b>".$this->input->post('rservicio')."</b>, para el servicio  <b>".$this->input->post('nombreservicio')."</b>, fue rechazada por las siguientes razones:  " .$this->input->post('observaciones').".</font></div>\r\n";
						$cuerpo .= "<br>\r\n";					
						$cuerpo .= "<br>\r\n";
						$cuerpo .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
						$cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
						$cuerpo .= "<br>\r\n";

						// Correo para el usuraio
						$msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
						if ($msg = 1) {
							$query = 1;
						} else {
							$query = -999;
						}
					}	
				}				

				$registro2 = array(
					'fecha_gestion' => $fecha,
					'estado' => $this->input->post('estado')						
				);

				$query2 = $this->general_model->update('mantenimientos_solicitudes', 'id_solicitud', $id_solicitud, $registro2);
				
				// ---------------- Cambiar notificaciones y tareas a visto ---------------- //
				if ($query2 >= 1) {
					$usuarioactual = $this->session->userdata('C_id_usuario');
					$campos= 'id_notificacion';
					$idnotificacion ="";
					$query3 = $this->general_model->consulta_personalizada($campos,'notificaciones',' id_solicitud = "'.$id_solicitud.'" AND tipo_notificacion = "11" AND id_usuario_2 = "'.$usuarioactual.'"','', 0, 0);
					foreach ($query3->result_array() as $row){
						
						$idnotificacion =$row['id_notificacion'];
					}

					$registro1=array(
								
						'estado'=>'1',
						'fecha_visto'=>$fecha							
					);

					$query2= $this->general_model->update('notificaciones', 'id_notificacion', $idnotificacion, $registro1);				
				}


				if ($query >= 1) {
					echo '1';
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch ($query) {
						case "1062":
							echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
							break;
						default:
							echo "Error: " . $query . " => " . $this->db->_error_message();
							break;
					}
					echo '</div>';
				}
			}
		}
	}


	public function guardar_ejecucion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$id_solicitud = $this->input->post('idreg');
				$fecha = date('Y-m-d H:i:s');

				$registro = array(

					'fecha_ejecucion' => $this->input->post('fechaEjecucion'),
					'observaciones_e' => $this->input->post('observacionesE'),
					'estado' => '1',
				);

				$query = $this->general_model->update('mantenimientos_programacion', 'id_solicitudm', $id_solicitud, $registro);

				$registro2 = array(
					'estado' => '2'
				);

				$query1 = $this->general_model->update('mantenimientos_solicitudes', 'id_solicitud', $id_solicitud, $registro2);

				if ($query1 == 'OK') {

					echo '1';
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch ($query) {
						case "1062":
							echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
							break;
						default:
							echo "Error: " . $query . " => " . $this->db->_error_message();
							break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function guardar_recibir()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$id_solicitud = $this->input->post('idreg');
				$fecha = date('Y-m-d H:i:s');

				$registro = array(

					'fecha_recibido' => $this->input->post('fecharecibido'),
					'observaciones_r' => $this->input->post('observacionesr'),
					'usuario_recibe'=> $this->session->userdata('C_id_usuario'),
					'estado' => '2',
				);

				$query = $this->general_model->update('mantenimientos_programacion', 'id_solicitudm', $id_solicitud, $registro);

				$registro2 = array(
					'estado' => '3'
				);

				$query1 = $this->general_model->update('mantenimientos_solicitudes', 'id_solicitud', $id_solicitud, $registro2);

				if ($query1 == 'OK') {

					echo '1';
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch ($query) {
						case "1062":
							echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
							break;
						default:
							echo "Error: " . $query . " => " . $this->db->_error_message();
							break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function excel()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			$filename = "Reporte de Solicitudes.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$campos= 'd.id_solicitud AS "Id", m.nombre AS "matenimiento_requerido", s.nombre AS "servicio", d.ubicacion AS "ubicacion", IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS "solicitante", d.fecha_solicitud AS "Fecha Solicitud", d.fecha_gestion AS "Fecha Programada", DATEDIFF(mp.fecha_programacion_I,d.fecha_solicitud) AS "tiempo_solicitud_programacion", DATEDIFF(mp.fecha_ejecucion,d.fecha_solicitud) AS tiempo_programacion_ejecucion, CASE WHEN d.estado="0" THEN "Pendiente" WHEN d.estado ="1" THEN "Programada" WHEN d.estado="2" THEN "Ejecutada" WHEN d.estado="3" THEN "Recibida" ELSE "Rechazada" END AS "Estado"';

			$query = $this->general_model->consulta_personalizada($campos,'mantenimientos_solicitudes d LEFT JOIN mantenimientos_servicios m ON d.id_manterimientor = m.id_servicio LEFT JOIN servicios s ON d.id_servicio = s.id_servicio INNER JOIN empleados e ON d.id_solicitante = e.id_empleado LEFT JOIN mantenimientos_programacion mp ON mp.id_solicitudm = d.id_solicitud','','', 0, 0);


			echo utf8_decode('<table border="1"><tr><th colspan="10">REPORTE DE SOLICITUDES DE MANTENIMIENTO</th></tr></table><br>');
 
	        echo '<table border="1">';

          	echo '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
	        foreach ($query->list_fields() as $campo)
			{
			    echo utf8_decode('<th>'.($campo).'</th>');			    
			}
			
			echo '</tr></thead><tbody class="pos-rel">';
			foreach ($query->result_array() as $row)
	    	{
	    		echo utf8_decode('<tr class="d-style bgc-h-default-l4"><td>'.$row['Id'].'</td><td>'.$row['matenimiento_requerido'].'</td><td>'.$row['servicio'].'</td><td>'.$row['ubicacion'].'</td><td>'.$row['solicitante'].'</td<td>'.$row['Fecha Solicitud'].'</td><td>'.$row['Fecha Programada'].'</td><td>'.$row['tiempo_solicitud_programacion'].'</td><td>'.$row['tiempo_programacion_ejecucion'].'</td><td>'.$row['Estado'].'</td></td>');
	    	}
	    	echo '</tr></tbody></table><br>';	
		}
	}

	public function excel1()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			$filename = "Listado_Documentos.xls";
			header("Content-Disposition: attachment; filename=" . $filename);
			header("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

			echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL SOLICITUDES DE DOCUMENTOS</th></tr></table><br>');

			echo '<table border="1">';
			echo utf8_decode(listar_documentos_tabla('EXCEL'));
			echo '</table>';
		} //-Valida Inicio de Session
	}


	public function inactivar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$registro = array('estado' => '0');
				$query = $this->general_model->update('solicitud_documentos', 'id_solicitud', $this->input->post('idreg'), $registro);
				if ($query == "OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch ($query) {
						default:
							echo "Error: " . $query . " => " . $this->db->_error_message();
							break;
					}
					echo '</div>';
				}
			} //-Valida Envio por ajax
		} //-Valida Inicio de Session
	}

	public function cargar_correo_empleado()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {

				header('Content-Type: application/json');
				$idempleado = $this->input->post('idreg');

				$campos = 'IFNULL(CONCAT(e.nombres, " ", e.apellidos, " "),"") AS "Empleado", e.email AS "Correo"';
				$query = $this->general_model->consulta_personalizada($campos,'empleados','id_empleado ='.$idempleado.'', '', 0, 0);

				$row = $query->row_array();

				$arr['Solicitante'] = array('empleado'=>$row['Empleado'], 'correo'=>$row['correo']);
				echo json_encode( $arr );
			}
		}
	}

	public function ver_registro()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

				$campos = ' d.tipo_solicitud AS "Tipo", td.nombre AS "TipoDocumento", d.nombre_documento AS "Nombre", p.nombre AS "Proceso", IFNULL(CONCAT(e.nombres, " " e.apellidos, " "),"") AS "Responsable", d.fecha AS "Fecha_Solicitud" CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';

				$query = $this->general_model->consulta_personalizada($campos, 'solicitud_documentos d LEFT JOIN  procesos p ON d.id_proceso = p.id_proceso LEFT JOIN empleados e ON p.id_responsable = e.id_empleado LEFT JOIN tipos_documentos td ON td.id_tipo = d.id_tipo_documento', ' d.id_solicitud = "' . $idreg . '" ', '', 0, 0);

				$encabezado = array();
				$i = 0;
				foreach ($query->list_fields() as $campo) {
					$encabezado[$i] = $campo;
					$i++;
				}

				$tabla = '';
				$row = $query->row_array();

				for ($k = 0; $k < $i; $k++) {
					$tabla .= '
					<div class="row">' .
						form_label($encabezado[$k] . ': ', '', array('class' => 'control-label text-right col-md-4'))
						. '<div class="col-md-8 text-primary"><strong>' . $row[$encabezado[$k]] . '</strong></div>
		            </div>';
				}
				echo $tabla;
			}
		}
	}


	public function verificar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			$query = $this->general_model->select_where('id_revisado_por,id_aprabo_por, id_usuario,estado', 'solicitud_documentos', array('id_solicitud' => $id));
			$row = $query->row_array();

			$arr['solicitud'] = array('Revisa' => $row['id_revisado_por'], 'Aprueba' => $row['id_aprabo_por'], 'Usuario' => $row['id_usuario'], 'Estado' => $row['estado']);
			echo json_encode($arr);
		}
	}

	public function cargar_anexosM()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {

			$idreg = $this->input->post('idreg');

			$campos = ' id_anexo_mto AS "Id", ruta_archivo AS "archivo"';

			$query = $this->general_model->consulta_personalizada($campos, 'mantenimientos_anexos', ' id_solicitud = "' . $idreg . '" ', '', 0, 0);
			$tabla = '<div class="form-group row" id="anexos_solicitud">';

			foreach ($query->result_array() as $row)
    		{
				$tabla.= '<div class="col-md-3" id='.$row['Id'].'>';
				$tabla.= anchor(base_url().$row['archivo'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-red','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</div>';
			}
			$tabla .= '</div>';

			echo $tabla;
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
