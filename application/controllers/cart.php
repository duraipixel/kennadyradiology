<?php
class cart extends Controller {
	public $product_repository;
	public function __construct() {
		$this->database_repository = $this->repository('product_repository');
		$this->cart_repository = $this->repository('cart_repository');
	}
	function index()
	{
		$helper					= $this->loadHelper('common_function'); 
		$helper->unsetguestchkout();
		$cart					= $this->loadModel('cart_model'); 
		$commonmodel 			= $this->loadModel('common_model');
		
		$addtocartlist 			= $cart->addtocartlist('cartpage');
		
		$cartdisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'cart');
		$metadisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'meta');
 
	    $configmetatag 			= $commonmodel->common_metatag("config");

	 	$template 				= $this->loadView('cart_view');
		
		$headcss 				= '<title>'.$configmetatag['title'].' '.$metadisplaylanguage['mycart'].'</title>
									<meta name="description" content="'.$configmetatag['description'].'">
									<meta name="keywords" content="'.$configmetatag['keyword'].'">';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	    $template->set('addtocartlist',$addtocartlist);
		$template->set('helper',$helper);
		$template->set('cartdisplaylanguage',$cartdisplaylanguage);
		$template->render();	
	}	

	function addOrRemoveCartQuantity() {
		$product_id 	= $_POST['product_id'];
		$quantity 		= $_POST['quantity'];
		$product_info 	= $this->database_repository->getSingleInfo( 'kr_product', [ 'product_id' => $product_id ] );
		$cart_item 		= $this->cart_repository->getSingleCartItem( $product_id );
		print_r( $cart_item ); 
	}	

	public function cartPopupList() {
		
		$cart_list 		= $this->cart_repository->cartList();
		$params 		= array( 'cart_list' => $cart_list );
		echo $this->view( 'cart/_cart_popup_list', $params );
		
	}

}

?>
