<?php
  $opc_estado = array(
    '1'   => 'Activo',
    '0'   => 'Inactivo'
  );
  $tipos_usuarios = array(
    '0'   => 'Seleccione un Perfil',
    '1'   => 'Gerente',
    '2'   => 'Coordinadores',
    '3'   => 'Cirujanos',
    '4'   => 'Costos / Contratos',
    '5'   => 'Asistenciales',
    '6'   => 'Progración Qx.',
    '7'   => 'Auditoria',
    '8'   => 'Instrumentadoras'

  );
?> 
<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
  <div class="card-header">
      <h3 class="card-title text-125 text-primary-d2">
        <i class="fas fa-user-plus text-dark-l3 mr-1"></i>
        Usuarios
      </h3>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card dcard">
        <div class="card-body px-1 px-md-3">

          <!--form autocomplete="off"-->
            <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
              <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
                Listado de Usuarios
              </h3>

              <div class="mb-2 mb-sm-0">
                <div class="row mr-1">
                  <button type="button" class="btn btn-green px-3 d-block text-95 radius-round border-2 brc-black-tp10 mr-1" id="btn_excel">
                    <i class="fa fa-database mr-1"></i>
                    <span class="d-sm-none d-md-inline" id="btn_excel">Excel</span>
                  </button>
                  <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" data-toggle="modal" data-target="#newModal" id="btn_nuevo_registro">
                    <i class="fa fa-plus mr-1"></i>
                    <span class="d-sm-none d-md-inline" id="btn_nuevo_registro">Nuevo Usuario</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <table id="simple-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                  <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                    <tr>
                      <th>.</th>
                      <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre</th>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Perfil</th>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Email</th>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Teléfono</th>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Estado</th>
                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
                        </tr>
                  </thead>

                  <tbody class="pos-rel">
                    
                  </tbody>
                </table>
              </div>
            </div>
          <!--/form-->
        </div><!-- /.card-body -->
      </div><!-- /.card -->
    </div><!-- /.col -->
  </div>
</div><!-- /.card -->

<!-- Modal Nuevo -->
<div class="modal fade modal-lg" id="newModal" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true" style="overflow:hidden;">
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bgc-primary-m1 brc-white">
        <h5 class="modal-title text-white" id="newModalLabel">
          Crear Usuario
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?= form_open(base_url('a_usuarios/guardar'), array('id'=>'modalForm', 'name'=>'modalForm', 'class'=>'', 'autocomplete'=>'off')); ?>
          <?= form_input(array('type'=>'hidden', 'name'=>'idusuario', 'id'=>'idusuario', 'value'=>'0'));?>
          <div class="card-body px-3 pb-1">
            <div class="form-body">
            
              <div class="form-group row" id="div_perfil">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Perfil *','perfil', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= form_dropdown('perfil', $tipos_usuarios, '0', 'class="form-control col-sm-12 col-md-12" id="perfil"');?>
                </div>
              </div>

              <div class="form-group row" id="div_empleado" >
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Empleado *','empleadosusuario', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-10">
                  <?= select_empleados_tabla('usuarios','','select2 form-control col-sm-12 col-md-10');?>
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

              <div class="form-group row" id="div_telefono_email">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Teléfono ','telefono', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'number', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el Teléfono', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Email','email', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Digite el Email', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>
              </div>

              <div class="form-group row" id="div_usuario">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Usuario ','usuario', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'text', 'name'=>'usuario', 'id'=>'usuario', 'placeholder'=>'Digite el Usuario', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>                          
              </div>

              <div class="form-group row" id="div_clave">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Clave ','clave', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'password', 'name'=>'clave', 'id'=>'clave', 'placeholder'=>'Digite la Clave', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Confirme clave','clave2', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_input(array('type'=>'password', 'name'=>'clave2', 'id'=>'clave2', 'placeholder'=>'Confirme la clave', 'maxlength'=>'70', 'class'=>'form-control col-sm-11 col-md-12 UpperCase', 'required'=>true));?>
                </div>
              </div>

              <div class="form-group row" id="div_estado">
                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                  <?= form_label('Estado *','estado', array('class'=>'mb-0')); ?>
                </div>
                <div class="col-sm-4">
                  <?= form_dropdown('estado', $opc_estado, '1', 'class="form-control col-sm-9 col-md-10" id="estado"');?>

                </div>
              </div>
            </div><!-- /.Form-body Modal-->
          </div><!-- /.card-body Modal-->

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary " id="btn_guardar" name="btn_guardar">
              Guardar
            </button>
            <button type="submit" class="btn btn-primary " id="btn_actualizar" name="btn_actualizar">
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

<div id="view-registro" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header card-success">
              <h4 class="modal-title text-blue" id="myModalLabel">Datos del Registro</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div>
          <div class="modal-body" id="modalFormBody">
              <form class="form-horizontal m-t-20" id="modalForm1">
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="btn_cancelar_modal">Cerrar</button>
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>