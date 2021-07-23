<?php  
//echo "<pre>"; print_r($getorderdetails_history); exit;
include ('includes/top.php') ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
  
	<section class="myorders">
		<div  class="container">
		<div class="row">
			<?php include ('partial/leftsidebar.php') ?>
	
		<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 nopad sss2">
			<div class="accountinfosec pd20">
				<div class="infotitle">
					<span><h3>Order History</h3></span>
				</div>
				<?php if(count($getorderdetails_history)>0){ ?>
				<div class="table-responsive">
				<div class="orderhis">
				<div class="tbl-header table-responsive">
				    <table cellpadding="0" cellspacing="0" border="0" >
						<colgroup>
						<col width="12%">
						<col width="15%">
						<col width="18%">
						<col width="18%">
						<col width="15%">
						<col width="15%">
				      </colgroup>
				      <thead>
				        <tr>
				          <th>ORDER INFO</th>
				          <th>AMOUNT</th>
				          <th>PAYMENT METHOD</th>
				          <th>PAYMENT STATUS</th>
				          <th>ORDER STATUS</th>
				          <th>ACTION</th>
				        </tr>
				      </thead>
				    </table>
				  </div>
				  <div class="tbl-content"  id="ordertab">
				    <table cellpadding="0" cellspacing="0" border="0">
					<colgroup>
						<col width="12%">
						<col width="15%">
						<col width="18%">
						<col width="18%">
						<col width="15%">
						<col width="15%">
				      </colgroup>
				      <tbody>
					  <?php foreach($getorderdetails_history as $orderhistory){ ?>
				        <tr>
				          <td><?php echo $orderhistory['order_reference']; ?></td>
				          <td><i class="fa fa-inr"></i> <?php echo $orderhistory['grand_total']; ?></td>
				          <td><?php echo $orderhistory['payment_method']; ?></td>
				          <td><span class="label <?php if($orderhistory['paymentstatus'] == 'Success'){?>text-success<?php }else if($orderhistory['paymentstatus'] == 'Unsuccess'){?>text-danger<?php }else{?>text-dark <?php }?>"><?php echo $orderhistory['paymentstatus']; ?></span></td>
				          <td><span class="label <?php if($orderhistory['order_status'] == 'Pending'){?>text-danger<?php }else{?>text-success<?php }?>"><?php echo $orderhistory['order_status']; ?></span></td>
				          <td><a class="smallbtn-secodary" href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderhistory['order_reference'];  ?>"><span>view</span></a></td>
				        </tr>
					  <?php } ?>
						
				      </tbody>
				    </table>
				  </div>
				</div>
				</div>
				<?php } else { ?>
				  <h5>No Order History Found.</h5>
				<?php } ?>
			</div>
		</div>
		</div>
		</div>
	</section>

<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>
<script src="<?php echo BASE_URL; ?>static/js/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/price_range_script.js"></script>
</script>
  
  <script type="text/javascript">
	  	function toggleIcon(e) {
	    $(e.target)
	        .prev('.panel-heading')
	        .find(".more-less")
	        .toggleClass('glyphicon-plus glyphicon-minus');
	}
	$('.panel-group').on('hidden.bs.collapse', toggleIcon);
	$('.panel-group').on('shown.bs.collapse', toggleIcon);


	var tallness = $(".sss2").height();
	$(".panel-group").css("min-height" , tallness);


$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
  </script>
  </body>
</html>
