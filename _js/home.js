$(function () {
	
	if ($('#opc_pag').val() == "index") {

		cargar_tareas();

		var myVer =  setInterval(function() { cargar_tareas() }, 10000);		
		
	 }

	if ($('#opc_pag').val() == "notificaciones") {
		
		ver_listado_notificaciones();
		
		function ver_listado_notificaciones() {
	    
		    $.post("/home/cargar_listado_notificaciones",{}, function(data_carg){
		      		      
		      	$("#simple-table2").empty();
		      	$("#simple-table2").html(data_carg);
		      
		    });
  		}

	    $.post("/home/visto_notificaciones",{}, function(){
	      
	    });

	}


	function cargar_tareas() {
		    
	    $.post("/home/listar_tabla",{}, function(data_carg){
	      
	      	$("#simple-table").empty();
	     	$("#simple-table").html(data_carg);
	      
	    });
  	}

  	
	function ver_listado_notificaciones() {
	    
	    $.post("/home/cargar_listado_notificaciones",{}, function(data_carg){
	      	      
	      	$("#simple-table2").empty();
	      	$("#simple-table2").html(data_carg);
	      
	    });	   
  	}

  	$(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (datos[0] == "btngestionar") {

            idmodulo = datos[1];
            idreg = datos[2];
            idusuario = datos[3];

            var perfil = $("#perfil_usuario").val();
            switch (idmodulo) {
            	case "0" : //Modulo Solicitud de Documentos//
            		if(idusuario == 4){
            			window.open('/d_solicitud/modificar/'+idreg+'','_parent');
            		}else{
            			window.open('/d_solicitud/index','_parent');
            		}            		
            		break;
            	case "1" : //Modulo Agendamiento Qx//
            		if(perfil =="6"){
            			
            			window.open('/c_programacion/revisar/'+idreg+'', '_parent');
            		}else if(perfil =="8"){
            			window.open('/c_programacion/enviar_solicitud/'+idreg+'', '_parent');
            		}else {
            			window.open('/c_programacion/index', '_parent');
            		}          		            		
            		break;
            	case "2" : //Capacitaciones//
            		window.open('/home/index/', '_parent');            		
            		break;
            	case "3" : //Eventos//
            		window.open('/e_eventos/index/', '_parent');            		
            		break;
            	case "4" : //Medicamentos//
            		window.open('/home/index','_parent');
            		break;
            	case "5" : //Contratos Terceros//
            		window.open('/c_contratost/index', '_parent');            		
            		break;
            	case "6" : //Contratos Personal//
            		window.open('/a_contratos/index', '_parent');            		
            		break;
            	case "7" : //Costos//
            		window.open('/home/index','_parent');            		
            		break;
            	case "8" : //Socializacion//
            		window.open('/d_consultas/index', '_parent');            		
            		break;
            	case "9" : //Otros//
            		window.open('/home/index','_parent');           		
            		break;
            	case "10" : //Eventos//
            		window.open('/home/index','_parent');            		
            		break;
            }  
            return false;
        }

         if (dato == "ver_notificaciones") {

         	$.post("/home/consulta_documentos_pendientes", {}, function(data_noti){


       		});        	
         	
         }



	});

	function notificar_documentos_pendientes(){
        $.post("/home/consulta_documentos_pendientes", {}, function(data_noti){


        });
    } 
    
    function notificar_vigencia_contrato(){
        $.post("/home/consultar_vigencia_contratos", {}, function(data_noti){

        }); 
    }
});