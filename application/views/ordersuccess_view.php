<?php include ('includes/style.php') ?>
<?php include ('includes/header.php'); 
  $msg='';
   if($type=='cod'){
	   if($status=='success'){
		 	$msg='Offline order has been Success and orderid is :'.$orderrefid.'';	
            			
	   }
   }
   else
   {
	    if($status=='success'){
            $msg='CCAVE order has been Success and orderis is :'.$orderrefid.'';
		}
   }?>

  
<section class="common-section pt-4">
  <div class="container">
	<div class="panel-group">
      <div class="orderconfirmation-wraper">
    <div class="row">
	  
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="username-container"><h2 class="mb-3"><span><?php echo $msgdisplaylanguage['prefixuser'];?> </span><span class="medium-font"><?php echo $_SESSION['First_name']; ?></span></h2></div>
            <div class="alert alert-success orderconfirm-large"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $msgdisplaylanguage['orderconfirmed'];?> </div>
            <div class="orderconfirm-content text-center"><strong><?php echo $msgdisplaylanguage['thankshopping'];?>. <?php echo $msgdisplaylanguage['yourorder'];?> <a href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderrefid['order_reference'];?>"><?php echo $orderrefid['product_name'];?></a>
              <?php if($orderrefid['cnt']>1){ ?>
             <?php echo $msgdisplaylanguage['and'];?>  <a href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderrefid['order_reference'];?>"><?php echo ($orderrefid['cnt']-1); ?> <?php echo $msgdisplaylanguage['moreitem'];?></a>
              <?php } ?>
              <?php echo $msgdisplaylanguage['hasntship'];?></strong></div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  orderinfo-container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12" align="center">
                <div class="orderinfo">
                  <div class="amountsplit-single">
                    <div class="row pt-3 pb-3">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <?php echo $orderdisplaylanguage['orderid'];?> </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="cartitem-value"><?php echo $orderrefid['order_reference'];?></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>			
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-3 pb-3 bottombtn-wraper" align="center"> <a class="common-btn" style="width:auto; padding: 12px 20px;" href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderrefid['order_reference'];?>">
			<?php echo $orderdisplaylanguage['viewmanage'];?></a> </div>
            </div>
          </div>
    </div>
  </div>
  </div>
</section>






 
  
            
            

<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
</body>
</html>