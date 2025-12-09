$(function () {
    var wrapper = '';
    var canvas = '';
    let valoresOriginales = {};
 
    $('#lblotroNC').css('display', 'none');
    $('#otroNC').css('display', 'none');
    
    if ($('#opc_pag').val() == "ingreso") {
        var ban = 0;
        var tcont = 0;
        var tcontP = 0;
        var signaturePad;
        var TinyDatePicker = DateRangePicker.TinyDatePicker;

        var fechaR = "";

        // update icons for summernote example
        $.extend($.summernote.options.icons, {
          'align': 'fa fa-align',
          'alignCenter': 'fa fa-align-center',
          'alignJustify': 'fa fa-align-justify',
          'alignLeft': 'fa fa-align-left',
          'alignRight': 'fa fa-align-right',
          'indent': 'fa fa-indent',
          'outdent': 'fa fa-outdent',
          'arrowsAlt': 'fa fa-arrows-alt',
          'bold': 'fa fa-bold',
          'caret': 'fa fa-caret-down text-grey-m2 ml-1',
          'circle': 'fa fa-circle',
          'close': 'fa fa fa-close',
          'code': 'fa fa-code',
          'eraser': 'fa fa-eraser',
          'font': 'fa fa-font',
          'italic': 'fa fa-italic',
          'link': 'fa fa-link text-success-m1',
          'unlink': 'fas fa-unlink',
          'magic': 'fa fa-magic text-brown-m1',
          'menuCheck': 'fa fa-check',
          'minus': 'fa fa-minus',
          'orderedlist': 'fa fa-list-ol text-blue',
          'pencil': 'fa fa-pencil',
          'picture': 'far fa-image text-purple-d1',
          'question': 'fa fa-question',
          'redo': 'fa fa-repeat',
          'square': 'fa fa-square',
          'strikethrough': 'fa fa-strikethrough',
          'subscript': 'fa fa-subscript',
          'superscript': 'fa fa-superscript',
          'table': 'fa fa-table text-danger-m2',
          'textHeight': 'fa fa-text-height',
          'trash': 'fa fa-trash',
          'underline': 'fa fa-underline',
          'undo': 'fa fa-undo',
          'unorderedlist': 'fa fa-list-ul text-blue',
          'video': 'far fa-file-video text-pink-m1'
        })

        $('#temasD').summernote({
          height: 250,
          minHeight: 150,
          maxHeight: 400
        });

        $('#fileF1').css("display", "none");

        // $('#fechaR').inputmask('99/99/9999');
        $('#fechaT1').inputmask('99/99/9999');
        $('#horaI').inputmask('99:99');
        $('#horaF').inputmask('99:99');

        $('#empleados_actas').select2();
        $('#empleados_responsable').select2();
        $('#empleados_responsableT1').select2({
            width: "100%",
            placeholder: 'Asistentes',
            allowClear: true
        });

        if ($("#Ncomite option:selected").val() == "20") {
            $('#lblotroNC').css('display', 'flex');
            $('#otroNC').css('display', 'flex');
        }else{
            $('#lblotroNC').css('display', 'none');
            $('#otroNC').css('display', 'none');
        }

        $('#btn_agregarTarea').click(function () {

            $('#empleados_responsableT').select2({
               width: "100%",
               placeholder: 'Resposable Tarea',
               allowClear: true,
               dropdownParent: $('#CargarTareasAsignadas .modal-body')
            });
            
            $('#CargarTareasAsignadas').modal({
                show: true,
                keyboard: false
            });
          return false;
               
        });

        $('#btn_guardar_tarea').click(function () {

            tcont++
            
            $('#cantTarea').val(tcont);
            var participanteT = $('#empleados_responsableT option:selected').val();
            var nomparticipanteT = $('#empleados_responsableT option:selected').text();
            var tareasAsignadas = $('#descTareas').val();
            // alert(nomparticipanteT);

            const tr_principal = D.create('tr');
            //crear el td que contiene los input
            const td_numero = D.create('td');
            const td_empleado = D.create('td');
            const td_tarea = D.create('td');
            const td_fecha = D.create('td');
            const td_btnAccion = D.create('td');
            //crear los inputs 
            const span_numero = D.create('span', { name: 'numero[]', innerHTML: ''+tcont+'' } );
            const participante = D.create('input', { type: 'text', name: 'participanteT'+tcont+'', id: 'participanteT'+tcont+'', autocomplete: 'off', placeholder: 'Nombres y Apellidos' } );
            const idparticipante = D.create('input', { type: 'hidden', name: 'idparticipanteT'+tcont+'', id: 'idparticipanteT'+tcont+'', autocomplete: 'off'} );

            const input_tareas = D.create('textarea', { rows: '2', id: 'tareasAsignadas'+tcont+'', name: 'tareasAsignadas'+tcont+'', autocomplete: 'off', placeholder: 'Describa la tarea asignada' } );
            const input_fecha = D.create('input', { type: 'date', id: 'fechaT'+tcont+'', name: 'fechaT'+tcont+'' });
            const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function( ){ D.remove(tr_principal); tcont--; } } );
            const img_btn =  D.create('i',{});
            //agregar clases a los elementos
                                
            participante.classList.add('form-control','col-sm-12');
           
            input_tareas.classList.add('form-control','col-sm-12');
            input_fecha.classList.add('form-control', 'tinyDate','col-sm-8');
            btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
            img_btn.classList.add('fa','fa-trash-alt');
            
            //agregar cada etiqueta a su nodo padre

            D.append(span_numero, td_numero);
            D.append([idparticipante,participante], td_empleado); 
            D.append(input_tareas, td_tarea);
            D.append(input_fecha, td_fecha);
            D.append(img_btn, btn_borrar);
            D.append(btn_borrar, td_btnAccion);

            D.append([td_numero,td_empleado,td_tarea,td_fecha,td_btnAccion],tr_principal);
            D.append(tr_principal, D.id('pos-tareas'));    

            
            $('#idparticipanteT'+tcont+'').val(participanteT);
            $('#participanteT'+tcont+'').val(nomparticipanteT);
            $('#tareasAsignadas'+tcont+'').val(tareasAsignadas);
            $('#fechaT'+tcont+'').val($('#fechaEjecucion').val());
            
            $('#participanteT'+tcont+'').attr("readonly","readonly");
            $('#tareasAsignadas'+tcont+'').attr("readonly","readonly");
            $('#fechaT'+tcont+'').attr("readonly","readonly");
            $("#form_guardarTarea")[0].reset();
            

        });   

         // Array para almacenar los IDs de participantes ya agregados
        var participantesAgregados = [];

        $('#btn_agregarParticipante').click(function () {
            $('#empleados_responsableP').select2({
                width: "100%",
                placeholder: 'Participante',
                allowClear: true,
                dropdownParent: $('#CargarParticipantes .modal-body')
            });
            
            $('#CargarParticipantes').modal({
                show: true,
                keyboard: false
            });
            return false;
        });   

        $('#btn_guardar_participante').click(function () {
            var idparticipantesP = $('#empleados_responsableP option:selected').val();
            
            // Verificar si el participante ya fue agregado
            if (participantesAgregados.includes(idparticipantesP)) {
                
                Swal.fire("¡Atención!", 'Este participante ya ha sido agregado a la lista.', "warning");
                return false;
            }else{

                 // Si no está duplicado, proceder con el registro
                tcontP++;
                $('#cantPart').val(tcontP);
                
                // Agregar el ID al array de control
                participantesAgregados.push(idparticipantesP);
                
                var participantesP = $('#empleados_responsableP option:selected').text();
                var cargosP = $('#cargo').val();

                const tr_principalPart = D.create('tr');
                //crear el td que contiene los input
                const td_numeroPart = D.create('td');
                const td_empleadoPart = D.create('td');
                const td_cargo = D.create('td');   
                const td_firma = D.create('td');           
                const td_btnAccion = D.create('td');          
               
                //crear los inputs 
                const span_numeroP = D.create('span', { name: 'numero[]', innerHTML: ''+tcontP+'' } );
                const participanteP = D.create('input', { type: 'text', name: 'participanteP'+tcontP+'', id: 'participanteP'+tcontP+'',  autocomplete: 'off', placeholder: 'Nombres y Apellidos'} );
                const idparticipanteP = D.create('input', { type: 'hidden', name: 'idparticipanteP'+tcontP+'', id: 'idparticipanteP'+tcontP+'', autocomplete: 'off'});
                const input_cargo = D.create('input', { type: 'text', id: 'cargo'+tcontP+'', name: 'cargo'+tcontP+'', autocomplete: 'off'});
                const input_checkfirma = D.create('input', { type: 'checkbox', id: 'checkboxFirma_'+tcontP+'', name: 'checkboxFirma_'+tcontP+''});                
                const btn_borrar = D.create('a', { 
                    href: 'javascript:void(0)', 
                    onclick: function() { 
                        // Remover el ID del array cuando se elimine el participante
                        var index = participantesAgregados.indexOf(idparticipantesP);
                        if (index !== -1) {
                            participantesAgregados.splice(index, 1);
                        }
                        D.remove(tr_principalPart); 
                        tcontP--; 
                        $('#cantPart').val(tcontP); 
                    } 
                });
                const img_btn =  D.create('i',{});
               
                //agregar clases a los elementos
                td_numeroPart.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
                td_empleadoPart.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
                td_cargo.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
                td_firma.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
                td_btnAccion.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');

                participanteP.classList.add('form-control','col-sm-12');               
                input_cargo.classList.add('form-control','col-sm-12');                
                input_checkfirma.classList.add('input-lg', 'bgc-blue');                
                btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
                img_btn.classList.add('fa','fa-trash-alt');
                
                //agregar cada etiqueta a su nodo padre
                D.append(span_numeroP, td_numeroPart);
                D.append([participanteP,idparticipanteP], td_empleadoPart); 
                D.append(input_cargo, td_cargo);                
                D.append(input_checkfirma, td_firma);
                D.append(img_btn, btn_borrar);
                D.append(btn_borrar, td_btnAccion);

                D.append([td_numeroPart,td_empleadoPart,td_cargo,td_firma,td_btnAccion],tr_principalPart);
                D.append(tr_principalPart, D.id('pos-partic')); 

                $('#participanteP'+tcontP+'').val($('#empleados_responsableP option:selected').text());
                $('#idparticipanteP'+tcontP+'').val(idparticipantesP);
                $('#cargo'+tcontP+'').val($('#cargo').val());    

                $('#participanteP'+tcontP+'').attr("readonly","readonly");            
                $('#cargo'+tcontP+'').attr("readonly","readonly");    
                
                // Limpiar el formulario del modal
                $('#empleados_responsableP').val(null).trigger('change');
                $('#cargo').val('');
                
                // Cerrar el modal después de agregar
                $('#CargarParticipantes').modal('hide');   
            }            
            
        });   
    
        $('#btn_guardar').click(function(){
            var ban=0;
            var texto='';
            if($('#Ncomite').val()=="20"){
                if($('#otroNC').val()==""){
                    texto='Debe registrar el nombre de la reunión';
                    ban=1;
                }
            }

           
            if(ban==1) {     
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                guardar_registro();
                return false;  
            }
            
        });
            
        $('#btn_enviarCorreo').click(function () {
            alert('Enviar Correo');
        });
        
        $('#btn_firmar').click(function () {

            var consecutivo =  $('#tcont').val();
            if (signaturePad.isEmpty()) {
                alert("No ha cargado ninguna imagen ");
            } else {
            let dataURL = signaturePad.toDataURL();
               $('#signaturePreview'+consecutivo+'').attr('src',dataURL);
               
               document.getElementById('file64F'+consecutivo+'').value = dataURL; 
               
               $('#firmaModal').modal('hide');
            }
            // var data = signature.jSignature('getData', 'image');
            // $('#signaturePreview').attr('src', "data:" + data);
        });


        $('#btn_cargar_firma').click(function () {
            tcons = 1;
           
            cargarFirma(tcons);
        });

        $('#btn_borrar').click(function () {
            signaturePad.clear()
        });
        
    } else if ($('#opc_pag').val() == "listado") {

        cargar_listado();

        function cargar_listado() {
            Swal.fire({
                title: "Por favor espere!",
                text: "Cargando lista de Actas",
                showConfirmButton: false
            });

            $.post("/r_actas/listar_tabla", {}, function (data_carg) {
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
    } else if ($('#opc_pag').val() == "modificar") {
        var ban = 0;
        var tcont = 0;
        var tcontP = 0;        
        var tcontO = 0;
        var signaturePad;
        var TinyDatePicker = DateRangePicker.TinyDatePicker;
        // Guardar valores originales del formulario al cargar la página
        
        var fechaR = "";

        // update icons for summernote example
        $.extend($.summernote.options.icons, {
          'align': 'fa fa-align',
          'alignCenter': 'fa fa-align-center',
          'alignJustify': 'fa fa-align-justify',
          'alignLeft': 'fa fa-align-left',
          'alignRight': 'fa fa-align-right',
          'indent': 'fa fa-indent',
          'outdent': 'fa fa-outdent',
          'arrowsAlt': 'fa fa-arrows-alt',
          'bold': 'fa fa-bold',
          'caret': 'fa fa-caret-down text-grey-m2 ml-1',
          'circle': 'fa fa-circle',
          'close': 'fa fa fa-close',
          'code': 'fa fa-code',
          'eraser': 'fa fa-eraser',
          'font': 'fa fa-font',
          'italic': 'fa fa-italic',
          'link': 'fa fa-link text-success-m1',
          'unlink': 'fas fa-unlink',
          'magic': 'fa fa-magic text-brown-m1',
          'menuCheck': 'fa fa-check',
          'minus': 'fa fa-minus',
          'orderedlist': 'fa fa-list-ol text-blue',
          'pencil': 'fa fa-pencil',
          'picture': 'far fa-image text-purple-d1',
          'question': 'fa fa-question',
          'redo': 'fa fa-repeat',
          'square': 'fa fa-square',
          'strikethrough': 'fa fa-strikethrough',
          'subscript': 'fa fa-subscript',
          'superscript': 'fa fa-superscript',
          'table': 'fa fa-table text-danger-m2',
          'textHeight': 'fa fa-text-height',
          'trash': 'fa fa-trash',
          'underline': 'fa fa-underline',
          'undo': 'fa fa-undo',
          'unorderedlist': 'fa fa-list-ul text-blue',
          'video': 'far fa-file-video text-pink-m1'
        });

        $('#temasD').summernote({
          height: 250,
          minHeight: 150,
          maxHeight: 400
        });

        if ($("#Ncomite option:selected").val() == "20") {
            $('#lblotroNC').css('display', 'flex');
            $('#otroNC').css('display', 'flex');
        }else{
            $('#lblotroNC').css('display', 'none');
            $('#otroNC').css('display', 'none');
        }
        // $('#fechaR').inputmask('99/99/9999');
        $('#fechaT1').inputmask('99/99/9999');
        $('#horaI').inputmask('99:99');
        $('#horaF').inputmask('99:99');

        $('#empleados_actas').select2();
        $('#empleados_responsable').select2();
        $('#empleados_proyecto').select2();
        $('#empleados_responsableT1').select2({
            width: "100%",
            placeholder: 'Asistentes',
            allowClear: true
        });
        
        
        $('#btn_Actualizar').click(function () {
            var form = document.getElementById('form_modificar');
            var elementos = form.elements;
            var haCambiado = false;
            var CkModificar = document.getElementById('modificar_acta');
                
            if(CkModificar.checked === true){
                for (var i = 0; i < elementos.length; i++) {
                    var elemento = elementos[i];
                   // alert(elemento.type);
                    if (elemento.type !== 'button' && elemento.type !== 'checkbox' && elemento.name !== "") {
                        //alert(elemento.name);
                        if (valoresOriginales[elemento.name] !== elemento.value) {
                            haCambiado = true;
                            break;
                        }
                    }
                }
               // alert(haCambiado);
                if(haCambiado){
                    guardar_actualizacion(); 
                }else{
                    Swal.fire("¡Atención!", 'No se han realizado cambios en el Acta', "warning");
               }
            }else{
                var newObserv = document.getElementById('newObser').value;
                
                if(newObserv != '0'){                    
                    guardar_Observaciones();
                }else{
                    if($('#cantPart').val()!= '0'){
                        var firmado = validarFirmas();
                        if(firmado){
                            Swal.fire("¡Atención!", 'Todos los participantes han firmado', "question");      
                            guardar_aprobacion();
                        }else{  
                            var cantPart = parseInt($('#cantPart').val());
                            var usuarioActual = $('#usuarioActual').val();
                            var usuarioYaFirmo = false;

                            for (var i = 1; i <= cantPart; i++) {
                                var idParticipante = $('#usuariofirma').val();
                                var checkfirma = document.getElementById('checkboxFirma_'+ i)
                                if (idParticipante === usuarioActual) {

                                    usuarioYaFirmo = checkfirma.checked;
                                    break; // Termina el bucle si ya firmó
                                }                
                            }
                            
                            if (usuarioYaFirmo) {
                                guardar_firma();                                
                            } else{
                                Swal.fire("¡Atención!", 'No has firmado, No hay cambios que guardar', "warning");
                            }   
                           
                        }                        
                    }
                }                    
            }            
        });

        $('#btn_agregarTarea').click(function () {

            $('#empleados_responsableT').select2({
               width: "100%",
               placeholder: 'Resposable Tarea',
               allowClear: true
            });
            
            $('#CargarTareasAsignadas').modal({
                show: true,
                keyboard: false
            });
          return false;
               
        });

        $('#btn_guardar_tarea').click(function () {

            tcont++
            
            $('#cantTarea').val(tcont);
            var participanteT = $('#empleados_responsableT option:selected').val();
            var nomparticipanteT = $('#empleados_responsableT option:selected').text();
            var tareasAsignadas = $('#descTareas').val();
            // alert(nomparticipanteT);

            const tr_principal = D.create('tr');
            //crear el td que contiene los input
            const td_numero = D.create('td');
            const td_empleado = D.create('td');
            const td_tarea = D.create('td');
            const td_fecha = D.create('td');
            const td_btnAccion = D.create('td');
            //crear los inputs 
            const span_numero = D.create('span', { name: 'numero[]', innerHTML: ''+tcont+'' } );
            const participante = D.create('input', { type: 'text', name: 'participanteT'+tcont+'', id: 'participanteT'+tcont+'', autocomplete: 'off', placeholder: 'Nombres y Apellidos' } );
            const idparticipante = D.create('input', { type: 'hidden', name: 'idparticipanteT'+tcont+'', id: 'idparticipanteT'+tcont+'', autocomplete: 'off'} );

            const input_tareas = D.create('textarea', { rows: '2', id: 'tareasAsignadas'+tcont+'', name: 'tareasAsignadas'+tcont+'', autocomplete: 'off', placeholder: 'Describa la tarea asignada' } );
            const input_fecha = D.create('input', { type: 'date', id: 'fechaT'+tcont+'', name: 'fechaT'+tcont+'' });
            const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function( ){ D.remove(tr_principal); tcont--; } } );
            const img_btn =  D.create('i',{});
            //agregar clases a los elementos
                                
            participante.classList.add('form-control','col-sm-12');
           
            input_tareas.classList.add('form-control','col-sm-12');
            input_fecha.classList.add('form-control', 'tinyDate','col-sm-8');
            btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
            img_btn.classList.add('fa','fa-trash-alt');
            
            //agregar cada etiqueta a su nodo padre

            D.append(span_numero, td_numero);
            D.append([idparticipante,participante], td_empleado); 
            D.append(input_tareas, td_tarea);
            D.append(input_fecha, td_fecha);
            D.append(img_btn, btn_borrar);
            D.append(btn_borrar, td_btnAccion);

            D.append([td_numero,td_empleado,td_tarea,td_fecha,td_btnAccion],tr_principal);
            D.append(tr_principal, D.id('pos-tareas'));    

            
            $('#idparticipanteT'+tcont+'').val(participanteT);
            $('#participanteT'+tcont+'').val(nomparticipanteT);
            $('#tareasAsignadas'+tcont+'').val(tareasAsignadas);
            $('#fechaT'+tcont+'').val($('#fechaEjecucion').val());
            
            $('#participanteT'+tcont+'').attr("readonly","readonly");
            $('#tareasAsignadas'+tcont+'').attr("readonly","readonly");
            $('#fechaT'+tcont+'').attr("readonly","readonly");
            $("#form_guardarTarea")[0].reset();          
        });   

        $('#btn_agregarParticipante').click(function () {

            $('#empleados_responsableP').select2({
               width: "100%",
               placeholder: 'Participante',
               allowClear: true
            });
            
            $('#CargarParticipantes').modal({
                show: true,
                keyboard: false
            });
            return false;
        });   

        $('#btn_guardar_participante').click(function () {
           
            tcontP++;
            $('#cantPart').val(tcontP);
            var participantesP = $('#empleados_responsableP option:selected').text();
            var idparticipantesP = $('#empleados_responsableP option:selected').val();
            var cargosP = $('#cargo').val();

            
            const tr_principalPart = D.create('tr');
        //crear el td que contiene los input
            const td_numeroPart = D.create('td');
            const td_empleadoPart = D.create('td');
            const td_cargo = D.create('td');   
            const td_firma = D.create('td');           
            const td_btnAccion = D.create('td');          
           
        //crear los inputs 
            const span_numeroP = D.create('span', { name: 'numero[]', innerHTML: ''+tcontP+'' } );
            const participanteP = D.create('input', { type: 'text', name: 'participanteP'+tcontP+'', id: 'participanteP'+tcontP+'',  autocomplete: 'off', placeholder: 'Nombres y Apellidos'} );
            const idparticipanteP = D.create('input', { type: 'hidden', name: 'idparticipanteP'+tcontP+'', id: 'idparticipanteP'+tcontP+'', autocomplete: 'off'});
            const input_cargo = D.create('input', { type: 'text', id: 'cargo'+tcontP+'', name: 'cargo'+tcontP+'', autocomplete: 'off'});
            const input_checkfirma = D.create('input', { type: 'checkbox', id: 'checkboxFirma_'+tcontP+'', name: '  '+tcontP+''});                
            const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function( ){ D.remove(tr_principalPart); tcontP--; $('#cantPart').val(tcontP); } } );
            const img_btn =  D.create('i',{});
           
        //agregar clases a los elementos
            
            td_numeroPart.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_empleadoPart.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_cargo.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_firma.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_btnAccion.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');

            participanteP.classList.add('form-control','col-sm-12');               
            input_cargo.classList.add('form-control','col-sm-12');                
            input_checkfirma.classList.add('input-lg', 'bgc-blue');                
            btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
            img_btn.classList.add('fa','fa-trash-alt');
            
        //cargar empleados al select 
        

        //agregar cada etiqueta a su nodo padre

            D.append(span_numeroP, td_numeroPart);
            D.append([participanteP,idparticipanteP], td_empleadoPart); 
            D.append(input_cargo, td_cargo);                
            D.append(input_checkfirma, td_firma);
            D.append(img_btn, btn_borrar);
            D.append(btn_borrar, td_btnAccion);

            D.append([td_numeroPart,td_empleadoPart,td_cargo,td_firma,td_btnAccion],tr_principalPart);
            D.append(tr_principalPart, D.id('pos-partic')); 


            $('#participanteP'+tcontP+'').val($('#empleados_responsableP option:selected').text());
            $('#idparticipanteP'+tcontP+'').val($('#empleados_responsableP option:selected').val());
            $('#cargo'+tcontP+'').val($('#cargo').val());    

            $('#participanteP'+tcontP+'').attr("readonly","readonly");            
            $('#cargo'+tcontP+'').attr("readonly","readonly");    
        });   

        $('#btn_guardar_observaciones').click(function () {
           
            tcontO++;
            $('#cantObser').val(tcontO);


            const tr_principalObs= D.create('tr');
        //crear el td que contiene los input
            const td_numeroObs = D.create('td');
            const td_observaciones = D.create('td');
            const td_empleadoObs = D.create('td');           
            const td_btnAccion = D.create('td');         
           
        //crear los inputs 
            const span_numeroO = D.create('span', { name: 'numero[]', innerHTML: ''+tcontO+'' } );
            const observaciones = D.create('textarea', { rows: '2', id: 'observaciones'+tcontO+'', name: 'observaciones'+tcontO+'', autocomplete: 'off', placeholder: 'Describa la tarea asignada' } );
            const idempleadoObs = D.create('input', { type: 'hidden', name: 'idempleadoObs'+tcontO+'', id: 'idempleadoObs'+tcontO+'', autocomplete: 'off'});
            const input_empleadoObs = D.create('input', { type: 'text', id: 'empleadoObs'+tcontO+'', name: 'empleadoObs'+tcontO+'', autocomplete: 'off'});
            
            const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function( ){ D.remove(tr_principalPart); tcontO--; $('#cantPart').val(tcontO); } } );
            const img_btn =  D.create('i',{});

                       
        //agregar clases a los elementos            
            td_numeroObs.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_observaciones.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_empleadoObs.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');
            td_btnAccion.classList.add('border-0','bgc-white','bgc-h-grey-l3','shadow-sm','text-center','pr-0');

            observaciones.classList.add('form-control','col-sm-12');               
            input_empleadoObs.classList.add('form-control','col-sm-12');                
            btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
            img_btn.classList.add('fa','fa-trash-alt'); 
            
        //cargar empleados al select 
        

        //agregar cada etiqueta a su nodo padre

            D.append(span_numeroO, td_numeroObs);
            D.append(observaciones, td_observaciones);                
            D.append([input_empleadoObs,idempleadoObs], td_empleadoObs); 
            D.append(img_btn, btn_borrar);
            D.append(btn_borrar, td_btnAccion);

            D.append([td_numeroObs,td_observaciones,td_empleadoObs,td_btnAccion],tr_principalObs);
            D.append(tr_principalObs, D.id('pos-obser')); 


            $('#observaciones'+tcontO+'').val($('#txtObservaciones').val());
            $('#idempleadoObs'+tcontO+'').val($('#usuarioActual').val());
            $('#empleadoObs'+tcontO+'').val($('#usuarioNomActual').val());

            $('#observaciones'+tcontO+'').attr("readonly","readonly");
            $('#idempleadoObs'+tcontO+'').attr("readonly","readonly");
            $('#empleadoObs'+tcontO+'').attr("readonly","readonly");   
            $('#newObser').val(1);  
        });   
    
        $('#btn_agregarObservaciones').click(function () {
            var cantPart = parseInt($('#cantPart').val());
            var usuarioActual = $('#usuarioActual').val();
            var usuarioYaFirmo = false;

            for (var i = 1; i <= cantPart; i++) {
                var idParticipante = $('#usuariofirma').val();
                if (idParticipante === usuarioActual) {
                    usuarioYaFirmo = true;
                    break; // Termina el bucle si ya firmó
                }                
            }

            if (usuarioYaFirmo) {
                Swal.fire("¡Atención!", 'El usuario ya firmó, no puede hacer observaciones', "question");                
            } else {
                $('#CargarObservaciones').modal({
                    show: true,
                    keyboard: false
                });
            }

            return false;           
        }); 

        var idActa = $('#idActa').val();
        $.post("/r_actas/cargar_tareas",{idActa: ""+ idActa+""}, function(data_pregT){
           $('#pos-tareas').html(data_pregT);
           $('#tareasDB').val($('#cantTarea').val());
        });
        $.post("/r_actas/cargar_asistentes",{idActa: ""+ idActa+""}, function(data_preg){
           $('#pos-partic').html(data_preg);
        }); 

        $.post("/r_actas/cargar_observaciones",{idActa: ""+ idActa+""}, function(data_obser){
           $('#pos-obser').html(data_obser);
           $('#newObser').val(0);
        });
        

        if($('#usuarioActual').val()==$('#usuarioResponsable').val() || $('#usuarioActual').val() == $('#empleados_proyecta').val()){
            $('#div_modificar').css('display','flex');
        }else{
            $('#div_modificar').css('display','none');
        }

        inactivar_elementos(false);
        
    }

    function guardar_registro() {
        Swal.close();
        Swal.fire({
          title: "¡Atención!",
          text: "Guardando Información...!",
          icon: "warning",
          showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_guardar"));
      
        $.ajax({
            url: "/r_actas/guardar",
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
                window.open('/r_actas/index','_parent');            
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    $(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;        

        if (datos[0] == "btninactivar") {
            let id_acta = datos[1];
            Swal.fire({
              title: "Estas Seguro?",
              text: "Se va a Eliminar el Acta!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, Eliminar!"
            }).then((result) => {
              if (result.isConfirmed) {
                // $.post("/r_actas/eliminar_acta",{idObser: ""+ idObser+""}, function(data_elimActa){

                // }
                Swal.fire({
                  title: "Eliminada!",
                  text: "El Acta N° "+id_acta+" fue eliminada",
                  icon: "success"
                });
              }
            });
        }  

        if(datos[0] =="eliminarObs"){
        
           idObser = datos[1]; 
           id_acta = datos[2];
            $.post("/r_actas/eliminar_observaciones",{idObser: ""+ idObser+""}, function(data_obser){
              if(data_obser =="OK"){
                $.post("/r_actas/cargar_observaciones",{idActa: ""+ id_acta+""}, function(data_Cobser){
                    $('#pos-obser').html(data_Cobser);
                });
              }
            });
        }  

        if(datos[0] == "btngestionar"){
            idreg = datos[1];
            window.open('r_actas/modificar/' + idreg, '_parent');
        }


        if (dato == "btn_pdf") {
            window.open('/r_actas/pdf', '_blank');
        }

        if (dato == "btn_excel") {
            window.open('/r_actas/excel', '_blank');
        }

        if(datos[0] == "btndetalle"){
            id_acta = datos[1];
            window.open('/r_actas/acta_pdf/'+id_acta+'', '_blank');
        }    

    });

    $(document).on("change", function (event) {
        event.preventDefault();
        var datos = event.target.id.split("_");
        var dato = event.target.id;
        var ck = event.target.checked;

        if (dato == "Ncomite") {
            if ($("#Ncomite option:selected").val() == "20") {
                $('#lblotroNC').css('display', 'flex');
                $('#otroNC').css('display', 'flex');
            }else{
                $('#lblotroNC').css('display', 'none');
                $('#otroNC').css('display', 'nome');     
            }
        }

        if (dato == "empleados_responsableP") {
            var empleadoP = $("#empleados_responsableP option:selected").val();

            $.post("/r_actas/cargarCargo",{idreg: ""+empleadoP+""}, function(data_preg){
                $('#cargo').val(data_preg['cargo'].nombre);
            });
        }

        if(dato === "modificar_acta"){
            
            if (ck){
                inactivar_elementos(true);
            }else{
                inactivar_elementos(false);
            }
            
            
            // // Supongamos que el formulario tiene id 'form_modificar'
            // var form = document.getElementById('form_modificar');
            // var elementos = form.elements;

            // // Guardamos el valor original de cada elemento
            // for (var i = 0; i < elementos.length; i++) {
            //     var elemento = elementos[i];
                
            //     // Ignoramos el botón de actualizar y otros que no sean necesarios
            //     if (elemento.type !== 'button' && elemento.type !== 'checkbox' && elemento.name !=="") {
            //         //alert(elemento.name);
            //         valoresOriginales[elemento.name] = elemento.value;
            //     }
            // }
        }

        if(datos[0] == "checkboxFirma"){
        
            var usuariofirma = $('#idparticipanteP'+datos[1]+'').val();
            if($('#usuarioActual').val() == usuariofirma){
                if(ck==true){
                   Swal.fire("¡Felicitaciones!", 'Firma exitosa', "success");
                   $('#usuariofirma').val(usuariofirma);                   
                }
            }else{
                $('#checkboxFirma_'+datos[1]+'').prop("checked", false)
                // alert('No estas autorizado para firmar');
                Swal.fire("¡Alerta!", 'No estas autorizado para firmar', "error")
                $('#usuariofirma').val("00");
            } 
        }

    });

    function validarFirmas() {
        // Obtener la cantidad total de participantes
        var cantPart = parseInt(document.getElementsByName('cantPart')[0].value);
        var todosFirmaron = true;
        
        // Verificar cada checkbox de firma
        for (var i = 1; i <= cantPart; i++) {
            var checkbox = document.getElementById('checkboxFirma_' + i);
            
            // Si el checkbox existe pero no está marcado
            if (checkbox && !checkbox.checked) {
                todosFirmaron = false;
                break; // Salir del bucle al encontrar uno sin firmar
            }
        }
        
        if (!todosFirmaron) {
            //alert('No todos los participantes han firmado el acta.');
            return false; // Para prevenir el envío del formulario
        }
        
        return true; // Permitir el envío del formulario
    }

    function guardar_Observaciones() {
        Swal.close();
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Observaciones...!",
            icon: "warning",
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_modificar"));

        $.ajax({
            url: "/r_actas/guardar_Observaciones",
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
                        window.open('/r_actas/index', '_parent');
                    });
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        });
        return false;
    }
   
    function guardar_aprobacion() {
        Swal.close();
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_modificar"));

        $.ajax({
            url: "/r_actas/guardar_aprobacion",
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
                        text: "Registro ingresado correctamente!",
                        icon: "success"
                    })
                    .then((willDelete) => {
                        window.open('/r_actas/index', '_parent');
                    });
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        });
        return false;
    }

    function guardar_firma() {
        Swal.close();
        Swal.fire({
            title: "¡Atención!",
            text: "Guardanto la firma...!",
            icon: "warning",
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_modificar"));

        $.ajax({
            url: "/r_actas/guardar_firma",
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
                        text: "El Participante firmo correctamente!",
                        icon: "success"
                    })
                    .then((willDelete) => {
                        window.open('/r_actas/index', '_parent');
                    });
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        });
        return false;
    }

    function inactivar_elementos(resp){
        if(resp){
            $('#fechaR').prop("readonly",false);
            $('#horaI').prop('readonly',false);
            $('#horaF').prop('readonly',false);
            $('#lugar').prop('readonly',false);
            $('#proceso').prop('readonly',false);
            $('#Ncomite').prop('readonly',false);
            $('#otroNC').prop('readonly',false);
            $('#motivo').prop('readonly',false);
            $('#empleados_responsable').attr('readonly',false).trigger('change');
            $('#objetivo').prop('readonly',false);
            $('#seguimiento').prop('readonly',false);
            $('#temas').prop('readonly',false);            
            $('#temasD').prop('readonly',false);
            $('#decisiones').prop('readonly',false);
            $('#decisionesD').prop('readonly',false);
        }else{
            $('#fechaR').prop('readonly',true);
            $('#horaI').prop('readonly',true);
            $('#horaF').prop('readonly',true);
            $('#lugar').attr('readonly',true);
            $('#proceso').prop('readonly',true);
            $('#Ncomite').attr('readonly',true);
            $('#otroNC').prop('readonly',true);
            $('#motivo').prop('readonly',true);
            $('#empleados_responsable').attr('readonly',true);
            $('#objetivo').prop('readonly',true);
            $('#seguimiento').prop('readonly',true);
            $('#temas').prop('readonly',true);            
            $('#temasD').prop('readonly',true);
            $('#decisiones').prop('readonly',true);
            $('#decisionesD').prop('readonly',true);
        }

    }

    function guardar_actualizacion() {
        Swal.close();
        Swal.fire({
            title: "¡Atención!",
            text: "actualizando Información del Acta...!",
            icon: "warning",
            showConfirmButton: false
        });

        var formData = new FormData(document.getElementById("form_modificar"));

        $.ajax({
            url: "/r_actas/actualizar",
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
                        text: "Registro actualizado correctamente!",
                        icon: "success"
                    })
                    .then((willDelete) => {
                        window.open('/r_actas/index', '_parent');
                    });
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        });
        return false;
    }
    $(".UpperCase").on("keypress", function () {
        $input = $(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        }, 50);
    })

    $('#imagenFirma').aceFileInput({

        // btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
        // btnChooseText: 'Seleccionar',
        // placeholderText: 'Seleccione el Archivo Visualización',
        // placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
        // allowExt: 'jpg|png'
        // 
        style: 'drop',
        droppable: true,

        container: 'border-1 border-dashed brc-grey-l1 brc-h-info-m2 shadow-sm',

        placeholderClass: 'text-125 text-600 text-grey-l1 my-2',
        placeholderText: 'Cargue la Firma',
        placeholderIcon: '<i class="fa fa-cloud-upload-alt fa-3x text-info-m2 my-2"></i>',

        //previewSize: 64,
        thumbnail: 'large',

        allowExt: 'gif|jpg|jpeg|png|webp|svg',
          //allowMime: 'image/png|image/jpeg',
          //allowMime: 'document/*',

          //maxSize: 100000,
    })

    $('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });
});