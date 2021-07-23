<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<style>
.productpagenation {
	display:none;
}
</style>
<?php $catinfo=$helper->searchkeyArray($catid,$GLOBALS['allcategories'],'categoryID');;?>
<section class="inner-bg">
<div class="container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo BASE_URL;?>"><?php echo $commondisplaylanguage['home'];?></a></li>
          <?php
							$arrbread=array(); 
							$helper->getProductBread($catinfo['categoryID'],$arrbread);
							
							$breadpath='';
							for($a=count($arrbread)-1;$a>=0;$a--){
								$breadpath.=$arrbread[$a]['code'].'/';
					  ?>
          <li class="breadcrumb-item active" aria-current="page"> <a href="<?php echo BASE_URL.$breadpath;?>"><?php echo $arrbread[$a]['name']; ?></a></li>
          <?php } ?>
        </ol>
      </nav>
      <h3 class="text-center text-white"><span><?php echo $arrbread[$a]['name']; ?></span></h3>
    </div>
  </div>
</div>
</section>
<section class="pb-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-12 col-lg-9">
        <p class="text-center mb-0">
		<?php echo $catinfo['categoryDesc'];?>
		 </p>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="accordion" id="accordionShopBy">
          <div class="accordion-item">
            <h2 class="accordion-header mt-0" id="headingOne">
              <button class="accordion-button" type="button" data-mdb-toggle="collapse"	data-mdb-target="#shopbyOne" aria-expanded="true"
						aria-controls="shopbyOne"><?php echo $productlistdisplaylanguage['shopby'];?></button>
            </h2>
            <div id="shopbyOne" class="accordion-collapse collapse show"
					  aria-labelledby="headingOne" data-mdb-parent="#accordionShopBy">
              <div class="accordion-body">
                <button class="clear-filter" onclick="return clearallfilter();" type="button"><i class="flaticon-close"></i> <?php echo $productlistdisplaylanguage['clearfilter'];?></button>
				
				<!--<select id="languages" name="languages[]" class="multiselectcheck" multiple >						    
				<option value="php">PHP</option>
				<option value="python">Python</option>		
				<option value="javascript">JavaScript</option>
				<option value="java">Java</option>
				<option value="c">C</option>
				<option value="sql">SQL</option>
				<option value="ruby">Ruby</option>
				<option value=".net">.Net</option>
			</select>	-->
			 
                <form id="frmcmnfilter">
                  
                  <!-- Filter Section End -->
                  
                  <?php $pagename="productlist";
include_once("partial/productlist-menu.php"); ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-9 col-lg-9">
        <div class="row">
          <div id="divproductlists">
            <?php include_once("partial/products_lists.php"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
 

<script src="<?php echo img_base; ?>static/js/jquery-ias.min.js"></script>

<script type="text/javascript">

//$('input[name="attr[]"] option[value=<?php echo $apcolor;?>]').attr('selected', 'selected');
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