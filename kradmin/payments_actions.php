<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");	
switch($act)
{
	case 'insert':
	
	if(!empty($usercustomer_id)) {	

		$billingAddress = "SELECT t1.*,
			t2.statename as  statename ,
			t3.countryname as countryname
			FROM  ".TPLPrefix."cus_address  t1
			LEFT JOIN ".TPLPrefix."state t2 on t2.stateid = t1.stateid
			LEFT JOIN ".TPLPrefix."country t3 on t3.countryid = t1.countryid			
			WHERE  t1.`customer_id` ='".$usercustomer_id."' and cus_addressid = '".$forbilling."' and  t1.IsActive = 1 order by t1.CreatedDate desc ";
		$res_billingAddress = $db->get_a_line($billingAddress);
		if($forbilling == $forshipping){
			$res_shippingAddress = $res_billingAddress;
		}
		else{
			$shippingAddress = "SELECT t1.*,
				t2.statename as  statename ,
				t3.countryname as countryname
				FROM  ".TPLPrefix."cus_address  t1
				LEFT JOIN ".TPLPrefix."state t2 on t2.stateid = t1.stateid
				LEFT JOIN ".TPLPrefix."country t3 on t3.countryid = t1.countryid			
				WHERE  t1.`customer_id` ='".$usercustomer_id."' and cus_addressid = '".$forshipping."' and t1.IsActive = 1 order by t1.CreatedDate desc ";
			$res_shippingAddress = $db->get_a_line($shippingAddress);
		}
		$strLastId = $db->get_a_line("SELECT  `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME =  ' ".TPLPrefix."orders' ");
				
		
		$strOrders = "INSERT INTO ".TPLPrefix."orders(
							order_reference,
							customer_id,
							customer_group_id,	
							email,	
                            firstname,
                            lastname,							
							payment_address_1,
							payment_landmark,
							payment_city,
							payment_postcode,		
							payment_country_id,		
							paymentStateId,
							payment_telephone,
							payment_method,
							payment_code,	
                            shipping_firstname,
 							shipping_lastname,
							shipping_address_1,
							shipping_landmark,
							shipping_city,
							shipping_postcode,		
							shipping_country_id,		
							shipping_state_id,
							shipping_telephone,
							shipping_method,
							shipping_code,
							total,
							total_products,
							order_status_id,
							UserId,
							IsActive,
							date_added,
							date_modified
							)	values(
						'".(100000+$strLastId["AUTO_INCREMENT"])."',
						'".$usercustomer_id."',
						'".$customer_group_id."',
						'".$customer_id."',
						'".$res_billingAddress['firstname']."',
						'".$res_billingAddress['lastname']."',
						'".$res_billingAddress['address']."',
						'".$res_billingAddress['landmark']."',
						'".$res_billingAddress['city']."',
						'".$res_billingAddress['postalcode']."',
						'".$res_billingAddress['countryid']."',
						'".$res_billingAddress['stateid']."',		
						'".$res_billingAddress['telephone']."',
						'".$paymentMethod."',
						'".$paymentMethod."',
						'".$res_shippingAddress['firstname']."',
						'".$res_shippingAddress['lastname']."',
						'".$res_shippingAddress['address']."',
						'".$res_shippingAddress['landmark']."',
						'".$res_shippingAddress['city']."',
						'".$res_shippingAddress['postalcode']."',
						'".$res_shippingAddress['countryid']."',
						'".$res_shippingAddress['stateid']."',		
						'".$res_shippingAddress['telephone']."',
						'".$paymentMethod."',
						'".$paymentMethod."',		
						'".$paymentTotal."',
						'".count($_REQUEST['productName'])."',		
						'2',
						'".$_SESSION["UserId"]."',
						'1',
                         '".$today."','".$today."'						
						)		
					";
		$db->insert($strOrders);
		$lastInsertId = $db->insert_id;
		$log = $db->insert_log("insert"," ".TPLPrefix."orders","","orders Add Successfully","orders",$str);
		
		if($lastInsertId){
			for($i=0;$i<count($_REQUEST['productName']);$i++){
				$productInsert = "INSERT INTO ".TPLPrefix."orders_products(order_id,product_id,product_name,product_sku,product_qty,product_price,CreatedDate,ModifiedDate) ";
				$productInsert .= "VALUES('".$lastInsertId."','".$product_id[$i]."','".$productName[$i]."','".$product_sku[$i]."','".$productQty[$i]."','".$productPrice[$i]."','".$today."','".$today."')";
				$db->insert($productInsert);
				$log = $db->insert_log("insert"," ".TPLPrefix."orders_products","","orders_products Add Successfully","orders_products",$str);
			}
		}
		echo json_encode(array("rslt"=>"1")); //success		
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	
	break;
	
	case 'changeOrderStatus':
		if(!empty($order_id) && !empty($status_id)) {
			
			$getcurent_status=$db->get_a_line("select order_status_id from ".TPLPrefix."orders  WHERE order_id = '".$order_id."' ");
			
			$strOrderStatus = "UPDATE ".TPLPrefix."orders SET order_status_id = '".$status_id."',date_modified='".$today."' WHERE order_id = '".$order_id."' ";
			
			$log = $db->insert_log("update","".TPLPrefix."orders","","orders statuschanged","orders",$str);
			$db->insert($strOrderStatus);
			
			$Insertorder_history = "INSERT INTO ".TPLPrefix."orders_history(order_id,current_status_id,changed_status_id,Comment,userId,IsActive,Createddate,ModifiedDate) VALUES('".$order_id."','".$getcurent_status['order_status_id']."','".$status_id."','".$comment."','".$_SESSION["UserId"]."','1','".$today."','".$today."')";
			
			$db->insert($Insertorder_history);
			
			
			echo json_encode(array("rslt"=>"1","statusid"=>$status_id)); //success
		}
	break;
	
	
	/*case 'changeOrderStatus':
		if(!empty($order_id) && !empty($status_id)) {
			$strOrderStatus = "UPDATE ".TPLPrefix."orders SET order_status_id = '".$status_id."',date_modified='".$today."' WHERE order_id = '".$order_id."' ";
			
			$log = $db->insert_log("update"," ".TPLPrefix."orders","","orders statuschanged","orders",$str);
			$db->insert($strOrderStatus);
			echo json_encode(array("rslt"=>"1","statusid"=>$status_id)); //success
		}
	break;*/
	
}



?>