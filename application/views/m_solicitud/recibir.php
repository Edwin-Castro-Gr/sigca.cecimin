<?php
//echo $id;
$opciones = array(
    ''   => 'Seleccione una Opción',
    
    '2'   => 'Ejecutada',
    '3'   => 'Recibida',
    '4'   => 'Rechazda'
);


$opcprioridad = array(
  '' => 'Seleccione una prioridad',
  '1' => 'Normal',
  '2' => 'Urgente'
);


$tipoRecurso= array(
  '' => 'Seleccione una Opción',
  '1' => 'Recursos físicos',
  '2' => 'Recursos de sistemas'
);

$tipoMantenimiento = array(
  '1' => 'Infraestructura',
  '2' => 'Equipos Fijos',
  '3' => 'Preventivos',
  '4' => 'Correctivos',
  '5' => 'Otros'
)

?>

<input type="hidden" name="opc_pag" id="opc_pag" value="recibir">

<div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
            Ejecutar Solicitud
        </h3>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card dcard">
                <div class="card-body px-3 pb-1">
                    <?= form_open(base_url('m_solicitud/guardar_recibido'), array('id' => 'form_guardar_recibido', 'name' => 'form_guardar_recibido', 'class' => 'mt-lg-3', 'autocomplete' => 'off')); ?>
                    <div class="form-body " style=" justify-content:flex-start;">
                        <?= form_input(array('type' => 'hidden', 'name' => 'idreg', 'id' => 'idreg', 'value' => $c_id_solicitud)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idusuariactual', 'id' => 'idusuariactual', 'value' => $c_usuario_a)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idrmantoreq', 'id' => 'idrmantoreq', 'value' => $c_id_manterimientor)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idservicio', 'id' => 'idservicio', 'value' => $c_id_servicio)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'correo_empleado', 'id' => 'correo_empleado', 'value' => $c_correo)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idrservicio', 'id' => 'idrservicio', 'value' => $c_id_manterimientor)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idsolicitante', 'id' => 'idsolicitante', 'value' => $c_id_solicitante)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'estadoactual', 'id' => 'estadoactual', 'value' => $c_estado)); ?>

                        <div class="form-group row" id="div_servicio">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                
                                <?= form_label('Servicio Requerido *', 'rservicio', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= form_input(array('type' => 'text', 'name' => 'rservicio', 'id' => 'rservicio',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_manterimientor)); ?>
                            </div>
                       
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Otros *', 'otroM', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= form_input(array('type' => 'text', 'name' => 'otroM', 'id' => 'otroM', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_otros_mantenimientos)); ?>
                            </div>
                        </div>

                        <div class="form-group row" id="div_servicio">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Servicio *', 'nombreservicio', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= form_input(array('type' => 'text', 'name' => 'nombreservicio', 'id' => 'nombreservicio',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_servicio)); ?>
                            </div>

                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Solicitante*', 'coordinador', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= form_input(array('type' => 'text', 'name' => 'coordinador', 'id' => 'coordinador',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_solicitante)); ?>
                            </div>
                        </div>

                        <div class="form-group row" id="div_observaciones">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Observaciones Solicitud*', 'observaciones', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                                <?= form_textarea(array('rows' => '2', 'name' => 'observaciones', 'id' => 'observaciones', 'placeholder' => 'Realice las observaciones que considere', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_observaciones)); ?>
                            </div>
                        </div>

                        <div class="form-group row" id="div_programacion">
                            <div class="card dcard col-sm-12">
                                <div class="card-header">
                                  <span class="card-title text-125">
                                      Información de la Programación
                                  </span>
                                </div>
                                <div class="card-body px-3 pb-1">
                                    <div class="form-group row " id="div_fecha_programacion">
                                                 
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Tipo Mantenimiento*', 'tipo_mantenimiento', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?= form_dropdown('tipo_mantenimiento', $tipoMantenimiento, $c_tipoMantenimiento, 'class="form-control" id="tipo_mantenimiento" readonly="1"'); ?>
                                        </div>
                                       

                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Fecha Inicial Mantenimiento', 'fechaMInicial', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?= form_input(array('type' => 'date', 'name' => 'fechaMInicial', 'id' => 'fechaMInicial', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12', 'value' => $c_fechaIM)); ?>
                                        </div>

                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Fecha Final Mantenimiento', 'fechaMfin', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?= form_input(array('type' => 'date', 'name' => 'fechaMfin', 'id' => 'fechaMfin', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12', 'value' => $c_fechaFM)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="div_observacionesM">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Observaciones Programación*', 'observacionesM', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-10">
                                            <?= form_textarea(array('rows' => '2', 'name' => 'observacionesM', 'id' => 'observacionesM', 'placeholder' => 'Realice las observaciones que considere', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_observacionesM)); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row " id="div_estado">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Prioridad *', 'prioridad', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= form_dropdown('prioridad', $opcprioridad, $c_prioridad, 'class="form-control" id="prioridad"'); ?>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div>

                        <div class="form-group row" id="div_programacion">
                            <div class="card dcard col-sm-12">
                              <div class="card-header">
                                <span class="card-title text-125">
                                    Gestión Adicional
                                </span>
                              </div>
                              <div id="notas"> 


                              </div><!-- /.card-body -->
                            </div><!-- /.dcard -->
                          </div><!-- /.card -->
                                   
                        <div class="form-group row" id="div_programacion">
                            <div class="card dcard col-sm-12">
                                <div class="card-header">
                                  <span class="card-title text-125">
                                      Información de la Ejecución
                                  </span>
                                </div>
                                <div class="card-body px-3 pb-1">

                                    <div class="form-group row " id="div_fecha_ejecucion">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Fecha de Ejecución', 'fechaEjecucion', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= form_input(array('type' => 'date', 'name' => 'fechaEjecucion', 'id' => 'fechaEjecucion', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12','value' => $c_fechaEM)); ?>
                                        </div>
                                        
                                    </div>
                                
                                    <div class="form-group row " id="div_observacionesE">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">    
                                            <?= form_label('Observaciones de Ejecución*', 'observacionesE', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-10">
                                            <?= form_textarea(array('rows' => '3', 'name' => 'observacionesE', 'id' => 'observacionesE', 'placeholder' => 'Registre las observaciones a que haya lugar', 'class' => 'form-control ', 'value' => $c_observacionesE)); ?>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div>

                        <div class="form-group row" id="div_programacion">
                            <div class="card dcard col-sm-12">
                                <div class="card-header">
                                  <span class="card-title text-125">
                                      Información del Recibido
                                  </span>
                                </div>
                                <div class="card-body px-3 pb-1">

                                    <div class="form-group row " id="div_fecha_recibido">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Fecha de Recibido', 'fechaRecibido', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= form_input(array('type' => 'date', 'name' => 'fechaRecibido', 'id' => 'fechaRecibido', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12','value' => '')); ?>
                                        </div>

                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Estado *', 'estado', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"'); ?>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row " id="div_observacionesR">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Observaciones de Recibido*', 'observacionesR', array('class' => 'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-10">
                                            <?= form_textarea(array('rows' => '3', 'name' => 'observacionesR', 'id' => 'observacionesR', 'placeholder' => 'Registre las observaciones a que haya lugar', 'class' => 'form-control ', 'value' => '')); ?>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div>

                        <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                            <div class="offset-md-3 col-md-9 text-nowrap">
                                <?= form_button(array('type' => 'button', 'id' => 'btn_Recibir', 'name' => 'btn_Recibir', 'content' => '<i class="fa fa-check mr-1"></i>Guardar', 'class' => 'btn btn-info btn-bold px-4')); ?>

                                <?= anchor(base_url('m_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class' => 'btn btn-danger btn-rounded m-t-10')); ?>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.card -->
        </div><!-- /.card -->
    </div><!-- /.card -->
</div><!-- /.card -->