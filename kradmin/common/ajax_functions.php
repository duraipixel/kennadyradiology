<?php 
include "../session.php";
include "dpselect-functions.php";
extract($_REQUEST);

if(isset($_REQUEST['hdnact'])){
	$act = $_REQUEST['hdnact'];
	if($act == "getStatelist"){
		
		$strSelHtml = " <option value=''> Select State </option> ";
		$country_ID = $_REQUEST['countryid'];
		$StrQry="select stateid AS Id,statename AS Name from  ".TPLPrefix."state where IsActive=1 and countryid='".$country_ID."' order by statename asc";
		$resQry = $db->get_rsltset($StrQry);
						
		if(!empty($resQry)) {
			foreach($resQry as $val) {			
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}		
		}

		echo $strSelHtml;	
	}
	else if($act == "cusaddress"){	
	
		if(isset($edit_id)){
			if(isset($hdn_editaddressid) && $hdn_editaddressid != ""){
				//edit			
				
				$rslt = $db->insert("update ".TPLPrefix."cus_address set firstname ='".getRealescape($txt_firstname)."', lastname ='".getRealescape($txt_lastname)."', address ='".getRealescape($txt_address)."', emailid ='".getRealescape($txt_email)."', city ='".$txt_city."', postalcode ='".$txt_postcode."', stateid ='".$sel_state."', countryid ='".$sel_country."',  UserId='".$_SESSION["UserId"]."',  landmark='".$txt_landmark."',  telephone='".$txt_telephone."' where  customer_id='".$edit_id."' and cus_addressid='".$hdn_editaddressid."'  ");	

				$rslt_html = $db->get_a_line("SELECT t1.*,t2.statename,t3.countryname FROM ".TPLPrefix."cus_address t1 inner join ".TPLPrefix."state t2 on t1.stateid = t2.stateid inner join ".TPLPrefix."country t3 on t1.countryid = t3.countryid WHERE 1=1 and t1.cus_addressid ='".$hdn_editaddressid."' ");
				
				$dynamic_html =' <div class="box box-success box-solid"><div class="box-header with-border"> <h3 class="box-title">Address</h3> <div class="box-tools pull-right"> <span class="btn btn-box-tool" onclick="edit_address('.$hdn_editaddressid.')"><i class="fa fa-edit"></i></span><span class="btn btn-box-tool" onclick="remove_address('.$hdn_editaddressid.')"> <i class="fa fa-times"></i> </span> </div></div><div class="box-body"> <address> ';
				
				if($rslt_html['firstname'] !="")
					$dynamic_html .= '<b>First Name</b> : '. $rslt_html['firstname'];
				if($rslt_html['lastname'] !="")
					$dynamic_html .= '<b>Last Name</b> : '. $rslt_html['lastname'] .'<br/>';
				if($rslt_html['address'] !="")
					$dynamic_html .= '<b>Address</b> : '. $rslt_html['address'] .'<br/>';
				if($rslt_html['emailid'] !="")
					$dynamic_html .= '<b>Email</b> : '. $rslt_html['emailid'] .'<br/>';
				if($rslt_html['city'] !="")
					$dynamic_html .= '<b>City</b> : '. $rslt_html['city'] .'<br/>';
				if($rslt_html['postalcode'] !="")
					$dynamic_html .= '<b>Postal code</b> : '. $rslt_html['postalcode'] .'<br/>';
				if($rslt_html['stateid'] !="")
					$dynamic_html .= '<b>State</b> : '. $rslt_html['statename'] .'<br/>';
				if($rslt_html['countryid'] !="")
					$dynamic_html .= '<b>Country</b> : '. $rslt_html['countryname'] .'<br/>';	
				if($rslt_html['landmark'] !="")
					$dynamic_html .= '<b>Landmark</b> : '. $rslt_html['landmark'] .'<br/>';		
				if($rslt_html['telephone'] !="")
					$dynamic_html .= '<b>Telephone</b> : '. $rslt_html['telephone'] .'<br/>';				
				
				$dynamic_html .= ' </address> </div></div>';	
				
				echo json_encode(array("rslt_operation"=>"update","rslt_html"=>$dynamic_html));
				
			}
			else{
				//insert
				$today=date("Y-m-d");				
				
				$str="insert into ".TPLPrefix."cus_address (customer_id, firstname, lastname, address, emailid, city, postalcode, stateid, countryid, IsActive, UserId, CreatedDate,landmark, telephone )values('".$edit_id."','".getRealescape($txt_firstname)."','".getRealescape($txt_lastname)."','".getRealescape($txt_address)."','".getRealescape($txt_email)."','".$txt_city."','".$txt_postcode."','".$sel_state."','".$sel_country."','1','".$_SESSION["UserId"]."','".$today."','".$txt_landmark."','".$txt_telephone."')";			
				$rslt = $db->insert($str);	
				
				//address html
				$insert_cusAddressId = $db->insert_id;
				
				$rslt_html = $db->get_a_line("SELECT t1.*,t2.statename,t3.countryname FROM ".TPLPrefix."cus_address t1 inner join ".TPLPrefix."state t2 on t1.stateid = t2.stateid inner join ".TPLPrefix."country t3 on t1.countryid = t3.countryid WHERE 1=1 and t1.cus_addressid ='".$insert_cusAddressId."' ");
				
				$dynamic_html =' <div class="col-md-3" id="address_row_'.$insert_cusAddressId.'" ><div class="box box-success box-solid"><div class="box-header with-border"> <h3 class="box-title">Address</h3> <div class="box-tools pull-right"> <span class="btn btn-box-tool" onclick="edit_address('.$insert_cusAddressId.')"><i class="fa fa-edit"></i></span><span class="btn btn-box-tool" onclick="remove_address('.$insert_cusAddressId.')"> <i class="fa fa-times"></i> </span> </div></div><div class="box-body"> <address> ';
				
				if($rslt_html['firstname'] !="")
					$dynamic_html .= '<b>First Name</b> : '. $rslt_html['firstname'];
				if($rslt_html['lastname'] !="")
					$dynamic_html .= '<b>Last Name</b> : '. $rslt_html['lastname'] .'<br/>';
				if($rslt_html['address'] !="")
					$dynamic_html .= '<b>Address</b> : '. $rslt_html['address'] .'<br/>';
				if($rslt_html['emailid'] !="")
					$dynamic_html .= '<b>Email</b> : '. $rslt_html['emailid'] .'<br/>';
				if($rslt_html['city'] !="")
					$dynamic_html .= '<b>City</b> : '. $rslt_html['city'] .'<br/>';
				if($rslt_html['postalcode'] !="")
					$dynamic_html .= '<b>Postal code</b> : '. $rslt_html['postalcode'] .'<br/>';
				if($rslt_html['stateid'] !="")
					$dynamic_html .= '<b>State</b> : '. $rslt_html['statename'] .'<br/>';
				if($rslt_html['countryid'] !="")
					$dynamic_html .= '<b>Country</b> : '. $rslt_html['countryname'] .'<br/>';	
				if($rslt_html['landmark'] !="")
					$dynamic_html .= '<b>Landmark</b> : '. $rslt_html['landmark'] .'<br/>';		
				if($rslt_html['telephone'] !="")
					$dynamic_html .= '<b>Telephone</b> : '. $rslt_html['telephone'] .'<br/>';
				
				
				$dynamic_html .= ' </address> </div></div></div>';	
				
				echo json_encode(array("rslt_operation"=>"insert","rslt_html"=>$dynamic_html));
						
			}
		}			
	}
	
	else if($act == "editaddress"){	
		$cus_addressId = $_REQUEST['cusAddressid'];
		$res_ed = $db->get_a_line("select * from ".TPLPrefix."cus_address where cus_addressid='".$cus_addressId."' ");
		
		//$edit_id = $res_ed['customer_id'];
		echo json_encode(array("r_firstname"=>$res_ed['firstname'],"r_lastname"=>$res_ed['lastname'],"r_address"=>$res_ed['address'],"r_email"=>$res_ed['emailid'],"r_city"=>$res_ed['city'],"r_postalcode"=>$res_ed['postalcode'],"r_stateid"=>$res_ed['stateid'],"r_countryid"=>$res_ed['countryid'],"r_landmark"=>$res_ed['landmark'],"r_telephone"=>$res_ed['telephone']));		
		
	
	}
	else if($act == "removeCusaddress"){
		$cus_addressId = $_REQUEST['cusAddressid'];	
		$rslt = $db->insert(" delete from ".TPLPrefix."cus_address where cus_addressid='".$cus_addressId."'  ");
		echo json_encode(array("rslt"=>"5")); //deletion
	}
	
	else if($act == "reviewapprove"){
		$approve_idlist = $_REQUEST['approveidlist'];	        	
		$rslt = $db->insert("update ".TPLPrefix."productreview set IsActive ='1' where  ReviewId IN(".$approve_idlist.") ");	
	}
	
	else if($act == "deletereview"){
		$approve_idlist = $_REQUEST['approveidlist'];	        	
		$rslt = $db->insert("update ".TPLPrefix."productreview set IsActive ='2' where  ReviewId IN(".$approve_idlist.") ");	
		
	}
	else if($act == "urlslug"){
	
		echo generateslug($_GET['string']);
		
	}
	
	else if($act == "categoryliststree"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		//echo $id; die();
	  $str_Category = "SELECT 
				group_concat(categoryID) as categoryID			
				FROM  ".TPLPrefix."product_categoryid t1				
				where t1.product_id = '".$id."' and IsActive=1 and t1.parent_id= 0 ";
		 // echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}
	
	
	else if($act == "categorylistdiscount"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		//echo $id; die();
	  $str_Category = "SELECT 
				group_concat(DiscountCategorys) as categoryID			
				FROM  ".TPLPrefix."discount t1				
				where t1.DiscountID = '".$id."' and IsActive=1 ";
		  //echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}
	
	else if($act == "categorylistcoupon"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		//echo $id; die();
	  $str_Category = "SELECT 
				group_concat(CouponCategorys) as categoryID			
				FROM  ".TPLPrefix."coupons t1				
				where t1.CouponID = '".$id."' and IsActive=1 ";
		  //echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}
	
	
	else if($act == "getcostomerlist"){
		
		extract($REQUEST);
		//echo $id; die();

	$strQry="select customer_id AS Id,customer_firstname AS Name from ".TPLPrefix."customers where IsActive = '1' and customer_group_id = '".$customer_group_id."' ";
	//echo $strQry; exit;
	/*
	$strQry = "select a.customer_id AS Id,concat(b.AttributeValue,' ','(',a.customer_email,')') AS Name from ".TPLPrefix."customers a 
					inner join ".TPLPrefix."cus_attribute_tbl1 b ON b.customer_id = a.customer_id
					inner join ".TPLPrefix."customfields_attributes c ON c.AttributeId = b.AttributeId
					where a.Isactive =1 and c.AttributeCode = 'custfirstname'
				 ";
	*/			 
	$resQry = $db->get_rsltset($strQry);		
	
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}	
			
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	 echo json_encode(array("rslt"=>$strSelHtml));
	
	}
	
	
	
	else if($act == "getcustomergrouplist"){
		//echo "reach". $customerid; exit;
		
		//$Get_customFields = $db->get_rsltset("select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1 where 1=1 and t1.IsActive <>2 order by t1.SortBy asc"); 
		$Get_customFields = $db->get_rsltset("select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 
		inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1  
		inner join ".TPLPrefix."customfield_custgrp t3 on t3.CustomFieldId=t1.AttributeId and t3.IsActive=1 
		inner join  ".TPLPrefix."customer_group t4  on t4.customer_group_id=t3.CustomerGrupId and t4.IsActive=1 and t4.customer_group_id='".$customerid."'
		where 1=1 and t1.IsActive =1 and t1.isadmin=1 group by t1.AttributeCode order by t1.SortBy asc"); 
		
        $customFields_cnt = count($Get_customFields);	
        if($customFields_cnt > 0)
        {
			$dynamic_html = '';
							   
			foreach($Get_customFields as $Get_customFields_S)
			{ 		
					
				if($Get_customFields_S['element_type'] == 1 )
				{
					//textbox, textarea field
					$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
					//echo $get_editval
					if($Get_customFields_S['elementid'] == 1){
						//textbox
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />
						<label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4"><input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" value="'.$get_editval['AttributeValue'].'" /></div></div>'; 				
					}
					else if($Get_customFields_S['elementid'] == 2){
						//textarea
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4"><textarea class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" >'.$get_editval['AttributeValue'].'</textarea></div></div>'; 				
					}

                    else if($Get_customFields_S['elementid'] == 8){
						//File Type 
						$accepttype =$Get_customFields_S['accept_filetype'];
						$filecount = $Get_customFields_S['numberoffile'];
						
					    $dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /> <input type="hidden" name="actions" value="Filetype"  />
						<label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4"><input type="file" class="form-control '.$Get_customFields_S['MandatoryAttr'].' customfiledsfile" id="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'[]" value="'.$get_editval['AttributeValue'].'"  accept="'.$Get_customFields_S['accept_filetype'].'"  multiple="multiple" / ></div> <div class="form-upload" id="uploadedcustomer"></div> </div>'; 	

                    }						
				}
				else if($Get_customFields_S['element_type'] == 3 )
				{
					//date time field
					$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
										
					$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_datebxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4"><input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].' datepicker_today_max" name="cusfld_datebxVal_'.$Get_customFields_S['AttributeId'].'" onkeypress="return isNumber(event)" readonly placeholder="click to show calendar" value="'.$get_editval['AttributeValue'].'"   /></div></div>'; 			
				}	
				else
				{
					//multi options fields
					if($Get_customFields_S['elementid'] == 3)
					{				
						//dropdown field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
						
						$selbx_html = getSelectBox_CustomFieds($db,'cusfld_selbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
											
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_selbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4">'.$selbx_html.'</div></div>'; 			
											
					}
					else if($Get_customFields_S['elementid'] == 4)
					{
						
						//checkbox field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
						
						$chkbx_html = getCheckBox_CustomFieds($db,'cusfld_chkbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);				
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_chkbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-5 checkbox icheck" id="custom_idtype">'.$chkbx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 6)
					{
						
						//radio field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
											
						$radiobx_html = getRadioBox_CustomFieds($db,'cusfld_radiobxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);	
						
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_radiobxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4" id="custom_nationality">'.$radiobx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 7)
					{
						//multi select field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
						
						$multiselbx_html = getMultiSelectBox_CustomFieds($db,'cusfld_mulselbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_mulselbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4">'.$multiselbx_html.'</div></div>'; 	
					}
					
					
					
										
										
				}
								
			}


 			

		}	

     if(isset($filecount)){
         $filecount = $filecount;
	 }	
     else{
		  $filecount='';
	 }		 
	 
	 if(isset($accepttype)){
         $accepttype = $accepttype;
	 }	
     else{
		  $accepttype='';
	 }		 
		
		echo json_encode(array("rslt"=>$dynamic_html,"filecnt"=>$filecount,"acctype"=>$accepttype)); 
	}
	else if($act == "bannerposition"){
		
		if($bannerpositionid=='1'){
			$getsize = getimagesize_large($db,'Main Banner','banner desktop');
			$imageval = explode('-',$getsize);
			$imgheight = $imageval[1];
			$imgwidth = $imageval[0];

			$getsize1 = getimagesize_large($db,'Main Banner','mobilepath');
			$imagevals = explode('-',$getsize1);
			$imgheights = $imagevals[1];
			$imgwidths = $imagevals[0];
			echo json_encode(array("imgheight"=>$imgheight,"imgwidth"=>$imgwidth,"imgheights"=>$imgheights,"imgwidths"=>$imgwidths)); 
		}
		else{
			$getsize = getimagesize_large($db,'Award Receiver','banner desktop');
			$imageval = explode('-',$getsize);
			$aimgheight = $imageval[1];
			$aimgwidth = $imageval[0];

			$getsize1 = getimagesize_large($db,'Award Receiver','mobilepath');
			$imagevals = explode('-',$getsize1);
			$aimgheights = $imagevals[1];
			$aimgwidths = $imagevals[0];
			echo json_encode(array("imgheight"=>$aimgheight,"imgwidth"=>$aimgwidth,"imgheights"=>$aimgheights,"imgwidths"=>$aimgwidths));
		}
		
	}
	
	
}



 

?>