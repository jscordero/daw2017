<?php
session_start();
include "../../Rutas/php/clase_reservas.php";

$reservas = array();

class mostrarReserva {
    public $idReservas = "";
    public $fecha = "";
    public $nombreRuta = "";
    public $personas = "";
    
    function __construct($idReservas,$fecha,$nombreRuta,$personas) {
        $this->idReservas = $idReservas;
        $this->fecha = $fecha;
        $this->nombreRuta = $nombreRuta;
        $this->personas = $personas;
    }
}

$enlace = new reservas(); 
$visualizar = $enlace->seleccionarTodasReservas($_SESSION['ID']);

if(empty($visualizar)) {
    $respuestaNegativa = ["No tiene reservas"];
    echo(json_encode($respuestaNegativa));
    
}else {
    
    while($fila = $visualizar->fetch_assoc()) {
        $idReservas = $fila['ID'];
        $fecha = $fila['FECHA'];
        $nombreRuta = $fila['RUTAS'];
        $personas = $fila['PERSONAS'];
        
        $objeto = new mostrarReserva($idReservas,$fecha,$nombreRuta,$personas);
        
        array_push($reservas,$objeto);
        
    }
    
    header('Content-type: application/json; charset=UTF-8');
	echo json_encode($reservas);
    
}


?>