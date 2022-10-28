<?php 
error_reporting(1);
include 'session.php';
include('mailsend.php');
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
	
	case 'change_Order_Status':
		if(!empty($order_id) && !empty($status_id)) {
		    $update_sql='';
		    if(!empty($txtawb_refno) ){
              $ins_awb= "INSERT INTO ".TPLPrefix."orders_awb(`order_id`, `awb`, `UserId`, `IsActive`, `createddate`, `modifieddate`) VALUES('".$order_id."','".$txtawb_refno."','".$_SESSION["UserId"]."','1','".$today."','".$today."')";
			
		         $db->insert($ins_awb);
		    }
			
			if(!empty($txtsap_refno) ){
			   $update_sql=" ,sap_refno='".$txtsap_refno."' ";
			}
			
			if(!empty($txtutr_refno) ){
			   $update_sql=" ,utr_refno='".$txtutr_refno."' ";
			}
			$comment='';
			$getcurent_status=$db->get_a_line("select order_status_id from ".TPLPrefix."orders  WHERE order_id = '".$order_id."' ");
			
			$strOrderStatus = "UPDATE ".TPLPrefix."orders SET order_status_id = '".$status_id."',date_modified='".$today."' ".$update_sql." WHERE order_id = '".$order_id."' ";
			
			$log = $db->insert_log("update","".TPLPrefix."orders","","orders statuschanged","orders",$str);
			$db->insert($strOrderStatus);
			
			$Insertorder_history = "INSERT INTO ".TPLPrefix."orders_history(order_id,current_status_id,changed_status_id,Comment,userId,IsActive,Createddate,ModifiedDate) VALUES('".$order_id."','".$getcurent_status['order_status_id']."','".$status_id."','".$comment."','".$_SESSION["UserId"]."','1','".$today."','".$today."')";
			
			$db->insert($Insertorder_history);
			orderstatusmailfunction($db,$order_id,$status_id);
			
			echo json_encode(array("rslt"=>"1","statusid"=>$status_id)); //success
		}
	break;
	
	case 'changePaymentStatus':
	    
		if(!empty($order_id) && !empty($status_id)) {
		    $update_sql='';
			if(!empty($txtTrnasactionid) ){
			   $update_sql=" ,payment_transaction_id='".$txtTrnasactionid."',order_status_id = '2' ";
			}
			$getcurent_status=$db->get_a_line("select payment_status from ".TPLPrefix."orders  WHERE order_id = '".$order_id."' ");
			
			$strOrderStatus = "UPDATE ".TPLPrefix."orders SET payment_status = '".$status_id."',date_modified='".$today."' ".$update_sql." WHERE order_id = '".$order_id."' ";
			
			$log = $db->insert_log("update","".TPLPrefix."orders","","payment statuschanged","payment",$str);
			$db->insert($strOrderStatus);
			$comment='payment status changed';
			$Insertorder_history = "INSERT INTO ".TPLPrefix."orders_history(order_id,current_status_id,changed_status_id,Comment,userId,IsActive,Createddate,ModifiedDate) VALUES('".$order_id."','".$getcurent_status['payment_status']."','".$status_id."','".$comment."','".$_SESSION["UserId"]."','1','".$today."','".$today."')";
			
			$db->insert($Insertorder_history);
			echo json_encode(array("rslt"=>"1","statusid"=>$status_id)); //success
		}
	break;
	
	case 'cancel_order':
		
		$id 			= $_POST['id'];
		$cancel_type 	= $_POST['cancel_type'];
		if( $cancel_type == 'product') {

			$order_product_info 	= $db->get_a_line("select * from ".TPLPrefix."orders_products  WHERE order_product_id = '".$id."' ");
			$order_id 				= $order_product_info['order_id'];

			$order_info 			= $db->get_a_line("select order_id,total_products,total_products_wt,total,grand_total  from ".TPLPrefix."orders WHERE order_id = '".$order_id."' ");
			
			//update total price in orders table
			$product_price 			= $order_product_info['product_price'];

			if( $order_info['total_products'] == 1 ) {
				$orderQuery 		= "UPDATE ".TPLPrefix."orders SET order_status_id = '5' WHERE order_id = '".$order_id."'";
				$db->insert( $orderQuery );
			} else {
				$total_products 	= $order_info['total_products'] - 1;
				$total_products_wt 	= $order_info['total_products_wt'] - $product_price;
				$total 				= $order_info['total'] - $product_price;
				$grand_total 		= $order_info['grand_total'] - $product_price;

				$orderQuery 		= "UPDATE ".TPLPrefix."orders SET total_products = '".$total_products."', total_products_wt='".$total_products_wt."',total='".$total."', grand_total='".$grand_total."' WHERE order_id = '".$order_id."'";
				$db->insert( $orderQuery );
	
			}
			
			//change order product status 
			$orderProductQuery 		= "UPDATE ".TPLPrefix."orders_products SET IsActive = '4', ModifiedDate='".$today."' WHERE order_product_id = '".$id."'";
			$db->insert( $orderProductQuery );

			//update amount kr_orders, order_id, total_products,total_products_wt, total, grand_total
			$errors 	= 0;
		} else {
			$orderQuery 		= "UPDATE ".TPLPrefix."orders SET order_status_id = '5' WHERE order_id = '".$id."'";
			$db->insert( $orderQuery );

			$orderProductQuery 		= "UPDATE ".TPLPrefix."orders_products SET IsActive = '4', ModifiedDate='".$today."' WHERE order_id = '".$id."'";
			$db->insert( $orderProductQuery );
		}

		echo json_encode( ['error' => $errors, 'cancel_type' => $cancel_type ] );
	break;
	
	
	
	
}



?>