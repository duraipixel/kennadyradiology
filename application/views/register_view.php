<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="pad-lg light-gray-bg border-bottom">
   <div class="container">
            <div class="row justify-content-center">
               <div class="col-sm-12 col-md-12 col-lg-7">
                   <form action="" id="registerform" name="registerform">
                       <input type="hidden" class="form-control" id="cus_groupid" name="cus_groupid" value="1" >	
                  <div class="box-shadow">
					 <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">						
							<h1 class="heading1 text-center text-uppercase color-dark-blue"><?php echo $headdisplaylanguage['register'];?></h1>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['firstname'];?><?php //echo $_SESSION['lang_id']; ?></label>
								<div class="input-group">
								<input type="text" class="form-control" id="firstname" name="firstname"  required=''/>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['lastname'];?></label>
								<div class="input-group">
								<input type="text" class="form-control" id="lastname" name="lastname" required='' />
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['emailaddress'];?></label>
								<div class="input-group">
								<input type="email" class="form-control" id="emailid" name="emailid" required='' value='' onBlur="emailchecking('user');">
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $formdisplaylanguage['mobileno'];?></label>
								<div class="input-group">
								<input type="text" class="form-control mobile_num" maxlength="10" id="mobilenumber" name="mobilenumber" required='' />
								</div>
							 </div>
						</div> 
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $logindisplaylanguage['password'];?></label>
								<div class="input-group" id="show_hide_password">
								   <input class="form-control" autocomplete="off" maxlength="15" type="password" id="password" name="password" onKeyUp="passwordvalidation();"   onfocus="passwordvalidation();" onBlur="hide_hints();" required=''>
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								   <div class="pswd_info" id="pswd_info" style="display:none;">
										<?php echo $logindisplaylanguage['passwordhead'];?>
									</div>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label><?php echo $logindisplaylanguage['confirmpwd'];?></label>
								<div class="input-group" id="confirm_password">
								   <input class="form-control" type="password" id="cnpassword" name="cnpassword" data-parsley-equalto="#password" data-parsley-error-message="Password and ConfirmPassword should be same"  data-parsley-trigger="change focusout keyup" data-parsley-required>
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								</div>
							 </div>
						</div>
					</div>
					 
						<div class="row flex-column-reverse flex-md-row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<p><?php echo $logindisplaylanguage['anaccount'];?> <a href="<?php echo BASE_URL;?>login"><?php echo $logindisplaylanguage['loginhere'];?>!</a></p>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 text-right">
								<button type="button" name="button"  class="buy-now-btn1 mt-0 mr-0"  onclick="javascript:registerforms('frmregister','<?php echo BASE_URL; ?>ajax/registerform','registerform','Register','<?php echo BASE_URL; ?>registeractivation');">
								<?php echo $headdisplaylanguage['register'];?>
								</button>
							</div>
						</div>
					 
                  	</div>
				</form>
            </div>
      	</div>
   	</div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<script>

function emailchecking(formname)
{
	
	var emailid='';
  if(formname=='user'){
	 emailid = $("#emailid").val();  
	
  }
  else{
	  emailid = $("#emailids").val();
	 
  }
  if( emailid!=''){
  
		$.ajax({
		url        : '<?php echo BASE_URL; ?>ajax/emailduplicatechecking',
		method     : 'POST',
		dataType   : 'json',   
		data       : 'emails='+emailid,
		success: function(response){
			if(response.rslt == "1"){
				var upmsg = "This email already exits";
				swal("We are Sorry !!",upmsg, "warning");
				$("#emailid").val('');
				$("#emailids").val('');
			}
		},

	});
  }
  
  
  

}	
    function registerforms($frm,$urll,$acts,$stats,$lodlnk)
   	{
		var pswd=$("#password").val();
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid() && passwordvalidation()==0)  {
		
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
					loading();
				},
				success: function(response){
					console.log(response);
					if(response.rslt == "1"){
						var sucmsg = "Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						$("#"+$acts)[0].reset();
						$(location).attr('href', $lodlnk); 	
					} else if(response.rslt == "2"){
						var upmsg="This Email already exists";
						swal("We are Sorry !!",upmsg, "warning");
					} else if(response.rslt == "3"){
						var upmsg="This Mobile number already exists";
						swal("We are Sorry !!",upmsg, "warning");
					} else {
						var othmsg = "oops errors!!!";
						swal("We are Sorry !!", othmsg, "warning");
					}

				},
				error: function(jqXHR, textStatus, errorThrown){
				}
			});
		}
		if(pswd!=''){
			if(pswd.length < 6){
				swal("We are Sorry !!", 'Your Password & Confirm password should be given minimum 6  characters', "warning");
			}
		}
		
	}
	
	function hide_hints()
{
	$('.pswd_info').css("display","none");
}

function passwordvalidation()
{
	
	$errflag=0;
	var pswd=$("#password").val();
		
	if(pswd.length >= 6 && pswd.length <= 15 ) {
		$('#pswd_info .length').removeClass('invalid').addClass('valid');
	} else {
		$errflag=1;
		$('#pswd_info .length').removeClass('valid').addClass('invalid');
	}
	if ( pswd.match(/[a-z]/) ) {
		$('#pswd_info .letter').removeClass('invalid').addClass('valid');
	} 
	else {
			$errflag=1;
		$('#pswd_info .letter').removeClass('valid').addClass('invalid');
	}
	//validate capital letter
	if ( pswd.match(/[A-Z]/) ) {
		$('#pswd_info .capital').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('#pswd_info .capital').removeClass('valid').addClass('invalid');
	} 
	//validate number
	if ( pswd.match(/\d/) ) {
		$('#pswd_info .number').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('#pswd_info .number').removeClass('valid').addClass('invalid');
	}
	
	if(	$errflag==1)
		$('#pswd_info').css("display","block");
	else	
		$('#pswd_info').css("display","none");
	return $errflag;
}

$('.mobile_num').keypress(
        function(event) {
            if (event.keyCode == 46 || event.keyCode == 8) {
                //do nothing
            } else {
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
            }
        }
    );
</script>