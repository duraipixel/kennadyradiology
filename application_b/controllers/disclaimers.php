<?php
class disclaimers extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	     $configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('disclaimers_view');
		
		$headcss='<title>'.$configmetatag['title'].' Disclaimers</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
