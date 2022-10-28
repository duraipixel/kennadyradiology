<?php
class login extends Controller {
	function index()
	{
	    
	    if( $_SESSION['Cus_ID'] != '' ) {
			$this->redirect( 'my-account' );
		    exit;
		}
		
 		$common 				= $this->loadModel('common_model');
		$configmetatag 			= $common->common_metatag("config");
		$helper 				= $this->loadHelper('common_function'); 
		$helper->unsetguestchkout();	
		$logindisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'login');
		$formdisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'form');
		$metadisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'meta');
		
		$headcss 				= '<title>'.$configmetatag['title'].' '.$metadisplaylanguage['login'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template 				= $this->loadView('login_view');	  
		$template->set('menu_disp', 'login');	 
	    $template->set('headcss',$headcss);
		$template->set('logindisplaylanguage',$logindisplaylanguage);
		$template->set('formdisplaylanguage',$formdisplaylanguage);
	 	$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
