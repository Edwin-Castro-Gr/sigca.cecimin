<?php
  //echo $id;
  $opciones = array(
    ''    => 'Seleccione opción',
    '0'   => 'Pendiente',
    '1'   => 'En proceso',
    '2'   => 'Aprobado',
    '3'   => 'Cerrada'   
  );

  $opcestado = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
  $opcsexo = array(
    ''    => 'Seleccione un valor',
    'F'   => 'Femenino',
    'M'   => 'Maxculino'
  );

  $opcriesgo = array(
    'NA'=> 'NA',
    'I'    => 'I',
    'II'   => 'II',
    'III'  => 'III',
    'IV'   => 'IV',
    'V'   => 'V'

  );
    $opcgsanguineo = array(
    ''    => 'Seleccione un valor',
    'A+'   => 'A+',
    'A-'   => 'A-',
    'B+'   => 'B+',
    'B-'   => 'B-',
    'AB+'   => 'AB+',
    'AB-'   => 'AB-',
    'O+'   => 'O+',
    'O-'   => 'O-'
  );
  $opcnacimiento = array(
    '0'   => 'Seleccione el Municipio de Nacimiento '
  );

  $opcresidencia = array(
    '0'   => 'Seleccione el Municipio de Residencia'
  );
 
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Nueva Solicitud de Ingreso
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('c_ingresop/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                
                <div class="form-body " style=" justify-content:flex-start;" >

                  <div class="form-group row" id="div_tipo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tipo Contrato *','tipocontratos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_tiposcontratos_tabla('ingresop','','form-control');?>
                    </div>                 
                    <?= form_input(array('type'=>'hidden', 'name'=>'idfuncionario', 'id'=>'idfuncionario', 'value'=>'0'));?>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Cedula','cedula_empleadol', array('class'=>'mb-0'));?>
                    </div>
                    <div class="col-sm-3">
                      <?= form_input(array('type'=>'text', 'name'=>'cedula_empleado', 'id'=>'cedula_empleado', 'placeholder'=>'Digite Cedula del Empleado', 'class'=>'form-control col-sm-11 col-md-12'));?>
                    </div>

                    <div class="col-sm-1">
                      <button type="button" class="btn px-2 btn-outline-primary col-sm-pull-5" id="btn_agregar_empleado" name="btn_agregar_empleado" data-toggle="modal" data-target="#newCempleado" >
                        +                 
                      </button>
                    </div>
                  </div>

                  <div class="form-group row" id="div_funcionario">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Nombres y Apellidos','nombre_empleado', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'nombre_empleado', 'id'=>'nombre_empleado', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','readonly'=>true));?>
                       <?= form_input(array('type'=>'hidden', 'name'=>'correo_empleado', 'id'=>'correo_empleado', 'value'=>''));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Cargo *','cargos_ingresop', array('class'=>'mb-0')); ?>
                    </div>
                      <div class="col-sm-4">
                      <?= select_cargos_tabla('ingresop','','select2 form-control" required="1');?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_sesion3">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Linea de Costos','lineacostos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_lineacostos_tabla('ingresop','','form-control');?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Centro de Costos','centroscostos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_centroscostos_tabla('ingresop','','form-control');?>
                    </div>  
                                      
                  </div>

                  <div class="form-group row" id="div_sesion4">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Departamentos','departamentos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= select_areas_tabla('ingresop','','form-control');?>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Jefe inmediato *','empleados_jefeinmed', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_coordinadores_tabla('jefeinm','','select2 form-control ');?>
                    </div>                    
                  </div>

                  <div class="form-group row" id="div_sesion5">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha de Inicio *','fechainicio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true));?>
                    </div>   
                  </div>  

                    <div class="container " id="div_parte7">                    
                        <div class="col-form-label text-sm-left pr-0">
                           <?= form_label('Documentos','anexos', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                            <div class="card-body p-0" id="accordionA">
                                <!--div class="accordion" id="accordionAnexos">                  


                             </div-->
                            </div>
                        </div><!-- /.card -->
                    </div><!-- /.card --> 

 
                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('c_ingresop/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>

                </div><!-- /.card-body -->
              <?= form_close(); ?>
            </div><!-- /.card -->
          </div>
        </div><!-- /.card -->
      </div>
    </div><!-- /.card -->

<!-- ***************************************** MODAL NUEVO EMPLEADO ************************************************ -->
    <!-- Modal Nuevo Tercero -->
      <div class="modal fade modal-lg" id="newCempleado" role="dialog" aria-labelledby="newModalLabelemp" aria-hidden="true">
          
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabelemp">
                Nuevo Empleado
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('c_ingresop/guardar_empleado'), array('id'=>'form_guardarempleado', 'name'=>'form_guardarempleado', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_identificacion">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Documento','tipodocidentidad', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= select_Tipo_docidentidad_tabla('empleados','','form-control " required="1');?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Documento ','cedula', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite el Número de documento', 'maxlength'=>'15', 'class'=>'form-control ', 'required'=>true));?>
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
                    
                    <div class="form-group row" id="div_fechanacimiento_email">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha de Nacimiento','fecha_nacimiento', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'date', 'name'=>'fecha_nacimiento', 'id'=>'fecha_nacimiento', 'placeholder'=>'Digite la fecha de nacimiento', 'class'=>'form-control col-sm-10 col-md-11', 'required'=>true));?>
                      </div>
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Email ','email', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Digite el Email', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
                        </div>
                    </div>

                    <div class="form-group row" id="div_direccion_telefono">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Dirección ','direccion', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'Digite la Dirección', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Teléfono','telefono', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4 input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                         <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Teléfono', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                      </div>
                    </div>
                  
                    <div class="form-group row" id="div_cargo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cargo','cargo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_cargos_tabla('empleados','','form-control col-sm-11 col-md-12');?>
                      </div>
                     </div>

                     <div class="form-group row" id="div_eps_arl">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Eps','eps', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= select_eps_tabla('empleados','','form-control col-sm-11 col-md-12');?>
                        </div>
                     
                       <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Arl','arl', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                           <?= select_arl_tabla('empleados','','form-control col-sm-11 col-md-12');?>
                        </div>
                      </div>

                      <div class="form-group row" id="div_gruposanguineo_nivelriesgo">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Grupo Sanguineo *','grupo_sanguineo', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-2">
                          <?= form_dropdown('gruposanguineo', $opcgsanguineo, '', 'class="form-control col-sm-11 col-md-12" id="gruposanguineo"');?>
                        </div>
                      
                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                            <?= form_label('Nivel de Riesgo','nivel_riesgo', array('class'=>'mb-0')); ?>
                          </div>
                        <div class="col-sm-4">
                           <?= form_dropdown('nivel_riesgo', $opcriesgo, '', 'class="form-control col-sm-11 col-md-12" id="nivel_riesgo"');?>
                        </div>
                      </div>  
                    <div class="container " id="div_parte7">                    
                      <div class="col-form-label text-sm-left pr-0">
                         <?= form_label('Documentos','anexos', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                        <div class="card-body p-0" id="accordionA">
                          <!--div class="accordion" id="accordionAnexos">                  


                        </div-->
                      </div>
                    </div><!-- /.card -->
                  </div><!-- /.card --> 


                  </div><!-- /.Form-body Modal-->
                </div><!-- /.card-body Modal-->

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary " id="btn_guardar_empleado" name="btn_guardar_empleado">
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
      