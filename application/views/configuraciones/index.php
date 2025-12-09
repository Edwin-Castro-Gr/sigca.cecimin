<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fa fa-sitemap text-dark-l3 mr-1"></i>
        	Configuraciones 
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="mt-45">
						  <ul class="nav nav-justified nav-tabs nav-tabs-simple nav-tabs-static nav-tabs-faded flex-nowrap radius-0 px-2 pt-2 nav-tabs-scroll is-scrollable border-b-2 brc-purple-d2" role="tablist">
						    <li class="nav-item mr-1">
						      <a class="btn btn-light-lightgrey btn-h-light-purple btn-h-text-black btn-a-purple py-2 border-1 border-b-0 radius-b-0 radius-t-2 active" id="listas-tab-btn" data-toggle="tab" href="#listas" role="tab" aria-controls="listas" aria-selected="true">
						        Listas
						      </a>
						    </li>

						    <li class="nav-item mr-1">
						      <a class="btn btn-light-lightgrey btn-h-light-purple btn-h-text-black btn-a-purple py-2 border-1 border-b-0 radius-b-0 radius-t-2" id="profile11-tab-btn" data-toggle="tab" href="#profile11" role="tab" aria-controls="profile11" aria-selected="false">
						        Permisos
						      </a>
						    </li>
						  </ul>

						  <div class="tab-content bgc-white p-4 border-1 border-t-0 brc-purple-l2 radius-b-1">
						    <div class="tab-pane fade text-95 active show" id="listas" role="tabpanel" aria-labelledby="listas-tab-btn">
						      <div class="alert mb-0 bgc-secondary-l3 border-0 text-110">
						        <div class="row">
							      	<div class="col-12">
									      <table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
									        <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
									        	<tr>
										          <th>.</th>
										          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
					                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre Lista</th>
					                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
					                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
							              </tr>
									        </thead>

									        <tbody class="pos-lista">
									          
									        </tbody>
									      </table>
									  	</div>
									  </div>
						      </div>
						    </div>

						    <div class="tab-pane fade text-95" id="profile11" role="tabpanel" aria-labelledby="profile11-tab-btn">
						      <div class="alert mb-0 bgc-secondary-l3 border-0 text-110">
						        2. Configuración de Permisos.
						      </div>
						    </div>
				    
						  </div>
						</div>

			      <section class="" id="section_detalle">
			      	
			      </section>
			      
			    <!--/form-->

			    <!-- Modal Nuevo -->
				<div class="modal fade modal-" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
					
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header bgc-primary-m1 brc-white">
				        <h5 class="modal-title text-white" id="newModalLabel">
				          Nuevo Cargo
				        </h5>

				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      	<?= form_open(base_url('a_cargos/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'', 'autocomplete'=>'off')); ?>
				      		<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
					        <div class="card-body px-3 pb-1">
	                			<div class="form-body">
				                    <div class="form-group row" id="div_nombre">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Nombre *','Nombre', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre', 'class'=>'form-control col-sm-9 col-md-10 UpperCase', 'required'=>true));?>
				                      </div>
				                    </div>

									<div class="form-group row" id="div_titulo">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Titulo del Cargo *','titulo', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_input(array('type'=>'text', 'name'=>'titulo', 'id'=>'titulo', 'placeholder'=>'Digite el Titulo del Cargo', 'class'=>'form-control col-sm-9 col-md-10 UpperCase', 'required'=>true));?>
				                      </div>
				                    </div>

				                    <div class="form-group row" id="div_naturaleza">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Naturaleza del Cargo *','naturaleza', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_input(array('type'=>'text', 'name'=>'naturaleza', 'id'=>'naturaleza', 'placeholder'=>'Digite la Naturaleza del Cargo', 'class'=>'form-control col-sm-9 col-md-10 UpperCase' , 'required'=>true));?>
				                      </div>
			                    	</div>

				                    <div class="form-group row" id="div_estado">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_dropdown('estado', $opciones, '1', 'class="form-control col-sm-9 col-md-10" id="estado"');?>
				                      </div>
			                    	</div>
			                  	</div><!-- /.Form-body Modal-->
							</div><!-- /.card-body Modal-->

						    <div class="modal-footer">
						        <button type="submit" class="btn btn-primary " id="btn_guardar" name="btn_guardar">
						          Guardar
						        </button>
						        <button type="submit" class="btn btn-primary " id="btn_actualizar" name="btn_actualizar">
						          Actualizar
						        </button>
						        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
						          Cerrar
						        </button>
							</div>
						<?= form_close(); ?>
				      </div><!-- /.Modal-body -->
				    </div> <!-- /.modal-content -->
				  </div>
            	</div>	<!-- /.Modal -->

            	<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		            <div class="modal-dialog">
		                <div class="modal-content">
		                    <div class="modal-header card-success">
		                        <h4 class="modal-title text-blue" id="myModalLabel">Datos del Registro</h4>
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