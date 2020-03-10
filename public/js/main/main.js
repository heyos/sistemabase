function urlPath(){

    var protocol = window.location.protocol;
    var URLdomain = window.location.host;

    var url = protocol+'//'+URLdomain+'/';

    return url;
}

function resetFormulario(form){

    $(form+' input[type=text]').val('');
    $(form+' input[type=email]').val('');
    $(form+' select').val('');
    $(form+' .select2').val(null).trigger('change');

    // $('#'+form+' div').removeClass('has-error');

    
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