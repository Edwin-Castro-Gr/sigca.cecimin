<?php
  //echo $id;
  $opciones = array(
    ''   => 'Seleccione una Opción',
    '1'   => 'Aceptada',
    '2'   => 'Rechazada',
    '5'   => 'Cerrar',
    '6'   => 'Devuelta'
  );

  $opcsubproceso = array(
    '0'   => 'Seleccione un Subproceso'
  );

  $opcionesTsolicitud = array(
    '1'   => 'Creación',
    '2'   => 'Modificación',
    '3'   => 'Eliminación'
  );
  $opcionesOrigen= array(
    '0'   => 'N/A',
    '1'   => 'Interno',
    '2'   => 'Externo'
  );
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
             Modificar Solicitud
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('d_solicitud/Actualizar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'on')); ?>
            
            <div class="form-body " style=" justify-content:flex-start;" >

              <div class="form-group row" id="div_tipo" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo Solicitud *','estado', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('tipo_solicitud', $opcionesTsolicitud, '1', 'class="form-control id="tipo_solicitud"');?>
                </div>
              
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Tipo de Documento *','tdocumento', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_tipodocumentos_tabla('solicitud','','form-control ');?>
                  </div>
                </div>

                <div class="form-group row" id="div_nombre">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Nombre del Documento','Nombre Documento', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre del documento', 'maxlength'=>'100', 'class'=>'form-control UpperCase', 'required'=>true));?>
                  </div>                     
                
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Proceso *','proceso', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    <?= select_procesos_tabla('solicitud','','form-control" required="1');?>
                    </div>
                </div>

                <div class="form-group row" id="div_subprocesos">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Subproceso *','subproceso', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    <?= form_dropdown('subproceso',$opcsubproceso, '0', 'class = "form-control " id="subproceso"');?>
                    </div>                     

                <!-- <div class="form-group row" id="div_responsable"> -->
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Autor del documento','Solicitante', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_empleados_tabla('solicitud','','select2 form-control');?>
                  </div>
                </div>

                <div class="form-group row" id="div_justificacion">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Justificacion *','justificacion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                    <?= form_textarea(array('rows'=>'2', 'name'=>'justificacion', 'id'=>'justificacion', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales se tramita la solicitud', 'class'=>'form-control ', 'required'=>true));?>
                    </div>
                </div>

                <div class="form-group row" id="div_documentos_r">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Documento Relacionado','documentos_r', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_documentos_tabla('solicitud','','select2 form-control');?>
                  </div>               

                
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('estado', $opciones, '0', 'class="form-control " id="estado"');?>
                  </div>
                </div>

                <div class="form-group row " id="div_origen_formato">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Origen Formato *','origen_formato', array('class'=>'mb-0','id'=>'lblorigen_formato')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('origen', $opcionesOrigen, '0', 'class="form-control" id="origen_formato"');?>
                  </div>
                </div>      

                <div class="form-group row" id="div_archivov">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Archivo Origen','archivoorig', array('class'=>'mb-0','id'=>'lblarchivoorig')); ?>
                  </div>
                  <div class="col-sm-10">
                   <?= form_upload(array('type'=>'file', 'name'=>'archivoorig', 'id'=>'archivoorig', 'class'=>'form-control ace-file-input'));?>
                  </div>
                  
                </div>

                <div class="form-group row" id="div_seccion_revision">                   
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Quien revisa ','reviadopor', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_empleados_tabla('revisa','','select2 form-control');?>
                  </div>
                  <label class="mt-1 mt-sm-0 ml-sm-3">
                        <input type="checkbox" class="mr-1" id="chrevisado" />
                        Revisado
                  </label>
                </div>

                <div class="form-group row" id="div_seccion_revision">                   
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Quien Aprueba ','aprobadopor', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_empleados_tabla('aprueba','','select2 form-control');?>
                  </div>
                  <label class="mt-1 mt-sm-0 ml-sm-3">
                        <input type="checkbox" class="mr-1" id="chaprobado" />
                        Aprobado
                  </label>
                </div>

            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-3 col-md-9 text-nowrap">
                <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                <?= anchor(base_url('a_area/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
              </div>
            </div>
          <?= form_close(); ?>
        </div><!-- /.card-body -->
      </div><!-- /.card -->