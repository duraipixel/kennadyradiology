<?php  
//echo "<pre>"; print_r($formfields); exit;
include ('includes/top.php') ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
<?php 
//print_r($GLOBALS['allcategories']); die();
   $catinfo=$helper->searchkeyArray($catid,$GLOBALS['allcategories'],'categoryID');
   
?>

  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
					  <li><a href="javascript:void:(0);">New Products</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section >
		<div  class="container">
		<?php if(count($productlists)>0){ ?>	
		<aside class="col-md-3 nopad sss1">
		   <div class="productlistaside" id="productlistaside">
		   		
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="filtersec">
					<div class="row">
		   			<div class="col-md-6 filtersecc">
		   			<h4>Filters</h4>
			   		</div>
			   		<div class="col-md-6 filterseccc">
			   			<h4><a href="javascript:void(0);" onclick="clearallfilter();">Clear All</a></h4>
			   		</div>
			   		</div>
			   		</div>

					<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopad collapsemenu-wraper">
					<?php include ('partial/productlist-menu.php') ?>
						
					</div>
			    </div><!-- panel-group -->
			</div>
		</aside>
       
		<div class="col-md-9 nopad sss2 productcontainer">
		 <?php } else { ?>
		 <div class="col-md-12 nopad sss2 productcontainer">
		 <?php } ?>
		<?php /* ?><?php 
		  
		if($catinfo['catimage']!='') { 
		
		   $imgarr=explode("|",$catinfo['catimage']);
		?>
			<div class="propad">
				<div class="prolist">					
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->
					  
					  <ol class="carousel-indicators">
					  
					    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
					    <li data-target="#myCarousel" data-slide-to="2"></li>
					
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner">
					  
					    <div class="item active">
					      <img src="<?php echo BASE_URL; ?>static/images/pro-slider.png" alt="">
					    </div>
					  
					    <div class="item">
					      <img src="<?php echo BASE_URL; ?>static/images/pro-slider.png" alt="">
					    </div>

					    <div class="item">
					      <img src="<?php echo BASE_URL; ?>static/images/pro-slider.png" alt="">
					    </div>
					  </div>
					</div>
				</div>
			</div>
		<?php } ?>	<?php */ ?>
		<div class="protitlesec">
			<div class="row">
				<div class="col-md-6">
					<h4>New Products</h4>
				</div>
				<div class="col-md-6">
					<form id="frmsortby" class="form-inline text-right">
						<div class="form-group">
						  <label for="sel1">Sort by :</label>
						  <select class="form-control" name="selsortby" onchange="fnAttrChanged();" id="sel1">
						  <?php  foreach($SortBy as $srt) { ?>
						    <option value="<?php echo $srt['SortId'] ?>"><?php echo $srt['SortName'] ?></option>
						  <?php } ?>
						  </select>
						</div>
					</form>
				</div>
			</div>
		</div>

	  <div id="divproductlists">
		<?php include_once("partial/products_lists.php"); ?>
	  </div>	
	  
	  
	 
		 	
		</div>
		</div>
	</section>

<section class=" commontop-section">
		<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php include ('partial/ourclients.php') ?>
			</div>
			
		</div>
			
	</div>
	</section>
<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>
<script src="<?php echo BASE_URL; ?>static/js/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL; ?>static/js/price_range_script.js"></script>
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




	var tallness = $(".sss2").height();
	$(".panel-group").css("min-height" , tallness);
	
	
	
	
	
/*collapse menu*/
$('.collapsemenu .collapse').on('show.bs.collapse', function (e) {
			$(e.target).closest('li').siblings().find('.collapse').collapse('hide');
});
$('.collapse').on('shown.bs.collapse', function (e) {
var $panel = $(this).closest('li');
$('html,body').animate({
	scrollTop: $panel.offset().top - 160 },
	700);
});
/*collapse menu end*/

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
  

  $(document).ready(function(){
	
	$('#price-range-submit').hide();

	$("#min_price,#max_price").on('change', function () {

	  $('#price-range-submit').show();

	  var min_price_range = parseInt($("#min_price").val());

	  var max_price_range = parseInt($("#max_price").val());

	  if (min_price_range > max_price_range) {
		$('#max_price').val(min_price_range);
	  }

	  $("#slider-range").slider({
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
	  $("#slider-range").slider({
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
		  fnAttrChanged();
		}
	  });

	  $("#min_price").val($("#slider-range").slider("values", 0));
	  $("#max_price").val($("#slider-range").slider("values", 1));
		
	});

	$("#slider-range,#price-range-submit").click(function () {

	  var min_price = $('#min_price').val();
	  var max_price = $('#max_price').val();

	  $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
	});

});

  
  </script>
 <script>
function fnAttrChanged()
{
	
	jQuery.ias().unbind();
	var url='<?php echo BASE_URL; ?>ajax/products/0/1/';
	$.ajax({
            url: url,
			method     : 'POST',
			dataType   : 'text',
            data: $('#productlistaside :input').serialize()+'&'+$('#frmsortby').serialize()+"&isajax=1&type=newproducts",
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
  	$('#productlistaside').find("input[type=checkbox]").prop('checked', false);
	fnAttrChanged();
}
</script> 
  </body>
</html>
