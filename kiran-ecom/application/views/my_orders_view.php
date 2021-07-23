<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
				<h5 class="pb-4 text-uppercase">My Account</h5>
			</div>
			<?php include ('includes/my-account-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<h3 class="text-uppercase">My Orders</h3>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="table-responsive">
                           <table id="cart-table" class="table table-my-orders">
                              <thead>
                                 <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
									<th>Delivery Date</th>
									<th>Number of Items</th>
									<th>Payment Method</th>
                                    <th class="text-right">Order Value</th>
									<th class="text-center">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>KIR000111</td>
                                    <td>13/05/2021</td>
                                    <td>14/05/2021</td>
									<td>06</td>
									<td><img src="<?php echo BASE_URL;?>/static/images/payment-methods-visa.jpg" alt="" class="img-fluid"/></td>
                                    <td class="text-right">
                                       <strong>$ 564.63</strong>
                                    </td>
									<td class="text-center">
										<button type="button" class="view-order">
										  <i class="fa fa-download"></i>
										</button> &nbsp;
                                       <button type="button" class="view-order">
										  <i class="fa fa-eye"></i>
										</button>
                                    </td>
                                 </tr>
								 <tr>
                                    <td>KIR000112</td>
                                    <td>27/05/2021</td>
                                    <td>28/05/2021</td>
									<td>04</td>
									<td><img src="<?php echo BASE_URL;?>/static/images/payment-methods-mastercard.jpg" alt="" class="img-fluid"/></td>
                                    <td class="text-right">
                                       <strong>$ 846.92</strong>
                                    </td>
									<td class="text-center">
										<button type="button" class="view-order">
										  <i class="fa fa-download"></i>
										</button> &nbsp;
                                       <button type="button" class="view-order">
										  <i class="fa fa-eye"></i>
										</button>
                                    </td>
                                 </tr>
								 <tr>
                                    <td>KIR000113</td>
                                    <td>09/06/2021</td>
                                    <td>10/06/2021</td>
									<td>02</td>
									<td><img src="<?php echo BASE_URL;?>/static/images/payment-methods-paypal.jpg" alt="" class="img-fluid"/></td>
                                    <td class="text-right">
                                       <strong>$ 671.87</strong>
                                    </td>
									<td class="text-center">
                                       <button type="button" class="view-order">
										  <i class="fa fa-download"></i>
										</button> &nbsp;
										<button type="button" class="view-order">
										  <i class="fa fa-eye"></i>
										</button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
						</div>
                    </div>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>