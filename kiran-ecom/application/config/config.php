<?php 
// local 
date_default_timezone_set('Asia/Kolkata');

error_reporting(0);
if($_SERVER['HTTP_HOST'] == 'localhost'){
$config['base_url'] = 'http://localhost/kiran-ecom'; // Base URL including trailing slash (e.g. http://localhost/)
$config['default_controller'] = 'main'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://localhost/kiran-ecom/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)
define('img_url','http://localhost/kiran-ecom/projects/');
define('PAGEADMIN_URL','http://localhost/kiran-ecom/');

}
else{

$config['base_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/clients/kiran-ecom/'; // Base URL including trailing slash (e.g. http://localhost/)
$config['default_controller'] = 'main'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)
define('img_base_url','http://'.$_SERVER['SERVER_NAME'].'/clients/kiran-ecom/uploads/');
define('img_url','http://'.$_SERVER['SERVER_NAME'].'/clients/kiran-ecom/uploads/'); // Base URL including trailing slash (e.g. http://localhost/)

define('PAGEADMIN_URL','http://'.$_SERVER['SERVER_NAME'].'/clients/kiran-ecom/');
define('MAILLOGO','http://'.$_SERVER['SERVER_NAME'].'/clients/kiran-ecom/uploads/logo/');
define('resumeurl','http://'.$_SERVER['SERVER_NAME'].'/clients/kiran-ecom/uploads/resume/');
}

/**************************************** Admin Tables *******************************/

if($_SERVER['HTTP_HOST'] == 'localhost'){
  //$config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  //$config['db_name'] = 'kiran'; // Database name
  //$config['db_username'] = 'root'; // Database username
  //$config['db_password'] = ''; // Database password
}else{
    
  //$config['db_host'] = 'localhost'; // Database host (e.g. localhost)
  //$config['db_name'] = 'mvc'; // Database name
 // $config['db_username'] = 'mvc'; // Database username
  //$config['db_password'] = 'mvc@123'; // Database password
}

define('DB_PREFIX',"firm_");

define('TBL_PREFIX',"firm_");
/**************************************** Database Tables *******************************/

//$config['storeid'] = '1';
//$config['openurl']=array('project_details'); 


?>