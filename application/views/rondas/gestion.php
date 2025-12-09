<?php
  $opc_jornada = array(
    '' => 'Seleccione una Opción',
    '0' => 'Mañana',
    '1' => 'Tarde'
  );

  $opc_estado = array(
    '0' => 'Pendiente',
    '1' => 'Gestionada',
    '2' => 'Cancelada'
  );

  $opc_condicion = array(
    '' => 'Seleccione una Opción',
    '1' => 'Discapacidad Física',
    '2' => 'Discapacidad Visual',
    '3' => 'Ninguna'
  );

  $opc_tipo = array(
    '' => 'Seleccione una Opción',
    '1' => 'Cédula de Ciudadanía',
    '2' => 'Cédula de Extrangería',
    '3' => 'Tarjeta de Identidad', 
    '4' => 'Registro Civil',
    '5' => 'Pasaporte'
  );

   $servicio = array(
    '' => 'Seleccione una Opción',
    '1' => 'Cirugía',
    '2' => 'Procedimientos Menores',
    '3' => 'Consulta de Ortopedia',
    '4' => 'Radiología',
    '5' => 'Toma de Muestras',
    '6' => 'Espirometría',  
    '7' => 'Audiometría',
    '8' => 'Electromiografía',
    '9' => 'Oncología',
    '10' => 'Quimioterapia',
    '11' => 'Administración de Medicamentos',
    '12' => 'Odontologia', 
    '13' => 'Sotano 1',
    '14' => 'Sotano 2',
    '15' => 'Consultorios Médicos Independientes'
  );
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="ejecucion">
<div class="main-container container bgc-transparent">
  <div class="main-content minh-100 justify-content-center">
    <div class="p-2 p-md-4">
      <div class="row" id="row-1">
        <div class="col-12 col-xl-12  bgc-white shadow radius-1 overflow-hidden">
          <div class="row" id="row-2">
            <div class="page-content container container-plus">
              <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header text-center" >
                      
                      <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-4">
                          <h3 style="color:#20A491" class="text-center"><b><?=$c_nombre;?></b></h3>
                        </div>
                      </div>
                        <hr>
                    </div>
                    <br>
                  </div>                       

                  <div class="card-body" id="Card1">                          
                      <div class="form-group form-row mt-2">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Servicio *','servicio', array('class'=>'mb-0')); ?>
                        </div>                                  
                        <div class="col-sm-4">
                          <?= form_dropdown('servicio', $servicio, '', 'class="ace-select radius-round w-100 text-grey brc-h-info-m2 form-control" id="servicio" required="required"');?>
                        </div>
                      
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Ubicación *','ubicacion', array('class'=>'mb-0')); ?>
                        </div>                                  
                        <div class="col-sm-4">
                           <?= form_input(array('type'=>'text', 'name'=>'ubicacion', 'id'=>'ubicacion', 'placeholder'=>'Digite la ubicacion', 'maxlength'=>'170', 'class'=>'form-control ', 'required'=>true));?>
                        </div>
                      </div> 
                      
                      <input type='hidden' name='idronda' id= 'idronda' value='<?= $c_idronda ?>'/>
                      <div id="smartwizard-1" class="d-none mx-n3 mx-sm-auto">
                        <ul class="mx-auto">
                          <li class="wizard-progressbar"></li>
                          <?= $c_step?>                              
                        </ul>                           

                        <div class="px-2 py-2 mb-4">
                          <?= $c_tab?> 
                        </div>
                      </div> <!-- smartwizard -->
                    
                  </div><!-- /.card-body -->                        
                </div><!-- .col-12 -->
              </div><!-- /.row mt-4-->
            </div><!-- /.page-content -->
          </div><!-- /.row row-2-->
        </div><!-- /.col-12-->
      </div><!-- /.col shadow-->
    </div><!-- /.p2 --> 
  </div><!-- ./main-content -->
</div> <!-- ./main-container -->