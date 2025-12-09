<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_pacientes extends CI_Controller {
	
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
			$data_usua['titulo']="Pacientes";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='pacientes/index';
			$data_usua['entrada_js']='_js/pacientes.js';
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


	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				echo listar_pacientes_tabla('WEB');
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


	private function addPdfHeader($pdf) {
	    $pdf->SetFont('helvetica','B',10);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE PACIENTES '), 0 , 0, 'C', false);
	    $pdf->Ln(10);

	    $pdf->SetFont('helvetica','B',6);
        $pdf->Cell(250,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
        $pdf->Cell(7,5,' ', 0, 0, 'C', false);
        $pdf->Ln(5);
	}

	private function addTableHeader($pdf, $fill) {
		$pdf->SetFont('helvetica','B', 9);
		$pdf->SetFillColor(200,220,255);
		$pdf->Cell(9,5,' ',0,0,'C',false);
		$pdf->Cell(16,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
		$pdf->Cell(30,5,utf8_decode("N. IDENTIDAD"),'LTRB',0,'C',$fill);
		$pdf->Cell(90,5,utf8_decode("NOMBRE DEL PACIENTE"),'LTRB',0,'C',$fill);
		$pdf->Cell(50,5,utf8_decode("ENTIDAD SALUD"),'LTRB',0,'C',$fill);
		$pdf->Cell(40,5,utf8_decode("TELEFONO"),'LTRB',0,'C',$fill);
		$pdf->Cell(20,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
		$pdf->Cell(9,5,' ',0,0,'C',false);
		$pdf->Ln(5);
	}
	
	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('L', 'mm', 'LETTER');
	        $pdf->AliasNbPages();
	        
	        // Agregar encabezado
	        $pdf->SetMargins(10, 30, 3);
	        $pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGFAC - Informe Pacientes", true);     
	        
	        $pdf->AddPage('L', 'LETTER');
            $this->addPdfHeader($pdf);

            $campos ='p.id_paciente AS "Id", p.numero_id AS "Numero_Id",IFNULL(CONCAT(p.nombres, " ", p.apellidos),"") AS "Paciente", e.nombre AS "Entidad_Salud", p.telefono AS "Telefono", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
			$query=$this->general_model->consulta_personalizada($campos, 'pacientes p INNER JOIN eps e ON p.id_entidad_salud = e.id_eps', '', 'p.apellidos', 0, 0);
			$encabezados = $query->result();
			
			$x = 1;
			$fill = true;			
			$this->addTableHeader($pdf, $fill);

			
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	if($pdf->GetY() > 180) { // Ajustar para romper la página antes del final
	                $pdf->AddPage('L', 'LETTER');
	                $this->addPdfHeader($pdf);
	                $pdf->SetFont('helvetica','B', 9);
	        		$pdf->SetFillColor(200,220,255);
	                $this->addTableHeader($pdf, true);               // Agregar el encabezado de la tabla en cada página nueva
	            }	
	            $pdf->SetFont('helvetica','', 8);        	
	        	$pdf->Cell(9,5,' ',0,0,'C',false);
                $pdf->Cell(16,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(30,5,($row->Numero_Id),'LTRB',0,'C',$fill);
                $pdf->Cell(90,5,utf8_decode($row->Paciente),'LTRB',0,'C',$fill);
                $pdf->Cell(50,5,utf8_decode($row->Entidad_Salud),'LTRB',0,'C',$fill);                
                $pdf->Cell(40,5,utf8_decode($row->Telefono),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(9,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Pacientes.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_Pacientes.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="5">LISTADO GENERAL DE PACIENTES</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_pacientes_tabla('EXCEL')); 
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
				$query = $this->general_model->update('pacientes', 'id_paciente', $this->input->post('idreg'), $registro);
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

	public function modificar() {
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

	public function actualizar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
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
				
				$query = $this->general_model->update('pacientes', 'id_paciente', $this->input->post('idregistro'), $registro);
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

	public function ver_registro() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('idreg');

				$campos = 'p.id_paciente AS "Id", te.cod_tipodocumento AS "Tipo Identificación", p.numero_id AS "Documento Identidad", IFNULL(CONCAT(p.nombres, " ", p.apellidos),"") AS "Nombre del paciente", e.nombre AS "Entidad Salud", p.otra_entidad_salud AS "Otra", p.telefono AS "Telefono",  p.correo AS "Email", CASE WHEN p.estado = "1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'pacientes p LEFT JOIN tipo_docidentidad te ON te.id_tipdocidentidad = p.id_tipodocumento LEFT JOIN eps e ON e.id_eps = p.id_entidad_salud', 'p.id_paciente = "'.$idreg.'" ', '', 0, 0);
		      
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
		            	form_label($encabezado[$k].': ','', array('class'=>'control-label text-right col-md-5'))
		              	.'<div class="col-md-7 text-primary"><strong>'.$row[$encabezado[$k]].'</strong></div>
		            </div>';
				}

		      	echo $tabla;
			}
		}
	}
}