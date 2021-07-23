<?php
class home_test extends Controller {
	function index($asd,$maincat='',$subcat='',$subplus='',$producturl='')
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
		
		$newsevents=$this->loadModel('newsevents_model');
		if(($catid==0 || $catid=='') && $producturl==''){   /*Home Page */
			$_SESSION['refererurl'] = '';
			$getbannerdisplay  = $common->getbannerdisplay("Main Banner");
			$getbannerdisplayaward  = $common->getbannerdisplay("Award Receiver");
			$getnewsevents  = $newsevents->getnewsevents('homepage');
			$getourclientslogo  = $common->getourclientslogo("client");
			$getmemberoflogo  = $common->getourclientslogo("memberof");
			$getbrandtieuplogo  = $common->getourclientslogo("brandtieup");
			$trophies_award=$product->productlists('trophies-award','','','1','','10','0');		
			//print_r($trophies_award); die();
			$configmetatag = $common->common_metatag("config");
			//print_r($trophies_award); die();
			$template = $this->loadView('home_view_test');
		
			$headcss='<title></title>
					  <meta name="description" content="">
					  <meta name="keywords" content="">
					  <meta name="robots" content="noindex"/>';
			$template->set('menu_disp', 'home');	 
			//$template->set('headcss',$headcss);
			$template->set('getbannerdisplay',$getbannerdisplay);
			$template->set('getbannerdisplayaward',$getbannerdisplayaward);
			$template->set('getnewsevents',$getnewsevents);
			$template->set('getourclientslogo',$getourclientslogo);			
			$template->set('getbrandtieuplogo',$getbrandtieuplogo);
			$getmemberoflogo  = $common->getourclientslogo("memberof");
			$template->set('getmemberoflogo',$getmemberoflogo);
			//$template->set('addtocartcount',$addtocartcount);
			//$template->set('addtocartlist',$addtocartlist);
		}
		else if(!empty($catid) && $producturl=='')  /* prtoduct List Page */
		{
			//$_SESSION['refererurl'] = '';
			$_SESSION["filter"]="";
			$fliterdetails=$product->displayfilter('',$catid);
		
			$productlists=$product->productlists('',$catid);
			$SortBy=$product->getSortBy();
			$categorymetatag = $common->common_metatag("category",$catid);
			//echo "<pre>"; print_r($productlists); die();
			$pageindex=1;
			$template = $this->loadView('productlist_test_view');
			$headcss='<title>'.$categorymetatag['categoryMetatitle'].'</title>
						<meta name="description" content="'.$categorymetatag['categoryMetadesc'].'">
					  <meta name="keywords" content="'.$categorymetatag['categoryMetakey'].'">'
					  ;
			$template->set('menu_disp', 'home');	 
			//$template->set('headcss',$headcss);
			$template->set('catid',$catid);
			$template->set('page',$pageindex);
			$template->set('productlists',$productlists['prod_list']);			
			$template->set('productscount',$productlists['totcnt']);
			$template->set('fliter_list',$fliterdetails['fliter_list']);
			$template->set('fliter_price',$fliterdetails['pricefilter']);
			$template->set('SortBy',$SortBy);
			$getmemberoflogo  = $common->getourclientslogo("client");
			$template->set('getourclientslogo',$getmemberoflogo);
			
		}
		else if(!empty($catid) && $producturl!='') /* Detail Page */
		{   
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
			}
			
			$plugin->getStoreConfigPlugin();

			$productdetails=$product->productdetails('',$catid,$producturl,'',$did,$aid);			
			$productfilter=$product->productPricevariationFilter('',$catid,$producturl);
			$productattributes=$product->productFrontAttr('',$catid,$producturl);
			$productmetatag = $common->common_metatag("product",$producturl);
			$getmaximum_dp = $product->getmaximumdiscountslapprice();
			//echo "<pre>"; print_r($productdetails); die();
			
			$template = $this->loadView('product_details_view_test');
			$headcss='<meta name="description" content="'.$productmetatag['metadescription'].' '.$plugin->getConfigvalue('storeMetaDesc').'">
					  <meta name="keywords" content="'.$productmetatag['metakeyword'].' '.$plugin->getConfigvalue('storeMetaKey').'">
					  <title>'.$productdetails['product_name'].' - '.$productmetatag['metaname'].' '.$plugin->getConfigvalue('storeMetaTitle').'</title>';
			$template->set('menu_disp', 'home');	 
			$template->set('headcss',$headcss);
			$template->set('catid',$catid);
			$template->set('page',$pageindex);
			
			
	
			
			$template->set('route',trim($_REQUEST['route'],"/"));
			
			$template->set('aid',$aid);
			$template->set('sku',$_REQUEST['sku']);
			$template->set('did',$did);
			$template->set('productattributes',$productattributes);
			$template->set('productdetails',$productdetails);
			$template->set('productfilter',$productfilter);		
            $template->set('getmaximum_dp',$getmaximum_dp); 			
		}
		
		$template->render();    
	}		
	
}

?>
