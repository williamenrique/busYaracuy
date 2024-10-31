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

}