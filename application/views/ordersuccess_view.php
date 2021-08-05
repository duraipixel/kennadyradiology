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

  
<section class="light-gray-bg">
  <div class="container">
      <div class="orderconfirmation-wraper">
    <div class="row justify-content-center">
	  
          <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
		  
	<div class="bg-white shadow p-5">
            <div class="username-container"><h3 class="mb-3"><?php echo $msgdisplaylanguage['prefixuser'];?> <?php echo $_SESSION['First_name']; ?></h3></div>
            <div class="alert alert-success orderconfirm-large"> <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo $msgdisplaylanguage['orderconfirmed'];?> </div>
            <div class="orderconfirm-content text-center"><h4><small><?php echo $msgdisplaylanguage['thankshopping'];?>. <?php echo $msgdisplaylanguage['yourorder'];?> <a href="<?php echo BASE_URL;?>my-orders/view/<?php echo $orderrefid['order_reference'];?>"><?php echo $orderrefid['product_name'];?></a>
              <?php if($orderrefid['cnt']>1){ ?>
             <?php echo $msgdisplaylanguage['and'];?>  <a href="<?php echo BASE_URL;?>my-orders/view/<?php echo $orderrefid['order_reference'];?>"><?php echo ($orderrefid['cnt']-1); ?> <?php echo $msgdisplaylanguage['moreitem'];?></a>
              <?php } ?>
              <?php echo $msgdisplaylanguage['hasntship'];?></small></h4></div>
			  <div class="orderinfo">
                  <div class="amountsplit-single">
                    <div class="row pt-3 pb-3">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><h3 class="text-center"><?php echo $orderdisplaylanguage['orderid'];?></h3></div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="cartitem-value text-center"><h3>#<?php echo $orderrefid['order_reference'];?><h3></div>
                      </div>
                    </div>
                  </div>
              </div>
			  <div class="text-center"> <a class="yellow-btn" style="width:auto; padding: 12px 20px;" href="<?php echo BASE_URL;?>my-orders/view/<?php echo $orderrefid['order_reference'];?>">
			<?php echo $orderdisplaylanguage['viewmanage'];?></a> </div>
          </div>
		  </div>
  </div>
  </div>
</section>






 
  
            
            

<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
</body>
</html>