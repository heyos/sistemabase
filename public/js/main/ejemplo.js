var formcateproducto = '#form-cateproducto';
$(document).ready(function(){


    $('#openModal').click(function(){

        resetFormulario(formcateproducto);
        $('#modal').modal('show');
    });

});