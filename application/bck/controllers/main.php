<?php
class Main extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		
		$OnGoingProjectList=$common->getOnGoingProjectList();
		$UpComingProjectList=$common->getUpComingProjectList();
		$TestimonialsList=$common->getTestimonialsList();
		
	 	$template = $this->loadView('home_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title> Welcom to Kiran eCom </title>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('common', $common);
		$template->set('getOnGoingProjectList', $OnGoingProjectList);
		$template->set('getUpComingProjectList', $UpComingProjectList);
		$template->set('getTestimonialsList', $TestimonialsList);
		$template->render();		
		
	}
}

?>
