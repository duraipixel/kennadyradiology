<?php
$ordersdisp = "salereports";
 include "session.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeSaleReport($db,'');
include_once "includes/pagepermission.php";


$str_all = " SELECT  '',format(sum(total_discounts),2) as total_discounts, format(sum(total_products),2) as total_products, format(sum(total_products_wt),2) as total_wt, format(sum(total_shipping),2) as total_shipping ";
		
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
$str_all .= " ,format(sum(t1.total),2) as total ";
			$str_all .= " FROM  `".TPLPrefix."orders` t1	left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id"; 						
		
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
			$gpby = "  group by day(t1.date_added) ";
			
			if($_REQUEST['period'] == "2" )
			$gpby = "  group by week(t1.date_added) ";
			
			if($_REQUEST['period'] == "3" )
			$gpby = "  group by month(t1.date_added) ";
			
			if($_REQUEST['period'] == "4" )
			$gpby = "  group by year(t1.date_added) ";
		}
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		 
		$output			= "";

$sql = $db->get_rsltset($str_all);
	$columns_total 	=  $db->get_columnCount($str_all);
$output .='"Sno","Discounts","Products","Weight","Shipping","Start Date","End Date","Total"';
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

 $filename =  "sales_report.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;
?>