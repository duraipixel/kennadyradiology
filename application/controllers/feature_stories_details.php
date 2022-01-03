<?php
class feature_stories_details extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'featurestoriesdetails');
			
	 	$template = $this->loadView('feature_stories_details_view');
			    $configmetatag = $common->common_metatag("config");
				$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['featurestoriesdetails'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'feature_stories_details');	 
	    $template->set('headcss',$headcss);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
