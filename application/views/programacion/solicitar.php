<?php
  //echo $id;
  $opciones = array(
    '0'  => 'Pendiente',
    '1'  => 'Gestionada',
    '2'  => 'Confirmada',
    '3'  => 'Rechazada'
  );

  $opcanestesia = array(
    '0'   => 'General',
    '1'   => 'Regional',  
    '2'   => 'Local Asistida',
    '3'   => 'Local'  
  );

  $opclateralidad= array(
    '0'   => 'No aplica',
    '1'   => 'Izquierdo',  
    '2'   => 'Derecho',
    '3'   => 'Bilateral'  
  );

  $opcemail = array(
    "" => 'Seleccione correos'
  );
?>

      <input type="hidden" name="opc_pag" id="opc_pag" value="solicitar">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
            Solicitud de Materiales para Agendamiento de Sala Qx
          </h3>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card dcard">
              <div class="card-body px-3 pb-1">
                <?= form_open(base_url('c_programacion/guardar_solmateriales'), array('id'=>'form_smateriales', 'name'=>'form_smateriales', 'class'=>'mt-lg-3', 'autocomplete'=>'on')); ?>
                  <div class="form-body " style=" justify-content:flex-start;" >
                    <?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_programacion));?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'usuario_crea', 'id'=>'usuario_crea', 'value'=>$c_id_usuario));?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'perfil_usuario', 'id'=>'perfil_usuario', 'value'=>$c_perfil));?>

                    <?= form_input(array('type'=>'hidden', 'name'=>'idusuariactual', 'id'=>'idusuariactual', 'value'=>$c_usuario_a));?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'id_cirujano', 'id'=>'id_cirujano', 'value'=>$c_id_cirujano));?>
                    
                    <div class="form-group row" id="div_paciente">
                      <?= form_input(array('type'=>'hidden', 'name'=>'idpaciente', 'id'=>'idpaciente', 'value'=>$c_id_paciente));?>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cedula Paciente','pacientes_programacion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-3">
                        <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite la cedula', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_cedula_paciente, 'Readonly'=>true));?>
                      </div>

                      <div class="col-sm-1">
                        <button type="button" class="btn px-2 btn-outline-primary col-sm-5" id="btn_agregar_paciente" name="btn_agregar_paciente" data-toggle="modal" data-target="#newMPaciente" >
                          +
                        </button>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Paciente','pacientes', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'paciente', 'id'=>'paciente', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','value'=>$c_nombre_paciente, 'Readonly'=>true));?>
                      </div>
                    </div>
                    <div class="form-group row" id="div_seccion2">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha de Programación','fechaprogramacion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'date', 'name'=>'fechaprogramacion', 'id'=>'fechaprogramacion', 'placeholder'=>'Digite la fecha', 'class'=>'form-control','value'=>$c_fecha_programacion, 'Readonly'=>true));?>
                      </div>

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Hora','hora', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                          <?= form_input(array('type'=>'text', 'name'=>'horaprogramacion', 'id'=>'horaprogramacion', 'class'=>'form-control', 'value'=>$c_hora_programacion, 'Readonly'=>true));?>
                      </div>                
                    </div>

                    <div class="form-group row" id="div_cirujano" >
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cirujano','cirujano_programacion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                          <?= select_cirujanos_tabla('programacion',$c_id_cirujano,'select2  form-control Readonly=trues style="width: 100%" ');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Segundo Cirujano','cirujano_programacion2', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                          <?= select_cirujanos_tabla('programacion1',$c_id_2cirujano,'select2  form-control style="width: 100%"');?>
                      </div>
                      
                    </div>

                    <div class="form-group row" id="div_tiempo">

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Lateralidad','lateralidad', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                          <?= form_dropdown('lateralidad', $opclateralidad, $c_lateralidad, 'class="form-control" id="lateralidad"');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo de Anestesia *','tipoanestesia', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                        <?= form_dropdown('tipoanestesia', $opcanestesia, $c_tipo_anestesia, 'class="form-control" id="tipoanestesia"');?>

                      </div>
                      <div class="col-sm-1">
                      </div>  


                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tiempo piel a piel','tiempo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-1 col-xs-1">                      
                      <?= form_input(array('type'=>'text', 'name'=>'tiempohoras', 'id'=>'tiempohoras', 'placeholder'=>'Horas', 'class'=>'form-control', 'min'=>"0", 'max'=>"24", 'value'=>$c_tiempoqxh, 'Readonly'=>true));?>                    
                      </div>                      
                    </div>

                    <div class="form-group row" id="div_estado_SalaQx">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Estado','estado', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control " id="estado"');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Sala Asignada','salaqx', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'salaqx', 'id'=>'salaqx', 'placeholder'=>'Digite la Sala Asignada', 'maxlength'=>'25', 'class'=>'form-control UpperCase', 'value'=>$c_salaQx, 'Readonly'=>true));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_observaciones">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>$c_observaciones, 'Readonly'=>true));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_observaciones_r">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Observaciones Programación','observaciones', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_r', 'id'=>'observaciones_r', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>$c_observaciones_r, 'Readonly'=>true));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_observaciones">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Observaciones Instrumentación','observaciones', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_s', 'id'=>'observaciones_s', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                      </div>
                    </div>

                    <br>
                    <div class="row" id="procedimientos">
                      <div class="col-12">
                        <h5 class="bgc-primary-d3 text-white brc-white p-15">Descripción de Procedimientos</h5>
                        <table id="procedimientoscx" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                          <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                            <tr>                            
                              <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ID</th>
                              <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">NOMBRE PROCEDIMIENTO</th>
                              <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">MATERIAL</th>
                              <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">OTROS</th>
                              <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">PROVEEDOR</th>
                            </tr>
                          </thead>

                          <tbody class="pos-rel">
                            
                          </tbody>
                        </table>
                        
                      </div>
                    </div>
                      <br>

                      <div><h4>Relacione los materiales y sus respectivas casas comerciales</h4></div>
                      <div class="card dcard">
                        <div class="card-body px-3 pb-1">                          
                          <div class="form-group row" id="div_solicitud_1">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Materiales','materiales', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                             <?= form_input(array('type'=>'text', 'name'=>'materiales1', 'id'=>'materiales1', 'placeholder'=>'Copie los materiales a solicitar', 'maxlength'=>'200', 'class'=>'form-control UpperCase','value'=>''));?>
                            </div>                     
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Proveedor material','proveedor1', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= select_proveedoresQx_tabla('agendamiento1','','selectcc form-control');?>
                            </div>
                          </div>  
                          <div class="form-group row" id="div_observaciones_instrumentadoras">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Correo Casa Comercial','correo1', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_dropdown('email_casa1', $opcemail,'', 'class="form-control " id="email_casa1"');?>
                            </div>
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Observaciones Instrumentadoras','observaciones_i1', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_instru1', 'id'=>'observaciones_instru1', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card dcard">
                        <div class="card-body px-3 pb-1">
                          <div class="form-group row" id="div_solicitud_1">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Materiales','materiales2', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                             <?= form_input(array('type'=>'text', 'name'=>'materiales2', 'id'=>'materiales2', 'placeholder'=>'Copie los materiales a solicitar', 'maxlength'=>'200', 'class'=>'form-control UpperCase','value'=>''));?>
                            </div>                     
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Proveedor material','proveedor2', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= select_proveedoresQx_tabla('agendamiento2','','selectcc form-control');?>
                            </div>
                          </div>  
                          <div class="form-group row" id="div_observaciones_instrumentadoras">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Correo Casa Comercial','correo2', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_dropdown('email_casa2', $opcemail,'', 'class="form-control " id="email_casa2"');?>
                            
                            </div>
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Observaciones Instrumentadoras','observaciones_i2', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_instru2', 'id'=>'observaciones_instru2', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card dcard">
                        <div class="card-body px-3 pb-1">
                          <div class="form-group row" id="div_solicitud_1">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Materiales','materiales3', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                             <?= form_input(array('type'=>'text', 'name'=>'materiales3', 'id'=>'materiales3', 'placeholder'=>'Copie los materiales a solicitar', 'maxlength'=>'200', 'class'=>'form-control UpperCase','value'=>''));?>
                            </div>                     
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Proveedor material','proveedor3', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= select_proveedoresQx_tabla('agendamiento3','','selectcc form-control');?>
                            </div>
                          </div>  
                          <div class="form-group row" id="div_observaciones_instrumentadoras3">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Correo Casa Comercial','correo1', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_dropdown('email_casa3', $opcemail,'', 'class="form-control " id="email_casa3"');?>
                             
                            </div>
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Observaciones Instrumentadoras','observaciones_i3', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_instru3', 'id'=>'observaciones_instru3', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                            </div>
                          </div>
                        </div>
                      </div>                      

                        <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                          <div class="offset-md-3 col-md-9 text-nowrap">
                            <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_solicitud', 'name'=>'btn_guardar_solicitud', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                            <?= anchor(base_url('c_programacion/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                          </div>
                        </div>
                      </div><!-- /.card-body -->
                      <?= form_close(); ?>        
                    </div><!-- /.card -->
                  </div>
                </div>
              </div><!-- /.card -->
            </div>

     
      <!-- **************************************** PROCEDIMIENTOS **************************************** -->
      <div class="modal fade modal-lg" id="newModal" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabel">
                Descripción Procedimiento
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('c_programacion/guardar_procedimientos'), array('id'=>'form_guardar_pro', 'name'=>'form_guardar_pro', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'id_programacion', 'id'=>'id_programacion', 'value'=>$c_id_programacion));?>
                
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_procedimientos">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Procedimiento','procedimiento', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_procedimientos_tabla('agendamiento','','select2 form-control col-sm-11 col-md-12"required="1');?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_descripcion">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Descripción adicional*','descripcion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                          <?= form_input(array('type'=>'text', 'name'=>'descripcion', 'id'=>'descripcion', 'placeholder'=>'Describa el procedimiento si no se encuntro en la casilla anterior', 'class'=>'form-control col-sm-11 col-md-12'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_grupo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Grupo','gprocedimiento', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_grupos_tabla('agendamiento','','form-control select2 "required="1');?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_materiales">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Materiales ','materiales', array('class'=>'mb-0','id'=>'lblmateriales')); ?>
                      </div>
                      <div class="col-sm-10" id="div_chk" style="overflow: auto; height: 100%;">
                        <?= form_input(array('type'=>'hidden', 'name'=>'regotro', 'id'=>'regotro', 'value'=>''));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_proveedor">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Casa Comercial','proveedor', array('class'=>'mb-0','id'=>'lblproveedor')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_tercerosM_tabla('agendamiento','','select2 form-control col-sm-10 col-md-12');?>
                      </div>
                    </div>
                  </div><!-- /.Form-body Modal-->
                </div><!-- /.card-body Modal-->

                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btn_guardar_proc" name="btn_guardar_proc">
                    Guardar
                  </button>
                  <button type="button" class="btn btn-primary " id="btn_actualizar_proc" name="btn_actualizar_proc">
                    Actualizar
                  </button>
                  <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                    Cerrar
                  </button>
                </div>
              <?= form_close(); ?>
            </div><!-- /.Modal-body -->
          </div> <!-- /.modal-content -->
        </div>
      </div>  <!-- /.Modal -->
