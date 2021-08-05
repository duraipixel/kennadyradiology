<?php
class terms_conditions extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function'); 
		$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'termscondition');
	 	$template = $this->loadView('terms_conditions_view');
		 $configmetatag = $common->common_metatag("config");
					$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
					
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['termsandcondition'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'terms_conditions');	 
	    $template->set('headcss',$headcss);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		$template->render();		
		
	}
}

?>
