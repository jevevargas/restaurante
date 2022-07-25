
$(document).ready(function(){
    todomenu(); 
    permisos();
    contenidoUltimo();
    detallemepresa();
    });

    function mayus(e){
        e.value = e.value.toUpperCase();
    }

    function todomenu(){  
           $.ajax({
                url : 'todomenu.php',
                type : 'POST',
                dataType : 'html',
                data : {},
            })
            .done(function(r){
                $("#todomenu").html(r);
            })
            
        } 

        function permisos(){  
            var idboton = $('#idboton').val();
            $.ajax({
                 url : 'eliminarboton.php',
                 type : 'POST',
                 dataType : 'html',
                 data : {idboton:idboton},
             })
             .done(function(r){
                 $("#permiso").html(r);
             })
             
         } 

         function contenidoUltimo(){  
            $.ajax({
                 url : 'ultimoplato.php',
                 type : 'POST',
                 dataType : 'html',
                 data : {},
             })
             .done(function(r){
                 $("#contenidoUltimo").html(r);
             })
             
         } 

         function detallemepresa(){  
           // var idboton = $('#idboton').val();
            $.ajax({
                 url : 'detallemepresa.php',
                 type : 'POST',
                 dataType : 'html',
                 data : {},
             })
             .done(function(r){
                 $("#detallemepresa").html(r);
             })
             
         }
         

function ingresarmenu(){
    var nommenu=document.getElementById("nommenu").value;
    var iconomenu=document.getElementById("iconomenu").value;
    var clase=document.getElementById("clase").value;
    var link=document.getElementById("link").value;

    if(nommenu=="" ||  iconomenu=="" ||  clase=="" ||  link==""  ){

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

                if(nommenu!="" && iconomenu!="" && clase!="" && link!="" ){
                    var nommenu = $('#nommenu').val(),
                    iconomenu = $('#iconomenu').val(),
                    clase = $('#clase').val(),
                    link = $('#link').val();

                    $.ajax({
                        url: 'imenu.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                        method: 'POST',
                        data: { nommenu:nommenu, iconomenu:iconomenu,clase:clase,link:link},
                        beforeSend: function(){},
                        success: function(){
                            $('#nommenu').val('');
                            $('#iconomenu').val('');
                            $('#clase').val('');
                            $('#link').val('');
    
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
                        title: 'BOTON AGREGADO'
                        })
                        todomenu();
 
                        //citadoctor();
                            }
                        });
                }
}







$(document).on('click', '.eliminar', function(){
    var id=$(this).val();
    var idm=$('#idm'+id).text(),
    idu=$('#idu'+id).text();
 
    
    console.log(idm);
    console.log(idu);
   
    $.ajax({
    url:'eliminarpermiso.php',
    type: 'POST',
    data:{'idm':idm,'idu':idu},
    
     }); 
     permisos(); 
   
     
    });


    function ingresarplato(){
        var nomplato=document.getElementById("nomplato").value;
    var pecioplato=document.getElementById("pecioplato").value;
    var descplato=document.getElementById("descplato").value;

    if(nomplato=="" ||  pecioplato=="" ||  descplato==""){

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

    if(nomplato!="" && pecioplato!="" && descplato!="" ){
        var nomplato = $('#nomplato').val(),
        pecioplato = $('#pecioplato').val(),
        impplato = $('#impplato').val(),
        descplato = $('#descplato').val(),
        catplato = $('#catplato').val();

        $.ajax({
            url: 'iplatoadmin.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { nomplato:nomplato, pecioplato:pecioplato,impplato:impplato,descplato:descplato,catplato:catplato},
            beforeSend: function(){},
            success: function(){
                $('#nomplato').val('');
                $('#pecioplato').val('');
                $('#descplato').val('');

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
            title: 'PLATO AGREGADO'
            })
            contenidoUltimo();

            //citadoctor();
                }
            });
    }


    }



    $(buscar_datos());

function buscar_datos(consulta){
    
    var orden = $('#orden').val();
    
    $.ajax({
        url: 'buscarplatoadmin.php' ,
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



$(document).ready(function(){
    $("#buscar").on("click", function(){
      var inicial = $("#inicial").val(),
          final = $("#final").val();
        $.ajax({
            type: "POST",
            url: "tablaeliminado.php",
            data:{inicial:inicial,final:final},
            success: function(respuesta){
                $("#resultado").html(respuesta);
            }
        })
    })
});

$(document).ready(function(){
    $("#buscarc").on("click", function(){
      var inicialc = $("#inicialc").val(),
          finalc = $("#finalc").val();
        $.ajax({
            type: "POST",
            url: "tablacomida.php",
            data:{inicialc:inicialc,finalc:finalc},
            success: function(respuesta){
                $("#resultadoc").html(respuesta);
            }
        })
    })
});



function actempre(){
    var nome = $('#nome').val(),
    dire = $('#dire').val(),
    tele = $('#tele').val(),
    whate = $('#whate').val(),
    giroe = $('#giroe').val(),
    nite = $('#nite').val(),
    ncre = $('#ncre').val(),
    rese = $('#rese').val(),
    aue = $('#aue').val(),
    sere = $('#sere').val();
    $.ajax({
        url: 'aempresa.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
        method: 'POST',
        data: { nome:nome, dire:dire,tele:tele,whate:whate,giroe:giroe,nite:nite,ncre:ncre,rese:rese,aue:aue,sere:sere},
        beforeSend: function(){},
        success: function(){
            $("#nome").addClass("is-valid");
            $("#dire").addClass("is-valid");
            $("#tele").addClass("is-valid");
            $("#whate").addClass("is-valid");
            $("#ncre").addClass("is-valid");
            $("#rese").addClass("is-valid");
            $("#aue").addClass("is-valid");
            $("#sere").addClass("is-valid");


        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
    
        Toast.fire({
        icon: 'success',
        title: 'Actualizado'
        })
        

        detalleempresa();
            }
        });

}