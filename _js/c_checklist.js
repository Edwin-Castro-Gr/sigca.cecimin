$(function () {
	cargar_listado();

	function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando checklist",
	      showConfirmButton: false 
	    });
	    
	    $.post("/c_checklist_doc/listar_tabla",{}, function(data_carg){
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
	    var ban = 1;
	    if(datos[0] == "btneditar") {
	      idreg = datos[1];
	      
	      $('#newModalLabel').html('Modificar Concepto');
	      
	      $.post("/c_checklist_doc/modificar",{idreg: ""+idreg+""}, function(data_preg){
        
	        $('#idregistro').val(data_preg['checklist'].id_checklist);
	        $("#idtipocontrato").val(data_preg['checklist'].Idtipo_contrato);
	        $("#tiposcontratos_checklist").val(data_preg['checklist'].Idtipo_contrato);
	        $("#tiposcontratos_checklist").change();
	        
	        $("#idcargo").val(data_preg['checklist'].id_cargo);
	        $("#cargos_checklist").val(data_preg['checklist'].id_cargo);
	        $("#cargos_checklist").change();

	        $("#idlistadodocumentos").val(data_preg['checklist'].listado_documentos);
	        listadoDocumentos = data_preg['checklist'].listado_documentos;
	        

	        $('#div_estado').css("display", "flex");
	        $("#estado").val(data_preg['checklist'].estado);
	        $("#estado").change();

	        $('#div_seccion2').css("display", "flex");
      		$('#div_Documentos').css("display", "none");
	        
	        $.post("/c_checklist_doc/cargar_listadoDocumemtos",{listado:""+listadoDocumentos+"",nue: ""+ban+""}, function(data_doc){
	      	  $('#div_listaDocumentos').html(data_doc);

	 				});
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
	            	$.post("/c_checklist_doc/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
	      
	      $.post("/c_checklist_doc/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
	      if( ($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }

	      if( ($('#prefijo').val()=="")){
	        $('#prefijo').addClass("brc-danger");
	        texto=texto+"* El prefijo es obligatorio!<br>";
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
	        $.post("/c_checklist_doc/guardar", datos_form , function(data_form){
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

	  	if(dato == "btn_nuevo_checklist") {
	  		$('#newModalLabel').html('Nuevo Checklist');
	  		$('#btn_guardar').css("display", "block");
      	$('#btn_actualizar').css("display", "none");
      	$('#div_seccion2').css("display", "none");
      	$('#div_Documentos').css("display", "none");
      	$('#div_estado').css("display", "none");
      	$("#form_guardar")[0].reset();

      	var ban = 0;
	      $.post("/c_checklist_doc/cargar_listadoDocumemtos",{listado:"",nue: ""+ban+""}, function(data_doc){
	      	$('#div_listaDocumentos').html(data_doc);

	 			});
	  	}

	  	if(dato == "btn_actualizar") {
	      var ban=0;
	      var texto='';

	      if( ($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }

	      if( ($('#prefijo').val()=="")){
	        $('#prefijo').addClass("brc-danger");
	        texto=texto+"* El prefijo es obligatorio!<br>";
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
	        $.post("/c_checklist_doc/actualizar", datos_form , function(data_form){
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
	  		window.open('/c_checklist_doc/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/c_checklist_doc/excel','_blank');
	  	}
			
  	});

	 	$(document).on("change", function (event) {
      var datos = event.target.id.split("_");
      var dato = event.target.id;
      var ck= event.target.checked;

      if(dato =="ck_agregar"){
      	if(ck==true){
      		$('#div_Documentos').css("display", "flex");
      		$.post("/c_checklist_doc/cargar_listadoDocumemtos1",{listado:"",nue: "0"}, function(data_doc){
		      	$('#div_Documentos').html(data_doc);
		 			});
      	}else{
      		$('#div_Documentos').css("display", "none");
      	}      
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