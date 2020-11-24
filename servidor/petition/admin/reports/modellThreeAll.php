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
$var2 = [];

$pdf = new Fpdf('P', 'mm', 'letter'); //para que la hoja sea tipo carta
$pdf->AddPage('P','letter'); //para que la hoja sea tipo carta
$pdf->Ln(10);
$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(3, 3, 3); //Letra color blanco
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(45, 5, utf8_decode ('Codigo'), 1,0,'C','R');

$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(3, 3, 3); //Letra color blanco
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(95, 5, utf8_decode ('Nombre'), 1,0,'C','R');

$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(3, 3, 3); //Letra color blanco
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(55, 5, utf8_decode ('Costo'), 1,0,'C','R');
$contador = 0;


foreach ($consulta as $value) {
    $contador ++;
    //Extraemos los valores de las cuentas LUGAR y QR
    $imagen1 = $value['lugar'];
    $qr1 = $value['qr'];

    //Extraemos la variable SPLIT de SLASH para LUGAR 1
    $imagen1 = explode('/', $imagen1);
    $lugarDescripcion = explode('.', $imagen1[7]);

    $imagen1 = $imagen1[7];
    
    $lugarDescripcion = $lugarDescripcion[0];
    //Extremos los nombres de los QR 1
    $qr1 = explode('/', $qr1);
    $qr1 = $qr1[7];
    //-------------------------------------------
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(45, 6, $value['code']. $value['cifra'] , 1, 0);
    $pdf->Cell(95, 6, $value['nombre'], 1, 0);
    $pdf->Cell(55, 6, $value['costo'], 1, 0);
    $pdf->Ln(1);
}
//echo json_encode($var2);
$pdf->Output('', 'modellThree.pdf');

?>