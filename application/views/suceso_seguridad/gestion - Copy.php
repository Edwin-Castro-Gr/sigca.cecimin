<?php
  //echo $id;
  $opciones = array(
    '0' => 'Recibida',
    '1' => 'Revisada',
    '2' => 'Gestionada',
    '3' => 'Cerrada'
  );

  $opc_facContAmb = array(
    '' => 'Seleccione una opción',
    '1' => 'Personal suficiente', 
    '2' => 'Mezcla de habilidades', 
    '3' => 'Carga de Trabajo ',
    '4' => 'Patrón de turnos',
    '5' => 'Diseño Disponibilidad y mantenimiento de equipos',
    '6' => 'Soporte administrativo y gerencial Clima',
    '7' => 'Laboral Ambiente físico (luz, espacio, ruido)',
  );

  $opc_facContEqui = array(
    '' => 'Seleccione una opción',
    '1' => 'Comunicación verbal y escrita ', 
    '2' => 'Supervisión y disponibilidad de soporte'
  );

  $opc_facConPac = array(
    '' => 'Seleccione una opción',
    '1' => 'Complejidad y Gravedad', 
    '2' => 'Lenguaje y comunicación', 
    '3' => 'Personalidad y Factores Sociales'
  );

  $opc_facContInd= array(
    '' => 'Seleccione una opción',
    '1' => 'Conocimiento, habilidades y competencia ', 
    '2' => 'Salud Física y Mental'
  );
           
  $opc_facContTec = array(
    '' => 'Seleccione una opción',
    '1' => 'Diseño de la tarea y claridad de la estructura', 
    '2' => 'Disponibilidad y uso de protocolos', 
    '3' => 'Disponibilidad y confiabilidad de las pruebas diagnósticas',
    '4' => 'Ayudas para toma de decisiones'
  );

  $facConGer= array(
    '' => 'Seleccione una opción',
    '1' => 'Recursos y limitaciones financieras', 
    '2' => 'Estructura Organizacional', 
    '3' => 'Políticas, estándares y metas',
    '4' => 'Prioridades y Cultura Organizacional'
  );

  $opc_facContOrg= array(
    '' => 'Seleccione una opción',
    '1' => 'Económico y regulatorio', 
    '2' => 'Contactos externos'
  );

  $opcionesSN= array(
    '' => 'Seleccione una opción',
    '1' => 'Si',
    '2' => 'No'
  );

  $opc_gradoL= array(
    '' => 'Seleccione una opción',
    '1' => 'Prevenible',
    '2' => 'No Prevenible'
  );

  $opc_complicacion = array(
    '' => 'Seleccione una opción',
    '1' => 'Anestesica',
    '2' => 'Quirurgica',
    '3' => 'Otra'
  );

  $opc_clasificacion = array(
    '' => 'Seleccione una opción',
    '1' => 'Incidente',
    '2' => 'Complicación',
    '3' => 'Evento Adverso',
    '4' => 'No E-I-NI-C',
    '5' => 'Acc. Riesgo Biologico',
    '6' => 'Repetido'
  );

  $opc_entidad = array(
    '' => 'Seleccione una Opción',
    '1' => 'Colsanitas',
    '2' => 'Medisanitas',
    '3' => 'EPS Sanitas',  
    '4' => 'ARL Sura',
    '5' => 'Seguros Bolivar',
    '6' => 'Unisalud',
    '7' => 'Particular',
    '0' => 'Otra'
  );
$motivo = array(
    '' => 'Seleccione una Opción',
    '0' => 'Felicitaciones',  
    '1' => 'Sugerencias',
    '2' => 'Queja',
    '3' => 'Reclamo', 
    '4' => 'Solicitudes' 
  );

  
$servicio = array(
  '' => 'Seleccione una Opción',
  '1' => 'Sala de Procedimientos',
  '2' => 'Procedimientos Menores',
  '3' => 'Consulta de Ortopedia',
  '4' => 'Radiología',
  '5' => 'Toma de Muestras',
  '6' => 'Espirometría',
  '7' => 'Audiometría',
  '8' => 'Electromiografía',
  '9' => 'Oncología',
  '10' => 'Quimioterapia',
  '11' => 'Administración de Medicamentos',
  '12' => 'Odontologia',
  '13' => 'Otro'
);

  $cargoReportante = array(
  '' => 'Seleccione una Opción',
  '0' => 'Enfermero Jefe',
  '1' => 'Auxiliar de Enfermería',
  '2' => 'Instrumentadora Quirúrgica',
  '3' => 'Médico Cirujano',
  '5' => 'Médico Anestesiólogo',
  '6' => 'Médico Institucional',
  '7' => 'Odontólogo',
  '8' => 'Auxiliar de Odontología',
  '9' => 'Administrativo',
  '10' => 'Coordinador',
  '11' =>'Otro'


);

  // Opcopnes select tipos de gestion
$t_gestion = array(
  '' => 'Seleccione una Opción',
  '1' => 'Tramitada por MP',
  '2' => 'Administrativa',
  '3' => 'Repetida'
);

?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="gestion">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Gestión de Sucesos de Seguridad
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('/rep_suceso_seguridad/guardar_gestion'), array('id'=>'form_gestion', 'name'=>'form_gestion', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_suceso));?>

                <div class="form-body " style=" justify-content:flex-start;" >

                  <div class="form-group row" id="div_motivo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Cargo Reportante *','cargo', array('class'=>'mb-0')); ?>
                    </div>

                    <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'cargo', 'id'=>'cargo', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_cargo));?>
                    </div> 

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Servicio','servicio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'servicio', 'id'=>'servicio', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_servicio));?>
                    </div> 
                  </div>

                  <div class="form-group row" id="div_contacto">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Nombre del paciente', 'nombrePaciente', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'nombrePaciente', 'id'=>'nombrePaciente', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_paciente));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Documento Identidad','identidad', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'identidad', 'id'=>'identidad', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true, 'value'=>$c_identidad_paciente));?>
                    </div>
                  </div>
                    <div class="form-group row" id="div_datoscontacto1">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Novedad asociada a: ', 'causaNovedad', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'causaNovedad', 'id'=>'causaNovedad', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'readonly'=>true,'value'=>$c_novedad_asociada));?>
                      </div>
                      
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Informó al Jefe Inmediato: ', 'informoJ', array('class' => 'mb-0')); ?>
                      </div>
                      <div class="col-sm-2">
                        <!-- Selector de lista -->
                        <?= form_dropdown('informoJ', $opcionesSN, $c_informo_jefe , 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="informoJ" readonly="true"'); ?>
                      </div>
                    </div>
                    <div class="form-group row" id="DatosMedicamentos">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Datos Medicamento','datosM', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'4', 'name'=>'datosM', 'id'=>'datosM', 'class'=>'form-control w-100', 'readonly'=>true, 'value'=>$c_datos_medicamento));?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Datos Dispositivo','datosD', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'4', 'name'=>'datosD', 'id'=>'datosD', 'class'=>'form-control w-100', 'readonly'=>true, 'value'=>$c_datos_dispositivos));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_programacion">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              Analisis Inicial
                          </span>
                        </div>
                          <div class="card-body"> 
                            <div class="form-group row" id="div_datosgestion1">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Clasificación Inicial','clasificacionI', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('clasificacionI', $opc_clasificacion,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="clasificacionI"');?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Fecha Analisis','fechaA', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                              <?= form_input(array('type'=>'date', 'name'=>'fechaA', 'id'=>'fechaA', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase'));?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion1">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Investigación del Suceso','investigacion', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'4', 'name'=>'investigacion', 'id'=>'investigacion', 'class'=>'form-control w-100',  'value'=>''));?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Conclusiones Investigación','conclusiones', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_textarea(array('rows'=>'4', 'name'=>'conclusiones', 'id'=>'conclusiones', 'class'=>'form-control w-100',  'value'=>''));?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion2">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Acciones Inseguras Identificadas','accionesI', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'4', 'name'=>'accionesI', 'id'=>'accionesI', 'class'=>'form-control w-100',  'value'=>''));?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Factores Contributivos Ambientales','facContAmb', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContAmb', $opc_facContAmb,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContAmb"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion3">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Equipo de Trabajo','facContEqui', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContEqui', $opc_facContEqui,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContEqui"');?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Individuo','facContInd', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContInd', $opc_facContInd,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContInd"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion4">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Paciente','facConPac', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facConPac', $opc_facConPac,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facConPac"');?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Tareas y Tecnología','facContTec', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContTec', $opc_facContTec,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContTec"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion5">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Organización y Gerencia','facConGer', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facConGer', $facConGer,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facConGer"');?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Contexto Organizacional','facContOrg', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContOrg', $opc_facContOrg,'', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContOrg"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion6">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Produjo Daños al Paciente: ', 'DanosP', array('class' => 'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <!-- Selector de lista -->
                                <?= form_dropdown('DanosP', $opcionesSN,'', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="DanosP" required="required"'); ?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('El Suceso era prevenible: ', 'prevenible', array('class' => 'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <!-- Selector de lista -->
                                <?= form_dropdown('prevenible', $opcionesSN,'', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="prevenible" required="required"'); ?>
                              </div>
                            </div>
                            <div class="form-group row" id="div_datosgestion6">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"');?>
                              </div>
                            </div>                                       
                            
                          </div><!-- /.card-body -->
                      </div><!-- /.dcard -->
                    </div><!-- /.card --> 
                    <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                      <div class="offset-md-3 col-md-9 text-nowrap">
                        <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_gestion', 'name'=>'btn_guardar_gestion', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                        <?= anchor(base_url('rep_suceso_seguridad/reportes'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                      </div>
                    </div>
                </div><!-- /.form-body -->
              <?= form_close(); ?>
            </div><!-- /.car-body-->
          </div> <!-- /.card-->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div>
