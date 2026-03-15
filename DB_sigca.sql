-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-03-2026 a las 01:38:44
-- Versión del servidor: 11.8.3-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u610593899_sigca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `id_acta` int(11) NOT NULL,
  `fecha_reunion` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `lugar` enum('1','2') NOT NULL,
  `proceso` varchar(512) NOT NULL,
  `nombre_reunion` int(11) NOT NULL,
  `otro_nombre` varchar(255) DEFAULT NULL,
  `motivo_reunion` text NOT NULL,
  `id_responsabe` int(11) NOT NULL,
  `objetivos_reunion` text NOT NULL,
  `segumiento_actas` text DEFAULT NULL,
  `detalle_temas` longtext NOT NULL,
  `detalle_decisiones` text NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `estado` enum('1','2','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas_asistentes`
--

CREATE TABLE `actas_asistentes` (
  `id_asistentes` int(11) NOT NULL,
  `id_acta` int(11) NOT NULL,
  `idparticipanteP` int(11) NOT NULL,
  `asistente` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cargo` varchar(256) NOT NULL,
  `firma` enum('0','1') NOT NULL COMMENT '0= ''Falso'', 1=''True''',
  `firmaBase64` mediumblob DEFAULT NULL,
  `fecha_firma` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas_observaciones`
--

CREATE TABLE `actas_observaciones` (
  `id_observacion` int(11) NOT NULL,
  `id_acta` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `responsable` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas_tareas`
--

CREATE TABLE `actas_tareas` (
  `id_tarea` int(11) NOT NULL,
  `id_acta` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `descripcion_tarea` text NOT NULL,
  `estado` enum('1','2','3') NOT NULL COMMENT '1 = ''Asignada'', 2 = ''En Desarrollo'', 3 = ''Cumplida''',
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas_tiporeunion`
--

CREATE TABLE `actas_tiporeunion` (
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion_medicamentos`
--

CREATE TABLE `administracion_medicamentos` (
  `id_solicitud` int(11) NOT NULL,
  `tipo_documento` varchar(2) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre_paciente` varchar(512) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `archivo_orden` varchar(512) NOT NULL,
  `fecha_sugerida1` date NOT NULL,
  `jornada_sugerida1` enum('0','1') NOT NULL COMMENT '0= ''Mañana'', 1= ''Tarde''',
  `fecha_sugerida2` date NOT NULL,
  `jornada_sugerida2` enum('0','1') NOT NULL COMMENT '0= ''Mañana'', 1= ''Tarde''',
  `fecha_sugerida3` date NOT NULL,
  `jornada_sugerida3` enum('0','1') NOT NULL COMMENT '0= ''Mañana'', 1= ''Tarde''',
  `discapacidad` enum('0','1','2','3','4','5') NOT NULL COMMENT '0= ''Ninguna'', 1= ''Discapacidad Fisica'', 1= ''Discapacidad Auditiva'', 2= ''Discapacidad Visual'',3= ''Discapacidad Cognitiva'', 5= ''Embarazo''',
  `proteccion_datos` enum('0','1') NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1','2','3') NOT NULL COMMENT '0= ''Cerrada'', 1=''Recibida'', 2= ''Programada'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion_medicamentos_gestion`
--

CREATE TABLE `administracion_medicamentos_gestion` (
  `id_gestion` int(11) NOT NULL,
  `id_solicitud_medicamentos` int(11) NOT NULL,
  `fecha_programada` date NOT NULL,
  `hora_programada` time NOT NULL,
  `fecha_gestion` datetime NOT NULL,
  `observaciones_gestion` text NOT NULL,
  `archivo_evidencia` text DEFAULT NULL,
  `id_usuario_registra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_medic_gestion`
--

CREATE TABLE `admin_medic_gestion` (
  `id_gestion_medic` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `fecha_programacion` date NOT NULL,
  `jornada_programacion` enum('0','1') NOT NULL COMMENT '0= Mañana, 1= Tarde',
  `observaciones` text NOT NULL,
  `fecha_gestion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL COMMENT '0= Pendiente, 1= Gestionada, 2= Cancelada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `id_centrocosto` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL COMMENT 'es el id del empleado',
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL COMMENT 'usuario que realiza el registro',
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arl`
--

CREATE TABLE `arl` (
  `id_arl` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '''0''= inactivo,''1''=activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `titulo` text NOT NULL,
  `naturaleza` varchar(25) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centroscostos`
--

CREATE TABLE `centroscostos` (
  `id_centrocosto` int(11) NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_linea_costos` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checklist_aprobacion_sol`
--

CREATE TABLE `checklist_aprobacion_sol` (
  `id_check_apro` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_quien_aprueba` int(11) NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checklist_contratost`
--

CREATE TABLE `checklist_contratost` (
  `id_anexo` int(11) NOT NULL,
  `nombre_documento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Inactivo, 1 = Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checklist_revision_sol`
--

CREATE TABLE `checklist_revision_sol` (
  `id_revision` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_quien_revisa` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '''0''="No Revisado",''1''="Revisado"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Revisiones' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chequeo_infraextructura`
--

CREATE TABLE `chequeo_infraextructura` (
  `id_list_infraextructura` int(11) NOT NULL,
  `fecha_insp` datetime NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_usuario_insp` int(11) NOT NULL,
  `id_usuario_area` int(11) NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chequeo_infraextructura_items`
--

CREATE TABLE `chequeo_infraextructura_items` (
  `id_items` int(11) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chequeo_infraextructura_sec`
--

CREATE TABLE `chequeo_infraextructura_sec` (
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0 = Inactivo, 1 = Activo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) DEFAULT 0,
  `user_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ckeklist_contratosp`
--

CREATE TABLE `ckeklist_contratosp` (
  `id_checklist` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `tipo_contrato` int(11) NOT NULL,
  `listado_documentos` varchar(255) NOT NULL,
  `estado` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `id_concepto` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = "inactivo", 1 = "Activo"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos_contratost`
--

CREATE TABLE `conceptos_contratost` (
  `id_concepto` int(11) NOT NULL,
  `prefijo` varchar(3) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `maneja_personal` enum('SI','NO') NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0="Inactivo", 1="Activo"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactenos`
--

CREATE TABLE `contactenos` (
  `id_contacto` int(11) NOT NULL,
  `motivo` enum('0','1','2','3','4') NOT NULL COMMENT '0= Felicitaciones, 1= Sugerencia, 2= Queja, 3= Reclamo, 4= Peticiones.',
  `nombres` varchar(70) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `documento_identidad` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(70) NOT NULL,
  `direccion_residencia` varchar(160) NOT NULL,
  `entidad_EPS` int(11) NOT NULL,
  `otra_entidad` varchar(120) NOT NULL,
  `servicio` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_hecho` date DEFAULT NULL,
  `hora_hecho` time DEFAULT NULL,
  `accion_mejora` text DEFAULT NULL,
  `fecha_accion` datetime DEFAULT NULL,
  `observaciones_cierre` text DEFAULT NULL,
  `usuario_accion` int(11) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `usuario_cierre` int(11) DEFAULT NULL,
  `tratamiento_datos` enum('0','1') NOT NULL COMMENT '0="No", 1="Si"',
  `fecha_registro` datetime NOT NULL,
  `t_gestion` int(11) DEFAULT NULL,
  `estado` enum('0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id_contrato` int(11) NOT NULL,
  `id_ingreso` int(11) NOT NULL DEFAULT 0,
  `id_tipocontrato` int(11) DEFAULT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_centrocosto` int(11) NOT NULL,
  `id_lineacostos` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `jefe_inmediato` int(11) NOT NULL,
  `prorroga` tinyint(1) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL COMMENT '0=Vigente, 1=Terminado, 2=Prorogado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratost_anexos`
--

CREATE TABLE `contratost_anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_checklist_contratot` int(11) NOT NULL,
  `id_contratost` int(11) NOT NULL,
  `archivo` varchar(512) DEFAULT NULL,
  `fecha_ini_vigencia` date NOT NULL,
  `fecha_fin_vigencia` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0 = Inactivo, 1 = Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratost_prorroga`
--

CREATE TABLE `contratost_prorroga` (
  `id_prorroga` int(11) NOT NULL,
  `id_contratot` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_anexos`
--

CREATE TABLE `contratos_anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_checklist_contratos` int(11) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `fecha_ini_vigencia` date DEFAULT NULL,
  `fecha_fin_vigencia` date DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_egresos`
--

CREATE TABLE `contratos_egresos` (
  `id_egresop` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `paz_salvo` text NOT NULL,
  `fecha_egreso` date NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0=''Inactivo'', 1 =''Activo'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_egresos_elementos`
--

CREATE TABLE `contratos_egresos_elementos` (
  `id_elemento` int(11) NOT NULL,
  `id_egreso` int(11) NOT NULL,
  `carnet` tinyint(1) NOT NULL,
  `computador` tinyint(1) NOT NULL,
  `otro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_fileContratos`
--

CREATE TABLE `contratos_fileContratos` (
  `id_archivoc` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `nombre_archivo` varchar(256) NOT NULL,
  `ruta` text NOT NULL,
  `fecha_documento` date NOT NULL,
  `fecha_fvigencia` date NOT NULL,
  `fecha_registro` timestamp NOT NULL,
  `usuario_temp` int(11) NOT NULL,
  `estado_doc` enum('0','1') NOT NULL COMMENT '0=''Inactivo'', 1=''Activo'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_otrosi`
--

CREATE TABLE `contratos_otrosi` (
  `id_otrosi` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `objeto` enum('0','1','2') NOT NULL COMMENT '0= Prorrogar el Contrato, 1= Modificar el Contrato, 3= Otro',
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0= Vigente, 1= Terminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_otrosi_anexos`
--

CREATE TABLE `contratos_otrosi_anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_otrosi` int(11) NOT NULL,
  `nombre_anexo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(512) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_prorroga`
--

CREATE TABLE `contratos_prorroga` (
  `id_prorroga` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `anexo_prorroga` varchar(512) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` smallint(6) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_terceros`
--

CREATE TABLE `contratos_terceros` (
  `id_contrato_tercero` int(11) NOT NULL,
  `numeroint` varchar(100) DEFAULT NULL,
  `n_contrato` varchar(100) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `areas` varchar(10) NOT NULL,
  `linea_costo` varchar(100) NOT NULL,
  `concepto` int(11) NOT NULL,
  `objeto_contrato` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `prorroga` enum('Si','No') NOT NULL COMMENT 'Si=''Si'', No=''No''',
  `cobro` enum('0','1','2','3','4') NOT NULL,
  `valor_contrato` varchar(15) DEFAULT NULL,
  `responsable` int(11) NOT NULL,
  `maneja_tarifa` enum('Si','No') NOT NULL COMMENT 'Si=''Si'', No=''No''',
  `keralty` enum('Si','No') NOT NULL COMMENT 'Si=''Si'', No=''No''',
  `Observaciones` text NOT NULL,
  `clausula_sarlaft` enum('Si','No') NOT NULL COMMENT 'Si="Si",No="No"',
  `maneja_pers` enum('Si','No') NOT NULL COMMENT 'Si = Si, No = No',
  `razon_grupo_k` varchar(255) DEFAULT NULL,
  `nit_grupo_k` varchar(12) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2','3') NOT NULL COMMENT '0+Vigente, 1=Prorogado, 2=Terminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_terceros_personal`
--

CREATE TABLE `contratos_terceros_personal` (
  `id_contratot_personal` int(11) NOT NULL,
  `id_contrato_tercero` int(11) NOT NULL,
  `id_tipdocidentidad` int(11) NOT NULL,
  `doc_identidad` int(11) NOT NULL,
  `nombres_apellidos` varchar(255) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `arl` int(100) NOT NULL,
  `id_eps` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_temp` int(11) NOT NULL,
  `estado` enum('1','0') NOT NULL COMMENT '0="Inactivo", 1="Activa"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_cirugias`
--

CREATE TABLE `c_cirugias` (
  `id_ccirugias` int(11) NOT NULL,
  `periodo` text NOT NULL,
  `id_procedimientoqx` int(13) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_manoobrapresta`
--

CREATE TABLE `c_manoobrapresta` (
  `id_manoobrapresta` int(11) NOT NULL,
  `periodo` varchar(7) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_empleados` int(11) NOT NULL,
  `numero_cargos` int(11) NOT NULL,
  `tipo_vinculacion` enum('1','2','3','4') NOT NULL,
  `salario_estandar` int(11) NOT NULL,
  `salario_promedio` int(11) NOT NULL,
  `valor_empleado_year` int(11) NOT NULL,
  `tiempo_contratado` int(11) NOT NULL,
  `valor_hora` int(11) NOT NULL,
  `tiempo_ufc` int(11) NOT NULL,
  `costo_total_ufc` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_manoobra_planta`
--

CREATE TABLE `c_manoobra_planta` (
  `id_manoobra` int(11) NOT NULL,
  `periodo` varchar(7) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `numero_cargos` int(11) NOT NULL,
  `valor_salario` decimal(10,0) NOT NULL,
  `valor_parafiscales` decimal(10,0) DEFAULT NULL,
  `valor_pension` decimal(10,0) DEFAULT NULL,
  `valor_salud` decimal(10,0) DEFAULT NULL,
  `valor_arl` decimal(10,0) DEFAULT NULL,
  `valor_cesantias` decimal(10,0) DEFAULT NULL,
  `valor_prima` decimal(10,0) DEFAULT NULL,
  `valor_vacaciones` decimal(10,0) DEFAULT NULL,
  `valor_icesantias` decimal(10,0) DEFAULT NULL,
  `valor_auxtrasporte` decimal(10,0) DEFAULT NULL,
  `valor_dotacion` decimal(10,0) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_notidicaciones_enviadas`
--

CREATE TABLE `c_notidicaciones_enviadas` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_anexo_contrato` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `fecha_notificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_suministros`
--

CREATE TABLE `c_suministros` (
  `id_suministro` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `categoria` enum('0','1','2','3','4') NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha_resgistro` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tercero_anexos_personal`
--

CREATE TABLE `c_tercero_anexos_personal` (
  `id_anexo` int(11) NOT NULL,
  `id_contratot_personal` int(11) NOT NULL,
  `cedula_personal` int(11) NOT NULL,
  `contrato_firmado` varchar(255) DEFAULT NULL,
  `hoja_de_vida` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `carnet_vacuna` varchar(255) DEFAULT NULL,
  `cert_altura` varchar(255) DEFAULT NULL,
  `cert_eps` varchar(255) DEFAULT NULL,
  `cert_arl` varchar(255) DEFAULT NULL,
  `id_usuario_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinararios_solicitud`
--

CREATE TABLE `destinararios_solicitud` (
  `id_destinatario` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `id_tipo` char(3) NOT NULL,
  `tipo` enum('0','1') DEFAULT NULL COMMENT '0= Interno, 1= Externo',
  `clase` enum('0','1','2','3','4','5','6','7','8') DEFAULT NULL COMMENT '0= Leyes, 1= Decretos, 2=Resoluciones, 3=Circulares, 4= Acuerdos, 5= Guías de Práctica Clínica, 6= Otras Guías, 7= Otros, 8= No Aplica.',
  `expedido_por` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_macroproceso` char(3) NOT NULL,
  `id_procesomaestro` int(11) DEFAULT NULL,
  `id_subproceso` int(11) DEFAULT NULL,
  `docrelacionado` varchar(50) DEFAULT NULL,
  `codigo` varchar(50) NOT NULL,
  `evaluacion` enum('1','0') NOT NULL,
  `socializacion` enum('0','1') NOT NULL,
  `des_empleados` varchar(60) DEFAULT NULL,
  `des_departamentos` varchar(60) DEFAULT NULL,
  `des_cargos` varchar(60) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_areas`
--

CREATE TABLE `documentos_areas` (
  `id_documentoxarea` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_area` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_cargos`
--

CREATE TABLE `documentos_cargos` (
  `id_documentoxcargo` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_cargo` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_empleados`
--

CREATE TABLE `documentos_empleados` (
  `id_documentoxempleado` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_empleado` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_institucionales`
--

CREATE TABLE `documentos_institucionales` (
  `id_docinstitucional` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clasificacion` enum('0','1','2','3') NOT NULL,
  `periodicidad` enum('0','1','2','3','4') NOT NULL,
  `observaciones` text DEFAULT NULL,
  `id_responsable` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_institucionales_anexos`
--

CREATE TABLE `documentos_institucionales_anexos` (
  `id_anexo_doc_inst` int(11) NOT NULL,
  `id_docinstitucional` int(11) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `fecha_final` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_procesos`
--

CREATE TABLE `documentos_procesos` (
  `id_documentoxproceso` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_socializacion`
--

CREATE TABLE `documentos_socializacion` (
  `id_socializacion` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha_socializacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `evalua` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_versiones`
--

CREATE TABLE `documentos_versiones` (
  `id_version` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `ruta` varchar(150) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `version` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresop`
--

CREATE TABLE `egresop` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `motivo_egreso` text NOT NULL,
  `fecha_egreso` date NOT NULL,
  `achivo_pazsalvo` text NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresop_detalle`
--

CREATE TABLE `egresop_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_egresop` int(11) NOT NULL,
  `elementosd` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `Id_tipdocIdentidad` int(11) NOT NULL,
  `cedula` varchar(18) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `email` varchar(60) NOT NULL,
  `email2` varchar(60) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_eps` int(11) NOT NULL,
  `arl` int(11) NOT NULL,
  `grupo_sanguineo` enum('','A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `nivel_riesgo` varchar(4) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_educacion`
--

CREATE TABLE `empleados_educacion` (
  `id_educacion` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `institucion` varchar(60) NOT NULL,
  `id_tipoeducacion` int(11) NOT NULL,
  `fecha_educacion` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_experiencia`
--

CREATE TABLE `empleados_experiencia` (
  `id_experiencia` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `empresa` varchar(60) NOT NULL,
  `cargo` varchar(60) NOT NULL,
  `cargo_relacionado` varchar(60) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `tiempo` varchar(10) NOT NULL,
  `causa_retiro` varchar(20) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_habilidades`
--

CREATE TABLE `empleados_habilidades` (
  `id_habilidad` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `habilidad` varchar(60) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_infpersonal`
--

CREATE TABLE `empleados_infpersonal` (
  `id_infpersonal` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `sexo` enum('F','M') NOT NULL,
  `libretamilitar` varchar(20) NOT NULL,
  `distritomilitar` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_lugar_nacimiento` int(11) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `id_lugar_residencia` int(11) NOT NULL,
  `telcelular` varchar(11) NOT NULL,
  `telfijo` varchar(11) NOT NULL,
  `id_nivel_educativo` int(11) NOT NULL,
  `id_estado_civil` int(11) NOT NULL,
  `id_grupo_sanguineo` int(11) NOT NULL,
  `id_salud` int(11) NOT NULL,
  `id_pension` int(11) NOT NULL,
  `id_cesantias` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `cuenta_banco` varchar(20) NOT NULL,
  `medevac_entrenado_priauxilios` enum('SI','NO') NOT NULL,
  `medevac_alergias` text NOT NULL,
  `medevac_medicamentos` text NOT NULL,
  `medevac_casoemergenciallamar` varchar(60) NOT NULL,
  `medevac_casoemergenciatelefono` varchar(25) NOT NULL,
  `licencia_conduccion` varchar(3) NOT NULL,
  `talla_camisa` varchar(2) NOT NULL,
  `talla_pantalon` varchar(2) NOT NULL,
  `talla_braga` varchar(2) NOT NULL,
  `talla_calzado` varchar(2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `codigoh` varchar(11) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `celular` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `logo` varchar(512) NOT NULL,
  `actividad_economica` varchar(150) NOT NULL,
  `ciiu` varchar(11) NOT NULL,
  `riesgo` varchar(50) NOT NULL,
  `arl` varchar(50) NOT NULL,
  `caja` varchar(50) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_anexos`
--

CREATE TABLE `empresa_anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre_archivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_documento` date DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_anexos_archivos`
--

CREATE TABLE `empresa_anexos_archivos` (
  `id_archivo` int(11) NOT NULL,
  `id_anexo` int(11) NOT NULL,
  `ruta` varchar(512) NOT NULL,
  `fecha_anexo` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0= Inactivo, 1= Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=PAGE;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_datos_encuestado`
--

CREATE TABLE `encuesta_datos_encuestado` (
  `id_encuesta` int(11) NOT NULL,
  `nombre_encuestado` varchar(255) NOT NULL,
  `tipo_encuestado` enum('1','2') NOT NULL COMMENT '1= Paciente, 2= Acompañante',
  `n_identificacion` int(11) NOT NULL,
  `genero` enum('1','2','3') NOT NULL COMMENT '1= Masculino, 2= Femenino, 3 = Otro',
  `nombre_paciente` varchar(255) DEFAULT NULL,
  `año_nacimiento` year(4) NOT NULL,
  `telefono_fijo` varchar(12) DEFAULT NULL,
  `celular` varchar(12) DEFAULT NULL,
  `entidad_salud` enum('1','2','3','4') NOT NULL COMMENT '1= Colsanitas, 2= Medisanitas, 3= EPS Sanitas, 4= Otra.',
  `otra_entidad_salud` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_objeto`
--

CREATE TABLE `encuesta_objeto` (
  `id_objeto_enc` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_preguntas`
--

CREATE TABLE `encuesta_preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `literal` char(1) NOT NULL,
  `pregunta` varchar(512) NOT NULL,
  `tipo` enum('0','1','2','3') NOT NULL COMMENT '0= Unica Respuesta, 1= Multiples Respuestas, 2= Verdadero - Falso',
  `usuario_registra` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0= Inactivo, 1= Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_respuestas`
--

CREATE TABLE `encuesta_respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0= Inactivo, 1= Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_satisfaccion`
--

CREATE TABLE `encuesta_satisfaccion` (
  `id_encuesta` int(11) NOT NULL,
  `fecha_encuesta` datetime NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `id_encuestado` int(11) NOT NULL,
  `sugerencias` varchar(255) DEFAULT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eps`
--

CREATE TABLE `eps` (
  `id_eps` int(11) NOT NULL,
  `codigo` varchar(8) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '''0''= inactivo, ''1''= activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_personal`
--

CREATE TABLE `ingreso_personal` (
  `id_ingreso` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_centrocostos` int(11) NOT NULL,
  `id_linea_costos` int(11) NOT NULL,
  `id_tipocontrato` int(11) NOT NULL,
  `jefe_inmediato` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_terminacion` date DEFAULT NULL,
  `obserciones_gestion` varchar(255) DEFAULT NULL,
  `id_usuario_gestiona` int(11) DEFAULT NULL,
  `fecha_gestion` datetime DEFAULT NULL,
  `observciones_cierre` text DEFAULT NULL,
  `id_usuario_cierre` int(11) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `anexos_ok` enum('0','1','2','3') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_personal_anexos`
--

CREATE TABLE `ingreso_personal_anexos` (
  `id_anexo_ing` int(11) NOT NULL,
  `id_ingresop` int(11) NOT NULL,
  `id_checklist_contratos` int(11) NOT NULL,
  `archivo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha_ini_vigencia` date NOT NULL,
  `fecha_fin_vigencia` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1','2','3') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_costos`
--

CREATE TABLE `linea_costos` (
  `id_linea_costos` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0="Inactivo", 1="Activo"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_etica`
--

CREATE TABLE `linea_etica` (
  `id` int(11) NOT NULL,
  `tipo_denuncia` varchar(2) NOT NULL,
  `otigen_denuncia` enum('0','1','2','3','4','5') NOT NULL,
  `descipcion_denuncia` text NOT NULL,
  `fecha_hecho` date NOT NULL,
  `hora_hecho` time NOT NULL,
  `nombres` varchar(120) NOT NULL,
  `apellidos` varchar(120) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `email` varchar(512) NOT NULL,
  `politica_datos` enum('0','1') NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_etica_anexos`
--

CREATE TABLE `linea_etica_anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_linea_etica` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `archivo` text NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_etica_origen`
--

CREATE TABLE `linea_etica_origen` (
  `id_origen` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado_documentos`
--

CREATE TABLE `listado_documentos` (
  `id_listado` int(11) NOT NULL,
  `nombre` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_acciones`
--

CREATE TABLE `log_acciones` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `macroprocesos`
--

CREATE TABLE `macroprocesos` (
  `id_macroproceso` char(1) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientosp_notas`
--

CREATE TABLE `mantenimientosp_notas` (
  `id` int(11) NOT NULL,
  `id_manto_programado` int(11) NOT NULL,
  `fecha_nota` date NOT NULL,
  `descripcion_nota` text NOT NULL,
  `usuario_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_anexos`
--

CREATE TABLE `mantenimientos_anexos` (
  `id_anexo_mto` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `ruta_archivo` text NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_anexos_ejecución`
--

CREATE TABLE `mantenimientos_anexos_ejecución` (
  `id_anexo_ejecucion` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `ruta_archivog` text NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_calendario`
--

CREATE TABLE `mantenimientos_calendario` (
  `id_mantemiento` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fechastart` date NOT NULL,
  `fechaEnd` date NOT NULL,
  `className` varchar(512) NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_programacion`
--

CREATE TABLE `mantenimientos_programacion` (
  `id_programacionm` int(11) NOT NULL,
  `id_solicitudm` int(11) NOT NULL,
  `tipo_mantenimiento` enum('1','2','3','4','5') NOT NULL,
  `title` varchar(512) NOT NULL,
  `fecha_programacion_I` date NOT NULL,
  `fecha_programacion_F` date NOT NULL,
  `classN` varchar(512) NOT NULL,
  `observaciones_p` int(11) NOT NULL,
  `prioridad` enum('1','2') NOT NULL,
  `fecha_ejecucion` datetime NOT NULL,
  `observaciones_e` text NOT NULL,
  `fecha_recibido` datetime NOT NULL,
  `observaciones_r` text NOT NULL,
  `usuario_recibe` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_requeridos`
--

CREATE TABLE `mantenimientos_requeridos` (
  `id_mantenimiento_r` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0=inactivo, 1=activo\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_servicios`
--

CREATE TABLE `mantenimientos_servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_solicitudes`
--

CREATE TABLE `mantenimientos_solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `tipo_solicitud` enum('8') NOT NULL,
  `id_manterimientor` int(11) NOT NULL,
  `otros_mantenimientos` text DEFAULT NULL,
  `id_servicio` int(11) NOT NULL,
  `ubicacion` varchar(512) DEFAULT NULL,
  `observaciones` text NOT NULL,
  `id_solicitante` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `fecha_gestion` datetime DEFAULT NULL,
  `observaciones_gestion` text DEFAULT NULL,
  `id_empleado_gestiono` int(11) DEFAULT NULL,
  `estado` enum('0','1','2','3','4') NOT NULL COMMENT '0 =''Radicado'', 1 =''Programado'', 2 = ''Ejecutado'', 3 =''Recibido'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_cx`
--

CREATE TABLE `materiales_cx` (
  `id_material` int(11) NOT NULL,
  `id_procedimiento` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_grupos`
--

CREATE TABLE `materiales_grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_qx`
--

CREATE TABLE `materiales_qx` (
  `id_material` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `nombre_material` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '''0''="Inactivo",''1''="Activo"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_calendar`
--

CREATE TABLE `m_calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `tipo_notificacion` enum('0','1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL COMMENT '0=Solicitud Documentos, 1=Agendamiento Qx,2=Capacitaciones,3=Eventos,4=Medicamentos,5=Contratos Tercero, 6=Contratos Personal,7=Costos,8=Socializacion,9= Sucesos de Seguridad,10= Rondas de Seguridad, 11= Mantenimientos ',
  `id_solicitud` varchar(25) NOT NULL,
  `id_usuario_notifica` int(11) NOT NULL,
  `id_usuario_2` int(11) NOT NULL,
  `observacion` varchar(254) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_visto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Notificaciones' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_solicitud`
--

CREATE TABLE `observaciones_solicitud` (
  `id_observacion` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `q_realiza` enum('0','1','2','3') NOT NULL COMMENT '0="Quien crea",1="Calidad",2="Quien Revisa",3="Quien Aprueba"',
  `descripcion` text DEFAULT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otrosi`
--

CREATE TABLE `otrosi` (
  `id_otrosi` int(11) NOT NULL,
  `id_contratot` int(11) NOT NULL,
  `Observaciones` text NOT NULL,
  `objeto` enum('1','2','3') NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otrosi_anexos`
--

CREATE TABLE `otrosi_anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_otrosi` int(11) NOT NULL,
  `nombre_anexo` varchar(255) DEFAULT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `id_tipodocumento` int(11) NOT NULL,
  `numero_id` varchar(16) NOT NULL,
  `nombres` varchar(65) NOT NULL,
  `apellidos` varchar(65) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_entidad_salud` int(11) NOT NULL,
  `otra_entidad_salud` varchar(65) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(55) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_mejoras`
--

CREATE TABLE `planes_mejoras` (
  `id_plan` int(11) NOT NULL,
  `tipo_fuente` enum('0','1','2','3','4','5','6','7','8','9') NOT NULL COMMENT '0= Rondas, 1= Queja, 2= Sucesos,3= Auditoria, 4= Indicadores, 5= Comite, 6= Acciedente_T',
  `id_fuente` int(11) NOT NULL,
  `tipo_mejora` enum('1','2','3') NOT NULL COMMENT '1= Acción correctiva, 2= Acción Preventiva, 3= Oportunidad de mejora.',
  `id_servicio` int(11) DEFAULT NULL,
  `hallazgo` text DEFAULT NULL,
  `fecha_hallazgo` date DEFAULT NULL,
  `accion_mejora` text NOT NULL,
  `id_detecta` int(11) DEFAULT NULL,
  `correccion` text DEFAULT NULL,
  `responsable` int(11) NOT NULL,
  `fechamaxeje` date NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `responsable_cierre` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1','2','3') NOT NULL COMMENT '0= Pendiente, 1= En gestion, 2= Gestionada, 3= Cerrada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_mejoras_anexos`
--

CREATE TABLE `planes_mejoras_anexos` (
  `id_evidencia` int(11) NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `ruta_archivo` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_mejoras_gestion`
--

CREATE TABLE `planes_mejoras_gestion` (
  `id_gestion` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `numero_actividad` int(11) NOT NULL,
  `actividad` text NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  `fecha_compromiso` datetime DEFAULT NULL,
  `evidencia` text DEFAULT NULL,
  `fecha_evidencia` datetime DEFAULT NULL,
  `completada` tinyint(1) DEFAULT NULL,
  `fecha_completada` datetime DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_mejoras_seguimiento`
--

CREATE TABLE `planes_mejoras_seguimiento` (
  `id_seguimiento` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `comentarios` text NOT NULL,
  `responsable_seguimiento` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_mejora_analisis`
--

CREATE TABLE `planes_mejora_analisis` (
  `id_pm_causas` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `causa_1` int(11) NOT NULL,
  `causa_2` int(11) NOT NULL,
  `causa_3` int(11) NOT NULL,
  `causa_4` int(11) NOT NULL,
  `causa_5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicas`
--

CREATE TABLE `politicas` (
  `id_politica` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos`
--

CREATE TABLE `procedimientos` (
  `id_procedimiento` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0="Inactivo", 1="Activo"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos_cx`
--

CREATE TABLE `procedimientos_cx` (
  `id_procedimiento` int(11) NOT NULL,
  `codigo_cx` varchar(30) DEFAULT NULL,
  `nombre` varchar(512) NOT NULL,
  `tiempo_cx` varchar(5) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` enum('0','1','2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `id_proceso` int(11) NOT NULL,
  `id_macroproceso` varchar(2) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `prefijo` varchar(5) NOT NULL,
  `objetivo` text NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `id_programacion` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_programacion` date NOT NULL,
  `hora_programacion` time NOT NULL,
  `tipo_anestesia` enum('0','1','2','3') NOT NULL,
  `lateralidad` enum('0','1','2','3') NOT NULL,
  `id_cirujano` int(11) NOT NULL,
  `id_2cirujano` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `salaQx` varchar(10) NOT NULL,
  `tiempoQxh` time NOT NULL,
  `id_usuario_r` int(11) DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `observaciones_r` text DEFAULT NULL,
  `fecha_solicitud_materiales` datetime NOT NULL,
  `id_usuario_SM` int(11) NOT NULL,
  `observaciones_sm` text DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2','3') NOT NULL COMMENT '0=''Pendiente'',1=''Revisado'',2=''Aprobado'',3=''Rechazado'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_agenda_cirujano`
--

CREATE TABLE `programacion_agenda_cirujano` (
  `id_agenda` int(11) NOT NULL,
  `id_cirujano` int(11) NOT NULL,
  `id_dia` enum('1','2','3','4','5','6') NOT NULL COMMENT '1= Lunes,2= Martes, 3= Miercoles, 4= Jueves, 5= Viernes, 6= Sabado.',
  `frecuencia` enum('0','1','2','3') NOT NULL COMMENT '0=''Semanal'', 1=''Quincenal'', 2=''Mensual''',
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_envio_correo`
--

CREATE TABLE `programacion_envio_correo` (
  `id_envio` int(11) NOT NULL,
  `id_programacion` int(11) NOT NULL,
  `material1` varchar(255) DEFAULT NULL,
  `casa1` varchar(70) DEFAULT NULL,
  `correo1` varchar(50) DEFAULT NULL,
  `observaciones1` text DEFAULT NULL,
  `material2` varchar(255) DEFAULT NULL,
  `casa2` varchar(70) DEFAULT NULL,
  `correo2` varchar(50) DEFAULT NULL,
  `observaciones2` text DEFAULT NULL,
  `material3` varchar(255) DEFAULT NULL,
  `casa3` varchar(70) DEFAULT NULL,
  `correo3` varchar(50) DEFAULT NULL,
  `observaciones3` text DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_materiales`
--

CREATE TABLE `programacion_materiales` (
  `id_pro_materiales` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_procedimiento_prog` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_procedimientos`
--

CREATE TABLE `programacion_procedimientos` (
  `id_procedimiento_prog` int(11) NOT NULL,
  `id_programacion` int(11) NOT NULL,
  `id_procedimiento` int(11) NOT NULL,
  `descripcion_px` varchar(255) DEFAULT NULL,
  `materiales` varchar(50) DEFAULT NULL,
  `otros` varchar(255) DEFAULT NULL,
  `proveedor_material` varchar(20) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_temp` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '	0="Inactivo", 1="Activa"	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prorroga_ct`
--

CREATE TABLE `prorroga_ct` (
  `id_prorroga` int(11) NOT NULL,
  `id_contratot` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `Observaciones` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_curso_cx`
--

CREATE TABLE `p_curso_cx` (
  `id_cirugia` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `nombres` varchar(512) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` enum('0','1','2','3') NOT NULL COMMENT '0='''', 1=''Masculino'', 2=''Femenino'', 3=''Otro''',
  `servicio` enum('0','1','2','3','4','5','6','7','8') NOT NULL,
  `Telefono_paciente` varchar(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `id_eps` int(11) NOT NULL,
  `id_entidad` int(11) NOT NULL,
  `fecha_Cx` date NOT NULL,
  `hora_Cx` time NOT NULL,
  `procedimiento` int(11) NOT NULL,
  `id_cirujano` int(11) NOT NULL,
  `id_anest` int(11) DEFAULT NULL,
  `tipoAnestesia` enum('0','1','2') NOT NULL,
  `tiempo` time NOT NULL,
  `llamadas` enum('1','2','3','0') DEFAULT NULL COMMENT '1="Primera Llamada", 2="Segunda Llamada", 3="Tercera Llamada", 0="Sin contactar"',
  `estado` enum('0','1','2') NOT NULL COMMENT '0="Sin Seguimiento", 1="En Seguimiento", 2="Cerrada" ',
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_curso_cx_cancelacion`
--

CREATE TABLE `p_curso_cx_cancelacion` (
  `id_cancelacion` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `motivo` varchar(512) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_cancelacion` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_registra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_seguimiento_L1`
--

CREATE TABLE `p_seguimiento_L1` (
  `id_seguimientoPL` int(11) NOT NULL,
  `id_p_cirugia` int(11) NOT NULL,
  `fecha_llamada` date NOT NULL,
  `responde` enum('0','1') NOT NULL COMMENT '0=''No'', 1=''Si''',
  `dolor` enum('0','1') NOT NULL COMMENT '0=''No'', 1=''Si''',
  `sangrado` enum('0','1') NOT NULL COMMENT '0=''No'', 1=''Si''',
  `otros_sintomas` enum('0','1') NOT NULL COMMENT '0=''No'', 1=''Si''',
  `cuales` varchar(512) DEFAULT NULL,
  `fecha_control` date NOT NULL,
  `observaciones` text NOT NULL,
  `informo_paciente` enum('0','1') NOT NULL,
  `informa` varchar(256) DEFAULT NULL,
  `id_funcionario_llama` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_seguimiento_L2`
--

CREATE TABLE `p_seguimiento_L2` (
  `id_seguimientoSL` int(11) NOT NULL,
  `id_p_cirugia` int(11) NOT NULL,
  `fecha_llamada2` date NOT NULL,
  `responde2` enum('0','1') NOT NULL,
  `finalizo_medicamentos` enum('0','1') NOT NULL,
  `calor` enum('0','1') NOT NULL,
  `rubor` enum('0','1') NOT NULL,
  `inflamacion` enum('0','1') NOT NULL,
  `secrecion` enum('0','1') NOT NULL,
  `otros_signos` enum('0','1') NOT NULL,
  `cuales2` varchar(255) DEFAULT NULL,
  `finalizo_controles2` enum('0','1') NOT NULL,
  `observacion2` varchar(512) NOT NULL,
  `informo_paciente` enum('0','1') NOT NULL,
  `informo` varchar(512) DEFAULT NULL,
  `id_auxiliar_llamo` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_seguimiento_L3`
--

CREATE TABLE `p_seguimiento_L3` (
  `id_seguimientoTL` int(11) NOT NULL,
  `id_p_cirugia` int(11) NOT NULL,
  `fecha_llamada` date NOT NULL,
  `responde` enum('0','1') NOT NULL,
  `observaciones` varchar(512) NOT NULL,
  `informo_paciente` enum('0','1') NOT NULL,
  `informo` varchar(255) DEFAULT NULL,
  `id_auxiliar_llamo` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_dx`
--

CREATE TABLE `resultados_dx` (
  `id_resultadosdx` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `resultado` varchar(512) NOT NULL,
  `fecha_examen` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_dx_archivos`
--

CREATE TABLE `resultados_dx_archivos` (
  `id_archivo` int(11) NOT NULL,
  `id_resultado_dx` int(11) NOT NULL,
  `ruta_archivo` text NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_dx_examenes`
--

CREATE TABLE `resultados_dx_examenes` (
  `id_examen` int(11) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE `rondas` (
  `id_ronda` int(11) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `id_proceso` varchar(10) DEFAULT NULL,
  `codigo_documento` varchar(55) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_responsable` varchar(10) NOT NULL,
  `periocidad` enum('0','1','2','3','4','5') NOT NULL COMMENT '0= Mensual, 1= Bimensual, 3= Trimestral, 4= Semetral, 5= Anual',
  `n_veces` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_evidencia_resp`
--

CREATE TABLE `rondas_evidencia_resp` (
  `id_evidencia` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL,
  `imagen` varchar(512) DEFAULT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0= ''registro Temporal'', 1= ''Regitro final'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_gestion`
--

CREATE TABLE `rondas_gestion` (
  `id` int(11) NOT NULL,
  `id_gestion` bigint(20) NOT NULL,
  `id_ronda` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `Observaciones_hallazgos` text DEFAULT NULL,
  `id_usuario_insp` int(11) NOT NULL,
  `fecha_insp` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_gestion_resp`
--

CREATE TABLE `rondas_gestion_resp` (
  `id_respuesta` int(11) NOT NULL,
  `id_gestion` bigint(20) NOT NULL,
  `ubicacion` varchar(512) DEFAULT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL,
  `observacion` text DEFAULT NULL,
  `hallazgo` text DEFAULT NULL,
  `accion` text DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0= Registro Temporal, 1= Registro Confirmado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_preguntas`
--

CREATE TABLE `rondas_preguntas` (
  `id_items` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_respuesta`
--

CREATE TABLE `rondas_respuesta` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_ronda` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL,
  `observacion` varchar(512) NOT NULL,
  `hallazgo` varchar(512) NOT NULL,
  `accion` varchar(512) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0= Registro Temporal, 1= Registro Confirmado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_seccion`
--

CREATE TABLE `rondas_seccion` (
  `id_seccion` int(11) NOT NULL,
  `id_ronda` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo_respuesta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0 = Inactivo, 1 = Activo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_mantenimiento`
--

CREATE TABLE `solicitudes_mantenimiento` (
  `id_solicitud` int(11) NOT NULL,
  `mantenimiento_requerido` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `solicitante` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_de_solicitud` datetime NOT NULL,
  `estado_de_solicitud` enum('0','1','2','3') NOT NULL COMMENT '0= Recibida, 1= En proceso, 2= Aprobada, 3= Rechazada.\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_aprobacion`
--

CREATE TABLE `solicitud_aprobacion` (
  `id_aprobacion` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cerrar`
--

CREATE TABLE `solicitud_cerrar` (
  `id_solcerrada` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_documentos`
--

CREATE TABLE `solicitud_documentos` (
  `id_solicitud` int(11) NOT NULL,
  `tipo_solicitud` enum('1','2','3') NOT NULL COMMENT '1= "Creacion", 2="Modificacion", 3="Eliminacion"',
  `id_documento` int(11) DEFAULT NULL,
  `id_tipo_documento` char(3) NOT NULL,
  `nombre_documento` varchar(255) NOT NULL,
  `id_macroproceso` char(2) NOT NULL,
  `id_proceso` int(11) DEFAULT NULL,
  `id_subproceso` int(11) DEFAULT NULL,
  `id_responsable` int(11) NOT NULL,
  `justificacion` text NOT NULL,
  `documento_relacionado` varchar(20) DEFAULT NULL,
  `origen_formato` enum('0','1','2') DEFAULT NULL COMMENT '0="No Aplica",1= "Interno",2="Externo"',
  `id_revisado_por` varchar(50) DEFAULT NULL,
  `id_aprabo_por` varchar(50) DEFAULT NULL,
  `archivo_original` varchar(255) DEFAULT NULL,
  `capacitacion` enum('0','1') NOT NULL COMMENT '0 = No, 1 = Si',
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1','2','3','4','5','6','7') NOT NULL COMMENT '0="Pendiente", 1="Aceptada",2="Rechazada",3="Revisada",4="Aprobada", 5="Cerrada",6="Codificado". 7="Devuelta"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Solicitudes' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_revision`
--

CREATE TABLE `solicitud_revision` (
  `id_revision` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Revisiones' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subprocesos`
--

CREATE TABLE `subprocesos` (
  `id_subproceso` int(11) NOT NULL,
  `pref_subproceso` varchar(3) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suceso_seguridad`
--

CREATE TABLE `suceso_seguridad` (
  `id_suceso_seguridad` int(11) NOT NULL,
  `cargo_reportante` int(11) NOT NULL,
  `Otro_Cargo` varchar(254) DEFAULT NULL,
  `Otro_Servicio` varchar(254) DEFAULT NULL,
  `servicio` int(11) NOT NULL,
  `nombre_paciente` varchar(100) NOT NULL,
  `numero_documento` varchar(30) NOT NULL,
  `novedad_asociada` enum('1','2','3','4','5') NOT NULL,
  `informo_jefe` enum('1','2') NOT NULL,
  `descripcion_novedad` text NOT NULL,
  `manejo_realizado` text NOT NULL,
  `nombre_medicamento` varchar(70) DEFAULT NULL,
  `lote_medicamento` varchar(20) DEFAULT NULL,
  `registro_sanitario_medicamento` varchar(20) DEFAULT NULL,
  `fecha_vencimiento_medicamento` date DEFAULT NULL,
  `nombre_dispositivo` varchar(50) DEFAULT NULL,
  `lote_dispositivo` varchar(20) DEFAULT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `fabricante` varchar(70) DEFAULT NULL,
  `registro_sanitario_dispositivo` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `serial` varchar(20) DEFAULT NULL,
  `distribuidor` varchar(70) DEFAULT NULL,
  `politica_pd` enum('0','1') DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_modifica` int(11) DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `observaciones_cierre` text DEFAULT NULL,
  `usuario_cierre` int(11) DEFAULT NULL,
  `estado` enum('0','1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suceso_seguridad_gestion`
--

CREATE TABLE `suceso_seguridad_gestion` (
  `id_gestion_suceso` int(11) NOT NULL,
  `id_suceso_seguridad` int(11) NOT NULL,
  `clasificacion_inicial` enum('1','2','3','4','5','6') NOT NULL,
  `fecha_analisis` date NOT NULL,
  `investigacion` text NOT NULL,
  `conclusiones` text NOT NULL,
  `acciones_inseguras` text NOT NULL,
  `grado_lesion` enum('0','1','2') NOT NULL,
  `gravedad_caso` enum('0','1','2') NOT NULL,
  `origen_complicacion` enum('1','2','3') NOT NULL,
  `faccont_ambiental` enum('1','2','3','4','5','6','7') NOT NULL,
  `faccont_equipo` enum('1','2') NOT NULL,
  `faccont_individuo` enum('1','2') NOT NULL,
  `faccont_paciente` enum('1','2','3') NOT NULL,
  `faccont_tecnologia` enum('1','2','3','4') NOT NULL,
  `produjo_danos` enum('1','2') NOT NULL,
  `prevenible` enum('1','2') NOT NULL,
  `trazadores` text NOT NULL,
  `trazrelCuidado` int(11) NOT NULL,
  `trazRelMedicam` int(11) NOT NULL,
  `trazrelIACS` int(11) NOT NULL,
  `trazRelprocInva` int(11) NOT NULL,
  `trazreldiagnosticos` int(11) NOT NULL,
  `trazrelTecnov` int(11) NOT NULL,
  `trazrelOtros` int(11) NOT NULL,
  `justificacion_trazadores` text DEFAULT NULL,
  `guias` int(11) NOT NULL,
  `enteControl` int(11) NOT NULL,
  `reporteCont` int(11) NOT NULL,
  `fechaRep` date NOT NULL,
  `fechaComite` date NOT NULL,
  `accion_mejora` enum('0','1') NOT NULL COMMENT '0=''No'', 1=''Si''',
  `barrera` text NOT NULL,
  `grupo` text NOT NULL,
  `clasificacion_final` int(11) NOT NULL,
  `usuario_registra` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suceso_seguridad_seguimiento`
--

CREATE TABLE `suceso_seguridad_seguimiento` (
  `id_seguimiento` int(11) NOT NULL,
  `id_suceso_seguridad` int(11) NOT NULL,
  `fecha_seguimiento` date NOT NULL,
  `accion_efectiva` enum('0','1') NOT NULL COMMENT '0="No", 1="Si"',
  `porque_respta` text NOT NULL,
  `observaciones_seguimiento` text NOT NULL,
  `cumplimento` enum('0','1','2','3','4','5') NOT NULL COMMENT '0=''Completo'', 1=''No Iniciado'', 2=''Sin Analisis'', 3=''No dio lugar a accion'', 4=''Avanzado'', 5=''Iniciado''',
  `ilustraciones` varchar(512) DEFAULT NULL,
  `estado_caso` enum('0','1') NOT NULL COMMENT '0=''No'', 1=''Si''',
  `f_involucrado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tareas` int(11) NOT NULL,
  `tipo_tarea` varchar(50) NOT NULL,
  `id_modulo` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL COMMENT '0=Solicitud Documentos, 1=Agendamiento Qx,2=Capacitaciones,3=Eventos,4=Medicamentos,5=Contratos Tercero, 6=Contratos Personal,7=Costos, 8 = Mantenimiento, 9 = , 10 = ,',
  `descripcion` text NOT NULL,
  `id_solicitud` varchar(11) NOT NULL,
  `id_usuario_asigna` int(11) NOT NULL,
  `id_usuario_tarea` int(11) NOT NULL,
  `id_proceso` int(11) DEFAULT NULL,
  `estado` enum('0','1','2','3','4','5') NOT NULL COMMENT '0="Pendiente",1="Aceptada",2="Rechazada",3="Revisada",4="Aprobada",5="Cerrada"',
  `fecha_registro` datetime NOT NULL,
  `fecha_visto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Tareas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifario_convenio`
--

CREATE TABLE `tarifario_convenio` (
  `id_tarifario` int(11) NOT NULL,
  `id_tarifa` int(11) NOT NULL,
  `codigo_inst` int(11) NOT NULL,
  `codigo_bh` int(11) NOT NULL,
  `concepto_ad` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `clase_tarifa` int(11) NOT NULL,
  `tarifa_convenida` enum('ISS','SOAT',' PROPIA') NOT NULL,
  `cantidad_uvr` int(11) NOT NULL,
  `plan` text NOT NULL,
  `tipo_servicio` int(11) NOT NULL,
  `lugar_atencion` varchar(6) NOT NULL COMMENT 'A="Ambulatorio", H="Hospitalario", U="Urgencia", D="Domiciliario"',
  `habilita_concepto` enum('0','1') NOT NULL,
  `honorario_medico` int(11) NOT NULL,
  `honorario_anestesia` int(11) NOT NULL,
  `ayudantia` int(11) NOT NULL,
  `derecho_sala` int(11) NOT NULL,
  `materiales` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `year_tarifa` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id_tarifa` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL,
  `año_convenio` int(4) NOT NULL,
  `compañia` varchar(255) DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `redondeo` enum('0','1','3') NOT NULL,
  `uvr_qx_int` int(11) NOT NULL,
  `uvr_qx_mod_ban_med` int(11) NOT NULL,
  `quimio_int` int(11) NOT NULL,
  `quimio_mod_ban_med` int(11) NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas_detalle`
--

CREATE TABLE `tarifas_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_tarifa` int(11) NOT NULL,
  `codigo_inst` int(11) NOT NULL,
  `codigo_bh` int(11) NOT NULL,
  `concepto_adicional` varchar(255) NOT NULL,
  `descripción_bh` text NOT NULL,
  `clase_tarifa` enum('0','1','2') NOT NULL,
  `t_convenida` enum('0','1','2') NOT NULL COMMENT '0 =''ISS'', 1 =''SOAT'', 2 = ''PROPIAS''',
  `canitidad_uvr` int(11) NOT NULL,
  `plan` varchar(254) NOT NULL,
  `modalidad` enum('0','1') NOT NULL COMMENT '0 = ''Paquete'', 1 = ''Evento''',
  `lugar_atención` enum('A','H','U','D') NOT NULL COMMENT 'A =''Ambuilatoria'', H =''Hospitalario'', U =''Urgencia'', D =''Domiciliario''',
  `codigo_homologado` varchar(20) NOT NULL,
  `codigo_reps` varchar(15) NOT NULL,
  `valor_total` int(11) NOT NULL DEFAULT 0,
  `id_procedimiento` int(11) NOT NULL,
  `n_uvr` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `habilita_conc` enum('0','1') NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas_d_part`
--

CREATE TABLE `tarifas_d_part` (
  `id_particularidad` int(11) NOT NULL,
  `id_detalle_t` int(11) NOT NULL,
  `honorarios_med` int(11) NOT NULL,
  `honorarios_anes` int(11) NOT NULL,
  `ayudantia` int(11) NOT NULL,
  `derechos_sala` int(11) NOT NULL,
  `materiales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `id_tercero` int(11) NOT NULL,
  `tipo_tercero` enum('0','1') NOT NULL COMMENT '0=''Proveedor'',1=''Cliente''',
  `tipo_documento` int(11) NOT NULL,
  `materialesqx` tinyint(1) NOT NULL,
  `numero_id` varchar(13) NOT NULL,
  `razon_social` varchar(256) NOT NULL,
  `nombre_contacto` varchar(100) NOT NULL,
  `telefono_contacto` varchar(20) NOT NULL,
  `correo_contacto` varchar(100) NOT NULL,
  `sigla` varchar(100) NOT NULL,
  `proveedor_critico` enum('0','1') NOT NULL COMMENT '0="Si", 1="No"',
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('0','1') NOT NULL COMMENT '0="Activo", 1="Inactivo"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terceros_correos`
--

CREATE TABLE `terceros_correos` (
  `id_correo` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_contrato`
--

CREATE TABLE `tipos_contrato` (
  `id_tipocontrato` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `id_tipo` char(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_docidentidad`
--

CREATE TABLE `tipo_docidentidad` (
  `id_tipdocidentidad` int(11) NOT NULL,
  `cod_tipodocumento` varchar(2) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=PAGE;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` blob NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_empleado` int(11) NOT NULL DEFAULT 0,
  `perfil` enum('0','1','2','3','4','5','6','7','8') NOT NULL COMMENT '0=Administrador, 1= Gerente, 2= Coordinador, 3= Cirujanos, 4= Costos / Contratos, 5= Asistenciales, 6= Cirugia, 7=Auditoria, 8 = Instrumentadoras',
  `foto` varchar(40) DEFAULT NULL,
  `hash_key` varchar(100) DEFAULT NULL,
  `hash_expiry` datetime DEFAULT NULL,
  `cambio_clave` enum('0','1') NOT NULL,
  `politica_proteccion_datos` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0= "No la Conoce", 1= "Si la conoce"',
  `totp_secret` varchar(64) DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `two_factor_secret` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
  ADD PRIMARY KEY (`id_acta`),
  ADD KEY `id_proceso` (`proceso`(191)),
  ADD KEY `id_responsabe` (`id_responsabe`),
  ADD KEY `nombre_reunion` (`nombre_reunion`);

--
-- Indices de la tabla `actas_asistentes`
--
ALTER TABLE `actas_asistentes`
  ADD PRIMARY KEY (`id_asistentes`),
  ADD KEY `id_acta` (`id_acta`);

--
-- Indices de la tabla `actas_observaciones`
--
ALTER TABLE `actas_observaciones`
  ADD PRIMARY KEY (`id_observacion`),
  ADD KEY `id_acta` (`id_acta`);

--
-- Indices de la tabla `actas_tareas`
--
ALTER TABLE `actas_tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_acta` (`id_acta`),
  ADD KEY `id_responsabe` (`id_responsable`);

--
-- Indices de la tabla `actas_tiporeunion`
--
ALTER TABLE `actas_tiporeunion`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `administracion_medicamentos`
--
ALTER TABLE `administracion_medicamentos`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `administracion_medicamentos_gestion`
--
ALTER TABLE `administracion_medicamentos_gestion`
  ADD PRIMARY KEY (`id_gestion`);

--
-- Indices de la tabla `admin_medic_gestion`
--
ALTER TABLE `admin_medic_gestion`
  ADD PRIMARY KEY (`id_gestion_medic`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_centrocosto` (`id_centrocosto`),
  ADD KEY `id_responsable` (`id_responsable`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `arl`
--
ALTER TABLE `arl`
  ADD PRIMARY KEY (`id_arl`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `id_area` (`naturaleza`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `centroscostos`
--
ALTER TABLE `centroscostos`
  ADD PRIMARY KEY (`id_centrocosto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `checklist_aprobacion_sol`
--
ALTER TABLE `checklist_aprobacion_sol`
  ADD PRIMARY KEY (`id_check_apro`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `checklist_contratost`
--
ALTER TABLE `checklist_contratost`
  ADD PRIMARY KEY (`id_anexo`);

--
-- Indices de la tabla `checklist_revision_sol`
--
ALTER TABLE `checklist_revision_sol`
  ADD PRIMARY KEY (`id_revision`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `chequeo_infraextructura_items`
--
ALTER TABLE `chequeo_infraextructura_items`
  ADD PRIMARY KEY (`id_items`),
  ADD KEY `seccion` (`id_seccion`);

--
-- Indices de la tabla `chequeo_infraextructura_sec`
--
ALTER TABLE `chequeo_infraextructura_sec`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `ckeklist_contratosp`
--
ALTER TABLE `ckeklist_contratosp`
  ADD PRIMARY KEY (`id_checklist`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id_concepto`);

--
-- Indices de la tabla `conceptos_contratost`
--
ALTER TABLE `conceptos_contratost`
  ADD PRIMARY KEY (`id_concepto`);

--
-- Indices de la tabla `contactenos`
--
ALTER TABLE `contactenos`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_tipocontrato` (`id_tipocontrato`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_cargo` (`id_cargo`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_centrocosto` (`id_centrocosto`),
  ADD KEY `fecha_inicio` (`fecha_inicio`),
  ADD KEY `fecha_final` (`fecha_final`),
  ADD KEY `fecha_registro` (`fecha_registro`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `contratost_anexos`
--
ALTER TABLE `contratost_anexos`
  ADD PRIMARY KEY (`id_anexo`),
  ADD KEY `id_contratost` (`id_contratost`),
  ADD KEY `id_checklist_contrato` (`id_checklist_contratot`);

--
-- Indices de la tabla `contratost_prorroga`
--
ALTER TABLE `contratost_prorroga`
  ADD PRIMARY KEY (`id_prorroga`);

--
-- Indices de la tabla `contratos_anexos`
--
ALTER TABLE `contratos_anexos`
  ADD PRIMARY KEY (`id_anexo`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `estado` (`estado`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_checklist_contratos` (`id_checklist_contratos`),
  ADD KEY `fecha_registro` (`fecha_registro`);

--
-- Indices de la tabla `contratos_egresos`
--
ALTER TABLE `contratos_egresos`
  ADD PRIMARY KEY (`id_egresop`),
  ADD KEY `id_egresop` (`id_egresop`,`id_contrato`);

--
-- Indices de la tabla `contratos_egresos_elementos`
--
ALTER TABLE `contratos_egresos_elementos`
  ADD PRIMARY KEY (`id_elemento`),
  ADD KEY `id_egreso` (`id_egreso`);

--
-- Indices de la tabla `contratos_fileContratos`
--
ALTER TABLE `contratos_fileContratos`
  ADD PRIMARY KEY (`id_archivoc`);

--
-- Indices de la tabla `contratos_otrosi`
--
ALTER TABLE `contratos_otrosi`
  ADD PRIMARY KEY (`id_otrosi`);

--
-- Indices de la tabla `contratos_otrosi_anexos`
--
ALTER TABLE `contratos_otrosi_anexos`
  ADD PRIMARY KEY (`id_anexo`);

--
-- Indices de la tabla `contratos_prorroga`
--
ALTER TABLE `contratos_prorroga`
  ADD PRIMARY KEY (`id_prorroga`),
  ADD KEY `id_contrato` (`id_contrato`);

--
-- Indices de la tabla `contratos_terceros`
--
ALTER TABLE `contratos_terceros`
  ADD PRIMARY KEY (`id_contrato_tercero`),
  ADD KEY `responsable` (`responsable`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`),
  ADD KEY `fecha_registro` (`fecha_registro`),
  ADD KEY `fecha_inicio` (`fecha_inicio`),
  ADD KEY `fecha_final` (`fecha_final`),
  ADD KEY `id_tercero` (`id_tercero`);

--
-- Indices de la tabla `contratos_terceros_personal`
--
ALTER TABLE `contratos_terceros_personal`
  ADD PRIMARY KEY (`id_contratot_personal`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`),
  ADD KEY `id_usuario_temp` (`id_usuario_temp`),
  ADD KEY `fecha_registro` (`fecha_registro`),
  ADD KEY `id_contrato_tercero` (`id_contrato_tercero`);

--
-- Indices de la tabla `c_cirugias`
--
ALTER TABLE `c_cirugias`
  ADD PRIMARY KEY (`id_ccirugias`);

--
-- Indices de la tabla `c_manoobrapresta`
--
ALTER TABLE `c_manoobrapresta`
  ADD PRIMARY KEY (`id_manoobrapresta`);

--
-- Indices de la tabla `c_manoobra_planta`
--
ALTER TABLE `c_manoobra_planta`
  ADD PRIMARY KEY (`id_manoobra`),
  ADD KEY `periodo` (`periodo`);

--
-- Indices de la tabla `c_notidicaciones_enviadas`
--
ALTER TABLE `c_notidicaciones_enviadas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_notif` (`id_contrato`,`id_anexo_contrato`,`fecha_vencimiento`);

--
-- Indices de la tabla `c_suministros`
--
ALTER TABLE `c_suministros`
  ADD PRIMARY KEY (`id_suministro`);

--
-- Indices de la tabla `c_tercero_anexos_personal`
--
ALTER TABLE `c_tercero_anexos_personal`
  ADD PRIMARY KEY (`id_anexo`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `destinararios_solicitud`
--
ALTER TABLE `destinararios_solicitud`
  ADD PRIMARY KEY (`id_destinatario`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_procesomaestro` (`id_procesomaestro`),
  ADD KEY `codigo` (`codigo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`),
  ADD KEY `id_macroproceso` (`id_macroproceso`);

--
-- Indices de la tabla `documentos_areas`
--
ALTER TABLE `documentos_areas`
  ADD PRIMARY KEY (`id_documentoxarea`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `documentos_cargos`
--
ALTER TABLE `documentos_cargos`
  ADD PRIMARY KEY (`id_documentoxcargo`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Indices de la tabla `documentos_empleados`
--
ALTER TABLE `documentos_empleados`
  ADD PRIMARY KEY (`id_documentoxempleado`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Indices de la tabla `documentos_institucionales`
--
ALTER TABLE `documentos_institucionales`
  ADD PRIMARY KEY (`id_docinstitucional`);

--
-- Indices de la tabla `documentos_institucionales_anexos`
--
ALTER TABLE `documentos_institucionales_anexos`
  ADD PRIMARY KEY (`id_anexo_doc_inst`),
  ADD KEY `id_docinstitucional` (`id_docinstitucional`);

--
-- Indices de la tabla `documentos_socializacion`
--
ALTER TABLE `documentos_socializacion`
  ADD PRIMARY KEY (`id_socializacion`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Indices de la tabla `documentos_versiones`
--
ALTER TABLE `documentos_versiones`
  ADD PRIMARY KEY (`id_version`);

--
-- Indices de la tabla `egresop_detalle`
--
ALTER TABLE `egresop_detalle`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `empresa_anexos`
--
ALTER TABLE `empresa_anexos`
  ADD PRIMARY KEY (`id_anexo`);

--
-- Indices de la tabla `empresa_anexos_archivos`
--
ALTER TABLE `empresa_anexos_archivos`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `encuesta_datos_encuestado`
--
ALTER TABLE `encuesta_datos_encuestado`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `encuesta_objeto`
--
ALTER TABLE `encuesta_objeto`
  ADD PRIMARY KEY (`id_objeto_enc`);

--
-- Indices de la tabla `encuesta_preguntas`
--
ALTER TABLE `encuesta_preguntas`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `encuesta_respuestas`
--
ALTER TABLE `encuesta_respuestas`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_encuenta` (`id_encuesta`);

--
-- Indices de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `eps`
--
ALTER TABLE `eps`
  ADD PRIMARY KEY (`id_eps`);

--
-- Indices de la tabla `ingreso_personal`
--
ALTER TABLE `ingreso_personal`
  ADD PRIMARY KEY (`id_ingreso`);

--
-- Indices de la tabla `ingreso_personal_anexos`
--
ALTER TABLE `ingreso_personal_anexos`
  ADD PRIMARY KEY (`id_anexo_ing`);

--
-- Indices de la tabla `linea_costos`
--
ALTER TABLE `linea_costos`
  ADD PRIMARY KEY (`id_linea_costos`);

--
-- Indices de la tabla `linea_etica`
--
ALTER TABLE `linea_etica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea_etica_anexos`
--
ALTER TABLE `linea_etica_anexos`
  ADD PRIMARY KEY (`id_anexo`);

--
-- Indices de la tabla `linea_etica_origen`
--
ALTER TABLE `linea_etica_origen`
  ADD PRIMARY KEY (`id_origen`);

--
-- Indices de la tabla `listado_documentos`
--
ALTER TABLE `listado_documentos`
  ADD PRIMARY KEY (`id_listado`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `log_acciones`
--
ALTER TABLE `log_acciones`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `macroprocesos`
--
ALTER TABLE `macroprocesos`
  ADD PRIMARY KEY (`id_macroproceso`);

--
-- Indices de la tabla `mantenimientosp_notas`
--
ALTER TABLE `mantenimientosp_notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_manto_programado` (`id_manto_programado`);

--
-- Indices de la tabla `mantenimientos_anexos`
--
ALTER TABLE `mantenimientos_anexos`
  ADD PRIMARY KEY (`id_anexo_mto`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `mantenimientos_anexos_ejecución`
--
ALTER TABLE `mantenimientos_anexos_ejecución`
  ADD PRIMARY KEY (`id_anexo_ejecucion`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `mantenimientos_calendario`
--
ALTER TABLE `mantenimientos_calendario`
  ADD PRIMARY KEY (`id_mantemiento`);

--
-- Indices de la tabla `mantenimientos_programacion`
--
ALTER TABLE `mantenimientos_programacion`
  ADD PRIMARY KEY (`id_programacionm`);

--
-- Indices de la tabla `mantenimientos_requeridos`
--
ALTER TABLE `mantenimientos_requeridos`
  ADD PRIMARY KEY (`id_mantenimiento_r`);

--
-- Indices de la tabla `mantenimientos_servicios`
--
ALTER TABLE `mantenimientos_servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `mantenimientos_solicitudes`
--
ALTER TABLE `mantenimientos_solicitudes`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `materiales_cx`
--
ALTER TABLE `materiales_cx`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_procedimiento` (`id_procedimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `materiales_grupos`
--
ALTER TABLE `materiales_grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `materiales_qx`
--
ALTER TABLE `materiales_qx`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_procedimiento` (`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `m_calendar`
--
ALTER TABLE `m_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `observaciones_solicitud`
--
ALTER TABLE `observaciones_solicitud`
  ADD PRIMARY KEY (`id_observacion`),
  ADD KEY `solicitud` (`id_solicitud`);

--
-- Indices de la tabla `otrosi`
--
ALTER TABLE `otrosi`
  ADD PRIMARY KEY (`id_otrosi`),
  ADD KEY `contrato` (`id_contratot`);

--
-- Indices de la tabla `otrosi_anexos`
--
ALTER TABLE `otrosi_anexos`
  ADD PRIMARY KEY (`id_anexo`),
  ADD KEY `otrosi` (`id_otrosi`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_entidad_salud` (`id_entidad_salud`),
  ADD KEY `id_tipodocumento` (`id_tipodocumento`);

--
-- Indices de la tabla `planes_mejoras`
--
ALTER TABLE `planes_mejoras`
  ADD PRIMARY KEY (`id_plan`),
  ADD KEY `id_fuente` (`id_fuente`);

--
-- Indices de la tabla `planes_mejoras_anexos`
--
ALTER TABLE `planes_mejoras_anexos`
  ADD PRIMARY KEY (`id_evidencia`);

--
-- Indices de la tabla `planes_mejoras_gestion`
--
ALTER TABLE `planes_mejoras_gestion`
  ADD PRIMARY KEY (`id_gestion`),
  ADD KEY `id_plan` (`id_plan`);

--
-- Indices de la tabla `planes_mejoras_seguimiento`
--
ALTER TABLE `planes_mejoras_seguimiento`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `id_plan` (`id_plan`);

--
-- Indices de la tabla `politicas`
--
ALTER TABLE `politicas`
  ADD PRIMARY KEY (`id_politica`);

--
-- Indices de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  ADD PRIMARY KEY (`id_procedimiento`);

--
-- Indices de la tabla `procedimientos_cx`
--
ALTER TABLE `procedimientos_cx`
  ADD PRIMARY KEY (`id_procedimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`id_programacion`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_cirujano` (`id_cirujano`);

--
-- Indices de la tabla `programacion_agenda_cirujano`
--
ALTER TABLE `programacion_agenda_cirujano`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indices de la tabla `programacion_envio_correo`
--
ALTER TABLE `programacion_envio_correo`
  ADD PRIMARY KEY (`id_envio`);

--
-- Indices de la tabla `programacion_procedimientos`
--
ALTER TABLE `programacion_procedimientos`
  ADD PRIMARY KEY (`id_procedimiento_prog`),
  ADD KEY `id_programcaion` (`id_programacion`),
  ADD KEY `id_procedimiento` (`id_procedimiento`),
  ADD KEY `proveedor_material` (`proveedor_material`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `prorroga_ct`
--
ALTER TABLE `prorroga_ct`
  ADD PRIMARY KEY (`id_prorroga`),
  ADD KEY `contrato` (`id_contratot`);

--
-- Indices de la tabla `p_curso_cx`
--
ALTER TABLE `p_curso_cx`
  ADD PRIMARY KEY (`id_cirugia`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_cirujano` (`id_cirujano`),
  ADD KEY `procedimiento` (`procedimiento`),
  ADD KEY `id_entidad` (`id_entidad`),
  ADD KEY `fecha_Cx` (`fecha_Cx`);

--
-- Indices de la tabla `p_curso_cx_cancelacion`
--
ALTER TABLE `p_curso_cx_cancelacion`
  ADD PRIMARY KEY (`id_cancelacion`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `p_seguimiento_L1`
--
ALTER TABLE `p_seguimiento_L1`
  ADD PRIMARY KEY (`id_seguimientoPL`);

--
-- Indices de la tabla `p_seguimiento_L2`
--
ALTER TABLE `p_seguimiento_L2`
  ADD PRIMARY KEY (`id_seguimientoSL`);

--
-- Indices de la tabla `p_seguimiento_L3`
--
ALTER TABLE `p_seguimiento_L3`
  ADD PRIMARY KEY (`id_seguimientoTL`);

--
-- Indices de la tabla `resultados_dx`
--
ALTER TABLE `resultados_dx`
  ADD PRIMARY KEY (`id_resultadosdx`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_examen` (`id_examen`),
  ADD KEY `fecha_examen` (`fecha_examen`);

--
-- Indices de la tabla `resultados_dx_archivos`
--
ALTER TABLE `resultados_dx_archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `id_resultado` (`id_resultado_dx`);

--
-- Indices de la tabla `resultados_dx_examenes`
--
ALTER TABLE `resultados_dx_examenes`
  ADD PRIMARY KEY (`id_examen`);

--
-- Indices de la tabla `rondas`
--
ALTER TABLE `rondas`
  ADD PRIMARY KEY (`id_ronda`);

--
-- Indices de la tabla `rondas_evidencia_resp`
--
ALTER TABLE `rondas_evidencia_resp`
  ADD PRIMARY KEY (`id_evidencia`),
  ADD KEY `id_respuesta` (`id_respuesta`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `rondas_gestion`
--
ALTER TABLE `rondas_gestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ronda` (`id_ronda`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_usuario_insp` (`id_usuario_insp`),
  ADD KEY `id_gestion` (`id_gestion`);

--
-- Indices de la tabla `rondas_gestion_resp`
--
ALTER TABLE `rondas_gestion_resp`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_gestion` (`id_gestion`),
  ADD KEY `id_pregunta` (`id_pregunta`),
  ADD KEY `respuesta` (`respuesta`);

--
-- Indices de la tabla `rondas_preguntas`
--
ALTER TABLE `rondas_preguntas`
  ADD PRIMARY KEY (`id_items`);

--
-- Indices de la tabla `rondas_respuesta`
--
ALTER TABLE `rondas_respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ronda` (`id_ronda`),
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_pregunta` (`id_pregunta`),
  ADD KEY `respuesta` (`respuesta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `estado` (`estado`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `rondas_seccion`
--
ALTER TABLE `rondas_seccion`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `solicitudes_mantenimiento`
--
ALTER TABLE `solicitudes_mantenimiento`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `solicitud_aprobacion`
--
ALTER TABLE `solicitud_aprobacion`
  ADD PRIMARY KEY (`id_aprobacion`);

--
-- Indices de la tabla `solicitud_cerrar`
--
ALTER TABLE `solicitud_cerrar`
  ADD PRIMARY KEY (`id_solcerrada`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `solicitud_documentos`
--
ALTER TABLE `solicitud_documentos`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_proceso` (`id_proceso`),
  ADD KEY `id_responsable` (`id_responsable`),
  ADD KEY `id_revisado_por` (`id_revisado_por`),
  ADD KEY `id_aprobado_por` (`id_aprabo_por`),
  ADD KEY `id_subproceso` (`id_subproceso`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indices de la tabla `solicitud_revision`
--
ALTER TABLE `solicitud_revision`
  ADD PRIMARY KEY (`id_revision`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `subprocesos`
--
ALTER TABLE `subprocesos`
  ADD PRIMARY KEY (`id_subproceso`);

--
-- Indices de la tabla `suceso_seguridad`
--
ALTER TABLE `suceso_seguridad`
  ADD PRIMARY KEY (`id_suceso_seguridad`);

--
-- Indices de la tabla `suceso_seguridad_gestion`
--
ALTER TABLE `suceso_seguridad_gestion`
  ADD PRIMARY KEY (`id_gestion_suceso`),
  ADD UNIQUE KEY `id_suceso_seguridad` (`id_suceso_seguridad`);

--
-- Indices de la tabla `suceso_seguridad_seguimiento`
--
ALTER TABLE `suceso_seguridad_seguimiento`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `id_suceso_seguridad` (`id_suceso_seguridad`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tareas`),
  ADD KEY `id_usuario_tarea` (`id_usuario_tarea`),
  ADD KEY `id_usuario_asignado` (`id_usuario_asigna`),
  ADD KEY `id_proceso` (`id_proceso`);

--
-- Indices de la tabla `tarifario_convenio`
--
ALTER TABLE `tarifario_convenio`
  ADD PRIMARY KEY (`id_tarifario`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id_tarifa`),
  ADD KEY `id_convenio` (`id_convenio`),
  ADD KEY `año_convenio` (`año_convenio`);

--
-- Indices de la tabla `tarifas_detalle`
--
ALTER TABLE `tarifas_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_tarifa` (`id_tarifa`),
  ADD KEY `id_procedimiento` (`id_procedimiento`);

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD PRIMARY KEY (`id_tercero`),
  ADD KEY `usuario_registra` (`id_usuario`);

--
-- Indices de la tabla `terceros_correos`
--
ALTER TABLE `terceros_correos`
  ADD PRIMARY KEY (`id_correo`);

--
-- Indices de la tabla `tipos_contrato`
--
ALTER TABLE `tipos_contrato`
  ADD PRIMARY KEY (`id_tipocontrato`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_docidentidad`
--
ALTER TABLE `tipo_docidentidad`
  ADD PRIMARY KEY (`id_tipdocidentidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
  MODIFY `id_acta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actas_asistentes`
--
ALTER TABLE `actas_asistentes`
  MODIFY `id_asistentes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actas_observaciones`
--
ALTER TABLE `actas_observaciones`
  MODIFY `id_observacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actas_tareas`
--
ALTER TABLE `actas_tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actas_tiporeunion`
--
ALTER TABLE `actas_tiporeunion`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `administracion_medicamentos`
--
ALTER TABLE `administracion_medicamentos`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `administracion_medicamentos_gestion`
--
ALTER TABLE `administracion_medicamentos_gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `admin_medic_gestion`
--
ALTER TABLE `admin_medic_gestion`
  MODIFY `id_gestion_medic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arl`
--
ALTER TABLE `arl`
  MODIFY `id_arl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centroscostos`
--
ALTER TABLE `centroscostos`
  MODIFY `id_centrocosto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `checklist_aprobacion_sol`
--
ALTER TABLE `checklist_aprobacion_sol`
  MODIFY `id_check_apro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `checklist_contratost`
--
ALTER TABLE `checklist_contratost`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `checklist_revision_sol`
--
ALTER TABLE `checklist_revision_sol`
  MODIFY `id_revision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chequeo_infraextructura_items`
--
ALTER TABLE `chequeo_infraextructura_items`
  MODIFY `id_items` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chequeo_infraextructura_sec`
--
ALTER TABLE `chequeo_infraextructura_sec`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ckeklist_contratosp`
--
ALTER TABLE `ckeklist_contratosp`
  MODIFY `id_checklist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conceptos_contratost`
--
ALTER TABLE `conceptos_contratost`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactenos`
--
ALTER TABLE `contactenos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratost_anexos`
--
ALTER TABLE `contratost_anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratost_prorroga`
--
ALTER TABLE `contratost_prorroga`
  MODIFY `id_prorroga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_anexos`
--
ALTER TABLE `contratos_anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_egresos`
--
ALTER TABLE `contratos_egresos`
  MODIFY `id_egresop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_egresos_elementos`
--
ALTER TABLE `contratos_egresos_elementos`
  MODIFY `id_elemento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_fileContratos`
--
ALTER TABLE `contratos_fileContratos`
  MODIFY `id_archivoc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_otrosi`
--
ALTER TABLE `contratos_otrosi`
  MODIFY `id_otrosi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_otrosi_anexos`
--
ALTER TABLE `contratos_otrosi_anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_prorroga`
--
ALTER TABLE `contratos_prorroga`
  MODIFY `id_prorroga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_terceros`
--
ALTER TABLE `contratos_terceros`
  MODIFY `id_contrato_tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_terceros_personal`
--
ALTER TABLE `contratos_terceros_personal`
  MODIFY `id_contratot_personal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_cirugias`
--
ALTER TABLE `c_cirugias`
  MODIFY `id_ccirugias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_manoobrapresta`
--
ALTER TABLE `c_manoobrapresta`
  MODIFY `id_manoobrapresta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_manoobra_planta`
--
ALTER TABLE `c_manoobra_planta`
  MODIFY `id_manoobra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_notidicaciones_enviadas`
--
ALTER TABLE `c_notidicaciones_enviadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_suministros`
--
ALTER TABLE `c_suministros`
  MODIFY `id_suministro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_tercero_anexos_personal`
--
ALTER TABLE `c_tercero_anexos_personal`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_areas`
--
ALTER TABLE `documentos_areas`
  MODIFY `id_documentoxarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_cargos`
--
ALTER TABLE `documentos_cargos`
  MODIFY `id_documentoxcargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_empleados`
--
ALTER TABLE `documentos_empleados`
  MODIFY `id_documentoxempleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_institucionales`
--
ALTER TABLE `documentos_institucionales`
  MODIFY `id_docinstitucional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_institucionales_anexos`
--
ALTER TABLE `documentos_institucionales_anexos`
  MODIFY `id_anexo_doc_inst` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_socializacion`
--
ALTER TABLE `documentos_socializacion`
  MODIFY `id_socializacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_versiones`
--
ALTER TABLE `documentos_versiones`
  MODIFY `id_version` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `egresop_detalle`
--
ALTER TABLE `egresop_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa_anexos`
--
ALTER TABLE `empresa_anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa_anexos_archivos`
--
ALTER TABLE `empresa_anexos_archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_datos_encuestado`
--
ALTER TABLE `encuesta_datos_encuestado`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_objeto`
--
ALTER TABLE `encuesta_objeto`
  MODIFY `id_objeto_enc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_preguntas`
--
ALTER TABLE `encuesta_preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_respuestas`
--
ALTER TABLE `encuesta_respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eps`
--
ALTER TABLE `eps`
  MODIFY `id_eps` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso_personal`
--
ALTER TABLE `ingreso_personal`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso_personal_anexos`
--
ALTER TABLE `ingreso_personal_anexos`
  MODIFY `id_anexo_ing` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea_costos`
--
ALTER TABLE `linea_costos`
  MODIFY `id_linea_costos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea_etica`
--
ALTER TABLE `linea_etica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea_etica_anexos`
--
ALTER TABLE `linea_etica_anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea_etica_origen`
--
ALTER TABLE `linea_etica_origen`
  MODIFY `id_origen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `listado_documentos`
--
ALTER TABLE `listado_documentos`
  MODIFY `id_listado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `log_acciones`
--
ALTER TABLE `log_acciones`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientosp_notas`
--
ALTER TABLE `mantenimientosp_notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_anexos`
--
ALTER TABLE `mantenimientos_anexos`
  MODIFY `id_anexo_mto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_anexos_ejecución`
--
ALTER TABLE `mantenimientos_anexos_ejecución`
  MODIFY `id_anexo_ejecucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_calendario`
--
ALTER TABLE `mantenimientos_calendario`
  MODIFY `id_mantemiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_programacion`
--
ALTER TABLE `mantenimientos_programacion`
  MODIFY `id_programacionm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_requeridos`
--
ALTER TABLE `mantenimientos_requeridos`
  MODIFY `id_mantenimiento_r` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_servicios`
--
ALTER TABLE `mantenimientos_servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_solicitudes`
--
ALTER TABLE `mantenimientos_solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiales_cx`
--
ALTER TABLE `materiales_cx`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiales_grupos`
--
ALTER TABLE `materiales_grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiales_qx`
--
ALTER TABLE `materiales_qx`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `m_calendar`
--
ALTER TABLE `m_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `observaciones_solicitud`
--
ALTER TABLE `observaciones_solicitud`
  MODIFY `id_observacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `otrosi`
--
ALTER TABLE `otrosi`
  MODIFY `id_otrosi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `otrosi_anexos`
--
ALTER TABLE `otrosi_anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes_mejoras`
--
ALTER TABLE `planes_mejoras`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes_mejoras_anexos`
--
ALTER TABLE `planes_mejoras_anexos`
  MODIFY `id_evidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes_mejoras_gestion`
--
ALTER TABLE `planes_mejoras_gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes_mejoras_seguimiento`
--
ALTER TABLE `planes_mejoras_seguimiento`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `politicas`
--
ALTER TABLE `politicas`
  MODIFY `id_politica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  MODIFY `id_procedimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procedimientos_cx`
--
ALTER TABLE `procedimientos_cx`
  MODIFY `id_procedimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `id_programacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion_agenda_cirujano`
--
ALTER TABLE `programacion_agenda_cirujano`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion_envio_correo`
--
ALTER TABLE `programacion_envio_correo`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion_procedimientos`
--
ALTER TABLE `programacion_procedimientos`
  MODIFY `id_procedimiento_prog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prorroga_ct`
--
ALTER TABLE `prorroga_ct`
  MODIFY `id_prorroga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `p_curso_cx`
--
ALTER TABLE `p_curso_cx`
  MODIFY `id_cirugia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `p_curso_cx_cancelacion`
--
ALTER TABLE `p_curso_cx_cancelacion`
  MODIFY `id_cancelacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `p_seguimiento_L1`
--
ALTER TABLE `p_seguimiento_L1`
  MODIFY `id_seguimientoPL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `p_seguimiento_L2`
--
ALTER TABLE `p_seguimiento_L2`
  MODIFY `id_seguimientoSL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `p_seguimiento_L3`
--
ALTER TABLE `p_seguimiento_L3`
  MODIFY `id_seguimientoTL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados_dx`
--
ALTER TABLE `resultados_dx`
  MODIFY `id_resultadosdx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados_dx_archivos`
--
ALTER TABLE `resultados_dx_archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados_dx_examenes`
--
ALTER TABLE `resultados_dx_examenes`
  MODIFY `id_examen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas`
--
ALTER TABLE `rondas`
  MODIFY `id_ronda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas_evidencia_resp`
--
ALTER TABLE `rondas_evidencia_resp`
  MODIFY `id_evidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas_gestion`
--
ALTER TABLE `rondas_gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas_gestion_resp`
--
ALTER TABLE `rondas_gestion_resp`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas_preguntas`
--
ALTER TABLE `rondas_preguntas`
  MODIFY `id_items` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas_respuesta`
--
ALTER TABLE `rondas_respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas_seccion`
--
ALTER TABLE `rondas_seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes_mantenimiento`
--
ALTER TABLE `solicitudes_mantenimiento`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_aprobacion`
--
ALTER TABLE `solicitud_aprobacion`
  MODIFY `id_aprobacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_cerrar`
--
ALTER TABLE `solicitud_cerrar`
  MODIFY `id_solcerrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_documentos`
--
ALTER TABLE `solicitud_documentos`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_revision`
--
ALTER TABLE `solicitud_revision`
  MODIFY `id_revision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subprocesos`
--
ALTER TABLE `subprocesos`
  MODIFY `id_subproceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suceso_seguridad`
--
ALTER TABLE `suceso_seguridad`
  MODIFY `id_suceso_seguridad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suceso_seguridad_gestion`
--
ALTER TABLE `suceso_seguridad_gestion`
  MODIFY `id_gestion_suceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suceso_seguridad_seguimiento`
--
ALTER TABLE `suceso_seguridad_seguimiento`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tareas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarifario_convenio`
--
ALTER TABLE `tarifario_convenio`
  MODIFY `id_tarifario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id_tarifa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarifas_detalle`
--
ALTER TABLE `tarifas_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terceros`
--
ALTER TABLE `terceros`
  MODIFY `id_tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terceros_correos`
--
ALTER TABLE `terceros_correos`
  MODIFY `id_correo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_docidentidad`
--
ALTER TABLE `tipo_docidentidad`
  MODIFY `id_tipdocidentidad` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
