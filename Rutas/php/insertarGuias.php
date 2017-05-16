<?php
    include "clase_guias.php";

    $nick = $_REQUEST['nick'];
    $experiencia = $_REQUEST['experiencia'];
    

    

    $resultado = new guias();

    $resutado->annadirGuia($nick,$experiencia,$destino);

    echo json_encode(array($nick,$experiencia,$destino,$resultado));
    
?>