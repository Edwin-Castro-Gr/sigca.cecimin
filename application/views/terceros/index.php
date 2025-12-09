<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
  $opctipotercero = array(
    ''    => 'Seleccione un valor',
    '0'   => 'Proveedor',
    '1'   => 'Cliente'
  );

  $opccritico = array(
    '0'   => 'No',
    '1'   => 'Si',
    
  );

  $opcresidencia = array(
    '0'   => 'Seleccione el Municipio de Residencia'
  );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
    <h3 class="card-title text-125 text-primary-d2">
      <i class="fas fa-users-cog text-dark-l3 mr-1"></i>
      Terceros
    </h3>
  </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">
			    <!--form autocomplete="off"-->
		      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
		        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
		          Listado de Terceros
		        </h3>

		        <div class="mb-2 mb-sm-0">
		        	<div class="row mr-1">
		          <button type="button" class="btn btn-secondary px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1 ml-2" id="btn_pdf">
		            <i class="fa fa-file-pdf mr-1"></i>
		            <span class="d-sm-none d-md-inline" id="btn_pdf">PDF</span>
		          </button>
		          <button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
		            <i class="fa fa-database mr-1"></i>
		            <span class="d-sm-none d-md-inline" id="btn_excel">Excel</span>
		          </button>
		          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" data-toggle="modal" data-target="#newModal" id="btn_nuevo_tercero">
		            <i class="fa fa-plus mr-1"></i>
		            <span class="d-sm-none d-md-inline" id="btn_nuevo_tercero">Nuevo</span>
		          </button>
		          </div>
		        </div>
		      </div>

		      <div class="row">
		      	<div class="col-12">
			      	<table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
			        	<thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
				        	<tr>
					          <th>.</th>
					          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
					          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Tipo Tercero</th>
                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Identificación</th>
                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Razón Social</th>
                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Telefono</th>
                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Email</th>
                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
		              </tr>
			        	</thead>
			        <tbody class="pos-rel">
			          
			        </tbody>
			      </table>
			  	</div>
			  </div>
			    <!--/form-->

			    <!-- Modal Nuevo Tercero-->
				<div class="modal fade modal-lg" id="newModal" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">					
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header bgc-primary-m1 brc-white">
				        <h5 class="modal-title text-white" id="newModalLabel">
				          Nuevo Tercero
				        </h5>

				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      	<?= form_open(base_url('a_terceros/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'', 'autocomplete'=>'off')); ?>
				      		<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
					        <div class="card-body px-2 pb-1">
	                	<div class="form-body">

	                    <div class="form-group row" id="div_tipo_tercero">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Tipo Tercero *','tipo_tercero', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-4">
	                        <?= form_dropdown('tipo_tercero', $opctipotercero, '', 'class="form-control col-sm-11 col-md-12" id="tipo_tercero"');?>
	                      </div>
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
			                    <?= form_label('Material Qx','lblck_materialqx', array('class'=>'mb-0','id'=>'lblck_materialqx')); ?>
			                  </div>
			                  <div class="col-sm-4" id="ck_materialqx">					                     
		                      <label class="col-form-label" id="ck_no">
		                       No
		                      </label>
		                        <?= form_input(array('type'=>'checkbox', 'name'=>'ck_materialqx', 'id'=>'ck_materialqx', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1', 'required'=>true));?>  
		                        <?= form_input(array('type'=>'hidden', 'name'=>'materialqx', 'id'=>'materialqx', 'value'=>''));?>                      
		                      <label class="col-form-label" id="ck_si">
		                        Si 
		                      </label>
			                  </div>
                    	</div>

              				<div class="form-group row" id="div_identificacion">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Tipo Documento','tipodocidentidad', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-4">
	                        <?= select_Tipo_docidentidad_tabla('terceros','','form-control " required="1');?>
	                      </div>
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Documento ','numeroid', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-4">
	                        <?= form_input(array('type'=>'text', 'name'=>'numeroid', 'id'=>'numeroid', 'placeholder'=>'Digite el Numero de documento', 'maxlength'=>'15', 'class'=>'form-control ', 'required'=>true));?>
	                      </div>
	                    </div>

                    	<div class="form-group row" id="div_razon_social">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Razón Social ','razonsocial', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_input(array('type'=>'text', 'name'=>'razonsocial', 'id'=>'razonsocial', 'placeholder'=>'Digite la Razón Social', 'maxlength'=>'100', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
	                      </div>				                      
                    	</div>
			                    	
	                    <div class="form-group row" id="div_nombre_contacto">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Nombre Contacto ','nombre_contacto', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_input(array('type'=>'text', 'name'=>'nombre_contacto', 'id'=>'nombre_contacto', 'placeholder'=>'Digite el nombre del contacto', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
	                      </div>
	                    </div>

											<div class="form-group row" id="div_telefono_contacto">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Telefono de Contacto ','telefono_contacto', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_input(array('type'=>'text', 'name'=>'telefono_contacto', 'id'=>'telefono_contacto', 'placeholder'=>'Digite el telefono de contacto', 'maxlength'=>'20', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="div_correo_contacto">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Email ','correo_contacto', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_input(array('type'=>'email', 'name'=>'correo_contacto', 'id'=>'correo_contacto', 'placeholder'=>'Digite el Email de contacto', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
	                      </div>
	                    </div>

											<div class="form-group row" id="div_sigla">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Sigla ','sigla', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_input(array('type'=>'text', 'name'=>'sigla', 'id'=>'sigla', 'placeholder'=>'Digite la Sigla', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
	                      </div>
	                    </div>	

	                    <div class="form-group row" id="div_proveedorC">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Proveedor Critico ','proveedor_critico', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-10">
	                        <?= form_dropdown('proveedor_critico', $opccritico, '0', 'class="form-control col-sm-11 col-md-12" id="proveedor_critico"');?>
	                      </div>
	                    </div>

	                    <div class="form-group row" id="div_estado">
	                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
	                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
	                      </div>
	                      <div class="col-sm-6">
	                        <?= form_dropdown('estado', $opciones, '1', 'class="form-control col-sm-11 col-md-12" id="estado"');?>
	                      </div>
                    	</div>
			                    	
	                    <div class="container " id="div_parte8">                
			                  <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
			                    <div class="card-body p-0" id="Danexos">
			                      <div class="accordion" id="accordioDCorreos">
			                        <div class="card border-0 bgc-red-l5 post-carg">
			                          <div class="card-header border-0 bgc-transparent mb-0" id="heading_Anexos">
			                            <h2 class="card-title bgc-transparent text-red-d2 brc-red">
			                              <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-red btn-a-outline-red accordion-toggle border-l-3 radius-0 collapsed" href="#collapseAnexos" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAnexos"> <b> CORREOS ADICIONALES</b>
			                              <!-- the toggle icon -->
			                                <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
			                                  <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
			                                </span>
			                                <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-red mr-3 text-center position-rc">
			                                  <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
			                                </span>
			                              </a>
			                            </h2>
			                          </div>   

			                          <div id="collapseAnexos" class="collapse" aria-labelledby="heading'" data-parent="#accordioDCorreos">             
			                            <div class="card-body pt-1 text-dark-m1 border-l-3 brc-red bgc-red-l5"> 			                
			                              <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
			                                <div class="card-body p-0">
			                                  <div class="accordion" id="accordioAdiCorreos">
			                                                                       
			                                  </div>
			                                </div><!-- /.card -->
			                              </div><!-- /.card -->
			                            </div>
			                          </div>
			                        </div>
			                      </div>
			                    </div><!-- /.card -->
			                  </div><!-- /.card -->                  
			                </div>
			                <div class="container" id="div_parte8.0">
			                  <div class="bgc-info-d1 text-white brc-white p-15 col-sm-5" align="text-center" id="div_parte81">
			                    <?= form_button(array('type'=>'button', 'id'=>'btn_nuevo_correo', 'name'=>'btn_nuevo_correo', 'content'=>'<i class="fa fa-plus mr-1"></i>Agregar Correo', 'class'=>'btn btn-lighter-success btn-bold px-4 form-control')); ?>       
			                  </div>
			                </div>
			            	</div><!-- /.Form-body Modal-->
									</div><!-- /.card-body Modal-->

							    <div class="modal-footer">
						        <button type="submit" class="btn btn-primary " id="btn_guardar" name="btn_guardar">
						          Guardar
						        </button>
						        <button type="submit" class="btn btn-primary " id="btn_actualizar" name="btn_actualizar">
						          Actualizar
						        </button>
						        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
						          Cerrar
						        </button>
									</div>
								<?= form_close(); ?>
					    </div><!-- /.Modal-body -->
					  </div> <!-- /.modal-content -->
					</div> <!-- /.modal-dialogo -->
		    </div>	<!-- /.Modal -->

		      <div id="view-registro" class="modal fade in"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  	<div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header card-success">
		              <h4 class="modal-title text-blue" id="myModalLabel">Datos del Registro</h4>
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div>
		            <div class="modal-body" id="modalFormBody">
		              <form class="form-horizontal m-t-20" id="modalForm1">
		              </form>
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="btn_cancelar_modal">Cerrar</button>
		            </div>
		          </div><!-- /.modal-content -->		                
				    </div><!-- /.modal-dialog -->		            
				  </div><!-- /.modal -->	

		      <!-- ************************************* AGREGAR CORREOS *********************************************** -->
		      <div class="modal fade modal-lg" id="agregarcorreos"  tabindex="-1" role="dialog" aria-labelledby="newModalLabelanexo" aria-hidden="true">
		        <div class="modal-dialog" role="document">
		          <div class="modal-content">
		            <div class="modal-header bgc-primary-m1 brc-white">
		              <h5 class="modal-title text-white" id="newModalLabel">
		                Correos Casas Comerciales 
		              </h5>

		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>

		            <div class="modal-body">
		              <?= form_open(base_url('a_terceros/guardar_correos'), array('id'=>'form_guardar_correo', 'name'=>'form_guardar_correo', 'class'=>'', 'autocomplete'=>'off')); ?>
		                <?= form_input(array('type'=>'hidden', 'name'=>'idtercero', 'id'=>'idtercero', 'value'=>'0'));?>
		                <?= form_input(array('type'=>'hidden', 'name'=>'regd', 'id'=>'regd', 'value'=>'0'));?>
		                <div class="card-body px-2 pb-1">
		                  <div class="form-body">
		                    <div class="form-group row" id="div_correo">
		                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
		                        <?= form_label('Correo Electrónico','nombre', array('class'=>'mb-0')); ?>
		                      </div>
		                      <div class="col-sm-9">
		                       <?= form_input(array('type'=>'email', 'name'=>'correo', 'id'=>'correo', 'placeholder'=>'Digite El Correo Electrónico', 'maxlength'=>'100', 'class'=>'form-control UpperCase'));?>
		                      </div>
		                    </div> 
		                  </div><!-- /.Form-body Modal-->
		                </div><!-- /.card-body Modal-->

		                <div class="modal-footer">
		                  <button type="button" class="btn btn-primary " id="btn_guardar_correo" name="btn_guardar_correo">
		                    Guardar
		                  </button>
		                  <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
		                    Cerrar
		                  </button>
		                </div>
		              <?= form_close(); ?>
		            </div><!-- /.Modal-body -->
		          </div> <!-- /.modal-content -->
		        </div>
		      </div><!-- /.card -->
		    </div>  <!-- /.Modal -->


				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div><!-- /.col -->
	</div><!-- /.row -->




