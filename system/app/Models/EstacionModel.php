<?php
class EstacionModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}
	// generar una venta
	public function setVenta(int $useId, string $txtNombre, string $txtCI, int $txtListTipoVehiculo, string $txtLTS,int $txtListTipoPago,string $txtFecha, string $txtHora, string $txtMonto,string $txtPlaca, string $txtTasa){
		$this->useId = $useId;
		$this->txtNombre = $txtNombre;
		$this->txtCI = $txtCI;
		$this->txtListTipoVehiculo = $txtListTipoVehiculo;
		$this->txtLTS = $txtLTS;
		$this->txtListTipoPago = $txtListTipoPago;
		$this->txtFecha = $txtFecha;
		$this->txtHora = $txtHora;
		$this->txtMonto = $txtMonto;
		$this->txtPlaca = $txtPlaca;
		$this->txtTasa = $txtTasa;
		$sql_insert = "INSERT INTO table_ticket_venta(nombre_ticket, ci_ticket, tipo_vehiculo_ticket,placa_ticket, lts_ticket, tipo_pago_ticket, fecha_ticket, hora_ticket, id_user,status_ticket,monto_ticket,tasa_dia) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
		$arrData = array($this->txtNombre,$this->txtCI,$this->txtListTipoVehiculo,$this->txtPlaca,$this->txtLTS,$this->txtListTipoPago,$this->txtFecha,$this->txtHora,$this->useId,1,$this->txtMonto,$this->txtTasa);
		$request_insert = $this->insert($sql_insert,$arrData);//enviamos el query y el array de datos 
		$return = $request_insert;//retorna el id insertado
		return $return;
	}
	// actualizar la tasa del dolar
	public function updateTasa(float $intTasa){
		$this->intTasa = $intTasa;
		$sql = "UPDATE table_tasa_dia SET tasa_dia = ?";
		$arrData = array($this->intTasa);
		$request = $this->update($sql,$arrData);
		return $request;
	}
	// obtener la tas del dia en dolares
	public function getTasa(){
		$sql = "SELECT * FROM table_tasa_dia";
		$request = $this->select($sql);
		return $request;
	}
	// obterner un alista de ultimos tickets de venta
	public function getLastTicket(int $intIdUser, string $srtDate){
		$this->intIdUser = $intIdUser;
		$this->srtDate = $srtDate;
		$sql = "SELECT * FROM table_ticket_venta WHERE id_user = $this->intIdUser AND fecha_ticket = '$this->srtDate' AND status_ticket = 1  ORDER BY id_ticket_venta DESC ";
		$request = $this->select_all($sql);
		return $request;
	}
	public function getDetail(int $intIdUser, string $srtDate){
		$this->intIdUser = $intIdUser;
		$this->srtDate = $srtDate;
		$sql = "SELECT tipo_vehiculo_ticket,
				COUNT(*) AS cant_vehiculo,
				SUM(monto_ticket) AS cant_venta,
				SUM(lts_ticket) AS cant_lts FROM table_ticket_venta
				WHERE id_user = $this->intIdUser AND fecha_ticket = '$this->srtDate'
				AND status_ticket = 1
				GROUP BY tipo_vehiculo_ticket";
		$request = $this->select_all($sql);
		return $request;
	}
	// funciones para obtener en tale el total 
	public function getDetailP(int $intIdUser, string $srtDate){
		$this->intIdUser = $intIdUser;
		$this->srtDate = $srtDate;
		$sql = "SELECT tipo_pago_ticket, COUNT(*) AS cant_tipo_pago,
				SUM(monto_ticket) AS cant_venta
				FROM table_ticket_venta WHERE id_user = $this->intIdUser AND fecha_ticket = '$this->srtDate' AND status_ticket = 1 GROUP BY tipo_pago_ticket";
		$request = $this->select_all($sql);
		return $request;
	}
	// obtener un ticket para imprimir
	public function getTicket(int $intIdUser){
		$this->intIdUser = $intIdUser;
		$sql = "SELECT ttv.*, tu.* FROM table_ticket_venta ttv INNER JOIN table_user tu ON ttv.id_user = tu.user_id WHERE ttv.id_ticket_venta = $this->intIdUser";
		$request = $this->select($sql);
		return $request;
	}
	// hacer el cierre del dia
	public function cierreDia(int $intIdUser, string $srtDate){	
		$this->intIdUser = $intIdUser;
		$this->srtDate = $srtDate;
		$this->intStatusTicket = 0;
		$sql = "UPDATE table_ticket_venta SET status_ticket = ? WHERE id_user = $this->intIdUser AND fecha_ticket = '$this->srtDate'  AND status_ticket = 1";
		$arrData = array($this->intStatusTicket);
		$request = $this->update($sql,$arrData);
		$requestData = array(true,'data' => 'hola');
		return $requestData;
	}
	// obtener data para imprimir el cierre
	public function getCierre(int $intIdUser, string $srtDate){
		$this->intIdUser = $intIdUser;
		$this->srtDate = $srtDate;
		$sql = "SELECT tipo_vehiculo_ticket, COUNT(*) AS CANT, 
					SUM(lts_ticket) AS MONTO,fecha_ticket AS fecha, tasa_dia AS tasa
					FROM table_ticket_venta WHERE /*id_user = $this->intIdUser AND*/   fecha_ticket = '$this->srtDate'
						/*AND status_ticket = 1*/ GROUP BY tipo_vehiculo_ticket,tasa_dia UNION
				SELECT tipo_pago_ticket, COUNT(*) AS CANT, 
					SUM(monto_ticket) AS MONTO, fecha_ticket AS fecha, tasa_dia AS tasa
					FROM table_ticket_venta WHERE /*id_user = $this->intIdUser AND*/ fecha_ticket = '$this->srtDate' /*AND status_ticket = 1*/ GROUP BY tipo_pago_ticket, tasa_dia";
		$request = $this->select_all($sql);
		if($request){
			$sqlInsert = "";
			$arrData = "";
			$requesInsert = "";
			foreach($request as $data){
				$this->tipo = $data['tipo_vehiculo_ticket'];
				$this->cant = $data['CANT'];
				$this->monto = $data['MONTO'];
				$this->fecha = $data['fecha'];
				$this->tasa = $data['tasa'];
				$this->user = $_SESSION['userData']['user_id'];
				$sqlInsert = "INSERT INTO table_cierre(tipo_cierre,cant_cierre,monto_cierre,tasa_dia,fecha_cierre,id_user)VALUES (?,?,?,?,?,?)";
				$arrData = array($this->tipo,$this->cant,$this->monto,$this->tasa,$this->fecha,$this->user);
				$requesInsert = $this->insert($sqlInsert,$arrData);
			}
		}
		return $request;
	}
	// obtener si existe un cierre pendiente
	public function cierreP(int $intIdUser,string $srtDate){
		$this->intIdUser = $intIdUser;
		$this->srtDate = $srtDate;
		$sql = "SELECT fecha_ticket, COUNT(*) AS activo FROM table_ticket_venta WHERE status_ticket = 1 AND fecha_ticket != '$this->srtDate' GROUP BY fecha_ticket";
		$request = $this->select_all($sql);
		return $request;
	}
	// obtener los datos de las ventas del dia
	public function getTickets(string $srtDate){
		$this->srtDate = $srtDate;
		$sql = "SELECT * FROM table_ticket_venta WHERE fecha_ticket = '$this->srtDate'";
		$request = $this->select_all($sql);
		return $request;
		}
	// obtener los datos de los montos de las ventas del dia
	public function getTicketsMonto(string $srtDate, int $intIdUser){
		$this->srtDate = $srtDate;
		$this->intIdUser = $intIdUser;
		$sql ="SELECT tipo_pago_ticket, COUNT(*), 
				SUM(lts_ticket) AS LTS , SUM(monto_ticket) AS MONTO, fecha_ticket AS fecha
				FROM table_ticket_venta
				WHERE id_user = $this->intIdUser AND fecha_ticket = '$this->srtDate' GROUP BY tipo_pago_ticket";
		$request = $this->select_all($sql);
		return $request;
	}
	public function getTotal(string $srtDate){
		$this->srtDate = $srtDate;
		$sql = "SELECT SUM(monto_ticket) AS divisa FROM table_ticket_venta 
			WHERE tipo_pago_ticket = 4  AND fecha_ticket = '$this->srtDate'";
		$sql1 ="SELECT SUM(monto_ticket) AS efectivo FROM table_ticket_venta 
			WHERE tipo_pago_ticket = 5  AND fecha_ticket = '$this->srtDate'";
		$sql2 ="SELECT SUM(monto_ticket) AS punto FROM table_ticket_venta 
			WHERE tipo_pago_ticket = 6  AND fecha_ticket = '$this->srtDate'";
		$sql3 ="SELECT SUM(lts_ticket) AS lts FROM table_ticket_venta
			WHERE  fecha_ticket = '$this->srtDate'";
		$request = $this->select($sql);
		$request1 = $this->select($sql1);
		$request2 = $this->select($sql2);
		$request3 = $this->select($sql3);
		return $arrayData = array('divisa'=> $request,'efectivo'=> $request1,'punto'=> $request2,'lts'=> $request3);
	}
}