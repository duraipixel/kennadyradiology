<?php 

//echo "<pre>"; print_r($getbrandtieuplogo); exit;
 include ('includes/top.php') ?>
<body class="contact-page">
<?php include ('includes/header.php') ?>
<section class="homeslider-section inn">
  <div class="">
    <div class="inner-banners"> <img src="<?php echo BASE_URL;?>static/images/banner/contact.jpg" class="img-responsive desktopimg" alt="slider1"> </div>
    <div class="inn-bancnt">
      <div class="container">
        <h4>Bulk Order </h4>
      </div>
    </div>
  </div>
</section>
<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL;?>">Home</a></li>
          <li><a href="javascript:void(0);">Bulk Order</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
 


<!-- Bulk Dynamic form Start  -->

<section class="section bulking">
  <div class="container">
    <div class="row">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="reach-us text-center">

					<h4>For Bulk Orders</h4>

					<div class="cont-frm">

						<form name="contactform" method="post" action="#" id="contactform">

							<div class="frm-fields clearfix">

								<div class="form-data">

									<input type="text" placeholder="Name" id="iname" name="iname" class="jsrequired">

								</div>

								<div class="form-data">

									<input type="email" placeholder="Email" id="iemail" name="iemail" class="jsrequired">

								</div>
	

								<div class="form-data">

									<input type="text" placeholder="Contact Number" id="iphone" name="iphone" onkeypress="return CheckNumericKeyInfo(event.keyCode, event.which)" ;="" maxlength="13" minlength="10" class="jsrequired">

								</div>	
								
								

								<div class="form-data">

									<input type="text" placeholder="City" id="iname" name="iname" class="jsrequired">

								</div>

								<div class="selt-dtae">
								
								<div class="form-data">

									<select data-placeholder="select" class="form-control" id="sub_category" name="sub_category" required="" tabindex="-1" aria-hidden="true">
										<option>Select Category</option>
										<option value="1">Hand Sanitizer</option>
										<option value="2">Hand Rub</option>
										<option value="3">Dish Wash</option>
										<option value="4">Veggie and Fruit Wash</option>
										<option value="6">Hand Wash</option>
										</select>

								</div>


								<div class="form-data">

									<input type="text" placeholder="Quantity of Products" id="location" name="location">

								</div>
								
								<a class="ad" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
								<a class="rm" href=""><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
								
								</div>


								<div class="form-data">

									<textarea type="text" placeholder="Remarks" id="location" name="location"></textarea>

								</div>
								
								
	

								<div class="form-data">

									<select data-placeholder="select" class="form-control" id="sub_category" name="sub_category" required="" tabindex="-1" aria-hidden="true">
										<option>Select the Purpose</option>
										<option value="1">New</option>
										<option value="2">Resale</option>
										</select>

								</div> 								



								<div class="form-data">

									<input type="button" name="submit" id="submit" value="submit" onclick="submit_contact();">

								</div>

							</div>

						</form> 

					</div>

				</div>

			</div>
	
	
	
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="reach-us text-center">

					<h4>For Bulk Orders</h4>

					<div class="cont-frm">

						<form id="bulkorderform" action="">
		<input type="hidden" value="bulk_order_enquiry" name="tablename"/>
		<?php  echo $bulk_order_form; ?>
						</form> 

					</div>

				</div>

			</div>
	
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopad">
		

		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

		<div class="chn-adr mum-adr">
		  <h4>Bulk Order Form<h4>
		<form id="bulkorderform" action="">
		<input type="hidden" value="bulk_order_enquiry" name="tablename"/>
		<?php  echo $bulk_order_form; ?>
		<!--<button  type="button" class="btn btn-default br" onClick="javascript:funSubmtBulkOrder();">Submit</button>-->
		
		<div class="text-center">
		<button type="button" name="button"  onclick="javascript:dynamicinsertform('frmbulkorder','<?php echo BASE_URL; ?>ajax/dynamicformbuilder','bulkorderform','Bulk Order','<?php echo BASE_URL; ?>contactus');" class="submit-btn"><span>Submit</span></button> 
		</div>
		</form>
		</div>		
		
		</div>
		
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="">
		
		
		</div>
		</div>
	
    </div>
  </div>
</section>

<section class="section cotact-layer">
  <div class="container">
    <div class="row">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopad">
		

		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

		<div class="chn-adr mum-adr">
		  <h4>Bulk Order Form<h4>
		<form id="bulkorderform" action="">
		<input type="hidden" value="bulk_order_enquiry" name="tablename"/>
		<?php  echo $bulk_order_form; ?>
		<!--<button  type="button" class="btn btn-default br" onClick="javascript:funSubmtBulkOrder();">Submit</button>-->
		
		<div class="text-center">
		<button type="button" name="button"  onclick="javascript:dynamicinsertform('frmbulkorder','<?php echo BASE_URL; ?>ajax/dynamicformbuilder','bulkorderform','Bulk Order','<?php echo BASE_URL; ?>contactus');" class="submit-btn"><span>Submit</span></button> 
		</div>
		</form>
		</div>		
		
		</div>
		
		</div> 
	
    </div>
  </div>
</section> 

<!-- Bulk Dynamic form Start End -->
 
 
<section class="section cont-persn">
  <div class="container">
    <div class="row">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nopad-left">
	<div class="area-box">
	<h4>Chennai</h4>
	<ul>
	<li>
	Jathavedan
	<span>+91 9384791185</span>
	Murali
	<span>+91 9176440215</span>
	</li>
	</ul>
	</div>
	</div> 
	
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nopad-left">
	<div class="area-box">
	<h4>Mumbai</h4>
	<ul>
	<li>
	Shwetha
	<span>+91 9820569173</span>
	Kamlesh
	<span>+91 9820686924</span>	 
	</li> 
	<li>
	Trivedi
	<span>+91 9320990666</span>
		Rishibha
	<span>+91 9137451185</span>
	</li> 
	</ul>
	</div>
	</div> 
	
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nopad-left">
	<div class="area-box">
	<h4>Haridwar</h4>
	<ul>
	<li>
	Pankaj Kumar
	<span>+91 9917712092</span>
	Sriram
	<span>+91 9997735850</span>
	</li>
	</ul>
	</div>
	</div> 
	
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

  function contactusform($urll,$acts,$lodlnk)
   {
		//alert("reach");
		//return false;
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
		//if ($('#'+$acts).valid()) {
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
	
	
	
	
function dynamicinsertform($frm,$urll,$acts,$stats,$lodlnk)
   {
		//alert("reach");
		//return false;
		$('#'+$acts).parsley().validate();

		if ($('#'+$acts).parsley().isValid())  {
		//if ($('#'+$acts).valid()) {
			$("button").attr('disabled',false);
			var m_data = new FormData();
			var formdatas = $("#"+$acts).serializeArray();
			$.each( formdatas, function( key, value ) {
				 m_data.append( value.name, value.value);
			});
			//debugger;
			/*var inputs = $('input[type="file"]');
			
			for(var i=0; i<inputs.length; i++){
				
				m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
			}*/

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
						var sucmsg = "Saved Successfully";
						swal("Success!", $stats +' '+ sucmsg, "success");
						
						$("#"+$acts)[0].reset();
						//alert(response);
						//$(location).attr('href', $lodlnk); 	
					}
					
					if(response.rslt == "2"){
						var sucmsg = "Please upload accept file type.";
						swal("Warning!",sucmsg,"warning");

					}


					//unloading();
					//$("button").attr('disabled',false);
					

				},
				
			});
		}
	}
	
 /*function onchange_function(id,tablename,ColumnName,ColumnId,inputid,conid)
 {

	$.ajax({
		url: '<?php echo BASE_URL; ?>ajax/dynamicfieldappend',
		type: 'POST',
		dataType : 'json',
		data: 'id='+id+'&tablename='+tablename+'&ColumnName='+ColumnName+'&ColumnId='+ColumnId+'&inputid='+inputid+'&conid='+conid,
		//beforeSend: loading(),
		success: function(response) {	 														
	        //unloading();										
		    $("#"+inputid).html(response.rslt);
		    $("#"+inputid).select2("val", "");	
					
		    //$("#country").html('<option value="">Select</option>');
		    //$("#country").select2("val", "");	
		}
				
	}); 
 }	*/
 
 function practicecontact_option(){
	 alert("fff");
		var j = $('#practicecontact_option_count').val();
		if(j <= 10) {
			$('#practicecontactoption_div').append('<div class="form-group"> <input type="hidden" name="sub_category[]" value="categoryID"><div class=""><select data-placeholder="select" class="form-control  " id="sub_category" name="sub_category[]" required=""><option value="-1">sub_category</option><option value="1">Hand Sanitizer</option><option value="2">Hand Rub</option><option value="3">Dish Wash</option><option value="4">Veggie and Fruit Wash</option><option value="6">Hand Wash</option></select></div></div><div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="43"><input type="TextBox" class="form-control number required" name="quantity[]" value="" placeholder="Quantity"></div><a href="javascript:void(0);" onclick="practicecontact_option();"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><a class="rm" href="javascript:void(0);" onclick="remove_practicecontact_option(' + j + ');"><i class="fa fa-minus-circle" aria-hidden="true"></i></a> ');
			
			/*$('#practicecontactoption_div').append('<div class="" id="practicecontact_row_option' + j + '"><div class="form-group addsec remsec addsecne remsec remsecnew"><div class="col-md-2 col-sm-8 col-xs-12"></div><div class="col-md-3 col-sm-8 col-xs-12"><input type="text" class="form-control" required  id="practice_contact_name' + j + '" name="practice_contact_name' + j + '" placeholder="Contact Name" value="" /></div><div class="col-md-3 col-sm-8 col-xs-12"><input type="email" class="form-control" required  id="practice_contact_email' + j + '" name="practice_contact_email' + j + '" placeholder="Email" value="" /></div><div class="col-md-3 col-sm-8 col-xs-12"><input type="text" class="form-control" required  id="practice_contact_phone' + j + '" name="practice_contact_phone' + j + '" placeholder="Phone" value=""  onkeypress="return isNumber(event)"   /></div><a href="javascript:void(0);" onclick="remove_practicecontact_option(' + j + ');"><span class="addthis tr"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a> <a href="javascript:void(0);" onclick="practicecontact_option();" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a></div></div>'); */
			j++;
			$('#practicecontact_option_count').val(j);
			$('#practicecontact_option_max_count').val(j);
		}
}

function remove_practicecontact_option(button_id){
	$('#practicecontact_row_option' + button_id + '').remove();
		var jj = $('#practicecontact_option_count').val();
		jj--;
		$('#practicecontact_option_count').val(jj);
}
	
 
</script>
</body>
</html>