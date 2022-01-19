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
$getsize = getimagesize_large($db,'knowledgecenter','knowledgecenter');
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

$pdflists = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_pdf where knowledgecenterid = '".$edit_id."' and IsActive = 1 ");
$pdflistses = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_pdf where knowledgecenterid = '".$edit_id_es."' and IsActive = 1 ");
$pdflistspt = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_pdf where knowledgecenterid = '".$edit_id_pt."' and IsActive = 1 ");

$urllist = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_url where knowledgecenterid = '".$edit_id."' and IsActive = 1 ");
$urllistes = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_url where knowledgecenterid = '".$edit_id_es."' and IsActive = 1 ");
$urllistpt = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_url where knowledgecenterid = '".$edit_id_pt."' and IsActive = 1 ");

$videolist = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_video where knowledgecenterid = '".$edit_id."' and IsActive = 1 ");
$videolistes = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_video where knowledgecenterid = '".$edit_id_es."' and IsActive = 1 ");
$videolistpt = $db->get_rsltset("select * from ".TPLPrefix."knowledgecenter_video where knowledgecenterid = '".$edit_id_pt."' and IsActive = 1 ");
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
                        <label class="control-label">Category <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls"> <?php echo getSelectBox_knowledgecategory($db, 'categoryid', '',$res_ed['categoryid']) ;?>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Title <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control"  name="txtknowledgecentertitle" id="txtknowledgecentertitle" value="<?php echo $res_ed['knowledgecentertitle']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Date <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-7">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                            <input type="text" placeholder="Date" name="txtknowledgecenterdate" id="txtknowledgecenterdate" value="<?php echo $res_ed['knowledgecenterdate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['knowledgecenterdate'])): date($GLOBALS['knowledgecenterdate']['phpformat']); ?>" readonly >
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
                        <label class="control-label">Description <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-8">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <textarea  class="form-control texteditor"  name="txtknowledgecenterdescription" id="txtknowledgecenterdescription" ><?php echo $res_ed['knowledgecenterdescription']; ?></textarea>
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
                            <td><input type="text" Placeholder="Title" name="qtitle<?php echo $j; ?>" value="<?php echo $pdfvalue['pdftitle'];?>" id="qtitle<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_images " id="q1pdffile<?php echo $j; ?>" name="q1pdffile<?php echo $j; ?>" type="file" accept="application/pdf"  >
                              <?php if (!empty($pdfvalue['pdffile']) && ($act == 'update')) {?>
                              <span id="d1<?php echo $j; ?>"> <a href="<?php echo IMG_BASE_URL;?>knowledgecenter/pdf/<?php echo $pdfvalue['pdffile']; ?>"  target="_blank">View</a>&nbsp;/&nbsp;<a href="javascript:void(0)" onClick="deletepdf(<?php echo $pdfvalue['pdfid']; ?>,'d1<?php echo $j; ?>',1)">Delete</a></span>
                              <?php  }else{?>
                              &nbsp;
                              <?php }?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_pdf_option('<?php echo $j; ?>','<?php echo $pdfvalue['pdfid']; ?>','');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  }else{ ?>
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
                    <input type="hidden" name="url_option_edit_id<?php echo $j; ?>" id="url_option_edit_id<?php echo $j; ?>" value="<?php echo $urlvalue['urlid']; ?>" />
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
                            <td><input type="text" Placeholder="Title" name="urltitle<?php echo $j; ?>" value="<?php echo $urlvalue['urltitle'];?>" id="urltitle<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink<?php echo $j; ?>" name="urllink<?php echo $j; ?>" type="text" value="<?php echo $urlvalue['urllink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_url_option('<?php echo $j; ?>','<?php echo $urlvalue['urlid']; ?>','');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
                    <input type="hidden" name="video_option_edit_id<?php echo $j; ?>" id="video_option_edit_id<?php echo $j; ?>" value="<?php echo $videovalue['videoid']; ?>" />
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
                            <td><input type="text" Placeholder="Title" name="videotitle<?php echo $j; ?>" value="<?php echo $videovalue['videotitle'];?>" id="videotitle<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink<?php echo $j; ?>" name="videolink<?php echo $j; ?>" type="text" value="<?php echo $videovalue['videolink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);"onClick="remove_video_option('<?php echo $j; ?>','<?php echo $videovalue['videoid']; ?>','');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
                        <label class="control-label">Photo <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <?php if (empty($res_ed['knowledgecenterimage']) && ($act == 'update')) {
                                $req_pt='  ';
                                }else if($act != 'update'){
                                 $req_pt='  ';
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
                        <label class="control-label">Status <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-success">
                              <input type="checkbox"  class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
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
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                  <input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?> "  />
                   <input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?> "  />
                  <div class="row">
                    <div class="col col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Title <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control"  name="txtknowledgecentertitle_es" id="txtknowledgecentertitle_es" value="<?php echo $res_ed_es['knowledgecentertitle']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Description <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-8">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <textarea class="form-control texteditor"  name="txtknowledgecenterdescription_es" id="txtknowledgecenterdescription_es" ><?php echo $res_ed_es['knowledgecenterdescription']; ?></textarea>
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
                            <td><input type="text" Placeholder="Title" name="qtitle_es<?php echo $j; ?>" value="<?php echo $pdfvaluees['pdftitle'];?>" id="qtitle_es<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_images " id="q1pdffile_es<?php echo $j; ?>" name="q1pdffile_es<?php echo $j; ?>" type="file" accept="application/pdf"  >
                              <?php if (!empty($pdfvaluees['pdffile']) && ($act == 'update')) {?>
                              <span id="d1_es<?php echo $j; ?>"> <a href="<?php echo IMG_BASE_URL;?>knowledgecenter/pdf/<?php echo $pdfvaluees['pdffile']; ?>"  target="_blank">View</a>&nbsp;/&nbsp;<a href="javascript:void(0)" onClick="deletepdf(<?php echo $pdfvaluees['pdfid']; ?>,'d1_es<?php echo $j; ?>',1)">Delete</a></span>
                              <?php  }else{?>
                              &nbsp;
                              <?php }?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_pdf_option('<?php echo $j; ?>','<?php echo $pdfvaluees['pdfid']; ?>','_es');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
                    <input type="hidden" name="url_option_edit_id_es<?php echo $j; ?>" id="url_option_edit_id_es<?php echo $j; ?>" value="<?php echo $urlvaluees['urlid']; ?>" />
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
                            <td><input type="text" Placeholder="Title" name="urltitle_es<?php echo $j; ?>" value="<?php echo $urlvaluees['urltitle'];?>" id="urltitle_es<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink_es<?php echo $j; ?>" name="urllink_es<?php echo $j; ?>" type="text" value="<?php echo $urlvaluees['urllink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_url_option('<?php echo $j; ?>','<?php echo $urlvaluees['urlid']; ?>','_es');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
								foreach($videolistes as $videovaluees){ ?>
                    <input type="hidden" name="video_option_edit_id_es<?php echo $j; ?>" id="video_option_edit_id_es<?php echo $j; ?>" value="<?php echo $videovaluees['videoid']; ?>" />
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
                            <td><input type="text" Placeholder="Title" name="videotitle_es<?php echo $j; ?>" value="<?php echo $videovaluees['videotitle'];?>" id="videotitle_es<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink_es<?php echo $j; ?>" name="videolink_es<?php echo $j; ?>" type="text" value="<?php echo $videovaluees['videolink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_video_option('<?php echo $j; ?>','<?php echo $videovaluees['videoid']; ?>','_es');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
                        <label class="control-label">Title <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col col-md-6">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <input type="text" class="form-control"  name="txtknowledgecentertitle_pt" id="txtknowledgecentertitle_pt" value="<?php echo $res_ed_pt['knowledgecentertitle']; ?>" />
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-3">
                      <div class="control-group mb-4">
                        <label class="control-label">Description <span class="-class">* </span></label>
                      </div>
                    </div>
                    <div class="col col-md-8">
                      <div class="control-group mb-4">
                        <div class="controls">
                          <textarea class="form-control texteditor"  name="txtknowledgecenterdescription_pt" id="txtknowledgecenterdescription_pt" ><?php echo $res_ed_pt['knowledgecenterdescription']; ?></textarea>
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
                            <td><input type="text" Placeholder="Title" name="qtitle_pt<?php echo $j; ?>" value="<?php echo $pdfvaluept['pdftitle'];?>" id="qtitle_pt<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control product_imagpt " id="q1pdffile_pt<?php echo $j; ?>" name="q1pdffile_pt<?php echo $j; ?>" type="file" accept="application/pdf"  >
                              <?php if (!empty($pdfvaluept['pdffile']) && ($act == 'update')) {?>
                              <span id="d1_pt<?php echo $j; ?>"> <a href="<?php echo IMG_BASE_URL;?>knowledgecenter/pdf/<?php echo $pdfvaluept['pdffile']; ?>"  target="_blank">View</a>&nbsp;/&nbsp;<a href="javascript:void(0)" onClick="deletepdf(<?php echo $pdfvaluept['pdfid']; ?>,'d1_pt<?php echo $j; ?>',1)">Delete</a></span>
                              <?php  }else{?>
                              &nbsp;
                              <?php }?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_pdf_option('<?php echo $j; ?>','<?php echo $pdfvaluept['pdfid']; ?>','_pt');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
                    <input type="hidden" name="url_option_edit_id_pt<?php echo $j; ?>" id="url_option_edit_id_pt<?php echo $j; ?>" value="<?php echo $urlvaluept['urlid']; ?>" />
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
                            <td><input type="text" Placeholder="Title" name="urltitle_pt<?php echo $j; ?>" value="<?php echo $urlvaluept['urltitle'];?>" id="urltitle_pt<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="urllink_pt<?php echo $j; ?>" name="urllink_pt<?php echo $j; ?>" type="text" value="<?php echo $urlvaluept['urllink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_url_option('<?php echo $j; ?>','<?php echo $urlvaluept['urlid']; ?>','_pt');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
                    <input type="hidden" name="video_option_edit_id_pt<?php echo $j; ?>" id="video_option_edit_id_pt<?php echo $j; ?>" value="<?php echo $videovaluept['videoid']; ?>" />
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
                            <td><input type="text" Placeholder="Title" name="videotitle_pt<?php echo $j; ?>" value="<?php echo $videovaluept['videotitle'];?>" id="videotitle_pt<?php echo $j; ?>" class="form-control">
                              &nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input class="form-control" id="videolink_pt<?php echo $j; ?>" name="videolink_pt<?php echo $j; ?>" type="text" value="<?php echo $videovaluept['videolink'];?>"   ></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_video_option('<?php echo $j; ?>','<?php echo $videovaluept['videoid']; ?>','_pt');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
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
               
				/*if(value.name == 'txtknowledgecenterdescription' || value.name == 'txtknowledgecenterdescription_es' || value.name == 'txtknowledgecenterdescription_pt' ){
					var newval = $('#'+value.name).summernote('code');
				 m_data.append(value.name, newval);
				 
				}else{*/ m_data.append(value.name, value.value);
					
				//}
            });
						     
							  m_data.append( 'knowledgecenterimage', $('input[name=knowledgecenterimage]')[0].files[0]);	
							  
			 var fileInput2 = document.getElementById("option_max_count").value;
			 
			 for(i=0;i<fileInput2;i++) {		
				 m_data.append( 'q1pdffile'+i, $('input[name=q1pdffile'+i+']')[0].files[0]);	
			 }
			 
			 var fileInput3 = document.getElementById("option_max_count_es").value;
			 for(j=0;j<fileInput3;j++) {		
				 m_data.append( 'q1pdffile_es'+j, $('input[name=q1pdffile_es'+j+']')[0].files[0]);
			 }
			 
			 var fileInput4 = document.getElementById("option_max_count_pt").value;
			 for(k=0;k<fileInput4;k++) {		
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
                         toast({type: 'warning',title:"Image field ",padding: '1em'});
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

 

function remove_video_option(rowid,videoid,rowfor){
	
	 swal({
			title: 'Are you sure?',
			text: "You want to delete the video?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, delete it!",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {			
		
		
	 
						
						var urls ="knowledgecenter_actions.php?action=remove_row_video";
				 		var m_data = 'videoid='+videoid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					   
 							$('#row_option_video'+rowfor+rowid).hide();
						
							swal("Success!", 'File Deleted Successfully', "success");
					 
							unloading();
					  }
					});
					}

            });
    }


function remove_pdf_option(rowid,pdfid,rowfor){
	 swal({
			title: 'Are you sure?',
			text: "You want to delete the pdf?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, delete it!",
			padding: '0.5em'
     	 }).then(function(result) {
         if (result.value) {			
					var urls ="knowledgecenter_actions.php?action=remove_row_pdf";
				 	var m_data = 'pdfid='+pdfid;
					
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					   
 							$('#row_option'+rowfor+rowid).hide();
							swal("Success!", 'File Deleted Successfully', "success");
					   
							unloading();
					  }
					});
					}

            });
    }
	
	function remove_url_option(rowid,pdfid,rowfor){
	 swal({
			title: 'Are you sure?',
			text: "You want to delete the pdf?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes, delete it!",
			padding: '0.5em'
     	 }).then(function(result) {
         if (result.value) {			
					var urls ="knowledgecenter_actions.php?action=remove_row_url";
				 	var m_data = 'urlid='+pdfid;
					
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					   
 							$('#row_option_url'+rowfor+rowid).hide();
							swal("Success!", 'Row Deleted Successfully', "success");
					  
							unloading();
					  }
					});
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
