<?php
	require_once('clase_calendario.php');
	$datos=array();
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
	$resultado=$enlace->visualizarTodasFechas();
	while($fila=$resultado->fetch_assoc()){
		$respuesta= new envio($fila['ID'], $fila['ID_RUTA'],$fila['FECHA']);
		array_push($datos, $respuesta);
	}
	header('Content-Type: application/json');
	echo json_encode($datos);
	$enlace->desconectar();
?>