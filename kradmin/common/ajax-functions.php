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
				
				$dynamic_html =' <div class="widget portlet-widget col-md-12" id="address_row_'.$hdn_editaddressid.'">
                            <div class="widget-content widget-content-area">
                                <div class="portlet portlet-warning">
                                    <div class="portlet-title portlet-warning d-flex justify-content-between">
                                        <div class="caption  align-self-center">
                                            <span class="caption-subject text-uppercase white ml-1"> Address </span>
                                        </div>
                                        <div class="actions  align-self-center"> 
                                            <a href="javascript:;" onclick="edit_address('.$hdn_editaddressid.')" class="btn btn-red btn-circle">
                                                <i class="flaticon-edit-7"></i>
                                            </a>
                                            <a href="javascript:;" onclick="remove_address('.$hdn_editaddressid.')" class="btn btn-red btn-circle">
                                                <i class="flaticon-delete"></i>
                                            </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body portlet-common-body">
                                         <address>
											<div class="row"><div class="col-md-12"><b>First Name : '.$rslt_html['firstname'].'</div></div>
											<div class="row"><div class="col-md-12"><b>Last Name : '.$rslt_html['lastname'].'</div></div> 
                                            <div class="row"><div class="col-md-12"><b>Address : '.$rslt_html['address'].'</div></div> 
                                            <div class="row"><div class="col-md-12"><b>Email : '.$rslt_html['emailid'].'</div></div> 
											<div class="row"><div class="col-md-12"><b>City : '.$rslt_html['city'].'</div></div> 
                                             <div class="row"><div class="col-md-12"><b>Postal code : '.$rslt_html['postalcode'].'</div></div> 
                                             <div class="row"><div class="col-md-12"><b>State : '.$rslt_html['statename'].'</div></div> 
											 <div class="row"><div class="col-md-12"><b>Country : '.$rslt_html['countryname'].'</div></div> 											
											 <div class="row"><div class="col-md-12"><b>Landmark : '.$rslt_html['landmark'].'</div></div> 											
											<div class="row"><div class="col-md-12"><b>Telephone : '. $rslt_html['telephone'] .'</div></div> 	 
											
												  
											</address>
                                    </div>
                                </div>
                            </div>
                        </div>


';				
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
				
				$dynamic_html =' 

<div class="widget portlet-widget col-md-4" id="address_row_'.$insert_cusAddressId.'">
                            <div class="widget-content widget-content-area">
                                <div class="portlet portlet-warning">
                                    <div class="portlet-title portlet-warning d-flex justify-content-between">
                                        <div class="caption  align-self-center">
                                            <span class="caption-subject text-uppercase white ml-1"> Address </span>
                                        </div>
                                        <div class="actions  align-self-center"> 
                                            <a href="javascript:;" onclick="edit_address('.$insert_cusAddressId.')" class="btn btn-red btn-circle">
                                                <i class="flaticon-edit-7"></i>
                                            </a>
                                            <a href="javascript:;" onclick="remove_address('.$insert_cusAddressId.')" class="btn btn-red btn-circle">
                                                <i class="flaticon-delete"></i>
                                            </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body portlet-common-body">
                                         <address>
											<div class="row"><div class="col-md-12"><b>First Name : '.$rslt_html['firstname'].'</div></div>
											<div class="row"><div class="col-md-12"><b>Last Name : '.$rslt_html['lastname'].'</div></div> 
                                            <div class="row"><div class="col-md-12"><b>Address : '.$rslt_html['address'].'</div></div> 
                                            <div class="row"><div class="col-md-12"><b>Email : '.$rslt_html['emailid'].'</div></div> 
											<div class="row"><div class="col-md-12"><b>City : '.$rslt_html['city'].'</div></div> 
                                             <div class="row"><div class="col-md-12"><b>Postal code : '.$rslt_html['postalcode'].'</div></div> 
                                             <div class="row"><div class="col-md-12"><b>State : '.$rslt_html['statename'].'</div></div> 
											 <div class="row"><div class="col-md-12"><b>Country : '.$rslt_html['countryname'].'</div></div> 											
											 <div class="row"><div class="col-md-12"><b>Landmark : '.$rslt_html['landmark'].'</div></div> 											
											<div class="row"><div class="col-md-12"><b>Telephone : '. $rslt_html['telephone'] .'</div></div> 	 
											
												  
											</address>
                                    </div>
                                </div>
                            </div>
                        </div>
							 ';	
				
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
				where t1.product_id = '".$id."' and IsActive=1 ";
		  // echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			 
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
						$dynamic_html .= '<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" value="'.$get_editval['AttributeValue'].'" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div> '; 				
					}
					else if($Get_customFields_S['elementid'] == 2){
						//textarea
						$dynamic_html .= '<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                               <textarea class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" >'.$get_editval['AttributeValue'].'</textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						 '; 				
					}

                    else if($Get_customFields_S['elementid'] == 8){
						//File Type 
						$accepttype =$Get_customFields_S['accept_filetype'];
						$filecount = $Get_customFields_S['numberoffile'];
						
					    $dynamic_html .= '<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /> <input type="hidden" name="actions" value="Filetype"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                               <input type="file" class="common_upload_style '.$Get_customFields_S['MandatoryAttr'].' customfiledsfile" id="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'[]" value="'.$get_editval['AttributeValue'].'"  accept="'.$Get_customFields_S['accept_filetype'].'"  multiple="multiple" / >
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
					 '; 	

                    }						
				}
				else if($Get_customFields_S['element_type'] == 3 )
				{
					//date time field
					$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
										
					$dynamic_html .= ' <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group ">
                          <label class="control-label"> <input type="hidden" name="cusfld_datebxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <div class="input-control text " data-role="datepicker"   data-format="d-mm-yyyy">
                              <input type="text" class="'.$Get_customFields_S['MandatoryAttr'].'"   name="cusfld_datebxVal_'.$Get_customFields_S['AttributeId'].'"  value="'.$get_editval['AttributeValue'].'" readonly required>
                              <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      
                    </div>
					 '; 			
				}	
				else
				{
					//multi options fields
					if($Get_customFields_S['elementid'] == 3)
					{				
						//dropdown field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
						
						$selbx_html = getSelectBox_CustomFieds($db,'cusfld_selbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
											
						$dynamic_html .= ' <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group">
                              <label class="control-label"><input type="hidden" name="cusfld_selbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group">
                              <div class="controls">
                                '.$selbx_html.'
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>'; 			
											
					}
					else if($Get_customFields_S['elementid'] == 4)
					{
						
						//checkbox field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
						
						$chkbx_html = getCheckBox_CustomFieds($db,'cusfld_chkbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);				
						$dynamic_html .= '<div class="row">
                          <div class="col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><input type="hidden" name="cusfld_chkbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col-md-3">
                            <div class="control-group mb-4">
                              <div class="controls">
                                '.$chkbx_html.'
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 '; 	
					}
					else if($Get_customFields_S['elementid'] == 6)
					{
						
						//radio field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
											
						$radiobx_html = getRadioBox_CustomFieds($db,'cusfld_radiobxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);	
						
						$dynamic_html .= '<div class="row">
                          <div class="col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"> <input type="hidden" name="cusfld_radiobxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col-md-3">
                            <div class="control-group mb-4">
                              <div class="controls">
                                '.$radiobx_html.'
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						'; 	
					}
					else if($Get_customFields_S['elementid'] == 7)
					{
						//multi select field
						$get_editval = $db->get_a_line("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id ='".$edit_id."' and AttributeId ='".$Get_customFields_S['AttributeId']."' ");
						
						$multiselbx_html = getMultiSelectBox_CustomFieds($db,'cusfld_mulselbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
						$dynamic_html .= '<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group">
                              <label class="control-label"> <input type="hidden" name="cusfld_mulselbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />'.$Get_customFields_S['AttributeName'].'</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group">
                              <div class="controls">
                                '.$multiselbx_html.'
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						 '; 	
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