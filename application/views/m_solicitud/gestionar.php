<?php
//echo $id;
$opciones = array(
  ''   => 'Seleccione una Opción',
  '0'   => 'Pendiente',
  '1'   => 'Programada',
  '2'   => 'Ejecutada',
  '3'   => 'Recibida',
  '4'   => 'Rechazda'
);

$opcprioridad = array(
  '' => 'Seleccione una prioridad',
  '1' => 'Alta',
  '2' => 'Media',
  '3' => 'Baja'
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
);

$opcresponsable = array(
  '' => 'Seleccione el responsable del Mantenimiento',
  '1' => 'Técnico',
  '2' => 'Equipo Asignado'

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
            <?= form_open(base_url('m_solicitud/guardar_programacion'), array('id' => 'form_programar', 'name' => 'form_programar', 'class' => 'mt-lg-3', 'autocomplete' => 'off')); ?>

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
                <div class="col-sm-4">
                  <?= form_input(array('type' => 'text', 'name' => 'nombreservicio', 'id' => 'nombreservicio',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_servicio)); ?>
                </div>
              
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Solicitante*', 'empleados_mantenimiento', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type' => 'text', 'name' => 'coordinador', 'id' => 'coordinador',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_solicitante)); ?>
                </div>
              </div>

              <div class="form-group row" id="div_observaciones">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Ubicación Especifica*', 'ubicacion', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type' => 'text', 'name' => 'ubicacion', 'id' => 'ubicacion',  'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_ubicacion)); ?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Observaciones  *', 'observaciones', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_textarea(array('rows' => '2', 'name' => 'observaciones', 'id' => 'observaciones', 'placeholder' => 'Realice las observaciones que considere', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_observaciones)); ?>
                </div>
              </div>

              <div class="form-group row" id="div_programacion">
                <div class="card dcard col-sm-12">
                  <div class="card-header">
                    <span class="card-title text-125">
                        Programación Mantenimiento
                    </span>
                  </div>

                  <div class="card-body">  
                    <div class="form-group row" id="div_mantenimiento">                   
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Recurso*', 'recurso', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                        <?= form_dropdown('recurso', $tipoRecurso, '', 'class="form-control" id="recurso"'); ?>
                      </div>
                    </div>  

                    <div class="form-group row " id="div_fechaM">                  
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha Inicial Mantenimiento', 'fechaMInicial', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                        <?= form_input(array('type' => 'date', 'name' => 'fechaMInicial', 'id' => 'fechaMInicial', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                      </div>

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Hora Inicial Mantenimiento', 'fechaMInicial', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                        <?= form_input(array('type' => 'time', 'name' => 'HoraM', 'id' => 'HoraM', 'placeholder' => '00:00', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                      </div>

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha Final Mantenimiento', 'fechaMfin', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                        <?= form_input(array('type' => 'date', 'name' => 'fechaMfin', 'id' => 'fechaMfin', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                      </div>
                    </div>  

                    <div class="form-group row " id="div_prioridad">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Prioridad *', 'prioridad', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-3">
                        <?= form_dropdown('prioridad', $opcprioridad, '', 'class="form-control" id="prioridad"'); ?>
                      </div>

                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Responsable Mantenimiento *', 'responsable', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_dropdown('responsable', $opcresponsable, '', 'class="form-control" id="responsable"'); ?>
                      </div>
                    </div>

                    <div class="form-group row " id="div_Observaciones">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Observaciones Programación*', 'observacionesM', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows' => '3', 'name' => 'observacionesM', 'id' => 'observacionesM', 'placeholder' => 'Registre las observaciones a que haya lugar', 'class' => 'form-control ', 'value' => '')); ?>
                      </div>
                    </div>

                    <div class="form-group row " id="div_prioridad">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Estado *', 'estado', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"'); ?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_programacion">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              Gestión Adicional
                          </span>

                          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btnAgregarNota">
                            <i class="fa fa-plus mr-1"></i>
                            <span class="d-sm-none d-md-inline" id="btnAgregarNota">Agregar Nota Adicional</span>
                          </button>
                        </div>
                        <div class="card-body"> 
                          <div class="row" id="nota">
                            <div class="col-12">                                              
                              <table id="notaAdicional" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                                <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                                  <tr>
                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">No.</th>
                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">FECHA NOTA</th>
                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">DESCRIPCIÓN DE NOTA</th>
                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ACCION</th>
                                  </tr>
                                </thead>
                                <tbody class="pos-tareas" id="pos-nota">
                                    <?= form_input(array('type'=>'hidden', 'name'=>'cantNota', 'id'=>'cantNota'));?>
                                </tbody>
                              </table>                                      
                            </div>
                          </div>
                        </div><!-- /.card-body -->
                      </div><!-- /.dcard -->
                    </div><!-- /.card -->

                    <div class="form-group row" id="div_programacion">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              Anexos de la Solicitud
                          </span>
                        </div>

                        <div class="card-body" >
                          <div class="container anexo" id="containerAnexo">

                          </div>
                        </div><!-- /.card-body -->
                      </div><!-- /.dcard -->
                    </div><!-- /.card --> 

                  </div><!-- /.card-body -->
                </div><!-- /.card -->
              </div>

              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="offset-md-3 col-md-9 text-nowrap">
                  <?= form_button(array('type' => 'button', 'id' => 'btn_programar', 'name' => 'btn_programar', 'content' => '<i class="fa fa-check mr-1"></i>Guardar', 'class' => 'btn btn-info btn-bold px-4')); ?>

                  <?= anchor(base_url('m_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class' => 'btn btn-danger btn-rounded m-t-10')); ?>
                </div>
              </div>
              <?= form_close(); ?>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.card -->
      </div><!-- /.card -->
    </div><!-- /.row -->
</div><!-- /.card -->   
    <!-- Modal notas Adicionales --> 
    <div id="newNota" class="modal fade modal-lg" data-keyboard="false"  role="dialog" aria-labelledby="myModalLabel" style="overflow: hidden; display: none;" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bgc-primary-m1 brc-white">
            <h4 class="modal-title text-blue" id="myModalLabel">Agregar Notas Adicionales a la Gestión</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
          </div>
          <div class="modal-body" id="modalFormBody">
            <?= form_open(base_url('#'), array('id'=>'form_guardarNota', 'name'=>'form_guardarNota', 'class'=>'', 'autocomplete'=>'off')); ?>
              <div class="form-group row" id="div_NuevaNota">
                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                  <?= form_label('Nota Adicional*', 'notaAdicional', array('class' => 'mb-0')); ?>
                </div>
                
                <div class="col-sm-9">                  
                  <?= form_input(array('type'=>'text', 'name'=>'Nota', 'id'=>'Nota', 'class'=>'form-control col-sm-12 col-md-10', 'required'=>true));?>
                </div>
              </div>               
         
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_registra_nota" name="btn_registra_nota">Guardar</button> 
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="btn_cancelar_modal">Cerrar</button>
              </div>
            <?= form_close(); ?>   
          </div>      
        </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdfModalLabel">Evidencias de la Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="pdfIframe" src="" width="100%" height="500px" frameborder="1" style="visibility:visible" ></iframe>

      </div>
    </div>
  </div>
</div>

  