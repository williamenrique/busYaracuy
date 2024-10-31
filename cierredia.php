<?php

	require  './ticket/autoload.php';
	require  './ticket/autoload.php';
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\EscposImage;
	use Mike42\Escpos\PrintConnectors\FilePrintConnector;
	use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
	$connector = new WindowsPrintConnector("HPRT MPT-II");
	$printer = new Printer($connector);
	$decoded_json = json_decode($_POST['dataTicket'], true);
	foreach($decoded_json as $key => $value) {
		if($decoded_json[$key]["tipo_vehiculo_ticket"] == 1){
			$carro = $decoded_json[$key]["CANT"]. ' Carro '.$decoded_json[$key]["MONTO"].'LTS';  
		}
		if($decoded_json[$key]["tipo_vehiculo_ticket"] == 2){
			$camion = $decoded_json[$key]["CANT"]. ' Camion '.$decoded_json[$key]["MONTO"].'LTS';  
		}
		if($decoded_json[$key]["tipo_vehiculo_ticket"] == 3){
			$moto = $decoded_json[$key]["CANT"]. ' Moto '.$decoded_json[$key]["MONTO"].'LTS';  
		}
		if($decoded_json[$key]["tipo_vehiculo_ticket"] == 4){
			$divisa = $decoded_json[$key]["CANT"]. ' Divisa '.$decoded_json[$key]["MONTO"].'$';  
		}
		if($decoded_json[$key]["tipo_vehiculo_ticket"] == 5){
			$efectivo = $decoded_json[$key]["CANT"]. ' Efectivo '.round($decoded_json[$key]["MONTO"],2).'Bs';  
		}
		if($decoded_json[$key]["tipo_vehiculo_ticket"] == 6){
			$punto = $decoded_json[$key]["CANT"]. ' Punto de venta '.round($decoded_json[$key]["MONTO"],2).'Bs';  
		}
	}
	$printer->text("" . "\n");
	$printer->setTextSize(1, 1);
	$printer->text("Cierre del dia : ".$decoded_json[$key]["fecha"] . "\n");
	$printer->text("Tasa del dia : ".$decoded_json[$key]["tasa"]."Bs\n");
	$printer ->text("E/S TACHIRA\n");
	$printer ->text("Servicio Socialista de\n");
	$printer ->text("Abastecimiento del Edo Yaracuy\n");
	$printer->text("Vehiculos atendidos\n");
	(isset($carro)) ? $printer->text($carro. "\n") : 'no existe';
	(isset($camion)) ? $printer->text($camion. "\n") : 'no existe';
	(isset($moto)) ? $printer->text($moto. "\n") : 'no existe';
	$printer->text("Formas de pago\n");
	(isset($divisa)) ? $printer->text($divisa. "\n") : 'no existe';
	(isset($efectivo)) ? $printer->text($efectivo. "\n") : 'no existe';
	(isset($punto)) ? $printer->text($punto. "\n") : 'no existe';
	$printer->text("" . "\n");
	$printer->text("*****************************");
	$printer->feed(4);
	$printer -> close();