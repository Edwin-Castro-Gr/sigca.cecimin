<?php
  //echo $id;
  $opcestado = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
  $opcdia = array(
    '1'   => 'Lunes',
    '2'   => 'Martes',
    '3'   => 'Miercoles',
    '4'   => 'Jueves',
    '5'   => 'Viernes'
  );

?>
<input type="hidden" name="opc_pag" id="opc_pag" value="agenda">

            <div class="card acard mt-2 mt-lg-3">
              <div class="card-header">
                <h3 class="card-title text-125 text-primary-d2">
                  <i class="far fa-edit text-dark-l3 mr-1"></i>
                  Bloques
                </h3>
              </div>

              <div class="card-body px-3 pb-1">
                <?= form_open(base_url('c_agendaqx/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                  
                  <div class="form-body">

                    <div class="form-group row" id="div_cirujano">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Cirujano *','cirujano', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= select_cirujanos_tabla('agendaqx','','select2  form-control style="width: 100%"');?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_diaagenda">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Dia *','dia', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= form_dropdown('diaagenda', $opcdia, '', 'class="form-control" id="diaagenda"');?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_horainicio">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Hoja Inicio','horainicio', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= form_input(array('type'=>'time', 'name'=>'horainicio', 'id'=>'horainicio', 'maxlength'=>'100', 'class'=>'form-control col-sm-8 col-md-9'));?>
                      </div>
                    </div>
                    <div class="form-group row" id="div_horafinal">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Hoja Inicio','horafinal', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= form_input(array('type'=>'time', 'name'=>'horafinal', 'id'=>'horafinal', 'maxlength'=>'100', 'class'=>'form-control col-sm-8 col-md-9'));?>
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
                  </div>

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('c_programacion/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>
                <?= form_close(); ?>
              </div><!-- /.card-body -->
            </div><!-- /.card -->