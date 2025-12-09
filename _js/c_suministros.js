$(function () {

	// $('#tiempoQx').inputmask("99:99");
	// $('#procedimientoscx_costos').select2();
	// $('#procedimientoscx_costos').trigger('change');
	
	cargar_listado();


	function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de suministros.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/cc_suministros/listar_tabla",{}, function(data_carg){
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
	      $('#newModalLabel').html('Modificar suministros');
	      
	      $.post("/cc_suministros/modificar",{idreg: ""+idreg+""}, function(data_preg){
        

	        $('#idregistro').val(data_preg['suministros'].id_suministro);

	        $('#codigo').val(data_preg['suministros'].codigo);
	        $('#nombre').val(data_preg['suministros'].nombre);

	        $('#categoria').val(data_preg['suministros'].categoria);
	        $('#categoria').change();

	        $('#precio').val(data_preg['suministros'].precio);

	        $('#div_estado').css("display", "flex");
	        $("#estado").val(data_preg['suministros'].estado);
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
	            	$.post("/cc_suministros/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
	      
	      $.post("/cc_suministros/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
	      
	      if( $('#codigo').val()=="" ){
	        $('#codigo').addClass("brc-danger");
	        texto=texto+"* El Código es obligatorio!<br>";
	        ban=1;
	      }
	      if($('#nombre').val()==""){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#categoria').val()=="" ){
	        $('#categoria').addClass("brc-danger");
	        texto=texto+"* La Categoria es obligatorio!";
	        ban=1;
	      }
	      if( $('#precio').val()=="" ){
	        $('#precio').addClass("brc-danger");
	        texto=texto+"* El Precio es obligatorio!";
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
	        $.post("/cc_suministros/guardar", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
	            //jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro ingresado correctamente!",
	                icon: "success"
	              })
	              .then((willDelete) => {
	              	
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

	  	if(dato == "btn_nuevo_suministro") {
	  		$('#newModalLabel').html('Nuevo Insumo');
	  		$('#btn_guardar').css("display", "block");
	      	$('#btn_actualizar').css("display", "none");
	      	$('#div_estado').css("display", "none");
	      	$("#form_guardar")[0].reset();
	  	}

	  	if(dato == "btn_actualizar") {
	      	var ban=0;
	      	var texto='';

	      	if( $('#codigo').val()=="" ){
		        $('#codigo').addClass("brc-danger");
		        texto=texto+"* El Código es obligatorio!<br>";
		        ban=1;
	      	}

		    if($('#nombre').val()==""){
		        $('#nombre').addClass("brc-danger");
		        texto=texto+"* El nombre es obligatorio!<br>";
		        ban=1;
		    }

	      	if( $('#categoria').val()=="" ){
		        $('#categoria').addClass("brc-danger");
		        texto=texto+"* La Categoria es obligatorio!";
		        ban=1;
	      	}

	      	if( $('#precio').val()=="" ){
		        $('#precio').addClass("brc-danger");
		        texto=texto+"* El Precio es obligatorio!";
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
	        $.post("/cc_suministros/actualizar", datos_form , function(data_form){
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
	  		window.open('/cc_suministros/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/cc_suministros/excel','_blank');
	  	}
  	});

	$('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");    
	});

});