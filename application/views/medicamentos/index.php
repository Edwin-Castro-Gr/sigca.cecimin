<?php
  $opc_jornada = array(
    '' => 'Seleccione una Opción',
    '0' => 'Mañana',
    '1' => 'Tarde'
  );

  $opc_estado = array(
    '0' => 'Pendiente',
    '1' => 'Gestionada',
    '2' => 'Cancelada'
  );

  $opc_condicion = array(
    '' => 'Seleccione una Opción',
    '1' => 'Discapacidad Física',
    '2' => 'Discapacidad Visual',
    '3' => 'Ninguna'
  );

  $opc_tipo = array(
    '' => 'Seleccione una Opción',
    '1' => 'Cédula de Ciudadanía',
    '2' => 'Cédula de Extrangería',
    '3' => 'Tarjeta de Identidad', 
    '4' => 'Registro Civil',
    '5' => 'Pasaporte'
  );

?> 

<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Administracion de Medicamentos | CECIMIN S.A.S.</title>

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
                          <div class="card-header text-center" >
                            
                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3 style="color:#20A491"><b>Solicitud administración de medicamentos no Oncológicos</b></h3>
                              </div>                          
                            
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <h6 style="color:#1C4B62">COLSANITAS, MEDISANITAS, PLANES MODULARES, BANCO DE LA REPÚBLICA, USUARIOS CERREJÓN Y EPS SANITAS</h6>
                                <h6 style="color:#1C4B62">Señor usuario, si requiere el servicio de administración de medicamentos no oncológicos, por favor diligencie el formulario que encuentra a continuación.</h6>
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
                                    <?= form_label('Tipo de documento*','tipo', array('class'=>'mb-0')); ?>
                                  </div> 
                                  <div class="col-sm-4">
                                    <?= form_dropdown('tipo', $opc_tipo, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="tipo" required="required"');?>
                                  </div> 
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Documento de Identidad *','documento', array('class'=>'mb-0')); ?>
                                  </div>                                  
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'text', 'name'=>'documento', 'id'=>'documento', 'placeholder'=>'Digite el documento de identidad', 'class'=>'form-control', 'required'=>true));?> 
                                  </div>
                                </div>

                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Nombres*','nombre', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-10">
                                    <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Nombre completo', 'maxlength'=>'40', 'class'=>'form-control col-sm-12 col-md-12 UpperCase', 'required'=>true));?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>
                                </div>

                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Teléfono','lblfijo', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4 input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'##########', 'maxlength'=>'15', 'class'=>'form-control col-sm-6 col-md-9', 'required'=>true));?>
                                  </div>

                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Email*','lblmail', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4 input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Correo Electrónico', 'maxlength'=>'50', 'class'=>'form-control', 'required'=>true));?>
                                  </div>  
                                </div>
                              </form>                                                                                         
                            </div><!--End step-1-->                           

                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2"> 
                              <form id="form-2" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                <!-- <div class="form-group form-row mt-2">
                                  <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                    <b>INFORMACIÓN DE QUIEN CONTACTA</b>
                                    <h6>(La siguiente información es confidencial y será utilizada únicamente con fines de prestar un mejor servicio).</h6>
                                  </div>
                                </div> -->
                                <div class="form-group row" id="div_ordenmedica">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Orden Médica*','lblordenmed', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_upload(array('type'=>'file', 'name'=>'ordenmed', 'id'=>'ordenmed', 'class'=>'form-control ace-file-input', 'required'=>true));?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, Cargue la Orden Médica.
                                  </div>
                                </div>
                                <div class="form-group row" id="div_fecha_sug1">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Fecha Sugerida 1*','fechasub1', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'date', 'name'=>'fecha_sug1', 'id'=>'fecha_sug1', 'class'=>'form-control', 'required'=>true));?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre la fecha sugerida 1.
                                  </div>                                  
                                
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Jornada Sugerida 1*','lbljornada1', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_dropdown('jornada_1', $opc_jornada, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="jornada_1" required="required"');?>
                                  </div>                                  
                                </div>

                                <div class="form-group row" id="div_fecha_sug2">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Fecha Sugerida 2*','apellidos', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'date', 'name'=>'fecha_sug2', 'id'=>'fecha_sug2', 'class'=>'form-control', 'required'=>true));?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre la fecha sugerida 2.
                                  </div>                                  
                                
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Jornada Sugerida 2*','lbljornada2', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_dropdown('jornada_2', $opc_jornada, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="jornada_2" required="required"');?>
                                  </div>                                  
                                </div>

                                <div class="form-group row" id="div_fecha_sug3">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Fecha Sugerida 3*','apellidos', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_input(array('type'=>'date', 'name'=>'fecha_sug3', 'id'=>'fecha_sug3', 'class'=>'form-control', 'required'=>true));?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre la fecha sugerida 3.
                                  </div>                                  
                                
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Jornada Sugerida 1*','lbljornada1', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_dropdown('jornada_3', $opc_jornada, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="jornada_3" required="required"');?>
                                  </div>                                  
                                </div>

                                <div class="form-group row" id="div_condiciones">
                                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Condiciones*','lblcondiciones', array('class'=>'mb-0')); ?>
                                  </div>
                                  <div class="col-sm-4">
                                    <?= form_dropdown('condiciones', $opc_condicion, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="jornada_3" required="required"');?>
                                  </div> 
                                </div>
                              </form>
                            </div><!-- End step-2 -->

                            <div id="step-3" class="text-center tab-pane" role="tabpanel" aria-labelledby="step-3">
                              <form id="form-3" metodo="post" accion="<?= base_url('a_contratos/actualizar');?>" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtmotivo', 'id'=>'txtmotivo', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtservicio', 'id'=>'txtservicio', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtmensaje', 'id'=>'txtmensaje', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtnombres', 'id'=>'txtnombres', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtapellidos', 'id'=>'txtapellidos', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtdocumento', 'id'=>'txtdocumento', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtdireccion', 'id'=>'txtdireccion', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtemail', 'id'=>'txtemail', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txttelefono', 'id'=>'txttelefono', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtentidad', 'id'=>'txtentidad', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtotraentidad', 'id'=>'txtotraentidad', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtpolitica', 'id'=>'txtpolitica', 'value'=>''));?>  
                                <div class="card">  
                                  <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                    <div class="mb-1">
                                      <label align="text-center">
                                        <input type="checkbox" class="mr-2 form-control" id="poli_protdatos" name="poli_protdatos" required="required"/><font size="2" color="#1C4B62">Declaro que he sido informado que CECIMIN S.A.S es el responsable del tratamiento de los datos personales y que he leído la Política de Tratamiento de Datos Personales, por lo tanto autorizo a CECIMIN S.A.S el tratamiento de mis datos personales.</font>                              
                                      </label>
                                      <a href="<?=base_url('Politica_de_privacidad_y_tratamiento_de_datos_personales.pdf')?>"><font size="2" color="#167DA8">Ver Política de Protección y Tratamiento de Datos.</font></a>
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
            <i class="fa fa-leaf text-success-l3 mr-1 text-110"></i>CECIMIN S.A.S.  &copy; 2022
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
    

    <script src="./_js/medicamentos.js"></script>
  </body>
</html>