<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    private $cron_key = '4dm1nC3c1m1n2025'; // Cambia esto por una clave segura

    public function notificar_vencimientos($key = '') {
        // Verificar la clave
        if ($key != $this->cron_key) {
            log_message('error', 'Intento de acceso no autorizado al cron');
            show_error('Acceso no autorizado', 403);
            return;
        }


        // Deshabilitar límite de tiempo de ejecución
        set_time_limit(0);

        // Cargar el modelo que contiene la lógica
        $this->load->model('Notificaciones_model');
     	$this->Notificaciones_model->notificar_vencimientos();
		echo "Proceso de notificación completado: " . date('Y-m-d H:i:s');
		log_message('info', 'Cron job ejecutado: notificar_vencimientos');
			
         
    }     
}