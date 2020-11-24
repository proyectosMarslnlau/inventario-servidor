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
if(sizeof($consulta) !== 0 ){
    echo json_encode(array('response' => 'correcto', 'information' => $consulta));
}else{
    echo json_encode(array('response' => 'vacio'));
}

?>