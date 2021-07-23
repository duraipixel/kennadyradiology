<?php 
$ordersdisp = "salereports";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeSaleReport($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check permission - END?>
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
          <h3>Sales Report</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Reports</a></li>
              <li class="active"><a href="#">Sales Report</a> </li>
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
                  <h4>Manage Sale Reports</h4>
                </div>
                <div class="col-md-4 align-right">
                  <h4>
                    <button class="btn btn-warning btn-rounded mb-4 mr-2" type="button" id="downlodrep"> <i class="fa fa-download text-green"></i> Download </button>
                  </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form class="form-horizontal form-val-1"  name="ordersList" id="productList">
                <div class="row col-sm-12">
                  <label class="col-sm-2 control-label">Group of </label>
                  <div class="col-sm-4">
                    <select class=" form-control orders_mangement" name="period" id="period">
                      <option value ="1">Days</option>
                      <option value ="2">Weeks</option>
                      <option value ="3">Month</option>
                      <option value ="4">Year</option>
                    </select>
                  </div>
                  <?php 
							$strGetStatus  = "SELECT * FROM  `".TPLPrefix."order_status` where IsActive = 1";
							$resultStatus = $db->get_rsltset($strGetStatus);						
							?>
                  <label class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-2">
                    <input type="text" placeholder="From" name="dateFrom" id="dateFrom" class="calldatepicker form-control" readonly>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" placeholder="From" class="calldatepicker form-control" name="dateTo" id="dateTo" readonly>
                  </div>
                </div>
                <?php 
							$strGetStatus  = "SELECT * FROM  `".TPLPrefix."order_status` where IsActive = 1";
							$resultStatus = $db->get_rsltset($strGetStatus);						
							?>
                <div class="row">&nbsp;</div>
                <div class="row col-sm-12">
                  <label class="col-sm-2 control-label">Status </label>
                  <div class="col-sm-4">
                    <select class=" form-control orders_mangement" name="orderstatus" id="orderstatus">
                      <option value ="">All</option>
                      <?php foreach($resultStatus as $stval){ ?>
                      <option value ="<?php echo $stval['order_statusId'] ?>"><?php echo $stval['order_statusName'] ?></option>
                      <?php }  ?>
                    </select>
                  </div>
                  <div class="col col-md-2">&nbsp;</div>
                  <div class="col col-md-4">
                    <div class="control-group mb-4">
                      <div class="controls">
                        <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onclick="advanceSearch()">Show Report</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="table-responsive mb-4">
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "salereports"; ?>" />
                <table id="tblresult" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Products Amount</th>
                      <th>Coupon Discounts</th>
                      <th id="curship">Shipping</th>
                      <th>Total</th>
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

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->

<script>
$(document).ready(function(){
var flag = 0;

$aa =  $('#tblresult').on('xhr.dt', function ( e, settings, json, xhr ) {
if(flag == 0){

//alert($("#currencyStat option:selected" ).text())
var thdiscount = $("#tblresult thead tr th").eq(2).html();			 
var thshipping = $("#tblresult thead tr th").eq(4).html();

$("#tblresult thead tr th").eq(2).html(thdiscount + ' (Rupee - INR)');			 
$("#tblresult thead tr th").eq(4).html(thshipping + ' (Rupee - INR)');
$("#tblresult thead tr th").eq(5).html('Total (Rupee - INR)');
$("#tblresult thead tr th").eq(6).html('Total (Rupee - INR)');

$("#tblresult th").eq(0).trigger("click");		
flag = 1;
}		 
}).dataTable();


$("#currencyStat").change(function()
{
if($("#currencyStat").val() != '')
{
var seldval = $("#currencyStat option:selected").text();
//$bb =  $('#tblresult').on('xhr.dt', function ( e, settings, json, xhr ) {
$("#tblresult thead tr th").eq(2).html('Discount (' + seldval+')');
$("#tblresult thead tr th").eq(4).html('Shipping (' + seldval+')');
$("#tblresult thead tr th").eq(5).html('Total (' + seldval+')');
$("#tblresult thead tr th").eq(6).html('Total (Rupee - INR)');
}
else
{
var seldval = 'Rupee - INR';
//$bb =  $('#tblresult').on('xhr.dt', function ( e, settings, json, xhr ) {
$("#tblresult thead tr th").eq(2).html('Discount (' + seldval+')');
$("#tblresult thead tr th").eq(4).html('Shipping (' + seldval+')');
$("#tblresult thead tr th").eq(5).html('Total (' + seldval+')');
$("#tblresult thead tr th").eq(6).html('Total (' + seldval+')');
}		

});


//  alert("Please wait while the data is loading...");
function calculateSum() {

var sum = 0;
//iterate through each textboxes and add the values
$(".totval").each(function() {

//add only if the value is number
if(!isNaN(this.value) && this.value.length!=0) {
sum += parseFloat(this.value);
}

});

//.toFixed() method will roundoff the final sum to 2 decimal places
// $("#sum").html(sum.toFixed(2));
}


$(document).ready(function($){	 
	$("#downlodrep").click(function(){
	var $orderId = '"'+ $("#qryid").val() +'"';
	
	var url = "salereport_download.php" 
	var period = $("#period").val();
	var fmdat = $("#dateFrom").val();
	var datto = $("#dateTo").val();
	var orderstatus = $("#orderstatus").val();
	var ot = window.open(url+'?period='+period+'&fmdat='+fmdat+'&datto='+datto+'&orderstatus='+orderstatus,"");
	
	})	
	});	 
});

$(function () {       
datatblCalAdvanceSearch(dataGridHdn,'tblresult');

$(document).keyup(function(e) {
if (e.keyCode == 27) { 
clearHtml();		  
}
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
datatblCalAdvanceSearch(dataGridHdn,'tblresult');
}
</script>