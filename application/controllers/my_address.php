<?php
class my_address extends Controller {
	function index()
	{
 		$common=$this->loadModel('common_model');		 
	    if($_SESSION['Cus_ID']==''){
			$this->redirect('login');
			exit;
		}
		
		$common=$this->loadModel('user_model');
	    $commonmodel=$this->loadModel('common_model');
	    $helper=$this->loadHelper('common_function'); 
		$temp_cus_id=$_SESSION['Cus_ID'];
		if($temp_cus_id=="")
		{
			$temp_cus_id=session_id();
		}
		
		$getmanageaddressdisplay  = $common->getmanageaddressdisplay($temp_cus_id);
		$getmanageaddress_autofill  = $common->getmanageaddress_autofill($_SESSION['Cus_ID']);
		$configmetatag = $commonmodel->common_metatag("config");
		$getmyaccountdetails  = $commonmodel->getmyaccountdetails($_SESSION['Cus_ID']);
		$formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
		$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		$otherdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'other');
		 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		 
	 	$template = $this->loadView('my_address_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['myaddress'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				
		$template->set('menu_disp', 'my_address');	 
		$template->set('headcss',$headcss);
		$template->set('helper',$helper);
		$template->set('getmanageaddressdisplay',$getmanageaddressdisplay);
		$template->set('getmanageaddress_autofill',$getmanageaddress_autofill);
		$template->set('getmyaccountdetails',$getmyaccountdetails);
		$template->set('formdisplaylanguage',$formdisplaylanguage);
		$template->set('msgdisplaylanguage',$msgdisplaylanguage);
		$template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
		$template->set('otherdisplaylanguage',$otherdisplaylanguage);
	 
	 	$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
