<?php
class musculoskeletal_health extends Controller {
	function index($code=null,$slug=null)
	{
 		$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
			
			$getknowledgecategory = $helper->knowledgecenterCategory();
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'musculoskeletal_health');
			
			$knowledgecenterlist = $helper->knowledgecenterlist($slug,1);
			
			
			
	 	$template = $this->loadView('musculoskeletal_health_view');
			    $configmetatag = $common->common_metatag("config");
				$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'musculoskeletal_health');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['musculoskeletal_health'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'feature_stories');	 
	    $template->set('headcss',$headcss);
		$template->set('getknowledgecategory',$getknowledgecategory);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		$template->set('pagecode',$slug);
		$template->set('knowledgecenterlist',$knowledgecenterlist);
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
