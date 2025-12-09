<?php
 
$tipo_denuncia = array(
  '' => 'Seleccione una Opción',  
);

  $origend = array(
    '' => 'Seleccione una Opción',
    '1' => 'Accionista',
    '2' => 'Empleados',
    '3' => 'Exempleados',
    '4' => 'Paciente',
    '5' => 'Proveedor',
    '6' => 'Sin relación con Cecimin'
  );
  
?> 

<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Línea Ética | CECIMIN S.A.S.</title>

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
                              <div class="col-lg-6 col-md-12 col-sm-12">
                                <h2 style="color:#20A491"><b> Línea Ética</b></h2>
                                <h3 style="color:#20A491"><b> <img  src="./assets/faviconcecimin.png"> CECIMIN S.A.S.</b></h3>
                              </div>                          
                            
                              <div class="col-lg-6 col-md-12 col-sm-12">
                                <h2></h2>
                                <h5 style="color:#1C4B62">Esta línea ética ha sido establecida bajo altos estándares de seguridad que garantizan la confidencialidad de la información suministrada y protegen la identidad de quien la entrega</h5>
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
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">                              
                              <form id="form-1" enctype="multipart/form-data" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>                               
                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-3 col-form-label text-sm-left pr-0">
                                    <?= form_label('Tipo de denuncia *','tdenuncia', array('class'=>'mb-0')); ?>
                                  </div>                             
                                  <div class="col-sm-9">
                                    <?= form_dropdown('tdenuncia', $tipo_denuncia, '', 'class=" form-control ace-select radius-round w-100 text-grey brc-h-info-m2  col-sm-12 col-lg-10" id="tdenuncia" required="required"');?>
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>
                                </div>
                                <div class="form-group form-row mt-2">
                                  <div class="col-sm-3 col-form-label text-sm-left pr-0">
                                    <?= form_label('Origen de la Denuncia *','origend', array('class'=>'mb-0')); ?>
                                  </div>                                  
                                  <div class="col-sm-4">
                                    <?= form_dropdown('origend', $origend, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="origend" required="required"');?>       
                                  </div>
                                  <div class="valid-feedback">
                                    <i class="fa fa-check text-success"></i>
                                  </div>
                                  <div class="invalid-feedback">
                                    Por favor, registre su mensaje.
                                  </div>
                                </div>

                                <div class="form-group form-row mt-2">                                   
                                  <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-2">
                                    <b>Descripción de los hechos</b>
                                  </div>
                                                                     
                                  <div class="col-sm-12">
                                    <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                      <div class="align-self-end w-100">

                                        <?= form_textarea(array('rows'=>'4', 'name'=>'mensaje', 'id'=>'mensaje', 'placeholder'=>'Realice una breve descripción de los motivos por los cuales nos contacta', 'class'=>'form-control w-100', 'required'=>true));?>

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
                                    <div class="col-sm-2 col-form-label text-sm-justify pr-sm-1">
                                      Fecha de los hechos
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="d-inline-flex align-items-left col-12 col-sm-12 px-0">
                                        <div class="align-self-end w-100">
                                          <?= form_input(array('type'=>'date', 'name'=>'fecha_hechos', 'id'=>'fecha_hechos', 'placeholder'=>'dd/mm/aaaa', 'class'=>'form-control '));?>
                                        </div>
                                      </div>                                      
                                    </div>
                                    <div class="col-sm-3 col-form-label text-sm-right pr-0">
                                        <?= form_label('Hora de los hechos *','hora', array('class'=>'mb-0'));?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= form_input(array('type'=>'time', 'name'=>'hora_hechos', 'id'=>'hora_hechos', 'class'=>'form-control ','min'=>'06:00', 'max'=>'19:00'));?>
                                    </div>                                     
                                  </div>
                                </div>   
                            </form>                                                                                         
                            </div><!--End step-1-->                           

                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2"> 
                              <form id="form-2" metodo="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txttdenuncia', 'id'=>'txttdenuncia', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtorigend', 'id'=>'txtorigend', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtmensaje', 'id'=>'txtmensaje', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txtfecha_hecho', 'id'=>'txtfecha_hecho', 'value'=>''));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'txthora_hecho', 'id'=>'txthora_hecho', 'value'=>''));?>
                                                        
                               <!--  <div class="form-group row" id="div_sino_info">
                                  <div class="col-sm-4 col-form-label text-sm-left pr-0">
                                    <?= form_label('Desea Suministrar su Datos*','sumunistra_info', array('class'=>'mb-0')); ?>
                                  </div>
                                  <select id="sumunistra_info" name="sumunistra_info" class="ace-select radius-round col-sm-2 text-grey brc-h-info-m2">
                                    <option value="">----</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>                                            
                                  </select>
                                </div> -->
                                <div class="form-group form-row" id="container_denunciante">
                                  <div class="form-group form-row mt-2">
                                    <div class="col-sm-12 col-form-label text-sm-justify text-grey-d2 pr-sm-1">
                                      <b>INFORMACIÓN DE QUIEN DENUNCIA</b>
                                      <h6>(La siguiente información es confidencial y será utilizada únicamente con fines de prestar un mejor servicio).</h6>
                                    </div>
                                  </div>                                
                                  <div class="form-group row" id="div_nombres_apellidos">
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Nombres*','nombre', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Nombre completo', 'maxlength'=>'50', 'class'=>'form-control col-sm-12 col-md-12 UpperCase', 'required'=>true));?>
                                    </div>
                                    <div class="valid-feedback">
                                      <i class="fa fa-check text-success"></i>
                                    </div>
                                    <div class="invalid-feedback">
                                      Por favor, registre su mensaje.
                                    </div>

                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Apellidos*','apellidos', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= form_input(array('type'=>'text', 'name'=>'apellidos', 'id'=>'apellidos', 'placeholder'=>'Apellidos', 'maxlength'=>'60', 'class'=>'form-control UpperCase', 'required'=>true));?>
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
                                        <?= form_label('Teléfono Fijo','lblfijo', array('class'=>'mb-0')); ?>
                                      </div>
                                    <div class="col-sm-4 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                      </div>
                                      <?= form_input(array('type'=>'text', 'name'=>'fijo', 'id'=>'fijo', 'placeholder'=>'###-#######', 'maxlength'=>'15', 'class'=>'form-control col-sm-6 col-md-9', 'required'=>true));?>
                                    </div> 
                                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                      <?= form_label('Email*','lblmail', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Correo Electrónico', 'maxlength'=>'35', 'class'=>'form-control', 'required'=>true));?>
                                    </div>
                                  </div> 
                                </div>
                                  <!-- <div class="form-group row" id="div_sino_evid">
                                    <div class="col-sm-4 col-form-label text-sm-left pr-0">
                                      <?= form_label('Desea Suministrar su evidencias*','sumunistra_evid', array('class'=>'mb-0')); ?>
                                    </div>
                                    <select id="sumunistra_evid" name="sumunistra_evid" class="ace-select radius-round col-sm-2 text-grey brc-h-info-m2">
                                      <option value="">----</option>
                                      <option value="1">Si</option>
                                      <option value="0">No</option>                                            
                                    </select>
                                  </div>          -->                        
                                  <div class="form-group form-row mt-2" id="div_archivov">
                                    <div class="col-sm-2 col-form-label text-sm-left pr-0">
                                        <?= form_label('Evidencias','archivoevi', array('class'=>'mb-0','id'=>'archivoevi')); ?>
                                    </div>
                                    <div class="col-sm-10">
                                       <?= form_upload(array('type'=>'file', 'name'=>'archivoevi', 'id'=>'archivoevi', 'class'=>'form-control col-sm-12 col-md-12', 'required'=>true));?>                   
                                    </div> 
                                    <div class="valid-feedback">
                                      <i class="fa fa-check text-success"></i>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor, registre su mensaje.
                                    </div>                                    
                                  </div>
                                
                                <div class="card">  
                                  <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                    <div class="mb-1">
                                      <label align="text-center">
                                        <input type="checkbox" class="mr-2 form-control " id="poli_protdatos" name="poli_protdatos" required="required"/><font size="2" color="#1C4B62">Declaro que he sido informado que CECIMIN S.A.S es el responsable del tratamiento de los datos personales y que he leído la Política de Tratamiento de Datos Personales, por lo tanto autorizo a CECIMIN S.A.S el tratamiento de mis datos personales.</font>                              
                                      </label>
                                      <a href="<?=base_url('Politica_de_privacidad_y_tratamiento_de_datos_personales.pdf')?>">
                                        <font size="2" color="#167DA8">Ver Política de Protección y Tratamiento de Datos.
                                        </font>
                                      </a>
                                    </div>
                                  </div>
                                </div>                                 
                              </form>
                            </div><!-- End step-2 -->

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
    

    <script src="./_js/lineaEtica.js"></script>
  </body>

  <!-- Confirm Modal -->
  <div class="modal fade" id="condicionModal" tabindex="-1" aria-labelledby="condicionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="condicionModalLabel">Términos y Condiciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class= "text-sm-justify">
                Cecimin SAS pone a su disposición la Línea Ética Cecimin con el propósito de incentivar el cumplimiento de los estándares éticos de la institución. Si tiene conocimiento de eventos potenciales relacionados con fraude, malas prácticas y situaciones irregulares al interior de la institución, lo invitamos a diligenciar el siguiente formulario. 

                Acuerdo de responsabilidad en el suministro y manejo de la información
                La Línea Ética CECIMIN  ha sido establecida bajo parámetros de seguridad que garantizan la confidencialidad de la información suministrada y protegen la identidad de quien pone en conocimiento situaciones presuntamente irregulares y que transgreden el Código de Ética y Conducta, el Programa de Ética Empresarial, las normas internas, procedimientos, manuales, reglamentos, y protocolos de la Empresa, así como disposiciones legales, entre otras.

                En atención a este compromiso de confidencialidad y veracidad, el Grupo Keralty tendrá cero tolerancia sobre el suministro de información falsa, alterada o injuriosa frente a empleados o directivos de la Compañía con propósitos propios, razón por la cual de encontrar que la información se suministró de mala fe y en forma engañosa el Comité de Ética, determinará si hay lugar o no a la apertura de procesos disciplinarios y eventual terminación del contrato de trabajo.


                Recuerde que toda la información que usted nos proporcione será tratada de manera confidencial.
              
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-salir">Salir</button>
          </div>
        </div>
      </div>
    </div>
</html>