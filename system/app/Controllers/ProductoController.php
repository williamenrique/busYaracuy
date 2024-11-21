<?php
header('Access-Control-Allow-Origin: *');
class Producto extends Controllers{

	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'login');
		}
		parent::__construct();
	}
	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function producto(){
		$data['page_tag'] = "ARTICULO";
		$data['page_title'] = "Plantilla";
		$data['page_name'] = "Articulo";
		$data['page_link'] = "active-producto";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-producto";//abrir el desplegable
		$data['page_link_acitvo'] = "link-producto";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.producto.js";
		$this->views->getViews($this, "producto", $data);
	}
	// obtener los modelos y cargarlos en una lista y enlazarlo con el articulo entrante
	public function getSelectEnlace(){
		$htmlOptions = "";
		$arrData = $this->model->selectEnlace();
		$htmlOptions = "<option value='0'>ENLACE ARTICULO</option>";
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_enlace_producto'].'">'.$arrData[$i]['enlace_producto'].'</option>';
			}
		}else{
			$htmlOptions = "<option value='0'>NO HAY REGISTROS</option>";
		}
		echo $htmlOptions;
		die();
	}
	// obtener los modelos y cargarlos en una lista 
	public function getSelectUbic(){
		$htmlOptions = "";
		$htmlOptions = "<option value='0'>UBICACION</option>";
		$arrData = $this->model->selectUbic();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_ubicacion'].'">'.$arrData[$i]['ubicacion'].'</option>';
			}
		}else{
			$htmlOptions = "<option value='0'>NO HAY REGISTROS</option>";
		}
		echo $htmlOptions;
		die();
	}
	// obtener los proveedores y cargarlos en una lista 
	public function getSelectProvee(){
		$htmlOptions = "";
		$arrData = $this->model->selectProvee();
		$htmlOptions = "<option value='0'>PROVEEDOR</option>";
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_proveedor'].'">'.$arrData[$i]['empresa_proveedor'].', '.$arrData[$i]['responsable_proveedor'].'</option>';
			}
		}
		else{
			$htmlOptions = "<option value='0'>NO HAY REGISTROS</option>";
		}
		echo $htmlOptions;
		die();
	}
	// ingresar un nuevo producto
	public function setProducto(){
		if($_POST){
			$srtArticlo = strtoupper($_POST['txtArticulo']);
			$intProveedor = intval($_POST['listProveedor']);
			$intUbicacion = intval($_POST['listUbicacion']);
			$intListEnlace = intval($_POST['listEnlace']);
			$intOptionArticulo = intval($_POST['optionsArticulo']);
			$strOptionPresentacion = strtoupper($_POST['optionsPresentacion']);
			$srtCant = $_POST['txtCantidad'];
			if(empty($_POST['txtArticulo']) || $_POST['listProveedor'] == "0"|| $_POST['listUbicacion'] == "0" ||
			 empty($_POST['txtCantidad'])) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos");
			}else{
				$request = $this->model->insertProducto($srtArticlo,$intListEnlace,$intProveedor,$intUbicacion,$srtCant,$intOptionArticulo,$strOptionPresentacion);
				if($request >= '1'){
					$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente (COD-'.$request.')'); 
				}else if($request == 0 ){
					$arrResponse = array('status'=> false,'msg' => "Articulo ya existente"); 
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	// obtener todos los productos para la tabla
	public function getProductos(){
		// <button type="button" class="btn btn-secondary btn-sm btnViewUser" onClick="fntViewProduct('.$arrData[$i]['id_producto'].')" title="Ver"><i class="far fa-eye" aria-hidden="true"></i></button>
		$htmlOptions = "";
		$arrData = $this->model->getProductos();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				if($arrData[$i]['cant_producto'] < 1)
				$arrData[$i]['ubicacion'] = $arrData[$i]['ubicacion'];
				$arrData[$i]['opciones'] ='<div class="">
											<button type="button" class="btn btn-danger btn-sm btnDelUser" onClick="fntDelProduct('.$arrData[$i]['id_producto'].')" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
										</div>';
				if($arrData[$i]['cant_producto'] == 0){
					$arrData[$i]['cant_producto'] = '<span class="badge bg-danger">SIN STOCK</span>';
				}
				else if(($arrData[$i]['cant_producto'] >= 1) && ($arrData[$i]['cant_producto'] <= 5)){
					// $arrData[$i]['cant_producto'] = '<span class="badge bg-warning">'.$arrData[$i]['cant_producto'].'</span>';
					$arrData[$i]['cant_producto'] = '<span class="">'.$arrData[$i]['cant_producto'].' '.$arrData[$i]['present_producto'].'</span>';
				}
				else if($arrData[$i]['cant_producto'] > 5){
					// $arrData[$i]['cant_producto'] = '<span class="badge bg-info">'.$arrData[$i]['cant_producto'].'</span>';
					$arrData[$i]['cant_producto'] = '<span class="">'.$arrData[$i]['cant_producto'].' '.$arrData[$i]['present_producto'].'</span>';
				}
										
			}
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	//obtener todos los productos para las listas
	public function getListProductos(){
		$htmlOptions = "";
		$arrData = $this->model->selectListProductos();
		$htmlOptions = "<option value='0'>SELECCIONEE</option>";
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_producto'].'">COD 0'.$arrData[$i]['id_producto'].' - '.$arrData[$i]['producto'].'</option>';
			}
		}else{
			$htmlOptions = "<option value='0'>NO HAY REGISTROS</option>";
		}
		echo $htmlOptions;
		die();
	}
	// obtener un producto
	public function getProducto(int $idProdcucto){
		$idProdcucto = intval($idProdcucto);
		if($idProdcucto > 0){
			$arrData = $this->model->selectProducto($idProdcucto);
			if(empty($arrData)){
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
			}else{
				// $fecha = array('fecha_reg'=> formatear_fecha($arrData['fechaRegistro']));
				// $data = $arrData + $fecha;
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	//actualizar cantidad un producto
	public function updateProducto(){
		if($_POST){
			$intIdProducto = intval($_POST['listArticuloExistente']);
			$srtCantActual = $_POST['txtCantidadActual'];
			$srtCantNueva = $_POST['txtCantidadMas'];
			if(empty($_POST['txtCantidadMas']) || $_POST['listArticuloExistente'] == "0" ) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos");
			}else{
				$nueva_cant = $srtCantActual + $srtCantNueva;
				$request = $this->model->upCantProducto($intIdProducto,$nueva_cant);
				if($request ){
					$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente '); 
				}else{
					$arrResponse = array('status'=> false,'msg' => "Articulo ya existente"); 
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	// eliminar articulo
	public function delProducto(){
		if($_POST){
			$idProducto = intval($_POST['idProducto']);
			$requestDel = $this->model->delProducto($idProducto);
			if($requestDel){
				$arrResponse = array('status' => true, 'msg' => 'Producto eliminado');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}