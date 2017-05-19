<?Php
	session_Start();
	include ('clase_reservas.php');
/*	$fecha=$_POST['fecha'];
	$ruta=$_POST['id_ruta'];
	$usuario=$_SESSION['ID'];
	*/
	$fecha='2017/11/11';
	$ruta=21;
	$usuario=11;
	
	$enlace = new reservas();
	$resultado=$enlace->busquedaReserva($usuario,$fecha,$ruta);
	echo $resultado;
	
	
?>