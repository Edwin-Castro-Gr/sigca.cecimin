$(function () {
	// cargar_listado();

	document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        }))
    });

  $('#horainiCx').inputmask('99:99');
  $('#horaFinCx').inputmask('99:99');

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
   
    $('#procedimientos_agendamiento').select2({
        placeholder: 'Seleccione el procedimiento...',
        width: "100%",
        allowClear: true
    });

    $('#procedimientos_agendamiento').trigger('change');
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

     $('#proveedoresQx_agendamiento1').select2({
        placeholder: 'Seleccione la Casa...',
        width: "100%",        
        allowClear: true  
    });
    $('#proveedoresQx_agendamiento1').val("").trigger('change');

    $('#proveedoresQx_agendamiento2').select2({
        placeholder: 'Seleccione la Casa...',
        width: "100%",        
        allowClear: true  
    });
    $('#proveedoresQx_agendamiento2').val("").trigger('change');

    $('#proveedoresQx_agendamiento3').select2({
        placeholder: 'Seleccione la Casa...',
        width: "100%",        
        allowClear: true  
    });
    $('#proveedoresQx_agendamiento3').val("").trigger('change');

    $('#proveedoresQx_agendamiento4').select2({
        placeholder: 'Seleccione la Casa...',
        width: "100%",        
        allowClear: true  
    });
    $('#proveedoresQx_agendamiento4').val("").trigger('change');

    var iddia_age='';
    var hora_age=''; 
    var horafin_age = '';

		$("#btn_guardar_paciente").click(function () {

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
          var datos_form = $("#form_paciente").serialize();
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
                          $("#form_paciente")[0].reset();
                          $('#newMPaciente').modal('hide');

                          $.post("/c_programacion/cargar_paciente", {
                              paci: "" + cedula + ""
                          }, function (data_paci) {

                              $('#idpaciente').val(data_paci['pacientes'].id_paciente);
                              $('#cedula').val(cedula);
                              $('#paciente').val(data_paci['pacientes'].paciente);

                          });
                      });
              } else {
                  Swal.fire("¡Error!", data_form, "error");
              }
          });
          return false;
      }
      return false;
  });

	function cargar_listado() {
    Swal.fire({ 
      title: "Por favor espere!",   
      text: "Cargando lista de Bloques.",
      showConfirmButton: false 
    });
    
    $.post("/c_agendaqx/listar_tabla",{}, function(data_carg){
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

	if ($('#opc_pag').val() == "agenda") {

    var TinyDatePicker = DateRangePicker.TinyDatePicker;
      TinyDatePicker('#fechaprogramacionS', {            
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
        
        hilightedDate: new Date(),

        min: Date()
            
      })
      .on('statechange', function(ev) {
        var fecha = $('#fechaprogramacionS').val();
        var nfecha = fecha.split("-").reverse().join("-");;
        // alert(nfecha);
        var id_cirj = $('#cirujano_programacion').val();

        $('#val_fechapro').val(nfecha);
        // alert(nfecha);            
    });

  }   

  $(document).on("click", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    
    if(datos[0] == "btneditar") {
      idreg = datos[1];
      $('#newModalLabel').html('Modificar Departamento');
      
      $.post("/c_agendaqx/modificar",{idreg: ""+idreg+""}, function(data_preg){
      
        $('#idregistro').val(data_preg['agendaqx'].id_agendaqx);
        $("#cirujanos_agendaqx").val(data_preg['agendaqx'].cirujanos);
        
        $('#div_diaagenda').css("display", "flex");
        $("#diaagenda").val(data_preg['agendaqx'].diaagenda);
        $("#diaagenda").change();

        $("#horainicio").val(data_preg['agendaqx'].horainicio);
        $("#horafinal").val(data_preg['agendaqx'].horafinal);

        $('#div_estado').css("display", "flex");
        $("#estado").val(data_preg['agendaqx'].estado);
        $("#estado").change();
      });

      $('#btn_guardar').css("display", "none");
      $('#btn_actualizar').css("display", "block");
      
      $('#newModalAgenda').modal({
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
          	$.post("/c_agendaqx/inactivar",{idreg: ""+id_reg+""}, function(data_form){
          		//alert(data_form);
          		if(data_form=="1") {
	              Swal.fire({
	                title: 'Inactivado!',
	                text: 'El Bloque se ha inactivado.',
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
      
      $.post("/c_agendaqx/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
      if( $('#cirujanos_agendaqx').val()=="" ){
        $('#cirujanos_agendaqx').addClass("brc-danger");
        texto=texto+"* El Cirujano es obligatorio!";
        ban=1;
      }

      if( ($('#diaagenda').val()=="")){
        $('#diaagenda').addClass("brc-danger");
        texto=texto+"* El Dia es obligatorio!<br>";
        ban=1;
      }

      if( ($('#horainicio').val()=="")){
        $('#horainicio').addClass("brc-danger");
        texto=texto+"* La hora inicial es obligatoria!<br>";
        ban=1;
      }

      if( ($('#horafinal').val()=="")){
        $('#horafinal').addClass("brc-danger");
        texto=texto+"* La hora final es obligatoria!<br>";
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
        $.post("/c_agendaqx/guardar", datos_form , function(data_form){
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
                    $("#form_paciente")[0].reset();
                    $('#newMPaciente').modal('hide');

                    $.post("/c_programacion/cargar_paciente", {
                        paci: "" + cedula + ""
                    }, function (data_paci) {

                        $('#idpaciente').val(data_paci['pacientes'].id_paciente);
                        $('#cedula').val(cedula);
                        $('#paciente').val(data_paci['pacientes'].paciente);

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

        //******************************** TABLA PROCEDIMIENTOS ***************************

    if (dato == "btn_nuevoprocedimiento") {
      $("#form_guardar_pro")[0].reset();
      $('#btn_guardar_proc').css("display", "block");
      $('#btn_actualizar_proc').css("display", "none");
      $('#procedimientos_agendamiento').val(null).trigger('change');
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
          cargar_Dprocedimientos();
          $('#newModal').modal('hide');
          $('#procedimiento_0').val('1');
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

  	if(dato == "btn_pdf") {
  		window.open('/c_agendaqx/pdf','_blank');
  	}

  	if(dato == "btn_excel") {
  		window.open('/c_agendaqx/excel','_blank');
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

  $('#cedula').blur(function (e){
    e.preventDefault();
    var cedula = $('#cedula').val();
    $.post("/c_programacion/cargar_paciente", {
        paci: "" + cedula + ""
    }, function (data_paci) {

      $('#idpaciente').val(data_paci['pacientes'].id_paciente);
      $('#paciente').val(data_paci['pacientes'].paciente);

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

  $('#grupos_agendamiento').on('change', function () {
    if ($('#grupos_agendamiento option:selected').val() == "8") {
      $('#lblmateriales').css("display","block"); 
      $('#div_chk').css("display","block");
     
      var otros = "<input type='text' name='otros' id='otros' class='form-control col-sm-11 col-md-12 UpperCase'>";
      $('#div_chk').html(otros);
      
    } else if ($('#grupos_agendamiento option:selected').val() == "9") {
      $('#lblmateriales').css("display","none"); 
      $('#div_chk').css("display","none");
        
    }else {
          
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
    }
  });


  $(document).on("change", function (event) {
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
          materiales=data_preg['procedimiento'].Id_Materiales;
          proveedores=data_preg['procedimiento'].Proveedores;
          grupo=data_preg['procedimiento'].Grupo;

          $('#idregistro').val(idreg);
          $('#id_programacion').val(data_preg['procedimiento'].Id_programcion);
          
          $('#procedimientos_agendamiento').val(data_preg['procedimiento'].Id_procedimiento).trigger('change');
          
          if(grupo!=""){
              $('#grupos_agendamiento').val(grupo).trigger('change');
              
              $.post("/c_programacion/cargar_materiales", {proc: ""+grupo+ "",mate:""+materiales+""}, function (data_mate) {
                  $('#div_chk').html(data_mate);
              });                         
          }                    

          $('#tercerosM_agendamiento').val(proveedores.split(',')).trigger('change');                   
          
        });

        $('#btn_guardar_proc').css("display", "none");
        $('#btn_actualizar_proc').css("display", "block");
          
        $('#newModal').modal({
            show: true,
            keyboard: false
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

    if(dato == 'proveedoresQx_agendamiento4'){
      var idcasa= $('#proveedoresQx_agendamiento4 option:selected').val();
      $.post("/c_programacion/cargar_email",{idcasa:""+idcasa+""}, function (data_resul) {
          $('#email_casa4').html(data_resul);
      });
    }
    // 
    if(dato =="ck_bloque"){
      var idciruj= $('#cirujano_programacion').val();
      if(ck==true){
        $.post("/c_programacion/cargar_agenda", {idciruj:""+idciruj+""}, function (data_carg) {
            iddia_age = data_carg['agenda_cx'].Dia;
            horaini_age = data_carg['agenda_cx'].Inicio;
            horafin_age = data_carg['agenda_cx'].Final;
        });
        TinyDatePicker('#fechaprogramacionS', {
            format(date) {
                return date.toLocaleDateString('es-CL',{ timeZone: 'UTC' });
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
            var fecha = $('#fechaprogramacionS').val();
            var nfecha = fecha.split("-").reverse().join("-");
            var id_cirj = $('#cirujano_programacion').val();
            
        })
        ;               
      }else{
        
        TinyDatePicker('#fechaprogramacionS', {
            format(date) {
                return date.toLocaleDateString('es-CL',{ timeZone: 'UTC' });
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

    if (dato =='#fechaprogramacionS'){
      var fecha = $('#fechaprogramacionS').val();
      var nfecha = fecha.split("-").reverse().join("-");

      var id_cirujano = $('#cirujano_programacion option:selected').val();
      var nombre_cirujano = $('#cirujano_programacion option:selected').text();

      var calendarEl = document.getElementById('calendar-sala1');
      var date = new Date();
      var m = date.getMonth();
      var y = date.getFullYear();

      var day1 = Math.random() * 20 + 2;
      var day2 = Math.random() * 25 + 1;
      var today = moment(new Date()).format('YYYY-MM-DD');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',

        editable: true,
        selectable: true,
        selectOverlap: false, // Evita la superposición de eventos
        slotDuration: '00:15:00', // Intervalos de 15 minutos
        slotLabelInterval: '00:15:00', // Etiqueta de tiempo cada 15 minutos
        slotMinTime: '06:30:00', // Hora mínima visible (opcional)
        slotMaxTime: '18:30:00', // Hora máxima visible (opcional)
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        locales: "es",
        headerToolbar: {
          
          center: 'title',
          right: 'resourceTimelineDay' //resourceTimelineDay,resourceTimelineThreeDays,timeGridWeek,dayGridMonth
        },

        buttonText: {
          // prev: 'Anterior',
          // next: 'Siguiente',
          // today: 'Hoy'        
        },


        initialView: 'resourceTimeGridDay',
        views: {
          resourceTimelineThreeDays: {
            type: 'resourceTimeGrid',
            duration: { days: 2 },
            buttonText: '2 days'
          }
        },

        resources: [
          { id: '1', title: 'Sala 1', eventColor: 'red' },
          { id: '2', title: 'Sala 2', eventColor: 'green' },
          { id: '3', title: 'Sala 3', eventColor: 'orange' }        
        ],

        events: function(id_cirujano, successCallback, failureCallback) {
            // Parametros personalizados
            let param1 = id_cirujano; // Reemplaza esto por el valor real que necesitas pasar
            let param2 = 'valor2'; // Reemplaza esto por el valor real que necesitas pasar
            
            // Realiza la solicitud a la API de CodeIgniter
            $.ajax({
                url: 'https://ceciminsigca.com/c_agendaqx/cargar_agendaQx',  // Ruta a tu controlador de CodeIgniter
                type: 'POST',
                data: {
                    //start: fetchInfo.startStr, // Fecha de inicio que FullCalendar envía
                   // end: fetchInfo.endStr,     // Fecha de fin que FullCalendar envía
                    param1: param1,            // Parámetro adicional 1
                    param2: param2             // Parámetro adicional 2
                },
                success: function(data) {
                    var events = JSON.parse(data); // Parsear el resultado JSON si es necesario
                    successCallback(events);       // Pasar los eventos al calendario
                },
                error: function() {
                    failureCallback();             // Manejo de errores
                }
            });
        }, 

        // 'https://ceciminsigca.com/c_agendaqx/cargar_agendaQx', 

          // [{ id: '1', resourceId: '1', start: '2024-09-06', end: '2024-09-08', title: 'event 1' },
          // { id: '2', resourceId: '2', start: '2024-09-19T09:00:00', end: '2024-09-19T14:00:00', title: 'event 2' },
          // { id: '3', resourceId: '3', start: '2024-09-19T12:00:00', end: '2024-09-19T06:00:00', title: 'event 3' },
          // { id: '4', resourceId: '1', start: '2024-09-19T07:30:00', end: '2024-09-19T09:30:00', title: 'event 4' },
          // { id: '5', resourceId: '3', start: '2024-09-20T10:00:00', end: '2024-09-20T15:00:00', title: 'event 5' }],
        
       
        select: function(arg) {
          let fechaselect = new Date(arg.startStr);
          if (date > fechaselect) {
            Swal.fire("¡Atención!", 'la fecha seleccionada es menor que la fecha actual', "warning");
          }else{
            let texto = "";
            let ban = 0;

            let fechaStart = moment(arg.startStr).format("YYYY-MM-DD HH:mm");
            let fechaEnd = moment(arg.endStr).format("YYYY-MM-DD HH:mm");
            let fechaIniCx = fechaStart.split(" ");
            let fechaFinCx = fechaEnd.split(" ");

            let fechaICx = fechaIniCx[0];
            let horainiCx = fechaIniCx[1];

            let fechaFCx = fechaFinCx[0];
            let horaFinCx = fechaFinCx[1];

            let idsala = arg.resource.id;
            var sala = '';

            switch (idsala){
            case '1': sala ='Sala 1'
               break;

            case '2': sala ='Sala 2'
               break;

            case '3': sala ='Sala 3'
               break;
            }
            // Swal.fire("¡Atención!", ''+fechaStart+' - '+fechaEnd+' - '+sala+'', "warning");

            $('#idCirujano').val(id_cirujano);
            $('#tiempohoras').inputmask('99:99');
            $("#fechaICx").val(fechaICx);
            $("#horainiCx").val(horainiCx);

            $("#fechaFCx").val(fechaFCx);
            $("#horaFinCx").val(horaFinCx);
            $("#salaQx").val(sala);

            $("#newModalAgenda").modal({
              show: true,
              keyboard: false,
            });
          } 

        // if (moment(date.start).format('YYYY-MM-DD') >= today) {
      
        //  if (date.title !== null && date.title.length > 0) {
        //    calendar.addEvent({
        //       title: title,
        //       start: date.start,
        //       end: date.end,
        //       allDay: true,
        //       classNames: ['text-95', 'bgc-info-d2', 'text-white']
        //    });
        //  }
          
        // }else{
        //  Swal.fire("¡Atención!", "La fecha Seleccionada no esta disponible", "warning");
        // }
        },
        eventClick: function(info) {
          //display a modal
         
          var modal = $(modal).appendTo('body');
          modal.find('form').on('submit', function(ev) {
            ev.preventDefault();

            info.event.setProp('title', $(this).find("input[type=text]").val());

            modal.modal("hide");
          });
          modal.find('button[data-action=delete]').on('click', function() {
            info.event.remove();
            modal.modal("hide");
          });

          modal.modal('show').on('hidden.bs.modal', function() {
            modal.remove();
          });
        }
      });
     
      calendar.setOption('height', 520);
      calendar.render();
    }
  });

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
   

	$('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");
	});


});