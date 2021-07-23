<?php 
 
if($_SESSION["UserId"] != '' && $_SESSION['RoleId'] != '0') {
	 
	if($mdme != '')
     $sel_modm_prm = "SELECT m_rp.AddPrm, m_rp.EditPrm, m_rp.DeletePrm, m_rp.ViewPrm, m_rp.ApprovalPrm, m_rp.IsActive FROM ".tbl_useracl." m_rp inner join ".tbl_users." m_us on m_us.RoleId = m_rp.RoleId WHERE  m_rp.ModuleMenuId = '".base64_decode($mdme)."' and m_rp.RoleId=".$_SESSION['RoleId']."  group by m_rp.ModuleMenuId";
	else
	  	$sel_modm_prm = "SELECT m_rp.AddPrm, m_rp.EditPrm, m_rp.DeletePrm, m_rp.ViewPrm, m_rp.ApprovalPrm, m_rp.IsActive FROM ".tbl_useracl." m_rp inner join ".tbl_users." m_us on m_us.RoleId = m_rp.RoleId WHERE  m_rp.ModuleMenuId = '".base64_decode($_REQUEST['mdme'])."' and m_rp.RoleId=".$_SESSION['RoleId']."  group by m_rp.ModuleMenuId";
 
// echo $sel_modm_prm;die();
 	$res_modm_prm = $db->get_a_line($sel_modm_prm);
	
	
	
} 

?>

