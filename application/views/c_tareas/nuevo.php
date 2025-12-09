<?php
//echo $id;

    $servicio = array(
        '00' => 'Seleccione una Opción',
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

    $opciones = array(
        ''   => 'Seleccione una Opción',
        '0'   => 'Sin Iniciar',
        '1'   => 'En Desarrollo',
        '2'   => 'Finalizada',
        '3'   => 'Cerrrada'
    );

    $opctipf = array(
        '' => 'Seleccione la Fuente',
        '0' => 'Rondas',
        '1' => 'Quejas',
        '2' => 'Incidentes',
        '3' => 'Eventos Adversos',
        '4' => 'Actos Inseguros',
        '5' => 'Por Auditorias',
        '6' => 'Por Indicadores',
        '7' => 'Por Comités',
        '8' => 'Analisis de Riesgo',
        '9' => 'Accidente de Trabajo'
    );

    $opctipo = array(
    	'' => 'Seleccione una Opción',
    	'1' => 'Acción correctiva',
    	'2' => 'Acción Preventiva',
    	'3' => 'Oportunidad de mejora'
    );
?>
<input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">
<div class="card acard mt-2 mt-lg-3">
    <div class="card-header">
        <h3 class="card-title text-125 text-primary-d2">
            <i class="fa fa-cog text-dark-l3 mr-1"></i>
            Plan de Mejora
        </h3>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card dcard">
                <div class="card-body px-1 px-md-3">
                    <!--form autocomplete="off"-->

                    <?= form_open(base_url('plan_mejora/guardar_nuevo'), array('id' => 'form_nuevo', 'name' => 'form_nuevo', 'class' => 'mt-lg-3', 'autocomplete' => 'off')); ?>
                    <div class="form-body " style=" justify-content:flex-start;">   
                        <?= form_input(array('type' => 'hidden', 'name' => 'idreg', 'id' => 'idreg', 'value' => '')); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idFuente', 'id' => 'idFuente', 'value' => '')); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'idresponsable', 'id' => 'idresponsable', 'value' => '')); ?>
                        <?= form_input(array('type' => 'hidden', 'name' => 'estadoactual', 'id' => 'estadoactual', 'value' => '')); ?>
                    
                        <div class="form-group row" id="div_Fuente">
                            
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                <?= form_label('Seleccione la Fuente *','tipo_fuente', array('class'=>'mb-0')); ?>
                            </div>

                            <div class="col-sm-6">
                                <?= form_dropdown('tipo_fuenteN', $opctipf, '', 'class="form-control col-sm-9 col-md-10" id="tipo_fuenteN"'); ?>
                            </div>
                        </div>    

                        <hr class="border-dotted my-35"> 

                        <section class="form-group " id="sec_Rondas">
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo de la Ronda de Seguridad 
                            </h3>
                            <hr class="border-dotted my-35"> 

                            <div class="card ccard h-100">
                                <div class="card-header border-0 text-dark-m2">
                                    <div class="card-body px-1 px-md-3">

                                        <!--form autocomplete="off"-->
                                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                                            <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
                                                Informes de Incumplimiento
                                            </h3>

                                            <div class="mb-2 mb-sm-0">
                                                <div class="form-group row mr-1">
                                                    
                                                    <div class="col-sm-2">
                                                        <?= form_input(array('type'=>'text', 'name'=>'fechaStart', 'id'=>'fechaStart', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?>  
                                                        <?= form_input(array('type'=>'hidden', 'name'=>'val_fechaini', 'id'=>'val_fechaini', 'value'=>'0'));?> 
                                                    </div>
                                                    <div class="col-sm-2">
                                                            <?= form_input(array('type'=>'text', 'name'=>'fechaEnd', 'id'=>'fechaEnd', 'placeholder'=>'dd-mm-aaaa', 'class'=>'form-control'));?>                              
                                                            <?= form_input(array('type'=>'hidden', 'name'=>'val_fechafin', 'id'=>'val_fechafin', 'value'=>'0'));?> 
                                                    </div>                                                  

                                                    <div class="col-sm-3">
                                                        <?= select_rondas_tabla('informes', '', 'select2 form-control col-sm-4 col-md-10'); ?>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <?= form_dropdown('servicio', $servicio, '', 'class="ace-select  w-100 text-grey brc-h-info-m2 form-control" id="servicio" '); ?>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="action-buttons">
                                                            <button type="button" class="btn btn-blue px-3 d-block text-95 radius-round border-2 brc-black-tp10" id="btn_consultar">
                                                                <i id="btn_consultar" class="fa fa-search-plus text-105"></i>
                                                            </button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-45 card ccard" id="Accordion">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="HallazgoRondas-table" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                                                        <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                                                            <tr>                                                                
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Id</th>
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Fecha Inspección</th>
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Ronda</th>
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Servicio</th>
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Sección</th>
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Pregunta</th>
                                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Acción</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="pos-rel">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card tab -->
                            
                        </section>
                        <section class="form-group" id="sec_Quejas"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo de la Queja  
                            </h3>
                            <hr class="border-dotted my-35"> 
                        </section>
                        
                        <section class="form-group" id="sec_Incidentes"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo del Incidente  
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                        <section class="form-group" id="sec_Eventos_Adversos"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos  de Hallazgo del Evento Adverso  
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                        <section class="form-group" id="sec_Actos_Inseguros"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo del Acto Inseguro  
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                        <section class="form-group" id="sec_Por_Auditorias"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo por Auditorias 
                            </h3>
                            <hr class="border-dotted my-35"> 
                            
                        </section>
                        
                        <section class="form-group" id="sec_Por_Indicadores"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo por Indicadores  
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                        <section class="form-group" id="sec_Por_Comites"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo por Comites  
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                        <section class="form-group" id="sec_Analisis_de_Riesgo">
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo por Analisis de Riegos   
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                        <section class="form-group" id="sec_Accidente_de_Trabajo"> 
                            <h3 class="card-title text-125 text-center text-primary-d2">
                                Datos de Hallazgo por Accidentes de Trabajo  
                            </h3>
                            <hr class="border-dotted my-35"> 

                        </section>

                    </div><!-- /.Form-body Modal-->     
                    <?= form_close(); ?>              
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div>

    <div class="modal fade modal-lg" id="ModalAccionM" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true" >

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bgc-primary-m1 brc-white">
                    <h5 class="modal-title text-white" id="newModalLabel">
                        Accion de mejora
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?= form_open(base_url('r_gestion/guardar_accion'), array('id' => 'form_Accion', 'name' => 'form_Accion', 'class' => '', 'autocomplete' => 'off')); ?>
                    <?= form_input(array('type' => 'hidden', 'name' => 'idregistro', 'id' => 'idregistro', 'value' => '0')); ?>
                    <div class="card-body px-3 pb-1">
                        <div class="form-body">

                            <div class="form-group row" id="div_Servicio_Ronda">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Ronda *', 'txtronda', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-10">
                                    <?= form_input(array('type' => 'text', 'name' => 'txtronda', 'id' => 'txtronda', 'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>
                            </div>

                            <div class="form-group row" id="div_Servicio_Seccion">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Seccion *', 'txtseccion', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'txtseccion', 'id' => 'txtseccion',  'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>

                                <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                    <?= form_label('Servicio *', 'txtservicio', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= form_input(array('type' => 'text', 'name' => 'txtservicio', 'id' => 'txtservicio', 'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>                              
                            </div>

                            <div class="form-group row" id="div_Pregunta">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Item *', 'txtpregunta', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-10">
                                    <?= form_textarea(array('rows' => '2', 'name' => 'txtpregunta', 'id' => 'txtpregunta', 'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>  
                            </div>  

                            <div class="form-group row" id="div_hallazgo">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Hallazgo *', 'txthallazgo', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-10">
                                    <?= form_textarea(array('rows' => '2', 'name' => 'txthallazgo', 'id' => 'txthallazgo', 'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>
                            </div>  

                            <div class="form-group row" id="div_Accion">

                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Tipo de Accion de Mejora *', 'tipo_accion', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= form_dropdown('tipo_accion', $opctipo, '', 'class="form-control col-sm-9 col-md-10" id="tipo_accion"'); ?>
                                </div>
                            </div>

                            <div class="form-group row" id="div_descripcion">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Descripción de la Acción ', 'descripcion', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-10">
                                    <?= form_textarea(array('rows' => '4', 'name' => 'descripcion', 'id' => 'descripcion', 'placeholder' => 'Registre la discripción de la acción de mejora que se requiere', 'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>
                            </div>

                            <div class="form-group row" id="div_responsable">
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Responsable*', 'empleados_rondas', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= select_coordinadores_tabla('rondas', '', 'form-control'); ?>
                                </div>
                                <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                    <?= form_label('Fecha ejecución', 'txtfechaE', array('class' => 'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= form_input(array('type' => 'date', 'name' => 'txtfechaE', 'id' => 'txtfechaE',  'class' => 'form-control col-sm-9 col-md-10')); ?>
                                </div>
                            </div>
                        </div><!-- /.Form-body Modal-->
                    </div><!-- /.card-body Modal-->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary " id="btn_guardar_accion" name="btn_guardar_accion">
                            Guardar
                        </button>
                        <button type="submit" class="btn btn-primary " id="btn_actualizar_accion" name="btn_actualizar_accion">
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

        <!--// MODAL DE DETALLE //-->
    <div class="modal fade modal-xl" id="Modaldetalle" tabindex="-1" role="dialog" aria-labelledby="newModalDetalleLabel" aria-hidden="true" style="z-index: 1900">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bgc-primary-m1 brc-white">
                    <h5 class="modal-title text-white" id="newModalDetalleLabel">
                        Detalle
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card ccard">
                            <div class="card-body">
                                <div class="pos-det" id="pos-det">
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- /.Modal-body -->
            </div> <!-- /.modal-content -->
        </div>
    </div> <!-- /.Modal -->

    <!--// MODAL EVIDENCIA //-->
    <div class="modal fade modal-xl" id="ModalEvidencia" tabindex="-1" role="dialog" aria-labelledby="newModalDetalleLabel" aria-hidden="true" style="z-index: 1900">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bgc-primary-m1 brc-white">
                    <h5 class="modal-title text-white" id="newModalDetalleLabel">
                        EVIDENCIA
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card ccard">
                            <div class="card-body">
                                <div class="pos-img" id="pos-img">
                                    <div class="form-group row" id="Imagen">
                                        <img src="" class="img-thumbnail" alt="Imagen Evidencia" id= "imgEvidencia">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.Modal-body -->
            </div> <!-- /.modal-content -->
        </div>
    </div> <!-- /.Modal -->
</div><!-- /.card -->
