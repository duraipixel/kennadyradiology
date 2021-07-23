<?php 
$menudisp = "productapproval";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeProductapproval($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
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
          <h3>Catalog</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
              <li class="active"><a href="#">Product Approval</a> </li>
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
                  <h4>Manage Product Approval</h4>
                </div>
                <div class="col-md-7  mb-4 padding-top-10px">
                  <button class="btn btn-success btn-rounded snackbar-bg-dark" type="button" onclick="select_all(1);" name="selectall" id="selectall" >Select All</button>
                  <button class="btn btn-info btn-rounded snackbar-bg-dark" type="button" onclick="select_all(0);" name="unselectall" id="unselectall" >UnSelect All</button>
                  <button class="btn btn-primary btn-rounded snackbar-bg-dark" type="button" onclick="approve_selected();" name="approve" id="approve" >Approve Selected</button>
                  <button class="btn btn-danger btn-rounded snackbar-bg-dark" type="button" onclick="delete_selected();" name="delete" id="delete" >Delete Selected</button>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="table-responsive mb-4">
                <table id="tblresult" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Product SKU</th>
                      <th>Min Quantity</th>
                      <th>Price</th>
                      <th>Approve</th>
                      <th>View / Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					    $pdtapproval_list = $db->get_rsltset("select sno, product_name, sku, minquantity, price, 't' as disptbl  from ".TPLPrefix."pdt_bulk_approval union select product_id, product_name, sku, minquantity, price, 'm' as disptbl  from ".TPLPrefix."product where IsActive = 0 and lang_id = 1 ");
						
						//$pdtapproval_list = $db->get_rsltset("select product_id, product_name, sku, quantity, price, 'm' as disptbl  from ".TPLPrefix."product where IsActive = 0 ");
						//echo "<pre>"; print_r($pdtapproval_list); exit;
                        foreach($pdtapproval_list as $pdtapproval_list_S)
						{
						 $bulk_approve = $pdtapproval_list_S['disptbl']."@".$pdtapproval_list_S['sno']."@".$pdtapproval_list_S['sku'];		
						?>
                    <tr>
                      <td><?php echo $pdtapproval_list_S['product_name']; ?></td>
                      <td><?php echo $pdtapproval_list_S['sku']; ?></td>
                      <td><input type="text" value="<?php echo $pdtapproval_list_S['minquantity']; ?>" class="form-control"  onkeypress="return isNumber(event)" onchange="changeqty('<?php echo $pdtapproval_list_S['sku']; ?>','<?php echo $pdtapproval_list_S['disptbl']; ?>','<?php echo $pdtapproval_list_S['sno']; ?>',this.value)"  /></td>
                      <td><input type="text" value="<?php echo $pdtapproval_list_S['price']; ?>" class="form-control"  onkeypress="return isNumber(event)" onchange="changeprice('<?php echo $pdtapproval_list_S['sku']; ?>','<?php echo $pdtapproval_list_S['disptbl']; ?>','<?php echo $pdtapproval_list_S['sno']; ?>',this.value)"  /></td>
                      <td><input type="checkbox" value="<?php echo $bulk_approve; ?>" name="chkApproveproduct[]" /></td>
                      <td><a href="product_form.php?act=edit&id=<?php echo base64_encode($pdtapproval_list_S['sno']); ?>" title="edit" data-toggle="tooltip" class="btn btn-info btn-sm" ><i class="fa fa-edit"></i></a></td>
                    </tr>
                    <?php			
						}
					   ?>
                  </tbody>
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

<script type="text/javascript"> 
$(function () {
$('#tblresult_modulesorting').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"columnDefs": [ { "targets": [2,3,4,5], "orderable": false } ],
"info": true,
"autoWidth": false
});
});


function changesortingorder(modulemenuId,txtval){	  
if(txtval !=""){		  
$.ajax({
url        : 'others_actions.php',
method     : 'POST',
dataType   : 'json',
data	   : 'pagename=modulemenusorting&modulemenuId='+modulemenuId+'&sort_value='+txtval+'',			
success	   : function(response){ 						  		
}
});

}  
}

function changeqty(R_sku, R_chktbl, R_pdtid, txtval){
if(txtval !=""){

swal({
title: "Are you sure?",
text: "Are you sure to change quantity?",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: "Okay",
padding: '0.5em'
}).then(function(result) {
if (result.value) {


$.ajax({
url        : 'others_actions.php',
method     : 'POST',
dataType   : 'json',
data	   : 'pagename=pdtapprovalqtychange&pdtsku='+R_sku+'&pdtid='+R_pdtid+'&tblchange='+R_chktbl+'&change_value='+txtval+'',
success	   : function(response){ 
if(response.rslt == "1"){
//alert("Min Quantity update successfully");
toast({type: 'success',title: 'Min Quantity update successfully',padding: '2em',});

}
else{
//alert("server busy");
toast({type: 'warning',title: 'server busy',padding: '2em',});

}				
}
});
}else{
location.reload();	
}
})
}
else{
toast({type: 'warning',title: 'Quantity should not be empty',padding: '2em',});
}
}

function changeprice(R_sku, R_chktbl, R_pdtid, txtval){
if(txtval !=""){

swal({
title: "Are you sure?",
text: "Are you sure to change price?",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: "Okay",
padding: '0.5em'
}).then(function(result) {
if (result.value) {
	$.ajax({
	url        : 'others_actions.php',
	method     : 'POST',
	dataType   : 'json',
	data	   : 'pagename=pdtapprovalpricechange&pdtsku='+R_sku+'&pdtid='+R_pdtid+'&tblchange='+R_chktbl+'&change_value='+txtval+'',
		success	   : function(response){ 
			if(response.rslt == "1"){
			toast({type: 'success',title: 'Price update successfully',padding: '2em',});
			}
			else{
			toast({type: 'warning',title: 'server busy',padding: '2em',});
			}				
		}
	});
	}
	else{
		location.reload();	
	}
})
}
else{
	toast({type: 'warning',title: 'Price should not be empty',padding: '2em',});
}
} 

function select_all(value){
var chks = document.getElementsByName('chkApproveproduct[]');	
for (var i = 0; i < chks.length; i++)
{	
if (value == '1') {             
chks[i].checked = true;			
}
else{
chks[i].checked = false;
}
}

$('input').iCheck({
checkboxClass: 'icheckbox_square-blue',
radioClass: 'iradio_square-blue',
increaseArea: '20%' // optional
});	 
}

function approve_selected(){
loading();  
var chks = document.getElementsByName('chkApproveproduct[]');
var hasChecked = false;
var delID_list;
	for (var i = 0; i < chks.length; i++)
	{
		if (chks[i].checked)
		{
			hasChecked = true;
			if(!delID_list){
			delID_list = chks[i].value;
		}
		else{
			delID_list +=","+chks[i].value;	
		}					
	}
}
if (hasChecked == false)
{
	toast({type: 'warning',title: 'Please select at least one product',padding: '2em',});
	unloading();
}
else{						
swal({
title: "Are you sure?",
text: "Are you sure to approve product?",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: "Yes, change it!",
padding: '0.5em'
}).then(function(result) {
if (result.value) {
	$.ajax({
	type 	: "POST",				
	data 	: 'pagename=pdtbulkapprove&approveidlist='+delID_list,				
	dataType : 'json',
	url: 'others_actions.php',
	beforesend:loading(), 	
		success: function(msg){
			if(msg.rslt == "1"){
				toast({type: 'success',title: 'Product Approved Successfully',padding: '2em',});
				$(location).attr('href', 'product_mng.php');
			}		
		}			
	});
}else
{
	$(location).attr('href', 'product_mng.php');
}	
})
}	
unloading();
} 


function delete_selected(){
loading();  
var chks = document.getElementsByName('chkApproveproduct[]');
var hasChecked = false;
var delID_list;
	for (var i = 0; i < chks.length; i++)
	{
		
		if (chks[i].checked)
		{
			hasChecked = true;
			if(!delID_list){
			delID_list = chks[i].value;
		}
		else{
			delID_list +=","+chks[i].value;	
		}
						
	}
}
if (hasChecked == false)
{
	toast({type: 'warning',title: 'Please select at least one product',padding: '2em',});
	unloading();
}
else{						
	swal({
	title: "Are you sure?",
	text: "Are you sure to delete product?",
	type: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: "Yes, change it!",
	padding: '0.5em'
	}).then(function(result) {
	if (result.value) {
		$.ajax({
			type 	: "POST",				
			data 	: 'pagename=pdtbulkdelete&approveidlist='+delID_list,				
			dataType : 'json',
			url: 'others_actions.php',
			beforesend:loading(), 	
			success: function(msg){
				if(msg.rslt == "1"){
					toast({type: 'success',title: 'Product Deleted Successfully',padding: '2em',});
					location.reload();				
				}		
			}			
		});
	}else{
		location.reload();	
	}
	});
	}	
unloading();
}  

</script>