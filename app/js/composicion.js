
$(document).ready(function(){
    tablacompo(); 
    tablac();
    });

    function mayus(e){
        e.value = e.value.toUpperCase();
    }


function tablacompo(){  
    var idplato = $('#idplato').val();
    $.ajax({
         url : 'tablacompo.php',
         type : 'POST',
         dataType : 'html',
         data : {idplato:idplato},
     })
     .done(function(r){
         $("#tablacompo").html(r);
     })
     
 } 


 function tablac(){  
 
    $.ajax({
         url : 'buscador.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablac").html(r);
     })
     
 } 

function compocicion(){
    var cantidad=document.getElementById("cantidad").value;
  
    if(cantidad=="" ){

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

    if(cantidad!=""  ){
        var idbodega = $('#idbodega').val(),
        cantidad = $('#cantidad').val(),
        idplato = $('#idplato').val();


        $.ajax({
            url: 'icompocicion.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { idbodega:idbodega, cantidad:cantidad,idplato:idplato},
            beforeSend: function(){},
            success: function(){
                $('#cantidad').val('');

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
            title: 'AGREGADO EL INGREDIENTE AL PLATO'
            })
            tablacompo(); 

            //citadoctor();
                }
            });
    }
}



function eliminarcompo(){
    var idcompo = $('#idcompo').val();

    $.ajax({
        url: 'ecompo.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
        method: 'POST',
        data: { idcompo:idcompo},
        beforeSend: function(){},
        success: function(){
            $('#cantidad').val('');

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
        title: 'INGREDIENTE ELIMIMANDO'
        })
        tablacompo(); 

        //citadoctor();
            }
        });
}



function finalizarcompo(){
    var idplato = $('#idplato').val();

    $.ajax({
        url: 'finalizarcompo.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
        method: 'POST',
        data: { idplato:idplato},
        beforeSend: function(){},
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
        title: 'FINALIZADO'
        })
        tablacompo(); 

        //citadoctor();
            }
        });
}


$(buscar_datos());

function buscar_datos(consulta){
    
    var orden = $('#orden').val();
    
    $.ajax({
        url: 'buscador.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,orden:orden},
    })
    .done(function(respuesta){
        $("#tablac").html(respuesta);
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




function modificarnom(){
    var nomrepla=document.getElementById("nomrepla").value;
  
    if(nomrepla=="" ){

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

    if(nomrepla!=""  ){
        var nomrepla = $('#nomrepla').val(),
            nome = $('#nome').val();

            $.ajax({
                url: 'modnompbreplato.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { nomrepla:nomrepla,nome:nome},
                beforeSend: function(){},
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
                title: 'MODIFICADO'
                })
                tablacompo(); 
                tablac();
        
                //citadoctor();
                    }
                });

    }

}



function modificarprecio(){
    var preciopla=document.getElementById("preciopla").value;
  
    if(preciopla=="" ){

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

    if(preciopla!=""  ){
        var preciopla = $('#preciopla').val(),
        preciop = $('#preciop').val();

            $.ajax({
                url: 'modprecioplato.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { preciop:preciop,preciopla:preciopla},
                beforeSend: function(){},
                success: function(){
                    $('#preciopla').val('');
        
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
                title: 'MODIFICADO'
                })
                tablacompo(); 
                tablac();
        
                //citadoctor();
                    }
                });

    }




}



function modificardesc(){
    var despla=document.getElementById("despla").value;
  
    if(despla=="" ){

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

    if(despla!=""  ){
        var ipdesc = $('#ipdesc').val(),
        despla = $('#despla').val();

            $.ajax({
                url: 'moddecplato.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { ipdesc:ipdesc,despla:despla},
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
                title: 'MODIFICADO'
                })
                tablacompo(); 
                tablac();
        
                //citadoctor();
                    }
                });

    }
}



function desactivar(){
    var desacti = $('#desacti').val();

        $.ajax({
            url: 'desactivarplato.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
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
            title: 'DESACTIVADO'
            })
            tablacompo(); 
            tablac();
    
            //citadoctor();
                }
            });
}



