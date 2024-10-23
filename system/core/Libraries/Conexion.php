<?php
class Conexion {

	private $conect;

	public function __construct(){
		$conectString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";.DB_CHARSET.";
		try {
			$this->conect = new PDO($conectString, DB_USER, DB_PASS);
			$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$this->conect = "Error de conexion";
			echo "Error: ". $e->getMessage();
		}
	}

	public function conect(){
		return $this->conect;
	}
}