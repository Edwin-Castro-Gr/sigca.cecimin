$(function () {
  // $("#div_otraentidad").css("display", "none");
  // $("#div-fecha").css("display", "none");

  $("#lbOtroCargo").css("display", "none");
  $("#lbOtroServicio").css("display", "none");

  $("#otroCargo").css("display", "none");
  $("#otroServicio").css("display", "none");

  $("#datosMedicamento").removeAttr("required");
  $("#registroSanitario").removeAttr("required");
  $("#loteMedicamento").removeAttr("required");
  $("#fechaVencimiento").removeAttr("required");

  $("#datosdispositivo").removeAttr("required");
  $("#registroSanitarioD").removeAttr("required");
  $("#lotedispositivo").removeAttr("required");
  $("#modelo").removeAttr("required");
  $("#numReferencia").removeAttr("required");
  $("#serial").removeAttr("required");
  $("#fabricante").removeAttr("required");
  $("#distibuidor").removeAttr("required");

  $("#div_Dato_Medicamentos").css("display", "none");
  $("#div_Dato_MedicamentosII").css("display", "none");

  $("#div_Datos_Tecnovigilancia").css("display", "none");
  $("#div_Datos_TecnovigilanciaII").css("display", "none");
  $("#div_Datos_TecnovigilanciaIII").css("display", "none");
  $("#div_Datos_TecnovigilanciaIV").css("display", "none");

  // $("#dispositivosEquipos").css("display", "none");

  let stip = 0;
  let txtmotivo = "";
  let txtservicio = "";
  let txtmensaje = "";
  let txtnombres = "";
  let txtapellidos = "";
  let txtdocumento = "";
  let txtdireccion = "";
  let txtemail = "";
  let txttelefono = "";
  let txtentidad = "";
  let txtotraentidad = "";

  if ($("#opc_pag").val() == "reportes") {
    cargar_listado();

    function cargar_listado() {
      Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de Sucesos de Seguridad.",
        showConfirmButton: false,
      });

      $.post("/rep_suceso_seguridad/listar_tabla", {}, function (data_carg) {
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
  } else if ($("#opc_pag").val() == "index") {
    ////////////####### inicio smartwizard ########///////////////
    // Leave step event is used for validating the forms
    $("#smartwizard").on(
      "leaveStep",
      function (e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        // Validate only on forward movement
        if (stepDirection == "forward") {
          let form = document.getElementById("form-" + (currentStepIdx + 1));
          stip = currentStepIdx + 1;
          if (form) {
            if (!form.checkValidity()) {
              form.classList.add("was-validated");
              $("#smartwizard").smartWizard(
                "setState",
                [currentStepIdx],
                "error"
              );
              $("#smartwizard").smartWizard("fixHeight");
              return false;
            }
            $("#smartwizard").smartWizard(
              "unsetState",
              [currentStepIdx],
              "error"
            );
          }
        }
      }
    );

    // Step show event
    $("#smartwizard").on(
      "showStep",
      function (e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass("disabled").prop("disabled", false);
        $("#next-btn").removeClass("disabled").prop("disabled", false);
        if (stepPosition === "first") {
          $("#prev-btn").addClass("disabled").prop("disabled", true);
        } else if (stepPosition === "last") {
          $("#next-btn").addClass("disabled").prop("disabled", true);
        } else {
          $("#prev-btn").removeClass("disabled").prop("disabled", false);
          $("#next-btn").removeClass("disabled").prop("disabled", false);
        }

        // Get step info from Smart Wizard
        let stepInfo = $("#smartwizard").smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);

        if (stepPosition == "last") {
          $("#btnFinish").prop("disabled", false);
        } else {
          $("#btnFinish").prop("disabled", true);
        }

        // Focus first name
        if (stepIndex == 1) {
          setTimeout(() => {
            $("#mensaje").focus();
          }, 0);
        }
      }
    );

    // Smart Wizard
    $("#smartwizard").smartWizard({
      selected: 0,
      // autoAdjustHeight: false,
      theme: "arrows", // basic, arrows, square, round, dots
      transition: {
        animation: "none",
      },
      toolbar: {
        showNextButton: false, // show/hide a Next button
        showPreviousButton: false, // show/hide a Previous button
        position: "bottom", // none/ top/ both bottom

        extraHtml: `<button class="btn btn-outline-secondary sw-btn-prev sw-prev radius-l-1 mr-2px" id="prev-btn"><i class="fa fa-arrow-left mr-15" id="prev-btn"></i> Anterior</button>
              						<button class="btn btn-outline-primary sw-btn-next sw-btn-hide sw-next radius-r-1" id="next-btn">Siguiente <i class="fa fa-arrow-right mr-15" id="next-btn"></i></button>
              						<button class="btn btn-success" id="btnFinish" disabled ">Guardar <i class="fa fa-check mr-15" id="btnFinish"></i></button>
                          <button class="btn btn-danger" id="btnCancel" >Salir <i class="fa fa-times mr-15" id="btnCancel"></i></button>`,
      },
      anchor: {
        enableNavigation: true, // Enable/Disable anchor navigation
        enableNavigationAlways: false, // Activates all anchors clickable always
        enableDoneState: true, // Add done state on visited steps
        markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
        unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
        enableDoneStateNavigation: true, // Enable/Disable the done state navigation
      },
    });

    // este onchange aplica a un id en especifico del documento ($("#state_selector"))
    $("#state_selector").on("change", function () {
      $("#smartwizard").smartWizard(
        "setState",
        [$("#step_to_style").val()],
        $(this).val(),
        !$("#is_reset").prop("checked")
      );
      return true;
    });

    $("#style_selector").on("change", function () {
      $("#smartwizard").smartWizard(
        "setStyle",
        [$("#step_to_style").val()],
        $(this).val(),
        !$("#is_reset").prop("checked")
      );
      return true;
    });

    ////////////####### fin smartwizard ########///////////////
  } else if ($("#opc_pag").val() == "gestion") {
    cambiar_readonly(false);
    $('#descripcionN').attr("readonly","readonly");
    $('#manejoR').attr("readonly","readonly");

    $('#lblreporteCont').css("display","none");
    $('#inputreporteCont').css("display","none");
    $('#div_trazadores1').css("display", "none");    
    $('#div_trazadores2').css("display", "none");    
    $('#div_trazadores3').css("display", "none");
    $('#div_trazadores4').css("display", "none");    
    $('#div_trazadores5').css("display", "none");    
    $('#div_trazadores6').css("display", "none");
    $('#div_trazadores7').css("display", "none");
    $('#div_fechaRep').css("display","none");
    $('#div_btntAccion_Mejora').css("display","none");


    if($('#causaNovedad').val() > "2"){
      $('#DatosMedicamentos').css("display", "none");
      $('#DatosDispositivo').css("display", "none");
    }else if($('#causaNovedad').val() == "1"){
      $('#DatosDispositivo').css("display", "none");
    }else{
      $('#DatosMedicamentos').css("display", "none");
    }

    $('#div_datosgestion0').css("display", "none");
    $('#btnAccionMejora').click(function () { 

      $("#ModalAccionM").modal({
        show: true,
        keyboard: false,
      });
      return false;
    });

    $('#btn_guardar_accion').click(function (e) {
      e.preventDefault();
      
      var idtipo_accion = $('#tipo_accion').val();
      var textipo_accion = '';
      var idestado = "0";
      var textEstado = "Sin Iniciar";

      if ($('#tipo_accion').val()=="1"){
        textipo_accion = "Acción correctiva";
      }else if ($('#tipo_accion').val()=="2"){
        textipo_accion = "Acción Preventiva";
      }else{
        textipo_accion = "Oportunidad de mejora";
      }
     
      var descripcion = $('#descripcion').val();
      var coordinador_accion = $('#coordinador_accion option:selected').text();
      var Idcoordinador = $('#coordinador_accion').val();       
      var txtfechaAE = $('#txtfechaAE').val();

      var tcont = $('#cantAcciones').val();
            
      const tr_principal = D.create('tr');
      tcont++;       
      //crear el td que contiene los input
      const td_id = D.create('td');
      const td_tipo = D.create('td');
      const td_descripcion = D.create('td');
      const td_coordinador = D.create('td');
      const td_fechaAE = D.create('td');      
      const td_Estado = D.create('td');
      const td_btnAccion = D.create('td');

      //crear los inputs 
      const span_id = D.create('span', { name: 'numero[]', innerHTML: ''+tcont+'' });
      const txtipo_accion = D.create('input', { type: 'text', name: 'tipo_accion'+tcont+'', id: 'tipo_accion'+tcont+''});
      const input_idtipo_accion = D.create('input', { type: 'hidden', name: 'idtipo_accion'+tcont+'', id: 'idtipo_accion'+tcont+''});

      const input_descripcion = D.create('textarea', { rows: '3', id: 'descripcion'+tcont+'', name: 'descripcion'+tcont+''});
      const input_coordinador = D.create('input', { type: 'text', name: 'coordinador'+tcont+'', id: 'coordinador'+tcont+''});
      const input_idcoordinador = D.create('input', { type: 'hidden', name: 'idcoordinador'+tcont+'', id: 'idcoordinador'+tcont+''});
      const input_fechaAE = D.create('input', { type: 'date', id: 'fechaAE'+tcont+'', name: 'fechaAE'+tcont+'' });

      const txt_estado = D.create('input', { type: 'text', name: 'txt_estadoAcc'+tcont+'', id: 'txt_estadoAcc'+tcont+''});
      const input_id_estado = D.create('input', { type: 'hidden', name: 'idestadoAcc'+tcont+'', id: 'idestadoAcc'+tcont+''});

      const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function( ){ D.remove(tr_principal); tcont--; }});
      const img_btn =  D.create('i',{});
      //agregar clases a los elementos
                          
     
      txtipo_accion.classList.add('form-control','col-sm-12');      
      input_descripcion.classList.add('form-control','col-sm-12');      
      input_coordinador.classList.add('form-control','col-sm-12');

      input_fechaAE.classList.add('form-control', 'tinyDate','col-sm-8');
      txt_estado.classList.add('form-control','col-sm-12'); 

      btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
      img_btn.classList.add('fa','fa-trash-alt');
      
      //agregar cada etiqueta a su nodo padre
      
      D.append(span_id, td_id);  
      D.append([txtipo_accion,input_idtipo_accion], td_tipo); 
      D.append(input_descripcion, td_descripcion);
      D.append([input_coordinador, input_idcoordinador], td_coordinador);
      D.append(input_fechaAE, td_fechaAE);
      D.append([txt_estado,input_id_estado], td_Estado);
      D.append(img_btn, btn_borrar);
      D.append(btn_borrar, td_btnAccion);

      D.append([td_id,td_tipo,td_descripcion,td_coordinador,td_fechaAE,td_Estado,td_btnAccion],tr_principal);
      D.append(tr_principal, D.id('post-acciones'));    
      
      $('#cantAcciones').val(tcont);  

      
      $('#tipo_accion'+tcont+'').val(textipo_accion);
      $('#idtipo_accion'+tcont+'').val(idtipo_accion);
      $('#descripcion'+tcont+'').val(descripcion);
      $('#coordinador'+tcont+'').val(coordinador_accion);
      $('#idcoordinador'+tcont+'').val(Idcoordinador);
      $('#fechaAE'+tcont+'').val($('#txtfechaAE').val());
      $('#txt_estadoAcc'+tcont+'').val(textEstado);
      $('#idestadoAcc'+tcont+'').val(idestado);      
     
      $('#tipo_accion'+tcont+'').attr("readonly","readonly");
      $('#idtipo_accion'+tcont+'').attr("readonly","readonly");
      $('#descripcion'+tcont+'').attr("readonly","readonly");
      $('#coordinador'+tcont+'').attr("readonly","readonly");
      $('#idcoordinador'+tcont+'').attr("readonly","readonly");
      $('#fechaAE'+tcont+'').attr("readonly","readonly");
      $('#txt_estadoAcc'+tcont+'').attr("readonly","readonly");

     
      $("#form_Accion")[0].reset(); 
      $('#accion_mejoraSN').val('1');             
      return false;       
    });

  }else if ($("#opc_pag").val() == "revisar") {

    cambiar_readonly(true)
    $('#lblreporteCont').css("display","none");
    $('#inputreporteCont').css("display","none");
    $('#div_trazadores1').css("display", "none");    
    $('#div_trazadores2').css("display", "none");    
    $('#div_trazadores3').css("display", "none");
    $('#div_trazadores4').css("display", "none");    
    $('#div_trazadores5').css("display", "none");    
    $('#div_trazadores6').css("display", "none");
    $('#div_trazadores7').css("display", "none");
    $('#div_fechaRep').css("display","none");
    $('#div_btntAccion_Mejora').css("display","none");

    $('#btnAccionMejora').click(function () { 

      $("#ModalAccionM").modal({
        show: true,
        keyboard: false,
      });
      return false;
    });

    $('#btn_guardar_accion').click(function (e) {
      e.preventDefault();
      
      var idtipo_accion = $('#tipo_accion').val();
      var textipo_accion = '';
      var idestado = "0";
      var textEstado = "Sin Iniciar";

      if ($('#tipo_accion').val()=="1"){
        textipo_accion = "Acción correctiva";
      }else if ($('#tipo_accion').val()=="2"){
        textipo_accion = "Acción Preventiva";
      }else{
        textipo_accion = "Oportunidad de mejora";
      }
     
      var descripcion = $('#descripcion').val();
      var coordinador_accion = $('#coordinador_accion option:selected').text();
      var Idcoordinador = $('#coordinador_accion').val();       
      var txtfechaAE = $('#txtfechaAE').val();

      var tcont = $('#cantAcciones').val();
            
      const tr_principal = D.create('tr');
      tcont++;       
      //crear el td que contiene los input
      const td_id = D.create('td');
      const td_tipo = D.create('td');
      const td_descripcion = D.create('td');
      const td_coordinador = D.create('td');
      const td_fechaAE = D.create('td');      
      const td_Estado = D.create('td');
      const td_btnAccion = D.create('td');

      //crear los inputs 
      const span_id = D.create('span', { name: 'numero[]', innerHTML: ''+tcont+'' });
      const txtipo_accion = D.create('input', { type: 'text', name: 'tipo_accion'+tcont+'', id: 'tipo_accion'+tcont+''});
      const input_idtipo_accion = D.create('input', { type: 'hidden', name: 'idtipo_accion'+tcont+'', id: 'idtipo_accion'+tcont+''});

      const input_descripcion = D.create('textarea', { rows: '3', id: 'descripcion'+tcont+'', name: 'descripcion'+tcont+''});
      const input_coordinador = D.create('input', { type: 'text', name: 'coordinador'+tcont+'', id: 'coordinador'+tcont+''});
      const input_idcoordinador = D.create('input', { type: 'hidden', name: 'idcoordinador'+tcont+'', id: 'idcoordinador'+tcont+''});
      const input_fechaAE = D.create('input', { type: 'date', id: 'fechaAE'+tcont+'', name: 'fechaAE'+tcont+'' });

      const txt_estado = D.create('input', { type: 'text', name: 'txt_estadoAcc'+tcont+'', id: 'txt_estadoAcc'+tcont+''});
      const input_id_estado = D.create('input', { type: 'hidden', name: 'idestadoAcc'+tcont+'', id: 'idestadoAcc'+tcont+''});

      const btn_borrar = D.create('a', { href: 'javascript:void(0)', onclick: function( ){ D.remove(tr_principal); tcont--; }});
      const img_btn =  D.create('i',{});
      //agregar clases a los elementos
                          
     
      txtipo_accion.classList.add('form-control','col-sm-12');      
      input_descripcion.classList.add('form-control','col-sm-12');      
      input_coordinador.classList.add('form-control','col-sm-12');

      input_fechaAE.classList.add('form-control', 'tinyDate','col-sm-8');
      txt_estado.classList.add('form-control','col-sm-12'); 

      btn_borrar.classList.add('mx-2px','btn','radius-1','border-2','btn-xs','btn-brc-tp','btn-light-secondary','btn-h-lighter-danger','btn-a-lighter-danger');
      img_btn.classList.add('fa','fa-trash-alt');
      
      //agregar cada etiqueta a su nodo padre
      
      D.append(span_id, td_id);  
      D.append([txtipo_accion,input_idtipo_accion], td_tipo); 
      D.append(input_descripcion, td_descripcion);
      D.append([input_coordinador, input_idcoordinador], td_coordinador);
      D.append(input_fechaAE, td_fechaAE);
      D.append([txt_estado,input_id_estado], td_Estado);
      D.append(img_btn, btn_borrar);
      D.append(btn_borrar, td_btnAccion);

      D.append([td_id,td_tipo,td_descripcion,td_coordinador,td_fechaAE,td_Estado,td_btnAccion],tr_principal);
      D.append(tr_principal, D.id('post-acciones'));    
      
      $('#cantAcciones').val(tcont);  

      
      $('#tipo_accion'+tcont+'').val(textipo_accion);
      $('#idtipo_accion'+tcont+'').val(idtipo_accion);
      $('#descripcion'+tcont+'').val(descripcion);
      $('#coordinador'+tcont+'').val(coordinador_accion);
      $('#idcoordinador'+tcont+'').val(Idcoordinador);
      $('#fechaAE'+tcont+'').val($('#txtfechaAE').val());
      $('#txt_estadoAcc'+tcont+'').val(textEstado);
      $('#idestadoAcc'+tcont+'').val(idestado);      
     
      $('#tipo_accion'+tcont+'').attr("readonly","readonly");
      $('#idtipo_accion'+tcont+'').attr("readonly","readonly");
      $('#descripcion'+tcont+'').attr("readonly","readonly");
      $('#coordinador'+tcont+'').attr("readonly","readonly");
      $('#idcoordinador'+tcont+'').attr("readonly","readonly");
      $('#fechaAE'+tcont+'').attr("readonly","readonly");
      $('#txt_estadoAcc'+tcont+'').attr("readonly","readonly");

     
      $("#form_Accion")[0].reset(); 
      $('#accion_mejoraSN').val('1');             
      return false;       
    });
  }else if ($("#opc_pag").val() == "seguimiento") {

    $('#empleadosMR_sucesos').select2({
      width: "100%",
      placeholder: ' ',
      allowClear: true
    });
    cambiar_readonly(true)
    
  //
    $('#descripcionN').attr("readonly","readonly");
    $('#manejoR').attr("readonly","readonly");


    if($('#causaNovedad').val() == "Uso de Medicamentos"){
      $('#DatosMedicamentos').css("display", "flex");
      $('#DatosDispositivo').css("display", "none");
    }else if($('#causaNovedad').val() == "Uso de Dispositivos/equipos biometricos"){
      $('#DatosMedicamentos').css("display", "none");
      $('#DatosDispositivo').css("display", "flex");
    }else{
       $('#DatosMedicamentos').css("display", "none");
       $('#DatosDispositivo').css("display", "none");
    }

    $('#glesion').attr("readonly","readonly");    
    $('#gcaso').attr("readonly","readonly");
    $('#ocomplicacion').attr("readonly","readonly");
    $('#justificacionfc').attr("readonly","readonly");
    

    $('#trazadores').attr("readonly","readonly");
    $('#relCuidado').attr("readonly","readonly");
    $('#RelMedicam').attr("readonly","readonly");
    $('#relIACS').attr("readonly","readonly");
    $('#RelprocInva').attr("readonly","readonly");
    $('#reldiagnosticos').attr("readonly","readonly");
    $('#relTecnov').attr("readonly","readonly");
    $('#relOtros').attr("readonly","readonly");
    
    $('#guias').attr("readonly","readonly"); 
    $('#enteControl').attr("readonly","readonly");
    $('#reporteCont').attr("readonly","readonly"); 
    $('#fechaRep').attr("readonly","readonly");
    $('#fechaComite').attr("readonly","readonly");

    $('#accionMejora').attr("readonly","readonly");

    $('#div_trazadores').css('display','none');
    
    if($('#clasificacionI').val()!=="3"){
      $('#div_datosgestion0').css('display','none');
    }

    var accion_mejora = $('#accionMejora').val();
    var idreg = $('#idregistro').val();
    if(accion_mejora =="1"){
      var tcont = 1;
      
      $.post("/rep_suceso_seguridad/listar_acciones", {idsuceso: ""+idreg+""}, function (data_accion) {

      $('#post-acciones').html(data_accion);    
        
      $('#cantAcciones').val(tcont);         

        return false; 
      });
    }

    $.post("/rep_suceso_seguridad/cargar_seguimiento", {idsuceso: ""+idreg+""}, function (data_accion) {

      $('#div_segimientos').html(data_accion);              

        return false; 
    });

    $("#card-seguimiento").css("display","none");
    
    
  }

  $(document).on("click", function (event) {
    var datos = event.target.id.split("_");
    var dato = event.target.id;

    if (dato == "btn_sucess_modal") {
      idmes = $("#mes").val();
      // alert(idmes);
      let fecha = idmes.split("-");
      // alert(fecha[0]);
      // alert(fecha[1]);
      window.open("/rep_suceso_seguridad/excel/" + idmes, "_blank");
    }

    if (datos[0] == "btndetalle") {
      id_suceso = datos[1];
      
      window.open("/rep_suceso_seguridad/ver_registro/" + id_suceso, "_blank");
      
    }

    if (dato == "btn_guardar_seguimiento") {
      let ban = 0;
      let texto = "";
      let estado = $('#estado').val();
      let id_suceso = '';

      let ckseguimiento = $('#ckseguimiento').val();

      if(estado !== "3"){
        if(ckseguimiento == "1"){
          if($('#accionMejoraEfe option:selected').val()==""){
            $('#accionMejoraEfe').addClass("brc-danger");
            texto= texto + "* No ha indicado si la acción fue efectiva o no!<br>";
            ban = 1;    
          };

          if($('#descripcioRespuesta').val()==""){
            $('#descripcioRespuesta').addClass("brc-danger");
            texto= texto + "* Debe registrar el porqué de su respuesta anterior!<br>";
            ban = 1;    
          };

          if($('#observacionesS').val()==""){
            $('#observacionesS').addClass("brc-danger");
            texto= texto + "* No ha registrado las observaciones del seguimiento !<br>";
            ban = 1;    
          };
          
          if($('#cumplimiento option:selected').val()==""){
            $('#cumplimiento').addClass("brc-danger");
            texto= texto + "* No ha Seleccionado una opción del Estado del Cumplimiento!<br>";
            ban = 1;    
          }

          if($('#cerrado option:selected').val()==""){
            $('#cerrado').addClass("brc-danger");
            texto= texto + "* No ha registrado si el caso se cierra o no !<br>";
            ban = 1;    
          }

          if($('#empleadosMR_sucesos option:selected').val()==""){
            $('#empleadosMR_sucesos').addClass("brc-danger");
            texto= texto + "* Debe registrar el o los funcionarios involucrados !<br>";
            ban = 1;    
          }   
        }
      }
         
      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_seguimiento();
      }
      return false;
    }

    if(datos[0] == "btnseguimiento"){
      idreg = datos[1];

      //alert(idreg);
      window.open("/rep_suceso_seguridad/seguimiento/" + idreg, "_parent");
    }

    if(dato == "btn_nuevoSegumiento"){
      //alert("Registrar Nuevo Seguimiento");
      $('#ckseguimiento').val('1');

      $("#card-seguimiento").css("display","block");
      
    }

    if (dato == "btnFinish") {
      
       // Datos Medicamento
        $("#txtcausaNovedad").val($("#causaNovedad").val());
        $("#txtinformoJ").val($("#informoJ").val());
        $("#txtdatosMedicamento").val($("#datosMedicamento").val());
        $("#txtregistroSanitario").val($("#registroSanitario").val());
        $("#txtloteMedicamento").val($("#loteMedicamento").val());
        $("#txtfechaVencimiento").val($("#fechaVencimiento").val());

        // Datos del dispositivo
        $("#txtdatosdispositivo").val($("#datosdispositivo").val());
        $("#txtregistroSanitarioD").val($("#registroSanitarioD").val());
        $("#txtlotedispositivo").val($("#lotedispositivo").val());
        $("#txtmodelo").val($("#modelo").val());
        $("#txtnumReferencia").val($("#numReferencia").val());
        $("#txtserial").val($("#serial").val());
        $("#txtfabricante").val($("#fabricante").val());
        $("#txtdistibuidor").val($("#distibuidor").val());
        $("#txtdescripcionNovedad").val($("#descripcionNovedad").val());
        $("#txtmanejoRealizado").val($("#manejoRealizado").val());

      let form = document.getElementById("form-2");

      if (form) {
        if (!form.checkValidity()) {
          form.classList.add("was-validated");
          $("#smartwizard").smartWizard("setState", [2], "error");
          $("#smartwizard").smartWizard("fixHeight");
          return false;
        }
        $("#smartwizard").smartWizard("unsetState", [2], "error");
      }

      guardar_datos();
      return false;
    }

    if (dato == "btnCancel") {
      // Reset wizard
      $("#smartwizard").smartWizard("reset");

      // Reset form
      document.getElementById("form-1").reset();
      document.getElementById("form-2").reset();

      if ($("#formulariosucesos").val()) {
        window.open("/rep_suceso_seguridad/reportes", "_parent");
      } else {
        window.open("/rep_suceso_seguridad/reportes", "_parent");
      }
    }

    if (dato == "next-btn") {
      // alert(stip);
      // Etiquetas steep 1
      if (stip == 1) {
        $("#txtcargoReportante").val($("#cargoReportante").val());
        $("#txtservicio").val($("#servicio").val());
        $("#txtotroCargo").val($("#otroCargo").val());
        $("#txtotroServicio").val($("#otroServicio").val());
        $("#txtnombrePaciente").val($("#nombrePaciente").val());
        $("#txtnumeroDocumento").val($("#numeroDocumento").val());
        
      }
    }

    if (datos[0] == "btngestionar") {
      id_cont = datos[1];
      window.open("/rep_suceso_seguridad/gestion/" + id_cont, "_parent");
    } 


    if (dato == "btn_guardar_revision") {
      let ban = 0;
      let texto = "";

      if($('#estado option:selected').val()== "2"){
    
        if($('#modifcarAnalisis option:selected').val()== "1"){
          if (($('#justificacion').val() == "")) {
          $('#justificacion').addClass("brc-danger");
            texto = texto + "* La justificación de la modifición al Analísis inicial es obligatoria!<br>";
            ban = 1;
          }
        }

        if($('#fechaA2').val()==""){
          $('#fechaA2').addClass("brc-danger");
          texto = texto + "* La fecha del segundo Analísis es obligatoria!<br>";
          ban = 1;
        }  
             

        if($('#trazadores option:selected').val() == ""){
          $('#trazadores').addClass("brc-danger");
          texto = texto + "* Debe seleccionar por lo menos un trazador!<br>";
          ban = 1;          
        }else{
          var arrtrazadores = $('#trazadores').val();

          arrtrazadores.forEach((element) => {
            
            if (element == "1"){
              if($('#relCuidado option:selected').val()==""){
                $('#relCuidado').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con el Cuidado !<br>";
                ban = 1;    
              }
            }

            if (element == "2"){
              if($('#RelMedicam option:selected').val()==""){
                $('#RelMedicam').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador RelacionadO a medicamentos!<br>";
                ban = 1;    
              }
            }

            if (element == "3"){
              if($('#relIACS option:selected').val()==""){
                $('#relIACS').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con IACS (infecciones asociadas al cuidado de la salud)!<br>";
                ban = 1;    
              }
            }

            if (element == "4"){
              if($('#RelprocInva option:selected').val()==""){
                $('#RelprocInva').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con procedimientos invasivos!<br>";
                ban = 1;    
              }
            }

            if (element == "5"){
              if($('#reldiagnosticos option:selected').val()==""){
                $('#reldiagnosticos').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con diagnósticos y/o informes!<br>";
                ban = 1;    
              }
            }
            
            if (element == "6"){
              if($('#relTecnov option:selected').val()==""){
                $('#relTecnov').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con tecnovigilancia!<br>";
                ban = 1;    
              }
            }

            if (element == "7"){
              if($('#relOtros option:selected').val()==""){
                $('#relOtros').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador relacionado a Otras causas!<br>";
                ban = 1;    
              }
            }          
          
          });

        }

        if($('#guias option:selected').val() ==""){
          $('#guias').addClass("brc-danger");
          texto = texto + "* No ha Seleccionado una guia!<br>";
          ban = 1;    
        }

        if($('#enteControl option:selected').val()=="1"){
          if($('#reporteCont option:selected').val()==""){
            $('#reporteCont').addClass("brc-danger");
            texto= texto + "* No has seleccionado el Reporte que Aplica!<br>";
            ban = 1;    
          }
          
          if($('#fechaRep option:selected').val()==""){
            $('#fechaRep').addClass("brc-danger");
            texto= texto + "* No ha registrado la fecha del Reporte al Ente de Control!<br>";
            ban = 1;    
          }
        }

        if($('#fechaComite option:selected').val()==""){
          $('#fechaComite').addClass("brc-danger");
          texto= texto + "* No ha registrado la fecha del Comite!<br>";
          ban = 1;    
        }

        if($('#accionMejora option:selected').val()=="1"){
          if($('#cantAcciones').val()=="0"){
            $('#accionMejora').addClass("brc-danger");
            texto+= texto + "* No ha registrado una acción de Mejora!<br>";
            ban = 1;    
          }
        }
      }else{

        $('#estado').addClass("brc-danger");
        texto= texto + "* El estado actual no permite guardar!<br>";
        ban = 1;    
        
      }

      if (ban == 1) {
        Swal.fire("¡Atención!", texto, "warning");
      } else {
        guardar_revision();
      }
      return false;
    }


    if (dato == "btn_guardar_gestion") {
      let ban = 0;
      let texto = "";

      if ($("#estado option:selected").val() == "1") {
        if (($('#clasificacionI').val() == "")) {
          $('#clasificacionI').addClass("brc-danger");
          texto = texto + "* La Clasificación Inicial es obligatoria!<br>";
          ban = 1;
        }

        if (($('#fechaA').val() == "")) {
          $('#fechaA').addClass("brc-danger");
          texto = texto + "* La Fecha de Analisis es obligatoria!<br>";
          ban = 1;
        }

        if (($('#investigacion').val() == "")) {
          $('#investigacion').addClass("brc-danger");
          texto = texto + "* Describa la Investigación del Suceso!<br>";
          ban = 1;
        }

        if (($('#conclusiones').val() == "")) {
          $('#conclusiones').addClass("brc-danger");
          texto = texto + "* Describa Las Conclusiones de la Investigación!<br>";
          ban = 1;
        }
        
        if (($('#accionesI').val() == "")) {
          $('#accionesI').addClass("brc-danger");
          texto = texto + "* Describa Las Acciones Inseguras Identificadas!<br>";
          ban = 1;
        }
        

        if($('#trazadores').val() == ""){
          $('#trazadores').addClass("brc-danger");
          texto = texto + "* Debe seleccionar por lo menos un trazador!<br>";
          ban = 1;          
        }else{
          var arrtrazadores = $('#trazadores').val();

          arrtrazadores.forEach((element) => {
            
            if (element == "1"){
              if($('#relCuidado option:selected').val()==""){
                $('#relCuidado').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con el Cuidado !<br>";
                ban = 1;    
              }
            }

            if (element == "2"){
              if($('#RelMedicam option:selected').val()==""){
                $('#RelMedicam').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador RelacionadO a medicamentos!<br>";
                ban = 1;    
              }
            }

            if (element == "3"){
              if($('#relIACS option:selected').val()==""){
                $('#relIACS').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con IACS (infecciones asociadas al cuidado de la salud)!<br>";
                ban = 1;    
              }
            }

            if (element == "4"){
              if($('#RelprocInva option:selected').val()==""){
                $('#RelprocInva').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con procedimientos invasivos!<br>";
                ban = 1;    
              }
            }

            if (element == "5"){
              if($('#reldiagnosticos option:selected').val()==""){
                $('#reldiagnosticos').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con diagnósticos y/o informes!<br>";
                ban = 1;    
              }
            }
            
            if (element == "6"){
              if($('#relTecnov option:selected').val()==""){
                $('#relTecnov').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador Relacionado con tecnovigilancia!<br>";
                ban = 1;    
              }
            }

            if (element == "7"){
              if($('#relOtros option:selected').val()==""){
                $('#relOtros').addClass("brc-danger");
                texto= texto + "* No ha Seleccionado una opción del trazador relacionado a Otras causas!<br>";
                ban = 1;    
              }
            }          
          
          });

        }

        if($('#guias option:selected').val() ==""){
          $('#guias').addClass("brc-danger");
          texto = texto + "* No ha Seleccionado una guia!<br>";
          ban = 1;    
        }

        if($('#enteControl option:selected').val()=="1"){
          if($('#reporteCont option:selected').val()==""){
            $('#reporteCont').addClass("brc-danger");
            texto= texto + "* No has seleccionado el Reporte que Aplica!<br>";
            ban = 1;    
          }
          
          if($('#fechaRep option:selected').val()==""){
            $('#fechaRep').addClass("brc-danger");
            texto= texto + "* No ha registrado la fecha del Reporte al Ente de Control!<br>";
            ban = 1;    
          }
        }

        if($('#fechaComite option:selected').val()==""){
          $('#fechaComite').addClass("brc-danger");
          texto= texto + "* No ha registrado la fecha del Comite!<br>";
          ban = 1;    
        }

        if($('#accionMejora option:selected').val()=="1"){
          if($('#cantAcciones').val()=="0"){
            $('#accionMejora').addClass("brc-danger");
            texto+= texto + "* No ha registrado una acción de Mejora!<br>";
            ban = 1;    
          }
        }     

        if (ban == 1) {
          Swal.fire("¡Atención!", texto, "warning");
        } else {
          guardar_gestion();
        }
          return false;
      }else{
          $('#estado').addClass("brc-danger");
          texto= texto + "* El estado actual no permite guardar!<br>";          
          Swal.fire("¡Atención!", texto, "warning");
        }
        return false;
      }

    if(dato == "btn_guardar_cierre"){
      let ban = 0;
      let texto = "";

      if ($("#estado option:selected").val() == "3") {

        if (($('#Obscierre').val() == "")) {
          $('#Obscierre').addClass("brc-danger");
          texto = texto + "* Las Observaciones de cierre son obligatorias!<br>";
          ban = 1;
        }

        if (ban == 1) {
          Swal.fire("¡Atención!", texto, "warning");
        } else {
          guardar_cierre();
        }
        return false;
      }
    }
  });

  function guardar_datos() {
    Swal.fire({
      title: "¡Atención!",
      text: "Enviando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    var formData = new FormData(document.getElementById("form-2"));

    $.ajax({
      url: "/rep_suceso_seguridad/guardar",
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
          if ($("#formulariosucesos").val()) {
            window.open("/rep_suceso_seguridad/reportes", "_parent");
          } else {
            window.open("/rep_suceso_seguridad/reportes", "_parent");
          }
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }

  function guardar_gestion() {
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    var formData = new FormData(document.getElementById("form_gestion"));

    $.ajax({
      url: "/rep_suceso_seguridad/guardar_gestion",
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
          window.open("/rep_suceso_seguridad/reportes", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }

  function guardar_seguimiento() {
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    var formData = new FormData(document.getElementById("form_segumiento"));

    $.ajax({
      url: "/rep_suceso_seguridad/guardar_seguimiento",
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
          window.open("/rep_suceso_seguridad/reportes", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }

  function guardar_cierre() {
    Swal.fire({
      title: "¡Atención!",
      text: "Guardando Información...!",
      icon: "warning",
      showConfirmButton: false,
    });

    var formData = new FormData(document.getElementById("form_seguimiento"));

    $.ajax({
      url: "/rep_suceso_seguridad/guardar_cierre",
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
          window.open("/rep_suceso_seguridad/reportes", "_parent");
        });
      } else {
        Swal.fire("¡Error!", res, "error");
      }
    });
    return false;
  }

  // este onchange es generico sobre un evento cualquiera en el documeto
  $(document).on("change", function (event) {
    let datos = event.target.id.split("_");
    let dato = event.target.id;
    let ck = event.target.checked;

    // if para el evento de Id causaNovedad (uso de medicamento)
    if (dato == "2causaNovedad") {
      // alert("El evento de causa novedad")
      if ($("#causaNovedad option:selected").val() == "1") {
        // alert("El evento de option select 'Uso de medicamento'");
        $("#datosMedicamento").css("display", "flex"); // En la seccion superio se declara diplay: none, aca cambiamos el estado
      } else {
        $("#datosMedicamento").css("display", "none");
      }
    }
    // ------------ INICIO TEST RICH --------------------------------


    // -------- INICIO STEEP 1 --------------------------------


    // divOtroCargoSevicio

    //HABILITAR LOS CAMPOS DEL ANALISIS INICIAL//
    
     if(dato =="modifcarAnalisis"){
      if($('#modifcarAnalisis option:selected').val()== "1"){
        cambiar_readonly(false);
      }else{
        cambiar_readonly(true);
      }
    }
    // /
    if(dato =="accionMejora"){
      if($('#accionMejora option:selected').val()== "1"){
        $('#div_btntAccion_Mejora').css("display","block");
         $('#accion_mejoraSN').val("1");
      }else{
        $('#div_btntAccion_Mejora').css("display", "none");
        $('#accion_mejoraSN').val("0");
      }
    }

    if (dato === "trazadores") {
      var arrtrazadores = $('#trazadores').val();
      
      $('#div_trazadores1').css("display", "none");    
      $('#div_trazadores2').css("display", "none");    
      $('#div_trazadores3').css("display", "none");
      $('#div_trazadores4').css("display", "none");    
      $('#div_trazadores5').css("display", "none");    
      $('#div_trazadores6').css("display", "none");
      $('#div_trazadores7').css("display", "none");
      // Recorrer el arreglo y hacer visible los elementos correspondientes
      arrtrazadores.forEach((element) => {
        
          $('#div_trazadores'+element).css("display", "flex");
        
      });
    }

    // if para el evento de Id cargoReportante
    if (dato == "cargoReportante") {
      // alert("El evento de causa novedad")
      if ($("#cargoReportante option:selected ").val() == "12") {
        // alert("El evento de causa")
        $("#lbOtroCargo").css("display", "flex"); // En la seccion superio se declara diplay: none, aca cambiamos el estado
        $("#otroCargo").css("display", "flex");
        $("#otroCargo").prop("required", true);
        $("#smartwizard").smartWizard("fixHeight");
      } else {
        $("#lbOtroCargo").css("display", "none");
        $("#otroCargo").css("display", "none");
        $("#otroCargo").removeAttr("required");
      }
    }

    // if para el evento otro servicio

    if (dato == "servicio") {
      // alert("El evento de causa novedad")
      if ($("#servicio option:selected ").val() == "99") {
        // alert("El evento de causa")
        $("#lbOtroServicio").css("display", "flex"); // En la seccion superio se declara diplay: none, aca cambiamos el estado
        $("#otroServicio").css("display", "flex");
        $("#otroServicio").prop("required", true);
        $("#smartwizard").smartWizard("fixHeight");
      } else {
        $("#lbOtroServicio").css("display", "none");
        $("#otroServicio").css("display", "none");
        $("#otroServicio").removeAttr("required");
      }
    }

    if (dato == "clasificacionI") {
      if ($("#clasificacionI option:selected ").val() == "3") {
        $("#div_datosgestion0").css("display", "flex");
      } else {
        $("#div_datosgestion0").css("display", "none");
      }
    }

    // -------- FIN STEEP 1 --------------------------------



    // -------- INICIO STEEP 2 --------------------------------

    // If uso de medicamentos

    if (dato == "causaNovedad") {
      // alert("El evento de causa novedad")
      let causa = $("#causaNovedad option:selected ").val();

      if ($("#causaNovedad option:selected ").val() == "1") {
        // alert("El evento de causa")
        $("#div_Dato_Medicamentos").css("display", "flex");
        $("#div_Dato_MedicamentosII").css("display", "flex");

        $("#datosMedicamento").prop("required", true);
        $("#registroSanitario").prop("required", true);
        $("#loteMedicamento").prop("required", true);
        $("#fechaVencimiento").prop("required", true);

        $("#datosdispositivo").removeAttr("required");
        $("#registroSanitario").removeAttr("required");
        $("#lotedispositivo").removeAttr("required");
        $("#modelo").removeAttr("required");
        $("#numReferencia").removeAttr("required");
        $("#serial").removeAttr("required");
        $("#fabricante").removeAttr("required");
        $("#distibuidor").removeAttr("required");

        $("#div_Datos_Tecnovigilancia").css("display", "none");
        $("#div_Datos_TecnovigilanciaII").css("display", "none");
        $("#div_Datos_TecnovigilanciaIII").css("display", "none");
        $("#div_Datos_TecnovigilanciaIV").css("display", "none");
      
      }else if($("#causaNovedad option:selected ").val() == "2"){
        $("#datosMedicamento").removeAttr("required");
        $("#registroSanitario").removeAttr("required");
        $("#loteMedicamento").removeAttr("required");
        $("#fechaVencimiento").removeAttr("required");

        $("#div_Dato_Medicamentos").css("display", "none"); 
        $("#div_Dato_MedicamentosII").css("display", "none");

        $("#div_Datos_Tecnovigilancia").css("display", "flex");
        $("#div_Datos_TecnovigilanciaII").css("display", "flex");
        $("#div_Datos_TecnovigilanciaIII").css("display", "flex");
        $("#div_Datos_TecnovigilanciaIV").css("display", "flex");

        $("#datosdispositivo").prop("required", true);
        $("#registroSanitarioD").prop("required", true);
        $("#lotedispositivo").prop("required", true);
        $("#modelo").prop("required", true);
        $("#numReferencia").prop("required", true);
        $("#serial").prop("required", true);
        $("#fabricante").prop("required", true);
        $("#distibuidor").prop("required", true);        
      }else{

        $("#datosdispositivo").removeAttr("required");
        $("#registroSanitarioD").removeAttr("required");
        $("#lotedispositivo").removeAttr("required");
        $("#modelo").removeAttr("required");
        $("#numReferencia").removeAttr("required");
        $("#serial").removeAttr("required");
        $("#fabricante").removeAttr("required");
        $("#distibuidor").removeAttr("required");

        $("#datosMedicamento").removeAttr("required");
        $("#registroSanitario").removeAttr("required");
        $("#loteMedicamento").removeAttr("required");
        $("#fechaVencimiento").removeAttr("required");

        $("#div_Datos_Tecnovigilancia").css("display", "none");
        $("#div_Datos_TecnovigilanciaII").css("display", "none");
        $("#div_Datos_TecnovigilanciaIII").css("display", "none");
        $("#div_Datos_TecnovigilanciaIV").css("display", "none");

        $("#div_Dato_Medicamentos").css("display", "none"); 
        $("#div_Dato_MedicamentosII").css("display", "none");       
        
      }

       $("#smartwizard").smartWizard("fixHeight");
      
    }

    if (dato === "enteControl") {
      if ($('#enteControl option:selected').val() =="1"){
        $('#lblreporteCont').css("display","block");
        $('#inputreporteCont').css("display","block");
        $('#div_fechaRep').css("display","flex");
        
      }else{
        $('#lblreporteCont').css("display","none");
        $('#inputreporteCont').css("display","none");
        $('#div_fechaRep').css("display","none");
      }
    }

    // If Dispositivos biometricos


    // -------- FIN STEEP 2 --------------------------------

    // ------------ FIN TEST RICH --------------------------------

    if (dato == "entidadpaciente") {
      // alert($('#entidadpaciente option:selected').val());
      if ($("#entidadpaciente option:selected").val() == 4) {
        document.getElementById("div_otraentidad").style.display = "flex";
        $("#smartwizard").smartWizard("fixHeight");
      } else {
        document.getElementById("div_otraentidad").style.display = "none";
        $("#smartwizard").smartWizard("fixHeight");
      }
    }

    if (dato == "2motivo") {
      // $('#idmotivo').val($('#motivo option:selected').val());
      // alert($("#idmotivo").val());
      if (
        $("#motivo option:selected").val() == 2 ||
        $("#motivo option:selected").val() == 3
      ) {
        // alert($('#motivo option:selected').val());
        document.getElementById("div-fecha").style.display = "flex";
        $("#smartwizard").smartWizard("fixHeight");
      } else {
        // alert($('#motivo option:selected').val());
        document.getElementById("div-fecha").style.display = "none";
        $("#smartwizard").smartWizard("fixHeight");
      }
    }

    if ((dato = "2servicio")) {
      // $('#servicio').val($('#servicio option:selected').val());
    }
  });
  
  function cambiar_readonly(val) {
    if(val){
      $('#clasificacionI').attr("readonly","readonly");
      $('#fechaA').attr("readonly","readonly");
      $('#investigacion').attr("readonly","readonly");
      $('#conclusiones').attr("readonly","readonly");
      $('#accionesI').attr("readonly","readonly");
      $('#facContAmb').attr("readonly","readonly");
      $('#facContEqui').attr("readonly","readonly");
      $('#facContInd').attr("readonly","readonly");
      $('#facConPac').attr("readonly","readonly");
      $('#facContTec').attr("readonly","readonly");
      $('#facConGer').attr("readonly","readonly");
      $('#facContOrg').attr("readonly","readonly");
      $('#DanosP').attr("readonly","readonly");
      $('#prevenible').attr("readonly","readonly");
    }else{
      $('#clasificacionI').removeAttr('readonly');
      $('#fechaA').removeAttr('readonly');
      $('#investigacion').removeAttr('readonly');
      $('#conclusiones').removeAttr('readonly');
      $('#accionesI').removeAttr('readonly');
      $('#facContAmb').removeAttr('readonly');
      $('#facContEqui').removeAttr('readonly');
      $('#facContInd').removeAttr('readonly');
      $('#facConPac').removeAttr('readonly');
      $('#facContTec').removeAttr('readonly');
      $('#facConGer').removeAttr('readonly');
      $('#facContOrg').removeAttr('readonly');
      $('#DanosP').removeAttr('readonly');
      $('#prevenible').removeAttr('readonly');
    }
  }
  
  
  $(".UpperCase").on("keypress", function () {
    $input = $(this);
    setTimeout(function () {
      $input.val($input.val().toUpperCase());
    }, 50);
  });

  $(".chosen-select").chosen({
    
    allow_single_deselect: true
  })

  $(
    "input[type=text], input[type=email], input[type=password], checkbox, select, select2, input[type=number]"
  ).on("change", function (event) {
    $("#" + event.target.id).removeClass("brc-danger");
  });
});
