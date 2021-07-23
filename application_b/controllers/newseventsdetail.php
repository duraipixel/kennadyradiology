<?php
class newseventsdetail extends Controller {
	function index()
	{
	   
		$common=$this->loadModel('common_model');
	    $newsevents=$this->loadModel('newsevents_model');
		$getmemberoflogo  = $common->getourclientslogo("client");
		$newseventsdetails  = $newsevents->newseventsdetails();
		$configmetatag = $commonmodel->common_metatag("config");
		
		
	 	$template = $this->loadView('newseventsdetail_view');
		
		$headcss='<title>Newseventsdetail-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('newseventsdetails',$newseventsdetails);
    $template->set('getourclientslogo',$getmemberoflogo);
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
