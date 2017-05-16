<?php
    include "../../Usuarios/php/clase_usuarios.php";

    $respuesta = new Usuarios();
    $respuesta2 = $respuesta->seleccionarTodosLosUsuarios();

    $arrayUsuarios = [];

   

     class DatosUsuarios  {
         public $id = "";
         public $usuario = "";
         public $correo = "";
         public $dni = "";
         public $nombre = "";
         public $apellidos = "";
         public $fecna = "";
         public $telefono = "";
         public $perfil = "";
         public $password = "";
         
         function __construct($id,$usuario,$correo,$dni,$nombre,$apellidos,$fecna,$telefono,$perfil,$password) {
             $this->id = $id;
             $this->usuario = $usuario;
             $this->correo = $correo;
             $this->dni = $dni;
             $this->nombre = $nombre;
             $this->apellidos = $apellidos;
             $this->fecna = $fecna;
             $this->telefono = $telefono;
             $this->perfil = $perfil;
             $this->password = $password;
         }
         
     }

     while($fila = $respuesta2->fetch_assoc()) {
        $enlace = new DatosUsuarios($fila['ID'],$fila['USUARIO'],$fila['CORREO'],$fila['DNI'],$fila['NOMBRE'],$fila['APELLIDOS'],$fila['FECNA'],$fila['TELEFONO'],$fila['PERFIL'],$fila['PASSWORD']);
        
        array_push($arrayUsuarios,$enlace);
    }

    json_encode($arrayUsuarios);

?>