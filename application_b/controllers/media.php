<?php

class media extends Controller {

	function index()

	{

	

		$common=$this->loadModel('common_model');

		$configmetatag = $common->common_metatag("config");

		$getbannerdisplay  = $common->getbannerdisplay("Main Banner");

		$getbannerdisplayaward  = $common->getbannerdisplay("Award Receiver");

		//echo "<pre>"; print_r($configmetatag); die();

	

	 	$template = $this->loadView('media_view');

		

		$headcss='<title>Products</title>

					  <meta name="description" content="">

					  <meta name="keywords" content="">';

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

