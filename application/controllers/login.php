<?php
class login extends Controller {
	function index()
	{
	    
	    if($_SESSION['Cus_ID']!=''){

			 $this->redirect('my-account');
		    exit;
		}
		
 		$common=$this->loadModel('common_model');
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
		
		$configmetatag = $common->common_metatag("config");
		 $helper=$this->loadHelper('common_function'); 
		  $helper->unsetguestchkout();	
		  
	 	$template = $this->loadView('login_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>Login :: Kiran eCom</title>';
		$template->set('menu_disp', 'login');	 
	    $template->set('headcss',$headcss);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	 	$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
