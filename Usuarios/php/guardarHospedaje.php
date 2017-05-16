<?php
	include 'clase_hospedajes.php';
	$nombre=$_POST['nombre'];
	$localidad=$_POST['localidad'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$email=$_POST['email'];
	$web=$_POST['web'];
	
	$descripcion=$direccion."#".$telefono."#".$email;
	/*if(!empty($direccion)){
		$descripcion=$descripcion."<p>Dirección: <span>".$direccion."</span></p>";
	}
	if(!empty($direccion)){
		$descripcion=$descripcion."<p>Teléfono: <span>".$telefono."</span></p>";
	}
	if(!empty($direccion)){
		$descripcion=$descripcion."<p>Otro: <span>".$telefono2."</span></p>";
	}
	if(!empty($direccion)){
		$descripcion=$descripcion."<p>Email: <span>".$email."</span></p>";
	}*/
	
	$enlace = new hospedaje();	
	$resultado=$enlace->insertarHospedaje($nombre, $localidad, $descripcion, $web);	
	
	echo $resultado;
	$enlace->desconectar();
	
	
?>