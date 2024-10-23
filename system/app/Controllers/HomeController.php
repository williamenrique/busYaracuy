<?php
header('Access-Control-Allow-Origin: *');
class Home extends Controllers{
	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'login');
		}
		//invocar para que se ejecute el metodo de la herencia
		parent::__construct();
	}
	public function home(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "Pagina principal";
		$data['page_title'] = "Pagina Principal";
		$data['page_name'] = "home";
		$data['page_link'] = "active-home";//activar el menu desplegable o un lin solo
		$data['page_menu_open'] = "menu-open-home";//abrir el desplegable
		$data['page_link_acitvo'] = "link-home";// seleccionar el link en el momento
		$data['page_functions'] = "function.home.js";
		$this->views->getViews($this, "home", $data);
	}
}