<?php
class checkout extends Controller {
	function index()
	{
		
		
			$chkout=$this->loadModel('checkout_model');
			//$resDiscountSel=$chkout->getcpdiscount('fsd');
			 
		if($_SESSION['Cus_ID']=='' ){
			
		if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	
			 //session_start();
			  $_SESSION['refererurl'] = BASE_URL.'checkout';
			//  print_r($_SESSION); die();
			  $this->redirect('login');
			exit;
		}
		}
			
		
		$_SESSION['refererurl'] = '';
			$helper=$this->loadHelper('common_function'); 
		$common=$this->loadModel('user_model');
		
		$cart=$this->loadModel('cart_model');
		$commonmodel=$this->loadModel('common_model');
		
		$getcheckoutproductlist  = $cart->cartProductList();
	
		if(count($getcheckoutproductlist)==0)
		{
			$this->redirect('cart');
			exit;
		}
		
		$totgrant=0;
		foreach($getcheckoutproductlist as $prod)
		{
			$totgrant+=$prod['final_orgprice']*$prod['product_qty'];		

		}
		$temp_cus_id=$_SESSION['Cus_ID'];
		if($temp_cus_id=="")
		{
			$temp_cus_id=session_id();
		}
	    $getmanageaddressdisplay  = $common->getmanageaddressdisplay($temp_cus_id);
		//print_r($getmanageaddressdisplay); die();
		if(count($getmanageaddressdisplay)==1)
		{
			  $_SESSION['addressid'] = $getmanageaddressdisplay[0]['cus_addressid'];
			  $_SESSION['shippincode']= $getmanageaddressdisplay[0]['postalcode'];
		}
		
		$configmetatag = $commonmodel->common_metatag("config");
		$shippingmethod = $chkout->shippingmethod($totgrant);
		
		
		$checkoutdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'checkout');
		
		//echo "<pre>"; print_r($shippingmethod); exit;
	 	$template = $this->loadView('checkout_view');
		
		$headcss='<title>'.$configmetatag['title'].' Checkout</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">
				  <meta name="robots" content="noindex"/>';
		$template->set('menu_disp', 'home');	 
	    $template->set('headcss',$headcss);
	  
	$template->set('noofitem',count($getcheckoutproductlist));
	$template->set('getmanageaddressdisplay',$getmanageaddressdisplay);
	$template->set('getcheckoutproductlist',$getcheckoutproductlist);
	$template->set('shippingmethod',$shippingmethod);	
	 $template->set('checkoutdisplaylanguage',$checkoutdisplaylanguage);
	if(count($shippingmethod)>0 ){
		//if(!isset($_SESSION['shippingid']) || empty($_SESSION['shippingid'])){
		$_SESSION['shippingid'] = $shippingmethod[0]['shippingId'];
        $_SESSION['shippingCode'] = $shippingmethod[0]['shippingCode']; 
		$shipping = $this->loadModel($shippingmethod[0]['modelname']);
		$datas=$shipping->shippingfunction($shippingmethod[0]['shippingId']);
		$_SESSION['pricetype'] = $datas['pricetype'];
		$_SESSION['shippingCost'] = $datas['shippingCost'];	
		//}
	}	
	// print_r($_SESSION); die();
	 $paylist=$chkout->Paymentmethod();
	 $template->set('Paymentmethod',$paylist);
	// echo "<pre>"; print_r($paylist); exit;
	 
	 if(isset($_SESSION['Couponcode']) && $_SESSION['Couponcode']!=''){ 
		

	
			
			
			$datass=$chkout->getcpdiscount($_SESSION['Couponcode']);
		    $arraydata = (json_decode($datass,true));
			
				$_SESSION['Couponcode'] = $arraydata['coupon'];
			    $_SESSION['Coupontitle'] = $arraydata['coupontit'];
				$_SESSION['Couponamount'] = $arraydata['couponamt'];
				$_SESSION['Couponamount1'] = $arraydata['couponamt'];
				$_SESSION['coupontype'] = $arraydata['coupontype'];
				$_SESSION['couponvalue'] = $arraydata['couponvalue'];	
				$_SESSION['CouponCatType'] = $arraydata['CouponCatType'];
		
		}
	 //print_r($_SESSION); die();
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
	 //print_r($_SESSION); die();
	 
		$shippingmet=$chkout->ChkDeliveryAvail($_SESSION['shippincode']);
		//	print_r($shippingmet); die();
			if(count($shippingmet)>0)
			{
				$isshippingavail=1;
			}else{
				$isshippingavail=0;
			}		
	 
	
		$template->set('isshippingavail',$isshippingavail);$template->set('helper',$helper);
		$template->render();	
   
    
	}		

}

?>
