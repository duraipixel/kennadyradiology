<?php
class search extends Controller {
	function index()
	{
			extract($_REQUEST);
			 
			if(empty($scat) || $scat=='')
				$catid=0;
			else
				$catid=$scat;
			
			if (strpos($str1,'<script') !== false) 
			 {
				echo 'The specific word is present.';
				die();
			 }
			$q= html_entity_decode($q, ENT_QUOTES | ENT_HTML5, 'UTF-8');
			$tempqury=html_entity_decode($q, ENT_QUOTES | ENT_HTML5, 'UTF-8');	
			
			$xssproct=array("&sol;script","/script","http:","https:","javascript:","http&colon;","https&colon;","javascript&colon;");
			
			foreach ($xssproct as $url) {			
					if (strpos($tempqury, $url) !== FALSE) { 
						$this->redirect_301('');
					}
			}
		   
			$common=$this->loadModel('common_model');
			$product=$this->loadModel('product_model');
			$helper=$this->loadHelper('common_function'); 
			 $productlistdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'productlist');
			 $commondisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'common');
			 
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
			 $template->set('productlistdisplaylanguage',$productlistdisplaylanguage);
			 $template->set('commondisplaylanguage',$commondisplaylanguage);
			$getmemberoflogo  = $common->getourclientslogo("client");
			$template->set('getourclientslogo',$getmemberoflogo);		
			$template->render();    
	}		
	
}

?>
