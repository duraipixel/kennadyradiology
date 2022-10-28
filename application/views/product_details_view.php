<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/product-zoom.css" media="all">
<style type="text/css">
.chiller_cb {
    margin-bottom: 10px;
}

.product_quantity_panel {
    display: none;
}
</style>
<?php 

?>

<section class="product-details-bg">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-4 col-lg-6">
                <div class="show-on-scroll">
                    <h1 class="product-name"> <?php echo $productdetails->product_name; ?> </h1>
                    <div id="detailspricewrapers" class="detailsprice-wraper"></div>
                   
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-6 text-right">
                <?php 
                // print_r( getCartProductQty($productdetails->product_id) );
                ?>
                <button type="button" class="add-to-cart-btn1" onclick="addtocart('<?= $productdetails->product_id ?>')" ;="">
                    Add to cart <i class="flaticon-cart-bag"></i>
                </button>
                <button type="button" class="buy-now-btn1" onclick="addtocart('<?= $productdetails->product_id ?>', 'checkout')" ;="">
                    Buy Now <i class="flaticon-cart-2"></i>
                </button>
                <span id="detailspricewraper" class="detail-price">
                    <?php echo PRICE_SYMBOL. number_format($productdetails->productprice,2); ?>
                </span>
                <input type="hidden" name="product_price" id="product_price" value="<?= $productdetails->productprice ?>" >

				<div class="input-group quantity-buttons">
				    <h6><?php echo $commondisplaylanguage['quantity'];?></h6>
                    <span class="input-group-btn">
                        <button type="button"
                            onClick="qtyremove(<?php echo $productdetails->product_id; ?>)"
                            class="quantity-left-minus" data-type="minus" data-field="">
                            <span class="flaticon-minus-2"></span>
                        </button>
                    </span>
                    <input type="number" class="form-control input-number chkqtydetail"
                        id="prices1_<?php echo $productdetails->product_id; ?>"
                        min="<?php echo $productdetails->minquantity ?? 1; ?>" max="50" disabled
                        value="<?php echo getCartProductQty($productdetails->product_id) ?? getCartProductQty($productdetails->product_id) ?? 1; ?>" name="product_qty">

                    <span class="input-group-btn">
                        <button type="button"
                            onClick="qtyaddition(<?php echo $productdetails->product_id; ?>)"
                            class="quantity-right-plus" data-type="plus" data-field="">
                            <span class="flaticon-plus-1"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div id="productimage">
                    <?php require('partial/products_image_change.php') ?>
                </div>
                <div class="tap-to-zoom">Tap Image to Zoom <i class="flaticon-search"></i></div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="pad-lef-30">
                    <h1 class="product-name"><?php echo $productdetails->product_name; ?> 
                        <strong class="sku"><?php echo $commondisplaylanguage['sku'];?>#
                            <span id="spnsku"><?php echo $productdetails->productsku; ?><span>
                        </strong>
                    </h1>
                   
                    <div id="detailspricewraper1" class="detailsprice-wraper">
                    <?php 
					if($productdetails->isbuynow == 0) {
					    if($productdetails->soldout==0) { 
                    ?>
                        <h5 class="text-orange" id="displayprice">
                            
                            <?php echo PRICE_SYMBOL. number_format($productdetails->productprice,2); ?>                  
                        </h5>
                            <input type="hidden" name="product_price" id="product_price" value="<?= $productdetails->productprice ?>" >
                    <?php    } else { ?>
                        <?php echo $detaildisplaylanguage['soldout'];?><br>
                    <?php    
                        }
                    }
                    ?>
                    </div>

                    <p class="product-description"> <?php echo $productdetails->description; ?></p>
                    <?php
						$fInfo 	= $repository->productPricevariationFilter( $producturl );
						// ss( $productfilter );
						?>
                    <div class="productcolor-details" id="divcustomattr">
                        <?php 
                        include('partial/products_filter_change.php');
                        ?>
                    </div>
                 
                </div>
                <?php   
					$childsid 				= $helper->getChildsId();
					$arrexcludecat 			= explode(",",$childsid);
					$max_dp 				= ($productdetails->final_price_tax*$getmaximum_dp['max_discnt_slap'])/100;
					$maxdiscountamtfp 		= ($productdetails->final_price_tax - $max_dp);
				?>
                <div class="pad-lef-30 <?php if($strattrHTML != ''){?><?php }?>">
                    <div class="row" class="product_quantity_panel">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           

                            <?php if($productdetails->brochureimage != ''){?>
                            <a class="add-to-cart-btn1 download-btn mb-xl-3"
                                href="<?php echo img_base; ?>uploads/brochure/<?php echo $productdetails->brochureimage; ?>"
                                target="_blank"><?php echo $detaildisplaylanguage['downloadpdf'];?><i
                                    class="flaticon-download pr-2 fa-lg"></i></a>
                            <?php }?>

                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <a href="javascript:void(0);" id="productCustomization" class="add-to-cart-btn1 mt-2 mb-2">
                            <i class="flaticon-pencil-1 ml-0"></i> &nbsp; Product Customization
                        </a>

                        <a href="<?php echo img_base;?>knowledgecenter" class="blue-btn2 mt-2 mb-2"
                            onClick="return getquoteform()">
                            <i class="flaticon-bell-9 ml-0"></i> &nbsp; Visit Knowledge Center
                        </a>
                    </div>
                </div>
            </div>
        </div>
</section>


<section class="light-gray-bg" style="position: relative;">
    <img class="rellax swing1" data-rellax-speed="4" src="<?php echo img_base;?>/static/images/bg-2.png" alt="" />
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="accordion" id="product-details-accordion">

                    <div class="card">
                        <div class="card-header" id="overview">
                            <a href="#" class="btn-header-link" data-toggle="collapse" data-target="#overview"
                                aria-expanded="true"
                                aria-controls="overview"><?php echo $commondisplaylanguage['overview'];?> </a>
                        </div>

                        <div id="overview" class="collapse show" aria-labelledby="overview"
                            data-parent="#product-details-accordion">
                            <div class="card-body">
                                <?php echo $productdetails->longdescription ;?>
                            </div>
                        </div>
                    </div>
                    <?php
					 	$i = 0;
						foreach($productattributes as $val){	
 					
							if(strip_tags($val["value"]) != ''){
						?>
                    <div class="card">
                        <div class="card-header" id="dynamic_<?php echo $i;?>">
                            <a href="#" class="btn-header-link collapsed" data-toggle="collapse"
                                data-target="#dynamic_<?php echo $i;?>" aria-expanded="true"
                                aria-controls="dynamic_<?php echo $i;?>"><?php echo $val["attributename"];?></a>
                        </div>

                        <div id="dynamic_<?php echo $i;?>" class="collapse" aria-labelledby="dynamic_<?php echo $i;?>"
                            data-parent="#product-details-accordion">
                            <div class="card-body">
                                <?php echo $val["value"];?>
                            </div>
                        </div>
                    </div>
                    <?php $i++;}
							}?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    if( isset( $bestSellingProductLists ) && !empty( $bestSellingProductLists ) )  {
        $productItems = $bestSellingProductLists;
        $title = 'Related products';
        include('partial/productSliderPane.php');
    }
	?>
<?php
		//  $data=$helper->displayproductsilder('','bestselling','Related products','','10','','','nt-wtn');	    
	?>
	
	<section class="why-choose-us">
    <span class="home-bg-heading1">Why Choose Us</span>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="why-choose-us-content">
                    <h3>Why Choose Us</h3>
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-9.png" alt="" /> 40+ years of
                            <br />Experience
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-1.png" alt="" /> High Quality,
                            <br />Reliable Products
                        </li>
                        <li data-aos="fade-up" data-aos-delay="150" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-2.png" alt="" /> First-Rate <br />Raw
                            Materials
                        </li>
                        <li data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-10.png" alt="" /> Industry
                            Accreditations <br />&amp; Safety Standards
                        </li>
                        <li data-aos="fade-up" data-aos-delay="250" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon.png" alt="" /> Made in <br />USA
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="get-a-quote" id="quoteforms" style="padding:70px 0px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6">
                <h5><?php echo $detaildisplaylanguage['getaquote'];?></h5>
                <form id="jvalidate" name="frmRequest" action="#" method="post">
                    <input type="hidden" name="eproductid" id="eproductid"
                        value="<?php echo $productdetails->product_id;?>">
                    <div class="row">


                        <div class="col-sm-12 col-md-6">
                            <input readonly type="text" class="form-control" name="eproduct_name" id="eproduct_name"
                                placeholder="<?php echo $detaildisplaylanguage['productname'];?>"
                                value="<?php echo $productdetails->product_name; ?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" required='' name="companyname" id="companyname"
                                placeholder="<?php echo $detaildisplaylanguage['organizationname'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" required name="txtname" id="txtname"
                                placeholder="<?php echo $formdisplaylanguage['firstname'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" required name="txtlname" id="txtlname"
                                placeholder="<?php echo $formdisplaylanguage['lastname'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="email" class="form-control" required name="txtemail" id="txtemail"
                                placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="tel" class="form-control" required name="txtmobile" id="txtmobile"
                                minlength="5" maxlength="15" class="jsrequired"
                                onkeyup="return isNumberupdate(event,this)"
                                onKeyPress="return isNumberupdate(event,this)"
                                onKeyDown="return isNumberupdate(event,this)" onpaste="return false;"
                                placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" class="form-control" name="txtcomment" id="txtcomment"
                                placeholder="<?php echo $detaildisplaylanguage['typetext'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                            <button type="button" onClick="btnsaveQuote()" class="get-a-quote-btn">
                                &nbsp; <?php echo $commondisplaylanguage['submit'];?>&nbsp;
                            </button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>



<script src="<?php echo img_base; ?>/static/js/product-zoom.js"></script>
<div class="modal fade" id="getaQuoteModal" tabindex="-1" aria-labelledby="getaQuoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"><i
                        class="flaticon-cancel-12"></i></button>
                <h3 class="text-center"><?php echo $detaildisplaylanguage['getaquote'];?></h3>
                <div class="row">
                    <form id="jvalidate" name="frmRequest" action="#" method="post">
                        <input type="hidden" name="eproductid" id="eproductid"
                            value="<?php echo $productdetails->product_id;?>">
                        <div class="col-sm-12 col-md-6">
                            <input readonly type="text" class="form-control" name="eproduct_name" id="eproduct_name"
                                placeholder="<?php echo $detaildisplaylanguage['productname'];?>"
                                value="<?php echo $productdetails->product_name; ?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" required='' name="companyname" id="companyname"
                                placeholder="<?php echo $detaildisplaylanguage['organizationname'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" required name="txtname" id="txtname"
                                placeholder="<?php echo $formdisplaylanguage['firstname'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" required name="txtlname" id="txtlname"
                                placeholder="<?php echo $formdisplaylanguage['lastname'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="email" class="form-control" required name="txtemail" id="txtemail"
                                placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="tel" class="form-control" required name="txtmobile" id="txtmobile"
                                minlength="5" maxlength="15" class="jsrequired"
                                onkeyup="return isNumberupdate(event,this)"
                                onKeyPress="return isNumberupdate(event,this)"
                                onKeyDown="return isNumberupdate(event,this)" onpaste="return false;"
                                placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" class="form-control" name="txtcomment" id="txtcomment"
                                placeholder="<?php echo $detaildisplaylanguage['typetext'];?>" />
                        </div>
                        <div class="col-sm-12 col-md-12 text-center">
                            <button type="button" onClick="btnsaveQuote()" class="add-to-cart-btn1">
                                &nbsp; <?php echo $commondisplaylanguage['submit'];?>&nbsp;
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$("#productCustomization").click(function() {
    $('html, body').animate({
        scrollTop: $("#quoteforms").offset().top - 100
    }, 'slow');
});
</script>


<script type="text/javascript">
$(document).ready(function() {
    $('#glasscase').glassCase({
        'thumbsPosition': 'bottom'
    });
});

function btnsaveQuote() {

    $('#jvalidate').parsley().validate();

    if ($('#jvalidate').parsley().isValid()) {
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: "<?php echo BASE_URL; ?>ajax/saveproductQuote",
            data: $("#jvalidate").serialize(),
            beforesend: loading(),
            cache: false,
            success: function(response) {
                unloading();
                if (response.rslt == "0") {
                    $('#txtname').val('');
                    $('#txtemail').val('');
                    $('#txtmobile').val('');
                    $('#Address').val('');
                    $('#txtcomment').val('');
                    $('#quoteforms').hide();
                    swal({
                            title: "Request Submitted Successfully",
                            text: " ",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#66A342",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true
                        },
                        function() {});


                } else if (response.rslt == "2") {
                    swal("Failure!", "Category Field Required", "warning");
                } else if (response.rslt == "3") {
                    swal("Failure!", "Product Field Required", "warning");
                } else {
                    swal("Failure!", "You have already sent a request for this product'", "warning");
                }
            },
            error: function(msg) {
                unloading();
            }
        });

    }

}
</script>

<script type="text/javascript">
function prodattrchange(attribute_id, product_sku, dropdown_id, attrcode) {

    $('.' + attrcode + '-single input').removeAttr('checked');
    $('#' + attrcode + '_' + dropdown_id).prop("checked", "checked");

    var path = '<?php echo BASE_URL; ?>ajax/prodattrchange'
    var tsku = '';
    if (product_sku == '')
        tsku = '<?php echo $product_sku;?>'
    else
        tsku = product_sku;
    var data = "";
    if (dropdown_id != '') {
        if ($("#color_" + dropdown_id).length) {
            $("#color_" + dropdown_id).prop("checked", "checked");
        }
    }
    data = "attribute_id=" + attribute_id + "&dropdown_id=" + dropdown_id + "&attrcode=" + attrcode +
        "&proid=<?php echo $productdetails->product_url; ?>&sku=" + tsku + "&" + $("#frmcustomattr").serialize();

    $.ajax({
        url: path,
        contentType: "application/json",
        method: 'POST',
        dataType: 'json',
        data: JSON.stringify(data),
        beforeSend: function() {
            loading();
        },
        success: function(response) {
            unloading();
            if (response.status == "200") {
                $('input[name=product_qty]').val( 1 );
                $("#detailspricewraper,#displayprice").html("");
                $("#detailspricewraper,#displayprice").html(response.rslt);
                $('#product_price').val(response.rslt);
                if ($('.singleprd-slider').hasClass('slick-initialized')) {
                    $('.singleprd-slider').slick('destroy');
                }
                if ($('.thumbnailprd-slider').hasClass('slick-initialized')) {
                    $('.thumbnailprd-slider').slick('destroy');
                }

                $("#productimage").html("");
                $("#productimage").html(response.changeimg);
                $("#spnsku").html(response.product_sku);
                $("#divcustomattr").html("");
                $("#divcustomattr").html(response.filter_content);

                $('#glasscase').glassCase({
                    'thumbsPosition': 'bottom'
                });

                if ($(window).width() > 767) {
                    $('.imgBox').imgZoom({
                        boxWidth: 400,
                        boxHeight: 400,
                        marginLeft: 15,
                    });
                }

                try {
                    var actWidth = $("#features-tab .nav-tabs").find(".active").parent("li").width();
                    var actPosition = $("#features-tab .nav-tabs .active").position();
                    $("#features-tab .slider").css({
                        "left": +actPosition.left,
                        "width": actWidth
                    });
                } catch (e) {}
            } else {
                swal("Failure!", response.msg, "warning");
            }
        },
    });
}

function prodattrchange1(aid, sku, did) {

    var path = '<?php echo BASE_URL; ?>ajax/prodattrchange'
    var tsku = '';
    if (sku == '')
        tsku = '<?php echo $sku;?>'
    else
        tsku = sku;
    var data = "";
    if (did != '') {
        if ($("#color_" + did).length) {
            $("#color_" + did).prop("checked", "checked");
        }
    }
    data = "proid=<?php echo $productdetails->product_url; ?>&sku=" + tsku + "&" + $("#frmcustomattr1").serialize();
    $.ajax({
        url: path,
        contentType: "application/json",
        method: 'POST',
        dataType: 'json',
        data: JSON.stringify(data),
        beforeSend: function() {
            loading();
        },
        success: function(response) {
            unloading();
            $("#customdetailsprice").html("");
            $("#customdetailsprice").html(response.rslt);
        },

    });
}

$('.quantity').each(function() {
    var spinner = $(this),
        input = spinner.find('input[type="text"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max'),
        step = parseFloat(input.attr('step'));
    //	console.log(step);

    btnUp.click(function() {
        //console.log(step);
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + step;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function() {

        //	console.log(step);
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - step;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

});


if ($(window).width() > 767) {
    $('.imgBox').imgZoom({
        boxWidth: 400,
        boxHeight: 400,
        marginLeft: 15,
    });
}




/*produtdeatil slider*/
$(".singleprd-slider").slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.thumbnailprd-slider'
});

$(".thumbnailprd-slider").slick({
    slidesToShow: 4,
    infinite: false,
    arrows: true,
    autoplay: false,
    vertical: false,
    verticalSwiping: true,
    autoplaySpeed: 4000,
    slidesToScroll: 1,
    asNavFor: '.singleprd-slider',
    focusOnSelect: true,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,


            }
        },
        {
            breakpoint: 767,
            settings: {

                slidesToShow: 4,
                vertical: false,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {

                slidesToShow: 3,
                vertical: false,
                slidesToScroll: 1
            }
        }
    ]
});
/**/




<?php if(count($productfilter)>0)  {
		 $tempfilter=array();
			foreach($productfilter as $f) { 
			if(!in_array($f['attributecode'], $tempfilter)) {
			?>

$(".<?php echo $f['attributecode'];?>-single").click(function() {
    $(".<?php echo $f['attributecode'];?>-single").removeClass("active");
    $(this).addClass("active");
});
<?php 
		$tempfilter[]=$f['attributecode'];
		} ?>
<?php } ?>
<?php } ?>

$(".customize-product").click(function() {


});



$('.branding-options').select2({
    containerCssClass: "header-country-container",
    dropdownCssClass: "header-dropdown-container"

});



function closeiframe() {
    document.getElementById("popwidg").style.display = "none"
    $("body").removeClass("modal-open");
    $(".fpd-container").removeClass("fpd-active");
    $(".fpd-navigation>div").removeClass("fpd-active");

}

function openiframe() {
    document.getElementById("popwidg").style.display = "block";
    $("body").addClass("modal-open");






}
$(function() {

    <?php if($productdetails->longdescription != ''){?>
    $('#overview-tab').trigger('click');
    <?php }?>

    <?php if(isset($_REQUEST['customized'])) { ?>
    openiframe();
    <?php } ?>
});


$('.products').fancybox({
    // Options will go here
});


/*
$(".popwrapbox-inner").mCustomScrollbar({
	theme:"dark"
});*/

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
                    $("#btnaddtocart").removeClass("disabled");
                } else {
                    $("#chkavallerror").css("display", "block");
                    $("#chkavallsucess").css("display", "none");
                    $("#btnaddtocart").addClass("disabled");
                }
            },

        });
    }

}

$('.other-categories-slider').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: false,
    responsive: [{
            breakpoint: 1320,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 700,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
    ]
});


function qtyaddition(id) {

    var quantitiy = 1;
    var quantity = parseInt($('#prices1_' + id).val());
    quantity = quantity + 1;
    $('#prices1_' + id).val(quantity);
    // $.ajax({
    //     url: '<?php echo BASE_URL;?>cart/addOrRemoveCartQuantity',
    //     type: 'POST',
    //     data:{product_id:id, quantity:quantity },
    //     dataType: 'json',
    //     beforeSend: function() {
    //         loading();
    //     },
    //     success: function(){

    //     }
    // })
}

function qtyremove(id) {

    var quantity = parseInt($('#prices1_' + id).val());
    quantity = quantity - 1;

    if (quantity > 0) {
        $('#prices1_' + id).val(quantity);
    }

}
</script>

<script>
/*	$(".chiller_cb").click(function () {
		$('.chiller_cb').removeClass('checked');
		$('.size-single input').removeAttr('checked');
		$('.chiller_cb.size-single').removeClass('active');
		$(this).find('input').attr("checked", "checked");
		$(this).addClass('checked');
	}); */


$('.clinical-img').slick({
    dots: false,
    arrows: true,
    infinite: false,
    autoplay: true,
    speed: 300,
    loop: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    variableWidth: false,
});

$('.clinical-img1').slick({
    dots: false,
    arrows: true,
    infinite: false,
    autoplay: true,
    speed: 300,
    loop: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: false,
    responsive: [{
            breakpoint: 1100,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        },
        {
            breakpoint: 560,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }
    ]
});
</script>

<div class="modal" id="sizeChartModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Size Chart</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php echo $productsizechart['attribute_value'];?>
            </div>
        </div>
    </div>
</div>