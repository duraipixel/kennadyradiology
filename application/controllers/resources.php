<?php
class resources extends Controller {
	function index()
	{
	
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
		$getcontactformdetails = $common->getcontactformdetails($_SESSION['Cus_ID']);
		
	 	$template = $this->loadView('resource_view');
		
		$headcss='<title>'.$configmetatag['title'].' Resources</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getcont',$getcontactformdetails);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
