<?php
  //echo $id;
  $opciones = array(
    ''  => 'Seleccione una Opción',
    '0' => 'Pendiente',
    '1' => 'Aceptada',
    '2' => 'Rechazada',
    '3' => 'Revisada',
    '4' => 'Aprobada',
    '5' => 'Cerrar',    
    '6' => 'Devuelta'
  );

  $opcsubproceso = array(
    '999'   => 'Seleccione un Subproceso',
    '0'   => 'NO APLICA'
  );

  $opcproceso = array(
    '999'   => 'Seleccione un Proceso',
    '0'   => 'NO APLICA'
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

  $opcsndocrela = array(
   'No'   => 'No',
   'Si'   => 'Si'
  );

  $opcdocrela= array(
    '0'   => 'Documento relacionado',
    '999'   => 'NO APLICA'
  );
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="modificar">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
             Modificar Solicitud
          </h3>
        </div>
        <div class="row mt-3">
    <div class="col-12">
      <div class="card dcard">
        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('d_solicitud/Actualizar'), array('id'=>'form_modificar', 'name'=>'form_modificar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
            
            <div class="form-body " style=" justify-content:flex-start;" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_solicitud));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idusuarioregsol', 'id'=>'idusuarioregsol', 'value'=>$c_id_usuario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idusuariactual', 'id'=>'idusuariactual', 'value'=>$c_usuario_a));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'iddocrelacionado', 'id'=>'iddocrelacionado', 'value'=>$c_documento_relacionado));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'sndocrelacionado', 'id'=>'sndocrelacionado', 'value'=>''));?> 
              <div class="form-group row" id="div_tipo" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo Solicitud *','tipo_solicitud', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('tipo_solicitud', $opcionesTsolicitud, $c_tipo_solicitud, 'class="form-control id="tipo_solicitud"');?>
                </div>
              
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo de Documento *','tipodocumentos_solicitud', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_tipodocumentos_tabla('solicitud',$c_id_tipo_documento,'form-control ');?>
                </div>
              </div>

                <div class="form-group row" id="div_nombre">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Nombre del Documento','nombre', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre del documento', 'maxlength'=>'100', 'class'=>'form-control UpperCase', 'value'=>$c_nombre_documento,'required'=>true));?>
                  </div>                     
                
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Macroproceso *','macroproceso', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    <?= select_macroprocesos_tabla('solicitud', $c_id_macroproceso,'form-control" required="1');?>
                    </div>
                </div>

                <div class="form-group row" id="div_procesos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Proceso *','proceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                  <?= form_dropdown('proceso',$c_opc_proceso, $c_id_proceso, 'class = "form-control " id="proceso"');?>
                  </div>    

                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Subproceso *','subproceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                  <?= form_dropdown('subproceso',$c_opc_subproceso, $c_id_subproceso, 'class = "form-control " id="subproceso"');?>
                  </div>                  
                </div>

                <div class="form-group row" id="div_justificacion">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Autor del documento','Solicitante', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_empleados_tabla('solicitud',$c_id_responsable,'select2 form-control');?>
                  </div>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Justificacion *','justificacion', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                  <?= form_textarea(array('rows'=>'2', 'name'=>'justificacion', 'id'=>'justificacion', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales se tramita la solicitud', 'class'=>'form-control ', 'value'=>$c_justificacion, 'required'=>true));?>
                  </div>
                </div>

                <div class="form-group row" id="div_aso_documentos">                            
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tiene Documento relacionado *','sn_doc_relacionado', array('class'=>'mb-0','id'=>'lblsn_doc_relacionado')); ?>
                  </div>
                  <div class="col-sm-3">
                      <!-- <?= form_dropdown('sn_doc_relacionado', $opcsndocrela, '', 'class="form-control" id="sn_doc_relacionado"');?> -->
                      <label class="col-form-label">
                       No
                      </label>
                        <?= form_input(array('type'=>'checkbox', 'name'=>'ck_d_relacionado', 'id'=>'ck_d_relacionado', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1'));?>
                        <?= form_input(array('type'=>'hidden', 'name'=>'idckdocre', 'id'=>'idckdocre', 'value'=>'0'));?>
                      <label class="col-form-label">
                        Si 
                      </label>
                  </div>
                  <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Documento Relacionado *','lbldoc_relacionado',  array('class'=>'mb-0', 'id'=>'lbldoc_relacionado')); ?>
                  </div>
                  <div class="col-sm-4 " id='divdoc_relacionado' >                    
                      <?= form_dropdown('doc_relacionado', $opcdocrela,$c_documento_relacionado, 'class="select2 form-control" id="doc_relacionado"');?>
                  </div>                                   
                </div>


                <div class="form-group row" id="div_origen_formato">                              
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Origen Formato *','origen_formato', array('class'=>'mb-0','id'=>'lblorigen_formato')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('origen_formato', $opcionesOrigen, $c_origen_formato, 'class="form-control" id="origen_formato"');?>
                  </div>  
                </div>

                <div class="form-group row" id="div_archivov">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Archivo Origen','archivoorig', array('class'=>'mb-0','id'=>'lblarchivoorig')); ?>
                  </div>
                 
                  <div class="col-sm-9">
                   <?= form_upload(array('type'=>'file', 'name'=>'archivoorig', 'id'=>'archivoorig', 'class'=>'form-control ace-file-input'));?>
                  </div>
                  <div class="col-sm-1">
                   <?= anchor(base_url().$c_archivo_original, '<i class="fa fa-file-word"></i>', array('class'=>'btn btn-circle btn-outline-primary','style'=>'width: 30px; height: 30px; padding: 2px 1px;font-size: 18px;','target'=>'_blank'));?>
                  </div>    
                </div>

                <div class="form-group row" id="div_seccion_revision">                   
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Quien revisa ','empleadosMR_revisa', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_empleadosMR_tabla('revisa', $c_id_revisado_por,'select2 multiple="multiple form-control');?>
                  </div>                  
                                   
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Quien Aprueba ','aprobadopor', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_empleadosMR_tabla('aprueba',$c_id_aprabo_por,'select2 multiple="multiple form-control ');?>
                  </div>                  
                </div>

                <div class="form-group row " id="div_estado">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"');?>
                  </div>

                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Observaciones *','observaciones', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    <?= form_textarea(array('rows'=>'3', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Registre las observaciones a que haya lugar', 'class'=>'form-control '));?>
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
                <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                <?= anchor(base_url('d_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
              </div>
            </div>
          <?= form_close(); ?>
        </div><!-- /.card-body -->
      </div><!-- /.card -->
      </div><!-- /.card -->
      </div><!-- /.card -->
      