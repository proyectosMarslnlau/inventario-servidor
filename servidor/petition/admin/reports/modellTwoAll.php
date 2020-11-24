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
   
    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(3, 3, 3); //Letra color blanco
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(85, 5, utf8_decode ('Cód.'), 1,0,'C','R');

    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(3, 3, 3); //Letra color blanco
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(55, 5, utf8_decode ('Lugar.'), 1,0,'C','R');

    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(3, 3, 3); //Letra color blanco
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(55, 5, utf8_decode ('QR.'), 1,0,'C','R');


    $pdf->Ln(6);
    $pdf->Cell(55,55, $pdf->Image('../../../public/imageQR/'. $qr1, $pdf->GetX()+140, $pdf->GetY(),55),12);
    $pdf->Cell(55,55, $pdf->Image('../../../public/place/' . $imagen1, $pdf->GetX()+30, $pdf->GetY(),55),120);
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(85, 6, 'ID : '. $value['iddatos'] , 1, 2);
    $pdf->Cell(85, 6, 'CODIGO : '. $value['code']. $value['cifra'], 1, 2);
    $pdf->Cell(85, 6, 'NOMBRE : '. $value['nombre'], 1, 2);
    $pdf->Cell(85, 6, 'ESTADO : '. $value['estado'], 1, 2);
    $pdf->Cell(85, 6, 'LUGAR : '. $lugarDescripcion, 1, 2);
    $pdf->Cell(85, 6, 'COSTO : '. $value['costo'], 1, 2);
    $pdf->MultiCell(85, 17,  'OBSERVACIONES : '. $value['descripcion'], 1, 2);
    $pdf->Ln(10);
    
    if($contador === 3){
        $pdf->AddPage();
        $pdf->Ln(10);
        $contador = 0;
    }
    
}
//echo json_encode($var2);

$pdf->Output('', 'modellTwo.pdf');

?>