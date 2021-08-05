<?php 
$menudisp = "orders";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeOrders($db,'');
include_once "includes/pagepermission.php";
 
 
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check permission - END

?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "includes/sidebar.php";?>
  
  <!--  END SIDEBAR  --> 
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Orders</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Orders Management</a></li>
              <li class="active"><a href="#">Orders</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-md-8">
                  <h4>Manage Orders</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
            
            
              <form class="form-horizontal form-val-1" id="productList" name="frmState" action="#" novalidate="">
                <div class="row col-sm-12">
                  <label class="col-sm-2 control-label">Orders No </label>
                  <div class="col-sm-4">
                    <input class="pFilters form-control" type="text" name="orders_name" id="orders_name" />
                  </div>
                  <label class="col-sm-2 control-label">Customer Email </label>
                  <div class="col-sm-4">
                    <input class="pFilters form-control" type="text" name="email" id="email" />
                  </div>
                </div>
                <?php 
							$strGetStatus  = "SELECT * FROM  `".TPLPrefix."order_status` where IsActive = 1";
							$resultStatus = $db->get_rsltset($strGetStatus);						
							?>
                <div class="row">&nbsp;</div>
                <div class="row col-sm-12">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-4">
                    <select class=" form-control" id="status" name="status">
                      <option value ="-1">All</option>
                      <?php foreach($resultStatus as $stval){ ?>
                      <option value ="<?php echo $stval['order_statusId']; ?>"><?php echo $stval['order_statusName']; ?></option>
                      <?php }  ?>
                    </select>
                  </div>
                  <label class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-2">
                    <div class="input-control text " data-role="datepicker"   data-format="dd-mm-yyyy">
                      <input type="text" placeholder="From" name="dateFrom" id="dateFrom" readonly>
                      <button class="button"><span class="flaticon-calendar-1"></span></button>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="input-control text " data-role="datepicker"   data-format="dd-mm-yyyy">
                      <input type="text" placeholder="From" name="dateTo" id="dateTo" readonly>
                      <button class="button"><span class="flaticon-calendar-1"></span></button>
                    </div>
                  </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                  <div class="col col-md-8">&nbsp;</div>
                  <div class="col col-md-4">
                    <div class="control-group mb-4">
                      <div class="controls">
                        <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onclick="advanceSearch()">Search</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="table-responsive mb-4">
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "orders"; ?>" />
                <table  id="ecommerce-order-list"  class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Order</th>
                      <th>Order Details</th>
                      <th>Purchased On</th>
                      <th>Order Value</th>
					  <th>Language</th>
                      <th>Mode of Payment</th>
                      <th>Payment status</th>
                      <th>Order status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  END CONTENT PART  --> 
</div>
<!-- END MAIN CONTAINER --> 

<div class="modal fade" id="changedstatuscomment" tabindex="-1" role="dialog" aria-labelledby="changedstatus" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<h4>Comments</h4>
<div class="modal-body">
<p>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<div class=" tui-full-calendar-popup-detail">
  <textarea id="txtcomment" name="txtcomment" ></textarea>
  <input type="hidden" id="staorderId" name="staorderId" value=""/>
  <input type="hidden" id="staorderVal" name="staorderVal" value=""/>
  <input type="hidden" id="staordertext" name="staordertext" value=""/>
 	
  <input type="button" class="btncomments" value="Submit" onclick="javascript:btnsubmitclick();" />         
  
</div>
</p>
</div>
</div>
</div>
</div>
<div class="modal fade beacon-modal" id="order_status_modal"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content address-modal modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" ></h4>
      </div>
      <div class="modal-body"> </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->
<!--<link rel="stylesheet" type="text/css" href="assets/css/ecommerce/order.css">
-->
 <script>
 
 function update_order_status(status_id,order_id){
    
     if(status_id=='3' || status_id=='5' || status_id=='14'){
        var $modal = $('#order_status_modal');	
        $modal.load('order_status_change.php',{'status_id':status_id,'order_id':order_id},
        function(){  
        $modal.modal('show'); 
        
        }
        );
         
     }else{
         
         swal({
			title: "Do you want to change?",
			//text: "Sure you want to change the status?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, change it!",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
            
            
            var m_data = 'action=change_Order_Status&order_id='+order_id+'&status_id='+status_id;
            $.ajax({
                url        : 'orders_actions.php',
                method     : 'POST',
                dataType   : 'json',
                data       : m_data,
                beforeSend: function() {
                loading();
                },
                success: function(response){ 
                    if(response.rslt=='1'){
                        toast({type: 'success',title: "Order status changed successfully"});            
                        datatblCalAdvanceSearch_order(dataGridHdn);
                        ordermailfunction(order_id,status_id);
                    }
                    
                   //unloading();
                }
            });
            
           /* $.ajax({
					url:"<?php echo BASE_URL.'orders_actions.php' ?>",
					data :{action:"changePaymentStatus",order_id:order_id,status_id:status_id},
					method     : 'POST',
					dataType   : 'json',
					success: function(response){
						 if(response.rslt == "1"){
							 
							toast({type: 'success',title: "Payment status changed successfully"});            
							 datatblCalAdvanceSearch_order(dataGridHdn);
							 
							 
							 
						 }
					}			
			    });*/
			    
        }
        
         
     });
	
		
}


}

function updateorderstatus(status_id,order_id){
    var ref='';
    if(status_id==3){
        ref = '&txtawb_refno='+$("#txtawb_refno").val();
    }
    if(status_id==14){
        ref = '&txtsap_refno='+$("#txtsap_refno").val();
        
    }
    if(status_id==5){
        ref = '&txtutr_refno='+$("#txtutr_refno").val();
        
    }
    var m_data = 'action=change_Order_Status&order_id='+order_id+'&status_id='+status_id+ref;
            $.ajax({
                url        : 'orders_actions.php',
                method     : 'POST',
                dataType   : 'json',
                data       : m_data,
                beforeSend: function() {
                loading();
                },
                success: function(response){ 
                    if(response.rslt=='1'){
                        toast({type: 'success',title: "Order status changed successfully"});   
                        $('#order_status_modal').modal('hide');
                        //$('#order_status_modal').modal().hide();
                        datatblCalAdvanceSearch_order(dataGridHdn);
                        ordermailfunction(order_id,status_id);
                    }
                    
                   //unloading();
                }
            });
}
function ordermailfunction(orderId,status_id){     	
	$.ajax({
		url:'<?php echo BASE_URL;?>ajaxresponse.php',
		data :{action:"ordermailsend",order_id:orderId,status_id:status_id},
		method     : 'POST',
		dataType   : 'json',			
	})
			
}

 $(document).ready(function(){
	 
	 $(".adv_filterbutton").click(function(){
		$("#advance_filter_div").fadeToggle(function()
			{
			 $('#closefilter').toggle();
			 $('#advance_filtertxt').toggle();
			});
		
	 });
	 
	 
	 var flag = 0;
	 $('#tblresult').on('xhr.dt', function ( e, settings, json, xhr ) {
		 if(flag == 0){
			 $("#tblresult th").eq(0).trigger("click");		
			 flag = 1;
		 }		 
	 }).dataTable( );
	 
	 
	 $(document).ready(function($){
		$(document).on("change",".orders_mangement",function(){
		
			var orderId = $(this).data('orderid');
			var orderVal = $(this).val();
			var orderText = $('option:selected',this).text();	
          //alert(orderId+" "+orderVal+" "+orderText);		
	  
			$("#staorderId").val(orderId);
			$("#staorderVal").val(orderVal);
			$("#staordertext").val(orderText);
			
			$('#changedstatuscomment').modal('show');
			//$("successModal").modal("show");
			
		/*swal({
		title: "Do you want to change?",
		//text: "Do you want to cancel?",
		type: "warning",
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ok",
		cancelButtonText: "Cancel",
		showCancelButton: true,
		closeOnConfirm: true
		},
		function (isConfirm) {
			if(isConfirm){
				
				
				$.ajax({
					url:"<?php echo BASE_URL.'orders_actions.php' ?>",
					data :{action:"changeOrderStatus",order_id:orderId,status_id:orderVal},
					method     : 'POST',
					dataType   : 'json',
					success: function(response){
						 if(response.rslt == "1"){
							 var temp = "#order_status_"+orderId;
							 $(temp).html(orderText);
							 swal("Success!", "Order status changed successfully", "success");
							 
							 if(response.statusid=="14"){
								 //alert(response.statusid);
								datatblCalAdvanceSearch_order(dataGridHdn);
							 }
							 
						 }
					}			
			    })
				mailfunction(orderId,orderText);
			}
			else{
				datatblCalAdvanceSearch_order(dataGridHdn);
			}

		});	*/
		
	
	});
		
	


		
	 });	 
 });
      $(function () {       
		datatblCalAdvanceSearch_order(dataGridHdn);
			
		$(document).keyup(function(e) {
			if (e.keyCode == 27) { 
			  	clearHtml();		  
			}
		});	

		$('#dateFrom,#dateTo').datepicker({					
				dateFormat: "mm-dd-yy",				
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+20",
				maxDate: new Date			
		});	

		
		
		//Ajax Autocomplete - starts
		$(".pFilters").each(function(){
			var optValue = $(this);
			var optName = $(this).attr("name");
			var options = {
			  url: function(phrase) {
				return "ajaxresponse.php";
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
		//Ajax Autocomplete - ends
			
		
      });
	  
	  function clearHtml(){
		  $(".price,.quantity").each(function(){
			  if($(this).find(".inlineChange").length > 0){
				   $(this).html($(this).find(".inlineChange").val());
			  }
		  }); 
	  }
	  
	  function advanceSearch(){
		  datatblCalAdvanceSearch_order(dataGridHdn);
	  }
	  
	
function btnsubmitclick()
{
	
	var orderId =	$("#staorderId").val();
	var orderVal = 	$("#staorderVal").val();
	var orderText =	$("#staordertext").val();
	var ordercomment =	$("#txtcomment").val();
	
	  swal({
			title: "Do you want to change?",
			//text: "Sure you want to change the status?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, change it!",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
			
	 
					 
				
				$.ajax({
					url:"<?php echo BASE_URL.'orders_actions.php' ?>",
					data :{action:"changeOrderStatus",order_id:orderId,status_id:orderVal,comment:ordercomment},
					method     : 'POST',
					dataType   : 'json',
					success: function(response){
						 if(response.rslt == "1"){
							 var temp = "#order_status_"+orderId;
							 $(temp).html(orderText);
							toast({type: 'success',title: "Order status changed successfully"});            
							 
							 
							 if(response.statusid=="14"){
								 //alert(response.statusid);
								datatblCalAdvanceSearch_order(dataGridHdn);
							 }
							 
						 }
					}			
			    })
				mailfunction(orderId,orderText,ordercomment);
			}
			else{
				datatblCalAdvanceSearch_order(dataGridHdn);
			}

		});
}  

//For mail functionaties
function mailfunction(orderId,orderText,ordercomment){     	
	$.ajax({
		url:'<?php echo BASE_URL;?>ajaxresponse.php',
		data :{action:"mailsend",order_id:orderId,order_text:orderText,ordercomment:ordercomment},
		method     : 'POST',
		dataType   : 'json',			
	})
			
}
	  	  	  	 
  </script>	

