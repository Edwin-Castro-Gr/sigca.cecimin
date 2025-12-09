<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_seguimientocx extends CI_Controller {
	
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

	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$usuario_perfil = $this->session->userdata('C_perfil');
				$usuario = $this->session->userdata('C_id_usuario');
				$this->load->helper('funciones_tabla');
				echo listar_pcirugia_tabla('WEB',$usuario,$usuario_perfil);
			}
		}
	}

	public function index() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {
			
				$this->load->helper('funciones_select');
				$this->load->helper('funciones_chk');

				$data_usua['titulo']="Programación Cirugía";
				$data_usua['origen']="Cirugia";
				$data_usua['contenido']='seguimientocx/index';
				$data_usua['entrada_js']='_js/seguimientocx.js';
				$data_usua['librerias_css']='<!-- DataTables -->
				<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">			
				<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">

				<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
				<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
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

				<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
	    		<script src="'.base_url('plugins/chosen-js@1.8.7/chosen.jquery.min.js').'"></script>
			    <script src="'.base_url('dist/js/jquery.datetimepicker.full.min.js').'"></script>';

				$this->load->view('template',$data_usua);
			
		}
	}

	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		} else {

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			
			$data_usua['c_usuario']=$this->session->userdata('C_id_usuario');
			$data_usua['c_perfil']=$this->session->userdata('C_perfil');
			$data_usua['titulo']="Programación Cirugía";
			$data_usua['origen']="Cirugias";
			$data_usua['contenido']='seguimientocx/nuevo';
			$data_usua['entrada_js']='_js/seguimientocx.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<!--link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'" -->
			<!--link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'" -->

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			
			<!-- DateTimePicker  -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css').'">
			<!-- ColorPicker  -->
			
			';

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
			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>

		    <script src="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.js').'"></script> 
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    
		    
		    
		   <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function modificar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
		redirect(base_url());
		else {

			$data_usua['c_id_cirugia'] = $id;
			$data_usua['c_idpaciente'] = '';
			$data_usua['c_paciente'] = '';
			$data_usua['c_edad'] = '';
			$data_usua['c_genero'] = '';
			$data_usua['c_servicio'] = '';
			$data_usua['c_telefono'] = '';
			$data_usua['c_direccion'] = '';
			$data_usua['c_id_eps'] = '';
			$data_usua['c_id_entidad'] = '';
			$data_usua['c_fecha_Cx'] = '';
			$data_usua['c_hora_Cx'] = '';		
			$data_usua['c_procedimiento'] = '';
			$data_usua['c_id_cirujano'] = '';	
			$data_usua['c_id_anest'] = '';	
			$data_usua['c_tipoAnestesia'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_tiempo'] = '';

			$data_usua['c_llamadas'] = '';
			$data_usua['c_usuario'] = '';

			$campos ='id_cirugia, id_paciente, nombres, edad, genero, servicio, Telefono_paciente, direccion, id_eps, id_entidad, fecha_Cx, hora_Cx, procedimiento, id_cirujano, id_anest, tipoAnestesia, tiempo, llamadas, estado, usuario';
			$query = $this->general_model->consulta_personalizada($campos,'p_curso_cx', 'id_cirugia = "'.$id.'"', '', 0, 0);
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_cirugia'] = $id;
				$data_usua['c_idpaciente'] = $row['id_paciente'];
				$data_usua['c_paciente'] = $row['nombres'];
				$data_usua['c_edad'] = $row['edad'];
				$data_usua['c_genero'] = $row['genero'];				
				$data_usua['c_servicio'] = $row['servicio'];
				$data_usua['c_telefono'] = $row['Telefono_paciente'];
				$data_usua['c_direccion'] = $row['direccion'];
				$data_usua['c_id_eps'] = $row['id_eps'];
				$data_usua['c_id_entidad'] = $row['id_entidad'];
				$data_usua['c_fecha_Cx'] = $row['fecha_Cx'];
				$data_usua['c_hora_Cx'] = $row['hora_Cx'];		
				$data_usua['c_procedimiento'] = $row['procedimiento'];		
				$data_usua['c_id_cirujano'] = $row['id_cirujano'];		
				$data_usua['c_id_anest'] = $row['id_anest'];	
				$data_usua['c_tipoAnestesia'] = $row['tipoAnestesia'];
				$data_usua['c_estado'] = $row['estado'];
				$data_usua['c_tiempo'] = $row['tiempo'];
				$data_usua['c_llamadas'] = $row['llamadas'];
				$data_usua['c_usuario'] = $row['usuario'];
			}			

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['c_perfil']=$this->session->userdata('C_perfil');
			$data_usua['titulo']="Agendamiento Salas de Cirugía";
			$data_usua['origen']="Cirugias";
			$data_usua['contenido']='seguimientocx/modificar';
			$data_usua['entrada_js']='_js/seguimientocx.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<!--link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'" -->
			<!--link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'" -->

			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-star-rating@4.0.6/css/star-rating.min.css">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">
			
			<!-- DateTimePicker  -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css').'">
			<!-- ColorPicker  -->
			
			<link rel="stylesheet" type="text/css" href=" '.base_url('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css').'">
			';

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
			<script src="'.base_url('plugins/free-jqgrid@4.15.5/jquery.jqgrid.src.min.js').'"></script>
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-maxlength@1.10.0/dist/bootstrap-maxlength.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.7.0/distribute/nouislider.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/ion-rangeslider@2.3.1/js/ion.rangeSlider.min.js"></script>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap-touchspin@4.3.0/dist/jquery.bootstrap-touchspin.min.js"></script>

		    <script src="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.js').'"></script> 
		    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
		    <script src="'.base_url('plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js').'"></script>
		    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>
		    <script src="'.base_url('_js/dom.js').'"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function guardar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$fecha = date('Y-m-d H:i:s');
				$registro=array(
					'id_paciente'=>$this->input->post('cedula'),
					'nombres'=>$this->input->post('paciente'),
					'edad'=>$this->input->post('edad'),
					'Telefono_paciente'=>$this->input->post('telefono'),	
					'direccion'=>$this->input->post('direccion'),	
					'id_eps'=>$this->input->post('eps_pacientes'),
					'id_entidad'=>$this->input->post('entidad'),	
					'genero'=>$this->input->post('genero'),					
					'servicio'=>$this->input->post('servicio'),
					'fecha_Cx'=>$this->input->post('fechaprogramacion'),
					'hora_Cx'=>$this->input->post('horaprogramacion'),
					'procedimiento'=>$this->input->post('procedimientos_seguimiento'),
					'id_cirujano'=>$this->input->post('cirujano_programacion'),
					'id_anest'=>$this->input->post('anestesiologo_programacion'),
					'tipoAnestesia'=>$this->input->post('tipo_anestesia'),	
					'tiempo'=>$this->input->post('tiempohoras'),		
					'llamadas'=>$this->input->post('num_llamada'),			
					'estado'=>'0',
					'usuario'=>$this->session->userdata('C_id_usuario')
				);
				//echo var_dump($registro);
				$query = $this->general_model->insert('p_curso_cx', $registro);
				// echo '1';

				if($query >=1){
					echo '1';					
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;
					}
					echo '</div>';
				}
			}
		}
	}


	public function guardar_seguimientoqx() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$fecha = date('Y-m-d H:i:s');
				$idprog = $this->input->post('idregistro');
				$num_llamada = $this->input->post('num_llamada');
				$cierre = $this->input->post('cierre');
				//var_dump($idprog);
				$query='';
				
				if($num_llamada == "0"){

					$fechallamada = $this->input->post('fechallamada');
					
					$cuales = $this->input->post('cuales');
					$fecha_control = $this->input->post('fecha_control');
					$observaciones = $this->input->post('observaciones');
					$informo = $this->input->post('informo');
					$q_informa = $this->input->post('familiar');
					$auxiliares = $this->input->post('auxiliares_seguimiento');
					
					
					$responde1 = $this->input->post('responde1');

					$dolor ='0';
					if($this->input->post('ckdolorSi') == "on"){
						$dolor='1';
					}

					$sangrado ='0';
					if($this->input->post('cksangradoSi') == "on"){
						$sangrado='1';
					}

					$otrosS ='0';
					if($this->input->post('ckotrosSi') == "on"){
						$otrosS='1';
					}

					$registro = array(

						'id_p_cirugia' =>$idprog,
						'fecha_llamada' =>$fechallamada,
						'responde' =>$responde1,
						'dolor'=>$dolor,
						'sangrado'=>$sangrado,
						'otros_sintomas'=>$otrosS,
						'cuales'=>$cuales,
						'fecha_control'=>$fecha_control,
						'observaciones'=>$observaciones,
						'informo_paciente'=>$informo,
						'informa'=>$q_informa,
						'id_funcionario_llama'=>$auxiliares,
						'fecha_registro'=>$fecha
					);

					$query = $this->general_model->insert('p_seguimiento_L1', $registro);

					$registro1 = array(
						'llamadas' =>'1',
						'estado' => '1'
					);

					$query2 = $this->general_model->update('p_curso_cx', 'id_cirugia', $idprog, $registro1);

				}elseif ($num_llamada == "1"){

					$fechallamada =  $this->input->post('fechallamada2');
					$responde1 = $this->input->post('responde2');
					$cuales = $this->input->post('cuales2');
					$observaciones = $this->input->post('observaciones2');
					$informo = $this->input->post('informo2');
					$q_informa = $this->input->post('familiar2');
					$auxiliares = $this->input->post('auxiliares_seguimientoSL');

					$Fmedicamentos ='0';
					if($this->input->post('ckFmedicamentosSi') == "on"){
						$Fmedicamentos ='1';
					}elseif($this->input->post('ckFmedicamentosNoAp') == "on"){
						$Fmedicamentos ='2';
					}

					$calor ='0';
					if($this->input->post('ckcalorSi') == "on"){
						$calor='1';
					}

					$rubor ='0';
					if($this->input->post('ckruborSi') == "on"){
						$rubor='1';
					}
					
					$inflamacion ='0';
					if($this->input->post('ckinflamacionSi') == "on"){
						$inflamacion='1';
					}
					
					$secrecion ='0';
					if($this->input->post('cksecrecionSi') == "on"){
						$secrecion='1';
					}


					$otrosS ='0';
					if($this->input->post('ckotrosSSi') == "on"){
						$otrosS='1';
					}

					$Fcontroles ='0';
					if($this->input->post('ckFcontrolesSi') == "on"){
						$Fcontroles='1';
					}
					

					$registro=array(

						'id_p_cirugia'=>$idprog,
						'fecha_llamada2'=>$fechallamada,
						'responde2'=>$responde1,
						'finalizo_medicamentos'=>$Fmedicamentos,
						'calor'=>$calor,
						'rubor'=>$rubor,
						'inflamacion'=>$inflamacion,
						'secrecion'=>$secrecion,
						'otros_signos'=>$otrosS,
						'cuales2'=>$cuales,
						'finalizo_controles2'=>$Fcontroles,
						'observacion2'=>$observaciones,
						'informo_paciente'=>$informo,
						'informo'=>$q_informa,
						'id_auxiliar_llamo'=>$auxiliares,
						'fecha_registro'=>$fecha
					);

					$query = $this->general_model->insert('p_seguimiento_L2', $registro);


					if($cierre == "" || $cierre == "0"){
						$registro1 = array(
							'llamadas' =>'2',
							'estado' => '1'
						);
					}else{
						$registro1 = array(
							'llamadas' =>'2',
							'estado' => '2'
						);
					}					

					$query2 = $this->general_model->update('p_curso_cx', 'id_cirugia', $idprog, $registro1);

				}elseif($num_llamada == "2"){

					if($cierre == "1"){
						$registro1 = array(
							'llamadas' =>'3',
							'estado' => '2'
						);

						$fechallamada =  $this->input->post('fechallamada3');
						$responde1 = $this->input->post('responde3');					
						$observaciones = $this->input->post('observaciones3');
						$informo = $this->input->post('informoT3');
						$q_informa = $this->input->post('familiarT3');
						$auxiliares = $this->input->post('auxiliares_seguimientoTL');

						$registro=array(

							'id_p_cirugia'=>$idprog,
							'fecha_llamada'=>$fechallamada,
							'responde'=>$responde1,
							'observaciones'=>$observaciones,
							'informo_paciente'=>$informo,
							'informo'=>$q_informa,
							'id_auxiliar_llamo'=>$auxiliares,
							'fecha_registro'=>$fecha
						);
						$query = $this->general_model->insert('p_seguimiento_L3', $registro);

					}else{
						$registro1 = array(
							'llamadas' =>'2',
							'estado' => '2'
						);
						
						$query = $idprog;
					}	
					$query2 = $this->general_model->update('p_curso_cx', 'id_cirugia', $idprog, $registro1);
				}
				if($query >= 1){
					
				// }if($query=="OK"){
					echo "1";
				} else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
						case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function guardar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				//echo "ingreso";
				$registro=array(

					'id_tipodocumento'=>$this->input->post('Tipo_docidentidad_pacientes'),
					'numero_id'=>$this->input->post('numero_id'),
					'nombres'=>$this->input->post('nombres'),
					'apellidos'=>$this->input->post('apellidos'),
					'edad'=>$this->input->post('edad'),
					'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),
					'id_entidad_salud'=>$this->input->post('eps_pacientes'),
					'otra_entidad_salud'=>$this->input->post('otra_eps'),
					'telefono'=>$this->input->post('telefono'),
					'correo'=>$this->input->post('correo'),
					'fecha_registro'=>date('Y-m-d H:i:s'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'1'
				);

				$query = $this->general_model->insert('pacientes', $registro);
				if($query >= 1)
					echo '1';
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

	public function modificar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');
			
			//$sql="SELECT nombre, id_responsable, estado  FROM centroscostos WHERE id_centrocosto = '$id' ";
			$query=$this->general_model->select_where('id_paciente, id_tipodocumento, numero_id, nombres, apellidos, fecha_nacimiento, id_entidad_salud, otra_entidad_salud, telefono, correo, estado', 'pacientes', array('id_paciente' => $id));
			$row = $query->row_array();
				
			$arr['pacientes'] = array('id_paciente'=>$row['id_paciente'], 'id_tipodocumento'=>$row['id_tipodocumento'], 'numero_id'=>$row['numero_id'],'nombres'=>$row['nombres'],'apellidos'=>$row['apellidos'], 'fecha_nacimiento'=>$row['fecha_nacimiento'], 'id_entidad_salud'=>$row['id_entidad_salud'], 'otra_entidad_salud'=>$row['otra_entidad_salud'], 'telefono'=>$row['telefono'], 'correo'=>$row['correo'],  'estado'=>$row['estado']);
			echo json_encode( $arr );
		}
	}

	public function actualizar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();
		}else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}else {
				//echo "ingreso";
				$id=$this->input->post('idregistropa');

				$registro=array(

					'id_tipodocumento'=>$this->input->post('Tipo_docidentidad_pacientes'),
					'numero_id'=>$this->input->post('numero_id'), 
					'nombres'=>$this->input->post('nombres'), 
					'apellidos'=>$this->input->post('apellidos'),
					'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),	
					'id_entidad_salud'=>$this->input->post('eps_pacientes'),
					'otra_entidad_salud'=>$this->input->post('otra_eps'),
					'telefono'=>$this->input->post('telefono'),				
					'correo'=>$this->input->post('correo'),
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 					
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('pacientes', 'id_paciente', $id, $registro);
				if($query=="OK")
					echo '1';
				else {
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


	private function addPdfHeader($pdf) {
	    // $pdf->SetFont('helvetica','B',10);
        // $pdf->SetTextColor(0,0,0);
       	// Configurar fuentes y colores

       	$this->load->helper('funciones_pdf');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetTextColor(0, 0, 0); // Color negro

		// Primera línea: Código en la izquierda
		$pdf->SetFont('Arial', '', 8);
		$pdf->SetXY(160, 15);
		$pdf->Cell(20, 5, utf8_decode('Código:'), 1, 0, 'C');
		$pdf->Cell(0, 5, utf8_decode('PRC-PR-FO-08'), 1, 1, 'C');

		// Logo centrado - usando nuestra función personalizada
		cellWithImage($pdf, 'assets/image/logoCeciminActas.png', 55, 20, 15, 15, 0, 1);

		// Texto "SEGUIMIENTO A PACIENTES DE" en la derecha
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetXY(70, 15);
		
		$pdf->MultiCell(90, 10, utf8_decode('SEGUIMIENTO A PACIENTES DE PROCEDIMIENTOS'), 1, 'C');	
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
		$pdf->Cell(0, 5, '1/03/2025', 1, 1, 'C');


		// Tercera línea: Página en la esquina inferior derecha del encabezado
		$pdf->SetXY(160, 30);
		$pdf->Cell(20, 5, 'Pagina:', 1, 0, 'C');
		$pdf->Cell(0, 5, $pdf->PageNo().' de {nb}', 1, 1, 'C');

		// Línea separadora
		$pdf->Line(15, 40, 200, 40);

		// Espacio después del encabezado
		$pdf->SetY(45);
	}

	public function seguimiento_pdf($id_proce) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			 // Limpiar buffers completamente
			$entidad ="";                             
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
		        $pdf = new AdvancedHtmlToPdf ('L', 'mm', 'LETTER');
		        $pdf->tipo = "0";
		        $pdf->AliasNbPages();
		        
		        $pdf->hoja = 'LETTER';
		        $pdf->SetTitle("SIGCA - Seguimiento a Pacientes de Procedimientos", true);
		        $pdf->SetAutoPageBreak(true, 15);
	       		$pdf->SetMargins(15, 40, 15);
		         // === Página 1 ===
		        $pdf->AddPage('P', 'LETTER');
		         //Encabezado informe
		        $this->addPdfHeader($pdf);        
	       		

	       		$campos ='ps.id_cirugia, ps.id_paciente, ps.nombres, ps.edad, ps.Telefono_paciente, ps.id_eps, ps.id_entidad, DATE_FORMAT(ps.fecha_Cx, "%d/%m/%Y" ) AS fecha_Cx, TIME_FORMAT(ps.hora_Cx,"%H:%i") AS hora_Cx, px.nombre, IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Cirujano", IF(ps.tipoAnestesia != 0, IFNULL(CONCAT(an.nombres, " ", an.apellidos), " "), "") AS "Anestesiologo", ps.tipoAnestesia, ps.tiempo, ps.llamadas, ps.estado, ps.usuario';
	            $query = $this->general_model->consulta_personalizada($campos, 'p_curso_cx ps INNER JOIN empleados ci ON ps.id_cirujano = ci.id_empleado INNER JOIN procedimientos_cx px ON ps.procedimiento = px.id_procedimiento LEFT JOIN empleados an ON ps.id_anest = an.id_empleado', 'ps.id_cirugia ='.$id_proce.'', '', 0, 0);
	        	
	        	$data_seguimiento = $query->result();
	            
	            foreach ($data_seguimiento as $row) {

			        $pdf->SetFont('Arial', 'B', 8);
			       
			        $pdf->SetFillColor(177,179,179);
			        $pdf->Cell(34, 6, 'DATOS DEL PACIENTE', 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 8);
			        $pdf->Cell(50, 6, 'NOMBRE (Apellidos y Nombre(s))', 1, 0, 'C',true);
			        $pdf->SetFont('Arial', '', 8);
			        $pdf->Cell(80, 6, $row->nombres, 1, 0, 'C',false);
			        $pdf->Cell(10, 6, 'EDAD', 1, 0, 'C',true);
			        $pdf->Cell(0, 6, $row->edad, 1, 1, 'C',false);
			        $pdf->Cell(27, 6, 'HISTORIA CLINICA', 1, 0, 'C',true);
			        $pdf->Cell(20, 6, $row->id_paciente, 1, 0, 'C',false);
			        $pdf->Cell(20, 6, 'TELEFONO	', 1, 0, 'C',true);
			        $pdf->Cell(20, 6, $row->Telefono_paciente, 1, 0, 'C',false);
			        $pdf->Cell(20, 6, 'ENTIDAD', 1, 0, 'C',true);

			        switch ($row->id_entidad) {
					   
					    case '1': $entidad = 'ASISDERMA';
					        break;
					    case '2': $entidad = 'BANCO REPUBLICA';
					        break;
					    case '3': $entidad = 'COLSANITAS';
					        break;
					    case '4': $entidad = 'COLSANITAS BANCO DE LA REPUBLICA';
					        break;
					    case '5': $entidad = 'COLSANITAS BANCO REPUBLICA';
					        break;
					    case '6': $entidad = 'COLSANITAS BAVARIA';
					        break;
					    case '7': $entidad = 'COLSANITAS CERREJON';
					        break;
					    case '8': $entidad = 'COLSANITAS MINTIC';
					        break;
					    case '9': $entidad = 'COLSANITAS MODULAR';
					        break;
					    case '10':$entidad = 'COLSANITAS PLAN MODULAR';
					        break;
					    case '11': $entidad = 'EPS SANITAS';
					        break;
					    case '12': $entidad = 'MEDISANITAS';
					        break;
						case '13': $entidad = 'PANAMERICANA LIFE';
					        break;
					    case '14': $entidad = 'PARTICULAR';
					        break;
					    case '15': $entidad = 'SEGUROS BOLIVAR';
					        break; 
					    case '16': $entidad = 'SEGUROS BOLIVAR POLIZA DE SALUD';
					        break; 
					    case '17': $entidad = 'SEGUROS BOLIVAR POLIZA SALUD';
					        break;   
					    default: $entidad = 'UNISALUD';
					        break;
					} 
			        $pdf->Cell(0, 6, utf8_decode($entidad), 1, 1, 'C',false);

			        $pdf->Cell(0, 6, 'PROCEDIMIENTO', 1, 1, 'C',true);
					$pdf->MultiCell(0, 6, utf8_decode($row->nombre), 'LTRB', 'L');
			        $pdf->Cell(15, 6, 'FECHA ', 1, 0, 'C',true);
			        $pdf->Cell(20, 6, $row->fecha_Cx, 1, 0, 'C',false);
			        $pdf->Cell(10, 6, 'HORA', 1, 0, 'C',true);
			        $pdf->Cell(10, 6, $row->hora_Cx, 1, 0, 'C',false);
			        $pdf->Cell(23, 6, 'ESPECIALISTA', 1, 0, 'C',true);
			        $pdf->Cell(0, 6, utf8_decode($row->Cirujano), 1, 1, 'C',false);
			        $pdf->Ln(2);
					
			      	if($row->llamadas =="3"){
				      	//Encabezado fila Llamadas

			      		$campos1 ='DATE_FORMAT(ls1.fecha_llamada,"%d/%m/%Y") AS fecha_L1, ls1.responde, ls1.dolor, ls1.sangrado, ls1.otros_sintomas, ls1.cuales, DATE_FORMAT(ls1.fecha_control,"%d/%m/%Y") AS fcontrol_L1, ls1.observaciones, ls1.informo_paciente, ls1.informa, IFNULL(CONCAT(em.nombres, " ", em.apellidos), " ") AS "Auxiliar"';
				      	
				      	$queryL1 = $this->general_model->consulta_personalizada($campos1, 'p_seguimiento_L1 ls1 INNER JOIN empleados em ON ls1.id_funcionario_llama = em.id_empleado', 'ls1.id_p_cirugia ='.$id_proce.'', '', 0, 0);
				      	
				      	$data_llamadas1 = $queryL1->result();
	            
		            	foreach ($data_llamadas1 as $rowL1) {	
					      	$pdf->Cell(0, 6, 'PRIMERA LLAMADA ', 1, 1, 'C',true);
					      	$pdf->Cell(0, 2, "", 1, 1, 'C',false);

					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Fecha', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL1->fecha_L1, 1, 1, 'C',false);

					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(80, 6, 'Sintomas', 1, 0, 'C',true);
					      	$pdf->Cell(50, 6, 'Si ', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, 'No ', 1, 1, 'C',true);

					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Dolor ', 1, 0, 'C',true);

					      	if($rowL1->dolor =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);	
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);			      		
					      	}

					      	$pdf->Cell(80, 6, 'Sangrado', 1, 0, 'C',true);
					      	if($rowL1->sangrado =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);	
					      	}

					      	$pdf->Cell(80, 6, 'Otros sintomas', 1, 0, 'C',true);

					      	if($rowL1->otros_sintomas =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);	
					      	}

					      	$pdf->Cell(80, 6, "Cuales", 1, 0, 'C',true);			      	
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->cuales), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, 'Fecha Control', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL1->fcontrol_L1, 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, "Observaciones", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->observaciones), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Información Dada por:"), 1, 0, 'C',true);
					      	if ($rowL1->informo_paciente == "1"){
					      		$pdf->Cell(0, 6, utf8_decode('Familiar'), 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(0, 6, utf8_decode('Paciente'), 1, 1, 'C',false);
					      	}
					      	
					      	$pdf->Cell(80, 6, utf8_decode("Nombre Quien Informó"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->informa), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Funcionario Que Realizó la LLamada"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->Auxiliar), 1, 1, 'C',false);

					      	$pdf->Ln(3);
					    }  	
					      	//Segunda llamada 
					    	$pdf->Ln(2);
						$campos2 ='DATE_FORMAT(ls2.fecha_llamada2, "%d/%m/%Y") AS fecha_L2, ls2.responde2, ls2.finalizo_medicamentos, ls2.calor, ls2.rubor, ls2.inflamacion, ls2.secrecion, ls2.otros_signos, ls2.cuales2, ls2.finalizo_controles2, ls2.observacion2, ls2.informo_paciente, ls2.informo, IFNULL(CONCAT(em.nombres, " ", em.apellidos), " ") AS "Auxiliar"';
				      	
				      	$queryL2 = $this->general_model->consulta_personalizada($campos2, 'p_seguimiento_L2 ls2 INNER JOIN empleados em ON ls2.id_auxiliar_llamo = em.id_empleado', 'ls2.id_p_cirugia ='.$id_proce.'', '', 0, 0);

						$data_llamadas2 = $queryL2->result();
	            
		            	foreach ($data_llamadas2 as $rowL2) {	

					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(0, 6, 'SEGUNDA LLAMADA ', 1, 1, 'C',true);			      	
					      	
					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Fecha', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL2->fecha_L2, 1, 1, 'C',false);
							
					      	$pdf->Cell(80, 6, 'Finalizo Medicamentos', 1, 0, 'C',true);
					      	$pdf->Cell(20, 6, 'Si ', 1, 0, 'C',true);
					      	
					      	if($rowL2->finalizo_medicamentos =="1"){
					      		$pdf->Cell(6, 6, "X", 1, 0, 'C',false);
					      	}else{
					      		$pdf->Cell(6, 6, "", 1, 0, 'C',false);
					      	}				      	
					      	$pdf->Cell(20, 6, 'No ', 1, 0, 'C',true);
					      	
					      	if($rowL2->finalizo_medicamentos =="0"){
					      		$pdf->Cell(6, 6, "X", 1, 0, 'C',false);
					      	}else{
					      		$pdf->Cell(6, 6, "", 1, 0, 'C',false);
					      	}
					      	$pdf->Cell(20, 6, 'No Aplica ', 1, 0, 'C',true);

					      	if($rowL2->finalizo_medicamentos =="2"){
					      		$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
					      	}else{
					      		$pdf->Cell(6, 6, "", 1, 0, 'C',false);
					      	}	
					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(0, 6, utf8_decode('Signos de Infección'), 1, 1, 'C',true);

					      	$pdf->Cell(80, 6, 'Signos', 1, 0, 'C',true);
					      	$pdf->Cell(50, 6, 'Si ', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, 'No ', 1, 1, 'C',true);
					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Calor', 1, 0, 'C',true);

					      	if($rowL2->calor =="1"){
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
						    }else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }  	

					      	$pdf->Cell(80, 6, 'Rubor', 1, 0, 'C',true);
					      	if($rowL2->rubor =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
						    }else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    } 
						      	
					      	$pdf->Cell(80, 6, utf8_decode('Inflamación'), 1, 0, 'C',true);
					      	
					      	if($rowL2->inflamacion =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, utf8_decode('Secreción'), 1, 0, 'C',true);

					      	if($rowL2->secrecion =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, utf8_decode('Otros Signos'), 1, 0, 'C',true);

					      	if($rowL2->otros_signos =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, "Cuales", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL2->cuales2), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode('Finalizo controles'), 1, 0, 'C',true);
					      	
					      	if($rowL2->finalizo_controles2 =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, "Observaciones", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL2->observacion2), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Información Dada por:"), 1, 0, 'C',true);
					      	if ($rowL2->informo_paciente == "1"){
					      		$pdf->Cell(0, 6, utf8_decode("Familiar"), 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(0, 6, utf8_decode("Paciente"), 1, 1, 'C',false);
					      	}
					      	
					      	$pdf->Cell(80, 6, utf8_decode("Nombre Quien Informó"), 1, 0, 'C',true);

					      	$pdf->Cell(0, 6, utf8_decode($rowL2->informo), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Funcionario Que Realizó la LLamada"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL2->Auxiliar), 1, 1, 'C',false);
					      	
						}

						//Tercera llamada
													
						$pdf->Ln(20);


			        $pdf->SetFont('Arial', 'B', 8);
			       
			        $pdf->SetFillColor(177,179,179);
			        $pdf->Cell(34, 6, 'DATOS DEL PACIENTE', 1, 0, 'C',true);
			        $pdf->Cell(50, 6, 'NOMBRE (Apellidos y Nombre(s))', 1, 0, 'C',true);
			        $pdf->Cell(80, 6, $row->nombres, 1, 0, 'C',false);
			        $pdf->Cell(10, 6, 'EDAD', 1, 0, 'C',true);
			        $pdf->Cell(0, 6, $row->edad, 1, 1, 'C',false);
			        $pdf->Cell(27, 6, 'HISTORIA CLINICA', 1, 0, 'C',true);
			        $pdf->Cell(20, 6, $row->id_paciente, 1, 0, 'C',false);
			        $pdf->Cell(20, 6, 'TELEFONO	', 1, 0, 'C',true);
			        $pdf->Cell(20, 6, $row->Telefono_paciente, 1, 0, 'C',false);
			        $pdf->Cell(20, 6, 'ENTIDAD', 1, 0, 'C',true);

			        switch ($row->id_entidad) {
					   
					    case '1': $entidad = 'ASISDERMA';
					        break;
					    case '2': $entidad = 'BANCO REPUBLICA';
					        break;
					    case '3': $entidad = 'COLSANITAS';
					        break;
					    case '4': $entidad = 'COLSANITAS BANCO DE LA REPUBLICA';
					        break;
					    case '5': $entidad = 'COLSANITAS BANCO REPUBLICA';
					        break;
					    case '6': $entidad = 'COLSANITAS BAVARIA';
					        break;
					    case '7': $entidad = 'COLSANITAS CERREJON';
					        break;
					    case '8': $entidad = 'COLSANITAS MINTIC';
					        break;
					    case '9': $entidad = 'COLSANITAS MODULAR';
					        break;
					    case '10':$entidad = 'COLSANITAS PLAN MODULAR';
					        break;
					    case '11': $entidad = 'EPS SANITAS';
					        break;
					    case '12': $entidad = 'MEDISANITAS';
					        break;
						case '13': $entidad = 'PANAMERICANA LIFE';
					        break;
					    case '14': $entidad = 'PARTICULAR';
					        break;
					    case '15': $entidad = 'SEGUROS BOLIVAR';
					        break; 
					    case '16': $entidad = 'SEGUROS BOLIVAR POLIZA DE SALUD';
					        break; 
					    case '17': $entidad = 'SEGUROS BOLIVAR POLIZA SALUD';
					        break;   
					    default: $entidad = 'UNISALUD';
					        break;
					} 
			        $pdf->Cell(0, 6, utf8_decode($entidad), 1, 1, 'C',false);

			        $pdf->Cell(0, 6, 'PROCEDIMIENTO', 1, 1, 'C',true);
					$pdf->MultiCell(0, 6, utf8_decode($row->nombre), 'LTRB', 'L');
			        $pdf->Cell(15, 6, 'FECHA ', 1, 0, 'C',true);
			        $pdf->Cell(20, 6, $row->fecha_Cx, 1, 0, 'C',false);
			        $pdf->Cell(10, 6, 'HORA', 1, 0, 'C',true);
			        $pdf->Cell(10, 6, $row->hora_Cx, 1, 0, 'C',false);
			        $pdf->Cell(23, 6, 'ESPECIALISTA', 1, 0, 'C',true);
			        $pdf->Cell(0, 6, utf8_decode($row->Cirujano), 1, 1, 'C',false);
			        $pdf->Ln(5);
					
				      	$campos3 ='DATE_FORMAT(ls1.fecha_llamada,"%d/%m/%Y") AS fecha_L3, ls1.observaciones, ls1.informo_paciente, ls1.informo, IFNULL(CONCAT(em.nombres, " ", em.apellidos), " ") AS "Auxiliar"';
				      	
				      	$queryL3 = $this->general_model->consulta_personalizada($campos3, 'p_seguimiento_L3 ls1 INNER JOIN empleados em ON ls1.id_auxiliar_llamo = em.id_empleado', 'ls1.id_p_cirugia ='.$id_proce.'', '', 0, 0);
				      	
				      	$alturas = [];
				      	
				      	$data_llamadas3 = $queryL3->result();

				      	foreach ($data_llamadas3 as $rowL3) {	

				      		$numLineas = $pdf->NbLines(102, utf8_decode($rowL3->observaciones));
				    		$alturas[] = $numLineas * 5; // 5 es la altura de línea

					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(0, 6, 'TERCERA LLAMADA ', 1, 1, 'C',true);			      	
					      	
					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Fecha', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL3->fecha_L3, 1, 1, 'C',false);
							
					      	$pdf->Cell(80, 6, "Observaciones",1, 0, 'C',true);
					      	$pdf->MultiCell(0, 6, utf8_decode($rowL3->observaciones), 1, 'C',false);
			        
					      	$pdf->Cell(80, 6, utf8_decode("Información Dada por:"), 1, 0, 'C',true);
					      	if ($rowL3->informo_paciente == "1"){
					      		$pdf->Cell(0, 6, utf8_decode("Familiar"), 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(0, 6, utf8_decode("Paciente"), 1, 1, 'C',false);
					      	}

					      	$pdf->Cell(80, 6, utf8_decode("Nombre Quien Informó"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL3->informo), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Funcionario Que Realizó la LLamada"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL3->Auxiliar), 1, 1, 'C',false);
					    }

			      	}else if($row->llamadas =="2"){

			      		//Encabezado fila Llamadas
				      		
				      	$campos1 ='DATE_FORMAT(ls1.fecha_llamada,"%d/%m/%Y") AS fecha_L1, ls1.responde, ls1.dolor, ls1.sangrado, ls1.otros_sintomas, ls1.cuales, DATE_FORMAT(ls1.fecha_control,"%d/%m/%Y") AS fcontrol_L1, ls1.observaciones, ls1.informo_paciente, ls1.informa, IFNULL(CONCAT(em.nombres, " ", em.apellidos), " ") AS "Auxiliar"';
				      	
				      	$queryL1 = $this->general_model->consulta_personalizada($campos1, 'p_seguimiento_L1 ls1 INNER JOIN empleados em ON ls1.id_funcionario_llama = em.id_empleado', 'ls1.id_p_cirugia ='.$id_proce.'', '', 0, 0);
				      	
				      	$data_llamadas1 = $queryL1->result();
	            
		            	foreach ($data_llamadas1 as $rowL1) {	
					      	$pdf->Cell(0, 6, 'PRIMERA LLAMADA ', 1, 1, 'C',true);
					      	$pdf->Cell(0, 2, "", 1, 1, 'C',false);

					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Fecha', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL1->fecha_L1, 1, 1, 'C',false);

					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(80, 6, 'Sintomas', 1, 0, 'C',true);
					      	$pdf->Cell(50, 6, 'Si ', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, 'No ', 1, 1, 'C',true);

					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Dolor ', 1, 0, 'C',true);

					      	if($rowL1->dolor =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);	
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);			      		
					      	}

					      	$pdf->Cell(80, 6, 'Sangrado', 1, 0, 'C',true);
					      	if($rowL1->sangrado =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);	
					      	}

					      	$pdf->Cell(80, 6, 'Otros sintomas', 1, 0, 'C',true);

					      	if($rowL1->otros_sintomas =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);	
					      	}

					      	$pdf->Cell(80, 6, "Cuales", 1, 0, 'C',true);			      	
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->cuales), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, 'Fecha Control', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL1->fcontrol_L1, 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, "Observaciones", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->observaciones), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Información Dada por:"), 1, 0, 'C',true);
					      	if ($rowL1->informo_paciente == "1"){
					      		$pdf->Cell(0, 6, utf8_decode('Familiar'), 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(0, 6, utf8_decode('Paciente'), 1, 1, 'C',false);
					      	}
					      	
					      	$pdf->Cell(80, 6, utf8_decode("Nombre Quien Informó"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->informa), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Funcionario Que Realizó la LLamada"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->Auxiliar), 1, 1, 'C',false);

					      	$pdf->Ln(3);
					    }  	
					      	//Segunda llamada 

						$campos2 ='DATE_FORMAT(ls2.fecha_llamada2, "%d/%m/%Y") AS fecha_L2, ls2.responde2, ls2.finalizo_medicamentos, ls2.calor, ls2.rubor, ls2.inflamacion, ls2.secrecion, ls2.otros_signos, ls2.cuales2, ls2.finalizo_controles2, ls2.observacion2, ls2.informo_paciente, ls2.informo, IFNULL(CONCAT(em.nombres, " ", em.apellidos), " ") AS "Auxiliar"';
				      	
				      	$queryL2 = $this->general_model->consulta_personalizada($campos2, 'p_seguimiento_L2 ls2 INNER JOIN empleados em ON ls2.id_auxiliar_llamo = em.id_empleado', 'ls2.id_p_cirugia ='.$id_proce.'', '', 0, 0);

						$data_llamadas2 = $queryL2->result();
	            
		            	foreach ($data_llamadas2 as $rowL2) {	

					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(0, 6, 'SEGUNDA LLAMADA ', 1, 1, 'C',true);			      	
					      	
					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Fecha', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL2->fecha_L2, 1, 1, 'C',false);
							
					      	$pdf->Cell(80, 6, 'Finalizo Medicamentos', 1, 0, 'C',true);
					      	$pdf->Cell(20, 6, 'Si ', 1, 0, 'C',true);
					      	
					      	if($rowL2->finalizo_medicamentos =="1"){
					      		$pdf->Cell(6, 6, "X", 1, 0, 'C',false);
					      	}else{
					      		$pdf->Cell(6, 6, "", 1, 0, 'C',false);
					      	}				      	
					      	$pdf->Cell(20, 6, 'No ', 1, 0, 'C',true);
					      	
					      	if($rowL2->finalizo_medicamentos =="0"){
					      		$pdf->Cell(6, 6, "X", 1, 0, 'C',false);
					      	}else{
					      		$pdf->Cell(6, 6, "", 1, 0, 'C',false);
					      	}
					      	$pdf->Cell(20, 6, 'No Aplica ', 1, 0, 'C',true);

					      	if($rowL2->finalizo_medicamentos =="2"){
					      		$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
					      	}else{
					      		$pdf->Cell(6, 6, "", 1, 0, 'C',false);
					      	}	
					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(0, 6, utf8_decode('Signos de Infección'), 1, 1, 'C',true);

					      	$pdf->Cell(80, 6, 'Signos', 1, 0, 'C',true);
					      	$pdf->Cell(50, 6, 'Si ', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, 'No ', 1, 1, 'C',true);
					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Calor', 1, 0, 'C',true);

					      	if($rowL2->calor =="1"){
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
						    }else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }  	

					      	$pdf->Cell(80, 6, 'Rubor', 1, 0, 'C',true);
					      	if($rowL2->rubor =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
						    }else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    } 
						      	
					      	$pdf->Cell(80, 6, utf8_decode('Inflamación'), 1, 0, 'C',true);
					      	
					      	if($rowL2->inflamacion =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, utf8_decode('Secreción'), 1, 0, 'C',true);

					      	if($rowL2->secrecion =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, utf8_decode('Otros Signos'), 1, 0, 'C',true);

					      	if($rowL2->otros_signos =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }

					      	$pdf->Cell(80, 6, "Cuales", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL2->cuales2), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode('Finalizo controles'), 1, 0, 'C',true);
					      	
					      	if($rowL2->finalizo_controles2 =="1"){	
						      	$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else{
						    	$pdf->Cell(50, 6, "", 1, 0, 'C',false);
						      	$pdf->Cell(0, 6, "X", 1, 1, 'C',false);
						    }


					      	$pdf->Cell(80, 6, "Observaciones", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL2->observacion2), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Información Dada por:"), 1, 0, 'C',true);
					      	if ($rowL2->informo_paciente == "1"){
					      		$pdf->Cell(0, 6, utf8_decode("Familiar"), 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(0, 6, utf8_decode("Paciente"), 1, 1, 'C',false);
					      	}
					      	
					      	$pdf->Cell(80, 6, utf8_decode("Nombre Quien Informó"), 1, 0, 'C',true);

					      	$pdf->Cell(0, 6, utf8_decode($rowL2->informo), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Funcionario Que Realizó la LLamada"), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL2->Auxiliar), 1, 1, 'C',false);
					      	
						}					

			      	}else if($row->llamadas =="1"){
			      		
				      	$campos1 ='DATE_FORMAT(ls1.fecha_llamada,"%d/%m/%Y") AS fecha_L1, ls1.responde, ls1.dolor, ls1.sangrado, ls1.otros_sintomas, ls1.cuales, DATE_FORMAT(ls1.fecha_control,"%d/%m/%Y") AS fcontrol_L1, ls1.observaciones, ls1.informo_paciente, ls1.informa, IFNULL(CONCAT(em.nombres, " ", em.apellidos), " ") AS "Auxiliar"';
				      	
				      	$queryL1 = $this->general_model->consulta_personalizada($campos1, 'p_seguimiento_L1 ls1 INNER JOIN empleados em ON ls1.id_funcionario_llama = em.id_empleado', 'ls1.id_p_cirugia ='.$id_proce.'', '', 0, 0);
				      					      	
				      	$data_llamadas1 = $queryL1->result();
	            
		            	foreach ($data_llamadas1 as $rowL1) {	
					      	$pdf->Cell(0, 6, 'PRIMERA LLAMADA ', 1, 1, 'C',true);
					      	$pdf->Cell(0, 2, "", 1, 1, 'C',false);

					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Fecha', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL1->fecha_L1, 1, 1, 'C',false);

					      	$pdf->SetFillColor(177,179,179);
					      	$pdf->Cell(80, 6, 'Sintomas', 1, 0, 'C',true);
					      	$pdf->Cell(50, 6, 'Si ', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, 'No ', 1, 1, 'C',true);

					      	$pdf->SetFillColor(205,206,207);
					      	$pdf->Cell(80, 6, 'Dolor ', 1, 0, 'C',true);

					      	if($rowL1->dolor =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);	
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);			      		
					      	}

					      	$pdf->Cell(80, 6, 'Sangrado', 1, 0, 'C',true);
					      	if($rowL1->sangrado =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);	
					      	}

					      	$pdf->Cell(80, 6, 'Otros sintomas', 1, 0, 'C',true);

					      	if($rowL1->otros_sintomas =="1"){
					      		$pdf->Cell(50, 6, "X", 1, 0, 'C',false);
					      		$pdf->Cell(0, 6, "", 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(50, 6, "", 1, 0, 'C',false);
					      	    $pdf->Cell(0, 6, "X", 1, 1, 'C',false);	
					      	}

					      	$pdf->Cell(80, 6, "Cuales", 1, 0, 'C',true);			      	
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->cuales), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, 'Fecha Control', 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, $rowL1->fcontrol_L1, 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, "Observaciones", 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->observaciones), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode("Información Dada por:"), 1, 0, 'C',true);
					      	if ($rowL1->informo_paciente == "1"){
					      		$pdf->Cell(0, 6, utf8_decode('Familiar'), 1, 1, 'C',false);
					      	}else {
					      		$pdf->Cell(0, 6, utf8_decode('Paciente'), 1, 1, 'C',false);
					      	}
					      	
					      	$pdf->Cell(80, 6, utf8_decode('Nombre Quien Informó'), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->informa), 1, 1, 'C',false);

					      	$pdf->Cell(80, 6, utf8_decode('Funcionario Que Realizó la LLamada'), 1, 0, 'C',true);
					      	$pdf->Cell(0, 6, utf8_decode($rowL1->Auxiliar), 1, 1, 'C',false);

					      	$pdf->Ln(3);
					    }  	
			      	}else{
			      		$pdf->Cell(0, 6, 'NO SE HAN REGISTRADO LLAMADAS DE SEGUMIENTO', 1, 1, 'C',true);
			      	}

			        // Salida del PDF
			        $pdf->Output('acta_reunion.pdf', 'I');
	      		}
			} catch (Exception $e) {
			    die("Error al generar el PDF: " . $e->getMessage());
			}

		}//-Valida Inicio de Session
	}
	


	public function excel($fecha) 
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
		redirect(base_url());
		} else {				

			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			// $fecha =$this->input->get('fecha');
			$idfecha = explode('-',$fecha);	
			// var_dump($idfecha);
			$tabla = '';
			$count = 1;
			
			$campos = '"Item",CASE WHEN ps.servicio = "1" THEN "Odontología" WHEN ps.servicio = "2" THEN "Sala de procedimientos" WHEN ps.servicio = "3" THEN "Unidad de Aplicación de medicamentos" WHEN ps.servicio = "4" THEN "Enfermería" WHEN ps.servicio = "5" THEN "Toma de muestras" WHEN ps.servicio = "6" THEN "Consulta prioritaria de Ortopedia" WHEN ps.servicio = "7" THEN "Electromiografía" WHEN ps.servicio = "8" THEN "Imágenes diagnósticas" END AS "Servicio", ps.id_paciente AS "Historia Clinica", ps.nombres AS "Paciente", IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Especialista", px.nombre AS "Procedimiento", ps.fecha_Cx AS "Fecha Procedimiento", sl1.fecha_llamada AS "Fecha 1ra. llamada", sl2.fecha_llamada2 AS "Fecha 2da llamada", sl3.fecha_llamada AS "Fecha 3ra llamada", CASE WHEN  ps.estado ="0" THEN "Sin Seguimiento" WHEN  ps.estado ="1" THEN "En Segumiento" WHEN  ps.estado ="2" THEN "Cerrada" END AS "Estado"';		
    


			$query = $this->general_model->consulta_personalizada($campos, 'p_curso_cx ps INNER JOIN empleados ci ON ps.id_cirujano = ci.id_empleado INNER JOIN procedimientos_cx px ON ps.procedimiento = px.id_procedimiento LEFT JOIN empleados an ON ps.id_anest = an.id_empleado LEFT join p_seguimiento_L1 sl1 ON sl1.id_p_cirugia = ps.id_cirugia LEFT JOIN p_seguimiento_L2 sl2 ON sl2.id_p_cirugia = ps.id_cirugia LEFT JOIN p_seguimiento_L3 sl3 ON sl3.id_p_cirugia = ps.id_cirugia', 'YEAR(ps.fecha_Cx)="' . $idfecha[0] . '" AND MONTH(ps.fecha_Cx) = "' . $idfecha[1] . '"', 'ps.id_cirugia', 0, 0);


			$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			$td = '<tr class="d-style bgc-h-default-l4">';
		    foreach ($query->list_fields() as $campo)
		    {				      
		        $tabla .= '<th>'.($campo).'</th>';	
		        		    
			}
			$tabla .= '</tr></thead><tbody class="pos-rel">';
			
			foreach ($query->result_array() as $row1)
			{
				
				$tabla .= '<tr><td>' . $count++ . '</td><td>' . $row1['Servicio'] . '</td><td>' . $row1['Historia Clinica'] . '</td><td>' . $row1['Paciente'] . '</td><td>' . $row1['Especialista'] . '</td><td>' . $row1['Procedimiento'] . '</td><td>' . $row1['Fecha Procedimiento'] . '</td><td>' . $row1['Fecha 1ra. llamada'] . '</td><td>' . $row1['Fecha 2da llamada'] . '</td><td>' . $row1['Fecha 3ra llamada'] . '</td><td>' . $row1['Estado'] . '</td></tr>';  					
			}						
			
			$tabla .= '</tbody>'; 
			$filename = "Listado_de Seguimientos.xls";
			$usuario = $this->session->userdata('C_id_usuario');
		    header ("Content-Disposition: attachment; filename=".$filename );
			header ("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL SEGUIMIENTOS A PROCEDIMIENTOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode($tabla);
            echo '</table>';		
		}
	}

	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ){
			redirect();
		}else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}else {
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('programacion', 'id_programacion', $this->input->post('idreg'), $registro);
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

	public function cargar_paciente() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('paci');

			$query=$this->general_model->select_where('p.id_paciente AS "Id",IFNULL(CONCAT(p.nombres, " ", p.apellidos),"") AS "Paciente"', 'pacientes p', array('p.numero_id' => $id) );
			$row = $query->row_array();

			$arr['pacientes'] = array('id_paciente'=>$row['Id'], 'paciente'=>$row['Paciente']);
			echo json_encode( $arr );
		}
	}

	public function cargar_llamda() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			$query=$this->general_model->select_where('fecha_llamada, responde, dolor, sangrado, otros_sintomas, cuales, fecha_control, observaciones, informo_paciente, informa, id_funcionario_llama', 'p_seguimiento_L1', array('id_p_cirugia' => $id) );
			$row = $query->row_array();

			$arr['llamada1'] = array('fecha_llamada'=>$row['fecha_llamada'], 'responde'=>$row['responde'], 'dolor'=>$row['dolor'], 'sangrado'=>$row['sangrado'], 'otros_sintomas'=>$row['otros_sintomas'], 'cuales'=>$row['cuales'], 'fecha_control'=>$row['fecha_control'], 'observaciones'=>$row['observaciones'], 'informo_paciente'=>$row['informo_paciente'], 'informa'=>$row['informa'], 'id_funcionario_llama'=>$row['id_funcionario_llama']);
			echo json_encode( $arr );
		}
	}

	public function cargar_llamda2() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			$query=$this->general_model->select_where('fecha_llamada2, responde2, finalizo_medicamentos, calor, rubor, inflamacion, secrecion, otros_signos, cuales2, finalizo_controles2, observacion2, informo_paciente, informo, id_auxiliar_llamo', 'p_seguimiento_L2', array('id_p_cirugia' => $id) );
			$row = $query->row_array();

			$arr['llamada2'] = array('fecha_llamada2'=>$row['fecha_llamada2'], 'responde2'=>$row['responde2'], 'finalizo_medicamentos'=>$row['finalizo_medicamentos'], 'calor'=>$row['calor'], 'rubor'=>$row['rubor'], 'inflamacion'=>$row['inflamacion'], 'secrecion'=>$row['secrecion'], 'otros_signos'=>$row['otros_signos'], 'cuales2'=>$row['cuales2'], 'finalizo_controles'=>$row['finalizo_controles2'],'observacion2'=>$row['observacion2'], 'informo_paciente'=>$row['informo_paciente'], 'informa'=>$row['informo'], 'id_auxiliar_llamo'=>$row['id_auxiliar_llamo']);
			echo json_encode( $arr );
		}
	}

	public function cargar_llamda3() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$id = $this->input->post('idreg');

			$query=$this->general_model->select_where('fecha_llamada, responde, observaciones, informo_paciente, informo, id_auxiliar_llamo', 'p_seguimiento_L3', array('id_p_cirugia' => $id) );
			$row = $query->row_array();

			$arr['llamada2'] = array('fecha_llamada3'=>$row['fecha_llamada'], 'responde3'=>$row['responde'], 'observaciones3'=>$row['observaciones'], 'informo_paciente'=>$row['informo_paciente'], 'informa'=>$row['informo'], 'id_auxiliar_llamo'=>$row['id_auxiliar_llamo']);
			echo json_encode( $arr );
		}
	}


	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

				$campos ='pg.id_programacion AS "Id", IFNULL(CONCAT(pa.nombres, " ", pa.apellidos), " ") AS "Paciente", IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Cirujano", GROUP_CONCAT(pr.nombre) AS "Procedimiento", (SELECT GROUP_CONCAT(m.nombre_material) from programacion_procedimientos pgp LEFT JOIN materiales_qx m ON FIND_IN_SET( m.id_material, pgp.materiales)WHERE pgp.id_programacion= "'.$idreg.'") AS "Materiales", pg.fecha_programacion AS "Fecha programacion", pg.hora_programacion AS "Hora", CASE WHEN pg.estado="0" THEN "Pendiente" WHEN pg.estado="1" THEN "Gestinada" WHEN pg.estado="2" THEN "Confirmada" ELSE "Rechazada" END AS "Estado",pg.observaciones AS "Observaciones", pg.fecha_revision AS "Fecha Revisión",pg.observaciones_r AS "Observaciones Programación", pg.fecha_solicitud_materiales AS "Fecha Solicitud Materiales", pg.observaciones_sm AS "Observaciones Instrumentación"';

            	$query = $this->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado INNER JOIN programacion_procedimientos pgp ON pg.id_programacion = pgp.id_programacion INNER JOIN procedimientos pr ON pgp.id_procedimiento = pr.id_procedimiento', 'pg.id_programacion = "'.$idreg.'"', '', 0, 0);
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

	//**************************** PERSONAL PROCEDIMIENTOS ******************************************************

	public function cargar_email(){
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$id_casa = $this->input->post('idcasa');
				$seleccion = $this->input->post('idcorreo');
				$campos = ' id_correo AS "Id", Correo AS "Email" ';
				$query = $this->general_model->consulta_personalizada($campos, 'terceros_correos', 'id_tercero="'.$id_casa.'" AND estado = "1" ', '', 0, 0);
				$tabla='';
				$tabla .= '<option value=" ">Seleccione un Email</option>';
				foreach ($query->result_array() as $row)
				{	
				    if($seleccion == $row['Id'])
				        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Email'].'</option>';
				      else
				        $tabla .= '<option value="'.$row['Id'].'">'.$row['Email'].'</option>';
				}
				echo $tabla;
			}
		}		
	}

	
}