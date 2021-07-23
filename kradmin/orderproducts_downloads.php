<?php
$ordersdisp = "orderproducts";
 include "session.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeSaleReport($db,'');
include_once "includes/pagepermission.php";

// output headers so that the file is downloaded rather than displayed
/*header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=orderproduct_report.csv'); 
$output = fopen('php://output', 'w'); 
fputcsv($output, array("Product Name","SKU","Quantity","Unit Price","Total","Start Date","End Date"));*/

// fetch the data
//  $qryval = $_REQUEST['qryval'];



$str_all = " SELECT '',op.product_name, op.product_sku, count(op.product_id)*op.product_qty as productcount,op.product_price,
	 (count(op.product_id)*op.product_qty)*op.product_price as total_price  ";
		
		if(isset($_REQUEST['period']) && $_REQUEST['period'] == "1" )
		{
			$str_all .= " ,DATE_FORMAT(t1.date_added,'%Y-%m-%d') as fstday, DATE_FORMAT(t1.date_added,'%Y-%m-%d') as lstday   ";
		}
		if(isset($_REQUEST['period']) && $_REQUEST['period'] == "2" )
		{
			$str_all .= " ,DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 1 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as fstday ,
			DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 7 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as lstday ";
		}
		
		if(isset($_REQUEST['period']) && $_REQUEST['period'] == "3" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
		if(isset($_REQUEST['period']) && $_REQUEST['period'] == "4" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
			$str_all .= "  FROM  `".TPLPrefix."orders` t1 
inner join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
inner join ".TPLPrefix."orders_products op on op.order_id = t1.order_id
left join ".TPLPrefix."orders_products_attribute attr on attr.order_product_id = op.order_product_id  "; 						
		
			$whrcon = " where 1 = 1  ";

		
		if($_REQUEST['fmdat'] != "" ){
			$date = explode("-",$_REQUEST['fmdat']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST['datto'] != "" && $_REQUEST['datto'] ){	
			$date = explode("-",$_REQUEST['datto']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
		if(($_REQUEST['fmdat'] == "") && ($_REQUEST['datto'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("-",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$lastdat."' ";
		}
		
		if($_REQUEST['orderstatus'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST['orderstatus']."' ";
		}

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		//$totalFiltered = $totalData; 
		
		$gpby = '';
		
		if($_REQUEST['period'] != "" ){			
					
			if($_REQUEST['period'] == "1" )
			$gpby = "  group by day(t1.date_added),op.product_id ";
			
			if($_REQUEST['period'] == "2" )
			$gpby = "  group by week(t1.date_added),op.product_id ";
			
			if($_REQUEST['period'] == "3" )
			$gpby = "  group by month(t1.date_added),op.product_id ";
			
			if($_REQUEST['period'] == "4" )
			$gpby = "  group by year(t1.date_added),op.product_id ";
		}
		else
		$gpby = " group by op.product_id";
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
				$output			= "";

$sql = $db->get_rsltset($str_all);
	$columns_total 	=  $db->get_columnCount($str_all);
$output .='"Sno","Product Name","SKU","Quantity","Unit Price","Total","Start Date","End Date"';
		$output .="\n";
	$j = 1;	 
	foreach($sql as $row) {			 
		for ($i = 0; $i < $columns_total; $i++) {		
 			if($i==0){
				$output .= $j.','; 
			}
			else{
				 
					$output .= '"'.htmlspecialchars($row["$i"]).'"';
				    $output.=",";
					 
			}
		}
	
		$output .="\n";
		$j++;
	}

 $filename =  "orderproducts_report.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;

?>