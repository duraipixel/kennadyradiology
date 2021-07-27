<?php 
$menudisp = "discount";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeDiscount($db,'');
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

/*$str_ed = "select * from ".TPLPrefix."discount where IsActive != ? and DiscountID = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,getRealescape(base64_decode($id))));*/


$str_ed = "select * from ".TPLPrefix."discount where IsActive != '2' and DiscountID = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$str_ed_es = "select * from ".TPLPrefix."discount where IsActive != '2' and parent_id = '".base64_decode($id)."' and lang_id = 2";
$res_ed_es = $db->get_a_line($str_ed_es);

$str_ed_pt = "select * from ".TPLPrefix."discount where IsActive != '2' and parent_id = '".base64_decode($id)."' and lang_id = 3";
$res_ed_pt = $db->get_a_line($str_ed_pt);


$edit_id = $res_ed['DiscountID'];
$edit_id_es = $res_ed_es['DiscountID'];
$edit_id_pt = $res_ed_pt['DiscountID'];

	$chk='';
	if($res_ed['IsActive']=='1'){	
	$chk='checked';
	}
	
$DiscountAppend='';
if($res_ed['DiscountAppend']=='1')
{
	$DiscountAppend='checked';
}

$IsDisplayPublic='';
if($res_ed['IsDisplayPublic']=='1')
{
	$IsDisplayPublic='checked';
}

$Discountpriority='';
if($res_ed['Discountpriority']=='1')
{
	$Discountpriority='checked';
}


 $DiscountStartDate =   $res_ed['DiscountStartDate'];
 $DiscountEndDate =   $res_ed['DiscountEndDate'];
 $discountapply =  $res_ed['DiscountCatType'];	
	
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
          <h3>Discount Management</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Discount Management</a></li>
              <li><a href="discount_mng.php">Discount Management</a></li>
              <li class="active"><a href="#"> <?php echo $operation; ?> Discount Code</a> </li>
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
                  <h4><?php echo $operation; ?> Discount Code</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmdiscount" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Dsicount Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required placeholder="Discount Name" name="DiscountTitle" id="DiscountTitle" value="<?php echo $res_ed['DiscountTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"> <?php echo Spanish; ?> Dsicount Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required placeholder="Discount Name" name="DiscountTitle_es" id="DiscountTitle_es" value="<?php echo $res_ed_es['DiscountTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"> <?php echo Portuguese; ?> Dsicount Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required placeholder="Discount Name" name="DiscountTitle_pt" id="DiscountTitle_pt" value="<?php echo $res_ed_pt['DiscountTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php 
									 $str_eds = "select * from  ".TPLPrefix."discountapplied where IsActive = ? ";
									 $res_eds = $db->get_rsltset_bind($str_eds,array(1));
									?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Discount Applied for <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <select class="form-control select2" required id="DiscountCatType" name="DiscountCatType" >
                              <option value=""> -- Select an option -- </option>
                              <?php
												  $con_id= $res_ed['DiscountCatType'];
												  
											 foreach($res_eds as $value){		  
											?>
                              <option value=" <?php echo $value['disappid']; ?>" <?php  if($con_id== $value['disappid']){ echo  "selected='selected'"; } ?> ><?php echo $value['disappname']; ?></option>
                              <?php } ?>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="slaplist">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Discount Slap <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " required onchange="validateFloatKeyPress(this);" placeholder="Total amount"  name="Discountslabamt" id="Discountslabamt" value="<?php echo $res_ed['Discountslabamt']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <a style="color:#000;cursor:pointer;" data-toggle="tooltip" title="  (The order value that must reached before the discount is valid.)"><img src="images/BlueQuestion.png" style="vertical-align: sub;" /></a> </div>
                    <input type="hidden" name="discountapplyid" id="discountapplyid" value="<?=$discountapply?>" />
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
												 $DiscountProducts = $res_ed['DiscountProducts'];
												 echo getSelectBox_Products($db,'DiscountProducts','',$DiscountProducts,'',' required ');
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
                            <select name="DiscountType" id="DiscountType" required class="form-control select2" onchange="chkDiscountTyp()">
                              <option value=""> -- Select an option -- </option>
                              <?php
					              $con_id=$res_ed['DiscountType'];
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
                            <input type="text" class="form-control" required maxlength="3" placeholder="Pricetype" name="DiscountAmount" id="DiscountAmount" value="<?php echo $res_ed['DiscountAmount']; ?>"  onkeyup="chkDiscountTyp()" />
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
                            <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="From" name="DiscountStartDate" id="DiscountStartDate"   value="<?php echo $res_ed['DiscountStartDate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['DiscountStartDate'])): date($GLOBALS['DiscountStartDate']['phpformat']); ?>" readonly required>
                              <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <div class="controls">
                            <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="From" name="DiscountEndDate" id="DiscountEndDate"   value="<?php echo $res_ed['DiscountEndDate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['DiscountEndDate'])): date($GLOBALS['stroedateformat']['phpformat']); ?>" readonly required>
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
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmDiscount','discount_actions.php','jvalidate','discount','discount_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmDiscount','jvalidate','discount','discount_mng.php');">Cancel</button>
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
<script type="text/javascript" src="assets/js/jquery.filer.min.js"></script>
<script type="text/javascript" src="assets/js/multiple-select.js"></script>

<!--END FOOTER-->
<script type="text/javascript">

jQuery(document).ready(function(){	

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

 

 $("#clist").hide();
 $("#plist").hide();
 $("#slaplist").hide();
  $("#cusgroup").hide();
 $("#cuslist").hide();
 
 var coid = $("#discountapplyid").val();
 		if(coid == 1)
		{
		$("#clist").hide();
		$("#plist").show();
		$("#slaplist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#DiscountProducts").addClass("jsrequired");
		$("#Discountslabamt").removeClass("jsrequired");		
		}
		if(coid == 2)
		{
		$("#clist").show();
		$("#plist").hide();
		$("#slaplist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#DiscountProducts").removeClass("jsrequired");
		$("#Discountslabamt").removeClass("jsrequired");		
		}
		if(coid == 3)
		{
		$("#clist").hide();
		$("#plist").show();
		$("#slaplist").hide();
		
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#DiscountProducts").addClass("jsrequired");
		$("#Discountslabamt").removeClass("jsrequired");
		
		}
		if(coid == 4)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#cuslist").show();
		$("#cusgroup").show();
		$("#slaplist").hide();
		}
		if(coid == 5)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#slaplist").show();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#Discountslabamt").addClass("jsrequired");
		$("#DiscountProducts").removeClass("jsrequired");		
		}
		
	$("#DiscountCatType").change(function(){
	 
		var apply = $("#DiscountCatType").val();
		
		if(apply==1)
		{
			
		$("#clist").hide();
		$("#plist").show();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#slaplist").hide();
		}
		if(apply == 2)
		{
			
 		$("#clist").show();
		$("#plist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#slaplist").hide();
		}
		if(apply == 3)
		{
		$("#clist").hide();
		$("#plist").show();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#slaplist").hide();
		}
		if(apply == 4)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#cuslist").show();
		$("#cusgroup").show();
		$("#slaplist").hide();
		
		}
		if(apply == 5)
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#slaplist").show();
		
		}
		
		if(apply == '')
		{
		$("#clist").hide();
		$("#plist").hide();
		$("#cuslist").hide();
		$("#cusgroup").hide();
		$("#slaplist").hide();
		}
		
	});
});


$(document).ready(function(){

 
	 $('#tree').jstree({
    'plugins': ["wholerow", "checkbox", "types"],
	 
    "core" : {
        "themes" : {
            "responsive": false
        }, 
         "check_callback" : true,
          'data' : {
                "url" : "ajax_actions.php?action=categorylistdiscount&id=<?php echo base64_encode($edit_id); ?>",
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

 
		
});
 
</script>
<script type="text/javascript">
 $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


//DiscountType
function chkDiscountTyp()
{
	var ctyp = $("#DiscountType").val();
	var camt = $("#DiscountAmount").val();
	
	if(ctyp == 1){ $("#DiscountAmount").attr("placeholder", "%"); }
	if(ctyp == ''){ $("#DiscountAmount").attr("placeholder", "Pricetype"); }
	if( (ctyp == 1) && (camt >=100))
	{
	$("#DiscountAmount").val('100');
	$("#camtspan").html('(Percentage Value Should Not Exceed 100)')
	}
	else
	$("#camtspan").html('');
}


$(document).ready(function() {
    $("#DiscountAmount").keydown(function (e) {
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