<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Berlin');

// Load config
require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

//set include path
define("ROOT_PATH",realpath(dirname(__FILE__)));
set_include_path(ROOT_PATH.'/lib/' . PATH_SEPARATOR .
  ROOT_PATH.'/modules/' . PATH_SEPARATOR .
  get_include_path());
  
// Register Zend autoload
require_once "Zend/Loader/Autoloader.php";
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

//setup database
$db_config=array(
  'host'=>$database_host,
  'username'=>$database_user,
  'password'=>$database_pass,
  'dbname'=>$database_name
);

$db = Zend_Db::factory('mysqli',$db_config);
$db->query('set names utf8');
Zend_Db_Table::setDefaultAdapter($db);

//set global variable
$global=new ArrayObject();
$global->db=$db;

require_once 'app-arena/Helper.php';
$helper = new Helper();

// Initialize App-Arena Connection
require_once 'app-arena/client/soap_client.php';
$apparena = new Client($aa_api_key);
$instance_id = 0;
$page_id=get_page_id();

var_dump($aa_app_id);
var_dump($page_id);exit();
$apparena->setInstanceId($aa_app_id, $instance_id,$page_id);
$app = $apparena->getData();
$global->app = $app;

$global->instid=$app['instance']['id'];
?>
