$(document).ready(function(){
    detalleZona();
    });


    function mayus(e){
        e.value = e.value.toUpperCase();
    }

    setInterval(function(){
      contmesas();
    },900
    );

    
    function detalleZona(){  

        var idu = $('#idu').val();
           // alert(ultimafecha);
           $.ajax({
                url : 'detalleZona.php',
                type : 'POST',
                dataType : 'html',
                data : {'idu':idu},
            })
            .done(function(r){
                $("#detalleZona").html(r);
            })
            
        } 

        function contmesas(){  
             $.ajax({
                  url : 'conmesa.php',
                  type : 'POST',
                  dataType : 'html',
                  data : {},
              })
              .done(function(r){
                  $("#contmesas").html(r);
              })
              
          } 



function agregarZona(){
                var clave = $('#clave').val(),
                idu = $('#idu').val(),
                zona = $('#zona').val();

                console.log(clave);
                console.log(idu);
                console.log(zona);
            
                $.ajax({
                  url:'izona.php',
                  type: 'POST',
                  data:{clave:clave, idu:idu,zona:zona},
                  beforeSend:function(){},
                  
                   success: function(respuesta){
                     //alert(respuesta); 
                     $('#clave').val('');
              
                       if(respuesta==1){
                             Swal.fire(
                      'ZONA GREGARA AL USUARIO',
                  
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
                       detalleZona();
                       //seccionpago();
                       //tablaestado();
                  
                          }  
                          
                    
                  });
    
}



function eliminarZona(){
    var idzonass = $('#idzonass').val(),
    clavezonae = $('#clavezonae').val(),
    idue = $('#idue').val();

    console.log(idzonass);
    console.log(clavezonae);
    console.log(idue);

$.ajax({
    url:'eliminarzona.php',
    type: 'POST',
    data:{idzonass:idzonass, clavezonae:clavezonae,idue:idue},
    beforeSend:function(){},
    
     success: function(respuesta){
       //alert(respuesta); 
       $('#clavezonae').val('');

         if(respuesta==1){
               Swal.fire(
        'ZONA ELIMINADA',
    
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
         detalleZona();
         //seccionpago();
         //tablaestado();
    
            }  
            
      
    });
}







function nuevaZona(){
    var nzona = $('#nzona').val(),
    clavezonan = $('#clavezonan').val();

    $.ajax({
        url:'nuevazona.php',
        type: 'POST',
        data:{nzona:nzona, clavezonan:clavezonan},
        beforeSend:function(){},
        
         success: function(respuesta){
           //alert(respuesta); 
           $('#clavezonae').val('');
    
             if(respuesta==1){
                   Swal.fire(
            'ZONA CREADA',
        
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
             detalleZona();
             //seccionpago();
             //tablaestado();
        
                }  
                
          
        });
}





