<?php 
 
error_reporting(0);
if($_SERVER['HTTP_HOST'] == '192.168.0.60'){
	
$config['base_url'] = 'http://192.168.0.60/inbase/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['dummy_base_url'] = 'http://192.168.0.60/inbase/home_test'; 
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://192.168.0.60/inbase/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL','http://192.168.0.60/inbase/');

define('ImageDIR',__DIR__.'/../../uploads/');
define('rootDIR',__DIR__.'/../../');

}
else if($_SERVER['HTPP_HOST'] == 'google-apps.co.in'){

$config['base_url'] = 'http://google-apps.co.in/inbase/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['dummy_base_url'] = 'http://google-apps.co.in/inbase/'; 
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://google-apps.co.in/inbase/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL',$_SERVER['DOCUMENT_ROOT'].'/inbase/');

define('ImageDIR',__DIR__.'/../../uploads/');
define('rootDIR',__DIR__.'/../../');

}
else {

$config['base_url'] = 'https://www.inbasetech.in/beta/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['dummy_base_url'] = 'https://www.inbasetech.in/beta/'; 
$config['default_controller'] = 'home'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','https://www.inbasetech.in/beta/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL',$_SERVER['DOCUMENT_ROOT'].'/beta/');

define('ImageDIR',__DIR__.'/../uploads/');
define('rootDIR',__DIR__.'/../');

}

if($_SERVER['HTTP_HOST'] == '192.168.0.60'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'inbase'; // Database name
  $config['db_username'] = 'root'; // Database username
  $config['db_password'] = ''; // Database password
  $config['dbport'] = ''; 
  
}
else if($_SERVER['HTPP_HOST'] == 'google-apps.co.in'){
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'inbase_default'; // Database name
  $config['db_username'] = 'inbase'; // Database username
  $config['db_password'] = 'sxCza01N9vL4'; // Database password
}else {
/*  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'inbase_default'; // Database name
  $config['db_username'] = 'inbase'; // Database username
  $config['db_password'] = 'sxCza01N9vL4'; // Database password*/
  $config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  $config['db_name'] = 'admin_inbasedb'; // Database name
  $config['db_username'] = 'admin_inbasedb'; // Database username
  $config['db_password'] = 'X54mrlaOmd'; // Database password
}

define('TPLPrefix','ib_');
$config['storeid'] = '1';
$config['openurl']=array('home','news_events','resetpassword','verification','home_test'); 

date_default_timezone_set('Asia/Kolkata');

?>
