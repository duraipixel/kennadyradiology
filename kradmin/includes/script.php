<!--<script src="<?php echo BASE_URL; ?>static/js/flipclock.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/bootstrap-tabcollapse.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/owl.carousel.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/slick.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/select2.full.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/lightbox.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/jquery.imgzoom.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/tempust.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/main.js"></script>



<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/additional-methods.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/bootstrap-filestyle.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/icheck.min.js"></script>

<script src="<?php echo BASE_URL; ?>static/js/jquery.bootstrap.wizard.js"></script>
	<script src="<?php echo BASE_URL; ?>static/js/prettify.js"></script>
	<script src="<?php echo BASE_URL; ?>static/js/bmi_script.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/jquery.base64.js"></script>-->		

<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read more >";
    var lesstext = "Read less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

</script>
	
<script>
function loading() {
	document.getElementById("load").style.display = 'block';
}
function unloading() {
	document.getElementById("load").style.display = 'none';
}

function isNumber(evt) {
	
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

	/*for fixed header shrink*/
	$(window).scroll(function() {
			if ($(document).scrollTop() > 50) {
				$('header').addClass('shrink');
			}
			else {
				$('header').removeClass('shrink');
			}
			$("#prd-filter").fadeOut();

		});
	/*for fixed header shrink end*/
	
		$(document).ready(function(){
		
		$(".toggle-password").click(function() {
 
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

});
		/*for dummy header start*/
	$(document).ready(function(){
		$(".multiselect").select2({
				tags: true
			});

	/*************** End ********************/
	/**/
	$(".register-trigger").click(function () {

		if ($("#login-modal").hasClass('show')) {
				$("#login-modal").removeClass('show');
			}

			if ($("#register-modal").hasClass('show')) {
				$("#register-modal").removeClass('show');
				$("body").removeClass('modal-open');
			} else {
				 $(".overlay-section").animate({ scrollTop: 0 }, "slow");

            $("body").addClass('modal-open');
            $("#register-modal").addClass('show');

        }

	});
	$(".register-close").click(function () {
			if ($("#register-modal").hasClass('show')) {
				$("#register-modal").removeClass('show');
				$("body").removeClass('modal-open');
			} else {
            $("#register-modal").addClass('show');

        }

    });


 

		if ( $(window).width() < 1199 ){
		var slideH = $(".homeslider-section").height();
		//console.log(slideH);
		var slidecapH = slideH-20;
		//console.log(slidecapH);

		$(".slider-caption").css({
                                "min-height": slideH,
                                "max-height": slideH,
                            });
							$(".slider-caption .vertical-outer").css({
                                "min-height": slidecapH,
                                "max-height": slidecapH
                            });
	}

	 if ($(window).width() > 1200){
	 	var slideH = $(".homeslider-section").height();
		//console.log(slideH);
		var slidecapH = slideH - 40;
		//console.log(slidecapH);
		$(".slider-caption").css({
                                "min-height": slidecapH,
                                "max-height": slidecapH
          });
		  $(".slider-caption .vertical-outer").css({
                                "min-height": slidecapH - 30,
                                "max-height": slidecapH - 30
                            });
	}
		$("#ml-id-err-msg").css('display','block');
	});

 
	/*ul accordian*/
		$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}

	var accordion = new Accordion($('#accordion'), false);
});

	/*ul accordian end*/



	</script>

<!-- Login & register script start-->
<script type="text/javascript">
 
 
 function verifyemailOTP(){
	 if ($('#frmemailverify').valid()) {
			$.ajax({
					method     : 'POST',
					dataType   : 'json',
					url: "<?php echo BASE_URL; ?>ajax/checkRegisterOTP",
					data       : $("#frmemailverify").serialize(),
					beforesend:loading(),
					cache: false,
					success: function(response){
						unloading();
						 if(response.rslt == "2"){
							 swal("Failure!", " Authentication code you have entered is incorrect. Please try again", "warning");
							 
						  }
 						 else{
							 
							  swal({
								title: "Email Verification",
								text: "Great ! Your email id is verified. Begin your BeReady journey...",
							//	type: "warning",
								showCancelButton: false,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Ok",
								closeOnConfirm: true
								},
								function () {
									 window.location.href = "<?php echo BASE_URL; ?>personalinfo";
						  		});	
								
								
							 
						 }
					},
					error:function(msg) {
						unloading();swal("Failure!", "Server Busy", "warning");
					}
				});
	 }
 }

function btnsaveRegister()
{ 
   
		if ($('#jvalidate').valid()) {
			 
			$.ajax({
					method     : 'POST',
					dataType   : 'json',
					url: "<?php echo BASE_URL; ?>ajax/signupuser",
					data       : $("#jvalidate").serialize(),
					beforesend:loading(),
					cache: false,
					success: function(response){
						unloading();
						if(response.rslt == '6'){
							swal("Failure!", "Oh ! We already have that email id registered with us.", "warning");
						}						 
						else if(response.rslt == '4'){
							swal("Failure!", "Few required fields are empty. Can you check them out ?", "warning");
						}
						else if(response.rslt == "1"){
							//swal("Success!", "User Register Successfully", "success");
							swal({
								//title: "Welcome. To verify your account, we have sent an One Time Password (OTP) to your email. Please check to enter the same",
								title: "Great ! You're Logged In. Begin your BeReady journey...",
								text: " ",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#66A342",
								confirmButtonText: "Ok",
								closeOnConfirm: true
							},
							function () {
								window.location.href = "<?php echo BASE_URL; ?>personalinfo";
							});
						}
						else{
							swal("Failure!", "Server Busy", "warning");
						}
					},
					error:function(msg) {
						unloading();
						swal("Failure!", "Server Busy", "warning");
					}
				});

		}
		else{
		 
			
			}
}
 
function btnLoginUser()
{
 	 var referrer =  document.referrer;
 	  
 	var notifyval = $('#notifytext').val();
	var productid = 	$('#producttext').val();
		
	if ($('#frmlogin').valid()) {
			
		$.ajax({
				method     : 'POST',
				dataType   : 'json',
				url: "<?php echo BASE_URL; ?>ajax/signinuser",
				data       : $("#frmlogin").serialize(),
				beforesend:loading(),
				cache: false,
				success: function(response){
					unloading();
					if(response.rslt == "1"){								
						var base_url = "<?php echo BASE_URL; ?>";
						if(response.exist_redirect_cnt == "0") {
							var cur_url = base_url + "personalinfo";
						} else {	
							var cur_url = base_url + "reports";
						}
					    window.location.href = cur_url;						
					}
					else{
						swal("Failure!", "Oh ! That's incorrect user name ( or password )", "warning");
					}
				},
				error:function(msg) {
					unloading();swal("Failure!", "Server Busy", "warning");
				}
	  });
	}
	return false;
}

    


		function Saveprofile(){
			if ($('#frmuserProfile').valid()) {
				
				var m_data = new FormData();											
				var formdatas = $("#frmuserProfile").serializeArray();			
		
				$.each( formdatas, function( key, value ) {
					 m_data.append( value.name, value.value);							 
				});
								
				$.ajax({
						method     : 'POST',
						dataType   : 'json',
						url: "<?php echo BASE_URL; ?>ajax/saveuserProfile",
						//data       : m_data,//$("#frmuserProfile").serialize(),
						processData: false,
						contentType: false,
						data       : m_data,
						beforesend:loading(),
						cache: false,
						success: function(response){
						unloading();
						if(response.rslt == '6'){
							swal("Failure!", "Oh ! We already have that email id registered with us.", "warning");
						}
						else if(response.rslt == '5'){
							swal("Failure!", "Oh ! We already have that mobile number registered with us", "warning");
						}
						else if(response.rslt == '4'){
							swal("Failure!", "Server Busy", "warning");
						}
						else if(response.rslt == "1"){
					 
							var titles = "Thank you. let's proceed to assessment";
							/* 
							swal({
								title: titles,
								text: " ",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#66A342",
								confirmButtonText: "Ok",
								closeOnConfirm: true
							},
							function () {
										var base_url = "<?php echo BASE_URL; ?>selfassessment";
										window.location.href = base_url;
 
							});
							*/
							var base_url = "<?php echo BASE_URL; ?>selfassessment";
							window.location.href = base_url;
						}
						else{
							swal("Failure!", "Server Busy", "warning");
						}
					},
						error:function(msg) {
							unloading();swal("Failure!", "Server Busy", "warning");
						}
			  });
			}
			return false;
		}


function environmentsave(){
			if ($('#frmenvironment').valid()) {
				
				var m_data = new FormData();											
				var formdatas = $("#frmenvironment").serializeArray();			
		
				$.each( formdatas, function( key, value ) {
					 m_data.append( value.name, value.value);							 
				});
								
				$.ajax({
						method     : 'POST',
						dataType   : 'json',
						url: "<?php echo BASE_URL; ?>ajax/saveEnvironment",
 						processData: false,
						contentType: false,
						data       : m_data,
						beforesend:loading(),
						cache: false,
						success: function(response){
						unloading();
						 if(response.rslt == "1"){
					 
							var titles = "The details about your environment are captured";
							 
							swal({
								title: titles,
								text: " ",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#66A342",
								confirmButtonText: "Ok",
								closeOnConfirm: true
							},
							function () {
										var base_url = "<?php echo BASE_URL; ?>selfassessment";
										window.location.href = base_url;
 
							});
						}
						
						else if(response.rslt == "2"){
					 
							var titles = "Your details about your environment are updated";
							 
							swal({
								title: titles,
								text: " ",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#66A342",
								confirmButtonText: "Ok",
								closeOnConfirm: true
							},
							function () {
										var base_url = "<?php echo BASE_URL; ?>selfassessment";
										window.location.href = base_url;
 
							});
						}
						
						else{
							swal("Failure!", "Server Busy", "warning");
						}
					},
						error:function(msg) {
							unloading();swal("Failure!", "Server Busy", "warning");
						}
			  });
			}
			return false;
		}

 

	function changePassword(){
		if ($('#frmuserProfilepass').valid()) {
		$.ajax({
				url: "<?php echo BASE_URL; ?>ajax/changePassword", // form action url
				method     : 'POST',
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data       : $("#frmuserProfilepass").serialize(),
				beforeSend: function() {
					loading();
				},
				success: function(response){
					unloading();
					if(response == 1){
						var base_url = "<?php echo BASE_URL; ?>changepassword";
						window.location.href = base_url;
					}else if(response == 2){
						swal("Error!", "Oops ! The passwords doesn't match. Check again !", 'warning');
					}
					else if(response == 3){
						swal("Error!", 'For security reasons, enter a new password that is different from the previous one', 'warning');
					}
				}
			});
	}	return false;
	}

  

	$(window).load(function(){

		$("#pageloader .spinner").delay(0).fadeOut("slow");
		$("#pageloader").delay(700).fadeOut("slow");

	});

	$(document).ready(function(){
		if ($(window).width() > 992){
			$("#pageloader").hide();
			$(".specific-loader #pageloader").show();


	}
	});



/*accordian scroll-top*/
	$(function () {
    $('#accordion').on('shown.bs.collapse', function (e) {
		var offset = $(this).find('.collapse.in').prev('.panel-heading');
        if(offset) {
            $('html,body').animate({
                scrollTop: $(offset).offset().top -80
            }, 500);
        }
    });
});



$(document).ready(function(){

	//$('#mobileno').attr("readonly",true);

	$('#txtpassword').keyup(function(){
			$('#strength_message').html(checkStrength($('#txtpassword').val()))
			if($('#txtpassword').val() == $('#cpassword').val()){
	$('#mobileno').attr("readonly",false);
		}else{
			//$('#mobileno').attr("readonly",true);
		}
	})

	$('#cpassword').keyup(function(){
		if($('#txtpassword').val() == $('#cpassword').val()){
			$('#mobileno').attr("readonly",false);
			$('#cpassword').removeClass('error');
		//	$('#cperror').html('');
		}else{
			$('#cpassword').addClass('error');
		//	$('#mobileno').attr("readonly",true);
			//$('#cperror').html('Please enter the same value again');
		}
	});



function checkStrength(password)
{

//$('#mobileno').attr("readonly",true);

var strength = 0
if (password.length < 7) {

$('#strength_message,#strength_message1').removeClass()
$('#strength_message,#strength_message1').addClass('strength-message-short')
return ' Length should be 8 and must contain at least (0-9,A-Z,a-z,@#$)'  ;
}

if (password.length > 7) strength += 1
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
//if (password.match(/([a-z].*[A-Z])/))  strength += 1
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
 
 
if (strength < 3 )
{
 $('#strength_message,#strength_message1').removeClass()
$('#strength_message,#strength_message1').addClass('strength-message-weak')
return ' Length should be 8 and must contain at least (0-9,A-Z,a-z,@#$)'  ;
}
else if (strength == 3 )
{
 $('#strength_message,#strength_message1').removeClass()
$('#strength_message,#strength_message1').addClass('strength-message-weak')
return ' Length should be 8 and must contain at least (0-9,A-Z,a-z,@#$)'  ;
}
else
{
	if($('#txtpassword').val() == $('#cpassword').val()){
		$('#mobileno').attr("readonly",false);
	}else{
		$('#mobileno').attr("readonly",true);
	}

	$('#strength_message,#strength_message1').removeClass()
	$('#strength_message,#strength_message1').addClass('strength-message-strong')
	return ' ';
}
}
});

$(".search-trig").click(function(){
			$(".common-header").addClass("show-search");
			//$(".searchbox-top").slideDown();
			$(".search-bar").focus();

		});
		$(".searchclose").click(function(){
		$(".common-header").removeClass("show-search");
			//$(".searchbox-top").slideUp();
	});


$('#femail').on('keypress', function() {
    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
    if(!re) {
        $('#femail').addClass('error');
    } else {
        $('#femail').removeClass('error');
    }
})

 
 
function emailidcheck(emailid){
//	var emailid = $.trim(emailid);
//registereventrawlog();
 			$("#referralcode").val('');
			$("#ref-succtick").hide();
			$.ajax({
				type: "POST",
				data : {emailid:emailid},
				dataType : 'json',
				beforesend:loading(),
				url: '<?php echo BASE_URL; ?>ajax/emailalreadyCheck',
				success: function(response){
					if(response.rslt == '1'){
						swal("Alert!", "Oh ! We already have that email id registered with us.", "warning");
						$("#emailid").val('');
					}/*else if(response.rslt == '0'){
						swal("Success!", " OTP has been sent to your registered emailid", "success");
						 
					}*/
					unloading();
				},
			});
		 
}


function forgetpassword($urll,$acts,$lodlnk)	
{
    	var emails = $('#'+$acts).val();
		
		if(emails == '') {
			$('#ml-id-err-msg').css('display','block');
			$('#ml-id-err-msg-disp').html("Oops ! The Email ID is not entered").css('color','#ff0000');
		} else if (!ValidateEmail(emails)) {
            $('#ml-id-err-msg').css('display','block');
			$('#ml-id-err-msg-disp').html("Oops ! That's not a valid Email ID.").css('color','#ff0000');
        }
		

		if ($('#'+$acts).valid()) {
		
			
			
			
			//$("button").attr('disabled',false);
		
			
			$.ajax({
				url        : $urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'emails='+emails,
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					
					  
					if(response.rslt == "1"){
						
						var sucmsg = "A link has been sent to your email address to reset the password.";
						//swal("Success!",sucmsg, "success");
						//$("#"+$acts).val('');
						//$(location).attr('href', $lodlnk);
                        swal({
						title: "Success!",
						text: sucmsg,
						type: "success",
						confirmButtonText: "OK"
						},
						function(isConfirm){
							if (isConfirm) {
								$("#"+$acts).val('');
								$(location).attr('href', $lodlnk);
					    }
					});
                        						
					}
					else if(response.rslt == "2"){
						var upmsg="Invalid email";
						//swal("We are Sorry !!",upmsg, "warning");
						$('#ml-id-err-msg').css('display','block');
						$('#ml-id-err-msg-disp').html("We don't have that Email ID in our database. Check if you have registered with any other ID or register as new user.").css('color','#ff0000');
						
					}


				},

			});
		}
		return false;
}

 function changepassword($urll,$acts,$stats,$lodlnk)
   {
		//alert("reach");
		//return false;

		if ($('#'+$acts).valid()) {
			
			var curnpswd = $("#curnpassword").val();
			var newpassd = $("#newpassword").val();
			var conpssd = $("#conpassword").val();
			
			if(newpassd.length < 4) {
				//swal("We are Sorry !!","New password length should be minimum 4 digits.", "warning");
				$('#chng-pswd-err-msg-disp').html('Your password must be of 4 characters. Eg. 1546 or Ar45').css('color','#ff0000');
				return false;
			}
			/*
			if(curnpswd==newpassd){
				//swal("We are Sorry !!","Password and New Password should not be same", "warning");
				$('#chng-pswd-err-msg-disp').html('Password and New Password should not be same').css('color','#ff0000');
				return false;
			}
			*/
			if(newpassd!=conpssd){
				//swal("We are Sorry !!","New password and Confirm Password should be same.", "warning");
				$('#chng-pswd-err-msg-disp').html("Oops ! The passwords don't match.").css('color','#ff0000');
				return false;
			}
				
			
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

						swal({
							title: "Success!",
							text: sucmsg,
							type: "success",
							confirmButtonText: "OK"
							},
							function(isConfirm){
								if (isConfirm) {
									$("#"+$acts).val('');
									$(location).attr('href', $lodlnk);
							}
						});	
					
					}
					else if(response.rslt == "2"){
						var upmsg="Error";
						//swal("We are Sorry !!","Password and New Password should not be same", "warning");
						$('#chng-pswd-err-msg-disp').html("Oops ! The passwords don't match.").css('color','#ff0000');
					}
					else if(response.rslt == "3"){
						var upmsg="Error";
						//swal("We are Sorry !!","Incorrect password", "warning");
						$('#chng-pswd-err-msg-disp').html('Your current password is wrong. Re-enter').css('color','#ff0000');
					}
					else{
						var othmsg = "oops errors!!!";
						//swal("We are Sorry !!", othmsg, "warning");
						$('#chng-pswd-err-msg-disp').html(othmsg).css('color','#ff0000');
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
 
 function passwordvalidation(conpssd)
 {
	var newpassd = $("#newpassword").val(); 
	if(newpassd!=conpssd){
		swal("We are Sorry !!","Oops ! The passwords don't match.", "warning");
		return false;
	}
 }
 
  function ValidateEmail(email) {
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return expr.test(email);
  }
	
</script>

<script>
	$(document).ready(function() {
	  	$('#rootwizard').bootstrapWizard({'tabClass': 'nav nav-pills'});
		window.prettyPrint && prettyPrint()
	});
	</script>



</body>

</html>