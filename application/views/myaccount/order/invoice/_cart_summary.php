<div class="">
    <div class="table-responsive">
        <div class="orderhis cart cartrt bgwhite cartleftrt">
            <div class="tbl-header ">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <col width="100%">
                        <tr>
                            <th><?php echo $orderdisplaylanguage['cartsummary'];?> </th>
                        </tr>
                    </thead>

                </table>
            </div>
            <div class="tbl-content mb30 lastd" id="ordertab">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <col width="60%">
                        <col width="40%">
                        <tr>
                            <td><?php echo $cartdisplaylanguage['cartprice'];?>
                                (<?php echo $getorderdetails_vieworder[0]['total_products']; ?>
                                <?php echo $commondisplaylanguage['items'];?>)</td>
                            <td><?php echo PRICE_SYMBOL;?>
                                <?php echo number_format(round($getorderdetails_vieworder[0]['total_products_wt']),2); ?>
                            </td>
                        </tr>
                        <?php if($getorderdetails_vieworder[0]['coupon_discount']>0){ ?>
                        <tr>
                            <td><?php echo $checkoutdisplaylanguage['coupondiscount'];?>(-)</td>
                            <td><?php echo PRICE_SYMBOL;?>
                                <?php echo number_format($getorderdetails_vieworder[0]['coupon_discount'],2); ?>
                            </td>
                        </tr>
                        <?php }  ?>
                        <tr>
                            <td><?php echo $orderdisplaylanguage['shippingproduct'];?>(+)</td>
                            <td><?php echo PRICE_SYMBOL;?>
                                <?php echo number_format($getorderdetails_vieworder[0]['shippint_cost'],2); ?>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="tbl-header tblhed table-responsive brb0 ftrfnt">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <col width="60%">
                        <col width="40%">
                        <tr>
                            <th><?php echo $orderdisplaylanguage['amountpaid'];?></th>
                            <th><?php echo PRICE_SYMBOL;?>
                                <?php echo number_format($order_info->grand_total,2); ?>
                            </th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>