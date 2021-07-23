<?php  include ('includes/top.php') ?>
<style>
.productpagenation {
display:none;
}
</style>
<body class="white-bg" onbeforeunload='reset_options()' >
<?php include ('includes/header.php') ?>
<?php 
//print_r($GLOBALS['allcategories']); die();
   $catinfo=$helper->searchkeyArray($catid,$GLOBALS['allcategories'],'categoryID');
  if($catinfo['catimage'] != ''){
?>
<section class="product-listing-banner">
  <div class="container-fluid pl-0 pr-0">
    <div class="row no-gutters align-items-center">
      <div class="col"> <img src="<?php echo BASE_URL;?>uploads/category/<?php echo $catinfo['catimage']?>" alt="" class="img-fluid" /> </div>
    </div>
  </div>
</section>
<?php }else{
?>
<!-- Product Listing Starts -->
<section class="product-listing-banner">
  <div class="container-fluid pl-0 pr-0">
    <div class="row no-gutters align-items-center">
      <div class="col"> <img src="<?php echo BASE_URL;?>static/images/product-listing/banner.jpg" alt="" class="img-fluid" /> </div>
    </div>
  </div>
</section>
<?php }?>
<!-- Product Listing End --> 

<!-- Sort Section Starts -->
<section class="sort mt-1 mb-3">
  <div class="container sort-border">
    <div class="row">
      <div class="col-12">
        <ul>
          <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
          <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
          <?php
							$arrbread=array();
							$helper->getProductBread($catinfo['categoryID'],$arrbread);
							
							$breadpath='';
							for($a=count($arrbread)-1;$a>=0;$a--){
								$breadpath.=$arrbread[$a]['code'].'/';
					  ?>
          <li><a href="<?php echo BASE_URL.$breadpath;?>"><?php echo $arrbread[$a]['name']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Sort Section End --> 
<!-- Filter Section Starts -->
 <div class="container">
 <div class="row">
  <div class="col-sm-12 col-md-4 col-lg-2 col-xl-2">
<section class="filter filter-bg mt-3 mb-3">
 
    <!--<div class="row">
      <div class="col">
        <p class="filter-showing">Ear Phones ( Showing 1 – 15 products of 25 products )</p>
      </div>
    </div>-->
    <div class="row">
	<div class="col-sm-12 col-md-12">
	
    <form id="frmcmnfilter">
        
      
      <!-- Filter Section End -->	

<?php $pagename="productlist";
include_once("partial/productlist-menu.php"); ?>
      </form>
	  
	  </div>
	  </div>
      <!--<div class="col-12 col-sm-6">
        <form class="search">
          <div class="search__wrapper">
            <input type="text" name="" placeholder="Search for..." class="search__field">
            <button type="submit" class="fa fa-search search__icon"><i class="lni lni-search-alt"></i> Search</button>
          </div>
        </form>
      </div>-->
	
	
  
</section>
</div>
<div class="col-sm-12 col-md-8 col-lg-10 col-xl-10">


<div class="col-sm-12 col-md-4 col-lg-3" align="right" style="float:right">
		
			<form id="frmsortby" class="">
          <select class="custom-select" name="selsortby" onChange="fnAttrChanged();" id="sel1">
            <?php  foreach($SortBy as $srt) { ?>
            <option value="<?php echo $srt['SortId'] ?>"><?php echo $srt['SortName'] ?></option>
            <?php } ?>
          </select>
         
        </form>
		<small class="sortby-text">Sort By</small>
	</div>
    
    
    <!--<div class="row" id="filter-show">		
		<div class="col-sm-12 col-md-12">
			<div class="filter-show">
				 
                <span id="filterdisplay"></span>
                <span id="filterdisplay1"></span>
                
				 
		&nbsp;&nbsp;&nbsp;	
			<a class="pull-right pt-1" href="javascript:void(0);" title="Clear All" onClick="clearallfilter();"><i class="fa fa-times-circle text-warning" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>-->
    
    
<div id="divproductlists">
  <?php include_once("partial/products_lists.php"); ?>
</div>

</div>
</div>
</div>

<?php if($maincat == 'corporate-gifts'){?>
<div id="catalogueform">
<?php include('partial/catalogueenquiry.php');?>
</div>
<?php }?>

<!-- Bottom Image Section Starts -->
<?php if(count($promotionbanner) > 0){?>
<section class="bottom-image">
  <div class="container-fluid pl-0 pr-0">
    <div class="banner">
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade"  data-interval="false">
        <ol class="carousel-indicators">
          <?php $i = 0;foreach($promotionbanner as $bannerslider) { ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
          <?php $i++;}?>
        </ol>
        <div class="carousel-inner">
          <?php $i = 1;foreach($promotionbanner as $bannerslider) { ?>
          <div class="carousel-item <?php echo ($i == 1) ? 'active' : '';?>"><a href="<?php echo $bannerslider['banner_link'];?>" target="_blank"><img class="carousel-img" src="<?php echo BASE_URL;?>uploads/banners/<?php echo $bannerslider['bannerimage'];?>" alt="First slide"> </a></div>
          <?php $i++;}?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>
<!-- Bottom Image Section End -->




<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script src="<?php echo BASE_URL; ?>static/js/jquery-ias.min.js"></script>

<script type="text/javascript">
$('#filter-show').hide();
function toggleIcon(e) {
	    $(e.target)
	        .prev('.panel-heading')
	        .find(".more-less")
	        .toggleClass('glyphicon-plus glyphicon-minus');
	}
	$('.panel-group').on('hidden.bs.collapse', toggleIcon);
	$('.panel-group').on('shown.bs.collapse', toggleIcon);


	var windowWidth = $(window).width();
	if(windowWidth > 767){
			/*var tallness = $(".productcontainer").height();
			$(".panel-group").css("min-height" , tallness);
			$(window).scroll(function(){
				var tallness = $(".productcontainer").height();
				$(".panel-group").css("min-height" , tallness);
			});*/
	}
	else{
		$(".filtertrigger").click(function(){
			$(".collapsemenu-wraper").fadeIn();
		});
		$(".filter-close, .apply-btn").click(function(){
			$(".collapsemenu-wraper").fadeOut();
		});
	}

	
	
	
/*collapse menu*/
$('.collapsemenu .collapse').on('show.bs.collapse', function (e) {
			//alert(e.target);
			//$(e.target).closest('li').siblings().find('.collapse').collapse('hide');
});
$('.collapse').on('shown.bs.collapse', function (e) {
var $panel = $(this).closest('li');
$('html,body').animate({
	scrollTop: $panel.offset().top - 160 },
	700);
});
/*collapse menu end*/


$(".select2").select2({
		/*placeholder: "Category",*/
		minimumResultsForSearch: -1
		
	});

  </script>
<script>
  
  /*
 $(function() {
    $(".prolistview").scroll(function() {
        var $this = $(this);
        var $results = $("#results");

        if (!$results.data("loading")) {

            if ($this.scrollTop() + $this.height() == $results.height()) {
                loadResults();
            }
        }
    }); 
	$(window).scroll(function(){
		  if($(window).scrollTop() + $(window).height() == $(document).height() && $(".prolistview").length!=0){
		   alert("ggg");
		  }
	});
}); */
  
 var $slider;
  $(document).ready(function(){
	  $('#catalogueform').hide();
	  /*
  $(function() {
      $("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [114, 400],
        slide: function(event, ui) {
          $("#min_price").val(ui.values[0]);
          $("#max_price").val(ui.values[1]);
        }
      });
      $("#min_price").val($("#slider-range").slider("values", 0));
      $("#max_price").val($("#slider-range").slider("values", 1));
      $("#min_price").change(function() {
        $("#slider-range").slider("values", 0, $(this).val());
      });
      $("#max_price").change(function() {
        $("#slider-range").slider("values", 1, $(this).val());
      })
    }); */
	
	$('#price-range-submit').hide();

	$("#min_price,#max_price").on('change', function () {
	

	  $('#price-range-submit').show();

	  var min_price_range = parseInt($("#min_price").val());

	  var max_price_range = parseInt($("#max_price").val());

	  if (min_price_range > max_price_range) {
		$('#max_price').val(min_price_range);
	  }

	$slider = $("#slider-range").slider({
		values: [min_price_range, max_price_range]
	  });
	  
	});


	$("#min_price,#max_price").on("paste keyup", function () {                                        
	
	  $('#price-range-submit').show();

	  var min_price_range = parseInt($("#min_price").val());

	  var max_price_range = parseInt($("#max_price").val());
	  
	  if(min_price_range == max_price_range){

			max_price_range = min_price_range + 100;
			
			$("#min_price").val(min_price_range);		
			$("#max_price").val(max_price_range);
	  }

	  $("#slider-range").slider({
		values: [min_price_range, max_price_range]
	  });

	});


	$(function () {
	$slider= $("#slider-range").slider({
		range: true,
		orientation: "horizontal",
		min: <?php echo !empty($fliter_price['minprice'])?floor($fliter_price['minprice']):'0'; ?>,
		max: <?php echo !empty($fliter_price['maxprice'])?ceil($fliter_price['maxprice']):'0'; ?>,
		values: [<?php echo !empty($fliter_price['minprice'])?floor($fliter_price['minprice']):'0'; ?>, <?php echo !empty($fliter_price['maxprice'])?ceil($fliter_price['maxprice']):'0'; ?>],
		step: 1,

		slide: function (event, ui) {
		  if (ui.values[0] == ui.values[1]) {
			  return false;
		  }
		  
		  $("#min_price").val(ui.values[0]);
		  $("#max_price").val(ui.values[1]);
		
		},
		stop: function( event, ui ) {   fnAttrChanged(); }
	  });

	  $("#min_price").val($("#slider-range").slider("values", 0));
	  $("#max_price").val($("#slider-range").slider("values", 1));
		
	});

	
	
	
	$("#slider-range,#price-range-submit").click(function (){

	  var min_price = $('#min_price').val();
	  var max_price = $('#max_price').val();

	  $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
	});

});

  
/*News section slider Starts*/

	$('.vericalslider').slick({
	  dots: false,
	  infinite: true,
	  speed: 1000,
	  arrows: false,
	  vertical: true,
	  autoplay: true,
	  autoplaySpeed: 2000,
	});
	/*News section slider Ends*/

function pricevaluechange(cval,id)
{
	var mval=$("#minval").val();
	var mxval=$("#maxval").val();
	
	if(parseInt(mval)<=parseInt(cval) && parseInt(mxval)>=parseInt(cval))
	{
		
		fnAttrChanged();
	}
	else{		
		if(id=="min_price")
		{
			$("#"+id).val($("#minval").val());
		}
		else{
			$("#"+id).val($("#maxval").val());
		}
	}
	
}

function fnAttrChanged()
{
	
		var categoryarray = new Array();
		 var colorarray = new Array();
		
		$("input[name='subcatid[]']:checked").each(function(){
			var bodytext = '<div class="alert alert-dismissible fade show" role="alert">'+$(this).next('label').text()+'<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="return removeFilter(1,'+$(this).val()+')"><span aria-hidden="true">&times;</span></button></div>';
			categoryarray.push(bodytext);
		});
		
		$("input[name='attr[]']:checked").each(function(){
			var bodytext1 = '<div class="alert alert-dismissible fade show" role="alert">'+$(this).next('label').text()+'<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="return removeFilter(2,'+$(this).val()+')"><span aria-hidden="true">&times;</span></button></div>';
			colorarray.push(bodytext1);
		});


		if (categoryarray.length === 0 && colorarray.length === 0) {
			   $('#filter-show').hide();
		 }
		 else{
			 $('#filter-show').show();
			 $('#filterdisplay').html(categoryarray);
			  $('#filterdisplay1').html(colorarray);
		 }
		 
		  
	jQuery.ias().unbind();
	var url='<?php echo BASE_URL; ?>ajax/products/<?php echo $catid; ?>/1/';
	$.ajax({
            url: url,
			method     : 'POST',
			dataType   : 'text',
            data: $('#frmcmnfilter').serialize()+$('#productlistaside :input').serialize()+'&'+$('#frmsortby').serialize()+"&isajax=1",
			beforeSend: function() {
				 loading();
 			},
            success: function (response) {
				unloading();                $("#divproductlists").html(response);

				//$(".select2").select2();
            }
        });
}

function removeFilter(typefor,typeid){
	if(typefor == 1){
		$("#category"+typeid).prop('checked', false); 
		$('#category'+typeid).trigger('change');
	}else if(typefor == 2){
				$("#attr"+typeid).prop('checked', false); 
		$('#attr'+typeid).trigger('change');

	}
}

function fnCategoryChanged(id)
{
	
	jQuery.ias().unbind();
	var url='<?php echo BASE_URL; ?>ajax/products/'+id+'/1/';
	$.ajax({
            url: url,
			method     : 'POST',
			dataType   : 'text',
            data: $('#productlistaside :input').serialize()+'&'+$('#frmsortby').serialize()+"&isajax=1",
			beforeSend: function() {
				//loading();
 			},
            success: function (response) {
               $("#divproductlists").html(response);
			//	$(".select2").select2();
            }
        });
}


function clearallfilter()
{
	
	window.location.href = "<?php echo BASE_URL.$getactmenu[0];?>";
  	$('#productlistaside').find("input[type=checkbox]").prop('checked', false);
	fnAttrChanged();

	$slider.slider("values", 0,<?php echo !empty($fliter_price['minprice'])?floor($fliter_price['minprice']):'0'; ?>);
	$slider.slider("values", 1, <?php echo !empty($fliter_price['maxprice'])?ceil($fliter_price['maxprice']):'0'; ?>);
	
	$("#min_price").val('<?php echo !empty($fliter_price['minprice'])?floor($fliter_price['minprice']):'0'; ?>');
	$("#max_price").val('<?php echo !empty($fliter_price['maxprice'])?ceil($fliter_price['maxprice']):'0'; ?>');
	
	
}


</script>
<script>
function reset_options() {
    document.getElementById('sel1').options.length = 0;
    return true;
}

</script>
<script type="text/javascript">
	$('#catalogueform').hide();

function addtocart(proid,wishproid='',wishlist='')
{               //alert(proid);
	            var minqty = $("#prices1_"+proid).val();
	            
			
                var urll = '<?php echo BASE_URL; ?>ajax/addtocart_insert'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'proid='+proid+'&minqty='+minqty+'&wishproid='+wishproid+'&wishlist='+wishlist+"&"+$(".frmcustomattr_"+proid).serialize(),
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					
					 // alert(response.rslt);
					if(response.rslt == "1"){
						$("#carcnt").html(response.cartcount);
						var sucmsg = "Product is added to the Cart successfully.";
						swal("Success!",sucmsg, "success");
						listcartcount();
							
					}
					else if(response.rslt == "2"){
						var upmsg="To edit quantity please edit on the cart page";
						swal("Item Added to Cart!",upmsg, "warning");
						
					}
					else if(response.rslt == "3"){ 
					
					 var upmsg="The Minimum Order Quantity for this product is "+response.proqty;
						swal("We are Sorry !!",upmsg, "warning");	
					}
                    else if(response.rslt == "4"){
						swal("We are Sorry !!",response.price, "warning");

					}						
					
					if(response.wishlist == "wishlistdelete"){
						Movewishlistpage(); 
					}
					

				},

			});
}	


function addtocatalogue_insert(){
	 
	if($('input[name="corpcatalogue[]"]:checked').length == 0)
    {
		$('#catalogueform').hide();
        swal("We are Sorry !!",'Please select atleast one checkbox', "warning"); 
    }else{
		
		$('#catalogueform').show();
		
		 
				$.ajax({
				url        : '<?php echo BASE_URL; ?>ajax/addtocatalogue_insert',
				method     : 'POST',
				dataType   : 'json',   
				data       : $('input[name="corpcatalogue[]"]:checked').serialize(),
				beforeSend: function() {
					//alert("responseb");
					 //loading();
				},
				success: function(response){
				 
					$('#catalogueform').show();
					 
					if(response.rslt == 1){
					$('#catalogueform').show();
					} 
					}
				});
	}
}


  function generateCatalogue($acts,$urll,$lodlnk)
   {
		//alert("reach");
		//return false;
		//alert($acts);
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
	 
			//$("button").attr('disabled',false);
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
					 loading();
				},
				success: function(response){
					//SaveDownloadpdfcatalog
					  
					if(response.rslt == "1"){
						//var sucmsg = "Contact form saved Successfully";
						//swal("Success!",sucmsg, "success");
						
						
						 
						 $.ajax({
				url        : '<?php echo BASE_URL; ?>ajax/SaveDownloadpdfcatalog',
				method     : 'POST',
				dataType   : 'html',   
				data       : "cid="+response.cid,
				beforeSend: function() {
					//alert("responseb");
					  loading();
				},
				success: function(response){
					
					 swal("Success!",'Mail sent Successfully', "success");
					  $("#productEnquiry")[0].reset();
					 $('#catalogueform').hide();
					 
					 
					if(response.rslt == "1"){
					 swal("Success!",'Mail sent Successfully', "success");
					  $("#productEnquiry")[0].reset();
					 $('#catalogueform').hide();
					}
					 else if(response.rslt == "-1"){
						var upmsg="Error";
						swal("We are Sorry !!",response.error_msg, "warning");
						
					}
					
					
					   unloading();
					   
					 
					}
				});
				
				
					}
					else if(response.rslt == "-1"){
						var upmsg="Error";
						swal("We are Sorry !!",response.error_msg, "warning");
						
					}
					
				},
				
			});
		}
	}
	
 
</script>
</body>
</html>
