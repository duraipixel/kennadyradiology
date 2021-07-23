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
	 
	
	
	
	
}
	?>