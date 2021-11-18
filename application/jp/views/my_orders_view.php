<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
				<h1 class="heading1 pb-4 text-uppercase color-dark-blue"><?php echo $headdisplaylanguage['myaccount'];?></h1>
			</div>
			<?php include ('includes/my-account-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<h3 class="text-uppercase"><?php echo $headdisplaylanguage['myorder'];?></h3>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
						    <?php if(count($getorderdetails_history)>0){ ?>
							<div class="table-responsive">
                           <table id="cart-table" class="table table-my-orders">
                              <thead>
                                 <tr>
                                    <th><?php echo $orderdisplaylanguage['orderid'];?></th>
                                    <th><?php echo $orderdisplaylanguage['orderdate'];?></th>
									<th><?php echo $orderdisplaylanguage['deliverydate'];?></th>
									<th><?php echo $orderdisplaylanguage['noofitem'];?></th>
									<!--<th>Payment Method</th>-->
									<th><?php echo $orderdisplaylanguage['orderstatus'];?></th>
                                    <th class="text-right"><?php echo $checkoutdisplaylanguage['ordertotal'];?></th>
									<th class="text-center"><?php echo $commondisplaylanguage['action'];?></th>
                                 </tr>
                              </thead>
                              <tbody>
                                  <?php foreach($getorderdetails_history as $orderhistory){ ?>
                                 <tr>
                                    <td><?php echo $orderhistory['order_reference']; ?></td>
                                    <td><?php echo date("d/m/Y",strtotime($orderhistory['date_added'])); ?></td>
                                    <td><?php echo date("d/m/Y",strtotime($orderhistory['date_added'])); ?></td>
									<td><?php echo $orderhistory['total_products']; ?></td>
									<td><?php echo $orderhistory['order_statusName']; ?></td>
								<!--	<td><img src="<?php echo img_base;?>/static/images/payment-methods-visa.jpg" alt="" class="img-fluid"/></td>-->
                                    <td class="text-right">
                                       <strong>$ <?php echo $orderhistory['grand_total']; ?></strong>
                                    </td>
									<td class="text-center">
										<!--<button type="button" class="view-order">
										  <i class="fa fa-download"></i>
										</button> -->
                                       <a class="view-order" href="<?php echo BASE_URL;?>my-orders/view/<?php echo $orderhistory['order_reference'];?>">
										  <i class="fa fa-eye"></i>
										</a>
                                    </td>
                                 </tr>
                                 <?php } ?>
								 <!--<tr>
                                    <td>KIR000112</td>
                                    <td>27/05/2021</td>
                                    <td>28/05/2021</td>
									<td>04</td>
									<td><img src="<?php echo img_base;?>/static/images/payment-methods-mastercard.jpg" alt="" class="img-fluid"/></td>
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
									<td><img src="<?php echo img_base;?>/static/images/payment-methods-paypal.jpg" alt="" class="img-fluid"/></td>
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
                                 </tr>-->
                              </tbody>
                           </table>
                        </div>
                        <?php } else { ?>
                        <h5>No Order History Found.</h5>
                        <?php } ?>
						</div>
                    </div>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>