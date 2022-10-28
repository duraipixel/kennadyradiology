<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');  ?>

<section class="light-gray-bg">
    <div class="container">
        <div >
            <div class="row showroom-single">
                <div class="col-md-12 col-sm-12 col-xs-12 section-title">
                    <div class="row align-items-center">
                        <div class="col-4 col-sm-6 mb-4"> <img src="<?php echo img_base;?>static/images/logo.svg"
                                class="img-fluid" style="width: 100px;" alt="logo"> </div>
                        <div class="col-8 col-sm-6 text-right mb-4"> <a href="javascript:void(0);" id="btn"
                                class="blue-btn mr-3 mb-4" onClick="printInvoice('divid')" style="box-shadow: none;"> <i
                                    class="fa fa-print"
                                    aria-hidden="true"></i>&nbsp;<?php echo $orderdisplaylanguage['print'];?></a> <a
                                href="<?php echo BASE_URL;?>my-orders" class="blue-btn1 mb-4"> <span> <i
                                        class="fa fa-angle-left"></i>
                                    <?php echo $commondisplaylanguage['back'];?></span> </a> </div>
                    </div>
                </div>
                <?php include('myaccount/order/invoice/invoice.php')?>
            </div>
            <div> </div>
</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>
$(document).ready(function() {
    /**/
    $('.scrlcnt').overlayScrollbars({});
});

function printInvoice(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = "<html><head></head><body>" + printContents + "</body>";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
</body>

</html>