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
    '4' => 'Otra'
  );

  $motivo = array(
    '' => 'Seleccione una Opción',
    '0' => 'Felicitaciones',  
    '1' => 'Sugerencias',
    '2' => 'Quejas',
    '3' => 'Reclamos'   
  );

  $servicio = array(
    '' => 'Seleccione una Opción',
    '1' => 'Cirugía',
    '2' => 'Procedimiento Menores',
    '3' => 'Consulta de Ortopedia',
    '4' => 'Radiología',
    '5' => 'Laboratorio Clínica',
    '6' => 'Espirometría',  
    '7' => 'Audiometría',
    '8' => 'Electromiografía',
    '9' => 'Oncología',
    '10' => 'Quimioterapia',
    '11' => 'Administración de Medicamentos',
    '12' => 'Fisioterapía'
  );
?> 




<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Contactenos | CECIMIN S.A.S.</title>

    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">


    <!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

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
                          
                          <div class="form-group row">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Motivo *','motivo', array('class'=>'mb-0')); ?>
                            </div>                             
                            <div class="col-sm-3">
                              <?= form_dropdown('motivo', $motivo, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="motivo"');?>                             
                            </div>

                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Servicio *','servicio', array('class'=>'mb-0')); ?>
                            </div> 
                            
                            <div class="col-sm-3">
                              <?= form_dropdown('servicio', $servicio, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="servicio"');?>                             
                            </div>
                          </div>
                        </div>                       

                        <div class="card-body">                          
                          <div id="smartwizard" class="d-none mx-n3 mx-sm-auto">
                            <ul class="nav">
                              <li class="wizard-progressbar"></li><!-- the progress line connecting wizard steps -->

                              <li class="nav-item">
                                <a class="nav-link" href="#step-1">
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

                              <li class="nav-item">
                                <a class="nav-link" href="#step-2">
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


                              <li class="nav-item">
                                <a class="nav-link" href="#step-3">
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

                            </ul>                            

                            <div class="tab-content px-1 py-1 mb-2">                              
                              
                              <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">

                                  <div class="form-group form-row mt-2">                                   
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-2">
                                      <b>Su Mensaje</b>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="form-group form-row mt-2">                                      
                                      <div class="col-sm-12">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">

                                            <?= form_textarea(array('rows'=>'4', 'name'=>'mensaje', 'id'=>'mensaje', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales nos contacta', 'class'=>'form-control '));?>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card" id="div-fecha">
                                    <div class="form-group form-row mt-2">
                                      <div class="col-sm-2 col-form-label text-sm-justify pr-sm-1">
                                        Fecha de los hechos
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                          <div class="align-self-end w-100">
                                            <?= form_input(array('type'=>'text', 'name'=>'fecha_hechos', 'id'=>'fecha_hechos', 'placeholder'=>'dd/mm/aaaa', 'class'=>'form-control ', 'required'=>true));?>
                                          </div>
                                        </div>
                                      </div>
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Hora de los hechos *','hora', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-1">
                                            <?= form_input(array('type'=>'text', 'name'=>'hora_hechos', 'id'=>'hora_hechos', 'class'=>'form-control ' ,'min'=>'07:00', 'max'=>'18:00'));?>
                                        </div>                                     
                                      </div>
                                  </div>                                                                                           
                                </div><!--End step-1-->

                              <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2"> 
                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                    <b>INFORMACIÓN DE QUIEN CONTACTA</b>
                                    <h6>(La siguiente información es confidencial y será utilizada únicamente con fines de prestar un mejor servicio).</h6>
                                  </div>
                                </div>
                                <div class="form-group row" id="div_nombres_apellidos">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Nombres*','nombre', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Digite el Nombre completo', 'maxlength'=>'40', 'class'=>'form-control col-sm-12 col-md-12 UpperCase'));?>
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Apellidos*','apellidos', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'text', 'name'=>'apellidos', 'id'=>'apellidos', 'placeholder'=>'Digite los apellidos', 'maxlength'=>'60', 'class'=>'form-control UpperCase'));?>
                                  </div>
                                </div>

                                <div class="form-group row" id="div_identificacion">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Documento de Identidad*','lblcedula', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Dijite su documento de Identidad', 'maxlength'=>'15', 'class'=>'form-control'));?>
                                  </div>
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Email*','lblmail', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Dijite su Correo Electrónico', 'maxlength'=>'35', 'class'=>'form-control'));?>
                                  </div>
                                </div>

                                <div class="form-group row" id="div_direccion_telefono">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Dirección','lblcedula', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'Dijite su dirección de residencia', 'maxlength'=>'15', 'class'=>'form-control '));?>
                                  </div>
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Teléfonos','lblfijo', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4 input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <?= form_input(array('type'=>'text', 'name'=>'fijo', 'id'=>'fijo', 'placeholder'=>'###-#######', 'maxlength'=>'20', 'class'=>'form-control'));?>
                                  </div>
                                </div>                                
                               
                                <div class="form-group row" id="div_entidad">                                  
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('El paciente es usuario de','lblentidadpaciente', array('class'=>'mb-0')); ?>
                                  </div>
                                   <div class="col-sm-4">
                                    <?= form_dropdown('entidadpaciente', $opc_entidad, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2" id="entidadpaciente"');?>
                                  </div> 
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Otra Entidad*','otraentidad', array('class'=>'mb-0','id'=>'lblotraentidad')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'text', 'name'=>'otraentidad', 'id'=>'otraentidad', 'placeholder'=>'Cual?', 'maxlength'=>'120', 'class'=>'form-control UpperCase'));?>
                                  </div>
                                </div>
                              </div><!-- End step-2 -->

                              <div id="step-3" class="text-center tab-pane" role="tabpanel" aria-labelledby="step-2">
                                <div class="card">  
                                  <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                    <div class="mb-1">
                                      <label align="text-center">
                                        <input type="checkbox" class="mr-2" id="poli_protdatos" name="poli_protdatos" required="required"/><font size="2" color="black">Declaro que he sido informado que CECIMIN S.A.S es el responsable del tratamiento de los datos personales y que he leído la Política de Tratamiento de Datos Personales, por lo tanto autorizo a CECIMIN S.A.S el tratamiento de mis datos personales.</font>                              
                                      </label>
                                      <a href="<?=base_url('Politica_de_privacidad_y_tratamiento_de_datos_personales.pdf')?>"><font size="2">Ver Política de Protección y Tratamiento de Datos.</font></a>
                                    </div>
                                  </div>
                                </div>  
                                <h3 class="text-400 text-success mt-4"> Gracias por Contactarnos! </h3>
                                  Si el motivo fue una queja o un reclamo, estaremos dando respuesta en el plazo maximo
                                  establecido por la normativada vigente!
                                                                  
                              </div> <!--End step-3 -->                             
                              
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
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <!-- <script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/basictable@2.0.2/dist/js/jquery.basictable.min.js"></script>

    <!-- include ace.js -->
    <script src="./dist/js/ace.min.js"></script>

    <!-- demo.js is only for Ace's demo and you shouldn't use it -->
    <script src="./dist/js/demo.min.js"></script>

    <script src="./_js/contactenos.js"></script>
  </body>
</html>