<?php
class about_trivitron extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
	 	$template = $this->loadView('about_trivitron_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>About Trivitron :: Kennady</title>';
		$template->set('menu_disp', 'about_trivitron');	 
	    $template->set('headcss',$headcss);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
