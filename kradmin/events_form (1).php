<?php 
$menudisp = "events";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeevents($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END
$getsize = getimagesize_large($db,'events','large');
//print_r($getsize); exit;
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
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


$str_ed = "select * from ".TPLPrefix."events where IsActive != ? and eventid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));


$str_ed_es = "select * from ".TPLPrefix."events where IsActive != ? and parent_id = ? and lang_id = 2";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array(2,base64_decode($id)));


$str_ed_pt = "select * from ".TPLPrefix."events where IsActive != ? and parent_id = ? and lang_id = 3 ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array(2,base64_decode($id)));

$edit_id = $res_ed['eventid'];
$edit_id_es = $res_ed_es['eventid'];
$edit_id_pt = $res_ed_pt['eventid'];
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
          <h3>Eevents</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Media</a></li>
              <li><a href="events_mng.php">Eevents</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Eevents</a> </li>
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
                  <h4><?php echo $operation; ?> Eevents</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="menu-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Eevents Title  <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txteventtitle" id="txteventtitle" value="<?php echo $res_ed['eventtitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?>  Eevents Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txteventtitle_es" id="txteventtitle_es" value="<?php echo $res_ed_es['eventtitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Eevents Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txteventtitle_pt" id="txteventtitle_pt" value="<?php echo $res_ed_pt['eventtitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Date <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <!--<input type="text" class="form-control" required name="txteventdate" id="txteventdate" value="<?php echo $res_ed['eventdate']; ?>"  />
                            <p class="help-block"></p>-->

                            <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="Eevents Date" name="txteventdate" id="txteventdate"   value="<?php echo $res_ed['eventdate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['eventdate'])): date($GLOBALS['eventdate']['phpformat']); ?>" readonly required>
                              <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>
                            <p class="help-block"></p>

                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" required name="txteventdescription" id="txteventdescription" value="<?php echo $res_ed['eventdescription']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" required name="txteventdescription_es" id="txteventdescription_es" value="<?php echo $res_ed_es['eventdescription']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" required name="txteventdescription_pt" id="txteventdescription_pt" value="<?php echo $res_ed_pt['eventdescription']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    


                   <!-- <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting Order</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" name="txtSortingorder" id="txtSortingorder" value="<?php echo $res_ed['sortingOrder']; ?>" onkeypress="return isNumber(event)" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>-->

                    <div class="row">
                        <div class="col col col-md-3">
                          <div class="control-group mb-4">
                            <label class="control-label">Choose </label>
                          </div>
                        </div>
                        <div class="col col col-md-4">
                          <div class="control-group mb-4">
                            <div class="controls">
                              <label class="new-control new-radio radio-primary">
                                
                                 <input type="radio" class="new-control-input" <?php echo ($res_ed['eventimage'] != '') ? 'checked' : '';?> onclick="checkmediatype(this.value);" name="chooses" id="chooses" value="1"/>
                                <span class="new-control-indicator"></span> Photo </label>
                              <label class="new-control new-radio radio-primary">
                               
                                <input type="radio" class="new-control-input" <?php echo ($res_ed['eventvideourl'] != '') ? 'checked' : '';?> onclick="checkmediatype(this.value);" name="chooses" id="chooses1" value="2"/>
                                <span class="new-control-indicator"></span> Video </label>
                              <p class="help-block"></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row fls-eat" id="photos" style="display:none;">
                      <div class="col col-md-3" >
                        <div class="control-group mb-4">
                          <label class="control-label">Photo <span class="required-class">* </span></label>
                          
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <?php  if (!empty($res_ed['eventimage']) && ($act == 'update')) {
                                  $req="  ";
                              }else{
                                   $req=" required ";
                              }?>
                            <input type="file" class="common_upload_style" <?php echo $req; ?> name="eventsimages" id="eventsimages"/>
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed['eventimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>events/<?php echo $res_ed['eventimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php  } ?>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small> </div>
                      </div>
                    </div>
                    <div class="row fls-eat" id="photos_es" style="display:none;">
                      <div class="col col-md-3" >
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Photo <span class="required-class">* </span></label>
                          
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <?php  if (!empty($res_ed_es['eventimage']) && ($act == 'update')) {
                                  $req_es="  ";
                              }else{
                                   $req_es=" required ";
                              }?>
                            <input type="file" class="common_upload_style" <?php echo $req_es; ?> name="eventsimages_es" id="eventsimages_es"/>
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed_es['eventimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>events/<?php echo $res_ed_es['eventimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php  } ?>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small> </div>
                      </div>
                    </div>

                    <div class="row fls-eat" id="photos_pt" style="display:none;">
                      <div class="col col-md-3" >
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Photo <span class="required-class">* </span></label>
                          
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <?php  if (!empty($res_ed_pt['eventimage']) && ($act == 'update')) {
                                  $req_pt="  ";
                              }else{
                                   $req_pt=" required ";
                              }?>
                            <input type="file" class="common_upload_style" <?php echo $req_pt; ?> name="eventsimages_pt" id="eventsimages_pt"/>
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed_pt['eventimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>events/<?php echo $res_ed_pt['eventimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php  } ?>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small> </div>
                      </div>
                    </div>


                    
                    <div class="row fls-eat" id="videos" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Video URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " required name="txteventvideourl" id="txteventvideourl" value="<?php echo $res_ed['eventvideourl']; ?>" />
                  Add Embed Link 
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row fls-eat" id="videos_es" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Video URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " required name="txteventvideourl_es" id="txteventvideourl_es" value="<?php echo $res_ed['eventvideourl']; ?>" />
                  Add Embed Link 
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row fls-eat" id="videos_pt" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Video URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " required name="txteventvideourl_pt" id="txteventvideourl_pt" value="<?php echo $res_ed['eventvideourl']; ?>" />
                  Add Embed Link 
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row fls-eat" id="videosurl" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Eevents URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " name="txteventurl" id="txteventurl" value="<?php echo $res_ed['eventurl']; ?>" />
                  <span class="">Include(http://)</span>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row fls-eat" id="videosurl_es" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"> <?php echo Spanish; ?> Eevents URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " name="txteventurl_es" id="txteventurl_es" value="<?php echo $res_ed_es['eventurl']; ?>" />
                  <span class="">Include(http://)</span>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row fls-eat" id="videosurl_pt" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Eevents URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " name="txteventurl_pt" id="txteventurl_pt" value="<?php echo $res_ed_pt['eventurl']; ?>" />
                  <span class="">Include(http://)</span>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row fls-eat">
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
                    <div class="row fls-eat">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                                <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmtWithImg('frmevent','events_actions.php','jvalidate','Events','events_mng.php');"><?php echo $btn; ?></button>
                                        
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmevent','jvalidate','Events','events_mng.php');">Cancel</button>
                                        
                           
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
<script type="text/javascript">
$(document).ready(function() {
           <?php if($res_ed['eventimage']!='' && $act == 'update' ){ ?>
    checkmediatype('1');
<?php } ?>
        });
        

function checkmediatype(id){
	if(id=='1'){
		$("#photos").css('display', 'block');
    $("#photos_es").css('display', 'block');
    $("#photos_pt").css('display', 'block');
		
    $("#videos").css('display', 'none');
    $("#videos_es").css('display', 'none');
    $("#videos_pt").css('display', 'none');

		$("#videosurl").css('display', 'none');
    $("#videosurl_es").css('display', 'none');
    $("#videosurl_pt").css('display', 'none');
	}else{
		$("#photos").css('display', 'none');
    $("#photos_es").css('display', 'none');
    $("#photos_pt").css('display', 'none');

		$("#videos").css('display', 'block');
    $("#videos_es").css('display', 'block');
    $("#videos_pt").css('display', 'block');

		$("#videosurl").css('display', 'block');
    $("#videosurl_es").css('display', 'block');
    $("#videosurl_pt").css('display', 'block');
	}
}


</script>
<!--  END FOOTER  -->