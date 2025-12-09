$(function () {
	cargar_listado();

	function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de Procesos.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/a_procesos/listar_tabla",{}, function(data_carg){
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
	      Swal.close();
	       $('[data-toggle="tooltip"]').tooltip();
	    });
  	}

  	$(document).on("click", function(event){
	    var datos = event.target.id.split("_");
	    var dato = event.target.id;

	    
	    if(datos[0] == "btneditar") {
	      idreg = datos[1];
	      $('#newModalLabel').html('Modificar Proceso');
	      
	      $.post("/a_procesos/modificar",{idreg: ""+idreg+""}, function(data_preg){
        

	        $('#idregistro').val(data_preg['procesos'].id_proceso);

	        $("#macroprocesos_procesos").val(data_preg['procesos'].id_macroproceso);
	        $("#macroprocesos_procesos").change();	

	        $("#nombre").val(data_preg['procesos'].nombre);
	        $("#prefijo").val(data_preg['procesos'].prefijo);
	        $("#objetivo").val(data_preg['procesos'].objetivo);

	        $('#div_estado').css("display", "flex");
	        $("#estado").val(data_preg['procesos'].estado);
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
	            	$.post("/a_procesos/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
	      
	      $.post("/a_procesos/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
	        //alert(data_carg);
	        $("#modalForm1").html(data_carg);
	      });

	      $('#view-registro').modal({
	        show: true,
	        keyboard: false
	      });
	      return false;
	    }

	    if(datos[0]=="btnverdoctransversales"){
	    	idmacro=datos[1];

	    	$.post("/a_procesos/listar_documentos",{idmacro: ""+idmacro+""}, function(data_carg){
					$('#modaldoc_body').modal('hide');
		        
		      $('#modaldoc_body').html(data_carg);

				});

	    	$('#listdoc_modal').modal({
	        show: true,
	        keyboard: false
	      });
	    }

	    if(datos[0] == "btnverdocumentos") {
	      idreg = datos[1];
	      idreg2 = datos[2];
	      idreg3 = datos[3];
	      
	      $.post("/a_procesos/listar_documentos",{idreg: ""+idreg+"",idreg2: ""+idreg2+"",idreg3: ""+idreg3+""}, function(data_carg){
	        $('#modaldoc_body').modal('hide');
	        
	        $('#modaldoc_body').html(data_carg);
	      });

	      $('#listdoc_modal').modal({
	        show: true,
	        keyboard: false
	      });
	      return false;
	    }

	    if(datos[0] == "btntipodocumentos") {
	      idreg = datos[1];
	      idreg2 = datos[2];
	      Idreg3 = datos[3];

	      $.post("/a_procesos/cargar_tiposDocumentos",{idreg: ""+idreg+"",idreg2: ""+idreg2+""}, function(data_carg){
	        $('#modaltipo_body').modal('hide');
	        
	        $('#modaltipo_body').html(data_carg);
	      });

	      $('#listtipos_modal').modal({
	        show: true,
	        keyboard: false
	      });
	      return false;
	    }

	    if(datos[0] == "btnversubprocesos") {
	      idproc = datos[1];
	      
	      $.post("/a_procesos/cargar_subprocesos",{idproc: ""+idproc+""}, function(data_carg){
	        // alert(data_carg);
	        $('#modal_body').modal('hide');
	        
	        $('#modal_body').html(data_carg);
	        
	      });

	        $('#Subprocesos_modal').modal({
		        show: true,
		        keyboard: false
		      });
	     
	      return false;
	    }


	    if(dato == "btn_guardar") {
	      var ban=0;
	      var texto='';
	      if( ($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#prefijo').val()=="" ){
	        $('#prefijo').addClass("brc-danger");
	        texto=texto+"* El prefijo es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#macroprocesos_procesos').val()=="" ){
	        $('#macroprocesos_procesos').addClass("brc-danger");
	        texto=texto+"* El Macroproceso es obligatorio!";
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
	        $.post("/a_procesos/guardar", datos_form , function(data_form){
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

	  	if(dato == "btn_nuevo_proceso") {
	  		$('#newModalLabel').html('Nuevo Proceso');
	  		$('#btn_guardar').css("display", "block");
	      	$('#btn_actualizar').css("display", "none");
	      	$('#div_estado').css("display", "none");
	      	$("#form_guardar")[0].reset();
	  	}

	  	if(dato == "btn_actualizar") {
	      var ban=0;
	      var texto='';
	      if( ($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#prefijo').val()=="" ){
	        $('#prefijo').addClass("brc-danger");
	        texto=texto+"* El prefijo es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#macroprocesos_procesos').val()=="" ){
	        $('#macroprocesos_procesos').addClass("brc-danger");
	        texto=texto+"* El macroprocesos es obligatorio!";
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
	        $.post("/a_procesos/actualizar", datos_form , function(data_form){
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
	  		window.open('/a_procesos/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/a_procesos/excel','_blank');
	  	}
  	});

	$('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");    
	});

});