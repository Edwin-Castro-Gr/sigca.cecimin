
<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
	    <base href="../" />

	    <title>SIGCA</title>

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
	    <link rel="stylesheet" type="text/css" href="../dist/css/ace.min.css">

	    <!-- favicon -->
	    <link rel="icon" type="image/png" href="../assets/favicon.png" />

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
  		<input type="hidden" name="opc_pag" id="opc_pag" value="cambiar">
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
		                            Cambiar Contraseña
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
		                          Cambio de Contraseña
		                        </div>

		                        <!-- PARA MOVIL y DESKTOP -->
		                        <form autocomplete="off" action="<?=base_url('login/actualizar_clave')?>" class="form-row mt-4" id="cambioPassform" name="cambioPassform">
		                        	<?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_usuario));?>                        	
		                        
		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
		                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
		                              <input placeholder="Password" type="password" class="form-control form-control-lg pr-4 shadow-none" required="" id="password" name="password" />
		                              <i class="fa fa-key text-grey-m2 ml-n4"></i>
		                              <label class="floating-label text-grey-l1 ml-n3" for="id-login-password">
		                                Contraseña
		                              </label>
		                            </div>
		                          </div>
								

								<div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
		                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
		                              <input placeholder="Confirmar Password" type="password" class="form-control form-control-lg pr-4 shadow-none" required="" id="confirmar_password" name="confirmar_password" />
		                              <i class="fa fa-key text-grey-m2 ml-n4"></i>
		                              <label class="floating-label text-grey-l1 ml-n3" for="confirma_password">
		                                Confirmar Contraseña
		                              </label>
		                            </div>
		                        </div>

		                        <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
		                            <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
		                            	<div class="mb-1">
	                        				<label align="justify">
	                          					<input type="checkbox" class="mr-2" id="poli_protdatos" name="poli_protdatos" required="required"/><font size="2" color="black">Declaro que he sido informado que CECIMIN S.A.S es el responsable del tratamiento de los datos personales y que he leído la Política de Tratamiento de Datos Personales, por lo tanto autorizo a CECIMIN S.A.S el tratamiento de mis datos personales.</font>                      				 
	                        				</label>
	                        				<a href="<?=base_url('Politica_de_privacidad_y_tratamiento_de_datos_personales.pdf')?>"><font size="2">Ver Política de Protección y Tratamiento de Datos.</font></a>
                     					</div>
		                            </div>
		                        </div>
		                          <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		                            <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4" id="btn_actualizar">
		                              Guardar
		                            </button>
		                          </div>
		                        </form>


		                        <div class="form-row">
		                          <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">
		                            <hr class="brc-default-l2 mt-0 mb-2 w-100" />
		                          </div>
		                        </div>
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
		<script src="../plugins/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
		<script src="../plugins/interactjs@1.10.11/dist/interact.min.js"></script>

	    <!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->

	    <!-- include ace.js -->
	    <script src="../dist/js/ace.min.js"></script>

	    <!-- demo.js is only for Ace's demo and you shouldn't use it -->
	    <script src="../dist/js/demo.min.js"></script>

	    <script src="../_js/login.js"></script>
  	</body>
</html>