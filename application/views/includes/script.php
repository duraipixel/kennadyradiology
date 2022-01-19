<!--<script	src="http://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="<?php echo img_base; ?>static/js/jquery-3.5.1.min.js"></script>
<script src="http://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="http://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<script src="http://use.fontawesome.com/9ad0804c94.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
<script src="<?php echo img_base; ?>/static/js/jquery.basictable.min.js"></script>
<script src="<?php echo img_base; ?>/static/js/main.js"></script>
<!--<script src="<?php echo img_base; ?>/static/js/non-defered.js"></script>  -->
<script src="<?php echo img_base; ?>/static/js/defered.js" defer></script>
<script src="<?php echo img_base; ?>/static/js/jquery.easy-autocomplete.js"></script>
<script src="http://d3js.org/d3.v5.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<a href="#" class="back-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<a href="tel:1800 9829 0038" target="_blank" class="header-right-call-mobile d-block d-xl-none"><i class="fa fa-phone" aria-hidden="true"></i></a>	
  <div class="sort-overlay"></div>
  
  <script type="text/javascript">	

$(document).ready(function() {       

 
	$('.multiselectcheck').multiselect({		
		//nonSelectedText: 'Select',
 placeholder: $(this).attr('placeholder')		
	});
});

  
function loading() {			
	document.getElementById("load").style.display = 'block';
}

function unloading() {
	document.getElementById("load").style.display = 'none';
}

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
					if(location.hostname == '192.168.0.60' || location.hostname == '192.168.0.48' || location.hostname == 'google-apps.co.in' || location.hostname == 'pixel-studios.net'){
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
					
					 var urll = '<?php echo BASE_URL; ?>ajax/cartproduct_language'
				$.ajax({
				url        : urll,
				method     : 'POST',
				dataType   : 'json',   
				data       : 'langid='+lang_id,
				beforeSend: function() { 
					//loading();
				},
				success: function(response){
					//unloading();
				 if(response.rslt == 1){
					if(location.hostname == '192.168.0.60' || location.hostname == '192.168.0.48' || location.hostname == 'google-apps.co.in' || location.hostname == 'pixel-studios.net'){
						 
					var redirecturl = window.location.origin+'/kiranus'+languagename+pathname;
					}else{  
					var redirecturl = window.location.origin+languagename+pathname;	
					}
				 window.location.href=redirecturl;	
				 }				 
				}
				});
		}
		
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
						$(".wishlist_"+proid).html('<a href="javascript:void(0);" class="wishlist-icon commonicon" onclick="addtowishlist('+proid+','+minqty+');" ><img src="<?php echo img_base;?>/static/images/icons/wishicon.png" class="img-responsive" alt=""></a>');						
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
              /*	$('.itemlist-scroller').mCustomScrollbar({
					theme:"dark"
				});	*/			  
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
					$(".wishlist_"+proid).html('<a href="javascript:void(0);" class="wishlist-icon commonicon" onclick="addtowishlist('+proid+','+minqty+');" ><img src="<?php echo img_base;?>/static/images/icons/wishlist-g.png" class="img-responsive" alt=""></a>'); 
					
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

			/*	
				$('.scrlcnt').mCustomScrollbar({
					theme:"dark"
				});

				*/
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

			/*	$('.scrlcnt').mCustomScrollbar({
					theme:"dark"
				});*/
				
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
$("#cartpage").html(' ');			
					$("#cartpage").html(response.prod_details);
				//unloading();				
            }
        });
	}
}
/*
$('.scrlcnt').mCustomScrollbar({
	theme:"dark"
});

*/

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

	
function chkqtydetail(){
	input = $('.chkqtydetail');
	var min = input.attr('min');
	var max = input.attr('max');
	
	var oldValue = parseFloat(input.val());
	if (oldValue <= min || isNaN(oldValue) || oldValue=="") {
		swal("Warning!",'The Minimum Order Quantity for this product is:'+' '+min+'\n If you require fewer than '+min+', please chat with us.',"warning");
			
		$('.chkqtydetail').val(min); 
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
					loading();
				},
				success: function(response){unloading();
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


$('.add').click(function () {	 
    	$(this).prev().val(+$(this).prev().val() + 1);	
});
$('.sub').click(function () {		
    	if ($(this).next().val() > 1) {
			$(this).next().val(+$(this).next().val() - 1);
		}
});

	$(".headsearch").each(function(){
			var optValue = $(this);
			var optName = $(this).attr("name");
			var options = {
			  url: function(phrase) {
				return "<?php echo img_base;?>ajax/headsearch/"+$('#session_lang_id').val();
			  },
			  getValue: function(element) {
 				return element.name;
			  },
			  ajaxSettings: {
				dataType: "json",
				method: "POST",
				data: {
				  dataType: "json",
				  action : "autocomplete",
				  column : optName
				}
			  },
			  preparePostData: function(data) {
 				data.phrase = optValue.val();
				return data;
			  },
			  requestDelay: 400
			};		
			$(this).easyAutocomplete(options);	
		})

		
</script>
