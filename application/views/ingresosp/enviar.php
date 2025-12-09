
<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Cargar Documentos | CECIMIN S.A.S.</title>

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


    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- include fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/basictable@2.0.2/dist/css/basictable.min.css">

    
    <!-- ace.css -->
    <link rel="stylesheet" type="text/css" href="./dist/css/ace.min.css">


    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/faviconcecimin.png" />

    <!-- "Login" page styles, specific to this page for demo only -->
   <!--  <style>
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
    </style> -->
    <script>  // Pasar la clave de sitio a JavaScript
        const RECAPTCHA_SITE_KEY = '<?= $this->config->item('recaptcha_site_key') ?>';
    </script>
      <script src="https://www.google.com/recaptcha/api.js?render=<?= $this->config->item('recaptcha_site_key')?>"></script>
  </head>

  <body>
    <input type="hidden" name="opc_pag" id="opc_pag" value="enviar">

    <div class="body-container">
      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <!-- <i class="far fa-edit text-dark-l3 mr-1"></i> -->
            <img src="./assets/faviconcecimin.png">
             CECIMIN S.A.S  --  Documentos de Ingreso
          </h3>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card dcard">
              <div class="card-body px-3 pb-1">
                <?= form_open(base_url('c_enviaringresop/enviar'), array('id'=>'form_enviar', 'name'=>'form_enviar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'idcargo', 'id'=>'idcargo', 'value'=>$c_cargo));?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'idusuario', 'id'=>'idusuario', 'value'=>$c_usuario));?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'idingreso', 'id'=>'idingreso', 'value'=>$c_ingreso));?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'idtipoContrato', 'id'=>'idtipoContrato', 'value'=>$c_tipo_contrato));?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'coordinador', 'id'=>'coordinador', 'value'=>$c_coordinador));?>
                  <?= form_input(array('type'=>'hidden', 'name'=>'correo_coord', 'id'=>'correo_coord', 'value'=>$c_correo_coord));?>
                  <!-- Campo oculto para el token -->
                  <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response"> 
                  <div class="form-body " style=" justify-content:flex-start;" >                    

                     <div class="container " id="div_parte7">                    
                        <div class="form-group row" id="div_parte1">
                           <div class="col-form-label text-sm-left pr-0">
                              <?= form_label('DOCUMENTOS DE INGRESO DE '.$c_usuario.'','accordionA', array('class'=>'mb-0')); ?>
                           </div>
                           <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                              <div class="card-body p-0" id="accordionA">
                                <!--div class="accordion" id="accordionAnexos">                  


                                </div-->
                              </div>
                           </div><!-- /.card -->
                        </div><!-- /.form-group -->
                        <br>
                        <div class="form-group row" id="div_parte2">  
                           <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Observaciones *','observaciones', array('class'=>'mb-0')); ?>
                           </div>
                           <div class="col-sm-10">
                              <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Observaciones', 'class'=>'form-control ', 'required'=>true));?>
                           </div>
                        </div><!-- /.form-group row -->
                     </div><!-- /.card --> 
                     <div class="container " id="div_parte0">   
                        <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                          <div class="offset-md-3 col-md-6 text-center">
                            <?= form_button(array('type'=>'button', 'id'=>'btn_enviar', 'name'=>'btn_enviar', 'content'=>'<i class="fa fa-check mr-1"></i>Enviar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                            <?= anchor(base_url('c_ingresop/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                          </div>
                        </div>
                    </div><!-- /.card -->

                  </div><!-- /.card-body -->
                <?= form_close(); ?>
              </div><!-- /.card -->
            </div>
          </div><!-- /.card -->
        </div>
      </div><!-- /.card -->    

    </div>
    <footer class="footer d-none d-sm-block">
      <div class="footer-inner bgc-white-tp1">
        <div class="pt-4 border-none border-t-3 brc-grey-l2 border-double">
          <span class="text-primary-m1 font-bolder text-120">SIGCA</span>
          <span class="text-grey">Application &copy; <?=date('Y');?></span>

        </div>
      </div><!-- .footer-inner -->

      <!-- `scroll to top` button inside footer (for example when in boxed layout) -->
      <div class="footer-tools">
        <a href="#" class="btn-scroll-up btn btn-dark mb-2 mr-2">
          <i class="fa fa-angle-double-up mx-2px text-95"></i>
        </a>
      </div>
    </footer>
      
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
    

    <script src="./_js/enviaringresosp.js"></script>
  </body>
</html>