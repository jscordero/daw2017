<?php
	require_once('clase_calendario.php');
	$datos=array();
	$id = $_POST['id'];
	$enlace = new calendario();
	$resultado=$enlace->borrarCalendario($id);	
	echo $resultado;
	$enlace->desconectar();
?>