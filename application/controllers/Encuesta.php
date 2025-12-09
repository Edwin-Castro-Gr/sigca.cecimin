<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');		
	}
	
	public function index()	
	{
		$this->session->sess_destroy();
		$this->load->view('encuesta/index');
	}
	
	public function guardar()
	{

		if(!$this->input->is_ajax_request()) {
			redirect();
		} else {

			$fecha = date('Y-m-d H:i:s');

			$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 
				
			$this->session->set_userdata($datos_session2); 
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').';');

			$registro=array(
				'fecha_encuesta'=>$fecha, 
				'servicio'=>$this->input->post('servicio'), 
				'sugerencias'=>$this->input->post('sugerencias'),
				'id_encuestado'=>$this->input->post('cedula'),
				'estado'=>'1'
			);				

			$query = $this->general_model->insert('encuesta_satisfaccion', $registro);
			if($query >= 1) {
				
				$campos = 'id_pregunta AS "Pregunta", CONCAT(id_objeto,literal) AS "Codigo"';
				$consulta = $this->general_model->consulta_personalizada($campos,'encuesta_preguntas','','', 0, 0);

				foreach ($consulta->result_array() as $row){
					$respuesta = $this->input->post('calificacion_'.$row['Codigo'].'');
					$registro=array(
						'id_encuesta'=>$query, 
						'id_pregunta'=>$row['Pregunta'], 
						'respuesta'=>$respuesta,
						'fecha_registro'=>$fecha,
						'estado'=>'1'
					);		
					$query1 = $this->general_model->insert('encuesta_respuestas', $registro);					
				}	
			}

			if($query1 >= 1) {

				$registro=array(
					'id_encuesta'=>$query, 
					'nombre_encuestado'=>$this->input->post('nombre_encuestado'), 
					'tipo_encuestado'=>$this->input->post('tipo_encuestado'),					
					'n_identificacion'=>$this->input->post('cedula'), 
					'genero'=>$this->input->post('genero'),					
					'nombre_paciente'=>$this->input->post('nompaciente'), 
					'año_nacimiento'=>$this->input->post('fechapaciente'),					
					'telefono_fijo'=>$this->input->post('fijo'),					
					'celular'=>$this->input->post('celular'), 
					'entidad_salud'=>$this->input->post('entidadpaciente'),
					'otra_entidad_salud'=>$this->input->post('otraentidad')
				);				

				$query = $this->general_model->insert('encuesta_datos_encuestado', $registro);
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

	public function reportes()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect(base_url());
		} else {
			$this->load->database();
			$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');


			$this->load->helper('funciones_select');
			$data_usua['titulo']="Encuestas de Satisfacción";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='encuesta/reportes';
			$data_usua['entrada_js']='_js/encuesta.js';
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
    
			    $campos = ' "..", id_encuesta AS "Id", servicio AS "Servicio", id_encuestado AS "Encuestado", fecha_encuesta AS "Fecha", CASE WHEN estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado", "" AS "Acción" ';
			      
			    			    
			    $query = $this->general_model->consulta_personalizada($campos, 'encuesta_satisfaccion', '', 'Id', 0, 0);
			    
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
				    if($row['Estado'] == "Activo")
				        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
				    else
				        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

				    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Servicio'].'</td><td>'.$row['Encuestado'].'</td><td>'.$row['Fecha'].'</td><td>'.$estado.'</td>';

			      
		        	$tabla .= '<td class="text-nowrap"><div class="action-buttons">
		          
		          	<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

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

					$tabla = '';
					
					$campos = 'r.id_encuesta AS "Consecutivo", "Bogota" AS "Ciudad", "IPS" AS "Tipo de Sede","CECIMIN S.A.S" AS "Nombre de la sede", MONTH(es.fecha_encuesta) AS "MM", DAY(es.fecha_encuesta) AS "DD", YEAR(es.fecha_encuesta) AS "AA", es.servicio AS "Servicio"';

					$campos1 = 'pregunta AS "Pregunta"';

					$query1 = $this->general_model->consulta_personalizada($campos1, 'encuesta_preguntas', '', 'id_pregunta', 0, 0);
					foreach ($query1->result_array() as $row){
					 	$campos.=",MAX(CASE WHEN p.pregunta = '".$row['Pregunta']."' THEN r.respuesta ELSE '0' END) AS '".$row['Pregunta']."'";
					}
					$campos.= ', de.nombre_encuestado AS "Encuestado", de.tipo_encuestado AS "Tipo Encuestado", de.n_identificacion AS "Documento Idenidad", de.genero AS "Genero", de.telefono_fijo AS "Teléfono fijo", de.celular AS "Celular", de.nombre_paciente AS "Nombre del Paciente", de.año_nacimiento AS "Año de nacimiento del paciente", de.entidad_salud AS "Entidad Salud", de.otra_entidad_salud AS "Otra Entidad Salud", es.sugerencias AS "Sugerenicias"';
					// CONSULTA DINAMICA 
					
					$query = $this->general_model->consulta_personalizada($campos, 'encuesta_preguntas p INNER JOIN encuesta_respuestas r ON p.id_pregunta=r.id_pregunta INNER JOIN encuesta_satisfaccion es ON r.id_encuesta=es.id_encuesta INNER JOIN encuesta_datos_encuestado de ON de.id_encuesta=es.id_encuesta GROUP BY r.id_encuesta', '', 'r.id_encuesta', 0, 0);

					$tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
					$td = '<tr class="d-style bgc-h-default-l4">';
				    foreach ($query->list_fields() as $campo)
				    {				      
				        $tabla .= '<th>'.($campo).'</th>';	
				        		    
					}
					$tabla .= '</tr></thead><tbody class="pos-rel">';
					
					foreach ($query->result_array() as $row1)
	    				{
	    					$tabla .= '<tr><td>'.$row1['Consecutivo'].'</td><td>'.$row1['Ciudad'].'</td><td>'.$row1['Tipo de Sede'].'</td><td>'.$row1['Nombre de la sede'].'</td><td>'.$row1['MM'].'</td><td>'.$row1['DD'].'</td><td>'.$row1['AA'].'</td><td>'.$row1['Servicio'].'</td><td>'.$row1['a. Claridad de la información'].'</td><td>'.$row1['b. Orientación dada durante su permanencia '].'</td><td>'.$row1['c. Amabilidad del personal'].'</td><td>'.$row1['d. Agilidad en la atención'].'</td><td>'.$row1['e. Facilidad en los tramites'].'</td><td>'.$row1['f. Presentación personal de los funcionarios'].'</td><td>'.$row1['a. Oportunidad en la atención'].'</td><td>'.$row1['b. Trato, amabilidad y respeto por parte del profesional'].'</td><td>'.$row1['c. Claridad de la información brindada a usted o su familia'].'</td><td>'.$row1['d. Información acerca de los servicios cubiertos y no cubiertos'].'</td><td>'.$row1['e. Indicaciones y concejos para el cuidado de la salud'].'</td><td>'.$row1['f. Información de sus derechos y deberes'].'</td><td>'.$row1['a. Señalización'].'</td><td>'.$row1['b. Comodidad de las instalaciones'].'</td><td>'.$row1['c. Higiene y aseo general'].'</td><td>'.$row1['d. Mantenimiento e imagen de las instalaciones'].'</td><td>'.$row1['e. Seguridad de las instalciones'].'</td><td>'.$row1['Satisfacción general'].'</td><td>'.$row1['Recomendaría esta sede'].'</td><td>'.$row1['Encuestado'].'</td><td>'.$row1['Tipo Encuestado'].'</td><td>'.$row1['Documento Idenidad'].'</td><td>'.$row1['Genero'].'</td><td>'.$row1['Teléfono fijo'].'</td><td>'.$row1['Celular'].'</td><td>'.$row1['Nombre del Paciente'].'</td><td>'.$row1['Año de nacimiento del paciente'].'</td><td>'.$row1['Entidad Salud'].'</td><td>'.$row1['Otra Entidad Salud'].'</td><td>'.$row1['Sugerenicias'].'</td></tr>';    					
	    				}						
					
					$tabla .= '</tbody>'; 
					$filename = "Listado_Encuestas.xls";
					$usuario = $this->session->userdata('C_id_usuario');
				    header ("Content-Disposition: attachment; filename=".$filename );
					header ("Content-Type: application/vnd.ms-excel");

					$this->load->helper('funciones_tabla');

				    echo utf8_decode('<table border="1"><tr><th colspan="7">LISTADO GENERAL ENCUESTAS</th></tr></table><br>');

				    echo '<table border="1">';
		            echo utf8_decode($tabla);
		            echo '</table>';	

				
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

				$campos = 'r.id_encuesta AS "Consecutivo", "Bogota" AS "Ciudad", "CENTROS_MEDICOS_COLSANITAS_CENTROS_DIAGNOSTICOS" AS "Tipo de Sede","CECIMIN S.A.S" AS "Nombre de la sede", MONTH(es.fecha_encuesta) AS "MM", DAY(es.fecha_encuesta) AS "DD", YEAR(es.fecha_encuesta) AS "AA", es.servicio AS "Servicio"';

					$campos1 = 'pregunta AS "Pregunta"';

					$query1 = $this->general_model->consulta_personalizada($campos1, 'encuesta_preguntas', '', 'id_pregunta', 0, 0);
					foreach ($query1->result_array() as $row){
					 	$campos.=",MAX(CASE WHEN p.pregunta = '".$row['Pregunta']."' THEN r.respuesta ELSE '0' END) AS '".$row['Pregunta']."'";
					}
					$campos.= ', de.nombre_encuestado AS "Encuestado", de.tipo_encuestado AS "Tipo Encuestado", de.n_identificacion AS "Documento Idenidad", de.genero AS "Genero", de.telefono_fijo AS "Teléfono fijo", de.celular AS "Celular", de.nombre_paciente AS "Nombre del Paciente", de.año_nacimiento AS "Año de nacimiento del paciente", de.entidad_salud AS "Entidad Salud", de.otra_entidad_salud AS "Otra Entidad Salud", es.sugerencias AS "Sugerenicias"';
					// CONSULTA DINAMICA 
					
					$query = $this->general_model->consulta_personalizada($campos, 'encuesta_preguntas p INNER JOIN encuesta_respuestas r ON p.id_pregunta=r.id_pregunta INNER JOIN encuesta_satisfaccion es ON r.id_encuesta=es.id_encuesta INNER JOIN encuesta_datos_encuestado de ON de.id_encuesta=es.id_encuesta', 'es.id_encuesta='.$idreg.' GROUP BY es.id_encuesta', 'es.id_encuesta', 0, 0);

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
	