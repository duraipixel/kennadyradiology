<?php  include_once "session.php";
			$time=time();
			if($_SESSION["UserId"]!=''){
			$getmaxid=$db->get_a_line("select max(Id) as id from  ".TPLPrefix."loginstatus where UsrId='".$_SESSION["UserId"]."' ");
		
			$db->insert(" update ".TPLPrefix."loginstatus set Logout_time='".date("Y-m-d H:i:s")."' where Id='".$getmaxid['id']."' " );
			
			}
			session_destroy();
			if($_REQUEST['f'] == '1'){
			header("Location:index.php");			
			exit;	
			}
			else
			{
			header("Location:index.php?err=lo");
			setcookie("admin","",0,"/");
			exit;
			}
?>