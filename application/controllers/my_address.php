<?php
class my_address extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		 
	    if($_SESSION['Cus_ID']==''){
			$this->redirect('login');
			exit;
		}
		$common=$this->loadModel('user_model');
	    $commonmodel=$this->loadModel('common_model');
	    $helper=$this->loadHelper('common_function'); 
		$temp_cus_id=$_SESSION['Cus_ID'];
		if($temp_cus_id=="")
		{
			$temp_cus_id=session_id();
		}
		$getmanageaddressdisplay  = $common->getmanageaddressdisplay($temp_cus_id);
		$getmanageaddress_autofill  = $common->getmanageaddress_autofill($_SESSION['Cus_ID']);
		$configmetatag = $commonmodel->common_metatag("config");
		$getmyaccountdetails  = $commonmodel->getmyaccountdetails($_SESSION['Cus_ID']);
		
	 	$template = $this->loadView('my_address_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>My Address :: Kiran eCom</title>';
		$template->set('menu_disp', 'my_address');	 
	    $template->set('headcss',$headcss);
        $template->set('helper',$helper);
        $template->set('getmanageaddressdisplay',$getmanageaddressdisplay);
        $template->set('getmanageaddress_autofill',$getmanageaddress_autofill);
        $template->set('getmyaccountdetails',$getmyaccountdetails);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	 	$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
