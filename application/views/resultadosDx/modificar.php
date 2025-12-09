<?php
  //echo $id;
  $c_archivo_original='';
  $opcestado = array(
    '0' => 'Inactivo',
    '1' => 'Activo',
    '2' => 'Enviado'
  );

  $result_array = explode(",", $c_file_resultado);
 
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="modificar">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
	    <h3 class="card-title text-125 text-primary-d2">
	      <i class="fa fa-cog text-dark-l3 mr-1"></i>
	      Modificar Resultado Dx 
	    </h3>
  </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
			      	<!-- <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0"> -->
				  <?= form_open(base_url('r_resultadosDx/guardar'), array('id'=>'form_modificar', 'name'=>'form_modificar', 'class'=>'', 'autocomplete'=>'off')); ?>
						<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_resultadoDx));?>
						<?= form_input(array('type'=>'hidden', 'name'=>'filename_send', 'id'=>'filename_send', 'value'=>base_url().$c_file_resultado));?>
						<div class="card-body px-3 pb-1">
	            <div class="form-body" style=" justify-content:flex-start;" >

                <div class="form-group row" id="div_examen" >
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Area o Servicio','examenes_resultados', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-5">
                    <?= select_examenes_tabla('resultados',$c_id_examen,'select2  form-control style="width: 100%"');?>
                  </div>                  
                </div>

                <div class="form-group row" id="div_paciente" >
                 
                                    
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Cedula Paciente*','pacientes_programacion', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-3">
                      <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite la cedula', 'class'=>'form-control col-sm-11 col-md-12', 'value'=>$c_cedula));?>
                      <?= form_input(array('type'=>'hidden', 'name'=>'idpaciente', 'id'=>'idpaciente', 'value'=>$c_id_paciente));?> 
                       
                      <?= form_input(array('type'=>'hidden', 'name'=>'correopaciente', 'id'=>'correopaciente', 'value'=>$c_correo_paciente));?> 
                  </div>

                  <div class="col-sm-5">
                    <?= form_input(array('type'=>'text', 'name'=>'paciente', 'id'=>'paciente', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>$c_paciente, 'readonly'=>true));?>
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn px-2 btn-outline-blue col-sm-pull-5 fa fa-pencil-alt" id="btn_editar_paciente" name="btn_editar_paciente">                     
                    </button>
                  </div>
                </div>                            	

	              <div class="form-group row" id="div_resultado">                                 
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
				            <?= form_label('Archivo PDF*','archivov', array('class'=>'mb-0')); ?>
				          </div>
			            <div class="col-sm-3">
			            	<?= form_upload(array('type'=>'file', 'name'=>'archivov', 'id'=>'archivov', 'placeholder'=>'Cargar el Archivo del Resultado', 'class'=>'form-control ace-file-input col-sm-8 col-md-10',));?>
			            </div>
                  <div class="col-sm-1">
                   <?php foreach($result_array as $value) {
                      echo anchor(base_url().$value, '<i class="fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-red','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank')); 
                   };?>                   
                  </div> 

                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Fecha ejecución', 'txtfechaE', array('class' => 'mb-0')); ?>
                  </div>
                  <div class="col-sm-3">
                    <?= form_input(array('type' => 'date', 'name' => 'txtfechaE', 'id' => 'txtfechaE',  'data-date-format'=>'dd-mm-yyyy','class' => 'form-control col-sm-9 col-md-10','value'=>$c_fecha_examen)); ?>
                  </div>  
				       	</div>
                <div class="form-group row" id="div_enviarCorreo">                            
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Enviar Resultados al paciente*','lblck_d_relacionado', array('class'=>'mb-0','id'=>'lblck_d_relacionado')); ?>
                  </div>
                  <div class="col-sm-4">
                    <!-- <?= form_dropdown('sn_envia_correo', $opcsndocrela, '', 'class="form-control" id="sn_doc_relacionado"');?> -->
                    <label class="col-form-label">
                     No
                    </label>
                      <?= form_input(array('type'=>'checkbox', 'name'=>'ck_enviarcorreo', 'id'=>'ck_enviarcorreo', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1'));?>
                      <?= form_input(array('type'=>'hidden', 'name'=>'txtchecked', 'id'=>'txtchecked', 'value'=>false));?>
                    <label class="col-form-label">
                      Si 
                    </label>
                  </div>
                </div>
                  <div class="form-group row " id="div_estado">
                    <!-- <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4"> -->
                      <!-- <?= form_dropdown('estado', $opcestado, $c_estado, 'class="form-control" id="estado"');?> -->
                      <?= form_input(array('type'=>'hidden', 'name'=>'estado', 'id'=>'estado', 'value'=>$c_estado));?>
                    </div>
                  </div>
		                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
				              <div class="offset-md-3 col-md-9 text-nowrap">
				                <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

				                <?= anchor(base_url('r_resultadosDx/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
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

  <!-- Modal Nuevo Paciente -->
<div class="modal fade modal-lg" id="newMPaciente" role="dialog" aria-labelledby="newModalLabelEmp" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bgc-primary-m1 brc-white">
        <h5 class="modal-title text-white" id="newModalLabelEmp">
          Nuevo paciente
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?= form_open(base_url('r_resultadosDx/guardar_paciente'), array('id'=>'form_paciente', 'name'=>'form_paciente', 'class'=>'', 'autocomplete'=>'off')); ?>
          <?= form_input(array('type'=>'hidden', 'name'=>'idregistropa', 'id'=>'idregistropa', 'value'=>'0'));?>
          <div class="card-body px-2 pb-1">
            <div class="form-body">
              <div class="form-group row" id="div_identificacion">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo Documento','tipodocidentidad', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_Tipo_docidentidad_tabla('pacientes','','form-control " required="1');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Documento ','numero_idl', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'numero_id', 'id'=>'numero_id', 'placeholder'=>'Digite el Numero de documento', 'maxlength'=>'15', 'class'=>'form-control ', 'required'=>true));?>
                </div>
              </div>

              <div class="form-group row" id="div_nombres_apellidos">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Nombres ','nombres', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Digite los Nombres', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Apellidos','apellidos', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'apellidos', 'id'=>'apellidos', 'placeholder'=>'Digite los Apellidos', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>
              </div>

              
              <div class="form-group row" id="div_eps_otro">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Entidad de Salud','eps_pacientes', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_eps_tabla('pacientes','','form-control col-sm-11 col-md-12');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Otro ','otra_entidad_salud', array('class'=>'mb-0','id'=>'lblotra_entidad_salud')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'otra_entidad_salud', 'id'=>'otra_entidad_salud', 'placeholder'=>'Digite el Cual?', 'maxlength'=>'100', 'class'=>'form-control col-sm-11 col-md-12 UpperCase'));?>
                </div>
              </div>

              <div class="form-group row" id="div_contacto">               
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Correo ','correo', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'email', 'name'=>'correo', 'id'=>'correo', 'placeholder'=>'Digite el Email', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                </div>
              </div>

              <div class="form-group row" id="div_estadop">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Estado *','lblestado', array('class'=>'mb-0', 'id'=>'lblestado')); ?>
                </div>
                <div class="col-sm-6">
                  <?= form_dropdown('estado', $opcestado, '', 'class="form-control col-sm-11 col-md-12" id="estado"');?>
                </div>
              </div> 
            </div><!-- /.Form-body Modal-->
          </div><!-- /.card-body Modal-->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary " id="btn_guardar_paciente" name="btn_guardar_paciente">
              Guardar
            </button>
            <button type="submit" class="btn btn-primary " id="btn_actualizar_paciente" name="btn_actualizar_paciente">
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
</div>  <!-- /.Modal -->

