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
<input type="hidden" name="opc_pag" id="opc_pag" value="modificar">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
	    <h3 class="card-title text-125 text-primary-d2">
	      <i class="fa fa-cog text-dark-l3 mr-1"></i>
	      Modificar Documento
	    </h3>
  	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  	<div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
			      	<!-- <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0"> -->
				       	<?= form_open(base_url('a_documentos/actualizar'), array('id'=>'form_actualizar', 'name'=>'form_actualizar', 'class'=>'', 'autocomplete'=>'off'));?>
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
						<?= form_input(array('type'=>'hidden', 'name'=>'des_departamentos', 'id'=>'prefdocrela', 'value'=>$c_des_departamentos));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'des_cargos', 'id'=>'prefdocrela', 'value'=>$c_des_cargos));?>
						<div class="card-body px-3 pb-1">
	              			<div class="form-body" style=" justify-content:flex-start;" >

	              				<!-- <div class="form-group row" id="div_solicitud_documentos">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Solicitud*','solicitud', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-4">
			                        <?= select_solicitudesd_tabla('documentos','','form-control col-sm-4 col-md-6" required="1');?>
			                      </div>
		                    	</div> -->
			                    <div class="form-group row" id="div_nombre">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Nombre Documento*','Nombre', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-9">
			                        <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre', 'maxlength'=>'60', 'class'=>' form-control col-sm-12 col-md-10', 'value'=>$c_nombre_documento,'Readonly'=>true));?>
			                      </div>
			                    </div>

			                    <div class="form-group row" id="div_tipodocumentos_documentos">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Tipo Documento *','tipodocumento', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-9">
			                        <?= form_input(array('type'=>'text', 'name'=>'tipodocumento', 'id'=>'tipodocumento', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-9 col-md-10', 'value'=>$c_tipo_documento,'Readonly'=>true));?>
				                  </div>
		                    	</div>

			                    <div class="form-group row" id="div_macroprocesos_documentos">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Macroproceso *','macroproceso', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-9">
			                        <?= form_input(array('type'=>'text', 'name'=>'macroproceso', 'id'=>'macroproceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10', 'Readonly'=>true, 'value'=>$c_macroproceso));?>
				                  </div>
		                    	</div>

		                    	<div class="form-group row" id="div_procesos_documentos">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Proceso *','proceso', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-9">
			                        <?= form_input(array('type'=>'text', 'name'=>'proceso', 'id'=>'proceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10', 'Readonly'=>true, 'value'=>$c_proceso));?>
				                  </div>
		                    	</div>

		                    	<div class="form-group row" id="div_subprocesos_documentos">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Sudproceso','subproceso', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-9">
			                        <?= form_input(array('type'=>'text', 'name'=>'subproceso', 'id'=>'subproceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-9 col-md-10', 'Readonly'=>true, 'value'=>$c_subproceso));?>
				                  </div>
		                    	</div>

		                    	<div class="form-group row" id="div_documentos_relacionados">
			                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
			                        <?= form_label('Documentos Relacionados','docrelacionados', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-9" id="docrelaciondo">
			                        <?= form_input(array('type'=>'text', 'name'=>'docrelacionados', 'id'=>'docrelacionados', 'class'=>' form-control col-sm-9 col-md-10', 'Readonly'=>true, 'value'=>$c_nom_docrelacionado));?>
				                  </div>
				                  <div class="col-sm-9" id="divdocrelaciondos">
						                <?= form_dropdown('doc_relacionados[]', $opcdocrela, $c_docrelacionado, 'class="form-control select2" multiple="multiple" id="doc_relacionados"');?>
						            </div> 
		                    	</div>

		                    	<!-- <div class="form-group row" id="div_aso_documentos">			                    	
			                        <div class="col-sm-3 col-form-label text-sm-right pr-0">
						               	<?= form_label('Modificar Documentos relacionados*','lbl_doc', array('class'=>'mb-0')); ?>
						            </div>
						            <div class="col-sm-1">
						                <?= form_dropdown('sn_doc_relacionado', $opcsndocrela, '', 'class="form-control" id="sn_doc_relacionado"');?>
						            </div>
			                    </div> -->

			                    <div class="form-group row" id="div_codigo">
				                    <div class="col-sm-3 col-form-label text-sm-right pr-0">
				                        <?= form_label('Código *','codigo', array('class'=>'mb-0')); ?>
				                    </div>
				                    <div class="col-sm-8">
				                    	<?= form_input(array('type'=>'text', 'name'=>'codigo', 'id'=>'codigo', 'placeholder'=>'Digite el Código', 'maxlength'=>'15', 'class'=>'form-control col-sm-9 col-md-10', 'required'=>true, 'value'=>$c_codigo,'Readonly'=>true));?>
				                    </div>
			                    </div>

			                    <div class="form-group row" id="div_archivov">
			                    	<div class="col-sm-3 col-form-label text-sm-right pr-0">
						              	<?= form_label('Archivo PDF*','lblarchivov', array('class'=>'mb-0')); ?>
						            </div>
						            <div class="col-sm-8">
						            	<?= form_upload(array('type'=>'file', 'name'=>'archivov', 'id'=>'archivov', 'placeholder'=>'Seleccione el Archivo de Visualización', 'class'=>'form-control ace-file-input col-sm-8 col-md-10', 'required'=>true));?>
						            </div>
						       	</div>

						       	<div class="form-group row" id="div_version">
				                    <div class="col-sm-3 col-form-label text-sm-right pr-0">
				                        <?= form_label('Versión *','version', array('class'=>'mb-0')); ?>
				                    </div>
				                    <div class="col-sm-3">
				                        <?= form_input(array('type'=>'text', 'name'=>'version', 'id'=>'version', 'placeholder'=>'Digite la Versión', 'maxlength'=>'15', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true, 'value'=>$c_version));?>
				                    </div>
			                      	<div class="col-sm-2 col-form-label text-sm-right pr-0">
			                      	<?= form_label('Fecha Versión','fechaversion', array('class'=>'mb-0')); ?>
			                      	</div>
			                      	<div class="col-sm-3">
			                        <?= form_input(array('type'=>'date', 'name'=>'fechaversion', 'id'=>'fechaversion', 'placeholder'=>'Digite la fecha', 'class'=>'form-control col-sm-10 col-md-11', 'required'=>true,'value'=>$c_fechaversion));?>
			                      	</div>
		                    	</div>

	                    		<!-- <div class="form-group row" id="div_archivof">
			                    	<div class="col-sm-3 col-form-label text-sm-right pr-0">
							       	<?= form_label('Archivo Origen *','archivof', array('class'=>'mb-0')); ?>
					              	</div>
						            <div class="col-sm-8">
						            	<?= form_upload(array('type'=>'file', 'name'=>'archivof', 'id'=>'archivof', 'placeholder'=>'Seleccione el Archivo Fuente', 'class'=>'form-control col-sm-9 col-md-10', 'required'=>true));?>
						            </div>
						            <div class="col-sm-1">
					                	
					                </div>
					            </div> -->
					            <div class="form-group row" id="div_destinatarios">
					            	<div class="col-sm-12 col-form-label text-sm-left pr-0">
					                    <h5>
					                    <?= form_label('DESTINATARIOS','destinatarios', array('class'=>'mb-0')); ?>
					                    </h5>
					                </div> 
					            </div> 
					            <div class="form-group row" id="div_card_destinatarios">
					            	<div class="col-sm-1"></div>
						            <div class="dcard col-sm-9 center-block">
					                  	<ul class="nav nav-tabs bgc-secondary-l3 border-y-1 brc-secondary-l3" role="tablist">
						                    <li class="nav-item mr-2px">
						                      <a id="empleados-tab-btn" class="d-style active btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#empleadosdet" role="tab" aria-controls="empleadosdet" aria-selected="true">
						                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n2px"></span>
						                        Empleados
						                      </a>
						                    </li>

						                    <li class="nav-item mr-2px">
						                      <a id="departamentos-tab-btn" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#departamentosdet" role="tab" aria-controls="departamentosdet" aria-selected="false">
						                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n2px"></span>
						                        Departamentos
						                      </a>
						                    </li>

						                    <li class="nav-item">
						                      <a id="cargos-tab-btn" class="d-style btn btn-tp btn-light-secondary btn-h-white btn-a-text-dark btn-a-white text-95 px-3 px-sm-4 py-25 radius-0 border-0" data-toggle="tab" href="#cargosdet" role="tab" aria-controls="cargosdet" aria-selected="false">
						                        <span class="v-active position-tl w-100 border-t-3 brc-blue mt-n2px"></span>
						                        Cargos
						                      </a>
						                    </li>
						                </ul>

						                <div class="tab-content bgc-white p-35 border-0">
						                  <div class="tab-pane fade show active text-95" id="empleadosdet" role="tabpanel" aria-labelledby="empleados-tab-btn">
						                    <div class="alert bgc-default-l3 text-dark-m2 border-0 text-110 mb-0 p-3">
						                      <div class="form-group row" id="div_destinatarios">                   
								                  	<div class="col-sm-2 col-form-label text-sm-right pr-0">
								                    	<?= form_label('Empleados ','empleados', array('class'=>'mb-0')); ?>
								                  	</div>
										                <div class="col-sm-10">
										                    <?= select_empleadosMR_tabla('documentos',$c_des_empleados,'select2 multiple="multiple form-control');?>
										                </div> 
							                		</div>   
						                    </div>
						                  </div>

						                  <div class="tab-pane fade text-95" id="departamentosdet" role="tabpanel" aria-labelledby="departamentos-tab-btn">
						                    <div class="alert bgc-default-l3 text-dark-m2 border-0 text-110 mb-0 p-3">
							                    <div class="form-group row" id="div_destinatarios2">                   
									                 	<div class="col-sm-2 col-form-label text-sm-right pr-0">
									                    <?= form_label('Departamentos ','departamentos', array('class'=>'mb-0')); ?>
									                 	</div>
										                <div class="col-sm-10">
										                  <?= select_departamentosM_tabla('documentos',$c_des_departamentos,'select2 multiple="multiple form-control');?>
										                </div> 
								                	</div>   
						                    </div>
						                  </div>

						                  <div class="tab-pane fade text-95" id="cargosdet" role="tabpanel" aria-labelledby="cargos-tab-btn">
						                    <div class="alert bgc-default-l3 text-dark-m2 border-0 text-110 mb-0 p-3">
							                    <div class="form-group row" id="div_destinatarios3">                   
									                 	<div class="col-sm-2 col-form-label text-sm-right pr-0">
									                    <?= form_label('Cargos ','cargos', array('class'=>'mb-0')); ?>
									                  </div>
										                <div class="col-sm-10">
										                  <?= select_cargosM_tabla('documentos',$c_des_cargos,'select2 form-control multiple="multiple');?>
										                </div> 
								                	</div>   
						                    </div>
						                  </div>
						                </div>
	                				</div><!-- /.bcard -->
	                			</div>

	                			<div class="form-group row" id="div_evaluacion">
			                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
			                        <?= form_label('Se Evalua *','evalua', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-8">
			                        <?= form_dropdown('evalua', $opcevalua, $c_evaluacion, 'class="form-control col-sm-9 col-md-10" id="evalua"');?>
			                      </div>
		                    	</div>

		                    	<div class="form-group row" id="div_estado">
			                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
			                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
			                      </div>
			                      <div class="col-sm-8">
			                        <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control col-sm-9 col-md-10" id="estado"');?>
			                      </div>
		                    	</div>
		                    	<div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
					              <div class="offset-md-3 col-md-9 text-nowrap">
					                <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

					                <?= anchor(base_url('A_documentos/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
					              </div>
					            </div>
		                  	</div><!-- /.Form-body Modal-->
						</div><!-- /.card-body Modal-->	
						<?= form_close(); ?> 
			    	<!-- </div> -->
				</div><!-- /.Modal-body -->
			</div> <!-- /.modal-content -->
		</div>
	</div>	<!-- /.Modal -->
</div>

