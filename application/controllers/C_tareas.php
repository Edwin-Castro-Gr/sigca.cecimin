<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_tareas extends CI_Controller
{

    //Constructor de la clase
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Bogota');

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
            // $this->session->set_userdata('archivo_origen','');
            $this->session->set_userdata('archivo_visual', '');
            // $this->session->set_userdata('archivo_origen_tipo','');
            $this->session->set_userdata('archivo_visual_tipo', '');

            $this->load->helper('funciones_select');
            $this->load->helper('funciones_chk');

            $data_usua['titulo'] = "Tareas";
            $data_usua['origen'] = "Administración";
            $data_usua['contenido'] = 'c_tareas/index';
            $data_usua['entrada_js'] = '_js/tareas.js';
            $data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">';

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

    // public function nuevo()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
    //         redirect();
    //     } else {

    //         $this->session->set_userdata('archivo_visual', '');
    //         $this->session->set_userdata('archivo_visual_tipo', '');
    //         $this->load->helper('funciones_select');
    //         $this->load->helper('funciones_chk');

    //         $data_usua['titulo'] = "Plan de Mejora";
    //         $data_usua['origen'] = "Administración";
    //         $data_usua['contenido'] = 'plan_mejora/nuevo';
    //         $data_usua['entrada_js'] = '_js/plan_mejora.js';
    //         $data_usua['librerias_css'] = '<!-- DataTables -->
	// 		<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">			
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

    //         $data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
			
    // 		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>
    // 		<!-- DataTables  -->
    // 		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    // 		<script src="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/js/star-rating.min.js"></script>
    // 		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>
	// 		<script src="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js') . '"></script>
	// 		<script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

	// 	    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/tiny-date-picker@3.2.8/dist/date-range-picker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/src/js/bootstrap-datetimepicker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/js/bootstrap-colorpicker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

    //         $this->load->view('template', $data_usua);
    //     }
    // }

    // public function gestionar($id)
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
    //         redirect(base_url());
    //     } else {

    //         // $id = $this->input->post('idreg');

    //         $data_usua['c_id_mejora'] = $id;
    //         $data_usua['c_idtipoF'] = '';
    //         $data_usua['c_idtipoAccion'] = '';
    //         $data_usua['c_IdFuente'] = '';
    //         $data_usua['c_id_responsable'] = '';
    //         $data_usua['c_id_ronda'] = '';
    //         $data_usua['c_nom_ronda'] = '';
    //         $data_usua['c_nom_pregunta'] = '';
    //         $data_usua['c_nom_servicio'] = '';
    //         $data_usua['c_hallazgos'] = '';
    //         $data_usua['c_nom_responsable'] = '';
    //         $data_usua['c_accion'] = '';
    //         $data_usua['c_observaciones'] = '';
    //         $data_usua['c_evidencias'] = '';
    //         $data_usua['c_estado'] = '';
    //         $data_usua['c_id_usuario'] = '';
    //         $data_usua['c_usuario_a'] = $this->session->userdata('C_id_usuario');            

    //         $campos = 'pm.id_plan AS "Id", rg.id_ronda AS "Id_ronda", rg.id_servicio AS "Id_Servicio", rp.id_seccion AS "Id_Seccion", ro.nombre AS "Ronda", se.nombre AS "Servicio", rs.nombre AS "Seccion", pm.tipo_fuente AS "tipo_fuente", re.id_pregunta AS "Id_fuente", rp.nombre AS "Item", re.hallazgo AS "Hallazgo", pm.tipo_mejora AS "tipo_mejora", pm.accion_mejora AS "Accion", pm.responsable AS "Id_responsable" , IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Responsable", pm.estado AS "Estado" ';

    //         $query = $this->general_model->consulta_personalizada($campos, 'planes_mejoras pm INNER JOIN rondas_gestion_resp re ON pm.id_fuente = re.id_respuesta INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio INNER JOIN empleados e ON pm.responsable = e.id_empleado', 'pm.id_plan="' . $id . '" ', '', 0, 0);

    //         foreach ($query->result_array() as $row) {


    //             $data_usua['c_idtipoF'] = $row['tipo_fuente'];
    //             $data_usua['c_idtipoAccion'] = $row['tipo_mejora'];
    //             $data_usua['c_IdFuente'] = $row['Id_fuente'];
    //             $data_usua['c_id_responsable'] = $row['Id_responsable'];
    //             $data_usua['c_nom_ronda'] = $row['Ronda'];
    //             $data_usua['c_nom_pregunta'] = $row['Item'];
    //             $data_usua['c_nom_servicio'] = $row['Servicio'];
    //             $data_usua['c_hallazgos'] = $row['Hallazgo'];
    //             $data_usua['c_nom_responsable'] = $row['Responsable'];
    //             $data_usua['c_accion'] = $row['Accion'];
    //             $data_usua['c_observaciones'] = '';
    //             $data_usua['c_evidencias'] = '';
    //             $data_usua['c_estado'] = $row['Estado'];
               
    //         }
            
    //         $this->load->helper('funciones_select');
    //         $this->load->helper('funciones_chk');

    //         $data_usua['titulo'] = "Gestionar Plan de Mejora";
    //         $data_usua['origen'] = "Plan de Mejora";
    //         $data_usua['contenido'] = 'plan_mejora/gestion';
    //         $data_usua['entrada_js'] = '_js/plan_mejora.js';
    //         $data_usua['librerias_css'] = '<!-- DataTables -->
	// 		<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">			
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

    //         $data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
			
    // 		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>
    // 		<!-- DataTables  -->
    // 		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    // 		<script src="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/js/star-rating.min.js"></script>
    // 		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>
	// 		<script src="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js') . '"></script>
	// 		<script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

	// 	    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/tiny-date-picker@3.2.8/dist/date-range-picker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/src/js/bootstrap-datetimepicker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/js/bootstrap-colorpicker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

    //         $this->load->view('template', $data_usua);
    //     }
    // }


    // public function cargar_inf_nocumple()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect(base_url());
    //     else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect(base_url());
    //         } else {
    //             $id_ronda = $this->input->post('id_ronda');
    //             $id_servicio = $this->input->post('id_servicio');               
    //             $fechaini = $this->input->post('fechaIniI');    
    //             $fechafin = $this->input->post('fechaFinI');    
    //             $fecha = $this->input->post('fecha');
    //             $tabla = '';


    //             $campos = 'rp.id_respuesta AS "Id", DATE(rg.fecha_insp) AS "Fecha Inspección", r.nombre AS "Ronda", s.nombre AS "Servicio", rs.nombre AS "Sección", rq.nombre AS "Pregunta", IFNULL(rer.imagen, " ") AS "Evidencia",IFNULL(pm.id_fuente,"")AS "plan"';

    //             //Consulta cuando todos los campos rondas, servicios, fecha inicio y fecha final son diferentes a vacio
    //             if ($fechaini != "" && $fechafin != "" && $id_ronda != "00" && $id_servicio != "00"){
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '" AND rg.id_servicio = "' . $id_servicio . '" AND DATE(rg.fecha_insp) BETWEEN "'.$fechaini.'" AND "'.$fechafin.'"', 'rg.fecha_insp', 0, 0);

    //             //Consulta cuando todos los campos rondas, fecha inicio y fecha final son diferentes a 00 o vacio y servicios es igual a 00 
    //             }elseif ($fechaini != "" && $fechafin != "" && $id_ronda != "00" && $id_servicio == "00"){
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '" AND DATE(rg.fecha_insp) BETWEEN "'.$fechaini.'" AND "'.$fechafin.'"', 'rg.fecha_insp', 0, 0);

    //             //Consulta cuando fecha inicio y fecha final son diferentes a 00 o vacio y los campos rondas y servicios son igual 00 
    //             }elseif ($fechaini != "" && $fechafin != "" && $id_ronda == "00" && $id_servicio == "00"){
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND DATE(rg.fecha_insp) BETWEEN "'.$fechaini.'" AND "'.$fechafin.'"', 'rg.fecha_insp', 0, 0);

    //             //Consulta cuando todos los campos rondas y servicios son diferentes a 00 y fecha inicio y fecha final es igual a vacio 
    //             }else if ($id_ronda != "00" && $id_servicio != "00" && $fechaini == "" && $fechafin == ""){
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '" AND rg.id_servicio = "' . $id_servicio . '"', 'rg.fecha_insp', 0, 0);

    //             //Consulta cuando todos el campo rondas es son diferentes a 00 y servicios, fecha inicio, fecha final es igual a vacio  
    //             }else if($id_ronda != "00" && $id_servicio == "00" && $fechaini == "" && $fechafin == ""){
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '"', 'rg.id_ronda', 0, 0);   

    //             //Consulta cuando todos el campo rondas es igual a 00, servicios, fecha inicio y fecha final son diferentes a 00 o vacio    
    //             }else if ($id_servicio != "00" && $id_ronda == "00" && $fechaini == "" && $fechafin == ""){
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_servicio = "' . $id_servicio . '"', 'rg.id_servicio', 0, 0);
                        
    //             //Consulta cuando todos el campo rondas y servicios son igual a 00, y fecha inicio y fecha final son diferentes a 00 o vacio
    //             }else {
    //                 $query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0', 'rg.id_ronda', 0, 0); 
                    
    //             }

    //             $tabla = ' <thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
                
    //             $tabla .= ' <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha Inspección</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Ronda</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Servicio</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Sección</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Pregunta</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
    //                         ';  
                
    //             $tabla .= '</tr></thead><tbody class="post-rel">';
                
    //             foreach ($query->result_array() as $row)
    //             {
    //                 $tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$row['Id'].'</td><td>'.$row['Fecha Inspección'].'</td><td>'.$row['Ronda'].'</td><td>'.$row['Servicio'].'</td><td>'.$row['Sección'].'</td><td>'.$row['Pregunta'].'</td>';
                    

    //                 $tabla .= '<td class="text-nowrap"><div class="action-buttons">
    //                         <a href="#" class="text-green-m1 mx-1" data-toggle="tooltip" data-placement="top" title="Detalle" id="btndetalle_' . $row['Id'] . '"> <i id="btndetalle_' . $row['Id'] . '" class="fa fa-book-open text-105"></i> </a>';
    //                 if($row['Evidencia']!= " "){
    //                     $tabla .=  '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-placement="top" title="P_Mejora" aria-describedby="tooltip' . $row['Id'] . '" id="btnPlan_Mejora' . $row['plan'] . '"> <i  id="btnPlan_Mejora' . $row['plan'] . '" class="fa fa-list text-105"></i> </a>';
    //                 }           

    //                 if($row['Evidencia']!= " "){
    //                     $tabla .=  '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-placement="top" title="Evidencia" aria-describedby="tooltip' . $row['Id'] . '" id="btnEvidencia_' . $row['Evidencia'] . '"> <i  id="btnEvidencia_' . $row['Evidencia'] . '" class="fa fa-file-image text-105"></i> </a>';
    //                 }           

    //                 $tabla .=  '<a href="#" class="text-danger mx-1" data-toggle="tooltip" data-placement="top" title="Acción Mejora" aria-describedby="tooltip' . $row['Id'] . '" id="btnMejora_' . $row['Id'] . '"> <i  id="btnMejora_' . $row['Id'] . '" class="fa fa-edit text-105"></i> </a>';

    //              $tabla .= '</div></td></tr>'; 
    //             }
    //             $tabla .= '</tbody>';   
    //             echo $tabla;
    //         }
    //     }
    // }

    // public function cargar_acciones()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect(base_url());
    //     else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect(base_url());
    //         } else {

    //             $id_plan = $this->input->post('idreg');   
    //             $count = 0;
    //             $tabla = '';
    //             $evidencia='';

    //            $campos = 'pmg.fecha_registro AS "Id", pmg.acciones_realizadas AS "Descripción", pma.ruta_archivo AS "Evidencias"';

    //            $query = $this->general_model->consulta_personalizada($campos, 'planes_mejoras_gestion pmg INNER JOIN planes_mejoras_anexos pma ON pma.id_gestion= pmg.id_gestion', 'pmg.id_plan = "' . $id_plan . '"', 'pmg.fecha_registro', 0, 0); 

    //             $tabla = ' <thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
                
    //             $tabla .= ' 
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha Ejecución</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción Realizada</th>
    //                         <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Evidencias</th>
    //                         ';  
                
    //             $tabla .= '</tr></thead><tbody class="post-acciones">';
                
    //             foreach ($query->result_array() as $row)
    //             {

    //                 $tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$row['Id'].'</td><td>'.$row['Descripción'].'</td>';
        
    //                 $evidencias = explode(",", $row['Evidencias']) ;
    //                 $tabla .= '<td class="text-nowrap"><div class="action-buttons">';
    //                 if (is_array($evidencias)){
    //                     foreach ($evidencias as $value) {
    //                         $count ++;
    //                         $evidencia = $value;
    //                         $tabla .= '
    //                         '.anchor(base_url().$evidencia, '<i class="fa fa-file"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'
                          
    //                         ';
    //                     }
                        
    //                 }else{
    //                     foreach ((array)$evidencias as $value) {
    //                         $evidencia = $value;
    //                         $tabla .= '
    //                         '.anchor(base_url().$evidencia, '<i class="fa fa-file"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'';
    //                     }                 
    //                 }        

    //              $tabla .= '</div></td></tr>'; 
    //             }

    //             $tabla .= '</tbody>';   
    //             echo $tabla;
    //         }
    //     }
    // }


    // public function socializar($id)
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
    //         redirect(base_url());
    //     } else {

    //         $data_usua['c_id_documento'] = $id;
    //         $data_usua['c_id_solicitud'] = '';
    //         $data_usua['c_nombre_documento'] = '';
    //         $data_usua['c_id_tipo_documento'] = '';
    //         $data_usua['c_tipo_documento'] = '';
    //         $data_usua['c_id_Macroproceso'] = '';
    //         $data_usua['c_macroproceso'] = '';
    //         $data_usua['c_id_proceso'] = '';
    //         $data_usua['c_proceso'] = '';
    //         $data_usua['c_id_subproceso'] = '';
    //         $data_usua['c_subproceso'] = '';
    //         $data_usua['c_docrelacionado'] = '';
    //         $data_usua['c_codigo'] = '';
    //         $data_usua['c_version'] = '';
    //         $data_usua['c_fechaversion'] = '';
    //         $data_usua['c_archivo_pdf'] = '';
    //         $data_usua['c_des_empleados'] = '';
    //         $data_usua['c_des_cargos'] = '';
    //         $data_usua['c_des_departamentos'] = '';
    //         $data_usua['c_evaluacion'] = '';
    //         $data_usua['c_estado'] = '';
    //         $data_usua['c_id_usuario'] = '';
    //         $docr = '';

    //         $campos = 'd.id_documento AS "Documento", d.id_solicitud AS "Solicitud", td.nombre AS "Tipo_doc", d.nombre AS "Documento", d.id_macroproceso AS "Id_macroproceso", m.nombre AS "Macroproceso", d.id_procesomaestro AS "Id_proceso", p.nombre AS "Proceso", d.id_subproceso AS "Id_subproceso", sp.nombre AS "Subproceso", d.docrelacionado AS "Doc_relacionado", CONCAT(dv.ruta,dv.archivo) AS "PDF", d.codigo AS "Codigo", dv.version AS "Version", dv.fecha AS "Fechaversion", d.des_empleados AS "Dest_empleados", d.des_cargos AS "Dest_cargos", d.des_departamentos AS "Dest_departamentos", d.evaluacion AS "Evaluacion", d.estado AS "Estado", d.id_usuario AS "Usuario"';

    //         $query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN macroprocesos m ON d.id_macroproceso = m.id_macroproceso LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso=sp.id_subproceso INNER JOIN tipos_documentos td on d.id_tipo = td.id_tipo LEFT JOIN solicitud_documentos s ON d.id_solicitud = s.id_solicitud LEFT JOIN documentos_versiones dv ON dv.id_documento=d.id_documento', 'd.id_documento ="' . $id . '" ', '', 0, 0);

    //         foreach ($query->result_array() as $row) {
    //             $data_usua['c_id_solicitud'] = $row['Solicitud'];
    //             $data_usua['c_nombre_documento'] = $row['Documento'];
    //             $data_usua['c_tipo_documento'] = $row['Tipo_doc'];
    //             $data_usua['c_id_Macroproceso'] = $row['Id_macroproceso'];
    //             $data_usua['c_macroproceso'] = $row['Macroproceso'];
    //             $data_usua['c_id_proceso'] = $row['Id_proceso'];
    //             $data_usua['c_proceso'] = $row['Proceso'];
    //             $data_usua['c_id_subproceso'] = $row['Id_subproceso'];
    //             $data_usua['c_subproceso'] = $row['Subproceso'];
    //             $data_usua['c_docrelacionado'] = $row['Doc_relacionado'];
    //             $data_usua['c_codigo'] = $row['Codigo'];
    //             $data_usua['c_version'] = $row['Version'];
    //             $data_usua['c_fechaversion'] = $row['Fechaversion'];
    //             $data_usua['c_archivo_pdf'] = $row['PDF'];
    //             $data_usua['c_evaluacion'] = $row['Evaluacion'];
    //             $data_usua['c_des_empleados'] = $row['Dest_empleados'];
    //             $data_usua['c_des_cargos'] = $row['Dest_cargos'];
    //             $data_usua['c_des_departamentos'] = $row['Dest_departamentos'];
    //             $data_usua['c_estado'] = $row['Estado'];
    //             $data_usua['c_id_usuario'] = $row['Usuario'];

    //             $docr = $row['Doc_relacionado'];
    //         }
    //         $data_usua['c_nom_docrelacionado'] = '';
    //         //$docrela = explode(',', $row['docrelacionado']);
    //         if ($docr != '') {
    //             $docrela = '';
    //             $prefdoc = '';

    //             $query1 = $this->general_model->consulta_personalizada('nombre,  RIGHT(codigo,5) AS cod', 'documentos', ' estado = "1" AND id_documento IN (' . $docr . ') ', 'nombre', 0, 0);
    //             foreach ($query1->result_array() as $row1) {
    //                 if ($docrela != '')
    //                     $docrela .= ',';
    //                 $docrela .= $row1['nombre'];

    //                 if ($prefdoc != '')
    //                     $prefdoc .= '-';
    //                 $prefdoc .= $row1['cod'];
    //             }
    //             $data_usua['c_nom_docrelacionado'] = $docrela;
    //             $data_usua['c_prefdocrelacionado'] = $prefdoc;
    //         }


    //         $this->load->helper('funciones_select');
    //         $this->load->helper('funciones_chk');

    //         $data_usua['titulo'] = "Socializar Documentos";
    //         $data_usua['origen'] = "Documentos";
    //         $data_usua['contenido'] = 'documentos/socializar';
    //         $data_usua['entrada_js'] = '_js/documentos.js';
    //         $data_usua['librerias_css'] = '<!-- DataTables -->
	// 		<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">			
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
	// 		<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/combine/npm/tiny-date-picker@3.2.8/tiny-date-picker.min.css,npm/tiny-date-picker@3.2.8/date-range-picker.min.css">

	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/build/css/bootstrap-datetimepicker.min.css">
	// 		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/css/bootstrap-colorpicker.min.css">';

    //         $data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
			
    // 		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>
    // 		<!-- DataTables  -->
    // 		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    // 		<script src="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/js/star-rating.min.js"></script>
    // 		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>
	// 		<script src="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.js') . '"></script>
    // 		<script src="' . base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js') . '"></script>
	// 		<script src="https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

	// 	    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/tiny-date-picker@3.2.8/dist/date-range-picker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.49/src/js/bootstrap-datetimepicker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.2.0/dist/js/bootstrap-colorpicker.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>
	// 	    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

    //         $this->load->view('template', $data_usua);
    //     }
    // }
    // public function listar_tabla()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
    //         redirect(base_url());
    //     } else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect(base_url());
    //         } else {
    //             $this->load->helper('funciones_tabla');
    //             $tipo_fuente = $this->input->post('tipo');

    //             echo listar_planesMejoras_tabla('WEB', $tipo_fuente);
    //         }
    //     }
    // }

    // //ASIGNACION DEL CODIGO DEL DOCUMENTO
    // public function consecutivo()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
    //         redirect(base_url());
    //     } else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect(base_url());
    //         } else {
    //             $macro = $this->input->post('macro');
    //             $proce = $this->input->post('proce');
    //             $subproce = $this->input->post('subproce');
    //             $docrela = $this->input->post('docrelac');
    //             $tipod = $this->input->post('tipod');


    //             $campos = ' (COUNT(*) + 1) AS "total" ';
    //             $query = $this->general_model->consulta_personalizada($campos, 'documentos', ' id_macroproceso = "' . $macro . '" AND id_procesomaestro = "' . $proce . '" AND id_subproceso = "' . $subproce . '" AND id_tipo = "' . $tipod . '" ', '', 0, 0);
    //             $row = $query->row_array();
    //             if ($row['total'] < 10)
    //                 echo "00" . $row['total'];
    //             elseif ($row['total'] >= 10 && $row['total'] < 100)
    //                 echo "0" . $row['total'];
    //             else
    //                 echo $row['total'];
    //         } //-Valida Envio por ajax
    //     } //-Valida Inicio de Session
    // }

    // //ASIGNACION DEL CODIGO DEL DOCUMENTO
   

    // public function guardar_gestion()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect();
    //     else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect();
    //         } else {

    //             $this->load->library('upload');

    //             $fecha = date('Y-m-d H:i:s');
    //             $idplan = $this->input->post('idreg');
    //             $nomservicio = $this->input->post('nomservicio');
    //             $archivo = '';

    //         // ################################## SECCION PARA GUARDAR LA GESTION ##################################

    //              $registro = array(

    //                 'id_plan' => $idplan,
    //                 'acciones_realizadas' => $this->input->post('accionR'),
    //                 'fecha_registro'=>$fecha, 
    //                 'usuario_registro' => $this->session->userdata('C_id_usuario'),                    
    //                 'estado' => '1'
    //             );

    //            $query = $this->general_model->insert('planes_mejoras_gestion', $registro);
               
    //         // ################################## SECCION PARA EL CARGUE DE ANEXOS ##################################
               
    //             if (!file_exists('archivos/')) {
    //                 mkdir('archivos/', 0777, true);
    //                 if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/')) {
    //                     mkdir('archivos/'.$this->session->userdata('C_basedatos').'/', 0777, true);
    //                     if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/')) {
    //                         mkdir('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/', 0777, true);
    //                         if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/')) {
    //                             mkdir('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/', 0777, true);
    //                         }
    //                     }
    //                 }
    //             } elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/')) {
    //                 mkdir('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/', 0777, true); 
    //                 if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/')){
    //                     mkdir('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/', 0777, true);
    //                 }   
    //             }elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/')){
    //                 mkdir('archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/', 0777, true);
    //             }

    //             $ruta = './archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/'; 
    //             $rutag='archivos/'.$this->session->userdata('C_basedatos').'/acciones_mejoras/'.$idplan.'/';
                        
                
    //             // $config = [
    //             //     "upload_path" => $ruta,
    //             //     "allowed_types" => "*"
    //             // ];

    //             $this->session->set_userdata('archivo_origen',"");
    //             $mensage = '';

    //         // ################################## SECCION RECORRER EL CONTENIDO DEL INPUT FILE Y GUARDAR LOS DATOS EN BD ##################################    
    //             $config = [
    //                 "upload_path" => $ruta,
    //                 "allowed_types" => "*"
    //             ];

    //             if(!empty($_FILES['evidencia2']['name']) && count(array_filter($_FILES['evidencia2']['name'])) > 0){ 
    //                 $filesCount = count($_FILES['evidencia2']['name']); 
    //                 $this->load->library('upload',$config);
    //                 $this->upload->initialize($config);
    //                 $var_file = $_FILES; 
    //                 for($i = 0; $i < $filesCount; $i++){
                        
    //                     $_FILES['evidencia2']['name'] = $var_file['evidencia2']['name'][$i];
    //                     $_FILES['evidencia2']['type'] = $var_file['evidencia2']['type'][$i];
    //                     $_FILES['evidencia2']['tmp_name'] = $var_file['evidencia2']['tmp_name'][$i];
    //                     $_FILES['evidencia2']['error'] = $var_file['evidencia2']['error'][$i];
    //                     $_FILES['evidencia2']['size'] = $var_file['evidencia2']['size'][$i];
                        
    //                     if ($this->upload->do_upload('evidencia2')){                           
    //                         $data = array('upload_data' => $this->upload->data());
    //                         $filename = $rutag.$data['upload_data']['file_name'];   
                           
    //                        $registro1 = array(                 
    //                         'id_gestion'=>$query, 
    //                         'ruta_archivo'=>$filename,     
    //                         );
    //                         //echo print_r($registro1);
    //                         $query1 = $this->general_model->insert('planes_mejoras_anexos',$registro1); 
    //                     }else{
    //                         $query ="error_file";
    //                     }
    //                 }
                    
    //             } 

    //              // ################################## SECCION PARA GUARDAR LA GESTION ##################################
                 
                              
    //             if ($query >= 1) {
    //                 echo '1';
    //             } else {
    //                 echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
    //                 switch ($query) {
    //                     case "1062":
    //                         echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
    //                         break;
    //                     case "-998":
    //                         echo $this->upload->display_errors($ruta);
    //                         break;
    //                     case "error_file": echo $this->upload->display_errors(); break;
    //                     default:
    //                         echo "Error: " . $query . " => " . $this->db->_error_message();
    //                         break;
    //                 }
    //                 echo '</div>';
    //             }
    //         }
    //     }
    // }


    // public function pdf()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect(base_url());
    //     else {
    //         $this->load->library('Pdffpdf');

    //         $pdf = new Pdffpdf('P', 'mm', 'LETTER');
    //         $pdf->AliasNbPages();

    //         $pdf->hoja = 'LETTER';
    //         $pdf->SetTitle("SIGCA - Listado de Documentos", true);
    //         $pdf->SetLeftMargin(7);
    //         $pdf->SetRightMargin(3);

    //         $pdf->AddPage('P', 'LETTER');

    //         $pdf->Ln(10);
    //         $pdf->SetFont('helvetica', 'B', 14);
    //         $pdf->SetTextColor(0, 0, 0);
    //         $pdf->Cell(0, 0, utf8_decode('LISTADO GENERAL DE DOCUMENTOS      '), 0, 0, 'C', false);
    //         $pdf->Ln(20);

    //         $pdf->SetFont('helvetica', 'B', 6);
    //         $pdf->Cell(195, 5, utf8_decode('Fecha de Impresión: ') . cargar_fechahora_formateada(), 0, 0, 'R', false);
    //         $pdf->Cell(7, 5, ' ', 0, 0, 'C', false);
    //         $pdf->Ln(5);

    //         $campos = 'c.id_cargo AS "Id", c.nombre AS "Nombre", c.descripcion AS "Descripción", IFNULL(a.nombre,"") AS "Area", CASE WHEN c.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    //         $query = $this->general_model->consulta_personalizada($campos, 'cargos c LEFT JOIN areas a ON c.id_area = a.id_area', '', 'c.nombre', 0, 0);
    //         $encabezados = $query->result();

    //         $x = 1;
    //         $fill = true;
    //         $pdf->SetFont('helvetica', 'B', 11);
    //         $pdf->SetFillColor(200, 220, 255);
    //         $pdf->Cell(7, 5, ' ', 0, 0, 'C', false);
    //         $pdf->Cell(16, 5, utf8_decode("ID"), 'LTRB', 0, 'C', $fill);
    //         $pdf->Cell(75, 5, utf8_decode("NOMBRE"), 'LTRB', 0, 'C', $fill);
    //         $pdf->Cell(75, 5, utf8_decode("ÁREA"), 'LTRB', 0, 'C', $fill);
    //         $pdf->Cell(25, 5, utf8_decode("ESTADO"), 'LTRB', 0, 'C', $fill);
    //         $pdf->Cell(7, 5, ' ', 0, 0, 'C', false);
    //         $pdf->Ln(5);
    //         $fill = false;
    //         $pdf->SetFont('helvetica', '', 10);
    //         $pdf->SetFillColor(255, 180, 180);
    //         foreach ($encabezados as $row) {
    //             $pdf->Cell(7, 5, ' ', 0, 0, 'C', false);
    //             $pdf->Cell(16, 5, ($row->Id), 'LTRB', 0, 'C', $fill);
    //             $pdf->Cell(75, 5, utf8_decode($row->Nombre), 'LTRB', 0, 'C', $fill);
    //             $pdf->Cell(75, 5, utf8_decode($row->Area), 'LTRB', 0, 'C', $fill);
    //             if ($row->Estado == "Activo")
    //                 $pdf->Cell(25, 5, $row->Estado, 'LTRB', 0, 'C', $fill);
    //             else
    //                 $pdf->Cell(25, 5, $row->Estado, 'LTRB', 0, 'C', !$fill);
    //             $pdf->Cell(7, 5, ' ', 0, 0, 'C', false);

    //             $pdf->Ln(5);
    //         }

    //         $pdf->Output('I', "Listado_Documentos.pdf");
    //     } //-Valida Inicio de Session
    // }

    // public function excel()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect(base_url());
    //     else {
    //         $filename = "Listado_Documentos.xls";
    //         header("Content-Disposition: attachment; filename=" . $filename);
    //         header("Content-Type: application/vnd.ms-excel");

    //         $this->load->helper('funciones_tabla');

    //         echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE DOCUMENTOS</th></tr></table><br>');

    //         echo '<table border="1">';
    //         echo utf8_decode(listar_documentos_tabla('EXCEL'));
    //         echo '</table>';
    //     } //-Valida Inicio de Session
    // }

    // public function inactivar()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect();
    //     else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect();
    //         } else {
    //             $registro = array('estado' => '0');
    //             $query = $this->general_model->update('documentos', 'id_documento', $this->input->post('idreg'), $registro);
    //             if ($query == "OK")
    //                 echo '1';
    //             else {
    //                 echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
    //                 switch ($query) {
    //                     default:
    //                         echo "Error: " . $query . " => " . $this->db->_error_message();
    //                         break;
    //                 }
    //                 echo '</div>';
    //             }
    //         } //-Valida Envio por ajax
    //     } //-Valida Inicio de Session
    // }

    // public function actualizar()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect();
    //     else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect();
    //         } else {

    //             $dir = $this->input->post('tipodocumento');
    //             $fecha = date('Y-m-d H:i:s');

    //             if (!file_exists('archivos/' . $this->session->userdata('C_basedatos'))) {
    //                 mkdir('archivos/' . $this->session->userdata('C_basedatos'), 0777, true);
    //                 if (!file_exists('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/')) {
    //                     mkdir('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/', 0777, true);
    //                     if (!file_exists('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/' . $dir . '/')) {
    //                         mkdir('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/' . $dir . '/', 0777, true);
    //                     }
    //                 }
    //             } elseif (!file_exists('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/')) {
    //                 mkdir('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/', 0777, true);
    //             } elseif (!file_exists('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/' . $dir . '/')) {
    //                 mkdir('archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/' . $dir . '/', 0777, true);
    //             }

    //             $ruta = './archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/' . $dir . '/';
    //             $rutag = 'archivos/' . $this->session->userdata('C_basedatos') . '/visualizacion/' . $dir . '/';

    //             //CARGAR ARCHIVO VISUAL
    //             $config = [
    //                 "upload_path" => $ruta,
    //                 "allowed_types" => "*"
    //             ];



    //             $iddocumento = $this->input->post('idregistro');

    //             //DESTINATARIOS EMPLEADOS
    //             $val_empleado = "";
    //             if (!empty($this->input->post('empleadosMR_documentos'))) {
    //                 $des_empleado = $this->input->post('empleadosMR_documentos');
    //                 $val_empleado = implode(',', (array) $des_empleado);
    //             }

    //             //DESTINATARIOS CARGOS
    //             $val_cargo = "";
    //             if (!empty($this->input->post('cargosm_documentos'))) {
    //                 $des_cargo = $this->input->post('cargosm_documentos');
    //                 $val_cargo = implode(',', (array) $des_cargo);
    //             }

    //             //DESTINATARIOS DEPARTAMENTOS
    //             $val_departamento = "";
    //             if (!empty($this->input->post('cargosm_documentos'))) {
    //                 $des_departamento = $this->input->post('departamentosM_documentos');
    //                 $val_departamento = implode(',', (array) $des_departamento);
    //             }

    //             $registro = array(

    //                 'des_empleados' => $val_empleado,
    //                 'des_cargos' => $val_cargo,
    //                 'des_departamentos' => $val_departamento,
    //                 'evaluacion' => $this->input->post('evalua'),
    //                 'estado' => $this->input->post('estado')
    //             );

    //             $query1 = $this->general_model->update('documentos', 'id_documento', $iddocumento, $registro);

    //             if ($query1 == "OK") {

    //                 //------------- Actualizar la versión y el Archivo PDF -------------//

    //                 $campos = 'id_version AS "Id"';

    //                 $query = $this->general_model->consulta_personalizada($campos, 'documentos_versiones', 'id_documento ="' . $iddocumento . '" AND estado = "1"', '', 0, 0);
    //                 $row = $query->row_array();
    //                 $id_version = $row['Id'];

    //                 $registro = array(

    //                     'estado' => '0'
    //                 );
    //                 $query = $this->general_model->update('documentos_versiones', 'id_version', $id_version, $registro);
    //             }

    //             if ($query == "OK") {
    //                 $this->load->library("upload", $config);
    //                 if ($this->upload->do_upload('archivov')) {
    //                     $data = array('upload_data' => $this->upload->data());
    //                     $registro = array(
    //                         'id_documento' => $iddocumento,
    //                         'ruta' => $rutag,
    //                         'archivo' => $data['upload_data']['file_name'],
    //                         'version' => $this->input->post('version'),
    //                         'fecha' => $this->input->post('fechaversion'),
    //                         'estado' => '1'
    //                     );
    //                     $query = $this->general_model->insert('documentos_versiones', $registro);
    //                 } else {
    //                     $query = "-998";
    //                 }

    //                 if ($query >= 1) {

    //                     //GUARDAR DESTINATARIOS EMPLEADOS
    //                     if ($val_empleado != "") {

    //                         $id_empleado = explode(",", $val_empleado);
    //                         if (is_array($id_empleado)) {
    //                             foreach ($id_empleado as $value) {
    //                                 $idempleado = $value;
    //                                 $registro = array(
    //                                     'id_documento' => $iddocumento,
    //                                     'id_empleado' => $idempleado,
    //                                     'fecha_registro' => $fecha,
    //                                     'id_usuario' => $this->session->userdata('C_id_usuario'),
    //                                     'estado' => '1'
    //                                 );
    //                                 $query = $this->general_model->insert('documentos_empleados', $registro);
    //                             }
    //                         } else {
    //                             foreach ((array)$id_empleado as $value) {
    //                                 $idempleado = $value;
    //                                 $registro = array(
    //                                     'id_documento' => $iddocumento,
    //                                     'id_empleado' => $idempleado,
    //                                     'fecha_registro' => $fecha,
    //                                     'id_usuario' => $this->session->userdata('C_id_usuario'),
    //                                     'estado' => '1'
    //                                 );
    //                                 $query = $this->general_model->insert('documentos_empleados', $registro);
    //                             }
    //                         }
    //                     }

    //                     //GUARDAR DESTINATARIOS CARGOS
    //                     if ($val_cargo != "") {
    //                         $id_cargo = explode(",", $val_cargo);
    //                         if (is_array($id_cargo)) {
    //                             foreach ($id_cargo as $value) {
    //                                 $idcargo = $value;
    //                                 $registro = array(
    //                                     'id_documento' => $iddocumento,
    //                                     'id_cargo' => $idcargo,
    //                                     'fecha_registro' => $fecha,
    //                                     'id_usuario' => $this->session->userdata('C_id_usuario'),
    //                                     'estado' => '1'
    //                                 );
    //                                 $query = $this->general_model->insert('documentos_cargos', $registro);
    //                             }
    //                         } else {
    //                             foreach ((array)$id_cargo as $value) {
    //                                 $idcargo = $value;
    //                                 $registro = array(
    //                                     'id_documento' => $iddocumento,
    //                                     'id_cargo' => $idcargo,
    //                                     'fecha_registro' => $fecha,
    //                                     'id_usuario' => $this->session->userdata('C_id_usuario'),
    //                                     'estado' => '1'
    //                                 );
    //                                 $query = $this->general_model->insert('documentos_cargos', $registro);
    //                             }
    //                         }
    //                     }

    //                     //GUARDAR DESTINATARIOS DEPARTAMENTOS
    //                     if ($val_departamento != "") {

    //                         $id_departamento = explode(",", $val_departamento);
    //                         if (is_array($id_departamento)) {
    //                             foreach ($id_departamento as $value) {
    //                                 $iddepartamento = $value;
    //                                 $registro = array(
    //                                     'id_documento' => $iddocumento,
    //                                     'id_area' => $iddepartamento,
    //                                     'fecha_registro' => $fecha,
    //                                     'id_usuario' => $this->session->userdata('C_id_usuario'),
    //                                     'estado' => '1'
    //                                 );
    //                                 $query = $this->general_model->insert('documentos_areas', $registro);
    //                             }
    //                         } else {
    //                             foreach ((array)$id_departamento as $value) {
    //                                 $iddepartamento = $value;
    //                                 $registro = array(
    //                                     'id_documento' => $iddocumento,
    //                                     'id_area' => $iddepartamento,
    //                                     'fecha_registro' => $fecha,
    //                                     'id_usuario' => $this->session->userdata('C_id_usuario'),
    //                                     'estado' => '1'
    //                                 );
    //                                 $query = $this->general_model->insert('documentos_areas', $registro);
    //                             }
    //                         }
    //                     }
    //                 }
    //                 echo '1';
    //             } else {
    //                 echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
    //                 switch ($query) {
    //                     case "1062":
    //                         echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!";
    //                         break;
    //                     case "-998":
    //                         echo $this->upload->display_errors($ruta);
    //                         break;
    //                     default:
    //                         echo "Error: " . $query . " => " . $this->db->_error_message();
    //                         break;
    //                 }
    //                 echo '</div>';
    //             }
    //         } //-Valida Envio por ajax
    //     } //-Valida Inicio de Session
    // }

    // public function ver_registro()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
    //         redirect(base_url());
    //     } else {
    //         if (!$this->input->is_ajax_request()) {
    //             redirect(base_url());
    //         } else {
    //             $idreg = $this->input->post('idreg');

    //             $campos = ' aa.id_proceso AS "Id", aa.nombre AS "Nombre", aa.prefijo AS "Prefijo", aa.descripcion AS "Descripción", IFNULL(CONCAT(e.nombre1, " ", e.nombre2, " ", e.apellido1, " ", e.apellido2)," -- ") AS "Responsable",  CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';

    //             $query = $this->general_model->consulta_personalizada($campos, 'procesos aa LEFT JOIN empleados e ON aa.id_responsable = e.id_empleado', ' aa.id_proceso = "' . $idreg . '" ', '', 0, 0);

    //             $encabezado = array();
    //             $i = 0;
    //             foreach ($query->list_fields() as $campo) {
    //                 $encabezado[$i] = $campo;
    //                 $i++;
    //             }

    //             $tabla = '';
    //             $row = $query->row_array();

    //             for ($k = 0; $k < $i; $k++) {
    //                 $tabla .= '
	// 				<div class="row">' .
    //                     form_label($encabezado[$k] . ': ', '', array('class' => 'control-label text-right col-md-4'))
    //                     . '<div class="col-md-8 text-primary"><strong>' . $row[$encabezado[$k]] . '</strong></div>
	// 	            </div>';
    //             }

    //             echo $tabla;
    //         }
    //     }
    // }


    // public function cargarEmpleados()
    // {
    //     if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
    //         redirect();
    //     else {
    //         header('Content-Type: application/json');
    //         $idcargo = $this->input->get('idcarg');

    //         // $idcargo = implode(",",(array)$id);

    //         $campos = 'id_empleado AS "Id", IFNULL(CONCAT(nombres, " ", apellidos),"") AS "Empleado"';
    //         $query = $this->general_model->consulta_personalizada($campos, 'empleados', 'id_cargo IN("' . $idcargo . '")', '', 0, 0);

    //         $arrjson = [];

    //         foreach ($query->result_array() as $row) {
    //             $arrjson[] = array('id' => $row['Id'], 'text' => $row['Empleado']);
    //         }

    //         echo json_encode($arrjson);
    //     }
    // }



    public function sendEmail($Para, $Asunto, $cuerpo, $Cabeceras)
    {
        if (mail($Para, $Asunto, $cuerpo, $Cabeceras)) {
            $msg = 1;
        } else {
            $msg = $this->email->print_debugger();
        }
        return $msg;
    }
}
