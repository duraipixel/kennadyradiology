<?php 

//echo "<pre>"; print_r($getbrandtieuplogo); exit;
 include ('includes/top.php') ?>
 <body class="contact-page">
<?php include ('includes/header.php') ?>
	<section class="banner-section">
	<div class="banner-inner">
			<img src="<?php echo BASE_URL;?>static/images/banner/contact.jpg" class="img-responsive" alt="slider1">
	</div>
	</section>
	<section class="breadcrumb-section">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>">Home</a></li>
					  <li><a href="javascript:void(0);">Gift Voucher</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	
		<section class="showrooms-section common-section">
		<div class="container">
		
		
		<div class="col-md-12 col-sm-12 col-xs-12 showroom-single nopad">
			<div class="col-md-12 col-sm-12 col-xs-12  nopad section-title">
				Purchase a Gift Certificate
			</div>
			<div class="content-para">
				<p>This gift certificate will be emailed to the recipient after your order has been paid for.</p>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 nopad giftvoucher-inner">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 contactform-wraper">
					<form action="" id="giftvoucherforms" class="" method="post">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Recipient's Name</label>
									<input type="text" class="form-control" id="name" name="recipientsname" placeholder="" required />
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Recipient's E-mail</label>
								<input type="email" class="form-control" id="email" name="recipientsemail" placeholder="" required />
							</div>
							</div>
						
						</div>
						
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Your Name</label>
								<input type="text" class="form-control" id="mobile" name="yourname" placeholder="" required />
							</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Your E-mail</label>
								<input type="email" class="form-control" id="email" name="youremail" placeholder="" required />
							</div>
							</div>
						</div>
						
						<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Gift Certificate Theme</label>
						<div class="optiongrp-wraper radiobtncss">
							<div class="radio-inline">
								<input type="radio" id="birthday" name="giftcertificatetheme" value="birthday">
								<label for="birthday">Birthday</label>
							</div>
							<div class="radio-inline">
								<input type="radio" id="christmas" name="giftcertificatetheme" value="Christmas">
								<label for="christmas">Christmas</label>
							</div>
							<div class="radio-inline">
								<input type="radio" id="general" name="giftcertificatetheme" value="General">
								<label for="general">General</label>
							</div>
                        </div>
						</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Amount</label>
							<input type="text" class="form-control" id="amount" name="amount" placeholder="" />
						</div>
						</div>
						</div>
						
						<div class="form-group">
							<label>Message</label>
							<textarea class="form-control" id="message" name="message">
							</textarea>
						</div>
						
						
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
									
				<input type="checkbox"  name="nonrefundable" id="non-refundable" value="1">
				<label for="non-refundable"> I understand that gift certificates are non-refundable. </label>
			
							</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group text-right">
								<button type="button" name="button"  onclick="javascript:giftvoucherform('<?php echo BASE_URL; ?>ajax/giftvoucher','giftvoucherforms','<?php echo BASE_URL; ?>giftvoucher');" class="submit-btn">
								<span>Submit</span>
							</button>
							</div>
							</div>
						</div>
						
					</form>
				</div>
			</div>
			</div>
		</div>
		
		
		</div>
	</section>
	
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>

<script>
$(document).ready(function(){
	/**/
});
  function giftvoucherform($urll,$acts,$lodlnk)
   {
		//alert("reach");
		//return false;
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
		//if ($('#'+$acts).valid()) {
			$("button").attr('disabled',false);
			var m_data = new FormData();
			var formdatas = $("#"+$acts).serializeArray();
			$.each( formdatas, function( key, value ) {
				 m_data.append( value.name, value.value);
			});
			
			$.ajax({
				url        : $urll,
				method     : 'POST',
				dataType   : 'json',
				processData:false,  
				contentType: false,     
				data       : m_data,
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					
					  //alert(response);
					if(response.rslt == "1"){
						var sucmsg = "Your Giftvoucher is saved Successfully";
						swal("Success!",sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						//$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="Error";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					
				},
				
			});
		}
	}
  
</script>
</body>
</html>