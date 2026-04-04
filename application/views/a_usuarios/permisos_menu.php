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
$(document).ready(function() {
    // Cargar opciones según tipo seleccionado
    $('#tipo_permiso').change(function() {
        var tipo = $(this).val();
        $('#seleccion_entidad').html('<option value="">Seleccione...</option>');

        if (tipo === 'usuario') {
            <?php foreach ($usuarios as $usuario): ?>
                $('#seleccion_entidad').append('<option value="<?php echo $usuario->id_usuario; ?>" data-perfil="<?php echo $usuario->perfil; ?>"><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?> (<?php echo $usuario->usuario; ?>)</option>');
            <?php endforeach; ?>
        } else if (tipo === 'perfil') {
            <?php foreach ($perfiles as $perfil): ?>
                $('#seleccion_entidad').append('<option value="<?php echo $perfil->id_tipo_usuario; ?>"><?php echo $perfil->nombre; ?></option>');
            <?php endforeach; ?>
        }
    });

    // Mostrar permisos cuando se selecciona una entidad
    $('#seleccion_entidad').change(function() {
        var entidadId = $(this).val();
        var tipo = $('#tipo_permiso').val();

        if (entidadId) {
            cargarPermisos(entidadId, tipo);
            $('#permisos_container').show();
        } else {
            $('#permisos_container').hide();
        }
    });

    function cargarPermisos(entidadId, tipo) {
        $('#modulos_list').html('');

        <?php foreach ($modulos as $modulo): ?>
            var moduloHtml = `
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="modulo_<?php echo $modulo->id_modulo; ?>" value="1" checked>
                        <label class="form-check-label" for="modulo_<?php echo $modulo->id_modulo; ?>">
                            <?php echo $modulo->nombre; ?>
                        </label>
                    </div>
                </div>
            `;
            $('#modulos_list').append(moduloHtml);
        <?php endforeach; ?>

        // Aquí se cargarían los permisos actuales desde la BD
        // Por ahora, todos marcados por defecto
    }

    $('#guardar_permisos').click(function() {
        var tipo = $('#tipo_permiso').val();
        var entidadId = $('#seleccion_entidad').val();
        var permisos = {};

        $('input[type="checkbox"]').each(function() {
            var moduloId = $(this).attr('id').replace('modulo_', '');
            permisos[moduloId] = $(this).is(':checked') ? 1 : 0;
        });

        $.post('<?php echo base_url('a_usuarios/guardar_permisos_menu'); ?>', {
            id_usuario: tipo === 'usuario' ? entidadId : null,
            id_perfil: tipo === 'perfil' ? entidadId : null,
            permisos: permisos
        }, function(response) {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                Swal.fire('Éxito', data.message, 'success');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
    });
});
</script>