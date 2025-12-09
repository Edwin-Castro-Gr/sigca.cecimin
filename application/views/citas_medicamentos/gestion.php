<?php
  
  $condicion = array(
    '' => '---',
    '0' => 'Ninguna',  
    '1' => 'Discapacidad Física',
    '2' => 'Discapacidad Visual',
    '3' => 'Discapacidad Auditiva',
    '4' => 'Discapacidad Cognitiva',
    '5' => 'Embarazo' 
  );

  $tipo_identificacion = array(
    '' => 'Seleccione una Opción',
    'CC' => 'Cédula de Ciudadanía',
    'CE' => 'Cédula de Extranjería',
    'TI' => 'Tarjeta de Identidad',
    'RC' => 'Registro Civil',
    'PA' => 'Pasaporte'
  );

  $jornada = array(
    '' => 'Seleccione una Opción',
    '0' => 'Mañana',
    '1' => 'Tarde'
  );


  $opciones = array(
    '1' => 'Recibida',
    '2' => 'Programada',    
    '0' => 'Cerrada'
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
              <?= form_open(base_url('citas_medicamentos/guardar_gestion'), array('id'=>'form_gestion', 'name'=>'form_gestion', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_cita));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'fecha_reg', 'id'=>'fecha_reg', 'value'=>$c_fecha_reg));?>

                <div class="form-body " style=" justify-content:flex-start;" >

                  <div class="form-group row" id="div_identificacion">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tipo Documentos*','tipo', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('tipo', $tipo_identificacion, $c_tipo, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="motivo" readonly="readonly"');?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Documento Identidad','identidad', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true, 'value'=>$c_cedula));?>
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
                      <?= form_label('Teléfono Contacto','telefono', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_telefono));?>
                    </div>                   
                  </div>
                   <div class="form-group row" id="div_datoscontacto1">                    
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Email Contacto','percontacto', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'email', 'id'=>'email', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true, 'value'=>$c_correo));?>
                    </div>  
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Condición','condicion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('condicion', $condicion, $c_condicion, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="Jornada3"  readonly="readonly"');?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_fechas1">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha Sugerida1','fecha1', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fecha1', 'id'=>'fecha1', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_fecha1));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Jornada1','jornada1', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('Jornada1', $jornada, $c_jornada1, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="Jornada1"  readonly="readonly"');?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_fechas2">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha Sugerida2','fecha1', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fecha2', 'id'=>'fecha2', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_fecha2));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Jornada2','jornada2', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('Jornada2', $jornada, $c_jornada2, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="Jornada2"  readonly="readonly"');?> 
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_fechas3">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha Sugerida3','fecha3', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fecha3', 'id'=>'fecha3', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_fecha3));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Jornada3','jornada3', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('Jornada3', $jornada, $c_jornada3, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="Jornada3"  readonly="readonly"');?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_fechasP">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha Programada','fechap', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechap', 'id'=>'fechap', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>''));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Hor Programada','horap', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">

                      <?= form_input(array('type'=>'time', 'name'=>'horap', 'id'=>'horap', 'class'=>'form-control ' ,'min'=>'07:00', 'max'=>'18:00', 'value'=>'07:00', 'required'=>true));?>
                     
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_observaciones">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'4', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Registre las obsevaciones si se requieren', 'class'=>'form-control w-100', 'value'=>''));?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_verOrdenes">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Ver la Orden','orden', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                        <?= anchor(base_url().$c_archivo_orden, '<i class="fa fa fa-file-pdf"></i>', array('class'=>'btn btn-circle btn-outline-red','style'=>'width: 40px; height: 40px; padding: 2px 2px;font-size: 18px;','target'=>'_blank'));?>
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

                  <div class="form-group row" id="div_archivoEvCierre">                                 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Archivo PDF*','anexocierre', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-8">
                      <?= form_upload(array('type'=>'file', 'name'=>'anexocierre', 'id'=>'anexocierre', 'class'=>'form-control ace-file-input col-sm-8 col-md-10', 'required'=>true));?>
                    </div>
                  </div>  
                </div> 
                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                  <div class="offset-md-3 col-md-9 text-nowrap">
                    <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_gestion', 'name'=>'btn_guardar_gestion', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                    <?= anchor(base_url('citas_medicamentos/listado'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                  </div>
                </div>

              </div><!-- /.card-body -->
              <?= form_close(); ?>
            </div><!-- /.card -->
          </div>
        </div><!-- /.card -->
      </div><!-- /.card -->
    

