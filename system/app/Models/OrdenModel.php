<?php
class OrdenModel extends Mysql {

	public function __construct(){
	//heradar la clase padre 
		parent::__construct();
	}
    /****funcion para traer todas las unidades para el select ****/
	public function selectListFlota(){
		$sql = "SELECT flota.*, modelo.modelo_unidad FROM table_flota flota
					INNER JOIN table_modelo modelo ON flota.id_modelo = modelo.id_modelo";
		$request = $this->select_all($sql);
		return $request;
	}
    /****funcion para traer una unidad ****/
	public function selectUnidad(int $intIdUnidad){
        $this->intIdUnidad = $intIdUnidad;
		/*$sql = "SELECT f.*, mo.*, ma.* FROM table_flota f
                        INNER JOIN table_marca ma ON f.id_marca = ma.id_marca
                        INNER JOIN table_modelo mo ON f.id_modelo = mo.id_modelo
                        WHERE status_unidad != 0 AND status_unidad != 2 AND f.id_flota = $this->intIdUnidad";*/
		$sql = "SELECT f.*, mo.*, ma.* FROM table_flota f
						INNER JOIN table_marca ma ON f.id_marca = ma.id_marca
						INNER JOIN table_modelo mo ON f.id_modelo = mo.id_modelo
						WHERE f.id_flota = $this->intIdUnidad";
		$request = $this->select($sql);
		return $request;
	}
	/****funcion para traer un personal especifico ****/
	public function selectPersonal(int $intDesp){
        $this->intDesp = $intDesp;
		$sql = "SELECT * FROM table_personal  WHERE id_personal = $this->intDesp";
		$request = $this->select($sql);
		return $request;
	}
    /****funcion para traer operadores para el select ****/
	public function selectListOper(){
		$sql = "SELECT p.*, c.* FROM table_personal p
						INNER JOIN  table_cargo c  ON p.personal_cargo = c.id_cargo 
                        AND p.personal_status  <> 0 WHERE p.personal_cargo = 23 ORDER BY p.personal_cedula DESC  ";
		$request = $this->select_all($sql);
		return $request;
	}
    /****funcion para traer mecanicos para el select ****/
	public function selectListMec(){
		$sql = "SELECT p.*, c.* FROM table_personal p
                        INNER JOIN  table_cargo c  ON p.personal_cargo = c.id_cargo 
                        AND p.personal_status  <> 0 WHERE p.personal_cargo BETWEEN 26 AND 29  ORDER BY p.personal_cedula DESC";
		$request = $this->select_all($sql);
		return $request;
	}
    /****funcion para traer despachadores de almacen ****/
	public function selectListDesp(){
		$sql = "SELECT p.*, c.* FROM table_personal p
						INNER JOIN  table_cargo c  ON p.personal_cargo = c.id_cargo 
                        AND p.personal_status  <> 0 WHERE p.personal_cargo = 31 OR p.personal_cargo = 11 OR p.personal_cargo = 39  ORDER BY p.personal_cedula DESC ";
		$request = $this->select_all($sql);
		return $request;
	}
	/****funcion para traer los articulos  de almacen para el select ****/
	public function selectListArt(){
		$sql = "SELECT producto.*, relacionP.*, enlace.enlace_producto FROM table_producto producto
					INNER JOIN table_enlace_producto enlace ON enlace.id_enlace_producto = producto.id_enlace_producto
					INNER JOIN table_relacion_producto relacionP ON producto.id_producto = relacionP.id_producto
					WHERE relacionP.cant_producto > 0 AND producto.status_producto > 0";
		$request = $this->select_all($sql);
		return $request;
	}
	/**** insertar despacho ****/
	public function insertDespacho(int $intUnidad, string $srtOper, string $srtMec,string $srtDesp, int $intIdUser, string $srtObs, string $strDate){
		$this->intIdUser = $intIdUser;
		$this->intUnidad = $intUnidad;
		$this->srtOper = $srtOper;
		$this->srtMec = $srtMec;
		$this->srtDesp = $srtDesp;
		$this->srtObs = $srtObs;
		$this->strDate = $strDate;
		$date = date('Y-m-d');
		$queryInsert = "INSERT INTO table_despacho(id_flota,operador,mecanico, despachador,user_id,observacion,fecha_despacho) VALUES(?,?,?,?,?,?,?)";
		$arrData = array($this->intUnidad,$this->srtOper,$this->srtMec,$this->srtDesp,$this->intIdUser,$this->srtObs,$this->strDate);
		$requestInsert = $this->insert($queryInsert,$arrData);
		if($requestInsert > 0){

		}
		return $requestInsert;
	}
	/**** insertar relacion despacho ****/
	public function insertRDespacho(int $intIdDespacho, int $intIdArticulo, int $intCant){
		$this->intIdDespacho = $intIdDespacho;
		$this->intIdArticulo = $intIdArticulo;
		$this->intCant = $intCant;
		
		$queryInsert = "INSERT INTO table_relacion_despacho(id_despacho,id_producto,cant_despacho) VALUES(?,?,?)";
		$arrData = array($this->intIdDespacho,$this->intIdArticulo,$this->intCant);
		$requestInsert = $this->insert($queryInsert,$arrData);
		return $requestInsert;
	}
	/**** insertar relacion despacho ****/
	public function updateCant(int $intIdArticulo, int $intCant){
		$this->intIdArticulo = $intIdArticulo;
		$this->intCant = $intCant;
		$sqlSelect = "SELECT cant_producto FROM table_relacion_producto WHERE id_producto = $this->intIdArticulo";
		$request = $this->select($sqlSelect);
		$nuevaCant = $request['cant_producto'] - $this->intCant;
		$queryUpdate = "UPDATE table_relacion_producto SET cant_producto = ? WHERE id_producto = $this->intIdArticulo";
		$arrData = array($nuevaCant);
		$requestUpdate = $this->update($queryUpdate,$arrData);
		return $requestUpdate;
	}
	/****funcion para traer un articulo  de almacen para el select ****/
	public function selectArt(int $intIdArt){
		$this->intIdArt = $intIdArt;
		$sql = "SELECT cant_producto FROM table_relacion_producto WHERE id_producto = $this->intIdArt";
		$request = $this->select($sql);
		return $request;
	}
	// TODO: ordenes
	/***** obtener lista de ordenes en al historial*****/
	public function getListOrdenes(){
		$sql = "SELECT desp.*, flota.*, modelo.*, marca.*, usuario.*  FROM table_flota flota
					INNER JOIN table_despacho desp ON desp.id_flota = flota.id_flota
					INNER JOIN table_user usuario ON usuario.user_id = desp.user_id
					INNER JOIN table_modelo modelo ON modelo.id_modelo = flota.id_modelo
					INNER JOIN table_marca marca ON marca.id_marca = flota.id_marca ORDER BY desp.id_despacho DESC";
		$request = $this->select_all($sql);
		return $request;
	}
	// obtener la lista de articulos por cada despacho y mostralos en el tmeline de ordenes
	public function getListArtDesp(int $intDesp){
		$this->intDesp = $intDesp;
		$sql = "SELECT producto.*, relacionP.*, enlaceP.* FROM table_producto producto 
					JOIN table_relacion_despacho relacionP ON producto.id_producto = relacionP.id_producto 
					JOIN table_enlace_producto enlaceP ON enlaceP.id_enlace_producto = producto.id_enlace_producto 
					WHERE relacionP.id_despacho = $this->intDesp";
		$request = $this->select_all($sql);
		return $request;
	}
	// obtener codigo  fecha o unidad para buscador
	public function getListBuscarOrdenes(string $strCod,string $strFecha, string $strUnidad){
		$this->strCod = $strCod;
		$this->strUnidad = $strUnidad;
		$this->strFecha = $strFecha;
		if($this->strCod == "" && $this->strUnidad == "" && $this->strFecha == ""){
			$sql = "SELECT desp.*, flota.*, modelo.*, marca.*, usuario.*  FROM table_flota flota
		 			INNER JOIN table_despacho desp ON desp.id_flota = flota.id_flota
		 			INNER JOIN table_user usuario ON usuario.user_id = desp.user_id
		 			INNER JOIN table_modelo modelo ON modelo.id_modelo = flota.id_modelo
		 			INNER JOIN table_marca marca ON marca.id_marca = flota.id_marca ORDER BY desp.id_despacho DESC";
		 	$request = $this->select_all($sql);
		}else{
			$sql = "SELECT desp.*, flota.*, modelo.*, marca.*, usuario.*  FROM table_flota flota
					INNER JOIN table_despacho desp ON desp.id_flota = flota.id_flota
					INNER JOIN table_user usuario ON usuario.user_id = desp.user_id
					INNER JOIN table_modelo modelo ON modelo.id_modelo = flota.id_modelo
					INNER JOIN table_marca marca ON marca.id_marca = flota.id_marca 
					WHERE  desp.id_despacho = '$this->strCod' OR flota.id_unidad = '$this->strUnidad' OR desp.fecha_despacho = '$this->strFecha' ORDER BY desp.id_despacho DESC";
			$arrData = array($this->strCod,$this->strUnidad);
			$request = $this->select_all($sql,$arrData);
		}
		return $request;
	}
	// obtener orden de despacho para la impersion y generar pdf
	public function selectDepacho(int $strCod){
		$this->strCod = $strCod;
		$sql = "SELECT desp.*, flota.*, modelo.*, marca.*, usuario.*  FROM table_flota flota
				INNER JOIN table_despacho desp ON desp.id_flota = flota.id_flota
				INNER JOIN table_user usuario ON usuario.user_id = desp.user_id
				INNER JOIN table_modelo modelo ON modelo.id_modelo = flota.id_modelo
				INNER JOIN table_marca marca ON marca.id_marca = flota.id_marca 
				WHERE  desp.id_despacho = $this->strCod  ORDER BY desp.id_despacho DESC";
		$arrData = array($this->strCod);
		$request = $this->select($sql,$arrData);
		return $request;
	}
}
