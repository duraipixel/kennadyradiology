<?php
class News extends Controller {
	
	function index($page=null,$code=null)
	{
		 
		$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
		$getpagecount=$common->getStoreInfo('productsPerpage');
		if($code == ''){
			//News - 1
 			$newsList=$common->getNewsInitiativeList('1','','',$getpagecount);
			
			$getyearlist = $common->getnewyear('1');
			$newsListcount=$common->getNewsInitiativeList('1','','','');
			$template = $this->loadView('news_view');
			
					if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                 $url = "https://";   
            else  
                 $url = "http://";   
            // Append the host(domain name, ip) to the URL.   
            $url.= $_SERVER['HTTP_HOST'];   
            
            // Append the requested resource location to the URL   
            $url.= $_SERVER['REQUEST_URI'];    
            
  
			$headcss='<link rel="canonical" href="'.$url.'" />';
				$headcss.='<meta name="description" content="">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>News Updates | Top Stories </title>';
 		$template->set('headcss',$headcss);
		 
		 $template->set('getpagecount', $getpagecount);
			 
			$template->set('getyearlist',$getyearlist);
			$template->set('newsList', $newsList);
			$template->set('newsListcount',$newsListcount);
			$template->set('getmenucategory',$getmenucategory);
			$template->render();
		}
		
		else
		{			$newsDetail=$common->getNewsInitiativeList('1',$code,'',$getpagecount);
 
				$getnewsImages=$common->getNewsImage($newsDetail[0]['newsid']);
				$newsnextprev=$common->getpreviousnext_news($newsDetail[0]['newsid']);
				
				$template = $this->loadView('news_detail_view');
				
				$headcss='<meta name="description" content="'.strip_tags($storyDetail[0]['newsdescription']).'">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>'.strip_tags($storyDetail[0]['newstitle']).'</title>';
		 $template->set('headcss',$headcss);
				

		 $template->set('headcss',$headcss);
				
				$template->set('newsDetail', $newsDetail);
				$template->set('newsImg', $getnewsImages);
				$template->set('getpagecount', $getpagecount);
				$template->set('newsnextprev', $newsnextprev);
				$template->set('getcountry',$getcountry);
				$template->set('MenucatList', $MenucatList);
			$template->set('MenuspeList', $MenuspeList);
				$template->render();
		}
	}		
	
	 
}

?>
