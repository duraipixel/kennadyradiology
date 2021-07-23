<?php 
 
error_reporting(0);
if($_SERVER['HTTP_HOST'] == 'localhost'){
	
$config['base_url'] = 'http://localhost/kiranus/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['dummy_base_url'] = 'http://localhost/kiranus/home_test'; 
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://localhost/kiranus/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL','http://localhost/kiranus/');

define('ImageDIR',__DIR__.'/../../uploads/');
define('rootDIR',__DIR__.'/../../');

}
else if($_SERVER['HTPP_HOST'] == 'google-apps.co.in'){

$config['base_url'] = 'http://google-apps.co.in/kiranus/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['dummy_base_url'] = 'http://google-apps.co.in/kiranus/'; 
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://google-apps.co.in/kiranus/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL',$_SERVER['DOCUMENT_ROOT'].'/kiranus/');

define('ImageDIR',__DIR__.'/../../uploads/');
define('rootDIR',__DIR__.'/../../');

}

if($_SERVER['HTTP_HOST'] == 'localhost'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'kiranus'; // Database name
  $config['db_username'] = 'root'; // Database username
  $config['db_password'] = ''; // Database password
  $config['dbport'] = ''; 
  
}
else if($_SERVER['HTPP_HOST'] == 'google-apps.co.in'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'kiranus'; // Database name
  $config['db_username'] = 'kiranus'; // Database username
  $config['db_password'] = 'kiranus@2021'; // Database password
}else {
 
}

	if($_SESSION['lang_id']=='') {
		$_SESSION['lang_id'] = '1';
	}
	
define('TPLPrefix','ib_');
$config['storeid'] = '1';
$config['openurl']=array('home','news_events','resetpassword','verification','home_test'); 

date_default_timezone_set('Asia/Kolkata');

?>
