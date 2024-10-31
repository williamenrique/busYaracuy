<?php
header('Access-Control-Allow-Origin: *');
class Estacion extends Controllers{

	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'login');
		}
		parent::__construct();
	}
	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function estacion(){
		$data['page_tag'] = "E/S";
		$data['page_title'] = "E/S";
		$data['page_name'] = "E/S";
		$data['page_link'] = "active-estacion";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-estacion";//abrir el desplegable
		$data['page_link_acitvo'] = "link-estacion";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.estacion.js";
		$this->views->getViews($this, "estacion", $data);
	}
	// hacer una venta e imprimir
	public function setVenta(){
		$txtNombre = strtoupper($_POST['txtNombre']);
		$txtCI = $_POST['txtCI'];
		$txtListTipoVehiculo = $_POST['txtListTipoVehiculo'];
		$txtLTS = $_POST['txtLTS'];
		$txtListTipoPago = $_POST['txtListTipoPago'];
		$txtFecha = $_POST['txtFecha'];
		$txtHora = $_POST['txtHora'];
		$txtMonto = $_POST['txtMonto'];
		$txtTasa = $_POST['txtTasa'];
		$txtPlaca = $_POST['txtPlaca'] == "" ? "N/A" : strtoupper($_POST['txtPlaca']);
		if($txtNombre == "" || $txtCI == "" || $txtLTS == "" || $txtListTipoVehiculo == 0 || $txtListTipoPago == 0 || $txtMonto == ""){
			$arrResponse = array('status'=> false,'msg' => '¡Atención debe llenar los campos.');
		}else{
			$requestInsert = $this->model->setVenta($_SESSION['userData']['user_id'],$txtNombre,$txtCI,$txtListTipoVehiculo,$txtLTS,$txtListTipoPago,$txtFecha,$txtHora,$txtMonto,$txtPlaca,$txtTasa);
			if($requestInsert > 0){
				$arrResponse = array('status'=> true,'msg' => '¡Venta efectuada con el numero '.$requestInsert, 'nTicket' =>$requestInsert);
				
			}else{
				$arrResponse = array('status'=> false,'msg' => '¡Ah ocurrido un error');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	//obtener ultimos tickets del dia
	public function getLastTicket(){
		$arrData = $this->model->getLastTicket($_SESSION['userData']['user_id'],date('d-m-y'));
		$html = '';
			for ($i=0; $i < count($arrData); $i++) {
				$arrData[$i]['ticket'] = '
					<a href="#" class="" onclick="fntTicket('.$arrData[$i]['id_ticket_venta'].')"><span class="text-bold">N° '.$arrData[$i]['id_ticket_venta'].'</span>   '.$arrData[$i]['fecha_ticket'].' - '.$arrData[$i]['hora_ticket'].'  <strong>'.$arrData[$i]['lts_ticket'].'LTS</strong></a><br>
				';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		
	}
	// obtener un ticket para imprimirlo
	public function getTicket(int $intIdTicket){
		$arrData = $this->model->getTicket($intIdTicket);
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	// actualizar tasa en dolar del dia
	public function updateTasa(float $intTasa){
		$requestUpdate = $this->model->updateTasa($intTasa);
		if($requestUpdate > 0){
			$arrResponse = array("status" => true, "msg" => "Tasa actualizada");
		}else{
			$arrResponse = array("status" => false, "msg" => "No es posible actualizar");
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	// obtener tasa en dolaeres del dia
	public function getTasa(){
		$requestUpdate = $this->model->getTasa();
		echo json_encode($requestUpdate,JSON_UNESCAPED_UNICODE);
		die();
	}
	// obtener detalle y cargarlo en una lista detallada
	public function getDetail(){
		$htmlOptions = "";
		$arrData = $this->model->getDetail($_SESSION['userData']['user_id'],date('d-m-y'));
		$arrDataP = $this->model->getDetailP($_SESSION['userData']['user_id'],date('d-m-y'));
		if(empty($arrData)){
			$htmlOptions .= '<strong>No existen registros</strong>';
			$htmlOptions .= '<hr>';
		}else{
			$htmlOptions .= '<ul>';
			$htmlOptions .= '<strong>Vehiculos</strong>';
			for ($i=0; $i < count($arrData); $i++) {
				$tipo = $arrData[$i]['tipo_vehiculo_ticket'] == 1 ?	'Carro' : ($arrData[$i]['tipo_vehiculo_ticket'] == 2 ? 'Camion' : 'Moto');
				$htmlOptions .= '<li style="display: flex; width: 20%;justify-content: space-between"> <span>'.$arrData[$i]['cant_vehiculo']. ' '. $tipo .' </span> <span><strong>'. $arrData[$i]['cant_lts']. '</strong>LTS</span></li>';
			}
			$htmlOptions .= '<strong>Montos</strong>';
			for ($j=0; $j < count($arrDataP); $j++) {
				// $tipoP = $arrDataP[$j]['tipo_pago_ticket'] == 4 ?	'Divisa '.$arrDataP[$j]['cant_venta'].'$' : ($arrDataP[$j]['tipo_pago_ticket'] == 5 ?	'Efectivo ' . round($arrDataP[$j]['cant_venta'],2).'Bs' : 'Punto de venta '.round($arrDataP[$j]['cant_venta'],2).'Bs');
				$tipoPago = $arrDataP[$j]['tipo_pago_ticket'] == 4 ?	'Divisa ' : ($arrDataP[$j]['tipo_pago_ticket'] == 5 ?	'Efectivo ' : 'Punto de venta');

				$montoPago = $arrDataP[$j]['tipo_pago_ticket'] == 4 ? $arrDataP[$j]['cant_venta'].'$' : ($arrDataP[$j]['tipo_pago_ticket'] == 5 ? round($arrDataP[$j]['cant_venta'],2).'Bs' : round($arrDataP[$j]['cant_venta'],2).'Bs');
				$htmlOptions .= '<li style="display: flex; width: 20%;justify-content: space-between"><span>'.$tipoPago. '</span><span><strong> '.$montoPago.' </strong></span></li>';
			}
			$htmlOptions .= '</ul>';
			$htmlOptions .= '<button type="button" class="btn btn-primary" onclick="fntCierre()">Cerrar dia</button>';
		}
		echo $htmlOptions;
		die();
	}
	// boton cerrar el dia actual
	public function cierreDia(){
		$request = $this->model->cierreDia($_SESSION['userData']['user_id'],date('d-m-y'));
		if($request){
			// obtener data para imprimir el cierre
			$arrData = $this->model->getCierre($_SESSION['userData']['user_id'],date('d-m-y'));
			// $dataCierre = $this->model->setCierre($arrData);
			$arrResponse = array("status" => true, "msg" => "Cierre completo", "dataCierre" => $arrData);
		}else{
			$arrResponse = array("status" => false, "msg" => "Error al cerrar");
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	// verificar y obtener si hay algun cierre pendiente
	public function cierreP(){
		$request = $this->model->cierreP($_SESSION['userData']['user_id'],date('d-m-y'));
		$htmlOptions = "";
		if($request > 0){
			$htmlOptions = '
						<div class="card">
							<div class="card-header">
								<h4>Cierres pendientes</h4>
							</div>
							<div class="card-body">
			';
			for ($i=0; $i < count($request); $i++) {
				$fecha = "'{$request[$i]['fecha_ticket']}'";
				$htmlOptions .= '
					<a href="javascript:;" class="" onclick="fntCierreP('.$fecha.')"><span class="text-bold">N° '.$request[$i]['fecha_ticket'].'</span></strong></a><br>
				';
			}

			$htmlOptions .= '
												</div>
											</div>
										';
		}else{
			$htmlOptions = '';
		}
		echo $htmlOptions;
		die();
	}
	// hacer el cierre dantrior osea uno resagado y mandar a imprimir
	public function cierrePendiente(string $txtFecha){
		$request = $this->model->cierreDia($_SESSION['userData']['user_id'],$txtFecha);
		if($request){
			// obtener data para imprimir el cierre
			$arrData = $this->model->getCierre($_SESSION['userData']['user_id'],$txtFecha);
			$arrResponse = array("status" => true, "msg" => "Cierre completo", "dataCierre" => $arrData);
		}else{
			$arrResponse = array("status" => false, "msg" => "Cierre completo");
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	// TODO: generar archivo para el reporte en pdf
	public function reportePdf(string $srtDate){
		$request = $this->model->getTickets($srtDate);
		$requestMonto = $this->model->getTicketsMonto($srtDate,$_SESSION['userData']['user_id']);
		$file = (file_exists('./data/reporte.txt') ? unlink('./data/reporte.txt') : fopen("./data/reporte.txt", "w"));
		// fwrite($file," vacio". PHP_EOL);
		$file = fopen("./data/reporte.txt", "a");
		for ($i=0; $i < count($request); $i++) {
			$cont = $i+1;
			$vehiculo = ($request[$i]['tipo_vehiculo_ticket'] == 1 ? "CARRO" : ($request[$i]['tipo_vehiculo_ticket'] == 2 ? "CAMION" : "MOTO"));
			$divisa = ($request[$i]['tipo_pago_ticket'] == 4 ? $request[$i]['monto_ticket'].'$' : "");
			$efectivo = ($request[$i]['tipo_pago_ticket'] == 5 ? $request[$i]['monto_ticket'].'Bs' : "");
			$punto = ($request[$i]['tipo_pago_ticket'] == 6 ? $request[$i]['monto_ticket'].'Bs' : "");

			fwrite($file, 
				$cont.';'
				.$request[$i]['id_ticket_venta'].';'
				.$vehiculo.';'
				.$request[$i]['lts_ticket'].';'
				.$divisa.';'
				.$efectivo.';'
				.$punto. PHP_EOL);
		}
		$dataTotal = $this->model->getTotal($srtDate);
		$divisa = $dataTotal['divisa']['divisa'];
		$efectivo = $dataTotal['efectivo']['efectivo'];
		$punto = $dataTotal['punto']['punto'];
		$lts = $dataTotal['lts']['lts'];
		fwrite($file,';'.';'.'TOTALES;'.$lts.';'.$divisa.'$;'.$efectivo.'BS;'.$punto.'Bs' .PHP_EOL);
		fclose($file);
	}
}