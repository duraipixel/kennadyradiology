<?php
class ccavpaymentprocess extends Controller {
	function index()
	{			
	  // print_r($_SESSION); die();
			$payment=$this->loadModel('payment_model');
			$checkout = $this->loadModel('checkout_model'); 
			$payinfo=$checkout->Paymentmethod("CCAV");
		
			require_once(APP_DIR .'models/ccavenue/crypto.php');
		/*	echo "<pre>";
			echo "payinfo";
			print_r($payinfo);*/
			
			$workingKey=trim($payinfo[0]['encrypt_key']);;		
			$encResponse=$_POST["encResp"];			
			//	print_r($encResponse);
			$rcvdString=decrypt($encResponse,$workingKey);	
			//	print_r($rcvdString);
			$order_status="";
			$decryptValues=explode('&', $rcvdString);
			//	print_r($decryptValues);
			
			$dataSize=sizeof($decryptValues);
			$dataarr=array();
			for($i = 0; $i < $dataSize; $i++) 
			{
				$information=explode('=',$decryptValues[$i]);						
				if($i==0)	$dataarr['order_id'] = $information[1];
				if($i==3)	$dataarr['order_status']=$information[1];
				if($i==5)	$dataarr['payment_mode'] =$information[1];
				if($i==2)	$dataarr['bank_ref_no']=$information[1];
				if($i==1)	$dataarr['tracking_id']=$information[1];
			}
			$dataarr['data']=$rcvdString;
			//	print_r($dataarr);
				
		//	die();
			$payment->savetransaction($dataarr);
			
			if($_SESSION['reforderid']==$dataarr['order_id']){
			switch($dataarr['order_status'])
			{
				case "Success":
				 
								//$orderstatus=trim($payinfo[0]['orderstatus']);
								$orderstatus="2";
								$payment->updateorderstatus($dataarr['order_id'],$orderstatus);
							
		                       $payment->ordermailfunction($dataarr['order_id'],'20');
								
								?>
								<form method="post" name="ccavpay" action="<?php echo BASE_URL ?>ordersuccess"> 
									<?php
									echo "<input type=hidden name='type' value='ccav'>";
									echo "<input type=hidden name='oid' value='".$dataarr['order_id']."'>";
									echo "<input type=hidden name='status' value='success'>";
									echo "<input type=hidden name='msg' value=''>";
									?>
								</form>		
								<script language='javascript'>document.ccavpay.submit();</script>		
							<?php
							
								break;
				case "Aborted":
								$payment->updateorderstatus($dataarr['order_id'],'5');
							
								
		                        $payment->ordermailfunction($dataarr['order_id'],'9');
		                       
								?>
								<form method="post" name="ccavpay1" action="<?php echo BASE_URL ?>ordercancelled"> 
									<?php
									echo "<input type=hidden name='type' value='ccav'>";
									echo "<input type=hidden name='oid' value='".$dataarr['order_id']."'>";
									echo "<input type=hidden name='status' value='cancel'>";
									echo "<input type=hidden name='msg' value=''>";
									?>
								</form>		
								<script language='javascript'>document.ccavpay1.submit();</script>		
							<?php
							
								break;
				case "Failure":
				                
		                        $payment->ordermailfunction($dataarr['order_id'],'19');
								?>
								<form method="post" name="ccavpay2" action="<?php echo BASE_URL ?>orderfailure"> 
									<?php
									echo "<input type=hidden name='type' value='ccav'>";
									echo "<input type=hidden name='oid' value='".$dataarr['order_id']."'>";
									echo "<input type=hidden name='status' value='cancel'>";
									echo "<input type=hidden name='msg' value=''>";
									?>
								</form>		
								<script language='javascript'>document.ccavpay2.submit();</script>		
							<?php
							
								break;	
			}
			}
			else{
				?>
								<form method="post" name="ccavpay2" action="<?php echo BASE_URL ?>orderfailure"> 
									<?php
									echo "<input type=hidden name='type' value='ccav'>";
									echo "<input type=hidden name='oid' value='".$dataarr['order_id']."'>";
									echo "<input type=hidden name='status' value='cancel'>";
									echo "<input type=hidden name='msg' value=''>";
									?>
								</form>		
								<script language='javascript'>document.ccavpay2.submit();</script>		
							<?php
				
			}
	}
}
?>