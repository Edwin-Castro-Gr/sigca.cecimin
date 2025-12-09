<?php
  //echo $id;
  $c_archivo_original='0';
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );

  $opcsndocrela = array(
   'No'   => 'No',
   'Si'   => 'Si'
  );

  $opcdocrela= array(
    '0'   => 'Seleccione un Documento relacionado'
  );

  $opcevalua = array(
    '0'   => 'No',
    '1'   => 'Si'
  );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="socializar">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
	    <h3 class="card-title text-125 text-primary-d2">
	      <i class="fa fa-cog text-dark-l3 mr-1"></i>
	      Socializar Documento
	    </h3>
  	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
			    <!-- <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0"> -->
				    <?= form_open(base_url('a_documentos/socializar'), array('id'=>'form_socializar', 'name'=>'form_socializar', 'class'=>'', 'autocomplete'=>'off'));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_documento));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'idsolicitud', 'id'=>'idsolicitud', 'value'=>$c_id_solicitud));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'idusuariocrea', 'id'=>'idusuariocrea', 'value'=>$c_id_usuario));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'Id_Tipo', 'id'=>'Id_Tipo', 'value'=>$c_tipo_documento));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'Id_macro', 'id'=>'Id_macro', 'value'=>$c_id_Macroproceso));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'Id_proceso', 'id'=>'Id_proceso', 'value'=>$c_id_proceso));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'Id_subproceso', 'id'=>'Id_subproceso', 'value'=>$c_id_subproceso));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'Prefijo', 'id'=>'Prefijo', 'value'=>'0'));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'Pref_subproceso', 'id'=>'Pref_subproceso', 'value'=>'0'));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'doc_relacionado', 'id'=>'doc_relacionado', 'value'=>$c_docrelacionado));?>
							<?= form_input(array('type'=>'hidden', 'name'=>'prefdocrela', 'id'=>'prefdocrela', 'value'=>'0'));?>
						<div class="card-body px-3 pb-1">
	            <div class="form-body" style=" justify-content:space-between;" >
                <div class="form-group row" id="div_nombre">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Nombre Documento','Nombre', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-10">
                    <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre', 'maxlength'=>'100', 'class'=>' form-control col-sm-12 col-md-10', 'value'=>$c_nombre_documento,'Readonly'=>true));?>
                  </div>
                </div>
                <div class="form-group row" id="div_tipodocumentos_documentos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Tipo Documento','tipodocumento', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'tipodocumento', 'id'=>'tipodocumento', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-9 col-md-10', 'value'=>$c_tipo_documento,'Readonly'=>true));?>
                	</div>
              	
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Macroproceso','macroproceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'macroproceso', 'id'=>'macroproceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10', 'Readonly'=>true, 'value'=>$c_macroproceso));?>
                	</div>
              	</div>

              	<div class="form-group row" id="div_procesos_documentos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Proceso *','proceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'proceso', 'id'=>'proceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10', 'Readonly'=>true, 'value'=>$c_proceso));?>
                	</div>		                    	
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Sudproceso','subproceso', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'subproceso', 'id'=>'subproceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-9 col-md-10', 'Readonly'=>true, 'value'=>$c_subproceso));?>
                  	</div>
                	</div>

                  <div class="form-group row" id="div_documentos_relacionados">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Documentos Relacionados','docrelacionados', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-9" id="docrelaciondo">
                      <?= form_input(array('type'=>'text', 'name'=>'docrelacionados', 'id'=>'docrelacionados', 'class'=>' form-control col-sm-9 col-md-10', 'Readonly'=>true, 'value'=>$c_nom_docrelacionado));?>
	                  </div>
	                  
                  </div>
                  <div class="form-group row" id="div_codigo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Código *','codigo', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    	<?= form_input(array('type'=>'text', 'name'=>'codigo', 'id'=>'codigo', 'placeholder'=>'Digite el Código', 'maxlength'=>'15', 'class'=>'form-control col-sm-9 col-md-10', 'value'=>$c_codigo,'Readonly'=>true));?>
                    </div>
                  </div>		                    

						      <div class="form-group row" id="div_version">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Versión','version', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                        <?= form_input(array('type'=>'text', 'name'=>'version', 'id'=>'version', 'placeholder'=>'Digite la Versión', 'maxlength'=>'15', 'class'=>'form-control col-sm-11 col-md-12', 'value'=>$c_version,'Readonly'=>true));?>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    	<?= form_label('Fecha Versión','fechaversion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-3">
                      <?= form_input(array('type'=>'date', 'name'=>'fechaversion', 'id'=>'fechaversion', 'placeholder'=>'Digite la fecha', 'class'=>'form-control col-sm-10 col-md-11', 'value'=>$c_fechaversion,'Readonly'=>true));?>
                    </div>
                	</div>	                    
			            <div class="form-group row" id="div_destinatarios">
			            	<div class="col-sm-12 col-form-label text-sm-left pr-0">
	                    <h5>
	                    <?= form_label('DESTINATARIOS','destinatarios', array('class'=>'mb-0')); ?>
	                    </h5>
			              </div> 
			            </div> 
					        <div class="form-group row" id="div_card_destinatarios">					         
						          <div class="dcard col-sm-12 center-block">
		                  	<div class="form-group row" id="div_destinatarios3">                   
				                 	<div class="col-sm-2 col-form-label text-sm-right pr-0">
				                    <?= form_label('Cargos ','cargos', array('class'=>'mb-0')); ?>
				                  </div>
					                <div class="col-sm-10">
					                  <?= select_cargosM_tabla('documentos',$c_des_cargos,'select2 multiple="multiple form-control');?>
					                </div> 
			                	</div>		                
		                    <div class="form-group row" id="div_destinatarios">                   
			                  	<div class="col-sm-2 col-form-label text-sm-right pr-0">
			                    	<?= form_label('Empleados ','empleados', array('class'=>'mb-0')); ?>
			                  	</div>
					                <div class="col-sm-10">
					                   <!--  <?= select_empleadosMR_tabla('documentos','','select2 multiple="multiple form-control');?> -->
					                    <?= form_dropdown('funcionarios[]', '', '', 'class="select2 form-control" id="funcionarios"');?>
					                </div> 
		                		</div>   
						          </div>					                  
						       	</div>
	                	<div class="form-group row" id="div_evaluacion">
	                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                      <?= form_label('Se Evalua *','evalua', array('class'=>'mb-0')); ?>
	                    </div>
	                    <div class="col-sm-4">
	                      <?= form_dropdown('evalua', $opcevalua,'', 'class="form-control col-sm-9 col-md-10" id="evalua"');?>
	                    </div>
                  	</div>
		                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25 center-block">
				              <div class="offset-md-3 col-md-9 text-nowrap ">
				                <?= form_button(array('type'=>'button', 'id'=>'btn_socializar', 'name'=>'btn_socializar', 'content'=>'<i class="fa fa-envelope mr-1"></i>Enviar', 'class'=>'btn btn-info btn-bold px-4')); ?>

				                <?= anchor(base_url('a_documentos/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
				              </div>
					         	</div>
		             	</div><!-- /.Form-body Modal-->
								</div><!-- /.card-body Modal-->	
						<?= form_close(); ?> 
			    	<!-- </div> -->
					<!-- </div> --><!-- /.Modal-body -->
				</div><!-- /.Modal-body -->
			</div> <!-- /.modal-content -->
		</div>
	</div>	<!-- /.Modal -->
</div>

