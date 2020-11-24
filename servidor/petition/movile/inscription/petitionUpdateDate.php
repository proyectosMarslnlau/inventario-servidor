<?php
//Invocamos los CORS para no tener problemas de envio de informacion
require_once('../../../services/cors.php');
//Invocamos las funciones de Invocacion de CREATE
require_once('../../class/requestCreate.php');
require_once('../../class/requestRead.php');

//Invocamos las CONSTANTES
require_once('../../../sheets/constant.php');
//Invocacion de la libreria de SHORT ID
use PUGX\Shortid\Shortid;
require_once('../../../vendor/autoload.php');
//Invocacion de libreria conversor a QR
require_once('../../../vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;    

//-------------------------------------------------------------------------
//Decodificacion de las entradas de USUARIO
header("Content-Type: application/json");
$varEntrada = json_decode(file_get_contents('php://input'), true);

//Variables
//$codigo = $varEntrada['codigo'];
$code = $varEntrada['code'];
$cifra = $varEntrada['cifra'];
//
$nombre = $varEntrada['nombre'];
$lugar = $varEntrada['lugar'];
$costo = $varEntrada['costo'];
$anio = $varEntrada['anio'];
    //valor enviado en formato BASE64
$imagen = $varEntrada['imagen'];
$descripcion = $varEntrada['descripcion'];
$estado = $varEntrada['estado'];

//Saneamiento de variables de REGISTRO
    //UNION DE VARIABLES DE CODIGO
$code = strtoupper($code);
$cifra = strtoupper($cifra);
$codigo = $code . $cifra ;    
    //
$nombre = strtolower($nombre);
$lugar = strtolower($lugar);
$descripcion = strtolower($descripcion);

//
$consultaCodigo = petitionRead::consultarRepeticion($code, $cifra);
if($consultaCodigo === true){
    //DESCOMPOCICION DE IMAGEN de BASE64 -> PNG
    //---Generacion de ID
    $id = Shortid::generate();
    //---Declaramos la IMAGEN
    $nombreImagen = $id . "_" . $codigo .".png";
    //---Ruta de imagen de SALIDA
    $rutaImagenSalida = "../../../public/image/" . $nombreImagen;
    //---Decodificacion de BASE64
    $imagenBinaria = base64_decode($imagen);
    //---Copiado de Imagen a la DIRECCION DESIGNADA
    $rutaImagenFinal = file_put_contents($rutaImagenSalida, $imagenBinaria);
    //---Direccion de Imagen Final-----------
    $direccionImage = IP_SERVER . 'inventario-servidor/servidor/public/image/' . $nombreImagen;

    //GENERACION DE IMAGEN QR 
    //---Instanciamos el CODIGO
    $qrCode = new QrCode($codigo);
    //---Colocamos la DIMENSION DE LA IMAGEN
    $qrCode->setSize(300);
    //---ESCRIBIMOS
    $image= $qrCode->writeString();//Salida en formato de texto 
    //---Convertimos a BASE 64 la imagen creada
    //$imageData = base64_encode($image);
    //---Declaramos la ruta de COPIADO
    $rutaImagenSalidaQR = "../../../public/imageQR/" . $nombreImagen;
    //---Decodificacion de la imagen
    //$imagenQrBase = base64_decode($imageData);
    //---Copiamos de 
    $rutaQRFinal = file_put_contents($rutaImagenSalidaQR,$image );
    //---Direccion de Imagen Final-----------
    $direccionImageQR = IP_SERVER . 'inventario-servidor/servidor/public/imageQR/' . $nombreImagen;

    // las vairables de imagen seran consideradas en PNG
    $direccionLugar = IP_SERVER . 'inventario-servidor/servidor/public/place/' . $lugar . '.png'; 

    //CREAMOS los resultados en las variables
    $consulta = petitionCreate::inscribirObjeto($code, $cifra, $nombre, $direccionLugar, $costo, $anio, $estado, $direccionImage, $direccionImageQR, $descripcion );
    //Verifiacion de los DATOS
    if($consulta === true) {
        echo json_encode(array('response' => 'correcto'));
    }else{
        echo json_encode(array('response' => 'incorrecto'));
    }
}else{
    echo json_encode(array('response' => 'duplicado'));
};


?>