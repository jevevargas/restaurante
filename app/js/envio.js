
$(document).ready(function(){
    tablauserpedido(); 
    carretilla();
    menuplato();
    });


    setInterval(function(){
      carretilla();
    
    },1000
    );
    

function tablauserpedido(){  
    $.ajax({
         url : 'tablauserpedido.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablauserpedido").html(r);
     })
     
 } 

 function carretilla(){  
  var idcliente = $("#idcliente").val();
  $.ajax({
       url : 'carretilla.php',
       type : 'POST',
       dataType : 'html',
       data : {idcliente:idcliente},
   })
   .done(function(r){
       $("#carretilla").html(r);
   })
   
} 

function menuplato(){ 
  var idcliente = $("#idcliente").val();
   
  $.ajax({
       url : 'menuplato.php',
       type : 'POST',
       dataType : 'html',
       data : {idcliente:idcliente},
   })
   .done(function(r){
       $("#menuplato").html(r);
   })
   
} 



  function mayus(e){
    e.value = e.value.toUpperCase();
}


function usuarioenvio(){
  
    var nombrecliente = document.getElementById("nombrecliente").value;
  var direccioncli = document.getElementById("direccioncli").value;
  var telefonocli=document.getElementById("telefonocli").value;

  if (nombrecliente == "") {
    $("#nombrecliente").addClass("is-invalid");
  }

 

  if (direccioncli == "") {
    $("#direccioncli").addClass("is-invalid");
  }
  if (telefonocli == "") {
    $("#telefonocli").addClass("is-invalid");
  }

  if (nombrecliente != ""  && direccioncli != "" && telefonocli != "") {
    var nombrecliente = $("#nombrecliente").val(),
    tipo = $("#tipo").val(),
    direccioncli = $("#direccioncli").val(),
    telefonocli = $("#telefonocli").val(),
    duicli = $("#duicli").val();

    console.log(tipo);

    $.ajax({
        url: 'iclientepedido.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
        method: 'POST',
        data: { 
            nombrecliente:nombrecliente,
            tipo:tipo,
            direccioncli:direccioncli,
            telefonocli:telefonocli,
            duicli:duicli
        },
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
        title: 'USUARIO AGREGADO'
        })
        tablauserpedido();
            }
        });

  }


}



function asignarorden(){
  var idcliente = $('#idcliente').val();

  console.log(idcliente);

  $.ajax({
    url: 'iordendomicilio.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
    method: 'POST',
    data: { idcliente:idcliente},
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
    title: 'ORDEN CREADA'
    })
    tablauserpedido(); 
    carretilla();
    menuplato();
        }
    });
}





function mayus(e) {
  e.value = e.value.toUpperCase();
}

$("#cantidad").keydown(function() {
    return false
  });

$("#cantidad").bind('keyup mouseup', function () {
      
    idp = $("#idp").val();
    cant = $("#cantidad").val();
    //alert(cant);
     URL2 = "administraciones/validarplato.php";
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
         
 
        tablauserpedido(); 
        carretilla();
       // menuplato();
   
       
        }
        
        });
}









function despachar(concepto){
    var idp, cant;
    if(concepto == 5){
        idp = $('#idp').val();
        cant = $('#cantidad').val();
        //alert(cant);
        console.log('descontar de idPlato '+idp + ' cant: ' +cant);
  
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
        tablauserpedido(); 
    carretilla();
   // menuplato();
        }
      });
  
  
  } 

    //editar sin contrase;a
$(document).on('click', '.eliminarventa', function(){
  var id=$(this).val();
  var ideliminare=$('#ideliminar'+id).text();
    var cantidades=$('#cantidades'+id).text();
    var idPlato=$('#idPlato'+id).text();

  console.log(ideliminare);

  $('#eliminarventa').modal('show');
  $('#ideliminare').val(ideliminare);
  $('#cantidadeseliminar').val(cantidades);
  $('#idPlatoeliminar').val(idPlato);
  });

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
tablauserpedido(); 
    carretilla();
   // menuplato();

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
          tablauserpedido(); 
    carretilla();
    //menuplato();
              }
          });
  }


  $(buscar_datos());

  function buscar_datos(consulta){
      
      var orden = $('#orden').val();
      
      $.ajax({
          url: 'buscarplato.php' ,
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
  