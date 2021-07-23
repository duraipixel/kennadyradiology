<?php 
function getMdmeMenu($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','menu_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeModule($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','module_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeHomepageslidercat($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','homepageslidercat_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeModulemenu($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','modulemenu_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmePage($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','page_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCMSblock($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','block_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeRole($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','roleinfo_mng.php');
return base64_encode($mdme_rslt[0]);
}
function getMdmeFrontmenu($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','frontmenu_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmePermissioninfo($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','permissioninfo_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeUser($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','userinfo_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeUsermgmt($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','usermgmt_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeimagesetting($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','imagesetting_form.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeConfigure($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','configuration_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeDashboard($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','dashboard.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCountry($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','country_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeHomepageslider($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','homepageslider_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeState($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','state_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCity($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','city_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmecurrency($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','currency_mng.php');
return base64_encode($mdme_rslt[0]);
}


function getMdmeTaxmaster($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','taxmaster_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeLanguage($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','language_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeArea($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','area_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeServices($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','services_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmePostcode($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','postcode_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeBanners($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','banners_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCustomer($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','customer_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeMailtemplate($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','mailtemplate_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeAttributes($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','attributes_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeAttributegroup($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','attributegroup_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeorderstatus($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','orderstatus_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeAttrmap($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','attributesmap_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCategory($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','category_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeProduct($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','product_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeFlatairShipping($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','shippingflatair_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeShippingmodules($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','shipping_mng.php');
return base64_encode($mdme_rslt[0]);
}


function getMdmeCoupon($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','coupons_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeDiscount($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','discount_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeFreeShipping($db,$temp=null)
{
$mdme_rslt = getMdme($db,'',$temp);
return base64_encode($mdme_rslt[0]);
}

function getMdmeCustomfields($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','customfields_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCustomergroups($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','customergroups_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCustomers($db,$temp=null)
{
//$mdme_rslt = getMdme($db,'','customers_mng.php');
$mdme_rslt = getMdme($db,'',$temp);
return base64_encode($mdme_rslt[0]);
}


function getMdmeFlatShippingmodules($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','shippingflat_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmemanufacturer($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','manufacturer_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeAttibutevalue($db,$temp=null)
{
$mdme_rslt = getMdme($db,'',$temp);

return base64_encode($mdme_rslt[0]);
}

function getMdmeSubscribe($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','subscribe_mng.php');

return base64_encode($mdme_rslt[0]);
}

function getMdmeOrders($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','orders_mng.php');

return base64_encode($mdme_rslt[0]);
}
function getMdmeProductapproval($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','productapproval_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmePaymentgateway($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','paymentgateway_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeContactus($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','contactus_mng.php');
return base64_encode($mdme_rslt[0]);
}
function getMdmefbmanagementdisplay($db,$temp=null)
{

$mdme_rslt = getMdme($db,'',$temp);

return base64_encode($mdme_rslt[0]);
}
function getMdmerptformbuilder($db,$temp=null)
{

$mdme_rslt = getMdme($db,'',$temp);

return base64_encode($mdme_rslt[0]);
}


function getMdmeBulkProductUpload($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','bulk_product_upload.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeVideos($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','videos_mng.php');
return base64_encode($mdme_rslt[0]);
}


function getMdmeMangeclient($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','manageclient_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeSaleReport($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','salereports_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeOrderproductReport($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','orderedproductsreport_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeLowstockreport($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','lowstockproductsreport_mng.php');
return base64_encode($mdme_rslt[0]);
}


function getMdmecustomerorderReport($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','customerordersreport_mng.php');
return base64_encode($mdme_rslt[0]);
}



function getMdmeimportexportawb($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','orderexportimport.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeTestimonial($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','testimonial_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmefeaturestories($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','featurestories_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmenews($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','news_mng.php');
return base64_encode($mdme_rslt[0]);
}


function getMdmeRegion($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','region_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeevents($db,$temp=null)
{
$mdme_rslt = getMdme($db,'','events_mng.php');
return base64_encode($mdme_rslt[0]);
}

?>