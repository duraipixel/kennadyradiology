<div class="col-sm-12 col-md-12 col-lg-8" id="hidediv">
    <h6><?php echo $checkoutdisplaylanguage['applycoupon'];?></h6>
      <div class="input-group mb-3 coupon-code">
        <input type="text" id="txtcoupon" name="txtcoupon" class="form-control" value="<?php echo ($_SESSION['Couponcode'] != '') ? $_SESSION['Couponcode'] : ''; ?>"
            placeholder="<?php echo $checkoutdisplaylanguage['entercoupon'];?>"
         />
          <button class="coupon-button" type="button" id="apply-button"> 
            <?php echo $commondisplaylanguage['apply'];?>
        </button>
      </div>
      <div id="coupon-error"></div>
</div>

<div class="col-sm-12 col-md-12 col-lg-4" id="couponremovediv">
    <h6><?php echo $checkoutdisplaylanguage['applycoupon'];?></h6>
      <div class="input-group mb-3 coupon-code">
          <input type="text" id="textCoupon" name="textCoupon" class="form-control"
              value="<?php echo ($_SESSION['Couponcode'] != '') ? $_SESSION['Couponcode'] : $coupon; ?>"
              disabled required=''>
          <button class="coupon-button" type="button" onClick="removecoupons();">
              <?php echo $commondisplaylanguage['remove'];?></button>
      </div>
</div>