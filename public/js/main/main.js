(function($) {

    "use strict";
    $(window).on('load', function() { // makes sure the whole site is loaded 
        // hidePreloader();
    })

    

})(jQuery);


function preloader(){
    $('#status').fadeIn();
    $('#preloader').fadeIn('slow')
}

function hidePreloader(){
    $('#status').fadeOut(); // will first fade out the loading animation 
    $('#preloader').fadeOut('slow')
}

function blockPage(){
    $.blockUI({
        message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Cargando ...</div>',
        overlayCSS: {
            backgroundColor: '#FFF',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            
        }
    });

}

function unBlockPage(){
    $.unblockUI();
}

function urlPath(){

    var protocol = window.location.protocol;
    var URLdomain = window.location.host;

    var url = protocol+'//'+URLdomain+'/admin/';

    return url;
}

function resetFormulario(form){

    $(form+' input[type=text]').val('');
    $(form+' input[type=email]').val('');
    $(form+' select').val('');
    $(form+' .select2').val(null).trigger('change');

    if($(form+' input[type=password]').length > 0){
        $(form+' input[type=password]').val('');
    }

    $(form+' div').removeClass('has-error');

    
}

function notification(title,message,type){

    switch(type){
        case 'success':
            $.growl.notice({ title: title, message: message, size: 'large' });
            break;
        case 'error':
            $.growl.error({ title: title, message: message, size: 'large' });
            break;

        case 'warning':
            $.growl.warning({ title: title, message: message, size: 'large' });
            break;

        default:
            $.growl({ title: title, message: message, size: 'large' });
            break;
    }
    
}

function cargarDataModal(ruta,type,str,modal,form){

    var url = urlPath()+'controller/'+ruta;

    if(type == ''){
        type = 'POST';
    }

    $.ajax({
        beforeSend:function(){
            blockPage();
        },
        url: url,
        cache: false,
        type: type,
        dataType: "json",
        data: str,
        success: function(response){

            unBlockPage();

            if(response.respuesta == true){
                
                var data = response.data;

                $.each(data,function(e){
                    $(form+' #'+e).val(data[e]);
                });

                $(modal).modal('show');

            }else{
                notification('Error..!', response.message,'error');
            }

        },
        error: function(e){
            
            msgErrorsForm(e);
            
        }

    });

}

function deleteRow(url,table,slug=null){

    var ruta = urlPath()+'controller/'+url;
    var str = 'slug='+slug;

    bootbox.dialog({
        message: "Esta seguro de eliminar este registro?",
        title: "Eliminar Registro",
        buttons: {
            cancel: {
                label: "Cancelar",
                className: "btn-secondary"
            },
            confirm: {
                label: "Ok",
                className: "btn-success",
                callback: function() {

                    $.ajax({
                        beforeSend:function(){
                            blockPage();
                        },
                        url: ruta,
                        cache: false,
                        type: "DELETE",
                        dataType: "json",
                        data: str,
                        success: function(response){
                            
                            if(response.respuesta==false){
                                unBlockPage();
                                notification('Advertencia..!', response.message,'error');
                            }else{

                                table.draw();
                                notification('Exito..!', 'Registro eliminado exitosamente','success');

                            }

                        },
                        error: function(data){
                            unBlockPage();
                            console.log(data);
                        }

                    });

                }
            }
            
        },
        className: "bootbox-sm modal-dialog-centered-custom"
    });
    
}

//mostrar los errores que nos provee laravel
function msgErrors(xhr,label = false){
    
    var dataError = xhr.responseJSON.errors;
    
    var str = '';
    //recorremos el arreglo para concatenar todos los errores
    $.each(dataError,function(error){
        
        var key = error.charAt(0).toUpperCase() + error.slice(1);
        str += label==true ? '<strong>'+key+':</strong><br>':'';

        $.each(dataError[error],function(m){
            str += '<i class="ft-check"></i> '+dataError[error][m]+'<br>'; //lo almacenamos en esta variable
        });
        str += label==true ? '<br>':'';
    });

    notification('Error..!', str,'error');
}

function msgErrorsForm(xhr){
    
    var dataError = xhr.responseJSON;
    
    var str = '';
    
    $.each(dataError,function(error){
        
        str += '<i class="ft-check"></i> '+dataError[error]+'<br>'; //lo almacenamos en esta variable
       
    });

    notification('Error..!', str,'error');
}