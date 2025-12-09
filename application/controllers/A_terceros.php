<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_terceros extends CI_Controller {

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
			$data_usua['titulo']="Terceros";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='terceros/index';
			$data_usua['entrada_js']='_js/terceros.js';
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
				echo listar_terceros_tabla('WEB');
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
					
					'tipo_tercero'=>$this->input->post('tipo_tercero'),
					'tipo_documento'=>$this->input->post('Tipo_docidentidad_terceros'),
					'materialesqx'=>$this->input->post('materialqx'),
					'numero_id'=>$this->input->post('numeroid'),
					'razon_social'=>$this->input->post('razonsocial'),
					'nombre_contacto'=>$this->input->post('nombre_contacto'), 
					'telefono_contacto'=>$this->input->post('telefono_contacto'),
					'correo_contacto'=>$this->input->post('correo_contacto'),
					'sigla'=>$this->input->post('sigla'), 
					'proveedor_critico'=>$this->input->post('proveedor_critico'),
					'fecha_registro'=>date('Y-m-d H:i:s'), 
					'id_usuario'=>$this->session->userdata('C_id_usuario'), 
					'estado'=>'1'
				);

				$query = $this->general_model->insert('terceros', $registro);

				$registro0 = array(
					'id_tercero'=>$query,
					'id_usuario_temp '=>''
				);
					$query0 = $this->general_model->update('terceros_correos', 'id_usuario_temp', $this->session->userdata('C_id_usuario'), $registro0);
					// echo '1';
				
				if($query >= 1)
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El tercero ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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
        $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE TERCEROS  '), 0, 0, 'C', false);
	    $pdf->Ln(10);

	    $pdf->SetFont('helvetica','B',6);
        $pdf->Cell(250,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
        $pdf->Cell(7,5,' ', 0, 0, 'C', false);
        $pdf->Ln(5);
	}

	private function addTableHeader($pdf, $fill) {
		$pdf->SetFont('helvetica','B',8);
	    $pdf->Cell(4, 5, ' ', 0, 0, 'C', false);
	    $pdf->Cell(25, 5, utf8_decode("NUMERO"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(80, 5, utf8_decode("RAZON SOCIAL / NOMBRE"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(22, 5, utf8_decode("TELEFONO"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(60, 5, utf8_decode("EMAIL"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(25, 5, utf8_decode("TIPO TERCERO"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(18, 5, utf8_decode("P. CRITICO"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(17, 5, utf8_decode("ESTADO"), 'LTRB', 0, 'C', $fill);
	    $pdf->Cell(4, 5, ' ', 0, 0, 'C', false);
	    $pdf->Ln(5);
	}

	public function pdf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect(base_url());
		else {
			$this->load->library('Pdffpdf');

	        $pdf = new Pdffpdf('P', 'mm', 'LETTER');
	        $pdf->AliasNbPages();

	        // Agregar encabezado
	        $pdf->SetMargins(10, 30, 3);
	        $pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico
	        $pdf->AddPage('L', 'LETTER');
	        $this->addPdfHeader($pdf);
	            
	        $campos ='t.numero_id AS "Numero", t.razon_social AS "Razon", t.telefono_contacto AS "Telefono", t.correo_contacto AS "Correo", CASE WHEN t.tipo_tercero = "0" THEN "Proveedor" ELSE "Cliente" END AS "Tipo", CASE WHEN t.proveedor_critico ="0" THEN "Si" ELSE "No" END AS "Critico" , CASE WHEN t.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
	        $query = $this->general_model->consulta_personalizada($campos, 'terceros t', '', '', 0, 0);

	        $encabezados = $query->result();

	        $fill = true;
	        $pdf->SetFont('helvetica','B', 9);
	        $pdf->SetFillColor(200,220,255);
	        $this->addTableHeader($pdf, $fill);

	        $fill = false;
	        $pdf->SetFont('helvetica','', 8);
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
	            $pdf->Cell(4,5,' ',0,0,'C',false);
	            $pdf->Cell(25,5,utf8_decode($row->Numero),'LTRB',0,'C',$fill);
	            $pdf->Cell(80,5,utf8_decode($row->Razon),'LTRB',0,'C',$fill);
	            $pdf->Cell(22,5,utf8_decode($row->Telefono),'LTRB',0,'C',$fill);
	            $pdf->Cell(60,5,utf8_decode($row->Correo),'LTRB',0,'C',$fill);
	            $pdf->Cell(25,5,($row->Tipo),'LTRB',0,'C',$fill);
	            if($row->Critico == "Si")
	                $pdf->Cell(18,5,$row->Critico,'LTRB',0,'C',$fill);
	            else
	                $pdf->Cell(18,5,$row->Critico,'LTRB',0,'C',!$fill);
	            if($row->Estado == "Activo")
	                $pdf->Cell(17,5,$row->Estado,'LTRB',0,'C',$fill);
	            else
	                $pdf->Cell(17,5,$row->Estado,'LTRB',0,'C',!$fill);
	            $pdf->Cell(4,5,' ',0,0,'C',false);

	            $pdf->Ln(5);

	        }

	        

	        $pdf->Output('I', "Listado_Terceros.pdf");
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
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE TERCEROS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_terceros_tabla('EXCEL')); 
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
				$query = $this->general_model->update('terceros', 'id_tercero', $this->input->post('idreg'), $registro);
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
			
			$query=$this->general_model->select_where('id_tercero, tipo_tercero, materialesqx, tipo_documento, numero_id, razon_social, nombre_contacto, telefono_contacto, correo_contacto, sigla, proveedor_critico, estado', 'terceros', array('id_tercero' => $id) );
			$row = $query->row_array();
				
			$arr['terceros'] = array('id_tercero'=>$row['id_tercero'], 'tipo_tercero'=>$row['tipo_tercero'],'materialesqx'=>$row['materialesqx'], 'tipo_documento'=>$row['tipo_documento'], 'numero_id'=>$row['numero_id'], 'razon_social'=>$row['razon_social'], 'nombre_contacto'=>$row['nombre_contacto'], 'telefono_contacto'=>$row['telefono_contacto'], 'correo_contacto'=>$row['correo_contacto'], 'sigla'=>$row['sigla'], 'proveedor_critico'=>$row['proveedor_critico'], 'estado'=>$row['estado']);
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
							
				$registro0 = array(
					'id_tercero'=>$this->input->post('idregistro'),
					'id_usuario_temp '=>''
				);
					$query0 = $this->general_model->update('terceros_correos', 'id_usuario_temp', $this->session->userdata('C_id_usuario'), $registro0);
					// echo '1';
				
				$registro=array(

					'tipo_tercero'=>$this->input->post('tipo_tercero'),
					'tipo_documento'=>$this->input->post('Tipo_docidentidad_terceros'), 
					'numero_id'=>$this->input->post('numeroid'),
					'razon_social'=>$this->input->post('razonsocial'),
					'nombre_contacto'=>$this->input->post('nombre_contacto'), 
					'telefono_contacto'=>$this->input->post('telefono_contacto'),
					'correo_contacto'=>$this->input->post('correo_contacto'),
					'sigla'=>$this->input->post('sigla'), 
					'proveedor_critico'=>$this->input->post('proveedor_critico'),
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('terceros', 'id_tercero', $this->input->post('idregistro'), $registro);
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

				$campos = 't.tipo_tercero AS "Tipo", t.tipo_documento AS "Tipo de Documento", t.numero_id AS "Numero", t.razon_social AS "Razón Social / Nombre", t.nombre_contacto AS "Nombre Contacto", t.telefono_contacto AS "Telefono  Contacto", t.correo_contacto AS "Email", t.sigla AS "Sigla", t.proveedor_critico AS "Proveedor Critico", t.estado AS "Estado"';
		    	$query = $this->general_model->consulta_personalizada($campos, 'terceros t ', ' t.id_tercero = "'.$idreg.'" ', 0, 0);
		      
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

//**************************** CORREOS CASAS COMERCIALES ******************************************************//

	public function guardar_correo() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				
				$registro=array(
					
					'id_tercero'=>$this->session->userdata('C_id_usuario'),
					'correo' => $this->input->post('correo'),					
					'fecha_registro'=>date('Y-m-d H:i:s'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'id_usuario_temp'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'1'
				);

				$query = $this->general_model->insert('terceros_correos', $registro);
				if($query >= 1) {
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

	public function cargar_correos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$registrado=$this->input->post('regd');
				$id_tercero=$this->input->post('idreg');

				if($registrado=="1"){
					$campos = 'c.id_correo AS "Id", c.correo AS "Correo"';
			    	$query = $this->general_model->consulta_personalizada($campos, 'terceros_correos c', 'c.id_usuario_temp = "'.$this->session->userdata('C_id_usuario').'" ', 'c.id_correo', 0, 0);
				}else{
					$campos = 'c.id_correo AS "Id", c.correo AS "Correo"';
			    	$query = $this->general_model->consulta_personalizada($campos, 'terceros_correos c', 'c.id_tercero = "'.$id_tercero.'" ', 'c.id_correo', 0, 0);
				}
				$count=0;
				$accordion = '';
				$accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">';
				foreach ($query->result_array() as $row)
			    {  
			    	$count++;
					$accordion .='<div class="form-group row" id="div_archivo'.$row['Id'].'">
									<div class="col-sm-2 col-form-label text-sm-left pr-0">'.
		                            	form_label('Correo '.$count.'','nombre', array('class'=>'mb-0')).'
		                          	</div>
		                          	<div class="col-sm-7">'.
		                            		form_input(array('type'=>'text', 'name'=>'correo_'.$row['Id'], 'id'=>'Correo_'.$row['Id'], 'class'=>'form-control', 'value'=>$row['Correo'])).'
		                          	</div>
		                          	<div class="col-sm-3">
		                          	<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-placement="top" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'" id="btnmodificar_'.$row['Id'].'"> <i  id="btnmodificar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Correo'].'" /> </i> </a> 
		                          	</div>
		                          	';
			    	
			    
			    	$accordion .= '</div> <hr>';
			    }
			    $accordion .= '</div>';

			    echo $accordion;
			}
		}
	}
}