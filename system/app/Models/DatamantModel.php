<?php
class DatamantModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

    /***************** listar las unidades en mantenimiento no repetidas***********************/
	public function listDataMant(){
		$sql = "SELECT f.*, um.*, tu.* FROM table_unidad_mantenimiento um 
                JOIN table_flota f
                JOIN table_user tu 
                WHERE f.id_flota = um.id_flota AND
                um.user_id = tu.user_id
                ORDER BY um.id_flota";
		$request = $this->select_all($sql);
		return $request;
	}
    // eliminar registro duplicados en el mantenimiento
    public function delReg(int $idReg){
        $this->idReg = $idReg;
        $sql = "DELETE FROM table_unidad_mantenimiento WHERE id_unidad_mantenimiento = $this->idReg";
        $request = $this->delete($sql);
        return $request;
    }
    // obtener unidades
    public function selectUnidad(){
        $sql = "SELECT id_flota, id_unidad FROM  table_flota";
        $request = $this->select_all($sql);
        return $request;
    }
    // registrar scaner
    public function setScaner(int $idUser, int $idUnidad,string $strObsScaner,string $fechaScaner){
        $this->idUser = $idUser; 
        $this->idUnidad = $idUnidad;
        $this->strObsScaner = $strObsScaner;
        $this->fechaScaner = $fechaScaner;
        $sql = "INSERT INTO table_registro_scaner (id_user, id_flota, obs_scaner,fecha_scaner,status_scaner) VALUES (?,?,?,?,?)";
        $arrData = array($this->idUser,$this->idUnidad,$this->strObsScaner,$this->fechaScaner,1);
        $request = $this->insert($sql, $arrData);
        return $request;
    }
    public function searchReg(string $strSearch){
        $this->strSearch = $strSearch;
        $sql = "SELECT flota.id_unidad, scaner.*  FROM table_registro_scaner scaner
                INNER JOIN table_flota flota ON flota.id_flota = scaner.id_flota
                WHERE flota.id_unidad LIKE  '%$this->strSearch%' OR scaner.fecha_scaner LIKE '%$this->strSearch%'ORDER BY scaner.fecha_scaner DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    // modificar productos
     // cargar todos los productos para mostrarlos en la tabla
    public function getProductos(){
        $sql = "SELECT  producto.*, proveedor.*, relacionP.*, ubicacion.*, enlace.enlace_producto FROM table_producto producto 
                INNER JOIN table_relacion_producto relacionP ON  producto.id_producto = relacionP.id_producto
                INNER JOIN table_proveedor proveedor ON proveedor.id_proveedor = relacionP.id_proveedor
                INNER JOIN table_ubicacion ubicacion ON ubicacion.id_ubicacion = producto.id_ubicacion
                INNER JOIN table_enlace_producto enlace ON enlace.id_enlace_producto = producto.id_enlace_producto
                WHERE producto.status_producto = 1";
		$request = $this->select_all($sql);
		return $request;
    }
    /********** funcion para traer las ubicaciones para el almacenado de los articulos **********/
	public function selectUbic(){
		$sql = "SELECT * FROM table_ubicacion";
		$request = $this->select_all($sql);
		return $request;
	}

    // TODO: ordenes
	/***** obtener lista de ordenes en al historial*****/
	public function getListOrdenes(){
		$sql = "SELECT desp.*, flota.*, modelo.*, marca.*, usuario.*  FROM table_flota flota
					INNER JOIN table_despacho desp ON desp.id_flota = flota.id_flota
					INNER JOIN table_user usuario ON usuario.user_id = desp.user_id
					INNER JOIN table_modelo modelo ON modelo.id_modelo = flota.id_modelo
					INNER JOIN table_marca marca ON marca.id_marca = flota.id_marca AND desp.status_despacho = 0 ORDER BY desp.id_despacho DESC";
		$request = $this->select_all($sql);
		return $request;
	}
    // obtener la lista de articulos por cada despacho y mostralos en el tmeline de ordenes
	public function getListArtDesp(int $intDesp){
		$this->intDesp = $intDesp;
		$sql = "SELECT producto.*, relacionP.*, enlaceP.* FROM table_producto producto 
					JOIN table_relacion_despacho relacionP ON producto.id_producto = relacionP.id_producto 
					JOIN table_enlace_producto enlaceP ON enlaceP.id_enlace_producto = producto.id_enlace_producto 
					WHERE relacionP.id_despacho = $this->intDesp ";
		$request = $this->select_all($sql);
		return $request;
	}
    // restaurar la orden de despacho
    public function restDesp(int $idDesp, string $srtText, int $intUserId){
		$this->idDesp = $idDesp;
		$this->srtText = $srtText;
		$this->srtInfo = strtoupper('usuario '.$_SESSION['userData']['user_nick'].' elimino orden de despacho');
		$this->intUserId = $intUserId;
		$this->intStatus = 1;
		$sql = "UPDATE table_despacho SET status_despacho = ? WHERE id_despacho = $this->idDesp";
		$arrData = array($this->intStatus);
		$request = $this->update($sql,$arrData);
		if($request){
			$insertH = "INSERT INTO table_historial_cambio(obs,info,id_user) VALUES(?,?,?)";
			$arrDataH = array($this->srtText,$this->srtInfo,$this->intUserId);
			$requestInsert = $this->insert($insertH,$arrDataH);
			// return $requestInsert;
		}
		return $request;
	}
    // obtener los articulos de la orden a restaurar para revertir los cambios y restarle las cantidades
	public function artDespacho(int $idDesp){
		$this->idDesp = $idDesp;
		$sql = "SELECT tProducto.producto, tRelacionP.cant_producto, tRelacionD.* FROM table_producto tProducto
				INNER JOIN table_relacion_producto tRelacionP ON tProducto.id_producto = tRelacionP.id_producto
				INNER JOIN table_relacion_despacho tRelacionD ON tRelacionD.id_producto = tRelacionP.id_producto 
				WHERE tRelacionD.id_despacho = $this->idDesp";
		$request = $this->select_all($sql);
		return $request;
	}
	// actualizar la tabla de productos con la devolucion de articulos
	public function updateCantN(int $intIdArticulo, float $intCant){
		$this->intIdArticulo = $intIdArticulo;
		$this->intCant = $intCant;
		$queryUpdate = "UPDATE table_relacion_producto SET cant_producto = ? WHERE id_producto = $this->intIdArticulo";
		$arrData = array($this->intCant);
		$requestUpdate = $this->update($queryUpdate,$arrData);
		return $requestUpdate;
	}

}