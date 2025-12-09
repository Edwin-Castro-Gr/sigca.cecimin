<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_egresop extends CI_Controller {
	
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

			$data_usua['titulo']="Egreso Personal";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='egresop/index';
			$data_usua['entrada_js']='_js/egreso_personal.js';
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

	public function nuevo($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			//header('Content-Type: application/json');			
			
			$data_usua['c_id_contrato'] = $id;
			$data_usua['c_id_tipocontrato'] = '';
			$data_usua['c_id_funcionario'] = '';
			$data_usua['c_cedula'] = '';
			$data_usua['c_id_cargo'] = '';
			$data_usua['c_id_centrocosto'] = '';
			$data_usua['c_id_departamento'] = '';
			$data_usua['c_id_jefeinm'] = '';
			$data_usua['c_prorroga'] = '';
			$data_usua['c_fecha_inicio'] = '';
			$data_usua['c_fecha_final'] = '';
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			$campos='ct.id_tipocontrato AS "Tipo", ct.id_funcionario AS "Funcionario", e.cedula AS "Cedula", ct.id_cargo AS "Cargo", ct.id_centrocosto AS "Centro costos", ct.id_area AS "Departamento", ct.jefe_inmediato AS "Jefe", ct.fecha_inicio AS "FechaInicio", ct.fecha_final AS "FechaFinal", ct.prorroga AS "Prorroga", ct.estado AS "Estado", ct.id_usuario AS "UsuarioCreo"';

			$query = $this->general_model->consulta_personalizada($campos,'contratos ct INNER JOIN empleados e ON ct.id_funcionario=e.id_empleado', 'id_contrato ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_id_tipocontrato'] = $row['Tipo'];
				$data_usua['c_id_funcionario'] = $row['Funcionario'];
				$data_usua['c_cedula'] = $row['Cedula'];
				$data_usua['c_id_cargo'] = $row['Cargo'];
				$data_usua['c_id_centrocosto'] = $row['Centro costos'];
				$data_usua['c_id_departamento'] = $row['Departamento'];
				$data_usua['c_id_jefeinm'] = $row['Jefe'];
				$data_usua['c_prorroga'] = $row['Prorroga'];
				$data_usua['c_fecha_inicio'] = $row['FechaInicio'];
				$data_usua['c_fecha_final'] = $row['FechaFinal'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['UsuarioCreo'];
			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Egresos Personal";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='egresop/nuevo';
			$data_usua['entrada_js']='_js/egreso_personal.js';
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

	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$usuario=$this->session->userdata('C_id_usuario');
				$this->load->helper('funciones_tabla');
				echo listar_egreso_contratos_tabla('WEB');
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
				$empleado = $this->input->post('idfuncionario');
				$id_contrato = $this->input->post('idregistro');
				$dir = 'Cont-'.$this->input->post('idregistro').''.$empleado;
				$ruta = "";
				$rutag ="";
				$filename ="";

				if (isset($_FILES['archivoPazSalvo'])) {

					if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
				 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
					 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/')) {
						 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/', 0777, true);
						 	}
					 	}
				 	}elseif(!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
					 	if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/')) {
						 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/', 0777, true);
						}
				 	}elseif(!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/')) {
						mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/', 0777, true);
					}

					$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/';  
					$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/egreso/';
					
					// ---------- CARGAR ARCHIVO VISUAL ----------- //
					$config = [
						"upload_path" => $ruta,
						"allowed_types" => "*"
					];

					$this->load->library("upload",$config);
					if ($this->upload->do_upload('archivoPazSalvo')){
						$data = array('upload_data' => $this->upload->data());
						$filename = $rutag.$data['upload_data']['file_name'];
					}else{
						//echo $this->upload->display_errors($ruta);
						$filename ="";
					}
				}					

				$registro=array(

					'id_contrato'=>$this->input->post('idregistro'),
					'motivo'=>$this->input->post('motivo'),
					'paz_salvo'=>$filename,
					'fecha_egreso'=>$this->input->post('fechaEgreso'),
					'usuario_registra'=>$this->session->userdata('C_id_usuario'),
					'fecha_registro'=>$fecha,
					'estado'=>'1'
				);
				$query = $this->general_model->insert('contratos_egresos', $registro);
				
				if($query >= 1) {									
					$registro1=array('estado'=>'0');
					$query1 = $this->general_model->update('empleados', 'id_empleado', $empleado, $registro1);

					$registro2=array('estado'=>'0');
					$query2 = $this->general_model->update('usuarios', 'id_usuario', $empleado, $registro2);

					$registro3=array('estado'=>'2');
					$query3 = $this->general_model->update('contratos', 'id_contrato', $id_contrato, $registro3);
					echo '1';
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
            echo utf8_decode(listar_contratos_tabla('EXCEL')); 
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

	public function cargar_contratos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			header('Content-Type: application/json');
			$cedula = $this->input->post('emple');
			
			$query=$this->general_model->select_where('id_empleado AS "Id", IFNULL(CONCAT(nombres," ", apellidos),"") AS "Empleado" ', 'empleados', array('cedula' => $cedula));
			$row = $query->row_array();
				
			$arr['empleado'] = array('id_empleado'=>$row['Id'], 'nombre_empleado'=>$row['Empleado']);
			echo json_encode($arr);
		}
	}	

}


