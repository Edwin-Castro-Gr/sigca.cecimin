$(function () {

    if ($('#opc_pag').val() == "listado") {

        cargar_listado();

        function cargar_listado() {
            Swal.fire({
                title: "Por favor espere!",
                text: "Cargando lista de solicitudes.",
                showConfirmButton: false
            });

            $.post("/c_egresop/listar_tabla", {}, function (data_carg) {
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
    }else if ($('#opc_pag').val() == "ingreso") {
       

        $('#cardElementos').css("display", "none");    
        $('#empleados_egresop').select2();
        $('#coordinador_jefeinm').select2();
        $('#cargos_egresop').select2();       
        
        $('#fechainicio').prop("disabled", true);
        $('#fechafinal').prop("disabled", true);
         
        $('#empleados_egresop').prop("disabled", true);
        $('#coordinador_jefeinm').prop("disabled", true);
        $('#cargos_egresop').prop("disabled", true);
        $('#centroscostos_egresop').prop("disabled", true);
        $('#areas_egresop').prop("disabled", true);
        $('#tiposcontratos_egresop').prop("disabled", true);


        //$('#cargos_contratos').chosen({width: "95%"});

        $('#btn_guardarEgreso').click(function () {
            var ban = 0;
            var texto = '';

            if($('#ckdevolverE').prop('checked')) {
                if(!$('#chkCarnet').checked && !$('#chkComputador').checked){
                    $('#chkCarnet').addClass("brc-danger");
                    texto = texto + "* Seleccionaste devolver elementos y no se ha marcado el elemento a devolver!<br>";
                    ban = 1;      
                }           
            }              

            if (ban == 1) {
                Swal.fire("¡Atención!", texto, "warning");
            } else {
              
                guardar_registro();
            }
              return false;
        });
        
    }else if ($('#opc_pag').val() == "modificar") {
        var tipo_cont = $("#tipocontratos").val();
        
        $.post("/c_egresop/listar_anexos",{id_ingreso: ""+$('#idregistro').val()+"", tipo_cont: ""+tipo_cont+"" }, function(data_carg){
            //alert(data_carg);
            $("#accordionA").empty();
            $("#accordionA").html(data_carg);                    
        }); 

    }

    $(document).on("click", function (event) {
        var datos = event.target.id.split("_");
        var dato = event.target.id;

        if (datos[0] == "btnEgreso") {
            idreg = datos[1];
            window.open('/c_egresop/nuevo/'+idreg,'_parent');
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
                    $.post("/c_egresop/inactivar", {
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

        if (datos[0] == "btndetalle") {
            idreg = datos[1];

            $.post("/c_egresop/ver_registro", {
                idreg: "" + idreg + ""
            }, function (data_carg) {
                //alert(data_carg);
                $("#modalForm1").html(data_carg);
            });

            $('#view-registro').modal({
                show: true,
                keyboard: false
            });
            return false;
        }

        if (dato == "btn_pdf") {
            window.open('/c_egresop/pdf', '_blank');
        }

        if (dato == "btn_excel") {
            window.open('/c_egresop/excel', '_blank');
        }
    });
 
    $(document).on("change", function(event){
      var datos = event.target.id.split("_");
      var dato = event.target.id;
      var ck = event.target.checked;
        

        if(dato == "ckdevolverE"){
            if(ck){
                $('#cardElementos').css("display","flex");
            }else{
                 $('#cardElementos').css("display","none");
            }
        }
        

        if(dato == "ckenviarCorreo"){
            if(ck){
                $('#enviarCorreo').val(ck);
            }else{
                $('#enviarCorreo').val(ck);
            }       
        }

    }); 

    $('#cedula_empleado').keyup(function(e) {
        
        if(e.keyCode == 13) {

          var cedula = $('#cedula_empleado').val();
          
          $.post("/c_egresop/cargar_empleado",{emple: ""+cedula+""}, function(data_emple){
            if((data_emple['empleado'].id_empleado)){
              $('#idfuncionario').val(data_emple['empleado'].id_empleado);
              $('#cedula_empleado').val(cedula);
              $('#nombre_empleado').val(data_emple['empleado'].nombre_empleado);                
              $('#btn_agregar_empleado').css("display", "none");             
              $('#cargos_contratos').focus();
            }else{
            Swal.fire("El Empleado no Existe!");                
            }
          });
        }        
    }); 

    $('#cedula').blur(function(e){
        e.preventDefault();
        $.post("/c_egresop/consultar_empleado", {cedula:($('#cedula').val())}, function(data_preg){
            if(data_preg != false){
                Swal.fire("¡La Cedula ya se encuentra registrada", $('#cedula').val(), "error");
                $('#Tipo_docidentidad_empleados').val("").change();
                $('#cedula').val("");           
            }   
        });    
    });

    $("input[name=prorroga]").change((e)=>{ 
      if((e.target.checked)==true){
        $("#idprorroga").val(1);       
      }else{
        $("#idprorroga").val(0);           
      }       
    });
    
    function guardar_registro() { 
        Swal.close();    
        Swal.fire({   
          title: "Por favor espere!",   
          text: "Guadando la información.", 
          icon: "warning",
          showConfirmButton: false 
        });
        
        var formData = new FormData(document.getElementById("Form_nuevoEgreso"));

        $.ajax({
            url: "/c_egresop/guardar",
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
                window.open('/c_egresop/index','_parent');            
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
        title: "Por favor espere!",   
        text: "Actualizando la información.", 
        icon: "warning",
        showConfirmButton: false 
      });
      
      var formData = new FormData(document.getElementById("form_actualizar"));

      $.ajax({
          url: "/c_egresop/actualizar",
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
              text: "Registro Actualizado correctamente!",
              icon: "success"
            })
            .then((willDelete) => {
              window.open('/c_egresop/index','_parent');            
            }); 
          } else {
              Swal.fire("¡Error!", res, "error");
          }
      }); 
      return false;
    }

    $(".UpperCase").on("keypress", function () {
        $input=$(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        },50);
    });

    $(".ace-file-input").aceFileInput({          
        btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
        btnChooseText: 'Seleccionar',
        placeholderText: 'Seleccione el Archivo',
        placeholderIcon: '<i class="fa fa-file bgc-warning-m1 text-white w-4 py-2 text-center"></i>'          
    });

    $(document).ready(function() {

        $('form').keypress(function(e){   
            if(e == 13){
                return false;
            }
        });

        $('input').keypress(function(e){
            if(e.which == 13){
                return false;
            }
        });
    });

    
    $('input[type=text], input[type=email], input[type=password], checkbox, select, select2, input[type=number]').on("change", function (event) {
        $('#' + event.target.id).removeClass("brc-danger");
    });




});