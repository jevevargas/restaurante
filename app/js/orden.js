
$(document).ready(function(){
    ordenes();
    });

    function ordenes(){  
    
        $.ajax({
             url : 'detaleordenes.php',
             type : 'POST',
             dataType : 'html',
             data : {},
         })
         .done(function(r){
             $("#ordenes").html(r);
         })
         
     } 
    

     function cambiapago(){
        var tipopago=document.getElementById("tipopago").value;
        var clave=document.getElementById("clave").value;

        if( tipopago=="0"){
            $("#tipopago").addClass("is-invalid");
        }
        if( clave==""){
            $("#clave").addClass("is-invalid");
        }

        if( tipopago>=1 && clave!=""  ){

        var orden = $('#orden').val(),
        tipopago = $('#tipopago').val(),
        clave = $('#clave').val();

        console.log(orden);

    $.ajax({
        url:'cambiartipopago.php',
        type: 'POST',
        data:{orden:orden,clave:clave,tipopago:tipopago},
        beforeSend:function(){},
        
         success: function(respuesta){
           //alert(respuesta); 
           $('#clave').val('');
    
             if(respuesta==1){
                   Swal.fire(
            'CAMBIO DE PAGO',
        
            '',
            'success'
        
          )  
             }else{
                     Swal.fire(
            'NO ESTAS AUTORIZADO',
        
            '',
            'error'
        
          )
             }
             ordenes();
             //seccionpago();
             //tablaestado();
        
                }  
                
          
        });
     }

    }