<?php
const BASE_URL = "http://192.168.0.240/busyaracuy/";
const HEAD = "src/include/head.php";
const FOOTER = "src/include/footer.php";
// const BACK_URL = $_SERVER['REQUEST_URI'];
const LIBS = "system/core/Libraries/";
const VIEWS = "system/app/Views/";
const titulo = "Tienda Virtual en construccion";
date_default_timezone_set('America/Caracas');
$user = gethostname();
$path = get_current_user();
$ruta = 'C:/Users/'.$user.'/';
// $ruta = 'C:/Users/'.$user.'/servidor/';
// define('ruta',"C:".$path.$user.'\Desktop';

//rutas de assets
const CSS = BASE_URL."src/css/";
const JS = BASE_URL."src/js/";
const IMG = BASE_URL."src/img/";
//constantes del template admin
const CSS_VENDORS = BASE_URL."src/vendors/css/";
const JS_VENDORS = BASE_URL."src/vendors/js/";
const IMG_VENDORS = BASE_URL."src/vendors/img/";
const VENDORS = BASE_URL."src/vendors/";
const PLUGINS = BASE_URL."src/plugins/";

const CONTROLLER = BASE_URL."system/core/Libraries/Controllers.php";
const LOAD = BASE_URL."system/core/Libraries/Load.php";

//constantes de base de datos
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "almacen";
const DB_CHARSET = "charset=utf8";

define("BACKUP_DIR", $ruta.'/BackUp/'); // Comment this line to use same script's directory ('.')
// define("BACKUP_DIR", 'back_up_data'); // Comment this line to use same script's directory ('.')
define("TABLES", '*'); // Full backup
//define("TABLES", 'table1, table2, table3'); // Partial backup
define('IGNORE_TABLES',array(
    'tbl_token_auth',
    'token_auth'
)); // Tables to ignore
define("CHARSET", 'utf8');
define("GZIP_BACKUP_FILE", true); // Set to false if you want plain SQL backup files (not gzipped)
define("DISABLE_FOREIGN_KEY_CHECKS", true); // Set to true if you are having foreign key constraint fails
define("BATCH_SIZE", 1000); // Batch size when selecting rows from database in order to not exhaust system memory
                            // Also number of rows per INSERT statement in backup file

//delimitador decimal y millar Ej. 24,1999.00
const SPD = ',';
const SPM = '.';
//simbolo de moneda
const SMONEY = '$';
//constantes de encriptacion
define('METHOD','AES-256-CBC');
define('SECRET_KEY','$busYaracuy');
define('SECRET_IV','101712');