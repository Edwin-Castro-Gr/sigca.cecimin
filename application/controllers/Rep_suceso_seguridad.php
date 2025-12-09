<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rep_suceso_seguridad extends CI_Controller
{

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Bogota');
	}

	public function index()
	{

		$this->session->sess_destroy();
		$this->load->view('suceso_seguridad/index');
	}

	//  Funcion formulario ---------------------------------------------------


	public function sucesos()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');
		
			$data_usua['titulo'] = "Sucesos de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'suceso_seguridad/sucesos';
			$data_usua['entrada_js'] = '_js/rep_suceso_seguridad.js';
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

		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>

		    <script src="_js/dom.js"></script>';

			$this->load->view('template', $data_usua);
		}
	}
	
	public function gestion($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');

			$data_usua['c_id_suceso'] = $id;
			$data_usua['c_cargo'] = '';
			$data_usua['c_servicio'] = '';
			$data_usua['c_paciente'] = '';
			$data_usua['c_identidad_paciente'] = '';
			$data_usua['c_novedad_asociada'] = '';
			$data_usua['c_descripcion_novedad'] = '';
			$data_usua['c_manejo_novedad'] = '';
			$data_usua['c_datos_medicamento'] = '';
			$data_usua['c_datos_dispositivos'] = '';
			$data_usua['c_fecha_registro'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_informo_jefe']='';

			$campos = 'CASE WHEN ss.cargo_reportante ="0" THEN "Enfermero Jefe" WHEN ss.cargo_reportante ="1" THEN "Auxiliar de Enfermería" WHEN ss.cargo_reportante ="2" THEN "Instrumentadora Quirúrgica" WHEN ss.cargo_reportante ="3" THEN "Médico Cirujano" WHEN ss.cargo_reportante ="5" THEN "Médico Anestesiólogo" WHEN ss.cargo_reportante ="6" THEN "Médico Institucional" WHEN ss.cargo_reportante ="7" THEN "Odontólogo" WHEN ss.cargo_reportante ="8" THEN "Auxiliar de Odontología" WHEN ss.cargo_reportante ="9" THEN "Fonoaudiólogo" WHEN ss.cargo_reportante ="10" THEN "Administrativo" WHEN ss.cargo_reportante ="11" THEN "Coordinador" ELSE "Otro" END "Cargo", s.nombre AS "Servicio", IF(ss.nombre_paciente = "0"," ", ss.nombre_paciente) AS "Paciente", IF(ss.numero_documento = "0"," ",ss.numero_documento) AS "Documento Paciente", CASE WHEN ss.novedad_asociada="1" THEN "Uso de Medicamentos" WHEN ss.novedad_asociada="2" THEN "Uso de Dispositivos/equipos biomedicos" WHEN ss.novedad_asociada ="3" THEN "Uso de Reactivos" WHEN ss.novedad_asociada="4" THEN "Uso de Tejidos" ELSE "Otros" END "Novedad Asociada", ss.descripcion_novedad AS "Descripción de la Novedad", ss.manejo_realizado AS "Manejo Realizado", IF(ss.novedad_asociada="1", IFNULL(CONCAT("Nombre Comercial: ",ss.nombre_medicamento, " Registro Sanitario: ", ss.registro_sanitario_medicamento, " Lote: ",ss.lote_medicamento, " Fecha Expiración",ss.fecha_vencimiento_medicamento),""), " ") AS "Datos Medicamentos", IF(ss.novedad_asociada="2", IFNULL(CONCAT("Nombre Comercial: ", ss.nombre_dispositivo , " Registro Sanitario: ", ss.registro_sanitario_dispositivo, " Lote: ",ss.lote_dispositivo, " Fabricante: ", ss.fabricante, "Distribuidor: ",ss.distribuidor, " Modelo: ", ss.modelo, " Serial: ", ss.serial, " Fecha Expiración",ss.registro_sanitario_dispositivo),""), " ") AS "Datos Dispositivo", ss.informo_jefe AS "Informo Jefe",ss.fecha_registro AS "Fecha",  CASE WHEN ss.estado ="0" THEN "Recibida" WHEN ss.estado ="1" THEN "En Gestión" WHEN ss.estado ="2" THEN "Gestionada" ELSE "Resuelta" END "Estado"';

			$query = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad ss INNER JOIN servicios s ON ss.servicio = s.id_servicio', 'ss.id_suceso_seguridad ="' . $id . '" ', '', 0, 0);

			foreach ($query->result_array() as $row) {

				$data_usua['c_cargo'] = $row['Cargo'];
				$data_usua['c_servicio'] = $row['Servicio'];
				$data_usua['c_paciente'] = $row['Paciente'];
				$data_usua['c_identidad_paciente'] = $row['Documento Paciente'];
				$data_usua['c_novedad_asociada'] = $row['Novedad Asociada'];
				$data_usua['c_descripcion_novedad'] = $row['Descripción de la Novedad'];
				$data_usua['c_manejo_novedad'] = $row['Manejo Realizado'];
				$data_usua['c_datos_medicamento'] =  $row['Datos Medicamentos'];
				$data_usua['c_datos_dispositivos'] =  $row['Datos Dispositivo'];
				$data_usua['c_informo_jefe']= $row['Informo Jefe'];

				$data_usua['c_fecha_registro'] =  $row['Fecha'];
				$data_usua['c_estado'] = $row['Estado'];

			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Gestión Sucesos de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'suceso_seguridad/gestion';
			$data_usua['entrada_js'] = '_js/rep_suceso_seguridad.js';
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
		    <script src="../_js/dom.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template', $data_usua);
		}
	}
	
	public function seguimiento($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');

			$data_usua['c_id_suceso'] = $id;
			$data_usua['c_cargo'] = '';
			$data_usua['c_servicio'] = '';
			$data_usua['c_paciente'] = '';
			$data_usua['c_identidad_paciente'] = '';
			$data_usua['c_novedad_asociada'] = '';
			$data_usua['c_descripcion_novedad'] = '';
			$data_usua['c_manejo_novedad'] = '';
			$data_usua['c_datos_medicamento'] = '';
			$data_usua['c_datos_dispositivos'] = '';
			$data_usua['c_fecha_registro'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_informo_jefe']='';

			$data_usua['c_clasificacion'] = '';
			$data_usua['c_fecha_analisis'] = '';
			$data_usua['c_investigacion'] = '';
			$data_usua['c_concluciones'] = '';
			$data_usua['c_acciones_inseguras'] = '';
			$data_usua['c_grado_lesion'] = '';
			$data_usua['c_gravedad_caso'] = '';
			$data_usua['c_origen_complicacion'] = '';
			$data_usua['c_fact_ambientales'] = '';
			$data_usua['c_fact_equipot'] = '';
			$data_usua['c_fact_individuo'] = '';
			$data_usua['c_fact_paciente'] = '';
			$data_usua['c_fact_Tecnologia'] = '';
			$data_usua['c_danos_paciente'] = '';
			$data_usua['c_prevenible']='';
			$data_usua['c_Usuario_analiza']= '';
			$data_usua['c_justificacion']= '';
			

			$data_usua['c_fechaA2']='';
			$data_usua['c_trazadores']='';
			$data_usua['c_relCuidado']='';
			$data_usua['c_RelMedicam']='';
			$data_usua['c_relIACS']='';
			$data_usua['c_RelprocInva']='';
			$data_usua['c_reldiagnosticos']='';
			$data_usua['c_relTecnov']='';
			$data_usua['c_relOtros']='';
			$data_usua['c_DanosP2']='';
			$data_usua['c_prevenible2']='';
			$data_usua['c_guias']='';
			$data_usua['c_enteControl']='';
			$data_usua['c_reporteCont']='';
			$data_usua['c_fechaRep']='';
			$data_usua['c_fechaComite']='';
			$data_usua['c_accionMejora']='';
			$data_usua['c_barrera']='';
			$data_usua['c_grupo']='';
			$data_usua['c_clasificacionF']='';
			$data_usua['c_fecha_registro'] =  '';
			$data_usua['c_Usuario_analiza']= '';
			$data_usua['c_estado'] = '';

			$campos = 'CASE WHEN ss.cargo_reportante ="0" THEN "Enfermero Jefe" WHEN ss.cargo_reportante ="1" THEN "Auxiliar de Enfermería" WHEN ss.cargo_reportante ="2" THEN "Instrumentadora Quirúrgica" WHEN ss.cargo_reportante ="3" THEN "Médico Cirujano" WHEN ss.cargo_reportante ="5" THEN "Médico Anestesiólogo" WHEN ss.cargo_reportante ="6" THEN "Médico Institucional" WHEN ss.cargo_reportante ="7" THEN "Odontólogo" WHEN ss.cargo_reportante ="8" THEN "Auxiliar de Odontología" WHEN ss.cargo_reportante ="9" THEN "Fonoaudiólogo" WHEN ss.cargo_reportante ="10" THEN "Administrativo" WHEN ss.cargo_reportante ="11" THEN "Coordinador" ELSE "Otro" END "Cargo", s.nombre AS "Servicio", IF(ss.nombre_paciente = "0"," ",ss.nombre_paciente) AS "Paciente", IF(ss.numero_documento ="0"," ",ss.numero_documento) AS "Documento Paciente", CASE WHEN ss.novedad_asociada="1" THEN "Uso de Medicamentos" WHEN ss.novedad_asociada="2" THEN "Uso de Dispositivos/equipos biomedicos" WHEN ss.novedad_asociada ="3" THEN "Uso de Reactivos" WHEN ss.novedad_asociada="4" THEN "Uso de Tejidos" ELSE "Otros" END "Novedad Asociada", ss.descripcion_novedad AS "Descripción de la Novedad", ss.manejo_realizado AS "Manejo Realizado", IF(ss.novedad_asociada="1", IFNULL(CONCAT("Nombre Comercial: ",ss.nombre_medicamento, " Registro Sanitario: ", ss.registro_sanitario_medicamento, " Lote: ",ss.lote_medicamento, " Fecha Expiración",ss.fecha_vencimiento_medicamento),""), " ") AS "Datos Medicamentos", IF(ss.novedad_asociada="2", IFNULL(CONCAT("Nombre Comercial: ", ss.nombre_dispositivo , " Registro Sanitario: ", ss.registro_sanitario_dispositivo, " Lote: ",ss.lote_dispositivo, " Fabricante: ", ss.fabricante, "Distribuidor: ",ss.distribuidor, " Modelo: ", ss.modelo, " Serial: ", ss.serial, " Fecha Expiración",ss.registro_sanitario_dispositivo),""), " ") AS "Datos Dispositivo", ss.informo_jefe AS "Informo Jefe", ssg.clasificacion_inicial AS "Clasificacion", ssg.investigacion AS "Investigacion" , ssg.conclusiones AS "Conclusiones", ssg.acciones_inseguras AS "AccionesI", ssg.grado_lesion AS "GradoL", ssg.gravedad_caso AS "GravedadC", ssg.origen_complicacion AS "OrigenC", ssg.faccont_ambiental AS "FacAmbientales", ssg.faccont_equipo AS "FacEquipo", ssg.faccont_individuo AS "FacIndividuo", ssg.faccont_paciente AS "FacPaciente", ssg.faccont_tecnologia AS "FacTecnologia",  ssg.produjo_danos AS "FacDaños", ssg.prevenible AS "Prevenible" , ssg.usuario_registra AS "UsuarioGestion", ssg.fecha_analisis AS "Fecha Analisis", ssg.trazadores AS "Trazadores",ssg.trazrelCuidado AS "Rel_Cuidado",ssg.trazRelMedicam AS "Rel_Medicamento",ssg.trazrelIACS AS "Rel_IACS",ssg.trazRelprocInva AS "Rel_Proc",ssg.trazreldiagnosticos AS "Rel_Diagnostico",ssg.trazrelTecnov AS "Rel_Tecno",ssg.trazrelOtros AS "Rel_Otro", ssg.justificacion_trazadores AS "JustificacionT",  ssg.guias AS "Guias", ssg.enteControl AS "EnteControl", ssg.reporteCont AS "ReporteCont", ssg.fechaRep AS "Fecha Reporte", ssg.fechaComite AS "Fecha Comite", ssg.accion_mejora AS "Accion Mejora", ssg.barrera AS "Barrera", ssg.grupo AS "GrupoA", ssg.clasificacion_final AS "ClasificacionF", ss.fecha_registro AS "Fecha Registo", ss.estado AS"Estado"';

			$query = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad ss INNER JOIN servicios s ON ss.servicio = s.id_servicio INNER JOIN suceso_seguridad_gestion ssg ON ss.id_suceso_seguridad = ssg.id_suceso_seguridad', 'ss.id_suceso_seguridad ="' . $id . '" ', '', 0, 0);

			foreach ($query->result_array() as $row) {
				//var_dump($row);
				$data_usua['c_cargo'] = $row['Cargo'];
				$data_usua['c_servicio'] = $row['Servicio'];
				$data_usua['c_paciente'] = $row['Paciente'];
				$data_usua['c_identidad_paciente'] = $row['Documento Paciente'];
				$data_usua['c_novedad_asociada'] = $row['Novedad Asociada'];
				$data_usua['c_descripcion_novedad'] = $row['Descripción de la Novedad'];
				$data_usua['c_manejo_novedad'] = $row['Manejo Realizado'];
				$data_usua['c_datos_medicamento'] =  $row['Datos Medicamentos'];
				$data_usua['c_datos_dispositivos'] =  $row['Datos Dispositivo'];
				$data_usua['c_informo_jefe']= $row['Informo Jefe'];


				$data_usua['c_clasificacion'] = $row['Clasificacion'];
				$data_usua['c_fecha_analisis'] = $row['Fecha Analisis'];
				$data_usua['c_investigacion'] = $row['Investigacion'];
				$data_usua['c_concluciones'] = $row['Conclusiones'];
				$data_usua['c_acciones_inseguras'] = $row['AccionesI'];

				$data_usua['c_grado_lesion'] = $row['GradoL'];
				$data_usua['c_gravedad_caso'] = $row['GravedadC'];
				$data_usua['c_origen_complicacion'] = $row['OrigenC'];

				$data_usua['c_fact_ambientales'] = $row['FacAmbientales'];
				$data_usua['c_fact_equipot'] = $row['FacEquipo'];
				$data_usua['c_fact_individuo'] = $row['FacIndividuo'];
				$data_usua['c_fact_paciente'] =  $row['FacPaciente'];
				$data_usua['c_fact_Tecnologia'] =  $row['FacTecnologia'];
				$data_usua['c_justificacion']=  $row['JustificacionT'];

				$data_usua['c_danos_paciente'] =  $row['FacDaños'];
				$data_usua['c_prevenible']= $row['Prevenible'];
				

				$data_usua['c_trazadores']=$row['Trazadores'];
				$data_usua['c_relCuidado']=$row['Rel_Cuidado'];
				$data_usua['c_RelMedicam']=$row['Rel_Medicamento'];
				$data_usua['c_relIACS']=$row['Rel_IACS'];
				$data_usua['c_RelprocInva']=$row['Rel_Proc'];
				$data_usua['c_reldiagnosticos']=$row['Rel_Diagnostico'];
				$data_usua['c_relTecnov']=$row['Rel_Tecno'];
				$data_usua['c_relOtros']=$row['Rel_Otro'];
				$data_usua['c_guias']=$row['Guias'];
				$data_usua['c_enteControl']=$row['EnteControl'];
				$data_usua['c_reporteCont']=$row['ReporteCont'];
				$data_usua['c_fechaRep']=$row['Fecha Reporte'];
				$data_usua['c_fechaComite']=$row['Fecha Comite'];
				$data_usua['c_accionMejora']=$row['Accion Mejora'];
				$data_usua['c_barrera']=  $row['Barrera'];
				$data_usua['c_grupo']=  $row['GrupoA'];
				$data_usua['c_clasificacionF']= $row['ClasificacionF'];
				$data_usua['c_fecha_registro'] =  $row['Fecha Registo'];
				$data_usua['c_Usuario_analiza']= $row['UsuarioGestion'];
				$data_usua['c_estado'] = $row['Estado'];

			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Seguimiento Sucesos de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'suceso_seguridad/seguimiento';
			$data_usua['entrada_js'] = '_js/rep_suceso_seguridad.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">
			 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
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
		    <script src="../_js/dom.js"></script>';

			$this->load->view('template', $data_usua);
		}
	}

	public function guardar()
	{
		if (!$this->input->is_ajax_request()) {
			redirect();
		} else {
			$datos_session2 = array('C_basedatos' => 'u610593899_sigca');

			$this->session->set_userdata($datos_session2);

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . ';');

			$this->load->helper('email');

			$fecha = date('Y-m-d H:i:s');
			$id_empleado = 6;
			$empleado = "";
			$correo_empleado = "";
			$msg ='';


			$registro = array(
				// confirmado
				// campos autoincremental o id = no se ponen

				'cargo_reportante' => $this->input->post('txtcargoReportante'),
				'Otro_Cargo' => $this->input->post('txtotroCargo'), 
				'servicio' => $this->input->post('txtservicio'),
				'Otro_Servicio' => $this->input->post('txtotroServicio'),
				'nombre_paciente' => $this->input->post('txtnombrePaciente'),
				'numero_documento' => $this->input->post('txtnumeroDocumento'),
				'novedad_asociada' => $this->input->post('txtcausaNovedad'),
				'descripcion_novedad' => $this->input->post('txtdescripcionNovedad'),
				'manejo_realizado' => $this->input->post('txtmanejoRealizado'),
				'nombre_medicamento' => $this->input->post('txtdatosMedicamento'),
				'lote_medicamento' => $this->input->post('txtloteMedicamento'),
				'registro_sanitario_medicamento' => $this->input->post('txtregistroSanitario'),
				'fecha_vencimiento_medicamento' => $this->input->post('txtfechaVencimiento'),
				'nombre_dispositivo' => $this->input->post('txtdatosdispositivo'),
				'lote_dispositivo' => $this->input->post('txtlotedispositivo'),
				'referencia' => $this->input->post('txtnumReferencia'),
				'fabricante' => $this->input->post('txtfabricante'),
				'registro_sanitario_dispositivo' => $this->input->post('txtregistroSanitarioD'),
				'modelo' => $this->input->post('txtmodelo'),
				'serial' => $this->input->post('txtserial'),
				'distribuidor' => $this->input->post('txtdistibuidor'),
				'informo_jefe' => $this->input->post('txtinformoJ'),
				// Confirmado
								
				'fecha_registro' => $fecha,
				'estado' => '0'
			);

			$query = $this->general_model->insert('suceso_seguridad', $registro);


			//ENVIAR CORREO A CRISTINA
			if ($query >= 1) {

				$qradicado = $query;
				$correo_cc = '';
				// $campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario", email AS "Correo"';
				// $query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_jefe.'"', '', 0, 0);
				// foreach ($query12->result_array() as $row)
				// {
				// 	$coordinador = $row['Usuario'];
				// 	$correo_coord = $row['Correo'];
				// }

				// Datos del correo
				$correo_remitente ='admin@sigca.cecimin.com.co';
	            // $correo_usuario = 'calidad.cecimin@saludinteligente.com';

	            $correo_usuario = 'calidad.cecimin@saludinteligente.com';
	            $asunto = 'Notificación Reporte de Suceso de Seguiridad';
	            $mensaje = "<div><font size='3'>Señores,</font></div>\r\n";				
				$mensaje .= "<div><font size='3'>Coordinación de Calidad CECIMIN S.A.S</font></div>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<div><font size='3'>De manera atenta, se notifica que el dia de Hoy, se registro un reporte de Suceso de Seguiridad, bajo el radicado N° ".$qradicado."</font></div>\r\n";
				$mensaje .= "<br>\r\n";

				$mensaje .= "<br>\r\n";		
			    $mensaje .= "<br>\r\n";
			    $mensaje .= "<div><font size='3'>Agradeciendo la atención prestada,</font></div>\r\n";
			    $mensaje .= "<br>\r\n";		
			    $mensaje .= "<br>\r\n";
			    $mensaje .= "<div><font size='3'>Correo enviado automático abstenerse de contestar.,</font></div>\r\n";
			    $mensaje .= "<br>\r\n";		
			    $mensaje .= "<br>\r\n";
			    $mensaje .= "<div><font size='3'></font></div>\r\n";
			    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";					
				$mensaje .= "<br>\r\n";
				
	            // Archivos a adjuntar
	            $adjuntos = null;

	            // Enviar el correo utilizando el buzón de citas
	            if (enviar_correo($correo_usuario, $asunto, $mensaje, 'notificacion',  $correo_remitente, $adjuntos, $correo_cc)) {
	                echo "1";
	                $query = 1;
	            } else {
	                echo "0";
	                $msg = "El correo no pudo ser enviado.";
	                $query =-999;	
	            }
				
			} else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>' . $query . '¡Error!</strong><br>';
				switch ($query) {
					case "1062":
						echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
						break;
					case "-999":
						echo "Error:" . $msg . "; Por favor verifique los datos!";
						break;
					default:
						echo "Error: " . $query . " => " . $this->db->_error_message();
						break;
				}
				echo '</div>';
			}
		}
	}

	public function reportes()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');


			$this->load->helper('funciones_select');
			$data_usua['titulo'] = "Sucesos de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'suceso_seguridad/listado';
			$data_usua['entrada_js'] = '_js/rep_suceso_seguridad.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '"> ';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
    		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>
    		<!-- DataTables  -->
    		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>';

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
				$this->load->database();
				$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
				// $usuario_perfil = $this->session->userdata('C_perfil');
				$usuario = $this->session->userdata('C_id_usuario');

				$cargotxt ='';
				
				$tabla = '';

				$campos = ' "..", ss.id_suceso_seguridad AS "Id", IF(ss.servicio !="99",nombre ,ss.Otro_Servicio) AS "Servicio", ss.cargo_reportante AS "Cargo", ss.Otro_Cargo AS "OtroCargo", CASE WHEN ss.novedad_asociada ="1" THEN "Uso de Medicamentos" WHEN ss.novedad_asociada ="2" THEN "Uso de Dispositivos/equipos biomedicos" WHEN ss.novedad_asociada="3" THEN "Uso de Reactivos" WHEN ss.novedad_asociada ="4" THEN "Uso de Tejidos" ELSE "Otros" END "Novedad Asociada", ss.fecha_registro AS "Fecha", CASE WHEN ss.estado ="3" THEN "Cerrada" WHEN ss.estado ="2" THEN "En seguimiento" WHEN ss.estado ="1" THEN "Analizada" ELSE "Recibida" END "Estado"';

				$campos .= ', "" AS "Acción" ';
				$query = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad ss INNER JOIN servicios s ON ss.servicio = s.id_servicio', '', 'ss.fecha_registro desc', 0, 0);

				$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
				foreach ($query->list_fields() as $campo) {
					if ($campo != ".." && $campo != "Acción" && $campo != "OtroCargo")
						$tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">' . ($campo) . '</th>';
					else if ($campo != "OtroCargo")
						$tabla .= '<th>' . ($campo) . '</th>';
				}
				$tabla .= '</tr></thead><tbody class="pos-rel">';
				//$tabla = '<tbody class="mt-1">';

				foreach ($query->result_array() as $row) {
					if ($row['Estado'] == "Recibida")
						$estado = '<span class="badge badge-sm bgc-yellow-d1 text-white pb-1 px-25">Recibida</span>';
					elseif ($row['Estado'] == "Analizada")
						$estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">Analizada</span>';
					elseif ($row['Estado'] == "En seguimiento")
						$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">En seguimiento</span>';					
					elseif ($row['Estado'] == "Cerrada")
						$estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-20">Cerrada</span>';


					switch ($row['Cargo']) {
					    case '0':
					        $cargotxt = 'Enfermero Jefe';
					        break;
					    case '1':
					        $cargotxt = 'Auxiliar de Enfermería';
					        break;
					    case '2':
					        $cargotxt = 'Instrumentadora Quirúrgica';
					        break;
					    case '3':
					        $cargotxt = 'Médico Cirujano';
					        break;
					    case '5':
					        $cargotxt = 'Médico Anestesiólogo';
					        break;
					    case '6':
					        $cargotxt = 'Médico Institucional';
					        break;
					    case '7':
					        $cargotxt = 'Odontólogo';
					        break;
					    case '8':
					        $cargotxt = 'Auxiliar de Odontología';
					        break;
					    case '9':
					        $cargotxt = 'Fonoaudiólogo';
					        break;
					    case '10':
					        $cargotxt = 'Administrativo';
					        break;
					    case '11':
					        $cargotxt = 'Coordinador';
					        break;
					    case '12':
					        $cargotxt = $row['OtroCargo'];
					        break;
					    default:
					        $cargotxt = 'Código no válido';
					        break;
					}

					$tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>' . $row['Id'] . '</td><td>' . $row['Servicio'] . '</td><td>' . $cargotxt . '</td><td>' . $row['Novedad Asociada'] . '</td><td>' . $row['Fecha'] .'</td><td>' . $estado . '</td>';

					$tabla .= '<td class="text-nowrap"><div class="action-buttons">';

					if($row['Estado'] == "Recibida"){
						$tabla .= '<a href="#" class="text-success mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '" id="btngestionar_' . $row['Id'] . '"> <i  id="btngestionar_' . $row['Id'] . '" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_' . $row['Id'] . '" name="nombre_' . $row['Id'] . '" value="' . $row['Novedad Asociada'] . '" /> </i> </a> 

						<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Seguimiento" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-file-signature text-105"> </i> </a>

						<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa  fa-search-plus text-105"> </i> </a>
						</div></td>';

					}elseif($row['Estado'] == "Analizada"){

						$tabla .= '
			          	   	<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '"><i class="fa fa-pencil-alt text-105"> </i></a>

			          	  	<a href="#" class="text-yelow mx-1" data-toggle="tooltip" data-original-title="Seguimiento" aria-describedby="tooltip'.$row['Id'].'" id="btnseguimiento_'.$row['Id'].'"> <i  id="btnseguimiento_'.$row['Id'].'" class="fa fa-file-signature text-105"></i> </a> 

			          		<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa  fa-search-plus text-105"> </i> </a>
			          	</div></td>';

					}elseif($row['Estado'] == "En seguimiento"){

						$tabla .= '
			          	   	<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '"><i class="fa fa-pencil-alt text-105"> </i></a>

			          	  	<a href="#" class="text-yelow mx-1" data-toggle="tooltip" data-original-title="Seguimiento" aria-describedby="tooltip'.$row['Id'].'" id="btnseguimiento_'.$row['Id'].'"> <i  id="btnseguimiento_'.$row['Id'].'" class="fa fa-file-signature text-105"></i> </a> 

			          		<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip' . $row['Id'] . '" id="btndetalle_' . $row['Id'] . '"> <i  id="btndetalle_' . $row['Id'] . '" class="fa fa-search-plus text-105"></i> </a>
			          	</div></td>';

					}else{

						$tabla .= '
			          	   	<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '"><i class="fa fa-pencil-alt text-105"> </i></a>

			          	  	<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Seguimiento" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-file-signature text-105"> </i> </a>


			          		<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip' . $row['Id'] . '" id="btndetalle_' . $row['Id'] . '"> <i  id="btndetalle_' . $row['Id'] . '" class="fa fa-search-plus text-105"></i> </a>
			          	</div></td>';
					}
					

					$tabla .= '</tr>';
				}
				$tabla .= '</tbody>';

				echo $tabla;
			}
		}
	}

	public function listar_acciones()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->database();
				$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');

				$idreg = $this->input->post('idsuceso');
								
				$campos1 = 'CASE WHEN pm.tipo_mejora = "1" THEN "Acción correctiva" WHEN pm.tipo_mejora = "2" THEN "Acción Preventiva" WHEN pm.tipo_mejora = "3" THEN "Oportunidad de mejora" END AS "Tipo de Acción", pm.accion_mejora AS "Acción Mejora", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Responsable", DATE(pm.fechamaxeje)AS "Fecha Ejecución", CASE WHEN pm.estado="0" THEN "Pendiente" WHEN pm.estado="1" THEN "En Gestión" WHEN pm.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';
				
				$query = $this->general_model->consulta_personalizada($campos1, 'planes_mejoras pm INNER JOIN empleados em ON pm.responsable = em.id_empleado', ' tipo_fuente = "2" AND id_fuente='.$idreg.'', 0, 0);
				$tabla = '';
				$i=0;
				foreach ($query->result_array() as $row)
    			{
    				$i++;
					$tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$i.'</td><td>'.$row['Tipo de Acción'].'</td><td>'.$row['Acción Mejora'].'</td><td>'.$row['Responsable'].'</td><td>'.$row['Fecha Ejecución'].'</td><td>'.$row['Estado'].'</td>';
				$tabla .= '</tr>';        
    			}
    			echo $tabla;
			}					
		}				
	}

	public function excel($fecha)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
			// $fecha =$this->input->get('fecha');
			$idfecha = explode('-', $fecha);
			// var_dump($idfecha);
			$tabla = '';
			$count = 0;
			$radicado = "00";
			$campos = 'CASE WHEN ss.cargo_reportante ="0" THEN "Enfermero Jefe" 
				    WHEN ss.cargo_reportante ="1" THEN "Auxiliar de Enfermería" 
				    WHEN ss.cargo_reportante ="2" THEN "Instrumentadora Quirúrgica" 
				    WHEN ss.cargo_reportante ="3" THEN "Médico Cirujano" 
				    WHEN ss.cargo_reportante ="5" THEN "Médico Anestesiólogo" 
				    WHEN ss.cargo_reportante ="6" THEN "Médico Institucional" 
				    WHEN ss.cargo_reportante ="7" THEN "Odontólogo" 
				    WHEN ss.cargo_reportante ="8" THEN "Auxiliar de Odontología" 
				    WHEN ss.cargo_reportante ="9" THEN "Fonoaudiólogo" 
				    WHEN ss.cargo_reportante ="10" THEN "Coordinador" 
				    WHEN ss.cargo_reportante ="11" THEN "Administrativo" 
				    ELSE IFNULL(ss.Otro_Cargo, "Otro") END AS "Cargo Reportante", 
				    DATE(ss.fecha_registro) AS "Fecha de la Novedad", 
				    IF(s.nombre ="Otros",ss.Otro_Servicio,s.nombre) AS "Servicio",
				    ss.nombre_paciente AS "Nombre del Paciente", ss.numero_documento AS "Identificación Paciente", 
				    CASE WHEN ss.novedad_asociada="1" THEN "Uso de Medicamentos" 
				    WHEN ss.novedad_asociada="2" THEN "Uso de Dispositivos/equipos biomedicos" 
				    WHEN ss.novedad_asociada ="3" THEN "Uso de Reactivos" 
				    WHEN ss.novedad_asociada="4" THEN "Uso de Tejidos" ELSE "Otros" END "Novedad Asociada", 
				    ss.descripcion_novedad AS "Descripción de la Novedad", ss.manejo_realizado AS "Manejo Realizado",    
				    IF(ss.informo_jefe ="1","SI","NO") AS "Informo Jefe",
				    IF(ss.novedad_asociada="1", IFNULL(CONCAT("Nombre Comercial: ",ss.nombre_medicamento, " Registro Sanitario: ", ss.registro_sanitario_medicamento, " Lote: ",ss.lote_medicamento, " Fecha Expiración",ss.fecha_vencimiento_medicamento),""), " ") AS "Datos Medicamentos", 
				    IF(ss.novedad_asociada="2", IFNULL(CONCAT("Nombre Comercial: ", ss.nombre_dispositivo , " Registro Sanitario: ", ss.registro_sanitario_dispositivo, " Lote: ",ss.lote_dispositivo, " Fabricante: ", ss.fabricante, "Distribuidor: ",ss.distribuidor, " Modelo: ", ss.modelo, " Serial: ", ss.serial, " Fecha Expiración",ss.registro_sanitario_dispositivo),""), " ") AS "Datos Dispositivo", 
				    ss.id_suceso_seguridad AS "Caso N°", YEAR(ss.fecha_registro) AS "Año", MONTH(ss.fecha_registro) AS "Mes",
				    CASE WHEN ssg.clasificacion_inicial = "1" THEN "Incidente" WHEN ssg.clasificacion_inicial = "2" THEN "Complicación"
				    WHEN ssg.clasificacion_inicial = "3" THEN "Evento Adverso" WHEN ssg.clasificacion_inicial = "4" THEN "No E-I-NI-C" 
				    WHEN ssg.clasificacion_inicial = "5" THEN "Repetido" WHEN ssg.clasificacion_inicial = "6" THEN "Infección Asociada al Cuidado de la Salud" END AS "Clasificación Inicial",     
				    CASE WHEN ssg.grado_lesion="1" THEN "Leve" 
				    WHEN ssg.grado_lesion="2" THEN "Moderada" 
				    WHEN ssg.grado_lesion="3" THEN "Severa" ELSE " " END AS "Grado Lesión", 
				    CASE WHEN ssg.gravedad_caso ="1" THEN "Leve" 
				    WHEN ssg.gravedad_caso ="2" THEN "Severa" 
				    WHEN ssg.gravedad_caso ="3" THEN "Moderada"  ELSE " " END AS "Gravedad del Caso", 
				    IF(ssg.prevenible ="1","Prevenible","No Prevenible") AS "El Suceso era Prevenible", 
				    CASE WHEN ssg.origen_complicacion ="1" THEN "Quirúrgica"
				    WHEN ssg.origen_complicacion ="2" THEN "Anestésica"
				    WHEN ssg.origen_complicacion ="3" THEN "Otra" ELSE "No Aplica"
				    END AS "Origen Complicación", 
				    ssg.fecha_analisis AS "Fecha_Analisis", ssg.investigacion AS "Investigación" ,
				    ssg.conclusiones AS "Conclusiones", ssg.acciones_inseguras AS "Acciones Inmediatas",  
				    ssg.faccont_ambiental AS "FacAmbientales", ssg.faccont_equipo AS "FacEquipo", 
				    ssg.faccont_individuo AS "FacIndividuo", ssg.faccont_paciente AS "FacPaciente", 
				    ssg.faccont_tecnologia AS "FacTecnologia", ssg.justificacion_trazadores AS "JustificacionF", 
				    
				    ssg.trazrelCuidado AS "Rel_Cuidado", ssg.trazRelMedicam AS "Rel_Medicamento",
				    ssg.trazrelTecnov AS "Rel_Tecno", ssg.trazrelIACS AS "Rel_IACS",
				    ssg.trazRelprocInva AS "Rel_Proc", ssg.trazreldiagnosticos AS "Rel_Diagnostico",
				    ssg.trazrelOtros AS "Rel_Otro", IF(ssg.produjo_danos = "1","Si", "No") AS "Produjo Daños", 
				    IF(ssg.enteControl ="1","SI","NO")  AS "EnteControl",
				    CASE WHEN ssg.reporteCont ="1" THEN "Farmacovigilancia" WHEN ssg.reporteCont ="2" THEN "Tecnovigilancia" 
				    WHEN ssg.reporteCont ="3" THEN "Reactovigilancia" ELSE " " END AS "ReporteCont", 
				    
				    ssg.fechaRep AS "Fecha_Reporte", ssg.fechaComite AS "Fecha_Comite", 
				    IF(ssg.accion_mejora = "1", "Si", "No") AS "Accion_Mejora", IFNULL(pm.accion_mejora, "") AS "Desc Acción", 
				    IFNULL(CONCAT(em.nombres," ",em.apellidos)," ") AS "Reponsable Accion",IFNULL(pm.fechamaxeje, "") AS "Fecha Acción", 
				    ssg.barrera AS "Barrera", ssg.grupo AS "GrupoA",
				    CASE WHEN ssg.clasificacion_final = "1" THEN "Incidente" WHEN ssg.clasificacion_final = "2" THEN "Complicación"
				    WHEN ssg.clasificacion_final = "3" THEN "Evento Adverso" WHEN ssg.clasificacion_final = "4" THEN "No E-I-NI-C" 
				    WHEN ssg.clasificacion_final = "5" THEN "Repetido" WHEN ssg.clasificacion_final = "6" THEN "Infección Asociada al Cuidado de la Salud" END AS "Clasificacion Final"';

			$query = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad ss INNER JOIN servicios s ON ss.servicio = s.id_servicio INNER JOIN suceso_seguridad_gestion ssg ON ss.id_suceso_seguridad = ssg.id_suceso_seguridad LEFT JOIN planes_mejoras pm ON ss.id_suceso_seguridad = pm.id_fuente and pm.tipo_fuente="2" LEFT JOIN empleados em ON pm.responsable = em.id_empleado', 'YEAR(ss.fecha_registro)="' . $idfecha[0] . '" AND MONTH(ss.fecha_registro) = "' . $idfecha[1] . '"', 'ss.fecha_registro', 0, 0);


			$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			$td = '<tr class="d-style bgc-h-default-l4">';
			foreach ($query->list_fields() as $campo) {
				$tabla .= '<th>' . ($campo) . '</th>';
			}
			$tabla .= '</tr></thead><tbody class="pos-rel">';

			foreach ($query->result_array() as $row1) {
				$radicado = "00" . $row1['Caso N°'];

				$FacAmbientales = '';
				switch($row1['FacAmbientales']){ 
				    case '1' : $FacAmbientales = 'Personal suficiente'; 
				    	break;
				    case '2' : $FacAmbientales = 'Mezcla de habilidades'; 
				    	break;
				    case '3' : $FacAmbientales = 'Carga de Trabajo ';
				    	break;
				    case '4' : $FacAmbientales = 'Patrón de turnos';
				    	break;
				    case '5' : $FacAmbientales = 'Diseño';
				    	break;
				    case '6' : $FacAmbientales = 'Disponibilidad y mantenimiento de equipos';
				    	break;
				    case '7' : $FacAmbientales = 'Soporte administrativo y gerencial';
				    	break;
				    case '8' : $FacAmbientales = 'Clima Laboral';
				    	break;
				    case '9' : $FacAmbientales = 'Ambiente físico (luz, espacio, ruido)';
				    	break;
				    default : $FacAmbientales = 'No Aplica';
				        break;	
				}; 
				$FacEquipo = '';
				switch($row1['FacEquipo']){ 
				    
				    case '1': $FacEquipo = 'Comunicación verbal y escrita '; 
				    case '2': $FacEquipo = 'Supervisión y disponibilidad de soporte';
				    	break;
					default : $FacEquipo = 'No Aplica';
				        break;
				};

				 $FacIndividuo = '';
				switch($row1['FacIndividuo']){

				    case '1' : $FacIndividuo = 'Conocimiento';
				    case '2' : $FacIndividuo = 'Habilidades y competencia'; 
				    case '3' : $FacIndividuo = 'Salud Física y Mental';
				    	break;
					default : $FacIndividuo = 'No Aplica';
				        break;
				};

				$FacPaciente = '';
				switch($row1['FacPaciente']){

				    case '1' : $FacPaciente = 'Complejidad y Gravedad';
				    case '2' : $FacPaciente = 'Lenguaje y Comunicación'; 
				    case '3' : $FacPaciente = 'Personalidad y Factores Sociales';
				    	break;
					default : $FacPaciente = 'No Aplica';
				        break;
				};

				$FacTecnologia = '';
				switch($row1['FacTecnologia']){ 
				           
				  
				    case '1' : $FacTecnologia = 'Diseño de la tarea y claridad de la estructura'; 
				    case '2' : $FacTecnologia = 'Disponibilidad y uso de protocolos'; 
				    case '3' : $FacTecnologia = 'Disponibilidad y confiabilidad de las pruebas diagnósticas';
				    case '4' : $FacTecnologia = 'Ayudas para toma de decisiones';
				    	break;
					default : $FacTecnologia = 'No Aplica';
				        break;
				};

				$Rel_Cuidado = '';
				switch ($row1['Rel_Cuidado']) {
				    case '1': $Rel_Cuidado = 'Paciente con úlcera por presión';
				        break;
				    case '2': $Rel_Cuidado = 'Paciente con paro cardiaco o respiratorio';
				        break;
				    case '3': $Rel_Cuidado = 'Caída intrainstitucional';
				        break;
				    case '4': $Rel_Cuidado = 'Traslado de paciente';
				        break;
				    case '5': $Rel_Cuidado = 'Paciente con broncoaspiración intrainstitucional';
				        break;
				    case '6': $Rel_Cuidado = 'Paciente con TEP o TVP';
				        break;
				    default: $Rel_Cuidado = 'No aplica para este Grupo';
				        break;
				};

				$Rel_Medicamento = '';
				switch ($row1['Rel_Medicamento']) {
				    case '1': $Rel_Medicamento = 'Reacción adversa a medicamentos';
				        break;
				    case '2': $Rel_Medicamento = 'Sospecha de falla terapéutica';
				        break;
				    case '3': $Rel_Medicamento = 'Problemas relacionados al uso de medicamento: Prescripción';
				        break;
				    case '4': $Rel_Medicamento = 'Problemas relacionados al uso de medicamento: Dispensación';
				        break;
				    case '5': $Rel_Medicamento = 'Problemas relacionados al uso de Medicamentos: Administración';
				        break;
				    case '6': $Rel_Medicamento = 'Problemas relacionados al uso de medicamentos: Monitorización y/o seguimiento';
				        break;
				    default:  $Rel_Medicamento = 'No aplica para este Grupo';
				        break;
				};

				// Switch case para $optrelIACS
				$Rel_IACS = '';
				switch ($row1['Rel_IACS']) {
				    case '1': $Rel_IACS = 'Infección de sitio quirúrgico';
				        break;
				    case '2': $Rel_IACS = 'Infección del torrente sanguíneo asociado a catéter central o subcutáneo';
				        break ;
				    case '3': $Rel_IACS = 'Infección arterial o venosa';
				        break;
				    default: $Rel_IACS = 'No aplica para este grupo';
				        break;
				};

				// Switch case para $optRelprocInva
				$Rel_Proc = '';
				switch ($row1['Rel_Proc']) {
				    case '1': $Rel_Proc = 'Cancelación de cirugías o procedimientos atribuida a la organización';
				        break;
				    case '2': $Rel_Proc = 'Cirugía o procedimiento en parte equivocada o en paciente equivocado';
				        break;
				    case '3': $Rel_Proc = 'Retención de cuerpos extraños en POP';
				        break;
				    case '4': $Rel_Proc = 'Paciente con Reintervención';
				        break;
				    case '5': $Rel_Proc = 'Lesión iatrogénica peri operatoria o intraprocedimiento';
				        break;
				    case '6': $Rel_Proc = 'Demora en inicio de cirugía y/o procedimiento';
				        break;
				    case '7': $Rel_Proc = 'Lesiones asociadas a la venopunción';
				        break;
				    default: $Rel_Proc = 'No aplica para este grupo';
				        break;
				};

				// Switch case para $optreldiagnosticos
				$Rel_Diagnostico = '';
				switch ($row1['Rel_Diagnostico']) {
				    case '1': $Rel_Diagnostico = 'Entrega intercambio de reportes';
				        break;
				    case '2': $Rel_Diagnostico = 'Relacionados con la recolección, transporte y/o manejo de muestras';
				        break;
				    case '3': $Rel_Diagnostico = 'Entrega e resultados o informes errados que generan conductas terapéuticas inadecuadas';
				        break;
				    case '4': $Rel_Diagnostico = 'Déficit de examen físico o interpretación de pruebas diagnosticas';
				        break;
				    case '5': $Rel_Diagnostico = 'Relacionado con la gestión de valor critico';
				        break;
				    default: $Rel_Diagnostico = 'No aplica para este grupo';
				        break;
				};

				$Rel_Tecno = '';
				switch ($row1['Rel_Tecno']) {
				    case '1': $Rel_Tecno = 'Relacionados al Uso del Dispositivo Médico';
				        break;
				    case '2': $Rel_Tecno = 'Reacción alérgica a dispositivo médico';
				        break;
				    case '3': $Rel_Tecno = 'Relacionados a la calidad del dispositivo Médico';
				        break;
				    case '4': $Rel_Tecno = 'Relacionado al mantenimiento o logística de Equipo Biomedico';
				        break;
				    case '5': $Rel_Tecno = 'Relacionado al funcionamiento del Equipo Biomedico';
				        break;
				    default: $Rel_Tecno = 'No aplica para este grupo';
				        break;
				};

				// Switch case para $optrelOtros
				$Rel_Otro = '';
				switch ( $row1['Rel_Otro']) {
				    case '1': $Rel_Otro = 'Relacionados con equipos de apoyo o infraestructura';
				        break;
				    case '2': $Rel_Otro = 'Reingreso por posible falla en la atención antes de 30 días';
				        break;
				    case '3': $Rel_Otro = 'Identificación del paciente errado o incompleto';
				        break;
				    case '4': $Rel_Otro = 'Relacionados con historia clínicas o tecnología informática';
				        break;
				    case '5': $Rel_Otro = 'Relacionados con trámites administrativos que afectan la seguridad asistencial';
				        break;
				    case '6': $Rel_Otro = 'Relacionado con reactivovigilancia';
				        break;
				    case '7': $Rel_Otro = 'La causa no se encuentra en ninguno de los grupos';
				        break;
				    default: $Rel_Otro = 'No aplica a este grupo';
				        break;
				};

				$tabla .= '<tr><td>' . $row1['Cargo Reportante'] . '</td> <td>' . $row1['Fecha de la Novedad'] . '</td> <td>' . $row1['Servicio'] . '</td><td>' . $row1['Nombre del Paciente'] . '</td><td>' . $row1['Identificación Paciente'] . '</td><td>' . $row1['Novedad Asociada'] . '</td><td>' . $row1['Descripción de la Novedad'] . '</td><td>' . $row1['Manejo Realizado'] . '</td><td>' . $row1['Informo Jefe'] . '</td><td>' . $row1['Datos Medicamentos'] . '</td> <td>' . $row1['Datos Dispositivo'] . '</td><td>' . $radicado . '</td> <td>' . $row1['Año'] . '</td> <td>' . $row1['Mes'] . '</td><td>' . $row1['Clasificación Inicial'] . '</td>
					<td>' . $row1['Gravedad del Caso'] . '</td> <td>' . $row1['Grado Lesión'] . '</td>
					<td>' . $row1['El Suceso era Prevenible'] . '</td> <td>' . $row1['Origen Complicación'] . '</td>
					<td>' . $row1['Fecha_Analisis'] . '</td> <td>' . $row1['Investigación'] . '</td>
					<td>' . $row1['Conclusiones'] . '</td> 	<td>' . $row1['Acciones Inmediatas'] . '</td>
					<td>' . $FacAmbientales. '</td> <td>' . $FacEquipo . '</td><td>' . $FacIndividuo . '</td>
					<td>' .$FacPaciente. '</td> <td>' . $FacTecnologia . '</td><td>' . $row1['JustificacionF'] . '</td>
					<td>' . $Rel_Cuidado . '</td> <td>' . $Rel_Medicamento . '</td><td>' .$Rel_Tecno. '</td> 
					<td>' .$Rel_IACS. '</td><td>' . $Rel_Proc . '</td> <td>' . $Rel_Diagnostico. '</td>
					<td>' . $Rel_Otro . '</td> <td>' . $row1['Produjo Daños'] . '</td><td>' . $row1['EnteControl'] . '</td> <td>' . $row1['ReporteCont'] . '</td><td>' . $row1['Fecha_Reporte'] . '</td> <td>' . $row1['Fecha_Comite'] . '</td>
					<td>' . $row1['Accion_Mejora'] . '</td> <td>' . $row1['Desc Acción'] . '</td>
					<td>' . $row1['Reponsable Accion'] . '</td> <td>' . $row1['Fecha Acción'] . '</td>
					<td>' . $row1['Barrera'] . '</td> <td>' . $row1['GrupoA'] . '</td>
					<td>' . $row1['Clasificacion Final'] . '</td> 

					</tr>';
			}

			$tabla .= '</tbody>';
			
			$usuario = $this->session->userdata('C_id_usuario');

			$filename = "Listado_de_Sucesos_de_Seguridad.xls";
			header("Content-Disposition: attachment; filename=" . $filename);
			header("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

			echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL SUCESOS DE SEGURIDAD</th></tr></table><br>');

			echo '<table border="1">';
			echo utf8_decode($tabla);
			echo '</table>';


		}
	}

	public function guardar_gestion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
			$this->load->helper('email');

			$fecha = date('Y-m-d H:i:s');
			$id_suceso = $this->input->post('idregistro');
			
			$registro1 = array(
				'usuario_modifica' => $this->input->post('C_id_usuario'),
				'fecha_modificacion' => $fecha,
				'estado' => '1'
			);

			$query1 = $this->general_model->update('suceso_seguridad', 'id_suceso_seguridad', $id_suceso, $registro1);

			$trazadores = $this->input->post('trazadores');
			$val_trazadores = implode(',', (array) $trazadores);

			$registro = array(
				'id_suceso_seguridad' =>$id_suceso,
				'clasificacion_inicial' => $this->input->post('clasificacionI'),
				'fecha_analisis' => $this->input->post('fechaA'),
				'investigacion' => $this->input->post('investigacion'),
				'conclusiones' => $this->input->post('conclusiones'),
				'acciones_inseguras' => $this->input->post('accionesI'),
				'grado_lesion'=> $this->input->post('glesion'),
				'gravedad_caso' => $this->input->post('gcaso'),
				'origen_complicacion' => $this->input->post('ocomplicacion'),
				'faccont_ambiental' => $this->input->post('facContAmb'),
				'faccont_equipo' => $this->input->post('facContEqui'),
				'faccont_individuo' => $this->input->post('facContInd'),
				'faccont_paciente' => $this->input->post('facConPac'),
				'faccont_tecnologia' => $this->input->post('facContTec'),
				'justificacion_trazadores' => $this->input->post('justificacionfc'),
				'produjo_danos' => $this->input->post('DanosP'),
				'prevenible' => $this->input->post('prevenible'),				
				'trazadores' => $val_trazadores,
				'trazrelCuidado' => $this->input->post('relCuidado'),
				'trazRelMedicam' => $this->input->post('RelMedicam'),
				'trazrelIACS' => $this->input->post('relIACS'),
				'trazRelprocInva' => $this->input->post('RelprocInva'),
				'trazreldiagnosticos' => $this->input->post('reldiagnosticos'),
				'trazrelTecnov' => $this->input->post('relTecnov'),
				'trazrelOtros' => $this->input->post('relOtros'),
				'guias' => $this->input->post('guias'),
				'enteControl' => $this->input->post('enteControl'),
				'reporteCont' => $this->input->post('reporteCont'),
				'fechaRep' => $this->input->post('fechaRep'),
				'fechaComite' => $this->input->post('fechaComite'),
				'accion_mejora' =>$this->input->post('accionMejora'),
				'barrera'=>$this->input->post('barrera'),
				'grupo'=>$this->input->post('grupoRa'),
				'clasificacion_final'=>$this->input->post('clasificacionF'),
				'usuario_registra' => $this->session->userdata('C_id_usuario'),
				'fecha_registro' => date('Y-m-d H:i:s')
			);
			
			$query = $this->general_model->insert('suceso_seguridad_gestion', $registro);
			
			$accionSN = $this->input->post('accionMejora');
			if($accionSN == "1"){
				$cantAcciones = $this->input->post('cantAcciones');
				$i = 1;
				while ($i <= $cantAcciones){
						
					$registro=array(					
					
						'tipo_fuente' => '2',
						'id_fuente' => $id_suceso,
						'tipo_mejora' => $this->input->post('idtipo_accion'.$i.''),
						'accion_mejora' => $this->input->post('descripcion'.$i.''),
						'responsable' => $this->input->post('idcoordinador'.$i.''),
						'fechamaxeje' => $this->input->post('fechaAE'.$i.''),
						'fecha_registro' => date('Y-m-d H:i:s'),
						'usuario_registra' => $this->session->userdata('C_id_usuario'),
						'estado' => '0'
					);	

					$query = $this->general_model->insert('planes_mejoras', $registro);
					$responsable = $this->input->post('idcoordinador'.$i.'');
									
					$qradicado = $id_suceso;
					$idaccion = $query;
					
					$correo_cc = '';
					$coordinador = '';
					$correo_coord = '';
					$cargo_coord = '';

					$campos2='IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS "Usuario", e.email AS "Correo", c.nombre AS "Cargo"';
					$query12 = $this->general_model->consulta_personalizada($campos2,'empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo', 'e.id_empleado = "'.$responsable.'"', '', 0, 0);
					foreach ($query12->result_array() as $row)
					{
						$coordinador = $row['Usuario'];
						$correo_coord = $row['Correo'];
						$cargo_coord = $row['Cargo'];
					}

					// Datos del correo
					$correo_remitente ='calidad.cecimin@saludinteligente.com';
		            // $correo_usuario = 'calidad.cecimin@saludinteligente.com';

		            $correo_usuario = $correo_coord;
		            $asunto = 'Notificación de Acción de Mejora';
		            $mensaje = "<div><font size='3'>Doctor(a),</font></div>\r\n";				
					$mensaje .= "<div><font size='3'>".$coordinador."</font></div>\r\n";
					$mensaje .= "<div><font size='3'>".$cargo_coord."</font></div>\r\n";
					$mensaje .= "<div><font size='3'>CECIMIN S.A.S</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>De manera atenta, se notifica que el dia de Hoy, se registro una acción de mejora bajo el radicado N° ".$idaccion." cuya fuente es el Suceso de Seguiridad N° ".$qradicado."</font></div>\r\n";
					$mensaje .= "<br>\r\n";

					$mensaje .= "<br>\r\n";		
				    $mensaje .= "<br>\r\n";
				    $mensaje .= "<div><font size='3'>Agradeciendo la atención prestada,</font></div>\r\n";
				    $mensaje .= "<br>\r\n";		
				    $mensaje .= "<br>\r\n";
				    $mensaje .= "<div><font size='3'>Correo enviado automático abstenerse de contestar.</font></div>\r\n";
				    $mensaje .= "<br>\r\n";		
				    $mensaje .= "<br>\r\n";
				    $mensaje .= "<div><font size='3'></font></div>\r\n";
				    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";					
					$mensaje .= "<br>\r\n";
					
		            // Archivos a adjuntar
		            $adjuntos = null;

		            // Enviar el correo utilizando el buzón de citas
		            if (enviar_correo($correo_usuario, $asunto, $mensaje, 'notificacion',  $correo_remitente, $adjuntos, $correo_cc)) {
		                echo "1";
		                $query = 1;
		            } else {
		                echo "0";
		                $msg = "El correo no pudo ser enviado.";
		                $query =-999;	
		            }
		            $i++;	
				}
			}
				
			if($query >= 1){
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

	public function guardar_cierre()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
			$fecha = date('Y-m-d H:i:s');
			$id_suceso = $this->input->post('idregistro');
			

			$registro1 = array(
				'observaciones_cierre' => $this->input->post('C_id_usuario'),
				'usuario_cierre' => $this->input->post('C_id_usuario'),
				'estado' => $this->input->post('estado')
			);

			$query = $this->general_model->update('suceso_seguridad', 'id_suceso_seguridad', $id_suceso, $registro1);			

			if($query == "OK"){
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

	public function guardar_seguimiento()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
			$ckseguimiento = $this->input->post('ckseguimiento');
			$estado = $this->input->post('estado');

			$fecha = date('Y-m-d H:i:s');
			$id_suceso = $this->input->post('idregistro');
			$func_involucrado = $this->input->post('empleadosMR_sucesos');
			$val_involucrado = implode(',', (array) $func_involucrado);
			if($ckseguimiento == "1"){
				$registro1 = array(

					'id_suceso_seguridad' => $id_suceso,
					'fecha_seguimiento' => $fecha,
					'accion_efectiva' => $this->input->post('accionMejoraEfe'),
					'porque_respta' => $this->input->post('descripcioRespuesta'),
					'observaciones_seguimiento' => $this->input->post('observacionesS'),
					'cumplimento' => $this->input->post('cumplimiento'),
					'estado_caso' => $this->input->post('cerrado'),				
					'f_involucrado' => $val_involucrado
				);
					
				$query = $this->general_model->insert('suceso_seguridad_seguimiento', $registro1);
			}			

			$registro = array(			
				
				'estado' => $estado
			);

			$query = $this->general_model->update('suceso_seguridad', 'id_suceso_seguridad', $id_suceso, $registro);	

			if($query == "OK"){
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

	public function cargar_seguimiento()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else{
			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');

			$id = $this->input->post('idsuceso');

			$campos = 's.id_seguimiento AS "Id", s.fecha_seguimiento AS "Fecha", IF(s.accion_efectiva = "1", "Si", "No") AS "Acción Efectiva", s.porque_respta AS "Respuesta", s.observaciones_seguimiento AS "ObservacionesS", CASE WHEN s.cumplimento = "0" THEN "Completo" WHEN s.cumplimento = "1" THEN "No Iniciado" WHEN s.cumplimento = "2" THEN "Sin Analisis" WHEN s.cumplimento = "3" THEN "No dio lugar a acción" WHEN s.cumplimento = "4" THEN "Avanzado" WHEN s.cumplimento = "0" THEN "Iniciado" END  AS "Cumplimiento", IF(s.estado_caso = "1", "Si", "No") AS "Estado Caso", GROUP_CONCAT(CONCAT(e.nombres," ", e.apellidos) SEPARATOR ", ") AS "Funcionarios"'; 

			$query_seguimiento = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad_seguimiento s INNER JOIN empleados e ON FIND_IN_SET(e.id_empleado, REPLACE(s.f_involucrado, " ", " "))', 's.id_suceso_seguridad ="' . $id. '" GROUP BY 
            s.id_seguimiento;', '', 0, 0);
	        	
	   		$data_seguimiento = $query_seguimiento->result_array();
	        
	        $card = '';
	       
	    	foreach ($data_seguimiento as $row) 
	        {
	        	$card .= '<div class="form-group row" id="div_segimiento_'.$row['Id'].'">
                            <div class="col-12 col-sm-12 cards-container" id="card-container-5">
                              <div class="card dcard" id="card-5">
                                <div class="card-header">
                                  <h5 class="card-title text-120 text-primary-d2">
                                    Seguimiento del '.$row['Fecha'].'
                                  </h5>

                                  <div class="card-toolbar">        
                                    <div class="card-toolbar no-border">          
                                      <a href="#" data-action="toggle" class="card-toolbar-btn btn btn-sm radius-1 btn-outline-default mx-2px">
                                        <i class="fa fa-angle-double-up w-2 mx-1px"></i>
                                      </a>          
                                    </div>
                                  </div>
                                </div><!-- /.card-header -->

                                <div class="card-body p-0 collapse">
                                  <div class="form-group row border-0" id="div_seguimiento1">
                                    <span class="col-sm-3 text-sm-left pl-4 pr-1 mt-2">
                                      <strong> La Accion de Mejora fue Efectiva?</strong>  
                                    </span>
                                    <span class="col-sm-0.5 pl-1 mt-2">
                                      '.$row['Acción Efectiva'].'
                                    </span> 
                                  
                                    <span class="col-sm-3 text-sm-right pl-2 mt-2">
                                      <strong> Por qué su respuesta anterior? </strong>
                                    </span>
                                    <span class="col-sm-4 text-sm-left pl-2 mt-2">
                                      '.$row['Acción Efectiva'].'
                                    </span> 
                                  </div> 
                                  <div class="form-group row border-0" id="div_seguimiento2">
                                    <span class="col-sm-12 text-sm-center pr-1 mt-2">
                                      <strong> Observaciones del Seguimiento</strong>  
                                    </span>
                                    <span class="col-sm-12 pl-1 mt-2">
                                      <p class="text-sm-left pl-4 pr-1"> '.$row['ObservacionesS'].' </p>
                                    </span> 
                                  </div> 
                                  <div class="form-group row border-0" id="div_seguimiento3">
                                    <span class="col-sm-3 text-sm-left pl-4 mt-2">
                                      <strong> Estado de Cumplimiento</strong>
                                    </span>
                                    <span class="col-sm-3 text-sm-left pl-2 mt-2">
                                      '.$row['Cumplimiento'].'
                                    </span> 
                                    <span class="col-sm-3 text-sm-left pl-4 mt-2">
                                      <strong> El Caso esta cerrado</strong>
                                    </span>
                                    <span class="col-sm-.05 text-sm-left pl-2 mt-2">
                                      '.$row['Estado Caso'].'
                                    </span> 
                                  </div> 
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                    </div>';        
	    	}
	    	echo $card;
		}
	}
	

	private function addPdfHeader($pdf) {
	    $this->load->helper('funciones_pdf');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetTextColor(0, 0, 0); // Color negro

		// Primera línea: Código en la izquierda
		$pdf->SetFont('Arial', '', 8);
		$pdf->SetXY(160, 15);
		$pdf->Cell(20, 5, utf8_decode('Código:'), 1, 0, 'C');
		$pdf->Cell(0, 5, utf8_decode('CAS-PG-FO-11'), 1, 1, 'C');

		// Logo centrado - usando nuestra función personalizada
		cellWithImage($pdf, 'assets/image/logoCeciminActas.png', 55, 20, 15, 15, 0, 1);

		// Texto "SEGUIMIENTO A PACIENTES DE" en la derecha
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetXY(70, 15);
		
		$pdf->MultiCell(90, 10, utf8_decode('               REPORTE SUCESOS DE SEGURIDAD                           '), 1, 'C');	
		// Segunda línea: Versión a la izquierda
		
		$pdf->SetXY(160, 20);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(20, 5, utf8_decode('Versión:'), 1, 0, 'C');
		$pdf->Cell(0, 5, '2', 1, 1, 'C');

		// Texto "PROCEDIMIENTOS" en el centro
		// $pdf->SetXY(70, 30);
		// $pdf->SetFont('Arial', 'B', 10);
		// $pdf->Cell(90, 10, 'PROCEDIMIENTOS', 1, 0, 'C');

		// Vigencia a la derecha
		$pdf->SetXY(160, 25);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(20, 5, 'Vigencia:', 1, 0, 'C');
		$pdf->Cell(0, 5, '09/09/2025', 1, 1, 'C');


		// Tercera línea: Página en la esquina inferior derecha del encabezado
		$pdf->SetXY(160, 30);
		$pdf->Cell(20, 5, 'Pagina:', 1, 0, 'C');
		$pdf->Cell(0, 5, $pdf->PageNo().' de {nb}', 1, 1, 'C');

		// Línea separadora
		$pdf->Line(15, 40, 200, 40);

		// Espacio después del encabezado
		$pdf->SetY(45);
	}

	public function ver_registro($id_suceso) {
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {

			$this->load->database();
			$this->db->query('USE ' . $this->session->userdata('C_basedatos') . '; ');
		
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
		        $pdf->SetTitle("SIGCA - Reporte Sucesos de Seguridad", true);
		        $pdf->SetAutoPageBreak(true, 15);
	       		$pdf->SetMargins(15, 15, 15);
		         // === Página 1 ===
		        $pdf->AddPage('P', 'LETTER');
		         //Encabezado informe
		        $this->addPdfHeader($pdf);        
	       		
	       		$campos = 'DATE(ss.fecha_registro) AS "Fecha_suceso", CASE WHEN ss.cargo_reportante ="0" THEN "Enfermero Jefe" WHEN ss.cargo_reportante ="1" THEN "Auxiliar de Enfermería" WHEN ss.cargo_reportante ="2" THEN "Instrumentadora Quirúrgica" WHEN ss.cargo_reportante ="3" THEN "Médico Cirujano" WHEN ss.cargo_reportante ="5" THEN "Médico Anestesiólogo" WHEN ss.cargo_reportante ="6" THEN "Médico Institucional" WHEN ss.cargo_reportante ="7" THEN "Odontólogo" WHEN ss.cargo_reportante ="8" THEN "Auxiliar de Odontología" WHEN ss.cargo_reportante ="9" THEN "Administrativo" WHEN ss.cargo_reportante ="10" THEN "Coordinador" ELSE "Otro" END AS "Cargo", s.nombre AS "Servicio", ss.nombre_paciente AS "Paciente", ss.numero_documento AS "Documento_Paciente", CASE WHEN ss.novedad_asociada="1" THEN "Uso de Medicamentos" WHEN ss.novedad_asociada="2" THEN "Uso de Dispositivos/equipos biomedicos" WHEN ss.novedad_asociada ="3" THEN "Uso de Reactivos" WHEN ss.novedad_asociada="4" THEN "Uso de Tejidos" ELSE "Otros" END "Novedad_Asociada", ss.descripcion_novedad AS "Des_Novedad", ss.manejo_realizado AS "Manejo_Realizado", IF(ss.novedad_asociada="1", IFNULL(CONCAT("Nombre Comercial: ",ss.nombre_medicamento, " Registro Sanitario: ", ss.registro_sanitario_medicamento, " Lote: ",ss.lote_medicamento, " Fecha Expiración",ss.fecha_vencimiento_medicamento),""), " ") AS "Datos_Medicamentos", IF(ss.novedad_asociada="2", IFNULL(CONCAT("Nombre Comercial: ", ss.nombre_dispositivo , " Registro Sanitario: ", ss.registro_sanitario_dispositivo, " Lote: ",ss.lote_dispositivo, " Fabricante: ", ss.fabricante, "Distribuidor: ",ss.distribuidor, " Modelo: ", ss.modelo, " Serial: ", ss.serial, " Fecha Expiración",ss.registro_sanitario_dispositivo),""), " ") AS "Datos_Dispositivo", ss.informo_jefe AS "Informo Jefe", ssg.clasificacion_inicial AS "Clasificacion", ssg.investigacion AS "Investigacion" , ssg.conclusiones AS "Conclusiones", ssg.acciones_inseguras AS "AccionesI", ssg.grado_lesion AS "GradoL", ssg.gravedad_caso AS "GravedadC", ssg.origen_complicacion AS "OrigenC", ssg.faccont_ambiental AS "FacAmbientales", ssg.faccont_equipo AS "FacEquipo", ssg.faccont_individuo AS "FacIndividuo", ssg.faccont_paciente AS "FacPaciente", ssg.faccont_tecnologia AS "FacTecnologia",  ssg.produjo_danos AS "FacDaños", ssg.prevenible AS "Prevenible" , ssg.usuario_registra AS "UsuarioGestion", ssg.fecha_analisis AS "Fecha_Analisis", ssg.trazadores AS "Trazadores",ssg.trazrelCuidado AS "Rel_Cuidado",ssg.trazRelMedicam AS "Rel_Medicamento",ssg.trazrelIACS AS "Rel_IACS",ssg.trazRelprocInva AS "Rel_Proc",ssg.trazreldiagnosticos AS "Rel_Diagnostico",ssg.trazrelTecnov AS "Rel_Tecno",ssg.trazrelOtros AS "Rel_Otro", ssg.justificacion_trazadores AS "JustificacionT",  ssg.guias AS "Guias", ssg.enteControl AS "EnteControl", ssg.reporteCont AS "ReporteCont", ssg.fechaRep AS "Fecha_Reporte", ssg.fechaComite AS "Fecha_Comite", ssg.accion_mejora AS "Accion_Mejora", ssg.barrera AS "Barrera", ssg.grupo AS "GrupoA", ssg.clasificacion_final AS "ClasificacionF", ss.fecha_registro AS "Fecha Registo", ss.estado AS"Estado"';

				$query_sucessos = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad ss INNER JOIN servicios s ON ss.servicio = s.id_servicio INNER JOIN suceso_seguridad_gestion ssg ON ss.id_suceso_seguridad = ssg.id_suceso_seguridad', 'ss.id_suceso_seguridad ="' . $id_suceso . '" ', '', 0, 0);
	        	
	        	$data_reporte = $query_sucessos->result();
	        	
	            foreach ($data_reporte as $row) 
	            {

			        $pdf->SetFont('Arial', 'B', 10);
			        $pdf->SetFillColor(200,220,255);
			        $pdf->Cell(0, 6, 'DATOS DEL SUCESO', 1, 1, 'C',true);
			        
			        $pdf->SetFont('Arial', 'B', 9);
			        			         
			        $pdf->Cell(29, 6, 'Fecha del Suceso', 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 9);
			        $pdf->Cell(25, 6,utf8_decode($row->Fecha_suceso), 1, 0, 'C', false);
			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(25, 6, 'Servicio', 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(0, 6, utf8_decode($row->Servicio), 1, 1, 'L',false);
			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(29, 6, 'Cargo Reportante', 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(65, 6,utf8_decode($row->Cargo), 1, 0, 'C', false);
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(55, 6, utf8_decode('Identificación del Paciente'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(0, 6, utf8_decode($row->Documento_Paciente), 1, 1, 'L',false);
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(33, 6, 'Nombre del Paciente', 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(55, 6,utf8_decode($row->Paciente), 1, 0, 'C', false);
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(33, 6, 'Novedad asociada a:', 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(0, 6, utf8_decode($row->Novedad_Asociada), 1, 1, 'L',false);
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Descripción de la Novedad'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Des_Novedad), 'LTRB', 'L');
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Manejo Realizado'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Manejo_Realizado), 'LTRB', 'L');
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Datos Medicamentos Relacionados al Suceso'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Datos_Medicamentos), 'LTRB', 'L');
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Datos Dispositivos Relacionados al Suceso'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Datos_Dispositivo), 'LTRB', 'L');
			        	
			        $pdf->SetFont('Arial', 'B', 10);	
			        $pdf->Cell(0, 6, 'ANALISIS DEL CASO', 1, 1, 'C',true);	
			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(29, 6, utf8_decode('Fecha Analísis'), 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 9);
			        $pdf->Cell(25, 6,utf8_decode($row->Fecha_Analisis), 1, 0, 'C', false);

			        $clasificacion = '';
			        
			        switch($row->Clasificacion){
					
					    case '1': $clasificacion = 'Incidente';
					        break;
					    case '2': $clasificacion = 'Complicación';
					        break;
					    case '3': $clasificacion = 'Evento Adverso';
					        break;					        
					    case '4': $clasificacion = 'No E-I-NI-C';
					        break;					        
					    case '5': $clasificacion = 'Repetido';
					        break;					        
					    case '6': $clasificacion = 'Infección Asociada al Cuidado de la Salud';
					        break;	
					}
			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(33, 6,utf8_decode('Clafisicación Inicial'), 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(0, 6,utf8_decode($clasificacion), 1, 1, 'C', false);

			        $GravedadC = '';
			        switch($row->GravedadC){
						
						case '0': $GravedadC = 'Leve';
					        break;	
					    case '1': $GravedadC = 'Moderada';
					        break;
					    default : $GravedadC = 'Severa';
					        break;
					}
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(33, 6, 'Gravedad del Caso:', 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(39, 6, utf8_decode($GravedadC), 1, 0, 'L',false);

			        $complicacion = '';
			        switch($row->OrigenC){
						
						case '0': $complicacion = 'Quirúrgica';
					        break;	
					    case '1': $complicacion = 'Anestésica';
					        break;
					    case '2': $complicacion = 'Otra';
					        break;
					    default : $complicacion = 'No Aplica';
					        break;
					}
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(48, 6, utf8_decode('Origen de la Complicación:'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(0, 6, utf8_decode($complicacion), 1, 1, 'L',false);

			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Investigación del Suceso'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Investigacion), 'LTRB', 'L');
			        
			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Conclusiones Investigación'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Conclusiones), 'LTRB', 'L');

			        $pdf->SetFont('Arial', 'B', 9);	

			        $pdf->Cell(0, 6, utf8_decode('Acciones Inseguras Identificadas'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->AccionesI), 'LTRB', 'L');


			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(0, 6, 'FACTORES CONTRIBUTIVOS', 1, 1, 'C',true);
			         
			        $FacAmbientales = '';
			        switch($row->FacAmbientales){ 
				        case '1' : $FacAmbientales = 'Personal suficiente'; 
				        	break;
					    case '2' : $FacAmbientales = 'Mezcla de habilidades'; 
				        	break;
					    case '3' : $FacAmbientales = 'Carga de Trabajo ';
				        	break;
					    case '4' : $FacAmbientales = 'Patrón de turnos';
				        	break;
					    case '5' : $FacAmbientales = 'Diseño';
				        	break;
					    case '6' : $FacAmbientales = 'Disponibilidad y mantenimiento de equipos';
				        	break;
					    case '7' : $FacAmbientales = 'Soporte administrativo y gerencial';
				        	break;
					    case '8' : $FacAmbientales = 'Clima Laboral';
				        	break;
					    case '9' : $FacAmbientales = 'Ambiente físico (luz, espacio, ruido)';
				        	break;
				        default : $FacAmbientales = 'No Aplica';
					        break;	
					};       

			        $pdf->Cell(38, 6, utf8_decode('Ambientales'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($FacAmbientales), 'LTRB', 'L');
			        $FacEquipo = '';
			        switch($row->FacEquipo){ 
					    
					    case '1': $FacEquipo = 'Comunicación verbal y escrita '; 
					    case '2': $FacEquipo = 'Supervisión y disponibilidad de soporte';
					    	break;
			        	default : $FacEquipo = 'No Aplica';
					        break;
					};

					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(38, 6, utf8_decode('Equipo de Trabajo'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($FacEquipo), 'LTRB', 'L');
					
			        $FacIndividuo = '';
			        switch($row->FacIndividuo){

					    case '1' : $FacIndividuo = 'Conocimiento';
					    case '2' : $FacIndividuo = 'Habilidades y competencia'; 
					    case '3' : $FacIndividuo = 'Salud Física y Mental';
					    	break;
			        	default : $FacIndividuo = 'No Aplica';
					        break;
					};

					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(38, 6, utf8_decode('Individuo'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($FacIndividuo), 'LTRB', 'L');
					
			        $FacPaciente = '';
			        switch($row->FacPaciente){

					    case '1' : $FacPaciente = 'Complejidad y Gravedad';
					    case '2' : $FacPaciente = 'Lenguaje y Comunicación'; 
					    case '3' : $FacPaciente = 'Personalidad y Factores Sociales';
					    	break;
			        	default : $FacPaciente = 'No Aplica';
					        break;
					};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(38, 6, utf8_decode('Paciente'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($FacPaciente), 'LTRB', 'L');

					$FacTecnologia = '';
			        switch($row->FacTecnologia){ 
					           
					  
					    case '1' : $FacTecnologia = 'Diseño de la tarea y claridad de la estructura'; 
					    case '2' : $FacTecnologia = 'Disponibilidad y uso de protocolos'; 
					    case '3' : $FacTecnologia = 'Disponibilidad y confiabilidad de las pruebas diagnósticas';
					    case '4' : $FacTecnologia = 'Ayudas para toma de decisiones';
					    	break;
			        	default : $FacTecnologia = 'No Aplica';
					        break;
					};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(38, 6, utf8_decode('Tareas y Tecnología'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($FacTecnologia), 'LTRB', 'L');

			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(0, 6, utf8_decode('Justificación Factores Contributivos'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->JustificacionT), 'LTRB', 'L');
			        
			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(0, 6, utf8_decode('CLASIFICACIÓN DE TRAZADORES'), 1, 1, 'C',true);

			        $Rel_Cuidado = '';
			        switch ($row->Rel_Cuidado) {
					    case '1': $Rel_Cuidado = 'Paciente con úlcera por presión';
					        break;
					    case '2': $Rel_Cuidado = 'Paciente con paro cardiaco o respiratorio';
					        break;
					    case '3': $Rel_Cuidado = 'Caída intrainstitucional';
					        break;
					    case '4': $Rel_Cuidado = 'Traslado de paciente';
					        break;
					    case '5': $Rel_Cuidado = 'Paciente con broncoaspiración intrainstitucional';
					        break;
					    case '6': $Rel_Cuidado = 'Paciente con TEP o TVP';
					        break;
					    default: $Rel_Cuidado = 'No aplica para este Grupo';
					        break;
					};

					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(48, 6, utf8_decode('Relacionados con el Cuidado'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_Cuidado), 'LTRB', 'L');

					$Rel_Medicamento = '';
					switch ($row->Rel_Medicamento) {
					    case '1': $Rel_Medicamento = 'Reacción adversa a medicamentos';
					        break;
					    case '2': $Rel_Medicamento = 'Sospecha de falla terapéutica';
					        break;
					    case '3': $Rel_Medicamento = 'Problemas relacionados al uso de medicamento: Prescripción';
					        break;
					    case '4': $Rel_Medicamento = 'Problemas relacionados al uso de medicamento: Dispensación';
					        break;
					    case '5': $Rel_Medicamento = 'Problemas relacionados al uso de Medicamentos: Administración';
					        break;
					    case '6': $Rel_Medicamento = 'Problemas relacionados al uso de medicamentos: Monitorización y/o seguimiento';
					        break;
					    default:  $Rel_Medicamento = 'No aplica para este Grupo';
					        break;
					};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(58, 6, utf8_decode('Relacionados con Medicamentos'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_Medicamento), 'LTRB', 'L');
			        
					// Switch case para $optrelIACS
					$Rel_IACS = '';
					switch ($row->Rel_IACS) {
					    case '1': $Rel_IACS = 'Infección de sitio quirúrgico';
					        break;
					    case '2': $Rel_IACS = 'Infección del torrente sanguíneo asociado a catéter central o subcutáneo';
					        break ;
					    case '3': $Rel_IACS = 'Infección arterial o venosa';
					        break;
					    default: $Rel_IACS = 'No aplica para este grupo';
					        break;
					};

					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(48, 6, utf8_decode('Relacionados con IACS'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_IACS), 'LTRB', 'L');

					// Switch case para $optRelprocInva
					$Rel_Proc = '';
					switch ($row->Rel_Proc) {
					    case '1': $Rel_Proc = 'Cancelación de cirugías o procedimientos atribuida a la organización';
					        break;
					    case '2': $Rel_Proc = 'Cirugía o procedimiento en parte equivocada o en paciente equivocado';
					        break;
					    case '3': $Rel_Proc = 'Retención de cuerpos extraños en POP';
					        break;
					    case '4': $Rel_Proc = 'Paciente con Reintervención';
					        break;
					    case '5': $Rel_Proc = 'Lesión iatrogénica peri operatoria o intraprocedimiento';
					        break;
					    case '6': $Rel_Proc = 'Demora en inicio de cirugía y/o procedimiento';
					        break;
					    case '7': $Rel_Proc = 'Lesiones asociadas a la venopunción';
					        break;
					    default: $Rel_Proc = 'No aplica para este grupo';
					        break;
					};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(70, 6, utf8_decode('Relacionados con Procedimientos invasivos'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_Proc), 'LTRB', 'L');

		    
		            $Rel_Cuidado = '';
					// Switch case para $optreldiagnosticos
					$Rel_Diagnostico = '';
					switch ($row->Rel_Diagnostico) {
						case '1': $Rel_Diagnostico = 'Entrega intercambio de reportes';
						break;
						case '2': $Rel_Diagnostico = 'Relacionados con la recolección, transporte y/o manejo de muestras';
						break;
						case '3': $Rel_Diagnostico = 'Entrega e resultados o informes errados que generan conductas terapéuticas inadecuadas';
						break;
						case '4': $Rel_Diagnostico = 'Déficit de examen físico o interpretación de pruebas diagnosticas';
						break;
						case '5': $Rel_Diagnostico = 'Relacionado con la gestión de valor critico';
						break;
						default: $Rel_Diagnostico = 'No aplica para este grupo';
						break;
						};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(50, 6, utf8_decode('Relacionados con Diagnósticos'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_Diagnostico), 'LTRB', 'L');

					// Switch case para $optrelTecnov
		            $Rel_Tecno = '';
					switch ($row->Rel_Tecno) {
					    case '1': $Rel_Tecno = 'Relacionados al Uso del Dispositivo Médico';
					        break;
					    case '2': $Rel_Tecno = 'Reacción alérgica a dispositivo médico';
					        break;
					    case '3': $Rel_Tecno = 'Relacionados a la calidad del dispositivo Médico';
					        break;
					    case '4': $Rel_Tecno = 'Relacionado al mantenimiento o logística de Equipo Biomedico';
					        break;
					    case '5': $Rel_Tecno = 'Relacionado al funcionamiento del Equipo Biomedico';
					        break;
					    default: $Rel_Tecno = 'No aplica para este grupo';
					        break;
					};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(55, 6, utf8_decode('Relacionados con Tecnovigilancia'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_Tecno), 'LTRB', 'L');

					// Switch case para $optrelOtros
					$Rel_Otro = '';
					switch ($row->Rel_Otro) {
					    case '1': $Rel_Otro = 'Relacionados con equipos de apoyo o infraestructura';
					        break;
					    case '2': $Rel_Otro = 'Reingreso por posible falla en la atención antes de 30 días';
					        break;
					    case '3': $Rel_Otro = 'Identificación del paciente errado o incompleto';
					        break;
					    case '4': $Rel_Otro = 'Relacionados con historia clínicas o tecnología informática';
					        break;
					    case '5': $Rel_Otro = 'Relacionados con trámites administrativos que afectan la seguridad asistencial';
					        break;
					    case '6': $Rel_Otro = 'Relacionado con reactivovigilancia';
					        break;
					    case '7': $Rel_Otro = 'La causa no se encuentra en ninguno de los grupos';
					        break;
					    default: $Rel_Otro = 'No aplica a este grupo';
					        break;
					};
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(48, 6, utf8_decode('Otros Factores'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($Rel_Otro), 'LTRB', 'L');
					$pdf->Cell(0, 2, '', 1, 1, 'L', true);

					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(48, 6, utf8_decode('Produjo Daños al Paciente'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);
			        $FacDaños ='No';
			        if($row->FacDaños ==' 1'){
			        	$FacDaños ='Si';
			        };	
			        $pdf->Cell(35, 6,utf8_decode($FacDaños), 1, 0, 'C', false);
			        $pdf->SetFont('Arial', 'B', 9);
					$pdf->Cell(48, 6, utf8_decode('El Suceso era prevenible'), 1, 0, 'L', true);
			        $pdf->SetFont('Arial', '', 9);
			        $Prevenible ='No';
			        if($row->Prevenible ==' 1'){
			        	$Prevenible ='Si';
			        };
			        $pdf->Cell(0, 6,utf8_decode($Prevenible), 1, 1, 'C', false);

			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(0, 6, utf8_decode('Guías de Buenas Prácticas con las que se relaciona el suceso'), 1, 1, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	
			        
			        
			        // Switch case para $opcguias
			        $Guias ='';
					switch ($row->Guias) {
					    case '1': $Guias ='Detectar, prevenir y reducir infecciones asociadas atención en salud';
					        break;
					    case '2': $Guias ='Garantizar la correcta identificación del paciente y las muestras de laboratorio';
					        break;
					    case '3': $Guias ='Gestionar y desarrollar la adecuada comunicación entre las personas que atienden y cuidan a los pacientes';
					        break;
					    case '4': $Guias ='Prevenir las ulceras por presión';
					        break;
					    case '5': $Guias ='Procesos para la prevención y reducción de la frecuencia de caídas';
					        break;
					    case '6': $Guias ='Mejorar la seguridad en a la utilización de medicamentos';
					        break;
					    case '7': $Guias ='Mejorar la seguridad en los procedimientos quirúrgicos';
					        break;
					    default: $Guias ='No aplica a ninguna guía de buena practica';
					        break;
					};
			        $pdf->MultiCell(0, 6, utf8_decode($Guias), 'LTRB', 'L');

			        $pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(67, 6, utf8_decode('Requiere Reporte ante un Ente de Control?'), 1, 0, 'C', true);
			        $pdf->SetFont('Arial', '', 9);	

			        $EnteControl= 'No';					
					if($row->EnteControl ==' 1'){
			        	$EnteControl ='Si';
			        	$pdf->Cell(10, 6,utf8_decode($EnteControl), 1, 0, 'C', false);
			        	$ReporteCont='';
			        	switch ($row->ReporteCont) {
						    case '1': $ReporteCont = 'Farmacovigilancia';
						        break;
						    case '2': $ReporteCont = 'Tecnovigilancia';
						        break;
						    case '3': $ReporteCont = 'Reactovigilancia';
						        break;
						    default: $ReporteCont = 'Seleccione una opción'; // No hay '0' en este array
						        break;
						}
			        	$pdf->Cell(40, 6,utf8_decode($ReporteCont), 1, 0, 'C', false);
			        	$pdf->SetFont('Arial', 'B', 9);	
			        	$pdf->Cell(30, 6, utf8_decode('Fecha Reporte'), 1, 0, 'C', true);
			        	$pdf->SetFont('Arial', '', 9);
			        	$pdf->Cell(0, 6,utf8_decode($row->Fecha_Reporte), 1, 1, 'C', false);
			        }else{
			        	$pdf->Cell(10, 6,utf8_decode($EnteControl), 1, 1, 'C', false);
			        }	
			        
		        	$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(0, 6, utf8_decode('Barrera de Seguridad'), 1, 1, 'L', true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->MultiCell(0, 6, utf8_decode($row->Barrera), 'LTRB', 'L');
					
			        $pdf->SetFont('Arial', 'B', 9);	
		        	$pdf->Cell(50, 6, utf8_decode('Grupo que Realizo el Análisis'), 1, 0, 'C', true);
		        	$pdf->SetFont('Arial', '', 9);
		        	$pdf->Cell(0, 6,utf8_decode($row->GrupoA), 1, 1, 'C', false);

		        	$pdf->SetFont('Arial', 'B', 9);	
		        	$pdf->Cell(35, 6, utf8_decode('Fecha Comite'), 1, 0, 'C', true);
		        	$pdf->SetFont('Arial', '', 9);
		        	$pdf->Cell(35, 6,utf8_decode($row->Fecha_Comite), 1, 0, 'C', false);
				
					$clasificacionFinal = '';
			        
			        switch($row->ClasificacionF){
					
					    case '1': $clasificacionFinal = 'Incidente';
					        break;
					    case '2': $clasificacionFinal = 'Complicación';
					        break;
					    case '3': $clasificacionFinal = 'Evento Adverso';
					        break;					        
					    case '4': $clasificacionFinal = 'No E-I-NI-C';
					        break;					        
					    case '5': $clasificacionFinal = 'Repetido';
					        break;					        
					    case '6': $clasificacionFinal = 'Infección Asociada al Cuidado de la Salud';
					        break;	
					}
					$pdf->SetFont('Arial', 'B', 9);	
			        $pdf->Cell(33, 6,utf8_decode('Clafisicación Final'), 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 9);	
			        $pdf->Cell(0, 6,utf8_decode($clasificacionFinal), 1, 1, 'C', false);
			       
			       // ---- SEGUIMIENTOS -----//
			       $campos = 's.id_seguimiento AS "Id", s.fecha_seguimiento AS "Fecha", IF(s.accion_efectiva = "1", "Si", "No") AS "AcciEfectiva", s.porque_respta AS "Respuesta", s.observaciones_seguimiento AS "ObservacionesS", CASE WHEN s.cumplimento = "0" THEN "Completo" WHEN s.cumplimento = "1" THEN "No Iniciado" WHEN s.cumplimento = "2" THEN "Sin Analisis" WHEN s.cumplimento = "3" THEN "No dio lugar a acción" WHEN s.cumplimento = "4" THEN "Avanzado" WHEN s.cumplimento = "0" THEN "Iniciado" END  AS "Cumplimiento", IF(s.estado_caso = "1", "Si", "No") AS "EstadoCaso", GROUP_CONCAT(CONCAT(e.nombres," ", e.apellidos) SEPARATOR ", ") AS "Funcionarios"'; 

					$query_seguimiento = $this->general_model->consulta_personalizada($campos, 'suceso_seguridad_seguimiento s INNER JOIN empleados e ON FIND_IN_SET(e.id_empleado, REPLACE(s.f_involucrado, " ", " "))', 's.id_suceso_seguridad ="' . $id_suceso. '" GROUP BY s.id_seguimiento', 's.fecha_seguimiento DESC',1, 0);
	        	
	        		$data_seguimiento = $query_seguimiento->result();
	        		if(!empty($data_seguimiento)){
	        			foreach ($data_seguimiento as $row) 
	            		{

					        $pdf->SetFont('Arial', 'B', 9);	
					        $pdf->Cell(0, 6, utf8_decode('SEGUIMIENTOS'), 1, 1, 'C', true);
					        $pdf->SetFont('Arial', '', 9);	

					       	
					        $pdf->SetFont('Arial', 'B', 9);	
					        $pdf->Cell(179, 6, utf8_decode('La Accion de Mejora fue Efectiva?'), 1, 0, 'L', true);
					        $pdf->SetFont('Arial', '', 9);	
					        $pdf->Cell(7, 6,utf8_decode($row->AcciEfectiva), 1, 1, 'C', false);
							
					        $pdf->SetFont('Arial', 'B', 9);	
				        	$pdf->Cell(0, 6, utf8_decode('Por qué su respuesta anterior?'), 1, 1, 'C', true);
				        	$pdf->SetFont('Arial', '', 9);
				        	$pdf->MultiCell(0, 6,utf8_decode($row->Respuesta), 'LTRB', 'C', false);

				        	$pdf->SetFont('Arial', 'B', 9);	
				        	$pdf->Cell(0, 6, utf8_decode('Observaciones del seguimiento'), 1, 1, 'C', true);
				        	$pdf->SetFont('Arial', '', 9);
				        	$pdf->MultiCell(0, 6, utf8_decode($row->ObservacionesS), 'LTRB', 'L');


				        	$pdf->SetFont('Arial', 'B', 9);	
					        $pdf->Cell(70, 6, utf8_decode('Estado Cumplimiento'), 1, 0, 'L', true);
					        $pdf->SetFont('Arial', '', 9);	
					        $pdf->Cell(20, 6,utf8_decode($row->Cumplimiento), 1, 0, 'C', false);
							
					        $pdf->SetFont('Arial', 'B', 9);	
				        	$pdf->Cell(83, 6, utf8_decode('El Caso esta cerrado'), 1, 0, 'C', true);
				        	$pdf->SetFont('Arial', '', 9);
				        	$pdf->Cell(0, 6,utf8_decode($row->EstadoCaso), 1, 1, 'C', false);

				        	$pdf->SetFont('Arial', 'B', 9);	
				        	$pdf->Cell(0, 6, utf8_decode('Funcionarios Involucrados'), 1, 1, 'C', true);
				        	$pdf->SetFont('Arial', '', 9);
				        	$pdf->MultiCell(0, 6, utf8_decode($row->Funcionarios), 'LTRB', 'L');			        	
				        }
	        		}	        		
			        $pdf->Output('Reporte_suceso.pdf', 'I');
		        }
			} catch (Exception $e) {
			    die("Error al generar el PDF: " . $e->getMessage());
			}

		}//-Valida Inicio de Session
	}
	
}
