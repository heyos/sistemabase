var url = urlPath();
var formLogin = $('#formLogin');

$(document).ready(function(){

    formLogin.validate({
        submitHandler: function(){

            console.log("url", url);

            var str = formLogin.serialize();
            var path = url+'login';

            $.ajax({
                beforeSend: function(){
                    $('.button-send').prop('disabled', true);
                    $('.button-send').html('<i class="ft-refresh-cw"></i> Cargando ...');
                },
                type: 'POST',
                url: path,
                cache: false,
                dataType: 'json',
                data: str,
                success: function(response){
                    
                    if(response.success==false){
                        notification('Error..!', response.message,'error');
                    }else{
                        notification('Exito..!', response.message,'success');

                        window.location.href = url+response.page;

                    }

                },
                error: function(e){

                    $('.button-send').prop('disabled', false);
                    $('.button-send').html('<i class="ft-unlock"></i> Login ');
                    
                    //capturamos los errores que nos provee laravel
                    var dataError = e.responseJSON.errors;

                    var str = '';
                    //recorremos el arreglo para concatenar todos los errores
                    $.each(dataError,function(error){
                        
                        $.each(dataError[error],function(m){
                            str += '<i class="ft-check"></i> '+dataError[error][m]+'<br>'; //lo almacenamos en esta variable
                        });

                    });
                    
                    notification('Error..!', str,'error');

                }

            });


            return false;

        },
        errorPlacement: function(){

        }
    });

});