<?php
error_reporting(0);
include "session.php";
//echo $uid; exit;
$status_id=$_REQUEST['status_id'];
$order_id=$_REQUEST['order_id'];


$str_ed = "select * from ".TPLPrefix."orders  where order_id=".$order_id." "; 
$res_ed = $db->get_a_line($str_ed);

?>

<div class="modal-dialog modal-sm">
  <div class="modal-content address-modal modal-sm">
  <div class="modal-header">
  <h4 class="modal-title">Payment Received</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    
  </div>
    <div class="modal-body">
    <form action="#" method="post" class="form-horizontal form-val-1" id="frmPaymentinfo"  name="frmPaymentinfo">
      <div class="form-body modal-body-div">
            <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>"/>
            <input type="hidden" name="status_id" id="status_id" value="<?php echo $status_id; ?>"/>
            <input type="hidden" name="action" value="changePaymentStatus" />
            

                    
                    
                    <div class="form-group">
                        <textarea class="form-control" required name="txtTrnasactionid" id="txtTrnasactionid" Placeholder="Enter Transaction ID" ><?php echo $res_ed['payment_transaction_id']; ?></textarea>
                      </div>
                    
                    <div class="form-group">
                        <button type="button" class="btn btn-primary ml-1 btnNext"  onClick="javascript:updatepaymentstatus('<?php echo $status_id; ?>','<?php echo $order_id; ?>');">Save</button>
                      </div>
                       
                    
        
  </div>
  </form>
</div>
