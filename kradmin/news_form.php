<?php 
$menudisp = "news";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmenews($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END
$getsize = getimagesize_large($db,'news','large');
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


$str_ed = "select * from ".TPLPrefix."news where IsActive != ? and newsid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));


$str_ed_es = "select * from ".TPLPrefix."news where IsActive != ? and parent_id = ? and lang_id = 2";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array(2,base64_decode($id)));


$str_ed_pt = "select * from ".TPLPrefix."news where IsActive != ? and parent_id = ? and lang_id = 3 ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array(2,base64_decode($id)));

$edit_id = $res_ed['newsid'];
$edit_id_es = $res_ed_es['newsid'];
$edit_id_pt = $res_ed_pt['newsid'];
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
          <h3>News</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Media</a></li>
              <li><a href="news_mng.php">News</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> News</a> </li>
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
                  <h4><?php echo $operation; ?> News</h4>
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
                          <label class="control-label">News Title  <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtnewstitle" id="txtnewstitle" value="<?php echo $res_ed['newstitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?>  News Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtnewstitle_es" id="txtnewstitle_es" value="<?php echo $res_ed_es['newstitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> News Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtnewstitle_pt" id="txtnewstitle_pt" value="<?php echo $res_ed_pt['newstitle']; ?>" />
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
                           <!--<input type="text" class="form-control" required name="txtnewsdate" id="txtnewsdate" value="<?php echo $res_ed['newsdate']; ?>"  />
                            <p class="help-block"></p>-->

                            <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="News Date" name="txtnewsdate" id="txtnewsdate"   value="<?php echo $res_ed['newsdate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['newsdate'])): date($GLOBALS['newsdate']['phpformat']); ?>" readonly required>
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
                           <textarea class="form-control texteditor" required name="txtnewsdescription" id="txtnewsdescription"><?php echo $res_ed['newsdescription']; ?></textarea>
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
                           <textarea  class="form-control texteditor" required name="txtnewsdescription_es" id="txtnewsdescription_es"><?php echo $res_ed_es['newsdescription']; ?></textarea>
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
                           <textarea type="text" class="form-control texteditor" required name="txtnewsdescription_pt" id="txtnewsdescription_pt"><?php echo $res_ed_pt['newsdescription']; ?></textarea>
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
                                
                                 <input type="radio" class="new-control-input" <?php echo ($res_ed['newsimage'] != '') ? 'checked' : '';?> onclick="checkmediatype(this.value);" name="chooses" id="chooses" value="1"/>
                                <span class="new-control-indicator"></span> Photo </label>
                              <label class="new-control new-radio radio-primary">
                               
                                <input type="radio" class="new-control-input" <?php echo ($res_ed['newsvideourl'] != '') ? 'checked' : '';?> onclick="checkmediatype(this.value);" name="chooses" id="chooses1" value="2"/>
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
                              <?php if (empty($res_ed['newsimage']) && ($act == 'update')) {
                                $req_pt=' required ';
                                }else if($act != 'update'){
                                 $req_pt=' required ';
                                }else{
                                $req_pt='  ';
                                } ?>
                            <input type="file" class="common_upload_style" <?php echo $req_pt; ?> name="newsimage" id="newsimage"/>
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed['newsimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>news/<?php echo $res_ed['newsimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          
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
                           <input type="text" class="form-control " required name="txtnewsvideourl" id="txtnewsvideourl" value="<?php echo $res_ed['newsvideourl']; ?>" />
                  Add Embed Link 
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row fls-eat" id="videosurl" style="display:none;">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">News URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control " name="txtnewsurl" id="txtnewsurl" value="<?php echo $res_ed['newsurl']; ?>" />
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
                                <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmtWithImg('frmnews','news_actions.php','jvalidate','News','news_mng.php');"><?php echo $btn; ?></button>
                                        
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmnews','jvalidate','News','news_mng.php');">Cancel</button>
                                        
                           
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



function checkmediatype(id){
	alert(id)
	if(id=='1'){
		$("#photos").css('display', 'block');
		$("#videos").css('display', 'none');
		$("#videosurl").css('display', 'none');
	}else{
		$("#photos").css('display', 'none');
		$("#videos").css('display', 'block');
		$("#videosurl").css('display', 'block');
	}
}
jQuery(document).ready(function($){
	 
<?php if($res_ed['newsimage'] != '' && $act == 'update'){ ?>
    $("#photos").css('display', 'block');
		$("#videos").css('display', 'none');
		$("#videosurl").css('display', 'none');
<?php }else if($res_ed['newsvideourl']!='' && $act == 'update'){ ?>
    	$("#photos").css('display', 'none');
		$("#videos").css('display', 'block');
		$("#videosurl").css('display', 'block');
    
<?php }else{ ?>
    $("#photos").css('display', 'none');
    $("#videos").css('display', 'none');
    $("#videosurl").css('display', 'none');
<?php } ?>
    
});
/*
   jQuery(document).ready(function($){
<?php if((basename($_SERVER['PHP_SELF']) == 'news_form.php'   ) && $act == 'update'){ ?>       
  <?php if($res_ed['newsvideourl'] != ''){
    ?>
   $('#videos').show();
   $('#photos').hide();
  <?php }
  else{?>
   $('#videos').hide();
   $('#photos').show();
  
  <?php }?>
  <?php } else{?>
 	$('#photos').show();

	$('#videos').hide();

	<?php }?>
    });
    */
    /*$('input[name="chooses"]').on('ifChecked', function (event){
	 if(this.value == 1){
		$('#photos').show();
		
	    $('#videos').hide();
		$('#newsimage').addClass('jsrequired');	
		$('#txtvideourl').removeClass('jsrequired');	
	 }
	 else if(this.value == 2)
	 {
		$('#photos').hide();
		
	    $('#videos').show();	
		$('#txtvideourl').addClass('jsrequired');	
		$('#newsimage').removeClass('jsrequired');	
		
	 }
	 else
	 {
		$('#photos').hide();
	    $('#videos').hide();
		$('#newsimage').removeClass('jsrequired');
	
		$('#txtvideourl').removeClass('jsrequired');	
	 }
	});	*/
</script>
<!--  END FOOTER  -->