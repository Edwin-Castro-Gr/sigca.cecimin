$(function () {

    cargar_notificacion();
    var cant_noti = 0;
    var bandera = 0;

    var myVer =  setInterval(function() { cargar_notificacion() }, 10000);

    function cargar_notificacion() {
        $.post("/home/cargar_notificacion", {}, function(data_noti){
            //alert(data_noti['noti'][0].cantidad);
            if(data_noti['noti'][0].cantidad > 0) {
                if(bandera == 0) {
                    $('#id-navbar-badge1').removeClass('bgc-default-d1'); //Fondo default
                    $('#id-navbar-badge1').addClass('bgc-warning-d2'); //Fondo amarillo
                    bandera = 1;
                }
                $('#id-navbar-badge1').html(data_noti['noti'][0].cantidad);
                $('#navbar-notif-tab-1').html(data_noti['noti'][0].listado);
                porc = 100 - ((data_noti['noti'][0].cantidad * 100) / data_noti['noti'][0].total);
                //alert(data_noti['noti'][0].cantidad + '--' + porc + '-'+data_noti['noti'][0].total);
                $('#id-navbar-task-progress').html('<div class="progress-bar bgc-info" role="progressbar" style="width: '+porc+'%;" aria-valuenow="'+porc+'" aria-valuemin="0" aria-valuemax="100">'+porc+'%</div>');
                $('#id-navbar-task').html('<i class="fa fa-check mr-2px text-warning-d2 text-120"></i>'+ data_noti['noti'][0].cantidad +' Tareas por completar')
            } else {
                if(data_noti['noti'][0].cantidad != bandera) {
                    $('#id-navbar-badge1').removeClass('bgc-warning-d2'); //Fondo amarillo
                    $('#id-navbar-badge1').addClass('bgc-default-d1'); //Fondo default
                
                    $('#id-navbar-badge1').html('0');
                    $('#navbar-notif-tab-1').html(data_noti['noti'][0].listado);
                    porc = (data_noti['noti'][0].cantidad * 100) / data_noti['noti'][0].total;
                    $('#id-navbar-task-progress').html('<div class="progress-bar bgc-info" role="progressbar" style="width: '+porc+'%;" aria-valuenow="'+porc+'" aria-valuemin="0" aria-valuemax="100">'+porc+'%</div>');
                    $('#id-navbar-task').html('<i class="fa fa-check mr-2px text-warning-d2 text-120"></i>0 Tareas por completar')
                    bandera = 0;
                }
            }          
        });
    }
    
});