<?php
  //echo $id;
  $opciones = array(
      ''   => 'Seleccione una Opción',
      '0'   => 'Aceptado',
      '1'   => 'Pendiente Firma',
      '2'   => 'Firmada'
   );

     $opctipoComite = array(
        '0'   => 'Seleccine una opción',
        '1'   => 'Comité técnico científico',
        '2'   => 'Comité de seguridad del paciente',
        '3'   => 'Comité de Infecciones',
        '4'   => 'Comité calidad',
        '5'   => 'Comité de Gestión ambiental',
        '6'   => 'Comité de Historia clinica',
        '7'   => 'Comité de tecnovigilancia',
        '8'   => 'Comité de farmacia y terapéutica',
        '9'   => 'Comité de reactivovigilancia',
        '10'   => 'Comité de compras',
        '11'   => 'Comité primario Apoyo diagnóstico',
        '12'   => 'Comité primario Cirugía',
        '13'   => 'Comité primario Odontología',
        '14'   => 'Comité primario administrativo',
        '15'   => 'Comité Hospitalario de emergencia',
        '16'   => 'Comité Gerencia coordinadores',
        '17'   => 'Comité Gerencia Directivos',
        '18'   => 'Comité de cartera, facturación y glosas',
        '19'   => 'Comité de seguimiento del mes, ingresos vs costos',
        '21'   => 'Reunión', 
        '20'   => 'Otro' 
   );

   $opcproceso = array(
      '0'   => 'Seleccione un Proceso',
      '999'   => 'NO APLICA'
   );

   $opcionesTsolicitud = array(
      '1'   => 'Creación',
      '2'   => 'Modificación',
      '3'   => 'Eliminación'
   );

   $opcionesLugar= array(
      ''   => 'Seleccione una Opción',
      '1'   => 'Presencial',
      '2'   => 'Virtual'
   );

   $opcsndocrela = array(
      'No'   => 'No',
      'Si'   => 'Si'
   );

   $opcdocrela= array(
      '0'   => 'Documento relacionado',
      '999'   => 'NO APLICA'
   );
?>

    <input type="hidden" name="opc_pag" id="opc_pag" value="modificar">

      <div class="card acard mt-2 mt-lg-3">
        <div class="card-header">
            <h3 class="card-title text-125 text-primary-d2">
               <i class="far fa-edit text-dark-l3 mr-1"></i>
               Modificar Acta
            </h3>
        </div>
        <div class="row mt-3">     
            <div class="card-body px-3 pb-1">
            <?= form_open(base_url('r_actas/Actualizar'), array('id'=>'form_modificar', 'name'=>'form_modificar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>          
               <?= form_input(array('type'=>'hidden', 'name'=>'idActa', 'id'=>'idActa', 'value'=>$c_idActa));?>
               <?= form_input(array('type'=>'hidden', 'name'=>'usuarioResponsable', 'id'=>'usuarioResponsable', 'value'=>$c_id_responsable));?>
               <?= form_input(array('type'=>'hidden', 'name'=>'usuarioActual', 'id'=>'usuarioActual', 'value'=>$c_usuario_a));?>
               <?= form_input(array('type'=>'hidden', 'name'=>'usuarioNomActual', 'id'=>'usuarioNomActual', 'value'=>$c_nombre_usuario_a));?>
               <?= form_input(array('type'=>'hidden', 'name'=>'usuariofirma', 'id'=>'usuariofirma', 'value'=>'00'));?>
               <?= form_input(array('type'=>'hidden', 'name'=>'tareasDB', 'id'=>'tareasDB', 'value'=>'0'));?>
               
                <div class="form-body " style=" justify-content:flex-start;" >
                    <div class="form-group row" id="div_tipo" >
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Fecha Reunión*','fechaR', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-2">                    
                            <?= form_input(array('type'=>'date', 'name'=>'fechaR', 'id'=>'fechaR', 'class'=>'form-control', 'value'=>$c_fecha_reunion));?>
                        </div>
                  
                        <div class="col-sm-1 col-form-label text-sm-right pr-0">
                            <?= form_label('Hora Inicio *','horaI', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-1">
                            <?= form_input(array('type'=>'text', 'name'=>'horaI', 'id'=>'horaI', 'maxlength'=>'5', 'class'=>'form-control', 'value'=>$c_hora_inicio));?>
                        </div>

                        <div class="col-sm-1 col-form-label text-sm-right pr-0">
                            <?= form_label('Hora Final *','horaF', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-1">
                            <?= form_input(array('type'=>'text', 'name'=>'horaF', 'id'=>'horaF', 'maxlength'=>'5', 'class'=>'form-control', 'value'=>$c_hora_final));?>
                        </div>

                        <div class="col-sm-1 col-form-label text-sm-right pr-0">
                            <?= form_label('Lugar *','lugar', array('class'=>'mb-0','id'=>'lbllugar')); ?>
                        </div>
                        <div class="col-sm-2">
                            <?= form_dropdown('lugar', $opcionesLugar, $c_lugar, 'class="form-control" id="lugar"');?>
                        </div>
                    </div>

                    <div class="form-group row " id="div_DatosI">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Proceso o Area*','proceso', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">                    
                            <?= form_input(array('type'=>'text', 'name'=>'proceso', 'id'=>'proceso', 'class'=>'form-control', 'value'=>$c_proceso));?>
                        </div>
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Nombre Comite*','Ncomite', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">                    
                             <?= form_dropdown('Ncomite', $opctipoComite, $c_nombre_reunion, 'class="form-control" id="Ncomite"');?>
                        </div>
                    </div>

                    <div class="form-group row " id="div_DatosII">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Motivo Comite*','motivo', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">                    
                            <?= form_input(array('type'=>'text', 'name'=>'motivo', 'id'=>'motivo', 'class'=>'form-control', 'value'=>$c_motivo_reunion));?>
                        </div> 

                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Otro Cual?','otroNC', array('class'=>'mb-0', 'id'=>'lblotroNC')); ?>
                        </div>
                        <div class="col-sm-4">                    
                            <?= form_input(array('type'=>'text', 'name'=>'otroNC', 'id'=>'otroNC', 'class'=>'form-control','value'=>$c_otro_nombre));?>
                        </div>
                        
                    </div>

                    <div class="form-group row" id="div_anfitrion">                                   
                  
                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Responsable*','empleados_responsable', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= select_empleados_tabla('responsable',$c_id_responsable,'select2 form-control');?>
                        </div>

                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                            <?= form_label('Proyectado por','empleados_proyecta', array('class'=>'mb-0')); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= select_empleados_tabla('proyecta',$c_id_usuario,'select2 form-control');?>
                        </div>
                    </div>

                    <div class="form-group row" id="div_nombre">
                        <div class="card dcard col-sm-12">
                            <div class="card-header">
                              <span class="card-title text-125">
                                Desarrollo
                            </span>
                            </div>

                            <div class="card-body">
                                <div class="form-group row" id="div_Objetivos">
                                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                        <?= form_label('Objetivo','objetivo', array('class'=>'mb-0', 'id'=>'lblnombredoc')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= form_textarea(array('rows'=>'2', 'name'=>'objetivo', 'id'=>'objetivo', 'placeholder'=>'Digite el Objetivo de la Reunión', 'maxlength'=>'255', 'class'=>'form-control', 'value'=>$c_objetivos_reunion));?>
                                    </div>                     
                              
                                    <div class="col-sm-3 col-form-label text-sm-right pr-0">
                                        <?= form_label('Seguimiento Acta Anteriores','seguimiento', array('class'=>'mb-0')); ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= form_textarea(array('rows'=>'2', 'name'=>'seguimiento', 'id'=>'seguimiento', 'placeholder'=>'Digite el numero de acta anterior', 'class'=>'form-control', 'value'=>$c_segumiento_actas));?>
                                    </div>
                                </div>

                                <div class="form-group row" id="div_temas">
                                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                        <?= form_label('Temas Tratados','temas', array('class'=>'mb-0', 'id'=>'lblnombredoc')); ?>
                                    </div>
                                    <div class="col-sm-11">                                        
                                        <?= form_textarea(array('rows'=>'10', 'name'=>'temasD', 'id'=>'temasD', 'placeholder'=>'Detalle los temas tratados en el Comite', 'class'=>'form-control col-sm-12', 'value'=>$c_detalle_temas));?>
                                    </div>                                  
                                </div>

                                <div class="form-group row" id="div_Decisiones ">
                                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                        <?= form_label('Decisiones','decisiones', array('class'=>'mb-0', 'id'=>'lblnombredoc')); ?>
                                    </div>
                                    <div class="col-sm-11">
                                        <?= form_textarea(array('rows'=>'10', 'name'=>'decisionesD', 'id'=>'decisionesD', 'placeholder'=>'Detalle las decisiones tomadas en el Comite', 'class'=>'form-control col-sm-12', 'value'=>$c_detalle_decisiones));?>
                                    </div>                                                                
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <div class="form-group row" id="div_Tareas">
                        <div class="col-12">
                            <div class="card dcard">
                                <div class="card-body px-1 px-md-3">

                                    <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                                    
                                        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
                                            Tareas Asignadas
                                        </h3>  
                                        <div class="mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-blue px-3 d-block w-100 text-95 radius-round border-2 brc-black-tp10" id="btn_agregarTarea">
                                                <i class="fa fa-plus mr-1"></i>                                                                            
                                                 Agregar <span class="d-sm-none d-md-inline">Nueva </span> Tarea
                                            </button>
                                        </div>                                  
                                        
                                    </div>
                                    <hr>
                                    <div class="row" id="tareas">
                                        <div class="col-12">                                              
                                          <table id="tareasAsignadas" class="table border-0 table-bordered brc-black-tp11 bgc-white" style="width:100%">
                                            <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
                                              <tr>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">No.</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">RESPOSABLE</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">DESCRIPCIÓN DE TAREAS ASIGNADAS Y COMPROMISOS ADQUIRIDOS</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">FECHA</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ACCION</th>
                                              </tr>
                                            </thead>
                                            <tbody class="pos-tareas" id="pos-tareas">
                                                <?= form_input(array('type'=>'hidden', 'name'=>'cantTarea', 'id'=>'cantTarea'));?>
                                            </tbody>
                                          </table>                                      
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->                            
                        </div><!-- /.col -->
                    </div><!-- /.form-group row --> 
                  
                
                    <div class="form-group row" id="div_Asistencia">
                        <div class="col-12">
                            <div class="card dcard">
                                <div class="card-body px-1 px-md-3">

                                    <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                                        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4 ">
                                            PARTICIPANTES
                                        </h3> 

                                        <div class="mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-blue px-3 d-block w-100 text-95 radius-round border-2 brc-black-tp10" id="btn_agregarParticipante">
                                                <i class="fa fa-plus mr-1"></i>
                                                 Agregar <span class="d-sm-none d-md-inline">Participante </span>
                                            </button>
                                        </div>                                  
                                    </div>
                                
                                    <hr>
                                    <table id="Asistencia-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                                        <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                                            <tr>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">No.</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">NOMBRES Y APELLIDOS </th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">Cargo</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">Firma</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">ACCION</th>                                      
                                            </tr>
                                        </thead>
                                        <tbody class="mt-1" id= 'pos-partic'>
                                            <?= form_input(array('type'=>'hidden', 'name'=>'cantPart', 'id'=>'cantPart', 'value'=>'0'));?>
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div><!-- /.col -->        
                    </div><!-- /.form-group row --> 

                    <div class="form-group row" id="div_Observaciones">
                        <div class="col-12">
                            <div class="card dcard">
                                <div class="card-body px-1 px-md-3">

                                    <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                                        <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4 ">
                                            OBSERVACIONES 
                                        </h3> 

                                        <div class="mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-blue px-3 d-block w-100 text-95 radius-round border-2 brc-black-tp10" id="btn_agregarObservaciones">
                                                <i class="fa fa-plus mr-1"></i>
                                                 Agregar <span class="d-sm-none d-md-inline">Observaciones </span>
                                            </button>
                                        </div>                                  
                                    </div>
                                    <hr>
                                    <table id="observaciones-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                                        <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                                            <tr>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">No.</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">Observación </th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">Responsable</th>
                                                <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm text-center pr-0">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mt-1" id= 'pos-obser'>
                                            <?= form_input(array('type'=>'hidden', 'name'=>'cantObser', 'id'=>'cantObser', 'value'=>'0'));?>
                                            <?= form_input(array('type'=>'hidden', 'name'=>'newObser', 'id'=>'newObser', 'value'=>'0'));?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group row" id="div_modificar">
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Modificar el Acta','modificar_acta', array('class'=>'mb-0', 'id'=>'lblmodificar_acta')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="checkbox" class="ace-switch input-lg ace-switch-yesno bgc-purple-d1 text-grey-m2" id="modificar_acta" name="modificar_acta" />
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->                                
                            </div><!-- /.card -->
                        </div><!-- /.col -->
                    </div><!-- /.form-group row -->       

                    <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                        <div class="offset-md-3 col-md-9 text-nowrap">
                            <?= form_button(array('type'=>'button', 'id'=>'btn_Actualizar', 'name'=>'btn_Actualizar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                            <?= anchor(base_url('r_actas/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                        </div>
                    </div>
                </div><!-- /.form-body -->    
                <?= form_close(); ?>  
            </div><!-- /.card body -->
        </div><!-- /.row -->
    </div><!-- /.card acard-->

     

   <!-- Modal Tareas Asignadas -->
    <div class="modal fade modal-lg" id="CargarTareasAsignadas" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
       
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bgc-primary-m1 brc-white">
                    <h5 class="modal-title text-white" id="newModalLabel">
                        Agregar Tarea
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?= form_open(base_url('#'), array('id'=>'form_guardarTarea', 'name'=>'form_guardarTarea', 'class'=>'', 'autocomplete'=>'off')); ?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'idEmpleado', 'id'=>'idEmpleado', 'value'=>'0'));?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'tcontCF', 'id'=>'tcontCF', 'value'=>'0'));?>

                    <div class="card-body px-2 pb-1">    
                   
                        <div class="form-group row" id="div_empleado" >
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Responsable *','empleados_responsable', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                               <?= select_empleados_tabla('responsableT','','select2 form-control');?>
                            </div>
                        </div>
                        <div class="form-group row" id="div_tarea" >

                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Descripción Tarea Asignada *','descTareas', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                               <?= form_textarea(array('rows'=>'2', 'name'=>'descTareas', 'id'=>'descTareas', 'placeholder'=>'Describa la tarea asignada', 'class'=>'form-control col-sm-12', 'required'=>true));?>
                            </div>
                        </div>  
                        <div class="form-group row" id="div_empleado" > 
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Fecha Ejecución *','fechaEjecucion', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-4">
                               <?= form_input(array('type' => 'date', 'name' => 'fechaEjecucion', 'id' => 'fechaEjecucion', 'placeholder' => '', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary " id="btn_guardar_tarea" name="btn_guardar_tarea">
                              Guardar
                            </button>                        
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                              Cerrar
                            </button>
                        </div>                
                       
                    </div><!-- /.card-body Modal-->
                    <?= form_close(); ?>
                </div><!-- /.Modal-body -->
            </div> <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-->    

    <!-- Modal Tareas Asignadas -->
    <div class="modal fade modal-lg" id="CargarParticipantes" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
           
        <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header bgc-primary-m1 brc-white">
                  <h5 class="modal-title text-white" id="newModalLabel">
                    Agregar Participantes
                  </h5>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <div class="modal-body">
                    <?= form_open(base_url('#'), array('id'=>'form_guardarParticipante', 'name'=>'form_guardarParticipante', 'class'=>'', 'autocomplete'=>'off')); ?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'idEmpleado', 'id'=>'idEmpleado', 'value'=>'0'));?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'tcontCF', 'id'=>'tcontCF', 'value'=>'0'));?>

                    <div class="card-body px-2 pb-1">    
                   
                        <div class="form-group row" id="div_empleado" >
                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Participante *','empleados_responsableP', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                               <?= select_empleados_tabla('responsableP','','select2 form-control');?>
                            </div>
                        </div>
                        <div class="form-group row" id="div_cargo" >

                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Cargo *','cargo', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                               <?= form_input(array('type' => 'text', 'name' => 'cargo', 'id' => 'cargo', 'class' => 'form-control col-sm-12 col-md-12')); ?>
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary " id="btn_guardar_participante" name="btn_guardar_participante">
                              Guardar
                            </button>                        
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                              Cerrar
                            </button>
                        </div>
                    </div><!-- /.card-body Modal-->
                  <?= form_close(); ?>
                </div><!-- /.Modal-body -->
            </div> <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal--> 

      <!-- Modal Tareas Asignadas -->
    <div class="modal fade modal-lg" id="CargarObservaciones" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
       
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bgc-primary-m1 brc-white">
                    <h5 class="modal-title text-white" id="newModalLabel">
                        Agregar Observaciones
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <?= form_open(base_url('#'), array('id'=>'form_guardarObs', 'name'=>'form_guardarObs', 'class'=>'', 'autocomplete'=>'off')); ?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'idEmpleado', 'id'=>'idEmpleado', 'value'=>'0'));?>
                    <?= form_input(array('type'=>'hidden', 'name'=>'tcontObser', 'id'=>'tcontObser', 'value'=>'0'));?>

                    <div class="card-body px-2 pb-1">    
                                           
                        <div class="form-group row" id="div_tarea" >

                            <div class="col-sm-2 col-form-label text-sm-right pr-0">
                               <?= form_label('Observaciones*','txtObservaciones', array('class'=>'mb-0')); ?>
                            </div>
                            <div class="col-sm-10">
                               <?= form_textarea(array('rows'=>'2', 'name'=>'txtObservaciones', 'id'=>'txtObservaciones', 'placeholder'=>'Describa observaciones que considere deben ser tenidas en cuenta en el Acta', 'class'=>'form-control col-sm-12'));?>
                            </div>
                        </div>                       

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary " id="btn_guardar_observaciones" name="btn_guardar_observaciones">
                              Guardar
                            </button>                        
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                              Cerrar
                            </button>
                        </div>                
                       
                    </div><!-- /.card-body Modal-->
                    <?= form_close(); ?>
                </div><!-- /.Modal-body -->
            </div> <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-->    


      