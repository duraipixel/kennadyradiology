<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
 <section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><?php echo $commondisplaylanguage['home'];?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $footdisplaylanguage['contactus'];?></li>
			  </ol>
			</nav>
			<h1 class="heading1 text-center text-white"><?php echo $footdisplaylanguage['contactus'];?></h1>
		 </div>
	  </div>
	</div>
</section>
<section class="contact-sector pt-5 pb-5">
  <div class="container">
    <div class="row pt-5">
      <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
        <div class="contact-address bg-white mb-4"> <i class="fa fa-phone" aria-hidden="true"></i>
          <h4><?php echo $contactusdisplaylanguage['phoneno'];?></h4>
          <span>+91 - 98400 80008</span> </div>
        <div class="contact-address bg-white mb-4"> <i class="fa fa-envelope-o" aria-hidden="true"></i>
          <h4><?php echo $contactusdisplaylanguage['emailaddress'];?></h4>
          <span><a href="mailto:corporate@trivitron.com">kiran@kiranxray.com</a></span> </div>
        
        <div class="contact-address bg-white mb-5"> <i class="fa fa-map-marker" aria-hidden="true"></i>
          <h4><?php echo $contactusdisplaylanguage['emailaddress'];?></h4>
          <span>D-117, TTC Area, Nerul, Navi Mumbai 400 706, India</span> </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
        <div class="reach-us bg-white p-4 pb-5 mb-5">
          <h3 class="mb-4"><?php echo $footdisplaylanguage['contactus'];?></h3>
          <div class="cont-frm">
            <form name="contactform" method="post" action="#" id="contactform">
              <div class="frm-fields clearfix">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="text" placeholder="<?php echo $formdisplaylanguage['name'];?>" id="iname" name="iname" class="form-control mb-5 p-3 required" required >
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="email" placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>" id="iemail" name="iemail" class="form-control mb-5 p-3 jsrequired" required >
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="text" placeholder="<?php echo $formdisplaylanguage['contactnumber'];?>" id="iphone" name="iphone" onKeyPress="return CheckNumericKeyInfo(event.keyCode, event.which)"; maxlength="13" minlength="10"  class="form-control mb-5 p-3 jsrequired" required>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-data">
                      <input type="text" class="form-control mb-5 p-3" placeholder="<?php echo $formdisplaylanguage['city'];?>" id="location" name="location" required>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="form-data">
                      <textarea class="form-control mb-4 p-3" id="amessage" placeholder="<?php echo $formdisplaylanguage['message'];?>" name="amessage" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-data">
                  <input type="button" class="common-btn" name="submit" id="submit" value="<?php echo $commondisplaylanguage['submit'];?>" onClick="contactusform('contactform','<?php echo BASE_URL; ?>ajax/contactform','<?php echo BASE_URL;?>contactus');">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="location-map bg-white p-0">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="text-center mt-3 mb-5"><span><?php echo $contactusdisplaylanguage['findus'];?></span></h3>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 mapcontatiner nopad">
	  
	  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120645.93680085863!2d72.87099798458267!3d19.099515331284543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c90e99845aa1%3A0x5318a51a96e2ff85!2sKiran%20Medical%20Systems!5e0!3m2!1sen!2sin!4v1639649029635!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	  
	  
	   
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