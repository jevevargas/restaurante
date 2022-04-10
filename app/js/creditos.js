$(buscar_datos());

function buscar_datos(consulta){
    
    var orden = $('#orden').val();
    
    $.ajax({
        url: 'buscarcredito.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,orden:orden},
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}


$(document).on('keyup','#caja_busqueda', function(){
    var valor = $(this).val();
    if (valor != "") {
        buscar_datos(valor);
    }else{
        buscar_datos();
    }
});

$(document).ready(function(){
    $("#caja_busqueda").focus();
});


$(document).on('click', '.pagar', function(){
    var id=$(this).val();
    var ap=$('#ap'+id).text();
 
    console.log(ap);

    $('#pagar').modal('show');
    $('#ap').val(ap);

});



function pagarcredito(){
    var ap = $('#ap').val(),
    metodo = $('#metodo').val();

    $.ajax({
        url:'pagar.php',
        type: 'POST',
        data:{'ap':ap, 'metodo':metodo},
        beforeSend:function(){},
           
        success: function(){

        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        
        })
        Toast.fire({
        icon: 'success',
        title: 'Pagado'
        })
    
        }
        
        });
}