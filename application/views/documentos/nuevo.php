<?php
  //echo $id;
  $c_archivo_original='0';
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );

  $opctipo = array(
  	'' => 'Seleccione un tipo',
    '0'   => 'Interno',
    '1'   => 'Externo'
  );


  $opcclase = array(
  	''	  => 'Seleccione una Opción',
    '0'   => 'Leyes',
    '1'   => 'Decretos',
    '2'   => 'Resoluciones',
    '3'   => 'Circulares',
    '4'   => 'Acuerdos',
    '5'   => 'Guías de Práctica Clínica',    
    '6'   => 'Otras Guías',
    '7'		=> 'Otros'
    
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
<input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
	    <h3 class="card-title text-125 text-primary-d2">
	      <i class="fa fa-cog text-dark-l3 mr-1"></i>
	      Nuevo Documento
	    </h3>
  </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
			      	<!-- <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0"> -->
				  <?= form_open(base_url('a_documentos/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'', 'autocomplete'=>'off')); ?>
						<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'Id_Tipo', 'id'=>'Id_Tipo', 'value'=>''));?>						
						<?= form_input(array('type'=>'hidden', 'name'=>'Id_Tipo_Solicitud', 'id'=>'Id_Tipo_Solicitud', 'value'=>''));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'tipo_documento', 'id'=>'tipo_documento', 'value'=>'0'));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'Id_macro', 'id'=>'Id_macro', 'value'=>''));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'Id_proceso', 'id'=>'Id_proceso', 'value'=>''));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'Id_subproceso', 'id'=>'Id_subproceso', 'value'=>''));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'Prefijo', 'id'=>'Prefijo', 'value'=>'0'));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'Pref_subproceso', 'id'=>'Pref_subproceso', 'value'=>''));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'doc_relacionado', 'id'=>'doc_relacionado', 'value'=>''));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'prefdocrela', 'id'=>'prefdocrela', 'value'=>''));?>
						<div class="card-body px-3 pb-1">
	            <div class="form-body" style=" justify-content:flex-start;" >
	      				<div class="form-group row" id="div_solicitud_documentos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Solicitud*','solicitudesd_documentos', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_solicitudesd_tabla('documentos','','form-control col-sm-4 col-md-6" required="1');?>
                  </div>	
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
			              <?= form_label('Tipo *','tipo', array('class'=>'mb-0','id'=>'lbltipo')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('tipo', $opctipo, '0', 'class="form-control col-sm-9 col-md-10" id="tipo"');?>
                  </div>
	              </div>
                <div class="form-group row">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Nombre Documento*','nombre', array('class'=>'mb-0', 'id'=>'')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre', 'maxlength'=>'120', 'class'=>' form-control col-sm-12 col-md-10 UpperCase', 'Readonly'=>true));?>
                  </div>
                
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Tipo Documento ','tipodocumentos_documento', array('class'=>'mb-0','id'=>'lbltipodocumento')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'tipodocumento', 'id'=>'tipodocumento', 'placeholder'=>'', 'maxlength'=>'120', 'class'=>' form-control col-sm-9 col-md-10'));?>
                     <?= select_tipodocumentos_tabla('documento','OD','form-control');?>
                	</div>
              	</div>

              	<div class="form-group row" id="div_clase_documentos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_col1">
                    <?= form_label('Clase Documento: ','clase_documento', array('class'=>'mb-0','id'=>'lblclase')); ?>
                  </div>
                  <div class="col-sm-4" id="div_col2">
                    <?= form_dropdown('clase_documento',$opcclase, '', 'class= "form-control" id="clase_documento"');?>
                	</div>
              	
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_col3">
                    <?= form_label('Expedida por: ','expide', array('class'=>'mb-0','id'=>'lblexpide')); ?>
                  </div>
                  <div class="col-sm-4" id="div_col4">
                    <?= form_input(array('type'=>'text', 'name'=>'expide', 'id'=>'expide', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10 UpperCase'));?>                              
                	</div>
              	</div>

                <div class="form-group row" id="div_macroprocesos_documentos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_lbl_1">
                    <?= form_label('Macroproceso *','macroproceso', array('class'=>'mb-0','id'=>'lblmacroproceso')); ?>
                  </div>
                  <div class="col-sm-4" id="div_1">
                    <?= form_input(array('type'=>'text', 'name'=>'macroproceso', 'id'=>'macroproceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10', 'Readonly'=>true));?>
                    <?= select_macroprocesos_tabla('documento','','form-control "required="true"');?>
                    
                	</div>
              	
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_lbl_2">
                    <?= form_label('Proceso *','proceso', array('class'=>'mb-0','id'=>'lblproceso')); ?>
                  </div>
                  <div class="col-sm-4" id="div_2">
                    <?= form_input(array('type'=>'text', 'name'=>'proceso', 'id'=>'proceso', 'placeholder'=>'', 'maxlength'=>'60', 'class'=>' form-control col-sm-10 col-md-10', 'Readonly'=>true));?>
                    <?= form_dropdown('proceso_documento','', '', 'class = "form-control " id="proceso_documento"');?>            
                	</div>
              	</div>

              	<div class="form-group row" id="div_subprocesos_documentos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_lbl_3">
                    <?= form_label('Sudproceso','subproceso', array('class'=>'mb-0','id'=>'lblsubproceso')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'subproceso', 'id'=>'subproceso', 'placeholder'=>'', 'maxlength'=>'160', 'class'=>' form-control col-sm-9 col-md-10', 'Readonly'=>true));?>
                    <?= form_dropdown('subproceso_documento','', '', 'class = "form-control" id="subproceso_documento"');?>
                	</div>
              	
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_lbl_4">
                    <?= form_label('Documentos Relacionados','docrelacionados', array('class'=>'mb-0', 'id'=>'lbldocrelacionados')); ?>
                  </div>
                  <div class="col-sm-4" id="docrelaciondo">
                    <?= form_input(array('type'=>'text', 'name'=>'docrelacionados', 'id'=>'docrelacionados', 'class'=>' form-control col-sm-9 col-md-10', 'Readonly'=>true));?>
                  </div>
                  <div class="col-sm-4" id="divdocrelaciondos">
		                <?= form_dropdown('doc_relacionados[]','', '', 'class="form-control select2" multiple="multiple" id="doc_relacionados"');?>
		            	</div> 	
              	</div>
        	
                <div class="form-group row" id="div_codigo">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Código *','codigo', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-3">
                  	<?= form_input(array('type'=>'text', 'name'=>'codigo', 'id'=>'codigo', 'placeholder'=>'Digite el Código', 'maxlength'=>'15', 'class'=>'form-control col-sm-9 col-md-10', 'required'=>true));?>
                  </div>
                
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
			              	<?= form_label('Archivo PDF*','archivov', array('class'=>'mb-0')); ?>
			            </div>
			            <div class="col-sm-4">
			            	<?= form_upload(array('type'=>'file', 'name'=>'archivov', 'id'=>'archivov', 'placeholder'=>'Seleccione el Archivo de Visualización', 'class'=>'form-control ace-file-input col-sm-8 col-md-10', 'required'=>true));?>
			            </div>
			       		</div>

				       	<div class="form-group row" id="div_version">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_colver1">
                      <?= form_label('Versión *','version', array('class'=>'mb-0', 'id'=>'lblversion')); ?>
                  </div>
                  <div class="col-sm-2" id="div_colver2">
                      <?= form_input(array('type'=>'text', 'name'=>'version', 'id'=>'version', 'placeholder'=>'Digite la Versión', 'maxlength'=>'15', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
                  </div>
                	<div class="col-sm-2 col-form-label text-sm-right pr-0" id="div_col3">
                	<?= form_label('Fecha','fechaversion', array('class'=>'mb-0')); ?>
                	</div>
                	<div class="col-sm-3" id="div_colver4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechaversion', 'id'=>'fechaversion', 'placeholder'=>'Digite la fecha', 'class'=>'form-control col-sm-10 col-md-11', 'required'=>true));?>
                	</div>
              	</div>
              	<div class="form-group row" id="div_evaluacion">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Se Evalua *','evalua', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-1">
                    <?= form_dropdown('evalua', $opcevalua, '0', 'class="form-control col-sm-9 col-md-10" id="evalua"');?>
                  </div>
                </div>

		            <div class="form-group row" id="div_destinatarios">
		            	<div class="col-sm-12 col-form-label text-sm-left pr-0">
                    <h5>
                    <?= form_label('DESTINATARIOS','div_destinatarios', array('class'=>'mb-0')); ?>
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
						                    	<?= form_label('Empleados ','empleadosMR_documentos', array('class'=>'mb-0')); ?>
						                  	</div>
								                <div class="col-sm-10">
								                    <?= select_empleadosMR_tabla('documentos','','select2 multiple="multiple form-control');?>
								                </div> 
				                			</div>   
			                      </div>
			                    </div>

			                    <div class="tab-pane fade text-95" id="departamentosdet" role="tabpanel" aria-labelledby="departamentos-tab-btn">
			                     	<div class="alert bgc-default-l3 text-dark-m2 border-0 text-110 mb-0 p-3">
			                        <div class="form-group row" id="div_destinatarios">                   
						                  	<div class="col-sm-2 col-form-label text-sm-right pr-0">
						                    	<?= form_label('Departamentos ','departamentosM_documentos', array('class'=>'mb-0')); ?>
						                  	</div>
								                <div class="col-sm-10">
								                    <?= select_departamentosM_tabla('documentos','','select2 multiple="multiple form-control');?>
								                </div> 
						                	</div>   
		                      	</div>
			                    </div>

			                    <div class="tab-pane fade text-95" id="cargosdet" role="tabpanel" aria-labelledby="cargos-tab-btn">
		                      	<div class="alert bgc-default-l3 text-dark-m2 border-0 text-110 mb-0 p-3">
			                        <div class="form-group row" id="div_destinatarios">                   
						                  	<div class="col-sm-2 col-form-label text-sm-right pr-0">
						                    	<?= form_label('Cargos ','cargosM_documentos', array('class'=>'mb-0')); ?>
						                  	</div>
								                <div class="col-sm-10">
								                    <?= select_cargosM_tabla('documentos','','select2 multiple="multiple form-control');?>
								                </div> 
						                	</div>   
			                      </div>
			                    </div>
				                </div>
              				</div><!-- /.bcard -->
              			</div>        			
                  	<!-- <div class="form-group row" id="div_estado">
                      <div class="col-sm-4 col-form-label text-sm-right pr-0">
                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-8">
                        <?= form_dropdown('estado', $opciones, '1', 'class="form-control col-sm-9 col-md-10" id="estado"');?>
                      </div>
                  	</div> -->
		                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
				              <div class="offset-md-3 col-md-9 text-nowrap">
				                <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

				                <?= anchor(base_url('A_documentos/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
				              </div>
				            </div>
		              </div><!-- /.Form-body Modal-->
						    </div><!-- /.card-body Modal-->	
						  <?= form_close(); ?> 
			    	<!-- </div>				      		 -->
				</div><!-- /.Modal-body -->
			</div> <!-- /.modal-content -->
		</div>
	</div>	<!-- /.Modal -->
</div>

