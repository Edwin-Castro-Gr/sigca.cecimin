<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
 * Helper que carga todoas las tablas segun el tipo (WEB, PDF, EXCEL)
 **/
if ( ! function_exists('listar_areas_tabla')) {
  function listar_areas_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  aa.id_area AS "Id", aa.codigo AS "Codigo", aa.nombre AS "Nombre", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'areas aa', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Codigo'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_centros_tabla')) {
  function listar_centros_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..",  t.id_centrocosto AS "Id", t.codigo AS "Codigo", t.nombre AS "Nombre", lc.nombre AS "Linea de Costo",CASE WHEN t.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'centroscostos t LEFT JOIN linea_costos lc ON t.id_linea_costos = lc.id_linea_costos ', '', '', 0, 0);
    
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

    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Codigo'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Linea de Costo'].'</td> <td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_procesos_tabla')) {
  function listar_procesos_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos =' "..",  p.id_proceso AS "Id", p.nombre AS "Nombre", p.prefijo AS "Prefijo", p.objetivo AS "Objetivo", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'procesos p ', '', 'p.nombre', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Prefijo'].'</td><td>'.$row['Objetivo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_cargos_tabla')) {
  function listar_cargos_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",c.id_cargo AS "Id", c.nombre AS "Nombre", c.titulo AS "Titulo", c.naturaleza AS "Naturaleza", CASE WHEN c.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'cargos c', '', 'c.nombre', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Titulo'].'</td><td>'.$row['Naturaleza'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('listar_empleados_tabla')) {
  function listar_empleados_tabla($tipo) {

    $tabla = '';

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..", e.id_empleado AS "Id",e.cedula AS "Cedula", IFNULL(CONCAT(e.nombres, " ", e.apellidos), " ") AS "Nombre",  e.email AS "Email", c.nombre AS "Cargo", CASE WHEN e.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados e LEFT JOIN cargos c ON e.id_cargo = c.id_cargo', '', 'e.id_empleado', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';

    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Cedula'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Email'].'</td><td>'.$row['Cargo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_empleadosex_tabla')) {
  function listar_empleadosex_tabla($tipo) {

    $tabla = '';

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..", e.id_empleado AS "Id",e.cedula AS "Cedula", IFNULL(CONCAT(e.nombres, " ", e.apellidos), " ") AS "Nombre",  e.fecha_nacimiento AS "Fecha de Nacimiento", e.direccion AS "Dirección", e.telefono AS "Telefono", e.email AS "Email", c.nombre AS "Cargo", ip.nombre AS "EPS", ar.nombre AS "ARL", e.grupo_sanguineo AS "Grupo sanguineo", e.nivel_riesgo AS "Nivel Riesgo",  IFNULL(u.usuario," ")AS "Usuario", CASE WHEN e.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'empleados e LEFT JOIN cargos c ON e.id_cargo = c.id_cargo LEFT JOIN eps ip ON e.id_eps = ip.id_eps LEFT JOIN arl ar ON e.arl = ar.id_arl LEFT JOIN usuarios u ON e.id_empleado = u.id_usuario' , '', 'e.id_empleado', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';

    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Cedula'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Fecha de Nacimiento'].'</td><td>'.$row['Dirección'].'</td><td>'.$row['Telefono'].'</td><td>'.$row['Email'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['EPS'].'</td><td>'.$row['ARL'].'</td><td>'.$row['Grupo sanguineo'].'</td><td>'.$row['Nivel Riesgo'].'</td><td>' . $row['Usuario'] . '</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_documentos_tabla')) {
  function listar_documentos_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",d.id_documento AS "Id", d.nombre AS "Nombre", t.nombre AS "Tipo", p.nombre AS "Proceso", d.codigo AS "Código", CONCAT(v.ruta,v.archivo) AS "Ver", CONCAT(v.version," del ",v.fecha) AS "Versión", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos d LEFT JOIN tipos_documentos t ON d.id_tipo = t.id_tipo  LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"', 'd.estado="1"', 'd.id_documento', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tipo'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Código'].'</td><td>'.anchor(base_url().$row['Ver'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$row['Versión'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

        if($row['Estado'] == "Activo") {
          $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Socializar" aria-describedby="tooltip'.$row['Id'].'" id="btnsocializar_'.$row['Id'].'"> <i  id="btnsocializar_'.$row['Id'].'" class="fa fa-file-signature text-105"></i> </a> 
          </div></td>'; 
        } else {
          $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-pencil-alt text-105"> </i> </a> 
          <a href="#" class="text-dark-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar"> <i class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" > <i class="fa fa-search-plus text-105"></i> </a> 
          </div></td>'; 
        }
          
      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


// if ( ! function_exists('listar_actasReportes_tabla')) {
//   function listar_actasReportes_tabla($tipo) {
    
//     $tabla = '';
    
//     $CI =& get_instance();
//     $CI->load->model('general_model');

//     $campos ='"..",d.id_documento AS "Id", d.nombre AS "Nombre", t.nombre AS "Tipo", p.nombre AS "Proceso", d.codigo AS "Código", CONCAT(v.ruta,v.archivo) AS "Ver", CONCAT(v.version," del ",v.fecha) AS "Versión", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
//     if($tipo == 'WEB')
//       $campos .= ', "" AS "Acción" ';
    
//     $query = $CI->general_model->consulta_personalizada($campos, 'documentos d LEFT JOIN tipos_documentos t ON d.id_tipo = t.id_tipo  LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"', 'd.estado="1"', 'd.id_documento', 0, 0);
    
//     $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
//     foreach ($query->list_fields() as $campo)
//     {
//       if($campo != ".." && $campo != "Acción")
//         $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
//       else
//         $tabla .= '<th>'.($campo).'</th>';
//     }
//       $tabla .= '</tr></thead><tbody class="pos-rel">';

//     foreach ($query->result_array() as $row)
//     {
//       if($row['Estado'] == "Activo")
//         $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
//       else
//         $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

//       $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tipo'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Código'].'</td><td>'.anchor(base_url().$row['Ver'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$row['Versión'].'</td><td>'.$estado.'</td>';

//       if($tipo == 'WEB')
//         $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

//         if($row['Estado'] == "Activo") {
//           $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

//           <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

//           <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Socializar" aria-describedby="tooltip'.$row['Id'].'" id="btnsocializar_'.$row['Id'].'"> <i  id="btnsocializar_'.$row['Id'].'" class="fa fa-file-signature text-105"></i> </a> 
//           </div></td>'; 
//         } else {
//           $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-pencil-alt text-105"> </i> </a> 
//           <a href="#" class="text-dark-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar"> <i class="fa fa-trash-alt text-105"></i> </a>

//           <a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" > <i class="fa fa-search-plus text-105"></i> </a> 
//           </div></td>'; 
//         }
          
//       $tabla .= '</tr>';        
//     }
//     $tabla .= '</tbody>';   
    
//     return $tabla;
//   }
// }


if ( ! function_exists('listar_documentosv_tabla')) {
  function listar_documentosv_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='d.id_documento AS "Id", d.nombre AS "Nombre", t.nombre AS "Tipo", p.nombre AS "Proceso", d.codigo AS "Código", v.archivo AS "<i class=ti-files></i>", CONCAT(v.version," del ",v.fecha) AS "Versión" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos d INNER JOIN tipos_documentos t ON d.id_tipo = t.id_tipo INNER JOIN procesos p ON d.id_procesomaestro = p.id_proceso INNER JOIN documentos_versiones v ON (d.id_documento = v.id_documento AND v.estado = "1")', '', 'd.nombre', 0, 0);
    
    $tabla = '<thead><tr>';
    foreach ($query->list_fields() as $campo)
    {
       $tabla .= '<th>'.($campo).'</th>';
    }
    $tabla .= '</tr></thead><tbody>';

    foreach ($query->result_array() as $row)
    {
      $tabla .= '<tr><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tipo'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Código'].'</td><td>'.anchor(base_url().'/'.$row['<i class=ti-files></i>'], '<i class="ti-printer"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$row['Versión'].'</td>';
      
      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';
    
    return $tabla;
  }
}


if ( ! function_exists('listar_solicitudes_tabla')) {
  function listar_solicitudes_tabla($tipo,$usuario) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..", d.id_solicitud AS "Id", CASE WHEN d.tipo_solicitud="1" THEN "Creación" WHEN d.tipo_solicitud="2" THEN "Modificacion" ELSE "Eliminar" END AS "Tipo", td.nombre AS "Tipo Documento", d.nombre_documento AS "Nombre", p.nombre AS "Proceso", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Responsable", d.fecha AS "Fecha Solicitud", IFNULL(d.archivo_original,"") AS "Doc.", CASE WHEN d.estado="0" THEN "Pendiente" WHEN d.estado="1" THEN "Aceptada" WHEN d.estado="2" THEN "Rechazada"  WHEN d.estado="3" THEN "Revisada" WHEN d.estado="4" THEN "Aprobada" WHEN d.estado="6" THEN "Codificada" WHEN d.estado="7" THEN "Devuelta" ELSE "Cerrada" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    if($usuario == 571 || $usuario == 1 || $usuario == 3){
      $query = $CI->general_model->consulta_personalizada($campos, 'solicitud_documentos d LEFT JOIN procesos p ON d.id_proceso = p.id_proceso LEFT JOIN empleados e ON d.id_responsable = e.id_empleado LEFT JOIN tipos_documentos td ON td.id_tipo = d.id_tipo_documento', 'd.estado != 3 AND d.estado != 6 AND d.estado != 6 AND d.estado != 7 AND d.estado != 8', 'd.fecha', 0, 0);
    }else{
      
      $query = $CI->general_model->consulta_personalizada($campos, 'solicitud_documentos d LEFT JOIN procesos p ON d.id_proceso = p.id_proceso LEFT JOIN empleados e ON d.id_responsable = e.id_empleado LEFT JOIN tipos_documentos td ON td.id_tipo = d.id_tipo_documento', 'd.id_usuario="'.$usuario.'" OR  FIND_IN_SET("'.$usuario.'", d.id_revisado_por) > 0 OR  FIND_IN_SET("'.$usuario.'", d.id_aprabo_por) > 0', 'd.fecha', 0, 0);
    }    
    
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
      if($row['Estado'] == "Pendiente")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Pendiente</span>';
      elseif($row['Estado'] == "Aceptada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Aceptada</span>';
      elseif($row['Estado'] == "Rechazada")
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-25">Rechazada</span>';
      elseif($row['Estado'] == "Revisada")
        $estado = '<span class="badge badge-sm bgc-yellow-d1 text-white pb-1 px-25">Revisada</span>';
      elseif($row['Estado'] == "Aprobada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Aprobada</span>';
      elseif($row['Estado'] == "Codificada")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Codificada</span>';
      elseif($row['Estado'] == "Devuelta")
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-25">Devuelta</span>';
      else
        $estado = '<span class="badge badge-sm bgc-brown-d1 text-white pb-1 px-25">Cerrada</span>';
      if($row['Doc.'] == "")
        $boton = "";
      else
        $boton = anchor(base_url().'/'.$row['Doc.'], '<i class="fa fa-file-word"></i>', array('class'=>'btn btn-circle btn-outline-primary','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank'));

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo'].'</td><td>'.$row['Tipo Documento'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Responsable'].'</td><td>'.$row['Fecha Solicitud'].'</td><td>'.$boton.'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons"> ';

        
        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'_'.$usuario.'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a>';
       
        if($row['Estado'] == "Aceptada"||$row['Estado'] == "Devuelta") {
        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Revisar" aria-describedby="tooltip'.$row['Id'].'" id="btnrevisar_'.$row['Id'].'_'.$usuario.'"> <i  id="btnrevisar_'.$row['Id'].'_'.$usuario.'" class="fa fa-search-plus text-105"></i> </a>'; 
        } else {
          $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Revisar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-search-plus text-105"> </i> </a>';
        }
        if($row['Estado'] == "Revisada") {
        $tabla .= '<a href="#" class="text-green mx-1" data-toggle="tooltip" data-original-title="Aprobar" aria-describedby="tooltip'.$row['Id'].'" id="btnaprobar_'.$row['Id'].'_'.$usuario.'"> <i  id="btnaprobar_'.$row['Id'].'_'.$usuario.'" class="fa fa-check-square text-105"></i> </a> ';
        } else {
          $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Aprobar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-check-square text-105"></i> </a> ';
        }
        $tabla .='</div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_subprocesos_tabla')) {
  function listar_subprocesos_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  sp.id_subproceso AS "Id", sp.nombre AS "Nombre", p.nombre AS "Proceso", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Responsable",  CASE WHEN sp.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'subprocesos sp INNER JOIN procesos p ON sp.id_proceso = p.id_proceso INNER JOIN empleados e ON sp.id_responsable = e.id_empleado', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Responsable'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if (!function_exists('listar_ingresosp_tabla')) {
  function listar_ingresosp_tabla($tipo,$usuario) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",i.id_ingreso AS "Id", tc.nombre AS "Tipo Contrato", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Funcionario", ca.nombre AS "Cargo", cc.nombre AS "Centro de Costo", i.fecha_registro AS "Fecha Solicitud", CASE WHEN i.estado="0" THEN "Pendiente" WHEN i.estado="1" THEN "En proceso" WHEN i.estado="2" THEN "Aprobada" WHEN i.estado="3" THEN "Cerrada" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'ingreso_personal i INNER JOIN tipos_contrato tc ON i.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON i.id_empleado = e.id_empleado INNER JOIN cargos ca ON i.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON i.id_centrocostos = cc.id_centrocosto', '', 'i.id_ingreso', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Pendiente")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Pendiente</span>';
      else if($row['Estado'] == "En proceso")
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">En proceso</span>';
      else if($row['Estado'] == "Aprobada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Aprobada</span>';      
      else if($row['Estado'] == "Cerrada")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Cerrada</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Contrato'].'</td><td>'.$row['Funcionario'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Centro de Costo'].'</td><td>'.$row['Fecha Solicitud'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'_'.$usuario.'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Funcionario'].'" /> </i> </a>';
                
        if($row['Estado'] == "Pendiente"||$row['Estado'] == "En proceso") {
        $tabla .= '<a href="#" class="text-green mx-1" data-toggle="tooltip" data-original-title="Revisar" aria-describedby="tooltip'.$row['Id'].'" id="btnrevisar_'.$row['Id'].'_'.$usuario.'"> <i  id="btnrevisar_'.$row['Id'].'_'.$usuario.'" class="fa fa-check-square text-105"></i> </a>'; 
        } else {
          $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Revisar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa  fa-check-square text-105"> </i> </a>';
        }
        
        $tabla .= '<a href="#" class="text-red mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-95"></i> </a>';
        
        $tabla .='</div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('listar_contratos_tabla')) {
  function listar_contratos_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",c.id_contrato AS "Id", tc.nombre AS "Tipo Contrato", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Funcionario", ca.nombre AS "Cargo", cc.nombre AS "Centro de Costo", c.fecha_inicio AS "Fecha Inicio", CASE WHEN c.estado="0" THEN "Vigente" WHEN c.estado="2" THEN "Prorogado" WHEN c.estado="1" THEN "Terminado" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'contratos c INNER JOIN tipos_contrato tc ON c.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON c.id_funcionario = e.id_empleado INNER JOIN cargos ca ON c.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON c.id_centrocosto = cc.id_centrocosto', 'c.estado!="1"', 'c.id_contrato', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Vigente")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Vigente</span>';
      else if($row['Estado'] == "Terminado")
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Terminado</span>';
      else if($row['Estado'] == "Prorogado")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Prorogado</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Contrato'].'</td><td>'.$row['Funcionario'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Centro de Costo'].'</td><td>'.$row['Fecha Inicio'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';
        if($row['Estado'] != "Terminado"){
          $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-95"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Funcionario'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-95"></i> </a>
           
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Otro Si" aria-describedby="tooltip'.$row['Id'].'" id="btnotrosi_'.$row['Id'].'"> <i id="btnotrosi_'.$row['Id'].'" class="fa fa-file text-95"></i> </a>';
        }
        
          $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-95"></i> </a>
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}


if ( ! function_exists('listar_egreso_contratos_tabla')) {
  function listar_egreso_contratos_tabla($tipo) {
    
    $tabla = '';
    $boton ="";

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",c.id_contrato AS "Id", tc.nombre AS "Tipo Contrato", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Funcionario", ca.nombre AS "Cargo", cc.nombre AS "Centro de Costo", c.fecha_inicio AS "Fecha Inicio", ce.paz_salvo AS "archivoPS",CASE WHEN c.estado="0" THEN "Vigente" WHEN c.estado="1" THEN "Prorogado" WHEN c.estado="2" THEN "Terminado" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'contratos c INNER JOIN tipos_contrato tc ON c.id_tipocontrato = tc.id_tipocontrato INNER JOIN empleados e ON c.id_funcionario = e.id_empleado INNER JOIN cargos ca ON c.id_cargo = ca.id_cargo INNER JOIN centroscostos cc ON c.id_centrocosto = cc.id_centrocosto LEFT JOIN contratos_egresos ce ON c.id_contrato = ce.id_contrato', 'c.estado!=2', 'c.id_contrato', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Vigente")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else if($row['Estado'] == "Terminado")
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Terminado</span>';
      else if($row['Estado'] == "Prorogado")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Prorogado</span>';

      if($row['archivoPS']!=null || $row['archivoPS']!=""){
       $boton = anchor(base_url().'/'.$row['archivoPS'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-red','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')); 
      }      

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Contrato'].'</td><td>'.$row['Funcionario'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Centro de Costo'].'</td><td>'.$row['Fecha Inicio'].'</td><td>'.$boton.'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';
        if($row['Estado'] != "Terminado"){
          $tabla .= ' 
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Egreso" aria-describedby="tooltip'.$row['Id'].'" id="btnEgreso_'.$row['Id'].'"> <i  id="btnEgreso_'.$row['Id'].'" class="fa fa-share text-95"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Funcionario'].'" /> </i> </a>';
          }
          $tabla .= '  <a href="#" class="text-green mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btnDetalle_'.$row['Id'].'"> <i  id="btnDetalle_'.$row['Id'].'" class="fa fa-search-plus text-95"></i> </a>
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('listar_doc_pend_contratos_tabla')) {
  function listar_doc_pend_contratos_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='Contrato, Funcionario, Cargo, Id, Nombre, Archivo';


    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query =  $this->general_model->consulta_personalizada($campos, '(SELECT Contrato, Funcionario, Cargo, Id, Nombre, IFNULL(ca.archivo,"") AS "Archivo" FROM (SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_contrato AS "Contrato", IFNULL(CONCAT(e.nombres, e.apellidos),"") AS "Funcionario", c.nombre AS "Cargo" FROM contratos ct INNER JOIN empleados e ON ct.id_funcionario=e.id_empleado INNER JOIN cargos c ON ct.id_cargo=c.id_cargo INNER JOIN ckeklist_contratosp cc ON ct.id_cargo=cc.id_cargo INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos)) AS t1 LEFT JOIN contratos_anexos ca ON t1.id=ca.id_checklist_contratos AND t1.Contrato=ca.id_contrato) as t2', 't2.Archivo =" "', 't2.Contrato', 0, 0);

    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      
      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Contrato'].'</td><td>'.$row['Funcionario'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Archivo'].'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Funcionario'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('listar_politicas_tabla')) {
  function listar_politicas_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",p.id_politica AS "Id", p.nombre AS "Nombre",p.descripcion AS "Descripcion", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'politicas p', '', 'id_politica', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Descripcion'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('cargar_politicas_acord')) {
  function cargar_politicas_acord() {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='p.id_politica AS "Id", p.nombre AS "Nombre",p.descripcion AS "Descripcion", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    $query = $CI->general_model->consulta_personalizada($campos, 'politicas p', 'estado = "1"', 'id_politica', 0, 0);
    
    $accordion = '<div class="accordion" id="accordionPoliticas">';
    
    foreach ($query->result_array() as $row)
    {
      
      $accordion .= '<div class="card border-0 bgc-green-l5 post-carg" >';
      $accordion .= '<div class="card-header border-0 bgc-transparent mb-0" id="heading'.$row['Id'].'">';
      $accordion .= '<h2 class="card-title bgc-transparent text-green-d2 brc-green">';
      $accordion .= ' <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse'.$row['Id'].'" data-toggle="collapse" aria-expanded="false" aria-controls="collapse'.$row['Id'].'">
                              '.$row['Nombre'].'
                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a></h2></div>';
    $accordion .='<div id="collapse'.$row['Id'].'" class="collapse" aria-labelledby="heading'.$row['Id'].'" data-parent="#accordionPoliticas">';
    $accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                    <p>'.$row['Descripcion'].'</p>';
    $accordion .= '</div></div></div>';
    }
    $accordion .= '</div>';

    return $accordion;
  }
}


if ( ! function_exists('listar_terceros_tabla')) {
  function listar_terceros_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..", t.id_tercero AS "Id", CASE WHEN t.tipo_tercero = "0" THEN "Proveedor" ELSE "Cliente" END AS "Tipo Tercero", t.numero_id AS "Numero", t.razon_social AS "Razon Social", t.telefono_contacto AS "Telefono Contacto", t.correo_contacto AS "E-Mail", CASE WHEN t.proveedor_critico ="0" THEN "No" ELSE "Si" END AS "Proveedor Critico" , CASE WHEN t.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'terceros t', '', 't.id_tercero', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Tercero'].'</td><td>'.$row['Numero'].'</td><td>'.$row['Razon Social'].'</td><td>'.$row['Telefono Contacto'].'</td><td>'.$row['E-Mail'].'</td><td>'.$row['Proveedor Critico'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Razon Social'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('listar_contratost_tabla')) {
  function listar_contratost_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..", ct.id_contrato_tercero AS "Id", CASE WHEN te.tipo_tercero="0" THEN "Proveedor" ELSE "Cliente" END AS "Tipo Tercero", te.numero_id AS "NIT", te.razon_social AS "Razon Social", CASE WHEN ct.areas="0" THEN "Asistencial" WHEN ct.areas="1" THEN "Administrativa" WHEN ct.areas="0,1" THEN "Asistencial, Administrativa" WHEN ct.areas="1,0" THEN "Asistencial, Administrativa" END AS "Area", ct.concepto AS "Concepto", ct.fecha_inicio AS "Fecha Inicio", ct.fecha_final AS "Fecha Final", /*CASE WHEN ct.prorroga="0" THEN "No" ELSE "Si" END AS "Prorroga",*/ CASE WHEN ct.estado="0" THEN "Vigente" WHEN ct.estado="1" THEN "Prorogado" WHEN ct.estado="2" THEN "Terminado" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'contratos_terceros ct INNER JOIN terceros te ON ct.id_tercero = te.id_tercero', '', '', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Vigente")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Vigente</span>';
      else if($row['Estado'] == "Terminado")
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Terminado</span>';
      else if($row['Estado'] == "Prorogado")
        $estado = '<span class="badge badge-sm bgc-info-d1 text-white pb-1 px-25">Prorogado</span>';
      else if($row['Estado'] == "Inactivo")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-25">Inactivo</span>';

      $concepto = explode(',', $row['Concepto']);
        
      $concepto = '';
      $query1 = $CI->general_model->consulta_personalizada('nombre', 'conceptos_contratost', ' estado = "1" AND id_concepto IN ('.$row['Concepto'].') ', 'nombre', 0, 0);
      foreach ($query1->result_array() as $row1)
      {
        if($concepto != '')
          $concepto .= ', ';
        $concepto .= $row1['nombre'];
      }

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Tipo Tercero'].'</td><td>'.$row['NIT'].'</td><td>'.$row['Razon Social'].'</td><td>'.$row['Area'].'</td><td>'.$concepto.'</td><td>'.$row['Fecha Inicio'].'</td><td>'.$row['Fecha Final'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Razon Social'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Terminar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Otro Si" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-file text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }
}

if ( ! function_exists('cargar_anexos_acord')) {
  function cargar_anexos_acord($cargo,$tipoCont) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='ld.id_listado AS "Id", ld.nombre AS "Documento"';
      
    $query = $CI->general_model->consulta_personalizada($campos, 'ckeklist_contratosp c JOIN listado_documentos ld ON FIND_IN_SET(ld.id_listado, c.listado_documentos)', 'c.id_cargo="'.$cargo.'" AND c.tipo_contrato="'.$tipoCont.'" AND c.estado = "1"', '', 0, 0);
    
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
    
      $accordion .= '<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                  <div class="form-group row" id="div_archivo'.$row['Id'].'">
                      <div class="col-sm-4 col-form-label text-sm-right pr-0">'.
                          form_label('Archivo '.$row['Documento'],'archivo', array('class'=>'mb-0')).'
                      </div>
                      <div class="col-sm-8">'.
                          form_input(array('type'=>'hidden', 'name'=>'nomarchivo_'.$row['Id'], 'id'=>'nomarchivo_'.$row['Id'], 'value'=>$row['Documento'])).
                          form_upload(array('type'=>'file', 'name'=>'archivo_'.$row['Id'].'[]', 'id'=>'archivo_'.$row['Id'], 'class'=>'form-control ace-file-input col-sm-9 col-md-10 input-archivo', 'multiple'=>'multiple')).'
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
    $accordion .= '</div></div></div>';

    return $accordion;
  }
}

if ( ! function_exists('cargar_anexos_acord2')) {
  function cargar_anexos_acord2($idreg,$t_cont) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    if($t_cont!="7"){
      $t_cont= "1";
    }

    $campos ='t1.Id AS "Id", t1.nombre AS "Nombre"';
      
    $query = $CI->general_model->consulta_personalizada($campos, '(SELECT ld.id_listado AS "Id", ld.nombre AS "Nombre", ct.id_ingreso AS "id_ingreso", tp.id_tipocontrato AS "tipo_contrato" FROM ckeklist_contratosp AS cc INNER JOIN listado_documentos AS ld ON find_in_set(ld.id_listado, cc.listado_documentos) INNER JOIN ingreso_personal ct ON ct.id_cargo=cc.id_cargo INNER JOIN tipos_contrato tp ON  tp.id_tipocontrato = cc.tipo_contrato) AS t1 LEFT JOIN ingreso_personal_anexos ca ON t1.id=ca.id_checklist_contratos  AND t1.id_ingreso =ca.id_ingresop', ' t1.id_ingreso = "'.$idreg.'" AND t1.tipo_contrato = "'.$t_cont.'"', '', 0, 0);
    
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
    $accordion .='<div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                    <div class="form-group row" id="div_archivo'.$row['Id'].'">
                          <div class="col-sm-4 col-form-label text-sm-right pr-0">'.
                            form_label('Archivo '.$row['Nombre'],'archivo', array('class'=>'mb-0')).'
                          </div>
                          <div class="col-sm-8">'.
                            form_input(array('type'=>'hidden', 'name'=>'nomarchivo_'.$row['Id'], 'id'=>'nomarchivo_'.$row['Id'], 'value'=>$row['Nombre'])).
                            form_upload(array('type'=>'file', 'name'=>'archivo_'.$row['Id'], 'id'=>'archivo_'.$row['Id'], 'placeholder'=>'Seleccione el Archivo '.$row['Nombre'], 'class'=>'form-control ace-file-input col-sm-9 col-md-10','multiple'=>'multiple')).'
                          </div>
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
    $accordion .= '</div></div></div>';

    return $accordion;
  }
}

if ( ! function_exists('listar_procedimientoscx_tabla')) {
  function listar_procedimientoscx_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..",id_procedimiento AS "Id", codigo_cx AS "Codigo", nombre AS "Nombre", tiempo_cx AS "Tiempo", CASE WHEN estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'procedimientos_cx', '', '', 0, 0);
    
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

    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Codigo'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tiempo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_pacientes_tabla')) {
  function listar_pacientes_tabla($tipo) {

    $tabla = '';

    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..", p.id_paciente AS "Id", p.numero_id AS "N. Documento", IFNULL(CONCAT(p.nombres, " ", p.apellidos), " ") AS "Nombre del Paciente",  e.nombre AS "Entidad de Salud", p.telefono AS "Telefono", p.correo AS "Correo", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'pacientes p LEFT JOIN eps e ON p.id_entidad_salud = e.id_eps', '', 'p.apellidos', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';

    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['N. Documento'].'</td><td>'.$row['Nombre del Paciente'].'</td><td>'.$row['Entidad de Salud'].'</td><td>'.$row['Telefono'].'</td><td>'.$row['Correo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre del Paciente'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_usuarios_tabla')) {
  function listar_usuarios_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", u.id_usuario AS "Id", CONCAT(u.nombre, " ", u.apellido) AS "Nombre", CASE WHEN u.perfil="0" THEN "Administrador" WHEN u.perfil="1" THEN "Gerente" WHEN u.perfil="2" THEN "Coordinador" WHEN u.perfil="3" THEN "Cirujanos" WHEN u.perfil="4" THEN "Costos / Contratos" WHEN u.perfil="5" THEN "Asistenciales" WHEN u.perfil="6" THEN "Cirugia" WHEN u.perfil="7" THEN "Auditoria" WHEN u.perfil="8" THEN "Instrumentadoras" END AS "Perfil", u.email AS "Email", u.telefono AS "Teléfono", CASE WHEN u.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';

    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'usuarios u', '', 'u.nombre, u.apellido', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
    $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Perfil'].'</td><td>'.$row['Email'].'</td><td>'.$row['Teléfono'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';       
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_materialesqx_tabla')) {
  function listar_materialesqx_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  m.id_material AS "Id",p.nombre AS "Grupo", m.nombre_material AS "Nombre" , CASE WHEN m.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'materiales_qx m LEFT JOIN materiales_grupos p ON m.id_grupo = p.id_grupo', '', 'Id', 0, 0);
    
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
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Grupo'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-check-square text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_lineacostos_tabla')) {
  function listar_lineacostos_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..",  lc.id_linea_costos AS "Id", lc.nombre AS "Nombre", CASE WHEN lc.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'linea_costos lc ', '', '', 0, 0);
    
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

    $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_eps_tabla')) {
  function listar_eps_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  e.id_eps AS "Id", e.codigo AS "Codigo", e.nombre AS "Nombre", CASE WHEN e.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'eps e', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Codigo'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_arl_tabla')) {
  function listar_arl_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  a.id_arl AS "Id", a.nombre AS "Nombre", CASE WHEN a.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'arl a', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_conceptos_tabla')) {
  function listar_conceptos_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  a.id_concepto AS "Id", a.nombre AS "Nombre", a.prefijo AS "Prefijo", CASE WHEN a.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'conceptos_contratost a', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Prefijo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_checklist_doc_tabla')) {
  function listar_checklist_doc_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  cc.id_checklist AS "Id", c.nombre AS "Cargos", tc.nombre AS "Tipo Contrato", CASE WHEN cc.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'ckeklist_contratosp cc INNER JOIN cargos c ON cc.id_cargo = c.id_cargo INNER JOIN tipos_contrato tc ON cc.tipo_contrato = tc.id_tipocontrato', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Cargos'].'</td><td>'.$row['Tipo Contrato'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Cargos'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if (!function_exists('listar_programacion_tabla')) {
  function listar_programacion_tabla($tipo,$usuario,$usuario_perfil) 
  {
    $fecha = date('Y-m-d');
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..",pg.id_programacion AS "Id", IFNULL(CONCAT(pa.numero_id," - ", pa.nombres, " ", pa.apellidos), " ") AS "Paciente", IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Cirujano", DATE_FORMAT(pg.fecha_programacion, "%d/%m/%Y" ) AS "Fecha programacion", pg.hora_programacion AS "Hora", pg.salaQx AS "Sala", CASE WHEN pg.estado="0" THEN "Pendiente" WHEN pg.estado="1" THEN "Gestionada" WHEN pg.estado="2" THEN "Confirmada"  ELSE "Rechazado" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    if($usuario==176 || $usuario_perfil=="1" || $usuario==9 || $usuario==3){
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', '', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }else if($usuario_perfil=="6"){
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.estado="0"', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }else if($usuario_perfil=="8"){
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.estado="1"', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }else{
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.id_cirujano ="'.$usuario.'" AND pg.fecha_programacion>="'.$fecha.'" ', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-70"><tr>';
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
      if($row['Estado'] == "Pendiente")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-20">Pendiente</span>';
      elseif($row['Estado'] == "Gestionada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">Gestionada</span>'; 
      elseif($row['Estado'] == "Confirmada")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Confirmada</span>';       
      else
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-20">Rechazado</span>';

    $tabla .= '<tr class="d-style bgc-h-default-8"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Cirujano'].'</td><td>'.$row['Fecha programacion'].'</td><td>'.$row['Hora'].'</td><td>'.$row['Sala'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Paciente'].'" /> </i> </a> ';
          
        if($row['Estado'] == "Gestionada"){
          $tabla .= '<a href="#" class="text-green mx-1" data-toggle="tooltip" data-original-title="Solicitar" aria-describedby="tooltip'.$row['Id'].'" id="btnsolicitar_'.$row['Id'].'"> <i  id="btnsolicitar_'.$row['Id'].'" class="fa fa-file text-105"></i> </a>'; 
        }else{
          $tabla .= '<a href="#" class="text-hide mx-1" data-toggle="tooltip" data-original-title="Solicitar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-file text-105"></i> </a>'; 
        }        
        $tabla .= '<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>
              <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if (!function_exists('listar_cirugias_tabla')) {
  function listar_cirugias_tabla($tipo,$usuario,$usuario_perfil) 
  {
    $fecha = date('Y-m-d');
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..",pg.id_programacion AS "Id", IFNULL(CONCAT(pa.nombres, " ", pa.apellidos), " ") AS "Paciente", IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Cirujano", DATE_FORMAT(pg.fecha_programacion, "%d/%m/%Y" ) AS "Fecha programacion", pg.hora_programacion AS "Hora", pg.salaQx AS "Sala", CASE WHEN pg.estado="0" THEN "Pendiente" WHEN pg.estado="1" THEN "Gestionada" WHEN pg.estado="2" THEN "Confirmada"  ELSE "Rechazado" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    if($usuario==176 || $usuario_perfil=="1" || $usuario==9 || $usuario==3){
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.estado="2" AND pg.fecha_programacion="'.$fecha.'" ', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }else if($usuario_perfil=="6"){
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.estado="2"', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }else if($usuario_perfil=="8"){
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.estado="2"', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }else{
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion pg INNER JOIN pacientes pa ON pg.id_paciente = pa.id_paciente INNER JOIN empleados ci ON pg.id_cirujano = ci.id_empleado', 'pg.estado="2" AND pg.id_cirujano ="'.$usuario.'" AND pg.fecha_programacion>="'.$fecha.'" ', 'pg.id_cirujano ASC, pg.fecha_programacion ASC, pg.hora_programacion ASC', 0, 0);
    }
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-70"><tr>';
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
      if($row['Estado'] == "Pendiente")
        $estado = '<span class="badge badge-sm bgc-danger-d1 text-white pb-1 px-20">Pendiente</span>';
      elseif($row['Estado'] == "Gestionada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">Gestionada</span>'; 
      elseif($row['Estado'] == "Confirmada")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Confirmada</span>';       
      else
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-20">Rechazado</span>';

    $tabla .= '<tr class="d-style bgc-h-default-8"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Cirujano'].'</td><td>'.$row['Fecha programacion'].'</td><td>'.$row['Hora'].'</td><td>'.$row['Sala'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Paciente'].'" /> </i> </a> ';
          
        if($row['Estado'] == "Gestionada"){
          $tabla .= '<a href="#" class="text-green mx-1" data-toggle="tooltip" data-original-title="Solicitar" aria-describedby="tooltip'.$row['Id'].'" id="btnsolicitar_'.$row['Id'].'"> <i  id="btnsolicitar_'.$row['Id'].'" class="fa fa-file text-105"></i> </a>'; 
        }else{
          $tabla .= '<a href="#" class="text-hide mx-1" data-toggle="tooltip" data-original-title="Solicitar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-file text-105"></i> </a>'; 
        }        
        $tabla .= '<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>
              <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if (!function_exists('listar_pcirugia_tabla')) {
  function listar_pcirugia_tabla($tipo,$usuario,$perfil) 
  {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..",pc.id_cirugia AS "Id", DATE_FORMAT(pc.fecha_Cx, "%d/%m/%Y" ) AS "Fecha Procedimiento", TIME_FORMAT(pc.hora_Cx,"%H:%i") AS "Hora Procedimiento", pc.id_paciente AS "Cedula", pc.nombres AS "Paciente", IFNULL(CONCAT(ci.nombres, " ", ci.apellidos), " ") AS "Especialista",CASE WHEN pc.estado="0" THEN "Sin Seguimiento" WHEN pc.estado="1" THEN "En Seguimiento" ELSE "Cerrada" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
   
      $query = $CI->general_model->consulta_personalizada($campos, 'p_curso_cx pc INNER JOIN empleados ci ON pc.id_cirujano = ci.id_empleado ', '', 'pc.id_cirujano ASC, pc.fecha_Cx ASC, pc.hora_Cx ASC', 0, 0);
            
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-70"><tr>';
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
      if($row['Estado'] == "Sin Seguimiento")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-20">Sin Seguimiento</span>';
      elseif($row['Estado'] == "En Seguimiento")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-20">En Seguimiento</span>'; 
      else
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-20">Cerrada</span>';

      $tabla .= '<tr class="d-style bgc-h-default-8"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Fecha Procedimiento'].'</td><td>'.$row['Hora Procedimiento'].'</td> <td>'.$row['Cedula'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Especialista'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

        if($row['Estado'] == "Cerrada"){
          $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Seguimiento" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-pencil-alt text-105"></i></a> ';
        }else{
          $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Seguimiento" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Paciente'].'" /> </i> </a> ';
          }           
                  
        $tabla .= '<a href="#" class="text-success mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a>  
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_tareas_tabla')) {
  function listar_tareas_tabla($tipo,$usuario) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = '"..", t.id_tareas AS "Id", t.fecha_registro AS "Fecha", t.descripcion AS "Tarea", IFNULL(CONCAT(e.nombre, " ", e.apellido), "") AS "Solicitada por", p.nombre AS "Proceso", CASE WHEN t.estado="0" THEN "Pendiente" WHEN t.estado="1" THEN "Aceptada" WHEN t.estado="2" THEN "Rechazada"  WHEN t.estado="3" THEN "Revisada" WHEN t.estado="4" THEN "Aprobada" ELSE "Cerrada" END AS "Estado"';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    if($usuario=571){
      $query = $CI->general_model->consulta_personalizada($campos, 'tareas t INNER JOIN procesos p ON t.id_proceso = p.id_proceso INNER JOIN usuarios e ON t.id_usuario_asignado = e.id_usuario', '', 't.fecha_registro', 0, 0);
    }else{
      
      $query = $CI->general_model->consulta_personalizada($campos, 'tareas t INNER JOIN procesos p ON t.id_proceso = p.id_proceso INNER JOIN usuarios e ON t.id_usuario_asignado = e.id_usuario', 't.id_usuario_tarea ="'.$usuario.'" OR t.id_usuario_asignado ="'.$usuario.'"', 't.fecha_registro', 0, 0);
    }   
    
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
      if($row['Estado'] == "Pendiente")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Pendiente</span>';
      elseif($row['Estado'] == "Aceptada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Aceptada</span>';
      elseif($row['Estado'] == "Rechazada")
        $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-25">Rechazada</span>';
      elseif($row['Estado'] == "Revisada")
        $estado = '<span class="badge badge-sm bgc-yellow-d1 text-white pb-1 px-25">Revisada</span>';
      elseif($row['Estado'] == "Aprobada")
        $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Aprobada</span>';
      else
        $estado = '<span class="badge badge-sm bgc-brown-d1 text-white pb-1 px-25">Cerrada</span>';
      
      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Fecha'].'</td><td>'.$row['Tarea'].'</td><td>'.$row['Solicitada por'].'</td><td>'.$row['Proceso'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Tarea'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_ccirugias_tabla')) {
  function listar_ccirugias_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", c.id_ccirugias AS "Id", c.periodo AS "Periodo", p.nombre AS "Cirugia", c.cantidad AS "Cantidad", CASE WHEN c.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'c_cirugias c INNER JOIN procedimientos_cx p ON c.id_procedimientoqx=p.id_procedimiento', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Periodo'].'</td><td>'.$row['Cirugia'].'</td><td>'.$row['Cantidad'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Cirugia'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>
          
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_cmanoobrap_tabla')) {
  function listar_cmanoobrap_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", ma.id_manoobra AS "Id", ma.periodo AS "Periodo", ca.nombre AS "Cargo", ma.numero_cargos AS "Cantidad", ((ma.valor_salario+ma.valor_parafiscales+ma.valor_pension+ma.valor_salud+ma.valor_arl+ma.valor_cesantias+ma.valor_prima+ma.valor_vacaciones+ma.valor_icesantias+ma.valor_auxtrasporte+ma.valor_dotacion)*ma.numero_cargos) AS "Total", CASE WHEN ma.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'c_manoobra_planta ma INNER JOIN cargos ca ON ma.id_cargo = ca.id_cargo', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Periodo'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Cantidad'].'</td><td>'.$row['Total'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Cargo'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

         
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_costosgenerales_tabla')) {
  function listar_costosgenerales_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", id_costogeneral AS "Id", unidadfuncional AS "Nombre", (valor_agua+valor_energia+valor_telefonia+valor_internet+valor_mto_planta+valor_mto_equipos+valor_gasesm+papeleria+valor_licenciassoftware) AS "Costo Total UFC",  CASE WHEN estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'c_costosgenerales', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Costo Total UFC'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

         
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_cmanoobrapresta_tabla')) {
  function listar_cmanoobrapresta_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  id_manoobrapresta AS "Id", periodo AS "Periodo", id_cargo AS "Cargo", id_empleados AS "Empleado", costo_total_ufc AS "Costo", CASE WHEN estado ="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'c_manoobrapresta', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Periodo'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Empleado'].'</td><td>'.$row['Costo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Cargo'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_csuministros_tabla')) {
  function listar_csuministros_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", su.id_suministro AS "Id", su.nombre AS "Nombre", CASE WHEN su.categoria="0" THEN "Sutura" WHEN su.categoria="1" THEN "Especiales"  WHEN su.categoria="2" THEN "Materiales" WHEN su.categoria="3" THEN "Medicametos" ELSE "Otros" END AS "Categoria", su.precio AS "Precio", CASE WHEN su.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'c_suministros su', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Categoria'].'</td><td>'.$row['Precio'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

         
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_cmanoobrapresta_tabla')) {
  function listar_cmanoobrapresta_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  id_manoobrapresta AS "Id", periodo AS "Periodo", id_cargo AS "Cargo", id_empleados AS "Empleado", costo_total_ufc AS "Costo", CASE WHEN estado ="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'c_manoobrapresta', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Periodo'].'</td><td>'.$row['Cargo'].'</td><td>'.$row['Empleado'].'</td><td>'.$row['Costo'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Cargo'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_consultadocumentos_tabla')) {
  function listar_consultadocumentos_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",d.id_documento AS "Id", d.nombre AS "Nombre", t.nombre AS "Tipo", p.nombre AS "Proceso", d.codigo AS "Código", CONCAT(v.ruta,v.archivo) AS "Ver", CONCAT(v.version," del ",v.fecha) AS "Versión", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
    if($tipo == 'WEB')
     
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos d LEFT JOIN tipos_documentos t ON d.id_tipo = t.id_tipo  LEFT JOIN procesos p ON d.id_procesomaestro = p.id_proceso LEFT JOIN documentos_versiones v ON d.id_documento = v.id_documento AND v.estado = "1"', '', 'd.nombre', 0, 0);
    
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
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Tipo'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Código'].'</td><td>'.anchor(base_url().$row['Ver'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$row['Versión'].'</td><td>'.$estado.'</td>';

      // if($tipo == 'WEB')
        // $tabla .= '<td class="text-nowrap"><div class="action-buttons">
        //   <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

        //   <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

        //   <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
        //   </div></td>';
      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_documentosIns_tabla')) {
  function listar_documentosIns_tabla($tipo) {
    
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos ='"..",d.id_docinstitucional AS "Id", d.nombre AS "Nombre", IFNULL(CONCAT(e.nombres, " ", e.apellidos), "") AS "Responsable", ad.archivo AS "Ver", ad.fecha_final AS "Vence", CASE WHEN d.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
    
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'documentos_institucionales d INNER JOIN documentos_institucionales_anexos ad ON d.id_docinstitucional = ad.id_docinstitucional AND ad.estado = "1" INNER JOIN empleados e ON d.id_responsable=e.id_empleado', 'd.estado="1"', 'd.nombre', 0, 0);
    
    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo)
    {
      if($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
      else
        $tabla .= '<th>'.($campo).'</th>';
    }
      $tabla .= '</tr></thead><tbody class="pos-rel">';

    foreach ($query->result_array() as $row)
    {
      if($row['Estado'] == "Activo")
        $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
      else
        $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Responsable'].'</td><td>'.anchor(base_url().$row['Ver'], '<i class="fa fa-print"></i>', array('class'=>'btn btn-circle btn-outline-success','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'</td><td>'.$row['Vence'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">';

        if($row['Estado'] == "Activo") {
          $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>'; 
        } else {
          $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Modificar" aria-describedby="tooltip'.$row['Id'].'"> <i class="fa fa-pencil-alt text-105"> </i> </a> 
          <a href="#" class="text-dark-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar"> <i class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" > <i class="fa fa-search-plus text-105"></i> </a> 
          </div></td>'; 
        }
          
      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

  if ( ! function_exists('listar_encuestas_tabla')) {
  function listar_encuestas_tabla($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..",  aa.id_area AS "Id", aa.codigo AS "Codigo", aa.nombre AS "Nombre", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'areas aa', '', 'Id', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Codigo'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_rondas_tablas')) {
  function listar_rondas_tablas($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", aa.id_ronda AS "Id", aa.nombre AS "Nombre", aa.codigo_documento AS "Codigo",  pp.nombre AS "Proceso", IFNULL(CONCAT(ee.nombres, " ", ee.apellidos), "") AS "Responsable", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'rondas aa LEFT JOIN procesos pp ON aa.id_proceso = pp.id_proceso LEFT JOIN empleados ee ON aa.id_responsable = ee.id_empleado', '', 'codigo_documento', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Codigo'].'</td><td>'.$row['Proceso'].'</td><td>'.$row['Responsable'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if ( ! function_exists('listar_secciones_tablas')) {
  function listar_secciones_tablas($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", s.id_seccion AS "Id", s.nombre AS "Nombre", r.nombre AS "Ronda", CASE WHEN s.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'rondas r INNER JOIN rondas_seccion s ON r.id_ronda = s.id_ronda', '', 'id_seccion', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$row['Ronda'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}


if ( ! function_exists('listar_preguntas_tablas')) {
  function listar_preguntas_tablas($tipo) {
      
    $tabla = '';
    
    $CI =& get_instance();
    $CI->load->model('general_model');

    $campos = ' "..", p.id_items AS "Id", p.nombre AS "Pregunta", s.nombre AS "Seccion", CASE WHEN p.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado"';
      
    if($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';
    
    $query = $CI->general_model->consulta_personalizada($campos, 'rondas_preguntas p INNER JOIN rondas_seccion s ON p.id_seccion = s.id_seccion', '', 'id_items', 0, 0);
    
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

      $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Pregunta'].'</td><td>'.$row['Seccion'].'</td><td>'.$estado.'</td>';

      if($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Pregunta'].'" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

      $tabla .= '</tr>';        
    }
    $tabla .= '</tbody>';   
    
    return $tabla;
  }
}

if (!function_exists('listar_planesMejoras_tabla')) {
    function listar_planesMejoras_tabla($tipo,$tipo_fuente)
    {

      $tabla = '';
      
      $CI = &get_instance();
      $CI->load->model('general_model');

      $tipofuente ="";
      $campos ="";
      $query ="";

      if($tipo_fuente == "0"){

        $campos = ' "..", pm.id_plan AS "Id", CASE WHEN pm.tipo_mejora = "1" THEN "Acción correctiva" WHEN pm.tipo_mejora = "2" THEN "Acción Preventiva" WHEN pm.tipo_mejora = "3" THEN "Oportunidad de mejora" END AS "Tipo de Acción", pm.tipo_fuente AS "Tipo Fuente", ro.nombre AS "Descripción Fuente", IFNULL(CONCAT(nombres, " ", apellidos)," ") AS "Responsable", DATE(pm.fecha_registro) AS "Fecha", CASE WHEN pm.estado="0" THEN "Pendiente" WHEN pm.estado="1" THEN "En Gestión" WHEN pm.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';
        
        if ($tipo == 'WEB')
          $campos .= ', "" AS "Acción" ';

        $query = $CI->general_model->consulta_personalizada($campos, 'planes_mejoras pm INNER JOIN rondas_gestion_resp re ON pm.id_fuente = re.id_respuesta INNER JOIN rondas_gestion rg ON re.id_gestion = rg.id_gestion INNER JOIN rondas ro ON rg.id_ronda = ro.id_ronda INNER JOIN rondas_preguntas rp ON re.id_pregunta = rp.id_items INNER JOIN rondas_seccion rs ON rp.id_seccion = rs.id_seccion INNER JOIN servicios se ON rg.id_servicio = se.id_servicio INNER JOIN empleados e ON pm.responsable = e.id_empleado', 'pm.tipo_fuente ="'.$tipo_fuente.'"', 'Id', 0, 0);
         
         $tipofuente ='Rondas';

      }elseif($tipo_fuente == "2"){
        $campos = ' "..", pm.id_plan AS "Id",  CASE WHEN pm.tipo_mejora = "1" THEN "Acción correctiva" WHEN pm.tipo_mejora = "2" THEN "Acción Preventiva" WHEN pm.tipo_mejora = "3" THEN "Oportunidad de mejora" END AS "Tipo de Acción", pm.tipo_fuente AS "Tipo Fuente", CONCAT(s.nombre," - ",CASE WHEN ss.novedad_asociada = "1" THEN "Uso de Medicamentos" WHEN ss.novedad_asociada = "2" THEN "Uso de Dispositivos/equipos biometricos" WHEN ss.novedad_asociada = "3" THEN "Uso de Reactivos" WHEN ss.novedad_asociada = "4" THEN "Uso de Tejidos" WHEN ss.novedad_asociada = "5" THEN "Otros" END) AS "Descripción Fuente", IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS "Responsable",DATE(pm.fecha_registro) AS "Fecha" ,CASE WHEN pm.estado="0" THEN "Pendiente" WHEN pm.estado="1" THEN "En Gestión" WHEN pm.estado="2" THEN "Gestionada" ELSE "Cerrada" END AS "Estado"';

        if ($tipo == 'WEB')
          $campos .= ', "" AS "Acción" ';

        $query = $CI->general_model->consulta_personalizada($campos, 'planes_mejoras pm INNER JOIN empleados e ON pm.responsable = e.id_empleado LEFT JOIN suceso_seguridad ss ON pm.id_fuente = ss.id_suceso_seguridad INNER JOIN servicios s ON s.id_servicio = ss.servicio', 'pm.tipo_fuente ="'.$tipo_fuente.'"', 'Id', 0, 0);  
        $tipofuente ='Sucesos de Seguridad';
      }        

     

      $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
      foreach ($query->list_fields() as $campo) {
        if ($campo != ".." && $campo != "Acción")
          $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">' . ($campo) . '</th>';
        else
          $tabla .= '<th>' . ($campo) . '</th>';
      }
      $tabla .= '</tr></thead><tbody class="pos-rel">';
      //$tabla = '<tbody class="mt-1">';

      foreach ($query->result_array() as $row) {
        if ($row['Estado'] == "Pendiente")
          $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Pendiente</span>';
        else if ($row['Estado'] == "En Gestión")
        $estado = '<span class="badge badge-sm bgc-green-d1 text-white pb-1 px-25">En Gestión</span>';
        else if ($row['Estado'] == "Gestionada")
        $estado = '<span class="badge badge-sm bgc-yelow-d1 text-white pb-1 px-25">Gestionada</span>';
        else
          $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Cerrada</span>';
        
        $tipofuente ="";

        switch($row['Tipo Fuente']){
          case 0: $tipofuente ='Rondas';break;
          case 1: $tipofuente='Quejas';break;
          case 2: $tipofuente='Incidentes';break;
          case 3: $tipofuente='Eventos Adversos';break;
          case 4: $tipofuente='Actos Inseguros';break;
          case 5: $tipofuente='Por Auditrias';break;
          case 6: $tipofuente='Por Indicadores';break;
          case 7: $tipofuente='Por Comités';break;
          case 8: $tipofuente='Analisis de Riesgo';break;
          case 9: $tipofuente='Accidente de Trabajo';break;
        }  

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>' . $row['Id'] . '</td><td>' . $row['Tipo de Acción'] . '</td><td>' . $tipofuente . '</td><td>' . $row['Descripción Fuente'] . '</td><td>' . $row['Responsable']. '</td><td>' . $row['Fecha']. '</td><td>' . $estado . '</td>';

       

        if ($tipo == 'WEB')
          $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '" id="btngestionar_' . $row['Id'] . '"> <i  id="btngestionar_' . $row['Id'] .'_'.$tipo_fuente.'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_' . $row['Id'] .'_'.$tipo_fuente.'" name="nombre_' . $row['Id'] . '_'.$tipo_fuente.'" value="' . $row['Descripción Fuente'] . '" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_' . $row['Id'] . '"> <i id="btninactivar_' . $row['Id'] . '" class="fa fa-trash-alt text-105"></i> </a>

          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip' . $row['Id'] . '" id="btndetalle_' . $row['Id'] . '"> <i  id="btndetalle_' . $row['Id'] . '" class="fa fa-search-plus text-105"></i> </a> 
          </div></td>';

        $tabla .= '</tr>';
      }
      $tabla .= '</tbody>';

      return $tabla;
    }
  }

  if (!function_exists('listar_actasR_tabla')) {
    function listar_actasR_tabla($tipo,$usuario)
    {

      $tabla = '';
      
      $CI = &get_instance();
      $CI->load->model('general_model');

      $campos = ' "..", ac.id_acta AS "Id", ac.fecha_reunion AS "Fecha", if(ac.nombre_reunion != "20", t.nombre, ac.otro_nombre)as "Nombre Reunión", ac.proceso AS "Proceso", IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS "Responsable", CASE WHEN ac.estado="0" THEN "Pendiente" WHEN ac.estado="1" THEN "En Gestión" WHEN ac.estado="2" THEN "Aprobada" END AS "Estado", ac.usuario_registro AS "Proyecto"';

      if ($tipo == 'WEB'){
        $campos .= ', "" AS "Acción" ';
        $query = $CI->general_model->consulta_personalizada($campos, 'actas ac LEFT JOIN empleados e ON ac.id_responsabe = e.id_empleado INNER JOIN actas_tiporeunion t ON ac.nombre_reunion = t.id_tipo LEFT JOIN actas_asistentes ap ON ap.id_acta = ac.id_acta', 'ap.idparticipanteP ="'.$usuario.'"', 'Fecha DESC', 0, 0);
      }else{
        $query = $CI->general_model->consulta_personalizada($campos, 'actas ac LEFT JOIN empleados e ON ac.id_responsabe = e.id_empleado INNER JOIN actas_tiporeunion t ON ac.nombre_reunion = t.id_tipo LEFT JOIN actas_asistentes ap ON ap.id_acta = ac.id_acta', '', 'Fecha DESC', 0, 0);
      }      

      $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
      $tabla .= '<th>..</th>
                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha</th>
                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">"Nombre Reunión</th>
                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Proceso</th>
                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Responsable</th>
                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
                <th>Acción</th>';
      
      $tabla .= '</tr></thead><tbody class="pos-rel">';
      //$tabla = '<tbody class="mt-1">';

      foreach ($query->result_array() as $row) {
        if ($row['Estado'] == "Pendiente")
          $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Pendiente</span>';
        else if ($row['Estado'] == "En Gestión")
           $estado = '<span class="badge badge-sm bgc-default-d1 text-white pb-1 px-25">Gestionada</span>';
        else
          $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Aprobada</span>';

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>' . $row['Id'] . '</td><td>' . $row['Fecha'] . '</td><td>' . $row['Nombre Reunión'] . '</td><td>' . $row['Proceso'] . '</td><td>' . $row['Responsable']. '</td><td>' . $estado . '</td>';
       

        if ($tipo == 'WEB')
          if ($row['Estado'] !=  "Aprobada") {
            $tabla .= '<td class="text-nowrap"><div class="action-buttons">
            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '" id="btngestionar_' . $row['Id'] . '"> <i  id="btngestionar_' . $row['Id'] . '" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_' . $row['Id'] . '" name="nombre_' . $row['Id'] . '" value="' . $row['Nombre Reunión'] . '" /> </i> </a>';
            if($row['Proyecto'] == $usuario) {
              $tabla .= '<a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_' . $row['Id'] . '"> <i id="btninactivar_' . $row['Id'] . '" class="fa fa-trash-alt text-105"></i> </a>';
            }else{
              $tabla .= '<a href="#" class="text-dark-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" "> <i class="fa fa-trash-alt text-105"></i> </a>';
            }
            $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Acta" aria-describedby="tooltip' . $row['Id'] . '" id="btndetalle_' . $row['Id'] . '"> <i  id="btndetalle_' . $row['Id'] . '" class="fa fa-search-plus text-105"></i> </a> 
            </div></td>';
          }else{
            $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          
            <a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '"> <i class="fa fa-pencil-alt text-105"> </i> </a> 

            <a href="#" class="text-dark-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" "> <i class="fa fa-trash-alt text-105"></i> </a>

            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Acta" aria-describedby="tooltip' . $row['Id'] . '" id="btndetalle_' . $row['Id'] . '"> <i  id="btndetalle_' . $row['Id'] . '" class="fa fa-search-plus text-105"></i> </a> 
            </div></td>';
          }

        $tabla .= '</tr>';
      }
      $tabla .= '</tbody>';

      return $tabla;
    }
  }

  if (!function_exists('listar_resultadosDx_tabla')) {
    function listar_resultadosDx_tabla($tipo,$usuario)
    {

      $tabla = '';
      
      $CI = &get_instance();
      $CI->load->model('general_model');

      $campos = ' "..", rdx.id_resultadosdx AS "Id", rde.nombre AS "Examen", IFNULL(CONCAT(pac.nombres, " ", pac.apellidos)," ") AS "Paciente", rdx.fecha_examen AS "Fecha","" AS "Resultados", CASE WHEN rdx.estado="0" THEN "Inactivo" WHEN rdx.estado="1" THEN "Activo" WHEN rdx.estado="2" THEN "Enviado" END AS "Estado"';

      if ($tipo == 'WEB')
        $campos .= ', "" AS "Acción" ';

      $query = $CI->general_model->consulta_personalizada($campos, 'resultados_dx rdx INNER JOIN resultados_dx_examenes rde ON rdx.id_examen = rde.id_examen INNER JOIN pacientes pac ON  rdx.id_paciente = pac.id_paciente', 'rdx.estado!="0"', 'Fecha DESC', 0, 0);

      $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
      foreach ($query->list_fields() as $campo) {
        if ($campo != ".." && $campo != "Acción")
          $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">' . ($campo) . '</th>';
        else
          $tabla .= '<th>' . ($campo) . '</th>';
      }
      $tabla .= '</tr></thead><tbody class="pos-rel">';
      //$tabla = '<tbody class="mt-1">';

      foreach ($query->result_array() as $row) {
        if($row['Estado'] == "Activo")
          $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
        elseif($row['Estado'] == "Enviado")
          $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Enviado</span>';
        else
          $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Examen'].'</td><td>'.$row['Paciente'].'</td><td>'.$row['Fecha'].'</td><td>';
       
        $campos1 = 'ruta_archivo AS "Ruta"';
        $query1 = $CI->general_model->consulta_personalizada($campos1, 'resultados_dx_archivos', 'id_resultado_dx='.$row['Id'].'', '', 0, 0); 
        
        foreach ($query1->result_array() as $row1)
        {
          $tabla .= ''.anchor(base_url().$row1['Ruta'], '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-red','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')).'';
        } 
        $tabla .='</td><td>'.$estado.'</td>';           

        if ($tipo == 'WEB')
          $tabla .= '<td class="text-nowrap"><div class="action-buttons">
          <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Gestionar" aria-describedby="tooltip' . $row['Id'] . '" id="btnEditar_' . $row['Id'] . '"> <i  id="btnEditar_' . $row['Id'] . '" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_' . $row['Id'] . '" name="nombre_' . $row['Id'] . '" value="' . $row['Examen'] . '" /> </i> </a> 

          <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_' . $row['Id'] . '"> <i id="btninactivar_' . $row['Id'] . '" class="fa fa-trash-alt text-105"></i> </a>';

        $tabla .= '</tr>';
      }
      $tabla .= '</tbody>';

      return $tabla;
    }
  }

  if (!function_exists('listar_m_solicitudes_tabla')) {
  function listar_m_solicitudes_tabla($tipo, $usuario)
  {

    $tabla = '';

    $CI = &get_instance();
    $CI->load->model('general_model');
    
    $campos = '"..",d.id_solicitud AS "Id", m.nombre AS "matenimiento_requerido", s.nombre AS "servicio", d.ubicacion AS "ubicacion", IFNULL(CONCAT(e.nombres, " ", e.apellidos)," ") AS "solicitante", d.fecha_solicitud AS "Fecha Solicitud", CASE WHEN d.estado="0" THEN "Pendiente" WHEN d.estado ="1" THEN "Programada" WHEN d.estado="2" THEN "Ejecutada" WHEN d.estado="3" THEN "Recibida" ELSE "Rechazada" END AS "Estado"';

    if ($tipo == 'WEB')
      $campos .= ', "" AS "Acción" ';

    if($usuario == 389 || $usuario == 1 || $usuario == 3){
      $query = $CI->general_model->consulta_personalizada($campos, 'mantenimientos_solicitudes d LEFT JOIN mantenimientos_servicios m ON d.id_manterimientor = m.id_servicio LEFT JOIN servicios s ON d.id_servicio = s.id_servicio INNER JOIN empleados e ON d.id_solicitante = e.id_empleado','','d.fecha_solicitud desc', 0, 0);
    }else{
      $query = $CI->general_model->consulta_personalizada($campos, 'mantenimientos_solicitudes d LEFT JOIN mantenimientos_servicios m ON d.id_manterimientor = m.id_servicio LEFT JOIN servicios s ON d.id_servicio = s.id_servicio INNER JOIN empleados e ON d.id_solicitante = e.id_empleado','d.id_solicitante='.$usuario.'', 'd.fecha_solicitud desc', 0, 0);      
    }

    $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
    foreach ($query->list_fields() as $campo) {
      if ($campo != ".." && $campo != "Acción")
        $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">' . ($campo) . '</th>';
      else
        $tabla .= '<th>' . ($campo) . '</th>';
    }

    $tabla .= '</tr></thead><tbody class="pos-rel">';
    //$tabla = '<tbody class="mt-1">';

    foreach ($query->result_array() as $row) {
        if ($row['Estado'] == "Pendiente")
           $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Pendiente</span>';
        elseif ($row['Estado'] == "Programada")
          $estado = '<span class="badge badge-sm bgc-primary-d1 text-white pb-1 px-25">Programada</span>';
        elseif ($row['Estado'] == "Rechazada")
            $estado = '<span class="badge badge-sm bgc-red-d1 text-white pb-1 px-25">Rechazada</span>';
        elseif ($row['Estado'] == "Ejecutada")
            $estado = '<span class="badge badge-sm bgc-yellow-d1 text-white pb-1 px-25">Ejecutada</span>';
        elseif ($row['Estado'] == "Recibida")
            $estado = '<span class="badge badge-sm bgc-green-d1 text-white pb-1 px-25">Recibida</span>';
    
        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>' . $row['Id'] . '</td><td>' . $row['matenimiento_requerido'] . '</td><td>' . $row['servicio'] . '</td><td>' . $row['ubicacion'] . '</td><td>' . $row['solicitante'] . '</td><td>' .  $row['Fecha Solicitud'] . '</td><td>' . $estado . '</td>';

      if ($tipo == 'WEB')
        $tabla .= '<td class="text-nowrap"><div class="action-buttons"> ';

      if ($row['Estado'] == "Pendiente") {
        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="gestionar" aria-describedby="tooltip' . $row['Id'] . '" id="btngestionar_' . $row['Id'] . '"> <i  id="btngestionar_' . $row['Id'] . '_' . $usuario . '" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_' . $row['Id'] . '" name="nombre_' . $row['Id'] . '" value="' . $row['matenimiento_requerido'] . '" /> </i> </a>';
      } else {
        $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="gestionar" aria-describedby="tooltip' . $row['Id'] . '"> <i class="fa fa-pencil-alt text-105"> </i> </a>';
      }  
      if ($row['Estado'] == "Programada") {
        $tabla .= '<a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="ejecutar" aria-describedby="tooltip' . $row['Id'] . '" id="btnejecutar_' . $row['Id'] . '_' . $usuario . '"> <i  id="btnejecutar_' . $row['Id'] . '_' . $usuario . '" class="fa fa-search-plus text-105"></i> </a>';
      } else {
        $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="ejecutar" aria-describedby="tooltip' . $row['Id'] . '"> <i class="fa fa-search-plus text-105"> </i> </a>';
      }
      if ($row['Estado'] == "Ejecutada") {
        $tabla .= '<a href="#" class="text-green mx-1" data-toggle="tooltip" data-original-title="Recibir" aria-describedby="tooltip' . $row['Id'] . '" id="btnrecibir_' . $row['Id'] . '_' . $usuario . '"> <i  id="btnrecibir_' . $row['Id'] . '_' . $usuario . '" class="fa fa-check-square text-105"></i> </a> ';
      } else {
        $tabla .= '<a href="#" class="text-dark mx-1" data-toggle="tooltip" data-original-title="Recibir" aria-describedby="tooltip' . $row['Id'] . '"> <i class="fa fa-check-square text-105"></i> </a> ';
      }

      $tabla .= '</div></td>';

      $tabla .= '</tr>';
    }
    $tabla .= '</tbody>';

    return $tabla;
  }

  if ( ! function_exists('listar_serviciosMto_tabla')) {
    function listar_serviciosMto_tabla($tipo) {
      
      $tabla = '';
      
      $CI =& get_instance();
      $CI->load->model('general_model');

      $campos = '"..",  s.id_servicio AS "Id", s.nombre AS "Nombre", CASE WHEN s.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
      
      if($tipo == 'WEB')
        $campos .= ', "" AS "Acción" ';
      
      $query = $CI->general_model->consulta_personalizada($campos, 'mantenimientos_servicios s', '', '', 0, 0);
      
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

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

        if($tipo == 'WEB')
          $tabla .= '<td class="text-nowrap"><div class="action-buttons">
            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

            <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
            </div></td>';

        $tabla .= '</tr>';        
      }
      $tabla .= '</tbody>';   
      
      return $tabla;
    }
  }

  if ( ! function_exists('listar_tarifas_tabla')) {
    function listar_tarifas_tabla($tipo) {
      
      $tabla = '';
      
      $CI =& get_instance();
      $CI->load->model('general_model');

      $campos = '"..",  id_convenio AS "Id", año_convenio AS "Año", compañia AS "Entidad - Convenio", fecha_inicio AS "Fecha Inicio", fecha_final AS "Fecha Final", CASE WHEN estado="1" THEN "Vigente" ELSE "No Vigente" END AS "Estado"';
      
      if($tipo == 'WEB')
        $campos .= ', "" AS "Acción" ';
      
      $query = $CI->general_model->consulta_personalizada($campos, 'tarifas', '', '', 0, 0);
      
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
        if($row['Estado'] == "Vigente")
          $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Vigente</span>';
        else
          $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">No Vigente</span>';

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Año'].'</td><td>'.$row['Entidad - Convenio'].'</td><td>'.$row['Fecha Inicio'].'</td><td>'.$row['Fecha Final'].'</td><td>'.$estado.'</td>';

        if($tipo == 'WEB')
          $tabla .= '<td class="text-nowrap"><div class="action-buttons">
            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Entidad - Convenio'].'" /> </i> </a> 

            <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
            </div></td>';

        $tabla .= '</tr>';        
      }
      $tabla .= '</tbody>';   
      
      return $tabla;
    }
  }

  if ( ! function_exists('listar_documentosC_tabla')) {
    function listar_documentosC_tabla($tipo) {
        
      $tabla = '';
      
      $CI =& get_instance();
      $CI->load->model('general_model');

      $campos = ' "..",  aa.id_listado AS "Id", aa.nombre AS "Nombre", CASE WHEN aa.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
        
      if($tipo == 'WEB')
        $campos .= ', "" AS "Acción" ';
      
      $query = $CI->general_model->consulta_personalizada($campos, 'listado_documentos aa', '', 'Id', 0, 0);
      
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

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Nombre'].'</td><td>'.$estado.'</td>';

        if($tipo == 'WEB')
          $tabla .= '<td class="text-nowrap"><div class="action-buttons">
            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Nombre'].'" /> </i> </a> 

            <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
            </div></td>';

        $tabla .= '</tr>';        
      }
      $tabla .= '</tbody>';   
      
      return $tabla;
    }
  }
  if ( ! function_exists('listar_listar_bloquesQx_tabla_tabla')) {
    function listar_listar_bloquesQx_tabla_tabla($tipo) {
      
      $tabla = '';
      
      $CI =& get_instance();
      $CI->load->model('general_model');

      $campos ='"..",pgc.id_agenda AS "Id", IFNULL(CONCAT(e.nombres, " ", e.apellidos),"") AS "Cirujano", c.nombre AS "Especialidad", CASE WHEN pgc.id_dia = "1" THEN "Lunes" WHEN pgc.id_dia = "2" THEN "Martes" WHEN pgc.id_dia = "3" THEN "Miercoles" WHEN pgc.id_dia = "4" THEN "Jueves" WHEN pgc.id_dia = "5" THEN "Viernes" WHEN pgc.id_dia = "6" THEN "Sabado" END AS "Día", CASE WHEN pgc.estado="1" THEN "Activo" ELSE "Inactivo" END AS "Estado" ';
        
      if($tipo == 'WEB')
        $campos .= ', "" AS "Acción" ';
      
      $query = $CI->general_model->consulta_personalizada($campos, 'programacion_agenda_cirujano pgc INNER JOIN empleados e ON pgc.id_cirujano = e.id_empleado INNER JOIN cargos c ON e.id_cargo = c.id_cargo', '', 'pgc.id_agenda', 0, 0);
      
      $tabla = '<thead class="sticky-nav text-secondary-m1 text-uppercase text-85"><tr>';
      foreach ($query->list_fields() as $campo)
      {
        if($campo != ".." && $campo != "Acción")
          $tabla .= '<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">'.($campo).'</th>';
        else
          $tabla .= '<th>'.($campo).'</th>';
      }
        $tabla .= '</tr></thead><tbody class="pos-rel">';

      foreach ($query->result_array() as $row)
      {
        if($row['Estado'] == "Activo")
          $estado = '<span class="badge badge-sm bgc-success-d1 text-white pb-1 px-25">Activo</span>';
        else
          $estado = '<span class="badge badge-sm bgc-warning-d1 text-white pb-1 px-25">Inactivo</span>';

        $tabla .= '<tr class="d-style bgc-h-default-l4"><td>&nbsp;</td><td>'.$row['Id'].'</td><td>'.$row['Cirujano'].'</td><td>'.$row['Especialidad'].'</td><td>'.$row['Día'].'</td><td>'.$estado.'</td>';

        if($tipo == 'WEB')
          $tabla .= '<td class="text-nowrap"><div class="action-buttons">
            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Editar" aria-describedby="tooltip'.$row['Id'].'" id="btneditar_'.$row['Id'].'"> <i  id="btneditar_'.$row['Id'].'" class="fa fa-pencil-alt text-105"><input type="hidden" id="nombre_'.$row['Id'].'" name="nombre_'.$row['Id'].'" value="'.$row['Cirujano'].'" /> </i> </a> 

            <a href="#" class="text-danger-m1 mx-1" data-toggle="tooltip" data-original-title="Inactivar" id="btninactivar_'.$row['Id'].'"> <i id="btninactivar_'.$row['Id'].'" class="fa fa-trash-alt text-105"></i> </a>

            <a href="#" class="text-blue mx-1" data-toggle="tooltip" data-original-title="Ver Registro" aria-describedby="tooltip'.$row['Id'].'" id="btndetalle_'.$row['Id'].'"> <i  id="btndetalle_'.$row['Id'].'" class="fa fa-search-plus text-105"></i> </a> 
            </div></td>';

        $tabla .= '</tr>';
      }
      $tabla .= '</tbody>';

      return $tabla;
    }
  }

}