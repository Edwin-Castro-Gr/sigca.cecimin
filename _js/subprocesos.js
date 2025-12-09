$(function () {
	cargar_listado();
	$('#empleados_subprocesos').select2({width: "100%"});
	$('#procesos_subprocesos').select2({width: "100%"});

	function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de Subprocesos.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/a_subprocesos/listar_tabla",{}, function(data_carg){
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
	      $('#newModalLabel').html('Modificar Subproceso');
	      
	      $.post("/a_subprocesos/modificar",{idreg: ""+idreg+""}, function(data_preg){
        
	      	
	        $('#idregistro').val(data_preg['subprocesos'].id_subproceso);

	        $('#prefijo').val(data_preg['subprocesos'].pref_subproceso);
	        $('#procesos_subprocesos').val(data_preg['subprocesos'].id_proceso);
	        $('#procesos_subprocesos').change();	

	        $('#nombre').val(data_preg['subprocesos'].nombre);

	        $('#empleados_subprocesos').val(data_preg['subprocesos'].id_responsable);
        	$('#empleados_subprocesos').change();	

	        $('#div_estado').css("display", "flex");
	        $('#estado').val(data_preg['subprocesos'].estado);
	        $('#estado').change();
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
	            	$.post("/a_subprocesos/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
	      
	      $.post("/a_subprocesos/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
	      if($('#prefijo').val()=="") {
	        $('#prefijo').addClass("brc-danger");
	        texto=texto+"* El prefijo es obligatorio!<br>";
	        ban=1;
	      }
	      if($('#nombre').val()=="") {
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#procesos_subprocesos').val()=="" ){
	        $('#procesos_subprocesos').addClass("brc-danger");
	        texto=texto+"* El proceso es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#empleados_subprocesos').val()=="" ){
	        $('#empleados_subprocesos').addClass("brc-danger");
	        texto=texto+"* El Responsable es obligatorio!";
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
	        $.post("/a_subprocesos/guardar", datos_form , function(data_form){
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
	              	$('#newModal').modal('hide');   
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

	  	if(dato == "btn_nuevo_subproceso") {
	  		$('#newModalLabel').html('Nuevo Subproceso');
	  		$('#btn_guardar').css("display", "block");
	      	$('#btn_actualizar').css("display", "none");
	      	$('#div_estado').css("display", "none");
	      	$("#form_guardar")[0].reset();
	  	}

	  	if(dato == "btn_actualizar") {
	      var ban=0;
	      var texto='';
	      if($('#prefijo').val()=="") {
	        $('#prefijo').addClass("brc-danger");
	        texto=texto+"* El prefijo es obligatorio!<br>";
	        ban=1;
	      }
	      if(($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#procesos_subprocesos').val()=="" ){
	        $('#procesos_subprocesos').addClass("brc-danger");
	        texto=texto+"* El proceso es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#empleados_subprocesos').val()=="" ){
	        $('#empleados_subprocesos').addClass("brc-danger");
	        texto=texto+"* El Responsable es obligatorio!";
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
	        $.post("/a_subprocesos/actualizar", datos_form , function(data_form){
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
	  		window.open('/a_subprocesos/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/a_subprocesos/excel','_blank');
	  	}
  	});

	$(".UpperCase").on("keypress", function () {
	  $input=$(this);
	  setTimeout(function () {
	   $input.val($input.val().toUpperCase());
	  },50);
	 })

	$('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");    
	});

});