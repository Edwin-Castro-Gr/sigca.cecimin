
$(function () {

	$('#div_otraentidad').css("display", "none"); 
	$('#div-fecha').css("display", "none"); 

	let stip = 0;
	let txtmotivo ='';
	let txtservicio ='';
	let txtmensaje ='';
	let txtnombres ='';
	let txtapellidos='';
	let txtdocumento='';
	let txtdireccion='';
	let txtemail='';
	let txttelefono='';
	let txtentidad='';
	let txtotraentidad='';

	if ($('#opc_pag').val() == "reportes") {
		cargar_listado();

		function cargar_listado() {
	    Swal.fire({
	        title: "Por favor espere!",
	        text: "Cargando lista de Agendamiento Quirurgico.",
	        showConfirmButton: false
	    });

	    $.post("/contactenos/listar_tabla", {}, function (data_carg) {
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
	}else if ($('#opc_pag').val() == "index"){
	////////////####### inicio smartwizard ########///////////////
	// Leave step event is used for validating the forms
        $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
            // Validate only on forward movement  
            if (stepDirection == 'forward') {
              let form = document.getElementById('form-' + (currentStepIdx + 1));
              stip=currentStepIdx+1;
              if (form) {
                if (!form.checkValidity()) {
                  form.classList.add('was-validated');
                  $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                  $("#smartwizard").smartWizard('fixHeight');
                  return false;
                }
                $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
              }
            }
        });

        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            if(stepPosition === 'first') {
                $("#prev-btn").addClass('disabled').prop('disabled', true);
            } else if(stepPosition === 'last') {
                $("#next-btn").addClass('disabled').prop('disabled', true);
            } else {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
            }

            // Get step info from Smart Wizard
            let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
            $("#sw-current-step").text(stepInfo.currentStep + 1);
            $("#sw-total-step").text(stepInfo.totalSteps);

            if (stepPosition == 'last') {
              
              $("#btnFinish").prop('disabled', false);
            } else {
              $("#btnFinish").prop('disabled', true);
            }

            // Focus first name
            if (stepIndex == 1) {
              setTimeout(() => {
                $('#mensaje').focus();
              }, 0);
            }
        });

        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            // autoAdjustHeight: false,
            theme: 'arrows', // basic, arrows, square, round, dots
            transition: {
              animation:'none'
            },
            toolbar: {
              showNextButton: false, // show/hide a Next button
              showPreviousButton: false, // show/hide a Previous button
              position: 'bottom', // none/ top/ both bottom
              
              extraHtml: `<button class="btn btn-outline-secondary sw-btn-prev sw-prev radius-l-1 mr-2px" id="prev-btn"><i class="fa fa-arrow-left mr-15" id="prev-btn"></i> Anterior</button>
              						<button class="btn btn-outline-primary sw-btn-next sw-btn-hide sw-next radius-r-1" id="next-btn">Siguiente <i class="fa fa-arrow-right mr-15" id="next-btn"></i></button>
              						<button class="btn btn-success" id="btnFinish" disabled ">Gurdar <i class="fa fa-check mr-15" id="btnFinish"></i></button>
                          <button class="btn btn-danger" id="btnCancel" >Salir <i class="fa fa-times mr-15" id="btnCancel"></i></button>`
            },
            anchor: {
                enableNavigation: true, // Enable/Disable anchor navigation 
                enableNavigationAlways: false, // Activates all anchors clickable always
                enableDoneState: true, // Add done state on visited steps
                markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                enableDoneStateNavigation: true // Enable/Disable the done state navigation
            },
        });

        $("#state_selector").on("change", function() {
            $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
            return true;
        });

        $("#style_selector").on("change", function() {
            $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
            return true;
        });

					////////////####### fin smartwizard ########///////////////
	}else if ($('#opc_pag').val() == "gestion"){ 
	

	}
	
 	$(document).on("click", function (event) {
      var datos = event.target.id.split("_");
      var dato = event.target.id;

		if (dato == "btn_excel") {
        	window.open('/contactenos/excel', '_blank'); 						
      }

      if(datos[0] == "btndetalle") {
	      idreg = datos[1];
	      
	      $.post('/contactenos/ver_registro',{idreg: ""+idreg+""}, function(data_carg){
	        
	        	$("#modalForm1").html(data_carg);
	      });

	      $('#view-registro').modal({
	        	show: true,
	        	keyboard: false
	      });
	      return false;
	    }

	    if(dato == "btnFinish"){      	
	    	
			if($('#poli_protdatos').val() == "on"){
	    	$('#txtpolitica').val('1');
			}else{
				$('#txtpolitica').val('0');
			}

    	 	let form = document.getElementById('form-3');
    	 	
    	 	if (form) {
		    	if (!form.checkValidity()) {
			      form.classList.add('was-validated');
			      $('#smartwizard').smartWizard("setState", [3], 'error');
			      $("#smartwizard").smartWizard('fixHeight');
			      return false;
			   }
			   $('#smartwizard').smartWizard("unsetState", [3], 'error');
			}		    
		    
				guardar_datos();
				return false;
		}

	   if(dato == "btnCancel"){
	    	// Reset wizard
  			$('#smartwizard').smartWizard("reset");

			  // Reset form
			  document.getElementById("form-1").reset();
			  document.getElementById("form-2").reset();
			  document.getElementById("form-3").reset();
			  
			  window.open('https://cecimin.com.co/','_parent');
	   }  

	   if(dato == "next-btn"){
	    	// alert(stip);
	    	if(stip == 1){
	    		$('#txtmotivo').val($('#motivo').val());
	    		$('#txtservicio').val($('#servicio').val());
				$('#txtmensaje').val($('#mensaje').val());					
				$('#txtfecha_hecho').val($('#fecha_hechos').val());
				$('#txthora_hecho').val($('#hora_hechos').val());
	    	}else if(stip==2){
	    		// alert(stip);
	    		$('#txtnombres').val($('#nombres').val());
				$('#txtapellidos').val($('#apellidos').val());
				$('#txtdocumento').val($('#cedula').val());
				$('#txtdireccion').val($('#direccion').val());
				$('#txtemail').val($('#email').val());
				$('#txttelefono').val($('#fijo').val());
				$('#txtentidad').val($('#entidadpaciente').val());
				$('#txtotraentidad').val($('#otraentidad').val());
	    	}
	   }

	   if(datos[0] =="btngestionar"){
	    	id_cont = datos[1];				
	    	window.open('/contactenos/gestion/' +id_cont,'_parent');
	   }

	   if(dato =="btn_guardar_gestion"){
	    	let ban = 0;
        	let texto = '';
	      if($('#estado').val()=="2"){
	        
	        	if (($('#accion').val() == "")) {
           		$('#accion').addClass("brc-danger");
           		texto = texto + "* La Acción de Mejora es obligatoria!<br>";
           		ban = 1;
	        	}          

	        	if (ban == 1) {
	           	Swal.fire("¡Atención!", texto, "warning");
	        	} else {              
	             
            	guardar_gestion();
	        	}
		      return false;
			}else if($('#estado').val()=="0"){

				if ($('#accion').val() == "") {
	            $('#accion').addClass("brc-danger");
	            texto = texto + "* La Acción de Mejora es obligatoria!<br>";
	            ban = 1;
		      } 

		      if ($('#observaciones').val() == "") {
	            $('#observaciones').addClass("brc-danger");
	            texto = texto + "* Las Observaciones de Cierre son obligatorias!<br>";
	            ban = 1;
	        	} 
		      if (ban == 1) {
		         Swal.fire("¡Atención!", texto, "warning");
		      } else { 
		         guardar_gestion();
		      }
		        return false;
	    	}
	    	return false;
	  	}	    
	  	
	});

  function guardar_datos() {
        Swal.fire({
            title: "¡Atención!",
            text: "Enviando Información...!",
            icon: "warning",
            showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form-3"));

        $.ajax({
            url: "/contactenos/guardar",
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

  function guardar_gestion() {
        Swal.fire({
            title: "¡Atención!",
            text: "Guardando Información...!",
            icon: "warning",
            showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_gestion"));

        $.ajax({
            url: "/contactenos/guardar_gestion",
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
               window.open('/contactenos/reporte','_parent');            
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

  $(document).on("change", function (event) {
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    var ck= event.target.checked;

    if (dato == "entidadpaciente") {
    	// alert($('#entidadpaciente option:selected').val());
        if ($('#entidadpaciente option:selected').val() == 4) {
					document.getElementById("div_otraentidad").style.display = "flex";  
          $("#smartwizard").smartWizard('fixHeight');     
                        
        } else {
        	document.getElementById('div_otraentidad').style.display = "none";
          $("#smartwizard").smartWizard('fixHeight');               
        }
    }

    if(dato =="motivo"){
    	// $('#idmotivo').val($('#motivo option:selected').val());     
    	// alert($("#idmotivo").val());
    	if ($('#motivo option:selected').val() == 2 || $('#motivo option:selected').val() == 3) {
    		// alert($('#motivo option:selected').val());
          document.getElementById("div-fecha").style.display = "flex";  
          $("#smartwizard").smartWizard('fixHeight');
           
        } else {
        	// alert($('#motivo option:selected').val());	
        	document.getElementById('div-fecha').style.display = "none";        	
        	$("#smartwizard").smartWizard('fixHeight');                            
        }
    }


    if(dato = "servicio"){
    	// $('#servicio').val($('#servicio option:selected').val());
    }
  });

    $(".UpperCase").on("keypress", function () {
		 $input=$(this);
		setTimeout(function () {
		$input.val($input.val().toUpperCase());
		},50);
	});

	$('#ordenmed').aceFileInput({
      
      btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
      btnChooseText: 'Seleccionar',
      placeholderText: 'Seleccione el Archivo de la Orden Médica',
      placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
      allowExt:'pdf'
    })

	
    $('input[type=text], input[type=email], input[type=password], checkbox, select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });


});