function guardarId(){
	var id = $(this).find('input').val()
	console.log("id:"+id)
	sessionStorage.setItem('id', id)
	
}

function mostrarValoracion(){
	
		 $.ajax({            
            url:'Rutas/php/mostrar-valoracion.php',
			type:'post',
			DataType:'Json',                      
            success:function (data) {
                var enlace=""				
				for( var x=0;x<data.length;x++){
                   console.log(data[x].nombre)
					
					enlace+="<fieldset class='perfil_ruta'><input type='hidden' value='"+data[x].nombre+"'/><h4><p><a href='rutas.html'>"+data[x].nombre+"</a></p><p>Valoración: "+data[x].valoracion+"</p></h4></fieldset>"
				}
				
				$('#mas-valoradas').html(enlace)
				$('.perfil_ruta').click(guardarId)
				
            }            
        })		
}
$(document).ready(function(){
mostrarValoracion()
});

