var form = '#formRegistro';
var modal = '#modalRegistro';
var formPage = '#formPage'
var modalPage = '#modalInicio';
var url = urlPath();
var urlRoot = urlPathRoot();
var urlAction = url+'controller/perfil';
var slug = $('#slug').val();
var urlData = url+'data/perfil-data/'+slug;

$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    //DATA
    var table = $('#list').DataTable({

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
            {data: 'nombre', name: 'nombre',className:'text-center'},
            {data: 'page_inicio', name: 'page_inicio', className:'text-center'},
            {data: 'isRoot', name: 'isRoot', className:'text-center', searchable: false},
            {data: 'action', name: 'action', className:'text-center',orderable: false, searchable: false},

        ],
        language:{
            "url": urlRoot+"js/datatable_Es/Spanish.json"
        }

    });

    $('#btnAdd').click(function(){

        resetFormulario(form);
        $(form +' input[name=accion]').val('add');
        $(modal+ ' .modal-title').text('Registrar Nuevo Perfil');
        $(modal).modal('show');
        
    });

    $('#btn-save').click(function(){

        
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
                $(modal+ ' .modal-title').text('Actualizar Perfil');
                cargarDataModal(controller,'GET','',modal,form);

                break;

            case 'start':

                resetFormulario(formPage);
                $(formPage +' input[name=id]').val(id);
                controller = urlAction+'/page-default/'+id;

                var opt = '';

                $.ajax({
                    beforeSend:function(){
                        blockPage();
                    },
                    url: controller,
                    cache: false,
                    type: 'GET',
                    dataType: "json",
                    success: function(response){

                        unBlockPage();

                        if(response.respuesta == true){

                            $(formPage +' input[name=accion]').val('start');
                            $(formPage +' input[name=id]').val(id);
                            $(formPage +' input[name=nombre]').val(response.info);

                            var pages = response.data;

                            $.each(pages,function(e){
                    
                               opt += '<option value="'+pages[e]['vista']+'">'+pages[e]['nombre']+'</option>';
                            
                            });

                            $('#page_default').html(opt);
                            $('#page_default').val(response.default).trigger('change');
                            
                            $(modalPage).modal('show');
                                                    
                        }else{
                            notification('Error..!', response.message,'error');
                            
                        }

                    },
                    error: function(e){
                        
                        unBlockPage();
                        msgErrorsForm(e);
                        
                    }

                });
                
                break;

            case 'delete':
                deleteRow(controller,table,'usuarios');
                break;
        }

    });

    //actualizar pagina de inicio
    $('#btn-page').click(function(){

        var str = $(formPage).serialize()+'&slug='+slug;
        var type = 'PUT';
        var controller = urlAction;
        var accion = $(formPage+' input[name="accion"]').val();
        var id = $(formPage+' input[name="id"]').val();
        controller += '/'+id;
        

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
                    
                    $(modalPage).modal('hide'); 
                    
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

});
