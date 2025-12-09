$(function () {
	var ban = 0;
	
	cargar_tabla();
 
  	function cargar_tabla() {
  		var departamento ="";
  		var idMunicipio ="";
  		Swal.fire({   
          title: "Por favor espere!",   
          text: "Cargando la información.",   
          showConfirmButton: false 
        });
	    $.post("/a_empresa/cargar_empresa",{}, function(data_preg){
	      ban = 1;

	      	$('#idregistro').val(data_preg['empresa'].id_empresa);
	      	$('#nit').val(data_preg['empresa'].nit);
	      	$('#codigo_habilitacion').val(data_preg['empresa'].codigoh);
	     	$('#nombre').val(data_preg['empresa'].nombre);
	      	$('#direccion').val(data_preg['empresa'].direccion);
	      	$('#telefono').val(data_preg['empresa'].telefono);
	      	$('#celular').val(data_preg['empresa'].celular);
	      	$('#email').val(data_preg['empresa'].email);

	      	$('#departamentos_empresa').val(data_preg['empresa'].id_departamento);
	      	$('#departamentos_empresa').change();

	      // $('#logo').val(data_preg['empresa'].logo);
	      // $('#logo').change();
	      	$('#actividad').val(data_preg['empresa'].actividad_economica);
	      	$('#ciiu').val(data_preg['empresa'].ciiu);
	      	$('#riesgo').val(data_preg['empresa'].riesgo);
	      	$('#arl').val(data_preg['empresa'].arl);
		  	$('#caja').val(data_preg['empresa'].caja);
	      	$('#mision').val(data_preg['empresa'].mision);
	      	$('#vision').val(data_preg['empresa'].vision);
	      	departamento = data_preg['empresa'].id_departamento ;
	      	idMunicipio =data_preg['empresa'].id_municipio;
	     });
	    $.post("/a_empresa/cargar_municipio",{depa: ""+departamento+""}, function(data_muni){
	      	$('#municipio').html(data_muni);
	      	$('#municipio option:selected').val(idMunicipio);
	      	$('#municipio').change();
	    });
	    
      	$.post("/a_empresa/cargar_politica",{}, function(data_carg){
    		$("#accordionPoliticas").empty();
      		$("#accordionPoliticas").append(data_carg);
    	});

    	$.post("a_empresa/cargar_anexos",{},function	(data_anexo){
       		$("#accordioDocAnexos").empty();
			$("#accordioDocAnexos").append(data_anexo);
   		});
      Swal.close();
      ban = 0;
	    
		
  	}

  	$('#btn_guardar').on('click', function(){
	    var ban=0;
	    var texto='';

	    if( ($('#nit').val()=="")){
	      $('#div_nit').addClass("has-danger");
	      texto=texto+"* El Nit es obligatorio!";
	      ban=1;
	    } 

	    if( ($('#codigo_habilitacion').val()=="")){
	      $('#div_codigo_habilitacion').addClass("has-danger");
	      texto=texto+"* El Codigo habilitacion es obligatorio!";
	      ban=1;
	    } 

	    if( ($('#nombre').val()=="")){
	      $('#div_nombre').addClass("has-danger");
	      texto=texto+"\n* El nombre es obligatorio!";
	      ban=1;
	    }      
	        
	    if(ban==1) {
	      Swal.fire('¡Atención!', texto, 'warning');
	    } else { 	
	      guardar_registro();
        }
	    return false;
  	});

  	  	
  	$('#btn_nuevo_anexo').on('click', function(){
	 	$("#form_guardar_anexo")[0].reset();
	 	$('#btn_guardar_anexo').css("display", "block");
		$('#btn_actualizar_anexo').css("display", "none");
		$("#form_guardar_anexo")[0].reset();
	    $('#anexosDoc').modal({
	        show: true,
	        keyboard: false
	    });
	    return false;
	 });

  	$(document).on("click", function(event){
	    var datos = event.target.id.split("_");
	    var dato = event.target.id;

	       if(datos[0] == "btneditar") {
	      	idreg = datos[1];
		    $('#newModalLabel').html('Modificar Documento Anexo');
		      
	      	$.post("/a_empresa/modificar_anexos",{idreg: ""+idreg+""}, function(data_preg){
	        
		        $("#idreg_anexo").val(data_preg['anexos'].id);
		        $("#nombre_archivo").val(data_preg['anexos'].nombre);		        
		        $("#fecha_inicio").val(data_preg['anexos'].fecha);		        
		    });

	      	$('#btn_guardar_anexo').css("display", "none");
	      	$('#btn_actualizar_anexo').css("display", "block");
	      	
	      	$('#anexosDoc').modal({
		        show: true,
		        keyboard: false
		    });
	    }

	 });

 	$('#btn_guardar_anexo').on('click', function(){
 		var ban=0;
	  	var texto='';

	    if( ($('#nombre_archivo').val()=="")){
	      $('#nombre_archivo').addClass("has-danger");
	      texto=texto+"* El nombre del archivo es obligatorio!";
	      ban=1;
	    } 
	    if( ($('#archivo').val()=="")){
	      $('#archivo').addClass("has-danger");
	      texto=texto+"* El archivo es obligatorio!";
	      ban=1;
	    } 
	    
		if(ban==1) {
		      Swal.fire('¡Atención!', texto, 'warning');
		} else { 	
		      guardar_anexo();
	    }
	    return false; 
  	});

  	$('#btn_actualizar_anexo').on('click', function(){
	    var ban=0;
	    var texto='';

	    if( ($('#nombre_archivo').val()=="")){
	      $('#nombre_archivo').addClass("has-danger");
	      texto=texto+"* El nombre del archivo es obligatorio!";
	      ban=1;
	    } 
	    if( ($('#archivo').val()=="")){
	      $('#archivo').addClass("has-danger");
	      texto=texto+"* El archivo es obligatorio!";
	      ban=1;
	    } 
	        
	    if(ban==1) {
	      Swal.fire('¡Atención!', texto, 'warning');
	    } else { 	
	      actualizar_anexo();	      
        }
	    return false;
  	});



	$('#btn_actualizar').on('click', function(){
  	      var ban=0;
	      var texto='';
	      if ($('#nombre').val()==""){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
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
	        $.post("/a_empresa/actualizar", datos_form , function(data_form){
	          Swal.close();
	          //alert("Datos: "+datos_form);
	          if(data_form=="1") {
	            //jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro actualizado correctamente!",
	                icon: "success"
	            }).then(function(result) {
		            if (result.value) {
		              cargar_tabla();
		            }
		          });		          
		        } else {
		          Swal.fire("¡Error!", data_form, "error");
		        }
	        });      
	        return false;
	      }
	      return false;
	  	});

	function guardar_registro() {        
        Swal.fire({   
          title: "Por favor espere!",   
          text: "Guadando la información.", 
          showConfirmButton: false 
        });
        
        var formData = new FormData($("#form_guardar")[0]);

        $.ajax({
            url: "/a_empresa/guardar",
            type: "POST",            
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
                 cargar_tabla();          
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }


	function guardar_anexo() {        
        Swal.fire({   
          title: "Por favor espere!",   
          text: "Guadando la información.", 
          showConfirmButton: false 
        });
        
        var formData = new FormData(document.getElementById("form_guardar_anexo"));

        $.ajax({
            url: "/a_empresa/guardar_documentos_anexos",
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
              	$("#form_guardar_anexo")[0].reset();  
              	cargar_tabla(); 
              	$('#anexosDoc').modal('hide');
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    function actualizar_anexo() {        
        Swal.fire({   
          title: "Por favor espere!",   
          text: "Actualizando la información.", 
          showConfirmButton: false 
        });
        
        var formData = new FormData(document.getElementById("form_guardar_anexo"));

        $.ajax({
            url: "/a_empresa/actualizar_anexos",
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
              	$("#form_guardar_anexo")[0].reset();  
              	cargar_tabla(); 
              	$('#anexosDoc').modal('hide');
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

  	$('#departamentos_empresa').on('change', function(){
  		if(ban == 0) {
	  		Swal.fire({   
	          title: "Por favor espere!",   
	          text: "Cargando los municipios.",   
	          showConfirmButton: false 
	        });
	  		$.post("/a_empresa/cargar_municipio",{depa: ""+$('#departamentos_empresa option:selected').val()+""}, function(data_muni){
	  			//alert(data_muni+" -- "+$('#departamentos_empresa option:selected').val());
	      		$('#municipio').html(data_muni);
	      		Swal.close();
	      	});
	  	}
  	});

  	$(".UpperCase").on("keypress", function () {
  		$input=$(this);
  		setTimeout(function () {
   			$input.val($input.val().toUpperCase());
  		},50);
	})

  
	$('#logo').aceFileInput({
          
      btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
      btnChooseText: 'Seleccionar',
      placeholderText: 'Seleccione la Imagen del Logo',
      placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'
      
    });

	$('#archivo').aceFileInput({
          
      btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
      btnChooseText: 'Seleccionar',
      placeholderText: 'Seleccione el Archivo',
      placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'
      
    });	

	$('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
		$('#div_'+event.target.id).removeClass("has-danger");    
	});
	
});