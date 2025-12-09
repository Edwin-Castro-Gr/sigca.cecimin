<?php
  //echo $id;
  
  $opcestado = array(
    '0' => 'Sin Seguimiento',
    '1' => 'En Segumiento',
    '2' => 'Cerrada'
  );
  
  $opcmat = array(
    '0'   => 'Seleccione una opción',
    '1'   => 'No',
    '2'   => 'Si',
    '3'   => 'Si y RX',
    '4'   => 'Si/RX'
  );

  $opcinformo=array(
    '0'   => 'Paciente',
    '1'   => 'Familiar'
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

  $opccumpleTP = array(
    '' => 'Seleccione una opción',
    '1' => 'Cumple',
    '2' => 'No Cumple',
    '3' => 'Inderterminado'
  );
  $opctipoanestesia =array(
    ''  => 'Seleccione una opción',
    '1' => 'Local',
    '2' => 'Sedación',
    '3' => 'Sedación más Bloqueo'
  );
  
   $opcllamada = array(
    '' => 'Seleccione una opción',
    '1' => 'Primera Llamada',
    '2' => 'Segunda Llamada',
    '3' => 'Tercera Llamada'
  );

    $opcsino = array(
    ''   => 'Seleccione Si/No',
    '0'   => 'No',
    '1'   => 'Si'
  );

  $opcentidad = array(
    '0' => 'Seleccione una Entidad',
    '1' => 'ASISDERMA',
    '2' => 'BANCO REPUBLICA',
    '3' => 'COLSANITAS',
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

  $opcgenero = array(
    '0' => 'Seleccione el Genero',
    '1' => 'MASCULINO',
    '2' => 'FEMENINO',
    '3' => 'OTRO'
  ); 

?>
<input type="hidden" name="opc_pag" id="opc_pag" value="modificar">
  <div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
      <h3 class="card-title text-125 text-primary-d2">
        <i class="far fa-edit text-dark-l3 mr-1"></i>
        Seguimiento a Pacientes de Procedimientos
      </h3>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="card dcard">
          <div class="card-body px-3 pb-1">
            <?= form_open('', array('id'=>'form_modificar', 'name'=>'form_modificar', 'class'=>'mt-lg-3', 'autocomplete'=>'on')); ?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_cirugia', 'id'=>'id_cirugia', 'value'=>$c_id_cirugia));?>
              
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
                      <?= form_label('Cedula Paciente ','cedula', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-3">
                        <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite la cedula', 'class'=>'form-control col-sm-11 col-md-12', 'value'=>$c_idpaciente, 'Readonly'=>true));?>
                    </div>                        
                    <div class="col-sm-5">
                      <?= form_input(array('type'=>'text', 'name'=>'paciente', 'id'=>'paciente', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>$c_paciente, 'Readonly'=>true));?>
                    </div>
                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                      <?= form_label('Edad ','edad', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-1">
                      <?= form_input(array('type'=>'text', 'name'=>'edad', 'id'=>'edad', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>$c_edad, 'Readonly'=>true));?>
                    </div>                   
                  </div>
                  <div class="form-group row" id="div_datospaciente" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Dirección ','direccion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'Digite la Dirección', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'value'=>$c_direccion, 'Readonly'=>true));?>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Teléfono','telefono', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Teléfono', 'maxlength'=>'15', 'class'=>'form-control col-sm-11 col-md-12', 'value'=>$c_telefono, 'Readonly'=>true));?>
                    </div>
                  </div>  
                  <div class="form-group row" id="div_datosIIpaciente" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Entidad de Salud ','eps_pacientes', array('class'=>'mb-0',)); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_eps_tabla('pacientes',$c_id_eps,'form-control col-sm-11 col-md-12');?>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Entidad ','entidad', array('class'=>'mb-0',)); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('entidad',$opcentidad,$c_id_entidad,'class="form-control" id="entidad" Readonly="true"');?>
                    </div>
                  </div>
                  <div class="form-group row" id="div_datosIIIpaciente" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Genero ','genero', array('class'=>'mb-0',)); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('genero', $opcgenero,$c_genero,'class="form-control" id="genero" Readonly="true"');?>
                    </div>

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Servicio ','servicio', array('class'=>'mb-0',)); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('servicio', $opcservicios,$c_servicio,'class="form-control" id="servicio" Readonly="true"');?>
                    </div>
                  </div>
                </div>  
              </div><!-- /.card-body -->
            </div><!-- /.card -->
              <br>
            <div class="card dcard">
              <div class="card-header">
                <h3 class="card-title text-125 text-primary-d2">
                  Datos de la Procedimiento
                </h3>
              </div>
                <div class="card-body px-2 pb-1">  
                  <div class="form-group row" id="div_seccion2">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha de Procedimiento ','fechaprogramacion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="pos-rel col-sm-2">
                      <?= form_input(array('type'=>'date', 'name'=>'fechaprogramacion', 'id'=>'fechaprogramacion', 'class'=>'form-control ', 'value'=>$c_fecha_Cx, 'Readonly'=>true));?>  
                          
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Hora ','horaprogramacion', array('class'=>'mb-0'));?>
                    </div>
                    <div class="col-sm-2">
                        <?= form_input(array('type'=>'time', 'name'=>'horaprogramacion', 'id'=>'horaprogramacion', 'class'=>'form-control ', 'min'=>'07:00', 'max'=>'18:00', 'value'=>'07:00', 'value'=>$c_hora_Cx, 'Readonly'=>true));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tiempo ','tiempohoras', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-1 col-xs-1">                      
                    <?= form_input(array('type'=>'text', 'name'=>'tiempohoras', 'id'=>'tiempohoras', 'placeholder'=>'HH:MM', 'class'=>'form-control', 'min'=>"0", 'max'=>"6", 'value'=>$c_tiempo, 'Readonly'=>true));?>                    
                    </div>                  
                  </div>

                  <div class="form-group row" id="div_procedimiento">                    
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Procedimiento ','procedimientos_seguimiento', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= select_procedimientos_tabla('seguimiento',$c_procedimiento,'select2 form-control');?>
                    </div>                  
                  </div>
                  
                  <div class="form-group row" id="div_cirujano" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Especialista *','cirujano_programacion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_cirujanos_tabla('programacion',$c_id_cirujano,'select2 form-control style="width: 100%"');?>
                    </div>

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tipo Anestesia','tipo_anestesia', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('tipo_anestesia', $opctipoanestesia, $c_tipoAnestesia, 'class="form-control" id="tipo_anestesia" Readonly="true"');?>                        
                    </div>                                        
                  </div>

                  <div class="form-group row" id="div_analgesiologo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Anestesiologo ','anestesiologo_programacion', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_anestesiologo_tabla('programacion',$c_id_anest,'select2 form-control');?>
                    </div> 
                  </div>                  
                </div>
              </div>             
              <br>  

              <div class="card dcard">
                <div class="card-header card-header-sm bgc-primary-d1 border-0 py-2">
                  <h5 class="card-title text-115 text-white pb-2px">Seguimientos</h5>
                </div>
                <div class="card-body px-2 pb-1"> 
                  <div class="row d-flex mx-1 mx-lg-0 btn-group">
                    <div class="col-12 col-sm-4 px-2">
                      <!-- <button type="button" class="d-style btn btn-lighter-secondary btn-h-outline-purple btn-a-outline-purple btn-a-bgc-white w-100 border-t-3 my-1 py-3" id="cancelacionQx">
                        <span  class="d-flex flex-column align-items-center" id="cancelacionQx">

                          <div class="mb-2">
                            <i class="v-n-active fas fa-window-close text-160 text-grey-m3 mr-n35"></i>
                            <i class="v-active fas fa-window-close text-200 text-purple ml-n2"></i>
                          </div>

                          <div class="font-bolder text-105 text-secondary flex-grow-1">
                            Cancelación de Cirugia                                
                          </div>
                        </span>
                      </button> -->
                    </div>
                    
                    <div class="col-12 col-sm-4 px-2">                      
                      <button type="button" class="d-style btn btn-lighter-secondary btn-h-outline-purple btn-a-outline-purple btn-a-bgc-white w-100 border-t-3 my-1 py-3" id= "seguimientoP" >
                        <span class="d-flex flex-column align-items-center" id="seguimientoP">
                          <div class="mb-2">
                            <i class="v-n-active fas fa-sync-alt text-160 text-grey-m3 mr-n35" id= "seguimientoP"></i>
                            <i class="v-active fas fa-sync-alt text-200 text-purple ml-n2" id= "seguimientoP"></i>
                          </div>
                          <div class="font-bolder text-105 text-secondary flex-grow-1" id= "seguimientoP">
                            Seguimiento a pacientes                                
                          </div>
                        </span>
                      </button>                     
                    </div>
                  </div>                  
                </div> <!-- /.card-body --> 
              </div><!-- /.card -->
              <br>             

              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="d-flex flex-column align-items-center">  
                  <?= anchor(base_url('c_seguimientocx/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded ')); ?>
                  
                </div>
              </div>
            </div><!-- /.card-body -->
            <?= form_close(); ?>
          </div><!-- /.card -->
        </div>
      </div>
    

    <div id="view-modal" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>

 
  <!-- **************************************** SEGUIMIENTO A PACIENTES **************************************** -->
    <div id="modal-seguimiento" class="modal fade modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bgc-primary-m1 brc-white">
          <h5 class="modal-title text-white" id="newModalLabel">
            Seguimiento a Pacientes 
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <?= form_open(base_url('c_seguimientocx/guardar_seguimientoqx'), array('id'=>'form_seguimientorqx', 'name'=>'form_seguimientorqx', 'class'=>'', 'autocomplete'=>'off')); ?>
            <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_cirugia));?>
            <?= form_input(array('type'=>'hidden', 'name'=>'num_llamada', 'id'=>'num_llamada', 'value'=>$c_llamadas));?>
            <?= form_input(array('type'=>'hidden', 'name'=>'estado', 'id'=>'estado', 'value'=>$c_estado));?>
            <div class="card-body px-2 pb-1">
              <div class="form-body">  
                <div class="form-group row" id="div_datospacienteLl">  
                  <div class="col-sm-2 col-form-label text-sm-left pr-0">
                      <?= form_label('Nombre Paciente ','pacienteT', array('class'=>'mb-0')); ?>
                  </div>                                           
                  <div class="col-sm-3">
                  <?= form_input(array('type'=>'text', 'name'=>'pacienteT', 'id'=>'pacienteT', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>$c_paciente));?>
                  </div>
                  <div class="col-sm-2 col-form-label text-sm-left pr-0">
                     <?= form_label('Historia Clinica ','cedulaT', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-2">
                    <?= form_input(array('type'=>'text', 'name'=>'cedulaT', 'id'=>'cedulaT', 'placeholder'=>'Digite la cedula', 'class'=>'form-control col-sm-11 col-md-12', 'value'=>$c_idpaciente));?>
                  </div> 
                </div><!-- /.form-group row-->
                <div class="form-group row" id="div_datospacienteL2">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Procedimiento ','procedimientos_seguimiento1', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-9">
                      <?= select_procedimientos_tabla('seguimiento1',$c_procedimiento,'select2 form-control');?>
                    </div>  
                 </div><!-- /.form-group row-->
                <div class="form-group row" id="div_datospacienteL2">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Teléfono','telefonoT', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'telefonoT', 'id'=>'telefonoT', 'placeholder'=>'Digite el Teléfono', 'maxlength'=>'15', 'class'=>'form-control col-sm-11 col-md-12'));?>
                  </div>   
                  
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Entidad ','entidadT', array('class'=>'mb-0',)); ?>
                  </div>
                  <div class="col-sm-3">
                    <?= form_dropdown('entidadT', $opcentidad,$c_id_entidad,'class="form-control" id="entidadT" Readonly="true"');?>
                  </div>               
                </div><!-- /.form-group row-->
                   
                <!-- Simple Sliding Tabs -->
                <div class="col-12 col-md-12 mt-4 mt-md-0">
                  <div class="card ccard">
                    <ul class="nav nav-tabs nav-tabs-simple nav-tabs-scroll border-b-1 brc-dark-l3 mx-0 mx-md-0 px-3 px-md-1 pt-2px" role="tablist">
                      <li class="nav-item mr-1">
                        <a class="nav-link active p-3 bgc-h-primary-l4 radius-0" id="home16-tab-btn" data-toggle="tab" href="#home16" role="tab" aria-controls="home16" aria-selected="true">
                          <i class="fa fa-phone text-success mr-3px"></i>
                          Primera Llamada 
                        </a>
                      </li>

                      <li class="nav-item mr-1">
                        <a class="nav-link brc-purple-m1 d-style p-3 bgc-h-purple-l4 radius-0" id="profile16-tab-btn" data-toggle="tab" href="#profile16" role="tab" aria-controls="profile16" aria-selected="false">
                          <i class="fa fa-phone text-purple mr-3px"></i>

                          <span class="d-n-active">
                              Segunda Llamada 
                          </span>
                          <span class="d-active text-purple-d1">
                              Segunda Llamada 
                          </span>
                        </a>
                      </li>                   
                    
                      <li class="nav-item mr-1">
                        <a class="nav-link brc-purple-m1 d-style p-3 bgc-h-purple-l4 radius-0" id="teceraLlamada-tab-btn" data-toggle="tab" href="#teceraLlamada" role="tab" aria-controls="teceraLlamada" aria-selected="false">
                          <i class="fa fa-phone text-purple mr-3px"></i>

                          <span class="d-n-active">
                              Tercera Llamada 
                          </span>
                          <span class="d-active text-purple-d1">
                              Tercera Llamada 
                          </span>
                        </a>
                      </li>                   
                    </ul>

                    <div class="card-body px-0 py-2">
                      <div class="tab-content tab-sliding border-0 px-0">

                  <!-- //############################## TAB PRIMERA LLAMADA ################################## //-->
                      <div class="tab-pane show active text-95 px-25" id="home16" role="tabpanel" aria-labelledby="home16-tab-btn">          
                                     
                        <div class="form-group row" id="div_sesion1">                        
                          <div class="col-sm-1 col-form-label text-sm-right pr-0">
                            <?= form_label('Fecha','fechallamada', array('class'=>'mb-0')); ?>
                          </div>
                          <div class="col-sm-2">
                            <?= form_input(array('type'=>'date', 'name'=>'fechallamada', 'id'=>'fechallamada', 'class'=>'form-control ', 'required'=>true));?>
                          </div> 
                          <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Responde?','responde1', array('class'=>'mb-0')); ?>
                          </div><!-- /.label-->
                          <div class="col-sm-2">
                            <?= form_dropdown('responde1', $opcsino,'', 'class="form-control" id="responde1"');?>
                          </div><!-- /.input-->                           
                        </div>
                        <hr>
                        <div class="form-group row" id="div_sesion1" > 
                          <table style="text-align:center;" >
                            <tr>
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                SINTOMAS 
                                </span>
                              </th>
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                SI 
                                </span>
                              </th>
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                NO 
                                </span>
                              </th>
                            </tr>  
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                 Dolor
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckdolorSi" name="ckdolorSi">
                              </td>
                                <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckdolorNo" name="ckdolorNo">
                              </td>
                           </tr>
                           <tr>
                            <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                             <span>
                               Sangrado
                             </span>
                            </td>
                            <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <input type="checkbox" class="input-lg bgc-blue" id="cksangradoSi" name="cksangradoSi">
                            </td>
                             <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <input type="checkbox" class="input-lg bgc-blue" id="cksangradoNo" name="cksangradoNo">
                            </td>
                           </tr>

                           <tr>
                            <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                             <span>
                               Otros Sintomas
                             </span>
                            </td>
                            <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <input type="checkbox" class="input-lg bgc-blue" id="ckotrosSi" name="ckotrosSi">
                            </td>
                            <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <input type="checkbox" class="input-lg bgc-blue" id="ckotrosNo" name="ckotrosNo">
                            </td>
                           </tr>

                           <tr id="div_cuales">
                            <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                             <span>
                              Cuales
                             </span>
                            </td>
                            <td colspan ="2" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <?= form_textarea(array('rows'=>'2', 'name'=>'cuales', 'id'=>'cuales', 'placeholder'=>'Digite los otros sintomas referidos', 'class'=>'form-control ', 'value'=>''));?>
                            </td>
                           </tr>

                           <tr >
                            <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                             <span>
                              Fecha de Control
                             </span>
                            </td>
                            <td colspan ="2" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <?= form_input(array('type'=>'date', 'name'=>'fecha_control', 'id'=>'fecha_control', 'class'=>'form-control col-sm-11 col-md-12'));?>
                            </td>
                           </tr>

                           <tr>
                            <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                             <span>
                              Observaciones
                             </span>
                            </td>
                            <td colspan ="2" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                              <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                            </td>
                           </tr>
                           <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                               INFORMACIÓN DADA POR
                               </span>
                              </td>
                              <td colspan ="2" class="border-1 bgc-white brc-white-tp10 shadow-sm" width="250">
                                 <?= form_dropdown('informo', $opcinformo,'', 'class="form-control" id="informo"');?>
                              </td>
                            </tr>

                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                Nombre Quien informó
                               </span>
                              </td>
                              <td colspan ="2" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <?= form_input(array('type'=>'text', 'name'=>'familiar', 'id'=>'familiar', 'placeholder'=>'Nombres completos de quien informó (aplica si no es el paciente)', 'class'=>'form-control col-sm-11 col-md-12'));?>
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                Funcionario Que Realizó la LLamada
                               </span>
                              </td>
                              <td colspan ="2" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                 <?= select_auxiliares_tabla('seguimiento','','select form-control');?>                                
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div><!-- /.tab-pane--> 

                <!-- //################################ TAB SEGUNDA LLAMADA ############################## //-->
                      <div class="tab-pane text-95 px-25" id="profile16" role="tabpanel" aria-labelledby="profile16-tab-btn">
                        <div class="form-group row" id="div_sesion2_1">                        
                          <div class="col-sm-1 col-form-label text-sm-right pr-0">
                            <?= form_label('Fecha','fechallamada2', array('class'=>'mb-0')); ?>
                          </div>
                          <div class="col-sm-2">
                            <?= form_input(array('type'=>'date', 'name'=>'fechallamada2', 'id'=>'fechallamada2', 'class'=>'form-control ', 'required'=>true));?>
                          </div> 
                          <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Responde?','responde2', array('class'=>'mb-0')); ?>
                          </div><!-- /.label-->
                          <div class="col-sm-2">
                            <?= form_dropdown('responde2', $opcsino,'', 'class="form-control" id="responde2"');?>
                          </div><!-- /.input-->                           
                        </div>
                        <hr>
                        <div class="form-group row" id="div_sesion2_2"> 
                          <table style="text-align:center;">                            
                            <tr>
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                SIGNOS / SINTOMAS 
                                </span>
                              </th>
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                SI 
                                </span>
                              </th >
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                NO 
                                </span>
                              </th>
                              <th class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                                <span>
                                NO APLICA 
                                </span>
                              </th>
                            </tr>  
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">                              
                              <span>
                                Finalizo Medicamentos?
                              </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckFmedicamentosSi" name="ckFmedicamentosSi">
                              </td>

                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckFmedicamentosNo" name="ckFmedicamentosNo">
                              </td>

                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckFmedicamentosNoAp" name="ckFmedicamentosNoAp">
                              </td>

                            </tr>
                            <tr>
                              <td colspan= "4" class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="550">
                                SIGNOS DE INFECCIÓN
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                              <span>
                                Calor
                              </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckcalorSi" name="ckcalorSi">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckcalorNo" name="ckcalorNo">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                               <span>
                                 Rubor
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckruborSi" name="ckruborSi">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckruborNo" name="ckruborNo">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm" width="250">
                               <span>
                                 Inflamación
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckinflamacionSi" name="ckinflamacionSi">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckinflamacionNo" name="ckinflamacionNo">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                 Secreción
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="cksecrecionSi" name="cksecrecionSi">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="cksecrecionNo" name="cksecrecionNo">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                 Otros signos y/o sintomas
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckotrosSSi" name="ckotrosSSi">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckotrosSNo" name="ckotrosSNo">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                              </td>
                            </tr>

                            <tr id="cuales">
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                Cuales
                               </span>
                              </td>
                              <td colspan="3" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <?= form_textarea(array('rows'=>'2', 'name'=>'cuales2', 'id'=>'cuales2', 'placeholder'=>'Digite los otros signos y/o sintomas', 'class'=>'form-control ', 'value'=>''));?>
                              </td>
                            </tr>

                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                 Finalizó controles?
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckFcontrolesSi" name="ckFcontrolesSi">
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                                <input type="checkbox" class="input-lg bgc-blue" id="ckFcontrolesNo" name="ckFcontrolesNo">
                              
                              <td class="border-1 bgc-white brc-black-tp10" width="250">
                              </td>
                            </tr>

                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                Observaciones
                               </span>
                              </td>
                              <td colspan ="3" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="550">
                                <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones2', 'id'=>'observaciones2', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                              </td>
                            </tr>

                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                               INFORMACIÓN DADA POR
                               </span>
                              </td>
                              <td colspan ="3" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                  <?= form_dropdown('informo2', $opcinformo,'', 'class="form-control" id="informo2"');?>
                              </td>
                            </tr>

                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                 Nombre Quien informó
                               </span>
                              </td>
                              <td colspan="3" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <?= form_input(array('type'=>'text', 'name'=>'familiar2', 'id'=>'familiar2', 'placeholder'=>'Nombres completos de quien informó (aplica si no es el paciente)', 'class'=>'form-control col-sm-11 col-md-12'));?>
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                Funcionario Que Realizó la LLamada
                               </span>
                              </td>
                              <td colspan="3" class="border-1 bgc-white brc-black-tp10 shadow-sm" width="250">
                                <?= select_auxiliares_tabla('seguimientoSL','','select form-control');?>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div><!-- /.tab-pane-->

                      <!-- //############################## TAB TERCERA LLAMADA ################################## //-->
                      <div class="tab-pane show active text-95 px-25" id="teceraLlamada" role="tabpanel" aria-labelledby="teceraLlamada-tab-btn">          
                                     
                        <div class="form-group row" id="div_sesion1">                        
                          <div class="col-sm-1 col-form-label text-sm-right pr-0">
                            <?= form_label('Fecha','fechallamada3', array('class'=>'mb-0')); ?>
                          </div>
                          <div class="col-sm-2">
                            <?= form_input(array('type'=>'date', 'name'=>'fechallamada3', 'id'=>'fechallamada3', 'class'=>'form-control ', 'required'=>true));?>
                          </div> 
                          <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Responde?','responde3', array('class'=>'mb-0')); ?>
                          </div><!-- /.label-->
                          <div class="col-sm-2">
                            <?= form_dropdown('responde3', $opcsino,'', 'class="form-control" id="responde3"');?>
                          </div><!-- /.input-->                           
                        </div>
                        <hr>
                        <div class="form-group row" id="div_sesion1"> 
                          <table style="text-align:center;">
                            <tr> 
                              <th colspan ="2" class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm">
                                <span>
                                OBSERVACIONES DE LA TERCERA LLAMADA 
                                </span>
                              </th> 
                            </tr>
                            <tr>                            
                              <td class="order-1 bgc-grey text-white brc-white-tp10 shadow-sm" >
                               <span>
                                Observaciones
                               </span>
                              </td>
                             
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="650">
                                <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones3', 'id'=>'observaciones3', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control ', 'value'=>''));?>
                              </td>                                
                             </tr> 

                             <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                               INFORMACIÓN DADA POR
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="650">
                                  <?= form_dropdown('informoT3', $opcinformo,'', 'class="form-control" id="informoT3"');?>
                              </td>
                            </tr>

                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                 Nombre Quien informó
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="650">
                                <?= form_input(array('type'=>'text', 'name'=>'familiarT3', 'id'=>'familiarT3', 'placeholder'=>'Nombres completos de quien informó (aplica si no es el paciente)', 'class'=>'form-control col-sm-11 col-md-12'));?>
                              </td>
                            </tr>
                            <tr>
                              <td class="border-1 bgc-grey text-white brc-white-tp10 shadow-sm"  width="250">
                               <span>
                                Funcionario Que Realizó la LLamada 
                               </span>
                              </td>
                              <td class="border-1 bgc-white brc-black-tp10 shadow-sm" width="650">
                                <?= select_auxiliares_tabla('seguimientoTL','','select form-control');?>
                              
                              </td>
                            </tr>                          
                          </table>

                        </div>
                      </div><!-- /.tab-pane-->                       
                    </div><!-- /.tab-content-->  
                    
                    <hr>
                    <div class="form-group row" id="div_sesion2_1">                        
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cierre Seguimiento?','cierre', array('class'=>'mb-0')); ?>
                      </div><!-- /.label-->
                      <div class="col-sm-2">
                        <?= form_dropdown('cierre', $opcsino,'', 'class="form-control" id="cierre"');?>
                      </div><!-- /.input-->                           
                    </div>
                    <hr>
                  </div><!-- /.card-body-->                     
                </div><!-- /.card-->                
              </div><!-- /.col-->  
              <div class="modal-footer">
                <button type="button" class="btn btn-primary " id="btn_guardarSeguimiento" name="btn_guardarSeguimiento">
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

    </div><!-- /.card -->

