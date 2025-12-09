<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
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
	
	public function index()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			switch($this->session->userdata('C_perfil')) {
				case 0: $data_usua['contenido']='home/index';break;
				case 1: $data_usua['contenido']='home/index';break;
				case 2: $data_usua['contenido']='home/index';break;
				case 3: $data_usua['contenido']='home/index';break;
				case 4: $data_usua['contenido']='home/index';break;
				case 5: $data_usua['contenido']='home/index';break;
				case 6: $data_usua['contenido']='home/index';break;
				case 7: $data_usua['contenido']='home/index';break;
				case 8: $data_usua['contenido']='home/index';break;				
			}
			$data_usua['titulo']="Home";
			$data_usua['origen']="";
			$data_usua['entrada_js']='_js/home.js';
			$data_usua['librerias_css']='';
			$data_usua['librerias_js']='';
			$this->load->view('template',$data_usua);
		}
	}


	public function listado_notificaciones() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) {
			redirect();			
		} else {
			$this->load->helper('funciones_select');
			$data_usua['titulo']="Home";
			$data_usua['origen']="Administración";
			$data_usua['contenido']='home/notificaciones';
			$data_usua['entrada_js']='_js/home.js';
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


	public function salir()
	{
		
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}
	
		
	public function perfil()
	{
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$data_usua['titulo']="Perfil";
			$data_usua['origen']="";
			$data_usua['contenido']='home/perfil';
			$data_usua['entrada_js']='_js/perfil.js';
			$data_usua['librerias_css']='';
			$data_usua['librerias_js']='';
			$this->load->view('template',$data_usua);
		}
	}
	
	public function cargar_perfil() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->DB2 = $this->load->database('usuarios', TRUE);
			if(!$this->input->is_ajax_request()) {
				redirect('404');
			}
			else {
				$consulta='SELECT usuario, nombre, apellido, email, telefono FROM usuarios WHERE id_usuario="'.$this->session->userdata('C_id_usuario').'" ';
				$query = $this->model_general->consulta_select_usuarios($consulta);
				if($this->DB2->_error_message()) {
					echo 'ERROR=<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						default: echo "Error: ".$this->DB2->_error_number()." => ".$this->DB2->_error_message(); break;	
					}
					echo '</div>';
				} else {
					foreach ($query->result_array() as $row)
					{				   
					   $tabla = "BIEN=".$row['usuario'].'='.$row['nombre'].'='.$row['apellido'].'='.$row['email'].'='.$row['telefono'];
					}
					echo $tabla;			
				}
			}
		}
	}
	
	public function guardar_perfil() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->DB2 = $this->load->database('usuarios', TRUE);
			if(!$this->input->is_ajax_request()) {
				redirect('404');
			}
			else {
				$registro=array('usuario'=>$this->input->post('usuario'), 'nombre'=>$this->input->post('nombre'), 'apellido'=>$this->input->post('apellido'), 'email'=>$this->input->post('email'), 'telefono'=>$this->input->post('telefono'));
				$query = $this->model_general->update_usuario('usuarios', 'id_usuario', $this->session->userdata('C_id_usuario'), $registro);
				if($query=="OK")
					echo '1';
				else {
					echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						default: echo "Error: ".$query." => ".$this->DB2->_error_message(); break;	
					}
					echo '</div>';
				}
			}
		}
	}
	
	public function guardar_clave() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			$this->DB2 = $this->load->database('usuarios', TRUE);
			if(!$this->input->is_ajax_request()) {
				redirect('404');
			}
			else {
				$consulta='SELECT AES_DECRYPT(clave,"-Qsc.961181!") AS clave FROM usuarios WHERE id_usuario="'.$this->session->userdata('C_id_usuario').'" ';
				$query = $this->model_general->consulta_select_usuarios($consulta);
				if($this->DB2->_error_message()) {
					echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						default: echo "Error: ".$this->DB2->_error_number()." => ".$this->DB2->_error_message(); break;	
					}
					echo '</div>';
				} else {
					foreach ($query->result_array() as $row)
					{
						if($row['clave']==$this->input->post('clave')){
							$consulta='UPDATE usuarios SET clave=AES_ENCRYPT("'.$this->input->post('clave_nueva').'", "-Qsc.961181!") WHERE id_usuario="'.$this->session->userdata('C_id_usuario').'" ';
							$query = $this->model_general->consulta_select_usuarios($consulta);
							if($this->DB2->_error_message()) {
								echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
								switch($query) {
									default: echo "Error: ".$this->DB2->_error_number()." => ".$this->DB2->_error_message(); break;	
								}
								echo '</div>';
							} else {
									echo "1";
									$this->db->trans_start();
									$this->db->query('INSERT INTO log (id_usuario, fecha, accion) VALUES ("'.$this->session->userdata('C_id_usuario').'","'.date("Y-m-d H:i:s").'","Cambio de Clave")');
									$this->db->trans_complete();
							}
						}
						else
							echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>La contraseña actual no coincide, por favor intente nuevamente!</div>';
					}
				}
			}
		}
	}
	
	public function cargar_perfil_log() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect(base_url());
		else {
			if(!$this->input->is_ajax_request()) {
				redirect('404');
			}
			else {
				$sql="SELECT fecha AS 'Fecha', accion AS 'Acción' FROM log WHERE id_usuario='".$this->session->userdata('C_id_usuario')."' ORDER BY fecha ASC ";
				$query=$this->model_general->consulta_select($sql);
				if($this->db->_error_message()) {
					echo '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
					switch($query) {
						default: echo "Error: ".$this->db->_error_number()." => ".$this->db->_error_message(); break;	
					}
					echo '</div>';
				} else {
					$tabla='<thead><tr>';
					foreach ($query->list_fields() as $campo)
					{
					   $tabla .= '<th>'.$campo.'</th>';
					}
					$tabla .= '</tr></thead><tbody>';
			
					foreach ($query->result_array() as $row)
					{
					   $tabla .= '<tr><td>'.$row['Fecha'].'</td><td>'.$row['Acción'].'</td></tr>';
					}
					$tabla .= '</tbody></table>';
					echo $tabla;
				}
			}
		}
	}

	//------------------NOTIFICACIONES--------------------------------------------------
	
	public function cargar_notificacion1() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');
				$usuario = $this->session->userdata('C_id_usuario');

				// ---------- CANTIDAD DE NOTIFICACIONES ---------------------
				// $campos = "IFNULL((SELECT COUNT(id_notificacion) FROM notificaciones WHERE fecha_visto IS NULL AND id_usuario_2=".$usuario."),0) AS 'cantidad', (SELECT COUNT(id_notificacion) FROM notificaciones WHERE id_usuario_2=".$usuario.") AS 'total'";
				// $query = $this->general_model->consulta_personalizada($campos, '', '', '', 0, 0);
 				$sql="SELECT IFNULL((SELECT COUNT(id_notificacion) FROM notificaciones WHERE fecha_visto IS NULL AND id_usuario_2='".$usuario."'),0) AS 'cantidad', (SELECT COUNT(id_notificacion) FROM notificaciones WHERE id_usuario_2='".$usuario."') AS 'total'";

				$query=$this->general_model->consulta_select($sql);

				$row = $query->row_array();
				$cantidad = $row['cantidad'];
				$total = $row['total'];
			
				// ---------- LISTA DE primeras 10 NOTIFICACIONES ---------------------
				$campos = "tipo_notificacion, observacion, fecha_registro ";
				$query = $this->general_model->consulta_personalizada($campos, 'notificaciones', 'fecha_visto IS NULL AND id_usuario_2="'.$usuario.'"', '', 10, 0);

				if($query->num_rows() > 0) {
					$listado = '';
					foreach ($query->result_array() as $row) {
						switch($row['tipo_notificacion']) {
							case '0': //TAREAS
								$i = '<i class="far fa-clock bgc-purple-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								break;
							case '1': //CAPACITACIONES
								$i = '<i class="fa fa-comment bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								break;
							case '2': //OTROS EVENTOS
								$i = '<i class="fa fa-shopping-cart bgc-success-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								break;
							case '3': 
								$i = '<i class="fab fa-twitter bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								break;

						}

						$listado .= '<a href="https://ceciminsigca.com/d_solicitud/" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                          '.$i.'
                          <span class="text-muted">'.$row['observacion'].'</span>
                          <span class="float-right badge badge-info radius-round text-80">'.$row['fecha_registro'].'</span>
                        </a>';
					}
					$listado .= '<hr class="mt-1 mb-1px brc-secondary-l2" />
                        <a href="'.base_url('home/index').'" class="mb-0 py-3 border-0 list-group-item text-blue text-uppercase text-center text-85 font-bolder">
                          Ver todas las notificaciones
                          <i class="ml-2 fa fa-arrow-right text-muted"></i>
                        </a>';
				} else {
					$listado = '<hr class="mt-1 mb-1px brc-secondary-l2" />
                        <a href="'.base_url('home/index').'" class="mb-0 py-3 border-0 list-group-item text-blue text-uppercase text-center text-85 font-bolder">
                          Ver todas las notificaciones
                          <i class="ml-2 fa fa-arrow-right text-muted"></i>
                        </a>';
				}


				$arr['noti'][] = array('cantidad'=>$cantidad, 'listado'=>$listado, 'total'=>$total);
				
				echo json_encode( $arr );

			}
		}
	}

	
	public function cargar_notificacion() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {
				header('Content-Type: application/json');
				$usuario = $this->session->userdata('C_id_usuario');

				// ---------- CANTIDAD DE NOTIFICACIONES ---------------------
				// $campos = "IFNULL((SELECT COUNT(id_notificacion) FROM notificaciones WHERE fecha_visto IS NULL AND id_usuario_2=".$usuario."),0) AS 'cantidad', (SELECT COUNT(id_notificacion) FROM notificaciones WHERE id_usuario_2=".$usuario.") AS 'total'";
				// $query = $this->general_model->consulta_personalizada($campos, '', '', '', 0, 0);
 				$sql="SELECT tipo_notificacion AS 'Tipo', COUNT(id_notificacion) AS 'Cantidad' FROM notificaciones WHERE fecha_visto IS NULL AND id_usuario_2 ='".$usuario."' GROUP BY tipo_notificacion";

				$query=$this->general_model->consulta_select($sql);
				$ctotal=0;
				if($query->num_rows() > 0) {
					$listado = '';
					foreach ($query->result_array() as $row) {
						$ctotal=$ctotal+$row['Cantidad'];
						switch($row['Tipo']) {
							case '0': //DOCUMENTOS
								$i = '<i class="fa fa-comment-o bgc-purple-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Solicitud Documentos'; 
								$href ='d_solicitud/index';
								break;
							case '1': //AGENDAMIENTO QX
								$i = '<i class="fa fa-calendar bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Agendamiento Qx'; 
								$href ='c_programacion/index';
								break;
							case '2': //CAPACITACIONES
								$i = '<i class="fa fa-id-card bgc-success-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Capacitaciones'; 
								$href ='#';
								break;
							case '3': //EVENTOS
								$i = '<i class="fab fa-twitter bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Eventos'; 
								$href ='e_eventos/index';
								break;
							case '4': //MEDICAMENTOS
								$i = '<i class="far fa-clock bgc-purple-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Medicamentos'; 
								$href ='#';
								break;
							case '5': //CONTRATOS TERCEROS
								$i = '<i class="fa fa-folder-open-o bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Contratos Terceros'; 
								$href ='c_contratost/index';
								break;
							case '6': //CONTRATOS PERSONAL
								$i = '<i class="fa fa-folder-open bgc-success-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Contratos Personal';
								$href ='a_contratos/index'; 
								break;
							case '7': //COSTOS
								$i = '<i class="fa fa-calculator bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Costos'; 
								$href ='#';
								break;
							case '8': //SOCIALIZACION 
								$i = '<i class="fa fa-comment bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Socialización';
								$href ='home/index'; 
								break;
							case '9': //OTROS
								$i = '<i class="far fa-clock bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='Otros'; 
								$href ='#'; 
								break;
							case '10': 
								$i = '<i class="fab fa-twitter bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>';
								$tipo ='';
								$href ='#'; 
								break;

						}

						$listado .= '<a href="'.base_url($href).'" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                          '.$i.'
                          <span class="text-muted">'.$tipo.'</span>
                          <span class="float-right badge badge-info radius-round text-80">'.$row['Cantidad'].'</span>
                        </a>';
					}
					$listado .= '<hr class="mt-1 mb-1px brc-secondary-l2" />
                        <a href="'.base_url('home/index').'" class="mb-0 py-3 border-0 list-group-item text-blue text-uppercase text-center text-85 font-bolder">
                          Ver todas las notificaciones
                          <i class="ml-2 fa fa-arrow-right text-muted"></i>
                        </a>';
				} else {
					$listado = '<hr class="mt-1 mb-1px brc-secondary-l2" />
                        <a href="'.base_url('home/index').'" class="mb-0 py-3 border-0 list-group-item text-blue text-uppercase text-center text-85 font-bolder">
                          Ver todas las notificaciones
                          <i class="ml-2 fa fa-arrow-right text-muted"></i>
                        </a>';
				}
				$sql="SELECT COUNT(id_notificacion) AS 'total' FROM notificaciones WHERE id_usuario_2='".$usuario."'";
				$query=$this->general_model->consulta_select($sql);
				$row = $query->row_array();
				$total = $row['total'];

				$arr['noti'][] = array('cantidad'=>$ctotal, 'listado'=>$listado, 'total'=>$total);
				
				echo json_encode( $arr );

			}
		}
	}

	public function cargar_listado_notificaciones(){
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			if(!$this->input->is_ajax_request()) {
				redirect();
			} else {

				$id_usuario = $this->session->userdata('C_id_usuario');

				$band =  0;

				$tabla = '';
    
		    $campos = ' "..", n.id_notificacion AS "Id", CASE WHEN n.tipo_notificacion ="0" THEN "Solicitud Documentos" WHEN n.tipo_notificacion ="1" THEN "Agendamiento Qx" WHEN n.tipo_notificacion ="2" THEN "Capacitaciones" WHEN n.tipo_notificacion ="3" THEN "Eventos" WHEN n.tipo_notificacion ="4" THEN "Medicamentos" WHEN n.tipo_notificacion ="5" THEN "Contratos Tercero" WHEN n.tipo_notificacion ="6" THEN "Contratos Personal" WHEN n.tipo_notificacion ="7" THEN "Costos" WHEN n.tipo_notificacion ="8" THEN "Socialización" WHEN n.tipo_notificacion ="9" THEN "Sucesos de Seguridad" WHEN n.tipo_notificacion ="10" THEN "Rondas de Seguridad" WHEN n.tipo_notificacion ="11" THEN "Mantenimientos" END AS "Modulo", n.id_solicitud AS "Solicitud", IFNULL(CONCAT(e1.nombres, " ", e1.apellidos), " ") AS "Quien Notifica", n.observacion AS "Observaciones", n.fecha_registro AS "Fecha Notificación"';
		      
		    if (band == 0){

 					$query = $this->general_model->consulta_personalizada($campos, 'notificaciones n INNER JOIN empleados e1 ON n.id_usuario_notifica = e1.id_empleado INNER JOIN empleados e2 ON n.id_usuario_2 = e2.id_empleado', 'n.id_usuario_2 ='.$id_usuario.' AND estado = "0"', 'Id', 0, 0);
		    }	else{

		    	$query = $this->general_model->consulta_personalizada($campos, 'notificaciones n INNER JOIN empleados e1 ON n.id_usuario_notifica = e1.id_empleado INNER JOIN empleados e2 ON n.id_usuario_2 = e2.id_empleado', 'n.id_usuario_2 ='.$id_usuario.'', 'Id', 0, 0);
		    }		    
		   
		    
		    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
		    foreach ($query->list_fields() as $campo)
		    {
		      $tabla .= '<th>'.($campo).'</th>';
		    }
		    $tabla .= '</tr></thead><tbody class="pos-rel">';
		    //$tabla = '<tbody class="mt-1">';

		    foreach ($query->result_array() as $row)
		    {
			    
			    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Modulo'].'</td><td>'.$row['Solicitud'].'</td><td>'.$row['Quien Notifica'].'</td><td>'.$row['Observaciones'].'</td><td>'.$row['Fecha Notificación'].'</td>';

		      $tabla .= '</tr>';        
		    }
		    $tabla .= '</tbody>';   
		    
		    echo $tabla;

			}
		}
	}


	public function listar_tabla() {
		if(!defined('CON_id_usuario') && $this->session->userdata('C_id_usuario')=="" ) 
			redirect();
		else {
			/*if(!$this->input->is_ajax_request()) {
				redirect();
			} else*/ {
				$usuario = $this->session->userdata('C_id_usuario');

				
				$campos = "'' AS '..', t.id_tareas AS '#', t.id_modulo AS 'Modulo', t.id_solicitud AS 'Solicitud', t.fecha_registro AS 'Fecha', t.tipo_tarea AS 'Tarea', CONCAT(u.nombre, ' ', u.apellido) AS 'Solicitada por', t.descripcion AS 'Actividad', CASE WHEN t.estado='1' THEN 'Realizada' ELSE 'Pendiente' END AS 'Estado'";
				$query = $this->general_model->consulta_personalizada($campos, 'tareas t INNER JOIN usuarios u ON t.id_usuario_asigna = u.id_usuario', 'id_usuario_tarea="'.$usuario.'" AND t.estado = "0"', 't.fecha_registro DESC', 0, 0);

				$tabla = '<thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent"><tr>';
		    $tabla .= '<th>..</th><th>#</th><th>Fecha</th><th>Tarea</th>
					        <th class="d-none d-sm-table-cell">Solicitada por</th>
					        <th class="d-none d-sm-table-cell">Observaciones</th>
					        <th class="d-none d-sm-table-cell">Estado</th>
					        <th class="d-none d-sm-table-cell">Gestionar</th>';
		    $tabla .= '</tr></thead><tbody class="mt-1">';
		    $cont = 0;
		    foreach ($query->result_array() as $row)
		    {
		    	$cont++;
		      
		      $tabla .= '<tr class="bgc-h-yellow-l4 d-style"><td>'.$cont.'</td><td>'.$row['#'].'</td><td>'.$row['Fecha'].'</td><td>'.$row['Tarea'].'</td><td>'.$row['Solicitada por'].'</td><td>'.$row['Actividad'].'</td><td>'.$row['Estado'].'</td><td align-center><a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip_'.$row['Modulo'].'_'.$row['Solicitud'].'" id="btngestionar_'.$row['Modulo'].'_'.$row['Solicitud'].'"> <i  id="btngestionar_'.$row['Modulo'].'_'.$row['Solicitud'].'_'.$usuario.'" class="fa fa-file text-105"></i> </a></td>';

		      $tabla .= '</tr>';        
		    }
		    $tabla .= '</tbody>';

		    echo $tabla; 

				
			}
		}
	}

	//------------------FIN NOTIFICACIONES----------------------------------------------
}