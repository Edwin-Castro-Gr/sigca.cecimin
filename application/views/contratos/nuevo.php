<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Vigente',
    '1'   => 'Prorogado',
    '2'   => 'Terminado'
  );
  
  $opcestado = array(
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
 
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Nuevo Contrato
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('a_contratos/guardarNuevo'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_tipocontratos', 'id'=>'id_tipocontratos', 'value'=>''));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_funcionario', 'id'=>'id_funcionario', 'value'=>''));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_cargos', 'id'=>'id_cargos', 'value'=>''));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_centroscostos', 'id'=>'id_centroscostos', 'value'=>''));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_lineacostos', 'id'=>'id_lineacostos', 'value'=>''));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_departamentos', 'id'=>'id_departamentos', 'value'=>''));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'id_jefeinmed', 'id'=>'id_jefeinmed', 'value'=>''));?>   
              <?= form_input(array('type'=>'hidden', 'name'=>'id_prorroga', 'id'=>'id_prorroga', 'value'=>''));?>  
              <?= form_input(array('type'=>'hidden', 'name'=>'fecha_inicio', 'id'=>'fecha_inicio', 'value'=>''));?>   
              <?= form_input(array('type'=>'hidden', 'name'=>'fecha_final', 'id'=>'fecha_final', 'value'=>''));?>    

                <div class="form-body " style=" justify-content:flex-start;" >
                  <div class="col-12 col-sm-12 cards-container">
                    <div class="card ">
                      <div class="card-body p-0">
                        <div class="form-group row mt-2 px-3" id="div_Ingreso_Personal">
                          <div class="col-sm-3 col-form-label text-sm-left pr-0">
                            <?= form_label('Seleccione el Ingreso*','ingresosp_contratos', array('class'=>'mb-0')); ?>
                          </div>
                          <div class="col-sm-8">
                            <?= select_ingresosp_tabla('contratos','','form-control col-sm-4 col-md-6');?>
                          </div>
                        </div>
                      </div><!-- /.card-body -->
                     </div><!-- /.card -->

                    <section id="div_newContrato">    
                      <div class="card">
                        <div class="card-header">
                          <h5 class="card-title">
                            Datos del ingreso
                          </h5>
                        </div><!-- /.card-header -->

                        <div class="card-body p-0">

                          <div class="form-group row mt-2 px-3" id="div_tipo">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Tipo Contrato *','tipocontratos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'tipocontratos', 'id'=>'tipocontratos', 'class'=>'form-control col-sm-11 col-md-12','disabled'=>true));?>
                                                         
                            </div>                 
                            
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Cedula','cedula_empleado', array('class'=>'mb-0'));?>
                            </div>
                            <div class="col-sm-3">
                              <?= form_input(array('type'=>'text', 'name'=>'cedula_empleado', 'id'=>'cedula_empleado', 'placeholder'=>'', 'class'=>'form-control col-sm-11 col-md-12','disabled'=>true));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'idfuncionario', 'id'=>'idfuncionario', 'value'=>''));?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_funcionario">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Nombres y Apellidos','nombre_empleado', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'nombre_empleado', 'id'=>'nombre_empleado', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ','disabled'=>true));?>
                            </div> 
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Cargo *','cargos', array('class'=>'mb-0')); ?>
                            </div>
                              <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'cargos', 'id'=>'cargos', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ','disabled'=>true));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'idcargos', 'id'=>'idcargos', 'value'=>''));?>
                            </div>                   
                          </div>

                          <div class="form-group row" id="div_sesion3">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Centro de Costos','centroscostos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'centroscostos', 'id'=>'centroscostos', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ','disabled'=>true));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'idcentroscostos', 'id'=>'idcentroscostos', 'value'=>''));?>
                            </div>  
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Linea de Costos','lineacostos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'lineacostos', 'id'=>'lineacostos', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ','disabled'=>true));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'idlineacostos', 'id'=>'idlineacostos', 'value'=>''));?>
                            </div>                   
                          </div>

                          <div class="form-group row" id="div_sesion4">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Departamentos','departamentos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'departamentos', 'id'=>'departamentos', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ','disabled'=>true));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'iddepartamentos', 'id'=>'iddepartamentos', 'value'=>''));?>
                            </div>
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Jefe inmediato *','jefeinmed', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                              <?= form_input(array('type'=>'text', 'name'=>'jefeinmed', 'id'=>'jefeinmed', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 ','disabled'=>true));?>
                              <?= form_input(array('type'=>'hidden', 'name'=>'idjefeinmed', 'id'=>'idjefeinmed', 'value'=>''));?>
                            </div>
                          </div>

                          <div class="form-group row" id="div_sesion5">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Fecha de Inicio *','fecha_inicio', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-2">
                              <?= form_input(array('type'=>'date', 'name'=>'fecha_inicio', 'id'=>'fecha_inicio', 'placeholder'=>'Digite la fecha', 'class'=>'form-control','disabled'=>true));?>
                            </div> 
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Fecha final','fecha_final', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                            </div>
                            <div class="col-sm-2">
                              <?= form_input(array('type'=>'date', 'name'=>'fecha_final', 'id'=>'fecha_final', 'placeholder'=>'Digite la fecha', 'class'=>'form-control','disabled'=>true));?>
                            </div> 
                          </div>  
                          
                          <div class="container " id="div_parte7">                    
                            <div class="col-form-label text-sm-left pr-0">
                               <?= form_label('ANEXOS DEL CONTRATO','anexos', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                              <div class="card-body p-0" id="accordionA">
                                <!--div class="accordion" id="accordionAnexos">    
                                </div-->
                              </div>
                            </div><!-- /.card -->
                          </div><!-- /.card -->  

                          
                          <div class="form-group row" id="div_sesion5">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                              <?= form_label('Prorroga Automatica','prorroga', array('class'=>'mb-0', 'id'=>'lblprorroga')); ?>
                            </div>
                            <div class="col-sm-4">
                              <label  class="col-form-label">
                               No
                              </label>
                                <?= form_input(array('type'=>'checkbox', 'name'=>'prorroga', 'id'=>'prorroga', 'class'=>'ace-switch  input-md text-grey-l1 brc-primary-d1', 'required'=>true));?>
                                <?= form_input(array('type'=>'hidden', 'name'=>'idprorroga', 'id'=>'idprorroga', 'value'=>'0'));?>
                              <label class="col-form-label">
                                Si 
                              </label>
                            </div>
                          </div>
                      
                        </div><!-- /.card-body -->
                      </div><!-- /.card -->
                    </section> 

                     <section id="div_oldContrato">
                        <div class="card">
                           <div class="card-header">
                             <h5 class="card-title">
                               Datos del Contrato
                             </h5>
                           </div><!-- /.card-header -->

                        <div class="card-body p-0">
                           <div class="form-group row" id="div_tipo">
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Tipo Contrato *','tiposcontratos_contratosC', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= select_tiposcontratos_tabla('contratosC','','form-control');?>
                             </div>                 
                             <?= form_input(array('type'=>'hidden', 'name'=>'idfuncionarioC', 'id'=>'idfuncionarioC', 'value'=>'0'));?>
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Cedula','cedula_empleadoC', array('class'=>'mb-0'));?>
                             </div>
                             <div class="col-sm-3">
                               <?= form_input(array('type'=>'text', 'name'=>'cedula_empleadoC', 'id'=>'cedula_empleadoC', 'placeholder'=>'Digite Cedula del Empleado', 'class'=>'form-control col-sm-11 col-md-12'));?>
                             </div>

                             <div class="col-sm-1">
                               <button type="button" class="btn px-2 btn-outline-primary col-sm-pull-5" id="btn_agregar_empleado" name="btn_agregar_empleado" data-toggle="modal" data-target="#newCempleado" >
                                 +                 
                               </button>
                             </div>
                           </div>

                           <div class="form-group row" id="div_funcionario">
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Nombres y Apellidos','nombre_empleadoC', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= form_input(array('type'=>'text', 'name'=>'nombre_empleadoC', 'id'=>'nombre_empleadoC', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true));?>
                             </div> 
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Cargo *','cargos_contratosC', array('class'=>'mb-0')); ?>
                             </div>
                               <div class="col-sm-4">
                               <?= select_cargos_tabla('contratosC','','select2 form-control" required="1');?>
                             </div>                   
                           </div>

                           <div class="form-group row" id="div_sesion3">
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Centro de Costos','centroscostos_contratosC', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= select_centroscostos_tabla('contratosC','','form-control');?>
                             </div>  
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Linea de Costos','lineacostos_contratosC', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= select_lineacostos_tabla('contratosC','','form-control');?>
                             </div>                   
                           </div>

                           <div class="form-group row" id="div_sesion4">
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Departamentos','departamentosC', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                                 <?= select_areas_tabla('contratosC','','form-control');?>
                             </div>
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Jefe inmediato *','coordinador_jefeinmed', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= select_coordinadores_tabla('jefeinmed','','select2 form-control ');?>
                             </div>                             
                           </div>

                           <div class="form-group row" id="div_sesion5">
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Fecha de Inicio *','fechainicioC', array('class'=>'mb-0' )); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= form_input(array('type'=>'date', 'name'=>'fechainicioC', 'id'=>'fechainicioC', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true));?>
                             </div> 
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Estado *','estadoC', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= form_dropdown('estadoC', $opciones, '0', 'class="form-control " id="estadoC"');?>
                             </div>
                           </div>  

                           <div class="form-group row" id="div_sesion6">
                             <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Fecha final','fechafinalC', array('class'=>'mb-0', 'id'=>'lblfechafinalC')); ?>
                             </div>
                             <div class="col-sm-4">
                               <?= form_input(array('type'=>'date', 'name'=>'fechafinalC', 'id'=>'fechafinalC', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true));?>
                             </div>                    
                           </div>    

                           <div class="form-group row" id="div_sesion6">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Prorroga Automatica','prorrogaC', array('class'=>'mb-0', 'id'=>'lblprorrogaC')); ?>
                             </div>
                             <div class="col-sm-4">
                               <label  class="col-form-label">
                                No
                               </label>
                                 <?= form_input(array('type'=>'checkbox', 'name'=>'prorrogaC', 'id'=>'prorrogaC', 'class'=>'ace-switch  input-md text-grey-l1 brc-primary-d1', 'required'=>true));?>
                                 
                               <label class="col-form-label">
                                 Si 
                               </label>
                             </div>
                           </div> 

                          <div class="container" id="div_parte8.1">
                            <div class="bgc-info-d3 text-white brc-white p-15 ">
                              <?= form_button(array('type'=>'button', 'id'=>'btn_agregar_contrato', 'name'=>'btn_agregar_contrato', 'content'=>'<i class="fa fa-plus mr-1"></i>Agregar Contrato', 'class'=>'btn btn-lighter-success btn-bold px-4')); ?>       
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

                                    <div id="collapseAnexos" class="collapse" aria-labelledby="heading'" data-parent="#accordioContratos">             
                                      <div class="card-body pt-1 text-dark-m1 border-l-3 brc-red bgc-red-l5"> 
                          
                                        <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                                          <div class="card-body p-0">
                                            <div class="accordionC" id="accordioContratos">
                                                                                 
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

                           <div class="container " id="div_parte7">                    
                             <div class="col-form-label bgc-info-d3 text-white brc-white p-15 text-sm-left pr-0">
                                <?= form_label('ANEXOS DEL CONTRATO','anexos', array('class'=>'mb-0')); ?>
                             </div>
                             <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                               <div class="card-body p-0" id="accordionAC">
                                 
                               </div>
                             </div><!-- /.card -->
                           </div><!-- /.card -->  

                           </div><!-- /.card-body -->
                        </div><!-- /.card -->           

                    </section> 
                </div><!-- /.cards-container -->
         

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('a_contratos/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>

                </div><!-- /.card-body -->
              <?= form_close(); ?>
            </div><!-- /.card -->
          </div>
        </div><!-- /.card -->
      </div>
    
<!-- ***************************************** MODAL NUEVO EMPLEADO ************************************************ -->
    <!-- Modal Nuevo Tercero -->
      <div class="modal fade modal-lg" id="newCempleado" role="dialog" aria-labelledby="newModalLabelemp" aria-hidden="true">
          
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabelemp">
                Nuevo Tercero
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('a_contratos/guardar_empleado'), array('id'=>'form_guardarempleado', 'name'=>'form_guardarempleado', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_identificacion">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Documento','tipodocidentidad', array('class'=>'mb-0')); ?>
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
                      <div class="col-sm-4 input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                         <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Teléfono', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                      </div>
                    </div>

                    
                    <div class="form-group row" id="div_cargo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cargo','cargo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= select_cargos_tabla('empleados','','form-control col-sm-11 col-md-12');?>
                      </div>
                     </div>

                     <div class="form-group row" id="div_eps_arl">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Eps','eps', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= select_eps_tabla('empleados','','form-control col-sm-11 col-md-12');?>
                        </div>
                     
                       <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Arl','arl', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                           <?= select_arl_tabla('empleados','','form-control col-sm-11 col-md-12');?>
                        </div>
                      </div>

                    <div class="form-group row" id="div_gruposanguineo_nivelriesgo">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Grupo Sanguineo *','grupo_sanguineo', array('class'=>'mb-0')); ?>
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
                  </div><!-- /.Form-body Modal-->
                </div><!-- /.card-body Modal-->

                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btn_guardar_empleado" name="btn_guardar_empleado">
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
      </div>  <!-- /.Modal -->

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
                <?= form_input(array('type'=>'hidden', 'name'=>'idreg_contrato', 'id'=>'idreg_contrato', 'value'=>''));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'cedulaempleadoC', 'id'=>'cedulaempleadoC', 'value'=>''));?>
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
                  <button type="button" class="btn btn-primary " id="btn_guardar_documento" name="btn_guardar_documento">
                    Guardar
                  </button>
                  <button type="button" class="btn btn-primary " id="btn_actualizar_documento" name="btn_actualizar_documento">
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
