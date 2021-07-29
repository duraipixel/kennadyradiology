<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
				<h5 class="pb-4 text-uppercase">My Account</h5>
			</div>
			<?php include ('includes/my-account-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<h3 class="text-uppercase">My Address</h3>
					<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
					<h4 class="text-dark mb-3">Saved Address</h4>
					</div>
					
                    <div id="addressbind"> </div>
                        <div  id="addresslist">
                        <?php if(count($getmanageaddressdisplay)>0){
				        foreach($getmanageaddressdisplay as $displayaddress) { ?>
                           <div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i> <?php echo $displayaddress['firstname']." ".$displayaddress['lastname']; ?></p>
                                 <p><i class="flaticon-location-fill"></i> <?php echo $displayaddress['address']; ?> , <?php echo $displayaddress['city']; ?> - <?php echo $displayaddress['postalcode']; ?> , <?php echo $displayaddress['statename'].' - '.$displayaddress['countryname']; ?></p>
                                 <p><i class="flaticon-telephone"></i> <?php echo $displayaddress['telephone']; ?></p>
                                 <p><i class="flaticon-email-fill-1"></i> <?php echo $displayaddress['emailid']; ?></p>
                                 
                                 <p class="select-address">
                                     <?php if($displayaddress['address_type']==1){ ?>
                                     <button type="button" class="selected-address" data-mdb-toggle="tooltip" title="Primary Address">
                                         <i class="flaticon-fill-tick"></i>
                                    </button>
                                 <?php }else if($displayaddress['address_type']==2){ ?>
                                 <button type="button" class="selected-address" data-mdb-toggle="tooltip" title="Secondary Address">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>
                                 <?php }else if($displayaddress['address_type']==3){ ?>
                                 <button type="button" class="selected-address" data-mdb-toggle="tooltip" title="Others">
                                     <i class="flaticon-fill-tick"></i>
                                    </button>
                                 <?php } ?>
                                 
                                    
									<button type="button" class="edit-address" onClick="javascript:editaddress(<?php echo $displayaddress['cus_addressid']; ?>);" data-mdb-toggle="tooltip" title="Edit Address">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                    
                                    <button type="button" class="delete-address" onClick="javascript:deladdress(<?php echo $displayaddress['cus_addressid']; ?>);" data-mdb-toggle="tooltip" title="Delete Address">
                                    <i class="flaticon-delete-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>
                        <?php } } else { ?>	
        				<div class="infotitle shpadd">
        				<span><h3> No Address Found...</h3></span>
        				</div>
        				<?php } ?>
                           
                        </div>
                           <!--<div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i> Willie S Williams</p>
                                 <p><i class="flaticon-location-fill"></i> 4123  Lighthouse Drive, Springfield, Missouri - 65804</p>
                                 <p><i class="flaticon-telephone"></i> 417-242-7923</p>
                                 <p><i class="flaticon-email-fill-1"></i> r9o8vk1ia4@temporary-mail.net</p>
                                 <p class="select-address">
                                    <button type="button" class="edit-address"  data-mdb-toggle="tooltip" title="Edit Address">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>-->
						   <div class="col-sm-12 col-md-12 col-lg-12">
                              <div class="add-delivery-address">
                                 <button type="button" class="add-to-cart-btn1 edit-address m-0" onClick="javascript:addnewaddress(<?php echo $displayaddress['cus_addressid']; ?>);">
                                 Add New Delivery Address <i class="flaticon-location-fill" ></i>
                                 </button>
                              </div>
                           </div>
                        </div>
						
                            <form class="show-address" id="addressform" action="" style="display:none;">
                        <div class="row">
					
					        <input type="hidden" class="form-control" id="customerid" name="customerid" value="<?php echo $_SESSION['Cus_ID']; ?>">
							<input type="hidden" class="form-control" id="addressid" name="addressid">
							
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <h4 class="mb-3">Add/Edit Address</h4>
                           </div>
						   <div class="col-sm-12 col-md-6 col-lg-4">
                              <select class="form-control custom-select" name="address_type" id="address_type">
								<option value="">select</option>
								<option value="1">Primary</option>
								<option value="2">Secondary</option>
								<option value="3">Others</option>
							  </select>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              
                              <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $getmanageaddress_autofill['customer_firstname']; ?>" placeholder="First Name" required='' >
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              
                              <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $getmanageaddress_autofill['customer_lastname']; ?>" placeholder="Last Name" required='' >
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="email" class="form-control" id="email" name="email" value="<?php echo $getmanageaddress_autofill['customer_email']; ?>" placeholder="Email Address" required='' >
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control numericvalidate" id="mobileno" name="mobileno" value="<?php echo $getmanageaddress_autofill['mobileno']; ?>" placeholder="Mobile Number" required=''>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                             <input type="text" class="form-control" id="address" name="address" placeholder="Address" required=''>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Land Mark" >
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" id="city" name="city" placeholder="City" required=''>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control numericvalidate" id="zipcode" name="zipcode" placeholder="Zipcode" required=''>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <?php 
								echo $helper->getSelectBox_countrylist_To_cus_address('sel_country','1');
						    ?>	
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                             <?php 
								echo $helper->getSelectBox_state_To_cus_address('sel_state','1');
						    ?>	
                           </div>
                           <div class="col-sm-12 col-md-12 col-lg-12 text-right res-pad-top">
                              <button type="button" class="buy-now-btn1 m-0" onclick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>manage_address');" >
                              Save Address
                              </button>
                           </div>
                        </div>
                           </form>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>


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
function addnewaddress(){
        $('html,body').animate({scrollTop: $("#addressform").offset().top - 120 },'slow');
        
        $("#firstname").val('');
				    $("#lastname").val('');
					$("#email").val('');
					$("#mobileno").val('');
				    $("#address").val('');
					$("#landmark").val('');
					$("#gstno").val('');
					$("#city").val('');
					$("#zipcode").val('');
				
				$("#address_type").val('');
				$("#address_type").trigger('change');
        $("#sel_country").val("");
        $("#sel_country").trigger('change');
        $("#sel_state").val("");
        $("#sel_state").trigger('change');
        	$("#addressid").val('');

    
}
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
				    $("#address_type").val(response.address_type);
					$("#address_type").trigger('change');
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