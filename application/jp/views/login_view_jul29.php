<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<?php 

$uname='';
$pass ='';
if(isset($_COOKIE['kiran'])){
	$unamepaswd = $helper->encrpt_decrpt_data($_COOKIE['kiran'],'d');
	$unpwd = explode(':',$unamepaswd);
	$uname = $unpwd[0];
	$pass = $unpwd[1];
}

?>
<section class="pad-lg light-gray-bg border-bottom">
   <div class="container">
      <div class="row justify-content-center align-items-center">
         <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
            <div class="row login-bg1 justify-content-center">
               <div class="col-sm-12 col-md-12 col-lg-5 d-none d-sm-block">
                  <div class="pad-20">
                     <img src="<?php echo img_base;?>/static/images/login-logo.png" alt=""/>
                     <h4 class="text-white mt-4"><?php echo $commondisplaylanguage['aboutkiran'];?></h4>
                     <p class="text-white pt-2">
                        <?php echo $commondisplaylanguage['aboutkirantxt'];?>
                     </p>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-7 login-bg2">
                   <form action="" id="login">
                  <div class="pad-20 login">
                     <h5 class="text-center text-uppercase"><?php echo $headdisplaylanguage['login'];?></h5>
                     <div class="form-group">
                        <label><?php echo $logindisplaylanguage['username'];?></label>
						<div class="input-group">
                        <input type="text" autocomplete="off" class="form-control" id="username" required='' value="<?php echo $uname; ?>">
						</div>
                     </div>
                     <div class="form-group">
                        <label><?php echo $logindisplaylanguage['password'];?></label>
                        
                        <a href="#" class="forgot-password" onClick="javascript:forgetpassword('<?php echo BASE_URL; ?>ajax/forgetpasswords','formgor-email','<?php echo BASE_URL; ?>login');"><?php echo $logindisplaylanguage['frgtpassword'];?></a>
                        <div class="input-group" id="show_hide_password">
                          
                           <input type="password" autocomplete="off" class="form-control" id="password" required='' value="<?php echo $pass; ?>">
                           <div class="input-group-addon">
                              <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="form-check remember-me pb-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                        <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $logindisplaylanguage['rememberme'];?>
                        </label>
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <button type="button" class="add-to-cart-btn1" onClick="javascript:guestcheckout('<?php echo BASE_URL; ?>ajax/guestcheckout','guestcheckout','guestcheckout','<?php echo BASE_URL; ?>checkout');" >
                           <?php echo $logindisplaylanguage['guest'];?>
                           </button>
                           <button type="button" class="buy-now-btn1 pull-right mr-0" onClick="javascript:loginform('<?php echo BASE_URL; ?>ajax/loginuser','login','Loginuser','  <?php  echo $_SESSION['refererurl']!='' ? $_SESSION['refererurl'] : BASE_URL."my-account"; ?>');">
                          <?php echo $headdisplaylanguage['login'];?>
                           </button>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <p class="pt-3"><?php echo $logindisplaylanguage['notmember'];?> <a href="<?php echo BASE_URL;?>register"><?php echo $logindisplaylanguage['registerhere'];?></a></p>
                        </div>
                     </div>
                  </div>
                  </form>
				  <div class="pad-20 for-pass" style="display:none;">
                     <h5 class="text-center"><?php echo $logindisplaylanguage['forgetpwd'];?></h5>
                     <div class="form-group">
                        <label><?php echo $formdisplaylanguage['emailaddress'];?></label>
                        <input type="text" class="form-control" />
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <p><?php echo $logindisplaylanguage['remberpwd'];?> <a href="#" class="show-login"><?php echo $headdisplaylanguage['login'];?>!</a></p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0">
                           <?php echo $commondisplaylanguage['submit'];?>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>


<script>

var input = document.getElementById("password");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("myBtn").click();
  }
});

	function loginform($urll,$acts,$stats,$lodlnk)
    {
		

		//return false;
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
		//if ($('#'+$acts).valid()) {
			var email = $("#username").val();
			var pwd = $("#password").val();
			//alert(email+" "+pwd);
			$("button").attr('disabled',false);
			/*
			var m_data = new FormData();
			var formdatas = $("#"+$acts).serializeArray();
			$.each( formdatas, function( key, value ) {
				 m_data.append( value.name, value.value);
			});
			*/
			
			$.ajax({
				url        : $urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'email='+email+'&pwd='+pwd,
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					
					  
					if(response.rslt == "1"){
						
						$("#"+$acts)[0].reset();
						if(response.wishlist =='wishlist'){
							addtowishlist(response.pid,response.minqty);
							$(location).attr('href', response.url);
						}
						else if(response.type =='Downloadpdfcatalog'){
							$(location).attr('href', response.urldpc);
						}
						else if(response.url !=''){
						  $(location).attr('href', response.url);		
						}	
						else{
						$(location).attr('href', $lodlnk); 
						}						
					}
					else if(response.rslt == "2"){
						var upmsg="Try again or click Forgot password to reset it";
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
	
function forgetpassword($urll,$acts,$lodlnk)	
{
    	$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
		
			
			var emails = $('#'+$acts).val();
			
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
					
					 // alert(response.rslt);
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
						swal("We are Sorry !!",upmsg, "warning");
						
					}


				},

			});
		}

}

//Remember UN & PWD Function 

$("#flexCheckDefault").on('change', function() {
	var uname = $("#username").val();
	var pwd = $("#password").val();
	
  if ($(this).is(':checked')) {
   var val = '1';
   
  } else {
    var val = '0';
  }
	$.ajax({
		url        : '<?php echo BASE_URL; ?>ajax/remembercookie',
		method     : 'POST',
		dataType   : 'json',   
		data       : 'val='+val+'&un='+uname+'&pwd='+pwd,
		beforeSend: function() {
			//alert("responseb");
			//loading();
		},

	});
  
	
});	

$(function(){
	
var val = '0';

	$.ajax({
		url        : '<?php echo BASE_URL; ?>ajax/remembercookie',
		method     : 'POST',
		dataType   : 'json',   
		data       : 'val='+val,
		beforeSend: function() {
			//alert("responseb");
			//loading();
		},

	});
	
});

function guestcheckout($urll,$acts,$stats,$lodlnk)
    {
			$("button").attr('disabled',false);
						
			$.ajax({
				url        : $urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : '',
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){					
					
					if(response.rslt == "1"){						
											
						$(location).attr('href', $lodlnk);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					//alert(textStatus);
				}
			});
		
	}
</script>