<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Pendiente',
    '1'   => 'Aceptado',
    '2'   => 'Rechazada'
  );
  $opcionesTsolicitud = array(
    '1'   => 'Creación',
    '2'   => 'Modificación',
    '3'   => 'Eliminación'
  );
  $opcionesOrigen= array(
  	'0'   => 'N/A',
    '1'   => 'Interno',
    '2'   => 'Externo'
  );
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fa fa-cog text-dark-l3 mr-1"></i>
          Solicitudes
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Listado de Solicitudes
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
			           <a href="<?php echo base_url('d_solicitud/nuevo')?>">
			          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_nueva_solicitud">
			            <i class="fa fa-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_nueva_solicitud">Nuevo</span>
			          </button>
			          </a>
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
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Tipo de Solicitud</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Tipo de Documento</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre del Documento</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Proceso</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Responsable</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha de Solicitud</th>
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
				          Nueva Solicitud
				        </h5>

				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      	<?= form_open(base_url('d_solicitud/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'', )); ?>
				      		<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
					        <div class="card-body px-3 pb-1">
	                			<div class="form-body">
	                				<div class="form-group row" id="div_tipo_solicitud">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Tipo Solicitud *','estado', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_dropdown('tipo_solicitud', $opcionesTsolicitud, '1', 'class="form-control col-sm-9 col-md-10" id="estado"');?>
				                      </div>
			                    	</div>
			                    	<div class="form-group row" id="div_tipo_documento">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Tipo de Documento *','tdocumento', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= select_tipodocumentos_tabla('solicitud','','form-control col-sm-9 col-md-10');?>
				                      </div>
			                    	</div>
				                    <div class="form-group row" id="div_nombre">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Nombre del Documento *','Nombre Documento', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre del documento', 'maxlength'=>'20', 'class'=>'form-control col-sm-9 col-md-10', 'required'=>true));?>
				                      </div>
				                    </div>
				                    <div class="form-group row" id="div_procesos">
		                      			<div class="col-sm-4 col-form-label text-sm-right pr-0">
		                        			<?= form_label('Proceso *','proceso', array('class'=>'mb-0')); ?>
		                      			</div>
		                      			<div class="col-sm-8">
		                        		<?= select_procesos_tabla('solicitud','','form-control col-sm-9 col-md-10" required="1');?>
		                      			</div>
	                    			</div>

	                    			<div class="form-group row" id="div_subprocesos">
		                      			<div class="col-sm-4 col-form-label text-sm-right pr-0">
		                        			<?= form_label('Subproceso *','subproceso', array('class'=>'mb-0')); ?>
		                      			</div>
		                      			<div class="col-sm-8">
		                        		<?= select_subprocesos_tabla('solicitud','','form-control col-sm-9 col-md-10" required="1');?>
		                      			</div>
	                    			</div>

	                    			<div class="form-group row" id="div_responsable">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Nombre del Solicitante *','Solicitante', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= select_empleados_tabla('solicitud','','form-control col-sm-9 col-md-10');?>
				                      </div>
			                    	</div>

			                    	<div class="form-group row" id="div_justificacion">
		                      			<div class="col-sm-4 col-form-label text-sm-right pr-0">
		                        			<?= form_label('Justificacion *','justificacion', array('class'=>'mb-0')); ?>
		                      			</div>
		                      			<div class="col-sm-8">
		                        		<?= form_textarea(array('rows'=>'2', 'name'=>'justificacion', 'id'=>'justificacion', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales se tramita la solicitud', 'class'=>'form-control col-sm-9 col-md-10', 'required'=>true));?>
		                      			</div>
		                    		</div>

				                    <div class="form-group row" id="div_documentos_r">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Documento Relacionado *','documentos_r', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <select class="chosen-select form-control" id="Documento_r">
											<option></option>

       									</select>
				                      </div>
				                      				                      
				                    </div>

				                    <div class="form-group row" id="div_doc_rel">
		                      			<div class="col-sm-4 col-form-label text-sm-right pr-0">
		                        			<?= form_label('documento *','documento', array('class'=>'mb-0')); ?>
		                      			</div>
		                      			<div class="col-sm-8">
		                        		<?= select_documentos_tabla('solicitud','','select2 form-control col-sm-9 col-md-10" required="1');?>
		                      			</div>
	                    			</div>

				                    <div class="form-group row" id="div_origen_formato">
				                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
				                        <?= form_label('Origen Formato *','origen_formato', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-8">
				                        <?= form_dropdown('origen', $opcionesOrigen, '0', 'class="form-control col-sm-9 col-md-10" id="estado"');?>
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
			                    <div class="mt-45 radius-">
				                  <ul class="nav nav-tabs nav-justified nav-tabs-scroll border-b-1 bgc-info-m3 pt-2 pl-2 radius-t-1" role="tablist">
				                    
				                    <li class="nav-item mr-3px">
				                      <a class="btn btn-brc-tp btn-info btn-h-red btn-a-white btn-a-text-info text-95 px-3 px-lg-4 py-2 border-0 radius-b-0" data-toggle="tab" href="#cargos" role="tab" aria-controls="cargos" aria-selected="true">
				                        Destinatarios
				                      </a>
				                    </li>				                    			                    
				                  </ul>

				                  <div class="tab-content bgc-white p-35 border-1 border-t-0 brc-default-l2 radius-b-1">
				                    
				                    <div class="tab-pane fade text-95" id="cargos" role="tabpanel">
				                      <div class="row" style="height: 250px;">
						                  <div class="col-md-6" style="overflow: auto; height: 100%;">
						                    <?= listar_cargos_chk('nue','','');?>
						                  </div>
						                  <div class="col-md-6" style="overflow: auto; height: 100%;">
						                    <table class="list-group"><tbody id="cargos_seleccionados"></tbody></table>
						                    <?= form_input(array('type'=>'hidden','name'=>'total_idcargo','id'=>'total_idcargo'));?>
						                    <?= form_input(array('type'=>'hidden','name'=>'todos_idcargo','id'=>'todos_idcargo'));?>
						                  </div>
							          </div>
				                    </div>
				                  </div>
				                 </div><!-- /.bcard -->
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



