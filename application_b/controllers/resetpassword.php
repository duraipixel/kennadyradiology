<?php
class resetpassword extends Controller {
	function index($controler,$resetpasscode)
	{
	    
		$common=$this->loadModel('common_model');
		$reset_password = $common->reset_password($resetpasscode);
	    $configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('resetpassword_view');
		
	$headcss='<title>Resetpassword-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('reset_password',$reset_password);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>