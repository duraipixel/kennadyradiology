<?php
function getQuerys($db,$qryOperation,$arg=null)
{
	
$strQry="";
//echo 'jjj'; die();
	switch(strtolower($qryOperation))
	{
		case strtolower("storename") : 		
							$qryconfig="SELECT distinct cnfg.configureId,cnfg.storeId, cnfg.key, cnfg.value as storeName,cnfg.IsActive FROM ".TPLPrefix."configuration cnfg 
										INNER JOIN ".TPLPrefix."configuration cnf ON cnf.uniCode = 'store_name'
										WHERE cnfg.IsActive <>2  GROUP BY cnfg.storeId ";


								$resinfo=$db->get_a_line($qryconfig);
							
							break;
		case strtolower("datetimezone") : 		
							$qryconfig="SELECT distinct cnfg.value  FROM ".TPLPrefix."configuration cnfg 
									   WHERE cnfg.IsActive <>2 and cnfg.uniCode = 'datetimezone' GROUP BY cnfg.storeId ";

								$resinfo=$db->get_a_line($qryconfig);
							
							break;	
		case strtolower("getdateformat") : 		
							$qryconfig="SELECT distinct d.dateformat,d.phpformat FROM ".TPLPrefix."configuration cnfg 
									   inner join ".TPLPrefix."dateformat d on d.dfid=cnfg.value and d.IsActive=1
									   WHERE cnfg.IsActive <>2 and cnfg.uniCode = 'dateFormat' GROUP BY cnfg.storeId ";

								$resinfo=$db->get_a_line($qryconfig);
							
							break;						
							
		case strtolower("isconfigurable") : 		
						 $qryconfig="SELECT distinct cnfg.value  FROM ".TPLPrefix."configuration cnfg 
									   WHERE cnfg.IsActive <>2 and cnfg.uniCode = 'IsConfigureProduct' GROUP BY cnfg.storeId ";

								$resinfo=$db->get_a_line($qryconfig);
							
							break;	
							
		case strtolower("IsCategoryCustomerGroup") : 		
						
						$qryconfig="SELECT distinct cnfg.value  FROM ".TPLPrefix."configuration cnfg 
									WHERE cnfg.IsActive <>2 and cnfg.uniCode = 'IsCategoryCustomerGroup' GROUP BY cnfg.storeId ";

								$resinfo=$db->get_a_line($qryconfig);
							
							break;	
							
		case "allconfigurable" : 		
						 $qryconfig="SELECT  cnfg.key, cnfg.value  FROM ".TPLPrefix."configuration cnfg 
									   WHERE cnfg.IsActive <>2   ";
                               
								$resinfo=$db->get_rsltset($qryconfig);

							break;		
		case strtolower("IsCategoryCustomerGroup") : 		
						
						$qryconfig="SELECT distinct cnfg.value  FROM ".TPLPrefix."configuration cnfg 
									WHERE cnfg.IsActive <>2 and cnfg.uniCode = 'IsCategoryCustomerGroup' GROUP BY cnfg.storeId ";

								$resinfo=$db->get_a_line($qryconfig);
							
							break;							
							
		default :
						$qryconfig="SELECT distinct cnfg.value  FROM ".TPLPrefix."configuration cnfg 
							WHERE cnfg.IsActive <>2 and cnfg.uniCode = '".$qryOperation."' GROUP BY cnfg.storeId ";

						$resinfo=$db->get_a_line($qryconfig);
								
	}
	
	return $resinfo;
}
?>