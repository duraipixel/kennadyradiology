<?php
class view_catalogue extends Controller {
	function index()
	{
	    
		 if($_SESSION['Cus_ID']==''){
			$this->redirect('login');
			exit;
		}
		
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('view_catalogue_view');
		
		$headcss='<title>View_catalogue-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getBannerSlider',$getBannerSlider);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
