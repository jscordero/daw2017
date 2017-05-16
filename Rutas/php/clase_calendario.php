<?php
	class calendario{
		public $conexion="";
		
		function __construct(){
			$this->conexion=new mysqli('localhost','root','','proyectodaw');
			
			if($this->conexion->connect_error){
                die('Error de Conexion ('.$this->conexion->connect_errno.')'.$this->conexion->connect_error);
            }
		}
		
		function borrarCalendario($id){
			$mensaje="";
			$consulta="delete from calendario where id=".$id;
			if($resultado=$this->conexion->query($consulta)){
				$mensaje="borrado con exito";
			}else{
				$mensaje="No se ha podido borrar";
			}
			return $mensaje;
		}
		
		function insertarCalendario($id_ruta,$fecha){
			$mensaje="";
			$consulta="insert into calendario (ID_RUTA, FECHA) VALUES(".$id_ruta.",'".$fecha."')";
			if($resultado=$this->conexion->query($consulta)){
				$mensaje="Insertado nueva fecha";
			}else{
				$mensaje="No se ha podido añadir la fecha";
			}
			return $mensaje;
		}
		
		function editarCalendario($id){
			$mensaje="";
			$consulta="update calendario ID_RUTA=".$id_ruta." fecha='".$fecha."' where ID=".$id;
			if($resultado=$this->conexion->query($consulta)){
				$mensaje="Modificado la fecha";
			}else{
				$mensaje="No se ha podido modificar la fecha";
			}
			return $mensaje;
		}
		
		function visualizarTodasFechas(){
			$consulta="select ID, ID_RUTA, FECHA from calendario order by fecha asc";
			if($resultado=$this->conexion->query($consulta)){
				return $resultado;
			}
		}
		
		function visualizarFecha($fecha){
			$consulta="select calendario.ID, calendario.ID_RUTA, calendario.FECHA, rutas.NOMBRE from calendario join rutas on calendario.ID_RUTA = rutas.ID where calendario.fecha='".$fecha."'";
			if($resultado=$this->conexion->query($consulta)){
				return $resultado;
			}
		}
		
		function visualizarFechaUnRuta($id){
		$consulta="select * from calendario where ID_RUTA=".$id." order by fecha asc";
			if($resultado=$this->conexion->query($consulta)){
				return $resultado;
			}			
		}
		
		function desconectar(){
			$this->conexion->close();
			return "conexion cerrada";
		}
	}
?>