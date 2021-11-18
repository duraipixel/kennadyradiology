<?php include ('includes/style.php') ?>
<?php include ('includes/header.php'); ?>

<section class="light-gray-bg">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 orderconfirmation-wraper">
        <div class="bg-white shadow p-5">
          <div class="username-container">
            <h3 class="mb-3">
            <?php echo $msgdisplaylanguage['prefixuser'];?><?php echo $_SESSION['First_name']; ?>
            <h3>
          </div>
          <div class="orderconfirm-large alert alert-danger"> <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp; <?php echo $msgdisplaylanguage['orderfailed'];?>. </div>
          <div class="orderconfirm-content text-center"> <?php echo $msgdisplaylanguage['orderfailed_msg'];?>. </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
</body></html>