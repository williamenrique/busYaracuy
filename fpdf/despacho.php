<?php
require "./despacho_plantilla.php";
$pdf = new PDF("P", "mm", "letter");
$artDesp = $pdf->LoadData("../data/reporteDesp.txt");
$infoDesp = $pdf->LoadData("../data/infoDesp.txt");

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);

$pdf->SetFont('Arial','B',16);   
$pdf->Text(70,38, utf8_decode('ORDEN DE DESPACHO'));

foreach($infoDesp as $rowInfo)
//información de # de factura
$pdf->SetFont('Arial','B',10);   
$pdf->Text(150,50, utf8_decode('COD DESPACHO N°: '.$rowInfo[0]));

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->Text(20,50, utf8_decode('FECHA: '.$rowInfo[2]));
$pdf->SetFont('Arial','',10);    
//  $pdf->Text(25,48, date('d/m/Y'));

// Agregamos los datos de la factura
$pdf->SetFont('Arial','',10);    
$pdf->Text(20,56, utf8_decode('MODELO: '. $rowInfo[3] . '  MARCA: '. $rowInfo[4]. '  UNIDAD: '. $rowInfo[1]));
$pdf->Text(20,61, utf8_decode('COMBUSTIBLE: ' . $rowInfo[5] .'  TRANSMISION: '. $rowInfo[6] ));
$pdf->Text(20,66, utf8_decode('MECANICO: ' . $rowInfo[7] .'  OPERADOR: '. $rowInfo[8] ));
$pdf->Text(20,71, utf8_decode('DESPACHADO POR: ' . $rowInfo[9]));
//  $pdf->Text(25,54, 'Mikasa Akerman');
$pdf->Ln(65);
$pdf->setX(200);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$moverXtabla = 20;
$pdf->SetX($moverXtabla);
$header = array('COD', 'DESCRIPCION', 'CANT');
// Column widths
$w = array(20, 120, 20);
// Header
for($i=0; $i < count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
//Aqui inicia el for con todos los productos
foreach($artDesp as $row){
    $pdf->SetX($moverXtabla);
    $pdf->Cell($w[0],6,$row[0],1,0,'C',0);
    $pdf->Cell($w[1],6,$row[1].' '.$row[2],'LRTB');
    $pdf->Cell($w[2],6,$row[3],1,0,'C',0);
    $pdf->Ln();
    $pdf->SetX($moverXtabla);
}
//// Apartir de aqui esta la tabla con los subtotales y totales
$pdf->Ln(10);
$pdf->setX(20);
$pdf->Cell(40,6,'OBSERVACION: '.$rowInfo[10],0,0);
$pdf->Cell(60,6,'','0',1);
$pdf->setX(20);
$pdf->Cell(40,6,'RESPONSABLE: '.$rowInfo[11],0,0);
$pdf->Cell(60,6, '','0',1);
// $pdf->Output();
// $pdf->Cell(array_sum($w),0,'','T');
$pdf->Output('I', 'DESPACHO-COD('.$rowInfo[0].')_'.date('y-m-d').'.pdf');