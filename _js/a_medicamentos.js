$(function () {
	const fechaActual = new Date();

	$('#div_otraentidad').css("display", "none");
	$('#div-fecha').css("display", "none");

	let stip = 0;

	if ($('#opc_pag').val() == "reportes") {
		cargar_listado();

		function cargar_listado() {
			Swal.fire({
				title: "Por favor espere!",
				text: "Cargando lista de Agendamiento Quirurgico.",
				showConfirmButton: false
			});

			$.post("/citas_medicamentos/listar_tabla", {}, function (data_carg) {
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
	} else if ($('#opc_pag').val() == "index") {
		////////////####### inicio smartwizard ########///////////////
		

		const holidays = ['2024-08-07', '2024-08-19', '2024-10-14', '2024-11-04', '2024-11-11','2024-12-25', '2025-01-01','2025-01-06', '2025-03-24', '2025-04-17', '2024-04-18', '2025-05-01','2025-06-02', '2025-06-23', '2025-06-30','2025-08-07', '2025-08-18', '2025-10-13', '2025-11-03', '2025-11-17','2025-12-08','2024-12-25']; // Agrega tus festivos aquí

        flatpickr("#fecha1", {
        	minDate: fechaActual,
            disable: [
                function(date) {
                    return holidays.includes(date.toISOString().split('T')[0])
                        || date.getDay() === 0
                        || (date - new Date()) / (1000 * 60 * 60 * 24) <= 3 && (date - new Date()) / (1000 * 60 * 60 * 24) > -1;
                }
            ]
        });

        flatpickr("#fecha2", {
        	minDate: fechaActual,
            disable: [
                function(date) {
                    return holidays.includes(date.toISOString().split('T')[0])
                        || date.getDay() === 0
                        || (date - new Date()) / (1000 * 60 * 60 * 24) <= 3 && (date - new Date()) / (1000 * 60 * 60 * 24) > -1;
                }
            ]
        });

        flatpickr("#fecha3", {
        	minDate: fechaActual,
            disable: [
                function(date) {
                    return holidays.includes(date.toISOString().split('T')[0])
                        || date.getDay() === 0
                        || (date - new Date()) / (1000 * 60 * 60 * 24) <= 3 && (date - new Date()) / (1000 * 60 * 60 * 24) > -1;
                }
            ]
        });


		$("#smartwizard").on("leaveStep", function (e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
			// Validate only on forward movement  
			if (stepDirection == 'forward') {
				let form = document.getElementById('form-' + (currentStepIdx + 1));
				stip = currentStepIdx + 1;
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
		$("#smartwizard").on("showStep", function (e, anchorObject, stepIndex, stepDirection, stepPosition) {
			$("#prev-btn").removeClass('disabled').prop('disabled', false);
			$("#next-btn").removeClass('disabled').prop('disabled', false);
			if (stepPosition === 'first') {
				$("#prev-btn").addClass('disabled').prop('disabled', true);
			} else if (stepPosition === 'last') {
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
				animation: 'none'
			},
			toolbar: {
				showNextButton: false, // show/hide a Next button
				showPreviousButton: false, // show/hide a Previous button
				position: 'bottom', // none/ top/ both bottom

				extraHtml: 
				`<button class="btn btn-outline-secondary sw-btn-prev sw-prev radius-l-1 mr-2px" id="prev-btn"><i class="fa fa-arrow-left mr-15" id="prev-btn"></i> Anterior</button>
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

		$("#state_selector").on("change", function () {
			$('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
			return true;
		});

		$("#style_selector").on("change", function () {
			$('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
			return true;
		});

		////////////####### fin smartwizard ########///////////////
	} else if ($('#opc_pag').val() == "listado") {
		cargar_listado();

		function cargar_listado() {
			Swal.fire({
				title: "Por favor espere!",
				text: "Cargando lista de Solicitudes de administracion de medicamentos.",
				showConfirmButton: false
			});

			$.post("/citas_medicamentos/listar_tabla", {}, function (data_carg) {
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
	} else if ($('#opc_pag').val() == "gestion") {

		$('#div_archivoEvCierre').css("display", "none");

	}else if ($('#opc_pag').val() == "reporte"){

		Swal.fire({
				title: "Por favor espere!",
				text: "Cargando lista General de Solicitudes de administración de medicamentos.",
				showConfirmButton: false
			});
			$.post("/citas_medicamentos/listar_reporte", {}, function (data_carg) {
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

	$(document).on("click", function (event) {
		
		var datos = event.target.id.split("_");
		var dato = event.target.id;
		
		if (dato == "btn_excel") {
	      	$('#view-excel').modal({
        		show: true,
        		keyboard: false
      	 	});
      		// alert(idmes);
      		
	      		      		      
	      	//window.open("/citas_medicamentos/excel/" + fecha, "_blank");
	    }

	    if (dato == "btn_generar") {
	    	let filMes = $("#meses").val().split("-");
	    	let filEstado = $("#filestado").val();

	    	let fecha = "";

	    	if(filMes!=""){
	    		fecha = filMes;	    		
	    	}else {
	    		fecha = "";
	    		var texto = "No ha seleccionado un mes para el informe, por lo tanto generara un reporte general";
	    		Swal.fire("¡Atención!", texto, "warning");
	    	}
	    	
	    	window.open("/citas_medicamentos/excel/?fecha="+ fecha +" &$filestado="+filEstado, "_blank")
	    }

	    if (datos[0] == "btnverpfd"){
	    	var idreg = dato.substr(10);
	    	var pdfUrl = "https://ceciminsigca.com/"+idreg+"";
	    	// alert(idreg);
	    	if(idreg !=""){
	    		$('#pdfIframe').attr('src', pdfUrl);
           	 	
           	 	$('#pdfModal').modal({
			        show: true,
			        keyboard: false
			    });        
	    	}          

	    }

	    if(dato =="btn_cerrar"){		

			window.open('/citas_medicamentos/listado', '_parent');		
		}

		if (datos[0] == "btndetalle") {
			idreg = datos[1];

			$.post('/citas_medicamentos/ver_registro', { idreg: "" + idreg + "" }, function (data_carg) {

				$("#modalForm1").html(data_carg);
			});

			$('#view-registro').modal({
				show: true,
				keyboard: false
			});
			return false;
		}

		if (dato == "btnFinish") {

			if ($('#poli_protdatos').val() == "on") {
				$('#txtpolitica').val('1');
			} else {
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

		if (dato == "btnCancel") {
			// Reset wizard
			$('#smartwizard').smartWizard("reset");

			// Reset form
			document.getElementById("form-1").reset();
			document.getElementById("form-2").reset();
			document.getElementById("form-3").reset();

			window.open('https://cecimin.com.co/', '_parent');
		}

		if (dato == "next-btn") {
			// alert(stip);
			if (stip == 1) {
				$('#txttipod').val($('#tipoide').val());
				$('#txtcedula').val($('#cedula').val());
				$('#txtnombres').val($('#nombres').val());
				$('#txttelefono').val($('#telefono').val());
				$('#txtemail').val($('#email').val());
				$('#txtorden_medica').val($('#orden_medica').val());
			} else if (stip == 2) {
				// alert(stip);
				$('#txtfecha1').val($('#fecha1').val());
				$('#txtjornada1').val($('#jornada1').val());
				$('#txtfecha2').val($('#fecha2').val());
				$('#txtjornada2').val($('#jornada2').val());
				$('#txtfecha3').val($('#fecha3').val());
				$('#txtjornada3').val($('#jornada3').val());
				$('#txtcondicion').val($('#condicion').val());
			}
		}

		if (datos[0] == "btngestionar") {
			id_cont = datos[1];
			window.open('/citas_medicamentos/gestion/' + id_cont, '_parent');
		}

		if(dato =="btn_reporte"){		

			window.open('/citas_medicamentos/reporte', '_parent');		
		}

		if (dato == "btn_guardar_gestion") {
			let ban = 0;
			let texto = '';

			if ($('#estado').val() == "2") {

				if (($('#fechap').val() == "")) {
					$('#fechap').addClass("brc-danger");
					texto = texto + "* La fecha programación es obligatoria!<br>";
					ban = 1;
				}

				if (($('#horap').val() == "")) {
					$('#horap').addClass("brc-danger");
					texto = texto + "* La Hora programación es obligatoria!<br>";
					ban = 1;
				}

				// if ($('#observaciones').val() == "") {
				// 	$('#observaciones').addClass("brc-danger");
				// 	texto = texto + "* Las Observaciones de programación son obligatorias!<br>";
				// 	ban = 1;
				// }			

				if (ban == 1) {
					Swal.fire("¡Atención!", texto, "warning");
				} else {

					guardar_gestion();
				}
				return false;
			} else if ($('#estado').val() == "0") {

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
			url: "/citas_medicamentos/guardar",
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
					.then(() => {
						window.open('https://cecimin.com.co/', '_parent');
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
			url: "/citas_medicamentos/guardar_gestion",
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
					.then(() => {
						window.open('/citas_medicamentos/listado', '_parent');
					});
			} else {
				Swal.fire("¡Error!", res, "error");
			}
		});
		return false;
	}

	$(document).on("change", function (event) {
		var dato = event.target.id;

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

		if (dato == "motivo") {
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
		if(dato == "estado"){
			if ($('#estado option:selected').val() == 0){

				$('#div_archivoEvCierre').css("display", "flex");

			}
		}


		if (dato = "servicio") {
			// $('#servicio').val($('#servicio option:selected').val());
		}
	});

	$(".UpperCase").on("keypress", function () {
		$input = $(this);
		setTimeout(function () {
			$input.val($input.val().toUpperCase());
		}, 50);
	});

	$('#orden_medica').aceFileInput({

	  btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
	  btnChooseText: 'Seleccionar',
	  placeholderText: 'Seleccione el Archivo origen',
	  placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
	  allowExt:'gif|jpg|jpeg|png|webp|svg|pdf'
	})

    $('#anexocierre').aceFileInput({      
      btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
      btnChooseText: 'Seleccionar',
      placeholderText: 'Seleccione el Archivo Anexo',
      placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
      allowExt:'gif|jpg|jpeg|png|webp|svg|pdf'
    })

	$('input[type=text], input[type=email], input[type=password], checkbox, select, select2, input[type=number]').on("change", function (event) {
		$('#' + event.target.id).removeClass("brc-danger");
	});


});