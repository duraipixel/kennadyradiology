<?php 
include "../session.php"; 
extract($_REQUEST);
switch($action) {
	case "permissions" :
echo '{"success":true,"time":"2018-11-13 12:28:02","data":{"permissions":{"allowFiles":true,"allowFileMove":true,"allowFileUpload":true,"allowFileUploadRemote":true,"allowFileRemove":true,"allowFileRename":true,"allowFolders":true,"allowFolderMove":true,"allowFolderCreate":false,"allowFolderRemove":false,"allowFolderRename":false,"allowImageResize":true,"allowImageCrop":true},"code":220}}';
  break;
  
  case "folders" :
echo '{"success":true,"time":"2018-11-13 12:28:02","data":{"sources":{"default":{"baseurl":"'.image_public1_url.'","path":"","folders":["customfields"]}},"code":220}}';
  break;
  
  case "files":
  $path =  __DIR__ ."/../../uploads/customfields/"; 
 $glob = glob($path.'*.*');
//print_r(pathinfo($glob,PATHINFO_BASENAME));		exit;
foreach( $glob as $value){

$path = pathinfo($value,PATHINFO_BASENAME);	
$arrvalue[] = array("file"=>$path,"thumb"=>$path,"chan","isImage"=>true);

}
  echo '{"success":true,"time":"2018-11-13 15:07:52","data":{"sources":{"default":{"baseurl":"'.image_public1_url.'customfields/","path":"","files":'.json_encode($arrvalue).'}},"code":220}}';	
  break;
  
}

