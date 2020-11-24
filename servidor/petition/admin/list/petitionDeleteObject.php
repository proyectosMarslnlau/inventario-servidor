<?php
//Invocamos los CORS para no tener problemas de envio de informacion
require_once('../../../services/cors.php');
//Invocamos las funciones de Invocacion de CREATE
require_once('../../class/requestRead.php');
require_once('../../class/requestDelete.php');
//Invocamos las CONSTANTES
require_once('../../../sheets/constant.php');  
//-------------------------------------------------------------------------
//Decodificacion de las entradas de USUARIO
header("Content-Type: application/json");
$varEntrada = json_decode(file_get_contents('php://input'), true);

//Variables
$iddatos = $varEntrada['iddatos'];

//Consulta de los datos y encapsulados en los datos
$consulta = petitionRead::consultarUnicoObjetoId($iddatos);

if(sizeof($consulta) !== 0 ){
    //
    $archivoImagen = $consulta[0]['imagen'];
    $datosImagen = explode("/", $archivoImagen);
    $direccionImagen= '../../../public/image/' . $datosImagen[7];
    unlink($direccionImagen);

    $archivoImagenQR = $consulta[0]['qr'];
    $datosImagenQR = explode("/", $archivoImagen);
    $direccionImagen= '../../../public/imageQR/' . $datosImagenQR[7];
    unlink($direccionImagen);

    $consulta = petitionDelete::borrarObjeto($iddatos);
    if($consulta === true){
        echo json_encode(array('response' => 'correcto'));
    }else{
        echo json_encode(array('response' => 'incorrecto'));
    }
}else{
    echo json_encode(array('response' => 'vacio'));
}

?>