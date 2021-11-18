<?php
error_reporting(0);
class ajax extends Controller {	
	
	function index(){}
	
	//contact Enquiry Start	
	public	function changeLanguage() 
	{		
		$_SESSION['lang_id'] = $_REQUEST['lang_id'];
		return true;
	}
	
	function registerform()
	{
		//print_r($_REQUEST); exit;	
		$common = $this->loadModel('user_model'); 		
		$data=$common->registerform($_REQUEST);
	
	}
	
		function saveproductQuote()
	{
		$common = $this->loadModel('common_model');	
		$resul= $common->saveproductQuote($_REQUEST);	
	}
	
	function emailduplicatechecking()
	{
		//print_r($_REQUEST); exit;	
		$common = $this->loadModel('user_model'); 		
		$data=$common->emailduplicatechecking($_REQUEST);
	}
	
	function loginuser()
	{
		
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('common_model'); 		
		$data=$common->loginuser($_REQUEST);
	}
	
	function guestcheckout()
	{
		session_start();
		$_SESSION['Isguestcheckout']=1;
		$_SESSION['guestckout_sess_id']=session_id();
		echo json_encode(array("rslt"=>"1"));
	}
	
	function updatemyaccount()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('user_model'); 		
		$data=$common->updatemyaccount($_REQUEST);
		
	}
	
	function changepasswords()
	{
		 //print_r($_REQUEST); exit;
		$common = $this->loadModel('user_model'); 		
		$data=$common->changepasswords($_REQUEST);
	}
	
	
	function statelist()
	{
		
		$common = $this->loadModel('user_model'); 		
		$data=$common->statelist($_REQUEST);
	}
	
	function countrylist()
	{
		
		$common = $this->loadModel('user_model'); 		
		 $data=$common->countrylist($_REQUEST);
	}
	
	function Addressform()
	{
		//print_r($_REQUEST); exit;
		$common = $this->loadModel('user_model'); 		
		$data=$common->Addressform($_REQUEST);
		//print_r($data); die();
	}
	
	function updateaddress()
	{
		$common = $this->loadModel('user_model'); 		
		$data=$common->updateaddress($_REQUEST);
	}
	
	function deleteaddress()
	{
		$common = $this->loadModel('user_model'); 		
		$data=$common->deleteaddress($_REQUEST);
	}
	 
	
	
	
	
}
	?>