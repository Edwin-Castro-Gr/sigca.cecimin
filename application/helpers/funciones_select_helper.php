<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
 * Helper que carga todoas las tablas segun el tipo (WEB, PDF, EXCEL)
 **/
if ( ! function_exists('select_empleados_tabla'))
{
  function select_empleados_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="empleados_'.$nombre.'" id="empleados_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un empleado</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_empleado AS "Id", CONCAT(nombres, " ", apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados', 'estado = "1"', 'nombres, apellidos', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_auxiliares_tabla'))
{
  function select_auxiliares_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="auxiliares_'.$nombre.'" id="auxiliares_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione una Auxiliar</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_empleado AS "Id", CONCAT(nombres, " ", apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados', 'id_empleado IN(78, 86, 60, 35, 69, 386, 94, 91, 83, 453, 37, 104) AND estado = "1"', 'nombres, apellidos', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_coordinadores_tabla'))
{
  function select_coordinadores_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="coordinador_'.$nombre.'" id="coordinador_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Coordinador</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' e.id_empleado AS "Id", CONCAT(e.nombres, " ", e.apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados e INNER JOIN cargos c ON e.id_cargo = c.id_cargo', ' e.estado = "1" AND c.nombre like "%COORDINA%" OR c.nombre like "DIRECTOR%" OR c.nombre like "GERENTE%"', 'nombres, apellidos', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_ayudantes_tabla'))
{
  function select_ayudantes_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="ayudantes_'.$nombre.'" id="ayudantes_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Ayudante</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = 'e.id_empleado AS "Id", CONCAT(e.nombres, " ", e.apellidos) AS "Nombre"';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados e INNER JOIN cargos c ON e.id_cargo=c.id_cargo', 'e.estado = "1" AND c.nombre LIKE "CIRUJANO%" OR c.nombre LIKE "%ORTOPEDI%" OR c.nombre LIKE "OTORRINO%" OR c.nombre LIKE "%DERMATOLOG%" OR c.nombre LIKE "%UROLOG%" OR c.nombre LIKE "%UROLOG%"  OR c.nombre LIKE "%HEMATO%"', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_cirujanos_tabla'))
{
  function select_cirujanos_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="cirujano_'.$nombre.'" id="cirujano_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Cirujano</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = 'e.id_empleado AS "Id", CONCAT(e.nombres, " ", e.apellidos) AS "Nombre"';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados e INNER JOIN cargos c ON e.id_cargo=c.id_cargo', 'e.estado = "1" AND c.nombre LIKE "CIRUJANO%" OR c.nombre LIKE "%ORTOPEDI%" OR c.nombre LIKE "OTORRINO%" OR c.nombre LIKE "%DERMATOLOG%" OR c.nombre LIKE "%UROLOG%" OR c.nombre LIKE "%UROLOG%"  OR c.nombre LIKE "%HEMATO%"', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_anestesiologo_tabla'))
{
  function select_anestesiologo_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="anestesiologo_'.$nombre.'" id="anestesiologo_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un anestesiologo</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = 'e.id_empleado AS "Id", CONCAT(e.nombres, " ", e.apellidos) AS "Nombre"';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados e INNER JOIN cargos c ON e.id_cargo=c.id_cargo', 'e.estado = "1" AND c.nombre LIKE "%ANESTES%"', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}


if ( ! function_exists('select_empleadosM_tabla'))
{
  function select_empleadosM_tabla($nombre, $seleccion, $class) 
  {
    $valseleccion = explode(',',$seleccion);
    $tabla = '<select name="empleadosM_'.$nombre.'[]" id="empleadosM_'.$nombre.'" class="'.$class.'">';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_empleado AS "Id", CONCAT(nombres, " ", apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados', ' estado = "1" ', 'nombres, apellidos', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])      
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_empleadosMR_tabla'))
{
  function select_empleadosMR_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="empleadosMR_'.$nombre.'[]" id="empleadosMR_'.$nombre.'" class="'.$class.'">';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_empleado AS "Id", CONCAT(nombres, " ", apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados', ' estado = "1" ', 'nombres, apellidos', 0, 0);
    
    $selectArray = explode(",", $seleccion);
    foreach ($query->result_array() as $row)
    {
      if(is_array($selectArray)){
        foreach ($selectArray as $value) {
         
          if($value === $row['Id']){
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          }else{
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
          }   

        }      
      }else{
        foreach ((array)$seleccion as $value) {
         
          if($value === $row['Id']){
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          }else{
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
          }   

        }
      }
    }   
    $tabla .= '</select>';
    return $tabla;    
  }
}

if ( ! function_exists('select_concepto_tabla'))
{
  function select_concepto_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="concepto_'.$nombre.'[]" id="concepto_'.$nombre.'" class="'.$class.'">';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_concepto AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'conceptos_contratost', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}
      
if ( ! function_exists('select_centroscostos_tabla'))
{
  function select_centroscostos_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="centroscostos_'.$nombre.'" id="centroscostos_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Centro de Costos</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_centrocosto AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'centroscostos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

      
if ( ! function_exists('select_lineacostos_tabla'))
{
  function select_lineacostos_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="lineacostos_'.$nombre.'" id="lineacostos_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione una Linea de Costos</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_linea_costos AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'linea_costos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

if ( ! function_exists('select_lineacostosM_tabla'))
{
  function select_lineacostosM_tabla($nombre, $seleccion, $class) 
  {
    $valseleccion = explode(',',$seleccion);
    $tabla = '<select name="lineacostos_'.$nombre.'[]" id="lineacostos_'.$nombre.'" class="'.$class.'"> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_linea_costos AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'linea_costos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])      
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }        
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 



if ( ! function_exists('select_areas_tabla'))
{
  function select_areas_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="areas_'.$nombre.'" id="areas_'.$nombre.'" class="form-control"><option value="" selected>Seleccione un Departamento</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_area AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'areas', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_departamentosM_tabla'))
{
  function select_departamentosM_tabla($nombre, $seleccion,$class) 
  {
    $valseleccion = explode(',',$seleccion);
    $tabla = '<select name="departamentosM_'.$nombre.'[]" id="departamentosM_'.$nombre.'" class="'.$class.'">';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_area AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'areas', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_macroprocesos_tabla'))
{
  function select_macroprocesos_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="macroprocesos_'.$nombre.'" id="macroprocesos_'.$nombre.'" class="form-control"><option value="" selected>Seleccione un Macroproceso</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_macroproceso AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'macroprocesos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

if ( ! function_exists('select_procesos_tabla'))
{
  function select_procesos_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="procesos_'.$nombre.'" id="procesos_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Proceso</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_proceso AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'procesos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_tipodocumentos_tabla'))
{
  function select_tipodocumentos_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="tipodocumentos_'.$nombre.'" id="tipodocumentos_'.$nombre.'" class="select2 form-control"><option disabled selected>Seleccione un Tipo de Documento</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_tipo AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'tipos_documentos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

if ( ! function_exists('select_documentosC_tabla'))
{
  function select_documentosC_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="documentosC_'.$nombre.'" id="documentosC_'.$nombre.'" class="select2 form-control"><option disabled selected>Seleccione un Tipo de Documento</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_listado AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'listado_documentos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

if ( ! function_exists('select_departamentos_tabla'))
{
  function select_departamentos_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="departamentos_'.$nombre.'" id="departamentos_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione Departamento</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_departamento AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'departamentos', '', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    return $tabla;
  }
}

if ( ! function_exists('select_municipios_tabla'))
{
  function select_municipios_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="municipios_'.$nombre.'" id="municipios_'.$nombre.'" class="form-control"><option value="" selected>Seleccione Lugar de Nacimiento</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_municipio AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'municipios', '', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}


if ( ! function_exists('select_Tipo_docidentidad_tabla'))
{
  function select_Tipo_docidentidad_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="Tipo_docidentidad_'.$nombre.'" id="Tipo_docidentidad_'.$nombre.'" class="form-control"><option value="" selected>Seleccione Tipo de Identificación</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' Id_tipdocIdentidad AS "Id", cod_tipodocumento AS "Codigo", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'tipo_docidentidad', '', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}


if ( ! function_exists('select_niveles_educacion_tabla'))
{
  function select_niveles_educacion_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="niveles_educacion_'.$nombre.'" id="niveles_educacion_'.$nombre.'" class="form-control"><option value="" selected>Seleccione El Nivel de Educación</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' Id_niveleducacion AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'niveles_educacion', '', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_estados_civiles_tabla'))
{
  function select_estados_civiles_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="estados_civiles_'.$nombre.'" id="estados_civiles_'.$nombre.'" class="form-control"><option value="" selected>Seleccione el Estado Civil</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' Id_estadocivil AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'estados_civiles', '', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_empresas_salud_tabla'))
{
  function select_empresas_salud_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="empresas_salud_'.$nombre.'" id="empresas_salud_'.$nombre.'" class="form-control"><option value="" selected>Seleccione una empresa</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' Id_empresasalud AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empresas_salud', 'tipo="SALUD"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_empresas_pension_tabla'))
{
  function select_empresas_pension_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="empresas_pension_'.$nombre.'" id="empresas_pension_'.$nombre.'" class="form-control"><option value="" selected>Seleccione una empresa</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' Id_empresasalud AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empresas_salud', 'tipo="PENSION"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_empresas_cesantias_tabla'))
{
  function select_empresas_cesantias_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="empresas_cesantias_'.$nombre.'" id="empresas_cesantias_'.$nombre.'" class="form-control"><option value="" selected>Seleccione una empresa</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' Id_empresasalud AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empresas_salud', 'tipo="CESANTIAS"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_empresas_cajas_tabla'))
{
  function select_empresas_cajas_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="empresas_cajas_'.$nombre.'" id="empresas_cajas_'.$nombre.'" class="form-control"><option value="" selected>Seleccione una empresa</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' Id_empresasalud AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empresas_salud', 'tipo="CAJA"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_grupos_sanguineos_tabla'))
{
  function select_grupos_sanguineos_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="grupos_sanguineos_'.$nombre.'" id="grupos_sanguineos_'.$nombre.'"class="form-control"><option value="" selected>Seleccione el Grupo Sanguineo</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' id_gruposanguineo AS "Id", tipo AS "Tipo", rh AS "RH" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'grupos_sanguineos', '', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Tipo'].''.$row['RH'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Tipo'].''.$row['RH'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_bancos_tabla'))
{
  function select_bancos_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="bancos_'.$nombre.'" id="bancos_'.$nombre.'"class="form-control"><option value="" selected>Seleccione el Banco</option> ';
    
    $CI =& get_instance();  
    $CI->load->model('general_model');

    $campos = ' id_banco AS "Id", cod_banco AS "Codigo", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'bancos', '', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_cargos_tabla'))
{
  function select_cargos_tabla($nombre, $seleccion,$class) 
  {
    $tabla = '<select name="cargos_'.$nombre.'" id="cargos_'.$nombre.'" class="'.$class.'">';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_cargo AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'cargos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_cargosM_tabla'))
{
  function select_cargosM_tabla($nombre, $seleccion,$class) 
  {
    $valseleccion = explode(',',$seleccion);

    $tabla = '<select name="cargosM_'.$nombre.'[]" id="cargosM_'.$nombre.'" class="'.$class.'">';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_cargo AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'cargos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';          
        }
      }else{
        if($seleccion == $row['Id'])
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';          
      }
    }
      
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_documentos_tabla'))
{
  function select_documentos_tabla($nombre, $seleccion,$class) 
  {
    $tabla = '<select name="documentos_'.$nombre.'" id="documentos_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Documento</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_documento AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_documentosM_tabla'))
{
  function select_documentosM_tabla($nombre, $filtro, $seleccion,$class) 
  {
    $tabla = '<select name="documentosM_'.$nombre.'[]" id="documentosM_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Documento</option> ';
    $valseleccion = explode(',',$seleccion);
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_documento AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos', ' estado = "1" AND id_subproceso="'.$filtro.'"', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)    
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])      
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_documentosM_tabla'))
{
  function select_documentosM_tabla($nombre, $seleccion,$class) 
  {
    $tabla = '<select name="documentosM_'.$nombre.'[]" id="documentosM_'.$nombre.'" class="'.$class.'">';
    $valseleccion = explode(',',$seleccion);

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_documento AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])      
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}
if ( ! function_exists('select_subprocesos_tabla'))
{
  function select_subprocesos_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="subprocesos_'.$nombre.'" id="subprocesos_'.$nombre.'" class="select2 form-control"><option value="" selected>Seleccione un Subproceso</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_subproceso AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'subprocesos', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_tiposcontratos_tabla'))
{
  function select_tiposcontratos_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="tiposcontratos_'.$nombre.'" id="tiposcontratos_'.$nombre.'" class="form-control"><option value="" selected>Seleccione un Tipo de Contrato</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_tipocontrato AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'tipos_contrato', ' estado = "1" ', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_terceros_tabla'))
{
  function select_terceros_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="terceros_'.$nombre.'" id="terceros_'.$nombre.'" class="form-control"><option value="" selected>Seleccione un Tercero</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_tercero AS "Id", razon_social AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'terceros', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_tercerosM_tabla'))
{
  function select_tercerosM_tabla($nombre, $seleccion,$class) 
  {
    $tabla = '<select name="tercerosM_'.$nombre.'[]" id="tercerosM_'.$nombre.'" class="'.$class.'">';
    $valseleccion = explode(',',$seleccion);

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_tercero AS "Id", razon_social AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'terceros', 'materialesqx="1" AND estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])      
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_proveedoresQx_tabla'))
{
  function select_proveedoresQx_tabla($nombre, $seleccion,$class) 
  {
    $tabla = '<select name="proveedoresQx_'.$nombre.'" id="proveedoresQx_'.$nombre.'" class="'.$class.'"> <option value="" selected>Seleccione una Casa Comercial </option> ';
    $valseleccion = explode(',',$seleccion);

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_tercero AS "Id", razon_social AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'terceros', 'materialesqx="1" AND estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if(is_array($valseleccion)){
        foreach ($valseleccion as $value) {
          if($value == $row['Id'])      
            $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
          else
            $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
        }
      }else{
        if($seleccion == $row['Id'])
          $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
        else
          $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
      }
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_procedimientoscx_tabla'))
{
  function select_procedimientoscx_tabla($nombre, $seleccion) 
  {
    $tabla = '<select name="procedimientoscx_'.$nombre.'" id="procedimientoscx_'.$nombre.'" class="form-control"><option value="" selected>Seleccione un Procedimiento Cx</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_procedimiento AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'procedimientos_cx', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_procedimientos_tabla'))
{
  function select_procedimientos_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="procedimientos_'.$nombre.'" id="procedimientos_'.$nombre.'" class="'.$class.'"> <option value="" selected>Seleccione un Procedimiento Cx</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_procedimiento AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'procedimientos_cx', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

      
if ( ! function_exists('select_materiales_tabla'))
{
  function select_materiales_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="materiales_'.$nombre.'" id="materiales_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Material</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_material AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'materiales_cx', ' estado = "1" ', 'nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

      
if ( ! function_exists('select_pacientes_tabla'))
{
  function select_pacientes_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="pacientes_'.$nombre.'" id="pacientes_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Paciente</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_paciente AS "Id", CONCAT(nombres, " ", apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'pacientes', ' estado = "1" ', 'nombres', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

      
if ( ! function_exists('select_eps_tabla'))
{
  function select_eps_tabla($nombre, $seleccion, $class) 
  {
    $tabla = '<select name="eps_'.$nombre.'" id="eps_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Entidad Salud</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_eps AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'eps', '', 'Nombre', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
} 

if ( ! function_exists('select_arl_tabla'))
{
  function select_arl_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="arl_'.$nombre.'" id="arl_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione una ARL</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_arl AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'arl', ' estado = "1" ', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_solicitudesd_tabla'))
{
  function select_solicitudesd_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="solicitudesd_'.$nombre.'" id="solicitudesd_'.$nombre.'" class="'.$class.'"><option value="0099" selected>Seleccione una solicitud</option><option value="00">No Aplica</option>';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_solicitud AS "Id", nombre_documento AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'solicitud_documentos', ' estado = "4" ', 'id_solicitud', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Id'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_grupos_tabla'))
{
  function select_grupos_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="grupos_'.$nombre.'" id="grupos_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione una Opción</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_grupo AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'materiales_grupos', 'estado = "1"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_rondas_tabla'))
{
  function select_rondas_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="rondas_'.$nombre.'" id="rondas_'.$nombre.'" class="'.$class.'"><option value="00" selected>Seleccione una Opción</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_ronda AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'rondas', 'estado = "1"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}


if ( ! function_exists('select_secciones_tabla'))
{
  function select_secciones_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="secciones_'.$nombre.'" id="secciones_'.$nombre.'" class="'.$class.'"><option value="00" selected>Seleccione una Opción</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_seccion AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'rondas_seccion', 'estado = "1"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_servicios_tabla'))
{
  function select_servicios_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="servicios_'.$nombre.'" id="servicios_'.$nombre.'" class="'.$class.'"><option value="00" selected>Seleccione una Opción</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_servicio AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'servicios', 'estado = "1"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}


if ( ! function_exists('select_examenes_tabla'))
{
  function select_examenes_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="examenes_'.$nombre.'" id="examenes_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione una Opción</option> ';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_examen AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'resultados_dx_examenes', 'estado = "1"', '', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}


if ( ! function_exists('select_serviciomto_tabla'))
{
  function select_serviciomto_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="serviciomto_'.$nombre.'" id="serviciomto_'.$nombre.'" class="'.$class.'"><option value="" selected>Seleccione un Requerimiento</option>';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' id_servicio AS "Id", nombre AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'mantenimientos_servicios', ' estado = "1" ', 'id_servicio', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}

if ( ! function_exists('select_ingresosp_tabla'))
{
  function select_ingresosp_tabla($nombre, $seleccion, $class) 
  {
    
    $tabla = '<select name="ingresosp_'.$nombre.'" id="ingresosp_'.$nombre.'" class="'.$class.'"><option value="9999" selected>Seleccione una Opción</option><option value="00">NO APLICA</option>';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' ip.id_ingreso as "Id", CONCAT(e.nombres, " ", e.apellidos) AS "Nombre" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'ingreso_personal ip INNER JOIN empleados e ON ip.id_empleado = e.id_empleado', 'ip.estado ="2"', 'ip.id_ingreso', 0, 0);
    
    foreach ($query->result_array() as $row)
    {
      if($seleccion == $row['Id'])
        $tabla .= '<option value="'.$row['Id'].'" selected>'.$row['Nombre'].'</option>';
      else
        $tabla .= '<option value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
    }
    $tabla .= '</select>';
    
    return $tabla;
  }
}
