<?php
class home extends Controller {

	function index($maincat='',$subcat='',$subplus='',$producturl='')

	{
	 

		//Condition for corporate-gifts User
		if(($maincat=='corporate-gifts' && $_SESSION['cus_group_id']=='') || ($maincat=='corporate-gifts' && $_SESSION['cus_group_id']!='2')){
			$this->redirect('login');
		    exit;
		}

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
		$newsevents=$this->loadModel('newsevents_model');

		if(($catid==0 || $catid=='') && $producturl==''){   /*Home Page */
			$_SESSION['refererurl'] = '';
			$getbannerdisplay  = $common->getbannerdisplay("Main Banner");			 
			$getbannerdisplayaward  = $common->getbannerdisplay("Award Receiver");
			$getnewsevents  = $newsevents->getnewsevents('homepage');
			$getourclientslogo  = $common->getourclientslogo("client");
			$getmemberoflogo  = $common->getourclientslogo("memberof");
			$getbrandtieuplogo  = $common->getourclientslogo("brandtieup");
			$singlehomeproduct=$product->productlists('','','','','','','','homeproduct');	
			$trendingcategorys=$product->trendingcategorys();
			$homevideolists=$product->homevideolists();	
			$testimoniallist=$common->testimoniallist();			
			$configmetatag = $common->common_metatag("config");
		
			$template = $this->loadView('home_view');
			
			
if($_SESSION['lang_id'] == 1){
	//if (strpos($_SERVER['REQUEST_URI'], "/en") !== false){
 

			$headcss='<title>'.$configmetatag['title'].' - EN</title>

					  <meta name="description" content="'.$configmetatag['description'].'">

					  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
}else if($_SESSION['lang_id'] == 2){
    //if (strpos($_SERVER['REQUEST_URI'], "/spn") !== false){
    	$headcss='<title>'.$configmetatag['title'].' SP</title>

					  <meta name="description" content="'.$configmetatag['description'].'">

					  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
}else if($_SESSION['lang_id'] == 3){
    //if (strpos($_SERVER['REQUEST_URI'], "/pt") !== false){
    
    	$headcss='<title>'.$configmetatag['title'].' - PT</title>

					  <meta name="description" content="'.$configmetatag['description'].'">

					  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
}

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
			$template->set('trendingcategorys',$trendingcategorys);
			$template->set('homevideolists',$homevideolists);
			$template->set('testimoniallist',$testimoniallist);
			$template->set('helper',$helper);
			$helper->unsetguestchkout();			
		}

		else if(!empty($catid) && $producturl=='')  /* prtoduct List Page */
		{					
			$helper->unsetguestchkout();
			$_SESSION["filter"]="";
			$promotionbanner  = $common->getbannerdisplay("Promotion Banner");
			$fliterdetails=$product->displayfilter('',$catid);
			$productlists=$product->productlists('',$catid);			
			$SortBy=$product->getSortBy();
			$attributemaster_list = $common->attributemaster_list(20);
			$categorymetatag = $common->common_metatag("category",$catid); 		
			$pageindex=1;
			$getmemberoflogo  = $common->getourclientslogo("client");
			$getCategoryDetail = $common->categoryDetail($catid);

			$template = $this->loadView('productlist_view');
			
			$headcss='<title>'.$categorymetatag['categoryMetatitle'].'</title>
					  <meta name="description" content="'.$categorymetatag['categoryMetadesc'].'">
					  <meta name="keywords" content="'.$categorymetatag['categoryMetakey'].'">';
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
			$template->set('helper',$helper);
			$template->set('getourclientslogo',$getmemberoflogo);
		}

		else if(!empty($catid) && $producturl!='') /* Detail Page */

		{   
		  //echo $maincat; exit;
		
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
			
			$othercategorylist=$product->othercategorylist($productdetails['categoryID']);	
			//echo "<pre>"; print_r($othercategorylist); die();
			
			$productfilter=$product->productPricevariationFilter('',$catid,$producturl);
			
			
			
			
			$productattributes=$product->productFrontAttr('',$catid,$producturl,array(),array("video"));
			
			$productattributes_video=$product->productFrontAttr('',$catid,$producturl,array("video"));
			
			//print_r($productattributes_video); die();
			
			$productmetatag = $common->common_metatag("product",$producturl);

			$getmaximum_dp = $product->getmaximumdiscountslapprice();
			 
		 	$getproductfeature = $product->getproductfeature_list($productdetails['product_id']);
			
			
 
			$getourclientslogo  = $common->getourclientslogo("client");
			$filter=array("colorattr"=>"");
			$colorproductlists=$product->productlists('','','','1',$filter,'10','','producturl',$producturl);
			
			$recentviewproduct=$product->productlists('','','','','','','','recentview');
			
			
			 ############## product feature start ################
			 $productfeaturedetail = $product->productdetailsfetured($productdetails['product_id'],'');
			 $feature_specialfeature = $product->productdetailsfetured($productdetails['product_id'],'specialfeature');
			  $feature_specification = $product->productdetailsfetured($productdetails['product_id'],'specification');
			   
			  
			 $feature_additionalfeature = $product->productdetailsfetured_additional($productdetails['product_id'],3,'1,2','0,2');
			 $feature_additionalfeature_listtype = $product->productdetailsfetured_additional($productdetails['product_id'],'1,2','1');
			 
			 ####### new #############
			 $feature_additional_list_video = $product->productdetailsfetured_additional($productdetails['product_id'],'','2');
			 $feature_additional_list_image = $product->productdetailsfetured_additional($productdetails['product_id'],'','1');
			
 			 
			 ############## product feature end ################
  

			$checkout = $this->loadModel('checkout_model'); 
			$shippingmet=$checkout->ChkDeliveryAvail($_SESSION['shippincode']);
 			if(count($shippingmet)>0)
			{
				$isshippingavail=1;
			}else{
				$isshippingavail=0;
			}		
			
			  if($productdetails['isfeaturedproduct'] == 1 && $productdetails['themeid'] == 1){
				$template = $this->loadView('product_details_view_theme1');
			}
			else if($productdetails['isfeaturedproduct'] == 1 && $productdetails['themeid'] == 2){
				$template = $this->loadView('product_details_view_theme2');
			}
			else if($productdetails['isfeaturedproduct'] == 1 && $productdetails['themeid'] == 3){
				$template = $this->loadView('product_details_view_theme3');
			}else{
				$template = $this->loadView('product_details_view');
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
			
			####### new start #############
			$template->set('feature_additional_list_video',$feature_additional_list_video);
			$template->set('feature_additional_list_image',$feature_additional_list_image);
			####### new end #############
			
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
			$template->set('othercategorylist',$othercategorylist); 
			$template->set('productfilter',$productfilter);		
            $template->set('getmaximum_dp',$getmaximum_dp); 	
			$template->set('maincat',$maincat);
			$template->set('colorproductlists',$colorproductlists);		
$template->set('helper',$helper);

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

