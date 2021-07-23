<?php 
include 'session.php';
extract($_REQUEST);
$today=date("Y-m-d");


try {

	if(isset($_REQUEST['hdnact'])){
		$act = $_REQUEST['hdnact'];
		$menutypeid = $_REQUEST['menutypeid'];
		
		if($act == "getMenulinkoptions"){	

			$strSelHtml = "";
			
			if($menutypeid == "1"){
				//CMS Page options
				$strSelHtml =  "<select class='form-control select2' name='sel_menulink[]'><option value=''>Select </option>";	
				
				$StrQry="select cms_pageid AS Id, cms_pagename AS Name from ".TPLPrefix."cms_pages where IsActive = '1' order by cms_pagename asc";
				$resQry = $db->get_rsltset($StrQry);
				
				if(!empty($resQry)) {
					foreach($resQry as $val) {
						$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
					}		
				}	
				
				$strSelHtml=$strSelHtml."</select>";
				
			}
			else if($menutypeid == "2"){
				//CMS block options
				$strSelHtml =  "<select class='form-control select2' name='sel_menulink[]'><option value=''>Select </option>";	
				
				$StrQry="select cms_blockid AS Id, cms_blockname AS Name from ".TPLPrefix."cms_block where IsActive = '1' order by cms_blockname asc";
				$resQry = $db->get_rsltset($StrQry);
				
				if(!empty($resQry)) {
					foreach($resQry as $val) {
						$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
					}		
				}	
				
				$strSelHtml=$strSelHtml."</select>";
			}
			else if($menutypeid == "3"){
				//Category options
				
				include "common/dpselect-functions.php";				
				$strSelHtml = getSelectBox_categorylist($db,'sel_menulink[]',''); 
				
				//$strSelHtml =  "<select class='form-control select2' name='sel_menulink[]'><option value=''> Select Link </option>";	
				
				//$strSelHtml=$strSelHtml."</select>";
				
			}
			else if($menutypeid == "4"){
				//Link text box
				$strSelHtml = '<input type="text" class="form-control jsrequired" name="sel_menulink[]" placeholder="Link" />';
					
			}
			
			
			echo json_encode(array("rslt"=>$strSelHtml)); //return success
			
		}
	}	
	else{
		echo json_encode(array("rslt"=>"server busy")); //return error
	}


}

catch (Exception $e) {
   // echo 'Caught exception: ',  $e->getMessage(), "\n";
	echo json_encode(array("rslt"=>$e->getMessage())); //return 
}

die();
?>