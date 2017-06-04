$(document).ready(function(){
	mostrarValoracion()
	function mostrarValoracion(){
	
		 $.ajax({            
            url:'Rutas/php/mostrar-guias.php',
			type:'post',
			DataType:'Json',                      
            success:function (data) {
                var enlace="<table id='tabla-hospe'>"
                enlace+="<tr><th>Imagen</th><th>Nombre</th><th>Experiencia</th></tr>"
				for( var x=0;x<data.length;x++){
                   
                    enlace+="<tr>"					
					enlace+="<td><img src='"+data[x].imagen_guia+"'/></td><td>"+data[x].nombre_guia+"</td><td>"+data[x].experiencia+"</td>"
                    enlace+="</tr>"
				}
				enlace+="</table>"
				$('#caja-guias').html(enlace)
				
            }            
        })		
}
	cargarReservas()
});




function cargarReservas(){
	 $.ajax({            
            url:'Rutas/php/mostrar_reservas_guias.php',
			type:'post',
			DataType:'Json',                      
            success:function (response) {
             var tabla=""
			   
			   tabla+="<select id='reser'><option></option>"
			   for(var i = 0; i < response.length; i++) {
					tabla+="<option>"+response[i].id+"/"+response[i].nombre+"</option>"
					
									
				}
				tabla+="</select><span class='boton reserva' id='descargar_reserva'>Ver Inscritos</span></div><div id='inscritos'></div>"	
					$('#reserva_guias').html(tabla)
					$('#descargar_reserva').click(pdf)
				
            }            
        })
}

function pdf(){
	reserva=$('#reser').val();
	datos={
				datos:reserva
			}
	$.ajax({      
		
			data:datos,	
            url:'Rutas/php/pdf_reserva.php',
			type:'post',
			DataType:'Json',                      
            success:function (response) {
				var tabla="<div id='centrar_guia'><a id='PDF'  href='' download=''><img id='icon' src='img/pdf.png'></img></a>"
				for(var i = 0; i < response.length; i++) {
						
				var separarFilas=response[i].personas.split("@")
					for (var x=0;x<separarFilas.length;x++){
							tabla+="<div>"
						var separarPersonas=separarFilas[x].split("#")						
							if(x%2!=0){
								console.log("par")
								tabla+="<div>"+separarPersonas[0]+"</div>"
							}else{
								tabla+="<div>"+separarPersonas[0]+"</div>"
							}
							
						}	
				tabla+="</div></div>"						
					}	
					$('#inscritos').html(tabla)
					$('#PDF').attr("href",response[0].direccion)
            }            
        })	
}


function annadirHistorial(){
	
	 $.ajax({ 
			
            url:'Rutas/php/mostrar_reservas_guias.php',
			type:'post',	
DataType:'Json', 			
            success:function (response) {
             var tabla=""
			   
			   
			   for(var i = 0; i < response.length; i++) {
					tabla+="<div class='contenedor_reserva'><div><a class='cancelar' href='#' data-type='zoomin'>X</a><input type='button' id='cancelarReserva' class='ocultar2' readOnly='true' name='cancelarReserva' value='" + response[i].idReservas + "'/></div><div class='titulo'><p><span class='fecha'>"+response[i].fecha+"</span><span class='ruta'>"+response[i].nombreRuta+"</p></div>"
						
				var separarFilas=response[i].personas.split("@")
					for (var x=0;x<separarFilas.length;x++){
							tabla+="<div>"
						var separarPersonas=separarFilas[x].split("#")						
							if(x%2!=0){
								console.log("par")
								tabla+="<div class='personaRes filaPar'>"+separarPersonas[0]+"</div></div>"
							}else{
								tabla+="<div class='personaRes'>"+separarPersonas[0]+"</div></div>"
							}
							
						}	
				tabla+="</div>"						
					}
					$('#reserva_guias').html(tabla)
				
            }            
        })
}