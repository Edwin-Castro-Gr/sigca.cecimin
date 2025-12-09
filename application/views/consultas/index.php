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
	      <i class="fa fa-cog text-dark-l3 mr-1"></i>
	      Consultas de Documentos
	    </h3>
  	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
		      	<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Listar de Documentos por
			        </h3>

			        <div class="mb-2 mb-sm-0">
			        	<div class="row mr-1">

			        		<!-- 
				        	<button type="button" class="btn btn-yellow px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
					            <i class="fa fa-database mr-1"></i>
					            <span class="d-sm-none d-md-inline" id="btn_enviar">Enviar</span>
					        </button>
					         -->
				        	
				        	<a href="<?php echo base_url('d_consultas/excel')?>">
				        	<button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
					            <i class="fa fa-database mr-1"></i>
					            <span class="d-sm-none d-md-inline" id="btn_excel">Excel</span>
					        </button>
					        </a>

					        <a href="<?php echo base_url('a_procesos/mapa')?>">
				          <button type="button" class="btn btn-danger px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1 ml-2" id="btn_mapa">
				            <i class="fa fa-table mr-1"></i>
				            <span class="d-sm-none d-md-inline" id="btn_mapa">MAPA DE PROCESO</span>
				          </button>				         
			            </a>
			          </div>			          
		      		</div>
		      	</div>
		      		<div class="form-group row">
		      			
				        <div class="col-sm-3">
				        	<?= form_label('Proceso','lblproceso', array('class'=>'mb-0','id'=>'lblproceso')); ?>
				        	<?= select_procesos_tabla('consulta','','select2 form-control');?>
				        </div>
				        <div class="col-sm-3">
					        <?= form_label('Subprocesos','lblsuproceso', array('class'=>'mb-0','id'=>'lblsuproceso')); ?>
				        	<?= select_subprocesos_tabla('consulta','','select2 form-control');?>
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
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Tipo</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Proceso</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Código</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Archivo</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Versión</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
		                  </tr>
				        </thead>

				        <tbody class="pos-rel">
				          
				        </tbody>
				      </table>
				  	</div>
			  	</div>
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div><!-- /.col -->
	</div>
</div><!-- /.card -->

<!-- Modal Ver Registro -->

<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header card-success">
	        <h4 class="modal-title text-blue" id="myModalLabel">Datos del Registro</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
	    </div>
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

<!-- Modal Importar Documentos -->

<div id="importar" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabelImp" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header card-success">
                <h4 class="modal-title text-blue" id="myModalLabelImp">Importar Registros</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
            </div>
            <div class="modal-body" id="modalFormBody">
                <?= form_open(base_url('a_documentos/importar_documentos'), array('id'=>'form_importar', 'name'=>'form_importar', 'class'=>'', 'autocomplete'=>'off')); ?>
                	<div class="form-group row" id="div_archivov">
                    	<div class="col-sm-3 col-form-label text-sm-right pr-0">
			              	<?= form_label('Archivo excel*','lblarchivoxls', array('class'=>'mb-0')); ?>
			            </div>
			            <div class="col-sm-8">
			            	<?= form_upload(array('type'=>'file', 'name'=>'upload_file', 'id'=>'upload_file', 'placeholder'=>'Seleccione el Archivo a importar', 'class'=>'form-control ace-file-input col-sm-8 col-md-10', 'required'=>true, 'accept'=>".xlsx"));?>
			            </div>
			       	</div>
               	<?= form_close(); ?>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary " id="btn_importar" name="btn_importar">
    				Guardar
  				</button>
              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" id="btn_cancelar_modal">Cerrar</button>
            </div>
        </div>
  			<!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

	        	


