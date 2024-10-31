<?php
	require  './ticket/autoload.php';
	require  './ticket/autoload.php';
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\EscposImage;
	use Mike42\Escpos\PrintConnectors\FilePrintConnector;
	use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
	$connector = new WindowsPrintConnector("HPRT MPT-II");
	$printer = new Printer($connector);
		if(isset($_POST)){
			$dataTicket = json_decode($_POST['dataTicket'], true);
			$placaVehiculo = $dataTicket['srtPlaca'] == "" ? "N/A" : $dataTicket['srtPlaca'];
			$tipoPago = ($dataTicket['srtListTipoPago'] == 4) ? "Divisa ".$dataTicket['srtMonto'].'$' : (($dataTicket['srtListTipoPago'] == 5) ? "Efectivo ".$dataTicket['srtMonto'].'Bs' : "Punto de venta ".$dataTicket['srtMonto'].'Bs');
			$tipoVehiculo = ($dataTicket['srtListTipoVehiculo'] == 1) ? "Carro" : (($dataTicket['srtListTipoVehiculo'] == 2) ? "Camion" : "Moto");
				$printer->setTextSize(2, 2);
				$printer -> text("Ticket N" ." ". $dataTicket['intTicket'] ."\n");
				$printer->feed(1);
				$printer->setTextSize(1, 1);
				$printer -> text("E/S TACHIRA\n");
				$printer -> text("Servicio Socialista de\n");
				$printer -> text("Abastecimiento del Edo Yaracuy\n");
				$printer->text($dataTicket['srtFecha'] ." - ". $dataTicket['srtHora'] . "\n");
				$printer->text("Operador : " .$dataTicket['srtNombreOperador']  . "\n");
				$printer->text("Cliente : " .$dataTicket['srtNombre']  . "\n");
				$printer->text("CI :". $dataTicket['srtCI'] . "\n");
				$printer->text("Vehiculo :" . $tipoVehiculo . "\n");
				$printer->text("Placa :" . $dataTicket['srtPlaca'] . "\n");
				$printer->text("Pago :" . $tipoPago . "\n");
				$printer->text("" . "\n");
				$printer->setTextSize(2, 2);
				$printer->setJustification(Printer::JUSTIFY_CENTER);
				$printer->text("    ".$dataTicket['srtLTS'] . "LTS\n");
				$printer->text("" . "\n");
				$printer->setTextSize(1, 1);
				$printer->text("FUE UN PLACER ATENDERLE\n");
				$printer->text("*****************************");
				$printer->feed(5);
				$printer -> close();
	}