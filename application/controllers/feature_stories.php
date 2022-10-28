<?php
class feature_stories extends Controller {
	
	function index($page,$code=null)
	{	
 			$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
		
		//header
		 
		 
		$getpagecount=$common->getStoreInfo('productsPerpage');
		
		 
		
		if($code == ''){
			//News - 1
			
			$storylist=$common->getFeaturestoriesList('','',$getpagecount);
			$storylistcount=$common->getFeaturestoriesList('','','');
			$getyearlist = $common->getfeatureyear();
			
		
			$template = $this->loadView('featurestories_view');
			
					if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                 $url = "https://";   
            else  
                 $url = "http://";   
            // Append the host(domain name, ip) to the URL.   
            $url.= $_SERVER['HTTP_HOST'];   
            
            // Append the requested resource location to the URL   
            $url.= $_SERVER['REQUEST_URI'];    
            
  
			$headcss='<link rel="canonical" href="'.$url.'" />';
			$headcss.='<meta name="description" content="Read our Latest News and Events from Kennedy Radiology">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>Latest News and Stories - Kennedy Radiology</title>';

		 $template->set('headcss',$headcss);
		 
			//header menu
			$template->set('MenucatList', $MenucatList);
			$template->set('MenuspeList', $MenuspeList);
			$template->set('getpagecount', $getpagecount);
			$template->set('getyearlist',$getyearlist);
			$template->set('getcountry',$getcountry);
			
			$template->set('storylist', $storylist);
			$template->set('storylistcount', $storylistcount);
			
			$template->render();
		}
		
		else
		{					
				$storyDetail=$common->getFeaturestoriesList($code,'',$getpagecount);
			 	$storynextprev=$common->getpreviousnext_Featurestories($storyDetail[0]['FsId']);
				
				 
				$template = $this->loadView('featurestories_detail_view');
				/*
				$headcss='<meta name="description" content="'.$getmetaStore['metadesc'].'">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>'.$getmetaStore['metatitle'].'</title>';
                */
                $headcss='<meta name="description" content="Read our Latest News and Events from Kennedy Radiology">
		<meta name="keywords" content="'.$getmetaStore['metakey'].'">
		<title>Latest News and Stories - Kennedy Radiology</title>';
		 $template->set('headcss',$headcss);
				
				$template->set('storyDetail', $storyDetail);
 				$template->set('getpagecount', $getpagecount);
				$template->set('storynextprev', $storynextprev);
				$template->set('getcountry',$getcountry);
				
				$template->set('MenucatList', $MenucatList);
			$template->set('MenuspeList', $MenuspeList);
				
				$template->render();
		}
	}		
	
	 
}

?>