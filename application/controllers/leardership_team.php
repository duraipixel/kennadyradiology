<?php
class leadership_team extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
	 	$template = $this->loadView('leadership_team_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>Leadership Team :: Kennady</title>';
		$template->set('menu_disp', 'leadership_team');	 
	    $template->set('headcss',$headcss);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
