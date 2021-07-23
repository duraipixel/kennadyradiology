<?php
class home extends Controller {

	function index($maincat='',$subcat='',$subplus='',$producturl='')

	{

		

		$plugin=$this->loadPlugin('checkcategorypath');

		

		$chkvalidcat='';

		$catid='0';

		if($subplus!='')

		{

			$chkvalidcat=$subplus;

		}

		else if($subcat!='')

		{

			$chkvalidcat=$subcat;

		}

		else if($maincat!='')

		{

			$chkvalidcat=$maincat;

		}

		//echo "ggg"; die();

		// print_r($maincat);

		// echo '---';

		// print_r($subcat);

			// echo '---';

		// print_r($subplus);

			// echo '---';

	  //  print_r($_REQUEST); die();

	  

	  if(substr($subplus, 0, 1) =="?")

	  {

		  $chkvalidcat=$maincat;

		  $producturl=$subcat;

	  }

	  

	  $_SESSION['customimg']=array();

	  

	  $product=$this->loadModel('product_model');

	  

		$allcat=$plugin->getCategoryAll();

		if($chkvalidcat!=''){

			 $catid=$plugin->searchCategoryId($chkvalidcat,$allcat,'categoryCode','categoryID');

			if(empty($catid) || $catid=='')

			{

				if(!$product->IsVaildProduct($chkvalidcat))

					{

						$this->redirect_301('');

					}

					else{

						 

							if($maincat!='' && $maincat!=$chkvalidcat)

							{

								$revvalidcat=$maincat;

							}

							if($subcat!='' && $subcat!=$chkvalidcat)

							{

								$revvalidcat=$subcat;

							}

							if($subplus!=''&& $subplus!=$chkvalidcat)

							{

								$revvalidcat=$subplus;

							}

							

						

						 $catid=$plugin->searchCategoryId($revvalidcat,$allcat,'categoryCode','categoryID');

						$producturl=$chkvalidcat;

					}

			}

		} 

		$common=$this->loadModel('common_model');
		
			
		 $helper=$this->loadHelper('common_function'); 
		 
		 //	echo "ggg"; die();
	  

		$newsevents=$this->loadModel('newsevents_model');

		if(($catid==0 || $catid=='') && $producturl==''){   /*Home Page */
		
		

			$_SESSION['refererurl'] = '';

			$getbannerdisplay  = $common->getbannerdisplay("Main Banner");
			//print_r($getbannerdisplay); die();
			$getbannerdisplayaward  = $common->getbannerdisplay("Award Receiver");

			$getnewsevents  = $newsevents->getnewsevents('homepage');

			$getourclientslogo  = $common->getourclientslogo("client");

			$getmemberoflogo  = $common->getourclientslogo("memberof");

			$getbrandtieuplogo  = $common->getourclientslogo("brandtieup");

			$singlehomeproduct=$product->productlists('','','','','','','','homeproduct');	
			
			$trophies_award=$product->productlists('trophies-award','','','1','','10','0');		
	
			//print_r($trophies_award); die();
 
			$configmetatag = $common->common_metatag("config");

		

			$template = $this->loadView('home_view');

		

			$headcss='<title>'.$configmetatag['title'].'</title>

					  <meta name="description" content="'.$configmetatag['description'].'">

					  <meta name="keywords" content="'.$configmetatag['keyword'].'">';

			$template->set('menu_disp', 'home');	 

			$template->set('headcss',$headcss);
 
			$template->set('getbannerdisplay',$getbannerdisplay);

			$template->set('getbannerdisplayaward',$getbannerdisplayaward);

			$template->set('getnewsevents',$getnewsevents);

			$template->set('getourclientslogo',$getourclientslogo);			

			$template->set('getbrandtieuplogo',$getbrandtieuplogo);

			$getmemberoflogo  = $common->getourclientslogo("memberof");

			$template->set('getmemberoflogo',$getmemberoflogo);
			$template->set('singlehomeproduct',$singlehomeproduct);
			
		
			//if(isset($_SESSION['fff']))			 
				  $helper->unsetguestchkout();
			 // $_SESSION['shippincode']='';
			  
			//  print_r("vvv"); die();
			//$template->set('addtocartcount',$addtocartcount);

			//$template->set('addtocartlist',$addtocartlist);

		}

		else if(!empty($catid) && $producturl=='')  /* prtoduct List Page */

		{
			
			$helper->unsetguestchkout();

			//$_SESSION['refererurl'] = '';

			$_SESSION["filter"]="";

$promotionbanner  = $common->getbannerdisplay("Promotion Banner");

			$fliterdetails=$product->displayfilter('',$catid);


//echo $catid;die();
			$productlists=$product->productlists('',$catid);
			

			$SortBy=$product->getSortBy();

	$attributemaster_list = $common->attributemaster_list(20);
			$categorymetatag = $common->common_metatag("category",$catid);
 
			//echo "<pre>"; print_r($catid); print_r($productlists); die();

			$pageindex=1;

			$template = $this->loadView('productlist_view');

			$headcss='<title>'.$categorymetatag['categoryMetatitle'].'</title>

						<meta name="description" content="'.$categorymetatag['categoryMetadesc'].'">

					  <meta name="keywords" content="'.$categorymetatag['categoryMetakey'].'">'

					  ;
					  $template->set('maincat',$maincat);
			$template->set('promotionbanner',$promotionbanner);
			$template->set('menu_disp', 'home');	 
			$template->set('attributemaster_list',$attributemaster_list);	 
			$template->set('headcss',$headcss);

			$template->set('catid',$catid);

			$template->set('page',$pageindex);

			$template->set('productlists',$productlists['prod_list']);			

			$template->set('productscount',$productlists['totcnt']);

			$template->set('fliter_list',$fliterdetails['fliter_list']);

			$template->set('fliter_price',$fliterdetails['pricefilter']);

			$template->set('SortBy',$SortBy);
			
			//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();

			$getmemberoflogo  = $common->getourclientslogo("client");
			
			//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();

			$template->set('getourclientslogo',$getmemberoflogo);

			//echo "test";
			//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();

		}

		else if(!empty($catid) && $producturl!='') /* Detail Page */

		{   
		
			$helper->unsetguestchkout();
			$_SESSION['refererurl'] = '';

		//	echo 'jjj'; die();

			if(!$product->IsVaildProduct($producturl))

			{

				$this->redirect_301('');

			}

			$did=array();

			$aid=array();

			foreach($_REQUEST as $key=>$valu)

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

			

			$plugin->getStoreConfigPlugin();

			$prodsku='';

			if(isset($_REQUEST['sku']) && $_REQUEST['sku']!='')

				$prodsku=$_REQUEST['sku'];

			$productdetails=$product->productdetails('',$catid,$producturl,$prodsku,$did,$aid);			
			
			
			$productfilter=$product->productPricevariationFilter('',$catid,$producturl);
			
			//print_r($productfilter); die();
			$productattributes=$product->productFrontAttr('',$catid,$producturl,array(),array("video"));
			
			$productattributes_video=$product->productFrontAttr('',$catid,$producturl,array("video"));
			
			//print_r($productattributes_video); die();
			
			$productmetatag = $common->common_metatag("product",$producturl);

			$getmaximum_dp = $product->getmaximumdiscountslapprice();
			 
		 	$getproductfeature = $product->getproductfeature_list($productdetails['product_id']);
			
			$recentviewproduct=$product->productlists('','','','','','','','recentview');
 
			$getourclientslogo  = $common->getourclientslogo("client");
 
 
			 ############## product feature start ################
			 $productfeaturedetail = $product->productdetailsfetured($productdetails['product_id'],'');
			 $feature_specialfeature = $product->productdetailsfetured($productdetails['product_id'],'specialfeature');
			  $feature_specification = $product->productdetailsfetured($productdetails['product_id'],'specification');
			  
			 $feature_additionalfeature = $product->productdetailsfetured_additional($productdetails['product_id'],3,'1,2','0,2');
			 $feature_additionalfeature_listtype = $product->productdetailsfetured_additional($productdetails['product_id'],'1,2','1');
			
			 ############## product feature end ################
  

			$checkout = $this->loadModel('checkout_model'); 
			$shippingmet=$checkout->ChkDeliveryAvail($_SESSION['shippincode']);
 			if(count($shippingmet)>0)
			{
				$isshippingavail=1;
			}else{
				$isshippingavail=0;
			}		
			
			if($productdetails['isfeaturedproduct'] == 0){
				$template = $this->loadView('product_details_view');
			}else if($productdetails['isfeaturedproduct'] == 1 && $productdetails['themeid'] == 1){
				$template = $this->loadView('product_details_view_theme1');
			}
			else if($productdetails['isfeaturedproduct'] == 1 && $productdetails['themeid'] == 2){
				$template = $this->loadView('product_details_view_theme2');
			}
			else if($productdetails['isfeaturedproduct'] == 1 && $productdetails['themeid'] == 3){
				$template = $this->loadView('product_details_view_theme3');
			}

			$headcss='<meta name="description" content="'.$productmetatag['metadescription'].' '.$plugin->getConfigvalue('storeMetaDesc').'">

					  <meta name="keywords" content="'.$productmetatag['metakeyword'].' '.$plugin->getConfigvalue('storeMetaKey').'">

					  <title>'.$productdetails['product_name'].' - '.$productmetatag['metaname'].' '.$plugin->getConfigvalue('storeMetaTitle').'</title>';

			$template->set('menu_disp', 'home');	 

			$template->set('headcss',$headcss);

			$template->set('catid',$catid);

			$template->set('page',$pageindex);

			
			$template->set('isshippingavail',$isshippingavail);
			$template->set('recentviewproduct',$recentviewproduct);

 	$template->set('getproductfeature',$getproductfeature);
	$template->set('additionalfeature_listtype',$feature_additionalfeature_listtype);

			$template->set('getourclientslogo',$getourclientslogo);

			$template->set('route',trim($_REQUEST['route'],"/"));

			$template->Set('productattributes_video',$productattributes_video);

			$template->set('aid',$aid);

			$template->set('sku',$_REQUEST['sku']);

			$template->set('did',$did);

			$template->set('productattributes',$productattributes);

			$template->set('productdetails',$productdetails);

			$template->set('productfilter',$productfilter);		

            $template->set('getmaximum_dp',$getmaximum_dp); 			


  $template->set('productfeaturedetail',$productfeaturedetail);
   $template->set('feature_specialfeature',$feature_specialfeature);
    $template->set('feature_additionalfeature',$feature_additionalfeature);
	 $template->set('feature_specification',$feature_specification);
	 
	 
		}

			
	//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();
		$template->render();    
		//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();

	}		

	

}



?>

