<?php
  //echo $id;
  $opciones = array(
    '0'   => 'Vigente',
    '1'   => 'Terminado',
    '2'   => 'Prorrogado'
  );
  $opcareas = array(
    '0'   => 'Asistencial',
    '1'   => 'Administrativa'   
  );

  $opcmanejop= array(
    'Si'   => 'Si',
    'No'   => 'No'
  );

  $opccobro= array(
    '0'   => 'Mensual',
    '1'   => 'Anual',
    '2'   => 'Unica Vez',
    '3'   => 'Trimestral',
    '4'   => 'Sementral'
  );

?>

      <input type="hidden" name="opc_pag" id="opc_pag" value="modificar">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
            Modificar Contrato Tercero
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('d_contratost/actualizar'), array('id'=>'Form_Actualizar', 'name'=>'Form_Actualizar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
            <div class="form-body " style=" justify-content:flex-start;" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idreg', 'id'=>'idreg', 'value'=>$c_id_contrato_tercero));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'usuario_crea', 'id'=>'usuario_crea', 'value'=>$c_id_usuario));?>
              <div class="form-group row" id="div_numeroint" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Numero Contrato*','ncontratolbl', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'ncontrato', 'id'=>'ncontrato', 'placeholder'=>'Digite el numero de contrato', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_n_contrato));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Numero Interno*','numeroint', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'numeroint', 'id'=>'numeroint', 'placeholder'=>'Digite el numero de contrato Interno', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_numeroint));?>
                </div>
              </div>

              <div class="form-group row" id="div_tercero" >
                <?= form_input(array('type'=>'hidden', 'name'=>'idtercero', 'id'=>'idtercero', 'value'=>$c_id_tercero));?>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('NIT Tercero*','tercero', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-3">
                  <?= form_input(array('type'=>'text', 'name'=>'nit', 'id'=>'nit', 'placeholder'=>'Digite el Nit del Tercero', 'class'=>'form-control col-sm-11 col-md-12','value'=>$c_nit_tercero));?>
                </div>

                <div class="col-sm-6">
                  <?= form_input(array('type'=>'text', 'name'=>'razon_social', 'id'=>'razon_social', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_razon_tercero));?>
                </div>
              </div>
              <div class="form-group row" id="div_area_lineacostos" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Area *','areas', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('areas[]', $opcareas, $c_areas, 'class="select2 multiple="multiple form-control style="width: 100%" id="areas"');?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Linea de Costos *','lineacostos_contratost', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_lineacostosM_tabla('contratost',$c_linea_costo,'select2 multiple="multiple form-control');?>
                </div>
              </div>
              <div class="form-group row" id="div_objeto_concepto">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Concepto ','concepto', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_concepto_tabla('contratost',$c_concepto,'select2 multiple="multiple form-control style="width: 100%"');?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Objeto','objeto', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_textarea(array('rows'=>'2', 'name'=>'objeto', 'id'=>'objeto', 'placeholder'=>'Digite el objeto del Contrato', 'class'=>'form-control','value'=>$c_objeto_contrato));?>
                </div>
              </div>

              <div class="form-group row" id="div_observaciones">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones correspondientes', 'class'=>'form-control','value'=>$c_observaciones));?>
                </div>
              </div>

              <div class="form-group row" id="div_vigencia">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha de Inicio','fechainicio', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>$c_fecha_inicio));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'required'=>true,'value'=>$c_fecha_final));?>
                </div>
              </div>

              <div class="form-group row" id="div_valorContrato">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Valor del Contrato *','valor', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'valor', 'id'=>'valor', 'placeholder'=>'', 'maxlength'=>'18', 'required'=>true,'value'=>$c_valor_contrato));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Cobro *','cobro', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('cobro', $opccobro, $c_cobro, 'class="form-control " id="cobro"');?>
                </div>
              </div>
              <div class="form-group row" id="div_responsable" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Responsable *','empleados_contratost', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_empleadosM_tabla('contratost',$c_responsable,'select2 multiple="multiple form-control');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Maneja Tarifa','maneja_tarifa', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-1">
                  <?= form_dropdown('maneja_tarifa', $opcmanejop, $c_maneja_tarifa, 'class="form-control " id="maneja_tarifa"');?>
                </div>
                <div class="col-sm-1 col-form-label text-sm-right pr-0">
                  <?= form_label('Keralty','keralty', array('class'=>'mb-0')); ?> 
                </div>
                <div class="col-sm-1">                  
                  <?= form_dropdown('keralty', $opcmanejop, $c_keralty, 'class="form-control" id="keralty"');?>
                </div>
              </div>

              <div class="form-group row" id="div_entidadkeralty">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Razón Social','razongrupok', array('class'=>'mb-0', 'id'=>'lblrazongrupok')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'razongrupok', 'id'=>'razongrupok', 'placeholder'=>'Empresa del Grupo', 'maxlength'=>'100', 'class'=>'form-control UpperCase', 'required'=>true,'value'=>$c_razon_k));?>
                </div>
                 
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Nit ','nitempgrupo', array('class'=>'mb-0','id'=>'lblnitempgrupo')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'nitempgrupo', 'id'=>'nitempgrupo', 'placeholder'=>'NIT empresa del Grupo', 'maxlength'=>'14', 'class'=>'form-control UpperCase', 'required'=>true,'value'=>$c_nit_k));?>
                </div>
              </div>

              <div class="form-group row" id="div_manejo_personal">     
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Maneja Personal*','maneja_personal', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-1">
                  <?= form_dropdown('maneja_personal', $opcmanejop, $c_maneja_personal, 'class="form-control" id="maneja_personal"');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Se prorroga','prorroga', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-1">
                  <?= form_dropdown('prorroga', $opcmanejop, $c_prorroga, 'class="form-control" id="prorroga"');?>
                </div>
              
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Clausula Sarlaft*','sarlaft', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-1">
                  <?= form_dropdown('sarlaft', $opcmanejop, $c_clausula_sarlaft, 'class="form-control " id="sarlaft"');?>
                </div>
              </div>

              <div class="form-group row" id="div_estado">     
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control " id="estado"');?>
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
                  <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones_p', 'id'=>'observaciones_p', 'placeholder'=>'Digite las observaciones de la prorroga', 'class'=>'form-control','value'=>$c_observaciones));?>
                </div>
              </div>
              <div class="form-group row" id="div_actulizaranexos">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Actualizar anexos','actulizaranexosl', array('class'=>'mb-0', 'id'=>'lblactulizaranexos')); ?>
                </div>
                <div class="col-sm-4">
                  <label class="">No</label>                        
                    <?= form_input(array('type'=>'checkbox', 'name'=>'actulizaranexos', 'id'=>'actulizaranexos', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1','checked'=>'0'));?> 
                    <?= form_input(array('type'=>'hidden', 'name'=>'idactulizaranexos', 'id'=>'idactulizaranexos', 'value'=>false));?>                       
                  <label  class="">Si</label>
                </div>
              </div>

              <div class="container " id="div_parte8">
                <div class="col-form-label text-sm-left pr-0">
                   <?= form_label('ANEXOS DEL CONTRATO','anexos', array('class'=>'mb-0')); ?>
                </div>

                <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                  <div class="card-body p-0">
                    <div class="accordion" id="accordionAnexos">
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
                        <div id="collapse1" class="collapse " aria-labelledby="heading1" data-parent="#accordionAnexos">
                          
                          
                        </div><!-- /ACORDION PARA ANEXOS -->
                      </div>
                    </div>
                  </div>
                </div><!-- /.card -->
            </div><!-- /.container -->

              <br>
              <!-- <div class="form-group row" id="div_actulizar_personal">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Actualizar Personal','actulizarpersonall', array('class'=>'mb-0', 'id'=>'lblactulizarpersonall')); ?>
                </div>
                <div class="col-sm-4">
                  <label class="">No</label>                        
                    <?= form_input(array('type'=>'checkbox', 'name'=>'actulizarpersonal', 'id'=>'actulizarpersonal', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1','checked'=>'0'));?> 
                    <?= form_input(array('type'=>'hidden', 'name'=>'idactulizarpersonal', 'id'=>'idactulizarpersonal', 'value'=>false));?>                       
                  <label  class="">Si</label>
                </div>
              </div> -->
              <div class="container " id="div_parte9">
                <div class="row" id="relacion_personal">
                  <div class="col-12">
                    <h5 class="bgc-primary-d3 text-white brc-white p-15">Personal Contratado</h5>
                    <table id="personal_contratado" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                      <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                        <tr>
                          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">..</th>
                          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">CEDULA</th>
                          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">NOMBRES</th>
                          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">CARGO</th> 
                          <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ACCIONES</th>                      
                        </tr>
                      </thead>

                      <tbody class="pos-rel">
                        
                      </tbody>
                    </table>
                    <div class="bgc-info-d3 text-white brc-white p-15"><?= form_button(array('type'=>'button', 'id'=>'btn_nuevopersonal', 'name'=>'btn_nuevopersonal', 'content'=>'<i class="fa fa-check mr-1"></i>Nuevo Personal', 'class'=>'btn btn-lighter-success btn-bold px-4')); ?></div>
                  </div>
                </div>
              </div>

              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="offset-md-3 col-md-9 text-nowrap">
                  <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                  <?= anchor(base_url('d_contratost/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                </div>
              </div>
            </div><!-- /.card-body -->
          <?= form_close(); ?>        
        </div><!-- /.card -->
      </div>
    </div><!-- /.card -->
  </div>
</div><!-- /.card -->
      <!-- ***************************************** MODAL NUEVO PERSONAL ************************************************ -->
      <div class="modal fade modal-lg" id="newModal" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabel">
                Nuevo Personal
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('d_contratost/guardar_personal_contratado'), array('id'=>'form_guardar_per', 'name'=>'form_guardar_per', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistroP', 'id'=>'idregistroP', 'value'=>$c_id_contrato_tercero));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idpersonal', 'id'=>'idpersonal', 'value'=>""));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'nittercero', 'id'=>'nittercero', 'value'=>$c_numeroint));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'origen', 'id'=>'origen', 'value'=>"1"));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_identificacion">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Doc.','Tipo_docidentidad_empleados', array('class'=>'mb-0')); ?>
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
                      <div class="col-sm-10">
                        <?= form_input(array('type'=>'text', 'name'=>'nombres', 'id'=>'nombres', 'placeholder'=>'Digite los Nombres', 'maxlength'=>'90', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                      </div>                      
                    </div>
                      
                    <div class="form-group row" id="div_cargo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Cargo','cargo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'text', 'name'=>'cargo', 'id'=>'cargo', 'placeholder'=>'Cargo', 'class'=>'form-control', 'required'=>true));?>
                      </div>
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Teléfono','telefono', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'number', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Teléfono', 'class'=>'form-control', 'required'=>true));?>
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

                    <div class="form-group row" id="div_email">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Email','email', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                        <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Email', 'class'=>'form-control', 'required'=>true));?>
                      </div>
                    </div>

                    <div class="container " id="div_parte8">
                        <div class="col-form-label text-sm-left pr-0">
                           <?= form_label('ANEXOS DEL PERSONAL','anexosp', array('class'=>'mb-0')); ?>
                          <label class="text-sm-right mt-1 mt-sm-0 ml-sm-3" id="checkboxActualizarl">
                            <input type="checkbox" class="mr-1" id="checkboxActualizar" />
                            Actualizar Anexos 
                          </label>
                        </div>

                        <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                          <div class="card-body p-0">
                            <div class="accordion" id="accordionAnexosP">
                              <div class="card border-0 bgc-green-l5">
                                <div class="card-header border-0 bgc-transparent mb-0" id="heading2">
                                  <h2 class="card-title bgc-transparent text-green-d2 brc-green">
                                    <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse2" data-toggle="collapse" aria-expanded="false" aria-controls="collapse2">
                                      Anexos Documentos Personal

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
                                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionAnexosP">
                                   
                                  <section id="ListarDocuemtos"></section>   
                                  <section id="CargarDocuemtos"> 
                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo1">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo: Contrato Firmado','lblarchivo_1', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                           
                                          <?= form_upload(array('type'=>'file', 'name'=>'archivo1', 'id'=>'archivo1', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo2">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo: Hoja de Vida','lblarchivo_2', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                         
                                          <?=form_upload(array('type'=>'file', 'name'=>'archivo_2', 'id'=>'archivo_2', 'placeholder'=>'Cargue el Hoja de Vida', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo3">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo: Documento de Identificación','archivo_3', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                          <?=form_input(array('type'=>'hidden', 'name'=>'nomarchivo_3', 'id'=>'nomarchivo_3', 'value'=>''));?>
                                          <?=form_upload(array('type'=>'file', 'name'=>'archivo_3', 'id'=>'archivo_3', 'placeholder'=>'Cargue el Documento de Identificación', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo4">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo: Carnet de Vacunas','archivo_4', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                          
                                          <?=form_upload(array('type'=>'file', 'name'=>'archivo_4', 'id'=>'archivo_16', 'placeholder'=>'Cargue el Carnet de Vacunas', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo5">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo: Certificado en alturas ','archivo_5', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                          
                                          <?=form_upload(array('type'=>'file', 'name'=>'archivo_5', 'id'=>'archivo_5', 'placeholder'=>'Cargue el Certificado en alturas cuando aplique', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo6">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo: Certificado EPS','archivo_6', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                        
                                          <?=form_upload(array('type'=>'file', 'name'=>'archivo_6', 'id'=>'archivo_6', 'placeholder'=>'Cargue el Certificado EPS', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                                      <div class="form-group row" id="div_archivo7">
                                        <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                          <?= form_label('Archivo:Certificado ARL','lblarchivo_7', array('class'=>'mb-0'));?>
                                        </div>
                                        <div class="col-sm-8">
                                         
                                          <?=form_upload(array('type'=>'file', 'name'=>'archivo_7', 'id'=>'archivo_7', 'placeholder'=>'Cargue el Certificado ARL', 'class'=>'form-control ace-file-input col-sm-9 col-md-10'));?>
                                        </div>
                                      </div>
                                    </div>
                                  </section> 
                                </div><!-- /ACORDION PARA ANEXOS -->
                              </div>
                            </div>
                          </div>
                        </div><!-- /.card -->
                    </div><!-- /.container -->
                  </div><!-- /.Form-body Modal-->
                </div><!-- /.card-body Modal-->

                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btn_actualizar_per" name="btn_actualizar_per">
                    Actualizar
                  </button>

                  <button type="button" class="btn btn-primary " id="btn_guardar_per" name="btn_guardar_per">
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
    

 <!-- Modal Nuevo Tercero -->
      <div class="modal fade modal-lg" id="newCtercero" role="dialog" aria-labelledby="newModalLabelterc" aria-hidden="true">
          
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabelterc">
                Nuevo Tercero
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('d_contratost/guardar_tercero'), array('id'=>'form_guardartercero', 'name'=>'form_guardartercero', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_tipo_tercero">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Tipo Tercero *','tipo_tercero', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-6">
                        <?= form_dropdown('tipo_tercero', $opctipotercero, '', 'class="form-control col-sm-11 col-md-12" id="tipo_tercero"');?>
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

                    <!-- <div class="form-group row" id="div_estado">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-6">
                        <?= form_dropdown('estado', $opciones, '1', 'class="form-control col-sm-11 col-md-12" id="estado"');?>
                      </div>
                    </div> -->
                  </div><!-- /.Form-body Modal-->
                </div><!-- /.card-body Modal-->

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary " id="btn_guardar_tercero" name="btn_guardar_tercero">
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
      