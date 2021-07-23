<?php 
include 'session.php';
extract($_REQUEST);


// $hdn_update_pg =1 (cod details update), $hdn_update_pg =2 (ccavenue details update), $hdn_update_pg =3 (ebs details update)  
$today=date("Y-m-d H:i:s");


if($hdn_update_pg == "1"){
	if($cod_chkstatus !=null)
		$status =1;
	else
		$status =0;		
	
	$exclude_countries="";
	$exclude_categories="";
	$customer_group_ids="";
	
	if(isset($cod_excludecountry))
		$exclude_countries = implode(",",$cod_excludecountry);
	
	if(isset($cod_excludecategory))
		$exclude_categories = implode(",",$cod_excludecategory);
	if(isset($customer_group_id)){
		$customer_group_ids = implode(",",$customer_group_id);
		
	}
	
	
	
	$db->insert("update ".TPLPrefix."paymentgateway_det set title='".$cod_title."', orderstatus='".$cod_orderstatus."',custom_groupid = '".$customer_group_ids."', min_amt='".$cod_minAmt."', max_amt='".$cod_maxAmt."', exclude_countries='".$exclude_countries."', exclude_categories='".$exclude_categories."', sortingorder='".$cod_sortingorder."', IsActive='".$status."', userId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' where pg_det_id=1  ");
	
	echo "success";
   
}
else if($hdn_update_pg == "2"){	
	if($cca_chkstatus !=null)
		$status =1;
	else
		$status =0;	
	
	$exclude_countries="";
	$exclude_categories="";
	$customer_group_ids="";
	
	if(isset($cca_excludecountry))
		$exclude_countries = implode(",",$cca_excludecountry);
	
	if(isset($cca_excludecategory))
		$exclude_categories = implode(",",$cca_excludecategory);
	
	if(isset($customer_group_id)){
		$customer_group_ids = implode(",",$customer_group_id);
		
	}
	
	
	
	$db->insert("update ".TPLPrefix."paymentgateway_det set title='".$cca_title."', orderstatus='".$cca_orderstatus."',custom_groupid = '".$customer_group_ids."', min_amt='".$cca_minAmt."', max_amt='".$cca_maxAmt."', exclude_countries='".$exclude_countries."', exclude_categories='".$exclude_categories."', sortingorder='".$cca_sortingorder."', IsActive='".$status."', merchant_id='".$cca_merchantid."', encrypt_key='".$cca_encryptkey."', access_code='".$cca_accesscode."', userId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' where pg_det_id=2 and lang_id=1 ");
	$db->insert("update ".TPLPrefix."paymentgateway_det set title='".$cca_title_es."', orderstatus='".$cca_orderstatus."',custom_groupid = '".$customer_group_ids."', min_amt='".$cca_minAmt."', max_amt='".$cca_maxAmt."', exclude_countries='".$exclude_countries."', exclude_categories='".$exclude_categories."', sortingorder='".$cca_sortingorder."', IsActive='".$status."', merchant_id='".$cca_merchantid."', encrypt_key='".$cca_encryptkey."', access_code='".$cca_accesscode."', userId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' where parent_id=2 and lang_id=2  ");
	$db->insert("update ".TPLPrefix."paymentgateway_det set title='".$cca_title_pt."', orderstatus='".$cca_orderstatus."',custom_groupid = '".$customer_group_ids."', min_amt='".$cca_minAmt."', max_amt='".$cca_maxAmt."', exclude_countries='".$exclude_countries."', exclude_categories='".$exclude_categories."', sortingorder='".$cca_sortingorder."', IsActive='".$status."', merchant_id='".$cca_merchantid."', encrypt_key='".$cca_encryptkey."', access_code='".$cca_accesscode."', userId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' where parent_id=2 and lang_id=3  ");
	
	echo "success";
	
}

else if($hdn_update_pg == "3"){
	if($ebs_chkstatus !=null)
		$status =1;
	else
		$status =0;	
	
	$exclude_countries="";
	$exclude_categories="";
	
	if(isset($ebs_excludecountry))
		$exclude_countries = implode(",",$ebs_excludecountry);
	
	if(isset($ebs_excludecategory))
		$exclude_categories = implode(",",$ebs_excludecategory);
	
	
	$db->insert("update ".TPLPrefix."paymentgateway_det set title='".$ebs_title."', orderstatus='".$ebs_orderstatus."', min_amt='".$ebs_minAmt."', max_amt='".$ebs_maxAmt."', exclude_countries='".$exclude_countries."', exclude_categories='".$exclude_categories."', sortingorder='".$ebs_sortingorder."', IsActive='".$status."', acc_id='".$ebs_accid."', secret_key='".$ebs_secretkey."', userId='".$_SESSION["UserId"]."',modifiedDate = '".$today."'  where pg_det_id=3 ");
	
	echo "success";
	
	
}
else if($hdn_update_pg == "4"){
	if($ebs_chkstatus !=null)
		$status =1;
	else
		$status =0;	
	
	$exclude_countries="";
	$exclude_categories="";
	
	if(isset($ebs_excludecountry))
		$exclude_countries = implode(",",$ebs_excludecountry);
	
	if(isset($ebs_excludecategory))
		$exclude_categories = implode(",",$ebs_excludecategory);
	
	
	$db->insert("update ".TPLPrefix."paymentgateway_det set title='".$cca_title."', orderstatus='".$cca_orderstatus."',custom_groupid = '".$customer_group_ids."', min_amt='".$cca_minAmt."', max_amt='".$cca_maxAmt."', exclude_countries='".$exclude_countries."', exclude_categories='".$exclude_categories."', sortingorder='".$cca_sortingorder."', IsActive='".$status."', encrypt_key='".$cca_encryptkey."', secret_key='".$ebs_secretkey."', userId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' where pg_det_id=4  ");
	

	
	echo "success";
	
	
}

else{
	echo "error";
}



?>