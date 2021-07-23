<?php 
function getSelectBox_menulist($db, $SelName, $jrequired,$Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select MenuId AS Id,MenuName AS Name from ".TPLPrefix."menus where IsActive = '1' order by MenuName asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$jrequired."' id='".$SelName."' name='".$SelName."'  ".$Attr." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


	
function getSelectBox_categorymulti($db, $SelName, $Attr,$parent = null,$selparent=null,$selId=null,$prop=null) {
	 
	
	 $StrQry="SELECT a.categoryID as Id, a.categoryName as Name, Deriv1.Count FROM `".TPLPrefix."category` a  LEFT JOIN (SELECT parentId, COUNT(*) AS Count FROM `".TPLPrefix."category` GROUP BY parentId) Deriv1 ON a.categoryID = Deriv1.parentId WHERE IsActive = 1 and a.parentId='".$parent."'";
	
	$resQry = $db->get_rsltset($StrQry);		

	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."[]' ".$prop." onchange='choosecats(this.value)' ><option value='-100'>All Category</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		
			if ($val['Count'] > 0) 
			{	$sel='';	
				
					if(in_array($val['Id'],explode(',',$selparent)))
					
				//if($selparent==$val['Id'])
					$sel=' selected="selected" ';
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
				$catmnId = $val['Id'];
				 $strSelHtml=$strSelHtml.getSelectBox_categorySubcatlist($db,$SelName, $catmnId,$selparent);
			}
			else
			{
				$sel='';
				//if($selparent==$val['Id'])
				if(in_array($val['Id'],explode(',',$selparent)))
					$sel=' selected="selected" ';
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}
		}
		
	}
	
	 $strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
} 
function getSelectBox_PincodeList($db, $SelName, $Attr,$selId=null,$prop=null,$pincodeid=null) {
	
    if($pincodeid!=''){
        $con_qry .= " and  pincodeid =".$pincodeid." ";
    }
	$StrQry="select pincodeid AS Id,pincode AS Name from ".TPLPrefix."pincode where IsActive = '1' ".$con_qry." order by pincode asc";
	//echo $StrQry;
	$resQry = $db->get_rsltset($StrQry);

	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option></option>";
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val->Id)
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val->Id." ".$sel.">".$val->Name."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}



function getSelectBox_AreaList($db, $SelName, $Attr,$selId=null,$prop=null,$cityid=null) {
	
     if($cityid!=''){
            $con_qry .= " and  cityid =".$cityid." ";
        }
        
    	$StrQry="select areaid AS Id,areaname AS Name from ".TPLPrefix."area where IsActive = '1' ".$con_qry." order by areaname asc";
    	//echo $StrQry;
    	$resQry = $db->get_rsltset($StrQry);
 
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." onchange = 'PincodeList(this.value)'><option></option>";
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val->Id)
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val->Id." ".$sel.">".$val->Name."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_attrGroupalist($db, $SelName, $jrequired,$Attr,$selId=null) {
	if($StrQry ==''){	
		if($selId != '')	{
		$StrQry="select attribute_groupId AS Id,attribute_groupName AS Name from ".TPLPrefix."attributegroup where IsActive = '1' and IsDisplay=1   and attribute_groupId ='$selId' and parent_id = 0 order by attribute_groupName asc";
		}
		else{
		$StrQry="select attribute_groupId AS Id,attribute_groupName AS Name from ".TPLPrefix."attributegroup where IsActive = '1' and parent_id = 0 and IsDisplay=1  and attribute_groupId not in(select attribute_groupId from ".TPLPrefix."attributes where IsActive <> 2 and parent_id = 0) order by attribute_groupName asc";
		}
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$jrequired."' id='".$SelName."' name='".$SelName."'  ".$Attr." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_rolelist($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select RoleId AS Id,RoleName AS Name from ".TPLPrefix."roles where IsActive = '1' and RoleId <> 1 order by RoleName asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop."><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

//Mail Template Function
function getSelectBox_mailtemplate($db, $SelName, $Attr,$selId=null,$pro=null) {
			
		$StrQry="select masterid AS Id,templatename AS Name from ".TPLPrefix."mailtemplate_master where IsActive = '1'  order by masterid asc";
	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' required><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_countrylist($db, $SelName, $Attr,$selId=null,$prop=null) {
 	if($StrQry ==''){		
		$StrQry="select countryid AS Id,countryname AS Name from ".TPLPrefix."country where IsActive = '1' order by countryname asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option value=''></option>";
		$sel='';
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
		
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}



function getSelectBox_categorySubcatlist($db,$SelName=null,$selId=null,$selcatId=null){
	//if($SstrQry ==''){	
		
	 $SstrQry="SELECT a.categoryID as Id, a.categoryName as Name, Deriv1.Count FROM `".TPLPrefix."category` a  LEFT JOIN (SELECT parentId, COUNT(*) AS Count FROM `".TPLPrefix."category` GROUP BY parentId) Deriv1 ON a.categoryID = Deriv1.parentId WHERE IsActive = 1 and a.parentId='".$selId."'";
	//}	
	$resSQry = $db->get_rsltset($SstrQry);
	/*if(!empty($resSQry)) {
		*/
		foreach($resSQry as $svals) 
		{
			
				if ($svals['Count'] > 0) 
				{	$sels='';				
					if($selcatId==$svals['Id'])
						$sels=' selected="selected" ';
					$strSelHtml=$strSelHtml."<option value=".$svals['Id']." ".$sels.">--".$svals['Name']."</option>";
					$catmnIds = $svals['Id'];
					$strSelHtml=$strSelHtml.getSelectBox_categorySubcatlist($db, $SelName,$catmnIds,$selcatId);
				}
				else
				{$sels='';
					if($selcatId==$svals['Id'])
						$sels=' selected="selected" ';
					$strSelHtml=$strSelHtml."<option value=".$svals['Id']." ".$sels.">---".$svals['Name']."</option>";
				}
			
		}
	/*}*/
	return $strSelHtml;	
	
}
	
function getSelectBox_categorylist($db, $SelName, $Attr,$parent = null,$selparent=null,$selId=null,$prop=null) {
	
	 $StrQry="SELECT a.categoryID as Id, a.categoryName as Name, Deriv1.Count FROM `".TPLPrefix."category` a  LEFT JOIN (SELECT parentId, COUNT(*) AS Count FROM `".TPLPrefix."category` GROUP BY parentId) Deriv1 ON a.categoryID = Deriv1.parentId WHERE IsActive = 1 and a.parentId='".$parent."' and a.parent_id = 0";
	
	$resQry = $db->get_rsltset($StrQry);		

	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." onchange='productlist(this.value)' ><option value='0'>Parent Category</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		
			if ($val['Count'] > 0) 
			{	$sel='';	
				
				if($selparent==$val['Id'])
					$sel=' selected="selected" ';
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
				$catmnId = $val['Id'];
				 $strSelHtml=$strSelHtml.getSelectBox_categorySubcatlist($db,$SelName, $catmnId,$selparent);
			}
			else
			{
				$sel='';
				if($selparent==$val['Id'])
					$sel=' selected="selected" ';
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}
		}
		
	}
	
	 $strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
} 



function getSelectBox_categoryparentonly($db, $SelName, $Attr,$parent = null,$selparent=null,$selId=null,$prop=null) {
	
	 $StrQry="SELECT a.categoryID as Id, a.categoryName as Name, Deriv1.Count FROM `".TPLPrefix."category` a  LEFT JOIN (SELECT parentId, COUNT(*) AS Count FROM `".TPLPrefix."category` GROUP BY parentId) Deriv1 ON a.categoryID = Deriv1.parentId WHERE IsActive = 1 and a.parentId='0'";
	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option value=''>Parent Category</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		
			
				$sel='';
				if($selparent==$val['Id'])
					$sel=' selected="selected" ';
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			
		}
		
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
} 

function getSelectBox_attrgrouplist($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select attribute_groupID AS Id, attribute_groupName AS Name from ".TPLPrefix."attributegroup where IsActive = '1' and IsDisplay=1 order by attribute_groupName asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
		
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getSelectBox_citieslist($db, $SelName, $Attr,$selId=null,$prop=null,$StateID=null) {
	if($StrQry ==''){		
		$StrQry="select CityID AS Id, CityName AS Name from  ".TPLPrefix."city where IsActive = '1' ";
		
		if($StateID != '')
		$StrQry .= " and StateID = '".$StateID."'";
		
		$StrQry .= " order by CityName asc";
	}	
	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option></option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}



function getSelectBox_statelist($db, $SelName, $Attr,$selId=null,$prop=null,$countryId=null) {
	if($StrQry ==''){		
		$StrQry="select stateid AS Id,statename AS Name from  ".TPLPrefix."state where IsActive = '1' ";
		
		if($countryId != '')
		$StrQry .= " and countryid = '".$countryId."'";
		
		$StrQry .= " order by statename asc";
	}	
	//echo $StrQry;
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select required class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop."><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_countrylistMultiple($db, $SelName, $Attr,$selId=null,$prop=null) {

 $chk_listarray = explode(",",$selId); 
	if($StrQry ==''){		
		$StrQry="select countryid AS Id,countryname AS Name from ".TPLPrefix."country where IsActive = '1' order by countryname asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."[]' ".$prop." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
		$mnid = trim($val['Id']);
			if(in_array($mnid,$chk_listarray))
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
		
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_statelistShip($db, $SelName, $Attr,$selId=null,$prop=null,$countryId=null) {

$chk_listarray = explode(",",$selId); 
	if($StrQry ==''){		
		$StrQry="select stateid AS Id,statename AS Name from  ".TPLPrefix."state where IsActive = '1' ";
		
		if($countryId != '')
		$StrQry .= " and countryid in( ".$countryId.")";
		
		$StrQry .= " order by statename asc";
	}	
	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."[]' ".$prop.">";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
		$mnid = trim($val['Id']);
			if(in_array($mnid,$chk_listarray))
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getSelectBox_departmentlist($db, $SelName, $Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select departmentid AS Id,departmentname AS Name from  ".TPLPrefix."department where IsActive = '1' order by departmentname asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_Currencylist($db, $SelName, $Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select currencyid AS Id,currencysymbol AS Name from  ".TPLPrefix."currency where IsActive = '1' ";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_skilllist($db, $SelName, $Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select skillid AS Id,skillname AS Name from  ".TPLPrefix."skill where IsActive = '1' order by skillname asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_levellist($db, $SelName, $Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select levelid AS Id,levelname AS Name from  ".TPLPrefix."level where IsActive = '1' order by levelname asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_ProjectTypelist($db, $SelName, $Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select projecttypeid AS Id,projecttypename AS Name from  ".TPLPrefix."projecttype where IsActive = '1' order by projecttypeid asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_Taxlist($db, $SelName, $Attr,$selId=null) {
	//echo "id: ". $selId;
	if($StrQry ==''){		
		$StrQry="select taxId AS Id,taxName AS Name from  ".TPLPrefix."taxmaster where IsActive = '1' order by taxName asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' >";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
		  // echo  "selid: ".$selId." "."totid: ".$val['Id'];
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_CustomFieldsElements($db, $SelName, $class,$selId=null,$Attr=null) {
	if($StrQry ==''){		
		$StrQry="select elementid AS Id,elementname AS Name from ".TPLPrefix."m_elements where IsActive = '1' ";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select ".$Attr." class='form-control select2 ".$class."' id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_Customergroups($db, $SelName, $class,$selId=null,$Attr=null,$prop=null) {
	$StrQry="select customer_group_id AS Id,customer_group_name AS Name from ".TPLPrefix."customer_group where IsActive = ? ";
 	$resQry = $db->get_rsltset_bind($StrQry,array(1));

	
	$strSelHtml =  "<select ".$Attr." class='form-control select2 ".$class."' id='".$SelName."' name='".$SelName."'  ".$prop."  > <option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getmutlipleselect_Customergroups($db, $SelName, $class,$selId=null,$Attr=null) {
	$StrQry="select customer_group_id AS Id,customer_group_name AS Name from ".TPLPrefix."customer_group where IsActive = '1' ";
	$resQry = $db->get_rsltset($StrQry);		
	//print_r($resQry); exit;
	 $chk_listarray = explode(",",$selId); 
	  
	$strSelHtml =  "<select  multiple='multiple' ".$Attr." class=' ".$class."' id='".$SelName."' name='".$SelName."[]' >";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) 
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	//print_r($strSelHtml); 
	return $strSelHtml;	
}

function getSelectBox_Customers($db, $SelName, $class,$selId=null,$Attr=null) {
    $chk_listarray = explode(",",$selId); 
	
	//$StrQry="select customer_id AS Id,customer_username AS Name from ".TPLPrefix."customers where IsActive = '1' ";
	$strQry = "select a.customer_id AS Id,concat(b.AttributeValue,' ','(',a.customer_email,')') AS Name from ".TPLPrefix."customers a 
					inner join ".TPLPrefix."cus_attribute_tbl1 b ON b.customer_id = a.customer_id
					inner join ".TPLPrefix."customfields_attributes c ON c.AttributeId = b.AttributeId
					where a.Isactive =1 and c.AttributeCode = 'custfirstname'
				 ";
	$resQry = $db->get_rsltset($strQry);		
	$strSelHtml =  "<select multiple='multiple' ".$Attr." class='form-control select2 ".$class."' name='".$SelName."[]' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}	
			
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


// for costomer list 

function getCustomerslist($db, $SelName, $class,$selId=null,$Attr=null,$customid=null,$prop=null) {
    $chk_listarray = explode(",",$selId); 
	
    $strQry="select customer_id AS Id,customer_firstname AS Name from ".TPLPrefix."customers where IsActive = ? and  customer_group_id = ? ";	 	
	$resQry = $db->get_rsltset_bind($strQry,array(1,$customid));
 

	$strSelHtml =  "<select multiple='multiple' ".$Attr." data-placeholder='select' class='form-control select2 ".$class."' id='".$SelName."' name='".$SelName."[]' ".$prop." >";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}	
			
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getSelectBox_Products($db, $SelName, $Attr,$selId=null,$catid=null,$prop=null) {
    
    $chk_listarray = explode(",",$selId); 
	
	if($catid!=''){
		$childcatlists= " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
		   SELECT @Ids := (
		   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
		   FROM ".TPLPrefix."category
		   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
		   ) Level
		   FROM ".TPLPrefix."category
		   JOIN (SELECT @Ids := ?) temp1
		   WHERE IsActive=1
		) temp2 " ;
		
		
		$childcatlist = $db->get_a_line_bind($childcatlists,array($catid));


		if(!empty($childcatlist['ids']))
		$childcatlist['ids'].=",".$catid;
			else
		$childcatlist['ids']=$catid;

		$conqry=" and  t3.categoryID in (".$childcatlist['ids'].") ";	
	}
	$StrQry = "select t1.product_id AS Id, t1.product_name AS Name, t1.sku from ".TPLPrefix."product t1 inner join  ".TPLPrefix."product_categoryid t2 on t1.product_id=t2.product_id and t2.IsActive=1 inner join ".TPLPrefix."category t3 on t2.categoryID=t3.categoryID and t3.IsActive= ? $conqry where t1.IsActive = ? group by t1.product_id"; 
	
	//$StrQry="select product_id AS Id, product_name AS Name from ".TPLPrefix."product where IsActive = '1'  ";
	
	//$resQry = $db->get_rsltset($StrQry);		
	$resQry = $db->get_rsltset_bind($StrQry,array(1,1));
	
	
	$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$Attr." productarray' name='".$SelName."[]' onchange='productdisplay(this.value);' ".$prop." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}	
			
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']." ".$val['sku']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

/*
function getSelectBox_categorysublist($db, $parent, $level,$productId,$categoryID) {	
	 $qrysubcat="SELECT a.categoryID, a.categoryName, Deriv1.Count FROM `".TPLPrefix."category` a  LEFT JOIN (SELECT parentId, COUNT(*) AS Count FROM `".TPLPrefix."category` GROUP BY parentId) Deriv1 ON a.categoryID = Deriv1.parentId WHERE IsActive = 1 and a.parentId=" . $parent;
	
	$result = $db->get_rsltset($qrysubcat);
	print_r(
	//echo "<pre>";print_r($result); exit;

	$strSelHtml =  "<div class='expander'></div><ul class='tree'>";	
    foreach ($result as $row ) {
        if ($row['Count'] > 0) {
           	$strSelHtml.= "<div class='expander'></div><li><input type='checkbox' name='categoryIDs[]' value='".$row['categoryID']."' ";			
			$strSelHtml.= (in_array($row['categoryID'],$categoryID))? " checked='checked' ":"";
			$strSelHtml.= " > " . $row['categoryName'];
			getSelectBox_categorysublist($db,$row['categoryID'], $level + 1,$productId,$categoryID);
			$strSelHtml.= "</li>";
			
        } elseif ($row['Count']==0) {
            $strSelHtml.= "<li><input type='checkbox' name='categoryIDs[]' value='".$row['categoryID']."' ";
			$strSelHtml.= (in_array($row['categoryID'],$categoryID))? " checked='checked' ":"";
			$strSelHtml.= " > " . $row['categoryName'];
			" >" . $row['categoryName'] . "</li>";
        } else;
		
    }
    echo $strSelHtml.= "</ul>";
} */


function getSelectBox_categorysublist($db,$productId,$categoryID) {
    
//echo "id:";	print_r($categoryID); 
//echo "<br>";
	 $qrysubcat="SELECT a.categoryID as id, a.categoryName as text ,a.parentId FROM ".TPLPrefix."category a  WHERE a.IsActive = 1 and a.parent_id = 0";
	
	$result = $db->get_rsltset($qrysubcat);	
	
	$category=array();
	$arrchild=array();
	 foreach ($result as $row ) 
    {
        $category['categories'][$row['id']] = $row; 
        $category['parent_cats'][$row['parentId']][] = $row['id']; 
    }
	$arrchild=getCategories('0', $category,$categoryID); 
	echo json_encode($arrchild);
}

function getCategories($parent, $category,$categoryID) 
{
    
    if (isset($category['parent_cats'][$parent]))
    {
       
        foreach ($category['parent_cats'][$parent] as $cat_id)
        {
			$ischecked=false;
            if (!isset($category['parent_cats'][$cat_id]))
            {
             	if(in_array($cat_id,$categoryID))
					$ischecked=true;
					
						$selectedarra = array("selected"=>$ischecked,"opened" => false);
			 $arrchild[]=array("id"=>$category['categories'][$cat_id]['id'],"text"=>$category['categories'][$cat_id]['text'],"state"=>$selectedarra);
            }
            if (isset($category['parent_cats'][$cat_id]))
            {
				if(in_array($cat_id,$categoryID))
					$ischecked=true;			
					$selectedarra = array("selected"=>$ischecked,"opened" => false);
			   $arrchild[]=array("id"=>$category['categories'][$cat_id]['id'],"text"=>$category['categories'][$cat_id]['text'],"state"=>$selectedarra,"children"=>getCategories($cat_id, $category,$categoryID));	
            }
        }
        
    }
	
	
    return $arrchild;
}






function getSelectBox_CustomFieds($db, $SelName, $Attr,$AttributeID,$selId=null) {		
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId='".$AttributeID."' order by SortBy asc  ";	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' name='".$SelName.$AttributeID."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getCheckBox_CustomFieds($db, $SelName, $Attr,$AttributeID,$selId=null) {
	
	$chk_listarray = explode(",",$selId); 
	
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId='".$AttributeID."' order by SortBy asc  ";	
	$resQry = $db->get_rsltset($StrQry);
	$strSelHtml = "";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {			
			$chek='';
			if (in_array($val['Id'], $chk_listarray)) {
				$chek = 'checked';
			}			
			
			$strSelHtml=$strSelHtml.'  <div class="n-chk">
                                  <label class="new-control new-checkbox checkbox-success">
                                   <input '.$sel.' class="new-control-input minimal '.$Attr.'" type="checkbox" name="'.$SelName.$AttributeID.'" value="'.$val['Id'].'" />
								   
								   
                                    <span class="new-control-indicator"></span>'.$val['Name'].' </label>
                                </div>
								
								 ';
		}
	}
	
	return $strSelHtml;	
}

function getRadioBox_CustomFieds($db, $SelName, $Attr,$AttributeID,$selId=null) {
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId='".$AttributeID."' order by SortBy asc  ";	
	$resQry = $db->get_rsltset($StrQry);
	$strSelHtml = "";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			$sel='';
			if($selId==$val['Id'])
				$sel=' checked ';
			
			$strSelHtml=$strSelHtml.' <div class="n-chk">
                                  <label class="new-control new-checkbox checkbox-success">
                                   <input '.$sel.' class="new-control-input inimal '.$Attr.'" type="radio" name="'.$SelName.$AttributeID.'" value="'.$val['Id'].'" />
								    
								   
								   
                                    <span class="new-control-indicator"></span>'.$val['Name'].' </label>
                                </div>
								
							 ';
		}
	}
	
	return $strSelHtml;	
}


function getMultiSelectBox_CustomFieds($db, $SelName, $Attr,$AttributeID,$selId=null) {	
    $chk_listarray = explode(",",$selId); 
	
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId='".$AttributeID."' order by SortBy asc  ";	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select multiple='multiple' class='".$Attr."' name='".$SelName.$AttributeID."[]' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}	
			
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getSelectBox_countrylist_To_cus_address($db, $Selbx_Name, $selId=null) {
	
	$StrQry="select countryid AS Id,countryname AS Name from ".TPLPrefix."country where IsActive=1 order by countryname asc";		
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2' id='".$Selbx_Name."' name='".$Selbx_Name."' onchange='getstate(this.value)' ><option value=''> Select Country </option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}	
	$strSelHtml=$strSelHtml."</select>";	
	return $strSelHtml;	
}


function getSelectBox_statelist_To_cus_address($db, $country, $selId=null) {
	
	$strSelHtml = "";
	
	if($country !=null){
		$StrQry="select stateid AS Id,statename AS Name from  ".TPLPrefix."state where 1=1 and countryid='".$country."' order by statename asc";
		if(!empty($resQry)) {
			foreach($resQry as $val) {
			$sel='';
				if($selId==$val['Id'])
					$sel=' selected="selected" ';
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}		
		}	
	}
	
	return $strSelHtml;
}

function getSelectBox_attrgrouplistRadio($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select attribute_groupID AS Id, attribute_groupName AS Name from ".TPLPrefix."attributegroup where IsActive = '1' and parent_id = 0 order by attribute_groupName asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {						
			$strSelHtml=$strSelHtml."
			 <div class='n-chk'>
                              <label class='new-control new-checkbox checkbox-success'>
                                <input type='radio' required class='new-control-input' name='attribute_groupID' id='attribute_groupID'  value=".$val['Id'].">
                                <span class='new-control-indicator'></span>".$val['Name']." </label>
                            </div> ";
		}		
	}
	
	return $strSelHtml;	
}


//front menu update select box - START

function getSelectBox_CMSpage_formenu($db, $SelName, $selId=null) {
	$StrQry="select cms_pageid AS Id, cms_pagename AS Name from ".TPLPrefix."cms_pages where IsActive = '1' order by cms_pagename asc";
	$resQry = $db->get_rsltset($StrQry);	

	$strSelHtml =  "<select class='form-control select2' name='".$SelName."'><option value=''>Select</option>";	
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			$sel='';
				if($selId==$val['Id'])
					$sel=' selected="selected" ';
				
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}
	$strSelHtml=$strSelHtml."</select>";	
	
	return $strSelHtml;	
}

function getSelectBox_CMSblock_formenu($db, $SelName, $selId=null) {
	$StrQry="select cms_blockid AS Id, cms_blockname AS Name from ".TPLPrefix."cms_block where IsActive = '1' order by cms_blockname asc";
	$resQry = $db->get_rsltset($StrQry);	

	$strSelHtml =  "<select class='form-control select2' name='".$SelName."'><option value=''>Select</option>";	
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			$sel='';
				if($selId==$val['Id'])
					$sel=' selected="selected" ';
				
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}
	$strSelHtml=$strSelHtml."</select>";	
	
	return $strSelHtml;	
}





function getSelectBox_categorylist_frontmenu($db, $SelName, $selId=null) {
	
	 $StrQry="SELECT categoryID AS Id,categoryName AS Name FROM `".TPLPrefix."category` WHERE 1=1 and IsActive =1 and parentId=0 ";
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			
		   $subquery =" SELECT categoryID AS Id,categoryName AS Name FROM `".TPLPrefix."category` WHERE 1=1 and IsActive =1 and parentId='".$val['Id']."' ";
		   $rslt_subquery = $db->get_rsltset($subquery);
		   $sub_cnt = count($rslt_subquery);
		  
		   if($sub_cnt >0){
			   
				$sel='';
				if($selId==$val['Id'])
					$sel=' selected="selected" ';
				
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>"; 

		   
			   foreach($rslt_subquery as $rslt_subquery_S){
				   $sel='';
					if($selId==$rslt_subquery_S['Id'])
						$sel=' selected="selected" ';
					$strSelHtml=$strSelHtml."<option value=".$rslt_subquery_S['Id']." ".$sel.">------".$rslt_subquery_S['Name']."</option>"; 
			   }			      
		   }
		   else{
			  $sel='';
				if($selId==$val['Id'])
					$sel=' selected="selected" ';
				
				$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>"; 
		   }	   
		  			
		}
		
	}	
		
	 $strSelHtml=$strSelHtml."</select>";

	return $strSelHtml;	
} 

//front menu update select box - end


//order status select box - START
function getSelectBox_orderstatus($db, $SelName, $jrequired,$Attr,$selId=null) {
    
	$StrQry="select order_statusId AS Id,order_statusName AS Name from ".TPLPrefix."order_status where IsActive = '1' ";
 	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$jrequired."' id='".$SelName."' name='".$SelName."'  ".$Attr." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}
//order status select box - END


//payment gateway excluded country list select box - START
function getMultiSelectBox_Excludecountries($db, $SelName, $jrequired,$selId=null) {	
    $chk_listarray = explode(",",$selId); 
	
	$StrQry="select countryid AS Id, countryname AS Name from ".TPLPrefix."country where IsActive = '1' order by countryname asc ";	
	$resQry = $db->get_rsltset($StrQry);	
	
	$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$jrequired."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}
//payment gateway excluded country list select box - END


//payment gateway excluded category list select box - START
function getMultiSelectBox_Excludecategories($db, $SelName, $jrequired,$selId=null) {	
    $chk_listarray = explode(",",$selId); 
	
	$StrQry="select categoryID AS Id, categoryName AS Name from ".TPLPrefix."category where IsActive = '1' order by categoryName asc ";	
	$resQry = $db->get_rsltset($StrQry);	
	
	$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$jrequired."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}
//payment gateway excluded category list select box - END



//Dateformate function 


function getSelectBox_dateformate($db, $SelName, $jrequired,$Attr,$selId=null) {
	if($StrQry ==''){		
		$StrQry="select dfid AS Id,dateformat AS Name from ".TPLPrefix."dateformat where isactive = '1' order by dfid asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$jrequired."' id='".$SelName."' name='".$SelName."'  ".$Attr." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getSelectBox_parentList($db, $SelName, $edit_id,$selId=null,$type=null,$otherAttr=null) {
	$sel='';
	$val = 0;
	if($selId!=''){
		
		$sel='selected';
	}
	if($StrQry ==''){		
		 $StrQry="select manufacturerId AS Id,manufacturerName AS Name from ".TPLPrefix."manufacturer where parentId ='0'  and IsActive ='1' order by manufacturerName asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select ".$otherAttr." class='form-control select2' required='' id='".$SelName."' name='".$SelName."' ><option value='0'>Parent Brands</option>";
	
	//$strSelHtml =  "<select ".$otherAttr." class='form-control select2 jsrequired'  id='".$SelName."' name='".$SelName."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
	
	
}


function getSelectBox_mastermodule($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select MasterId AS Id,displayname AS Name from ".TPLPrefix."mastertables where IsActive = '1' ";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." >";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
		
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_masterdepend($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select MasterId AS Id,displayname AS Name from ".TPLPrefix."mastertables where IsActive = '1' ";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
		
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}




function getSelectBox_Attributetype($db, $SelName, $Attr,$selId=null,$prop=null) {
	
   	$str_all="select attribute_typename AS Id,attribute_typename AS Name from ".TPLPrefix."attributes_type where IsActive = ? order by atttypeid asc";
		//echo $str_all; exit;
		$resQry=$db->get_rsltset_bind($str_all,array(1));
	 
    //print_r($resQry); exit;
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option></option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".ucfirst($val['Name'])."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_Attribute_datatype($db, $SelName, $Attr,$selId=null,$prop=null) {
	
     $resQry = array("text","number");
    //print_r($resQry); exit;
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option></option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val)
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val." ".$sel.">".ucfirst($val)."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_ManufacturerList($db, $SelName, $Attr,$selId=null) {
	//echo "id: ". $selId;
	if($StrQry ==''){		
		$StrQry="select manufacturerId AS Id,manufacturerName AS Name from  ".TPLPrefix."manufacturer where IsActive = '1' order by manufacturerId asc";
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ><option value=''>Select Manugacture</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
		  // echo  "selid: ".$selId." "."totid: ".$val['Id'];
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}


function getSelectBox_Bannerposition($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select bannaerposition AS Id,bannaername AS Name from ".TPLPrefix."bannerposition where IsActive = '1' order by bannaername asc";
		//echo $StrQry; 
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option></option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_theme($db, $SelName, $Attr,$selId=null,$prop=null) {
	if($StrQry ==''){		
		$StrQry="select themeid AS Id,themename AS Name from ".TPLPrefix."themesetup where IsActive = '1' order by themename asc";
		//echo $StrQry; 
	}	
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2 ".$Attr."' id='".$SelName."' name='".$SelName."' ".$prop." ><option></option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}


?>