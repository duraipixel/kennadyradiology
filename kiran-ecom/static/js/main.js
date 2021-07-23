AOS.init({
   once: true
});

// Preloader
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });
  

  // Back to top button
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
     //console.log(scroll);
    if (scroll >= 300) {
        //console.log('a');
        $(".back-to-top").addClass("scrollfixed");
    } else {
        //console.log('a');
        $(".back-to-top").removeClass("scrollfixed");
    }
});

$(document).ready(function () {
	$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).fadeIn(300);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).fadeOut(300)
    });
	
	
	
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();
		 //console.log(scroll);
		if (scroll >= 200) {
			//console.log('a');
			$("header").addClass("fixed-top");
		} else {
			//console.log('a');
			$("header").removeClass("fixed-top");
		}
	});
}); 
 
$(document).ready(function() {
	$(".megamenu").on("click", function(e) {
		e.stopPropagation();
	});
	$(".navbar-toggler").on("click", function(e) {
		$('.menu-overlay').toggleClass('show');
	});
	$(".menu-overlay").on("click", function(e) {
		$('.navbar-collapse').removeClass('show');
		$(this).removeClass('show');
	});
	$(".mobile-close").on("click", function(e) {
		$('.navbar-collapse').removeClass('show');
		$('.menu-overlay').removeClass('show');
	});	
	$(".header-mob-search").on("click", function(e) {
		$('form.header-search').addClass('show');
		$('.header-search-overlay').addClass('show');
	});	
	$(".header-mob-search-close").on("click", function(e) {
		$('form.header-search').removeClass('show');
		$('.header-search-overlay').removeClass('show');
	});	
	$(".header-search-overlay").on("click", function(e) {
		$('form.header-search').removeClass('show');
		$('.header-search-overlay').removeClass('show');
	});
});

$(document).ready(function(e){
    $('#mnu-category').find('a').click(function(e) {
        e.preventDefault();
        var cat = $(this).text();
        $('#srch-category').text(cat);
        $('#txt-category').val(cat);
    });
	$(".dropdown-item").hover( function() {
		var value=$(this).attr('data-src');
		$(".dropdown-image").attr("src", value);
	});
});

 $("header .navbar-nav .nav-item").hover(function () {
    $('header .navbar-nav .nav-link').removeClass("link_hover");
	$(this).find(".nav-link").addClass("link_hover");
 });
 
 $( "header .navbar-nav .nav-item" ).mouseleave(function() {
  $('header .navbar-nav .nav-link').removeClass("link_hover");
});
 
$( ".navbar-nav .dropdown-menu" ).mouseleave(function() {
  $('header .navbar-nav .nav-link').removeClass("link_hover");
});

$('.explore-products').slick({
  dots: true,
  infinite: true,
  autoplay: true,
  speed: 300,
  loop: true,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1100,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
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

$('.featured-products').slick({
  dots: false,
  arrows: true,
  infinite: false,
  autoplay: true,
  speed: 300,
  loop: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1100,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
		dots: true,
		arrows: false
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
		dots: true,
		arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		dots: true,
		arrows: false
      }
    }
  ]
});

$('.home-videos').slick({
  dots: true,
  arrows: false,
  infinite: true,
  autoplay: true,
  speed: 300,
  loop: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1100,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
		dots: true,
		arrows: false
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
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

$('.choose-products').slick({
  dots: false,
  arrows: false,
  infinite: true,
  autoplay: true,
  speed: 300,
  loop: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1100,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
		dots: true,
		arrows: false
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		dots: true,
		arrows: false
      }
    }
  ]
});


$('.home-testimonials').slick({
  dots: true,
  arrows: false,
  infinite: true,
  autoplay: true,
  speed: 300,
  loop: true,
  slidesToShow: 2,
  slidesToScroll: 1,
  responsive: [
    {
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


if ($(window).width() < 767) {
   $('#shopbyOne').removeClass('show');
}
else {
   $('#shopbyOne').addClass('show');
}

$(document).ready( function () {
    $('#glasscase').glassCase({
		'thumbsPosition': 'bottom'
	});
});


$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});

$(document).ready(function(){

var quantitiy1=0;
   $('.quantity-right-plus.qty1').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity1').val());
        
        // If is not undefined
            
            $('#quantity1').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus.qty1').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity1').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity1').val(quantity - 1);
            }
    });
    
});

$(document).ready(function(){

var quantitiy2=0;
   $('.quantity-right-plus.qty2').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity2').val());
        
        // If is not undefined
            
            $('#quantity2').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus.qty2').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity2').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity2').val(quantity - 1);
            }
    });
    
});

$('.collapse').on('shown.bs.collapse', function(e) {
  var $card = $(this).closest('.card');
  $('html,body').animate({
    scrollTop: $card.offset().top -60
  }, 500);
});

$(document).ready(function() {
      $('#cart-table').basictable({
        breakpoint: 767
      });
});

$(document).ready(function () {
    $(".edit-address").click(function () {
        $(".show-address").show('slow');
		$('html, body').animate({
			scrollTop: $(".show-address").offset().top -200
		}, 100);
    });
});

 $(function() {
        $('#accordionCheckout .accordion-button').bind('click',function(){
            var self = this;
            setTimeout(function() {
                theOffset = $(self).offset();
                $('body,html').animate({ scrollTop: theOffset.top - 100 });
            }, 500);
        });
 });
 
$(document).ready(function () {
    $(".clear-filter").click(function () {
        $("input").removeAttr('checked');
    });
});

$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#confirm_password a").on('click', function(event) {
        event.preventDefault();
        if($('#confirm_password input').attr("type") == "text"){
            $('#confirm_password input').attr('type', 'password');
            $('#confirm_password i').addClass( "fa-eye-slash" );
            $('#confirm_password i').removeClass( "fa-eye" );
        }else if($('#confirm_password input').attr("type") == "password"){
            $('#confirm_password input').attr('type', 'text');
            $('#confirm_password i').removeClass( "fa-eye-slash" );
            $('#confirm_password i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function () {
    $(".forgot-password").click(function () {
        $(".for-pass").show('slow');
		$(".login").hide('slow');
    });
});
$(document).ready(function () {
    $(".show-login").click(function () {
        $(".for-pass").hide('slow');
		$(".login").show('slow');
    });
});
