<?php
ob_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '300M'); 
ini_set('max_execution_time', '3000');
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
 
if($_SERVER['HTTP_HOST'] == 'localhost'){
	define('root','http://localhost/kiranus/kradmin/');
	define('adminroot','http://localhost/kiranus/kradmin/');
	define('public_url','http://localhost/kiranus/kradmin/');
	define('image_public1_url','http://localhost/kiranus/kradmin/uploads/');
	define('admin_public_url', 'http://localhost/kiranus/kradmin/');
	define('IMG_BASE_URL','http://'.$_SERVER['SERVER_NAME'].'/kiranus/uploads/');
	define('BASE_URL_ADMIN','http://'.$_SERVER['SERVER_NAME'].'/kiranus/kradmin/');
	define('BASE_URL','http://'.$_SERVER['SERVER_NAME'].'/kiranus/kradmin/');
	define('image_replace_url','http://'.$_SERVER['SERVER_NAME'].'/kiranus/');
}
else  if($_SERVER['HTTP_HOST'] == '192.168.0.60'){
	define('root','http://192.168.0.60/kiranus/kradmin/');
	define('adminroot','http://192.168.0.60/kiranus/kradmin/');
	define('public_url','http://192.168.0.60/kiranus/kradmin/');
	define('image_public1_url','http://192.168.0.60/kiranus/kradmin/uploads/');
	define('admin_public_url', 'http://192.168.0.60/kiranus/kradmin/');
	define('IMG_BASE_URL','http://'.$_SERVER['SERVER_NAME'].'/kiranus/uploads/');
	define('BASE_URL_ADMIN','http://'.$_SERVER['SERVER_NAME'].'/kiranus/kradmin/');
	define('BASE_URL','http://'.$_SERVER['SERVER_NAME'].'/kiranus/kradmin/');
	define('image_replace_url','http://'.$_SERVER['SERVER_NAME'].'/kiranus/');
}
else  if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){
	define('root','http://192.168.0.48:8081/kiranus/kradmin/');
	define('adminroot','http://192.168.0.48:8081/kiranus/kradmin/');
	define('public_url','http://192.168.0.48:8081/kiranus/kradmin/');
	define('image_public1_url','http://192.168.0.48:8081/kiranus/kradmin/uploads/');
	define('admin_public_url', 'http://192.168.0.48:8081/kiranus/kradmin/');
	define('IMG_BASE_URL','http://'.$_SERVER['SERVER_NAME'].':8081/kiranus/uploads/');
	define('BASE_URL_ADMIN','http://'.$_SERVER['SERVER_NAME'].':8081/kiranus/kradmin/');
	define('BASE_URL','http://'.$_SERVER['SERVER_NAME'].':8081/kiranus/kradmin/');
	define('image_replace_url','http://'.$_SERVER['SERVER_NAME'].':8081/kiranus/');
}
else{
	define('root',$_SERVER['DOCUMENT_ROOT'].'/kiranus/kradmin/');
	define('adminroot','http://pixel-studios.net/kiranus/kradmin/');
	define('image_public1_url','http://pixel-studios.net/kiranus/uploads/');
	define('public_url','http://pixel-studios.net/kiranus/kradmin/');
	define('admin_public_url','http://pixel-studios.net/kiranus/kradmin/');
	define('IMG_BASE_URL','http://pixel-studios.net/kiranus/uploads/');
	define('BASE_URL_ADMIN','http://pixel-studios.net/kiranus/kradmin/');
	define('BASE_URL','http://pixel-studios.net/kiranus/kradminr/');
	define('image_replace_url','http://pixel-studios.net/kiranus/');
}
 
define('Brand','Kiran RPA');
define('Spanish','SPN');
define('Portuguese','PT');

define('LANGUAGE_EID','1');
define('LANGUAGE_SID','2');
define('LANGUAGE_PID','3');

define('DB_PREFIX',"kr_");
define('TPLPrefix',"kr_");
define('store_id','1');

/**************************************** Database Tables *******************************/
define('tbl_configuration',DB_PREFIX."configuration");
define('tbl_imageconfig',DB_PREFIX."imageconfig");
define('tbl_menus',DB_PREFIX."menus");
define('tbl_modules',DB_PREFIX."modules");
define('tbl_modulemenus',DB_PREFIX."modulemenus");
define('tbl_roles',DB_PREFIX."roles");
define('tbl_userlog',DB_PREFIX."userlog");
define('tbl_users',DB_PREFIX."users");
define('tbl_useracl',DB_PREFIX."user_acl");
define('tbl_user_session',DB_PREFIX."user_session"); 
define('tbl_loginstatus',DB_PREFIX."loginstatus");

require_once(__DIR__."/queryscontainer.php");

$docroot =  $_SERVER['DOCUMENT_ROOT'].'/kiranus/uploads/';
define('docroot',$docroot);
if($_SERVER['HTTP_HOST'] == 'localhost'){
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/kiranus/kradmin/';
}else if($_SERVER['HTTP_HOST'] == '192.168.0.60'){
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/kiranus/kradmin/';
}
else if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){
	$docroots=$_SERVER['DOCUMENT_ROOT'].':8081/kiranus/kradmin/';
}

else if($_SERVER['HTTP_HOST'] == 'pixel-studios.net'){
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/kiranus/kradmin/';
}

else if($_SERVER['HTPP_HOST'] == 'google-apps.co.in'){	
    $docroots=$_SERVER['DOCUMENT_ROOT'].'/';
    }else{
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/';
}

	// Include ezSQL core
	include_once ('ez_sql_core.php');
	// Include ezSQL database specific component
	include_once ('ez_sql_mysqli.php');
	// Initialise database object and establish a connection
	// at the same time - db_user / db_password / db_name / db_host
	// db_host can "host:port" notation if you need to specify a custom port
	//print_r($_SERVER['HTTP_HOST']); die();
	if($_SERVER['HTTP_HOST'] == 'localhost'){	
		$db = new ezSQL_mysqli('root','','kiranus','localhost');
	}else if($_SERVER['HTTP_HOST'] == '192.168.0.60'){	
		$db = new ezSQL_mysqli('root','','kiranus','localhost');
	}else if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){		
		//$db = new ezSQL_mysqli('root','','kiranus','localhost','3308');	
		$db = new ezSQL_mysqli('root','','kirandata','localhost','3308');	
	}else{
	    $db = new ezSQL_mysqli('kiranecom','kiranecom@321','kiranecom','localhost');	
	}
	
	//print_r($db); die();

	$resdatetime=getquerys($db,"datetimezone");	
	date_default_timezone_set($resdatetime['value']);	
	$GLOBALS['stroedateformat']=getQuerys($db,"getdateformat");
	$GLOBALS['watermark']=getQuerys($db,"watermark");
	$GLOBALS['allcon']=getQuerys($db,"allconfigurable");

define('rupeesymbol','<i class="fa fa-inr"></i>');
ob_flush();
?>