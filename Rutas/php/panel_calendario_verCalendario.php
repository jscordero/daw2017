<?php
	require_once('clase_calendario.php');
	$datos=array();
	$fecha=$_POST['fecha'];
	//$fecha="2017/05/20";
	class envio{
		public $id;
		public $id_ruta;
		public $fecha;

		
		function __construct($id, $id_ruta, $fecha){
			$this->id=$id;
			$this->id_ruta=$id_ruta;
			$this->fecha=$fecha;

		}			
	}

	
	$enlace = new calendario();
	$resultado=$enlace->visualizarFecha($fecha);
	if(!empty($resultado)){	
		while($fila=$resultado->fetch_assoc()){
			$respuesta= new envio($fila['ID'], $fila['ID_RUTA'],$fila['FECHA']);
			array_push($datos, $respuesta);
		}
		header('Content-Type: application/json');
		echo json_encode($datos);
	}else{
		echo "";
	}
	
	$enlace->desconectar();
?>