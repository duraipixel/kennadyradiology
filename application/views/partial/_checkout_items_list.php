<table id="cart-table" class="table cart-table">
    <thead>
        <tr>
            <th><?php echo $cartdisplaylanguage['cartproduct'];?></th>
            <th><?php echo $cartdisplaylanguage['itemcode'];?></th>
            <th><?php echo $cartdisplaylanguage['cartprice'];?> (<?php echo PRICE_SYMBOL;?>)</th>
            <th class="centrie">
                <?php echo $commondisplaylanguage['quantity'];?>
            </th>
            <th class="text-right">
                <?php echo $commondisplaylanguage['carttotal'];?>
                (<?php echo PRICE_SYMBOL; ?>)
            </th>
        </tr>
    </thead>
    <tbody id="ordertab">
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
                    <?php
                    if($img_path != ''){
                                    ?>
                    <a href="<?php echo $product_link ?>" class="cart-items">

                        <img width="68" height="88"
                            src="<?= $img_path ?>"
                            alt="<?php echo $items->product_name; ?>" class="img-fluid">
                        <?php }else{?>
                        <img src="<?php echo img_base;?>uploads/noimage/photos/thumb/noimage.png"
                            alt="<?php echo $items->product_name; ?>" class="img-fluid">
                        <?php }?>
                        <span>
                            <p><strong> <?php echo $items->product_name; ?> </strong></p>
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
                        </span>
                    </a>
                </td>
                <td><?php echo $items->product_code; ?></td>
                <td><?php echo PRICE_SYMBOL.number_format($items->product_amount,2); ?></td>
                <td> <?php echo $items->product_qty; ?>
                </td>
                <td class="text-right"><strong> <?php echo number_format($productTotal,2);  ?></strong></td>
            </tr>
            <?php 
            $cnt++; 
            } 
            $itemTotal = $grandtotal = $total;
        }?>
            <input type="hidden" name="grand_total" id="grand_total" value="<?= $total ?>">
    </tbody>
</table>