<?php include ('includes/style.php') ?>
<?php include ('includes/header.php'); ?>

<section class="light-gray-bg">
  <div class="container">
    <div class="login-section">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 orderconfirmation-wraper">
          <div class="bg-white shadow p-5">
            <div class="row">
              <div class="col-sm-12 col-xs-12 ">
                <div class="username-container">
                  <h3><?php echo $msgdisplaylanguage['prefixuser'];?> <?php echo $_SESSION['First_name']; ?></h3>
                </div>
                <div class="orderconfirm-large alert alert-danger"> <i class="fa fa-times-circle" aria-hidden="true"></i> <?php echo $msgdisplaylanguage['ordercanceled'];?> </div>
                <div class="orderconfirm-content text-center"> <strong><?php echo $msgdisplaylanguage['ordercanceled_text'];?> <?php echo $orderrefid['order_reference']; ?>. <?php echo $msgdisplaylanguage['ordercanceled_sub'];?> </strong> </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  orderinfo-container">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row pt-4 pb-4">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="text-center"><?php echo $orderdisplaylanguage['orderid'];?></h3>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="cartitem-value"><?php echo $orderrefid['order_reference']; ?></div>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-4 text-center"> <a class="yellow-btn" style="width:auto; padding:12px 20px;" href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderrefid['order_reference'];?>"><?php echo $orderdisplaylanguage['viewmanage'];?></a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
</body></html>