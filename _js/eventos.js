$(function () {

	if (!window.Intl) {
          console.log("Calendar can't be displayed because your browser doesn's support `Intl`. You may use a polyfill!");
          return;
        }


        //hide/show relevant alert messages according to device
        if ('ontouchstart' in window) {
          $('#alert-1').removeClass('d-none')
          $('#alert-2').addClass('d-none')
        }


        // initialize the external events
        new FullCalendar.Draggable(document.getElementById('external-events'), {
          itemSelector: '.fc-event',
          longPressDelay: 50,
          eventData: function(eventEl) {
            return {
              title: eventEl.innerText,
              classNames: eventEl.getAttribute('data-class').split(' ')
            }
          }
        })



        // change styling options and icons
        FullCalendar.BootstrapTheme.prototype.classes = {
          root: 'fc-theme-bootstrap',
          table: 'table-bordered table-bordered brc-default-l2 text-secondary-d1 h-95',
          tableCellShaded: 'bgc-secondary-l3',
          buttonGroup: 'btn-group',
          button: 'btn btn-white btn-h-lighter-blue btn-a-blue',
          buttonActive: 'active',
          popover: 'card card-primary',
          popoverHeader: 'card-header',
          popoverContent: 'card-body',
        };
        FullCalendar.BootstrapTheme.prototype.baseIconClass = 'fa';
        FullCalendar.BootstrapTheme.prototype.iconClasses = {
          close: 'fa-times',
          prev: 'fa-chevron-left',
          next: 'fa-chevron-right',
          prevYear: 'fa-angle-double-left',
          nextYear: 'fa-angle-double-right'
        };
        FullCalendar.BootstrapTheme.prototype.iconOverrideOption = 'FontAwesome';
        FullCalendar.BootstrapTheme.prototype.iconOverrideCustomButtonOption = 'FontAwesome';
        FullCalendar.BootstrapTheme.prototype.iconOverridePrefix = 'fa-';



        //for some random events to be added
        var date = new Date();
        var m = date.getMonth();
        var y = date.getFullYear();

        var day1 = Math.random() * 20 + 2;
        var day2 = Math.random() * 25 + 1;
        var today = moment(new Date()).format('YYYY-MM-DD');

        // initialize the calendar
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
          themeSystem: 'bootstrap',
          
          headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          },

          buttonText: {
                prev: 'Anterior',
                next: 'Siguiente',
                today: 'Hoy',
                month: 'Mes',
                week : 'Semana',
                day  : 'Día',
                listWeek: 'Lista'
            },

          events: [{
              title: 'Evento 3',
              start: new Date(y, m, 1, Math.random() * 23 + 1),
              allDay: true,
              className: 'bgc-red-d1 text-white text-95'
            },

            {
              title: 'Evento 2',
              start: new Date(y, m, day1, Math.random() * 23 + 1),
              end: new Date(y, m, day1 + 4, Math.random() * 23 + 1),
              allDay: true,
              className: 'bgc-green-d2 text-white text-95'
            },
            {
              title: 'Evento 1',
              start: new Date(y, m, day2, Math.random() * 23 + 1),
              allDay: true,
              className: 'bgc-blue-d2 text-white text-95'
            }
          ],

          locale: 'es',
          selectable: true,
          selectLongPressDelay: 200,

          select: function(date) {
          	
          	if (moment(date.start).format('YYYY-MM-DD') >= today) {
            	bootbox.prompt("Nuevo Evento:", function(title) {
              		if (title !== null && title.length > 0) {
	                calendar.addEvent({
		                  title: title,
		                  start: date.start,
		                  end: date.end,
		                  allDay: true,
		                  classNames: ['text-95', 'bgc-info-d2', 'text-white']
	                	});
	            	}
            	});
       		}else{
       			 Swal.fire("¡Atención!", "La fecha Seleccionada no esta disponible", "warning");
       		}
          },


          editable: true,
          droppable: true,

          drop: function(info) {
            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
              info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
          },


          eventClick: function(info) {
            //display a modal
            var modal =
              '<div class="modal fade">\
    			  <div class="modal-dialog">\
             		<div class="modal-content">\
              			<div class="modal-header">\
			                <h5 class="modal-title">Modificar Evento</h5>\
			                <button type="button" class="close" data-dismiss="modal">&times;</button>\
			            </div>\
			            <div class="modal-body">\
			                <form class="m-0" id="modificar_evento">\
			                  	<div class="input-group">\
				                    <div class="input-groupp-repend align-self-center mr-2">\
				                        Evento\
				                    </div>\
				                      <input class="form-control" autocomplete="off" type="text" value="' + info.event.title + '" />\
				                    <div class="input-group-append">\
				                        <button type="submit" class="btn btn-sm btn-success btn-bold"><i class="fa fa-check mr-2px"></i> Save</button>\
				                        <button type="button" class="btn btn-sm btn-outline-danger btn-bold ml-2px" data-action="delete"><i class="far fa-trash-alt text-120"></i></button>\
				                    </div>\
			                  	</div>\
			                </form>\
			            </div>\
    			  </div>\
    			 </div>\
    			</div>';


            var modal = $(modal).appendTo('body');
            modal.find('form').on('submit', function(ev) {
              ev.preventDefault();

              info.event.setProp('title', $(this).find("input[type=text]").val());

              modal.modal("hide");
            });
            modal.find('button[data-action=delete]').on('click', function() {
              info.event.remove();
              modal.modal("hide");
            });

            modal.modal('show').on('hidden.bs.modal', function() {
              modal.remove();
            });
          }

        });



        //
        calendar.render();

	
	//cargar_listado();


	function cargar_listado() {
	    Swal.fire({ 
	      title: "Por favor espere!",   
	      text: "Cargando lista de Cirugias.",
	      showConfirmButton: false 
	    });
	    
	    $.post("/cc_cirugias/listar_tabla",{}, function(data_carg){
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
	    
	    if(datos[0] == "btneditar") {
	      idreg = datos[1];
	      $('#newModalLabel').html('Modificar Cirugia');
	      
	      $.post("/cc_cirugias/modificar",{idreg: ""+idreg+""}, function(data_preg){
        

	        $('#idregistro').val(data_preg['cirugias'].id_ccirugias);

	        $('#periodo').val(data_preg['cirugias'].periodo);
	        $('#procedimientoscx_costos').val(data_preg['cirugias'].id_procedimientoqx);
	        $('#procedimientoscx_costos').change();

	        $('#cantidad').val(data_preg['cirugias'].cantidad);

	        $('#div_estado').css("display", "flex");
	        $("#estado").val(data_preg['cirugias'].estado);
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
	            	$.post("/cc_cirugias/inactivar",{idreg: ""+id_reg+""}, function(data_form){
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
	      
	      $.post("/cc_cirugias/ver_registro",{idreg: ""+idreg+""}, function(data_carg){
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
	      
	      if( $('#periodo').val()=="" ){
	        $('#periodo').addClass("brc-danger");
	        texto=texto+"* El periodo es obligatorio!<br>";
	        ban=1;
	      }
	      if( ($('#procedimientoscx_costos').val()=="")){
	        $('#procedimientoscx_costos').addClass("brc-danger");
	        texto=texto+"* El procedimiento es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#cantidad').val()=="" ){
	        $('#cantidad').addClass("brc-danger");
	        texto=texto+"* La Cantidad es obligatorio!";
	        ban=1;
	      }
	      if( $('#tiempoQx').val()=="" ){
	        $('#tiempoQx').addClass("brc-danger");
	        texto=texto+"* El Tiempo Qx es obligatorio!";
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
	        $.post("/cc_cirugias/guardar", datos_form , function(data_form){
	          Swal.close();
	          if(data_form=="1") {
	            //jQuery(function(){
	              Swal.fire({
	                title: "¡Correcto!",
	                text: "Registro ingresado correctamente!",
	                icon: "success"
	              })
	              .then((willDelete) => {
	              	$("#procedimientoscx_costos").val('');
	              	$('#cantidad').val('');
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

	  	if(dato == "btn_nueva_cirugia") {
	  		$('#newModalLabel').html('Nueva Cirugia');
	  		$('#btn_guardar').css("display", "block");
	      	$('#btn_actualizar').css("display", "none");
	      	$('#div_estado').css("display", "none");
	      	$("#form_guardar")[0].reset();
	  	}

	  	if(dato == "btn_actualizar") {
	      var ban=0;
	      var texto='';

	      if( $('#codigo').val()=="" ){
	        $('#codigo').addClass("brc-danger");
	        texto=texto+"* El código es obligatorio!<br>";
	        ban=1;
	      }
	      if( ($('#nombre').val()=="")){
	        $('#nombre').addClass("brc-danger");
	        texto=texto+"* El nombre es obligatorio!<br>";
	        ban=1;
	      }
	      if( $('#cantidad').val()=="" ){
	        $('#cantidad').addClass("brc-danger");
	        texto=texto+"* La Cantidad es obligatorio!";
	        ban=1;
	      }
	      if( $('#tiempoQx').val()=="" ){
	        $('#tiempoQx').addClass("brc-danger");
	        texto=texto+"* El Tiempo Qx es obligatorio!";
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
	        $.post("/cc_cirugias/actualizar", datos_form , function(data_form){
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
	  		window.open('/cc_cirugias/pdf','_blank');
	  	}

	  	if(dato == "btn_excel") {
	  		window.open('/cc_cirugias/excel','_blank');
	  	}
  	});

	$('input[type=text], input[type=email], input[type=password], select, select2, input[type=number]').on("change", function(event){
		$('#'+event.target.id).removeClass("brc-danger");    
	});

});