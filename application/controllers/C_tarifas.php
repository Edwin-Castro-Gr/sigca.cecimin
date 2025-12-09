<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_tarifas extends CI_Controller {
	
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
			$data_usua['contenido']='tarifas/index';
			$data_usua['entrada_js']='_js/tarifas.js';
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

			$data_usua['titulo']="Nueva Solicitud de Ingreso";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='tarifas/nuevo';
			$data_usua['entrada_js']='_js/tarifas.js';
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

			$data_usua['c_id_tarifa'] = $id;
			$data_usua['c_id_convenio'] = '';
			$data_usua['c_year_convenio'] = '';
			$data_usua['c_entidad'] = '';
			$data_usua['c_plan'] = '';
			$data_usua['c_fecha_inicio'] = '';
			$data_usua['c_fecha_final'] = '';
			$data_usua['c_redondeo'] = '';
			$data_usua['c_uvr_qx_int'] = '';
			$data_usua['c_uvr_qx_mod'] = '';
			$data_usua['c_quimio_int'] = '';
			$data_usua['c_quimio_mod'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuarioA'] = '';
			$data_usua['c_id_usuarioR'] = '';

			$campos='id_tarifa AS "Id", id_convenio AS "Id_Convenio", año_convenio AS "Año", compañia AS "Entidad", plan AS "Plan", fecha_inicio AS "FechaI", fecha_final AS "FechaF", CASE WHEN redondeo = "0" THEN "Unidad" WHEN redondeo = "1" THEN "Decena" WHEN redondeo = "2" THEN "Centena" END  AS "Redondeo", uvr_qx_int AS "Uvr_int", uvr_qx_mod_ban_med AS "Uvr_Mod", quimio_int AS "Quimio_Int", quimio_mod_ban_med AS "Quimio_Mod", id_usuario_registra AS "UsuarioR", estado AS "Estados"';

			$query = $this->general_model->consulta_personalizada($campos,'tarifas', 'id_tarifa ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_convenio'] = $row['Id_Convenio'];
				$data_usua['c_year_convenio'] = $row['Año'];
				$data_usua['c_entidad'] = $row['Entidad'];
				$data_usua['c_plan'] = $row['Plan'];
				$data_usua['c_fecha_inicio'] = $row['FechaI'];
				$data_usua['c_fecha_final'] = $row['FechaF'];
				$data_usua['c_redondeo'] = $row['Redondeo'];
				$data_usua['c_uvr_qx_int'] = $row['Uvr_int'];
				$data_usua['c_uvr_qx_mod'] = $row['Uvr_Mod'];
				$data_usua['c_quimio_int'] = $row['Quimio_Int'];
				$data_usua['c_quimio_mod'] = $row['Uvr_Mod'];
				$data_usua['c_estado'] = $row['Estados'];
				$data_usua['c_id_usuarioA'] = $this->session->userdata('C_id_usuario');
				$data_usua['c_id_usuarioR'] = $row['UsuarioR'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Modificar Solicitud";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='tarifas/modificar';
			$data_usua['entrada_js']='_js/tarifas.js';
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
			$data_usua['contenido']='tarifas/consultas';
			$data_usua['entrada_js']='_js/tarifas.js';
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

	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$usuario=$this->session->userdata('C_id_usuario');
				$this->load->helper('funciones_tabla');
				echo listar_tarifas_tabla('WEB',$usuario);
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
				$año = date('Y',$fecha);
				
				$registro=array(

					'id_tipocontrato'=>$this->input->post('tiposcontratos_contratos'),
					'id_funcionario'=>$this->input->post('idfuncionario'),
					'id_cargo'=>$this->input->post('cargos_contratos'),
					'id_centrocosto'=>$this->input->post('centroscostos_contratos'),
					'id_area'=>$this->input->post('areas_contratos'),
					'jefe_inmediato'=>$this->input->post('empleados_jefeinm'),
					'prorroga'=>$this->input->post('idprorroga'),
					'fecha_inicio'=>$this->input->post('fechainicio'),
					'fecha_final'=>$this->input->post('fechafinal'),
					'fecha_registro'=>$fecha,
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'estado'=>$this->input->post('estado')
				);
				$query = $this->general_model->insert('tarifas', $registro);
				if($query >= 1) {
					echo '1';
					$dir = $año.'Cont-'.$query.'-';
					if (!file_exists('tarifas/')) {
						mkdir('tarifas/', 0777, true);
						if (!file_exists('tarifas/'.$this->session->userdata('C_basedatos').'/')) {
							mkdir('tarifas/'.$this->session->userdata('C_basedatos').'/', 0777, true);
							if (!file_exists('tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
								mkdir('tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
							}
						}
					} elseif (!file_exists('tarifas/'.$this->session->userdata('C_basedatos').'/')) {
						mkdir('tarifas/'.$this->session->userdata('C_basedatos').'/', 0777, true);
						if (!file_exists('tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
							mkdir('tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
						}
					} else if (!file_exists('tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
							mkdir('tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
					}

					$ruta = 'tarifas/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';

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
							$Destino = $ruta.$nombre;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
						
							move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada		
							
							$this->session->set_userdata('archivo_origen',$Destino);
							
							
							$mensage .= 'cargado';

							$registro1 = array(
								'id_contrato'=>$query,
								'archivo'=>$Destino,
								'id_checklist_contratos'=>$id_check_contrato[1],
								'fecha_ini_vigencia'=>$this->input->post('fecha_inicio_'.$id_check_contrato[1]),
								'fecha_fin_vigencia'=>$this->input->post('fecha_final_'.$id_check_contrato[1]),
								'fecha_registro'=>$fecha,
								'id_usuario'=>$this->session->userdata('C_id_usuario'),
								'estado'=>'1'
							);
							$query1 = $this->general_model->insert('contratos_anexos', $registro1);
						}
						
						if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
						{
							$mensage .= '-'.$key['error'].'-';
						}
					}
				}if($query >= 1){
					$id_solicitud = "Cont-".$query;
					$tipo_notificacion=1;
					$id_usuario_notifica = $this->session->userdata('C_id_usuario');
					$id_usuario_notificado= $this->input->post('empleados_jefeinm');
					
					$observacion ="Se Creo el Contrato N° ".$id_solicitud;						

					$registro2=array(
						'tipo_notificacion'=>$tipo_notificacion,
						'id_solicitud' =>$id_solicitud,
						'id_usuario_notifica'=>$id_usuario_notifica, 
						'id_usuario_2'=>$id_usuario_notificado, 
						'observacion'=>$observacion, 
						'estado'=>'0',
						'fecha_registro'=>$fecha				
					);

					$query2 = $this->general_model->insert('notificaciones', $registro2);

					echo '1';
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
					$estado = $this->input->post('estado');
					$dir ='Cont-'.$query.'-'.$this->input->post('empleados_contratos');						

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
							"upload_path" => $rutag,
							"allowed_types" => "*"
						];

						$this->load->library('upload', $config); 
          				$this->upload->initialize($config);
						
						if($this->upload->do_upload('anexo_prorroga')){
							$data = array('upload_data' => $this->upload->data());
							$archivo= $ruta.$data['upload_data']['file_name'];
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
						$dir ='Cont-'.$query.'-'.$this->input->post('empleados_contratos');						

						$ruta = 'contratos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
					
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
								$Destino = $ruta.$nombre;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	

								move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada	

								$this->session->set_userdata('archivo_origen',$Destino);
								$mensage .= 'cargado';

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
            echo utf8_decode(listar_tarifas_tabla('EXCEL')); 
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
            	$query = $this->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_contrato AS "id_contrato" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN contratos ct ON ct.id_cargo=cc.id_cargo) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_contrato=ca.id_contrato', ' t1.id_contrato = "'.$idreg.'" ', '', 0, 0);

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
			                              '.$row1['Cargo'].' - '.$row1['Centro Costos'].' - <strong>'.$row1['Empleado'].'</strong>
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
}


