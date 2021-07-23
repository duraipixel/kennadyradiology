<?php
error_reporting(0);
extract($_REQUEST);
 /** Include PHPExcel and MySQLi db */
/*include_once("common/config_db.php");
include_once("common/common.class.php");*/

include 'session.php';
//require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

$_SESSION['errorproduct'] = '';
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Kolkata');
 

$target_dir = "../uploads/excel/";
$rand = rand();
$target_file = $target_dir . $rand . $_FILES["excelfile"]["name"];
move_uploaded_file($_FILES["excelfile"]["tmp_name"], $target_file);
$fileget = "../uploads/excel/".$rand.$_FILES["excelfile"]["name"];


// Create new PHPExcel object
$objPHPExcel = PHPExcel_IOFactory::load($fileget);
$dataArr = array();

	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		for ($row = 1; $row <= $highestRow; ++ $row) {
		  for ($col = 0; $col < $highestColumnIndex; ++ $col) {
			  $cell = $worksheet->getCellByColumnAndRow($col, $row);
			  $val = $cell->getValue();
			  $dataArr[$row][$col] = $val;
		  }
		}
	}
 
	unset($dataArr[1]);
	 
	$tax_type = 2;	
	$html = array();
	 
	foreach($dataArr as $val){
     $awbno 					= $val['20'];
		$orderrefno 					= $val['1'];	         
		
		
		if(trim($awbno) != ''){		 			
			$checjst = $db->get_a_line("select order_status_id from ".TPLPrefix."orders where order_reference = '".trim($orderrefno)."'");
			if($checjst['order_status_id'] == 1){
		 	   $str="update ".TPLPrefix."orders set awbno='".$awbno."', pickup_date='".date('Y-m-d')."',order_status_id=3 where order_reference = '".trim($orderrefno)."' and order_status_id=1";
				$rslt = $db->insert($str);		
			}else{
				  $str="update ".TPLPrefix."orders set awbno='".$awbno."', pickup_date='".date('Y-m-d')."' where order_reference = '".trim($orderrefno)."' ";
				$rslt = $db->insert($str);	
			}
 		}
	 
		}
	
 	  
	
  header("Location:orderexportimport.php?msg=1");