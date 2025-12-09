
<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	    <base href="./" />

	    <title>SIGCA | Sistema Integral de Gestión de Calidad</title>

	    <!-- include common vendor stylesheets & fontawesome -->
	    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

	    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">

	    <!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->

	    <!-- include fonts -->
	    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">

	    <!-- ace.css -->
	    <link rel="stylesheet" type="text/css" href="./dist/css/ace.min.css">

	    <!-- favicon -->
	    <link rel="icon" type="image/png" href="./assets/favicon.png" />

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
	   	<script>  // Pasar la clave de sitio a JavaScript
    		const RECAPTCHA_SITE_KEY = '<?= $this->config->item('recaptcha_site_key') ?>';
			</script>
  		<script src="https://www.google.com/recaptcha/api.js?render=<?= $this->config->item('recaptcha_site_key')?>"></script>
  	</head>

  	<body>
  		
  		<input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">
	    <div class="body-container">

	      <div class="main-container container bgc-transparent">

	        <div class="main-content minh-100 justify-content-center">
	          <div class="p-2 p-md-4">
	            <div class="row" id="row-1">
	              <div class="col-12 col-xl-10 offset-xl-1 bgc-white shadow radius-1 overflow-hidden">

	                <div class="row" id="row-2">

	                  <div id="id-col-intro" class="col-lg-5 d-none d-lg-flex border-r-1 brc-default-l3 px-0">
	                    <!-- the left side section is carousel in this demo, to show some example variations -->

	                    <div id="loginBgCarousel" class="carousel slide minw-100 h-100">
	                      
	                      <div class="carousel-inner minw-100 h-100">
	                        <div class="carousel-item active minw-100 h-100">
	                          <!-- default carousel section that you see when you open login page -->
	                          	<div style="background-image: url(assets/image/login-bg-1.svg);" class="px-3 bgc-blue-l4 d-flex flex-column align-items-center justify-content-center">
		                            <a class="mt-5 mb-2" href="<?= base_url(''); ?>">
		                              <img src="<?= base_url('assets/image/SIGCA.png'); ?>" alt="SIGCA" class="dark-logo col-12" />
		                            </a>

		                            <h2 class="text-primary-d1"><img src="<?= base_url('assets/image/logo-cecimin.png'); ?>" alt="SIGCA" class="dark-logo col-12" />
		                              
		                            </h2>

		                            <div class="mt-5 mx-4 text-dark-tp3">
		                              
		                              <hr class="mb-1 brc-black-tp10" />
		                              
		                            </div>

		                            <div class="mt-auto mb-4 text-dark-tp2">
		                            	2020 - <?= date('Y'); ?> <strong>SIGCA &copy;</strong> Todos los derechos reservados.
		                            </div>
	                          	</div>
	                        </div>

	                      </div>
	                    </div>
	                  </div>


	                  <div id="id-col-main" class="col-12 col-lg-7 py-lg-5 bgc-white px-0">
	                  	<!-- you can also use these tab links -->
	                    <ul class="d-none mt-n4 mb-4 nav nav-tabs nav-tabs-simple justify-content-end bgc-black-tp11" role="tablist">
	                      <li class="nav-item mx-2">
	                        <a class="nav-link active px-2" data-toggle="tab" href="#id-tab-login" role="tab" aria-controls="id-tab-login" aria-selected="true">
	                          Login
	                        </a>
	                      </li>
	                    </ul>
	                    
	                    <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">

	                      	<div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
		                        <!-- show this in desktop -->
		                        <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
		                          <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130">
		                            <i class="fa fa-coffee text-orange-m1 mr-1"></i>
		                            Ingreso
		                          </h4>
		                        </div>

		                        <!-- show this in mobile device -->
		                        <div class="d-lg-none text-secondary-m1 my-4 text-center">
		                          <a href="<?= base_url(''); ?>">
		                            <!--i class="fa fa-leaf text-success-m2 text-200 mb-4"></i-->
		                            <img src="<?= base_url('assets/image/SIGCA.png'); ?>" alt="SIGCA" class="dark-logo col-12" />
		                          </a>
		                          <h1 class="text-170">
		                            <!--span class="text-blue-d1">
		                                SIGCA <span class="text-80 text-dark-tp3">Application</span>
		                            </span-->
		                          </h1>

		                          Ingreso
		                        </div>

		                        <!-- PARA MOVIL y DESKTOP -->
		                        <form autocomplete="off" class="form-row mt-4" id="loginform">
		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
		                              <input placeholder="Username" type="text" class="form-control form-control-lg pr-4 shadow-none" required="" name="usuario" id="usuario" />
		                              <i class="fa fa-user text-grey-m2 ml-n4"></i>
		                              <label class="floating-label text-grey-l1 ml-n3" for="usuario">
		                                Usuario
		                              </label>
		                              <!-- Campo oculto para el token -->
        								          <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
		                            </div>
		                          </div>


		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
		                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
		                              <input placeholder="Password" type="password" class="form-control form-control-lg pr-4 shadow-none" required="" name="contrasena" id="contrasena" />
		                              <i class="fa fa-key text-grey-m2 ml-n4"></i>
		                              <label class="floating-label text-grey-l1 ml-n3" for="contrasena">
		                                Contraseña
		                              </label>
		                            </div>
		                          </div>

		                           	
		                          <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-right text-md-right mt-n2 mb-2">
		                            <a href="#" class="text-primary-m1 text-95" data-toggle="tab" data-target="#id-tab-forgot">
		                              ¿Has olvidado tu contraseña?
		                            </a>
		                          </div>


		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		                            <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4" id="btn_ingresar">
		                              Ingresar
		                            </button>
		                          </div>
		                           	<!-- reCAPTCHA -->								   
		                        </form>

		                        <div class="form-row">
		                          <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">
		                            <hr class="brc-default-l2 mt-0 mb-2 w-100" />
		                          </div>
		                        </div>
	                      	</div>


	                      	<div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">
		                        <div class="position-tl ml-3 mt-2">
		                          <a href="#" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp" data-toggle="tab" data-target="#id-tab-login">
		                            <i class="fa fa-arrow-left"></i>
		                          </a>
		                        </div>


		                        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5 px-0">
		                          <h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l2 pb-1 text-130">
		                            <i class="fa fa-key text-brown-m1 mr-1"></i>
		                            Recuperar contraseña
		                          </h4>
		                        </div>


		                        <form autocomplete="off" class="form-row mt-4" id="enviarEmail">
		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		                            <label class="text-secondary-d3 mb-3" for="id-recover-email">
		                              Ingrese su dirección de correo electrónico y le enviaremos las instrucciones:
		                            </label>
		                            <div class="d-flex align-items-center">
		                              <input type="email" class="form-control form-control-lg pr-4 shadow-none" id="id-recover-email" name="id-recover-email" placeholder="Email" required />
		                              <i class="fa fa-envelope text-grey-m2 ml-n4"></i>
		                            </div>
		                          </div>

		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-1">
		                            <button type="submit" class="btn btn-orange btn-block px-4 btn-bold mt-2 mb-4" id="btn_recuperar_pass">
		                              Continuar
		                            </button>
		                          </div>
		                        </form>


		                        <div class="form-row w-100">
		                          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

		                            <hr class="brc-default-l2 mt-0 mb-2 w-100" />

		                            <div class="p-0 px-md-2 text-dark-tp4 my-3">
		                              <a class="text-blue-d1 text-600 btn-text-slide-x" data-toggle="tab" data-target="#id-tab-login" href="#">
		                                <i class="btn-text-2 fa fa-arrow-left text-110 align-text-bottom mr-2"></i>Atrás para iniciar sesión
		                              </a>
		                            </div>

		                          </div>
		                        </div>
	                      	</div>

	                      	<div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-cambiarpass" data-swipe-prev="#id-tab-cambio">
		                        <div class="position-tl ml-3 mt-2">
		                          <a href="#" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp" data-toggle="tab" data-target="#id-tab-cambio">
		                            <i class="fa fa-arrow-left"></i>
		                          </a>
		                        </div>

		                        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5 px-0">
		                          <h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l2 pb-1 text-130">
		                            <i class="fa fa-key text-brown-m1 mr-1"></i>
		                            Cambiar contraseña
		                          </h4>
		                        </div>

		                        <form autocomplete="off" class="form-row mt-4" id="cambiar_pass">
		                          	<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
			                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
			                              <input placeholder="Password" type="password" class="form-control form-control-lg pr-4 shadow-none" required="" id="password" name="password" />
			                              <i class="fa fa-key text-grey-m2 ml-n4"></i>
			                              <label class="floating-label text-grey-l1 ml-n3" for="password">
			                                Contraseña
			                              </label>
			                            </div>
			                        </div>								

															<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
			                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
			                              <input placeholder="Confirmar Password" type="password" class="form-control form-control-lg pr-4 shadow-none" required="" id="confirmar_password" name="confirmar_password" />
			                              <i class="fa fa-key text-grey-m2 ml-n4"></i>
			                              <label class="floating-label text-grey-l1 ml-n3" for="confirmar_password">
			                                Confirmar Contraseña
			                              </label>
			                            </div>
			                        </div>

		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-1">
		                            <button type="submit" class="btn btn-orange btn-block px-4 btn-bold mt-2 mb-4" id="btn_cambiar_pass">
		                              guardar
		                            </button>
		                          </div>
		                        </form>		                        
	                      	</div>
	                    </div><!-- .tab-content -->
	                  </div>

	                </div><!-- /.row -->

	              </div><!-- /.col -->
	            </div><!-- /.row -->

	            <div class="d-lg-none my-3 text-white-tp1 text-center">
	              <i class="fa fa-leaf text-success-l3 mr-1 text-110"></i> SIGCA &copy; 2021 - 2021
	            </div>
	          </div>
	        </div>

	      </div>

	    </div>



	    <!-- include common vendor scripts used in demo pages -->
	    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

	    <!-- Sweet-Alert  -->
		
			<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->	
			<script src="./plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
			<script src="./plugins/interactjs@1.10.11/dist/interact.min.js"></script>

	    <!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->

	    <!-- include ace.js -->
	    <script src="./dist/js/ace.min.js"></script>

	    <!-- demo.js is only for Ace's demo and you shouldn't use it -->
	    <script src="./dist/js/demo.min.js"></script>

	    <script src="./_js/login.js"></script>
	    <!-- Incluye el script de reCAPTCHA -->		
  	</body>
</html>