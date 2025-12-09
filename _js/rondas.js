$(function () {

  let swich = 0;
  var fechaIni ="";
  var fechaFin ="";
  var fechaIniI ="";
  var fechaFinI ="";
  var fechaIniII ="";
  var fechaFinII ="";
 

  if ($('#opc_pag').val() == "administracion") {
    cargar_listado();

    function cargar_listado() {
      Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de Rondas.",
        showConfirmButton: false
      });

      $.post("/r_gestion/listar_rondas", {}, function (data_carg) {
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
              "last": "Ãšltimo",
              "next": "Siguiente",
              "previous": "Anterior"
            },
          },
          responsive: true
        });
        Swal.close();
        $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
          });

      });
    }
  }

  if ($('#opc_pag').val() == "gestion") {
    cargar_rondas();

    function cargar_rondas() {
      Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de Rondas de Seguridad.",
        showConfirmButton: false
      });

      $.post("/r_gestion/cargar_rondas", {}, function (data_carg) {

        $('#content_body').empty();

        $('#content_body').html(data_carg);
        Swal.close();
      });
    }
  }

  if ($('#opc_pag').val() == "ejecucion") {

    var stepCount = $('#smartwizard-1').find('li > a').length
    var left = (100 / (stepCount * 2))
    // for example if we have **4** steps, `left` and `right` of progressbar should be **12.5%**
    // so that before first step and after last step we don't have any lines
    $('#smartwizard-1').find('.wizard-progressbar').css({
      left: left + '%',
      right: left + '%'
    })

    var selectedStep = 0
    var count = 1;
    var stip = 0;
    $('#smartwizard-1').smartWizard({
        theme: 'circles',
        useURLhash: false,
        showStepURLhash: false,
        autoAdjustHeight: true,
        transitionSpeed: 150,

        //errorSteps: [0,1],
        //disabledSteps: [2,3],

        selected: selectedStep,

        toolbarSettings: {
          toolbarPosition: 'bottom', // none, top, bottom, both
          toolbarButtonPosition: 'right', // left, right
          showNextButton: false, // show/hide a Next button
          showPreviousButton: false, // show/hide a Previous button
          toolbarExtraButtons: [
            $('<button class="btn btn-outline-secondary sw-btn-prev radius-l-1 mr-2px"><i class="fa fa-arrow-left mr-15"></i> Anterior</button>').on('click', function () {
              eliminar_respuesta();
            }),

            $('<button class="btn btn-outline-primary sw-btn-next sw-btn-hide radius-r-1">Siguiente <i class="fa fa-arrow-right mr-15"></i></button>')
            .on('click', function () {
              //Save Action
              //$('#form_temp').val()
              $('#id_servicio').val($('#servicio option:selected').val());
              if ($('#servicio option:selected').val() != '') {
                guardar_datos_temp(count);
              } else {
                Swal.fire("¡Error!", 'Por favor Ingrese el Servicio y/o la Ubicación.', "error");
              }
              //alert(count);
            }),

            $('<button class="btn btn-green sw-btn-finish radius-r-1">Guardar <i class="fa fa-check mr-15"></i></button>')
            .on('click', function () {
              // alert(count);
              if ($('#id_servicio').val() != '') {
                guardar_datos_gestion(count);
              } else {
                Swal.fire("¡Error!", 'Por favor Ingrese el Servicio y/o la Ubicación.', "error");
              }
            }),
            $('<button class="btn btn-danger ml-2 radius-r-1 radius-l-1" id="btnCancel" >Salir <i class="fa fa-times mr-15" id="btnCancel"></i></button>`')
            .on('click', function () {
              //Finish Action
              Swal.fire({
                title: "Desea terminar la lista de chequeo?",
                text: "Se perderan todos los datos al salir.",
                icon: "warning",
                showCancelButton: true,
                scrollbarPadding: false,
                confirmButtonText: 'Si, Salir!',
                cancelButtonText: 'No, cancelar!',
                cancelButtonColor: '#d33',
                reverseButtons: false,
                customClass: {
                  'confirmButton': 'btn btn-green mx-2 px-3',
                  'cancelButton': 'btn btn-red mx-2 px-3'
                }
              }).then(function (result) {
                if (result.value) {

                 window.open('/r_gestion/index', '_parent');
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                  Swal.DismissReason.cancel;
                }
              });
            }),
          ]
        }
      })

      .removeClass('d-none') // initially it is hidden, and we show it after it is properly rendered

      .on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
        // move the progress bar by increasing its size (width)
        var progress = parseInt((stepNumber + 1) * 100 / stepCount)
        var halfStepWidth = parseInt(100 / stepCount) / 2
        count = stepNumber + 1
        progress -= halfStepWidth //because for example for the first step, we don't want progressbar to move all the way to next step

        $('#smartwizard-1').find('.wizard-progressbar').css('max-width', progress + '%')

        if (stepNumber > 0) {
          $('#wizard-1-prev').removeAttr('disabled')
        } else {
          $('#wizard-1-prev').attr('disabled', '')
        }

        // if we are in the last step, next button should be hidden, and finish button shown instead
        if (stepNumber == stepCount - 1) {
          $('#wizard-1-next').addClass('d-none')
          $('#wizard-1-finish').removeClass('d-none')
        } else {
          $('#wizard-1-next').removeClass('d-none')
          $('#wizard-1-finish').addClass('d-none')
        }
      })
      .on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
        if (stepNumber == 0 && stepDirection == 'forward') {
          // use jQuery plugin to validate
          if ($('#id_servicio').val() == '')
            return false;
        }
      })
      .triggerHandler('showStep', [null, selectedStep, null, null]) // move progressbar to step 1 (0 index)
  }

  if ($('#opc_pag').val() == "informes") {

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

  TinyDatePicker('#fechaStartI', {            
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
      var sfechaIni = $('#fechaStartI').val();
      var nfechaIni = sfechaIni.split("-").reverse().join("-");    
      
      $('#val_fechainiI').val(nfechaIni);
      fechaIniI = $("#val_fechainiI").val();
      // alert(nfechaIni);      
  });

  TinyDatePicker('#fechaEndI', {            
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

      var sfechaFin = $('#fechaEndI').val();
      var nfechaFin = sfechaFin.split("-").reverse().join("-");;
      
      $('#val_fechafinI').val(nfechaFin);
      fechaFinI = $("#val_fechafinI").val();
      // alert(nfechaFin);
      
  });

  TinyDatePicker('#fechaStartII', {            
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
      var sfechaIniII = $('#fechaStartII').val();
      var nfechaIniII = sfechaIniII.split("-").reverse().join("-");    
      
      $('#val_fechainiII').val(nfechaIniII);
      fechaIniII = $("#val_fechainiII").val();
          
  });

  TinyDatePicker('#fechaEndII', {            
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

    var sfechaFinII = $('#fechaEndII').val();
    var nfechaFinII = sfechaFinII.split("-").reverse().join("-");;
    
    $('#val_fechafinIII').val(nfechaFinII);
    fechaFinII = $("#val_fechafinIII").val();
    //alert($('#val_fechafinIII').val());
      
  });
    
    var con = 0;

    $.post("/r_gestion/cargar_informes", {      
      desde: "" + fechaIni + "",
      hasta: "" + fechaFin + "",
      con: "" + con + ""
    }, function (data_preg) {
      cargar_informes(data_preg);
    });
  }

  function cargar_informes(data_carg) {
    Swal.fire({
      title: "Por favor espere!",
      text: "Cargando lista de Informes.",
      showConfirmButton: false
    });

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
          "last": "Ãšltimo",
          "next": "Siguiente",
          "previous": "Anterior"
        },
      },
      responsive: true
    });
    Swal.close();
    $('[data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
      });

    $('.id').hide();
    $('.id_servicio').hide();

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
            //});
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

    if (datos[0] == "btneditar") {
      idreg = datos[1];     

      $.post("/r_gestion/modificar", {idreg:""+idreg+""}, function (data_form) {
        $('#idregistro').val(data_form['rondas'].ronda);
        $('#nombre').val(data_form['rondas'].nombre);
        $('#codigo').val(data_form['rondas'].codigo);
        $('#procesos_rondas').val(data_form['rondas'].proceso);
        $('#empleados_rondas').val(data_form['rondas'].responsable);
        $('#periocidad').val(data_form['rondas'].periocidad);
        $('#veces').val(data_form['rondas'].veces);
      });      

      $.post("/r_gestion/cargar_secciones", {id_ronda:""+idreg+""}, function (data_form) {

        $('#accordionsecciones').html(data_form);

      });   
      $('#newModalLabel').html('Modificar Ronda');
      $('#btn_guardar').css("display", "none");
      $('#btn_actualizar').css("display", "block");
      $('#div_estado').css("display", "none");
      $("#form_guardar")[0].reset();


     
      $('#newModal').modal({
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

    if (datos[0] == "btnronda") {
      id_ronda = datos[1];

      window.open('/r_gestion/gestion/' + id_ronda, '_parent');
    }

    if (datos[0] == "btngrafica") {
      
      $('#ModalGrafica').modal('hide');
        var id = datos[1];
      var nombre_ronda = '';
      var ubicacion = '';
      var servicio = '';
      var cumple = '';
      var noCumple = '';

      $.post("/r_gestion/datos_grafica", {
        idreg: "" + id + ""
      }, function (data_preg) {
        
        nombre_ronda = data_preg['datosGrafica'].ronda;
        ubicacion = data_preg['datosGrafica'].ubicacion;
        servicio = data_preg['datosGrafica'].servicio;
        cumple = parseInt(data_preg['datosGrafica'].cumple);
        noCumple = parseInt(data_preg['datosGrafica'].noCumple);

        $('#titleRonda').val(nombre_ronda);

        google.charts.load("current", {
          packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Cumple',  cumple ],
            ['No Cumple', noCumple ]
          ]);

          var options = {
            title: '' + nombre_ronda + '',
            is3D: true,
            width: 600,
            height: 300,
            // chartArea: {
            //   left: 10,
            //   top: 0,
            // }

          };

          var chart = new google.visualization.PieChart(document.getElementById('grafica'));
          chart.draw(data, options);
        }
      });

      // END Script Graficas //

      var ban = 1;
      var id_ronda = '';
      var id_servicio = '';
      var fecha = '';

      $.post("/r_gestion/cargar_adherencia", {
        id_gestion: "" + id + "",
        id_rondas: "" + id_ronda + "",
        id_servicio: "" + id_servicio + "",
        fecha: "" + fecha + "",
        ban: 0
      }, function (data_preg) {
        $('#AccordionII').html(data_preg);
      });
      Swal.close();
      $('[data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
      });

      $('#ModalGrafica').modal({
        show: true,
        keyboard: false,
      });
    }

    if (dato == "btn_guardar") {
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
          text: "Guadando la informaciÃ³n.",
          showConfirmButton: false
        });
        var datos_form = $("#form_guardar").serialize();
        $.post("/r_gestion/guardar", datos_form, function (data_form) {
          Swal.close();
          if (data_form == "1") {
            //jQuery(function(){
            Swal.fire({
                title: "Â¡Correcto!",
                text: "Registro ingresado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                $("#form_guardar")[0].reset();
                cargar_listado();
              });
            //});
          } else {
            Swal.fire("Â¡Error!", data_form, "error");
          }
        });
        return false;
      }
      return false;
    }

    if (dato == "btn_nueva_ronda") {
      $('#newModalLabel').html('Nueva Ronda');
      $('#btn_guardar').css("display", "block");
      $('#btn_actualizar').css("display", "none");
      $('#div_estado').css("display", "none");
      $("#form_guardar")[0].reset();
    }

    if (dato == "btn_seccion") {
      window.open('/r_secciones/index', '_parent');
    }


    if (dato == "btn_preguntas") {
      window.open('/r_preguntas/index', '_parent');
    }
    
    if (dato == "btn_actualizar") {
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
        Swal.fire("Â¡AtenciÃ³n!", texto, "warning");
      } else {
        //alert("Datos: "+datos_form);
        Swal.fire({
          title: "Por favor espere!",
          text: "Actualizando la informaciÃ³n.",
          showConfirmButton: false
        });
        var datos_form = $("#form_guardar").serialize();
        $.post("/r_gestion/actualizar", datos_form, function (data_form) {
          Swal.close();
          if (data_form == "1") {
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
            Swal.fire("Â¡Error!", data_form, "error");
          }
        });
        return false;
      }
      return false;
    }

    if (dato == "btn_consultar") {

      var texto = "";      
      var ban = 0;
      var con = 1;


      if (fechaIni == "0" ){       
       $('#val_fechaini').addClass("brc-danger");
        texto = texto + "* Fecha inicio es obligatorio!<br>";
        ban = 1;
      }

      if (fechaFin == "0" ){       
       $('#val_fechafin').addClass("brc-danger");
        texto = texto + "* Fecha final es obligatorio!<br>";
        ban = 1;
      }

      if (fechaIni > fechaFin){
        $('#val_fechaini').addClass("brc-danger");
        $('#val_fechafin').addClass("brc-danger");
        $('#fechaStart').val("");
        $('#fechaEnd').val("");
        texto = texto + "* La fecha inicio no puede ser mayor !<br>";
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

      $.post("/r_gestion/cargar_informes", {      
        desde: "" + fechaIni + "",
        hasta: "" + fechaFin + "",
        con: "" + con + ""
        }, function (data_preg) {
          cargar_informes(data_preg);
        });
      }
    }

    if (dato == "btn_consultarII") {

      var texto = "";      
      var ban = 0;
      var conI = 1;

      var id_ronda = $('#rondas_informesII').val();
      
      var id_servicio = $('#servicioII').val();

      if ($('#fechaStartI').val() == "0" || $('#fechaStartI').val() == null ){       
       $('#fechaStartI').addClass("brc-danger");
        texto = texto + "* Fecha inicio es obligatorio!<br>";
        ban = 1;
      }

      if ($('#fechaEndI').val() == "" || $('#fechaEndI').val() == null){       
       $('#fechaEndI').addClass("brc-danger");
        texto = texto + "* Fecha final es obligatorio!<br>";
        ban = 1;
      }

      if (fechaIniI > fechaFinI){
        $('#fechaStartI').addClass("brc-danger");
        $('#fechaEndI').addClass("brc-danger");
        $('#fechaStartI').val("");
        $('#fechaEndI').val("");
        texto = texto + "* La fecha inicio no puede ser mayor !<br>";
        ban = 1;
      }

      if (id_ronda == "" || id_ronda == null) {
        $('#rondas_informesII').addClass("brc-danger");
        texto = texto + "* La Ronda es obligatoria!<br>";
        ban = 1;
      }

       if (id_servicio == "" || id_servicio == null) {
        $('#servicioII').addClass("brc-danger");
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

        $.post("/r_gestion/cargar_adherencia", {
          id_ronda: "" + id_ronda + "",
          id_servicio: "" + id_servicio + "",
          fechaIniI: "" + fechaIniI + "",
          fechaFinI: "" + fechaFinI + "",
          ban: "1",
          beetfecha: ""+conI+""

        }, function (data_preg) {
          $('#Accordion').html(data_preg);
        });
        Swal.close();
        $('[data-toggle="tooltip"]').tooltip({
          template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
        });

      }
    }


    if (dato == "btn_consultarIII") {

      var texto = "";      
      var ban = 0;
      var conI = 1;

      var id_ronda = $('#rondas_informesIII').val();
      
      var id_servicio = $('#servicioIII').val();      

      
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

        $.post("/r_gestion/cargar_inf_nocumple", {
          id_ronda: "" + id_ronda + "",
          id_servicio: "" + id_servicio + "",
          fechaIniI: "" + fechaIniII + "",
          fechaFinI: "" + fechaFinII + "",
          
          
        }, function (data_preg) {

          $('#AccordionIII').html(data_preg);
        });
        Swal.close();
        $('#nocumplimiento-table').DataTable({
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
                "last": "Ãšltimo",
                "next": "Siguiente",
                "previous": "Anterior"
              },
            },
            responsive: true
          });        
          $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
          });
      }
    }

    if (dato == "next-btn") {
      // let preguntas = $("#preguntas_" + stip + "").val().split(',');
      // let total_preg = preguntas.length;
      // // var ronda_seccion = $('#seccion').val().split(',');

      // if ($("#respuesta_" + preguntas[total_preg] + "").val() != "") {

      //   if (stip == $("#num_seccion_" + stip + "").val()) {
      //     let num = $("#num_seccion_" + stip + "").val();
      //     if ($('#servicio option:selected').val() != '' && ('#ubicacion').val() != '')
      //       guardar_datos_temp(num);
      //     else
      //       Swal.fire("Â¡Error!", 'Por favor Ingrese el Servicio y/o la UbicaciÃ³n.', "error");
      //   }
      // }
      // alert($("#num_seccion_" + stip + "").val());
    }

    if (dato == "prev-btn") {
      // let ronda = $('#id_ronda').val();
      // let seccion = $('#seccion').val().split(',');
      // if (stip == $("#num_seccion_" + stip + "").val()) {
      //   $.post("/r_gestion/eliminar_respuesta", {
      //     ronda: "" + ronda + "",
      //     seccion: "" + seccion + ""
      //   }, function (data_preg) {

      //   });
      //   return false;
      // }
    }
    // if (dato == "btnCancel") {
    //   Swal.fire({
    //     title: "Desea terminar la lista de chequeo?",
    //     text: "Se perderan todos los datos al salir.",
    //     icon: "warning",
    //     showCancelButton: true,
    //     scrollbarPadding: false,
    //     confirmButtonText: 'Si, Salir!',
    //     cancelButtonText: 'No, cancelar!',
    //     cancelButtonColor: '#d33',
    //     reverseButtons: false,
    //     customClass: {
    //       'confirmButton': 'btn btn-green mx-2 px-3',
    //       'cancelButton': 'btn btn-red mx-2 px-3'
    //     }
    //   }).then(function (result) {
    //     if (result.value) {
    //       if ($('#id_servicio').val() != "") {
    //         $.post("/r_gestion/eliminar_respuesta", {
    //           ronda: "" + $('#ronda').val() + "",
    //           servicio: "" + $('#id_servicio').val() + ""
    //         }, function (data_form) {
    //           //alert(data_form);
    //           if (data_form == "1") {
    //             $('#smartwizard-1').smartWizard("reset");
    //             window.open('/r_gestion/gestion/index', '_parent');
    //           } else {
    //             Swal.fire("¡Error!", "Se presento el siguiente error: " + data_form, "error");
    //           }
    //         });
    //       }
    //     } else if (result.dismiss === Swal.DismissReason.cancel) {
    //       Swal.DismissReason.cancel;
    //     }
    //   });
    // }
  });

  function guardar_datos_temp(form) {

    var formData = new FormData($('#form-' + form)[0]);
    formData.append('id_servicio', $('#servicio option:selected').val());
    formData.append('ubicacion', $('#ubicacion').val());
    formData.append('id_ronda', $('#idronda').val());

    $.ajax({
      type: "POST",
      //dataType: 'json',
      processData: false,
      contentType: false,
      cache: false,
      url: "/r_gestion/guardar_temp1",
      data: formData,
      success: function (msg) {
        Swal.close();
        if (msg >= 1) {
          Swal.fire({
            title: "¡Correcto!",
            text: "Registro ingresado correctamente!",
            type: "success",
            onClose: () => {
              //funcion de ok
            }
          });
        }
      },
      error: function (msg) {
        //Swal.fire("Â¡Error!", msg, "error");
      }
    });
    return false;
  }

  function guardar_datos_gestion(form) {
    var formData = new FormData($('#form-' + form)[0]);
    formData.append('id_ronda', $('#idronda').val());
    formData.append('ubicacion', $('#ubicacion').val());

    Swal.close();
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false
    });

    $.ajax({
      url: "/r_gestion/guardar_gestion1",
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
            window.open('/r_gestion/index', '_parent');
          });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }

  function eliminar_respuesta(){

    let ronda = $('#idronda').val();
    let servicio = $('#servicio').val();
    // alert(ronda+ - +servicio);
    
    $.post("/r_gestion/eliminar_respuesta", {
      id_ronda: "" + ronda + "",
      id_servicio: "" + servicio + ""
    }, function (data_preg) {

    });
    return false;
  }

  $(document).on("change", function (event) {
    let datos = event.target.id.split("_");
    var dato = event.target.id;
    let ck = event.target.checked;



    // if (dato == "servicioII") {
    //   var ban = 0;
    //   if ($("#mes_consultaII").val() == "") {
    //     $('#mes_consultaII').addClass("brc-danger");
    //     texto = texto + "* Debes seleccionar el mes a consultar!<br>";
    //     ban = 1;
    //   }

    //   if ($("#rondas_informesII").val() == "") {
    //     $('#rondas_informesII').addClass("brc-danger");
    //     texto = texto + "* Debes seleccionar la Ronda a consultar!<br>";
    //     ban = 1;
    //   }
    //   if (ban == 1) {
    //     Swal.fire("¡Atención!", texto, "warning");
    //   } else {
    //     if ($('#servicioII option select').val() != "") {

    //       const yearMonth = $("#mes_consultaII").val().split("-");
    //       let year = yearMonth[0];
    //       let month = yearMonth[1];
    //       mesfechacons = month;
    //       yearfechacons = year
    //       id_ronda = $('#rondas_informesII').val();
    //       id_servicio = $('#servicioII').val();
    //       ban = 1;

    //       $.post("/r_gestion/cargar_adherencia", {
    //         id_ronda: "" + id_ronda + "",
    //         id_servicio: "" + id_servicio + "",
    //         mesfechacons: "" + mesfechacons + "",
    //         yearfechacons: "" + yearfechacons + "",
    //         ban: "1"
    //       }, function (data_preg) {
    //         $('#Accordion').html(data_preg);
    //       });
    //     }
    //   }
    // }
  });

  $('.ace-file-input').aceFileInput({

    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Cargar',
    placeholderText: 'No ha Cargdo in Archivo',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'

  })

  $('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function (event) {
    $('#' + event.target.id).removeClass("brc-danger");
  });
  return false;
});