$(function () {

    var docrel ="";
    if ($('#opc_pag').val() == "ingreso") {
        var ban = 0;             
         
        $('#documentos_solicitud').select2();
        $('#documentos_solicitud').next(".select2-container").hide();       
        
    	$('#empleados_solicitud').select2();
        $('#empleados_autor').select2();
        $('#empleadosMR_revisa').select2({
            width: "100%",  
            placeholder: 'Quien(es) revisa(n)',
            allowClear: true
        });
        $('#empleadosMR_aprueba').select2({
            width: "100%",  
            placeholder: 'Quien(es) aprueba(n)',
            allowClear: true
        });
    	$('#doc_relacionado').select2({
            width: "100%",  
            placeholder: 'Documento Relacionado',
            allowClear: true
        });
        $('#doc_relacionado').trigger('change');
    	$('#lbldoc_relacionado').css("display", "none");
        $('#divdoc_relacionado').css("display", "none");
    	$('#lblorigen_formato').css("display", "none");
    	$('#origen_formato').css("display", "none");
        $('#ck_d_relacionado').prop('checked', true);
        

        $('#btn_guardar').click(function () {
            var ban=0;
            var texto='';
            
            if (($('#nombre').val() == "")) {
                $('#nombre').addClass("brc-danger");
                texto = texto + "* El nombre del documento es obligatorio !<br>";
                ban = 1;
            }

            if (($('#justificacion').val() == "")) {
                $('#justificacion').addClass("brc-danger");
                texto = texto + "* La justificacion son obligatoria!<br>";
                ban = 1;
            }
            if ($('#macroprocesos_solicitud').val() == "") {
                $('#macroprocesos_solicitud').addClass("brc-danger");
                texto = texto + "* El Macroproceso es obligatorio!";
                ban = 1;
            }
            if($("#tipo_solicitud option:selected").val()!="3"){
                if ($('#archivoorig').val() === "") {
                    $('#archivoorig').addClass("brc-danger");
                    texto = texto + "* El Archivo Fuente es obligatorio!";
                    ban = 1;
                }
            }  

            if($('#ck_d_relacionado').prop('checked')){
                if($('#doc_relacionado').val() =='0' || $('#doc_relacionado').val() =="999" || $('#doc_relacionado').val() ==""){
                    $('#doc_relacionado').addClass("brc-danger");
                    texto = texto + "* Tiene Documento relacionado!";
                    ban = 1; 
                }                
            }          

            if(ban==1) {     
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                guardar_registro();
                return false;  
            }
        });
    } else if ($('#opc_pag').val() == "revision") {
        var ban = 0;  
        // alert($('#idreg').val());           
        $.post("/d_solicitud/cargar_qrevisa", {idreg:($('#idreg').val())}, function(data_preg){
            // alert(data_preg);
            $("#quienRevisa").html(data_preg);
        });

        $.post("/d_solicitud/cargar_observaciones", {idreg:($('#idreg').val())}, function(data_preg){
            // alert(data_preg);
            $("#accordioobservacion").html(data_preg);
        });

        $('#btn_guardar_revision').click(function () {
            var ban=0;
            var texto='';            

            if (($('#nombre').val() == "")) {
                $('#nombre').addClass("brc-danger");
                texto = texto + "* El nombre del documento es obligatorio !<br>";
                ban = 1;
            }

            if (($('#observaciones').val() == "")) {
                $('#observaciones').addClass("brc-danger");
                texto = texto + "* Las observaciones son obligatorias!<br>";
                ban = 1;
            }
            if ($('#estado').val() == "") {
                $('#estado').addClass("brc-danger");
                texto = texto + "* Debe seleccionar un estado!";
                ban = 1;
            }
            
            if(ban==1) {     
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                guardar_revision();
                return false;  
            }
        });
        
    }else if ($('#opc_pag').val() == "aprobacion") {
        var ban = 0;             
        $.post("/d_solicitud/cargar_qaprueba", {idreg:($('#idreg').val())}, function(data_preg){
            
            $("#quienAprueba").html(data_preg);
        });

         $.post("/d_solicitud/cargar_observaciones", {idreg:($('#idreg').val())}, function(data_preg){
            
            $("#accordioobservacion").html(data_preg);
        });
        $('#btn_guardar').click(function () {
            var ban=0;
            var texto='';
            if (($('#observaciones').val() == "")) {
                $('#observaciones').addClass("brc-danger");
                texto = texto + "* Las observaciones son obligatorias!<br>";
                ban = 1;
            }            
            if ($('#estado').val() == "") {
                $('#estado').addClass("brc-danger");
                texto = texto + "* Debe seleccionar un estado!";
                ban = 1;
            }
            if ($('#estado').val() == 6) {
                $('#estado').addClass("brc-danger");
                texto = texto + "* Debe Cargar Archivo Fuente!";
                ban = 1;
            }
            if(ban==1) {     
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                guardar_aprobacion();
                return false;  
            }
        });
    } else if($('#opc_pag').val() == "listado") {

        cargar_listado();

        function cargar_listado() {
            Swal.fire({
                title: "Por favor espere!",
                text: "Cargando lista de solicitudes.",
                showConfirmButton: false
            });

            $.post("/d_solicitud/listar_tabla", {}, function (data_carg) {
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
    }else if ($('#opc_pag').val() == "modificar") {
        var ban = 0;
        var id_subproceso = $('#subproceso').val();
        var docrelacionado = $('#iddocrelacionado').val();

        if (docrelacionado != ""){
            $('#ck_d_relacionado').prop('checked', true);

            let id_macro = $('#macroprocesos_solicitud').val();
            let id_proceso = "";
            if($('#proceso').val()=="999"||$('#proceso').val()=="0"){
                id_proceso = "";                
            }else{
                id_proceso = $('#proceso').val(); 
            }
            
            let id_subproceso = "";
            if($('#subproceso').val()== "0" || $('#subproceso').val()=="999"){
                id_subproceso = "";
            }else{
                id_subproceso = $('#subproceso').val();
            }
            
            if(docrelacionado == "" || docrelacionado == "0" || docrelacionado =="999"){
                docrelacionado = "";
            }

            cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado);   
            
            $('#lbldoc_relacionado').css("display", "block");
            $('#divdoc_relacionado').css("display", "block");              
            
        }else{
            $('#ck_d_relacionado').prop('checked', false);
            $('#lbldoc_relacionado').css("display", "none");
            $('#divdoc_relacionado').css("display", "none");             
        }

        $('#empleados_solicitud').select2({
            width: "100%",
            allowClear: true
        });

        $('#empleados_solicitud').trigger('change');

        $('#empleadosMR_revisa').select2({
            width: "100%",  
            placeholder: 'Quien(es) revisa(n)',
            allowClear: true
        });
        
        $('#empleadosMR_revisa').trigger('change');

        $('#documentosM_solicitud').select2({
            width: "100%",  
            placeholder: 'Selecione un Doc...',
            allowClear: true
        });
        
        $('#documentosM_solicitud').trigger('change');

        $('#empleadosMR_aprueba').select2({
            width: "100%",  
            placeholder: 'Quien(es) aprueba(n)',
            allowClear: true
        });
        $('#empleadosMR_aprueba').trigger('change');

        $('#doc_relacionado').select2({
            width: "100%",  
            placeholder: 'Documento Relacionado',
            allowClear: true
        });
        $('#doc_relacionado').trigger('change');
        
        $('#documentos_solicitud').select2();
        $('#lblorigen_formato').css("display", "none");
        $('#origen_formato').css("display", "none");

        $.post("/d_solicitud/cargar_observaciones", {idreg:($('#idreg').val())}, function(data_preg){
            
            $("#accordioobservacion").html(data_preg);
        });

        $('#btn_actualizar').click(function () {
            var ban=0;
            var texto='';
            if (($('#nombre').val() == "")) {
                $('#nombre').addClass("brc-danger");
                texto = texto + "* El nombre del documento es obligatorio !<br>";
                ban = 1;
            }

            if (($('#observaciones').val() == "")) {
                $('#observaciones').addClass("brc-danger");
                texto = texto + "* Las observaciones son obligatorias!<br>";
                ban = 1;
            }   
            
            if (($('#idusuariactual').val() == $('#idusuarioregsol').val()) && $('#estado').val()!='0') {
                $('#estado').addClass("brc-danger");
                texto = texto + "* Estado no permitido para el Usuario!<br>";
                ban = 1;
            }

            if ($('#estado').val() == 0 || $('#estado').val() == 6) {
                if ($('#archivoorig').val() === "") {
                    $('#archivoorig').addClass("brc-danger");
                    texto = texto + "*El Archivo Fuente es obligatorio!";
                    ban = 1;
                }                
            }
            if(ban==1) {     
                Swal.fire("¡Atención!", texto, "warning");
            } else {
                actualizar_registro();
                return false;
              }
        });
    } 

    $(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (datos[0] == "btneditar") {
            idreg = datos[1];
            idusuario = datos[2];
            $.post("/d_solicitud/verificar", {idreg:""+idreg+""}, function(data_preg){

                if(idusuario == 571 || idusuario == 3){
                    window.open('/d_solicitud/modificar/'+idreg,'_parent');
                }else if(idusuario ==(data_preg['solicitud'].Usuario)){
                    if((data_preg['solicitud'].Estado == 0)||(data_preg['solicitud'].Estado == 6)){
                
                     window.open('/d_solicitud/modificar/'+idreg,'_parent');
                
                    }else{
                    
                    Swal.fire("¡Atención!", "El registro seleccionado no puede ser modificado", "info");
                    }
                }
            });            
        
        }
                  
        if (datos[0] == "btninactivar") {
            //jQuery(function(){
            var id_reg = datos[1];
            var nom_reg = $('#nombre_' + id_reg).val();
            Swal.fire({
                title: "Desea Inactivar el Registro: '" + nom_reg + "' ?",
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
            }).then(function (result) {
                if (result.value) {
                    $.post("/d_solicitud/inactivar", {
                        idreg: "" + id_reg + ""
                    }, function (data_form) {
                        //alert(data_form);
                        if (data_form == "1") {
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
                            Swal.fire("¡Error!", "Se presento el siguiente error: " + data_form, "error");
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.DismissReason.cancel;
                }
            });

            return false;
        }

        if (datos[0] == "btnrevisar") {
            idreg = datos[1];
            idusuario = datos[2];
            Qprueba = [];
            $.post("/d_solicitud/verificar", {idreg:""+idreg+""}, function(data_preg){
                Qprueba = data_preg['solicitud'].Revisa;          
            
                if(Qprueba.includes(idusuario)){
                   // alert("Son Iguales"); 
                   window.open('/d_solicitud/revisar/'+idreg,'_parent');
                }else{
                
                 Swal.fire("¡Atención!", "No tiene permiso para realizar esta acción", "info");
                    
                }           

            });            
            
        }
        
        if (datos[0] == "btnaprobar") {
            idreg = datos[1];
            idusuario = datos[2];
            Qprueba = [];
            $.post("/d_solicitud/verificar", {idreg:""+idreg+""}, function(data_preg){
            Qprueba = data_preg['solicitud'].Aprueba;          
            
               if(Qprueba.includes(idusuario)){
                   // alert("Son Iguales"); 
                   window.open('/d_solicitud/aprobar/'+idreg,'_parent');
                }else{
                
                 Swal.fire("¡Atención!", "No tiene permiso para realizar esta acción", "info");
                    
                }           

            });
        }


        if (dato == "btn_pdf") {
            window.open('/d_solicitud/pdf', '_blank');
        }

        if (dato == "btn_excel") {
            window.open('/d_solicitud/excel', '_blank');
        }
    });

 
    $(document).on("change", function(event){
        event.preventDefault();
        var datos = event.target.id.split("_");
        var dato = event.target.id;
        var ck= event.target.checked;

        if(dato == "tipo_solicitud") {
           
            if($("#tipo_solicitud option:selected").val()=="1"){
                $('#documentos_solicitud').next(".select2-container").hide();
                $('#nombre').css("display", "block");
                $('#nombre').val("");
                $('#nombre').focus();
                
            }else{               
                $('#nombre').css("display", "none");
                $('#documentos_solicitud').next(".select2-container").show();
                // $('#nombre').focus();
            }
        }

        if(dato == "tipodocumentos_solicitud") {

            var tipo = $("#tipodocumentos_solicitud").val();

            if($("#tipo_solicitud option:selected").val()=="2"){
                $.post("/d_solicitud/cargar_select_documentos",{tipo: ""+tipo+""}, function(data_select){
                    $('#documentos_solicitud').html(data_select);  
                });                            
                
            }else if($("#tipo_solicitud option:selected").val()=="3"){
                $.post("/d_solicitud/cargar_select_documentos",{tipo: ""+tipo+""}, function(data_select){
                    $('#documentos_solicitud').html(data_select);  
                }); 

            }

    	    if($("#tipodocumentos_solicitud").val()==="FO"){
    	    	$('#lblorigen_formato').css("display", "block");
    	    	$('#origen_formato').css("display", "block");
    	    	$('#nombre').focus();
    	    }else{
    	    	$('#lblorigen_formato').css("display", "none");
    	    	$('#origen_formato').css("display", "none");
    	    	$('#nombre').focus();
    	    }

      	}
    
        if(dato == "ck_d_relacionado") {

            let id_macro = $('#macroprocesos_solicitud').val();
            let id_proceso = "";
            if($('#proceso').val()=="999"||$('#proceso').val()=="0"){
                id_proceso = "";                
            }else{
                id_proceso = $('#proceso').val(); 
            }
            
            let id_subproceso = "";
            if($('#subproceso').val()== "0" || $('#subproceso').val()=="999"){
                id_subproceso = "";
            }else{
                id_subproceso = $('#subproceso').val();
            }

            let docrelacionado = "";
            if($('#doc_relacionado').val()== "0" || $('#doc_relacionado').val()=="999"){
                docrelacionado = "";
            }else{
                docrelacionado = $('#doc_relacionado').val();
            }

            if(ck){
                
                $('#lbldoc_relacionado').css("display", "block");
                $('#divdoc_relacionado').css("display", "block");
                cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado);
                              
            }else{
                
                $('#lbldoc_relacionado').css("display", "none");
                $('#divdoc_relacionado').css("display", "none");
            }
        }

        if(dato == 'ck_capacitacion'){
            if(ck){
                $('#capacitacion').val('1');
            }else{
                $('#capacitacion').val('0');
            }
        }
        
        if(dato == "macroprocesos_solicitud") {
            
            Swal.fire({   
              title: "Por favor espere!",   
              text: "Cargando los procesos",   
              showConfirmButton: false 
            });
            $.post("/d_solicitud/cargar_procesos",{macro: ""+$('#macroprocesos_solicitud option:selected').val()+""}, function(data_pro){
                    // alert(data_subpro+" -- "+$('#procesos_solicitud option:selected').val());
                    $('#proceso').html(data_pro);
                    Swal.close();
            });
            let id_macro = $('#macroprocesos_solicitud').val();
            let id_proceso = "";
            if($('#proceso').val()=="999"||$('#proceso').val()=="0"){
                id_proceso = "";                
            }else{
                id_proceso = $('#proceso').val(); 
            }
            
            let id_subproceso = "";
            if($('#subproceso').val()== "0" || $('#subproceso').val()=="999"){
                id_subproceso = "";
            }else{
                id_subproceso = $('#subproceso').val();
            }

            let docrelacionado = "";
            if($('#doc_relacionado').val()== "0" || $('#doc_relacionado').val()=="999"){
                docrelacionado = "";
            }else{
                docrelacionado = $('#doc_relacionado').val();
            }
           
            $('#lbldoc_relacionado').css("display", "block");
            $('#divdoc_relacionado').css("display", "block");
            cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado);
            
        }

        if(dato == "proceso") {
        
            Swal.fire({   
              title: "Por favor espere!",   
              text: "Cargando los subprocesos",   
              showConfirmButton: false 
            });
            $.post("/d_solicitud/cargar_subprocesos",{proce: ""+$('#proceso option:selected').val()+""}, function(data_subpro){
                // alert(data_subpro+" -- "+$('#procesos_solicitud option:selected').val());
                $('#subproceso').html(data_subpro);
                Swal.close();
            });
            let id_macro = $('#macroprocesos_solicitud').val();
            let id_proceso = "";
            if($('#proceso').val()=="999"||$('#proceso').val()=="0"){
                id_proceso = "";                
            }else{
                id_proceso = $('#proceso').val(); 
            }
            
            let id_subproceso = "";
            if($('#subproceso').val()== "0" || $('#subproceso').val()=="999"){
                id_subproceso = "";
            }else{
                id_subproceso = $('#subproceso').val();
            }

            let docrelacionado = "";
            if($('#doc_relacionado').val()== "0" || $('#doc_relacionado').val()=="999"){
                docrelacionado = "";
            }else{
                docrelacionado = $('#doc_relacionado').val();
            }

            cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado);
            
        }
        
        if(dato == "subproceso") {
            let id_macro = $('#macroprocesos_solicitud').val();
            let id_proceso = "";
            if($('#proceso').val()=="999"||$('#proceso').val()=="0"){
                id_proceso = "";                
            }else{
                id_proceso = $('#proceso').val(); 
            }
            
            let id_subproceso = "";
            if($('#subproceso').val()== "0" || $('#subproceso').val()=="999"){
                id_subproceso = "";
            }else{
                id_subproceso = $('#subproceso').val();
            }

            let docrelacionado = "";
            if($('#doc_relacionado').val()== "0" || $('#doc_relacionado').val()=="999"){
                docrelacionado = "";
            }else{
                docrelacionado = $('#doc_relacionado').val();
            }

            cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado); 
        }        
        
        if(dato == "documentos_solicitud") {
            var id_doc = $('#documentos_solicitud option:selected').val();
            var tipo = $("#tipo_solicitud").val();

            $('#iddocumento').val(id_doc);
            $('#nombre').val($('#documentos_solicitud option:selected').text());
            $.post("/d_solicitud/cargar_macroprocesos",{iddoc: ""+id_doc+""}, function(data_form){
                $('#macroprocesos_solicitud').html(data_form);
            });

            $.post("/d_solicitud/cargar_procesos",{iddoc: ""+id_doc+"",tipo:""+tipo+""}, function(data_pro){
                $('#proceso').html(data_pro);
            });

            $.post("/d_solicitud/cargar_subprocesos",{iddoc: ""+id_doc+"",tipo:""+tipo+""}, function(data_subpro){
                $('#subproceso').html(data_subpro);
            });

            $.post("/d_solicitud/cargar_documentos",{iddoc: ""+id_doc+""}, function(data_doc){
                $('#PDF').html('<a href="https://sigca.cecimin.com.co/'+data_doc['documento'].Pdf+'"><i class="fa fa-file-word"></i></a>'); 
                var doc = (data_doc['documento'].Doc_relacionado);
                
                if((data_doc['documento'].Doc_relacionado !=null) || (data_doc['documento'].Doc_relacionado !="")){
                    $('#iddocrelacionado').val(data_doc['documento'].Doc_relacionado);

                    $("ck_d_relacionado").prop('checked', true);
                    var id_macro = $('#macroprocesos_solicitud').val();
                    var id_proceso =$('#proceso').val();
                    var id_subproceso = $('#subproceso').val();
                    var docrelacionado = $('#iddocrelacionado').val();                    
                    
                    cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado); 

                    $('#empleados_autor').val("");        
                              
                    
                }else{
                    $('#iddocrelacionado').val('');
                    $("ck_d_relacionado").prop('checked', false);
                    $('#lbldoc_relacionado').css("display", "none");
                    $('#divdoc_relacionado').css("display", "none");                    
                }
            }); 
        }
        if(dato == "estado") {
            if($('#idusuariactual').val() == $('#idusuarioregsol').val()){
                if($("#estado option:selected").val()!="0"){  
                 Swal.fire("¡Atención!", "Estado no permitido para el Usuario", "info");
                }           
            }else if($('#idusuariactual').val() == 571){
                if($("#estado option:selected").val()=="3" || $("#estado option:selected").val()=="4"){  
                 Swal.fire("¡Atención!", "Estado no permitido para el Usuario", "info");
                }           
            }
        }

        if(dato = "doc_relacionado"){
            $('#idckdocre').val('Si');
            $('#iddocrelacionado').val($('#doc_relacionado option:selected').val()) ;
        }
        
    }); 
    
    
    function guardar_registro() {
        Swal.close();
        Swal.fire({
          title: "¡Atención!",
          text: "Guardando Información...!",
          icon: "warning",
          showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_guardar"));
      
        $.ajax({
            url: "/d_solicitud/guardar",
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
                window.open('/d_solicitud/index','_parent');            
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    function guardar_revision() {
        Swal.close();
        Swal.fire({
          title: "¡Atención!",
          text: "Guardando Información...!",
          icon: "warning",
          showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_revision"));
      
        $.ajax({
            url: "/d_solicitud/guardar_revision",
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
                text: "Registro ingresado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                window.open('/d_solicitud/index','_parent');            
              }); 
            } else {
              Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    function guardar_aprobacion() {
        Swal.close();
        Swal.fire({
          title: "¡Atención!",
          text: "Guardando Información...!",
          icon: "warning",
          showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_aprobacion"));
      
        $.ajax({
            url: "/d_solicitud/guardar_aprobacion",
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
                text: "Registro ingresado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                window.open('/d_solicitud/index','_parent');            
              }); 
            } else {
              Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    function actualizar_registro() {
        Swal.close();
        Swal.fire({
          title: "¡Atención!",
          text: "actualizando Información...!",
          icon: "warning",
          showConfirmButton: false
        });
        
        var formData = new FormData(document.getElementById("form_modificar"));
      
        $.ajax({
            url: "/d_solicitud/actualizar",
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
                text: "Registro actualizado correctamente!",
                icon: "success"
              })
              .then((willDelete) => {
                window.open('/d_solicitud/index','_parent');            
              }); 
            } else {
                Swal.fire("¡Error!", res, "error");
            }
        }); 
        return false;
    }

    function cargarDocumentoRelacionado(id_macro, id_proceso, id_subproceso, docrelacionado) {
        $.post("/d_solicitud/cargar_docrelacionado", {
            idmacro: "" + id_macro + "",
            idproc: "" + id_proceso + "",
            idsubpr: "" + id_subproceso + "",
            iddocrel: "" + docrelacionado + ""
        }, function(data_form) {            
            $('#doc_relacionado').html(data_form);
        });
    }

    $(".UpperCase").on("keypress", function () {
      $input=$(this);
      setTimeout(function () {
       $input.val($input.val().toUpperCase());
      },50);
    })

    

    $('#archivoorig').aceFileInput({
      
      btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
      btnChooseText: 'Seleccionar',
      placeholderText: 'Seleccione el Archivo origen',
      placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>',
      allowExt:'doc|docx|xls|xlsx'
    })
    
    
    $('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function(event){
        $('#'+event.target.id).removeClass("brc-danger");    
    });


});