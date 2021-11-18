<?php
class ordercancelled extends Controller {
	function index()
	{
	    $orderid =$_REQUEST['oid'];
		$common=$this->loadModel('common_model');
		$order=$this->loadModel('orders_model');
	    $configmetatag = $common->common_metatag("config");
		$helper=$this->loadHelper('common_function');
		$getorder_refid = $order->getorder_referenceid($orderid);
		$orderdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'order');
		 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		 
	 	$template = $this->loadView('ordercancel_view');
		$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['ordercancel'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('orderrefid',$getorder_refid);
$template->set('msgdisplaylanguage',$msgdisplaylanguage);
$template->set('orderdisplaylanguage',$orderdisplaylanguage);
		$template->render();	
   
    
	}		

}

?>