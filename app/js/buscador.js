$(buscar_datos());

function buscar_datos(consulta){
    
    var ord = $('#ord').val();
    
    $.ajax({
        url: 'buscarplato.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,ord:ord},
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}




$(document).ready(function(){
    //$("#caja_busqueda").focus();
    $(document).on('keyup','#caja_busqueda', function(){
        var valor = $(this).val();
        if (valor != "") {
            buscar_datos(valor);
        }else{
            buscar_datos();
        }
    });
});

