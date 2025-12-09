<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cc_costosg extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');

		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect(base_url());			
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
		}
	}

	//CARGAR PAGINA DE INICIO
	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Costos Generales";
			$data_usua['origen']="Costos y Gastos";
			$data_usua['contenido']='c_costosg/index';
			$data_usua['entrada_js']='_js/c_costosg.js';
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
    		<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>


    		';

			$this->load->view('template',$data_usua);


		}
	}

	//CARGAR LA PAGINA NUEVO
	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {

			

		}
	}

	//CARGAR LA PAGINA MODIFICAR
	public function modificar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');
			
			//$sql="SELECT nombre, id_responsable, estado  FROM centroscostos WHERE id_centrocosto = '$id' ";
			$query=$this->general_model->select_where('id_manoobra_presta, periodo, id_cargo, numero_cargos, tipo_vinculacion, id_empleados, salario_estandar, salario_promedio, valor_empleado_year, tiempo_contratado, valor_hora, tiempo_ufc, costo_total_ufc, estado', 'c_manoobra_presta', array('id_manoobra_presta' => $id) );
			$row = $query->row_array();
				
			$arr['mano_obra_presta'] = array('id_manoobra_presta'=>$row['id_manoobra_presta'], 'periodo'=>$row['periodo'], 'id_cargo'=>$row['id_cargo'], 'numero_cargos'=>$row['numero_cargos'], 'tipo_vinculacion'=>$row['tipo_vinculacion'],  'id_empleados'=>$row['id_empleados'], 'salario_estandar'=>$row['salario_estandar'], 'salario_promedio'=>$row['salario_promedio'], 'valor_empleado_year'=>$row['valor_empleado_year'], 'tiempo_contratado'=>$row['tiempo_contratado'], 'valor_hora'=>$row['valor_hora'], 'tiempo_ufc'=>$row['tiempo_ufc'], 'costo_total_ufc'=>$row['costo_total_ufc'], 'estado'=>$row['estado'], 'estado'=>$row['estado']);
			echo json_encode( $arr );
		}
	}

	//GUARDAR INFORMACION
	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$registro=array(
					
					'periodo'=>$this->input->post('periodo'),
					'id_cargo'=>$this->input->post('cargos_costos'), 
					'id_empleados'=>$this->input->post('empleados_costos'),
					'numero_cargos'=>$this->input->post('numero_cargos'),
					'tipo_vinculacion'=>$this->input->post('tipo_vinculacion'),
					'salario_estandar'=>$this->input->post('salario_estandar'), 
					'salario_promedio'=>$this->input->post('salario_promedio'), 
					'valor_empleado_year'=>$this->input->post('valor_empleado_year'), 
					'tiempo_contratado'=>$this->input->post('tiempo_contratado'), 
					'valor_hora'=>$this->input->post('valor_hora'), 
					'tiempo_ufc'=>$this->input->post('tiempo_ufc'),
					'costo_total_ufc'=>$this->input->post('costo_total_ufc'), 
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('c_manoobra_presta', $registro);
			}if($query >= 1) {
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

	//ACTUALIZAR INFORMACION
	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$id_manoobra_presta	= $this->input->post('idregistro');

				$registro=array(
					'periodo'=>$this->input->post('periodo'),
					'id_cargo'=>$this->input->post('cargos_costos'), 
					'id_empleados'=>$this->input->post('empleados_costos'),
					'numero_cargos'=>$this->input->post('numero_cargos'),
					'tipo_vinculacion'=>$this->input->post('tipo_vinculacion'),
					'salario_estandar'=>$this->input->post('salario_estandar'), 
					'salario_promedio'=>$this->input->post('salario_promedio'), 
					'valor_empleado_year'=>$this->input->post('valor_empleado_year'), 
					'tiempo_contratado'=>$this->input->post('tiempo_contratado'), 
					'valor_hora'=>$this->input->post('valor_hora'), 
					'tiempo_ufc'=>$this->input->post('tiempo_ufc'),
					'costo_total_ufc'=>$this->input->post('costo_total_ufc'), 
					'estado'=>$this->input->post('estado')
				);

				$query = $this->general_model->update('c_manoobra_presta','id_manoobra_presta', $id_manoobra_presta, $registro);
				
			}if($query === "OK") {
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

	//VER REGISTROS
	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

			}
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
				echo listar_costosgenerales_tabla('WEB');
			}
		}
	}

	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				
				$idreg = $this->input->post('idreg');

				$registro=array('estado'=>'0');

				$query = $this->general_model->update('c_manoobra_presta','id_manoobra_presta', $idreg, $registro);
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


}