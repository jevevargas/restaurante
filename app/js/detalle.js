


$(document).ready(function () {
  URL = "administraciones/validarplato.php";  

  
  $("#cantidad").keydown(function() {
    return false
  });
  
  $("#cantidad").bind('keyup mouseup', function () {
      
    idp = $("#idp").val();
    cant = $("#cantidad").val();
    //alert(cant);
     URL2 = "administraciones/validarplato.php";
     //alert(idp);
    $.ajax({
     type: "POST",
     data: { 
        "idp" : idp,
        "cant": cant
     },
    
     url: URL2,
     
     success: function(datosObt) {
        var arregloDatos = JSON.parse(datosObt);
         var conteo = 0, mensaje = "";
        if(arregloDatos.length > 0 ){
            for (var i = 0; arregloDatos.length > i; i++) {
              if(arregloDatos[i].id === "vacio"){
                  conteo = -1;
                 mensaje = arregloDatos[i].Descripcion;
              }else if(arregloDatos[i].id === "NO"){
                 conteo += 1;
              }
           }
            if(conteo < 0){
                //alert(mensaje);
                //$('#exampleModal').modal('hide');
                $('#AgregarOrden').prop( "disabled", true );
                $("#alertFalta").show(600).html(mensaje);

                  setTimeout(function(){

                     $("#alertFalta").hide(600).html("");

                  }, 3000);
            }else if(conteo > 0){
                //alert("No hay existencias de algún componente para crear el plato");
               // $('#exampleModal').modal('hide');
                 $('#AgregarOrden').prop( "disabled", true );
                $("#alertFalta").show(600).html("No hay existencias de algún componente para crear el plato!!!");

                  setTimeout(function(){

                     $("#alertFalta").hide(600).html("");

                  }, 3000);
            }else{
                //$('#exampleModal').modal('show');
                $('#AgregarOrden').prop( "disabled", false );
                $("#alertFalta").hide();
            }
        
        }else{
           /*$("#"+ALERTA).show(600).html("No se encontro informaci\u00F3n para descargar el archivo!!!");

              setTimeout(function(){

                 $("#"+ALERTA).hide(600).html("");

              }, 3000);
              */
        }

     },
     error: function(e) { // Si no ha podido conectar con el servidor
           // Código en caso de fracaso en el envío
           console.log(e);
        }
     });
});


});


  

function mayus(e) {
  e.value = e.value.toUpperCase();
}





function ordene(){
    var orden = $('#orden').val(),
    nomplaton = $('#nomplaton').val(),
    precioplaton = $('#precioplaton').val(),
    cantidad= $('#cantidad').val(),
    sub= $('#sub').val(),
    hora= $('#hora').val(),
    dia= $('#dia').val(),
    diac= $('#diac').val(),
    idp= $('#idp').val(),
    impplato= $('#impplato').val(),
    desc= $('#desc').val();
    
console.log(nomplaton);

    $.ajax({
        url:'insertarorden.php',
        type: 'POST',
        data:{'orden':orden, 'nomplaton':nomplaton,'precioplaton':precioplaton,'cantidad':cantidad, 'sub':sub,'hora':hora, 'dia':dia, 'idp':idp, 'desc':desc,'diac':diac,'impplato':impplato},
        beforeSend:function(){},
           
        success: function(){
            despachar(5);
          $('#desc').val('');
          $('#cantidad').val('1');
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
        title: 'Orden agregada'
        })
        
        DetalleVenta();
        carretilla();
        menuplato();
        }
        
        });
}









function despachar(concepto){
    var idp, cant;
    if(concepto == 5){
        idp = $('#idp').val();
        cant = $('#cantidad').val();
        //alert(cant);
       // console.log('descontar de idPlato '+idp + ' cant: ' +cant);
  
    }else if(concepto == 2){
        idp = $('#idPlatoeliminar').val();
        cant = $('#cantidadeseliminar').val();
        console.log('Sumar de idPlato '+idp + ' cant: ' +cant);
    }
   
    var minve = false;
    //console.log(idp + ' cant: ' +cant);
    var id_bod, cant_bod, id_plato, cant_pl, refer;
  
  
      $.ajax({
        url: 'cocina/detallePlato.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
        method: 'POST',
        data: {idp:idp, cant : cant },
        beforeSend: function(){},
        success: function(data){
          var arregloDatos = JSON.parse(data);
          //alert(arregloDatos);
          
  
          if(arregloDatos.length > 1 ){
            for (var i = 0; arregloDatos.length > i; i++) {
              id_plato = arregloDatos[i].id_plato;
                cant_pl = arregloDatos[i].plato;
                id_bod = arregloDatos[i].id_bodega;
                cant_bod = arregloDatos[i].requerido;
                refer= arregloDatos[i].referencia;
              
              $.ajax({
                  url: 'administraciones/minve.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                  method: 'POST',
                  data: { 
                    referencia: refer,
                    cantidad:cant_bod, 
                    id_producto:id_bod, 
                    concepto:concepto },
                  beforeSend: function(){},
                  success: function(){
                    minve = true;
                          }
                });
            }
             /*  $.ajax({
                  url: 'administraciones/minve.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                  method: 'POST',
                  data: { 
                    referencia: refer,
                    cantidad:cant_pl, 
                    id_producto:id_plato, 
                    concepto:4 },
                  beforeSend: function(){},
                  success: function(){
                    minve = true;
                          }
                });
                */
          }else{
              id_plato = arregloDatos[0].id_plato;
              cant_pl = arregloDatos[0].plato;
              id_bod = arregloDatos[0].id_bodega;
              cant_bod = arregloDatos[0].requerido;
              refer= arregloDatos[0].referencia;
              
              $.ajax({
                  url: 'administraciones/minve.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                  method: 'POST',
                  data: { 
                    referencia: refer,
                    cantidad:cant_bod, 
                    id_producto:id_bod, 
                    concepto:concepto },
                  beforeSend: function(){},
                  success: function(){
                    minve = true;
                          }
                });
          }
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
          title: 'Orden despachada'
        })
        DetalleVenta();
        }
      });
  
  
  } 

    //editar sin contrase;a

  function eliminarorden(){
    var ideliminare = $('#ideliminare').val();
  
    console.log(ideliminare);
  
    $.ajax({
    url:'eliminarventa.php',
    type: 'POST',
    data:{'ideliminare':ideliminare},
    beforeSend:function(){},
    
    success: function(){
    
    
      despachar(2);
     
    }
    
    });
    }


    // eliimnar permiso

    $(document).on('click', '.elieliminar', function(){
      var id=$(this).val();
      var ideli=$('#ideli'+id).text();
        var idpla=$('#idpla'+id).text();
        var pre=$('#pre'+id).text();
       var idPlato=$('#idPlato'+id).text();
      var cantidades=$('#cantidades'+id).text();
      
     // console.log(ideli);
       // console.log(idpla);
       // console.log(pre);
      
      $('#elieli').modal('show');
      $('#ideli').val(ideli);
      $('#idpla').val(idpla);
      $('#pre').val(pre);
      $('#elieli').modal('show');
      $('#idPlatoeliminar').val(idPlato);
       $('#cantidadeseliminar').val(cantidades);
      
      
      });


        
/*------------------------------------ eliominar con permisos --------------------------*/
function eliminapermiso(){
  var passclave = $('#passclave').val(),
   comenti = $('#comenti').val(),
   pre = $('#pre').val(),
   idpla = $('#idPlatoeliminar').val(),
   ideli = $('#ideli').val();
     
     
     $.ajax({
url:'eliminarventapermiso.php',
type: 'POST',
data:{'passclave':passclave, 'comenti':comenti, 'ideli':ideli, pre:pre, idpla:idpla},
beforeSend:function(){},
success: function(respuesta){
 
 $('#passclave').val('');
 $('#comenti').val('');
  //alert(respuesta);
 if(respuesta==1){
       
    // alert(despachar);
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
title: 'Orden eliminada'
})  
despachar(2);
DetalleVenta();

 }else{
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
icon: 'questions',
title: 'Necesitas clave para eliminar la orden'
})  
 }

 }
          
});  


 }



 //editar

 
 $(document).on('click', '.editar', function(){
  var id=$(this).val();
  var comentario=$('#comentario'+id).text();
  var idnota=$('#idnota'+id).text();

 console.log(comentario);
console.log(idnota);

  $('#editar').modal('show');
  $('#comentario').val(comentario);
  $('#idnota').val(idnota);
  });


  function modificar(){
    var comentario = $('#comentario').val(),
        idnota = $('#idnota').val();

        $.ajax({
          url: 'modcomentario.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
          method: 'POST',
          data: { comentario:comentario,idnota:idnota},
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
          DetalleVenta();
              }
          });
  }


  function ingresarsub(){
    var nombresub=document.getElementById("nombresub").value;

    if( nombresub==""){
      $("#nombresub").addClass("is-invalid");
  }
    if(nombresub!="" ){
      var ordensub = $('#ordensub').val(),
      nombresub = $('#nombresub').val();

      $.ajax({
          url: 'isub.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
          method: 'POST',
          data: { ordensub:ordensub,nombresub:nombresub},
          beforeSend: function(){},
          success: function(){
              $('#nombresub').val('');
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
          title: 'USUARIO AGREGADO'
          })
          contenidoPlato();
              }
          });
    }

  }


  function cambiarcuenta(){
    var ordencambio = $('#ordencambio').val(),
    idmesacambio = $('#idmesacambio').val(),
    nomcli = $('#nomcli').val(),
    mesac = $('#mesac').val();


    console.log(ordencambio);
    console.log(idmesacambio);
    console.log(nomcli);
    console.log(mesac);

    $.ajax({
      url: 'cambiarcuenta.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
      method: 'POST',
      data: { ordencambio:ordencambio,idmesacambio:idmesacambio,mesac:mesac,nomcli:nomcli},
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
      title: 'MESA CAMBIADA'
      })
     
      location.href="index.php";
          }
      });

  }  


//   function cearpago(){
//     var totalpagar = $('#totalpagar').val();

//       Swal.fire({
//     title: 'TOTAL $ ' + totalpagar,
//     text: "EL MONTO ES CORRECTO?" ,
//     icon: 'question',
//     showCancelButton: true,
//     confirmButtonColor: '#698C00',
//     cancelButtonColor: '#D90000',
//     confirmButtonText: 'CREAR '
//     }).then((result) => {
//     if (result.value) {
//       cearpago2();
//     }
//     })   
//     }
  
// function cearpago2(){
//   var totalpagar = $('#totalpagar').val(),
//   totalorden = $('#totalorden').val();

//   console.log(totalpagar);
//   console.log(totalorden);

//   $.ajax({
//     url: 'crearcuenta.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
//     method: 'POST',
//     data: { totalpagar:totalpagar,
//       totalorden:totalorden
//     },
//     beforeSend: function(){},
//     success: function(){
       
//       Swal.fire({
//         position: 'top-end',
//         icon: 'success',
//         title: 'CREADA',
//         showConfirmButton: false,
//         timer: 1500
//       })

 
//     location.href="index.php";
//         }
//     });


// }


function cocina(){
  totalorden = $('#totalorden').val();
  $.ajax({
        url: 'acocina.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
        method: 'POST',
        data: {
          totalorden:totalorden
         },
         beforeSend: function(){},
         success: function(){
           
           Swal.fire({
             position: 'top-end',
           icon: 'success',
             title: 'CREADA',
             showConfirmButton: false,
             timer: 1500
           })
         location.href="index.php";
             }
         });
}
