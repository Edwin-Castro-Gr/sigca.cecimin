$(function () {
	if($('#opc_pag').val() == "listado") {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de Areas.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/a_areas/listar_tabla",{}, function(data_carg){
	      //alert(data_carg);
	      $("#simple-table > tbody").empty();
	      $("#simple-table").append(data_carg);
	      //$('#simple-table').DataTable();
	      //$('[data-toggle="tooltip"]').tooltip();
	      Swal.close();
	    });
  	} else if($('#opc_pag').val() == "modificar") {
	    $('#btn_actualizar').click(function(){
	      var ban=0;
	      var texto='';
	      if( ($('#nombre').val()=="") || ($('#nombre').val().length <= 5) ){
	        $('#div_nombre').addClass("has-danger");
	        texto=texto+"* El nombre es obligatorio y con longitud de 5 caracteres minimo!";
	        ban=1;
	      }
	      if( $('#empleados_areas').val()=="" ){
	        $('#div_responsable').addClass("has-danger");
	        texto=texto+"* El responsable es obligatorio!";
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
	        $.post("/a_areas/guardar", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
	            jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro actualizado correctamente!",
	                icon: "success"
	              })
	              .then((willDelete) => {
	                window.open('/a_areas/index','_parent');
	              });
	            });
	          } else {
	            Swal.fire("¡Error!", data_form, "error");
	          }
	        });      
	        return false;
	      }
	      return false;    
	    });
	}

  	$(document).on("click", function(event){
	    var datos = event.target.id.split("_");
	    var dato = event.target.id;
	    if(datos[0] == "btneditar") {
	      idreg = datos[1];
	      
	      window.open('/a_areas/modificar/'+idreg,'_parent');
	    }

	    if(datos[0] == "btninactivar") {
	      jQuery(function(){
	        var id_reg = datos[1];
	        var nom_reg = $('#nombre_'+id_reg).val();
	        Swal.fire({
	          title: "Desea Inactivar el Registro: '"+nom_reg+"' ?",
	          text: "Podras activarlo en cualquier momento con la edición!",
	          icon: "warning",
	          buttons: ["Cancelar", "Si, Inacivar!"],
	          dangerMode: true,
	        })
	        .then((willDelete) => {
	          if (willDelete) {
	            $.post("/a_areas/A_inactivar",{idreg: ""+id_reg+""}, function(data_form){
	            //alert(data_form);
	            if(data_form=="1") {
	              Swal.fire({
	                title: "Inactivado!",
	                text: "El registro se ha inactivado.",
	                icon: "success",
	                button: "Ok",
	              })
	              .then((value) => {
	                window.location.reload();
	              });
	              
	            } else {
	              Swal.fire("¡Error!", "Se presento el siguiente error: "+data_form, "error");
	            }
	          });
	          }
	        });
	      });
	      return false;
	    }

	    if(datos[0] == "btndetalle") {
	      idreg = datos[1];
	      
	      $.post("/a_areas/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
	        //alert(data_carg);
	        $("#modalForm").html(data_carg);
	      });

	      $('#ver-registro').modal({
	        show: true,
	        keyboard: false
	      });
	      return false;
	    }

	    if(dato == "btn_guardar") {
	      var ban=0;
	      var texto='';
	      if( ($('#nombre').val()=="") || ($('#nombre').val().length <= 5) ){
	        $('#div_nombre').addClass("has-danger");
	        texto=texto+"* El nombre es obligatorio y con longitud de 5 caracteres minimo!<br>";
	        ban=1;
	      }
	      if( $('#empleados_areas').val()=="" ){
	        $('#div_responsable').addClass("has-danger");
	        texto=texto+"* El responsable es obligatorio!";
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
	        $.post("/a_areas/guardar", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
	            jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro ingresado correctamente!",
	                icon: "success"
	              })
	              .then((willDelete) => {
	                window.open('/areas/index','_parent');
	              });
	            });
	          } else {
	            Swal.fire("¡Error!", data_form, "error");
	          }
	        });      
	        return false;
	      }
	      return false;
	  	}	      	
  	});

	$('input[type=text], input[type=email], input[type=password], select, input[type=number]').on("change", function(event){
		$('#div_'+event.target.id).removeClass("has-danger");    
	});

});
/*jQuery(function($) {

    // highlight simple table row when selected
    function _highlight(row, checked) {
      // `classList.toggle` with 2 arguments isn't supported in IE10+
      // row.classList.toggle('active', checked)
      // row.classList.toggle('bgc-yellow-l3', checked)
      // row.classList.toggle('bgc-h-default-l3', !checked)

      if (checked) {
        row.classList.add('active')
        row.classList.add('bgc-success-l3')
        row.classList.remove('bgc-h-default-l3')
      } else {
        row.classList.remove('active')
        row.classList.remove('bgc-success-l3')
        row.classList.add('bgc-h-default-l3')
      }
    }

    $('#simple-table tbody tr')
      .on('click', function(e) {
        var ret = false
        try {
          // return if clicked on a .btn or .dropdown
          ret = e.target.classList.contains('btn') || e.target.parentNode.classList.contains('btn') || e.target.closest('.dropdown') != null
        } catch (err) {}

        if (ret) return

        var inp = this.querySelector('input')
        if (inp == null) return

        if (e.target.tagName != "INPUT") {
          inp.checked = !inp.checked
        }
        _highlight(this, inp.checked)
      })

    $('#simple-table thead input')
      .on('change', function() {
        var checked = this.checked
        $('#simple-table tbody input[type=checkbox]')
          .each(function() {
            this.checked = checked
            var row = $(this).closest('tr').get(0)
            _highlight(row, checked)
          })
      })

    // responsive table using basic table plugin
    $('#responsive-table').basictable({
      breakpoint: 800
    })
});*/
    