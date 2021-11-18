<?php
class ordersuccess extends Controller {
	function index()
	{
	    $type =$_REQUEST['type'];
		$status =$_REQUEST['status'];
		$orderid =$_REQUEST['oid'];
		$common=$this->loadModel('common_model');
		$order=$this->loadModel('orders_model');
		$helper=$this->loadHelper('common_function'); 
	    $configmetatag = $common->common_metatag("config");
		$getorder_refid = $order->getorder_referenceid($orderid);
		//echo"<pre>"; print_r($getorder_refid); exit;
		
		 $msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		 $cartdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'cart');
		$orderdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'order');
		 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		if($getorder_refid['order_reference'] == ''){
			$this->redirect('main');
			exit;	
		}
		
	 	$template = $this->loadView('ordersuccess_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['ordersuccess'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				   
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('type',$type);
		$template->set('status',$status);
		$template->set('orderrefid',$getorder_refid);
$template->set('msgdisplaylanguage',$msgdisplaylanguage);
$template->set('cartdisplaylanguage',$cartdisplaylanguage);
$template->set('orderdisplaylanguage',$orderdisplaylanguage);
		$template->render();	
   
    
	}		

}

?>