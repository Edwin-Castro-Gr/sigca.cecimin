<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class R_secciones extends CI_Controller {
	
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
			$data_usua['titulo']="Secciones";
			$data_usua['origen']="Rondas de Seguridad";
			$data_usua['contenido']='rsecciones/index';
			$data_usua['entrada_js']='_js/rsecciones.js';
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
	
	public function listar_secciones() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->helper('funciones_tabla');
				echo listar_secciones_tablas('WEB');
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
				$preguntas = $this->input->post('preguntas');
				$val_preguntas = implode(',', (array) $preguntas);

				$registro=array(
					'id_ronda'=>$this->input->post('rondas_secciones'), 
					'nombre'=>$this->input->post('nombre'),
					'tipo_respuesta'=>$this->input->post('tiporespuesta'), 	
					'fecha_registro'=>$fecha, 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('rondas_seccion', $registro);
				if($query >= 1){
					$id_seccion = $query;
					$a_pregunta = explode(",", $val_preguntas);
					if(is_array($a_pregunta)){
						foreach ($a_pregunta as $value) {
							$registro = array(
								'id_seccion'=>$id_seccion,
								'nombre'=> $value,
								'id_usuario_registra'=>$this->session->userdata('C_id_usuario'),
								'fecha_registro'=>$fecha,
								'estado'=>'0'
							);
							$query1 = $this->general_model->insert('rondas_preguntas', $registro);
						}
					}else{
				        foreach ((array)$a_pregunta as $value) {
				        	$registro = array(
								'id_seccion'=>$id_seccion,
								'nombre'=> $value,
								'id_usuario_registra'=>$this->session->userdata('C_id_usuario'),
								'fecha_registro'=>$fecha,
								'estado'=>'0'
							);
							$query1 = $this->general_model->insert('rondas_preguntas', $registro);
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
			} 
		}
	}

	// public function pdf() {
	// 	if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
	// 		redirect(base_url());
	// 	else {
	// 		$this->load->library('Pdffpdf');

	//         $pdf = new Pdffpdf('L', 'mm', 'LETTER');
	//         $pdf->AliasNbPages();
	        
	//         $pdf->hoja = 'LETTER';
	//         $pdf->SetTitle("SIGCA - Listado de Procesos", true);
	//         $pdf->SetLeftMargin(9);
	//         $pdf->SetRightMargin(3);
	        
	//         $pdf->AddPage('L', 'LETTER');
            
    //         $pdf->Ln(32);
    //         $pdf->SetFont('helvetica','B',14);
    //         $pdf->SetTextColor(0,0,0);
    //         $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE PROCESOS '), 0, 0, 'C', false);
    //         $pdf->Ln(8);

    //         $pdf->SetFont('helvetica','B',6);
    //         $pdf->Cell(250,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
    //         $pdf->Cell(7,5,' ', 0, 0, 'C', false);
    //         $pdf->Ln(13);

    //         $campos =' p.id_proceso AS "Id", p.nombre AS "Nombre", p.prefijo AS "Prefijo", p.objetivo AS "Objetivo", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    //         $query = $this->general_model->consulta_personalizada($campos, 'procesos p ', '', 'p.nombre', 0, 0);

    //         $encabezados = $query->result();
			
	// 		$x = 1;
	// 		$fill = true;
	// 		$pdf->SetFont('helvetica','B', 10);
	// 		$pdf->SetFillColor(200,220,255);
	// 		$pdf->Cell(30,5,' ',0,0,'C',false);
	// 		$pdf->Cell(15,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
	// 		$pdf->Cell(150,5,utf8_decode("NOMBRE"),'LTRB',0,'C',$fill);
	// 		$pdf->Cell(20,5,utf8_decode("ABRV"),'LTRB',0,'C',$fill);
	// 		$pdf->Cell(25,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
	// 		$pdf->Cell(30,5,' ',0,0,'C',false);
	// 		$pdf->Ln(5);
	// 		$fill = false;
	// 		$pdf->SetFont('helvetica','', 10);
	// 		$pdf->SetFillColor(255,180,180);
	//         foreach ($encabezados as $row) {
	//         	$pdf->Cell(30,5,' ',0,0,'C',false);
    //             $pdf->Cell(15,5,($row->Id),'LTRB',0,'C',$fill);
    //             $pdf->Cell(150,5,utf8_decode($row->Nombre),'LTRB',0,'C',$fill);
    //             $pdf->Cell(20,5,utf8_decode($row->Prefijo),'LTRB',0,'C',$fill);
    //             if($row->Estado == "Activo")
    //             	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',$fill);
    //             else
    //             	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',!$fill);
    //             $pdf->Cell(30,5,' ',0,0,'C',false);

	//             $pdf->Ln(5);
	//         }
	    
	//         $pdf->Output('I', "Listado_Procesos.pdf");
	// 	}//-Valida Inicio de Session
	// }

	// public function excel() {
	// 	if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
	// 		redirect(base_url());
	// 	else {
	// 		$filename = "Listado_Procesos.xls";
	// 	    header ("Content-Disposition: attachment; filename=".$filename ); 
	// 		header ("Content-Type: application/vnd.ms-excel");
			
	// 		$this->load->helper('funciones_tabla');
			
	// 	    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE PROCESOS</th></tr></table><br>');

	// 	    echo '<table border="1">';
    //         echo utf8_decode(listar_procesos_tabla('EXCEL')); 
    //         echo '</table>';			
	// 	}//-Valida Inicio de Session
	// }

	public function inactivar() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				$registro=array('estado'=>'0');
				$query = $this->general_model->update('rondas_seccion', 'id_seccion', $this->input->post('idreg'), $registro);
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
			$query=$this->general_model->select_where('id_seccion, id_ronda, nombre, tipo_respuesta, estado', 'rondas_seccion', array('id_seccion' => $id) );
			$row = $query->row_array();
				
			$arr['secciones'] = array('seccion'=>$row['id_seccion'],'ronda'=>$row['id_ronda'], 'nombre'=>$row['nombre'], 'tiporespuesta'=>$row['tipo_respuesta'], 'estado'=>$row['estado']);
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

					'id_ronda'=>$this->input->post('rondas_secciones'), 
					'nombre'=>$this->input->post('nombre'),
					'tipo_respuesta'=>$this->input->post('tiporespuesta'), 	
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('rondas_seccion', 'id_seccion', $this->input->post('idregistro'), $registro);
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

	public function cargar_rondas(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {				

				$campos = 'id_ronda AS "Id", nombre AS "Nombre"';
      
		    	$query = $this->general_model->consulta_personalizada($campos,'rondas', 'estado = "1"', '', 0, 0);
		    	$tabla='';

		    	$tabla.='<div class="card-body bg-white border-1 border-t-1 brc-primary-m4">
                        <div class="row d-flex mx-3 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">';

		    	foreach ($query->result_array() as $row)
			    {

			    $tabla .=' <div class="col-12 col-sm-3 px-2">
                           <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-85 text-primary align-items-center" id="btnronda_'.$row['Id'].'">
                             	<input class="invisible pos-abs" name="ronda_'.$row['Id'].'" type="radio" value="'.$row['Id'].'"/>
                             	'.$row['Nombre'].'  
                           </button>
                        </div> ';                        			    	
			    }
			    
			    $tabla.='</div></div>';

			    echo $tabla;
			}
		}
	}
	
	public function listar_preguntas() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idreg = $this->input->post('id_seccion');

				$campos ='id_items AS "id", nombre AS "Nombre"';
            	$query = $this->general_model->consulta_personalizada($campos, 'rondas_preguntas', ' id_seccion = "'.$idreg.'" ', '', 0, 0);

				$encabezado = array();
				$i = 1;
				$tabla='';
				foreach ($query->result_array() as $row)
				{
					$tabla .= '<div class="container">
					<div class="row">'.
		            	$i++ . form_label($row['Nombre'].' ','', array('class'=>'control-label text-left col-md-10')).'
		              	</div>
		            </div></div>';
				}				
		      	echo $tabla;
			}
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

				$campos = ' se.id_seccion AS "Sección", r.nombre AS "Ronda", se.nombre AS "Nombre de la Sección", CASE WHEN se.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'rondas_seccion se INNER JOIN rondas r ON se.id_ronda = r.id_ronda', ' se.id_seccion = "'.$idreg.'" ', '', 0, 0);
		      
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