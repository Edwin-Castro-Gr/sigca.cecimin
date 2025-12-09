<input type="hidden" name="opc_pag" id="opc_pag" value="consultas">
<div class="card acard mt-2 mt-lg-3">
	<div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fa fa-cog text-dark-l3 mr-1"></i>
          Consultas
        </h3>
    </div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="card dcard">
			  <div class="card-body px-1 px-md-3">

			    <!--form autocomplete="off"-->
			      <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
			        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
			          Consultas de Contratos Terceros
			        </h3>

			        <div class="mb-2 mb-sm-0">
			        	<div class="row mr-1">
			        	 <!-- <button type="button" class="btn btn-warning px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1 ml-2" id="btn_consulta_todos">
			            <i class="fa fa-search-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_consulta_todos">Excel Documentos pedientes</span>
			          </button> -->
			         <!--  <button type="button" class="btn btn-secondary px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1 ml-2" id="btn_pdf">
			            <i class="fa fa-file-pdf mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_pdf">Por Contratos</span>
			          </button> -->
			         <button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_consulta_general">
			            <i class="fa fa-database mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_consulta_general">Listado general</span>
			          </button>
			            <!-- <a href="<?php echo base_url('a_contratos/nuevo')?>">
			          <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_nueva_solicitud">
			            <i class="fa fa-plus mr-1"></i>
			            <span class="d-sm-none d-md-inline" id="btn_nuevo_contrato">Nuevo</span>
			          </button>
			          </a> -->
			          </div>
			        </div>
			      </div>

			     <div class="page-content container container-plus">
            <div class="page-header">
              <h1 class="page-title text-primary-d2">
                Listado de Documentos
                <small class="page-info text-secondary-d2">
                  <i class="fa fa-angle-double-right text-80"></i>
                  por Contratos terceros
                </small>
              </h1>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card bcard radius-2px overflow-hidden">
                  <div class="card-body p-1px bgc-dark-l4 border-b-1 brc-primary-m4">
                    <div class="row">
                      <div class="col-12">
                        <div class="bgc-white">
                          <table id="grid-table1" class="table border-0 table-bordered brc-black-tp11 bgc-white">
                            <!-- grid -->
                          </table>
                          <div id="grid-pager1"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="container " id="div_parte9">
	            <div class="col-form-label text-sm-left pr-0">
	              <b><?= form_label('LISTADO DE DOCUMENTOS POR CONTRATO','contratosdp', array('class'=>'mb-0')); ?></b>
	            </div>
	            <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
	              <div class="card-body p-0">
	                <div class="accordion" id="documentoscontratost">                  


	                </div>
	              </div>
	            </div><!-- /.card -->
	          </div><!-- /.card -->


          </div>
			    <!--/form-->

			      	<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		            <div class="modal-dialog">
		                <div class="modal-content">
		                    <div class="modal-header card-success">
		                        <h4 class="modal-title text-blue" id="myModalLabel">Tipo de Consulta</h4>
		                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div>
		                    <div class="modal-body" id="modalFormBody">
		                        <form class="form-horizontal m-t-20" id="modalForm1">
		                        </form>
		                    </div>
		                    <div class="modal-footer">
		                    	<button type="submit" class="btn btn-primary " id="btn_consultar" name="btn_consultar">
                   				 Consultar
                  				</button> 
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



