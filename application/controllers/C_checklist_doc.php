<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_checklist_doc extends CI_Controller {
	
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
			$data_usua['titulo']=" Checklist de Documentos para contratos";
			$data_usua['origen']="Contratos";
			$data_usua['contenido']='c_checklist/index';
			$data_usua['entrada_js']='_js/c_checklist.js';
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
				echo listar_checklist_doc_tabla('WEB');
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

					'id_cargo'=>$this->input->post('cargos_checklist'),	
					'tipo_contrato'=>$this->input->post('tiposcontratos_chechklist'),
					'listado_documentos'=>$this->input->post('listado_documentos_chechklist'),				
					'estado'=>'1'
				);

				$query = $this->general_model->insert('ckeklist_contratosp', $registro);
				if($query >= 1)
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El Concepto ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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
	        $pdf->SetTitle("SIGCA - Listado de Conceptos de Contratos", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('P', 'LETTER');
            
            $pdf->Ln(26);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO CONCEPTOS DE CONTRATOS'), 0, 0, 'C', false);
            $pdf->Ln(8);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(196,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(13);

            $campos ='cc.id_checklist AS "Id", c.nombre AS "Cargos", ld.nombre AS "Documentos", CASE WHEN a.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
			$query = $this->general_model->consulta_personalizada($campos, 'ckeklist_contratosp cc INNER JOIN cargos c ON cc.id_cargo = c.id_cargo INNER JOIN listado_documentos ld ON find_in_set(ld.id_listado, cc.listado_documentos)', '', '', 0, 0);

            $encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(30,5,' ',0,0,'C',false);
			$pdf->Cell(16,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(70,5,utf8_decode("CARGOS"),'LTRB',0,'C',$fill);
			$pdf->Cell(10,5,utf8_decode("DOCUMENTOS"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(4,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(30,5,' ',0,0,'C',false);
                $pdf->Cell(16,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(70,5,utf8_decode($row->Cargos),'LTRB',0,'C',$fill);                
                $pdf->Cell(70,5,utf8_decode($row->Documentos),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(30,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Checklist_documentos.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Checklist_documentos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">CHECKLIST DE DOCUMENTOS DE CONTRATOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_conceptos_tabla('EXCEL')); 
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
				$query = $this->general_model->update('conceptos_contratost', 'id_concepto', $this->input->post('idreg'), $registro);
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
			$query=$this->general_model->select_where('id_concepto, nombre, prefijo, estado', 'conceptos_contratost', array('id_concepto' => $id) );
			$row = $query->row_array();
				
			$arr['conceptos'] = array('id_concepto'=>$row['id_concepto'], 'nombre'=>$row['nombre'],'prefijo'=>$row['prefijo'],'estado'=>$row['estado']);
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
					'prefijo'=>$this->input->post('prefijo'),
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('conceptos_contratost', 'id_concepto', $this->input->post('idregistro'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El concepto ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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

				$campos = ' a.id_concepto AS "Id", a.nombre AS "Nombre", a.prefijo AS "Prefijo", CASE WHEN a.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'conceptos_contratost a', ' a.id_concepto = "'.$idreg.'" ', '', 0, 0);
		      
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