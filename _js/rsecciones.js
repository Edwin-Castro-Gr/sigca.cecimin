$(function () {

	if ($('#opc_pag').val() == "listado") {
		cargar_listado();

		function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de secciones.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/r_secciones/listar_secciones",{}, function(data_carg){
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
  }

  	$(document).on("click", function(event){
	    var datos = event.target.id.split("_");
	    var dato = event.target.id;

	    
	    if(datos[0] == "btneditar") {
	      idreg = datos[1];
	      // alert(idreg);
	      $('#newModalLabel').html('Modificar Secciones');
	      
	      $.post("/r_secciones/modificar",{idreg: ""+idreg+""}, function(data_preg){
        // alert(data_preg);

	        $('#idregistro').val(data_preg['secciones'].seccion);

	        $("#rondas_secciones").val(data_preg['secciones'].ronda);
	        $("#rondas_secciones").change();	

	        $("#nombre").val(data_preg['secciones'].nombre);

	        $("#tiporespuesta").val(data_preg['secciones'].tiporespuesta);	       
	        $("#tiporespuesta").change();	
	       
	        $('#div_estado').css("display", "flex");
	        $("#estado").val(data_preg['secciones'].estado);
	        $("#estado").change();

	      });

	      $.post("/r_secciones/listar_preguntas",{id_seccion: ""+$('#idregistro').val()+""}, function(data_carg){
	            //alert(data_carg);
	            $("#accordionA").empty();
	            $("#accordionA").html(data_carg);                    
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
	            	$.post("/r_gestion/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
	      
	      $.post("/r_secciones/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
	        //alert(data_carg);
	        $("#modalForm1").html(data_carg);
	      });

	      $('#view-registro').modal({
	        show: true,
	        keyboard: false
	      });
	      return false;
	    }

	    if(datos[0]=="btnronda"){
	    	id_ronda=datos[1];

	    	window.open('/r_gestion/gestion/'+id_ronda,'_parent');

	    	// $.post("/r_gestion/cargar_items",{idronda: ""+idronda+""}, function(data_carg){
				// 	$('#modaldoc_body').modal('hide');
		        
		    //   $('#modaldoc_body').html(data_carg);

				// });

	    	// $('#newModal').modal({
	      //   show: true,
	      //   keyboard: false
	      // });
	    }


	    if(dato == "btn_guardar") {
	      var ban=0;
	      var texto='';
	      if( ($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#rondas_secciones').val()=="" ){
	        $('#rondas_secciones').addClass("brc-danger");
	        texto=texto+"* La Ronda es Obligatoria!<br>";
	        ban=1;
	      }
	      if( $('#tiporespuesta').val()=="" ){
	        $('#tiporespuesta').addClass("brc-danger");
	        texto=texto+"* El tipo de respuesta es obligatorio!";
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
	        $.post("/r_secciones/guardar", datos_form , function(data_form){
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

	  	if(dato == "btn_nueva_seccion") {
	  		divPreeguntas.innerHTML = "";
	  		$('#newModalLabel').html('Nueva Sección');
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
	      if( $('#rondas_secciones').val()=="" ){
	        $('#rondas_secciones').addClass("brc-danger");
	        texto=texto+"* La Ronda es Obligatoria!<br>";
	        ban=1;
	      }
	      if( $('#tiporespuesta').val()=="" ){
	        $('#tiporespuesta').addClass("brc-danger");
	        texto=texto+"* El tipo de respuesta es obligatorio!";
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
	        $.post("/r_secciones/actualizar", datos_form , function(data_form){
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
			
			if(dato == "btnAgregarPreg"){
				agregarPregunta();
			}	  

			if(datos[0] == "btnEliminar"){
				let id = datos[1];
				// alert(id);
				eliminarPregunta(id);
				contadorPreg--;
			}	

	  	if(dato == "btn_pdf") {
	  		window.open('/a_procesos/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/a_procesos/excel','_blank');
	  	}
  	});
		let contadorPreg = 0;
		let preguntaAgregar = document.querySelector('#pregunta');
		let divPreeguntas = document.querySelector('#accordionsecciones');

		let agregarPregunta =  ()=>{
			if(preguntaAgregar.value =="" || preguntaAgregar.value == null ){
				Swal.fire("¡Error!", "No ha registrado una pregunta", "error");
			}else{
				contadorPreg++;

				let nuevaPregunta =  preguntaAgregar.value;

				divPreeguntas.innerHTML+= `
					<div class="div_container" id="${contadorPreg}">
	      		<label class="col-form-label col-sm-11">      			
	      			${nuevaPregunta}      			
	      		</label>
	      		<input type="hidden" id="pregunta_${contadorPreg}" name="preguntas[]" value="${nuevaPregunta}">
	      		<a href="#" class="text-danger-m1" data-toggle="tooltip" data-original-title="Eliminar" id="btnEliminar_${contadorPreg}"> <i id="btnEliminar_${contadorPreg}" class="fa fa-trash-alt text-105"></i> </a>
	      	</div>
				`
				preguntaAgregar.value = "";

			}
			
		}

		let eliminarPregunta = (id)=>{
			let preguntaEliminada = document.getElementById(id);
			// alert(preguntaEliminada);
			divPreeguntas.removeChild(preguntaEliminada);
		}
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