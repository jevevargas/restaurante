
     function terminar(){
        var tipopago=document.getElementById("tipopago").value;

        if( tipopago=="0"){
            $("#tipopago").addClass("is-invalid");
        }

        if( tipopago>=1 ){

            var idcli = $('#idcli').val(),
                orden = $('#orden').val(),
                pago = $('#pago').val(),
                tipopago = $('#tipopago').val(); 

                $.ajax({
                    url: 'terminarpedido.php', // Es importante que la ruta sea correcta si no, no se va a ejecutar
                    method: 'POST',
                    data: { idcli:idcli,
                            orden:orden,
                            pago:pago,
                            tipopago:tipopago
                          },
                    beforeSend: function(){},
                    success: function()
                    
                    {
                       // botonultimopago();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'PAGOS REGISTRADOS',
                            showConfirmButton: false,
                            timer: 1500
                          })
    
                          location.href ="index.php";   
                
                    }
    
                });

        }
     }