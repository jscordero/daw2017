<?php
	require_once('clase_calendario.php');
	$datos=array();
	//
	
	$id=$_POST['id'];


	class envio{
		public $id;
		public $id_ruta;
		public $fecha2;

		
		function __construct($id, $id_ruta, $fecha){
			$this->id=$id;
			$this->id_ruta=$id_ruta;
			$this->fecha2=$fecha;

		}			
	}

	
	$enlace = new calendario();
	$resultado=$enlace->visualizarFechaUnRuta($id);
	
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