<?php 
//echo $_SESSION['pay_code']; exit; 
//echo "<pre>"; print_r($getcheckoutproductlist); exit;

include ('includes/top.php');
 ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
<body class="productbg billing-page">
<?php 
include ('includes/header.php'); 
?>
<section class="cartView">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="infotitle"> <span>
          <h3>Check Out</h3>
          </span> </div>
      </div>
    </div>
    <div class="cart-section">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 onepagecheckout-wper technicaltab-wper">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading panel-1" role="tab" id="headingOne">
                <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="fasle" aria-controls="collapseOne" > <span class="heading-caption">Choose your delivery address</span> <span class="custom-arrow"></span> </a> </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false">
                <div class="panel-body">
                  <div class="orderhis shpadd bgwhite ">
                    <div id="addressbind"> </div>
                    <div  id="addresslist" class="addresslist-wper">
                      <?php  
						
						$cnt=1;
				           foreach($getmanageaddressdisplay as $displayaddress) { ?>
                      <div class="selectaddress <?php echo (isset($_SESSION['addressid']) && $_SESSION['addressid']==$displayaddress['cus_addressid'])? " active " :''; ?> ">
                        <div class="diobtncss">
                          <input type="radio" id="slctadd_<?php echo $cnt; ?>" onChange="return displayshipping_add('<?php echo $displayaddress['cus_addressid']; ?>')" <?php echo (isset($_SESSION['addressid']) && $_SESSION['addressid']==$displayaddress['cus_addressid'])? " Checked='checked' " :''; ?>  name="slctadd" >
                          <label for="slctadd_<?php echo $cnt; ?>" class="selsec">
                          <span class="seladddet selectname-wper">
                          <div class="seladddet-caption ">
                            <div> <?php echo $displayaddress['firstname']." ".$displayaddress['lastname']; ?> </div>
                            <div> <?php echo $displayaddress['emailid']; ?> </div>
                          </div>
                          </span> <span class="seladddet selectmobile-wper">
                          <div class="seladddet-caption">
                            <div> <?php echo $displayaddress['telephone']; ?> </div>
                          </div>
                          </span> <span class="seladddet selectaddr-wper">
                          <div class="seladddet-caption"> <?php echo $displayaddress['address']; ?> </div>
                          </span>
                          <div class="addrcommonbtn-wper"> <span> <a href="javascript:void(0);" class="addrcommon-btn small-lightbtn" onClick="javascript:editaddress(<?php echo $displayaddress['cus_addressid']; ?>);" >Edit</a></span> </div>
                          </label>
                        </div>
                      </div>
                      <?php $cnt++; } ?>
                    </div>
                    <?php 
					// print_r($_SESSION); die();
					 
					 if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	 ?>
                    <div class="addnewtrig-wper addnew-trigger">
                      <div class="addnewtrig-inner">
                        <div class="addnew-btn add-delivery-address pull-left"> <span class="plus-icon">+</span> <span>Add New Delivery Address</span></div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php 
						$clsdis=" ";
					
					 if($_SESSION['Isguestcheckout']=="1" && $_SESSION['guestckout_sess_id']!="" && count($getmanageaddressdisplay)==0){ 
							  $clsdis=" style='display:block;' ";
							}
						
							
					 ?>
                    <div class="addaddresship" id="addnew-address" <?php echo $clsdis; ?>> 
                      <!--<div class="shptit mt30 shpadtit">
                          <h4>Check Availability</h4>
                        </div>
					

                         div class="shpaddfrm">
                         		
							<form id="divcheckavail" onSubmit="return false">
                            <div class="form-group row">
                              <div class="col-md-12 col-lg-6 pl0">
							  <input type="hidden" name="checkout" value="checkoutaddress">
										<input type="text" class="form-control numericvalidate" value="<?php echo $_SESSION['shippincode'];?>" id="shippincode" name="shippincode" placeholder="Enter Deliver Pincode" required="" maxlength="6" data-parsley-error-message="Please enter valid pincode"   data-parsley-type="number" >
                                
                              </div>
								<div class="col-md-12 col-lg-6 pull-right pl0">
                               <button type="submit" onClick="fnchkCodeAvailable();" class="button btn-primary">Check</button>
                              </div>							  
                            </div>
						    </form>
  
                     
						  <?php if(isset($_SESSION['shippincode']) || $_SESSION['shippincode']!='' ){	
										$clserror=" Style=' display:none;'";
										$clssucess=" Style=' display:block;'";
										if($isshippingavail==0)
										{
											$clserror=" Style=' display:block;'";
											$clssucess=" Style=' display:none;'";
										}
								      }	else{
											$clserror=" Style=' display:none;'";
										$clssucess=" Style=' display:none;'";
									  }										  
									?>
								  <div class="form-group" id="chkavallerror" <?php echo $clserror; ?>>				   
									<div class="col-md-12 col-lg-6 pl0">
									<div class="error">
									<small>Delivery is not available in this Location <i class="fa fa-times" aria-hidden="true"></i> </small>
									</div>									
									</div> 
								  </div>
									
								   <div class="form-group" id="chkavallsucess" <?php echo $clssucess; ?>>				   
									<div class="col-md-12 col-lg-6 pl0">
									<div class="success">
									<small>Delivery is available in this Location <i class="fa fa-check" aria-hidden="true"></i></small>
									</div>									
									</div> 
								  </div>
                        </div>-->
                      <div class="shptit mt30 shpadtit">
                        <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                        <h4>Add / Update Address</h4>
                        <?php } else { ?>
                        <h4>Shipping / Billing Address</h4>
                        <?php } ?>
                      </div>
                      <div class="shpaddfrm">
                        <form class="shppadbdr" id="addressform" action="">
                          <input type="hidden" class="form-control" id="customerid" name="customerid" value="<?php echo $_SESSION['Cus_ID']==''?session_id():$_SESSION['Cus_ID']; ?>">
                          <input type="hidden" class="form-control" id="addressid" name="addressid">
                          <div class="form-group row">
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="hidden" name="checkout" value="checkoutaddress" />
                              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required=''>
                            </div>
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required=''>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required=''>
                            </div>
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="text" maxlength="12" class="form-control numericvalidate" id="mobileno" name="mobileno" placeholder="Mobile Number" required=''>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="text" class="form-control" id="address" name="address" placeholder="Address" required=''>
                            </div>
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Land Mark" >
                            </div>
                          </div>
                          <div class="form-group row ">
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="text" class="form-control" id="city" name="city" placeholder="City" required=''>
                            </div>
                            <div class="col-md-12 col-lg-6 pl0">
                              <input type="text" class="form-control numericvalidate" maxlength="6" id="zipcode" name="zipcode" placeholder="Zipcode" required=''  value="<?php echo $_SESSION['shippincode'];?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-12 col-lg-6 pl0 divcountry ">
                              <?php 
											echo $helper->getSelectBox_countrylist_To_cus_address('sel_country','1');
										?>
                            </div>
                            <div class="col-md-12 col-lg-6 pl0 divstate"> <?php echo $helper->getSelectBox_state_To_cus_address('sel_state','1');    ?> 
                              <!--<select class="form-control select2" id="sel_state" name="sel_state" required=''>
											<option value=""> Select State </option>	
										</select> --> 
                            </div>
                          </div>
                          <?php if(isset($_SESSION['shippincode']) || $_SESSION['shippincode']!='' ){	
										$clsdisable=" ";
										
										if($isshippingavail==0)
										{
											$clsdisable=" disabled ";
										}
								      }	else{
											$clsdisable=" disabled ";
									  }
								/*	echo "hhhh";
									print_r($_SESSION);
									echo $clsdisable; die();		*/ 
									?>
                          <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                          <div class="row mt30">
                            <div class="col-md-6 pull-right pl0">
                              <button type="button" name="button"  onclick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');" class="common-btn btn-block btn-lg"><span>Save / Update</span></button>
                            </div>
                          </div>
                          <?php } else { ?>
                          <div class="row mt30">
                            <div class="col-md-6 pull-right pl0">
                              <button type="button" name="button" <?php echo  $clsdisable ?> onClick="javascript:Addressform_guest('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');" class="common-btn white-btn btn-block btn-lg btnaddress "><span>Proceed</span></button>
                            </div>
                          </div>
                          <?php } ?>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                  <div class="row ">
                    <div class="col-md-12 text-right mt30"> <span> <a  class="common-btn btn-block btn-lg btndeliveryaddress btnaddress  <?php echo $clsdisable; ?> "
												 role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Proceed </a> </span> </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading panel-3" role="tab" id="headingTwo">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> <span class="heading-caption">Shipping Method</span> <span class="custom-arrow"></span> </a> </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" >
                <div class="panel-body">
                  <div class="common-content pull-left" id="divshippingcnt">
                    <?php 

						if(count($shippingmethod)>0){
						
						foreach($shippingmethod as $value){ 
	   $chk =''; 
		if($_SESSION['shippingid']==$value['shippingId']){
			 
			$chk='checked';
		}
		
	  ?>
                    <div class="shippingmethod-single"> <span>
                      <input type="radio" id="shippingmethod_<?php echo $value['shippingId'];?>" name="shippingmethod" value="<?php echo $value['shippingCode']; ?>" onChange="shippingcharge('<?php echo $value['shippingId'];?>');" <?php echo $chk; ?>>
                      <label for="shippingmethod_<?php echo $value['shippingId'];?>">
                      <div class="shipping-icon"> <img src="<?php echo BASE_URL;?>uploads/shippingimage/<?php echo $value['shippingimage']; ?>" class="img-responsive" alt="shippingmethod"></div>
                      <div class="shipping-caption"><small> <?php echo $value['shippingName']; ?></small></div>
                      </label>
                      </span> </div>
                    <?php }
					} else {
					?>
                    <div> No Shipping available in your location </div>
                    <?php } ?>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row ">
                    <div class="col-md-12 text-right mt30"> <span> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="common-btn white-btn btn-block btn-lg back-button mr-2"> Back </a> </span> <span> <a class="common-btn btn-block btn-lg buynow-btn btnshippingaddress"
												 role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Proceed </a> </span> </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pyament Method TAB	  Start -->
            
            <div class="panel panel-default">
              <div class="panel-heading panel-4" role="tab" id="headingThree">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> <span class="heading-caption">Payment Gateway</span> <span class="custom-arrow"></span> </a> </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" >
                <div class="panel-body">
                  <div class="common-content">
                    <?php 

foreach($Paymentmethod as $value){ 
	   $chk =''; 
			if($_SESSION['pay_id']==$value['pg_id'] || isset($_SESSION['pay_code'])){
			 
			$chk='checked';
		}
		
		if($value['pg_id']=='1'){
			$image = 'cod.jpg';
		}
		else if($value['pg_id']=='5'){
			$image = 'razor.png';
		}
		else{
			$image = 'ccavenue.jpg';
		}
	  ?>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 shippingmethod-single"> <span>
                      <input type="radio" id="paymentgateway<?php echo $value['pg_id'];?>" name="paymentgateway" value="<?php echo $value['pay_code']; ?>" onChange="Paymentgateway('<?php echo $value['pg_id'];?>');" <?php echo $chk; ?>>
                      <label for="paymentgateway<?php echo $value['pg_id'];?>">
                      <div class="shipping-icon"> <img src="<?php echo BASE_URL;?>static/images/paymentgateway/<?php echo $image; ?>" class="img-responsive" alt="paymentgateway"></div>
                      <div class="shipping-caption"><small> <?php echo $value['title']; ?></small></div>
                      </label>
                      </span> </div>
                    <?php } ?>
                  </div>
                  <div class="row ">
                    <div class="col-md-12 text-right mt30"> <span> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="common-btn white-btn btn-block btn-lg back-button mr-2"> Back </a> </span> <span> <a class="common-btn btn-block btn-lg buynow-btn btnpaymentaddress"
												 role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Proceed </a> </span> </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pyament Method TAB	 End  -->
            
            <div class="panel panel-default">
              <div class="panel-heading panel-2" role="tab" id="headingFour">
                <h4 class="panel-title"> <a  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="collapsed"> <span class="heading-caption">Order Summary</span> <span class="custom-arrow"></span> </a> </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingFour" aria-expanded="false" >
                <div class="panel-body">
                  <div id="chechoutdivbind">
                    <?php
	     include("partial/checkout_prod_list.php");
	  ?>
                  </div>
                  
                  <!--
			<div id="divordersummarytab">
				 <?php
						include("partial/ordersummarytab.php");
				?>
			</div>
				-->
                  <div class="row mt30">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
                      <div id="couponpagediv" class="form-group">
                        <?php
	                                             include("partial/couponpage.php");
	                                             ?>
                      </div>
                      <!--
												<div class="cpn">
												
								          		<div class="input-group" id="hidediv">
												<form id="frmcoupon" name="frmcoupon" onSubmit="CheckCPvalid(); return false;" >
											    <input type="text" id="txtcoupon" name="txtcoupon" class="form-control" placeholder="Use Coupon Code" required=''>
											    <span class="input-group-btn" style="width:0;">
											        <button class="btn btn-default secondary-btn" type="submit">Appy Coupon</button>
											    </span>
											</form>	
											</div>
											
											<div class="input-group" id="couponremovediv">
											<p><?php echo $_SESSION['Coupontitle']; ?></p>
											 <span class="input-group-btn" style="width:0;">
											        <button class="btn btn-default secondary-btn" type="button" onClick="removecoupons();">Remove Coupon</button>
											    </span>
												</div>
												
								          	</div>  
								          	--> 
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right pt-3"> <span> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="common-btn white-btn btn-block btn-lg mr-2 back-button"> Back </a> </span> <span> <a href="javascript:void();" class="common-btn btn-block btn-lg  paynowbtn"> Pay Now </a> </span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script src="<?php echo BASE_URL; ?>static/js/jquery.fancybox.min.js"></script> 
<script type="text/javascript">
	
<?php 


if($_SESSION['Coupontitle']!=''){ ?>

	$('#couponremovediv').show();
	 $('#hidediv').hide();
<?php	
}
else{
?>
    $('#hidediv').show();
	$('#couponremovediv').hide();
<?php
}
?>	


	
	$('.panel-collapse').on('shown.bs.collapse', function (e) {
	var $panel = $(this).closest('.panel');
	$('html,body').animate({
		scrollTop: $panel.offset().top - 105 }, 
		700);
		//$("#addnew-address").slideUp();
});

$(document).ready(function () {
    $('.cartproceedbtn').on('click', function(event){
        event.preventDefault();
        // create accordion variables
        var accordion = $(this);
        var accordionContent = accordion.next('.panel-collapse');

        // toggle accordion link open class
        accordion.toggleClass("open");
        // toggle accordion content
        accordionContent.slideToggle(250);

    });
});

		
function Addressform($frm,$urll,$acts,$stats,$lodlnk)
   {
		//alert($urll);
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
					
					
					if(response.rslt == "1"){
						 $("#addnew-address").hide();
					//$("#addressbind").html(response.data);
					$("#addresslist").html(response.data);
						var sucmsg = "Saved Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						
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
					$("#sel_state").val('');
					$(".btndeliveryaddress").removeClass("disabled");
					//unloading();
					//$("button").attr('disabled',false);
					
							$('.diobtncss input[type=dio]').click(function(){
							if($(this).is(':checked')){
							$(".selectaddress").removeClass("active");
							$(this).parent(".diobtncss").parent(".selectaddress").addClass("active");
			}
       
});	
					}
					else if(response.rslt == "2"){
						 $("#addnew-address").hide();
					    $("#addresslist").html(response.data);
						var sucmsg = "Updated Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						
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
					$("#sel_state").val('');
				
					//unloading();
					//$("button").attr('disabled',false);
					
							$('.diobtncss input[type=dio]').click(function(){
							if($(this).is(':checked')){
							$(".selectaddress").removeClass("active");
							$(this).parent(".diobtncss").parent(".selectaddress").addClass("active");
			}
       
});
					}
					else if(response.rslt == "5"){
						
					   
						swal("Faliure!", response.msg, "warning");
						
					//	$("#"+$acts)[0].reset();
						return;
						
					}
					
					
					else{
						var othmsg = "oops errors!!!";
						swal("We are Sorry !!", othmsg, "warning");
					}
					
					
					

				},
				error: function(jqXHR, textStatus, errorThrown){
					//alert(textStatus);
				}
			});
		}
	}
	
	

		
function Addressform_guest($frm,$urll,$acts,$stats,$lodlnk)
   {
		//alert($urll);
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
					
					
					if(response.rslt == "1"){
						 $("#addnew-address").hide();
					//$("#addressbind").html(response.data);
					$("#addresslist").html(response.data);
						var sucmsg = "Saved Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						 $.ajax({
						url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
						method     : 'POST',
						dataType   : 'json',
						data: '',		
						success: function (response) {  
							if(response.rslt==1){			
							 $("#divshippingcnt").html(response.shippingmet);
							}
						 }
						});							
					   $('#collapseTwo').collapse('toggle');
					  $('#collapseOne').collapse('toggle');	
						
					 

						$("#"+$acts)[0].reset();
						
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
					$("#sel_state").val('');

					//unloading();
					//$("button").attr('disabled',false);
					
							$('.diobtncss input[type=dio]').click(function(){
							if($(this).is(':checked')){
							$(".selectaddress").removeClass("active");
							$(this).parent(".diobtncss").parent(".selectaddress").addClass("active");
			}
       
});	
					}
					else if(response.rslt == "2"){
						// $("#addnew-address").hide();
					    $("#addresslist").html(response.data);
						var sucmsg = "Updated Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						 $.ajax({
						url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
						method     : 'POST',
						dataType   : 'json',
						data: '',		
						success: function (response) {  
							if(response.rslt==1){			
							 $("#divshippingcnt").html(response.shippingmet);
							}
						 }
						});							
					   $('#collapseTwo').collapse('toggle');
					  $('#collapseOne').collapse('toggle');	
						
						
						$("#"+$acts)[0].reset();
						
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
					$("#sel_state").val('');

					//unloading();
					//$("button").attr('disabled',false);
					
							$('.diobtncss input[type=dio]').click(function(){
							if($(this).is(':checked')){
							$(".selectaddress").removeClass("active");
							$(this).parent(".diobtncss").parent(".selectaddress").addClass("active");
			}
       
});
					}
					else if(response.rslt == "5"){
						
					   
						swal("Faliure!", response.msg, "warning");
						$.ajax({
						url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
						method     : 'POST',
						dataType   : 'json',
						data: '',		
						success: function (response) {  
							if(response.rslt==1){			
							 $("#divshippingcnt").html(response.shippingmet);
							}
						 }
						});		
					//	$("#"+$acts)[0].reset();
						return;
						
					}
					
					
					else{
						var othmsg = "oops errors!!!";
						swal("We are Sorry !!", othmsg, "warning");
					}
					
					
					

				},
				error: function(jqXHR, textStatus, errorThrown){
					//alert(textStatus);
				}
			});
		}
	}
		


function CheckCPvalid()
{
	var cpcode=$("#txtcoupon").val();
	 if(cpcode != null && cpcode != ""){
	     var url = '<?php echo BASE_URL; ?>ajax/isvaildcp';
		$.ajax({
			type: "POST",
			data : 'cp='+cpcode,
			dataType : 'json',
			url: url,
			beforeSend: function() {
					//alert("responseb");
					//loading();
				}, 	
			success: function(response){
				if(response.rslt== 0){
					swal("We are Sorry !!", response.msg, "warning");
				}
				else if(response.rslt== 1){
					$("#divordersummary").html(response.ordersummaryinfo);
					$("#divordersummarytab").html(response.ordersummaryinfotab);
					$("#couponpagediv").html(response.coupondiscount);
					$('#hidediv').hide();
					$('#couponremovediv').show();
				}
				else if(response.rslt== 2){
					swal("We are Sorry !!", response.msg, "warning");
				}
				
				//unloading();		
			}			
		});	
   }
	
}

	function removecoupons(){
		
		    var urls = '<?php echo BASE_URL; ?>ajax/removecoupon';
			swal({
				title: "Are you sure?",
				text: "Are you want to remove coupon",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: true
			},
			function(isConfirm){	
			if(isConfirm){
				$.ajax({
				url: urls,
				method     : 'POST',
				dataType   : 'json',
				data : '',
				beforeSend: function() {
					//loading();
				},
				
				success: function (response) {
						$("#divordersummary").html(response.ordersummaryinfo);
						$("#divordersummarytab").html(response.ordersummaryinfotab);
						$('#txtcoupon').val('');
						$('#hidediv').show();
						$('#couponremovediv').hide();
						//location.reload();
					
					},
				  
				});
			}
        });
		//location.reload();
	}
	
	
	
function shippingcharge(id){
    var spcode=$("#shippingmethod_"+id).val();
	//alert(spcode);
	 if(spcode != null && spcode != ""){
	     var url = '<?php echo BASE_URL; ?>ajax/shippingcharge';
		$.ajax({
			type: "POST",
			data : 'sp='+spcode+'&id='+id,
			dataType : 'json',
			url: url,
			beforeSend: function() {
					//alert("responseb");
					//loading();
				}, 	
			success: function(response){
				if(response.rslt== 1){
					$("#divordersummary").html(response.ordersummaryinfo);
					$("#divordersummarytab").html(response.ordersummaryinfotab);
				}
				
				//unloading();		
			}			
		});	
   }

}


function Paymentgateway(id)
{
	var pgwaycode=$("#paymentgateway"+id).val();
	 if(pgwaycode != null && pgwaycode != ""){
	    var url = '<?php echo BASE_URL; ?>ajax/Paymentgatewaytype';
		$.ajax({
			type: "POST",
			data : 'pgwaycode='+pgwaycode+'&id='+id,
			dataType : 'json',
			url: url,
			beforeSend: function() {
					//alert("responseb");
					//loading();
				}, 	
			success: function(response){
				
			}			
		});	
   }

}

function editaddress($id)
{
	   // alert($id);
	   
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
					//$("#sel_country select").val(response.country);
					getcountry(response.country);
					getstate(response.country,response.state);
					$("#addressid").val(response.addid);
					
					
						$("#addnew-address").slideDown();
						
						$('html, body').animate({
							scrollTop: $("#addnew-address").offset().top -125
						}, 1000);
					
					
			
					
				},
			});
			
}

/*
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
					//$("#sel_state").val(Statid);
					$("#sel_state ").select2("val", Statid);
					
					//$("#sel_state").select2();
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
				if(countryid != ''){
					//var curVAl = $("#sel_country").val(countryid);
					//$("#sel_country").val(countryid);
					$("#sel_country").select2("val", countryid);
					//alert(countryid);
					
					//getstate(this.value)
					
					//$("#sel_state").select2();
				}
				//unloading();		
			}			
		});	
   }
 }	
 */
 
 
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
			data       : 'checkout=checkoutaddress&addid='+$id,
			
			success: function(response){
				 
				    $("#addresslist").html(response.data);
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
					$("#sel_state").val('');
					if(response.rslt == "3"){
						// $("#addresslist").hide();
						var sucmsg = " Address deleted successfully";
						swal("Success!",sucmsg, "success");
					}
				//location.reload(true);
			}		
		});	
	 
    }); 	 
 }
$("#addnew-address").hide();
 $('.addnew-trigger').click(function(){
		
		$("#addressform").trigger("reset");
		//$(".select2").select2();
		$("#addnew-address").toggle();
		 $('html, body').animate({
        scrollTop: $("#addnew-address").offset().top -125
		}, 1000);
		
});
$('.diobtncss input[type=dio]').click(function(){

		 if($(this).is(':checked')){
            $(".selectaddress").removeClass("active");
            $(this).parent(".diobtncss").parent(".selectaddress").addClass("active");
        }
       
});

$('.btndeliveryaddress').click(function(e) {
	e.stopImmediatePropagation();

		$.ajax({		
			url        : '<?php echo BASE_URL; ?>ajax/checkaddress',
			method     : 'POST',
			dataType   : 'json',
			data       : '',
			
			success: function(response){			
					if(response.success!="1"){
						swal("We are Sorry !!", "Choose your delivery address", "warning");
					}
				   else{
					   $.ajax({
						url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
						method     : 'POST',
						dataType   : 'json',
						data: '',		
						success: function (response) {  
							if(response.rslt==1){			
							 $("#divshippingcnt").html(response.shippingmet);
							}
						 }
						});							
					   $('#collapseTwo').collapse('toggle');
					  $('#collapseOne').collapse('toggle');	

					  
				   }
			}		
		});	
});

$('.btnshippingaddress').click(function(e) {
	e.stopImmediatePropagation();
	
		$.ajax({		
			url        : '<?php echo BASE_URL; ?>ajax/checkshipping',
			method     : 'POST',
			dataType   : 'json',
			data       : '',
			
			success: function(response){			
					if(response.success!="1"){
						if(	response.tag=="1"){
							swal("We are Sorry !!", "Choose delivery address", "warning");
							$('#collapseOne').collapse('toggle');
							$('#collapseTwo').collapse('toggle');						
						}
						else if(response.tag=="3"){
						location.href="<?php echo BASE_URL; ?>login";
					    }
						else{				
							swal("We are Sorry !!", "Choose shipping method", "warning");
						}
					}
				   else{
					   $('#collapseThree').collapse('toggle');		
					   $('#collapseTwo').collapse('toggle');					   
				   }
			}		
		});	
});


$('.btnpaymentaddress').click(function(e) {
	e.stopImmediatePropagation();
	
		$.ajax({		
			url        : '<?php echo BASE_URL; ?>ajax/checkpayment',
			method     : 'POST',
			dataType   : 'json',
			data       : '',
			
			success: function(response){			
					if(response.success!="1"){
						if(	response.tag=="1"){
							swal("We are Sorry !!", "Choose delivery address", "warning");
							$('#collapseOne').collapse('toggle');
							$('#collapseThree').collapse('toggle');						
						}
						else if(response.tag=="3"){
						location.href="<?php echo BASE_URL; ?>login";
					    }
						else if(response.tag=="4"){
							$('#collapseTwo').collapse('toggle');
							$('#collapseThree').collapse('toggle');
							swal("We are Sorry !!", "Choose shipping method", "warning");				
						}
						else{				
							swal("We are Sorry !!", "Choose Payment method", "warning");
						}
					}
				   else{
					   $('#collapseFour').collapse('toggle');		
					   $('#collapseThree').collapse('toggle');					   
				   }
			}		
		});	
});


$('.paynowbtn').click(function(e) {
	e.stopImmediatePropagation();
	
		$.ajax({		
			url        : '<?php echo BASE_URL; ?>ajax/checkpayment',
			method     : 'POST',
			dataType   : 'json',
			data       : '',
			
			success: function(response){			
					if(response.success!="1"){
					if(	response.tag=="1"){
						swal("We are Sorry !!", "Choose delivery address", "warning");
						$('#collapseOne').collapse('toggle');
						$('#collapseFour').collapse('toggle');						
					}
					else if(response.tag=="3"){
						location.href="<?php echo BASE_URL; ?>login";
					}
					else if(response.tag=="4"){
						$('#collapseTwo').collapse('toggle');
						$('#collapseFour').collapse('toggle');
						swal("We are Sorry !!", "Choose shipping method", "warning");
					}
					else					
					{
						$('#collapseThree').collapse('toggle');
						$('#collapseFour').collapse('toggle');
						swal("We are Sorry !!", "Choose Payment method", "warning");
						
					}
					}
					else{
					  location.href="<?php echo BASE_URL; ?>orders";
					}
				  
			}		
		});	
});

 

function fnchkCodeAvailable()
{
  $('#divcheckavail').parsley().validate();
	
		
		if ($('#divcheckavail').parsley().isValid()){	
		
	var pcode=$("#shippincode").val();
	 $.ajax({
				url        :'<?php echo BASE_URL;?>ajax/chkzipcode',				
				method     : 'POST',
				dataType   : 'text',   
				data       :"pin="+pcode,
				beforeSend: function() {
					
				},
				success: function(response){					
					if(response==1)
					{
					  $("#chkavallerror").css("display","none");
					  $("#chkavallsucess").css("display","block");
					  $(".btnaddress").removeAttr("disabled");
					  $("#zipcode").val(pcode);
					}else{
					  $("#chkavallerror").css("display","block");
					  $("#chkavallsucess").css("display","none");						
					  $(".btnaddress").attr("disabled");
					   $("#zipcode").val('');
					}
				}
				,

			});
		}
}



</script>
</body>
</html>