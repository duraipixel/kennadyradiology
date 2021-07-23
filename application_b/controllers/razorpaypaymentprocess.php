<?php
require_once(APP_DIR .'models/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class razorpaypaymentprocess extends Controller {
	function index()
	{			
	 
			$payment=$this->loadModel('payment_model');
			$checkout = $this->loadModel('checkout_model'); 
			$payinfo=$checkout->Paymentmethod("RAZORPAY");
		
			$keyId=trim($payinfo[0]['encrypt_key']);//Shared by Payu
			$keySecret=trim($payinfo[0]['secret_key']);//Shared by Payu
			
			
			
$success = true;

$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);
 // print_r($api); die();
   $finalorder=$api->order->fetch( $_SESSION['razorpay_order_id']);
   
   


    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}
else{
	 
	 if(isset($_POST['error']))
	 {
	   	$orderdata= json_decode($_POST['error']['metadata'],true);
		$_POST['razorpay_payment_id']=$orderdata['payment_id'];
		$api = new Api($keyId, $keySecret);

       $finalorder=$api->order->fetch( $orderdata['order_id']);
		
	 }
	
}
	
/*	if (empty($_POST['razorpay_signature']) !== false && !isset($_POST['error']))
	{
		$this->redirect_301('');
				exit;
	}	*/

	   $finalorder=(array)$finalorder;
	   $tempdatarr=array();
	   foreach($finalorder as $key=>$orderdata)
	   {
		   $tempdatarr=$orderdata;
	   }
   
			$dataarr=array();
			foreach($tempdatarr as $key=>$val) 
			{
				switch($key)
				{
					case "receipt":
									$dataarr['order_id'] = $val;
									break;
					case "status":
									if($val=="paid")
									{
									$dataarr['order_status']="Success";
									}
									else{
										$dataarr['order_status']="Failure";
									}
									break;
					case "id":
								$dataarr['tracking_id']= $val;
								break;
					case "payment_mode":
							$dataarr['payment_mode'] ='';
							break;
					
					
				} 
			} 
			$dataarr['bank_ref_no']=$_POST['razorpay_payment_id'];
			$dataarr['data']=$_POST['razorpay_signature'];
		//print_r($dataarr); die();	
			$payment->savetransaction($dataarr);
			
		$_SESSION['razorpay_order_id']='';	
			if($_SESSION['reforderid']==$dataarr['order_id']){
				$_SESSION['reforderid']='';
				//print_r($dataarr['order_status']); die();
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