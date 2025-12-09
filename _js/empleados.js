$(function () {
  cargar_listado();

  function cargar_listado() {
    Swal.fire({ 
      title: "Por favor espere!",   
      text: "Cargando lista de Empleados.",
      showConfirmButton: false 
    });
    
    $.post("/a_empleados/listar_tabla",{}, function(data_carg){
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
      $('#newModalLabel').html('Modificar Empleados');
      
      $.post("/a_empleados/modificar",{idreg: ""+idreg+""}, function(data_preg){
      
        $('#idregistro').val(data_preg['empleados'].id_empleado);
        $("#Tipo_docidentidad_empleados").val(data_preg['empleados'].Id_tipdocIdentidad);
        $("Tipo_docidentidad_empleados").change();
        $("#cedula").val(data_preg['empleados'].cedula);
        $("#nombres").val(data_preg['empleados'].nombres);         
        $("#apellidos").val(data_preg['empleados'].apellidos);
        $("#fecha_nacimiento").val(data_preg['empleados'].fecha_nacimiento);
        $("#direccion").val(data_preg['empleados'].direccion);
        $("#telefono").val(data_preg['empleados'].telefono);
        $("#email").val(data_preg['empleados'].email);
        $("#cargos_empleados").val(data_preg['empleados'].id_cargo);
        $("#cargos_empleados").change();
        $("#eps_empleados").val(data_preg['empleados'].id_eps);
        $("#eps_empleados").change();
        $("#arl_empleados").val(data_preg['empleados'].arl);
        $("#arl_empleados").change();
        $('#div_gruposanguineo').css("display", "flex");
        $("#gruposanguineo").val(data_preg['empleados'].grupo_sanguineo);
        $("#gruposanguineo").change();  
        $("#nivel_riesgo").val(data_preg['empleados'].nivel_riesgo);
        $("#nivel_riesgo").change();  
        $('#div_estado').css("display", "flex");
        $("#estado").val(data_preg['empleados'].estado);
        $("#estado").change();  
      });
      $('#div_perfil').css("display", "none");
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
              $.post("/a_empleados/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
      
      $.post("/a_empleados/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
      if( ($('#cedula').val()=="")){
        $('#cedula').addClass("brc-danger");
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
          text: "Guadando la información.", 
          showConfirmButton: false 
        });
        var datos_form = $("#form_guardar").serialize();
        $.post("/a_empleados/guardar", datos_form , function(data_form){
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

    if(dato == "btn_nuevo_empleado") {
      $('#newModalLabel').html('Nuevo Empleado');
      $('#div_perfil').css("display", "none");
      $('#btn_guardar').css("display", "block");
      $('#btn_actualizar').css("display", "none");
      $('#div_estado').css("display", "none");
      $("#form_guardar")[0].reset();
    }

    if(dato == "btn_actualizar") {
      var ban=0;
      var texto='';
      if( ($('#id_tipdocIdentidad').val()=="")){
        $('#id_tipdocIdentidad').addClass("brc-danger");
        texto=texto+"* El tipo de documento de indentidad es obligatorio!<br>";
        ban=1;
      }

      if( ($('#cedula').val()=="")){
        $('#cedula').addClass("brc-danger");
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

      if( $('#fecha_nacimiento').val()=="" ){
        $('#fecha_nacimiento').addClass("brc-danger");
        texto=texto+"* La fecha de nacimiento es obligatoria!<br>";
        ban=1;
      }   

      if( $('#fecha_nacimiento').val()=="" ){
        $('#fecha_nacimiento').addClass("brc-danger");
        texto=texto+"* La fecha de nacimiento es obligatoria!<br>";
        ban=1;
      }   

      if( $('#direccion').val()=="" ){
        $('#direccion').addClass("brc-danger");
        texto=texto+"* La dirección es obligatoria!<br>";
        ban=1;
      }   

      if( $('#telefono').val()=="" ){
        $('#telefono').addClass("brc-danger");
        texto=texto+"* El teléfono es obligatoria!<br>";
        ban=1;
      }   
      
      if( $('#fecha_nacimiento').val()=="" ){
        $('#fecha_nacimiento').addClass("brc-danger");
        texto=texto+"* La fecha de nacimiento es obligatoria!<br>";
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
        $.post("/a_empleados/actualizar", datos_form , function(data_form){
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
      window.open('/a_empleados/pdf','_blank');
    }

    if(dato == "btn_excel") {
      window.open('/a_empleados/excel','_blank');
    }
  });
  
  $('#cedula').blur(function(e){
    e.preventDefault();
    $.post("/a_empleados/consultar_empleado", {cedula:($('#cedula').val())}, function(data_preg){
      if(data_preg == "1"){
        Swal.fire("¡La Cedula ya se encuentra registrada", $('#cedula').val(), "error");
        $('#Tipo_docidentidad_empleados').val("").change();
        $('#cedula').val("");           
      }   
    });    
  });

  $(document).on("change", function (event) {
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    var ck= event.target.checked;
    if(dato =="ck_crear_usuario"){
      if(ck){
        $('#crea_usuario').val("1");
        $('#div_perfil').css("display", "flex");       
      }else{
        $('#crea_usuario').val("0");
        $('#div_perfil').css("display", "none");
      }
    }

  });
  
  

  $(document).ready(function() {

    $('form').keypress(function(e){   
      if(e == 13){
        return false;
      }
    });

    $('input').keypress(function(e){
      if(e.which == 13){
        return false;
      }
    });

  });

  $('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
    $('#'+event.target.id).removeClass("brc-danger");    
  });
  
  $(".UpperCase").on("keypress", function () {
      $input=$(this);
      setTimeout(function () {
        $input.val($input.val().toUpperCase());
      },50);
  })
});