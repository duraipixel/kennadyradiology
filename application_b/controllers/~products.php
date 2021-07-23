<?php

class products extends Controller {

	function index($controller,$code=null)

	{
		 $helper=$this->loadHelper('common_function'); 
		 $helper->unsetguestchkout();

		$common=$this->loadModel('common_model');

		$configmetatag = $common->common_metatag("config");

		$getbannerdisplay  = $common->getbannerdisplay("Main Banner");

		$getbannerdisplayaward  = $common->getbannerdisplay("Award Receiver");

		//echo "<pre>"; print_r($configmetatag); die();

		$configmetatag = $common->common_metatag("config");
 
 
	 $Metacode= 'Products';
	 $templatename = 'products_view';
  	 	$template = $this->loadView($templatename);


		

	$headcss='<title>'.$configmetatag['title'].' '.$Metacode.'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 

		$template->set('menu_disp', 'home');	 

	    $template->set('headcss',$headcss);

	

	// menu	

	$template->set('getBannerSlider',$getBannerSlider);

	$getmemberoflogo  = $common->getourclientslogo("client");

	$template->set('getourclientslogo',$getmemberoflogo);

	$template->set('getbannerdisplayaward',$getbannerdisplayaward);

	$template->set('getbannerdisplay',$getbannerdisplay);		

	

	

	

		

	 

	//	$template->set('timer',$timer);

		$template->render();	

   

    

	}		



}



?>

