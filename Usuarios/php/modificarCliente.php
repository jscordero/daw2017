<?php
session_start();
include "clase_usuarios.php";



$correo = $_REQUEST['correo'];
$dni = $_REQUEST['dni'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$fecna = $_REQUEST['fecna'];
$telefono = $_REQUEST['telefono'];
$password = $_REQUEST['password'];

$nuevaPassWord = $_REQUEST['nuevaPassword'];

$enlace = new Usuarios(); 
$visualizar = $enlace->modificarUsuario($correo,$dni,$nombre,$apellidos,$fecna,$telefono,$password,$nuevaPassWord,$_SESSION['nickCliente']);



echo json_encode(array($correo,$dni,$nombre,$apellidos,$fecna,$telefono,$password,$nuevaPassWord,$visualizar));

?>