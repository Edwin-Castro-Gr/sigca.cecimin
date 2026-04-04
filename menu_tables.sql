-- Crear tablas para sistema de menú parametrizable

-- Tabla de módulos disponibles
CREATE TABLE menu_modulos (
    id_modulo INT PRIMARY KEY AUTO_INCREMENT,
    modulo VARCHAR(100) UNIQUE NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(100),
    icono VARCHAR(100),
    orden INT DEFAULT 0,
    activo TINYINT(1) DEFAULT 1,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de permisos por usuario/perfil
CREATE TABLE menu_permisos (
    id_permiso INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NULL,
    id_perfil INT NULL,
    id_modulo INT NOT NULL,
    visible TINYINT(1) DEFAULT 1,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_modulo) REFERENCES menu_modulos(id_modulo),
    UNIQUE KEY unique_usuario_modulo (id_usuario, id_modulo),
    UNIQUE KEY unique_perfil_modulo (id_perfil, id_modulo)
);

-- Insertar módulos existentes del sistema
INSERT INTO menu_modulos (modulo, nombre, descripcion, categoria, orden) VALUES
('a_empresa', 'Empresa', 'Administración de datos de la empresa', 'Administración', 1),
('a_areas', 'Áreas', 'Gestión de áreas organizacionales', 'Administración', 2),
('a_centros', 'Centros', 'Administración de centros de costo', 'Administración', 3),
('a_cargos', 'Cargos', 'Gestión de cargos', 'Administración', 4),
('a_empleados', 'Empleados', 'Administración de empleados', 'Administración', 5),
('a_procesos', 'Procesos', 'Gestión de procesos', 'Administración', 6),
('a_subprocesos', 'Subprocesos', 'Administración de subprocesos', 'Administración', 7),
('a_lineacostos', 'Líneas de Costos', 'Gestión de líneas de costos', 'Administración', 8),
('a_usuarios', 'Usuarios', 'Administración de usuarios del sistema', 'Administración', 9),
('a_politicas', 'Políticas', 'Gestión de políticas', 'Administración', 10),
('a_terceros', 'Terceros', 'Administración de terceros', 'Administración', 11),
('a_paciente', 'Pacientes', 'Gestión de pacientes', 'Administración', 12),
('a_eps', 'EPS', 'Administración de entidades de salud', 'Administración', 13),
('a_arl', 'ARL', 'Gestión de riesgos laborales', 'Administración', 14),
('tarifas', 'Tarifas', 'Administración de tarifas', 'Administración', 15),
('configuraciones', 'Configuraciones', 'Configuraciones del sistema', 'Administración', 16),

('ingresoP', 'Ingreso Personal', 'Registro de ingresos de personal', 'Personal', 17),
('egresoP', 'Egreso Personal', 'Registro de egresos de personal', 'Personal', 18),
('a_contratos', 'Contratos', 'Gestión de contratos', 'Personal', 19),
('d_contratost', 'Tipos de Contrato', 'Administración de tipos de contrato', 'Personal', 20);