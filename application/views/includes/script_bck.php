<script	src="<?php echo img_base; ?>/static/js/jquery-3.5.1.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/umd/popper.min.js" ></script>
	<script src="<?php echo img_base; ?>/static/js/bootstrap.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/9ad0804c94.js"></script>
	<script src="<?php echo img_base; ?>/static/js/owl.carousel.min.js" ></script>
	<script src="<?php echo img_base; ?>/static/js/aos.js"></script>
	<script src="<?php echo img_base; ?>/static/js/slick.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/jquery.fancybox.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/wow.min.js"></script>
	<script type="text/javascript" src="<?php echo img_base; ?>/static/js/mdb.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/product-zoom.js"></script>
	<script src="<?php echo img_base; ?>/static/js/jquery.basictable.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/main.js"></script>
	<!--<script src="<?php echo img_base; ?>/static/js/non-defered.js"></script>  -->
	<script src="<?php echo img_base; ?>/static/js/defered.js"></script> 
	 <script src="<?php echo img_base; ?>/static/js/jquery.fancybox.min.js"></script>
	 	 <script src="<?php echo img_base; ?>/static/js/jquery.mCustomScrollbar.js"></script>
	<a href="#" class="back-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	<a href="tel:1800 9829 0038" target="_blank" class="header-right-call-mobile d-block d-lg-none"><i class="fa fa-phone" aria-hidden="true"></i></a>	

    <script src="https://d3js.org/d3.v5.min.js"></script>
  <script type="text/javascript" src="<?php echo img_base; ?>static/js/d3RangeSlider.js"></script>
  
  
  <script type="text/javascript">
            var slider = createD3RangeSlider(0, 10000, "#price-container", true);

            slider.onChange(function(newRange){
                d3.select("#range-label").html("<small><i class='fa fa-inr'></i></small> " + newRange.begin + " &nbsp; <small>to</small> &nbsp; " + "<small><i class='fa fa-inr'></i></small> " + newRange.end);
            });

            slider.range(3000,5000);
        </script>
  <script type="text/javascript">		
function loading() {			
	document.getElementById("load").style.display = 'block';
}

function unloading() {
	document.getElementById("load").style.display = 'none';
}


</script>

<script>

	function isNumberupdate(evt,elem) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	var a=elem.value; 	
	a=a.substr(a.length - 1);
	charCode=getKeyCode(a);
	if (charCode > 31 && (charCode < 48 || charCode > 57)  ) {
         var str= $(elem).val();
        $(elem).val(str.slice(0,-1));
    }
    return true;
}



	var specialKeys = new Array();
        specialKeys.push(8); 
		specialKeys.push(43); 
		specialKeys.push(37); 
		specialKeys.push(39); 
		//Backspace
        function IsNumeric3(e) {
             var keyCode = e.which ? e.which : e.keyCode
            var ret = (keyCode != 37 && keyCode != 8 && keyCode != 46 && (keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
           // document.getElementById("error3").style.display = ret ? "none" : "inline";
            return ret;
        }
$(document).ready(function() {
    $(".numericvalidate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	
	
	$(".moretriggger").click(function(){
		$(".menuright-wraper").slideToggle();
	});
});

	function changeLanguage(lang_id) {
					var languagename = '';
					var pathname = '';
		 
					var str = location.pathname;
					if(location.hostname == '192.168.0.60' || location.hostname == '192.168.0.48' || location.hostname == 'google-apps.co.in'){
					 pathname = str.replace('/spn','');					  
					 pathname = pathname.replace('/pt','');	
					 pathname = pathname.replace('/kiranus','');	
					  
					}else{
					 pathname = str.replace('/spn','');	
					 pathname = pathname.replace('/pt','');
					}
					
					if(lang_id == '' || lang_id == 1){ 
					 languagename = '';					
					}else if(lang_id == 2){
					 languagename = '/spn';		
					}else if(lang_id == 3){
					 languagename = '/pt';		
					}
				 
					if(location.hostname == '192.168.0.60' || location.hostname == '192.168.0.48' || location.hostname == 'google-apps.co.in'){
						 
					var redirecturl = window.location.origin+'/kiranus'+languagename+pathname;
					}else{  
					var redirecturl = window.location.origin+languagename+pathname;	
					}
				 window.location.href=redirecturl;					
		}
		</script>
		
		

<script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      });
    });
	$(document).on('ready', function() {
      $(".regular.regular-1").slick({
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
      });
    });
	$('[data-fancybox="preview"]').fancybox({
  thumbs : {
    autoStart : true
  }
});
</script>

<script>
$(document).ready(function(){
	$('a[href="#search"]').on('click', function(event) {                    
		$('#search').addClass('open');
		$('#search > form > input[type="search"]').focus();
	});            
	$('#search, #search button.close').on('click keyup', function(event) {
		if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
			$(this).removeClass('open');
		}
	});            
});



</script>
<script>

$(function(){
    $(".menu-dropdown-icon").hover(
      function () {
        $(".menu-dropdown-icon").removeClass('menu-hover');		
        $(this).addClass('menu-hover');
      }
    );
});
</script> 
<script>




  $(document).ready(function(){
  
	  $('.your-class').slick({
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 5,
		dots: false,
		responsive: [
		{
		  breakpoint: 1320,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 3,
			infinite: true,
			dots: true
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 2
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
	  ]
	  });

  $('.seller-slider').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: false,
    responsive: [
    {
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
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    }
  ]
  });
  
  $('.inthePress-slider').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    dots: false,
    responsive: [
    {
      breakpoint: 1320,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    }
  ]
  });
  
});




$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  $('.your-class').slick('setPosition');
})


$('.slider-for').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   asNavFor: '.slider-nav'
 });
 $('.slider-nav').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   asNavFor: '.slider-for',
   dots: true,
   focusOnSelect: true
 });


 /*for fixed header shrink*/
 $(window).scroll(function() {
			if ($(document).scrollTop() > 50) {
				$('header').addClass('shrink');
			} 
			else {
				$('header').removeClass('shrink');
			}
		});
	/*for fixed header shrink end*/
</script>



	<script>
	/*for fixed header shrink*/
	 
	/*for fixed header shrink end*/

		$(document).ready(function(){
			/*for dummy header start*/
			var hheight= $("header").height() - 1;
			$("#dummyheader").height(hheight);
			/*for dummy header end*/
		
		/*for event slider*/
		  $('.commonthumb-slider').owlCarousel({
			autoplay: true,
			items:5,
			slideBy: 5,
			infinite: true,
			loop: true,
			smartSpeed: 700,
			autoplayHoverPause:true,
			mouseDrag: false,
			autoplayTimeout: 3000,
			nav: true,
			navText: [
			  "<i class='fa fa-angle-left'></i>",
			  "<i class='fa fa-angle-right'></i>"
			],
			  dots: false,
			responsive: {
					0: {
						items: 1,
						slideBy: 1,
					},
					580: {
						items: 3,
						slideBy: 3,
					},
					768: {
						items: 4,
						slideBy: 4,
					},
					1025: {
						items: 4,
						slideBy: 4,
					}
				}
		  });	
		/*for event slider*/
		
		$('.pause').click(function () {
			//alert("off");
			$('.slide').carousel('pause');
		});
	
		$('.prd-single').hover(function(){
		if($('.prd-single').hasClass("current-item")){
			$('.prd-single').removeClass("current-item");
			$('.slide').carousel('pause');
		}
		else{
		   $(this).addClass("current-item");
		  $('.current-item .slide').carousel('cycle');
	   }
		});
	
		/*for event slider*/
		
$('.logoslider').owlCarousel({
      items : 5,
      dots: false,
      autoplay:true,
	  loop:true,
	  infinite: true,
	  smartSpeed: 1500,
	  autoplayTimeout: 1500,
      nav: false,
			navText: [
			  "<i class='fa fa-angle-left'></i>",
			  "<i class='fa fa-angle-right'></i>"
			],
			  dots: false,
			responsive: {
					0: {
						items: 2,
					},
					580: {
						items: 4,
					},
					1024: {
						items: 5,
					}
				}
	});
	
	$('.logoslider-small').owlCarousel({
      items : 5,
      dots: false,
      autoplay:true,
	  smartSpeed: 1500,
	  autoplayTimeout: 1500,
      nav: false,
			navText: [
			  "<i class='fa fa-angle-left'></i>",
			  "<i class='fa fa-angle-right'></i>"
			],
			  dots: false,
			responsive: {
					0: {
						items: 2,
					},
					580: {
						items: 4,
					},
					1024: {
						items: 5,
					}
				}
	});	
	$('.clients-slider').owlCarousel({
      items : 7,
      dots: false,
      autoplay:true,
	  loop:true,
	  smartSpeed: 1500,
	  autoplayTimeout: 1500,
      nav: false,
			navText: [
			  "<i class='fa fa-angle-left'></i>",
			  "<i class='fa fa-angle-right'></i>"
			],
			  dots: false,
			responsive: {
					0: {
						items: 2,
					},
					580: {
						items: 4,
					},
					768: {
						items: 5,
					},
					1024: {
						items: 7,
					}
				}
	});
	
	/*menu hover*/
		$(".menuitem").hover(function(){
			var curSrc = $(this).attr("data-img");
			//console.log(curSrc);
			//if(curSrc != null && curSrc != ""){}
				
			$(".menuitem").removeClass("currentitem");
			$(this).addClass("currentitem");
			
			$("#menuimage").attr("src" , curSrc);
			
			
		});
	/**/
	
	/*popover*/
	$(function () {
	$('[data-toggle="popover"]').popover()
	})
	
	
	
	$(".select2").select2({
		/*placeholder: "Category",*/
		minimumResultsForSearch: -1
		
	});
});



$(window).load(function() {
   $('.slide').carousel('pause');
   
   $("#category").select2({
		placeholder: "Category",
		minimumResultsForSearch: -1
		
	});
	
$(".select2-results__options").mCustomScrollbar({
	theme:"dark"
});
	
	
$('#category').on('select2:open', function () {
    $('.select2-results .select2-results__options').mCustomScrollbar('destroy');
    $('.select2-results .select2-results__options').mCustomScrollbar('update');
    setTimeout(function() {
        $('.select2-results .select2-results__options').mCustomScrollbar({
            axis: 'y',
			theme:"dark",
            scrollbarPosition: 'inside',
            advanced:{
                updateOnContentResize: true
            },
            live: true
        });
    }, 0);
});


});

/*for scrolling issue select2*/
$(window).scroll(function() {
//$("#category").select2().blur();

		   $('#category').select2(
		   {
			   placeholder: "Category",
				minimumResultsForSearch: -1
			   
		   });
});

</script>

<script>

function buynow(proid,wishproid='',wishlist='')
{            
 
	            var minqty = $("#prices1_"+proid).val();
if(minqty == '' || minqty == 'undefined')	            {
	minqty = 1;
}
			
                var urll = '<?php echo BASE_URL; ?>ajax/buynow_insert'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'proid='+proid+'&minqty='+minqty+'&wishproid='+wishproid+'&wishlist='+wishlist+"&"+$("#frmcustomattr").serialize(),
				beforeSend: function() {
					//alert("responseb");
					loading();
				},
				success: function(response){
					
					 // alert(response.rslt);
					if(response.rslt == "1"){
						$("#carcnt").html(response.cartcount);
						var sucmsg = "Product is added to the Cart successfully.";
						swal("Success!",sucmsg, "success");
						window.location.href="<?php echo BASE_URL;?>checkout";
						listcartcount();
							
					}
					else if(response.rslt == "2"){
						/*var upmsg="To edit quantity please edit on the cart page";
						swal("Item Added to Cart!",upmsg, "warning");*/
						window.location.href="<?php echo BASE_URL;?>checkout";
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
					
unloading();
				},

			});
}

function addtocartcolor(proid,formid,wishproid='',wishlist='')
{               //alert(proid);

	            var minqty = $("#prices1_"+proid).val();
	            if(minqty == '' || minqty == 'undefined')	            {
	minqty = 1;
}
			
                var urll = '<?php echo BASE_URL; ?>ajax/addtocart_insert'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'proid='+proid+'&minqty='+minqty+'&wishproid='+wishproid+'&wishlist='+wishlist+"&"+$("#frmcustomattr"+formid).serialize(),
				beforeSend: function() {
					//alert("responseb");
					 loading();
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
						var upmsg="Product already in cart";
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
					unloading();

				},

			});
}

function addtocart(proid,wishproid='',wishlist='')
{               //alert(proid);

	            var minqty = $("#prices1_"+proid).val();
	            if(minqty == '' || minqty == 'undefined')	            {
	minqty = 1;
}
			
                var urll = '<?php echo BASE_URL; ?>ajax/addtocart_insert'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'proid='+proid+'&minqty='+minqty+'&wishproid='+wishproid+'&wishlist='+wishlist+"&"+$("#frmcustomattr").serialize(),
				beforeSend: function() {
					//alert("responseb");
					 loading();
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
						var upmsg="Product already in cart";
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
					unloading();

				},

			});
}


function addtocartslider(proid,attrid,did)
{               //alert(proid);
	            var minqty = $("#prices1").val();
	            if(minqty == '' || minqty == 'undefined')	            {
	minqty = 1;
}
			
                var urll = '<?php echo BASE_URL; ?>ajax/addtocart_insert'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'proid='+proid+'&minqty='+minqty+"&selattr_"+attrid+"="+did,
				beforeSend: function() {
					//alert("responseb");
					 loading();
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
					
unloading();
				},

			});
}


function listcartcount()
{
	// alert("hhh");

    var urls = '<?php echo BASE_URL; ?>ajax/addtocartlist';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
			data       :'',
			beforeSend: function() {
				//loading();
 			},
            success: function (response) {                	 
              $("#dropdownlistcart").html(response.productlist);
			/*  $('.itemlist-scroller').mCustomScrollbar({
				theme:"dark"
				});
			 */
					  
		    }
        });
}

$(function(){
listcartcount();	
});
              		

function deletecartfunction(carproid){	

       //var carproid = $("#productid").val();
      // alert(carproid);
		 var urls = '<?php echo BASE_URL; ?>ajax/deletecartproduct';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'carproid='+carproid,
			beforeSend: function() {
				 loading();
			
 			},
            success: function (response) {
                
                if(response.rslt == "1"){
					deletecartpagelist();
					$("#carcnt").html(response.cartcount);
					swal("Success!", "The selected product is successfully deleted!", "success");
					listcartcount();
					if(response.checnt > 0){
					quantity_inc_dec('','','checkoutrefresh');
					}
					else if(response.checnt==0){
						$(location).attr('href', '<?php echo BASE_URL; ?>cart');
					}
				}	
				unloading();		
            }
        });
}

function deletecartpagelist(carproid)
{
	
	//var carproid = $("#productid").val();
       //alert(carproid);
		 var urls = '<?php echo BASE_URL; ?>ajax/deletecartpageproduct';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'carproid='+carproid,

			beforeSend: function() {
				 loading();
				
 			},
            success: function (response) {
                
                if(response.rslt == "1"){
					//deletecartfunction();
					$("#carcnt").html(response.cartcount);
					$("#cartpage").html(response.prod_details);
					swal("Success!", "The selected product is successfully deleted!", "success");
					
				}
				listcartcount();
				
				
				 unloading();				
            }
        });
}

//wishlist function start
function addtowishlist(proid,minqty='')
   {             
                if(minqty!=''){
				var	minqty = minqty;
				}
				else{					
	            var minqty = $("#prices1").val();
				}
	            //alert(minqty);
                var urll = '<?php echo BASE_URL; ?>ajax/addtowishlist_insert'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'proid='+proid+'&minqty='+minqty+"&"+$("#frmcustomattr").serialize(),
				beforeSend: function() {
					//alert("responseb");
					 loading();
				},
				success: function(response){
					
					 // alert(response.rslt);
					if(response.rslt == "1"){
						$("#wishlistcnt").html(response.wishlistcount);
						var sucmsg = "Product is added to the Wishlist successfully.";
						swal("Success!",sucmsg, "success");
						wishlistcount();	
						$(".wishlist_"+proid).html('<a href="javascript:void(0);" class="wishlist-icon commonicon" onclick="addtowishlist('+proid+','+minqty+');" ><img src="<?php echo BASE_URL;?>/static/images/icons/wishicon.png" class="img-responsive" alt=""></a>');						
					}
					else if(response.rslt == "2"){
						var upmsg="This Product already exits in your wishlist.";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
                    if(response.rslt == "3"){
					location.href='<?php echo BASE_URL.'login'; ?>';
						
					}
 unloading();		

				},

			});
}

$(document).ready(function(){
	
	            var urll = '<?php echo BASE_URL; ?>ajax/addtowishlistcount'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : '',
				beforeSend: function() {
					//alert("responseb");
					//loading();
					wishlistcount();
				},
				success: function(response){
					$("#wishlistcnt").html(response.wishlistcount);
				},

			});
	
});

function wishlistcount()
{
	//alert("hhh");

    var urls = '<?php echo BASE_URL; ?>ajax/addtowishlist';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
			data       :'',
			beforeSend: function() {
				//loading();
				
 			},
            success: function (response) {   
             		
              $(".customcart-dropmenu #wishlist_dropdown").html(response.productlist);
              	$('.itemlist-scroller').mCustomScrollbar({
					theme:"dark"
				});				  
		    }
        });
}


function deletewishlist(carproid,minqty){	
   
       var proid = $("#productid_wishlist").val();
     
		 var urls = '<?php echo BASE_URL; ?>ajax/deletewishlistproduct';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'carproid='+carproid,
			beforeSend: function() {
				//loading();
			
 			},
            success: function (response) {
                
                if(response.rslt == "1"){
					deletewishlistpage();
					$("#wishlistcnt").html(response.wishlistcount);
					swal("Success!", "The selected product is successfully deleted!", "success");
					wishlistcount();
					$(".wishlist_"+proid).html('<a href="javascript:void(0);" class="wishlist-icon commonicon" onclick="addtowishlist('+proid+','+minqty+');" ><img src="<?php echo BASE_URL;?>/static/images/icons/wishlist-g.png" class="img-responsive" alt=""></a>'); 
					
				}

				
				
				//unloading();				
            }
        });
}



function deletewishlistpage()
{
	
	var carproid = $("#productid").val();
      // alert(carproid);
		 var urls = '<?php echo BASE_URL; ?>ajax/deletewishlistpageproduct';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'carproid='+carproid,
			beforeSend: function() {
				//loading();
				
 			},
            success: function (response) {
                
                if(response.rslt == "1"){
					//deletecartfunction();
					$("#wishlistcnt").html(response.wishlistcount);
					$("#wishlistpage").html(response.prod_details);
					swal("Success!", "The selected product is successfully deleted!", "success");
					wishlistcount();
				}

				
				$('.scrlcnt').mCustomScrollbar({
					theme:"dark"
				});

				
				//unloading();				
            }
        });
}


function Movewishlistpage()
{
	
	var carproid = $("#productid").val();
      // alert(carproid);
		 var urls = '<?php echo BASE_URL; ?>ajax/deletewishlistpageproduct';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'carproid='+carproid,
			beforeSend: function() {
				//loading();
				
 			},
            success: function (response) {
                
                if(response.rslt == "1"){
					//deletecartfunction();
					$("#wishlistcnt").html(response.wishlistcount);
					$("#wishlistpage").html(response.prod_details);
					swal("Success!", "Successfully Moved to Cart", "success");
					
				}

				$('.scrlcnt').mCustomScrollbar({
					theme:"dark"
				});
				
				//unloading();				
            }
        });
}

//wishlist function end


//Select address for checkout page
function displayshipping_add(cusaddid){
	
    var urls = '<?php echo BASE_URL; ?>ajax/selectaddress';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'cusaddid='+cusaddid,
			beforeSend: function() {
				//loading();
 			},
			success: function (response) {   
             		
             if(response=='0'){
				swal("Invalid Address","We couldn't develiery your address", "warning");
			   $(".paynowbtn").addClass("disabled");
			 }
			 else{
				$(".paynowbtn").removeClass("disabled");
				 
			 }
					  
		    }
	});
}

//search field validation 
$(document).ready(function(){
	$(".search-submit").click(function(){
		$('#searchfield').parsley().validate();
	    if ($('#searchfield').parsley().isValid()){
			
		}
		
	});
	
});

function emailfun($id){
	$('#'+$id).parsley().validate();
	if ($('#'+$id).parsley().isValid())  {
	 var  mailid = $("#emails").val();
	   
	 var urls = '<?php echo BASE_URL; ?>ajax/subscribemail';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'mailid='+mailid,
			beforeSend: function() {
			 loading();
 			},
            success: function (response) {

                if(response.rslt == "1"){
					swal("Success!", "Email send successfully", "success");
					$("#"+$id).val('');
				}
				else if(response.rslt == "2"){
						var upmsg="This email already exits.";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
				 unloading();				
            }
        });
	}
}

//Prevent Min Qty Function 
function quantity_inc_dec(currval,cpid,delval='')
{
	
	var minqty=$("#prices1_"+cpid).attr('min');	
	var qty = 0;
	 if(parseInt(minqty)>parseInt(currval))
	{
		$("#prices1_"+cpid).val(minqty); 
		qty =minqty;
	}
	
	if(parseInt(minqty)<=parseInt(currval))
	{
		 qty = $("#prices1_"+cpid).val();
	}
	if(delval=='checkoutrefresh'){
		var urls = '<?php echo BASE_URL; ?>ajax/changequantity';
		$.ajax({
				url: urls,
				method     : 'POST',
				dataType   : 'json',
				data: 'qty='+qty+'&cpid='+cpid,
				beforeSend: function() {
					//loading();
					
				},
				success: function (response) {
						$("#chechoutdivbind").html(response.checkoutpage);
						$("#divordersummary").html(response.ordersummaryinfo);
						$("#divordersummarytab").html(response.ordersummaryinfotab);
						
					//unloading();				
				}
		});
		
	}
	else{
		
		if(qty>0){
			
		var urls = '<?php echo BASE_URL; ?>ajax/changequantity';
		$.ajax({
				url: urls,
				method     : 'POST',
				dataType   : 'json',
				data: 'qty='+qty+'&cpid='+cpid,
				beforeSend: function() {
					//loading();
					
				},
				success: function (response) {
						$("#chechoutdivbind").html(response.checkoutpage);
						$("#divordersummary").html(response.ordersummaryinfo);
						$("#divordersummarytab").html(response.ordersummaryinfotab);
						
					//unloading();				
				}
			});
		}
	}
}

function quantity_inc_dec_cart(currval,cpid)
{alert();
	
	var minqty=$("#prices1_"+cpid).attr('min');	
	var qty = 0;
	 if(parseInt(minqty)>parseInt(currval))
	{
		$("#prices1_"+cpid).val(minqty); 
		qty =minqty;
	}
	
	if(parseInt(minqty)<=parseInt(currval))
	{
		 qty = $("#prices1_"+cpid).val();
	}
	if(qty>0){
    var urls = '<?php echo BASE_URL; ?>ajax/cartpageproductList';
	$.ajax({
            url: urls,
			method     : 'POST',
			dataType   : 'json',
            data: 'qty='+qty+'&cpid='+cpid,
			beforeSend: function() {
				//loading();
				
 			},
            success: function (response) {           			
					$("#cartpage").html(response.prod_details);
				//unloading();				
            }
        });
	}
}

$('.scrlcnt').mCustomScrollbar({
	theme:"dark"
});


function numberkeyvalid(e)
{
   if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
}	


$(document).ready(function() {
    $(".numericvalidate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	
	
	$(".moretriggger").click(function(){
		$(".menuright-wraper").slideToggle();
	});
});
/* Mouse Right enabled by JP conveyed by John merlin for client required */
$(document).ready(function () {
    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        //e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        //return false;
    });
});



var windowWidth = $(window).width();
	
	if(windowWidth > 767){
			
	}
	else{
		$(".profilemenu-trigger").click(function(){
			$(".panel-group").slideToggle();
			$(this).toggleClass("menuopen");
		});
		
		
	}
	
	
	if(windowWidth < 992){
		
		$("#mobsearch-trigger").click(function(){
		
	if($(".navbar-toggle").hasClass("collapsed")){
	}
	else{
		$(".navbar-toggle").trigger("click");
	}		
			
	
	$(".headersearch").slideToggle();
});	
$(".navbar-toggle").click(function(){
			
			
	$(".headersearch").slideUp();
	
});
$("section").click(function(){
	$(".headersearch").slideUp();
});
	}
	
	
	
	$(window).load(function(){
		//$("#pageloader .spinner").delay(0).fadeOut("slow");
		//$("#pageloader").delay(400).fadeOut("slow");
	});
	
	
	$(".customdropdown>a").hover(function(){
		$(".dropdown").removeClass("open");
		$(this).next(".dropdown-menu").addClass("showing");
	});
	$(".customdropdown").mouseleave(function(){
		$(".dropdown-menu").removeClass("showing");
	});
	
	
function checkminqty(){
	input = $('input[type="text"]');
	var min = input.attr('min');
	var max = input.attr('max');
	
	var oldValue = parseFloat(input.val());
	if (oldValue <= min || isNaN(oldValue) || oldValue=="") {
		swal("Warning!",'The Minimum Order Quantity for this product is:'+' '+min+'\n If you require fewer than '+min+', please chat with us.',"warning");
			
		$('input[type="text"]').val(min);
	} 
	
}

function validateQty(event) {
var key = window.event ? event.keyCode : event.which;
if (event.keyCode == 8 || event.keyCode == 46
 || event.keyCode == 37 || event.keyCode == 39) {
	return true;
}
else if ( key < 48 || key > 57 ) {
	return false;
}
else return true;
};

//$("input[type=file]").filestyle();
function prodattrchange_list(pid,sku,did,purl)
	{
		
		var path =  '<?php echo BASE_URL; ?>ajax/prodattrchange_price'
		var tsku='';
		if(sku=='')
			 tsku='<?php echo $sku;?>'
		else
			 tsku=sku;
		 var data="";
	 if(did!='')	 
	 {	
		if($("#color_"+did).length){
			$("#color_"+did). prop("checked", "checked");
		 } 
		
		
	 }
	
	 data="proid="+purl+"&sku="+tsku+"&"+$("#frmcustomattr_"+purl).serialize();
	 //console.log(path);
	 // location.href=path;
	 
	 $.ajax({
				url        : path,
				contentType: "application/json",
				method     : 'POST',
				dataType   : 'json',   
				data       : JSON.stringify(data),
				beforeSend: function() {
					
				},
				success: function(response){
				if(response.rslt==1){
					$("#"+purl).html(response.pricedetails);
				}
				},

			});
	 
	}

function recentview(pid){
	    var urll = '<?php echo BASE_URL; ?>ajax/updateRecentview'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'pid='+pid,
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					 
				},

			});
}


</script>
<script>

$('.add').click(function () {	 
    	$(this).prev().val(+$(this).prev().val() + 1);	
});
$('.sub').click(function () {		
    	if ($(this).next().val() > 1) {
			$(this).next().val(+$(this).next().val() - 1);
		}
});

</script>
