<?php
class events extends Controller {
	
	function index($page,$code=null)
	{	
	
 			$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
		
		//header
		 
		 
		$getpagecount=$common->getStoreInfo('productsPerpage');
		
		 
		
		if($code == ''){
			//News - 1
			
				$newsList=$common->getEventsList('','',$getpagecount);

				
			$newsListcount=$common->getEventsList('','','');
			$getyearlist = $common->geteventyear();
			
		
			$template = $this->loadView('events_view');
			
					if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                 $url = "https://";   
            else  
                 $url = "http://";   
            // Append the host(domain name, ip) to the URL.   
            $url.= $_SERVER['HTTP_HOST'];   
            
            // Append the requested resource location to the URL   
            $url.= $_SERVER['REQUEST_URI'];    
            
  
			$headcss='<link rel="canonical" href="'.$url.'" />';
			$headcss.='<meta name="description" content="Stay updated with the latest feature stories about Trivitron Healthcare Solutions. For more information, visit our website.">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>Events</title>';

		 $template->set('headcss',$headcss);
		 
			//header menu
			$template->set('MenucatList', $MenucatList);
			$template->set('MenuspeList', $MenuspeList);
			$template->set('getpagecount', $getpagecount);
			$template->set('getyearlist',$getyearlist);
			$template->set('getcountry',$getcountry);
			
			$template->set('newsList', $newsList);
			$template->set('newsListcount', $newsListcount);
			
			$template->render();
		}
		
		else
		{					
				$newsDetail=$common->getEventsList($code,'',$getpagecount);
				//print_r($newsDetail);
 				
				$getnewsImages=$common->getEventsImage($newsDetail[0]['eventid']);
				
				$newsnextprev=$common->getpreviousnext_events($newsDetail[0]['eventid']);
				
				$template = $this->loadView('events_detail_view');
				 
                $headcss='<meta name="description" content="'.strip_tags($storyDetail[0]['eventdescription']).'">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>'.strip_tags($storyDetail[0]['eventtitle']).'</title>';
		 $template->set('headcss',$headcss);
		 
		 
				
				$template->set('newsDetail', $newsDetail);
 				$template->set('getpagecount', $getpagecount);
				$template->set('newsnextprev', $newsnextprev);
				$template->set('getcountry',$getcountry);
				$template->set('newsImg',$getnewsImages);
				$template->set('MenucatList', $MenucatList);
			$template->set('MenuspeList', $MenuspeList);
				
				$template->render();
		}
	}		
	
	 
}

?>