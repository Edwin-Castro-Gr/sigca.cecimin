<?php
  $opcion = array(
    '0'   => 'Seleccione el Municipio'
  );


?>
<input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

  <div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
      <h3 class="card-title text-125 text-primary-d2">
        <i class="far fa-edit text-dark-l3 mr-1"></i>
        Datos de la Empresa
      </h3>
    </div>

    <div class="card-body px-3 pb-1">
      <?= form_open(base_url('a_empresa/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
        <?= form_input(array('type'=>'hidden', 'name'=>'idregistro', 'id'=>'idregistro', 'value'=>'0'));?>
        <div class="form-body">

          <div class="form-group row" id="div_parte1">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('NIT *','nit', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'nit', 'id'=>'nit', 'placeholder'=>'Digite el NIT', 'maxlength'=>'20', 'class'=>'form-control '));?>
            </div>
          
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Codigo Habilitacion *','codigo_habilitacion', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'codigo_habilitacion', 'id'=>'codigo_habilitacion', 'placeholder'=>'Digite el Codigo Habilitacion', 'maxlength'=>'20', 'class'=>'form-control '));?>
            </div>
          </div>

          <div class="form-group row" id="div_parte2">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Razón Social *','nombre', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite la Razón Social', 'maxlength'=>'50', 'class'=>'form-control UpperCase'));?>
            </div>
          
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Dirección','direccion', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'direccion', 'id'=>'direccion', 'placeholder'=>'Digite la dirección', 'maxlength'=>'100', 'class'=>'form-control'));?>
            </div>
          </div>

          <div class="form-group row" id="div_parte3">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Celular','celular', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'number', 'name'=>'celular', 'id'=>'celular', 'placeholder'=>'Digite el celular', 'class'=>'form-control'));?>
            </div>
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Teléfono','telefono', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'number', 'name'=>'telefono', 'id'=>'telefono', 'placeholder'=>'Digite el teléfono', 'class'=>'form-control'));?>
            </div>
          </div>

          <div class="form-group row" id="div_parte3">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Email','email', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'email', 'name'=>'email', 'id'=>'email', 'placeholder'=>'Digite el email', 'maxlength'=>'50', 'class'=>'form-control'));?>
            </div>
          
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Departamento','departamentos_empresa', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= select_departamentos_tabla('empresa','','form-control ');?>
            </div>
          </div>

          <div class="form-group row" id="div_parte4">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Municipio','municipio', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_dropdown('municipio',$opcion, '', 'class = "form-control " id="municipio"');?>
            </div>
          
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Logo','logo', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_upload(array('type'=>'file', 'name'=>'logo', 'id'=>'logo', 'placeholder'=>'Seleccione la imagen del logo', 'class'=>'ace-file-input form-control col-sm-8 col-md-9'));?>
            </div>
          </div>

          <div class="form-group row" id="div_parte5">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Actividad Economica','actividad', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'actividad', 'id'=>'actividad', 'placeholder'=>'Digite la Actividad Economica', 'maxlength'=>'60', 'class'=>'form-control UpperCase'));?>
            </div>
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('CIIU','ciiu', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'ciiu', 'id'=>'ciiu', 'placeholder'=>'Digite codigo de la Actividad Economica', 'maxlength'=>'60', 'class'=>'form-control '));?>
            </div>
          </div>

          <div class="form-group row" id="div_parte6">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Riesgo de la Empresa','riesgo', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'riesgo', 'id'=>'riesgo', 'placeholder'=>'Digite el Riesgo de la Empresa', 'maxlength'=>'60', 'class'=>'form-control UpperCase'));?>
            </div>
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('ARL','arl', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'arl', 'id'=>'arl', 'placeholder'=>'Digite la ARL', 'maxlength'=>'60', 'class'=>'form-control UpperCase'));?>
            </div>
          </div>


          <div class="form-group row" id="div_parte7">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Caja Compensación','caja', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-4">
              <?= form_input(array('type'=>'text', 'name'=>'caja', 'id'=>'caja', 'placeholder'=>'Digite la Caja de Compensación', 'maxlength'=>'60', 'class'=>'form-control UpperCase'));?>
            </div>                      
          </div>

          <div class="form-group row" id="div_mision">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Misión','mision', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-9">
              <?= form_textarea(array('rows'=>'3', 'name'=>'mision', 'id'=>'mision', 'placeholder'=>'Ingrese la Misión', 'class'=>'form-control'));?>
            </div>
          </div>

          <div class="form-group row" id="div_vision">
            <div class="col-sm-2 col-form-label text-sm-right pr-0">
              <?= form_label('Visión','vision', array('class'=>'mb-0')); ?>
            </div>
            <div class="col-sm-10">
              <?= form_textarea(array('rows'=>'3', 'name'=>'vision', 'id'=>'vision', 'placeholder'=>'Ingrese la Visión', 'class'=>'form-control '));?>
            </div>
          </div>                                        
      
          <div class="container " id="div_parte8">                
            <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
              <div class="card-body p-0" id="Danexos">
                <div class="accordion" id="accordioDAnexos">
                  <div class="card border-0 bgc-red-l5 post-carg">
                    <div class="card-header border-0 bgc-transparent mb-0" id="heading_Anexos">
                      <h2 class="card-title bgc-transparent text-red-d2 brc-red">
                        <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-red btn-a-outline-red accordion-toggle border-l-3 radius-0 collapsed" href="#collapseAnexos" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAnexos"> <b> DOCUMENTOS DE LA ENTIDAD</b>
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

                    <div id="collapseAnexos" class="collapse" aria-labelledby="heading'" data-parent="#accordioDAnexos">             
                      <div class="card-body pt-1 text-dark-m1 border-l-3 brc-red bgc-red-l5"> 
          
                        <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                          <div class="card-body p-0">
                            <div class="accordion" id="accordioDocAnexos">
                                                                 
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

          <div class="container" id="div_parte8.1">
            <div class="bgc-info-d3 text-white brc-white p-15">
              <?= form_button(array('type'=>'button', 'id'=>'btn_nuevo_anexo', 'name'=>'btn_nuevo_anexo', 'content'=>'<i class="fa fa-plus mr-1"></i>Agregar Documento', 'class'=>'btn btn-lighter-success btn-bold px-4')); ?>       
            </div>
          </div><!-- /.container -->

          <div class="container" id="div_parte9">
            <div class="col-form-label text-sm-left pr-0">
              <b><?= form_label('POLITICAS DE LA EMPRESA','politicas', array('class'=>'mb-0')); ?></b>
            </div>
            <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
              <div class="card-body p-0">
                <div class="accordion" id="accordionPoliticas">                  

                </div>
              </div><!-- /.card body-->
            </div><!-- /.card -->
          </div><!-- /.container -->


        <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
          <div class="offset-md-3 col-md-9 text-nowrap">
            <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>
             
            <?= anchor(base_url('home/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
          </div>
        </div>
      </div><!-- /.form-body -->
    <?= form_close(); ?>    
  </div><!-- /.card -->


      <!-- ************************************* AGREGAR ANEXOS A DOCUMETOS *********************************************** -->
      <div class="modal fade modal-lg" id="anexosDoc"  role="dialog" aria-labelledby="newModalLabelanexo" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bgc-primary-m1 brc-white">
              <h5 class="modal-title text-white" id="newModalLabel">
                Documentos Anexos
              </h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?= form_open(base_url('a_empresa/guardar_documentos_anexos'), array('id'=>'form_guardar_anexo', 'name'=>'form_guardar_anexo', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idreg_anexo', 'id'=>'idreg_anexo', 'value'=>'0'));?>
                <div class="card-body px-2 pb-1">
                  <div class="form-body">
                    <div class="form-group row" id="div_documentos">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Nombre del documento','nombre', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                       <?= form_input(array('type'=>'text', 'name'=>'nombre_archivo', 'id'=>'nombre_archivo', 'placeholder'=>'Digite Documento', 'maxlength'=>'100', 'class'=>'form-control UpperCase'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_archivo">
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Archivo','archivo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-10">
                         <?= form_upload(array('type'=>'file', 'name'=>'archivo[]', 'id'=>'archivo', 'placeholder'=>'Seleccione el archivo ...', 'class'=>'ace-file-input form-control col-sm-8 col-md-10', 'multiple'=>'multiple'));?>
                      </div>
                    </div>                      
                    
                    <div class="form-group row" id="div_vigencia">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha documento','fecha_inicio', array('class'=>'mb-0'));?>
                      </div>
                      <div class="col-sm-3">
                        <?=form_input(array('type'=>'date', 'name'=>'fecha_inicio', 'id'=>'fecha_inicio', 'class'=>'form-control'));?>
                      </div>
                    </div>                  
                  </div><!-- /.form-body Modal-->
                </div><!-- /.card-body Modal-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary " id="btn_guardar_anexo" name="btn_guardar_anexo">
                    Guardar
                  </button>
                  <button type="button" class="btn btn-primary " id="btn_actualizar_anexo" name="btn_actualizar_anexo">
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
