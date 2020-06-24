var form = '#formUsuario';
var modal = '#modalRegistro';
var url = urlPath();
var urlRoot = urlPathRoot();
var urlAction = url+'controller/users';
var urlData = url+'data/users-data/usuarios';

$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    //DATA
    var table = $('#list-users').DataTable({

        serverSide: true,
        ajax: {
            "url":urlData,
            complete: function(){
                hidePreloader();
                unBlockPage();
            }
        },

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex',className:'text-center'},
            {data: 'name', name: 'name',className:'text-center'},
            {data: 'email', name: 'email', className:'text-center'},
            {data: 'perfil', name: 'perfil', className:'text-center'},
            {data: 'action', name: 'action', className:'text-center',orderable: false, searchable: false},

        ],
        language:{
            "url": urlRoot+"js/datatable_Es/Spanish.json"
        }

    });

    $('#btnAdd').click(function(){

        resetFormulario(form);
        $(form +' input[name=accion]').val('add');
        $(modal+ ' .modal-title').text('Registrar Usuario');
        $(modal).modal('show');
        
    });

    $('#btn-save').click(function(){

        var slug = $('#slug').val();
        var str = $(form).serialize()+'&slug='+slug;
        var type = 'POST';
        var controller = urlAction;
        var accion = $(form+' input[name="accion"]').val();
        
        if(accion == 'edit'){
            type = 'PUT';
            var id = $(form+' input[name="id"]').val();
            controller += '/'+id;
        }

        $.ajax({
            beforeSend:function(){
                blockPage();
            },
            url: controller,
            cache: false,
            type: type,
            dataType: "json",
            data: str,
            success: function(response){

                if(response.respuesta == true){
                    $(modal).modal('hide');
                    table.draw();
                    notification('Exito..!', response.message,'success');
                }else{
                    notification('Error..!', response.message,'error');
                    unBlockPage();
                }

            },
            error: function(e){
                
                unBlockPage();
                msgErrorsForm(e);
                
            }

        });
    });

    $('body').on('click','#listadoOk a',function(e){

        e.preventDefault();
        e.stopPropagation();

        var accion = $(this).data('accion');
        var id = $(this).attr('href');

        var controller = urlAction+'/'+id;

        switch(accion){

            case 'edit':
                resetFormulario(form);
                $(form +' input[name=accion]').val('edit');
                $(form +' input[name=id]').val(id);
                $(modal+ ' .modal-title').text('Actualizar Usuario');
                cargarDataModal(controller,'GET','',modal,form);

                break;

            case 'delete':
                deleteRow(controller,table,'usuarios');
                break;
        }

    })

});
