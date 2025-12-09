$(function () {


  document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
          if (e.keyCode == 13) {
              e.preventDefault();
          }
      }));
  });

    
  if ($('#opc_pag').val() == "listado") { 
      
      cargar_listado();

      function cargar_listado() {
           
          Swal.fire({
              title: "Por favor espere!",
              text: "Cargando lista de Agendamiento Quirurgico.",
              showConfirmButton: false
          });

          $.post("/c_seguimientocx/listar_tabla", {}, function (data_carg) {
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
    }

    else if ($('#opc_pag').val() == "nuevo") { 

        $("#fechaprogramacion").inputmask("99/99/9999");        
        $("#horaprogramacion").inputmask("99:99");
        $("#tiempohoras").inputmask("99:99");
       
        $('#procedimientos_seguimiento').select2({
            placeholder: 'Seleccione el procedimiento...',
            width: "95%",
            allowClear: true
        });

        $('#procedimientos_seguimiento').trigger('change');

        $('#cirujano_programacion').select2({
            width: "95%",
            allowClear: true
        });
        $('#cirujano_programacion').trigger('change');

        $('#div_analgesiologo').css('display','none');        
    }

    else if ($('#opc_pag').val() == "modificar") { 

      $('#lblretraso').css('display','flex');
      $('#inpretraso').css('display','flex');

      $('#div_cancelación').css('display','none');
      $('#btn_actualizar').css('display','none');

      $('#div_cual').css('display','none');
      $('#procedimientos_seguimiento').attr('disabled', true);
      $('#procedimientos_seguimiento1').attr('disabled', true);
      $('#cirujano_programacion').attr('disabled', true);
      $('#anestesiologo_programacion').attr('disabled', true);
      $('#eps_pacientes').prop('disabled', true);
      $('#telefono').prop('disabled', true);

      $('#pacienteT').attr('disabled', true);
      $('#cedulaT').attr('disabled', true);
      $('#telefonoT').attr('disabled', true);
      $('#entidadT').attr('disabled', true);
      
    
      // Configuración de pares de checkboxes (Sí/No)
      const checkboxPairs = [
        { id1: 'ckdolorSi', id2: 'ckdolorNo' },
        { id1: 'cksangradoSi', id2: 'cksangradoNo' },
        { id1: 'ckotrosSi', id2: 'ckotrosNo' },
        { id1: 'ckcalorSi', id2: 'ckcalorNo' },
        { id1: 'ckruborSi', id2: 'ckruborNo' },
        { id1: 'ckinflamacionSi', id2: 'ckinflamacionNo' },
        { id1: 'cksecrecionSi', id2: 'cksecrecionNo' },
        { id1: 'ckotrosSSi', id2: 'ckotrosSNo' },
        { id1: 'ckFcontrolesSi', id2: 'ckFcontrolesNo' }
      ];

      // Configuración de grupos de checkboxes (para más de 2 elementos)
      const checkboxGroups = [
        { 
          ids: ['ckFmedicamentosSi', 'ckFmedicamentosNo', 'ckFmedicamentosNoAp'],
          type: 'group' 
        }
      ];

      // Función para manejar pares de checkboxes
      function setupCheckboxPair(pair) {
        const checkbox1 = document.getElementById(pair.id1);
        const checkbox2 = document.getElementById(pair.id2);

        if (!checkbox1 || !checkbox2) return;

        checkbox1.addEventListener('change', function() {
          if (this.checked) {
            checkbox2.checked = false;
          }
        });

        checkbox2.addEventListener('change', function() {
          if (this.checked) {
            checkbox1.checked = false;
          }
        });
      }

      // Función para manejar grupos de checkboxes
      function setupCheckboxGroup(group) {
        const checkboxes = group.ids.map(id => document.getElementById(id)).filter(Boolean);

        checkboxes.forEach(checkbox => {
          checkbox.addEventListener('change', function() {
            if (this.checked) {
              checkboxes.forEach(cb => {
                if (cb !== this) cb.checked = false;
              });
            }
          });
        });
      }

      // Configurar todos los pares de checkboxes
      checkboxPairs.forEach(setupCheckboxPair);

      // Configurar todos los grupos de checkboxes
      checkboxGroups.forEach(setupCheckboxGroup);
      
    }

    // ****** Funciones ****** //

    $(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (datos[0] == "btneditar") {
            idreg = datos[1];
            // $('#newModalLabel').html('Modificar contratos con terceros');

            window.open('/c_seguimientocx/modificar/' + idreg, '_parent');

            return false;
        } 

        if(datos[0] == "btndetalle"){
            id_proc = datos[1];
            window.open('/c_seguimientocx/seguimiento_pdf/'+id_proc+'', '_blank');
        }  
        
        if (dato == "cancelacionQx") {
          let id_cirugiap = $('#id_cirugia').val();
          //crear el div que contiene modal
          const modal = document.getElementById('view-modal');
          const div_modal_dialog = D.create('div',{role:'document'});
          const div_modal_content = D.create('div');
          const div_modal_header = D.create('div');
          
          //crear los elementos de la cabecera
          const h4_modal_title = D.create('h4', {id:'myModalLabel', textContent:'Motivo o Causa de la Cancelación'});
          const button_close = D.create('button', { type: 'button'});
          
          const div_modal_body = D.create('div', {id:'modalFormBody'});
          //crear el formulario
          const form_horizontal = D.create('form', {action: 'c_seguimientocx/guardar_cancelacion', autocomplete: 'off', method:'post', id:'modalForm1'});
          
          //crear los elementos de formulario
          const div_form_group_motivo = D.create('div', {id:'div_motivo'});
          const div_lblmotivo_col = D.create('div');
          const div_inputmotivo_col = D.create('div');

          const label_motivo = D.create('label', { htmlFor: 'motivo', textContent: 'Motivo o Causa'});
          const input_motivo = D.create('input', { type: 'text', id: 'motivo', name: 'motivo'});
          
          const div_form_group_observaciones = D.create('div', {id:'div_observaciones'});
          const div_lblobservaciones_col = D.create('div');
          const div_inputobservaciones_col = D.create('div');

          const label_observaciones = D.create('label', { htmlFor: 'observaciones', textContent: 'Observaciones'});

          const input_id_cirugia = D.create('input', { type: 'hidden', id: 'id_cirugiap', name: 'id_cirugiap'});
          const input_Observaciones = D.create('textarea', { rows: '2', id: 'observaciones', name: 'observaciones', autocomplete: 'off', placeholder: 'Digite las observaciones si se requiere'});
         
          const div_modal_footer = D.create('div');          
          const button_guradar = D.create('button', {id:'btn_guardarC', textContent: 'Guardar'});
          const button_cancel = D.create('button', {id:'btn_cancelar_modal', textContent: 'Cancelar'});

          //agregar clases a los elementos
          div_modal_dialog.classList.add('modal-dialog','modal-dialog-centered');
          div_modal_content.classList.add('modal-content');
          div_modal_header.classList.add('modal-header', 'card-success');

          h4_modal_title.classList.add('modal-title','text-blue');
          button_close.classList.add('close');

          div_modal_body.classList.add('modal-body','text-blue');

          form_horizontal.classList.add('form-horizontal','m-t-30');

          div_form_group_motivo.classList.add('form-group','row');
          div_lblmotivo_col.classList.add('col-sm-2','col-form-label','text-sm-right','pr-0');

          div_form_group_observaciones.classList.add('form-group','row');
          div_lblobservaciones_col.classList.add('col-sm-2','col-form-label','text-sm-right','pr-0');

          label_motivo.classList.add('mb-0');
          label_observaciones.classList.add('mb-0');

          input_id_cirugia.classList.add('form-horizontal','m-t-30');

          div_inputmotivo_col.classList.add('col-sm-10','col-xs-1');
          input_motivo.classList.add('form-control');

          div_inputobservaciones_col.classList.add('col-sm-10','col-xs-1');
          input_Observaciones.classList.add('form-control');


          div_modal_footer.classList.add('modal-footer');
          button_guradar.classList.add('btn','btn-success','waves-effect');
          button_cancel.classList.add('btn', 'btn-danger','waves-effect');

          button_close.setAttribute('data-dismiss','modal');
          button_close.setAttribute('aria-hidden','true');

          button_cancel.setAttribute('data-dismiss','modal');

           //agregar cada etiqueta a su nodo padre

          D.append([h4_modal_title, button_close], div_modal_header);
          
          D.append(label_motivo, div_lblmotivo_col);
          D.append(input_motivo, div_inputmotivo_col);
          D.append([div_lblmotivo_col, div_inputmotivo_col], div_form_group_motivo);

          D.append(label_observaciones, div_lblobservaciones_col);
          D.append([input_id_cirugia, input_Observaciones], div_inputobservaciones_col);
          D.append([div_lblobservaciones_col, div_inputobservaciones_col], div_form_group_observaciones);

          D.append([button_guradar,button_cancel], div_modal_footer);

          D.append([div_form_group_motivo, div_form_group_observaciones, div_modal_footer], form_horizontal);
          
          D.append(form_horizontal, div_modal_body);
          D.append([div_modal_header, div_modal_body], div_modal_content);

          D.append(div_modal_content, div_modal_dialog);
          D.append(div_modal_dialog, modal);
          
          $('#view-modal').modal({
            show: true,
            keyboard: false
          });  
          $('#id_cirugiap').val(id_cirugiap);
          return false;
        } 

        if (dato == "cursoQx") {
            $('#modal-curso').modal({
            show: true,
            keyboard: false
          });
            return false;
        } 

        if (dato == "seguimientoP") {
          var id_cirugia = $('#id_cirugia').val();
            if($('#num_llamada').val()=="1"){
              //CARGA INFORMACIÓN DE LA PRIMERA LLAMADA
               $.post("/c_seguimientocx/cargar_llamda", {idreg: ""+id_cirugia+""}, function (data_carg) {
                $('#fechallamada').val(data_carg['llamada1'].fecha_llamada);
                $('#responde1').val(data_carg['llamada1'].responde);
                $("#responde1").change();
                if(data_carg['llamada1'].dolor == "1"){                 
                  $("#ckdolorSi").prop("checked", true);
                } else {
                  $("#ckdolorNo").prop("checked", true);
                } 

                if(data_carg['llamada1'].sangrado == "1"){                 
                  $("#cksangradoSi").prop("checked", true);
                } else {
                  $("#cksangradoNo").prop("checked", true);
                } 

                if(data_carg['llamada1'].otros_sintomas == "1"){                 
                  $("#ckotrosSi").prop("checked", true);
                  $("#cuales").val(data_carg['llamada1'].cuales);
                } else {
                  $("#ckotrosSi").prop("checked", false);
                  $("#ckotrosNo").prop("checked", true);
                } 

                $('#fecha_control').val(data_carg['llamada1'].fecha_control);
                $('#observaciones').val(data_carg['llamada1'].observaciones);
                $('#informo').val(data_carg['llamada1'].informo_paciente);
                $('#informo').change();

                if(data_carg['llamada1'].informo_paciente == "1"){
                  $('#familiar').val(data_carg['llamada1'].informa);
                }

                $('#auxiliares_seguimiento').val(data_carg['llamada1'].id_funcionario_llama);
                $("#auxiliares_seguimiento").change();
               });
                $('#fechallamada').prop("readonly",true);
                $('#responde1').attr("disabled",true);
                $("#ckdolorSi").attr("disabled",true); 
                $("#ckdolorNo").attr("disabled",true);
                $("#cksangradoSi").attr("disabled",true); 
                $("#cksangradoNo").attr("disabled",true);
                $("#ckotrosSi").attr("disabled",true);
                $("#ckotrosNo").attr("disabled",true);
                 $("#cuales").attr("disabled",true);
                $('#fecha_control').prop("readonly",true); 
                $('#observaciones').prop("readonly",true); 
                $('#informo').attr("disabled",true); 
                $('#familiar').attr("disabled",true);
                $('#auxiliares_seguimiento').attr("disabled",true); 
            }

            if($('#num_llamada').val()=="2"){
              //CARGA INFORMACIÓN DE LA PRIMERA LLAMADA
              $.post("/c_seguimientocx/cargar_llamda", {idreg: ""+id_cirugia+""}, function (data_carg) {
                $('#fechallamada').val(data_carg['llamada1'].fecha_llamada);
                $('#responde1').val(data_carg['llamada1'].responde);
                $("#responde1").change();
                if(data_carg['llamada1'].dolor == "1"){                 
                  $("#ckdolorSi").prop("checked", true);
                } else {
                  $("#ckdolorNo").prop("checked", true);
                } 

                if(data_carg['llamada1'].sangrado == "1"){                 
                  $("#cksangradoSi").prop("checked", true);
                } else {
                  $("#cksangradoNo").prop("checked", true);
                } 

                if(data_carg['llamada1'].otros_sintomas == "1"){                 
                  $("#ckotrosSi").prop("checked", true);
                  $("#cuales").val(data_carg['llamada1'].cuales);
                } else {
                  $("#ckotrosSi").prop("checked", false);
                  $("#ckotrosNo").prop("checked", true);
                } 

                $('#fecha_control').val(data_carg['llamada1'].fecha_control);
                $('#observaciones').val(data_carg['llamada1'].observaciones);
                $('#informo').val(data_carg['llamada1'].informo_paciente);
                $('#informo').change();

                if(data_carg['llamada1'].informo_paciente == "1"){
                  $('#familiar').val(data_carg['llamada1'].informa);
                }

                $('#auxiliares_seguimiento').val(data_carg['llamada1'].id_funcionario_llama);
                $("#auxiliares_seguimiento").change();
               });
                $('#fechallamada').prop("readonly",true);
                $('#responde1').attr("disabled",true);
                $("#ckdolorSi").attr("disabled",true); 
                $("#ckdolorNo").attr("disabled",true);
                $("#cksangradoSi").attr("disabled",true); 
                $("#cksangradoNo").attr("disabled",true);
                $("#ckotrosSi").attr("disabled",true);
                $("#ckotrosNo").attr("disabled",true);
                 $("#cuales").attr("disabled",true);
                $('#fecha_control').prop("readonly",true); 
                $('#observaciones').prop("readonly",true); 
                $('#informo').attr("disabled",true); 
                $('#familiar').attr("disabled",true);
                $('#auxiliares_seguimiento').attr("disabled",true);
                //CARGA INFORMACIÓN DE LA SEGUNDA LLAMADA
              $.post("/c_seguimientocx/cargar_llamda2", {idreg: ""+id_cirugia+""}, function (data_carg) {
                $('#fechallamada2').val(data_carg['llamada2'].fecha_llamada2);
                $('#responde2').val(data_carg['llamada2'].responde2);
                $('#responde2').change();

                if(data_carg['llamada2'].finalizo_medicamentos == "1"){
                  $('#ckFmedicamentosSi').prop("checked", true);
                }else if (data_carg['llamada2'].finalizo_medicamentos == "2"){
                   $('#ckFmedicamentosNoAp').prop("checked", true);
                }else{
                  $('#ckFmedicamentosNo').prop("checked", true);
                }
                
                if(data_carg['llamada2'].calor == "1"){                 
                  $("#ckcalorSi").prop("checked", true);
                } else {
                  $("#ckcalorNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].rubor == "1"){                 
                  $("#ckruborSi").prop("checked", true);
                } else {
                  $("#ckruborNo").prop("checked", true);
                } 
 
                if(data_carg['llamada2'].inflamacion == "1"){                 
                  $("#ckinflamacionSi").prop("checked", true);
                } else {
                  $("#ckinflamacionNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].secrecion == "1"){                 
                  $("#cksecrecionSi").prop("checked", true);
                } else {
                  $("#cksecrecionNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].otros_signos == "1"){                 
                  $("#ckotrosSSi").prop("checked", true);
                  $("#cuales2").val(data_carg['llamada2'].cuales2);
                } else {
                  $("#ckotrosSNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].finalizo_controles == "1"){                 
                  $("#ckFcontrolesSi").prop("checked", true);
                } else {
                  $("#ckFcontrolesNo").prop("checked", true);
                } 

                $("#observaciones2").val(data_carg['llamada2'].observacion2);
                $('#informo2').val(data_carg['llamada2'].informo_paciente);
                $('#informo2').change();

                if(data_carg['llamada2'].informo_paciente == "1"){
                  $('#pacienteSl').val(data_carg['llamada2'].informa);
                }

                $('#auxiliares_seguimientoSL').val(data_carg['llamada2'].id_auxiliar_llamo);
                $("#auxiliares_seguimientoSL").change();

              });
              $('#fechallamada2').attr("disabled",true);
              $('#responde2').attr("disabled",true);  
              $('#ckFmedicamentosSi').attr("disabled",true);
              $('#ckFmedicamentosNo').attr("disabled",true);
              $("#ckcalorSi").attr("disabled",true);
              $("#ckcalorNo").attr("disabled",true);
              $("#ckruborSi").attr("disabled",true);
              $("#ckruborNo").attr("disabled",true);
              $("#ckinflamacionSi").attr("disabled",true);
              $("#ckinflamacionNo").attr("disabled",true);
              $("#cksecrecionSi").attr("disabled",true);
              $("#cksecrecionNo").attr("disabled",true);
              $("#ckotrosSSi").attr("disabled",true);
              $("#ckotrosSNo").attr("disabled",true);
              $("#cuales2").attr("disabled",true);
              $("#ckFcontrolesSi").attr("disabled",true);
              $("#ckFcontrolesNo").attr("disabled",true);
              $("#observaciones2").attr("disabled",true);
              $('#informo2').attr("disabled",true);
              $('#pacienteSl').attr("disabled",true);
              $('#auxiliares_seguimientoSL').attr("disabled",true);

            }

            if($('#num_llamada').val()=="3"){

              //CARGA INFORMACIÓN DE LA PRIMERA LLAMADA
              $.post("/c_seguimientocx/cargar_llamda", {idreg: ""+id_cirugia+""}, function (data_carg) {
                $('#fechallamada').val(data_carg['llamada1'].fecha_llamada);
                $('#responde1').val(data_carg['llamada1'].responde);
                $("#responde1").change();
                if(data_carg['llamada1'].dolor == "1"){                 
                  $("#ckdolorSi").prop("checked", true);
                } else {
                  $("#ckdolorNo").prop("checked", true);
                } 

                if(data_carg['llamada1'].sangrado == "1"){                 
                  $("#cksangradoSi").prop("checked", true);
                } else {
                  $("#cksangradoNo").prop("checked", true);
                } 

                if(data_carg['llamada1'].otros_sintomas == "1"){                 
                  $("#ckotrosSi").prop("checked", true);
                  $("#cuales").val(data_carg['llamada1'].cuales);
                } else {
                  $("#ckotrosSi").prop("checked", false);
                  $("#ckotrosNo").prop("checked", true);
                } 

                $('#fecha_control').val(data_carg['llamada1'].fecha_control);
                $('#observaciones').val(data_carg['llamada1'].observaciones);
                $('#informo').val(data_carg['llamada1'].informo_paciente);
                $('#informo').change();

                if(data_carg['llamada1'].informo_paciente == "1"){
                  $('#familiar').val(data_carg['llamada1'].informa);
                }

                $('#auxiliares_seguimiento').val(data_carg['llamada1'].id_funcionario_llama);
                $("#auxiliares_seguimiento").change();
               });
                $('#fechallamada').prop("readonly",true);
                $('#responde1').attr("disabled",true);
                $("#ckdolorSi").attr("disabled",true); 
                $("#ckdolorNo").attr("disabled",true);
                $("#cksangradoSi").attr("disabled",true); 
                $("#cksangradoNo").attr("disabled",true);
                $("#ckotrosSi").attr("disabled",true);
                $("#ckotrosNo").attr("disabled",true);
                 $("#cuales").attr("disabled",true);
                $('#fecha_control').prop("readonly",true); 
                $('#observaciones').prop("readonly",true); 
                $('#informo').attr("disabled",true); 
                $('#familiar').attr("disabled",true);
                $('#auxiliares_seguimiento').attr("disabled",true);
              //CARGA INFORMACIÓN DE LA SEGUNDA LLAMADA
              $.post("/c_seguimientocx/cargar_llamda2", {idreg: ""+id_cirugia+""}, function (data_carg) {
                $('#fechallamada2').val(data_carg['llamada2'].fecha_llamada2);
                $('#responde2').val(data_carg['llamada2'].responde2);
                $('#responde2').change();

                if(data_carg['llamada2'].finalizo_medicamentos == "1"){
                  $('#ckFmedicamentosSi').prop("checked", true);
                }else if (data_carg['llamada2'].finalizo_medicamentos == "2"){
                   $('#ckFmedicamentosNoAp').prop("checked", true);
                }else{
                  $('#ckFmedicamentosNo').prop("checked", true);
                }
                
                if(data_carg['llamada2'].calor == "1"){                 
                  $("#ckcalorSi").prop("checked", true);
                } else {
                  $("#ckcalorNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].rubor == "1"){                 
                  $("#ckruborSi").prop("checked", true);
                } else {
                  $("#ckruborNo").prop("checked", true);
                } 
 
                if(data_carg['llamada2'].inflamacion == "1"){                 
                  $("#ckinflamacionSi").prop("checked", true);
                } else {
                  $("#ckinflamacionNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].secrecion == "1"){                 
                  $("#cksecrecionSi").prop("checked", true);
                } else {
                  $("#cksecrecionNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].otros_signos == "1"){                 
                  $("#ckotrosSSi").prop("checked", true);
                  $("#cuales2").val(data_carg['llamada2'].cuales2);
                } else {
                  $("#ckotrosSNo").prop("checked", true);
                } 

                if(data_carg['llamada2'].finalizo_controles == "1"){                 
                  $("#ckFcontrolesSi").prop("checked", true);
                } else {
                  $("#ckFcontrolesNo").prop("checked", true);
                } 

                $("#observaciones2").val(data_carg['llamada2'].observacion2);
                $('#informo2').val(data_carg['llamada2'].informo_paciente);
                $('#informo2').change();

                if(data_carg['llamada2'].informo_paciente == "1"){
                  $('#pacienteSl').val(data_carg['llamada2'].informa);
                }

                $('#auxiliares_seguimientoSL').val(data_carg['llamada2'].id_auxiliar_llamo);
                $("#auxiliares_seguimientoSL").change();

              });
              $('#fechallamada2').attr("disabled",true);
              $('#responde2').attr("disabled",true);  
              $('#ckFmedicamentosSi').attr("disabled",true);
              $('#ckFmedicamentosNo').attr("disabled",true);
              $("#ckcalorSi").attr("disabled",true);
              $("#ckcalorNo").attr("disabled",true);
              $("#ckruborSi").attr("disabled",true);
              $("#ckruborNo").attr("disabled",true);
              $("#ckinflamacionSi").attr("disabled",true);
              $("#ckinflamacionNo").attr("disabled",true);
              $("#cksecrecionSi").attr("disabled",true);
              $("#cksecrecionNo").attr("disabled",true);
              $("#ckotrosSSi").attr("disabled",true);
              $("#ckotrosSNo").attr("disabled",true);
              $("#cuales2").attr("disabled",true);
              $("#ckFcontrolesSi").attr("disabled",true);
              $("#ckFcontrolesNo").attr("disabled",true);
              $("#observaciones2").attr("disabled",true);
              $('#informo2').attr("disabled",true);
              $('#pacienteSl').attr("disabled",true);
              $('#auxiliares_seguimientoSL').attr("disabled",true);
              //CARGA INFORMACIÓN DE LA TERCERA LLAMADA
              $.post("/c_seguimientocx/cargar_llamda3", {idreg: ""+id_cirugia+""}, function (data_carg) {
                $('#fechallamada3').val(data_carg['llamada3'].fecha_llamada3);
                $('#responde3').val(data_carg['llamada3'].responde3);
                $('#responde3').change();

                $("#observaciones3").val(data_carg['llamada3'].observaciones3);
                $('#informoT3').val(data_carg['llamada3'].informo_paciente);
                $('#informoT3').change();

                if(data_carg['llamada3'].informo_paciente == "1"){
                  $('#pacienteT3').val(data_carg['llamada3'].informa);
                }

                $('#auxiliares_seguimientoTL').val(data_carg['llamada3'].id_auxiliar_llamo);
                $("#auxiliares_seguimientoTL").change();
              });

              $('#fechallamada3').attr("disabled",true);
              $('#responde3').attr("disabled",true); 
              $("#observaciones3").attr("disabled",true);
              $('#informoT3').attr("disabled",true);
              $('#pacienteT3').attr("disabled",true);
              $('#auxiliares_seguimientoTL').attr("disabled",true); 

            }

            $('#modal-seguimiento').modal({
                show: true,
                keyboard: false
            });
            return false;
        }         

        if(dato == "btn_guardarC"){
          var ban = 0;
          var texto = '';
          if (($('#motivo').val() == "")) {
            $('#motivo').addClass("brc-danger");
            texto = texto + "* El Motivo de la cancelación es obligatoria!<br>";
            ban = 1;
          }
          if ($('#observaciones').val() == "") {
            $('#observaciones').addClass("brc-danger");
            texto = texto + "* La Observaciones son obligatorias!<br>";
            ban = 1;
          }

          if (ban == 1) {
            Swal.fire("¡Atención!", texto, "warning");
          } else {
            guardar_cancelacion();
          }
          return false;

        }

        if (dato == "btn_excel"){
          $('#modal_excel').modal({
            show: true,
            keyboard: false
          });
          return false;
        }

        if (dato == "btn_sucess_modal") {
          idmes = $("#meses").val();
          // alert(idmes);
          let fecha = idmes.split("-");
          // alert(fecha[0]);
          // alert(fecha[1]);
          window.open("/c_seguimientocx/excel/" + idmes, "_blank");
        }

        if(dato == "btn_guardarSeguimiento"){
          
          var ban = 0;
          var texto = '';
          if($('#num_llamada').val()=="0"){
            if (($('#fechallamada').val() == "")) {
              $('#fechallamada').addClass("brc-danger");
              texto = texto + "* La fecha de la llamada es obligatoria!<br>";
              ban = 1;
            }
            if (($('#responde1').val() == "0")) {              

              if (($('#observaciones').val() == "")) {
                $('#observaciones').addClass("brc-danger");
                texto = texto + "* Las observaciones son obligatoria!<br>";
                ban = 1;
              }
                if ($('#auxiliares_seguimientoSL').val() == "") {
                  $('#auxiliares_seguimientoSL').addClass("brc-danger");
                  texto = texto + "*  No ha registrado quien realizó la llamada!<br>";
                  ban = 1;
              }
            }else{
          
              if ($('#responde1').val() == "") {
                $('#responde1').addClass("brc-danger");
                texto = texto + "* Respodieron la llamada es obligatorio!<br>";
                ban = 1;
              }

              if (!$('#ckdolorSi').is(':checked') && !$('#ckdolorNo').is(':checked')) {
                $('#ckdolorSi').addClass("brc-danger");
                texto = texto + "* Reportaron dolor Si/No !<br>";
                ban = 1;
              } 
              
              if (!$('#cksangradoSi').is(':checked') && !$('#cksangradoNo').is(':checked')) {
                $('#cksangradoSi').addClass("brc-danger");
                texto = texto + "* Reportaron Sangrado Si/No !<br>";
                ban = 1;
              } 
              
              if (!$('#ckotrosSi').is(':checked') && !$('#ckotrosNo').is(':checked')) {
                $('#ckotrosSi').addClass("brc-danger");
                texto = texto + "* Reportaron Otros sintomas Si/No !<br>";
                ban = 1;
              } 
              
              if ($('#ckotrosSi').is(':checked')){
                if ($('#cuales').val() == "") {
                  $('#cuales').addClass("brc-danger");
                  texto = texto + "* No ha registrado los otros sintomas!<br>";
                  ban = 1;
                }
              } 
               
              if ($('#informo').val() == "1"){
                if ($('#familiar').val() == "") {
                  $('#familiar').addClass("brc-danger");
                  texto = texto + "* No ha registrado quien doy la información!<br>";
                  ban = 1;
                }
              } 

              if ($('#auxiliares_seguimiento').val() == "") {
                $('#auxiliares_seguimiento').addClass("brc-danger");
                texto = texto + "* No ha registrado quien realizó la llamada!<br>";
                ban = 1;
              }
            }
          }else if($('#num_llamada').val()=="1"){
             if (($('#responde2').val() == "0")) {    

              if (($('#fechallamada2').val() == "")) {
                $('#fechallamada2').addClass("brc-danger");
                texto = texto + "* La fecha de la llamada es obligatoria!<br>";
                ban = 1;
              }
              if (($('#observaciones').val() == "")) {
                $('#observaciones').addClass("brc-danger");
                texto = texto + "* Las Observaciones son obligatoria!<br>";
                ban = 1;
              }
                if ($('#auxiliares_seguimientoSL').val() == "") {
                  $('#auxiliares_seguimientoSL').addClass("brc-danger");
                  texto = texto + "*  No ha registrado quien realizó la llamada!<br>";
                  ban = 1;
              }
            }else{
              if (($('#fechallamada2').val() == "")) {
                $('#fechallamada2').addClass("brc-danger");
                texto = texto + "* La fecha de la llamada es obligatoria!<br>";
                ban = 1;
              }

              if ($('#responde2').val() == "") {
                $('#responde2').addClass("brc-danger");
                texto = texto + "* Respodieron la llamada es obligatorio!<br>";
                ban = 1;
              }
              
              if (!$('#ckFmedicamentosSi').is(':checked') && !$('#ckFmedicamentosNo').is(':checked') && !$('#ckFmedicamentosNoAp').is(':checked')) {
                $('#ckFmedicamentosSi').addClass("brc-danger");
                texto = texto + "* Finalizo medicamentos  Si / No / No aplica!<br>";
                ban = 1;
              } 
              
              if (!$('#ckcalorSi').is(':checked') && !$('#ckcalorNo').is(':checked')) {
                $('#ckcalorSi').addClass("brc-danger");
                texto = texto + "* No ha indicado si presenta o no Calor Si/No !<br>";
                ban = 1;
              } 

              if (!$('#ckruborSi').is(':checked') && !$('#ckruborNo').is(':checked')) {
                $('#ckruborSi').addClass("brc-danger");
                texto = texto + "* No ha indicado si presenta o no rubor  Si/No !<br>";
                ban = 1;
              } 

              if (!$('#ckinflamacionSi').is(':checked') && !$('#ckinflamacionNo').is(':checked')) {
                $('#ckinflamacionSi').addClass("brc-danger");
                texto = texto + "* No ha indicado si presenta o no inflamación !<br>";
                ban = 1;
              } 

              if (!$('#cksecrecionSi').is(':checked') && !$('#cksecrecionNo').is(':checked')) {
                $('#cksecrecionSi').addClass("brc-danger");
                texto = texto + "* No ha indicado si presenta o no  secreción !<br>";
                ban = 1;
              } 
              
              if ($('#ckotrosSSi').is(':checked')){
                if ($('#cuales2').val() == "") {
                  $('#cuales2').addClass("brc-danger");
                  texto = texto + "* No ha registrado cuales son los otros sintomas!<br>";
                  ban = 1;
                }
              }else{
                if (!$('#ckotrosSNo').is(':checked')) {
                  if (!$('#ckotrosSSi').is(':checked')){
                    $('#ckotrosSSi').addClass("brc-danger");
                    texto = texto + "* No han indicado si presenta o no otros sintomas!<br>";
                    ban = 1;
                  }
                } 
              } 
               
              if ($('#informo2').val() == "1"){
                if ($('#familiar2').val() == "") {
                  $('#familiar2').addClass("brc-danger");
                  texto = texto + "* No ha registrado quien doy la información!<br>";
                  ban = 1;
                }
              }     

             if ($('#auxiliares_seguimientoSL').val() == "") {
                $('#auxiliares_seguimientoSL').addClass("brc-danger");
                texto = texto + "*  No ha registrado quien realizó la llamada!<br>";
                ban = 1;
              }  
            }
          }else if($('#num_llamada').val() =="2"){ // Validación campos llamada 3
            if($('#cierre').val() == "0"){
              if (($('#fechallamada3').val() == "")) {
                $('#fechallamada3').addClass("brc-danger");
                texto = texto + "* La fecha de la llamada es obligatoria!<br>";
                ban = 1;
              }
              if ($('#responde3').val() == "") {
                $('#responde3').addClass("brc-danger");
                texto = texto + "* Respodieron la llamada es obligatorio!<br>";
                ban = 1;
              }

              if ($('#observaciones3').val() == ""){              
                $('#observaciones3').addClass("brc-danger");
                texto = texto + "* No ha registrado las observaciones de la tercera llamada!<br>";
                ban = 1;              
              }
              
              if ($('#informoT3').val() != "0"){
                if ($('#familiarT3').val() == "") {
                  $('familiarT3').addClass("brc-danger");
                  texto = texto + "* No ha registrado quien doy la información!<br>";
                  ban = 1;
                }
              }

              if ($('#auxiliares_seguimientoTL').val() == "") {
                $('#auxiliares_seguimientoTL').addClass("brc-danger");
                texto = texto + "*  No ha registrado quien realizó la llamada!<br>";
                ban = 1;
              }
            }       
          }        

          if (ban == 1) {
            Swal.fire("¡Atención!", texto, "warning");
          } else {

            if($('#cierre').val() == "1"){
              Swal.fire({
                title: "Cerrar Seguimiento?",
                text: "No se podra revertir el cierre!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Cerrar!"
              }).then((result) => {
                if (result.isConfirmed) {
                  guardar_seguimiento();                 
                }
              }); 
            }else{
              guardar_seguimiento();
            }                      
          }
          return false;
        }
          
        if(dato == "btn_guardar"){
          var ban = 0;
          var texto = '';
          if (($('#cedula').val() == "")) {
            $('#cedula').addClass("brc-danger");
            texto = texto + "* El Numero de cedula es obligatorio!<br>";
            ban = 1;
          }
          if ($('#paciente').val() == "") {
            $('#paciente').addClass("brc-danger");
            texto = texto + "* Los Nombres del paciente son obligatorios!<br>";
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
          
          if ($('#telefono').val() == "") {
            $('#telefono').addClass("brc-danger");
            texto = texto + "* El telefono es obligatorio!<br>";
            ban = 1;
          }

          if ($('#entidad_pacientes').val() == "") {
            $('#entidad_pacientes').addClass("brc-danger");
            texto = texto + "* La Entidad es obligatoria!<br>";
            ban = 1;
          }

          if ($('#fechaprogramacion').val() == "") {
            $('#fechaprogramacion').addClass("brc-danger");
            texto = texto + "* La Fecha de Cirugia es obligatoria!<br>";
            ban = 1;
          }

          if ($('#horaprogramacion').val() == "") {
            $('#horaprogramacion').addClass("brc-danger");
            texto = texto + "* La hora de la cirugia es obligatoria!<br>";
            ban = 1;
          }

          if ($('#horaprogramacion').val() == "") {
            $('#horaprogramacion').addClass("brc-danger");
            texto = texto + "* La hora de la cirugia es obligatoria!<br>";
            ban = 1;
          }

          if ($('#sala').val() == "") {
            $('#sala').addClass("brc-danger");
            texto = texto + "* La sala es obligatoria!<br>";
            ban = 1;
          }
          
          if ($('#procedimientos_seguimiento').val() == "") {
            $('#procedimientos_seguimiento').addClass("brc-danger");
            texto = texto + "* El procedimiento es obligatorio!<br>";
            ban = 1;
          }

          if ($('#cirujano_programacion').val() == "") {
            $('#cirujano_programacion').addClass("brc-danger");
            texto = texto + "* El cirujano es obligatorio!<br>";
            ban = 1;
          }

          if($('#tipo_anestesia').val()!="1"){
            if ($('#anestesiologo_programacion').val() == "") {
              $('#anestesiologo_programacion').addClass("brc-danger");
              texto = texto + "* El anestesiologo es obligatorio!<br>";
              ban = 1;
            }
          }          

          if ($('#tiempohoras').val() == "") {
            $('#tiempohoras').addClass("brc-danger");
            texto = texto + "* El tiempo de la cirugia es obligatorio!<br>";
            ban = 1;
          }

          if ($('#mat').val() == "") {
            $('#mat').addClass("brc-danger");
            texto = texto + "* El MAT es obligatorio!<br>";
            ban = 1;
          }   

          if (ban == 1) {
            Swal.fire("¡Atención!", texto, "warning");
          } else {
            guardar_registro();
          }
          return false;
        }
    });

    $(document).on("change", function (event) {
      var datos = event.target.id.split("_");
      var dato = event.target.id;
      var ck= event.target.checked;

      if (dato == "tipo_anestesia") {

        if ($('#tipo_anestesia option:selected').val() =="2" || $('#tipo_anestesia option:selected').val() =="3"){
            
          $('#div_analgesiologo').css('display','flex');           
        }else{
          $('#div_analgesiologo').css('display','none');
        }
      }
      if (dato == "cierre") {
        if($('#cierre').val() =="1"){
          if($('#num_llamada').val()=="0"){
            Swal.fire("¡Atención!", "No se puede hacer el cierre, solo se ha realizado una llamada", "warning");
            $('#cierre').val('');
          }
        }
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
      $.post("/c_seguimientocx/guardar", datos_form, function (data_form) {
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
              window.open('/c_seguimientocx/index', '_parent');
            });
          });
        } else {
            Swal.fire("¡Error!", data_form, "error");
        }
      });
    }

    function guardar_seguimiento() {
      Swal.fire({
          title: "¡Atención!",
          text: "Guardando Información...!",
          icon: "warning",
          showConfirmButton: false
      });
      var datos_form = $("#form_seguimientorqx").serialize();
      //alert(datos_form);
      $.post("/c_seguimientocx/guardar_seguimientoqx", datos_form, function (data_form) {
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
              window.open('/c_seguimientocx/index', '_parent');
            });
          });
        } else {
            Swal.fire("¡Error!", data_form, "error");
        }
      });
    }

    function guardar_cancelacion(){
      Swal.fire({
        title: "¡Atención!",
        text: "Guardando Información...!",
        icon: "warning",
        showConfirmButton: false
      });
      var datos_form = $("#modalForm1").serialize();
      //alert(datos_form);
      $.post("/c_seguimientocx/guardar_cancelacion", datos_form, function (data_form) {
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
              window.open('/c_seguimientocx/index', '_parent');
            });
          });
        } else {
            Swal.fire("¡Error!", data_form, "error");
        }
      });
    }

     $(".UpperCase").on("keypress", function () {
        $input = $(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        }, 50);
    });
     
    $('input[type=text], input[type=email], input[type=password],  select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });

});