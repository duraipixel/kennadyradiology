<?php
ob_start();ob_flush();
ini_set('session.name', 'ADMPHPSESSID');
#ini_set('session.gc_maxlifetime',20*60*60);
#session_set_cookie_params(20*60*60);
session_start();
date_default_timezone_set("Asia/kolkata");

include_once("include/config_db.php");
include_once("include/database.class.php");
include_once("include/common.class.php");

ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600); 

//include_once("commonmsg.php");
$common=new common;

$path=$common->path;
$created=date('Y-m-d H:i:s'); 

$common=new common;
class Session
{

	function hashgenwithsessionid()
	{
 		$hash = md5(session_id());
 		return $hash;
 	}    
}

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
?>