<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_agendaqx extends CI_Controller {
	
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
			$data_usua['titulo']="Bloques Quirurgicos";
			$data_usua['origen']="Programación";
			$data_usua['contenido']='agendaqx/index';
			$data_usua['entrada_js']='_js/agendaqx.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'">


			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/free-jqgrid@4.15.5/ui.jqgrid.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/chosen-js@1.8.7/chosen.min.css').'">

			<!-- DateTimePicker  -->
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/tiny-date-picker@3.2.8/date-range-picker.min.css').'">
			<!-- css calendar -->
			
			';
			$data_usua['librerias_js']='<!-- Sweet-Alert  -->
    		<script src="'.base_url('plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js').'"></script>
    		<script src="'.base_url('plugins/interactjs@1.10.11/dist/interact.min.js').'"></script>
    		
    		<!-- js calendar -->
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
   			<script src="'.base_url('plugins/fullcalendar@6.1.15/dist/index.global.js').'"></script>
   			<script src="'.base_url('plugins/fullcalendar@6.1.15/packages/resource-timegrid/index.global.js').'"></script>


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
		    
		    <script src="https://cdn.jsdelivr.net/npm/es6-object-assign@1.1.0/dist/object-assign-auto.min.js"></script>
		    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5.5.1/dist/iro.min.js"></script>


		    <script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>

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
				echo listar_areas_tabla('WEB');
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
					'codigo'=>$this->input->post('codigo'),
					'nombre'=>$this->input->post('nombre'),
					'fecha_registro'=>date('Y-m-d H:i:s'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'1'
				);

				$query = $this->general_model->insert('areas', $registro);
				if($query >= 1)
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El Departamento ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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
	        $pdf->SetTitle("SIGCA - Listado de Departamentos", true);
	        $pdf->SetLeftMargin(7);
	        $pdf->SetRightMargin(3);
	        
	        $pdf->AddPage('P', 'LETTER');
            
            $pdf->Ln(32);
            $pdf->SetFont('helvetica','B',14);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,0,utf8_decode('LISTADO GENERAL DE DEPARTAMENTOS   '), 0, 0, 'C', false);
            $pdf->Ln(8);

            $pdf->SetFont('helvetica','B',6);
            $pdf->Cell(192,5,utf8_decode('Fecha de Impresión: ').cargar_fechahora_formateada(),0,0,'R',false);
            $pdf->Cell(7,5,' ', 0, 0, 'C', false);
            $pdf->Ln(8);

            $campos =' aa.id_area AS "Id", aa.nombre AS "Nombre", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
			$query = $this->general_model->consulta_personalizada($campos, 'areas aa', '', '', 0, 0);

            $encabezados = $query->result();
			
			$x = 1;
			$fill = true;
			$pdf->SetFont('helvetica','B', 10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(20,5,' ',0,0,'C',false);
			$pdf->Cell(20,5,utf8_decode("ID"),'LTRB',0,'C',$fill);
			$pdf->Cell(130,5,utf8_decode("NOMBRE"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,utf8_decode("ESTADO"),'LTRB',0,'C',$fill);
			$pdf->Cell(20,5,' ',0,0,'C',false);
			$pdf->Ln(5);
			$fill = false;
			$pdf->SetFont('helvetica','', 10);
			$pdf->SetFillColor(255,180,180);
	        foreach ($encabezados as $row) {
	        	$pdf->Cell(20,5,' ',0,0,'C',false);
                $pdf->Cell(20,5,($row->Id),'LTRB',0,'C',$fill);
                $pdf->Cell(130,5,utf8_decode($row->Nombre),'LTRB',0,'C',$fill);
                if($row->Estado == "Activo")
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',$fill);
                else
                	$pdf->Cell(20,5,$row->Estado,'LTRB',0,'C',!$fill);
                $pdf->Cell(20,5,' ',0,0,'C',false);

	            $pdf->Ln(5);
	        }
	    
	        $pdf->Output('I', "Listado_Departamentos.pdf");
		}//-Valida Inicio de Session
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$filename = "Listado_Departamentos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL DE DEPARTAMENTOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode(listar_areas_tabla('EXCEL')); 
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
				$query = $this->general_model->update('areas', 'id_area', $this->input->post('idreg'), $registro);
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
			$query=$this->general_model->select_where('id_area, codigo, nombre, id_responsable, id_centrocosto, estado', 'areas', array('id_area' => $id) );
			$row = $query->row_array();
				
			$arr['areas'] = array('id_area'=>$row['id_area'], 'codigo'=>$row['codigo'],'nombre'=>$row['nombre'],'estado'=>$row['estado']);
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
					'codigo'=>$this->input->post('codigo'), 
					'nombre'=>$this->input->post('nombre'), 
					'estado'=>$this->input->post('estado')
				);
				
				$query = $this->general_model->update('areas', 'id_area', $this->input->post('idregistro'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "El Departamento ingresado, ya se encuentra registrado; Por favor verifique los datos!"; break;
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

				$campos = ' aa.id_area AS "Id", aa.codigo AS "Código",aa.nombre AS "Nombre", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
		    	$query = $this->general_model->consulta_personalizada($campos, 'areas aa', ' aa.id_area = "'.$idreg.'" ', '', 0, 0);
		      
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

		//**************************** PERSONAL PROCEDIMIENTOS ******************************************************

	public function cargar_Dprocedimientos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$campos = 'pp.id_procedimiento_prog AS "ACCIONES", pp.id_programacion AS "ID", cx.nombre AS "PROCEDIMIENTO", IFNULL(pp.materiales,"") AS "MATERIALES", IFNULL(pp.otros,"") AS "OTROS",GROUP_CONCAT(te.razon_social,"") AS "PROVEEDOR"';

			    $query = $this->general_model->consulta_personalizada($campos, 'programacion_procedimientos pp INNER JOIN procedimientos cx ON pp.id_procedimiento=cx.id_procedimiento LEFT JOIN terceros te ON te.id_tercero=pp.proveedor_material', 'pp.id_usuario_temp = "'.$this->session->userdata('C_id_usuario').'" ', 'pp.id_programacion', 0, 0);

			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			    	$tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    $i=0;
			    foreach ($query->result_array() as $row)
			    {
			    	$i++;
			    	$acciones='<select name="botones_'.$row['ACCIONES'].'" id="botones_'.$row['ACCIONES'].'" class="form-control">
			    				<option value="0">--</option>
			    				<option value="1">Modificar</option>
			    				<option value="2">Eliminar</option></select>'; 
			    	$materiales = explode(',', $row['MATERIALES']);
			    	$material = '';
			    	If($row['MATERIALES']!=""){					    
					    $query1 = $this->general_model->consulta_personalizada('nombre_material', 'materiales_qx', ' estado = "1" AND id_material IN ('.$row['MATERIALES'].')', 'nombre_material', 0, 0);
					    foreach ($query1->result_array() as $row1)
					    {
					        if($material != '')
					        	$material .= ', ';
					        	$material .= $row1['nombre_material'];
					    }
				    }
			      	$tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$acciones.'</td><td>'.$i.'</td><td>'.$row['PROCEDIMIENTO'].'</td><td>'.$material.'</td><td>'.$row['OTROS'].'</td><td>'.$row['PROVEEDOR'].'</td><input type="hidden" id="procedimiento_'.$i.'" name="procedimiento[]" value="'.$row['PROCEDIMIENTO'].'"><input type="hidden" id="materiales_'.$i.'" name="materiales[]" value="'.$row['MATERIALES'].'"></tr>';
			    }			    
			    
			    $tabla .= '</tbody>';

			    echo $tabla;
			}
		}
	}

	public function cargar_Dprocedimientosf() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				$idprog = $this->input->post('idprog');
				$campos = 'pp.id_procedimiento_prog AS "ACCIONES", pp.id_programacion AS "ID", cx.nombre AS "PROCEDIMIENTO", IFNULL(pp.materiales,"") AS "MATERIALES", IFNULL(pp.otros,"") AS "OTROS",GROUP_CONCAT(te.razon_social,"") AS "PROVEEDOR"';

			    $query = $this->general_model->consulta_personalizada($campos, 'programacion_procedimientos pp INNER JOIN procedimientos cx ON pp.id_procedimiento=cx.id_procedimiento LEFT JOIN terceros te ON FIND_IN_SET( te.id_tercero, pp.proveedor_material)', ' pp.id_programacion = "'.$idprog.'"', '', 0, 0);

			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			    	$tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    $i=0;
			    foreach ($query->result_array() as $row)
			    {
			    	$i++;
			    	
			    	$acciones='<select name="botones_'.$row['ACCIONES'].'" id="botones_'.$row['ACCIONES'].'" class="form-control" >
			    				<option value="0">--</option>
			    				<option value="1">Modificar</option>
			    				<option value="2">Eliminar</option></select>';

			    	$materiales = explode(',', $row['MATERIALES']);
			    	$material = '';
			    	If($row['MATERIALES']!=""){					    
					    $query1 = $this->general_model->consulta_personalizada('nombre_material', 'materiales_qx', ' estado = "1" AND id_material IN ('.$row['MATERIALES'].')', 'nombre_material', 0, 0);
					    foreach ($query1->result_array() as $row1)
					    {
					        if($material != '')
					        	$material .= ', ';
					        	$material .= $row1['nombre_material'];
					    }
				    }
			      	$tabla .= '<tr class="d-style bgc-h-default-l4"><td>'.$acciones.'</td><td>'.$i.'</td><td>'.$row['PROCEDIMIENTO'].'</td><td>'.$material.'</td><td>'.$row['OTROS'].'</td><td>'.$row['PROVEEDOR'].'</td></td> <input type="hidden" id="procedimiento_'.$i.'" name="procedimiento[]" value="'.$row['PROCEDIMIENTO'].'"><input type="hidden" id="materiales_'.$i.'" name="materiales[]" value="'.$row['MATERIALES'].'"></tr>';
			    }
			    $tabla .= '</tbody>';

			    echo $tabla;
			}
		}
	}

	public function guardar_procedimientos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$materiales = $this->input->post('chk_materiales');
				$val_material = implode(',', (array) $materiales);

				$proveedor = $this->input->post('tercerosM_agendamiento');
				$val_proveedor = implode(',', (array) $proveedor);

				$procedimientoqx= $this->input->post('procedimientos_agendamiento');
				if($procedimientoqx=="" && $this->input->post('descripcion')!=""){
					$registro0 = array(
						'nombre'=>$this->input->post('descripcion'),
						'fecha_registro'=>date('Y-m-d H:i:s'),
						'estado'=>'1'
					);
					$query = $this->general_model->insert('procedimientos', $registro0);
					$procedimientoqx = $query;
				}
				$registro=array(
					'id_programacion'=>$this->session->userdata('C_id_usuario'),
					'id_procedimiento'=>$procedimientoqx,
					'descripcion_px' => '',
					'materiales'=>$val_material,
					'otros'=>$this->input->post('otros'),
					'proveedor_material'=>$val_proveedor,
					'fecha_registro'=>date('Y-m-d H:i:s'),
					'id_usuario'=>$this->session->userdata('C_id_usuario'),
					'id_usuario_temp'=>$this->session->userdata('C_id_usuario'),
					'estado'=>'1'
				);
				//echo var_dump($registro);

				$query = $this->general_model->insert('programacion_procedimientos', $registro);
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

	public function modificar_procedimiento(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');

				$id_proce_progamacion = $this->input->post('idreg');

				$campos='pgp.id_procedimiento_prog AS "Id", pgp.id_programacion AS "Id_programacion", pgp.id_procedimiento AS "Id_procedimiento",px.nombre AS "Procedimiento", pgp.materiales AS "Id_Materiales", (GROUP_CONCAT(m.nombre_material)) AS "Materiales", pgp.otros AS "Otros", m.id_grupo AS "Grupo", pgp.proveedor_material AS "Proveedores"';

				$query = $this->general_model->consulta_personalizada($campos, 'programacion_procedimientos pgp INNER JOIN procedimientos px ON pgp.id_procedimiento=px.id_procedimiento LEFT JOIN materiales_qx m ON FIND_IN_SET( m.id_material, pgp.materiales)', 'id_procedimiento_prog ='.$id_proce_progamacion.'', 'id_procedimiento_prog', 0, 0);

				$row = $query->row_array();
				
				$arr['procedimiento'] = array('Id'=>$row['Id'], 'Id_programacion'=>$row['Id_programacion'],'Id_procedimiento'=>$row['Id_procedimiento'],'Procedimiento'=>$row['Procedimiento'], 'Grupo'=>$row['Grupo'],'Id_Materiales'=>$row['Id_Materiales'],'Materiales'=>$row['Materiales'],'Otros'=>$row['Otros'],'Proveedores'=>$row['Proveedores']);
				echo json_encode( $arr );
			}
		}
	}

	public function actualizar_proc() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" )
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";
				$materiales = $this->input->post('chk_materiales');
				$val_material = implode(',', (array) $materiales);

				$proveedores = $this->input->post('tercerosM_agendamiento');
				$val_proveedores = implode(',', (array) $proveedores);

				$procedimientoqx= $this->input->post('procedimientos_agendamiento');

				if($procedimientoqx=="" && $this->input->post('descripcion')!=""){
					$registro0 = array(
						'nombre'=>$this->input->post('descripcion'),
						'fecha_registro'=>date('Y-m-d H:i:s'),
						'estado'=>'1'
					);
					$query = $this->general_model->insert('procedimientos', $registro0);
					$procedimientoqx = $query;
				}
				
				$registro=array(
					'id_programacion'=>$this->input->post('id_programacion'),	
					'materiales'=>$val_material,
					'otros'=>$this->input->post('otros'),
					'proveedor_material'=>$val_proveedores,					
					'estado'=>'1'
				);
				//echo var_dump($registro);
				$query = $this->general_model->update('programacion_procedimientos', 'id_procedimiento_prog', $this->input->post('idregistro'), $registro);
				
				if($query=="OK") {
					echo '1';
				} else {
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

	public function eliminar_dprocedimiento() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				//echo "ingreso";

				$registro=array(
					'id_procedimiento_prog'=>$this->input->post('idreg')
				);
				$query = $this->general_model->delete('programacion_procedimientos', $registro);
			}
		}
	}

	public function cargar_materiales() {
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		}else {
			if (!$this->input->is_ajax_request()) {
			redirect();
			} else {
				$tabla = '';
				$opc = 'nue';
				$tabla_ver = 'materiales';
				$id_pro = $this->input->post('proc');
				$id_material=$this->input->post('mate');

				// $CI =& get_instance();
				// $CI->load->model('general_model');

				// if($opc == 'nue') {
				$campos = ' m.id_material AS "chk", m.nombre_material AS "marcado" ';
				$query = $this->general_model->consulta_personalizada($campos, 'materiales_qx m LEFT JOIN materiales_grupos cx ON m.id_grupo=cx.id_grupo', 'm.id_grupo="'. $this->input->post('proc').'" AND m.estado="1" GROUP BY m.id_material', '', 0, 0);
				$tabla = '<div class="list-group" style=" justify-content:flex-start;">';
				$i = -1;

				$selectArray = explode(",", $id_material);
				$check = '';
				$disable = '';
				foreach ($query->result_array() as $row) {
					$i++;
					if(is_array($selectArray)){
        				        
	          				if(in_array($row['chk'],$selectArray)){
						       	$check = ' checked ';
				          		$disable = '';				          		
				        	} else {
				          		$check = '';
				          		$disable = '';				          		
				        	}
				        	$tabla .='<label> <input type="checkbox" value="'.$row['chk'].'" name="chk_materiales[]" id="chk_materiales" '.$check.' '.$disable.'>'.$row['marcado'].'</label>';  				        				        	
												
					}else {
						
						if($id_material === $row['chk']){
					       	$check = ' checked ';
			          		$disable = ' disabled ';
			          		
			        	} else {
			          		$check = '';
			          		$disable = '';
			          		
			        	}	
			        	$tabla .='<label> <input type="checkbox" value="'.$row['chk'].'" name="chk_materiales[]" id="chk_materiales" '.$check.' '.$disable.'>'.$row['marcado'].'</label>';				
											
					}					
				}
				 $tabla .= '</div><input type="hidden" name="cant_chk_materiales" id="cant_chk_materiales" value="'.$i.'" />';
				echo $tabla;
			}
		}
	}

	//CARGAR MANTENIMIENTOS PROGRAMADOS
	public function cargar_agendaQx()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();			 
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			}
			else {
				header('Content-Type: application/json');
				$id_cirujano = $this->input->post('param1');
-
				$campos = 'p.id_programacion AS "Id", salaQx AS "resourceId", CONCAT(fecha_programacion,"T",hora_programacion)AS "start", CONCAT(fecha_programacion,"T",DATE_FORMAT(ADDTIME(STR_TO_DATE((DATE_FORMAT(ADDTIME(STR_TO_DATE(p.hora_programacion, "%H:%i:%s"), p.tiempoQxh), "%H:%i:%s")), "%H:%i:%s"), "00:30:00"), "%H:%i:%s"))AS "end", CONCAT(cn.apellidos," - ",pe.numero_id) AS "title"';

				$query = $this->general_model->consulta_personalizada($campos, 'programacion p INNER JOIN pacientes pe ON p.id_paciente=pe.id_paciente INNER JOIN empleados cn ON p.id_cirujano=cn.id_empleado', 'p.estado="2" AND p.id_cirujano = '.$id_cirujano.'', '', 0, 0);

				$arr = array();

				foreach ($query->result_array() as $row) {
					$start = explode(" ", $row['start']);
					$end = explode(" ", $row['end']);
					
					$arr[] = array('id' => $row['id'], 'resourceId' => $row['resourceId'], 'start' => $row['start'], 'end' => $row['end'], 'title' => $row['title']);
				}
			
				echo json_encode($arr, JSON_UNESCAPED_UNICODE);
			} //-Valida Envio por ajax
		}//-Valida Inicio de Session
	}


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
	
	public function sendEmail2($Para, $Asunto, $cuerpo, $Cabeceras){
		
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			if (!$this->input->is_ajax_request()) {
				redirect();
			} else {

				if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
					$msg = 1;				
				}else{
					$msg = $this->email->print_debugger();	
				}
				return $msg;
			}
		}
	}
}