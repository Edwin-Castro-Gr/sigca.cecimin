<?php
//echo $id;
$opciones = array(
  ''   => 'Seleccione una Opción',
  '0'   => 'Sin Iniciar',
  '1'   => 'En Desarrollo',
  '2'   => 'Finalizada',
  '3'   => 'Cerrrada'
);

$opctipf = array(
    '' => 'Seleccione un tipo',
    '0' => 'Rondas',
    '1' => 'Quejas',
    '2' => 'Incidentes',
    '3' => 'Eventos Adversos',
    '4' => 'Actos Inseguros',
    '5' => 'Por Auditrias',
    '6' => 'Por Indicadores',
    '7' => 'Por Comités',
    '8' => 'Analisis de Riesgo',
    '9' => 'Accidente de Trabajo'
);

$opctipo = array(
    '' => 'Seleccione una Opción',
    '1' => 'Acción correctiva',
    '2' => 'Acción Preventiva',
    '3' => 'Oportunidad de mejora'
);

?>

<input type="hidden" name="opc_pag" id="opc_pag" value="gestionar">

<div class="card acard mt-2 mt-lg-3">
  <div class="card-header">
    <h3 class="card-title text-125 text-primary-d2">
      <i class="far fa-edit text-dark-l3 mr-1"></i>
      Programar Solicitud
    </h3>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card dcard">
        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('plan_mejora/guardar_gestion'), array('id' => 'form_programar', 'name' => 'form_programar', 'class' => 'mt-lg-3', 'autocomplete' => 'off')); ?>

          <div class="form-body " style=" justify-content:flex-start;">
            <?= form_input(array('type' => 'hidden', 'name' => 'idreg', 'id' => 'idreg', 'value' => $c_id_solicitud)); ?>
            <?= form_input(array('type' => 'hidden', 'name' => 'idusuariactual', 'id' => 'idusuariactual', 'value' => $c_usuario_a)); ?>
            <?= form_input(array('type' => 'hidden', 'name' => 'idrmantoreq', 'id' => 'idrmantoreq', 'value' => $c_id_manterimientor)); ?>
            <?= form_input(array('type' => 'hidden', 'name' => 'correo_empleado', 'id' => 'correo_empleado', 'value' => $c_correo)); ?> 
            <?= form_input(array('type' => 'hidden', 'name' => 'idservicio', 'id' => 'idservicio', 'value' => $c_id_servicio)); ?>
            <?= form_input(array('type' => 'hidden', 'name' => 'idrservicio', 'id' => 'idrservicio', 'value' => $c_id_manterimientor)); ?>
            <?= form_input(array('type' => 'hidden', 'name' => 'idsolicitante', 'id' => 'idsolicitante', 'value' => $c_id_solicitante)); ?>
            <?= form_input(array('type' => 'hidden', 'name' => 'estadoactual', 'id' => 'estadoactual', 'value' => $c_estado)); ?>

            <div class="form-group row" id="div_servicio">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Servicio Requerido *', 'rservicio', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-10">
                <?= form_input(array('type' => 'text', 'name' => 'rservicio', 'id' => 'rservicio',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_manterimientor)); ?>

              </div>
            </div>

            <div class="form-group row" id="div_otro">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Otros *', 'otroM', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-10">
                <?= form_input(array('type' => 'text', 'name' => 'otroM', 'id' => 'otroM', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_otros_mantenimientos)); ?>
              </div>
            </div>

            <div class="form-group row" id="div_servicio">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-10">
                <?= form_input(array('type' => 'text', 'name' => 'nombreservicio', 'id' => 'nombreservicio',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_servicio)); ?>
              </div>
            </div>

            <div class="form-group row" id="div_empleado">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Solicitante*', 'empleados_mantenimiento', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_input(array('type' => 'text', 'name' => 'coordinador', 'id' => 'coordinador',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_solicitante)); ?>
              </div>

              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Tipo Mantenimiento*', 'tipo_mantenimiento', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_dropdown('tipo_mantenimiento', $tipoMantenimiento, '', 'class="form-control" id="tipo_mantenimiento"'); ?>
              </div>
            </div>

            <div class="form-group row" id="div_observaciones">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Observaciones  *', 'observaciones', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-10">
                <?= form_textarea(array('rows' => '2', 'name' => 'observaciones', 'id' => 'observaciones', 'placeholder' => 'Realice las observaciones que considere', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_observaciones)); ?>
              </div>
            </div>

            <div class="form-group row " id="div_fecha_programacion">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Fecha Inicial Mantenimiento', 'fechaMInicial', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_input(array('type' => 'date', 'name' => 'fechaMInicial', 'id' => 'fechaMInicial', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
              </div>

              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Fecha Final Mantenimiento', 'fechaMfin', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_input(array('type' => 'date', 'name' => 'fechaMfin', 'id' => 'fechaMfin', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
              </div>
            </div>

            <div class="form-group row " id="div_estado">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Prioridad *', 'prioridad', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_dropdown('prioridad', $opcprioridad, '', 'class="form-control" id="prioridad"'); ?>
              </div>

              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Estado *', 'estado', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"'); ?>
              </div>
            </div>

            <div class="form-group row " id="div_estado">

              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Observaciones Programación*', 'observacionesM', array('class' => 'mb-0')); ?>
              </div>
              <div class="col-sm-10">
                <?= form_textarea(array('rows' => '3', 'name' => 'observacionesM', 'id' => 'observacionesM', 'placeholder' => 'Registre las observaciones a que haya lugar', 'class' => 'form-control ', 'value' => '')); ?>
              </div>
            </div>

            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-3 col-md-9 text-nowrap">
                <?= form_button(array('type' => 'button', 'id' => 'btn_programar', 'name' => 'btn_programar', 'content' => '<i class="fa fa-check mr-1"></i>Guardar', 'class' => 'btn btn-info btn-bold px-4')); ?>

                <?= anchor(base_url('plan_mejora/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class' => 'btn btn-danger btn-rounded m-t-10')); ?>
              </div>
            </div>
            <?= form_close(); ?>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.card -->
    </div><!-- /.card -->