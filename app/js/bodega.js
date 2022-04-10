
$(document).ready(function(){
    tablabodega(); 
   
    });

    function mayus(e){
        e.value = e.value.toUpperCase();
    }


function tablabodega(){  
    $.ajax({
         url : 'tablabodega.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablabodega").html(r);
     })
     
 } 



function ingresarbodega(){
    var nombodega=document.getElementById("nombodega").value;
    
    
    if(nombodega=="" ){

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
            icon: 'warning',
            title: 'EL CAMPO VACIOS'
            })
    }

    if(nombodega!="" ){
        var nombodega = $('#nombodega').val(),
        cantidadbodega = $('#cantidadbodega').val(),
        idcategoria = $('#idcategoria').val(),
        costobodega = $('#costobodega').val(),
        facturabodega = $('#facturabodega').val();

        console.log(nombodega);


        $.ajax({
            url: 'ibodega.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { nombodega:nombodega, cantidadbodega:cantidadbodega,idcategoria:idcategoria,costobodega:costobodega,facturabodega:facturabodega},
            beforeSend: function(){},
            success: function(){
                $('#nombodega').val('');
                $('#cantidadbodega').val('');
                $('#costobodega').val('');

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
            title: 'PRODUCTO AGREGADO'
            })
            tablabodega();

            //citadoctor();
                }
            });
    }



}


$(buscar_datos());

function buscar_datos(consulta){
    
    var orden = $('#orden').val();
    
    $.ajax({
        url: 'tablabodega.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,orden:orden},
    })
    .done(function(respuesta){
        $("#tablabodega").html(respuesta);
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




function ingresarbodegan(){
    var cantbode=document.getElementById("cantbode").value;
    
    
    if(cantbode=="" ){

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
            icon: 'warning',
            title: 'EL CAMPO VACIOS'
            })
    }



    if(cantbode!="" ){
        var cantbode = $('#cantbode').val(),
        idbode = $('#idbode').val(),
        ncantbode = $('#ncantbode').val(),
        proveedor = $('#proveedor').val(),
        coston = $('#coston').val(),
        factura = $('#factura').val();
        
        coston

       // console.log(nombodega);


        $.ajax({
            url: 'ibodegamov.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { cantbode:cantbode, idbode:idbode,ncantbode:ncantbode,proveedor:proveedor,coston:coston,factura:factura},
            beforeSend: function(){},
            success: function(){
                $('#ncantbode').val('');
                $('#coston').val('');
     

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
            title: 'PRODUCTO AGREGADO'
            })
            tablabodega();

            //citadoctor();
                }
            });
    }


}