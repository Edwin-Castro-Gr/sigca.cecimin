<?php
  $opcion = array(
    '0'   => 'Seleccione el Departamento '
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
                        <?= form_label('Departamento','departamento', array('class'=>'mb-0')); ?>
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
                        <?= form_dropdown('municipio',$opcion, '0', 'class = "form-control " id="municipio"');?>
                      </div>
                    
                      <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Logo','logo', array('class'=>'mb-0')); ?>
                      </div>
                      <div class="col-sm-4">
                        <?= form_upload(array('type'=>'file', 'name'=>'logo', 'id'=>'logo', 'placeholder'=>'Seleccione la imagen del logo', 'class'=>'form-control col-sm-8 col-md-9'));?>
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

                    <div class="form-group row" id="div_vision">
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
                </div>
            <div class="container " id="div_parte8">
                <div class="col-form-label text-sm-left pr-0">
                   <?= form_label('POLITICAS DE LA EMPRESA','politicas', array('class'=>'mb-0')); ?>
                </div>
               <div class="card ccard bgc-black-tp10 mt-4 mt-md-0 overflow-hidden">
                  <div class="card-body p-0">
                    <div class="accordion" id="accordionExample4">
                      <div class="card border-0 bgc-green-l5 post-carg" >
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading0">
                          <h2 class="card-title bgc-transparent text-green-d2 brc-green">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-green btn-a-outline-green accordion-toggle border-l-3 radius-0 collapsed" href="#collapse0" data-toggle="collapse" aria-expanded="false" aria-controls="collapse0">
                              POLITICA DE SEGURIDAD DEL PACIENTE
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

                        <div id="collapse0" class="collapse" aria-labelledby="heading0" data-parent="#accordionExample4">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-green bgc-green-l5">
                            <p>
                              CECIMIN SAS comprometida con la atención segura de sus pacientes, gestiona los riesgos a través 
                        del desarrollo de la cultura de seguridad y compromiso de su equipo de trabajo.
                            </p>
                            
                          </div>
                        </div>
                      </div>


                      <div class="card border-0 mt-1px bgc-primary-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading1">
                          <h2 class="card-title bgc-transparent text-primary-d1 brc-primary-m1">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-primary btn-a-outline-primary accordion-toggle border-l-3 radius-0 collapsed" href="#collapse1" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                              HUMANIZACIÓN

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-primary mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>
                        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample4">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-primary-m1 bgc-primary-l5">
                            <p>
                              CECIMIN SAS adopta la política de atención humanizada garantizando mediante el modelo de servicio un trato amable, respetuoso, cálido y seguro al paciente y su familia, así como al grupo de que fortalezca las relaciones durante el proceso de atención.
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="card border-0 mt-1px bgc-purple-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading2">
                          <h2 class="card-title bgc-transparent text-purple-d2 brc-purple-m1">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-purple btn-a-outline-purple accordion-toggle border-l-3 radius-0 collapsed" href="#collapse2" data-toggle="collapse" aria-expanded="false" aria-controls="collapse2">
                              ATENCIÓN AL PACIENTE CON DISCAPACIDAD 

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-purple mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>
                        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample4">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-purple-m1 bgc-purple-l5">
                            <p>
                              CECIMIN SAS. se compromete, alineado con su modelo de atención y con el fin de garantizar los 
                        derechos por la condición de las personas con discapacidad que asistan a su sede, a respetar la 
                        dignidad inherente, la autonomía individual, incluida la libertad de tomar las propias decisiones 
                        y su independencia y velará por la no discriminación, el respeto por la diferencia y la aceptación de 
                        las personas con discapacidad como parte de la diversidad y la condición humana; por la igualdad 
                        de oportunidades, la accesibilidad, el respeto a la evolución de las facultades de los niños y las niñas con discapacidad y de su derecho a preservar su identidad.
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="card border-0 mt-1px bgc-purple-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading3">
                          <h2 class="card-title bgc-transparent text-purple-d2 brc-purple-m1">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-purple btn-a-outline-purple accordion-toggle border-l-3 radius-0 collapsed" href="#collapse3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree4">
                              CALIDAD 

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-purple mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>
                        <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample4">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-purple-m1 bgc-purple-l5">
                            <p>
                              Contribuir al bienestar de los usuarios, mediante una atención con calidad y calidez que deberá ser fácilmente percibido por nuestros clientes, funcionarios, proveedores, aseguradoras y socios. 
                              El enfoque humano, técnico y ético que las ha caracterizado, seguirá marcando su desarrollo en la búsqueda de la satisfacción de las necesidades y expectativas de los usuarios, de su equipo de trabajo, prestadores de servicios y proveedores.
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="card border-0 mt-1px bgc-purple-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading4">
                          <h2 class="card-title bgc-transparent text-purple-d2 brc-purple-m1">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-purple btn-a-outline-purple accordion-toggle border-l-3 radius-0 collapsed" href="#collapse4" data-toggle="collapse" aria-expanded="false" aria-controls="collapse4">
                              GESTION DEL RIESGO

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-purple mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>
                        <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample4">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-purple-m1 bgc-purple-l5">
                            <p>
                              CECIMIN SAS se compromete a identificar, analizar, intervenir, minimizar y medir el impacto de los riesgos asistenciales y administrativos que puedan afectar las condiciones del paciente en su ciclo de atención (desde el ingreso, atención, egreso oportuno y seguimiento post egreso); de sus colaboradores, proveedores y del entorno así como las condiciones de continuidad de operación de la empresa y por ello ha definido la política de Gestión de Riesgos que “Facilita a Cecimin” el logro de sus objetivos de manera sostenible en un entorno competitivo y cambiante, respondiendo a las exigencias y políticas a nivel interno y gubernamental, contribuyendo así al mejoramiento continuo y a la satisfacción de las necesidades de usuarios, colaboradores y comunidades”. 
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="card border-0 mt-1px bgc-purple-l5">
                        <div class="card-header border-0 bgc-transparent mb-0" id="heading5">
                          <h2 class="card-title bgc-transparent text-purple-d2 brc-purple-m1">
                            <a class="d-style btn btn-white bgc-white btn-brc-tp btn-h-outline-purple btn-a-outline-purple accordion-toggle border-l-3 radius-0 collapsed" href="#collapse5" data-toggle="collapse" aria-expanded="false" aria-controls="collapse5">
                              GESTIÓN AMBIENTAL

                              <!-- the toggle icon -->
                              <span class="v-collapsed px-3px radius-round d-inline-block brc-grey-l1 border-1 mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-90"></i>
                            </span>
                              <span class="v-n-collapsed px-3px radius-round d-inline-block bgc-purple mr-3 text-center position-rc">
                                <i class="fa fa-angle-down toggle-icon w-2 mx-1px text-white text-90 pt-1px"></i>
                            </span>
                            </a>
                          </h2>
                        </div>
                        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample4">
                          <div class="card-body pt-1 text-dark-m1 border-l-3 brc-purple-m1 bgc-purple-l5">
                            <p>
                              CCECIMIN SAS. se compromete, alineado con su modelo de atención y con el fin de garantizar los  derechos por la condición de las personas con discapacidad que asistan a su sede, a respetar la dignidad inherente, la autonomía individual, incluida la libertad de tomar las propias decisiones y su independencia y velará por la no discriminación, el respeto por la diferencia y la aceptación de las personas con discapacidad como parte de la diversidad y la condición humana; por la igualdad de oportunidades, la accesibilidad, el respeto a la evolución de las facultades de los niños y las niñas con discapacidad y de su derecho a preservar su identidad. 
                            </p>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div><!-- /.card -->
              </div><!-- /.card -->


                  <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                      <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>
                       
                      <?= anchor(base_url('empresa/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                  </div>
                <?= form_close(); ?>
              </div><!-- /.card-body -->
            </div><!-- /.card -->