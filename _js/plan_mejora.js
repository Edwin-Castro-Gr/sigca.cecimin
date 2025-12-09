$(function () {
    var ban0 = "0";

    var fechaIni = '';
    var fechaFin = '';

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
    } else if ($('#opc_pag').val() == "ingreso") {

        var ban = 0;        
       
       // datepicker
        var TinyDatePicker = DateRangePicker.TinyDatePicker;
        TinyDatePicker('#fechaStart', {            
        lang:{  
        
            days: [
                'Dom',
                'Lun',
                 'Mar',
                'Mie',
                'Jue',
                'Vie',
                'Sáb'
            ],
        months: [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ],
        today: 'Hoy',
        clear: 'Limpar',
        close: 'Cerrar'
    },
    format(date) {
        return date.toLocaleDateString('es-CL',{ timeZone: 'UTC' });
    },

    parse(str) {
        var date = new Date(str);
        return isNaN(date) ? new Date() : date;
    },
    inRange(dt){
        return dt.getDay()!=0;
    },

    mode: 'dp-below',
    
    hilightedDate: new Date()

    // min: Date()
        
        })
        .on('statechange', function(ev) {
          var sfechaIni = $('#fechaStart').val();
          var nfechaIni = sfechaIni.split("-").reverse().join("-");    
          
          $('#val_fechaini').val(nfechaIni);
          fechaIni = $("#val_fechaini").val();
          // alert(nfechaIni);      
        });

        TinyDatePicker('#fechaEnd', {            
        lang:{  
            
            days: [
              'Dom',
              'Lun',
              'Mar',
              'Mie',
              'Jue',
              'Vie',
              'Sáb'
            ],
            months: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre'
              ],
            today: 'Hoy',
            clear: 'Limpar',
            close: 'Cerrar'

        },
        format(date) {
            return date.toLocaleDateString('es-CL',{ timeZone: 'UTC' });
        },

        parse(str) {
            var date = new Date(str);
            return isNaN(date) ? new Date() : date;
        },
        inRange(dt){
            return dt.getDay()!=0;
        },

        mode: 'dp-below',
        
        hilightedDate: new Date()

        // min: 
            
        })
        .on('statechange', function(ev) {     

          var sfechaFin = $('#fechaEnd').val();
          var nfechaFin = sfechaFin.split("-").reverse().join("-");;
          
          $('#val_fechafin').val(nfechaFin);
          fechaFin = $("#val_fechafin").val();
          // alert(nfechaFin);
          
        });        

        ocultar_secciones();

    } else if ($('#opc_pag').val() == "gestionar") {
        var ban = 0;
        var tipoFuente = $('#tipoFuente').val();
        
        if(tipo_fuente == '0'){
            ocultar_secciones();
            $('#sec_Rondas').css('display','flex');
            $('#txtronda').prop("disabled", true);
            $('#item').prop("disabled", true);                            
        }else if(tipo_fuente == '1'){
            ocultar_secciones();           
            $('#sec_Quejas').css('display','flex');        
        }else if(tipo_fuente == '2'){
            ocultar_secciones();             
            $('#sec_SucesosS').css('display','flex');
        
        }else if(tipo_fuente == '3'){
            ocultar_secciones();   
            $('#sec_Por_Auditorias').css('display','flex');
        }else if(tipo_fuente == '4'){
            ocultar_secciones();   
            $('#sec_Por_Indicadores').css('display','flex');
        }else if(tipo_fuente == '5'){
            ocultar_secciones();   
            $('#sec_Por_Comites').css('display','flex');
        }else if (tipo_fuente == '6'){
            ocultar_secciones();   
            $('#sec_Accidente_de_Trabajo').css('display','flex');
        }
        $('#nombreservicio').prop("disabled", true);
        $('#hallazgos').prop("disabled", true);
        $('#responsable').prop("disabled", true);
        $('#tipo_fuente').prop("disabled", true);
        $('#tipo_accion').prop("disabled", true);
        $('#accionM').prop("disabled", true);

        var id_plan = $('#idreg').val();
        // $.post("/plan_mejora/cargar_actividades", {
        //         idreg: "" + id_plan + ""
        //     }, function (data_carg) {

        //         $("#actividades-table").DataTable().destroy();
        //         $("#actividades-table").empty();
        //         $("#actividades-table").append(data_carg);
                
        // });
        // $.post("/plan_mejora/cargar_acciones", {
        //         idreg: "" + id_plan + ""
        //     }, function (data_carg1) {

        //         $("#acciones-table").DataTable().destroy();
        //         $("#acciones-table").empty();
        //         $("#acciones-table").append(data_carg1);
                
        // }); 

        let contador = 1;

        $('#btnAgregarAccionA').on('click', function () {
            var ban = 0;
            var texto = '';
            const actividadTxt = $('#actividad').val().trim();
            const responsableId= $('#empleados_plan').val().trim();
            const responsableTxt= $('#empleados_plan option:selected').text().trim();
            const fechaTxt = $('#fechaComp').val().trim();

            if (!actividadTxt) {
                texto = texto + "Por favor ingrese una actividad.!<br>";
                ban = 1;              
            }

            if (!responsableTxt) {
                texto = texto + "Por favor seleccione un responsable.!<br>";
                ban = 1;              
            }

            if (!fechaTxt) {
                texto = texto + "Por favor seleccione la fecha maxima a ejecutar la actividad.!<br>";
                ban = 1;              
            }

             if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
                return false;
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

            // Columna: #
            const colNum = document.createElement('td');
            colNum.textContent = id;

            // Columna: Descripción
            const colDesc = document.createElement('td');
            const input_hidden = document.createElement('input');
            input_hidden.type = 'hidden';
            input_hidden.textContent = idresponsable;
            colDesc.className = 'desc';
            colDesc.textContent = descripcion;
            

            // Columna: Responsable
            const colResp = document.createElement('td');
            colResp.className = 'respo';
            colResp.textContent = responsable;

            // Columna: fecha
            const colFechaComp = document.createElement('td');           
            colFechaComp.className = 'fecha';
            colFechaComp.textContent = fechaComp;

            colDesc.appendChild(input_hidden); 
            // Columna: Acciones
            const colAcciones = document.createElement('td');
            const btnEditar = crearBoton('Editar', 'editar');
            const btnGuardar = crearBoton('Guardar', 'guardar', true);
            const btnEliminar = crearBoton('Eliminar', 'eliminar');

            colAcciones.appendChild(btnEditar);
            colAcciones.appendChild(btnGuardar);
            colAcciones.appendChild(btnEliminar);

            // Agregar columnas a la fila
            fila.appendChild(colNum);
            fila.appendChild(colDesc);
            fila.appendChild(colResp);
            fila.appendChild(colFechaComp);

            document.querySelector('#actividades-table tbody').appendChild(fila);
        }

        function crearBoton(texto, clase, oculto = false) {
            const boton = document.createElement('button');
            boton.type = 'button';
            boton.textContent = texto;
            boton.className = clase;
            if (oculto) boton.style.display = 'none';
            return boton;
        }

        // Delegación de eventos
        $('#actividades-table').on('click', '.editar', function () {
            const fila = $(this).closest('tr');
            const desc = fila.find('.desc').text();
            fila.find('.desc').html(`<input type="text" class="edit_input" value="${desc}">`);
            fila.find('.editar').hide();
            fila.find('.guardar').show();
        });

        $('#actividades-table').on('click', '.guardar', function () {
            const fila = $(this).closest('tr');
            const nuevaDesc = fila.find('.edit_input').val();
            fila.find('.desc').text(nuevaDesc);
            fila.find('.editar').show();
            fila.find('.guardar').hide();
        });

        $('#actividades-table').on('click', '.eliminar', function () {
            $(this).closest('tr').remove();
            // Opcional: reordenar los números si lo deseas
        });

    }

    function guardar_gestionar() {
        Swal.close();
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_guardar"));
        $.ajax({
            url: "/plan_mejora/guardar_gestion",
            type: "POST",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (res) {
            if (res >= 1) {
                Swal.fire({
                        title: "¡Correcto!",
                        text: "Registro Ingresado correctamente!",
                        icon: "success"
                    })
                    .then((willDelete) => {
                        window.open('/plan_mejora/index', '_parent');
                    });
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        });
    }

    $(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (datos[0] == "btnMejora") {
      
            var id_resp = datos[1];
            $.post("/r_gestion/datos_respuestas", {
                idreg: "" + id_resp + ""
            }, function (data_preg) {

                $("#idregistro").val(id_resp);
                $("#txtservicio").val(data_preg['datos_resp'].servicio);
                $("#txtronda").val(data_preg['datos_resp'].ronda);
                $("#txtseccion").val(data_preg['datos_resp'].seccion);
                $("#txtpregunta").val(data_preg['datos_resp'].pregunta);
                $("#txthallazgo").val(data_preg['datos_resp'].hallazgo);
                $("#txtservicio").css('disabled', true);

                $("#txtservicio").prop("disabled", true);
                $("#txtronda").prop("disabled", true);
                $("#txtseccion").prop("disabled", true);
                $("#txtpregunta").prop("disabled", true);

                $('#btn_guardar_accion').css("display", "block");
                $('#btn_actualizar_accion').css("display", "none");

                $('#ModalAccionM').modal({
                  show: true,
                  keyboard: false
                });

            });
        }

        if (dato == "btn_guardar_accion") {
            var ban = 0;
            var texto = '';
            if (($('#nombre').val() == "")) {
                $('#nombre').addClass("brc-danger");
                texto = texto + "* El nombre es obligatorio!<br>";
                ban = 1;
            }
            if ($('#empleados_rondas').val() == "") {
                $('#empleados_rondas').addClass("brc-danger");
                texto = texto + "* El Macroproceso es obligatorio!";
                ban = 1;
            }

            if ($('#periocidad').val() == "") {
                $('#periocidad').addClass("brc-danger");
                texto = texto + "* La Periocidad es obligatoria!<br>";
                ban = 1;
            }

            if ($('#veces').val() == "") {
                $('#veces').addClass("brc-danger");
                texto = texto + "* NÃºmero de veces es obligatorio!<br>";
                ban = 1;
            }

            if (ban == 1) {
            Swal.fire("¡Atención!", texto, "warning");
        } else {
            //alert("Datos: "+datos_form);
            Swal.fire({
            title: "Por favor espere!",
            text: "Actualizando la información.",
            showConfirmButton: false
            });
            var datos_form = $("#form_Accion").serialize();
            $.post("/r_gestion/guardar_accion", datos_form, function (data_form) {
                Swal.close();
                if (data_form == "1") {
                //jQuery(function(){
                    Swal.fire({
                    title: "¡Correcto!",
                    text: "Registro guardado correctamente!",
                    icon: "success"
                })
                .then((willDelete) => {
                    $('#form_Accion')[0].reset();
                    
                    $('#ModalAccionM').modal('hide');
                });
                
                } else {
                    Swal.fire("¡Error!", data_form, "error");
                }
            });
            return false;
        }
        return false;
    }

    if (datos[0] == "btndetalle") {
        idreg = datos[1];
        $.post("/r_gestion/cargar_detalle", {idfuente:""+idreg+""}, function (data_form) {
            $('#pos-det').html(data_form);
        });
      
        $('#Modaldetalle').modal({
            show: true,
             keyboard: false
        });
        return false;
    }

    if(datos[0] == "btnEvidencia") {
        imgEvidencia = datos[1];
               
         $('#imgEvidencia').attr('src', ''+imgEvidencia+'');
        
        $('#ModalEvidencia').modal({
          show: true,
          keyboard: false
        });
      }

        if (datos[0] == "btngestionar") {
            idreg = datos[1];
            idfuente =datos[2];

            window.open(`/plan_mejora/gestionar/?idreg=${idreg}&idfuente=${idfuente}`, '_parent');

        }

        if (datos[0] == "btninactivar") {
            //jQuery(function(){
            var id_reg = datos[1];
            var nom_reg = $('#nombre_' + id_reg).val();
            
        }

        if (datos[0] == "btnsocializar") {
            idreg = datos[1];

            // window.open('/a_documentos/socializar/' + idreg, '_parent');
        }


        if (dato == "btn_guardar_gest") {
            var ban = 0;
            var texto = 'prueba';
            if ($('#idresponsable').val() == $('#idusuariactual').val()){
                if ($('#estado option:selected').val() =='1'||($('#estado option:selected').val() =='2')){
                    
                    if ($('#accionR').val() == "") {
                        $('#accionR').addClass("brc-danger");
                        texto = texto + "* No ha registrado las acciones realizadas!";
                        ban = 1;
                    } 

                    if ($('#evidencia2').val() == "") {
                        $('#evidencia2').addClass("brc-danger");
                        texto = texto + "* El Archivo evidencia no ha sido Cargado!   ";
                        ban = 1;
                    } 
                }else{
                    
                    texto = texto + "* Estado no permitido para guardar la gestión!   ";
                    ban = 1;                   
                }
            }else{

                if ($('#estado option:selected').val() !='3'){
                                    
                    texto = texto + "* Estado no permitido para guardar la gestión!   ";
                    ban = 1;   
                }
            }
             
            if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
            } else {

                Swal.fire({
                    title: "Por favor espere!",
                    text: "Guadando la información.",
                    showConfirmButton: false
                });
                guardar_gestion();
                return false;
            }
            return false;
        }

        if (dato == "btn_consultar") {

            var texto = "";      
            var ban = 0;
            var conI = 1;

            var id_ronda = $('#rondas_informes').val();

            var id_servicio = $('#servicio').val();

           

            if (id_ronda == "" || id_ronda == null) {
            $('#rondas_informesIII').addClass("brc-danger");
            texto = texto + "* La Ronda es obligatoria!<br>";
            ban = 1;
            }

            if (id_servicio == "" || id_servicio == null) {
            $('#servicioIII').addClass("brc-danger");
            texto = texto + "* La Ronda es obligatoria!<br>";
            ban = 1;
            }

            if (ban == 1) {
            Swal.fire("¡Atención!", texto, "warning");
            } else {
            //alert("Datos: "+datos_form);
                Swal.fire({
                  title: "Por favor espere!",
                  text: "Cargando la información de la consulta.",
                  showConfirmButton: false
                });         

                $.post("/plan_mejora/cargar_inf_nocumple", {
                    id_ronda: "" + id_ronda + "",
                    id_servicio: "" + id_servicio + "",
                    fechaIniI: "" + fechaIni + "",
                    fechaFinI: "" + fechaFin + "",
                  
              
                }, function (data_preg) {

                    $("#HallazgoRondas-table").DataTable().destroy();
                    $("#HallazgoRondas-table").empty();
                    $("#HallazgoRondas-table").append(data_preg);
                    $('#HallazgoRondas-table').DataTable({
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
                });
                Swal.close();
            }

        }           
               
    });

    
    function guardar_gestion() {
        Swal.close();
        Swal.fire({
          title: "¡Atención!",
          text: "Guardando Información...!",
          icon: "warning",
          showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_guardar_gestion"));
      
        $.ajax({
            url: "/plan_mejora/guardar_gestion",
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
                window.open('/plan_mejora/index','_parent');            
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    $(document).on("change", function (event) {
        let datos = event.target.id.split("_");
        let dato = event.target.id;

        if (dato == "tipo_fuente") {
            var tipo_fuente = $("#tipo_fuente").val();
            cargar_listado(tipo_fuente);
        }

         if (dato == "tipo_fuenteN") {
            var tipo_fuenteN = $("#tipo_fuenteN").val();
        
            switch (tipo_fuenteN){
                case '0':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE RONDAS DE SEGURIDAD
                     ocultar_secciones();
                    $("#sec_Rondas").css('display','block');
                     break;
                case '1':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE QUEJAS
                     ocultar_secciones();
                    $("#sec_Quejas").css('display','block');
                     break;

                case '2':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE INCIDENTES
                    ocultar_secciones();
                    $("#sec_SucesosS").css('display','block');
                     break;

                case '3':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE EVENTOS ADVERSOS
                    ocultar_secciones();
                    $("#sec_Por_Auditorias").css('display','block');
                     break;
                                       
                case '4':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE ACTOS INSEGUROS
                    ocultar_secciones();
                    $("#sec_Por_Indicadores").css('display','block');
                     break;
                                       
                case '5':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE AUDITORIAS 
                    ocultar_secciones();
                    $("#sec_Por_Comites").css('display','block');
                     break;

                case '6':   // CARGAR FORMULARIO DE CAPTURA DE DATOS FUENTE INDICADORES
                    ocultar_secciones();
                    $("#sec_Accidente_de_Trabajo").css('display','block');
                     break;
                default:
                     ocultar_secciones();
            }
        }
    });

    $('#evidencia').aceFileInput({

        btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
        btnChooseText: 'Seleccionar',
        placeholderText: 'Seleccione el Archivo Visualización',
        placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
        allowExt: 'pdf|jpg|png'
    });

    function ocultar_secciones(){ 
        $("#sec_Rondas").css('display', 'none');
        $("#sec_Quejas").css('display', 'none');
        $("#sec_SucesosS").css('display', 'none');
        $("#sec_Por_Auditorias").css('display', 'none');
        $("#sec_Por_Indicadores").css('display', 'none');
        $("#sec_Por_Comites").css('display', 'none');
        $("#sec_Accidente_de_Trabajo").css('display', 'none');
    }

    // multiple with image preview
    $('#evidencia2').aceFileInput({
      style: 'drop',
      droppable: true,

      container: 'border-1 border-dashed brc-grey-l1 brc-h-info-m2 shadow-sm',

      placeholderClass: 'text-125 text-600 text-grey-l1 my-2',
      placeholderText: 'Cargue las Evidencias',
      placeholderIcon: '<i class="fa fa-cloud-upload-alt fa-3x text-info-m2 my-2"></i>',

      //previewSize: 64,
      thumbnail: 'large',

      allowExt: 'gif|jpg|jpeg|png|webp|svg|pdf',
      //allowMime: 'image/png|image/jpeg',
      //allowMime: 'document/*',

      //maxSize: 100000,
    });

        
        
        // fileInput.addEventListener('invalid.ace.file', function(e) {
        //   // console.log(e.$_fileErrors)    
        // })

        // fileInput.addEventListener('preview_failed.ace.file', function(e) {
        //   // console.log(e.$_previewError)
        //   //if(e.$_previewError && e.$_previewError.code == 2); alert(e.$_previewError.filename + ' is not an image!');
        // })

        // fileInput.addEventListener('clear.ace.file', function(e) {
        //   // e.preventDefault()
        // })

        // some available methods

        // $('#ace-file-input2').aceFileInput('disable')
        // $('#ace-file-input2').aceFileInput('startLoading')

        // $('#ace-file-input2').aceFileInput('showFileList', [{name: 'avatar3.jpg', type: 'image', path: 'assets/image/avatar/avatar3.jpg'} , {name: 'avatar2.jpg', type: 'image', path: 'assets/image/avatar/avatar2.jpg'}])
        // $('#ace-file-input1').aceFileInput('showFileList', [{name: '2.txt', type: 'document'}])
        // $('#ace-file-input1').aceFileInput('resetInput');
        
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function openFile(evidencia) {

        alert('ingreso acá');
    }

    $(".UpperCase").on("keypress", function () {
        $input = $(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        }, 50);
    })


    $('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });

});