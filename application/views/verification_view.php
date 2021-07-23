<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="pad-lg light-gray-bg border-bottom">
   <div class="container">
            <div class="row justify-content-center">
               <div class="col-sm-12 col-md-12 col-lg-7">
                   
                  <div class="box-shadow">
					 <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">						
							<?php if($Register_activation>0){ ?>
							<h4>Congratulations! Your account has been activated.</h4>
							<a class="buy-now-btn1 pull-right mr-0" href="<?php echo BASE_URL;?>login" >Login</a>
						<?php } else{ ?>
						  <h4>Your account is already activated.</h4>
						<?php } ?>
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
</script>