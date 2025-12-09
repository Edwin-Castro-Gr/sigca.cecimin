<?php
  //echo $id;
  $opciones = array(
    '1' => 'Recibida',
    '2' => 'Gestionada',    
    '3' => 'Rechazada',
    '0' => 'Cerrada'
  ); 

  $opc_entidad = array(
    '' => 'Seleccione una Opción',
    '1' => 'Colsanitas',
    '2' => 'Medisanitas',
    '3' => 'EPS Sanitas',  
    '4' => 'ARL Sura',
    '5' => 'Seguros Bolivar',
    '6' => 'Unisalud',
    '7' => 'Particular',
    '0' => 'Otra'
  );

  $motivo = array(
    '' => 'Seleccione una Opción',
    '0' => 'Felicitaciones',  
    '1' => 'Sugerencias',
    '2' => 'Quejas',
    '3' => 'Reclamos'   
  );

  $servicio = array(
    '' => 'Seleccione una Opción',
    '1' => 'Cirugía',
    '2' => 'Procedimiento Menores',
    '3' => 'Consulta de Ortopedia',
    '4' => 'Radiología',
    '5' => 'Laboratorio Clínica',
    '6' => 'Espirometría',  
    '7' => 'Audiometría',
    '8' => 'Electromiografía',
    '9' => 'Oncología',
    '10' => 'Quimioterapia',
    '11' => 'Administración de Medicamentos',
    '12' => 'Fisioterapía'
  ); 
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="gestion">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Gestión 
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('contactenos/guardar_gestion'), array('id'=>'form_gestion', 'name'=>'form_gestion', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_contacto));?>

                <div class="form-body " style=" justify-content:flex-start;" >

                  <div class="form-group row" id="div_motivo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Motivo *','motivo', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      
                      <?= form_dropdown('motivo', $motivo, $c_motivo, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="motivo" readonly="readonly"');?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Servicio','servicio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">                      
                      <?= form_dropdown('servicio', $servicio, $c_servicio, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="servicio" readonly="readonly"');?> 
                    </div> 
                  </div>

                  <div class="form-group row" id="div_contacto">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Nombres Contacto','percontacto', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_nombres));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Documento Identidad','identidad', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true, 'value'=>$c_identificacion));?>
                    </div>                   
                  </div>
                   <div class="form-group row" id="div_datoscontacto1">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Teléfono Contacto','telefono', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_telefono));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Email Contacto','percontacto', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'email', 'id'=>'email', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true, 'value'=>$c_email));?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_datoscontacto2">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Dirección','direccion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_direccion));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Entidad','percontacto', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('entidadpaciente', $opc_entidad, $c_entidad, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="entidadpaciente"  readonly="readonly"');?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_mensaje">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Mensaje','mensaje', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">                    
                    <?= form_textarea(array('rows'=>'4', 'name'=>'mensaje', 'id'=>'mensaje', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales nos contacta', 'class'=>'form-control w-100', 'readonly'=>true, 'value'=>$c_mensaje));?>
                    </div>                                       
                  </div>

                  <div class="form-group row" id="div_acciones">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Acción de Mejora','accion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'4', 'name'=>'accion', 'id'=>'accion', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales nos contacta', 'class'=>'form-control w-100', 'value'=>$c_accion_mejora));?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_observaciones">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'4', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Registre las obsevaciones si se requieren', 'class'=>'form-control w-100', 'value'=>$c_observaciones));?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_sesion5">                    
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control " id="estado"');?>
                    </div>
                  </div> 

                </div> 
                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                  <div class="offset-md-3 col-md-9 text-nowrap">
                    <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_gestion', 'name'=>'btn_guardar_gestion', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                    <?= anchor(base_url('contactenos/reporte'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                  </div>
                </div>

              </div><!-- /.card-body -->
              <?= form_close(); ?>
            </div><!-- /.card -->
          </div>
        </div><!-- /.card -->
      </div><!-- /.card -->
    

<!-- ***************************************** MODAL NUEVO ************************************************ -->
    <!-- Modal Nuevo  -->
     