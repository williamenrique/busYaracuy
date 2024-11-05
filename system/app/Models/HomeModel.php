<?php
class HomeModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}
	public function getOperativo(){
        $sql = "SELECT status_unidad, COUNT(*) AS cantUnd FROM table_flota GROUP BY status_unidad";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getUnidades(){
        $sql = "SELECT * FROM table_flota;";
        $request = $this->select_all($sql);
		return $request;
    }
    public function cantUnid(){
        $sql = "SELECT COUNT(flota.id_modelo) AS CANT,
                    (SUM(if(flota.status_unidad = 1,1,0))) AS OPERATIVO,
                    (SUM(if(flota.status_unidad = 2,1,0))) AS MANTENIMIENTO,
                    (SUM(if(flota.status_unidad = 3,1,0))) AS INOPERATIVO,
                    (SUM(if(flota.status_unidad = 0,1,0))) AS DESINCORPORADO
                FROM table_flota flota
                JOIN table_modelo modelo ON flota.id_modelo = modelo.id_modelo";
         $request = $this->select($sql);
         return $request;
    }
    public function getOperatividad(){
        $sql = "SELECT modelo.modelo_unidad AS MODELO,flota.transmision AS TRANSMISION, flota.tipo_combustible AS COMBUSTIBLE,
					COUNT(flota.id_modelo) AS CANT,
					(SUM(if(flota.status_unidad = 1,1,0))) AS OPERATIVO,
					(SUM(if(flota.status_unidad = 2,1,0))) AS MANTENIMIENTO,
					(SUM(if(flota.status_unidad = 3,1,0))) AS INOPERATIVO,
					(SUM(if(flota.status_unidad = 0,1,0))) AS DESINCORPORADO
				FROM table_flota flota
				JOIN table_modelo modelo ON flota.id_modelo = modelo.id_modelo
				GROUP BY flota.id_modelo, modelo.modelo_unidad,flota.transmision, flota.tipo_combustible";
        $request = $this->select_all($sql);
        return $request;
    }
}