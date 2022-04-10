$(document).ready(function() {

    $("#clave").keypress(function(e) {
        if(e.which == 13) {
            ingresar();
        }
    });

})



function ingresar(){
        
    var clave = $("#clave").val();

    $.ajax({
        type:"POST",
        url: "session.php",
        data: {clave:clave},
        
        beforeSend:function(){
           
        $("#alertlogin2").hide("fast");
        $("#carga2").show("fast");
        
        },
        success:function(resp){
           // alert(resp);
            if(resp==1){
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
            title: 'Bienvenido'
            })
            location.href='system/index';
                        }
                        
                        if(resp==0){
                            
                            $("#carga2").hide("fast");
                            $("#alertlogin2").show("fast");
                        
                        
                        }
                    }
                    
                })
}