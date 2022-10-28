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
		  $contactusdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'contactus');
		    $formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
			$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		//$bulk_order_form=$common->getdynamicformfields('bulk_order_enquiry');
		//print_r($bulk_order_form); exit;
	 	$template = $this->loadView('contactus_view');
		
		$headcss='<title>Contact us  - Kennedy Radiology</title>
			      <meta name="description" content="Contact us for your Radiation Protection product requirement at kennedyradiology@trivitron.com so that we can provide you our best offers.">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
				  
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('contactusdisplaylanguage',$contactusdisplaylanguage);
		$template->set('formdisplaylanguage',$formdisplaylanguage);
	
	// menu	
	$template->set('getcont',$getcontactformdetails);
	 
		$template->render();	
   
    
	}		

}

?>
