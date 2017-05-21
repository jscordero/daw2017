<?php

class Historial {

    public $conexion="";

    function __construct() {
        $this->conexion= new mysqli('localhost','root','','proyectodaw');

        if($this->conexion->connect_error){
            die('Error de Conexion ('.$this->conexion->connect_errno.')'.$this->conexion->connect_error);
        }
    }
    
    function nuevoHistorial($idUsuario,$idRuta,$kilometros,$valorRuta) {
        $mensaje="";
        
        $consulta="insert into historial (ID_USUARIO,ID_RUTA,KM_RECORRIDOS,VALOR_RUTA) values ($idUsuario,$idRuta,$kilometros,$valorRuta)";
        
        if($respuesta = $this->conexion->query($consulta)) {
            $mensaje="Se ha introducido un nuevo historial";
        }else {
            $mensaje="No se ha podido introducir el historial nuevo";
        }        
        return $mensaje;
    }
    
    function modificarHistorial($id,$idUsuario,$idRuta,$kilometros,$valorRuta) {
        $mensaje="";
        
        $consulta="update historial set ID_USUARIO=$idUsuario,ID_RUTA=$idRuta,KM_RECORRIDOS=$kilometros,VALOR_RUTA='$valorRuta' where ID='$id'";
        
        if($respuesta = $this->conexion->query($consulta)) {
            $mensaje="Se ha modificado el historial con ID" . $id;
        }else {
            $mensaje="No se ha podido modificar el historial";
        }        
        return $mensaje;
    }
    
    function borrarHistorial($id) {
        $mensaje="";
        
        $consulta="delete from historial where ID=$id";
        
        if($respuesta = $this->conexion->query($consulta)) {
            $mensaje="Se ha borrado el historial con ID " .$id;
        }else {
            $mensaje="No se ha podido borrar el historial";
        }       
        return $mensaje;
    }
    
    function seleccionarTodosLosHistoriales() {
        $mensaje="";
        
        $consulta="select * from historial";
        
        if($respuesta = $this->conexion->query($consulta)) {
            return $respuesta;
        }       
    }
    
    function seleccionarUnHistorial($id) {
        $mensaje="";
        
        $consulta="select historial.id as ID, rutas.nombre as RUTAS, historial.valor_ruta as valor from historial join rutas on rutas.id = historial.id_ruta where ID_USUARIO=$id order by id asc";
        
        if($respuesta = $this->conexion->query($consulta)) {
            return $respuesta;
        }        
		return $consulta;
    }
    
    function desconectar() {
        $this->conexion->close();
        return "conexion cerrada";
    }
	
	function calcularNumRutas($id){
		$consulta = "select count(id_ruta) AS TOTAL from historial where ID_USUARIO=".$id;
		if($respuesta = $this->conexion->query($consulta)) {
            return $respuesta;
        }else{
			return 0;
		}
	}
	
	function sumarKm($id){
		$consulta = "select sum(KM_RECORRIDOS) AS TOTAL from historial where ID_USUARIO=".$id;
		if($respuesta = $this->conexion->query($consulta)) {
            return $respuesta;
        }else{
			return 0;
		}
	}

}

?>