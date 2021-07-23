<?php
if($_SERVER['HTTP_HOST'] == 'localhost'){
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/kiranus/';
}else{
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/';
}
define('docroots',$docroots);
//include_once($docroot."common/PHPMailerAutoload.php") ;
include "PHPMailerAutoload.php";
$created=date('Y-m-d H:i:s');





?>