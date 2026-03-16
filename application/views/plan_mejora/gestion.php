<?php
//echo $id;
$opciones = array(
    ''   => 'Seleccione una Opción',
    '0'   => 'Sin Iniciar',
    '1'   => 'En Desarrollo',
    '2'   => 'Finalizada',
    '3'   => 'Cerrrada'
);

$opctipf = array(
    '' => 'Seleccione un tipo',
    '0' => 'Rondas',
    '1' => 'Quejas',
    '2' => 'Sucesos de Seguridad',
    '3' => 'Por Auditorias',
    '4' => 'Por Indicadores',
    '5' => 'Por Comités',
    '6' => 'Accidente de Trabajo',
    '7' => 'Otro'
);

$opctipo = array(
    '' => 'Seleccione una Opción',
    '1' => 'Acción correctiva',
    '2' => 'Acción Preventiva',
    '3' => 'Oportunidad de mejora'
);

?>

<input type="hidden" name="opc_pag" id="opc_pag" value="gestionar">

<div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
            <i class="far fa-edit text-dark-l3 mr-1"></i>
            Gestión Acción de Mejora
        </h3>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card dcard">
                <div class="card-body px-3 pb-1">
                    <?= form_open(base_url('plan_mejora/guardar_gestion'), array('id' => 'form_guardar_gestion', 'name' => 'form_guardar_gestion', 'class' => 'mt-lg-3', 'autocomplete' => 'off', 'enctype'=>'multipart/form-data')); ?>

                    <div class="form-body" style="justify-content:flex-start;">
                        <?= form_input(array('type' => 'hidden', 'name' => 'idreg', 'id' => 'idreg', 'value' => $c_id_mejora)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idFuente', 'id' => 'idFuente', 'value' => $c_idFuente)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'tipoFuente', 'id' => 'tipoFuente', 'value' => $c_idtipoF)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'nomservicio', 'id' => 'nomservicio', 'value' => $c_nom_servicio)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idresponsable', 'id' => 'idresponsable', 'value' => $c_id_responsable)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idusuariactual', 'id' => 'idusuariactual', 'value' => $c_usuario_a)); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'estadoactual', 'id' => 'estadoactual', 'value' => $c_estado)); ?>
                        
                        <?php if($c_idtipoF == '0'): ?>
                            <section id="sec_Rondas h-100">
                                <div class="card ccard h-100">
                                    <div class="card-header border-0 text-dark-m2">
                                    </div>
                                    <div class="card-body px-1 px-md-3">
                                        <div class="form-group row" id="div_servicio">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Ronda *', 'txtronda', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_input(array('type' => 'text', 'name' => 'txtronda', 'id' => 'txtronda', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_ronda)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_otro">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Items *', 'item', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_input(array('type' => 'text', 'name' => 'item', 'id' => 'item', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_pregunta)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_servicio">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_input(array('type' => 'text', 'name' => 'nombreservicio', 'id' => 'nombreservicio', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_servicio)); ?>
                                            </div>
                                            <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                                <?= form_label('Responsable Area*', 'empleados_plan_mejora', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_input(array('type' => 'text', 'name' => 'responsable', 'id' => 'responsable', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_responsable)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_empleado">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Hallazgos  *', 'hallazgos', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_textarea(array('rows' => '2', 'name' => 'hallazgos', 'id' => 'hallazgos', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_hallazgos)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_tipoFuente">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Tipo de Fuente*', 'tipo_fuente', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_dropdown('tipo_fuente', $opctipf, $c_idtipoF, 'class="form-control col-sm-12 col-md-10" id="tipo_fuente"'); ?>
                                            </div>

                                            <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                                <?= form_label('TipoAccion*', 'tipo_accion', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_dropdown('tipo_accion', $opctipo, $c_idtipoAccion, 'class="form-control col-sm-12 col-md-10" id="tipo_accion"'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_accionMejora">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Accion de Mejora *', 'accionM', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_textarea(array('rows' => '4', 'name' => 'accionM', 'id' => 'accionM', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_accion)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>

                        <?php if($c_idtipoF == '1'): ?>
                            <section id="sec_Quejas h-100">
                                <div class="card ccard h-100">
                                    <div class="card-header border-0 text-dark-m2">
                                    </div>
                                    <div class="card-body px-1 px-md-3">
                                        <div class="form-group row" id="div_servicio">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Queja *', 'txtqueja', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_input(array('type' => 'text', 'name' => 'txtqueja', 'id' => 'txtqueja', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_queja)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_servicio">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_input(array('type' => 'text', 'name' => 'nombreservicio', 'id' => 'nombreservicio', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_servicio)); ?>
                                            </div>
                                            <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                                <?= form_label('Responsable Area*', 'empleados_plan_mejora', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_input(array('type' => 'text', 'name' => 'responsable', 'id' => 'responsable', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_responsable)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_empleado">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Hallazgos  *', 'hallazgos', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_textarea(array('rows' => '2', 'name' => 'hallazgos', 'id' => 'hallazgos', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_hallazgos)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_tipoFuente">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Tipo de Fuente*', 'tipo_fuente', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_dropdown('tipo_fuente', $opctipf, $c_idtipoF, 'class="form-control col-sm-12 col-md-10" id="tipo_fuente"'); ?>
                                            </div>

                                            <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                                <?= form_label('TipoAccion*', 'tipo_accion', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_dropdown('tipo_accion', $opctipo, $c_idtipoAccion, 'class="form-control col-sm-12 col-md-10" id="tipo_accion"'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_accionMejora">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Accion de Mejora *', 'accionM', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_textarea(array('rows' => '4', 'name' => 'accionM', 'id' => 'accionM', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_accion)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        
                        <?php if($c_idtipoF == '2'): ?>
                            <section id="sec_SucesosS h-100">
                                <div class="card ccard h-100">
                                    <div class="card-header border-0 text-dark-m2">
                                    </div>
                                    <div class="card-body px-1 px-md-3">
                                        <div class="form-group row" id="div_servicio">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Suceso *', 'txtsuceso', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?php
                                                    $suceso_value = 'Otro';
                                                    switch ($c_suceso) {
                                                        case '1':
                                                            $suceso_value = 'Uso de Medicamentos';
                                                            break;
                                                        case '2':
                                                            $suceso_value = 'Uso de Dispositivos/equipos biomedicos';
                                                            break;
                                                        case '3':
                                                            $suceso_value = 'Uso de Reactivos';
                                                            break;
                                                        case '4':
                                                            $suceso_value = 'Uso de Tejidos';
                                                            break;
                                                    }
                                                    echo form_input(array('type' => 'text', 'name' => 'txtsuceso', 'id' => 'txtsuceso', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $suceso_value));
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_otro">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Descripción*', 'descripcion', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_input(array('type' => 'text', 'name' => 'descripcion', 'id' => 'descripcion', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_descrip)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_servicio">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Servicio *', 'servicio', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_input(array('type' => 'text', 'name' => 'nombreservicio', 'id' => 'nombreservicio', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_servicio)); ?>
                                            </div>
                                            <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                                <?= form_label('Responsable Area*', 'empleados_plan_mejora', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_input(array('type' => 'text', 'name' => 'responsable', 'id' => 'responsable', 'class' => 'form-control col-sm-12 col-md-10', 'value' => $c_nom_responsable)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_tipoFuente">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Tipo de Fuente*', 'tipo_fuente', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_dropdown('tipo_fuente', $opctipf, $c_idtipoF, 'class="form-control col-sm-12 col-md-10" id="tipo_fuente"'); ?>
                                            </div>

                                            <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                                <?= form_label('TipoAccion*', 'tipo_accion', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= form_dropdown('tipo_accion', $opctipo, $c_idtipoAccion, 'class="form-control col-sm-12 col-md-10" id="tipo_accion"'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="div_accionMejora">
                                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                                <?= form_label('Accion de Mejora *', 'accionM', array('class' => 'mb-0')); ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <?= form_textarea(array('rows' => '4', 'name' => 'accionM', 'id' => 'accionM', 'class' => 'form-control col-sm-12 col-md-10 UpperCase', 'value' => $c_accion)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <div class="card dcard">
                            <div class="card-header">
                                <h3 class="card-title text-125 text-primary-d2">
                                    <i class="far fa-edit text-dark-l3 mr-1"></i>
                                    IDENTIFICACIÓN DE LAS CAUSAS
                                </h3>
                            </div>
                            <div class="card-body px-3 pb-1">
                                <?php $readonly = ($tiene_causas) ? 'readonly' : ''; ?>
                                <table id="causas-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                                    <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                                        <tr>
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm " width="10%" style="text-align: center;">#</th>
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm" width="100%" style="text-align: center;">IDENTIFICACIÓN DE LAS CAUSAS</th> 
                                        </tr>
                                    </thead>
                                    <tbody class="pos-causas">
                                        <tr>
                                            <td>PORQUE 1</td>
                                            <td><?= form_input(array('type' => 'text', 'name' => 'porque1', 'id' => 'porque1', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'value' => $c_causa_1, $readonly => $readonly)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>PORQUE 2</td>
                                            <td><?= form_input(array('type' => 'text', 'name' => 'porque2', 'id' => 'porque2', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'value' => $c_causa_2, $readonly => $readonly)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>PORQUE 3</td>
                                            <td><?= form_input(array('type' => 'text', 'name' => 'porque3', 'id' => 'porque3', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'value' => $c_causa_3, $readonly => $readonly)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>PORQUE 4</td>
                                            <td><?= form_input(array('type' => 'text', 'name' => 'porque4', 'id' => 'porque4', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'value' => $c_causa_4, $readonly => $readonly)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>PORQUE 5</td>
                                            <td><?= form_input(array('type' => 'text', 'name' => 'porque5', 'id' => 'porque5', 'class' => 'form-control col-sm-12 col-md-12 UpperCase', 'value' => $c_causa_5, $readonly => $readonly)); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card dcard">
                            <div class="card-header">
                                <h3 class="card-title text-125 text-primary-d2">
                                    <i class="far fa-edit text-dark-l3 mr-1"></i>
                                    PLAN DE ACCIÓN
                                </h3>
                            </div>
                            <div class="card-body px-3 pb-1">

                                <div class="form-group row" id="div_actividades_lb">
                                    <div class="col-sm-3 col-form-label text-sm-center pr-0">
                                        <?= form_label('Actividad*', 'actividad', array('class' => 'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4 col-form-label text-sm-right pr-0">
                                        <?= form_label('Responsable', 'responsable', array('class' => 'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4 col-form-label text-sm-center pr-0">
                                        <?= form_label('fecha Compromiso', 'fechaComp', array('class' => 'mb-0')); ?>
                                    </div>
                                </div>   
                                <div class="form-group row" id="div_actividades">
                                    <div class="col-sm-5">
                                        <?= form_input(array('type' => 'text', 'name' => 'actividad', 'id' => 'actividad', 'class' => 'form-control col-sm-12 col-md-10', 'value' => '')); ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <?= select_empleados_tabla('plan', '', 'form-control'); ?>                                       
                                    </div>
                                    <div class="col-sm-2">
                                        <?= form_input(array('type' => 'date', 'name' => 'fechaComp', 'id' => 'fechaComp',  'class' => 'form-control col-sm-9 col-md-12')); ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btnAgregarAccionA">
                                            <i class="fa fa-plus mr-1"></i>
                                            <span class="d-sm-none d-md-inline">Agregar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card dcard">
                            <div class="card-header">
                                <h3 class="card-title text-125 text-primary-d2">
                                    <i class="fa fa-handshake text-dark-l3 mr-1"></i>
                                    Gestión de Actividades 
                                </h3>
                            </div>
                            <div class="card-body px-3 pb-1">
                                <table id="actividades-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                                    <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                                        <tr>
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">#</th>
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Actividad</th> 
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Responsable</th>
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha Compromiso</th>                                          
                                            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="pos-actividades">
                                        </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card dcard">
                            <div class="card-header">
                                <h3 class="card-title text-125 text-primary-d2">
                                    <i class="fa fa-check-circle text-dark-l3 mr-1"></i>
                                    Seguimiento de Actividades 
                                </h3>
                            </div>
                            <div class="card-body px-3 pb-1">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="acciones-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                                            <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                                                <tr>
                                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha Reg.</th>
                                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Actividad y Avance</th>
                                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Evidencia</th>
                                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Cumplió</th>
                                                    <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody class="pos-acciones">
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" id="div_estado">
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Estado', 'estado', array('class' => 'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                                <?= form_dropdown('estado', $opciones, $c_estado, 'class="form-control" id="estado"'); ?>
                            </div>
                        </div>

                        <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                            <div class="offset-md-3 col-md-9 text-nowrap">
                                <?= form_button(array('type' => 'button', 'id' => 'btn_guardar_gest', 'name' => 'btn_guardar_gest', 'content' => '<i class="fa fa-check mr-1"></i>Guardar Gestión', 'class' => 'btn btn-info btn-bold px-4')); ?>
                                <?= anchor(base_url('plan_mejora/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class' => 'btn btn-danger btn-rounded m-t-10')); ?>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalGestionActividad" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bgc-info-tp1">
                <h4 class="modal-title text-white">Registrar Avance de Actividad</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-3 text-sm-right">Descripción del Avance:</div>
                    <div class="col-sm-9">
                        <textarea id="modal_avance_desc" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 text-sm-right">Evidencias:</div>
                    <div class="col-sm-9">
                        <input type="file" id="modal_evidencia_act" class="ace-file-input" multiple />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info" id="btnGuardarAvanceTemporal">Guardar Temporal</button>
            </div>
        </div>
    </div>
</div>

<div id="modalObservacionSeguimiento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header bgc-primary-tp1">
                <h5 class="modal-title text-white">
                    <i class="fa fa-clipboard-check mr-2"></i>
                    Evaluación de Actividad
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bgc-white">
                <div class="form-group">
                    <label class="text-600 text-primary-d1">Observaciones de Seguimiento:</label>
                    <textarea id="obs_seguimiento_txt" class="form-control brc-primary-m3" rows="4" placeholder="Escriba aquí los detalles del cumplimiento o motivos del retraso..."></textarea>
                </div>

                <div class="form-group mt-3">
                    <label class="text-600 text-primary-d1">¿Cumplió con el objetivo?</label>
                    <select id="evaluacion_objetivo" class="form-control brc-primary-m3">
                        <option value="">Seleccione una evaluación</option>
                        <option value="SI">SÍ - Objetivo alcanzado</option>
                        <option value="NO">NO - No se evidencian mejoras</option>
                        <option value="PARCIAL">PARCIAL - En proceso de mejora</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer bgc-grey-l4">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary px-4" id="btnAceptarObservacion">Aceptar</button>
            </div>
        </div>
    </div>
</div>