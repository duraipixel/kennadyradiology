<?php 
$menudisp = "shippingflat";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeCustomers($db,'businesscustomerapproval_mng.php');
include_once "includes/pagepermission.php";

//check permission - START

$shipid = $_REQUEST['shipping'];
$shippingId = base64_decode($_REQUEST['shipping']);
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
          <h3>Business Approval</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Customers</a></li>
               <li class="active"><a href="#">Business Approval</a> </li>
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
                  <h4>Manage Business Customer Approval</h4>
                </div>
                <?php  if(trim($res_modm_prm['AddPrm'])=="1") { ?>
                <div class="col-md-4 align-right">
                  <h4> 
                    <!--    <button onclick="window.location='shippingflat_form.php?shipping=<?php echo $shipid;?>'" class="btn btn-warning btn-rounded mb-4 mr-2"><i class="fa fa-check"></i> Add</button>--> 
                  </h4>
                </div>
                <?php }?>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="table-responsive mb-4">
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "shippingflat"; ?>" />
                <table id="tblresult_modulesorting" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Customer Firstname</th>
                      <th>Customer lastname</th>
                      <th>Customer Email</th>
                      <?php
						$qryattrbute=" select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 
						inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1  
						inner join ".TPLPrefix."customfield_custgrp t3 on t3.CustomFieldId=t1.AttributeId and t3.IsActive=1 
						inner join  ".TPLPrefix."customer_group t4  on t4.customer_group_id=t3.CustomerGrupId and t4.IsActive=1 and t4.customer_group_id='2'
						where 1=1 and t1.IsActive =1  group by t1.AttributeCode order by t1.SortBy asc ";
						$resattrbute=$db->get_rsltset($qryattrbute);
						
						
						foreach($resattrbute as $att)
						{?>
                      <th><?php echo $att['AttributeName']; ?></th>
                      <?php 		
						}	
						?>
                      <th>Discount Percentage</th>
                      <th>Approve</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <form id="businesscustomerapproval" name="businesscustomerapproval" >
                    <tbody>
                      <?php
					   // $pdtapproval_list = $db->get_rsltset("select sno, product_name, sku, minquantity, price, 't' as disptbl  from ".TPLPrefix."pdt_bulk_approval union select product_id, product_name, sku, minquantity, price, 'm' as disptbl  from ".TPLPrefix."product where IsActive = 0 ");
				$str_all="
		select customer_id,customer_group_id,customer_firstname,customer_lastname,customer_email,mobileno,gstdocument,businesscard,discount,IsActive, 'm' as disptbl  ";
	foreach($resattrbute as $att){	
		$str_all.=" ,max(".$att['AttributeCode'].") as  ".$att['AttributeCode']." ";
	}		   
					   
					    $str_all.=" from (select c.customer_id,c.customer_group_id,c.customer_firstname,c.customer_lastname,c.customer_email,c.mobileno,c.gstdocument,c.businesscard,c.discount,c.IsActive "; 
		foreach($resattrbute as $att){
		  $str_all.=" ,( 
		   case when t2.elementid in (3,4,6,7)  and val.AttributeOptionId is not null and ct2.AttributeId = '".$att['AttributeId']."'  then (val.AttributeValue)
         		 when t2.elementid in (1,2,5) and  ct1.AttributeId = '".$att['AttributeId']."' then  (ct1.AttributeValue)
				 else ''
			End
				) as ".$att['AttributeCode']."  ";
		}		
		$str_all.=" from ".TPLPrefix."customers c 
		inner join ".TPLPrefix."customer_group t4  on  t4.IsActive=1 and t4.customer_group_id=c.customer_group_id
		left  join ".TPLPrefix."customfield_custgrp t3 on  t4.customer_group_id=t3.CustomerGrupId  and t3.IsActive=1 
		left join ".TPLPrefix."customfields_attributes t1 on t3.CustomFieldId=t1.AttributeId and t1.IsActive=1
		left join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1 
		left  join ".TPLPrefix."cus_attribute_tbl1 ct1 on ct1.AttributeId = t1.AttributeId and c.customer_id = ct1.customer_id and ct1.IsActive=1
		left  join ".TPLPrefix."cus_attribute_tbl2 ct2 on ct2.AttributeId = t1.AttributeId and c.customer_id = ct2.customer_id and ct2.IsActive=1
		left join ".TPLPrefix."customfields_attrvalues val on val.AttributeId=ct2.AttributeId and val.AttributeOptionId=ct2.AttributeValue  and val.IsActive=1
		where c.IsActive =0 and c.customer_group_id = '2' ";
		$str_all .=" )t group by customer_id ";			   
		$pdtapproval_list = $db->get_rsltset($str_all);	
		
					 /*   $pdtapproval_list = $db->get_rsltset("select customer_group_id,customer_id, customer_firstname, customer_lastname, customer_email, discount, 'm' as disptbl  from ".TPLPrefix."customers  where IsActive = 0 and customer_group_id='2' ");
						*/
                        foreach($pdtapproval_list as $pdtapproval_list_S)
						{
						 $bulk_approve = $pdtapproval_list_S['customer_id'];
                         $cus_groupid = base64_encode($pdtapproval_list_S['customer_group_id']);						 
						?>
                      <tr>
                        <td><?php echo $pdtapproval_list_S['customer_firstname']; ?></td>
                        <td><?php echo $pdtapproval_list_S['customer_lastname']; ?></td>
                        <td><?php echo $pdtapproval_list_S['customer_email']; ?></td>
                        <?php	
							foreach($resattrbute as $att)
						{?>
                        <td><?php echo $pdtapproval_list_S[$att['AttributeCode']]; ?></td>
                        <?php 		
						} ?>
                        <td><input type="text" id="customerdiscount_<?php echo $pdtapproval_list_S['customer_id']; ?>" name="customerdiscount[]" value="<?php echo $pdtapproval_list_S['discount']; ?>" class="form-control jsrequired"  onkeypress="return isNumber(event)" onchange="changediscountamount('<?php echo $pdtapproval_list_S['disptbl']; ?>','<?php echo $pdtapproval_list_S['customer_id']; ?>',this.value)"  /></td>
                        <td><div class="n-chk">
                            <label class="new-control new-checkbox checkbox-success">
                              <input type="checkbox" value="<?php echo $bulk_approve; ?>"   class="new-control-input"  name="chkApproveproduct[]" >
                              <span class="new-control-indicator"></span>&nbsp; </label>
                          </div></td>
                        <td><a href="customers_form.php?cusid=<?php echo $cus_groupid; ?>&act=edit&id=<?php echo base64_encode($pdtapproval_list_S['customer_id']); ?>" title="edit" data-toggle="tooltip" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" ><i class="flaticon-edit-7"></i></a></td>
                      </tr>
                      <?php			
						}
					   ?>
                    </tbody>
                  </form>
                </table>
              </div>
              <div class="row">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-7">
                  <button class="btn btn-success btn-rounded snackbar-txt-warning mb-4" type="button" onclick="select_all(1);" name="selectall" id="selectall" >Select All</button>
                  <button class="btn btn-info btn-rounded snackbar-txt-warning mb-4" type="button" onclick="select_all(0);" name="unselectall" id="unselectall" >UnSelect All</button>
                  <button class="btn btn-primary btn-rounded snackbar-txt-warning mb-4" type="button" onclick="approve_selected();" name="approve" id="approve" >Approve Selected</button>
                  <button class="btn btn-danger btn-rounded snackbar-txt-warning mb-4" type="button" onclick="delete_selected();" name="delete" id="delete" >Delete Selected</button>
                </div>
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
      $(function () {       
		 // datatblCal(dataGridHdn);
	  });
</script>
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
  


function changediscountamount(chktbl, cusid, txtval){
	

	
	if(txtval !=""){
		
		 swal({
			title: "Are you sure?",
		text: "Are you sure to change discount amount?",
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
					data	   : 'pagename=customerdiscountamountchange&cusid='+cusid+'&tblchange='+chktbl+'&change_value='+txtval+'',
					success	   : function(response){ 
						if(response.rslt == "1"){
 							 toast({type: 'success',title:'Discount Amount update successfully',padding: '1em'});
							 
						}
						else{
							 toast({type: 'warning',title:'Problem in approve',padding: '1em'}); 
						}				
					}
				});
			
			}
		 });
		 
        

	}
	else{
		toast({type: 'warning',title: 'Discount Amount should not be empty',padding: '1em'}); 
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
					
					if($("#customerdiscount_"+chks[i].value).val()==''){
						toast({type: 'warning',title: 'Discount Percentage Field is empty!',padding: '1em'}); 
 						unloading();
				        return false;
					}
					
				}
				else{
					delID_list +=","+chks[i].value;
					if($("#customerdiscount_"+chks[i].value).val()==''){
						toast({type: 'warning',title: 'Discount Percentage Field is empty!',padding: '1em'}); 						 
						unloading();
				        return false;
					}
				}					
			}
		}
		if (hasChecked == false)
		{
			toast({type: 'warning',title: 'Please select at least one Customer',padding: '1em'}); 
 			unloading();
		}
		else{						
		 	
 			swal({
			title: "Are you sure?",
			text: "Are you sure to Approve Customer?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Okay",
			padding: '0.5em'
     	 }).then(function(result) {
			if (result.value) {		
			$.ajax({
						type 	: "POST",				
						data 	: 'pagename=customerbulkapprove&approveidlist='+delID_list,				
						dataType : 'json',
						url: 'others_actions.php',
						beforesend:loading(), 	
						success: function(msg){
							if(msg.rslt == "1"){
 								toast({type: 'success',title: 'Customer Approved Successfully',padding: '1em'}); 
 								location.reload();				
							}		
						}			
					});
			
			}
		 });
		 
		 
			 
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
			toast({type: 'success',title: 'Please select at least one Customery',padding: '1em'}); 
 			unloading();
		}
		else{						
			//alert(delID_list);
			
			
			 swal({
			title: "Are you sure?",
			text: "Are you sure to Delete Customer?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Okay",
			padding: '0.5em'
     	 }).then(function(result) {
			if (result.value) {		
			 $.ajax({
						type 	: "POST",				
						data 	: 'pagename=customerbulkdelete&approveidlist='+delID_list,				
						dataType : 'json',
						url: 'others_actions.php',
						beforesend:loading(), 	
						success: function(msg){
							if(msg.rslt == "1"){
							toast({type: 'success',title: 'Customer Deleted Successfully',padding: '1em'}); 
 							location.reload();				
							}		
						}			
					});
			
			}
		 });
		 
		
				
		}	
	unloading();
 }  
  
</script>