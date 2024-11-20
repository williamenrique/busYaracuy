<?php
header('Access-Control-Allow-Origin: *');
class Personal extends Controllers{

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
	public function personal(){
		$data['page_tag'] = "PERSONAL";
		$data['page_title'] = "Personal";
		$data['page_name'] = "Personal";
		$data['page_link'] = "active-user";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-user";//abrir el desplegable
		$data['page_link_acitvo'] = "link-personal";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.personal.js";
		$this->views->getViews($this, "personal", $data);
	}
	/*************insertar personal***************/
	public function setPersonal(){
		if($_POST){ 
			// $idUser = intval($_POST['idUsuario']);
			$intIdentificacion = $_POST['txtCedula'];
			$strTxtNombre = strtoupper(strClean($_POST['txtNombre']));//convierte las primeras letras en mayusculas
			$intTxtTlf = $_POST['txtTelefono'];
			// $intListStatus = intval($_POST['listStatus']);
			$intlistRolId = intval($_POST['listCargo']);
			$intTagPersonal = intval($_POST['listTagPersonal']);
			if(empty($_POST['txtCedula']) || empty($_POST['txtNombre'] ) ||	empty($_POST['txtTelefono']) || empty($_POST['listCargo'])) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos");
			}else{
				// campos llenos proseguimos
				//al generar el pass se envia al modelo
				$requestUser = $this->model->insertPersonal($intIdentificacion, $strTxtNombre, $intlistRolId, $intTxtTlf,$intTagPersonal,1);
				// evaluamos si ya existe
				if($requestUser > 0){
					$arrResponse = array("status" => true, "msg" => "Ingresado correctamente");
				}else{
						$arrResponse = array("status" => false, "msg" => "Ocurrio un error");
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/*************obtener personal***************/
	public function getPersonal(){
		$arrData = $this->model->selectPersonal();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			if($_SESSION['userData']['id_departamento'] == "1"){
				if ($arrData[$i]['personal_status'] == 0) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-danger" onClick="fntStatus(0,'.$arrData[$i]['id_personal'].')">Inactivo</a>';
				}
				if ($arrData[$i]['personal_status'] == 1) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-success" onClick="fntStatus(1,'.$arrData[$i]['id_personal'].')">Activo</a>';
				}
				if ($arrData[$i]['personal_status'] == 2) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(2,'.$arrData[$i]['id_personal'].')">Vacaciones</a>';
				}
				if ($arrData[$i]['personal_status'] == 3) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(3,'.$arrData[$i]['id_personal'].')">Reposo</a>';
				}
				$arrData[$i]['id_personal'] ='<a href=flota/unidad/?unidad='.$arrData[$i]['id_personal'].' title="Ver">'.$arrData[$i]['id_personal'].'</a>';
			}else{
				if ($arrData[$i]['personal_status'] == 0) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px;" class="badge badge-danger")">Inactivo</a>';
				}
				if ($arrData[$i]['personal_status'] == 1) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px;" class="badge badge-success")">Activo</a>';
				}
				if ($arrData[$i]['personal_status'] == 2) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px;" class="badge badge-warning")">Vacaciones</a>';
				}
				if ($arrData[$i]['personal_status'] == 3) {
					$arrData[$i]['personal_status'] = '<a style="font-size: 15px;" class="badge badge-info")">Reposo</a>';
				}
			}
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/*************obtener cargos***************/
	public function getSelectCargo(){
		$htmlOptions = "";
		$arrData = $this->model->selectCargo();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_cargo'].'">'.$arrData[$i]['cargo'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/*************cambiar estado del personal***************/
	public function statusPersonal(){
		if($_POST){
			$idPersonal = intval($_POST['idPersonal']);
			$idStatus = intval($_POST['idStatus']);
			$srtText = strtoupper($_POST['srtText']);
			$intUserId = $_SESSION['userData']['user_id'];
			$requestStatus = $this->model->statusPersonal($idPersonal,$idStatus);
			// ingresar un historial de cambios
			if($requestStatus){
				$requestCambioStatus = $this->model->cambioStatusPersonal($idPersonal,$idStatus,$srtText,$intUserId);
				if($idStatus == 0){
					$arrResponse = array('status' => true, 'msg' => 'Personal no labora ', 'estado' => 0);
				}else if($idStatus == 1){
					$arrResponse = array('status' => true, 'msg' => 'Personal Activo','estado' => 1);
				}else if($idStatus == 2){
					$arrResponse = array('status' => true, 'msg' => 'Personal de Vacaciones','estado' => 2);
				}else if($idStatus == 3){
					$arrResponse = array('status' => true, 'msg' => 'Personal de Reposo','estado' => 3);
				}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar estado del personal');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/********** cambiar el status y agregar texto**********/
	public function cambioStatusPersonal(int $intPersonal, int $intStatus, string $srtText, int $intUserId){
		//asignamos las propiedades a las variable
		$return = "";
		$this->intPersonal = $intPersonal;
		$this->intStatus = $intStatus;
		$this->srtText = $srtText;
		$this->intUserId = $intUserId;
		$sql =  "INSERT INTO table_cambiostatuspersonal (id_personal, idStatus,textCambio,user_id) VALUES (?,?,?,?)";
		$arrData = array($this->intPersonal,$this->intStatus,$this->srtText,$this->intUserId);// armamos el array con los datos obtenidos
		$request = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
		return $request;
	}

}