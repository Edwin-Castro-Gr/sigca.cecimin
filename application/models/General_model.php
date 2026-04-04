<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General_model extends CI_Model {
    private $encryption_key;

    function __construct() {
        // parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->encryption_key = getenv('ENCRYPTION_KEY') ?: '-Qsc.725943!';
    }

    // ======================
    // Métodos existentes
    // ======================
    
    function select_recuperar($email) {
        $this->db->select('u.usuario, AES_DECRYPT(u.clave, "'.$this->encryption_key.'") AS clave, e.origen');
        $this->db->from('usuarios u');
        $this->db->join('empresas e', 'u.id_empresa = e.id_empresa');
        $this->db->where('u.estado <=', 1);
        $this->db->where('u.email', $email);
        $query = $this->db->get();
        return $query->result();
    }

    function select_verificarEmail($email) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('estado <=', 1);
        $this->db->where('email', $email);
        $query = $this->db->get();
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

    function consulta_personalizada($campos, $tabla, $condicion, $orden, $limite=0, $inicio_limite=0) {
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
        return $query;
    }

    function consulta_personalizada_sinlog($consulta) {
        $query = $this->db->query($consulta);
        if ($this->db->_error_message()) {
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
        $this->db->trans_complete();
        return $query;
    }

    function select_hash($campos, $tabla, $condicion) {
        $query = $this->db->select($campos)->from($tabla)->where($condicion)->get();
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
        $this->db->insert($tabla, $registro);
        return $this->db->insert_id();
    }

    function delete($tabla, $registro) {
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
        $this->db->where($campo, $valor);
        $this->db->update($tabla, $registro);
        $this->db->query('INSERT INTO log (id_usuario, fecha, accion) VALUES ("'.$this->session->userdata('C_id_usuario').'","'.date("Y-m-d H:i:s").'"," UPDATE '.$tabla.' SET '.implode(", ",$registro).' WHERE '.$campo.'='.$valor.' ")');
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

        function get_user_by_username($usuario) {
        $query = $this->db->query("
            SELECT 
                u.id_usuario, 
                u.usuario, 
                AES_DECRYPT(u.clave, '".$this->encryption_key."') AS clave, 
                CONCAT(u.nombre, ' ', u.apellido) AS nombre_usuario, 
                u.nombre AS nom_usuario, 
                u.apellido AS ape_usuario, 
                u.estado, 
                u.id_empleado, 
                u.perfil, 
                u.foto, 
                u.cambio_clave,
                u.email,
                u.two_factor_enabled,
                u.two_factor_secret
            FROM usuarios u 
            WHERE u.usuario = ?
        ", [$usuario]);
        
        return $query->result();
    }
    
    function get_user_by_id($id_usuario) {
        $query = $this->db->query("
            SELECT 
                u.id_usuario, 
                u.usuario, 
                CONCAT(u.nombre, ' ', u.apellido) AS nombre_usuario, 
                u.nombre AS nom_usuario, 
                u.apellido AS ape_usuario, 
                u.estado, 
                u.id_empleado, 
                u.perfil, 
                u.foto, 
                u.email
            FROM usuarios u 
            WHERE u.id_usuario = ?
        ", [$id_usuario]);
        
        return $query->result();
    }
    
    function get_user_email($id_usuario) {
        $query = $this->db->select('email')
                         ->from('usuarios')
                         ->where('id_usuario', $id_usuario)
                         ->get();
        
        if ($query->num_rows() == 1) {
            return $query->row()->email;
        }
        
        return false;
    }
    
    function verify_email($email) {
        $query = $this->db->query("
            SELECT * 
            FROM usuarios 
            WHERE estado <= '1' 
            AND email = ?
        ", [$email]);
        
        return ($query->num_rows() == 1) ? $query->row() : false;
    }
    
    function get_hash_details($hash) {
        $query = $this->db->select('*')
                         ->from('usuarios')
                         ->where('hash_key', $hash)
                         ->get();
        
        return ($query->num_rows() == 1) ? $query->row() : false;
    }
    
    function update_password_by_hash($hash, $password, $encryption_key) {
        $clave_cod = "AES_ENCRYPT('" . $this->db->escape_str($password) . "', '" . $encryption_key . "')";
        $sql_update = "UPDATE usuarios SET clave = " . $clave_cod . ", hash_key = NULL, hash_expiry = NULL WHERE hash_key = ?";
        
        return $this->db->query($sql_update, [$hash]);
    }
    
    function update_user_password($usuario, $password, $encryption_key) {
        $clave_cod = "AES_ENCRYPT('" . $this->db->escape_str($password) . "', '" . $encryption_key . "')";
        $sql_update = "UPDATE usuarios SET clave = " . $clave_cod . ", cambio_clave = '1', politica_proteccion_datos = '1' WHERE usuario = ?";
        
        return $this->db->query($sql_update, [$usuario]);
    }
    
    // NUEVO: Habilitar 2FA para usuario
    function enable_2fa($user_id, $secret = null) {
        $data = [
            'two_factor_enabled' => 1,
            'two_factor_secret' => $secret ?: $this->generate2FASecret(),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_usuario', $user_id);
        return $this->db->update('usuarios', $data);
    }
    
    // NUEVO: Deshabilitar 2FA para usuario
    function disable_2fa($user_id) {
        $data = [
            'two_factor_enabled' => 0,
            'two_factor_secret' => NULL,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_usuario', $user_id);
        return $this->db->update('usuarios', $data);
    }
    
    // NUEVO: Generar secreto para 2FA
    private function generate2FASecret() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < 16; $i++) {
            $secret .= $chars[random_int(0, 31)];
        }
        return $secret;
    }
}
