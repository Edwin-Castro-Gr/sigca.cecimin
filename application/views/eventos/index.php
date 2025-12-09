<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fas fa-calendar-alt text-dark-l3 mr-1"></i>
          Calendario de Eventos 
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  	<div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
				    <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
				        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
				          Eventos Programados
				        </h3>

				    </div>
				    
            <!-- message to be displayed on touch devices -->
            <div id="alert-1" class="d-none alert bgc-white border-l-4 brc-purple-m1 shadow-sm" role="alert">
              Toque un intervalo de fecha y manténgalo presionado para agregar un nuevo evento
            </div>



            <div class="row">
              <div class="col-12 col-md-9" id='calendar-container'>
                <div class="card acard">
                  <div class="card-body p-lg-4">
                    <div id='calendar' class="text-blue-d1"></div>
                  </div>
                </div>
              </div>


              <div class="col-12 col-md-3 mt-3 mt-md-4" id='external-events'>
                <div class="bgc-secondary-l4 border-1 brc-secondary-l2 shadow-sm p-35 radius-1">
                  <p class="text-120 text-primary-d2">
                    Eventos arrastrables
                  </p>

                  <p id="alert-2" class="alert bgc-white border-none border-l-4 brc-purple-m1">
                    Puede Arrastrar co click sostenido o  hacer click sobre el dia para agregar un nuevo evento.
                  </p>

                  <div>
                    <div class='fc-event badge bgc-blue-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-blue-d1 text-white text-95">
                      	Evento 1
                    </div>
                    <div class='fc-event badge bgc-green-d2 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-green-d2 text-white text-95">
                     	Evento 2
                    </div>
                    <div class='fc-event badge bgc-red-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                     	Evento 3
                    </div>
                    <div class='fc-event badge bgc-purple-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                        Evento 4
                    </div>
                    <div class='fc-event badge bgc-orange-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-orange-d1 text-white text-95">
                      	Evento 5
                    </div>
                  </div>

                  <label class="mt-2">
                    <input type="checkbox" id='drop-remove' class="mr-1" />
                    Remover Despues
                  </label>
                </div>

              </div>
            </div>

			  	</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div><!-- /.col -->
	</div>
</div><!-- /.card -->
