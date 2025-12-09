<?php
  //echo $id;
  
  $opcestado = array(
    '0'  => 'Sin Confirmar',
    '1'  => 'Confirmada',
    '2'  => 'Cancelada'
  );
  
  $opcmat = array(
    '0'   => 'Seleccione una opción',
    '1'   => 'No',
    '2'   => 'Si',
    '3'   => 'Si y RX',
    '4'   => 'Si/RX'
  );

  $opctipoanestesia =array(
    ''  => 'Seleccione una opción',
    '1' => 'Local',
    '2' => 'Sedación',
    '3' => 'Sedación más Bloqueo'
  );

  $opcsala = array(
    '' => 'Seleccione una Sala',
    '1' => 'Sala 1',
    '2' => 'Sala 2',
    '3' => 'Sala 3'
  );

  $opcservicios = array(
    '' => 'Seleccione un servicio',
    '1' => 'Odontología',
    '2' => 'Sala de procedimientos',
    '3' => 'Unidad de Aplicación de medicamentos',
    '4' => 'Enfermería',
    '5' => 'Toma de muestras',
    '6' => 'Consulta prioritaria de Ortopedia',
    '7' => 'Electromiografía',
    '8' => 'Imágenes diagnósticas'
  );


$opcgenero = array(
    '0' => 'Seleccione el Genero',
    '1' => 'MASCULINO',
    '2' => 'FEMENINO',
    '3' => 'OTRO'
  ); 

  $opcubicacion_paciente = array(
    '' => 'Seleccione una Opcción',
    '1' => 'Cirugia Cancelada',
    '2' => 'En Casa',
    '3' => 'En Sala de Cirugia',
    '4' => 'En Zona de Preparación',    
    '5' => 'En Sala de Recuperación'
  );

  $opcentidad = array(
    '0' => 'Seleccione una Entidad',
    '1' => 'ASISDERMA',
    '2' => ' BANCO REPUBLICA',
    '3' => ' COLSANITAS',
    '4' => 'COLSANITAS BANCO DE LA REPUBLICA',
    '5' => 'COLSANITAS BANCO REPUBLICA',
    '6' => 'COLSANITAS BAVARIA',
    '7' => 'COLSANITAS CERREJON',
    '8' => 'COLSANITAS MINTIC',
    '9' => 'COLSANITAS MODULAR',
    '10' => 'COLSANITAS PLAN MODULAR',
    '11' => 'EPS SANITAS',
    '12' => 'MEDISANITAS',
    '13' => 'PANAMERICAN LIFE',
    '14' => 'PARTICULAR',
    '15' => 'SEGUROS BOLIVAR',
    '16' => 'SEGUROS BOLIVAR POLIZA DE SALUD',
    '17' => 'SEGUROS BOLIVAR POLIZA SALUD',
    '18' => 'UNISALUD'
  );

?>
  <input type="hidden" name="opc_pag" id="opc_pag" value="nuevo">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
          Nuevo procedimiento
        </h3>
      </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card dcard">
              <div class="card-body px-3 pb-1">
                <?= form_open(base_url('c_seguimientocx/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'on')); ?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'id_cirujano', 'id'=>'id_cirujano', 'value'=>$c_usuario));?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'num_llamada', 'id'=>'num_llamada', 'value'=>"0"));?>
                <div class="form-body " style=" justify-content:flex-start;" >
                  <div class="card dcard">
                    <div class="card-header">
                      <h3 class="card-title text-125 text-primary-d2">
                        Datos del Paciente
                      </h3>
                    </div>
                    <div class="card-body px-2 pb-1">  
                      <div class="form-group row" id="div_paciente" >
                        <?= form_input(array('type'=>'hidden', 'name'=>'idpaciente', 'id'=>'idpaciente', 'value'=>'0'));?>
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Identificación Paciente*','cedula', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-3">
                            <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite el # identificación', 'class'=>'form-control col-sm-11 col-md-12'));?>
                        </div>                        
                        <div class="col-sm-5">
                          <?= form_input(array('type'=>'text', 'name'=>'paciente', 'id'=>'paciente', 'placeholder'=>'Digite nombres y apellidos del paciente', 'class'=>'form-control col-sm-9 col-md-12 UpperCase'));?>
                        </div>
                        <div class="col-sm-1 col-form-label text-sm-right pr-0">
                          <?= form_label('Edad *','edad', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-1">
                          <?= form_input(array('type'=>'text', 'name'=>'edad', 'id'=>'edad', 'class'=>'form-control col-sm-9 col-md-12 UpperCase'));?>
                        </div>                   
                      </div>
                      <div class="form-group row" id="div_datospaciente" >
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Dirección ','direccion', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'Digite la Dirección', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                        </div>
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Teléfono','telefono', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Teléfono', 'maxlength'=>'15', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
                        </div>
                      </div>  
                      <div class="form-group row" id="div_datosIIpaciente" >
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Entidad de Salud','eps_pacientes', array('class'=>'mb-0',)); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= select_eps_tabla('pacientes','','form-control col-sm-11 col-md-12');?>
                        </div>
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Convenio','entidad_pacientes', array('class'=>'mb-0',)); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_dropdown('entidad', $opcentidad,'','class="form-control" id="sala"');?>
                        </div>
                      </div>  
                      <div class="form-group row" id="div_datosIIIpaciente" >
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Genero ','genero', array('class'=>'mb-0',)); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_dropdown('genero', $opcgenero,'','class="form-control" id="genero"');?>
                        </div>

                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Servicio ','servicio', array('class'=>'mb-0',)); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_dropdown('servicio', $opcservicios,'','class="form-control" id="servicio"');?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="card dcard">
                    <div class="card-header">
                      <h3 class="card-title text-125 text-primary-d2">
                        Datos del procedimiento 
                      </h3>
                    </div>
                    <div class="form-group row" id="div_seccion2">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha de procedimiento','fechaprogramacion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="pos-rel col-sm-2">
                        <?= form_input(array('type'=>'date', 'name'=>'fechaprogramacion', 'id'=>'fechaprogramacion', 'class'=>'form-control ', 'required'=>true));?>  
                        <?= form_input(array('type'=>'hidden', 'name'=>'val_fechapro', 'id'=>'val_fechapro', 'value'=>''));?>      
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Hora *','hora', array('class'=>'mb-0'));?>
                      </div>
                      <div class="col-sm-1,5">
                          <?= form_input(array('type'=>'time', 'name'=>'horaprogramacion', 'id'=>'horaprogramacion', 'class'=>'form-control ', 'min'=>'07:00', 'max'=>'18:00', 'value'=>'07:00', 'required'=>true));?>
                      </div> 

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tiempo','tiempo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-1 col-xs-1">                      
                      <?= form_input(array('type'=>'text', 'name'=>'tiempohoras', 'id'=>'tiempohoras', 'placeholder'=>'HH:MM', 'class'=>'form-control', 'min'=>"0", 'max'=>"6", 'required'=>true));?>                    
                      </div>                                         
                    </div>

                    <div class="form-group row" id="div_procedimiento">                    
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Procedimiento','procedimientos_seguimiento', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_procedimientos_tabla('seguimiento','','select2 form-control');?>
                      </div>                  
                    </div>
                    
                    <div class="form-group row" id="div_cirujano" >
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Especialista','cirujano_programacion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= select_cirujanos_tabla('programacion','','select2 form-control style="width: 100%"');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Anestesia','tipo_anestesia', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_dropdown('tipo_anestesia', $opctipoanestesia, '', 'class="form-control" id="tipo_anestesia"');?>                        
                      </div>                    
                    </div>

                    <div class="form-group row" id="div_analgesiologo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Anestesiologo','anestesiologo_programacion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= select_anestesiologo_tabla('programacion','','select2 form-control');?>
                      </div> 
                    </div>                  
                  </div>
                <br>               

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('c_seguimientocx/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>
                </div><!-- /.card-body -->
                <?= form_close(); ?>
              </div><!-- /.card -->
            </div>
          </div>
        </div><!-- /.card -->
      </div>

      <!-- ************************************ PROCEDIMIENTOS QX*********************************************** -->
      <div class="modal fade modal-lg" id="newModal"  role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
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
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_procedimientos">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Procedimiento','procedimiento', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_procedimientos_tabla('agendamiento','','select2 form-control');?>
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
                        <?= select_grupos_tabla('agendamiento','','select2 form-control');?>
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
                     <div class="form-group row" id="div_materiales">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Otros Materiales ','omateriales', array('class'=>'mb-0','id'=>'lblmateriales')); ?>
                      </div>
                      <div class="col-sm-10" style="overflow: auto; height: 100%;">
                        <?= form_input(array('type'=>'text', 'name'=>'regotro', 'id'=>'regotro', 'class'=>'form-control col-sm-11 col-md-12','value'=>''));?>
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

      <!-- Modal Nuevo Paciente -->
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
              <?= form_open(base_url('c_programacion/guardar_paciente'), array('id'=>'form_paciente', 'name'=>'form_paciente', 'class'=>'', 'autocomplete'=>'off')); ?>
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
                  <button type="submit" class="btn btn-primary " id="btn_actualizar_paciente" name="btn_actualizar_paciente">
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