<?php
class change_password extends Controller {
	function index()
	{
		
	    if($_SESSION['Cus_ID']==''){
			$this->redirect('login');
			exit;
		}
		
		$common=$this->loadModel('common_model');
	     $configmetatag = $common->common_metatag("config");
		 $getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
	 	$template = $this->loadView('change_password_view');
		
		
		$headcss='<title>Change_password-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	
	$template->set('getmyaccountdetails',$getmyaccountdetails);
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
