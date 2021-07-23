<?php
class logout extends Controller {
	function index()
	{
	   if(isset($_SESSION['Cus_ID'])){
		    session_regenerate_id();
			session_destroy(); 

			$this->redirect('');
		    exit;
		}
		$this->redirect('');
	}		

}

?>