<?php
defined('BASEPATH') or exit('No direct script access allowed');

class R_gestion extends CI_Controller
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

	public function administracion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$data_usua['titulo'] = "Rondas de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'rondas/administracion';
			$data_usua['entrada_js'] = '_js/rondas.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '"> 

			';

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

	public function informes()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$data_usua['titulo'] = "Rondas de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'rondas/informes';
			$data_usua['entrada_js'] = '_js/rondas.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chartist@0.11.4/chartist.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('dist/css/chart.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css') . '">

			';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
    		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>    		
    		<script src="' . base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.js') . '"></script>
    		<script src="' . base_url('plugins/moment@2.29.1/moment.min.js') . '"></script>
    		
    		<!-- DataTables  -->
    		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>
			
			<!-- include vendor scripts used in "Charts" page. see "/views//pages/partials/charts/@vendor-scripts.hbs" -->
			<!--<script src="plugins/chart.js@2.9.4/Chart.min.js"></script>
			<script src="plugins/flot@4.2.2/jquery.flot.min.js"></script>
			<script src="plugins/chartist@0.11.4/chartist.min.js"></script>
			<script src="plugins/chart.js@2.9.4/loader.js"></script>-->
			<script src="plugins/chart.js@2.9.4/chart-loader.js"></script>
			';

			$this->load->view('template', $data_usua);
		}
	}

	public function index()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
			$this->load->helper('funciones_select');
			$data_usua['titulo'] = "Rondas de Seguridad";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'rondas/index';
			$data_usua['entrada_js'] = '_js/rondas.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">
			';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
			
    		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>

    		<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>
    		<!-- DataTables  -->
    		<script src="' . base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js') . '"></script>
    		<script src="' . base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js') . '"></script>
    		
			';

			$this->load->view('template', $data_usua);
		}
	}

	public function gestion($id_ronda)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
			$arrayPreguntas = array();

			$data_usua['c_id_ronda'] = $id_ronda;
			$data_usua['c_nombre_ronda'] = "";
			$data_usua['c_id_responsable'] = "";
			$data_usua['c_responsable'] = "";
			$data_usua['c_id_seccion'] = "";
			$data_usua['c_seccion'] = "";
			$data_usua['c_tipo_respuesta'] = "";
			$data_usua['c_step'] = "";
			$data_usua['c_tab'] = "";
			$data_usua['c_titulo'] = "";

			$Id_responsable = "";
			$responsable = "";
			$correo_resp = "";

			$id_reponsableInsp = $this->session->userdata('C_id_usuario');
			$reponsableInsp = $this->session->userdata('C_nom_usuario');

			$campos1 = 'r.nombre AS "Ronda", r.id_responsable AS "IdResponsable", IFNULL(CONCAT(e.nombres," ",e.apellidos),"") AS "Responsable",e.email AS "Correo Responsable"';
			$query1 = $this->general_model->consulta_personalizada($campos1, 'rondas r INNER JOIN empleados e ON r.id_responsable = e.id_empleado', 'r.id_ronda = "' . $id_ronda . '"', '', 0, 0);

			foreach ($query1->result_array() as $row1) {
				$data_usua['c_nombre'] = $row1['Ronda'];
				$data_usua['c_idronda'] = $id_ronda;
				$data_usua['c_id_responsable'] = $row1['IdResponsable'];
				$data_usua['c_responsable'] = $row1['Responsable'];
				$responsable = $row1['Responsable'];

				$Id_responsable = $row1['IdResponsable'];
				$responsable = $row1['Responsable'];
				$correo_resp = $row1['Correo Responsable'];
			}

			$campos = 'id_seccion AS "Seccion", nombre AS "Nombre", tipo_respuesta AS "tipo"';
			$query = $this->general_model->consulta_personalizada($campos, 'rondas_seccion', 'id_ronda = "' . $id_ronda . '"', '', 0, 0);
			$count = 0;

			foreach ($query->result_array() as $row) {
				$count++;
				$data_usua['c_step'] .= "
				<li>
                  	<a href='#step-" . $count . "'>
					  <span class='step-title'>" . $count . "</span>
					  <span class='step-title-done'><i class='fa fa-check text-success'></i></span>
                  	</a>
                </li>
				";

				$data_usua['c_titulo'] = $row['Nombre'];
				$campos2 = 'id_items AS "Id", nombre AS "Nombre"';
				$query2 = $this->general_model->consulta_personalizada($campos2, 'rondas_preguntas', 'id_seccion = "' . $row['Seccion'] . '"', '', 0, 0);
				$count1 = 0;
				$data_usua['c_tab'] .= "
					<div id='step-" . $count . "' class='tab-pane' role='tabpanel' aria-labelledby='step-" . $count . "'/> 
                        <form id='form-" . $count . "' metodo='post' class='row row-cols-1 ms-5 me-5 needs-validation' novalidate>
                        <input type='hidden' id='count' name='count' value='" . $count . "'/>
						<input type='hidden' id='ronda' name='ronda' value='" . $id_ronda . "'/>
                        <input type='hidden' id='seccion' name='seccion' value='" . $row['Seccion'] . "'/>
                        <div class='form-group form-row mt-2' >
							<h3 class='page-title text-dark-m2 text-140'>" . $row['Nombre'] . "</h3>
                        </div>";
				foreach ($query2->result_array() as $row2) {
					$count1++;
					$data_usua['c_tab'] .= "
					<div class='card border-1 brc-primary-m1 mb-2 bgc-secondary-l4'>
						<div class='card-body'>
							<div class='form-group form-row mt-2'>
								<input type='hidden' id='id_pregunta_" . $count . "_" . $count1 . "' name='id_pregunta_" . $count . "_" . $count1 . "' value='" . $row2['Id'] . "'/>
								<div class='col-md-5 col-sm-12 col-xs-12'>" . $row2['Nombre'] . "</div>
								<div class='col-md-1 col-sm-4 col-xs-4 col-4'><input type='radio' class='input-sm bgc-blue' id='respuesta_" . $row2['Id'] . "_" . $count . "' name ='respuesta_" . $row2['Id'] . "_" . $count . "' value='1'  required='required' />C</div>
								<div class='col-md-1 col-sm-4 col-xs-4 col-4'><input type='radio' class='input-sm bgc-danger' id='respuesta_" . $row2['Id'] . "_" . $count . "' name ='respuesta_" . $row2['Id'] . "_" . $count . "' value='0' />NC</div>
								<div class='col-md-1 col-sm-4 col-xs-4 col-4'><input type='radio' class='input-sm bgc-orange' id='respuesta_" . $row2['Id'] . "_" . $count . "' name ='respuesta_" . $row2['Id'] . "_" . $count . "' value='2' />NA</div>
								<div class='col-md-2 col-sm-12 col-xs-12'><textarea class='form-control' id='hallazgos_" . $row2['Id'] . "_" . $count . "' name='hallazgos_" . $row2['Id'] . "_" . $count . "' rows='3'  required='required' placeholder='Hallazgos'  required= false ></textarea></div>
								<div class='col-md-2 col-sm-12 col-xs-12'><textarea class='form-control' id='acciones_" . $row2['Id'] . "_" . $count . "' name='acciones_" . $row2['Id'] . "_" . $count . "' rows='3' placeholder='Accion Inmediata' required = false></textarea></div>
								<div class='col-md-8 col-sm-12 col-xs-12'><textarea class='form-control' id='observaciones_" . $row2['Id'] . "_" . $count . "' name='observaciones_" . $row2['Id'] . "_" . $count . "' rows='3'  required='required' placeholder='Observaciones' required= false></textarea></div>
								<div class='col-md-4 col-sm-12 col-xs-12'><input type='file' class='ace-file-input' name='file_" . $row2['Id'] . "_" . $count . "' id='file_" . $row2['Id'] . "_" . $count . "'/></div>
							</div>
						</div>
					</div>
					";
				}

				$data_usua['c_tab'] .= "
				<input type='hidden' id='preguntas_" . $count . "' name='preguntas_" . $count . "' value='" . $count1 . "'/>
					</form>
                </div>
                ";
			}
			$data_usua['c_tab'] .= " <div> <input type='hidden' name='tsecciones' id= 'tsecciones' value='" . $count . "'/></div> ";

			$count++;
			$data_usua['c_step'] .= "
				<li>
                  	<a href='#step-" . $count . "'>
					  <span class='step-title'>" . $count . "</span>
					  <span class='step-title-done'><i class='fa fa-check text-success'></i></span>
                  	</a>
                </li>
				";

			$data_usua['c_tab'] .= "
					
				<div id='step-" . $count . "'class='tab-pane' role='tabpanel' aria-labelledby='step-" . $count . "'>
                    <form id='form-" . $count . "' metodo='post' class='row row-cols-1 ms-5 me-5 ' novalidate='novalidate'>
	                    <input type='hidden' name='reponsableInsp' id= 'reponsableInsp' value='" . $id_reponsableInsp . "'/>
	                    <input type='hidden' name='reponsableServ' id= 'reponsableServ' value='" . $Id_responsable . "'/>
						<input type='hidden' name='Nomb_reponsableServ' id= 'Nomb_reponsableServ' value='" . $responsable . "'/>
						<input type='hidden' name='correo_repServicio' id= 'correo_repServicio' value='" . $correo_resp . "'/>
						<input type='hidden' name='id_servicio' id= 'id_servicio' value=''/>
						<input type='hidden' id='seccion' name='seccion' value='0'/>

	                    <div> <h5 id= 'subtitulo' style='color:#1C4B62'>DATOS DE LA INSPECCION</h5></div>
	                    <div class='form-group row' id='div_Observaciones'>
		                  	<div class='col-sm-12 col-form-label text-sm-right pr-0'>
		                    	<label class='row'>
		                    		Observaciones  / Hallazgos  / Acciones Correctivas
		                    	</label>
		                    </div>
		                  	<div class='col-sm-12'>
	                   		   <textarea class='form-control' id='observacionesG' name='observacionesG' rows='4'></textarea>
	                   	    </div>
	                   	</div> 
	                    <div class='form-group row' id='div_datos'>
		                    <div class='col-sm-6 col-form-label text-sm-right pr-0'>
		                    	<label class='row'>
		                    		Responsable de la Inspección
		                    	</label>
		                    	<div class='row row-cols-1'>
			                  	 	" . $reponsableInsp . "
			                  	</div>
							</div>
		                  	<div class='col-sm-6 col-form-label text-sm-right pr-0'>
			                  	<label class='row'>
		                          Responsable del Area
		                        </label>
			                  	<div class='row'>
			                  	  " . $responsable . "
			                  	</div>
		                  	</div>
	              		</div>
              		</form>
                </div><!--End step-" . $count . "-->
            ";

			//$data_usua['c_tab'] = '';
			$this->load->helper('funciones_select');
			$data_usua['titulo'] = "Procesos";
			$data_usua['origen'] = "Administración";
			$data_usua['contenido'] = 'rondas/gestion';
			$data_usua['entrada_js'] = '_js/rondas.js';
			$data_usua['librerias_css'] = '<!-- CSS -->

	     	<link href="' . base_url('plugins/smartwizard@4.4.1/dist/css/smart_wizard.min.css') . '" rel="stylesheet" type="text/css" />
	     	<link href="' . base_url('plugins/smartwizard@4.4.1/dist/css/smart_wizard_theme_circles.min.css') . '" rel="stylesheet" type="text/css" />
		   	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
		    ';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
		   	<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
		   	<script src="' . base_url('plugins/interactjs@1.10.11/dist/interact.min.js') . '"></script>

		    <script src="' . base_url('plugins/smartwizard@4.4.1/dist/js/jquery.smartWizard.min.js') . '" type="text/javascript"></script>
			<script src="' . base_url('plugins/jquery-validation@1.19.3/dist/js/jquery.validate.min.js') . '" type="text/javascript"></script>
		    ';

			$this->load->view('template', $data_usua);
		}
	}


	public function cargar_informes()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$fechaini = $this->input->post('desde');
				$fechafin = $this->input->post('hasta');
				$consgen = $this->input->post('con');

				// var_dump($fechaini);
				// var_dump($fechafin);

				$tabla = '';
				$campos = ' "..", date_format(rg.fecha_insp, "%d/%m/%Y")AS "Fecha", rg.id AS "Id", ro.nombre AS "Ronda", se.nombre AS "Servicio", re.ubicacion AS "Ubicacion", COUNT(CASE WHEN re.respuesta = 1 THEN 1 END) AS "# Cumple", COUNT(CASE WHEN re.respuesta = 0 THEN 1 END) AS "# No Cumple" ';
				if ($consgen != 0) {

					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio', 're.estado = "1" AND DATE(rg.fecha_insp) BETWEEN "' . $fechaini . '" AND "' . $fechafin . '" GROUP BY  re.id_gestion, re.ubicacion', 'rg.fecha_insp', 0, 0);
					
				} else {
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio', 're.estado = "1" GROUP BY  re.id_gestion, re.ubicacion', 'rg.fecha_insp', 0, 0);
				}

				$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';

				$tabla .= '<th>..</th><th class="id">Id</th><th>Fecha</th><th>Ronda</th><th>Servicio</th><th>Ubicacion</th><th>% Cumple</th><th>%No Cumple</th><th>Acciones</th>';

				$tabla .= '</tr></thead><tbody class="post-rel">';

				foreach ($query->result_array() as $row) {
					
					$tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td class="id">' . $row['Id'] . '</td><td>' . $row['Fecha'] . '</td><td>' . $row['Ronda'] . '</td><td>' . $row['Servicio'] . '</td><td>' . $row['Ubicacion'] . '</td><td style="text-align: center" >' . $row['# Cumple'] .' - '. round($row['# Cumple'] / ($row['# Cumple']+ $row['# No Cumple'])*100,1) .'%</td><td style="text-align: center" >' . $row['# No Cumple'] .' - '. round($row['# No Cumple'] / ($row['# Cumple']+ $row['# No Cumple'])*100,1) .'%</td>';

					$tabla .= '<td class="text-nowrap" style="text-align: center" ><div class="action-buttons">
						<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Grafica" aria-describedby="tooltip' . $row['Id'] . '" id="btngrafica_' . $row['Id'] . '"> <i  id="btngrafica_' . $row['Id'] . '" class="fa fa-chart-pie text-105"><input type="hidden" id="nombre_' . $row['Id'] .'" name="nombre_' . $row['Id'] . '" value="' . $row['Id'] .'" /> </i> </a>
						</div></td>';
					$tabla .= '</tr>';
				}
				$tabla .= '</tbody>';
				echo $tabla;
			}
		}
	}

	/// Cargar Informes de Abherencia por Secciones / Preguntas ///
	public function cargar_adherencia()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id = $this->input->post('id_gestion');

				$id_ronda = $this->input->post('id_ronda');
				$id_servicio = $this->input->post('id_servicio');
				
				$fecha = $this->input->post('fecha');
				$fechaini = $this->input->post('fechaIniI');
				$fechafin = $this->input->post('fechaFinI');

				$acordeon = '';

				$ban = $this->input->post('ban');
				$beetfecha = $this->input->post('beetfecha');

				$campos = 'ro.nombre AS "Ronda", se.nombre AS "Servicio",  rs.id_seccion AS "Id_Seccion", rs.nombre AS "Seccion", re.ubicacion AS "Ubicacion", COUNT(CASE WHEN re.respuesta = 1 THEN 1 END) AS "Cumple", COUNT(CASE WHEN re.respuesta = 0 THEN 1 END) AS "No Cumple" ';

				if ($beetfecha == 0) {
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio', 'rg.id="' . $id . '" AND re.estado = "1"  GROUP BY rg.id, re.id_gestion, rp.id_seccion, re.ubicacion', 'rs.id_seccion', 0, 0);
				} else {
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio', 'rg.id_ronda = "' . $id_ronda . '" AND rg.id_servicio = "' . $id_servicio . '" AND re.estado = "1" AND DATE(rg.fecha_insp) BETWEEN "' . $fechaini . '" AND "' . $fechafin . '" GROUP BY re.id_gestion, rs.id_seccion, re.ubicacion', 'rs.id_seccion', 0, 0);
				}

				$campos1 = 're.id_respuesta AS "Id", rp.nombre AS "Pregunta", (CASE WHEN re.respuesta = 1 THEN "X" ELSE " " END) AS "Cumple", (CASE WHEN re.respuesta = 0 THEN "X" ELSE " " END) AS "No Cumple", (CASE WHEN re.respuesta = 2 THEN "X" ELSE " " END) AS "No Aplica", IFNULL(rer.imagen, " ") AS "Evidencia"';

				foreach ($query->result_array() as $row) {
					$acordeon .= '
					<div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
						<div class="card-body p-0">
							<div class="accordion" id="accordionSecciones_' . $row['Id_Seccion'] . '">
								<div class="card border-0 bgc-green-l5">';

					$acordeon .= '
									<div class="card-header border-0 bgc-transparent mb-0" id="secciones_' . $row['Id_Seccion'] . '">
										<h2 class="card-title bgc-transparent text-green-d2 brc-green">
										<a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapseSeccion_' . $row['Id_Seccion'] . '" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSeccion_' . $row['Id_Seccion'] . '">
											' . $row['Seccion'] . '
											
											<!-- the toggle icon -->
											<span class="px-3px d-inline-block brc-grey-l1 position-rc mr-5"> Cumple: ' . $row['Cumple'] .' - '. round($row['Cumple'] / ($row['Cumple']+ $row['No Cumple'])*100,1) .'%   |   No Cumple: ' . $row['No Cumple'] .' - '. round($row['No Cumple'] / ($row['Cumple']+ $row['No Cumple'])*100,1) .'%</span>
											<span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
												<i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
											</span>
											<span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
											<i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
										</span>
										</a>
										</h2>
									</div>';

					$acordeon .= '
										<div id="collapseSeccion_' . $row['Id_Seccion'] . '" class="collapse" aria-labelledby="secciones_' . $row['Id_Seccion'] . '" data-parent="#accordionSecciones_' . $row['Id_Seccion'] . '">
											<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
											<table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
												<thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
												 	<tr>
														<th class="id border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Items</th>
														<th class="id_servicio border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Cumple</th>
														<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">No Cumple</th>
														<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">No Aplica</th>
														<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acciones</th>
													</tr>
												</thead>

												<tbody class="post-rel">';
					if ($beetfecha == 0) {
						$query1 = $this->general_model->consulta_personalizada($campos1, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio LEFT JOIN rondas_evidencia_resp rer ON re.id_respuesta = rer.id_respuesta', 'rg.id="' . $id . '" AND  rp.id_seccion = "' . $row['Id_Seccion'] . '" AND re.estado = "1" ', '', 0, 0);
					} else {

						$query1 = $this->general_model->consulta_personalizada($campos1, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio LEFT JOIN rondas_evidencia_resp rer ON re.id_respuesta = rer.id_respuesta', 'rg.id_ronda = "' . $id_ronda . '" AND rg.id_servicio = "' . $id_servicio . '" AND  rp.id_seccion = "' . $row['Id_Seccion'] . '" AND re.estado = "1" AND DATE(rg.fecha_insp) BETWEEN "' . $fechaini . '" AND "' . $fechafin . '"', '', 0, 0);
					}
					foreach ($query1->result_array() as $row1) {
						$acordeon .= '<tr class="d-style bgc-h-default-l4">
										<td>' . $row1['Pregunta'] . '</td><td style="text-align: center" width="7%">' . $row1['Cumple'] . '</td><td style="text-align: center"  width="7%">' . $row1['No Cumple'] . '</td><td style="text-align: center" width="7%">' . $row1['No Aplica'] . '</td>';

						$acordeon .=  '<td class="text-nowrap" style="text-align: center" width="7%"><div class="action-buttons">
										<a href="#" class="text-green-m1 mx-1" data-toggle="tooltip" data-original-title="Detalle" id="btndetalle_' . $row1['Id'] . '"> <i id="btndetalle_' . $row1['Id'] . '" class="fa fa-book-open text-105"></i> </a> ';

						if($row1['Evidencia']!= " "){
							$acordeon .=  '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Evidencia" aria-describedby="tooltip' . $row1['Id'] . '" id="btnEvidencia_' . $row1['Evidencia'] . '"> <i  id="btnEvidencia_' . $row1['Evidencia'] . '" class="fa fa-file-image text-105"></i> </a>							
							';
						}

						if ($ban != 0 && $row1['No Cumple'] == "X") {
							$acordeon .=  '<a href="#" class="text-danger mx-1" data-toggle="tooltip" data-original-title="Acción Mejora" aria-describedby="tooltip' . $row1['Id'] . '" id="btnMejora_' . $row1['Id'] . '"> <i  id="btnMejora_' . $row1['Id'] . '" class="fa fa-edit text-105"></i> </a>
							';
						}



						$acordeon .= '</div></td></tr>';
					}
					$acordeon .= ' </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.card -->';
				}
				echo $acordeon;
			}
		}
	}


	public function cargar_inf_nocumple()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id_ronda = $this->input->post('id_ronda');
				$id_servicio = $this->input->post('id_servicio');				
				$fechaini = $this->input->post('fechaIniI');	
				$fechafin = $this->input->post('fechaFinI');	
				$fecha = $this->input->post('fecha');
				$tabla = '';


				$campos = 'rp.id_respuesta AS "Id", DATE(rg.fecha_insp) AS "Fecha Inspección", r.nombre AS "Ronda", s.nombre AS "Servicio", rs.nombre AS "Sección", rq.nombre AS "Pregunta", IFNULL(rer.imagen, " ") AS "Evidencia",IFNULL(pm.id_fuente,"")AS "plan"';

				//Consulta cuando todos los campos rondas, servicios, fecha inicio y fecha final son diferentes a vacio
				if ($fechaini != "" && $fechafin != "" && $id_ronda != "00" && $id_servicio != "00"){
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '" AND rg.id_servicio = "' . $id_servicio . '" AND DATE(rg.fecha_insp) BETWEEN "'.$fechaini.'" AND "'.$fechafin.'"', 'rg.fecha_insp', 0, 0);

				//Consulta cuando todos los campos rondas, fecha inicio y fecha final son diferentes a 00 o vacio y servicios es igual a 00	
				}elseif ($fechaini != "" && $fechafin != "" && $id_ronda != "00" && $id_servicio == "00"){
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '" AND DATE(rg.fecha_insp) BETWEEN "'.$fechaini.'" AND "'.$fechafin.'"', 'rg.fecha_insp', 0, 0);

				//Consulta cuando fecha inicio y fecha final son diferentes a 00 o vacio y los campos rondas y servicios son igual 00 
				}elseif ($fechaini != "" && $fechafin != "" && $id_ronda == "00" && $id_servicio == "00"){
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND DATE(rg.fecha_insp) BETWEEN "'.$fechaini.'" AND "'.$fechafin.'"', 'rg.fecha_insp', 0, 0);

				//Consulta cuando todos los campos rondas y servicios son diferentes a 00 y fecha inicio y fecha final es igual a vacio	
				}else if ($id_ronda != "00" && $id_servicio != "00" && $fechaini == "" && $fechafin == ""){
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '" AND rg.id_servicio = "' . $id_servicio . '"', 'rg.fecha_insp', 0, 0);

				//Consulta cuando todos el campo rondas es son diferentes a 00 y servicios, fecha inicio, fecha final es igual a vacio	
				}else if($id_ronda != "00" && $id_servicio == "00" && $fechaini == "" && $fechafin == ""){
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_ronda = "' . $id_ronda . '"', 'rg.id_ronda', 0, 0);	

				//Consulta cuando todos el campo rondas es igual a 00, servicios, fecha inicio y fecha final son diferentes a 00 o vacio	
				}else if ($id_servicio != "00" && $id_ronda == "00" && $fechaini == "" && $fechafin == ""){
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0 AND rg.id_servicio = "' . $id_servicio . '"', 'rg.id_servicio', 0, 0);
						
				//Consulta cuando todos el campo rondas y servicios son igual a 00, y fecha inicio y fecha final son diferentes a 00 o vacio
				}else {
					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rp INNER JOIN rondas_gestion rg ON rg.id_gestion = rp.id_gestion INNER JOIN rondas r ON rg.id_ronda = r.id_ronda INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion LEFT JOIN rondas_evidencia_resp rer ON rp.id_respuesta = rer.id_respuesta LEFT JOIN planes_mejoras pm ON pm.tipo_fuente = "0" and pm.id_fuente = rp.id_respuesta', 'rp.respuesta = 0', 'rg.id_ronda', 0, 0);	
					
				}

				$tabla = '<table id="nocumplimiento-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
							<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
				
				$tabla .= '	<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
							<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha Inspección</th>
							<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Ronda</th>
							<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Servicio</th>
							<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Sección</th>
							<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Pregunta</th>
							<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
							';	
				
				$tabla .= '</tr></thead><tbody class="post-rel">';
				
				foreach ($query->result_array() as $row)
    			{
    				$tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$row['Id'].'</td><td>'.$row['Fecha Inspección'].'</td><td>'.$row['Ronda'].'</td><td>'.$row['Servicio'].'</td><td>'.$row['Sección'].'</td><td>'.$row['Pregunta'].'</td>';
     				

       				$tabla .= '<td class="text-nowrap"><div class="action-buttons">
          					<a href="#" class="text-green-m1 mx-1" data-toggle="tooltip" data-placement="top" title="Detalle" id="btndetalle_' . $row['Id'] . '"> <i id="btndetalle_' . $row['Id'] . '" class="fa fa-book-open text-105"></i> </a>';
          			if($row['Evidencia']!= " "){
						$tabla .=  '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-placement="top" title="P_Mejora" aria-describedby="tooltip' . $row['Id'] . '" id="btnPlan_Mejora' . $row['plan'] . '"> <i  id="btnPlan_Mejora' . $row['plan'] . '" class="fa fa-list text-105"></i> </a>';
					}			

          			if($row['Evidencia']!= " "){
						$tabla .=  '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-placement="top" title="Evidencia" aria-describedby="tooltip' . $row['Id'] . '" id="btnEvidencia_' . $row['Evidencia'] . '"> <i  id="btnEvidencia_' . $row['Evidencia'] . '" class="fa fa-file-image text-105"></i> </a>';
					}			

					$tabla .=  '<a href="#" class="text-danger mx-1" data-toggle="tooltip" data-placement="top" title="Acción Mejora" aria-describedby="tooltip' . $row['Id'] . '" id="btnMejora_' . $row['Id'] . '"> <i  id="btnMejora_' . $row['Id'] . '" class="fa fa-edit text-105"></i> </a>';

     			 $tabla .= '</div></td></tr>'; 
    			}

    			$tabla .= '</tbody> </table>';   
    			echo $tabla;
			}
		}
	}

	public function listar_rondas()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				echo listar_rondas_tablas('WEB');
			}
		}
	}

	public function cargar_dRondas(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {

				$idreg = $this->input->post('idreg');

				$campos ='ro.id_ronda AS "Id", ro.nombre AS "Ronda", IFNULL(ro.id_proceso,"") AS "Id_Proceso",IFNULL(pr.nombre,"") AS "Proceso", ro.codigo_documento AS "Codigo", ro.id_responsable AS "Id_Responsable", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Responsable", ro.periocidad AS "Id_periocidad", CASE WHEN ro.periocidad = "0" THEN "MENSUAL" WHEN ro.periocidad = "1" THEN "BIMENSUAL" WHEN ro.periocidad = "2" THEN "TRIMESTRAL" WHEN ro.periocidad = "3" THEN "SEMESTRAL" WHEN ro.periocidad = "4" THEN "ANUAL" END AS "Periocidad", ro.n_veces AS "N_Veces" ';

				$query = $this->general_model->consulta_personalizada($campos, 'rondas ro LEFT JOIN procesos pr ON ro.id_proceso = pr.id_proceso INNER JOIN empleados em ON ro.id_responsable = em.id_empleado', 'ro.id_ronda ='.$idreg.'', 0, 0);
			}
		}
	}

	public function cargar_secciones()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$id = $this->input->post('id_ronda');

				$acordeon = '';

				
				$campos = 'rs.id_seccion AS "Id_Seccion", rs.nombre AS "Seccion"';

				
				$query = $this->general_model->consulta_personalizada($campos, 'rondas_seccion rs', 'rs.id_ronda="' . $id . '" AND rs.estado = "1" ', '', 0, 0);
				
					
				$campos1 = 'rp.id_items AS "Id", rp.nombre AS "Pregunta"';

				foreach ($query->result_array() as $row) {
					$acordeon .= '
					<div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
						<div class="card-body p-0">
							<div class="accordion" id="accordionSecciones_' . $row['Id_Seccion'] . '">
								<div class="card border-0 bgc-green-l5">';

					$acordeon .= '
									<div class="card-header border-0 bgc-transparent mb-0" id="secciones_' . $row['Id_Seccion'] . '">
										<h2 class="card-title bgc-transparent text-green-d2 brc-green">
										<a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapseSeccion_' . $row['Id_Seccion'] . '" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSeccion_' . $row['Id_Seccion'] . '">
											' . $row['Seccion'] . '
											
											<!-- the toggle icon -->
											
											<span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
												<i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
											</span>
											<span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
											<i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
										</span>
										</a>
										</h2>
									</div>';

					$acordeon .= '
										<div id="collapseSeccion_' . $row['Id_Seccion'] . '" class="collapse" aria-labelledby="secciones_' . $row['Id_Seccion'] . '" data-parent="#accordionSecciones_' . $row['Id_Seccion'] . '">
											<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
											<table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
												<thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
												 	<tr>
														<th class="id border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Items</th>
														<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acciones</th>
													</tr>
												</thead>

												<tbody class="post-rel">';
					
						$query1 = $this->general_model->consulta_personalizada($campos1, 'rondas_preguntas rp', 'rp.id_seccion = "' . $row['Id_Seccion'] . '" AND rp.estado = "1" ', '', 0, 0);
					
					foreach ($query1->result_array() as $row1) {
						$acordeon .= '<tr class="d-style bgc-h-default-l4">
										<td>' . $row1['Pregunta'] . '</td>';

						$acordeon .=  '<td class="text-nowrap" style="text-align: center" width="7%"><div class="action-buttons">
										<a href="#" class="text-green-m1 mx-1" data-toggle="tooltip" data-original-title="Detalle" id="btnEditarPr_' . $row1['Id'] . '"> <i id="btnEditarPr_' . $row1['Id'] . '" class="fa fa-pencil-alt text-105"></i> </a> ';

						$acordeon .= '</div></td></tr>';
					}
					$acordeon .= ' </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.card -->';
				}
				echo $acordeon;
			}
		}
	}


	public function cargar_detalle()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$resp = $this->input->post('idfuente');
				$campos = 'rgr.id_pregunta AS "Pregunta", rgr.observacion AS "Observaciones", rgr.hallazgo AS "Hallazgo", rgr.accion AS "Acciones", IFNULL(rer.imagen, " ") AS "Evidencia"';
				$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp rgr LEFT JOIN rondas_evidencia_resp rer ON rgr.id_respuesta = rer.id_respuesta ', 'rgr.id_respuesta ='.$resp.'', 0, 0);
				$form = '<form>';
				foreach ($query->result_array() as $row) {
					$form .= '<div class="form-group row ml-1">
							<label for="hallazgos" class="col-sm-12-form-label"><strong>Hallazgo</strong></label>
							<p class="col-sm-12" id="hallazgos">'.$row['Hallazgo'].'</p>
							
							<label for="observaciones " class="col-sm-12-form-label"><strong>Observaciones</strong></label>
							<p class="col-lg-12" id="observaciones">'.$row['Observaciones'].'</p>

							<label for="accion_inme" class="col-sm-12-form-label"><strong>Acción Inmediata</strong></label>
							<p class="col-lg-12" id="accion_inme">'.$row['Acciones'].'</p>
					
						</div>
					<hr>
					<div class="form-group row ml-1">
						<label for="acciones" class="col-sm-12"><strong>Acciones de Mejora</strong></label>
					';
					
					$campos1 = 'DATE(pm. fecha_registro) AS "Fecha", CASE WHEN pm.tipo_mejora = "1" THEN "Acción correctiva" WHEN pm.tipo_mejora = "2" THEN "Acción Preventiva" WHEN pm.tipo_mejora = "3" THEN "Oportunidad de mejora" END AS "Tipo de Acción", pm.accion_mejora AS "Acción Mejora", DATE(pm.fechamaxeje)AS "Fecha Ejecución", CASE WHEN pm.estado="0" THEN "Pendiente" WHEN pm.estado="1" THEN "En Gestión" WHEN pm.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';

					$query1 = $this->general_model->consulta_personalizada($campos1, 'planes_mejoras pm', 'id_fuente='.$resp.'', 0, 0);
					
					$form .= '<div class="card ccard row ml-1">
								<table class="table border-0 table-bordered brc-black-tp11 bgc-white">
									<thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
										<tr>
											<th>Fecha</th>
											<th>Tipo de Acción</th>
											<th>Descripción de la Acción</th>
											<th>Fecha Ejecución</th>
											<th>Estado</th>
										</tr>
									</thead>
									<tbody class="pos-detalle">';
					foreach ($query1->result_array() as $row1) {
						$form .= '<tr class="d-style bgc-h-default-l4">
						<td>'.$row1['Fecha'].'</td><td>'.$row1['Tipo de Acción'].'</td><td>'.$row1['Acción Mejora'].'</td><td>'.$row1['Fecha Ejecución']. '</td><td>'.$row1['Estado'].'</td>';

						$form .= '</tr>';
					}
					$form .= '</tbody></table></div></div>';
					$form .= '<div class="card ccard row">
								<img src="'.$row['Evidencia'].'" class="img-thumbnail" alt="No Tiene Evidencia">
						</div>
						<hr>';
				}
				$form .= '</form>';
				echo $form;
			}
		}
	}

	public function guardar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$registro = array(

					'nombre' => $this->input->post('nombre'),
					'id_proceso' => $this->input->post('procesos_rondas'),
					'codigo_documento' => $this->input->post('codigo'),
					'id_responsable' => $this->input->post('empleados_rondas'),
					'periocidad' => $this->input->post('periocidad'),
					'n_veces' => $this->input->post('veces'),
					'fecha_registro' => date('Y-m-d H:i:s'),
					'id_usuario_registra' => $this->session->userdata('C_id_usuario'),
					'estado' => '1'
				);

				$query = $this->general_model->insert('rondas', $registro);
				if ($query >= 1)
					echo '1';
				else {
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

	public function guardar_accion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$registro = array(

					'tipo_fuente' => '0',
					'id_fuente' => $this->input->post('idregistro'),
					'tipo_mejora' => $this->input->post('tipo_accion'),
					'accion_mejora' => $this->input->post('descripcion'),
					'responsable' => $this->input->post('coordinador_rondas'),
					'fechamaxeje' => $this->input->post('txtfechaE'),
					'fecha_registro' => date('Y-m-d H:i:s'),
					'usuario_registra' => $this->session->userdata('C_id_usuario'),
					'estado' => '0'
				);

				$query = $this->general_model->insert('planes_mejoras', $registro);
				if ($query >= 1)
					echo '1';
				else {
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

	public function guardar_gestion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$fecha = date('Y-m-d');
				$usuario = $this->session->userdata('C_id_usuario');
				$id_ronda = $this->input->post('id_ronda');
				$id_servicio = $this->input->post('id_servicio');
				$where = 'id_ronda ="' . $id_ronda . '" AND id_servicio = "' . $id_servicio . '" AND id_usuario= "' . $usuario . '" AND estado = "0"';

				$campos = 'id AS "Id_respuesta"';
				$query = $this->general_model->consulta_personalizada($campos, 'rondas_respuesta', $where, '', 0, 0);
				$query1 = 'OK';
				//var_dump($where);
				foreach ($query->result_array() as $row) {

					$registro = array(
						'estado' => '1',
					);

					$query1 = $this->general_model->update('rondas_respuesta', 'id', $row['Id_respuesta'], $registro);
				}

				if ($query1 == "OK")
					echo '1';
				else {
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

	public function guardar_gestion1()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$fecha = date('Ymd');
				$usuario = $this->session->userdata('C_id_usuario');
				
				$c_seccion = $this->input->post('seccion');
				$c_idronda = $this->input->post('id_ronda');
				$c_servicio = $this->input->post('id_servicio');
				$ubicacion = $this->input->post('ubicacion');
				$id_responsableServ = $this->input->post('reponsableServ');
				$nomResponsableServ = $this->input->post('Nomb_reponsableServ');
				$c_correo_respServ = $this->input->post('correo_repServicio');

				$id_gestion = $fecha . '' . $c_idronda . '' . $c_servicio . '' . $usuario;
				$registro = array(
					'id_gestion ' => $id_gestion,
					'id_ronda ' => $c_idronda,
					'id_servicio ' => $c_servicio,
					'id_seccion ' => $c_seccion,
					'Observaciones_hallazgos ' => $this->input->post('observacionesG'),
					'id_usuario_insp ' => $usuario,
					'fecha_insp' => date('Y-m-d H:i:s'),
					'estado' => '0'

				);
				$query = $this->general_model->insert('rondas_gestion', $registro);
				
				$id_solicitud = $query;

				if ($query >= 1) {
					$where = 'id_gestion ="' . $id_gestion . '" AND ubicacion = "' . $ubicacion . '" AND estado = "0"';

					$campos = 'id_respuesta AS "id_respuesta_gest"';

					$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp', $where, '', 0, 0);

					
					foreach ($query->result_array() as $row) {
						$registro = array(
							'estado' => '1',
						);
						$query = $this->general_model->update('rondas_gestion_resp', 'id_respuesta', $row['id_respuesta_gest'], $registro);
					}
				}
				if ($query == "OK"){
					//CORREO - NOTIFICACION DE LA GESTION DE LA RONDA //
					// $msg='';
					// $nombre_usuario ='';

					// $id_usuario = $usuario;

					// $nomResponsableServ;
					// $c_correo_respServ;
					// // $id_responsable = $this->input->post('id_responsableServ');


					// $campos2='IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Usuario"';
					// $query12 = $this->general_model->consulta_personalizada($campos2,'empleados', 'id_empleado = "'.$id_usuario.'"', '', 0, 0);
					// foreach ($query12->result_array() as $row)
					// {
					// 	$nombre_usuario = $row['Usuario'];
					// }

					// // $de="".$nomResponsableServ." <".$c_correo_respServ.">";
					// $de="cirugia@ceciminsigca.com,secirugia@colsanitas.com";
					// $Para ="".$nomResponsableServ." <".$c_correo_respServ.">";
					// //$Para ="germanparra2022@gmail.com,castonino17@gmail.com";
					// $Asunto ="Gestión Ronda de Seguridad";

					// $Cabeceras = "From:".$de."\r\n";
					// $Cabeceras .= "MIME-Version: 1.0\r\n";
					// $Cabeceras .= "Content-type: text/html; charset=utf-8\n";

					// $cuerpo = "<div><font size='3'>Señores,</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'>Programación de Cirugias,</font></div>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<div><font size='3'>El presente es para solicitar la programacion un cupo con los siguientes datos:</font></div>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Fecha de Cx:</b> ".$fecha_programacion."</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Hora de Cx:</b> ".$hora_programacion."</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Paciente	:</b> ".$paciente."</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Documento:</b> ".$cedula."</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Especialista:</b> ".$cirujano."</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Cirugía:</b> ".$procedimiento."</font></div>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<br>\r\n";
					// $cuerpo .= "<div><font size='3'><b>Solicita:</b> ".$usuario."</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'>Por favor Gestionar solicitud</font></div>\r\n";
					// $cuerpo .= "<div><font size='3'>Gracias por su colaboración y gestión</font></div>\r\n";
					// $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://ceciminsigca.com/assets/image/logo-cecimin.png'/>";
					// $cuerpo .= "<br>\r\n";

					// $msg = $this->sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras);
					// if($msg=1){
					// 	$query = 1;
					// }else{
					// 	$query =-999;
					// }
					$id_solicitud = $id_gestion;
					$tipo_notificacion="10";
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					$id_usuario_2= 4;

					$observacion ="Observaciones y Hallazgos de la Ronda: ".$this->input->post('observacionesG').", Gestion N°".$id_solicitud;
					
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
						//Guardar Tarea
				}
				// if($query2 >= 1) {
				// 	$descripcion="";
				// 	$id_usuario_asigna = $this->session->userdata('C_id_usuario');
				// 	$id_usuario_tarea = 4;
				// 	if($this->input->post('tipo_solicitud')==1){
				// 		$descripcion ="Gestionar Solicitud documento ".$this->input->post('nombre').", Solicitud N°".$query1;
				// 	}elseif($this->input->post('tipo_solicitud')==2){
				// 		$descripcion ="Gestionar modificacion documento ".$this->input->post('nombre').", Solicitud N°".$query1;
				// 	}else{
				// 		$descripcion ="Gestionar Solicitud N°".$this->input->post('idreg');
				// 	};

				// 	$registro3=array(
				// 		'tipo_tarea' =>'Gestionar Solicitud',
				// 		'id_modulo' =>'0',
				// 		'descripcion'=>$descripcion,
				// 		'id_solicitud' =>$id_solicitud,
				// 		'id_usuario_asigna'=>$id_usuario_asigna,
				// 		'id_usuario_tarea'=>$id_usuario_tarea,
				// 		'estado'=>'0',
				// 		'fecha_registro'=>$fecha
				// 	);

				// 	$query = $this->general_model->insert('tareas', $registro3);
				if($query >= 1) {
					echo '1';
				}
				else {
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

	public function guardar_temp()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$c_seccion = $this->input->post('seccion');
				$c_idronda = $this->input->post('id_ronda');
				$c_count = $this->input->post('count');

				$c_preguntas = $this->input->post('preguntas_' . $c_count);
				//$i= 1;
				$valor = 0;
				for ($i = 1; $i <= $c_preguntas; $i++) {
					$id_pregunta = $this->input->post('id_pregunta_' . $c_count . '-' . $i);

					$ruta = './fotosListaChequeos';

					if ($_FILES["file_" . $id_pregunta . '-' . $c_count]["tmp_name"]) {
						$fecha = date('YmdHis');
						$foto_temp = $_FILES["file_" . $id_pregunta . '-' . $c_count]["tmp_name"];

						$NombreOriginal = $c_idronda . '-' . $c_seccion . '-' . $fecha . '-' . str_replace(' ', '-', str_replace('_', '-', $_FILES["file_" . $id_pregunta . '-' . $c_count]['name']));
						$temporal = $foto_temp;
						$Destino = $ruta . '/' . $NombreOriginal;

						move_uploaded_file($temporal, $Destino);
					} else {
						$Destino = '';
					}

					$registro = array(

						'fecha' => date('Y-m-d H:i:s'),
						'id_ronda' => $c_idronda,
						'id_seccion' => $c_seccion,
						'id_servicio' => $this->input->post('id_servicio'),
						'ubicacion' => $this->input->post('ubicacion'),
						'id_pregunta' => $id_pregunta,
						'respuesta' => $this->input->post('respuesta_' . $id_pregunta . '_' . $c_count),
						'observacion' => $this->input->post('observaciones_' . $id_pregunta . '_' . $c_count),
						'hallazgo' => $this->input->post('hallazgos_' . $id_pregunta . '_' . $c_count),
						'accion' => $this->input->post('acciones_' . $id_pregunta . '_' . $c_count),
						'imagen' => $Destino,
						'id_usuario' => $this->session->userdata('C_id_usuario'),
						'estado' => '0'
					);

					//print_r($registro);
					$query = $this->general_model->insert('rondas_respuesta', $registro);
					if ($query >= 1) {
						$valor = 1;
					} else {
						echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
						switch ($query) {
							case "1062":
								echo "El centro ingresada, ya se encuentra registrado; Por favor verifique los datos!";
								break;
							default:
								echo "Error: " . $query . " => " . $this->db->_error_message();
								break;
						}
						echo '</div>';
						exit();
					}
				}
				echo $valor;
			}
		}
	}

	public function guardar_temp1()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";

				$fecha = date('Ymd');
				$usuario_insp = $this->session->userdata('C_id_usuario');
				$c_seccion = $this->input->post('seccion');
				$c_idronda = $this->input->post('id_ronda');
				$c_servicio = $this->input->post('id_servicio');
				$c_count = $this->input->post('count');
				$ubicacion = $this->input->post('ubicacion');
				$c_preguntas = $this->input->post('preguntas_' . $c_count);
				$id_gestion = $fecha . '' . $c_idronda . '' . $c_servicio . '' . $usuario_insp;
				//$i= 1;

				$query1 = 1;
				$valor = 0;
				for ($i = 1; $i <= $c_preguntas; $i++) {
					$id_pregunta = $this->input->post('id_pregunta_' . $c_count . '_' . $i);

					$ruta = './fotosListaChequeos';

					$registro = array(
						'id_gestion' => $id_gestion,
						'ubicacion' => $ubicacion,
						'id_pregunta' => $id_pregunta,
						'respuesta' => $this->input->post('respuesta_' . $id_pregunta . '_' . $c_count),
						'observacion' => $this->input->post('observaciones_' . $id_pregunta . '_' . $c_count),
						'hallazgo' => $this->input->post('hallazgos_' . $id_pregunta . '_' . $c_count),
						'accion' => $this->input->post('acciones_' . $id_pregunta . '_' . $c_count),
						'usuario' => $this->session->userdata('C_id_usuario'),
						'estado' => '0'
					);

					//print_r($registro);
					$query = $this->general_model->insert('rondas_gestion_resp', $registro);

					if ($query >= 1) {

						if ($_FILES["file_" . $id_pregunta . '_' . $c_count]["tmp_name"]) {
							$fecha = date('YmdHis');
							$foto_temp = $_FILES["file_" . $id_pregunta . '_' . $c_count]["tmp_name"];

							$NombreOriginal = $c_idronda . '-' . $c_seccion . '-' . $fecha . '-' . str_replace(' ', '-', str_replace('_', '-', $_FILES["file_" . $id_pregunta . '_' . $c_count]['name']));
							$temporal = $foto_temp;
							$Destino = $ruta . '/' . $NombreOriginal;

							move_uploaded_file($temporal, $Destino);
							$registro1 = array(

								'id_respuesta' => $query,
								'imagen' => $Destino,
								'estado' => '0'
							);
	
							//print_r($registro);
							$query = $this->general_model->insert('rondas_evidencia_resp', $registro1);
						} else {
							$Destino = '';
						}

					}
				}
				if ($query >= 1) {
						$valor = 1;
				} else {
						echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
						switch ($query) {
							case "1062":
								echo "El centro ingresada, ya se encuentra registrado; Por favor verifique los datos!";
								break;
							default:
								echo "Error: " . $query . " => " . $this->db->_error_message();
								break;
						}
						echo '</div>';
						exit();
					}
			}
			echo $valor;
		}
	}

	public function datos_grafica()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			$campos = 'date_format(rg.fecha_insp, "%d/%m/%Y")AS "Fecha", rg.id AS "Id", ro.nombre AS "Ronda", se.nombre AS "Servicio", re.ubicacion AS "Ubicacion", COUNT(CASE WHEN re.respuesta = 1 THEN 1 END) AS "Cumple", COUNT(CASE WHEN re.respuesta = 0 THEN 1 END) AS "No Cumple"';
			
			$query = $this->general_model->consulta_personalizada($campos, 'rondas_gestion_resp re INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio', 're.estado = "1" AND rg.id="'.$id.'" GROUP BY  rg.id, re.id_gestion, re.ubicacion', '', 0, 0);
			$row = $query->row_array();

			$arr['datosGrafica'] = array('ronda' => $row['Ronda'], 'servicio' => $row['Servicio'], 'ubicacion' => $row['Ubicacion'], 'cumple' => $row['Cumple'], 'noCumple' => $row['No Cumple']);
			echo json_encode($arr);
		}
	}

	public function eliminar_respuesta()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$fecha = date('Ymd');
				$usuario_insp = $this->session->userdata('C_id_usuario');
				
				$c_idronda = $this->input->post('id_ronda');
				$c_servicio = $this->input->post('id_servicio');
				$id_gestion = $fecha . '' . $c_idronda . '' . $c_servicio . '' . $usuario_insp;

				$sql_delete = "DELETE FROM rondas_gestion_resp WHERE id_gestion = ".$id_gestion." AND  estado = '0' ";
				$query = $this->general_model->consulta_select($sql_delete);

				echo '1';
			}
		}
	}

	public function excel()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			$filename = "Listado_Procesos.xls";
			header("Content-Disposition: attachment; filename=" . $filename);
			header("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

			echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE PROCESOS</th></tr></table><br>');

			echo '<table border="1">';
			echo utf8_decode(listar_procesos_tabla('EXCEL'));
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
				$query = $this->general_model->update('rondas', 'id_ronda', $this->input->post('idreg'), $registro);
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

	public function modificar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			//$sql="SELECT nombre, id_responsable, estado  FROM centroscostos WHERE id_centrocosto = '$id' ";
			$query = $this->general_model->select_where('id_ronda, nombre, id_proceso, codigo_documento, id_responsable, periocidad, n_veces,  estado', 'rondas', array('id_ronda' => $id));
			$row = $query->row_array();

			$arr['rondas'] = array('ronda' => $row['id_ronda'], 'nombre' => $row['nombre'], 'proceso' => $row['id_proceso'], 'codigo' => $row['codigo_documento'], 'responsable' => $row['id_responsable'], 'periocidad' => $row['periocidad'], 'veces' => $row['n_veces'], 'estado' => $row['estado']);
			echo json_encode($arr);
		}
	}

	public function datos_respuestas()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			//$sql="SELECT nombre, id_responsable, estado  FROM centroscostos WHERE id_centrocosto = '$id' ";
			$campos = 'r.nombre AS "Ronda", s.nombre AS "Servicio", rs.nombre AS "Seccion", rq.nombre AS "Pregunta", rp.observacion AS "Observacion", rp.hallazgo AS "Hallazgo"';

			$query = $this->general_model->consulta_personalizada($campos, 'rondas r INNER JOIN rondas_gestion rg ON rg.id_ronda = r.id_ronda INNER JOIN rondas_gestion_resp rp ON rg.id_gestion = rp.id_gestion INNER JOIN servicios s ON rg.id_servicio = s.id_servicio INNER JOIN rondas_preguntas rq ON rp.id_pregunta = rq.id_items INNER JOIN rondas_seccion rs ON rq.id_seccion = rs.id_seccion', 'rp.id_respuesta =' . $id . '', '', 0, 0);

			$row = $query->row_array();

			$arr['datos_resp'] = array('ronda' => $row['Ronda'], 'servicio' => $row['Servicio'], 'seccion' => $row['Seccion'], 'pregunta' => $row['Pregunta'], 'observacion' => $row['Observacion'], 'hallazgo' => $row['Hallazgo']);
			echo json_encode($arr);
		}
	}

	
	public function actualizar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$registro = array(

					'nombre' => $this->input->post('nombre'),
					'id_proceso' => $this->input->post('procesos_rondas'),
					'codigo_documento' => $this->input->post('codigo'),
					'id_responsable' => $this->input->post('empleados_rondas'),
					'periocidad' => $this->input->post('periocidad'),
					'n_veces' => $this->input->post('veces'),
					'estado' => $this->input->post('estado')
				);

				$query = $this->general_model->update('rondas', 'id_ronda', $this->input->post('idregistro'), $registro);
				if ($query == "OK")
					echo '1';
				else {
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
			} //-Valida Envio por ajax
		} //-Valida Inicio de Session
	}

	public function cargar_rondas()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {


				$campos = 'id_ronda AS "Id", nombre AS "Nombre"';

				$query = $this->general_model->consulta_personalizada($campos, 'rondas', 'estado = "1"', '', 0, 0);
				$tabla = '';

				$tabla .= '<div class="card-body bg-white border-1 border-t-1 brc-primary-m4">
                        <div class="row d-flex mx-3 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">';

				foreach ($query->result_array() as $row) {

					$tabla .= ' <div class="col-12 col-sm-3 px-2">
                           <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-85 text-primary align-items-center" id="btnronda_' . $row['Id'] . '">
                             	<input class="invisible pos-abs" name="ronda_' . $row['Id'] . '" type="radio" value="' . $row['Id'] . '"/>
                             	' . $row['Nombre'] . '
                           </button>
                        </div> ';
				}

				$tabla .= '</div></div>';

				echo $tabla;
			}
		}
	}

	public function listar_secciones()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('id_ronda');

				$campos = 'id_seccion AS "id", nombre AS "Nombre"';
				$query = $this->general_model->consulta_personalizada($campos, 'rondas_seccion', ' id_ronda = "' . $idreg . '" ', '', 0, 0);

				$encabezado = array();
				$i = 1;
				$tabla = '';
				foreach ($query->result_array() as $row) {
					$tabla .= '<div class="container">
					<div class="row">' .
						$i++ . form_label($row['Nombre'] . ' ', '', array('class' => 'control-label text-left col-md-10')) . '
		              	</div>
		            </div></div>';
				}
				echo $tabla;
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

				$campos = ' r.id_ronda AS "Id", r.nombre AS "Nombre", p.nombre AS "Proceso", r.codigo_documento AS "Código",IFNULL(CONCAT(e.nombres, e.apellidos),"") AS "Responsable", CASE WHEN r.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';

				$query = $this->general_model->consulta_personalizada($campos, 'rondas r LEFT JOIN  procesos p ON r.id_proceso = p.id_proceso LEFT JOIN empleados e ON r.id_responsable = e.id_empleado', ' r.id_ronda = "' . $idreg . '" ', '', 0, 0);

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
}
