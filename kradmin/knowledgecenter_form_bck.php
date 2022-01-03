<?php 
$menudisp = "knowledgecenter";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeknowledgecenter($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END
$getsize = getimagesize_large($db,'knowledgecenter','large');
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


$str_ed = "select * from ".TPLPrefix."knowledgecenter where IsActive != ? and knowledgecenterid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));


$str_ed_es = "select * from ".TPLPrefix."knowledgecenter where IsActive != ? and parent_id = ? and lang_id = 2";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array(2,base64_decode($id)));


$str_ed_pt = "select * from ".TPLPrefix."knowledgecenter where IsActive != ? and parent_id = ? and lang_id = 3 ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array(2,base64_decode($id)));

$edit_id = $res_ed['knowledgecenterid'];
$edit_id_es = $res_ed_es['knowledgecenterid'];
$edit_id_pt = $res_ed_pt['knowledgecenterid'];
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
    <h3>Knowledge Center</h3>
    <div class="crumbs">
      <ul id="breadcrumbs" class="breadcrumb">
        <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
        <li><a href="#">Media</a></li>
        <li><a href="knowledgecenter_mng.php">Knowledge Center</a></li>
        <li class="active"><a href="#"><?php echo $operation; ?> Knowledge Center</a> </li>
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
          <h4><?php echo $operation; ?> Knowledge Center</h4>
        </div>
      </div>
    </div>
    <div class="widget-content widget-content-area">
      <div class="row">
        <div class="col-md-11 mx-auto">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs  mb-3 mt-3" id="iconTab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" id="generals" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="flaticon-user-11"></i> English</a> </li>
              <li class="nav-item"> <a class="nav-link"  data-toggle="tab" id="related" href="#spanishdiv" role="tab" aria-controls="spanishdiv" aria-selected="false"><i class="flaticon-map"></i> Spanish</a> </li>
              <li class="nav-item"> <a class="nav-link" id="suggested" data-toggle="tab" href="#portguesediv" role="tab" aria-controls="portguesediv" aria-selected="false"><i class="flaticon-menu-list"></i> Portuguese</a> </li>
            </ul>
            <div class="tab-content"> 
              
              <!--English - START -->
              <div class="tab-pane active" id="general">
                <div class="row box-body fillterbtn" id="" style="" >
                <div class="row">
                <div class="col-md-11 mx-auto">
                <form class="form-horizontal form-val-1" id="jvalidate" name="jvalidate" action="#" novalidate="">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Category <span class="required-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls"> <?php echo getSelectBox_categorysingle($db, 'categoryid', 'required',$res_ed['categoryid']) ;?>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Title <span class="required-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control" required name="txtknowledgecentertitle" id="txtknowledgecentertitle" value="<?php echo $res_ed['knowledgecentertitle']; ?>" />
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
                    <div class="col col-md-7">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                            <input type="text" placeholder="Date" name="txtknowledgecenterdate" id="txtknowledgecenterdate" value="<?php echo $res_ed['knowledgecenterdate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['knowledgecenterdate'])): date($GLOBALS['knowledgecenterdate']['phpformat']); ?>" readonly required>
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
                    <div class="col col-md-8">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control texteditor" required name="txtknowledgecenterdescription" id="txtknowledgecenterdescription" value="<?php echo $res_ed['knowledgecenterdescription']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
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
                  </div>
				  
                  <div class="row fls-eat">
                    <?php if(count($pdflists)=='0'){ ?>
                    <div class="row" id="row0">
                      <label class="col col-md-3 control-label mts-25">PDF File 1 </label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>PDF</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="qtitle0" id="qtitle0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_images investorpdf" id="q1pdffile0" name="q1pdffile0" type="file" accept="application/pdf"  ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options('');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count" id="option_count" value="1" />
                              <input type="hidden" name="option_max_count" id="option_max_count" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($pdflists as $pdfvalue){ ?>
                    <input type="hidden" name="option_edit_id<?php echo $j; ?>" id="option_edit_id<?php echo $j; ?>" value="<?php echo $pdfvalue['pdfid']; ?>" />
                    <div class="row" id="row_option<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>PDF</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="qtitle<?php echo $j; ?>" value="<?php echo $pdfvalue['title'];?>" id="qtitle<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_images " id="q1pdffile<?php echo $j; ?>" name="q1pdffile<?php echo $j; ?>" type="file" accept="application/pdf"  >
                              <?php if (!empty($pdfvalue['qid1']) && ($act == 'update')) {?>
                              <span id="d1<?php echo $j; ?>"> <a href="<?php echo IMG_BASE_URL;?>knowledgecenter/pdf/<?php echo $pdfvalue['qid1']; ?>"  target="_blank">View</a>&nbsp;/&nbsp;<a href="javascript:void(0)" onClick="deletepdf(<?php echo $pdfvalue['pdfid']; ?>,'d1<?php echo $j; ?>',1)">Delete</a></span>
                              <?php  }else{?>
                              &nbsp;
                              <?php }?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_pdf_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $pdfvalue['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options('');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count" id="option_count" value="<?php echo count($pdflists); ?>" />
                    <input type="hidden" name="option_max_count" id="option_max_count" value="<?php echo count($pdflists); ?>" />
                    <?php } ?>
                    <div id="option_div"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($urllist)=='0'){ ?>
                    <div class="row" id="rowurl0">
                      <label class="col col-md-3 control-label mts-25">URL</label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>URL</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="urltitle0" id="urltitle0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink0" name="urllink0" type="text"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options_url('');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_url" id="option_count_url" value="1" />
                              <input type="hidden" name="option_max_count_url" id="option_max_count_url" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($urllist as $urlvalue){ ?>
                    <input type="hidden" name="url_option_edit_id<?php echo $j; ?>" id="url_option_edit_id<?php echo $j; ?>" value="<?php echo $urlvalue['pdfid']; ?>" />
                    <div class="row" id="row_option_url<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>URL</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="urltitle<?php echo $j; ?>" value="<?php echo $urlvalue['title'];?>" id="urltitle<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink<?php echo $j; ?>" name="urllink<?php echo $j; ?>" type="text" value="<?php echo $urlvalue['urllink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_url_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $urlvalue['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options_url('');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_url" id="option_count_url" value="<?php echo count($urllist); ?>" />
                    <input type="hidden" name="option_max_count_url" id="option_max_count_url" value="<?php echo count($urllist); ?>" />
                    <?php } ?>
                    <div id="option_div_url"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($videolist)=='0'){ ?>
                    <div class="row" id="rowvideo0">
                      <label class="col col-md-3 control-label mts-25">Video Link </label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>Video</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="videotitle0" id="videotitle0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink0" name="videolink0" type="text"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options_video('');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_video" id="option_count_video" value="1" />
                              <input type="hidden" name="option_max_count_video" id="option_max_count_video" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($videolist as $videovalue){ ?>
                    <input type="hidden" name="video_option_edit_id<?php echo $j; ?>" id="video_option_edit_id<?php echo $j; ?>" value="<?php echo $videovalue['pdfid']; ?>" />
                    <div class="row" id="row_option_video<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>Video</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="videotitle<?php echo $j; ?>" value="<?php echo $videovalue['title'];?>" id="videotitle<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink<?php echo $j; ?>" name="videolink<?php echo $j; ?>" type="text" value="<?php echo $videovalue['videolink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_video_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $videovalue['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options_video('');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_video" id="option_count_video" value="<?php echo count($videolist); ?>" />
                    <input type="hidden" name="option_max_count_video" id="option_max_count_video" value="<?php echo count($videolist); ?>" />
                    <?php } ?>
                    <div id="option_div_video"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <div class="col col-md-3" >
                      <div class="control-group mb-4">
                        <label class="control-label">Photo <span class="required-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <?php if (empty($res_ed['knowledgecenterimage']) && ($act == 'update')) {
                                $req_pt=' required ';
                                }else if($act != 'update'){
                                 $req_pt=' required ';
                                }else{
                                $req_pt='  ';
                                } ?>
                          <input type="file" class="common_upload_style" <?php echo $req_pt; ?> name="knowledgecenterimage" id="knowledgecenterimage"/>
                          <p class="help-block"></p>
                        </div>
                        <div class="col-md-1">
                          <?php  if (!empty($res_ed['knowledgecenterimage']) && ($act == 'update')) { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>knowledgecenter/<?php echo $res_ed['knowledgecenterimage']; ?>" width="250"  height="250" align="absmiddle"/> </span> </div>
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
                          <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onclick="return formvalidationcat(1)">Next</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              
              <!--Spanish - START -->
              <div class="tab-pane" id="spanishdiv">
                <form class="form-horizontal form-val-1" id="esformcat" name="esformcat" action="#" novalidate="">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?> "  />
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Title <span class="required-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control" required name="txtknowledgecentertitle_es" id="txtknowledgecentertitle_es" value="<?php echo $res_ed_es['knowledgecentertitle']; ?>" />
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
                    <div class="col col-md-8">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control texteditor" required name="txtknowledgecenterdescription_es" id="txtknowledgecenterdescription_es" value="<?php echo $res_ed_es['knowledgecenterdescription']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($pdflistses)=='0'){ ?>
                    <div class="row" id="rowes0">
                      <label class="col col-md-3 control-label mts-25">PDF File 1 </label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>PDF</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="qtitle_es0" id="qtitle_es0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_images investorpdf" id="q1pdffile_es0" name="q1pdffile_es0" type="file" accept="application/pdf"  ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options('_es');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_es" id="option_count_es" value="1" />
                              <input type="hidden" name="option_max_count_es" id="option_max_count_es" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($pdflistses as $pdfvaluees){ ?>
                    <input type="hidden" name="option_edit_id_es<?php echo $j; ?>" id="option_edit_id_es<?php echo $j; ?>" value="<?php echo $pdfvaluees['pdfid']; ?>" />
                    <div class="row" id="row_option_es<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>PDF</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="qtitle_es<?php echo $j; ?>" value="<?php echo $pdfvaluees['title'];?>" id="qtitle_es<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_images " id="q1pdffile_es<?php echo $j; ?>" name="q1pdffile_es<?php echo $j; ?>" type="file" accept="application/pdf"  >
                              <?php if (!empty($pdfvaluees['qid1']) && ($act == 'update')) {?>
                              <span id="d1_es<?php echo $j; ?>"> <a href="<?php echo IMG_BASE_URL;?>knowledgecenter/pdf/<?php echo $pdfvaluees['qid1']; ?>"  target="_blank">View</a>&nbsp;/&nbsp;<a href="javascript:void(0)" onClick="deletepdf(<?php echo $pdfvaluees['pdfid']; ?>,'d1_es<?php echo $j; ?>',1)">Delete</a></span>
                              <?php  }else{?>
                              &nbsp;
                              <?php }?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_pdf_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $pdfvaluees['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options('_es');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_es" id="option_count_es" value="<?php echo count($pdflistses); ?>" />
                    <input type="hidden" name="option_max_count_es" id="option_max_count_es" value="<?php echo count($pdflistses); ?>" />
                    <?php } ?>
                    <div id="option_div_es"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($urllistes)=='0'){ ?>
                    <div class="row" id="rowurl_es0">
                      <label class="col col-md-3 control-label mts-25">URL</label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>URL</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="urltitle_es0" id="urltitle_es0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink_es0" name="urllink_es0" type="text"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options_url('_es');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_url_es" id="option_count_url_es" value="1" />
                              <input type="hidden" name="option_max_count_url_es" id="option_max_count_url_es" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($urllistes as $urlvaluees){ ?>
                    <input type="hidden" name="url_option_edit_id_es<?php echo $j; ?>" id="url_option_edit_id_es<?php echo $j; ?>" value="<?php echo $urlvalue_es['pdfid']; ?>" />
                    <div class="row" id="row_option_url_es<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>URL</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="urltitle_es<?php echo $j; ?>" value="<?php echo $urlvaluees['title'];?>" id="urltitle_es<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink_es<?php echo $j; ?>" name="urllink_es<?php echo $j; ?>" type="text" value="<?php echo $urlvaluees['urllink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_url_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $urlvaluees['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options_url('_es');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_url_es" id="option_count_url_es" value="<?php echo count($urllistes); ?>" />
                    <input type="hidden" name="option_max_count_url_es" id="option_max_count_url_es" value="<?php echo count($urllistes); ?>" />
                    <?php } ?>
                    <div id="option_div_url_es"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($videolistes)=='0'){ ?>
                    <div class="row" id="rowvideo_es0">
                      <label class="col col-md-3 control-label mts-25">Video Link </label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>Video</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="videotitle_es0" id="videotitle_es0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink_es0" name="videolink_es0" type="text"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options_video('_es');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_video_es" id="option_count_video_es" value="1" />
                              <input type="hidden" name="option_max_count_video_es" id="option_max_count_video_es" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($videolist_es as $videovaluees){ ?>
                    <input type="hidden" name="video_option_edit_id_es<?php echo $j; ?>" id="video_option_edit_id_es<?php echo $j; ?>" value="<?php echo $videovaluees['pdfid']; ?>" />
                    <div class="row" id="row_option_video_es<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>Video</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="videotitle_es<?php echo $j; ?>" value="<?php echo $videovaluees['title'];?>" id="videotitle_es<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink_es<?php echo $j; ?>" name="videolink<?php echo $j; ?>" type="text" value="<?php echo $videovalue_es['videolink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_video_optiones('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $videovaluees['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options_video('_es');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_video_es" id="option_count_video_es" value="<?php echo count($videolistes); ?>" />
                    <input type="hidden" name="option_max_count_video_es" id="option_max_count_video_es" value="<?php echo count($videolistes); ?>" />
                    <?php } ?>
                    <div id="option_div_video_es"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div style="clear:both">&nbsp;</div>
                  <div class="row">
                    <div class="col col-md-3">
                      <div class="control-group mb-4"> &nbsp; </div>
                    </div>
                    <div class="col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onclick="return formvalidationcat(2)">Next</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              
              <!--Portuguese - START -->
              <div class="tab-pane" id="portguesediv">
                <form class="form-horizontal form-val-1" id="ptformcat" name="ptformcat" action="#" novalidate="">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?> "  />
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Title <span class="required-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control" required name="txtknowledgecentertitle_pt" id="txtknowledgecentertitle_pt" value="<?php echo $res_ed_pt['knowledgecentertitle']; ?>" />
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
                    <div class="col col-md-8">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control texteditor" required name="txtknowledgecenterdescription_pt" id="txtknowledgecenterdescription_pt" value="<?php echo $res_ed_pt['knowledgecenterdescription']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($pdflistspt)=='0'){ ?>
                    <div class="row" id="row_pt0">
                      <label class="col col-md-3 control-label mts-25">PDF File 1 </label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>PDF</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="qtitle_pt0" id="qtitle_pt0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_imagpt invpttorpdf" id="q1pdffile_pt0" name="q1pdffile_pt0" type="file" accept="application/pdf"  ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options('_pt');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_pt" id="option_count_pt" value="1" />
                              <input type="hidden" name="option_max_count_pt" id="option_max_count_pt" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($pdflistspt as $pdfvaluept){ ?>
                    <input type="hidden" name="option_edit_id_pt<?php echo $j; ?>" id="option_edit_id_pt<?php echo $j; ?>" value="<?php echo $pdfvaluept['pdfid']; ?>" />
                    <div class="row" id="row_option_pt<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>PDF</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="qtitle_pt<?php echo $j; ?>" value="<?php echo $pdfvaluept['title'];?>" id="qtitle_pt<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_imagpt " id="q1pdffile_pt<?php echo $j; ?>" name="q1pdffile_pt<?php echo $j; ?>" type="file" accept="application/pdf"  >
                              <?php if (!empty($pdfvaluept['qid1']) && ($act == 'update')) {?>
                              <span id="d1_pt<?php echo $j; ?>"> <a href="<?php echo IMG_BASE_URL;?>knowledgecenter/pdf/<?php echo $pdfvaluept['qid1']; ?>"  target="_blank">View</a>&nbsp;/&nbsp;<a href="javascript:void(0)" onClick="deletepdf(<?php echo $pdfvaluept['pdfid']; ?>,'d1_pt<?php echo $j; ?>',1)">Delete</a></span>
                              <?php  }else{?>
                              &nbsp;
                              <?php }?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_pdf_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $pdfvaluept['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options('_pt');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_pt" id="option_count_pt" value="<?php echo count($pdflistspt); ?>" />
                    <input type="hidden" name="option_max_count_pt" id="option_max_count_pt" value="<?php echo count($pdflistspt); ?>" />
                    <?php } ?>
                    <div id="option_div_pt"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($urllistpt)=='0'){ ?>
                    <div class="row" id="rowurl_pt0">
                      <label class="col col-md-3 control-label mts-25">URL</label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>URL</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="urltitle_pt0" id="urltitle_pt0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink_pt0" name="urllink_pt0" type="text"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options_url('_pt');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_url_pt" id="option_count_url_pt" value="1" />
                              <input type="hidden" name="option_max_count_url_pt" id="option_max_count_url_pt" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($urllistpt as $urlvaluept){ ?>
                    <input type="hidden" name="url_option_edit_id_pt<?php echo $j; ?>" id="url_option_edit_id_pt<?php echo $j; ?>" value="<?php echo $urlvaluept['pdfid']; ?>" />
                    <div class="row" id="row_option_url_pt<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>URL</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="urltitle_pt<?php echo $j; ?>" value="<?php echo $urlvaluept['title'];?>" id="urltitle_pt<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink_pt<?php echo $j; ?>" name="urllink_pt<?php echo $j; ?>" type="text" value="<?php echo $urlvaluept['urllink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_url_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $urlvaluept['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
	                              <a href="javascript:void(0);" onClick="add_options_url('_pt');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_url_pt" id="option_count_url_pt" value="<?php echo count($urllistpt); ?>" />
                    <input type="hidden" name="option_max_count_url_pt" id="option_max_count_url_pt" value="<?php echo count($urllistpt); ?>" />
                    <?php } ?>
                    <div id="option_div_url_pt"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <?php if(count($videolistpt)=='0'){ ?>
                    <div class="row" id="rowvideo_pt0">
                      <label class="col col-md-3 control-label mts-25">Video Link </label>
                      <div class="col-md-9 mbs-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>Video</td>
                          </tr>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="videotitle_pt0" id="videotitle_pt0" class="form-control"></td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink_pt0" name="videolink_pt0" type="text"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options_video('_pt');" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count_video_pt" id="option_count_video_pt" value="1" />
                              <input type="hidden" name="option_max_count_video_pt" id="option_max_count_video_pt" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
								$j=0;$k=1;
								foreach($videolistpt as $videovaluept){ ?>
                    <input type="hidden" name="video_option_edit_id_pt<?php echo $j; ?>" id="video_option_edit_id_pt<?php echo $j; ?>" value="<?php echo $videovaluept['pdfid']; ?>" />
                    <div class="row" id="row_option_video_pt<?php echo $j; ?>">
                      <label class="col-md-3 control-label">File <?php echo $k; ?> </label>
                      <div class="col-md-9">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <?php if($j == 0){?>
                          <tr>
                            <td>Title</td>
                            <td>&nbsp;</td>
                            <td>Video</td>
                          </tr>
                          <?php }?>
                          <tr>
                            <td><input type="text" Placeholder="Title" name="videotitle_pt<?php echo $j; ?>" value="<?php echo $videovaluept['title'];?>" id="videotitle_pt<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink_pt<?php echo $j; ?>" name="videolink_pt<?php echo $j; ?>" type="text" value="<?php echo $videovaluept['videolink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_video_optionpt('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $videovaluept['pdfid']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options_video('_pt');" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php 
											$j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count_video_pt" id="option_count_video_pt" value="<?php echo count($videolistpt); ?>" />
                    <input type="hidden" name="option_max_count_video_pt" id="option_max_count_video_pt" value="<?php echo count($videolistpt); ?>" />
                    <?php } ?>
                    <div id="option_div_video_pt"> </div>
                    <div>&nbsp;</div>
                  </div>
                  <div class="row fls-eat">
                    <div class="col col-md-3">
                      <div class="control-group mb-4"> &nbsp; </div>
                    </div>
                    <div class="col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmtWithImgnew('frmknowledgecenter','knowledgecenter_actions.php','jvalidate','knowledgecenter','knowledgecenter_mng.php');"><?php echo $btn; ?></button>
                          <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmknowledgecenter','jvalidate','knowledgecenter','knowledgecenter_mng.php');">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box --> 
              
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

<script type="text/javascript">
function funSubmtWithImgnew($frm, $urll, $acts, $stats, $lodlnk) {
        
         if ($('#' + $acts).valid()) {
        
            var m_data = new FormData();

            var formdatas = $("#" + $acts+',#esformcat,#ptformcat').serializeArray();

            $.each(formdatas, function(key, value) {
                m_data.append(value.name, value.value);
            });
						     
		 	//q1pdffile
					 var fileInput2 = document.getElementById("option_max_count").value;
					 
					 
					 
					 for(i=0;i<=fileInput2;i++) {		
					 alert($('input[name=q1pdffile'+i+']')[0].files[0]);
						 m_data.append( 'q1pdffile'+i, $('input[name=q1pdffile'+i+']')[0].files[0]);	
					 }
					 
					 var fileInput3 = document.getElementById("option_max_count_es").value;
					 for(j=0;j<=fileInput3;j++) {		
						 m_data.append( 'q1pdffile_es'+j, $('input[name=q1pdffile_es'+j+']')[0].files[0]);
					 }
					 
					 var fileInput4 = document.getElementById("option_max_count_pt").value;
					 for(k=0;k<=fileInput4;k++) {		
						 m_data.append( 'q1pdffile_pt'+k, $('input[name=q1pdffile_pt'+k+']')[0].files[0]);	
					 }
			 		
            $.ajax({
                url: $urll,
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: m_data,
                beforeSend: function() {
				  // loading();
                },
                success: function(response) {
						// $('button').removeAttr("disabled");
                    if (response.rslt == "1") {
						
						 toast({type: 'success',title:$stats + ' ' + sucmsg,padding: '1em'});
                         $("#" + $acts)[0].reset();

                        setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 1200);
                    } 
					else if (response.rslt == "2") {
						 toast({type: 'success',title:$stats + ' ' + upmsg,padding: '1em'});
						 $("#" + $acts)[0].reset();
						 
                         setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 1200);
                    }                                        
                    else if (response.rslt == "3") {
						 toast({type: 'warning',title:exsmsg,padding: '1em'});
                    }
					else if (response.rslt == "4") {
                        toast({type: 'warning',title:$stats + ' ' + reqmsg,padding: '1em'});						
                    } 
					else if (response.rslt == '7') {
                         toast({type: 'warning',title:exsmsg_refstats,padding: '1em'});
                    }
					else if (response.rslt == '17') {
                         toast({type: 'warning',title:"Image field required",padding: '1em'});
                    }
					else if (response.rslt == "8") {
                        toast({type: 'warning',title:$stats + ' ' + response.msg,padding: '1em'});
                    } 
					else if (response.rslt == "9") {
                        $("#bulk_upload_result").css({
                            "background-color": "#FFC0C0",
                            "color": "#800000"
                        });
                        $("#bulk_upload_result").show();
                        $("#bulk_upload_result").empty();
                        $("#bulk_upload_result").append("<br><h4><b>&nbspUpload Summary : Error List</b></h4><br>");
						
                        $("#bulk_upload_result").append(response.all_error + "<br>");
                    }
					else if (response.rslt == "11") {
						 toast({type: 'warning',title:".xls is the only allowed file format.",padding: '1em'});
                    }
					else {
                        toast({type: 'warning',title:othmsg,padding: '1em'});
                    }

                    if (response.rslt != "1" && response.rslt != "2") {
					
				//	unloading();
					}
                 
				//  $("button").attr('disabled',false); 

                }
            });
        }
    }
	
	
function add_options(optionfor){
	 var j = $('#option_count'+optionfor).val();
		var k = (parseInt(j) + parseInt(1));
		if(j <= 3) {
			
			
			$('#option_div'+optionfor).append('<div class="row" id="row_option'+optionfor+j+'"><label class="col-md-3 control-label">PDF '+k+' </label><div class="col-md-9 mbs-9"><table border="0" cellpadding="10" cellspacing="10"><tr><td><input type="text" Placeholder="Title" name="qtitle'+optionfor+j+'" id="qtitle'+optionfor+j+'" class="form-control"></td><td>&nbsp;</td><td><input class="form-control product_images investorpdf" id="q1pdffile'+optionfor+j+'" name="q1pdffile'+optionfor+j+'" type="file" accept="application/pdf"  ></td> <td>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <a href="javascript:void(0);" onclick="remove_row_option(' + j + ',\''+optionfor+'\');"><span class="addthis tr"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a> </td></tr></table></div></div>');
			
			j++; 
			$('#option_count'+optionfor).val(j);
			$('#option_max_count'+optionfor).val(j);
		} 
}


 

function remove_row_option(button_id,optionfor){
 	$('#row_option'+optionfor+button_id + '').remove();
		var jj = $('#option_count'+optionfor).val();
		jj--;
		$('#option_count'+optionfor).val(jj);
}

 

function deletepdf(pdfid,divid,rid){
	$.confirm({
				title: 'Are you sure?',
				content:"You want to delete the pdf?",
				type:"orange",
				btnClass: "btn-orange",				
				buttons: {
 					tryAgain: {
					text: 'Yes, delete it!',
					btnClass: 'btn-orange',
					action: function(){
						
						var urls ="investors_actions.php?action=remove_row_pdf";
				 		var m_data = 'pdfid='+pdfid+'&rid='+rid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  if(response.rslt == 6){
 							$('#'+divid).hide();
						
							swal("Success!", 'File Deleted Successfully', "success");
					  }else{
						  swal("Failure!", 'File could not be deleted', "warning");
					  }
							unloading();
					  }
					});
					}
				}, 
				cancel: function () {
				   // $.alert('Canceled!');
				}
				}
				});
				
} 


<!-- url-->
function add_options_url(optionfor){
	 var j = $('#option_count_url'+optionfor).val();
		var k = (parseInt(j) + parseInt(1));
		if(j <= 3) {
			
			
			$('#option_div_url'+optionfor).append('<div class="row" id="row_option_url'+optionfor+j+'"><label class="col-md-3 control-label">URL '+k+' </label><div class="col-md-9 mbs-9"><table border="0" cellpadding="10" cellspacing="10"><tr><td><input type="text" Placeholder="Title" name="urltitle'+j+'" id="urltitle'+j+'" class="form-control"></td><td>&nbsp;</td><td><input class="form-control" id="urllink'+optionfor+j+'" name="urllink'+optionfor+j+'" type="text"   ></td> <td>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <a href="javascript:void(0);" onclick="remove_row_option_url(' + j + ',\''+optionfor+'\');"><span class="addthis tr"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a> </td></tr></table></div></div>');
			
			j++; 
			$('#option_count_url'+optionfor).val(j);
			$('#option_max_count_url'+optionfor).val(j);
		} 
}

function remove_row_option_url(button_id,optionfor){
 	$('#row_option_url'+optionfor+button_id+'').remove();
		var jj = $('#option_count_url'+optionfor).val();
		jj--;
		$('#option_count_url'+optionfor).val(jj);
}



<!--end-->


<!-- video list -->

function add_options_video(optionfor){
	 var j = $('#option_count_video'+optionfor).val();
		var k = (parseInt(j) + parseInt(1));
		if(j <= 3) {
			
			
			$('#option_div_video'+optionfor).append('<div class="row" id="row_option_video'+optionfor+j+'"><label class="col-md-3 control-label">Video '+k+' </label><div class="col-md-9 mbs-9"><table border="0" cellpadding="10" cellspacing="10"><tr><td><input type="text" Placeholder="Title" name="videotitle'+optionfor+j+'" id="videotitle'+optionfor+j+'" class="form-control"></td><td>&nbsp;</td><td><input class="form-control" id="videolink'+optionfor+j+'" name="videolink'+optionfor+j+'" type="text"   ></td> <td>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <a href="javascript:void(0);" onclick="remove_row_option_video(' + j + ',\''+optionfor+'\');"><span class="addthis tr"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a> </td></tr></table></div></div>');
			
			j++; 
			$('#option_count_video'+optionfor).val(j);
			$('#option_max_count_video'+optionfor).val(j);
		} 
}

function remove_row_option_video(button_id,optionfor){
 	$('#row_option_video'+optionfor+button_id+'').remove();
		var jj = $('#option_count_video'+optionfor).val();
		jj--;
		$('#option_count_video'+optionfor).val(jj);
}

function formvalidationcat(formid){
//	$('#esformcat').valid() && $('#ptformcat').valid();
	
	if(formid == 1){
		if($('#jvalidate').valid()){
		$('#related').trigger('click');
		$('#esformcat').valid();
		}
	}else if(formid == 2){
		if($('#esformcat').valid()){
		$('#suggested').trigger('click');
		$('#ptformcat').valid();
		}else{ return false;
		}
	}
}
<!--  END FOOTER  -->
</script>
<?php include('includes/footer.php');?>
