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
    // Cabecera de página
    function Header(){
        global $nombreGrado;
        global $tituloReporte;
        // Logo
        // $this->Image("images/logo.png", 10, 5, 13);
        // Arial bold 15
        $this->SetFont("Arial", "B", 12);
        // Título
        $this->Cell(25);
        // $this->Cell(140, 5,  mb_convert_encoding($tituloReporte, 'ISO-8859-1', 'UTF-8'), 0, 0, "C");
        $this->Cell(140, 5,  mb_convert_encoding('SERVICIO SOCIALISTA DE ABASTECIMIENTO DEL ESTADO YARACUY', 'ISO-8859-1', 'UTF-8'), 0, 1, "C");
        //Fecha
        $this->SetFont("Arial", "", 9);
        // $this->Cell(0, 5, "E/S Tachira" . $nombreGrado, 0, 1, "C");
        $this->Cell(0, 5, "LIBRO DE VENTAS GASOLINA", 0, 1, "C");
        $this->Cell(0, 5, "E/S Tachira", 0, 1, "C");
        $this->Cell(90, 5, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        // Salto de línea
        $this->Ln(4);
    }
    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}