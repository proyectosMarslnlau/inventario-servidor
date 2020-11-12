<?php
    //Importamos READ
    require_once('../../class/requestRead.php');
    //Decodificacion de las entradas de USUARIO
    $varEntrada = json_decode(file_get_contents('php://input'), true);
    //Variables
    $user = $varEntrada['user'];
    $pass = $varEntrada['pass'];
    //Conversion a MINUSCULAS

    //
    $consulta = petitionRead::consultarUsuario($user, $pass);
    print_r($consulta);
?>