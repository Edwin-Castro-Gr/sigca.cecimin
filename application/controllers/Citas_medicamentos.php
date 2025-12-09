<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas_medicamentos extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');	
		$this->load->helper('email');	
	}
	
	public function index()	
	{

		$this->session->sess_destroy();
		$this->load->view('citas_medicamentos/index');
	}

	public function listado()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');


			$this->load->helper('funciones_select');
			$data_usua['titulo']="Administración de Medicamentos ";
			$data_usua['origen']="Atención al Usuario";
			$data_usua['contenido']='citas_medicamentos/listado';
			$data_usua['entrada_js']='_js/a_medicamentos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'"> ';

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

	public function reporte()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');


			$this->load->helper('funciones_select');
			$data_usua['titulo']="Reporte Administración de Medicamentos";
			$data_usua['origen']="Atención al Usuario";
			$data_usua['contenido']='citas_medicamentos/reporte';
			$data_usua['entrada_js']='_js/a_medicamentos.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-buttons-bs4@1.7.0/css/buttons.bootstrap4.min.css').'"> ';

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


	public function listar_tabla() 
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
				// $usuario_perfil = $this->session->userdata('C_perfil');
				// $usuario = $this->session->userdata('C_id_usuario');
				
				$tabla = '';
    
			    $campos = ' "..", id_solicitud AS "Id", CASE WHEN tipo_documento="CC" THEN "Cédula de Ciudadanía" WHEN tipo_documento="CE" THEN  "Cédula de Extranjería" WHEN tipo_documento="TI" THEN "Tarjeta de Identidad" WHEN tipo_documento="RC" THEN  "Registro Civil" ELSE "Pasaporte" END AS "Tipo Identificación", cedula AS "Cedula", nombre_paciente AS "Paciente", DATE_FORMAT(fecha_registro, "%d/%m/%Y") AS "Fecha Solicitud", archivo_orden AS "Orden", CASE WHEN estado="1" THEN "Recibida" WHEN estado="2" THEN "Gestionada" WHEN estado="0" THEN "Cerrada" ELSE "Rechazada" END AS "Estado", "" AS "Acción" ';
			      
			    			    
			    $query = $this->general_model->consulta_personalizada($campos, 'administracion_medicamentos', 'estado="1"', 'Id', 0, 0);
			    
			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			      if($campo != ".." && $campo != "Acción")
			        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
			      else
			        $tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    //$tabla = '<tbody class="mt-1">';

			    foreach ($query->result_array() as $row)
			    {
				    if($row['Estado'] == "Recibida")
				        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Recibida</span>';
				    elseif($row['Estado'] == "Gestionada")
       					 $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">Gestionada</span>'; 
      				elseif($row['Estado'] == "Rechazada")
        				$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Rechazada</span>'; 
      				elseif($row['Estado'] == "Cerrada")
        				$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Cerrada</span>'; 				

				    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Identificación'].'</td><td>'.$row['Cedula'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Fecha Solicitud'].'</td><td style="text-align: center;"><div><a href="#" class="text-success mx-1" data-toggle="tooltip" data-original-title="Ver Ordenes" aria-describedby="tooltip'.$row['Id'].'" id="btnverpfd_'.$row['Orden'].'"> <i  id="btnverpfd_'.$row['Orden'].'" class="fa fa-print text-105 btn btn-circle btn-outline-success"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Orden'].'" /> </i> </a></div></td><td>'.$estado.'</td>';

				    // $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Identificación'].'</td><td>'.$row['Cedula'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Fecha Solicitud'].'</td><td>'.anchor(base_url().$row['Orden'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$estado.'</td>';

		        	$tabla .= '<td class="text-nowrap"><div class="action-buttons">';
		          	
	          		$tabla .= '<a href="#" class="text-success mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip'.$row['Id'].'" id="btngestionar_'.$row['Id'].'"> <i  id="btngestionar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Paciente'].'" /> </i> </a> ';
		          	
		          	$tabla .= '
		          	<!--<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a> -->

		          	<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
		          	</div></td>';

			     	$tabla .= '</tr>';        
			    }
			    $tabla .= '</tbody>';   
			    
			    echo $tabla;
			}
		}
	}

	public function listar_reporte() 
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
				// $usuario_perfil = $this->session->userdata('C_perfil');
				// $usuario = $this->session->userdata('C_id_usuario');
				
				$tabla = '';
    
			    $campos = ' "..", id_solicitud AS "Id", CASE WHEN tipo_documento="CC" THEN "Cédula de Ciudadanía" WHEN tipo_documento="CE" THEN  "Cédula de Extranjería" WHEN tipo_documento="TI" THEN "Tarjeta de Identidad" WHEN tipo_documento="RC" THEN  "Registro Civil" ELSE "Pasaporte" END AS "Tipo Identificación", cedula AS "Cedula", nombre_paciente AS "Paciente", DATE_FORMAT(fecha_registro, "%d/%m/%Y") AS "Fecha Solicitud", archivo_orden AS "Orden", CASE WHEN estado="1" THEN "Recibida" WHEN estado="2" THEN "Gestionada" WHEN estado="0" THEN "Cerrada" ELSE "Rechazada" END AS "Estado", "" AS "Acción" ';
			      
			    			    
			    $query = $this->general_model->consulta_personalizada($campos, 'administracion_medicamentos', 'estado!="1"', 'Id', 0, 0);
			    
			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {
			      if($campo != ".." && $campo != "Acción")
			        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
			      else
			        $tabla .= '<th>'.($campo).'</th>';
			    }
			    $tabla .= '</tr></thead><tbody class="pos-rel">';
			    //$tabla = '<tbody class="mt-1">';

			    foreach ($query->result_array() as $row)
			    {
				    if($row['Estado'] == "Recibida")
				        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Recibida</span>';
				    elseif($row['Estado'] == "Gestionada")
       					 $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">Gestionada</span>'; 
      				elseif($row['Estado'] == "Rechazada")
        				$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Rechazada</span>'; 
      				elseif($row['Estado'] == "Cerrada")
        				$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Cerrada</span>'; 				

				    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Identificación'].'</td><td>'.$row['Cedula'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Fecha Solicitud'].'</td><td>'.anchor(base_url().$row['Orden'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$estado.'</td>';

		        	$tabla .= '<td class="text-nowrap"><div class="action-buttons">';
		          	
	          		// $tabla .= '<a href="#" class="text-success mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip'.$row['Id'].'" id="btngestionar_'.$row['Id'].'"> <i  id="btngestionar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Paciente'].'" /> </i> </a> ';
		          	
		          	$tabla .= '
		          	<!--<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a> -->

		          	<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
		          	</div></td>';

			     	$tabla .= '</tr>';        
			    }
			    $tabla .= '</tbody>';   
			    
			    echo $tabla;
			}
		}
	}


	public function excel() 
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
		redirect(base_url());
		} else {				

			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			$filyear = $this->input->get('filyear');
			$filmes = $this->input->get('filmes');
			$filestado = $this->input->get('filestado');
			$tabla = '';
			$count = 0;

			

			$campos = 'am.id_solicitud as "Id", am.tipo_documento as "Tipo Documento", am.cedula AS "Identificación", am.nombre_paciente AS "Paciente", am.telefono AS "Telefono", am.correo AS "Correo", YEAR(am.fecha_registro) AS "Año", MONTH(am.fecha_registro) AS "Mes", DAY(am.fecha_registro) AS "Día", CASE WHEN am.estado="1" THEN "Recibida" WHEN am.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';

			if ($filyear != "" || $filyear = null){
				
				$query = $this->general_model->consulta_personalizada($campos, 'administracion_medicamentos am', 'YEAR(am.fecha_registro)="'.$filyear.'" AND MONTH(am.fecha_registro) ="'.$filmes.'" AND am.estado = "'.$filestado.'"', 'am.fecha_registro', 0, 0);	

				$campos1 = 'CASE WHEN am.estado="1" THEN "Recibidas" WHEN am.estado="2" THEN "Gestionadas" ELSE "Cerradas" END AS "Solicitudes", COUNT(*) as "Cantidad"'; 
				$query1 = $this->general_model->consulta_personalizada($campos1, 'administracion_medicamentos am ', 'YEAR(am.fecha_registro) ="'.$filyear.'" AND MONTH(am.fecha_registro) ="'.$filmes.'" GROUP BY am.estado' , '', 0, 0);		
							
			} else {
				
				if($filestado != ""){

					$query = $this->general_model->consulta_personalizada($campos, 'administracion_medicamentos am ', 'am.estado = "'.$filestado.'"','am.fecha_registro', 0, 0);	
					
				}else{
					$query = $this->general_model->consulta_personalizada($campos, 'administracion_medicamentos am','', 'am.fecha_registro', 0, 0);	

				}
				$campos1 = 'CASE WHEN am.estado="1" THEN "Recibidas" WHEN am.estado="2" THEN "Gestionadas" ELSE "Cerradas" END AS "Solicitudes", COUNT(*) as "Cantidad"'; 
					$query1 = $this->general_model->consulta_personalizada($campos1, 'administracion_medicamentos am GROUP BY am.estado', '' , '', 0, 0);
	
			}	
			
			$tabla1 ='<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			$tr1 = '<tr class="d-style bgc-h-default-l4">';

			foreach ($query1->list_fields() as $campo1)
		    {				      
		        $tabla1 .= '<th>'.($campo1).'</th>';	
		        		    
			}
			$tabla1 .= '</tr></thead><tbody class="pos-rel">';

			foreach ($query1->result_array() as $row1)
			{
				
				$tabla1.= '<tr><td>' . $row1['Solicitudes'] . '</td><td>' . $row1['Cantidad'] . '</td></tr>';  					
									
			}	

			$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			$td = '<tr class="d-style bgc-h-default-l4">';

		    foreach ($query->list_fields() as $campo)
		    {				      
		        $tabla .= '<th>'.($campo).'</th>';	
		        		    
			}
			$tabla .= '</tr></thead><tbody class="pos-rel">';
			
			foreach ($query->result_array() as $row)
			{
				$radicado = "SM-00".$row['Id'];
				$tabla .= '<tr><td>' . $radicado . '</td><td>' . $row['Tipo Documento'] . '</td><td>' . $row['Identificación'] . '</td><td>' . $row['Paciente'] . '</td><td>' . $row['Telefono'] . '</td><td>' . $row['Correo'] . '</td><td>' . $row['Año'] . '</td><td>' . $row['Mes'] . '</td><td>' . $row['Día'] . '</td><td>' . $row['Estado'] . '</td></tr>';  					
									
			}						
			
			$tabla .= '</tbody>'; 
			$filename = "Listado_de_Solicitudes_Medicamentos.xls";
			$usuario = $this->session->userdata('C_id_usuario');
		    header ("Content-Disposition: attachment; filename=".$filename );
			header ("Content-Type: application/vnd.ms-excel");

			$this->load->helper('funciones_tabla');

			echo ' ';
			echo utf8_decode('<table border="1"><tr><th colspan="2">TOTAL SOLICITUDES</th></tr></table><br>');

			echo '<table border="1">';
            echo utf8_decode($tabla1);
            echo '</table>';
            echo ' ';
            echo '<br>';
		    echo utf8_decode('<table border="1"><tr><th colspan="10">LISTADO GENERAL SOLICITUD DE APLIACION DE MEDICAMENTOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode($tabla);
            echo '</table>';		
		}
	}

	public function gestion($id)
	{
		if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {
			
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');

			$data_usua['c_id_cita'] = $id;
			$data_usua['c_tipo'] = '';
			$data_usua['c_cedula'] = '';
			$data_usua['c_nombres'] = '';
			$data_usua['c_telefono'] = '';
			$data_usua['c_correo'] = '';
			$data_usua['c_archivo_orden'] = '';
			$data_usua['c_fecha1'] = '';
			$data_usua['c_jornada1'] = '';
			$data_usua['c_fecha2'] = '';
			$data_usua['c_jornada2'] = '';
			$data_usua['c_fecha3'] = '';			
			$data_usua['c_jornada3'] = '';
			$data_usua['c_condicion'] = '';					
			$data_usua['c_protecion_datos'] = '';
			$data_usua['c_estado'] = '';


			$campos='tipo_documento AS "tipo", cedula AS "Cedula", nombre_paciente AS "Paciente", telefono AS "Telefono", correo AS "Email", archivo_orden AS "Orden", fecha_sugerida1 AS "Fecha1", jornada_sugerida1 AS "Jornada1", fecha_sugerida2 AS "Fecha2", jornada_sugerida2 AS "Jornada2", fecha_sugerida3 AS "Fecha3", jornada_sugerida3 AS "Jornada3", discapacidad AS "Condicion", proteccion_datos AS "Protecion", fecha_registro AS "Fecha_reg", estado AS "Estado"';

			$query = $this->general_model->consulta_personalizada($campos,'administracion_medicamentos', 'id_solicitud ="'.$id.'" ', '', 0, 0);
			
			foreach ($query->result_array() as $row)
			{
				
				$data_usua['c_tipo'] = $row['tipo'];
				$data_usua['c_cedula'] = $row['Cedula'];
				$data_usua['c_nombres'] = $row['Paciente'];
				$data_usua['c_telefono'] = $row['Telefono'];
				$data_usua['c_correo'] = $row['Email'];
				$data_usua['c_archivo_orden'] = $row['Orden'];
				$data_usua['c_fecha1'] = $row['Fecha1'];
				$data_usua['c_jornada1'] = $row['Jornada1'];
				$data_usua['c_fecha2'] = $row['Fecha2'];
				$data_usua['c_jornada2'] = $row['Jornada2'];
				$data_usua['c_fecha3'] = $row['Fecha3'];			
				$data_usua['c_jornada3'] = $row['Jornada3'];
				$data_usua['c_condicion'] = $row['Condicion'];					
				$data_usua['c_protecion_datos'] = $row['Protecion'];			
				$data_usua['c_fecha_reg'] = $row['Fecha_reg'];
				$data_usua['c_estado'] = $row['Estado'];

			}
			$this->load->helper('funciones_select');
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Gestión Citas ";
			$data_usua['origen']="Atención al Usuario";
			$data_usua['contenido']='citas_medicamentos/gestion';
			$data_usua['entrada_js']='_js/a_medicamentos.js';
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

	public function guardar() {
	    if (!$this->input->is_ajax_request()) {
	        redirect();
	        return;
	    }
	    $ban="1";
	    $this->load->database();
	    $this->initializeSession();
	    $this->setDatabase();

	    $data = $this->prepareData($ban);
	    $this->createDirectories($data['cedula'], $data['dirfecha']);

	    if ($this->uploadFile($data['ruta'],$ban)) {
	        $registro = $this->prepareRecord($data);
	        $query = $this->general_model->insert('administracion_medicamentos', $registro);

	        if ($query >= 1) {
	            $this->sendEmails($data, $query);
	        } else {
	            $this->handleError($query);
	        }
	    } else {
	        $this->handleUploadError();
	    }
	}

	private function initializeSession() {
	    $datos_session2 = array('C_basedatos' => 'u610593899_sigca');
	    $this->session->set_userdata($datos_session2);
	}

	private function setDatabase() {
	    $this->db->query('USE ' . $this->session->userdata('C_basedatos') . ';');
	}

	private function prepareData() {
		
			$fecha = date('Y-m-d H:i:s');
	    $dirfecha = date('Y-m-d');
	    $poli_protdatos = $this->input->post('poli_protdatos') == 'on' ? '1' : '0';
	    $id_empleado = 6;
	    $tipo = $this->input->post('txttipod');
	    $cedula = $this->input->post('txtcedula');
	    $paciente = $this->input->post('txtnombres');
	    $telefono = $this->input->post('txttelefono');
	    $email = $this->input->post('txtemail');
	    $fecha1 = $this->input->post('txtfecha1');
	    $jornada1 = $this->input->post('txtjornada1');
	    $fecha2 = $this->input->post('txtfecha2');
	    $jornada2 = $this->input->post('txtjornada2');
	    $fecha3 = $this->input->post('txtfecha3');
	    $jornada3 = $this->input->post('txtjornada3');
	    $condicion = $this->input->post('txtcondicion');

	    $valjornada1 = $jornada1 == "0" ? 'Mañana' : 'Tarde';
	    $valjornada2 = $jornada2 == "0" ? 'Mañana' : 'Tarde';
	    $valjornada3 = $jornada3 == "0" ? 'Mañana' : 'Tarde';

	    $valcondicion = $this->getConditionDescription($condicion);

	    $ruta = './archivos/' . $this->session->userdata('C_basedatos') . '/ordenes/' . $cedula . '/' . $dirfecha . '/';
	    $rutag = 'archivos/' . $this->session->userdata('C_basedatos') . '/ordenes/' . $cedula . '/' . $dirfecha . '/';

	    return compact('fecha', 'dirfecha', 'poli_protdatos', 'id_empleado', 'tipo', 'cedula', 'paciente', 'telefono', 'email', 'fecha1', 'jornada1', 'fecha2', 'jornada2', 'fecha3', 'jornada3', 'condicion', 'valjornada1', 'valjornada2', 'valjornada3', 'valcondicion', 'ruta', 'rutag');
	
	}

	private function getConditionDescription($condicion) {
	    switch ($condicion) {
	        case '0': return 'Ninguna';
	        case '1': return 'Discapacidad Física';
	        case '2': return 'Discapacidad Visual';
	        case '3': return 'Discapacidad Auditiva';
	        case '4': return 'Discapacidad Cognitiva';
	        case '5': return 'Embarazo';
	        default: return 'Desconocida';
	    }
	}

	private function createDirectories($cedula, $dirfecha) {
	    $basePath = 'archivos/' . $this->session->userdata('C_basedatos') . '/ordenes/';
	    $paths = [
	        $basePath,
	        $basePath . $cedula . '/',
	        $basePath . $cedula . '/' . $dirfecha . '/'
	    ];

	    foreach ($paths as $path) {
	        if (!file_exists($path)) {
	            mkdir($path, 0777, true);
	        }
	    }
	}

	private function uploadFile($ruta) {
	    $config = [
	        "upload_path" => $ruta,
	        "allowed_types" => "*"
	    ];

	    $this->load->library("upload", $config);
	    
	    return $this->upload->do_upload('orden_medica');
	    
	}

	private function sendEmails($data, $query) {
    
    	$radicado = "SAM-00" . $query;
	    $asunto = "Solicitud Administración Medicamentos - " . $data['cedula'];
	    $mensaje = $this->prepareEmailMessage($data, $radicado);

	    $correo_remitente = 'Citas Medicamentos';
	    $correo_usuario = 'citasmedicamentos@saludinteligente.com';
	    $correo_cc = 'citasmedicamentos@sigca.cecimin.com.co';
	    $adjuntos = [FCPATH . $data['ruta'] . $this->upload->data()['file_name']];	
	
	    $responseCorreo = enviar_correo($correo_usuario, $asunto, $mensaje, 'citas', $correo_remitente, $adjuntos, $correo_cc);

	    if ($responseCorreo) {
	        $this->sendConfirmationEmail($data);
	    } else {
	        $this->handleError(-999);
	    }
	
	}

	private function prepareEmailMessage($data, $radicado) {
	 
	    $mensaje = "<div><font size='3'><b>Señores</b></font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>CECIMIN S.A.S.</b></font></div>\r\n";
	    $mensaje .= "<div><font size='3'>Atte: Citas medicamentos,</font></div>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<div><h4>DATOS DE LA SOLICITUD PARA LA ADMINISTRACION DE MEDICAMENTOS</h4></div>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<div><font size='3'><b>Nombre del paciente:</b> " . $data['paciente'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Documento de Identidad:</b> " . $data['cedula'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Correo Electrónico:</b> " . $data['email'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Telefono de Contacto:</b> " . $data['telefono'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Fecha Sugerida 1:</b> " . $data['fecha1'] . " - " . $data['valjornada1'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Fecha Sugerida 2:</b> " . $data['fecha2'] . " - " . $data['valjornada2'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Fecha Sugerida 3:</b> " . $data['fecha3'] . " - " . $data['valjornada3'] . "</font></div>\r\n";
	    $mensaje .= "<div><font size='3'><b>Condición:</b> " . $data['valcondicion'] . "</font></div>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
	    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
	    $mensaje .= "<br>\r\n";

	    return $mensaje;
	
	}

	private function sendConfirmationEmail($data) {
	    $asunto = "Recibido Solicitud Administración Medicamentos - " . $data['cedula'];
	    $mensaje = "<div><font size='3'>Señor(a),</font></div>\r\n";
	    $mensaje .= "<div><font size='3'>" . $data['paciente'] . ",</font></div>\r\n";
	    $mensaje .= "<div><font size='3'>La ciudad</font></div>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<div><font size='3'>su solicitud fue recibida, una vez verifiquemos sus datos y archivos adjuntos,  recibirá dentro de los (3) días hábiles, la cita programada al correo electrónico registrado.</font></div>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<div><font size='3'>Cordialmente,</font></div>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<br>\r\n";
	    $mensaje .= "<div><font size='3'>Administración de Medicamentos</font></div>\r\n";
	    $mensaje .= "<div><font size='3'>Avenida Carrera 45 No. 104-76 piso 3</font></div>\r\n";
	    $mensaje .= "<div><font size='3'> (601) 6002555 Ext.1236 </font></div>\r\n";
	    $mensaje .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
	    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
	    $mensaje .= "<br>\r\n";

	    $correo_remitente = 'Citas Medicamentos';
	    $correo_usuario = $data['email'];
	    $correo_cc = 'citasmedicamentos@sigca.cecimin.com.co';

	    $responseCorreo = enviar_correo($correo_usuario, $asunto, $mensaje, 'citas', $correo_remitente, null, $correo_cc);

	    if ($responseCorreo) {
	        echo "1";
	    } else {
	        $this->handleError(-999);
	    }
	}

	private function prepareRecord($data) {
	    return [
	        'tipo_documento' => $data['tipo'],
	        'cedula' => $data['cedula'],
	        'nombre_paciente' => $data['paciente'],
	        'telefono' => $data['telefono'],
	        'correo' => $data['email'],
	        'archivo_orden' => $data['rutag'] . $this->upload->data()['file_name'],
	        'fecha_sugerida1' => $data['fecha1'],
	        'jornada_sugerida1' => $data['jornada1'],
	        'fecha_sugerida2' => $data['fecha2'],
	        'jornada_sugerida2' => $data['jornada2'],
	        'fecha_sugerida3' => $data['fecha3'],
	        'discapacidad' => $data['condicion'],
	        'proteccion_datos' => $data['poli_protdatos'],
	        'fecha_registro' => $data['fecha'],
	        'estado' => '1'
	    ];
	}

	private function handleError($query) {
	    echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>' . $query . '¡Error!</strong><br>';
	    switch ($query) {
	        case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
	        case "-998": echo "Error: El archivo no pudo ser cargado, por favor verifique !"; break;
	        case "-999": echo "Error: Por favor verifique los datos!"; break;
	        default: echo "Error: " . $query . " => " . $this->db->_error_message(); break;
	    }
	    echo '</div>';
	}

	private function handleUploadError() {
	    $error = array('error' => $this->upload->display_errors());
	    $msg = $error;
	    $query = "-998";
	    $this->handleError($query);
	}
	
	public function guardar_gestion() {
	if (!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="") {
			redirect();
		} else {

			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
			$fecha = date('Y-m-d H:i:s');
			$dirfecha = $this->input->post('fecha_reg');

			$registro = '';
			$id_solicitud = $this->input->post('idregistro');
			$estado = $this->input->post('estado');
			$fechap = $this->input->post('fechap');
			$horap = $this->input->post('horap');

			$hora_llegada = strtotime('-30 minute', strtotime ($horap));
			$hora_llegada = date('H:i:s', $hora_llegada);

			$cedula = $this->input->post('cedula');
			$paciente = $this->input->post('nombres');
			$telefono = $this->input->post('telefono');

			$email=$this->input->post('email');
			$observaciones = $this->input->post('observaciones');

			$qradicado = "SAM - 00".$id_solicitud."";
			$respuesta ='';

			$filename = "";
			$filename_send = "";

			$registro1 =array(
					'estado'=>$estado
				);
			$query1 = $this->general_model->update('administracion_medicamentos', 'id_solicitud',$id_solicitud, $registro1);

			if($estado == "2"){
				$registro=array(
					'id_solicitud_medicamentos'=>$id_solicitud,
					'fecha_programada'=>$this->input->post('fechap'),
					'hora_programada'=>$this->input->post('horap'),
					'fecha_gestion'	=>$fecha,
					'observaciones_gestion'=>$this->input->post('observaciones'),					
					'id_usuario_registra'=>$this->session->userdata('C_id_usuario'),
				);
				$respuesta ='Programada';

				$query = $this->general_model->insert('administracion_medicamentos_gestion', $registro);
			}else if($estado == "0"){

				$dir = $cedula;

				if (!file_exists('archivos/'.$this->session->userdata('C_basedatos'))) {
				 	mkdir('archivos/'.$this->session->userdata('C_basedatos'), 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/')) {
				 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/', 0777, true);
				 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/')) {
					 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/', 0777, true);
					 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/')) {
					 			mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/', 0777, true);
					 		}
					 	}
				 	}
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/')) {
				 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/', 0777, true);
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/')) {
			 		mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/', 0777, true);
			 		if (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/')) {
					 	mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/', 0777, true);
					}
			 	}elseif (!file_exists('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/')) {
					mkdir('archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/', 0777, true);
				}

				$ruta = './archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/';  
				$rutag ='archivos/'.$this->session->userdata('C_basedatos').'/ordenes/'.$dir.'/'.$dirfecha.'/';
				
				//CARGAR ARCHIVO VISUAL
				$config = [
					"upload_path" => $ruta,
					"allowed_types" => "*"
				];
				
				
				$this->load->library("upload",$config);
				
				if ($this->upload->do_upload('anexocierre')){ 
					$data = array('upload_data' => $this->upload->data());
					$filename = $rutag.$data['upload_data']['file_name'];
					$filename_send = $ruta.$data['upload_data']['file_name'];
				}

				$registro=array(
					'id_solicitud_medicamentos'=>$id_solicitud, 
					'fecha_gestion'	=>$fecha,
					'observaciones_gestion'=>$this->input->post('observaciones'),
					'archivo_evidencia'=>$filename,
					'id_usuario_registra'=>$this->session->userdata('C_id_usuario'),
				);
				$respuesta ='Cerrada';
					
				$query = $this->general_model->insert('administracion_medicamentos_gestion', $registro);	
			}
			
			
			if($query1 =="OK"){

				$correo_remitente ='Citas Medicamentos';
            	
			    $correo_cc  ='citasmedicamentos@sigca.cecimin.com.co';
				$correo_usuario =$email; //destinatario
				
				$asunto ="Respuesta a Solicitud Administración Medicamentos - ".$cedula."";
				
				$adjuntos =  Null;
				$mensaje = "<div><font size='3'>Señor(a),</font></div>\r\n";
				$mensaje .= "<div><font size='3'>".$paciente.",</font></div>\r\n";
				$mensaje .= "<div><font size='3'>La ciudad</font></div>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<br>\r\n";
				$mensaje .= "<br>\r\n";

				if($respuesta == "Programada"){
					$mensaje .= "<div><font size='3'>Su solicitud bajo el radicado N° ".$qradicado." fue ".$respuesta." para el dia ".$fechap." a las ".$horap.", por lo que debe presentarse en recepción de la clínica a las ".$hora_llegada.", siguiendo las recomendiones dadas a continuación.</font></div>\r\n\r\n";
					$mensaje .= "<div><h4><b>Recomendaciones</b></h4></div>\r\n";
	            	$mensaje .= "<p><font size='3'> Si usted no cuenta con EPS sanitas, el medicamento debe ser adquirido directamente en Cecimin.  De acuerdo con la resolución 3100 de 2019, la práctica segura hace parte de las actividades de los profesionales en enfermería y se encuentra implementada y documentada bajo el procedimiento de administración de medicamentos, la cual busca prevenir la ocurrencia de eventos adversos.</font></p>\r\n";
	            	$mensaje .= "<p><font size='3'> Encontrarse en buen estado de salud, no tener ningún tipo de infección, gripa, herpes, etc.Tener puesto todos los elementos de bioseguridad personal.  No estar tomando antibióticos.</font></p>\r\n\r\n";
	            	$mensaje .= "<p><font size='3'> Traer fórmula original el día de la aplicación del medicamento.</font></p>\r\n\r\n";
	            	$mensaje .= "<p><font size='3'> El día de la cita, debe contar con un bono de medicina prepagada el cual puede adquirir a través de los canales virtuales (oficina virtual colsanitas) o en nuestras instalaciones por medio de tarjeta débito o crédito únicamente, no se recibe efectivo. Adicional deben realizar la compra en nuestras instalaciones ) caja del 1er piso) correspondiente al  valor de un bono de eps el día de la cita.  Esta compra la deben realizar posterior a la validación con la secretaria del servicio.</font></p>\r\n\r\n";
					$mensaje .= "<p><font size='3'> Si su medicamento es Denosumab o Ácido Zoledrónico, no debe tener extracciones dentales, procedimientos odontológicos invasivos, ni cirugías óseas los últimos 2 meses antes de la aplicación del medicamento.</font></p>\r\n";
					$mensaje .= "<p><font size='3'> Si el usuario cuenta con alguna fractura, o las condiciones anteriores, este medicamento se podrá administrar en 2 meses posterior a la misma.</font></p>\r\n\r\n";

					$mensaje .= "<p><font size='3'>Si su medicamento es para aplicación de Hierro (Carboximaltosa o Hierro Sacarato) suspender el hierro oral 5 días antes. Si su medicamento es Rituximab suspender el medicamento de la tensión y deben traerlo para la toma en Cecimin en caso de ser necesario.</font></p>\r\n\r\n";


				}elseif ($respuesta == "Cerrada"){
					$mensaje .= "<div><font size='3'>Su solicitud bajo el radicado N° ".$qradicado." fue ".$respuesta." debido a ".$observaciones.".</font></div>\r\n";
					if ($filename_send == ""){
						$adjuntos = null;
					}else{
						$adjuntos =  [
            				FCPATH . $filename_send,  // Ruta absoluta del archivo                			
        				];	
					}							

				}

			    $mensaje .= "<br>\r\n";
			    $mensaje .= "<br>\r\n";

			    $mensaje .= "<div><font size='3'>Cordialmente,</font></div>\r\n";
			    $mensaje .= "<br>\r\n";
			   	$mensaje .= "<br>\r\n";
			    $mensaje .= "<div><font size='3'>Administracion de Medicamentos</font></div>\r\n";
			    $mensaje .= "<div><font size='3'>Avenida Carrera 45 No. 104-76 piso 3</font></div>\r\n";
			    $mensaje .= "<div><font size='3'> (601) 6002555 Ext.1236 </font></div>\r\n";

			    $mensaje .= "<div><font size='2'>Correo enviado desde https://cecimin.com.co</font></div>\r\n";
			    $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";
				$mensaje .= "<br>\r\n";

				// Archivos a adjuntar
            			            	

	            // Enviar el correo utilizando el buzón de citas
	            $responseCorreo = (enviar_correo($correo_usuario, $asunto, $mensaje, 'citas',  $correo_remitente, $adjuntos, $correo_cc));
	            if ($responseCorreo) {
	                echo "1";
	                $query = 1;
	            } else {		                
	                $msg = $responseCorreo;
	                $query =-999;	
	            }	
				echo '1';
			}else {
				echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
				switch($query) {
					case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					case "-998": echo "Error:".$msg."; El archivo no pudo ser cargado, por favor verifique !"; break;
					case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
					default: echo "Error: ".$query." => ".$this->db->_error_message(); break;	
				}
				echo '</div>';
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
				$this->load->database();
				$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');

				
				$idreg = $this->input->post('idreg');


				$campos = 'am.id_solicitud as "Id", am.tipo_documento as "Tipo Documento", am.cedula AS "Identificación", am.nombre_paciente AS "Paciente", am.telefono AS "Telefono", am.correo AS "Correo", am.discapacidad AS "Condición", amg.fecha_programada AS "Fecha Programada", amg.hora_programada AS "Hora Programada", amg.observaciones_gestion AS "Observaciones", am.fecha_registro AS "Fecha Gestión", IFNULL(CONCAT(em.nombres, " ", em.apellidos),"") AS "Gestionada por", CASE WHEN am.estado="1" THEN "Recibida" WHEN am.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';
			
				$query = $this->general_model->consulta_personalizada($campos, 'administracion_medicamentos am LEFT JOIN administracion_medicamentos_gestion amg ON am.id_solicitud = amg.id_solicitud_medicamentos LEFT JOIN empleados em ON amg.id_usuario_registra = em.id_empleado', 'am.id_solicitud ='.$idreg.'', '', 0, 0);
			
		      	//echo $this->db->last_query();
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
