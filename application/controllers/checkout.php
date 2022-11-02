<?php
require_once "vendor/autoload.php";
// error_reporting(-1);
use Omnipay\Omnipay;
class checkout extends Controller {

	public $product_repository;
	public $proFilter_repository;
	public $cart_repository;
	
	public function __construct() {
		$this->product_repository 	= $this->repository('product_repository');
		$this->proFilter_repository = $this->repository('product_filter_repository');
		$this->cart_repository 		= $this->repository('cart_repository');
	}

	function index()
	{
		
		$chkout 					= $this->loadModel('checkout_model');
		if( $_SESSION['Cus_ID']=='' ) {
			if( $_SESSION['Isguestcheckout'] != "1" && $_SESSION['guestckout_sess_id'] == "" ){	
				$_SESSION['refererurl'] = BASE_URL.'checkout';
				$this->redirect('login');
				exit;
			}
		}
		
		$_SESSION['refererurl'] = '';
		$common 		= $this->loadModel('user_model');
		$cart 		 	= $this->loadModel('cart_model');
		$commonmodel=$this->loadModel('common_model');
		$helper=$this->loadHelper('common_function'); 
		$getcheckoutproductlist  = $cart->cartProductList();
	
		if(count($getcheckoutproductlist)==0)
		{
			$this->redirect('cart');
			exit;
		}
		
		$totgrant 			= 0;
		foreach($getcheckoutproductlist as $prod)
		{
			$totgrant 		+= $prod['final_orgprice']*$prod['product_qty'];		
		}
		
	    $getmanageaddressdisplay  = $common->getmanageaddressdisplay();
		
		if(count($getmanageaddressdisplay)==1)
		{
			$_SESSION['addressid'] 		= $getmanageaddressdisplay[0]['cus_addressid'];
			$_SESSION['shippincode'] 	= $getmanageaddressdisplay[0]['postalcode'];
		}
		
		$configmetatag = $commonmodel->common_metatag("config");
		$shippingmethod = $chkout->shippingmethod($totgrant);
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		$formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
		$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		$cartdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'cart');
		$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
		
		$headcss 			= '<title>'.$configmetatag['title'].' '.$metadisplaylanguage['checkout'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  
		$cart_list 		= $this->cart_repository->cartList();

		$template = $this->loadView('checkout_view');
				  
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	    $template->set('cart_list',$cart_list);
		$template->set('noofitem',count($getcheckoutproductlist));
		$template->set('getmanageaddressdisplay',$getmanageaddressdisplay);
		$template->set('getcheckoutproductlist',$getcheckoutproductlist);
		$template->set('shippingmethod',$shippingmethod);	
		$template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
		$template->set('formdisplaylanguage',$formdisplaylanguage);
		$template->set('msgdisplaylanguage',$msgdisplaylanguage);
		$template->set('cartdisplaylanguage',$cartdisplaylanguage);

		if(count($shippingmethod)>0 ){
			$_SESSION['shippingid'] = $shippingmethod[0]['shippingId'];
			$_SESSION['shippingCode'] = $shippingmethod[0]['shippingCode']; 
			$shipping = $this->loadModel($shippingmethod[0]['modelname']);
			$datas=$shipping->shippingfunction($shippingmethod[0]['shippingId']);
			$_SESSION['pricetype'] = $datas['pricetype'];
			$_SESSION['shippingCost'] = $datas['shippingCost'];	
		}	

		$paylist 					= $chkout->Paymentmethod();
		$template->set('Paymentmethod',$paylist);
		
		
		switch(count($paylist))
		{
			case "0" : 					
						$this->redirect('gatewayerror');
						exit;
						break;
			case "1" :
						$_SESSION['pay_code']= $paylist[0]['pay_code'];
						break;
			
		}
	 
		$shippingmet=$chkout->ChkDeliveryAvail($_SESSION['shippincode']);
		
		if(count($shippingmet)>0)
		{
			$isshippingavail=1;
		}else{
			$isshippingavail=0;
		}		
		$template->set('isshippingavail',$isshippingavail);
		$template->render();	
    
	}	
	
	public function payPalPayment() {
		
		if( !isset( $_SESSION['addressid'] ) ) {
			$_SESSION['address_error'] = 1;
			$this->redirect('checkout');
			exit;
		}
		unset($_SESSION['address_error']);
		//get cart details
		$checkoutModel 	= $this->loadModel('checkout_model');
		$orderModel 	= $this->loadModel('orders_model');
		$cart_info 		= $checkoutModel->getCartItems();
		$amount 		= number_format( $_REQUEST['grand_total']);
		$gateway 		= Omnipay::create('PayPal_Rest');
		$gateway->setClientId(CLIENT_ID);
		$gateway->setSecret(CLIENT_SECRET);
		$gateway->setTestMode(true);

		$payPalResponse = $orderModel->placePaypalOrder($this->product_repository);
		/***
		 * here do insert process of order and orderitems
		 */
		try {
			
			$response = $gateway->purchase(array(
				'amount' => $payPalResponse['amount'],
				'currency' => PAYPAL_CURRENCY,
				'returnUrl' => BASE_URL.PAYPAL_RETURN_URL,
				'cancelUrl' => BASE_URL.PAYPAL_CANCEL_URL,
			))->send();
				   
			if ($response->isRedirect()) {
				$response->redirect(); // this will automatically forward the customer
			} else {
				// not successful
				echo $response->getMessage();
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}

	}

	public function successPayment() {
	
		$payPalSession 			= $_SESSION['PAYPAL'];
		$orderModel 			= $this->loadModel('orders_model');
		$common 				= $this->loadModel('common_model');
		$helper 				= $this->loadHelper('common_function'); 
		$configmetatag 			= $common->common_metatag("config");
		
		$status 				= 'success';
		
		if( isset( $payPalSession ) && !empty( $payPalSession ) ) {
			$order_reference 	= $payPalSession['order_reference'];
			$orderInfo 			= $orderModel->getOrderInfoByOrderReference( $order_reference );
			$orderModel->update_orders($orderInfo['order_id'], 1);

			$orderModel->ordermailfunction($orderInfo['order_reference'],'20');
			// print_r( $orderInfo );
			//insert in payment data
			$pay_Data['tracking_id'] 	= $_REQUEST['paymentId'];
			$pay_Data['order_id'] 		= $orderInfo['order_id'];
			$pay_Data['data'] 			= serialize($_REQUEST);
			$pay_Data['CustomerId'] 	= $orderInfo['customer_id'];
			$pay_Data['order_status'] 	= 'paid';
			$pay_Data['payment_mode'] 	= 'paypal';
			$pay_Data['bank_ref_no'] 	= '';
			$pay_Data['CreatedDate'] 	= date('Y-m-d H:i:s');
			$pay_Data['ModifiedDate'] 	= date('Y-m-d H:i:s');
			
			$orderModel->insertPayment($pay_Data);
			$getorder_refid 	= $orderModel->getorder_referenceid( $orderInfo['order_id'] );
			$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
			$cartdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'cart');
			$orderdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'order');
			$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
			$template = $this->loadView('ordersuccess_view');
			
			$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['ordersuccess'].'</title>
					<meta name="description" content="'.$configmetatag['description'].'">
					<meta name="keywords" content="'.$configmetatag['keyword'].'">
					<meta name="robots" content="noindex"/>';
					 
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('type', 'paypal');
			$template->set('status',$status);
			$template->set('order_reference',$order_reference);
			$template->set('orderrefid',$orderInfo);
			$template->set('msgdisplaylanguage',$msgdisplaylanguage);
			$template->set('cartdisplaylanguage',$cartdisplaylanguage);
			$template->set('orderdisplaylanguage',$orderdisplaylanguage);
			$template->render();	

		}
	}

	public function cancelPayment() {

		$payPalSession 			= $_SESSION['PAYPAL'];
		$orderModel 			= $this->loadModel('orders_model');
		$common 				= $this->loadModel('common_model');
		$helper 				= $this->loadHelper('common_function'); 
		$configmetatag 			= $common->common_metatag("config");
		
		$status 				= 'cancelled';
		if( isset( $payPalSession ) && !empty( $payPalSession ) ) {
			$order_reference 	= $payPalSession['order_reference'];
			$orderInfo 			= $orderModel->getOrderInfoByOrderReference( $order_reference );
			$orderModel->update_orders($orderInfo['order_id'], 1);
			$orderModel->ordermailfunction( $orderInfo['order_reference'], '19' );
			// print_r( $orderInfo );
			//insert in payment data
			$pay_Data['tracking_id'] 	= $_REQUEST['paymentId'];
			$pay_Data['order_id'] 		= $orderInfo['order_id'];
			$pay_Data['data'] 			= serialize($_REQUEST);
			$pay_Data['CustomerId'] 	= $orderInfo['customer_id'];
			$pay_Data['order_status'] 	= 'cancelled';
			$pay_Data['payment_mode'] 	= 'paypal';
			$pay_Data['bank_ref_no'] 	= '';
			$pay_Data['CreatedDate'] 	= date('Y-m-d H:i:s');
			$pay_Data['ModifiedDate'] 	= date('Y-m-d H:i:s');
			
			$orderModel->insertPayment($pay_Data);

			$template = $this->loadView('orderfailure_view');
			$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
			$metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
			$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['orderfailure'].'</title>
					<meta name="description" content="'.$configmetatag['description'].'">
					<meta name="keywords" content="'.$configmetatag['keyword'].'">
					<meta name="robots" content="noindex"/>';
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('orderrefid',$orderInfo);
			$template->set('msgdisplaylanguage',$msgdisplaylanguage);
			$template->render();
		}

	}

	public function getAddressList() {

		$common 					= $this->loadModel('user_model');
	    $getmanageaddressdisplay  	= $common->getmanageaddressdisplay();
		echo $this->view( 'checkout/_address_list', [ 'getmanageaddressdisplay' => $getmanageaddressdisplay ] );
		
	}

}

?>
