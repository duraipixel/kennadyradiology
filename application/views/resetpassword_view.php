<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="pad-lg light-gray-bg border-bottom">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                <div class="row login-bg1 justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-5 d-none d-sm-block">
                        <div class="pad-20">
                            <img src="<?php echo img_base;?>/static/images/login-logo.png" alt="" />
                            <h4 class="text-white mt-4"><?php echo $commondisplaylanguage['aboutkiran'];?></h4>
                            <p class="text-white pt-2">
                                <?php echo $commondisplaylanguage['aboutkirantxt'];?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7 login-bg2">
                        <form id="resetpassword">
							<input type="hidden" id="customerid" name="customerid" value="<?php echo $reset_password; ?>" />
                            <div class="pad-20 login mt-5">
                                <h1 class="heading1 text-center text-uppercase color-dark-blue"> Reset Password </h1>

                                <div class="form-group">
                                    <label>New Password</label>
                                   
                                    <div class="input-group" id="show_hide_password">
                                        <!-- <input type="password" name="newpassword" autocomplete="off" class="form-control" id="newpassword"
                                            required='' value="" onkeyup="passwordvalidation();"   onfocus="passwordvalidation();" onblur="passwordvalidation();"> -->
										<input class="form-control" autocomplete="off" maxlength="15" type="password" id="password" name="newpassword" onKeyUp="passwordvalidation();"   onfocus="passwordvalidation();" onBlur="hide_hints();" required=''>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
										<div class="pswd_info" id="pswd_info" style="display:none;">
											<?php echo $logindisplaylanguage['passwordhead'];?>
										</div>
                                    </div>
                                </div>
                                <div class="form-group">
								<label>Confirm Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" name="conpassword" data-parsley-equalto="#password" autocomplete="off" class="form-control" id="conpassword"
                                            required='' value="<?php echo $pass; ?>">
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
										<button type="button" name="button"  onclick="javascript:changepassword('<?php echo BASE_URL; ?>ajax/resetpassword','resetpassword','Password','<?php echo BASE_URL; ?>resetpassword');" class="buy-now-btn1 pull-right mr-0">
											<span>Save Changes</span>
										</button>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
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
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<script>
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

	function changepassword($urll,$acts,$stats,$lodlnk)
   	{

		$('#'+$acts).parsley().validate();
		if ( $('#'+$acts).parsley().isValid() && passwordvalidation()==0 )  {
			
			$("button").attr('disabled',false);
			var m_data 		= new FormData();
			var formdatas 	= $("#"+$acts).serializeArray();
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
					unloading();
					if(response.rslt == "1"){
						var sucmsg = "Password has been changed";
						swal("Success!",sucmsg, "success");
						window.location.href="<?php echo BASE_URL; ?>login"
						
					} else if(response.rslt == "2"){
						var upmsg="Error";
						swal("We are Sorry !!",upmsg, "warning");
						
					} else{
						var othmsg = "oops errors!!!";
						swal("We are Sorry !!", othmsg, "warning");
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
				}
			});
		}
	}	
</script>