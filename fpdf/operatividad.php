<?php
sleep(1);
require "./operatividad_plantilla.php";
$pdf = new PDF("P", "mm", "letter");
$operatividad = $pdf->LoadData("../data/operatividad.txt");
$infoOperaividad = $pdf->LoadData("../data/infoOperatividad.txt");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);

$pdf->SetFont('Arial','B',16);   
$pdf->Text(70,38, utf8_decode('OPERATIVIDAD'));


// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->Text(10,50, utf8_decode('FECHA: '.date('d-m-y')));

foreach($infoOperaividad as $rowInfo)
$pdf->SetFont('Arial','B',10);
$pdf->Text(10,55, utf8_decode('OPERATIVO '));
$pdf->Text(40,55, $rowInfo[1]);
$pdf->Text(10,60, utf8_decode('INOPERATIVO '));
$pdf->Text(40,60, $rowInfo[3]);
$pdf->Text(10,65, utf8_decode('CRITICA '));
$pdf->Text(40,65, $rowInfo[4]);
$pdf->Text(10,70, utf8_decode('TOTAL FLOTA '));
$pdf->Text(40,70, $rowInfo[0]);
$pdf->Ln(65);
$pdf->setX(200);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$moverXtabla = 5;
$pdf->SetX($moverXtabla);
$header = array('MODELO', 'TRANSMISION', 'COMBUSTIBLE','CANT','OPERATIVO','INOPERATIVA','CRITICA');
// Column widths
$w = array(55,30,30,20,25,25,20);
// Header
for($i=0; $i < count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
//Aqui inicia el for con todos los productos
foreach($operatividad as $row){
    $pdf->SetX($moverXtabla);
    $pdf->Cell($w[0],6,utf8_decode($row[0]),1,0,'L',0);
    $pdf->Cell($w[1],6,utf8_decode($row[1]),'LRTB');
    $pdf->Cell($w[2],6,utf8_decode($row[2]),1,0,'L',0);
    $pdf->Cell($w[3],6,utf8_decode($row[3]),1,0,'L',0);
    $pdf->Cell($w[4],6,utf8_decode($row[4]),1,0,'L',0);
    $pdf->Cell($w[5],6,utf8_decode($row[5]),1,0,'L',0);
    $pdf->Cell($w[6],6,utf8_decode($row[6]),1,0,'L',0);
    $pdf->Ln();
    $pdf->SetX($moverXtabla);
}
$pdf->Output('I', 'Operatividad_'.date('y-m-d').'.pdf');