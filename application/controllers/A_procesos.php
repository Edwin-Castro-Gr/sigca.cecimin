<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_procesos extends CI_Controller {
	
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
			$data_usua['titulo']="Procesos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='procesos/index';
			$data_usua['entrada_js']='_js/procesos.js';
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


	public function mapa() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$this->load->helper('funciones_select');
			$data_usua['titulo']="Procesos";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='procesos/mapa';
			$data_usua['entrada_js']='_js/procesos.js';
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
    		<script src="'.base_url('plugins/datatables.net-responsive@2.2.7/js/dataTables.responsive.min.js').'"></script>
    		<script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/bootbox.all.min.js"></script>';

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
				echo listar_procesos_tabla('WEB');
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
					'id_macroproceso'=>$this->input->post('macroprocesos_procesos'), 
					'nombre'=>$this->input->post('nombre'),
					'prefijo'=>$this->input->post('prefijo'), 
					'objetivo'=>$this->input->post('objetivo'),					
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('procesos', $registro);
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

	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('L', 'mm', 'LETTER');
	        $pdf->AliasNbPages();
	        
	        $pdf->hoja = 'LETTER';
	        $pdf->SetTitle("SIGCA - Listado de Procesos", true);
	        $pdf->SetLeftMargin(9);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('L', 'LETTER');
            
            $pdf->Ln(32);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE PROCESOS '), 0, 0, 'C', false);
            $pdf->Ln(8);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(250,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(13);

            $campos =' p.id_proceso AS "Id", p.nombre AS "Nombre", p.prefijo AS "Prefijo", p.objetivo AS "Objetivo", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
            $query = $this->general_model->consulta_personalizada($campos, 'procesos p ', '', 'p.nombre', 0, 0);

            $encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(30,5,' ',0,0,'C',false);
			$pdf->Cell(15,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(150,5,utf8_decode("NOMBRE"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,utf8_decode("ABRV"),'LTRB',0,'C',$fill);
			$pdf->Cell(25,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(30,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(30,5,' ',0,0,'C',false);
                $pdf->Cell(15,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(150,5,utf8_decode($row->Nombre),'LTRB',0,'C',$fill);
                $pdf->Cell(20,5,utf8_decode($row->Prefijo),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(25,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(30,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Procesos.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_Procesos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE PROCESOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_procesos_tabla('EXCEL')); 
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
				$query = $this->general_model->update('procesos', 'id_proceso', $this->input->post('idreg'), $registro);
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
			$query=$this->general_model->select_where('id_proceso, id_macroproceso, nombre, prefijo, objetivo,  estado', 'procesos', array('id_proceso' => $id) );
			$row = $query->row_array();
				
			$arr['procesos'] = array('id_proceso'=>$row['id_proceso'], 'id_macroproceso'=>$row['id_macroproceso'], 'nombre'=>$row['nombre'], 'prefijo'=>$row['prefijo'], 'objetivo'=>$row['objetivo'], 'estado'=>$row['estado']);
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
					'id_macroproceso'=>$this->input->post('macroprocesos_procesos'), 
					'nombre'=>$this->input->post('nombre'), 
					'prefijo'=>$this->input->post('prefijo'), 
					'objetivo'=>$this->input->post('objetivo'), 
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('procesos', 'id_proceso', $this->input->post('idregistro'), $registro);
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

	public function cargar_subprocesos(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$idproc = $this->input->post('idproc');

				$campos = 'sp.id_subproceso AS "Id", sp.nombre AS "Nombre"';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'subprocesos sp INNER JOIN procesos p ON sp.id_proceso = p.id_proceso', 'sp.estado="1" AND p.id_proceso = "'.$idproc.'"', '', 0, 0);
		    	$tabla='';

		    	$tabla.='<div class="card-body bg-white  border-t-0 brc-primary-m4">
                            <div class="row d-flex mx-3 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">';

		    	foreach ($query->result_array() as $row)
			    {

			    $tabla .='<div class="col-12 col-sm-4 px-2">
                            <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-105 text-primary align-items-center" id="btntipodocumentos_S_'.$row['Id'].'">
                                <input class="invisible pos-abs" name="subproceso_'.$row['Id'].'" type="radio" value=""/>
                                '.$row['Nombre'].'  
                            </button>
                        </div> ';                        			    	
			    }
			    $tabla .='<div class="col-12 col-sm-4 px-2">
                            <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-105 text-primary align-items-center" id="btntipodocumentos_P_'.$idproc.'">
                                <input class="invisible pos-abs" name="transversales_'.$idproc.'" type="radio" value=""/>
                                Transversales  
                            </button>
                        </div> ';

			    $tabla.='</div></div>';

			    echo $tabla;
			}
		}
	}

	public function cargar_tiposDocumentos(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				
				$idreg = $this->input->post('idreg');
				$idreg2 =$this->input->post('idreg2');
				$query = "";

				$campos = 'd.id_tipo AS "Id", td.nombre AS "Nombre"';
      	
      	if($idreg=="S"){
      		$query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos td ON d.id_tipo=td.id_tipo', 'd.id_subproceso = "'.$idreg2.'" GROUP BY d.id_tipo', '', 0, 0);      		
      	}else if($idreg =="P"){
      		$query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos td ON d.id_tipo=td.id_tipo', 'd.id_procesomaestro = "'.$idreg2.'" GROUP BY d.id_tipo', '', 0, 0);
      		
      	}else {
      		$query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos td ON d.id_tipo=td.id_tipo', 'd.id_macroproceso = "'.$idreg2.'" GROUP BY d.id_tipo', '', 0, 0);      		
      	}
	    	
	    	
	    	$tabla='';

	    	$tabla.='<div class="card-body bg-white  border-t-0 brc-primary-m4">
                          <div class="row d-flex mx-4 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">';
                          
	    	foreach ($query->result_array() as $row)
		    {

		    $tabla .='<div class="col-12 col-sm-4 px-2">
                    <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-100 text-primary align-items-center" id="btnverdocumentos_'.$idreg.'_'.$idreg2.'_'.$row['Id'].'">
                        <input class="invisible pos-abs" name="tipodoc_'.$row['Id'].'" type="radio" value=""/>
                        '.$row['Nombre'].'  
                    </button>
                	</div> ';			    	
		    }

		    $tabla.='</div></div>';

		    echo $tabla;
			}
		}
	}


	public function listar_documentos(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				
				$idreg = $this->input->post('idreg');
				$idreg2 = $this->input->post('idreg2');
				$idreg3 = $this->input->post('idreg3');

				$campos = 'd.id_documento AS "Id", d.nombre AS "Nombre", CONCAT(v.ruta,v.archivo) AS "Ver"';
      			$query="";

      			if($idreg=="S"){
      				$query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos t ON d.id_tipo = t.id_tipo INNER JOIN procesos p ON d.id_procesomaestro = p.id_proceso INNER JOIN subprocesos sp ON d.id_subproceso = sp.id_subproceso INNER JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"', 'd.id_subproceso="'.$idreg2.'" AND d.id_tipo="'.$idreg3.'"' , 'd.nombre', 0, 0);
      			}else if($idreg=="P"){
      				$query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos t ON d.id_tipo = t.id_tipo LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso = sp.id_subproceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"', 'd.id_procesomaestro="'.$idreg2.'" AND d.id_subproceso IS NULL AND d.id_tipo="'.$idreg3.'"' , 'd.nombre', 0, 0);
      			}else {      				
      				$query = $this->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos t ON d.id_tipo = t.id_tipo LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso = sp.id_subproceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"', 'd.id_macroproceso="'.$idreg2.'" AND d.id_procesomaestro IS NULL AND d.id_subproceso IS NULL AND d.id_tipo="'.$idreg3.'"' , 'd.nombre', 0, 0);
      			}
		    	
		    	$tabla='';

		    	$tabla.='<div class="card-body bg-white  border-t-0 brc-primary-m4">
                            <div class="row d-flex mx-3 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">';

		    	foreach ($query->result_array() as $row)
			    {
					$ancla = '<i class="w-3 text-center fa fa-times text-110 text-danger-m2"></i>';
					if($row['Ver'] != "")
						$ancla = anchor(base_url().'/'.$row['Ver'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 1px 1px;font-size: 18px;','target'=>'_blank'));
					$tabla .= '
					<div class="row d-flex justify-content-between">'.
		            	form_label($row['Nombre'].': ','', array('class'=>'control-label text-left col-md-10'))
		              	.'<div class="col-md-2 text-primary"><strong>'.$ancla.'</strong></div>
		              	
		            </div>';		    	
			    }

			    $tabla.='</div></div>';

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

				$campos = ' aa.id_proceso AS "Id", aa.nombre AS "Nombre", aa.prefijo AS "Prefijo", aa.objetivo AS "Objetivo", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'procesos aa', ' aa.id_proceso = "'.$idreg.'" ', '', 0, 0);
		      
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