<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cc_manoobraplanta extends CI_Controller {
	
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

			$data_usua['titulo']="Mano de Obra de Planta";
			$data_usua['origen']="Costos y Gastos";
			$data_usua['contenido']='c_manoobraplanta/index';
			$data_usua['entrada_js']='_js/c_manoobraplanta.js';
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
			$query=$this->general_model->select_where('id_manoobra, periodo, id_cargo, numero_cargos, valor_salario, valor_parafiscales, valor_pension, valor_salud, valor_arl, valor_cesantias, valor_prima, valor_vacaciones, valor_icesantias, valor_auxtrasporte, valor_dotacion, estado', 'c_manoobra_planta', array('id_manoobra' => $id) );
			$row = $query->row_array();
				
			$arr['mano_obra_planta'] = array('id_manoobra'=>$row['id_manoobra'], 'periodo'=>$row['periodo'], 'id_cargo'=>$row['id_cargo'], 'numero_cargos'=>$row['numero_cargos'], 'valor_salario'=>$row['valor_salario'], 'valor_parafiscales'=>$row['valor_parafiscales'], 'valor_pension'=>$row['valor_pension'], 'valor_salud'=>$row['valor_salud'], 'valor_arl'=>$row['valor_arl'], 'valor_cesantias'=>$row['valor_cesantias'], 'valor_prima'=>$row['valor_prima'], 'valor_vacaciones'=>$row['valor_vacaciones'], 'valor_icesantias'=>$row['valor_icesantias'], 'valor_auxtrasporte'=>$row['valor_auxtrasporte'], 'valor_dotacion'=>$row['valor_dotacion'], 'estado'=>$row['estado'], 'estado'=>$row['estado']);
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
					'numero_cargos'=>$this->input->post('numero_cargos'),
					'valor_salario'=>$this->input->post('valor_salario'), 
					'valor_parafiscales'=>$this->input->post('valor_parafiscales'), 
					'valor_pension'=>$this->input->post('valor_pension'), 
					'valor_salud'=>$this->input->post('valor_salud'), 
					'valor_arl'=>$this->input->post('valor_arl'), 
					'valor_cesantias'=>$this->input->post('valor_cesantias'), 
					'valor_prima'=>$this->input->post('valor_prima'), 
					'valor_vacaciones'=>$this->input->post('valor_vacaciones'), 
					'valor_icesantias'=>$this->input->post('valor_icesantias'),
					'valor_auxtrasporte'=>$this->input->post('valor_auxtrasporte'),
					'valor_dotacion'=>$this->input->post('valor_dotacion'), 
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('c_manoobra_planta', $registro);
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
				$registro=array(
										
					'periodo'=>$this->input->post('periodo'),
					'id_cargo'=>$this->input->post('cargos_costos'), 
					'numero_cargos'=>$this->input->post('numero_cargos'),
					'valor_salario'=>$this->input->post('valor_salario'), 
					'valor_parafiscales'=>$this->input->post('valor_parafiscales'), 
					'valor_pension'=>$this->input->post('valor_pension'), 
					'valor_salud'=>$this->input->post('valor_salud'), 
					'valor_arl'=>$this->input->post('valor_arl'), 
					'valor_cesantias'=>$this->input->post('valor_cesantias'), 
					'valor_prima'=>$this->input->post('valor_prima'), 
					'valor_vacaciones'=>$this->input->post('valor_vacaciones'), 
					'valor_icesantias'=>$this->input->post('valor_icesantias'),
					'valor_auxtrasporte'=>$this->input->post('valor_auxtrasporte'),
					'valor_dotacion'=>$this->input->post('valor_dotacion'), 
					'estado'=>$this->input->post('estado')
				);

				$query = $this->general_model->update('c_manoobra_planta','id_manoobra', $this->input->post('idregistro'), $registro);
				
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
				echo listar_cmanoobrap_tabla('WEB');
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
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('c_manoobra_planta','id_manoobra', $this->input->post('idreg'), $registro);
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