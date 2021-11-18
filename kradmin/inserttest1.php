<?php
error_reporting(-1);
include 'sessionweb.php';

###### kr_product_attr_combi_opt #####
$str_all = "select * from kr_product where product_id > 10 and lang_id = 3";
$rescntchk =  $db->get_rsltset($str_all); 
foreach($rescntchk as $data){
		 //$stcombinationss = "insert into kr_product_attr_combi_opt (`optionId`, `optionId_price`, `product_id`, `outofstock`, `IsActive`, `createdDate`, `modifiedDate`)  select `optionId`, `optionId_price`, ".$data['product_id'].", `outofstock`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi_opt where product_id = 1 ";		
		//$rslt = $db->insert($stcombinationss);
		
		//$stcombinationss1 = "insert into kr_product_attr_combi_opt (`optionId`, `optionId_price`, `product_id`, `outofstock`, `IsActive`, `createdDate`, `modifiedDate`)  select `optionId`, `optionId_price`, ".$data['product_id'].", `outofstock`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi_opt where product_id = 2 ";		
		//$rslt = $db->insert($stcombinationss1);

		// echo $stcombinationss2 = "insert into kr_product_attr_combi_opt (`optionId`, `optionId_price`, `product_id`, `outofstock`, `IsActive`, `createdDate`, `modifiedDate`)  select `optionId`, `optionId_price`, ".$data['product_id'].", `outofstock`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi_opt where product_id = 3 ";		
	//	 $rslt = $db->insert($stcombinationss2); 
	// echo "<br><br>";
}

		
		