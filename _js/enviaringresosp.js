$(function () {
 	if ($('#opc_pag').val() == "enviar") {
        
 	   	$.post("/c_enviaringresop/cargar_anexos",{idcargo: ""+$('#idcargo').val()+"",tipo_contrato: ""+$('#idtipoContrato').val()+""}, function(data_carg){
            //alert(data_carg);
            $("#accordionA").empty();
            $("#accordionA").html(data_carg);                    
        });

 	}

    $(".ace-file-input").aceFileInput({
          
        btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
        btnChooseText: 'Seleccionar',
        placeholderText: 'Seleccione el Archivo',
        placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'
      
    });

    $('#btn_enviar').click(function () {
          var ban = 0;
          var texto = '';          

          if (ban == 1) {
              Swal.fire("¡Atención!", texto, "warning");
          } else {
              
              guardar_registro();
          }
          return false;
        });

    function guardar_registro() { 
        Swal.close();    
        Swal.fire({   
          title: "Por favor espere!",   
          text: "Guadando la información.", 
          icon: "warning",
          showConfirmButton: false 
        });
        
        var formData = new FormData(document.getElementById("form_enviar"));

        $.ajax({
            url: "/c_enviaringresop/guardar",
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
                window.open('https://cecimin.com.co/','_parent');             
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }


});