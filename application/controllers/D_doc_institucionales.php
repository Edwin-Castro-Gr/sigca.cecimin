<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require FCPATH.'vendor/autoload.php';
// ;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class D_doc_institucionales extends CI_Controller {
	
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
			// $this->session->set_userdata('archivo_origen','');
			$this->session->set_userdata('archivo_visual','');
			// $this->session->set_userdata('archivo_origen_tipo','');
			$this->session->set_userdata('archivo_visual_tipo','');

			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Documentos Institucionales";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='documentos_inst/index';
			$data_usua['entrada_js']='_js/doc_institucional.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>
    		<!-- DataTables  -->
    		<script src="'.base_url('plugins/datatables@1.10.18/media/js/jquery.dataTables.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-bs4@1.10.24/js/dataTables.bootstrap4.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-colreorder@1.5.3/js/dataTables.colReorder.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-select@1.3.3/js/dataTables.select.min.js').'"></script>
    		<script src="'.base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js').'"></script>';

			$this->load->view('template',$data_usua);
		}
	}

	public function nuevo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {

			$this->session->set_userdata('archivo_visual','');
			$this->session->set_userdata('archivo_visual_tipo','');
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk'); 

			$data_usua['titulo']="Nuevo Documento";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='documentos_inst/nuevo';
			$data_usua['entrada_js']='_js/doc_institucional.js';
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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

			$this->load->view('template',$data_usua);
		}
	}


	public function modificar($id) {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ){
			redirect(base_url());
		}else {
			
			// $id = $this->input->post('idreg');

			$data_usua['c_id_docinstitucional'] = $id;	
			$data_usua['c_nombre'] = '';
			$data_usua['c_clasificacion']='';				
			$data_usua['c_periodicidad'] = '';
			$data_usua['c_id_responsable'] = '';
			$data_usua['c_archivo'] = '';
			$data_usua['c_fecha_inicial']='';			
			$data_usua['c_fecha_final']='';	
			$data_usua['c_observaciones']='';				
			$data_usua['c_estado'] = '';
			$data_usua['c_id_usuario'] = '';

			
			$campos='d.nombre AS "Nombre", d.clasificacion AS "Clasificacion", d.periodicidad AS "Periodicidad", d.id_responsable AS "Responsable", ad.archivo AS "Archivo", ad.fecha_inicial AS "fecha_inicial", ad.fecha_final AS "fecha_final",  d.observaciones AS "Observaciones", d.estado AS "Estado", d.usuario_registra AS "Usuario"';

			$query = $this->general_model->consulta_personalizada($campos,'documentos_institucionales d INNER JOIN documentos_institucionales_anexos ad ON d.id_docinstitucional = ad.id_docinstitucional AND ad.estado ="1"', 'd.id_docinstitucional ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				$data_usua['c_nombre'] = $row['Nombre'];
				$data_usua['c_clasificacion']=$row['Clasificacion'];
				$data_usua['c_periodicidad'] = $row['Periodicidad'];
				$data_usua['c_id_responsable'] = $row['Responsable'];
				$data_usua['c_archivo'] = $row['Archivo'];
				$data_usua['c_fecha_inicial'] = $row['fecha_inicial'];
				$data_usua['c_fecha_final'] = $row['fecha_final'];
				$data_usua['c_observaciones']=$row['Observaciones'];
				$data_usua['c_estado'] = $row['Estado'];
				$data_usua['c_id_usuario'] = $row['Usuario'];
		    }
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Modificar Documentos0 Institucionales";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='documentos_inst/modificar';
			$data_usua['entrada_js']='_js/doc_institucional.js';
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
		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>';

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
				$this->load->helper('funciones_tabla');
				echo listar_documentosIns_tabla('WEB');
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
				//ESTABLECER LA RUTA DONDE SE VA A GUARDAR EL ARCHIVO
				
				$dir = "documentos_institucionales";

			 	if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);			 		
				 	}
			 	} elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/')) {
				 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/', 0777, true);
			 	}

				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';  
				$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
				
				//CARGAR ARCHIVO VISUAL
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];
				$filename="";
				$this->load->library("upload",$config);

				if ($this->upload->do_upload('archivo')){
					$data = array('upload_data' => $this->upload->data());
					$filename = $rutag.$data['upload_data']['file_name'];
				}
				$fecha = date('Y-m-d H:i:s');				
				
				$registro=array(

					'nombre'=>$this->input->post('nombre'),
					'clasificacion'=>$this->input->post('clasificacion'),
					'periodicidad'=>$this->input->post('periodicidad'), 
					'observaciones'=>$this->input->post('observaciones'),
					'id_responsable'=>$this->input->post('empleados_responsable'),					
					'fecha_registro'=>$fecha, 
					'usuario_registra'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('documentos_institucionales', $registro);
				
				if($query >= 1) { //Guardar el anexo en la Base de Datos
					$id_docinstitucional=$query;

					$registro1=array(							
						'id_docinstitucional'=>$id_docinstitucional,
						'archivo'=>$filename,							
						'fecha_inicial'=>$this->input->post('fechainicial'),
						'fecha_final'=>$this->input->post('fechafinal'),
						'fecha_registro'=>$fecha,
						'usuario_registra'=>$this->session->userdata('C_id_usuario'),
						'estado'=>'1'
					);
					
					$query1 = $this->general_model->insert('documentos_institucionales_anexos', $registro1);

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
	}

	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('P', 'mm', 'LETTER');
	        $pdf->AliasNbPages();
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Listado de Documentos Institucionales", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('P', 'LETTER');
            
            $pdf->Ln(10);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE DOCUMENTOS INSTITUCIONALES'), 0, 0, 'C', false);
            $pdf->Ln(20);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(195,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(5);

            $campos ='d.id_docinstitucional AS "Id", d.nombre AS "Nombre", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Responsable", ad.archivo AS "Ver", ad.fecha_final AS "Vence", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
			$query=$this->general_model->consulta_personalizada($campos, 'documentos_institucionales d INNER JOIN documentos_institucionales_anexos ad ON d.id_docinstitucional = ad.id_docinstitucional AND ad.estado = "1" INNER JOIN empleados e ON d.id_responsable=e.id_empleado', '', 'd.nombre', 0, 0);
			$encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 11);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(7,5,' ',0,0,'C',false);
			$pdf->Cell(16,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(75,5,utf8_decode("NOMBRE"),'LTRB',0,'C',$fill);
			$pdf->Cell(75,5,utf8_decode("RESPONSABLE"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("VENCE"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(7,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(7,5,' ',0,0,'C',false);
                $pdf->Cell(16,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(75,5,utf8_decode($row->Nombre),'LTRB',0,'C',$fill);
                $pdf->Cell(75,5,utf8_decode($row->Area),'LTRB',0,'C',$fill);
                $pdf->Cell(75,5,utf8_decode($row->Responsable),'LTRB',0,'C',$fill);
                $pdf->Cell(25,5,$row->Vence,'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(7,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Documentos_Insitucionales.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_Documentos_Insitucionales.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE DOCUMENTOS INSTITUCIONALES </th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_documentosIns_tabla('EXCEL')); 
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
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('documentos_institucionales', 'id_docinstitucional', $this->input->post('idreg'), $registro);
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

	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$dir = "documentos_institucionales";
				$idreg = $this->input->post('idregistro');
				$fecha = date('Y-m-d H:i:s');			 	
			 	$archivo = $this->input->post('archivo');

				$fecha = date('Y-m-d H:i:s');				
				
				$registro=array(

					'nombre'=>$this->input->post('nombre'),
					'clasificacion'=>$this->input->post('clasificacion'),
					'periodicidad'=>$this->input->post('periodicidad'), 
					'observaciones'=>$this->input->post('observaciones'), 
					'id_responsable'=>$this->input->post('empleados_responsable')					
				);
				
				$query = $this->general_model->update('documentos_institucionales', 'id_docinstitucional', $idreg, $registro);
				
				if($query=="OK"){					
					
					if($archivo !="" || $archivo != 0){

						$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';  
						$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/'.$dir.'/';
						$config = [
							"upload_path" => $ruta,
							"allowed_types" => "*"
						];
						$filename="";
						$this->load->library("upload",$config);

						if ($this->upload->do_upload('archivo')){
							$data = array('upload_data' => $this->upload->data());
							$filename = $rutag.$data['upload_data']['file_name'];
						}

			            $campos ='id_anexo_doc_inst AS "Id"';
						$query=$this->general_model->consulta_personalizada($campos, 'documentos_institucionales_anexos', 'id_docinstitucional ="'.$idreg.'"AND estado = "1"', '', 0, 0);
						$row = $query->row_array();
						$id =$row['Id'];
						
						$registro=array(
							'estado'=>'0'
						);

						$query = $this->general_model->update('documentos_institucionales_anexos', 'id_anexo_doc_inst', $id, $registro);
						
				 		$registro=array(
						'id_docinstitucional'=>$idreg,
						'archivo'=>$filename,							
						'fecha_inicial'=>$this->input->post('fechainicial'),
						'fecha_final'=>$this->input->post('fechafinal'),
						'fecha_registro'=>$fecha,
						'usuario_registra'=>$this->session->userdata('C_id_usuario'),
						'estado'=>'1'
						);
						$query1 = $this->general_model->insert('documentos_institucionales_anexos', $registro1);
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


	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

				$campos = 'd.id_docinstitucional AS "Id", d.nombre AS "Nombre", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Responsable",SUBSTRING(ad.archivo,54) AS "Archivo", ad.fecha_final AS "Vence", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'documentos_institucionales d INNER JOIN documentos_institucionales_anexos ad ON d.id_docinstitucional = ad.id_docinstitucional AND ad.estado = "1" INNER JOIN empleados e ON d.id_responsable=e.id_empleado', ' d.id_docinstitucional = "'.$idreg.'" ', '', 0, 0);
		      
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
		            	form_label($encabezado[$k].': ','', array('class'=>'control-label text-right col-md-3'))
		              	.'<div class="col-md-7 text-primary"><strong>'.$row[$encabezado[$k]].'</strong></div>
		            </div>';
				}

		      	echo $tabla;
			}
		}
	}
}
