<?php
  //echo $id;
   $opciones = array(
      ''   => 'Seleccione una Opción',
      '0'   => 'Pendiente',
      '1'   => 'Aceptada',
      '2'   => 'Rechazada',
      '3'   => 'Revisada',
      '4'   => 'Aprobada',
      '5'   => 'Cerrar',
      '7'   => 'Devuelta'
   );

   $opcsubproceso = array(
      '0'   => 'Seleccione un Subproceso',
      '999'   => 'NO APLICA'
   );

   $opcproceso = array(
      '0'   => 'Seleccione un Proceso',
      '999'   => 'NO APLICA'
   );

   $opcionesTsolicitud = array(
      '1'   => 'Creación',
      '2'   => 'Modificación',
      '3'   => 'Eliminación'
   );

   $opcionesOrigen= array(
      ''   => 'Seleccione una Opción',
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

   <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

      <div class="card acard mt-2 mt-lg-3">
         <div class="card-header">
            <h3 class="card-title text-125 text-primary-d2">
               <i class="far fa-edit text-dark-l3 mr-1"></i>
               Nueva Solicitud
            </h3>
         </div>

        <div class="card-body px-3 pb-1">
            <?= form_open(base_url('d_solicitud/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>          
            <?= form_input(array('type'=>'hidden', 'name'=>'iddocrelacionado', 'id'=>'iddocrelacionado', 'value'=>''));?> 
            <?= form_input(array('type'=>'hidden', 'name'=>'iddocumento', 'id'=>'iddocumento', 'value'=>''));?>
            <?= form_input(array('type'=>'hidden', 'name'=>'idckdocre', 'id'=>'idckdocre', 'value'=>'No'));?>
            <div class="form-body " style=" justify-content:flex-start;" >

               <div class="form-group row" id="div_tipo" >
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                     <?= form_label('Tipo Solicitud *','estado', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                     <?= form_dropdown('tipo_solicitud', $opcionesTsolicitud, '', 'class="form-control" id="tipo_solicitud"');?>
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
                     <?= form_label('Nombre del Documento','nombre', array('class'=>'mb-0', 'id'=>'lblnombredoc')); ?>
                  </div>
                  <div class="col-sm-4">
                     <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre del documento', 'maxlength'=>'255', 'class'=>'form-control UpperCase', 'required'=>true));?>
                     <?= select_documentos_tabla('solicitud','','select2 form-control "required="true"');?>
                  </div>                     
              
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                     <?= form_label('Macroproceso *','macroproceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                     <?= select_macroprocesos_tabla('solicitud','','form-control "required="true"');?>
                  </div>
               </div>

              <div class="form-group row" id="div_subprocesos">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                     <?= form_label('Proceso *','proceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                     <?= form_dropdown('proceso',$opcproceso, '0', 'class = "form-control " id="proceso"');?>
                  </div>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                     <?= form_label('Subproceso *','subproceso', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                     <?= form_dropdown('subproceso',$opcsubproceso, '0', 'class = "form-control " id="subproceso"');?>
                  </div> 
              </div>

              <div class="form-group row" id="div_justificacion">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                     <?= form_label('Autor del documento','Solicitante', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                     <?= select_empleados_tabla('autor','','select2 form-control');?>
                  </div>

                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                     <?= form_label('Justificación *','justificacion', array('class'=>'mb-0')); ?>
                  </div>
                <div class="col-sm-4">
                <?= form_textarea(array('rows'=>'2', 'name'=>'justificacion', 'id'=>'justificacion', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales se tramita la solicitud', 'class'=>'form-control ', 'required'=>true));?>
                </div>
              </div>

              <div class="form-group row" id="div_aso_documentos">                            
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Tiene Documento relacionado *','lblck_d_relacionado', array('class'=>'mb-0','id'=>'lblck_d_relacionado')); ?>
                </div>
                <div class="col-sm-4">
                    
                    <label class="col-form-label">
                     No
                    </label>
                      <?= form_input(array('type'=>'checkbox', 'name'=>'ck_d_relacionado', 'id'=>'ck_d_relacionado', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1', 'required'=>true));?>
                    <label class="col-form-label">
                      Si 
                    </label>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Documento Relacionado *','lbldoc_relacionado',  array('class'=>'mb-0', 'id'=>'lbldoc_relacionado')); ?>
                </div>
                <div class="col-sm-4 " id='divdoc_relacionado' >
                    <?= form_dropdown('doc_relacionado', $opcdocrela, '0', 'class="form-control select2" id="doc_relacionado"');?>
                </div>                   
              </div>

              <div class="form-group row " id="div_origen_formato">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Origen Formato *','origen_formato', array('class'=>'mb-0','id'=>'lblorigen_formato')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('origen_formato', $opcionesOrigen, '0', 'class="form-control" id="origen_formato"');?>
                </div>
              </div>

              <div class="form-group row" id="div_archivov">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Archivo Origen','archivoorig', array('class'=>'mb-0','id'=>'lblarchivoorig')); ?>
                </div>
                <div class="col-sm-9">
                 <?= form_upload(array('type'=>'file', 'name'=>'archivoorig', 'id'=>'archivoorig', 'class'=>'form-control ace-file-input'));?>                   
                </div>
                <div class="col-sm-1" id="PDF">
                 
                </div>                  
              </div>      

              <div class="form-group row" id="div_seccion_revision">                   
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Quien revisa ','revisa', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_empleadosMR_tabla('revisa','','select2 multiple="multiple form-control');?>
                </div>         
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Quien Aprueba ','aprueba', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_empleadosMR_tabla('aprueba','','select2 multiple="multiple form-control');?>
                </div>                  
              </div>
            <div class="form-group row" id="div_socializa_capacita">                            
              <div class="col-sm-3 col-form-label text-sm-right pr-0">
                  <?= form_label('El Documento se debe socializar','lblck_d_relacionado', array('class'=>'mb-0','id'=>'lblck_d_relacionado')); ?>
              </div>
              <div class="col-sm-5 col-form-label text-sm-right pr-0">
                  <?= form_label(' Requiere Capacitación?','lblck_d_relacionado', array('class'=>'mb-0','id'=>'lblck_d_relacionado','value'=>false)); ?>
              </div>
              <div class="col-sm-4">                 
                <label class="col-form-label">
                  No
                </label>
                  <?= form_input(array('type'=>'checkbox', 'name'=>'ck_capacitacion', 'id'=>'ck_capacitacion', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1'));?>  
                  <?= form_input(array('type'=>'hidden', 'name'=>'capacitacion', 'id'=>'capacitacion', 'value'=>'0'));?>                      
                <label class="col-form-label">
                  Si
                </label>
              </div>
            </div>
            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-3 col-md-9 text-nowrap">
                <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                <?= anchor(base_url('d_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
              </div>
            </div>
          <?= form_close(); ?>
        </div><!-- /.card-body -->
      </div><!-- /.card -->
