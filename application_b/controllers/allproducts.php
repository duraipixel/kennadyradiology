<?php

class allproducts extends Controller {

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

	  

	

		$common=$this->loadModel('common_model');
		
			
		 $helper=$this->loadHelper('common_function'); 
		 
		 //	echo "ggg"; die();
	  

		$newsevents=$this->loadModel('newsevents_model');


			
		$helper->unsetguestchkout();

			//$_SESSION['refererurl'] = '';

			$_SESSION["filter"]="";

			$fliterdetails=$product->displayfilter('',$catid);

		

			$productlists=$product->productlists('',$catid);
			

			$SortBy=$product->getSortBy();

			$categorymetatag = $common->common_metatag("category",$catid);

			//echo "<pre>"; print_r($catid); print_r($productlists); die();

			$pageindex=1;

			$template = $this->loadView('productlist_view');

			$headcss='<title>'.$categorymetatag['categoryMetatitle'].'</title>

						<meta name="description" content="'.$categorymetatag['categoryMetadesc'].'">

					  <meta name="keywords" content="'.$categorymetatag['categoryMetakey'].'">'

					  ;

			$template->set('menu_disp', 'home');	 

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
			$template->set('isallproductpage',"1");
			

		
			
	//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();
		$template->render();    
		//echo "<pre>"; print_r($catid); print_r($fliterdetails); die();

	}		

	

}



?>

