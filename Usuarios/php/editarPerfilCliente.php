<?php
session_start();
include "clase_usuarios.php";

$nombre = "";
$apellidos = "";
$fecna = "";
$telefono = "";
$password = "";

if($_REQUEST['nombre']) {
$nombre = $_REQUEST['nombre'];
}
if($_REQUEST['apellidos']) {
$apellidos = $_REQUEST['apellidos'];
}
if($_REQUEST['fecna']) {
$fecna = $_REQUEST['fecna'];
}
if($_REQUEST['telefono']) {
$telefono = $_REQUEST['telefono'];
}
if($_REQUEST['password']) {
$password = $_REQUEST['password'];
}


$enlace = new Usuarios(); 
$visualizar = $enlace->modificarUsuario("","","","",$nombre,$apellidos,$fecna,$telefono,$password);



echo json_encode(array($correo,$dni,$nombre,$apellidos,$fecna,$telefono,$password,$nuevaPassWord,$visualizar));

?>