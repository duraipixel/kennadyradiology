<?php 
$productdisp = "product";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeProduct($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check permission - END

if(isset($_REQUEST['action']) == "inlineChange"){
	$type = $_REQUEST['type'];
	$pId = $_REQUEST['pId'];
	$pValue = $_REQUEST['pValue'];
	if($type == "minquantity"){
		$rslt = $db->insert("UPDATE `".TPLPrefix."product` SET minquantity = '".$pValue."' WHERE product_id = '".$pId."' limit 1");
	}
	else if($type == "price"){
		$rslt = $db->insert("UPDATE `".TPLPrefix."product` SET price = '".$pValue."' WHERE product_id = '".$pId."' limit 1");
	}
	 
}

?>
<?php include "includes/top.php";?>
<style>.easy-autocomplete{ width:100%!important}</style>
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
          <h3>Catalog</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
              <li class="active"><a href="#">Manage Product</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-md-5">
                  <h4>Manage Product</h4>
                </div>
                <div class="col-md-7 align-right padding-top-10px"> <span class="adv_filterbutton"> <span id="advance_filtertxt" class="btn btn-primary btn-rounded mb-4 mr-2"><i class="fa fa-filter"></i> Advanced Filter</span> <span id="closefilter" class="btn btn-dark btn-rounded mb-4 mr-2" style="display:none;"><i class="fa fa-times"></i> Close</span> </span>
                  <?php 
			  if(trim($res_modm_prm['AddPrm'])=="1") {
				 
				 if(getQuerys($db,"Isconfigurable")['value']==1){ ?>
                  <button onclick="window.location='product_form_attrib.php'" class="btn btn-warning btn-rounded mb-4 mr-2"><i class="fa fa-check"></i> Add</button>
                  <?php } else { ?>
                  <button onclick="window.location='product_form.php'" class="btn btn-warning btn-rounded mb-4 mr-2"><i class="fa fa-check"></i> Add</button>
                  <?php	
					}			 
				 }
			?>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="box-body row col-md-12" style="" id="advance_filter_div">
                  <div class="row row col-sm-12 mx-auto">
                    <form name="productList" id="productList" action="" />
                    
                    <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "product"; ?>" />
                    <div class="row col-sm-12 ">
                      <label class="col-sm-2 control-label">Sku </label>
                      <div class="col-sm-4">
                        <input class="pFilters form-control " type="text" name="sku" id="sku" />
                      </div>
                      <label class="col-sm-2 control-label">Product Name </label>
                      <div class="col-sm-4">
                        <input class="pFilters form-control " type="text" name="product_name" id="product_name" />
                      </div>
                    </div>
                    <div class="row">&nbsp;</div>
                    <div class="row col-sm-12">
                      <label class="col-sm-2 control-label">Category </label>
                      <div class="col-sm-4">
                        <input class="pFilters form-control " type="text" name="category_name" id="category_name" />
                      </div>
                      <label class="col-sm-2 control-label">Price </label>
                      <div class="col-sm-2">
                        <input class=" form-control numericvalidate" type="text" name="pricefrom" id="pricefrom" placeholder="From" />
                      </div>
                      <div class="col-sm-2">
                        <input class=" form-control numericvalidate" type="text" name="priceto" id="priceto" placeholder="To" />
                      </div>
                    </div>
                    <div class="row">&nbsp;</div>
                    <div class="row col-sm-12">
                      <label class="col-sm-2 control-label">MOQ </label>
                      <div class="col-sm-2">
                        <input class=" form-control numericvalidate" type="text" name="quantityfrom" id="quantityfrom" placeholder="From" />
                      </div>
                      <div class="col-sm-2">
                        <input class=" form-control numericvalidate" type="text" name="quantityto" id="quantityto" placeholder="To" />
                      </div>
                      <label class="col-sm-2 control-label">MOQ </label>
                      <div class="col-sm-4">
                        <select class=" form-control product_mangement select2" name="status">
                          <option value ="-1">All</option>
                          <option value ="1">Approved</option>
                          <option value ="0">Approved Pending</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">&nbsp;</div>
                    <div class="row col-sm-12">
                      <div class="row col-sm-9"> </div>
                      <div class="row col-sm-3">
                        <input type="button" class="btn btn-outline-primary mb-4 mr-2" value="Search Filters" onClick="advanceSearch()" />
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="ecommerce-product-list" class="table table-striped table-bordered table-hoverproduct_mng_tble">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Product</th>
                      <th>Sku</th>
                      <th>Price</th>
                      <th>Min Quantity</th>
					  <th>Images</th>
                      <th>Display For Home</th>
					  <th>Is Featured</th>
                      <th>Status</th>
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

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->
<link rel="stylesheet" type="text/css" href="assets/css/ecommerce/product.css">
<script>
$(document).ready(function(){
	$('#advance_filter_div').toggle();
	$(".adv_filterbutton").click(function(){
		$("#advance_filter_div").fadeToggle(function()
		{
			$('#closefilter').toggle();
			$('#advance_filtertxt').toggle();
		});
	});
});

$(function () {       
datatblCalAdvanceSearch(dataGridHdn,'ecommerce-product-list');

$("#tblresult").on("click", ".price",function(){			
$(this).html("<input class='inlineChange' type='text' data-type='price' data-id='"+$(this).data("id")+"' id='product_price_"+$(this).data("id")+"' value='"+$(this).data("price")+"' />");
});
$("#tblresult").on("click", ".minquantity",function(){
$(this).html("<input class='inlineChange' type='text' data-type='minquantity' data-id='"+$(this).data("id")+"' id='product_quan_"+$(this).data("id")+"' value='"+$(this).data("minquantity")+"' />");
});

$("#tblresult").on("change", ".inlineChange",function(e){			
var productId = $(this).data("id");
var prodcutValue = $(this).val();
var type = $(this).data("type");
if(type == "minquantity"){												
$.ajax({								
method     : 'POST',
dataType   : 'json',							
data       : {action:"inlineChange",type:"minquantity",pId:productId,pValue:prodcutValue},
beforeSend: function() {
loading();
},
success: function(response){ 
unloading();
if(response.rslt == '1')
{					
swal("Success!", statusmsg, "success");	
datatblCalAdvanceSearch(dataGridHdn,'ecommerce-product-list');
}
else if(response.rslt == '7')
{					
swal("Failure!", "Unable to insert", "warning");	
}	
}		
});	
}
else if(type == "price"){				
$.ajax({								
method     : 'POST',
dataType   : 'json',							
data       : {action:"inlineChange",type:"price",pId:productId,pValue:prodcutValue},
beforeSend: function() {
loading();
},
success: function(response){ 
unloading();
if(response.rslt == '1')
{					
swal("Success!", statusmsg, "success");	
datatblCalAdvanceSearch(dataGridHdn,'ecommerce-product-list');
}
else if(response.rslt == '7')
{					
swal("Failure!", "Unable to insert", "warning");	
}						
}		
});	
}
e.preventDefault();
});

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
$(".price,.minquantity").each(function(){
if($(this).find(".inlineChange").length > 0){
$(this).html($(this).find(".inlineChange").val());
}
}); 
}

function advanceSearch(){
datatblCalAdvanceSearch(dataGridHdn,'ecommerce-product-list');
}

$(document).ready(function() {
$(".numericvalidate").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
// Allow: Ctrl+A, Command+A
(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
// Allow: home, end, left, right, down, up
(e.keyCode >= 35 && e.keyCode <= 40)) {
// let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});
});   

</script>