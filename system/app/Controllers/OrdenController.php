<?php
header('Access-Control-Allow-Origin: *');
class Orden extends Controllers{

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
	public function despacho(){
		$data['page_tag'] = "DESPACHO";
		$data['page_title'] = "Plantilla";
		$data['page_name'] = "Despacho";
		$data['page_link'] = "active-producto";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-producto";//abrir el desplegable
		$data['page_link_acitvo'] = "link-despacho";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.orden.js";
		$this->views->getViews($this, "despacho", $data);
	}
    // obtener las unidades para cargar un select
    public function getListFlota(){
		$htmlOptions = "";
		$arrData = $this->model->selectListFlota();
		if(count($arrData) > 0){
            $htmlOptions = "<option value='0'>UNIDAD</option>";
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_flota'].'">'.$arrData[$i]['id_unidad'].'- '.$arrData[$i]['modelo_unidad'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
    // obtener data de las unidades 
    public function getUnidad(int $idUnidad){

		$idUnidad = intval($idUnidad);
		if($idUnidad > 0){
			$arrData = $this->model->selectUnidad($idUnidad);
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
    // obtener data de un despachador de almacen
    public function getPersonal(int $idDesp){
        $idDesp = intval($idDesp);
        if($idDesp > 0){
            $arrData = $this->model->selectPersonal($idDesp);
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
    // traer los operadores para cargar un select
    public function getListOper(){
        $htmlOptions = "";
        $arrData = $this->model->selectListOper();
        if(count($arrData) > 0){
            $htmlOptions = "<option value='0'>OPERADOR</option>";
            for ($i=0; $i < count($arrData); $i++) { 
                $htmlOptions .= '<option value="'.$arrData[$i]['id_personal'].'">'.$arrData[$i]['personal_nombre'].'</option>';
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
                $htmlOptions .= '<option value="'.$arrData[$i]['id_personal'].'">'.$arrData[$i]['personal_nombre'].'</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
    // traer los despachadores de almacen para cargar un select
	public function getListDesp(){
        $htmlOptions = "";
        $arrData = $this->model->selectListDesp();
        if(count($arrData) > 0){
            $htmlOptions = "<option value='0'>DESPACHADOR</option>";
            for ($i=0; $i < count($arrData); $i++) { 
                $htmlOptions .= '<option value="'.$arrData[$i]['id_personal'].'">'.$arrData[$i]['personal_nombre'].'</option>';
            }
        }else{
            $htmlOptions .= '<option>NO DATA</option>';
        }
        echo $htmlOptions;
        die();
    }
    // traer los articulos y cargarlos en un select
	public function getListArt(){
        $htmlOptions = "";
        $arrData = $this->model->selectListArt();
        if(count($arrData) > 0){
            $htmlOptions = "<option value='0'>ARTICULO</option>";
            for ($i=0; $i < count($arrData); $i++) { 
                $htmlOptions .= '<option value="'.$arrData[$i]['id_producto'].'">'.$arrData[$i]['producto'].' (DISP '.$arrData[$i]['cant_producto'].') '.$arrData[$i]['enlace_producto'].' </option>';
            }
        }else{
            $htmlOptions = "<option value='0'>NO HAY ARTICULOS</option>";
        }
        echo $htmlOptions;
        die();
    }
    //traer un articulo especifico
    public function getArt(int $idProducto){
        $idProducto = intval($idProducto);
        if($idProducto > 0){
            $arrData = $this->model->selectArt($idProducto);
            if(empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
            }else{
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    //ingresar un orden de despacho de productos
	public function setOrdenD(){
		if($_POST){
			$intUnidad = intval($_POST['listUnidad']);
			$intOperador = intval($_POST['listOperador']);
			$intMecanico = intval($_POST['listMecanico']);
			$intDespachador = intval($_POST['listDespachador']);
			$intArticulo = intval($_POST['listArticulo']);
			$srtObsDespacho = strtoupper($_POST['txtObsDespacho']);
            $srtOper = $_POST['txtOper'];
            $srtDesp = $_POST['txtDesp'];
            $srtMec = $_POST['txtMec'];
            $srtDate = $_POST['txtdate'];
			if($_POST['listUnidad'] == "" || $_POST['listOperador'] == "0" || $_POST['txtdate'] == " " || $_POST['listMecanico'] == "0" || $_POST['listDespachador'] == "0" || $_POST['listArticulo'] == "0" ||  empty($_POST['cod'])) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos de la orden");
			}else{
				$request = $this->model->insertDespacho($intUnidad,$srtOper,$srtMec,$srtDesp,$_SESSION['idUser'],$srtObsDespacho,$srtDate);
				if($request >= '1'){
					$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente '); 
                    for($i=0; $i<count($_POST['cod']); $i++){
                        $intIdArticulo= $_POST['cod'][$i];
                        $intCant = $_POST['cantidad'][$i];
                        $requestRelacion = $this->model->insertRDespacho($request,$intIdArticulo,$intCant);
                        $requestUpdateCant = $this->model->updateCant($intIdArticulo,$intCant);
                        //Esto va a realizar una inserción en la base de datos por cada fila del array que llega desde mi formulario
                        // actualizar cantidad en el stock

                    }
				}else if($request == 0 ){
					$arrResponse = array('status'=> false,'msg' => "ERROR"); 
				}
                // $arrResponse = array('status'=> true,'msg' => "INSERTAR");
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
    /* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function listaordenes(){
		$data['page_tag'] = "DESPACHO";
		$data['page_title'] = "Plantilla";
		$data['page_name'] = "Despacho";
		$data['page_link'] = "active-producto";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-producto";//abrir el desplegable
		$data['page_link_acitvo'] = "link-listadeordenes";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.orden.js";
		$this->views->getViews($this, "listaordenes", $data);
	}
    // traer ordenes por fecha o codigo de despacho o Unidad: 
    // TODO: agregar boton eliminar y devolver los articulos al stock ingresar historial
    public function getBuscarOrden(){
        $strCod = $_POST['txtCodDespacho'];
        $strUnidad = strtoupper($_POST['txtUnidad']);
        $strDesde = $_POST['txtDesde'];
        $srtArt = $_POST['txtArt'];
        $htmlOptions = "";
        $arrData = $this->model->getListBuscarOrdenes($strCod,$strDesde,$strUnidad,$srtArt);
        // dep($arrData);
        if(empty($arrData)){
            $htmlOptions = '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> INFO</h5>
                                NO SE ENCONTRO REGISTRO.
                            </div>';
        }else{
            for ($i=0; $i < count($arrData); $i++) {
                $arrDataDesp = $this->model->getListArtDesp($arrData[$i]['id_despacho']);
                $htmlOptions .= 
                '<div class="timeline">
                        <div class="time-label">
                            <span class="bg-red">'.$arrData[$i]['fecha_despacho'].'</span>
                        </div>
                        <div>
                            <i class="far fa-clipboard bg-blue"></i>
                            <div class="timeline-item">
                                <h3 class="time timeline-header" style="font-size: 14px;"><a href="#" class="mr-1">UNIDAD: </a> '.$arrData[$i]['id_unidad'].'</h3>
                                <h3 class="timeline-header" style="font-size: 14px;"><a href="#" class="mr-1">COD :</a> '.$arrData[$i]['id_despacho'].'</h3>
                                <div class="timeline-body">
                                    <strong class="mr-1">MODELO :</strong><span class="mr-2">'.$arrData[$i]['modelo_unidad'].'</span>
                                    <strong class="mr-1">MARCA :</strong><span>'.$arrData[$i]['marca_unidad'].'</span>
                                    <strong class="mr-1">COMBUSTIBLE :</strong><span>'.$arrData[$i]['tipo_combustible'].'</span><br>
                                    <strong class="mr-1">MECANICO :</strong><span class="mr-2">'.$arrData[$i]['mecanico'].'</span>
                                    <strong class="mr-1">OPERADOR :</strong><span>'.$arrData[$i]['operador'].'</span><br>
                                    <strong class="mr-1">DESPACHADO :</strong><span class="mr-2">'.$arrData[$i]['despachador'].'</span><br>
                                    <hr>
                                ';
                                for ($j=0; $j < count($arrDataDesp); $j++) { 
                                    if($arrDataDesp[$j]['status_producto'] == 0){
                                        $htmlOptions .='
                                        <ul>
                                            <li>
                                                <del>
                                                    <strong class="mr-1">COD-</strong>
                                                    <span class="mr-2">'.$arrDataDesp[$j]['id_producto'].'</span>
                                                    <span class="mr-2"  data-bs-toggle="tooltip" data-bs-title="ARTICULO ELIMINADO"> '.$arrDataDesp[$j]['producto'].' '.$arrDataDesp[$j]['enlace_producto'].'</span>
                                                
                                                    <strong class="mr-1">CANT :</strong>
                                                    <span class="mr-2">'.$arrDataDesp[$j]['cant_despacho'].'</span>
                                ';
                                   if($arrDataDesp[$j]['present_producto'] == "LITRO"){
                                        $htmlOptions .='    <span class="mr-2">LITROS</span><br>';
                                                        };
                                        $htmlOptions .='
                                                </del>
                                                <span class="mr-2">ARTICULO ELIMNADO</span><br>
                                            </li>
                                        </ul> ';
                                    }else{
                                        $htmlOptions .='
                                        <ul>
                                            <li>
                                                <strong class="mr-1">COD-</strong><span class="mr-2">'.$arrDataDesp[$j]['id_producto'].'</span><span class="mr-2"> '.$arrDataDesp[$j]['producto'].' '.$arrDataDesp[$j]['enlace_producto'].'</span>
                                                <strong class="mr-1">CANT :</strong><span class="mr-1">'.$arrDataDesp[$j]['cant_despacho'].'</span>
                                            ';
                                                if($arrDataDesp[$j]['present_producto'] == "LITRO"){
                                        $htmlOptions .='    <span class="mr-2">LITROS</span><br>';
                                                        };
                                        $htmlOptions .='
                                                </li>
                                        </ul>';
                                    }
                                }
                                $htmlOptions .='
                                </div>
                                <div class="timeline-footer">
                                    ';
                                    if($arrData[$i]['observacion'] != ""){
                                        $htmlOptions .='<strong class="mr-1">OBSERVACION :</strong><span class="mr-2">'.$arrData[$i]['observacion'].'</span><br>';
                                    }
                                $htmlOptions .='
                                    <h6>RESPONSABLE: '.$arrData[$i]['user_nombres'].' '.$arrData[$i]['user_apellidos'].'</h6>
                                    <a href="'.base_url().'fpdf/despacho.php" target="_blank" onclick="fntImpDespacho('.$arrData[$i]['id_despacho'].')" style="color: blue">GENERAR PDF</a>
                                    <h3 class="timeline-header" style="float: right; font-size: 14px;"><a href="#" onclick="fntdelDesp('.$arrData[$i]['id_despacho'].')" class="mr-1">ELIMINAR</a></h3>
                                </div>
                            </div>
                        </div>
                    <div>
                        <i class="fas fa-bus-alt"></i>
                    </div>
                </div>';
            }
        }
        echo $htmlOptions;
		die();
    }
    // mostrar las ordenes generadas
    public function getOrdenes(){
        $arrData = $this->model->getListOrdenes();
        $htmlOptions = "";
        if(empty($arrData)){
            $htmlOptions = '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> INFO</h5>
                                NO SE ENCONTRO REGISTRO.
                            </div>';
        }else{
            for ($i=0; $i < count($arrData); $i++) {
                $arrDataDesp = $this->model->getListArtDesp($arrData[$i]['id_despacho']);
                $htmlOptions .= 
                            '
                           <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-red">'.$arrData[$i]['fecha_despacho'].'</span>
                                </div>
                                <div>
                                    <i class="far fa-clipboard bg-blue"></i>
                                    <div class="timeline-item">
                                        <h3 class="time timeline-header" style="font-size: 14px;"><a href="#" class="mr-1">UNIDAD: </a> '.$arrData[$i]['id_unidad'].'</h3>
                                        <h3 class="timeline-header" style="font-size: 14px;"><a href="#" class="mr-1">COD :</a> '.$arrData[$i]['id_despacho'].'</h3>
                                        <div class="timeline-body">
                                            <strong class="mr-1">MODELO :</strong><span class="mr-2">'.$arrData[$i]['modelo_unidad'].'</span>
                                            <strong class="mr-1">MARCA :</strong><span>'.$arrData[$i]['marca_unidad'].'</span>
                                            <strong class="mr-1">COMBUSTIBLE :</strong><span>'.$arrData[$i]['tipo_combustible'].'</span><br>
                                            <strong class="mr-1">MECANICO :</strong><span class="mr-2">'.$arrData[$i]['mecanico'].'</span>
                                            <strong class="mr-1">OPERADOR :</strong><span>'.$arrData[$i]['operador'].'</span><br>
                                            <strong class="mr-1">DESPACHADO :</strong><span class="mr-2">'.$arrData[$i]['despachador'].'</span><br>
                                            <hr>
                                        ';
                                        for ($j=0; $j < count($arrDataDesp); $j++) { 
                                            if($arrDataDesp[$j]['status_producto'] == 0){
                                                $htmlOptions .='
                                                <ul>
                                                    <li>
                                                        <del>
                                                            <strong class="mr-1">COD-</strong>
                                                            <span class="mr-2">'.$arrDataDesp[$j]['id_producto'].'</span>
                                                            <span class="mr-2"  data-bs-toggle="tooltip" data-bs-title="ARTICULO ELIMINADO"> '.$arrDataDesp[$j]['producto'].' '.$arrDataDesp[$j]['enlace_producto'].'</span>
                                                        
                                                            <strong class="mr-1">CANT :</strong>
                                                            <span class="mr-1">'.$arrDataDesp[$j]['cant_despacho'].'</span>
                                                        ';
                                                        if($arrDataDesp[$j]['present_producto'] == "LITRO"){
                                        $htmlOptions .='    <span class="mr-2">LITROS</span>';
                                                        };
                                        $htmlOptions .='
                                                        </del>
                                                        <span class="mr-2">ARTICULO ELIMNADO</span><br>
                                                    </li>
                                                </ul>
                                                    ';
                                            }else{

                                                $htmlOptions .='
                                                <ul>
                                                    <li>
                                                        <strong class="mr-1">COD-</strong><span class="mr-2">'.$arrDataDesp[$j]['id_producto'].'</span><span class="mr-2"> '.$arrDataDesp[$j]['producto'].' '.$arrDataDesp[$j]['enlace_producto'].'</span>
                                                        <strong class="mr-1">CANT :</strong><span class="mr-1">'.$arrDataDesp[$j]['cant_despacho'].'</span>
                                                    ';
                                                        if($arrDataDesp[$j]['present_producto'] == "LITRO"){
                                        $htmlOptions .='    <span class="mr-2">LITROS</span><br>';
                                                        };
                                        $htmlOptions .='
                                                    </li>
                                                </ul>
                                                    ';
                                            }
                                        }
                                        
                                        $htmlOptions .='
                                        </div>
                                        <div class="timeline-footer">
                                            ';
                                            if($arrData[$i]['observacion'] != ""){
                                                $htmlOptions .='<strong class="mr-1">OBSERVACION :</strong><span class="mr-2">'.$arrData[$i]['observacion'].'</span><br>';
                                            }
                                        $htmlOptions .='
                                            <h6>RESPONSABLE: '.$arrData[$i]['user_nombres'].' '.$arrData[$i]['user_apellidos'].'</h6>
                                            <a href="'.base_url().'fpdf/despacho.php" target="_blank" onclick="fntImpDespacho('.$arrData[$i]['id_despacho'].')" style="color: blue">GENERAR PDF</a>
                                            <h3 class="timeline-header" style="float: right; font-size: 14px;"><a href="#" onclick="fntdelDesp('.$arrData[$i]['id_despacho'].')" class="mr-1">ELIMINAR</a></h3>
                                        </div>
                                    </div>
                                </div>
                            <div>
                                <i class="fas fa-bus-alt"></i>
                            </div>
                        </div>
                            ';
            }
        }
        echo $htmlOptions;
		die();
    }
    // generar el pdf de la orden de despacho
    public function reporteDesp(int $idCodDespacho){
        $request = $this->model->selectDepacho($idCodDespacho);
        // informacion despacho
        $infoDesp = (file_exists('./data/infoDesp.txt') ? unlink('./data/infoDesp.txt') : fopen("./data/infoDesp.txt", "w"));
        $infoDesp = fopen("./data/infoDesp.txt", "a");
        fwrite($infoDesp,$request['id_despacho'].';');//0
        fwrite($infoDesp,$request['id_unidad'].';');//1
        fwrite($infoDesp,$request['fecha_despacho'].';');//2
        fwrite($infoDesp,$request['modelo_unidad'].';');//3
        fwrite($infoDesp,$request['marca_unidad'].';');//4
        fwrite($infoDesp,$request['tipo_combustible'].';');//5
        fwrite($infoDesp,$request['transmision'].';');//6
        fwrite($infoDesp,$request['mecanico'].';');//7
        fwrite($infoDesp,$request['operador'].';');//8
        fwrite($infoDesp,$request['despachador'].';');//9  
        fwrite($infoDesp,$request['observacion'].';');//10
        fwrite($infoDesp,$request['user_nombres'].';');//11
        $artDesp = (file_exists('./data/reporteDesp.txt') ? unlink('./data/reporteDesp.txt') : fopen("./data/reporteDesp.txt", "w"));
        $artDesp = fopen("./data/reporteDesp.txt", "a");
        $arrDataDesp = $this->model->getListArtDesp($idCodDespacho);
        for ($i=0; $i < count($arrDataDesp); $i++) {
            fwrite($artDesp, 
                $arrDataDesp[$i]['id_producto'].';'
                .$arrDataDesp[$i]['producto'].';'
                .$arrDataDesp[$i]['enlace_producto'].';'
                .$arrDataDesp[$i]['cant_despacho'].';'.PHP_EOL);
        }
		fclose($artDesp);
    }
    // eliminar orden
    public function delOrden(){
        if($_POST){
            $intUserId = $_SESSION['userData']['user_id'];
            $srtText = strtoupper($_POST['srtText']);
            $idDesp = intval($_POST['idDesp']);
            $requestStatus = $this->model->delDesp($idDesp,$srtText,$intUserId);
            if($requestStatus){
                $arrResponse = array('status' => true, 'msg' => 'Despacho eliminado');
                $arrDesp = $this->model->artDespacho($_POST['idDesp']);
                for ($i=0; $i < count($arrDesp) ; $i++) { 
                    $intIdArticulo = $arrDesp[$i]['id_producto'];
                    $intCant = $arrDesp[$i]['cant_producto'] + $arrDesp[$i]['cant_despacho'];
                    $requestUpdateCant = $this->model->updateCantN($intIdArticulo,$intCant);
                }
            }else{
                $arrResponse = array('status' => false, 'msg' => 'No se pudo eliminar');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}

/*
for($i=0; $i<count($_POST['cod']); $i++){
                        $intIdArticulo= $_POST['cod'][$i];
                        $intCant = $_POST['cantidad'][$i];
                        $requestRelacion = $this->model->insertRDespacho($request,$intIdArticulo,$intCant);
                        $requestUpdateCant = $this->model->updateCant($intIdArticulo,$intCant);
                        //Esto va a realizar una inserción en la base de datos por cada fila del array que llega desde mi formulario
                        // actualizar cantidad en el stock

                    }
                        */