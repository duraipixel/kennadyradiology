<?php
class my_account extends Controller {
	function index()
	{
	    
	    if($_SESSION['Cus_ID']==''){
			$this->redirect_301('login');
			exit;
		}
		$_SESSION['refererurl'] = '';
		
 		$common=$this->loadModel('common_model');
 		$getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
		$getsubscribedetails  = $common->getsubscribedetails($_SESSION['emailid']);
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
		$configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('my_account_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>My Account :: Kiran eCom</title>';
		$template->set('menu_disp', 'my_account');	 
	    $template->set('headcss',$headcss);
        $template->set('getmyaccountdetails',$getmyaccountdetails);
        $template->set('getsubscribedetails',$getsubscribedetails);
		//print_r($getRproductcat);		exit;
		 
	 
	 	//$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
