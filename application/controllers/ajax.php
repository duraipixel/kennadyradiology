<?php
class ajax extends Controller {	
	
	function index(){}
	public	function changeLanguage() 
	{		
		$_SESSION['lang_id'] = $_REQUEST['lang_id'];
		return true;
	}
	

	function registerform()
	{
		//print_r($_REQUEST); exit;	
		$common = $this->loadModel('user_model'); 		
		$data=$common->registerform($_REQUEST);
	
	}
	
	function saveproductQuote()
	{
		$common = $this->loadModel('common_model');	
		$resul= $common->saveproductQuote($_REQUEST);	
	}
	function emailduplicatechecking()
	{
		//print_r($_REQUEST); exit;	
		$common = $this->loadModel('user_model'); 		
		$data=$common->emailduplicatechecking($_REQUEST);
	}
	
	function dynamicformbuilder()
	{
		//print_r($_REQUEST); exit;	
		$common = $this->loadModel('common_model'); 		
		$data=$common->dynamicformbuilder($_REQUEST);
	}
	
	function dynamicfieldappend()
	{
		//print_r($_REQUEST); exit;	
		$common = $this->loadModel('common_model'); 		
		$data=$common->dynamicfieldappend($_REQUEST);
	}
	
	function subscribemail()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('common_model'); 		
		$data=$common->subscribemail($_REQUEST);
	}
	
	function loginuser()
	{
		
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('common_model'); 		
		$data=$common->loginuser($_REQUEST);
	}
	
	function updatemyaccount()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('user_model'); 		
		$data=$common->updatemyaccount($_REQUEST);
		
	}
	
	function statelist()
	{
		
		$common = $this->loadModel('user_model'); 		
		$data=$common->statelist($_REQUEST);
	}
	
	function countrylist()
	{
		
		$common = $this->loadModel('user_model'); 		
		 $data=$common->countrylist($_REQUEST);
	}
	
	function Addressform()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('user_model'); 		
		$data=$common->Addressform($_REQUEST);
		//print_r($data); die();
	}
	
	function updateaddress()
	{
		$common = $this->loadModel('user_model'); 		
		$data=$common->updateaddress($_REQUEST);
	}
	
	function deleteaddress()
	{
		$common = $this->loadModel('user_model'); 		
		$data=$common->deleteaddress($_REQUEST);
	}
	function changepasswords()
	{
		 //print_r($_REQUEST); exit;
		$common = $this->loadModel('user_model'); 		
		$data=$common->changepasswords($_REQUEST);
	}
	
	function contactform()
	{
		 
		$common = $this->loadModel('common_model'); 	
		
		$data=$common->contactform($_REQUEST);
		 
	}
	
	function productcatalogueEnquiry()
	{
		 
		$common = $this->loadModel('common_model'); 	
		
		$data=$common->productcatalogueEnquiry($_REQUEST);
		 
	}
	
	function reachusform()
	{
		if($_REQUEST['iname']!='' && $_REQUEST['iemail']!=''){
		$common = $this->loadModel('common_model'); 	
		
		$data=$common->reachusform($_REQUEST);
		}
		else{
			echo json_encode(array("rslt"=>"2"));
		}
	}
	
	
	function products($catid,$page,$search='')
	{
			//$page=1;
			
			$product=$this->loadModel('product_model');
			
			if($_REQUEST['isajax']==1 )
			{
				$_SESSION["filter"]=$_REQUEST;
				
			}
			//print_r($_REQUEST); die();
			if($page==1 && !isset($_REQUEST['isajax']))
			{
				$_SESSION["filter"]="";
			}
		
			if(isset($_REQUEST['type']) && trim($_REQUEST['type'])=='deals_of_day'){		
		
				$productlists=$product->productlists('',$catid,'',$page,$_SESSION["filter"],'12','1','deals_of_day');
			}
			else	{	
			  $productlists=$product->productlists('',$catid,$search,$page,$_SESSION["filter"]);
			}
			 $helper=$this->loadHelper('common_function'); 
			 $productlistdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'productlist');
			$SortBy=$product->getSortBy();
			
			$pageindex=$page;
 			$template = $this->loadView('partial/products_lists');			
			$headcss='<meta name="description" content="">
					  <meta name="keywords" content="">
					  <title></title>';
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('catid',$catid);
			$template->set('page',$pageindex);
			$template->set('searchkey',$search);
			$template->set('productlists',$productlists['prod_list']);
			$template->set('productscount',$productlists['totcnt']);
			$template->set('fliter_list',$productlists['fliter_list']);
$template->set('productlistdisplaylanguage',$productlistdisplaylanguage);
			$template->set('fliter_price',$productlists['pricefilter']);
			$template->set('SortBy',$SortBy);
			
			/*if(isset($_REQUEST['isajax']) && $_REQUEST['isajax']==1)
			{
				 echo $contproduct=$template->renderinvariable();
				 
			}
			else */
				$template->render();    
			
	}
	
    function forgetpasswords()
	{
		 //print_r($_REQUEST); exit;
		$common = $this->loadModel('common_model'); 		
		$data=$common->forgetpasswords($_REQUEST);
	}
	
	function resendmailfunction()
	{
		 //print_r($_REQUEST); exit;
		$usermodel = $this->loadModel('user_model'); 		
		$data=$usermodel->resendmailfunction($_REQUEST);
	}
	
	function resetpassword()
	{
		 //print_r($_REQUEST); exit;
		$common = $this->loadModel('common_model'); 		
		$data=$common->resetpassword($_REQUEST);
	}
	
	function buynow_insert()
	{
		 if($_SERVER['CONTENT_TYPE']=="application/json")
		 { 
			$input = file_get_contents('php://input');
			$_REQUEST=(array)json_decode($input); 
		 }
		$common = $this->loadModel('cart_model'); 		
		$data=$common->buynow_insert($_REQUEST);
	}
	
	function addtocatalogue_insert()
	{
		 if($_SERVER['CONTENT_TYPE']=="application/json")
		 { 
			$input = file_get_contents('php://input');
			$_REQUEST=(array)json_decode($input); 
		 }
		$common = $this->loadModel('cart_model'); 		
		$data=$common->addtocatalogue_insert($_REQUEST);
	}
	
	function addtocart_insert()
	{
		 if($_SERVER['CONTENT_TYPE']=="application/json")
		 { 
			$input = file_get_contents('php://input');
			$_REQUEST=(array)json_decode($input); 
		 }
		$common = $this->loadModel('cart_model'); 		
		$data=$common->addtocart_insert($_REQUEST);
	}
	
	function Downloadpdfcatalog()
	{
		// print_r($_REQUEST); exit;
		 if($_SESSION['Cus_ID']!=''){
            $common = $this->loadModel('cart_model'); 		
			$data=$common->Downloadpdfcatalog();
			
		}
		else{
			$_SESSION['refererurldpc'] = $_SERVER['HTTP_REFERER'];
            $_SESSION['typedpc'] = "Downloadpdfcatalog";
			$this->redirect('login');
		    exit;
		}
	}
	
	
	function SaveDownloadpdfcatalog()
	{
		// print_r($_REQUEST); exit;
		 if($_SESSION['Cus_ID']!=''){
            $common = $this->loadModel('cart_model'); 		
			$data=$common->SaveDownloadpdfcatalog($_REQUEST);
			
		}
		else{
			$_SESSION['refererurldpc'] = $_SERVER['HTTP_REFERER'];
            $_SESSION['typedpc'] = "Downloadpdfcatalog";
			$this->redirect('login');
		    exit;
		}
	}
	
	
	
	function deletecartproduct()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('cart_model'); 		
		$data=$common->deletecartproduct($_REQUEST);
	}
	
	function deletecartpageproduct()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('cart_model'); 		
		$deletecartpageproduct=$common->deletecartpageproduct($_REQUEST);
		//echo "<pre>"; print_r($deletecartpageproduct);exit;
		$template = $this->loadView('partial/cart_table');
		$template->set('addtocartlist',$deletecartpageproduct['prod_details']);
		$htmlcont=$template->renderinvariable();
		//print_r($htmlcont); die();
		echo json_encode(array("rslt"=>"1","prod_details"=>$htmlcont,"cartcount"=>$deletecartpageproduct['cartcount']));
	}
	
	function cartpageproductList()
	{
	
		$cart = $this->loadModel('cart_model'); 		
		$getcheckoutproductlist=$cart->changequantity($_REQUEST);
		
		$template = $this->loadView('partial/cart_table');
		$template->set('addtocartlist',$getcheckoutproductlist);
		$htmlcont=$template->renderinvariable();
		echo json_encode(array("rslt"=>"1","prod_details"=>$htmlcont,"cartcount"=>$getcheckoutproductlist['cartcount']));
	}
	
	function addtocartlist()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('cart_model'); 		
		$data=$common->addtocartlist();
	}
	
	function addtocartcount()
	{
		$common = $this->loadModel('cart_model'); 		
		$data=$common->addtocartcount();
	}
	
	function addtowishlist_insert()
	{
		
		//print_r($_REQUEST); exit;
		if($_SESSION['Cus_ID']=='' && $_SESSION['cus_group_id']==''){
			session_start();
			$_SESSION['type'] = "wishlist";
			$_SESSION['productid'] = $_POST['proid'];
			$_SESSION['minqty'] = $_POST['minqty'];
			$_SESSION['refererurl'] = $_SERVER['HTTP_REFERER'];
			echo json_encode(array("rslt"=>3));
			//echo $_SESSION['refererurlwish']; 
			exit;
		}
		$common = $this->loadModel('wishlist_model'); 		
		$data=$common->addtowishlist_insert($_REQUEST);
	}
	
	function addtowishlistcount()
	{
		$common = $this->loadModel('wishlist_model'); 		
		$data=$common->addtowishlistcount();
	}
	
	function addtowishlist()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('wishlist_model'); 		
		$data=$common->addtowishlist();
	}
	
	function deletewishlistproduct()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('wishlist_model'); 		
		$data=$common->deletewishlistproduct($_REQUEST);
	}
	
	function deletewishlistpageproduct()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('wishlist_model'); 		
		$deletewishlistpageproduct=$common->deletewishlistpageproduct($_REQUEST);
		$template = $this->loadView('partial/wishlist_table');
		$template->set('addtowishlist',$deletewishlistpageproduct['prod_details']);
		$htmlcont=$template->renderinvariable();
		echo json_encode(array("rslt"=>"1","prod_details"=>$htmlcont,"wishlistcount"=>$deletewishlistpageproduct['wishlistcount']));
	}
	
	function selectaddress()
	{
		
		session_start();
		$_SESSION['addressid'] = $_POST['cusaddid'];
		$user = $this->loadModel('user_model'); 	
		$address_info=$user->getaddressdetails($_SESSION['addressid']);
		//print_r($address_info['postalcode']); die();
		//$this->chkzipcode($address_info['postalcode']);
		
		exit;
	}
	
	function checkaddress()
	{
		session_start();
        if(!isset($_SESSION['Cus_ID']) ||  empty($_SESSION['Cus_ID'])){
			//print_r($_SESSION);
		 	if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	
			echo json_encode(array("success"=>"0","tag"=>"3"));
			exit;
			}
			else{
				echo json_encode(array("success"=>"1"));
			}
		}	
		elseif(isset($_SESSION['addressid']) &&  !empty($_SESSION['addressid']))
		{			
			echo json_encode(array("success"=>"1"));
		}
		else
		{
			echo json_encode(array("success"=>"0","tag"=>"1"));
		}
		exit;
	}
	
	function changequantity() 
	{
	
		$cart = $this->loadModel('cart_model'); 	
			
		$getcheckoutproductlist=$cart->changequantity($_REQUEST);

		$template = $this->loadView('partial/checkout_prod_list');
		$template->set('getcheckoutproductlist',$getcheckoutproductlist);
		$htmlcont=$template->renderinvariable();
			
		$template1 = $this->loadView('partial/ordersummary');
		$template1->set('getcheckoutproductlist',$getcheckoutproductlist);
		$template1->set('noofitem',count($getcheckoutproductlist));
        $ordersummaryinfo=$template1->renderinvariable();
	
		$templates = $this->loadView('partial/ordersummarytab');
		$templates->set('getcheckoutproductlist',$getcheckoutproductlist);
		$templates->set('noofitem',count($getcheckoutproductlist));
        $ordersummaryinfotab=$templates->renderinvariable();
			
        if(	isset($_SESSION['Couponcode']) && $_SESSION['Couponcode']!=''){ 
			
			$checkout = $this->loadModel('checkout_model'); 
			
			$datass=$checkout->getcpdiscount($_SESSION['Couponcode']);
		    $arraydata = (json_decode($datass,true));
			$_SESSION['Couponamount'] = $arraydata['couponamt'];
			$_SESSION['CouponCatType'] = $arraydata['CouponCatType'];
		}		
		echo json_encode(array("rslt"=>"1","checkoutpage"=>$htmlcont,"ordersummaryinfo"=>$ordersummaryinfo,"ordersummaryinfotab"=>$ordersummaryinfotab));
		
	}
	
	function giftvoucher()
	{
		//echo "<pre>"; print_r($_REQUEST); exit;
		$common = $this->loadModel('common_model'); 		
		$data=$common->giftvoucher($_REQUEST);
	}
	function isvaildcp()
	{
		
		if(	isset($_REQUEST['cp']) && $_REQUEST['cp']!=''){
			$checkout = $this->loadModel('checkout_model'); 
			$datass=$checkout->getcpdiscount($_REQUEST['cp']);
		    $arraydata = (json_decode($datass,true));
			//echo "<pre>"; var_dump($arraydata); exit;
			
			if($arraydata['rslt']==1 && !empty($arraydata['couponamt'])){
				
				$_SESSION['Couponcode'] = $arraydata['coupon'];
			    $_SESSION['Coupontitle'] = $arraydata['coupontit'];
				$_SESSION['Couponamount'] = $arraydata['couponamt'];
				$_SESSION['coupontype'] = $arraydata['coupontype'];
				$_SESSION['couponvalue'] = $arraydata['couponvalue'];	
				$_SESSION['CouponCatType'] = $arraydata['CouponCatType'];
				$cart = $this->loadModel('cart_model'); 
				
				$getcheckoutproductlist=$cart->cartProductList();
				
				
				$template1 = $this->loadView('partial/ordersummary');
				$template = $this->loadView('partial/couponpage');
				$templates = $this->loadView('partial/ordersummarytab');
				//$template1->set('amouunt',$_SESSION['Couponamount']);
				//$template1->set('coupontitle',$_SESSION['Coupontitle']);
				
				$template1->set('getcheckoutproductlist',$getcheckoutproductlist);
				$template1->set('noofitem',count($getcheckoutproductlist));
				$templates->set('getcheckoutproductlist',$getcheckoutproductlist);
				$templates->set('noofitem',count($getcheckoutproductlist));
				
				$ordersummaryinfo=$template1->renderinvariable();
				$coupondiscount=$template->renderinvariable();
				$ordersummaryinfotab=$templates->renderinvariable();

				echo json_encode(array("rslt"=>"1","ordersummaryinfo"=>$ordersummaryinfo,"coupondiscount"=>$coupondiscount,"ordersummaryinfotab"=>$ordersummaryinfotab));
		    }
			else if($arraydata['rslt']==1 && empty($arraydata['couponamt'])){
				echo json_encode(array('rslt'=>0,'msg'=>" This coupon not matched of selected Products "));
			    exit;
				
			}
			else{
			   
				echo json_encode(array('rslt'=>$arraydata['rslt'],'msg'=>$arraydata['msg']));
			    exit;
			}
	     
		}
	}
	
	function removecoupon()
	{
		$_SESSION['Couponcode'] = '';
		$_SESSION['Coupontitle'] = '';
		$_SESSION['Couponamount'] = '';
		
		 
		    $cart = $this->loadModel('cart_model'); 
			$getcheckoutproductlist=$cart->cartProductList();
			$template1 = $this->loadView('partial/ordersummary');
			$templates = $this->loadView('partial/ordersummarytab');
			
			$template1->set('getcheckoutproductlist',$getcheckoutproductlist);
			$template1->set('noofitem',count($getcheckoutproductlist));
			$templates->set('getcheckoutproductlist',$getcheckoutproductlist);
			$templates->set('noofitem',count($getcheckoutproductlist));
			
			$ordersummaryinfo=$template1->renderinvariable();
			$ordersummaryinfotab=$templates->renderinvariable();

			

		echo json_encode(array("rslt"=>"1","ordersummaryinfo"=>$ordersummaryinfo,"ordersummaryinfotab"=>$ordersummaryinfotab));
		//echo json_encode(array("rslt"=>"1","msg"=>"Coupon Removed successfully"));
	}
	
	function shippingcharge()
	{
		if(isset($_REQUEST['sp']) && $_REQUEST['sp']!=''){
			$_SESSION['shippingid'] = $_REQUEST['id'];
            $_SESSION['shippingCode'] = $_REQUEST['sp']; 
		    $checkout = $this->loadModel('checkout_model'); 
			$data=$checkout->modelname($_REQUEST['sp']);
			//echo $data['modelname']; exit;
			$shipping = $this->loadModel($data['modelname']);
		    $datas=$shipping->shippingfunction($data['shippingId']);
			//print_r($datas);
			  $_SESSION['pricetype'] = $datas['pricetype'];
			  $_SESSION['shippingCost'] = $datas['shippingCost'];
			  
			  //echo $_SESSION['granttotal']; exit;
			$cart = $this->loadModel('cart_model'); 
			$getcheckoutproductlist=$cart->cartProductList();
			$template1 = $this->loadView('partial/ordersummary');
			$templates = $this->loadView('partial/ordersummarytab');
			
			$template1->set('getcheckoutproductlist',$getcheckoutproductlist);
			$template1->set('noofitem',count($getcheckoutproductlist));
			$templates->set('getcheckoutproductlist',$getcheckoutproductlist);
			$templates->set('noofitem',count($getcheckoutproductlist));
			
			$ordersummaryinfo=$template1->renderinvariable();
			$ordersummaryinfotab=$templates->renderinvariable();
			//print_r($_SESSION);
			echo json_encode(array("rslt"=>"1","ordersummaryinfo"=>$ordersummaryinfo,"ordersummaryinfotab"=>$ordersummaryinfotab));  
		}
	}
	
	function Paymentgatewaytype()
	{
		
	
		if(isset($_REQUEST['pgwaycode']) && $_REQUEST['pgwaycode']!=''){
			
			$_SESSION['pay_code'] = $_REQUEST['pgwaycode'];			
			$_SESSION['pay_id'] = $_REQUEST['id'];
		}
	}
	
	
	
	function checkpayment()
	{
		session_start();
		
		if(!isset($_SESSION['Cus_ID']) ||  empty($_SESSION['Cus_ID'])){
		if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	
			echo json_encode(array("success"=>"0","tag"=>"3"));
			exit;
		}
		}
		if(!isset($_SESSION['addressid']) ||  empty($_SESSION['addressid'])){
		
			echo json_encode(array("success"=>"0","tag"=>"1"));
			exit;
		}
		if(!isset($_SESSION['shippingid']) ||  empty($_SESSION['shippingid']))	
		{			
			echo json_encode(array("success"=>"0","tag"=>"4"));
			exit;
		}
		if(isset($_SESSION['pay_code']) &&  !empty($_SESSION['pay_code']))
		{		
			//echo $_SESSION['pay_code'];
			echo json_encode(array("success"=>"1"));
		}
		else
		{
			echo json_encode(array("success"=>"0","tag"=>"2"));
		}
		exit;
		
	}
	
	
	function checkshipping()
	{
		session_start();
		//print_r($_SESSION);
		if(!isset($_SESSION['Cus_ID']) ||  empty($_SESSION['Cus_ID'])){
			if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	
			echo json_encode(array("success"=>"0","tag"=>"3"));
			exit;
			}			
		}
		if(!isset($_SESSION['addressid']) ||  empty($_SESSION['addressid'])){
		
			echo json_encode(array("success"=>"0","tag"=>"1"));
			exit;
		}
		
		if(isset($_SESSION['shippingid']) &&  !empty($_SESSION['shippingid']))
		{			
			echo json_encode(array("success"=>"1"));
		}
		else
		{
			echo json_encode(array("success"=>"0","tag"=>"2"));
		}
		exit;
		
	}
	
	function customimghandler()
	{
		require_once(dirname(__FILE__).'/fpd-image-utils.php');
		
		
		
		$valid_mime_types = array(
			"image/png",
			"image/jpeg",
			"image/pjpeg",
			"image/svg+xml"
		);

		 $uploads_dir = $_POST['uploadsDir'];
		 $uploads_dir_url = $_POST['uploadsDirURL'];
		 $save_on_server = isset($_POST['saveOnServer']) ? (int) $_POST['saveOnServer'] : false;
		
		if(empty($uploads_dir) || empty($uploads_dir_url)) {
			die( json_encode(array('error' => 'You need to define a directory, where you want to save the uploaded user images!')) );
		}

		if(!function_exists('getimagesize')) {
			die( json_encode(array('error' => 'The php function getimagesize is not installed on your server. Please contact your server provider!')) );
		}
		
		
//upload image
if(isset($_FILES) && sizeof($_FILES) > 0) {

	$warning = null;

	foreach($_FILES as $fieldName => $file) {

		// First things first: input sanitation and security checks
		try {
			$sanitized_name = FPD_Image_Utils::sanitize_filename($file['name'][0]);
		}
		catch (Exception $e) {
			die(json_encode(array('error' => $e->getMessage())));
		}

		// Determining file name parts using pathinfo() instead of explode()
		// prevents double extensions (file.jpg.php) and directory traversal (../../file.jpg)
		$parts = pathinfo($sanitized_name);
		$filename = $parts['filename'].'_'.time();
		$ext = strtolower($parts['extension']);

		//check for php errors
		if( isset($file['error']) && $file['error'][0] !== UPLOAD_ERR_OK ) {
			die( json_encode( array(
				'error' => FPD_Image_Utils::file_upload_error_message($file['error'][0]),
				'filename' => $filename
			)) );
		}

		//check if its an image
		if( (!getimagesize($file['tmp_name'][0]) && $ext !== 'svg') || !in_array($file['type'][0], $valid_mime_types) ) {
			die( json_encode(array(
				'error' => 'This file is not an image!',
				'filename' => $filename
			)) );
		}
			
		$upload_path = FPD_Image_Utils::get_upload_path($uploads_dir, $filename, $ext);
		 $image_path = $upload_path['full_path'].'.'.$ext;
		 $image_url = $uploads_dir_url.'/'.$upload_path['date_path'].'.'.$ext;
		
		if( @move_uploaded_file($file['tmp_name'][0], $image_path) ) {

					if($ext === 'jpg' || $ext === 'jpeg') {

						if(  function_exists('exif_read_data') ) {
							$exif = @exif_read_data($image_path);
							if ($exif && isset($exif['Orientation']) && !empty($exif['Orientation'])) {

								$image = imagecreatefromjpeg($image_path);
								unlink($image_path);
								switch ($exif['Orientation']) {
									case 3:
										$image = imagerotate($image, 180, 0);
										break;

									case 6:
										$image = imagerotate($image, -90, 0);
										break;

									case 8:
										$image = imagerotate($image, 90, 0);
										break;
								}

								imagejpeg($image, $image_path, 90);
							}
						}
						else
							$warning = 'exif_read_data function is not enabled.';

					}
					$_SESSION['customimg'][]= $filename.'.'.$ext;
					echo json_encode( array(
						'image_src' => $image_url,
						'filename' => $filename,
						'warning' => $warning
					) );

				}
				else {

					echo json_encode( array(
						'error' => 'PHP Issue - move_upload_file failed.',
						'filename' => $filename
					) );

				}

			}

			die;

		}
		$url = $_POST['url'];
		$mime_type = FPD_Image_Utils::is_image($url);
		if ( $mime_type === false ) {
			$last_error = error_get_last();
			die( json_encode(array('error' => is_array($last_error) ?  $last_error['message'] : 'File is not an image!')) );
		}

		$ext = str_replace('image/', '', $mime_type);

		if($save_on_server) {

			$unique_name = @date() === false ? md5(gmdate('Y-m-d H:i:s:u')) : md5(date('Y-m-d H:i:s:u')); //create an unique name
			$upload_path = FPD_Image_Utils::get_upload_path($uploads_dir, $unique_name);
			$image_path = $upload_path['full_path'].'.'.$ext;
			$image_url = $uploads_dir_url.'/'.$upload_path['date_path'].'.'.$ext;

		}

		//use curl
		$result = false;
		if( function_exists('curl_exec') ) {

			try {

				////create image on server from url
				if($save_on_server) {

					$ch = curl_init($url);
					$fp = fopen($image_path, 'wb');
					curl_setopt($ch, CURLOPT_FILE, $fp);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					$result = curl_exec($ch);
					curl_close($ch);
					fclose($fp);

				}
				//get data uri from url
				else {

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
					$result = curl_exec($ch);
					curl_close($ch);

					$info = getimagesize($url);
					$image_url = 'data: '.$info['mime'].';base64,'.base64_encode($result);

				}

			}
			catch(Exception $e) {

			}

		}

		//curl not working, try other functions
		if($result === false) {

			//create image on server from data uri
			if($save_on_server) {
				file_put_contents($image_path, file_get_contents($url));
				$result = file_get_contents($url);
			}
			//get data uri from url
			else {
				$result = file_get_contents($url);
				$info = getimagesize($url);
				$image_url = 'data: '.$info['mime'].';base64,'.base64_encode($result);
			}

		}

		if($result) {
			echo json_encode(array( 'image_src' => $image_url));
		}
		else {
			echo json_encode(array('error' => 'The image could not be created. Please view the error log file of your server to see what went wrong!'));
		} 
		
		
	}
	
	function clearcustomimg()
	{
		 $_SESSION['customimg']=array();
	}
	
	function remembercookie()
	{
		//print_r($_REQUEST); exit;
		$user = $this->loadModel('user_model'); 		
		$data=$user->remembercookie($_REQUEST);
		
	}
	
	function updateRecentview(){
		$user = $this->loadModel('user_model'); 		
		$data=$user->updateRecentview($_REQUEST);
	}
	
	function prodattrchangetheme(){
		
		
		 if($_SERVER['CONTENT_TYPE']=="application/json")
		 { 
			$input = file_get_contents('php://input');
			$str=json_decode($input); 
		 }
		 
		 parse_str($str, $filter);
		
			$did=array();
			$aid=array();

			foreach($filter as $key=>$valu)

			{

				if(strpos($key,"selattr_")!== false)

				{

					$did[]=	$valu;

					$aid[]=(explode("_",$key))[1];

				}	

				if(strpos($key,"iconatt_")!== false)

				{

					$did[]=	$valu;

					$aid[]=(explode("_",$key))[1];

				}	

			}
				if(isset($filter['sku']) && $filter['sku']!='')

				 $prodsku=$filter['sku'];
				
				//echo $prodsku;
				//echo $filter['proid'];
				
				// print_r($did);
				 //print_r($aid);
				//die();
				$product=$this->loadModel('product_model');
				//print_r($_REQUEST);
				$productdetails=$product->productdetails('','',$filter['proid'],$prodsku,$did,$aid);
				
				//print_r($productdetails); die();
				
				$getmaximum_dp = $product->getmaximumdiscountslapprice();				
				$template1 = $this->loadView('partial/products_price');
				$template1->set('productdetails',$productdetails);	
				$template1->set('getmaximum_dp',$getmaximum_dp); 
				$pricedetails=$template1->renderinvariable();	
				//echo "<pre>";
				//print_r($productdetails);die();
				//die();
				$template2 = $this->loadView('partial/products_image_change_theme');
				$template2->set('productdetails',$productdetails);	
				$imgdetails=$template2->renderinvariable();	
				
				echo json_encode(array("rslt"=>$pricedetails,"changeimg"=>$imgdetails));	
		
	
	}
	
	function prodattrchange()
	{
		
		 if($_SERVER['CONTENT_TYPE']=="application/json")
		 { 
			$input = file_get_contents('php://input');
			$str=json_decode($input); 
		 }
		 
		 parse_str($str, $filter);
		
			$did=array();
			$aid=array();

			foreach($filter as $key=>$valu)

			{

				if(strpos($key,"selattr_")!== false)

				{

					$did[]=	$valu;

					$aid[]=(explode("_",$key))[1];

				}	

				if(strpos($key,"iconatt_")!== false)

				{

					$did[]=	$valu;

					$aid[]=(explode("_",$key))[1];

				}	

			}
				if(isset($filter['sku']) && $filter['sku']!='')

				 $prodsku=$filter['sku'];
				
				//echo $prodsku;
				//echo $filter['proid'];
				
				// print_r($did);
				 //print_r($aid);
				//die();
				$helper=$this->loadHelper('common_function'); 
				$product=$this->loadModel('product_model');
				 $detaildisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'productdetail');
			
				//print_r($_REQUEST);
				$productdetails=$product->productdetails('','',$filter['proid'],$prodsku,$did,$aid);
				
				//print_r($productdetails); die();
				
				$getmaximum_dp = $product->getmaximumdiscountslapprice();				
				$template1 = $this->loadView('partial/products_price');
				$template1->set('productdetails',$productdetails);	
				$template1->set('detaildisplaylanguage',$detaildisplaylanguage);	
				$template1->set('getmaximum_dp',$getmaximum_dp); 
				$pricedetails=$template1->renderinvariable();	
				//echo "<pre>";
				//print_r($productdetails);die();
				//die();
				$template2 = $this->loadView('partial/products_image_change');
				$template2->set('productdetails',$productdetails);	
				$imgdetails=$template2->renderinvariable();	
				
				echo json_encode(array("rslt"=>$pricedetails,"changeimg"=>$imgdetails));	
		
	}
	
	function chkzipcode($pincode='')
	{
		$temppin=$_REQUEST['pin'];
		if($pincode!='')
		{
			$temppin=$pincode;
		}
		//echo $temppin;
		$checkout = $this->loadModel('checkout_model'); 
		$shippingmet=$checkout->ChkDeliveryAvail($temppin);
		
		if(count($shippingmet)>0)
		{
			$_SESSION['shippincode']=$temppin;
			echo '1';
		}
		else{
			$_SESSION['shippincode']=$temppin;
			echo '0';
		}	
	}
	function guestcheckout()
	{
		session_start();
		$_SESSION['Isguestcheckout']=1;
		$_SESSION['guestckout_sess_id']=session_id();
		echo json_encode(array("rslt"=>"1"));
	}
	
	function getShippingMethod()
	{
		$cart=$this->loadModel('cart_model');
		$chkout=$this->loadModel('checkout_model');
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
		$user=$this->loadModel('user_model');
		
		$resaddressinfo=$user->getaddressdetails($_SESSION['addressid']);
		
		//$_SESSION['shippingid']='';
		$shippingmethod = $chkout->shippingmethod($totgrant,'','','',$resaddressinfo['postalcode']);
		
		$template = $this->loadView('partial/shippingmethod');
			$template->set('shippingmethod',$shippingmethod);	
			if(count($shippingmethod)>0 ){
				
				if(count($shippingmethod)==1)
				{
					//print_r($shippingmethod);
					$_SESSION['shippingid']=$shippingmethod[0]['shippingId'];
					
						$_SESSION['shippingCode'] = $shippingmethod[0]['shippingCode']; 
						$shipping = $this->loadModel($shippingmethod[0]['modelname']);
						$datas=$shipping->shippingfunction($shippingmethod[0]['shippingId']);
						//print_r($datas);
						$_SESSION['pricetype'] = $datas['pricetype'];
						$_SESSION['shippingCost'] = $datas['shippingCost'];
					//	print_r($_SESSION);
				}
				
				
			}		
		$htmlcont=$template->renderinvariable(); 
		echo json_encode(array("rslt"=>1,"shippingmet"=>$htmlcont));
	}
	
	function prodattrchange_price()
	{
		
		 if($_SERVER['CONTENT_TYPE']=="application/json")
		 { 
			$input = file_get_contents('php://input');
			$str=json_decode($input); 
		 }
		 
		 parse_str($str, $filter);
		
			$did=array();
			$aid=array();

			foreach($filter as $key=>$valu)

			{

				if(strpos($key,"selattr_")!== false)

				{

					$did[]=	$valu;

					$aid[]=(explode("_",$key))[1];

				}	

				if(strpos($key,"iconatt_")!== false)

				{

					$did[]=	$valu;

					$aid[]=(explode("_",$key))[1];

				}	

			}
				if(isset($filter['sku']) && $filter['sku']!='')

				 $prodsku=$filter['sku'];
				
				//echo $prodsku;
				//echo $filter['proid'];
				
				//print_r($did);
				//print_r($aid);
				
				$product=$this->loadModel('product_model');
				//print_r($_REQUEST);
				$productdetails=$product->productdetails('','',$filter['proid'],$prodsku,$did,$aid);
				//print_r($productdetails);	die();
				
				echo json_encode(array("rslt"=>"1","pricedetails"=>number_format($productdetails['final_price'],2)));	
		
	}
	
	function cartproduct_language(){
		$cart=$this->loadModel('cart_model');
		$cartproduct_update = $cart->updateallcartproduct($_REQUEST['langid']);
		return $cartproduct_update;
	}
	
}
?>
