<?php
class cart extends Controller {
	function index()
	{
		$helper=$this->loadHelper('common_function'); 
		 $helper->unsetguestchkout();
		 $cart=$this->loadModel('cart_model');
		 $commonmodel=$this->loadModel('common_model');
	     $addtocartlist = $cart->addtocartlist('cartpage');
	     $cartdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'cart');
		 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
 
	    $configmetatag = $commonmodel->common_metatag("config");
	 	$template = $this->loadView('cart_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['mycart'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	    $template->set('addtocartlist',$addtocartlist);
		$template->set('helper',$helper);
		$template->set('cartdisplaylanguage',$cartdisplaylanguage);
		$template->render();	
	}		

}

?>