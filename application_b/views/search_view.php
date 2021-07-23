<?php  include ('includes/top.php') ?>
<style>
.productpagenation {
	display:none;
}
</style>
<body class="productbg" onbeforeunload='reset_options()' >
<?php include ('includes/header.php') ?>
<?php 
//print_r($GLOBALS['allcategories']); die();
   $catinfo=$helper->searchkeyArray($catid,$GLOBALS['allcategories'],'categoryID');
   
?>
<!-- Product Listing End --> 

<!-- Sort Section Starts -->
<section class="sort pt-5 mt-5 mb-3">
  <div class="container sort-border pt-5">
    <div class="row">
      <div class="col-6">
        <ul>
          <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
          <li><i class="lni lni-arrow-right"></i></li>
          <li><a href="#">Search</a></li>
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
      <div class="col-6 text-right">
        <form id="frmsortby" class="">
          <select class="custom-select" name="selsortby" onChange="fnAttrChanged();" id="sel1">
            <?php  foreach($SortBy as $srt) { ?>
            <option value="<?php echo $srt['SortId'] ?>"><?php echo $srt['SortName'] ?></option>
            <?php } ?>
          </select>
         
        </form>
      </div>
    </div>
  </div>
</section>
<!-- Sort Section End --> 
<!-- Filter Section Starts -->
<section class="filter mt-3 mb-3">
  <div class="container">
    <div class="row">
      <div class="col">
        <p class="filter-showing"><h4>Search for : <?php echo $searchkey; ?></h4></p>
      </div>
    </div>
    <div class="row">
    <form id="frmcmnfilter" class="col-md-12">
       <div class="col-12 col-sm-6"> <strong>Filters</strong>
       <!-- <select class="custom-select" id="colorid" name="colorid" onChange="fnAttrChanged();">
          <option value="">All Color: </option>
          <?php 
		  foreach($attributemaster_list as $colors){?>
          <option value="<?php echo $colors['dropdown_id'];?>"><?php echo $colors['dropdown_values'];?></option>
          <?php }?>
        </select>-->
        <select class="custom-select" name="priceval" id="priceval" onChange="fnAttrChanged()">
          <option value="">By Price: </option>
          <option value="200-500">200 to 500</option>
          <option value="500-1000">500 to 1000</option>
          <option value="1000-3000">1000 to 3000</option>
          <option value="3000-5000">3000 to 5000</option>
        </select>
      </div>
      </form>
      <!--<div class="col-12 col-sm-6">
        <form class="search">
          <div class="search__wrapper">
            <input type="text" name="" placeholder="Search for..." class="search__field">
            <button type="submit" class="fa fa-search search__icon"><i class="lni lni-search-alt"></i> Search</button>
          </div>
        </form>
      </div>-->
    </div>
  </div>
</section>
<!-- Filter Section End -->

<?php //include_once("partial/productlist-menu.php"); ?>

<div id="divproductlists">
  <?php include_once("partial/products_lists.php"); ?>
</div>

<?php   //echo "<pre>";print_r($recentviewproduct);die();
 include('partial/products_recent.php');

?>

<!-- Bottom Image Section Starts -->
<?php include('partial/clientlist.php');?>
<!-- Bottom Image Section End -->

<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
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
	
	jQuery.ias().unbind();
	var url='<?php echo BASE_URL; ?>ajax/products/<?php echo $catid; ?>/1/';
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
  </body>
</html>
