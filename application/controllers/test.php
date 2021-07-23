<?php

class Test extends Controller {
	
	function index()
	{
		$m=$this->loadModel('user_model');
		$m->testmailfunction();			
	}
	
	
    
}

?>
