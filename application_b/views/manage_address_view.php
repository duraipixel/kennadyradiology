<?php  
//echo "<pre>"; print_r($getmanageaddress_autofill); exit;
include ('includes/top.php') ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
	<section class="myorders">
		<div  class="container">
		<div class="row">
		<?php include ('partial/leftsidebar.php') ?>
		
		<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 nopad sss2">
			<div class="accountinfosec">
				<div class="row">
			
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<div class="ovrflwclss scrlcnt">
				 <div id="addressbind"> </div>
				 <div  id="addresslist">
				 
				<?php if(count($getmanageaddressdisplay)>0){
				foreach($getmanageaddressdisplay as $displayaddress) { ?>
					<div class="infotitle shpadd">
						<span><h3><?php echo $displayaddress['firstname']." ".$displayaddress['lastname']; ?></h3></span>
						<p><?php echo $displayaddress['address']; ?></p>
						<p><?php echo $displayaddress['city']; ?> - <?php echo $displayaddress['postalcode']; ?></p>
						<p><?php echo $displayaddress['telephone']; ?></p>
						<p><?php echo $displayaddress['emailid']; ?></p>
						<p><span><a href="javascript:void(0);" onclick="javascript:editaddress(<?php echo $displayaddress['cus_addressid']; ?>);" >Edit</a></span><span> | </span><span><a href="javascript:void(0);" onclick="javascript:deladdress(<?php echo $displayaddress['cus_addressid']; ?>);">Remove</a></span></p>
					</div>
				<?php } } else { ?>	
				<div class="infotitle shpadd">
				<span><h3> No Address Found...</h3></span>
				</div>
				<?php } ?>
				</div>
			</div>
				</div>
			
				
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 pl0">
					
					<form class="shppadbdr" id="addressform" action="">
					
					        <input type="hidden" class="form-control" id="customerid" name="customerid" value="<?php echo $_SESSION['Cus_ID']; ?>">
							<input type="hidden" class="form-control" id="addressid" name="addressid">
							

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  pl0"> 
								 <div class="infotitle">
									<span><h3>Add / Update Address</h3></span>
								</div>
							</div>
						</div>
					  <div class="row">				   
					    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
								<div class="form-group ">
					    	<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $getmanageaddress_autofill['customer_firstname']; ?>" placeholder="First Name" required='' >
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
						<div class="form-group ">
					    	<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $getmanageaddress_autofill['customer_lastname']; ?>" placeholder="Last Name" required='' >
						</div>
						</div>
					  </div>

					  <div class="row">
					    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
							<div class="form-group ">
					    	<input type="email" class="form-control" id="email" name="email" value="<?php echo $getmanageaddress_autofill['customer_email']; ?>" placeholder="Email Address" required='' >
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
					    	<input type="text" class="form-control numericvalidate" id="mobileno" name="mobileno" value="<?php echo $getmanageaddress_autofill['mobileno']; ?>" placeholder="Mobile Number" required=''>
						</div>
					  </div>

					  <div class="form-group row">				    
					    <div class="col-md-12 pl0">
							
					    	<input type="text" class="form-control" id="address" name="address" placeholder="Address" required=''>
							
						</div>
					  </div>

                   
					 
                     					 

					  <div class="form-group row ">
					    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
					    	<input type="text" class="form-control" id="city" name="city" placeholder="City" required=''>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
					    	<input type="text" class="form-control numericvalidate" id="zipcode" name="zipcode" placeholder="Zipcode" required=''>
						</div>
					  </div>


					  <div class="form-group row">
					    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0 divcountry">
					    	<?php 
								echo $helper->getSelectBox_countrylist_To_cus_address('sel_country','1');
						    ?>	
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0 divstate">
					    <!--	<select class="form-control select2" id="sel_state" name="sel_state" required=''>
								<option value=""> Select State </option>	-->
								<?php 
								echo $helper->getSelectBox_state_To_cus_address('sel_state','1');
						    ?>	
						<!--	</select>	-->
						</div>
					  </div>
					   <div class="form-group row">				    
					     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
					    	<input type="text" class="form-control" id="landmark" name="landmark" placeholder="Land Mark" >
						</div>
						<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl0">
					    	<input type="text" class="form-control" id="gstno" name="gstno" placeholder="GST No" >
						</div> -->
					</div>
					  <div class="row">
					  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  	<!--	<button type="submit" class="btn btn-success">Save Changes</button>-->
							
							 <button type="button" name="button"  onclick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>manage_address');" class="common-btn btn-block btn-lg"><span>Save / Update</span></button> 
					  	</div>
					  </div>				  
					</form>
				</div>
				</div>
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

/*
	var tallness = $(".sss2").height();
	$(".panel-group").css("min-height" , tallness);

*/

  </script>
  
  
<script>
var flag_state = 0;

 function Addressform($frm,$urll,$acts,$stats,$lodlnk)
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
					
					 $("#addresslist").hide();
					if(response.rslt == "1"){
						
					$("#addressbind").html(response.data);
						var sucmsg = "Saved Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						$("#sel_country").val("");
						 $("#sel_country").trigger('change');
						  $("#sel_state").val("");
						 $("#sel_state").trigger('change');
						//alert(response);
						//$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						
						
					$("#addressbind").html(response.data);
						var sucmsg = "Updated Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						document. getElementById("addressform"). reset();
						//$(location).attr('href', $lodlnk); 	
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

function editaddress($id)
{
	   //alert($id);
	   
	
    	$('html,body').animate({scrollTop: $("#addressform").offset().top - 120 },'slow');

	   
  			$.ajax({
				url        : '<?php echo BASE_URL; ?>ajax/updateaddress',
				method     : 'POST',
				dataType   : 'json',
				data       : 'addid='+$id,
			
				success: function(response){
					
					$("#firstname").val(response.fname);
					$("#lastname").val(response.lname);
					$("#email").val(response.email);
					$("#mobileno").val(response.mobile);
					$("#address").val(response.add);
					$("#landmark").val(response.landmark);
					$("#gstno").val(response.gstno);
					$("#city").val(response.city);
					$("#zipcode").val(response.zipcode);
					//$("#sel_country").val(response.country);
					getcountry(response.country);
					getstate(response.country,response.state);
					$("#addressid").val(response.addid);
					
				},
			});
			
}	

function deladdress($id){
	
	swal({
		title: "Are you sure?",
        text: "Do you confirm to delete this address!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
    function () {
		$.ajax({		
			url        : '<?php echo BASE_URL; ?>ajax/deleteaddress',
			method     : 'POST',
			dataType   : 'json',
			data       : 'addid='+$id,
			
			success: function(response){
				 
				    $("#addressbind").html(response.data);
				    $("#firstname").val('');
				    $("#lastname").val('');
					$("#email").val('');
					$("#mobileno").val('');
				    $("#address").val('');
					$("#landmark").val('');
					$("#gstno").val('');
					$("#city").val('');
					$("#zipcode").val('');
					$("#sel_country").val('');
					//$("#sel_state").val('');
					//$('#sel_state').html('');
					 // $('#sel_state').prop('selectedIndex',0);
					  
					 // document. getElementById("addressform"). reset();

					if(response.rslt == "3"){
						 $("#addresslist").hide();
						var sucmsg = " Address deleted successfully";
						swal("Success!",sucmsg, "success");
					}
				//location.reload(true);
			}		
		});	
	 
    }); 	 
 }
 

	
function getstate(countryid,Statid=''){
     	
   if(countryid != null && countryid != ""){

	     var url = '<?php echo BASE_URL; ?>ajax/statelist';
		$.ajax({
			type: "POST",
			data : 'countryid='+countryid,
			dataType : 'text',
			url: url,
			beforeSend: function() {
					//alert("responseb");
					//loading();
				}, 	
			success: function(msg){ 
				$("#sel_state").html(msg);
				if(Statid != ''){
					$("#sel_state").val(Statid);
					$("#sel_state").trigger('change');
					
				}
				//unloading();		
			}			
		});	
   }
 }
 
 
 function getcountry(countryid){
     	//alert(countryid);
   if(countryid != null && countryid != ""){
	     var url = '<?php echo BASE_URL; ?>ajax/countrylist';
		$.ajax({
			type: "POST",
			data : 'countryid='+countryid,
			dataType : 'text',
			url: url,
			beforeSend: function() {
					//alert("responseb");
					//loading();
				}, 	
			success: function(msg){ 
				$("#sel_country").html(msg);
			//	$("#sel_country").select2("destroy");
				
				//$("#sel_country").select2();
			
				// if(countryid != ''){
					// $("#sel_country").val(countryid);
					// $("#sel_country").trigger('change');
					// //$("#sel_state").select2();
				// }
				//unloading();		
			}			
		});	
   }
 }
 
 	//$('.scrlcnt').overlayScrollbars({});

</script> 
  </body>
</html>
