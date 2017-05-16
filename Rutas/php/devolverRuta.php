<?php
	require_once('clase_rutas.php');
	class envio{
		public $id;
		public $nombre;
		public $km;
		public $minutos;
		public $localidad;
		public $consejos;
		public $pdf;
		public $max_res;
		public $valoracion;
		public $mapa;
		public $dificultad;
		
		function __construct($id, $nombre, $km, $minutos, $localidad,  $consejos, $pdf, $max_res, $valoracion, $mapa, $dificultad){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->km=$km;
			$this->minutos=$minutos;
			$this->localidad=$localidad;
			$this->consejos=$consejos;
			$this->pdf=$pdf;
			$this->max_res=$max_res;
			$this->valoracion=$valoracion;
			$this->mapa=$mapa;
			$this->dificultad=$dificultad;
		}			
	}
	$id=$_POST['id'];
	
	$enlace = new rutas();
	$resultado=$enlace->seleccionarUnaRuta($id);
	while($fila=$resultado->fetch_assoc()){
		$respuesta= new envio($fila['ID'], $fila['NOMBRE'],$fila['KILOMETROS'],$fila['MINUTOS'],$fila['LOCALIDAD'],$fila['CONSEJOS'],$fila['PDF'],$fila['MAX_RESERVAS'],$fila['VALORACION'],$fila['MAPA'],$fila['DIFICULTAD']);
	}
	header('Content-Type: application/json');
	echo json_encode($respuesta);
	$enlace->desconectar();
?>