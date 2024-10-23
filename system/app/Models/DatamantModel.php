<?php
class DatamantModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

    /***************** listar las unidades en mantenimiento no repetidas***********************/
	public function listDataMant(){
		// $sql = "SELECT f.*, um.* FROM table_unidad_mantenimiento um INNER JOIN table_flota f ON f.id_flota = um.id_flota WHERE um.status_mantenimiento = 1 ORDER BY um.fecha_entrada DESC";
		// $sql = "SELECT f.*, um.* FROM table_unidad_mantenimiento um INNER JOIN table_flota f ON f.id_flota = um.id_flota  ORDER BY um.id_flota";
        $sql = "SELECT f.*, um.*, tu.* FROM table_unidad_mantenimiento um 
                JOIN table_flota f
                JOIN table_user tu 
                WHERE f.id_flota = um.id_flota AND
                um.user_id = tu.user_id
                ORDER BY um.id_flota";
		$request = $this->select_all($sql);
		return $request;
	}
    public function delReg(int $idReg){
        $this->idReg = $idReg;
        $sql = "DELETE FROM table_unidad_mantenimiento WHERE id_unidad_mantenimiento = $this->idReg";
        $request = $this->delete($sql);
        return $request;
    }
}