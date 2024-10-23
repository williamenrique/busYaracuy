<?php
header('Access-Control-Allow-Origin: *');
class Plantilla extends Controllers{

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
	public function plantilla(){
		$data['page_tag'] = "PLANTILLA";
		$data['page_title'] = "Plantilla";
		$data['page_name'] = "Plantilla";
		$data['page_link'] = "active-plantilla";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-plantilla";//abrir el desplegable
		$data['page_link_acitvo'] = "link-plantilla";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.plantilla.js";
		$this->views->getViews($this, "plantilla", $data);
	}
}