<?php
class newproducts extends Controller {
	function index()
	{
			extract($_REQUEST);
			if(empty($scat) || $scat=='')
				$catid=0;
			else
				$catid=$scat;
			
			$common=$this->loadModel('common_model');
			$product=$this->loadModel('product_model');
			
			$fliterdetails=$product->displayfilter('',$catid,'','1','','12','1','newproducts');
			
			$productlists=$product->productlists('',$catid,'','1','','12','1','newproducts');	
			//$formfields=$common->getdynamicformfields('individual_dealer');
			//echo "<pre>"; print_r($formfields); exit;
			$SortBy=$product->getSortBy();
			$pageindex=1;
			$configmetatag = $common->common_metatag("config");
			$template = $this->loadView('newproducts');
			$headcss='<title>New Products-'.$configmetatag['title'].'</title>
			      <meta name="description" content="'.$configmetatag['description'].'">
				  <meta name="keywords" content="'.$configmetatag['keyword'].'">';
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('catid',$catid);
			$template->set('page',$pageindex);
			$template->set('productlists',$productlists['prod_list']);			
			$template->set('productscount',$productlists['totcnt']);
			$template->set('fliter_list',$fliterdetails['fliter_list']);
			$template->set('fliter_price',$fliterdetails['pricefilter']);
			$template->set('formfields',$formfields);
			
			$template->set('SortBy',$SortBy);
			$getmemberoflogo  = $common->getourclientslogo("client");
			$template->set('getourclientslogo',$getmemberoflogo);		
			$template->render();    
	}		
	
}

?>
