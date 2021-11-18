<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');?>
 <body class="productbg">
 
	<section class="login">
		 
		<div class="container">	
		<div class="login-section pt-5 pb-5">	
			<div class="row">
				<div class="col-md-12 col-md-offset-3 text-center">
						<div class="formtitle">
							<h3><p class="text-success">
							<?php echo $msgdisplaylanguage['registersuccess'];?>
							</p> </h3>
							<p><?php echo $msgdisplaylanguage['registersuccess_sub'];?>
							 
</p>
						</div>											
						
						
						
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>

<script type="text/javascript">

//password validation 

function passwordvalidation()
{
	
	$errflag=0;
	var pswdtab1=$("#password").val();
	var pswdtab2=$("#passwords").val();
	 if(pswdtab1!='')
	 {
		 pswd=pswdtab1;
	 }
	 else{
		 pswd=pswdtab2; 
	 }
	
	
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


  function registerforms($frm,$urll,$acts,$stats,$lodlnk)
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
						var sucmsg = "Successfully";
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
  </body>
</html>
