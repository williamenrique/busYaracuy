<?php
class PersonalModel extends Mysql {

	public function __construct(){
	//heradar la clase padre 
		parent::__construct();
	}
    /**********funcion para insertar personal*********/
	public function insertPersonal(string $intIdentificacion, string $strTxtNombre,int $intlistRolId,string $intTxtTlf,int $intTagPersonal,int $intListStatus){
		$this->intIdentificacion =  $intIdentificacion;
		$this->strTxtNombre =  $strTxtNombre;
		$this->intlistRolId =  $intlistRolId;
		$this->intTxtTlf =  $intTxtTlf;
		$this->intTagPersonal =  $intTagPersonal;
		$this->intListStatus =  $intListStatus;

		$select = "SELECT * FROM table_personal WHERE personal_cedula = $this->intIdentificacion";
		$requestSelect = $this->select($select);
		if($requestSelect > 0){
			$requestInsert = 1;
		}else{
			$queryInsert = "INSERT INTO table_personal(personal_cedula,personal_nombre,personal_cargo, personal_tlf,personal_tag,personal_status) VALUES(?,?,?,?,?,?)";
			$arrData = array($this->intIdentificacion,$this->strTxtNombre,$this->intlistRolId,$this->intTxtTlf,$this->intTagPersonal,$this->intListStatus);
			$requestInsert = $this->insert($queryInsert,$arrData);
		}
		return $requestInsert;
	}
    /**********funcion para traer todo el personal**********/
	public function selectPersonal(){
		$sql = "SELECT p.*, c.* FROM table_cargo c 
						INNER JOIN table_personal p  ON p.personal_cargo = c.id_cargo AND p.personal_status  <> 0 ORDER BY p.personal_cedula desc ";
		$request = $this->select_all($sql);
		return $request;
	}
    /**********funcion para seleccionar carg*********/
	public function selectCargo(){
		$sql = "SELECT * FROM table_cargo";
		$request = $this->select_all($sql);
		return $request;
	}
    /********** cambiar el status del personal**********/
	public function statusPersonal(int $intPersonal, int $intStatus){
		$this->intPersonal = $intPersonal;
		$this->intStatus = $intStatus;
		$sql = "UPDATE table_personal SET personal_status = ? WHERE id_personal = $this->intPersonal";
		$arrData = array($this->intStatus);
		$request = $this->update($sql,$arrData);
		return $request;
	}
    /********** cambiar el status y agregar texto**********/
	public function cambioStatusPersonal(int $intPersonal, int $intStatus, string $srtText, int $intUserId){
		//asignamos las propiedades a las variable
		$return = "";
		$this->intPersonal = $intPersonal;
		$this->intStatus = $intStatus;
		$this->srtText = $srtText;
		$this->intUserId = $intUserId;
		$sql =  "INSERT INTO table_cambiostatuspersonal (id_personal, idStatus,textCambio,user_id) VALUES (?,?,?,?)";
		$arrData = array($this->intPersonal,$this->intStatus,$this->srtText,$this->intUserId);// armamos el array con los datos obtenidos
		$request = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
		return $request;
	}
	//TODO: editar personal
	/**********funcion para traer datos de un personal**********/
	public function selectPersonalID(int $intIdPersonal){
		$this->intIdPersonal = $intIdPersonal;
		$sql = "SELECT p.*, c.* FROM table_cargo c 
					INNER JOIN table_personal p  ON p.personal_cargo = c.id_cargo 
					AND p.id_personal = $this->intIdPersonal
					AND p.personal_status  <> 0 ORDER BY p.personal_cedula DESC ";
		$request = $this->select($sql);
		return $request;
	}
	public function updatePersona(int $intIdPersonal, string $strCedulaEdit,string  $strNombreEdit, int $listCargoEdit, string $strTelefonoEdit, int $listTagPersonalEdit){
		
		$this->intIdPersonal = $intIdPersonal;
		$this->strCedulaEdit = $strCedulaEdit;
		$this->strNombreEdit = $strNombreEdit; 
		$this->listCargoEdit = $listCargoEdit;
		$this->strTelefonoEdit = $strTelefonoEdit;
		$this->listTagPersonalEdit = $listTagPersonalEdit;
		$sql = "UPDATE table_personal SET personal_cedula = ?, personal_nombre = ?, personal_cargo = ?, personal_tlf = ?, personal_tag = ? WHERE id_personal= $this->intIdPersonal";
		$arrData = array($this->strCedulaEdit,$this->strNombreEdit,$this->listCargoEdit,$this->strTelefonoEdit,$this->listTagPersonalEdit);
		// dep($arrData);
		$request = $this->update($sql,$arrData);
		return $request;
	}
}