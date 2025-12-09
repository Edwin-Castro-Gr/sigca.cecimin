<?php
  //echo $id;
   $opciones = array(
      ''   => 'Seleccione una Opción',
      '0'   => 'Pendiente',
      '1'   => 'Aceptada',
      '2'   => 'Rechazada',
      '3'   => 'Revisada',
      '4'   => 'Aprobada',
      '5'   => 'Cerrar',
      '7'   => 'Devuelta'
   );

   $opctipoComite = array(
      '0'   => 'Seleccine una opción',
      '1'   => 'Ambiental',
      '2'   => 'Calidad',
      '3'   => 'Farmacovigilancia',
      '4'   => 'Historias Clínicas',
      '5'   => 'Infecciones',
      '6'   => 'Paciente Seguro',
      '7'   => 'Reactivovigilancia',
      '8'   => 'Tecnovigilancia',
      '9'   => 'Otro'     
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

   <input type="hidden" name="opc_pag" id="opc_pag" value="ingreso">

      <div class="card acard mt-2 mt-lg-3">
         <div class="card-header">
            <h3 class="card-title text-125 text-primary-d2">
               <i class="far fa-edit text-dark-l3 mr-1"></i>
               Nueva Acta de Comite
            </h3>
         </div>
      <div class="row mt-3">     
        <div class="card-body px-3 pb-1">
            <?= form_open(base_url('r_actas/guardar'), array('id'=>'form_guardar', 'name'=>'form_guardar', 'class'=>'mt-lg-3', 'autocomplete'=>'off')); ?>          
            
            <div class="form-body " style=" justify-content:flex-start;" >

                <div class="form-group row" id="div_tipo" >
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Fecha Reunión*','fechaR', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-2">                    
                        <?= form_input(array('type'=>'text', 'name'=>'fechaR', 'id'=>'fechaR', 'class'=>'form-control tinyDate', 'required'=>true));?>
                    </div>
              
                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                        <?= form_label('Hora Inicio *','horaI', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-1">
                        <?= form_input(array('type'=>'text', 'name'=>'horaI', 'id'=>'horaI', 'maxlength'=>'5', 'class'=>'form-control', 'required'=>true));?>
                    </div>

                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                        <?= form_label('Hora Inicio *','horaF', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-1">
                        <?= form_input(array('type'=>'text', 'name'=>'horaF', 'id'=>'horaF', 'maxlength'=>'5', 'class'=>'form-control', 'required'=>true));?>
                    </div>

                    <div class="col-sm-1 col-form-label text-sm-right pr-0">
                        <?= form_label('Lugar *','lugar', array('class'=>'mb-0','id'=>'lbllugar')); ?>
                    </div>
                    <div class="col-sm-2">
                        <?= form_dropdown('lugar', $opcionesLugar, '0', 'class="form-control" id="lugar"');?>
                    </div>
                </div>

                <div class="form-group row " id="div_DatosI">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Proceso o Area*','proceso', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">                    
                        <?= form_input(array('type'=>'text', 'name'=>'proceso', 'id'=>'proceso', 'class'=>'form-control', 'required'=>true));?>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Nombre Comite*','Ncomite', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">                    
                         <?= form_dropdown('Ncomite', $opctipoComite, '', 'class="form-control" id="Ncomite"');?>
                    </div>
                </div>

                <div class="form-group row " id="div_DatosII">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Motivo Comite*','motivo', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">                    
                        <?= form_input(array('type'=>'text', 'name'=>'motivo', 'id'=>'motivo', 'class'=>'form-control', 'required'=>true));?>
                    </div> 

                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Otro Cual?','otroNC', array('class'=>'mb-0', 'id'=>'lblotroNC')); ?>
                    </div>
                    <div class="col-sm-4">                    
                        <?= form_input(array('type'=>'text', 'name'=>'otroNC', 'id'=>'otroNC', 'class'=>'form-control'));?>
                    </div>
                    
                </div>

                <div class="form-group row" id="div_anfitrion">                                   
              
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Responsable','empleados_responsable', array('class'=>'mb-0')); ?>
                    </div>
                    <div class="col-sm-4">
                        <?= select_empleados_tabla('responsable','','select2 form-control');?>
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
                                    <?= form_textarea(array('rows'=>'2', 'name'=>'objetivo', 'id'=>'objetivo', 'placeholder'=>'Digite el Objetivo del Comite', 'maxlength'=>'255', 'class'=>'form-control', 'required'=>true));?>
                                </div>                     
                          
                                <div class="col-sm-3 col-form-label text-sm-right pr-0">
                                    <?= form_label('Seguimiento Acta Anteriores','seguimiento', array('class'=>'mb-0')); ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= form_textarea(array('rows'=>'2', 'name'=>'seguimiento', 'id'=>'seguimiento', 'placeholder'=>'Digite el Objetivo del Comite', 'class'=>'form-control', 'required'=>true));?>
                                </div>
                            </div>

                            <div class="form-group row" id="div_temas">
                                <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                    <?= form_label('Temas Tratados','temas', array('class'=>'mb-0', 'id'=>'lblnombredoc')); ?>
                                </div>
                                <div class="col-sm-11">
                                    <?= form_input(array('type'=>'text', 'name'=>'temas', 'id'=>'temas', 'placeholder'=>'Temas Tratados', 'maxlength'=>'255', 'class'=>'form-control UpperCase', 'required'=>true));?>

                                    <?= form_textarea(array('rows'=>'10', 'name'=>'temasD', 'id'=>'temasD', 'placeholder'=>'Detalle los temas tratados en el Comite', 'class'=>'form-control col-sm-12', 'required'=>true));?>
                                </div>                                  
                            </div>

                            <div class="form-group row" id="div_Decisiones ">
                                <div class="col-sm-1 col-form-label text-sm-right pr-0">
                                    <?= form_label('Decisiones','decisiones', array('class'=>'mb-0', 'id'=>'lblnombredoc')); ?>
                                </div>
                                <div class="col-sm-11">
                                    <?= form_input(array('type'=>'text', 'name'=>'decisiones', 'id'=>'decisiones', 'placeholder'=>'Temas Tratados', 'maxlength'=>'255', 'class'=>'form-control UpperCase', 'required'=>true));?>

                                    <?= form_textarea(array('rows'=>'10', 'name'=>'decisionesD', 'id'=>'decisionesD', 'placeholder'=>'Detalle los temas tratados en el Comite', 'class'=>'form-control col-sm-12', 'required'=>true));?>
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
                                    <div class="form-group row" id="encabezado" >
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

                                    <div class="form-group row" id="div_empleado" >
                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Responsable *','empleadosusuario', array('class'=>'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= select_empleados_tabla('Responsable','','select2 form-control col-sm-12 col-md-10');?>
                                        </div>

                                        <div class="col-sm-2 col-form-label text-sm-right pr-0">
                                            <?= form_label('Descripción Tarea Asignada *','tareasAsignadas1', array('class'=>'mb-0')); ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?= form_textarea(array('rows'=>'2', 'name'=>'tareasAsignadas1', 'id'=>'tareasAsignadas1', 'placeholder'=>'Describa la tarea asignada', 'class'=>'form-control col-sm-12', 'required'=>true));?>
                                        </div>
                                    </div>
                              </div>
                            </div>

                            <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                                <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                                    <tr>
                                        <th class="text-center pr-0">
                                            No.
                                        </th>

                                        <th class="text-center pr-0">
                                            Responsable
                                        </th>

                                        <th class="text-center pr-0">
                                            Descripción de Tareas Asignadas y Compromisos Adquiridos
                                        </th>

                                        <th class="text-center pr-0">
                                            Fecha
                                        </th>

                                        <th class="text-center pr-0">
                                            acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="mt-1" id= 'tb_container'>
                                    <tr class="bgc-h-yellow-l4 d-style">
                                        <?= form_input(array('type'=>'hidden', 'name'=>'cantTarea', 'id'=>'cantTarea', 'value'=>'1'));?>
                                        <td class='text-center pr-0 pos-rel' id=''>
                                            1
                                        </td>

                                        <td>
                                            <?= form_input(array('type'=>'text', 'name'=>'participanteT1', 'id'=>'participanteT1', 'placeholder'=>'Nombres y Apellidos', 'class'=>'form-control col-sm-12',  'required'=>true));?>
                                        </td>

                                        <td>
                                             <?= form_textarea(array('rows'=>'2', 'name'=>'tareasAsignadas1', 'id'=>'tareasAsignadas1', 'placeholder'=>'Describa la tarea asignada', 'class'=>'form-control col-sm-12', 'required'=>true));?>
                                        </td>

                                        <td>
                                            <?= form_input(array('type'=>'text', 'name'=>'fechaT1', 'id'=>'fechaT1', 'class'=>'form-control tinyDate col-sm-6', 'required'=>true));?>
                                        </td>

                                        <td>
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex'>
                                                <!-- <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                                                  <i class="fa fa-pencil-alt"></i>
                                                </a> -->

                                                <!-- <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                                                  <i class="fa fa-trash-alt"></i>
                                                </a> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
                
                <div class="form-group row" id="div_Asistencia">
                    <div class="col-12">
                        <div class="card dcard">
                            <div class="card-body px-1 px-md-3">

                                <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                                    <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
                                        Participantes
                                    </h3> 

                                    <div class="mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-blue px-3 d-block w-100 text-95 radius-round border-2 brc-black-tp10" id="btn_agregarParticipante">
                                            <i class="fa fa-plus mr-1"></i>
                                             Agregar <span class="d-sm-none d-md-inline">Participante </span>
                                        </button>
                                    </div>                                  
                                </div>
                            </div>

                            <table id="Asistencia-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                                <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                                    <tr>
                                        <th class="text-center pr-0">
                                            No.
                                        </th>

                                        <th class="text-center pr-0">
                                            Nombres y Apellidos
                                        </th>

                                        <th class="text-center pr-0">
                                            Cargo
                                        </th>

                                        <th class="text-center pr-0">
                                            
                                        </th>  

                                        <th class="text-center pr-0" colspan="3">
                                            Firma
                                        </th>                                      
                                    </tr>
                                </thead>
                                <tbody class="mt-1" id= 'tb_containerPart'>
                                    <?= form_input(array('type'=>'hidden', 'name'=>'cantPart', 'id'=>'cantPart', 'value'=>'1'));?>
                                    <tr class="bgc-h-yellow-l4 d-style">
                                        <td class='text-center pr-0 pos-rel'>
                                            1
                                        </td>

                                        <td>
                                             <?= form_input(array('type'=>'text', 'name'=>'participanteP1', 'id'=>'participanteP1', 'placeholder'=>'Nombres y Apellidos', 'class'=>'form-control', 'required'=>true));?>
                                        </td>

                                        <td>
                                            <?= form_input(array('type'=>'text', 'name'=>'cargo1', 'id'=>'cargo1', 'class'=>'form-control', 'placeholder'=>'Registre el Cargo', 'required'=>true));?>
                                        </td>

                                        <td class="text-center ">
                                            <button type="button" class="btn btn-blue px-3 d-flex text-95 radius-round border-2 brc-black-tp10" id="btn_firma_empleado">                                                
                                                <span class="d-sm-none d-md-inline" id="btn_firma_empleado">Firmar</span>
                                            </button>
                                        </td>
                                        <td class="text-center ">
                                             <button type="button" class="btn btn-green px-3 d-flex text-95 radius-round border-2 brc-black-tp10" id="btn_cargar_firma">                                                
                                                <span class="d-sm-none d-md-inline" id="btn_cargar_firma">Cargar</span>
                                            </button>
                                        </td>

                                        <td>
                                            <!-- action buttons -->
                                            <div class='d-none d-lg-flex'>
                                               <img src = "" id = "signaturePreview1" width="200" height="40">
                                               <?= form_input(array('type'=>'file', 'name'=>'fileF1', 'id'=>'fileF1', 'class'=>'form-control'));?>
                                               <?= form_input(array('type'=>'hidden', 'name'=>'file64F1', 'id'=>'file64F1'));?>
                                            </div>
                                        </td>                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->        
                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                    <div class="offset-md-3 col-md-9 text-nowrap">
                        <?= form_button(array('type'=>'button', 'id'=>'btn_guardar', 'name'=>'btn_guardar', 'content'=>'<i class="fa fa-check mr-1"></i>Guardar', 'class'=>'btn btn-info btn-bold px-4')); ?>

                        <?= anchor(base_url('d_solicitud/index'), '<i class="fa fa-undo mr-1"></i> Cancelar', array('class'=>'btn btn-danger btn-rounded m-t-10')); ?>
                    </div>
                </div>
              
          <?= form_close(); ?>
        </div><!-- /.card-body -->
      </div><!-- /.card -->

  <!-- Modal Nuevo -->
    <div class="modal" id="firmaModal" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bgc-primary-m1 brc-white">
            <h5 class="modal-title text-white" id="newModalLabel">
              Firmar Asistencia
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <?= form_open(base_url('#'), array('id'=>'form_guardarFirma', 'name'=>'form_guardarFirma', 'class'=>'', 'autocomplete'=>'off')); ?>
                <?= form_input(array('type'=>'hidden', 'name'=>'idEmpleado', 'id'=>'idEmpleado', 'value'=>'0'));?>
                <?= form_input(array('type'=>'hidden', 'name'=>'tcont', 'id'=>'tcont', 'value'=>'1'));?>

               <div class="card-body px-2 pb-1">                    
               
                 <!--  <div class="form-group row " id="div_correoDatos">
                     <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <?= form_label('Corfimar Email*','email', array('class'=>'mb-0')); ?>
                     </div>
                     <div class="col-sm-8">                    
                        <?= form_input(array('type'=>'text', 'name'=>'email', 'id'=>'email', 'class'=>'form-control', 'required'=>true));?>
                     </div>                    
                     <div class="col-sm-2">                    
                        <button type="button" class="btn btn-warning clear" id="btn_enviarCorreo" >Enviar </button>
                     </div>
                  </div>
                  <div class="form-group row " id="div_confirmacionDatos">
                     <div class="col-sm-3 col-form-label text-sm-right pr-0">
                        <?= form_label('Codigo Confirmación*','codigoC', array('class'=>'mb-0')); ?>
                     </div>
                     <div class="col-sm-4">                    
                        <?= form_input(array('type'=>'text', 'name'=>'codigoC', 'id'=>'codigoC', 'class'=>'form-control', 'required'=>true));?>
                     </div>
                  </div>
                  <div class="form-group row " id="div_correoDatos">
                  
                  </div> -->
                    <!-- Contenedor y Elemento Canvas -->
                  <div id="signature-pad" class="signature-pad" >
                     <div class="description">Firmar aqui</div>
                     <div class="signature-pad--body ">
                        <canvas id="canvas"></canvas>                                
                     </div>
                  </div>                        
                        
                </div><!-- /.card-body Modal-->
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning clear" id="btn_borrar" >Limpiar</button>
                    <button type="button" class="btn btn-success save" id="btn_firmar" >guardar</button>                    
                </div>
            <?= form_close(); ?>
          </div><!-- /.Modal-body -->
        </div> <!-- /.modal-content -->
      </div>
    </div>    <!-- /.Modal -->

    <!-- Modal Nuevo -->
    <div class="modal" id="CargarfirmaModal" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bgc-primary-m1 brc-white">
            <h5 class="modal-title text-white" id="newModalLabel">
              Cargar Firma
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <?= form_open(base_url('#'), array('id'=>'form_guardarFirma', 'name'=>'form_guardarFirma', 'class'=>'', 'autocomplete'=>'off')); ?>
               <?= form_input(array('type'=>'hidden', 'name'=>'idEmpleado', 'id'=>'idEmpleado', 'value'=>'0'));?>
               <?= form_input(array('type'=>'hidden', 'name'=>'tcontCF', 'id'=>'tcontCF', 'value'=>'0'));?>

                <div class="card-body px-2 pb-1">                    
                        
                    <!-- Contenedor y Elemento file -->
                    <div class="form-group row ">
                        <div class="col-sm-2 col-form-label text-sm-right pr-0"></div>
                        <div class="col-sm-8 text-center">
                           <input type="file" class="ace-file-input" id="imagenFirma" />
                        </div>
                     </div>                       
                        
                </div><!-- /.card-body Modal-->
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning clear" id="btn_borrar" >Limpiar</button>
                    <button type="button" class="btn btn-success save" id="btn_guardarFirmar" >guardar</button>                    
                </div>
            <?= form_close(); ?>
          </div><!-- /.Modal-body -->
        </div> <!-- /.modal-content -->
      </div>
    </div>    <!-- /.Modal -->
    </div>
</div><!-- /.card -->
