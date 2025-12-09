<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * Helper que carga todoas las listas desplegables segun el perfil
 **/
if ( ! function_exists('cargar_menu_principal')){
	function cargar_menu_principal($perfil) {
		
    //echo $_SERVER['REQUEST_URI'];
    $url = explode("/", $_SERVER['REQUEST_URI']);
    
    if($url[1] != "index.php") {
      $pag = $url[1];
      $pag2 = $url[2];
    } else {
      $pag = $url[2];
      $pag2 = $url[3];
    }
    //echo '>>>>>>'.$pag;

    $men_pri = array(0=>'', 1=>'', 2=>'', 3=>'', 4=>'', 5=>'', 6=>'', 7=>'', 8=>'', 9=>'', 10=>'');
    $men_sub = array(0=>'', 1=>'', 2=>'', 3=>'', 4=>'', 5=>'', 6=>'', 7=>'', 8=>'', 9=>'', 10=>'', 11=>'', 12=>'', 13=>'', 14=>'', 15=>'',16=>'',17=>'',18=>'');
    $men_ter = array(0=>'', 1=>'', 2=>'', 3=>'', 4=>'', 5=>'', 6=>'', 7=>'', 8=>'', 9=>'', 10=>'');
    $men_cua = array(0=>' collapsed', 1=>' collapsed', 2=>'', 3=>'', 4=>'', 5=>'', 6=>'', 7=>'', 8=>'', 9=>'', 10=>'');
    switch($pag) {
      case 'a_empresa': $men_pri[0] = ' active open'; $men_sub[0] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_areas': $men_pri[0] = ' active open'; $men_sub[1] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_centros': $men_pri[0] = ' active open'; $men_sub[2] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_cargos': $men_pri[0] = ' active open'; $men_sub[3] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_empleados': $men_pri[0] = ' active open'; $men_sub[4] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_procesos': $men_pri[0] = ' active open'; $men_sub[5] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_subprocesos': $men_pri[0] = ' active open'; $men_sub[6] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_documentos': $men_pri[0] = ' active open'; $men_sub[7] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_contratos': $men_pri[0] = ' active open'; $men_sub[8] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_proovedores': $men_pri[0] = ' active open'; $men_sub[9] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_usuarios': $men_pri[0] = ' active open'; $men_sub[10] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_politicas': $men_pri[0] = ' active open'; $men_sub[11] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;
      case 'a_terceros': $men_pri[0] = ' active open'; $men_sub[12] = ' active'; $men_ter[0] = ' show'; $men_cua[0] = ''; break;

      case 'documentos':  $men_pri[1] = ' active'; 
      switch($pag2) {
            case 'd_solicitud': $men_sub[13] = ' active'; $men_ter[1] = ' show'; $men_cua[0] = ''; break;
            case 'd_contratost': $men_sub[14] = ' active'; $men_ter[1] = ' show'; $men_cua[0] = ''; break;
            case 'd_consulta': $men_sub[15] = ' active'; $men_ter[1] = ' show'; $men_cua[0] = ''; break;
            
          } break;
      case 'registros':  $men_pri[2] = ' active'; break;
      case 'indicadores':  $men_pri[3] = ' active'; break;
      case 'eventos':  $men_pri[4] = ' active'; break;
      

      case 'informes':  $men_pri[5] = ' active open'; 
          switch($pag2) {
            case 'inf1': $men_sub[16] = ' active'; $men_ter[2] = ' show'; $men_cua[0] = ''; break;
            case 'inf2': $men_sub[17] = ' active'; $men_ter[2] = ' show'; $men_cua[0] = ''; break;
            
          }
          break;

    }
  
		$salida='<li class="nav-item-caption"><span class="fadeable pl-3">Principal</span><span class="fadeinable mt-n2 text-125">&hellip;</span></li>';
    
    if($perfil == 0 || $perfil == 1) {
      $salida .= '
        <li class="nav-item '.$men_pri[0].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <span class="nav-text fadeable"><span>Administración</span></span>
            <b class="caret fa fa-cog rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[0].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[0].'">'.anchor(('a_empresa/index'),'<span class="nav-text"><span>Empresa</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[1].'">'.anchor(('a_areas/index'),'<span class="nav-text"><span>Departamentos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[2].'">'.anchor(('a_centros/index'),'<span class="nav-text"><span>Centros de costos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[3].'">'.anchor(('a_cargos/index'),'<span class="nav-text"><span>Cargos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[4].'">'.anchor(('a_empleados/index'),'<span class="nav-text"><span>Empleados</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[5].'">'.anchor(('a_procesos/index'),'<span class="nav-text"><span>Procesos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[6].'">'.anchor(('a_subprocesos/index'),'<span class="nav-text"><span>Subprocesos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[7].'">'.anchor(('a_documentos/index'),'<span class="nav-text"><span>Documentos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[8].'">'.anchor(('a_contratos/index'),'<span class="nav-text"><span>Contratos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[9].'">'.anchor(('a_proveedores/index'),'<span class="nav-text"><span>Proveedores</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[10].'">'.anchor(('a_usuarios/index'),'<span class="nav-text"><span>Usuarios</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[11].'">'.anchor(('a_politicas/index'),'<span class="nav-text"><span>Politicas</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[12].'">'.anchor(('a_terceros/index'),'<span class="nav-text"><span>Terceros</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[1].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-cube"></i>
            <span class="nav-text fadeable"><span>Documentos</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[1].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[13].'">'.anchor(('d_solicitud/index'),'<span class="nav-text"><span>Solicitud</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[14].'">'.anchor(('d_contratost/index'),'<span class="nav-text"><span>Contratos Terceros</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[15].'">'.anchor(('d_consulta/index'),'<span class="nav-text"><span>Consultar</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[2].'">
          '.anchor(('registros/index'),'<i class="nav-icon fa fa-edit"></i><span class="nav-text fadeable"><span>Registros</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[3].'">
          '.anchor(('indicadores/index'),'<i class="nav-icon fa fa-flask"></i><span class="nav-text fadeable"><span>Indicadores</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[4].'">
          '.anchor(('eventos/index'),'<i class="nav-icon far fa-calendar-alt"></i><span class="nav-text fadeable"><span>Eventos</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[5].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-table"></i>
            <span class="nav-text fadeable"><span>Informes</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[2].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[16].'">'.anchor(('inf1/index'),'<span class="nav-text"><span>Informe 1</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[17].'">'.anchor(('inf2/index'),'<span class="nav-text"><span>Informe 2</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';      
    }

    if($perfil == 2) {
      $salida .= '
        <li class="nav-item '.$men_pri[0].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <span class="nav-text fadeable"><span>Administración</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[0].'">
            <ul class="submenu-inner">
              
              <li class="nav-item '.$men_sub[5].'">'.anchor(('a_procesos/index'),'<span class="nav-text"><span>Procesos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[6].'">'.anchor(('a_subprocesos/index'),'<span class="nav-text"><span>Subprocesos</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[7].'">'.anchor(('a_documentos/index'),'<span class="nav-text"><span>Documentos</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[1].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-cube"></i>
            <span class="nav-text fadeable"><span>Documentos</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[1].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[12].'">'.anchor(('d_solicitud/index'),'<span class="nav-text"><span>Solicitud</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[13].'">'.anchor(('d_consulta/index'),'<span class="nav-text"><span>Consultar</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[2].'">
          '.anchor(('registros/index'),'<i class="nav-icon fa fa-edit"></i><span class="nav-text fadeable"><span>Registros</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[3].'">
          '.anchor(('indicadores/index'),'<i class="nav-icon fa fa-flask"></i><span class="nav-text fadeable"><span>Indicadores</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[4].'">
          '.anchor(('eventos/index'),'<i class="nav-icon far fa-calendar-alt"></i><span class="nav-text fadeable"><span>Eventos</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[5].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-table"></i>
            <span class="nav-text fadeable"><span>Informes</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[2].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[14].'">'.anchor(('inf1/index'),'<span class="nav-text"><span>Informe 1</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[15].'">'.anchor(('inf2/index'),'<span class="nav-text"><span>Informe 2</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';      
    }

    if($perfil == 3) {
      // $salida .= '
      //   <li class="nav-item '.$men_pri[0].'">
      //     <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
      //       <i class="nav-icon fa fa-tachometer-alt"></i>
      //       <span class="nav-text fadeable"><span>Administración</span></span>
      //       <b class="caret fa fa-angle-left rt-n90"></b>
      //     </a>
      //     <div class="hideable submenu collapse '.$men_ter[0].'">
      //       <ul class="submenu-inner">
      //         <li class="nav-item '.$men_sub[0].'">'.anchor(('a_empresa/index'),'<span class="nav-text"><span>Empresa</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[1].'">'.anchor(('a_areas/index'),'<span class="nav-text"><span>Departamentos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[2].'">'.anchor(('a_centros/index'),'<span class="nav-text"><span>Centros de costos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[3].'">'.anchor(('a_cargos/index'),'<span class="nav-text"><span>Cargos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[4].'">'.anchor(('a_empleados/index'),'<span class="nav-text"><span>Empleados</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[5].'">'.anchor(('a_procesos/index'),'<span class="nav-text"><span>Procesos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[6].'">'.anchor(('a_subprocesos/index'),'<span class="nav-text"><span>Subprocesos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[7].'">'.anchor(('a_documentos/index'),'<span class="nav-text"><span>Documentos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[8].'">'.anchor(('a_contratos/index'),'<span class="nav-text"><span>Contratos</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[9].'">'.anchor(('a_proveedores/index'),'<span class="nav-text"><span>Proveedores</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[10].'">'.anchor(('a_usuarios/index'),'<span class="nav-text"><span>Usuarios</span></span>','class="nav-link"').'</li>
      //         <li class="nav-item '.$men_sub[11].'">'.anchor(('a_parametros/index'),'<span class="nav-text"><span>Parametros</span></span>','class="nav-link"').'</li>
      //       </ul>
      //     </div>
      //     <b class="sub-arrow"></b>
      //   </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[1].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-cube"></i>
            <span class="nav-text fadeable"><span>Documentos</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[1].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[12].'">'.anchor(('d_solicitud/index'),'<span class="nav-text"><span>Solicitud</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[13].'">'.anchor(('d_consulta/index'),'<span class="nav-text"><span>Consultar</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[2].'">
          '.anchor(('registros/index'),'<i class="nav-icon fa fa-edit"></i><span class="nav-text fadeable"><span>Registros</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[3].'">
          '.anchor(('indicadores/index'),'<i class="nav-icon fa fa-flask"></i><span class="nav-text fadeable"><span>Indicadores</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[4].'">
          '.anchor(('eventos/index'),'<i class="nav-icon far fa-calendar-alt"></i><span class="nav-text fadeable"><span>Eventos</span></span>','class="nav-link"').'<b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item '.$men_pri[5].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-table"></i>
            <span class="nav-text fadeable"><span>Informes</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[2].'">
            <ul class="submenu-inner">
              <li class="nav-item '.$men_sub[14].'">'.anchor(('inf1/index'),'<span class="nav-text"><span>Informe 1</span></span>','class="nav-link"').'</li>
              <li class="nav-item '.$men_sub[15].'">'.anchor(('inf2/index'),'<span class="nav-text"><span>Informe 2</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';      
    }

    
    $salida .= '<li class="nav-devider"></li>';	
    
		return $salida;
	}
}

if ( ! function_exists('cargar_fecha_formateada')){
  function cargar_fecha_formateada() {
    
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
               
    $salida = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

    return utf8_decode($salida);
  }
}

if ( ! function_exists('cargar_fechahora_formateada')){
  function cargar_fechahora_formateada() {
    
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
               
    $salida = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y'). " a las ".date('g:i A');

    return utf8_decode($salida);
  }
}
