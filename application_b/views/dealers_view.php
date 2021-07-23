<?php 

//echo "<pre>"; print_r($tablename); exit;
 include ('includes/top.php') ?>
 <body class="productbg">
<?php include ('includes/header.php') ?>
	  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
					  <li><a href="javascript:void:(0);">Dealer</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>


	<section>
		<div class="container">	
		<div class="dealers-section">	
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 dealersform-wraper">
							<div class="formtitle">
							<h2>Come, let's collaborate!</h2>
							<p>Do you have any products or brands to sell, but don't know how? You can take advantage of our platform. Just fill in the form below and we will get in touch with you.</p>
						</div>				
						<div>
							<div class="tab" role="tabpanel">
			                <!-- Nav tabs -->
			                <ul class="nav nav-tabs" role="tablist">
			                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">
								Dealer Individual
								&nbsp;<span data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
								</a></li>
			                    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">
								Dealer Brand
								&nbsp;<span data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
								</a></li>
			                    
			                </ul>
			                <!-- Tab panes -->
			                <div class="tab-content">
			                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
			                        
			                        <form action="" id="dealerindividualform">
									<input type="hidden" value="<?php echo $individualtable; ?>" name="tablename"/>
							         <div class="col-md-12 nopad">
									  <?php echo $individual_dealer; ?>
									  </div>
									  
									
									<div class="text-center">
									<button type="button" name="button"  onclick="javascript:dynamicinsertform('frmindividual','<?php echo BASE_URL; ?>ajax/dynamicformbuilder','dealerindividualform','Dealer Individual','<?php echo BASE_URL; ?>dealer');" class="submit-btn"><span>Submit</span></button> 
									</div>

									</form>

			                    </div>
			                    <div role="tabpanel" class="tab-pane fade" id="Section2">
			                        <form action="" id="dealerbrandform">
									<input type="hidden" value="<?php echo $brandtable; ?>" name="tablename"/>
			                          <div class="col-md-12 nopad">
									  <?php echo $brand_dealer; ?>
								</div>
									 
									 
									 <div class="text-center">
									 <button type="button" name="button"  onclick="javascript:dynamicinsertform('frmbrand','<?php echo BASE_URL; ?>ajax/dynamicformbuilder','dealerbrandform','Dealer Brand','<?php echo BASE_URL; ?>dealer');" class="submit-btn"><span>Submit</span></button>
									</div>
									</form>
			                    </div>
			                </div>
			            </div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
		 	
	
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>

<script>
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
			var inputs = $('input[type="file"]');
			
			for(var i=0; i<inputs.length; i++){
				
				m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
			}

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
	
 function onchange_function(id,tablename,ColumnName,ColumnId,inputid,conid)
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
 }	 
</script>
</body>
</html>