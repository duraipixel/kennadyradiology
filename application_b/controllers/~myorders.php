<?php
class myorders extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	
	 	$template = $this->loadView('myorders_view');
		
		$headcss='<meta name="description" content="Tamail Nadu Travel Mart">
				  <meta name="keywords" content="TTMS">
				  
				   <title>Wide range of Corporate Gifts , Trophies ,Mementos and much more at best prices</title>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
