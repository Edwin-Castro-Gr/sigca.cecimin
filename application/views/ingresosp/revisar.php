<?php
  //echo $id;
  $opciones = array(
    ''    => 'Seleccione opción',
    '0'   => 'Pendiente',
    '1'   => 'En proceso',
    '2'   => 'Aprobado',
    '3'   => 'Cerrada'    
  ); 
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="revisar">

  <div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
      <h3 class="card-title text-125 text-primary-d2">
        <i class="far fa-edit text-dark-l3 mr-1"></i>
         Revisar Ingreso Personal
      </h3>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="card dcard">
          <div class="card-body px-3 pb-1">
            <?= form_open(base_url('c_ingresop/revisar'), array('id'=>'form_revisar', 'name'=>'form_revisar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>$c_id_ingreso));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'idusuariocreo', 'id'=>'idusuariocreo', 'value'=>$c_id_usuario));?>
              <?= form_input(array('type'=>'hidden', 'name'=>'tipocontratos', 'id'=>'tipocontratos', 'value'=>$c_id_tipocontrato));?>
              <div class="form-body " style=" justify-content:flex-start;" >

                <div class="form-group row" id="div_tipo">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Tipo Contrato *','tiposcontratos_ingresop', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_tiposcontratos_tabla('ingresop',$c_id_tipocontrato,'form-control');?>
                  </div>                 
                  <?= form_input(array('type'=>'hidden', 'name'=>'idfuncionario', 'id'=>'idfuncionario', 'value'=>$c_id_funcionario));?>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Cedula','cedula_empleadol', array('class'=>'mb-0'));?>
                  </div>
                  <div class="col-sm-3">
                    <?= form_input(array('type'=>'text', 'name'=>'cedula_empleado', 'id'=>'cedula_empleado', 'placeholder'=>'Digite Cedula del Empleado', 'class'=>'form-control col-sm-11 col-md-12', 'value'=> $c_cedula));?>
                  </div>
                </div> 

                <div class="form-group row" id="div_funcionario">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Nombres y Apellidos','nombre_empleado', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'text', 'name'=>'nombre_empleado', 'id'=>'nombre_empleado', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','disabled'=>true,'value'=>$c_nombre_funcionario));?>
                  </div> 
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Cargo *','cargos_contratos', array('class'=>'mb-0')); ?>
                  </div>
                    <div class="col-sm-4">
                    <?= select_cargos_tabla('ingresop',$c_id_cargo,'select2 form-control disabled=true');?>
                  </div>                   
                </div>

                <div class="form-group row" id="div_sesion3">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Linea de Costos','lineacostos', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_lineacostos_tabla('ingresop',$c_id_linea_costos,'form-control');?>
                  </div> 
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Centro de Costos','centroscostos', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_centroscostos_tabla('ingresop',$c_id_centrocosto,'form-control');?>
                  </div>  
                                    
                </div>

                <div class="form-group row" id="div_sesion4">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Departamentos','departamentos', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                      <?= select_areas_tabla('ingresop',$c_id_departamento,'form-control');?>
                  </div>
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Jefe inmediato *','empleados_jefeinmed', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= select_coordinadores_tabla('jefeinm',$c_id_jefeinm,'select2 form-control ');?>
                  </div>                    
                </div>

                <div class="form-group row" id="div_sesion5">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Fecha de Inicio *','fechainicio', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_input(array('type'=>'date', 'name'=>'fechainicio', 'id'=>'fechainicio', 'placeholder'=>'Digite la fecha', 'class'=>'form-control', 'value'=>$c_fecha_inicio));?>
                  </div> 
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                      <?= form_label('Fecha final','fechafinal', array('class'=>'mb-0', 'id'=>'lblfechafinal')); ?>
                    </div>
                    <div class="col-sm-4">
                      <?= form_input(array('type'=>'date', 'name'=>'fechafinal', 'id'=>'fechafinal', 'placeholder'=>'Digite la fecha', 'class'=>'form-control','value'=>$c_fecha_final));?>
                  </div>   
                </div>  

                <div class="form-group row" id="div_sesion6">
                  <div class="col-sm-2 col-form-label text-sm-right pr-0">
                    <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="col-sm-4">
                    <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control " id="estado"');?>
                  </div>    
                </div>

                <div class="container " id="div_parte8">                    
                  <div class="col-form-label text-sm-left pr-0">
                     <?= form_label('DOCUMENTOS DE INGRESOS','anexos', array('class'=>'mb-0')); ?>
                  </div>
                  <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                    <div class="card-body p-0" id="accordionA">
                      <!--div class="accordion" id="accordionAnexos">  

                      </div-->
                    </div>
                  </div><!-- /.card -->
                </div><!-- /.card -->                    

                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                  <div class="offset-md-3 col-md-9 text-nowrap">
                    <?= form_button(array('type'=>'button', 'id'=>'btn_guardar_revision', 'name'=>'btn_guardar_revision', 'content'=>'<i class="fa fa-check mr-1"></i>Actualizar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                    <?= anchor(base_url('c_ingresop/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                  </div>
                </div>

              </div><!-- /.card-body -->
            <?= form_close(); ?>
          </div><!-- /.card -->
        </div>
      </div><!-- /.card -->
    </div>
  </div><!-- /.card -->