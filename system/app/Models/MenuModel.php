<?php
class MenuModel extends Mysql {
	private $intIdentificacion;
	private $intIdUser;
	private $intListStatus;
	private $intlistRolId;
	private $intIdMenu;
	private $intIdSubMenu;
	private $strNick;
	public function __construct(){
		parent::__construct();
	}

	public function menuUser(string $strNick){
		$this->strNick = $strNick;
		// $sql = "SELECT id_menu, nombre_menu,icono_menu, id_submenu, nombre_submenu, url,page_menu_open,page_link, page_link_activo   FROM  `v_carga_menu1` WHERE login = '$this->strNick' ORDER BY nombre_menu asc";
		//$sql = "SELECT * FROM  `v_carga_menu` WHERE login = '$this->strNick' ORDER BY nombre_menu asc";
		$sql = "SELECT 
		`a`.`user_nick` AS `login`,
		`a`.`user_nombres` AS `nombres`,
		`a`.`user_apellidos` AS `apellidos`,
		`f`.`rol_id` AS `rol_id`,
		`f`.`rol_name` AS `rol_name`,
		`e`.`id_menu` AS `id_menu`,
		`e`.`nombre_menu` AS `nombre_menu`,
		`e`.`icono_menu` AS `icono_menu`,
		`e`.`page_menu_open` AS `page_menu_open`,
		`e`.`page_link` AS `page_link`,
		`g`.`id_submenu` AS `id_submenu`,
		`g`.`nombre_submenu` AS `nombre_submenu`,
		`g`.`url` AS `url`,
		`g`.`page_link_activo` AS `page_link_activo`
	FROM
		((((((`table_user` `a`
		JOIN `table_user_rol` `b`)
		JOIN `table_dep_submenu` `c`)
		JOIN `table_menu_submenu` `d`)
		JOIN `table_menu` `e`)
		JOIN `table_roles` `f`)
		JOIN `table_submenu` `g`)
	WHERE
		((`a`.`user_nick` = `b`.`user_nick`)
			AND (`b`.`id_rol` = `f`.`rol_id`)
			AND (`b`.`id_departamento` = `c`.`id_departamento`)
			AND (`c`.`id_submenu` = `g`.`id_submenu`)
			AND (`g`.`id_submenu` = `d`.`id_submenu`)
			AND (`e`.`id_menu` = `d`.`id_menu`)
			AND (`e`.`status` = 1)) 
			AND `a`.`user_nick` = '$this->strNick' ORDER BY e.nombre_menu asc ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectRoles(){
		// $sql = "SELECT * FROM table_user a JOIN table_roles b where a.user_rol = b.rol_id AND a.user_status != 0";
		$sql = "SELECT * FROM table_roles WHERE rol_status != 0";
		$request = $this->select_all($sql);
		return $request;
	}
	public function selectDep(){
		$sql = "SELECT * FROM table_departamento ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMenu(){
		$sql = "SELECT * FROM table_menu WHERE status != 0";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectSubMenu(){
		$sql = "SELECT * FROM table_submenu";
		$request = $this->select_all($sql);
		return $request;
	}
	public function getSubMenu(int $intIdMenu){
		$this->intIdMenu = $intIdMenu;
	//	$sql = "SELECT id_submenu, nombre_submenu FROM v_submenu WHERE id_menu = $this->intIdMenu";
		$sql = "SELECT 
				e.id_menu AS id_menu,
				g.id_submenu AS id_submenu,
				g.nombre_submenu AS nombre_submenu,
				g.url AS url,
				g.page_link_activo AS page_link_activo,
				g.status AS status
			FROM
				((table_menu_submenu d
				JOIN table_menu e)
				JOIN table_submenu g)
			WHERE
				((g.id_submenu = d.id_submenu)
				AND (e.id_menu = d.id_menu))
				AND e.id_menu = $this->intIdMenu";
		$request = $this->select_all($sql);
		return $request;
	}
	public function insertMenuSub(int $intIdMenu, array $intIdSubMenu){
		$this->intIdMenu = $intIdMenu;
	  	$this->intIdSubMenu = $intIdSubMenu;
		$sql = "";
		foreach ($intIdSubMenu as $key) {
			$sql = "INSERT INTO table_menu_submenu(id_menu,id_submenu) VALUES (?,?)";
			$arrData = array($this->intIdMenu,$key);
			$request = $this->insert($sql,$arrData);
		}
		return $request;
	}
	public function insertRolSub(int $intlistRolId, array $intIdSubMenu){
		$this->intlistRolId = $intlistRolId;
	  $this->intIdSubMenu = $intIdSubMenu;
		$sql = "";
		foreach ($intIdSubMenu as $key) {
			$sql = "INSERT INTO table_roles_submenu(id_rol,id_submenu) VALUES (?,?)";
			$arrData = array($this->intlistRolId,$key);
			$request = $this->insert($sql,$arrData);
		}
		return $request;
	}
	// asignar el menu y submenu con departamento
	public function insertDepSub(int $intListDep, array $intIdSubMenu){
		$this->intListDep = $intListDep;
	  $this->intIdSubMenu = $intIdSubMenu;
		$sql = "";
		foreach ($intIdSubMenu as $key) {
			$sql = "INSERT INTO table_dep_submenu(id_departamento,id_submenu) VALUES (?,?)";
			$arrData = array($this->intListDep,$key);
			$request = $this->insert($sql,$arrData);
		}
		return $request;
	}
	/**
	 * funciones para obtener lista de usuarios y menu
	 */
	public function listaUser(){
		// $sql = "SELECT a.user_nombres,a.user_nick, b.rol_name FROM table_user a INNER JOIN table_roles b ON a.user_rol = b.rol_id WHERE a.user_status= 1 ORDER BY b.rol_id ";
		$sql = "SELECT a.user_nombres, a.user_nick, b.rol_name, d.departamento FROM table_user a 
					JOIN  table_roles b JOIN  table_user_rol c JOIN table_departamento d
					WHERE a.user_nick = c.user_nick
					AND a.id_departamento = d.id_departamento
					AND a.user_rol = b.rol_id 
					AND a.user_status= 1 ORDER BY b.rol_id";
		$request = $this->select_all($sql);
		return $request;
	}
	public function listaMenu(string $strNick){
		$this->strNick = $strNick;
		$sql = "SELECT id_menu, nombre_menu, icono_menu, id_submenu, nombre_submenu, url,page_menu_open,page_link, page_link_activo   FROM  `v_carga_menu` 
				WHERE login = '$this->strNick' ORDER BY nombre_menu asc";
		$request = $this->select_all($sql);
		return $request;
	}
}