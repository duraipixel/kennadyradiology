<?php 
// local 
date_default_timezone_set('Asia/Kolkata');

error_reporting(0);
if($_SERVER['HTTP_HOST'] == 'localhost'){
$config['base_url'] = 'http://localhost/kiranus/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://localhost/kiranus/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)
define('img_url','http://localhost/kiranus/projects/');
define('PAGEADMIN_URL','http://localhost/kiranus/');

}
else{

$config['base_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/clients/kiranus/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://'.$_SERVER['SERVER_NAME'].'/clients/kiranus/uploads/');
define('img_url','http://'.$_SERVER['SERVER_NAME'].'/clients/kiranus/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL','http://'.$_SERVER['SERVER_NAME'].'/clients/kiranus/');
define('MAILLOGO','http://'.$_SERVER['SERVER_NAME'].'/clients/kiranus/uploads/logo/');
define('resumeurl','http://'.$_SERVER['SERVER_NAME'].'/clients/kiranus/uploads/resume/');
}

/**************************************** Admin Tables *******************************/

if($_SERVER['HTTP_HOST'] == 'localhost'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'kiranus'; // Database name
  $config['db_username'] = 'root'; // Database username
  $config['db_password'] = ''; // Database password
}else{
    
  //$config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  //$config['db_name'] = 'mvc'; // Database name
 // $config['db_username'] = 'mvc'; // Database username
  //$config['db_password'] = 'mvc@123'; // Database password
}

if($_SESSION['lang_id']=='') {
		$_SESSION['lang_id'] = '1';
	}
	
define('TPLPrefix','kr_');
$config['storeid'] = '1';
$config['openurl']=array('home','news_events','resetpassword','verification','home_test'); 

date_default_timezone_set('Asia/Kolkata');


?>