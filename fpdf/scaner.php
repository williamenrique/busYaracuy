<?php
require './fpdf.php';
class PDF extends FPDF{
    function LoadData($file)    {
        // Read file lines
          $lines = file($file);
          $data = array();
          foreach($lines as $line)
              $data[] = explode(';',trim($line));
          return $data;
      }
    function Header(){
        $this->SetFont('Times','B',20);  
        $this->Image('../src/img/logo_busyaracuy.png',10,8,35);    
        $this->SetFont('times', 'B', 12);   
        $this->Text(52, 12, utf8_decode('SERVICIO SOCIALISTA DE LOGISTICA, MANTENIMIENTO '),0, 1, "J");
        $this->Text(65, 18, utf8_decode('Y TRANSPORTE DEL ESTADO YARACUY'),0, 1, "J");
        $this->SetFont('Arial','B',16);   
        $this->Text(70,38, utf8_decode('REGISTRO SCANER')); 
        // $this->Image('../src/img/logo_busyaracuy.png',160,5,33);
        $this->SetFont('Arial','B',10);    
        $this->Text(20,50, utf8_decode('FECHA: '.date('d-m-y')));
        $this->SetFont('Arial','',10); 
        $this->Ln(45);
       
    }
    function Footer(){
        $this->SetFont('courier', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        // $this->Cell(95,5, date("F j, Y, g:i a") ,00,1,'R');
        $this->Cell(95,5,date('d/m/Y') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("SSLMTY © Todos los derechos reservados."),0,0,"C"); 
               
    }
}

// Creación del objeto de la clase heredada
// $pdf = new PDF("P", "mm", "letter");
$pdf = new PDF();
$scaner = $pdf->LoadData("../data/scaner.txt");

$pdf->AliasNbPages();
$pdf->AddPage();//añade l apagina / en blanco
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true,20);//salto de pagina automatico

$pdf->SetX(15);
$pdf->SetFont('Arial','B',10);
$moverXtabla = 10;
$pdf->SetX($moverXtabla);
$header = array('UNIDAD', 'FECHA', 'DESCRIPCION');
// Column widths
$w = array(20, 55, 120);
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