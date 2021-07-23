<?php 
$menudisp = "customfields";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeCustomfields($db,'');
include_once "includes/pagepermission.php";


//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

if(!isset($_REQUEST['AttributeId'])){
	header("Location:".admin_public_url."error.php");
}
$attributeid = base64_decode($_REQUEST['AttributeId']);

$rslt_getattribute1 = "select * from ".TPLPrefix."customfields_attributes where 1=1 and AttributeId = ? ";
$rslt_getattribute = $db->get_a_line_bind($rslt_getattribute1,array($attributeid));

$rslt_getAttroptionids1 = "select GROUP_CONCAT(AttributeOptionId) as `attributeoptionIDs` from ".TPLPrefix."customfields_attrvalues where 1=1 and AttributeId = ? ";
$rslt_getAttroptionids = $db->get_a_line_bind($rslt_getAttroptionids1,array($attributeid));

$rslt_getattroptions1 = "select * from ".TPLPrefix."customfields_attrvalues where 1=1 and IsActive =1 and  AttributeId= ?";
$rslt_getattroptions = $db->get_rsltset_bind($rslt_getattroptions1,array($attributeid));

$attr_val_cnt= count($rslt_getattroptions);	

if($attr_val_cnt > 0){
	$rwcnt = $attr_val_cnt;
}
else{
	$rwcnt = 1;
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
          <h3>Customer</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Customers</a></li>
              <li><a href="country_mng.php">Add / Update Attribute Values</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Customer</a> </li>
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
                  <h4> Add / Update Attribute Values For <?php echo "< ".$rslt_getattribute['AttributeName']." >"; ?> </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-7 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                  <input type="hidden" name="attribute_id" value="<?php echo $attributeid; ?>"  />	
				   <input type="hidden" id="attr_row_cnt" name="attr_row_cnt" value="<?php echo $rwcnt; ?>"  />	
                    <div class="row" id="attr_options_lists">
                      <?php 					
					if($attr_val_cnt > 0){
						$i = 1;
						foreach($rslt_getattroptions as $rslt_getattroptions_S){
							if($i == 1){
					?>
                      <input type="hidden" name="prev_attroptionids[]" value="<?php echo $rslt_getattroptions_S['AttributeOptionId']; ?>"  />
                      <div class="form-group row" id="attropt_row_1">
                        <input type="hidden" name="new_attroptionids_update[]" value="<?php echo $rslt_getattroptions_S['AttributeOptionId']; ?>"  />
                        <div class="col-sm-4">
                          <input type="text" class="form-control" required name="txtAttr_val[]" placeholder="Attribute Value" value="<?php echo $rslt_getattroptions_S['AttributeValue']; ?>"  />
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" required name="txtAttr_sortby[]" placeholder="Sort By" onkeypress="return isNumber(event)" value="<?php echo $rslt_getattroptions_S['SortBy']; ?>"  />
                        </div>
                        <div class="col-sm-5"> <a href="javascript:void(0);" onclick="add_attroptions();" class="add_front"><i class="flaticon-add-circle-outline"></i> </a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
                      </div>
                      <?php	
								
							}
							else{
					?>
                      <input type="hidden" name="prev_attroptionids[]" value="<?php echo $rslt_getattroptions_S['AttributeOptionId']; ?>"  />
                      <div class="form-group row" id="attropt_row_<?php echo $i; ?>">
                        <input type="hidden" name="new_attroptionids_update[]" value="<?php echo $rslt_getattroptions_S['AttributeOptionId']; ?>"  />
                        <div class="col-sm-4">
                          <input type="text" class="form-control" required  name="txtAttr_val[]" placeholder="Attribute Value" value="<?php echo $rslt_getattroptions_S['AttributeValue']; ?>"  />
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"required  name="txtAttr_sortby[]" placeholder="Sort By" onkeypress="return isNumber(event)" value="<?php echo $rslt_getattroptions_S['SortBy']; ?>"  />
                        </div>
                        <div class="col-sm-3"> <a href="javascript:void(0);" onclick="add_attroptions();" class="add_front"><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp;<a  class="remove_front" href="javascript:void(0);" onclick="delete_attroptions(<?php echo $i; ?>);"><i class="flaticon-delete-1"></i></a> </div>
                      </div>
                      <?php									
							}							
							$i = $i +1;
						}
					}	
					else{
					?>
                      <div class="form-group" id="attropt_row_1">
                        <div class="col-sm-4">
                          <input type="text" class="form-control" required  name="txtAttr_val[]" placeholder="Attribute Value"  />
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" required name="txtAttr_sortby[]" placeholder="Sort By" onkeypress="return isNumber(event)"  />
                        </div>
                        <div class="col-sm-3"> <a href="javascript:void(0);" onclick="add_attroptions();">Add</a> </div>
                      </div>
                      <?php 
					}
				   ?>
                    </div>
                    <div class="control-group mb-4"> &nbsp; </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:save_attribute_options();" ><span id="spSubmit">Update</span></button>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmcustomfields','jvalidate','customfields','customfields_mng.php');" >Cancel</button>
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

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->

<script type="text/javascript">

function add_attroptions(){
	var rowcnt = $("#attr_row_cnt").val();
	rowcnt = Number(rowcnt) + 1;
	
	var dynamic_html = '<div class="form-group row" id="attropt_row_'+rowcnt+'"> <div class="col-sm-4"><input type="text" class="form-control" required  name="txtAttr_val[]" placeholder="Attribute Value"  /></div><div class="col-sm-2"><input type="text" class="form-control" required name="txtAttr_sortby[]" placeholder="Sort By" onkeypress="return isNumber(event)"  /> </div><div class="col-sm-3"><a href="javascript:void(0);" onclick="add_attroptions();" class="add_front"><i class="fa fa-plus"></i><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp;<a href="javascript:void(0);" onclick="delete_attroptions('+rowcnt+');" class="remove_front"><i class="fa fa-trash-o"></i> <i class="flaticon-delete-1"></i></a> </div></div>';	
			   
	$( "#attr_options_lists" ).append(dynamic_html);
	$("#attr_row_cnt").val(rowcnt);	
}

function delete_attroptions(rowcnt){
      document.getElementById("attropt_row_"+rowcnt).remove();	  
} 

function save_attribute_options(){
	if ($('#jvalidate').valid()) {		
		loading();    
		 $.ajax({
			url: 'attrvaladd_actions.php',
			method     : 'POST',
			dataType   : 'json',
			data: $("#jvalidate").serialize(),
			success: function(response) {  
				if(response.rslt =='1'){
					 swal({
			title: 'Success!',
			text: "Attribute Options Insert / Update Successfully",
			type: 'success',
			showCancelButton: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Okay",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {			
						$(location).attr('href', 'customfields_mng.php');			
						}

            });
					
				}
				else if(response.rslt == "2"){
					toast({type: 'warning',title: "Attribute missing",padding: '2em',}); 
				}
				else if(response.rslt == "3"){
					toast({type: 'warning',title:  "Please Enter atleast one attibute option",padding: '2em',}); 
				}
				unloading();			
			}
		}); 		
	}
}
</script>