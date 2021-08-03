<?php
class verification extends Controller {
	function index($fun='',$verificationcode='')
	{
		
	   // session_unset(); 
		//print_r($_SESSION);
		$_SESSION['Cus_ID']='';
		$common=$this->loadModel('user_model');
		$commonmodel=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function'); 
		$Register_activation = $common->Register_activation($verificationcode);
		//echo "<pre>"; print_r($Register_activation); exit;
	    $configmetatag = $commonmodel->common_metatag("config");
	$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');

	$template = $this->loadView('verification_view');
		$headcss='<title>Verification-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
$template->set('msgdisplaylanguage',$msgdisplaylanguage);
	// menu	
	$template->set('Register_activation',$Register_activation);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>