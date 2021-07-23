<?php 
$menudisp = "frontmenu";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeFrontmenu($db,'');
include_once "includes/pagepermission.php";


//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END


$rslt_getfrontmenus = $db->get_rsltset("select * from ".TPLPrefix."forntmenu where 1=1 and IsActive =1 order by frontmenuid,lang_id asc ");
$front_menu_cnt= count($rslt_getfrontmenus);	

if($front_menu_cnt > 0){
	$rwcnt = $front_menu_cnt;
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
          <h3>Add / Update Front Menu   </h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">CMS Management</a></li>
              <li class="active"><a href="#">Add / Update Front Menu   </a> </li>
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
                  <h4>Add / Update Front Menu   </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                <form class="form-horizontal form-val-1" id="jvalidate" name="frmfrontmenu" action="#" novalidate="">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                   <input type="hidden" id="menu_row_cnt" name="menu_row_cnt" value="<?php echo $rwcnt; ?>"  />	
                  
                
                   <div id="front_menu_lists">
                     <div class="row">
                   <div class="form-group col-md-12">
					
						<?php 
						if($front_menu_cnt > 0){
							$i = 1;
							foreach($rslt_getfrontmenus as $rslt_getfrontmenus_S){
								if($i == 1){
								?>
                                
								<input type="hidden" name="prev_menuids[]" value="<?php echo $rslt_getfrontmenus_S['frontmenuid']; ?>"  />
								<div class="form-group row" id="menu_row_1"> 
								<input type="hidden" name="new_menuids_update[]" value="<?php echo $rslt_getfrontmenus_S['frontmenuid']; ?>" />	
								
								<div class="col-sm-2">
								  <select class="form-control jsrequired" name="txtlanguage_name[]" placeholder="Language Name">
								  <?php $getlanguage = getLanguages($db);

								   foreach($getlanguage as $languageval){ 
								  								  $sel = '';
									if($languageval['languageid'] == $rslt_getfrontmenus_S['lang_id']){
									   $sel = "selected='selected'";
								    }
								   ?>
								  <option <?php echo $sel;?> value="<?php echo $languageval['languageid'];?>"><?php echo $languageval['languagename'];?></option>
								   <?php }?>
								   </select>
								</div>
								
                                
								<div class="col-sm-2">
								  <input type="text" class="form-control jsrequired" name="txtMenu_name[]" placeholder="Menu Name" value="<?php echo $rslt_getfrontmenus_S['f_menuname']; ?>" />
								</div>
								
								<div class="col-sm-2">						   
									<select class="form-control select2 jsrequired" name="sel_menutype[]" onchange="get_selbxmenulinks(1,this.value)" >
										<option value="">Select Menu Type</option>
										<option value="1" <?php if($rslt_getfrontmenus_S['f_menutype'] == "1") echo "selected='selected'"; ?> >CMS Page</option>
										<option value="2" <?php if($rslt_getfrontmenus_S['f_menutype'] == "2") echo "selected='selected'"; ?> >CMS Block</option>
										<option value="3" <?php if($rslt_getfrontmenus_S['f_menutype'] == "3") echo "selected='selected'"; ?> >Category</option>
										<option value="4" <?php if($rslt_getfrontmenus_S['f_menutype'] == "4") echo "selected='selected'"; ?> >Link</option>
									</select>	
								</div>
								
								<div class="col-sm-3" id="sel_linkoptions_1">	
									
									
									<?php 
										if($rslt_getfrontmenus_S['f_menutype'] == "1"){
											//CMS page
											echo getSelectBox_CMSpage_formenu($db,'sel_menulink[]',$rslt_getfrontmenus_S['f_link_id']);
										}
										else if($rslt_getfrontmenus_S['f_menutype'] == "2"){
											//CMS block
											echo getSelectBox_CMSblock_formenu($db,'sel_menulink[]',$rslt_getfrontmenus_S['f_link_id']);
										}
										else if($rslt_getfrontmenus_S['f_menutype'] == "3"){
											//Category												
											echo getSelectBox_categorylist_frontmenu($db,'sel_menulink[]',$rslt_getfrontmenus_S['f_link_id']);    
										}
										else if($rslt_getfrontmenus_S['f_menutype'] == "4"){
											//link
										?>
									<input type="text" class="form-control jsrequired" name="sel_menulink[]" placeholder="Link" value="<?php echo $rslt_getfrontmenus_S['f_link_name']; ?>" />
										
										<?php
										}
									?>
								</div>
								<div class="col-sm-1">
									<input type="text" class="form-control" name="txtMenu_sortby[]" placeholder="SortBy" onkeypress="return isNumber(event)" value="<?php echo $rslt_getfrontmenus_S['sortingorder']; ?>"  /> 			    
								</div>
								
								 <div class="col-sm-2">
									<a href="javascript:void(0);" onclick="add_menu_row();" class="add_front" ><i class="flaticon-add-circle-outline"></i></a> 
								</div>	
						  
								
								</div>	
								<?php										
								}								
								else{
								?>
                                
								<input type="hidden" name="prev_menuids[]" value="<?php echo $rslt_getfrontmenus_S['frontmenuid']; ?>"  />
								<div class="form-group row" id="menu_row_<?php echo $i; ?>"> 
								<input type="hidden" name="new_menuids_update[]" value="<?php echo $rslt_getfrontmenus_S['frontmenuid']; ?>" />	
								
								<div class="col-sm-2">
								  <select class="form-control jsrequired" name="txtlanguage_name[]" placeholder="Language Name">
								  <?php $getlanguage = getLanguages($db);
								  
								   foreach($getlanguage as $languageval){ 
								$sel = '';   if($languageval['languageid'] == $rslt_getfrontmenus_S['lang_id']){
									   $sel = "selected='selected'";
								   }
								   ?>
								  <option <?php echo $sel;?> value="<?php echo $languageval['languageid'];?>"><?php echo $languageval['languagename'];?></option>
								   <?php }?></select>
								</div>
								
								<div class="col-sm-2">
								  <input type="text" class="form-control jsrequired" name="txtMenu_name[]" placeholder="Menu Name" value="<?php echo $rslt_getfrontmenus_S['f_menuname']; ?>" />
								</div>
								
								<div class="col-sm-2">						   
									<select class="form-control select2 jsrequired" name="sel_menutype[]" onchange="get_selbxmenulinks(<?php echo $i; ?>,this.value)" >
										<option value="">Select Menu Type</option>
										<option value="1" <?php if($rslt_getfrontmenus_S['f_menutype'] == "1") echo "selected='selected'"; ?> >CMS Page</option>
										<option value="2" <?php if($rslt_getfrontmenus_S['f_menutype'] == "2") echo "selected='selected'"; ?> >CMS Block</option>
										<option value="3" <?php if($rslt_getfrontmenus_S['f_menutype'] == "3") echo "selected='selected'"; ?> >Category</option>
										<option value="4" <?php if($rslt_getfrontmenus_S['f_menutype'] == "4") echo "selected='selected'"; ?> >Link</option>
									</select>	
								</div>
								
								<div class="col-sm-3" id="sel_linkoptions_<?php echo $i; ?>">	
									<?php 
										if($rslt_getfrontmenus_S['f_menutype'] == "1"){
											//CMS page
											echo getSelectBox_CMSpage_formenu($db,'sel_menulink[]',$rslt_getfrontmenus_S['f_link_id']);
										}
										else if($rslt_getfrontmenus_S['f_menutype'] == "2"){
											//CMS block
											echo getSelectBox_CMSblock_formenu($db,'sel_menulink[]',$rslt_getfrontmenus_S['f_link_id']);
										}
										else if($rslt_getfrontmenus_S['f_menutype'] == "3"){
											//Category												
											echo getSelectBox_categorylist_frontmenu($db,'sel_menulink[]',$rslt_getfrontmenus_S['f_link_id']);    
										}
										else if($rslt_getfrontmenus_S['f_menutype'] == "4"){
											//link
										?>
										
										<input type="text" class="form-control jsrequired" name="sel_menulink[]" placeholder="Link" value="<?php echo $rslt_getfrontmenus_S['f_link_name']; ?>" />
										
										<?php
										}
									?>
								</div>
								
								<div class="col-sm-1">
									<input type="text" class="form-control" name="txtMenu_sortby[]" placeholder="SortBy" onkeypress="return isNumber(event)" value="<?php echo $rslt_getfrontmenus_S['sortingorder']; ?>"  /> 			    
								</div>
								
								<div class="col-sm-2">
									<a href="javascript:void(0);" onclick="add_menu_row();" class="add_front"><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp;
									<a href="javascript:void(0);" onclick="delete_menu_row(<?php echo $i; ?>);" class="remove_front"><i class="flaticon-delete-1"></i></a>
								</div>
								
								</div>	
								<?php										
								}
								
								$i = $i +1;
							}
						}						
						else {
						?>
						
						<div class="form-group row" id="menu_row_1"> 						
						 
						 <div class="col-sm-2">
								  <select class="form-control jsrequired" name="txtlanguage_name[]" placeholder="Language Name">
								  <?php $getlanguage = getLanguages($db);
								  
								   foreach($getlanguage as $languageval){ 
								    
								   ?>
								  <option value="<?php echo $languageval['languageid'];?>"><?php echo $languageval['languagename'];?></option>
								   <?php }?></select>
								</div>
								
						 <div class="col-sm-2">
							<input type="text" class="form-control jsrequired" name="txtMenu_name[]" placeholder="Menu Name" />			    
						 </div>						  
						 
						 <div class="col-sm-2">						   
							<select class="form-control select2 jsrequired" name="sel_menutype[]" onchange="get_selbxmenulinks(1,this.value)" >
								<option value="">Select Menu Type</option>
								<option value="1" selected="selected">CMS Page</option>
								<option value="2">CMS Block</option>
								<option value="3">Category</option>
								<option value="4">Link</option>
							</select>	
						  </div>
						  
						  <div class="col-sm-3" id="sel_linkoptions_1">						  
							<?php 
							echo getSelectBox_CMSpage_formenu($db,'sel_menulink[]'); 
							?>						  							
						  </div>	
						  
						  <div class="col-sm-1">
							<input type="text" class="form-control" name="txtMenu_sortby[]" placeholder="SortBy" onkeypress="return isNumber(event)"  /> 			    
						  </div>
						  
						  <div class="col-sm-2">
						    <a href="javascript:void(0);" onclick="add_menu_row();">Add</a>
						  </div>					 
						  
						</div> 

						<?php	
							
						}
						?>						
					</div>
                  </div> 
              </div>
                  
                
                  
                  <div class="row">
                    <div class="col col-md-4">
                      <div class="control-group mb-4"> &nbsp; </div>
                    </div>
                    <div class="col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls"> 
                           <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:save_menus_todb();">Update</button>
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmfrontmenu','jvalidate','customfields','frontmenu_mng.php');">Cancel</button>
										
                                        
                                    
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

function get_selbxmenulinks(rwcnt,menutypeid){
	// menutypeid {1- cms page}, {2- cms block}, {3- category}, {4- link}
	if(menutypeid !=null && rwcnt !=null){
		
		loading();    
		 $.ajax({
			url: 'frontmenu_operations.php',
			method     : 'POST',
			dataType   : 'json',
			data       : 'hdnact=getMenulinkoptions&menutypeid='+menutypeid,
			success: function(response) { 
				//sel_linkoptions_1				
				$("#sel_linkoptions_"+rwcnt).html(response.rslt);
				$(".select2").select2();
				unloading();			
			}
		});
		
	}
}

function add_menu_row(){

	var rowcnt = $("#menu_row_cnt").val();
	rowcnt = Number(rowcnt) + 1;
<?php $getlanguage = getLanguages($db);?>	
var dynamic_html = '<div class="form-group row" id="menu_row_'+rowcnt+'"><div class="col-sm-2"><select class="form-control jsrequired" name="txtlanguage_name[]" placeholder="Language Name"><?php foreach($getlanguage as $languageval){?><option value="<?php echo $languageval['languageid'];?>"><?php echo $languageval['languagename'];?></option><?php }?></select></div><div class="col-sm-2"><input type="text" class="form-control jsrequired" name="txtMenu_name[]" placeholder="Menu Name" /> </div><div class="col-sm-2"> <select class="form-control select2 jsrequired" name="sel_menutype[]" onchange="get_selbxmenulinks('+rowcnt+',this.value)" ><option value="" selected="selected">Select Menu Type</option><option value="1">CMS Page</option><option value="2">CMS Block</option><option value="3">Category</option><option value="4">Link</option></select> </div> <div class="col-sm-3" id="sel_linkoptions_'+rowcnt+'"> </div> <div class="col-sm-1"><input type="text" class="form-control jsrequired" name="txtMenu_sortby[]" placeholder="SortBy" onkeypress="return isNumber(event)"/> </div><div class="col-sm-2"> <a href="javascript:void(0);" class="add_front" onclick="add_menu_row();"><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp;<a href="javascript:void(0);" class="remove_front" onclick="delete_menu_row('+rowcnt+');"><i class="flaticon-delete-1"></i></a> </div></div> ';
	
	get_selbxmenulinks(rowcnt,1);
			   
	$( "#front_menu_lists" ).append(dynamic_html);
	$("#menu_row_cnt").val(rowcnt);	
	
	$(".select2").select2();
}

function delete_menu_row(rowcnt){
      document.getElementById("menu_row_"+rowcnt).remove();	  
} 

function save_menus_todb(){
	if ($('#jvalidate').valid()) {	
		loading();    
		 $.ajax({
			url: 'frontmenu_actions.php',
			method     : 'POST',
			dataType   : 'json',
			data: $("#jvalidate").serialize(),
			success: function(response) {  
				if(response.rslt =="1"){							
					//swal("Success!", "Front Menu Update Successfully", "success");	
					//location.reload();	
					swal({
						title: "Success!",
						text: "Front Menu Update Successfully",
						type: "success",
						showCancelButton: false,
						confirmButtonColor: "#A5DC86",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					},
					function () {
						location.reload();	
					});
				}
				else if(response.rslt == "2"){
					swal("Failure!", "Server Busy", "warning");
				}
				else {
					swal("Failure!", "Server Busy", "warning");
				}
				unloading();			
			}
		}); 		
	}
}
</script>

