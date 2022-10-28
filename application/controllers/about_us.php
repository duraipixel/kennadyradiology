<?php
class about_us extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
	 	$template = $this->loadView('about_us_view');
		
		$headcss='<meta name="description" content="The Kennedy Company became part of the Trivitron Group, a well-established multinational medical device conglomerate. Read more">
				  <meta name="keywords" content=" ">
				  
				  <title>About Our Company - Kennedy Radiology</title>';
		$template->set('menu_disp', 'about_us');	 
	    $template->set('headcss',$headcss);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
