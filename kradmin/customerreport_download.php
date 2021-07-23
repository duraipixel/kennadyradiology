<?php
$ordersdisp = "custorderproducts";
 include "session.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmecustomerorderReport($db,'');
include_once "includes/pagepermission.php";
 


$str_all = " SELECT '',t1.customer_id,( SELECT AttributeValue FROM ".TPLPrefix."cus_attribute_tbl1 a1 INNER JOIN ".TPLPrefix."customfields_attributes a2 ON a1.AttributeId = a2.AttributeId WHERE a1.customer_id = t1.customer_id AND a2.AttributeCode = 'Customer Name' ) AS Customer_Name,t1.email, case when t3.IsActive = 1 then 'Active' when t3.IsActive = 0 then 'Inactive' else 'Deleted' end as status , count( DISTINCT t1.order_id ) AS orders, count( DISTINCT ordpdt.product_id ) AS products,case when  cnfg.key = 'defaultcurrency' and cur.currencyid = cnfg.value then concat(currencyTitle, ' (Default)') else currencyTitle end as currencyTitle, sum( t1.total ) AS total, format(sum(t1.total)*t1.currency_conversion,2) as totalconverted, t2.order_statusName AS order_status ";
 
$str_all .= " FROM `".TPLPrefix."orders` t1
INNER JOIN ".TPLPrefix."order_status t2 ON t2.order_statusId = t1.order_status_id
INNER JOIN ".TPLPrefix."customers t3 ON t3.customer_id = t1.customer_id
INNER JOIN ".TPLPrefix."orders_products ordpdt ON ordpdt.order_id = t1.order_id
inner join ".TPLPrefix."currency cur on cur.currencyid = t1.order_currency_id left join ".TPLPrefix."configuration cnfg on cnfg.key = 'defaultcurrency' and cnfg.value = cur.currencyid and cur.IsActive =1  "; 						
 		
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
		
		if($_REQUEST['currencyStat'] != "" ){
			$whrcon .= "  and t1.order_currency_id = '".$_REQUEST['currencyStat']."' ";
		}

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		//$totalFiltered = $totalData; 
		
		$gpby = ' GROUP BY t1.customer_id';
		
		if($_REQUEST['currencyStat'] != "" ){					
			$gpby .= "  , t1.order_currency_id ";
		}
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		
		
			$output			= "";
			$sql = $db->get_rsltset($str_all);
			$columns_total 	=  $db->get_columnCount($str_all);
			$output .='"Sno","Customer Id","Customer Name","Email","Status","Orders","Products","Currency","Total","Total (Converted)","Status"';
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

 $filename =  "customerorder_report.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;
?>