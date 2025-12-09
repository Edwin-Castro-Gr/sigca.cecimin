<?php
//echo $id;
$opciones = array(
  ''   => 'Seleccione una Opción',
  '0'   => 'Pendiente',
  '1'   => 'Programada',
  '2'   => 'Ejecutada',
  '3'   => 'Recibida',
  '4'   => 'Rechazda'
);

$opcprioridad = array(
  '' => 'Seleccione una prioridad',
  '1' => 'Alta',
  '2' => 'Media',
  '3' => 'Baja'
);

$tipoRecurso= array(
  '' => 'Infraestructura',
  '1' => 'Recursos físicos',
  '2' => 'Recursos de sistemas'
);

$tipoMantenimiento = array(
  '1' => 'Infraestructura',
  '2' => 'Equipos Fijos',
  '3' => 'Preventivos',
  '4' => 'Correctivos',
  '5' => 'Otros'
);

$servicio = array(
  '1' => 'Cirugía',
  '2' => 'Apoyo Diagnostico',
  '3' => 'Odontologia',
  '4' => 'Administración',
  '5' => 'Atención al Usuario',
  '6' => 'Quimioterapia',
  '7' => 'Mantenimiento',
  '8' => 'Laboratorio',
  '9' => 'Otros'
);

$qrequiere = array(
  
  '1'=>'Copia de llaves',
  '2'=>'Cambio de bisagra',
  '3'=>'Cambio de Chapas de puertas o lockers',
  '4'=>'Cambio de llave de lavamanos',
  '5'=>'Cambio de sifa plástica',
  '6'=>'Cambo de asiento de sanitario',
  '7'=>'Cambio de ruedas de mesas, sillas, atriles',
  '8'=>'Cambio de patas de mesas, muebles y escritorios',
  '9'=>'Cambio de apoya brazos',
  '10'=>'Cambio de rieles de cajones',
  '11'=>'Cambio de hidráulicos de muebles',
  '12'=>'Cambio de manijas de muebles',
  '13'=>'Cambio de árbol cisterna de sanitario',
  '14'=>'Cambio de lámparas quemadas',
  '15'=>'Cambio de interruptor',
  '16'=>'Cambio de tope puerta',
  '17'=>'Cambio de bombillos',
  '18'=>'Solicitud de pilas recargables',
  '19'=>'Cambio de rieles y otros accesorios de cortinas',
  '20'=>'Reporte de daños en muro, grietas o fisuras',
  '21'=>'Reporte de pintura de muros o techo en mal estado',
  '22'=>'Reporte aparición de humedad',
  '23'=>'Reporte filtración de agua',
  '24'=>'Reparación de tubo roto o en mal estado',
  '25'=>'Reporte de elemento suelto con riesgo de caída, mal instalado',
  '26'=>'Cambio de vidrio roto',
  '27'=>'Cambio de película vinílica dañada (Vidrio)',
  '28'=>'Reporte de piso vinílico roto o en mal estado',
  '29'=>'Reporte de porcelanato o pieza de enchape rota',
  '30'=>'Solicitud de instalación de cinta antideslizante',
  '31'=>'Reporte de desprendimiento o daño de guarda escoba',
  '32'=>'Reporte de elementos oxidados en mal estado',
  '33'=>'Reporte de taponamiento de sanitario',
  '34'=>'Reporte de malos olores',
  '35'=>'Reporte de superficies y elementos sucios',
  '36'=>'Reporte de taponamiento de sifón',
  '37'=>'Reporte de cables expuestos',
  '38'=>'Ajuste a ornamentación suelta o en mal estado, pasamanos - ventanas',
  '39'=>'Mal funcionamiento de electrodoméstico',
  '40'=>'Reporte de mueble en mal estado',
  '41'=>'Cambio de letrero – señalización en mal estado',
  '42'=>'Reporte de persiana o black out en mal estado',
  '43'=>'Cambio de bisagra para ventana',
  '44'=>'Cambio de manija para ventana',
  '45'=>'OTROS'

)
?>

<input type="hidden" name="opc_pag" id="opc_pag" value="listado">
<div class="card acard mt-2 mt-lg-3">
  <div class="card-header">
    <h3 class="card-title text-125 text-primary-d2">
      <i class="fas fa-calendar-alt text-dark-l3 mr-1"></i>
      Calendario de Mantenimientos
    </h3>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <div class="card dcard">
        <div class="card-body px-1 px-md-3">
          <!--form autocomplete="off"-->
          <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
            <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
              Mantenimientos programados
            </h3>

          </div>

          <!-- message to be displayed on touch devices -->
          <div id="alert-1" class="d-none alert bgc-white border-l-4 brc-purple-m1 shadow-sm" role="alert">
            Toque un intervalo de fecha y manténgalo presionado para agregar un nuevo Mantenimientos
          </div>

          <div class="row">
            <div class="col-12 col-md-9" id='calendar-container'>
              <div class="card acard">
                <div class="card-body p-lg-4">
                  <div id='calendar' class="text-blue-d1"></div>
                </div>
              </div>
            </div>


            <div class="col-12 col-md-3 mt-3 mt-md-4" id='external-events'>
              <div class="bgc-secondary-l4 border-1 brc-secondary-l2 shadow-sm p-35 radius-1">
                <p class="text-120 text-primary-d2">
                  Eventos arrastrables
                </p>

                <p id="alert-2" class="alert bgc-white border-none border-l-4 brc-purple-m1">
                  Puede Arrastrar co click sostenido o hacer click sobre el dia para agregar un nuevo evento.
                </p>

                <div>
                  <div class='fc-event badge bgc-blue-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-blue-d1 text-white text-95">
                    Infraestructura
                  </div>
                  <div class='fc-event badge bgc-green-d2 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-green-d2 text-white text-95">
                    Equipos Fijos
                  </div>
                  <div class='fc-event badge bgc-red-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-red-d1 text-white text-95">
                    Preventivos
                  </div>
                  <div class='fc-event badge bgc-purple-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-purple-d1 text-white text-95">
                    Correctivos
                  </div>
                  <div class='fc-event badge bgc-orange-d1 text-white border-0 py-2 text-90 mb-1 radius-2px' data-class="bgc-orange-d1 text-white text-95">
                    Otros
                  </div>
                </div>

                <label class="mt-2">
                  <input type="checkbox" id='drop-remove' class="mr-1" />
                  Remover Despues
                </label>
              </div>

            </div>
          </div>
          <!-- Modal Nuevo -->
          <!-- Nuevo formulario del calendario -->
          <div class="modal fade modal-lg" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bgc-primary-m1 brc-white">
                  <h5 class="modal-title text-white" id="newModalLabel">
                    Nuevo Mantenimiento
                  </h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <?= form_open(base_url('m_calendario/guardar'), array('id' => 'form_guardar', 'name' => 'form_guardar', 'class' => '', 'autocomplete' => 'off')); ?>
                  <?= form_input(array('type' => 'hidden', 'name' => 'idregistro', 'id' => 'idregistro', 'value' => '0')); ?>
                  <?= form_input(array('type' => 'hidden', 'name' => 'title', 'id' => 'title', 'value' => '')); ?>
                  <?= form_input(array('type' => 'hidden', 'name' => 'fechaStart', 'id' => 'fechaStart', 'value' => '')); ?>
                  <?= form_input(array('type' => 'hidden', 'name' => 'fechaEnd', 'id' => 'fechaEnd', 'value' => '')); ?>
                  <?= form_input(array('type' => 'hidden', 'name' => 'correoSolicitante', 'id' => 'correoSolicitante', 'value' => '')); ?>
                  <div class="card-body px-3 pb-1">
                    <div class="form-body" style=" justify-content:flex-start;">
                      <div class="form-group row" id="div_servicio">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Servicio Requerido *', 'rservicio', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-10">
                          <?= form_input(array('type' => 'text', 'name' => 'rservicio', 'id' => 'rservicio',  'class' => 'form-control col-sm-12 col-md-10')); ?>
                          
                        </div>
                      </div>

                      <div class="form-group row" id="div_otro">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Otros *', 'otroM', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-10">
                          <?= form_input(array('type' => 'text', 'name' => 'otroM', 'id' => 'otroM', 'placeholder' => 'Digite Cuales?',  'class' => 'form-control col-sm-12 col-md-10 UpperCase')); ?>
                        </div>
                      </div>

                      <div class="form-group row" id="div_servicio">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-10">
                          <?= form_dropdown('servicio', '', '0', 'class=" form-control col-sm-12 col-md-10" id="servicio"'); ?>
                          <?= form_input(array('type' => 'hidden', 'name' => 'nombreservicio', 'id' => 'nombreservicio', 'class' => 'form control', 'value' => '')); ?>
                        </div>
                      </div>

                      <div class="form-group row" id="div_otro">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Ubicación*', 'ubicacion', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-10">
                          <?= form_input(array('type' => 'text', 'name' => 'ubicacion', 'id' => 'ubicacion', 'placeholder' => 'Digite la Ubicación',  'class' => 'form-control col-sm-12 col-md-10 UpperCase')); ?>
                        </div>
                      </div>

                      <div class="form-group row" id="div_empleado">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Solicitante*', 'empleados_mantenimiento', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= select_coordinadores_tabla('jefeinm', '', 'form-control'); ?>
                        </div>
                      </div>

                      <div class="form-group row" id="div_observaciones">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Observaciones *', 'observaciones', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-10">
                          <?= form_textarea(array('rows' => '2', 'name' => 'observaciones', 'id' => 'observaciones', 'placeholder' => 'Realice las observaciones que considere', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => '')); ?>
                        </div>
                      </div>

                      <div class="form-group row" id="div_tipoMantenimiento">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Tipo Mantenimiento*', 'tipo_mantenimiento', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_dropdown('tipo_mantenimiento', $tipoMantenimiento, '', 'class="form-control" id="tipo_mantenimiento"'); ?>
                        </div>
                      </div>
                      <div class="form-group row " id="div_fecha_programacion">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Fecha Inicial Mantenimiento', 'fechaMInicial', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_input(array('type' => 'date', 'name' => 'fechaMInicial', 'id' => 'fechaMInicial', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                        </div>

                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Fecha Final Mantenimiento', 'fechaMfin', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_input(array('type' => 'date', 'name' => 'fechaMfin', 'id' => 'fechaMfin', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                        </div>
                      </div>

                      <div class="form-group row " id="div_estado">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                          <?= form_label('Estado *', 'estado', array('class' => 'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                          <?= form_dropdown('estado', $opciones, '', 'class="form-control" id="estado"'); ?>
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
          </div> <!-- /.Modal -->
        </div><!-- /.card-body -->
      </div><!-- /.card -->
    </div><!-- /.col -->
  </div>
</div><!-- /.card -->