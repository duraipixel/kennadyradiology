<?php
error_reporting(1);
class home extends Controller {
	public $product_repository;
	public $proFilter_repository;
	public function __construct() {
		$this->product_repository = $this->repository('product_repository');
		$this->proFilter_repository = $this->repository('product_filter_repository');
	}

	function index($maincat='',$subcat='',$subplus='',$producturl='',$ids='')
	{
		if(($maincat=='corporate-gifts' && $_SESSION['cus_group_id']=='') || ($maincat=='corporate-gifts' && $_SESSION['cus_group_id']!='2')){
			$this->redirect('login');
		    exit;
		}
		$plugin=$this->loadPlugin('checkcategorypath');	
		$chkvalidcat='';
		$catid='0';

		if($subplus!='' && $subcat != 'filter')
		{
			$chkvalidcat=$subplus;
		} else if($subcat!='' && $subcat != 'filter')
		{
			$chkvalidcat=$subcat;
		} else if($maincat!='')
		{
			$chkvalidcat=$maincat;
		}
	   	if(substr($subplus, 0, 1) =="?" && $subcat != 'filter')
	   	{
			$chkvalidcat=$maincat;
			$producturl=$subcat;
	  	}

		$_SESSION['customimg'] 	= array();	 
		$product				= $this->loadModel('product_model');	 
		$allcat 				= $plugin->getCategoryAll();
		//only for home page apron category display
		$aproncatid 			= $plugin->searchCategoryId(apronname,$allcat,'categoryCode','categoryID');
		//end
		if($chkvalidcat!=''){
			$catid 				= $plugin->searchCategoryId($chkvalidcat,$allcat,'categoryCode','categoryID');
			// echo $aproncatid."kk";die();
			if(empty($catid) || $catid=='')
			{
				if(!$product->IsVaildProduct($chkvalidcat))
				{
					if($subcat != 'filter'){
						$this->redirect_301('');
					}
				} else {
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

		$common 		= $this->loadModel('common_model');		
		$helper 		= $this->loadHelper('common_function'); 
		$newsevents 	= $this->loadModel('newsevents_model');
		
		if(($catid==0 || $catid=='') && ($producturl=='' && $subcat != 'filter')){
			
			/*Home Page */
			$_SESSION['refererurl'] = '';
			$getbannerdisplay  = $common->getbannerdisplay("Main Banner");			 
			$trendingcategorys=$product->trendingcategorys();
			$configmetatag = $common->common_metatag("config");
			$homedisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'home');
			$homeProducts 			= $this->proFilter_repository->getDefaultProductList('displayinhome');
			$featureProducts 		= $this->proFilter_repository->getDefaultProductList('isfeatured');
			// echo '<pre>';
			// print_r( $homeProducts );die;
			$fliterdetails_apron=$product->displayfilter('',$aproncatid);
			$recentviewproduct = $product->productlists('','','','','','','','displayhome');
			 
			if( $_SESSION['lang_id'] == 1 ) {
				$headcss 		= '<title>Radiation Protection Shields supplier  - Kennedy Radiology</title>
									<meta name="description" content="Kennedy Radiology is an US based medical equipment business that manufactures and supplies worldwide with quality of Radiation Protection Shields">
									<meta name="keywords" content="'.$configmetatag['keyword'].'">';
			} else if( $_SESSION['lang_id'] == 2 ) {
				//if (strpos($_SERVER['REQUEST_URI'], "/spn") !== false){
				$headcss 		= '<title>Radiation Protection Shields supplier  - Kennedy Radiology</title>
									<meta name="description" content="Kennedy Radiology is an US based medical equipment business that manufactures and supplies worldwide with quality of Radiation Protection Shields">
									<meta name="keywords" content="'.$configmetatag['keyword'].'">';
			}else if( $_SESSION['lang_id'] == 3 ) {
				//if (strpos($_SERVER['REQUEST_URI'], "/pt") !== false){
				$headcss		= '<title>Radiation Protection Shields supplier  - Kennedy Radiology</title>
									<meta name="description" content="Kennedy Radiology is an US based medical equipment business that manufactures and supplies worldwide with quality of Radiation Protection Shields">
									<meta name="keywords" content="'.$configmetatag['keyword'].'">';
			}

			$template 			= $this->loadView('home_view');

			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('getbannerdisplay',$getbannerdisplay);
			$template->set('getbannerdisplayaward',$getbannerdisplayaward ?? '');
			$template->set('getnewsevents',$getnewsevents ?? '');
			$template->set('getourclientslogo',$getourclientslogo ?? '');			
			$template->set('getbrandtieuplogo',$getbrandtieuplogo ?? '');
			$getmemberoflogo  = $common->getourclientslogo("memberof");
			$template->set('getmemberoflogo',$getmemberoflogo);
			$template->set('singlehomeproduct',$singlehomeproduct ?? '');
			$template->set('trendingcategorys',$trendingcategorys);
			$template->set('homevideolists',$homevideolists ?? '');
			$template->set('testimoniallist',$testimoniallist ?? '');
			$template->set('helper',$helper);
			
			$template->set('homedisplaylanguage',$homedisplaylanguage);
			$template->set('allcat',$allcat);
			$template->set('aproncatid',$aproncatid);
			$template->set('fliter_list_apron',$fliterdetails_apron['fliter_list']);
			$template->set('homeproducts', $homeProducts );
			
			$helper->unsetguestchkout();			
		} else if((!empty($catid) && $producturl=='') || $subcat == 'filter')  /* prtoduct List Page */
		{	
			
			$helper->unsetguestchkout();
			$_SESSION["filter"] 		= "";
			$promotionbanner  			= $common->getbannerdisplay("Promotion Banner");
			
			$priceDetails 				= $this->proFilter_repository->getMinAndMaxPrice();
			$filterDetails 				= $this->proFilter_repository->getFilterDetails( $catid );
			
			// $productlists 				= $product->productlists('',$catid);	
			$productLists 				= $this->proFilter_repository->getDefaultProductList();
			
			$SortBy 					= $product->getSortBy();
			$attributemaster_list 		= $common->attributemaster_list(20);
			$categorymetatag 			= $common->common_metatag("category",$catid); 		
			$pageindex 					= 1;
		
			$getCategoryDetail 			= $common->categoryDetail($catid);
			$productlistdisplaylanguage = $helper->languagepagenames($_SESSION['lang_id'],'productlist');
			
			 $homedisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'home');
			$subplus 					= explode(',',$subplus);
			$producturl 				= explode(',',$producturl);
			$ids 						= explode(',',$ids);
			$apronfilterset 			= array_merge($subplus,$producturl,$ids);
			
			$template 					= $this->loadView('productlist_view');

			$headcss 					=  '<title>'.$categorymetatag['categoryMetatitle'].'</title>
											<meta name="description" content="'.$categorymetatag['categoryMetadesc'].'">
											<meta name="keywords" content="'.$categorymetatag['categoryMetakey'].'">';
			// print_r( $productLists );die;
			$template->set('maincat',$maincat);
			$template->set('promotionbanner',$promotionbanner);
			$template->set('menu_disp', 'home');	 
			$template->set('attributemaster_list',$attributemaster_list);	 
			$template->set('headcss',$headcss);
			$template->set('catid',$catid);
			$template->set('page',$pageindex);
			$template->set('productlists',$productLists);			
			$template->set('productscount',count($productLists));
			$template->set( 'fliter_list', $filterDetails );
			$template->set('fliter_price',$priceDetails);
			$template->set('SortBy',$SortBy);
			$template->set('helper',$helper);
			$template->set('productlistdisplaylanguage',$productlistdisplaylanguage);
			$template->set('getourclientslogo',$getmemberoflogo ?? '');
			$template->set('apcolor',$subplus);
			$template->set('apmaterial',$producturl);
			$template->set('homedisplaylanguage',$homedisplaylanguage);
			$template->set('did',$apronfilterset);
			$template->set('apsize',$ids);
		} else if(!empty($catid) && $producturl!='') /* Detail Page */
		{ 
			
			$helper->unsetguestchkout();
			$_SESSION['refererurl'] = ''; 
			
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

				$productdetails 		= $product->productdetails('',$catid,$producturl,$prodsku,$did,$aid);	
				$productfilter 			= $product->productPricevariationFilter('',$catid,$producturl);

				$attrInfo 				= $this->product_repository->getSingleInfo( 'kr_m_attributes', [ 'attributecode' => 'Color' ] );
				
				
				$productFilterDetails 	= $this->product_repository->productPricevariationFilter( $producturl );
				
				$color_id = '';
				if( isset( $productFilterDetails ) && !empty( $productFilterDetails ) ) {
					foreach ($productFilterDetails as $item) {
						$attributes = $this->product_repository->productPricevariationFilter($producturl, $item->attributeid );
						if( isset( $attributes ) && !empty( $attributes ) ) {
							
							foreach( $attributes as $items ) {
								if( $items->attributecode == 'Color' ) {
									$color_id = $items->dropdown_id;
								}
							}
						}
					}
				}
				$product_id 			= $productdetails['product_id'];
				$productInfo 			= $this->product_repository->getSingleInfo( 'kr_product', [ 'product_url' => $producturl ] );
				
				if( !isset( $attributeArray ) ) {
					$default = $this->product_repository->getSingleInfo('kr_product_attribute_multiple', ['isdefault' => 1, 'IsActive' => 1, 'product_id' => $product_id ]);

					$attributeArray 	= [];
					if( isset($default ) && !empty( $default ) ) {
						
							$attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $default->product_type ] );
							
							if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
								$attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
							}

							$attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $default->size ] );
							if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
								$attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
							}

							$attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $default->leadequivalnce ] );
							if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
								$attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
							}

							$attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $default->materialid ] );
							if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
								$attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
							}

							$attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $default->fabricid ] );
							if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
								$attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
							}
							$color_id_array = explode(',', $default->colorid);
							$color_id 		= current($color_id_array );
							
							$attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $color_id] );
							if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
								$attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
							}
						
					}
				}

				$productImages 			= $this->product_repository->getAllInfo( 'kr_product_images', ['IsActive' => 1, 'product_id' => $productInfo->product_id, 'colorid' => $color_id ]);

				$productsizechart 		= $product->productSizechart($productdetails['product_id']);
				$productattributes 		= $product->productFrontAttr('',$catid,$producturl,array(),array("video"));
				$productmetatag 		= $common->common_metatag("product",$producturl);
				$getmaximum_dp 			= $product->getmaximumdiscountslapprice();
				
				$filter=array("colorattr"=>"");
				$detaildisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'productdetail');
				$formdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'form');
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

				$headcss = '<meta name="description" content="'.$productmetatag['metadescription'].' '.$plugin->getConfigvalue('storeMetaDesc').'">

					  <meta name="keywords" content="'.$productmetatag['metakeyword'].' '.$plugin->getConfigvalue('storeMetaKey').'">

					  <title>'.$productdetails['product_name'].' - '.$productmetatag['metaname'].' '.$plugin->getConfigvalue('storeMetaTitle').'</title>';

				$template->set('menu_disp', 'home');	 
				$template->set('headcss',$headcss);
				$template->set('catid',$catid);
				$template->set('repository',$this->product_repository);
				$template->set('page',$pageindex ?? '');
				$template->set('isshippingavail',$isshippingavail);
				$template->set('recentviewproduct',$recentviewproduct ?? '');
			
				####### new start #############
				$template->set('feature_additional_list_video',$feature_additional_list_video ?? '');
				$template->set('feature_additional_list_image',$feature_additional_list_image ?? '');
				####### new end #############
			
				$template->set('getproductfeature',$getproductfeature ?? '');
				$template->set('product_id',$product_id ?? '');
				$template->set('productImages', $productImages ?? '');
				$template->set('attributeArray', $attributeArray ?? '');
				$template->set('producturl',$producturl ?? '');
				$template->set('additionalfeature_listtype',$feature_additionalfeature_listtype ?? '');
				$template->set('getourclientslogo',$getourclientslogo ?? '');
				$template->set('route',trim($_REQUEST['route'],"/"));
				$template->Set('productattributes_video',$productattributes_video ?? '');
				$template->set('aid',$aid);
				$template->set('sku',$_REQUEST['sku']);
				$template->set('did',$did);
				$template->set('productattributes',$productattributes);
				$template->set('productdetails',$productdetails);  
				$template->set('othercategorylist',$othercategorylist ?? ''); 
				$template->set('productfilter',$productfilter);	
				$template->set('productFilterDetails',$productFilterDetails);	
				$template->set('getmaximum_dp',$getmaximum_dp); 	
				$template->set('maincat',$maincat);
				$template->set('colorproductlists',$colorproductlists ?? '');	
				$template->set('detaildisplaylanguage',$detaildisplaylanguage);		
				$template->set('formdisplaylanguage',$formdisplaylanguage);	
				$template->set('helper',$helper);

				$template->set('productfeaturedetail',$productfeaturedetail ?? '');
				$template->set('feature_specialfeature',$feature_specialfeature ?? '');
				$template->set('feature_additionalfeature',$feature_additionalfeature ?? '');
				$template->set('feature_specification',$feature_specification ?? '');
				$template->set('productsizechart',$productsizechart);
	 
		}
		$template->render();    
	}	
	
	function filterProductOrderWise($productfilter, $condition) {
		$tmp = [];
		if( isset( $productfilter ) && !empty( $productfilter ) ) {
			foreach ($productfilter as $key => $value) {
				
				if( $condition == $value['attributecode']) {
					
					$tmp[] = $value;
				}
			}
		}
		return $tmp;
		
	}
	function filterProductNotIN($productfilter, $exclude) {
		$tmp = [];
		if( isset( $productfilter ) && !empty( $exclude ) ) {
			foreach ($productfilter as $key => $value) {
				if( !in_array($value['attributecode'], $exclude) ) {
					$tmp[] = $value;
				}
			}
		}
		return $tmp;
		
	}
}
?>