<?php
$opc_tipo = array(
  '0' => 'Seleccione una Opción',
  '1' => 'Paciente',
  '2' => 'Acompañante'
);

$opcionesSN= array(
  '1' => 'Si',
  '2' => 'No'
);

$genero = array(
  '' => 'Seleccione una Opción',
  '1' => 'Masculino',
  '2' => 'Femenino',
  '3' => 'Otro'
);

$causaNovedad = array(
  '' => 'Seleccione una Opción',
  '1' => 'Uso de Medicamentos',
  '2' => 'Uso de Dispositivos/equipos biomedicos',
  '3' => 'Uso de Reactivos',
  '4' => 'Uso de Tejidos',
  '5' => 'Otros'
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
  '9' => 'Fonoaudiólogo',
  '10' => 'Administrativo',
  '11' =>'Coordinador',
  '12' => 'Otro'
);


$servicio = array(
  '' => 'Seleccione una Opción',
  '1' => 'Cirugía',
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
                              <h3 style="color:#20A491"><b> Reporte de sucesos de seguridad</b></h3>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                              <h6 style="color:#1C4B62">Este formulario esta diseñado para repotar</h6>
                              <h6 style="color:#1C4B62">los eventos adversos o sucesos de seguidad</h6>
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
                          </ul>


                          <div class="tab-content">

                            <!--Start step-1-->

                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                              <form id="form-1" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>

                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Cargo Reportante', 'cargoReportante', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_dropdown('cargoReportante', $cargoReportante, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="cargoReportante" required="required"'); ?>
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Servicio', 'servicio', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_dropdown('servicio', $servicio, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="servicio" required="required"'); ?>
                                  </div>
                                </div>

                                <!-- Inputs formulario Otro cargo / Otro Servicio -->

                                <div class="form-group form-row mt-2">
                                  <!-- <div id="divOtroCargo" class="form-row col-sm-6" > -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Cual Cargo?', 'otroCargo', array('class' => 'mb-0', 'id' => 'lbOtroCargo')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'otroCargo', 'id' => 'otroCargo', 'placeholder' => 'Cargo', 'maxlength' => '40', 'class' => 'form-control col-sm-12 col-md-12 UpperCase')); ?>
                                  </div>
                                  <!-- </div> -->
                                  <!--  input  otro servicio -->
                                  <!-- <div id="divOtroServicio" class="col-sm-6"> -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Cual Servicio?', 'otroServicio', array('class' => 'mb-0', 'id' => 'lbOtroServicio')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'otroServicio', 'id' => 'otroServicio', 'placeholder' => 'Servicio', 'maxlength' => '60', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                  <!-- </div> -->
                                </div>


                                <!-- Inputs formulario Datos del paciente -->
                                <div class="form-group row" id="div_nombres_apellidos">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Nombre del paciente?', 'nombrePaciente', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'nombrePaciente', 'id' => 'nombrePaciente', 'placeholder' => 'Nombre completo', 'maxlength' => '40', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'required' => true)); ?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Número de Documento?', 'numeroDocumento', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'numeroDocumento', 'id' => 'numeroDocumento', 'placeholder' => 'Documento de identidad', 'maxlength' => '60', 'class' => 'form-control UpperCase', 'required' => true)); ?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>
                                </div>

                              </form>
                            </div>

                            <!--End step-1-->

                            <!-- ---------------------------------------- -->
                            
                            <!-- Start step-2 -->


                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">

                              <form id="form-2" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>


                                <!-- Etiquetas ocultas para el que el formulario pueda guardar la informacion de los 2 steeps -->

                                <!-- Etiquetas del steep 1 -->
                                <?= form_input(array('type' => 'hidden', 'name' => 'formulariosucesos', 'id' => 'formulariosucesos', 'value' => false)); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtnombrePaciente', 'id' => 'txtnombrePaciente', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtnumeroDocumento', 'id' => 'txtnumeroDocumento', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtcargoReportante', 'id' => 'txtcargoReportante', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtservicio', 'id' => 'txtservicio', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtotroCargo', 'id' => 'txtotroCargo', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtotroServicio', 'id' => 'txtotroServicio', 'value' => '')); ?>


                                <!-- Etiquetas del steep 2 -->
                                <!-- Datos de medicamento -->
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtcausaNovedad', 'id' => 'txtcausaNovedad', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtinformoJ', 'id' => 'txtinformoJ', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtdescripcionNovedad', 'id' => 'txtdescripcionNovedad', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtmanejoRealizado', 'id' => 'txtmanejoRealizado', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtdatosMedicamento', 'id' => 'txtdatosMedicamento', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtregistroSanitario', 'id' => 'txtregistroSanitario', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtloteMedicamento', 'id' => 'txtloteMedicamento', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtfechaVencimiento', 'id' => 'txtfechaVencimiento', 'value' => '')); ?>
                                <!-- Datos del dispositivo -->
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtdatosdispositivo', 'id' => 'txtdatosdispositivo', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtregistroSanitarioD', 'id' => 'txtregistroSanitarioD', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtlotedispositivo', 'id' => 'txtlotedispositivo', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtmodelo', 'id' => 'txtmodelo', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtnumReferencia', 'id' => 'txtnumReferencia', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtserial', 'id' => 'txtserial', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtfabricante', 'id' => 'txtfabricante', 'value' => '')); ?>
                                <?= form_input(array('type' => 'hidden', 'name' => 'txtdistibuidor', 'id' => 'txtdistibuidor', 'value' => '')); ?>
                                

                                <!-- datos novedad -->

                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                    <b>Datos de la novedad</b>
                                    <h6>
                                      La siguiente información es confidencial y será utilizada únicamente con fines de prestar un mejor servicio.
                                    </h6>
                                  </div>
                                </div>
                                <!-- novedad asociadad -->

                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Novedad asociada a: ', 'causaNovedad', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Selector de lista -->
                                    <?= form_dropdown('causaNovedad', $causaNovedad, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="causaNovedad" required="required"'); ?>
                                  </div>
                                
                                  <div class="col-sm-3 col-form-label text-sm-right pr-0">
                                    <?= form_label('Informó al Jefe Inmediato: ', 'informoJ', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-2">
                                    <!-- Selector de lista -->
                                    <?= form_dropdown('informoJ', $opcionesSN,'', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="informoJ" required="required"'); ?>
                                  </div>
                                </div>

                                <!-- ////////////////////////////////////////////////////////////////////// -->
                                <!-- DATOS DEL MEDICAMENTO -->
                                <!-- //////////////////////////////////////////////////////////////////////// -->
                                <div class="form-group row" id="div_Dato_Medicamentos">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Datos del medicamento', 'datosMedicamento', array('class' => 'mb-0', 'id' => 'lbdatosMedicamento')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'datosMedicamento', 'id' => 'datosMedicamento', 'placeholder' => 'Datos del Medicamento', 'maxlength' => '40', 'class' => 'form-control col-sm-12 col-md-12 UpperCase')); ?>
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <!-- Etiqueta del campo -->
                                    <?= form_label('Registro sanitario: ', 'registroSanitario', array('class' => 'mb-0', 'id' => 'lbregistroSanitario')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                  <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'registroSanitario', 'id' => 'registroSanitario', 'placeholder' => 'Registro Sanitario', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                </div>
                                <div class="form-group row" id="div_Dato_MedicamentosII"> 
                                
                                  <!-- LOTE DEL MEDICAMENTO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Lote del medicamento: ', 'loteMedicamento', array('class' => 'mb-0', 'id' => 'lbloteMedicamento')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'loteMedicamento', 'id' => 'loteMedicamento', 'placeholder' => 'Lote del medicamento', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>

                                  <!-- FECHA DE VENCIMIENTO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Fecha de vencimiento: ', 'fechaVencimiento', array('class' => 'mb-0', 'id' => 'lbfechaVencimiento')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'date', 'name' => 'fechaVencimiento', 'id' => 'fechaVencimiento', 'placeholder' => 'Fecha de vencimiento', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                </div>

                                <!-- ////////////////////////////////////////////////////////////////////// -->
                                <!-- DATOS DEL DISPOSITIVO -->
                                <!-- //////////////////////////////////////////////////////////////////////// -->

                                <div class="form-group row" id="div_Datos_Tecnovigilancia">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Datos del Dispositivo', 'datosdispositivo', array('class' => 'mb-0', 'id' => 'lbdatosdispositivo')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'datosdispositivo', 'id' => 'datosdispositivo', 'placeholder' => 'Datos del dispositivo', 'maxlength' => '40', 'class' => 'form-control col-sm-12 col-md-12 UpperCase')); ?>
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                  <!-- Etiqueta del campo -->
                                    <?= form_label('Registro sanitario: ', 'registroSanitarioD', array('class' => 'mb-0', 'id' => 'lbregistroSanitarioD')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                  <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'registroSanitarioD', 'id' => 'registroSanitarioD', 'placeholder' => 'Registro Sanitario del Dispositivo Médico', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                </div>

                                <div class="form-group row" id="div_Datos_TecnovigilanciaII">
                                  <!-- LOTE DEL DIOSPOSITIVO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Lote del dispositivo: ', 'lotedispositivo', array('class' => 'mb-0', 'id' => 'lbregistroSanitario')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'lotedispositivo', 'id' => 'lotedispositivo', 'placeholder' => 'Lote del dispositivo', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>

                                  <!-- MODELO DEL DIOSPOSITIVO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Modelo: ', 'modelo', array('class' => 'mb-0', 'id' => 'lbmodelo')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'modelo', 'id' => 'modelo', 'placeholder' => 'Modelo del dispositivo', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                </div>
                             
                                <div class="form-group row" id="div_Datos_TecnovigilanciaIII">
                                  <!-- REFERENCIA DEL DIOSPOSITIVO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Referencia: ', 'numReferencia', array('class' => 'mb-0', 'id' => 'lbnumReferencia')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'numReferencia', 'id' => 'numReferencia', 'placeholder' => 'Referencia del Dispositivo', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>

                                  <!-- SERIAL DEL DIOSPOSITIVO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Serial: ', 'serial', array('class' => 'mb-0', 'id' => 'lbserial')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'serial', 'id' => 'serial', 'placeholder' => 'Serial del dispositivo', 'maxlength' => '70', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                </div>

                                <div class="form-group row" id="div_Datos_TecnovigilanciaIV">
                                  <!-- FABRICANTE DEL DIOSPOSITIVO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Fabricante', 'fabricante', array('class' => 'mb-0', 'id' => 'lbfabricante')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'fabricante', 'id' => 'fabricante', 'placeholder' => 'Fabricante del Dispositivo', 'maxlength' => '90', 'class' => 'form-control UpperCase')); ?>
                                  </div>

                                  <!-- DISTRIBUIDOR / IMPORTADOR DEL DIOSPOSITIVO -->
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <!-- Etiqueta del campo -->
                                    <?= form_label('Distribuidor: ', 'distibuidor', array('class' => 'mb-0', 'id' => 'lbdistibuidor')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <!-- Input text -->
                                    <?= form_input(array('type' => 'text', 'name' => 'distibuidor', 'id' => 'distibuidor', 'placeholder' => 'Distribuidor o Importador  del dispositivo', 'maxlength' => '90', 'class' => 'form-control UpperCase')); ?>
                                  </div>
                                </div>

                                <div class="form-group row" id="div_descripcion">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Describa la novedad: ', 'descripcionNovedad', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_textarea(array('rows' => '4', 'name' => 'descripcionNovedad', 'id' => 'descripcionNovedad', 'placeholder' => 'Realice una breve descripción del suceso: ', 'class' => 'form-control w-100', 'required' => true)); ?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Manejo realizado: ', 'manejoRealizado', array('class' => 'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_textarea(array('rows' => '4', 'name' => 'manejoRealizado', 'id' => 'manejoRealizado', 'placeholder' => 'Realice una breve descripción del manejo realizado: ', 'class' => 'form-control w-100', 'required' => true)); ?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>
                                </div>

                              </form>

                            </div><!-- End step-2 -->

                            
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