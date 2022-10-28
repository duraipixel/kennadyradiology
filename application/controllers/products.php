<?php

class Products extends Controller {
    public $product_repository;
	public $proFilter_repository;
	public $cartRepository;
	
	public function __construct() {
		$this->product_repository = $this->repository('product_repository');
		$this->cartRepository = $this->repository('cart_repository');
		$this->proFilter_repository = $this->repository('product_filter_repository');
	}

    public function index( $category_url = '', $product_url = '' ) {
        $common 		                = $this->loadModel('common_model');	
		// $this->cartRepository->cartList();
		// $common->testMail();
		// die;	
		$helper 		                = $this->loadHelper('common_function'); 
		$product						= $this->loadModel('product_model');	
        if( empty( $category_url ) && empty( $product_url ) ) {

            $helper->unsetguestchkout();
            $_SESSION["filter"] 		= "";
            $promotionbanner  			= $common->getbannerdisplay("Promotion Banner");
            $priceDetails 				= $this->proFilter_repository->getMinAndMaxPrice();
            $filterDetails 				= $this->proFilter_repository->getFilterDetails();
            $productLists 				= $this->proFilter_repository->getDefaultProductList();
			$allCategories 				= $this->proFilter_repository->getAllParentCategories();
            $attributemaster_list 		= $common->attributemaster_list(20);
            $categorymetatag 			= $common->common_metatag("category", 'radiation-protection'); 		
            $pageindex 					= 1;
			$SortBy 					= $product->getSortBy();
            $productlistdisplaylanguage = $helper->languagepagenames($_SESSION['lang_id'],'productlist');
            
            $homedisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'home');
            $subplus 					= explode(',',$subplus);
            $producturl 				= explode(',',$producturl);
            $ids 						= explode(',',$ids);
            $apronfilterset 			= array_merge($subplus,$producturl,$ids);
            
            $headcss 					=  '<title>Buy Radiation Protection equipement online - Kennedy Radiology</title>
                                            <meta name="description" content="Kennedy Radiology is an US based medical equipment business that manufactures and supplies worldwide with quality of Radiation Protection Shields">
                                            <meta name="keywords" content="'.$categorymetatag['categoryMetakey'].'">';

			$template 					= $this->loadView('productlist_view');
            $template->set('maincat', 'radiation-protection');
            $template->set('promotionbanner',$promotionbanner);
            $template->set('allCategories',$allCategories);
            $template->set('menu_disp', 'Products');	 
            $template->set('attributemaster_list',$attributemaster_list);	 
            $template->set('headcss',$headcss);
            $template->set('catid', 'radiation-protection');
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
			$template->set('repository',$this->product_repository);
            $template->render();
        } else {
            //product detail page;
            $helper->unsetguestchkout();
            $product				= $this->loadModel('product_model');	 
			$_SESSION['refererurl'] = ''; 
			if(!$product->IsVaildProduct($product_url))
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

			if(isset($product_url) && $product_url!='')
			
                $attrInfo 				= $this->product_repository->getSingleInfo( 'kr_m_attributes', [ 'attributecode' => 'Color' ] );

				$productInfo 		    = $this->proFilter_repository->getProductInfo( $product_url );
				$productFilterDetails 	= $this->product_repository->productPricevariationFilter( $product_url );
				
                $color_id               = '';
				if( isset( $productFilterDetails ) && !empty( $productFilterDetails ) ) {
					foreach ($productFilterDetails as $item) {
						$attributes = $this->product_repository->productPricevariationFilter($product_url, $item->attributeid );
						if( isset( $attributes ) && !empty( $attributes ) ) {
							
							foreach( $attributes as $items ) {
								if( $items->attributecode == 'Color' ) {
									$color_id = $items->dropdown_id;
								}
							}
						}
					}
				}
				$product_id 			= $productInfo->product_id;
				
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
                        // $color_id 		= current($color_id_array );
                        $color_id 		= $productInfo->defaultColorId;
                        
                        $attrInfo 	= $this->product_repository->getSingleInfo( 'kr_dropdown', [ 'dropdown_id' => $color_id] );
                        if( isset( $attrInfo ) && !empty( $attrInfo ) ) {
                            $attributeArray[$attrInfo->attributeId] = ['id' => $attrInfo->dropdown_id, 'attributeid' => $attrInfo->attributeId];
                        }
						
					}
				}
				$productImages 			= $this->product_repository->getAllInfo( 'kr_product_images', ['IsActive' => 1, 'product_id' => $productInfo->product_id, 'colorid' => $color_id ], ['isbasedefault' => 'DESC', 'ordering' => 'ASC']);

				$productsizechart 		= $product->productSizechart($product_id);
				$productattributes 		= $product->productFrontAttr('',$category_url,$product_url,array(),array("video"));
				$productmetatag 		= $common->common_metatag("product",$product_url);
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

				$bestSellingProductLists 				= $this->proFilter_repository->getDefaultProductList('bestSelling');
				
			    if($productInfo->isfeaturedproduct == 1 && $productInfo->themeid == 1){
				
					$template = $this->loadView('product_details_view_theme1');
				}
				else if($productInfo->isfeaturedproduct == 1 && $productInfo->themeid == 2){
					$template = $this->loadView('product_details_view_theme2');
				}
				else if($productInfo->isfeaturedproduct == 1 && $productInfo->themeid == 3){
					$template = $this->loadView('product_details_view_theme3');
				}else{
					$template = $this->loadView('product_details_view');
				}

				$headcss = '<meta name="description" content="'.$productmetatag['metadescription'].' '.globalConfig('storeMetaDesc').'">
					  <meta name="keywords" content="'.$productmetatag['metakeyword'].' '.globalConfig('storeMetaKey').'">
					  <title>'.$productInfo->product_name.' - '.$productmetatag['metaname'].' '.globalConfig('storeMetaTitle').'</title>';

				$template->set('menu_disp', 'home');	 
				$template->set('headcss',$headcss);
				$template->set('catid',$category_url);
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
				$template->set('producturl',$product_url ?? '');
				$template->set('additionalfeature_listtype',$feature_additionalfeature_listtype ?? '');
				$template->set('getourclientslogo',$getourclientslogo ?? '');
				$template->set('route',trim($_REQUEST['route'],"/"));
				$template->Set('productattributes_video',$productattributes_video ?? '');
				$template->set('aid',$aid);
				$template->set('sku',$_REQUEST['sku']);
				$template->set('did',$did);
				$template->set('productattributes',$productattributes);
				$template->set('productdetails',$productInfo);  
				$template->set('othercategorylist',$othercategorylist ?? ''); 
				$template->set('bestSellingProductLists',$bestSellingProductLists);	
				$template->set('productFilterDetails',$productFilterDetails);	
				$template->set('getmaximum_dp',$getmaximum_dp); 	
				$template->set('maincat',$maincat);
				$template->set('colorproductlists',$colorproductlists ?? '');	
				$template->set('detaildisplaylanguage',$detaildisplaylanguage);		
				$template->set('formdisplaylanguage',$formdisplaylanguage);	
				$template->set('helper',$helper);
				$template->set('repository',$this->product_repository);
				$template->set('productfeaturedetail',$productfeaturedetail ?? '');
				$template->set('feature_specialfeature',$feature_specialfeature ?? '');
				$template->set('feature_additionalfeature',$feature_additionalfeature ?? '');
				$template->set('feature_specification',$feature_specification ?? '');
				$template->set('productsizechart',$productsizechart);
                $template->render();
        }
        
    }

	public function clearProductFilter() {
		unset($_SESSION['product_filter']);
		echo 1;
	}

	function globalSearch()
	{
		$query 		= $_POST['query'];
		$langId 	= $_POST['langId'];
		
		$where 			= array( 'kr_product.IsActive' => 1, 'kr_product.lang_id' => $langId);
		
		$likeArr 		= array( 
								'kr_product.product_name' => $query, 
								'kr_product.producttag' => $query,
							);

		$searchDetails  = $this->product_repository->getAllInfo( 'kr_product', $where, [], $likeArr, 'kr_product.product_id'  );
		
		$headerlist 	= '';
		if( isset( $searchDetails ) && !empty( $searchDetails ) ) {
			foreach($searchDetails as $valRef){
				$headerlist .= '<li class="list-group-item contsearch">
									<a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;" onclick="gotoSeachPage(\''.$valRef->product_url.'\')">'.$valRef->product_name.'</a>
								</li>';
			}
		} else {
			$headerlist = '<li class="list-group-item contsearch">
								<a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;"> No Product Found </a>
							</li>';
		}
		echo $headerlist;

	}
}

?>