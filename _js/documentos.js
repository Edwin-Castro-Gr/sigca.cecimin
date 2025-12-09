$(function() {

  var  ban0="0";

  if ($('#opc_pag').val() == "listado") {

    $('.ace-file-input').aceFileInput({
      btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
      btnChooseText: 'Seleccionar',
      placeholderText: 'Seleccione el Archivo Excel a Importar',
      placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'
    });

    cargar_listado();

    function cargar_listado() {
      Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de Documentos.",
        showConfirmButton: false
      });

      $.post("/a_documentos/listar_tabla", {}, function(data_carg) {
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

      $('#tipodocumentos_documento').css("display", "block");        
      $('#macroprocesos_documento').css("display", "block");       
      $('#proceso_documento').css("display", "block");
      $('#subproceso_documento').css("display", "block");
      $('#divdocrelaciondos').css("display", "block"); 
      $('#documentos_solicitud').css("display", "none");
      $('#tipodocumentos_documento').css("display", "none");
      $('#macroprocesos_documento').css("display", "none");
      $('#proceso_documento').css("display", "none");
      $('#subproceso_documento').css("display", "none");
      $('#divdocrelaciondos').css("display", "none");
      $('#tipodocumento').attr('Readonly', 'true');
      $('#div_clase_documentos').css("display", "none");

      $('#lbltipo').css("display", "flex");
      $('#tipo').css("display", "felx");
   

    $('#doc_relacionados').select2({
      width: "100%",
      placeholder: 'Seleccione ...',
      allowClear: true
    });

    $('#empleadosMR_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
    $('#cargosM_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
    $('#departamentosM_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
  } else if ($('#opc_pag').val() == "modificar") {
    var ban = 0;

    $('#divdocrelaciondos').css("display", "none");
    $('#doc_relacionados').select2({
      width: "83%",
      placeholder: 'Seleccione ...',
      allowClear: true
    });

    $('#empleadosMR_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
    $('#empleadosMR_documentos').trigger('change');

    $('#cargosM_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });

    $('#cargosM_documentos').val($('#des_cargos').val()).trigger('change');

    $('#departamentosM_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
    $('#departamentosM_documentos').trigger('change');
  } else if ($('#opc_pag').val() == "socializar") {
   
    $('#funcionarios').select2({
      width: "100%",
      multiple:'multiple',        
      allowClear: true,      
    });
    $('#empleadosMR_documentos').trigger('change');

    $('#cargosM_documentos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
    $('#cargosM_documentos').trigger('change');
  }

  function calcular_codigo(tipod,macro,idproce,idsubproce,docrelacionado) {
    var object = {};
    var sw = 0;

    if ($('#macroproceso').val() != "" && $('#tipodocumento').val() != "" && $('#proceso').val() != "" && $('#subproceso').val() != "" && $('#docrelacionados').val() != "") {
      object = {
        macro: "" + macro + "",
        tipod: "" + tipod + "",
        proce: "" + idproce + "",
        subproce: "" + idsubproce + "",
        docrela: "" + docrelacionado + ""
      };
      sw = 1;
    } else if ($('#macroproceso').val() != "" && $('#tipodocumento').val() != "" && $('#proceso').val() != "" && $('#subproceso').val() != "") {
      object = {
        macro: "" + macro + "",
        tipod: "" + tipod + "",
        proce: "" + idproce + "",
        subproce: "" + idsubproce + ""
      };
      sw = 2;
    } else if ($('#macroproceso').val() != "" && $('#tipodocumento').val() != "" && $('#proceso').val() != "") {
      object = {
        macro: "" + macro + "",
        tipod: "" + tipod + "",
        proce: "" + idproce + ""
      };
      sw = 3;
    } else if ($('#macroproceso').val() != "" && $('#tipodocumento').val() != "") {
      object = {
        macro: "" + macro + "",
        tipod: "" + tipod + "",
      };
      sw = 4;
    }
    $.post("/a_documentos/consecutivo", object, function(data_form) {
      if (data_form != "0") {
        if (sw == 1) {
          $('#codigo').val(macro + '-' + proce + '-' + subproce + '-' + docrelacionado + '-' + tipod + '-' + data_form);
        } else if (sw == 2) {
          $('#codigo').val(macro + '-' + proce + '-' + subproce + '-' + tipod + '-' + data_form);
        } else if (sw == 3) {
          $('#codigo').val(macro + '-' + proce + '-' + tipod + '-' + data_form);
        } else if (sw == 4) {
          $('#codigo').val(macro + '-' + tipod + '-' + data_form);
        }
      } else {
        if (sw == 1) {
          $('#codigo').val(macro + '-' + proce + '-' + subproce + '-' + docrelacionado + '-' + tipod + '-001');
        } else if (sw == 2) {
          $('#codigo').val(macro + '-' + proce + '-' + subproce + '-' + tipod + '-001');
        } else if (sw == 3) {
          $('#codigo').val(macro + '-' + proce + '-' + tipod + '-001');
        } else if (sw == 4) {
          $('#codigo').val(macro + '-' + tipod + '-' + '-001');
        }
      }
    });
  }

  function generar_consecutivo(tipo, tipod, clase, macro, idproce, idsubproce, docrelacionado){
    $('#codigo').val("");
    let idmacro = macro;     
    let proce = idproce;
    let subproce = idsubproce;
    let idtipod = tipod;
    let iddocrela = docrelacionado;
    
   
    $.post("/a_documentos/consecutivo1", {macro: "" + macro + "",proce: "" + idproce + "",subproce: "" + idsubproce + "", tipod: "" + tipod + "",docrela: "" + docrelacionado + "",clase:""+clase+""}, function(data_form) {
      $('#codigo').val(data_form);
    });

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
      url: "/a_documentos/guardar",
      type: "POST",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function(res) {
      if (res >= 1) {
        Swal.fire({
            title: "¡Correcto!",
            text: "Registro Ingresado correctamente!",
            icon: "success"
          })
          .then((willDelete) => {
            window.open('/a_documentos/index', '_parent');
          });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
  }

  $(document).on("click", function(event) {
    var datos = event.target.id.split("_");
    var dato = event.target.id;

    if (datos[0] == "btneditar") {
      idreg = datos[1];

      window.open('/a_documentos/modificar/' + idreg, '_parent');
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
      }).then(function(result) {
        if (result.value) {
          $.post("/a_documentos/inactivar", {
            idreg: "" + id_reg + ""
          }, function(data_form) {
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

    if (datos[0] == "btnsocializar") {
      idreg = datos[1];

      window.open('/a_documentos/socializar/' + idreg, '_parent');
    }

    if (dato == "btn_guardar") {
      var ban = 0;
      var texto = '';

      if ($('#archivov').val() == "") {
        $('#archivov').addClass("brc-danger");
        texto = texto + "* El Archivo PDF no ha sido Cargado!   ";
        ban = 1;
      }else if ($('#fechaversion').val() == "") {
        $('#fechaversion').addClass("brc-danger");
        texto = texto + "* La Fecha de la Versión es obligatoria!";
        ban = 1;
      }
      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {

        Swal.fire({
          title: "Por favor espere!",
          text: "Guadando la información.",
          showConfirmButton: false
        });
        guardar_registro();
        return false;
      }
      return false;
    }

    if (dato == "btn_importar") {
      var ban = 0;
      var texto = '';


      if ($('#upload_file').val() == "") {
        $('#upload_file').addClass("brc-danger");
        texto = texto + "* El Archivo a importar no ha sido Cargado!";
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
        var formData = new FormData(document.getElementById("form_importar"));

        $.ajax({
          url: "/a_documentos/importar_documentos",
          type: "POST",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(res) {
          if (res >= 1) {
            Swal.fire({
                title: "¡Correcto!",
                text: "'" + res + "'Registro Ingresado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                window.open('/a_documentos/index', '_parent');
              });
            //});
          } else {
            let resp = Object.values(formData);
            Swal.fire("¡Error!", resp, "error");
          }
        });
        return false;
      }
      return false;
    }

    if (dato == "btn_nuevo_documento") {
      // $('#newModalLabel').html('Nuevo Documento');
      // $('#btn_guardar').css("display", "block");
      // $('#btn_actualizar').css("display", "none");
      // $('#div_estado').css("display", "none");
      // $('#nombre').attr("disabled", "true");
      $("#form_guardar")[0].reset();
      $('#empleadosMR_documentos').select2({
        width: "100%",
        placeholder: '',
        allowClear: true
      });
      $('#cargos_documentos').select2({
        width: "100%",
        placeholder: '',
        allowClear: true
      });
      $('#departamentos_documentos').select2({
        width: "100%",
        placeholder: '',
        allowClear: true
      });
    }

    if (dato == "btn_actualizar") {
      var ban = 0;
      var texto = '';

      if ($('#archivov').val() == "") {
        $('#archivov').addClass("brc-danger");
        texto = texto + "* El Archivo PDF no ha sido Cargado!   ";
        ban = 1;
      }
      if ($('#version').val() == "") {
        $('#version').addClass("brc-danger");
        texto = texto + "* La Versión es obligatoria!  ";
        ban = 1;
      } else if ($('#fechaversion').val() == "") {
        $('#fechaversion').addClass("brc-danger");
        texto = texto + "* La Fecha de la Versión es obligatoria!";
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

        var formData = new FormData(document.getElementById("form_actualizar"));

        $.ajax({
          url: "/a_documentos/actualizar",
          type: "POST",
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(res) {
          if (res >= 1) {
            Swal.fire({
                title: "¡Correcto!",
                text: "Registro Ingresado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                window.open('/a_documentos/index', '_parent');
              });
            //});
          } else {
            let resp = Object.values(formData);
            Swal.fire("¡Error!", resp, "error");
          }
        });
        return false;
      }
      return false;
    }

    if (dato == "btn_socializar"){
      var ban = 0;
      var texto = '';

      if ($('#funcionarios').val() == "") {
        $('#funcionarios').addClass("brc-danger");
        texto = texto + "* No ha Seleccionado ningún funcionario!";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        //alert("Datos: "+datos_form);
        Swal.fire({
          title: "Por favor espere!",
          text: "Enviando la información.",
          showConfirmButton: false
        });
        var formData = new FormData(document.getElementById("form_socializar"));
        $.ajax({
          url: "/a_documentos/enviarSocializacion",
          type: "POST", 
          dataType: "html",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(res) {
          if (res >= 1) {
            Swal.fire({
                title: "¡Correcto!",
                text: "'" + res + "'Registro enviado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                window.open('/a_documentos/index', '_parent');
              });
            //});
          } else {
            let resp = Object.values(formData);
            Swal.fire("¡Error!", resp, "error");
          }
        });
        return false;
      }
      return false;
    }
    

    if (dato == "btn_pdf") {
      window.open('/a_documentos/pdf', '_blank');
    }

    if (dato == "btn_excel") {
      window.open('/a_documentos/excel', '_blank');
    }
  });

  $(document).on("change", function(event) {
    let datos = event.target.id.split("_");
    let dato = event.target.id;
    


    if (dato == "sn_doc_relacionado") {

      if ($("#sn_doc_relacionado option:selected").val() == "Si") {
        $('#docrelaciondo').css("Readonly", "false");
        $('#docrelaciondo').css("display", "none");
        $('#divdocrelaciondos').css("display", "block");
        $.post("/a_documentos/cargar_docrelacionado", {
          idreg: "" + id_subproceso + ""
        }, function(data_form) {
          $('#docrelaciondo').css("display", "none");

          $('#divdocrelaciondos').css("display", "block");
          $('#doc_relacionados').html(data_form);
        });
      } else {
        $('#docrelaciondo').attr('Readonly', 'true');
        $('#docrelaciondo').css("display", "block");
        $('#divdocrelaciondos').css("display", "none");
      }
    }

    if (dato == "doc_relacionados") {
      var macro = $('#Id_macro').val();
      var tipod = $('#Id_Tipo').val();
      var idproce = $('#Id_proceso').val();
      var idsubproce = $('#Id_subproceso').val();
      var proce = $('#Prefijo').val();
      var subproce = $('#Pref_subproceso').val();
      var docrelacionado = $('#prefdocrela').val();
      

    }

    if (dato == "solicitudesd_documentos") {
     
      idsol = $('#solicitudesd_documentos').val();  
      // alert(idsol);    
      if(idsol=="00"){
        // alert("No Aplica Solicitud");
        $('#codigo').val("");
        document.querySelector("#lbltipo").style.display ="block";
        // $('#lbltipo').css("display", "block");
        $('#tipo').css("display", "block");
        $('#tipo').removeAttr("readonly");
        $("#nombre").removeAttr("readonly");
        $("#nombre").val("");        
        $("#tipodocumento").css("display", "none");
               
        $('#div_clase_documentos').css("display", "none");
        $("#macroproceso").css("display", "none");     
        $("#proceso").css("display", "none"); 
        $("#subproceso").css("display", "none");
        $("#docrelaciondo").css("display", "none");

        $('#tipodocumentos_documento').css("display", "block");       
        $('#macroprocesos_documento').css("display", "block");       
        $('#proceso_documento').css("display", "block");
        $('#subproceso_documento').css("display", "block");
        $('#divdocrelaciondos').css("display", "block");    
       
      }else{
        let id_clase = "";
        $('#documentos_solicitud').css("display", "none");
        $('#tipodocumentos_documento').css("display", "none");
        $('#macroprocesos_documento').css("display", "none");
        $('#proceso_documento').css("display", "none");
        $('#subproceso_documento').css("display", "none");
        $('#divdocrelaciondos').css("display", "none");
        $('#tipodocumento').attr('Readonly', 'true');
        $('#div_clase_documentos').css("display", "none"); 
        $("#nombre").css("display", "block"); 
        $("#nombre").attr("Readonly",true);
        $("#tipodocumento").css("display", "block");   
        $("#macroproceso").css("display", "block");     
        $("#proceso").css("display", "block"); 
        $("#subproceso").css("display", "block");
        $("#docrelaciondo").css("display", "block");
             
        $.post("/a_documentos/cargarsolicitud", {idsol: "" + idsol + ""}, function(data_preg) {
          let tipo = $('#tipo').val();
          $("#nombre").val(data_preg['solicitud'].Documento);
          let id_tipo = data_preg['solicitud'].Id_Tipo;
          $("#Id_Tipo").val(data_preg['solicitud'].Id_Tipo);
          $("#Id_Tipo_Solicitud").val(data_preg['solicitud'].Tipo_solicitud);
          $("#tipodocumento").val(data_preg['solicitud'].Tipo_doc);
          $("#tipo_documento").val(data_preg['solicitud'].Tipo_doc);
          let id_macro = data_preg['solicitud'].Id_macro;
          $("#Id_macro").val(data_preg['solicitud'].Id_macro);
          $("#macroproceso").val(data_preg['solicitud'].Macroproceso);
          $("#Prefijo").val(data_preg['solicitud'].Prefijo);
          $("#proceso").val(data_preg['solicitud'].Proceso);
          let id_proceso = data_preg['solicitud'].Id_proceso;
          $("#Id_proceso").val(data_preg['solicitud'].Id_proceso);
          let id_subproceso = data_preg['solicitud'].Id_subproceso;
          $("#Id_subproceso").val(data_preg['solicitud'].Id_subproceso);
          $("#Pref_subproceso").val(data_preg['solicitud'].Pref_subproceso);
          $("#subproceso").val(data_preg['solicitud'].Subproceso);
          $("#prefdocrela").val(data_preg['solicitud'].prefdocrela); 
          let id_docrelacionado = data_preg['solicitud'].doc_relacionado;
          $("#doc_relacionado").val(data_preg['solicitud'].doc_relacionado);
          $("#docrelacionados").val(data_preg['solicitud'].docrelacionado);       

          generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionado);    
        });        
    
        $('#tipo').attr('Readonly', 'true');
        
      }
    } 

    if(dato == "tipodocumentos_documento"){
      $("#tipo_documento").val($("#tipodocumentos_documento option:selected").text());
      
        var tipo = 1;
        let id_clase =$('#clase_documento').val();

        var id_macro = "null";
        if($('#macroprocesos_documento').val()==''){
           id_macro = $('#macroprocesos_documento').val();
        }
        let id_proceso = "null";
        let id_subproceso="null";
        let id_docrelacionado ="null";
        if ($('#proceso_documento option:selected').val() !="999"){
          id_proceso = $('#proceso_documento option:selected').val();          
        }
        if ($('#subproceso_documento option:selected').val()!="999"){
          id_subproceso = $('#subproceso_documento option:selected').val();
        }
        let id_tipo = $('#tipodocumentos_documento option:selected').val();  
        if($('#doc_relacionados option:selected').val()==''){
          id_docrelacionado = $('#doc_relacionados option:selected').val();
        }        

        generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionado);
              
    }
    
    if(dato == "tipo"){
      let idtipo= $('#tipo').val();
      
      if(idtipo=="1"){

        $('#div_clase_documentos').css("display", "flex");
        $('#nombre').removeAttr("readonly");
        $('#tipodocumentos_documento').css("display", "block");
        $('#tipodocumentos_documento').prop('disabled', true);
        $('#tipodocumento').css("display", "none"); 
        $('#macroproceso').css("display", "none");
        $("#proceso").css("display", "none"); 
        $('#div_macroprocesos_documentos').css("display", "none");
        $('#div_subprocesos_documentos').css("display", "none");
        $("#docrelaciondo").css("display", "none");

        $('#lblversion').css("display", "none");
        $('#version').css("display", "none");
        
        $('#div_colver1').css("display", "none");
        $('#div_colver2').css("display", "none");
        $('#tipo_documento').val('Otro Documento');
      }else{
        
        $('#tipodocumentos_documento').prop('disabled', false);
          
        $('#div_clase_documentos').css("display", "none");
        
        $("#nombre").removeAttr("readonly");       

        $('#div_colver1').css("display", "none");
        $('#div_colver2').css("display", "none");
        $('#div_macroprocesos_documentos').css("display", "flex");
        $('#div_subprocesos_documentos').css("display", "flex");
      }

    }
    if(dato=="clase_documento"){
      let id_clase= $('#clase_documento').val();
      if(id_clase=="5"){
        $('#div_macroprocesos_documentos').css("display", "flex");
        $('#div_subprocesos_documentos').css("display", "flex");
        $('#codigo').val("");
      }else{
        $('#div_macroprocesos_documentos').css("display", "none");
        $('#div_subprocesos_documentos').css("display", "none"); 
        var tipo = 1;
        let id_macro = "null";
        let id_tipo = $('#tipodocumentos_documento').val();
        let id_proceso ="null";
        let id_subproceso = "null";
        let id_docrelacionao="null";
        generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionao);       
      }

    }

    if(dato == "cargosM_documentos"){
      var idcarg = $('#cargosM_documentos').val().toString();      
      $('#funcionarios').select2({
        placeholder: 'Seleccione...',      
        ajax:{
          url:'cargarEmpleados',
          data:{'idcarg':idcarg},
          dataType:'json',
          type:'GET',
          delay:250,
          processResults: function (data){
            return{
              results:data
            };
          },
          cache:true
        }
      });
    }

    if(dato == "macroprocesos_documento") {
      if(ban == 0) {
        Swal.fire({   
          title: "Por favor espere!",   
          text: "Cargando los procesos",   
          showConfirmButton: false 
        });
        $.post("/a_documentos/cargar_procesos",{macro: ""+$('#macroprocesos_documento option:selected').val()+""}, function(data_pro){
          $('#proceso_documento').html(data_pro);
            Swal.close();
        });
        $('#subproceso_documento').val("");

      }
      var tipo = 1;
      let id_clase= $('#clase_documento').val();
      let id_macro = $('#macroprocesos_documento  option:selected').val();
      let id_tipo = $('#tipodocumentos_documento  option:selected').val();
      let id_proceso ="null";
      let id_subproceso = "null";
      let id_docrelacionado="null";

      $.post("/d_solicitud/cargar_docrelacionado",{idmacro: ""+id_macro+"",idproc: ""+id_proceso+"",idsubpr: ""+id_subproceso+""}, function(data_form){
          $('#lbldoc_relacionado').css("display", "block");
          $('#divdoc_relacionado').css("display", "block");
          $('#doc_relacionados').html(data_form);
      });       
      
      generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionado);
      ban0="1";
      // calcular_codigo(tipod,macro,idproce,proce,idsubproce,subproce,docrelacionado);
    }

    if(dato == "proceso_documento") {
      if(ban == 0) {
        Swal.fire({   
          title: "Por favor espere!",     
          text: "Cargando los subprocesos",   
          showConfirmButton: false 
        });
        $.post("/a_documentos/cargar_subprocesos",{proce: ""+$('#proceso_documento option:selected').val()+""}, function(data_subpro){
            // alert(data_subpro+" -- "+$('#procesos_solicitud option:selected').val());
            $('#subproceso_documento').html(data_subpro);
            Swal.close();
        });
      }
      let id_clase= $('#clase_documento').val();
      let id_macro = $('#macroprocesos_documento option:selected').val();
      var id_proceso = "null";
      var id_subproceso = "null";
      var tipo = 1;
      
      if ($('#proceso_documento option:selected').val() !="999"){
        id_proceso = $('#proceso_documento option:selected').val();        
      }
        
      if ($('#subproceso_documento').val()==null || $('#subproceso_documento option:selected').val()=="999"){
        id_subproceso = "null"
      }else{
        id_subproceso = $('#subproceso_documento option:selected').val();
      }

      let id_tipo = $('#tipodocumentos_documento option:selected').val();     
      let id_docrelacionado="null";

      $.post("/d_solicitud/cargar_docrelacionado",{idmacro: ""+id_macro+"",idproc: ""+id_proceso+"",idsubpr: ""+id_subproceso+""}, function(data_form){
          $('#lbldoc_relacionado').css("display", "block");
          $('#divdoc_relacionado').css("display", "block");
          $('#doc_relacionados').html(data_form);
      });

      generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionado);
      ban0="1";
    }
        
    if(dato == "subproceso_documento") {
      var tipo = 1;
      let id_macro = $('#macroprocesos_documento option:selected').val();
      var id_proceso =$('#proceso_documento option:selected').val();
      var id_subproceso = "null"; 
      if ($('#subproceso_documento option:selected').val()==null || $('#subproceso_documento option:selected').val()=="999"){
        id_subproceso = "null"
      }else{
        id_subproceso = $('#subproceso_documento option:selected').val();
      }
      let id_tipo = $('#tipodocumentos_documento option:selected').val();  
      let id_clase= $('#clase_documento option:selected').val();
      let id_docrelacionado="null";   
     
      $.post("/d_solicitud/cargar_docrelacionado",{idmacro: ""+id_macro+"",idproc: ""+id_proceso+"",idsubpr: ""+id_subproceso+""}, function(data_form){
          $('#lbldoc_relacionado').css("display", "block");
          $('#divdoc_relacionado').css("display", "block");
          $('#doc_relacionados').html(data_form);
      });
      generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionado);
      ban0="1";
    } 
    if(dato == "doc_relacionados") {
      var tipo = 1;
      let id_clase = '';
      let id_macro = $('#macroprocesos_documento option:selected').val();
      let id_proceso = "null";
      let id_subproceso = "null";
      let id_docrelacionado="null";
      let id_tipo = $('#tipodocumentos_documento option:selected').val();  

      if ($('#proceso_documento').val() ==null|| $('#proceso_documento option:selected').val()=="999"){
        id_proceso = "null";        
      }else{
        id_proceso = $('#proceso_documento option:selected').val(); 
      }
      if ($('#subproceso_documento').val()==null || $('#subproceso_documento option:selected').val()=="999"){
        id_subproceso = "null"
      }else{
        id_subproceso = $('#subproceso_documento option:selected').val();
      }
      
      if($('#doc_relacionados').val()==null || $('#doc_relacionados option:selected').val()=="999"){
        id_docrelacionado = "null"
      }else{
        id_docrelacionado = $('#doc_relacionados option:selected').val();
      }  
       
      generar_consecutivo(tipo,id_tipo,id_clase,id_macro,id_proceso,id_subproceso,id_docrelacionado); 
      ban0="1";
    }
  });

  $('#archivov').aceFileInput({

    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo Visualización',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
    allowExt: 'pdf|xls|xlsx'
  })

  $('#archivof').aceFileInput({

    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo origen',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'

  })
  
  $(".UpperCase").on("keypress", function () {
      $input=$(this);
      setTimeout(function () {
       $input.val($input.val().toUpperCase());
      },50);
    })


  $('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function(event) {
    $('#' + event.target.id).removeClass("brc-danger");
  });

});