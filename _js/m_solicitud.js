$(function () {

  var tcont = 0;
  if ($("#opc_pag").val() == "ingreso") {
    let ban = 0;

    $("#div_otro").css("display", "none");

    $("#coordinador_jefeinm").select2({
      placeholder: 'Seleccione un Coordinador...',
      width: "100%",
      allowClear: true

    });
    $("#serviciomto_solicitud").select2({
      placeholder: 'Seleccione una opción...',
      width: "100%",
      allowClear: true

    });

    $.post('/m_solicitud/cargar_servicios', {}, function (data1) {
      $('#servicio').html(data1);
      $("#servicio").change();
    });

    $("#btn_guardar").click(function () {
      let ban = 0;
      let texto = "";

      if ($("#nombre").val() == "") {
        $("#nombre").addClass("brc-danger");
        texto = texto + "* El nombre del documento es obligatorio !<br>";
        ban = 1;
      }

      if ($("#justificacion").val() == "") {
        $("#justificacion").addClass("brc-danger");
        texto = texto + "* La justificacion son obligatoria!<br>";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_registro();
        return false;
      }
    });
  } else if ($("#opc_pag").val() == "revision") {
    let ban = 0;
    // alert($('#idreg').val());
    $.post(
      "/m_solicitud/cargar_qrevisa", {
      idreg: $("#idreg").val()
    },
      function (data_preg) {
        // alert(data_preg);
        $("#quienRevisa").html(data_preg);
      }
    );

    $.post(
      "/m_solicitud/cargar_observaciones", {
      idreg: $("#idreg").val()
    },
      function (data_preg) {
        // alert(data_preg);
        $("#accordioobservacion").html(data_preg);
      }
    );

    $("#btn_guardar_revision").click(function () {
      let ban = 0;
      let texto = "";

      if ($("#nombre").val() == "") {
        $("#nombre").addClass("brc-danger");
        texto = texto + "* El nombre del documento es obligatorio !<br>";
        ban = 1;
      }

      if ($("#observaciones").val() == "") {
        $("#observaciones").addClass("brc-danger");
        texto = texto + "* Las observaciones son obligatorias!<br>";
        ban = 1;
      }
      if ($("#estado").val() == "") {
        $("#estado").addClass("brc-danger");
        texto = texto + "* Debe seleccionar un estado!";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_revision();
        return false;
      }
    });
  } else if ($("#opc_pag").val() == "listado") {
    cargar_listado();

    function cargar_listado() {
      Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de solicitudes.",
        showConfirmButton: false,
      });

      $.post("/m_solicitud/listar_tabla", {}, function (data_carg) {
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
  } else if ($("#opc_pag").val() == "gestionar") {
    let ban = 0;

    $("#coordinador_jefeinm").select2();
    $("#coordinador_jefeinm").trigger("change");

    $.post('/m_solicitud/cargar_serviciosr', {}, function (data) {
      $('#rservicio').html(data);
      $("#rservicio").change();
    });

    $.post('/m_solicitud/cargar_servicios', {}, function (data1) {
      $('#servicio').html(data1);
      $("#servicio").change();
    });
    $('#rservicio').prop("readonly", true);
    $('#coordinador').prop("readonly", true);
    $('#otroM').prop("readonly", true);
    $('#nombreservicio').prop("readonly", true);
    $('#ubicacion').prop("readonly", true);
    $('#observaciones').prop("readonly", true);
    $("#btn_programar").click(function () {
      let ban = 0;
      let texto = "";
      if ($("#fechaM").val() == "") {
        $("#fechaM").addClass("brc-danger");
        texto = texto + "*La fecha programación no puede estar vacia !<br>";
        ban = 1;
      }

      if ($("#observacionesM").val() == "") {
        $("#observacionesM").addClass("brc-danger");
        texto = texto + "* Las observaciones son obligatorias!<br>";
        ban = 1;
      }

      if ($("#estadoactual").val() != 0) {
        $("#estado").addClass("brc-danger");
        texto = texto + "*El Estado de la solicitud no permite programar!";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_programacion();
        return false;
      }
    });

    var idreg = $('#idreg').val();
    $.post('/m_solicitud/cargar_anexosM', {idreg: ""+idreg+""}, function (data) {
      $('#containerAnexo').empty();
      $('#containerAnexo').html(data);
      
    });

    // if (datos[0] == "btnverpfd"){
    //     var idreg = dato.substr(10);
    //     var pdfUrl = "https://sigca.cecimin.com.co/"+idreg+"";
    //     // alert(idreg);
    //     if(idreg !=""){
    //       $('#pdfIframe').attr('src', pdfUrl);
              
    //           $('#pdfModal').modal({
    //           show: true,
    //           keyboard: false
    //       });        
    //     }          

    //   }

    $('#btnAgregarNota').click(function () {

      $('#newNota').modal({
        show: true,
        keyboard: false
      });
    });

    $('#btn_registra_nota').click(function () {
      let texto = "";
      var nota = document.getElementById('Nota').value;

      if (nota === "") {
        $("#estado").addClass("brc-danger");
        texto = texto + "El Campo nota Adicional no puede estar vacio!";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {

        tcont++

        const fecha = new Date();
        var fecha_registro = fecha.toLocaleDateString();

        $('#cantNota').val(tcont);

        //alert(nota); 

        var descripcion = nota;
        // alert(nomparticipanteT);

        //crear el tr que contiene los th

        const tr_principal = D.create('tr');

        //crear el td que contiene los input
        const td_numero = D.create('td');
        const td_fecha = D.create('td');
        const td_edescripcion = D.create('td');
        const td_btnAccion = D.create('td');

        //crear los inputs 
        const span_numero = D.create('span', { name: 'numero[]', innerHTML: '' + tcont + '' });
        const input_fecha = D.create('input', { type: 'text', id: 'fechaRegistro' + tcont + '', name: 'fechaRegistro' + tcont + '' });
        const input_descripcion = D.create('textarea', { rows: '2', id: 'descripcionNota' + tcont + '', name: 'descripcionNota' + tcont + '', autocomplete: 'off', placeholder: 'Describa la tarea asignada' });

        const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function () { D.remove(tr_principal); tcont--; } });
        const img_btn = D.create('i', {});
        //agregar clases a los elementos

        input_fecha.classList.add('form-control', 'col-sm-8');
        input_descripcion.classList.add('form-control', 'col-sm-12');

        btn_borrar.classList.add('mx-2px', 'btn', 'radius-1', 'border-2', 'btn-xs', 'btn-brc-tp', 'btn-light-secondary', 'btn-h-lighter-danger', 'btn-a-lighter-danger');
        img_btn.classList.add('fa', 'fa-trash-alt');

        //agregar cada etiqueta a su nodo padre

        D.append(span_numero, td_numero);
        D.append(input_fecha, td_fecha);
        D.append(input_descripcion, td_edescripcion);

        D.append(img_btn, btn_borrar);
        D.append(btn_borrar, td_btnAccion);

        D.append([td_numero, td_fecha, td_edescripcion, td_btnAccion], tr_principal);
        D.append(tr_principal, D.id('pos-nota'));


        $('#fechaRegistro' + tcont + '').val(fecha_registro);
        $('#descripcionNota' + tcont + '').val(descripcion);

        $('#fechaRegistro' + tcont + '').attr("readonly", "readonly");
        $('#descripcionNota' + tcont + '').attr("readonly", "readonly");
        $("#form_guardarNota")[0].reset();
      }
    });

  } else if ($("#opc_pag").val() == "ejecutar") {
    $('#rservicio').prop("disabled", true);
    $('#coordinador').prop("disabled", true);
    $('#nombreservicio').prop("disabled", true);
    $('#otroM').prop("disabled", true);
    $('tipo_mantenimiento').attr("disabled", true);
    $('#ubicacion').prop("disabled", true);
    $('#observaciones').prop("disabled", true);
    $('#observacionesM').prop("disabled", true);
    $('#fechaMInicial').prop("disabled", true);
    $('#fechaMfin').prop("disabled", true);
    $('#prioridad').prop("disabled", true);

    $("#coordinador_jefeinm").select2();
    $("#coordinador_jefeinm").trigger("change");

    $.post('/m_solicitud/cargar_notas', { idreg: "" + $("#idreg").val() + "" }, function (data) {
      $('#notas').html(data);
    });

    $.post('/m_solicitud/cargar_serviciosr', {}, function (data) {
      $('#rservicio').html(data);
      $("#rservicio").change();
    });

    $.post('/m_solicitud/cargar_servicios', {}, function (data1) {
      $('#servicio').html(data1);
      $("#servicio").change();
    });

    $("#btn_Gejecutar").click(function () {
      let ban = 0;
      let texto = "";
      if ($("#fechaEjecucion").val() == "") {
        $("#fechaEjecucion").addClass("brc-danger");
        texto = texto + "*La fecha Ejecución no puede estar vacia !<br>";
        ban = 1;
      }

      if ($("#observacionesE").val() == "") {
        $("#observacionesE").addClass("brc-danger");
        texto = texto + "* Las observaciones son obligatorias!<br>";
        ban = 1;
      }

      if ($("#estadoactual").val() != 1) {
        $("#estado").addClass("brc-danger");
        texto = texto + "*El Estado de la solicitud no permite ejecutar!";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_ejecucion();
        return false;
      }
    });
  } else if ($("#opc_pag").val() == "recibir") {
    $('#rservicio').prop("disabled", true);
    $('#coordinador').prop("disabled", true);
    $('#nombreservicio').prop("disabled", true);
    $('#otroM').prop("disabled", true);
    $('tipo_mantenimiento').attr("disabled", true);
    $('#ubicacion').prop("disabled", true);
    $('#observaciones').prop("disabled", true);
    $('#observacionesM').prop("disabled", true);
    $('#fechaMInicial').prop("disabled", true);
    $('#fechaMfin').prop("disabled", true);
    $('#prioridad').prop("disabled", true);
    $("#fechaEjecucion").prop("disabled", true);
    $("#observacionesE").prop("disabled", true);

    $("#coordinador_jefeinm").select2();
    $("#coordinador_jefeinm").trigger("change");

    $.post('/m_solicitud/cargar_notas', { idreg: "" + $("#idreg").val() + "" }, function (data) {
      $('#notas').html(data);
    });

    $.post('/m_solicitud/cargar_serviciosr', {}, function (data) {
      $('#rservicio').html(data);
      $("#rservicio").change();
    });

    $.post('/m_solicitud/cargar_servicios', {}, function (data1) {
      $('#servicio').html(data1);
      $("#servicio").change();
    });

    $("#btn_Recibir").click(function () {
      let ban = 0;
      let texto = "";
      if ($("#fechaRecibido").val() == "") {
        $("#fechaRecibido").addClass("brc-danger");
        texto = texto + "*La fecha Recibido no puede estar vacia !<br>";
        ban = 1;
      }

      if ($("#observacionesR").val() == "") {
        $("#observacionesR").addClass("brc-danger");
        texto = texto + "* Las observaciones son obligatorias!<br>";
        ban = 1;
      }

      if ($("#estadoactual").val() != 2) {
        $("#estado").addClass("brc-danger");
        texto = texto + "*El Estado de la solicitud no permite ejecutar!";
        ban = 1;
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_recibido();
        return false;
      }
    });
  }
  $(document).on("click", function (event) {
    let datos = event.target.id.split("_"); // [btngestionar, 1]
    let dato = event.target.id;

    if (datos[0] == "btngestionar") {
      idreg = datos[1];
      idusuario = datos[2];
      window.open("/m_solicitud/gestionar/" + idreg, "_parent");

    }

    if (datos[0] == "btnejecutar") {
      idreg = datos[1];
      idusuario = datos[2];
      window.open("/m_solicitud/ejecutar/" + idreg, "_parent");

    }

    if (datos[0] == "btnrecibir") {
      idreg = datos[1];
      idusuario = datos[2];
      window.open("/m_solicitud/recibir/" + idreg, "_parent");

    }

    if (datos[0] == "btninactivar") {
      //jQuery(function(){
      let id_reg = datos[1];
      let nom_reg = $("#nombre_" + id_reg).val();
      Swal.fire({
        title: "Desea Inactivar el Registro: '" + nom_reg + "' ?",
        text: "Podras activarlo en cualquier momento con la edición!",
        icon: "warning",
        showCancelButton: true,
        scrollbarPadding: false,
        confirmButtonText: "Si, Inactivar!",
        cancelButtonText: "No, cancelar!",
        cancelButtonColor: "#d33",
        reverseButtons: false,
        customClass: {
          confirmButton: "btn btn-green mx-2 px-3",
          cancelButton: "btn btn-red mx-2 px-3",
        },
      }).then(function (result) {
        if (result.value) {
          $.post(
            "/m_solicitud/inactivar", {
            idreg: "" + id_reg + "",
          },
            function (data_form) {
              //alert(data_form);
              if (data_form == "1") {
                Swal.fire({
                  title: "Inactivado!",
                  text: "El registro se ha inactivado.",
                  type: "success",
                  icon: "success",
                  customClass: {
                    confirmButton: "btn btn-info px-5",
                  },
                }).then((value) => {
                  cargar_listado();
                });
              } else {
                Swal.fire(
                  "¡Error!",
                  "Se presento el siguiente error: " + data_form,
                  "error"
                );
              }
            }
          );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.DismissReason.cancel;
        }
      });

      return false;
    }

    //  ----------------------------------------------------------------

    // ----------------------------------------------------------------
    if (dato == "btn_pdf") {
      window.open("/m_solicitud/pdf", "_blank");
    }

    if (dato == "btn_excel") {
      window.open("/m_solicitud/excel", "_blank");
    }
  });

  $(document).on("change", function (event) {
    event.preventDefault();
    let datos = event.target.id.split("_");
    let dato = event.target.id;
    let ck = event.target.checked;

    if (dato == 'estado') {
      if ($("#opc_pag").val() == "gestionar") {
        if ($("#estado option:selected").val() != '1') {
          $("#estado").addClass("brc-danger");
          texto = "*El Estado no permitido!";
          Swal.fire("¡Atención!", texto, "warning");
        }
      } else if ($("#opc_pag").val() == "ejecutar") {
        if ($("#estado option:selected").val() != '2') {
          $("#estado").addClass("brc-danger");
          texto = "*El Estado no permitido!";
          Swal.fire("¡Atención!", texto, "warning");
        }
      }
    }

    if (dato == 'serviciomto_solicitud') {
      if ($("#serviciomto_solicitud option:selected").val() == "45") {
        $("#nombreMantemientoR").val("Otro");
        $("#div_otro").css("display", "flex");
      } else {
        $("#div_otro").css("display", "none");
        $("#nombreMantemientoR").val($("#serviciomto_solicitud option:selected").text());
      }
    }

    if (dato == 'servicio') {
      $("#nombreServicio").val($("#servicio option:selected").text());
    }
  });

  function guardar_registro() {
    Swal.close();
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    let formData = new FormData(document.getElementById("form_guardar"));

    $.ajax({
      url: "/m_solicitud/guardar",
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
          window.open("/m_solicitud/index", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }


  function guardar_recibido() {
    Swal.close();
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    let formData = new FormData(document.getElementById("form_guardar_recibido"));

    $.ajax({
      url: "/m_solicitud/guardar_recibir",
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
          window.open("/m_solicitud/index", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }


  function guardar_programacion() {
    Swal.close();
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    let formData = new FormData(document.getElementById("form_programar"));

    $.ajax({
      url: "/m_solicitud/guardar_gestion",
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
          text: "Registro ingresado correctamente!",
          icon: "success",
        }).then((willDelete) => {
          window.open("/m_solicitud/index", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }

  function guardar_ejecucion() {
    Swal.close();
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    let formData = new FormData(document.getElementById("form_ejecutar"));

    $.ajax({
      url: "/m_solicitud/guardar_ejecucion",
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
          text: "Registro ingresado correctamente!",
          icon: "success",
        }).then((willDelete) => {
          window.open("/m_solicitud/index", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }


  $(".UpperCase").on("keypress", function () {
    $input = $(this);
    setTimeout(function () {
      $input.val($input.val().toUpperCase());
    }, 50);
  });

  $('#archivo_evidencia').aceFileInput({
    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo evidencia',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
    allowExt: 'gif|jpg|jpeg|png|webp|svg|pdf',
  });

  $('#archivov').aceFileInput({

    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'Seleccionar',
    placeholderText: 'Seleccione el Archivo evidencia',
    placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
    allowExt: 'pdf|jpg'
  })

  $(
    "input[type=text], input[type=email], input[type=password], select, select2, input[type=number]"
  ).on("change", function (event) {
    $("#" + event.target.id).removeClass("brc-danger");
  });
});