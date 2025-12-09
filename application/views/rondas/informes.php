<?php
$servicio = array(
	'00' => 'Seleccione una Opción',
	'1' => 'Cirugía',
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
	'13' => 'Sotano 1',
	'14' => 'Sotano 2',
	'15' => 'Consultorios Médicos Independientes'
);

$opctipo = array(
	'' => 'Seleccione una Opción',
	'1' => 'Acción correctiva',
	'2' => 'Acción Preventiva',
	'3' => 'Oportunidad de mejora'
);
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="informes">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
		<h3 class="card-title text-125 text-primary-d2">
			<i class="fas fa-chart-pie text-dark-l3 mr-1"></i>
			Informes de Rondas
		</h3>
	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
				<div class="card-body px-1 px-md-3">
					<!--form autocomplete="off"-->
					<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
						<h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
							Informe de adherencia de las Rondas
						</h3>
					</div>
					<div class="alert bgc-primary-l4 brc-primary-l1 radius-1 d-flex align-items-center m-2" role="alert">
						<div class="position-tl h-102 m-n1px brc-primary-m2 border-l-5"></div>
						<i class="fas fa-info-circle mr-3 fa-2x text-primary-m3"></i>
						<div>
							Seleccione el tipo de informe que requiere ver
						</div>
					</div>
				</div>
				<div class="card-header p-25 m-0 brc-dark-l3">
					<ul class="w-100 nav nav-fill nav-tabs nav-tabs-simple nav-tabs-static nav-tabs-scroll border-0 px-1 px-md-0" role="tablist">
						<li class="nav-item mr-1px mb-0">
							<a data-toggle="tab" href="#home12" id="home12-tab-btn" class="active border-1 btn btn-outline-light btn-h-light-blue btn-a-blue" role="tab" aria-selected="true">
								<!-- <i class="fa fa-home text-105 mr-3px"></i> -->
								Adherencia por rondas y por Servicio
							</a>
						</li>

						<li class="nav-item mx-1px mb-0">
							<a data-toggle="tab" href="#profile12" id="profile12-tab-btn" class="border-1 btn btn-outline-light btn-h-light-purple btn-a-purple" role="tab" aria-selected="false">
								<!-- <i class="fa fa-user text-105 mr-3px"></i> -->
								Adherencia por Secciones y por preguntas
							</a>
						</li>

						<li class="nav-item mx-1px mb-0">
							<a data-toggle="tab" href="#more12" id="more12-tab-btn" class="border-1 btn btn-outline-light btn-h-light-success btn-a-success" role="tab" aria-selected="false">
								<!-- <i class="fa fa-user text-105 mr-3px"></i> -->
								Informe de no cumplimiento
							</a>
						</li>
					</ul>
				</div>

				<div class="card-body p-0">
					<div class="tab-content tab-sliding px-0 text-grey-d3 border-0">
						<div class="tab-pane show active px-25" id="home12" role="tabpanel" aria-labelledby="home12-tab-btn">
							<div class="card ccard h-100">
								<div class="card-header border-0 text-dark-m2">

									<div class="card-body px-1 px-md-3">

										<!--form autocomplete="off"-->
										<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
											<h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
												Listado de Rondas
											</h3>

											<div class="mb-2 mb-sm-0">
												<div class="form-group row mr-1">
													<div class="col-sm-3">
														<?= form_label('Rango de Fecha','pacientes_programacion', array('class'=>'mb-0')); ?>
													</div>
													<div class="col-sm-3">
														<?= form_input(array('type'=>'text', 'name'=>'fechaStart', 'id'=>'fechaStart', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?>  
														<?= form_input(array('type'=>'hidden', 'name'=>'val_fechaini', 'id'=>'val_fechaini', 'value'=>'0'));?> 
													</div>
													-
													<div class="col-sm-3">
														<?= form_input(array('type'=>'text', 'name'=>'fechaEnd', 'id'=>'fechaEnd', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?> 								
														<?= form_input(array('type'=>'hidden', 'name'=>'val_fechafin', 'id'=>'val_fechafin', 'value'=>'0'));?>                        
                      								</div>
                      								<div class="col-sm-1">
                      									<div class="action-buttons">
                      										<button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_consultar">
																<i id="btn_consultar" class="fa fa-search-plus text-105"></i>
															</button>
														</div>
                      								</div>
												</div>
											</div>
										</div>

										<div class="row" id="result_informe">
											<div class="col-12">
												<table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
													<thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
														<tr>
															<th>.</th>
															<th class="id border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
															<th class="id_servicio border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id_Servicio</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Servicio</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Porcentaje cumplimiento</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Porcentaje no cumplimento</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">No Aplica</th>
															<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acciones</th>
														</tr>
													</thead>

													<tbody class="post-rel">

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane px-25" id="profile12" role="tabpanel" aria-labelledby="profile12-tab-btn">
							<div class="card ccard h-100">
								<div class="card-header border-0 text-dark-m2">
									<div class="card-body px-1 px-md-3">

										<!--form autocomplete="off"-->
										<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
											<h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
												Informes por Secciones y Preguntas
											</h3>

											<div class="mb-2 mb-sm-0">
												<div class="form-group row mr-1">
													
													<div class="col-sm-2">
														<?= form_input(array('type'=>'text', 'name'=>'fechaStartI', 'id'=>'fechaStartI', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?>  
														<?= form_input(array('type'=>'hidden', 'name'=>'val_fechainiI', 'id'=>'val_fechainiI', 'value'=>'0'));?> 
													</div>
													<div class="col-sm-2">
															<?= form_input(array('type'=>'text', 'name'=>'fechaEndI', 'id'=>'fechaEndI', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?> 								
															<?= form_input(array('type'=>'hidden', 'name'=>'val_fechafinI', 'id'=>'val_fechafinI', 'value'=>'0'));?> 
													</div> 													

													<div class="col-sm-3">
														<?= select_rondas_tabla('informesII', '', 'select2 form-control col-sm-4 col-md-10'); ?>
													</div>

													<div class="col-sm-3">
														<?= form_dropdown('servicioII', $servicio, '', 'class="ace-select  w-100 text-grey brc-h-info-m2 form-control" id="servicioII" '); ?>
													</div>
													<div class="col-sm-1">
                      									<div class="action-buttons">
                      										<button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_consultarII">
																<i id="btn_consultarII" class="fa fa-search-plus text-105"></i>
															</button>
														</div>
                      								</div>
												</div>
											</div>
										</div>
										<div class="mt-45 card ccard" id="Accordion">

										</div>
									</div>
								</div>
							</div><!-- /.tab -->							
						</div>
						<div class="tab-pane px-25" id="more12" role="tabpanel" aria-labelledby="more12-tab-btn">
							<div class="card ccard h-100">
								<div class="card-header border-0 text-dark-m2">
									<div class="card-body px-1 px-md-3">

										<!--form autocomplete="off"-->
										<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
											<h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
												Informes de Incumplimiento
											</h3>

											<div class="mb-2 mb-sm-0">
												<div class="form-group row mr-1">
													
													<div class="col-sm-2">
														<?= form_input(array('type'=>'text', 'name'=>'fechaStartII', 'id'=>'fechaStartII', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?>  
														<?= form_input(array('type'=>'hidden', 'name'=>'val_fechainiII', 'id'=>'val_fechainiII', 'value'=>'0'));?> 
													</div>
													<div class="col-sm-2">
															<?= form_input(array('type'=>'text', 'name'=>'fechaEndII', 'id'=>'fechaEndII', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?> 								
															<?= form_input(array('type'=>'hidden', 'name'=>'val_fechafinIII', 'id'=>'val_fechafinIII', 'value'=>'0'));?> 
													</div> 													

													<div class="col-sm-3">
														<?= select_rondas_tabla('informesIII', '', 'select2 form-control col-sm-4 col-md-10'); ?>
													</div>

													<div class="col-sm-3">
														<?= form_dropdown('servicioIII', $servicio, '', 'class="ace-select  w-100 text-grey brc-h-info-m2 form-control" id="servicioIII" '); ?>
													</div>
													<div class="col-sm-1">
                      									<div class="action-buttons">
                      										<button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_consultarIII">
																<i id="btn_consultarIII" class="fa fa-search-plus text-105"></i>
															</button>
														</div>
                      								</div>
												</div>
											</div>
										</div>

										<div class="mt-45 card ccard" id="AccordionIII">

										</div>
									</div>
								</div>
							</div><!-- /.card tab -->
						</div>
					</div>
				</div><!-- /.card -->
			</div>
		</div>
	</div>
</div>

	<!-- Modal Nueva Accion Mejora -->
	<div class="modal fade modal-lg" id="ModalAccionM" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true" >

		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bgc-primary-m1 brc-white">
					<h5 class="modal-title text-white" id="newModalLabel">
						Accion de mejora
					</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<?= form_open(base_url('r_gestion/guardar_accion'), array('id' => 'form_Accion', 'name' => 'form_Accion', 'class' => '', 'autocomplete' => 'off')); ?>
					<?= form_input(array('type' => 'hidden', 'name' => 'idregistro', 'id' => 'idregistro', 'value' => '0')); ?>
					<?= form_input(array('type' => 'hidden', 'name' => 'irespuesta_ronda', 'id' => 'irespuesta_ronda', 'value' => '0')); ?>
					<div class="card-body px-3 pb-1">
						<div class="form-body">

							<div class="form-group row" id="div_Servicio_Ronda">
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Ronda *', 'txtronda', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-10">
									<?= form_input(array('type' => 'text', 'name' => 'txtronda', 'id' => 'txtronda', 'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>
							</div>

							<div class="form-group row" id="div_Servicio_Seccion">
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Seccion *', 'txtseccion', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-4">
									<?= form_input(array('type' => 'text', 'name' => 'txtseccion', 'id' => 'txtseccion',  'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>

								<div class="col-sm-1 col-form-label text-sm-right pr-0">
									<?= form_label('Servicio *', 'txtservicio', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-4">
									<?= form_input(array('type' => 'text', 'name' => 'txtservicio', 'id' => 'txtservicio', 'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>								
							</div>

							<div class="form-group row" id="div_Pregunta">
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Item *', 'txtpregunta', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-10">
									<?= form_textarea(array('rows' => '2', 'name' => 'txtpregunta', 'id' => 'txtpregunta', 'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>	
							</div>	

							<div class="form-group row" id="div_hallazgo">
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Hallazgo *', 'txthallazgo', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-10">
									<?= form_textarea(array('rows' => '2', 'name' => 'txthallazgo', 'id' => 'txthallazgo', 'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>
							</div>	

							<div class="form-group row" id="div_Accion">

								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Tipo de Accion de Mejora *', 'tipo_accion', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-4">
									<?= form_dropdown('tipo_accion', $opctipo, '', 'class="form-control col-sm-9 col-md-10" id="tipo_accion"'); ?>
								</div>
							</div>

							<div class="form-group row" id="div_descripcion">
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Descripción de la Acción ', 'descripcion', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-10">
									<?= form_textarea(array('rows' => '4', 'name' => 'descripcion', 'id' => 'descripcion', 'placeholder' => 'Registre la discripción de la acción de mejora que se requiere', 'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>
							</div>

							<div class="form-group row" id="div_responsable">
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Responsable*', 'empleados_rondas', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-4">
									<?= select_coordinadores_tabla('rondas', '', 'form-control'); ?>
								</div>
								<div class="col-sm-2 col-form-label text-sm-right pr-0">
									<?= form_label('Fecha ejecución', 'txtfechaE', array('class' => 'mb-0')); ?>
								</div>
								<div class="col-sm-4">
									<?= form_input(array('type' => 'date', 'name' => 'txtfechaE', 'id' => 'txtfechaE',  'class' => 'form-control col-sm-9 col-md-10')); ?>
								</div>
							</div>
						</div><!-- /.Form-body Modal-->
					</div><!-- /.card-body Modal-->

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary " id="btn_guardar_accion" name="btn_guardar_accion">
							Guardar
						</button>
						<button type="submit" class="btn btn-primary " id="btn_actualizar_accion" name="btn_actualizar_accion">
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
	</div> <!-- /.Modal -->

	<!--// MODAL DE GRAFICAS //-->
	<div class="modal fade modal-fs" id="ModalGrafica" tabindex="-1" role="dialog" aria-labelledby="newModalGraficaLabel" aria-hidden="true" style="z-index: 1600">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header bgc-primary-m1 brc-white">
					<h5 class="modal-title text-white" id="newModalGraficaLabel">
						Grafica
					</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<div class="form-group row">
						<div class="col-sm-12 col-md-6 col-lg-4">
							<div class="card ccard h-100">
								<div class="card-header border-0 text-dark-m2">
									<h4 class="text-120" id="titleRonda">
										Ronda
									</h4>
							
								</div>

								<div class="card-body">
																		
									<div id="grafica"  class="col-sm-12 col-md-10 col-lg-8"> </div>
																		
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<h4 class="text-120" id="titleData">
								Detalle de la Adherencia
							</h4>
							<div class="mt-45 card ccard" id="AccordionII">
							</div>
						</div>
					</div><!-- /.Modal-body -->
				</div> <!-- /.modal-content -->
			</div>
		</div>
	</div> <!-- /.Modal -->

	<!--// MODAL DE DETALLE //-->
	<div class="modal fade modal-xl" id="Modaldetalle" tabindex="-1" role="dialog" aria-labelledby="newModalDetalleLabel" aria-hidden="true" style="z-index: 1900">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header bgc-primary-m1 brc-white">
					<h5 class="modal-title text-white" id="newModalDetalleLabel">
						Detalle
					</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<div class="row justify-content-center">
						<div class="card ccard">
							<div class="card-body">
								<div class="pos-det" id="pos-det">
									
								</div>
							</div>
						</div>

					</div>
				</div><!-- /.Modal-body -->
			</div> <!-- /.modal-content -->
		</div>
	</div> <!-- /.Modal -->

	<!--// MODAL EVIDENCIA //-->
	<div class="modal fade modal-xl" id="ModalEvidencia" tabindex="-1" role="dialog" aria-labelledby="newModalDetalleLabel" aria-hidden="true" style="z-index: 1900">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header bgc-primary-m1 brc-white">
					<h5 class="modal-title text-white" id="newModalDetalleLabel">
						EVIDENCIA
					</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<div class="row justify-content-center">
						<div class="card ccard">
							<div class="card-body">
								<div class="pos-img" id="pos-img">
									<div class="form-group row" id="Imagen">
										<img src="" class="img-thumbnail" alt="Imagen Evidencia" id= "imgEvidencia">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.Modal-body -->
			</div> <!-- /.modal-content -->
		</div>
	</div> <!-- /.Modal -->
