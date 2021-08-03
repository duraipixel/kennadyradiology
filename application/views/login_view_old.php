<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<?php
//echo $helper->displaymenu();

$uname='';
$pass ='';
if(isset($_COOKIE['inbase'])){
	$unamepaswd = $helper->encrpt_decrpt_data($_COOKIE['inbase'],'d');
	$unpwd = explode(':',$unamepaswd);
	$uname = $unpwd[0];
	$pass = $unpwd[1];
}

?>
  	
	<section class="login">
		<div class="container-fluid pl-0 pr-0 pt-4">
			<div class="row no-gutters">
				<div class="col">
					<div class="formtitle">
						<h2 class="text-center p-2">Login</h2>
					</div>					
				</div>
			</div>
		</div>
		<div class="container pb-5">	
		<div class="login-section pb-5 pt-4">	
			<div class="row justify-content-md-center">
				<div class="col-sm-12 col-md-10 col-lg-6 col-xl-5">
																	
						<form action="" id="login">
						  <div class="form-group">	
						    <input type="text" autocomplete="off" placeholder="User Name" class="form-control" id="username" required='' value="<?php echo $uname; ?>">
						  </div>
						  <div class="frgtmypass text-right">
							    <label><span><a href="#" class="" data-toggle="modal" data-target=".forgot-modal">Forgot Password?</a></span></label>
							  </div>
						  <div class="form-group">	
						    <input type="password" autocomplete="off" placeholder="password" class="form-control" id="password" required='' value="<?php echo $pass; ?>">
							
						  </div>
						  
						<!--  <button type="submit" class="btn btn-default">Login</button>-->
							<div class="row">
						  	<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="frgtmypass remembrme">
							    <label><span><a href="javascript:void(0);"><input type="checkbox" id="remember" >
    							 	<label for="remember">Remember Me</label></a></span></label>
							  </div>
						  </div>
						  <div class="col-lg-8 col-md-8 col-sm-12 text-right">
						  <input id="myBtn" type="button" class="common-btn brs mr-3" onClick="javascript:guestcheckout('<?php echo BASE_URL; ?>ajax/guestcheckout','guestcheckout','guestcheckout','<?php echo BASE_URL; ?>checkout');"  value="Guest Checkout">
						   <input id="myBtn" type="button" class="common-btn  white-btn" onClick="javascript:loginform('<?php echo BASE_URL; ?>ajax/loginuser','login','Loginuser','  <?php  echo $_SESSION['refererurl']!='' ? $_SESSION['refererurl'] : BASE_URL."my-account"; ?>');"  value="Login">
						  </div>
						  </div>
						  <div class="row">
						  	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">						  		
						  <div class="resgister pull-left">
						    <label><span>Not a Member?</span> &nbsp; <a href="<?php echo BASE_URL; ?>register">Register Here!</a></label>
						  </div>
							  
						  	</div>
						  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

<div class="modal fade forgot-modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
			<form>
					<input type="email" class="form-control" id="formgor-email" placeholder="Email" required=''/>
			</form>
		 </div>
         
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="common-btn mr-3" data-dismiss="modal">Close</button>
        <button type="button" class="common-btn white-btn m-0" onClick="javascript:forgetpassword('<?php echo BASE_URL; ?>ajax/forgetpasswords','formgor-email','<?php echo BASE_URL; ?>login');" >Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>

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

$("#remember").on('change', function() {
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

  </body>
</html>
