<?php 
class Mysql extends Conexion{
	private $conexion;
	private $strQuery;
	private $arrValues;

	public function __construct(){
		//instanciamos la clase conexion para heredar los metodos
		$this->conexion = new Conexion();
		$this->conexion = $this->conexion->conect();
	}

	//metodos utilizados en el CRUD
	//metodo para insertar un registro
	public function insert(string $query, array $arrValues){
		$this->strQuery= $query;//almacenamos el sql
		$this->arrValues = $arrValues;

		$insert= $this->conexion->prepare($this->strQuery);
		$resInsert = $insert->execute($this->arrValues);
		if ($resInsert) {
			$lastInsert = $this->conexion->lastInsertId();
		}else{
			$lastInsert = 0;
		}
		return 	$lastInsert;
	}
	//metodo para buscar un registro
	public function select(string $query){
		$this->strQuery = $query;
		$result = $this->conexion->prepare($this->strQuery);
		$result->execute();
		$data = $result->fetch(PDO::FETCH_ASSOC);
		return $data;
	}

	//metodo para buscar varios registros
		public function select_all(string $query){
		$this->strQuery = $query;
		$result = $this->conexion->prepare($this->strQuery);
		$result->execute();
		$data = $result->fetchall(PDO::FETCH_ASSOC);
		return $data;
	}
	//metodo para actualizar
		public function update(string $query, array $arrValues){
		$this->strQuery = $query;
		$this->arrValues = $arrValues;
		$update = $this->conexion->prepare($this->strQuery);
		$resExecute= $update->execute($this->arrValues);
		return $resExecute;
	}

	//metodo para eliminar
		public function delete(string $query){
		$this->strQuery = $query;
		$delete = $this->conexion->prepare($this->strQuery);
		$del = $delete->execute();
		return $del;
	}
}