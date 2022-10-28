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
<section class="contact-sector pt-5 pb-5" style="position: relative;">
<img class="rellax swing2" data-rellax-speed="6" src="<?php echo img_base;?>/static/images/bg-1.png" alt="" />
  <div class="container">
    <div class="row pt-5">
      <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
        <div class="contact-address bg-white mb-4"> <i class="fa fa-phone" aria-hidden="true"></i>
          <h4><?php echo $contactusdisplaylanguage['phoneno'];?></h4>
          <span>+1 256 259 4436</span> </div>
        <div class="contact-address bg-white mb-4"> <i class="fa fa-envelope-o" aria-hidden="true"></i>
          <h4><?php echo $contactusdisplaylanguage['emailaddress'];?></h4>
          <span><strong><a href="mailto:kennedyradiology@trivitron.com">kennedyradiology@trivitron.com</a></strong></span> </div>
        
        <div class="contact-address bg-white mb-5"> <i class="fa fa-map-marker" aria-hidden="true"></i>
          <h4>Kennedy Radiology</h4>
          <span>11665 AL-79, Scottsboro, AL 35768, United States</span> </div>
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
				   <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-data cnt clearfix">
  
	<select class="form-control jsrequired" id="country" name="country">
      <option selected="selected" value="United States of America">United States of America</option>
 </select>
    </div>
    </div>
    
    <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-data cnt clearfix">
    
	<select class="form-control jsrequired" id="state" name="state">
	<option value="">Select your State</option>
	<option value="Alabama">Alabama</option>
	<option value="Alaska">Alaska</option>
	<option value="Arizona">Arizona</option>
	<option value="Arkansas">Arkansas</option>
	<option value="California">California</option>
	<option value="Colorado">Colorado</option>
	<option value="Connecticut">Connecticut</option>
	<option value="Delaware">Delaware</option>
	<option value="District Of Columbia">District Of Columbia</option>
	<option value="Florida">Florida</option>
	<option value="Georgia">Georgia</option>
	<option value="Hawaii">Hawaii</option>
	<option value="Idaho">Idaho</option>
	<option value="Illinois">Illinois</option>
	<option value="Indiana">Indiana</option>
	<option value="Iowa">Iowa</option>
	<option value="Kansas">Kansas</option>
	<option value="Kentucky">Kentucky</option>
	<option value="Louisiana">Louisiana</option>
	<option value="Maine">Maine</option>
	<option value="Maryland">Maryland</option>
	<option value="Massachusetts">Massachusetts</option>
	<option value="Michigan">Michigan</option>
	<option value="Minnesota">Minnesota</option>
	<option value="Mississippi">Mississippi</option>
	<option value="Missouri">Missouri</option>
	<option value="Montana">Montana</option>
	<option value="Nebraska">Nebraska</option>
	<option value="Nevada">Nevada</option>
	<option value="New Hampshire">New Hampshire</option>
	<option value="New Jersey">New Jersey</option>
	<option value="New Mexico">New Mexico</option>
	<option value="New York">New York</option>
	<option value="North Carolina">North Carolina</option>
	<option value="North Dakota">North Dakota</option>
	<option value="Ohio">Ohio</option>
	<option value="Oklahoma">Oklahoma</option>
	<option value="Oregon">Oregon</option>
	<option value="Pennsylvania">Pennsylvania</option>
	<option value="Rhode Island">Rhode Island</option>
	<option value="South Carolina">South Carolina</option>
	<option value="South Dakota">South Dakota</option>
	<option value="Tennessee">Tennessee</option>
	<option value="Texas">Texas</option>
	<option value="Utah">Utah</option>
	<option value="Vermont">Vermont</option>
	<option value="Virginia">Virginia</option>
	<option value="Washington">Washington</option>
	<option value="West Virginia">West Virginia</option>
	<option value="Wisconsin">Wisconsin</option>
	<option value="Wyoming">Wyoming</option>
	</select>
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
      <div class="col-md-12 col-sm-12 col-xs-12">	  
	  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d26882884.87573648!2d-86.101008!3d34.664749!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7a0835a559e0ff80!2sTHE%20KENNEDY%20COMPANY!5e0!3m2!1sen!2sin!4v1650271869990!5m2!1sen!2sin"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="contact-map"></iframe>
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