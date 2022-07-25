
$(document).ready(function(){
    tablauser(); 

    });

function tablauser(){  
    $.ajax({
         url : 'tablauser.php',
         type : 'POST',
         dataType : 'html',
         data : {},
     })
     .done(function(r){
         $("#tablauser").html(r);
     })
     
 } 

function insertaruser(){

    var nick=document.getElementById("nick").value;
    var pass=document.getElementById("pass").value;
  
    if( nick==""){
        $("#nick").addClass("is-invalid");
    }
    if( pass==""){
        $("#pass").addClass("is-invalid");
    }
    if( nick!="" && pass!="" ){
        
        var nick = $('#nick').val(),
        pass = $('#pass').val(),
        admin = $('#admin').val(),
        tipo = $('#tipo').val();

        $.ajax({
            url: 'iuser.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
            method: 'POST',
            data: { nick:nick,pass:pass,admin:admin,tipo:tipo},
            beforeSend: function(){},
            success: function(){
                $('#nick').val('');
                $('#pass').val('');

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
            tablauser();
                }
            });
    }


}


$(document).on('click', '.eliminar', function(){
    var id=$(this).val();
    var idu=$('#idu'+id).text();
    
    console.log(idu);
    Swal.fire({
    title: 'ELIMINAR USUARIO',
     text: "ESTA SEGURO DE ELIMINAR EL USUARIO",
     icon: 'question',
     showCancelButton: true,
     confirmButtonColor: '#468C00',
     cancelButtonColor: '#D90000',
     confirmButtonText: 'ELIMINAR'
   }).then((result) => {
     if (result.value) {
        eliminarusu();
     }
   
   })

function eliminarusu(){
$.ajax({
url:'eliminaruser.php',
type: 'POST',
data:{'idu':idu},

 }); 
 tablauser(); 
}

});

    