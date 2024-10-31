<?php
class FlotaModel extends Mysql {
	//establecemos variables para definir un rol
	public $strId;
	public $strRol;
	public $strDescripcion;
	public $intStatus;
	public $intIdRol;

	public function __construct(){
	//heradar la clase padre 
		parent::__construct();
	}
	/**********funcion para traer todos los flota para la tabla**********/
	public function selectFlota(){
		$sql = "SELECT f.* , modelo.*, marca.* FROM table_modelo modelo
                INNER JOIN table_flota f ON f.id_modelo = modelo.id_modelo
                INNER JOIN table_marca marca ON marca.id_marca = f.id_marca";
		$request = $this->select_all($sql);
		return $request;
	}
    /**********funcion para traer todos los modelos**********/
	public function selectMarca(){
		$sql = "SELECT * FROM table_marca";
		$request = $this->select_all($sql);
		return $request;
	}
    /**********funcion para traer todos los modelos**********/
	public function selectModelos(){
		$sql = "SELECT * FROM table_modelo";
		$request = $this->select_all($sql);
		return $request;
	}
	/**********funcion para traer todas las unidades**********/
	public function selectUnidad(){
		$sql = "SELECT * FROM table_flota WHERE status_unidad != 0 AND status_unidad != 2";
		$request = $this->select_all($sql);
		return $request;
	}
	/********** cambiar el status de la  unidad**********/
	public function statusUnidad(int $intIdUnidad, int $intStatus){
		$this->intIdUnidad = $intIdUnidad;
		$this->intStatus = $intStatus;
		$sql = "UPDATE table_flota SET status_unidad = ? WHERE id_flota = $this->intIdUnidad";
		$arrData = array($this->intStatus);
		$request = $this->update($sql,$arrData);
		// if($this->intStatus == 1){
		// 	$request = "1";
		// }else{
		// 	$request = "2";
		// }
		return $request;
	}
	/********** crear unidad**********/
	public function cambioStatusUnidad(int $intIdUnidad, int $intStatus, string $srtText, int $intUserId){
		//asignamos las propiedades a las variable
		$return = "";
		$this->intIdUnidad = $intIdUnidad;
		$this->intStatus = $intStatus;
		$this->srtText = $srtText;
		$this->intUserId = $intUserId;
		$sql =  "INSERT INTO table_cambiostatus (id_unidad, idStatus,textCambio,user_id) VALUES (?,?,?,?)";
		$arrData = array($this->intIdUnidad,$this->intStatus,$this->srtText,$this->intUserId);// armamos el array con los datos obtenidos
		$request = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
		return $request;
	}

	/********** crear unidad**********/
	public function insertUnidad(string $srtIdUnidad, int $intMarcaUnidad, int $intModelo, string $srtVim,string $srtFechaUnidad, int $srtCapacidad, string $srtTipoCombustible, string $strListTransmision){
		//asignamos las propiedades a las variable
		$return = "";
		$this->srtIdUnidad = $srtIdUnidad;
		$this->intMarcaUnidad = $intMarcaUnidad;
		$this->intModelo = $intModelo;
		$this->srtVim = $srtVim;
		$this->srtFechaUnidad = $srtFechaUnidad;
		$this->srtCapacidad = $srtCapacidad;
		$this->srtTipoCombustible = $srtTipoCombustible;
		$this->strListTransmision = $strListTransmision;
		//seleccionamos todos los rol para comprobar que no exista
		$sql = "SELECT * FROM table_flota WHERE id_unidad = '{$this->srtIdUnidad}'";
		$request = $this->select_all($sql);
		//validar si ya existe si no hace el insert
		if(empty($request)){
			$sql_insert =  "INSERT INTO table_flota(id_unidad,id_marca,id_modelo,vim_unidad,fecha_creacion,cap_pasajero,tipo_combustible,transmision,status_unidad) VALUES (?,?,?,?,?,?,?,?,?)"; // se prepara el insert
			$arrData = array($this->srtIdUnidad,$this->intMarcaUnidad,$this->intModelo,$this->srtVim,$this->srtFechaUnidad,$this->srtCapacidad,$this->srtTipoCombustible,$strListTransmision,1);// armamos el array con los datos obtenidos
			$request_insert = $this->insert($sql_insert,$arrData);//enviamos el query y el array de datos 
			$return = $request_insert;//retorna el id insertado
		}else{
			$return = "exist";
		}
		return $return;
	}
	/**********************
	 *  UNIDAD
	***********************/
	/*****************traer todo el historial de unidad en mantenimiento para el historial***********************/
	public function selectUnidadHM(int $idFlota){
		$this->idFlota = $idFlota;
		$sql = "SELECT f.*, um.*, model.* , marca.*, u.* FROM table_unidad_mantenimiento um
				INNER JOIN table_flota f ON f.id_flota = um.id_flota
				INNER JOIN table_modelo model ON model.id_modelo = f.id_modelo
				INNER JOIN table_marca marca ON marca.id_marca = f.id_marca
				INNER JOIN table_user u ON u.user_id = um.user_id  
				WHERE f.id_flota = $this->idFlota ORDER BY um.id_unidad_mantenimiento DESC";
		// $sql = "SELECT f.*, um.*, u.* FROM table_unidad_mantenimiento um 
		// 	INNER JOIN table_flota f ON f.id_flota = um.id_flota 
		// 	INNER JOIN table_user u ON u.user_id = um.user_id  
		// 	WHERE f.id_flota = $this->idFlota ORDER BY id_unidad_mantenimiento DESC";
		$request = $this->select_all($sql);
		return $request;
	}
	/********** una unidad por id**********/
	public function selectUnidadID(int $idFlota){
		$this->idFlota = $idFlota;
		$sql = "SELECT f.*,  model.* , marca.* FROM table_flota f 
				INNER JOIN table_modelo model ON model.id_modelo = f.id_modelo
				INNER JOIN table_marca marca ON marca.id_marca = f.id_modelo 
				WHERE f.id_flota = $this->idFlota";
		$request = $this->select($sql);
		return $request;
	}
	/********** sacar unidad de mantenimiento**********/
	public function outMantenimiento(int $idFlota, string $srtFechaSalida, string $srtObsSalida, int $intOutMantenimiento){
		$this->idFlota = $idFlota;
		$this->srtFechaSalida = $srtFechaSalida;
		$this->srtObsSalida = $srtObsSalida;
		$this->intOutMantenimiento = $intOutMantenimiento;
		$sql = "UPDATE table_unidad_mantenimiento SET obsSalida = ? , fecha_salida = ? , status_mantenimiento = 0 WHERE id_flota = $this->idFlota AND id_unidad_mantenimiento = $this->intOutMantenimiento";
		$arrData = array($this->srtObsSalida,$this->srtFechaSalida);
		$request = $this->update($sql,$arrData);
		$sqlUpdate = "UPDATE table_flota SET status_unidad = 1  WHERE id_flota = $this->idFlota";
		// $requestUpdate = $this->update($sqlUpdate);
		// if($request == 1){
		// 	$request = "1";
		// }else{
		// 	$request = "2";
		// }
		return $request;
	}
	/**********************
	 *  MANTENIMIENTO
	***********************/
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
	/***************** listar las unidades en mantenimiento no repetidas***********************/
	public function selectFlotaMantenimiento(){
		$sql = "SELECT f.*, um.* FROM table_unidad_mantenimiento um INNER JOIN table_flota f ON f.id_flota = um.id_flota WHERE um.status_mantenimiento = 1 ORDER BY um.fecha_entrada DESC";
		$request = $this->select_all($sql);
		return $request;
	}
	/********** ingresar unidad en mantenimiento**********/
	public function setIMantenimiento(int $srtListUnidad, string $srtRutaUnidad, string $srtOperador, string $srtMecanico, string $srtKilometraje,string $srtRadioTipo, string $srtFechaEntrada, string $srtDiagnostico, string $srtRecomendacion, string $srtObsOper, string $srtObsSuper, int $intIdUser){
		// $this->intidUnidad = $intidUnidad; 
		$this->srtListUnidad = $srtListUnidad; 
		$this->srtRutaUnidad = $srtRutaUnidad; 
		$this->srtOperador = $srtOperador; 
		$this->srtMecanico = $srtMecanico; 
		$this->srtKilometraje = $srtKilometraje; 
		$this->srtFechaEntrada = $srtFechaEntrada; 
		$this->srtObsOper = $srtObsOper; 
		$this->srtObsSuper = $srtObsSuper; 
		$this->srtDiagnostico = $srtDiagnostico; 
		$this->srtRecomendacion = $srtRecomendacion;
		$this->srtRadioTipo = $srtRadioTipo;
		$this->intIdUser = $intIdUser;
		$sql_insert = "INSERT INTO table_unidad_mantenimiento(id_flota, ruta_unidad, operardor_unidad, nomb_mecanico, km_unidad, tipo_mantenimiento, diagnostico, recomendacion, obsOperador , obsSupervisor, fecha_entrada, fecha_salida, status_mantenimiento,user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$arrData = array($this->srtListUnidad,$this->srtRutaUnidad,$this->srtOperador,$this->srtMecanico,$this->srtKilometraje,$this->srtRadioTipo,$this->srtDiagnostico,$this->srtRecomendacion,$this->srtObsOper,$this->srtObsSuper,$this->srtFechaEntrada,'','1',$this->intIdUser);
		$request_insert = $this->insert($sql_insert,$arrData);//enviamos el query y el array de datos
		return $request_insert;
	}
	/**********************
	 *  EDITAR
	***********************/
	/********** una unidad por id para editar**********/
	public function getUnidadEdit(int $idFlota){
		$this->idFlota = $idFlota;
		$sql = "SELECT f.*,  model.* , marca.* FROM table_flota f 
				INNER JOIN table_modelo model ON model.id_modelo = f.id_modelo
				INNER JOIN table_marca marca ON marca.id_marca = f.id_marca  
				WHERE f.id_flota = $this->idFlota";
		$request = $this->select($sql);
		return $request;
	}
	/**********actualizar unidad por id para editar**********/
	public function updateUnidad(int $intUnidad,int $intMarcaUnidad,int $intModeloUnidad,string $strCapacidad,string $strTransmision,string $strCombustible){
		$this->intUnidad = $intUnidad;
		$this->intMarcaUnidad = $intMarcaUnidad;
		$this->intModeloUnidad = $intModeloUnidad;
		$this->strCapacidad = $strCapacidad;
		$this->strTransmision = $strTransmision;
		$this->strCombustible = $strCombustible;
		$sql = "UPDATE table_flota SET id_marca = ?, id_modelo = ?, cap_pasajero = ? , tipo_combustible = ? , transmision = ? WHERE id_flota = $this->intUnidad";
		$arrData = array($this->intMarcaUnidad,$this->intModeloUnidad,$this->strCapacidad,$this->strCombustible,$this->strTransmision);
		$request = $this->update($sql,$arrData);
		return $request;
	}
}