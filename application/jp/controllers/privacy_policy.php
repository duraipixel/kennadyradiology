<?php
class privacy_policy extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function'); 
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'privacypolicy');
		 $configmetatag = $common->common_metatag("config");
					$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
					
	 	$template = $this->loadView('privacy_policy_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['privacypolicy'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'privacy_policy');	 
	    $template->set('headcss',$headcss);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		$template->render();		
		
	}
}

?>
