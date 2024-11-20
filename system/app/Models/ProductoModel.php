<?php
class ProductoModel extends Mysql {

	public function __construct(){
	//heradar la clase padre 
		parent::__construct();
	}
    /********** funcion para traer los modelos **********/
	public function selectEnlace(){
		$sql = "SELECT * FROM table_enlace_producto";
		$request = $this->select_all($sql);
		return $request;
	}
    /********** funcion para traer los proveedores **********/
	public function selectProvee(){
		$sql = "SELECT * FROM table_proveedor WHERE status_proveedor = 1";
		$request = $this->select_all($sql);
		return $request;
	}
    /********** funcion para traer las ubicaciones para el almacenado de los articulos **********/
	public function selectUbic(){
		$sql = "SELECT * FROM table_ubicacion";
		$request = $this->select_all($sql);
		return $request;
	}
    // insertar proveedor
	public function insertProducto(string $srtArticlo,int $intModelo, int $intProveedor, int $intUbicacion, string $srtCant, int $intOptionArticulo, string $strPresentArticulo){
		$this->srtArticlo = $srtArticlo;
		$this->intProveedor = $intProveedor;
		$this->intUbicacion = $intUbicacion;
		$this->srtCant = $srtCant;
		$this->intModelo = $intModelo;
		$this->strPresentArticulo = $strPresentArticulo;
		$this->intOptionArticulo = $intOptionArticulo;

		$sql = "SELECT * FROM table_producto WHERE producto = '$this->srtArticlo' AND id_enlace_producto = $this->intModelo";
		$request = $this->select_all($sql);
		//validar si ya existe si no hace el insert
		if(empty($request)){
			// $return = "vacio";
			$sql = "INSERT INTO table_producto(id_enlace_producto,id_ubicacion,producto,tag_producto,present_producto,status_producto) 
				VALUES (?,?,?,?,?,?)";
			$arrData = array($this->intModelo,$this->intUbicacion,$this->srtArticlo,$this->intOptionArticulo,$this->strPresentArticulo,1);
			$request_insert = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
			$return = $request_insert;//retorna el id insertado
			if($return > 0){
                $sql1 = "INSERT INTO table_relacion_producto(id_producto,id_proveedor,cant_producto)
                VALUES(?,?,?)";
                $arrData1 = array($request_insert,$this->intProveedor,$this->srtCant);
                $request_insert = $this->insert($sql1,$arrData1);//enviamos el query y el array de datos 
            }
		}else{
			$return = 0;
		}
		return $return;
	}
    // cargar todos los productos para mostrarlos en la tabla
    public function getProductos(){
        $sql = "SELECT  producto.*, proveedor.*, relacionP.*, ubicacion.*, enlace.enlace_producto FROM table_producto producto 
                INNER JOIN table_relacion_producto relacionP ON  producto.id_producto = relacionP.id_producto
                INNER JOIN table_proveedor proveedor ON proveedor.id_proveedor = relacionP.id_proveedor
                INNER JOIN table_ubicacion ubicacion ON ubicacion.id_ubicacion = producto.id_ubicacion
                INNER JOIN table_enlace_producto enlace ON enlace.id_enlace_producto = producto.id_enlace_producto
                WHERE producto.status_producto = 1";
		$request = $this->select_all($sql);
		return $request;
    }
    //cargar los productos en un select
    public function selectListProductos(){
        $sql = "SELECT * FROM table_producto WHERE status_producto = 1";
		$request = $this->select_all($sql);
		return $request;
    }
    //cargar los datos de un producto seleccionado
    public function selectProducto(int $idProducto){
        $this->idProducto = $idProducto;
        $sql = "SELECT a.*, ra.*,pr.*, ub.* FROM table_producto a 
                INNER JOIN table_relacion_producto ra ON  a.id_producto = ra.id_producto
                INNER JOIN table_proveedor pr ON pr.id_proveedor = ra.id_proveedor
                INNER JOIN table_ubicacion ub ON ub.id_ubicacion = a.id_ubicacion
                WHERE a.id_producto = $this->idProducto  AND a.status_producto = 1 ";
		$request = $this->select($sql);
		return $request;
    }
    //actualizar cantidad de productos
    public function upCantProducto(int $intIdProducto,string $srtCantNew){
        $this->intIdProducto = $intIdProducto;
        $this->srtCantNew = $srtCantNew;
        $sql = "UPDATE table_relacion_producto SET cant_producto = ? WHERE id_producto = $this->intIdProducto";
        $arrData = array($this->srtCantNew);
        $request = $this->update($sql,$arrData);
        return $request;
    }
	// eliminar productos
	public function delProducto(int $intIdProducto){
		$this->intIdProducto = $intIdProducto;
		$sql = "UPDATE table_producto SET status_producto = ? WHERE id_producto = $this->intIdProducto";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		return $request;
	}
	
}