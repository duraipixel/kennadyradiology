<?php
class my_account extends Controller {
	function index()
	{
	    
	    if($_SESSION['Cus_ID']==''){
			$this->redirect_301('login');
			exit;
		}
		$_SESSION['refererurl'] = '';
	
 		$common=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function'); 	$helper->unsetguestchkout();
 		$getmyaccountdetails  = $common->getmyaccountdetails($_SESSION['Cus_ID']);
		$getsubscribedetails  = $common->getsubscribedetails($_SESSION['emailid']);
		$myaccountdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'myaccount');
		$formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
		$logindisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'login');
		 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		//echo "reach"; print_r($getEproductcat); exit;
		 
		//echo "reach"; print_r($getAproductcat); exit;
		 
		//print_r($getEproductcatprods); exit;
		$configmetatag = $common->common_metatag("config");
	 	$template = $this->loadView('my_account_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['myaccount'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  
		$template->set('menu_disp', 'my_account');	 
	    $template->set('headcss',$headcss);
        $template->set('getmyaccountdetails',$getmyaccountdetails);
        $template->set('getsubscribedetails',$getsubscribedetails);
		 $template->set('myaccountdisplaylanguage',$myaccountdisplaylanguage);
	  $template->set('formdisplaylanguage',$formdisplaylanguage);
	   $template->set('logindisplaylanguage',$logindisplaylanguage);
		//print_r($getRproductcat);		exit;
		 
	 
	 	//$template->set('helper',$helper);
		$template->render();		
		
	}
}

?>
