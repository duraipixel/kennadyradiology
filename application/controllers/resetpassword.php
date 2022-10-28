<?php
class resetpassword extends Controller {

	function index($controler,$resetpasscode)
	{
	    
		$common 				= $this->loadModel('common_model');
		$helper 				= $this->loadHelper('common_function'); 
		$reset_password 		= $common->reset_password($resetpasscode);
	    $configmetatag 			= $common->common_metatag("config");
		$logindisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'login');
		
		$headcss 				= '<title>Resetpassword-'.$configmetatag['title'].'</title>
									<meta name="description" content="'.$configmetatag['description'].'">
									<meta name="keywords" content="'.$configmetatag['keyword'].'">
									<meta name="robots" content="noindex"/>';
		
		$template 				= $this->loadView('resetpassword_view');
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('logindisplaylanguage',$logindisplaylanguage);
		$template->set('reset_password',$reset_password);
		$template->render();	
    
	}		

}

?>