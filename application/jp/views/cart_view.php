<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><?php echo $commondisplaylanguage['home'];?></a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?php echo $cartdisplaylanguage['shoppingcart'];?></li>
               </ol>
            </nav>
            <h1 class="heading1 text-center text-white"><?php echo $cartdisplaylanguage['shoppingcart'];?></h1>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="row">
         <div class="col" id="cartpage">
            
                                 <?php include_once('partial/cart_table.php')?>
								 
            
         </div>
      </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>