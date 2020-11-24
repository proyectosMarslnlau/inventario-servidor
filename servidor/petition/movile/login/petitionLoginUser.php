<?php
//Invocamos los CORS para no tener problemas de envio de informacion
require_once('../../../services/cors.php');
//Invocamos la funcion para LEER DATOS
require_once('../../class/requestRead.php');
//-------------------------------------------------------------------------
//Decodificacion de las entradas de USUARIO
header("Content-Type: application/json");
$varEntrada = json_decode(file_get_contents('php://input'), true);

//Variables
$user = $varEntrada['user'];
$pass = $varEntrada['pass'];

//Conversion a MINUSCULAS
$user = strtolower($user);
$pass = strtolower($pass);

//PETICION DE CONSULTA DE LOGUEO
$consulta = petitionRead::consultarUsuario($user, $pass);

//Verificacion de USUARIO LOGUEADO
if ( $consulta === false) {
    echo json_encode(array('response' => 'incorrecto'));
} else {
    echo json_encode(array('response' => 'correcto', 'information' => $consulta));
}
