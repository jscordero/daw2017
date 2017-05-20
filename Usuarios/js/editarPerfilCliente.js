$(document).ready(function() {
    
    $("#cancelarReserva").on("click",function() {
        valor = $(this).value;
        console.log("Dentro de calcelacion con id: " + valor);
    });

    $("#editar_perfil").on('click',desplegar)

    $('#update').on('click',function() {

        console.log("Dentro de la función");

        var password = $(this).parent().parent().children().children("#passwdUpdate").val(); 

        var nombre = $(this).parent().parent().children().children("#nombreUpdate").val();
        console.log("Este es el nombre: " + nombre);
        var apellidos = $(this).parent().parent().children().children("#apellidosUpdate").val();

        var fecna = $(this).parent().parent().children().children("#fecnaUpdate").val();

        var telefono = $(this).parent().parent().children().children("#telefonoUpdate").val();

        var enviarAjax = {"nombre":nombre,"apellidos":apellidos,"fecna":fecna,"telefono":telefono,"password":password};

        console.log("Esto se va a enviar: " + enviarAjax);

        $.ajax({
            data:  enviarAjax,
            url:   'Usuarios/php/editarPerfilCliente.php',
            type:  'post',
            dataType: 'Json',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {                
				desplegar()
            }


        });
    });
    
   
    
    console.log("dentro reservas")
     $.ajax({
            
            url:   'Usuarios/php/mostrarReservas.php',
            type:  'post',
            dataType: 'Json',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {				
                 var reservas = $('#reservas');
                
                /*var tabla = "<table id='tablaReservas'><tr><th>Fecha</th><th>Ruta</th><th>Personas</th></tr>"
                for(var i = 0; i < response.length; i++) {
                    tabla += "<tr>";
                    tabla += "<td style='width:150px;'>" + response[i].fecha; + "</td>";
                    tabla += "<td>" + response[i].nombreRuta; + "</td>";
                    tabla += "<td style='width:450px;'>" + response[i].personas; + "</td>";
                    tabla += "<td><input type='button' id='cancelarReserva' name='cancelarReserva' value='" + response[i].idReservas + "'/></td>"
                    tabla += "</tr>";
                }
                tabla += "</table>";
                
                tablaEstilos = $("#tablaReservas");
                tablaEstilos.children.children.style = "border:2px solid red;";*/
				var tabla=""
				for(var i = 0; i < response.length; i++) {
				//tabla+="<div><input type='button' id='cancelarReserva' class='ocultar2' readOnly='true'name='cancelarReserva' value='" + response[i].idReservas + "'/><div><p><input type='submit' value='X'/><p><span class='fecha'>"+response[i].fecha+"</span><span class='ruta'>"+response[i].nombreRuta+"</span></p></div></div>"+response[i].personas+"</div></div>"
				tabla+="<div class='contenedor_reserva'><input type='button' id='cancelarReserva' class='ocultar2' readOnly='true'name='cancelarReserva' value='" + response[i].idReservas + "'/><div class='titulo'><p><span class='fecha'>"+response[i].fecha+"</span><span class='ruta'>"+response[i].nombreRuta+"</p></div>"
				tabla+="<div><p class'persona'>"+response[i].personas+"</p></div></div>"				 
				 }
				 reservas.html(tabla);
			}


        });
    
});

function desplegar(){
	 if($('#updateUsuario').hasClass('ocultar2')) {
            $('#updateUsuario').removeClass('ocultar2');
            $('#updateUsuario').addClass('mostrar2');
			$('#editar_perfil').addClass('ocultar2');
            $('#editar_perfil').removeClass('mostrar2');
        }else if($('#updateUsuario').hasClass('mostrar2')) {
            $('#updateUsuario').removeClass('mostrar2');
            $('#updateUsuario').addClass('ocultar2');
			$('#editar_perfil').removeClass('ocultar2');
            $('#editar_perfil').addClass('mostrar2');
        }

        $.ajax({
            url:   'Usuarios/php/selectPerfilPrevioUpdate.php',
            type:  'post',
            dataType: 'Json',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {

                
                var nombre = response.nombre;
                var apellidos = response.apellidos;
                var fecna = response.fecna;
                var telefono = response.telefono;

                $("#passwdUpdate").val("");
                $("#nombreUpdate").val(nombre);
                $("#apellidosUpdate").val(apellidos);
                $("#fecnaUpdate").val(fecna);
                $("#telefonoUpdate").val(telefono);
            }

        });
}