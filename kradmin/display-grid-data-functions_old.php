<?php 

function checkIsactive($prefix,$value){
		$actives= '';$inactives= '';
		$activea = array("active", "Active");  
		if (in_array($value, $activea))
		{
			$actives = "or ".$prefix."IsActive =1";
		}
		
		$inactivea = array("inactive", "Inactive","inActive");  
		if (in_array($value, $inactivea))
		{
			$inactives = "or ".$prefix."IsActive =0";
		}
		    $statuscheck = $actives . $inactives;
	return $statuscheck;	
}
 
######## Menu Start ##########	
function getMenuArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".tbl_menus." where 1=1 and IsActive <>2 ";
	if($whrcon != "")
	$str_all .= $whrcon;	
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getMenuArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select *,@rownum := @rownum + 1 as row_number from ".tbl_menus." cross join (select @rownum := 0) r where 1=1 and IsActive <> 2 "; 		
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
	
		$res = $db->get_rsltset($str_all); 
		$totalData = count($rescntchk);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
	
		return $res; 			
}
//Menu List Display Grid - END

//Module List Display Grid - START

function getModuleArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select * from ".tbl_modules." where 1=1 and IsActive <>2 ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getModuleArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select *,@rownum := @rownum + 1 as row_number from ".tbl_modules." cross join (select @rownum := 0) r where 1=1 and IsActive <> 2 "; 
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
	
		$res = $db->get_rsltset($str_all); 
		$totalData = count($rescntchk);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
	
		return $res; 		
}
//Module List Display Grid - END


//ModuleMenu List Display Grid - START

function getModuleMenuArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
    $str_all="select * from ".tbl_menus." where IsActive = '1' ";
	if($whrcon != "")
	$str_all .= $whrcon;	

	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}


function getModuleMenuArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
        $str_all="select *,@rownum := @rownum + 1 as row_number from ".tbl_menus." cross join (select @rownum := 0) r where IsActive = '1' ";
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
	
		$res = $db->get_rsltset($str_all); 
		$totalData = count($rescntchk);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
	
		return $res; 		
}
//ModuleMenu List Display Grid - END


//Permission Info List Display Grid - START

function getPermissionInfoArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{
 	 
	$str_all="select * from ".tbl_roles." r where  r.IsActive <>2 and r.RoleId <> 1".$constr; 	
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}


function getPermissionInfoArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{		
		$str_all="select *,@rownum := @rownum + 1 as row_number from ".tbl_roles." r cross join (select @rownum := 0) r where  r.IsActive <> 2 and r.RoleId <> 1 ".$constr; 		
		if($whrcon != "")
		$str_all .= $whrcon;	

		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
	
		$res = $db->get_rsltset($str_all); 
		return $res; 		
}
//Permission Info List Display Grid - END

//Role List Display Grid - START
function getRoleArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	 $str_all="select r.* from ".tbl_roles." r  where  r.IsActive <> 2 and r.RoleId <> 1 ";	
	 
	 if($whrcon != "")
		$str_all .= $whrcon;	
		$res = $db->get_rsltset($str_all);
		return $totalData = count($res);
}

function getRoleArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select r.*,@rownum := @rownum + 1 as row_number from ".tbl_roles." r  cross join (select @rownum := 0) r where  r.IsActive <> 2 and r.RoleId <> 1 ";
	
		if($whrcon != "")
		$str_all .= $whrcon;	

		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
//	echo $str_all; die();
		$res = $db->get_rsltset($str_all); 
		return $res; 			
}
//Role List Display Grid - END

//User List Display Grid - START
function getUserArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select u.*,r.RoleName from ".tbl_users." u LEFT JOIN  ".tbl_roles." r on u.RoleId = r.RoleId   
		 
		where  u.IsActive <> 2 and u.user_ID <> 1 and u.user_ID <> ". $_SESSION["UserId"]."  and u.RoleId <> 1  ".$constr; 		

	if($whrcon != "")
		$str_all .= $whrcon;		
 	
	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getUserArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select u.*,r.RoleName,@rownum := @rownum + 1 as row_number from ".tbl_users." u LEFT JOIN  ".tbl_roles." r on u.RoleId = r.RoleId  cross join (select @rownum := 0) r 		 
		where  u.IsActive <> 2 and u.user_ID <> 1 and u.user_ID <> ". $_SESSION["UserId"]."  and u.RoleId <> 1  ".$constr; 		
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
 
		$res = $db->get_rsltset($str_all); 
	
		return $res; 			
}
//User List Display Grid - END 



//Region List Display Grid - START
function getRegionArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	
	
		$str_all="select * from ".TPLPrefix."region where IsActive <> ? ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return $totalData = count($res);
	
	
}

function getRegionArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	
	 $db->get_a_line("SET @rownum:=0");
	$str_all="select *,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."region where IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	
	 // echo $str_all; exit;
	$res=$db->get_rsltset_bind($str_all,array(2));
   //echo "<pre>"; print_r($res); exit;
	//$res = $db->get_rsltset($str_all); 
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res; 		
	
}
//Region List Display Grid - END


//Country List Display Grid - START

function getCountryArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select * from ".TPLPrefix."country where IsActive <> ? ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return $totalData = count($res);
}

function getCountryArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
    //select * from gps_country where 1=1 and IsActive <> 2 and (CountryName like '%%' ) order by CountryName asc limit 0,10
    $db->get_a_line("SET @rownum:=0");
	$str_all="select *,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."country where IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	
	 // echo $str_all; exit;
	$res=$db->get_rsltset_bind($str_all,array(2));
   //echo "<pre>"; print_r($res); exit;
	//$res = $db->get_rsltset($str_all); 
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res; 		
}
//Country List Display Grid - END

//State List Display Grid - START

function getStateArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select s.*, c.countryname from ".TPLPrefix."state s INNER JOIN ".TPLPrefix."country c ON s.countryid = c.countryid AND c.IsActive = 1 where s.IsActive <> ? "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	$res=$db->get_rsltset_bind($str_all,array(2));
	//$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getStateArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$db->get_a_line("SET @rownum:=0"); 
	
	$str_all="select s.*, c.countryname,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."state s INNER JOIN ".TPLPrefix."country c ON s.countryid = c.countryid AND c.IsActive = 1 where 1=1 and s.IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       

	$res=$db->get_rsltset_bind($str_all,array(2));
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res; 		
}
//State List Display Grid - END

//City List Display Grid - START

function getCityArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select ci.*, s.statename, c.countryname from ".TPLPrefix."city ci INNER JOIN  ".TPLPrefix."state s ON ci.stateid = s.stateid and s.IsActive = 1 INNER JOIN ".TPLPrefix."country c ON s.countryid = c.countryid AND c.IsActive = 1 where ci.IsActive <> 2 "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getCityArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	$db->get_a_line("SET @rownum:=0"); 
	$str_all="select ci.*, s.statename, c.countryname, c.countryname,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."city ci INNER JOIN  ".TPLPrefix."state s ON ci.stateid = s.stateid and s.IsActive = 1 INNER JOIN ".TPLPrefix."country c ON s.countryid = c.countryid AND c.IsActive = 1 where  ci.IsActive <> 2 "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       

	$res=$db->get_rsltset($str_all);
	//print_r($res);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res; 		
}
//City List Display Grid - END

//PostCode List Display Grid - START

function getPinCodeArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select pc.*,a.cityname from ".TPLPrefix."pincode pc INNER JOIN  ".TPLPrefix."city a ON pc.cityid = a.cityid and a.IsActive = 1  where  pc.IsActive <> ? ";  
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return $totalData = count($res);
}

function getPinCodeArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	$db->get_a_line("SET @rownum:=0"); 
	$str_all="select pc.*,a.cityname,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."pincode pc INNER JOIN  ".TPLPrefix."city a ON pc.cityid = a.cityid and a.IsActive = 1  where  pc.IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	   
	    
 	$res=$db->get_rsltset_bind($str_all,array(2));
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res; 		
}
//PostCode List Display Grid - END


//Currency List Display Grid - START

function getCurrencyArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select * from ".TPLPrefix."currency  where IsActive <> ? "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return $totalData = count($res);
}

function getCurrencyArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
$db->get_a_line("SET @rownum:=0");
    $str_all="select *,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."currency  where IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       

	$res=$db->get_rsltset_bind($str_all,array(2));
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res; 		
}
//Currency List Display Grid - END


//Taxmaster List Display Grid - START

function getTaxmasterArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."taxmaster  where IsActive <> ? and parent_id = ? "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_a_line_bind($str_all,array(2,0));
	return  $totalData = $res['cnt']; exit;
}

function getTaxmasterArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
$db->get_a_line("SET @rownum:=0");

    $str_all="select *,case when taxTyp='P' then 'Percentage' else 'Fixed Amount' end as taxtype,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."taxmaster  where IsActive <> ? and parent_id = ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       

	$res=$db->get_rsltset_bind($str_all,array(2,0));
	return $res; 		
}
//Taxmaster List Display Grid - END
 

//Area List Display Grid - START

function getAreaArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select a.*  from ".TPLPrefix."area a inner join ".TPLPrefix."city c on a.cityid=c.cityid and c.IsActive=1 where a.IsActive <> ? "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return  $totalData = count($res); 
}

function getAreaArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
    $str_all="select a.*,c.cityname from ".TPLPrefix."area a inner join ".TPLPrefix."city c on a.cityid=c.cityid and c.IsActive=1 where a.IsActive <> ? ";
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       

	$res=$db->get_rsltset_bind($str_all,array(2));
	//print_r($res); exit;
	return $res; 		
}
//Area List Display Grid - END
 

//Customer List Display Grid - START

function getCustomerArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select * from ".TPLPrefix."customers  where IsActive <> ? "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return  $totalData = count($res); 
}

function getCustomerArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
    $str_all="select *,customer_firstname as fname,customer_email as email,mobileno as mobile from ".TPLPrefix."customers  where IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       
    //echo $str_all; exit;
	$res=$db->get_rsltset_bind($str_all,array(2));
	//print_r($res); exit;
	return $res; 		
}
//Customer List Display Grid - END
 

//Banners List Display Grid - START

function getBannersArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select * from ".TPLPrefix."banners  where IsActive <> ? "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return  $totalData = count($res); 
}

function getBannersArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
$db->get_a_line("SET @rownum:=0");

 	
    $str_all="select *,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."banners  where IsActive <> ? "; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       

	$res=$db->get_rsltset_bind($str_all,array(2));
	//print_r($res); exit;
	return $res; 		
}
//Banners List Display Grid - END

///configuration grid from here
function getConfigureArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{
	//$str_all="select * FROM ".TPLPrefix."configuration WHERE IsActive != '2' "; 
	$str_all="SELECT count(distinct cnfg.storeId) as cnt FROM ".TPLPrefix."configuration cnfg 
WHERE cnfg.IsActive <>2 AND cnfg.uniCode = 'store_name' GROUP BY cnfg.storeId";
 //echo $str_all;
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getConfigureArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		//$str_all="select * FROM ".TPLPrefix."configuration WHERE IsActive != '2' ";	
		$str_all="SELECT distinct cnfg.configureId,cnfg.storeId, cnfg.key, cnfg.value as storeName,cnfg.IsActive FROM ".TPLPrefix."configuration cnfg 
WHERE cnfg.IsActive <>2 AND cnfg.uniCode = 'store_name' GROUP BY cnfg.storeId ";		
	//echo $str_all; exit;
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		$res = $db->get_rsltset($str_all); 		
	
		return $res; 			
}

//E-Com Masters Start

//Mail Template List Display Grid - START

function getMailTemplateArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select mt.* from ".TPLPrefix."mailtemplate mt
	inner join ".TPLPrefix."mailtemplate_master mmt on mt.masterid=mmt.masterid and mmt.IsActive=1
	where mt.IsActive <> ? and mt.parent_id = 0 "; 
	if($whrcon != "")
		$str_all .= $whrcon;
	
	$res=$db->get_rsltset_bind($str_all,array(2));
	return  $totalData = count($res); 
}

function getMailTemplateArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$db->get_a_line("SET @rownum:=0");
     $str_all="select mt.*,mmt.templatename,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."mailtemplate mt
	inner join ".TPLPrefix."mailtemplate_master mmt on mt.masterid=mmt.masterid and mmt.IsActive=1
	where mt.IsActive <> ? and mt.parent_id = 0"; 
	if($whrcon != "")
	$str_all .= $whrcon;	

	$totalFiltered =  $totalData; 
	
	if(trim($ordr) != "")
	$str_all .= $ordr;
	
	if($stt != "")
	$str_all .= "limit ".$stt.",".$len;	       
//echo $str_all; exit;
	$res=$db->get_rsltset_bind($str_all,array(2));
	//print_r($db); exit;
	return $res; 		
}
//Mail Template List Display Grid - END


//attribute List Display Grid - START
function getAttributesArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."m_attributes where IsActive <> ? and parent_id = 0"; 
		if($whrcon != "")
		$str_all .= $whrcon;	
		$res=$db->get_a_line_bind($str_all,array(2));
		//echo $db->last_query; exit;
		return $totalData = $res['cnt'];
}

function getAttributesArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
$db->get_a_line("SET @rownum:=0");
		$str_all="select *,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."m_attributes where IsActive <> ? and parent_id = 0";
	    
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
		$res=$db->get_rsltset_bind($str_all,array(2));		
		
		
	
		return $res; 			
}
//Attributes List Display Grid - END

//attribute groups Display Grid - START
function getAttrGroupArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
			$str_all="select count(*) as cnt from  ".TPLPrefix."attributegroup where IsActive !=? and IsDisplay=? and parent_id = 0"; 	
			
			if($whrcon != "")
				$str_all .= $whrcon;		
	
			$res = $db->get_a_line_bind($str_all,array(2,1));		
		
	
		return $totalData = $res['cnt'];
}

function getAttrGroupArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$db->get_a_line("SET @rownum:=0");
		$str_all="select *,@rownum:=(@rownum+1) AS row_number from ".TPLPrefix."attributegroup where IsActive !=? and IsDisplay=? and parent_id = 0"; 			
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		//$res = $db->get_rsltset($str_all); 			
	    $res=$db->get_rsltset_bind($str_all,array(2,1));
		return $res; 			
}
//attribute groups Display Grid - END


///category array grid from here
function getOrderstatusArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select count(*) as cnt from ".TPLPrefix."order_status where IsActive !=? and parent_id = 0 "; 
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line_bind($str_all,array(2));
	return $totalData = $res['cnt'];
}

function getOrderstatusArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$db->get_a_line("SET @rownum:=0");
		$str_all="select order_statusId, order_statusName,IsActive, order_statusDescription, sortingOrder,@rownum:=(@rownum+1) AS row_number FROM ".TPLPrefix."order_status WHERE IsActive != ? and parent_id = 0 ";			
	
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		$res = $db->get_rsltset_bind($str_all,array(2)); 		
	
		return $res; 			
}
//category array grid till here

///featurestories array grid from here
function getfeaturestoriesArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select count(*) as cnt from ".TPLPrefix."feature_stories where IsActive !=? and parent_id = 0 "; 
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line_bind($str_all,array(2));
	return $totalData = $res['cnt'];
}

function getfeaturestoriesArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$db->get_a_line("SET @rownum:=0");
		$str_all="select FsId, StoryTitle,IsActive, StoryDescription,StoryDate,StoryURL, sortingOrder,@rownum:=(@rownum+1) AS row_number FROM ".TPLPrefix."feature_stories WHERE IsActive != ? and parent_id = 0 ";			
	
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		$res = $db->get_rsltset_bind($str_all,array(2)); 		
	
		return $res; 			
}
//featurestories array grid till here

///news array grid from here
function getnewsArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select count(*) as cnt from ".TPLPrefix."news where IsActive !=? and parent_id = 0 "; 
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line_bind($str_all,array(2));
	return $totalData = $res['cnt'];
}

function getnewsArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$db->get_a_line("SET @rownum:=0");
		$str_all="select *,@rownum:=(@rownum+1) AS row_number FROM ".TPLPrefix."news WHERE IsActive != ? and parent_id = 0 ";			
	
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		$res = $db->get_rsltset_bind($str_all,array(2)); 		
	
		return $res; 			
}
//news array grid till here

///events array grid from here
function geteventsArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select count(*) as cnt from ".TPLPrefix."events where IsActive !=? and parent_id = 0 "; 
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line_bind($str_all,array(2));
	return $totalData = $res['cnt'];
}

function geteventsArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$db->get_a_line("SET @rownum:=0");
		$str_all="select *,@rownum:=(@rownum+1) AS row_number FROM ".TPLPrefix."events WHERE IsActive != ? and parent_id = 0 ";			
	
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		$res = $db->get_rsltset_bind($str_all,array(2)); 		
	
		return $res; 			
}
//events array grid till here

//attribute mapping List Display Grid - START
function getAttrMapArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select count(distinct map.attribute_groupId) as cnt  from ".TPLPrefix."attributes map inner join ".TPLPrefix."attributegroup gp on gp.attribute_groupID = map.attribute_groupID
inner join ".TPLPrefix."m_attributes sub on sub.attributeId = map.attributeId where gp.IsActive <> 2 and map.IsActive <> 2 and sub.IsActive <> 2  "; 
		if($whrcon != "")
		$str_all .= $whrcon;	
		$res = $db->get_a_line($str_all);
		
		return $totalData = $res['cnt'];
}

function getAttrMapArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
 		$str_all="select map.attribute_groupId, map.attributeId, gp.attribute_groupName, gp.IsActive  from ".TPLPrefix."attributes map inner join ".TPLPrefix."attributegroup gp on gp.attribute_groupID = map.attribute_groupID
inner join ".TPLPrefix."m_attributes sub on sub.attributeId = map.attributeId where gp.IsActive <> 2 and map.IsActive <> 2 and sub.IsActive <> 2 ";
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
	//	echo $str_all;
		$res = $db->get_rsltset($str_all); 			
		
		
	
		return $res; 			
}
//Attributes Mapping List Display Grid - END


///category array grid from here
function getCategoryArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	$str_all="select count(*) as cnt FROM ".TPLPrefix."category sbc LEFT JOIN ".TPLPrefix."category mnc ON sbc.parentId = mnc.categoryID WHERE sbc.IsActive != ? and sbc.parent_id = 0"; 
	//echo $str_all; exit;
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line_bind($str_all,array(2));
	return $totalData = $res['cnt'];
}

function getCategoryArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		//$str_all="select * from ".TPLPrefix."category where IsActive <> 2 ";
		$str_all="select sbc.categoryID, sbc.categoryName, case when sbc.parentId = 0 then 'Parent' else mnc.CategoryName end AS ParentCat, sbc.IsActive, sbc.parentId, sbc.categoryDesc, sbc.IsActive,sbc.hsncode
FROM ".TPLPrefix."category sbc LEFT JOIN ".TPLPrefix."category mnc ON sbc.parentId = mnc.categoryID WHERE sbc.IsActive != '2' and sbc.parent_id = 0";
			
	
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		//echo $str_all; exit;		
		$res = $db->get_rsltset($str_all); 		
	    
		return $res; 			
}
//category array grid till here

//Product List Display Grid - START
function getProductapprovalArray_tot($db, $act=null,$whrcons=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all = " SELECT 
				  count(distinct t1.product_id) as cnt
				  FROM  ".TPLPrefix."product t1
			      left join ".TPLPrefix."attributegroup t2 on t2.attribute_groupID = t1.attributeMapId inner join ".TPLPrefix."product_categoryid t3 on t3.product_id = t1.product_id and t3.IsActive=1 inner join ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID and t4.IsActive=1"; 		
	
	$whrcon = " where 1 = 1 and t1.IsActive <>2 ";
	if($_REQUEST[1]['value'] != "" ){
		$whrcon .= "  and t1.sku like '".$_REQUEST[1]['value']."%' ";
	}
	if($_REQUEST[2]['value'] != "" ){
		$whrcon .= " and t1.product_name like '".$_REQUEST[2]['value']."%' ";
	}
	if($_REQUEST[2]['value'] != "" ){
		$whrcon .= " and t1.product_name like '".$_REQUEST[2]['value']."%' ";
	}
	if($_REQUEST[3]['value'] != "" ){			
			$whrcon .= " and (SELECT group_concat(distinct categoryName) from ".TPLPrefix."product_categoryid t3 
					INNER JOIN ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID
					where t3.product_id = t1.product_id 
				  ) like '%".$_REQUEST[3]['value']."%' ";
		}
	/*if($_REQUEST[4]['value'] != "" ){
		$whrcon .= " and t2.attribute_groupName like '".$_REQUEST[4]['value']."%' ";
	}*/
	  if($_REQUEST[4]['value'] != "" ){
			$whrcon .= " and t1.price >= '".$_REQUEST[4]['value']."' ";
		}
		if($_REQUEST[5]['value'] != "" ){
			$whrcon .= " and t1.price <= '".$_REQUEST[5]['value']."' ";
		}
		if($_REQUEST[6]['value'] != "" ){
			$whrcon .= " and t1.minquantity >= '".$_REQUEST[6]['value']."' ";
		}
		if($_REQUEST[7]['value'] != "" ){
			$whrcon .= " and t1.minquantity <= '".$_REQUEST[7]['value']."' ";
		}
		
	/*	if($_REQUEST[8]['value'] != "" ){
			$date = explode("-",$_REQUEST[8]['value']);
			$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[9]['value'] != ""  ){	
			$date = explode("-",$_REQUEST[9]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		} */
		
		if($_REQUEST[8]['value'] != "" && $_REQUEST[8]['value'] != -1 ){			
			$whrcon .= " and t1.IsActive = '".$_REQUEST[8]['value']."' ";
		}
	
	if($whrcons != "")
		$str_all .= $whrcons;	
	
	$str_all .= "  ";
	
	//echo $str_all; die();
	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getProductapprovalArray_Ajx($db, $act=null,$whrcons=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="SELECT 
				  t1.*,t2.attribute_groupName as groupname,
				 t4.categoryName,group_concat(DISTINCT img.img_path
        ORDER BY img.product_img_id asc , img.ordering asc  SEPARATOR '|') as img_names,img.img_path  FROM  ".TPLPrefix."product t1
				 left join ".TPLPrefix."product_images img on img.product_id=t1.product_id and img.IsActive=1 
			      left join ".TPLPrefix."attributegroup t2 on t2.attribute_groupID = t1.attributeMapId inner join ".TPLPrefix."product_categoryid t3 on t3.product_id = t1.product_id and t3.IsActive=1 inner join ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID and t4.IsActive=1"; 	
         		  
		$rescntchk =  $db->get_rsltset($str_all); 
		
		$whrcon = " where 1 = 1  and t1.IsActive <>2 ";
		
		
		if($_REQUEST[1]['value'] != "" ){
			$whrcon .= "  and t1.sku like '".$_REQUEST[1]['value']."%' ";
		}
		if($_REQUEST[2]['value'] != "" ){
			$whrcon .= " and t1.product_name like '".$_REQUEST[2]['value']."%' ";
		}
		if($_REQUEST[3]['value'] != "" ){

		if($_REQUEST[3]['value'] != "" ){

			$getCatsIds=$db->get_a_line("select categoryID from ".TPLPrefix."category where IsActive=1 and  categoryName like '".$_REQUEST[3]['value']."' limit 0,1");
			$whrcon .= "  and t3.categoryID = '".$getCatsIds['categoryID']."'  ";
			
				
			/*$whrcon .= " and (SELECT group_concat(distinct categoryName) from ".TPLPrefix."product_categoryid t3 
					INNER JOIN ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID
					where t3.product_id = t1.product_id 
				  ) like '%".$_REQUEST[3]['value']."%' "; */
		}
		}
	/*	if($_REQUEST[4]['value'] != "" ){
			$whrcon .= " and t2.attribute_groupName like '".$_REQUEST[4]['value']."%' ";
		} */
		if($_REQUEST[4]['value'] != "" ){
			$whrcon .= " and t1.price >= '".$_REQUEST[4]['value']."' ";
		}
		if($_REQUEST[5]['value'] != "" ){
			$whrcon .= " and t1.price <= '".$_REQUEST[5]['value']."' ";
		}
		if($_REQUEST[6]['value'] != "" ){
			$whrcon .= " and t1.minquantity >= '".$_REQUEST[6]['value']."' ";
		}
		if($_REQUEST[7]['value'] != "" ){
			$whrcon .= " and t1.minquantity <= '".$_REQUEST[7]['value']."' ";
		}
		
		/*if($_REQUEST[8]['value'] != "" ){
			$date = explode("-",$_REQUEST[8]['value']);
			$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[9]['value'] != ""  ){	
			$date = explode("-",$_REQUEST[9]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}*/
		
		if($_REQUEST[8]['value'] != "" && $_REQUEST[8]['value'] != -1 ){			
			$whrcon .= " and t1.IsActive = '".$_REQUEST[8]['value']."' ";
		}
		
		//echo $whrcon;
		if($whrcons != "")
		$str_all .= $whrcons;	
	
	 	$str_all .= " group by t1.product_id ";
		
	
		
		if(trim($ordr) != "")
	    	$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	
		
	//	echo $str_all;
			
		$res = $db->get_rsltset($str_all); 
		 
	
		return $res; 			
}
//Product List Display Grid - END

 
//Flat Air Shipping Methods List Display Grid - START
function getFlatAirShippingArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and shippingCode = 'flatair'"; 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
		
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getFLatAirShiipingArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

 		$str_all="select shp.*,flt.flatshippingId, flt.shippingTitle, flt.shippingCost, flt.customer_group_id, flt.IsActive  from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and shippingCode = 'flatair'";
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
	//	echo $str_all;
		$res = $db->get_rsltset($str_all); 			
	
	
		return $res; 			
}
//Flat Air Shipping Methods List Display Grid - END

//Shipping Methods List Display Grid - START
function getShippingArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."shippingmethods where IsActive <> 2 "; 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
		
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getShiipingArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select * from ".TPLPrefix."shippingmethods where IsActive <> 2 ";
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
		$res = $db->get_rsltset($str_all); 			
		
	
		return $res; 			
}
//Shipping Methods List Display Grid - END



//Coupon List Display Grid - START
function getCouponArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
			//$str_all="select CouponID,CouponTitle,CouponCode,CouponCatType,CouponTotal,NoofCouponUsed,CouponEndDate,IsActive from ".TPLPrefix."coupons c  where c.IsActive <> 2 "; 	
			
			//$str_all = "select count(*) as cnt from ".TPLPrefix."coupons c  where c.IsActive <> 2 ";
			
			$str_all = "select  count(*) as cnt from ".TPLPrefix."coupons c inner join  ".TPLPrefix."couponapplied ca on c.CouponCatType=ca.cpnappid and ca.IsActive<>2 where c.IsActive <> 2 and c.parent_id=0";
			if($whrcon != "")
				$str_all .= $whrcon;	
			
			
	
			$res = $db->get_a_line($str_all);
			
		
	
		return $totalData = $res['cnt'];
}

function getCouponArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		//$str_all="select CouponID,CouponTitle,CouponCode,CouponCatType,CouponTotal,NoofCouponUsed,CouponEndDate,IsActive from ".TPLPrefix."coupons c where c.IsActive <> 2 "; 		
	//$str_all = "select CouponID,CouponTitle,CouponCode,CouponTotal,NoofCouponUsed,date_format(CouponEndDate,'%d-%m-%Y') as CouponEndDate,IsActive, case when couponcattype = 1 then 'Product' when  couponcattype = 2 then 'Category' when  couponcattype = 3 then 'Order Value' when  couponcattype = 4 then 'Customer' end as CouponCatType from ".TPLPrefix."coupons c  where c.IsActive <> 2 ";
	
	 $str_all = "select c.*,ca.cpnappname,date_format(CouponEndDate,'%d-%m-%Y') as CouponEndDate,ifnull(o.cnt,0) as cnt  from ".TPLPrefix."coupons c inner join  ".TPLPrefix."couponapplied ca on c.CouponCatType=ca.cpnappid and ca.IsActive<>2 
	left join ( select couponcode,count(couponcode) as cnt from ".TPLPrefix."orders where IsActive=1 group by couponcode )
			o on o.couponcode=c.CouponCode  
	where c.IsActive <> 2 and c.parent_id=0";
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
		$res = $db->get_rsltset($str_all); 			
	
		return $res; 			
}
//Coupon List Display Grid - END

//Discount List Display Grid - START
function getDiscountArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
 			//$str_all = "select count(*) as cnt from ".TPLPrefix."discount c  where c.IsActive <> 2 ";
			$str_all = "select count(*) as cnt from ".TPLPrefix."discount d  inner join ".TPLPrefix."discountapplied da on d.DiscountCatType=da.disappid and da.IsActive<>2   where d.IsActive <> 2 and d.parent_id=0";
			if($whrcon != "")
				$str_all .= $whrcon;	
			
			
	
			$res = $db->get_a_line($str_all);
			
		
	
		return $totalData = $res['cnt'];
}

function getDiscountArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		//$str_all="select CouponID,CouponTitle,CouponCode,CouponCatType,CouponTotal,NoofCouponUsed,CouponEndDate,IsActive from ".TPLPrefix."coupons c where c.IsActive <> 2 "; 		
	//$str_all = "select DiscountID,DiscountTitle,DiscountTotal,DiscountEndDate,IsActive,DiscountAmount,case when DiscountType =1 then 'Percentage' end as DiscountType, case when DiscountCatType = 1 then 'Product' when  DiscountCatType = 2 then 'Category' when  DiscountCatType = 3 then 'Order Value' when  DiscountCatType = 4 then 'Customer' when  DiscountCatType = 5 then 'Discountslap' end as DiscountCatType from ".TPLPrefix."discount c  where c.IsActive <> 2";
	
	$str_all = "select d.*,da.disappname,DATE_FORMAT(DiscountEndDate,'%d-%m-%Y') as DiscountEndDate, case when DiscountType='1' then 'Percentage' end as discounttype  from ".TPLPrefix."discount d  inner join ".TPLPrefix."discountapplied da on d.DiscountCatType=da.disappid and da.IsActive<>2   where d.IsActive <> 2 and d.parent_id=0";
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$totalFiltered =  $totalData; 
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
		$res = $db->get_rsltset($str_all); 			
	
		return $res; 			
}
//Discount List Display Grid - END

//Flat Shipping Methods List Display Grid - START
function getFreeShippingArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and shippingCode = 'free' "; 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
		
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getFreeShiipingArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select shp.*,flt.flatshippingId,  flt.shippingTitle,  flt.orderMinimum, flt.customer_group_id, flt.IsActive from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and shippingCode = 'free'";
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
		$res = $db->get_rsltset($str_all); 			
		
		
	
		return $res; 			
}
//Shipping Methods List Display Grid - END



//Homepage Slider List Display Grid - START
function gethomepagesliderArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."homepageslider t1 left join ".TPLPrefix."category t2 on  t1.categoryid=t2.categoryID and t2.IsActive <> 2 where t1.IsActive <> 2 ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function gethomepagesliderArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select t1.*,case when t1.categoryid <> 0 then t2.categoryName else 'All Category' end as categoryName from ".TPLPrefix."homepageslider t1 left join ".TPLPrefix."category t2 on  t1.categoryid=t2.categoryID and t2.IsActive <> 2 where t1.IsActive <> 2 "; 		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;		
		
		
		if(trim($ordr) != "")
		//echo $str_all .= $ordr; exit;
	   $str_all .= " order by t1.sortby asc "; 
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
	    
		$res = $db->get_rsltset($str_all); 
	
		return $res; 			
}
//Homepage Slider List Display Grid - END



//Homepage Slider List Display Grid - START
function gethomepageslidercatArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."homepagecatslider t1 left join ".TPLPrefix."category t2 on  t1.categoryid=t2.categoryID and t2.IsActive <> 2 where t1.IsActive <> 2 ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function gethomepageslidercatArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select t1.*,case when t1.categoryid <> 0 then t2.categoryName else 'All Category' end as categoryName from ".TPLPrefix."homepagecatslider t1 left join ".TPLPrefix."category t2 on  t1.categoryid=t2.categoryID and t2.IsActive <> 2 where t1.IsActive <> 2 "; 		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;		
		
		
		if(trim($ordr) != "")
		//echo $str_all .= $ordr; exit;
	   $str_all .= " order by t1.sortby asc "; 
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
	    
		$res = $db->get_rsltset($str_all); 
	
		return $res; 			
}
//Homepage Slider List Display Grid - END


//Custom Fields List Display Grid - START
function getCustomfieldsArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."customfields_attributes t1
inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1
where 1=1 and t1.IsActive <>2 "; 	
	
	if($whrcon != "")
		$str_all .= $whrcon;	
				
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getCustomfields_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select t1.*,t2.elementname,t2.element_type from ".TPLPrefix."customfields_attributes t1
inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1
where 1=1 and t1.IsActive <>2 "; 		
		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
		
		   
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//Custom Fields List Display Grid - END



//Customer Groups List Display Grid - START
function getCustomerGroupsArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."customer_group where IsActive <>2  and  IsDisplay=1"; 	
	
	if($whrcon != "")
		$str_all .= $whrcon;	
				
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getCustomerGroups_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select * from ".TPLPrefix."customer_group where  IsActive <>2 and  IsDisplay=1"; 		
		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	
		
		   
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//Customer Groups List Display Grid - END


//Customer List Display Grid - START
function getCustomersArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$cusid=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."customers where 1=1 and IsActive <>2 and customer_group_id = '".$cusid."' "; 	
	
	if($whrcon != "")
		$str_all .= $whrcon;	
				
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getCustomers_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$cusid=null) 
{	    

		if($cusid==2)
		{
			$qryattrbute=" select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 
						inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1  
						inner join ".TPLPrefix."customfield_custgrp t3 on t3.CustomFieldId=t1.AttributeId and t3.IsActive=1 
						inner join  ".TPLPrefix."customer_group t4  on t4.customer_group_id=t3.CustomerGrupId and t4.IsActive=1 and t4.customer_group_id='".$cusid."'
						where 1=1 and t1.IsActive =1  group by t1.AttributeCode order by t1.SortBy asc ";
						$resattrbute=$db->get_rsltset($qryattrbute);
			
		$str_all="
		select customer_id,customer_group_id,customer_firstname,customer_lastname,customer_email,mobileno,gstdocument,businesscard,discount,IsActive ";
	foreach($resattrbute as $att){	
		$str_all.=" ,max(".$att['AttributeCode'].") as  ".$att['AttributeCode']." ";
	}	
	$str_all.=" from (select c.customer_id,c.customer_group_id,c.customer_firstname,c.customer_lastname,c.customer_email,c.mobileno,c.gstdocument,c.businesscard,c.discount,c.IsActive "; 
		foreach($resattrbute as $att){
		  $str_all.=" ,( 
		   case when t2.elementid in (3,4,6,7)  and val.AttributeOptionId is not null and ct2.AttributeId = '".$att['AttributeId']."'  then (val.AttributeValue)
         		 when t2.elementid in (1,2,5) and  ct1.AttributeId = '".$att['AttributeId']."' then  (ct1.AttributeValue)
				 else ''
			End
				) as ".$att['AttributeCode']."  ";
		}		
		$str_all.=" from ".TPLPrefix."customers c 
		inner join ".TPLPrefix."customer_group t4  on  t4.IsActive=1 and t4.customer_group_id=c.customer_group_id
		left  join ".TPLPrefix."customfield_custgrp t3 on  t4.customer_group_id=t3.CustomerGrupId  and t3.IsActive=1 
		left join ".TPLPrefix."customfields_attributes t1 on t3.CustomFieldId=t1.AttributeId and t1.IsActive=1
		left join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1 
		left  join ".TPLPrefix."cus_attribute_tbl1 ct1 on ct1.AttributeId = t1.AttributeId and c.customer_id = ct1.customer_id and ct1.IsActive=1
		left  join ".TPLPrefix."cus_attribute_tbl2 ct2 on ct2.AttributeId = t1.AttributeId and c.customer_id = ct2.customer_id and ct2.IsActive=1
		left join ".TPLPrefix."customfields_attrvalues val on val.AttributeId=ct2.AttributeId and val.AttributeOptionId=ct2.AttributeValue  and val.IsActive=1
		where c.IsActive <>2 and c.customer_group_id = '".$cusid."' ";
			
		}			
		else
		$str_all="select * from ( select * from ".TPLPrefix."customers where 1=1 and IsActive <>2 and customer_group_id = '".$cusid."' "; 	
        
		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		$str_all .=" )t group by customer_id ";
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	
		//echo $str_all; die();
		   
		$res = $db->get_rsltset($str_all); 
 
	
	
	
		return $res; 			
}
//Customer List Display Grid - END



//Flat Shipping Methods List Display Grid - START
function getFlatShippingArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and shippingCode = 'flat'"; 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
		
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getFLatShiipingArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select shp.*,flt.flatshippingId, flt.shippingTitle, flt.shippingCost, flt.customer_group_id, flt.IsActive from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and shippingCode = 'flat'";
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
		$res = $db->get_rsltset($str_all); 			
	
	
		return $res; 			
}
//Shipping Methods List Display Grid - END

function getManufactArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

	//$str_all="select count(*) as cnt from ".TPLPrefix."manufacturer where IsActive <> 2 "; 
		$str_all="select  count(*) as cnt
        FROM ".TPLPrefix."manufacturer smf LEFT JOIN ".TPLPrefix."manufacturer mmf ON smf.parentId = mmf.manufacturerId WHERE smf.IsActive != '2' ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	
	$res = $db->get_a_line($str_all);
	return $totalData =$res['cnt'];
}

function getManufactArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		//$str_all="select * from ".TPLPrefix."category where IsActive <> 2 ";
		//$str_all="select manufacturerId, manufacturerName,IsActive, description, manufactImage FROM ".TPLPrefix."manufacturer WHERE IsActive != '2' ";	
        
		$str_all="select  smf.manufacturerId, smf.manufacturerName, case when smf.parentId <> 0 then mmf.manufacturerName else 'Parent' end as ParentBrant, smf.description, smf.IsActive  
        FROM ".TPLPrefix."manufacturer smf LEFT JOIN ".TPLPrefix."manufacturer mmf ON smf.parentId = mmf.manufacturerId and mmf.IsActive != '2' WHERE smf.IsActive != '2' ";
      	//echo $str_all; exit;
	
		if($whrcon != "")
		$str_all .= $whrcon;		
	
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
	    //echo $str_all; exit;
		$res = $db->get_rsltset($str_all); 		
	
		return $res; 			
}

//attributevalue List Display Grid - START
function getAttributevalueArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$attid=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."m_attributes a  inner join ".TPLPrefix."dropdown d on a.attributeId=d.attributeId and d.isactive <> 2 where  a.attributeId ='".$attid."'  and a.IsActive <> 2 "; 
		if($whrcon != "")
		$str_all .= $whrcon;	
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getAttributevalueArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$attid=null) 
{	
		$str_all="select a.*,d.dropdown_values,d.dropdown_images,d.dropdown_unit,d.sortingOrder,d.dropdown_id,d.isactive as IsActive  from ".TPLPrefix."m_attributes a  inner join ".TPLPrefix."dropdown d on a.attributeId=d.attributeId and d.isactive <> 2 where  a.attributeId ='".$attid."'  and a.IsActive <> 2 ";
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		
		$res = $db->get_rsltset($str_all); 			
		//echo "<pre>";print_r($res); exit;
		
	
		return $res; 			
}
//attributevalue List Display Grid - END



//Subscribe List Display Grid - START
function getsubscribeArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."subscribe where 1=1 and IsActive <>2 ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getsubscribeArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select * from ".TPLPrefix."subscribe where 1=1 and IsActive <> 2 "; 		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;		
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
	
		$res = $db->get_rsltset($str_all); 
	
		return $res; 			
}
//Subscribe List Display Grid - END

//orders
function getOrdersArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
 
  $str_all = " SELECT t1.*,t2.order_statusName as order_status, 
				concat('<b>Order Ref. No :</b> ',t1.order_reference,'<br/><b>Name :</b>',t3.customer_firstname,' ',t3.customer_lastname,'<br/><b>Email :</b>',t3.customer_email,'<br/><b>Mobile Number :</b>',t3.mobileno,'<br/><b>Address :</b>',t1.shipping_address_1) as  orderDetails
				FROM  `".TPLPrefix."orders` t1 				
				inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id
				left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
				"; 								
		
		$whrcon = " where 1 = 1 and t1.payment_transaction_id!=''";


		if($_REQUEST['orders_name'] != "" && $_REQUEST['orders_name'] != "undefined"){
			$whrcon .= "  and t1.order_reference = '".$_REQUEST['orders_name']."' ";
		}
		if($_REQUEST['email'] != ""  && $_REQUEST['email'] != "undefined"){
			$whrcon .= "  and t3.customer_email = '".$_REQUEST['email']."' ";
		}
		if($_REQUEST['status'] != "-1"  && $_REQUEST['status'] != "undefined"){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST['status']."' ";
		}
		if($_REQUEST['dateFrom'] != ""  && $_REQUEST['dateFrom'] != "undefined"){
			$date = explode("/",$_REQUEST['dateFrom']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[0]."-".$date[1]."' ";
		}
		if($_REQUEST['dateTo'] != ""  && $_REQUEST['dateTo'] != "undefined" ){	
			$date = explode("/",$_REQUEST['dateTo']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[0]."-".$date[1]."' ";
		}

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;				
 
	
	$res = $db->get_rsltset($str_all); 
	return $totalData = count($res);
}

function getOrdersArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
            $str_all = " SELECT t1.*,t2.order_statusName as order_status, t2.classname,t4.order_statusName as orderstatus, t4.classname as payclassname,
				concat('<b>Order Ref. No :</b> ',t1.order_reference,'<br/><b>Name :</b>',t3.customer_firstname,' ',t3.customer_lastname,'<br/><b>Email :</b>',t3.customer_email,'<br/><b>Mobile Number :</b>',t3.mobileno,'<br/><b>Address :</b>',t1.shipping_address_1) as  orderDetails
				FROM  `".TPLPrefix."orders` t1 				
				inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id
				left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
				left join ".TPLPrefix."order_status t4 on t4.order_statusId = t1.payment_status
				"; 								
		
		$whrcon = " where 1 = 1 and t1.payment_transaction_id!='' ";


		if($_REQUEST['orders_name'] != "" && $_REQUEST['orders_name'] != "undefined"){
			$whrcon .= "  and t1.order_reference = '".$_REQUEST['orders_name']."' ";
		}
		if($_REQUEST['email'] != ""  && $_REQUEST['email'] != "undefined"){
			$whrcon .= "  and t3.customer_email = '".$_REQUEST['email']."' ";
		}
		if($_REQUEST['status'] != "-1"  && $_REQUEST['status'] != "undefined"){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST['status']."' ";
		}
		if($_REQUEST['dateFrom'] != ""  && $_REQUEST['dateFrom'] != "undefined"){
			$date = explode("-",$_REQUEST['dateFrom']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST['dateTo'] != ""  && $_REQUEST['dateTo'] != "undefined" ){	
			$date = explode("-",$_REQUEST['dateTo']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;	
		 
		//echo $str_all; exit;
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//orders

//Payments
function getPaymentsArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
 
  $str_all = " SELECT t1.*,t2.order_statusName as order_status, 
				concat('<b>Order Ref. No :</b> ',t1.order_reference,'<br/><b>Name :</b>',t3.customer_firstname,' ',t3.customer_lastname,'<br/><b>Email :</b>',t3.customer_email,'<br/><b>Mobile Number :</b>',t3.mobileno,'<br/><b>Address :</b>',t1.shipping_address_1) as  orderDetails
				FROM  `".TPLPrefix."orders` t1 				
				inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id
				left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
				"; 								
		
		$whrcon = " where 1 = 1 ";


		if($_REQUEST['orders_name'] != "" && $_REQUEST['orders_name'] != "undefined"){
			$whrcon .= "  and t1.order_reference = '".$_REQUEST['orders_name']."' ";
		}
		if($_REQUEST['email'] != ""  && $_REQUEST['email'] != "undefined"){
			$whrcon .= "  and t3.customer_email = '".$_REQUEST['email']."' ";
		}
		if($_REQUEST['status'] != "-1"  && $_REQUEST['status'] != "undefined"){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST['status']."' ";
		}
		if($_REQUEST['dateFrom'] != ""  && $_REQUEST['dateFrom'] != "undefined"){
			$date = explode("/",$_REQUEST['dateFrom']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[0]."-".$date[1]."' ";
		}
		if($_REQUEST['dateTo'] != ""  && $_REQUEST['dateTo'] != "undefined" ){	
			$date = explode("/",$_REQUEST['dateTo']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[0]."-".$date[1]."' ";
		}

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;				
 
	
	$res = $db->get_rsltset($str_all); 
	return $totalData = count($res);
}

function getPaymentsArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
            $str_all = " SELECT t1.*,t2.order_statusName as order_status, t2.classname,
				concat('<b>Order Ref. No :</b> ',t1.order_reference,'<br/><b>Name :</b>',t3.customer_firstname,' ',t3.customer_lastname,'<br/><b>Email :</b>',t3.customer_email,'<br/><b>Mobile Number :</b>',t3.mobileno,'<br/><b>Address :</b>',t1.shipping_address_1) as  orderDetails
				FROM  `".TPLPrefix."orders` t1 				
				inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id
				left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
				"; 								
		
		$whrcon = " where 1 = 1 ";


		if($_REQUEST['orders_name'] != "" && $_REQUEST['orders_name'] != "undefined"){
			$whrcon .= "  and t1.order_reference = '".$_REQUEST['orders_name']."' ";
		}
		if($_REQUEST['email'] != ""  && $_REQUEST['email'] != "undefined"){
			$whrcon .= "  and t3.customer_email = '".$_REQUEST['email']."' ";
		}
		if($_REQUEST['status'] != "-1"  && $_REQUEST['status'] != "undefined"){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST['status']."' ";
		}
		if($_REQUEST['dateFrom'] != ""  && $_REQUEST['dateFrom'] != "undefined"){
			$date = explode("-",$_REQUEST['dateFrom']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST['dateTo'] != ""  && $_REQUEST['dateTo'] != "undefined" ){	
			$date = explode("-",$_REQUEST['dateTo']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;	
		 
		
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//Payments


function getSuggestedProductapprovalArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all = "SELECT 
				 count(*) as cnt
				  FROM  `".TPLPrefix."product` t1
			      left join ".TPLPrefix."attributegroup t2 on t2.attribute_groupID = t1.attributeMapId
				  inner join ".TPLPrefix."product_categoryid t3 on t3.product_id = t1.product_id and t3.IsActive=1 inner join ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID and t4.IsActive=1
				  "; 
	
	$whrcon .= " AND t1.IsActive = 1 ";	
	if(isset($_REQUEST['editId']) && $_REQUEST['editId'] !=""){
		$whrcon .= " AND t1.product_id != '".$_REQUEST['editId']."' ";
	}
	
	$whrcon = " where 1 = 1  ";
	
	if($_REQUEST[0]['value'] != "" ){
		$whrcon .= "  and t1.product_name like '".$_REQUEST[0]['value']."%' ";
	}
	if($_REQUEST[1]['value'] != "" ){
		$whrcon .= "  and t1.sku like '".$_REQUEST[1]['value']."%' ";
	}	
	if($_REQUEST[2]['value'] != "" ){			
		$whrcon .= " and (SELECT group_concat(categoryName) from ".TPLPrefix."product_categoryid t3 
				INNER JOIN ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID
				where t3.product_id = t1.product_id 
			  ) like '%".$_REQUEST[3]['value']."%' ";
	}
	if($_REQUEST[3]['value'] != "" ){
		$whrcon .= " and t2.attribute_groupName like '".$_REQUEST[3]['value']."%' ";
	}
	if($_REQUEST[4]['value'] != "" ){
		$whrcon .= " and t1.price >= '".$_REQUEST[4]['value']."' ";
	}
	if($_REQUEST[5]['value'] != "" ){
		$whrcon .= " and t1.price <= '".$_REQUEST[5]['value']."' ";
	}
	if($_REQUEST[6]['value'] != "" ){
		$whrcon .= " and t1.quantity >= '".$_REQUEST[6]['value']."' ";
	}
	if($_REQUEST[7]['value'] != "" ){
		$whrcon .= " and t1.quantity <= '".$_REQUEST[7]['value']."' ";
	}
	if($_REQUEST[8]['value'] != "" && $_REQUEST[8]['value'] != -1 ){			
		$whrcon .= " and t1.IsActive = '".$_REQUEST[8]['value']."' ";
	}
	if($_REQUEST[9]['value'] != "" ){
		$date = explode("/",$_REQUEST[9]['value']);
		$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') >= '".$date[2]."-".$date[0]."-".$date[1]."' ";
	}
	if($_REQUEST[10]['value'] != "" && $_REQUEST[11]['value'] ){	
		$date = explode("/",$_REQUEST[11]['value']);		
		$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') <= '".$date[2]."-".$date[0]."-".$date[1]."' ";
	}
		
	if($whrcon != "")
		$str_all .= $whrcon;
	
	//echo $str_all;
	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getSuggestedProductapprovalArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all = "SELECT 
				  t1.*,t2.attribute_groupName as groupname
				  FROM  `".TPLPrefix."product` t1
			      left join ".TPLPrefix."attributegroup t2 on t2.attribute_groupID = t1.attributeMapId
				  inner join ".TPLPrefix."product_categoryid t3 on t3.product_id = t1.product_id and t3.IsActive=1 inner join ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID and t4.IsActive=1"; 				
		
		$whrcon .= " where t1.IsActive = 1 ";	

		if(isset($_REQUEST['editId']) && $_REQUEST['editId'] !=""){
			$whrcon .= " AND t1.product_id != '".$_REQUEST['editId']."' ";
		}
		
		
		if($_REQUEST[0]['value'] != "" ){
			$whrcon .= "  and t1.product_name like '".$_REQUEST[0]['value']."%' ";
		}
		if($_REQUEST[1]['value'] != "" ){
			$whrcon .= "  and t1.sku like '".$_REQUEST[1]['value']."%' ";
		}	
		if($_REQUEST[2]['value'] != "" ){			
			$whrcon .= " and (SELECT group_concat(categoryName) from ".TPLPrefix."product_categoryid t3 
					INNER JOIN ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID
					where t3.product_id = t1.product_id 
				  ) like '%".$_REQUEST[2]['value']."%' ";
		}
		if($_REQUEST[3]['value'] != "" ){
			$whrcon .= " and t2.attribute_groupName like '".$_REQUEST[3]['value']."%' ";
		}
		if($_REQUEST[4]['value'] != "" ){
			$whrcon .= " and t1.price >= '".$_REQUEST[4]['value']."' ";
		}
		if($_REQUEST[5]['value'] != "" ){
			$whrcon .= " and t1.price <= '".$_REQUEST[5]['value']."' ";
		}
		if($_REQUEST[6]['value'] != "" ){
			$whrcon .= " and t1.quantity >= '".$_REQUEST[6]['value']."' ";
		}
		if($_REQUEST[7]['value'] != "" ){
			$whrcon .= " and t1.quantity <= '".$_REQUEST[7]['value']."' ";
		}
		if($_REQUEST[8]['value'] != "" && $_REQUEST[8]['value'] != -1 ){			
			//$whrcon .= " and t1.IsActive = '".$_REQUEST[8]['value']."' ";
		}
		/*if($_REQUEST[9]['value'] != "" ){
			$date = explode("/",$_REQUEST[9]['value']);
			$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') >= '".$date[2]."-".$date[0]."-".$date[1]."' ";
		}
		if($_REQUEST[10]['value'] != "" && $_REQUEST[11]['value'] ){	
			$date = explode("/",$_REQUEST[11]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.created_date,'%Y-%m-%d') <= '".$date[2]."-".$date[0]."-".$date[1]."' ";
		}*/
		 //echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	
			// echo $str_all;
				
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}



//Contactus List Display Grid - START
function getcontactusArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."contactform where IsActive <> 2 ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getcontactusArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select * from ".TPLPrefix."contactform where IsActive <> 2 "; 	
  
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;		
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
	
		$res = $db->get_rsltset($str_all); 
	
		return $res; 			
}
//Contactus List Display Grid - END

//fbmanagement Display - START
function getfbmanagementdisplayArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$tablename=null) 
{	
		$str_all="select count(*) as cnt from ".TPLPrefix."fb_".$tablename."  where IsActive <> 2 "; 
		if($whrcon != "")
		$str_all .= $whrcon;
        //print_r($str_all); exit;	
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getfbmanagementdisplayArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$tablename=null) 
{	

    $str_all="select t2.*,t3.elementid,t3.elementname,t3.element_type from ".TPLPrefix."formbuilder t1 inner join ".TPLPrefix."fb_attributes t2 on t1.FormId=t2.FormId and t2.IsActive=1 inner join ".TPLPrefix."m_elements t3 on t3.elementid=t2.AttributeType and t3.IsActive=1 where t1.fromtablename='".$tablename."' group by t2.AttributeCode order by sortBy asc ";
		 
		$res_eds = $db->get_rsltset($str_all);
		//echo "<pre>"; print_r($res_eds['AttributeName']); exit;
		$displyfields = array();
		$cond='';
		$tabind=1;
		foreach($res_eds as $data){
			if($data['element_type'] == 1){			
			 
				//text && textarea			 
				if($data['elementid'] == 1 || $data['elementid'] == 2){
					
					$displyfields[]= "t1.".$data['AttributeName'];
				}
				
				//file
				if($data['elementid'] == 8){
					
					$displyfields[]= "t1.".$data['AttributeName'];
				}
				
				//master
				if($data['elementid'] == 9){
					
					$get_editval = $db->get_a_line("select t2.* from ".TPLPrefix."fb_attributes t1 inner join ".TPLPrefix."mastertables t2 on t1.masterid=t2.MasterId and t1.IsActive=1 where t1.IsActive = 1 and t1.AttributeId ='".$data['AttributeId']."'  ");
					//echo "<pre>"; print_r($get_editval); 
					$cond .= " inner join ".TPLPrefix.$get_editval['tablesname']." as tab".$tabind." on t1.".$data['AttributeName']." = tab".$tabind.".".$get_editval['ValueCoumn']." and  tab".$tabind.".IsActive=1 ";
					$displyfields[]= "tab".$tabind.".".$get_editval['ColumnName'];
					$tabind++;
				}
			} 
			
		}
	
		$arrayfields = implode(',',$displyfields);
		
     
		$str_all="select ".$arrayfields." from ".TPLPrefix."fb_".$tablename." t1 ".$cond." where t1.IsActive <> 2 ";
		
		//echo $str_all; exit;
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		//echo "<pre>";print_r($str_all); exit;
		$res = $db->get_rsltset($str_all); 			
		//echo "<pre>";print_r($res); exit;
		
	
		return $res; 			
}
//fbmanagement Display - END


//RPT Formbuilder List Display Grid - START
function getrptformbuilderArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$formid=null) 
{	
		//$str_all="select a.*,d.dropdown_values,d.dropdown_images,d.dropdown_unit,d.sortingOrder,d.dropdown_id,d.isactive as IsActive  from ".TPLPrefix."m_attributes a  inner join ".TPLPrefix."dropdown d on a.attributeId=d.attributeId and d.isactive <> 2 where  a.attributeId ='".$attid."'  and a.IsActive <> 2 ";
		
		$str_alls="select  t1.* from ".TPLPrefix."formbuilder t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 ";
		$rescntchk =  $db->get_a_line($str_alls); 
		//print_r($rescntchk); 
		$tblname = $rescntchk['fromtablename'];
		//echo $tblname; exit;
		
		$str_alls="select  t1.AttributeCode ,t1.AttributeType from ".TPLPrefix."fb_attributes t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 order by SortBy ";
		$rescntchk =  $db->get_rsltset($str_alls);
		$leftjoin=array();	
		$joinind=2;	
	     foreach($rescntchk as $value){
			
			 
			if(in_array($value['AttributeType'],array('3','4','6','7'))) 
			{
				if(in_array($value['AttributeType'],array('3','6')))
					 $fldname[] =" t".$joinind.".AttributeValue as ".$value['AttributeCode'];
				else
					$fldname[] =" group_concat(t".$joinind.".AttributeValue,',') as ".$value['AttributeCode'];
				
				$leftjoin[]=" left join ".TPLPrefix."formbuilderdgsn_attrvalues t".$joinind." on t1.".$value['AttributeCode']."=t".$joinind.".AttributeOptionId and t".$joinind.".IsActive=1 ";
			}
			else			
			{
				 $fldname[] = $value['AttributeCode']; 
			}
			$joinind++;
		 }
		 
		//$fldname = $rescntchk['AttributeCode'];
		//print_r($fldname); exit;
		//$arraydata = explode(',',$fldname);
		$strdata = implode(',',$fldname);
		//echo $strdata; exit;
		
	     $str_all="select count(*) as cnt from ".TPLPrefix."fb_".$tblname." t1 ";
		$str_all .= implode(" ",$leftjoin);			
		$str_all .=" where t1.IsActive <> 2 group by t1.id ";
		 //echo $str_all; exit;
		$rescntchk =  $db->get_rsltset($str_all);
		
		if($whrcon != "")
		$str_all .= $whrcon;	
		$res = $db->get_a_line($str_all);
		return $totalData = $res['cnt'];
}

function getrptformbuilderArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null,$formid=null) 
{	
		//$str_all="select a.*,d.dropdown_values,d.dropdown_images,d.dropdown_unit,d.sortingOrder,d.dropdown_id,d.isactive as IsActive  from ".TPLPrefix."m_attributes a  inner join ".TPLPrefix."dropdown d on a.attributeId=d.attributeId and d.isactive <> 2 where  a.attributeId ='".$attid."'  and a.IsActive <> 2 ";
		
		$str_alls="select  t1.* from ".TPLPrefix."formbuilder t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 ";
		$rescntchk =  $db->get_a_line($str_alls); 
		//print_r($rescntchk); 
		$tblname = $rescntchk['fromtablename'];
		//echo $tblname; exit;
		
		$str_alls="select  t1.AttributeCode ,t1.AttributeType from ".TPLPrefix."fb_attributes t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 order by SortBy ";
		$rescntchk =  $db->get_rsltset($str_alls);
		$leftjoin=array();	
		$joinind=2;	
	     foreach($rescntchk as $value){
			
			 
			if(in_array($value['AttributeType'],array('3','4','6','7'))) 
			{
				if(in_array($value['AttributeType'],array('3','6')))
					 $fldname[] =" t".$joinind.".AttributeValue as ".$value['AttributeCode'];
				else
					$fldname[] =" group_concat(t".$joinind.".AttributeValue,',') as ".$value['AttributeCode'];
				
				$leftjoin[]=" left join ".TPLPrefix."formbuilderdgsn_attrvalues t".$joinind." on t1.".$value['AttributeCode']."=t".$joinind.".AttributeOptionId and t".$joinind.".IsActive=1 ";
			}
			else			
			{
				 $fldname[] = $value['AttributeCode']; 
			}
			$joinind++;
		 }
		 
		//$fldname = $rescntchk['AttributeCode'];
		//print_r($fldname); exit;
		//$arraydata = explode(',',$fldname);
		$strdata = implode(',',$fldname);
		//echo $strdata; exit;
		
	     $str_all="select t1.id,".$strdata." from ".TPLPrefix."fb_".$tblname." t1 ";
		$str_all .= implode(" ",$leftjoin);			
		$str_all .=" where t1.IsActive <> 2 ";
		 //echo $str_all; exit;
		$rescntchk =  $db->get_rsltset($str_all); 
		
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		$str_all .= "group by t1.id";
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
		//print_r($str_all); exit;
		$res = $db->get_rsltset($str_all); 			
		//echo "<pre>";print_r($res); exit;
		
	
		return $res; 			
}
//RPT Formbuilder List Display Grid - END



//Feedback Videos List Display Grid - START
function getVideosArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="SELECT count(*) as cnt FROM ".TPLPrefix."videos fv  where fv.IsActive <> 2 "; 
	
	if($whrcon != "")
		$str_all .= $whrcon;	   
				
	$res = $db->get_a_line($str_all); 
	return $res['cnt']; 					
}

function getVideosArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{			
	$str_all="SELECT fv.* FROM ".TPLPrefix."videos fv  where fv.IsActive <> 2 "; 
	
	if($whrcon != "")
		$str_all .= $whrcon;	
		
	if(trim($ordr) != "")
		$str_all .= $ordr;
		
	if($stt != "")
		$str_all .= "limit ".$stt.",".$len;	       
				
	$res = $db->get_rsltset($str_all); 
	return $res; 			
}
//Feedback Videos List Display Grid - END


//Manage Client List Display Grid - START
function getManageclientArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."manageclient where 1=1 and IsActive <>2 ";
	if($whrcon != "")
		$str_all .= $whrcon;	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getManageclientArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select * from ".TPLPrefix."manageclient where 1=1 and IsActive <> 2 "; 		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;		
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
	
		$res = $db->get_rsltset($str_all); 
	
		return $res; 			
}
//Manage Client List Display Grid - END
// Sales Report
function getSaleReportsArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all = " SELECT format(sum(coupon_discount) * t1.currency_conversion, 2,'en_IN')
          AS coupon_discounts,
       format(sum(cart_total) * t1.currency_conversion, 2,'en_IN')
          AS cart_products,
       format(sum(shippint_cost) * t1.currency_conversion, 2,'en_IN')
          AS total_shipping,
       format(sum(t1.grand_total), 2)
          AS total,
       format(sum(t1.grand_total) * t1.currency_conversion,2,'en_IN')
          AS totalconverted,
		  t2.order_statusName as order_status,cur.currencysymbol, cur.curpriceusd, cur.IsActive, cur.UserId, cur.CreatedDate,case when  cnfg.key = 'defaultcurrency' and cur.currencyid = cnfg.value then concat(currencyTitle, ' (Default)') else currencyTitle end as currencyTitle, cnfg.key ";
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "1" )
		{
			$str_all .= " ,DATE_FORMAT(t1.date_added,'%Y-%m-%d') as fstday, DATE_FORMAT(t1.date_added,'%Y-%m-%d') as lstday   ";
		}
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "2" )
		{
			$str_all .= " ,DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 1 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as fstday ,
			DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 7 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "3" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "4" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
        
			$str_all .= " FROM  `".TPLPrefix."orders` t1	left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."currency cur on cur.currencyid = t1.order_currency_id left join ".TPLPrefix."configuration cnfg on cnfg.key = 'defaultcurrency' and cnfg.value = cur.currencyid and cur.IsActive =1 "; 						
		
			$whrcon = " where 1 = 1  ";

		
		if($_REQUEST[1]['value'] != "" ){
			$date = explode("-",$_REQUEST[1]['value']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[2]['value'] != "" ){	
			$date = explode("-",$_REQUEST[2]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
	/*	if(($_REQUEST[0]['value'] == "") && ($_REQUEST[1]['value'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("/",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[0]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[0]."-".$lastdat."' ";
		}
		*/
		if($_REQUEST[3]['value'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST[3]['value']."' ";
		}
		
		/*if($_REQUEST[4]['value'] != "" ){
			$whrcon .= "  and t1.order_currency_id = '".$_REQUEST[4]['value']."' ";
		} */
         

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
	
		$gpby = '';
		
		if($_REQUEST[0]['value'] != "" ){			
					
			if($_REQUEST[0]['value'] == "1" )
			$gpby = "  group by day(t1.date_added) ";
			
			if($_REQUEST[0]['value'] == "2" )
			$gpby = "  group by week(t1.date_added) ";
			
			if($_REQUEST[0]['value'] == "3" )
			$gpby = "  group by month(t1.date_added) ";
			
			if($_REQUEST[0]['value'] == "4" )
			$gpby = "  group by year(t1.date_added) ";
		}
		
		//if($_REQUEST[4]['value'] != "" )
			//$gpby .= "  ,t1.order_currency_id ";
		//else
		//$gpby .= "  ,t1.order_currency_id ";
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;		
			
		// echo $str_all;	exit;	

		$res = $db->get_rsltset($str_all); 
		return count($res);
}

function getSaleReportsArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	

     // echo "<pre>"; print_r($_REQUEST); exit;
		$str_all = " SELECT format(sum(coupon_discount) * t1.currency_conversion, 2,'en_IN')
          AS coupon_discounts,
       format(sum(cart_total) * t1.currency_conversion, 2,'en_IN')
          AS cart_products,
       format(sum(shippint_cost) * t1.currency_conversion, 2,'en_IN')
          AS total_shipping,
       format(sum(t1.grand_total), 2)
          AS total,
       format(sum(t1.grand_total) * t1.currency_conversion,2,'en_IN')
          AS totalconverted,
		  t2.order_statusName as order_status,cur.currencysymbol, cur.curpriceusd, cur.IsActive, cur.UserId, cur.CreatedDate,case when  cnfg.key = 'defaultcurrency' and cur.currencyid = cnfg.value then concat(currencyTitle, ' (Default)') else currencyTitle end as currencyTitle, cnfg.key ";
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "1" )
		{
			$str_all .= " ,DATE_FORMAT(t1.date_added,'%Y-%m-%d') as fstday, DATE_FORMAT(t1.date_added,'%Y-%m-%d') as lstday   ";
		}
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "2" )
		{
			$str_all .= " ,DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 1 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as fstday ,
			DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 7 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "3" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "4" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
        
			$str_all .= " FROM  `".TPLPrefix."orders` t1	left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."currency cur on cur.currencyid = t1.order_currency_id left join ".TPLPrefix."configuration cnfg on cnfg.key = 'defaultcurrency' and cnfg.value = cur.currencyid and cur.IsActive =1 "; 						
		
			$whrcon = " where 1 = 1  ";

		
		if($_REQUEST[1]['value'] != "" ){
			$date = explode("-",$_REQUEST[1]['value']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[2]['value'] != "" ){	
			$date = explode("-",$_REQUEST[2]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
	/*	if(($_REQUEST[0]['value'] == "") && ($_REQUEST[1]['value'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("/",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[0]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[0]."-".$lastdat."' ";
		}
		*/
		if($_REQUEST[3]['value'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST[3]['value']."' ";
		}
		
		/*if($_REQUEST[4]['value'] != "" ){
			$whrcon .= "  and t1.order_currency_id = '".$_REQUEST[4]['value']."' ";
		} */
         

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
	
		$gpby = '';
		
		if($_REQUEST[0]['value'] != "" ){			
					
			if($_REQUEST[0]['value'] == "1" )
			$gpby = "  group by day(t1.date_added) ";
			
			if($_REQUEST[0]['value'] == "2" )
			$gpby = "  group by week(t1.date_added) ";
			
			if($_REQUEST[0]['value'] == "3" )
			$gpby = "  group by month(t1.date_added) ";
			
			if($_REQUEST[0]['value'] == "4" )
			$gpby = "  group by year(t1.date_added) ";
		}
		
		//if($_REQUEST[4]['value'] != "" )
			//$gpby .= "  ,t1.order_currency_id ";
		//else
		//$gpby .= "  ,t1.order_currency_id ";
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;		
			
		// echo $str_all;	exit;	

		$res = $db->get_rsltset($str_all); 
	//	print_r($res); 
		//$res[0]['chk'] = $str_all;
		
		
	
		return $res; 			
}
//sales report
//ordered Products - START
function getOrdrProductsReportArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	
	$str_all = " select count(*) as cnt from ( SELECT count(op.product_id)* op.product_qty as productcount, op.product_name,op.order_id, op.product_id, op.product_sku, op.product_qty, op.product_price,
	 (count(op.product_id)*op.product_qty)*op.product_price as total_price, attr.Attribute_id, attr.Attribute_code, attr.Attribute_Name, attr.Attribute_price, t2.order_statusName as order_status ";	
	
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "1" )
		{
			$str_all .= " ,DATE_FORMAT(t1.date_added,'%Y-%m-%d') as fstday, DATE_FORMAT(t1.date_added,'%Y-%m-%d') as lstday   ";
		}
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "2" )
		{
			$str_all .= " ,DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 1 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as fstday ,
			DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 7 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "3" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "4" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}

			$str_all .= " FROM  `".TPLPrefix."orders` t1 
inner join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
inner join ".TPLPrefix."orders_products op on op.order_id = t1.order_id
left join ".TPLPrefix."orders_products_attribute attr on attr.order_product_id = op.order_product_id "; 						
		
			$whrcon = " where 1 = 1  ";

		
		if($_REQUEST[1]['value'] != "" ){
			$date = explode("-",$_REQUEST[1]['value']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[2]['value'] != "" && $_REQUEST[1]['value'] ){	
			$date = explode("-",$_REQUEST[2]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
		if(($_REQUEST[1]['value'] == "") && ($_REQUEST[2]['value'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("-",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$lastdat."' ";
		}
		
		if($_REQUEST[3]['value'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST[3]['value']."' ";
		}
		
		


		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		$gpby = '';
		
		if($_REQUEST[0]['value'] != "" ){			
					
			if($_REQUEST[0]['value'] == "1" )
			$gpby = "  group by day(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "2" )
			$gpby = "  group by week(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "3" )
			$gpby = "  group by month(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "4" )
			$gpby = "  group by year(t1.date_added),op.product_id ";
		}
		else
		$gpby = " group by op.product_id";
		
	
		if(trim($gpby) != "")
			$str_all .= $gpby;
				
		$str_all .=" ) tab ";
		
		
		
		$res = $db->get_a_line($str_all); 
			
		return $totalData = $res['cnt'];	
	
	
}

function getOrdrProductsReportArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all = "SELECT count(op.product_id)* op.product_qty as productcount, op.product_name,op.order_id, op.product_id, op.product_sku, op.product_qty, format(op.product_price,2) as productprice, format((count(op.product_id)*op.product_qty)*op.product_price,2) as total_price, attr.Attribute_id, attr.Attribute_code, attr.Attribute_Name, attr.Attribute_price, t2.order_statusName as order_status ";	
	
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "1" )
		{
			$str_all .= " ,DATE_FORMAT(t1.date_added,'%Y-%m-%d') as fstday, DATE_FORMAT(t1.date_added,'%Y-%m-%d') as lstday   ";
		}
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "2" )
		{
			$str_all .= " ,DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 1 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as fstday ,
			DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 7 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "3" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "4" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}

			$str_all .= " FROM  `".TPLPrefix."orders` t1 
inner join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
inner join ".TPLPrefix."orders_products op on op.order_id = t1.order_id
left join ".TPLPrefix."orders_products_attribute attr on attr.order_product_id = op.order_product_id "; 						
		
			$whrcon = " where 1 = 1  ";

		
		if($_REQUEST[1]['value'] != "" ){
			$date = explode("-",$_REQUEST[1]['value']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[2]['value'] != "" && $_REQUEST[1]['value'] ){	
			$date = explode("-",$_REQUEST[2]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
		if(($_REQUEST[1]['value'] == "") && ($_REQUEST[2]['value'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("-",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$lastdat."' ";
		}
		
		if($_REQUEST[3]['value'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST[3]['value']."' ";
		}
		
		


		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		$gpby = '';
		
		if($_REQUEST[0]['value'] != "" ){			
					
			if($_REQUEST[0]['value'] == "1" )
			$gpby = "  group by day(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "2" )
			$gpby = "  group by week(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "3" )
			$gpby = "  group by month(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "4" )
			$gpby = "  group by year(t1.date_added),op.product_id ";
		}
		else
		$gpby = " group by op.product_id";
		
		//if($_REQUEST[4]['value'] != "" )
		//	$gpby .= "  ,t1.order_currency_id ";
		//else
		//$gpby .= "  ,t1.order_currency_id ";
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;		
				
		//echo $str_all;
		
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//User List Display Grid - END



function getLowStockReportArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
			$str_all = "select pdt.product_name,t1.product_id,t1.subqty as quantity, t1.subprice as price, t1.subsku as sku,case when pdt.IsActive = 1 then 'Active' else 'Inactive' end as status from (SELECT product_id,quantity as subqty, price as subprice, sku as subsku  FROM `".TPLPrefix."product` prd 
union select base_productId, quantity as subqty, price as subprice, sku as subsku from ".TPLPrefix."product_attr_combi
 attr ) t1 inner join ".TPLPrefix."product pdt on pdt.product_id = t1.product_id where t1.subqty < (select value from ".TPLPrefix."configuration where unicode = 'minimumStock' and
 IsActive = 1) ";	
		
		//	$whrcon = " where 1 = 1  ";
		//print_r($_REQUEST);
		
		if($_REQUEST[0]['value'] != "" ){	
			$whrcon .= "  and pdt.product_name like '".$_REQUEST[0]['value']."%' "; 
		}
		
		if($_REQUEST[1]['value'] != "" ){
			$whrcon .= "  and pdt.IsActive = '".$_REQUEST[1]['value']."' ";
		}
		else
			$whrcon .= " and pdt.IsActive in(0,1) ";

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		$gpby = ' order by product_id ';
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		//if(trim($ordr) != "")
		//	$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;		
				
		//echo $str_all;
		
		$res = $db->get_rsltset($str_all); 
		return count($res);
}

function getLowStockReportArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all = "select pdt.product_name,t1.product_id,t1.subqty as quantity, t1.subprice as price, t1.subsku as sku,case when pdt.IsActive = 1 then 'Active' else 'Inactive' end as status from (SELECT product_id,quantity as subqty, price as subprice, sku as subsku  FROM `".TPLPrefix."product` prd 
union select base_productId, quantity as subqty, price as subprice, sku as subsku from ".TPLPrefix."product_attr_combi
 attr ) t1 inner join ".TPLPrefix."product pdt on pdt.product_id = t1.product_id where t1.subqty < (select value from ".TPLPrefix."configuration where unicode = 'minimumStock' and
 IsActive = 1) ";	
		
		//	$whrcon = " where 1 = 1  ";
		//print_r($_REQUEST);
		
		if($_REQUEST[0]['value'] != "" ){	
			$whrcon .= "  and pdt.product_name like '".$_REQUEST[0]['value']."%' "; 
		}
		
		if($_REQUEST[1]['value'] != "" ){
			$whrcon .= "  and pdt.IsActive = '".$_REQUEST[1]['value']."' ";
		}
		else
			$whrcon .= " and pdt.IsActive in(0,1) ";

		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		$gpby = ' order by product_id ';
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		//if(trim($ordr) != "")
		//	$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;		
				
		//echo $str_all;
		
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}



function getCustomerOrdersReportArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all = " select count(*) as cnt from ( SELECT count( DISTINCT ordpdt.product_id ) AS products, count( DISTINCT t1.order_id ) AS orders, count( ordpdt.product_id ) * ordpdt.product_qty AS pdqty, sum( t1.total_products ) AS totpdt, sum( t1.total ) AS total, t1.order_id, t1.order_reference, t1.invoice_no, t1.customer_id, t1.customer_group_id, t1.firstname, t1.email,  t1.total_products,case when t3.IsActive = 1 then 'Active' when t3.IsActive = 0 then 'Inactive' else 'Deleted' end as status , t1.currency_conversion,format(sum(t1.total)*t1.currency_conversion,2) as totalconverted, t2.order_statusName AS order_status, t3.customer_email AS orderDetails, (

SELECT AttributeValue FROM ".TPLPrefix."cus_attribute_tbl1 a1 INNER JOIN ".TPLPrefix."customfields_attributes a2 ON a1.AttributeId = a2.AttributeId
WHERE a1.customer_id = t1.customer_id AND a2.AttributeCode = 'Customer Name' ) AS Customer_Name, cur.currencysymbol, cur.curpriceusd, cur.IsActive, cur.UserId, cur.CreatedDate,case when  cnfg.key = 'defaultcurrency' and cur.currencyid = cnfg.value then concat(currencyTitle, ' (Default)') else currencyTitle end as currencyTitle, cnfg.key
 ";	
			$str_all .= " FROM `".TPLPrefix."orders` t1
INNER JOIN ".TPLPrefix."order_status t2 ON t2.order_statusId = t1.order_status_id
INNER JOIN ".TPLPrefix."customers t3 ON t3.customer_id = t1.customer_id
INNER JOIN ".TPLPrefix."orders_products ordpdt ON ordpdt.order_id = t1.order_id
inner join ".TPLPrefix."currency cur on cur.currencyid = t1.order_currency_id left join ".TPLPrefix."configuration cnfg on cnfg.key = 'defaultcurrency' and cnfg.value = cur.currencyid and cur.IsActive =1 
 "; 						
		
		$whrcon = " where 1 = 1  ";

		
		if($_REQUEST[0]['value'] != "" ){
			$date = explode("-",$_REQUEST[0]['value']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[1]['value'] != "" && $_REQUEST[0]['value'] ){	
			$date = explode("-",$_REQUEST[1]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
		if(($_REQUEST[0]['value'] == "") && ($_REQUEST[1]['value'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("-",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$lastdat."' ";
		}
		
		if($_REQUEST[2]['value'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST[2]['value']."' ";
		}
				
	/*	if($_REQUEST[3]['value'] != "" ){
			$whrcon .= "  and t1.order_currency_id = '".$_REQUEST[3]['value']."' ";
		}*/
		
		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		$gpby = '';
		
		
		$gpby = " GROUP BY t1.customer_id ";
		
		if($_REQUEST[3]['value'] != "" )
			$gpby .= "  ,t1.order_currency_id ";
		else
			$gpby .= "  ,t1.order_currency_id ";
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		$str_all .= " ) tab ";
		
	
	//echo $str_all; die();
	
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getCustomerOrdersReportArray_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all = "SELECT count( DISTINCT ordpdt.product_id ) AS products, count( DISTINCT t1.order_id ) AS orders, count( ordpdt.product_id ) * ordpdt.product_qty AS pdqty, sum( t1.total_products ) AS totpdt, sum( t1.total ) AS total, t1.order_id, t1.order_reference, t1.invoice_no, t1.customer_id, t1.customer_group_id, t1.firstname, t1.email,  t1.total_products,case when t3.IsActive = 1 then 'Active' when t3.IsActive = 0 then 'Inactive' else 'Deleted' end as status , t1.currency_conversion,format(sum(t1.total)*t1.currency_conversion,2) as totalconverted, t2.order_statusName AS order_status, t3.customer_email AS orderDetails, (

SELECT AttributeValue FROM ".TPLPrefix."cus_attribute_tbl1 a1 INNER JOIN ".TPLPrefix."customfields_attributes a2 ON a1.AttributeId = a2.AttributeId
WHERE a1.customer_id = t1.customer_id AND a2.AttributeCode = 'Customer Name' ) AS Customer_Name, cur.currencysymbol, cur.curpriceusd, cur.IsActive, cur.UserId, cur.CreatedDate,case when  cnfg.key = 'defaultcurrency' and cur.currencyid = cnfg.value then concat(currencyTitle, ' (Default)') else currencyTitle end as currencyTitle, cnfg.key
 ";	
	
		/*if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "1" )
		{
			$str_all .= " ,DATE_FORMAT(t1.date_added,'%Y-%m-%d') as fstday, DATE_FORMAT(t1.date_added,'%Y-%m-%d') as lstday   ";
		}
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "2" )
		{
			$str_all .= " ,DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 1 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as fstday ,
			DATE_FORMAT(DATE_ADD( date_added, INTERVAL( 7 - DAYOFWEEK( date_added ) ) DAY ),'%Y-%m-%d') as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "3" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
		
		if(isset($_REQUEST[0]['value']) && $_REQUEST[0]['value'] == "4" )
		{
			$str_all .= " ,DATE_SUB( LAST_DAY( DATE_ADD(date_added, INTERVAL 0 MONTH) ), INTERVAL DAY(
        	LAST_DAY( DATE_ADD(NOW(), INTERVAL 0 MONTH) ) )-1 DAY ) as fstday ,
			LAST_DAY( DATE_ADD( date_added, INTERVAL 0 MONTH ) )  as lstday ";
		}
*/
			$str_all .= " FROM `".TPLPrefix."orders` t1
INNER JOIN ".TPLPrefix."order_status t2 ON t2.order_statusId = t1.order_status_id
INNER JOIN ".TPLPrefix."customers t3 ON t3.customer_id = t1.customer_id
INNER JOIN ".TPLPrefix."orders_products ordpdt ON ordpdt.order_id = t1.order_id
inner join ".TPLPrefix."currency cur on cur.currencyid = t1.order_currency_id left join ".TPLPrefix."configuration cnfg on cnfg.key = 'defaultcurrency' and cnfg.value = cur.currencyid and cur.IsActive =1 
 "; 						
		
		$whrcon = " where 1 = 1  ";

		
		if($_REQUEST[0]['value'] != "" ){
			$date = explode("-",$_REQUEST[0]['value']);
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		if($_REQUEST[1]['value'] != "" && $_REQUEST[0]['value'] ){	
			$date = explode("-",$_REQUEST[1]['value']);		
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$date[0]."' ";
		}
		
		if(($_REQUEST[0]['value'] == "") && ($_REQUEST[1]['value'] == ""))
		{
			$today = date('m/d/Y');
			$date = explode("-",$today);
			$lastdat = date('t');	
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') >= '".$date[2]."-".$date[1]."-1' ";
			$whrcon .= " and DATE_FORMAT(t1.date_added,'%Y-%m-%d') <= '".$date[2]."-".$date[1]."-".$lastdat."' ";
		}
		
		if($_REQUEST[2]['value'] != "" ){
			$whrcon .= "  and t1.order_status_id = '".$_REQUEST[2]['value']."' ";
		}
				
	/*	if($_REQUEST[3]['value'] != "" ){
			$whrcon .= "  and t1.order_currency_id = '".$_REQUEST[3]['value']."' ";
		}*/
		
		//echo $whrcon;
		if($whrcon != "")
			$str_all .= $whrcon;	
	
		
		
		$gpby = '';
		
		/*if($_REQUEST[0]['value'] != "" ){			
					
			if($_REQUEST[0]['value'] == "1" )
			$gpby = "  group by day(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "2" )
			$gpby = "  group by week(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "3" )
			$gpby = "  group by month(t1.date_added),op.product_id ";
			
			if($_REQUEST[0]['value'] == "4" )
			$gpby = "  group by year(t1.date_added),op.product_id ";
		}
		else*/
		$gpby = " GROUP BY t1.customer_id ";
		
		if($_REQUEST[3]['value'] != "" )
			$gpby .= "  ,t1.order_currency_id ";
		else
			$gpby .= "  ,t1.order_currency_id ";
		
		if(trim($gpby) != "")
			$str_all .= $gpby;
		
		if(trim($ordr) != "")
			$str_all .= $ordr;
		
		if($stt != "")
			$str_all .= "limit ".$stt.",".$len;		
				
		//echo $str_all;
		
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}

//CMS - page Display Grid - START
function getCmspageArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."cms_pages where 1=1 and IsActive <>2 "; 	
	
	if($whrcon != "")
		$str_all .= $whrcon;	
				
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getCmspage_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select * from ".TPLPrefix."cms_pages where 1=1 and IsActive <>2"; 		
		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
		
		   
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//CMS - page Display Grid - END

//CMS - block Display Grid - START
function getCmsblockArray_tot($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
	$str_all="select count(*) as cnt from ".TPLPrefix."cms_block where 1=1 and IsActive <>2 "; 	
	
	if($whrcon != "")
		$str_all .= $whrcon;	
				
	$res = $db->get_a_line($str_all);
	return $totalData = $res['cnt'];
}

function getCmsblock_Ajx($db, $act=null,$whrcon=null,$ordr=null,$stt=null,$len=null) 
{	
		$str_all="select * from ".TPLPrefix."cms_block where 1=1 and IsActive <>2"; 		
		
		$rescntchk =  $db->get_rsltset($str_all); 
	
		if($whrcon != "")
		$str_all .= $whrcon;	
	
		
		
		if(trim($ordr) != "")
		$str_all .= $ordr;
		
		if($stt != "")
		$str_all .= "limit ".$stt.",".$len;		
		
		   
		$res = $db->get_rsltset($str_all); 
		
	
		return $res; 			
}
//CMS - block Display Grid - END

?>
