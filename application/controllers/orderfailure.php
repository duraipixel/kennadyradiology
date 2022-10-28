<?php
class orderfailure extends Controller {
	function index()
	{
	    $orderid =$_REQUEST['oid'];
		$order=$this->loadModel('orders_model');
		$common=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function');
	    $configmetatag = $common->common_metatag("config");
		$getorder_refid = $order->getorder_referenceid($orderid);
	 	$template = $this->loadView('orderfailure_view');
		$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['orderfailure'].'</title>
				<meta name="description" content="'.$configmetatag['description'].'">
				<meta name="keywords" content="'.$configmetatag['keyword'].'">
				<meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
		$template->set('headcss',$headcss);
		$template->set('orderrefid',$getorder_refid);
		$template->set('msgdisplaylanguage',$msgdisplaylanguage);
		$template->render();	
   
    
	}		

}

?>