<?php
class news_events extends Controller {
	function index($controller='',$eventcode='')
	{
	
	    $common=$this->loadModel('common_model');
		$newsevents=$this->loadModel('newsevents_model');
		$configmetatag = $common->common_metatag("config");
		
		$getmemberoflogo  = $common->getourclientslogo("client");
		
		if($eventcode==''){
	    $getnewseventslist  = $newsevents->getnewsevents();
	 	$template = $this->loadView('newsevents_view');
		
		$headcss='<title>Newseventslist-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('getnewseventslist',$getnewseventslist);
		}
		else if($eventcode!='')
		{
			$newseventsdetails  = $newsevents->newseventsdetails($eventcode);		
			$template = $this->loadView('newseventsdetail_view');
			
			$headcss='<title>Newseventsdetails-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('newseventsdetails',$newseventsdetails);
			
		}
		$template->set('getourclientslogo',$getmemberoflogo);
	
		$template->render();	
   
    
	}		

}

?>
