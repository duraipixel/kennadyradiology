<?php 
$ordersdisp = "custorderproducts";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmecustomerorderReport($db,'');
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
          <h3>Customer Orders Report</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Reports</a></li>
              <li class="active"><a href="#">Customer Orders Report</a> </li>
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
                  <h4>Customer Orders Report</h4>
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
                  <?php 
							$strGetStatus  = "SELECT * FROM  `".TPLPrefix."order_status` where IsActive = 1";
							$resultStatus = $db->get_rsltset($strGetStatus);						
							?>
                  <label class="col-sm-2 control-label">Status </label>
                  <div class="col-sm-4">
                    <select class=" form-control orders_mangement" name="orderstatus" id="orderstatus">
                      <option value ="">All</option>
                      <?php foreach($resultStatus as $stval){ ?>
                      <option value ="<?php echo $stval['order_statusId'] ?>"><?php echo $stval['order_statusName'] ?></option>
                      <?php }  ?>
                    </select>
                  </div>
                </div>
                <div class="col col-md-2">&nbsp;</div>
                <div class="row col-sm-12">
                  <div class="col col-md-8">&nbsp;</div>
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
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "custorderproducts"; ?>" />
                <table id="tblresult" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Email</th>
                      <!--<th>Group</th>			-->
                      <th id="curship">Status</th>
                      <th>Orders</th>
                      <th>Products</th>
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

$(".adv_filterbutton").click(function(){
$("#advance_filter_div").fadeToggle(function()
{
$('#closefilter').toggle();
$('#advance_filtertxt').toggle();
});

});


var flag = 0;

$aa =  $('#tblresult').on('xhr.dt', function ( e, settings, json, xhr ) {
if(flag == 0){
$("#tblresult th").eq(0).trigger("click");		
flag = 1;
}		 
}).dataTable({
"columnDefs": [ 
{ "name": "fstday",   "targets": 0 },
{ "name": "browser",  "targets": 1 },
{ "name": "platform", "targets": 2 },
{ "name": "version",  "targets": 3 },
{ "name": "grade",    "targets": 4 }
]});
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

var url = "customerreport_download.php" 
var period = '';
var fmdat = $("#dateFrom").val();
var datto = $("#dateTo").val();
var orderstatus = $("#orderstatus").val();
var currencyStat = $("#currencyStat").val();
var ot = window.open(url+'?period='+period+'&fmdat='+fmdat+'&datto='+datto+'&orderstatus='+orderstatus+'&currencyStat='+currencyStat,"");
//var orderText = $('option:selected',this).text();			

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