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
$view = $_REQUEST['id'];
$countgetimages = $db->get_var("select count(*) from kr_eventsimage where eventid='".$view."'");
$countgetimages_es = $db->get_var("select count(*) from kr_eventsimage where eventid='".$view."' and lang_id = 2");
$countgetimages_pt = $db->get_var("select count(*) from kr_eventsimage where eventid='".$view."' and lang_id = 3");

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
              <li><a href="events_mng.php">Eevents More Images</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Eevents More Images</a> </li>
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
                  <h4><?php echo $operation; ?> Eevents More Images</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form id="jvalidate" name="frmEevents" role="form" class="form-horizontal" action="#" method="post" enctype='multipart/form-data' >
				   <input type="hidden" name="action" value="moreimage" />
                    <input type="hidden" name="edit_id" value="<?php echo $view; ?> "  />
                   
                    <!--<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Images  </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input class="product_images " id="eventsimages" fi-limit="5"  name="eventsimages[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small>
                        </div>
                      </div>
                    </div>-->
                    
                    <div class="row">
                          <label class="col-sm-3 control-label">Images<span class="reqfield">*</span></label>
                          <div class="col-sm-9 mb-4">
                            <div class="form-upload product_img">
                              <div class="dropzone" id="dropzone">
                                <input class="product_images" id="eventsimages" name="eventsimages[]" type="file" fi-type="" multiple="multiple" >
                              </div>
                              <small >Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small> </div>
                            <div class="form-upload" id="uploadedProducts"> </div>
                          </div>
                        </div>

                        <div class="row">
                          <label class="col-sm-3 control-label"><?php echo Spanish; ?> Images<span class="reqfield">*</span></label>
                          <div class="col-sm-9 mb-4">
                            <div class="form-upload product_img">
                              <div class="dropzone" id="dropzone">
                                <input class="product_images" id="eventsimages_es" name="eventsimages_es[]" type="file" fi-type="" multiple="multiple" >
                              </div>
                              <small >Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small> </div>
                            <div class="form-upload" id="uploadedProducts"> </div>
                          </div>
                        </div>

                        <div class="row">
                          <label class="col-sm-3 control-label"><?php echo Portuguese; ?> Images<span class="reqfield">*</span></label>
                          <div class="col-sm-9 mb-4">
                            <div class="form-upload product_img">
                              <div class="dropzone" id="dropzone">
                                <input class="product_images" id="eventsimages_pt" name="eventsimages_pt[]" type="file" fi-type="" multiple="multiple" >
                              </div>
                              <small >Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small> </div>
                            <div class="form-upload" id="uploadedProducts"> </div>
                          </div>
                        </div>
			
					
					 
                    

                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                                
                                <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmtWithImg('frmEevents','events_actions.php','jvalidate','eventsimages','events_moreimage.php?id=<?php echo $view;?>');" >Upload</button>
                                        
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmevents','jvalidate','Eevents','events_mng.php');">Cancel</button>
                                        
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  
                  
     
                </div>
              </div>
            </div>




            <div class="widget-content widget-content-area">
            <fieldset>
              <legend></legend>    
                <form class="form-horizontal" action="events_actions.php" id="jvalidate1" name="noimg" method="post" >
        <input type="hidden" value="moreimageupdate" name="action" id="action">
        <input type="hidden" value="<?php echo $view; ?>" name="edit_id" id="edit_id">             
            
          <div class="box">
                  <div class="box-body">
                  <table id="tblresult" class="table  table-striped">
                        <thead>
                            <tr>
                                 <th>Sno</th>
                                 <th>Image</th>
                                 <th>Sort</th>
                                 <th align="center">Status</th>
                                 <th>Delete</th>
                                 
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
          if($countgetimages > 0){
                    $j = 1;
                    $check = '';
           
  
          $getallimg = $db->get_rsltset("select * from  kr_eventsimage where eventid='$view' and lang_id=1 order by eventidimgid asc");
          
          $getimg1 = $db->get_a_line("select group_concat(eventidimgid) as eventidimgid from kr_eventsimage where eventid='$view' and lang_id=1 order by eventidimgid asc");
           
          foreach($getallimg as $getimg){
                     $i = $getimg['eventidimgid'];
              ?>
                    <tr class="odd gradeX">
                            <td><?php echo $j;?></td>
                             <td>
                <?php if($getimg['imgname']!=""){ 
                 ?>
                                  <img id="blah" width="50" src="<?php echo IMG_BASE_URL; ?>events/<?php echo $getimg['imgname']; ?>" alt="" />
                              <?php }?>
                             </td>
                             <td> 
                              <input type="hidden" name="productimgid" id="productimgid<?php echo $getimg['eventidimgid'];?>" value="<?php echo $getimg1['eventidimgid'];?>" />
                                <input type="text"   maxlength="3" onkeypress="return CheckNumericKeyInfowithoutDot(event.keyCode, event.which);" name="image1order<?php echo $getimg['eventidimgid'];?>" id="image1order<?php echo $getimg['eventidimgid'];?>" placeholder="Image Sort order" class="form-control" value="<?=$getimg['imgorder']?>"  />
                             </td>                                            
                            
                            <td align="center">
                              <input name="status<?php echo $getimg['eventidimgid'];?>" <?php if($getimg['IsActive']==1){echo $check="checked";} ?> id="modules-<?php echo $getimg['eventidimgid'];?>" value="1" type="checkbox">
                              <input type="hidden" name="image<?php echo $getimg['eventidimgid'];?>id" id="image<?php echo $getimg['eventidimgid'];?>id" placeholder="Image Sort order" class="form-control" value="<?=$getimg['eventidimgid']?>" />
                            </td>
                            
                            
                          <td class="center">   
                             <input  class='product_image_del'  name="imagestatus<?php echo $getimg['eventidimgid'];?>" <?php echo $imgcheck; ?> id="modules-<?php echo $getimg['eventidimgid'];?>" value="1" type="checkbox">
                             <input type="hidden" name="productim<?php echo $getimg['eventidimgid'];?>" value="<?php echo $getimg['imgname']; ?>" />
                             <input name="imgname<?php echo $getimg['eventidimgid'];?>" value="<?php echo root; ?>uploads/events/<?php echo $getimg['imgname']; ?>" type="hidden">                    
                          </td>
                       </tr>                    
                    <?php $j++;}?>                                           
                    <?php
          }
          else
          {?>
                    <td colspan="6" align="center">No Eevents Image Found</td>
                    <?php }?>
                     </tbody>                                        
                </table>
              </div>                        
          </div>
             
          
                
            <!-- Button (Double) -->
          <?php if($countgetimages > 0){?>
            <div class="form-group">
              <label class="col-lg-9 control-label" for="submit"></label>
              <div class="col-lg-3">
                   <button class="btn bg-purple margin" type="reset" onClick="javascript:funCancel('noimg','jvalidate1','moreimageupdate','events_mng.php');" >Cancel</button>
       <!-- <input type="submit" class="btn bg-maroon margin pull-right" value="Update" />-->
                <button class="btn bg-maroon margin pull-right" type="button" onClick="javascript:funSubmt('noimg','events_actions.php','jvalidate1','moreimageupdate','events_moreimage.php?id=<?php echo $view;?>');" >

   <span id="spSubmit"><i class="fa fa-save"></i> Update</span></button>

                        </div>
              </div>
          <?php }?>
          </form>
     </fieldset>
     </div>





     <div class="widget-content widget-content-area">
            <fieldset>
              <legend>ES Images</legend>
                <form class="form-horizontal" action="events_actions.php" id="jvalidate2" name="noimg" method="post" >
        <input type="hidden" value="moreimageupdate" name="action" id="action">
        <input type="hidden" value="<?php echo $view; ?>" name="edit_id" id="edit_id">             
            
          <div class="box">
                  <div class="box-body">
                  <table id="tblresult" class="table  table-striped">
                        <thead>
                            <tr>
                                 <th>Sno</th>
                                 <th>Image</th>
                                 <th>Sort</th>
                                 <th align="center">Status</th>
                                 <th>Delete</th>
                                 
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
          if($countgetimages_es > 0){
                    $j_es = 1;
                    $check_es = '';
           
  
          $getallimg_es = $db->get_rsltset("select * from  kr_eventsimage where eventid='$view' and lang_id=2 order by eventidimgid asc");
          
          $getimg1_es = $db->get_a_line("select group_concat(eventidimgid) as eventidimgid from kr_eventsimage where eventid='$view' and lang_id=2 order by eventidimgid asc");
           
          foreach($getallimg_es as $getimg){
                     $i = $getimg['eventidimgid'];
              ?>
                    <tr class="odd gradeX">
                            <td><?php echo $j_es;?></td>
                             <td>
                <?php if($getimg['imgname']!=""){ 
                 ?>
                                  <img id="blah" width="50" src="<?php echo IMG_BASE_URL; ?>events/<?php echo $getimg['imgname']; ?>" alt="" />
                              <?php }?>
                             </td>
                             <td> 
                              <input type="hidden" name="productimgid" id="productimgid<?php echo $getimg['eventidimgid'];?>" value="<?php echo $getimg1_es['eventidimgid'];?>" />
                                <input type="text"   maxlength="3" onkeypress="return CheckNumericKeyInfowithoutDot(event.keyCode, event.which);" name="image1order<?php echo $getimg['eventidimgid'];?>" id="image1order<?php echo $getimg['eventidimgid'];?>" placeholder="Image Sort order" class="form-control" value="<?=$getimg['imgorder']?>"  />
                             </td>                                            
                            
                            <td align="center">
                              <input name="status<?php echo $getimg['eventidimgid'];?>" <?php if($getimg['IsActive']==1){echo $check_es="checked";} ?> id="modules-<?php echo $getimg['eventidimgid'];?>" value="1" type="checkbox">
                              <input type="hidden" name="image<?php echo $getimg['eventidimgid'];?>id" id="image<?php echo $getimg['eventidimgid'];?>id" placeholder="Image Sort order" class="form-control" value="<?=$getimg['eventidimgid']?>" />
                            </td>
                            
                            
                          <td class="center">   
                             <input  class='product_image_del'  name="imagestatus<?php echo $getimg['eventidimgid'];?>" <?php echo $imgcheck; ?> id="modules-<?php echo $getimg['eventidimgid'];?>" value="1" type="checkbox">
                             <input type="hidden" name="productim<?php echo $getimg['eventidimgid'];?>" value="<?php echo $getimg['imgname']; ?>" />
                             <input name="imgname<?php echo $getimg['eventidimgid'];?>" value="<?php echo root; ?>uploads/events/<?php echo $getimg['imgname']; ?>" type="hidden">                    
                          </td>
                       </tr>                    
                    <?php $j_es++;}?>                                           
                    <?php
          }
          else
          {?>
                    <td colspan="6" align="center">No Eevents ES Image Found</td>
                    <?php }?>
                     </tbody>                                        
                </table>
              </div>                        
          </div>
             
          
                
            <!-- Button (Double) -->
          <?php if($countgetimages_es > 0){?>
            <div class="form-group">
              <label class="col-lg-9 control-label" for="submit"></label>
              <div class="col-lg-3">
                   <button class="btn bg-purple margin" type="reset" onClick="javascript:funCancel('noimg','jvalidate2','moreimageupdate','events_mng.php');" >Cancel</button>
       <!-- <input type="submit" class="btn bg-maroon margin pull-right" value="Update" />-->
                <button class="btn bg-maroon margin pull-right" type="button" onClick="javascript:funSubmt('noimg','events_actions.php','jvalidate1','moreimageupdate','events_moreimage.php?id=<?php echo $view;?>');" >

   <span id="spSubmit"><i class="fa fa-save"></i> Update</span></button>

                        </div>
              </div>
          <?php }?>
          </form>
     </fieldset>
     </div>










            <div class="widget-content widget-content-area">
            <fieldset>
    	        <legend>PT Images</legend>    
                <form class="form-horizontal" action="events_actions.php" id="jvalidate3" name="noimg" method="post" >
	      <input type="hidden" value="moreimageupdate" name="action" id="action">
    	  <input type="hidden" value="<?php echo $view; ?>" name="edit_id" id="edit_id">             
            
   				<div class="box">
                  <div class="box-body">
                  <table id="tblresult" class="table  table-striped">
                        <thead>
                            <tr>
                                 <th>Sno</th>
                                 <th>Image</th>
                                 <th>Sort</th>
                                 <th align="center">Status</th>
                                 <th>Delete</th>
                                 
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
					if($countgetimages_pt > 0){
                    $j_pt = 1;
                    $check_pt = '';
					 
	
					$getallimg_pt= $db->get_rsltset("select * from  kr_eventsimage where eventid='$view' and lang_id=3 order by eventidimgid asc");
					
					$getimg1_pt = $db->get_a_line("select group_concat(eventidimgid) as eventidimgid from kr_eventsimage where eventid='$view' and lang_id=3  order by eventidimgid asc");
					 
					foreach($getallimg_pt as $getimg){
                 		 $i = $getimg['eventidimgid'];
   						?>
                    <tr class="odd gradeX">
                            <td><?php echo $j_pt;?></td>
                             <td>
							 	<?php if($getimg['imgname']!=""){ 
								 ?>
			                            <img id="blah" width="50" src="<?php echo IMG_BASE_URL; ?>events/<?php echo $getimg['imgname']; ?>" alt="" />
            	                <?php }?>
                             </td>
                             <td> 
                           		<input type="hidden" name="productimgid" id="productimgid<?php echo $getimg['eventidimgid'];?>" value="<?php echo $getimg1_pt['eventidimgid'];?>" />
                                <input type="text"   maxlength="3" onkeypress="return CheckNumericKeyInfowithoutDot(event.keyCode, event.which);" name="image1order<?php echo $getimg['eventidimgid'];?>" id="image1order<?php echo $getimg['eventidimgid'];?>" placeholder="Image Sort order" class="form-control" value="<?=$getimg['imgorder']?>"  />
                             </td>                                            
                            
                            <td align="center">
                              <input name="status<?php echo $getimg['eventidimgid'];?>" <?php if($getimg['IsActive']==1){echo $check_pt="checked";} ?> id="modules-<?php echo $getimg['eventidimgid'];?>" value="1" type="checkbox">
                              <input type="hidden" name="image<?php echo $getimg['eventidimgid'];?>id" id="image<?php echo $getimg['eventidimgid'];?>id" placeholder="Image Sort order" class="form-control" value="<?=$getimg['eventidimgid']?>" />
                            </td>
                            
                            
                          <td class="center">   
                             <input  class='product_image_del'  name="imagestatus<?php echo $getimg['eventidimgid'];?>" <?php echo $imgcheck; ?> id="modules-<?php echo $getimg['eventidimgid'];?>" value="1" type="checkbox">
                             <input type="hidden" name="productim<?php echo $getimg['eventidimgid'];?>" value="<?php echo $getimg['imgname']; ?>" />
                             <input name="imgname<?php echo $getimg['eventidimgid'];?>" value="<?php echo root; ?>uploads/events/<?php echo $getimg['imgname']; ?>" type="hidden">                    
                          </td>
                       </tr>                    
                    <?php $j_pt++;}?>                                           
                    <?php
					}
					else
					{?>
                    <td colspan="6" align="center">No Eevents PT Image Found</td>
                    <?php }?>
                     </tbody>                                        
                </table>
              </div>                        
          </div>
             
          
                
            <!-- Button (Double) -->
          <?php if($countgetimages_pt > 0){?>
            <div class="form-group">
              <label class="col-lg-9 control-label" for="submit"></label>
              <div class="col-lg-3">
                   <button class="btn bg-purple margin" type="reset" onClick="javascript:funCancel('noimg','jvalidate3','moreimageupdate','events_mng.php');" >Cancel</button>
       <!-- <input type="submit" class="btn bg-maroon margin pull-right" value="Update" />-->
                <button class="btn bg-maroon margin pull-right" type="button" onClick="javascript:funSubmt('noimg','events_actions.php','jvalidate1','moreimageupdate','events_moreimage.php?id=<?php echo $view;?>');" >

   <span id="spSubmit"><i class="fa fa-save"></i> Update</span></button>

                        </div>
              </div>
          <?php }?>
          </form>
     </fieldset>
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

<script>
jQuery(document).ready(function(){	
 
 	
 	    $("#eventsimages,#eventsimages_es,#eventsimages_pt").filer({
		limit: null,
		maxSize: null,
		addMore:true,
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
</script>
<script type="text/javascript">

function checkmediatype(id){
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

/*
   jQuery(document).ready(function($){
<?php if((basename($_SERVER['PHP_SELF']) == 'events_form.php'   ) && $act == 'update'){ ?>       
  <?php if($res_ed['eventvideourl'] != ''){
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
		$('#eventsimages').addClass('jsrequired');	
		$('#txtvideourl').removeClass('jsrequired');	
	 }
	 else if(this.value == 2)
	 {
		$('#photos').hide();
		
	    $('#videos').show();	
		$('#txtvideourl').addClass('jsrequired');	
		$('#eventsimages').removeClass('jsrequired');	
		
	 }
	 else
	 {
		$('#photos').hide();
	    $('#videos').hide();
		$('#eventsimages').removeClass('jsrequired');
	
		$('#txtvideourl').removeClass('jsrequired');	
	 }
	});	*/
</script>
<!--  END FOOTER  -->