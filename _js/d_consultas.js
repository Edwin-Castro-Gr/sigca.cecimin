$(function () {


  if($('#opc_pag').val() == "listado") {
    cargar_documentos();
    function cargar_documentos() {
      Swal.fire({ 
        title: "Por favor espere!",   
        text: "Cargando lista de Documentos.",
        showConfirmButton: false 
      });
      
      $.post("/d_consultas/listar_tabla",{}, function(data_carg){
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

  $('#procesos_consulta').select2({placeholder: 'Por Proceso'});
  $('#subprocesos_consulta').select2({placeholder: 'Por Subproceso'});
  $('#tipodocumentos_consulta').select2({placeholder: 'Por Tipo'});
    

  // ;

    function cargar_listado(data_carg) {
      Swal.fire({ 
        title: "Por favor espere!",   
        text: "Cargando lista de Documentos.",
        showConfirmButton: false 
      });  
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
    }
  }

  $(document).on("click", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
    
    if(dato == 'btn_enviar'){
      Swal.fire({ 
        title: "Por favor espere!",   
        text: "Enviando Correo.",
        showConfirmButton: false 
      });
      
      $.post("/d_consultas/enviar_socializacion",{}, function(data_enviado){
        Swal.close();
        if (data_enviado == "1") {
          Swal.fire({
            title: '¡Confirmacion!',
            text: 'El correo fue enviado con Exito.',
            type: 'success',
            icon: 'success'              
          })
        } else {
          Swal.fire("¡Error!", "Se presento el siguiente error: "+ data_enviado, "error");
        }
      });
    }

  });


  $(document).on("change", function(event){
    var datos = event.target.id.split("_");
    var dato = event.target.id;
       
    var id_tipo = $('#tipodocumentos_consulta').val();

    if(dato == "procesos_consulta") {
      var id_proceso = $('#procesos_consulta').val();

      $('#subprocesos_consulta').select2({
        placeholder: 'Por Subproceso',      
        ajax:{
          url:'d_consultas/cargar_subprocesos',
          data:{'idproc':id_proceso},
          dataType:'json',
          type:'GET',
          delay:250,
          processResults: function (data){
            return{
              results:data
            };
          },
          cache:true
        }
      });
      
      $.post("/d_consultas/consultar_documentos",{idproc: ""+id_proceso+""}, function(data_preg){
        cargar_listado(data_preg);
      }); 
    }

    if(dato == "subprocesos_consulta") {
      var id_subproceso = $('#subprocesos_consulta').val();

      $.post("/d_consultas/consultar_documentos",{idsubproc: ""+id_subproceso+""}, function(data_preg){
        cargar_listado(data_preg);
      }); 
    }


  });

  
  
  $('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function(event){
    $('#'+event.target.id).removeClass("brc-danger");    
  });

});