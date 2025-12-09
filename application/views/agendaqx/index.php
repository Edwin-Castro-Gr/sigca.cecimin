<?php
  //echo $id;
  $opciones = array(
    '0'  => 'Pendiente',
    '1'  => 'Gestionada',
    '2'  => 'Confirmada',
    '3'  => 'Rechazada'
  );
  $opcestado = array(
    ''  => 'Inactivo',
    '0'  => 'Inactivo',
    '1'  => 'Activo'
  );
  $opcanestesia = array(
    '0'   => 'General',
    '1'   => 'Regional',
    '2'   => 'Local Asistida',
    '3'   => 'Local'
  );

  $opclateralidad= array(
    '0'   => 'No aplica',
    '1'   => 'Izquierdo',
    '2'   => 'Derecho',
    '3'   => 'Bilateral'
  );
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="agenda">
<div class="card acard">
	<div class="card-header">
    <h3 class="card-title text-125 text-primary-d2">
      <i class="fas fa-calendar-alt text-dark-l3 mr-1"></i>
      Agenda Quirurgica
    </h3>
  </div>
	<div class="card-body">			  
    <div class="form-group row flex-md-row" >
      <div class="col-sm-2 col-form-label text-sm-right pr-0">
          <?= form_label('Cirujano','cirujanos_programacion', array('class'=>'mb-0')); ?>
      </div>
      <div class="col-sm-6">
          <?= select_cirujanos_tabla('programacion','','select2  form-control style="width: 100%"');?>
      </div>  
    </div><!-- /.form-group--> 
    <div class="form-group row" id="div_seccion2">
      <div class="col-sm-2 col-form-label text-sm-right pr-0">
        <?= form_label('Bloque','lblck_bloque', array('class'=>'mb-0','id'=>'lblck_bloque')); ?>
      </div>
      <div class="col-sm-3">                     
        <label class="col-form-label">
         No
        </label>
          <?= form_input(array('type'=>'checkbox', 'name'=>'ck_bloque', 'id'=>'ck_bloque', 'class'=>'ace-switch input-md text-grey-l1 brc-primary-d1'));?>                        
        <label class="col-form-label">
          Si 
        </label>
      </div>
      <div class="col-sm-2 col-form-label text-sm-right pr-0">
        <?= form_label('Fecha de Programación','fechaprogramacionS', array('class'=>'mb-0')); ?>
      </div>
      <div class="pos-rel col-sm-4">
        <?= form_input(array('type'=>'text', 'name'=>'fechaprogramacionS', 'id'=>'fechaprogramacionS', 'placeholder'=>'dd/mm/aaaa', 'class'=>'form-control ', 'required'=>true));?>  
        <?= form_input(array('type'=>'hidden', 'name'=>'val_fechapro', 'id'=>'val_fechapro', 'value'=>''));?>                   
      </div>                             
    </div><!-- /.form-group--> 
	</div><!-- /.card-body -->
</div><!-- /.card -->

<section>
   
    <div class="form-group row flex-md-row" >
      <div class="col-sm-6 col-md-8 col-lg-12" id='calendar-container'>      
        <div class="d-flex justify-content-between flex-column flex-md-row mb-3 px-2 px-sm-0">
          <div id='calendar-sala1' class="text-blue-d1"></div>
        </div>
      </div><!-- /.col -->       
    </div><!-- /.form-group-->  
     
</section>

<!-- Modal Nuevo -->
<!-- Nuevo formulario del calendario -->
<div class="modal fade modal-xl" id="newModalAgenda" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bgc-primary-m1 brc-white">
        <h5 class="modal-title text-white" id="newModalLabel">
          Nuevo agendamiento
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?= form_open(base_url('c_agendaqx/guardar'), array('id' => 'form_guardar', 'name' => 'form_guardar', 'class' => '', 'autocomplete' => 'off')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'idregistro', 'id' => 'idregistro', 'value' => '0')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'title', 'id' => 'title', 'value' => '')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'fechaStart', 'id' => 'fechaStart', 'value' => '')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'fechaEnd', 'id' => 'fechaEnd', 'value' => '')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'resourceId', 'id' => 'resourceId', 'value' => '')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'idCirujano', 'id' => 'idCirujano', 'value' => '')); ?>
        <?= form_input(array('type' => 'hidden', 'name' => 'correoSolicitante', 'id' => 'correoSolicitante', 'value' => '')); ?>
        <div class="card-body px-3 pb-1">
          <div class="form-body" style=" justify-content:flex-start;">
            
            <div class="form-group row" id="div_seccion2">              
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Fecha de Inicio Cx','fechaICx', array('class'=>'mb-0')); ?>
              </div>
              <div class="pos-rel col-sm-2">
                <?= form_input(array('type'=>'date', 'name'=>'fechaICx', 'id'=>'fechaICx', 'placeholder'=>'dd/mm/aaaa', 'class'=>'form-control ', 'readonly'=>true));?>
              </div>
              <div class="col-sm-1">
                  <?= form_input(array('type'=>'text', 'name'=>'horainiCx', 'id'=>'horainiCx', 'class'=>'form-control text-90' , 'value'=>'', 'readonly'=>true));?>
              </div>  

              <div class="col-sm-1 col-form-label text-90 text-sm-right pr-0">
                <?= form_label('Fecha de final','fechaFCx', array('class'=>'mb-0')); ?>
              </div>
              <div class="pos-rel col-sm-2">
                <?= form_input(array('type'=>'date', 'name'=>'fechaFCx', 'id'=>'fechaFCx', 'placeholder'=>'dd/mm/aaaa', 'class'=>'form-control ', 'readonly'=>true));?> 
              </div>
              <div class="col-sm-1">
                  <?= form_input(array('type'=>'text', 'name'=>'horaFinCx', 'id'=>'horaFinCx', 'class'=>'form-control text-90' , 'value'=>'', 'readonly'=>true));?>
              </div> 

              <div class="col-sm-1 col-form-label text-90 text-sm-right pr-0">
                <?= form_label('Sala','salaQx', array('class'=>'mb-0')); ?>
              </div>
              <div class="pos-rel col-sm-2">
                <?= form_input(array('type'=>'text', 'name'=>'salaQx', 'id'=>'salaQx', 'class'=>'form-control ', 'readonly'=>true));?> 
              </div>                   
            </div>

            <div class="form-group row" id="div_paciente" >
              <?= form_input(array('type'=>'hidden', 'name'=>'idpaciente', 'id'=>'idpaciente', 'value'=>'0'));?>
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Cedula Paciente*','pacientes_programacion', array('class'=>'mb-0')); ?>
              </div>
              <div class="col-sm-3">
                  <?= form_input(array('type'=>'text', 'name'=>'cedula', 'id'=>'cedula', 'placeholder'=>'Digite la cedula', 'class'=>'form-control col-sm-11 col-md-12'));?>
              </div>

              <div class="col-sm-1">
                <button type="button" class="btn px-2 btn-outline-primary col-sm-pull-5" id="btn_agregar_paciente" name="btn_agregar_paciente" >
                  +
                </button>
              </div>
              <div class="col-sm-5">
                <?= form_input(array('type'=>'text', 'name'=>'paciente', 'id'=>'paciente', 'placeholder'=>'', 'class'=>'form-control col-sm-9 col-md-12 UpperCase','readonly'=>true));?>
              </div>
              <div class="col-sm-1">
                <button type="button" class="btn px-2 btn-outline-blue col-sm-pull-5 fa fa-pencil-alt" id="btn_editar_paciente" name="btn_editar_paciente">                     
                </button>
              </div>
            </div>

            <div class="form-group row" id="div_cirujano" >
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Segundo Cirujano','cirujano_programacion', array('class'=>'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= select_cirujanos_tabla('programacion','','select2  form-control style="width: 100%"');?>
              </div>
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Lateralidad *','lateralidad', array('class'=>'mb-0')); ?>
              </div>
              <div class="col-sm-4">
                <?= form_dropdown('lateralidad', $opclateralidad, '', 'class="form-control" id="lateralidad"');?>
              </div>
            </div>

            <div class="form-group row" id="div_tiempo">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo de Anestesia *','tipoanestesia', array('class'=>'mb-0')); ?>
              </div>
              <div class="col-sm-2">
                  <?= form_dropdown('tipoanestesia', $opcanestesia, '', 'class="form-control" id="tipoanestesia"');?>
              </div>
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Tiempo piel a piel','tiempo', array('class'=>'mb-0')); ?>
              </div>
              <div class="col-sm-1 col-xs-1">                      
              <?= form_input(array('type'=>'text', 'name'=>'tiempohoras', 'id'=>'tiempohoras', 'placeholder'=>'HH:MM', 'class'=>'form-control text-80', 'min'=>"0", 'max'=>"8", 'required'=>true));?>                    
              </div>
              
            </div>
            <div class="form-group row" id="div_observaciones">
              <div class="col-sm-2 col-form-label text-sm-right pr-0">
                <?= form_label('Observaciones','observaciones', array('class'=>'mb-0')); ?>
              </div>
              <div class="col-sm-10">
                <?= form_textarea(array('rows'=>'2', 'name'=>'observaciones', 'id'=>'observaciones', 'placeholder'=>'Digite las observaciones si se requiere', 'class'=>'form-control', 'value'=>''));?>
              </div>
            </div>
          <br>
            <div class="row" id="procedimientos">
              <div class="col-12">
                <h5 class="bgc-primary-d3 text-white brc-white p-15">Descripción de Procedimientos</h5>
                <table id="procedimientoscx" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                  <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                    <tr>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">..</th>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ID</th>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">NOMBRE PROCEDIMIENTO</th>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">MATERIAL</th>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ADICIONALES</th>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">PROVEEDOR</th>
                    </tr>
                  </thead>
                  <tbody class="pos-rel">

                  </tbody>
                </table>
                <div class="bgc-info-d3 text-white brc-white p-15"><?= form_button(array('type'=>'button', 'id'=>'btn_nuevoprocedimiento', 'name'=>'btn_nuevoprocedimiento', 'content'=>'<i class="fa fa-check mr-1"></i>Nuevo Procedimiento', 'class'=>'btn btn-lighter-success btn-bold px-4')); ?></div>
                <input type="hidden" id="procedimiento_0" name="procedimiento_0" value="">
              </div>
            </div>

            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-3 col-md-9 text-nowrap">
                <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                <?= anchor(base_url('c_agendaqx/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
              </div>
            </div> 
          </div><!-- /.form-body -->
        </div> <!-- /.card-body-->         
        <?= form_close(); ?>
      </div><!-- /.Modal-body -->
    </div> <!-- /.modal-content -->
  </div>
</div> <!-- /.Modal -->

<!-- ************************************ PROCEDIMIENTOS QX*********************************************** -->
<div class="modal fade modal-lg" id="newModal"  role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bgc-primary-m1 brc-white">
        <h5 class="modal-title text-white" id="newModalLabel">
          Descripción Procedimiento
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?= form_open(base_url('c_programacion/guardar_procedimientos'), array('id'=>'form_guardar_pro', 'name'=>'form_guardar_pro', 'class'=>'', 'autocomplete'=>'off')); ?>
          <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
          <div class="card-body px-2 pb-1">
            <div class="form-body">
              <div class="form-group row" id="div_procedimientos">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Procedimiento','procedimiento', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= select_procedimientos_tabla('agendamiento','','select2 form-control');?>
                </div>
              </div>

              <div class="form-group row" id="div_descripcion">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Descripción adicional*','descripcion', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                    <?= form_input(array('type'=>'text', 'name'=>'descripcion', 'id'=>'descripcion', 'placeholder'=>'Describa el procedimiento si no se encuntro en la casilla anterior', 'class'=>'form-control col-sm-11 col-md-12'));?>
                </div>
              </div>

              <div class="form-group row" id="div_grupo">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Grupo','gprocedimiento', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= select_grupos_tabla('agendamiento','','select2 form-control');?>
                </div>
              </div>

              <div class="form-group row" id="div_materiales">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Materiales ','materiales', array('class'=>'mb-0','id'=>'lblmateriales')); ?>
                </div>
                <div class="col-sm-10" id="div_chk" style="overflow: auto; height: 100%;">
                  <?= form_input(array('type'=>'hidden', 'name'=>'regotro', 'id'=>'regotro', 'value'=>''));?>
                </div>
              </div>
               <div class="form-group row" id="div_materiales">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Otros Materiales ','omateriales', array('class'=>'mb-0','id'=>'lblmateriales')); ?>
                </div>
                <div class="col-sm-10" style="overflow: auto; height: 100%;">
                  <?= form_input(array('type'=>'text', 'name'=>'regotro', 'id'=>'regotro', 'class'=>'form-control col-sm-11 col-md-12','value'=>''));?>
                </div>
              </div>

              <div class="form-group row" id="div_proveedor">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Casa Comercial','proveedor', array('class'=>'mb-0','id'=>'lblproveedor')); ?>
                </div>
                <div class="col-sm-10">
                  <?= select_tercerosM_tabla('agendamiento','','select2 form-control col-sm-10 col-md-12');?>
                </div>
              </div>
            </div><!-- /.Form-body Modal-->
          </div><!-- /.card-body Modal-->

          <div class="modal-footer">
            <button type="button" class="btn btn-primary " id="btn_guardar_proc" name="btn_guardar_proc">
              Guardar
            </button>
            <button type="button" class="btn btn-primary " id="btn_actualizar_proc" name="btn_actualizar_proc">
              Actualizar
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


<!-- ************************************ PACIENTE *********************************************** -->
<!-- Modal Nuevo Paciente -->
<div class="modal fade modal-lg" id="newMPaciente" role="dialog" aria-labelledby="newModalLabelEmp" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bgc-primary-m1 brc-white">
        <h5 class="modal-title text-white" id="newModalLabelEmp">
          Nuevo paciente
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?= form_open(base_url('c_programacion/guardar_paciente'), array('id'=>'form_paciente', 'name'=>'form_paciente', 'class'=>'', 'autocomplete'=>'off')); ?>
          <?= form_input(array('type'=>'hidden', 'name'=>'idregistropa', 'id'=>'idregistropa', 'value'=>'0'));?>
          <div class="card-body px-2 pb-1">
            <div class="form-body">
              <div class="form-group row" id="div_identificacion">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Tipo Documento','tipodocidentidad', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_Tipo_docidentidad_tabla('pacientes','','form-control " required="1');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Documento ','numero_idl', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'numero_id', 'id'=>'numero_id', 'placeholder'=>'Digite el Numero de documento', 'maxlength'=>'15', 'class'=>'form-control ', 'required'=>true));?>
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

              <div class="form-group row" id="div_fecha_nacimiento">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Fecha Nacimiento ','fecha_nacimiento', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'date', 'name'=>'fecha_nacimiento', 'id'=>'fecha_nacimiento', 'placeholder'=>'Digite la fecha de nacimiento', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Edad','edad', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'edad', 'id'=>'edad', 'placeholder'=>'Digite la edad', 'maxlength'=>'3', 'class'=>'form-control col-sm-11 col-md-12', 'required'=>true));?>
                </div>
              </div>

              <div class="form-group row" id="div_eps_otro">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Entidad de Salud','eps_pacientes', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= select_eps_tabla('pacientes','','form-control col-sm-11 col-md-12');?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Otro ','otra_entidad_salud', array('class'=>'mb-0','id'=>'lblotra_entidad_salud')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'otra_entidad_salud', 'id'=>'otra_entidad_salud', 'placeholder'=>'Digite el Cual?', 'maxlength'=>'100', 'class'=>'form-control col-sm-11 col-md-12 UpperCase'));?>
                </div>
              </div>

              <div class="form-group row" id="div_contacto">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Telefono ','telefono', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Telefono', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                </div>

                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Correo ','correo', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'email', 'name'=>'correo', 'id'=>'correo', 'placeholder'=>'Digite el Email', 'maxlength'=>'60', 'class'=>'form-control col-sm-11 col-md-12'));?>
                </div>
              </div>

              <div class="form-group row" id="div_estadop">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Estado *','lblestado', array('class'=>'mb-0', 'id'=>'lblestado')); ?>
                </div>
                <div class="col-sm-6">
                  <?= form_dropdown('estadoP', $opcestado, '', 'class="form-control col-sm-11 col-md-12" id="estadoP"');?>
                </div>
              </div> 
            </div><!-- /.Form-body Modal-->
          </div><!-- /.card-body Modal-->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary " id="btn_guardar_paciente" name="btn_guardar_paciente">
              Guardar
            </button>
            <button type="submit" class="btn btn-primary " id="btn_actualizar_paciente" name="btn_actualizar_paciente">
              Actualizar
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