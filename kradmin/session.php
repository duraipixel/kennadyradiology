<?php
ob_start();ob_flush();
ini_set('session.name', 'ADMPHPSESSID');
#ini_set('session.gc_maxlifetime',20*60*60);
#session_set_cookie_params(20*60*60);
session_start();

include_once("include/config_db.php");
include_once("include/database.class.php");
include_once("include/common.class.php");

ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600); 

//include_once("commonmsg.php");
$common=new common;
date_default_timezone_set("Asia/kolkata");
$path=$common->path;
$created=date('Y-m-d H:i:s'); 


//echo session_id();die();
class Session
{
	function hashgenwithsessionid()
	{
 		$hash = md5(session_id());
 		return $hash;
 	}

    function verifylogin($db,$common,$funame,$fPass)
	{	
	
			
		if($funame=="" && $fPass=="" )
		{
			header("Location:".admin_public_url."index.php?err=empinvup");			
		} else {
			$funame=addslashes($funame);		
			$fPass=addslashes($fPass);
					
			if(!empty($funame))
			$funame = str_replace("'", "", $funame);
			$funame = strtolower($funame);
			$mysqlfst="select * from ".tbl_users." where user_email=?";
			$urslt=$db->get_a_line_bind($mysqlfst,array(getRealescape(strtolower($funame))));
 
					
			$pname=$urslt['user_pwd'];
			$mysqlsec="select * from ".tbl_users." where user_email=? and user_pwd=?";			 
			$prslt=$db->get_a_line_bind($mysqlsec,array(getRealescape(strtolower($funame)),trim(md5($fPass))));		
				
			  $uname=trim($prslt['user_email']);
		 
			//print_r(array(getRealescape(strtolower($funame)),md5($fPass)));
			 					
			if($pname=="" && $uname=="" )
			{
				header("Location:".admin_public_url."index.php?err=invup");			
			} 
			elseif($pname=="" && $uname!="")
			{
				header("Location:".admin_public_url."index.php?err=invu");
			}
			elseif($pname!="" && $uname=="")
			{
				header("Location:".admin_public_url."index.php?err=invp");
			}
			
			elseif($pname!=$fPass && $uname!=$funame)
			{
				header("Location:".admin_public_url."index.php?err=invp");
			}
			
			
			if($pname!="" && $uname!="")
			{
				$mysql="select distinct s.user_ID, s.user_firstname,s.user_lastname, s.user_name, s.user_pwd, s.user_email, s.RoleId, s.user_photo,  r.RoleName, s.IsActive from ".tbl_users." s 			
				 inner join ".tbl_roles." r on r.RoleId=s.RoleId and r.IsActive=1 where s.user_email='".strtolower($funame)."' and  s.user_pwd='".md5($fPass)."' and s.IsActive = '1' ";			 			 
				$rslt=$db->get_a_line_bind($mysql,array(getRealescape(strtolower($funame)),md5($fPass)));

		
			
				if($rslt[0]=="")
				{
				header("Location:".admin_public_url."index.php?err=ac");
				}
				if($rslt[0]!="")
				{
					
					$username=$rslt["user_email"];
					$password=$rslt["user_pwd"];
					$userid=$rslt["user_ID"];
					$_SESSION["RoleId"]=$rslt["RoleId"];
					$_SESSION["userPhoto"]=$rslt["user_photo"];
					$_SESSION["RoleName"]=$rslt["RoleName"];
					$_SESSION["UName"]=$rslt["user_firstname"];
					$_SESSION["ULName"]=$rslt["user_lastname"];
					$_SESSION["UEmail"]=$rslt["user_email"];
					$_SESSION["UserId"]=$userid;
					$_SESSION["IsActive"]=$rslt["IsActive"];
				
									
					$id=$userid;
					
					$admin_id=$_SESSION["UserId"];							 				
					
					$_SESSION['TempRoleId'] = $rslt["RoleId"];
					$q="select * from ".tbl_user_session." where user_id=?";
					$r=$db->get_a_line_bind($q,array(getRealescape($userid)));
					$last_export = $r[last_export];
					$hash=$this->hashgenwithsessionid();
					setcookie("kiranadmin",$hash,0,"/");

					$time=time();
					$str="select * from ".tbl_user_session." where user_id='$userid'";				
					$res=$db->get_a_line_bind($str,array(getRealescape($userid)));
									
					$db->insert_bind("insert into ".tbl_loginstatus." (UsrId) VALUES(?)",array(getRealescape($_SESSION['UserId'])));
					$_SESSION['login_id'] = $db->insert_id;
										
					if($res['user_id']!="")
					{				  
						$mysql="update ".tbl_user_session." set hash=?,timestamp=?,last_export=? where user_id=?";
						$db->insert_bind($mysql,array(getRealescape($hash),getRealescape($time),getRealescape($last_export),getRealescape($userid)));	
												
					} 
					else {
						$mysql="insert into ".tbl_user_session." (user_id,hash,timestamp,last_export) values('$userid','$hash','$time','$last_export')";
						$db->insert_bind($mysql,array(getRealescape($userid),getRealescape($hash),getRealescape($time),getRealescape($last_export)));
					}
				
					return $userid;	
				} else if($urslt=="" && $prslt=="") {
					header("Location:".admin_public_url."index.php?err=invup");
					exit;
				}
			}	
		
		}
	}
}
 //if ($csrf->csrf_validate($_POST['gps-pixel'])) {
$obj=new Session;
/*if(isset( $_REQUEST['mn'] ) &&  $_REQUEST['mn'] == 'fnt') {
	$_REQUEST['username'] = base64_decode($_REQUEST['username']);
	$_REQUEST['password'] = base64_decode($_REQUEST['password']);
}

*/
if(trim($_REQUEST['submt']) == "login")
{

   $admin_id=$obj->verifylogin($db,$common,$_REQUEST['username'],$_REQUEST['password']);	
   $_SESSION['storeall'] = array("1","0");
   if(isset($_REQUEST['frontlog']))
   {
	   echo '{"err":"0","msg":"sucess"}';   
	   exit;
   }   
}
else
{
  $hash = $_COOKIE['kiranadmin'];
  $temphash=md5(session_id());
  
	if($temphash==$hash && count($_SESSION)>0)
	{
	 
	  $admin_id=$common->check_user_session($hash,$db);
 
		if($admin_id=="" || $admin_id==0)
		{
			header("Location:".admin_public_url."index.php?err=ses");
			exit;
		}
		else
			setcookie("kiranadmin",$hash,0,"/");
			$_SESSION['storeall'] = array("1","0");	
	}
	else
	{	 
		header("Location:".admin_public_url."index.php?err=ses");
		exit;  
	}	
}
/*} else {
	header("Location:".admin_public_url."index.php?err=notmap");
		exit; 
	
} */
/*function Logoutadmin($db)
{	
	$db->insert_bind("update ".tbl_loginstatus."  set Logout_time= CURRENT_TIMESTAMP() where UsrId =? and Id=? ",array(getRealescape($_SESSION['UserId']),getRealescape($_SESSION['login_id'])));
	$mysql="delete from ".tbl_user_session." where user_id=? ";
	$db->insert_bind($mysql,array(getRealescape($_SESSION['UserId'])));
	return true;
}
*/


function getRealescape($data)
{	
	$escape = 	str_replace("'","\'",trim($data));

	$escape = 	str_replace("\\'","\'",trim($escape));
	
	return $escape;
}
function getMdme($db,$tabl=null,$col=null)
{
	$str_mdl = "SELECT mmu.ModuleMenuId FROM `".tbl_modules."` mdl inner join ".tbl_modulemenus." mmu on mdl.ModuleId = mmu.ModuleId and  mmu.IsActive = 1 where mdl.ModulePath = ?  and mdl.IsActive = 1";
	return $db->get_a_line_bind($str_mdl,array(getRealescape($col)));
}

function getdynamicimage($db,$name,$fname){			
	$getsiz = $db->get_rsltset_bind("select concat(imageconfigWidth,'-',imageconfigHeight) as imagesize,foldername from ".tbl_imageconfig." where IsActive = 1 and imageconfigModule = ? ",array(getRealescape($name)));
	
//echo "<br>";	print_r($getsiz); exit;
	
	foreach($getsiz as $sizval) {
		$sizes[] = $sizval['imagesize'];
		$associativeArray[$sizval['imagesize']] = $sizval['foldername'];
	}
	
	foreach($associativeArray as $k => $id){
		$aMemberships[$k] = $id;
	}
	return $aMemberships;			
}

function getimagesize_large($db,$name,$fname){ 
	$getsiz = $db->get_a_line_bind("select concat(imageconfigWidth,'-',imageconfigHeight) as imagesize,foldername from ".tbl_imageconfig." where IsActive = 1 and foldername = ? and imageconfigModule = ? ",array(getRealescape($fname),getRealescape($name)));
	return $getsiz['imagesize'];			
}
	
function getUserinfo($db,$userid){
	$homestr_ed = "select * from ".tbl_users." where IsActive != '2' and user_ID = ? ";
	$homeres_ed = $db->get_a_line_bind($homestr_ed,array(getRealescape($userid)));
	return $homeres_ed;
}
	
function getYouTubeVideoId($pageVideUrl) {
    $link = $pageVideUrl;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}

$db->get_a_line("SET SESSION group_concat_max_len = 100000000");


function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function formatdate($date,$format){
if($format == '/'){
	$date = date('d/m/Y',strtotime($date));	
}
return $date;
}


function moneyFormatIndia_session($amount){
	if($amount == 0){return 0;}else{
	$amount=	sprintf('%.2f',$amount);
$converted=explode(".",$amount);
$num=$converted[0];
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i < sizeof($expunit);  $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash.'.'.$converted[1]; // writes the final format where $currency is the currency symbol.
}
}


function searchkeyvalue($searchtext,$arrays,$fieldname="key",$returnvalue="value")
{
	
	 foreach ($arrays as $arr) {
		 
		   if (strtolower($arr[$fieldname])==strtolower($searchtext)) { 
				 return $arr[$returnvalue];
		}
		//die();
	 }
   return '';	
}

function searchkeyArray($searchtext,$arrays,$fieldname="key")
{
	 foreach ($arrays as $arr) {
		   if (strtolower($arr[$fieldname])==strtolower($searchtext)) { 
				 return $arr;
		}
		//die();
	 }
   return '';	
}

function searchIsDisplay($searchtext,$arrays)
{
	 foreach ($arrays as $arr) {
	
		   if (strtolower($arr['key'])==strtolower($searchtext)) { 
				 return $arr['IsDisplay'];
		}
		//die();
	 }
   return '0';	
}

//return Y-m-d
function getdateFormat($db,$date)
{
	 $datetimezone=getQuerys($db,"dateFormat");
 	try{
	switch($datetimezone['value'])
	{
		
		case "1":
		
		$changedate = date('Y-m-d',strtotime($date));
		
		break;
		
		case "2":
		  $date = str_replace('-', '/', $date);
		  $changedate = date('Y-m-d',strtotime($date));
		break;
		
		case "3":
			 $date = str_replace('/', '-', $date);
		  $changedate = date('Y-m-d',strtotime($date));
		break;
		
		case "4":
		  $date = str_replace('/', '-', $date);
		  $changedate = date('Y-m-d',strtotime($date));
		  
		break;
		
        default:
			$changedate =  $date;
			
	}
 	
	}
		catch(Exception $e) {
				$changedate = '';
		}
	
	return $changedate;
}


function encrpt_decrpt_data( $string, $action = 'e' ) {
  // echo "kalai";
	
	  $secret_key = secret_key;
	 $finalkey = substr(hex2bin(hash( 'sha512', $secret_key )),0,15);
	
	$method = 'aes-128-ecb';
	
     if( $action == 'e' ) {
        $output = base64_decode( openssl_encrypt($string, $method, $finalkey));
		$output =bin2hex( $output);
    }
    else if( $action == 'd' ){
		$string=hex2bin($string);	
        $output = openssl_decrypt(base64_encode($string) , $method, $finalkey);
		//echo $output; die();
    }
	if(empty($output) || $output==false)
		$output='';
	
    return $output;
	
}	
 
function httpRequest($db, $method= "GET", $body = NULL) {
	
	$resAppid=$db->get_a_line("select * from ".TPLPrefix."app where id = '1' ");
	
    if (!$method) {
        $method = "GET";
    }
   //echo  $method; exit;
   if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){
	   $url = "http://192.168.0.48:8081/gps/webservices/common_recv.php";
   }else{
	  $url = "http://".$_SERVER['SERVER_NAME']."/gps/webservices/common_recv.php";
   }
    
	 $curl = curl_init($url);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'content-type: application/json',
          'appid:'.$resAppid['appid']
        ));
     $response = curl_exec($curl);	
     curl_close($curl);
	  //print_r($response); die();
	

	  return $response;    
}


function httpRequestdoctor($db, $method= "GET", $body = NULL) {
	
	$resAppid=$db->get_a_line("select * from ".TPLPrefix."app where id = '1' ");
	
    if (!$method) {
        $method = "GET";
    }
   
   //echo  $method; exit;
   if($_SERVER['HTTP_HOST'] == '192.168.0.48:8081'){
	   $url = "http://192.168.0.48:8081/gps/webservices/doctorcommon_recv.php";
   }else{
	  $url = "http://".$_SERVER['SERVER_NAME']."/gps/webservices/doctorcommon_recv.php";
   }
	  //
 	  $curl = curl_init($url);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'content-type: application/json',
          'appid:'.$resAppid['appid']
        ));
     $response = curl_exec($curl);	
     curl_close($curl);
 //print_r($response);
	

	  return $response;    
}

function generateslug($value){
          //echo $value; exit;
		 $value = str_replace('—', '-', $value);
		 $value = str_replace('‒', '-', $value);
		 $value = str_replace('―', '-', $value);
		 $value = str_replace('_', '-', $value);
		 $value = str_replace(' ', '-', $value);
		 $accents   = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ',  'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',  'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ');
		 $noAccents = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'B', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'p', 'y');
	 	 $value = str_replace($accents, $noAccents, $value);
		 $value = preg_replace('/[^A-Za-z0-9-]+/', '', $value);
		 $value = strtolower($value);
		do {
		
			$value = str_replace('--', '-', $value);
		
		}
		while (mb_substr_count($value, '--') > 0);
		
		return $value;

}


function getLanguages($db){
		$getlanguage = $db->get_rsltset_bind("select * from ".TPLPrefix."language where IsActive = 1");
		return $getlanguage;	
}

function getlanguagecategoryid($db,$parentid,$lang_id){
	$getlanguage = $db->get_a_line("select * from ".TPLPrefix."category where IsActive = 1 and parent_id = '".$parentid."' and lang_id = '".$lang_id."' ");
	return $getlanguage;
}

function checkdropdownlang_id($db,$selecfor,$parentid,$isparent,$lang_id){
	if($isparent == 1){
		$query = " and dropdown_id in (".$parentid.") ";
	}else{
		$query = " and parent_id in(".$parentid.") ";
	}
	
	if($selecfor =='1'){	
	//single	
	  	$str_attrib = "select dropdown_values as Name,dropdown_id as Id,attributeId from ".TPLPrefix."dropdown where isactive=1  and lang_id='".$lang_id."' ".$query." " ; 								
	}else{
	//multiple
  	  $str_attrib = "select dropdown_values as Name,group_concat(dropdown_id) as Id,attributeId from ".TPLPrefix."dropdown where isactive=1  and lang_id='".$lang_id."' ".$query."  " ;	 
	}	
	$resQry = $db->get_a_line($str_attrib);	
	return $resQry;
	 
}
?>