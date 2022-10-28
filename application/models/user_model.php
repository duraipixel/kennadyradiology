<?php
class user_model extends Model {
	################## Register Page ###############
	function registerform_bck($filters) {
		
			$today = date("Y-m-d H:i:s");
			$target_dir	= "uploads/gstdocument/";
			$filters['emailid'] = $this->real_escape_string($filters['emailid']);  
			$str_ed = "select customer_id from ".TPLPrefix."customers where IsActive != '2' and customer_email = ? ";
			$res_ed = $this->get_a_line_bind($str_ed,array($filters['emailid']));	
			if(count($res_ed)>0){
				echo json_encode(array("rslt"=>"2"));
				exit;
			}	

			$filters['mobilenumber'] = $this->real_escape_string($filters['mobilenumber']);  
			$str_ed = "select customer_id from ".TPLPrefix."customers where IsActive != '2' and mobileno = ? ";
			$res_ed = $this->get_a_line_bind($str_ed,array($filters['mobilenumber']));	
			if(count($res_ed)>0){
				echo json_encode(array("rslt"=>"3"));
				exit;
			}	
          		
			if(isset($_FILES['gstdocument'])){
				$file_info = getimagesize($_FILES["gstdocument"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','pdf','png','doc') ) ){
					echo json_encode(array("rslt"=>"3"));
					exit();
				}			
				$target_file_t = $target_dir . basename($_FILES['gstdocument']["name"]);	
				$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
				$gstdocument = time().rand(0,9)."_gstdocument.".$imageFileType;
				$target_file = $target_dir . $gstdocument;	
				move_uploaded_file($_FILES['gstdocument']["tmp_name"], $target_file);
			}

			if(isset($_FILES['businesscard'])){		
				$target_dir	= "uploads/businesscard/";
				
				$file_info = getimagesize($_FILES["businesscard"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','pdf','png','doc') ) ){
					echo json_encode(array("rslt"=>"3"));
					exit();
				}				
				
				$target_file_t = $target_dir . basename($_FILES['businesscard']["name"]);	
				$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
				$businesscard = time().rand(0,9)."_businesscard.".$imageFileType;
				$target_file = $target_dir . $businesscard;	
				move_uploaded_file($_FILES['businesscard']["tmp_name"], $target_file);			
			}
          		
			$strQry ="INSERT INTO  ".TPLPrefix."customers (customer_group_id, customer_firstname, customer_lastname, customer_username, customer_email,mobileno, customer_pwd, gstdocument, businesscard, IsActive, UserId, createddate,modifiedDate,lang_id ) VALUES ( '".$this->getRealescape($filters['cus_groupid'])."', '".$this->getRealescape($filters['firstname'])."',  '".$this->getRealescape($filters['lastname'])."', '".$this->getRealescape($filters['emailid'])."','".($filters['emailid'])."', '".$this->getRealescape($filters['mobilenumber'])."','".md5($filters['password'])."','".$this->getRealescape($gstdocument)."','".$this->getRealescape($businesscard)."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."','".$_SESSION['lang_id']."')";
			
			$rsltMenu=$this->insert($strQry);
			$insert_cusId = $this->lastInsertId();
			//insert newsletter 
			if($filters['newsletter'] !=null)
			{	
				$strQry ="INSERT INTO  ".TPLPrefix."subscribe (emailid,  IsActive, UserId, createddate,modifiedDate ) VALUES ( '".$this->getRealescape($filters['emailid'])."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
				$rsltMenu=$this->insert($strQry);
			}
		
			require_once (__DIR__.'/mailsend.php');
			
			//send mail function -()
			Registermailfunction($this,$insert_cusId);
			   
    /* custom fileds textbox and textarea values save to table - START */ 	
		if($filters['actions']!='Filetype'){
            $cusfld_txtbxIDS = $filters['cusfld_txtbxIDS'];

	        if(isset($cusfld_txtbxIDS)){
			 
			  foreach($cusfld_txtbxIDS as $cusfld_txtbxIDS_S){
				  // {$cusfld_txtbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = $filters["cusfld_txtbxVal_".$cusfld_txtbxIDS_S]; 
				  				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_cusId."','".$cusfld_txtbxIDS_S."','".$this->getRealescape($var_name)."','1','0','".$today."','".$today."')";	
				 
				  $rslt = $this->insert($str);
				   
			  }
			 
		    } 
       	}	  
	/* custom fileds textbox and textarea values save to table - END */ 
	
			/* custom fileds Datetime values save to table - START */
		$cusfld_datebxIDS = $filters['cusfld_datebxIDS'];
		  if(isset($cusfld_datebxIDS)){
			  foreach($cusfld_datebxIDS as $cusfld_datebxIDS_S){
				  // {$cusfld_datebxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = $filter["cusfld_datebxVal_".$cusfld_datebxIDS_S];
				   
				  //insert Date form values to table  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_cusId."','".$cusfld_datebxIDS_S."','".$this->getRealescape($var_name)."','1','0','".$today."','".$today."')";			
				  $rslt = $this->insert($str);
				  
			  }
		  }  
		  
		/* custom fileds Datetime values save to table - END */
		 

		 
		/* custom fileds Select box values save to table - START */ 
		
		$cusfld_selbxIDS = $filters['cusfld_selbxIDS'];
		 
		  if(isset($cusfld_selbxIDS)){
			  
			  foreach($cusfld_selbxIDS as $cusfld_selbxIDS_S){
				  
				  // {$cusfld_selbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = $filters["cusfld_selbxVal_".$cusfld_selbxIDS_S];
				  	
				  //insert Select box selected option id save to table  [insert IDs ] - table ".TPLPrefix."cus_attribute_tbl2
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl2 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate, ModifiedDate )values('".$insert_cusId."','".$this->getRealescape($cusfld_selbxIDS_S)."','".$this->getRealescape($var_name)."','1','0','".$today."','".$today."')";	
				  $rslt = $this->insert($str);
				  
			  }
			 
		  }  

		/* custom fileds Select box values save to table - END */   
		  
		 
		/* custom fileds Check box values save to table - START */ 
		$cusfld_chkbxIDS = $filters['cusfld_chkbxIDS'];
		 if(isset($cusfld_chkbxIDS)){
			  foreach($cusfld_chkbxIDS as $cusfld_chkbxIDS_S){
				  // {$cusfld_chkbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = $filters["cusfld_chkbxVal_".$cusfld_chkbxIDS_S];
				
				  $comb_ids = implode(",",$var_name);
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl3 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate, ModifiedDate )values('".$insert_cusId."','".$this->getRealescape($cusfld_chkbxIDS_S)."','".$this->getRealescape($comb_ids)."','1','0','".$today."','".$today."')";			
				  $rslt = $this->insert($str);
						
				   
			  }
		  } 		 
		/* custom fileds Check box values save to table - END */  

		 
		/* custom fileds Radio button values save to table - START */  
			$cusfld_radiobxIDS = $filters['cusfld_radiobxIDS'];
		  if(isset($cusfld_radiobxIDS)){
			  foreach($cusfld_radiobxIDS as $cusfld_radiobxIDS_S){
				  // {$cusfld_radiobxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = $filter["cusfld_radiobxVal_".$cusfld_radiobxIDS_S];
				  
				   $str="insert into ".TPLPrefix."cus_attribute_tbl2 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_cusId."','".$this->getRealescape($cusfld_radiobxIDS_S)."','".$this->getRealescape($var_name)."','1','0','".$today."','".$today."')";			
				  $rslt = $this->insert($str);
				  
				  
			  }
		  }     

		/* custom fileds Radio button values save to table - END */ 



		/* custom fileds Multi Select box values save to table - START */   			
			$cusfld_mulselbxIDS = $filter['cusfld_mulselbxIDS'];
			 if(isset($cusfld_mulselbxIDS)){
			  foreach($cusfld_mulselbxIDS as $cusfld_mulselbxIDS_S){
				  // {$cusfld_mulselbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = $filter["cusfld_mulselbxVal_".$cusfld_mulselbxIDS_S];
				 
				  $comb_ids = implode(",",$var_name);
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl3 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_cusId."','".$this->getRealescape($cusfld_mulselbxIDS_S)."','".$this->getRealescape($comb_ids)."','1','0','".$today."','".$today."')";			
				  $rslt = $this->insert($str);
						
				   
			  }
		  }	 
					  
		/* custom fileds Multi Select box values save to table - END */ 
	
		 $common = $this->loadModel('common_model'); 
		$loginfilters=array("email"=>$filters['emailid'],"pwd"=>$filters['password']);
		$retdata= $common->loginuser($loginfilters);
	
		if( $rsltMenu){
			 //echo json_encode(array("rslt"=>1));
			 echo $retdata;
		} 
		
	}

	function registerform($djModel){

		$today 					= date("Y-m-d H:i:s");
		$_REQUEST['emailid'] 	= $this->real_escape_string($_REQUEST['emailid']);  
		$str_ed 				= "select customer_id from ".TPLPrefix."customers where IsActive != '2' and customer_email = ? ";
		$res_ed 				= $this->get_a_line_bind($str_ed,array($_REQUEST['emailid']));	
		if( count( $res_ed ) > 0 ) {
            echo json_encode( array( "rslt" => "2" ) );
			exit;
		}	

		$insParams 				= array(
									'customer_group_id' 	=> $_REQUEST['cus_groupid'],
									'customer_firstname' 	=> $_REQUEST['firstname'],
									'customer_lastname'  	=> $_REQUEST['lastname'],
									'customer_username' 	=> $_REQUEST['emailid'],
									'customer_email' 		=> $_REQUEST['emailid'],
									'mobileno' 				=> $_REQUEST['mobilenumber'],
									'customer_pwd' 			=> md5($_REQUEST['password']),
									'gstdocument' 			=> $_REQUEST['gstdocument'],
									'businesscard' 			=> $_REQUEST['businesscard'],
									'IsActive' 				=> 0,
									'UserId' 				=> 0,
									'createddate' 			=> $today,
									'modifiedDate' 			=> $today,
									'lang_id' 				=> $_SESSION['lang_id']
 
								);
		$insert_cusId 			= $djModel->insertCommon( $insParams, TPLPrefix."customers" );
		
		require_once (__DIR__.'/mailsend.php');
		//send mail function -()
		Registermailfunction($this,$insert_cusId);
		echo json_encode(array("rslt"=>1));
		
	}
// checking for email duplication function	

function emailduplicatechecking($filters)
{
	$filters['emails']=$this->real_escape_string($filters['emails']);
	$str_ed = "select customer_id from ".TPLPrefix."customers where IsActive != '2' and customer_email = ? ";
	//echo $str_ed; exit;
	$res_ed = $this->get_a_line_bind($str_ed,array($filters['emails']));	
	if(count($res_ed)>0){
		echo json_encode(array("rslt"=>1));
		exit;
	}
		
}
	

//Resend mail function 	

    function resendmailfunction($filters)
	{
		$filters['emails']=$this->real_escape_string($filters['emails']);
		$str_qtr = "select customer_id from ".TPLPrefix."customers where customer_email=? and isactive = '0' ";
		$res_customer = $this->get_a_line_bind($str_qtr,array($filters['emails']));	
		
		if(count($res_customer)>0){
		require_once (__DIR__.'/mailsend.php');
		//send mail function -()
		Registermailfunction($this,$res_customer['customer_id']);
		echo json_encode(array("rslt"=>1));
		}
		else{
			echo json_encode(array("rslt"=>2));
			exit;
		}
	}
	
	 function testmailfunction()
	{
		
		require_once (__DIR__.'/mailsend.php');
		//send mail function -()
		ordermailfunction($this,'KK00100246');
		echo json_encode(array("rslt"=>1));
		
	}
	
	
//File or Image Uploaded Function Start
/*
	function uploadPortfolio($insert_id,$this,$cusfld_txtbxIDS,$filters){
    
	
	    $today=date("Y-m-d H:i:s");	
		if(isset($_FILES) && count($_FILES)){

			if (!file_exists(BASE_URL'uploads/customerfileup/')) {
				mkdir(BASE_URL'uploads/customerfileup/', 0777, true);
			}
			//print_r($_FILES); die();
			foreach($cusfld_txtbxIDS as $cusfld_txtbxid){	
			
				$var_name = $filters["cusfld_txtbxVal_".$cusfld_txtbxid];
				
				
			
				// print_r($_FILES); exit;
				if(isset($_FILES[$var_name])){
					
						//echo "1"; exit;
						$target_dir	= BASE_URL'uploads/customerfileup/';
						for($i=0;$i<count($_FILES[$var_name]["name"]); $i++){
								
							 $target_file_t = $target_dir . basename($_FILES[$var_name]["name"][$i]);					
							 $imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
							
							 $filename = $i."_".time().".".$imageFileType;
							$target_file = $target_dir . $filename;	
							move_uploaded_file($_FILES[$var_name]["tmp_name"][$i], $target_file);
							
								
								$str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_id."','".$cusfld_txtbxid."','".$filename."','1','0','".$today."','".$today."')";	
								
								$this->insert($str);
							 
															
						}	
					
				}		
			}				
		}	
    }
*/
//File or Image Uploaded Function End
	
	function getdynamiccustomerfields($customerid='',$elementid='',$type=''){
		$cond ='';
		if($elementid!='' && $type=='top'){
			$cond = " and t2.elementid <> '".$elementid."' ";
		}
		if($elementid!='' && $type=='bottom'){
			$cond = " and t2.elementid = '".$elementid."' ";
		}
		
	 $str_all="select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 
		inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1 $cond 
		inner join ".TPLPrefix."customfield_custgrp t3 on t3.CustomFieldId=t1.AttributeId and t3.IsActive=1 
		inner join  ".TPLPrefix."customer_group t4  on t4.customer_group_id=t3.CustomerGrupId and t4.IsActive=1 and t4.customer_group_id='2'
		where 1=1 and t1.IsActive =1 and t1.isregister=1 group by t1.AttributeCode order by t1.SortBy asc"; 
		//echo $str_all; exit;
	$Get_customFields=$this->get_rsltset($str_all);	
		
		//echo"<pre>"; print_r($Get_customFields); exit;
	
          $customFields_cnt = count($Get_customFields);	
        if($customFields_cnt > 0)
        {
			$dynamic_html = '';
							   
			foreach($Get_customFields as $Get_customFields_S)
			{ 		
					
				if($Get_customFields_S['element_type'] == 1 )
				{
					//textbox, textarea field
					$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
					//echo $get_editval
					if($Get_customFields_S['elementid'] == 1){
						//textbox
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />
						<input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" value="'.$get_editval['AttributeValue'].'" placeholder="'.$Get_customFields_S['AttributeName'].'" /></div>'; 	
                     					
					}
					else if($Get_customFields_S['elementid'] == 2){
						//textarea
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><textarea class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" >'.$get_editval['AttributeValue'].'</textarea></div>'; 				
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
					$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
										
					$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_datebxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4"><input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="cusfld_datebxVal_'.$Get_customFields_S['AttributeId'].'" onkeypress="return isNumber(event)" readonly placeholder="click to show calendar" value="'.$get_editval['AttributeValue'].'"   /></div></div>'; 			
				}	
				else
				{
					//multi options fields
					if($Get_customFields_S['elementid'] == 3)
					{	
                       // echo $Get_customFields_S['elementid']; exit;				
						//dropdown field
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						 
                        require_once(APP_DIR .'helpers/common_function.php');
	                    $helper=new common_function;
						
						$selbx_html = $helper->getSelectBox_CustomFieds('cusfld_selbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
										
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_selbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-12 control-label text-left nopad">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-12 nopad">'.$selbx_html.'</div></div>'; 			
											
					}
					else if($Get_customFields_S['elementid'] == 4)
					{
						//checkbox field
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$chkbx_html = $helper->getCheckBox_CustomFieds($this,'cusfld_chkbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);				
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_chkbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-5 checkbox icheck" id="custom_idtype">'.$chkbx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 6)
					{
						//radio field
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
											
						$radiobx_html = $helper->getRadioBox_CustomFieds($this,'cusfld_radiobxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);	
						
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_radiobxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4" id="custom_nationality">'.$radiobx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 7)
					{
						//multi select field
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$multiselbx_html = $helper->getMultiSelectBox_CustomFieds($this,'cusfld_mulselbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_mulselbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class="col-sm-2 control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-4">'.$multiselbx_html.'</div></div>'; 	
					}
					
					
					
										
										
				}
								
			}

             
 			return $dynamic_html;

		}		 
		
		
		
	}
	
	function updatemyaccount($filters)
	{
		//print_r($filters); exit;
		$today = date("Y-m-d H:i:s");
	      
		$strQry = "update ".TPLPrefix."customers set customer_firstname = '".$this->getRealescape($filters['firstname'])."', customer_lastname='".$this->getRealescape($filters['lastname'])."',mobileno='".$this->getRealescape($filters['mobilenumber'])."' where customer_id= ".$_SESSION['Cus_ID']." and IsActive = 1 ";
		//echo $strQry; exit;
	    $rsltMenu = $this->insert($strQry);
		$_SESSION['First_name'] = $filters['firstname'];
		
		if($filters['subscribe']=='1'){
			//echo"reach"; exit;
			$select_email = "select subscribeid from ".TPLPrefix."subscribe where IsActive=1 and emailid= ? ";
		    $rsltdata=$this->get_a_line_bind($select_email,array($this->getRealescape($filters['emailid'])));
		 
			if(count($rsltdata)=='0'){
				$strQry ="INSERT INTO  ".TPLPrefix."subscribe (emailid,  IsActive, UserId, createddate,modifiedDate ) VALUES ( '".$this->getRealescape($filters['emailid'])."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."')"; 
				$rsltMenu=$this->insert($strQry);
			}
			
		}
		else
		{
			$select_email = "select subscribeid from ".TPLPrefix."subscribe where IsActive=1 and emailid= ? ";
		    $rsltdata=$this->get_a_line_bind($select_email,array($this->getRealescape($filters['emailid'])));
			//echo $rsltdata['subscribeid']; exit;
			if($rsltdata['subscribeid']){
				$strQry ="update ".TPLPrefix."subscribe set IsActive='2' where subscribeid=".$this->getRealescape($rsltdata['subscribeid'])." "; 
				$rsltMenu=$this->insert($strQry);
		    }
		}
		if($rsltMenu){
			 echo json_encode(array("rslt"=>1));
		}
		
		
	}
	
	function getmanageaddressdisplay($customerid)
	{
		$customerid=$this->real_escape_string($customerid);
		$str_all=" select t1.*,t2.countryname,t3.statename from ".TPLPrefix."cus_address t1 
		inner join ".TPLPrefix."country t2 on t1.countryid = t2.countryid and t2.IsActive = 1  
		inner join ".TPLPrefix."state t3 on t3.stateid=t1.stateid and t3.IsActive=1 
		where  t1.IsActive =1 and t1.customer_id=? order by cus_addressid desc "; 
		//echo $str_all; exit;
	    $rsltAdd=$this->get_rsltset_bind($str_all,array($customerid));	
		
		return $rsltAdd;
	}
	
function getaddressdetails($cus_addressid)
	{
		$cus_addressid=$this->real_escape_string($cus_addressid);
		$str_all=" select t1.*,t2.countryname,t3.statename from ".TPLPrefix."cus_address t1 
		inner join ".TPLPrefix."country t2 on t1.countryid = t2.countryid and t2.IsActive = 1  
		inner join ".TPLPrefix."state t3 on t3.stateid=t1.stateid and t3.IsActive=1 
		where  t1.IsActive =1 and t1.cus_addressid=? order by cus_addressid desc "; 
		//echo $str_all; exit;
	    $rsltAdd=$this->get_a_line_bind($str_all,array($cus_addressid));	
		
		return $rsltAdd;
	}
	function getmanageaddress_autofill($customerid)
	{
		$customerid=$this->real_escape_string($customerid);
		$str_all=" select * from ".TPLPrefix."customers where customer_id=? and IsActive=1 "; 
		//echo $str_all; exit;
	    $rsltAdd=$this->get_a_line_bind($str_all,array($customerid));
		
		return $rsltAdd;
		
	}
	
	function statelist($filters)
	{

		$strSelHtml = " <option value=''> Select State </option> ";
		$country_ID = $_REQUEST['countryid'];
		$country_ID=$this->real_escape_string($country_ID);
		$StrQry="select stateid AS Id,statename AS Name from  ".TPLPrefix."state where IsActive=1 and countryid=? order by statename asc";
		//echo $StrQry; exit;
		$resQry = $this->get_rsltset_bind($StrQry,array($country_ID));
						
		if(!empty($resQry)) {
			foreach($resQry as $val) {
                $sel="";
                if($val['Id']==$filters['stateid'])
				{   
				 $sel=" selected='selected' ";	
				}
			
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}		
		}

		echo $strSelHtml;	
	}
	
	
	function countrylist($filters)
	{
		//$strSelHtml ="<option value=''>Select Country</option>";
		/*$country_ID = $_REQUEST['countryid'];
		$StrQry="select countryid AS Id,countryname AS Name from ".TPLPrefix."country where IsActive=1 and countryid=".$country_ID." ";	
       
	$resQry = $this->get_rsltset($StrQry);		
	
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			$sel="";
			if($val['Id']==$country_ID)
				 $sel=" selected='selected' ";
		 $strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}	
	
	echo $strSelHtml; */
		 
		 $helper=$this->loadHelper('common_function'); 
		 $country_ID = $_REQUEST['countryid'];
		 echo $helper->getSelectBox_countrylist_To_cus_address('sel_country',$country_ID);
	
	//echo json_encode(array("data"=>$strSelHtml));
	}
	
	function Addressform($djModel)
	{
		$filters = $_REQUEST;
		$helper=$this->loadHelper('common_function'); 
		$formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
		$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		$otherdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'other');
		
		if($_SESSION['Isguestcheckout']=="1" && $_SESSION['guestckout_sess_id']!=""){ 
		
			$cart 						= $this->loadModel('cart_model');
			$chkout 					= $this->loadModel('checkout_model');
			$getcheckoutproductlist  	= $cart->cartProductList();
		
			if(count($getcheckoutproductlist)==0)
			{
				$this->redirect('cart');
				exit;
			}
				
		}
		$today = date("Y-m-d H:i:s");	
		if(isset($filters['addressid']) && $filters['addressid']!=''){
			
				  $str=" update ".TPLPrefix."cus_address set address_type= '".$this->getRealescape($filters['address_type'])."', customer_id= '".$this->getRealescape($filters['customerid'])."', firstname='".$this->getRealescape($filters['firstname'])."', lastname='".$this->getRealescape($filters['lastname'])."',address='".$this->getRealescape($filters['address'])."',emailid='".$this->getRealescape($filters['email'])."',city='".$this->getRealescape($filters['city'])."',postalcode='".$this->getRealescape($filters['zipcode'])."',stateid='".$this->getRealescape($filters['sel_state'])."',countryid='".$this->getRealescape($filters['sel_country'])."',landmark='".$this->getRealescape($filters['landmark'])."',gstno='".$this->getRealescape($filters['gstno'])."',telephone='".$this->getRealescape($filters['mobileno'])."', IsActive='1',UserId='0',ModifiedDate='".$today."' where cus_addressid='".$this->getRealescape($filters['addressid'])."' ";		
                 // echo($str); exit;				  
				  $rsltMenu = $this->insert($str);
				  $_SESSION['addressid'] = $this->getRealescape($filters['addressid']);
				  $temp_cus_id=$_SESSION['Cus_ID'];
				 if($temp_cus_id=='')
					$temp_cus_id=session_id();	
				 // print_r($_SESSION); die();
				    $str_all=" select t1.*,t2.countryname,t3.statename from ".TPLPrefix."cus_address t1 
					inner join ".TPLPrefix."country t2 on t1.countryid = t2.countryid and t2.IsActive = 1  
					inner join ".TPLPrefix."state t3 on t3.stateid=t1.stateid and t3.IsActive=1 
					where  t1.IsActive =1 and t1.customer_id='".$temp_cus_id."' order by cus_addressid desc "; 
					//echo $str_all; exit;
	                $rsltAdd=$this->get_rsltset($str_all);
					//print_r($rsltAdd);
			    		
					$htmlappend ='';
					$selcls="";
					$chk="";
					$cnt=1;
				foreach($rsltAdd as $displayaddress) {
                    if($filters['checkout']=='checkoutaddress'){
						$_SESSION['addressid'] = $filters['addressid'];
						$selcls="";
						if($_SESSION['addressid']==$displayaddress['cus_addressid']	){
							$selcls=" active ";
							$chk =  'Checked="checked"';
						}
						
						   $htmlappend .='<div class="col-sm-12 col-md-6 col-lg-4">
                      <div class="delivery-address">
                        <div class="chiller_cb">
                          <input type="radio" selected="selected" id="slctadd_'.$cnt.'" onChange="return displayshipping_add('.$displayaddress['cus_addressid'].')" name="slctadd" >
                          <label for="slctadd_'.$cnt.'">&nbsp;</label>
                          <span></span> </div>
                        <p><i class="flaticon-user-7"></i> '.$displayaddress['firstname']." ".$displayaddress['lastname'].' </p>
                        <p><i class="flaticon-location-fill"></i>'.$displayaddress['address'].' </p>
                        <p><i class="flaticon-telephone"></i> '.$displayaddress['telephone'].'</p>
                        <p><i class="flaticon-email-fill-1"></i> '.$displayaddress['emailid'].'</p>
                        <p class="select-address">
                         <button type="button" class="edit-address" onClick="javascript:editaddress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['editaddress'].'">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                    <button type="button" class="delete-address" onClick="javascript:deladdress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['deladdress'].'">
                                    <i class="flaticon-delete-1"></i>
                                    </button>
									

                        </p>
                        </label>
                      </div>
                    </div>';
					 
									
                   
					}else{
			
					    
					    $htmlappend .='<div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i>'.$displayaddress['firstname'].' '.$displayaddress['lastname'].'</p>
                                 <p><i class="flaticon-location-fill"></i>'.$displayaddress['address'].' , '.$displayaddress['city'].' - '.$displayaddress['postalcode'].' , '.$displayaddress['statename'].' - '.$displayaddress['countryname'].'</p>
                                 <p><i class="flaticon-telephone"></i>'.$displayaddress['telephone'].'</p>
                                 <p><i class="flaticon-email-fill-1"></i>'.$displayaddress['emailid'].'</p>
                                 
                                 <p class="select-address">';
                                     if($displayaddress['address_type']==1){
                                     $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['primary'].'">
                                         <i class="flaticon-fill-tick"></i>
                                    </button>';
                                  }else if($displayaddress['address_type']==2){ 
                                 $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['secondary'].'">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>';
                                 }else if($displayaddress['address_type']==3){
                                 $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['other'].'">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>';
                                  } 
                                 
                                    
									$htmlappend .='<button type="button" class="edit-address" onClick="javascript:editaddress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['editaddress'].'">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                     <button type="button" class="delete-address" onClick="javascript:deladdress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['deladdress'].'">
                                    <i class="flaticon-delete-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>';
                           
					 
					}
					$cnt++;
				 } 
				  if($rsltMenu){
				    echo json_encode(array("rslt"=>2,"data"=>$htmlappend));
				  }
		} else {
				
			$_SESSION['First_name'] = $_REQUEST['firstname'];
			
			$insParams  			= array(

										'customer_id' 	=> $filters['customerid'],
										'firstname' 	=> $filters['firstname'],
										'lastname' 		=> $filters['lastname'],
										'address' 		=> $filters['address'],
										'emailid' 		=> $filters['email'],
										'city' 			=> $filters['city'],
										'postalcode' 	=> $filters['zipcode'],
										'stateid' 		=> $filters['sel_state'],
										'countryid' 	=> $filters['sel_country'],
										'landmark' 		=> $filters['landmark'],
										'telephone' 	=> $filters['mobileno'],
										'IsActive' 		=> 1,
										'UserId' 		=> 0,
										'CreatedDate' 	=> $today,
										'ModifiedDate' 	=> $today,
										'address_type' 	=> $filters['address_type'] ?? 0
										
									);
			$addresid 				= $djModel->insertCommon( $insParams, TPLPrefix."cus_address");
			$_SESSION['addressid'] 	= $addresid;
			$temp_cus_id 			= $_SESSION['Cus_ID'];
			if( $temp_cus_id == '' )
			$temp_cus_id 			= session_id();	
			
			$str_all=" select t1.*,t2.countryname,t3.statename from ".TPLPrefix."cus_address t1 
			inner join ".TPLPrefix."country t2 on t1.countryid = t2.countryid and t2.IsActive = 1  
			inner join ".TPLPrefix."state t3 on t3.stateid=t1.stateid and t3.IsActive=1 
			where  t1.IsActive =1 and t1.customer_id='".$temp_cus_id."' order by cus_addressid desc "; 
			//echo $str_all; exit;
			$rsltAdd=$this->get_rsltset($str_all);
				//print_r($rsltAdd);
			$htmlappend ='';
			$chk="";
			$selcls="";
			$cnt=1;
				
			$_SESSION['addressid'] = $addresid;
			
			if(count($rsltAdd)==1)
				$_SESSION['shippincode']= $rsltAdd[0]['postalcode'];
			foreach($rsltAdd as $displayaddress) {
				
				if($filters['checkout']=='checkoutaddress'){
					
					
					if($addresid==$displayaddress['cus_addressid']	){
							
							$selcls=" active";
							$chk = ' Checked="checked" ';
							
					}
					else{
						$selcls="";
						$chk = "";
					}
						
					$htmlappend .='<div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i>'.$displayaddress['firstname'].' '.$displayaddress['lastname'].'</p>
                                 <p><i class="flaticon-location-fill"></i>'.$displayaddress['address'].' , '.$displayaddress['city'].' - '.$displayaddress['postalcode'].' , '.$displayaddress['statename'].' - '.$displayaddress['countryname'].'</p>
                                 <p><i class="flaticon-telephone"></i>'.$displayaddress['telephone'].'</p>
                                 <p><i class="flaticon-email-fill-1"></i>'.$displayaddress['emailid'].'</p>
                                 
                                 <p class="select-address">';
                                     if($displayaddress['address_type']==1){
                                     $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['primary'].'">
                                         <i class="flaticon-fill-tick"></i>
                                    </button>';
                                  }else if($displayaddress['address_type']==2){ 
                                 $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['secondary'].'">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>';
                                 }else if($displayaddress['address_type']==3){
                                 $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['other'].'">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>';
                                  } 
                                 
                                    
									$htmlappend .='<button type="button" class="edit-address" onClick="javascript:editaddress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['editaddress'].'">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                     <button type="button" class="delete-address" onClick="javascript:deladdress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['deladdress'].'">
                                    <i class="flaticon-delete-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>';
				} else {					
					$htmlappend .='<div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i>'.$displayaddress['firstname'].' '.$displayaddress['lastname'].'</p>
                                 <p><i class="flaticon-location-fill"></i>'.$displayaddress['address'].' , '.$displayaddress['city'].' - '.$displayaddress['postalcode'].' , '.$displayaddress['statename'].' - '.$displayaddress['countryname'].'</p>
                                 <p><i class="flaticon-telephone"></i>'.$displayaddress['telephone'].'</p>
                                 <p><i class="flaticon-email-fill-1"></i>'.$displayaddress['emailid'].'</p>
                                 
                                 <p class="select-address">';
                                     if($displayaddress['address_type']==1){
                                     $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['primary'].'">
                                         <i class="flaticon-fill-tick"></i>
                                    </button>';
                                  }else if($displayaddress['address_type']==2){ 
                                 $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['secondary'].'">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>';
                                 }else if($displayaddress['address_type']==3){
                                 $htmlappend .='<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="'.$otherdisplaylanguage['other'].'">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>';
                                  } 
                                 
                                    
									$htmlappend .='<button type="button" class="edit-address" onClick="javascript:editaddress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['editaddress'].'">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                     <button type="button" class="delete-address" onClick="javascript:deladdress('.$displayaddress['cus_addressid'].');" data-mdb-toggle="tooltip" title="'.$formdisplaylanguage['deladdress'].'">
                                    <i class="flaticon-delete-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>';
					}
					$cnt++;
				} 
	           
			 	if($addresid){
			      	echo json_encode(array("rslt"=>1,"data"=>$htmlappend));
				}
			}
			  
	}
	
	//Get the edit Address by Ajax 
	function updateaddress($filters)
	{
		$filters['addid']=$this->real_escape_string($filters['addid']);
		$str_all=" select t1.*,t2.countryname,t3.statename from ".TPLPrefix."cus_address t1 
		inner join ".TPLPrefix."country t2 on t1.countryid = t2.countryid and t2.IsActive = 1  
		inner join ".TPLPrefix."state t3 on t3.stateid=t1.stateid and t3.IsActive=1 
		where  t1.IsActive =1 and t1.cus_addressid=?  "; 
		//echo $str_all; exit;
	    $rsltAdd=$this->get_rsltset_bind($str_all,array($filters['addid']));	
		//print_r($rsltAdd); exit;
		echo json_encode(array("address_type"=>$rsltAdd[0]['address_type'],"fname"=>$rsltAdd[0]['firstname'],"lname"=>$rsltAdd[0]['lastname'],"email"=>$rsltAdd[0]['emailid'],"mobile"=>$rsltAdd[0]['telephone'],"add"=>$rsltAdd[0]['address'],"landmark"=>$rsltAdd[0]['landmark'],"gstno"=>$rsltAdd[0]['gstno'],"city"=>$rsltAdd[0]['city'],"zipcode"=>$rsltAdd[0]['postalcode'],"country"=>$rsltAdd[0]['countryid'],"state"=>$rsltAdd[0]['stateid'],"addid"=>$rsltAdd[0]['cus_addressid']));
	}
	
	//Delete Address
	function deleteaddress($filters)
	{
		$filters['addid']=$this->real_escape_string($filters['addid']);
		$add_qry=" delete from  ".TPLPrefix."cus_address where cus_addressid='".$filters['addid']."' "; 
		//echo $str_all; exit;
	    $rsltAdds=$this->get_rsltset($add_qry);	
		
		
		 $str_all=" select t1.*,t2.countryname,t3.statename from ".TPLPrefix."cus_address t1 
					inner join ".TPLPrefix."country t2 on t1.countryid = t2.countryid and t2.IsActive = 1  
					inner join ".TPLPrefix."state t3 on t3.stateid=t1.stateid and t3.IsActive=1 
					where  t1.IsActive =1 and t1.customer_id='".$_SESSION['Cus_ID']."' "; 
					//echo $str_all; exit;
	                $rsltAdd=$this->get_rsltset($str_all);
					//print_r($rsltAdd);
					$htmlappend='';
				foreach($rsltAdd as $displayaddress) { 
				
				        if($filters['checkout']=='checkoutaddresss'){
                       $htmlappend .='<div class="selectaddress">
									<div class="radiobtncss">
										<input type="radio" id="slctadd_'.$cnt.'" onChange="return displayshipping_add('.$displayaddress['cus_addressid'].')" name="slctadd" > 
										
						    			<label for="slctadd_'.$cnt.'" class="selsec">
						    				<span class="seladddet">
						    					<div class="seladddet-label">
						    						Name
						    					</div>
						    					<div class="seladddet-caption">
						    					<div>
						    						'.$displayaddress['firstname'].' '.$displayaddress['lastname'].'
													</div>
													
													<div>
						    						'.$displayaddress['emailid'].'
													</div>
													<div>
						    						'.$displayaddress['telephone'].'
						    					</div>
						    					</div>
												</span>
										
						    				<span class="seladddet">
						    					<div class="seladddet-label">
						    						Address
						    					</div>
						    					<div class="seladddet-caption">
						    						'.$displayaddress['address'].'
						    					</div>
						    				</span>
											
											<span><a href="javascript:void(0);" onclick="javascript:editaddress('. $displayaddress['cus_addressid'].');" >Edit</a></span><span> |  </span><span><a href="javascript:void(0);" onclick="javascript:deladdress('.$displayaddress['cus_addressid'].');">Remove</a></span>
						    			</label>
									</div>
								</div>';
					}else{
					$htmlappend .='<div class="infotitle shpadd">
						<span><h3>'.$displayaddress['firstname'].' '.$displayaddress['lastname'].'</h3></span>
						<p>'.$displayaddress['address'].'</p>
						<p>'.$displayaddress['city'].' - '.$displayaddress['postalcode'].'</p>
						<p>'.$displayaddress['telephone'].'</p>
						<p>'.$displayaddress['emailid'].'</p>
						<p><span><a href="javascript:void(0);" onclick="javascript:editaddress('.$displayaddress['cus_addressid'].');">Edit</a></span><span> | </span><span><a href="javascript:void(0);" onclick="javascript:deladdress('.$displayaddress['cus_addressid'].');">Remove</a></span></p>
					</div>';
					}
				 } 
				  
				    echo json_encode(array("rslt"=>3,"data"=>$htmlappend));

	}
	
	function changepasswords($filters)
	{
		
		if($filters['curpassword']!=$filters['newpassword']) {
		 $str_all=" select customer_id from ".TPLPrefix."customers where IsActive =1 and customer_pwd='".md5($filters['curpassword'])."' and customer_id='".$_SESSION['Cus_ID']."' "; 
		
	     $rsltAdd=$this->get_a_line($str_all);
		$customerid = $rsltAdd['customer_id'];
	  
		
		if(isset($customerid)){
				 
				$str=" update ".TPLPrefix."customers set customer_pwd= '".md5($filters['newpassword'])."' where customer_id='".$customerid."' and IsActive=1 ";		  
			   $rsltMenu = $this->insert($str);
			 echo json_encode(array("rslt"=>1)); //update success
		}
		else{
			echo json_encode(array("rslt"=>2)); //update failure 
							 
		}
	 }
		else{
			echo json_encode(array("rslt"=>3,"msg"=>"Old password & new password should not same ")); //update failure 
							 
		}	
		
	}
	
	function Register_activation($verificationcode)
	{
		$verificationcode=$this->real_escape_string($verificationcode);
		 //select query
		 $select_qry = "select t1.customer_id from ".TPLPrefix."customers t1 inner join ".TPLPrefix."register_verification t2 on t1.customer_id=t2.customerid and t2.IsActive=1 and t2.verification=? where t1.IsActive='0' ";
		 //echo $select_qry; die();
		 $rsltAdd=$this->get_a_line_bind($select_qry,array($verificationcode));
		 $cus_id =  $rsltAdd['customer_id'];
		 
		$str=" update ".TPLPrefix."customers set IsActive= '1' where customer_id='".$cus_id."' ";	
         //echo $str; die();		
	    $rsltMenu = $this->insert($str);
		return $rsltMenu;
	}
	
	function remembercookie($filters)
	{ 
	    
		$val = $filters['val'];
		//$cookieuname = $filters['un'];
		//$cookiepassword = $filters['pwd']; 
		$cookievariable = $filters['un'].':'.$filters['pwd'];
		
		$helper=$this->loadHelper('common_function'); 
		$kesarcookie = $helper->encrpt_decrpt_data($cookievariable,'e');
	     
		if($val=='1'){
			setcookie('kiran', $kesarcookie, time() + (86400 * 30), "/"); //one month
		}
		else{
			setcookie('kiran', null, -1, '/');
		}
	}
	
	
	function updateRecentview($data){
		if($_SESSION['Cus_ID'] == ''){
	 $sessionId=session_id();
		}else{
			$sessionId = '';
		}
		
	  $insert = "insert into ".TPLPrefix."recentview (product_id,customer_id,session_id,IsActive,Createddate) VALUES ('".$data['pid']."','".$_SESSION['Cus_ID']."','".$sessionId."',1,'".date('Y-m-d H:i:s')."') ";
	 $rslt = $this->insert($insert);
	}

	
}
?>