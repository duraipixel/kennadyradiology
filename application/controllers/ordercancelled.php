<?php
class ordercancelled extends Controller {
	function index()
	{
	    $orderid =$_REQUEST['oid'];
		$common=$this->loadModel('common_model');
		$order=$this->loadModel('orders_model');
	    $configmetatag = $common->common_metatag("config");
		$getorder_refid = $order->getorder_referenceid($orderid);
	 	$template = $this->loadView('ordercancel_view');
		
		$headcss='<title>Order Cancel-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('orderrefid',$getorder_refid);

		$template->render();	
   
    
	}		

}

?>