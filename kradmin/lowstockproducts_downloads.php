<?php
$ordersdisp = "lowstockproducts";
 include "session.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeSaleReport($db,'');
include_once "includes/pagepermission.php";

 


$str_all = "select '',t1.product_id,pdt.product_name,t1.subsku as sku,t1.subqty as quantity,t1.subprice as price,case when pdt.IsActive = 1 then 'Active' else 'Inactive' end as status  from (SELECT product_id,quantity as subqty, price as subprice, sku as subsku  FROM `".TPLPrefix."product` prd 
union select base_productId, quantity as subqty, price as subprice, sku as subsku from ".TPLPrefix."product_attr_combi
 attr ) t1 inner join ".TPLPrefix."product pdt on pdt.product_id = t1.product_id where t1.subqty < (select value from ".TPLPrefix."configuration where unicode = 'minimumStock' and
 IsActive = 1)  ";
		
		if(isset($_REQUEST['period']) && $_REQUEST['period'] != "" )
		{
			$str_all .= " and pdt.product_name like '".$_REQUEST[0]['value']."%' "; 
		}
		
		
		
		if($_REQUEST['orderstatus'] != "" ){
			$whrcon .= "  and pdt.IsActive = '".$_REQUEST['orderstatus']."' ";
		}
		else
			$whrcon .= " and pdt.IsActive in(0,1) ";

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		//$totalFiltered = $totalData; 
		
		$gpby = ' order by product_id';
		
		
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		
 
		$output			= "";

$sql = $db->get_rsltset($str_all);
	$columns_total 	=  $db->get_columnCount($str_all);
$output .='"Sno","Id","Product Name","SKU","Quantity","Unit Price","Status"';
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

 $filename =  "lowstockproducts_rpeort.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;
?>