<?php 

include ('includes/style.php'); 
include ('includes/header.php'); ?>
<style>
.coupon-code li.parsley-required {
    top: 20px;
    left: 2px;
}
</style>
<section class="inner-bg">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="<?php echo BASE_URL;?>"><?php echo $commondisplaylanguage['home'];?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo $commondisplaylanguage['checkout'];?></li>
                    </ol>
                </nav>
                <h1 class="heading1 text-center text-white"><?php echo $commondisplaylanguage['checkout'];?></h1>
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
                            <button class="accordion-button" type="button" data-mdb-toggle="collapse"
                                data-mdb-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?php echo $checkoutdisplaylanguage['choosedelivery'];?> </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-mdb-parent="#accordionCheckout">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="add-delivery-address">
                                            <?php //if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){	?>
                                            &nbsp;&nbsp; <button type="button" class="add-to-cart-btn1 edit-address" onclick="openAddressForm()">
                                                <?php echo $checkoutdisplaylanguage['newaddress'];?> <i
                                                    class="flaticon-location-fill"></i> </button>

                                            <?php //} ?>

                                        </div>
                                    </div>
                                    <div id="addresslist" class="addresslist-wper row">
                                    <?php include('checkout/_address_list.php') ?>
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
                                <div class="show-address" id="addressToggle" style="display:none">
                                    <div class="row addaddresship" id="addnew-address" <?php echo $clsdis; ?>>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                                            <h4 class="mb-3"><?php echo $formdisplaylanguage['addupdateadd'];?> </h4>
                                            <?php } else { ?>
                                            <h4 class="mb-3"><?php echo $formdisplaylanguage['shipbilladd'];?> </h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <form class="shppadbdr" id="addressform" action="">
                                        <input type="hidden" class="form-control" id="customerid" name="customerid"
                                            value="<?php echo $_SESSION['Cus_ID']==''?session_id():$_SESSION['Cus_ID']; ?>">
                                        <input type="hidden" class="form-control" id="addressid" name="addressid">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="hidden" name="checkout" value="checkoutaddress" />
                                                <input type="text" class="form-control" id="firstname" name="firstname"
                                                    placeholder="<?php echo $formdisplaylanguage['firstname'];?>"
                                                    required=''>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="text" class="form-control" id="lastname" name="lastname"
                                                    placeholder="<?php echo $formdisplaylanguage['lastname'];?>"
                                                    required=''>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>"
                                                    required=''>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="text" maxlength="12" class="form-control numericvalidate"
                                                    id="mobileno" name="mobileno"
                                                    placeholder="<?php echo $formdisplaylanguage['mobileno'];?>"
                                                    required=''>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="<?php echo $formdisplaylanguage['address'];?>"
                                                    required=''>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="text" class="form-control" id="landmark" name="landmark"
                                                    placeholder="<?php echo $formdisplaylanguage['landmark'];?>">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="text" class="form-control" id="city" name="city"
                                                    placeholder="<?php echo $formdisplaylanguage['city'];?>"
                                                    required=''>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                <input type="text" class="form-control numericvalidate" maxlength="6"
                                                    id="zipcode" name="zipcode"
                                                    placeholder="<?php echo $formdisplaylanguage['zipcode'];?>"
                                                    required='' value="<?php echo $_SESSION['zipcode'];?>">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4 divcountry">
                                                <?php 
                                                    echo $helper->getSelectBox_countrylist_To_cus_address('sel_country','1');
                                                ?>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4 divstate">
                                                <?php echo $helper->getSelectBox_state_To_cus_address('sel_state','1');    ?>
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
                                            
                                                ?>
                                            <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center res-pad-top">
                                                <!-- <button
                                                    onclick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');"
                                                    type="button" class="buy-now-btn1" data-mdb-toggle="collapse"
                                                    data-mdb-target="#collapseTwo" aria-expanded="true"
                                                    aria-controls="collapseTwo">
                                                    <?php echo $formdisplaylanguage['saveupdate'];?> </button> -->
                                                    <button type="button"
                                                    onClick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');"
                                                    class="buy-now-btn1 mr-0">
                                                    <?php echo $formdisplaylanguage['saveupdate'];?> </button>
                                            </div>
                                            <?php } else { ?>
                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center res-pad-top">
                                                <!-- <button type="button" onClick="javascript:Addressform_guest('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');"  class="buy-now-btn1 mr-0 collapsed" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> <?php echo $checkoutdisplaylanguage['proceed'];?> </button>-->

                                                <button type="button"
                                                    onClick="javascript:Addressform_guest('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>checkout');"
                                                    class="buy-now-btn1 mr-0">
                                                    <?php echo $formdisplaylanguage['saveupdate'];?> </button>

                                                <?php if(count($getmanageaddressdisplay) > 0){?>
                                                <button id="guestproceed" type="button"
                                                    class="buy-now-btn1 mr-0 collapsed" data-mdb-toggle="collapse"
                                                    data-mdb-target="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">
                                                    <?php echo $checkoutdisplaylanguage['proceed'];?> </button>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                    </form>
                                </div>
                            </div>
                            <?php if($_SESSION['Isguestcheckout']!="1" && $_SESSION['guestckout_sess_id']==""){ ?>
                            <div class="col-sm-12 col-md-12 col-lg-12 text-right pb-3 pt-3">
                                <button type="button" class="buy-now-btn1 mr-0 collapsed" data-mdb-toggle="collapse"
                                    data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <?php echo $checkoutdisplaylanguage['proceed'];?> </button>

                                        <!--  
                                        <button class="buy-now-btn1 btndeliveryaddress btnaddress  <?php echo $clsdisable; ?> "   type="button" class="buy-now-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <?php echo $checkoutdisplaylanguage['proceed'];?> 
                                        </button>-->
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <form action="<?php echo BASE_URL ?>checkout/payPalPayment" method="POST">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <?php echo $checkoutdisplaylanguage['shippingmethod'];?> </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-mdb-parent="#accordionCheckout">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span id="divshippingcnt">
                                                <div class="row">
                                                    <?php 

                                                    if(count($shippingmethod)>0) {
                                                                            
                                                        foreach($shippingmethod as $value) { 
                                                            $chk =''; 
                                                            if($_SESSION['shippingid']==$value['shippingId']) {
                                                                
                                                                $chk='checked';
                                                            }
                                                        
                                                    ?>
                                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <div class="shippingmethod-single"> <span>
                                                                <input type="radio"
                                                                    id="shippingmethod_<?php echo $value['shippingId'];?>"
                                                                    name="shippingmethod"
                                                                    value="<?php echo $value['shippingCode']; ?>"
                                                                    onChange="shippingcharge('<?php echo $value['shippingId'];?>');"
                                                                    <?php echo $chk; ?>>
                                                                <label
                                                                    for="shippingmethod_<?php echo $value['shippingId'];?>">
                                                                    <div class="shipping-icon"> <img
                                                                            src="<?php echo img_base_url;?>shippingimage/<?php echo $value['shippingimage']; ?>"
                                                                            class="img-responsive" alt="shippingmethod">
                                                                    </div>
                                                                    <div class="shipping-caption"><small>
                                                                            <?php echo $value['shippingName']; ?></small>
                                                                    </div>
                                                                </label>
                                                            </span> </div>
                                                    </div>
                                                    <?php }
                                                    } else {
                                                    ?>
                                                    <div> <?php echo $formdisplaylanguage['msgdisplaylanguage'];?> </div>
                                                    <?php } ?>
                                                </div>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-sm-12 text-right res-pad-top">

                                            <button type="button" class="add-to-cart-btn1 mr-3 collapsed"
                                                data-mdb-toggle="collapse" data-mdb-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                <?php echo $commondisplaylanguage['back'];?> </button>
                                            <button type="button" class="buy-now-btn1 mr-0 collapsed"
                                                data-mdb-toggle="collapse" data-mdb-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <?php echo $checkoutdisplaylanguage['proceed'];?> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <?php echo $checkoutdisplaylanguage['paymentgateway'];?> </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-mdb-parent="#accordionCheckout">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
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
                                                    <div class="shippingmethod-single"> 
                                                        <span>
                                                            <label for="paymentgateway<?php echo $value['pg_id'];?>">
                                                                <div class="shipping-icon"> <img class="img-fluid"
                                                                        src="<?php echo img_base_url;?>static/images/paymentgateway/<?php echo $image; ?>"
                                                                        class="img-responsive" alt="paymentgateway"></div>
                                                                <div class="shipping-caption">
                                                                    <input type="radio" selected
                                                                        id="paymentgateway<?php echo $value['pg_id'];?>"
                                                                        name="paymentgateway"
                                                                        value="<?php echo $value['pay_code']; ?>"
                                                                        onChange="Paymentgateway('<?php echo $value['pg_id'];?>');"
                                                                        <?php echo $chk; ?>>
                                                                    <small> <?php echo $value['title']; ?></small>
                                                                </div>
                                                            </label>
                                                        </span> 
                                                    </div>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 text-right res-pad-top">
                                            <button type="button" class="add-to-cart-btn1 mr-3 collapsed"
                                                data-mdb-toggle="collapse" data-mdb-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                <?php echo $commondisplaylanguage['back'];?> </button>
                                        
                                            <button type="button" class="buy-now-btn1 mr-0" data-mdb-toggle="collapse"
                                                data-mdb-target="#collapseFour" aria-expanded="true"
                                                aria-controls="collapseFour">
                                                <?php echo $checkoutdisplaylanguage['proceed'];?> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse"
                                    data-mdb-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <?php echo $checkoutdisplaylanguage['ordersummary'];?> </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-mdb-parent="#accordionCheckout">
                                <div class="accordion-body">
                                    <?php
                                    
                                    include("partial/checkout_prod_list.php");
                                    // include( "./checkout/_item_list.php" );
                                ?>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"> </div>
                                        <div class="col-sm-12 col-md-6 text-right pt-3">
                                            
                                            <!-- <button type="button" class="buy-now-btn1 mr-0 mb-3 mt-3 paynowbtn"><?php echo $checkoutdisplaylanguage['proceedcheckout'];?> </button> -->
                                            <button type="submit" class="buy-now-btn1 mr-0 mb-3 mt-3">
                                                <?php echo $checkoutdisplaylanguage['proceedcheckout'];?> </button>
                                            <br />
                                            <img src="<?php echo img_base;?>/static/images/payment-methods-paypal.jpg"
                                                alt="" class="img-fluid" />
                                        
                                        </div>
                                    </div>
                                </div>
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
    var address_error = '<?= isset($_SESSION['address_error']) ? true: false ?>';
    if( address_error ) {
        setTimeout(() => {
            swal("Error!", 'Address not Selected', "error");
        }, 500);
    }
        
    function openAddressForm() {

        var x = document.getElementById("addressToggle");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
       
    }


$('#guestproceed').hide();
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

$('.panel-collapse').on('shown.bs.collapse', function(e) {
    var $panel = $(this).closest('.panel');
    $('html,body').animate({
            scrollTop: $panel.offset().top - 105
        },
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


$(document).ready(function() {
    $('.cartproceedbtn').on('click', function(event) {
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


function Addressform($frm, $urll, $acts, $stats, $lodlnk) {

    $('#' + $acts).parsley().validate();

    if ($('#' + $acts).parsley().isValid()) {
        $("button").attr('disabled', false);
        var m_data = new FormData();
        var formdatas = $("#" + $acts).serializeArray();
        $.each(formdatas, function(key, value) {
            m_data.append(value.name, value.value);
        });

        $.ajax({
            url: $urll,
            method: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: m_data,
            beforeSend: function() {
                loading();
            },
            success: function(response) {
                
                if (response.rslt == "1") {

                    $("#addnew-address").hide();
                    checkoutAddressList();
                    swal("Success!", 'Address Saved Successfully', "success");

                    $("#" + $acts)[0].reset();
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

                    $('.diobtncss input[type=dio]').click(function() {
                        if ($(this).is(':checked')) {
                            $(".selectaddress").removeClass("active");
                            $(this).parent(".diobtncss").parent(".selectaddress").addClass(
                            "active");
                        }

                    });
                } else if (response.rslt == "2") {

                    $("#addnew-address").hide();
                    checkoutAddressList();
                    var sucmsg = "Updated Successfully";

                    swal("Success!", $stats + ' ' + sucmsg, "success");

                    $("#" + $acts)[0].reset();

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

                    $('.diobtncss input[type=dio]').click(function() {
                        if ($(this).is(':checked')) {
                            $(".selectaddress").removeClass("active");
                            $(this).parent(".diobtncss").parent(".selectaddress").addClass(
                            "active");
                        }

                    });
                } else if (response.rslt == "5") {
                    swal("Faliure!", response.msg, "warning");            
                    return;
                } else {
                    var othmsg = "oops errors!!!";
                    swal("We are Sorry !!", othmsg, "warning");
                }
                unloading();
            },
            error: function(jqXHR, textStatus, errorThrown) {              
            }
        });
    }
}

function checkoutAddressList() {
    $.ajax({
        url: '<?php echo BASE_URL; ?>checkout/getAddressList',
        method: 'POST',
        success: function(response) {
            $('#addresslist').html(response);
        }
    });
}

function Addressform_guest($frm, $urll, $acts, $stats, $lodlnk) { 

    $('#' + $acts).parsley().validate();

    if ($('#' + $acts).parsley().isValid()) {
    
        $("button").attr('disabled', false);
        var m_data = new FormData();
        var formdatas = $("#" + $acts).serializeArray();
        $.each(formdatas, function(key, value) {
            m_data.append(value.name, value.value);
        });

        $.ajax({
            url: $urll,
            method: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: m_data,
            beforeSend: function() {
               loading();
            },
            success: function(response) {
                unloading();
                if (response.rslt == "1") {
                    $('#guestproceed').show();
                    $("#addnew-address").hide();            
                    checkoutAddressList();
                    var sucmsg = "Address Saved Successfully";
                    swal("Success!", sucmsg, "success");
                    
                    $.ajax({
                        url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
                        method: 'POST',
                        dataType: 'json',
                        data: '',
                        success: function(response) {
                            if (response.rslt == 1) {
                                $("#divshippingcnt").html(response.shippingmet);
                            }
                        }
                    });
                    $('#collapseTwo').collapse('toggle');
                    $('#collapseOne').collapse('toggle');

                    $("#" + $acts)[0].reset();

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

                    $('.diobtncss input[type=dio]').click(function() {
                        if ($(this).is(':checked')) {
                            $(".selectaddress").removeClass("active");
                            $(this).parent(".diobtncss").parent(".selectaddress").addClass(
                            "active");
                        }

                    });
                } else if (response.rslt == "2") {
                    // $("#addnew-address").hide();
                    checkoutAddressList();
                    var sucmsg = "Updated Successfully";
                    swal("Success!", $stats + ' ' + sucmsg, "success");

                    $.ajax({
                        url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
                        method: 'POST',
                        dataType: 'json',
                        data: '',
                        success: function(response) {
                            if (response.rslt == 1) {
                                $("#divshippingcnt").html(response.shippingmet);
                            }
                        }
                    });
                    // $('#collapseTwo').collapse('toggle');
                    //  $('#collapseOne').collapse('toggle');	


                    $("#" + $acts)[0].reset();

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

                    $('.diobtncss input[type=dio]').click(function() {
                        if ($(this).is(':checked')) {
                            $(".selectaddress").removeClass("active");
                            $(this).parent(".diobtncss").parent(".selectaddress").addClass(
                            "active");
                        }

                    });
                } else if (response.rslt == "5") {


                    swal("Faliure!", response.msg, "warning");
                    $.ajax({
                        url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
                        method: 'POST',
                        dataType: 'json',
                        data: '',
                        success: function(response) {
                            if (response.rslt == 1) {
                                $("#divshippingcnt").html(response.shippingmet);
                            }
                        }
                    });
                    //	$("#"+$acts)[0].reset();
                    return;

                } else {
                    var othmsg = "oops errors!!!";
                    swal("We are Sorry !!", othmsg, "warning");
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                //alert(textStatus);
            }
        });
    }
}

$('#apply-button').on('click', function (e) {
    
    var cpcode = $("#txtcoupon").val();
    if (cpcode != null && cpcode != "") {
        var url = '<?php echo BASE_URL; ?>ajax/isvaildcp';
        $.ajax({
            type: "POST",
            data: 'cp=' + cpcode,
            dataType: 'json',
            url: url,
            beforeSend: function() {
                loading();
                $('#coupon-error').html('');
            },
            success: function(response) {
                unloading();
                if (response.rslt == 0) {
                    swal("We are Sorry !!", response.msg, "warning");
                } else if (response.rslt == 1) {
                    // $("#divordersummary").html(response.ordersummaryinfo);
                    $("#divordersummarytab").html(response.ordersummaryinfo);
                    $("#couponpagediv").html(response.coupondiscount);
                    $('#hidediv').hide();
                    $('#couponremovediv').show();
                    $('#textCoupon').val(response.coupon);
                } else if (response.rslt == 2) {
                    swal("We are Sorry !!", response.msg, "warning");
                }
            }
        });
    } else {
        $('#coupon-error').html( 'Coupon code is required!');
        $('#txtcoupon').focus();
        $('#coupon-error').css('color', 'red');
    }
});

function removecoupons() {

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
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: urls,
                    method: 'POST',
                    dataType: 'json',
                    data: '',
                    beforeSend: function() {
                        loading();
                    },
                    success: function(response) {
                        // $("#divordersummary").html(response.ordersummaryinfo);
                        $("#divordersummarytab").html(response.ordersummaryinfo);
                        $('#txtcoupon').val('');
                        $('#hidediv').show();
                        $('#couponremovediv').hide();
                        unloading();
                    },

                });
            }
        });

}

function shippingcharge(id) {
    var spcode = $("#shippingmethod_" + id).val();
    //alert(spcode);
    if (spcode != null && spcode != "") {
        var url = '<?php echo BASE_URL; ?>ajax/shippingcharge';
        $.ajax({
            type: "POST",
            data: 'sp=' + spcode + '&id=' + id,
            dataType: 'json',
            url: url,
            beforeSend: function() {             
            },
            success: function(response) {
                if (response.rslt == 1) {
                    $("#divordersummary").html(response.ordersummaryinfo);
                    $("#divordersummarytab").html(response.ordersummaryinfotab);
                }            	
            }
        });
    }
}

function Paymentgateway(id) {
    var pgwaycode = $("#paymentgateway" + id).val();
    if (pgwaycode != null && pgwaycode != "") {
        var url = '<?php echo BASE_URL; ?>ajax/Paymentgatewaytype';
        $.ajax({
            type: "POST",
            data: 'pgwaycode=' + pgwaycode + '&id=' + id,
            dataType: 'json',
            url: url,
            beforeSend: function() {
                //alert("responseb");
                //loading();
            },
            success: function(response) {

            }
        });
    }
}

function editaddress($id) {

    $.ajax({
        url: '<?php echo BASE_URL; ?>ajax/updateaddress',
        method: 'POST',
        dataType: 'json',
        data: 'addid=' + $id,
        success: function(response) {

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
            getstate(response.country, response.state);
            $("#addressid").val(response.addid);
            $("#addnew-address").slideDown();

            $('html, body').animate({
                scrollTop: $("#addnew-address").offset().top - 125
            }, 1000);
        },
    });

}
function getstate(countryid, Statid = '') {

    if (countryid != null && countryid != "") {

        var url = '<?php echo BASE_URL; ?>ajax/statelist';
        $.ajax({
            type: "POST",
            data: 'countryid=' + countryid,
            dataType: 'text',
            url: url,
            beforeSend: function() {
                //alert("responseb");
                //loading();
            },
            success: function(msg) {
                $("#sel_state").html(msg);
                if (Statid != '') {
                    $("#sel_state").val(Statid);
                    $("#sel_state").trigger('change');
                }
                //unloading();		
            }
        });
    }
}


function getcountry(countryid) {
    //alert(countryid);
    if (countryid != null && countryid != "") {
        var url = '<?php echo BASE_URL; ?>ajax/countrylist';
        $.ajax({
            type: "POST",
            data: 'countryid=' + countryid,
            dataType: 'text',
            url: url,
            beforeSend: function() {
                //alert("responseb");
                //loading();
            },
            success: function(msg) {
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


function deladdress($id) {

    swal({
            title: "Are you sure?",
            text: "Do you confirm to delete this address!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: '<?php echo BASE_URL; ?>ajax/deleteaddress',
                method: 'POST',
                dataType: 'json',
                data: 'checkout=checkoutaddress&addid=' + $id,
                beforeSend: function() {
                    loading();  
                },
                success: function(response) {

                    checkoutAddressList();
                    unloading();
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
                    if (response.rslt == "3") {
                        // $("#addresslist").hide();
                        var sucmsg = " Address deleted successfully";
                        swal("Success!", sucmsg, "success");
                    }
                    
                }
            });

        });
}
//$("#addnew-address").hide();
$('.addnew-trigger').click(function() {

    $("#addressform").trigger("reset");
    //$(".select2").select2();
    $("#addnew-address").toggle();
    $('html, body').animate({
        scrollTop: $("#addnew-address").offset().top - 125
    }, 1000);

});
$('.diobtncss input[type=dio]').click(function() {

    if ($(this).is(':checked')) {
        $(".selectaddress").removeClass("active");
        $(this).parent(".diobtncss").parent(".selectaddress").addClass("active");
    }

});

$('.btndeliveryaddress').click(function(e) {
    e.stopImmediatePropagation();

    $.ajax({
        url: '<?php echo BASE_URL; ?>ajax/checkaddress',
        method: 'POST',
        dataType: 'json',
        data: '',

        success: function(response) {
            if (response.success != "1") {
                swal("We are Sorry !!", "Choose your delivery address", "warning");
            } else {
                $.ajax({
                    url: '<?php echo BASE_URL; ?>ajax/getShippingMethod',
                    method: 'POST',
                    dataType: 'json',
                    data: '',
                    success: function(response) {
                        if (response.rslt == 1) {
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
        url: '<?php echo BASE_URL; ?>ajax/checkshipping',
        method: 'POST',
        dataType: 'json',
        data: '',

        success: function(response) {
            if (response.success != "1") {
                if (response.tag == "1") {
                    swal("We are Sorry !!", "Choose delivery address", "warning");
                    $('#collapseOne').collapse('toggle');
                    $('#collapseTwo').collapse('toggle');
                } else if (response.tag == "3") {
                    location.href = "<?php echo BASE_URL; ?>login";
                } else {
                    swal("We are Sorry !!", "Choose shipping method", "warning");
                }
            } else {
                $('#collapseThree').collapse('toggle');
                $('#collapseTwo').collapse('toggle');
            }
        }
    });
});


$('.btnpaymentaddress').click(function(e) {
    e.stopImmediatePropagation();

    $.ajax({
        url: '<?php echo BASE_URL; ?>ajax/checkpayment',
        method: 'POST',
        dataType: 'json',
        data: '',

        success: function(response) {
            if (response.success != "1") {
                if (response.tag == "1") {
                    swal("We are Sorry !!", "Choose delivery address", "warning");
                    $('#collapseOne').collapse('toggle');
                    $('#collapseThree').collapse('toggle');
                } else if (response.tag == "3") {
                    location.href = "<?php echo BASE_URL; ?>login";
                } else if (response.tag == "4") {
                    $('#collapseTwo').collapse('toggle');
                    $('#collapseThree').collapse('toggle');
                    swal("We are Sorry !!", "Choose shipping method", "warning");
                } else {
                    swal("We are Sorry !!", "Choose Payment method", "warning");
                }
            } else {
                $('#collapseFour').collapse('toggle');
                $('#collapseThree').collapse('toggle');
            }
        }
    });
});


$('.paynowbtn').click(function(e) {
    e.stopImmediatePropagation();
    window.location.href = '<?php echo BASE_URL ?>checkout/payPalPayment';
    return false;
    $.ajax({
        url: '<?php echo BASE_URL; ?>ajax/checkpayment',
        method: 'POST',
        dataType: 'json',
        data: '',

        success: function(response) {
            if (response.success != "1") {
                if (response.tag == "1") {
                    swal("We are Sorry !!", "Choose your delivery address", "warning");
                    $('#collapseOne').collapse('toggle');
                    $('#collapseFour').collapse('toggle');
                } else if (response.tag == "3") {
                    location.href = "<?php echo BASE_URL; ?>login";
                } else if (response.tag == "4") {
                    $('#collapseTwo').collapse('toggle');
                    $('#collapseFour').collapse('toggle');
                    swal("We are Sorry !!", "Choose shipping method", "warning");
                } else {
                    $('#collapseThree').collapse('toggle');
                    $('#collapseFour').collapse('toggle');
                    swal("We are Sorry !!", "Choose Payment method", "warning");

                }
            } else {
                location.href = "<?php echo BASE_URL; ?>orders";
            }

        }
    });
});



function fnchkCodeAvailable() {
    $('#divcheckavail').parsley().validate();


    if ($('#divcheckavail').parsley().isValid()) {

        var pcode = $("#shippincode").val();
        $.ajax({
            url: '<?php echo BASE_URL;?>ajax/chkzipcode',
            method: 'POST',
            dataType: 'text',
            data: "pin=" + pcode,
            beforeSend: function() {

            },
            success: function(response) {
                if (response == 1) {
                    $("#chkavallerror").css("display", "none");
                    $("#chkavallsucess").css("display", "block");
                    $(".btnaddress").removeAttr("disabled");
                    $("#zipcode").val(pcode);
                } else {
                    $("#chkavallerror").css("display", "block");
                    $("#chkavallsucess").css("display", "none");
                    $(".btnaddress").attr("disabled");
                    $("#zipcode").val('');
                }
            },

        });
    }
}
</script>