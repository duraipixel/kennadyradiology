<?php 

 //echo "<pre>"; print_r($businesscustomer); exit;
 include ('includes/top.php') ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
					  <li><a href="#">My Account</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section class="pb-50">
		<div  class="container">
			<?php include ('partial/leftsidebar.php') ?>
		<!--
		<aside class="col-md-3 nopad sss1">
		   <div class="productlistaside accounttab">
		   		
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			        <div class="panel panel-default">
			            <div class="panel-heading brt0" role="tab" id="headingOne">
			                <h4 class="panel-title">
			                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			                        <i class="more-less glyphicon glyphicon-minus"></i>
			                        My Profile
			                    </a>
			                </h4>
			            </div>
			            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="javascript:void(0);" class="active">About Me</a></li>
			                     	<li><a href="javascript:void(0);">Shipping Address</a></li>
			                     	<li><a href="javascript:void(0);">Update Kyc</a></li>
			                     </ul>
			            	</div>
			        </div>
			    </div>
			        <div class="panel panel-default">
			            <div class="panel-heading" role="tab" id="headingTwo">
			                <h4 class="panel-title">
			                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			                        <i class="more-less glyphicon glyphicon-minus"></i>
			                        My Orders
			                    </a>
			                </h4>
			            </div>
			            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="javascript:void(0);">Order History</a></li>
			                     	<li><a href="javascript:void(0);">Track Order</a></li>
			                     </ul>
			            	</div>
			            </div>
			        </div>
			       	<div class="panel-heading vwbdr">
			                <h4 class="panel-title ">
			                   <a href="javascript:void(0);" class="active">View Catalogue</a>
			                </h4>
			          </div>
			        <div class="panel panel-default bdrbtm">
			            <div class="panel-heading brt0" role="tab" id="headingThree">
			                <h4 class="panel-title">
			                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			                        <i class="more-less glyphicon glyphicon-minus"></i>
			                        Settings
			                    </a>
			                </h4>
			            </div>
			            <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="javascript:void(0);">Change Password</a></li>
			                     </ul>
			            	</div>
			            </div>
			        </div>

			    </div>
			</div>
		</aside>
        -->
		<div class="col-md-12 nopad sss2">
			<div class="accountinfosec">
				<div class="infotitle">
					<span><h3>View KYC</h3></span>
				</div>
				<form class="radiobtncss" action="">
				
                <div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
				    	<label for="fname">First Name</label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				    	<?php echo $businesscustomer['customer_firstname']; ?>
					</div>
				</div>
				
				<div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
				    	<label for="fname">Last Name</label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				    	<?php echo $businesscustomer['customer_lastname']; ?>
					</div>
				</div>
				
				<div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
				    	<label for="fname">Email </label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				    	<?php echo $businesscustomer['customer_email']; ?>
					</div>
				</div>
				
				
				<div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
				    	<label for="fname">Mobile Number </label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				    	<?php echo $businesscustomer['mobileno']; ?>
					</div>
				</div>
				
				<div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
				    	<label for="fname">GST Document</label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				    	<img style="width:50px" src="<?php echo BASE_URL;?>uploads/gstdocument/<?php echo $businesscustomer['gstdocument'];?>" class="img-responsive" alt="gstdocument">
					</div>
				</div>
				
				<div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
				    	<label for="fname">Business Card</label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				    	<img style="width:50px" src="<?php echo BASE_URL;?>uploads/businesscard/<?php echo $businesscustomer['businesscard'];?>" class="img-responsive" alt="businesscard">
					</div>
				</div>
				
				  
				</form>
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



  </script>
  </body>
</html>
