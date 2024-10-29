<?php
//retorna la ruta del proyecto
function base_url(){
	return BASE_URL;	
}

function getModal(string $nameModal, $data){
	$view_modal = VIEWS."Modules/Modals/{$nameModal}.php";
	require_once $view_modal;
}
function head($data = ""){
	$view_header = VIEWS."Modules/header.php";
	require_once  $view_header;
}
function footer($data = ""){
	$view_footer = VIEWS."Modules/footer.php";
	require_once  $view_footer;
}
//muestra informacion formateada
function dep($data){
	$format = print_r('<pre>');
	$format = print_r($data);
	$format = print_r('</pre>');
	return $format;
}
function encryption($string){
	$output=FALSE;
	$key=hash('sha256', SECRET_KEY);
	$iv=substr(hash('sha256', SECRET_IV), 0, 16);
	$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
	$output=base64_encode($output);
	return $output;
}
function decryption($string){
	$key=hash('sha256', SECRET_KEY);
	$iv=substr(hash('sha256', SECRET_IV), 0, 16);
	$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
	return $output;
}
function formatear_timestamp($fecha){
	$dia = date('w', $fecha);
	$dias = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
	$mes = date("m", strtotime($fecha));
	$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	$salida = $dias[$dia-1].', '.date("d", strtotime($fecha)).' de '.$meses[$mes-1].' a las '.date("G:i a", strtotime($fecha));
	return $salida;
}
function formatear_fecha($fecha){
	$dia = date('N', strtotime($fecha));
	$dias = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
	$mes = date("m", strtotime($fecha));
	$ano = date("Y", strtotime($fecha));
	$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
	$salida = $dias[$dia-1].', '.date("d", strtotime($fecha)).' de '.$meses[$mes-1].' · '.$ano;
	return $salida;
}
function sessionUser(int $idUser){
	require_once ("system/app/Models/LoginModel.php");
	$objLogin = new LoginModel();
	$request = $objLogin->sessionLogin($idUser);
	return $request;
}
function endTimeline(string $strCodigo,string $strHoraFin){
	require_once ("system/app/Models/TimeLineModel.php");
	$objTimeLine = new TimeLineModel();
	$request = $objTimeLine->endTimeline($strCodigo,$strHoraFin);
	return $request;
}
function setTimeline(int $intIdUser, string $strCodigo, string $strFecha, string $strHoraInicio){
	require_once ("system/app/Models/TimeLineModel.php");
	$objTimeLine = new TimeLineModel();
	$request = $objTimeLine->setTimeline($intIdUser,$strCodigo,$strFecha,$strHoraInicio);
	return $request;
}
function strClean($srtCadena){
	$string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''],$srtCadena);
	$string = trim($srtCadena);
	$string = stripslashes($srtCadena);
	$string = str_ireplace("<script>","",$string);
	$string = str_ireplace("</script>","",$string);
	$string = str_ireplace("<script src>","",$string);
	$string = str_ireplace("<script type=>","",$string);
	$string = str_ireplace("SELECT * FROM ","",$string);
	$string = str_ireplace("DELETE * FROM ","",$string);
	$string = str_ireplace("INSERT INTO ","",$string);
	$string = str_ireplace("SELECT COUNT(*) FROM ","",$string);
	$string = str_ireplace("DELETE TABLE ","",$string);
	$string = str_ireplace("DROP TABLE ","",$string);
	$string = str_ireplace("OR '1'='1' ","",$string);
	$string = str_ireplace('OR "1"="1" ',"",$string);
	$string = str_ireplace("IS NULL; --","",$string);
	$string = str_ireplace('LIKE "',"",$string);
	$string = str_ireplace("LIKE '","",$string);
	$string = str_ireplace("--","",$string);
	$string = str_ireplace("^","",$string);
	$string = str_ireplace("[","",$string);
	$string = str_ireplace("]","",$string);
	$string = str_ireplace("==","",$string);

	return $string;
}
function passGenerator($length = 10){
	$pass = "";
	$longitud = $length;
	$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$longitudcadena = strlen($cadena);
	for ($i=1; $i <= $longitud; $i++) { 
		$pas = rand(0, $longitudcadena -1);
		$pass .= substr($cadena,$pas,1);
	}
	return $pass;
}
function codGenerator($length = 4){
	$pass = "";
	$longitud = $length;
	$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$longitudcadena = strlen($cadena);
	for ($i=1; $i <= $longitud; $i++) { 
		$pas = rand(0, $longitudcadena -1);
		$pass .= substr($cadena,$pas,1);
	}
	return $pass;
}
function token(){
	$sr1 = bin2hex(random_bytes(10));
	$sr2 = bin2hex(random_bytes(10));
	$sr3 = bin2hex(random_bytes(10));
	$sr4 = bin2hex(random_bytes(10));
	$token = $sr1 .'-'.$sr2.'-'.$sr3.'-'.$sr4;
	return $token;
}
function formatMoney($cant){
	$cant = number_format($cant,2,SPD,SPM);
	return $cant;
}

// echo $_FILES['file']['name'];
function str_random ($path_info) {
	$string = 'AaBbCcDdEeFfGgHhIiJjKkLlMm0123456789_';
	return str_shuffle($string) . '.' . $fileData['extension'];
}
function validarCaracteres($name){
	$ValidChars = "0123456789_-.@$()={}[]° abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$valid_name = $name;
	$name = str_split($name);
	for ($i = 0; $i < count($name); $i++)
		if (strpos($ValidChars, $name[$i]) === false)
			$valid_name = str_replace($name[$i], '', $valid_name);
	return ($valid_name);
}


function destroySession() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(),
			'',
			time() - 42000,
			$params['path'],
			$params['domain'],
			$params['secure'],
			$params['httponly']);
    }
    @session_destroy();
}


function cargar_menu (string $strNick){
	require_once ("system/app/Models/MenuModel.php");
	$objMenu = new MenuModel();
	$arrData = $objMenu->menuUser($strNick);
	$id_menu = "";
	if ($arrData <> ""){
		$options=array();
		echo "<li class='nav-item'>
				<a href='".base_url()."' class='nav-link active-home'>
					<i class='nav-icon fas fa-th'></i>
					<p>INICIO</p>
				</a>
			</li>";
		foreach($arrData as $index => $valor){
			$options[$index+1]["id_menu"] = $valor["id_menu"];
			$options[$index+1]["nombre_menu"] = $valor["nombre_menu"];
			$options[$index+1]["nombre_submenu"] = $valor["nombre_submenu"];
			$options[$index+1]["page_menu_open"] = $valor["page_menu_open"];
			$options[$index+1]["page_link_activo"] = $valor["page_link_activo"];
			$options[$index+1]["page_link"] = $valor["page_link"];
			$options[$index+1]["icono_menu"] = $valor["icono_menu"];
			$options[$index+1]["url"] = $valor["url"];
			if ($id_menu <> $options[$index+1]["id_menu"]){
				if ($id_menu <> ""){
					echo "</ul>
								</li>";
				}
				echo "<li class='nav-item menu-open-".$options[$index+1]["page_menu_open"]."'>";
				echo "<a href='#' class='nav-link active-".$options[$index+1]["page_link"]."'>";
				echo "<i class='nav-icon ".$options[$index+1]["icono_menu"]."'></i>";
				echo "<p>".$options[$index+1]["nombre_menu"]."<i class='right fas fa-angle-left'></i></p>
							</a>";
				echo "<ul class='nav nav-treeview'>";
				$id_menu = $options[$index+1]['id_menu'];
			}
			echo "<li class='nav-item link-".$options[$index+1]["page_link_activo"]."'>";
			echo "<a href='".base_url().$options[$index+1]["url"]."' class='nav-link'>";
			echo "<i class='far fa-circle nav-icon'></i>
						<p>".$options[$index+1]["nombre_submenu"]."</p>";
			echo "
					</a>
				</li>";
		}
	}
}

function reporteDespPdf(int $idCodDespacho){
	require_once ("system/app/Models/OrdenModel.php");
	$data = new OrdenModel();
	$data = $this->model->selectDepacho($idCodDespacho);
	// Creación del objeto de la clase heredada
	$pdf = new PDF(); //hacemos una instancia de la clase
	$pdf->AliasNbPages();
	$pdf->AddPage(); //añade l apagina / en blanco
	$pdf->SetMargins(10, 10, 10); //MARGENES
	$pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico

	// -----------ENCABEZADO------------------
	$pdf->SetX(15);
	$pdf->SetFont('Helvetica', 'B', 15);
	$pdf->Cell(10, 8, 'N', 1, 0, 'C', 0);
	$pdf->Cell(60, 8, 'Codigo', 1, 0, 'C', 0);
	$pdf->Cell(80, 8, 'Nombre', 1, 0, 'C', 0);
	$pdf->Cell(35, 8, 'Precio', 1, 1, 'C', 0);
	// -------TERMINA----ENCABEZADO------------------

	$pdf->SetFillColor(233, 229, 235); //color de fondo rgb
	$pdf->SetDrawColor(61, 61, 61); //color de linea  rgb

	$pdf->SetFont('Arial', '', 12);

	//El ancho de las celdas
	$pdf->SetWidths(array(10, 60, 80, 35)); //???

	// esto no lo mencione en el video pero también pueden poner la alineación de cada COLUMNA!!!
	$pdf->SetAligns(array('C','C','C','L'));

	for ($i = 0; $i < count($data); $i++) {

		$pdf->Row(array($i + 1, $data[$i]['codigo'], ucwords(strtolower(utf8_decode($data[$i]['nombre']))), '$' . $data[$i]['precio']), 15);
	}
}