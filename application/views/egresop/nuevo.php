<?php
  //echo $id;
  $opcionesEstado = array(
    '0'   => 'Enviado',
    '1'   => 'Paz/Salvo'
  );

  $objeto = array(
    ''    => 'Seleccione una Opción',
    '1'   => 'Prorrogar el Contrato',
    '2'   => 'Modificar el Contrato',
    '3'   => 'Otro'
  );
  
?>

      <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
          <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
             Egreso Contrato Personal
          </h3>
        </div>

        <div class="card-body px-3 pb-1">
          <?= form_open(base_url('c_egresop/guardarEgreso'), array('id'=>'Form_nuevoEgreso', 'name'=>'Form_nuevoEgreso', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
            
            <div class="form-body " style=" justify-content:flex-start;" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_contrato));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idfuncionario', 'id'=>'idfuncionario', 'value'=>$c_id_funcionario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idusuariocreo', 'id'=>'idusuariocreo', 'value'=>$c_id_usuario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'cedula_empleado', 'id'=>'cedula_empleado', 'value'=>$c_cedula));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'estado_contrato', 'id'=>'estado_contrato', 'value'=>$c_estado));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'jefe_inmediato', 'id'=>'jefe_inmediato', 'value'=>$c_id_jefeinm));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'enviarCorreo', 'id'=>'enviarCorreo', 'value'=>false));?>

              <div class="card dcard col-sm-12">
                <div class="card-body">  
                  <div class="form-group row" id="div_tipo" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Tipo Contrato *','tipocontratos_egresop', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_tiposcontratos_tabla('egresop',$c_id_tipocontrato,'form-control');?>
                    </div>
                  
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Funcionario *','empleados_egresop', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_empleados_tabla('egresop',$c_id_funcionario,'select2 form-control ');?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_sesion3">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Cargo *','cargos_egresop', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                    <?= select_cargos_tabla('egresop',$c_id_cargo,'form-control" required="1');?>
                    </div>

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Centro de Costos','centroscostos_egresop', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_centroscostos_tabla('egresop',$c_id_centrocosto,'form-control');?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_sesion4">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Departamentos','areas_egresop', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= select_areas_tabla('egresop',$c_id_departamento,'form-control');?>
                    </div>

                     <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Jefe inmediato *','coordinadores_jefeinmed', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= select_coordinadores_tabla('jefeinm',$c_id_jefeinm,'select2 form-control ');?>
                    </div>
                  </div>

                  <div class="form-group row" id="div_sesion5">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha de Inicio *','fechainicio', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'class'=>'form-control','value'=>$c_fecha_inicio));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'class'=>'form-control','value'=>$c_fecha_final));?>
                    </div> 
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha Egreso','fechaEgreso', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                    </div>
                    <div class="col-sm-2">
                      <?= form_input(array('type'=>'date', 'name'=>'fechaEgreso', 'id'=>'fechaEgreso', 'class'=>'form-control'));?>
                    </div>
                  </div> 

                  <div class="form-group row" id="div_sesion6">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Motivo Egreso','motivo', array('class'=>'mb-0', 'id'=>'lblobservaciones_p')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= form_textarea(array('rows'=>'2', 'name'=>'motivo', 'id'=>'motivo', 'placeholder'=>'Digite el motivo del egreso', 'class'=>'form-control','value'=>""));?>
                    </div>                    
                  </div>

                  <div class="form-group row" id="div_sesion7">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Anexo Paz y Salvo','archivoPazSalvo', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-10">
                      <?= form_upload(array('type'=>'file', 'name'=>'archivoPazSalvo', 'id'=>'archivoPazSalvo', 'placeholder'=>'Cargar el Archivo del Paz y Salvo', 'class'=>'form-control ace-file-input col-sm-8 col-md-10'));?>
                    </div> 
                  </div> 
                </div><!-- /.card-body -->
              </div><!-- /.dcard -->

              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="offset-md-3 col-md-9 text-nowrap" style=" align-content: center;">
                  <?= form_button(array('type'=>'button', 'id'=>'btn_guardarEgreso', 'name'=>'btn_guardarEgreso', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                  <?= anchor(base_url('c_egresop/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                </div>
              </div>
            </div><!-- /.card-body -->
          <?= form_close(); ?>        
        </div><!-- /.card -->
      </div>