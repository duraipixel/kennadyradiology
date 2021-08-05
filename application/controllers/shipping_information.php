<?php
class shipping_information extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');
		
			$helper=$this->loadHelper('common_function'); 
			$pagedisplaycontent  = $helper->dynamiclanguagepage($_SESSION['lang_id'],'shippinginfo');
			
	 	$template = $this->loadView('shipping_information_view');
			    $configmetatag = $common->common_metatag("config");
				$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['shippinginformation'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'shipping_information');	 
	    $template->set('headcss',$headcss);
		$template->set('pagedisplaycontent',$pagedisplaycontent);
		 
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
}

?>
