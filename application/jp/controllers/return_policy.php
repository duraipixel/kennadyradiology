<?php
class return_policy extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function'); 
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'returnpolicy');
				    $configmetatag = $common->common_metatag("config");
					$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
	 	$template = $this->loadView('return_policy_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['returnpolicy'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'return_policy');	 
	    $template->set('headcss',$headcss);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		$template->render();		
		
	}
}

?>
