<?php  include ('includes/top.php') ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
	<section class="myorders">
		<div  class="container">
			<div class="row">
		<?php include ('partial/leftsidebar.php') ?>

		<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 nopad sss2">
			<div class="accountinfosec">
				<div class="infotitle pb-3">
					<span><h3>Change Password</h3></span>
				</div>
				<form class="" action="" id="changepasswordform">
				  <div class="row">
				    <div class="col-lg-6 col-md-12">
				    	<input placeholder="Current Password" type="password" class="form-control" id="curpassword" name="curpassword" required=''>
					</div>
				  </div>
				  <div class="row">
				    <div class="col-lg-6 col-md-12">
				    	<input placeholder="New Password" type="password" maxlength="15" class="form-control" id="newpassword" name="newpassword" required='' onkeyup="passwordvalidation();"   onfocus="passwordvalidation();" onblur="passwordvalidation();"  data-toggle="popover" data-trigger="focus" title="Password must meet the following requirements:" data-content="" />
						
						<div class="pswd_info" style="display: none;">
							<h4>Password must meet the following requirements:</h4>
							<ul>
								<li id="" class="invalid letter">At least <strong>one letter</strong></li>
								<li id="" class="invalid capital">At least <strong>one capital letter</strong></li>
								<li id="" class="invalid number">At least <strong>one number</strong></li>
								<li id="" class="invalid symbol">At least <strong>one symbol</strong></li>
								<li id="" class="invalid length">Must be between <strong>6 to 15 characters</strong></li>
							</ul>
						</div>
					</div>
				  </div>
				  <div class="row">
				    <div class="col-lg-6 col-md-12">
				    	<input placeholder="Confirm Password" type="password" class="form-control" id="conpassword" name="conpassword" required='' data-parsley-equalto="#newpassword" data-parsley-error-message="Password and ConfirmPassword should be same"  data-parsley-trigger="change focusout keyup" data-parsley-required>
					</div>
				  </div>
				  <div class="row">				  	
				  	<div class="col-lg-6 col-md-12">
					
					 <button type="button" name="button"  onclick="javascript:changepassword('<?php echo BASE_URL; ?>ajax/changepasswords','changepasswordform','Password','<?php echo BASE_URL; ?>change-password');" class="common-btn btn-block btn-lg"><span>Save Changes</span></button> 
					 
				  		<!--<button type="submit" class="btn btn-success">Save Changes</button>-->
				  	</div>
				  </div>				  
				</form>
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




//password validation 

function passwordvalidation()
{
	
	$errflag=0;
	var pswd=$("#newpassword").val();
	
	if(pswd.length >= 6 && pswd.length <= 15 ) {
		$('.length').removeClass('invalid').addClass('valid');
	}	
	else {
		$errflag=1;
		$('.length').removeClass('valid').addClass('invalid');
	}
	if ( pswd.match(/[a-z]/) ) {
		$('.letter').removeClass('invalid').addClass('valid');
	} 
	else {
			$errflag=1;
		$('.letter').removeClass('valid').addClass('invalid');
	}

	//validate capital letter
	if ( pswd.match(/[A-Z]/) ) {
		$('.capital').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('.capital').removeClass('valid').addClass('invalid');
	}

	//validate number
	if ( pswd.match(/\d/) ) {
		$('.number').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('.number').removeClass('valid').addClass('invalid');
	}
	if (pswd.match(/[-!$%#^&@*()_+|~=`{}\[\]:";'<>?,.|\/]/)){
		$('.symbol').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('.symbol').removeClass('valid').addClass('invalid');
	}
	
	if(	$errflag==1)
		$('.pswd_info').css("display","block");
	else	
		$('.pswd_info').css("display","none");
	return $errflag;
}


   function changepassword($urll,$acts,$stats,$lodlnk)
   {
		//alert("reach");
		//return false;
		var pswd=$("#newpassword").val();
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid() && passwordvalidation()==0)  {
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
						var sucmsg = "Password has been changed";
						swal("Success!",sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						//$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="Your current password is wrong";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					
					else{
						var othmsg = "Old password & new password should not same";
						swal("We are Sorry !!", othmsg, "warning");
					}

					//unloading();
					//$("button").attr('disabled',false);
					

				},
				error: function(jqXHR, textStatus, errorThrown){
					//alert(textStatus);
				}
			});
		}
		if(pswd!=''){
			if(pswd.length < 6){
				swal("We are Sorry !!", 'Your New Password & Confirm password should be given minimum 6 characters', "warning");
			}
		}
	}	
	
  </script>
  <script>
	$('#password').popover('show');
  </script>
  </body>
</html>
