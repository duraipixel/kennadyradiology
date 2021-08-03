<?php
class registeractivation extends Controller {
	function index($data=null)
	{
		
    
		if($_SESSION['Cus_ID']!=''){
			$this->redirect('my-account');
			exit;
		}
			$helper=$this->loadHelper('common_function'); 
		//$common=$this->loadModel('user_model');
		//$getdefaultcustomer = $common->getdynamiccustomerfields(1);
		//$getcorporatecustomer = $common->getdynamiccustomerfields(2);
	    // print_r($getcorporatecustomer); exit;
		$common=$this->loadModel('common_model');
	    $configmetatag = $common->common_metatag("config");
		 $msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
	 	$template = $this->loadView('registeractivation_view');
		
		$headcss='<title>Registeractivation-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
		$template->set('msgdisplaylanguage',$msgdisplaylanguage);
	
	// menu	
	//$template->set('getdefaultcustomer',$getdefaultcustomer);
	//$template->set('getcorporatecustomer',$getcorporatecustomer);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>