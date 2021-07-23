<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
//$today=date("Y-m-d");	

if($chkstatus !=null)
	$status =1;
else
	$status =0;


$today=date("Y-m-d H:i:s");	



			
if(isset($_REQUEST['getcusImage'])){
	$id = base64_decode($_REQUEST['cusid']);
	if($id != null){
		$str_ed_images = "SELECT t1.* FROM  ".TPLPrefix."cus_attribute_tbl1 t1 inner join ".TPLPrefix."customfields_attributes t2 on t1.AttributeId=t2.AttributeId and t2.AttributeType=8 where  t1.IsActive =? and t1.customer_id = ? order by t1.Cust_tbl1_AttrId asc ";
        //echo "<pre>"; print_r($str_ed_images); exit; 		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array(1,$id));		
		if(count($res_ed_images)){
			$counter = 1;
			foreach($res_ed_images as $valimages){									
				?>
				 <div class="column col-sm-2">
					<div class="portlet">
						<div class="portlet-header">Images <?php echo $counter; ?></div>
						<div class="portlet-content">					
						
							<img width="100" height="100" src="<?php echo image_public1_url."customerfileup/".$valimages['AttributeValue']; ?>" />
							<a onclick="deleventImg('<?php echo base64_encode($valimages['Cust_tbl1_AttrId']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);'>X</a>
							<input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['catimgid']; ?>" />
							<br/>
						</div>
					</div>
				</div>				
				<?php
				$counter++;
			}
			?>
			  <script>
			  $(function() {
				$( "#uploadedevents" ).sortable({
				  connectWith: ".column",
				  handle: ".portlet-header",
				  cancel: ".portlet-toggle",
				  placeholder: "portlet-placeholder ui-corner-all",
				  update: function( event, ui ) {
					  var order = '';
					  $(".productImgOrder").each(function(){
						  order += $(this).val()+",";
					  })					  
					  var imgOrder = order.substring(0,order.length -1);
					  $.post("ajaxresponse.php",{action:'catimgOrdering',ordering:imgOrder},function(){
						  swal("Success!", 'Image Order changes', "success");
					  })
				  }
				});
				
		 
				$( ".portlet" )
				  .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
				  .find( ".portlet-header" )
					.addClass( "ui-widget-header ui-corner-all" )
					.prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
			 
				$( ".portlet-toggle" ).click(function() {
				  var icon = $( this );
				  icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
				  icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
				});
			  });
			  </script>			 
			<?php
		}									
	}	
	exit();
}



switch($act)
{ 

  case 'insert':
      
	   // echo "<pre>"; print_r($_REQUEST); exit;
	   
	//   print_r($_FILES); die();
	if(!empty($selCusGroupid) &&!empty($fname) &&!empty($txtCusemail) &&!empty($mobileno) &&!empty($txtPwd) &&!empty($txtConfirmPwd)){
  
		 /* Customer Main table Insert - START	*/
		$strChk = "select count(customer_id) from ".TPLPrefix."customers where customer_email = ? and IsActive != ? ";
		
 		$reslt = $db->get_a_line_bind($strChk,array($txtCusemail,2));
		if($reslt[0] == 0) {
		$str="insert into ".TPLPrefix."customers (customer_group_id, customer_firstname, customer_lastname, customer_username, customer_email,mobileno, customer_pwd, discount, IsActive, UserId, createddate,modifiedDate )values(?,?,?,?,?,?,?,?,?,?,?,?)";			
		
		$rslt = $db->insert_bind($str,array($selCusGroupid,getRealescape($fname),getRealescape($lname),getRealescape($txtCusemail),getRealescape($txtCusemail),getRealescape($mobileno),md5(trim($txtPwd)),$discount,$status,$_SESSION["UserId"],$today,$today));	
		
		$insert_cusId = $db->insert_id;
		$log = $db->insert_log("insert","".TPLPrefix."customers","","customers Added Newly","customers",$str);
		
		uploadPortfolio($insert_cusId,$db,$cusfld_txtbxIDS);
		 /* Customer Main table Insert - END */
		  
		  
		 
		/* custom fileds textbox and textarea values save to table - START */ 	
        if($actions!='Filetype'){		
		  if(isset($cusfld_txtbxIDS)){
			 
			  foreach($cusfld_txtbxIDS as $cusfld_txtbxIDS_S){
				  // {$cusfld_txtbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_txtbxVal_".$cusfld_txtbxIDS_S;
				 $attr_opt_val = ${$var_name};		  
				  //insert all single values to table like textbox,textarea values  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values(?,?,?,?,?,?,?)";	
				 
				  $rslt = $db->insert_bind($str,array($insert_cusId,$cusfld_txtbxIDS_S,getRealescape($attr_opt_val),$status,$_SESSION["UserId"],$today,$today));
				   
			  }
			 
		    } 
        }		  
		/* custom fileds textbox and textarea values save to table - END */ 


		/* custom fileds Datetime values save to table - START */
		
		  if(isset($cusfld_datebxIDS)){
			  foreach($cusfld_datebxIDS as $cusfld_datebxIDS_S){
				  // {$cusfld_datebxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_datebxVal_".$cusfld_datebxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert Date form values to table  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values(?,?,?,?,?,?,?)";			
				  $rslt = $db->insert_bind($str,array($insert_cusId,$cusfld_datebxIDS_S,getRealescape($attr_opt_val),$status,$_SESSION["UserId"],$today,$today));
				  
			  }
		  }  
		  
		/* custom fileds Datetime values save to table - END */
		 

		 
		/* custom fileds Select box values save to table - START */ 
		
		  if(isset($cusfld_selbxIDS)){
			  foreach($cusfld_selbxIDS as $cusfld_selbxIDS_S){
				  // {$cusfld_selbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_selbxVal_".$cusfld_selbxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert Select box selected option id save to table  [insert IDs ] - table ".TPLPrefix."cus_attribute_tbl2
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl2 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate )values(?,?,?,?,?,?)";			
				  $rslt = $db->insert_bind($str,array($insert_cusId,$cusfld_selbxIDS_S,$attr_opt_val,$status,$_SESSION["UserId"],$today));
				  
			  }
		  }  

		/* custom fileds Select box values save to table - END */   
		  
		 
		/* custom fileds Check box values save to table - START */ 
		 if(isset($cusfld_chkbxIDS)){
			  foreach($cusfld_chkbxIDS as $cusfld_chkbxIDS_S){
				  // {$cusfld_chkbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_chkbxVal_".$cusfld_chkbxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert all single values to table like textbox,textarea values  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  $comb_ids = implode(",",$attr_opt_val);
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl3 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate )values(?,?,?,?,?,?)";			
				  $rslt = $db->insert_bind($str,array($insert_cusId,$cusfld_chkbxIDS_S,$comb_ids,$status,$_SESSION["UserId"],$today));
						
				   
			  }
		  } 		 
		/* custom fileds Check box values save to table - END */  

		 
		/* custom fileds Radio button values save to table - START */  
			
		  if(isset($cusfld_radiobxIDS)){
			  foreach($cusfld_radiobxIDS as $cusfld_radiobxIDS_S){
				  // {$cusfld_radiobxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_radiobxVal_".$cusfld_radiobxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert radio box selected option id save to table  [insert IDs ]
				  
				   $str="insert into ".TPLPrefix."cus_attribute_tbl2 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_cusId."','".$cusfld_radiobxIDS_S."','".$attr_opt_val."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
				  $rslt = $db->insert($str);
				  
				  
			  }
		  }     

		/* custom fileds Radio button values save to table - END */ 



		/* custom fileds Multi Select box values save to table - START */   			
			
			 if(isset($cusfld_mulselbxIDS)){
			  foreach($cusfld_mulselbxIDS as $cusfld_mulselbxIDS_S){
				  // {$cusfld_mulselbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_mulselbxVal_".$cusfld_mulselbxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert all single values to table like textbox,textarea values  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  $comb_ids = implode(",",$attr_opt_val);
				  
				  $str="insert into ".TPLPrefix."cus_attribute_tbl3 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$insert_cusId."','".$cusfld_mulselbxIDS_S."','".$comb_ids."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
				  $rslt = $db->insert($str);
						
				   
			  }
		  }	 
					  
		/* custom fileds Multi Select box values save to table - END */    
		
		echo json_encode(array("rslt"=>"1"));
        }
        else{
			
         echo json_encode(array("rslt"=>"9")); //same exists
		}
    }
    else{
        echo json_encode(array("rslt"=>"4"));  //no values
	}		
	
	break;
		
	
case 'update':

      //print_r($_REQUEST); exit;
	//$edit_id = base64_decode($Id);       	
	
	
  /* Customer Main table Update - START	*/	
	if(!empty($selCusGroupid) &&!empty($fname) &&!empty($txtCusemail) &&!empty($mobileno)){  
        $strChk = "select count(customer_id) from ".TPLPrefix."customers where customer_email = ? and customer_id !=? and IsActive != ? ";
		
 		$reslt = $db->get_a_line_bind($strChk,array($txtCusemail,$edit_id,2));
		if($reslt[0] == 0) {
          
        	if(isset($_FILES["gstdocument"])){
                $target_dir	= "../uploads/gstdocument/";
				$file_info = getimagesize($_FILES["gstdocument"]['tmp_name']['0']);
				$file_mime = explode('/',$file_info['mime']);		
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','doc') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
                				
				$target_file_t = $target_dir . basename($_FILES['gstdocument']["name"]['0']);	
				
				$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
				$gstdocument = time().rand(0,9)."_gstdocument.".$imageFileType;
				$target_file = $target_dir . $gstdocument;	
				move_uploaded_file($_FILES['gstdocument']["tmp_name"]['0'], $target_file);
				
				$gstimage= ",gstdocument='".getRealescape($gstdocument)."' ";

			}
			
			if(isset($_FILES["businesscard"])){
                
				$target_dir	= "../uploads/businesscard/";
				$file_info = getimagesize($_FILES["businesscard"]['tmp_name']['0']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','doc') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}				
				$target_file_t = $target_dir . basename($_FILES['businesscard']["name"]['0']);	
				$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
				$businesscard = time().rand(0,9)."_businesscard.".$imageFileType;
				$target_file = $target_dir . $businesscard;	
				move_uploaded_file($_FILES['businesscard']["tmp_name"]['0'], $target_file);
				
				$businesscardimage= ",businesscard='".getRealescape($businesscard)."' ";

			}
			
			
			
		$str = "update ".TPLPrefix."customers set customer_group_id ='".$selCusGroupid."', customer_firstname ='".$fname."',customer_lastname ='".$lname."',customer_email = '".$txtCusemail."',mobileno ='".$mobileno."',discount='".$discount."',IsActive = '".$status."' , UserId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' $gstimage $businesscardimage where  customer_id='".$edit_id."'  ";	
		//echo $str; exit; 
		 $log = $db->insert_log("update","".TPLPrefix."customers","","customers updated","customers",$str);
        $db->insert($str);		
		uploadPortfolio($edit_id,$db,$cusfld_txtbxIDS);
	/* Customer Main table Update - END */
	
	
	
	/* custom fileds textbox and textarea values save / update to table - START */ 		
		  if(isset($cusfld_txtbxIDS)){
			  foreach($cusfld_txtbxIDS as $cusfld_txtbxIDS_S){
				// {$cusfld_txtbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				$var_name = "cusfld_txtbxVal_".$cusfld_txtbxIDS_S;
				$attr_opt_val = ${$var_name};		  
				//insert all single values to table like textbox,textarea values  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				
				$chkRef_ed = $db->get_a_line("select Cust_tbl1_AttrId from ".TPLPrefix."cus_attribute_tbl1 where customer_id = '".$edit_id."' and IsActive<>2 and AttributeId='".$cusfld_txtbxIDS_S."' ");
				$chk_Ref_there = $chkRef_ed['Cust_tbl1_AttrId'];
				
				if($actions!='Filetype'){
					if (isset($chk_Ref_there)) {
						//update 
						$rslt = $db->insert("update ".TPLPrefix."cus_attribute_tbl1 set AttributeValue ='".getRealescape($attr_opt_val)."', UserId='".$_SESSION["UserId"]."',ModifiedDate = '".$today."' where  customer_id='".$edit_id."' and AttributeId='".$cusfld_txtbxIDS_S."'  ");	
					}
					else{   
						//insert 
						$str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_txtbxIDS_S."','".getRealescape($attr_opt_val)."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";	
						$rslt = $db->insert($str);
					}
			    }				
			  }
		  } 		  
	/* custom fileds textbox and textarea values save / update to table - END */ 
	
	
	/* custom fileds Datetime values save to table - START */		
		  if(isset($cusfld_datebxIDS)){
			  foreach($cusfld_datebxIDS as $cusfld_datebxIDS_S){
				  // {$cusfld_datebxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_datebxVal_".$cusfld_datebxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert Date form values to table  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  
				  $chkRef_ed = $db->get_a_line("select Cust_tbl1_AttrId from ".TPLPrefix."cus_attribute_tbl1 where customer_id = '".$edit_id."' and IsActive<>2 and AttributeId='".$cusfld_datebxIDS_S."' ");
				  $chk_Ref_there = $chkRef_ed['Cust_tbl1_AttrId'];
				  
				  if (isset($chk_Ref_there)) {
					//update 
					$rslt = $db->insert("update ".TPLPrefix."cus_attribute_tbl1 set AttributeValue ='".getRealescape($attr_opt_val)."', UserId='".$_SESSION["UserId"]."',ModifiedDate = '".$today."' where  customer_id='".$edit_id."' and AttributeId='".$cusfld_datebxIDS_S."'  ");	
				  }
				  else{
					 //insert 					
					 $str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_datebxIDS_S."','".getRealescape($attr_opt_val)."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
					 $rslt = $db->insert($str);
				  }				  
			  }
		  }
	/* custom fileds Datetime values save to table - END */
	
	
	/* custom fileds Select box values save to table - START */ 		
		  if(isset($cusfld_selbxIDS)){
			  foreach($cusfld_selbxIDS as $cusfld_selbxIDS_S){
				  // {$cusfld_selbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_selbxVal_".$cusfld_selbxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert Select box selected option id save to table  [insert IDs ] - table ".TPLPrefix."cus_attribute_tbl2
				  
				  $chkRef_ed = $db->get_a_line("select Cust_tbl2_AttrId from ".TPLPrefix."cus_attribute_tbl2 where customer_id = '".$edit_id."' and IsActive<>2 and AttributeId='".$cusfld_selbxIDS_S."' ");
				  $chk_Ref_there = $chkRef_ed['Cust_tbl2_AttrId'];
				  
				  if (isset($chk_Ref_there)) {
					//update 
					$rslt = $db->insert("update ".TPLPrefix."cus_attribute_tbl2 set AttributeValue ='".$attr_opt_val."', UserId='".$_SESSION["UserId"]."',ModifiedDate = '".$today."' where  customer_id='".$edit_id."' and AttributeId='".$cusfld_selbxIDS_S."'  ");	
				  }
				  else{
					//insert 	
					$str="insert into ".TPLPrefix."cus_attribute_tbl2 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_selbxIDS_S."','".$attr_opt_val."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
					$rslt = $db->insert($str);
				  }
				  
			  }
		  }  
	/* custom fileds Select box values save to table - END */  
	
	
	/* custom fileds Check box values save to table - START */ 
		 if(isset($cusfld_chkbxIDS)){
			  foreach($cusfld_chkbxIDS as $cusfld_chkbxIDS_S){
				  // {$cusfld_chkbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_chkbxVal_".$cusfld_chkbxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert all single values to table like textbox,textarea values  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  $comb_ids = implode(",",$attr_opt_val);
				  
				  $chkRef_ed = $db->get_a_line("select Cust_tbl3_AttrId from ".TPLPrefix."cus_attribute_tbl3 where customer_id = '".$edit_id."' and IsActive<>2 and AttributeId='".$cusfld_chkbxIDS_S."' ");
				  $chk_Ref_there = $chkRef_ed['Cust_tbl3_AttrId'];
				  
				  if (isset($chk_Ref_there)) {
					//update 
					$rslt = $db->insert("update ".TPLPrefix."cus_attribute_tbl3 set AttributeValue ='".$comb_ids."', UserId='".$_SESSION["UserId"]."',ModifiedDate = '".$today."' where  customer_id='".$edit_id."' and AttributeId='".$cusfld_chkbxIDS_S."'  ");	
				  }
				  else{  
					//insert 	
					$str="insert into ".TPLPrefix."cus_attribute_tbl3 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_chkbxIDS_S."','".$comb_ids."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
					$rslt = $db->insert($str);
				  }				  
			  }
		  } 		 
	/* custom fileds Check box values save to table - END */  
	
	
	/* custom fileds Radio button values save to table - START */ 			
		  if(isset($cusfld_radiobxIDS)){
			  foreach($cusfld_radiobxIDS as $cusfld_radiobxIDS_S){
				  // {$cusfld_radiobxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_radiobxVal_".$cusfld_radiobxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert radio box selected option id save to table  [insert IDs ]
				  
				  $chkRef_ed = $db->get_a_line("select Cust_tbl2_AttrId from ".TPLPrefix."cus_attribute_tbl2 where customer_id = '".$edit_id."' and IsActive<>2 and AttributeId='".$cusfld_radiobxIDS_S."' ");
				  $chk_Ref_there = $chkRef_ed['Cust_tbl2_AttrId'];
				  
				  if (isset($chk_Ref_there)) {
					//update 
					$rslt = $db->insert("update ".TPLPrefix."cus_attribute_tbl2 set AttributeValue ='".$attr_opt_val."', UserId='".$_SESSION["UserId"]."',ModifiedDate = '".$today."' where  customer_id='".$edit_id."' and AttributeId='".$cusfld_radiobxIDS_S."'  ");	
				  }
				  else{
					//insert  
					
					$str="insert into ".TPLPrefix."cus_attribute_tbl2 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_radiobxIDS_S."','".$attr_opt_val."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
					$rslt = $db->insert($str);
				  }
				  
			  }
		  }  
	/* custom fileds Radio button values save to table - END */ 
	
	
	/* custom fileds Multi Select box values save to table - START */   			
			
			 if(isset($cusfld_mulselbxIDS)){
			  foreach($cusfld_mulselbxIDS as $cusfld_mulselbxIDS_S){
				  // {$cusfld_mulselbxIDS_S - attribute ID } {$attr_opt_val - attribute option value}
				  $var_name = "cusfld_mulselbxVal_".$cusfld_mulselbxIDS_S;
				  $attr_opt_val = ${$var_name};		  
				  //insert all single values to table like textbox,textarea values  [insert values ] - table ".TPLPrefix."cus_attribute_tbl1
				  $comb_ids = implode(",",$attr_opt_val);
				  
				  $chkRef_ed = $db->get_a_line("select Cust_tbl3_AttrId from ".TPLPrefix."cus_attribute_tbl3 where customer_id = '".$edit_id."' and IsActive<>2 and AttributeId='".$cusfld_mulselbxIDS_S."' ");
				  $chk_Ref_there = $chkRef_ed['Cust_tbl3_AttrId'];
				  
				  if (isset($chk_Ref_there)) {
					//update 
					$rslt = $db->insert("update ".TPLPrefix."cus_attribute_tbl3 set AttributeValue ='".$comb_ids."', UserId='".$_SESSION["UserId"]."',ModifiedDate = '".$today."' where  customer_id='".$edit_id."' and AttributeId='".$cusfld_mulselbxIDS_S."'  ");						
				  }
				  else{
					//insert			
					$str="insert into ".TPLPrefix."cus_attribute_tbl3 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_mulselbxIDS_S."','".$comb_ids."','".$status."','".$_SESSION["UserId"]."','".$today."',,'".$today."')";			
					$rslt = $db->insert($str);					
				  }
				  
			  }
		  }	 
					  
		/* custom fileds Multi Select box values save to table - END */

	
		echo json_encode(array("rslt"=>"2"));		
		}
		else{
				
			 echo json_encode(array("rslt"=>"9")); //same exists
			}	
	}
	else{
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	break;
	
	
	case 'del':
	  $edit_id = base64_decode($Id);	  
	  //$today = date("Y-m-d");
	  
	  $str = "update ".TPLPrefix."customers set IsActive = '2',ModifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where customer_id = '".$edit_id."'";	
	  $db->insert_log("delete","".TPLPrefix."customers",$edit_id,"customers deleted","customers",$str);
	  $db->insert($str);	
	  
	  echo json_encode(array("rslt"=>"5")); //deleted success	  	 	  	 
		
	break;
	
	
	
	case 'deleteImg':
				
	$eId = base64_decode($_REQUEST['eId']);
	$eventImgId = base64_decode($_REQUEST['eventsImgId']);
	$str_ed = "SELECT * FROM  `".TPLPrefix."cus_attribute_tbl1` where customer_id = '".$eId."' and Cust_tbl1_AttrId = '".$eventImgId."'  ";
	
	$res_ed = $db->get_a_line($str_ed);
	
	//deleteing  the image from db and server
	 $str_delid = "DELETE FROM  `".TPLPrefix."cus_attribute_tbl1` where customer_id = '".$eId."' and Cust_tbl1_AttrId = '".$eventImgId."'  ";	
     
    $db->insert_log("delete","".TPLPrefix."cus_attribute_tbl1",$edit_id,"cus_attribute_tbl1 deleted","cus_attribute_tbl1",$str_delid); 
	$res_delid = $db->get_a_line($str_delid);	
	
	$target_dir	= '../uploads/customerfileup/'.$res_ed['AttributeValue'];
	
	unlink($target_dir);
	
	//header("Location: product_form.php?act=edit&id=".$_REQUEST['prodId']);
	exit;
	break;
	
	
	
	
		case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  //$today = date("Y-m-d");
	  $status = $actval;
	  
	  
	  //echo "select manufacturerId from ".TPLPrefix."products where manufacturerId = '".$edit_id."' and IsActive<>2 ";
	 // die();
	/*  $chkReference_ed = $db->get_a_line("select manufacturerId from ".TPLPrefix."products where manufacturerId = '".$edit_id."' and IsActive <> 2 ");
	  $chk_Ref_there = $chkReference_ed['manufacturerId'];
	 
	  if (isset($chk_Ref_there)) {
		  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  }
	  else{	*/ 
		  $str="update ".TPLPrefix."customers set IsActive = '$status', UserId='".$_SESSION["UserId"]."',modifiedDate = '".$today."' where customer_id = '".$edit_id."'";
		  $db->insert_log("update","".TPLPrefix."customers",$edit_id,"customers Statuschanged","customers",$str);
       
		  $db->insert($str); 	 
		  
		  
		  echo json_encode(array("rslt"=>"6")); //status change
	 // }
	  	 		
	break;
	
	
}



function uploadPortfolio($edit_id,$db,$cusfld_txtbxIDS){

	
$today=date("Y-m-d H:i:s");	
	if(isset($_FILES) && count($_FILES)){

		if (!file_exists('../uploads/customerfileup/')) {
			mkdir('../uploads/customerfileup/', 0777, true);
		}
		//print_r($_FILES); die();
		foreach($cusfld_txtbxIDS as $cusfld_txtbxid){	
		
		    $var_name = "cusfld_txtbxVal_".$cusfld_txtbxid;
			
			
		
			// print_r($_FILES); exit;
			if(isset($_FILES[$var_name])){
				
					//echo "1"; exit;
					$target_dir	= '../uploads/customerfileup/';
					for($i=0;$i<count($_FILES[$var_name]["name"]); $i++){
							
						 $target_file_t = $target_dir . basename($_FILES[$var_name]["name"][$i]);					
						 $imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
						
						 $filename = $i."_".time().".".$imageFileType;
						$target_file = $target_dir . $filename;	
                        move_uploaded_file($_FILES[$var_name]["tmp_name"][$i], $target_file);
						
							
							$str="insert into ".TPLPrefix."cus_attribute_tbl1 (customer_id, AttributeId, AttributeValue, IsActive, UserId, CreateDate,ModifiedDate )values('".$edit_id."','".$cusfld_txtbxid."','".$filename."','1','".$_SESSION["UserId"]."','".$today."','".$today."')";	
							
							$db->insert($str);
                         
														
					}	
				
			}		
		}				
	}	
}





?>