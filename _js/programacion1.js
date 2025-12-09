$(function () {

    try { //not working in IE11
        $("#fechaprogramacion").inputmask("99/99/9999");
        $("#form-field-mask-2").inputmask("(999) 999-9999");
        $("#horaprogramacion").inputmask("99:99");
        $("#tiempohoras").inputmask("99:99");
        $("#form-field-mask-4").inputmask("~9.99 ~9.99 999");
          //$("").inputmask("9-a{1,3}9{1,3}")
    } catch (e) {};
   
    $('#procedimientos_agendamiento').select2({
        width: "100%",
        allowClear: true
    });

    $('#procedimientos_agendamiento').trigger('change');

    $('#tercerosM_agendamiento').select2({
        placeholder: 'Seleccione Casa Comercial...',
        width: "100%",
        multiple:"multiple",
        allowClear: true
    });
    $('#tercerosM_agendamiento').trigger('change');
    $('#cirujano_programacion').select2();
    $('#cirujano_programacion').trigger('change');
    $('#grupos_agendamiento').select2({
        width: "100%"
    });
    $('#grupos_agendamiento').trigger('change');
    $('#materiales_programacion').select2({
        placeholder: {
            id: '-1',
            text: 'Seleccione...'
        }
    });
    $('#materiales_programacion').trigger('change');
    
    var iddia_age='';
    var hora_age=''; 
    var horafin_age = '';

    if ($('#opc_pag').val() == "ingreso") {
        $('#btn_editar_paciente').css('display', 'none');

        // document.addEventListener('DOMContentLoaded', () => {
        //     document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
        //         if (e.keyCode == 13) {
        //             e.preventDefault();
        //         }
        //     }))
        // });
        moment.locale('es-CL');
        var TinyDatePicker = DateRangePicker.TinyDatePicker;
        TinyDatePicker('#fechaprogramacion', {
            
            lang:{
                
                "customRangeLabel": "Custom",
                "days": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sáb"
                ],
                "months": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                today: 'Hoy',
                clear: 'Limpar',
                close: 'Cerrar'

            },
            format(date) {
                return date.toLocaleDateString('es-CL');
            },

            parse(str) {
                var date = new Date(str);
                return isNaN(date) ? new Date() : date;
            },
            inRange(dt){
                return dt.getDay()!=0;
            },

            mode: 'dp-below',
            
            min: Date()
            
          })
          .on('statechange', function(ev) {
            var fecha = $('#fechaprogramacion').val();
            var nfecha = fecha.split("/").reverse().join("-");
            var id_cirj = $('#id_cirujano').val();

            $('#val_fechapro').val(nfecha);
            $.post("/c_programacion/calcular_hora",{idciruj:""+id_cirj+"", idfecpr:""+nfecha+""}, function (data_resul) {
                var result = data_resul['hora'].horasig;
                var horaIni = data_resul['hora'].Hora_ini;
                
                if(result != ""){
                    $('#horaprogramacion').val(result); 
                }else{
                    $('#horaprogramacion').val(horaIni);
                }
            });
          });

        cargar_Dprocedimientos();
        $('#div_estado').css("display", "none");
        var ban = 0;
        
        $('#btn_guardar').click(function () {
            var texto = '';
            var ban = 0;
            if (($('#paciente').val() == "")) {
                $('#paciente').addClass("brc-danger");
                texto = texto + "*El paciente es obligatorio!<br>";
                ban = 1;
            }
            if ($('#fechaprogramacion').val() == "") {
                $('#fechaprogramacion').addClass("brc-danger");
                texto = texto + "* La Fecha es obligatoria!";
                ban = 1;
            }
            if ($('#tipoanestesia').val() == "") {
                $('#tipoanestesia').addClass("brc-danger");
                texto = texto + "* Seleccione un tipo de anestesia!";
                ban = 1;
            }
            
            if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
                return false;
            } else {
                // alert(horaprogramacion);
                guardar_registro();
            }
            return false;
        });   
        
    }else if ($('#opc_pag').val() == "listado") { // <---- LISTADO GENERAL ---->//

        cargar_listado();

        function cargar_listado() {
            Swal.fire({
                title: "Por favor espere!",
                text: "Cargando lista de Agendamiento Quirurgico.",
                showConfirmButton: false
            });

            $.post("/c_programacion/listar_tabla", {}, function (data_carg) {
                //alert(data_carg);
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
    }else if ($('#opc_pag').val() == "reporte") {

        cargar_reporte();

        function cargar_reporte() {
            Swal.fire({
                title: "Por favor espere!",
                text: "Cargando lista de Agendamiento Quirurgico.",
                showConfirmButton: false
            });

            $.post("/c_programacion/listar_solicitudes", {}, function (data_carg) {
                //alert(data_carg);
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
    }else if ($('#opc_pag').val() == "revisar") { //<--- REVISION & MODIFICACION---> 

        
        $idreg = $('#idreg').val();
        $('#btn_editar_paciente').css('display', 'flex');
        $('#tipoanestesia').prop('disabled', 'disabled');
        $('#cirujano_programacion').prop('disabled', 'disabled');
        $('#lateralidad').prop('disabled', 'disabled');
        $('#observaciones').prop('disabled', 'disabled');
        $('#btn_agregar_paciente').css('display', 'none');
        $('#btn_nuevoprocedimiento').css('display', 'none');

        $.post("/c_programacion/cargar_Dprocedimientosf", {
            idprog: "" + $idreg + ""
        }, function (data_carg) {
            // alert(data_carg);
            $("#procedimientoscx").DataTable().destroy();
            $("#procedimientoscx").empty();
            $("#procedimientoscx").append(data_carg);
            $('#procedimientoscx').DataTable({
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
                responsive: false
            });
            $('[data-toggle="tooltip"]').tooltip();
            Swal.close();
            return false;
        });

        
    }else if ($('#opc_pag').val() == "solicitar") {

        // $('#horaprogramacion').datetimepicker({
        //     timepicker: true,
        //     datepicker: false,
        //     format: 'HH:mm'
        // });
        $('.selectcc').select2({
            placeholder: 'Seleccione Casa Comercial...',
            width: "100%",
            allowClear: true
        });
        $('.selectcc').val(null).trigger('change');
        // $('#tercerosM_agendamiento3').val(null).trigger('change');
        // $("#estado").change();

        $idreg = $('#idreg').val();
        $('#tipoanestesia').prop('disabled', 'disabled');
        $('#cirujano_programacion').prop('disabled', 'disabled');
        $('#lateralidad').prop('disabled', 'disabled');
        $('#btn_agregar_paciente').css('display', 'none');
        $('#btn_nuevoprocedimiento').css('display', 'none');

        $.post("/c_programacion/cargar_Dprocedimientosf", {
            idprog: "" + $idreg + ""
        }, function (data_carg) {
            // alert(data_carg);
            $("#procedimientoscx").DataTable().destroy();
            $("#procedimientoscx").empty();
            $("#procedimientoscx").append(data_carg);
            $('#procedimientoscx').DataTable({
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
                responsive: false
            });
            $('[data-toggle="tooltip"]').tooltip();
            Swal.close();
            return false;
        });

        $('#btn_guardar_solicitud').click(function () {

            var texto = '';
            var ban = 0;

            // alert($('#materiales1').val()+"Entro a guardar");

            if($('#perfil_usuario').val()=="8"){
                if (($('#materiales1').val() != "")) {
                    if ($('#proveedoresQx_agendamiento1').val() == "") {
                        $('#proveedoresQx_agendamiento1').addClass("brc-danger");
                        texto = texto + "* La Casa Comercial esta vacia y es obligatoria!";
                        ban = 1;
                    }else if($('#email_casa1').val() == "") {
                        $('#email_casa1').addClass("brc-danger");
                        texto = texto + "* El email es obligatoria!";
                        ban = 1;
                    }
                }else if (($('#materiales2').val() != "")) {
                    if ($('#proveedoresQx_agendamiento2').val() == "") {
                        $('#proveedoresQx_agendamiento2').addClass("brc-danger");
                        texto = texto + "* La Casa Comercial esta vacia y es obligatoria!";
                        ban = 1;
                    }else if($('#email_casa2').val() == "") {
                        $('#email_casa2').addClass("brc-danger");
                        texto = texto + "* El email es obligatoria!";
                        ban = 1;
                    }
                }else if (($('#materiales3').val() != "")) {
                    if ($('#proveedoresQx_agendamiento3').val() == "") {
                        $('#proveedoresQx_agendamiento3').addClass("brc-danger");
                        texto = texto + "* La Casa Comercial esta vacia y es obligatoria!";
                        ban = 1;
                    }else if($('#email_casa3').val() == "") {
                        $('#email_casa3').addClass("brc-danger");
                        texto = texto + "* El email es obligatoria!";
                        ban = 1;
                    }
                }
                if ($('#estado').val() == "0" || $('#estado').val() == "1" ) {
                    $('#estado').addClass("brc-danger");
                    texto = texto + "* Estado no permitido para su perfil!";
                    ban = 1;
                }else if($('#estado').val() == "3" ){
                    if($('#observaciones').val()==""){
                        $('#observaciones').addClass("brc-danger");
                        texto = texto + "* El campo observaciones es obligatorio!";
                        ban = 1;
                    }
                }
            }else{
                texto = texto + "*Tu perfil no permite guardar los cambios!";
                ban = 1;
            }
            if (ban == 1) {
                    Swal.fire("¡Atención!", texto, "warning");
                    return false;
                } else {
                    enviar_solicitudM();
                }
                return false;

        });
    }

    $(document).on("click", function (event) {
        event.preventDefault();
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (datos[0] == "btneditar") {
            idreg = datos[1];
            // $('#newModalLabel').html('Modificar contratos con terceros');

            window.open('/c_programacion/revisar/' + idreg, '_parent');

            return false;
        }

        if (datos[0] == "btnsolicitar") {
            idreg = datos[1];
            window.open('/c_programacion/enviar_solicitud/' + idreg, '_parent');
            return false;
        }

        if (datos[0] == "btninactivar") {
            //jQuery(function(){
            var id_reg = datos[1];
            var nom_reg = $('#nombre_' + id_reg).val();
            Swal.fire({
                title: "Desea Inactivar el Registro: '" + nom_reg + "' ?",
                text: "Podras activarlo en cualquier momento con la edición!",
                icon: "warning",
                showCancelButton: true,
                scrollbarPadding: false,
                confirmButtonText: 'Si, Inactivar!',
                cancelButtonText: 'No, cancelar!',
                cancelButtonColor: '#d33',
                reverseButtons: false,
                customClass: {
                    'confirmButton': 'btn btn-green mx-2 px-3',
                    'cancelButton': 'btn btn-red mx-2 px-3'
                }
            }).then(function (result) {
                if (result.value) {
                    $.post("/c_programacion/inactivar", {
                        idreg: "" + id_reg + ""
                    }, function (data_form) {
                        //alert(data_form);
                        if (data_form == "1") {
                            Swal.fire({
                                title: 'Inactivado!',
                                text: 'El registro se ha inactivado.',
                                type: 'success',
                                icon: 'success',
                                customClass: {
                                    'confirmButton': 'btn btn-info px-5'
                                }
                            }).then((value) => {
                                cargar_listado();
                            });
                        } else {
                            Swal.fire("¡Error!", "Se presento el siguiente error: " + data_form, "error");
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.DismissReason.cancel;
                }
            });

            return false;
        }

        if (datos[0] == "btndetalle") {
            idreg = datos[1];

            $.post("/c_programacion/ver_registro", {
                idreg: "" + idreg + ""
            }, function (data_carg) {
                //alert(data_carg);
                $("#modalForm1").html(data_carg);
            });

            $('#view-registro').modal({
                show: true,
                keyboard: false
            });
            return false;
        }

        if (dato == "btn_pdf") {
            window.open('/c_programacion/pdf', '_blank');
        }

        if (dato == "btn_excel") {
            window.open('/c_programacion/excel', '_blank');
        }

        if (dato == "btn_guardar_revision") {           
            // alert('guardar');
            var texto = '';
            var ban = 0;
            if($('#perfil_usuario').val()!='3'){
                if($('#perfil_usuario').val()!='6'){
                    if($('#usuario_crea').val()==$('#idusuariactual').val()){

                        if ($('#estado').val() != "0") {
                            $('#estado').addClass("brc-danger");
                            texto = texto + "* Estado no permitido para su perfil!";
                            ban = 1;
                        }
                    }else{

                        if ($('#estado').val() == "1"){
                            if (($('#salaqx').val() == "")) {
                                $('#salaqx').addClass("brc-danger");
                                texto = texto + "*La Sala es obligatoria!<br>";
                                ban = 1;
                            } 
                        }else if($('#estado').val() == "2"){
                            if ($('#materiales_1').val()==""){
                                if ($('#salaqx').val() == "") {
                                    $('#salaqx').addClass("brc-danger");
                                    texto = texto + "*La Sala es obligatoria!<br>";
                                    ban = 1;
                                }
                            }else{
                                texto = texto + "*Este estado no esta disponible, tiene materiales la solicitud!<br>";
                                ban = 1;
                            }
                        }else if ($('#estado').val() == "3"){
                            if (($('#observaciones').val() == "")) {
                                $('#observaciones').addClass("brc-danger");
                                texto = texto + "*Las observaciones son obligatorias!<br>";
                                ban = 1;
                            }
                        }
                    }
                }
            }else{
                texto = texto + "*Tu perfil no permite guardar los cambios!<br>";
                ban = 1;
            }

            if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
                return false;
            } else {
                guardar_revision();
            }
            return false;
        }

        if (dato == "btn_agregar_paciente") {

            $('#lblotra_entidad_salud').css("display", "none");
            $('#otra_entidad_salud').css("display", "none");
            $('#div_estadop').css("display", "none");
            // $('#lblestado').css("display", "none");
            $("#form_guardarpaciente")[0].reset();
            const fechaNacimiento = $("#fecha_nacimiento").val();
            
            $('#fecha_nacimiento').on('change', function () {
                // alert(fechaNacimiento);
                if (this.value) {
                    $('#edad').val(`${calcularEdad(this.value)} `);
                    // alert(edad);
                }
            });

            $('#newMPaciente').modal({
                show: true,
                keyboard: false
            });
            return false;
        }

        if (dato == "btn_editar_paciente") {

            idreg = $('#idpaciente').val();
            $('#div_estadop').css("display", "flex");
            $('#newModalLabelEmp').html('Modificar pacientes');
            $.post("/c_programacion/modificar_paciente",{idreg: ""+idreg+""}, function(data_preg){
                $('#idregistropa').val(data_preg['pacientes'].id_paciente);
                $("#Tipo_docidentidad_pacientes").val(data_preg['pacientes'].id_tipodocumento);
                $("Tipo_docidentidad_pacientes").change();
                $("#numero_id").val(data_preg['pacientes'].numero_id);
                $("#nombres").val(data_preg['pacientes'].nombres);
                $("#apellidos").val(data_preg['pacientes'].apellidos);
                $("#fecha_nacimiento").val(data_preg['pacientes'].fecha_nacimiento);

                $("#eps_pacientes").val(data_preg['pacientes'].id_entidad_salud);
                $("#eps_pacientes").change();
                $("#otra_entidad_salud").val(data_preg['pacientes'].otra_entidad_salud);
                $("#telefono").val(data_preg['pacientes'].telefono);
                $("#correo").val(data_preg['pacientes'].correo);
                $("#estadoP").val(data_preg['pacientes'].estado);
                // alert (data_preg['pacientes'].fecha_nacimiento);
                $("#edad").val(`${calcularEdad(data_preg['pacientes'].fecha_nacimiento)}`);
            });

            $('#btn_guardar').css("display", "none");
            $('#btn_actualizar').css("display", "block");
            $('#newMPaciente').modal({
                show: true,
                keyboard: false
            });
        }

        if (dato == "btn_guardar_paciente"){

            var ban = 0;
            var texto = '';
            var cedula = $('#numero_id').val();
            if (($('#numero_id').val() == "")) {
                $('#numero_id').addClass("brc-danger");
                texto = texto + "* El Numero de documento de indentidad es obligatorio!<br>";
                ban = 1;
            }
            if ($('#nombres').val() == "") {
                $('#nombres').addClass("brc-danger");
                texto = texto + "* Los Nombres son obligatorios!<br>";
                ban = 1;
            }

            if ($('#Apellidos').val() == "") {
                $('#Apelidos').addClass("brc-danger");
                texto = texto + "* Los apellidos son obligatorios!<br>";
                ban = 1;
            }

            if ($('#edad').val() == "") {
                $('#edad').addClass("brc-danger");
                texto = texto + "* la edad es obligatoria!<br>";
                ban = 1;
            }

            if ($('#eps_pacientes').val() == "") {
                $('#eps_pacientes').addClass("brc-danger");
                texto = texto + "* la entidad pagadora es obligatoria!<br>";
                ban = 1;
            }
            if ($("#eps_pacientes").val() == 10) {
                if ($('#otra_entidad_salud').val() == "") {
                    $('#otra_entidad_salud').addClass("brc-danger");
                    texto = texto + "* Otra Entidad. Cual?!<br>";
                    ban = 1;
                }
            }

            if ($('#telefono').val() == "") {
                $('#telefono').addClass("brc-danger");
                texto = texto + "* El telefono es obligatorio!<br>";
                ban = 1;
            }

            if ($('#correo').val() == "") {
                $('#correo').addClass("brc-danger");
                texto = texto + "* El Correo es obligatorio!<br>";
                ban = 1;
            }

            if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                //alert("Datos: "+datos_form);
                Swal.fire({
                    title: "Por favor espere!",
                    text: "Guadando la información.",
                    showConfirmButton: false
                });
                var datos_form = $("#form_guardarpaciente").serialize();
                $.post("/c_programacion/guardar_paciente", datos_form, function (data_form) {
                    Swal.close();
                    if (data_form == "1") {
                        //jQuery(function(){
                        Swal.fire({
                                title: "¡Correcto!",
                                text: "Registro ingresado correctamente!",
                                icon: "success"
                            })
                            .then((willDelete) => {
                                $("#form_guardarpaciente")[0].reset();
                                $('#newMPaciente').modal('hide');

                                $.post("/c_programacion/cargar_paciente", {
                                    paci: "" + cedula + ""
                                }, function (data_paci) {

                                    $('#idpaciente').val(data_paci['pacientes'].id_paciente);
                                    $('#cedula').val(cedula);
                                    $('#paciente').val(data_paci['pacientes'].paciente);
                                    $('#btn_editar_paciente').css('display', 'flex');

                                });
                            });
                    } else {
                        Swal.fire("¡Error!", data_form, "error");
                    }
                });
                return false;
            }
            return false;
        }

        if(dato == "btn_actualizar_paciente") {
            var ban=0;
            var texto='';
            if( ($('#numero_id').val()=="")){
                $('#numero_id').addClass("brc-danger");
                texto=texto+"* El Numero de documento de indentidad es obligatorio!<br>";
                ban=1;
            }
            
            if( $('#nombres').val()=="" ){
                $('#nombres').addClass("brc-danger");
                texto=texto+"* Los Nombres son obligatorios!<br>";
                ban=1;
            }

            if( $('#Apellidos').val()=="" ){
                $('#Apelidos').addClass("brc-danger");
                texto=texto+"* Los apellidos son obligatorios!<br>";
                ban=1;
            }      
              
            if(ban==1) {  
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                //alert("Datos: "+datos_form);
                Swal.fire({   
                  title: "Por favor espere!",   
                  text: "Actualizando la información.", 
                  showConfirmButton: false 
                });
                var datos_form = $("#form_guardar").serialize();
                $.post("/c_programacion/actualizar_paciente", datos_form , function(data_form){
                  Swal.close();
                    if(data_form=="1") {
                    //jQuery(function(){
                        Swal.fire({
                            title: "¡Correcto!",
                            text: "Registro actualizado correctamente!",
                            icon: "success"
                        })
                        .then((willDelete) => {
                            $("#form_guardar")[0].reset();
                            cargar_listado();
                            $('#newModal').modal('hide');
                        });
                    //});
                    }else {
                        Swal.fire("¡Error!", data_form, "error");
                    }
                });      
                return false;
                }
                return false;
            }

        //******************************** TABLA PROCEDIMIENTOS ***************************

        if (dato == "btn_nuevoprocedimiento") {
            $("#form_guardar_pro")[0].reset();
            $('#btn_guardar_proc').css("display", "block");
            $('#btn_actualizar_proc').css("display", "none");
            $('#newModal').modal({
                show: true,
                keyboard: false
            });
            return false;
        }

        if (dato == "btn_guardar_proc") {
            var datos_form = $("#form_guardar_pro").serialize();
            $.post("/c_programacion/guardar_procedimientos", datos_form, function (data_form) {
                //alert(data_form);
                if (data_form == "1") {
                    $("#form_guardar_pro")[0].reset();
                    $('#procedimientos_agendamiento').val(null).trigger('change');
                    $('#grupos_agendamiento').val(null).trigger('change');
                    $('#div_chk').html('');
                    $('#tercerosM_agendamiento').val(null).trigger('change');

                    cargar_Dprocedimientos();
                    $('#newModal').modal('hide');

                } else {
                    Swal.fire("¡Error!", data_form, "error");
                }
            });
        }

        if(dato == "btn_actualizar_proc") {
            var ban=0;
            var texto='';

            if(ban==1) {
            Swal.fire("¡Atención!", texto, "warning");
            } else {
            //alert("Datos: "+datos_form);
            Swal.fire({
                title: "Por favor espere!",
                text: "Actualizando la información.",
                showConfirmButton: false
            });
            var datos_form = $("#form_guardar_pro").serialize();
            $.post("/c_programacion/actualizar_proc", datos_form, function(data_form){
                Swal.close();
                if(data_form=="1") {
                //jQuery(function(){
                    Swal.fire({
                        title: "¡Correcto!",
                        text: "Registro actualizado correctamente!",
                        icon: "success"
                    })
                    .then((willDelete) => {
                        $("#form_guardar_pro")[0].reset();
                        cargar_Dprocedimientosf();
                        $('#newModal').modal('hide');
                    });
                //});
                } else {
                    Swal.fire("¡Error!", data_form, "error");
                }
            });
                return false;
            }
            return false;
        }
    });

    function guardar_registro() {
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });
        var datos_form = $("#form_guardar").serialize();
        //alert(datos_form);
        $.post("/c_programacion/guardar", datos_form, function (data_form) {
            //alert(data_form);
            Swal.close();
            if (data_form == "1") {
                jQuery(function () {
                    Swal.fire({
                            title: "¡Correcto!",
                            text: "Registro ingresado correctamente!",
                            icon: "success"
                        })
                        .then((willDelete) => {
                            window.open('/c_programacion/index', '_parent');
                        });
                });
            } else {
                Swal.fire("¡Error!", data_form, "error");
            }
        });
    }

    function guardar_revision() {
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });
        var datos_form = $("#form_revisar").serialize();
        //alert(datos_form);
        $.post("/c_programacion/guardar_revision", datos_form, function (data_form) {
            //alert(data_form);
            if (data_form == "1") {
                jQuery(function () {
                    Swal.close();
                    Swal.fire({
                            title: "¡Correcto!",
                            text: "Registro ingresado correctamente!",
                            icon: "success"
                        })
                        .then((willDelete) => {
                            window.open('/c_programacion/index', '_parent');
                        });
                });
            } else {
                Swal.close();
                Swal.fire("¡Error!", data_form, "error");
            }
        });
    }

    function enviar_solicitudM() {
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_smateriales"));

        $.ajax({
            url: "/c_programacion/enviar_solicitudM",
            type: "POST",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(res){
            if(res >= 1) {
                Swal.fire({
                    title: "¡Correcto!",
                    text: "Registro Ingresado correctamente!",
                    icon: "success"
                })
                .then((willDelete) => {
                    window.open('/c_programacion/index','_parent');
                });
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        });
        return false;
    }

    function cargar_Dprocedimientos() {
        $.post("/c_programacion/cargar_Dprocedimientos", {}, function (data_carg) {
            //alert(data_carg);
            $("#procedimientoscx").DataTable().destroy();
            $("#procedimientoscx").empty();
            $("#procedimientoscx").append(data_carg);
            $('#procedimientoscx').DataTable({
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
                responsive: false
            });
            $('[data-toggle="tooltip"]').tooltip();
            Swal.close();
            return false;
        });
        return false;
    }

    function cargar_Dprocedimientosf(){
        $.post("/c_programacion/cargar_Dprocedimientosf", {
            idprog: "" + $idreg + ""
        }, function (data_carg) {
            // alert(data_carg);
            $("#procedimientoscx").DataTable().destroy();
            $("#procedimientoscx").empty();
            $("#procedimientoscx").append(data_carg);
            $('#procedimientoscx').DataTable({
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
                responsive: false
            });
            $('[data-toggle="tooltip"]').tooltip();
            Swal.close();
            return false;
        });
        return false;
    }

    $('#tiempohoras').blur(function (e){
        e.preventDefault();
        var horas = $('#tiempohoras').val();
        if(horas>24){
          // Swal.fire("Tiempo en horas excede el valor permitido!");
            $('#tiempohoras').val('');
            $('#tiempohoras').focus();
        }
    });

    $('#tiempominutos').blur(function (e){
        e.preventDefault();
        var minutos = $('#tiempominutos').val();
        if(minutos>59){
          //Swal.fire("Tiempo en munutos excede el valor permitido!");
            $('#tiempominutos').val('');
            $('#tiempominutos').focus();
        }
    });

    $('#cedula').blur(function (e){
            e.preventDefault();
            var cedula = $('#cedula').val();
            if(cedula !=""){
                $.post("/c_programacion/cargar_paciente", {
                    paci: "" + cedula + ""
                    }, function (data_paci) {

                    $('#idpaciente').val(data_paci['pacientes'].id_paciente);
                    $('#paciente').val(data_paci['pacientes'].paciente);

                    if ($('#idpaciente').val() != "") {
                        $('#btn_agregar_paciente').css("display", "none");
                        $('#btn_editar_paciente').css('display', 'flex');
                    } else {
                        Swal.fire("Paciente no Existe!");
                        $('#btn_agregar_paciente').css("display", "block");
                        $('#btn_editar_paciente').css('display', 'none');
                    }
                });
            }
        });


    $(".UpperCase").on("keypress", function () {
        $input = $(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        }, 50);
    });

    $(document).on("change", function (event) {
        event.preventDefault();

        var datos = event.target.id.split("_");
        var dato = event.target.id;
        var ck= event.target.checked;

        if (dato == "eps_pacientes") {

            if ($("#eps_pacientes").val() != 10) {

                $('#lblotra_entidad_salud').css("display", "none");
                $('#otra_entidad_salud').css("display", "none");

            } else {

                $('#lblotra_entidad_salud').css("display", "block");
                $('#otra_entidad_salud').css("display", "block");
            }
        }

        if(datos[0] == "botones" ){
            if($('#'+dato+' option:selected').val()=="2"){
                
                idreg = datos[1];
                $.post("/c_programacion/eliminar_dprocedimiento", {idreg: "" + idreg + ""}, function (data_preg) {
                    cargar_Dprocedimientos();
                    cargar_Dprocedimientosf();
                });
                return false;
            }else if($('#'+dato+' option:selected').val()=="1"){
                var materiales='';
                var proveedores='';
                var grupo='';
                idreg = datos[1];
                $('#newModalLabel').html('Modificar Procedimiento');
                $.post("/c_programacion/modificar_procedimiento",{idreg: ""+idreg+""}, function(data_preg){
                    materiales = data_preg['procedimiento'].Id_Materiales;
                    proveedores = data_preg['procedimiento'].Proveedores;
                    // alert(proveedores.split(','));
                    grupo = data_preg['procedimiento'].Grupo;

                    $('#idregistro').val(idreg);
                    $('#id_programacion').val(data_preg['procedimiento'].Id_programacion);
                   
                    $('#procedimientos_agendamiento').val(data_preg['procedimiento'].Id_procedimiento).trigger('change');
                    // $('#procedimientos_agendamiento').trigger('change');
                   
                    if(grupo!=""){
                        $('#grupos_agendamiento').val(grupo).trigger('change');
                        // $('#grupos_agendamiento').trigger('change');

                        $.post("/c_programacion/cargar_materiales", {proc: ""+grupo+ "",mate:""+materiales+""}, function (data_mate) {
                            $('#div_chk').html(data_mate);
                        });
                    }

                    $('#tercerosM_agendamiento').val(proveedores.split(',')).trigger('change');
                    // $('#tercerosM_agendamiento').trigger('change');

                });

                $('#btn_guardar_proc').css("display", "none");
                $('#btn_actualizar_proc').css("display", "block");
                $('#newModal').modal({
                    show: true,
                    keyboard: false
                });
            }
        }

        // if(dato =="estado"){
            
        //     if($('#estado').val()=="0"){
        //         alert("entro aqui 0");
        //         if($('#perfil_usuario').val()==3|| $('#perfil_usuario').val()==6 ||$('#perfil_usuario').val()==0 ){
                    
        //         }else{
        //             Swal.fire("Estado no Permitido para el perfil del usuario!");
        //         }
        //     }else if($('#estado').val()=="1"){
        //         alert("entro aqui 1");
        //         if($('#perfil_usuario').val()!="6"){
        //             Swal.fire("Estado no Permitido para el perfil del usuario!");
        //         }
        //     }else if($('#estado').val()=="2"){
        //         alert("entro aqui 2");
        //         if($('#perfil_usuario').val()=="6"||$('#perfil_usuario').val()=="8"){
        //         }else{
        //             Swal.fire("Estado no Permitido para el perfil del usuario!");
        //         }
        //     }
        //     if($('#estado option:selected').val()=="3"){
        //         document.getElementById('observaciones').readOnly = false;
        //     }else{
        //         document.getElementById('observaciones').readOnly = true;
        //     }
        // }

        if(dato =="grupos_agendamiento"){
            if ($('#grupos_agendamiento option:selected').val() == "8") {
                $('#lblmateriales').css("display","block");
                $('#div_chk').css("display","block");
                var otros = "<input type='text' name='otros' id='otros' class='form-control col-sm-11 col-md-12 UpperCase'>";
                $('#div_chk').html(otros);
                $('#tercerosM_agendamiento').prop("disabled", false);
            }else if ($('#grupos_agendamiento option:selected').val() == "9") {
                $('#lblmateriales').css("display","none");
                $('#tercerosM_agendamiento').prop("disabled", true);
                $('#div_chk').css("display","none");
            }else {
                $('#lblmateriales').css("display","block");
                $('#div_chk').css("display","block");
                Swal.fire({
                    title: "Por favor espere!",
                    text: "Cargando los Materiales.",
                    showConfirmButton: false
                });
                $.post("/c_programacion/cargar_materiales", {
                    proc: "" + $('#grupos_agendamiento option:selected').val() + ""
                }, function (data_mate) {
                    //alert(data_muni+" -- "+$('#departamentos_empresa option:selected').val());
                    $('#div_chk').html(data_mate);
                    Swal.close();

                });
                $('#tercerosM_agendamiento').prop("disabled", false);
            }
        }

        if(dato =="ck_bloque"){
            var idciruj= $('#id_cirujano').val();
            if(ck==true){
                $.post("/c_programacion/cargar_agenda", {idciruj:""+idciruj+""}, function (data_carg) {
                    iddia_age = data_carg['agenda_cx'].Dia;
                    horaini_age = data_carg['agenda_cx'].Inicio;
                    horafin_age = data_carg['agenda_cx'].Final;
                });
                TinyDatePicker('#fechaprogramacion', {
                    format(date) {
                        return date.toLocaleDateString('es-CL');
                    },

                    parse(str) {
                        var date = new Date(str);
                        return isNaN(date) ? new Date() : date;
                    },

                    inRange(dt) {
                        return dt.getDay()==iddia_age;
                    },
                    mode: 'dp-below',
            
                    min: Date()
                }).on('statechange', function(ev) {
                    var fecha = $('#fechaprogramacion').val();
                    var nfecha = fecha.split("/").reverse().join("-");
                    var id_cirj = $('#id_cirujano').val();
                    $('#horaprogramacion').val(''); 
                    $('#val_fechapro').val(nfecha.reverse().join("-"));
                    $.post("/c_programacion/calcular_hora",{idciruj:""+id_cirj+"", idfecpr:""+nfecha+""}, function (data_resul) {
                        var result = data_resul['hora'].horasig;
                        var horaIni = data_resul['hora'].Hora_ini;
                        
                        if(result != ""){
                            $('#horaprogramacion').val(result); 
                        }else{
                            $('#horaprogramacion').val(horaIni);
                        }
                    });
                })
                ;               
            }else{
                
                TinyDatePicker('#fechaprogramacion', {
                    format(date) {
                        return date.toLocaleDateString('es-CL');
                    },

                    inRange(dt) {
                        return dt.getDay()!=0;
                    },
                    parse(str) {
                        var date = new Date(str);
                        return isNaN(date) ? new Date() : date;
                     },
                    mode: 'dp-below',
            
                    min: Date()
                }); 
            }      
        }

        
        if(dato == 'proveedoresQx_agendamiento1'){
            var idcasa= $('#proveedoresQx_agendamiento1 option:selected').val();
            $.post("/c_programacion/cargar_email",{idcasa:""+idcasa+""}, function (data_resul) {
                $('#email_casa1').html(data_resul);
            });
        }

        if(dato == 'proveedoresQx_agendamiento2'){
            var idcasa= $('#proveedoresQx_agendamiento2 option:selected').val();
            $.post("/c_programacion/cargar_email",{idcasa:""+idcasa+""}, function (data_resul) {
                $('#email_casa2').html(data_resul);
            });
        }

        if(dato == 'proveedoresQx_agendamiento3'){
            var idcasa= $('#proveedoresQx_agendamiento3 option:selected').val();
            $.post("/c_programacion/cargar_email",{idcasa:""+idcasa+""}, function (data_resul) {
                $('#email_casa3').html(data_resul);
            });
        }

    });
    const calcularEdad = (fechaNacimiento) => {
        const fechaActual = new Date();
        const anoActual = parseInt(fechaActual.getFullYear());
        const mesActual = parseInt(fechaActual.getMonth()) + 1;
        const diaActual = parseInt(fechaActual.getDate());

        const anoNacimiento = parseInt(String(fechaNacimiento).substring(0, 4));
        const mesNacimiento = parseInt(String(fechaNacimiento).substring(5, 7));
        const diaNacimiento = parseInt(String(fechaNacimiento).substring(8, 10));

        let edad = anoActual - anoNacimiento;
        if (mesActual < mesNacimiento) {
            edad--;
        } else if (mesActual === mesNacimiento) {
            if (diaActual < diaNacimiento) {
                edad--;
            }
        }
        return edad;
    };

    try { //not working in IE11
        $("#fechaprogramacion").inputmask("99/99/9999");
        $("#form-field-mask-2").inputmask("(999) 999-9999");
        $("#horaprogramacion").inputmask("99:99");
        $("#tiempohoras").inputmask("99:99");
        $("#form-field-mask-4").inputmask("~9.99 ~9.99 999");
          //$("").inputmask("9-a{1,3}9{1,3}")
    } catch (e) {};

    $('input[type=text], input[type=email], input[type=password],  select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });

});