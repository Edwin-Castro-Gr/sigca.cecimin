	<?php
  
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );

  $opctpreg = array(
    '0'   => 'Si/No',
    '1'   => 'Cumple/No cumple/NA',
    '2'   => 'Describir'
  );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fas fa-chart-pie text-dark-l3 mr-1"></i>
          Secciones de Rondas de Serguridad 
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Listado de Secciones
			        </h3>

			        <div class="mb-2 mb-sm-0">
			        	<div class="row mr-1">			       		
				          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" data-toggle="modal" data-target="#newModal" id="btn_nueva_seccion">
				            <i class="fa fa-plus mr-1"></i>
				            <span class="d-sm-none d-md-inline" id="btn_nueva_seccion">Nueva Sección</span>
				          </button>
				          
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
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Ronda</th>
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

			    <!-- Modal Nuevo -->
				<div class="modal fade modal-lg" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
					
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header bgc-primary-m1 brc-white">
				        <h5 class="modal-title text-white" id="newModalLabel">
				          Nueva Sección
				        </h5>

				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      	<?= form_open(base_url('r_secciones/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'', 'autocomplete'=>'off')); ?>
				      		<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
					        <div class="card-body px-3 pb-1">
	                	<div class="form-body">
				                    
											<div class="form-group row" id="div_responsable">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Sección *','nombre', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                      	<?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre de la Ronda', 'maxlength'=>'100', 'class'=>'form-control col-sm-9 col-md-10  UpperCase', 'required'=>true));?>
	                        
	                      </div>
                    	</div>

	                    <div class="form-group row" id="div_ronda">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Ronda *','rondas_secciones', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= select_rondas_tabla('secciones','','select2 form-control col-sm-9 col-md-10');?>
	                      </div>
	                    </div>

                    	<div class="form-group row" id="div_periocidad">	                                         	
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('# Tipo Respuesta*','tiporespuesta', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-6">
	                       <?= form_dropdown('tiporespuesta', $opctpreg, '', 'class="form-control col-sm-9 col-md-10" id="tiporespuesta"');?>
	                      </div>
                    	</div>

                    	<div class="form-group row" id="div_estado">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_dropdown('estado', $opciones, '1', 'class="form-control col-sm-9 col-md-10" id="estado"');?>
	                      </div>
                    	</div>

                    	<div class="form-group row" id="div_agregarPregunta">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Pregunta *','pregunta', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-8">
	                       	<?= form_textarea(array('rows'=>'4', 'name'=>'pregunta', 'id'=>'pregunta', 'placeholder'=>'Digite la pregunta que desea agregar', 'class'=>'form-control w-100', 'value'=>''));?>	                                         		                        
	                      </div>
	                      <div class="col-sm-1">
		                      <button type="button" class="btn btn-primary " id="btnAgregarPreg" name="btnAgregarPreg">
							         		 +
							        		</button>
						        		</div>
                    	</div>

                    	<div class="container " id="div_parte7">                    
	                      <div class="col-form-label text-sm-left pr-0">
	                         <?= form_label('PREGUNTAS','anexos', array('class'=>'mb-0')); ?>
	                         
	                      </div>
	                      <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
	                        <div class="card-body p-0" id="accordionA">
	                          <div class="accordion" id="accordionsecciones">                  
	                          	
	                          </div>
	                        </div>
	                      </div><!-- /.card -->
                    	</div><!-- /.card --> 
                    	<div class="mb-2 mb-sm-0 center">
	                    	<div class="row mr-1">
				       		
								          
				          			</div>
			          			</div>
                  	</div><!-- /.Form-body Modal-->
									</div><!-- /.card-body Modal-->
									<div></div>

						    <div class="modal-footer">
						        <button type="button" class="btn btn-primary " id="btn_guardar" name="btn_guardar">
						          Guardar
						        </button>
						        <button type="button" class="btn btn-primary " id="btn_actualizar" name="btn_actualizar">
						          Actualizar
						        </button>
						        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" id="btn_cerrar" name="btn_cerrar">
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



