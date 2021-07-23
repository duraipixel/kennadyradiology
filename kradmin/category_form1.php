<?php 
$menudisp = "category";
include "includes/header.php"; 
 include "includes/Mdme-functions.php";
$mdme = getMdmeCategory($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$getsize = getimagesize_large($db,'categorybanner','category');

$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

$getsizes = getimagesize_large($db,'categorymobileimage','categorymobileimage');
$imagevals = explode('-',$getsizes);
$imgheights = $imagevals[1];
$imgwidths = $imagevals[0];

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

$str_ed = "select * from ".TPLPrefix."category where IsActive != ? and categoryID = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));

 $edit_id = $res_ed['categoryID'];

//echo $edit_id; exit;
	$chk='';
	if($res_ed['IsActive']=='1'){	
	$chk='checked';
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
          <h3>Catalog</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
              <li><a href="category_mng.php">Category</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Category</a> </li>
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
                  <h4><?php echo $operation; ?> Category</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtcategory" id="txtcategory"  value="<?php echo $res_ed['categoryName']; ?>" onblur="generateslug(this.value);" onChange="generateslug(this.value);" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Parent Category <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php 		 	$IsCatParentChildOnly=getQuerys($db,"IsCatParentChildOnly")['value'];
										
										  if($act=="update"){
											  if (isset($chk_Ref_there)) {
										  ?>
                            <input type="hidden" name="parentcategory" value="<?php echo $res_ed['categoryID']; ?>" />
                            <?php	
											  
											  if($IsCatParentChildOnly==1)
												 echo getSelectBox_categoryparentonly($db,'parentcategory','jsrequired','',$res_ed['parentId'],$res_ed['categoryID'],'disabled');
											  else	
												echo getSelectBox_categorylist($db,'parentcategory','jsrequired','0',$res_ed['parentId'],$res_ed['categoryID'],'disabled');	  
											  }
											  else{
												if($IsCatParentChildOnly==1)
												 echo getSelectBox_categoryparentonly($db,'parentcategory','jsrequired','',$res_ed['parentId'],$res_ed['categoryID']);
											  else	
												echo getSelectBox_categorylist($db,'parentcategory','jsrequired','0',$res_ed['parentId'],$res_ed['categoryID']);   
											  }							  
										  }
										  else{
											   if($IsCatParentChildOnly==1)
												 echo getSelectBox_categoryparentonly($db,'parentcategory','jsrequired','',$res_ed['parentId'],'');
											 else
												 echo getSelectBox_categorylist($db,'parentcategory','jsrequired','0','0'); 
										  }
										 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control alphaonly" required name="categoryCode" id="categoryCode" value="<?php echo $res_ed['categoryCode']; ?>">
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">HSN Code <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="hsncode" id="hsncode"  value="<?php echo $res_ed['hsncode']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="categoryDesc" name = "categoryDesc" class="texteditor"><?php echo  $res_ed['categoryDesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Banner<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" id="categoryImage" name="categoryImage[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                            
                            <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small>
                            
                          </div>
                          
                            <div class="form-upload" id="uploadedevents">		
                             
                             
                        </div>
                      </div>
                       </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Mobile Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" id="mobimage" name="mobimage[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                             <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidths.'*'.$imgheights; ?>) </small>
                          </div>
                          <div class="form-upload" id="uploadedmobileimage">					
                        </div>
                      </div>
                      </div>
                      
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Title</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetatitle" id="categoryMetatitle" value="<?php echo $res_ed['categoryMetatitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Description</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="categoryMetadesc" id="categoryMetadesc" ><?php echo $res_ed['categoryMetadesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Keywords</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetakey" id="categoryMetakey" value="<?php echo $res_ed['categoryMetakey']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting Order</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="txtSortingorder" id="txtSortingorder" value="<?php echo $res_ed['sortingOrder']; ?>" onkeypress="return isNumber(event)" />
                            <p class="help-block"></p>
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
                              <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmtWithImg('frmCategory','category_actions.php','jvalidate','category','category_mng.php');"><?php echo $btn; ?></button>
                             <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmCategory','jvalidate','category','category_mng.php');">Cancel</button>
										
                          
                           
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
 <script type="text/javascript" src="assets/js/multiple-select.js"></script>
<script>

$(function() {
 
    $(".multiselect").multipleSelect({
            width: 460
          
            
        })
		<?php if($res_custgroup['CustomerGrupId']=='') { ?>
		.multipleSelect("checkAll");
		<?php } ?>
		;
});
$(document).ready(function(){
	$(".categoryImage").filer({
		limit: null,
		maxSize: null,
		extensions: ['jpg', 'jpeg', 'png', 'gif'],
		changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		} 
	});
});
	
	

	$(".tree .expander").eq(0).remove();
	<?php if($edit_id != ""){ ?>		
		getEventsImages('<?php echo base64_encode($edit_id); ?>');
	<?php } ?>	
	
function getEventsImages(eventsid){
	$.post("category_actions.php",{eventsid:eventsid,geteventImage:'geteventImage'},function(data){
		$("#uploadedevents").html(data);
	});
}

function deleventImg(eventImgId,eId){		 
	  var action = "deleteImg";	
	  $.post("<?php echo BASE_URL; ?>category_actions.php",{eventsImgId:eventImgId,"eId":eId,action:action},function(response){	
				getEventsImages(eId);
			}
	  )
}


<?php if($edit_id != ""){ ?>		
		getmobileImages('<?php echo base64_encode($edit_id); ?>');
	<?php } ?>	

function getmobileImages(eventsid){
	$.post("category_actions.php",{eventsid:eventsid,getmobileImage:'getmobileImage'},function(data){
		$("#uploadedmobileimage").html(data);
	});
}


function delmobileImg(eventImgId,eId){		 
	  var action = "deletemobileImg";	
	  $.post("<?php echo BASE_URL; ?>category_actions.php",{eventsImgId:eventImgId,"eId":eId,action:action},function(response){	

				getmobileImages(eId);
			}
	  )
}



	</script>
