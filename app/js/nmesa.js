$(document).ready(function(){
    tablamesa(); 
   
    });

    function mayus(e) {
        e.value = e.value.toUpperCase();
      }

    

    function tablamesa(){  
        //var idplato = $('#idplato').val();
        $.ajax({
             url : 'tablamesa.php',
             type : 'POST',
             dataType : 'html',
             data : {},
         })
         .done(function(r){
             $("#tablamesa").html(r);
         })
         
     } 


     function nmesa(){
        var mesa=document.getElementById("mesa").value;
       
      
        if( mesa==""){
            $("#mesa").addClass("is-invalid");
        }
        
        if( mesa!="" ){
        
            var mesa = $('#mesa').val(),
            idzona = $('#idzona').val();
    
            $.ajax({
                url: 'imesa.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                method: 'POST',
                data: { idzona:idzona,mesa:mesa},
                beforeSend: function(){},
                success: function(){
                    $('#mesa').val('');
                   
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'MESA GUARDADA',
                        showConfirmButton: false,
                        timer: 1500
                      })

                tablamesa();
                    }
                });
        }
     }


   
$(document).on('click', '.eliminar', function(){
    var id=$(this).val();
    var idu=$('#idu'+id).text();
    var nom=$('#nom'+id).text();

    console.log(idu);

    Swal.fire({
    title: 'ELIMINAR MESA',
     text: "ESTA SEGURO DE ELIMINAR LA MESA:"  +nom, 
     icon: 'question',
     showCancelButton: true,
     confirmButtonColor: '#468C00',
     cancelButtonColor: '#D90000',
     confirmButtonText: 'ELIMINAR'
   }).then((result) => {
     if (result.value) {
        eliminarmesa();
     }
   
   })

function eliminarmesa(){
$.ajax({
url:'eliminarmesa.php',
type: 'POST',
data:{'idu':idu},

 }); 
 tablamesa(); 
}

});