<?php  
//echo $getsubscribedetails['cnt']; exit;
//echo "<pre>";
//print_r($getmyaccountdetails); exit;

include ('includes/top.php') ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
	<section class="myaccount pb-50">
		<div  class="container">
		<div  class="row">
			<?php include ('partial/leftsidebar.php') ?>
		<!--
		<aside class="col-md-3 nopad sss1">
		   <div class="productlistaside accounttab">
		   		
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			        <div class="panel panel-default">
			            <div class="panel-heading brt0" role="tab" id="headingOne">
			                <h4 class="panel-title">
			                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			                        <i class="more-less glyphicon glyphicon-minus"></i>
			                        My Profile
			                    </a>
			                </h4>
			            </div>
			            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="javascript:void(0);" class="active">About Me</a></li>
			                     	<li><a href="javascript:void(0);">Manage Address</a></li>
			                     	<li><a href="javascript:void(0);">Update Kyc</a></li>
			                     </ul>
			            	</div>
			        </div>
			    </div>
			        <div class="panel panel-default">
			            <div class="panel-heading" role="tab" id="headingTwo">
			                <h4 class="panel-title">
			                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			                        <i class="more-less glyphicon glyphicon-minus"></i>
			                        My Orders
			                    </a>
			                </h4>
			            </div>
			            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="javascript:void(0);">Order History</a></li>
			                     	<li><a href="javascript:void(0);">Track Order</a></li>
			                     </ul>
			            	</div>
			            </div>
			        </div>
			       	<div class="panel-heading vwbdr">
			                <h4 class="panel-title ">
			                   <a href="javascript:void(0);" class="active">View Catalogue</a>
			                </h4>
			          </div>
			        <div class="panel panel-default bdrbtm">
			            <div class="panel-heading brt0" role="tab" id="headingThree">
			                <h4 class="panel-title">
			                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			                        <i class="more-less glyphicon glyphicon-minus"></i>
			                        Settings
			                    </a>
			                </h4>
			            </div>
			            <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="javascript:void(0);">Change Password</a></li>
			                     </ul>
			            	</div>
			            </div>
			        </div>

			    </div>
			</div>
		</aside>
         -->
		<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 nopad sss2">
			<div class="accountinfosec">
				<div class="infotitle">
					<span><h3>Personal Information</h3></span><!--<span><a href="javascript:void(0);" class="edit">Edit</a></span>-->
				</div>
				<form class="editform" action="" id="editmyaccount">
				  <div class="row">
				    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				    	<input type="text" class="form-control required" id="firstname" placeholder="First Name" name="firstname" value="<?php echo $getmyaccountdetails[0]['customer_firstname'];?>" required="">
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				    	<input placeholder="Last Name"  type="text" class="form-control required" id="lastname" name="lastname" value="<?php echo $getmyaccountdetails[0]['customer_lastname'];?>"  >
					</div>
				  </div>
					<div class="row">
				    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="form-gender mt-3 mb-3">
						<h3>Your Gender</h3>
				    	<div class="custom-control custom-radio">
							<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
							<label class="custom-control-label" for="customRadio1">Male</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
							<label class="custom-control-label" for="customRadio2">Female</label>
						</div>
						</div>
					</div>
				  </div>
				  <div class="row mt-4">
				    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="infotitle">
							<span><h3>Email Address</h3></span><!--<span><a href="#">Edit</a></span>-->
						</div>
				    	<input type="email" placeholder="Email Address" class="form-control required" id="emailid" name="emailid" value="<?php echo $getmyaccountdetails[0]['customer_email'];?>" disabled readonly>
					</div>
				  </div>

				  <div class="row mt-4">
				    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="infotitle">
							<span><h3>Mobile Number</h3></span><!--<span><a href="#">Edit</a></span>-->
						</div>
				    	<input type="text" placeholder="Mobile Number" class="form-control numericvalidate required" id="mobilenumber" name="mobilenumber" value="<?php echo $getmyaccountdetails[0]['mobileno'];?>" >
					</div>
				  </div>
                 <!--
				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="dob">Date of Birth</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="dob" value="-" disabled readonly>
					</div>
				  </div>


				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="gender">Gender</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="gender" value="-" disabled readonly>
					</div>
				  </div>
				  -->
				<!--  <div class="form-group row">
				    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
				    	<label for="gender">Subscribe</label>
				    </div>
				    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					     <div class="frgtmypass subscribe-wraper">
				    	
						 <input type="checkbox" id="remember" class="subscribe" disabled <?php echo$getsubscribedetails['cnt']=='1' ? 'checked' : ''; ?> value="1" name="subscribe" >
    					<label for="remember" class="subscribe">
						
						</label>
						 </div>
						
					</div>
				  </div> -->
				 
                 <!--

				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="address">Address</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="address" value="No.89, Pillayar Kovil St." disabled>
					</div>
				  </div>

				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="city">City</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="city" value="Chennai" disabled>
					</div>
				  </div>

				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="zipcode">Zip Code</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="zipcode" value="600103" disabled>
					</div>
				  </div>


				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="state">State</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="state" value="Tamil Nadu" disabled>
					</div>
				  </div>

				  <div class="form-group row">
				    <div class="col-md-2">
				    	<label for="country">Country</label>
				    </div>
				    <div class="col-md-1 hidden-xs hidden-sm colanspan">
				    	<span class="colan">:</span>
				    </div>
				    <div class="col-md-6">
				    	<input type="text" class="form-control" id="country" value="India" disabled>
					</div>
				  </div>
				  -->
				  <div class="row btns">
				  	<div class="col-lg-6 col-md-6 col-sm-6">
				  		<button type="submit" class="common-btn white-btn btn-block btn-lg">Cancel</button>
				  	</div>
				  	<div class="col-lg-6 col-md-6 col-sm-6">
				  		<!--<button type="submit" class="btn btn-success" onclick="myaccountupdate();">Save Changes</button>-->
					<button type="button" name="button"  onclick="javascript:myaccountupdate('frmmyaccount','<?php echo BASE_URL; ?>ajax/updatemyaccount','editmyaccount','Myaccount','<?php echo BASE_URL; ?>my-account');" class="common-btn btn-block btn-lg"><span>Save Changes</span></button> 
				  	</div>
				  </div>				  
				</form>
			</div>
		</div>
		</div>
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
  </body>
</html>
