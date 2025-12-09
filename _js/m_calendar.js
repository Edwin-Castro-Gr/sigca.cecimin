$(function () {

  if (!window.Intl) {
    console.log(
      "Calendar can't be displayed because your browser doesn's support `Intl`. You may use a polyfill!"
    );
    return;
  }

  //hide/show relevant alert messages according to device
  if ("ontouchstart" in window) {
    $("#alert-1").removeClass("d-none");
    $("#alert-2").addClass("d-none");
  }

  // initialize the external events
  new FullCalendar.Draggable(document.getElementById("external-events"), {
    itemSelector: ".fc-event",
    longPressDelay: 50,
    eventData: function (eventEl) {
      return {
        title: eventEl.innerText,
        classNames: eventEl.getAttribute("data-class").split(" "),
      };
    },
  });

  // change styling options and icons
  FullCalendar.BootstrapTheme.prototype.classes = {
    root: "fc-theme-bootstrap",
    table: "table-bordered table-bordered brc-default-l2 text-secondary-d1 h-95",
    tableCellShaded: "bgc-secondary-l3",
    buttonGroup: "btn-group",
    button: "btn btn-white btn-h-lighter-blue btn-a-blue",
    buttonActive: "active",
    popover: "card card-primary",
    popoverHeader: "card-header",
    popoverContent: "card-body",
  };
  FullCalendar.BootstrapTheme.prototype.baseIconClass = "fa";
  FullCalendar.BootstrapTheme.prototype.iconClasses = {
    close: "fa-times",
    prev: "fa-chevron-left",
    next: "fa-chevron-right",
    prevYear: "fa-angle-double-left",
    nextYear: "fa-angle-double-right",
  };
  FullCalendar.BootstrapTheme.prototype.iconOverrideOption = "FontAwesome";
  FullCalendar.BootstrapTheme.prototype.iconOverrideCustomButtonOption =
    "FontAwesome";
  FullCalendar.BootstrapTheme.prototype.iconOverridePrefix = "fa-";

  //for some random events to be added
  let date = new Date();
  let m = date.getMonth();
  let y = date.getFullYear();

  let day1 = Math.random() * 20 + 2;
  let day2 = Math.random() * 25 + 1;

  let today = moment(new Date()).format("YYYY-MM-DD");

  // initialize the calendar
  var calendar = new FullCalendar.Calendar(

    document.getElementById("calendar"), {

      locale: "es",
      selectable: true,
      editable: true,
      droppable: true,
      selectLongPressDelay: 200,

      themeSystem: "bootstrap",

      headerToolbar: {
        start: "prev,next today",
        center: "title",
        end: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
      },

      buttonText: {
        prev: "Anterior",
        next: "Siguiente",
        today: "Hoy",
        month: "Mes",
        week: "Semana",
        day: "Día",
        listWeek: "Lista",
      },


       eventResize: function (info, event, revertFunc) {
        const datos = info.event.title.split('/');
        
        let fechaStart = moment(info.event.start).format("YYYY-MM-DD");
        let fechaEnd = moment(info.event.end).format("YYYY-MM-DD");

        var id = datos[0];
        var name = datos[1];
        var rest ='';
        // alert(
        //   "El Id del Mantenimiento es: " +id+ " y El Mantenimietno es:"+ name + "" +
        //   fechaStart + " Fecha de Inicio " +
        //   fechaEnd  + " Fecha Final."
        // );
        
        if (!confirm("Acepta los cambios a reaizar")) {
          revertFunc();
        }else{
          $.post('/m_calendario/eventResize', {id: ""+id+"",fecha_inicio: ""+fechaStart+"",fecha_final: ""+fechaEnd+""}, function (data) {
          rest = data;         
          });
          if(rest >= 1) {
            Swal.fire({
              title: "¡Correcto!",
              text: "Registro Actualizado correctamente!",
              icon: "success"
            })
            .then((willDelete) => {
              window.open('m_calendario/index','_parent');
            });
          } else {
              Swal.fire("¡Error!", rest, "error");
          }
        }
      },

      events: 'https://ceciminsigca.com/m_calendario/cargar_mantenimientos',

      select: function (date) {
        let texto = "";
        let ban = 0;

        let fechaStart = moment(date.start).format("YYYY-MM-DD");
        let fechaEnd = moment(date.end).format("YYYY-MM-DD");

        if (moment(date.start).format("YYYY-MM-DD") >= today) {
          $("#rservicio").select2({
            placeholder: "Seleccione el servicio que requiere...",
            width: "100%",
            multiple: "multiple",
            allowClear: true,
          });

          $.post('/m_solicitud/cargar_serviciosr', {}, function (data) {
            $('#rservicio').html(data);
            $("#rservicio").change();
          });

          $.post('/m_solicitud/cargar_servicios', {}, function (data1) {
            $('#servicio').html(data1);
            $("#servicio").change();
          });

          $("#fechaMInicial").val(fechaStart).change();
          $("#fechaMfin").val(fechaEnd).change();

          $("#rservicio").val("");
          $("#rservicio").trigger("change");

          $("#div_otro").css("display", "none");

          $("#div_estado").css("display", "none");

          $('#btn_guardar').css("display", "block");
          $("#btn_actualizar").css("display", "none");

          $("#newModal").modal({
            show: true,
            keyboard: false,
          });

          $("#btn_guardar").on("click", function (event) {
            $("#title").val($("#servicio option:selected").text());

            let txttitle = $("#title").val();

            if ($("#rservicio").val() == "" || $("#rservicio").length == 0) {
              $("#rservicio").addClass("brc-danger");
              texto = texto + "* El Campo Servicios requerido es obligatorio!";
              ban = 1;
            }

            if ($("#rservicio").val() == "16" && $("#otro").val() == "") {
              $("#otro").addClass("brc-danger");
              texto = texto + "* El Campo Otro es obligatorio!";
              ban = 1;
            }

            if ($("#servicio").val() == "") {
              $("#servicio").addClass("brc-danger");
              texto = texto + "* El Campo Servicios es obligatorio!";
              ban = 1;
            }

            if ($("#coordinador_jefeinm").val() == "") {
              $("#coordinador_jefeinm").addClass("brc-danger");
              texto = texto + "* El Campo Solicitante es obligatorio!";
              ban = 1;
            }

            if (ban == 1) {
              Swal.fire("¡Atención!", texto, "warning");
              return false;
            } else {
              Swal.fire({
                title: "¡Atención!",
                text: "Guardando Información...!",
                icon: "warning",
                showConfirmButton: false,
              });

              let formData = new FormData(
                document.getElementById("form_guardar")
              );

              $.ajax({
                url: "/m_calendario/guardar_programacion",
                type: "POST",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              }).done(function (res) {
                if (res >= 1) {
                  Swal.fire({
                    title: "¡Correcto!",
                    text: "Registro Ingresado correctamente!",
                    icon: "success",
                  }).then((willDelete) => {
                    calendar.addEvent({
                      title: txttitle,
                      start: date.start,
                      end: date.end,
                      allDay: true,
                      classNames: ["text-95", "bgc-info-d2", "text-white"],
                    });
                    $("#form_guardar")[0].reset();
                    $("#newModal").modal("hide");

                  });
                } else {
                  Swal.fire("¡Error!", res, "error");
                }
              });
              return false;
            }
          });
        } else {
          Swal.fire(
            "¡Atención!",
            "La fecha Seleccionada no esta disponible",
            "warning"
          );
        }
      },


      drop: function (info) {
        // is the "remove after drop" checkbox checked?
        if (document.getElementById("drop-remove").checked) {
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      },

      eventClick: function (info) {
        //display a modal
        const datos = info.event.title.split('/');
         
        let fechaStart = moment(info.event.start).format("YYYY-MM-DD");
        let fechaEnd = moment(info.event.end).format("YYYY-MM-DD");

        var id = info.event.id;

        $.post('/m_solicitud/cargar_servicios', {}, function (data1) {
          $('#servicio').html(data1);
          
        });

        $('#idregistro').val(id);
        $('#newModalLabel').html('Modificar Mantenimiento');

        $.post("/m_calendario/modificar", {
          idreg: "" + id + ""
        }, function (data_preg) {

          var id_mant = data_preg['mantenimiento'].Id_Mantenimiento
          if (id_mant == "16") {
            $("#div_otro").css("display", "flex");
            $("#otroM").val(data_preg['mantenimiento'].Otro);
            $('#otroM').prop("readonly", true);
          } else {
            $("#div_otro").css("display", "none");
          }
          $('#rservicio').val(data_preg['mantenimiento'].Mantenimiento);;
        
          $('#servicio').val(data_preg['mantenimiento'].Id_Servicio).trigger('change');
          $('#coordinador_jefeinm').val(data_preg['mantenimiento'].Id_Solicitante).change();
          $('#observaciones').val(data_preg['mantenimiento'].Observaciones);
          $('#ubicacion').val(data_preg['mantenimiento'].Ubicacion);
          $('#fechaMInicial').val(fechaStart);
          $('#fechaMfin').val(fechaStart);
          $('#correoSolicitante').val(data_preg['mantenimiento'].Correo_Solicitante);

          $('#tipo_mantenimiento').val(data_preg['mantenimiento'].Tipo_Mantenimiento);
          $('#tipo_mantenimiento').change();
          
          $('#estado').val(data_preg['mantenimiento'].Estado);
          $('#estado').change();
        });
        $('#rservicio').prop("readonly", true);
        $('#servicio').attr("readonly", true);
        $('#coordinador_jefeinm').attr("readonly", true);
        $('#observaciones').prop("readonly", true);
        $('#ubicacion').prop("readonly", true);
        $('#correoSolicitante').attr("readonly", true);
        $('#tipo_mantenimiento').attr("readonly", true);

        $('#btn_guardar').css("display", "none");
        $('#btn_actualizar').css("display", "none");
        $('#estado').attr("readonly", true);
        $('#newModal').modal({
          show: true,
          keyboard: false
        });
      },
    }
  );

  calendar.render();

  //cargar_listado();

  function cargar_listado() {
    Swal.fire({
      title: "Por favor espere!",
      text: "Cargando lista de Cirugias.",
      showConfirmButton: false,
    });

    $.post("/cc_cirugias/listar_tabla", {}, function (data_carg) {
      //alert(data_carg);
      $("#simple-table").DataTable().destroy();
      $("#simple-table").empty();
      $("#simple-table").append(data_carg);
      $("#simple-table").DataTable({
        language: {
          lengthMenu: "Mostrar _MENU_ registros por pagina",
          zeroRecords: "No se encontraron resultados en su busqueda",
          searchPlaceholder: "Buscar registros",
          info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
          infoEmpty: "No existen registros",
          infoFiltered: "(filtrado de _MAX_ registros)",
          search: "Buscar:",
          paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior",
          },
        },
        responsive: true,
      });
      $('[data-toggle="tooltip"]').tooltip();
      Swal.close();
    });
  }
  $('#btn_programar').click(function () {
    alert('entro');
    consulta();
    return false;
  });

  $("#rservicio").on("change", function (event) {
    event.preventDefault();

    if ($("#rservicio option:selected").val() == "16") {
      $("#div_otro").css("display", "flex");

    } else {
      $("#div_otro").css("display", "none");
    }
  });

  $("#servicio").on("change", function (event) {
    event.preventDefault();
    $("#nombreservicio").val($("#servicio").text());
  });

  $(
    "input[type=text], input[type=email], input[type=password], select, select2, input[type=number]"
  ).on("change", function (event) {
    $("#" + event.target.id).removeClass("brc-danger");
  });
});