<?php
	session_Start();
	include 'clase_reservas.php';
	$mensaje=$_POST['reserva'];
	$fecha=$_POST['fecha'];
	$id_ruta=$_POST['id_ruta'];
	$id_user=$_SESSION['ID'];
	$contador=$_POST['numero'];
	
	$enlace=new reservas();
	$resultado=$enlace->nuevaReserva($id_ruta,$id_user,$contador,$fecha,$mensaje);
	echo $resultado;
	
?>