<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Inactivo',
    '1'   => 'Activo'
  );
  $opcsexo = array(
    ''    => 'Seleccione un valor',
    'F'   => 'Femenino',
    'M'   => 'Maxculino'
  );

  $opcriesgo = array(
  	'NA'=> 'NA',
    'I'    => 'I',
    'II'   => 'II',
    'III'  => 'III',
    'IV'   => 'IV',
    'V'   => 'V'

  );
    $opcgsanguineo = array(
    ''    => 'Seleccione un valor',
    'A+'   => 'A+',
    'A-'   => 'A-',
    'B+'   => 'B+',
    'B-'   => 'B-',
    'AB+'   => 'AB+',
    'AB-'   => 'AB-',
    'O+'   => 'O+',
    'O-'   => 'O-'
  );
  $opcnacimiento = array(
    '0'   => 'Seleccione el Municipio de Nacimiento '
  );

  $opcresidencia = array(
    '0'   => 'Seleccione el Municipio de Residencia'
  );

  $tipos_usuarios = array(
    '0'   => 'Seleccione un Perfil',
    '1'   => 'Gerente',
    '2'   => 'Coordinadores',
    '3'   => 'Cirujanos',
    '4'   => 'Costos / Contratos',
    '5'   => 'Asistenciales',
    '6'   => 'Cirugia',
    '7'   => 'Auditoria',
    '8'   => 'Instrumentadoras'
  );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fa fa-users text-dark-l3 mr-1"></i>
          Empleados
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Listado de Empleados
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
			          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" data-toggle="modal" data-target="#newModal" id="btn_nuevo_empleado">
			            <i class="fa fa-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_nuevo_empleado">Nuevo</span>
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
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Cedula</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre del Empleado</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Email</th>
		                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Cargo</th>
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

			    <!-- Modal Nuevo -->
				<div class="modal fade modal-lg" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
					
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header bgc-primary-m1 brc-white">
				        <h5 class="modal-title text-white" id="newModalLabel">
				          Nuevo Empleado
				        </h5>

				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body">
				      	<?= form_open(base_url('a_empleados/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'', 'autocomplete'=>'off')); ?>
				      		<?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
					        <div class="card-body px-2 pb-1">
	                			<div class="form-body">
	                				<div class="form-group row" id="div_identificacion">
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Tipo Documento','Tipo_docidentidad_empleados', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-4">
				                        <?= select_Tipo_docidentidad_tabla('empleados','','form-control " required="1');?>
				                      </div>
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Documento ','cedula', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-4">
				                        <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite el Número de documento', 'maxlength'=>'15', 'class'=>'form-control ', 'required'=>true));?>
				                      </div>
			                    	</div>

			                    	<div class="form-group row" id="div_nombres_apellidos">
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Nombres ','nombres', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-4">
				                        <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Digite los Nombres', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
				                      </div>
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Apellidos','apellidos', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-4">
				                        <?= form_input(array('type'=>'text', 'name'=>'apellidos', 'id'=>'apellidos', 'placeholder'=>'Digite los Apellidos', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
				                      </div>
			                    	</div>
			                    	
			                    	<div class="form-group row" id="div_fechanacimiento_email">
				                    	<div class="col-sm-2 col-form-label text-sm-right pr-0">
				                      	<?= form_label('Fecha de Nacimiento','fecha_nacimiento', array('class'=>'mb-0')); ?>
				                    	</div>
				                    	<div class="col-sm-4">
				                      	<?= form_input(array('type'=>'date', 'name'=>'fecha_nacimiento', 'id'=>'fecha_nacimiento', 'placeholder'=>'Digite la fecha de nacimiento', 'class'=>'form-control col-sm-10 col-md-11', 'required'=>true));?>
                    					</div>
	                    				  <div class="col-sm-2 col-form-label text-sm-right pr-0">
					                        <?= form_label('Email ','email', array('class'=>'mb-0')); ?>
					                      </div>
					                      <div class="col-sm-4">
					                        <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Digite el Email', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
					                      </div>
				                    </div>

                    				<div class="form-group row" id="div_direccion_telefono">
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Dirección ','direccion', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-4">
				                        <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'Digite la Dirección', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
				                      </div>
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Teléfono','telefono', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-4">
				                        <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Teléfono', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
				                      </div>
			                    	</div>

				                    
				                    <div class="form-group row" id="div_cargo">
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Cargo','cargos_empleados', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-10">
				                        <?= select_cargos_tabla('empleados','','select2 form-control col-sm-11 col-md-12');?>
				                      </div>
				                     </div>

				                     <div class="form-group row" id="div_eps_arl">
					                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
					                        <?= form_label('Eps','eps_empleados', array('class'=>'mb-0')); ?>
					                      </div>
					                      <div class="col-sm-4">
					                        <?= select_eps_tabla('empleados','','form-control col-sm-11 col-md-12');?>
					                      </div>
				                     
					                     <div class="col-sm-2 col-form-label text-sm-right pr-0">
					                        <?= form_label('Arl','arl_empleados', array('class'=>'mb-0')); ?>
					                      </div>
					                      <div class="col-sm-4">
					                      	 <?= select_arl_tabla('empleados','','form-control col-sm-11 col-md-12');?>
					                      </div>
				                      </div>

				                    	<div class="form-group row" id="div_gruposanguineo_nivelriesgo">
					                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
					                        <?= form_label('Grupo Sanguineo *','gruposanguineo', array('class'=>'mb-0')); ?>
					                      </div>
					                      <div class="col-sm-2">
					                        <?= form_dropdown('gruposanguineo', $opcgsanguineo, '', 'class="form-control col-sm-11 col-md-12" id="gruposanguineo"');?>
					                      </div>
				                    	
				                    		<div class="col-sm-4 col-form-label text-sm-right pr-0">
						                        <?= form_label('Nivel de Riesgo','nivel_riesgo', array('class'=>'mb-0')); ?>
						                      </div>
					                      <div class="col-sm-4">
					                      	 <?= form_dropdown('nivel_riesgo', $opcriesgo, '', 'class="form-control col-sm-11 col-md-12" id="nivel_riesgo"');?>
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
				                    	<div class="form-group row" id="div_crea_usuario">
					                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
								                  <?= form_label(' Crear Usuario?','ck_crear_usuario', array('class'=>'mb-0','id'=>'lblck_crear_usuario')); ?>
								                </div>
							                  <div class="col-sm-4">
							                     
							                      <label class="col-form-label">
							                       No
							                      </label>
							                        <?= form_input(array('type'=>'checkbox', 'name'=>'ck_crear_usuario', 'id'=>'ck_crear_usuario', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1', 'required'=>true));?> 
							                        <?= form_input(array('type'=>'hidden', 'name'=>'crea_usuario', 'id'=>'crea_usuario', 'value'=>'0'));?>                       
							                      <label class="col-form-label">
							                        Si 
							                      </label>
						                  	</div>
						                  </div>

						                   <div class="form-group row" id="div_perfil">
				                          <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                            <?= form_label('Perfil *','perfil', array('class'=>'mb-0')); ?>
				                          </div>
				                          <div class="col-sm-10">
				                            <?= form_dropdown('perfil', $tipos_usuarios, '0', 'class="form-control col-sm-12 col-md-12" id="perfil"');?>
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
				  </div>
            	</div>	<!-- /.Modal -->

            	<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		                </div>
		                <!-- /.modal-content -->
		            </div>
		            <!-- /.modal-dialog -->
		        </div>
			  </div><!-- /.card-body -->
			</div><!-- /.card -->
		</div><!-- /.col -->
	</div>
</div><!-- /.card -->



