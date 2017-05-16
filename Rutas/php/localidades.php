<?php
		
	class rutas{
		public $conexion="";
		
		//contructor y conexion a la base de datos.
		function __construct(){
			$this->conexion=new mysqli('localhost','root','','proyectodaw2');
			
			if($this->conexion->connect_error){
                die('Error de Conexion ('.$this->conexion->connect_errno.')'.$this->conexion->connect_error);
            }
		}
		//Para panel del Admin
		function nuevaLocalidad($nombre){
			$mensaje="";
			$consulta="insert into localidad (LOCALIDAD) values ('".$nombre."')";
			
			if($resultado=$this->conexion->query($consulta)){
				$mensaje="Registrada nueva ruta";
			}else{
				$mensaje="No se ha podido registrar la ruta";
			}
			return $mensaje;
		}
	}
	$pueblo="Abadía";
	$enlace = new rutas();
	$resultado = $enlace->nuevaLocalidad($pueblo);
	echo $resultado;
?>