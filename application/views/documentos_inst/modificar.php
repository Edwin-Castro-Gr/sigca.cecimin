<?php
  //echo $id;
  $opcperiodo = array(
    '0'   => '',
    '1'   => 'Mensual',
    '2'   => 'Bimensual',
    '3'   => 'Trimestral',
    '4'   => 'Semestral',
    '5'   => 'Anual'
  );  
  $opcestado = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
  
  $opcclas = array(
  	'' 		=> 'Seleccione una Opción',
    '0'   => 'Reportes',
    '1'   => 'Certificaciones'
  ); 
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="modificar">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
	    <h3 class="card-title text-125 text-primary-d2">
	      <i class="fa fa-cog text-dark-l3 mr-1"></i>
	      Modificar Documento Institucional
	    </h3>
  	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  	<div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
			      	<!-- <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0"> -->
				   	<?= form_open(base_url('d_doc_institucionales/actualizar'), array('id'=>'form_actualizar', 'name'=>'form_actualizar', 'class'=>'', 'autocomplete'=>'off'));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_docinstitucional));?>
						<div class="card-body px-3 pb-1">
	            <div class="form-body" style=" justify-content:flex-start;" >
	            	<div class="form-group row" id="div_nombre">
	                <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                    <?= form_label('Nombre Documento','Nombre', array('class'=>'mb-0')); ?>
	                </div>
                  <div class="col-sm-10">
                    <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre', 'maxlength'=>'120', 'class'=>'form-control col-sm-12 col-md-10 ','value'=>$c_nombre));?>
                  </div>
                </div>

                <div class="form-group row" id="div_clasificacion_&_archivo">
                	<div class="col-sm-2 col-form-label text-sm-right pr-0">
                  	<?= form_label('Clasificación *','clasificacion', array('class'=>'mb-0')); ?>
                	</div>
                	<div class="col-sm-3">
                  	<?= form_dropdown('clasificacion', $opcclas, $c_clasificacion, 'class="form-control col-sm-12 col-md-10" id="clasificacion"');?>
                	</div>

                	<div class="col-sm-2 col-form-label text-sm-right pr-0">
	              	<?= form_label('Archivo PDF','lblarchivov', array('class'=>'mb-0')); ?>
	            		</div>
	            		<div class="col-sm-4">
	            			<?= form_upload(array('type'=>'file', 'name'=>'archivo', 'id'=>'archivo', 'placeholder'=>'Seleccione el Archivo...', 'class'=>'form-control ace-file-input col-sm-10 col-md-10', 'value'=>$c_archivo));?>
	            		</div>
	            		<div class="col-sm-1">
                 		<?=anchor(base_url().$c_archivo, '<i class="fa fa-file"></i>', array('class'=>'btn btn-circle btn-outline-blue','style'=>'width: 30px; height: 30px; padding: 2px 2px;font-size: 18px;','target'=>'_blank'));?>
                	</div>
		       			</div>
                
                <div class="form-group row" id="div_tipodocumentos_documentos">
                 	<div class="col-sm-2 col-form-label text-sm-right pr-0">
          					<?= form_label('Responsable','responsable', array('class'=>'mb-0')); ?>
        					</div>
        					<div class="col-sm-4">
          					<?= select_empleados_tabla('responsable',$c_id_responsable,'select2 form-control col-sm-12 col-md-10');?>
        					</div>
        					 <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Periodicidad','periodicidad', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-3">
                    <?= form_dropdown('periodicidad', $opcperiodo, $c_periodicidad, 'class="form-control col-sm-12 col-md-10" id="periodicidad"');?>
                  </div>
              	</div>
								
	       				<div class="form-group row" id="div_fechas">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  	<?= form_label('Fecha documento','fechainicial', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'date', 'name'=>'fechainicial', 'id'=>'fechainicial', 'placeholder'=>'Digite la fecha del documento', 'class'=>'form-control col-sm-10 col-md-11', 'value'=>$c_fecha_inicial));?>
                  </div>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  	<?= form_label('Fecha Expiración','fechafinal', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'Digite la fecha Expiración', 'class'=>'form-control col-sm-12 col-md-10', 'value'=>$c_fecha_final));?>
                  </div>
              	</div> 

              	<div class="form-group row" id="div_observaciones">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-10">	                   
                     <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>$c_observaciones));?>
                  </div>
	              </div>

	              <div class="form-group row" id="div_estado">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('estado', $opcestado, $c_estado, 'class="form-control col-sm-9 col-md-10" id="estado"');?>
                  </div>
              	</div>

                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
		              <div class="offset-md-3 col-md-9 text-nowrap">
		                <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

		                <?= anchor(base_url('d_doc_institucionales/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
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

