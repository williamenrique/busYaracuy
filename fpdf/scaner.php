<?php
require "./scaner_plantilla.php";
$pdf = new PDF("P", "mm", "letter");
$scaner = $pdf->LoadData("../data/scaner.txt");

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(20);

$pdf->SetFont('Arial','B',16);   
$pdf->Text(70,38, utf8_decode('REGISTRO SCANER'));

// foreach($infoDesp as $rowInfo)
// //información de # de factura
// $pdf->SetFont('Arial','B',10);   
// $pdf->Text(150,50, utf8_decode('COD DESPACHO N°: '.$rowInfo[0]));

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->Text(20,50, utf8_decode('FECHA: '.date('d-m-y')));
$pdf->SetFont('Arial','',10);    

$pdf->Ln(45);
$pdf->setX(200);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$moverXtabla = 20;
$pdf->SetX($moverXtabla);
$header = array('UNIDAD', 'FECHA', 'DESCRIPCION');
// Column widths
$w = array(20, 55, 110);
// Header
for($i=0; $i < count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
//Aqui inicia el for con todos los productos
foreach($scaner as $row){
    $pdf->SetX($moverXtabla);
    $pdf->Cell($w[0],6,$row[0],1,0,'L',0);
    $pdf->Cell($w[1],6,utf8_decode($row[1]),'LRTB');
    $pdf->Cell($w[2],6,utf8_decode($row[2]),1,0,'L',0);
    $pdf->Ln();
    $pdf->SetX($moverXtabla);
}
$pdf->Output('I', 'Rep_Scaner_'.date('y-m-d').'.pdf');