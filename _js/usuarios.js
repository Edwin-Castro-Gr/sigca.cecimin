/*
Template Name: Material Pro Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/ 
$(function () {
  cargar_listado();

  function cargar_listado() {
    Swal.fire({   
      title: "Por favor espere!",   
      text: "Cargando lista de Usuarios.",   
      showConfirmButton: false 
    });
    
    $.post("/a_usuarios/listar_tabla",{}, function(data_carg){
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

  $('#btn_guardar_modal').click(function(){
    var ban=0;
    var texto='';

    if( ($('#perfil').val()=="0")){
      $('#div_perfil').addClass("has-danger");
      texto=texto+"* El perfil es obligatorio<br>";
      ban=1;
    } else {
      if($('#nombre').val()=="0") {
        $('#div_nombre').addClass("has-danger");
        texto=texto+"* El nombre es obligatorio<br>";
        ban=1;
      }
      if( ($('#email').val()=="")){
        $('#div_email').addClass("has-danger");
        texto=texto+"* El email es obligatorio<br>";
        ban=1;
      }
      if( ($('#clave').val()=="")){
        $('#div_clave').addClass("has-danger");
        texto=texto+"* La clave es obligatoria<br>";
        ban=1;
      }
      if( ($('#clave2').val()=="")){
        $('#div_clave2').addClass("has-danger");
        texto=texto+"* Debe confirmar la clave<br>";
        ban=1;
      } else if( $('#clave').val() != $('#clave2').val()){
        $('#div_clave').addClass("has-danger");
        $('#div_clave2').addClass("has-danger");
        texto=texto+"* Las Claves no son iguales<br>";
        ban=1;
      }
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
      var datos_form = $("#modalForm").serialize();
      $.post("/a_usuarios/guardar", datos_form , function(data_form){
        Swal.close();
        if(data_form=="1") {
          Swal.fire({
            title: "¡Correcto!",
            text: "Registro ingresado correctamente!",
            type: "success",
            onClose: () => {
              $('#modalForm')[0].reset();
              cargar_listado();
            }
          });            
        } else {
          Swal.fire("¡Error!", data_form, "error");
        }
      });      
      return false;
    }
    return false;
  });

  $('#btn_actualizar_modal').click(function(){
    var ban=0;
    var texto='';
    
    if($('#nombre').val()=="") {
      $('#div_nombre').addClass("has-danger");
      texto=texto+"* El nombre es obligatorio";
      ban=1;
    }
    if( ($('#email').val()=="")){
      $('#div_email').addClass("has-danger");
      texto=texto+"* El email es obligatorio";
      ban=1;
    }
    if( ($('#perfil').val()=="")){
      $('#div_perfil').addClass("has-danger");
      texto=texto+"* El perfil es obligatorio";
      ban=1;
    }


    if( ($('#clave').val()!="") || ($('#clave2').val()!="") ){
      if( $('#clave').val() != $('#clave2').val()){
        $('#div_clave').addClass("has-danger");
        $('#div_clave2').addClass("has-danger");
        texto=texto+"* Las Claves no son iguales";
        ban=1;
      }
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
      var datos_form = $("#modalForm").serialize();
      $.post("/a_usuarios/actualizar", datos_form , function(data_form){
        Swal.close();
        if(data_form=="1") {
          Swal.fire({
            title: "¡Correcto!",
            text: "Registro actualizado correctamente!",
            type: "success",
            onClose: () => {
              $('#modalForm')[0].reset();
              cargar_listado();
              $('#add-registro').modal('hide');
            }
          });            
        } else {
          Swal.fire("¡Error!", data_form, "error");
        }
      });      
      return false;
    }
    return false;
  });

  $('#btn_nuevo_registro').on("click", function(event){
    $("#perfil").attr('disabled',false);
    $('#modalForm')[0].reset();
    $('#myModalLabel').html('Crear Usuario');
    $('#btn_guardar').css("display", "block");
    $('#btn_actualizar').css("display", "none");
    $('#div_estado').css("display", "none");
  });

  
  $(document).on("click", function(event){
    var datos = event.target.id.split("_");
    
    if(datos[0] == "btneditar") {
      idreg = datos[1];
      $('#modalForm')[0].reset();
      $('#myModalLabel').html('Modificar Usuario');
      alert('editar');
      $.post("/a_usuarios/cargar_registro",{idreg: ""+idreg+""}, function(data_preg){        
        $('#idusuario').val(data_preg['usuario'].id_usuario);
        $('#empleados_usuarios').val(data_preg['usuario'].id_usuario).trigger('change');
        $('#nombres').val(data_preg['usuario'].nombre);
        $('#apellidos').val(data_preg['usuario'].apellido);
        $("#email").val(data_preg['usuario'].email);        
        $('#telefono').val(data_preg['usuario'].telefono);
        // $('#apellidos').val(data_preg['usuario'].apellido);
        $("#div_email").addClass( "focused" );
        
        $("#perfil").val(data_preg['usuario'].perfil).trigger('change');
        $("#perfil").attr('disabled',true);

        $("#estado").val(data_preg['usuario'].estado);
        $("#estado").change();
        $("#div_estado").addClass( "focused" );
        $('#div_estado').css("display", "block");
      });

      $('#btn_guardar').css("display", "none");
      $('#btn_actualizar').css("display", "block");

      $('#add-registro').modal({
        show: true,
        keyboard: false
      });
    }

    if(datos[0] == "btninactivar") {
      var id_reg = datos[1];
      var nom_reg = $('#nombre_'+id_reg).val();
      Swal.fire({
          title: "Desea Inactivar el Registro: '"+nom_reg+"' ?",
          text: "Podras activarlo en cualquier momento con la edición!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dd3333',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Si, Inactivar!',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.value) {
            $.post("/a_usuarios/inactivar",{idreg: ""+id_reg+""}, function(data_form){
              //alert(data_form);
              if(data_form=="1") {
                Swal.fire({
                  title: "Inactivado!",
                  text: "El registro se ha inactivado.",
                  type: "success",
                  button: "Ok",
                })
                .then((value) => {
                  cargar_tabla();
                });
              } else {
                Swal.fire("¡Error!", "Se presento el siguiente error: "+data_form, "error");
              }
            });
          }
      });
      return false;
    }

    if(datos[0] == "btndetalle") {
      idreg = datos[1];
      
      $.post("/a_usuarios/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
        //alert(data_carg);
        $("#modalForm1").html(data_carg);
      });

      $('#view-registro').modal({
        show: true,
        keyboard: false
      });
      return false;
    }

    if(dato == "btn_excel") {
      window.open('/a_usuarios/excel','_blank');
    }
  });

  $(document).on("change", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;

    /*if(dato == "perfil") {
      if($('#perfil option:selected').val() >= 1) {
        $('#datos_usuario').css('display','none');
        Swal.fire({   
          title: "Por favor espere!",   
          showConfirmButton: false,
          imageUrl: '/SICO/assets/images/ajax-loader.gif',
          imageWidth: 50,
          imageHeight: 50
        });

        $('#nombre').html('<option value="0">Cargando Empleados...</opcion>');
        $.post("cargar_empleado",{tipo: ""+ $('#perfil').val() +""}, function(data_form){
          //alert(data_form);
          Swal.close();
          if(data_form['datos'].estado == "1") {
            $('#datos_usuario').css('display','block');
            $('#nombre').html(data_form['datos'].opc);
          } else {
            Swal.fire("¡Error!", "Se presento el siguiente error: " + data_form['datos'].opc, "error");
          }
        });
        return false;
      } else {
        $('#datos_usuario').css('display','none');
        return false;
      }
    }*/
  });

  $('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
    $('#div_'+event.target.id).removeClass("has-danger");    
  });

});
