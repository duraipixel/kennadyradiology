<?php
ob_start();ob_flush();
error_reporting(0);
session_start();

if(!empty($_SESSION["UserId"]) && $_SESSION["UserId"]!='' && $_REQUEST['err']!='ses'){
	header("location:dashboard.php");
	exit();
}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>KiranUS | Admin</title>
<link rel="icon" type="image/x-icon" href="assets/imges/favicon.ico"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="assets/css/users/login-2.css" rel="stylesheet" type="text/css" />
 <!----- loader Style--->
    <link href="plugins/loaders/csspin.css" rel="stylesheet" type="text/css" />
    <link href="plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <!-- loader style--->
<!-- END GLOBAL MANDATORY STYLES -->
</head>
<?php 
extract($_POST);
$error="";
if(isset($_REQUEST['err'])) {
	$err=$_REQUEST['err'];
	if($err=="invup"){
		  $text = 'Invalid Username/Password!';
		  $iserror = 1;
		
	}
	elseif($err=="invu"){
		$text = 'Invalid Username!';
		$iserror = 1;
	}
	elseif($err=="lo"){
		$text = 'You have successfully logged out!';
		$iserror = 2;
 	}
	elseif($err=="invp"){
		$text = 'Invalid Password!';
		$iserror = 1;
	}
	elseif($err=="ac"){
		$text = 'You have yet to activate your account!';
		$iserror = 1;
	}
	elseif($err=="ses"){
		$text = 'Session Time Out! Please log in again.';
		$iserror = 3;
 	}	
	elseif($err=="rstpwdsucc"){
		$text = 'Your password is reset successfully!';
		$iserror = 3;
	}	
	elseif($err=="rstpwdfail"){
		$text = ' Your password is not reset. Please try again!';
		$iserror = 1;
	}
	elseif($err=="notmap"){
		$text = ' Acces Denied Contact Admin !';
		$iserror = 1;
	}
	
	else{
		$error="";
		$iserror = 0;
	}	
}

if($iserror == 1){
$error = '	<div class="alert alert-light-danger br-50 mb-4" role="alert"> 
				<i class="flaticon-cancel-12 close" data-dismiss="alert"></i> 
				<strong>Error!</strong> '.$text.'
   			 </div>';
}else if($iserror == 2){
$error = '<div class="alert alert-light-info br-50 mb-4" role="alert"> 
				<i class="flaticon-cancel-12 close" data-dismiss="alert"></i> 
				<strong>Error!</strong> '.$text.'
   			 </div>';
}else if($iserror == 3){
$error = '<div class="alert alert-light-warning br-50 mb-4" role="alert"> 
				<i class="flaticon-cancel-12 close" data-dismiss="alert"></i> 
				<strong>Error!</strong> '.$text.'
   			 </div>';
}else{
$error = '';	
}

?>

<body class="login">
<div class="col-md-5 offset-md-4 text-right">
  <form class="form-login needs-validation" id="formvalidate-login" action="dashboard.php" method="post">
    <div class="row">
      <div class="col-md-12 text-center mb-4"> <img alt="logo" src="assets/img/logo-3.png" class="theme-logo"> </div>
      <div class="col-md-12">
        <label for="inputEmail" class="sr-only">Email address</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend"> <span class="input-group-text" id="icon-inputEmail"><i class="flaticon-user-7"></i> </span> </div>
          <input type="email" name="username" id="username" class="form-control" placeholder="Email Address" aria-describedby="inputEmail" required >
        </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <div class="input-group mb-4">
          <div class="input-group-prepend"> <span class="input-group-text" id="icon-inputPassword"><i class="flaticon-key-2"></i> </span> </div>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="inputPassword" required >
        </div>
        <input type="hidden" name="submt" id="submt" value="login" />
        <button class="btn btn-lg btn-gradient-warning btn-block btn-rounded mb-4 mt-5"  type="submit">Login</button>
      </div>
    </div>
    
     <?php echo $error;?>  
  </form>
</div>
<!-- onClick="return loginCheck()"-->
<div id="load" style=" background:url(images/overly.png) repeat; width:100%; display:none; height:100%; position:fixed;top:0; left:0;z-index:10000; padding-top:1%; ">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="middle"><table width="425" align="center"  style="border:0px solid #f0f0f0;"   border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="middle">
            	<div align="center" class="loading" style="border:0px solid #fff;"> 
                	<div class="cp-spinner cp-bubble"></div><br /><br/>
                <div id="convprogress"> </div>
              </div></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>


<?php echo date('Y');?> &copy; KiranUS. All Rights Reserved
 
<!-- BEGIN GLOBAL MANDATORY SCRIPTS --> 
<script src="assets/js/libs/jquery-3.1.1.min.js"></script> 
<script src="bootstrap/js/popper.min.js"></script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript">		
	function loading() {			
		document.getElementById("load").style.display = 'block';
	}
	
	function unloading() {
		document.getElementById("load").style.display = 'none';
	}
	</script>

</body>
</html>