$(function () {
    var ban0 = "0";
    var fechaIni = '';
    var fechaFin = '';
    
    // Objeto global para almacenar avances y observaciones de forma temporal
    let datosGestionTemporal = {};

    if ($('#opc_pag').val() == "listado") {

        function cargar_listado(tipo_fuente) {
            Swal.fire({
                title: "Por favor espere!",
                text: "Cargando lista de Documentos.",
                showConfirmButton: false
            });

            $.post("/plan_mejora/listar_tabla", {
                tipo: "" + tipo_fuente + ""
            }, function (data_carg) {
                $("#simple-table").DataTable().destroy();
                $("#simple-table").empty();
                $("#simple-table").append(data_carg);
                $('#simple-table').DataTable({
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por pagina",
                        "zeroRecords": "No se encontraron resultados en su busqueda",
                        "searchPlaceholder": "Buscar registros",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty": "No existen registros",
                        "infoFiltered": "(filtrado de _MAX_ registros)",
                        "search": "Buscar:",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    },
                    responsive: true
                });
                $('[data-toggle="tooltip"]').tooltip();
                Swal.close();
            });
        }
    } else if ($('#opc_pag').val() == "ingreso") {
        // ... (Tu código actual para TinyDatePicker) ...
        ocultar_secciones();
    } else if ($('#opc_pag').val() == "gestionar") {
        var tipo_fuente = $('#tipoFuente').val();

        if (tipo_fuente == '0') {
            ocultar_secciones();
            $('#sec_Rondas').css('display', 'flex');
            $('#txtronda').prop("disabled", true);
            $('#item').prop("disabled", true);
        } else if (tipo_fuente == '1') {
            ocultar_secciones();
            $('#sec_Quejas').css('display', 'flex');
        } else if (tipo_fuente == '2') {
            ocultar_secciones();
            $('#sec_SucesosS').css('display', 'flex');
        } else if (tipo_fuente == '3') {
            ocultar_secciones();
            $('#sec_Por_Auditorias').css('display', 'flex');
        } else if (tipo_fuente == '4') {
            ocultar_secciones();
            $('#sec_Por_Indicadores').css('display', 'flex');
        } else if (tipo_fuente == '5') {
            ocultar_secciones();
            $('#sec_Por_Comites').css('display', 'flex');
        } else if (tipo_fuente == '6') {
            ocultar_secciones();
            $('#sec_Accidente_de_Trabajo').css('display', 'flex');
        }
        
        $('#nombreservicio').prop("disabled", true);
        $('#hallazgos').prop("disabled", true);
        $('#responsable').prop("disabled", true);
        $('#tipo_fuente').prop("disabled", true);
        $('#tipo_accion').prop("disabled", true);
        $('#accionM').prop("disabled", true);

        var id_plan = $('#idreg').val();
        
        // Cargar Seguimiento
        $.post("/plan_mejora/cargar_acciones", { idreg: id_plan }, function (data_carg1) {
            $("#acciones-table").DataTable().destroy();
            $("#acciones-table").empty();
            $("#acciones-table").append(data_carg1);
        }); 

        let contador = 1;

        $('#btnAgregarAccionA').on('click', function () {
            var ban = 0;
            var texto = '';
            const actividadTxt = $('#actividad').val().trim();
            const responsableId = $('#empleados_plan').val().trim();
            const responsableTxt = $('#empleados_plan option:selected').text().trim();
            const fechaTxt = $('#fechaComp').val().trim();

            if (!actividadTxt) {
                texto = texto + "Por favor ingrese una actividad.!<br>";
                ban = 1;
            }
            if (!responsableTxt || responsableId === "") {
                texto = texto + "Por favor seleccione un responsable.!<br>";
                ban = 1;
            }
            if (!fechaTxt) {
                texto = texto + "Por favor seleccione la fecha máxima.!<br>";
                ban = 1;
            }

            if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                agregarFilaActividad(contador, actividadTxt, responsableId, responsableTxt, fechaTxt);
                $('#actividad').val('');
                $('#empleados_plan').val('');
                $('#fechaComp').val('');
                contador++;
            }
        });

        function agregarFilaActividad(id, descripcion, idresponsable, responsable, fechaComp) {
            const fila = document.createElement('tr');
            fila.dataset.id = id;

            const colNum = document.createElement('td');
            colNum.textContent = id;

            const colDesc = document.createElement('td');
            const input_hidden = document.createElement('input');
            input_hidden.type = 'hidden';
            input_hidden.value = idresponsable; 
            colDesc.className = 'desc';
            colDesc.textContent = descripcion;
            colDesc.appendChild(input_hidden);

            const colResp = document.createElement('td');
            colResp.className = 'respo';
            colResp.textContent = responsable;

            const colFechaComp = document.createElement('td');
            colFechaComp.className = 'fecha';
            colFechaComp.textContent = fechaComp;

            // Columna de Acciones con los nuevos botones
            const colAcciones = document.createElement('td');
            colAcciones.className = 'text-nowrap';

            const btnGestion = $(`<button type="button" class="btn btn-xs btn-outline-info btn-gestionar-act mr-1" title="Cargar Avance"><i class="fa fa-upload"></i></button>`);
            const btnObs = $(`<button type="button" class="btn btn-xs btn-outline-primary btn-observacion mr-1" title="Evaluar cumplimiento"><i class="fa fa-check-square"></i></button>`);
            const btnEliminar = $(`<button type="button" class="btn btn-xs btn-outline-danger eliminar" title="Eliminar"><i class="fa fa-trash"></i></button>`);

            $(colAcciones).append(btnGestion).append(btnObs).append(btnEliminar);

            fila.appendChild(colNum);
            fila.appendChild(colDesc);
            fila.appendChild(colResp);
            fila.appendChild(colFechaComp);
            fila.appendChild(colAcciones);

            document.querySelector('#actividades-table tbody').appendChild(fila);
        }

        // Eliminar fila
        $('#actividades-table').on('click', '.eliminar', function () {
            const idFila = $(this).closest('tr').data('id');
            delete datosGestionTemporal[idFila]; // Limpiamos la data si la eliminan
            $(this).closest('tr').remove();
        });

        // 1. Modal Gestión Actividad (Avance)
        $('#actividades-table').on('click', '.btn-gestionar-act', function () {
            const idFila = $(this).closest('tr').data('id');
            
            if (datosGestionTemporal[idFila]) {
                $('#modal_avance_desc').val(datosGestionTemporal[idFila].descripcion || '');
            } else {
                $('#modal_avance_desc').val('');
            }
            $('#modalGestionActividad').data('id-fila', idFila).modal('show');
        });

        // 2. Guardar Temporal Gestión
        $('#btnGuardarAvanceTemporal').on('click', function () {
            const idFila = $('#modalGestionActividad').data('id-fila');
            const desc = $('#modal_avance_desc').val();

            if (!desc) {
                Swal.fire("Atención", "Debe describir el desarrollo", "warning");
                return;
            }

            if (!datosGestionTemporal[idFila]) {
                datosGestionTemporal[idFila] = {};
            }
            
            datosGestionTemporal[idFila].descripcion = desc;
            datosGestionTemporal[idFila].archivos = $('#modal_evidencia_act')[0].files;

            $(`tr[data-id="${idFila}"] .btn-gestionar-act`).removeClass('btn-outline-info').addClass('btn-info text-white');
            $('#modalGestionActividad').modal('hide');
        });

        // 3. Modal Observaciones (Evaluación)
        $('#actividades-table').on('click', '.btn-observacion', function() {
            const idFila = $(this).closest('tr').data('id');
            
            if (datosGestionTemporal[idFila]) {
                $('#obs_seguimiento_txt').val(datosGestionTemporal[idFila].observacion || '');
                $('#evaluacion_objetivo').val(datosGestionTemporal[idFila].cumplimiento || '');
            } else {
                $('#obs_seguimiento_txt').val('');
                $('#evaluacion_objetivo').val('');
            }
            $('#modalObservacionSeguimiento').data('id-fila', idFila).modal('show');
        });

        // 4. Guardar Temporal Observaciones
        $('#btnAceptarObservacion').on('click', function() {
            const idFila = $('#modalObservacionSeguimiento').data('id-fila');
            const observacion = $('#obs_seguimiento_txt').val().trim();
            const cumplimiento = $('#evaluacion_objetivo').val();

            if (!observacion || !cumplimiento) {
                Swal.fire("Atención", "Por favor complete la observación y la evaluación.", "warning");
                return;
            }

            if (!datosGestionTemporal[idFila]) {
                datosGestionTemporal[idFila] = { descripcion: '', archivos: null };
            }

            datosGestionTemporal[idFila].observacion = observacion;
            datosGestionTemporal[idFila].cumplimiento = cumplimiento;

            $(`tr[data-id="${idFila}"] .btn-observacion`).removeClass('btn-outline-primary').addClass('btn-primary text-white');
            $('#modalObservacionSeguimiento').modal('hide');
        });
    }

    // VALIDACIÓN GENERAL
    function validar_datos_completos() {
        let mensaje = "";
        let error = false;

        if ($('#estado').val() === "") {
            mensaje += "* Debe seleccionar un estado general para el plan.<br>";
            error = true;
        }

        const filasActividades = $('#actividades-table tbody tr');
        if (filasActividades.length === 0) {
            mensaje += "* Debe agregar al menos una actividad al plan de acción.<br>";
            error = true;
        }

        filasActividades.each(function() {
            const id = $(this).data('id');
            
            // Si tiene gestión, debe tener evaluación
            if (datosGestionTemporal[id] && datosGestionTemporal[id].descripcion !== "") {
                if (!datosGestionTemporal[id].cumplimiento) {
                    mensaje += `* La actividad #${id} tiene avance pero le falta la evaluación en el modal de Observaciones.<br>`;
                    error = true;
                }
            }
        });

        if (error) {
            Swal.fire("¡Atención!", mensaje, "warning");
        }
        return !error;
    }

    // FUNCION PRINCIPAL DE GUARDADO
    function guardar_gestion_completa() {
        Swal.fire({
            title: "Guardando...",
            text: "Procesando actividades y archivos",
            icon: "info",
            allowOutsideClick: false,
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_guardar_gestion"));

        let listaActividades = [];
        $('#actividades-table tbody tr').each(function () {
            const id = $(this).data('id');
            listaActividades.push({
                temp_id: id,
                descripcion: $(this).find('.desc').text(),
                responsable: $(this).find('input[type="hidden"]').val(),
                fecha: $(this).find('.fecha').text(),
                gestion: datosGestionTemporal[id] || null
            });

            // Adjuntar archivos al FormData
            if (datosGestionTemporal[id] && datosGestionTemporal[id].archivos) {
                $.each(datosGestionTemporal[id].archivos, function (i, file) {
                    formData.append(`file_act_${id}[]`, file);
                });
            }
        });

        formData.append('actividades_data', JSON.stringify(listaActividades));

        $.ajax({
            url: "/plan_mejora/guardar_gestion",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res == "1") {
                    Swal.fire("¡Éxito!", "Plan y Gestión guardados correctamente", "success").then(() => {
                        window.location.href = '/plan_mejora/index';
                    });
                } else {
                    Swal.fire("Error", res, "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Error de comunicación con el servidor", "error");
            }
        });
    }

    // EVENTOS CLICK GLOBALES
    $(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (dato == "btn_guardar_gest") {
            if (validar_datos_completos()) {
                guardar_gestion_completa();
            }
            return false;
        }
        
        // Delegación de eventos para ver evidencias cargadas
        if ($(event.target).closest('.btn-ver-evidencia').length > 0) {
            const ruta = $(event.target).closest('.btn-ver-evidencia').data('ruta');
            window.open(ruta, '_blank');
        }

        // ... resto de tus eventos (btndetalle, btnMejora, etc) ...
    });

    $(document).on("change", function (event) {
        let dato = event.target.id;
        if (dato == "tipo_fuente") {
            cargar_listado($("#tipo_fuente").val());
        }
    });

    // Configuraciones de AceFileInput
    $('#evidencia2').aceFileInput({
        style: 'drop',
        droppable: true,
        container: 'border-1 border-dashed brc-grey-l1 brc-h-info-m2 shadow-sm',
        placeholderText: 'Cargue las Evidencias',
        placeholderIcon: '<i class="fa fa-cloud-upload-alt fa-3x text-info-m2 my-2"></i>',
        thumbnail: 'large',
        allowExt: 'gif|jpg|jpeg|png|webp|svg|pdf',
    });

    $('#modal_evidencia_act').aceFileInput({
        btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
        btnChooseText: 'Seleccionar Archivos',
        allowExt: 'pdf|jpg|png|jpeg'
    });

    $(".UpperCase").on("keypress", function () {
        $input = $(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        }, 50);
    });

    function ocultar_secciones() {
        $("#sec_Rondas, #sec_Quejas, #sec_SucesosS, #sec_Por_Auditorias, #sec_Por_Indicadores, #sec_Por_Comites, #sec_Accidente_de_Trabajo").css('display', 'none');
    }
});