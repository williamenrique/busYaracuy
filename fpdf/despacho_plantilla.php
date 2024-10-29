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

        $this->setY(12);
        $this->setX(10);
        
        $this->Image('../src/img/logo_busyaracuy.png',10,8,35);
        
        $this->SetFont('times', 'B', 12);
        
        $this->Text(52, 12, utf8_decode('SERVICIO SOCIALISTA DE LOGISTICA, MANTENIMIENTO '),0, 1, "J");
        $this->Text(65, 18, utf8_decode('Y TRANSPORTE DEL ESTADO YARACUY'),0, 1, "J");
        
        // $this->Text(77, 21, utf8_decode('6ª av. Los Angeles, California'));
        // $this->Text(88,27, utf8_decode('Tel: 7785-8223'));
        // $this->Text(78,33, utf8_decode('noexisteelemail@gamail.com'));
        
        // $this->Image('../src/img/logo_busyaracuy.png',160,5,33);
       
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

