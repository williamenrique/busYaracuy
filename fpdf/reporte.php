<?php
require "./plantilla.php";
// $nombreGrado = $row_grado['grado'];
$tituloReporte = "Reporte Abastecimiento";
$pdf = new PDF("P", "mm", "letter");
$data = $pdf->LoadData("../data/reporte.txt");
// $pdf->SetTitle($tituloReporte);
$pdf->AliasNbPages();
$pdf->SetMargins(10, 25, 10);
$pdf->AddPage();
$moverXtabla = 40;
// $pdf->SetXY(30,50);
$pdf->SetFont("Arial", "B", 9);
// $pdf->Cell(10, 5, "Id", 1, 0, "C");
// $pdf->Cell(40, 5, "Nombre", 1, 0, "C");
// $pdf->Cell(20, 5, "Edad", 1, 0, "C");
// $pdf->Cell(40, 5, "Matricula", 1, 0, "C");
// $pdf->Cell(30, 5, "Grado", 1, 0, "C");
// $pdf->Cell(50, 5, "Correo", 1, 1, "C");
// $header = array('ID', 'FECHA','ES','TICKET', 'VEHICULO','LITRAJE','DIVISA','EFECTIVO','PUNTO');
$pdf->SetX($moverXtabla);
$header = array('ID', 'TICKET', 'VEHICULO','LITRAJE','DIVISA','EFECTIVO','PUNTO');
// Column widths
// $w = array(10, 20, 20, 20, 30,20,20,20,20);
$w = array(10, 20, 30,20,20,20,20);
// Header
for($i=0; $i < count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();

foreach($data as $row){
    $pdf->SetX($moverXtabla);
    $pdf->Cell($w[0],6,$row[0],'LRTB');
    $pdf->Cell($w[1],6,$row[1],'LRTB');
    $pdf->Cell($w[2],6,$row[2],'LRTB');
    $pdf->Cell($w[3],6,$row[3],'LRTB');
    $pdf->Cell($w[4],6,$row[4],'LRTB');
    $pdf->Cell($w[5],6,$row[5],'LRTB');
    $pdf->Cell($w[6],6,$row[6],'LRTB');
    $pdf->Ln();
    $pdf->SetX($moverXtabla);
}
// foreach($data as $row){
//     $pdf->Cell($w[0],6,$row[0],'LRTB');
//     $pdf->Cell($w[1],6,date('d-m-y'),'LRTB');
//     $pdf->Cell($w[2],6,'E/S Tachira','LRTB');
//     $pdf->Cell($w[3],6,$row[1],'LRTB');
//     $pdf->Cell($w[4],6,$row[2],'LRTB');
//     $pdf->Cell($w[5],6,$row[3],'LRTB');
//     $pdf->Cell($w[6],6,$row[4],'LRTB');
//     $pdf->Cell($w[7],6,$row[5],'LRTB');
//     $pdf->Cell($w[8],6,$row[6],'LRTB');
//     $pdf->Ln();
// }
// Closing line
$pdf->Cell(array_sum($w),0,'','T');
$pdf->Output('I', $tituloReporte .date('y-m-d').'.pdf');