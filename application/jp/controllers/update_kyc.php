<?php
class update_kyc extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
		$businesscustomer = $common->businesscustomer_details();
	 	$template = $this->loadView('update_kyc_view');
		
		
		$headcss='<title>Update_KYC-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	//$template->set('getBannerSlider',$getBannerSlider);
	$template->set('businesscustomer',$businesscustomer);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
