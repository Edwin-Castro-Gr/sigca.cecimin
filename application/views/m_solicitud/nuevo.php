<?php
//echo $id;
$opciones = array(
  ''   => 'Seleccione una Opción',
  '0'   => 'Pendiente',
  '1'   => 'Programada',
  '2'   => 'Ejecutada',
  '3'   => 'Recibida',
  '4'   => 'Rechazada'
);

$tipoRecurso= array(
  '' => 'Infraestructura',
  '1' => 'Recursos físicos',
  '2' => 'Recursos de sistemas'
);

?>

<input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

<div class="card acard mt-2 mt-lg-3">
  <div class="card-header">
    <h3 class="card-title text-125 text-primary-d2">
      <i class="far fa-edit text-dark-l3 mr-1"></i>
      Nueva Solicitud
    </h3>
  </div>

  <div class="card-body px-3 pb-1">
    <?= form_open(base_url('m_solicitud/guardar'), array('id' => 'form_guardar', 'name' => 'form_guardar', 'class' => 'mt-lg-3', 'autocomplete' => 'off')); ?>
    <?= form_input(array('type' => 'hidden', 'name' => 'id_solicitudM', 'id' => 'id_solicitudM', 'value' => '')); ?>
    <div class="form-body " style=" justify-content:flex-start;">
      <div class="form-group row" id="div_servicio">
        <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Mantenimiento Requerido *', 'serviciomto_solicitud', array('class' => 'mb-0')); ?>
        </div>
        <div class="col-sm-10">
          <?= select_serviciomto_tabla('solicitud','','select2 form-control');?>
          <?= form_input(array('type' => 'hidden', 'name' => 'nombreMantemientoR', 'id' => 'nombreMantemientoR', 'class' => 'form control', 'value' => '')); ?>
          <?= form_input(array('type' => 'hidden', 'name' => 'nombreServicio', 'id' => 'nombreServicio', 'class' => 'form control', 'value' => '')); ?>
        </div>
      </div>

      <div class="form-group row" id="div_otro">
        <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Otros *', 'otroM', array('class' => 'mb-0')); ?>
        </div>
        <div class="col-sm-10">
          <?= form_input(array('type' => 'text', 'name' => 'otroM', 'id' => 'otroM', 'placeholder' => 'Digite Cuales?',  'class' => 'form-control col-sm-12 col-md-10 UpperCase')); ?>
        </div>
      </div>

      <div class="form-group row" id="div_servicio">
        <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
        </div>
        <div class="col-sm-4">
          <?= form_dropdown('servicio','','0','class=" form-control col-sm-12 col-md-10" id="servicio"'); ?>
          <?= form_input(array('type' => 'hidden', 'name' => 'nombreservicio', 'id' => 'nombreservicio', 'class' => 'form control', 'value' => '')); ?>
        </div>

        <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Ubicación Especifica*', 'ubicacion', array('class' => 'mb-0')); ?>
        </div>
        <div class="col-sm-4">
          <?= form_input(array('type' => 'text', 'name' => 'ubicacion', 'id' => 'ubicacion', 'placeholder' => 'Digite la ubicación si aplica',  'class' => 'form-control col-sm-12 col-md-10 UpperCase')); ?>
        </div>
      </div>

      <div class="form-group row" id="div_empleado">
        <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Solicitante*', 'empleados_mantenimiento', array('class' => 'mb-0')); ?>
        </div>
        <div class="col-sm-4">
          <?= select_coordinadores_tabla('jefeinm','','select2 form-control');?>
        </div>
      </div>

      <div class="form-group row" id="div_observaciones">
        <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Observaciones *', 'observaciones', array('class' => 'mb-0')); ?>
        </div>
        <div class="col-sm-10">
          <?= form_textarea(array('rows' => '2', 'name' => 'observaciones', 'id' => 'observaciones', 'placeholder' => 'Realice las observaciones que considere', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => '')); ?>
        </div>
      </div>
    </div>

    <div class="form-group row" id="div_evidencia">                                 
      <div class="col-sm-2 col-form-label text-sm-right pr-0">
        <?= form_label('Archivo PDF*','archivo_evidencia', array('class'=>'mb-0')); ?>
      </div>
      <div class="col-sm-8">
        <?= form_upload(array('type'=>'file', 'name'=>'archivo_evidencia[]', 'id'=>'archivo_evidencia', 'class'=>'form-control ace-file-input col-sm-8 col-md-10', 'multiple'=>'multiple'));?>
      </div>    
    </div>
    <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
      <div class="offset-md-3 col-md-9 text-nowrap">
        <?= form_button(array('type' => 'button', 'id' => 'btn_guardar', 'name' => 'btn_guardar', 'content' => '<i class="fa fa-check mr-1"></i>Guardar', 'class' => 'btn btn-info btn-bold px-4')); ?>

        <?= anchor(base_url('m_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class' => 'btn btn-danger btn-rounded m-t-10')); ?>
      </div>
    </div>
    <?= form_close(); ?>
  </div><!-- /.card-body -->
</div><!-- /.card -->