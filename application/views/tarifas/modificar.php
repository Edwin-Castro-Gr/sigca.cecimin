<?php
  //echo $id;
  $opciones = array(
    '0'   => 'No Vigente',
    '1'   => 'Vigente'
  );

   $opcredondeo = array(
    '0'   => 'Unidad',
    '1'   => 'Decena',
    '2'   => 'Centena'
  );
 
 
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="modificar">

    <div class="card acard mt-2 mt-lg-3">
      <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
          <i class="far fa-edit text-dark-l3 mr-1"></i>
           Modificar Tarifas
        </h3>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <div class="card dcard">
            <div class="card-body px-3 pb-1">
              <?= form_open(base_url('c_tarifas/actualizar'), array('id'=>'form_actualizar', 'name'=>'form_actualizar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_tarifa));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idusuariocreo', 'id'=>'idusuariocreo', 'value'=>$c_id_usuarioR));?>
                
                <div class="form-body " style=" justify-content:flex-start;" >

                  <div class="form-group row" id="div_tipo">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Convenio*','convenio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'convenio', 'id'=>'convenio', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_id_convenio));?>
                    </div>                 
                    
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Año Convenio','añoconvenio', array('class'=>'mb-0'));?>
                    </div>
                    <div class="col-sm-3">
                      <?= form_input(array('type'=>'text', 'name'=>'añoconvenio', 'id'=>'añoconvenio', 'placeholder'=>'', 'class'=>'form-control col-sm-11 col-md-12', 'disabled'=>true, 'value'=> $c_year_convenio));?>
                    </div>
                  </div> 

                  <div class="form-group row" id="div_funcionario">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Compañia','compañia', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'text', 'name'=>'compañia', 'id'=>'compañia', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_entidad));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Plan *','plan', array('class'=>'mb-0')); ?>
                    </div>
                      <div class="col-sm-4">
                       <?= form_input(array('type'=>'text', 'name'=>'plan', 'id'=>'plan', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_plan));?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_sesion3">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha de Inicio *','fechainicio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'disabled'=>true, 'value'=>$c_fecha_inicio));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'Digite la fecha', 'class'=>'form-control','disabled'=>true,'value'=>$c_fecha_final));?>
                    </div>            
                  </div>

                  <div class="form-group row" id="div_sesion4">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Redondeo','redondeo', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_dropdown('redondeo', $opcredondeo, '$c_redondeo', 'class="form-control disabled="disabled" id="redondeo"');?>                     
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Uvr - int*','uvr_int', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'text', 'name'=>'uvr_int', 'id'=>'uvr_int', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_uvr_qx_int));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Uvr Qx Mod*','uvr_qx_mod', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'text', 'name'=>'uvr_qx_mod', 'id'=>'uvr_qx_mod', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_uvr_qx_mod));?>
                    </div>                   
                  </div>

                  <div class="form-group row" id="div_sesion5">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Quimio - int*','quimio_int', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'text', 'name'=>'quimio_int', 'id'=>'quimio_int', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_quimio_int));?>
                    </div>   

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Quimio - Mod*','quimio_mod', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'text', 'name'=>'quimio_mod', 'id'=>'quimio_mod', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_quimio_mod));?>
                    </div>  
                  </div>  
                  <div class="form-group row" id="div_sesion5">
                                       
                  </div> 

                  <div class="form-group row" id="div_sesion6">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control " id="estado"');?>
                    </div>    
                  </div>

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_actualizar', 'name'=>'btn_actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Actualizar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('c_tarifas/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              <?= form_close(); ?>
            </div><!-- /.card -->
          </div>
        </div><!-- /.card -->
      </div>
    </div><!-- /.card -->