var formcateproducto = '#form-categoria-producto';
var url = urlPath();

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });


    //DATA
    var table = $('.data-table-cpro').DataTable({

        serverSide: true,

        ajax: url+"data/cateproducto-data",

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'descripcion', name: 'descripcion'},
            {data: 'contador', name: 'contador', className:'text-center'},
            {data: 'action', name: 'action', className:'text-center',orderable: false, searchable: false},

        ],
        language:{
            "url": url+"js/datatable_Es/Spanish.json"
        }

    });

    $('#btn-nueva-categoria').click(function(){

        resetFormulario(formcateproducto);
        $(formcateproducto+' input[name="id"]').val('0');
        $(formcateproducto+' input[name="accion"]').val('add');
        $('#modal-categoria-producto').modal('show');
    });

    $(formcateproducto).validate({
        submitHandler: function(){

            var str = $(formcateproducto).serialize();
            var urlajax = url+'controller/categoriaproducto';

            var accion = $(formcateproducto+' input[name="accion"]').val();

            var type = 'POST';

            if(accion == 'edit'){
                type = 'PUT';
            }

            $.ajax({
                url: urlajax,
                cache: false,
                type: type,
                dataType: "json",
                data: str,
                success: function(response){

                    console.log(response);

                },
                error: function(e){
                    
                    console.log(e);
                }

            });


            return false;
        },
        errorPlacement: function(){

        }
    });

    $("#btn-save-cpro").click(function(){

        // $(formcateproducto).submit();
        console.log($(formcateproducto).serialize());
    });

    

});