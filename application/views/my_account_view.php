<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
				<h5 class="pb-4 text-uppercase"><?php echo $headdisplaylanguage['myaccount'];?></h5>
			</div>
			<?php include ('includes/my-account-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<h3 class="text-uppercase"><?php echo $headdisplaylanguage['mydetail'];?></h3>
					<h4 class="text-dark"><?php echo $formdisplaylanguage['personalinfo'];?></h4>
					<form class="editform" action="" id="editmyaccount">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['firstname'];?></label>
								
								<input type="text" class="form-control required" id="firstname" placeholder="<?php echo $formdisplaylanguage['firstname'];?>" name="firstname" value="<?php echo $getmyaccountdetails[0]['customer_firstname'];?>" required="">
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['lastname'];?></label>
								<input placeholder="<?php echo $formdisplaylanguage['lastname'];?>"  type="text" class="form-control required" id="lastname" name="lastname" value="<?php echo $getmyaccountdetails[0]['customer_lastname'];?>"  >
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['emailaddress'];?></label>
								
								<input type="email" placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>" class="form-control required" id="emailid" name="emailid" value="<?php echo $getmyaccountdetails[0]['customer_email'];?>" disabled readonly>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['mobileno'];?></label>
								
								<input type="text" placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" class="form-control numericvalidate required" id="mobilenumber" name="mobilenumber" value="<?php echo $getmyaccountdetails[0]['mobileno'];?>" >
							 </div>
						</div>	
						<div class="col-sm-12 col-md-12 col-lg-12 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0" onclick="javascript:myaccountupdate('frmmyaccount','<?php echo BASE_URL; ?>ajax/updatemyaccount','editmyaccount','Myaccount','<?php echo BASE_URL; ?>my-account');">
                          <?php echo $commondisplaylanguage['update'];?>
                           </button>
                        </div>
					 </div>
					 </form>
					 <h4 class="text-dark mt-3"><?php echo $commondisplaylanguage['changepwd'];?></h4>
					 <form class="" action="" id="changepasswordform">
					 <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $myaccountdisplaylanguage['oldpwd'];?></label>
								<div class="input-group" id="show_hide_password">
								   <input type="password" class="form-control" id="curpassword" name="curpassword" required=''>
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $myaccountdisplaylanguage['newpwd'];?></label>
								<div class="input-group" id="new_password">
								   <input type="password" maxlength="15" class="form-control" id="newpassword" name="newpassword" required='' onKeyUp="passwordvalidation();"   onfocus="passwordvalidation();" onBlur="passwordvalidation();"  data-toggle="popover" data-trigger="focus" title="Password must meet the following requirements:" data-content="" />
								   
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								   <div class="pswd_info" style="display: none;">
								   <?php echo $logindisplaylanguage['passwordhead'];?>
							<!--<h4>Password must meet the following requirements:</h4>
							<ul>
								<li id="" class="invalid letter">At least <strong>one letter</strong></li>
								<li id="" class="invalid capital">At least <strong>one capital letter</strong></li>
								<li id="" class="invalid number">At least <strong>one number</strong></li>
								<li id="" class="invalid symbol">At least <strong>one symbol</strong></li>
								<li id="" class="invalid length">Must be between <strong>6 to 15 characters</strong></li>
							</ul>-->
						</div>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $myaccountdisplaylanguage['confirmpwd'];?></label>
								<div class="input-group" id="confirm_password">
								   
								   <input type="password" class="form-control" id="conpassword" name="conpassword" required='' data-parsley-equalto="#newpassword" data-parsley-error-message="Password and ConfirmPassword should be same"  data-parsley-trigger="change focusout keyup" data-parsley-required>
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0"  onclick="javascript:changepassword('<?php echo BASE_URL; ?>ajax/changepasswords','changepasswordform','Password','<?php echo BASE_URL; ?>change-password');">
                           <?php echo $commondisplaylanguage['update'];?>
                           </button>
                        </div>
					 </div>
					 </form>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>

  <script type="text/javascript">
  $('#password').popover('show');
  
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
	
	  	function toggleIcon(e) {
	    $(e.target)
	        .prev('.panel-heading')
	        .find(".more-less")
	        .toggleClass('glyphicon-plus glyphicon-minus');
	}
	$('.panel-group').on('hidden.bs.collapse', toggleIcon);
	$('.panel-group').on('shown.bs.collapse', toggleIcon);


	


	
	

	$(".edit").click(function(){
	  $("form").removeClass("editform");
	  $("input").removeAttr("disabled");
	  $(".colanspan").css("visibility", "hidden");
	   $(".btns").css("display", "block");
	   
	   var tallness = $(".sss2").height();
		var tallnessLeft = $(".sss1 .panel-group").height();
			
	   if(tallnessLeft < tallness){
		   var tallnessLeft = $(".sss1 .panel-group").height() + 2;
					$(".panel-group").css("min-height" , tallness);
				}
	});
	
	
	
	
	function myaccountupdate($frm,$urll,$acts,$stats,$lodlnk)
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
						var sucmsg = "Updateded Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="Error";
						swal("We are Sorry !!", $stats +' '+ upmsg, "warning");
						
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