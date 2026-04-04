$(document).ready(function() {
    function renderEntidadOptions(tipo) {
        var lista = $('#seleccion_entidad');
        lista.empty();
        lista.append('<option value="">Seleccione...</option>');

        if (tipo === 'usuario') {
            window.PERMISOS_MENU.usuarios.forEach(function(usuario) {
                lista.append('<option value="' + usuario.id_usuario + '" data-perfil="' + usuario.perfil + '">' + usuario.label + '</option>');
            });
        } else if (tipo === 'perfil') {
            window.PERMISOS_MENU.perfiles.forEach(function(perfil) {
                lista.append('<option value="' + perfil.id_tipo_usuario + '">' + perfil.nombre + '</option>');
            });
        }

        $('#permisos_container').hide();
        $('#modulos_list').empty();
        $('#modulos_message').hide();
    }

    function renderModulos(permisos) {
        var contenedor = $('#modulos_list');
        contenedor.empty();

        if (window.PERMISOS_MENU.modulos.length === 0) {
            $('#modulos_message').text('No hay módulos activos disponibles.').show();
            $('#guardar_permisos').hide();
        } else {
            $('#modulos_message').hide();
            $('#guardar_permisos').show();

            window.PERMISOS_MENU.modulos.forEach(function(modulo) {
                var checked = permisos.hasOwnProperty(modulo.id_modulo) ? permisos[modulo.id_modulo] === 1 : true;
                var moduloHtml = '<div class="col-md-4 mb-3">'
                    + '<div class="form-check">'
                    + '<input class="form-check-input" type="checkbox" id="modulo_' + modulo.id_modulo + '" value="1"' + (checked ? ' checked' : '') + '>'
                    + '<label class="form-check-label" for="modulo_' + modulo.id_modulo + '">' + modulo.nombre + '</label>'
                    + '</div>'
                    + '</div>';
                contenedor.append(moduloHtml);
            });
        }
    }

    function cargarPermisos(entidadId, tipo) {
        if (!entidadId) {
            $('#permisos_container').hide();
            return;
        }

        var data = {
            tipo: tipo,
            id_usuario: tipo === 'usuario' ? entidadId : null,
            id_perfil: tipo === 'perfil' ? entidadId : null
        };

        $.post(window.BASE_URL + 'a_usuarios/obtener_permisos_menu', data, function(response) {
            if (typeof response === 'string') {
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    Swal.fire('Error', 'Respuesta inválida del servidor.', 'error');
                    return;
                }
            }

            if (response.status === 'success') {
                renderModulos(response.permisos || {});
                $('#permisos_container').show();
            } else {
                Swal.fire('Error', response.message || 'No se pudieron cargar los permisos.', 'error');
                $('#permisos_container').hide();
            }
        }).fail(function() {
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
            $('#permisos_container').hide();
        });
    }

    function guardarPermisos() {
        var tipo = $('#tipo_permiso').val();
        var entidadId = $('#seleccion_entidad').val();
        if (!entidadId) {
            Swal.fire('Atención', 'Seleccione un usuario o perfil antes de guardar.', 'warning');
            return;
        }

        var permisos = {};
        $('#modulos_list input[type="checkbox"]').each(function() {
            var moduloId = $(this).attr('id').replace('modulo_', '');
            permisos[moduloId] = $(this).is(':checked') ? 1 : 0;
        });

        var payload = {
            id_usuario: tipo === 'usuario' ? entidadId : null,
            id_perfil: tipo === 'perfil' ? entidadId : null,
            permisos: permisos
        };

        $.post(window.BASE_URL + 'a_usuarios/guardar_permisos_menu', payload, function(response) {
            if (typeof response === 'string') {
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    Swal.fire('Error', 'Respuesta inválida del servidor.', 'error');
                    return;
                }
            }

            if (response.status === 'success') {
                Swal.fire('Éxito', response.message, 'success');
            } else {
                Swal.fire('Error', response.message || 'No se pudieron guardar los permisos.', 'error');
            }
        }).fail(function() {
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        });
    }

    $('#tipo_permiso').on('change', function() {
        renderEntidadOptions($(this).val());
    });

    $('#seleccion_entidad').on('change', function() {
        var entidadId = $(this).val();
        var tipo = $('#tipo_permiso').val();
        if (entidadId) {
            cargarPermisos(entidadId, tipo);
        } else {
            $('#permisos_container').hide();
            $('#modulos_list').empty();
            $('#modulos_message').hide();
        }
    });

    $('#guardar_permisos').on('click', guardarPermisos);

    renderEntidadOptions($('#tipo_permiso').val());
});
