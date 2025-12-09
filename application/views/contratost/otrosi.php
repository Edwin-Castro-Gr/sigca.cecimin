<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Vigente',
    '1'   => 'Prorogado',
    '2'   => 'Terminado'
  );

  $objeto = array(
    ''    => 'Seleccione una Opción',
    '1'   => 'Prorrogar el Contrato',
    '2'   => 'Modificar el Contrato',
    '3'   => 'Otro'
  );
  
?>

      <input type="hidden" name="opc_pag" id="opc_pag" value="otrosi">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
             Otro Si Contrato Tercero 
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('d_contratost/guardarotrosi'), array('id'=>'Form_otrosi', 'name'=>'Form_otrosi', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
            
            <div class="form-body " style=" justify-content:flex-start;" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_contrato_tercero));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'usuario_crea', 'id'=>'usuario_crea', 'value'=>$c_id_usuario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'estado_contrato', 'id'=>'estado_contrato', 'value'=>$c_estado));?>


              <div class="form-group row" id="div_numeroint" >                
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Numero Contrato*','ncontratolbl', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-3">
                  <?= form_input(array('type'=>'text', 'name'=>'ncontrato', 'id'=>'ncontrato', 'placeholder'=>'Digite el numero de contrato', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_n_contrato));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Objeto del Contrato*','objcontratolbl', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-5">
                  <?= form_textarea(array('rows'=>'3', 'name'=>'objcontrato', 'id'=>'objcontrato', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_objeto_contrato));?>
                </div>
              </div>

              <div class="form-group row" id="div_tercero" >
                <?= form_input(array('type'=>'hidden', 'name'=>'idtercero', 'id'=>'idtercero', 'value'=>$c_id_tercero));?>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('NIT Tercero*','tercero', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-3">
                  <?= form_input(array('type'=>'text', 'name'=>'nit', 'id'=>'nit', 'placeholder'=>'Digite el Nit del Tercero', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_nit_tercero));?>
                </div>

                <div class="col-sm-6">
                  <?= form_input(array('type'=>'text', 'name'=>'razon_social', 'id'=>'razon_social', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_razon_tercero));?>
                </div>                    
              </div>
              
              <div class="form-group row" id="div_observaciones">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= form_textarea(array('rows'=>'3', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones correspondientes', 'class'=>'form-control','value'=>''));?>
                </div>
              </div>
              <div class="form-group row" id="div_estado">     
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Objeto *','objeto', array('class'=>'mb-0', 'id'=>'lblobjeto')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('objeto', $objeto, '', 'class="form-control " id="objeto"');?>
                </div>
              </div>

              <div class="form-group row" id="div_vigencia_p">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha de Inicio','fechainicio_p', array('class'=>'mb-0', 'id'=>'lblfechainicio_p')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechainicio_p', 'id'=>'fechainicio_p', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>''));?>
                </div>                    

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha final','fechafinal_p', array('class'=>'mb-0', 'id'=>'lblfechafinal_p')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechafinal_p', 'id'=>'fechafinal_p', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>''));?>
                </div>
              </div>
              
              <div class="container " id="div_parte8">
                <div class="col-form-label text-sm-left pr-0">
                   <?= form_label('ANEXOS DEL OTRO SI','anexos', array('class'=>'mb-0')); ?>
                </div>

                <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                  <div class="card-body p-0">
                    <div class="accordion" id="accordionAnexosOtroSi">
                      <div class="card border-0 bgc-green-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading1">
                          <h2 class="card-title bgc-transparent text-green-d2 brc-green">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse1" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                              Anexos

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>

                        <!-- ACORDION PARA ANEXOS -->
                        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionAnexosOtroSi">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                            <div class="form-group row" id="div_archivo">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?=form_label('Otro Si','archivo', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-8">   
                                <?= form_input(array('type'=>'hidden', 'name'=>'nombre_archivo1', 'id'=>'nombre_archivo1', 'value'=>'Otro Si'));?>                             
                                <?=form_upload(array('type'=>'file', 'name'=>'archivo_otrosi1', 'id'=>'archivo_otrosi1',  'placeholder'=>'Seleccione el Archivo del Otro Si', 'class'=>'form-control ace-file-input col-sm-9 col-md-10')); ?>
                              </div>                              
                            </div>
                          </div>                        
                        
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                            <div class="form-group row" id="div_archivo2">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?=form_label('Otros Anexos','otros', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-8">
                                <?= form_input(array('type'=>'hidden', 'name'=>'nombre_archivo2', 'id'=>'nombre_archivo2', 'value'=>'Otro Si'));?>
                                <?=form_upload(array('type'=>'file', 'name'=>'archivo_otrosi2[]', 'id'=>'archivo_otrosi2', 'placeholder'=>'Seleccione el Archivo del Otro Si', 'class'=>'form-control ace-file-input  col-sm-9 col-md-10', 'multiple'=>'multiple')); ?>
                              </div>
                            </div>
                          </div>                          
                        </div><!-- /ACORDION PARA ANEXOS -->

                      </div>
                    </div>
                  </div>
                </div><!-- /.card -->
            </div><!-- /.container -->

              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="offset-md-3 col-md-9 text-nowrap" style=" align-content: center;">
                  <?= form_button(array('type'=>'button', 'id'=>'btn_guardarotrosi', 'name'=>'btn_guardarotrosi', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                  <?= anchor(base_url('d_contratost/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                </div>
              </div>
            </div><!-- /.card-body -->
          <?= form_close(); ?>        
        </div><!-- /.card -->
      </div>
    </div><!-- /.card -->
  </div>
</div><!-- /.card -->
      