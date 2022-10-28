<div class="">
    <div class="table-responsive">
        <div class="orderhis cart bgwhite cartleftht ">
            <div class="tbl-header ">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th><?php echo $cartdisplaylanguage['cartimage'];?></th>
                            <th><?php echo $cartdisplaylanguage['cartproduct'];?></th>
                            <th><?php echo $cartdisplaylanguage['itemcode'];?> </th>
                            <th><?php echo $cartdisplaylanguage['cartprice'];?></th>
                            <th class="centrie"><?php echo $commondisplaylanguage['quantity'];?></th>
                            <th><?php echo $commondisplaylanguage['carttotal'];?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content scrlcnt" id="ordertab">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <?php 
                        // print_r( $order_info );
                        if( isset( $orderItemDetails ) && !empty( $orderItemDetails ) ) {
                            foreach ( $orderItemDetails as $items ) {
                                // print_r( $items );
                        ?>
                        <tr>
                            <td>
                                <a class="cartprd-image" href="javascript:void(0);">
                                    <?php
                                    if(  !empty( $items->product_images ) ) { 
                                    ?>
                                    <img alt="product" class="img-responsive center-block"
                                        src="<?php echo img_base. $items->product_images;?>">
                                    <?php } else { ?>
                                    <img alt="product" class="img-responsive center-block"
                                        src="<?php echo img_base; ?>uploads/noimage/photos/thumb/noimage.png">
                                    <?php 
                                    }
                                    ?>
                                </a>
                            </td>
                            <td><?= $items->product_name ?></td>
                            <td>
                                <span class="price"><?php echo $items->item_code; ?></span>
                            </td>
                            <td class="price_col">
                                <span><?php echo PRICE_SYMBOL;?></span> 
                                <span  class="price">
                                    <?php 
                                        echo  number_format($items->product_price,2); ?>
                                </span>
                            </td>
                            <td class="centrie">
                                <span class="price"><?php echo $items->product_qty; ?></span>
                            </td>
                            <td class="total_col">
                                <span><?php echo PRICE_SYMBOL;?></span> 
                                <span>
                                    <span  class="total_price">
                                        <?php
                                            echo number_format($items->prod_sub_total,2); ?>
                                    </span>
                                </span>
                            </td>
                        </tr>
                        <?php 
                            }                        
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tbl-header table-responsive pricebottom-table">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="tdsingle-row text-uppercase text-left">
                                    <?php echo $commondisplaylanguage['carttotal'];?> </div>
                            </td>
                            <td>
                                <span><?php echo PRICE_SYMBOL;?> </span> 
                                <span> 
                                    <span id="subtot">
                                        <?php echo number_format($order_info->total_products_wt,2); ?>
                                    </span> 
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </div>