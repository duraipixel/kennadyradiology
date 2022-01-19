<?php
class knowledgecenter_details extends Controller {
	function index($code=null,$slug=null)
	{
 		$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
			
			$getknowledgecategory = $helper->knowledgecenterCategory();
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'knowledgecenter');
			
			$knowledgecenterlist = $helper->knowledgecenterlist($slug,2);
			$knowledgenextprev=$helper->getpreviousnext_knowledgecenterlist($knowledgecenterlist[0]['knowledgecenterid']);
			
	 	$template = $this->loadView('knowledgecenter_details_view');
			    $configmetatag = $common->common_metatag("config");
				$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'knowledgecenter');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['knowledgecenter'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'feature_stories');	 
	    $template->set('headcss',$headcss);
		$template->set('getknowledgecategory',$getknowledgecategory);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		$template->set('pagecode',$slug);
		$template->set('knowledgecenterlist',$knowledgecenterlist);
		$template->set('helper',$helper);
		$template->set('knowledgenextprev',$knowledgenextprev);
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
