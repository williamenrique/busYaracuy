<?php
header('Access-Control-Allow-Origin: *');
class Usuarios extends Controllers{

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
	public function usuarios(){
		$data['page_tag'] = "USUARIOS";
		$data['page_title'] = "USUARIOS";
		$data['page_name'] = "Usuarios";
		$data['page_link'] = "active-user";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-user";//abrir el desplegable
		$data['page_link_acitvo'] = "link-user";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.user.js";
		$this->views->getViews($this, "usuarios", $data);
	}
	/******** funcion para insertar usuario ********/
	public function setUser(){
		if($_POST){
			$intIdentificacion = intval(strClean($_POST['txtIdPersonal']));
			$strNombre = ucwords(strClean($_POST['txtNombre']));
			$strApellidos = ucwords(strClean($_POST['txtApellido']));
			$intTlf = intval(strClean($_POST['txtTelefono']));
			$strEmail = strtolower($_POST['txtEmail']);
			$intlistRolId = intval($_POST['listRolId']);
			$intlistDep = intval($_POST['listDep']);
			if(empty($_POST['txtIdPersonal']) || empty($_POST['txtNombre'] )|| empty($_POST['txtApellido'] ) ||
				empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolId'])) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos");
			}else{
				// campos llenos proseguimos
				$strPass = encryption(123456);
				//al generar el pass se envia al modelo
				$requestUser = $this->model->insertUser($intIdentificacion, $strNombre, $strApellidos, $intTlf, $strEmail, $intlistRolId,$intlistDep, $strPass);
				// evaluamos si ya existe
				if($requestUser == 0){
					$arrResponse = array("status" => false, "msg" => "Usuario existente");
				}else{
					//opcion para actualizar el nick al crearse el usuario
					$userNIck = substr($strNombre,0,1).substr($strApellidos,0,1).'-0'.$requestUser;
					$fileBase = "storage/". $userNIck . "/";
					// creo carpeta en servidor si no existe
					if (!file_exists($fileBase))
					mkdir($fileBase, 0777, true);
					$createNick= $this->model->createNick($requestUser, $intIdentificacion,$strEmail, $userNIck,$intlistRolId,$fileBase,$intlistDep);
					$arrResponse = array("status" => true, "msg" => "Usuario creado");
					$source ="src/img/default.png";
					$destination = 'storage/'.$userNIck.'/default.png';
					copy($source, $destination);
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/******** obtener roles ********/
	public function getSelectRoles(){
		$htmlOptions = "";
		$arrData = $this->model->selectRoles();
		$htmlOptions = "<option value='0'>ROLES</option>";
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['rol_id'].'">'.$arrData[$i]['rol_name'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/**********funcion de listar todos los departamentos**********/
	public function getSelectDep(){
		$htmlOptions = "";
		$arrData = $this->model->selectDep();
		$htmlOptions = "<option value='0'>DEPARTAMENTO</option>";
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_departamento'].'">'.$arrData[$i]['departamento'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/******* funcion para llamar a los usuarios ********/
	public function getUsers(){
		$arrData = $this->model->selectUsers();
		for ($i=0; $i < count($arrData) ; $i++) {
			$arrData[$i]['rol_name'] = '<a style="font-size: 15px; cursor:pointer" onclick="fntEditUser('.$arrData[$i]['user_id'].')">'.$arrData[$i]['rol_name'].'</a>';
			if ($arrData[$i]['user_status'] == 1) {
				$arrData[$i]['user_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(2,'.$arrData[$i]['user_id'].')">Activo</a>';
			}else{
				$arrData[$i]['user_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(1,'.$arrData[$i]['user_id'].')">Inactivo</a>';
			}
			$arrData[$i]['opciones'] ='<div class="">
											
											<button type="button" class="btn btn-danger btn-sm btnDelUser" onClick="fntDelUser('.$arrData[$i]['user_id'].')" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
										</div>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/******* eliminar usuario ********/
	public function delUser(){
		if($_POST){
			$idUser = intval($_POST['idUser']);
			$requestDel = $this->model->deleteUser($idUser);
			if($requestDel){
				$arrResponse = array('status' => true, 'msg' => 'Usuario eliminado');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/******* deshabilitar usuario ********/
	public function statusUser(){
		if($_POST){
			$statusUser = intval($_POST['status']);
			$idUser = intval($_POST['idUser']);
			$requestStatus = $this->model->statusUser($idUser,$statusUser);
			if($requestStatus){
				if($requestStatus == 1){
				$arrResponse = array('status' => true, 'msg' => 'Usuario Habilitado', 'estado' => 1);
			}else if($requestStatus == 2){
				$arrResponse = array('status' => true, 'msg' => 'Usuario Deshabilitado','estado' => 2);
			}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar status');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	*/
	public function perfil(){
		$data['page_tag'] = "Perfil de usuario";
		$data['page_title'] = "PERFIL USUARIO";
		$data['page_name'] = "perfil";
		$data['page_menu'] = "";
		$data['page_link'] = "usuario";
		$data['page_menu_open'] = "";
		$data['page_link_acitvo'] = "";
		$data['page_functions'] = "function.user.js";
		$this->views->getViews($this, "perfil", $data);
	}
		/********* actualizar perfil del usuario*********/
		public function UpdatePerfil(){
			if($_POST){
				//validamos si no existe algun valor
				if($_POST['opcion'] == 1){
					if(empty($_POST['textNombres']) || empty($_POST['textApellidos'] ) || empty($_POST['textTlf'])) {
						$arrResponse = array("status" => false, "msg" => "Datos Incorrectos");
					}else{
						$idUser = intval($_POST['textId']);
						$strTxtNombre = ucwords($_POST['textNombres']);//convierte las primeras letras en mayusculas
						$strtxtApellidos = ucwords($_POST['textApellidos']);//convierte las primeras letras en mayusculas
						$intTxtTlf = $_POST['textTlf'];
						$strTxtEmail = strtolower($_POST['textEmail']);//convierte todas las letras en minusculas
						$strTxCi = $_POST['textCi'];
						$strTxtNick = "a";
						$intOption = 1;
						$strTxtPass = "a";
						$filebase = "a";
						$requestUser = $this->model->updatePerfil($idUser, $strTxtNombre, $strtxtApellidos, $intTxtTlf,$strTxCi,$strTxtEmail, $strTxtPass, $strTxtNick ,$intOption,$filebase);
						//comprovamos la existencia del usuario si no se actualiza correctamente
						if($requestUser > 0){
							$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
							sessionUser($_SESSION['idUser']);
						}else{
							$arrResponse = array("status" => false, "msg" => "No es posible almacenar ls datos");
						}
					}
				}else	
				if($_POST['opcion'] == 2){
					if(empty($_POST['textNick'])) {
						$arrResponse = array("status" => false, "msg" => "Campo nick debe llenarlo");
					}else{
						$idUser = intval($_POST['textId']);
						$strTxtNombre = ucwords('a');//convierte las primeras letras en mayusculas
						$strtxtApellidos = ucwords('a');//convierte las primeras letras en mayusculas
						$intTxtTlf = intval(1);
						$strTxtEmail = strtolower($_POST['textEmail']);//convierte todas las letras en minusculas
						$strTxCi = $_POST['textCi'];
						$strTxtNick = $_POST['textNick'];
						$intOption = 2;
						$strTxtPass = "a";
						$filebase = "a";
						$requestUser = $this->model->updatePerfil($idUser, $strTxtNombre, $strtxtApellidos, $intTxtTlf,$strTxCi,$strTxtEmail, $strTxtPass, $strTxtNick, $intOption,$filebase);
						
						//comprovamos la existencia del usuario si no se actualiza correctamente
						if($requestUser > 0){
							$arrResponse = array("status" => true, "msg" => "Cambio de usuario correcto");
							sessionUser($_SESSION['idUser']);
						}else if($requestUser == "exist"){
							$arrResponse = array("status" => false, "msg" => "Usuario seleccionado ya esta en uso");
						}else{
							$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos");
						}
					}
				}else	if($_POST['opcion'] == 3){
					if(empty($_POST['textPassConfirm'])) {
						$arrResponse = array("status" => false, "msg" => "Clave no puede estar vacia");
					}else if($_POST['textPass'] == $_POST['textPassConfirm']){
						$idUser = intval($_POST['textId']);
						$strTxtNombre = "a";//convierte las primeras letras en mayusculas
						$strtxtApellidos = "a";//convierte las primeras letras en mayusculas
						$intTxtTlf = 1;
						$strTxtEmail = strtolower($_POST['textEmail']);//convierte todas las letras en minusculas
						$strTxCi = $_POST['textCi'];
						$strTxtNick = "a";
						$intOption = 3;
						$fileBase= "a";
						$strTxtPass = encryption($_POST['textPassConfirm']) ;
						$requestUser = $this->model->updatePerfil($idUser, $strTxtNombre, $strtxtApellidos, $intTxtTlf,$strTxCi,$strTxtEmail, $strTxtPass, $strTxtNick, $intOption,$fileBase);
						//comprovamos la existencia del usuario si no se actualiza correctamente
						if($requestUser > 0){
							$arrResponse = array("status" => true, "msg" => "Cambio de password correctamente");
						}else{
							$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos");
						}
					}else{
						$arrResponse = array("status" => false, "msg" => "Claves no coinciden");
					}
				}
				// sessionUser($_SESSION['idUser']);
				//convertir los datos en una array JSON para poder leerlos en javascript
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		/********* cambiar imagen de usuario*********/
		public function subirImagen(){
			$arrResponse =array();
			$archivos_permitidos = array('pdf', 'jpg', 'png', 'svg');
			// capturo las partes del nombre del archivo
			$fileData = pathinfo($_FILES['file']['name']);
			$path_info =  './storage/' . $_FILES['file']['name'];
			if(!$_FILES['file']['name'] == null){
				$max_size = 90000;
				$fileExtension = strtolower($fileData['extension']);
				if(!in_array($fileExtension, $archivos_permitidos)){
					$arrResponse = ["status" => false, "msg" => "No se acepta ese tipo de formato"];
				}elseif ($_FILES['file']['size'] > $max_size) {
					$arrResponse = ["status" => false, "msg" => "Imagen demasiado grande tamaño permitido 300x300"];
				}else{
					$arrResponse = ["status" => true, "msg" => "Hasta aqui bien"];
					$fileBase =  'storage/' . $_SESSION['userData']['user_nick'].'/';
					$fileHash = substr(md5($fileBase . uniqid(microtime() . mt_rand())), 0, 8);
	
					if (!file_exists($fileBase))
					mkdir($fileBase, 0777, true);
					$filePath = $fileBase . $_SESSION['idUser'].'-'. $fileHash . "." . $fileExtension;
					if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath)){
						$arrResponse = ["status" => true, "msg" => "Archivo guardado con exito"];
						$requestUser = $this->model->updateImg($_SESSION['idUser'], $fileBase.$_SESSION['idUser'].'-'. $fileHash . "." . $fileExtension);
						$deleteImg = unlink($_SESSION['userData']['user_img']);
						sessionUser($_SESSION['idUser']);
					}else{
						$arrResponse = ["status" => false, "msg" => "Ah ocurrido un error al guardar"];
					}
				}
			}else{
				$arrResponse = ["status" => false, "msg" => "Ah ocurrido un error"];
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}
}