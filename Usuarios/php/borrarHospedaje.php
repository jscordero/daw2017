<?php
	include 'clase_hospedajes.php';
	$id=$_POST['id'];	
	
	$enlace = new hospedaje();	
	$resultado=$enlace->borrarHospedaje($id);		
	echo $resultado;
	$enlace->desconectar();
	
	
?>