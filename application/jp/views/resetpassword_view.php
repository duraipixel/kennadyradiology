<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');?>
 <body class="productbg"> 
  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
					  <li><a href="#">Reset Password</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section >
		<div  class="container">
			
		<?php include ('partial/leftsidebar.php') ?>
       <?php if($reset_password){ ?>
		<div class="col-md-9 nopad sss2">
			<div class="accountinfosec">
				<div class="infotitle">
					<span><h3>Reset Password</h3></span>
				</div>
				<form class="" action="" id="resetpassword">
                   <input type="hidden" id="customerid" name="customerid" value="<?php echo $reset_password; ?>" />
				  <div class="form-group row">
				    <div class="col-md-3">
				    	<label for="newpassword">New Password</label>
				    </div>
				    <div class="col-md-6">
				    	<input type="password" class="form-control" id="newpassword" name="newpassword" required='' onkeyup="passwordvalidation();"   onfocus="passwordvalidation();" onblur="passwordvalidation();">
						
						<div class="pswd_info">
							<h4>Password must meet the following requirements:</h4>
							<ul>
								<li id="" class="invalid letter">At least <strong>one letter</strong></li>
								<li id="" class="invalid capital">At least <strong>one capital letter</strong></li>
								<li id="" class="invalid number">At least <strong>one number</strong></li>
								<li id="" class="invalid symbol">At least <strong>one symbol</strong></li>
								<li id="" class="invalid length">Must be between <strong>9 to 20 characters</strong></li>
							</ul>
						</div>
					</div>
				  </div>
				  <div class="form-group row">
				    <div class="col-md-3">
				    	<label for="conpassword">Confirm Password</label>
				    </div>
				    <div class="col-md-6">
				    	<input type="password" class="form-control" id="conpassword" name="conpassword" required='' data-parsley-equalto="#newpassword" data-parsley-error-message="Password and ConfirmPassword should be same"  data-parsley-trigger="change focusout keyup" data-parsley-required>
					</div>
				  </div>
				  <div class="row mt30">
				  	<div class="col-md-3 text-right">
				  	</div>
				  	<div class="col-md-6 text-right">
					
					 <button type="button" name="button"  onclick="javascript:changepassword('<?php echo BASE_URL; ?>ajax/resetpassword','resetpassword','Password','<?php echo BASE_URL; ?>resetpassword');" class="btn btn-success"><span>Save Changes</span></button> 
					 
				  		<!--<button type="submit" class="btn btn-success">Save Changes</button>-->
				  	</div>
				  </div>				  
				</form>
			</div>
		</div>
		<?php } else { ?>
		<div class="col-md-9 nopad sss2">
			<div class="accountinfosec">
		<h4> failed</h4>
		</div>
		   </div>
		<?php } ?>
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

//password validation 

function passwordvalidation()
{
	
	$errflag=0;
	var pswd=$("#newpassword").val();
	
	if(pswd.length >= 9 && pswd.length <= 20 ) {
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
						var sucmsg = "Password has been changed";
						swal("Success!",sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						//$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="Error";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					
					else{
						var othmsg = "oops errors!!!";
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
	}	
  </script>
  </body>
</html>
