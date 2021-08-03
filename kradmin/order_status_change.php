<?php
error_reporting(0);
include "session.php";
//echo $uid; exit;
$status_id=$_REQUEST['status_id'];
$order_id=$_REQUEST['order_id'];


$str_ed = "select * from ".TPLPrefix."orders  where order_id=".$order_id." "; 
$res_ed = $db->get_a_line($str_ed);
$str_ed_awb = "select * from ".TPLPrefix."orders_awb  where order_id=".$order_id." and IsActive=1"; 
$res_ed_awb = $db->get_a_line($str_ed_awb);
?>

<div class="modal-dialog modal-sm">
  <div class="modal-content address-modal modal-sm">
  <div class="modal-header">
  <h4 class="modal-title">order status</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    
  </div>
    <div class="modal-body">
    <form action="#" method="post" class="form-horizontal form-val-1" id="frmorderinfo"  name="frmorderinfo">
      <div class="form-body modal-body-div">
            <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>"/>
            <input type="hidden" name="status_id" id="status_id" value="<?php echo $status_id; ?>"/>
            <input type="hidden" name="action" value="change_Order_Status" />
            

                    <?php 
                    
//shipped - 3 awb
//delivery - 14 - sap
//cancel - 5 - utr
?>
                    <?php if($status_id=='3'){?>
                        <div class="form-group">
                        <textarea class="form-control" required name="txtawb_refno" id="txtawb_refno" Placeholder="Enter AWB Ref." ><?php echo $res_ed_awb['awb']; ?></textarea>
                        </div>
                    <?php } ?>
                    
                     <?php if($status_id=='14'){?>
                        <div class="form-group">
                        <textarea class="form-control" required name="txtsap_refno" id="txtsap_refno" Placeholder="Enter SAP Invoice No" ><?php echo $res_ed['sap_refno']; ?></textarea>
                        </div>
                    <?php } ?>
                    
                     <?php if($status_id=='5'){?>
                        <div class="form-group">
                        <textarea class="form-control" required name="txtutr_refno" id="txtutr_refno" Placeholder="Enter UTR REf." ><?php echo $res_ed['utr_refno']; ?></textarea>
                        </div>
                    <?php } ?>
                    
                    
                    
                    <div class="form-group">
                        <button type="button" class="btn btn-primary ml-1 btnNext"  onClick="javascript:updateorderstatus('<?php echo $status_id; ?>','<?php echo $order_id; ?>');">Save</button>
                      </div>
                       
                    
        
  </div>
  </form>
</div>
