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
  '2' => 'Uso de Dispositivos/equipos biometricos',
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
  '1' => 'Sala de Procedimientos',
  '2' => 'Procedimientos Menores',
  '3' => 'Consulta de Ortopedia',
  '4' => 'Radiología',
  '5' => 'Toma de Muestras',
  '6' => 'Espirometría',  
  '8' => 'Electromiografía',
  '9' => 'Oncología',
  '10' => 'Quimioterapia',
  '11' => 'Administración de Medicamentos',
  '12' => 'Odontologia',
  '99' => 'Otro'
);


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <base href="../" />

  <title>Sucesos de Seguridad | CECIMIN S.A.S.</title>

  <!-- include common vendor stylesheets & fontawesome -->

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Animate CSS for the css animation support if needed -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />

  <!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->
  <link href="/dist/css/demo.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />


  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

  <!-- include fonts -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/basictable@2.0.2/dist/css/basictable.min.css">


  <!-- ace.css -->
  <link rel="stylesheet" type="text/css" href="./dist/css/ace.min.css">


  <!-- favicon -->
  <link rel="icon" type="image/png" href="./assets/faviconcecimin.png" />

  <!-- "Login" page styles, specific to this page for demo only -->
  <style>
    .body-container {
      background-image: linear-gradient(#6baace, #264783);
      background-attachment: fixed;
      background-repeat: no-repeat;
    }

    .carousel-item>div {
      height: 100%;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    /* these rules are used to make sure in mobile devices, tab panes are not all the same height (for example 'forgot' pane is not as tall as 'signup' pane) */

    @media (max-width: 1199.98px) {
      .tab-sliding .tab-pane:not(.active) {
        max-height: 0 !important;
      }

      .tab-sliding .tab-pane.active {
        min-height: 80vh;
        max-height: none !important;
      }
    }
  </style>
</head>

<body>
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
                            <li class="nav-item">
                              <a class="nav-link" href="#step-3">
                                <span class="num">3</span>

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
                                    <?= form_input(array('type' => 'text', 'name' => 'nombrePaciente', 'id' => 'nombrePaciente', 'placeholder' => 'Nombre completo', 'maxlength' => '40', 'class' => 'form-control col-sm-12 col-md-12 UpperCase')); ?>
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
                                    <?= form_input(array('type' => 'text', 'name' => 'numeroDocumento', 'id' => 'numeroDocumento', 'placeholder' => 'Documento de identidad', 'maxlength' => '60', 'class' => 'form-control UpperCase')); ?>
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
                                <!-- datos novedad -->

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

  <!-- Confirm Modal -->
  <!-- <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Congratulations! Your order is placed.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-salir">Salir</button>
          </div>
        </div>
      </div>
    </div> -->

  <!-- include common vendor scripts used in demo pages -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



  <script src="./plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
  <script src="./plugins/interactjs@1.10.11/dist/interact.min.js"></script>

  <!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->
  <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
  <!-- <script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/basictable@2.0.2/dist/js/jquery.basictable.min.js"></script>

  <!-- include ace.js -->
  <script src="./dist/js/ace.min.js"></script>

  <!-- demo.js is only for Ace's demo and you shouldn't use it -->
  <script src="./dist/js/demo.js"></script>
  <script src="./dist/js/demo.min.js"></script>


  <script src="./_js/rep_suceso_seguridad.js"></script>
</body>

</html>