<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_calendario extends CI_Controller
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

	//CARGAR PAGINA DE INICIO
	public function index()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo'] = "Calendario de Mantenimiento";
			$data_usua['origen'] = "Gestión de Mantenimientos";
			$data_usua['contenido'] = 'mantenimiento/index';
			$data_usua['entrada_js'] = '_js/m_calendar.js';
			$data_usua['librerias_css'] = '<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="' . base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css') . '">

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/select2@4.1.0-rc.0/select2.min.css') . '">
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/chosen-js@1.8.7/chosen.min.css') . '">
			
			<link rel="stylesheet" type="text/css" href="' . base_url('plugins/fullcalendar@5.6.0/main.min.css') . '">';

			$data_usua['librerias_js'] = '<!-- Sweet-Alert  -->
			
    		<script src="' . base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js') . '"></script>
    		<script src="' . base_url('dist/js/moment.min.js') . '"></script>
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
    		<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
    		<script src="' . base_url('plugins/bootbox@5.5.2/bootbox.all.min.js') . '"></script>
    		<script src="' . base_url('plugins/fullcalendar@5.6.0/main.min.js') . '"></script>
    		';

			$this->load->view('template', $data_usua);
		}
	}
	//CARGAR MANTENIMIENTOS PROGRAMADOS
	public function cargar_mantenimientos()
	{
		/*if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {*/
		header('Content-Type: application/json');

		$campos = 'id_programacionm AS "id", title AS "title", TIMESTAMP(fecha_programacion_I) AS "start",  TIMESTAMP(fecha_programacion_F) AS "end", classN AS "className"';

		$query = $this->general_model->consulta_personalizada($campos, 'mantenimientos_programacion', 'estado="0"', '', 0, 0);

		$arr = array();

		foreach ($query->result_array() as $row) {
			$start = explode(" ", $row['start']);
			$end = explode(" ", $row['end']);
			if ($start[1] == '00:00:00') {
				$start = $start[0];
			} else {
				$start = $start[0] . ',' . $start[1];
			}
			if ($end[1] == '00:00:00') {
				$end = $end[0];
			} else {
				$end = $end[0] . ',' . $end[1];
			}
			$arr[] = array('id' => $row['id'], 'title' => $row['title'], 'start' => $start, 'end' => $end, 'allDay' => 'true', 'className' => $row['className']);
		}

		echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	} //-Valida Envio por ajax
	/*}//-Valida Inicio de Session
	}*/

	//CARGAR LA PAGINA NUEVO
	public function nuevo()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect();
		} else {
		}
	}

	//CARGAR LA PAGINA MODIFICAR
	public function modificar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');
			$campos= 'mp.id_programacionm AS "Id", ms.id_solicitud AS "Id Solicitud", ms.id_manterimientor AS "Id_Mantenimiento", mr.nombre AS "Mantenimiento", ms.id_servicio AS "Id_Servicio", se.nombre AS "Servicio", ms.ubicacion AS "Ubicacion", ms.otros_mantenimientos AS "Otro", ms.observaciones AS "Observaciones", ms.id_solicitante AS "Id_Solicitante", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Solicitante", em.email AS "Correo_Solicitante",mp.tipo_mantenimiento AS "Tipo Mantenimiento", ms.estado AS "Estado"';
			$query = $this->general_model->consulta_personalizada($campos,'mantenimientos_solicitudes ms INNER JOIN mantenimientos_programacion mp ON ms.id_solicitud=mp.id_solicitudm INNER JOIN mantenimientos_servicios mr ON ms.id_manterimientor=mr.id_servicio INNER JOIN servicios se ON ms.id_servicio=se.id_servicio INNER JOIN empleados em ON ms.id_solicitante=em.id_empleado','mp.id_programacionm ='.$id.'', '', 0, 0);
			$row = $query->row_array();

			$arr['mantenimiento'] = array('Id' => $row['Id'], 'id_solicitud'=>$row['Id Solicitud'], 'Mantenimiento'=>$row['Mantenimiento'],'Id_Mantenimiento'=>$row['Id_Mantenimiento'],'Id_Servicio'=>$row['Id_Servicio'],'Ubicacion'=>$row['Ubicacion'],'Otro'=>$row['Otro'],'Observaciones'=>$row['Observaciones'],'Id_Solicitante'=>$row['Id_Solicitante'], 'Correo_Solicitante'=>$row['Correo_Solicitante'],'Tipo_Mantenimiento'=>$row['Tipo Mantenimiento'], 'Estado'=>$row['Estado']);
			echo json_encode( $arr );
		}
	}

	//GUARDAR INFORMACION
	public function guardar_programacion()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				//echo "ingreso";
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

				$fecha = date('Y-m-d H:i:s');

				$registro = array(
					'tipo_solicitud' => "8",
					'id_manterimientor' => $this->input->post('rservicio'),
					'id_servicio' => $this->input->post('servicio'),
					'otros_mantenimientos' => $this->input->post('otroM'),
					'otro_servicio' => $this->input->post('servicio'),
					'observaciones' => $this->input->post('observaciones'),
					'id_solicitante' => $this->input->post('coordinador_jefeinm'),
					'fecha_solicitud' => $fecha,
					'estado' => '1'
				);

				$query = $this->general_model->insert('mantenimientos_solicitudes', $registro);

				$registro1 = array(
					'id_solicitudm' => $query,
					'title' => $query . "/" . $this->input->post('nombreservicio'),
					'fecha_programacion_I' => $this->input->post('fechaMInicial'),
					'fecha_programacion_F' => $this->input->post('fechaMfin'),
					'classN' => $claseN,
					'observaciones_p' => $this->input->post('observaciones'),
					'fecha_registro' => $fecha,
					'estado' => '0'
				);

				$query1 = $this->general_model->insert('mantenimientos_programacion', $registro1);

				// --------------- Guardar Notificación  -------------------\\

				if ($query1 >= 1) {
					$id_solicitud = $query;
					$tipo_notificacion = "8";
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					$id_usuario_2 = $this->input->post('coordinador_jefeinm');
					$observacion = "Solicitud N°" . $query . " - " . $this->input->post('nombre') . " Servicio:" . $this->input->post('nombreservicio');

					$registro2 = array(
						'tipo_notificacion' => $tipo_notificacion,
						'id_solicitud' => $id_solicitud,
						'id_usuario_notifica' => $id_usuario_notifica,
						'id_usuario_2' => $id_usuario_2,
						'observacion' => $observacion,
						'estado' => '0',
						'fecha_registro' => $fecha
					);

					$query2 = $this->general_model->insert('notificaciones', $registro2);
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

	public function eventResize(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$id_solicitud = $this->input->post('id');
				$fechaInicio = $this->input->post('fecha_inicio');
				$fechaFinal = $this->input->post('fecha_final');

				$registro = array(

					'fecha_programacion_I' =>$fechaInicio,
					'fecha_programacion_F' =>$fechaFinal 
				);

				$query = $this->general_model->update('mantenimientos_programacion', 'id_solicitudm ', $id_solicitud, $registro);
			}
			if ($query == "OK") {
				echo '1';
			} else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
				switch ($query) {
					case "1062":
						echo "El Mantenimiento ingresado, ya se encuentra registrado; Por favor verifique los datos!";
						break;
					default:
						echo "Error: " . $query . " => " . $this->db->_error_message();
						break;
				}
				echo '</div>';
			}
		}
	}

	//ACTUALIZAR INFORMACION
	public function actualizar()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "")
			redirect();
		else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//CODIGO AQUI

			}
			if ($query === "OK") {
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

	//VER REGISTROS
	public function ver_registro()
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario') == "") {
			redirect(base_url());
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');
			}
		}
	}
}
