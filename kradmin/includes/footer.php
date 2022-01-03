
<footer class="footer-section theme-footer">
  <div class="footer-section-1  sidebar-theme"> </div>
  <div class="footer-section-2 container-fluid">
    <div class="row">
      <div id="toggle-grid" class="col-xl-7 col-md-6 col-sm-6 col-12 text-sm-left text-center">
        
      </div>
      <div class="col-xl-5 col-md-6 col-sm-6 col-12">
        <ul class="list-inline mb-0 d-flex justify-content-sm-end justify-content-center mr-sm-3 ml-sm-0 mx-3">
          <li class="list-inline-item  mr-3">
              <p class="bottom-footer">&#xA9; <?php echo date('Y');?> <a target="_blank" href="#"><?php echo $storeinfo['storeName']; ?></a></p>
          </li>
          <li class="list-inline-item align-self-center">
            <div class="scrollTop"><i class="flaticon-up-arrow-fill-1"></i></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!--  END FOOTER  --> 

 

<!-- BEGIN GLOBAL MANDATORY SCRIPTS --> 
<script src="assets/js/libs/jquery-3.1.1.min.js"></script> 

<script src="bootstrap/js/popper.min.js"></script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<script src="plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="assets/js/app.js"></script> 
<script>
        $(document).ready(function() {
            App.init();
        });
		 $('[data-toggle="tooltip"]').tooltip()
</script> 

	<script src="assets/js/custom.js"></script> 
    <script src="assets/js/ui-kit/timeline/horizontal-main.js"></script> 
    <!-- <script src="plugins/treeview/gijgo.min.js"></script>-->
	<script src="plugins/filer/js/jquery.filer.min.js" type="text/javascript"></script>
 
 	<!-- DATATABLE BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/table/datatable/custom_miscellaneous.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->    
   
     <!-- SWEET ALERT BEGIN -->
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END THEME -->    
        
     <!-- Form Validation -->
    <script type="text/javascript" src="plugins/jquery-validation/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="plugins/jquery-validation/js/additional-methods.min.js"></script>
    
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/modal/classie.js"></script>
    <script src="assets/js/modal/modalEffects.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    
     <script src="plugins/select2/select2.min.js"></script>
    <script src="plugins/select2/custom-select2.js"></script>
    
     <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/editors/summernote/summernote.min.js"></script>
    <script src="plugins/editors/summernote/editor_summernote.js"></script>
    <!-- END PAGE LEVEL SCRIPTS --> 
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <?php if(basename($_SERVER['PHP_SELF']) != 'product_mng.php' && basename($_SERVER['PHP_SELF']) != 'product_form.php' && basename($_SERVER['PHP_SELF']) != 'salereports_mng.php' &&  basename($_SERVER['PHP_SELF']) != 'orderedproductsreport_mng.php' && basename($_SERVER['PHP_SELF']) != 'lowstockproductsreport_mng.php' &&  basename($_SERVER['PHP_SELF']) !='customerordersreport_mng.php'){?>
    <script src="assets/js/design-js/design.js"></script>
    <?php }?>
    
    
    <script src="plugins/date_time_pickers/bootstrap_date_range_picker/moment.min.js"></script>
    <script src="plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.js"></script>
    <script src="plugins/timepicker/jquery.timepicker.js"></script>
    <script src="plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
    
    <script src="plugins/timepicker/custom-timepicker.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    
    <!-- js tree -->
    <script src="plugins/treeview/jstree.min.js"></script>
   <!-- <script src="assets/js/design-js/design.js"></script>-->
	<script src="plugins/treeview/jstree.min.js"></script>
    
    <script src="<?php echo BASE_URL_ADMIN; ?>assets/js/jquery.easy-autocomplete.js"></script>	
    
 	 <script src="assets/js/ui-kit/ui-accordions.js"></script>
     
      <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<!--    <script src="plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
-->    <!-- END PAGE LEVEL SCRIPTS -->
    
    <!--  Form END CUSTOM SCRIPTS FILE  -->  
    
     
     
    <script type="application/javascript">
	
	var sucmsg = 'created successfully';
    var exsmsg = 'This data already exists!';
    var upmsg = 'updated successfully';
    var reqmsg = 'Required fields should not be empty';
    var delmsg = 'Deleted successfully';
    var statusmsg = 'Status updated successfully';
    var exsmsg_email = 'Email ID already exists. Please try with other email ID to create account.';
    var exsmsg_phone = 'That mobile number already exists. Please try a different number create an account.';
    var exsmsg_reference = 'This data is linked to other data. Cannot be deleted.';
    var oldpass_reference = 'Old password doesn`t match. Please enter the correct password.';
    var othmsg = 'Opps!!@ Server Error. Please retry again.';
    var exsmsg_refstats = 'This data is linked to several other sections. Cannot perform the action.';
    var imgmsg = 'Error : image size must be 1000 x 1000 pixels.';
    var dataGridHdn;
	
	/************* Common alert msg ************/
	 const toast = swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      padding: '0.5em'
	 
    });
	
	var currentPath  = window.location.pathname;	
	var splitPath = currentPath.split('/');
	var cPath = splitPath[splitPath.length-1];	
	if(cPath.indexOf('_') != -1){		
		var cPathSplit = cPath.split('_'); 	
		if(cPathSplit[0].length > 0){							
			$('.submenu  a').each(function(){	
 				var href = $.trim($(this).attr('href'));
				var hrefSplit = href.split('_');						
				if(hrefSplit[0] == cPathSplit[0]){	
 					$(this).closest('a').attr('aria-expanded', 'true');		
					$(this).closest('ul').attr('aria-expanded', 'true').addClass('show');					 
				}
			});
		}
	}
	
	function imageformatcheck(value,specimage){
	    
	    
	}
	
	function generateslug(string,elementid)
	{
		$.get( "common/ajax-functions.php?hdnact=urlslug&string="+string.replace("&",""), function( data ) {
				$( "#"+elementid ).val( data );
		});	
	}


	function randomString() {
		  var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
		  var string_length = 6;
		  var randomstring = '';
		  for (var i=0; i<string_length; i++) {
			  var rnum = Math.floor(Math.random() * chars.length);
			  randomstring += chars.substring(rnum,rnum+1);
		  }
		  document.getElementById('CouponCode').value = randomstring;
	} 

	function isNumberWithDOt(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
			return false;
		}
		return true;
	}
	
   //Number validaiton - common function - START
   function onlyNumbersWithDot(e) {           
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 46)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
	//Number validaiton - common function - END
	
	//Datatable all page common function - START
     function datatblCal(hdnFld) {
		var attid="&attributeid="+$('#attributeid').val();		
		var cusid="&customerid="+$('#cusid').val();		
		var tname="&tablename="+$('#tablename').val();		
		var formid="&formid="+$('#formbuilderid').val();
		
		var tablename = 'tblresult';
        var iColumns = $('#'+tablename+' thead th').length; // count all column length
        // sorting remove to action column
        var sortrmvcloumn1 = parseInt(iColumns - 2);
        var sortrmvcloumn2 = parseInt(iColumns - 1); // sorting remove to status column
		
        var autoid = $('#autoid').val();
        var i = 0;
        var frmid = '';

        if ($('#frmpara').length > 0) {
            frmid = "&frmpara=" + $('#frmpara').val();
        }

         var modulename = $('#disptblname').val();
        var i = 0;
        var dataTable = $('#'+tablename).dataTable({
            initComplete: function() {
                if (typeof hdnFld != 'undefined') {}
                unloading();
            },
            "processing": true,
            "columnDefs": [{
				"searchable": true,
                "targets": [sortrmvcloumn1, sortrmvcloumn2],
                "orderable": false
            }],
           
            "destroy": true,
            "serverSide": true,
            "stateSave": true,
            "bStateSave": false,
			"language": {
            "paginate": {
            "previous": "<i class='flaticon-arrow-left-1'></i>",
            "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "processing": loading()
            },
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax": {
                url: "display-grid-data.php?finaltab=" + $('#disptblname').val() + frmid + '&autoid=' + autoid+attid+formid+tname+cusid, // json datasource		 
                type: "post", // method  , by default get
                error: function() { // error handling                  
                    $("#"+tablename).append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    unloading();
                }
            },
        });
    }
	//Datatable all page common function - END
	
	 function datatblCalAdvanceSearch_order(hdnFld)
	{
 		var orders_name="&orders_name="+$('#orders_name').val();		
		var email="&email="+$('#email').val();		
		var status="&status="+$('#status').children("option:selected").val();;		
		var dateFrom="&dateFrom="+$('#dateFrom').val();
		var dateTo="&dateTo="+$('#dateTo').val();
		
		var tablename = 'ecommerce-order-list';
        var iColumns = $('#'+tablename+' thead th').length; // count all column length
        // sorting remove to action column
        var sortrmvcloumn1 = parseInt(iColumns - 2);
        var sortrmvcloumn2 = parseInt(iColumns - 1); // sorting remove to status column
		
        var autoid = $('#autoid').val();
        var i = 0;
        var frmid = '';

        if ($('#frmpara').length > 0) {
            frmid = "&frmpara=" + $('#frmpara').val();
        }

         var modulename = $('#disptblname').val();
        var i = 0;
		
		
        var dataTable = $('#'+tablename).dataTable({
            initComplete: function() {
                if (typeof hdnFld != 'undefined') {}
                unloading();
            },
            "processing": true,
            "columnDefs": [{
				"searchable": true,
                "targets": [sortrmvcloumn1, sortrmvcloumn2],
                "orderable": false
            }],
           
            "destroy": true,
            "serverSide": true,
            "stateSave": true,
            "bStateSave": false,
			"language": {
            "paginate": {
            "previous": "<i class='flaticon-arrow-left-1'></i>",
            "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "processing": loading()
            },
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax":{
                url :"display-grid-data.php?finaltab="+$('#disptblname').val()+orders_name+email+status+dateFrom+dateTo, // json datasource
                type: "post",  // method  , by default get
				//data : $("#productList").serializeArray(),
                error: function(){  // error handling                  
                    $("#tblresult").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					unloading(); 
                }
            },
        });
    }
	
	 function datatblCalAdvanceSearch(hdnFld,tablename)
	{
 		//var tablename = 'tblresult';
        var iColumns = $('#'+tablename+' thead th').length; // count all column length
         var sortrmvcloumn1 = parseInt(iColumns - 2);
        var sortrmvcloumn2 = parseInt(iColumns - 1); // sorting remove to status column
		
        var autoid = $('#autoid').val();
        var i = 0;
        var frmid = '';

        if ($('#frmpara').length > 0) {
            frmid = "&frmpara=" + $('#frmpara').val();
        }

         var modulename = $('#disptblname').val();
        var i = 0;
        var dataTable = $('#'+tablename).dataTable({
            initComplete: function() {
                if (typeof hdnFld != 'undefined') {}
                unloading();
            },
            "processing": true,
            "columnDefs": [{
				"searchable": true,
                "targets": [sortrmvcloumn1, sortrmvcloumn2],
                "orderable": false
            }],
           
            "destroy": true,
            "serverSide": true,
            "stateSave": true,
            "bStateSave": false,
			"language": {
            "paginate": {
            "previous": "<i class='flaticon-arrow-left-1'></i>",
            "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "processing": loading()
            },
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax":{
                url :"display-grid-data.php?finaltab="+$('#disptblname').val(), // json datasource
                type: "post",  // method  , by default get
				 data : $("#productList").serializeArray(),
                error: function(){  // error handling                  
                    $("#tblresult").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					unloading(); 
                }
            },
        });
    }
	
	  //Active / inactive change all page common function - START
	 function funchangestatus(t, $frm, $par) {		 
		  swal({
			title: 'Are you sure?',
			text: "Sure you want to change the status?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, change it!",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
           $.ajax({
                    url: $frm,
                    method: 'POST',
                    dataType: 'json',
                    data: $par,
                    beforeSend: function() {
                        loading();
                    },
                    success: function(response) {
                       
                        if (response.rslt == '6') {
							toast({type: 'success',title: statusmsg});
                            datatblCal(dataGridHdn);
							if($frm == 'product_actions.php'){
							datatblCalAdvanceSearch(dataGridHdn,'ecommerce-product-list');
							}
							
                        }else if (response.rslt == '7') {
							toast({type: 'warning',title: exsmsg_refstats});                           
                        }
                        else {
                           toast({type: 'warning',title: othmsg});
                        }
                        unloading();
                    }
                });
        }else{
			
		}
      })
	  
    }
    //Active / inactive change all page common function - END

    //Delete data all page common function - START
    function funStats(t, $frm, $par) {
        swal({
			title: 'Are you sure?',
			text: "Once deleted, you will not be able to recover these details!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, delete it!",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {						 
                $.ajax({
                    url: $frm,
                    method: 'POST',
                    dataType: 'json',
                    data: $par,
                    beforeSend: function() {
                        loading();
                    },
                    success: function(response) {
                        unloading();
                        if (response.rslt == '5') {
							toast({type: 'success',title: delmsg});
                            datatblCal(dataGridHdn);
							
							if($frm == 'product_actions.php'){
							datatblCalAdvanceSearch(dataGridHdn,'ecommerce-product-list');
							}
							
							
                        }else if (response.rslt == '7') {
                           toast({type: 'warning',title: exsmsg_refstats});
                        }
						
						if($frm == 'homepageslider_actions.php'){
location.reload();						}
                    }
                });
			}

            });
    }
    //Delete data all page common function - END
	
	//Form submit all page common function - START
	function funSubmt($frm, $urll, $acts, $stats, $lodlnk) {
if($stats == 'shippingflat' || $stats == 'shippingfree' || $stats == 'shippingprice')
	{
		$cntid = $("#txtcountryid").val();
		$("#cntyid").val($cntid);
	
		$sttid = $("#txtstateid").val();
		$("#sttid").val($sttid);
	}
	
	var appenddata="";
	if($frm == 'frmCoupon' || $frm == 'frmDiscount') 
	{
		 
		 var checkedIds = $('#tree').jstree('get_selected');//tree.getCheckedNodes();
 		  if(checkedIds != ''){
		   appenddata='&categoryIDs='+checkedIds; 
		  }else{
			  appenddata="";
		  }
		
	}
	
		if ($('#' + $acts).valid()) {
			//if($(".form-horizontal").jqBootstrapValidation()){
             $("button").attr('disabled',true);
			 
            $.ajax({
                url: $urll,
                method: 'POST',
                dataType: 'json',
                data: $("#" + $acts).serialize()+appenddata,
                beforeSend: function() {
                   loading();
                },
                success: function(response) {
				 
					$('button').removeAttr("disabled");
					
                    if (response.rslt == "1") {
						toast({type: 'success',title: $stats + ' ' + sucmsg,padding: '1em'});						                        
                        $("#" + $acts)[0].reset();                         
                        setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 2400);						
                    } 
					else if (response.rslt == "2") {
                      toast({type: 'success',title: $stats + ' ' + upmsg,padding: '1em'});
					    
                        $("#" + $acts)[0].reset();
                        //	$(location).attr('href', $lodlnk);
                        setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 2400);
                    }
                    else if (response.rslt == "3") {
                        toast({type: 'warning',title:exsmsg,padding: '1em'});						 
                    }
                    else if (response.rslt == "4") {
                        toast({type: 'warning',title:reqmsg,padding: '1em'});
					 
                    } else if (response.rslt == '7') {
                        toast({type: 'warning',title:exsmsg_refstats,padding: '1em'});
						  
                    } else {

                         toast({type: 'warning',title:othmsg,padding: '1em'});
                     }                   
                    $("button").attr('disabled', false);
					if (response.rslt != "1" && response.rslt != "2") {
					 unloading();
					}
                }
            });
        }
    }
	//Form submit all page common function - END
	
	//Cancel all page common function - START	 
    function funCancel($frm, $acts, $stats, $lodlnk) {
		 swal({
			//title: 'Are you sure?',
			 text: "Are you sure to cancel?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Okay",
			padding: '0.5em'
     	 }).then(function(result) {
			if (result.value) {		
			 $(location).attr('href', $lodlnk);
			
			}
		 });
        }
    //Cancel all page common function - END
	
	 //Save data to db Image upload page common function - START		
    function funSubmtWithImg($frm, $urll, $acts, $stats, $lodlnk) {
         
         if ($('#' + $acts).valid()) {
            
       
	  //   $("button").attr('disabled',true);
            //$(".clientValidationError.form-group").removeClass("has-error");
            var m_data = new FormData();

            var formdatas = $("#" + $acts).serializeArray();

            $.each(formdatas, function(key, value) {
                m_data.append(value.name, value.value);
            });
			
			
            if ($stats == 'user' || $stats == 'User') {
                m_data.append('user_photo', $('input[name=user_photo]')[0].files[0]);
            }
			
			if ($stats == 'Videos' || $stats == 'Videos') {
                m_data.append('video_image', $('input[name=video_image]')[0].files[0]);
            }

            if ($stats == 'profile') {
                m_data.append('user_photo', $('input[name=user_photo]')[0].files[0]);
            }
            
            if ($stats == 'InsuranceCompanies') {
                m_data.append('cmy_logo', $('input[name=cmy_logo]')[0].files[0]);
            }   
            
            if ($stats == 'Banner') {
                m_data.append('bannerimage', $('input[name=bannerimage]')[0].files[0]);
                 m_data.append('mobileimage', $('input[name=mobileimage]')[0].files[0]);
				 
				  m_data.append('bannerimage_es', $('input[name=bannerimage_es]')[0].files[0]);
                 m_data.append('mobileimage_es', $('input[name=mobileimage_es]')[0].files[0]);
				 
				  m_data.append('bannerimage_pt', $('input[name=bannerimage_pt]')[0].files[0]);
                 m_data.append('mobileimage_pt', $('input[name=mobileimage_pt]')[0].files[0]);
            } 
			
			if ($stats == 'News') {
                m_data.append('newsimage', $('input[name=newsimage]')[0].files[0]);
            }
			
			
			
            if ($stats == 'Events') {
                m_data.append('eventsimages', $('input[name=eventsimages]')[0].files[0]);
                m_data.append('eventsimages_es', $('input[name=eventsimages_es]')[0].files[0]);
                m_data.append('eventsimages_pt', $('input[name=eventsimages_pt]')[0].files[0]);
            }
			
			if($stats == 'manufacturer'){			
				m_data.append( 'manufactImage', $('input[name=manufactImage]')[0].files[0]);			
			}
			
			if($stats == 'client'){			
				m_data.append( 'mcimage', $('input[name=mcimage]')[0].files[0]);			
			}
			
			if($stats == 'shippingcharge'){	
 				m_data.append( 'shippingimage', $('input[name=shippingimage]')[0].files[0]);
			}
		
			if($stats == 'individual'){			
				m_data.append( 'catalogattachment', $('input[name=catalogattachment]')[0].files[0]);			
			}
            
            if ($stats == 'configuration') {
                var fileInput = document.getElementById("ecomLogo");
                var fileInpute = document.getElementById("watermark");

                var message = "";
                if ('files' in fileInput) {
                    if (fileInput.files.length == 0) {
                        message = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput.files.length; i++) {
                            message += "<br /><b>" + (i + 1) + ". file</b><br />";
                            var file = fileInput.files[i];


                            m_data.append('ecomLogo', file);
                        }
                    }
                }


                if ('files' in fileInpute) {
                    if (fileInpute.files.length == 0) {
                        message = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInpute.files.length; i++) {
                            message += "<br /><b>" + (i + 1) + ". file</b><br />";
                            var file = fileInpute.files[i];
                            m_data.append('watermark', file);
                        }
                    }
                } 

                var fileInput2 = document.getElementById("favIcon");
                var message2 = "";
                if ('files' in fileInput2) {
                    if (fileInput2.files.length == 0) {
                        message2 = "Please browse for one or more files.";
                    } else {
                        for (var j = 0; j < fileInput2.files.length; j++) {
                            message2 += "<br /><b>" + (j + 1) + ". file</b><br />";
                            var filen = fileInput2.files[j];
                            m_data.append('favIcon', filen);
                        }
                    }
                }
            }
			
			
			 if($stats == 'knowledgecenter'){				 
				 	m_data.append( 'knowledgecenterimage', $('input[name=knowledgecenterimage]')[0].files[0]);			
					//q1pdffile
					 var fileInput2 = document.getElementById("option_max_count");
					 for(i=0;i<=fileInput2;i++) {		
						 m_data.append( 'q1pdffile'+i, $('input[name=q1pdffile'+i+']')[0].files[0]);	
					 }
					 
					 var fileInput3 = document.getElementById("option_max_count_es");
					 for(j=0;j<=fileInput3;j++) {		
						 m_data.append( 'q1pdffile_es'+j, $('input[name=q1pdffile_es'+j+']')[0].files[0]);	
					 }
					 
					 var fileInput4 = document.getElementById("option_max_count_pt");
					 for(k=0;k<=fileInput4;k++) {		
						 m_data.append( 'q1pdffile_pt'+k, $('input[name=q1pdffile_pt'+k+']')[0].files[0]);	
					 }
			 }

 if($stats == 'newsimage'){
			var fileInput = document.getElementById ("newsimage");
            var message = "";
            if ('files' in fileInput) {
                if (fileInput.files.length == 0) {
                    message = "Please browse for one or more files.";
                } else {
                    for (var i = 0; i < fileInput.files.length; i++) {
                        message += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file = fileInput.files[i];
                        m_data.append('newsimage[]', file);                       
                    }
                }
            }
											
		}
		
		if ($stats == 'productimages') {
			var fileInput = document.getElementById ("productimage");
            var message = "";
            if ('files' in fileInput) {
                if (fileInput.files.length == 0) {
                    message = "Please browse for one or more files.";
                } else {
                    for (var i = 0; i < fileInput.files.length; i++) {
                        message += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file = fileInput.files[i];
                        m_data.append('productimage[]', file);                       
                    }
                }
            }
			
             //   m_data.append('product_images', $('input[name=productimage]')[0].files[0]);
            }
			
			
		
		 if($stats == 'eventsimages'){
			var fileInput = document.getElementById ("eventsimages");
            var message = "";
            if ('files' in fileInput) {
                if (fileInput.files.length == 0) {
                    message = "Please browse for one or more files.";
                } else {
                    for (var i = 0; i < fileInput.files.length; i++) {
                        message += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file = fileInput.files[i];
                        m_data.append('eventsimages[]', file);                       
                    }
                }
            }
            
            
            var fileInput_es = document.getElementById ("eventsimages_es");
            var message_es = "";
            if ('files' in fileInput_es) {
                if (fileInput_es.files.length == 0) {
                    message_es = "Please browse for one or more files.";
                } else {
                    for (var i = 0; i < fileInput_es.files.length; i++) {
                        message_es += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file_es = fileInput_es.files[i];
                        m_data.append('eventsimages_es[]', file_es);                       
                    }
                }
            }
            
            
            var fileInput_pt = document.getElementById ("eventsimages_pt");
            var message_pt = "";
            if ('files' in fileInput_pt) {
                if (fileInput_pt.files.length == 0) {
                    message_pt = "Please browse for one or more files.";
                } else {
                    for (var i = 0; i < fileInput_pt.files.length; i++) {
                        message_pt += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file_pt = fileInput_pt.files[i];
                        m_data.append('eventsimages_pt[]', file_pt);                       
                    }
                }
            }
											
		}
		
 
            if ($stats == 'offer') {
                m_data.append('offerimage', $('input[name=offerimage]')[0].files[0]);
            }

            if ($stats == 'coupon') {
                m_data.append('couponimage', $('input[name=couponimage]')[0].files[0]);
            }

            if ($stats == 'testimonial') {
                m_data.append('testimonialimage', $('input[name=testimonialimage]')[0].files[0]);
            }

    		if($stats == 'attributes'){	
    		    
    			if($("#tstedt").val())
    			{		
                  	var inputs = $("input[type=file]");			
    			  	for(var i=0; i<inputs.length; i++){    				
    				 	m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
    			  	}    				
    			}
    			else
    			{    				
    				var inputs = $("input[type=file]");			
    			  	for(var i=0; i<inputs.length; i++){
    				 	m_data.append('attributeicons[]', $("input[type=file]")[i].files[0]);
    			  	}    				
    			}	
    		}
			
			if($stats == 'productfeature'){	
    		    
    				
                  	var inputs = $("input[type=file]");			
    			  	for(var i=0; i<inputs.length; i++){    				
    				 	m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
    			  	}    				
    			
    		}
			
			 
			 if($stats == 'product'){	
    		    
    				
                  	var inputs = $("input[type=file]");			
    			  	for(var i=0; i<inputs.length; i++){    				
    				 	m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
    			  	}    				
    			
    		}
			
    		
    		if($stats == 'category'){	
			//m_data.append('menuimage', $('input[name=categorymenuimage]')[0].files[0]);
				
				var fileInputm = document.getElementById ("categorymenuimage");
                var messagem = "";
                if ('files' in fileInputm) {
                    if (fileInputm.files.length == 0) {
                        messagem = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInputm.files.length; i++) {
                            messagem += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInputm.files[i];
                            m_data.append('menuimage', file);                       
                        }
                    }
                }
				
				
				var fileInputm_es = document.getElementById ("categorymenuimage_es");
                var messagem_es = "";
                if ('files' in fileInputm_es) {
                    if (fileInputm_es.files.length == 0) {
                        messagem_es = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInputm_es.files.length; i++) {
                            messagem_es += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInputm_es.files[i];
                            m_data.append('menuimage_es', file);                       
                        }
                    }
				}
					
				var fileInputm_pt = document.getElementById ("categorymenuimage_pt");
                var messagem_pt = "";
                if ('files' in fileInputm_pt) {
                    if (fileInputm_pt.files.length == 0) {
                        messagem_pt = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInputm_pt.files.length; i++) {
                            messagem_pt += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInputm_pt.files[i];
                            m_data.append('menuimage_pt', file);                       
                        }
                    }
                }
				
    		
    			var fileInput = document.getElementById ("categoryImage");
                var message = "";
                if ('files' in fileInput) {
                    if (fileInput.files.length == 0) {
                        message = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput.files.length; i++) {
                            message += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput.files[i];
                            m_data.append('categoryImage[]', file);                       
                        }
                    }
                }	
				
				var fileInput_es = document.getElementById ("categoryImage_es");
                var messagees = "";
                if ('files' in fileInput_es) {
                    if (fileInput_es.files.length == 0) {
                        messagees = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_es.files.length; i++) {
                            messagees += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_es.files[i];
                            m_data.append('categoryImage_es[]', file);                       
                        }
                    }
                }
				
				var fileInput_pt = document.getElementById ("categoryImage_pt");
                var messagept = "";
                if ('files' in fileInput_pt) {
                    if (fileInput_pt.files.length == 0) {
                        messagept = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_pt.files.length; i++) {
                            messagept += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_pt.files[i];
                            m_data.append('categoryImage_es[]', file);                       
                        }
                    }
                }
    			
    			var fileInput = document.getElementById ("mobimage");
    			
                var message = "";
                if ('files' in fileInput) {
                    if (fileInput.files.length == 0) {
                        message = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput.files.length; i++) {
                            message += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput.files[i];
                            m_data.append('mobimage[]', file);                       
                        }
                    }
                }

var fileInput_es = document.getElementById ("mobimage_es");
    			
                var message_es = "";
                if ('files' in fileInput_es) {
                    if (fileInput_es.files.length == 0) {
                        message_es = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_es.files.length; i++) {
                            message_es += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_es.files[i];
                            m_data.append('mobimage_es[]', file);                       
                        }
                    }
                }
				
				var fileInput_pt = document.getElementById ("mobimage_pt");
    			
                var message_pt = "";
                if ('files' in fileInput_pt) {
                    if (fileInput_pt.files.length == 0) {
                        message_pt = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_pt.files.length; i++) {
                            message_pt += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_pt.files[i];
                            m_data.append('mobimage_pt[]', file);                       
                        }
                    }
                }	

				
    		}    		
			
			
			if($stats == 'newsevent'){
				var fileInput = document.getElementById ("events_images");
				var message = "";
				if ('files' in fileInput) {
					if (fileInput.files.length == 0) {
						message = "Please browse for one or more files.";
					} else {
						for (var i = 0; i < fileInput.files.length; i++) {
							message += "<br /><b>" + (i+1) + ". file</b><br />";
							var file = fileInput.files[i];
							m_data.append('events_images[]', file);                       
						}
					}
				}	
			}
			
			if($stats == 'product'){
					
					m_data.append( 'brochureimage', $('input[name=brochureimage]')[0].files[0]);	
					m_data.append( 'brochureimage_es', $('input[name=brochureimage_es]')[0].files[0]);	
					m_data.append( 'brochureimage_pt', $('input[name=brochureimage_pt]')[0].files[0]);	
					
			var fileInput = document.getElementById ("product_images");
			
			
            var message = "";
            if ('files' in fileInput) {
                if (fileInput.files.length == 0) {
                    message = "Please browse for one or more files.";
                } else {
                    for (var i = 1; i < fileInput.files.length; i++) {
                        message += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file = fileInput.files[i];
                        m_data.append('product_images[]', file);                       
                    }
                }
            }	
			
			 var checkedIds = $('#tree').jstree('get_selected');//tree.getCheckedNodes();
 		 	 m_data.append('categoryIDs', checkedIds); 
		  
			}
		
		if($stats == "product" ||  $stats == "relatedProductsForm"){
			if($stats == "product"){				
				var formdatastmp = $("#relatedProductsForm").serializeArray();			
				$.each( formdatastmp, function( key, value ) {
					 m_data.append( value.name, value.value);							 
				});
			}
			else if($stats == "relatedProductsForm"){
				var formdatastmp = $("#jvalidate").serializeArray();			
				$.each( formdatastmp, function( key, value ) {
					 m_data.append( value.name, value.value);							 
				});
			//	var fileInput = document.getElementById ("product_images");
				//var message = "";
				/*if ('files' in fileInput) {
					if (fileInput.files.length == 0) {
						message = "Please browse for one or more files.";
					} else {
						for (var i = 0; i < fileInput.files.length; i++) {
							message += "<br /><b>" + (i+1) + ". file</b><br />";
							var file = fileInput.files[i];
							m_data.append('product_images[]', file);                       
						}
					}
				}*/							
			}
        //m_data.append( 'uploadecustomizedimg', $('input[name=uploadecustomizedimg]')[0].files[0]);
			
		}

            $.ajax({
                url: $urll,
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: m_data,
                beforeSend: function() {
                  
				   //loading();
                },
                success: function(response) {
						//  $('button').removeAttr("disabled");
                    if (response.rslt == "1") {
						
						 toast({type: 'success',title:$stats + ' ' + sucmsg,padding: '1em'});
                         $("#" + $acts)[0].reset();

                        setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 1200);
                    } 
					else if (response.rslt == "2") {
						 toast({type: 'success',title:$stats + ' ' + upmsg,padding: '1em'});
						 $("#" + $acts)[0].reset();
						 
                         setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 1200);
                    }                                        
                    else if (response.rslt == "3") {
						 toast({type: 'warning',title:exsmsg,padding: '1em'});
                    }
					else if (response.rslt == "4") {
                        toast({type: 'warning',title:$stats + ' ' + reqmsg,padding: '1em'});						
                    } 
					else if (response.rslt == '7') {
                         toast({type: 'warning',title:exsmsg_refstats,padding: '1em'});
                    }
					else if (response.rslt == '17') {
                         toast({type: 'warning',title:"Image field required",padding: '1em'});
                    }
					else if (response.rslt == "8") {
                        toast({type: 'warning',title:$stats + ' ' + response.msg,padding: '1em'});
                    } 
					else if (response.rslt == "9") {
                        $("#bulk_upload_result").css({
                            "background-color": "#FFC0C0",
                            "color": "#800000"
                        });
                        $("#bulk_upload_result").show();
                        $("#bulk_upload_result").empty();
                        $("#bulk_upload_result").append("<br><h4><b>&nbspUpload Summary : Error List</b></h4><br>");
						
                        $("#bulk_upload_result").append(response.all_error + "<br>");
                    }
					else if (response.rslt == "11") {
						 toast({type: 'warning',title:".xls is the only allowed file format.",padding: '1em'});
                    }
					else {
                        toast({type: 'warning',title:othmsg,padding: '1em'});
                    }

                    if (response.rslt != "1" && response.rslt != "2") {
					
				 	// unloading();
					}
                 
				    // $("button").attr('disabled',false); 

                }
            });
        }
    }
	
	function remove_sorting_columns(){
		var iColumns = $('#tblresult thead th').length;  // count all column length
		var sortrmvcloumn1 = parseInt(iColumns-2); // sorting remove to action column
		var sortrmvcloumn2 = parseInt(iColumns-1); // sorting remove to status column   	
		disptblclumn = $('#disptblname').val();
		var temprow=[];		
		var rmvfilterclumn = 0;
		
		if(disptblclumn == "customfields"){
			rmvfilterclumn = $('#rmvsorting_clumns').val();		
		}
		
		if(disptblclumn == "shipping" || disptblclumn == "customerreviews"){
			rmvfilterclumn = $('#rmvsorting_clumns').val();		
		}
		
		
		if(rmvfilterclumn == 0){
			temprow.push(sortrmvcloumn1,sortrmvcloumn2);	 
			return temprow;
		}
		else{
			var row = rmvfilterclumn.split(",").map(Number);				
			$.each(row, function( index, value ) {	
			 temprow.push(parseInt(value));			  
			});	
			temprow.push(sortrmvcloumn1,sortrmvcloumn2);	 
			return temprow;
		}
		
	}
    //Save data to db Image upload page common function - END	
	
	
	//Save data to db all page common function - START		
function funSubmtNoMsg($frm,$urll,$acts,$stats,$lodlnk)
{    
	if ($('#'+$acts).valid()) {
		$("button").attr('disabled',true);
		
		$.ajax({
			url        : $urll,
			method     : 'POST',
			dataType   : 'json',
			data       : $("#"+$acts).serialize(),
			beforeSend: function() {
				loading();
 			},
			success: function(response){ 
			
			    if(response.rslt == "1"){															
					$("#"+$acts)[0].reset();
					$(location).attr('href', $lodlnk);
				}
				else if(response.rslt == "2"){
					toast({type: 'sucess',title:$stats +' '+ upmsg,padding: '1em'});
 					$("#"+$acts)[0].reset();
					$(location).attr('href', $lodlnk);
				}			
			    else if(response.rslt == "3"){
					 toast({type: 'warning',title:$stats +' '+ exsmsg,padding: '1em'});
				}
				else if(response.rslt == "4"){
					 toast({type: 'warning',title:$stats +' '+ reqmsg,padding: '1em'});
				}
				else{
					 toast({type: 'warning',title:othmsg,padding: '1em'});
				}		
			
				unloading();
				$("button").attr('disabled',false); 
				
			}
		});
	}	
}
//Save data to db all page common function - END	


	</script>
    
    <script type="text/javascript">
$(document).ready(function(){
	$(".common_upload_style").filer({
		extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
		limit: 1
	});
	$(".common_upload_style_xl").filer({		
		limit: 1
	});
	$(".common_upload_style_pdf").filer({		
		extensions: ['pdf'],
		limit: 1
	});
});

$('.calldatepicker').daterangepicker({
	locale: {
            format: 'DD-MM-YYYY'
        },
                singleDatePicker: true,
                showDropdowns: true,
				//"autoUpdateInput": false,drops: 'left'
                // drops: 'up'
            });
			
/*
$('.calldatepickers').daterangepicker({
    "singleDatePicker": true,
	  locale: {
            format: 'DD-MM-YYYY'
        },
    "linkedCalendars": true,
    "autoUpdateInput": true,
	,
    "showCustomRangeLabel": false  
	
});*/
</script>
</body></html>