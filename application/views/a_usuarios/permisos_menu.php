<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Gestión de Permisos de Menú</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tipo_permiso">Tipo de Permiso:</label>
                        <select id="tipo_permiso" class="form-control">
                            <option value="usuario">Por Usuario</option>
                            <option value="perfil">Por Perfil</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="seleccion_entidad">Seleccionar:</label>
                        <select id="seleccion_entidad" class="form-control">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                </div>

                <div id="permisos_container" style="display: none;">
                    <h6>Módulos Disponibles:</h6>
                    <div id="modulos_message" class="alert alert-info" style="display: none;"></div>
                    <div class="row" id="modulos_list">
                        <!-- Los módulos se cargarán aquí dinámicamente -->
                    </div>
                    <button type="button" id="guardar_permisos" class="btn btn-primary mt-3">Guardar Permisos</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
<?php
    $usuarios_js = [];
    foreach ($usuarios as $usuario) {
        $usuarios_js[] = [
            'id_usuario' => $usuario->id_usuario,
            'perfil' => $usuario->perfil,
            'label' => trim($usuario->nombre . ' ' . $usuario->apellido . ' (' . $usuario->usuario . ')')
        ];
    }
    $perfiles_js = [];
    foreach ($perfiles as $perfil) {
        $perfiles_js[] = [
            'id_tipo_usuario' => $perfil->id_tipo_usuario,
            'nombre' => $perfil->nombre
        ];
    }
    $modulos_js = [];
    foreach ($modulos as $modulo) {
        $modulos_js[] = [
            'id_modulo' => $modulo->id_modulo,
            'nombre' => $modulo->nombre
        ];
    }
?>
window.BASE_URL = '<?= base_url(); ?>';
window.PERMISOS_MENU = <?= json_encode(['usuarios' => $usuarios_js, 'perfiles' => $perfiles_js, 'modulos' => $modulos_js], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
</script>
