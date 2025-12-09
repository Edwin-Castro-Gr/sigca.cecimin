<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones_model extends CI_Model {

    public function notificar_vencimientos() {
        $this->load->database();
        $this->load->helper('email');
        $fecha = date('Y-m-d H:i:s');

        // Log de inicio
        log_message('info', 'Iniciando proceso de notificación de vencimientos');
        // Paso 1: Obtener todos los documentos próximos a vencer
        

        $sql = "SELECT ca.*, ld.nombre AS nombre_documento, c.id_contrato AS contrato_id, 
            ef.email AS Correo_Funcionario, ej.email AS Correo_Jefe, 
            IFNULL(CONCAT(ef.nombres, ' ', ef.apellidos),'') AS Nombre_Funcionario,
            IFNULL(CONCAT(ej.nombres, ' ', ej.apellidos),'') AS Nombre_Jefe 
            FROM contratos_anexos ca 
            INNER JOIN contratos c ON ca.id_contrato = c.id_contrato 
            INNER JOIN empleados ef ON c.id_funcionario = ef.id_empleado 
            INNER JOIN empleados ej ON c.jefe_inmediato = ej.id_empleado 
            INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, ca.id_checklist_contratos) 
            WHERE ca.fecha_fin_vigencia BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

        $query = $this->db->query($sql);
        $num_results = $query->num_rows();
        log_message('info', "Número de documentos próximos a vencer: {$num_results}");

        // Paso 2: Agrupar por contrato
        $contratos = [];

        foreach ($query->result() as $row) {
            // Verifica si ya se notificó este documento
            $this->db->where([
                'id_anexo_contrato' => $row->id_anexo,
                'fecha_vencimiento' => $row->fecha_fin_vigencia
            ]);
            if ($this->db->get('c_notidicaciones_enviadas')->num_rows() > 0) {
                continue; // ya fue notificado
            }

            $contrato_id = $row->contrato_id;
            if (!isset($contratos[$contrato_id])) {
                $contratos[$contrato_id] = [
                    'funcionario_email' => $row->Correo_Funcionario,
                    'jefe_email' => $row->Correo_Jefe,
                    'nombre_funcionario' => $row->Nombre_Funcionario,
                    'nombre_jefe' => $row->Nombre_Jefe,
                    'documentos' => []
                ];
            }

            $contratos[$contrato_id]['documentos'][] = [
                'id' => $row->id_anexo,
                'nombre' => $row->nombre_documento ?? 'Documento sin nombre',
                'fecha_vencimiento' => $row->fecha_fin_vigencia
            ];
        }

        // Paso 3: Enviar correos agrupados por contrato
        foreach ($contratos as $contrato_id => $info) {
            if (empty($info['documentos'])) continue;

            $msg = '';
            $usuario = '';

            $funcionario = "{$info['nombre_funcionario']}";
            //$correo_funcionario = $info['funcionario_email'];
            $correo_funcionario = 'castonino17@gmail.com'; // para pruebas

            $correo_remitente = 'Calidad CECIMIN';
            $correo_usuario = 'edwincas_17@hotmail.com';
            $correo_cc = 'calidad.cecimin@saludinteligente.com';

            $asunto = "Aviso: Documentos del contrato #{$contrato_id} próximos a vencer";

            $mensaje = "<div><font size='3'>Estimado(a),</font></div>\r\n";				
            $mensaje .= "<div><font size='3'>{$info['nombre_funcionario']},</font></div>\r\n";
            $mensaje .= "<br>\r\n";
            $mensaje .= "<br>\r\n";
            $mensaje .= "<div><font size='3'>Reciba un cordial saludo,</font></div>\r\n";
            $mensaje .= "<br>\r\n";
            $mensaje .= "<br>\r\n";
            $mensaje .= "<div><font size='3'>El motivo de la presente es para informarles que los siguientes documentos del contrato <strong>#{$contrato_id}</strong> están próximos a vencer:</font></div>\r\n";									
            $mensaje .= "<br><ul>";	
            foreach ($info['documentos'] as $doc) {
                $mensaje .= "<li>ID: <strong>{$doc['id']}</strong>, Documento: {$doc['nombre']}, vence el <strong>{$doc['fecha_vencimiento']}</strong></li>";
            }
            $mensaje .= "</ul><br><br>Por lo que le solicitamos, enviar los documentos actualizados.<br><br>\r\n";	
            $mensaje .= "<div><font size='3'>Atentamente, </font></div>\r\n";
            $mensaje .= "<br>\r\n";		
            $mensaje .= "<br>\r\n";				   
            $mensaje .= "<div><font size='3'>Coordinadora de Calidad</font></div>\r\n";
            $mensaje .= "<div><img style='display:flex;margin-left:5; width:180px'  src='https://sigca.cecimin.com.co/assets/image/logo-cecimin.png'/>";				
            $mensaje .= "<br>\r\n";
            $mensaje .= "<br>\r\n";		
            $mensaje .= "<br>\r\n";
            $mensaje .= "<div><font size='1' color:'#20A491' >MEDIO AMBIENTE: ¿Necesita realmente imprimir este correo? CONFIDENCIALIDAD: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su destinatario. </font></div>\r\n";									

            $mensaje .= "\r\n";

            // Archivos a adjuntar
            $adjuntos =  Null;		            	

            // Enviar el correo utilizando el buzón de citas
            $responseCorreo = (enviar_correo($correo_usuario, $asunto, $mensaje, 'notificacion',  $correo_remitente, $adjuntos, $correo_cc));
            if ($responseCorreo) {
                log_message('info', "Correo enviado para el contrato {$contrato_id} a {$correo_usuario}");
                
                echo "Enviado";

                foreach ($info['documentos'] as $doc) {
                    $this->db->insert('c_notidicaciones_enviadas', [
                        'id_contrato' => $contrato_id,
                        'id_anexo_contrato' => $doc['id'], // Nota: en tu código original tenías un espacio extra en el nombre de la columna: 'id_anexo_contrato '
                        'fecha_vencimiento' => $doc['fecha_vencimiento'],
                        'fecha_notificacion'=> $fecha,
                    ]);
                }
            } else {
                log_message('error', "Error al enviar correo para el contrato {$contrato_id}: {$responseCorreo}");
                echo $msg = "$responseCorreo";                	
            }
        }
    }
}