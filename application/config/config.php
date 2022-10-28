<?php 
date_default_timezone_set('Asia/Kolkata');
error_reporting(1);

$request_url_check = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
if (strpos($request_url_check,'/spn') !== false || strpos($request_url_check,'/spn/') !== false) {
   $_SESSION['lang_id'] = '2';
		$_SESSION['lang_pre'] = 'spn/';
		$_SESSION['lang_name'] = 'Spanish';
		$_SESSION['lang_css'] = 'spn';
} else if (strpos($request_url_check,'/pt') !== false || strpos($request_url_check,'/pt/') !== false) {
   $_SESSION['lang_id'] = '3';
		$_SESSION['lang_pre'] = 'pt/';
		$_SESSION['lang_name'] = 'Portugueses';
		$_SESSION['lang_css'] = 'pt';
}
else{
	$_SESSION['lang_id'] = '1';
		$_SESSION['lang_pre'] = '';
		$_SESSION['lang_name'] = 'English';
		$_SESSION['lang_css'] = 'en';
}

//	echo "kk".$_SESSION['lang_pre'];die();
	
if($_SERVER['HTTP_HOST'] == 'localhost'){
  $config['base_url'] = 'http://localhost/kiranus/'; // Base URL including trailing slash (e.g. http://localhost/)
  $config['default_controller'] = 'home'; // Default controller to load
  $config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
  define('img_base_url','http://localhost/kiranus/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)
  define('img_url','http://localhost/kiranus/projects/');
  define('PAGEADMIN_URL','http://localhost/kiranus/');

} else if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){
  $config['base_url'] = 'http://192.168.0.48:8081/kiranus/'.$_SESSION['lang_pre']; // Base URL including trailing slash (e.g. http://localhost/)
  $config['default_controller'] = 'home'; // Default controller to load
  $config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
  define('img_base_url','http://192.168.0.48:8081/kiranus/uploads/');
  define('img_base','http://192.168.0.48:8081/kiranus/'); // Base URL including trailing slash (e.g. http://localhost/)
  define('img_url','http://192.168.0.48:8081/kiranus/uploads/');
  define('PAGEADMIN_URL','http://192.168.0.48:8081/kiranus/');
  define('BASE_URL_LANG','http://192.168.0.48:8081/kiranus/'.$_SESSION['lang_pre']);
}
else if($_SERVER['HTTP_HOST'] == '192.168.0.60'){
    $config['base_url'] = 'http://192.168.0.60/kiranus/'.$_SESSION['lang_pre']; // Base URL including trailing slash (e.g. http://localhost/)
    $config['default_controller'] = 'home'; // Default controller to load
    $config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
    define('img_base_url','http://192.168.0.60/kiranus/uploads/');
    define('img_base','http://192.168.0.60/kiranus/'); // Base URL including trailing slash (e.g. http://localhost/)
    define('img_url','http://192.168.0.60/kiranus/uploads/');
    define('PAGEADMIN_URL','http://192.168.0.60/kiranus/');
    define('BASE_URL_LANG','http://192.168.0.60/kiranus/'.$_SESSION['lang_pre']);
}
else{
$config['base_url'] = 'http://pixel-studios.net/kiranus/'.$_SESSION['lang_pre']; // Base URL including trailing slash (e.g. http://localhost/)
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://pixel-studios.net/kiranus/uploads/');
define('img_base','http://pixel-studios.net/kiranus/'); // Base URL including trailing slash (e.g. http://localhost/)
define('img_url','http://pixel-studios.net/kiranus/uploads/');
define('PAGEADMIN_URL','http://pixel-studios.net/kiranus/');
define('BASE_URL_LANG','http://pixel-studios.net/kiranus/'.$_SESSION['lang_pre']);
define('TVT_BASE_URL','https://pixel-studios.net/kennedy_radiology/'); 
 
}

/**************************************** Admin Tables *******************************/

if($_SERVER['HTTP_HOST'] == 'localhost'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'kiranus'; // Database name
  $config['db_username'] = 'root'; // Database username
  $config['db_password'] = ''; // Database password
}else if($_SERVER['HTTP_HOST'] == '192.168.0.60'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'kiranus'; // Database name
  $config['db_username'] = 'root'; // Database username
  $config['db_password'] = ''; // Database password
}
else if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'kenndy_radiology'; // Database name
  $config['db_username'] = 'root'; // Database username
  $config['db_password'] = ''; // Database password
  $config['dbport'] = '3308'; // Database password
}
else{   
 $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
 $config['db_name'] = 'kiranecom'; // Database name
 $config['db_username'] = 'kiranecom'; // Database username
 $config['db_password'] = 'kiranecom@321'; // Database password
}

define("apronids",array('1','2','3','4','5','6','7','11','12'));
define("aproncolor",array('1','2','3'));
define("apronmaterial",array('7','11','12'));
define("apronsize",array('4','5','6'));
define("apronname","radiation-protection-apparel");

define('TPLPrefix','kr_');
$config['storeid'] = '1';
$config['openurl']=array('home','news_events','resetpassword','verification','home_test','knowledgecenter','knowledgecenter_details','feature_stories','events','news'); 
define("PRICE_SYMBOL","$");
date_default_timezone_set('Asia/Kolkata');
if($_SESSION['lang_id']== 1){
define('countryname','Country');
define('statename','Select State');
}else if($_SESSION['lang_id']== 2){
	define('countryname','Country es');
define('statename','Select State es');
}else if($_SESSION['lang_id']== 3){
	define('countryname','Country pt');
    define('statename','Select State pt');
}
//echo $_SESSION['lang_id']."sessionid";die();
 define('BCCEMAIL','kennedyradiology@trivitron.com');
 define('markup_pent',1.5);

 define('CLIENT_ID', 'AcGWzi4E893_1gk11XXEUnLa2ZrFMt-5amBT4iWY96FwpXqEc7kpRlEI5j2fS19fpUMH88WWbTCIinkd');
 define('CLIENT_SECRET', 'EPw9vVPlN6m6qHtVAchC-pro-TOJAMFNvFeMcuftCGd7aQiqveZ_aebC5BlewdKJgSGYX9j0PnyfV8Z4');
 
 define('PAYPAL_RETURN_URL', 'checkout/successPayment');
 define('PAYPAL_CANCEL_URL', 'checkout/cancelPayment');
 define('PAYPAL_CURRENCY', 'USD'); // set your currency here
?>