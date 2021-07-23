<?php 
include 'session.php';
extract($_REQUEST);

try{
$user_id=$_REQUEST['user_id']; 
$user_email=$_REQUEST['user_email'];
$new_pwd=$_REQUEST['new_pwd'];  

$update=$db->insert("update ".TPLPrefix."users set user_pwd='".md5($new_pwd)."' where user_ID='".$user_id."' and user_name='".$user_email."'  " );

echo "success";  
}

catch (Exception $e) {
	$res = "error";
	echo "error"; //same exists
}

?>