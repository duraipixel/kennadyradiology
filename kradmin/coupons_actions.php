<?php 
include 'session.php';
 extract($_REQUEST);
//echo "<pre>"; print_r($_REQUEST); 
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$today=date('Y-m-d H:i:s');
$getlanguage = getLanguages($db);
switch($act)
{
	case 'insert':
	
		//print_r($CustomerIds);  exit;
		$categoryIDs = explode(',',$categoryIDs);
		// print_r($va);
		$categoryIDs = implode(',',$categoryIDs);
		// print_r($categoryIDs); 
		//exit;
		//echo "<pre>"; print_r($_POST); exit;	
		$productids = implode(',',$CouponProducts);
 		if(!empty($CouponTitle) ) {
			$strChk = "select count(CouponID) from ".TPLPrefix."coupons where CouponTitle = ? and IsActive != ?  and lang_id = 1";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($CouponTitle),'2'));
			if($reslt[0] == 0) {
				$category_val =array();
				if($categoryIDs!=''){ 
				 
				 $cat_key=',CouponCategorys';
				 $cat_val=',?';
				 $category_val[] = $categoryIDs;
				}
				$product_val =array();
				if($productids!=''){ 
				  
				 $pro_key=',CouponProducts';
				 $pro_val=',?';
				 $product_val[] = $productids;
				 //print_r($product_val); exit;
				}
                $minamount_val = array();
				if($CouponMinAmt!=''){ 
				 
				 $minamt_key=',CouponMinAmt';
				 $minamt_val=',?';
				 $minamount_val[] = getRealescape($CouponMinAmt);
				}
				
				$parentidval = 0;
				foreach($getlanguage as $languageval){
                   
                    $str="insert into ".TPLPrefix."coupons(CouponTitle,CouponCode,CouponCatType,CouponTotal,CouponPerUser,Couponpriority,CouponAppend,CouponType,CouponAmount,CouponStartDate,CouponEndDate,IsDisplayPublic,created,IsActive,UserId,modifiedDate,parent_id,lang_id".$cat_key.$pro_key.$minamt_key.") values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?".$cat_val.$pro_val.$minamt_val.")";
                    $coupon_val = array(getRealescape($_POST['CouponTitle'.$languageval['languagefield']]),getRealescape($CouponCode),getRealescape($CouponCatType),$CouponTotal,getRealescape($CouponPerUser),getRealescape($Couponpriority),getRealescape($CouponAppend),getRealescape($CouponType),getRealescape($CouponAmount),getdateFormat($db,$CouponStartDate),getdateFormat($db,$CouponEndDate),getRealescape($IsDisplayPublic),date('Y-m-d H:i:s'),$status,$_SESSION["UserId"],$today,$parentidval,$languageval['languageid']);
                    $result_data = array_merge($coupon_val,$category_val,$product_val,$minamount_val);
                    $rslt = $db->insert_bind($str,$result_data);
				    
                    if($languageval['languageid'] == 1){
    					$lastInserId = $db->insert_id;
    					$parentidval = $lastInserId;
    				}
				
				    
				}
				
					
				
				
				$log = $db->insert_log("insert"," ".TPLPrefix."coupons","","coupons Added Newly","coupons",$str);
				echo json_encode(array("rslt"=>"1")); //success
			}
			else {
				 echo json_encode(array("rslt"=>"3")); //same exists
			}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
 	
	break;
	
	
	case 'update':	 	
 		if(!empty($CouponTitle) ) {
			
			//$today=date("Y-m-d");	
				//print_r($categoryIDs); 
			$categoryIDs = explode(',',$categoryIDs);
			// print_r($categoryIDs);
			$categoryIDs = implode(',',$categoryIDs);
			// print_r($categoryIDs); 
			//exit;			
			
			$strChk = "select count(CouponID) from ".TPLPrefix."coupons where CouponTitle = ? and IsActive != ? and CouponID != ?  and lang_id = 1";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($CouponTitle),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				
			if($CouponCatType == 1) //Products
			{ 
				$CouponProducts = $CouponProducts;
				$categoryIDs='';
				$CouponMinAmt='';
				$Customergroup='';
				$CustomerIds='';
				
			}
			
			if($CouponCatType == 2) //Categorys
			{ 
				$CouponProducts = '';
				$categoryIDs= $categoryIDs;
				$CouponMinAmt='';
				$Customergroup='';
				$CustomerIds='';
				
			}
			
			if($CouponCatType == 3) //order value
			{ 
				$CouponProducts = '';
				$categoryIDs=  '';
				$CouponMinAmt= $CouponMinAmt;
				$Customergroup='';
				$CustomerIds='';
				
			}				
			/*	$str = "update ".TPLPrefix."coupons set CouponTitle = ?, CouponCatType = ?, CouponTotal = ?, CouponPerUser = ?,Couponpriority = ?,CouponAppend = ?,CouponType = ?,CouponAmount = ?,CouponProducts = ?,CouponCategorys = ?,CouponMinAmt = ?,CouponStartDate = ?,CouponEndDate = ?,IsDisplayPublic = ?,IsActive = ?, modifiedDate = ? , UserId=?  where CouponID = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($CouponTitle),getRealescape($CouponCatType),$CouponTotal,getRealescape($CouponPerUser),getRealescape($Couponpriority),getRealescape($CouponAppend),getRealescape($CouponType),getRealescape($CouponAmount),implode(',',$CouponProducts),$categoryIDs,getRealescape($CouponMinAmt),getdateFormat($db,$CouponStartDate),getdateFormat($db,$CouponEndDate),getRealescape($IsDisplayPublic),$status,date('Y-m-d H:i:s'),$_SESSION["UserId"],$edit_id));
				$db->insert_log("update"," ".TPLPrefix."coupons",$edit_id,"coupons updated","coupons",$str);
				
				$str_es = "update ".TPLPrefix."coupons set CouponTitle = '".getRealescape($CouponTitle_es)."', CouponCatType = '".getRealescape($CouponCatType)."', CouponTotal = '".$CouponTotal."', CouponPerUser = '".getRealescape($CouponPerUser)."',Couponpriority = '".getRealescape($Couponpriority)."',CouponAppend = '".getRealescape($CouponAppend)."',CouponType = '".getRealescape($CouponType)."',CouponAmount = '".getRealescape($CouponAmount)."',CouponProducts = '".implode(',',$CouponProducts)."',CouponCategorys = '".$categoryIDs."',CouponMinAmt = '".getRealescape($CouponMinAmt)."',CouponStartDate = '".getdateFormat($db,$CouponStartDate)."',CouponEndDate = '".getdateFormat($db,$CouponEndDate)."',IsDisplayPublic = '".getRealescape($IsDisplayPublic)."',IsActive = '".$status."', modifiedDate = '".date('Y-m-d H:i:s')."' , UserId='".$_SESSION["UserId"]."'  where CouponID = '".$edit_id."' ";
			//	$rslt_es = $db->insert_bind($str,array(getRealescape($CouponTitle_es),getRealescape($CouponCatType),$CouponTotal,getRealescape($CouponPerUser),getRealescape($Couponpriority),getRealescape($CouponAppend),getRealescape($CouponType),getRealescape($CouponAmount),implode(',',$CouponProducts),$categoryIDs,getRealescape($CouponMinAmt),getdateFormat($db,$CouponStartDate),getdateFormat($db,$CouponEndDate),getRealescape($IsDisplayPublic),$status,date('Y-m-d H:i:s'),$_SESSION["UserId"],$edit_id));
				$db->insert_log("update"," ".TPLPrefix."coupons",$edit_id,"coupons updated","coupons",$str_es);
				
				
				$str_pt = "update ".TPLPrefix."coupons set CouponTitle = ?, CouponCatType = ?, CouponTotal = ?, CouponPerUser = ?,Couponpriority = ?,CouponAppend = ?,CouponType = ?,CouponAmount = ?,CouponProducts = ?,CouponCategorys = ?,CouponMinAmt = ?,CouponStartDate = ?,CouponEndDate = ?,IsDisplayPublic = ?,IsActive = ?, modifiedDate = ? , UserId=?  where CouponID = ? ";
				$rslt_pt = $db->insert_bind($str,array(getRealescape($CouponTitle_pt),getRealescape($CouponCatType),$CouponTotal,getRealescape($CouponPerUser),getRealescape($Couponpriority),getRealescape($CouponAppend),getRealescape($CouponType),getRealescape($CouponAmount),implode(',',$CouponProducts),$categoryIDs,getRealescape($CouponMinAmt),getdateFormat($db,$CouponStartDate),getdateFormat($db,$CouponEndDate),getRealescape($IsDisplayPublic),$status,date('Y-m-d H:i:s'),$_SESSION["UserId"],$edit_id));
				$db->insert_log("update"," ".TPLPrefix."coupons",$edit_id,"coupons updated","coupons",$str_pt);**/
				
				$str = "update ".TPLPrefix."coupons set CouponTitle = '".getRealescape($CouponTitle)."', CouponCatType = '".getRealescape($CouponCatType)."', CouponTotal = '".$CouponTotal."', CouponPerUser = '".getRealescape($CouponPerUser)."',Couponpriority = '".getRealescape($Couponpriority)."',CouponAppend = '".getRealescape($CouponAppend)."',CouponType = '".getRealescape($CouponType)."',CouponAmount = '".getRealescape($CouponAmount)."',CouponProducts = '".implode(',',$CouponProducts)."',CouponCategorys = '".$categoryIDs."',CouponMinAmt = '".getRealescape($CouponMinAmt)."',CouponStartDate = '".getdateFormat($db,$CouponStartDate)."',CouponEndDate = '".getdateFormat($db,$CouponEndDate)."',IsDisplayPublic = '".getRealescape($IsDisplayPublic)."',IsActive = '".$status."', modifiedDate = '".date('Y-m-d H:i:s')."' , UserId='".$_SESSION["UserId"]."'  where CouponID = '".$edit_id."' ";
				$db->insert_log("update"," ".TPLPrefix."coupons",$edit_id,"coupons updated","coupons",$str);
				$db->insert($str);
				
				$str_es = "update ".TPLPrefix."coupons set CouponTitle = '".getRealescape($CouponTitle_es)."', CouponCatType = '".getRealescape($CouponCatType)."', CouponTotal = '".$CouponTotal."', CouponPerUser = '".getRealescape($CouponPerUser)."',Couponpriority = '".getRealescape($Couponpriority)."',CouponAppend = '".getRealescape($CouponAppend)."',CouponType = '".getRealescape($CouponType)."',CouponAmount = '".getRealescape($CouponAmount)."',CouponProducts = '".implode(',',$CouponProducts)."',CouponCategorys = '".$categoryIDs."',CouponMinAmt = '".getRealescape($CouponMinAmt)."',CouponStartDate = '".getdateFormat($db,$CouponStartDate)."',CouponEndDate = '".getdateFormat($db,$CouponEndDate)."',IsDisplayPublic = '".getRealescape($IsDisplayPublic)."',IsActive = '".$status."', modifiedDate = '".date('Y-m-d H:i:s')."' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' and lang_id = 2  ";
				$db->insert_log("update"," ".TPLPrefix."coupons",$edit_id,"coupons updated","coupons",$str_es);
				$db->insert($str_es);
				
				$str_pt = "update ".TPLPrefix."coupons set CouponTitle = '".getRealescape($CouponTitle_pt)."', CouponCatType = '".getRealescape($CouponCatType)."', CouponTotal = '".$CouponTotal."', CouponPerUser = '".getRealescape($CouponPerUser)."',Couponpriority = '".getRealescape($Couponpriority)."',CouponAppend = '".getRealescape($CouponAppend)."',CouponType = '".getRealescape($CouponType)."',CouponAmount = '".getRealescape($CouponAmount)."',CouponProducts = '".implode(',',$CouponProducts)."',CouponCategorys = '".$categoryIDs."',CouponMinAmt = '".getRealescape($CouponMinAmt)."',CouponStartDate = '".getdateFormat($db,$CouponStartDate)."',CouponEndDate = '".getdateFormat($db,$CouponEndDate)."',IsDisplayPublic = '".getRealescape($IsDisplayPublic)."',IsActive = '".$status."', modifiedDate = '".date('Y-m-d H:i:s')."' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' and lang_id = 3 ";
                $db->insert_log("update"," ".TPLPrefix."coupons",$edit_id,"coupons updated","coupons",$str_pt);
                $db->insert($str_pt);
                
				echo json_encode(array("rslt"=>"2"));
			}
			else {
				echo json_encode(array("rslt"=>"3")); //same exists
			}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
 		
	break;
	
	
	case 'del':
	
		$edit_id = base64_decode($Id);
		  
		$str="update ".TPLPrefix."coupons set IsActive = ?, modifiedDate = ? , UserId=?  where CouponID = ? ";
		$db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		$db->insert_log("delete"," ".TPLPrefix."coupons",$edit_id,"coupons deleted","coupons",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
				
		$str="update ".TPLPrefix."coupons set IsActive = ?, modifiedDate = ? , UserId=?  where CouponID = ? ";
		//echo $str; exit;
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}




?>