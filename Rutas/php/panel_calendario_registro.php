<?php
	include 'clase_calendario.php';
	$ruta=$_POST['ruta'];
	$fecha=$_POST['fecha'];
	
	$enlace = new calendario();
	$resultado=$enlace->insertarCalendario($ruta,$fecha);
	echo $resultado;
?>