<?php
class dealers extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	    $individual_dealer=$common->getdynamicformfields('individual_dealer');
		//print_r($individual_dealer); exit;
		$brand_dealer=$common->getdynamicformfields('brand_dealer');
		//print_r($individual_dealer); exit;
		$configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('dealers_view');
		
		$headcss='<title>Dealers-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	$template->set('individual_dealer',$individual_dealer);
	$template->set('individualtable','individual_dealer'); //set individual_dealer table name
	$template->set('brand_dealer',$brand_dealer);
	$template->set('brandtable','brand_dealer'); //set individual_dealer table name
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
