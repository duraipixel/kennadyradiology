<?php 
$menudisp = "attributemap";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeAttrmap($db,'');
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
$edit_id = base64_decode($id);
$str_ed = "select group_concat(attributeId) as modulelist from ".TPLPrefix."attributes where  IsActive = ? and attribute_groupId = ?  ";
$res_ed = $db->get_a_line_bind($str_ed,array('1',$edit_id));

$module_listall = $res_ed['modulelist'];
$module_listarray = explode(",",$module_listall); 


 $str_frnt = "SELECT group_concat(attributeId) as attrfrnt FROM ".TPLPrefix."attributes where useInFront = ? and IsActive = ? and attribute_groupId = ?  ";
$res_frnt = $db->get_a_line_bind($str_frnt,array('1','1',$edit_id));

$attr_listall = $res_frnt['attrfrnt'];
$attr_listarray = explode(",",$attr_listall);

 $str_fltr = "SELECT group_concat(attributeId) as attrfilter FROM ".TPLPrefix."attributes where IsFilter = ? and IsActive = ? and attribute_groupId = ?  ";
$res_filter = $db->get_a_line_bind($str_fltr,array('1','1',$edit_id));

$filtr_listall = $res_filter['attrfilter'];
$filter_listarray = explode(",",$filtr_listall); 


 $str_comb = "SELECT group_concat(attributeId) as attrcomb FROM ".TPLPrefix."attributes where isCombined = ? and IsActive = ? and attribute_groupId = ?  ";
$res_comb = $db->get_a_line_bind($str_comb,array('1','1',$edit_id));

$comb_listall = $res_comb['attrcomb'];
$comb_listarray = explode(",",$comb_listall); 
}
else
{
//check edit permission - START	
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
	$btn='Save';
	
	$str_ed = "select group_concat(attributeId) as modulelist from ".TPLPrefix."attributes where  IsActive= ? and attrMapId = ?  ";
	$res_ed = $db->get_a_line_bind($str_ed,array('1',$edit_id));
	
	$module_listall = $res_ed['modulelist'];
	$module_listarray = explode(",",$module_listall); 
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
          <h3>Map Group & Attributes</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="attributesmap_mng.php">Map Group & Attributes</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Map Group & Attributes</a> </li>
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
                  <h4><?php echo $operation; ?> Map Group & Attributes</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="menu-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Attribute Group Name<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php 
											  echo getSelectBox_attrGroupalist($db,'attribute_groupId','','required',$edit_id);
											 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row"> <span class="typo-section-head">
                      <h6><i class="fa fa-th"></i> Attributes List </h6>
                      </span> </div>
                    <div class="row">&nbsp;</div>
                     
                      <table id="tblresult" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="text-center"> <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox"  class="custom-control-input"  name="allmap" id="allmap" >
                                  <label class="checkbox-material custom-control-label" for="allmap">All</label>
                                </div>
                              </div>
                            </th>
                            <th>Attribute</th>
                            <th>Filter</th>
                            <th>Front</th>
                            <th>Combined Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
													
													
													
													
													
													$filter_group = '';
													
													$module_list_qry = "select attributeId,attributeName,attribute_type from ".TPLPrefix."m_attributes where  IsActive = ? and parent_id = 0 ";													
													
													  $module_list = $db->get_rsltset_bind($module_list_qry,array('1'));
													  foreach($module_list as $module_list_S)
													  {
														  $chek='';
														  if (in_array($module_list_S['attributeId'], $module_listarray)) {
																$chek = 'checked';
														  }
														  
														  $chekfrnt='';
														  if (in_array($module_list_S['attributeId'], $attr_listarray)) {
																$chekfrnt = 'checked';
														  }
														  
														  //filter_listarray
														  $chekfilter='';
														  if (in_array($module_list_S['attributeId'], $filter_listarray)) {
																$chekfilter = 'checked';
														  }
														  
														  //combined_listarray
														  $chekcomb='';
														  if (in_array($module_list_S['attributeId'], $comb_listarray)) {
																$chekcomb = 'checked';
														  }
														  
														  
														  
													?>
                          <tr class="checkboxlist-row">
                            <td><div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" name="modulecheck_list[]" id="modulecheck_list<?php echo $module_list_S['attributeId']; ?>" value="<?php echo $module_list_S['attributeId']; ?>" <?php echo $chek; ?> class="master master<?php echo $module_list_S['attributeId']; ?> custom-control-input" >
                                  <label class="checkbox-material custom-control-label" for="modulecheck_list<?php echo $module_list_S['attributeId']; ?>">&nbsp;</label>
                                </div>
                              </div></td>
                            <td><label> <span class="checkbox-material"> <span class="check"></span> </span> <?php echo $module_list_S['attributeName']; ?> </label></td>
                            <td><?php
													  if($module_list_S['attribute_type'] != 'text')
													  {
													  ?>
                              <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" id="list_<?php echo $module_list_S['attributeId']; ?>" name="filter_list[]" value="<?php echo $module_list_S['attributeId']; ?>" <?php echo $chekfilter;?> class="child child<?php echo $module_list_S['attributeId']; ?> custom-control-input" >
                                  <label class="checkbox-material custom-control-label" for="modulecheck_list<?php echo $module_list_S['attributeId']; ?>">&nbsp;</label>
                                </div>
                              </div>
                              <?php
											  }else {
											  ?>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="filter_list[]" value="<?php echo $module_list_S['attributeId']; ?>"  disabled="disabled"  class="child child<?php echo $module_list_S['attributeId']; ?>"/>
                                  <span class="checkbox-material"> <span class="check"></span> </span> </label>
                              </div>
                              <?php
											  }
											  ?></td>
                            <td><div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" id="infront_<?php echo $module_list_S['attributeId']; ?>"  name="infront[]" value="<?php echo $module_list_S['attributeId']; ?>" <?php echo $chekfrnt;?>  class="child child<?php echo $module_list_S['attributeId']; ?> custom-control-input" >
                                  <label class="checkbox-material custom-control-label" for="infront_<?php echo $module_list_S['attributeId']; ?>">&nbsp;</label>
                                </div>
                              </div></td>
                            <td><?php
											 if($module_list_S['attribute_type'] == 'dropdown' || $module_list_S['attribute_type'] == 'radio')
											 {
											 ?>
                              <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" id="isCombined<?php echo $module_list_S['attributeId']; ?>" name="isCombined[]" value="<?php echo $module_list_S['attributeId']; ?>" <?php echo $chekcomb;?>  class="child child<?php echo $module_list_S['attributeId']; ?> custom-control-input" >
                                  <label class="checkbox-material custom-control-label" for="isCombined<?php echo $module_list_S['attributeId']; ?>">&nbsp;</label>
                                </div>
                              </div>
                              <?php
											 }
											 else{						 
											 ?>
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="isCombined[]" value="<?php echo $module_list_S['attributeId']; ?>" disabled="disabled" class="child child<?php echo $module_list_S['attributeId']; ?>" />
                                  <span class="checkbox-material"> <span class="check"></span> </span> </label>
                              </div>
                              <?php
											 }
											 ?></td>
                          </tr>
                          <?php	
													  }
													?>
                      </table>
                    
                    <div class="row">
                      <div class="col col-md-9">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript: return validate_all();" ><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmAttrMap','jvalidate','Attributemap','attributesmap_mng.php');">Cancel</button>
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
	$(function () {
		$('#tblresult_modulesorting').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
	});
	
  function validate_all(){ 
    var chkmodulesel=0;
	var attrnam = $("#attribute_groupId").val();
	if(attrnam == '')
	{
		toast({type: 'warning',title: "Please select the attribute group",padding: '2em',});
 				return false;	
	}
	else
	{
		if(chkmodulesel == 0){	
			var chkModule=document.getElementsByName('modulecheck_list[]');
			for (var i = 0; i < chkModule.length; i++) {
					if(chkModule[i].checked == true){
						if(chkmodulesel ==0){
							chkmodulesel =1;
						}
					}	
			}
			if(chkmodulesel == 0){				
			toast({type: 'warning',title: "Please select one or more attribute list this group.",padding: '2em',});
				 
				return false;	
			}
			else{
				funSubmt('frmAttrMap','attributesmap_actions.php','jvalidate','Attributemap','attributesmap_mng.php');
				return true;
			}		
		}  
	}   
  }	

  function changesortingorder(attrMapId,txtval){	  
	  if(txtval !=""){		  
		  $.ajax({
			url        : 'others_actions.php',
			method     : 'POST',
			dataType   : 'json',
			data	   : 'pagename=attributemap&attrMapId='+attrMapId+'&sort_value='+txtval+'',			
			success	   : function(response){ 						  		
			}
		});
		  
	  }  
  }
  
     $(document).ready(function(){
        $("input[name='allmap']").click(function(){
			if($(this).prop("checked") == true){
                //alert("Checkbox is checked.");
				$(".checkboxlist-row  input[type='checkbox']").not(":disabled").prop("checked", "checked");
				
            }
            else if($(this).prop("checked") == false){
                //alert("Checkbox is unchecked.");
				$(".checkboxlist-row  input[type='checkbox']").prop("checked", "");
            }
        });
		
		$(".master").click(function(){
			var trigVal = $(this).val();
			//alert(trigVal);
			if($(this).prop("checked") == true){
                //alert("Checkbox is checked.");
				$(".child"+trigVal).prop("checked", "checked");
				
            }
            else if($(this).prop("checked") == false){
                //alert("Checkbox is unchecked.");
				$(".child"+trigVal).prop("checked", "");
            }
        });
		$(".child").click(function(){
			var trigVal = $(this).val();
			var flag=0;
			$(".child"+trigVal).each(function(e){
				if($(this).prop("checked") == true)
				flag=1;	
			});
			if(flag==1){
				//alert("if");
				$(".master"+trigVal).prop("checked", "checked");
			}
			else {
				//alert("else");
			  $(".master"+trigVal).prop("checked", "");	
			}
			
        });
		
		

		

    });
</script>