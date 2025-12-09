<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
 * Helper que carga todoas las tablas segun el tipo (WEB, PDF, EXCEL)
 **/
if ( ! function_exists('listar_areas_chk')){
  function listar_areas_chk($opcion, $id_reg, $tabla_ver) {
    
    $tabla = '';
   
    $CI =& get_instance();
    $CI->load->model('general_model');
    
    if($opcion == 'nue') {
      $campos = ' id_area AS "chk", nombre AS "Nombre", "" AS "marcado" ';
      $query = $CI->general_model->consulta_personalizada($campos, 'areas', 'estado = 1', 'nombre', 0, 0);
    } else {
      $campo_con = '';
      $campo_con_or = '';
      $tabla_con = '';
      
      switch($tabla_ver){
        case 'documento':
            $campo_con = ', b.id_documento AS "marcado" '; 
            $campo_con_or = 'b.id_documento DESC, a.nombre '; 
            $tabla_con = 'areas a LEFT JOIN documentos_areas b ON (a.id_area = b.id_area AND b.id_documento = "'.$id_reg.'" )';
            break;

      }

      $campos = ' a.id_area AS "chk", a.nombre AS "Nombre"'.$campo_con;
      $query = $CI->general_model->consulta_personalizada($campos, $tabla_con, 'a.estado = 1', $campo_con_or,0,0);
    }
   
    $tabla = '<div class="list-group">';
    $i = -1;
    foreach ($query->result_array() as $row)
    {
      $i++;
      
      if($opcion == 'nue') {
        $check = '';
        $disable = '';
      } else {
        if($row['marcado'] == $id_reg){
          $check = ' checked ';
          $disable = ' disabled ';
        } else {
          $check = '';
          $disable = '';
        }
      }

      $tabla .= '<a href="javascript:void(0)" class="list-group-item '.$disable.'" id="a_area_'.$i.'">
          <input type="checkbox" value="'.$row['chk'].'" name="chk_area_'.$i.'" id="chk_area_'.$i.'" '.$check.' '.$disable.'>
          <label id="lbl_area_'.$i.'" for="chk_area_'.$i.'">'.$row['Nombre'].'</label>
        </a>';
    }
    $tabla .= '</div><input type="hidden" name="cant_chk_area" id="cant_chk_area" value="'.$i.'" />';

    return $tabla;
  }
}

if ( ! function_exists('listar_cargos_chk')){
  function listar_cargos_chk($opcion, $id_reg, $tabla_ver) {
    
    $tabla = '';
   
    $CI =& get_instance();
    $CI->load->model('general_model');
    
    if($opcion == 'nue') {
      $campos = ' id_cargo AS "chk", nombre AS "Nombre", "" AS "marcado" ';
      $query = $CI->general_model->consulta_personalizada($campos, 'cargos', 'estado = 1', 'nombre', 0, 0);
    } else {
      $campo_con = '';
      $campo_con_or = '';
      $tabla_con = '';
      
      switch($tabla_ver){
        case 'documento':
            $campo_con = ', b.id_documento AS "marcado" '; 
            $campo_con_or = 'b.id_documento DESC, a.nombre '; 
            $tabla_con = 'cargos a LEFT JOIN documentos_cargos b ON (a.id_cargo = b.id_cargo AND b.id_documento = "'.$id_reg.'" )';
            break;

      }

      $campos = ' a.id_cargo AS "chk", a.nombre AS "Nombre"'.$campo_con;
      $query = $CI->general_model->consulta_personalizada($campos, $tabla_con, 'a.estado = 1', $campo_con_or,0,0);
    }
   
    $tabla = '<div class="list-group">';
    $i = -1;
    foreach ($query->result_array() as $row)
    {
      $i++;
      
      if($opcion == 'nue') {
        $check = '';
        $disable = '';
      } else {
        if($row['marcado'] == $id_reg){
          $check = ' checked ';
          $disable = ' disabled ';
        } else {
          $check = '';
          $disable = '';
        }
      }

      $tabla .= '<a href="javascript:void(0)" class="list-group-item '.$disable.'" id="a_cargo_'.$i.'">
          <input type="checkbox" value="'.$row['chk'].'" name="chk_cargo_'.$i.'" id="chk_cargo_'.$i.'" '.$check.' '.$disable.'>
          <label id="lbl_cargo_'.$i.'" for="chk_cargo_'.$i.'">'.$row['Nombre'].'</label>
        </a>';
    }
    $tabla .= '</div><input type="hidden" name="cant_chk_cargo" id="cant_chk_cargo" value="'.$i.'" />';

    return $tabla;
  }
}

if ( ! function_exists('listar_procesos_chk')){
  function listar_procesos_chk($opcion, $id_reg, $tabla_ver) {
    
    $tabla = '';
   
    $CI =& get_instance();
    $CI->load->model('general_model');
    
    if($opcion == 'nue') {
      $campos = ' id_proceso AS "chk", nombre AS "Nombre", "" AS "marcado" ';
      $query = $CI->general_model->consulta_personalizada($campos, 'procesos', 'estado = 1', 'nombre', 0, 0);
    } else {
      $campo_con = '';
      $campo_con_or = '';
      $tabla_con = '';
      
      switch($tabla_ver){
        case 'cargo':
            $campo_con = ', b.id_cargo AS "marcado" '; 
            $campo_con_or = 'b.id_cargo DESC, a.nombre '; 
            $tabla_con = 'procesos a LEFT JOIN cargos_procesos b ON (a.id_proceso = b.id_proceso AND b.id_cargo = "'.$id_reg.'" )';
            break;
        case 'documento':
            $campo_con = ', b.id_documento AS "marcado" '; 
            $campo_con_or = 'b.id_documento DESC, a.nombre '; 
            $tabla_con = 'procesos a LEFT JOIN documentos_procesos b ON (a.id_proceso = b.id_proceso AND b.id_documento = "'.$id_reg.'" )';
            break;

      }

      $campos = ' a.id_proceso AS "chk", a.nombre AS "Nombre"'.$campo_con;
      $query = $CI->general_model->consulta_personalizada($campos, $tabla_con, 'a.estado = 1', $campo_con_or,0,0);
    }
   
    $tabla = '<div class="list-group">';
    $i = -1;
    foreach ($query->result_array() as $row)
    {
      $i++;
      
      if($opcion == 'nue') {
        $check = '';
        $disable = '';
      } else {
        if($row['marcado'] == $id_reg){
          $check = ' checked ';
          $disable = ' disabled ';
        } else {
          $check = '';
          $disable = '';
        }
      }

      $tabla .= '<a href="javascript:void(0)" class="list-group-item '.$disable.'" id="a_proceso_'.$i.'">
          <input type="checkbox" value="'.$row['chk'].'" name="chk_proceso_'.$i.'" id="chk_proceso_'.$i.'" '.$check.' '.$disable.'>
          <label id="lbl_proceso_'.$i.'" for="chk_proceso_'.$i.'">'.$row['Nombre'].'</label>
        </a>';
    }
    $tabla .= '</div><input type="hidden" name="cant_chk_proceso" id="cant_chk_proceso" value="'.$i.'" />';

    return $tabla;
  }
}

if ( ! function_exists('listar_empleados_chk')){
  function listar_empleados_chk($opcion, $id_reg, $tabla_ver) {
    
    $tabla = '';
   
    $CI =& get_instance();
    $CI->load->model('general_model');
    
    if($opcion == 'nue') {
      $campos = ' id_empleado AS "chk", CONCAT(nombres," ",apellidos) AS "Nombre", "" AS "marcado" ';
      $query = $CI->general_model->consulta_personalizada($campos, 'empleados', 'estado = 1', 'nombres,apellidos', 0, 0);
    } else {
      $campo_con = '';
      $campo_con_or = '';
      $tabla_con = '';
      
      switch($tabla_ver){
        case 'cargo':
            $campo_con = ', b.id_cargo AS "marcado" '; 
            $campo_con_or = 'b.id_cargo DESC, a.nombres,a.apellidos '; 
            $tabla_con = 'empleados a LEFT JOIN cargos_empleados b ON (a.id_empleado = b.id_empleado AND b.id_cargo = "'.$id_reg.'" )';
            break;

        case 'documento':
            $campo_con = ', b.id_documento AS "marcado" '; 
            $campo_con_or = 'b.id_documento DESC, a.nombres,a.apellidos '; 
            $tabla_con = 'empleados a LEFT JOIN documentos_empleados b ON (a.id_empleado = b.id_empleado AND b.id_documento = "'.$id_reg.'" )';
            break;
      }

      $campos = ' a.id_empleado AS "chk", CONCAT(a.nombres," ",a.apellidos) AS "Nombre"'.$campo_con;
      $query = $CI->general_model->consulta_personalizada($campos, $tabla_con, 'a.estado = 1', $campo_con_or,0,0);
    }
   
    $tabla = '<div class="list-group">';
    $i = -1;
    foreach ($query->result_array() as $row)
    {
      $i++;
      
      if($opcion == 'nue') {
        $check = '';
        $disable = '';
      } else {
        if($row['marcado'] == $id_reg){
          $check = ' checked ';
          $disable = ' disabled ';
        } else {
          $check = '';
          $disable = '';
        }
      }

      $tabla .= '<a href="javascript:void(0)" class="list-group-item '.$disable.'" id="a_empleado_'.$i.'">
          <input type="checkbox" value="'.$row['chk'].'" name="chk_empleado_'.$i.'" id="chk_empleado_'.$i.'" '.$check.' '.$disable.'>
          <label id="lbl_empleado_'.$i.'" for="chk_empleado_'.$i.'">'.$row['Nombre'].'</label>
        </a>';
    }
    $tabla .= '</div><input type="hidden" name="cant_chk_empleado" id="cant_chk_empleado" value="'.$i.'" />';

    return $tabla;
  }
}

if ( ! function_exists('listar_materialesqx_chk')){
  function listar_materialesqx_chk($opcion, $id_pro, $id_reg, $tabla_ver) {
    
    $tabla = '';
   
    $CI =& get_instance();
    $CI->load->model('general_model');
    
    if($opcion == 'nue') {
      $campos = ' m.id_material AS "chk", m.nombre_material AS "marcado" ';
      $query = $CI->general_model->consulta_personalizada($campos, 'materiales_qx m INNER JOIN procedimientos_cx cx ON m.id_procedimiento=cx.id_procedimiento', 'estado = 1 AND m.id_procedimiento="'.$id_pro.'"', 'nombre_material', 0, 0);
    } else {
      $campo_con = '';
      $campo_con_or = '';
      $tabla_con = '';
      
      switch($tabla_ver){
        case 'materiales':
            $campo_con = ', b.id_material AS "marcado" '; 
            $campo_con_or = 'b.id_material DESC, a.nombre_material '; 
            $tabla_con = 'materiales_qx m LEFT JOIN programacion_materiales b ON (m.id_material = b.id_material AND b.id_material = "'.$id_reg.'" )';
            break;

      }

      $campos = '  m.id_material AS "chk", m.nombre_material AS "marcado"'.$campo_con;
      $query = $CI->general_model->consulta_personalizada($campos, $tabla_con, 'a.estado = 1', $campo_con_or,0,0);
    }
   
    $tabla = '<div class="list-group">';
    $i = -1;
    foreach ($query->result_array() as $row)
    {
      $i++;
      
      if($opcion == 'nue') {
        $check = '';
        $disable = '';
      } else {
        if($row['marcado'] == $id_reg){
          $check = ' checked ';
          $disable = ' disabled ';
        } else {
          $check = '';
          $disable = '';
        }
      }

      $tabla .= '<a href="javascript:void(0)" class="list-group-item '.$disable.'" id="a_materiales_'.$i.'">
          <input type="checkbox" value="'.$row['chk'].'" name="chk_materiales_'.$i.'" id="chk_materiales_'.$i.'" '.$check.' '.$disable.'>
          <label id="lbl_materiales_'.$i.'" for="chk_materiales_'.$i.'">'.$row['Nombre'].'</label>
        </a>';
    }
    $tabla .= '</div><input type="hidden" name="cant_chk_materiales" id="cant_chk_materiales" value="'.$i.'" />';

    return $tabla;
  }
}