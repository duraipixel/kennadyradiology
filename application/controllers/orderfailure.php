<?php
class orderfailure extends Controller {
	function index()
	{
	    $orderid =$_REQUEST['oid'];
		$order=$this->loadModel('orders_model');
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
		$getorder_refid = $order->getorder_referenceid($orderid);
	 	$template = $this->loadView('orderfailure_view');
		
		$headcss='<title>Order Failure-'.$configmetatag['title'].'</title>
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