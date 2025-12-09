<input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

            <div class="card acard mt-2 mt-lg-3">
              <div class="card-header">
                <h3 class="card-title text-125 text-primary-d2">
                  <i class="far fa-edit text-dark-l3 mr-1"></i>
                  Nueva Area
                </h3>
              </div>

              <div class="card-body px-3 pb-1">
                <?= form_open(base_url('a_area/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>
                  
                  <div class="form-body">

                    <div class="form-group row" id="div_nombre">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Nombre *','Nombre', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= form_input(array('type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'placeholder'=>'Digite el Nombre', 'maxlength'=>'20', 'class'=>'form-control col-sm-8 col-md-9'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_responsable">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Responsable *','responsable', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= form_input(array('type'=>'text', 'name'=>'responsable', 'id'=>'responsable', 'placeholder'=>'Digite el Responsable', 'maxlength'=>'50', 'class'=>'form-control col-sm-8 col-md-9'));?>
                      </div>
                    </div>

                    <div class="form-group row" id="div_centrocostos">
                      <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Centrocostos','centrocostos', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-9">
                        <?= form_input(array('type'=>'text', 'name'=>'centrocostos', 'id'=>'centrocostos', 'placeholder'=>'Digite el Centro de Costos', 'maxlength'=>'100', 'class'=>'form-control col-sm-8 col-md-9'));?>
                      </div>
                    </div>
                  </div>

                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                      <?= anchor(base_url('a_area/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>
                <?= form_close(); ?>
              </div><!-- /.card-body -->
            </div><!-- /.card -->