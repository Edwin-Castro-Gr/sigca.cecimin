<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Vigente',
    '1'   => 'Terminado',
    '2'   => 'Prorogado'
  );
 
?>
  <input type="hidden" name="opc_pag" id="opc_pag" value="modificar">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Modificar Contrato
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('a_contratos/actualizar'), array('id'=>'form_actualizar', 'name'=>'form_actualizar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_contrato));?>
                 <?= form_input(array('type'=>'hidden', 'name'=>'idingresop', 'id'=>'idingresop', 'value'=>$c_id_ingresop));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idusuariocreo', 'id'=>'idusuariocreo', 'value'=>'0'));?>
                <div class="form-body " style=" justify-content:flex-start;" >

                  <div class="form-group row" id="div_tipo" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tipo Contrato *','tipocontratos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_tiposcontratos_tabla('contratos',$c_id_tipocontrato,'form-control');?>
                    </div>
                  
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Funcionario *','empleados_contratos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_empleados_tabla('contratos',$c_id_funcionario,'select2 form-control ');?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_sesion3">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cargo *','cargos_contratos', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                      <?= select_cargos_tabla('contratos',$c_id_cargo,'form-control" required="1');?>
                      </div>

                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Centro de Costos','centroscostos', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= select_centroscostos_tabla('contratos',$c_id_centrocosto,'form-control');?>
                      </div>
                  </div>

                  <div class="form-group row" id="div_sesion4">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Departamentos','departamentos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= select_areas_tabla('contratos',$c_id_departamento,'form-control');?>
                    </div>

                     <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Jefe inmediato *','empleados_jefeinmed', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_empleados_tabla('jefeinm',$c_id_jefeinm,'select2 form-control ');?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_sesion5">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Prorroga Automatica','prorroga', array('class'=>'mb-0', 'id'=>'lblprorrogaAut')); ?>
                    </div>
                    <div class="col-sm-4">
                      <label>
                       No
                      </label>
                        <?= form_input(array('type'=>'hidden', 'name'=>'idprorroga', 'id'=>'idprorroga', 'value'=>$c_prorroga));?>
                        <?= form_input(array('type'=>'checkbox', 'name'=>'prorroga', 'id'=>'prorroga', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1','checked'=>''));?>
                        
                      <label>
                        Si 
                      </label>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha de Inicio *','fechainicio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>$c_fecha_inicio));?>
                    </div> 
                  </div>  

                  <div class="form-group row" id="div_sesion6">     
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control " id="estado"');?>
                    </div>

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>$c_fecha_final));?>
                    </div>                    
                  </div> 

                  <div class="form-group row" id="div_vigencia_p">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha de Inicio prorroga','fechainicio_p', array('class'=>'mb-0', 'id'=>'lblfechainicio_p')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechainicio_p', 'id'=>'fechainicio_p', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>""));?>
                    </div>                    

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha final prorroga','fechafinal_p', array('class'=>'mb-0', 'id'=>'lblfechafinal_p')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechafinal_p', 'id'=>'fechafinal_p', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>""));?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_observaciones_prorroga">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Observaciones prorroga','observaciones_p', array('class'=>'mb-0', 'id'=>'lblobservaciones_p')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_p', 'id'=>'observaciones_p', 'placeholder'=>'Digite las observaciones de la prorroga', 'class'=>'form-control','value'=>""));?>
                    </div>
                  </div>

                  <div class="container" id="div_parte8.1">
                    <div class="bgc-info-d3 text-white brc-white p-15 ">
                      <?= form_button(array('type'=>'button', 'id'=>'btnAgregarContrato', 'name'=>'btnAgregarContrato', 'content'=>'<i class="fa fa-plus mr-1"></i>Agregar Contrato', 'class'=>'btn btn-lighter-success btn-bold px-4')); ?>       
                    </div>
                  </div>

                  <div class="container " id="div_parte8">                
                    <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                      <div class="card-body p-0" id="Danexos">
                        <div class="accordion" id="accordioDAnexos">
                          <div class="card border-0 bgc-red-l5 post-carg">
                            <div class="card-header border-0 bgc-transparent mb-0" id="heading_Anexos">
                              <h2 class="card-title bgc-transparent text-red-d2 brc-red">
                                <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-red btn-a-outline-red accordion-toggle border-l-3 radius-0 collapsed" href="#collapseAnexos" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAnexos"> <b> RELACION DE CONTRATOS </b>
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

                            <div id="collapseAnexos" class="collapse" aria-labelledby="heading'" data-parent="#accordionContratos">             
                              <div class="card-body pt-1 text-dark-m1 border-l-3 brc-red bgc-red-l5"> 
                  
                                <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                                  <div class="card-body p-0">
                                    <div class="accordionC" id="accordionContratos">
                                                                         
                                    </div>
                                  </div><!-- /.card body-->
                                </div><!-- /.card -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- /.card body-->
                    </div><!-- /.card -->                  
                  </div><!-- /.container -->   
                  <div class="form-group row" id="div_parte9"> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Actualizar anexos','actulizaranexosl', array('class'=>'mb-0', 'id'=>'lblactulizaranexos')); ?>
                    </div>
                    <div class="col-sm-4">
                      <label>No</label>                        
                        <?= form_input(array('type'=>'checkbox', 'name'=>'actulizaranexos', 'id'=>'actulizaranexos', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1','checked'=>''));?> 
                        <?= form_input(array('type'=>'hidden', 'name'=>'idactulizaranexos', 'id'=>'idactulizaranexos', 'value'=>false));?>                       
                      <label>Si</label>
                    </div>
                  </div>
                  <div class="container " id="div_parte10">                    
                    <div class="col-form-label bgc-info-d3 text-white brc-white p-15 text-sm-left pr-0">
                       <?= form_label('ANEXOS DEL CONTRATO','anexos', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                      <div class="card-body p-0" id="accordionA">
                        <!--div class="accordion" id="accordionAnexos">                  


                        </div-->
                      </div>
                    </div><!-- /.card -->
                  </div><!-- /.card -->    

                  <div class="container " id="div_parte11">                    
                    <div class="col-form-label text-sm-left pr-0">
                       <?= form_label('PRORROGAS','prorrogas', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                      <div class="card-body p-0" id="accordionProrroga">
                       
                      </div>
                    </div><!-- /.card -->
                  </div><!-- /.card -->            

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Actualizar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('a_contratos/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>

                </div><!-- /.card-body -->
              <?= form_close(); ?>
            </div><!-- /.card -->
          </div>
        </div><!-- /.card -->
      </div>
    
<!-- ************************************* AGREGAR CONTRATOS *********************************************** -->
      <div class="modal fade modal-lg" id="anexosContratos"  role="dialog" aria-labelledby="newModalLabelanexo" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabel">
                Contratos 
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('a_contratos/agregar_contrato'), array('id'=>'form_guardar_documento', 'name'=>'form_guardar_documento', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idreg_contrato', 'id'=>'idreg_contrato', 'value'=>$c_id_contrato));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'cedulaempleadoC', 'id'=>'cedulaempleadoC', 'value'=>$c_cedula));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_documentos">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Nombre archivo','nombre', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                       <?= form_input(array('type'=>'text', 'name'=>'nombre_archivo', 'id'=>'nombre_archivo', 'placeholder'=>'Digite Nombre del Documento', 'maxlength'=>'100', 'class'=>'form-control UpperCase'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_archivo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Archivo','archivoCont', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                         <?= form_upload(array('type'=>'file', 'name'=>'archivoCont', 'id'=>'archivoCont', 'placeholder'=>'Seleccione el archivo ...', 'class'=>'ace-file-input form-control col-sm-8 col-md-10'));?>
                      </div>
                    </div>                      
                    
                    <div class="form-group row" id="div_vigencia">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha documento','fecha_doc', array('class'=>'mb-0'));?>
                      </div>
                      <div class="col-sm-3">
                        <?=form_input(array('type'=>'date', 'name'=>'fecha_doc', 'id'=>'fecha_doc', 'class'=>'form-control'));?>
                      </div>

                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                          <?= form_label('Fecha fin vigencia','fecha_vigencia', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                        </div>
                        <div class="col-sm-3">
                          <?= form_input(array('type'=>'date', 'name'=>'fecha_vigencia', 'id'=>'fecha_vigencia', 'placeholder'=>'Digite la fecha', 'class'=>'form-control'));?>
                        </div>
                    </div>                  
                  </div><!-- /.form-body Modal-->
                </div><!-- /.card-body Modal-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btnguardar_documentoM" name="btnguardar_documentoM">
                    Guardar
                  </button>
                  <button type="button" class="btn btn-primary " id="btnActualizar_documento" name="btnActualizar_documento">
                    Actualizar
                  </button>
                  <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                    Cerrar
                  </button>
                </div>              
            <?= form_close(); ?>
          </div> <!-- /.Modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.card -->
    </div>  <!-- /.Modal -->      
  </div><!-- /.card -->
