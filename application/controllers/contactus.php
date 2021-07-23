<?php
class contactus extends Controller {
	function index()
	{
		$helper=$this->loadHelper('common_function'); 
		 $helper->unsetguestchkout();
		$common=$this->loadModel('common_model');
		$user=$this->loadModel('user_model');
	    $configmetatag = $common->common_metatag("config");
		$getcontactformdetails = $common->getcontactformdetails($_SESSION['Cus_ID']);
		//$bulk_order_form=$common->getdynamicformfields('bulk_order_enquiry');
		//print_r($bulk_order_form); exit;
	 	$template = $this->loadView('contactus_view');
		
		$headcss='<title>'.$configmetatag['title'].' Contact Us</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getcont',$getcontactformdetails);
	//$template->set('bulk_order_form',$bulk_order_form);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
