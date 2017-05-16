<?php
	require_once('clase_rutas.php');
    $datos = array();
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
		
		function __construct($id, $nombre, $km, $minutos, $localidad,  $consejos, $dificultad, $valoracion, $pdf, $max_res, $mapa){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->km=$km;
			$this->minutos=$minutos;
			$this->localidad=$localidad;
			$this->consejos=$consejos;
            $this->dificultad=$dificultad;
            $this->valoracion=$valoracion;
			$this->pdf=$pdf;
			$this->max_res=$max_res;			
			$this->mapa=$mapa;
			
		}			
	}
	
	
	$enlace = new rutas();
	$resultado = $enlace->mostrarValoracion();

for($x=0;$x<5;$x++){		
		$fila=$resultado[$x];		
		$juan = new envio($fila[0],$fila[1],$fila[2],$fila[3],$fila[4],$fila[5],$fila[6],$fila[7],$fila[8],$fila[9],$fila[10]);
		array_push($datos, $juan);
	}	

	
	header('Content-Type: application/json');
	echo json_encode($datos);
	$enlace->desconectar();
?>