<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Vigente',
    '1'   => 'Prorogado',
    '2'   => 'Terminado'
  );

  $objeto = array(
    ''    => 'Seleccione una Opción',
    '1'   => 'Prorrogar el Contrato',
    '2'   => 'Modificar el Contrato',
    '3'   => 'Otro'
  );
  
?>

      <input type="hidden" name="opc_pag" id="opc_pag" value="otrosi">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
             Otro Si al Contrato
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('a_contratos/guardarotrosi'), array('id'=>'Form_otrosi', 'name'=>'Form_otrosi', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
            
            <div class="form-body " style=" justify-content:flex-start;" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_contrato));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idusuariocreo', 'id'=>'idusuariocreo', 'value'=>$c_id_usuario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'cedula_empleado', 'id'=>'cedula_empleado', 'value'=>$c_cedula));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'estado_contrato', 'id'=>'estado_contrato', 'value'=>$c_estado));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'jefe_inmediato', 'id'=>'jefe_inmediato', 'value'=>$c_id_jefeinm));?>
              
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

                <div class="form-group row" id="div_objeto">     
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Objeto *','objeto', array('class'=>'mb-0', 'id'=>'lblobjeto')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('objeto', $objeto, '', 'class="form-control " id="objeto"');?>
                  </div>
                </div>

                <div class="form-group row" id="div_observaciones">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-10">
                    <?= form_textarea(array('rows'=>'3', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones correspondientes', 'class'=>'form-control','value'=>''));?>
                  </div>
                </div>
                
              <div class="form-group row" id="div_vigencia_p">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha de Inicio','fechainicio_p', array('class'=>'mb-0', 'id'=>'lblfechainicio_p')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechainicio_p', 'id'=>'fechainicio_p', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>''));?>
                </div>                    

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha final','fechafinal_p', array('class'=>'mb-0', 'id'=>'lblfechafinal_p')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechafinal_p', 'id'=>'fechafinal_p', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>''));?>
                </div>
              </div>
              
              <div class="container " id="div_parte8">
                <div class="col-form-label text-sm-left pr-0">
                   <?= form_label('ANEXOS DEL OTRO SI','anexos', array('class'=>'mb-0')); ?>
                </div>

                <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                  <div class="card-body p-0">
                    <div class="accordion" id="accordionAnexosOtroSi">
                      <div class="card border-0 bgc-green-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading1">
                          <h2 class="card-title bgc-transparent text-green-d2 brc-green">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse1" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                              Anexos

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-green mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>

                        <!-- ACORDION PARA ANEXOS -->
                        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionAnexosOtroSi">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                            <div class="form-group row" id="div_archivo">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?=form_label('Otro Si','archivo', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-8">   
                                <?= form_input(array('type'=>'hidden', 'name'=>'nombre_archivo1', 'id'=>'nombre_archivo1', 'value'=>'Otro Si'));?>                             
                                <?=form_upload(array('type'=>'file', 'name'=>'archivo_otrosi1', 'id'=>'archivo_otrosi1',  'placeholder'=>'Seleccione el Archivo del Otro Si', 'class'=>'form-control ace-file-input col-sm-9 col-md-10')); ?>
                              </div>                              
                            </div>
                          </div>                        
                        
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                            <div class="form-group row" id="div_archivo2">
                              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?=form_label('Otros Anexos','otros', array('class'=>'mb-0')); ?>
                              </div>
                              <div class="col-sm-8">
                                <?= form_input(array('type'=>'hidden', 'name'=>'nombre_archivo2', 'id'=>'nombre_archivo2', 'value'=>'Otro Si'));?>
                                <?=form_upload(array('type'=>'file', 'name'=>'archivo_otrosi2[]', 'id'=>'archivo_otrosi2', 'placeholder'=>'Seleccione el Archivo del Otro Si', 'class'=>'form-control ace-file-input  col-sm-9 col-md-10', 'multiple'=>'multiple')); ?>
                              </div>
                            </div>
                          </div>                          
                        </div><!-- /ACORDION PARA ANEXOS -->

                      </div>
                    </div>
                  </div>
                </div><!-- /.card -->
            </div><!-- /.container -->

              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="offset-md-3 col-md-9 text-nowrap" style=" align-content: center;">
                  <?= form_button(array('type'=>'button', 'id'=>'btn_guardarotrosi', 'name'=>'btn_guardarotrosi', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                  <?= anchor(base_url('a_contratos/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                </div>
              </div>
            </div><!-- /.card-body -->
          <?= form_close(); ?>        
        </div><!-- /.card -->
      </div>
    </div><!-- /.card -->
  </div>
</div><!-- /.card -->
      