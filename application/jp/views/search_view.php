<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<link rel="stylesheet" href="<?php echo img_base; ?>static/css/price_range_style.css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.14/css/bootstrap-multiselect.css" media="all">
<style>
.productpagenation {
	display:none;
}
</style>
<body class="productbg" onbeforeunload='reset_options()' >
<?php 
//print_r($GLOBALS['allcategories']); die();
$catinfo=$helper->searchkeyArray($catid,$GLOBALS['allcategories'],'categoryID'); 
?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><?php echo $commondisplaylanguage['home'];?></a></li>
				<li class="breadcrumb-item"><a href="#"><?php echo $commondisplaylanguage['search'];?></a></li>
			  </ol>
			</nav>
			<h3 class="text-center text-white"><span><?php echo $commondisplaylanguage['searchresults'];?></span></h3>
		 </div>
	  </div>
	</div>
</section>
<!-- Product Listing End --> 

<!-- Filter Section Starts -->

<section>
  <div class="container">
    <div class="row justify-content-center">
		
      <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- <button class="clear-filter" onclick="return clearallfilter();" type="button"><i class="flaticon-close"></i> <?php echo $productlistdisplaylanguage['clearfilter'];?></button> -->
				 
            <!--    <form id="frmcmnfilter" class="filterdiv">-->
                  
                  <!-- Filter Section End -->
                  
                  <?php $pagename="productlist";
include_once("partial/productlist-menu.php"); ?>
              <!--  </form>-->
      </div>
	  
	   
			
			<div class="col-sm-12 col-md-12">	
			<div class="sort">
			<i class="fa fa-filter" aria-hidden="true"></i>
			<div class="sort-items">			
			<span class="sort-mob-close"><i class="flaticon-cancel-12"></i></span>
			<?php  foreach($SortBy as $srt) { ?>
			<button class="sortcls" type="button" onclick="sorting(<?php echo $srt['SortId'] ?>)" id="sortid<?php echo $srt['SortId'] ?>"><?php echo $srt['SortName'] ?></button>
			<?php }?>
				<form id="frmsortby" class=""><input type="hidden" name="selsortby" id="selsortby" onchange="fnAttrChanged()"></form>
			
			</div>
			</div>
					  
			
		   
		</div>
			
     <!-- <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
		<div class="col-sm-12 col-md-6">
					 <?php if( count($productlists) > 0){?>  <p class="filter-showing"><?php echo $catname;?> ( <?php echo $productlistdisplaylanguage['showing'];?> 1 - <?php echo count($productlists);?> <?php echo $productlistdisplaylanguage['productof'];?> <?php echo $productscount;?>)</p>
     <?php }?>
				</div>
				-->
          <div id="divproductlists">
            <?php include_once("partial/products_lists.php"); ?>
          </div><!--
        </div>
      </div>-->
    </div>
  </div>
</section>

<!--
<section class="filter">
  <div class="container">
    <div class="row">
		<div class="col-md-4 col-sm-6">
		<strong><?php echo $headdisplaylanguage['searchfor'];?> : <?php echo $searchkey; ?></strong>
        <form id="frmsortby" class="">
          <select class="custom-select" name="selsortby" onChange="fnAttrChanged();" id="sel1">
            <?php  foreach($SortBy as $srt) { ?>
            <option value="<?php echo $srt['SortId'] ?>"><?php echo $srt['SortName'] ?></option>
            <?php } ?>
          </select>
        </form>
      </div>
	  <div class="col-md-4 col-sm-6">
		<form id="frmcmnfilter">
        <div class="pricerange-wraper" style="width:100%;"> <span class="pricerange-text"><?php echo $productlistdisplaylanguage['pricerange'];?></span>
          <div id="pricefilter1" style="">
            <div class="well">
              <div class="price-range-block">
                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                <div>
                  <input type="hidden" id="minval" value="<?php echo !empty($fliter_price['minprice'])? floor($fliter_price['minprice']):'0'; ?>" />
                  <input type="hidden" id="maxval" value="<?php echo !empty($fliter_price['maxprice'])? ceil($fliter_price['maxprice']):'0'; ?>" />
                  <span class="minspan"><?php echo PRICE_SYMBOL;?>
                  <input  type="text" id="min_price" name="min_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'min_price');" />
                  </span> <span class="maxspan"> <?php echo PRICE_SYMBOL;?>
                  <input  type="text"  id="max_price" name="max_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'max_price');" />
                  </span> </div>
              </div>
            </div>
          </div>
        </div>
      </form>
	  </div> 
    </div>
  </div>
</section>-->
<!-- Filter Section End -->

<?php //include_once("partial/productlist-menu.php"); ?>
<section class="pt-0">
  <div class="container">
    <div class="row">
<div id="divproductlists">
  <?php include_once("partial/products_lists.php"); ?>
</div>
</div>
</div>
</section>
<?php   //echo "<pre>";print_r($recentviewproduct);die();
 //include('partial/products_recent.php');

?>

<!-- Bottom Image Section Starts -->
<?php //include('partial/clientlist.php');?>
<!-- Bottom Image Section End -->

<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.14/js/bootstrap-multiselect.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/jquery-ias.min.js"></script> 
<script>
	var ias;
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


	var windowWidth = $(window).width();
	if(windowWidth > 767){
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
});
$('.collapse').on('shown.bs.collapse', function (e) {
var $panel = $(this).closest('li');
$('html,body').animate({
	scrollTop: $panel.offset().top - 160 },
	700);
});
/*collapse menu end*/


$(".select2").select2({
		
		minimumResultsForSearch: -1
		
	});

  </script> 
<script>
  
  
 var $slider;
  $(document).ready(function(){
	 
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
	
	jQuery.ias().unbind();
	var url='<?php echo BASE_URL; ?>ajax/products/<?php echo $catid; ?>/1/<?php echo $searchkey; ?>';
	$.ajax({
            url: url,
			method     : 'POST',
			dataType   : 'text',
           // data: $('#productlistaside :input').serialize()+'&'+$('#frmcmnfilter').serialize()+"&isajax=1&searchkey=<?php echo $searchkey; ?>",
		    data: $('#frmcmnfilter').serialize()+'&selsortby='+$('#selsortby').val()+"&isajax=1&searchkey=<?php echo $searchkey; ?>",
			beforeSend: function() {
				//loading();
 			},
            success: function (response) {
                $("#divproductlists").html(response);
				
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

function sorting(idval){
	//alert(idval)
	
	$('.sortcls').removeClass('active');
	$('#selsortby').val(idval).trigger('change');
	$('#sortid'+idval).addClass('active');
	//$('input[name="selsortby"] option[value=1]').trigger('change');
}
</script>
</body>
</html>