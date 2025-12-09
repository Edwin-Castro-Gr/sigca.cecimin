<?php
  //echo $id;
  $opciones = array(
    '0' => 'Recibida',
    '1' => 'Analizada',
    '2' => 'En Seguimiento',
    '3' => 'Cerrada'
  );

  $opc_facContAmb = array(
    '' => 'Seleccione una opción',
    '1' => 'Personal suficiente', 
    '2' => 'Mezcla de habilidades', 
    '3' => 'Carga de Trabajo ',
    '4' => 'Patrón de turnos',
    '5' => 'Diseño',
    '6' => 'Disponibilidad y mantenimiento de equipos',
    '7' => 'Soporte administrativo y gerencial',
    '8' => 'Clima Laboral',
    '9' => 'Ambiente físico (luz, espacio, ruido)'
  );

  $opc_facContEqui = array(
    '' => 'Seleccione una opción',
    '1' => 'Comunicación verbal y escrita ', 
    '2' => 'Supervisión y disponibilidad de soporte'
  );

  $opc_facConPac = array(
    '' => 'Seleccione una opción',
    '1' => 'Complejidad y Gravedad', 
    '2' => 'Lenguaje y Comunicación', 
    '3' => 'Personalidad y Factores Sociales'
  );

  $opc_facContInd= array(
    '' => 'Seleccione una opción',
    '1' => 'Conocimiento',
    '2' => 'Habilidades y competencia ',
    '3' => 'Salud Física y Mental'
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
    '' => 'Seleccione Si/No',
    '1' => 'Si',
    '2' => 'No'
  );
  $opcionesCSN= array(
    '' => 'Seleccione Si/No',
    '1' => 'Si',
    '2' => 'No'
  );

  $opc_sucesoeraP= array(
    '' => 'Seleccione una opción',
    '1' => 'Prevenible',
    '2' => 'No Prevenible'
  );

  $opc_glesion= array(
    '' => 'Seleccione una opción',
    '0' => 'Leve',
    '1' => 'Moderada',
    '2' => 'Severa'
  );

  $opc_clasificacion = array(
    '' => 'Seleccione una opción',
    '1' => 'Incidente',
    '2' => 'Complicación',
    '3' => 'Evento Adverso',
    '4' => 'No E-I-NI-C',
    '5' => 'Repetido',
    '6' => 'Infección Asociada al Cuidado de la Salud'    
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
    '99' => 'Otro'
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

  $opc_complicacion = array(
    '' => 'Seleccione una Opción',

    '1' => 'Anestésica',
    '2' => 'Otra',
    '3' => 'No Aplica'
  );


  $opttrazadores = array(
    '' => 'Seleccione un Trazador',
    '1' => 'Relacionada a cuidados',
    '2' => 'Relacionada a medicamentos',
    '3' => 'Relacionada con IACS (infecciones asociadas al cuidado de la salud)',
    '4' => 'Relacionada con procedimientos invasivos',
    '5' => 'Relacionada con diagnósticos y/o informes',
    '6' => 'Relacionado con tecnovigilancia',
    '7' => 'Otros',
    '0' =>'No plica'
  );

  $optRelCuidado = array(
    '' => 'Seleccione una opción',
    '1' =>'Paciente con úlcera por presión',
    '2' =>'Paciente con paro cardiaco o respiratorio',
    '3' =>'Caída intrainstitucional',
    '4' =>'Traslado de paciente',
    '5' =>'Paciente con broncoaspiración intrainstitucional',
    '6' =>'Paciente con TEP o TVP',
    '0' =>'No aplica para este Grupo'
  );

  // Opcopnes select tipos de gestion
  $t_gestion = array(
    '' => 'Seleccione una opción',
    '1' => 'Tramitada por MP',
    '2' => 'Administrativa',
    '3' => 'Repetida'
  );

  $optRelMedicam = array(
    '' => 'Seleccione una opción',
    '1' => 'Reacción adversa a medicamentos',
    '2' => 'Sospecha de falla terapéutica',
    '3' => 'Problemas relacionados al uso de medicamento: Prescripción',
    '4' => 'Problemas relacionados al uso de medicamento: Dispensación ',
    '5' => 'Problemas relacionados al uso de Medicamentos: Administración',
    '6' => 'Problemas relacionados al uso de medicamentos: Monitorización y/o seguimiento',
    '0' => 'No aplica para este Grupo'

    );

    $optrelTecnov = array(
      '' => 'Seleccione una opción',
      '1' => 'Relacionados al Uso del Dispositivo Médico',
      '2' => 'Reacción alérgica a dispositivo médico',
      '3' => 'Relacionados a la calidad del dispositivo Medico ',
      '4' => 'Relacionado al mantenimiento o logística de Equipo Biomedico',
      '5' => 'Relacionado al funcionamiento del Equipo Biomedico',
      '0' => 'No aplica para este grupo'
    );

    $optrelIACS = array(
      '' => 'No Aplica',
      '1' => 'Infección de sitio quirúrgico', 
      '2' => 'Infección del torrente sanguíneo asociado a catéter central o subcutáneo', 
      '3' => 'Infección arterial o venosa',
      '0' => 'No aplica para este grupo'
    );

    $optRelprocInva = array(
      '' => 'Seleccione una opción',
      '1' => 'Cancelación de cirugías o procedimientos atribuida a la organización', 
      '2' => 'Cirugía o procedimiento en parte equivocada o en paciente equivocado',
      '3' => 'Retención de cuerpos extraños en POP',
      '4' => 'Paciente con Reintervención',
      '5' => 'Lesión iatrogénica peri operatoria o intraprocedimiento',
      '6' => 'Demora en inicio de cirugía y/o procedimiento',
      '7' => 'Lesiones asociadas a la venopunción',
      '0' => 'No aplica para este grupo '
    );

    $optreldiagnosticos = array(
      '' => 'Seleccione una opción',
      '1' => 'Entrega intercambio de reportes',
      '2' => 'Relacionados con la recolección, transporte y/o manejo de muestras',
      '3' => 'Entrega e resultados o informes errados que generan conductas terapéuticas inadecuadas',
      '4' => 'Déficit de examen físico o interpretación de pruebas diagnosticas',
      '5' => 'Relacionado con la gestión de valor critico',
      '0' => 'No aplica para este grupo', 
    );  

    $optrelOtros = array(
      '' => 'Seleccione una opción',
      '1' => 'Relacionados con equipos de apoyo o infraestructura',
      '2' => 'Reingreso por posible falla en la atención antes de 30 días',
      '3' => 'Identificación del paciente errado o incompleto',
      '4' => 'Relacionados con historia clínicas o tecnología informática',
      '5' => 'Relacionados con trámites administrativos que afectan la seguridad asistencial',
      '6' => 'Relacionado con reactivovigilancia',
      '7' => 'La causa no se encuentra en ninguno de los grupos',
      '0' => 'No aplica a este grupo '

    );

    $opcguias = array(
      '' => 'Seleccione una opción',
      '1' => 'Detectar, prevenir y reducir infecciones asociadas atención en salud',
      '2' => 'Garantizar la correcta identificación del paciente y las muestras de laboratorio',
      '3' => 'Gestionar y desarrollar la adecuada comunicación entre las personas que atienden y cuidan a los pacientes',
      '4' => 'Prevenir las ulceras por presión',
      '5' => 'Procesos para la prevención y reducción de la frecuencia de caídas',
      '6' => 'Mejorar la seguridad en a la utilización de medicamentos',
      '7' => 'Mejorar la seguridad en los procedimientos quirúrgicos',
      '0' => 'No aplica a ninguna guía de buena practica'

    );
    $opcreporteCont = array(
      '' => 'Seleccione una opción',
      '1' => 'Farmacovigilancia',
      '2' => 'Tecnovigilancia',
      '3' => 'Reactovigilancia'
     );


    $opctipo = array(
      '' => 'Seleccione una opción',
      '1' => 'Acción correctiva',
      '2' => 'Acción Preventiva',
      '3' => 'Oportunidad de mejora'
    );

    $opcComplimiento= array(
      '' => 'Seleccione una opción',
      '0'=>'Completo', 
      '1'=>'No Iniciado', 
      '2'=>'Sin Análisis', 
      '3'=>'No dio lugar a acción', 
      '4'=>'Avanzado',
      '5'=>'Iniciado'
    );
?>

  <input type="hidden" name="opc_pag" id="opc_pag" value="seguimiento">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Revisión de Sucesos de Seguridad
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('/rep_suceso_seguridad/guardar_segumiento'), array('id'=>'form_segumiento', 'name'=>'form_segumiento', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_suceso));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'usuario_analiza', 'id'=>'usuario_analiza', 'value'=>$c_Usuario_analiza));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'estado_actual', 'id'=>'estado_actual', 'value'=>$c_estado));?>


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
                  </div>
                  <div class="form-group row" id="DatosDispositivo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Datos Dispositivo','datosD', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= form_textarea(array('rows'=>'4', 'name'=>'datosD', 'id'=>'datosD', 'class'=>'form-control w-100', 'readonly'=>true, 'value'=>$c_datos_dispositivos));?>
                    </div>
                  </div>

                  <div class="form-group row" id="DatosDescripcion">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Descripción Noverdad','descripcionN', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= form_textarea(array('rows'=>'4', 'name'=>'descripcionN', 'id'=>'descripcionN', 'class'=>'form-control w-100', 'readonly'=>true, 'value'=>$c_descripcion_novedad));?>
                    </div>
                  </div>

                  <div class="form-group row" id="DatosDescripcion">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Manejo Realizado','manejoR', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= form_textarea(array('rows'=>'4', 'name'=>'manejoR', 'id'=>'manejoR', 'class'=>'form-control w-100', 'readonly'=>true, 'value'=>$c_manejo_novedad));?>
                    </div>
                  </div>

                    <div class="form-group row" id="div_programacion">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              ANALISIS DEL CASO
                          </span>
                        </div>
                          <div class="card-body"> 
                            <div class="form-group row" id="div_datosgestion1">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Fecha Analisis','fechaA', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                              <?= form_input(array('type'=>'date', 'name'=>'fechaA', 'id'=>'fechaA', 'class'=>'form-control col-sm-9 col-md-12 UpperCase',  'value'=>$c_fecha_analisis));?>
                              </div>

                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Clasificación Inicial','clasificacionI', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('clasificacionI', $opc_clasificacion,$c_clasificacion, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="clasificacionI"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion0">                              
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Grado de Lesión','glesion', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('glesion', $opc_glesion, $c_grado_lesion, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="glesion"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion01">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Gravedad del Caso','gcaso', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('gcaso',$opc_glesion,$c_gravedad_caso, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="gcaso"');?>
                              </div>
                               <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Origen de la Complicación','ocomplicacion', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('ocomplicacion',$opc_complicacion,$c_origen_complicacion, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="ocomplicacion"');?>
                              </div>   
                            </div>

                            <div class="form-group row" id="div_datosgestion1">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Investigación del Suceso','investigacion', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'4', 'name'=>'investigacion', 'id'=>'investigacion', 'class'=>'form-control w-100',  'value'=>$c_investigacion));?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Conclusiones Investigación','conclusiones', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_textarea(array('rows'=>'4', 'name'=>'conclusiones', 'id'=>'conclusiones', 'class'=>'form-control w-100',  'value'=>$c_concluciones));?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion2">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Acciones Inseguras Identificadas','accionesI', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                              <?= form_textarea(array('rows'=>'4', 'name'=>'accionesI', 'id'=>'accionesI', 'class'=>'form-control w-100',  'value'=>$c_acciones_inseguras));?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Factores Contributivos Ambientales','facContAmb', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContAmb', $opc_facContAmb,$c_fact_ambientales, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContAmb"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion3">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Equipo de Trabajo','facContEqui', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContEqui', $opc_facContEqui,$c_fact_equipot, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContEqui"');?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Individuo','facContInd', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContInd', $opc_facContInd,$c_fact_individuo, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContInd"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion4">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Paciente','facConPac', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facConPac', $opc_facConPac,$c_fact_paciente, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facConPac"');?>
                              </div>
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Factores Contributivos Tareas y Tecnología','facContTec', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= form_dropdown('facContTec', $opc_facContTec,$c_fact_Tecnologia, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="facContTec"');?>
                              </div>
                            </div>

                            <div class="form-group row" id="div_datosgestion5">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Justificación Factores Contributivos','justificacionfc', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-10">
                                 <?= form_textarea(array('rows'=>'4', 'name'=>'justificacionfc', 'id'=>'justificacionfc', 'class'=>'form-control w-100', 'value'=>$c_justificacion));?>
                              </div>                             
                            </div>
                          </div><!-- /.card-body -->
                      </div><!-- /.dcard -->
                    </div><!-- /.card --> 


                    <div class="form-group row" id="div_programacion">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              <b> CLASIFICACIÓN DE TRAZADORES</b>
                          </span>
                          
                        </div>

                        <div class="card-body">
                          <div class="form-group row" id="div_trazadores">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Clasificación de Trazadores','trazadores', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_dropdown('trazadores[]', $opttrazadores, $c_trazadores, 'class="chosen-select radius-round w-100 text-grey brc-h-info-m2 form-control", id="trazadores", multiple="multiple"');?>
                            </div>
                          </div>
                          <hr>  

                          <div class="form-group row" id="div_trazadores1"> 
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Relacionados con el Cuidado','relCuidado', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('relCuidado', $optRelCuidado, $c_relCuidado, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="relCuidado"');?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_trazadores2"> 
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Relacionados con Medicamentos','RelMedicam', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('RelMedicam', $optRelMedicam, $c_RelMedicam, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="RelMedicam"');?>
                            </div>
                          </div>


                          <div class="form-group row" id="div_trazadores3">
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Relacionados con IACS','relIACS', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('relIACS', $optrelIACS, $c_relIACS, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="relIACS"');?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_trazadores4"> 
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Relacionados con Procedimientos invasivos','RelprocInva', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('RelprocInva', $optRelprocInva, $c_RelprocInva, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="RelprocInva"');?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_trazadores5"> 
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Relacionados con Diagnósticos','reldiagnosticos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('reldiagnosticos', $optreldiagnosticos, $c_reldiagnosticos, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="reldiagnosticos"');?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_trazadores6"> 
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Relacionados Tecnovigilancia','relTecnov', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('relTecnov', $optrelTecnov, $c_relTecnov, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="relTecnov"');?>
                            </div>
                          </div>                        

                          <div class="form-group row" id="div_trazadores7"> 
                            <div class="col-sm-4 col-form-label text-sm-right pr-0">
                              <?= form_label('Otros','relOtros', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-8">
                              <?= form_dropdown('relOtros', $optrelOtros, $c_relOtros, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="relOtros"');?>
                            </div>                          
                          </div>
                          <hr>  
                          <br>  
                          <div class="form-group row" id="div_daños-prevenible"> 
                           <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Produjo Daños al Paciente: ', 'DanosP', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <!-- Selector de lista -->
                              <?= form_dropdown('DanosP', $opcionesSN, $c_danos_paciente, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="DanosP" required="required"'); ?>
                            </div>
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('El Suceso era prevenible:', 'prevenible2', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-2">
                              <!-- Selector de lista -->
                              <?= form_dropdown('prevenible', $opcionesSN, $c_prevenible, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="prevenible"'); ?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_guias"> 
                            <div class="col-sm-5 col-form-label text-sm-right pr-0">
                              <?= form_label('Guías de Buenas Prácticas con las que se relaciona el suceso: ', 'guias', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-7">
                              <!-- Selector de lista -->
                              <?= form_dropdown('guias', $opcguias, $c_guias, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="guias"'); ?>
                            </div>
                          </div>


                        <div class="form-group row" id="div_reporte"> 
                          <div class="col-sm-4 col-form-label text-sm-right pr-0">
                            <?= form_label('Requiere Reporte ante un Ente de Control?', 'enteControl', array('class' => 'mb-0')); ?>
                          </div>
                          <div class="col-sm-2">
                            <!-- Selector de lista -->
                            <?= form_dropdown('enteControl', $opcionesSN, $c_enteControl, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="enteControl"'); ?>
                          </div>
                          <div class="col-sm-2 col-form-label text-sm-right pr-0" id="lblreporteCont">
                            <?= form_label('Cual Reporte Aplica?', 'reporteCont', array('class' => 'mb-0')); ?>
                          </div>
                          <div class="col-sm-3" id="inputreporteCont">
                            <!-- Selector de lista -->
                            <?= form_dropdown('reporteCont', $opcreporteCont, $c_reporteCont, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="reporteCont"'); ?>
                          </div>
                        </div>  

                        <div class="form-group row" id="div_fechaRep"> 
                          <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Fecha Reporte','fechaRep', array('class'=>'mb-0')); ?>
                          </div>
                          <div class="col-sm-2">
                          <?= form_input(array('type'=>'date', 'name'=>'fechaRep', 'id'=>'fechaRep', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12','value'=>$c_fechaRep));?>
                          </div>
                        </div> 

                        <div class="form-group row" id="div_fechaComite"> 
                          <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Fecha Presentación Cómite','fechaComite', array('class'=>'mb-0')); ?>
                          </div>
                          <div class="col-sm-2">
                          <?= form_input(array('type'=>'date', 'name'=>'fechaComite', 'id'=>'fechaComite', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12','value'=>$c_fechaComite));?>
                          </div>

                          <div class="col-sm-2 col-form-label text-sm-right pr-0" id="lblaccionMejora">
                            <?= form_label('Requiere Accion de Mejora?', 'accionMejora', array('class' => 'mb-0')); ?>
                          </div>
                          <div class="col-sm-3" id="inputAccionMejora">
                            <!-- Selector de lista -->
                            <?= form_dropdown('accionMejora',$opcionesSN, $c_accionMejora, 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="accionMejora"'); ?>
                          </div>
                          <div class="col-sm-3" id="div_btntAccion_Mejora">
                            <!-- <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btnAccionMejora">
                              <i class="fa fa-edit mr-1"></i>
                              <span class="d-sm-none d-md-inline" id="btnAccionMejora">Acción Mejora</span>
                            </button> -->
                          </div>
                        </div> 

                      </div><!-- /.card-body -->
                    </div><!-- /.dcard -->
                  </div><!-- /.card -->

                    <div class="form-group row" id="div_acciones">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              <b> ACCIONES DE MEJORA</b>
                          </span>                        
                        </div>

                        <div class="card-body" id="card-accionM"> 
                          <table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                            <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                              <tr>                              
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Tipo Acción</th>
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Descripción</th>
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Coordinador</th>
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha ejecución</th>
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
                              </tr>
                            </thead>
                            <tbody class="post-acciones" id="post-acciones">
                              <?= form_input(array('type' => 'hidden', 'name' => 'cantAcciones', 'id' => 'cantAcciones', 'value' =>'0')); ?>

                            </tbody> 
                          </table> 
                        </div><!-- /.card-body -->
                      </div><!-- /.dcard -->
                    </div><!-- /.card -->


                    <div class="form-group row" id="div_fechaComite"> 
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Barrera de Seguridad','barrera', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_textarea(array('rows'=>'4', 'name'=>'barrera', 'id'=>'barrera', 'class'=>'form-control w-100' , 'value'=>$c_barrera));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_fechaComite"> 
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Grupo que Realizo el analisis','grupoRa', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'grupoRa', 'id'=>'grupoRa', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase', 'value'=>$c_grupo));?>
                      </div>
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                          <?= form_label('Clasificación Final','clasificacionF', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-3">
                          <?= form_dropdown('clasificacionF', $opc_clasificacion, $c_clasificacionF, 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="clasificacionF"');?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_acciones">
                      <div class="card dcard col-sm-12">
                        <div class="card-header">
                          <span class="card-title text-125">
                              <b> SEGUIMIENTOS</b>
                          </span>  

                          <div class="mb-2 mb-sm-0" id="divbtnnuevoSegumiento">
                            <?= form_input(array('type'=>'hidden', 'name'=>'ckseguimiento', 'id'=>'ckseguimiento', 'value'=>'0'));?>
                            <button type="button" class="btn btn-blue px-3 d-block w-100 text-95 radius-round border-2 brc-black-tp10" id="btn_nuevoSegumiento">
                                <i class="fa fa-plus mr-1" id="btn_nuevoSegumiento"></i>                                                                            
                                 Agregar <span class="d-sm-none d-md-inline">Nuevo </span> Seguimiento
                            </button>
                          </div>                         
                        </div>  


                        <div class="" id="div_segimientos">
                          
                        </div>

                        <hr>
                        <div class="card-body" id="card-seguimiento"> 
                          <div class="form-group row" id="div_seguimiento">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0" id="lblaccionMejora">
                              <?= form_label('La Accion de Mejora fue Efectiva?', 'accionMejoraEfe', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-3" id="inputAccionMejoraEfe">
                              <!-- Selector de lista -->
                              <?= form_dropdown('accionMejoraEfe',$opcionesCSN, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="accionMejoraEfe"'); ?>
                            </div> 
                            
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Por qué su respuesta anterior', 'descripcioRespuesta', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'descripcioRespuesta', 'id'=>'descripcioRespuesta', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ', 'value'=>''));?>
                            </div> 
                          </div> 
                          <div class="form-group row" id="div_seguimientoII">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Observaciones','observacionesS', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                              <?= form_textarea(array('rows'=>'4', 'name'=>'observacionesS', 'id'=>'observacionesS', 'class'=>'form-control w-100' , 'value'=>''));?>
                            </div>
                          </div> 
                          <div class="form-group row" id="div_seguimientoIII">  
                            <div class="col-sm-2 col-form-label text-sm-right pr-0" id="lblaccionMejora">
                              <?= form_label('Estado Cumplimiento', 'cumplimiento', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-3" id="inputcumplimiento">
                              <!-- Selector de lista -->
                              <?= form_dropdown('cumplimiento',$opcComplimiento, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="cumplimiento"'); ?>
                            </div> 
                            <div class="col-sm-2 col-form-label text-sm-right pr-0" id="lblaccionMejora">
                              <?= form_label('El Caso esta cerrado', 'cerrado', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-3" id="inputcerrado">
                              <!-- Selector de lista -->
                              <?= form_dropdown('cerrado',$opcionesCSN, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="cerrado"'); ?>
                            </div>
                          </div>
                          <div class="form-group row" id="div_funcionarios vinculados">                   
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Funcionarios Involucrados ','empleadosMR_sucesos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                                <?= select_empleadosMR_tabla('sucesos','','select2 multiple="multiple form-control');?>
                            </div> 
                          </div> 
                        </div><!-- /.card-body -->
                      </div><!-- /.dcard -->
                    </div><!-- /.card -->

                   

                  <div class="form-group row" id="div_datosgestion7">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"');?>
                    </div>
                  </div> 
                    
                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                      <div class="offset-md-3 col-md-9 text-nowrap">
                        <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_seguimiento', 'name'=>'btn_guardar_seguimiento', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                        <?= anchor(base_url('rep_suceso_seguridad/reportes'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                      </div>
                    </div>
                </div><!-- /.form-body -->           
              <?= form_close(); ?>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
      </div><!-- /.row -->

  
       <!-- Modal Nueva Accion Mejora -->
  <div class="modal fade modal-lg" id="ModalAccionM" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true" >

    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bgc-primary-m1 brc-white">
          <h5 class="modal-title text-white" id="newModalLabel">
            Accion de mejora
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          
          
          <form class="" id="form_Accion" name="form_Accion" autocomplete="off" >

          <?= form_input(array('type' => 'hidden', 'name' => 'idsuceso', 'id' => 'idsuceso', 'value' => $c_id_suceso)); ?>
          
          <div class="card-body px-3 pb-1">
            <div class="form-body">

              <div class="form-group row" id="div_Accion">

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo de Accion de Mejora *', 'tipo_accion', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('tipo_accion', $opctipo, '', 'class="form-control col-sm-9 col-md-10" id="tipo_accion"'); ?>
                </div>
              </div>

              <div class="form-group row" id="div_descripcion">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Descripción de la Acción ', 'descripcion', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= form_textarea(array('rows' => '4', 'name' => 'descripcion', 'id' => 'descripcion', 'placeholder' => 'Registre la discripción de la acción de mejora que se requiere', 'class' => 'form-control col-sm-9 col-md-10')); ?>
                </div>
              </div>

              <div class="form-group row" id="div_responsable">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Responsable*', 'coordinador_accion', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_coordinadores_tabla('accion', '', 'form-control ace-select'); ?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha ejecución', 'txtfechaAE', array('class' => 'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type' => 'date', 'name' => 'txtfechaAE', 'id' => 'txtfechaAE',  'class' => 'form-control col-sm-9 col-md-10')); ?>
                </div>
              </div>
            </div><!-- /.Form-body Modal-->
          </div><!-- /.card-body Modal-->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary " id="btn_guardar_accion" name="btn_guardar_accion">
              Guardar
            </button>           
            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
              Cerrar
            </button>
          </div>
          </form>
        </div><!-- /.Modal-body -->
      </div> <!-- /.modal-content -->
    </div>
  </div> <!-- /.Modal -->
</div><!-- /.card -->
