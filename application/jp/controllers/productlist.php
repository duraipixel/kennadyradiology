<?php
class productlist extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	$configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('productlist_view');
		
		$headcss='<title>'.$configmetatag['title'].' Products</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  
				  
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
