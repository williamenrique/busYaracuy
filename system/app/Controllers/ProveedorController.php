<?php
header('Access-Control-Allow-Origin: *');
class Proveedor extends Controllers{

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
	public function proveedor(){
		$data['page_tag'] = "PROVEEDOR";
		$data['page_title'] = "Proveedor";
		$data['page_name'] = "Proveedor";
		$data['page_link'] = "active-proveedor";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-proveedor";//abrir el desplegable
		$data['page_link_acitvo'] = "link-proveedor";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.proveedor.js";
		$this->views->getViews($this, "proveedor", $data);
	}
	/********** funcion ingresar un proveedor **********/
	public function setProveedor(){
		if($_POST){
			$intIdentificacion = strtoupper($_POST['txtIdProveedor']);
			$strEmpresa = strtoupper($_POST['txtEmpresa']);
			$strNombre = strtoupper(strClean($_POST['txtNombre']." ".$_POST['txtApellido']));
			$intTlf = intval(strClean($_POST['txtTelefono']));
			$strEmail = strtolower($_POST['txtEmail']);
			if(empty($_POST['txtIdProveedor']) || empty($_POST['txtEmpresa'] )|| empty($strNombre) ||
				empty($_POST['txtTelefono']) || empty($_POST['txtEmail'])) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos");
			}else{
				$request = $this->model->insertProveedor($intIdentificacion,$strEmpresa,$strNombre,$strEmail,$intTlf);
				if($request >= '1'){
					$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente '.$request); 
				}else if($request == 0 ){
					$arrResponse = array('status'=> false,'msg' => "Militante ya agregado"); 
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/********** funcion para llamar a los proveedores **********/
	public function getProveedores(){
		$arrData = $this->model->selectProveedores();
		for ($i=0; $i < count($arrData) ; $i++) {
			//$arrData[$i]['rol_name'] = '<a style="font-size: 15px; cursor:pointer" onclick="fntEditUser('.$arrData[$i]['user_id'].')">'.$arrData[$i]['rol_name'].'</a>';
			if ($arrData[$i]['status_proveedor'] == 1) {
				$arrData[$i]['status_proveedor'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(2,'.$arrData[$i]['id_proveedor'].')">Activo</a>';
			}else{
				$arrData[$i]['status_proveedor'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(1,'.$arrData[$i]['id_proveedor'].')">Inactivo</a>';
			}
			$arrData[$i]['opciones'] ='<div class="">
											<button type="button" class="btn btn-danger btn-sm btnDelUser" onClick="fntDelProveedor('.$arrData[$i]['id_proveedor'].')" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
										</div>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	//eliminar proveedor
	public function delProveedor(){
		if($_POST){
			$idProveedor = intval($_POST['idProveedor']);
			$requestDel = $this->model->deleteProveedor($idProveedor);
			if($requestDel){
				$arrResponse = array('status' => true, 'msg' => 'Proveedor eliminado');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	//deshabilitar proveedor
	public function statusProveedor(){
		if($_POST){
			$status = intval($_POST['status']);
			$idProveedor = intval($_POST['idProveedor']);
			$requestStatus = $this->model->statusProveedor($idProveedor,$status);
			if($requestStatus){
				if($requestStatus == 1){
				$arrResponse = array('status' => true, 'msg' => 'Proveedor Habilitado', 'estado' => 1);
			}else if($requestStatus == 2){
				$arrResponse = array('status' => true, 'msg' => 'Proveedor Deshabilitado','estado' => 2);
			}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar status');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	} 
}