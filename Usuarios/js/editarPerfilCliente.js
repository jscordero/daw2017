$(document).ready(function() {
	
	mostrarHistorial()
    calcularKms()
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
    
   
     $.ajax({
            
		url:   'Usuarios/php/mostrarReservas.php',
		type:  'post',
		dataType: 'Json',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},
		success:  function (response) {				
			var reservas = $('#reservas');  
			var tabla=""
			
			if (response==""){
				tabla+="<div class='contenedor_reserva'><div class='titulo'><p class='no_reservas'>No Tienes reservas</p></div>"
				tabla+="<div><p class'persona'>Anímate a realizar una ruta con Nosotros</p></div></div>"
			}else{
				for(var i = 0; i < response.length; i++) {
				tabla+="<div class='contenedor_reserva'><input type='button' id='cancelarReserva' class='ocultar2' readOnly='true'name='cancelarReserva' value='" + response[i].idReservas + "'/><div class='titulo'><p><span class='fecha'>"+response[i].fecha+"</span><span class='ruta'>"+response[i].nombreRuta+"</p></div>"
				tabla+="<div><p class'persona'>"+response[i].personas+"</p></div></div>"				 
			}
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
    })
}

function mostrarHistorial(){
	$.ajax({            
		url:   'Usuarios/php/mostrarHistorial.php',
		type:  'post',
		dataType: 'Json',            
		success:  function (response) {	
			$('#historial').html("")		
			var tabla=""
			if (response==0){
				tabla+="<div class='contenedor_reserva'><div class='titulo'><p class='no_reservas'>No has realizado ninguna Ruta</p></div>"
				tabla+="<div><p class'persona'>Anímate a realizar una ruta con Nosotros</p></div></div>"
			}else{
				for(var i = 0; i < response.length; i++) {
					if(i%2==0){
						tabla+="<div class=''><div class='pares'><p><span class='ruta2'>"+response[i].nombreRuta+"</p><p><span class='nota'>Tu Nota: </span><span class='nota'>"
						if(response[i].valor == -1){
							tabla +="<input  name='"+response[i].idReservas+"' type='number' min='0' max='10' id='tamanioimput' step='.1'/><input class='userValor' id='"+response[i].idReservas+"' type='submit' value='Valorar'/></span></p></div>"
						}else{
							tabla +=response[i].valor+"</span></p></div>"
						}						
					}else{
						tabla+="<div class=''><div class='impares'><p><span class='ruta2'>"+response[i].nombreRuta+"</p><p><span class='nota'>Tu Nota: </span><span class='nota'>"
						if(response[i].valor == -1){
							tabla +="<input  name='"+response[i].idReservas+"' type='number' min='0' max='10' id='tamanioimput' step='.1'/><input class='userValor' id='"+response[i].idReservas+"' type='submit' value='Valorar'/></span><span class='ruta2'>"+response[i].nombreRuta+"</p></div>"
						}else{
							tabla +=response[i].valor+"</span></p></div>"
						}						
					}							 
				}
				
				
			}
			$('#historial').html(tabla)
			$('input.userValor').click(guardarValoracion)
		}
	});
}

function calcularKms(){	
	 $.ajax({            
		url:   'Usuarios/php/calcularEstadisticas.php',
		type:  'post',
		dataType: 'Json',            
		success:  function (response) {	
			if(response.rutas!=0){
				$('#numrutas').html(response.rutas)
			}else{
				$('#numrutas').html(0)
			}
			if(response.rutas!=0){
				$('#KMS').html(response.kms)
			}else{
				$('#KMS').html(0)
			}
		}
	})
}

function guardarValoracion(){	
	var id= $(this).attr("id")	
	var valor = $('input[name='+id+']').val()
	var enlace=$(this).parent().parent().parent().parent().find("span")
	var id_ruta=enlace[0].innerHTML	
	datos={
		id:id,
		valor:valor,
		id_ruta:id_ruta
	}
	 $.ajax({            
		url:   'Usuarios/php/guardarValoracion.php',
		data:datos,
		type:  'post',		           
		success:  function (response) {				
			mostrarHistorial()
		}
	})
}