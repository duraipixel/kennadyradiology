<?php
class manage_address extends Controller {
	function index()
	{
	    if($_SESSION['Cus_ID']==''){
			$this->redirect('login');
			exit;
		}
		$common=$this->loadModel('user_model');
	    $commonmodel=$this->loadModel('common_model');
		$temp_cus_id=$_SESSION['Cus_ID'];
		if($temp_cus_id=="")
		{
			$temp_cus_id=session_id();
		}
		$getmanageaddressdisplay  = $common->getmanageaddressdisplay($temp_cus_id);
		$getmanageaddress_autofill  = $common->getmanageaddress_autofill($_SESSION['Cus_ID']);
		$configmetatag = $commonmodel->common_metatag("config");
		$getmyaccountdetails  = $commonmodel->getmyaccountdetails($_SESSION['Cus_ID']);
		
	 	$template = $this->loadView('manage_address_view');
		
		$headcss='<title>Manage_address-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getmanageaddressdisplay',$getmanageaddressdisplay);
	$template->set('getmanageaddress_autofill',$getmanageaddress_autofill);
	$template->set('getmyaccountdetails',$getmyaccountdetails);
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
