$(function () {

	
	$("#valor_salario").inputmask("999.999.999");
	$('#cargos_costos').select2();
	$('#cargos_costos').trigger('change');

	cargar_listado();


	function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de Costos Mano Obra Planta.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/cc_manoobraplanta/listar_tabla",{}, function(data_carg){
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

  	$(document).on("click", function(event){
	    var datos = event.target.id.split("_");
	    var dato = event.target.id;
	    
	    if(datos[0] == "btneditar") {
	      idreg = datos[1];
	      $('#newModalLabel').html('Modificar Costo Mano Obra Planta');
	      
	      $.post("/cc_manoobraplanta/modificar",{idreg: ""+idreg+""}, function(data_preg){
        

	        $('#idregistro').val(data_preg['mano_obra_planta'].id_manoobra);

	        $("#periodo").val(data_preg['mano_obra_planta'].periodo);
	        $("#cargos_costos").val(data_preg['mano_obra_planta'].id_cargo);
	        $("#cargos_costos").change();
	        $("#numero_cargos").val(data_preg['mano_obra_planta'].numero_cargos);	        
	        $("#valor_salario").val(data_preg['mano_obra_planta'].valor_salario);
	        $("#valor_parafiscales").val(data_preg['mano_obra_planta'].valor_parafiscales);
	        $("#valor_pension").val(data_preg['mano_obra_planta'].valor_pension);
	        $("#valor_salud").val(data_preg['mano_obra_planta'].valor_salud);
	        $("#valor_arl").val(data_preg['mano_obra_planta'].valor_arl);
	        $("#valor_cesantias").val(data_preg['mano_obra_planta'].valor_cesantias);
	        $("#valor_prima").val(data_preg['mano_obra_planta'].valor_prima);
	        $("#valor_vacaciones").val(data_preg['mano_obra_planta'].valor_vacaciones);
	        $("#valor_icesantias").val(data_preg['mano_obra_planta'].valor_icesantias);
	        $("#valor_auxtrasporte").val(data_preg['mano_obra_planta'].valor_auxtrasporte);
	        $("#valor_dotacion").val(data_preg['mano_obra_planta'].valor_dotacion);

	        $('#div_estado').css("display", "flex");
	        $("#estado").val(data_preg['mano_obra_planta'].estado);
	        $("#estado").change();
	      });

	      $('#btn_guardar').css("display", "none");
	      $('#btn_actualizar').css("display", "block");
	      
	      $('#newModal').modal({
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
	            	$.post("/cc_manoobraplanta/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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

	    if(datos[0] == "btndetalle") {
	      idreg = datos[1];
	      
	      $.post("/cc_manoobraplanta/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
	      
	      if( $('#periodo').val()=="" ){
	        $('#periodo').addClass("brc-danger");
	        texto=texto+"* El periodo es obligatorio!<br>";
	        ban=1;
	      }
	      if( ($('#cargos_costos').val()=="")){
	        $('#cargos_costos').addClass("brc-danger");
	        texto=texto+"* El Cargo es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#numero_cargos').val()=="" ){
	        $('#numero_cargos').addClass("brc-danger");
	        texto=texto+"* La Numero de Cargos es obligatorio!";
	        ban=1;
	      }
	      if( $('#valor_salario').val()=="" ){
	        $('#valor_salario').addClass("brc-danger");
	        texto=texto+"* El Valor salario Qx es obligatorio!";
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
	        $.post("/cc_manoobraplanta/guardar", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
	            //jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro ingresado correctamente!",
	                icon: "success"
	              })
	              .then((willDelete) => {
	              	$("#cargos_costos").val('');
			        $("#numero_cargos").val('');	        
			        $("#valor_salario").val('');
			        $("#valor_parafiscales").val('');
			        $("#valor_pension").val('');
			        $("#valor_salud").val('');
			        $("#valor_arl").val('');
			        $("#valor_cesantias").val('');
			        $("#valor_prima").val('');
			        $("#valor_vacaciones").val('');
			        $("#valor_icesantias").val('');
			        $("#valor_auxtrasporte").val('');
			        $("#valor_dotacion").val('');

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

	  	if(dato == "btn_nueva_manoobra") {
	  		$('#newModalLabel').html('Nuevo Costo Mano Obra Planta');
	  		$('#btn_guardar').css("display", "block");
	      	$('#btn_actualizar').css("display", "none");
	      	$('#div_estado').css("display", "none");
	      	$("#form_guardar")[0].reset();
	  	}

	  	if(dato == "btn_actualizar") {
	      var ban=0;
	      var texto='';

	     		if( $('#periodo').val()=="" ){
	        $('#periodo').addClass("brc-danger");
	        texto=texto+"* El periodo es obligatorio!<br>";
	        ban=1;
	      }
	      if( ($('#cargos_costos').val()=="")){
	        $('#cargos_costos').addClass("brc-danger");
	        texto=texto+"* El Cargo es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#numero_cargos').val()=="" ){
	        $('#numero_cargos').addClass("brc-danger");
	        texto=texto+"* La Numero de Cargos es obligatorio!";
	        ban=1;
	      }
	      if( $('#valor_salario').val()=="" ){
	        $('#valor_salario').addClass("brc-danger");
	        texto=texto+"* El Valor salario Qx es obligatorio!";
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
	        var datos_form = $("#form_guardar").serialize();
	        $.post("/cc_manoobraplanta/actualizar", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
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
	            Swal.fire("¡Error!", data_form, "error");
	          }
	        });      
	        return false;
	      }
	      return false;
	  	}

	  	if(dato == "btn_pdf") {
	  		window.open('/cc_manoobraplanta/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/cc_manoobraplanta/excel','_blank');
	  	}
  	});

	$('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");    
	});

});