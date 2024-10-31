<?php
header('Access-Control-Allow-Origin: *');
class Flota extends Controllers{

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
	public function flota(){
		$data['page_tag'] = "FLOTA";
		$data['page_title'] = "FL";
		$data['page_name'] = "Flota";
		$data['page_link'] = "active-unidades";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-unidades";//abrir el desplegable
		$data['page_link_acitvo'] = "link-flota";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "flota", $data);
	}
	/********** listar todos las unidades para la tabla**********/
	public function getFlota(){
		$arrData = $this->model->selectFlota();
			//recorrer el arreglo para colocara el status
			for ($i=0; $i < count($arrData) ; $i++) {
				if($_SESSION['userData']['rol_id'] == 1 OR $_SESSION['userData']['rol_id'] == 2){

					if ($arrData[$i]['status_unidad'] == 0) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-danger" onClick="fntStatus(0,'.$arrData[$i]['id_flota'].')">Desincorporado</a>';
					}
					if ($arrData[$i]['status_unidad'] == 1) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-success" onClick="fntStatus(1,'.$arrData[$i]['id_flota'].')">Operativo</a>';
					}
					if ($arrData[$i]['status_unidad'] == 2) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning">Mantenimiento</a>';
					}
					if ($arrData[$i]['status_unidad'] == 3) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(3,'.$arrData[$i]['id_flota'].')">Inoperativo</a>';
					}
					if ($arrData[$i]['status_unidad'] == 4) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(4,'.$arrData[$i]['id_flota'].')">Critca</a>';
					}
				}else{
					if ($arrData[$i]['status_unidad'] == 0) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px;" class="badge badge-danger" >Desincorporado</a>';
					}
					if ($arrData[$i]['status_unidad'] == 1) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px;" class="badge badge-success" >Operativo</a>';
					}
					if ($arrData[$i]['status_unidad'] == 2) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px;" class="badge badge-warning">Mantenimiento</a>';
					}
					if ($arrData[$i]['status_unidad'] == 3) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px;" class="badge badge-info" >Inoperativo</a>';
					}
					if ($arrData[$i]['status_unidad'] == 4) {
						$arrData[$i]['status_unidad'] = '<a style="font-size: 15px;" class="badge badge-warning" ">Critca</a>';
					}
				}
				$arrData[$i]['id_unidad'] ='<a href=flota/unidad/?unidad='.$arrData[$i]['id_flota'].' title="Ver">'.$arrData[$i]['id_unidad'].'</a>';
			}
		
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/********** listar todos las marcas de unidades **********/
	public function getSelectMarca(){
		$htmlOptions = "";
		$arrData = $this->model->selectMarca();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['rol_id'].'">'.$arrData[$i]['rol_name'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/********** listar todos los modelos de unidades **********/
	public function getSelectModelo(){
		$htmlOptions = "";
		$arrData = $this->model->selectModelos();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_modelo'].'">'.$arrData[$i]['modelo_unidad'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/********** guardar unidad en flota **********/
	public function setUnidad(){
		//almacenar los datos en variables
		// $intIdUnidad = intVal($_POST['idUnidad']);
		$srtIdUnidad = $_POST["txtIdUnidad"];
		$intMarcaUnidad = intval($_POST['listMarcaUnidad']);
		$intModelo = intval($_POST["listModelo"]);
		$strListTransmision = $_POST["listTransmision"];
		$srtVim = strtoupper($_POST["txtVimUnidad"]);
		$srtFechaUnidad = $_POST["txtFechaUnidad"];
		$srtCapacidad = $_POST["txtCapacidad"];
		$srtTipoCombustible = strtoupper($_POST["txtTipoCombustible"]);
		if($srtIdUnidad == "" || $intMarcaUnidad == "" || $intModelo == "" || $strListTransmision =="0" || $srtVim == "" || $srtFechaUnidad == "" || $srtCapacidad == "" || $srtTipoCombustible == "0"){
			$arrResponse = array('status'=> false,'msg' => 'Debe llenar los campos'); 
		}else{
			$request_unidad = $this->model->insertUnidad($srtIdUnidad,$intMarcaUnidad,$intModelo, $srtVim,$srtFechaUnidad,$srtCapacidad,$srtTipoCombustible,$strListTransmision);
			$option = 1;
			if($request_unidad > 0){
			/***************si es mayor a 0 indica que si se ejecuto el query***************/
				$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente'); 
			}else if($request_unidad == "exist"){
				$arrResponse = array('status'=> false,'msg' => '¡Atención esa unidad ya existe.'); 
			}else{
				$arrResponse = array('status'=> false,'msg' => '¡No es posible almacenar los datos.'); 
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	/************* cambiar estado de la unidad ***************/
	public function statusUnidad(){
		if($_POST){
			$idStatus = intval($_POST['idStatus']);
			$idUnidad = intval($_POST['idUnidad']);
			$srtText = strtoupper($_POST['srtText']);
			$intUserId = $_SESSION['userData']['user_id'];
			$requestStatus = $this->model->statusUnidad($idUnidad,$idStatus);
			// ingresar un historial de cambios
			if($requestStatus){
				$requestCambioStatus = $this->model->cambioStatusUnidad($idUnidad,$idStatus,$srtText,$intUserId);
				if($idStatus == 0){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Desincorporada', 'estado' => 0);
				}else if($idStatus == 1){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Operativa','estado' => 1);
				}else if($idStatus == 2){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Mantenimiento','estado' => 2);
				}else if($idStatus == 3){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Inoperativa','estado' => 3);
				}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar estado de unidad');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/* TODO: unidad 
	//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	*/
	public function unidad(){	
		$data['page_tag'] = "FLOTA";
		$data['page_title'] = "FL";
		$data['page_name'] = "Unidad";
		$data['page_link'] = "active-unidades";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-unidades";//abrir el desplegable
		$data['page_link_acitvo'] = "link-mantenimiento";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "unidad", $data);
	}
	/************ obtener informacion de la unidad y mostrarla en el timeline *********************/
	public function getUnidad(int $idUnidad){
		$idUnidad = intval($idUnidad);
		if($idUnidad > 0){
			$htmlOptions = "";
			$arrDataH = $this->model->selectUnidadHM($idUnidad);
			if(empty($arrDataH)){
				$arrData = $this->model->selectUnidadID($idUnidad);
				if($arrData['status_unidad'] == 0){
					$status = '<span class="badge badge-danger">DESINCORPORADO</span>';
				}
				if($arrData['status_unidad'] == 1){
					$status = '<span class="badge badge-success">OPERATIVO</span>';
				}
				if($arrData['status_unidad'] == 2){
					$status = '<span class="badge badge-info">MANTENIMIENTO</span>';
				}
				if($arrData['status_unidad'] == 3){
					$status = '<span class="badge badge-danger">critico</span>';
				}
				$htmlOptions .= '
					<div class="invoice p-3 mb-3">
						<div class="row">
							<div class="col-12">
								<a href='.base_url().'flota/unidadEdit/?unidad='.$arrData['id_flota'].' title="EDITAR"><i class="fas fa-edit text-blue"></i></a>
								<h5>'.$arrData['id_unidad'].' <small class="float-right">CREACION:'.$arrData["fecha_creacion"].'</small></h5>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>VIN   <span class="text-info"> '.$arrData['vim_unidad'].'</span></strong><br>
									<strong>COMBUSTIBLE  '.$arrData['tipo_combustible'].'</strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MODELO  '.$arrData['modelo_unidad'].'</strong><br>
									<strong>CAPACIDAD '.$arrData['cap_pasajero'].'</strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MARCA '.$arrData['marca_unidad'].'</strong><br>
									<strong>'.$status.'</strong><br>
								</address>
							</div>
						</div>
					</div>
				';
				
			}else{
				$arrDataH = $this->model->selectUnidadHM($idUnidad);
				// dep($arrDataH);
				// $arrResponse = array('status' => true, 'msg' => $arrDataH);
				if($arrDataH[0]['status_unidad'] == 0){
					$status = '<span class="badge badge-danger">DESINCORPORADO</span>';
				}
				if($arrDataH[0]['status_unidad'] == 1){
					$status = '<span class="badge badge-success">OPERATIVO</span>';
				}
				if($arrDataH[0]['status_unidad'] == 2){
					$status = '<span class="badge badge-info">MANTENIMIENTO</span>';
					$mantActivo = '
					<form id="mantOut">
					<input type="hidden" name="idMantenimiento" value="'.$arrDataH[0]['id_unidad_mantenimiento'].'">
						<div class="form-row align-items-center">
							<div class="col-sm-6 my-1">
								<label class="sr-only" for="inlineFormInputName">OBSERVACION SALIDA</label>
								<input type="text" class="form-control" placeholder="OBSERVACION SALIDA" id="txtObsSalida" name="txtObsSalida">
							</div>
							<div class="col-sm-2 my-1">
								<label class="sr-only" for="inlineFormInputName">FECHA SALIDA</label>
								<input type="date" class="form-control" placeholder="FECHA SALIDA" id="txtFechaSalida" name="txtFechaSalida">
							</div>
							
							<button type="button" id="btnActionForm" onClick="fntOutMant('.$arrDataH[0]['id_flota'].')" class="btn btn-primary btn-sm">
								</i><span id="btnText">Salir mantenimiento</span>
							</button>
						</div>
					</form>';
				}else{
					$mantActivo = "";
				}
				if($arrDataH[0]['status_unidad'] == 3){
					$status = '<span class="badge badge-danger">CRITICO</span>';
				}
				$htmlOptions .= '
					<div class="invoice p-3 mb-3">
						<div class="row">
							<div class="col-12">
								<a href='.base_url().'flota/unidadEdit/?unidad='.$arrDataH[0]['id_flota'].' title="EDITAR"><i class="fas fa-edit text-blue"></i></a>
								<h5>'.$arrDataH[0]['id_unidad'].' <small class="float-right">CREACION:'.$arrDataH[0]["fecha_creacion"].'</small></h5>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>VIN   <span class="text-info">'  .$arrDataH[0]['vim_unidad'].'</span></strong><br>
									<strong>COMBUSTIBLE  <span class="text-info">'.$arrDataH[0]['tipo_combustible'].'</span></strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MODELO  <span class="text-info">'.$arrDataH[0]['modelo_unidad'].'</span></strong><br>
									<strong>CAPACIDAD <span class="text-info">'.$arrDataH[0]['cap_pasajero'].'</span></strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MARCA '.$arrDataH[0]['marca_unidad'].'</strong><br>
									'.$status.'
								</address>
							</div>
						</div>
						'.$mantActivo.'
					</div>
				';
				$htmlFin = "";
				for ($i=0; $i < count($arrDataH); $i++) {
					$htmlOptions .= '
					<div class="timeline">
						<div class="time-label">
							<span class="bg-red">'.$arrDataH[$i]['fecha_entrada'].'</span>
						</div>
						<div>
							<i class="fas fa-envelope bg-blue"></i>
							<div class="timeline-item">
								<h6 class="time timeline-header" style="font-size: 12px;"><a href="#" class="mr-1">KM: </a> '.$arrDataH[$i]['km_unidad'].'</h5>
								<h6 class="timeline-header" style="font-size: 12px;"><a href="#" class="mr-1">RUTA :</a> '.$arrDataH[$i]['ruta_unidad'].'</h6>
								<div class="timeline-body">
									<strong class="mr-1">MECANICO :</strong><span class="mr-2">'.$arrDataH[$i]['nomb_mecanico'].'</span>
									<strong class="mr-1">OPERADOR :</strong><span>'.$arrDataH[$i]['operardor_unidad'].'</span><br>
									<strong class="mr-1">OBSERVACION OPERADOR :</strong><span class="mr-2">'.$arrDataH[$i]['diagnostico'].'</span>
									<strong class="mr-1">OBSERVACION SUPERVISOR :</strong><span class="mr-2">'.$arrDataH[$i]['diagnostico'].'</span>
									<strong class="mr-1">DIAGNOSTICO :</strong><span class="mr-2">'.$arrDataH[$i]['diagnostico'].'</span><br>
									<strong class="mr-1">RECOMENDACION :</strong><span class="mr-2">'.$arrDataH[$i]['recomendacion'].'</span>
								</div>
								<div class="timeline-footer">
									<strong class="mr-1">OBS SALIDA :</strong><span class="mr-2">'.$arrDataH[$i]['obsSalida'].'</span><br>
									<span class="badge badge-info">'.$arrDataH[$i]['fecha_salida'].'</span>
									<h5>'.$arrDataH[$i]['user_nombres'].' '.$arrDataH[$i]['user_apellidos'].'</h5>
								</div>
							</div>
						</div>
					<div>
						<i class="fas fa-clock bg-gray"></i>
					</div>
				</div>
					';
				}
			}
			echo $htmlOptions;
			die();
		}
	}
	/************ sacar unidad del mantenimiento *********************/
	public function outMantenimiento(int $idUnidad){
		$idUnidad = intval($idUnidad);
		$txtFechaSalida = $_POST['txtFechaSalida'];
		$idMantenimiento = $_POST['idMantenimiento'];
		$txtObsSalida = strtoupper($_POST["txtObsSalida"]);
		if($txtObsSalida == "" || $txtFechaSalida == ""){
			$arrResponse = array('status' => false, 'msg' => 'Debe colocar una fecha');
		}else{
			$requestUpdate = $this->model->outMantenimiento($idUnidad,$txtFechaSalida,$txtObsSalida,$idMantenimiento);
			if($requestUpdate == 1){
				$arrResponse = array('status' => true, 'msg' => 'Salida exitosa');
				$requestUpdateUnidad = $this->model->statusUnidad($idUnidad, 1);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Ah ocurrido un error');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	/*********
	 * TODO: ingreso a mantenimiento
	 * //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion de la vista ingresar mantenimiento 
	 */
	public function ingresar_mant(){
		$data['page_tag'] = "MANTENIMIENTO";
		$data['page_title'] = "FL";
		$data['page_name'] = "Unidad";
		$data['page_link'] = "active-unidades";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-unidades";//abrir el desplegable
		$data['page_link_acitvo'] = "link-mantenimiento";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "ingresar_mant", $data);
	}
	// traer los operadores para cargar un select
	public function getListOper(){
        $htmlOptions = "";
        $arrData = $this->model->selectListOper();
        if(count($arrData) > 0){
            $htmlOptions = "<option value='0'>OPERADOR</option>";
            for ($i=0; $i < count($arrData); $i++) { 
                $htmlOptions .= '<option value="'.$arrData[$i]['personal_nombre'].'">'.$arrData[$i]['personal_nombre'].'</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
	// traer los mecanicos para cargar un select
	public function getListMec(){
        $htmlOptions = "";
        $arrData = $this->model->selectListMec();
        if(count($arrData) > 0){
            $htmlOptions = "<option value='0'>MECANICO</option>";
            for ($i=0; $i < count($arrData); $i++) { 
                $htmlOptions .= '<option value="'.$arrData[$i]['personal_nombre'].'">'.$arrData[$i]['personal_nombre'].'</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
	/*********** obtener unidades en mantenimiento para la tabla *****************/
	public function listUnidadMantenimiento(){
		$arrData = $this->model->selectFlotaMantenimiento();
		//provar que trae el array
		// dep($arrData[0]['rol_status']);exit();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			if ($arrData[$i]['tipo_mantenimiento'] == 'c') {
				$arrData[$i]['tipo_mantenimiento'] = '<span>Correctivo</a>';
			}else {
				$arrData[$i]['tipo_mantenimiento'] = '<span>Preventivo</span>';
			}
			if ($arrData[$i]['fecha_salida'] == '') {
				$arrData[$i]['fecha_salida'] = '<span>En espera</a>';
			}
			$arrData[$i]['id_unidad'] ='<a href=unidad/?unidad='.$arrData[$i]['id_flota'].' title="Ver">'.$arrData[$i]['id_unidad'].'</a>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/************* listar todos unidades para mantenimiento y cargarlo en el select ******************/
	public function getSelectUnidad(){
		$htmlOptions = "";
		$arrData = $this->model->selectUnidad();
		if(count($arrData) > 0){
			$htmlOptions .= '<option selected>UNIDAD</option>';
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_flota'].'">'.$arrData[$i]['id_unidad'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/*************** ingresar unidad a mantenimiento *****************/
	public function setIMantenimiento(){
		$intidUnidad = $_POST['idUnidad'];
		$srtListUnidad = $_POST['listUnidad'];
		$srtRutaUnidad = strtoupper($_POST['txtRutaUnidad']);
		$srtOperador = $_POST['listOperador'];
		$srtMecanico = $_POST['listMecanico'];
		$srtKilometraje = strtoupper($_POST['txtKilometraje']);
		$srtFechaEntrada = $_POST['txtFechaEntrada'];
		$srtObsOper = strtoupper($_POST['txtObsOper']);
		$srtObsSuper = strtoupper($_POST['txtObsSuper']);
		$srtDiagnostico = strtoupper($_POST['txtDiagnostico']);
		$srtRecomendacion = strtoupper($_POST['txtRecomendacion']);
		$srtRadioTipo = $_POST['radioTipo'];
		$intUserId = $_SESSION['userData']['user_id'];
		if($srtListUnidad == "Seleccione Unidad" || $srtRutaUnidad == "" || $srtOperador == "" || $srtMecanico == "" || $srtKilometraje == "" || $srtFechaEntrada == "" || $srtDiagnostico == "" || $srtRecomendacion == ""  || $srtObsOper == ""  || $srtObsSuper == ""){
			$arrResponse = array('status'=> false,'msg' => 'Debe llenar los campos');
		}else{
			$request_ingreso = $this->model->setIMantenimiento($srtListUnidad,$srtRutaUnidad,$srtOperador,$srtMecanico,$srtKilometraje,$srtRadioTipo,$srtFechaEntrada,$srtDiagnostico,$srtRecomendacion,$srtObsOper,$srtObsSuper,$intUserId);
			if($request_ingreso > 0 ){
				$requestStatus = $this->model->statusUnidad($srtListUnidad,2);
				$arrResponse = array('status'=> true,'msg' => 'Unidad en mantenimiento');
			}else{
				$arrResponse = array('status'=> false,'msg' => 'Ah ocurrido un error');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	/*********
	 * TODO: editar unidad
	 * //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion de la vista ingresar mantenimiento 
	 */
	public function unidadEdit(){
		$data['page_tag'] = "MANTENIMIENTO";
		$data['page_title'] = "FL";
		$data['page_name'] = "Unidad";
		$data['page_link'] = "active-unidades";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-unidades";//abrir el desplegable
		$data['page_link_acitvo'] = "link-unidadEdit";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "unidadEdit", $data);
	}
	// obtener una tarjeta de una uniidad en especifico para ser editada
	public function getUnidadEdit(int $idUnidad){
		$arrData = $this->model->getUnidadEdit($idUnidad);
		$arrDataModelo = $this->model->selectModelos();
		$arrDataMarca = $this->model->selectMarca();
		$htmlOptions = "";
		$htmlOptions = '<div class="card">
							<div class="card-body">
								<form id="formUnidadEdit" autocomplete="off">
									<input type="hidden" name="idUnidad" id="idUnidad" value="'.$arrData['id_flota'].'">
									<div class="form-row align-items-center">
										<div class="col-sm-2 my-1">
											<label class="sr-only" for="inlineFormInputName">Id Unidad</label>
											<input type="text" class="form-control" value="'.$arrData['id_unidad'].'"  placeholder="Id de unidad" id="txtIdUnidad" name="txtIdUnidad" readonly>
										</div>
										<div class="col-sm-3 my-1">
											<select id="listMarca" data-live-search="true" name="listMarca" class="form-control"
												data-style="btn-outline-primary" data-size="5">';
												$htmlOptions .= '<option value="'.$arrData['id_marca'].'" selected>'.$arrData['marca_unidad'].'</option>';
									for ($i=0; $i < count($arrDataMarca); $i++) { 
										$htmlOptions .= '<option value="'.$arrDataMarca[$i]['id_marca'].'">'.$arrDataMarca[$i]['marca_unidad'].'</option>';
									}		
						$htmlOptions .=	'	
											</select>
										</div>
										<div class="col-sm-3 my-1">
											<select id="listModelo" data-live-search="true" name="listModelo" class="form-control"
												data-style="btn-outline-primary" data-size="5">';
												$htmlOptions .= '<option value="'.$arrData['id_modelo'].'" selected>'.$arrData['modelo_unidad'].'</option>';
									for ($j=0; $j < count($arrDataModelo); $j++) { 
										$htmlOptions .= '<option value="'.$arrDataModelo[$j]['id_modelo'].'">'.$arrDataModelo[$j]['modelo_unidad'].'</option>';
									}		
						$htmlOptions .=	'	
											</select>
										</div>
								
										<div class="col-sm-3 my-1">
											<label class="sr-only" for="inlineFormInputName">Vim Unidad</label>
											<input type="text" class="form-control" value="'.$arrData['vim_unidad'].'"  placeholder="Vim Unidad" id="txtVimUnidad" name="txtVimUnidad" readonly>
										</div>
										<div class="col-sm-2 my-1">
											<label class="sr-only" for="inlineFormInputName">Fecha Unidad</label> 
											<input type="text" class="form-control" value="'.$arrData['fecha_creacion'].'"  placeholder="Fecha Unidad" id="txtFechaUnidad" name="txtFechaUnidad" readonly>
										</div>
										<div class="col-sm-2 my-1">
											<label class="sr-only" for="inlineFormInputName">Capacidad</label>
											<input type="text" class="form-control" value="'.$arrData['cap_pasajero'].'"  placeholder="Capacidad" id="txtCapacidad" name="txtCapacidad" onkeypress="return soloNumeros(event);">
										</div>
										<div class="col-auto my-1">';
							if($arrData['transmision'] == "SINCRONICO"){
							$htmlOptions .=	'
											<input type="radio" class="btn-check" name="optionTransmision" id="sincronico" value="SINCRONICO" autocomplete="off" checked>
											<label class="btn" for="sincronico">SINCRONICO</label>
											<input type="radio" class="btn-check" name="optionTransmision" id="automatico" value="AUTOMATICO" autocomplete="off">
											<label class="btn" for="automatico">AUTOMATICO</label>
											';
										}else{
							$htmlOptions .=	'
											<input type="radio" class="btn-check" name="optionTransmision" id="sincronico" value="SINCRONICO" autocomplete="off" >
											<label class="btn" for="sincronico">SINCRONICO</label>
											<input type="radio" class="btn-check" name="optionTransmision" id="automatico" value="AUTOMATICO" autocomplete="off" checked>
											<label class="btn" for="automatico">AUTOMATICO</label>
											';
										}
							$htmlOptions .=	'
										</div>
										<div class="col-auto my-1">';
							if($arrData['tipo_combustible'] == "DIESEL"){
							$htmlOptions .=	'			
											<input type="radio" class="btn-check" name="optionCombustible" id="gas" value="G.L.P" autocomplete="off" >
											<label class="btn" for="gas">G.L.P</label>
											<input type="radio" class="btn-check" name="optionCombustible" id="diesel" value="DIESEL" autocomplete="off" checked>
											<label class="btn" for="diesel">DIESEL</label>
										';
									}else{
							$htmlOptions .=	'			
											<input type="radio" class="btn-check" name="optionCombustible" id="gas" value="G.L.P" autocomplete="off" checked>
											<label class="btn" for="gas">G.L.P</label>
											<input type="radio" class="btn-check" name="optionCombustible" id="diesel" value="DIESEL" autocomplete="off" >
											<label class="btn" for="diesel">DIESEL</label>
										';
									}
							$htmlOptions .=	'
										</div>
										<div class="col-auto">
											<button type="button" id="btnUpdateUnd" onclick="fntUpdateUnd()" class="btn btn-primary btn-sm ml-3"> <i
												class="fas fa-plus"></i><span id="btnText">ACTUALIZAR</span>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>';
		echo $htmlOptions;
		die();
	}
	// obtener los datos de la vista y enviarlos al modelo para la actualizacion
	public function updateUnidad(){
		if($_POST){
			$idUnidad= intval($_POST['idUnidad']);// 
			$txtIdUnidad= $_POST['txtIdUnidad'];// BY-02
			$txtMarcaUnidad= intval($_POST['listMarca']);// YUTONG
			$txtModeloUnidad= intval($_POST['listModelo']);// ZK6896HGA
			$txtVimUnidad= $_POST['txtVimUnidad'];// LZYTDGD6XE1000716
			$txtFechaUnidad= $_POST['txtFechaUnidad'];// 2014
			$txtCapacidad= $_POST['txtCapacidad'];// 25
			$optionTransmision= $_POST['optionTransmision'];// 1
			$optionCombustible= $_POST['optionCombustible'];// DIESEL
			$request = $this->model->updateUnidad($idUnidad,$txtMarcaUnidad,$txtModeloUnidad,$txtCapacidad,$optionTransmision,$optionCombustible);
			if($request> 0){
				$arrResponse = array('status'=> true,'msg' => 'Unidad actualizada');
			}else{
				$arrResponse = array('status'=> false,'msg' => 'Error al actualizar');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}