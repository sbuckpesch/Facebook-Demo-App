<?php
// Enable Cookies for Internet Explorer in iframes
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

// Load config
require_once dirname(__FILE__).'/config.php';
require_once 'lib/fb-php-sdk/src/facebook.php';

// General Settings
error_reporting(E_ALL|E_STRICT);
if ($debugMode)
	ini_set('display_errors', 1);
else ini_set('display_errors', 0);
date_default_timezone_set('Europe/Berlin');

//set include path
define("ROOT_PATH",realpath(dirname(__FILE__)));
set_include_path(ROOT_PATH.'/lib/' . PATH_SEPARATOR .
  ROOT_PATH.'/modules/' . PATH_SEPARATOR .
  get_include_path());
  
// Register Zend autoload
require_once "Zend/Loader/Autoloader.php";
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

// Set global variable
$global = new ArrayObject();

// Init Session if already exists
$session = new Zend_Session_Namespace('aa_session' . $aa_app_id);
$session->setExpirationSeconds(60*60); // Session lives one hour

// Init Database connection
$db_config=array(
  'host'=>$database_host,
  'username'=>$database_user,
  'password'=>$database_pass,
  'dbname'=>$database_name
);
$db = Zend_Db::factory('mysqli',$db_config);
$db->query('set names utf8');
Zend_Db_Table::setDefaultAdapter($db);
$global->db = $db;

// Initialize App-Arena Connection and get all data if not available in session
require_once 'AA/client/soap_client.php';
// Request data from app-arena system
//if ($debugMode || !isset($session->instance) || !isset($session->design) || !isset($session->content) || !isset($session->config)) {
	$soap = new Client($aa_api_key);
	$global->soap = $soap;
	$aa_app = $soap->getData($aa_app_id, $aa_api_key);
	// Save App-Arena Data to Session
	try {
		$session->instance = $aa_app['instance'];
		$session->instance['id'] = $aa_app['instance']['instance_id'];
        $session->config = $aa_app['config'];
        $session->content = $aa_app['content'];
        $session->design = $aa_app['design'];
	} catch (Exception $e) {
		throw new Exception("SOAP connection to App-Arena service could not be established.");
	}
//}

// Get Facebook User data, signed_request from session or from $_REQUEST
// Update Session, if the user data has changed


$signed_request = false;
$user = false;
if (isset($session->fb_api['signed_request']))
	// If signed request contains actualized data, update user data
	if (isset($_REQUEST['signed_request']) && $_REQUEST['signed_request'] <> $session->fb_api['signed_request'])
		$signed_request = $_REQUEST['signed_request'];
	else
		$signed_request = $session->fb_api['signed_request'];
else if (isset($_REQUEST['signed_request']))
	$signed_request = $_REQUEST['signed_request'];
if ($signed_request){
	try {
		$user = new AA_Fb_User($signed_request, $session->instance['fb_app_secret'], $session->instance['fb_app_id']);
	} catch (Exception $e) {
		throw Exception("Could not get User Data from Facebook API.");
	}
	// Gathering user data for the session
	$global->user = $user;
	$session->user = $user->request_data['user'];
	$session->fb_api['signed_request'] = $signed_request;
	if (isset($user->request_data['user_id'])){
		$session->user['id'] = $user->request_data['user_id'];
	} else {
		if (isset($user->user_id)) {
			$session->user['id'] = $user->user_id;
		}
	}
	// Gathering available page data for the session 
	if (isset($user->request_data['page'])){
		$session->fb_page = $user->request_data['page'];
		$session->fb_page['url'] = "https://www.facebook.com/" . $session->instance['fb_page_url'];
        $session->fb_page['app_url'] = $session->fb_page['url'] . "?sk=app_" . $session->instance['fb_app_id'];
	}
}
?>
