<?php  include ('includes/top.php') ?>
<body class="productbg">
<?php include ('includes/header.php') ?>
<?php
//echo $helper->displaymenu();
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
          <li><a href="#">Order Summary</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section >
  <div class="container">
    <div class="infotitle mb5"> <span>
      <h3>Order Summary</h3>
      </span> </div>
    <div class="cart-section">
      <div class="row">
        <div class="col-md-9 ">
          <div class="orderhis cart bgwhite cartleftht">
            <div class="tbl-header table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" >
                <thead>
                <col width="30%">
                <col width="20%">
                <col width="15%">
                <col width="15%">
                <col width="20%">
                <tr>
                  <th>Product</th>
                  <th>Item Code</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
                  </thead>
                
              </table>
            </div>
            <div class="tbl-content scrlcnt"  id="ordertab">
              <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <col width="30%">
                <col width="20%">
                <col width="15%">
                <col width="15%">
                <col width="20%">
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                <tr>
                  <td><span class="cartproimg"> <img src="<?php echo BASE_URL; ?>static/images/cat-img-1.png" alt=""> </span> <span> Trophies & Award </span></td>
                  <td>#12543</td>
                  <td><i class="fa fa-inr"></i> 250</td>
                  <td>01</td>
                  <td><i class="fa fa-inr"></i> 500.00</td>
                </tr>
                  </tbody>
                
              </table>
            </div>
            <div class="tbl-header table-responsive tblbtmpad thpadrt">
              <table cellpadding="0" cellspacing="0" border="0" >
                <thead>
                <col width="50%">
                <col width="50%">
                <tr>
                  <th> <div class="cpntxt">
                      <p>What would you like to do next?</p>
                      <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                    </div>
                    <div class="cpn">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Use Coupon Code">
                        <span class="input-group-btn" style="width:0;">
                        <button class="btn btn-default" type="button">Apply Coupon</button>
                        </span> </div>
                    </div>
                  </th>
                  <th> <span class="totaltxt"> Sub-Total : </span> <span class="totalamt"> <i class="fa fa-inr"></i> 500.00 </span>
                    <div class="mt20"> <span class="totaltxt"> Coupon Discount : </span> <span class="totalamt"> <i class="fa fa-inr"></i> 500.00 </span> </div>
                  </th>
                </tr>
                  </thead>
                
              </table>
            </div>
            <div class="tbl-header table-responsive tblbtmpad tblftr">
              <table cellpadding="0" cellspacing="0" border="0" >
                <thead>
                <col width="100%">
                <tr>
                  <th> <span class="totaltxt"> Total : </span> <span class="totalamt"> <i class="fa fa-inr"></i> 500.00 </span>
                    <div class="mt20"> <a href="javascript:void(0);">
                      <button class="btn btn-default cartproceedbtn">Continue to Checkout</button>
                      </a> </div>
                  </th>
                </tr>
                  </thead>
                
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="orderhis cart cartrt bgwhite cartleftrt">
            <div class="tbl-header table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" >
                <thead>
                <col width="100%">
                <tr>
                  <th>Cart Summary</th>
                </tr>
                  </thead>
                
              </table>
            </div>
            <div class="tbl-content mb30 lastd"  id="ordertab">
              <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <col width="60%">
                <col width="40%">
                <tr>
                  <td>Price (3items)</td>
                  <td><i class="fa fa-inr"></i> 49500.00</td>
                </tr>
                <tr>
                  <td>Delivery Charges</td>
                  <td><i class="fa fa-inr"></i> 150</td>
                </tr>
                <tr>
                  <td>Delivery Charges</td>
                  <td><i class="fa fa-inr"></i> 150</td>
                </tr>
                <tr>
                  <td>Delivery Charges</td>
                  <td><i class="fa fa-inr"></i> 150</td>
                </tr>
                  </tbody>
                
              </table>
            </div>
            <div class="tbl-header tblhed table-responsive brb0 ftrfnt">
              <table cellpadding="0" cellspacing="0" border="0" >
                <thead>
                <col width="60%">
                <col width="40%">
                <tr>
                  <th>Amount Payable</th>
                  <th><i class="fa fa-inr"></i> 49500.00</th>
                </tr>
                  </thead>
                
              </table>
            </div>
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
