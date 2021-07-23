<?php

class Error extends Controller {
	
	function index()
	{
		$this->error404();				
	}
	
	function error404()
	{
		$common=$this->loadModel('common_model');
		$usermodel=$this->loadModel('user_model');
	
		$getProfile=$usermodel->getUserprofile($_SESSION['userID']);
		$timer = $common->getStarttimer($_SESSION['userID']);
		$getcartcount = $usermodel->getCartcount();
		
		
	 	
		
		$getLastestproduct = $common->getLatestProducts('latest',1); 
		$getcategorys = $common->getHomelatestCategory();
		$getUpcomingecom = $common->getHomeUpcomingcategory(1,4);
		$gethomecategoryfilter = $common->getCategoryfilter('',1); 	
		
		############ Category Position ###########
		$getauctionCat1 = $common->getAuctionCategory(1,1);
		$getauctionCat2 = $common->getAuctionCategory(2,1);
		$getauctionCat3 = $common->getAuctionCategory(3,1);
		$getauctionCat4 = $common->getAuctionCategory(4,1);
		$getauctionCat5 = $common->getAuctionCategory(5,1);
		$getauctionCat6 = $common->getAuctionCategory(6,1);
		$getauctionCat7 = $common->getAuctionCategory(7,1);
		$getauctionCat8 = $common->getAuctionCategory(8,1);
		$getauctionCat9 = $common->getAuctionCategory(9,1);
		
		###### ENd #############
		
		$getshopproduct = $common->getHomeproductlist(1,2,4);
		$getShopbanner=$common->getShoppagebanner(); 
		
		
		header("HTTP/1.0 404 Not Found");
 		
		$template = $this->loadView('404_view');
		
		$headcss='<title>404 ERROR</title>';
		
		$template->set('getLastestproduct', $getLastestproduct); 
		$template->set('latestcategorys',$getcategorys);
		$template->set('getUpcomingecom',$getUpcomingecom);
		$template->set('gethomecategoryfilter',$gethomecategoryfilter);
		
		#### Category Position ####
		$template->set('getauctionCat1', $getauctionCat1); 
		$template->set('getauctionCat2', $getauctionCat2); 
		$template->set('getauctionCat3', $getauctionCat3); 
		$template->set('getauctionCat4', $getauctionCat4); 
		$template->set('getauctionCat5', $getauctionCat5); 
		$template->set('getauctionCat6', $getauctionCat6); 
		$template->set('getauctionCat7', $getauctionCat7); 
		$template->set('getauctionCat8', $getauctionCat8); 
		$template->set('getauctionCat9', $getauctionCat9); 
		$template->set('getProfile',$getProfile);
		$template->set('getcartcount',$getcartcount);
		$template->set('getshopproduct',$getshopproduct);
		$template->set('getShopbanner', $getShopbanner); 
		$template->set('timer',$timer);
		#### End ####
		
		$template->render();		
		
	}
    
}

?>
