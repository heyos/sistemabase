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
                    $('.button-send').html('<i class="la la-refresh spinner"></i> Cargando ...');
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
                error: function(xhr,textStatus,thrownError){
                    
                    $('.button-send').prop('disabled', false);
                    $('.button-send').html('<i class="ft-unlock"></i> Login ');
                    
                    msgErrors(xhr);

                }

            });


            return false;

        },
        errorPlacement: function(){

        }
    });

});