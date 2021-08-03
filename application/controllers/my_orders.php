<?php
class my_orders extends Controller {
	function index()
	{
 		
		 
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
		
		if($_SESSION['Cus_ID']==''){
			$this->redirect_301('login');
			exit;
		}
		$common=$this->loadModel('common_model');
		$getorderdetails_history = $common->getorderdetails_history($_SESSION['Cus_ID']);
		$getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
		
	    $configmetatag = $common->common_metatag("config");
	    
	 	$template = $this->loadView('my_orders_view');
		
		$headcss='<meta name="description" content=" ">
				  <meta name="keywords" content=" ">
				  
				  <title>My Orders :: Kiran eCom</title>';
		$template->set('menu_disp', 'my_orders');	 
	    $template->set('headcss',$headcss);
	    
        $template->set('getorderdetails_history',$getorderdetails_history);
        $template->set('getmyaccountdetails',$getmyaccountdetails);
		 
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
		$common=$this->loadModel('common_model');
		$getorderdetails_vieworder = $common->getorderdetails_vieworder($orderno);
		$getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
		 
		if(count($getorderdetails_vieworder)==0)
		{
			$this->redirect('login');
			exit;
		}
			
	
	 	$template = $this->loadView('vieworder_view');
		
		
		$template->set('menu_disp', 'home');	 
	   
	$template->set('getmyaccountdetails',$getmyaccountdetails);
		$template->set('getorderdetails_vieworder',$getorderdetails_vieworder);

			$template->render();	
	}
}

?>
