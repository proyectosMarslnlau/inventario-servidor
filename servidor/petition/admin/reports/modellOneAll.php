<?php
//Invocamos los CORS para no tener problemas de envio de informacion
require_once('../../../services/cors.php');
//Invocamos las funciones de Invocacion de CREATE
require_once('../../class/requestRead.php');
//
use Fpdf\Fpdf;
require_once('../../../vendor/autoload.php');
//Invocamos las CONSTANTES
require_once('../../../sheets/constant.php');  
//-------------------------------------------------------------------------
//Decodificacion de las entradas de USUARIO
header("Content-Type: application/json");
$varEntrada = json_decode(file_get_contents('php://input'), true);

$consulta = petitionRead::consultarTodoObjetos();

$tamanioConsulta = sizeof($consulta);
$var2 = [];
$par = 0;
$routeador = $tamanioConsulta;

if($routeador % 2 === 1){
    $definicion = true;
}else{
    $definicion = false;
}

$pdf = new Fpdf('P', 'mm', 'letter'); //para que la hoja sea tipo carta
$pdf->AddPage('P','letter'); //para que la hoja sea tipo carta
$pdf->Ln(6);
for ($i=0; $i < $tamanioConsulta; $i++) { 
    $par ++;
    array_push($var2, $consulta[$i]);
    if($par == 2){
        //Extraemos los valores de las cuentas LUGAR y QR
        $lugar1 = $var2[0]['lugar'];
        $lugar2 = $var2[1]['lugar'];
        $qr1 = $var2[0]['qr'];
        $qr2 = $var2[1]['qr'];
        //Extraemos la variable SPLIT de SLASH para LUGAR 1
        $lugar1 = explode('/', $lugar1);
        $lugar1 = explode('.', $lugar1[7]);
        $lugar1 = $lugar1[0];
        //Extraemos la variable SPLIT de SLASH para LUGAR 1
        $lugar2 = explode('/', $lugar2);
        $lugar2 = explode('.', $lugar2[7]);
        $lugar2 = $lugar2[0];
        //Extremos los nombres de los QR 1
        $qr1 = explode('/', $qr1);
        $qr1 = $qr1[7];
        //Extraemos los nombres de los QR 2
        $qr2 = explode('/', $qr2);
        $qr2 = $qr2[7];
        //--------------------------------------------------------
        //Imprimimos los TITULOS  de las TABLAS
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(72, 5, utf8_decode ('Descripción.'), 1,0,'C','R');
        //-----------
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode ('QR.'), 1,0,'C','R');
        //-----------
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(72, 5, utf8_decode ('Descripción.'), 1,0,'C','R');
        //-----------
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode ('QR.'), 1,0,'C','R');
        //
        //Variables de las TABLAS 
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(97, 4, 'Id : ' . $var2[0]['iddatos'], 1, 0);
        $pdf->Cell(97, 4, 'Id : ' . $var2[1]['iddatos'], 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'CODIGO : ' . $var2[0]['code'].$var2[0]['cifra'], 1, 0);
        $pdf->Cell(97, 4, 'CODIGO : ' . $var2[1]['code'].$var2[0]['cifra'], 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'NOMBRE : ' . $var2[0]['nombre'], 1, 0);
        $pdf->Cell(97, 4, 'NOMBRE : ' . $var2[1]['nombre'], 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'ESTADO : ' . $var2[0]['estado'], 1, 0);
        $pdf->Cell(97, 4, 'ESTADO : ' . $var2[1]['estado'], 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'LUGAR : ' . $lugar1, 1, 0);
        $pdf->Cell(97, 4, 'LUGAR : ' . $lugar2, 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, '*********', 1, 0);
        $pdf->Cell(97, 4, '*********', 1, 0);
        $pdf->Ln(4);

        $pdf->Cell(15,15, $pdf->Image('../../../public/imageQR/' . $qr1, $pdf->GetX()+71, $pdf->GetY()-24,25),2);
        $pdf->Cell(15,15, $pdf->Image('../../../public/imageQR/' . $qr2, $pdf->GetX()+153, $pdf->GetY()-24,25),2);
        $pdf->Ln(4);

        $par = 0;
        $var2=[];
        
    }
    $routeador--;
    if($definicion === true && $routeador === 0){
        //Desgloce de las variables IMPARES de LUGAR y QR
        $lugar1 = $var2[0]['lugar'];
        $qr1 = $var2[0]['qr'];
        //Desgloce de LUGAR 1
        $lugar1 = explode('/', $lugar1);
        $lugar1 = explode('.', $lugar1[7]);
        $lugar1 = $lugar1[0];
        //Lugar 2 DEFAULT
        $lugar2 = 'DEFAULT';
        //Desglozamos el nombre de QR
        $qr1 = explode('/', $qr1);
        $qr1 = $qr1[7];
        //QR 2 DEFAULT
        $qr2 = 'DEFAULT';
        //--------------------------------------------------------
        //Imprimimos los TITULOS  de las TABLAS
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(72, 5, utf8_decode ('Descripción.'), 1,0,'C','R');
     
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode ('QR.'), 1,0,'C','R');
        //-----------
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(72, 5, utf8_decode ('Descripción.'), 1,0,'C','R');
     
        $pdf->SetFillColor(2,157,116);//Fondo verde de celda
        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode ('QR.'), 1,0,'C','R');
        //
        //Variables de las TABLAS 
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(97, 4, 'Id : ' . $var2[0]['iddatos'], 1, 0);
        $pdf->Cell(97, 4, 'Id : ' , 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'CODIGO : ' . $var2[0]['code']. $var2[0]['cifra'], 1, 0);
        $pdf->Cell(97, 4, 'CODIGO : ', 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'NOMBRE : ' . $var2[0]['nombre'], 1, 0);
        $pdf->Cell(97, 4, 'NOMBRE : ', 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'ESTADO : ' . $var2[0]['estado'], 1, 0);
        $pdf->Cell(97, 4, 'ESTADO : ' , 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, 'LUGAR : ' . $lugar1, 1, 0);
        $pdf->Cell(97, 4, 'LUGAR : ' . $lugar2, 1, 0);
    
        $pdf->Ln(4);
        $pdf->Cell(97, 4, '*********', 1, 0);
        $pdf->Cell(97, 4, '*********', 1, 0);
        
        $pdf->Ln(4);
        $pdf->Cell(15,15, $pdf->Image('../../../public/imageQR/' . $qr1, $pdf->GetX()+71, $pdf->GetY()-24,25),2);
        $pdf->Cell(15,15, $pdf->Image('../../../public/imageQR/default.png', $pdf->GetX()+153, $pdf->GetY()-24,25),2);
        $pdf->Ln(4);
    }
    if( $i === 13){
        $pdf->AddPage();
        $pdf->Ln(6);
        $contador = 0;
    }
}

$pdf->Output('', 'modellOne.pdf');

?>