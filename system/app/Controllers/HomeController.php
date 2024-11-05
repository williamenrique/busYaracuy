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
	public function getOperativo(){
		$arrData = $this->model->getOperativo();
		$htmlOptions = '';
		$operativo = count($arrData);
		$arrDataCount = $this->model->getUnidades();
		$count = count($arrDataCount);
		$porcentaje = "";
		$htmlOptions .='<div class="row">';
		for ($i=0; $i < count($arrData); $i++) { 
			if($arrData[$i]['status_unidad'] ==  1){
				$htmlOptions .= '
						<div class="col-lg-3 col-6">
					        <!-- small box -->
					        <div class="small-box bg-success">
								<div class="inner">
									<h3>'.$arrData[$i]['cantUnd'].'</h3>
									<p> <span class="mr-2">'. round(intval($arrData[$i]['cantUnd']) / intval($count) * 100 ).'%</span>UNIDADES<br> OPERATIVA</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="'.base_url().'flota" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a> 
							</div>
    					</div>';
			}
			if($arrData[$i]['status_unidad'] ==  2){
				$htmlOptions .= '
						<div class="col-lg-3 col-6">
					        <!-- small box -->
					        <div class="small-box bg-warning">
								<div class="inner">
									<h3>'.$arrData[$i]['cantUnd'].'</h3>
									<p><span class="mr-2">'. round(intval($arrData[$i]['cantUnd']) / intval($count) * 100 ).'%</span>UNIDADES MANTENIMIENTO</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="'.base_url().'flota" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
							</div>
    					</div>';
			}
			if($arrData[$i]['status_unidad'] ==  3){
				$htmlOptions .= '
						<div class="col-lg-3 col-6">
					        <!-- small box -->
					        <div class="small-box bg-secondary">
								<div class="inner">
									<h3>'.$arrData[$i]['cantUnd'].'</h3>
									<p> <span class="mr-2">'. round(intval($arrData[$i]['cantUnd']) / intval($count) * 100 ).'%</span>UNIDADES INOPERATIVAS</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="'.base_url().'flota" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
							</div>
    					</div>';
			}
			if($arrData[$i]['status_unidad'] ==  0){
				$htmlOptions .= '
						<div class="col-lg-3 col-6">
					        <!-- small box -->
					        <div class="small-box bg-danger">
								<div class="inner">
									<h3>'.$arrData[$i]['cantUnd'].'</h3>
									<p> <span class="mr-2">'. round(intval($arrData[$i]['cantUnd']) / intval($count) * 100 ).'%</span>UNIDADES DESINCORPORADAS</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="'.base_url().'flota" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
							</div>
    					</div>';
			}
		}
		$htmlOptions .= '</div>';
		echo $htmlOptions;
		die();
	}
	public function getOperatividad(){
		$arrData = $this->model->getOperatividad();
		$htmlOptions = '';
		$inoperativo = count($arrData);
		
		$htmlOptions .= '<table class="table table-head-fixed text-nowrap">
							<thead>
							<tr>
								<th scope="col">MODELOS</th>
								<th scope="col">TRANSMISION</th>
								<th scope="col">COMBUSTIBLE</th>
								<th scope="col">CANTIDAD</th>
								<th scope="col">OPERATIVO</th>
								<th scope="col">INOPERATIVO</th>
								<th scope="col">CTITICAS</th>
							</tr>
							</thead>
							<tbody>
								';
					for ($i=0; $i < count($arrData); $i++) { 
						$htmlOptions .= '<tr>
								      <th scope="row">'.$arrData[$i]['MODELO'].'</th>
								      <td>'.$arrData[$i]['TRANSMISION'].'</td>
								      <td>'.$arrData[$i]['COMBUSTIBLE'].'</td>
								      <td>'.$arrData[$i]['CANT'].'</td>
								      <td>'.$arrData[$i]['OPERATIVO'].'</td>
								      <td>'.$arrData[$i]['INOPERATIVO'].'</td>
								      <td>'.$arrData[$i]['DESINCORPORADO'].'</td>
								    </tr>';
					}
						'    
							</tbody>
						</table>';
		echo $htmlOptions;
		die();
	}
	public function fntImpOperatividad(){
		$requestCant = $this->model->cantUnid();
		$infoCant = (file_exists('./data/infoOperatividad.txt') ? unlink('./data/infoOperatividad.txt') : fopen("./data/infoOperatividad.txt", "w"));
        $infoCant = fopen("./data/infoOperatividad.txt", "a");
        fwrite($infoCant,$requestCant['CANT'].';');//0
        fwrite($infoCant,$requestCant['OPERATIVO'].';');//1
        fwrite($infoCant,$requestCant['MANTENIMIENTO'].';');//2
        fwrite($infoCant,$requestCant['INOPERATIVO'].';');//3
        fwrite($infoCant,$requestCant['DESINCORPORADO'].';');//4
		
		$request = $this->model->getOperatividad();
		$operatividad = (file_exists('./data/operatividad.txt') ? unlink('./data/operatividad.txt') : fopen("./data/operatividad.txt", "w"));
        $operatividad = fopen("./data/operatividad.txt", "a");
        for ($i=0; $i < count($request); $i++) {
            fwrite($operatividad, 
                $request[$i]['MODELO'].';'
                .$request[$i]['TRANSMISION'].';'
                .$request[$i]['COMBUSTIBLE'].';'
                .$request[$i]['CANT'].';'
                .$request[$i]['OPERATIVO'].';'
                .$request[$i]['INOPERATIVO'].';'
                .$request[$i]['DESINCORPORADO'].';'.PHP_EOL);
        }
		fclose($operatividad);
	}
}