<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_bloquesQx extends CI_Controller {

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
			$data_usua['titulo']="Bloques";
			$data_usua['origen']="Cirugias";
			$data_usua['contenido']='bloquesQx/index';
			$data_usua['entrada_js']='_js/bloquesQx.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">';

			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>    		
			<script src="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.js').'"></script>

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
				echo listar_listar_bloquesQx_tabla_tabla('WEB');
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
				$registro=array(
					'id_agenda'=>'', 
					'id_cirujano'=>$this->input->post('cirujanos_bloques'),
					'dia'=>$this->input->post('dia'),
					'frecuencia'=>$this->input->post('frecuencia'), 
					'hinicio'=>time('H:i:s'), 
					'hfinal'=>time('H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'fecha_registro'=>$fecha,
					'estado'=>'1'
				);

				$query = $this->general_model->insert('programacion_agenda_cirujano', $registro);
				if($query >= 1)
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El cargo ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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

	        $pdf = new Pdffpdf('L', 'mm', 'LETTER');
	        $pdf->AliasNbPages();
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Listado de Bloques", true);
	        $pdf->SetLeftMargin(9);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('L', 'LETTER');
            
            $pdf->Ln(30);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE BLOQUES         '), 0, 0, 'C', false);
            $pdf->Ln(8);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(260,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(13);

            $campos ='pgc.id_agenda AS "Id", IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Cirujano", c.nombre AS "Cargo", pgc.id_dia AS "Día", CASE WHEN pgc.frecuencia = "0" THEN "Semanal" WHEN pgc.frecuencia = "1" THEN "Quincenal" WHEN pgc.frecuencia = "2" THEN "Mensual" END AS "Frecuencia", pgc.hora_inicio AS "Hora_Inicio", pgc.hora_final AS "Hora_Final", CASE WHEN pgc.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
			$query = $this->general_model->consulta_personalizada($campos, 'programacion_agenda_cirujano pgc INNER JOIN empleados e ON pgc.id_cirujano = e.id_empleado INNER JOIN cargos c ON e.id_cargo = c.id_cargo', '', '', 0, 0);

            $encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Cell(16,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(93,5,utf8_decode("CIRUJANO"),'LTRB',0,'C',$fill);
			$pdf->Cell(93,5,utf8_decode("CARGO"),'LTRB',0,'C',$fill);
			$pdf->Cell(35,5,utf8_decode("DIA"),'LTRB',0,'C',$fill);
			$pdf->Cell(35,5,utf8_decode("FRECUENCIA"),'LTRB',0,'C',$fill);
			$pdf->Cell(35,5,utf8_decode("HORA INICIO"),'LTRB',0,'C',$fill);
			$pdf->Cell(35,5,utf8_decode("HORA FINAL"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 8);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(4,5,' ',0,0,'C',false);
                $pdf->Cell(16,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(93,5,utf8_decode($row->Cirujano),'LTRB',0,'C',$fill);
                $pdf->Cell(93,5,utf8_decode($row->Cargo),'LTRB',0,'C',$fill);
                $pdf->Cell(35,5,utf8_decode($row->Día),'LTRB',0,'C',$fill);                
                $pdf->Cell(35,5,utf8_decode($row->Frecuencia),'LTRB',0,'C',$fill);
                $pdf->Cell(35,5,utf8_decode($row->Hora_Inicio),'LTRB',0,'C',$fill);                
                $pdf->Cell(35,5,utf8_decode($row->Hora_Final),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(4,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_cargos.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_cargos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE CARGOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_bloquesQx_tabla('EXCEL')); 
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
				$query = $this->general_model->update('programacion_agenda_cirujano', 'id_agenda ', $this->input->post('idreg'), $registro);
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
			
			$query=$this->general_model->select_where('id_agenda, id_cirujano, id_dia, frecuencia, hora_inicio, hora_final, estado', 'programacion_agenda_cirujano', array('id_agenda' => $id) );
			$row = $query->row_array();
				
			$arr['bloques'] = array('id_agenda'=>$row['id_agenda'], 'id_cirujano'=>$row['id_cirujano'], 'id_dia'=>$row['id_dia'], 'frecuencia'=>$row['frecuencia'], 'hora_inicio'=>$row['hora_inicio'], 'hora_final'=>$row['hora_final'], 'estado'=>$row['estado']);
			echo json_encode( $arr );
		}
	}

	public function cargar_cargo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {

			$idreg = $this->input->post('id_cirujano');
			$campos = 'c.nombre AS "Cargo"';
		    
		    $query = $this->general_model->consulta_personalizada($campos, 'empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo', 'e.id_empleado = "'.$idreg.'" ', 0, 0);
		    foreach ($query->result_array() as $row)
      		{
		    	echo($row['Cargo']);
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
				$registro=array(
					'dia'=>$this->input->post('dia'),
					'frecuencia'=>$this->input->post('frecuencia'), 
					'hinicio'=>time('H:i:s'), 
					'hfinal'=>time('H:i:s'), 
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('programacion_agenda_cirujano', 'id_agenda', $this->input->post('idregistro'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El cargo ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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

				$campos = 'pgc.id_agenda AS "Id", IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Cirujano", c.nombre AS "Cargo", pgc.id_dia AS "Día", CASE WHEN pgc.frecuencia = "0" THEN "Semanal" WHEN pgc.frecuencia = "1" THEN "Quincenal" WHEN pgc.frecuencia = "2" THEN "Mensual" END AS "Frecuencia", pgc.hora_inicio AS "Hora Inicio", pgc.hora_final AS "Hora Final", CASE WHEN pgc.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
		    	$query = $this->general_model->consulta_personalizada($campos, 'programacion_agenda_cirujano pgc INNER JOIN empleados e ON pgc.id_cirujano = e.id_empleado INNER JOIN cargos c ON e.id_cargo = c.id_cargo', ' pgc.id_agenda = "'.$idreg.'" ', 0, 0);
		      
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
}