<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_enviaringresop extends CI_Controller {
	
	//Constructor de la clase
	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Bogota');
		
		$this->load->helper('recaptcha'); // Carga el helper de reCAPTCHA
	}
	
	public function index()	{

		$this->session->sess_destroy();
		$idcargo = $this->input->get('idcargo');
		$idingreso = $this->input->get('idingreso');
		$usuario = strtoupper($this->input->get('usuario'));
		$tipo_contrato= $this->input->get('tipo_contrato');
		$coordinador = $this->input->get('coordinador');
		$correo_coord = $this->input->get('correo_coord');


		$data_usua['c_cargo'] = $idcargo;
		$data_usua['c_ingreso'] = $idingreso;
		$data_usua['c_usuario'] = $usuario;			
		$data_usua['c_tipo_contrato'] = $tipo_contrato;	
		$data_usua['c_coordinador'] = $coordinador;
		$data_usua['c_correo_coord'] = $correo_coord;	

		$this->load->view('ingresosp/enviar',$data_usua);
	}


	public function cargar_anexos() {	
		
		$cargo = $this->input->post('idcargo'); 
		$datos_session2 = array('C_basedatos'=>'u610593899_sigca'); 
		$this->session->set_userdata($datos_session2); 
		$this->load->database();
		$this->db->query('USE '.$this->session->userdata('C_basedatos').'; ');
		$cargo = $this->input->post('idcargo');
		$tipo_contrato = $this->input->post('idtipoContrato');

		$t_cont= '7';
 				if($tipo_contrato !=7){
					$t_cont = '1';	
				}
		$count = 0;

		$campos ='ld.id_listado AS "Id", ld.nombre AS "Nombre"';
      
    $query = $this->general_model->consulta_personalizada($campos, 'ckeklist_contratosp AS cc LEFT JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos)', 'cc.id_cargo='.$cargo.' AND cc.tipo_contrato='.$t_cont.' AND ld.estado = "1"', 'ld.id_listado', 0, 0);

	    
	    $accordion = '<div class="accordion" id="accordionAnexos">';
	    $accordion .= '<div class="card border-0 bgc-green-l5 post-carg" >';
	    $accordion .= '<div class="card-header border-0 bgc-transparent mb-0" id="heading1">';
	    $accordion .= '<h2 class="card-title bgc-transparent text-green-d2 brc-green">';
	    $accordion .= ' <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse1" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                              
        <!-- the toggle icon -->
         <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
            <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
        </span>
          <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
            <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
        </span>
        </a></h2></div>';
	    $accordion .='<div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionAnexos">';

	    foreach ($query->result_array() as $row)
	    {    
	    	$count = $count+1;  
		    $accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
	                    <div class="form-group row" id="div_archivo'.$row['Id'].'">
	                      	<div class="col-sm-4 col-form-label text-sm-right pr-0">'.
	                        	form_label('Archivo '.$row['Nombre'],'archivo', array('class'=>'mb-0')).'
	                      	</div>
	                      	<div class="col-sm-8">'.
	                        	form_input(array('type'=>'hidden', 'name'=>'nomarchivo_'.$row['Id'], 'id'=>'nomarchivo_'.$row['Id'], 'value'=>$row['Nombre'])).
	                        	form_upload(array('type'=>'file', 'name'=>'archivo_'.$row['Id'], 'id'=>'archivo_'.$row['Id'], 'placeholder'=>'Seleccione el Archivo '.$row['Nombre'], 'class'=>'form-control col-sm-9 col-md-10','multiple'=>'multiple')).'
	                      	</div>
	                    </div>
	                    <div class="form-group row" id="div_fechas_'.$row['Id'].'">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">'.
                          form_label('Fecha inicio vigencia ','fecha_inicio_'.$row['Id'], array('class'=>'mb-0')).'
                      </div>
                      <div class="col-sm-3">'.
                          form_input(array('type'=>'date', 'name'=>'fecha_inicio_'.$row['Id'], 'id'=>'fecha_inicio_'.$row['Id'], 'class'=>'form-control')).'
                      </div>

                      <div class="col-sm-3 col-form-label text-sm-right pr-0">'.
                          form_label('Fecha final vigencia ','fecha_final_'.$row['Id'], array('class'=>'mb-0')).'
                      </div>
                      <div class="col-sm-3">'.
                          form_input(array('type'=>'date', 'name'=>'fecha_final_'.$row['Id'], 'id'=>'fecha_final_'.$row['Id'], 'class'=>'form-control')).'
                      </div>                          
                  </div>';
		    $accordion .= '</div>';
	    }
	    $accordion .= '<div class="col-sm-4 col-form-label text-sm-right pr-0">'.
	                        	form_input(array('type'=>'hidden', 'name'=>'countdoc', 'id'=>'countdoc', 'value'=>$count)).' </div>';
	    $accordion .= '</div></div></div>';

	    echo $accordion;
		
	}

	public function guardar() {
		if(!$this->input->is_ajax_request()) {
			redirect();
		} else {

			$this->inicializarSesion();
      $this->load->database();
      $this->db->query('USE ' . $this->session->userdata('C_basedatos') . ';');
      
      $idingresop = $this->input->post('idingreso');
      $observaciones = $this->input->post('observaciones');
      $usuario = strtoupper($this->input->post('idusuario'));

      $coordinador = $this->input->post('coordinador');
      $correo_coord = $this->input->post('correo_coord');

      $correo_remitente = null;
      $id_empleado ='';

      $campos ='id_empleado AS "Idempleado"';
      $query = $this->general_model->consulta_personalizada($campos,'empleados', 'email = "'.$correo_coord.'"', '', 0, 0);

			foreach ($query->result_array() as $row)
			{
				$id_empleado = $row['Idempleado'];
			}

	      $this->load->helper('email'); // Cargar el helper de email
	      $fecha = date('Y-m-d H:i:s');
	      $usuario_notifica = 83;
	      // $usuario_notificado = $id_empleado;
	      $usuario_notificado = 3;

	      $registro = array('anexos_ok' => '1', 'estado'=> '1');
	      $query1 = $this->general_model->update('ingreso_personal', 'id_ingreso', $idingresop, $registro);
	      
	      if ($query1 == "OK") {    
	        echo '1';
	        $ruta = $this->crearDirectorios($idingresop);
	        $this->manejarArchivos($idingresop, $ruta, $fecha);

	        $id_solicitud =  $idingresop;
	        $observacion = "Se cargaron los anexos del ingreso No. " . $id_solicitud;
	        $this->crearNotificacion($id_solicitud, $usuario_notifica, $usuario_notificado, $observacion, $fecha);

	        	// Datos del correo
					// $correo_remitente =''. $correo.'<'.$correo_coord = $row['Correo'].'>';
        	$correo_usuario = $correo_coord;
        	$correo_cc = 'calidad.cecimin@saludinteligente.com';
        	// $correo_usuario = 'castonino17@gmail.com';
        	$asunto = 'Proceso de cargue de Documentos de Ingreso de '.$usuario.'';
        	$mensaje = "<div><font size='3'>Señor(a) Coordinador(a),</font></div>\r\n";				
					$mensaje .= "<div><font size='3'>".$coordinador."</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>Cordial saludo,</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>Por medio del presente le informo se subieron unos documentos, por lo que solicito su revisión</font></div>\r\n";
					$mensaje .= "<br>\r\n";
					$mensaje .= "<div><font size='3'>".$observaciones."</font></div>\r\n";	
		    	$mensaje .= "<br>\r\n";
		    	$mensaje .= "<div><font size='3'>Agradeciendo la atención prestada,</font></div>\r\n";
		    	$mensaje .= "<br>\r\n";		
		    	$mensaje .= "<br>\r\n";
	   			$mensaje .= "<div><font size='3'>Cordialmente,</font></div>\r\n";
		    	$mensaje .= "<br>\r\n";		
		    	$mensaje .= "<br>\r\n";
		    	$mensaje .= "<div><font size='3'>".$usuario."</font></div>\r\n";		    				
					$mensaje .= "<br>\r\n";
				
        	// Archivos a adjuntar
        	$adjuntos = null;

        	// Enviar el correo utilizando el buzón de citas
        	if (enviar_correo($correo_usuario, $asunto, $mensaje, 'ingreso',  $correo_remitente, $adjuntos,$correo_cc)) {
            echo "1";
            $query = 1;
        	} else {
            echo "0";
            $query =-999;	
        	}	         
	      } else {
	          echo $this->mostrarError($query1);
	      }
	   }
	}
			
  private function inicializarSesion() {
    $datos_session2 = array('C_basedatos' => 'u610593899_sigca'); 
    $this->session->set_userdata($datos_session2); 
	}

	private function crearDirectorios($idingresop) {
	    $dir = 'ingreso-' . $idingresop;
	    $baseDir = 'ingresosp/' . $this->session->userdata('C_basedatos') . '/' . $dir . '/';
	    
	    if (!file_exists($baseDir)) {
	        mkdir($baseDir, 0777, true);
	    }
	    
	    return './' . $baseDir;
	}

	private function manejarArchivos($idingresop, $ruta, $fecha) {
	    $this->session->set_userdata('archivo_origen', "");
	    $mensage = '';

	    foreach ($_FILES as $key1 => $key) {
	        if ($key['error'] == UPLOAD_ERR_OK) {
	            $id_check_contrato = explode('_', $key1);
	            $NombreOriginal = $key['name'];
	            $nombre_img = date("YmdHis") . '-' . $NombreOriginal;
	            $nombre = $nombre_img;
	            $temporal = $key['tmp_name'];
	            $Destino = $ruta . $nombre;
	            
	            move_uploaded_file($temporal, $Destino);
	            $this->session->set_userdata('archivo_origen', $Destino);
	            $mensage .= 'cargado';

	            $registro1 = array(
	                'id_ingresop' => $idingresop,
	                'id_checklist_contratos' => $id_check_contrato[1],
	                'archivo' => $Destino,
	                'fecha_registro' => $fecha,                                
	                'estado' => '1'
	            );

	            $this->general_model->insert('ingreso_personal_anexos', $registro1);
	        }
	        
	        if ($key['error'] != '') {
	            $mensage .= '-' . $key['error'] . '-';
	        }
	    }
	}

	private function crearNotificacion($id_solicitud, $usuario_notifica, $usuario_notificado, $observacion, $fecha) {
	    $tipo_notificacion = 9;
	    $registro2 = array(
	        'tipo_notificacion' => $tipo_notificacion,
	        'id_solicitud' => $id_solicitud,
	        'id_usuario_notifica' => $usuario_notifica, 
	        'id_usuario_2' => $usuario_notificado, 
	        'observacion' => $observacion, 
	        'estado' => '0',
	        'fecha_registro' => $fecha
	    );

	    $this->general_model->insert('notificaciones', $registro2);
	}

	private function mostrarError($query) {
	    $mensaje = '<div class="alert alert-danger"><i class="fa fa-ban"></i><strong>¡Error!</strong><br>';
	    switch ($query) {
	        case "1062":
	            $mensaje .= "La identificación ingresada ya se encuentra registrada; ¡Por favor verifique los datos!";
	            break;
	        default:
	            $mensaje .= "Error: " . $query . " => " . $this->db->_error_message();
	            break;
	    }
	    $mensaje .= '</div>';
	    return $mensaje;
	}
	

}
	