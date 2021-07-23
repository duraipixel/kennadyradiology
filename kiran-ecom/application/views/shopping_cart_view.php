<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
               </ol>
            </nav>
            <h3 class="text-center text-white"><span>Shopping Cart</span></h3>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="row">
         <div class="col">
            <div class="table-responsive">
               <table id="cart-table" class="table cart-table">
                  <thead>
                     <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="text-right">Sub Total</th>
                        <th>&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <a href="<?php echo BASE_URL;?>product-listing" class="cart-items">
                           <img src="<?php echo BASE_URL;?>/static/images/products/product-image1.png" alt="" class="img-fluid" />
                           <span><strong>Coat Apron with Head Shield</strong>SKU #111100</span>
                           </a>
                        </td>
                        <td>$ 390.90</td>
                        <td>
                           <div class="input-group quantity-buttons">
                              <span class="input-group-btn">
                              <button type="button" class="quantity-left-minus qty1"  data-type="minus" data-field="">
                              <span class="flaticon-minus-2"></span>
                              </button>
                              </span>
                              <input type="text" id="quantity1" name="quantity" class="form-control input-number" value="2" min="1" max="100">
                              <span class="input-group-btn">
                              <button type="button" class="quantity-right-plus qty1" data-type="plus" data-field="">
                              <span class="flaticon-plus-1"></span>
                              </button>
                              </span>
                           </div>
                        </td>
                        <td class="text-right">
                           <strong>$ 390.90</strong>
                        </td>
                        <td>
                           <button class="cart-close-btn" type="button"><i class="flaticon-cancel-12"></i></button>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <a href="<?php echo BASE_URL;?>product-listing" class="cart-items">
                           <img src="<?php echo BASE_URL;?>/static/images/products/product-image2.png" alt="" class="img-fluid" />
                           <span><strong>C-Arm Pro Elite Apron</strong>SKU #111100</span>
                           </a>
                        </td>
                        <td>$ 200.90</td>
                        <td>
                           <div class="input-group quantity-buttons">
                              <span class="input-group-btn">
                              <button type="button" class="quantity-left-minus qty2"  data-type="minus" data-field="">
                              <span class="flaticon-minus-2"></span>
                              </button>
                              </span>
                              <input type="text" id="quantity2" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                              <span class="input-group-btn">
                              <button type="button" class="quantity-right-plus qty2" data-type="plus" data-field="">
                              <span class="flaticon-plus-1"></span>
                              </button>
                              </span>
                           </div>
                        </td>
                        <td class="text-right">
                           <strong>$ 200.90</strong>
                        </td>
                        <td>
                           <button class="cart-close-btn" type="button"><i class="flaticon-cancel-12"></i></button>
                        </td>
                     </tr>
                  </tbody>
                  <tfoot>
                     <tr>
                        <th colspan="3" class="text-right">
                           <strong>SUB TOTAL</strong>
                        </th>
                        <th class="text-right">
                           <strong>$ 591.80</strong>
                        </th>						
                        <th>
                           &nbsp;
                        </th>
                     </tr>
                  </tfoot>
               </table>
            </div>
            <p class="cart-buttons">
               <button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>product-listing/';">
               Continue Shopping
               </button>
               <button type="button" class="buy-now-btn1" onclick="location.href='<?php echo BASE_URL; ?>checkout/';">
               Proceed to Checkout
               </button>
            </p>
         </div>
      </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>