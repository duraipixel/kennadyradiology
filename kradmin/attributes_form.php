<?php 
$menudisp = "Area";
include "includes/header.php"; 
 include "includes/Mdme-functions.php";
$mdme = getMdmeAttributes($db,'');
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
	
//	echo base64_decode($id);die();
	
$str_ed = "select * from ".TPLPrefix."m_attributes where IsActive != '2' and attributeid = '".base64_decode($id)."' and parent_id='0' ";
$res_ed = $db->get_a_line($str_ed);

$str_ed_es = "select * from ".TPLPrefix."m_attributes where IsActive != '2' and parent_id = '".$res_ed['attributeid']."' and lang_id='2' ";
$res_ed_es = $db->get_a_line($str_ed_es);

$str_ed_bt = "select * from ".TPLPrefix."m_attributes where IsActive != '2' and parent_id = '".$res_ed['attributeid']."' and lang_id='3' ";
$res_ed_bt = $db->get_a_line($str_ed_bt);

$edit_id = $res_ed['attributeid'];
$edit_id_es = $res_ed_es['attributeid'];
$edit_id_bt = $res_ed_bt['attributeid'];
    
    $chk='';
    if($res_ed['IsActive']=='1')
    {
    	$chk='checked';
    }
    
    $chkunit='';
    if($res_ed['unitdisplay']=='1')
    {
    	$chkunit='checked';
    }
    
    $chkicons='';
    if($res_ed['iconsdisplay']=='1')
    {
    	$chkicons='checked';
    }
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
          <h3>Attributes</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="attributes_mng.php">Attributes</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Attributes</a> </li>
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
                  <h4><?php echo $operation; ?> Attributes</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                <form class="form-horizontal form-val-1" id="jvalidate" name="frmAttributes" action="#" novalidate="">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
				    <input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?>"  />
                   <input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_bt; ?>"  />
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Attribute Name <span class="required-class">* </span></label>
                      </div>
                    </div>
					
					<div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control" required name="txtAttributesname" id="txtAttributesname" value="<?php echo $res_ed['attributename']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
					
					
					</div>
					
					 <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label"><?php echo Spanish; ?> Attribute Name <span class="required-class">* </span></label>
                      </div>
                    </div>
					
					<div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control" required name="txtAttributesname_pt" id="txtAttributesname_pt" value="<?php echo $res_ed_es['attributename']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
					
					
					</div>
					
					 <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label"><?php echo Portuguese; ?> Attribute Name <span class="required-class">* </span></label>
                      </div>
                    </div>
					
					<div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control" required name="txtAttributesname_es" id="txtAttributesname_es" value="<?php echo $res_ed_es['attributename']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
					
					
					</div>
					 
					 
                  <div class="row">
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Attribute Type</label>
                      </div>
                    </div>
                    <div class="col col-md-6">
                      <div class="control-group">
                        <div class="controls"> <?php echo getSelectBox_Attributetype($db,'attribute_type','',$res_ed['attribute_type'],'required');	?>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div id="dropdownValues" style="display:none">
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Data Type <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
											echo getSelectBox_Attribute_datatype($db,'datatype','',$res_ed['data_type'],'required'); 
										?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="font-weight:bold">
                      <?php 						  
						  $str_attrib = "select * from ".TPLPrefix."dropdown where attributeId = '".base64_decode($id)."' and isactive=1  and lang_id='1' ";
						  $res_attrib = $db->get_rsltset($str_attrib);
						  
						     $str_attrib_es = "select * from ".TPLPrefix."dropdown where attributeId = '".($edit_id_es)."' and isactive=1 and lang_id='2' ";
						  $res_attrib_es = $db->get_rsltset($str_attrib_es);
						  
						  $str_attrib_pt = "select * from ".TPLPrefix."dropdown where attributeId = '".($edit_id_bt)."' and isactive=1 and lang_id='3' ";
						  $res_attrib_pt = $db->get_rsltset($str_attrib_pt);
						  
						  	//print_r($res_attrib); 				  
						  if(count($res_attrib) == 0 || base64_decode($id) == '')
						  {
							  $counter = 1;
						  ?>
						  <div class="col-sm-1">Values</div>
                    <div class="col-sm-1"><?php echo Spanish; ?> Values</div>
								<div class="col-sm-1"><?php echo Portuguese; ?> Values</div>
                    <div class="col-sm-2">Units</div>
                    <div class="row col-sm-3">&nbsp;&nbsp;&nbsp;Icons</div>
                    <div class="col-sm-1">Sorting</div>
                    <div class="col-sm-2">Action</div>
                    </div>
                    <br />
                    
                    <div class="row">
                     <div class="col-sm-12">
                     <div class="row" id="dropdownLabel">
					  <div class="col-sm-1">
								         <input type="text" class="dropdownClass form-control" name="dropdownValues[]" id="dropdownValues_0" />
                                </div>
								
								<div class="col-sm-1">
								         <input type="text" class="dropdownClass form-control" name="dropdownValues_es[]" id="dropdownValues_es_0" />
                                </div>
								
                      <div class="col-sm-1 no-padding-right">
                        <input type="text" class="dropdownClass form-control" name="dropdownValues_pt[]" id="dropdownValues_pt_0" />
                      </div>
                      <div class="col-sm-2 no-padding-right">
                        <input type="text" class="form-control" name="dropdownUnits[]" id="dropdownUnits_0" />
                      </div>
                      <div class="col-sm-3 no-padding-right">
                        <div class="col-sm-10"><input id="dropdwnImages_0" class="common_upload_style" name="attributeicons[]" type="file"  onchange="return imageformatcheck(this.value,'image')" />
                        </div>
                     <!--   <label for="dropdwnImages_0" class="browseimg" > Browse</label>-->
                      </div>
                      <div class="col-sm-1 no-padding-right">
                        <input type="text" class="form-control" name="dropdownSort[]" id="dropdownSort_0" onkeypress="return isNumber(event)" />
                      </div>
                      <div class="col-sm-2"> <a href="javascript:addDropDown();" class="add_front"><i class="flaticon-add-circle-outline"></i></a> </div>
                  </div></div>
                    </div>                     
                  </div>
                    <div class="row">
                    <div class="col-sm-12">
                      <div id="dropdownArea"> </div>
                    </div>
                  </div>
                  
                  <div class="form-group" style="display:none">
                    <?php }
						  
						  else{
							  $counter = 0;
						  ?>
                  <div class="col-sm-1">Values</div>
                    <div class="col-sm-1"><?php echo Spanish; ?> Values</div>
								<div class="col-sm-1"><?php echo Portuguese; ?> Values</div>
                    <div class="col-sm-2">Units</div>
                    <div class="row col-sm-3">&nbsp;&nbsp;&nbsp;Icons</div>
                    <div class="col-sm-1">Sorting</div>
                    <div class="col-sm-2">Action</div>
                  </div>
                  <br />
                  <input type="hidden" id="tstedt"	 value="1" />
                  <?php 							
								foreach($res_attrib as $val) { ?>
                  <div class="row">
                     <div class="col-sm-1">
					 <input type="hidden" name="editdropdownId[]" value="<?php echo $val['dropdown_id']; ?>" />
                      <input class="form-control" type="text" name="editdropdownValues<?php echo $val['dropdown_id']; ?>" id="dropdownValues_<?php echo $counter; ?>" value="<?php echo $val['dropdown_values']; ?>" />
                    </div>
					<div class="col-sm-1 no-padding-right">
					<input class="form-control" type="text" name="editdropdownValues_es[]" id="dropdownValues_es_<?php echo $counter; ?>" value="<?php echo $res_attrib_es[$counter]['dropdown_values']; ?>" />
					<input type="hidden" name="editdropdownId_es[]" value="<?php echo $res_attrib_es[$counter]['dropdown_id']; ?>" /> 
					</div>								
					
					<div class="col-sm-1 no-padding-right">
					<input class="form-control" type="text" name="editdropdownValues_pt[]" id="dropdownValues_pt_<?php echo $counter; ?>" value="<?php echo $res_attrib_pt[$counter]['dropdown_values']; ?>" />
					<input type="hidden" name="editdropdownId_pt[]" value="<?php echo $res_attrib_pt[$counter]['dropdown_id']; ?>" /> 
					</div>
					
                    <div class="col-sm-2 no-padding-right">
                      
                      <input type="text" class="form-control" name="editdropdownUnits<?php echo $val['dropdown_id']; ?>" id="dropdownUnits_<?php echo $counter; ?>" value="<?php echo $val['dropdown_unit']; ?>" />
                    </div>
                    <div class="row col-sm-3">
                     <div class="col-sm-10">
                      <input id="dropdwnImages_<?php echo $counter; ?>" name="attributeicons_<?php echo $val['dropdown_id'];?>" type="file" class="common_upload_style"  onchange="return imageformatcheck(this.value,'image')" /> 
					  </div>
					   <div class="col-sm-2"> <?php 
									if (!empty($val['dropdown_images']) && ($act == 'update')) { 
									  if(file_exists("../uploads/attributes/".$val['dropdown_images']))
									   { ?>
                      <img src="../uploads/attributes/<?php echo $val['dropdown_images']; ?>" width="30px" align="absmiddle"/>
                      <?php
									   }
									   else{ ?>
                      <img src="../uploads/NoImageAvailable.png" width="30px" align="absmiddle"/>
                      <?php }
									 } 
									 ?>
                     </div>
                    </div>
                    <div class="col-sm-1 no-padding-right">
                      <input type="text" class="form-control" name="dropdownSort<?php echo $val['dropdown_id']; ?>" id="dropdownSort_<?php echo $counter; ?>" value="<?php echo $val['sortingOrder']; ?>" />
                    </div>
                    <div class="col-sm-2"> <a class="add_front" href="javascript:addDropDown();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp; <a class="remove_front" href="javascript:removeDropDownAjax(<?php echo $val['dropdown_id']; ?>);" ><i class="flaticon-delete-1"></i></a> 
                    
                    </div>
                  </div>
                  <?php 
									$counter++;
								} ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="dropdownArea"> </div>
                    </div>
                  </div>
                  <br />
                  <?php 								
						  } 
						  ?>
                  
                  <!--        ///////////////////////////////////                  -->
                  
                  <div class="row unit_icons">
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Units Display </label>
                      </div>
                    </div>
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-success">
                              <input type="checkbox"  class="new-control-input" name="unitdisplay" id="unitdisplay" <?php echo $chkunit; ?>>
                              <span class="new-control-indicator"></span>&nbsp; </label>
                          </div>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row unit_icons">
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Icons Display </label>
                      </div>
                    </div>
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-success">
                              <input type="checkbox"  class="new-control-input" name="iconsdisplay" id="iconsdisplay" <?php echo $chkicons; ?>>
                              <span class="new-control-indicator"></span>&nbsp; </label>
                          </div>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
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
                           <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmtWithImg('frmAttributes','attributes_actions.php','jvalidate','attributes','attributes_mng.php');"><?php echo $btn; ?></button>
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmAttributes','jvalidate','attributes','attributes_mng.php');">Cancel</button>
										
                                        
                                    
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

<script>
jQuery(document).ready(function($){
   $(".unit_icons").hide();
	if($("#attribute_type").val() == "dropdown" || $("#attribute_type").val() == "checkbox" || $("#attribute_type").val() == "radio" || $("#attribute_type").val() == "multiselect" ){
		$("#dropdownValues").show();
		$(".unit_icons").show();
	}
	$("#attribute_type").change(function(){
		if($(this).val() == "dropdown" || $(this).val() == "checkbox" || $(this).val() == "radio" || $(this).val() == "multiselect"){
			$("#dropdownValues").show();
			$(".unit_icons").show();
		}
		else{
			$("#dropdownValues").hide();
			$(".unit_icons").hide();
		}
	});
	
	$("#datatype").change(function(){
		if( $(this).val() == "number") {
			$(".dropdownClass ").addClass("number");
		}
		else{
			$(".dropdownClass ").removeClass("number");
		}		
	});
	
});
var counter = <?php echo $counter; ?>; 
var image = 'image';
function addDropDown(){
	$("#dropdownArea").append('<div class="row" id="dropdownLabel'+counter+'"><div class="col-sm-1 "><input type="text" class="dropdownClass form-control" name="dropdownValues[]" id="dropdownValues_'+counter+'" /></div><div class="col-sm-1"><input type="text" class="dropdownClass form-control" name="dropdownValues_es[]" id="dropdownValues_es_'+counter+'" /></div> <div class="col-sm-1"><input type="text" class="dropdownClass form-control" name="dropdownValues_pt[]" id="dropdownValues_pt_'+counter+'" /></div>  <div class="col-sm-2 no-padding-right"><input type="text" class="form-control" name="dropdownUnits[]" id="dropdownUnits_'+counter+'" /> </div><div class="row col-sm-3"><div class="col-sm-10"><input id="dropdwnImages_'+counter+'" name="attributeicons[]" type="file" class="common_upload_style'+counter+'"  onchange="return imageformatcheck(this.value,'+image+')" /></div></div><div class="col-sm-1 no-padding-right"><input type="text" class="form-control" name="dropdownSort[]" id="dropdownSort_'+counter+'" onkeypress="return isNumber(event)" /></div><div class="col-sm-2"> <a class="add_front" href="javascript:addDropDown();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp; <a class="remove_front" href="javascript:removeDropDown('+counter+');" ><i class="flaticon-delete-1"></i></a></div></div>');
					
				$(".common_upload_style"+counter).filer({
		extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
		limit: 1
	});	
	/*$("#dropdownArea").append('<div id="dropdownLabel'+counter+'" class="clearfix mb15"><div class="col-sm-3"></div><div class="col-sm-2 "><input type="text"class="form-control" name="dropdownValues[]" id="dropdownValues_'+counter+'" /></div><div class="col-sm-2 "><input class="form-control" type="text" name="dropdownUnits[]" id="dropdownUnits_'+counter+'" /></div><div class="col-sm-2 "><input id="dropdwnImages_'+counter+'" name="attributeicons[]" type="file" class="file" data-show-upload="false" data-show-caption="true" onchange="return imageformatcheck(this.value,'+image+')" /><label for="dropdwnImages_'+counter+'" class="browseimg">Browse</label></div><div class="col-sm-1 "><input type="text" name="dropdownSort[]" class="form-control" id="dropdownSort_'+counter+'" onkeypress="return isNumber(event)" /></div><div class="col-sm-2"> <a class="add_front" href="javascript:addDropDown();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp; <a class="remove_front" href="javascript:removeDropDown('+counter+');" ><i class="flaticon-delete-1"></i></a></div></div>');
	*/counter++;
}
//<label for="dropdwnImages_'+counter+'" class="browseimg">Browse</label>
/*function addDropDownaaaaaaaaa(){
	$("#dropdownArea").append('<div id="dropdownLabel'+counter+'"><input type="text" name="dropdownValues[]" id="dropdownValues_'+counter+'" /> 
		<input id="dropdwnImages_'+counter+'" name="attributeicons" type="file" class="file" data-show-upload="false" data-show-caption="true" onchange="return imageformatcheck(this.value,'+image+')" /><a href="javascript:addDropDown();" >Add</a><a href="javascript:removeDropDown('+counter+');" >Remove</a><br/></div>');
	counter++;
}*/
function removeDropDown(id){
	$("#dropdownLabel"+id).remove();
}

function removeDropDownAjax($dropdown_id){
	$.ajax({
		url: 'attributes_actions.php',
		type: 'POST',
		dataType : 'json',
		data: 'action=deloptionsvalue&dropdown_id='+$dropdown_id,
		beforeSend: loading(),
		success: function(response) {	 														
			unloading();
			if(response.rslt == '6')
			{					
				toast({type: 'success',title:'Option value deleted successfully',padding: '1em'});
				location.reload();
			}
		}
	}); 	
}
</script>
 
 <style type="text/css">
 .jFiler-theme-default .jFiler-input
 {
	 width: 180px;
 }