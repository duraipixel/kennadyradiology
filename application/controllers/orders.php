<?php
class orders extends Controller {
	function index()
	{
		//print_r($_SESSION); die();
		if(!isset($_SESSION['Cus_ID']) || $_SESSION['Cus_ID']==''){
			if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	
			 $this->redirect('login');
			exit;
			}
		}
		else{ 
			if($_SESSION['addressid']=='0' || $_SESSION['addressid']==''){
			
			$this->redirect('checkout');
			exit;
			}
		}
		
		 $orders=$this->loadModel('orders_model');
		 
		// echo "ggg"; die();
		 //$checkout=$this->loadModel('checkout_model');
		// $orderlist = $checkout->getcheckoutproductlist();
		 $placeorders = $orders->placeorderdetails();
			
	}
	
}
?>