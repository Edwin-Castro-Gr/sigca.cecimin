<?php
  //echo $id;
 $opciones = array(
    '0'   => 'No Vigente',
    '1'   => 'Vigente'
  );

 $opcredondeo = array(
    '0'   => 'Unidad',
    '1'   => 'Decena',
    '2'   => 'Centena'
  );
 
 
?>

  <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

  <div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
      <h3 class="card-title text-125 text-primary-d2">
        <i class="far fa-edit text-dark-l3 mr-1"></i>
         Nueva Tarifa
      </h3>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="card dcard">
          <div class="card-body px-3 pb-1">
            <?= form_open(base_url('c_tarifa/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
              
              <div class="form-body " style=" justify-content:flex-start;" >

                 <div class="form-group row" id="div_tipo">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Convenio*','convenio', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'convenio', 'id'=>'convenio', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','value'=>''));?>
                  </div>                 
                  
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Año Convenio','añoconvenio', array('class'=>'mb-0'));?>
                  </div>
                  <div class="col-sm-3">
                    <?= form_input(array('type'=>'text', 'name'=>'añoconvenio', 'id'=>'añoconvenio', 'placeholder'=>'', 'class'=>'form-control col-sm-11 col-md-12', 'value'=> ''));?>
                  </div>
                </div> 

                <div class="form-group row" id="div_funcionario">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Compañia','compañia', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'compañia', 'id'=>'compañia', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','value'=>''));?>
                  </div> 
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Plan *','plan', array('class'=>'mb-0')); ?>
                  </div>
                    <div class="col-sm-4">
                     <?= form_input(array('type'=>'text', 'name'=>'plan', 'id'=>'plan', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>''));?>
                  </div>                   
                </div>

                <div class="form-group row" id="div_sesion3">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Fecha de Inicio *','fechainicio', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'placeholder'=>'', 'class'=>'form-control', 'value'=>''));?>
                  </div> 
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'', 'class'=>'form-control','value'=>''));?>
                  </div>            
                </div>

                <div class="form-group row" id="div_sesion4">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Redondeo','redondeo', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('redondeo', $opcredondeo, '', 'class="form-control " id="redondeo"');?> </div>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Uvr - int*','uvr_int', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'uvr_int', 'id'=>'uvr_int', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>''));?>
                  </div>                    
                </div>

                <div class="form-group row" id="div_sesion5">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Uvr Qx Mod*','uvr_qx_mod', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'uvr_qx_mod', 'id'=>'uvr_qx_mod', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>''));?>
                  </div>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Quimio - int*','quimio_int', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'quimio_int', 'id'=>'quimio_int', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','value'=>''));?>
                  </div>    
                </div>  
                <div class="form-group row" id="div_sesion5">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Quimio - Mod*','quimio_mod', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'quimio_mod', 'id'=>'quimio_mod', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>''));?>
                  </div>                    
                </div> 

                <div class="form-group row" id="div_acciones">
                  <div class="card dcard col-sm-12">
                    <div class="card-header">
                      <span class="card-title text-125">
                          <b> ACCIONES DE MEJORA</b>
                      </span>                        
                    
                      <div class="mb-2 mb-sm-0" id="divbtnnuevoSegumiento">  
                        <button type="button" class="btn btn-online-red px-3 d-block text-95 radius-round border-2 brc-black-tp10" data-toggle="modal" data-target="#importar" id="btn_upload">
                          <i class="fa fa-upload mr-1"></i>
                          <span class="d-sm-none d-md-inline" id="btn_upload">Importar</span>
                        </button>   
                      </div>
                    </div>
                    
                  </div><!-- /.dcard -->
                </div><!-- /.card -->  

                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                  <div class="offset-md-3 col-md-9 text-nowrap">
                    <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                    <?= anchor(base_url('c_tarifas/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                  </div>
                </div>

              </div><!-- /.card-body -->
            <?= form_close(); ?>
          </div><!-- /.card -->
        </div>
      </div><!-- /.card -->
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
  </div><!-- /.modal-->
  </div><!-- /.card -->
