<?php 
date_default_timezone_set("Asia/Kolkata"); 

include_once "session.php";
include "includes/Mdme-functions.php";

$getuserid = getUserinfo($db,$_SESSION['UserId']);
// storing  request (ie, get/post) global array to a variable  

$requestData= $_REQUEST;
include_once "display-grid-data-functions.php"; 
include "common/dpselect-functions.php";
$getuser = $db->get_a_line("select a.CatIds as categoryid,a.RoleId,b.IsAccessALL from  ".tbl_users." a inner join ".tbl_roles." b ON b.RoleId = a.RoleId where a.user_ID = '".$_SESSION["UserId"]."'");
  
$wrcon = "";
$srchcollen = count($requestData['search']);

$stt = $requestData['start'];
$len = $requestData['length'];
 
$attid = $requestData['attributeid'];
$formid = $requestData['formid'];
$tablename = $requestData['tablename'];
$cusid = $requestData['customerid'];
  
if($len == '-1')
$stt = "";

switch ($_REQUEST['finaltab']){ 	
case "languagelabel":	    		 
		$dispFields = array("displayname","pagecode","shortcode");
		$disporder_ID= "variableid";
		$mdme = getMdmelanguagelabel($db,''); 
		$statuscheck = checkIsactive('',$requestData['search']['value']);
		
		$wrcon .= " and (displayname like '%".$requestData['search']['value']."%' $statuscheck )";	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getlanguagelabelArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getlanguagelabelArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "languagepage":	    		 
		$dispFields = array("pagename","pagecode");
		$disporder_ID= "pageid";
		$mdme = getMdmelanguagepage($db,''); 
		$statuscheck = checkIsactive('',$requestData['search']['value']);
		
		$wrcon .= " and (pagename like '%".$requestData['search']['value']."%' $statuscheck )";	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getlanguagepageArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getlanguagepageArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "menu":	    		 
		$dispFields = array("row_number","MenuName");
		$disporder_ID= "MenuId";
		$mdme = getMdmeMenu($db,''); 
		$statuscheck = checkIsactive('',$requestData['search']['value']);
		
		$wrcon .= " and (MenuName like '%".$requestData['search']['value']."%' $statuscheck )";	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getMenuArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getMenuArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;		
		
	case "module":	    		 
		$dispFields = array("row_number","ModuleName","Description","ModulePath");
		$disporder_ID= "ModuleId";
		$mdme = getMdmeModule($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (ModuleName like '%".$requestData['search']['value']."%' or Description like '%".$requestData['search']['value']."%' or ModulePath like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getModuleArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getModuleArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "modulemenu":	    		 
		$dispFields = array("row_number","MenuName");
		$disporder_ID= "MenuId";
		$mdme = getMdmeModulemenu($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (MenuName like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getModuleMenuArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getModuleMenuArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "permissioninfo":	    		 
		$dispFields = array("row_number","RoleName");
		$disporder_ID= "RoleId";
		$mdme = getMdmePermissioninfo($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and  (r.RoleName like '%".$requestData['search']['value']."%' $statuscheck ) ";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getPermissionInfoArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getPermissionInfoArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "roleinfo":	    		 
		$dispFields = array("row_number","RoleName");
		$disporder_ID= "RoleId";
		$mdme = getMdmeRole($db,''); 		
		$statuscheck = checkIsactive('',$requestData['search']['value']);
		
		$wrcon = " and (r.RoleName like '%".$requestData['search']['value']."%' $statuscheck ) ";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getRoleArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getRoleArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	
	case "userinfo":	    		 
		$dispFields = array("row_number","user_firstname","user_lastname","user_email","RoleName");
		$disporder_ID= "user_ID";
		$mdme = getMdmeUser($db,''); 		
		$statuscheck = checkIsactive('u.',$requestData['search']['value']);
		
		$wrcon = " and (user_name like '%".$requestData['search']['value']."%' or user_firstname like '%".$requestData['search']['value']."%' or user_lastname like '%".$requestData['search']['value']."%' or r.RoleName like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getUserArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getUserArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	
	case "region":	    		 
		$dispFields = array("row_number","RegionName");
		$disporder_ID= "RegionId";
		$mdme = getMdmeRegion($db,''); 		
		
		$wrcon = " and (RegionName like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getRegionArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getRegionArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "country":	  
	
		$dispFields = array("row_number","countryname");
		$disporder_ID= "countryid";
		$mdme = getMdmeCountry($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (countryname like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCountryArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getCountryArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;
	
	case "state":	
	
		$dispFields = array("row_number","countryname","statename");
		$disporder_ID= "stateid";
		$mdme = getMdmeState($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (c.countryname like '%".$requestData['search']['value']."%' or s.statename like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getStateArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getStateArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "city":	
	
		$dispFields = array("row_number","countryname","statename","cityname");
		$disporder_ID= "cityid";
		$mdme = getMdmeCity($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (c.countryname like '%".$requestData['search']['value']."%' or s.statename like '%".$requestData['search']['value']."%' or ci.cityname like '%".$requestData['search']['value']."%'  $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getCityArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getCityArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;
	
	case "postcode":	
	
		$dispFields = array("row_number","pincode","cityname");
		$disporder_ID= "pincodeid";
		$mdme = getMdmePostcode($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (pc.pincode like '%".$requestData['search']['value']."%' or a.cityname like '%".$requestData['search']['value']."%'   $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getPinCodeArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getPinCodeArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
	
	case "currency":	
	
		$dispFields = array("row_number","currencyTitle","currencysymbol","curpriceusd");
		$disporder_ID= "currencyid";
		$mdme = getMdmecurrency($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (currencyTitle like '%".$requestData['search']['value']."%' or currencysymbol like '%".$requestData['search']['value']."%' or curpriceusd like '%".$requestData['search']['value']."%'  $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getCurrencyArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getCurrencyArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	

	case "taxmaster":	
	//echo "ayan"; exit;
		$dispFields = array("row_number","taxName","taxDesc","taxtype","taxRate");
		$disporder_ID= "taxId";
		$mdme = getMdmeTaxmaster($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (taxName like '%".$requestData['search']['value']."%' or taxDesc like '%".$requestData['search']['value']."%' or taxTyp like '%".$requestData['search']['value']."%' or taxRate like '%".$requestData['search']['value']."%'  $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getTaxmasterArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getTaxmasterArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
 	
 	
	case "language":	
	//echo "ayan"; exit;
		$dispFields = array("languagename");
		$disporder_ID= "languageid";
		$mdme = getMdmeLanguage($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (languagename like '%".$requestData['search']['value']."%'  $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getLanguageArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getLanguageArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;
	
	case "area":	
	//echo "ayan"; exit;
		$dispFields = array("cityname","areaname");
		$disporder_ID= "areaid";
		$mdme = getMdmeArea($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (c.cityname like '%".$requestData['search']['value']."%' or a.areaname like '%".$requestData['search']['value']."%'  $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getAreaArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getAreaArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
	
 	case "services":	
	//echo "ayan"; exit;
		$dispFields = array("service_name");
		$disporder_ID= "service_id";
		$mdme = getMdmeServices($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (service_name like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getServicesArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getServicesArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
		
 	case "customer":	
	//echo "ayan"; exit;
		$dispFields = array("fname","email","mobile");
		$disporder_ID= "customer_id";
		$mdme = getMdmeCustomer($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		$wrcon='';
        //$wrcon = " and (CONCAT(TO_BASE64(customer_firstname),' ',TO_BASE64(customer_lastname)) like '%".$requestData['search']['value']."%' or TO_BASE64(customer_email) like '%".$requestData['search']['value']."%' or TO_BASE64(mobileno) like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getCustomerArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getCustomerArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
 	
	case "banners":	
	//echo "ayan"; exit;
		$dispFields = array("row_number","bannername","Bannerposition");
		$disporder_ID= "bannerid";
		$mdme = getMdmeBanners($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (bannername like '%".$requestData['search']['value']."%' or Bannerposition like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getBannersArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getBannersArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
	
 	case "configuration":		
		$dispFields = array("storeName");
		
		$disporder_ID= "storeId";
		$mdme = getMdmeConfigure($db,''); 		
		
		$wrcon = " and (cnfg.key like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getConfigureArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getConfigureArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "mailtemplate":	
	//echo "ayan"; exit;
		$dispFields = array("row_number","templatename","mailbcc","mailsub");
		$disporder_ID= "mtemid";
		$mdme = getMdmeMailtemplate($db,''); 	
		$statuscheck = checkIsactive('',$requestData['search']['value']);	
		
        $wrcon = " and (mmt.templatename like '%".$requestData['search']['value']."%' or mt.mailbcc like '%".$requestData['search']['value']."%' or mt.mailsub like '%".$requestData['search']['value']."%' $statuscheck )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
		
		$totalData = getMailTemplateArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getMailTemplateArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	//print_r($res); exit;
	break;	
	
	case "attributes":		
		$dispFields = array("row_number","attributename","attribute_type");
		$disporder_ID= "attributeid";
		$mdme = getMdmeAttributes($db,''); 	
		
		$wrcon = " and (attributename like '%".$requestData['search']['value']."%' )";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getAttributesArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getAttributesArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "attributegroup":		
		$dispFields = array("row_number","attribute_groupName");
		$disporder_ID= "attribute_groupID";
		$mdme = getMdmeAttributegroup($db,'');		
		
		$wrcon = " and (attribute_groupName like '%".$requestData['search']['value']."%' or attribute_groupdesc like '%".$requestData['search']['value']."%' )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getAttrGroupArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getAttrGroupArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "orderstatus":		
		$dispFields = array("row_number","order_statusName","order_statusDescription");
		$disporder_ID= "order_statusId";
		$mdme = getMdmeorderstatus($db,''); 		
		
		$wrcon = " and (order_statusName like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getOrderstatusArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getOrderstatusArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "featurestories":		
		$dispFields = array("row_number","StoryTitle","StoryDate","StoryURL","StoryDescription");
		$disporder_ID= "FsId";
		$mdme = getMdmefeaturestories($db,''); 		
		
		$wrcon = " and (StoryTitle like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getfeaturestoriesArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getfeaturestoriesArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "news":		
		$dispFields = array("row_number","newstitle");
		$disporder_ID= "newsid";
		$mdme = getMdmenews($db,''); 		
		
		$wrcon = " and (newstitle like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getnewsArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getnewsArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "events":		
		$dispFields = array("row_number","eventtitle");
		$disporder_ID= "eventid";
		$mdme = getMdmenews($db,''); 		
		
		$wrcon = " and (eventtitle like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = geteventsArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = geteventsArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	
	case "attributesmap":		
		$dispFields = array("attribute_groupName");
		$disporder_ID= "attribute_groupId";
		$mdme = getMdmeAttrmap($db,''); 	
		
		$wrcon = " and (attribute_groupName like '%".$requestData['search']['value']."%' or attributename like '%".$requestData['search']['value']."%' ) group by map.attribute_groupId ";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getAttrMapArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getAttrMapArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "category":		
		$dispFields = array("categoryName","ParentCat","hsncode");
		$disporder_ID= "categoryID";
		$mdme = getMdmeCategory($db,''); 		
		
		$wrcon = " and (sbc.categoryName like '%".$requestData['search']['value']."%' or mnc.CategoryName like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCategoryArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCategoryArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	    
	break;
	
	case "product":		
		$dispFields = array("img_names","categoryName","product_name","sku","price","minquantity");
		$disporder_ID= "product_id";
		$mdme = getMdmeProduct($db,''); 	
		
		$wrcon = " and (t1.product_name like '%".$requestData['search']['value']."%' or t1.description like '%".$requestData['search']['value']."%' or t1.model like '%".$requestData['search']['value']."%' )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getProductapprovalArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getProductapprovalArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	 	 		
	######### report ######################
case "shippingflatair":		
		$dispFields = array("shippingTitle","shippingName","shippingCost");
		$disporder_ID= "flatshippingId";
		$mdme = getMdmeFlatairShipping($db,''); 	
		
		$wrcon = " and (shippingName like '%".$requestData['search']['value']."%' )";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getFlatAirShippingArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getFlatAirShiipingArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	//flat rate road shipping
	case "shippingflat":		
		$dispFields = array("shippingTitle","shippingName","shippingCost");
		$disporder_ID= "flatshippingId";
		$mdme = getMdmeShippingmodules($db,''); 	//getMdmeFlatShippingmodules($db,''); 	
		
		$wrcon = " and (shippingName like '%".$requestData['search']['value']."%' )";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getFlatShippingArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getFlatShiipingArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "shipping":		
		$dispFields = array("shippingName");
		$disporder_ID= "shippingId";
		$mdme = getMdmeShippingmodules($db,''); 	
		
		$wrcon = " and (shippingName like '%".$requestData['search']['value']."%' )";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getShippingArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getShiipingArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "coupons":		
		$dispFields = array("CouponTitle","CouponCode","cpnappname","CouponTotal","cnt","CouponEndDate");
		$disporder_ID= "CouponID";
		$mdme = getMdmeCoupon($db,''); 		
		
		
		
		$wrcon = " and (c.CouponTitle like '%".$requestData['search']['value']."%' or c.CouponCode like '%".$requestData['search']['value']."%' or ca.cpnappname like '%".$requestData['search']['value']."%'  )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCouponArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCouponArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "discount":		
		$dispFields = array("DiscountTitle","disappname","discounttype","DiscountAmount","DiscountEndDate");
		$disporder_ID= "DiscountID";
		$mdme = getMdmeDiscount($db,''); 		
		
		
		
		$wrcon = " and (DiscountTitle like '%".$requestData['search']['value']."%'  or da.disappname like '%".$requestData['search']['value']."%'  )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getDiscountArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getDiscountArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	 case "homepageslider":		
		$dispFields = array("title","categorytyes");
		$disporder_ID= "hpsid";
		$mdme = getMdmeHomepageslider($db,''); 		
		
		$wrcon = " and (title like '%".$requestData['search']['value']."%' or categorytyes like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = gethomepagesliderArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = gethomepagesliderArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	    //print_r($res); exit;
	break;
	
	case "homepageslidercat":		
		$dispFields = array("title","categoryName");
		$disporder_ID= "hpsid";
		$mdme = getMdmeHomepageslidercat($db,''); 		
		
		$wrcon = " and (title like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = gethomepageslidercatArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = gethomepageslidercatArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	    //print_r($res); exit;
	break;
	
		//flat free shipping
	case "shippingfree":		
		$dispFields = array("shippingTitle","shippingName","orderMinimum");
		$disporder_ID= "flatshippingId";
		$mdme = getMdmeShippingmodules($db,'');//getMdmeFreeShipping($db,''); 	
		
		$wrcon = " and (shippingName like '%".$requestData['search']['value']."%' )";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getFreeShippingArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getFreeShiipingArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "customfields":		
		$dispFields = array("AttributeCode","AttributeName","elementname");
		$disporder_ID= "AttributeId";
		$mdme = getMdmeCustomfields($db,''); 	
		
		$wrcon = " and (t1.AttributeCode like '%".$requestData['search']['value']."%' or t1.AttributeName like '%".$requestData['search']['value']."%' or t2.elementname like '%".$requestData['search']['value']."%' )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCustomfieldsArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCustomfields_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "customergroups":		
		$dispFields = array("customer_group_name");
		$disporder_ID= "customer_group_id";
		$mdme = getMdmeCustomergroups($db,''); 	
		
		$wrcon = " and (customer_group_name like '%".$requestData['search']['value']."%' )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCustomerGroupsArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCustomerGroups_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "customers":		
		
		if($cusid==2){
		$dispFields = array("customer_firstname","customer_lastname","customer_email","discount","gstdocument","businesscard");
	$qryattrbute=" select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 
						inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1  
						inner join ".TPLPrefix."customfield_custgrp t3 on t3.CustomFieldId=t1.AttributeId and t3.IsActive=1 
						inner join  ".TPLPrefix."customer_group t4  on t4.customer_group_id=t3.CustomerGrupId and t4.IsActive=1 and t4.customer_group_id='".$cusid."'
						where 1=1 and t1.IsActive =1  group by t1.AttributeCode order by t1.SortBy asc ";
						$resattrbute=$db->get_rsltset($qryattrbute);
						foreach($resattrbute as $att)
						{
							$dispFields[]=$att['AttributeCode'];
						}
		}
		else
		$dispFields = array("customer_firstname","customer_lastname","customer_email");
		$disporder_ID= "customer_id";
		$mdme = getMdmeCustomers($db,'customers_mng.php?cusid='.base64_encode($cusid)); 	
		$wrcon = " and (customer_firstname like '%".$requestData['search']['value']."%' or customer_lastname like '%".$requestData['search']['value']."%' or customer_email like '%".$requestData['search']['value']."%')";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCustomersArray_tot($db,$act,$wrcon,$ordr,$stt,$len,$cusid); 		
		$res = getCustomers_Ajx($db,$act,$wrcon,$ordr,$stt,$len,$cusid); 		
	
	break;
	
	case "manufacturer":		
		$dispFields = array("manufacturerName","ParentBrant","description");
		$disporder_ID= "manufacturerId";
		$mdme = getMdmemanufacturer($db,''); 		
		
		$wrcon = " and (smf.manufacturerName like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getManufactArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getManufactArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	    
	break;
	
	case "attributevalue":	
        
		$str_eds = "select unitdisplay from ".TPLPrefix."m_attributes  where  attributeId ='".$attid."'  and IsActive <> 2  ";
		$res_eds = $db->get_a_line($str_eds);
        $unitdisplay = $res_eds['unitdisplay'];
		
        if($unitdisplay==1){ 		
		$dispFields = array(dropdown_values,dropdown_unit,sortingOrder);
		}
		else{
			$dispFields = array(dropdown_values,sortingOrder);
		}
		$disporder_ID= "dropdown_id";
		$mdme = getMdmeAttibutevalue($db,'attributevalue_mng.php?attid='.base64_encode($attid)); 	
		
		$wrcon = " and (dropdown_values like '%".$requestData['search']['value']."%' )";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getAttributevalueArray_tot($db,$act,$wrcon,$ordr,$stt,$len,$attid); 		
		$res = getAttributevalueArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len,$attid); 		
	//print_r($res); die();
	break;
	
		case "subscribe":	    		 
		$dispFields = array("emailid","languagefrom");
		$disporder_ID= "subscribeid";
		$mdme = getMdmeSubscribe($db,''); 
		
		$wrcon .= " and (emailid like '%".$requestData['search']['value']."%')";	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getsubscribeArray_tot($db,$act,$wrcon,$ordr,$stt,$len);
		$res = getsubscribeArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	break;
	
	case "orders":		
		$dispFields = array("order_id","orderDetails","date_added","grand_total","languagename","payment_method");
		$disporder_ID= "order_id";
		$mdme = getMdmeOrders($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getOrdersArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getOrdersArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "payments":		
		$dispFields = array("order_id","orderDetails","date_added","grand_total","languagename","payment_method");
		$disporder_ID= "order_id";
		$mdme = getMdmePayments($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getPaymentsArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getPaymentsArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "suggestedProduct":		
		$dispFields = array("product_id","product_name","description","groupname","sku","price","suggested_products");
		$disporder_ID= "product_id";
		$mdme = getMdmeProduct($db,''); 	
		
				
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getSuggestedProductapprovalArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getSuggestedProductapprovalArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "relatedProducts":		
		$dispFields = array("product_id","product_name","description","groupname","sku","price","suggested_products");
		$disporder_ID= "product_id";
		$mdme = getMdmeProduct($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getSuggestedProductapprovalArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getSuggestedProductapprovalArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "contactus":		
		$dispFields = array("contactname","contactemail","contactmobile","contactmessage");
		$disporder_ID= "contactid";
		$mdme = getMdmeContactus($db,''); 		
		
		$wrcon = " and (contactname like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getcontactusArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getcontactusArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "orderproducts":		
		$dispFields = array("fstday","lstday","product_name","product_sku","productcount","productprice","total_price");
		$disporder_ID= "product_id";
		$mdme = getMdmeSaleReport($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getOrdrProductsReportArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getOrdrProductsReportArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//$tst = getSaleReportsQry_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//echo $res[0]['str_all'];
	
	break;
	
	case "fbmanagementdisplay":	
	
         $str_all="select t2.*,t3.elementid,t3.elementname,t3.element_type from ".TPLPrefix."formbuilder t1 inner join ".TPLPrefix."fb_attributes t2 on t1.FormId=t2.FormId and t2.IsActive=1 inner join ".TPLPrefix."m_elements t3 on t3.elementid=t2.AttributeType and t3.IsActive=1 where t1.fromtablename='".$tablename."' group by t2.AttributeCode order by sortBy asc ";
		 
		$res_eds = $db->get_rsltset($str_all);
		//echo "<pre>"; print_r($res_eds); exit;
		$displyfields = array();
		$filefields = array();
		foreach($res_eds as $data){
			
            if($data['element_type'] == 1){			
			 
				//text && textarea			 
				if($data['elementid'] == 1 || $data['elementid'] == 2){
					
					$displyfields[]= $data['AttributeName'];
				}
				
				//file
				if($data['elementid'] == 8){
                 
				$filefields[] = $data['AttributeName']; 
				$displyfields[]= $data['AttributeName'];
				}
				
				//master
				if($data['elementid'] == 9){
					
					$get_editval = $db->get_a_line("select t2.* from ".TPLPrefix."fb_attributes t1 inner join ".TPLPrefix."mastertables t2 on t1.masterid=t2.MasterId and t1.IsActive=1 where t1.IsActive = 1 and t1.AttributeId ='".$data['AttributeId']."'  ");
					
					$displyfields[]= $get_editval['ColumnName'];
				}
			} 
			
		}
		// echo $arrayfields; exit;
		$dispFields =$displyfields;
		$disporder_ID= "id";
		$mdme = getMdmefbmanagementdisplay($db,'fbmanagementdisplay_mng.php?tablename='.$tablename);
     
		//$wrcon = " and (company like '%".$requestData['search']['value']."%')";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		//$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getfbmanagementdisplayArray_tot($db,$act,$wrcon,$ordr,$stt,$len,$tablename); 		
		$res = getfbmanagementdisplayArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len,$tablename); 		
	
	break;
	
	case "rpt_formbuilder":	
	
	
	
	    //query
		   
         $str_alls="select  t1.AttributeCode  from ".TPLPrefix."fb_attributes t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 order by SortBy ";
		$rescntchk =  $db->get_rsltset($str_alls);
		$fldname = array(); 
        $search = array();		
		foreach($rescntchk as $value){
			
         $fldname[] = $value['AttributeCode'];
		 $search[] = $value['AttributeCode']." like '%".$requestData['search']['value']."%' ";
		}			
		 $searchdata = implode('or ',$search);  
		   
		//end query
	
	
	
	
		$dispFields = $fldname;
		$disporder_ID= "id";
		$mdme = getMdmerptformbuilder($db,'rpt_formbuilder.php?formid='.base64_encode($formid)); 	
		
		$wrcon = " and (".$searchdata.")";	
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getrptformbuilderArray_tot($db,$act,$wrcon,$ordr,$stt,$len,$formid); 		
		$res = getrptformbuilderArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len,$formid); 		
	//print_r($res); die();
	break;
	
	case "videos":		
		$dispFields = array("video_title","video_date");
		$disporder_ID= "video_id";
		$mdme = getMdmeVideos($db,''); 		
		
		$wrcon = " and (video_title like '%".$requestData['search']['value']."%' or  video_date like '%".$requestData['search']['value']."%' )";		
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getVideosArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getVideosArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	
	case "manageclient":		
		$dispFields = array("mcname","mcurl");
		$disporder_ID= "mcid";
		$mdme = getMdmeMangeclient($db,''); 
			
		$wrcon = " and (mcname like '%".$requestData['search']['value']."%' or  mcurl like '%".$requestData['search']['value']."%' )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getManageclientArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getManageclientArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "salereports":		
		$dispFields = array("fstday","lstday","cart_products","coupon_discounts","total_shipping","totalconverted");
		$disporder_ID= "order_id";
		$mdme = getMdmeSaleReport($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getSaleReportsArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getSaleReportsArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//$tst = getSaleReportsQry_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//echo $res[0]['str_all'];
		
	
	break;
	
	case "lowstockproducts":		
		$dispFields = array("product_name","sku","quantity","price","status");
		$disporder_ID= "product_id";
		$mdme = getMdmeLowstockreport($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getLowStockReportArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getLowStockReportArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//$tst = getSaleReportsQry_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//echo $res[0]['str_all'];
	
	break;
	
	case "custorderproducts":		
		$dispFields = array("firstname","email","status","orders","products","totalconverted");
		$disporder_ID= "customer_id";
		$mdme = getMdmeSaleReport($db,''); 	
						
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCustomerOrdersReportArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCustomerOrdersReportArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//$tst = getSaleReportsQry_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 	
		//echo $res[0]['str_all'];
	
	break;
	
	case "page":		
		$dispFields = array("cms_pagename","cms_pageurl");
		$disporder_ID= "cms_pageid";
		$mdme = getMdmePage($db,''); 	
		
		$wrcon = " and (cms_pagename like '%".$requestData['search']['value']."%' )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCmspageArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCmspage_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;
	
	case "block":		
		$dispFields = array("cms_blockname","cms_blogslug");
		$disporder_ID= "cms_blockid";
		$mdme = getMdmeCMSblock($db,''); 	
		
		$wrcon = " and (cms_blockname like '%".$requestData['search']['value']."%' )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getCmsblockArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getCmsblock_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "testimonial":		
	 
		$dispFields = array("customername","customeremailid","testimonialcontent","languagefrom");
		$disporder_ID= "testimonialid";
		$mdme = getMdmeTestimonial($db,''); 	
		
		$wrcon = " and (customername like '%".$requestData['search']['value']."%'  or customeremailid like '%".$requestData['search']['value']."%'  )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = gettestimonialArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getTestimonialArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	
	break;	
	
	case "getaquote":
	
	$dispFields = array("productname","customername","organization","EmailId","MobileNo","Query","languagename","dateadd");
		$disporder_ID= "testimonialid";
		$mdme = getMdmeGetaquote($db,''); 	
		
		$wrcon = " and (productname like '%".$requestData['search']['value']."%'  )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getproductenquiryArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getproductenquiryArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	break;
	
	case "knowledgecenter":
	
	$dispFields = array("knowledgecentertitle","categoryname");
		$disporder_ID= "knowledgecenterid";
		$mdme = getMdmeGetaquote($db,''); 	
		
		$wrcon = " and (knowledgecentertitle like '%".$requestData['search']['value']."%' or categoryname like '%".$requestData['search']['value']."%'  )";
		
		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";	
				
		$totalData = getknowledgecenterArray_tot($db,$act,$wrcon,$ordr,$stt,$len); 		
		$res = getknowledgecenterArray_Ajx($db,$act,$wrcon,$ordr,$stt,$len); 		
	break;
	
	default:
       echo "No-Data";
}
 
$totalFiltered = $totalData;
$data = array();												
 
	foreach($res as $r)
	{		
		$r=(array)$r;
    	if(in_array($_REQUEST['finaltab'],$arrdencrptmodule))
    	{
    		foreach($r as $key=>$value)
    		{
    			if(in_array($key,$employeesfields)){		
    			$r[$key]=encrpt_decrpt_data($value,"d");
    			}
    		}
    	}	
    	
    	
		$nestedData=array(); 	
		 
       		
		$editid = base64_encode($r[$disporder_ID]);                    
        $stats = $r['IsActive'];					
		$actmodul = $_REQUEST['finaltab'];
		 
		if($_REQUEST['finaltab']=='product'){
			//$r['img_names']
			$imgs=explode("|",	$r['img_names']);
			if($imgs[0] != ''){
			$r['img_names'] = '<a class="product-list-img" href="javascript: void(0);"><img src="'.IMG_BASE_URL.'productassest/'.$r['product_id'].'/photos/'.$imgs[0].'" alt="product"></a>';
			}else{
			$r['img_names'] = '<a class="product-list-img" href="javascript: void(0);"><img src="'.IMG_BASE_URL.'noimage/photos/thumb/noimage.png"></a>';	
			}
		}
		
		 if($_REQUEST['finaltab'] == "suggestedProduct"){
	$suggestedProduct = array();
	if(isset($_REQUEST[11]['suggestedProductIds']))
		$suggestedProduct = explode(",",$_REQUEST[11]['suggestedProductIds']);
	$r["product_id"] = "<div class='checkbox'><label><input type='checkbox' class='suggestedProducts' name='suggestedProducts[]' value='".$r["product_id"]."' ".((in_array($r["product_id"],$suggestedProduct))? "  ":"")." ";$r["product_id"] .= " /><span class='checkbox-material'><span class='check'></span></span></label></div>";
	$incstat = '';	
	$edtstat = '';
	$delstat = '';
}

if($_REQUEST['finaltab'] == "relatedProducts"){
	$relatedProducts = array();
	if(isset($_REQUEST[11]['relatedproductIds']))
		$relatedProducts = explode(",",$_REQUEST[11]['relatedproductIds']);
	
	$r["product_id"] = "<div class='checkbox'><label><input type='checkbox' class='relatedProducts' name='relatedProducts[]' value='".$r["product_id"]."' ".((in_array($r["product_id"],$relatedProducts))? " ":"")." /><span class='checkbox-material'><span class='check'></span></span></label>
</div>";
	
	$incstat = '';	
	$edtstat = '';
	$delstat = '';
}


		foreach ($dispFields as $dispFields_S) {
		   $flag=0;
			 if($_REQUEST['finaltab'] == 'fbmanagementdisplay' && in_array($dispFields_S,$filefields)){
			 
				 if($r[$dispFields_S]!= ''){
					 $nestedData[] = '<a class="badge badge-dark" target="_blank" href="../uploads/fb_uploadfolder/'.$r[$dispFields_S].'"> View / Download </a>';
					 $flag=0;
				}
			 }		
			else		
			$nestedData[] = $r[$dispFields_S];			
		}
		
	 
		
		 if($_REQUEST['finaltab'] == 'shipping'){
			
			if($r['shippingPage'] == "shippingflat_mng.php"){
			//$nestedData[] = '<a href="shipping_flat.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit">Update Flat Rate Values</i></a>';
			$nestedData[] = '<a class="btn btn-warning btn-rounded mb-4 mr-2 "  href="shippingflat_mng.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit"></i> Manage Road Rate Shipping</a>';
			}
			else if($r['shippingPage'] == "shippingflatair_mng.php"){
				$nestedData[] = '<a class="btn btn-warning btn-rounded mb-4 mr-2 "  href="shippingflatair_mng.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit"></i> Manage Air Rate Shipping</a>';
			}
			else if($r['shippingPage'] == "shippingfree_mng.php"){
			//$nestedData[] = '<a href="shipping_flat.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit">Update Flat Rate Values</i></a>';
			$nestedData[] = '<a class="btn btn-success btn-rounded mb-4 mr-2 " href="shippingfree_mng.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit"></i> Manage Free Shipping</a>';
			}
			else if($r['shippingPage'] == "shippingprice_mng.php"){
			//$nestedData[] = '<a href="shipping_flat.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit">Update Flat Rate Values</i></a>';
			$nestedData[] = '<a class="btn btn-warning btn-rounded mb-4 mr-2 "  href="shippingprice_mng.php?shipping='.base64_encode($r['shippingId']).'"><i class="fa fa-edit"></i> Manage Price Based Shipping</a>';
			}
			else{
				$nestedData[] = 'N/A';
			}			
		}
		
			if($_REQUEST['finaltab'] == 'customfields'){
			
			if($r['element_type'] == "2" || $r['element_type'] == "4"  ){
			$nestedData[] = '<a class="btn btn-warning btn-rounded mb-4 mr-2 " href="attrvaladd_form.php?AttributeId='.base64_encode($r['AttributeId']).'"><i class="fa fa-edit"></i> Attribute Values</a>';
			}
			else{
				$nestedData[] = 'N/A';
			}			
		}
		
		if($_REQUEST['finaltab']=='banners') {
    		if($r['bannerimage'] !='') 
    		{
    		    $nestedData[] = '<span><img id="preview_img" src="'. IMG_BASE_URL.'banners/'. $r['bannerimage'].'" width="45px" align="absmiddle"/> </span>';
    		}else{
    		    $nestedData[] ='-';
    		}
		
		}
		if($_REQUEST['finaltab'] == 'news'){
			
			$nestedData[] = '<a href="news_moreimage.php?id='.$r['newsid'].'"><i class="fa fa-file-image-o"></i> Add/View Images</a>';
			
		
		}
		
		if($_REQUEST['finaltab'] == 'events'){
			
			$nestedData[] = '<a href="events_moreimage.php?id='.$r['eventid'].'"><i class="fa fa-file-image-o"></i> Add/View Images</a>';
			
		
		}
		if($_REQUEST['finaltab'] == 'payments'){
		    if($r['payment_status']==1 ){
		        $nestedData[]='<span class="badge badge-primary">Pending</span>';
		    }else if($r['payment_status']==34){
		        $nestedData[]='<span class="badge badge-danger">Failed</span>';
		    }else if($r['payment_status']==37){
		        $nestedData[]='<span class="badge badge-success">Received</span>';
		    }
		    
		    if($r['payment_status']!=37){

                $strGetStatus  = "SELECT * FROM   ".TPLPrefix."order_status where IsActive = 1 and order_statusId IN (1,34,37)" ;
                $resultStatus = $db->get_rsltset($strGetStatus);
                $incstat_ps ='<select class="form-control  select2" data-orderid="'.$r['payment_status'].'"  name="payment_status" onchange="update_payment_status(this.value,'.$r["order_id"].');">';
                $incstat_ps .= '<option value ="">select status</option>';
                foreach($resultStatus as $value){
                
                if($r["payment_status"] == $value['order_statusId']){
                $sel = " selected='selected' ";
                }else{
                $sel='';
                }
                $incstat_ps .= '<option value ="'.$value['order_statusId'].'" '.$sel.'>'.$value['order_statusName'].'</option>';		
                
                }	
                $incstat_ps .= "</select><br>";
                $nestedData[]=$incstat_ps;

		    }else{
		        $nestedData[]='<span class="badge badge-success">TRANSACTION ID:<br> '.$r['payment_transaction_id'].'</span>';
		    }
           
		
		}
		
		

		///////////from here, newly added for act status		
		if($_REQUEST['finaltab'] != 'modulemenu' && $_REQUEST['finaltab'] != 'permissioninfo' && $_REQUEST['finaltab'] != 'orders' && $_REQUEST['finaltab'] != 'product' && $_REQUEST['finaltab']!='fbmanagementdisplay') { 
		if($r['IsActive'] == 1) 
		{
		//change status active to inactive
		$statusurl = "'".$_REQUEST['finaltab']."_actions.php','Id=$editid&action=changestatus&actval=0'";
		
		/*<label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                            <input type="checkbox" checked="checked" onclick="funchangestatus(this,'.$statusurl.');">
                                            <span class="slider round" ></span>
                                        </label>*/
										
		$incstat =  '<a href="javascript:void(0);" onclick="funchangestatus(this,'.$statusurl.');"><img src="activeicon.png"></a>
		
										
										';
		 } 
		 else{
			//change status inactive to active
			
			
		 $statusurl = "'".$_REQUEST['finaltab']."_actions.php','Id=$editid&action=changestatus&actval=1'";
		 $incstat =  '<a href="javascript:void(0);" onclick="funchangestatus(this,'.$statusurl.');"><img src="inactiveicon.png"></a>';
		 /*
	     $incstat = '<label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                            <input type="checkbox" onclick="funchangestatus(this,'.$statusurl.');">
                                            <span class="slider round" ></span>
                                        </label>
										
									';*/
		 
		}
		$nestedData[] = $incstat;
	 
		}
		 
		 
		 
		
	if($_REQUEST['finaltab'] == "orders" || $_REQUEST['finaltab'] == "return" ){
    
	$nestedData[] = '<span class="badge badge-'.$r['payclassname'].'">'.$r['orderstatus'].'</span>';
	
	$nestedData[] = '<span class="badge badge-'.$r['classname'].'">'.$r['order_status'].'</span>';
	
	$r["order_status"] = "<span id='order_status_".$r["order_id"]."'>".$r["order_status"]."</span>";
	if( $_REQUEST['finaltab'] == "orders" && $r["order_status_id"]!=14){
		
		$strGetStatus  = "SELECT * FROM   ".TPLPrefix."order_status where IsActive = 1 and lang_id=1 and order_statusId NOT IN (34,37)";
		$resultStatus = $db->get_rsltset($strGetStatus);
		
		$incstat ='<select class="form-control select2" data-orderid="'.$r["order_id"].'"  name="status" onchange="update_order_status(this.value,'.$r["order_id"].');">';
		foreach($resultStatus as $stval){
			
			$incstat .= '<option value ="'.$stval['order_statusId'].'"';
			
			if($r["order_status_id"] == $stval['order_statusId'])
				$incstat .= " selected='selected' ";
			
			$incstat .= '>'.$stval['order_statusName'].'</option>';		
           		
		}	
		$incstat .= "</select><br>";
		if($r['orderawb'] != ''){
		$incstat .= "<span class='badge badge-success'>AWB NO: ".$r['orderawb']."</span><br><br>
		";
		}
	 
		}
		else {
			$incstat ='';
		}
		
		
		if($_REQUEST['finaltab'] == "orders" && $r["order_status_id"]==14){
			$incstat .= "<button class='btn btn-outline-info btn-rounded mb-4 mr-2'  id='invoice' onclick=\"window.location.href='".BASE_URL_ADMIN.$_REQUEST['finaltab']."_view.php?orderId=".$r['order_id']."'\" > <i class='flaticon-square-menu mr-1'></i> Invoice</button>
";
		}
		else{
			$incstat .= "<button class='btn btn-outline-warning btn-rounded mb-4 mr-2' value='View Orders' id='view-order' onclick=\"window.location.href='".BASE_URL_ADMIN.$_REQUEST['finaltab']."_view.php?orderId=".$r['order_id']."'\" ><i class='flaticon-view-3 mr-1'></i> Orders</button>";
		}
		
		$nestedData[] = $incstat;
	}	
	
	
	
    if($_REQUEST['finaltab']=='product'){
		
		$nestedData[] = '<a href="product_moreimage.php?id='.$r['product_id'].'"><i class="fa fa-file-image-o"></i> Add/View Images</a>';
		
  		  $ishome = 0; 
		  $ishome = $r['displayinhome']; 
		   $isfeaturedproduct = $r['isfeaturedproduct']; 
		
		 if($ishome == 0){ 
		  $statusurlc = "'product_actions.php','Id=$editid&action=changeishome&actval=1'";		
		  $incstat_show =  ' 		
							<a href="javascript:void(0);"><span class="badge badge-danger" onclick="funchangestatus(this,'.$statusurlc.');"> <i class="fa fa-circle"></i> HIDE </span></a>
				 	 	  ';
		}else{
		  $statusurlc = "'product_actions.php','Id=$editid&action=changeishome&actval=0'";			
		  $incstat_show =  ' 	
						<a href="javascript:void(0);">	<span class="badge badge-success" onclick="funchangestatus(this,'.$statusurlc.');"> <i class="fa fa-circle"></i> SHOW </span></a>
				 		 ';								 					 
		}
		
		$nestedData[] = $incstat_show;
		if($isfeaturedproduct == 1){
		$nestedData[] = "<a href='".BASE_URL."featuredproduct_form.php?act=edit&pid=".base64_encode($r['product_id'])."' class='btn btn-outline-primary btn-rounded mb-4 mr-2'>Yes <i class='flaticon-edit'></i></a>";
		}else{
		$nestedData[] = "<a href='javascript:void(0);' class='btn btn-outline-danger btn-rounded mb-4 mr-2'>No</a>";
		}
		if($r['IsActive'] == '1')
		{
			$statusurl = "'".$_REQUEST['finaltab']."_actions.php','Id=$editid&action=changestatus&actval=0'";
			$incstat1 =  '<a href="javascript:void(0);"><i class="flaticon-cart-bag-1" data-toggle="tooltip" title="Approved" onclick="funchangestatus(this,'.$statusurl.');"></i></a>'	;	
		}
        else
		{
			$statusurl = "'".$_REQUEST['finaltab']."_actions.php','Id=$editid&action=changestatus&actval=1'";
			$incstat1 =  '<a href="javascript:void(0);"><i class="flaticon-cart-bag" data-toggle="tooltip" title="Pending Approved" onclick="funchangestatus(this,'.$statusurl.');"></a></i>';
		}
		$nestedData[] = $incstat1;
			   
    }	
	 
 if($_REQUEST['finaltab']!='fbmanagementdisplay'){
   if($_REQUEST['finaltab'] == 'attributevalue'  ){
	
	$edtstat='<a href="'.$actmodul.'_form.php?attid='.base64_encode($attid).'&act=edit&id='.$editid.'" title="edit" data-toggle="tooltip" ><i class="flaticon-edit bg-success p-1 text-white br-6 mb-1"></i></a>';
}else  if($_REQUEST['finaltab'] == 'product'){
	 $edtstat='<a  href="'.$actmodul.'_form.php?act=edit&id='.$editid.'" '.$target.' data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                                <i class="flaticon-edit"></i></a>  ';
}else{
        $edtstat='<a href="'.$actmodul.'_form.php?act=edit&id='.$editid.'" '.$target.' data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="flaticon-edit bg-success p-1 text-white br-6 mb-1"></i></a>  ';
}
 }
 
	//del 
	
	


	  if($_REQUEST['finaltab'] != 'modulemenu' && $_REQUEST['finaltab'] != 'permissioninfo' && $_REQUEST['finaltab']!='fbmanagementdisplay') { 
			$delurl = "'".$_REQUEST['finaltab']."_actions.php','Id=$editid&action=del'";
		 
 			$delstat='&nbsp;<a href="javascript:void(0)" onClick="javascript:funStats(this,'.$delurl.')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="flaticon-close-fill text-danger fs-20"></i></a>';	
	  }
 		
	 if($_REQUEST['finaltab'] == 'product'){
		$delstat =  '<a href="javascript:void(0)" onClick="javascript:funStats(this,'.$delurl.')"  data-toggle="tooltip" data-placement="top" title="Delete" >
                                                                <i class="flaticon-delete-5"></i></a>';
	 }
	 
	 
	

 		  include_once "includes/pagepermission.php";
		  
		  		  
		  if(trim($res_modm_prm['EditPrm'])=="1") {
			$edtstat = $edtstat;
		  }else{
			$edtstat = "";			
		  }
		  
		 if(trim($res_modm_prm['DeletePrm'])=="1") {
		  $delstat = $delstat;
		  }else{
		  $delstat = "";
		  }
		  
	  
		  if( trim($res_modm_prm['EditPrm'])!="1" &&  trim($res_modm_prm['DeletePrm'])!="1" ){
			 $delstat = "-"; 
		  }
		  
		 
		///////////till here newly added for act inact status	
if($_REQUEST['finaltab']=='product'){
$nestedData[] = '<ul class="table-controls">
                                                        <li>
                                                            '.$edtstat.'
                                                        </li>
                                                        <li>
                                                            '.$delstat.'
                                                        </li>
                                                    </ul>';
}else{
		$nestedData[] = $edtstat." ".$delstat;
}
		
		$data[] = $nestedData;		
	}
		
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array			
);	
	

echo json_encode($json_data);  // send data as json format

?>