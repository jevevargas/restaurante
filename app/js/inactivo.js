

$(document).ready(function(){
    tablai();
    });

    function mayus(e){
        e.value = e.value.toUpperCase();
    }


function tablai(){  

    $.ajax({
         url : 'buscadorinac.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablai").html(r);
     })
     
 } 





$(buscar_datos());

function buscar_datos(consulta){
    
    var orden = $('#orden').val();
    
    $.ajax({
        url: 'buscadorinac.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,orden:orden},
    })
    .done(function(respuesta){
        $("#tablai").html(respuesta);
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



function activar(){
    var desacti = $('#desacti').val();

        $.ajax({
            url: 'activarplato.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { desacti:desacti},
            beforeSend: function(){},
            success: function(){
                $('#despla').val('');
    
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
            title: 'ACTIVADO'
            })
            tablai(); 
            
    
            //citadoctor();
                }
            });
}
