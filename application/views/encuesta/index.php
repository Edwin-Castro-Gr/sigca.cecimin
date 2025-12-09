<?php
  $opc_tipo = array(
    '0' => 'Seleccione una Opción',
    '1' => 'Paciente',
    '2' => 'Acompañante'
  );

  $genero = array(
    '1' => 'Masculino',
    '2' => 'Femenino',
    '3' => 'Otro'
  );

  $opc_entidad = array(
    '1' => 'Colsanitas',
    '2' => 'Medisanitas',
    '3' => 'EPS Sanitas',
    '4' => 'Otra'
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
  );
?> 

<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Encuesta | CECIMIN S.A.S.</title>

    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">


    <!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_circles.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/basictable@2.0.2/dist/css/basictable.min.css">


    
    <!-- include fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">



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
                          <div class="card-header text-center" >
                            
                            <div class="row">
                              <div class="col-lg-6 col-md-12 col-sm-12">
                                <h3><b>¿CÓMO LO ATENDIMOS?</b></h3>
                              </div>                          
                            
                              <div class="col-lg-6 col-md-12 col-sm-12">
                                <h6 >Su satisfacción es nuestro principal interés, por eso queremos</h6>
                                <h6 >conocer su opinión sobre nuestros servicios</h6>
                              </div>   
                            </div>
                              <hr>
                          </div>
                          <br>
                          <?= form_open(base_url('encuesta/guardar'), array('id'=>'Form_Guardar', 'name'=>'Form_Guardar', 'class'=>'', 'autocomplete'=>'off')); ?> 
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label class="col-form-label text-sm-right pr-0">
                                Servicio al cual se aplica la encuesta
                              </label>
                            </div>
                            <div class="col-sm-4">
                              <?= form_dropdown('servicio', $servicio, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="servicio"');?>                             
                            </div>
                          </div>
                        </div>                       

                        <div class="card-body">                          
                          <div id="smartwizard-1" class="d-none mx-n3 mx-sm-auto">
                            <ul class="mx-auto">
                              <li class="wizard-progressbar"></li><!-- the progress line connecting wizard steps -->

                              <li>
                                <a href="#step-1">
                                  <span class="step-title">
                                      1
                                  </span>

                                  <span class="step-title-done">
                                      <i class="fa fa-check text-success"></i>
                                  </span>
                                </a>

                                <span class="step-description">
                                 
                                </span>
                              </li>


                              <li>
                                <a href="#step-2">
                                  <span class="step-title">
                                      2
                                  </span>

                                  <span class="step-title-done">
                                      <i class="fa fa-check text-success"></i>
                                  </span>
                                </a>

                                <span class="step-description">
                                  
                                </span>
                              </li>


                              <li>
                                <a href="#step-3">
                                  <span class="step-title">
                                      3
                                  </span>

                                  <span class="step-title-done">
                                      <i class="fa fa-check text-success"></i>
                                  </span>
                                </a>

                                <span class="step-description">
                                  
                                </span>
                              </li>


                              <li>
                                <a href="#step-4">
                                  <span class="step-title">
                                      4
                                  </span>

                                  <span class="step-title-done">
                                      <i class="fa fa-check text-success"></i>
                                  </span>
                                </a>

                                <span class="step-description">
                                  
                                </span>
                              </li>

                              <li>
                                <a href="#step-5">
                                  <span class="step-title">
                                      5
                                  </span>

                                  <span class="step-title-done">
                                      <i class="fa fa-check text-success"></i>
                                  </span>
                                </a>

                                <span class="step-description">
                                  
                                </span>
                              </li>
                            </ul>                            

                            <div class="px-1 py-1 mb-2">
                              <label class="col-form-label text-blue-d2 pr-sm-2 text-center">
                                      Califique los siguientes servicios, seleccionando la opción que consideres.
                              </label>
                              
                                <div id="step-1" class="text-justify">

                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-2">
                                      <b>1. SERVICIO ADMINISTRATIVO</b>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        a. Claridad de la información recibida sobre requisitos, pasos y/o documentación requerida para acceder a los servicios en nuestra institución o sede.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_1a" name="calificacion_1a" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        b. Orientación dada durante su permanencia en  nuestra institución o sede.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_1b" name="calificacion_1b" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        c. Amabilidad del personal.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_1c" name="calificacion_1c" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        d. Agilidad en la atención.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_1d" name="calificacion_1d" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        e. Facilidad en los trámites para acceder a los servicios requeridos.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_1e"  name="calificacion_1e" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        f. Presentación personal de los funcionarios.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_1f"  name="calificacion_1f" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                                                              
                                </div>

                                <div id="step-2" class="text-justify"> 

                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-2">
                                      <b>2. ATENCIÓN MÉDICO ASISTENCIAL</b>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        a. Oportunidad en la atención.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_2a" name="calificacion_2a" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        b. Trato, amabilidad y respeto por parte del profesional de la salud que lo atendió.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_2b" name="calificacion_2b" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        c. Claridad de la información brindada a usted o su familia acerca de la enfermedad, tratamiento y/o procedimiento médico, preparación, beneficios y riesgos del mismo.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_2c" name="calificacion_2c" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        d. Información acerca de los servicios cubiertos y no cubiertos por su plan de salud.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_2d" name="calificacion_2d" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        e. Indicaciones y recomendaciones complementarias para el cuidado de la salud.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_2e" name="calificacion_2e" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        f. Información brindada acerca de sus derechos y deberes como paciente.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_2f" name="calificacion_2f" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="step-3" class="text-justify">
                                  
                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                      <b>3. INSTALACIONES</b>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        a. Señalización.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_3a" name="calificacion_3a" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-2">
                                        b. Comodidad de las instalaciones.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_3b" name="calificacion_3b" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        c. Higiene y aseo general.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_3c" name="calificacion_3c" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        d. Mantenimiento e imagen de las instalaciones.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_3d" name="calificacion_3d" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-10 col-form-label text-sm-justify pr-sm-1">
                                        e. Seguridad de las instalaciones para su atención.
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_3e" name="calificacion_3e" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                                  
                                </div>

                                <div id="step-4" class="text-justify">
                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                      <b>4. EN GENERAL</b>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-9 col-form-label text-sm-justify pr-sm-1">
                                        ¿En general cómo califica el servicio recibido en esta institución?.
                                      </div>

                                      <div class="col-sm-3">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_4" name="calificacion_4" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="5">Excelente</option>
                                              <option value="4">Bueno</option>
                                              <option value="3">Regular</option>
                                              <option value="2">Malo</option>
                                              <option value="1">Muy Malo</option>                                            
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                      <b>5. RECOMENDACION</b>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-9 col-form-label text-sm-justify pr-sm-1">
                                        ¿Recomendaría a sus familiares y amigos esta institución?
                                      </div>

                                      <div class="col-sm-3">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_5" name="calificacion_5" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="4">Definitivamente si</option>
                                              <option value="3">Probablemente si</option>
                                              <option value="2">Probablemente no</option>
                                              <option value="1">Definitivamente no</option>
                                                                                     
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                

                                <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                      <b>6. ASOCIACION DE USUARIOS</b>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-9 col-form-label text-sm-justify pr-sm-1">
                                        ¿Sabe usted que existe una asociación de usuarios que vela por la calidad del servicio recibido en Cecimin, la protección de sus derechos y la participación comunitaria?
                                      </div>

                                      <div class="col-sm-3">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <select id="calificacion_6" name="calificacion_6" class="ace-select radius-round w-100 text-grey brc-h-info-m2">
                                              <option value="">----</option>
                                              <option value="4">Definitivamente si</option>
                                              <option value="3">Probablemente si</option>
                                              <option value="2">Probablemente no</option>
                                              <option value="1">Definitivamente no</option>
                                                                                     
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="step-5" class="text-justify">
                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                      <b>INFORMACIÓN DEL ENCUESTADO</b>
                                      <h6>(La siguiente información es confidencial y será utilizada únicamente con fines de clasificación).</h6>
                                    </div>
                                  </div>
                                  <div class="form-group row" id="div_nombre">
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Nombre del Encuestado*','nombre_encuestado', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-10">
                                      <?= form_input(array('type'=>'text', 'name'=>'nombre_encuestado', 'id'=>'nombre_encuestado', 'placeholder'=>'Digite el Nombre', 'maxlength'=>'20', 'class'=>'form-control col-sm-8 col-md-9 UpperCase'));?>
                                    </div>
                                  </div>

                                  <div class="form-group row" id="div_otraentidad">
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Documento de Identidad*','lblcedula', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Dijite su documento de Identidad', 'maxlength'=>'15', 'class'=>'form-control col-sm-8 col-md-9 '));?>
                                    </div>
                                  </div>

                                  <div class="form-group row" id="div_tipo_genero">
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Usted es *','tipo_encuestado', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= form_dropdown('tipo_encuestado', $opc_tipo, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="tipo_encuestado"');?>
                                    </div>
                                    
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Género *','genero', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= form_dropdown('genero', $genero, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="genero"');?>
                                    </div>                               
                                  </div>

                                  <div class="form-group row" id="div_telefono">
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Teléfono Fijo','lblfijo', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                      </div>
                                      <?= form_input(array('type'=>'text', 'name'=>'fijo', 'id'=>'fijo', 'placeholder'=>'###-#######', 'maxlength'=>'20', 'class'=>'form-control col-sm-8 col-md-9'));?>
                                    </div>
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Teléfono/Celular','lblcelular', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                      </div>
                                      <?= form_input(array('type'=>'text', 'name'=>'celular', 'id'=>'celular', 'placeholder'=>'###-#######', 'maxlength'=>'20', 'class'=>'form-control col-sm-8 col-md-9'));?>
                                    </div> 
                                  </div>  

                                  <div class="form-group row" id="div_NombrePaciente">   
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Nombre del Paciente','nompaciente', array('class'=>'mb-0')); ?>
                                    </div>
                                     <div class="col-sm-10">
                                      <?= form_input(array('type'=>'text', 'name'=>'nompaciente', 'id'=>'nompaciente', 'placeholder'=>'Digite el nombre del paciente en caso de no ser el encuestado', 'maxlength'=>'60', 'class'=>'form-control col-sm-8 col-md-9 UpperCase'));?>
                                    </div> 
                                  </div>

                                  <div class="form-group row" id="div_fechaPaciente">   
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Año de nacimiento del Paciente','anopaciente', array('class'=>'mb-0')); ?>
                                    </div>
                                     <div class="col-sm-4">
                                      <?= form_input(array('type'=>'text', 'name'=>'fechapaciente', 'id'=>'fechapaciente', 'placeholder'=>'AAAA', 'maxlength'=>'4', 'class'=>'form-control col-sm-8 col-md-9'));?>
                                    </div> 
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('El paciente es usuario de','lblentidadpaciente', array('class'=>'mb-0')); ?>
                                    </div>
                                     <div class="col-sm-4">
                                      <?= form_dropdown('entidadpaciente', $opc_entidad, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="entidadpaciente"');?>
                                    </div> 
                                  </div>

                                  <div class="form-group row" id="div_otraentidad">
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Otra Entidad*','otraentidad', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-10">
                                      <?= form_input(array('type'=>'text', 'name'=>'otraentidad', 'id'=>'otraentidad', 'placeholder'=>'Cual?', 'maxlength'=>'120', 'class'=>'form-control col-sm-8 col-md-9 UpperCase'));?>
                                    </div>
                                  </div>
                                  
                                </div><!-- /#step-5 -->
                              
                            </div> <!-- ./px -->
                          </div><!-- /#smartwizard-1 -->
                        </div><!-- /.card-body -->
                        <?= form_close(); ?>
                      </div><!-- .col-12 -->
                    </div><!-- /.row mt-4-->
                  </div><!-- /.page-content -->
                </div><!-- /.row row-2-->
              </div><!-- /.col-12-->
            </div><!-- /.col shadow-->
          </div><!-- /.p2 -->

          <div class="d-lg-none my-3 text-white-tp1 text-center">
            <i class="fa fa-leaf text-success-l3 mr-1 text-110"></i>CECIMIN S.A.S.  &copy; 2022
          </div> 
        </div><!-- ./main-content -->
      </div> <!-- ./main-container -->
    </div> <!-- ./body-container -->

    <!-- include common vendor scripts used in demo pages -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <script src="./plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
    <script src="./plugins/interactjs@1.10.11/dist/interact.min.js"></script>

    <!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/js/jquery.smartWizard.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/basictable@2.0.2/dist/js/jquery.basictable.min.js"></script>

    <!-- include ace.js -->
    <script src="./dist/js/ace.min.js"></script>

    <!-- demo.js is only for Ace's demo and you shouldn't use it -->
    <script src="./dist/js/demo.min.js"></script>

    <script src="./_js/encuesta.js"></script>
  </body>
</html>