$(function () {


$('#div_otraentidad').css("display", "none"); 

if ($('#opc_pag').val() == "reportes") {
	cargar_listado();

	function cargar_listado() {
    Swal.fire({
        title: "Por favor espere!",
        text: "Cargando lista de Agendamiento Quirurgico.",
        showConfirmButton: false
    });

    $.post("/encuesta/listar_tabla", {}, function (data_carg) {
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
}else if ($('#opc_pag').val() == "index") 
{
////////////####### inicio ########///////////////

    var stepCount = $('#smartwizard-1').find('li > a').length
        var left = (100 / (stepCount * 2))
        // for example if we have **4** steps, `left` and `right` of progressbar should be **12.5%**
        // so that before first step and after last step we don't have any lines
        $('#smartwizard-1').find('.wizard-progressbar').css({
          left: left + '%',
          right: left + '%'
        })

        // enable wizard
        var selectedStep = 0
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
                $('<button class="btn btn-outline-secondary sw-btn-prev radius-l-1 mr-2px"><i class="fa fa-arrow-left mr-15"></i> Anterior</button>'),

                $('<button class="btn btn-outline-primary sw-btn-next sw-btn-hide radius-r-1">Siguiente <i class="fa fa-arrow-right mr-15"></i></button>'),

                $('<button class="btn btn-green sw-btn-finish radius-r-1" id="btn_guardar">Guardar <i class="fa fa-check mr-15"></i></button>')
                .on('click', function() {
                  var texto = '';
            			var ban = 0;			           

			            if (($('#nombre_encuestado').val() == "")) {
			                $('#nombre_encuestado').addClass("brc-danger");
			                texto = texto + "* EL Nombre del Encuestado es obligatorio!";
			                ban = 1;
			            }
			            if ($('#cedula').val() == "") {
			                $('#cedula').addClass("brc-danger");
			                texto = texto + "* El documento de identidad es obligatoria!";
			                ban = 1;
			            }
			            
			            if (ban == 1) {
			                Swal.fire("¡Atención!", texto, "warning");
			                return false;
			            } else {
			                guardar_registro();
			            }
			            return false;
                }),
              ]
            }
          })

          .removeClass('d-none') // initially it is hidden, and we show it after it is properly rendered

          .on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // move the progress bar by increasing its size (width)
            var progress = parseInt((stepNumber + 1) * 100 / stepCount)
            var halfStepWidth = parseInt(100 / stepCount) / 2
            progress -= halfStepWidth //because for example for the first step, we don't want progressbar to move all the way to next step

            $('#smartwizard-1').find('.wizard-progressbar').css('max-width', progress + '%')

            // hide/show card toolbar buttons
            // if we are not in the first step, previous button should be enabled, otherwise disabled
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
          .on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            if (stepNumber == 0 && stepDirection == 'forward') {

              // use jQuery plugin to validate
            //   if (document.getElementById('id-validate').checked && !$('#validation-form').valid()) return false;

              // or use HTML & Bootstrap validation
              /**
        var form = document.getElementById('validation-form');
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
    
          form.classList.add('was-validated');
          return false;
        }
        */
            }
          })
          .triggerHandler('showStep', [null, selectedStep, null, null]) // move progressbar to step 1 (0 index)


        // handle `click` event of card toolbar buttons
        $('#wizard-1-prev').on('click', function() {
          $('#smartwizard-1').smartWizard('prev')
        })

        $('#wizard-1-next').on('click', function() {
          $('#smartwizard-1').smartWizard('next')
          var texto = '';
    			var ban = 0;			           
					
					if (($('#servicio').val() == "")) {
              $('#servicio').addClass("brc-danger");
              texto = texto + "* El campo servicio es obligatorio!";
              ban = 1;
          }
          
          if (($('#calificacion_1a').val() == "")) {
              $('#calificacion_1a').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else
          if ($('#calificacion_1b').val() == "") {
              $('#calificacion_1b').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else
          if ($('#calificacion_1c').val() == "") {
              $('#calificacion_1c').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else 
          if (($('#calificacion_1d').val() == "")) {
             	$('#calificacion_1d').addClass("brc-danger");
	              texto = texto + "* Existen items sin respuestas!";
	              ban = 1;
          }else 
          if (($('#calificacion_1e').val() == "")) {
             	$('#calificacion_1e').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }else
          if ($('#calificacion_1f').val() == "") {
              $('#calificacion_1f').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else
          if ($('#calificacion_2a').val() == "") {
              $('#calificacion_2a').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else               
          if ($('#calificacion_2b').val() == "") {
              $('#calificacion_2b').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else
          if ($('#calificacion_2c').val() == "") {
              $('#calificacion_2c').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else 
          if (($('#calificacion_2d').val() == "")) {
             	$('#calificacion_2d').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }else 
          if (($('#calificacion_2e').val() == "")) {
             	$('#calificacion_2e').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }else
          if ($('#calificacion_2f').val() == "") {
              $('#calificacion_2f').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else
          if ($('#calificacion_3a').val() == "") {
              $('#calificacion_3a').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else               
          if ($('#calificacion_3b').val() == "") {
              $('#calificacion_3b').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else
          if ($('#calificacion_3c').val() == "") {
              $('#calificacion_3c').addClass("brc-danger");
              texto = texto + "* Existen items sin respuestas!";
              ban = 1;
          }else 
          if (($('#calificacion_3d').val() == "")) {
             	$('#calificacion_3d').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }else 
          if (($('#calificacion_3e').val() == "")) {
             	$('#calificacion_3e').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }else
          if(($('#calificacion_4').val() == "")){
             	$('#calificacion_4').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }else
          if(($('#calificacion_5').val() == "")){
             	$('#calificacion_5').addClass("brc-danger");
				              texto = texto + "* Existen items sin respuestas!";
				              ban = 1;
          }
          
          if (ban == 1) {
              Swal.fire("¡Atención!", texto, "warning");
              return false;
          }

        })

        $('#wizard-1-finish').on('click', function() {
          //
        })
////////////####### fin ########///////////////
	}
	// cargar_listado();


	// function cargar_listado() {
	//     Swal.fire({ 
	//       title: "Por favor espere!",   
	//       text: "Cargando lista de Departamentos.",
	//       showConfirmButton: false 
	//     });
	    
	//     $.post("/a_areas/listar_tabla",{}, function(data_carg){
	//       //alert(data_carg);
	//       $("#simple-table").DataTable().destroy();
	//       $("#simple-table").empty();
	//       $("#simple-table").append(data_carg);
	//       $('#simple-table').DataTable({
	//       	"language": {
	// 	        "lengthMenu": "Mostrar _MENU_ registros por pagina",
	// 	        "zeroRecords": "No se encontraron resultados en su busqueda",
	// 	        "searchPlaceholder": "Buscar registros",
	// 	        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
	// 	        "infoEmpty": "No existen registros",
	// 	        "infoFiltered": "(filtrado de _MAX_ registros)",
	// 	        "search": "Buscar:",
	// 	        "paginate": {
	// 	            "first": "Primero",
	// 	            "last": "Último",
	// 	            "next": "Siguiente",
	// 	            "previous": "Anterior"
	// 	        },
	// 	    },
	//       	responsive: true
	//       });
	//       $('[data-toggle="tooltip"]').tooltip();
	//       Swal.close();
	//     });
  // 	}

  	// $(document).on("click", function(event){
	  //   var datos = event.target.id.split("_");
	  //   var dato = event.target.id;
	    
	  //   if(datos[0] == "btneditar") {
	  //     idreg = datos[1];
	  //     $('#newModalLabel').html('Modificar Departamento');
	      
	  //     $.post("/a_areas/modificar",{idreg: ""+idreg+""}, function(data_preg){
        
	  //       $('#idregistro').val(data_preg['areas'].id_area);
	  //       $("#codigo").val(data_preg['areas'].codigo);
	  //       $("#nombre").val(data_preg['areas'].nombre);

	  //       $('#div_estado').css("display", "flex");
	  //       $("#estado").val(data_preg['areas'].estado);
	  //       $("#estado").change();
	  //     });

	  //     $('#btn_guardar').css("display", "none");
	  //     $('#btn_actualizar').css("display", "block");
	      
	  //     $('#newModal').modal({
	  //       show: true,
	  //       keyboard: false
	  //     });
	  //   }

	  //   if(datos[0] == "btninactivar") {
	  //     //jQuery(function(){
	  //       var id_reg = datos[1];
	  //       var nom_reg = $('#nombre_'+id_reg).val();
	  //       Swal.fire({
	  //         title: "Desea Inactivar el Registro: '"+nom_reg+"' ?",
	  //         text: "Podras activarlo en cualquier momento con la edición!",
	  //         icon: "warning",
	  //         showCancelButton: true,
    //           scrollbarPadding: false,
    //           confirmButtonText: 'Si, Inactivar!',
    //           cancelButtonText: 'No, cancelar!',
    //           cancelButtonColor: '#d33',
    //           reverseButtons: false,
    //           customClass: {
    //             'confirmButton': 'btn btn-green mx-2 px-3',
    //             'cancelButton': 'btn btn-red mx-2 px-3'
    //           }
	  //       }).then(function(result) {
	  //           if (result.value) {
	  //           	$.post("/a_areas/inactivar",{idreg: ""+id_reg+""}, function(data_form){
	  //           		//alert(data_form);
	  //           		if(data_form=="1") {
		// 	              Swal.fire({
		// 	                title: 'Inactivado!',
		// 	                text: 'El registro se ha inactivado.',
		// 	                type: 'success',
		// 	                icon: 'success',
		// 	                customClass: {
		// 	                  'confirmButton': 'btn btn-info px-5'
		// 	                }
		// 	              }).then((value) => {
		// 	                cargar_listado();
		// 	              });
		// 	            } else {
		// 	            	Swal.fire("¡Error!", "Se presento el siguiente error: "+data_form, "error");
		// 	            }
		// 	        });
	  //           } else if (result.dismiss === Swal.DismissReason.cancel) {
	  //             Swal.DismissReason.cancel;
	  //           }
	  //       });
	        
	  //     return false;
	  //   }

	  //   if(datos[0] == "btndetalle") {
	  //     idreg = datos[1];
	      
	  //     $.post("/a_areas/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
	  //       //alert(data_carg);
	  //       $("#modalForm1").html(data_carg);
	  //     });

	  //     $('#view-registro').modal({
	  //       show: true,
	  //       keyboard: false
	  //     });
	  //     return false;
	  //   }

	  //   if(dato == "btn_guardar") {
	  //     var ban=0;
	  //     var texto='';
	  //     if( $('#codigo').val()=="" ){
	  //       $('#codigo').addClass("brc-danger");
	  //       texto=texto+"* El Código es obligatorio!";
	  //       ban=1;
	  //     }

	  //     if( ($('#nombre').val()=="")){
	  //       $('#nombre').addClass("brc-danger");
	  //       texto=texto+"* El nombre es obligatorio!<br>";
	  //       ban=1;
	  //     }
	      
	  //     if(ban==1) { 	
	  //       Swal.fire("¡Atención!", texto, "warning");
	  //     } else {
	  //       //alert("Datos: "+datos_form);
	  //       Swal.fire({   
	  //         title: "Por favor espere!",   
	  //         text: "Guadando la información.", 
	  //         showConfirmButton: false 
	  //       });
	  //       var datos_form = $("#form_guardar").serialize();
	  //       $.post("/a_areas/guardar", datos_form , function(data_form){
	  //         Swal.close();
	  //         if(data_form=="1") {
	  //           //jQuery(function(){
	  //             Swal.fire({
	  //               title: "¡Correcto!",
	  //               text: "Registro ingresado correctamente!",
	  //               icon: "success"
	  //             })
	  //             .then((willDelete) => {
	  //             	$("#form_guardar")[0].reset();
	  //               cargar_listado();
	  //             });
	  //           //});
	  //         } else {
	  //           Swal.fire("¡Error!", data_form, "error");
	  //         }
	  //       });      
	  //       return false;
	  //     }
	  //     return false;
	  // 	}

	  // 	if(dato == "btn_nuevo_departamento") {
	  // 		$('#newModalLabel').html('Nuevo Departamento');
	  // 		$('#btn_guardar').css("display", "block");
	  //     	$('#btn_actualizar').css("display", "none");
	  //     	$('#div_estado').css("display", "none");
	  //     	$("#form_guardar")[0].reset();
	  // 	}

	  // 	if(dato == "btn_actualizar") {
	  //     var ban=0;
	  //     var texto='';
	  //     if( $('#codigo').val()=="" ){
	  //       $('#codigo').addClass("brc-danger");
	  //       texto=texto+"* El Código es obligatorio!";
	  //       ban=1;
	  //     }

	  //     if( ($('#nombre').val()=="")){
	  //       $('#nombre').addClass("brc-danger");
	  //       texto=texto+"* El nombre es obligatorio!<br>";
	  //       ban=1;
	  //     }
	      	      
	  //     if(ban==1) { 	
	  //       Swal.fire("¡Atención!", texto, "warning");
	  //     } else {
	  //       //alert("Datos: "+datos_form);
	  //       Swal.fire({   
	  //         title: "Por favor espere!",   
	  //         text: "Actualizando la información.", 
	  //         showConfirmButton: false 
	  //       });
	  //       var datos_form = $("#form_guardar").serialize();
	  //       $.post("/a_areas/actualizar", datos_form , function(data_form){
	  //         Swal.close();
	  //         if(data_form=="1") {
	  //           //jQuery(function(){
	  //             Swal.fire({
	  //               title: "¡Correcto!",
	  //               text: "Registro actualizado correctamente!",
	  //               icon: "success"
	  //             })
	  //             .then((willDelete) => {
	  //             	$("#form_guardar")[0].reset();
	  //               cargar_listado();
	  //               $('#newModal').modal('hide');
	  //             });
	  //           //});
	  //         } else {
	  //           Swal.fire("¡Error!", data_form, "error");
	  //         }
	  //       });      
	  //       return false;
	  //     }
	  //     return false;
	  // 	}

	  // 	if(dato == "btn_pdf") {
	  // 		window.open('/a_areas/pdf','_blank');
	  // 	}

	  // 	if(dato == "btn_excel") {
	  // 		window.open('/a_areas/excel','_blank');
	  // 	}
  	
  	// });
  	// 
  	// 
  	//
	 	$(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

 				if (dato == "btn_excel") {
          window.open('/encuesta/excel', '_blank'); 						
        }

        if(datos[0] == "btndetalle") {
	      idreg = datos[1];
	      
	      $.post('/encuesta/ver_registro',{idreg: ""+idreg+""}, function(data_carg){
	        // alert(data_carg);
	        $("#modalForm1").html(data_carg);
	      });

	      $('#view-registro').modal({
	        show: true,
	        keyboard: false
	      });
	      return false;
	    }
		});

  function guardar_registro() {
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("Form_Guardar"));

        $.ajax({
            url: "/encuesta/guardar",
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
                window.open('https://cecimin.com.co/','_parent');            
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    $(".UpperCase").on("keypress", function () {
 			 $input=$(this);
  			setTimeout(function () {
   			$input.val($input.val().toUpperCase());
  			},50);
		 });

    $(document).on("change", function (event) {
      var datos = event.target.id.split("_");
      var dato = event.target.id;
      var ck= event.target.checked;

      if (dato == "entidadpaciente") {

          if ($("#entidadpaciente").val() == 4) {

              $('#div_otraentidad').css("display", "none");             
          } else {

              $('#div_otraentidad').css("display", "flex");              
          }
      }
    });

	
    $('input[type=text], input[type=email], input[type=password],  select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });


});