<?php
class medical_radiation_leading_cause_of_skin_cancer extends Controller {
	function index($code=null,$slug=null)
	{
 		$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
			
			$getknowledgecategory = $helper->knowledgecenterCategory();
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'medical_radiation_leading_cause_of_skin_cancer');
			
			$knowledgecenterlist = $helper->knowledgecenterlist($slug,1);
			
			
			
	 	$template = $this->loadView('medical_radiation_leading_cause_of_skin_cancer_view');
			    $configmetatag = $common->common_metatag("config");
				$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'medical_radiation_leading_cause_of_skin_cancer');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['medical_radiation_leading_cause_of_skin_cancer'].'</title>
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
