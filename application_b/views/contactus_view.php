<?php 

//echo "<pre>"; print_r($getbrandtieuplogo); exit;
 include ('includes/top.php') ?>
<body class="contact-page">
<?php include ('includes/header.php') ?>
<section class="contact-section inn"> <img src="<?php echo BASE_URL;?>static/images/Contat-Us-02.jpg" class="img-fluid desktopimg" alt=""> </section>
<section class="contact-sector pt-5 pb-5">
  <div class="container">
    <div class="row pt-5">
      <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
        <div class="contact-address bg-white mb-4"> <i class="fa fa-phone" aria-hidden="true"></i>
          <h4>Phone Number</h4>
          <span> +91-44-4233-7332 </span> </div>
        <div class="contact-address bg-white mb-4"> <i class="fa fa-envelope-o" aria-hidden="true"></i>
          <h4>Email Address</h4>
          <span><a href="mailto:support@inbasetech.in">support@inbasetech.in</a></span> </div>
        
        <div class="contact-address bg-white mb-5"> <i class="fa fa-map-marker" aria-hidden="true"></i>
          <h4>Location</h4>
          <span>Sunshine tower, #2 Narasingapuram street, Ritchi street next to Indian bank, 1st floor Chennai – 600002</span> </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
        <div class="reach-us bg-white p-4 pb-5 mb-5">
          <h4>Contact Us</h4>
          <div class="cont-frm">
            <form name="contactform" method="post" action="#" id="contactform">
              <div class="frm-fields clearfix">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="text" placeholder="Name" id="iname" name="iname" class="form-control mb-5 p-3 required" required >
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="email" placeholder="Email" id="iemail" name="iemail" class="form-control mb-5 p-3 jsrequired" required >
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="text" placeholder="Contact Number" id="iphone" name="iphone" onKeyPress="return CheckNumericKeyInfo(event.keyCode, event.which)"; maxlength="13" minlength="10"  class="form-control mb-5 p-3 jsrequired" required>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="text" class="form-control mb-5 p-3" placeholder="City" id="location" name="location" required>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="form-data">
                      <textarea class="form-control mb-4 p-3" id="amessage" placeholder="Message" name="amessage" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-data">
                  <input type="button" class="common-btn" name="submit" id="submit" value="Send Message" onClick="contactusform('contactform','<?php echo BASE_URL; ?>ajax/contactform','<?php echo BASE_URL;?>contactus');">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="location-map bg-white pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h1 class="text-center mt-3 mb-3">Find us on Google Map</h1>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 mapcontatiner nopad">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.4706192125022!2d80.26903691482303!3d13.069332890791761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52661b7c946bbf%3A0xffa5d11435f4f6ab!2sSunshine%20Tele%20Link!5e0!3m2!1sen!2sin!4v1608301727605!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
    </div>
  </div>
</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>
$(document).ready(function(){
	/**/
});

  function contactusform($acts,$urll,$lodlnk)
   {
		//alert("reach");
		//return false;
		//alert($acts);
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
	 
			$("button").attr('disabled',false);
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
					//loading();
				},
				success: function(response){
					
					  //alert(response);
					if(response.rslt == "1"){
						var sucmsg = "Contact form saved Successfully";
						swal("Success!",sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						//$(location).attr('href', $lodlnk); 	
					}
					else if(response.rslt == "2"){
						var upmsg="Error";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					
				},
				
			});
		}
	}
</script>
</body>
</html>