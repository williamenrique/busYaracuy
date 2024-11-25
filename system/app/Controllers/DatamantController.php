<?php
header('Access-Control-Allow-Origin: *');
class Datamant extends Controllers{
	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'dashboard');
		}
		//invocar para que se ejecute el metodo de la herencia
		parent::__construct();
	}
	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function datamant(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "FLOTA";
		$data['page_title'] = "TODA LA FLOTA";
		$data['page_name'] = "DATA ";
		$data['page_link'] = "active-data";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-data";//abrir el desplegable
		$data['page_link_acitvo'] = "link-data";// seleccionar el link en el momento dentro del 
		$data['page_functions'] = "function.data.mant.js";
		$this->views->getViews($this, "datamant", $data);
	}
    /*********** funcion obtener unidades en mantenimiento para la tabla*****************/
	public function listDataMant(){
		$arrData = $this->model->listDataMant();
		//provar que trae el array
		// dep($arrData[0]['rol_status']);exit();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			// if ($arrData[$i]['tipo_mantenimiento'] == 'c') {
			// 	$arrData[$i]['tipo_mantenimiento'] = '<span>Correctivo</a>';
			// }else {
			// 	$arrData[$i]['tipo_mantenimiento'] = '<span>Preventivo</span>';
			// }
			// if ($arrData[$i]['fecha_salida'] == '') {
			// 	$arrData[$i]['fecha_salida'] = '<span>En espera</a>';
			// }
			$arrData[$i]['id_unidad'] ='<a href=flota/unidad/?unidad='.$arrData[$i]['id_flota'].' title="Ver">'.$arrData[$i]['id_unidad'].'</a>';
            $arrData[$i]['opciones'] ='<div class="d-flex justify-content-around align-items-center">
											<span>'.$arrData[$i]['id_unidad_mantenimiento'].'</span>
                                            <button type="button" class="btn btn-danger btn-sm btnDelReg" onClick="fntDelReg('.$arrData[$i]['id_unidad_mantenimiento'].')" title="Eliminar">
												<i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
										</div>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
    public function delReg(int $intId){
        $intId = intval($intId);
        $requestDel = $this->model->delReg($intId);
        if($requestDel){
            $arrResponse = array('status' => true, 'msg' => 'Registro eliminado');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Ah ocurrido un error al borrar');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
    }
	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	*/
	public function clean(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "CLEAN";
		$data['page_title'] = "CLEAN";
		$data['page_name'] = "Clean";
		$data['page_link'] = "active-data";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-data";//abrir el desplegable
		$data['page_link_acitvo'] = "link-clean";// seleccionar el link en el momento dentro del 
		$data['page_functions'] = "function.data.mant.js";
		$this->views->getViews($this, "clean", $data);
	}
	/* TODO: escaner
	//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	*/
	public function scaner(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "ESCANER";
		$data['page_title'] = "ESCANER";
		$data['page_name'] = "Escaner";
		$data['page_link'] = "active-data";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-data";//abrir el desplegable
		$data['page_link_acitvo'] = "link-scaner";// seleccionar el link en el momento dentro del 
		$data['page_functions'] = "function.data.mant.js";
		$this->views->getViews($this, "scaner", $data);
	}

	/*************funcion de listar todos unidades para mantenimiento y cargarlo en el select******************/
	public function getUnidades(){
		$htmlOptions = "";
		$arrData = $this->model->selectUnidad();
		if(count($arrData) > 0){
			$htmlOptions .= '<option value="0" selected>SELECCIONE UNIDAD</option>';
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_flota'].'">'.$arrData[$i]['id_unidad'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/************* insertar registro de scaner ******************/
	public function setScaner(){
		$idUser = intval($_SESSION['idUser']); 
        $idUnidad = intval($_POST['unidadesList']);
        $strObsScaner = strtoupper($_POST['txtObsScaner']);
        $strFechaScaner = $_POST['txtFechaScaner'];
		if($idUnidad == '0' ||  $strObsScaner == "" || $strFechaScaner == ""){
			$arrResponse = array('status' => false, 'msg' => 'Debe llenar los campos');
		}else{
			$request = $this->model->setScaner($idUser,$idUnidad,$strObsScaner,$strFechaScaner);
			if($request > 0){
				$arrResponse = array('status' => true, 'msg' => 'Registro exitoso');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al registrar');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/************* obtener registro de scaner ******************/
	public function getRegScaner($strBuscar){
		$htmlOptions = "";
		$arrData = $this->model->searchReg($strBuscar);
		if(count($arrData) > 0){
			$htmlOptions .= '<a type="button" href="'.base_url().'fpdf/scaner.php" target="_blank" class="btn btn-sm btn-success mb-2" onclick="fntImpScaner()">PDF</a>';
			$htmlOptions .= '<ul style="position: relative;overflow: auto;max-height: 60vh;width: 100%">';
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<li><strong class="mr-2 fw-bold">'.$arrData[$i]["id_unidad"].'</strong><span class="mr-2">'.formatear_fecha($arrData[$i]["fecha_scaner"]).'</span>'.$arrData[$i]["obs_scaner"].'</li>';
			}
			$htmlOptions .= '</ul>';
		}else{
			$htmlOptions .= '<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h5><i class="icon fas fa-info"></i> INFO</h5>
								NO SE ENCONTRO REGISTRO.
							</div>';
		}
		echo $htmlOptions;
	}
	// generar el pdf de la orden de despacho
	public function reporteScaner(string $strBuscar){
		$request = $this->model->searchReg($strBuscar);
		$scaner = (file_exists('./data/scaner.txt') ? unlink('./data/scaner.txt') : fopen("./data/scaner.txt", "w"));
		$scaner = fopen("./data/scaner.txt", "a");
		for ($i=0; $i < count($request); $i++) {
			fwrite($scaner, 
				$request[$i]['id_unidad'].';'
				.formatear_fecha($request[$i]['fecha_scaner']).';'
				.$request[$i]['obs_scaner'].';'.PHP_EOL);
		}
		fclose($scaner);
	}
	/* TODO: articulo mantenmiento
	//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	*/
	public function articulo(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "ARTICULO";
		$data['page_title'] = "ARTICULO";
		$data['page_name'] = "Articulo";
		$data['page_link'] = "active-data";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-data";//abrir el desplegable
		$data['page_link_acitvo'] = "link-articulo";// seleccionar el link en el momento dentro del 
		$data['page_functions'] = "function.data.articulo.js";
		$this->views->getViews($this, "articulo", $data);
	}
	public function getProductos(){
		// <button type="button" class="btn btn-secondary btn-sm btnViewUser" onClick="fntViewProduct('.$arrData[$i]['id_producto'].')" title="Ver"><i class="far fa-eye" aria-hidden="true"></i></button>
		$htmlOptions = "";
		$arrData = $this->model->getProductos();
		$arrDataU = $this->model->selectUbic();
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
				else if(($arrData[$i]['cant_producto'] >= 0) && ($arrData[$i]['cant_producto'] <= 1)){
					// $arrData[$i]['cant_producto'] = '<span class="badge bg-warning">'.$arrData[$i]['cant_producto'].'</span>';
					$arrData[$i]['cant_producto'] = '<span class="">'.$arrData[$i]['cant_producto'] * 1000 .' ML</span>';
				}
				else if($arrData[$i]['cant_producto'] > 1){
					// $arrData[$i]['cant_producto'] = '<span class="badge bg-info">'.$arrData[$i]['cant_producto'].'</span>';
					$arrData[$i]['cant_producto'] = '<span class="">'.$arrData[$i]['cant_producto'].' '.$arrData[$i]['present_producto'].'</span>';
				}
				$arrData[$i]['producto'] = '<input type="text" style="border: none;" name="" id="" value="'.$arrData[$i]['producto'].'">';
				// for ($j=0; $j < count($arrDataU); $j++) { 
				// 	$arrDataU[$j]['ubicacion'] .= '<option value="'.$arrDataU[$j]['id_ubicacion'].'">'.$arrDataU[$j]['ubicacion'].'</option>';
				// }
			}
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}

}