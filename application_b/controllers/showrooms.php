<?php
class showrooms extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
		$getbannerdisplay  = $common->getbannerdisplay("Main Banner");
	 	$template = $this->loadView('showroom_view');
		
		$headcss='<title>Showrooms-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('getbannerdisplay',$getbannerdisplay);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
