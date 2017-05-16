
$(document).ready(function() {
    cargarDatos();
    var fileExtension="";
    
    $('#nav :file').change(function(){
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0]
        //obtenemos el nombre del archivo
        var fileName = file.name
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1)
               
    });
	
    $('#insertar').on('click',function() {
        
        
	

        var formData = new FormData($(".formulario")[0]);

         $.ajax({
            url: 'rutas/php/direccion_imagen.php',  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,			
            processData: false,
            
            //una vez finalizado correctamente
            success: function(response){
                 var nombre = $('#nombreGuia').val();
    
                //var nick = $("#nombreGuia").val();
                //console.log("Este es el nick: " + nick);
                console.log(response + "NICK: " + nombre);
				var nombre = $('#nombreGuia').val()
				console.log("Dentro del ajax: "+nombre)

                console.log(response);
            }


        });
    }); 

    $('#borrar').on('click',function() {
        console.log("Estamos dentro");
    }); 

    $('#modificar').on('click',function() {
        console.log("Estamos dentro");
    }); 

    function isImage(extension){
        switch(extension.toLowerCase()) 
        {
            case 'jpg': case 'gif': case 'png': case 'jpeg':
                return true;
                break;
            default:
                return false;
                break;
        }
    }
    function cargarDatos() {
        $.ajax({

            url:   'Rutas/php/listaUsuarios.php',
            type:  'post',

            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {
                $("#listaUsuarios").innerHTML = response;
                console.log(response + "ESTE");
            }
        });
    }
});