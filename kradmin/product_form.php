<?php 
$productdisp = "product";
include "includes/header.php"; 

include "includes/Mdme-functions.php";
$mdme = getMdmeProduct($db,'');
include_once "includes/pagepermission.php";

$QuantityIncreaseDecrease = searchkeyvalue("IsQuantityIncreaseDecrease",$GLOBALS['allcon']);

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$getsize = getimagesize_large($db,'product','product_image');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];


$getsizes = getimagesize_large($db,'customizedimage','customizedproduct');
//$sizes = getdynamicimage($db,$bannername);
$imagevals = explode('-',$getsizes);
$imgheights = $imagevals[1];
$imgwidths = $imagevals[0];

//$_SESSION['attribute_Mapid']='';

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

$str_ed = "SELECT *	FROM  `".TPLPrefix."product` t1	where t1.product_id = '".base64_decode($id)."' and t1.parent_id = 0";
$res_ed = $db->get_a_line($str_ed);

$str_ed_es = "SELECT * FROM  `".TPLPrefix."product` t1 where  t1.parent_id ='".base64_decode($id)."' and t1.lang_id = 2";				
$res_ed_es = $db->get_a_line($str_ed_es);
 
$str_ed_pt = "SELECT * FROM  `".TPLPrefix."product` t1 where  t1.parent_id ='".base64_decode($id)."'  and t1.lang_id = 3";				
$res_ed_pt = $db->get_a_line($str_ed_pt);

$str_ed_att_es = "SELECT * FROM  `".TPLPrefix."attributegroup` t1 where  t1.parent_id ='".$_SESSION['attribute_Mapid']."'  and t1.lang_id = 2";				
$res_ed_att_es = $db->get_a_line($str_ed_att_es);
$attributeMapId_es =$res_ed_att_es['attribute_groupID'];

$str_ed_att_pt = "SELECT * FROM  `".TPLPrefix."attributegroup` t1 where  t1.parent_id ='".$_SESSION['attribute_Mapid']."'  and t1.lang_id = 3";				
$res_ed_att_pt= $db->get_a_line($str_ed_att_pt);
$attributeMapId_pt =$res_ed_att_pt['attribute_groupID'];

$edit_id = $res_ed['product_id'];
$edit_id_es = $res_ed_es['product_id'];
$edit_id_pt = $res_ed_pt['product_id'];
$ddownid = explode(',',$res_ed['dropdown_id']); 
 //print_r($ddownid); exit;
$chk='';
if($res_ed['IsActive']=='1')
{
	$chk='checked';
}

$isfeatured = '';
if($res_ed['isfeaturedproduct'] == '1'){
	$isfeatured = 'checked';
}

$sdchk='';
if($res_ed['soldout']=='1')
{
	$sdchk='checked';
}
$isbuynow = '';
if($res_ed['isbuynow'] == 1){
$isbuynow = 'checked';	
}

$iscustomchk='';
if($res_ed['iscustomized']=='1')
{
	$iscustomchk='checked';
}

$chkpvatts='';
if($res_ed['chkpvatt']=='1')
{
	$chkpvatts='checked';
}

$chkpvattsprice='';
if($res_ed['chkpvattprice']=='1')
{
	$chkpvattsprice='checked';
}


$isnewproduct='';
if($res_ed['isnewproduct']=='1')
{
	$isnewproduct='checked';
}

$iscolorimage='';
if($res_ed['iscolorimage']=='1')
{
	$iscolorimage='checked';
}




	$ishome='';
	if($res_ed['displayinhome']=='1'){	
	$ishome='checked';
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
}
$configinfo=getQuerys($db,"allconfigurable");

//attributelistmultiple;
$attributelistmultiple = $db->get_rsltset("select * from kr_product_attribute_multiple where lang_id = 1 and product_id = '".base64_decode($id)."' and IsActive=1 ");
?>

<?php include "common/dpselect-functions.php";?>
<?php include "includes/top.php";?>
<style>
fieldset{
    border: 1px solid lightgrey;
}
#tblresultSuggested_filter{ display: none;}
#tblresultRelated_filter{ display: none;} 
.easy-autocomplete{ width:100%!important}
fieldset{border:0px!important;}
</style>
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
          <h3>Product Management</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
              <li><a href="product_mng.php">Manage Product</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Product</a> </li>
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
                  <h4><?php echo $operation; ?> Product</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs  mb-3 mt-3" id="iconTab" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" id="generals" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="flaticon-user-11"></i> General</a> </li>
                      <?php  
					$disablecursot="";
					if(empty($edit_id) || $edit_id=='')
						$disablecursot=" style='cursor: not-allowed;pointer-events: none;' "; 
					?>
                      <li class="nav-item"> <a class="nav-link" <?php echo $disablecursot; ?>  data-toggle="tab" id="related" href="#relatedpro" role="tab" aria-controls="relatedpro" aria-selected="false"><i class="flaticon-map"></i> Related Product</a> </li>
                      <li class="nav-item"> <a class="nav-link" <?php echo $disablecursot; ?>   id="suggested" data-toggle="tab" href="#suggestedpro" role="tab" aria-controls="suggestedpro" aria-selected="false"><i class="flaticon-menu-list"></i> Suggested product</a> </li>
					<li> <?php if($res_ed['isfeaturedproduct'] == '1'){?>
					  <a class="btn btn-primary"  id="feat" href="<?php echo BASE_URL;?>featuredproduct_form.php?act=edit&pid=<?php echo $_REQUEST['id'];?>"><i class="flaticon-menu-list"></i> Edit Featured product</a>
					  <?php }?></li>
                    </ul>
					 
                    <div class="tab-content"> 
                      
                      <!-- general Info - START -->
                      <div class="tab-pane active" id="general">

                      <form id="jvalidate" name="frmProduct" role="form" class="form-horizontal" action="#" method="post" >
                        <input type="hidden" name="action_" value="<?php echo $act; ?>" />
                        <input type="hidden" name="attributeMapId" value="<?php echo $_SESSION['attribute_Mapid']; ?>" />
						 <input type="hidden" name="attributeMapId_es" value="<?php echo $attributeMapId_es; ?>" />
						  <input type="hidden" name="attributeMapId_pt" value="<?php echo $attributeMapId_pt; ?>" />
                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>"  />
						<input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?>"  />
						<input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?>"  />
                        <input type="hidden" id="iscustomized" value="<?php echo $res_ed['iscustomized']; ?>"  />
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Product Name <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control" required name="product_name" id="product_name" onblur="generateslug(this.value,'product_url');" value="<?php echo $res_ed['product_name']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Product Name <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control" required name="product_name_es" id="product_name_es"  value="<?php echo $res_ed_es['product_name']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Product Name <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control" required name="product_name_pt" id="product_name_pt"   value="<?php echo $res_ed_pt['product_name']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Category <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls categoryCollection"> <span id="tree"></span>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">SKU <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control alphaonly"  required name="sku" id="sku" value="<?php echo $res_ed['sku']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Product URL <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control alphaonly" required readonly="true" name="product_url" id="product_url" value="<?php echo $res_ed['product_url']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Product Tag <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" data-role="tagsinput" name="producttag" id="producttag" class="form-control jsrequired" required  value="<?php echo $res_ed['producttag'];?>" />
                      <small>Press Comma to create a new tag, Backspace or Delete to remove the last one.</small> 
					   
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Product Tag <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" data-role="tagsinput" name="producttag_es" id="producttag_es" class="form-control jsrequired" required  value="<?php echo $res_ed_es['producttag'];?>" />
                      <small>Press Comma to create a new tag, Backspace or Delete to remove the last one.</small> 
					   
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Product Tag <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" data-role="tagsinput" name="producttag_pt" id="producttag_pt" class="form-control jsrequired" required  value="<?php echo $res_ed_pt['producttag'];?>" />
                      <small>Press Comma to create a new tag, Backspace or Delete to remove the last one.</small> 
					   
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						
					  
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Short Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-9">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea id="description" name="description" class="texteditor"><?php echo  $res_ed['description']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Short Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-9">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea id="description_es" name="description_es" class="texteditor"><?php echo  $res_ed_es['description']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Short Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-9">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea id="description_pt" name="description_pt" class="texteditor"><?php echo  $res_ed_pt['description']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-9">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea id="longdescription" name="longdescription" class="texteditor"><?php echo  $res_ed['longdescription']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						   <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-9">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea id="longdescription_es" name="longdescription_es" class="texteditor"><?php echo  $res_ed_es['longdescription']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						   <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-9">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea id="longdescription_pt" name="longdescription_pt" class="texteditor"><?php echo  $res_ed_pt['longdescription']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                         
 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Manufacturer </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
							  <?php 
							echo getSelectBox_ManufacturerList($db, 'manufacturerId', 'jrequired',$res_ed['manufacturerId'],"");
 							?>
							 
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Meta Name </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control  " name="metaname" id="metaname" value="<?php echo $res_ed['metaname']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Meta Name </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control  " name="metaname_es" id="metaname_es" value="<?php echo $res_ed_es['metaname']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Meta Name </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control  " name="metaname_pt" id="metaname_pt" value="<?php echo $res_ed_pt['metaname']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Meta Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea class="form-control " name="metadescription" id="metadescription" ><?php echo $res_ed['metadescription']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Meta Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea class="form-control " name="metadescription_es" id="metadescription_es" ><?php echo $res_ed_es['metadescription']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						<div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Meta Description </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <textarea class="form-control " name="metadescription_pt" id="metadescription_pt" ><?php echo $res_ed_pt['metadescription']; ?></textarea>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Meta Keyword </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control  " name="metakeyword" id="metakeyword" value="<?php echo $res_ed['metakeyword']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Spanish; ?> Meta Keyword </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control  " name="metakeyword_es" id="metakeyword_es" value="<?php echo $res_ed_es['metakeyword']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
						
						 <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label"><?php echo Portuguese; ?> Meta Keyword </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control  " name="metakeyword_pt" id="metakeyword_pt" value="<?php echo $res_ed_pt['metakeyword']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php if($QuantityIncreaseDecrease!=0){ ?>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Min Quantity <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control number" required name="quantity" id="quantity" value="<?php echo $res_ed['quantity']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Quantity <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="hidden" value="<?php echo $act=='insert'?searchkeyvalue("minimumStock",$configinfo):$res_ed['minquantity']; ?>" id ="minqtychangevalue" />
                                <input type="text" class="form-control minquantitys numericvalidate" required name="minquantity" id="minquantity" value="<?php echo $act=='insert'?searchkeyvalue("minimumStock",$configinfo):$res_ed['minquantity']; ?>"  <?php if($res_ed['configqua']==1 || $res_ed['configqua']==''){ ?>  readonly <?php } ?>  />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                          <div class="col col col-md-3">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" class="new-control-input" name="configqua" id="configqua" value="" <?php echo ($res_ed['configqua']==1 || $res_ed['configqua']=='')? " checked= 'checked' ":''; ?>   />
                                <span class="new-control-indicator"></span>Config </label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Price <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control number numericvalidate"  required name="price" id="price" value="<?php echo $res_ed['price']; ?>">
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Special Price</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input class="form-control number numericvalidate"  name="specialprice" id="specialprice" value="<?php echo $res_ed['specialprice']; ?>" Onkeyup = "spricekeypress();">
                                
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        
                        <div class="row" id="spfromtodate" style="display:none">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">&nbsp;</label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                
                                  <div class="row">
                                    <div class="col-sm-4 no-padding-left">
                                    
                                   
                            <input placeholder="From" class="form-control jsrequired  calldatepicker sdate_today_min1" name="spl_fromdate" id="spl_fromdates" 
							value="<?php echo $res_ed['spl_fromdate']!=''?  date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['spl_fromdate'])): date($GLOBALS['stroedateformat']['phpformat']); ?>" readonly
							>
                             
                                    </div>
                                    <div class="col-sm-4 no-padding-right">
                                    <?php //echo  date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['spl_todate']));?>
                                 	<input placeholder="To" class="form-control jsrequired  calldatepicker edate_today_min1" name="spl_todate" id="todate" 
							value="<?php echo $res_ed['spl_todate']!=''?  date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['spl_todate'])): date($GLOBALS['stroedateformat']['phpformat']); ?>" readonly										
							>	
                            
                            
                                    
                                  </div>
                                </div>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Set as New Product </label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <div class="n-chk">
                                  <label class="new-control new-checkbox checkbox-success">
                                    <input type="checkbox" class="new-control-input "  name="isnewproduct" id="isnewproduct" <?php echo $isnewproduct; ?> value="">
                                    <span class="new-control-indicator"></span>&nbsp; </label>
                                </div>
                                <p class="help-block"></p>
                              </div>
                              <div id="newprodfromtodate" style='<?php echo $isnewproduct!="" ? "display:block": "display:none"; ?>'>
                                <div class="row">
                                    <div class="col-sm-4 no-padding-left">
                                  <input type="text" placeholder="From" class="form-control calldatepicker  sdate_today_min" name="newprod_fromdate" id="newprod_fromdate" 
							value="<?php echo $res_ed['newprod_fromdate']!='' && strtotime($res_ed['newprod_fromdate'])!='0'?  date('d-m-Y',strtotime($res_ed['newprod_fromdate'])): date('d-m-Y'); ?>" readonly	>
                                </div>
                                
                                <div class="col-sm-4 no-padding-left">
                                  <input type="text" placeholder="To" class="form-control calldatepicker  edate_today_min" name="newprod_todate" id="newprod_todate" 
							
							value="<?php echo $res_ed['newprod_todate']!='' && strtotime($res_ed['newprod_fromdate'])!='0' ?  date('d-m-Y',strtotime($res_ed['newprod_todate'])): date($GLOBALS['stroedateformat']['phpformat']); ?>" readonly
							>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
				
				<!-- product attribute creation-->			
						<fieldset >
                          <legend>
                          <h4>Product Attribute</h4>
                          </legend>
						  
                  <div class="row fls-eat">
                    <?php if(count($attributelistmultiple)=='0'){ ?>
                    <div class="row rowbox" id="row0">                      
                      <div class="col-md-12 mbs-12">
                        <table border="0" cellpadding="10" cellspacing="10">
                          <tr>
                            <td>Product Type</td>
                            <td>Size</td>
                            <td>Lead Equivalnce</td>
							<td>Matrial</td>
							 <td>SKU</td>
							 <td>Default</td>
                          </tr>
                          <tr>
                            <td>				
								<?php echo getattributemasterdata($db, "attributeproducttype0", '  ',$Attr,'',1) ?>			 
							</td>
							 <td>				
								<?php echo getattributemasterdata($db, "attributeproductsize0", '  ',$Attr,'',2) ?>			 
							</td>
                            <td>  				
								<?php echo getattributemasterdata($db, "attributeleadequivalnce0", '  ',$Attr,'',3) ?>			 
							</td> 
                             <td>  				
								<?php echo getattributemasterdata($db, "attributematerial0", '  ',$Attr,'',4) ?>			 
							</td> 
							<td>  				
								<input type="text" name="productattsku0" id="productattsku0" class="form-control jsrequired">	 
							</td>
<td><input type="radio" name="isdefault" id="isdefault0" value="0"></td>							
							</tr>
							
							<tr> 
							<td>Color</td>
							<td>Fabric</td>
							
							<td>Price</td>
							
							<td>&nbsp;</td>
                          </tr>
						  
							<tr>
							 <td>  				
								<?php echo getattributemasterdata_multiple($db, "attributecolor0", '  ',$Attr,'',1) ?>			 
							</td> 
							 <td>  				
								<?php echo getattributemasterdata_multiple($db, "attributefabric0", '  ',$Attr,'',2) ?>			 
							</td> 
							 
							 <td>  				
								<input type="text" name="productattprice0" id="productattprice0" class="form-control jsrequired">	 
							</td> 
							
                            
                            <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options();" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <input type="hidden" name="option_count" id="option_count" value="1" />
                              <input type="hidden" name="option_max_count" id="option_max_count" value="1" /></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php }else{ 
					
								$j=0;$k=1;
								foreach($attributelistmultiple as $multipleattribute){ ?>
                   
					
					 <div class="row col-12 rowbox" id="row_option<?php echo $j; ?>">
					  <input type="hidden" name="option_edit_id<?php echo $j; ?>" id="option_edit_id<?php echo $j; ?>" value="<?php echo $multipleattribute['attributeID']; ?>" />
                        <table border="0" cellpadding="10" cellspacing="10" style="clear: both;
width: 100%;">
                          <tr>
                            <td>Product Type</td>
                            <td>Size</td>
                            <td>Lead Equivalnce</td>
							<td>Matrial</td>
							 <td>SKU</td>
							 <td>Default</td>
                          </tr>
                          <tr>
                            <td>				
								<?php echo getattributemasterdata($db, "attributeproducttype".$j."", '  ',$Attr,$multipleattribute['product_type'],1) ?>			 
							</td>
							 <td>				
								<?php echo getattributemasterdata($db, "attributeproductsize".$j."", '  ',$Attr,$multipleattribute['size'],2) ?>			 
							</td>
                            <td>  				
								<?php echo getattributemasterdata($db, "attributeleadequivalnce".$j."", '  ',$Attr,$multipleattribute['leadequivalnce'],3) ?>			 
							</td> 
                             <td>  				
								<?php echo getattributemasterdata($db, "attributematerial".$j."", '  ',$Attr,$multipleattribute['materialid'],4) ?>			 
							</td> 
							<td>  				
								<input type="text" name="productattsku<?php echo $j;?>" id="productattsku<?php echo $j;?>" value="<?php echo $multipleattribute['productsku'];?>" class="form-control jsrequired">	 
							</td> 
							<td><input type="radio" name="isdefault" id="isdefault<?php echo $j;?>" value="<?php echo $j;?>" <?php echo ($multipleattribute['isdefault'] == 1) ? 'checked="checked"' : '';?>></td>
							</tr>
							
							<tr> 
							 <td colspan="2">  	Color</td>
							 <td colspan="2">  	Fabric</td>
							
							<td>Price</td>
							
							<td>&nbsp;</td>
                          </tr>
						  
							<tr>
							 <td colspan="2">  				
								<?php echo getattributemasterdata_multiple($db, "attributecolor".$j."", '  ',$Attr,$multipleattribute['colorid'],1) ?>			 
							</td> 
							 <td colspan="2">  			
								<?php echo getattributemasterdata_multiple($db, "attributefabric".$j."", '  ',$Attr,$multipleattribute['fabricid'],2) ?>			 
							</td> 
							 
							 <td>  				
								<input type="text" name="productattprice<?php echo $j;?>" id="productattprice<?php echo $j;?>" value="<?php echo $multipleattribute['productprice'];?>" class="form-control jsrequired">	 
							</td> 
                            
							
							
							
							 <td>&nbsp;&nbsp;
                              <?php if($j!=0){
									 ?>
                              <a href="javascript:void(0);" onClick="remove_option('<?php echo $j; ?>','<?php echo $edit_id; ?>','<?php echo $multipleattribute['attributeID']; ?>');" class="btn_remove"><span class="remthis"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a>
                              <?php  

									}else{ ?>
                              <a href="javascript:void(0);" onClick="add_options();" ><span class="remthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a>
                              <?php } ?>
							 </td>
							  
							 
                          </tr>
                        </table>
                      </div>
					  
					 
                    <?php $j++; $k++;
										}  ?>
                    <input type="hidden" name="option_count" id="option_count" value="<?php echo count($attributelistmultiple); ?>" />
                    <input type="hidden" name="option_max_count" id="option_max_count" value="<?php echo count($attributelistmultiple); ?>" />
                    <?php } ?>
                    <div id="option_div"> </div>
                    <div>&nbsp;</div>
                  </div>
				  
				  
				
    </fieldset>
	
  <div class="control-group mb-4"> &nbsp; </div>
                             
              <div class="control-group mb-4"> &nbsp; </div>
                   <div class="control-group mb-4"> &nbsp; </div>      
                        <!---------------------- kkkkkkkk ------------->
                        
                        <?php		
					//	print_r($_SESSION['attribute_Mapid']); die();
								$str = "SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and t2.IsActive=1
										INNER JOIN ".TPLPrefix."attributegroup gp ON gp.attribute_groupID = t1.attribute_groupID and gp.IsActive=1
										WHERE t1.attribute_groupID ='".$_SESSION['attribute_Mapid']."' AND t1.IsActive =1 and t1.isCombined = 0  ";
								if(isset($res_ed['attributeMapId']) && $res_ed['attributeMapId']>0 ){
									   
										$str = "SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and t2.IsActive=1
										INNER JOIN ".TPLPrefix."attributegroup gp ON gp.attribute_groupID = t1.attribute_groupID  and gp.IsActive=1
										WHERE t1.attribute_groupID ='".$res_ed['attributeMapId']."' AND t1.IsActive =1 and t1.isCombined = 0  ";
								} 
								if($_SESSION['attribute_Mapid']=='' && $edit_id!='' && ($res_ed['attributeMapId']=='' || $res_ed['attributeMapId']==0) )
								{
									
									 $str = "SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and t2.IsActive=1
										INNER JOIN ".TPLPrefix."product_attr_dropdwid p_down ON p_down.attribute_id = t1.attributeID  and p_down.IsActive=1
										INNER JOIN ".TPLPrefix."product p ON p.product_id = p_down.product_id  and p.IsActive<>2
										WHERE p.product_id ='".$edit_id."' AND t1.IsActive =1 and t1.isCombined = 0 group by t1.attributeID 
										union all
										SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and t2.IsActive=1
										INNER JOIN ".TPLPrefix."product_attr_varchar p_var ON p_var.attribute_id = t1.attributeID  and p_var.IsActive=1
										INNER JOIN ".TPLPrefix."product p ON p.product_id = p_var.product_id  and p.IsActive<>2
										WHERE p.product_id ='".$edit_id."' AND t1.IsActive =1 and t1.isCombined = 0 group by t1.attributeID
										
										";


								}	
								
								$resAttrib = $db->get_rsltset($str); 	

							
								if(count($resAttrib)>0){
								?>
                        <fieldset >
                          <legend>
                          <h4>Attribute</h4>
                          </legend>
                          <?php		
								foreach($resAttrib as $val){									
								?>
                          <div class="row">
                          <label class="col-sm-3 control-label"><?php echo  $val["attributename"]; ?></label>
						  
                          <?php if($val["attribute_type"] == "text"){
											if($edit_id != ''){
												$attrSelection = " SELECT attribute_value FROM  `".TPLPrefix."product_attr_varchar` where product_id ='".$edit_id."' and attribute_id = '".$val["attributeid"]."' and lang_id = 1
												";
												$resAttrSelection = $db->get_a_line($attrSelection);												
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';
											}
										  ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <label>
                                <input class="form-control " name="customattriben_<?php echo $val["attribute_type"] ?>_<?php echo  $val["attributeid"]; ?>" value="<?php echo $defautValue; ?>">
                              </label>
                            </div>
                          </div>
                          <?php 
										 }
										  else if($val["attribute_type"] == "textarea"){
											if($edit_id != ''){
												$attrSelection = " SELECT attribute_value FROM  `".TPLPrefix."product_attr_varchar` where product_id ='".$edit_id."' and attribute_id = '".$val["attributeid"]."' ";
												$resAttrSelection = $db->get_a_line($attrSelection);												
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';
											}
										  ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <label>
                                <textarea class="form-control texteditor" name="customattriben_<?php echo $val["attribute_type"] ?>_<?php echo  $val["attributeid"]; ?>" ><?php echo $defautValue; ?></textarea>
                              </label>
                            </div>
                          </div>
                          <?php 
										 }
										 else if($val["attribute_type"] == "checkbox"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$val['attributeid']."' and t1.isactive=1 and t1.lang_id = 1";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
										 ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <?php
													if($edit_id != ''){
														$attrSelection = "SELECT group_concat(dropdown_id) as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$val["attributeid"]."' ";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? explode(",",$resAttrSelection['attribute_value']): array();														
													}													
													foreach($resDropdown as $dropdownVal){									
													?>
                              <label>
                                <input type="checkbox" class="form-control " name="customattriben_<?php echo $val["attribute_type"] ?>_<?php echo  $val["attributeid"]; ?>[]" value="<?php echo $dropdownVal['dropdown_id']; ?>"
													
													
													<?php 
													echo (in_array($dropdownVal['dropdown_id'],$defautValue))? " checked='checked' ":"";
													?>
													
													>
                                <span class="checkbox-material"> <span class="check"></span> </span> </label>
                              <?php 
														echo $dropdownVal['dropdown_values'];
													}
												  ?>
                            </div>
                          </div>
                          <?php 
										 }
										 else if($val["attribute_type"] == "radio"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$val['attributeid']."' and t1.isactive=1 and t1.lang_id = 1";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
										 ?>
                          <div class="col-sm-8">
                          <?php
													if($edit_id != ''){
														$attrSelection = "SELECT dropdown_id as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$val["attributeid"]."' and IsActive=1 ";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';				
													}													
													foreach($resDropdown as $dropdownVal){									
													?>
                          <div class="radio radio-primary">
                            <label>
                              <input type="radio" class="" name="customattriben_<?php echo $val["attribute_type"] ?>_<?php echo  $val["attributeid"]; ?>"  value="<?php echo $dropdownVal['dropdown_id']; ?>" >
                              <span class="circle m-t-6"></span><span class="check m-t-6"></span>
                              <?php
													 echo $dropdownVal['dropdown_values'];
													 ?>
                            </label>
                            <div>
                              <?php } ?>
                            </div>
                            <?php 
										 }
										 else if($val["attribute_type"] == "multiselect"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$val['attributeid']."' and t1.lang_id = 1 ";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
											if($edit_id != ''){
														$attrSelection = "SELECT group_concat(dropdown_id) as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$val["attributeid"]."' and IsActive=1 ";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? explode(",",$resAttrSelection['attribute_value']) : array();															
												}
											?>
                            <div class="col-sm-8">
                              <select class="select2 form-control" name="customattriben_<?php echo $val["attribute_type"] ?>_<?php echo  $val["attributeid"]; ?>[]"  multiple>
                                <?php
														
														
														foreach($resDropdown as $dropdownVal){													
														?>
                                <option value="<?php echo $dropdownVal['dropdown_id'] ?>"
														
														<?php 
															echo (in_array($dropdownVal['dropdown_id'],$defautValue))? " selected='selected' ":"";
														?>
														> <?php echo $dropdownVal['dropdown_values']; ?> </option>
                                <?php
														}
														?>
                              </select>
                            </div>
                            <?php 
										  }	
										 else{	
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$val['attributeid']."' and t1.lang_id = 1 ";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
											if($edit_id != ''){
												$attrSelection = "SELECT dropdown_id as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$val["attributeid"]."' and IsActive=1 ";
												$resAttrSelection = $db->get_a_line($attrSelection);
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value'] : '';	
							
												
											}											
											?>
                            <div class="col-sm-8">
                              <select class="select2 form-control" name="customattriben_<?php echo $val["attribute_type"] ?>_<?php echo  $val["attributeid"]; ?>">
                                <option value=''>--Select--</option>
                                <?php
														foreach($resDropdown as $dropdownVal){															
														?>
                                <option value="<?php echo $dropdownVal['dropdown_id'] ?>"
														
														<?php echo ($dropdownVal["dropdown_id"] == $defautValue)? " selected='selected' ":''; ?>
														> <?php echo $dropdownVal['dropdown_values']; ?> </option>
                                <?php
														}
														?>
                              </select>
                            </div>
                            <?php 
										  }			  
										  ?>
                          </div>
						  
						  
						  <!--spanish-->
						  <?php 
						   //echo "select attributeid from ".TPLPrefix."m_attributes where parent_id = '".$val["attributeid"]."' and lang_id = 2";
						   
						  $get_es_attrid = $db->get_a_line("select attributeid from ".TPLPrefix."m_attributes where parent_id = '".$val["attributeid"]."' and lang_id = 2");
						$attrId_es = $get_es_attrid['attributeid'];?>
						
						  <div class="row">
                          <label class="col-sm-3 control-label"><?php echo Spanish; ?> <?php echo  $val["attributename"]; ?></label>
						  
                          <?php if($val["attribute_type"] == "text"){
											if($edit_id != ''){
											  	$attrSelection = " SELECT attribute_value FROM  `".TPLPrefix."product_attr_varchar` where masterproduct_id ='".$edit_id."' and attribute_id = '".$attrId_es."' and lang_id = 2 ";
												$resAttrSelection = $db->get_a_line($attrSelection);												
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';
											}
										  ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <label>
                                <input class="form-control " name="customattribes_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_es; ?>" value="<?php echo $defautValue; ?>">
                              </label>
                            </div>
                          </div>
                          <?php 
										 }
										  else if($val["attribute_type"] == "textarea"){
											if($edit_id != ''){
												$attrSelection = " SELECT attribute_value FROM  `".TPLPrefix."product_attr_varchar` where masterproduct_id ='".$edit_id."' and attribute_id = '".$attrId_es."' and lang_id = 2";
												$resAttrSelection = $db->get_a_line($attrSelection);												
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';
											}
										  ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <label>
                                <textarea class="form-control texteditor" name="customattribes_<?php echo $val["attribute_type"] ?>_<?php echo $attrId_es; ?>" ><?php echo $defautValue; ?></textarea>
                              </label>
                            </div>
                          </div>
                          <?php 
										 }
										 else if($val["attribute_type"] == "checkbox"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_es."' and t1.isactive=1 and t1.lang_id = 2";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
										 ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <?php
													if($edit_id != ''){
														$attrSelection = "SELECT group_concat(dropdown_id) as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_es."' and lang_id = 2";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? explode(",",$resAttrSelection['attribute_value']): array();														
													}													
													foreach($resDropdown as $dropdownVal){									
													?>
                              <label>
                                <input type="checkbox" class="form-control " name="customattribes_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_es; ?>[]" value="<?php echo $dropdownVal['dropdown_id']; ?>"
													
													
													<?php 
													echo (in_array($dropdownVal['dropdown_id'],$defautValue))? " checked='checked' ":"";?>
													
													>
                                <span class="checkbox-material"> <span class="check"></span> </span> </label>
                              <?php 
														echo $dropdownVal['dropdown_values'];
													}
												  ?>
                            </div>
                          </div>
                          <?php 
										 }
										 else if($val["attribute_type"] == "radio"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_es."' and t1.isactive=1 and t1.lang_id = 2";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
										 ?>
                          <div class="col-sm-8">
                          <?php
													if($edit_id != ''){
														$attrSelection = "SELECT dropdown_id as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_es."' and IsActive=1 and lang_id = 2 ";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';				
													}													
													foreach($resDropdown as $dropdownVal){									
													?>
                          <div class="radio radio-primary">
                            <label>
                              <input type="radio" class="" name="customattribes_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_es; ?>"  value="<?php echo $dropdownVal['dropdown_id']; ?>" >
                              <span class="circle m-t-6"></span><span class="check m-t-6"></span>
                              <?php
													 echo $dropdownVal['dropdown_values'];
													 ?>
                            </label>
                            <div>
                              <?php } ?>
                            </div>
                            <?php 
										 }
										 else if($val["attribute_type"] == "multiselect"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_es."' and t1.lang_id = 2 ";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
											if($edit_id != ''){
														$attrSelection = "SELECT group_concat(dropdown_id) as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_es."' and IsActive=1 and lang_id = 2";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? explode(",",$resAttrSelection['attribute_value']) : array();															
												}
											?>
                            <div class="col-sm-8">
                              <select class="select2 form-control" name="customattribes_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_es; ?>[]"  multiple>
                                <?php
														
														
														foreach($resDropdown as $dropdownVal){													
														?>
                                <option value="<?php echo $dropdownVal['dropdown_id'] ?>"
														
														<?php 
															echo (in_array($dropdownVal['dropdown_id'],$defautValue))? " selected='selected' ":"";?>
														> <?php echo $dropdownVal['dropdown_values']; ?> </option>
                                <?php
														}
														?>
                              </select>
                            </div>
                            <?php 
										  }	
										 else{	
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$val['attributeid']."' and t1.lang_id = 2";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
											if($edit_id != ''){
												$attrSelection = "SELECT dropdown_id as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_es."' and IsActive=1 and lang_id = 2";
												$resAttrSelection = $db->get_a_line($attrSelection);
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value'] : '';	
							
												
											}											
											?>
                            <div class="col-sm-8">
                              <select class="select2 form-control" name="customattribes_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_es; ?>">
                                <option value=''>--Select--</option>
                                <?php
														foreach($resDropdown as $dropdownVal){															
														?>
                                <option value="<?php echo $dropdownVal['dropdown_id'] ?>"
														
														<?php echo ($dropdownVal["dropdown_id"] == $defautValue)? " selected='selected' ":''; ?>
														> <?php echo $dropdownVal['dropdown_values']; ?> </option>
                                <?php
														}
														?>
                              </select>
                            </div>
                            <?php 
										  }			  
										  ?>
                          </div>
						  <!--end spanish-->
						  
						   <?php $get_pt_attrid = $db->get_a_line("select attributeid from ".TPLPrefix."m_attributes where parent_id = '".$val["attributeid"]."' and lang_id = 3");
						$attrId_pt = $get_pt_attrid['attributeid'];
						?>
						   <!--portugues-->
						  <div class="row">
                          <label class="col-sm-3 control-label"><?php echo Portuguese; ?> <?php echo  $val["attributename"]; ?></label>
						  
                          <?php if($val["attribute_type"] == "text"){
											if($edit_id != ''){
												$attrSelection = " SELECT attribute_value FROM  `".TPLPrefix."product_attr_varchar` where masterproduct_id ='".$edit_id."' and attribute_id = '".$attrId_pt."' and lang_id = 3 ";
												$resAttrSelection = $db->get_a_line($attrSelection);												
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';
											}
										  ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <label>
                                <input class="form-control " name="customattribpt_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_pt; ?>" value="<?php echo $defautValue; ?>">
                              </label>
                            </div>
                          </div>
                          <?php 
										 }
										  else if($val["attribute_type"] == "textarea"){
											if($edit_id != ''){
												$attrSelection = " SELECT attribute_value FROM  `".TPLPrefix."product_attr_varchar` where masterproduct_id ='".$edit_id."' and attribute_id = '".$attrId_pt."' and lang_id = 3";
												$resAttrSelection = $db->get_a_line($attrSelection);												
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';
											}
										  ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <label>
                                <textarea class="form-control texteditor" name="customattribpt_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_pt; ?>" ><?php echo $defautValue; ?></textarea>
                              </label>
                            </div>
                          </div>
                          <?php 
										 }
										 else if($val["attribute_type"] == "checkbox"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_pt."' and t1.isactive=1 and t1.lang_id = 3";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
										 ?>
                          <div class="col-sm-8">
                            <div class="checkbox icheck">
                              <?php
													if($edit_id != ''){
														$attrSelection = "SELECT group_concat(dropdown_id) as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_pt."' and lang_id =3";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? explode(",",$resAttrSelection['attribute_value']): array();														
													}													
													foreach($resDropdown as $dropdownVal){									
													?>
                              <label>
                                <input type="checkbox" class="form-control " name="customattribpt_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_pt; ?>[]" value="<?php echo $dropdownVal['dropdown_id']; ?>"
													
													
													<?php echo (in_array($dropdownVal['dropdown_id'],$defautValue))? " checked='checked' ":"";?>
													
													>
                                <span class="checkbox-material"> <span class="check"></span> </span> </label>
                              <?php 
														echo $dropdownVal['dropdown_values'];
													}
												  ?>
                            </div>
                          </div>
                          <?php 
										 }
										 else if($val["attribute_type"] == "radio"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_pt."' and t1.isactive=1 and t1.lang_id = 3";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
										 ?>
                          <div class="col-sm-8">
                          <?php
													if($edit_id != ''){
														$attrSelection = "SELECT dropdown_id as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_pt."' and IsActive=1 and lang_id = 3 ";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value']: '';				
													}													
													foreach($resDropdown as $dropdownVal){									
													?>
                          <div class="radio radio-primary">
                            <label>
                              <input type="radio" class="" name="customattribpt_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_pt; ?>"  value="<?php echo $dropdownVal['dropdown_id']; ?>" >
                              <span class="circle m-t-6"></span><span class="check m-t-6"></span>
                              <?php
													 echo $dropdownVal['dropdown_values'];
													 ?>
                            </label>
                            <div>
                              <?php } ?>
                            </div>
                            <?php 
										 }
										 else if($val["attribute_type"] == "multiselect"){
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_pt."' and t1.lang_id = 3 ";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
											if($edit_id != ''){
														$attrSelection = "SELECT group_concat(dropdown_id) as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_pt."' and IsActive=1 and lang_id = 3";
														$resAttrSelection = $db->get_a_line($attrSelection);
														$defautValue =  (isset($resAttrSelection['attribute_value']))? explode(",",$resAttrSelection['attribute_value']) : array();															
												}
											?>
                            <div class="col-sm-8">
                              <select class="select2 form-control" name="customattribpt_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_pt; ?>[]"  multiple>
                                <?php
														
														
														foreach($resDropdown as $dropdownVal){													
														?>
                                <option value="<?php echo $dropdownVal['dropdown_id'] ?>"
														
														<?php  echo (in_array($dropdownVal['dropdown_id'],$defautValue))? " selected='selected' ":"";?>
														> <?php echo $dropdownVal['dropdown_values']; ?> </option>
                                <?php
														}
														?>
                              </select>
                            </div>
                            <?php 
										  }	
										 else{	
											$dropdownStr = "SELECT * 
														FROM  `".TPLPrefix."dropdown` t1 
														WHERE t1.attributeId ='".$attrId_pt."' and t1.lang_id = 3";		
											$resDropdown = $db->get_rsltset($dropdownStr); 
											if($edit_id != ''){
												$attrSelection = "SELECT dropdown_id as attribute_value FROM  `".TPLPrefix."product_attr_dropdwid` where product_id ='".$edit_id."' and attribute_id = '".$attrId_pt."' and IsActive=1 and lang_id = 3";
												$resAttrSelection = $db->get_a_line($attrSelection);
												$defautValue =  (isset($resAttrSelection['attribute_value']))? $resAttrSelection['attribute_value'] : '';	
							
												
											}											
											?>
                            <div class="col-sm-8">
                              <select class="select2 form-control" name="customattribpt_<?php echo $val["attribute_type"] ?>_<?php echo  $attrId_pt; ?>">
                                <option value=''>--Select--</option>
                                <?php
														foreach($resDropdown as $dropdownVal){															
														?>
                                <option value="<?php echo $dropdownVal['dropdown_id'] ?>"
														
														<?php echo ($dropdownVal["dropdown_id"] == $defautValue)? " selected='selected' ":''; ?>
														> <?php echo $dropdownVal['dropdown_values']; ?> </option>
                                <?php
														}
														?>
                              </select>
                            </div>
                            <?php 
										  }			  
										  ?>
                          </div>
						  <!--end portugues-->
                          <?php
								}	
								?>
                        </fieldset>
                       
 <?php		
							}		
							?>
                        <?php	
		
							if(searchkeyvalue("IsConfigureProduct",$configinfo)==1) { 		
								$str = "SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and  t2.IsActive =1
										INNER JOIN ".TPLPrefix."attributegroup gp ON gp.attribute_groupID = t1.attribute_groupID and  gp.IsActive =1
										WHERE t1.attribute_groupID ='".$_SESSION['attribute_Mapid']."' AND t1.IsActive =1 and t1.isCombined = 1  ";
								if(isset($res_ed['attributeMapId']) && $res_ed['attributeMapId']>0 ){
									$str = "SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and  t2.IsActive =1
										INNER JOIN ".TPLPrefix."attributegroup gp ON gp.attribute_groupID = t1.attribute_groupID and  gp.IsActive =1
										WHERE t1.attribute_groupID ='".$res_ed['attributeMapId']."' AND t1.IsActive =1 and t1.isCombined = 1  ";
								}
								if($_SESSION['attribute_Mapid']=='' && $edit_id!='' && ($res_ed['attributeMapId']=='' || $res_ed['attributeMapId']==0) )
								{
									 $str = "SELECT *
										FROM `".TPLPrefix."attributes` t1
										INNER JOIN ".TPLPrefix."m_attributes t2 ON t1.attributeID = t2.attributeID and  t2.IsActive =1
										INNER JOIN ".TPLPrefix."dropdown t3 ON t3.attributeID = t1.attributeID and t3.IsActive=1
										Left JOIN ".TPLPrefix."product_attr_combi p_combi ON p_combi.attr_combi_id = t3.dropdown_id  and p_combi.IsActive=1
										Left JOIN ".TPLPrefix."product p ON p.product_id = p_combi.base_productId  and p.IsActive<>2 and p.product_id ='".$edit_id."' 
										WHERE  t1.IsActive =1 and t1.isCombined = 1  and t1.lang_id = 1 group by t1.attributeID 
										";
								   	}
								
							//	echo $str; 
								$resAttrib = $db->get_rsltset($str); 
								// echo "<pre>";
								//print_r($str); 
								
							$arrselectdropdown=array();	
						if($edit_id != ""){
							$alreadyCombi = "SELECT * FROM  `".TPLPrefix."product_attr_combi` where base_productId =  '".$edit_id."' and IsActive=1 ";	
							$selectedDropdown = $db->get_rsltset($alreadyCombi);
						//print_r($selectedDropdown); die();
							foreach($selectedDropdown as $val){
							//	echo $val['attr_combi_id']	."<br>";
							// $arrselectdropdown[]=$val['attr_combi_id'];
							$str_arr = explode (",", $val['attr_combi_id']); 							
								if(count($str_arr) > 1){
									foreach($str_arr as $value) {
										array_push($arrselectdropdown, $value);
									}
								}else{
									$arrselectdropdown[]=$val['attr_combi_id'];	
								}
						    }
						}
								$counter = 0;
								 
								?>
                         
                        
                        <?php 						 					
							$str_ed_images = "SELECT * FROM  `".TPLPrefix."product_images` where product_id = '".$edit_id."' and  IsActive=1 order by ordering asc ";
							$resprodimags = $db->get_rsltset($str_ed_images); 	
								
						if($edit_id != ""){
							
					 	  	$alreadyCombi = "SELECT pa.*,d.attributeId,ma.attributename,(CHAR_LENGTH(`attr_combi_id`) - CHAR_LENGTH(REPLACE(attr_combi_id, ',', '')) + 1) as attrcount FROM  `".TPLPrefix."product_attr_combi` pa inner join `".TPLPrefix."dropdown` d on d.dropdown_id = pa.attr_combi_id inner join `".TPLPrefix."m_attributes` ma on ma.attributeid = d.attributeId where pa.base_productId =  '".$edit_id."' and pa.IsActive=1 order by d.attributeId,(CHAR_LENGTH(`attr_combi_id`) - CHAR_LENGTH(REPLACE(attr_combi_id, ',', '')) + 1)  asc ";	
							$resDropdown = $db->get_rsltset($alreadyCombi); 												
							$counter = 0;
							$issingle= 0;
							$attributename = '';
							foreach($resDropdown as $val){
								if($val ['attrcount'] <= 1){
										$issingle = 1;
								}else{
									$issingle = 0;
								}
									
								//$val['attr_combi_id']=str_replace(",","_",$val['attr_combi_id']);
								 
							
							if($attributename == '' || $attributename != $val['attributename']){
							?>
							<h4><?php echo ($val ['attrcount'] <= 1) ? $val['attributename'] : 'Combination Price';?></h4>
							<?php }?>
							
                        <div class="combinationresult row col-md-12" id="addedAttrCollection_<?php echo $counter; ?>">
                        
                        <?php 
								$counter++;
								$attributename = $val['attributename'];
							}
						}
						?>
						
                        <div id="combinationCollection">
                          <label></label>
                        </div>
						
                        <fieldset >
                          <legend>
                          <h4>Combination Collection</h4>
                          </legend>
                        </fieldset>
                        <?php } ?>
                        <div class="row">
                          <label class="col-sm-3 control-label">Tax</label>
                          <div class="col-sm-6"> <?php echo getSelectBox_Taxlist($db,'tax_id','',$res_ed['taxId']); ?> </div>
                        </div>
                        <div class="row">
                          <label class="col-sm-3 control-label">Images<span class="reqfield">*</span></label>
                          <div class="col-sm-9 mb-4">
                            <div class="form-upload product_img">
                              <div class="dropzone" id="dropzone">
                                <input class="product_images" id="product_images" <?php if($act == "insert"){?> required <?php }?> name="product_images[]" type="file" fi-type="" multiple="multiple" >
                              </div>
                              <small >Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small> </div>
                            <div class="form-upload" id="uploadedProducts"> </div>
                          </div>
                        </div>
                  
                    <!--    <div class="row">
                          <label class="col-sm-3 control-label">Is Customized</label>
                          <div class="col-sm-6 mb-4">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"   class="new-control-input"  name="iscustomized" id="iscustomizedimg" <?php echo $iscustomchk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <div id="customizedproductimage" style="<?php echo $res_ed['iscustomized']!="1"? 'display:none':'display:block';?>">
                              <label class="col-sm-4 control-label">Customized Image<span class="reqfield">*</span></label>
                              <div class="col-sm-12">
                                <div class="form-upload product_img">
                                  <div class="dropzone">
                                    <input id="customizedproductimg" name="uploadecustomizedimg" type="file"  class="customizedproductimg common_upload_style" onchange="return imageformatcheck(this.value,'image')">
                                  </div>
                                  <small >Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidths.'*'.$imgheights; ?>) </small> </div>
                                <br/>
                                <?php 
						if (!empty($res_ed['uploadecustomizedimg']) && ($act == 'update')) { 
						  if(file_exists("../uploads/customizedproduct/".$res_ed['uploadecustomizedimg']))
						   { ?>
                                <img src="../uploads/customizedproduct/<?php echo $res_ed['uploadecustomizedimg']; ?>" width="100px" align="absmiddle"/>
                                <?php
						   }
						   else{ ?>
                                <img src="../uploads/NoImageAvailable.png" width="100px" align="absmiddle"/>
                                <?php }
						 } 
						 ?>
                              </div>
                            </div>
                          </div>
                        </div>-->
						
						<div class="row">
                          <label class="col-sm-3 control-label">Is Color based image </label>
                          <div class="col-sm-6 mb-4">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"   class="new-control-input"   id="iscolorimage" name="iscolorimage" <?php echo $iscolorimage; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <label class="col-sm-3 control-label">Is Buy Now </label>
                          <div class="col-sm-6 mb-4">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"   class="new-control-input"   id="isbuynow" name="isbuynow" <?php echo $isbuynow; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                          </div>
                        </div>
						
						  <div class="row" id="photos">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Brochure</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
						   <input accept=".pdf" fi-type="pdf" class="common_upload_style_pdf <?php if($act != 'update'){?><?php }?>" id="brochureimage" name="brochureimage" type="file"  >
							Allowed Extension (Pdf )
                            <p class="help-block"></p>
                          </div>
						   <div id="ProductBrochure_div">
                           <?php 
								if (!empty($res_ed['brochureimage']) && ($act == 'update')) {?>		
<?php echo $res_ed['brochureimage'];?>								
						  <a onclick="delProductBrochure('<?php echo $edit_id; ?>')" href="javascript:void(0);">X</a>
		         		 <?php }?>	
                     </div>
                        </div>
                      </div>
                    </div>
					 
					  <div class="row" id="photos_es">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Brochure</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
						   <input accept=".pdf" fi-type="pdf" class="common_upload_style_pdf <?php if($act != 'update'){?><?php }?>" id="brochureimage_es" name="brochureimage_es" type="file"  >
							Allowed Extension (Pdf )
                            <p class="help-block"></p>
                          </div>
						   <div id="ProductBrochure_div_es">
                           <?php 
								if (!empty($res_ed_es['brochureimage']) && ($act == 'update')) {?>		
<?php echo $res_ed_es['brochureimage'];?>								
						  <a onclick="delProductBrochure('<?php echo $res_ed_es['productId']; ?>')" href="javascript:void(0);">X</a>
		         		 <?php }?>	
                     </div>
                        </div>
                      </div>
                    </div>
					
						  <div class="row" id="photos_pt">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Brochure</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
						   <input accept=".pdf" fi-type="pdf" class="common_upload_style_pdf <?php if($act != 'update'){?><?php }?>" id="brochureimage_pt" name="brochureimage_pt" type="file"  >
							Allowed Extension (Pdf )
                            <p class="help-block"></p>
                          </div>
						   <div id="ProductBrochure_div_pt">
                           <?php 
								if (!empty($res_ed_es['brochureimage']) && ($act == 'update')) {?>		
<?php echo $res_ed_pt['brochureimage'];?>								
						  <a onclick="delProductBrochure('<?php echo $res_ed_pt['productId']; ?>')" href="javascript:void(0);">X</a>
		         		 <?php }?>	
                     </div>
                        </div>
                      </div>
                    </div>
                        
                       <!-- <div class="row">
                          <label class="col-sm-3 control-label">Is Featured Product </label>
                          <div class="col-sm-6 mb-4">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"   class="new-control-input"   id="isfeatured" name="isfeatured" <?php echo $isfeatured; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                          </div>
                        </div>
						-->                                             
                    <?php
					$suggested_products = array();	
					if($res_ed["suggested_products"])			 
						$suggested_products = $res_ed["suggested_products"];
					
					$relatedProducts = '';			 
					if($res_ed["related_products"])			 
						$relatedProducts = $res_ed["related_products"];
					?>
                        <input type="hidden" id="relatedproductIds" name="relatedproductIds" value="<?php echo (!empty($relatedProducts))? $relatedProducts:"" ; ?>"  />
                        <input type="hidden" id="suggestedProductIds" name="suggestedProductIds" value="<?php echo (!empty($suggested_products))? $suggested_products:"" ; ?>"  />
                      </form>
                      
                      <!-- /.box-body -->
                      <div class="row">
                        <div class="col col-md-3">
                          <div class="control-group mb-4"> &nbsp; </div>
                        </div>
                        <div class="col col-md-6">
                          <div class="control-group mb-4">
                            <div class="controls">
                              <?php if($id == ""){ ?>
                              <button type="button"  class="btn btn-primary btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmtWithImg('frmProduct','product_actions.php','jvalidate','product','product_form.php');" ><span id="spSubmit"><i class="fa fa-save"></i> Save & Continue</span></button>
                              <?php } ?>
                              <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmtWithImg('frmProduct','product_actions.php','jvalidate','product','product_mng.php');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                              <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmProduct','jvalidate','product','product_mng.php');">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- /.box-footer --> 
                      
                    </div>
                    <!-- general Info - END --> 
                    
                    <!--related Info - START -->
                    <div class="tab-pane" id="relatedpro">
                      <div class="row">
                        <div class="col-md-5">
                          <h4>Related product</h4>
                        </div>
                        <div class="col-md-7 align-right padding-top-10px"> <span class="adv_filterbutton" id="hidefillterbtn"> <span id="advance_filtertxt" class="btn btn-primary btn-rounded mb-4 mr-2"><i class="fa fa-filter"></i> Advanced Filter</span> <span id="closefilter" class="btn btn-dark btn-rounded mb-4 mr-2" style="display:none;"><i class="fa fa-times"></i> Close</span> </span> </div>
                      </div>
                      <div class="row box-body fillterbtn" id="relatedProductElement" style="" >
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Product Name </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control " type="text" name="product_name" placeholder="Product Name" id="product_name" />
                          </div>
                          <label class="col-sm-2 control-label">Sku </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control " placeholder="SKU" type="text" name="sku" id="sku" />
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Category </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control " type="text" placeholder="Category" name="category_name" id="category_name" />
                          </div>
                          <label class="col-sm-2 control-label">Attribute Group </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control" type="text" placeholder="Attribute Group" name="attribute_groupName" id="attribute_groupName" />
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Price </label>
                          <div class="col-sm-2">
                            <input class=" form-control numericvalidate" type="text" name="pricefrom" id="pricefrom" placeholder="From" />
                          </div>
                          <div class="col-sm-2">
                            <input class=" form-control numericvalidate" type="text" name="priceto" id="priceto" placeholder="To" />
                          </div>
                          <label class="col-sm-2 control-label">Quantity </label>
                          <div class="col-sm-2">
                            <input class=" form-control" type="text" name="quantityfrom" placeholder="From" />
                          </div>
                          <div class="col-sm-2">
                            <input class=" form-control" type="text" name="quantityto" placeholder="To" />
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Status </label>
                          <div class="col-sm-2">
                            <select class=" form-control product_mangement" name="status">
                              <option value ="-1">All</option>
                              <option value ="1">Active</option>
                              <option value ="0">In Active</option>
                            </select>
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <div class="row col-sm-9"> </div>
                          <div class="row col-sm-3">
                            <input type="button" class="btn btn-outline-primary mb-4 mr-2" value="Search Filters" onClick="advanceSearchRelated()" />
                          </div>
                        </div>
                      </div>
                      
                      <!-- related Info - END -->
                      
                      <div class="row">
                        <div class="col-md-12">
                          <div class="box"> 
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table id="tblresultRelated" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>&nbsp;</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Attribute Group</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                              <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>"  />
                              <div class="row">&nbsp;</div>
                              <div class="row">
                                <div class="col col-md-9">
                                  <div class="control-group mb-4"> &nbsp; </div>
                                </div>
                                <div class="col col-md-3" align="right">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmtWithImg('frmProduct','product_actions.php','jvalidate','product','product_form.php?act=edit&id=<?php echo $_REQUEST['id']; ?>');" ><span id="spSubmit"><?php echo $btn; ?></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer"> </div>
                            <!-- /.box-footer --> 
                            
                          </div>
                          <!-- /.box-body --> 
                        </div>
                        <!-- /.box --> 
                        
                      </div>
                      <!-- /.col --> 
                    </div>
                    
                    <!-- suggest Product Info - START -->
                    <div class="tab-pane" id="suggestedpro">
                      <div class="row">
                        <div class="col-md-5">
                          <h4>Suggested product</h4>
                        </div>
                        <div class="col-md-7 align-right padding-top-10px"> <span class="adv_filterbutton" id="hidefillterbtns"> <span id="advance_filtertxts" class="btn btn-primary btn-rounded mb-4 mr-2"><i class="fa fa-filter"></i> Advanced Filter</span> <span id="closefilters" class="btn btn-dark btn-rounded mb-4 mr-2" style="display:none;"><i class="fa fa-times"></i> Close</span> </span> </div>
                      </div>
                      <div class="row box-body fillterbtn" id="suggestedProductElement" style="" >
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Product Name </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control " type="text" name="product_name" placeholder="Product Name" id="product_name" />
                          </div>
                          <label class="col-sm-2 control-label">Sku </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control " placeholder="SKU" type="text" name="sku" id="sku" />
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Category </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control " type="text" placeholder="Category" name="category_name" id="category_name" />
                          </div>
                          <label class="col-sm-2 control-label">Attribute Group </label>
                          <div class="col-sm-4">
                            <input class="pFilters form-control" type="text" placeholder="Attribute Group" name="attribute_groupName" id="attribute_groupName" />
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Price </label>
                          <div class="col-sm-2">
                            <input class=" form-control numericvalidate" type="text" name="pricefrom" id="pricefrom" placeholder="From" />
                          </div>
                          <div class="col-sm-2">
                            <input class=" form-control numericvalidate" type="text" name="priceto" id="priceto" placeholder="To" />
                          </div>
                          <label class="col-sm-2 control-label">Quantity </label>
                          <div class="col-sm-2">
                            <input class=" form-control" type="text" name="quantityfrom" placeholder="From" />
                          </div>
                          <div class="col-sm-2">
                            <input class=" form-control" type="text" name="quantityto" placeholder="To" />
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <label class="col-sm-2 control-label">Status </label>
                          <div class="col-sm-2">
                            <select class=" form-control product_mangement" name="status">
                              <option value ="-1">All</option>
                              <option value ="1">Active</option>
                              <option value ="0">In Active</option>
                            </select>
                          </div>
                        </div>
                        <div class="row col-md-12">&nbsp;</div>
                        <div class="row col-sm-12">
                          <div class="row col-sm-9"> </div>
                          <div class="row col-sm-3">
                            <input type="button" class="btn btn-outline-primary mb-4 mr-2" value="Search Filters" onClick="advanceSearchSuggested()" />
                          </div>
                        </div>
                      </div>
                      
                      <!-- suggest Product Info - END -->
                      
                      <div class="row">
                        <div class="col-md-12">
                          <div class="box"> 
                            <!-- /.box-header -->
                            <div class="box-body"> 
                              <!-- /.box-header -->
                              <div class="box-body">
                                <table id="tblresultSuggested" class="table table-bordered table-striped">
                                  <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "suggestedProduct"; ?>" />
                                  <thead>
                                    <tr>
                                      <th>&nbsp;</th>
                                      <th>Product Name</th>
                                      <th>Description</th>
                                      <th>Attribute Group</th>
                                      <th>Sku</th>
                                      <th>Price</th>
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                              <!-- /.box-body -->
                              <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>"  />
                              <div class="row">&nbsp;</div>
                              <div class="row">
                                <div class="col col-md-9">
                                  <div class="control-group mb-4"> &nbsp; </div>
                                </div>
                                <div class="col col-md-3" align="right">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button"  onClick="javascript:funSubmtWithImg('frmProduct','product_actions.php','jvalidate','product','product_form.php?act=edit&id=<?php echo $_REQUEST['id']; ?>');" ><span id="spSubmit"><?php echo $btn; ?></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.box-footer --> 
                        
                      </div>
                      <!-- /.box-body --> 
                    </div>
                    <!-- /.box --> 
                  </div>
                  <!-- customer Review Parameter Info - END --> 
                  
                </div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/js/multiple-select.js"></script>
<script src="assets/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/js/bootstrap-tagsinput-angular.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap-tagsinput.css">

<script>

jQuery(document).ready(function(){	


$("#hidefillterbtn").hide();
$("#hidefillterbtns").hide();
$("#relatedProductElement").hide();
$("#suggestedProductElement").hide();

$("#related").click(function(){
	$("#hidefillterbtn").show();
	$("#hidefillterbtns").hide();
});
$("#suggested").click(function(){
	$("#hidefillterbtns").show();
	$("#hidefillterbtn").hide();
});
$("#generals").click(function(){
	$("#hidefillterbtn").hide();
	$("#hidefillterbtns").hide();
});

$('#tree').jstree({
    'plugins': ["wholerow", "checkbox", "types"],
	 
    "core" : {
        "themes" : {
            "responsive": false
        }, 
         "check_callback" : true,
          'data' : {
                "url" : 'common/ajax-functions.php?hdnact=categoryliststree&id=<?php echo base64_encode($res_ed['product_id']); ?>',
                "plugins" : [ "wholerow", "checkbox" ],
                "dataType" : "json" // needed only if you do not supply JSON headers
            },
			expand_selected_onload : false
    },

    "types" : {
        "default" : {
            "icon" : "fa fa-folder"
        },
        "file" : {
            "icon" : "fa fa-file"
        }
    },
 });
 


	datatblCalSuggested(dataGridHdn);
	datatblCalRelated(dataGridHdn);
	$("#product_images").filer({
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
	
	
	
	
	//$("#attribute_id").change(function(){
	//	attributeCollection($(this).val());
	//});	
	//attributeCollection($("#attribute_id").val());
	$('#categoryID').multipleSelect({width: '100%', multipleWidth: 55});	
	
	
	
	if($("#specialprice").val() != ""){
		spPrice($("#specialprice").val());
	}
		
	$("#specialprice").blur(function(){
		spPrice($(this).val());
	});
	
	 var date = new Date();
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
	/*$('#newprod_fromdate,#newprod_todate').datepicker({					
				dateFormat: "mm-dd-yy",				
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+20",
				maxDate: new Date			
	});*/
	
	
	 
	
	/*$('#spl_fromdate,#spl_todate').datepicker({					
				dateFormat: "mm-dd-yy",				
                changeMonth: true,
                changeYear: true,
				autoclose: true,
				startDate: today,
                yearRange: "-100:+20",
				maxDate: new Date			
	});*/
	/*$.validator.addMethod("spl_todate", function(value, element) {
	  if(value.length  > 0){
		  if( $("#spl_fromdate").val() >  value ) {
			 return false;  
		  }		  
	  }
	  return true;
	}, "To date must be greater than from date");*/
	
	$.validator.addMethod("newprod_todate", function(value, element) {
	  if(value.length  > 0){
		  if( $("#newprod_fromdate").val() >  value ) {
			 return false;  
		  }		  
	  }
	  return true;
	}, "To date must be greater than from date");
	
	 if($("#isnewproduct").is(":checked")){	  
		
		$("#newprodfromtodate").show();
	}
 <?php if($_REQUEST['act']!='edit'	) { ?>	
	if($("#configqua").attr("checked", "true")){
		//alert("checked");
		$("#configQuanitity").show();
	}
 <?php } ?>	
	$("#configqua").change(function(){
		if($(this).is(":checked")){			
			//alert("yes true");
			$("#configQuanitity").slideDown();
		}
		else{
			//alert("yes false");
			$("#configQuanitity").slideUp();
		}
		
		/*if($("#isnewproduct").attr("checked", "true"))	
			$("#newprodfromtodate").show();
		else
			$("#newprodfromtodate").hide();	
	*/
		
	});
	
	
	
	$("#isnewproduct").change(function(){
		if($(this).is(":checked")){			
			  
			$("#newprodfromtodate").slideDown();
		}
		else{
			 
			$("#newprodfromtodate").slideUp();
		}
		
	});
	
	
	$("#iscustomizedimg").change(function(){
		if($(this).is(":checked")){			
			//alert("yes true");
			$("#customizedproductimage").slideDown();
		}
		else{
			//alert("yes false");
			$("#customizedproductimage").slideUp();
		}
		
	});
	

	
	
	$(".tree .expander").eq(0).remove();
	<?php if($edit_id != ""){ ?>		
		getProductImages('<?php echo base64_encode($edit_id); ?>');
	<?php } ?>
	
	
	$('.alphaonly').bind('keyup blur',function(){ 
		var node = $(this);
		node.val(node.val().replace(/[^a-z0-9A-Z_-]/g,'') ); 
	});
	
	/*$(".categoryCollection .iCheck-helper").click(function(){		
		if(!$(this).parent().parent().find('.expander').eq(0).hasClass("expanded")){
			$(this).parent().parent().find('.expander').eq(0).trigger("click");
		}		
	}) */
	
	var attributeCombination = [];
	var counter = 0;
	$("#generateCombination").click(function(){
				
 
		//var n  = $("#attributeCollection input:checked").length;
		
		var n  = $("#attributeCollection input:checkbox.selchks:checked").length;		
		var c = 1;
		var k =1;
		var strCode = '';
	//	alert($("#attributeCollection input:checkbox.selchks:checked").length);
		$("#attributeCollection input:checkbox.selchks:checked").each(function(){
			
			
		var attrid = $(this).data("id");
		//alert(attrid)
				//selchkprice
			//	alert($(this).val() +' -- '+$("#attributeCollection input:checkbox.selchkprice"+attrid+":checked").length)
				
				
				if($("#attributeCollection input:checkbox.selchkprice"+attrid+":checked").length == 0){
				
				//if($('.selchkprice input[value="'+$(this).val()+'"]:checked').length == 0){
			  
			//if ($("#attributeCollection input:checkbox.selchkprice."+$(this).val()+").not(':checked')){
			var id = "#customattrib_dropdown_"+$(this).val();	
			//alert(id);			
			selectionCount = 0;
			//console.log(id); 	
			strCode  += "var combiArrTit"+c+" = $('#customtit_"+$(this).val()+"').html();";
			strCode  += "var combiArr"+c+" = [];";
			strCode  += "var combiArrIds"+c+" = [];";	
			
			
		
				 
			$(id+" option:selected").each(function(){		
				if($.trim($(this).val())  != ""){					
					strCode  += " combiArr"+c+"["+selectionCount+"] = '"+$.trim($(this).text())+"'; ";
					strCode  += " combiArrIds"+c+"["+selectionCount+"] = '"+$.trim($(this).val())+"'; ";					
					selectionCount++;
				}
			});
		c++;				
		} else {
			
			
			
		}
		
		k++;
		});		
		/*alert('n'+n)
		alert('k'+k)
		alert('c'+c)*/
		var n=c-1;
		//var strCode = '';
		for(var i=0;i<n;i++){
			strCode += " var var"+i+"=0;";			
		}
		eval(strCode);
		console.log(strCode);
		//return;
		var str = '';
		var last = '';	
		str = '';		
	
	
		
			/**   single wise Price Vartaion  begin  **/
		
		for(i=n;i>0;i--){
		
				last += 'for(var'+i+'=0;var'+i+'<combiArr'+i+'.length;var'+i+'++){';
				
				var temp = ' var tempstrNew = ""; ';
				for(j=1;j<=n;j++){
					temp += ' tempstrNew += combiArrIds'+j+'[var'+j+']+\'_\'; ' ;
				}
				temp += ' if($("#combiqua_"+tempstrNew).length == 0){ ';
								
				var t = temp +' $("#combinationCollection").append(\'<label></label>\');';	
				t += ' var tempstr = ""; ';
				t += ' tempstr += combiArrIds'+i+'[var'+i+']+\'_\'; ' ;
				
			t += ' if(!$("#combiprice_"+tempstr).length){ ';
				t += '$("#combinationCollection").append(\'<div class="row"> \');'
					t += ' $("#combinationCollection").append( \'<label>&nbsp;</label><div class="col col col-md-4"><span class="combination1"><h6 style="font-size:13px">\'+combiArr'+i+'[var'+i+']+" "+\' </h6></span></div><br>\' ); ';
				
				
				//t += ' $("#combinationCollection").append( \'  <br/><span class="combinationsub">Quantity</span> <input type="text" class=" combinationnput" name="combiqua_\'+tempstr+\'" id="combiqua_\'+tempstr+\'" /> \' ); ';
				
				
				
				t += ' $("#combinationCollection").append( \'  <div class="col col col-md-2"><span class="combinationsub">Price  </span> <input type="text"  class="form-control combinationnput" name="combiprice_\'+tempstr+\'" id="combiprice_\'+tempstr+\'"  /></div> \' ); ';
				t += ' $("#combinationCollection").append( \'  <div class="col col col-md-2"><span class="combinationsub">Sku </span> <input type="text" class="form-control combinationnput" name="combisku_\'+tempstr+\'" id="combisku_\'+tempstr+\'" /></div> \' ); ';							
				
				t += ' $("#combinationCollection").append( \' <div class="col col col-md-2"><span class="combinationradio">IsDefault</span> <input type="radio" class="" name="combiIsDefault" value="\'+tempstr+\'"  /></div>   \' ); ';
				t += ' $("#combinationCollection").append( \' <div class="col col col-md-2"><a style="margin-left:5px;"  href="javascript:void(0);"  class="remove_front form-control col-md-4" ><i class="fa fa-trash-o"></i> </a></div> \' ); ';
				
				 t += '$("#combinationCollection").append(\'</div> \');'
				t += '$("#combinationCollection").append(\'<label></label>\');'

				t += ' counter++; } '; 
				
				last +=t+' }';
			last += '	} ';
		} 
			/**    single wise Price Vartaion  begin  */
		
		//$("#combinationCollection").html('');
		
		var overAllCode = "var counter = 0;"+str+last;
	// console.log(overAllCode); 
		eval(overAllCode);
				
		/*$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		 });*/	
		
		var counter = 0;
		$('#combinationCollection label').each(function(){	
		
		   $(this).nextUntil('label').wrapAll('<div class="combinationresult row col-md-12" id="attrCollection_'+counter+'" />');
		   counter++;
		});
		
		//$('#combinationCollection label').remove();
			
			 	/****** combination start ******/
		var b  = $("#attributeCollection input:checkbox.selchkprice:checked").length;		
		var d = 1;
		var strCode_price = '';
		
		
		$("#attributeCollection input:checkbox.selchkprice:checked").each(function(){			
			var idprice = "#customattrib_dropdown_"+$(this).val();				
			selectionCount_price = 0;
			 
			strCode_price  += "var combiArrTit_price"+d+" = $('#customtitprice_"+$(this).val()+"').html();";
			strCode_price  += "var combiArr_price"+d+" = [];";
			strCode_price  += "var combiArrIds_price"+d+" = [];";			
			//$(idprice).find("select option:selected").each(function(){
			//alert(idprice)
			$(idprice+" option:selected").each(function(){		
			
				if($.trim($(this).val())  != ""){		
				//	alert('in');
					strCode_price  += " combiArr_price"+d+"["+selectionCount_price+"] = '"+$.trim($(this).text())+"'; ";
					strCode_price  += " combiArrIds_price"+d+"["+selectionCount_price+"] = '"+$.trim($(this).val())+"'; ";					
					selectionCount_price++;
				}
			});
			d++;			
		});		
		
		//var strCode_price = '';
		for(var a=0;a<b;a++){
			strCode_price += " var var"+a+"=0;";			
		}
		eval(strCode_price);
		 
		var strprice = '';
		var last_price = '';	
		strprice = '';		
		
		/**    Combination Price Vartaion  begin  **/
		 for(a=b;a>0;a--){
			if(a == b){
				last_price += 'for(var'+a+'=0;var'+a+'<combiArr_price'+a+'.length;var'+a+'++){';
				
				var temp_price = ' var temp_pricestrNew = ""; ';
				for(h=1;h<=b;h++){
					temp_price += ' temp_pricestrNew += combiArrIds_price'+h+'[var'+h+']+\'_\'; ' ;
				}
				temp_price += ' if($("#combiqua_"+temp_pricestrNew).length == 0){ ';
								
				var w = temp_price +' $("#combinationCollection").append(\'<label></label>\');';	
				w += ' var temp_pricestr = ""; ';
				
			 
				 
			//	w += ' temp_pricestr +=   \'<div class="col col col-md-4">\' ); ';
		 		 
				for(h=1;h<=b;h++){
					w += ' temp_pricestr += combiArrIds_price'+h+'[var'+h+']+\'_\'; ' ;
					w += ' $("#combinationCollection").append( \'<span class="combination1"><h6 style="font-size:13px">\'+combiArr_price'+h+'[var'+h+']+" "+\'+</h6></span> \' ); ';					
				}
				 //	w += ' $("#combinationCollection").append( \'</div">\' ); ';
			//	w += ' $("#combinationCollection").append( \'  <br/><span class="combinationsub">Quantity</span> <input type="text" class=" combinationnput" name="combiqua_\'+temp_pricestr+\'" id="combiqua_\'+temp_pricestr+\'" /> \' ); ';
			
				w += ' $("#combinationCollection").append( \'</div><div class="col col col-md-2"><span class="combinationsub">Price  </span><input type="text"  class="form-control combinationnput" name="combiprice_\'+temp_pricestr+\'" id="combiprice_\'+temp_pricestr+\'"  /></div>\' ); ';
				
				w += ' $("#combinationCollection").append( \' <div class="col col col-md-2"><span class="combinationsub">SKU <input type="text"  class="form-control combinationnput"name="combisku_\'+temp_pricestr+\'" id="combisku_\'+temp_pricestr+\'" /></div> \' ); ';							
				
				w += ' $("#combinationCollection").append( \' <div class="col col col-md-2"><span class="combinationsub">IsDefault <input type="radio" class="" name="combiIsDefault" value="\'+temp_pricestr+\'"  /> </div>\' ); ';
				
				w += ' $("#combinationCollection").append( \' <div class="col col col-md-2"><a style="margin-left:5px;"  href="javascript:void(0);"  class="remove_front form-control col-md-4" ><i class="fa fa-trash-o"></i> </a></div> \' ); ';
				
				
				//w += ' $("#combinationCollection").append( \' <div class="col col col-md-2"><a style="margin-left:5px;"class="remove_front" href="javascript:void(0);" class="removeAttr" ><i class="fa fa-trash-o"></i> Remove</a> </div> \' ); ';
				
				
				 w += '$("#combinationCollection").append(\'</div> \');'
				w += '$("#combinationCollection").append(\'<label></label>\');'
				
				//w += '$("#combinationCollection").append(\'<label></label>\');'

				w += ' counter++; } '; 
				for(h=0;h<b-1;h++){
					w += ' } ';
				}
				last_price +=w+' }';
			}
			else{
				strprice = ' for(var'+a+'=0;var'+a+'< combiArr_price'+a+'.length;var'+a+'++){ '+strprice;
			}	
		}    
		/**    Combination Price Vartaion  End  **/
		
		
		var overAllCode_price = "var counter1 = 0;"+strprice+last_price;
	//	console.log(overAllCode_price); 
		eval(overAllCode_price);
				
	 
		var counter1 = 0;
		$('#combinationCollection label').each(function(){	
		
		   $(this).nextUntil('label').wrapAll('<div class="combinationresult row col-md-12" id="attrCollection_'+counter1+'"/><div class="col col col-md-6"> ');
		   counter1++;
		});
		
		/****** combination end ******/ 

		
		$(".removeAttr").click(function(){
			$(this).parent().remove();
		})
			
	});
	
	/*$('#dateFrom,#dateTo').datepicker({					
			dateFormat: "mm-dd-yy",				
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+20",
			maxDate: new Date			
	});	*/
	
	//Ajax Autocomplete - starts
		$(".pFilters").each(function(){
			var optValue = $(this);
			var optName = $(this).attr("name");
			var options = {
			  url: function(phrase) {
				return "ajaxresponse.php";
			  },
			  getValue: function(element) {
				return element.name;
			  },
			  ajaxSettings: {
				dataType: "json",
				method: "POST",
				data: {
				  dataType: "json",
				  action : "autocomplete",
				  column : optName
				}
			  },
			  preparePostData: function(data) {
				data.phrase = optValue.val();
				return data;
			  },
			  requestDelay: 400
			};		
			$(this).easyAutocomplete(options);	
		})		
		//Ajax Autocomplete - ends	
		
		
//edit minimum Qty
   $("#configqua").click(function(){		
	
	//var vals = $("#minqtychangevalue").val();
	
    if($(this).is(":checked")){	
         $("#minquantity").attr("readonly", true); 
        // $(".minquantitys").val(vals);
		
		$.ajax({		
			url        : 'ajaxresponse.php',
			method     : 'POST',
			dataType   : 'json',		
			data 	   : 'action=getminqtyvalue',				
	
			success: function(response){ 
				
                $("#minquantity").val(response.values);
			},		
		});	
		
	}
	 else  {
         $("#minquantity").attr("readonly", false); 
	 }
    
	});	


	

});

function spricekeypress(){
	
	 //var price = $("#price").val();
     //var sprice = $("#specialprice").val();
	// alert(sprice);
	 
     var price = $("#price").val();
     var sprice = $("#specialprice").val();	
	 if(parseInt(price)<parseInt(sprice)){
		swal("Failure!","Please Enter below"+" "+price, "warning");	 
		$("#specialprice").val('');
	 }
	 
	
}
function spPrice(val){	
	var spprice = parseInt(val);
	if(spprice > 0 ){
		$("#spfromtodate").show();
	}
	else{
		$("#spfromtodate").hide();
	}
}

function getProductImages(productId){
	$.post("product_actions.php",{productId:productId,getProductImage:'getProductImage'},function(data){
		$("#uploadedProducts").html(data);
	});
}

function attributeCollection(attribute_id){	
	url = "product_actions.php";	
	$.post(url,{attribute_id:attribute_id,"attribCollection":"attribCollection"},function(response){		
		$("#attributeCollection").html(response);
		 $(".select2").select2();
	})
}

function delProductImg(productImgId,pId){		 
	  var action = "deleteImg";	
	  $.post("<?php echo BASE_URL; ?>product_actions.php",{prodImgId:productImgId,"prodId":pId,action:action},function(response){	
				getProductImages(pId);
			}
	  )
}

function setDefault(element,str){
	var elem = $("#combinationCollection");
	var id = "#"+str+"_price";
	if(element.checked){				
		elem.find(id).val(0);
		elem.find(id).prop('disabled',true);
	}
	else{		
		elem.find(id).prop('disabled',false);
	}
}

function addedCollection(combiId,productId,order){
	$.post("<?php echo BASE_URL; ?>ajaxresponse.php",
			{combiId:combiId,productId:productId,action:'delCombination'},
	function(){
		$("#addedAttrCollection_"+order).remove();
		swal("Success!", "Attribute combination deleted suceesfully ", "success");	
	})
}



 function datatblCalSuggested(hdnFld)
	{	 
	    var i=0;
        var dataTable = $('#tblresultSuggested').dataTable( {		
		initComplete: function () {
			if(typeof hdnFld !='undefined'){				
			}	
			unloading(); 
        },					
            "processing": true,
			//aoColumnDefs: [ { bSortable: true, aTargets: [ '_all' ] },{ bSortable: true, aTargets: [0] }],
			"columnDefs": [ { "targets": remove_sorting_columns(), "orderable": false } ],
			"destroy" : true,
            "serverSide": true,
			"stateSave": true,
			"bStateSave" : false,
			"language": { "processing": loading() },
            "ajax":{
                url :"display-grid-data.php?finaltab=suggestedProduct&editId=<?php echo $edit_id ?>", // json datasource
                type: "post",  // method  , by default get
				data: $("#relatedProductElement :input,#relatedProductElement option:selected").serializeArray(), 
                error: function(){  // error handling                  
                    $("#tblresult").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					unloading(); 
                }
            },

        } ); 
		dataTable.on( 'draw.dt', function () {
			setTimeout(function(){
				var productIds = $("#suggestedProductIds").val().split(",");				
				$("#tblresultSuggested :checkbox").each(function(){					
					if($.inArray($.trim($(this).val()),productIds) != -1){
						$(this).prop("checked",true);
					}
				});
				$(".suggestedProducts").on("click",function(){
					if($(this).is(":checked")){
						var productIds;
						if($("#suggestedProductIds").val().length  > 0)
							productIds = $("#suggestedProductIds").val()+","+$(this).val();
						else
							productIds = $(this).val();
					}
					else{
						productIds = $("#suggestedProductIds").val().split(",");
						var currentElement = productIds.indexOf($(this).val());
						if(currentElement > -1){
							productIds.splice(currentElement,1);
						}						
					}
					$("#suggestedProductIds").val(productIds);
				});					
			},1000);
		});
}
function datatblCalRelated(hdnFld)
	{	 
	
	    var i=0;
        var dataTable = $('#tblresultRelated').dataTable( {		
		initComplete: function () {
			if(typeof hdnFld !='undefined'){				
			}	
			unloading(); 
        },					
            "processing": true,
			//aoColumnDefs: [ { bSortable: true, aTargets: [ '_all' ] },{ bSortable: true, aTargets: [0] }],
			"columnDefs": [ { "targets": remove_sorting_columns(), "orderable": false } ],
			"destroy" : true,
            "serverSide": true,
			"stateSave": true,
			"bStateSave" : false,
			"language": { "processing": loading() },
            "ajax":{
                url :"display-grid-data.php?finaltab=relatedProducts&editId=<?php echo $edit_id ?>", // json datasource
                type: "post",  // method  , by default get
				data: $("#relatedProductElement :input,#relatedProductElement option:selected").serializeArray(), 
                error: function(){  // error handling                  
                    $("#tblresult").append('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					unloading(); 
                }
            },

        } ); 
		dataTable.on( 'draw.dt', function () {
			setTimeout(function(){
				var productIds = $("#relatedproductIds").val().split(",");				
				$("#tblresultRelated :checkbox").each(function(){					
					if($.inArray($.trim($(this).val()),productIds) != -1){
						$(this).prop("checked",true);
					}
				});
				
				$(".relatedProducts").on("click",function(){
					var productIds;
					if($(this).is(":checked")){						
						if($("#relatedproductIds").val().length  > 0)
							productIds = $("#relatedproductIds").val()+","+$(this).val();
						else
							productIds = $(this).val();						
					}
					else{
						productIds = $("#relatedproductIds").val().split(",");
						var currentElement = productIds.indexOf($(this).val());
						if(currentElement > -1){
							productIds.splice(currentElement,1);
						}						
					}
					$("#relatedproductIds").val(productIds);
				});	
			},1000);
		});
}

function advanceSearchRelated(){
  datatblCalRelated(dataGridHdn);
}

function advanceSearchSuggested(){
  datatblCalSuggested(dataGridHdn);
}

$(document).ready(function(){
	 
	 $(".adv_filterbutton").click(function(){
		$("#relatedProductElement").fadeToggle(function()
			{
			 $('#closefilter').toggle();
			 $('#advance_filtertxt').toggle();
			});
		
	 });
	 
	 
	  $(".adv_filterbutton").click(function(){
		$("#suggestedProductElement").fadeToggle(function()
			{
			 $('#closefilters').toggle();
			 $('#advance_filtertxts').toggle();
			});
		
	 });
	 
	 
 });
 
 

	

	
</script>
<script>
 
$(function(){/*
	
	 var dateFormat = "<?php echo $GLOBALS['stroedateformat']['dateformat']; ?>",
      from = $( ".sdate_today_min1" )
        .datepicker({
		  dateFormat: dateFormat,
          defaultDate: "+1w",
          changeMonth: true,
		  changeYear: true,
          numberOfMonths: 1,
		  minDate:new Date
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( ".edate_today_min1" ).datepicker({
		dateFormat: dateFormat,
        defaultDate: "+1w",
        changeMonth: true,
		changeYear: true,
        numberOfMonths: 1,
		minDate:new Date
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
	
	
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }	
*/});

$(document).ready(function() {
    $(".numericvalidate").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
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


<!--- specification script ------------->

function add_specification_option(){
	 
		var j = $('#specification_option_count').val() ;
		
		
 	
			$("#specification_option_div").append('<div class="control-group mb-4"> &nbsp; </div><div class="row"  id="specification_row_option'+j+'"><div class="col-sm-4 no-padding-right"><input type="text" class="dropdownClass form-control" name="specificationtitle'+j+'" id="specificationtitle'+j+'" placeholder="Feature Title" /></div><div class="col-sm-4 no-padding-right"><input id="specimage'+j+'" class="featureimages common_upload_style'+j+'"  name="specimage'+j+'" type="file"  onchange="return imageformatcheck(this.value,'+j+')" /></div><div class="col-sm-4 no-padding-right"><textarea  placeholder="Feature Description" id="specvalue'+j+'"  class="form-control" name="specvalue'+j+'"></textarea></div><div class="col-sm-3 no-padding-right"><select class="form-control" name="specalignment'+j+'" id="specalignment'+j+'" required><option value="">Image Alignment</option><option value="1">Left</option><option value="2">Right</option></select></div><div class="col-sm-2 no-padding-right"><input type="text" class="form-control" name="specdropdownSort'+j+'" id="specdropdownSort'+j+'"  placeholder="Feature Sorting" onkeypress="return isNumber(event)" /></div><div class="col-sm-2"> <a class="add_front" href="javascript:add_specification_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp; <a class="remove_front" href="javascript:remove_specification_row_option('+j+');" ><i class="flaticon-delete-1"></i></a> </div></div>');
			
			 	$(".common_upload_style"+j).filer({
					extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
					limit: 1
				});	
			j++;
			$('#specification_option_count').val(j);
			$('#specification_option_max_count').val(j);
}

function remove_specification_row_option(button_id){
	$('#specification_row_option' + button_id + '').remove();
		var jj = $('#specification_option_count').val();
		jj--;
		$('#specification_option_count').val(jj);
}


function remove_specification_option(row,specificationid){
	
	swal({
			title: 'Are you sure?',
			text: "Do you want to delete this row?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
			var urls ="product_actions.php?action=remove_product_feature_option";
				  var m_data = 'specificationid='+specificationid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  if(response.rslt == 1){
							remove_specification_row_option(row);
							$("#specificationoptionDiv").load(location.href+" #specificationoptionDiv>*");
							
							$("#specificationoptionDiv .common_upload_style").filer({
								extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
								limit: 1
							});	 
							
							$('.select2').select2();
			
							swal("Success!", 'Special feature Deleted Successfully', "success");
					  }else{
						  swal("Failure!", 'Error in Special feature deletion', "warning");
					  }
							unloading();
					  }
					});
			
			  }
      })
	 
	} 
	
	function delProductBrochure(pId){		 
	  var action = "deleteBrochure";	
	  $.post("<?php echo BASE_URL_ADMIN;?>product_actions.php",{"prodId":pId,action:action},function(response){	
				//getProductImages(pId);
				$("#ProductBrochure_div").load(location.href+" #ProductBrochure_div>*", function() {
				
                });
			}
	  )
}

function makecheckboxselect(id){	
	var selectcount = $(".seldrp"+id+" :selected").length;
	//alert(selectcount);
	if(selectcount > 0){
		$('.selchk'+id).prop('checked', true);
	}else{
		$('.selchk'+id).prop('checked', false);
	}
}
  
//$(".checkBoxClass").prop('checked', false);


<?php 

//producttype
$producttypequery = getselectattributeQuery($db,34);
//product size
$productsizequery = getselectattributeQuery($db,4);
//product lead
$productleadquery = getselectattributeQuery($db,31);
//product material
$productmaterialquery = getselectattributeQuery($db,7);
//product color
$productcolorquery = getselectattributeQuery($db,1);
//product fabric
$productfabricquery = getselectattributeQuery($db,10);
?>
function add_options(){
	 var j = $('#option_count').val();
		var k = (parseInt(j) + parseInt(1));
		 
				
			
			$('#option_div').append('<div class="row rowbox"  id="row_option'+j+'"><div class="col-md-12 mbs-12"><table class="tablecls" border="0" cellpadding="10" cellspacing="10"><tr><td>Product Type</td><td>Size</td><td>Lead Equivalnce</td><td>Matrial</td><td>SKU</td><td>Default</td></tr><tr><td><select name="attributeproducttype'+j+'" id="attributeproducttype'+j+'" class="form-control select2 "><option value="">Select</option><?php foreach($producttypequery as $ptype){?><option value="<?php echo $ptype['Id'];?>"><?php echo $ptype['Name'];?></option><?php }?></td><td><select name="attributeproductsize'+j+'" id="attributeproductsize'+j+'" class="form-control select2 "><option value="">Select</option><?php foreach($productsizequery as $psize){?><option value="<?php echo $psize['Id'];?>"><?php echo $psize['Name'];?></option><?php }?></td><td><select name="attributeleadequivalnce'+j+'" id="attributeleadequivalnce'+j+'" class="form-control select2 "><option value="">Select</option><?php foreach($productleadquery as $plead){?><option value="<?php echo $plead['Id'];?>"><?php echo $plead['Name'];?></option><?php }?></td><td><select name="attributematerial'+j+'" id="attributematerial'+j+'" class="form-control select2 "><option value="">Select</option><?php foreach($productmaterialquery as $pmaterial){?><option value="<?php echo $pmaterial['Id'];?>"><?php echo $pmaterial['Name'];?></option><?php }?></td><td><input type="text" name="productattsku'+j+'" id="productattsku'+j+'" class="form-control jsrequired"></td><td><input type="radio" name="isdefault" id="isdefault'+j+'" value="'+j+'"></td><tr><td colspan="2">Color</td><td colspan="2">Fabric</td><td>Price</td><td>&nbsp;</td></tr><tr><td colspan="2"><select multiple name="attributecolor'+j+'[]" id="attributecolor'+j+'" class="form-control select2 "><option value="">Select</option><?php foreach($productcolorquery as $pcolor){?><option value="<?php echo $pcolor['Id'];?>"><?php echo $pcolor['Name'];?></option><?php }?></td><td colspan="2"><select multiple name="attributefabric'+j+'[]" id="attributefabric'+j+'" class="form-control select2 "><option value="">Select</option><?php foreach($productfabricquery as $pfabric){?><option value="<?php echo $pfabric['Id'];?>"><?php echo $pfabric['Name'];?></option><?php }?></td><td><input type="text" name="productattprice'+j+'" id="productattprice'+j+'" class="form-control jsrequired"></td> <td>&nbsp;&nbsp; <a href="javascript:void(0);"  onclick="add_options();" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a> <a href="javascript:void(0);" onclick="remove_row_option(' + j + ',\''+'\');"><span class="addthis tr"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></a></td></tr></table></div></div>');
			
			$("#attributeproducttype"+j+",#attributeproducttype"+j+",#attributeleadequivalnce"+j+",#attributematerial"+j+",#attributecolor"+j+",#attributefabric"+j+"").select2();
			 
			j++; 
			$('#option_count').val(j);
			$('#option_max_count').val(j);
			
		 
}


 

function remove_row_option(button_id){
 	$('#row_option'+button_id + '').remove();
		var jj = $('#option_count').val();
		jj--;
		$('#option_count').val(jj);
}

function remove_option(row,productid,attributeid){
	
	swal({
			title: 'Are you sure?',
			 text: "You want to delete the attribute combination?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Okay",
			padding: '0.5em'
     	 }).then(function(result) {
			if (result.value) {		
				var urls ="product_actions.php?action=remove_attri_option";
				  var m_data = 'productid='+productid+'&attributeid='+attributeid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  if(response.rslt == 1){
							remove_row_option(row);
							 
							swal("Success!", 'Attribute Deleted Successfully', "success");
					  }else{
						  swal("Failure!", 'Error in attribute delete', "warning");
					  }
							unloading();
					  }
					});
			
			}
		 });
        }
		
	 
</script>

<style>
.rowbox{
	background-color: #f4f4f4;
padding-bottom: 10px;
border: 1px solid #b1b3b9;
margin-bottom: 10px;
}
.tablecls{
	clear: both;
width: 100%;
}
</style>