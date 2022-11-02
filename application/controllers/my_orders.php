<?php
class my_orders extends Controller {

	public $product_repository;
	public $proFilter_repository;
	public $orderRepository;
	
	public function __construct() {
		$this->product_repository = $this->repository('product_repository');
		$this->orderRepository = $this->repository('order_repository');
		$this->proFilter_repository = $this->repository('product_filter_repository');
	}

	function index()
	{
		if($_SESSION['Cus_ID']==''){
			$this->redirect_301('login');
			exit;
		}
		$helper 					= $this->loadHelper('common_function'); 
		$common 					= $this->loadModel('common_model');
		$getorderdetails_history 	= $common->getorderdetails_history($_SESSION['Cus_ID']);
		$getmyaccountdetails  		= $common->getmyaccountdetails($_SESSION['Cus_ID']);
		$checkoutdisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		$orderdisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'order');
		$metadisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'meta');
		
		$ordersAll 					= $this->product_repository->getAllInfo('kr_orders', [ 'IsActive' => 1, 'customer_id' => $_SESSION['Cus_ID'] ], ['order_id' => 'desc'] );

	    $configmetatag 				= $common->common_metatag("config");
	    
	 	$template 					= $this->loadView('my_orders_view');
		
		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['myorder'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
				  
		$template->set('menu_disp', 'my_orders');	 
	    $template->set('headcss',$headcss);	    
        $template->set('getorderdetails_history',$getorderdetails_history);
        $template->set('getmyaccountdetails',$getmyaccountdetails);
		$template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
		$template->set('orderdisplaylanguage',$orderdisplaylanguage);
		$template->set('ordersAll',$ordersAll);
		$template->set('ordersModel', $this->orderRepository);
		$template->set('common',$common);
		$template->render();		
		
	}
	
	function view($orderno='')
	{
	
		$helper 					= $this->loadHelper('common_function'); 
		$common 					= $this->loadModel('common_model');
		$order  					= $this->loadModel('orders_model');
		 
		$orderItemDetails 			= $this->orderRepository->getOrderItems( ['kr_orders.order_reference' => $orderno ]);
		$order_info 				= $this->product_repository->getSingleInfo('kr_orders', ['order_reference' => $orderno]);
		
		$getorderdetails_vieworder	= $common->getorderdetails_vieworder($orderno);
		$getmyaccountdetails  		= $common->getmyaccountdetails($_SESSION['Cus_ID']);
		$metadisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'meta');
		$configmetatag = $common->common_metatag("config");
		// ss( $getorderdetails_vieworder );
		if(count($getorderdetails_vieworder)==0)
		{
			$this->redirect('login');
			exit;
		}
			
		$msgdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'msg');
		$cartdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'cart');
		$orderdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'order');
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		
	 	$template 			= $this->loadView('vieworder_view');
		$template->set('menu_disp', 'home');	 
	   	$headcss 			= '<title>'.$configmetatag['title'].' '.$metadisplaylanguage['vieworder'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('headcss',$headcss);
		$template->set('getmyaccountdetails',$getmyaccountdetails);
		$template->set('getorderdetails_vieworder',$getorderdetails_vieworder);
		$template->set('msgdisplaylanguage',$msgdisplaylanguage);
		$template->set('cartdisplaylanguage',$cartdisplaylanguage);
		$template->set('orderdisplaylanguage',$orderdisplaylanguage);
		$template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
		$template->set('orderItemDetails',$orderItemDetails);
		$template->set('order_info',$order_info);
		$template->render();	

	}

	public function cancelOrderModal() {

		$order_id 			= $_POST['order_id'];
		$order_product_id 	= $_POST['order_product_id'];
		$order_info 		= $this->product_repository->getSingleInfo('kr_orders', ['order_id' => $order_id]);
		$itemInfo 			= '';
		if( isset( $order_product_id ) && !empty( $order_product_id ) ) {
			$itemInfo 		= $this->orderRepository->getOrderProductInfo( $order_product_id );
		}
		$params 			= array('order_info' => $order_info, 'order_id' => $order_id, 'order_product_id' => $order_product_id, 'itemInfo' => $itemInfo );
		echo $this->viewFile('partial/cancelOrderForm', $params);
		
	}

	public function cancelOrder() {
		
		$cancel_reason 		= $_POST['cancel_reason'];
		$order_id 			= $_POST['order_id'];
		$order_product_id 	= $_POST['order_product_id'];
		$error = 1;
		//get cancel request id
		$status_info = $this->product_repository->getSingleInfo('kr_order_status', ['order_statusName' => 'Cancel Requested' ]);
		if( isset( $status_info ) && !empty( $status_info ) ) {
			$order_statusId = $status_info->order_statusId;
			if( empty( $order_product_id ) ) {
				//cancel all product and orders
				$data = ['order_status_id' => $order_statusId, 'cancel_reason' => $cancel_reason];
				$where = ['order_id' => $order_id];
				$this->product_repository->updateData('kr_orders', $data, $where);
				$error = 0;
			} else {
				//cancel all product and orders
				//status 3 - cancel requested
				$data = ['IsActive' => 3, 'cancel_reason' => $cancel_reason];
				$where = ['order_product_id' => $order_product_id];
				$this->product_repository->updateData('kr_orders_products', $data, $where);

				$orderItems = $this->product_repository->getSingleInfo('kr_orders_products', ['order_id' => $order_id, 'IsActive' => 1 ]);
				if( !$orderItems ) {
					$data = ['order_status_id' => $order_statusId, 'cancel_reason' => $cancel_reason];
					$where = ['order_id' => $order_id];
					$this->product_repository->updateData('kr_orders', $data, $where);
				}
				$error = 0;
			}
		}
		echo json_encode(['error' => $error ]);
	}
}

?>
