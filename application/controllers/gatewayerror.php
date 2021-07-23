<?php
class gatewayerror extends Controller {
	function index()
	{
	    
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('gatewayerror');
		
		$headcss='<title>Registeractivation-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);

		$template->render();	
   
    
	}		

}

?>