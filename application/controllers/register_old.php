<?php
class register_old extends Controller {
	function index()
	{
		$helper=$this->loadHelper('common_function'); 
		 $helper->unsetguestchkout();
	    
		if($_SESSION['Cus_ID']!=''){
			$this->redirect('my-account');
			exit;
		}
		$common=$this->loadModel('user_model');
		$commonmodel=$this->loadModel('common_model');
		$getdefaultcustomer = $common->getdynamiccustomerfields(1);
		$getcorporatecustomer = $common->getdynamiccustomerfields(2,3,'top');
		$getcorporatecustomerbottom = $common->getdynamiccustomerfields(2,3,'bottom');
	   // print_r($getcorporatecustomerbottom); exit;
		
	    $configmetatag = $commonmodel->common_metatag("config");
	 	$template = $this->loadView('register_view_old');
		
		$headcss='<title>Register-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	
	// menu	
	$template->set('getdefaultcustomer',$getdefaultcustomer);
	$template->set('getcorporatecustomer',$getcorporatecustomer);
	$template->set('getcorporatecustomerbottom',$getcorporatecustomerbottom);
	
	
	
		
	 
	//	$template->set('timer',$timer);
		$template->render();	
   
    
	}		

}

?>
