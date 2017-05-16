<?php
	require_once("clase_rutas.php");
	$id=$_POST['id'];

	$enlace=new rutas();
	$resultado=$enlace->borrarRuta($id);
	echo $resultado;
	
?>