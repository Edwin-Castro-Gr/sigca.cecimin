<?php
  //echo $id;
  $opciones = array(  
    ''   => 'Seleccione una Opción',  
    '4'  => 'Aprobada',
    '2'  => 'Rechazada',
    '6'  => 'Devuelta'
  );
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="aprobacion">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
             Aprobacion de Solicitud
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('d_solicitud/guardaraprobacion'), array('id'=>'form_aprobacion', 'name'=>'form_aprobacion', 'class'=>'mt-lg-3', 'autocomplete'=>'on')); ?>
            
            <div class="form-body " style=" justify-content:flex-start;" >
                <?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_solicitud));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idusuarioregsol', 'id'=>'idusuarioregsol', 'value'=>$c_id_usuario));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idusuarioaprueba', 'id'=>'idusuarioaprueba', 'value'=>$c_id_aprabo_por));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idproceso', 'id'=>'idproceso', 'value'=>$c_id_proceso));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'tipodocumento', 'id'=>'tipodocumento', 'value'=>$c_id_tipo_documento));?>


                <div class="form-group row" >
                   <?= form_label('Solicitud N°:','', array('class'=>'control-label text-right col-md-2')); ?>
                    <div class="col-md-8 text-primary"><strong><?=$c_id_solicitud; ?></strong></div>
                </div>
                <div class="form-group row" >
                   <?= form_label('Nombre del Documento: ','', array('class'=>'control-label text-right col-md-2')); ?>
                    <div class="col-md-8 text-primary"><strong><?=$c_nombre_documento;?></strong></div>
                </div>
                
                 <div class="form-group row" id="div_archivov">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Archivo Origen','archivoorig', array('class'=>'mb-0','id'=>'lblarchivoorig')); ?>
                  </div>
                  <div class="col-sm-9">
                   <?= form_upload(array('type'=>'file', 'name'=>'archivoorig', 'id'=>'archivoorig', 'class'=>'form-control ace-file-input'));?>
                  </div>   
                   <div class="col-sm-1">
                   <?= anchor(base_url().'/'.$c_archivo_original, '<i class="fa fa-file-word"></i>', array('class'=>'btn btn-circle btn-outline-primary','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank'));?>
                  </div>               
                </div> 
                <div class="form-group row"> 
                  <div  class="col-sm-8"> 
                    <div class="form-group row " id="div_estado">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_dropdown('estado', $opciones, '', 'class="form-control " id="estado"');?>
                      </div>
                    </div> 
                    <div class="form-group row" id="div_observaciones">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones en caso de ser rechazada', 'class'=>'form-control '));?>
                      </div>
                    </div>
                  </div>
                  <div  class="col-sm-4">               
                     <!-- /.card -->
                    <div class="form-group row " id="checkrevisa">
                      <div class="col-sm-8 col-form-label text-sm-right pr-0"></div>

                      <div class="card border-0 shadow-sm radius-0" id="card-2">
                        <div class="card-header bgc-primary-d1">
                          <h5 class="card-title text-white">
                            <i class="fa fa-table mr-2px"></i>
                            Asignados para Aprobar la solicitud
                          </h5>
                        </div>

                        <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                          <div class="container-fluid">
                            <div class="form-horizontal m-t-20" id="quienAprueba">
                            </div>
                          </div>
                        </div><!-- /.card-body -->
                      </div>
                    </div>
                  </div>
                </div>

                <div class="container " id="div_parte8">
                  <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                    <div class="card-body p-0" id="Danexos">
                      <div class="accordion" id="accordioDobservaciones">
                        <div class="card border-0 bgc-red-l5 post-carg">
                          <div class="card-header border-0 bgc-transparent mb-0" id="heading_observaciones">
                            <h2 class="card-title bgc-transparent text-red-d2 brc-red">
                              <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-red btn-a-outline-red accordion-toggle border-l-3 radius-0 collapsed" href="#collapseobservaciones" data-toggle="collapse" aria-expanded="false" aria-controls="collapseobservaciones"> <b>OBSERVACIONES</b>
                              <!-- the toggle icon -->
                                <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                  <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                                </span>
                                <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-red mr-3 text-center position-rc">
                                  <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                                </span>
                              </a>
                            </h2>
                          </div>   

                          <div id="collapseobservaciones" class="collapse" aria-labelledby="heading'" data-parent="#accordioDobservaciones">
                            <div class="card-body pt-1 text-dark-m1 border-l-3 brc-red bgc-red-l5"> 
                              <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                                <div class="card-body p-0" id="observaciones">
                                  <div class="accordion" id="accordioobservacion">
                                    
                                  </div>
                                </div>
                              </div><!-- /.card -->
                            </div><!-- /.card -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.card -->
                </div><!-- /.card -->

                
                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                  <div class="offset-md-3 col-md-9 text-nowrap">
                    <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                    <?= anchor(base_url('D_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                  </div>
                </div>
            <?= form_close(); ?>
          </div><!-- /.card-body -->
        </div><!-- /.card -->