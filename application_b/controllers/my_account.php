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
		//print_r($getsubscribedetails); exit;
		$configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('my_account_view');
		
		$headcss='<title>'.$configmetatag['title'].' My Account</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getmyaccountdetails',$getmyaccountdetails);
	$template->set('getsubscribedetails',$getsubscribedetails);
	//$template->set('url',$_SESSION['refererurl']);
	//$template->set('type',$_SESSION['type']);
	//$template->set('pid',$_SESSION['productid']);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
