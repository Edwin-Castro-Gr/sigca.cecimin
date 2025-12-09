<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_politicas extends CI_Controller {

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
			$data_usua['titulo']="Politicas";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='politicas/index';
			$data_usua['entrada_js']='_js/politicas.js';
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
				echo listar_politicas_tabla('WEB');
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
					'id_politica'=>'',
					'nombre'=>$this->input->post('nombre'),
					'descripcion'=>$this->input->post('descripcion'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('politicas', $registro);
				if($query >= 1)
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "La politica ingresada, ya se encuentra registrada; Por favor verifique los datos!"; break;
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
	        $pdf->tipo = 'POLITICA';
	        $pdf->SetTitle("SIGCA - Politicas de la Entidad", true);
	        $pdf->SetMargins(29, 38 , 29);
	        
	        $pdf->AddPage('P', 'LETTER');
	        
            $pdf->Ln(10);
            $pdf->SetFont('helvetica','B',12);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('CIRCULAR DE GERENCIA'), 0, 0, 'C', false);
            $pdf->Ln(10);

            $pdf->SetFont('helvetica','',10);
            $x1 = $pdf->GetX();
            $y1 = $pdf->GetY();
        	
        	//$pdf->SetXY($x1+8,$y1);
        	$pdf->MultiCell(0,5,utf8_decode('La gerencia general en compromiso con el mejoramiento del Sistema Obligatorio de Garantía de la Calidad - SOGC, del Centro de Cirugía Mínima Invasiva CECIMIN S.A.S, aprueba las siguientes políticas:'),0,'J',0,0,'','',false);
	        $ny1 = $pdf->GetY();
	        $pdf->Ln(5);

            $campos ='p.id_politica AS "Id", p.nombre AS "Nombre",p.descripcion AS "Descripcion" ';
			$query = $this->general_model->consulta_personalizada($campos, 'politicas p', 'p.estado="1"', '', 0, 0);

            $encabezados = $query->result();
			
	        foreach ($encabezados as $row) {
	        	$pdf->SetFont('helvetica','B', 10);
				$pdf->SetFillColor(200,220,255);
				$pdf->Cell(0,5,utf8_decode($row->Nombre),0,0,'L',false);
				$pdf->Ln(5);

				$pdf->SetFont('helvetica','', 10);
				$pdf->SetFillColor(255,180,180);
				$pdf->MultiCell(0,5,utf8_decode($row->Descripcion),0,'J',0,0,'','',false);
	            $pdf->Ln(5);
	        }
	        $pdf->Ln(3);

	        $pdf->MultiCell(0,5,utf8_decode('Son responsable del cumplimiento de las políticas todos los funcionarios del ámbito administrativo y asistencial. '),0,'J',0,0,'','',false);

	        $pdf->Ln(8);

	        $pdf->MultiCell(0,5,utf8_decode('Se solicita que las políticas establecidas sean incorporadas a partir de la fecha de su aprobación, a la estructura documental de la institución, por cada uno de los responsables de los procesos.'),0,'J',0,0,'','',false);

	        $pdf->Ln(8);

	        $pdf->MultiCell(0,5,utf8_decode('Por lo anterior, se firma a los 3 días del mes de mayo de 2021.'),0,'J',0,0,'','',false);

	        $pdf->Ln(16);
	        $pdf->Cell(0,5,utf8_decode('Cordialmente,'),0,0,'L',false);
	        $pdf->Ln(30);

	        $pdf->Image('assets/image/logo.png',30,120,20,0,'PNG');

	        $pdf->SetFont('helvetica','B', 10);
	        $pdf->Cell(0,5,utf8_decode('Liliana Patricia García Castillo'),0,0,'L',false);
	        $pdf->Ln(5);
	        $pdf->SetFont('helvetica','', 10);
	        $pdf->Cell(0,5,utf8_decode('Gerente'),0,0,'L',false);
	        $pdf->Ln(5);
	         $pdf->Cell(0,5,utf8_decode('CECIMIN S.A.S'),0,0,'L',false);
	    
	    	
	        $pdf->Output('I', "politicas de la Empresa.pdf");
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
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE POLITICAS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_politicas_tabla('EXCEL')); 
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
				$query = $this->general_model->update('politicas', 'id_politica', $this->input->post('idreg'), $registro);
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
			
			$query=$this->general_model->select_where('id_politica, nombre, descripcion, estado', 'politicas', array('id_politica' => $id) );
			$row = $query->row_array();
				
			$arr['politicas'] = array('id_politica'=>$row['id_politica'], 'nombre'=>$row['nombre'], 'descripcion'=>$row['descripcion'], 'estado'=>$row['estado']);
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
					'nombre'=>$this->input->post('nombre'),
					'descripcion'=>$this->input->post('descripcion'),
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('politicas', 'id_politica', $this->input->post('idregistro'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "La Policita ingresada, ya se encuentra registrada; Por favor verifique los datos!"; break;
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

				$campos = 'p.id_politica AS "Id", p.nombre AS "Nombre",p.descripcion AS "Descripcion", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
		    	$query = $this->general_model->consulta_personalizada($campos, 'politicas p ', ' p.id_politica = "'.$idreg.'" ', 0, 0);
		      
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