<?php
	//echo $id;
	$opciones = array(
		'0'   => 'Pendiente',
		'1'   => 'Aceptado',
		'2'   => 'Rechazada'
	);
	$opcionesTsolicitud = array(
		'1'   => 'Creación',
		'2'   => 'Modificación',
		'3'   => 'Eliminación'
	);
	$opcionesOrigen = array(
		'0'   => 'N/A',
		'1'   => 'Interno',
		'2'   => 'Externo'
	);

	$opcionesMeses=array(
		''   => 'Seleccione un Mes',
		'1'   => 'Enero',
		'2'   => 'Febrero',
		'3'   => 'Marzo',
		'4'   => 'Abril',
		'5'   => 'Mayo',
		'6'   => 'Junio',
		'7'   => 'Julio',
		'8'   => 'Agosto',
		'9'   => 'Septiembre',
		'10'   => 'Octubre',
		'11'   => 'Noviembre',
		'12'   => 'Diciembre'
	);
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
		<h3 class="card-title text-125 text-primary-d2">
			<i class="fa fa-wrench text-dark-l3 mr-1"></i>
			Solicitudes de Mantenimiento
		</h3>
	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
				<div class="card-body px-1 px-md-3">

					<!--form autocomplete="off"-->
					<div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
						<h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
							Listado de Solicitudes de Mantenimientos
						</h3>

						<div class="mb-2 mb-sm-0">
							<div class="row mr-1">
								<?= form_input(array('type'=>'hidden', 'name'=>'current_year', 'id'=>'current_year', 'value'=>$current_year));?>
								<button type="button" class="btn btn-secondary px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1 ml-2" id="btn_pdf">
									<i class="fa fa-file-pdf mr-1"></i>
									<span class="d-sm-none d-md-inline" id="btn_pdf">PDF</span>
								</button>
								<button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
									<i class="fa fa-database mr-1"></i>
									<span class="d-sm-none d-md-inline" id="btn_excel">Excel</span>
								</button>
								<a href="<?php echo base_url('m_servicios/index')?>">
									<button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_servicios">
										<i class="fa fa-plus mr-1"></i>
										<span class="d-sm-none d-md-inline" id="btn_nueva_solicitud">Requerimientos</span>
									</button>
								</a>

								<a href="<?php echo base_url('m_solicitud/nuevo')?>">
									<button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_nueva_solicitud">
										<i class="fa fa-plus mr-1"></i>
										<span class="d-sm-none d-md-inline" id="btn_nueva_solicitud">Nuevo</span>
									</button>
								</a>
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
										<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Mantenimiento Requerido</th>
										<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Servicio</th>
										<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Ubicación</th>
										<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Solicitante</th>
										<th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha de Solicitud</th>
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

					<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header card-success">
									<h4 class="modal-title text-blue" id="myModalLabel">Datos del Registro</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
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

					<!-- Modal Nuevo  -->
				    <div id="consulta-fecha" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				        <div class="modal-dialog">
				            <div class="modal-content">
				                <div class="modal-header card-success">
				                    <h4 class="modal-title text-blue" id="myModalLabel">Seleccione el Mes y el Años a consultar</h4>
				                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				                </div>
				                <div class="modal-body" id="modalFormBody">
				                  <form class="form-horizontal m-t-20" id="modalFormReporte">
				                    <div class="form-group row" id="div_mensaje">
				                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
				                        <?= form_label('Mes','mes', array('class'=>'mb-0')); ?>
				                      </div>
				                      <div class="col-sm-10">                    
				                        <?= form_input(array('type'=>'month', 'name'=>'mes', 'id'=>'mes', 'class'=>'form-control col-sm-9 col-md-12 ', 'value'=>''));?>
				                      </div>                                       
				                    </div>
				                  </form>
				                </div>
				                <div class="modal-footer">
				                  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="btn_cancelar_modal">Cerrar</button>
				                  <button type="button" class="btn btn-green waves-effect" data-dismiss="modal" id="btn_sucess_modal">Generar</button>
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