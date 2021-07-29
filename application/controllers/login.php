<?php
class login extends Controller {
	function index()
	{
	    
	    if($_SESSION['Cus_ID']!=''){

			 $this->redirect('my-account');
		    exit;
		}
		
 		$common=$this->loadModel('common_model');
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
		
		$configmetatag = $common->common_metatag("config");
		 $helper=$this->loadHelper('common_function'); 
		  $helper->unsetguestchkout();	
		  $logindisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'login');
		  $formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
	 	$template = $this->loadView('login_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>Login :: Kiran eCom</title>';
		$template->set('menu_disp', 'login');	 
	    $template->set('headcss',$headcss);
		 $template->set('logindisplaylanguage',$logindisplaylanguage);
		  $template->set('formdisplaylanguage',$formdisplaylanguage);
		//print_r($getRproductcat);		exit;
		 
	 
	 	$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
