<?php
class TimeLineModel extends Mysql {
	private $intIdUser;
	private $strCodigo;
	
	private $intIdentificacion;
	private $strTxtNombre;
	private $strtxtApellidos;
	private $intTxtTlf;
	private $strTxtEmail;
	private $intListStatus;
	private $intlistRolId;
	private $strTxtPass;
	private $strToken;
	private $strNick;
	private $strTxtNick;
	private $intOption;
	private $intStatus;
	private $fileBase;
	public function __construct(){
		parent::__construct();
	}

	/**************
	 * funcion para la Timeline
	 */
	// public function setTimeline(int $intIdUser, string $strCodigo, string $strHoraInicio, string $strHoraFin, string $strTipo){
	public function setTimeline(int $intIdUser, string $strCodigo, string $strFecha, string $strHoraInicio){
		$this->intIdUser = $intIdUser;
		$this->strCodigo = $strCodigo;
		$this->strHoraInicio = $strHoraInicio;
		$this->strFecha = $strFecha;
		$sql = "INSERT INTO table_timeline(time_idUser,time_codigo,time_fecha,time_inicio)  VALUES(?,?,?,?)";
		$arrData = array($this->intIdUser,$this->strCodigo, $this->strFecha,$this->strHoraInicio); 
		$request = $this->insert($sql,$arrData);
		return $request;
	}
	public function endTimeline(string $strCodigo,string $strHoraFin){
		$this->strCodigo = $strCodigo;
		$this->strHoraFin = $strHoraFin;
		$sql = "SELECT * FROM table_timeline WHERE time_codigo = '$this->strCodigo'";
		$request = $this->select($sql);
		if(!empty($request)){
			$sql = "UPDATE table_timeline SET time_fin = ? WHERE time_codigo = '$this->strCodigo'";
			$arrData = array($this->strHoraFin);
			$request = $this->update($sql,$arrData);
		}
		return $request;
	}

	/******
	 * funcion timeline
	 */
	// public function getTimeline(){
	// 	$sql = "SELECT a.user_nick AS login, a.user_nombres AS nombres, a.user_apellidos AS apellidos, b.rol_name AS rol, c.b_id AS id, c.b_codigo AS codigo, c.b_horaInicio AS inicio, c.b_horaFinal AS fin FROM((table_user a JOIN table_roles b) JOIN table_Timeline c) WHERE ((a.user_rol  = b.rol_id) AND (a.user_id = c.b_idUser) )order by c.b_id desc";
	// 	$request = $this->select_all($sql);
	// 	return $request;
	// }
	public function getTimeline(){
		$sql = "SELECT login, nombres, apellidos, rol, id, codigo, fecha, inicio, fin FROM v_timeline  ORDER BY id DESC";
		$request = $this->select_all($sql);
		return $request;
	}
}