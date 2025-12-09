$(function() {

  var  ban0="0";
  var change = false;
  var arrChange =[];
  
   $('.ace-file-input').aceFileInput({
    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo Excel a Importar',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'
  });


  if ($('#opc_pag').val() == "listado") {

    cargar_listado();

    function cargar_listado() {
      Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de Documentos.",
        showConfirmButton: false
      });

      $.post("/r_resultadosDx/listar_tabla", {}, function(data_carg) {
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
    arrChange =[];
    if($('#estado').val() == "2"){
      $('#ck_enviarcorreo').prop("checked", true);
    }else{
      $('#ck_enviarcorreo').prop("checked", false);
    }

  }  

  $(document).on("click", function(event) {
    var datos = event.target.id.split("_");
    var dato = event.target.id;

    if (datos[0] == "btnEditar"){
      var idreg = datos[1];

      window.open('/r_resultadosDx/modificar/' + idreg, '_parent');
      return false;           
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

    if(dato == "btn_actualizar"){
      if(!change){
        Swal.fire("¡Atención!", "No se han hecho cambios en el formulario, no se puede actualizar el registro", "warning");
      }else{
          guardar_actualizacion();
        return false;
      }
      return false;
    }


    if(dato == "btn_guardar_paciente"){

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

      if ($('#apellidos').val() == "") {
          $('#apellidos').addClass("brc-danger");
          texto = texto + "* Los apellidos son obligatorios!<br>";
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
          var datos_form = $("#form_paciente").serialize();
          $.post("/r_resultadosDx/guardar_paciente", datos_form, function (data_form) {
              Swal.close();
              if (data_form == "1") {
                //jQuery(function(){
                Swal.fire({
                  title: "¡Correcto!",
                  text: "Registro ingresado correctamente!",
                  icon: "success"
                })
                .then((willDelete) => {
                  
                  $("#form_paciente")[0].reset();
                  $('#newMPaciente').modal('hide');
                });
              } else {
                  Swal.fire("¡Error!", data_form, "error");
              }
          });
          return false;
      }
      return false;
    }


    if (dato == "btn_agregar_paciente") {

      document.addEventListener('DOMContentLoaded', () => {
          document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
              if (e.keyCode == 13) {
                  e.preventDefault();
              }
          }))
      });

      $('#lblotra_entidad_salud').css("display", "none");
      $('#otra_entidad_salud').css("display", "none");
      $('#div_estadop').css("display", "none");
      // $('#lblestado').css("display", "none");
      $("#form_paciente")[0].reset();
      const fechaNacimiento = $("#fecha_nacimiento").val();           

      $('#fecha_nacimiento').on('change', function () {
          // alert(fechaNacimiento);
          if (this.value) {
              $('#edad').val(`${calcularEdad(this.value)} `);
              // alert(edad);
          }
      });

      $('#btn_actualizar_paciente').css("display", "none");
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

    $.post("/r_resultadosDx/modificar_paciente",{idreg: ""+idreg+""}, function(data_preg){
      $('#idregistropa').val(data_preg['pacientes'].id_paciente);
      $("#Tipo_docidentidad_pacientes").val(data_preg['pacientes'].id_tipodocumento);
      $("Tipo_docidentidad_pacientes").change();
      $("#numero_id").val(data_preg['pacientes'].numero_id);
      $("#nombres").val(data_preg['pacientes'].nombres);
      $("#apellidos").val(data_preg['pacientes'].apellidos);
      $("#eps_pacientes").val(data_preg['pacientes'].id_entidad_salud);
      $("#eps_pacientes").change();
      $("#otra_entidad_salud").val(data_preg['pacientes'].otra_entidad_salud);
      $("#correo").val(data_preg['pacientes'].correo);
      
      $("#estado").val(data_preg['pacientes'].estado);
      // alert (data_preg['pacientes'].fecha_nacimiento);
     
    });

    $('#btn_guardar_paciente').css("display", "none");
    $('#btn_actualizar_paciente').css("display", "block");
    $('#newMPaciente').modal({
      show: true,
      keyboard: false
    });
  }

  if(dato == "btn_actualizar_paciente") {
    var ban=0;
    var texto='';
    var cedula = $('#numero_id').val();
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
      var datos_form = $("#form_paciente").serialize();
      $.post("/r_resultadosDx/actualizar_paciente", datos_form , function(data_form){
        Swal.close();
          if(data_form=="1") {
          //jQuery(function(){
            Swal.fire({
                title: "¡Correcto!",
                text: "Registro actualizado correctamente!",
                icon: "success"
            })
            .then((willDelete) => {
              $("#form_paciente")[0].reset();
              $('#newMPaciente').modal('hide');

              $.post("/r_resultadosDx/cargar_paciente", {
                  paci: "" + cedula + ""
              }, function (data_paci) {
                $('#idpaciente').val(data_paci['pacientes'].id_paciente);
                $('#cedula').val(cedula);
                $('#paciente').val(data_paci['pacientes'].paciente);
                $('#correopaciente').val(data_paci['pacientes'].correo)
              });
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
            $.post("/r_resultadosDx/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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

  });

   $(document).on("change", function(event) {
    let datos = event.target.id.split("_");
    let dato = event.target.id;
    var ck = event.target.checked;
    change = true;

    if (!arrChange.includes(dato)){
      arrChange.push(dato);
    }

    if (dato == "eps_pacientes") {

        if ($("#eps_pacientes").val() != 10) {

            $('#lblotra_entidad_salud').css("display", "none");
            $('#otra_entidad_salud').css("display", "none");

        } else {

            $('#lblotra_entidad_salud').css("display", "block");
            $('#otra_entidad_salud').css("display", "block");
        }
    }

    if(dato == "ck_enviarcorreo") {
      $('#txtchecked').val(ck);

    }else{

      $('#txtchecked').val(false);
    }

  });

$('#cedula').blur(function (e){
  e.preventDefault();
  var cedula = $('#cedula').val();
  $.post("/r_resultadosDx/cargar_paciente", {
      paci: "" + cedula + ""
  }, function (data_paci) {

    $('#idpaciente').val(data_paci['pacientes'].id_paciente);
    $('#paciente').val(data_paci['pacientes'].paciente);
    $('#correopaciente').val(data_paci['pacientes'].correo)
    
    if ($('#idpaciente').val() != "") {
        $('#btn_agregar_paciente').css("display", "none");
        $('#btn_editar_paciente').css("display", "flex");
    } else {
        Swal.fire("Paciente no Existe!");
        $('#btn_agregar_paciente').css("display", "block");
        $('#btn_editar_paciente').css("display", "none");
    }
  });
});

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
      url: "/r_resultadosDx/guardar",
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
            window.open('/r_resultadosDx/index', '_parent');
          });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
  }

  function guardar_actualizacion(){
    Swal.close();
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false
    });

    var formData = new FormData(document.getElementById("form_modificar"));
    $.ajax({
      url: "/r_resultadosDx/actualizar_resuladoDx",
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
            text: "Registro actualizado correctamente!",
            icon: "success"
          })
          .then((willDelete) => {
            window.open('/r_resultadosDx/index', '_parent');
          });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
  }
    

  $('#archivov').aceFileInput({

    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo Visualización',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
    allowExt: 'pdf|xls|xlsx'
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
 