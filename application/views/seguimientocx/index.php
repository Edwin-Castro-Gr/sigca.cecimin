<?php
  //echo $id;
  // $opcinforme = array(
  // 	'' => 'Seleccione el Informe que desea generar',
  //   '1' => 'Cancelaciones',
  //   '2' => 'Curso Quirurgico',
  //   '3' => 'Seguimiento a Pacientes',
  //   '4' => 'Profilaxis Antibiótica',
  //   '5' => 'Medicamentos de Control',
  //   '6' => 'Cambios de Código y Ayudantía'
  // ); 

?>

<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fa fa-cog text-dark-l3 mr-1"></i>
          Seguimiento a Procedimientos Pacientes  
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Listado de general
			        </h3>

			        <div class="mb-2 mb-sm-0">
			        	<div class="row mr-1">
			          
			          <button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
			            <i class="fa fa-database mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_excel">Excel</span>
			          </button>
			           <a href="<?php echo base_url('c_seguimientocx/nuevo')?>">
			          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_nueva_programacion">
			            <i class="fa fa-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_nueva_programacion">Nuevo</span>
			          </button> 
			          </a>

			          <!--<a href="<?php echo base_url('c_programacion/agenda')?>">
			          <button type="button" class="btn btn-yellow px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_agenda_programacion">
			            <i class="fa fa-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_agenda_programacion">Agenda</span>
			          </button>
			          </a> -->
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
			                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre Paciente</th>
			                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre de Especialista</th>
			                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha de Programación</th>			                      
			                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Hora</th>	                      
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
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div><!-- /.col -->
	</div>
</div><!-- /.card --->


<div id="view-registro" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
 	</div> <!-- /.modal-dialog -->		           
</div>

<!-- ***************************************** MODAL EXCEL ************************************************ -->
    <!-- Modal Excel  -->
    <div id="modal_excel" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-success">
                    <h4 class="modal-title text-blue" id="myModalLabel">Seleccione Mes del Reporte </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div>
                <div class="modal-body" id="modalFormBody">
                    <form class="form-horizontal m-t-20" id="modalFormReporte">                     
		                  <div class="form-group row" id="div_informesconsultaII">
                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                          <?= form_label('Seleccione el mes','mensaje', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-6">                    
                          <?= form_input(array('type'=>'month', 'name'=>'meses', 'id'=>'meses', 'class'=>'form-control col-sm-9 col-md-12 '));?>
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
			  



