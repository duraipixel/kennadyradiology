<?php
class wishlist extends Controller {
	function index()
	{
		$helper=$this->loadHelper('common_function'); 
		 $helper->unsetguestchkout();
       	if($_SESSION['Cus_ID']==''){
			$this->redirect_301('login');
			exit;
		}	
		$_SESSION['refererurlwish'] = '';
	   $cart=$this->loadModel('wishlist_model');
	   $common=$this->loadModel('common_model');
	//   $addtowishlist = $cart->addtowishlist('wishlistpage');
	$addtowishlist = $cart->WishllistProductList();
	   //echo "<pre>"; print_r($addtowishlist); exit;
	   
	   $configmetatag = $common->common_metatag("config");
		//echo "<pre>"; print_r($configmetatag); die();
	 	$template = $this->loadView('wishlist_view');
		
		
		$headcss='<title>Wishlist-'.$configmetatag['title'].'</title>
					  <meta name="description" content="'.$configmetatag['description'].'">
					  <meta name="keywords" content="'.$configmetatag['keyword'].'">
					  <meta name="robots" content="noindex"/>';
					  
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	    $template->set('addtowishlist',$addtowishlist);
		$template->render();	
   
    
	}		

}

?>
