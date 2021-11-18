<?php

class solutions extends Controller {

	function index()

	{

	

		$common=$this->loadModel('common_model');

		$configmetatag = $common->common_metatag("config");

		$getbannerdisplay  = $common->getbannerdisplay("Main Banner");

		$getbannerdisplayaward  = $common->getbannerdisplay("Award Receiver");

		//echo "<pre>"; print_r($configmetatag); die();

	

	 	$template = $this->loadView('solutions_view');

		

		$headcss='<title>'.$configmetatag['title'].' Solutions</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';

		$template->set('menu_disp', 'solutions');	 

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

