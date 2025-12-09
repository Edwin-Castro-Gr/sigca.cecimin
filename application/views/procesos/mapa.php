<input type="hidden" name="opc_pag" id="opc_pag" value="mapa">
<div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="fa fa-cog text-dark-l3 mr-1"></i>
          MAPA DE PROCESOS
        </h3>
    </div>
    <div class="container">
        <div class="cards-container" style="justify-content: center;">
            <div class="card acard mt-4 mt-lg-4">
                <div class="card-header">
                    <h5 class="card-title">
                    
                    </h5>
                    <div class="card-toolbar">
                        <div class="dropdown">

                            <a class="card-toolbar-btn text-blue" data-toggle="modal" data-target="#MapaImage_modal" href="#">
                                <i class="fa fa-cogs">
                                </i>
                            </a>
                            <a class="card-toolbar-btn text-blue" data-toggle="dropdown" href="#">
                                <i class="fa fa-bars">
                                </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-caret mr-n3 dropdown-animated">
                                <a class="dropdown-item" href="#">
                                    PROCESOS ESTRATEGICOS O DE GESTION
                                </a>
                                <a class="dropdown-item" href="#">
                                    PROCESOS MISIONALES 
                                </a>
                                <hr class="my-1"/>
                                <a class="dropdown-item" href="#">
                                    PROCESOS DE APOYO
                                </a>
                            </div>
                        </div>
                        <a class="card-toolbar-btn text-orange-d3 d-style" data-action="expand" href="#">
                            <i class="fa fa-expand d-n-active">
                            </i>
                            <i class="fa fa-compress d-active">
                            </i>
                        </a>                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <!-- to have smooth .card toggling, it should have zero padding -->
                    <div class="mt-45 bcard card border-0">
                        <div class="card-header card-header-sm  border-0 py-2" style="background-color:#167DA8">
                            <h4 class="card-title text-115 text-white pb-2px">
                                <button class="d-style btn btn-lighter-primary btn-h-outline-white btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-115 text-white-d3 align-items-center" id="btntipodocumentos_M_E">
                                    PROCESOS ESTRATEGICOS O DE GESTION
                                </button>    
                            </h4>
                        </div>
                        <div class="card-body bg-white border-1 border-t-0 brc-primary-m4">
                            <div class="row d-flex mx-1 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-105 text-white align-items-center"  id="btnversubprocesos_1" style="background-color:#167DA8">
                                        <input class="invisible pos-abs" name="proceso_1" type="radio" value="1"/>
                                        GESTION GERENCIAL                                      
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-105 text-white align-items-center" id="btnversubprocesos_2" style="background-color:#167DA8">
                                         <input class="invisible pos-abs" name="proceso_2" type="radio" value="2"/>
                                        CALIDAD Y SEGURIDAD DEL PACIENTE 
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-primary btn-h-outline-blue btn-a-outline-blue btn-a-bgc-white w-100 border-t-3 my-1 py-3 font-bolder text-105 text-white align-items-center"  id="btnversubprocesos_3" style="background-color:#167DA8">
                                       <input class="invisible pos-abs" name="proceso_3" type="radio" value="3"/>
                                        ATENCION AL USUARIO    
                                    </button>
                                </div>
                            </div>
                            <!-- .row.btn-group -->
                        </div>
                        <!-- .card-body -->
                  <!-- to have smooth .card toggling, it should have zero padding -->
                    <div class="mt-45 bcard card border-0">
                        <div class="card-header card-header-sm border-0 py-2" style="background-color:#20A491">
                            <h4 class="card-title text-115 text-white pb-2px">
                                <button class="d-style btn btn-lighter-green btn-h-outline-white btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-115 text-white-d3 " id="btntipodocumentos_M_M">
                                    PROCESOS MISIONALES
                                </button>
                            </h4>
                        </div>
                        <div class="card-body bg-white border-1 border-t-0 brc-green-m4">
                            <div class="row d-flex mx-1 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-green btn-h-outline-black btn-a-outline-black btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_6" style="background-color:#02A48C">
                                         <input class="invisible pos-abs" name="proceso_6" type="radio" value="6"/>
                                        APOYO DIAGNOSTICO                                                
                                        
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-green btn-h-outline-black btn-a-outline-black btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_7" style="background-color:#02A48C">
                                         <input class="invisible pos-abs" name="proceso_7" type="radio" value="7"/>
                                        APOYO TERAPEUTICO                                                 
                                        
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-green btn-h-outline-black btn-a-outline-black btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_4" style="background-color:#02A48C">
                                         <input class="invisible pos-abs" name="proceso_4" type="radio" value="4"/>
                                        CONSULTA EXTERNA                                                
                                      
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2 flex-column align-items-center">
                                    <button class="d-style btn btn-lighter-green btn-h-outline-black btn-a-outline-black btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_5" style="background-color:#02A48C">
                                         <input class="invisible pos-abs" name="proceso_5" type="radio" value="5"/>
                                        CIRUGIA AMBULATORIAS                                                
                                       
                                    </button>
                                </div>
                            </div>
                            <!-- .row.btn-group -->
                        </div>
                        <!-- .card-body -->
                    </div>
                    <!-- .card -->
                    <!-- to have smooth .card toggling, it should have zero padding -->
                    <div class="mt-45 bcard card border-0">
                        <div class="card-header card-header-sm border-0 py-2" style="background-color:#808080">
                            <h4 class="card-title text-115 text-white pb-2px">
                                <button class="d-style btn btn-lighter-grey btn-h-outline-white btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-115 text-gray-d3" id="btntipodocumentos_M_A">
                                    PROCESOS APOYO
                                </button>
                            </h4>
                        </div>
                        <div class="card-body bg-white border-1 border-t-0 brc-grey-m4">
                            <div class="row d-flex mx-1 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-grey btn-h-outline-black btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_9" style="background-color:#808080">
                                         <input class="invisible pos-abs" name="proceso_9" type="radio" value="9"/>
                                        GESTION ADMINISTRATIVA
                                        
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-grey btn-h-outline-black btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_10" style="background-color:#808080">
                                         <input class="invisible pos-abs" name="proceso_10" type="radio" value="10"/>
                                        GESTION DE TALENTO HUMANO 
                                        
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2">
                                    <button class="d-style btn btn-lighter-grey btn-h-outline-black btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_11" style="background-color:#808080">
                                        <input class="invisible pos-abs" name="proceso_11" type="radio" value="11"/>
                                        GESTION FINANCIERA Y CONTABLE
                                        
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2 flex-column align-items-center">
                                    <button class="d-style btn btn-lighter-grey btn-h-outline-black btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 py-3 align-items-center font-bolder text-105 text-white " id="btnversubprocesos_12" style="background-color:#808080">
                                         <input class="invisible pos-abs" name="proceso_12" type="radio" value="12"/>
                                        GESTION DE TECNOLOGIA Y SEGURIDAD DE LA INFORMACION                                                
                                           
                                    </button>
                                </div>
                                <div class="col-12 col-sm-4 px-2 flex-column align-items-center">
                                    <button class="d-style btn btn-lighter-grey btn-h-outline-black btn-a-outline-white btn-a-bgc-white w-100 border-t-3 my-1 mx-0 py-3 align-items-center font-bolder text-105 text-white "  name="btntipodocumentos_P_8" id="btntipodocumentos_P_8" style="background-color:#808080">
                                        <input class="invisible pos-abs" name="proceso_8" type="radio" value="8"/>
                                        SERVICIOS FARMACEUTICO                                               
                                        
                                    </button>
                                </div>
                            </div>
                            <!-- .row.btn-group -->
                        </div>
                        <!-- .card-body -->
                    </div>
                    <!-- .card -->
                    </div>
                <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- With scrollbars inside -->
    <div class="modal fade modal-lg" id="Subprocesos_modal" role="dialog" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title text-blue-d2" id="subproceso">
              Subprocesos
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body ace-scrollbar" id="modal_body">
            
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button> 
          </div>
        </div>
      </div>
    </div> <!-- /. END Modal -->

    

    <!-- With scrollbars inside -->
    <div class="modal fade" id="listtipos_modal"  role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title text-blue-d2">
              Tipos Documentos
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body ace-scrollbar" id="modaltipo_body">
          
          </div>
          
          <div class="modal-footer">
           
          </div>
        </div>
      </div>
    </div> <!-- /. END Modal -->

    <!-- With scrollbars inside -->
    <div class="modal fade" id="listdoc_modal"  role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title text-blue-d2">
              Documentos
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body ace-scrollbar" id="modaldoc_body">
          
          </div>

          <div class="modal-footer">
           
          </div>
        </div>
      </div>
    </div> <!-- /. END Modal -->

    <!-- With scrollbars inside -->
    <div class="modal fade " id="MapaImage_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog   modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title text-blue-d2">
              MAPA DE PROCESOS
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body" id="modal_body">
            <img src="<?= base_url('assets/image/mapa_procesos.png'); ?>" alt=""></i>
          </div>

          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button> -->
          </div>
        </div>
      </div>
    </div> <!-- /. END Modal -->
