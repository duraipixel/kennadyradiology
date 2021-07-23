<?php 
//require_once "plugins/richtexteditorphp/richtexteditor/include_rte.php" ;
$menudisp = "configuration";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeConfigure($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END




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

  $str_ed = "select * from ".TPLPrefix."configuration where IsActive != '2' and  storeId = '".base64_decode($id)."' ";
$res_ed = $db->get_rsltset($str_ed);

 // for($k=0;$k<count($res_ed);$k++)
 // echo $k.'---'. $res_ed[$k]['key'];

$edit_id = $res_ed['configureId'];

$chk='';
if($res_ed[0]['IsActive']=='1')
{
	$chk='checked';
}

$chkdisp='';
if($res_ed['IsTop']=='1')
{
	$chkdisp='checked';
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
          <h3>Configuration</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Store Configuration</a></li>
              <li><a href="configuration_mng.php">Configuration</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Configuration</a> </li>
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
                  <h4><?php echo $operation; ?> Configuration</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <?php if(searchIsDisplay("storeName",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Name </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control jsrequired" name="storeName" id="storeName" value="<?php echo searchkeyvalue("storeName",$res_ed); ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <?php if(searchIsDisplay("defaultCurrency",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Default Currency </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 					 
						
						 
						  if($act=="update"){
							  if (isset($chk_Ref_there)) {
						  ?>
                            <input type="hidden" name="defaultCurrency" value="<?php echo searchkeyvalue("defaultCurrency",$res_ed); ?>" />
                            <?php	
							 
							   echo getSelectBox_Currencylist($db,'defaultCurrency','jsrequired',searchkeyvalue("defaultCurrency",$res_ed));	  
							  }
							  else{
								
								echo getSelectBox_Currencylist($db,'defaultCurrency','jsrequired',searchkeyvalue("defaultCurrency",$res_ed));   
							  }							  
						  }
						  else{
							 echo getSelectBox_Currencylist($db,'defaultCurrency','jsrequired',searchkeyvalue("defaultCurrency",$res_ed)); 
						  }
						 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <?php if(searchIsDisplay("isTaxable",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Include Tax </label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="isTaxable" id="isTax1" value="1" jsrequired <?php  if(searchkeyvalue("isTaxable",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="isTaxable" id="isTax1" value="0" jsrequired <?php  if(searchkeyvalue("isTaxable",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("productsPerpage",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Products Per Page </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" name="productsPerpage" class="form-control" id="productsPerpage" value="<?php echo searchkeyvalue("productsPerpage",$res_ed)?>" onkeypress="return isNumber(event)"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("dateFormat",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Date Format</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php   echo getSelectBox_dateformate($db,'dateFormat','required','',searchkeyvalue("dateFormat",$res_ed));?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("pagingOrLazy",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Use Pagination / Lazy Loading </label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="pagingOrLazy" id="pagingOrLazy1" value="P" jsrequired <?php  if(searchkeyvalue("pagingOrLazy",$res_ed) == 'P'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Pagination </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="pagingOrLazy" id="pagingOrLazy2" value="L" <?php  if(searchkeyvalue("pagingOrLazy",$res_ed) == 'L'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span> Lazy Loading </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("displayStock",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Use Pagination / Lazy Loading </label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="displayStock" id="displayStock1" value="1" jsrequired <?php  if(searchkeyvalue("displayStock",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="displayStock" id="displayStock2" value="0" <?php  if(searchkeyvalue("displayStock",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("displayOutofstock",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Display Out of Stock </label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="displayOutofstock" id="displayOutofstock1" value="1" jsrequired <?php  if(searchkeyvalue("displayOutofstock",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="displayOutofstock" id="displayOutofstock2" value="0" <?php  if(searchkeyvalue("displayOutofstock",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("minimumStock",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Minimum Stock Maintain</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="minimumStock" id="minimumStock" value="<?php echo searchkeyvalue("minimumStock",$res_ed)?>" onkeypress="return isNumber(event)"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("ecomLogo",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Logo</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input id="ecomLogo" name="ecomLogo" type="file" class="category_image common_upload_style" onchange="return imageformatcheck(this.value,'image')" />
                            <p class="help-block"></p>
                          </div>
                          <?php 
						
						if (!empty(searchkeyvalue("ecomLogo",$res_ed)) && ($act == 'update')) { 
						  if(file_exists("../uploads/logo/".searchkeyvalue("ecomLogo",$res_ed)))
						   { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <img src="../uploads/logo/<?php echo searchkeyvalue("ecomLogo",$res_ed); ?>" width ="150" height="150" align="absmiddle"/> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php
						   }
						   else{ ?>
                          <img src="../uploads/NoImageAvailable.png" width="50px" align="absmiddle"/>
                          <?php }
						 } 
						 ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("favIcon",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">FavIcon</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input id="favIcon" name="favIcon" type="file" class="category_image common_upload_style" onchange="return imageformatcheckIcon(this.value,'image')" />
                            <p class="help-block"></p>
                          </div>
                          <?php 
						
						if (!empty(searchkeyvalue("favIcon",$res_ed)) && ($act == 'update')) { 
						  if(file_exists("../uploads/favicon/".searchkeyvalue("favIcon",$res_ed)))
						   
						   { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <img src="../uploads/favicon/<?php echo trim(searchkeyvalue("favIcon",$res_ed)); ?>" width="50px" align="absmiddle"/> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php
						   }
						   else{ ?>
                          <img src="../uploads/NoImageAvailable.png" width="50px" align="absmiddle"/>
                          <?php }
						 } 
						 ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsEnableWaterMark",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Enable Watermark </label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsEnableWaterMark" id="IsEnableWaterMark1" value="1" jsrequired <?php  if(searchkeyvalue("IsEnableWaterMark",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsEnableWaterMark" id="IsEnableWaterMark2" value="0" <?php  if(searchkeyvalue("IsEnableWaterMark",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("watermark",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Watermark Image</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input id="watermark" name="watermark" type="file" class="category_image common_upload_style" onchange="return imageformatcheck(this.value,'image')" />
                            <p class="help-block"></p>
                          </div>
                          <?php 
						
						if (!empty(searchkeyvalue("watermark",$res_ed)) && ($act == 'update')) { 
						  if(file_exists("../uploads/watermark/".searchkeyvalue("watermark",$res_ed)))
						   {?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <img src="../uploads/watermark/<?php echo searchkeyvalue("watermark",$res_ed); ?>" width="50px" align="absmiddle"/> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php
						   }
						   else{ ?>
                          <img src="../uploads/NoImageAvailable.png" width="50px" align="absmiddle"/>
                          <?php }
						 } 
						 ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("storeMetaTitle",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Meta Title</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control jsrequired" name="storeMetaTitle" id="storeMetaTitle" value="<?php echo searchkeyvalue("storeMetaTitle",$res_ed); ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("storeMetaDesc",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Meta Description</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="storeMetaDesc" id="storeMetaDesc" ><?php echo searchkeyvalue("storeMetaDesc",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("storeMetaKey",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Meta Keywords</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control jsrequired" name="storeMetaKey" id="storeMetaKey" value="<?php echo searchkeyvalue("storeMetaKey",$res_ed); ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("ordercustfields",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Order Custom Fields</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="ordercustfields" id="ordercustfields" value="<?php echo searchkeyvalue("ordercustfields",$res_ed); ?>"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("customerCustom",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Customer Custom Fields</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="customerCustom" id="customerCustom" value="<?php echo  searchkeyvalue("customerCustom",$res_ed); ?>"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("store_address",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Address</label>
                        </div>
                      </div>
                      <div class="col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired texteditor" name="store_address" id="store_address"  ><?php echo searchkeyvalue("store_address",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("store_address_for_invoice_pdf",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Store Address FOR PDF</label>
                        </div>
                      </div>
                      <div class="col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired texteditor" name="store_address_for_invoice_pdf" id="store_address_for_invoice_pdf"  ><?php echo searchkeyvalue("store_address_for_invoice_pdf",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("gstin",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">GSTIN</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="gstin" id="gstin" ><?php echo searchkeyvalue("gstin",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("order_mail_to",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Order Email To</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="order_mail_to" id="order_mail_to" ><?php echo searchkeyvalue("order_mail_to",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("order_mail_bcc",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Order Email BCC</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="order_mail_bcc" id="order_mail_bcc" ><?php echo searchkeyvalue("order_mail_bcc",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("contactus_mail_to",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Contact Us Email To</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="contactus_mail_to" id="contactus_mail_to" ><?php echo searchkeyvalue("contactus_mail_to",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("contactus_mail_bcc",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Contact Us Email BCC</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="contactus_mail_bcc" id="contactus_mail_bcc" ><?php echo searchkeyvalue("contactus_mail_bcc",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("results_per_page",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Results Per Page(Product List)</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control jsrequired" name="results_per_page" id="results_per_page" ><?php echo searchkeyvalue("results_per_page",$res_ed); ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("datetimezone",$res_ed)==1 || $_SESSION['RoleId']==1) { 
				$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
				?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Date / Time Zone</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <select name="datetimezone" id="datetimezone"    class="form-control jsrequired select2">
                              <option value="" >Select Time Zone </option>
                              <?php foreach($tzlist as $list){ 
							 $sel='';
							  if(searchkeyvalue("datetimezone",$res_ed)==$list)
								  $sel= "Selected='true'";
							?>
                              <option <?php echo $sel; ?> value="<?php echo $list; ?>" ><?php echo $list; ?></option>
                              <?php 	}  ?>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsConfigureProduct",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Configure Product Available </label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsConfigureProduct" id="IsConfigureProduct1" value="1" jsrequired <?php  if(searchkeyvalue("IsConfigureProduct",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsConfigureProduct" id="IsConfigureProduct2" value="0" <?php  if(searchkeyvalue("IsConfigureProduct",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsQuantityIncreaseDecrease",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Quantity Increase Decrease</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsQuantityIncreaseDecrease" id="IsQuantityIncreaseDecrease1" value="1" jsrequired <?php  if(searchkeyvalue("IsQuantityIncreaseDecrease",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsQuantityIncreaseDecrease" id="IsQuantityIncreaseDecrease2" value="0" <?php  if(searchkeyvalue("IsQuantityIncreaseDecrease",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsAttributeLink",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Attribute Seprate Link</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsAttributeLink" id="IsAttributeLink1" value="1" jsrequired <?php  if(searchkeyvalue("IsAttributeLink",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsAttributeLink" id="IsAttributeLink2" value="0" <?php  if(searchkeyvalue("IsAttributeLink",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsManufactureAttribute",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Manufacture Attribute</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsManufactureAttribute" id="IsManufactureAttribute1" value="1" jsrequired <?php  if(searchkeyvalue("IsManufactureAttribute",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsManufactureAttribute" id="IsManufactureAttribute2" value="0" <?php  if(searchkeyvalue("IsManufactureAttribute",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsCategoryCustomerGroup",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Customer Group Category</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsCategoryCustomerGroup" id="IsCategoryCustomerGroup1" value="1" jsrequired <?php  if(searchkeyvalue("IsCategoryCustomerGroup",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsCategoryCustomerGroup" id="IsCategoryCustomerGroup2" value="0" <?php  if(searchkeyvalue("IsCategoryCustomerGroup",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsCustomFieldCustomerGroup",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Custom Field Customer Group</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsCustomFieldCustomerGroup" id="IsCustomFieldCustomerGroup1" value="1" jsrequired <?php  if(searchkeyvalue("IsCustomFieldCustomerGroup",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsCustomFieldCustomerGroup" id="IsCustomFieldCustomerGroup2" value="0" <?php  if(searchkeyvalue("IsCustomFieldCustomerGroup",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(searchIsDisplay("IsCatParentChildOnly",$res_ed)==1 || $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Category Parent Child Only</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsCatParentChildOnly" id="IsCatParentChildOnly1" value="1" jsrequired <?php  if(searchkeyvalue("IsCatParentChildOnly",$res_ed) == '1'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>Yes </label>
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="radio" name="IsCatParentChildOnly" id="IsCatParentChildOnly2" value="0" <?php  if(searchkeyvalue("IsCatParentChildOnly",$res_ed) == '0'){ echo 'checked="checked"';} ?> />
                                <span class="new-control-indicator"></span>No </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if( $_SESSION['RoleId']==1) { ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Status </label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk custom-radiocheck-css">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" required class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php if( $_SESSION['RoleId']==1) { ?>
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmtWithImg('frmconfiguration','configuration_actions.php','jvalidate','configuration','configuration_mng.php');" ><span id="spSubmit"><?php echo $btn; ?></span></button>
                            <?php } else { ?>
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmt('frmconfiguration','configuration_actions.php','jvalidate','configuration','configuration_mng.php');" ><span id="spSubmit"><?php echo $btn; ?></span></button>
                            <?php } ?>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmconfiguration','jvalidate','configuration','configuration_mng.php');" >Cancel</button>
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