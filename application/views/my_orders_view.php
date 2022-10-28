<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<style>
@import url('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');

.accordion-toggle:after {
    font-family: 'FontAwesome';
    content: "\f078";
    float: right;
}

.accordion-opened .accordion-toggle:after {
    content: "\f054";
}
</style>
<section class="light-gray-bg border-bottom my-account">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="heading1 pb-4 text-uppercase color-dark-blue"><?php echo $headdisplaylanguage['myaccount'];?>
                </h1>
            </div>
            <?php include ('includes/my-account-nav.php') ?>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="box-shadow">
                    <h3 class="text-uppercase"><?php echo $headdisplaylanguage['myorder'];?></h3>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php if( isset( $ordersAll ) && !empty( $ordersAll ) ) { 
                                // ss( $ordersAll )    ;
                            ?>
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
                                            <th class="text-right"><?php echo $checkoutdisplaylanguage['ordertotal'];?>
                                            </th>
                                            <th class="text-center"><?php echo $commondisplaylanguage['action'];?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                    foreach($ordersAll as $orderhistory){
                             
                                        $orderItems = $ordersModel->getOrderItems( ['kr_orders.order_reference' => $orderhistory->order_reference ]);

                                    ?>
                                        <tr data-toggle="collapse" data-target="#demo<?= $orderhistory->order_id?>"
                                            class="accordion-toggle">
                                            <td><?php echo $orderhistory->order_reference; ?></td>
                                            <td><?php echo date("d/m/Y",strtotime( $orderhistory->date_added )); ?></td>
                                            <td><?php echo date("d/m/Y",strtotime( $orderhistory->date_added )); ?></td>
                                            <td><?php echo $orderhistory->total_products; ?></td>
                                            <td><?php echo $orderhistory->order_statusName; ?></td>
                                            <td class="text-right">
                                                <strong>$ <?php echo $orderhistory->grand_total; ?></strong>
                                            </td>
                                            <td class="text-center">

                                                <a class="view-order"
                                                    href="<?php echo BASE_URL;?>my-orders/view/<?php echo $orderhistory->order_reference;?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <?php 
                                                if( in_array( $orderhistory->order_status_id, [1,2,3] ) ) {
                                                ?>
                                                <a href="javascript:void(0)" onclick="return cancel_order(<?= $orderhistory->order_id?>)" class="btn btn-sm btn-danger mx-2"> 
                                                    Cancel Request 
                                                </a>
                                                <?php } else if( $orderhistory->order_status_id == 40 ) { ?>
                                                    <a href="javascript:void(0)"  class="btn btn-sm btn-warning mx-2"> 
                                                        Waiting Cancelled Request
                                                    </a>
                                                <?php } else if( $orderhistory->order_status_id == 5 ) { ?>
                                                    <a href="javascript:void(0)"  class="badge badge-sm badge-danger mx-2"> 
                                                        Cancelled
                                                    </a>
                                                <?php } ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" class="hiddenRow">
                                                <div class="accordian-body collapse w-100"
                                                    id="demo<?= $orderhistory->order_id?>">
                                                    <?php 
                                                if( isset( $orderItems ) && !empty( $orderItems ) )  {
                                                ?>
                                                    <table class="table table-striped w-100">
                                                        <?php 
                                                      foreach ($orderItems as $key => $value) {
                                                       
                                                      ?>
                                                        <tr>
                                                            <td>
                                                                <a class="cartprd-image" href="javascript:void(0);">
                                                                    <?php
                                                                        if(  !empty( $value->product_images ) ) { 
                                                                        ?>
                                                                        <img alt="product" class="img-responsive center-block"
                                                                            src="<?php echo img_base. $value->product_images;?>">
                                                                        <?php } else { ?>
                                                                        <img alt="product" class="img-responsive center-block"
                                                                            src="<?php echo img_base; ?>uploads/noimage/photos/thumb/noimage.png">
                                                                        <?php 
                                                                        }
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td><span
                                                                    class="price"><?php echo $value->product_name; ?></span>
                                                            </td>
                                                            <td> 
                                                                <span>
                                                                    <?php echo PRICE_SYMBOL;?></span> <span
                                                                    class="price">
                                                                    <?php 
												                                    echo  number_format($value->product_price,2); ?>
                                                                </span> </td>
                                                            <td> <span class="price"><?php echo $value->product_qty; ?></span></td>
                                                            <td>
                                                               <span><?php echo PRICE_SYMBOL;?></span> 
                                                               <span>
                                                                  <span class="total_price">
                                                                  <?php
                                                                  echo number_format($value->prod_sub_total,2); ?>
                                                               </span></span>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                if( $orderhistory->order_status_id != 40 && $value->IsActive == 1 ) {
                                                                ?>
                                                                <a href="javascript:void(0)" onclick="return cancel_order(<?= $orderhistory->order_id ?>, <?= $value->order_product_id ?>)"
                                                                    class="btn btn-danger btn-sm"> 
                                                                        Cancel Request 
                                                                </a>
                                                                <?php } else if( $orderhistory->order_status_id != 40 && $value->IsActive == 3 ) { ?>
                                                                    <a href="javascript:void(0)" class="btn btn-waring btn-sm"> 
                                                                        Waiting for canceled request
                                                                    </a>
                                                                <?php } else if( $orderhistory->order_status_id != 40 && $value->IsActive == 4 ) { ?>
                                                                    <a href="javascript:void(0)" class="btn btn-waring btn-sm"> 
                                                                        Cancelled
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href="javascript:void(0)" class="btn btn-waring btn-sm"> 
                                                                        Waiting for canceled request
                                                                    </a>
                                                                <?php }  ?>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                         }
                                                        ?>
                                                    </table>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
    <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
</div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<script>
   function cancel_order( order_id, order_product_id = '' ) {
      var urls = '<?php echo BASE_URL; ?>my_orders/cancelOrderModal';
      $.ajax({
         url: urls,
         type:'POST',
         data:{order_id:order_id,order_product_id:order_product_id},
         beforeSend: function(){
            loading();
         },
         success:function(res) {
            unloading();
            $('#cancelOrderModal').html(res);
            $('#cancelOrderModal').modal('show');
         }
      });
   }

  
</script>