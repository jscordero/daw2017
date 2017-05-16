$(document).ready(function(){
mostrarValoracion()
function mostrarValoracion(){
	
		 $.ajax({            
            url:'Rutas/php/mostrar-valoracion.php',
			type:'post',
			DataType:'Json',                      
            success:function (data) {
                var enlace=""				
				for( var x=0;x<data.length;x++){
                   
					
					enlace+="<fieldset><h4><p><a href='rutas.html'>"+data[x].nombre+"</p><p>Valoración: "+data[x].valoracion+"</a></p></h4></fieldset>"
				}
				
				$('#mas-valoradas').html(enlace)
				
            }            
        })		
}



});