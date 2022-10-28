<?php  
$cnt=1;
foreach($getmanageaddressdisplay as $displayaddress) {

    $checked = '';
    if( isset($_SESSION['addressid']) && $_SESSION['addressid']==$displayaddress['cus_addressid'] ) {
        $checked = 'checked';
    } else {
        if( $cnt == 1 && ( !isset( $_SESSION['addressid'] ) || ( isset($_SESSION['addressid']) && empty( $_SESSION['addressid'] ) ) ) ) {
            $checked = 'checked';
        }
    }
    
?>
<div class="col-sm-12 col-md-6 col-lg-4">
    <div
        class="delivery-address <?php echo (isset($_SESSION['addressid']) && $_SESSION['addressid']==$displayaddress['cus_addressid'])? "   " :''; ?>">
        <div class="chiller_cb">
            <input type="radio" id="slctadd_<?php echo $cnt; ?>"
                onChange="return displayshipping_add('<?php echo $displayaddress['cus_addressid']; ?>')"
                <?= $checked ?>
                name="slctadd">
            <label for="slctadd_<?php echo $cnt; ?>">&nbsp;</label>
            <span></span>
        </div>
        <p><i class="flaticon-user-7"></i>
            <?php echo $displayaddress['firstname']." ".$displayaddress['lastname']; ?>
        </p>
        <p><i class="flaticon-location-fill"></i>
            <?php echo $displayaddress['address']; ?> </p>
        <p><i class="flaticon-telephone"></i>
            <?php echo $displayaddress['telephone']; ?></p>
        <p><i class="flaticon-email-fill-1"></i>
            <?php echo $displayaddress['emailid']; ?></p>
        <p class="select-address">
            <!--    <button type="button" class="add-to-cart-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <?php echo $checkoutdisplaylanguage['deliveryhere'];?> </button>-->
            &nbsp;&nbsp; <button type="button" class="edit-address"
                data-mdb-toggle="tooltip"
                onClick="javascript:editaddress(<?php echo $displayaddress['cus_addressid']; ?>);"
                title="<?php echo $commondisplaylanguage['editaddress'];?>"> <i
                    class="flaticon-edit-1"></i> </button>
            &nbsp;&nbsp;
            <button type="button" class="delete-address"
                onClick="javascript:deladdress(<?php echo $displayaddress['cus_addressid'];?>);"
                data-mdb-toggle="tooltip" title="Delete Address">
                <i class="flaticon-delete-1"></i>
            </button>
        </p>
        </label>
    </div>
</div>
<?php $cnt++; } ?>