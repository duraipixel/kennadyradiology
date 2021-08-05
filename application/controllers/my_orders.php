<?php
class my_orders extends Controller {
	function index()
	{
 		
		
		if($_SESSION['Cus_ID']==''){
			$this->redirect_301('login');
			exit;
		}
		 $helper=$this->loadHelper('common_function'); 
		$common=$this->loadModel('common_model');
		$getorderdetails_history = $common->getorderdetails_history($_SESSION['Cus_ID']);
		$getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		$orderdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'order');
		 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		
	    $configmetatag = $common->common_metatag("config");
	    
	 	$template = $this->loadView('my_orders_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['myorder'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  
				  
		$template->set('menu_disp', 'my_orders');	 
	    $template->set('headcss',$headcss);	    
        $template->set('getorderdetails_history',$getorderdetails_history);
        $template->set('getmyaccountdetails',$getmyaccountdetails);
		$template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
		$template->set('orderdisplaylanguage',$orderdisplaylanguage);
		//print_r($getRproductcat);		exit;
		 
	 
	//	$template->set('timer',$timer);
		$template->render();		
		
	}
	
	function view($orderno='')
	{
	
       if($_SESSION['Cus_ID']==''){
		  	if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	
			$this->redirect('login');
			exit;
			}
		}
		$helper=$this->loadHelper('common_function'); 
		$common=$this->loadModel('common_model');
		$getorderdetails_vieworder = $common->getorderdetails_vieworder($orderno);
		$getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
		  $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		   $configmetatag = $common->common_metatag("config");
		if(count($getorderdetails_vieworder)==0)
		{
			$this->redirect('login');
			exit;
		}
			
	$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		 $cartdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'cart');
		$orderdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'order');
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
	 	$template = $this->loadView('vieworder_view');
		
		
		$template->set('menu_disp', 'home');	 
	   $headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['vieworder'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  $template->set('headcss',$headcss);
	$template->set('getmyaccountdetails',$getmyaccountdetails);
		$template->set('getorderdetails_vieworder',$getorderdetails_vieworder);
$template->set('msgdisplaylanguage',$msgdisplaylanguage);
$template->set('cartdisplaylanguage',$cartdisplaylanguage);
$template->set('orderdisplaylanguage',$orderdisplaylanguage);
$template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
			$template->render();		
	}
}

?>
