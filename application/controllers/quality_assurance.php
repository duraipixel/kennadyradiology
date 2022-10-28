<?php
class quality_assurance extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
	 	$template = $this->loadView('quality_assurance_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>Quality Assurance :: Kiran eCom</title>';
		$template->set('menu_disp', 'quality_assurance');	 
	    $template->set('headcss',$headcss);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
