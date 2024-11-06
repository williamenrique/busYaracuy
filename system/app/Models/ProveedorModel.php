<?php
class ProveedorModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

    // ingresar nuevo proveedor 
    public function setProveedor(int $intIdUser, string $strCodigo, string $strFecha, string $strHoraInicio){
		$this->intIdUser = $intIdUser;
		$this->strCodigo = $strCodigo;
		$this->strHoraInicio = $strHoraInicio;
		$this->strFecha = $strFecha;
		$sql = "INSERT INTO table_timeline(time_idUser,time_codigo,time_fecha,time_inicio)  VALUES(?,?,?,?)";
		$arrData = array($this->intIdUser,$this->strCodigo, $this->strFecha,$this->strHoraInicio); 
		$request = $this->insert($sql,$arrData);
		return $request;
	}
    // obtener proveedores
    public function selectProveedores(){
		$sql = "SELECT * FROM table_proveedor";
		$request = $this->select_all($sql);
		return $request;
	}
	// insertar proveedor
	public function insertProveedor(string $srtIdentificacion, string $strEmpresa, string $strNombre,string $strEmail, string $intTlf){
		$this->srtIdentificacion = $srtIdentificacion;
		$this->strEmpresa = $strEmpresa;
		$this->strNombre = $strNombre;
		$this->strEmail = $strEmail;
		$this->intTlf = $intTlf;

		$sql = "SELECT * FROM table_proveedor WHERE rif_proveedor = '$this->srtIdentificacion'";
		$request = $this->select_all($sql);
		//validar si ya existe si no hace el insert
		if(empty($request)){
			// $return = "vacio";
			$sql = "INSERT INTO table_proveedor(rif_proveedor,empresa_proveedor,responsable_proveedor,email_proveedor,tlf_proveedor,status_proveedor) 
				VALUES (?,?,?,?,?,?)";
			$arrData = array($this->srtIdentificacion,$this->strEmpresa,$this->strNombre,$this->strEmail,$this->intTlf,1);
			$request_insert = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
			$return = $request_insert;//retorna el id insertado
			
		}else{
			$return = 0;
		}
		return $return;
	}
	//eliminar proveedor/
	public function deleteProveedor(int $intIdProveedor){
		$this->intIdProveedor = $intIdProveedor;
		$sql = "UPDATE table_proveedor SET status_proveedor = ? WHERE id_proveedor = $this->intIdProveedor";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		return $request;
	}
	//eliminar proveedor/
	public function statusProveedor(int $intProveedor, int $intStatus){
		$this->intProveedor = $intProveedor;
		$this->intStatus = $intStatus;
		$sql = "UPDATE table_proveedor SET status_proveedor = ? WHERE id_proveedor = $this->intProveedor";
		$arrData = array($this->intStatus);
		$request = $this->update($sql,$arrData);
		if($this->intStatus == 1){
			$request = "1";
		}else{
			$request = "2";
		}
		return $request;
	}
}    