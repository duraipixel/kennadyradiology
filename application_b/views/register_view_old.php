<?php 
  // print_r($getcorporatecustomer); exit;
 include ('includes/top.php') ?>
 <body class="productbg">
<?php include ('includes/header.php') ?>
  	
	<section class="login">
	<div class="container-fluid pl-0 pr-0 pt-5">
			<div class="row no-gutters">
				<div class="col">
					<div class="formtitle">
						<h2 class="text-center p-2">Register</h2>
					</div>					
				</div>
			</div>
		</div>
		<div class="container">	
		<div class="login-section">	
			<div class="row justify-content-md-center">
				<div class="col-sm-12 col-md-12 col-lg-8">											
						
						<div id="registertab">
							<div class="tab" role="tabpanel">
 
			                <div class="tab-content">
			                    <div role="tabpanel" class="tab-pane in active" id="Section1">
			                        
			                        <form action="" id="registerform">
									  <div class="row">
									  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									  	<div class="form-group">
                                        <input type="hidden" class="form-control" id="cus_groupid" name="cus_groupid" value="1" >										
									    <input type="text" class="form-control" placeholder="First Name" id="firstname" name="firstname" required=''>
									  </div>
									  </div>
									  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									  	<div class="form-group">										
									    	<input type="text" class="form-control" placeholder="Last Name" id="lastname" name="lastname" required='' >
									  	</div>
									  </div>
									  </div>
									  <div class="row">  										
									  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									 
									  	<div class="form-group">
											<div class="input-group">
												<div class="input-group-prepend">
												<div class="select-style">
													<select name="order">
														<option value="a" selected>+ 91</option>
														<option value="b">+ 1</option>
														<option value="b">+ 11</option>
														<option value="b">+ 22</option>
														<option value="b">+ 33</option>
														<option value="b">+ 44</option>
													</select>
												</div>
											</div>
											  <input type="tel" class="form-control phone numericvalidate" id="mobilenumber" placeholder="Phone" required='' aria-label="Text input with dropdown button" />
											  <div class="clearfix"></div>
											</div>
									  	</div>
									  </div>
									  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									  	<div class="form-group">										
										    <input type="email" class="form-control" placeholder="Email" id="emailid" name="emailid" required='' value='' onBlur="emailchecking('user');">
										 </div>									  	
									  </div>
									  </div>
									  <div class="row">
									  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									  	<div class="form-group">									
										    <input type="password" placeholder="Password" maxlength="15" class="form-control" id="password" name="password" onKeyUp="passwordvalidation();" data-toggle="popover" data-trigger="focus" title="Password must meet the following requirements:" data-content="" onFocus="passwordvalidation();" onBlur="hide_hints();" required=''>
											
											<div class="pswd_info" id="pswd_info" style="display: none;">
												<h4>Password must meet the following requirements:</h4>
												<ul>
													
													<li id="" class="invalid letter">At least <strong>one lower case character</strong></li>
													<li id="" class="invalid capital">At least <strong>one upper case character</strong></li>
													<li id="" class="invalid number">At least <strong>one numeric letter</strong></li>
												<!--	<li id="" class="invalid symbol">At least <strong>one special character</strong></li> -->
													<li id="" class="invalid length">Must be between <strong>6 to 15 characters</strong></li>
												
												</ul>
											</div>
										 </div>
									  </div>
									 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									 	<div class="form-group">		
									    	<input type="password" placeholder="Confirm Password" class="form-control" id="cnpassword" name="cnpassword" data-parsley-equalto="#password" data-parsley-error-message="Password and ConfirmPassword should be same"  data-parsley-trigger="change focusout keyup" data-parsley-required >
									  	</div>	
                                         										
									 </div>
									 </div>
									 <div class="row">
									 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<button type="button" name="button" onClick="javascript:registerforms('frmregister','<?php echo BASE_URL; ?>ajax/registerform','registerform','Register','<?php echo BASE_URL; ?>registeractivation');" class="common-btn btn-block btn-lg"><span>Register</span></button> 
									  
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<a class="common-btn white-btn btn-block btn-lg brs" href="<?php echo BASE_URL; ?>login">Login</a>										
										
									</div>
									</div>
									</form>

			                    </div>
 
			                </div>
			            </div>
						</div>
						
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
        <h4 class="modal-title" id="gridSystemModalLabel">Resend Mail</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
			<form>
					<input type="email" class="form-control" id="resendmail" placeholder="Email" required=''/>
			</form>
		 </div>
         
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn buynow-btn" onClick="javascript:resendmail('<?php echo BASE_URL; ?>ajax/resendmailfunction','resendmail','<?php echo BASE_URL; ?>register');" >Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>

<script type="text/javascript">

//password validation 

function passwordvalidation()
{
	
	$errflag=0;
	var pswd=$("#password").val();
		
	if(pswd.length >= 6 && pswd.length <= 15 ) {
		$('#pswd_info .length').removeClass('invalid').addClass('valid');
	}	
	else {
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
	/*if (pswd.match(/[-!$%#^&@*()_+|~=`{}\[\]:";'<>?,.|\/]/)){
		$('#pswd_info .symbol').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('#pswd_info .symbol').removeClass('valid').addClass('invalid');
	} */
	
	if(	$errflag==1)
		$('#pswd_info').css("display","block");
	else	
		$('#pswd_info').css("display","none");
	return $errflag;
}


function passwordvalidation1()
{
	
	$errflag=0;
	
	var pswd=$("#passwords").val();	
	
	if(pswd.length >= 6 && pswd.length <= 15 ) {
		$('#pswd_info1 .length').removeClass('invalid').addClass('valid');
	}	
	else {
		$errflag=1;
		$('#pswd_info1 .length').removeClass('valid').addClass('invalid');
	}
	if ( pswd.match(/[a-z]/) ) {
		$('#pswd_info1 .letter').removeClass('invalid').addClass('valid');
	} 
	else {
			$errflag=1;
		$('#pswd_info1 .letter').removeClass('valid').addClass('invalid');
	}

	//validate capital letter
	if ( pswd.match(/[A-Z]/) ) {
		$('#pswd_info1 .capital').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('#pswd_info1 .capital').removeClass('valid').addClass('invalid');
	}

	//validate number
	if ( pswd.match(/\d/) ) {
		$('#pswd_info1 .number').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('#pswd_info1 .number').removeClass('valid').addClass('invalid');
	}
	/*if (pswd.match(/[-!$%#^&@*()_+|~=`{}\[\]:";'<>?,.|\/]/)){
		$('#pswd_info1 .symbol').removeClass('invalid').addClass('valid');
	} else {
			$errflag=1;
		$('#pswd_info1 .symbol').removeClass('valid').addClass('invalid');
	} */
	
	if(	$errflag==1)
		$('#pswd_info1').css("display","block");
	else	
		$('#pswd_info1').css("display","none");
	return $errflag;
}

function hide_hints()
{
	$('.pswd_info').css("display","none");
}

function hide_hints1()
{
	$('.pswd_info1').css("display","none");
}

  function registerforms($frm,$urll,$acts,$stats,$lodlnk)
   {
		//alert("reach");
		//return false;
		var pswd=$("#password").val();
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
						var sucmsg = "Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="This email already exits";
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
		if(pswd!=''){
			if(pswd.length < 6){
				swal("We are Sorry !!", 'Your Password & Confirm password should be given minimum 6  characters', "warning");
			}
		}
		
	}
	
	


  function registerforms1($frm,$urll,$acts,$stats,$lodlnk)
   {
		//alert("reach");
		//return false;
		var pswd=$("#passwords").val();
		$('#'+$acts).parsley().validate();
		
		if ($('#'+$acts).parsley().isValid() && passwordvalidation1()==0)  {
		//if ($('#'+$acts).valid()) {
			$("button").attr('disabled',false);
			var m_data = new FormData();
			var formdatas = $("#"+$acts).serializeArray();
			$.each( formdatas, function( key, value ) {
				 m_data.append( value.name, value.value);
			});
			
			m_data.append( 'gstdocument', $('input[name=gstdocument]')[0].files[0]);
			m_data.append( 'businesscard', $('input[name=businesscard]')[0].files[0]);
			
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
					//unloading();
					  //alert(response);
					if(response.rslt == "1"){
						var sucmsg = "Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="This email already exits";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					else if(response.rslt == "3"){
						var upmsg="Please choose allowed extension only";
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
		if(pswd!=''){
			if(pswd.length <6){
				swal("We are Sorry !!", 'Your Password & Confirm password should be given minimum 6 characters', "warning");
			}
		}
		
	}	
	
	
function resendmail($urll,$acts,$lodlnk)	
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
						
						var sucmsg = "Link has been sent to your mail";
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
							
								$("#"+$acts).val('');
								$(location).attr('href', $lodlnk);
							
					    });						
					}
					else if(response.rslt == "2"){
						var upmsg="Your account is already activated.";
						swal("We are Sorry !!",upmsg, "warning");
						
					}


				},

			});
		}

}

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
		beforeSend: function() {
			//alert("responseb");
			//loading();
		},
		success: function(response){
			
			 // alert(response.rslt);
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



	$(window).load(function(){
		
		if(window.location.hash) {
		var hash = window.location.hash;
			//console.log(hash);
			setTimeout(function(){
			//alert(hash);
			$("a[href="+ hash +"]").trigger("click");
			}, 50);
	}   
		});
		
		
	

$("a[href*=#]").click(function(e) {
    //e.preventDefault();
    var str= $(this).attr("href");
	 var hashVal = str.split("#")[1];
    	$('html,body').animate({scrollTop: $("#"+hashVal).offset().top - 120
   },'slow');
});

$('#password').popover('show');

</script>
  </body>
</html>
