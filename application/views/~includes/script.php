<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/9ad0804c94.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" ></script>
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/product-zoom.js"></script>
	<script src="<?php echo img_base; ?>/static/js/jquery.basictable.min.js"></script>
	<script src="<?php echo img_base; ?>/static/js/main.js"></script>
	<script src="<?php echo img_base; ?>/static/js/non-defered.js"></script>  
	<script src="<?php echo img_base; ?>/static/js/defered.js"></script> 
	 <script src="<?php echo img_base; ?>/static/js/jquery.fancybox.min.js"></script>
	<a href="#" class="back-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	<a href="tel:1800 9829 0038" target="_blank" class="header-right-call-mobile d-block d-lg-none"><i class="fa fa-phone" aria-hidden="true"></i></a>	
</body>

<script>
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
		 var languagename = 'en';
		/*	$.ajax({
				method     : 'POST',	
				dataType   : 'json',					
				url: "<?php echo BASE_URL; ?>ajax/changeLanguage",
				data       :  {action:'changeLanguage',lang_id:lang_id,urls:location.href},
				//beforesend: loading(), 				
				cache: true,			
				success: function(data){*/
					//var url = window.location.pathname;
					//var filename = url.substring(url.indexOf('/'),2);
					var str = location.pathname;
					var pathname = str.replace('/kiranus/spn','');	
					var pathname = pathname.replace('/kiranus/en','');	
					var pathname = pathname.replace('/kiranus/pt','');	
					
					if(lang_id == '' || lang_id == 1){ 
					 languagename = 'en';					
					}else if(lang_id == 2){
					 languagename = 'spn';		
					}else if(lang_id == 3){
					 languagename = 'pt';		
					}
					var redirecturl = window.location.origin+'/kiranus/'+languagename;
					window.location.href=redirecturl;
					
					//alert(location.hostname+'/en'+location.pathname);
			//	}
					//  window.location.replace(location.hostname+'/en'+location.pathname);				
					
			//});
		}
		</script>