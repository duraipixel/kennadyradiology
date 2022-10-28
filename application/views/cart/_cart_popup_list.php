<button class="dropbtn">
    <span class="cart-items-icon">
        <i class="flaticon-cart" aria-hidden="true"></i>
    </span> 
    <span class="d-none d-sm-block">
        My Cart ( <?= count($cart_list) ?> )  
    </span>
    <span class="mobile-count d-block d-sm-none"> <?= count($cart_list) ?> </span>
</button>
<div class="dropdown-content">
    <table class="table mb-0"> 
        <tbody>
            <!-- cart productlist start -->
            <?php 
            if( isset( $cart_list ) && !empty( $cart_list ) ) {
                $total = 0;
                foreach ( $cart_list as $key => $items ) {
                    $productTotal = $items->product_qty * $items->product_amount;
                    $total          += $productTotal;
                    $productImage = getCartProductImages( $items->cart_product_id );
                    $product_link = BASE_URL.'products/'.$items->categoryCode.'/'.$items->product_url;   
                    $img_path = img_base.'uploads/productassest/'.$items->product_id.'/photos/'.$productImage->img_path; 
                    
            ?>
            <tr>
                <td>
                    <a href="<?= $product_link ?>">
                        <img src="<?= $img_path ?>" class="cart-items-image" alt="COAT APRON">
                    </a>
                    <input type="hidden" id="productid" value="<?= $items->product_id ?>">
                    <button class="btn btn-danger btn-xs" type="button" title="Remove Product" onclick="deletecartfunction(<?= $items->cart_product_id ?>);">
                        <i class="flaticon-cancel-12"></i>
                    </button>
                </td>
                <td>
                    <p class="header-cart-description">
                        <a href="<?= $product_link ?>">
                            <?= $items->product_name ?>
                        </a>
                    </p>
                    <small>
                    <?php 
                        $attributes = getCartProductAttributes($items->cart_product_id);
                        
                        if( isset( $attributes ) && !empty( $attributes ) ) {
                            foreach ( $attributes as $key => $value ) {
                                echo $value->attributename.' : '.$value->dropdown_values.'<br>';
                            }
                        }
                    ?>
                    </small>
                </td>
                <td>
                    <p class="header-cart-description"><span class="header-cart-price">$<?= $productTotal ?></span></p>
                    <div class="text-right text-muted px-1"> Qty: <?= $items->product_qty ?> x $<?= $items->product_amount  ?></div>
                </td>
            </tr>
            <?php 
                } 
            ?>
            <tr class="no-border">
                <td colspan="2">
                    <h4 class="text-right">Total</h4>
                </td>
                <td>
                    <h4 class="text-right"><strong>$<?= $total ?></strong></h4>
                </td>
            </tr>
            <tr class="no-border">
                <td colspan="3">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary"
                                onclick="window.location='<?= BASE_URL ?>cart'" type="button">
                                View Cart
                                <i class="flaticon-cart-2"></i>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-secondary"
                                onclick="window.location='<?= BASE_URL ?>checkout'"
                                type="button">
                                Checkout 
                                <i class="flaticon-check"></i>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            <?php 
                } else {
            ?>
            <tr>
                <td>
                    There are no items in the Cart. Would you like to add now?
                </td>
            </tr>
            <?php } ?>
            <!-- cart productlist end -->
        </tbody>
    </table>
</div>