<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="light-gray-bg border-bottom my-account">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="heading1 pb-4 text-uppercase color-dark-blue"><?php echo $headdisplaylanguage['myaccount'];?>
                </h1>
            </div>
            <?php include ('includes/my-account-nav.php') ?>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="box-shadow">
                    <h3 class="text-uppercase"><?php echo $headdisplaylanguage['myaddress'];?></h3>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4 class="text-dark mb-3"><?php echo $headdisplaylanguage['savedadd'];?></h4>
                        </div>

                        <div id="addressbind"> </div>
                        <div class="row" id="addresslist">
                            <?php 
							if(count($getmanageaddressdisplay)>0){
				        	foreach($getmanageaddressdisplay as $displayaddress) { ?>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="delivery-address">
                                    <p>
										<i class="flaticon-user-7"></i>
                                        <?php echo $displayaddress['firstname']." ".$displayaddress['lastname']; ?>
									</p>
                                    <p>
										<i class="flaticon-location-fill"></i> 
										<?php echo $displayaddress['address']; ?>
                                        , <?php echo $displayaddress['city']; ?> -
                                        <?php echo $displayaddress['postalcode']; ?> ,
                                        <?php echo $displayaddress['statename'].' - '.$displayaddress['countryname']; ?>
                                    </p>
                                    <p>
										<i class="flaticon-telephone"></i> <?php echo $displayaddress['telephone']; ?>
                                    </p>
                                    <p>
										<i class="flaticon-email-fill-1"></i> <?php echo $displayaddress['emailid']; ?>
                                    </p>
                                    <p class="select-address">
                                        <?php if($displayaddress['address_type']==1){ ?>
                                        <button type="button" class="selected-address" data-mdb-toggle="tooltip"
                                            title="<?php echo $formdisplaylanguage['primaryadd'];?>">
                                            <i class="flaticon-fill-tick"></i>
                                        </button>
                                        <?php }else if($displayaddress['address_type']==2){ ?>
                                        <button type="button" class="selected-address" data-mdb-toggle="tooltip"
                                            title="<?php echo $formdisplaylanguage['secondaddress'];?>">
                                            <i class="flaticon-fill-tick"></i>
                                        </button>
                                        <?php }else if($displayaddress['address_type']==3){ ?>
                                        <button type="button" class="selected-address" data-mdb-toggle="tooltip"
                                            title="Others">
                                            <i class="flaticon-fill-tick"></i>
                                        </button>
                                        <?php } ?>

                                        <button type="button" class="edit-address"
                                            onClick="javascript:editaddress(<?php echo $displayaddress['cus_addressid']; ?>);"
                                            data-mdb-toggle="tooltip"
                                            title="<?php echo $formdisplaylanguage['editaddress'];?>">
                                            <i class="flaticon-edit-1"></i>
                                        </button>

                                        <button type="button" class="delete-address"
                                            onClick="javascript:deladdress(<?php echo $displayaddress['cus_addressid']; ?>);"
                                            data-mdb-toggle="tooltip"
                                            title="<?php echo $formdisplaylanguage['deladdress'];?>">
                                            <i class="flaticon-delete-1"></i>
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <?php } } else { ?>
                            <div class="infotitle shpadd">
                                <span>
                                    <h3> <?php echo $msgdisplaylanguage['noaddress'];?></h3>
                                </span>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="add-delivery-address">
                                <button type="button" class="add-to-cart-btn1 edit-address m-0"
                                    onClick="javascript:addnewaddress(<?php echo $displayaddress['cus_addressid']; ?>);">
                                    ADD NEW DELIVERY ADDRESS </h3>
                                    <i class="flaticon-location-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <form class="show-address" id="addressform" action="" style="display:none;">
                        <div class="row">

                            <input type="hidden" class="form-control" id="customerid" name="customerid"
                                value="<?php echo $_SESSION['Cus_ID']; ?>">
                            <input type="hidden" class="form-control" id="addressid" name="addressid">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h4 class="mb-3"><?php echo $checkoutdisplaylanguage['addeditaddress'];?></h4>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <select class="form-control custom-select" name="address_type" id="address_type">
                                    <option value=""><?php echo $otherdisplaylanguage['select'];?></option>
                                    <option value="1"><?php echo $otherdisplaylanguage['primary'];?></option>
                                    <option value="2"><?php echo $otherdisplaylanguage['secondary'];?></option>
                                    <option value="3"><?php echo $otherdisplaylanguage['other'];?></option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    value="<?php echo $getmanageaddress_autofill['customer_firstname']; ?>"
                                    placeholder="<?php echo $formdisplaylanguage['firstname'];?>" required=''>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    value="<?php echo $getmanageaddress_autofill['customer_lastname']; ?>"
                                    placeholder="<?php echo $formdisplaylanguage['lastname'];?>" required=''>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo $getmanageaddress_autofill['customer_email']; ?>"
                                    placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>" required=''>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="text" class="form-control mobile_num" id="mobileno" maxlength="10" name="mobileno"
                                    value="<?php echo $getmanageaddress_autofill['mobileno']; ?>"
                                    placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" required=''>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="<?php echo $formdisplaylanguage['address'];?>" required=''>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="text" class="form-control" id="landmark" name="landmark"
                                    placeholder="<?php echo $formdisplaylanguage['landmark'];?>">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="<?php echo $formdisplaylanguage['city'];?>" required=''>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <input maxlength="10" type="text" class="form-control mobile_num" id="zipcode" name="zipcode"
                                    placeholder="<?php echo $formdisplaylanguage['zipcode'];?>" required=''>
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
                                <button type="button" class="buy-now-btn1 m-0"
                                    onclick="javascript:Addressform('frmaddress','<?php echo BASE_URL; ?>ajax/Addressform','addressform','Address','<?php echo BASE_URL; ?>manage_address');">
                                    <?php echo $formdisplaylanguage['saveupdate'];?>
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

function addnewaddress() {
    $('html,body').animate({
        scrollTop: $("#addressform").offset().top - 120
    }, 'slow');

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
                unloading();
                $("#addresslist").hide();
                if (response.rslt == "1") {

                    $("#addressbind").html(response.data);
                    var sucmsg = "Saved Successfully";
                    swal("Success!", $stats + ' ' + sucmsg, "success");

                    $("#" + $acts)[0].reset();
                    $("#sel_country").val("");
                    $("#sel_country").trigger('change');
                    $("#sel_state").val("");
                    $("#sel_state").trigger('change');
                } else if (response.rslt == "2") {

                    $("#addressbind").html(response.data);
                    var sucmsg = "Updated Successfully";
                    swal("Success!", $stats + ' ' + sucmsg, "success");

                    $("#" + $acts)[0].reset();
                    document.getElementById("addressform").reset();
                } else {
                    var othmsg = "oops errors!!!";
                    swal("We are Sorry !!", othmsg, "warning");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
}

function editaddress($id) {

    $('html,body').animate({
        scrollTop: $("#addressform").offset().top - 120
    }, 'slow');

    $.ajax({
        url: '<?php echo BASE_URL; ?>ajax/updateaddress',
        method: 'POST',
        dataType: 'json',
        data: 'addid=' + $id,
        beforeSend: function() {
            loading();
        },
        success: function(response) {
            
            $("#address_type").val(response.address_type);
            $("#address_type").trigger('change');
            console.log( response );
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
            getstate(response.country, response.state);
            unloading();
            $("#addressid").val(response.addid);

        },
    });

}

function deladdress($id) {

    swal({
            title: "Are you sure?",
            text: "Do you want to delete this address!",
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
                data: 'addid=' + $id,
                beforeSend: function(){
                    loading();
                },  
                success: function(response) {
                    unloading();
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
                    if (response.rslt == "3") {
                        $("#addresslist").hide();
                        var sucmsg = " Address deleted successfully";
                        swal("Success!", sucmsg, "success");
                        setTimeout(() => {
                            location.reload();
                        }, 200);
                    }

                }
            });

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
                //loading();
            },
            success: function(msg) {
                $("#sel_country").html(msg);
            }
        });
    }
}

$('.mobile_num').keypress(
        function(event) {
            if (event.keyCode == 46 || event.keyCode == 8) {
                //do nothing
            } else {
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
            }
        }
    );

</script>