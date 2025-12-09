<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="reportes">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fas fa-grip-horizontal text-dark-l3 mr-1"></i>
          Encuestas de Satisfacción 
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Listado de encuestas
			        </h3>

			        <div class="mb-2 mb-sm-0">
			        	<div class="row mr-1">
			          <button type="button" class="btn btn-secondary px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1 ml-2" id="btn_pdf">
			            <i class="fa fa-file-pdf mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_pdf">PDF</span>
			          </button>
			          <button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
			            <i class="fa fa-database mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_excel">Excel</span>
			          </button>
			         <!--  <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" data-toggle="modal" data-target="#newModal" id="btn_nuevo_departamento">
			            <i class="fa fa-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_nuevo_departamento">Nuevo</span>
			          </button> -->
			          </div>
			        </div>
			      </div>

			      <div class="row">
			      	<div class="col-12">
				      <table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
				        <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
				        	<tr>
						          <th>.</th>					          
						          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Servicio</th>		                      
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Encuestado</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
		                  </tr>
				        </thead>

				        <tbody class="pos-rel">
				          
				        </tbody>
				      </table>
				  	</div>
				  </div>
			    <!--/form-->

			    <!-- Modal Ver Encuestas -->
          	<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header card-success">
	                        <h4 class="modal-title text-blue" id="myModalLabel">Datos la Encuesta</h4>
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div>
	                    <div class="modal-body" id="modalFormBody">
	                        <form class="form-horizontal m-t-20" id="modalForm1">
	                        </form>
	                    </div>
	                    <div class="modal-footer">
	                      <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="btn_cancelar_modal">Cerrar</button>
	                    </div>
	                </div>
	                <!-- /.modal-content -->
	            </div>
	            <!-- /.modal-dialog -->
	        </div>
			  </div><!-- /.card-body -->
			</div><!-- /.card -->
		</div><!-- /.col -->
	</div>
</div><!-- /.card -->



