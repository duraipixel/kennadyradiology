<?php 
include 'session.php';
include 'exportcsvinc.php';
extract($_REQUEST);

try{
	
//$dbh = mysql_connect ("localhost", "root", "");
//mysql_select_db("ecom",$dbh);	

	if(isset($_SESSION["CSVdownloadtbl"])){
		exportMysqlToCsv($_SESSION["CSVdownloadtbl"],$db,"download");		
		//header("Location:".admin_public_url."bulkproductupload_mng.php");		
	}
	else{
		exit();
	}  
}

catch (Exception $e) {
	$res = "error";
	echo $res;
}

?>