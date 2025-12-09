<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require FCPATH.'vendor/autoload.php';

class D_consultas extends CI_Controller {
	
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
			$this->load->helper('funciones_chk');

			$data_usua['titulo']="Consultas";
			$data_usua['origen']="Documentos";
			$data_usua['contenido']='consultas/index';
			$data_usua['entrada_js']='_js/d_consultas.js';
			$data_usua['librerias_css']='<!-- DataTables -->
			<link rel="stylesheet" type="text/css"  href="'.base_url('plugins/datatables.net-bs4@1.10.24/css/dataTables.bootstrap4.min.css').'">
			<link rel="stylesheet" type="text/css" href="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.css').'">
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

			<script src="'.base_url('plugins/select2@4.1.0-rc.0/select2.min.js').'"></script>';

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
				echo listar_documentos_tabla('CONSULTA');
			}
		}
	}

	public function consultar_documentos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());		
		} else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {
				
				$idproc=$this->input->post('idproc');
				$idsubproc=$this->input->post('idsubproc');
				$query="";

				$campos ='"..",d.id_documento AS "Id", d.nombre AS "Nombre", t.nombre AS "Tipo", p.nombre AS "Proceso", d.codigo AS "Código", CONCAT(v.ruta,v.archivo) AS "Ver", CONCAT(v.version," del ",v.fecha) AS "Versión", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';

				if($idproc!=""||$idproc!=Null){
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d LEFT JOIN tipos_documentos t ON d.id_tipo = t.id_tipo  LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"','d.id_procesomaestro="'.$idproc.'"', 'd.nombre', 0, 0);
				}

				if($idsubproc!=""||$idsubproc!=Null){
					$query = $this->general_model->consulta_personalizada($campos, 'documentos d LEFT JOIN tipos_documentos t ON d.id_tipo = t.id_tipo  LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"','d.id_subproceso="'.$idsubproc.'"', 'd.nombre', 0, 0);
				}
    			    
			    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {			      
			    	$tabla .= '<th>'.($campo).'</th>';
			    }
			      	$tabla .= '</tr></thead><tbody class="pos-rel">';

			    foreach ($query->result_array() as $row)
			    {
			      	if($row['Estado'] == "Activo")
			        	$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
			      	else
			        	$estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Obsoleto</span>';

			      	$tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tipo'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Código'].'</td><td>'.anchor(base_url().$row['Ver'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$row['Versión'].'</td><td>'.$estado.'</td>';
			     
			      	$tabla .= '</tr>';        
			    }
			    $tabla .= '</tbody>';   
			    
			   	echo $tabla;	

			}
		}
	}


	public function cargar_subprocesos() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			
				header('Content-Type: application/json');
				$id_proc = $this->input->get('idproc');
				
				$arrjson=[];		
					
				$campos = 'id_subproceso AS "Id", nombre AS "Subprocesos" ';
				$query = $this->general_model->consulta_personalizada($campos, 'subprocesos ','id_proceso = "'.$id_proc.'" AND estado = "1" ', 'nombre', 0, 0);						
				
				foreach($query->result_array() as $row) {
					$arrjson[]=array('id'=>$row['Id'],'text'=>$row['Subprocesos']);
				}		
								
				echo json_encode($arrjson);					
							
		} //-Valida Envio por ajax
		//-Valida Inicio de Session
	}

	public function enviar_socializacion(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect(base_url());
			} else {

				$fecha = date('Y-m-d H:i:s');
				$msg='';				
				$query ='';

				$campos1='DISTINCT IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS Funcionario, e.email AS "Correo"';
				$query11 = $this->general_model->consulta_personalizada($campos1,'empleados e INNER JOIN usuarios u ON u.id_empleado=e.id_empleado', 'u.perfil = "5" AND e.email !="notiene@gmail.com"', '', 0, 0);
				// var_dump($query11->result_array());
				// $query=1;
				foreach ($query11->result_array() as $row1)
				{
					$funcionario = $row1['Funcionario'];
					$correo = $row1['Correo'];

					$de = "Calidad Cecimin <calidad.cecimin@saludinteligente.com>";
				    
					$Para = $funcionario."<".$correo.">";
					$Asunto = "Socialización de Acceso SIGCA";

					$Cabeceras = "From:".$de."\r\n"; 
					$Cabeceras .= "Cc: calidad.cecimin@saludinteligente.com\r\n";	
					$Cabeceras .= "MIME-Version: 1.0\r\n";					
					$Cabeceras .= "Content-type: text/html; charset=utf-8\n"; 
											
					$cuerpo = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
					$cuerpo .= "<div><font size='3'><b>".$funcionario."</b></font></div>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<br>\r\n";
					$cuerpo .= "<div><font size='3'>Te damos la bienvenida a nuestro nuevo sistema de Gestión de Calidad SIGCA, al cual podrás ingresar a través de la página web de <a href='https://cecimin.com.co'>CECIMIN S.A.S.</a> o en el siguiente enlace: <a href='https://sigca.cecimin.com.co'>SIGCA</a></font></div>\r\n";		
				   
				    $cuerpo .= "<div><font size='3'>Tu usuario y clave de acceso es tu número de documento de identidad.</font></div>\r\n";
				    $cuerpo .= "<br>\r\n";
				    $cuerpo .= "<div><font size='3'>Te invitamos a visualizar el siguiente video para que conozcas como ingresar y consultar documentos: <a href='https://www.youtube.com/watch?v=1yJCE98uxC0'>Video Paso a Paso</a>\r\n";
				    $cuerpo .= "<br>\r\n";
					$cuerpo .= "Si tienes dudas o inconvenientes con el acceso por favor remite la información  al siguiente correo: calidad.cecimin@saludinteligente.com</font></div>\r\n";
				    $cuerpo .= "<br>\r\n";
				    $cuerpo .= "<br>\r\n";	
				    $cuerpo .= "<br>\r\n";
				    $cuerpo .= "<div><font size='3'>Atentamente,</font></div>\r\n";
				    $cuerpo .= "<br>\r\n";	
				    $cuerpo .= "<br>\r\n";
				    $cuerpo .= "<div><font size='4'><b>Samanta Rodriguez</b></font></div>\r\n";
				    $cuerpo .= "<div><font size='3'>Coordinación de Calidad,</font></div>\r\n";
				    $cuerpo .= "<div><font size='2'>(601) 6002255 ext. 172,</font></div>\r\n";					    
				    $cuerpo .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";					
					$cuerpo .= "<br>\r\n";
					
					$msg = $this->sendEmail($Para, $Asunto, $cuerpo, $Cabeceras);
					if($msg==1){
						$query = 1;
					}else{
						$query =-999;						
					}
				}
				if($query>=1){

				echo '1';
				}else {
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						case "1062": echo "la identificacion ingresada, ya se encuentra registrado; Por favor verifique los datos!"; break;
					    case "-999": echo "Error:".$msg."; Por favor verifique los datos!"; break;
						default: echo "Error: ".$query." => ".$this->db->_error_message(); break;
					}
					echo '</div>';
				}
			}
		}
	}

	public function excel() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {

			$campos ='"..",d.id_documento AS "Id", d.nombre AS "Nombre", t.nombre AS "Tipo de Documento", mp.nombre AS "Macroprocesos", p.nombre AS "Procesos", sp.nombre AS "Subprocesos", d.codigo AS "Código", v.version AS "Versión",v.fecha AS "Fecha Implementación", CASE WHEN d.estado="1" THEN "Vigente" ELSE "Obsoleto" END AS "Estado"';

			$query = $this->general_model->consulta_personalizada($campos, 'documentos d LEFT JOIN tipos_documentos t ON d.id_tipo = t.id_tipo INNER JOIN macroprocesos mp ON d.id_macroproceso = mp.id_macroproceso LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN subprocesos sp ON d.id_subproceso=sp.id_subproceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"','', 'd.id_macroproceso, d.id_procesomaestro,d.id_subproceso', 0, 0);

			$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
			    foreach ($query->list_fields() as $campo)
			    {			      
			    	$tabla .= '<th>'.($campo).'</th>';
			    }
			      	$tabla .= '</tr></thead><tbody class="pos-rel">';

			    foreach ($query->result_array() as $row)
			    {
			      	if($row['Estado'] == "Vigente")
			        	$estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
			      	else
			        	$estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Obsoleto</span>';

			      	$tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tipo de Documento'].'</td><td>'.$row['Macroprocesos'].'</td><td>'.$row['Procesos'].'</td><td>'.$row['Subprocesos'].'</td><td>'.$row['Código'].'</td><td>'.$row['Versión'].'</td><td>'.$row['Fecha Implementación'].'</td><td>'.$estado.'</td>';
			     
			      	$tabla .= '</tr>';        
			    }
			    $tabla .= '</tbody>';   
			    
			   		
			$filename = "Maestro_Documentos.xls";
		    header ("Content-Disposition: attachment; filename=".$filename ); 
			header ("Content-Type: application/vnd.ms-excel");
			
			$this->load->helper('funciones_tabla');
			
		    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO MAESTRO DE DOCUMENTOS</th></tr></table><br>');

		    echo '<table border="1">';
            echo utf8_decode($tabla); 
            echo '</table>';			
		}//-Valida Inicio de Session
	}

	public function sendEmail($Para, $Asunto, $cuerpo, $Cabeceras){
		if(mail($Para, $Asunto, $cuerpo, $Cabeceras)){
			$msg = 1;				
		}else{
			$msg = $this->email->print_debugger();	
		}
		return $msg;
	}
}