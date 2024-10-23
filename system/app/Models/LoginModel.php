<?php
class LoginModel extends Mysql {
	private $intIdentificacion;
	private $intIdUser;
	private $strTxtUser;
	private $strTxtPass;
	private $strTxtNombre;
	private $strtxtApellidos;
	private $intTxtTlf;
	private $strTxtEmail;
	private $intListStatus;
	private $intlistRolId;
	private $strToken;
	private $strNick;
	private $strFileBase;
	private $strCodigo;
	private $strHoraInicio;
	private $strHoraFin;
	private $strTipo;
	public function __construct(){
		parent::__construct();
	}
	public function loginUser(string $txtUser, string $txtPass){
		$this->strTxtUser = $txtUser;
		$this->strTxtPass = $txtPass;
	//	$sql = "SELECT user_id,user_status, user_nick, user_pass, user_email FROM table_user WHERE user_email = '$this->strTxtUser' AND  user_pass = '$this->strTxtPass' AND user_status != 0";
		$sql = "SELECT * FROM table_user WHERE (user_email = '$this->strTxtUser' OR user_nick = '$this->strTxtUser') AND  user_pass = '$this->strTxtPass' AND user_status != 0";
		$request = $this->select($sql);
		return $request;
	}

	public function sessionLogin(int $intIdUser){
		$this->intIdUser = $intIdUser;
		// $sql = "SELECT  p.user_ci,p.user_nick, p.user_id,p.user_nombres,p.user_pass,p.user_apellidos,p.user_tlf,p.user_img,p.user_email, p.user_status,r.rol_id,r.rol_name FROM table_user p INNER JOIN table_roles r ON p.user_rol = r.rol_id WHERE p.user_id = $this->intIdUser";
		$sql = "SELECT usuario.*, rol.*, departamento.departamento FROM table_user usuario 
				JOIN table_roles rol ON usuario.user_rol = rol.rol_id 
				JOIN table_departamento departamento ON usuario.id_departamento = departamento.id_departamento
				WHERE usuario.user_id = $this->intIdUser";
		$request = $this->select($sql);
		$_SESSION['userData'] = $request;
		return $request;
	}

	public function createUser(int $intIdentificacion, string $strTxtNombre, string $strTxtEmail, string $strTxtPass){
		$this->intIdentificacion = $intIdentificacion;
		$this->strTxtNombre = $strTxtNombre;
		$this->strTxtPass = $strTxtPass;
		$this->strTxtEmail = $strTxtEmail;
		$this->intListStatus = 3;
		$this->intlistRolId = 3;
		$this->strImg = "default.png";

		//consultar si existe
		$sql = "SELECT * FROM table_user WHERE  user_email = '{$this->strTxtEmail}' or  user_ci = {$this->intIdentificacion}";
		$request = $this->select_all($sql);
		//si no encontro ningun resultado insertamos el usuario
		if(empty($request)){
			$queryInsert = "INSERT INTO table_user(user_ci,user_nombres,user_email,user_status,user_img, user_rol,user_pass) VALUES(?,?,?,?,?,?,?)";
			$arrData = array($this->intIdentificacion,$this->strTxtNombre,$this->strTxtEmail,$this->intListStatus,$this->strImg,$this->intlistRolId,$this->strTxtPass);
			$requestInsert = $this->insert($queryInsert,$arrData);
			//almacenar errores
			// $pagina_error = $_SERVER['PHP_SELF']. addslashes($requestInsert);
			// $usuario = 0;

			// $sqlLog = "INSERT INTO table_log(log_idUser,log_descripcion,log_comando) VALUES(?,?,?)";
			// $arrDataLog = array($usuario,$pagina_error,$queryInsert);
			// $log = $this->insert($sqlLog,$arrDataLog);
			// dep($requestInsert);
			//die();
			$return = $requestInsert;
		}else{
			//si no viene vacia es que ya existe un registro
			$return = "exist";
		}
		return $return;
	}

	public function updateNick(int $intIdUser, int $intIdentificacion,string $strTxtEmail, string $strNick,string $strFileBase){
		$this->intIdUser = $intIdUser;
		$this->intIdentificacion = $intIdentificacion;
		$this->strTxtEmail = $strTxtEmail;
		$this->strNick = $strNick;
		$this->strFileBase = $strFileBase;
	 	$sql = "SELECT * FROM table_user WHERE user_email = '{$this->strTxtEmail}'  AND user_ci = $this->intIdentificacion ";
		$request = $this->select_all($sql);
		if(!empty($request)){
			$sql = "UPDATE table_user SET user_nick = ? , user_ruta = ? WHERE user_email = '{$this->strTxtEmail}'  AND user_ci = $this->intIdentificacion ";
			$arrData = array($this->strNick, $this->strFileBase);
			$request = $this->update($sql,$arrData);
		}else{
			$request = 'error';
		}
		return $request;
	}

	//crear la relacion user y rol al crearlo y se ingresa en 0 para despues asignarle
	public function setUserRol(int $intIdUser,int $intRol){
		$this->intRol = $intRol;
		$sql = "SELECT user_nick FROM table_user WHERE user_id = $intIdUser";
		$resp = $this->select($sql);
		if(!empty($resp)){
			$insertRol = "INSERT INTO table_user_rol(user_nick,id_rol) VALUES(?,?)";
			$arrDataRol = array($resp['user_nick'],$this->intRol);
			$request = $this->insert($insertRol,$arrDataRol);
		}else{
			$request ="error";
		}
		return $request;
	}
	/**************
	 * funcion para la bitacora
	 */
	// public function setBitacora(int $intIdUser, string $strCodigo, string $strHoraInicio, string $strHoraFin, string $strTipo){
	// public function setBitacora(int $intIdUser, string $strCodigo, string $strTipo){
	// 	$this->intIdUser = $intIdUser;
	// 	$this->strCodigo = $strCodigo;
	// 	// $this->strHoraInicio = $strHoraInicio;
	// 	// $this->strHoraFin = $strHoraFin;
	// 	$this->strTipo = $strTipo;
	// 	$sql = "INSERT INTO table_bitacora (b_idUser, b_codigo,b_tipo) VALUES(?,?,?)";
	// 	$arrData = array($this->intIdUser,$this->strCodigo,$this->strTipo);
	// 	$request = $this->insert($sql,$arrData);
	// 	return $request;
	// }
	// public function updateBitacora(string $strCodigo,string $strHoraFin){
	// 	$this->strCodigo = $strCodigo;
	// 	$this->strHoraFin = $strHoraFin;
	// 	$sql = "SELECT * FROM table_bitacora WHERE b_codigo = '$this->strCodigo'";
	// 	$request = $this->select($sql);
	// 	if(!empty($request)){
	// 		$sql = "UPDATE table_bitacora SET b_horaFinal = ? WHERE b_codigo = '$this->strCodigo'";
	// 		$arrData = array($this->strHoraFin);
	// 		$request = $this->update($sql,$arrData);
	// 	}
	// 	return $request;
	// }
}