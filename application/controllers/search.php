<?php
class search extends Controller {

	public $product_repository;
	public $proFilter_repository;
	
	public function __construct() {
		$this->product_repository = $this->repository('product_repository');
		$this->proFilter_repository = $this->repository('product_filter_repository');
	}

	function index( $productUrl )
	{
		
		if(empty($scat) || $scat=='')
			$catid=0;
		else 
			$catid=$scat;
		
		
		$q 			= html_entity_decode($q, ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$tempqury 	= html_entity_decode($q, ENT_QUOTES | ENT_HTML5, 'UTF-8');	
		
		$xssproct=array("&sol;script","/script","http:","https:","javascript:","http&colon;","https&colon;","javascript&colon;");
		
		foreach ($xssproct as $url) {			
				if (strpos($tempqury, $url) !== FALSE) { 
					$this->redirect_301('');
				}
		}
		   
		$common=$this->loadModel('common_model');
		$product=$this->loadModel('product_model');
		$helper=$this->loadHelper('common_function'); 
		
		$configmetatag 				= $common->common_metatag("config");
		$productlistdisplaylanguage = $helper->languagepagenames($_SESSION['lang_id'],'productlist');
		$commondisplaylanguage  	= $helper->languagepagenames($_SESSION['lang_id'],'common');
		$productlistdisplaylanguage = $helper->languagepagenames($_SESSION['lang_id'],'productlist');
		$homedisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'home');
		$metadisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'meta');
		$fliterdetails				= $product->displayfilter('',$catid,$q);
		// $productlists				= $product->productlists('',$catid,$q);
		$query 						= trim( $productUrl );
		$likeArr 					= array(
										'pro.product_name' => $query,
										'pro.sku' => $query,
										'pro.product_url' => $query
									);
		$productLists 				= $this->proFilter_repository->getDefaultProductList('', $likeArr);
		$SortBy 					= $product->getSortBy();
		$pageindex 					=1;

	

		$headcss='<title>'.$configmetatag['title'].' '.$metadisplaylanguage['searchlist'].'</title>
				<meta name="description" content="'.$configmetatag['description'].'">
				<meta name="keywords" content="'.$configmetatag['keyword'].'">
				<meta name="robots" content="noindex"/>';
				
		$template = $this->loadView('search_view'); 
		$template->set('menu_disp', 'home');	 
		$template->set('headcss',$headcss);
		$template->set('catid',$catid);
		$template->set('page',$pageindex);
		$template->set('productlists',$productLists);			
		$template->set('productscount', count( $productLists ) );
		$template->set('fliter_list',$fliterdetails['fliter_list']);
		$template->set('fliter_price',$fliterdetails['pricefilter']);
		$template->set('searchkey',$q);
		$template->set('SortBy',$SortBy);	 
		$template->set('homedisplaylanguage',$homedisplaylanguage);	 
		$template->set('productlistdisplaylanguage',$productlistdisplaylanguage);
		$template->set('commondisplaylanguage',$commondisplaylanguage);
		$getmemberoflogo  = $common->getourclientslogo("client");
		$template->set('getourclientslogo',$getmemberoflogo);	
		$template->set('productlistdisplaylanguage',$productlistdisplaylanguage);			
		$template->render();    
	}		
	
}

?>
