<?php 
$menudisp = "coupons";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeCoupon($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END
$id=$_REQUEST['id'];
if($id!="")
{
//check edit permission - START	
if(trim($res_modm_prm['EditPrm'])=="0") {
?>
<script>
  window.location="error.php";
</script>
<?php	
}
//check edit permission - END	

$operation="Edit";
$act="update";
$btn='Update';
$str_ed = "select * from ".TPLPrefix."coupons where IsActive != '2' and CouponID = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$str_ed_es = "select * from ".TPLPrefix."coupons where IsActive != '2' and parent_id = '".base64_decode($id)."' and lang_id = 2";
$res_ed_es = $db->get_a_line($str_ed_es);

$str_ed_pt = "select * from ".TPLPrefix."coupons where IsActive != '2' and parent_id = '".base64_decode($id)."' and lang_id = 3";
$res_ed_pt = $db->get_a_line($str_ed_pt);

$edit_id = $res_ed['CouponID'];
$edit_id_es = $res_ed_es['CouponID'];
$edit_id_pt = $res_ed_pt['CouponID'];

	$chk='';
	if($res_ed['IsActive']=='1'){	
	$chk='checked';
	}
	
$CouponAppend='';
if($res_ed['CouponAppend']=='1')
{
	$CouponAppend='checked';
}

$IsDisplayPublic='';
if($res_ed['IsDisplayPublic']=='1')
{
	$IsDisplayPublic='checked';
}

$Couponpriority='';
if($res_ed['Couponpriority']=='1')
{
	$Couponpriority='checked';
}


 $CouponStartDate =   $res_ed['CouponStartDate'];
 $CouponEndDate =   $res_ed['CouponEndDate'];
 $couponapply =  $res_ed['CouponCatType'];	
	
}
else
{
if(trim($res_modm_prm['AddPrm'])=="0") {
?>
<script>
  window.location="error.php";
</script>
<?php	
}
	//check edit permission - END
	$operation="Add";
	$act="insert";
	$btn='Submit';
}
?>
<?php include "common/dpselect-functions.php";?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "includes/sidebar.php";?>
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Offer Management</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Offer Management</a></li>
              <li><a href="coupons_mng.php">Coupon Management</a></li>
              <li class="active"><a href="#"> <?php echo $operation; ?> Coupon Code</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4><?php echo $operation; ?> Coupon Code</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Coupon Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required placeholder="Coupon Name" name="CouponTitle" id="CouponTitle" value="<?php echo $res_ed['CouponTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"> <?php echo Spanish; ?> Coupon Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required placeholder="Coupon Name" name="CouponTitle_es" id="CouponTitle_es" value="<?php echo $res_ed_es['CouponTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"> <?php echo Portuguese; ?> Coupon Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required placeholder="Coupon Name" name="CouponTitle_pt" id="CouponTitle_pt" value="<?php echo $res_ed_pt['CouponTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Coupon Code <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required <?php if($act == 'update'){?> readonly="readonly"<?php }?> placeholder="Coupon Code" name="CouponCode" id="CouponCode" value="<?php echo $res_ed['CouponCode']; ?>" maxlength="8" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <?php if($act == 'insert'){?>
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls"> <a href="javascript:void(0)" data-toggle="tooltip" id="genco" class="btn btn-info btn-rounded snackbar-txt-warning" onClick="randomString();" title="Click here to automatically Generate code">Generate </a>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <?php }?>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Coupon Total Count <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control numericvalidate" required name="CouponTotal" id="CouponTotal" value="<?php echo $res_ed['CouponTotal']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">No of Coupon Customer can be use <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control numericvalidate" required name="CouponPerUser" id="CouponPerUser" value="<?php echo $res_ed['CouponPerUser']; ?>" Onkeyup = "CouponPerUserkeypress();" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <a style="color:#000;cursor:pointer;" data-toggle="tooltip" title="The maximum number of times the coupon can be used by any customer."><img src="images/BlueQuestion.png" style="vertical-align: sub;" /></a></div>
                    <?php 
					 $str_eds = "select * from ".TPLPrefix."couponapplied where IsActive = '1' ";
                     $res_eds = $db->get_rsltset($str_eds);
					?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Coupon Applied for <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <select class="form-control select2" id="CouponCatType" required name="CouponCatType">
                              <option value="">-- Select an option -- </option>
                              <?php
					              $con_id= $res_ed['CouponCatType'];
								  foreach($res_eds as $value){?>
                              <option value="<?php echo $value['cpnappid']; ?>" <?php  if($con_id== $value['cpnappid']){ echo  "selected='selected'"; } ?> > <?php echo $value['cpnappname']; ?></option>
                              <?php } ?>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="olist">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Minimum Order Value <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control numericvalidate" required onchange="validateFloatKeyPress(this);" placeholder="Total amount"  name="CouponMinAmt" id="CouponMinAmt" value="<?php echo $res_ed['CouponMinAmt']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="couponapplyid" id="couponapplyid" value="<?=$couponapply?>" />
                    <div class="row" id="plist">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Products List <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
					 	     $CouponProducts = $res_ed['CouponProducts'];
							 echo getSelectBox_Products($db,'CouponProducts','',$CouponProducts,'',' required ');
							?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="clist">
                      <div class="col col col-md-3  mb-4">
                        <div class="control-group">
                          <label class="control-label">Category <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <div id="tree"></div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="cusgroup">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Customer Group <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
					 	     $customergroupid = $res_ed['customergroupid'];
							 echo getSelectBox_Customergroups($db,'Customergroup','',$customergroupid,'',' required ');
							?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="cuslist">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Customer List <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
								if(isset($res_ed['customergroupid']) && !empty($res_ed['customergroupid'])){
									echo getCustomerslist($db,'CustomerIds','',$res_ed['CustomerIds'],'',$res_ed['customergroupid'],' required' );
								}
								else{
							?>
                            <select name="CustomerIds[]" id="CustomerIds" class="form-control select2" data-placeholder="Select"  multiple="multiple">
                            </select>
                            <?php 
								}
							?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Price Type <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <select name="CouponType" id="CouponType" required class="form-control select2" onchange="chkCouponTyp()">
                              <option value=""> -- Select an option -- </option>
                              <?php
					              $con_id=$res_ed['CouponType'];
								  $sele="selected";
							?>
                              <option value="1" <?php  if($con_id=='1') echo $sele; ?> >Percentage</option>
                              <option value="2" <?php  if($con_id=='2') echo $sele; ?> >Fixed Amount</option>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Value <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control numericvalidate" required placeholder="Value" name="CouponAmount" id="CouponAmount" value="<?php echo $res_ed['CouponAmount']; ?>" onkeyup="chkCouponTyp()" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group ">
                          <label class="control-label">Start Date <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <div class="controls">
                            <div class="input-control text " data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="From" name="CouponStartDate" id="CouponStartDate"   value="<?php echo $res_ed['CouponStartDate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['CouponStartDate'])): date($GLOBALS['stroedateformat']['phpformat']); ?>" readonly required>
                              <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <div class="col col col-md-3">
                        <div class="control-group ">
                          <div class="controls">
                            <div class="input-control text " data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="From" name="CouponEndDate" id="CouponEndDate"   value="<?php echo $res_ed['CouponEndDate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['CouponEndDate'])): date($GLOBALS['stroedateformat']['phpformat']); ?>" readonly required>
                              <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="CouponAppend" name="CouponAppend" value="0"  />
                    <input type="hidden" id="IsDisplayPublic" name="IsDisplayPublic" value="0" />
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Status <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" required class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmt('frmCoupon','coupons_actions.php','jvalidate','coupons','coupons_mng.php');"><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmCoupon','jvalidate','coupons','coupons_mng.php');">Cancel</button>
                          </div>
                        </div>
                      </div>
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
  <!--  END CONTENT PART  --> 
</div>
<!-- END MAIN CONTAINER --> 

<!--BEGIN FOOTER-->
<?php include('includes/footer.php');?>
<!--END FOOTER-->
<script>
  var tree;
</script>
<script src="assets/js/jquery.easy-autocomplete.js"></script>
<script type="text/javascript" src="assets/js/multiple-select.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $(".numericvalidate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
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


function CouponPerUserkeypress(){
  var coupontotal = $("#CouponTotal").val();
  var CouponPerUser = $("#CouponPerUser").val();	
  if(parseInt(coupontotal)<parseInt(CouponPerUser)){
	swal("Failure!","Please Enter below"+" "+coupontotal, "warning");	 
	$("#CouponPerUser").val('');
  }
}
jQuery(document).ready(function(){	
  
 
 $("#olist").hide();
 $("#clist").hide();
 $("#plist").hide();
 $("#cusgroup").hide();
 $("#cuslist").hide();
 
 var coid = $("#couponapplyid").val();
 		if(coid == 1)
		{
		$("#clist").hide();
		$("#plist").show();
		$("#olist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		}
		if(coid == 2)
		{
		$("#clist").show();
		$("#plist").hide();
		$("#olist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		}
		if(coid == 3)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#olist").show();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		
		}
		if(coid == 4)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#olist").hide();
		$("#cuslist").show();
		$("#cusgroup").show();
		}
		
		 	$("#CouponCatType").change(function(){
	        
		var apply = $("#CouponCatType").val();
		 //alert(apply);
		if(apply == 1)
		{
		$("#clist").hide();
		$("#plist").show();
		$("#olist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
			
		
		}
		if(apply == 2)
		{
 		$("#clist").show();
		$("#plist").hide();
		$("#olist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		}
		if(apply == 3)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#olist").show();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		}
		if(apply == 4)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#olist").hide();
		$("#cuslist").show();
		$("#cusgroup").show();
		}
		
		if(apply == '')
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#olist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		}
		
	});
});

$(document).ready(function(){
	
	//get coustor list
$("#Customergroup").change(function(){
	//alert('asd');
		if($(this).val() !=''){
		   $.ajax({
				url: 'common/ajax-functions.php',
				type: 'POST',
				dataType : 'json',
				data: 'hdnact=getcostomerlist&customer_group_id='+$(this).val(),
				beforeSend: loading(),
				success: function(response) {	 														
					unloading();										
						$("#CustomerIds").html(response.rslt);
						//$("#CustomerIds").select2();
					$("#CustomerIds").select2("val","");	
					
				}
				
			});    
		}      
	});	
 
 
 $('#tree').jstree({
    'plugins': ["wholerow", "checkbox", "types"],
	 
    "core" : {
        "themes" : {
            "responsive": false
        }, 
         "check_callback" : true,
          'data' : {
                "url" : "ajax_actions.php?action=categorylistcoupon&id=<?php echo base64_encode($res_ed['CouponID']); ?>",
                "plugins" : [ "wholerow", "checkbox" ],
                "dataType" : "json" // needed only if you do not supply JSON headers
            },
			expand_selected_onload : false
    },

    "types" : {
        "default" : {
            "icon" : "fa fa-folder"
        },
        "file" : {
            "icon" : "fa fa-file"
        }
    },
 });
 
    var date = new Date();
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
	$('#CouponStartDate,#CouponEndDate').datepicker({					
				dateFormat: "dd-mm-yy",				
                changeMonth: true,
                changeYear: true,
				startDate: today,
                //yearRange: "-100:+20",
				maxDate: new Date			
	});
	
	$.validator.addMethod("CouponEndDate", function(value, element) {
	  if(value.length  > 0){
		  if( $("#CouponStartDate").val() >  value ) {
			 return false;  
		  }		  
	  }
	  return true;
	}, "To date must be greater than from date");	
	

	

	
});

/********** For Tree based category display************/
$(document).delegate('.expander','click',function(){
	  $(this).toggleClass('expanded')
	  .nextAll('ul:first').toggleClass('expanded');
	  return true;
});


	
</script>
<script type="text/javascript">
 $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

//CouponType
function chkCouponTyp()
{
	var ctyp = $("#CouponType").val();
	var camt = $("#CouponAmount").val();
	
	if(ctyp == 1){ $("#CouponAmount").attr("placeholder", "%"); }
	if(ctyp == 2){ $("#CouponAmount").attr("placeholder", "Amount"); }
	if(ctyp == ''){ $("#CouponAmount").attr("placeholder", "Pricetype"); }
	if( (ctyp == 1) && (camt >=100))
	{
	$("#CouponAmount").val('100');
	$("#camtspan").html('(Percentage Value Should Not Exceed 100)')
	}
	else
	$("#camtspan").html('');
}


$('#CouponCode').on('input', function() {
$(this).val($(this).val().replace(/[=@!#$_%^&*()+'?{}":;.,~`><]/gi, ''));
});
 </script>