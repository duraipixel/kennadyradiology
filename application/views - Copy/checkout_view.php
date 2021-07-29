<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="inner-bg">
  <div class="container">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL;?>"><?php echo $commondisplaylanguage['home'];?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $commondisplaylanguage['checkout'];?></li>
          </ol>
        </nav>
        <h3 class="text-center text-white"><span><?php echo $commondisplaylanguage['checkout'];?></span></h3>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="accordion" id="accordionCheckout">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne"> <?php echo $checkoutdisplaylanguage['choosedelivery'];?> </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionCheckout">
              <div class="accordion-body">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="add-delivery-address">
                      <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	?>
                      <button type="button" class="add-to-cart-btn1 edit-address"> <?php echo $checkoutdisplaylanguage['newaddress'];?> <i class="flaticon-location-fill"></i> </button>
                      <?php } ?>
                      <!--<span> Or </span>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">Same as Billing Address</label>
                                 </div>--> 
                    </div>
                  </div>
                  <div  id="addresslist" class="addresslist-wper row">
                    <?php  
						
						$cnt=1;
				           foreach($getmanageaddressdisplay as $displayaddress) { ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <div class="delivery-address <?php echo (isset($_SESSION['addressid']) && $_SESSION['addressid']==$displayaddress['cus_addressid'])? " active " :''; ?>">
                        <input type="radio" id="slctadd_<?php echo $cnt; ?>" onChange="return displayshipping_add('<?php echo $displayaddress['cus_addressid']; ?>')" <?php echo (isset($_SESSION['addressid']) && $_SESSION['addressid']==$displayaddress['cus_addressid'])? " Checked='checked' " :''; ?>  name="slctadd" >
                        <p><i class="flaticon-user-7"></i> <?php echo $displayaddress['firstname']." ".$displayaddress['lastname']; ?> </p>
                        <p><i class="flaticon-location-fill"></i> <?php echo $displayaddress['address']; ?> </p>
                        <p><i class="flaticon-telephone"></i> <?php echo $displayaddress['telephone']; ?></p>
                        <p><i class="flaticon-email-fill-1"></i> <?php echo $displayaddress['emailid']; ?></p>
                        <p class="select-address">
                          <button type="button" class="add-to-cart-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <?php echo $checkoutdisplaylanguage['deliveryhere'];?> </button>
                          <button type="button" class="edit-address" data-mdb-toggle="tooltip"  onClick="javascript:editaddress(<?php echo $displayaddress['cus_addressid']; ?>);" title="<?php echo $commondisplaylanguage['editaddress'];?>"> <i class="flaticon-edit-1"></i> </button>
                          <!--<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="Selected">
                                    <i class="flaticon-fill-tick"></i>-->
                          </button>
                        </p>
                        </label>
                      </div>
                    </div>
                    <?php $cnt++; } ?>
                  </div>
                </div>
                <?php 
						$clsdis=" ";
						 
					
					 if($_SESSION['Isguestcheckout']=="1" && $_SESSION['guestckout_sess_id']!="" && count($getmanageaddressdisplay)==0){ 
							  $clsdis=" style='display:block;' ";
							}
						
					 ?>
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
									<div class="show-address" style="display:none;">
                <div class="row addaddresship" id="addnew-address" <?php echo $clsdis; ?>>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                    <h4 class="mb-3"><?php echo $formdisplaylanguage['addupdateadd'];?>
					</h4>
                    <?php } else { ?>
                    <h4 class="mb-3"><?php echo $formdisplaylanguage['shipbilladd'];?>
					</h4>
                    <?php } ?>
                  </div>
				  </div>
                  <form class="shppadbdr" id="addressform" action="">
                    <input type="hidden" class="form-control" id="customerid" name="customerid" value="<?php echo $_SESSION['Cus_ID']==''?session_id():$_SESSION['Cus_ID']; ?>">
                    <input type="hidden" class="form-control" id="addressid" name="addressid">
					
				  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="hidden" name="checkout" value="checkoutaddress" />
                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" required=''>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" required=''>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" required=''>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="text" maxlength="12" class="form-control numericvalidate" id="mobileno" name="mobileno" placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" required=''>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="text" class="form-control" id="address" name="address" placeholder="<?php echo $formdisplaylanguage['address'];?>" required=''>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="text" class="form-control" id="landmark" name="landmark" placeholder="<?php echo $formdisplaylanguage['landmark'];?>" >
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="text" class="form-control" id="city" name="city" placeholder="<?php echo $formdisplaylanguage['city'];?>" required=''>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                      <input type="text" class="form-control numericvalidate" maxlength="6" id="zipcode" name="zipcode" placeholder="<?php echo $formdisplaylanguage['zipcode'];?>" required=''  value="<?php echo $_SESSION['zipcode'];?>">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 divcountry">
                      <?php 
											echo $helper->getSelectBox_countrylist_To_cus_address('sel_country','1');
										?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 divstate"> <?php echo $helper->getSelectBox_state_To_cus_address('sel_state','1');    ?> </div>
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
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center res-pad-top">
                      <button onclick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');" type="button" class="buy-now-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> <?php echo $formdisplaylanguage['saveupdate'];?> </button>
                    </div>
                    <?php } else { ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center res-pad-top">
                      <button <?php //echo  $clsdisable ?> onClick="javascript:Addressform_guest('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');" type="button" class="buy-now-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> <?php echo $checkoutdisplaylanguage['proceed'];?> </button>
                    </div>
                </div>
                    <?php }?>
                  </form>
				  </div>
                <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                <div class="col-sm-12 col-md-12 col-lg-12 text-center pb-3 pt-3">
                  <button class="buy-now-btn1 btndeliveryaddress btnaddress  <?php echo $clsdisable; ?> "   type="button" class="buy-now-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                  <?php echo $checkoutdisplaylanguage['proceed'];?> 
                  </button>
                </div>
                <?php } ?>
              </div>
            </div>
			
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">  <?php echo $checkoutdisplaylanguage['shippingmethod'];?>  </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionCheckout">
              <div class="accordion-body">
                <div id="divshippingcnt" class="row">
                  <?php 

						if(count($shippingmethod)>0){
						
						foreach($shippingmethod as $value){ 
	   $chk =''; 
		if($_SESSION['shippingid']==$value['shippingId']){
			 
			$chk='checked';
		}
		
	  ?>
                  <div class="col-sm-12 col-md-2 col-lg-2">
                    <div class="shippingmethod-single"> <span>
                      <input type="radio" id="shippingmethod_<?php echo $value['shippingId'];?>" name="shippingmethod" value="<?php echo $value['shippingCode']; ?>" onChange="shippingcharge('<?php echo $value['shippingId'];?>');" <?php echo $chk; ?>>
                      <label for="shippingmethod_<?php echo $value['shippingId'];?>">
                      <div class="shipping-icon"> <img width="40" height="40" src="<?php echo img_base_url;?>shippingimage/<?php echo $value['shippingimage']; ?>" class="img-responsive" alt="shippingmethod"></div>
                      <div class="shipping-caption"><small> <?php echo $value['shippingName']; ?></small></div>
                      </label>
                      </span> </div>
                  </div>
                  <?php }
					} else {
					?>
                  <div>   <?php echo $formdisplaylanguage['msgdisplaylanguage'];?> </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-sm-12 text-right res-pad-top">
                      <button type="button"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="add-to-cart-btn1"> <?php echo $commondisplaylanguage['back'];?> </button>
                      <button class="buy-now-btn1 m-0" type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> <?php echo $checkoutdisplaylanguage['proceed'];?>  </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> <?php echo $checkoutdisplaylanguage['paymentgateway'];?> </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionCheckout">
              <div class="accordion-body">
                <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                    <ul class="payment-methods">
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
                      <li>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 shippingmethod-single"> <span>
                          <input type="radio" id="paymentgateway<?php echo $value['pg_id'];?>" name="paymentgateway" value="<?php echo $value['pay_code']; ?>" onChange="Paymentgateway('<?php echo $value['pg_id'];?>');" <?php echo $chk; ?>>
                          <label for="paymentgateway<?php echo $value['pg_id'];?>">
                          <div class="shipping-icon"> <img class="img-fluid" src="<?php echo img_base_url;?>static/images/paymentgateway/<?php echo $image; ?>" class="img-responsive" alt="paymentgateway"></div>
                          <div class="shipping-caption"><small> <?php echo $value['title']; ?></small></div>
                          </label>
                          </span> </div>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6 text-right res-pad-top">
                    <button type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="add-to-cart-btn1"  > <?php echo $commondisplaylanguage['back'];?> </button>
                    <button type="button" class="buy-now-btn1 mr-0" data-mdb-toggle="collapse" data-mdb-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"> <?php echo $checkoutdisplaylanguage['proceed'];?>  </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> <?php echo $checkoutdisplaylanguage['ordersummary'];?> </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-mdb-parent="#accordionCheckout">
              <div class="accordion-body">
                <?php
	     include("partial/checkout_prod_list.php");
	  ?>
               
                <div class="row">
                  <div class="col-sm-12 col-md-6"> </div>
                  <div class="col-sm-12 col-md-6 text-right pt-3">
                    <button type="button" class="buy-now-btn1 mr-0 mb-3 mt-3 paynowbtn"> <?php echo $checkoutdisplaylanguage['proceedcheckout'];?> </button>
                    <br/>
                    <img src="<?php echo img_base;?>/static/images/payment-methods-paypal.jpg" alt="" class="img-fluid"/> </div>
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


$('.btndeliveryaddress').click(function(e) {
    $('#collapseOne').collapse('hide');
    $('#collapseTwo').collapse('show');        
});


$('.btnshippingaddress').click(function(e) {
    $('#collapseTwo').collapse('hide');
    $('#collapseThree').collapse('show');        
});


$('.btnpaymentaddress').click(function(e) {
    $('#collapseThree').collapse('hide');
    $('#collapseFour').collapse('show');        
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
//$("#addnew-address").hide();
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