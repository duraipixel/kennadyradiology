<div class="col-md-12 col-sm-12 col-xs-12 " id="divid">
    <div class="bg-white p-4 shadow">
        <div class="shipping-wraper invoicetop-wraper">
            <?php include('_invoice_head.php') ?>
        </div>
        <div class="shipping-wraper mb-5">
            <?php include('_invoice_address_info.php') ?>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 nopad vieworder-table">
                <?php include('_item_details.php') ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 nopad-right pricebottom-table">
                <?php include('_cart_summary.php') ?>
            </div>
        </div>
    </div>
</div>