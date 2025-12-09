$(function () {
	cargar_listado();

	$('#lblck_materialqx').css("display", "none");
	$('#ck_materialqx').css("display", "none");
	$('#div_parte8').css("display", "none");
	$('#div_parte81').css("display", "none");
  $('#btn_nuevo_correo').css("display", "none");

	function cargar_listado() {
    Swal.fire({ 
      title: "Por favor espere!",   
      text: "Cargando lista de Terceros.",
      showConfirmButton: false 
    });
    
    $.post("/a_terceros/listar_tabla",{}, function(data_carg){
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
	$('[data-toggle="tooltip"]').tooltip();
  $(document).on("click", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    
    if(datos[0] == "btneditar") {
      idreg = datos[1];
      var regd = '0';

      $('#newModalLabel').html('Modificar Terceros');
      
      $.post("/a_terceros/modificar",{idreg: ""+idreg+""}, function(data_preg){
      	$('#idregistro').val(data_preg['terceros'].id_tercero);
        $('#materialqx').val(data_preg['terceros'].materialesqx);
        $('#tipo_tercero').val(data_preg['terceros'].tipo_tercero);
        if($('#tipo_tercero').val()=="0"){
        	$('#ck_materialqx').css('display','block');  
        	if($('#materialqx').val() !== "0" ){     
          	// document.getElementById("ck_materialqx").checked=true;
        	 	// $('#ck_materialqx').prop("checked",true);         	 	
        	 	$('#div_parte8').css("display", "block");
       			$('#div_parte81').css("display", "block");
       			$('#btn_nuevo_correo').css("display", "block");
        		$.post("a_terceros/cargar_correos",{regd:""+regd+"",idreg: ""+idreg+""},function	(data_correo){
							$("#accordioAdiCorreos").empty();
							$("#accordioAdiCorreos").append(data_correo);
						});
						
      		}      	
        }
        
        $("#Tipo_docidentidad_terceros").val(data_preg['terceros'].tipo_documento);
        $("#Tipo_docidentidad_terceros").change();

        $("#numeroid").val(data_preg['terceros'].numero_id);
        $("#razonsocial").val(data_preg['terceros'].razon_social);
        $("#nombre_contacto").val(data_preg['terceros'].nombre_contacto);
        $("#telefono_contacto").val(data_preg['terceros'].telefono_contacto);
        $("#correo_contacto").val(data_preg['terceros'].correo_contacto);
        $("#sigla").val(data_preg['terceros'].sigla);
        
        $("#proveedor_critico").val(data_preg['terceros'].proveedor_critico);
        $("#proveedor_critico").change();

        $('#div_estado').css("display", "flex");
        $("#estado").val(data_preg['terceros'].estado);
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
            	$.post("/a_terceros/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
      
      $.post("/a_terceros/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
      if( ($('#numeroid').val()=="")){
        $('#numeroid').addClass("brc-danger");
        texto=texto+"* El numero de identificacion del tercero es obligatorio!<br>";
        ban=1;
      }
      if( $('#razonsocial').val()=="" ){
        $('#razonsocial').addClass("brc-danger");
        texto=texto+"* El Nombre o razón social es obligatorio!";
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
        $.post("/a_terceros/guardar", datos_form , function(data_form){
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

  	if(dato == "btn_nuevo_tercero") {
  		
  		$('#newModalLabel').html('Nuevo Tercero');
  		$('#btn_guardar').css("display", "block");
      	$('#btn_actualizar').css("display", "none");
      	$('#div_estado').css("display", "none");
      	$("#form_guardar")[0].reset();

    }

  	if(dato == "btn_actualizar") {
      var ban=0;
      var texto='';
      if( ($('#numeroid').val()=="")){
        $('#numeroid').addClass("brc-danger");
        texto=texto+"* El numero de identificacion del tercero es obligatorio!<br>";
        ban=1;
      }
      if( $('#razonsocial').val()=="" ){
        $('#razonsocial').addClass("brc-danger");
        texto=texto+"* El Nombre o razón social es obligatorio!";
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
        $.post("/a_terceros/actualizar", datos_form , function(data_form){
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

  	if(dato=="btn_nuevo_correo"){
  		$("#form_guardar_correo")[0].reset();
  		$('#agregarcorreos').modal({
      	show: true,
      	keyboard: false
  		});
  		return false;
  	}

	  if(dato=="btn_guardar_correo"){
	  
	 		var ban=0;
		  var texto='';
		  var regd = '1';

		    if( ($('#correo').val()=="")){
		      $('#correo').addClass("has-danger");
		      texto=texto+"* El campo Correo esta vacio!";
		      ban=1;
		    } 
		    
		  if(ban==1) {
		      Swal.fire('¡Atención!', texto, 'warning');
		    } else { 	
		      Swal.fire({   
	          title: "Por favor espere!",   
	          text: "Guadando la información.", 
	          showConfirmButton: false 
	        });
	        var datos_form = $("#form_guardar_correo").serialize();
	        $.post("/a_terceros/guardar_correo", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
	            //jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro ingresado correctamente!",
	                icon: "success"
	              })
	              .then((willDelete) => {
	              	$("#form_guardar_correo")[0].reset();
	                $('#agregarcorreos').modal('hide');
	                $.post("a_terceros/cargar_correos",{regd:""+regd+""},function	(data_correo){
       							$("#accordioAdiCorreos").empty();
										$("#accordioAdiCorreos").append(data_correo);
       						});
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
	  		window.open('/a_terceros/pdf','_blank');
	  	}

	  if(dato == "btn_excel") {
	  		window.open('/a_terceros/excel','_blank');
	  	}
  });

	$(document).on("change", function (event) {
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    var ck= event.target.checked;

    if(dato =="ck_materialqx"){
                
      if(ck==true){
       	$('#materialqx').val('1');
       	$('#div_parte8').css("display", "block");
       	$('#div_parte81').css("display", "block");
       	$('#btn_nuevo_correo').css("display", "block");
      }else{
        $('#materialqx').val('0');
       	$('#div_parte8').css("display", "none");
       	$('#div_parte81').css("display", "none");
       	$('#btn_nuevo_correo').css("display", "none");
      }
		}

	  if(dato=="tipo_tercero"){
	  	if($('#tipo_tercero').val()!="0"){
	  		$('#lblck_materialqx').css("display", "none");
	  		$('#ck_materialqx').css("display", "none");
	  	}else{
	  		$('#lblck_materialqx').css("display", "block");
	  		$('#ck_materialqx').css("display", "block");
	  	}
	  }

  });

  
	$(".UpperCase").on("keypress", function () {
		$input=$(this);
		setTimeout(function () {
 			$input.val($input.val().toUpperCase());
		},50);
 	});

	$('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");    
	});

	


});