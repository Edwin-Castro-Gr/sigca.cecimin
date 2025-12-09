<?php
$opc_tipo = array(
  '0' => 'Seleccione una Opción',
  '1' => 'Paciente',
  '2' => 'Acompañante'
);

$genero = array(
  '' => 'Seleccione una Opción',
  '1' => 'Masculino',
  '2' => 'Femenino',
  '3' => 'Otro'
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
  '1' => 'Cirugía',
  '2' => 'Procedimientos Menores',
  '3' => 'Consulta de Ortopedia',
  '4' => 'Radiología',
  '5' => 'Laboratorio Clínico',
  '6' => 'Espirometría',
  '8' => 'Electromiografía',
  '9' => 'Oncología',
  '10' => 'Quimioterapia',
  '11' => 'Administración de Medicamentos',
  '13' => 'Odontologia'
);



?>


<input type="hidden" name="opc_pag" id="opc_pag" value="index">

<div class="body-container">
  <div class="main-container container bgc-transparent">
    <div class="main-content minh-100 justify-content-center">
      <div class="p-2 p-md-4">
        <div class="row" id="row-1">
          <div class="col-12 col-xl-10 offset-xl-1 bgc-white shadow radius-1 overflow-hidden">
            <div class="row" id="row-2">
              <div class="page-content container container-plus">
                <div class="row mt-4">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header text-center">

                        <div class="row">
                          <div class="col-lg-6 col-md-12 col-sm-12">
                            <h3 style="color:#20A491"><b> Quejas, Reclamos, Sugerencias y Felicitaciones</b></h3>
                          </div>

                          <div class="col-lg-6 col-md-12 col-sm-12">
                            <h6 style="color:#1C4B62">Su Opinión es importate para nosotros</h6>
                            <h6 style="color:#1C4B62">Estamos listos para ayudarte</h6>
                          </div>
                        </div>
                        <hr>
                      </div>
                      <br>
                    </div>

                    <div class="card-body">
                      <div id="smartwizard" dir="rtl-">
                        <ul class="nav nav-progress">
                          <li class="nav-item">
                            <a class="nav-link" href="#step-1">
                              <div class="num">1</div>

                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#step-2">
                              <span class="num">2</span>

                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#step-3">
                              <span class="num">3</span>

                            </a>
                          </li>
                        </ul>

                        <div class="tab-content">
                          <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <form id="form-1" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                              <div class="form-group form-row mt-2">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Motivo *', 'motivo', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_dropdown('motivo', $motivo, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="motivo" required="required"'); ?>
                                </div>

                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_dropdown('servicio', $servicio, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="servicio" required="required"'); ?>
                                </div>
                              </div>

                              <div class="form-group form-row mt-2">
                                <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-2">
                                  <b>Su Mensaje</b>
                                </div>
                              </div>
                              <div class="form-group form-row mt-2">
                                <div class="col-sm-12">
                                  <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                    <div class="align-self-end w-100">

                                      <?= form_textarea(array('rows' => '4', 'name' => 'mensaje', 'id' => 'mensaje', 'placeholder' => 'Realice una breve descripción de los motivos por los cuales nos contacta', 'class' => 'form-control w-100', 'required' => true)); ?>

                                    </div>
                                    <div class="valid-feedback">
                                      <i class="fa fa-check text-success"></i>
                                    </div>
                                    <div class="invalid-feedback">
                                      Por favor, registre su mensaje.
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card" id="div-fecha">
                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-3 col-form-label text-sm-justify pr-sm-1">
                                    Fecha de los hechos
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                      <div class="align-self-end w-100">
                                        <?= form_input(array('type' => 'text', 'name' => 'fecha_hechos', 'id' => 'fecha_hechos', 'placeholder' => 'dd/mm/aaaa', 'class' => 'form-control ')); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-3 col-form-label text-sm-right pr-0">
                                    <?= form_label('Hora de los hechos *', 'hora', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-1">
                                    <?= form_input(array('type' => 'text', 'name' => 'hora_hechos', 'id' => 'hora_hechos', 'class' => 'form-control ', 'min' => '07:00', 'max' => '18:00')); ?>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div><!--End step-1-->

                          <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <form id="form-2" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                              <div class="form-group form-row mt-2">
                                <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                  <b>INFORMACIÓN DE QUIEN CONTACTA</b>
                                  <h6>(La siguiente información es confidencial y será utilizada únicamente con fines de prestar un mejor servicio).</h6>
                                </div>
                              </div>
                              <div class="form-group row" id="div_nombres_apellidos">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Nombres*', 'nombre', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_input(array('type' => 'text', 'name' => 'nombres', 'id' => 'nombres', 'placeholder' => 'Nombre completo', 'maxlength' => '40', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'required' => true)); ?>
                                </div>
                                <div class="valid-feedback">
                                  <i class="fa fa-check text-success"></i>
                                </div>
                                <div class="invalid-feedback">
                                  Por favor, registre su mensaje.
                                </div>

                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Apellidos*', 'apellidos', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_input(array('type' => 'text', 'name' => 'apellidos', 'id' => 'apellidos', 'placeholder' => 'Apellidos', 'maxlength' => '60', 'class' => 'form-control UpperCase', 'required' => true)); ?>
                                </div>
                                <div class="valid-feedback">
                                  <i class="fa fa-check text-success"></i>
                                </div>
                                <div class="invalid-feedback">
                                  Por favor, registre su mensaje.
                                </div>
                              </div>

                              <div class="form-group row" id="div_identificacion">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Documento*', 'lblcedula', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_input(array('type' => 'text', 'name' => 'cedula', 'id' => 'cedula', 'placeholder' => 'Documento de Identidad', 'maxlength' => '15', 'class' => 'form-control', 'required' => true)); ?>
                                </div>
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Email*', 'lblmail', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'placeholder' => 'Correo Electrónico', 'maxlength' => '35', 'class' => 'form-control', 'required' => true)); ?>
                                </div>
                              </div>

                              <div class="form-group row" id="div_direccion">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Dirección*', 'lbldireccion', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-10">
                                  <?= form_input(array('type' => 'text', 'name' => 'direccion', 'id' => 'direccion', 'placeholder' => 'Dirección de residencia', 'maxlength' => '170', 'class' => 'form-control ', 'required' => true)); ?>
                                </div>
                              </div>
                              <div class="form-group row" id="div_telefono_entidad">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Teléfono Fijo', 'lblfijo', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4 input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                  </div>
                                  <?= form_input(array('type' => 'text', 'name' => 'fijo', 'id' => 'fijo', 'placeholder' => '###-#######', 'maxlength' => '15', 'class' => 'form-control col-sm-6 col-md-9', 'required' => true)); ?>
                                </div>
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Entidad paciente', 'lblentidadpaciente', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_dropdown('entidadpaciente', $opc_entidad, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="entidadpaciente" required="required"'); ?>
                                </div>
                              </div>
                              <div class="otraentidad form-group row" id="div_otraentidad">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <?= form_label('Otra Entidad*', 'otraentidad', array('class' => 'mb-0', 'id' => 'lblotraentidad')); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?= form_input(array('type' => 'text', 'name' => 'otraentidad', 'id' => 'otraentidad', 'placeholder' => 'Cual?', 'maxlength' => '120', 'class' => 'form-control UpperCase')); ?>
                                </div>
                              </div>
                            </form>
                          </div>
                          
                          <!-- End step-2 -->


                          <!-- start step-3 -->

                          <div id="step-3" class="text-center tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <form id="form-3" metodo="post" accion="<?= base_url('a_contratos/actualizar'); ?>" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                              <?= form_input(array('type' => 'hidden', 'name' => 'formularioPqrs', 'id' => 'formularioPqrs', 'value' => true)); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtmotivo', 'id' => 'txtmotivo', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtservicio', 'id' => 'txtservicio', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtmensaje', 'id' => 'txtmensaje', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtnombres', 'id' => 'txtnombres', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtapellidos', 'id' => 'txtapellidos', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtdocumento', 'id' => 'txtdocumento', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtdireccion', 'id' => 'txtdireccion', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtemail', 'id' => 'txtemail', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txttelefono', 'id' => 'txttelefono', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtentidad', 'id' => 'txtentidad', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtotraentidad', 'id' => 'txtotraentidad', 'value' => '')); ?>
                              <?= form_input(array('type' => 'hidden', 'name' => 'txtpolitica', 'id' => 'txtpolitica', 'value' => '')); ?>
                              <div class="card">
                                <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                  <div class="mb-1">
                                    <label align="text-center">
                                      <input type="checkbox" class="mr-2 form-control" id="poli_protdatos" name="poli_protdatos" required="required" />
                                      <font size="2" color="#1C4B62">Declaro que he sido informado que CECIMIN S.A.S es el responsable del tratamiento de los datos personales y que he leído la Política de Tratamiento de Datos Personales, por lo tanto autorizo a CECIMIN S.A.S el tratamiento de mis datos personales.</font>
                                    </label>
                                    <a href="<?= base_url('Politica_de_privacidad_y_tratamiento_de_datos_personales.pdf') ?>">
                                      <font size="2" color="#167DA8">Ver Política de Protección y Tratamiento de Datos.</font>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div> <!--End step-3 -->
                          <!-- Include optional progressbar HTML -->

                          <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> <!-- content -->
                      </div><!-- /#smartwizard -->
                    </div><!-- /.card-body -->
                  </div><!-- .col-12 -->
                </div><!-- /.row mt-4-->
              </div><!-- /.page-content -->
            </div><!-- /.row row-2-->
          </div><!-- /.col-12-->
        </div><!-- /.col shadow-->
      </div><!-- /.p2 -->

      <div class="d-lg-none my-3 text-white-tp1 text-center">
        <i class="fa fa-leaf text-success-l3 mr-1 text-110"></i>CECIMIN S.A.S. &copy; 2022
      </div>
    </div><!-- ./main-content -->
  </div> <!-- ./main-container -->
</div> <!-- ./body-container -->