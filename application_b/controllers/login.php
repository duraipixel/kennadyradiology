<?php
class login extends Controller {
	function index()
	{
	    if($_SESSION['GP_Cus_ID']!=''){

			 $this->redirect('my-account');
		    exit;
		}
		$common=$this->loadModel('common_model');
		$configmetatag = $common->common_metatag("config");
		 $helper=$this->loadHelper('common_function'); 
		  $helper->unsetguestchkout();	
	 	$template = $this->loadView('login_view');
		
		$headcss='<title>Login-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
		$template->set('getBannerSlider',$getBannerSlider);
		$template->set('pageview','login');
	 
		$template->render();	
		
    
	}

	

}

?>
