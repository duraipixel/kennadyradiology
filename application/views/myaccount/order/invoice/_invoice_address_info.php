<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 pb-4 border-bottom addside-wraper">
        <div class="invoice-billingaddress">
            <h4> <?php echo $orderdisplaylanguage['billingaddress'];?> </h4>
            <div class="addrlist-container addscroll-div pt-3">
                <div class="row form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 addrsingle">
                        <div class="radio">
                            <label>
                                <p class="addrname">
                                    <?php echo $getorderdetails_vieworder[0]['firstname']; ?>&nbsp;<?php echo $getorderdetails_vieworder[0]['lastname']; ?>
                                </p>
                                <p> <?php echo $getorderdetails_vieworder[0]['payment_address_1']; ?><br>
                                </p>
                                <p><?php echo $getorderdetails_vieworder[0]['payment_city']; ?>,<?php echo $getorderdetails_vieworder[0]['payment_postcode']; ?>,<?php echo $getorderdetails_vieworder[0]['billingstate']; ?>,<?php echo $getorderdetails_vieworder[0]['billingcountry']; ?>.
                                </p>
                                <p><?php echo $orderdisplaylanguage['orderemail'];?>:
                                    <?php echo $getorderdetails_vieworder[0]['email']; ?></p>
                                <p><?php echo $orderdisplaylanguage['ordermobile'];?>:
                                    <?php echo $getorderdetails_vieworder[0]['payment_telephone']; ?>
                                </p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 pb-4 border-bottom addside-wraper">
        <div class="invoice-shippingaddress">
            <h4> <?php echo $orderdisplaylanguage['shippingaddress'];?> </h4>
            <div class="addrlist-container addscroll-div pt-3">
                <div class="row form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 addrsingle">
                        <div class="radio">
                            <label>
                                <p class="addrname">
                                    <?php echo $getorderdetails_vieworder[0]['shipping_firstname']; ?>&nbsp;<?php echo $getorderdetails_vieworder[0]['shipping_lastname']; ?>
                                </p>
                                <p> <?php echo $getorderdetails_vieworder[0]['shipping_address_1']; ?><br>
                                </p>
                                <p><?php echo $getorderdetails_vieworder[0]['shipping_city']; ?>,<?php echo $getorderdetails_vieworder[0]['shipping_postcode']; ?>,<?php echo $getorderdetails_vieworder[0]['shippingstate']; ?>,<?php echo $getorderdetails_vieworder[0]['shippingcountry']; ?>.
                                </p>
                                <p><?php echo $orderdisplaylanguage['orderemail'];?>:
                                    <?php echo $getorderdetails_vieworder[0]['email']; ?></p>
                                <p><?php echo $orderdisplaylanguage['ordermobile'];?>:
                                    <?php echo $getorderdetails_vieworder[0]['shipping_telephone']; ?>
                                </p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>