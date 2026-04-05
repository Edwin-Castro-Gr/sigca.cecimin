<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Helper que carga el menú principal parametrizable
 **/
if ( ! function_exists('cargar_menu_principal')){
  function cargar_menu_principal($perfil) {
    $CI =& get_instance();

    // Obtener usuario actual
    $id_usuario = $CI->session->userdata('C_id_usuario');
    $id_perfil = $perfil;

    // Verificar si las tablas de menú existen
    $tables_exist = $CI->db->table_exists('menu_modulos') && $CI->db->table_exists('menu_permisos');

    if (!$tables_exist) {
      // Si las tablas no existen, mostrar menú completo (modo compatibilidad)
      return cargar_menu_completo($perfil);
    }

    try {
      // Obtener permisos del usuario
      $permisos = $CI->general_model->get_menu_permisos_usuario($id_usuario, $id_perfil);

      // Obtener módulos activos
      $modulos = $CI->general_model->get_modulos_activos();
    } catch (Exception $e) {
      // En caso de error, mostrar menú completo
      return cargar_menu_completo($perfil);
    }

    // Parsear URL actual
    $url = explode("/", $_SERVER['REQUEST_URI']);
    $pag = ($url[1] != "index.php") ? $url[1] : $url[2];

    // Arrays para clases CSS (mantener compatibilidad)
    $men_pri = array_fill(0, 21, '');
    $men_sub = array_fill(0, 61, '');
    $men_ter = array_fill(0, 21, '');
    $men_cua = array_fill(0, 11, ' collapsed');

    // Mapa de módulos a índices del array (para compatibilidad con CSS existente)
    $modulo_indices = [
        'a_arl' => ['pri'=> 0,'sub'=> 1],
        'a_cargos' => ['pri' => 0,'sub'=>2],
        'a_centros' => ['pri' => 0,'sub' => 3],
        'a_areas' => ['pri' => 0,'sub' => 4],
        'a_empleados' => ['pri' => 0,'sub' => 5],
        'a_empresa' => ['pri' => 0,'sub' => 6],
        'a_eps' => ['pri' => 0,'sub' => 7],
        'a_lineacostos' => ['pri' => 0,'sub' => 8],
        'a_pacientes' => ['pri' => 0,'sub' => 9],
        'a_configuraciones' => ['pri' => 0,'sub' => 10],
        'a_politicas' => ['pri' => 0,'sub' => 11],
        'a_procesos' => ['pri' => 0,'sub' => 12],
        'a_subprocesos' => ['pri' => 0,'sub' => 13],
        'c_tarifas' => ['pri' => 0,'sub' => 14],
        'a_terceros' => ['pri' => 0,'sub' => 15],
        'a_usuarios' => ['pri' => 0,'sub' => 16],
        'cc_costosg' => ['pri' => 1,'sub' => 17],
        'cc_gastosg' => ['pri' => 1,'sub' => 18],
        'cc_consolidados' => ['pri' => 1,'sub' => 19],
        'cc_insumosm' => ['pri' => 1,'sub' => 20],
        'cc_manoobraplanta' => ['pri' => 1,'sub' => 21],
        'cc_manoobraprestacion' => ['pri' => 1,'sub' => 22],
        'cc_suministros' => ['pri' => 1,'sub' => 23],
        'd_consultas' => ['pri' => 2,'sub' => 24],
        'a_documentos' => ['pri' => 2,'sub' => 25],
        'd_doc_institucionales' => ['pri' => 2,'sub' => 26],
        'd_solicitud' => ['pri' => 2,'sub' => 27],
        'capacitaciones' => ['pri' => 3,'sub' => 28],
        'evaluaciones' => ['pri' => 3,'sub' => 29],
        'c_ingresop' => ['pri' => 4,'sub' => 30],
        'c_egresop'  => ['pri' => 4,'sub' => 31],
        'a_contratos' => ['pri' => 4,'sub' => 32],
        'd_contratost' => ['pri' => 4,'sub' => 33],
        'd_conceptos' => ['pri' => 4,'sub' => 34],
        'c_checklist_doc' => ['pri' => 4,'sub' => 35],
        'r_actas' => ['pri' => 5,'sub' => 36],
        'citas_medicamentos' => ['pri' => 5,'sub' => 37],
        'encuesta' => ['pri' => 5,'sub' => 38],
        'contactenos' => ['pri' => 5,'sub' => 39],
        'plan_mejora' => ['pri' => 5,'sub' => 40],
        'pqrs' => ['pri' => 5,'sub' => 41],
        'r_resultadosDx' => ['pri' => 5,'sub' => 42],
        'c_seguimientocx' => ['pri' => 5,'sub' => 43],
        'rep_suceso_seguridad' => ['pri' => 5,'sub' => 44],
        'm_solicitud' => ['pri' => 6,'sub' => 45],
        'm_calendario' => ['pri' => 6,'sub' => 46],
        'c_agendaqx' => ['pri' => 7,'sub' => 47],
        'c_programacion' => ['pri' => 7,'sub' => 48],
        'c_bloquesQx' => ['pri' => 7,'sub' => 49],
        'c_materiales' => ['pri' => 7,'sub' => 50],
        'cc_cirugias' => ['pri' => 7,'sub' => 51],
        'c_procedimientos' => ['pri' => 7,'sub' => 52],
        'c_programacion' => ['pri' => 7,'sub' => 53],
        'rondas_gestion' => ['pri' => 8,'sub' => 54],
        'rondas_admin' => ['pri' => 8,'sub' => 55],
        'rondas_reporte' => ['pri' => 8,'sub' => 55]

    ];

    // Aplicar clase active si el módulo actual está en la URL
    if (isset($modulo_indices[$pag])) {
        $indices = $modulo_indices[$pag];
        $men_pri[$indices['pri']] = ' active open';
        $men_sub[$indices['sub']] = ' active';
        $men_ter[$indices['pri']] = ' show';
        $men_cua[$indices['pri']] = '';
    }

    // Filtrar módulos visibles según permisos
    $modulos_visibles = [];
    foreach ($modulos as $modulo) {
        $visible = isset($permisos[$modulo->modulo]) ? $permisos[$modulo->modulo] : 1; // Por defecto visible
        if ($visible) {
            $modulos_visibles[$modulo->modulo] = true;
        }
    }

    // Función helper para verificar si módulo es visible
    $es_visible = function($modulo) use ($modulos_visibles) {
        return isset($modulos_visibles[$modulo]) || empty($modulos_visibles); // Si no hay permisos, mostrar todo
    };

    // Generar menú dinámico
    $salida = '<li class="nav-item-caption"><span class="fadeable pl-3">Principal</span><span class="fadeinable mt-n2 text-125">&hellip;</span></li>';

    // Menu Perfil Administrador y Gerencial
    if($perfil == 0 || $perfil == 1) {
      $salida .= '
        <li class="nav-item '.$men_pri[0].'">
          <a href="#" class="nav-link dropdown-toggle '.$men_cua[0].'">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <span class="nav-text fadeable"><span>Administración</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse '.$men_ter[0].'">
            <ul class="submenu-inner">';
      
      if ($es_visible('a_arl')) {
        $salida .= '<li class="nav-item '.$men_sub[1].'">'.anchor(('a_arl/index'),'<span class="nav-text"><span>Administradoras de Riesgos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_cargos')) {
        $salida .= '<li class="nav-item '.$men_sub[2].'">'.anchor(('a_cargos/index'),'<span class="nav-text"><span>Cargos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_centros')) {
        $salida .= '<li class="nav-item '.$men_sub[3].'">'.anchor(('a_centros/index'),'<span class="nav-text"><span>Centros de costos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_areas')) {
        $salida .= '<li class="nav-item '.$men_sub[4].'">'.anchor(('a_areas/index'),'<span class="nav-text"><span>Departamentos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_empleados')) {
        $salida .= '<li class="nav-item '.$men_sub[5].'">'.anchor(('a_empleados/index'),'<span class="nav-text"><span>Empleados</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_empresa')) {
        $salida .= '<li class="nav-item '.$men_sub[6].'">'.anchor(('a_empresa/index'),'<span class="nav-text"><span>Empresa</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_eps')) {
        $salida .= '<li class="nav-item '.$men_sub[7].'">'.anchor(('a_eps/index'),'<span class="nav-text"><span>Entidades Pagadoras</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_lineacostos')) {
        $salida .= '<li class="nav-item '.$men_sub[8].'">'.anchor(('a_lineacostos/index'),'<span class="nav-text"><span>Linea de Costos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_pacientes')) {
        $salida .= '<li class="nav-item '.$men_sub[9].'">'.anchor(('a_pacientes/index'),'<span class="nav-text"><span>Pacientes</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_configuraciones')) {
        $salida .= '<li class="nav-item '.$men_sub[10].'">'.anchor(('a_configuraciones/index'),'<span class="nav-text"><span>Parametrización</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_politicas')) {
        $salida .= '<li class="nav-item '.$men_sub[11].'">'.anchor(('a_politicas/index'),'<span class="nav-text"><span>Politicas</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_procesos')) {
        $salida .= '<li class="nav-item '.$men_sub[12].'">'.anchor(('a_procesos/index'),'<span class="nav-text"><span>Procesos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_subprocesos')) {
        $salida .= '<li class="nav-item '.$men_sub[13].'">'.anchor(('a_subprocesos/index'),'<span class="nav-text"><span>Subprocesos</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('c_tarifas')) {
        $salida .= '<li class="nav-item '.$men_sub[14].'">'.anchor(('c_tarifas/index'),'<span class="nav-text"><span>Tarifas</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_terceros')) {
        $salida .= '<li class="nav-item '.$men_sub[15].'">'.anchor(('a_terceros/index'),'<span class="nav-text"><span>Terceros</span></span>','class="nav-link"').'</li>';
      }
      if ($es_visible('a_usuarios')) {
        $salida .= '<li class="nav-item '.$men_sub[16].'">'.anchor(('a_usuarios/index'),'<span class="nav-text"><span>Usuarios</span></span>','class="nav-link"').'</li>';
      }
      $salida .= '
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';
      
      // Modulo Gestión de Contratos
      if ($es_visible('ingresoP') || $es_visible('egresoP') || $es_visible('a_contratos') || $es_visible('d_contratost') || $es_visible('d_conceptos') || $es_visible('d_checklist') || $es_visible('a_consultasct')) {
        $salida .= '
          <li class="nav-item '.$men_pri[1].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[1].'">
              <i class="nav-icon far fa-id-card"></i>
              <span class="nav-text fadeable"><span>Gestión de Contratos</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[1].'">
              <ul class="submenu-inner">';
        if ($es_visible('ingresoP')) {
          $salida .= '<li class="nav-item '.$men_sub[30].'">'.anchor(('c_ingresop/index'),'<span class="nav-text"><span>Ingreso de Personal</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('egresoP')) {
          $salida .= '<li class="nav-item '.$men_sub[31].'">'.anchor(('c_egresop/index'),'<span class="nav-text"><span>Egreso de Personal</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('a_contratos')) {
          $salida .= '<li class="nav-item '.$men_sub[32].'">'.anchor(('a_contratos/index'),'<span class="nav-text"><span>Contratos Personal</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('d_contratost')) {
          $salida .= '<li class="nav-item '.$men_sub[33].'">'.anchor(('d_contratost/index'),'<span class="nav-text"><span>Contratos Terceros</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('d_conceptos')) {
          $salida .= '<li class="nav-item '.$men_sub[34].'">'.anchor(('d_conceptos/index'),'<span class="nav-text"><span>Conceptos de Contratos</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('d_checklist')) {
          $salida .= '<li class="nav-item '.$men_sub[35].'">'.anchor(('c_checklist_doc/index'),'<span class="nav-text"><span>Checklist de Contratos</span></span>','class="nav-link"').'</li>';
        }
        /*if ($es_visible('a_consultasct')) {
          $salida .= '<li class="nav-item '.$men_sub[19].'">'.anchor(('a_consultasct/index'),'<span class="nav-text"><span>Consultas de Contratos</span></span>','class="nav-link"').'</li>';
        }*/
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Modulo Documentos
      if ($es_visible('d_solicitud') || $es_visible('a_documentos') || $es_visible('d_doc_institucionales') || $es_visible('d_consultas')) {
        $salida .= '
          <li class="nav-item '.$men_pri[2].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[2].'">
              <i class="nav-icon fas fa-file-medical"></i>
              <span class="nav-text fadeable"><span>Documentos</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[2].'">
              <ul class="submenu-inner">';
        if ($es_visible('d_solicitud')) {
          $salida .= '<li class="nav-item '.$men_sub[27].'">'.anchor(('d_solicitud/index'),'<span class="nav-text"><span>Solicitud</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('a_documentos')) {
          $salida .= '<li class="nav-item '.$men_sub[25].'">'.anchor(('a_documentos/index'),'<span class="nav-text"><span>Documentos</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('d_doc_institucionales')) {
          $salida .= '<li class="nav-item '.$men_sub[26].'">'.anchor(('d_doc_institucionales/index'),'<span class="nav-text"><span>Documentos Institucionales</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('d_consultas')) {
          $salida .= '<li class="nav-item '.$men_sub[24].'">'.anchor(('d_consultas/index'),'<span class="nav-text"><span>Consultas</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Procedimientos
      if ($es_visible('c_procedimientos') || $es_visible('c_materiales') || $es_visible('c_programacion') || $es_visible('reporte') || $es_visible('c_bloquesQx') || $es_visible('c_seguimientocx') || $es_visible('c_agendaqx')) {
        $salida .= '
          <li class="nav-item '.$men_pri[3].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[3].'">
              <i class="nav-icon fas fa-briefcase-medical"></i>
              <span class="nav-text fadeable"><span>Procedimientos</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[3].'">
              <ul class="submenu-inner">';
        if ($es_visible('c_procedimientos')) {
          $salida .= '<li class="nav-item '.$men_sub[52].'">'.anchor(('c_procedimientos/index'),'<span class="nav-text"><span>Procedimientos CX</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('c_materiales')) {
          $salida .= '<li class="nav-item '.$men_sub[50].'">'.anchor(('c_materiales/index'),'<span class="nav-text"><span>Materiales e Insumos</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('c_programacion')) {
          $salida .= '<li class="nav-item '.$men_sub[48].'">'.anchor(('c_programacion/index'),'<span class="nav-text"><span>Agendamiento Sala Qx</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('reporte')) {
          $salida .= '<li class="nav-item '.$men_sub[53].'">'.anchor(('c_programacion/reporte'),'<span class="nav-text"><span>Reporte</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('c_bloquesQx')) {
          $salida .= '<li class="nav-item '.$men_sub[49].'">'.anchor(('c_bloquesQx/index'),'<span class="nav-text"><span>Bloques</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('c_seguimientocx')) {
          $salida .= '<li class="nav-item '.$men_sub[43].'">'.anchor(('c_seguimientocx/index'),'<span class="nav-text"><span>Seguimiento a Pacientes</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('c_agendaqx')) {
          $salida .= '<li class="nav-item '.$men_sub[55].'">'.anchor(('c_agendaqx/index'),'<span class="nav-text"><span>Agenda Quirúrgica</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Costos
      if ($es_visible('cc_cirugias') || $es_visible('cc_suministros') || $es_visible('cc_insumosm') || $es_visible('cc_manoobraplanta') || $es_visible('cc_manoobraprestacion') || $es_visible('cc_costosg') || $es_visible('cc_gastosg') || $es_visible('cc_consolidados')) {
        $salida .= '
          <li class="nav-item '.$men_pri[4].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[4].'">
              <i class="nav-icon fas fa-tasks"></i>
              <span class="nav-text fadeable"><span>Costos</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[4].'">
              <ul class="submenu-inner">';
        if ($es_visible('cc_cirugias')) {
          $salida .= '<li class="nav-item '.$men_sub[51].'">'.anchor(('cc_cirugias/index'),'<span class="nav-text"><span>Procedimientos</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_suministros')) {
          $salida .= '<li class="nav-item '.$men_sub[23].'">'.anchor(('cc_suministros/index'),'<span class="nav-text"><span>Suministros</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_insumosm')) {
          $salida .= '<li class="nav-item '.$men_sub[20].'">'.anchor(('cc_insumosm/index'),'<span class="nav-text"><span>Insumos Médico Qx</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_manoobraplanta')) {
          $salida .= '<li class="nav-item '.$men_sub[21].'">'.anchor(('cc_manoobraplanta/index'),'<span class="nav-text"><span>Mano de Obra Planta</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_manoobraprestacion')) {
          $salida .= '<li class="nav-item '.$men_sub[22].'">'.anchor(('cc_manoobraprestacion/index'),'<span class="nav-text"><span>Mano de Obra Prestación</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_costosg')) {
          $salida .= '<li class="nav-item '.$men_sub[17].'">'.anchor(('cc_costosg/index'),'<span class="nav-text"><span>Costos Generales</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_gastosg')) {
          $salida .= '<li class="nav-item '.$men_sub[18].'">'.anchor(('cc_gastosg/index'),'<span class="nav-text"><span>Gastos Generales</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('cc_consolidados')) {
          $salida .= '<li class="nav-item '.$men_sub[19].'">'.anchor(('cc_consolidados/index'),'<span class="nav-text"><span>Informes</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Gestión de Capacitaciones
      if ($es_visible('capacitaciones') || $es_visible('evaluaciones')) {
        $salida .= '
          <li class="nav-item '.$men_pri[5].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[5].'">
              <i class="nav-icon fas fa-edit"></i>
              <span class="nav-text fadeable"><span>Gestión de Capacitaciones</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[5].'">
              <ul class="submenu-inner">';
        if ($es_visible('capacitaciones')) {
          $salida .= '<li class="nav-item '.$men_sub[28].'">'.anchor(('capacitaciones/index'),'<span class="nav-text"><span>Capacitaciones</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('evaluaciones')) {
          $salida .= '<li class="nav-item '.$men_sub[29].'">'.anchor(('evaluaciones/index'),'<span class="nav-text"><span>Evaluaciones</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Gestión de Registros
      if ($es_visible('encuesta') || $es_visible('contactenos') || $es_visible('pqrs') || $es_visible('inf2') || $es_visible('citas_medicamentos') || $es_visible('sucesos_seguridad') || $es_visible('plan_mejora') || $es_visible('actas') || $es_visible('resultados_dx')) {
        $salida .= '
          <li class="nav-item '.$men_pri[8].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[8].'">
              <i class="nav-icon fa fa-table"></i>
              <span class="nav-text fadeable"><span>Gestión de Registros</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[8].'">
              <ul class="submenu-inner">';
        if ($es_visible('actas')) {
          $salida .= '<li class="nav-item '.$men_sub[36].'">'.anchor(('r_actas/index'),'<span class="nav-text"><span>Actas</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('citas_medicamentos')) {
          $salida .= '<li class="nav-item '.$men_sub[37].'">'.anchor(('citas_medicamentos/listado'),'<span class="nav-text"><span>Citas Medicamentos</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('encuesta')) {
          $salida .= '<li class="nav-item '.$men_sub[39].'">'.anchor(('contactenos/reporte'),'<span class="nav-text"><span>Gestión PQRS</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('contactenos')) {
          $salida .= '<li class="nav-item '.$men_sub[38].'">'.anchor(('encuesta/reportes'),'<span class="nav-text"><span>Encuestas de Satisfacción</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('plan_mejora')) {
          $salida .= '<li class="nav-item '.$men_sub[40].'">'.anchor(('plan_mejora/index'),'<span class="nav-text"><span>Plan de Mejora</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('pqrs')) {
          $salida .= '<li class="nav-item '.$men_sub[41].'">'.anchor(('contactenos/pqrs'),'<span class="nav-text"><span>PQRS</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('resultados_dx')) {
          $salida .= '<li class="nav-item '.$men_sub[42].'">'.anchor(('r_resultadosDx/index'),'<span class="nav-text"><span>Resultados Apoyo Dx</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('sucesos_seguridad')) {
          $salida .= '<li class="nav-item '.$men_sub[44].'">'.anchor(('rep_suceso_seguridad/reportes'),'<span class="nav-text"><span>Sucesos de Seguridad</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Rondas de Seguridad
      if ($es_visible('rondas_gestion') || $es_visible('rondas_admin') || $es_visible('rondas_reporte')) {
        $salida .= '
          <li class="nav-item '.$men_pri[9].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[9].'">
              <i class="nav-icon fa fa-tasks"></i>
              <span class="nav-text fadeable"><span>Rondas de Seguridad</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[9].'">
              <ul class="submenu-inner">';
        if ($es_visible('rondas_gestion')) {
          $salida .= '<li class="nav-item '.$men_sub[55].'">'.anchor(('r_gestion/index'),'<span class="nav-text"><span>Gestión</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('rondas_admin')) {
          $salida .= '<li class="nav-item '.$men_sub[54].'">'.anchor(('r_gestion/administracion'),'<span class="nav-text"><span>Configuración</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('rondas_reporte')) {
          $salida .= '<li class="nav-item '.$men_sub[56].'">'.anchor(('r_gestion/informes'),'<span class="nav-text"><span>Informe Rondas</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }

      // Gestión Mantenimientos
      if ($es_visible('m_solicitud') || $es_visible('m_gestion') || $es_visible('m_calendario')) {
        $salida .= '
          <li class="nav-item '.$men_pri[10].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[10].'">
              <i class="nav-icon fa fa-wrench"></i>
              <span class="nav-text fadeable"><span>Gestión Mantenimientos</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[10].'">
              <ul class="submenu-inner">';
        if ($es_visible('m_solicitud')) {
          $salida .= '<li class="nav-item '.$men_sub[45].'">'.anchor(('m_solicitud/index'),'<span class="nav-text"><span>Solicitud</span></span>','class="nav-link"').'</li>';
        }
        if ($es_visible('m_calendario')) {
          $salida .= '<li class="nav-item '.$men_sub[46].'">'.anchor(('m_calendario/index'),'<span class="nav-text"><span>Calendario</span></span>','class="nav-link"').'</li>';
        }
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }
    }elseif($perfil == 2) { // Coordinadores
      
      if ($es_visible('d_consultas')) {
        $salida .= '
          <li class="nav-item '.$men_pri[2].'">
            <a href="#" class="nav-link dropdown-toggle '.$men_cua[2].'">
              <i class="nav-icon fas fa-file-medical"></i>
              <span class="nav-text fadeable"><span>Documentos</span></span>
              <b class="caret fa fa-angle-left rt-n90"></b>
            </a>
            <div class="hideable submenu collapse '.$men_ter[2].'">
              <ul class="submenu-inner">';
        $salida .= '<li class="nav-item '.$men_sub[24].'">'.anchor(('d_consultas/index'),'<span class="nav-text"><span>Consultas</span></span>','class="nav-link"').'</li>';
        $salida .= '
              </ul>
            </div>
            <b class="sub-arrow"></b>
          </li>';
      }
    }
    return $salida;
  }
}

if ( ! function_exists('cargar_menu_completo')){
  function cargar_menu_completo($perfil) {
    // Esta función muestra el menú completo cuando las tablas de permisos no existen
    // Es una versión simplificada del menú original sin parametrización

    $salida = '';

    // Parsear URL actual
    $url = explode("/", $_SERVER['REQUEST_URI']);
    $pag = ($url[1] != "index.php") ? $url[1] : $url[2];

    // Arrays para clases CSS
    $men_pri = array_fill(0, 21, '');
    $men_cua = array_fill(0, 21, '');
    $men_ter = array_fill(0, 21, '');
    $men_sub = array_fill(0, 60, '');

    // Función auxiliar para verificar visibilidad (siempre true en modo compatibilidad)
    $es_visible = function($modulo) { return true; };

    // Lógica del menú según perfil (versión simplificada)
    if($perfil == 0 || $perfil == 1) { // Admin y Super Admin
      // Menú completo para administradores
      $salida .= '
        <li class="nav-item">
          <a href="#" class="nav-link dropdown-toggle">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <span class="nav-text fadeable"><span>Administración</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse">
            <ul class="submenu-inner">
              <li class="nav-item">'.anchor(('a_empresa/index'),'<span class="nav-text"><span>Empresa</span></span>','class="nav-link"').'</li>
              <li class="nav-item">'.anchor(('a_areas/index'),'<span class="nav-text"><span>Áreas</span></span>','class="nav-link"').'</li>
              <li class="nav-item">'.anchor(('a_centros/index'),'<span class="nav-text"><span>Centros</span></span>','class="nav-link"').'</li>
              <li class="nav-item">'.anchor(('a_usuarios/index'),'<span class="nav-text"><span>Usuarios</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

      $salida .= '
        <li class="nav-item">
          <a href="#" class="nav-link dropdown-toggle">
            <i class="nav-icon fas fa-file-medical"></i>
            <span class="nav-text fadeable"><span>Documentos</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse">
            <ul class="submenu-inner">
              <li class="nav-item">'.anchor(('d_doc_institucionales/index'),'<span class="nav-text"><span>Documentos Institucionales</span></span>','class="nav-link"').'</li>
              <li class="nav-item">'.anchor(('d_consultas/index'),'<span class="nav-text"><span>Consultas</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';

    } elseif($perfil == 2) { // Perfil básico
      $salida .= '
        <li class="nav-item">
          <a href="#" class="nav-link dropdown-toggle">
            <i class="nav-icon fas fa-file-medical"></i>
            <span class="nav-text fadeable"><span>Documentos</span></span>
            <b class="caret fa fa-angle-left rt-n90"></b>
          </a>
          <div class="hideable submenu collapse">
            <ul class="submenu-inner">
              <li class="nav-item">'.anchor(('d_consultas/index'),'<span class="nav-text"><span>Consultas</span></span>','class="nav-link"').'</li>
            </ul>
          </div>
          <b class="sub-arrow"></b>
        </li>';
    }

    // Agregar más perfiles según sea necesario...

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