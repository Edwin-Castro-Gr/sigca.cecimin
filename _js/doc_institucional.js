$(function () {

  var cmeses = "";

  if($('#opc_pag').val() == "listado") {
    
    

  cargar_listado();

    function cargar_listado() {
      Swal.fire({ 
        title: "Por favor espere!",   
        text: "Cargando lista de Documentos.",
        showConfirmButton: false 
      });
      
      $.post("/d_doc_institucionales/listar_tabla",{}, function(data_carg){
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
  }else if($('#opc_pag').val() == "ingreso") {
    var ban = 0;
          
    $('#empleados_responsable').select2({
        width: "100%",  
        placeholder: ' ',
        allowClear: true
    });
         
  }else if($('#opc_pag').val() == "modificar") {
    var ban = 0;
        
    $('#empleados_documentos').select2({
        width: "100%",  
        placeholder: ' ',
        allowClear: true
    });
    $('#empleados_documentos').trigger('change');    
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
      url: "/d_doc_institucionales/guardar",
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
          window.open('/d_doc_institucionales/index','_parent');            
        }); 
      } else {
          Swal.fire("¡Error!", res, "error");
      }
    }); 
  }

  $(document).on("click", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    
    if(datos[0] == "btneditar") {
      idreg = datos[1];
      
      window.open('/d_doc_institucionales/modificar/'+idreg,'_parent');
    }

    if(datos[0] == "btninactivar") {
      //jQuery(function(){
        var id_reg = datos[1];
        var nom_reg = $('#nombre_'+id_reg).val();
        Swal.fire({
          title: "Desea Inactivar el Registro: '"+nom_reg+"' ?",
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
              $.post("/d_doc_institucionales/inactivar",{idreg: ""+id_reg+""}, function(data_form){
                //alert(data_form);
                if(data_form=="1") {
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
                  Swal.fire("¡Error!", "Se presento el siguiente error: "+data_form, "error");
                }
            });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.DismissReason.cancel;
            }
        });
        
      return false;
    }

    if(datos[0] == "btndetalle") {
      idreg = datos[1];
      
      $.post("/d_doc_institucionales/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
        //alert(data_carg);
        $("#modalForm1").html(data_carg);
      });

      $('#view-registro').modal({
        show: true,
        keyboard: false
      });
      return false;
    }

    if(dato == "btn_guardar") {
      var ban=0;
      var texto='';
      
        if ($('#nombre').val() == "") {
            $('#nombre').addClass("brc-danger");
            texto = texto + "* El Campo nombre no puede estar vacion!";
            ban = 1;
        }else if ($('#archivo').val() == "") {
            $('#archivo').addClass("brc-danger");
            texto = texto + "* No se ha cargado el Archivo!  ";
            ban = 1;
        }else if ($('#empleados_documentos').val() == "") {
            $('#empleados_documentos').addClass("brc-danger");
            texto = texto + "* El resposable es obligatorio!";
            ban = 1;
        }else if ($('#periodicidad').val() == "") {
            $('#periodicidad').addClass("brc-danger");
            texto = texto + "* La Periodicidd es obligatoria!";
            ban = 1;
        }else if ($('#fechainicial').val() == "") {
            $('#fechainicial').addClass("brc-danger");
            texto = texto + "* La fecha del documento es obligatoria!";
            ban = 1;
        }
        if(ban==1) {     
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

    // if(dato == "btn_importar") {
    //       var ban=0;
    //       var texto='';


    // if ($('#upload_file').val() == "") {
    //         $('#upload_file').addClass("brc-danger");
    //         texto = texto + "* El Archivo a importar no ha sido Cargado!";
    //         ban = 1;
    // }
    // if(ban==1) {  
    //   Swal.fire("¡Atención!", texto, "warning");
    // } else {
    //     //alert("Datos: "+datos_form);
    //     Swal.fire({   
    //       title: "Por favor espere!",   
    //       text: "Guadando la información.", 
    //       showConfirmButton: false 
    //     });   
    //     var formData = new FormData(document.getElementById("form_importar"));
        
    //     $.ajax({
    //       url: "/d_doc_institucionales/importar_documentos",
    //       type: "POST",
    //       dataType: "html",
    //       data: formData,
    //       cache: false,
    //       contentType: false,
    //       processData: false
    //     }).done(function(res){
    //       if(res >= 1) {
    //         Swal.fire({
    //           title: "¡Correcto!",
    //           text: "'"+res+"'Registro Ingresado correctamente!",
    //           icon: "success"
    //         })
    //     .then((willDelete) => {
    //       window.open('/d_doc_institucionales/index','_parent');            
    //     }); 
    //         //});
    //       } else {
    //         let resp = Object.values(formData);
    //         Swal.fire("¡Error!", resp, "error");
    //       }
    //     });     
    //     return false;             
    //   }
    //   return false;
    // }


    if(dato == "btn_actualizar") {
      var ban=0;
      var texto='';

      if ($('#nombre').val() == "") {
            $('#nombre').addClass("brc-danger");
            texto = texto + "* El Campo nombre no puede estar vacion!";
            ban = 1;
        }else if ($('#empleados_documentos').val() == "") {
            $('#empleados_documentos').addClass("brc-danger");
            texto = texto + "* El resposable es obligatorio!";
            ban = 1;
        }else if ($('#periodicidad').val() == "") {
            $('#periodicidad').addClass("brc-danger");
            texto = texto + "* La Periodicidd es obligatoria!";
            ban = 1;
        }else if ($('#fechainicial').val() == "") {
            $('#fechainicial').addClass("brc-danger");
            texto = texto + "* La fecha del documento es obligatoria!";
            ban = 1;
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

        var formData = new FormData(document.getElementById("form_actualizar"));
        
        $.ajax({
          url: "/d_doc_institucionales/actualizar",
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
                window.open('/d_doc_institucionales/index','_parent');  
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

    if(dato == "btn_pdf") {
      window.open('/d_doc_institucionales/pdf','_blank');
    }

    if(dato == "btn_excel") {
      window.open('/d_doc_institucionales/excel','_blank');
    }
  });

  $(document).on("change", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    

    if(dato == "periodicidad") {

        if($("#periodicidad option:selected").val()=="1"){
          cmeses = 1;           
        }else if($("#periodicidad option:selected").val()=="2"){
          cmeses = 2;
        }else if($("#periodicidad option:selected").val()=="3"){
          cmeses = 3; 
        }else if($("#periodicidad option:selected").val()=="4"){
          cmeses = 6; 
        }else{
          cmeses = 12;
        }
    }

    if(dato == "fechainicial") {
        
        var fechainicio=$('#fechainicial').val();        
        fechafinal = moment(fechainicio,'YYYY-MM-DD').add(cmeses, 'month'); 
       
        $('#fechafinal').val(fechafinal.format('YYYY-MM-DD'));
    }
    
  });

  $('#archivo').aceFileInput({
         
    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo correspondiente',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
    
  })

  $(".UpperCase").on("keypress", function () {
      $input=$(this);
      setTimeout(function () {
       $input.val($input.val().toUpperCase());
      },50);
  })

  $('input[type=text], input[type=email], input[type=password], file, select, select2, input[type=number]').on("change", function(event){
    $('#'+event.target.id).removeClass("brc-danger");    
  });

});