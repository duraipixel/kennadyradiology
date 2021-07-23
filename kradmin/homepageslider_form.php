<?php 
$menudisp = "homepageslider";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeHomepageslider($db,'');
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

$str_ed = "select * from ".TPLPrefix."homepageslider where IsActive != ? and hpsid = ? and parent_id =0 and lang_id = 1 ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));


$str_ed_es = "select * from ".TPLPrefix."homepageslider where IsActive != ? and  parent_id = ? and lang_id = 2 ";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array(2,base64_decode($id)));

$str_ed_pt = "select * from ".TPLPrefix."homepageslider where IsActive != ? and  parent_id = ? and lang_id = 3 ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array(2,base64_decode($id)));

//print_r($res_ed); exit;
$edit_id = $res_ed['hpsid'];
$edit_id_es = $res_ed_es['hpsid'];
$edit_id_pt = $res_ed_pt['hpsid'];

$str_ed1="select t2.productid from ".TPLPrefix."homepageslider t1 inner join ".TPLPrefix."homepageslider_product t2 on  t1.hpsid=t2.hpsid and t2.IsActive =1 where t1.IsActive = ? and t1.hpsid = ? order by t2.sortby asc"; 

//echo $str_ed1; exit;
$res_eds = $db->get_rsltset_bind($str_ed1,array(1,$edit_id));
 

$productids = Array();
foreach ($res_eds as $key => $value) {
  $productids[] = $value['productid'];
}
$productids = implode(', ',$productids);

$chk='';
if($res_ed['IsActive']=='1')
{
	$chk='checked';
}

$chktype='';
if($res_ed['type']=='1')
{
    $chktype='checked'; 
}

$chktypes='';
if($res_ed['type']=='0')
{
    $chktypes='checked'; 
}

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
	$edit_id='';
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
              <li><a href="homepageslider_mng.php">Homepage Slider </a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Homepage Slider </a> </li>
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
                  <h4><?php echo $operation; ?> Homepage Slider </h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" id="editid" name="edit_id" value="<?php echo $edit_id; ?> "  />
					 <input type="hidden" id="editid_es" name="edit_id_es" value="<?php echo $edit_id_es; ?> "  />
					  <input type="hidden" id="editid_pt" name="edit_id_pt" value="<?php echo $edit_id_pt; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="title" required id="title" value="<?php echo $res_ed['title']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="title_es" required id="title_es" value="<?php echo $res_ed_es['title']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="title_pt" required id="title_pt" value="<?php echo $res_ed_pt['title']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">subtitle <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="subtitle" required id="subtitle" value="<?php echo $res_ed['subtitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> subtitle <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="subtitle_es" required id="subtitle_es" value="<?php echo $res_ed_es['subtitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> subtitle <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="subtitle_pt" required id="subtitle_pt" value="<?php echo $res_ed_pt['subtitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
					
					
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Type <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" class="new-control-input type" required name="type" id="type" value="1" onclick = "productlist('<?php echo $res_ed['categoryid']; ?>')" <?php echo $chktype; ?> />
                                <span class="new-control-indicator"></span>Single Category </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio"  class="new-control-input type" required name="type" id="types" value="0"  onclick = "productlist('')" <?php echo $chktypes; ?> />
                                <span class="new-control-indicator"></span>All Category </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                          <div class="controls">
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="divcate">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Parent Category</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls reqiredtxtalignment">
                            <?php 					 
						
						 
						   if($act=="update"){
							  // echo $res_ed['parentid'];
							  // print_r($res_ed['parentid']);
							//   die();
						  
							  if (isset($chk_Ref_there)) {
						  ?>
                            <input type="hidden" name="parentid" value="<?php echo $res_ed['categoryid']; ?>" />
                            <?php	
							  //echo getSelectBox_categorylist($db,'parentcategory','',$res_ed['parentid'],$res_ed['categoryID'],'disabled'); 
							   echo getSelectBox_categorylist($db,'parentid','jsrequired','',$res_ed['parentid'],$res_ed['categoryID'],'disabled',2);	  
							  }
							  else{
								//echo getSelectBox_categorylist($db,'parentcategory','',$res_ed['parentid'],$res_ed['categoryID']);   
								echo getSelectBox_categorylist($db,'parentid','jsrequired','',$res_ed['categoryid'],'','',2);   
							  }							  
						  }
						  else{
							 echo getSelectBox_categorylist($db,'parentid','jsrequired',$res_ed['parentid'],'','','',2); 
						  }
						 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Products </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls reqiredtxtalignment" id="old_productlist"> <?php echo getSelectBox_Products($db,'product','jsrequired',$productids,$res_ed['categoryid']); ?>
                            <p class="help-block"></p>
                          </div>
                          <div class="controls"  id="productlist"></div>
                          <p class="help-block"></p>
                        </div>
                      </div>
                    </div>
                    <div id="producttable"></div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Position </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls" >
                            <input type="text" name="sortby" value="<?php echo $res_ed['sortby']; ?>" class="form-control numericvalidate" />
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
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmt('frmhomepageslider','homepageslider_actions.php','jvalidate','homepageslider','homepageslider_mng.php');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                            <button  type="reset" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmhomepageslider','jvalidate','homepageslider','homepageslider_mng.php');" >Cancel</button>
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

	<?php if($res_ed['type']=='1'){ ?>
	
	 $("#divcate").show();
    <?php } else { ?>
	$("#divcate").hide();
	<?php } ?>




jQuery(document).ready(function(){
	

	
	
	$(".type").on('click',function(){
		
		var val = $(this).val();
		if(val=='1'){
			$("#divcate").show();
		}
		else{
			$("#divcate").hide();
		}
	});


	$(".productarray").change(function() {
		if ($(".productarray option:selected").length > 10) {
			
		   alert("you can only select 10 items");
		}
		
	});

/*
	$(".productarray").select2({
	  maximumSelectionLength: 10
	});
*/


	
});



function productlist(catid)
{
 
		$.ajax({		
			url        : 'ajaxresponse.php',
			method     : 'POST',
			dataType   : 'json',		
			data 	   : 'action=homepagedisplay&catid='+catid,				
	
			success: function(response){ 
 		      $("#old_productlist").hide();
				
                $("#productlist").html(response.htmlcontent);
				$('.select2').select2();
			},		
		});
}

<?php if($act=="update"){  ?>

productdisplay();

<?php
 }
?>

function productdisplay()
{  
  
        var eid='';
        <?php if($act=="update") { ?>
     	 eid = $("#editid").val();
		<?php } ?>
   
	    var productids = [];
        $.each($(".productarray option:selected"), function(){            
            productids.push($(this).val());
        });
        //alert("You have selected the country - " + productids.join(", "));
		$.ajax({		
			url        : 'ajaxresponse.php',
			method     : 'POST',
			dataType   : 'json',		
			data 	   : 'action=homepagedisplay_productlist&eid='+eid+'&productids='+productids.join(", "),				
	
			success: function(response){ 
				$("#producttable").html(response.hmlbind);
                // datatable();
		    },		
		});
	
}


$(document).ready(function() {
    $(".numericvalidate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

</script>