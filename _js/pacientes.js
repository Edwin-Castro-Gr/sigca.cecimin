$(function () {
  cargar_listado();

  function cargar_listado() {
    Swal.fire({ 
      title: "Por favor espere!",   
      text: "Cargando lista de Pacientes.",
      showConfirmButton: false 
    });
    
    $.post("/a_pacientes/listar_tabla",{}, function(data_carg){
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

  $(document).on("click", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    
    if(datos[0] == "btneditar") {
      idreg = datos[1];
      $('#newModalLabel').html('Modificar pacientes');
      
      $.post("/a_pacientes/modificar",{idreg: ""+idreg+""}, function(data_preg){
      
        $('#idregistro').val(data_preg['pacientes'].id_paciente);
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
       
        $('#div_estado').css("display", "flex");
        $("#estado").val(data_preg['pacientes'].estado);
        $("#estado").change();
      });

      $('#btn_guardar').css("display", "none");
      $('#btn_actualizar').css("display", "block");
      
      $('#newModal').modal({
        show: true,
        keyboard: false
      });
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
              $.post("/a_pacientes/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
      
      $.post("/a_pacientes/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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

      if( $('#Apellidos').val()==""){
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
          text: "Guadando la información.", 
          showConfirmButton: false 
        });
        var datos_form = $("#form_guardar").serialize();
        $.post("/a_pacientes/guardar", datos_form , function(data_form){
          Swal.close();
          if(data_form=="1") {
            //jQuery(function(){
              Swal.fire({
                title: "¡Correcto!",
                text: "Registro ingresado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                $("#form_guardar")[0].reset();
                cargar_listado();
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

    if(dato == "btn_nuevo_paciente") {
      $('#newModalLabel').html('Nuevo Paciente');
      $('#btn_guardar').css("display", "block");
      $('#btn_actualizar').css("display", "none");
      $('#lbotra_entidad_salud').css("display", "none");
      $('#otra_entidad_salud').css("display", "none");
      $('#div_estado').css("display", "none");
      $("#form_guardar")[0].reset();
    }

    if(dato == "btn_actualizar") {
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
        $.post("/a_pacientes/actualizar", datos_form , function(data_form){
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
          } else {
            Swal.fire("¡Error!", data_form, "error");
          }
        });      
        return false;
      }
      return false;
    }

    if(dato == "btn_pdf") {
      window.open('/a_pacientes/pdf','_blank');
    }

    if(dato == "btn_excel") {
      window.open('/a_pacientes/excel','_blank');
    }
  });

  
  $(".UpperCase").on("keypress", function () {
      $input=$(this);
      setTimeout(function () {
        $input.val($input.val().toUpperCase());
      },50);
  });

  $(document).on("change", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    if(dato == "eps_pacientes") {

      if($('#eps_pacientes').val()===10){
        $('#lbotra_entidad_salud').css("display", "block");
        $('#otra_entidad_salud').css("display", "block");
        
      }else{
        $('#lbotra_entidad_salud').css("display", "none");
        $('#otra_entidad_salud').css("display", "none");
        
      }
    }
});

  $('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
  $('#'+event.target.id).removeClass("brc-danger");    
  });

});