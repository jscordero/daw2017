<?php
	require_once("clase_calendario.php");
	$enlace=new calendario();
	$datos=array();
	$fecha=$_POST['fecha'];
	$resultado=$enlace->visualizarFecha($fecha);
	class ruta{			
		public $nombre="";
		public $fecha2="";
		function __construct($nombre,$fecha){				
			$this->nombre=$nombre;	
			$this->fecha2=$fecha;
		}
	}	
	
	if($resultado->num_rows>0){	
		while($fila=$resultado->fetch_assoc()){
			$respuesta= new ruta($fila['NOMBRE'],$fila['FECHA']);			
			array_push($datos, $respuesta);
		}
		header('Content-Type: application/json');
		echo json_encode($datos);
	}else{
		$respuesta= new ruta("vacio","vacio");
		array_push($datos, $respuesta);
		header('Content-Type: application/json');
		echo json_encode($datos);
	}
?>