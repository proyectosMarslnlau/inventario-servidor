<?php
//Invocamos los CORS para no tener problemas de envio de informacion
require_once('../../../services/cors.php');
//Invocamos las funciones de Invocacion de CREATE
require_once('../../class/requestRead.php');

//Invocamos las CONSTANTES
require_once('../../../sheets/constant.php');  
//-------------------------------------------------------------------------
//Decodificacion de las entradas de USUARIO
header("Content-Type: application/json");
$varEntrada = json_decode(file_get_contents('php://input'), true);

//Consulta de los datos y encapsulados en los datos
$consulta = petitionRead::consultarTodoObjetos();
$var = [];
foreach( $consulta as $value){
    $code = $value['code'];
    array_push( $var, $code);
}
//Eliminamos todos los valores repetidos de codigo para enviar al SELECT
$arrayString = 	array_unique($var);
$var2 = [];
foreach ($arrayString as $item) {
    array_push( $var2, $item);
}
echo json_encode(array('response' => 'correcto', 'information' => $var2));
?>