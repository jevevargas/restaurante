
$(document).ready(function(){
    pedidoscaja();
    botonultimopago(); 
    pedidocliente();
    datoscaja();
    tablaegreso();
    tablacaja();
    tablamixta();
    });

    setInterval(function(){
        pedidoscaja();
      },1000
      );

      setInterval(function(){
        pedidocliente();
      },1000
      );

      setInterval(function(){
        tablamixta();
      },3000
      );



function pedidoscaja(){  
    
    $.ajax({
         url : 'pedidoscaja.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#pedidoscaja").html(r);
     })
     
 } 

 
 function pedidocliente(){  
    
    $.ajax({
         url : 'pedidocliente.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#pedidocliente").html(r);
     })
     
 } 
 

 function botonultimopago(){  
    var ordenmixto = $('#ordenmixto').val();
    $.ajax({
         url : 'botonultimopago.php',
         type : 'POST',
         dataType : 'html',
         data : {ordenmixto:ordenmixto},
     })
     .done(function(r){
         $("#botonultimopago").html(r);
     })
     
 } 

 function tablaegreso(){  
    $.ajax({
         url : 'tablaegreso.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablaegreso").html(r);
     })
     
 } 

 

 function datoscaja(){  
    
    $.ajax({
         url : 'datoscaja.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#datoscaja").html(r);
     })
     
 } 


 function tablacaja(){  
    
    $.ajax({
         url : 'tablacaja.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablacaja").html(r);
     })
     
 } 


 function tablamixta(){  
    var ordenm = $('#ordenm').val();
    $.ajax({
         url : 'tablamixta.php',
         type : 'POST',
         dataType : 'html',
         data : {ordenm:ordenm},
     })
     .done(function(r){
         $("#tablamixta").html(r);
     })
     
 } 

 $(document).ready(function(){
 //funcion para el vuelto
 $('#tarjeta').on('keyup change', function() {
    var rec = $('#tarjeta').val();
    var com = $('#total').val();
    
    if (rec > 0) {
        var totalprp = com*0.10 ;
        var sum = (com - rec );
        var fin =sum + totalprp;
        var cal = parseFloat(parseFloat(fin).toFixed(3));
        $('#efectivo').val(cal);
    } else {
        $('#efectivo').val(0);
    }
});
    }); 


     function tarjeta(){
        var tarjeta=document.getElementById("tarjeta").value;
        var efectivo=document.getElementById("efectivo").value;

        if( tarjeta==""){
            $("#tarjeta").addClass("is-invalid");
        }
        
        if( efectivo==""){
            $("#efectivo").addClass("is-invalid");
        }

        if( tarjeta!="" && efectivo!="" ){
            var tarjeta = $('#tarjeta').val(),
                efectivo = $('#efectivo').val(),
                ordenmixto = $('#ordenmixto').val(); 

            $.ajax({
                url: 'itargeta.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { tarjeta:tarjeta,ordenmixto:ordenmixto},
                beforeSend: function(){},
                success: function()
                {
                
            
                }
            });
            $.ajax({
                url: 'iefectivo.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { efectivo:efectivo,ordenmixto:ordenmixto},
                beforeSend: function(){},
                success: function()
                
                {
                    botonultimopago();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'PAGOS REGISTRADOS',
                        showConfirmButton: false,
                        timer: 1500
                      })

                     
            
                }

            });
        }

     }



     function terminarenvio(){
        var tipopago=document.getElementById("tipopago").value;

        console.log(tipopago);

        if( tipopago=="0"){
            $("#tipopago").addClass("is-invalid");
        }

        if( tipopago>=1 ){
         var ordenmixto = $('#ordenmixto').val(),
             tipopago = $('#tipopago').val(),
             totalpago = $('#totalpago').val(),
             cliente = $('#cliente').val(),
             idmesa = $('#idmesa').val();
             
         $.ajax({
            url: 'terminar.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { ordenmixto:ordenmixto,idmesa:idmesa,tipopago:tipopago,totalpago:totalpago,cliente:cliente},
            beforeSend: function(){},
            success: function()
            
            {
               
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'PROCESO TERMINADO',
                    showConfirmButton: false,
                    timer: 1500
                  })

                  location.href ="index.php"; 
        
            }

        });
       }
     }

     function terminarmesa(){
    
         var ordenmixto = $('#ordenmixto').val(),
             tipopago = $('#tipopago').val(),
             idcli = $('#idcli').val(),
             idmesa = $('#idmesa').val();
             
         $.ajax({
            url: 'terminarenvio.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { ordenmixto:ordenmixto,idmesa:idmesa,tipopago:tipopago,idcli:idcli},
            beforeSend: function(){},
            success: function()
            
            {
               
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'PROCESO TERMINADO',
                    showConfirmButton: false,
                    timer: 1500
                  })

                  location.href ="index.php"; 
        
            }

        });
       
     }


     function comenzarcaja(){
        var idusu = $('#idusu').val(),
            inicio = $('#inicio').val(),
            final = $('#final').val(),
            fondo = $('#fondo').val();
            
    $.ajax({
       url: 'inicio.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
       method: 'POST',
       data: { idusu:idusu,
               fondo:fondo,
               inicio:inicio,
               final:final
             },
       beforeSend: function(){},
       success: function()
       
       {
          
           Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'PROCESO TERMINADO',
               showConfirmButton: false,
               timer: 1500
             })

             datoscaja();
   
       }

   });
     }

     function egreso(){
        var factura=document.getElementById("factura").value;
        var costo=document.getElementById("costo").value;
        var desc=document.getElementById("desc").value;

        if( factura==""){
            $("#factura").addClass("is-invalid");
        }
        if( costo==""){
            $("#costo").addClass("is-invalid");
        }
        if( desc==""){
            $("#desc").addClass("is-invalid");
        }

        if(factura!="",costo!="",desc!=""){
            var factura = $('#factura').val(),
                costo = $('#costo').val(),
                desc = $('#desc').val(),
                tipofact = $('#tipofact').val();

                $.ajax({
                    url: 'isalida.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                    method: 'POST',
                    data: { factura:factura,
                            costo:costo,
                            desc:desc,
                            tipofact:tipofact
                          },
                    beforeSend: function(){},
                    success: function()
                   
                    {
                        $('#factura').val('');
                        $('#costo').val('');
                        $('#desc').val(''); 

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'SALIDA DE CAJA',
                            showConfirmButton: false,
                            timer: 1500
                          })
             
                          tablaegreso();   
                
                    }
             
                });

        }

     }


     $(document).on('click', '.eliminar', function(){
        var id=$(this).val();
        var ide=$('#ide'+id).text();
        
        console.log(ide);
        Swal.fire({
        title: 'ELIMINAR SALIDA',
         text: "ESTA SEGURO DE ELIMINAR EL EGRESO: #" + ide,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#468C00',
         cancelButtonColor: '#D90000',
         confirmButtonText: 'ELIMINAR'
       }).then((result) => {
         if (result.value) {
            eliminaregre();
         }
       
       })
    
    function eliminaregre(){
    $.ajax({
    url:'eliminarsalida.php',
    type: 'POST',
    data:{'ide':ide},
    
     }); 
     tablaegreso(); 
    }
    
    });


    function arqueo(){
        var idu = $('#idu').val(),
        ven = $('#ven').val(),
        efe = $('#efe').val(),
        tar = $('#tar').val(),
        cre = $('#cre').val(),
        cor = $('#cor').val(),
        dep = $('#dep').val(),
        arqueo = $('#arqueo').val(),

        creefe = $('#creefe').val(),
        credes = $('#credes').val(),
        cretar = $('#cretar').val(),
        crebit = $('#crebit').val(),
        cretran = $('#cretran').val(),
        inicio = $('#inicio').val(),

        fechainicio = $('#fechainicio').val(),
        finaly = $('#finaly').val(),

        egre = $('#egre').val();
        
        console.log(idu);
        
        $.ajax({
            url: 'icuadre.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { idu:idu,
                ven:ven,
                efe:efe,
                tar:tar,
                cre:cre,
                cor:cor,
                dep:dep,
                egre:egre,
                arqueo:arqueo,
                creefe:creefe,
                credes:credes,
                cretar:cretar,
                crebit:crebit,
                cretran:cretran,
                inicio:inicio,
                fechainicio:fechainicio,
                finaly:finaly

                  },
            beforeSend: function(){},
            success: function()
           
            {
                $('#arqueo').val('');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'EXITO',
                    showConfirmButton: false,
                    timer: 1500
                  })
     
               
                 // location.href="cuadre.php";
            }
     
        });

    }



    function arqueop(){
        var idu = $('#idu').val(),
        ven = $('#ven').val(),
        efe = $('#efe').val(),
        tar = $('#tar').val(),
        cre = $('#cre').val(),
        cor = $('#cor').val(),
        dep = $('#dep').val(),
        arqueo = $('#arqueo').val(),
        creefe = $('#creefe').val(),
        credes = $('#credes').val(),
        cretar = $('#cretar').val(),
        crebit = $('#crebit').val(),
        cretran = $('#cretran').val(),
        inicio = $('#inicio').val(),
        egre = $('#egre').val();

        console.log(egre);
        
        $.ajax({
            url: 'icuadrep.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { idu:idu,
                ven:ven,
                efe:efe,
                tar:tar,
                cre:cre,
                cor:cor,
                dep:dep,
                egre:egre,
                arqueo:arqueo,
                creefe:creefe,
                credes:credes,
                cretar:cretar,
                crebit:crebit,
                cretran:cretran,
                inicio:inicio
                  },
            beforeSend: function(){},
            success: function()
           
            {
                $('#arqueo').val('');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'EXITO',
                    showConfirmButton: false,
                    timer: 1500
                  })
     
               
                  //location.href="cuadre.php";
            }
     
        })
    }


    $(document).on('click', '.addadmin', function(){
        var id=$(this).val();
        var usu=$('#usu'+id).text();
        
        console.log(usu);
        Swal.fire({
        title: 'AGREGAR PERMISO DE ADMIN',
         text: "CODIGO DE USUARIO: #" + usu,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#468C00',
         cancelButtonColor: '#D90000',
         confirmButtonText: 'AGREGAR ADMIN'
       }).then((result) => {
         if (result.value) {
            addadmin();
         }
       
       })
    
    function addadmin(){
    $.ajax({
    url:'addadmin.php',
    type: 'POST',
    data:{'usu':usu},
    
     }); 
     location.href="cajatotal.php";
    }
    
    });



    $(document).on('click', '.cerrar', function(){
        var id=$(this).val();
        var idc=$('#idc'+id).text();
        var idcu=$('#idcu'+id).text();
        
        console.log(idc);
        Swal.fire({
        title: 'CERRAR CAJA',
         text: "ESTA SEGURO QUE DESEA CERRAR LA CAJA COD#"+idcu ,
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#468C00',
         cancelButtonColor: '#D90000',
         confirmButtonText: 'CERRAR'
       }).then((result) => {
         if (result.value) {
            cerrarc();
         }
       
       })
    
    function cerrarc(){
    $.ajax({
    url:'cerrarcaja.php',
    type: 'POST',
    data:{'idc':idc,'idcu':idcu},
    beforeSend: function(){},
    success: function()
   
    {
        $('#arqueo').val('');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'EXITO',
            showConfirmButton: false,
            timer: 1500
          })

       
          location.href="cuadre.php";
    }
     }); 
     //tablauser(); 
    }
    
    });


    function crearcaja(){
        var nomcaja=document.getElementById("nomcaja").value;
        

        if( nomcaja==""){
            $("#nomcaja").addClass("is-invalid");
        }
        
        

        if( nomcaja!="" ){
            var nomcaja = $('#nomcaja').val(),
            usu = $('#usu').val(); 

            $.ajax({
                url: 'icaja.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { nomcaja:nomcaja,usu:usu},
                beforeSend: function(){},
                success: function()
                
                {
                    tablacaja();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'CAJA CREADA',
                        showConfirmButton: false,
                        timer: 1500
                      })
                     
                     
            
                }

            });
        }
    }


    function cerrarsistema(){
        Swal.fire({
            title: 'CERRAR SISTEMA',
             text: "ESTA SEGURO QUE DESEA CERRAR EL SISTEMA, NO SE PODRA REVERTIR" ,
             icon: 'question',
             showCancelButton: true,
             confirmButtonColor: '#468C00',
             cancelButtonColor: '#D90000',
             confirmButtonText: 'CERRAR'
           }).then((result) => {
             if (result.value) {
                cerrarsistemat();
             }
            })
    }

    function cerrarsistemat(){
      
        
        $.ajax({
            url: 'cerrarsistema.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: {},
            beforeSend: function(){},
            success: function()
           
            {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'EXITO',
                    showConfirmButton: false,
                    timer: 1500
                  })
     
               
                  location.href="index.php";
            }
     
        })
    }



    function pagarmixtosub(){
        var tarjetas=document.getElementById("tarjetas").value;
        var efectivos=document.getElementById("efectivos").value;

        if( tarjetas==""){
            $("#tarjetas").addClass("is-invalid");
        }
        
        if( efectivos==""){
            $("#efectivos").addClass("is-invalid");
        }

        if( tarjetas!="" && efectivos!="" ){
            var tarjeta = $('#tarjetas').val(),
                efectivo = $('#efectivos').val(),
                ordenmixto = $('#ordenmixtos').val(); 

            $.ajax({
                url: 'itargeta.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { tarjeta:tarjeta,ordenmixto:ordenmixto},
                beforeSend: function(){},
                success: function()
                {
                
            
                }
            });
            $.ajax({
                url: 'iefectivo.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { efectivo:efectivo,ordenmixto:ordenmixto},
                beforeSend: function(){},
                success: function()
                
                {
                    botonultimopago();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'PAGOS REGISTRADOS',
                        showConfirmButton: false,
                        timer: 1500
                      })

                     
            
                }

            });
        }

    }


    function modfecha(){
        var finicaja=document.getElementById("finicaja").value;

        if( finicaja==""){
            $("#finicaja").addClass("is-invalid");
        }

        if( finicaja!=""){
            var inicaja = $('#inicaja').val(),
            finicaja = $('#finicaja').val(),
            idusufech = $('#idusufech').val();
        }

        $.ajax({
            url: 'modfecha.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { inicaja:inicaja,finicaja:finicaja,idusufech:idusufech},
            beforeSend: function(){},
            success: function()
            
            {
                botonultimopago();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'MODIFICACION EFECTUADA',
                    showConfirmButton: false,
                    timer: 1500
                  })

                 
        
            }

        });
    }


    function cerrarsub(){
        var idclientesub = $('#idclientesub').val();

        console.log(idclientesub);

        $.ajax({
            url: 'cerrarsub.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { idclientesub:idclientesub},
            beforeSend: function(){},
            success: function()
            
            {
                botonultimopago();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Sub cuenta cerrada',
                    showConfirmButton: false,
                    timer: 1500
                  })

                 
        
            }

        });
    }

    //Es lo mismo que document.ready, pero mas cordo
$(function(){

    //Aquí es donde te digo que le hablo al document, le ligo el evento, le digo que selectores y le paso lo que quiero que haga
    $( document ).on( 'click', '.validare', function(){
    let val = $(this).val();
      //Revisa en que status está el checkbox y controlalo según lo //desees
      if( $( this ).is( ':checked' ) ){
        //alert( 'Guardando información de '+ val +'...' );
        $.ajax({
            url:' impmultiple.php',
            type: 'POST',
            data:{'val':val},
            beforeSend:function(){},
            
             success: function(){
                 
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'AGREGADO A LA FACTURA #' + val,
                    showConfirmButton: false,
                    timer: 1000
                  })
            
            
                    }  
                    
              
            });
      }
      
      else{
        alert( 'Desguardando información de ' + val + '...' );
      }
    });
    
    });