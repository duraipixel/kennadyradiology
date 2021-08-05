<?php 

function getTopMenuArray($db, $RoleId=null,$admin_id=null) 
{

	$str_Pra="";
	if($admin_id != '' && $_SESSION['RoleId'] != '0') 
	{ 
		$strmenu=" m_us.UserId = '".$admin_id."' and m_md.IsActive=1 ";
		if($_SESSION['RoleId']==1)
			$strmenu=" m_md.IsActive=1 and m_rp.RoleId=1 ";	
	
		   $select_mnu = "SELECT distinct m_me.MenuName,m_mdm.MenuId,m_me.moduleicon FROM ".tbl_modules." m_md inner join ".tbl_modulemenus." m_mdm on m_mdm.ModuleId = m_md.ModuleId inner join ".tbl_menus." m_me on m_me.MenuId = m_mdm.MenuId inner join ".tbl_useracl." m_rp on m_rp.ModuleMenuId = m_mdm.ModuleMenuId inner join ".tbl_users." m_us on m_us.RoleId = m_rp.RoleId and m_us.IsActive = '1' WHERE m_rp.RoleId=".$_SESSION['RoleId']." and m_md.IsActive = '1' and m_mdm.IsActive = 1 and m_me.IsActive = 1 and m_rp.IsActive = 1  group by m_rp.ModuleMenuId order by m_me.SortingOrder, m_mdm.MenuId, m_mdm.SortingOrder ";	
		
	} 	
	return $db->get_rsltset($select_mnu); 

}

function getTopMenuModuleArray($db, $RoleId=null,$admin_id=null,$MnuId) 
{

	$str_Pra="";
	if($admin_id != '' && $_SESSION['RoleId'] != '0') 
	{ 
		$strmenu=" m_us.UserId = '".$admin_id."' and m_md.IsActive=1 ";
		if($_SESSION['RoleId']==1)
			$strmenu=" m_md.IsActive=1 and m_rp.RoleId=1 ";

	  	 $select_modm = "SELECT m_me.MenuName,m_md.ModuleName, m_md.ModulePath,m_md.Description, m_rp.ModuleMenuId,m_me.moduleicon FROM ".tbl_modules." m_md inner join ".tbl_modulemenus." m_mdm on m_mdm.ModuleId = m_md.ModuleId inner join ".tbl_menus." m_me on m_me.MenuId = m_mdm.MenuId inner join ".tbl_useracl." m_rp on m_rp.ModuleMenuId = m_mdm.ModuleMenuId inner join ".tbl_users." m_us on m_us.RoleId = m_rp.RoleId and m_us.IsActive = '1' WHERE m_rp.RoleId=".$_SESSION['RoleId']."  and m_me.IsActive = 1 and m_md.IsActive=1 and m_mdm.MenuId = ".$MnuId." and m_rp.IsActive = 1  and m_mdm.IsActive = 1 group by m_rp.ModuleMenuId order by m_me.SortingOrder, m_mdm.MenuId, m_mdm.SortingOrder ";
	}		

	return $db->get_rsltset($select_modm); 
}


function getModuleTitle($db,$modulePath){
	$str_Pra="";	 	
	$select_modm = "SELECT ModuleName FROM ".tbl_modules." where ModulePath = '$modulePath' ";		
	return $db->get_rsltset($select_modm); 
}


function getAdminUsrDet($db, $RoleId=null,$admin_id=null) 
{

	$str_Pra="";
	if($admin_id != '' && $_SESSION['RoleId'] != '0') 
	{ 
		$select_mnu = "SELECT user_photo from ".tbl_users." where IsActive = 1 and user_ID = $admin_id";			
	} 	
	return $db->get_a_line($select_mnu); 

}


function getDashbrdCounts($db,$mdl=null,$typ=null)
{

	$datecheck = " and (MONTH(t1.date_added) = '".date('m')."' and YEAR(t1.date_added) = '".date('Y')."')";

	if($mdl == 'order')
	{
		$strcount = "  select sum(a.total) as total, sum(a.pending)as pending, sum(a.confirmed) as confirmed, sum(a.canceled) as canceled, sum(a.delivered) as delivered from (select count(order_id) as total, 
	case when order_status_id = 1 then count(order_id) else 0 end as pending, 
	case when order_status_id = 2 then count(order_id) else 0 end as confirmed, 
	case when order_status_id = 5 then count(order_id) else 0 end as canceled,
	case when order_status_id = 14 then count(order_id) else 0 end as delivered 
	from ".TPLPrefix."orders where 1=1  and (MONTH(date_added) = '".date('m')."' and YEAR(date_added) = '".date('Y')."') group by order_status_id) a ";
	 //echo $strcount; exit;
	 
		return $db->get_a_line($strcount); 
	}
	
	if($mdl == 'sales')
	{
		
		$strcount=" SELECT *
FROM (SELECT cur.currencysymbol,
             cur.currencyid,
             cnfg.key,
             CASE
                WHEN cnfg.key = 'defaultcurrency'
                THEN
                   count(t1.order_currency_id)
             END
                AS defcnt,
             CASE
                WHEN cnfg.key = 'defaultcurrency' THEN 0
                ELSE count(t1.order_currency_id)
             END
                AS othrcnt,
             CASE
                WHEN cnfg.key = 'defaultcurrency'
                THEN
                   format(sum(t1.grand_total), 2,'en_IN')
                ELSE
                   0
             END
                AS deftotal,
              CASE   
              WHEN cnfg.key = 'defaultcurrency'
                THEN
                   format(sum(t1.total_paid_tax_incl - t1.total_paid_tax_excl), 2,'en_IN')
                ELSE
                   0
             END
              
                AS taxamt
      FROM ".TPLPrefix."orders t1
           LEFT JOIN ".TPLPrefix."order_status t2
              ON     t2.order_statusId = t1.order_status_id
                 AND t1.order_status_id = 2
           INNER JOIN ".TPLPrefix."currency cur
              ON     cur.currencyid = t1.order_currency_id
                 AND t1.order_status_id = 2
           LEFT JOIN ".TPLPrefix."configuration cnfg
              ON     cnfg.key = 'defaultcurrency'
                 AND cnfg.value = cur.currencyid
                 AND cur.IsActive = 1
				  where 1=1 ".$datecheck."
      GROUP BY t1.order_currency_id) a
     INNER JOIN ".TPLPrefix."currency b ON b.currencyid = a.currencyid
	
ORDER BY CASE WHEN `key` = 'defaultCurrency' THEN 0 ELSE 1 END ";

		//echo $strcount; exit;
//	print_r($db->get_a_line($strcount)); die();
	
		return $db->get_rsltset($strcount); 
	}
	
	if($mdl == 'products')
	{
		//$strcount = "select case when IsActive = 0 then count(product_id) else 0 end as inactcnt,(select count(t1.product_id) as lowstock from (SELECT product_id,quantity as subqty  FROM `".TPLPrefix."product` prd union select base_productId, quantity as subqty from ".TPLPrefix."product_attr_combi  attr ) t1 where t1.subqty < (select value from ".TPLPrefix."configuration where unicode = 'minimumStock' and  IsActive = 1)   ) as lowstockcnt from ".TPLPrefix."product where IsActive = 0";
 
 		$strcount = "select sum(a.activecunt) as activep,sum(a.actcnt) as total, sum(a.inactcnt) as inactcnt ,Sum(a.soldoutcnt) as soldoutcnt, a.lowstockcnt as lowstockcnt from( select  count(product_id) as actcnt,case when IsActive = 0 then count(IsActive) else 0 end as inactcnt, case when IsActive = 1 then count(IsActive) else 0 end as activecunt,case when soldout = 1 then count(soldout) else 0 end as soldoutcnt,(select count(t1.product_id) as lowstock from (SELECT product_id,quantity as subqty  FROM `".TPLPrefix."product` prd 
union select base_productId, quantity as subqty from ".TPLPrefix."product_attr_combi
 attr ) t1 where t1.subqty < (select value from ".TPLPrefix."configuration where unicode = 'minimumStock' and
 IsActive = 1)   ) as lowstockcnt from ".TPLPrefix."product where IsActive in(1,0) group by IsActive) a";
 		
		return $db->get_a_line($strcount); 
	}
	
	if($mdl == 'customers')
	{ 
 	    $strcount = "SELECT  count(*) as totcust, (SELECT count(*) FROM `".TPLPrefix."customers` WHERE IsActive = 0) as custinact,
		sum(case when customer_group_id=1 and customer_id is not null  then '1' else '0' end) as customer,
		sum(case when customer_group_id=2 and customer_id is not null  then '1' else '0' end) as coroprate						
		FROM `".TPLPrefix."customers` where IsActive <> 2"; 	
		
		
		return $db->get_a_line($strcount); 
	}
	
	if($mdl == 'activity')
	{ 
 		$strcount = "SELECT  * FROM `".TPLPrefix."customerlog` order by loggedDate desc limit 0, 5"; 		
		return $db->get_rsltset($strcount); 
	}
	
	if($mdl == 'custorders')
	{ 
 		 $strcount = "SELECT t1.order_id, t1.order_reference, t1.email, t1.date_added,format(t1.total,2), t2.order_statusName as order_status, 
				t3.customer_email as  orderDetails, concat(t3.customer_firstname,' ',t3.customer_lastname) as Customer_Names,
				(SELECT AttributeValue FROM ".TPLPrefix."cus_attribute_tbl1 a1
				INNER JOIN 	".TPLPrefix."customfields_attributes a2 on a1.AttributeId = a2.AttributeId
				WHERE a1.customer_id = t1.customer_id and a2.AttributeCode = 'Customer Name') as Customer_Name
				FROM  `".TPLPrefix."orders` t1 
				inner join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id
				inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id where 1=1 ".$datecheck." order by t1.date_modified DESC limit 0,5"; 
			
		return $db->get_rsltset($strcount); 
	}
}
	

function DisplaypageName($db,$pagename){
	
	$getdata = $db->get_a_line("select * from ".tbl_modules." where ModulePath = '".trim($pagename)."'");	
	return $getdata['ModuleName'];
}
?>