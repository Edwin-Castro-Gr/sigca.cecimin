<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {
	
	function __construct() {
   	//	parent::__construct();
		date_default_timezone_set('America/Bogota');
	}

    function select_usuario($usuario) {
		$query = $this->db->query('SELECT u.id_usuario, u.usuario, AES_DECRYPT(u.clave, "-Qsc.725943!") AS clave, CONCAT(u.nombre, " ", u.apellido) AS nombre_usuario, u.nombre AS nom_usuario, u.apellido AS ape_usuario, u.estado, u.id_empleado, u.perfil, u.foto, u.cambio_clave
			FROM usuarios u WHERE u.usuario="'.$usuario.'" ');
		return $query->result();
	}
	
	
	function select_recuperar($email) {
		$query = $this->db->query('SELECT u.usuario, AES_DECRYPT(u.clave, "-Qsc.725943!") AS clave, e.origen FROM usuarios u INNER JOIN empresas e ON u.id_empresa = e.id_empresa WHERE u.estado<="1" AND u.email="'.$email.'" ');
		return $query->result();
	}

	function select_verificarEmail($email) {
		$query = $this->db->query('SELECT * FROM usuarios WHERE estado<="1" AND email="'.$email.'" ');
		if($query->num_rows()==1){

			return $query->row();
		}else{

			return false;
		}
		
	}

	function select_verificar($tabla, $condicion) {
		$query = $this->db->query('SELECT * FROM '.$tabla.' WHERE '.$condicion);
		if($query->num_rows()==1){
			return $query->row();
		}else{
			return false;	
		}
		
	}
	
	/*
	function select_usuario($usuario) {
		$query = $this->db->query('SELECT u.id_usuario, u.usuario, AES_DECRYPT(u.clave, "-Qsc.725943!") AS clave, CONCAT(u.nombre, " ", u.apellido) AS nombre_usuario, u.nombre AS nom_usuario, u.estado, u.id_empleado, u.perfil, u.foto 
			FROM usuarios u WHERE u.usuario="'.$usuario.'" ');
		return $query->result();
	}


    function consulta_select_usuarios($consulta) {
		$this->DB2 = $this->load->database('usuarios', TRUE);
		$query = $this->DB2->query($consulta);
		if ($this->DB2->_error_message() ) {
    		return '0_'.$this->DB2->_error_number();
		} else {
			return $query;
		}
	}

	function insert_usuario($tabla, $registro) {
		$this->DB2 = $this->load->database('usuarios', TRUE);
		$this->DB2->insert($tabla, $registro);
		$this->db->trans_start();
		$this->db->insert($tabla, $registro);
		$this->db->query('INSERT INTO log (id_usuario, fecha, accion) VALUES ("'.$this->session->userdata('C_id_usuario').'","'.date("Y-m-d H:i:s").'"," INSERT INTO '.$tabla.' VALUES '.implode(", ",$registro).' ")');
		$this->db->trans_complete();
		if ($this->DB2->_error_message() ) {
    		return $this->DB2->_error_number();
		} else {
			return "OK";
		}
	}

	function update_usuario($tabla, $campo, $valor, $registro) {
		$this->DB2 = $this->load->database('usuarios', TRUE);
		$this->DB2->where($campo, $valor);
		$this->DB2->update($tabla, $registro);
		$this->db->trans_start();
		$this->db->query('INSERT INTO log (id_usuario, fecha, accion) VALUES ("'.$this->session->userdata('C_id_usuario').'","'.date("Y-m-d H:i:s").'"," UPDATE '.$tabla.' SET '.implode(", ",$registro).' WHERE '.$campo.'='.$valor.' ")');
		$this->db->trans_complete();
		if ($this->DB2->_error_message() ) {
    		return $this->DB2->_error_number();
		} else {
			return "OK";
		}
    }*/

	function consulta_personalizada($campos, $tabla, $condicion, $orden, $limite=0, $inicio_limite=0) {
		//$this->db->flush_cache();
		$cadena = 'SELECT '.$campos.' FROM '.$tabla;
				
		if($condicion != "")
			$cadena .= ' WHERE '.$condicion;

		if($orden != "")
			$cadena .= ' ORDER BY '.$orden;
		
		if($limite > 0 && $inicio_limite <= 0)
			$cadena .= ' LIMIT '.$limite;
		elseif($limite > 0 && $inicio_limite > 0)
			$cadena .= ' LIMIT '.$limite.','.$inicio_limite;
		
		$query = $this->db->query($cadena);

    	/*if ($this->db->_error_message() ) {
    		return '0_'.$this->db->_error_number().' -- '.$this->db->_error_message();
		} else {*/
			return $query;
		//}
	}

	function consulta_personalizada_sinlog($consulta) {
		//$this->db->trans_start();
    	$query = $this->db->query($consulta);
		//$this->db->trans_complete();
        if ($this->db->_error_message() ) {
    		return '0_'.$this->db->_error_number().'_'.$this->db->_error_message();
		} else {
			return $query;
		}
	}
	
	function consulta_select($consulta) {
		$this->db->trans_start();
    	$query = $this->db->query($consulta);
		$this->db->trans_complete();
        return $query;
	}

	function select_where($campos, $tabla, $condicion) {
		$this->db->trans_start();
		$query = $this->db->select($campos)->from($tabla)->where($condicion)->get();
		//$query = $this->db->get_where($tabla, $campos_where);
		$this->db->trans_complete();
		return $query;
	}

	function select_hash($campos, $tabla, $condicion) {
		// $this->db->trans_start();
		$query = $this->db->select($campos)->from($tabla)->where($condicion)->get();		
		// $this->db->trans_complete();
		if($query->num_rows()==1){
			return $query->row();
		}else{
			return false;
		}
	}

	function insert($tabla, $registro) {
		$str = $this->db->insert_string($tabla, $registro);
		$regi = array(
			'id_usuario'=>$this->session->userdata('C_id_usuario'),
			'fecha'=>date("Y-m-d H:i:s"),
			'accion'=>$str
		);

		// $this->db->trans_start();		
		// $this->db->insert('log', $regi);
		$this->db->insert($tabla, $registro);
				
		// $this->db->trans_complete();

		return $this->db->insert_id();
	}
	
	function delete($tabla, $registro) {
		$str = 'DELETE FROM '.$tabla.' WHERE '. implode('=',$registro);
		$str = 'DELETE FROM '.$tabla.' WHERE ';
		$regi = array(
			'id_usuario'=>$this->session->userdata('C_id_usuario'),
			'fecha'=>date("Y-m-d H:i:s"),
			'accion'=>$str
		);
		$this->db->trans_start();
		$this->db->insert('log', $regi);
		
		$this->db->delete($tabla, $registro);
		$this->db->trans_complete();
		return "OK";
	}
	
	function update($tabla, $campo, $valor, $registro) {
		//print_r ($registro);
		// $this->db->trans_start();
		$this->db->where($campo, $valor);
		$this->db->update($tabla, $registro);
		//$this->db->query('INSERT INTO log (id_usuario, fecha, accion) VALUES ("'.$this->session->userdata('C_id_usuario').'","'.date("Y-m-d H:i:s").'",' UPDATE "".$tabla."" SET "".implode(', ',$registro)." WHERE ".$campo."=".$valor." ')');
		// $this->db->trans_complete();
		return "OK";
    }

    public function insert_batch($tabla, $registro){
		$this->db->insert_batch($tabla,$registro);
		if($this->db->affected_rows()>0)
		{
			$totalregistro = $this->db->affected_rows();
			return $totalregistro;
		}
		else{
			return 0;
		}
	}
 }