<?php
class search extends Controller {
	function index()
	{
			extract($_REQUEST);
			if(empty($scat) || $scat=='')
				$catid=0;
			else
				$catid=$scat;
			
			$common=$this->loadModel('common_model');
			$product=$this->loadModel('product_model');
			$fliterdetails=$product->displayfilter('',$catid,$q);
			$productlists=$product->productlists('',$catid,$q);
			$SortBy=$product->getSortBy();
			$pageindex=1;
			$template = $this->loadView('search_view');
			$headcss='<meta name="description" content="">
					  <meta name="keywords" content="">
					  <title></title>';
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('catid',$catid);
			$template->set('page',$pageindex);
			$template->set('productlists',$productlists['prod_list']);			
			$template->set('productscount',$productlists['totcnt']);
			$template->set('fliter_list',$fliterdetails['fliter_list']);
			$template->set('fliter_price',$fliterdetails['pricefilter']);
			$template->set('searchkey',$q);
			$template->set('SortBy',$SortBy);
			$getmemberoflogo  = $common->getourclientslogo("client");
			$template->set('getourclientslogo',$getmemberoflogo);		
			$template->render();    
	}		
	
}

?>
