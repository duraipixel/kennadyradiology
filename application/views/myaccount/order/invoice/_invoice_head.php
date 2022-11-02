<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
        <h1 class="heading1 blue-bg text-center text-white pt-2 pb-2">
            <?php echo $orderdisplaylanguage['invoicetitle'];?></h1>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 mb-5 pb-4 border-bottom">
        <div class="row invoice-address"> <?php echo $helper->getStoreConfigvalue('store_address'); ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 mb-5 pb-4 border-bottom addside-wraper invoiceright-top">
        <div class="invoice-order-details text-right">
            <div class="">
                <h4><?php echo $orderdisplaylanguage['orderid'];?>
                    #<?php echo $getorderdetails_vieworder[0]['order_reference']; ?> </h4>
            </div>
            <div class="">
                <label><?php echo $orderdisplaylanguage['datetime'];?> </label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['date']; ?>,
                    <?php echo $getorderdetails_vieworder[0]['time']; ?> </span>
            </div>
            <?php if($getorderdetails_vieworder[0]['payment_gstno']!=''){ ?>
            <div class="">
                <label><?php echo $orderdisplaylanguage['gstno'];?> </label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['payment_gstno']; ?>
                </span>
            </div>
            <?php } ?>
   
            <div class="">
                <label><?php echo $orderdisplaylanguage['orderstatus'];?></label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['order_statusName']; ?>
                </span>
            </div>

        </div>
    </div>
</div>