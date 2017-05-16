<?php
	include 'clase_hospedajes.php';
	$datos=[];
	class hospe{
		public $id="";
		public $nombre="";
		public $localidad="";
		public $descripcion="";
		public $web="";
		
		function __construct($id, $nombre,$localidad,$descripcion,$web){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->localidad=$localidad;
			$this->descripcion=$descripcion;
			$this->web=$web;
		}
	}
	
	$pueblo=$_POST['pueblo'];
	
	$enlace = new hospedaje();
	if($pueblo == "Todos"){
		if($resultado=$enlace->mostrarHospedajeTodos()){
			while($fila=$resultado->fetch_assoc()){	
				$media=new hospe($fila['ID'],$fila['NOMBRE'],$fila['LOCALIDAD'],$fila['DESCRIPCION'],$fila['PAGINA_WEB']);
				array_push($datos, $media);
			}
		}
	}else{
		if($resultado=$enlace->mostrarHospedaje($pueblo)){
			while($fila=$resultado->fetch_assoc()){	
				$media=new hospe($fila['ID'],$fila['NOMBRE'],$fila['LOCALIDAD'],$fila['DESCRIPCION'],$fila['PAGINA_WEB']);
				array_push($datos, $media);
			}
		}
	}
	if($datos!=""){
		header('Content-Type: application/json');
		echo json_encode($datos);
	}
	else{
		echo 'No hay Datos';
	}
	
	
?>