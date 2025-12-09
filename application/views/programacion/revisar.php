<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Pendiente',
    '1'   => 'Gestionada',
    '2'   => 'Confirmada',
    '3'   => 'Rechazado'
  );

  $opcestado = array(
    ''  => 'Inactivo',
    '0'  => 'Inactivo',
    '1'  => 'Activo'
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
?>

      <input type="hidden" name="opc_pag" id="opc_pag" value="revisar">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
            Revisión solicitud de Agendamiento de Sala Qx
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('c_programacion/guardar_revision'), array('id'=>'form_revisar', 'name'=>'form_revisar', 'class'=>'mt-lg-3', 'autocomplete'=>'on')); ?>
            <div class="form-body " style=" justify-content:flex-start;" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_programacion));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'usuario_crea', 'id'=>'usuario_crea', 'value'=>$c_usuario_a));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idusuariactual', 'id'=>'idusuariactual', 'value'=>$c_id_usuario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_cirujano', 'id'=>'id_cirujano', 'value'=>$c_id_cirujano));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'perfil_usuario', 'id'=>'perfil_usuario', 'value'=>$c_perfil));?>
              <div class="form-group row" id="div_paciente">
                <?= form_input(array('type'=>'hidden', 'name'=>'idpaciente', 'id'=>'idpaciente', 'value'=>$c_id_paciente));?>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Cedula Paciente','pacientes_programacion', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-2">
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
                <div class="col-sm-1">
                  <button type="button" class="btn px-2 btn-outline-blue col-sm-pull-5 fa fa-pencil-alt" id="btn_editar_paciente" name="btn_editar_paciente" >                     
                  </button>
                </div>
              </div>
              <div class="form-group row" id="div_seccion2">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha de Programación','fechaprogramacion', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechaprogramacion', 'id'=>'fechaprogramacion', 'placeholder'=>'Digite la fecha', 'class'=>'form-control','value'=>$c_fecha_programacion));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Hora','hora', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-1">
                    <?= form_input(array('type'=>'text', 'name'=>'horaprogramacion', 'id'=>'horaprogramacion', 'class'=>'form-control', 'value'=>$c_hora_programacion));?>
                </div>                
              </div>

              <div class="form-group row" id="div_cirujano" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Segundo Cirujano','cirujano_programacion', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                    <?= select_cirujanos_tabla('programacion',$c_id_2cirujano,'select2  form-control style="width: 100%"');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Lateralidad','lateralidad', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                    <?= form_dropdown('lateralidad', $opclateralidad, $c_lateralidad, 'class="form-control" id="lateralidad"');?>
                </div>
              </div>

              <div class="form-group row" id="div_tiempo">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo de Anestesia *','tipoanestesia', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-2">
                  <?= form_dropdown('tipoanestesia', $opcanestesia, $c_tipo_anestesia, 'class="form-control" id="tipoanestesia"');?>

                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tiempo piel a piel','tiempo', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-1 col-xs-1">                      
                <?= form_input(array('type'=>'text', 'name'=>'tiempohoras', 'id'=>'tiempohoras', 'placeholder'=>'Horas', 'class'=>'form-control', 'min'=>"0", 'max'=>"24", 'required'=>true, 'value'=>$c_tiempoqxh));?>                    
                </div>
                
              </div>

              <div class="form-group row" id="div_estado_SalaQx">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Estado','estado', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Sala Asignada','salaqx', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'salaqx', 'id'=>'salaqx', 'placeholder'=>'Digite la Sala Asignada', 'maxlength'=>'25', 'class'=>'form-control UpperCase', 'value'=>$c_salaQx,'required'=>true));?>
                </div>
              </div>

              <div class="form-group row" id="div_observaciones">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Observaciones Cirujano','observaciones', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'Readonly'=>true, 'value'=>$c_observaciones));?>
                </div>
              </div>
              <div class="form-group row" id="div_observaciones">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Observaciones Programación','observaciones', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_r', 'id'=>'observaciones_r', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>$c_observaciones_r));?>
                </div>
              </div>

                <br>
                  <div class="row" id="procedimientos">
                    <div class="col-12">
                      <h5 class="bgc-primary-d3 text-white brc-white p-15">Descripción de Procedimientos</h5>
                      <table id="procedimientoscx" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                        <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                          <tr>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">..</th>
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
                      <div class="bgc-info-d3 text-white brc-white p-15"><?= form_button(array('type'=>'button', 'id'=>'btn_nuevoprocedimiento', 'name'=>'btn_nuevoprocedimiento', 'content'=>'<i class="fa fa-check mr-1"></i>Nuevo Procedimiento', 'class'=>'btn btn-lighter-success btn-bold px-4')); ?>                        
                      </div>
                    </div>
                  </div>

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_revision', 'name'=>'btn_guardar_revision', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

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

      <!-- **************************************** PACIENTE **************************************** -->      
      <div class="modal fade modal-lg" id="newMPaciente" role="dialog" aria-labelledby="newModalLabelEmp" aria-hidden="true">

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabelEmp">
                Nuevo paciente
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('c_programacion/guardar_paciente'), array('id'=>'form_guardarpaciente', 'name'=>'form_guardarpaciente', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistropa', 'id'=>'idregistropa', 'value'=>'0'));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_identificacion">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Documento','tipodocidentidad', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= select_Tipo_docidentidad_tabla('pacientes','','form-control " required="1');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Documento ','numero_idl', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'numero_id', 'id'=>'numero_id', 'placeholder'=>'Digite el Numero de documento', 'maxlength'=>'15', 'class'=>'form-control ', 'required'=>true));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_nombres_apellidos">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Nombres ','nombres', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Digite los Nombres', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Apellidos','apellidos', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'apellidos', 'id'=>'apellidos', 'placeholder'=>'Digite los Apellidos', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_fecha_nacimiento">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha Nacimiento ','fecha_nacimiento', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'date', 'name'=>'fecha_nacimiento', 'id'=>'fecha_nacimiento', 'placeholder'=>'Digite la fecha de nacimiento', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                      </div>

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Edad','edad', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'edad', 'id'=>'edad', 'placeholder'=>'Digite la edad', 'maxlength'=>'3', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_eps_otro">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Entidad de Salud','eps_pacientes', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= select_eps_tabla('pacientes','','form-control col-sm-11 col-md-12');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Otro ','otra_entidad_salud', array('class'=>'mb-0','id'=>'lblotra_entidad_salud')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'otra_entidad_salud', 'id'=>'otra_entidad_salud', 'placeholder'=>'Digite el Cual?', 'maxlength'=>'100', 'class'=>'form-control col-sm-11 col-md-12 UpperCase'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_contacto">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Telefono ','telefono', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Telefono', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                      </div>

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Correo ','correo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'email', 'name'=>'correo', 'id'=>'correo', 'placeholder'=>'Digite el Email', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_estadop">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Estado *','lblestado', array('class'=>'mb-0', 'id'=>'lblestado')); ?>
                      </div>
                      <div class="col-sm-6">
                        <?= form_dropdown('estadoP', $opcestado, '', 'class="form-control col-sm-11 col-md-12" id="estadoP"');?>
                      </div>
                    </div>
                  </div><!-- /.Form-body Modal-->
                </div><!-- /.card-body Modal-->

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary " id="btn_guardar_paciente" name="btn_guardar_paciente">
                    Guardar
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


   