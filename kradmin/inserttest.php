<?php
error_reporting(-1);
include 'sessionweb.php';


for($i=1;$i<=50;$i++){
 
	
	
  $inserttable = "insert into kr_product (`dropdown_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `model`, `sku`, `product_url`, `quantity`, `configqua`, `minquantity`, `isquaincrease`, `price`, `specialprice`, `spl_fromdate`, `spl_todate`, `isnewproduct`, `isfeaturedproduct`, `newprod_fromdate`, `newprod_todate`, `attributeMapId`, `taxId`, `manufacturerId`, `related_products`, `suggested_products`, `soldout`, `iscustomized`, `uploadecustomizedimg`, `chkpvatt`, `chkpvattprice`, `chkpvattprice_id`, `displayinhome`, `isfeatured`, `IsActive`, `created_date`, `modified_date`, `userid`, `isbuynow`, `parent_id`, `lang_id`, `brochureimage`, `producttag`)  select `dropdown_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `model`, `sku`, `product_url`, `quantity`, `configqua`, `minquantity`, `isquaincrease`, `price`, `specialprice`, `spl_fromdate`, `spl_todate`, `isnewproduct`, `isfeaturedproduct`, `newprod_fromdate`, `newprod_todate`, `attributeMapId`, `taxId`, `manufacturerId`, `related_products`, `suggested_products`, `soldout`, `iscustomized`, `uploadecustomizedimg`, `chkpvatt`, `chkpvattprice`, `chkpvattprice_id`, `displayinhome`, `isfeatured`, `IsActive`, `created_date`, `modified_date`, `userid`, `isbuynow`, 0, 1, `brochureimage`, `producttag` from kr_product where product_id = 1 ";
$rslt = $db->insert($inserttable);
			$lastInserId = $db->insert_id;
		 

$inserttablesp = "insert into kr_product (`dropdown_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `model`, `sku`, `product_url`, `quantity`, `configqua`, `minquantity`, `isquaincrease`, `price`, `specialprice`, `spl_fromdate`, `spl_todate`, `isnewproduct`, `isfeaturedproduct`, `newprod_fromdate`, `newprod_todate`, `attributeMapId`, `taxId`, `manufacturerId`, `related_products`, `suggested_products`, `soldout`, `iscustomized`, `uploadecustomizedimg`, `chkpvatt`, `chkpvattprice`, `chkpvattprice_id`, `displayinhome`, `isfeatured`, `IsActive`, `created_date`, `modified_date`, `userid`, `isbuynow`, `parent_id`, `lang_id`, `brochureimage`, `producttag`)  select `dropdown_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `model`, `sku`, `product_url`, `quantity`, `configqua`, `minquantity`, `isquaincrease`, `price`, `specialprice`, `spl_fromdate`, `spl_todate`, `isnewproduct`, `isfeaturedproduct`, `newprod_fromdate`, `newprod_todate`, `attributeMapId`, `taxId`, `manufacturerId`, `related_products`, `suggested_products`, `soldout`, `iscustomized`, `uploadecustomizedimg`, `chkpvatt`, `chkpvattprice`, `chkpvattprice_id`, `displayinhome`, `isfeatured`, `IsActive`, `created_date`, `modified_date`, `userid`, `isbuynow`, ".$lastInserId.", 2, `brochureimage`, `producttag` from kr_product  where product_id = 2 ";
$rslt = $db->insert($inserttablesp);
			$splastInserId = $db->insert_id;

		$inserttablept = "insert into kr_product (`dropdown_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `model`, `sku`, `product_url`, `quantity`, `configqua`, `minquantity`, `isquaincrease`, `price`, `specialprice`, `spl_fromdate`, `spl_todate`, `isnewproduct`, `isfeaturedproduct`, `newprod_fromdate`, `newprod_todate`, `attributeMapId`, `taxId`, `manufacturerId`, `related_products`, `suggested_products`, `soldout`, `iscustomized`, `uploadecustomizedimg`, `chkpvatt`, `chkpvattprice`, `chkpvattprice_id`, `displayinhome`, `isfeatured`, `IsActive`, `created_date`, `modified_date`, `userid`, `isbuynow`, `parent_id`, `lang_id`, `brochureimage`, `producttag`)  select `dropdown_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `model`, `sku`, `product_url`, `quantity`, `configqua`, `minquantity`, `isquaincrease`, `price`, `specialprice`, `spl_fromdate`, `spl_todate`, `isnewproduct`, `isfeaturedproduct`, `newprod_fromdate`, `newprod_todate`, `attributeMapId`, `taxId`, `manufacturerId`, `related_products`, `suggested_products`, `soldout`, `iscustomized`, `uploadecustomizedimg`, `chkpvatt`, `chkpvattprice`, `chkpvattprice_id`, `displayinhome`, `isfeatured`, `IsActive`, `created_date`, `modified_date`, `userid`, `isbuynow`, ".$lastInserId.", 3, `brochureimage`, `producttag` from kr_product  where product_id = 3 ";

		$rslt = $db->insert($inserttablept);
		$ptlastInserId = $db->insert_id;
			
			
		$combination = "insert into kr_product_attr_combi (`attr_combi_id`, `base_productId`, `quantity`, `price`, `sku`, `product_img_id`, `outofstock`, `isDefault`, `IsActive`, `createdDate`, `modifiedDate`)  select `attr_combi_id`, ".$lastInserId.", `quantity`, `price`, `sku`, `product_img_id`, `outofstock`, `isDefault`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi  where base_productId = 1 ";		
		$rslt = $db->insert($combination);

		$combinationes = "insert into kr_product_attr_combi (`attr_combi_id`, `base_productId`, `quantity`, `price`, `sku`, `product_img_id`, `outofstock`, `isDefault`, `IsActive`, `createdDate`, `modifiedDate`)  select `attr_combi_id`, ".$splastInserId.", `quantity`, `price`, `sku`, `product_img_id`, `outofstock`, `isDefault`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi where base_productId = 2 ";			
		$rslt = $db->insert($combinationes);

		$combinationpt = "insert into kr_product_attr_combi (`attr_combi_id`, `base_productId`, `quantity`, `price`, `sku`, `product_img_id`, `outofstock`, `isDefault`, `IsActive`, `createdDate`, `modifiedDate`)  select `attr_combi_id`, ".$ptlastInserId.", `quantity`, `price`, `sku`, `product_img_id`, `outofstock`, `isDefault`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi where base_productId = 3";
		$rslt = $db->insert($combinationpt);
		
				
		###### kr_product_attr_combi_opt #####
		 $stcombinationss = "insert into kr_product_attr_combi_opt (`optionId`, `optionId_price`, `product_id`, `outofstock`, `IsActive`, `createdDate`, `modifiedDate`)  select `optionId`, `optionId_price`, ".$lastInserId.", `outofstock`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi_opt where product_id = 1 ";		
		$rslt = $db->insert($stcombinationss);
		
		
		 $stcombinationss1 = "insert into kr_product_attr_combi_opt (`optionId`, `optionId_price`, `product_id`, `outofstock`, `IsActive`, `createdDate`, `modifiedDate`)  select `optionId`, `optionId_price`, ".$splastInserId.", `outofstock`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi_opt where product_id = 2 ";		
		$rslt = $db->insert($stcombinationss1);

		 $stcombinationss2 = "insert into kr_product_attr_combi_opt (`optionId`, `optionId_price`, `product_id`, `outofstock`, `IsActive`, `createdDate`, `modifiedDate`)  select `optionId`, `optionId_price`, ".$ptlastInserId.", `outofstock`, `IsActive`, `createdDate`, `modifiedDate` from kr_product_attr_combi_opt where product_id = 3 ";		
		$rslt = $db->insert($stcombinationss2); 

	 

		######### kr_product_attr_varchar #####
		$stcombinationss1 = "insert into kr_product_attr_varchar (`product_id`, `masterproduct_id`, `attribute_id`, `attribute_value`, `IsActive`, `lang_id`, `createdDate`, `modifiedDate`)  select ".$lastInserId.", ".$lastInserId.", `attribute_id`, `attribute_value`, `IsActive`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_attr_varchar where product_id = 1 ";		
		$rslt = $db->insert($stcombinationss1);

		$stcombinationes2 = "insert into kr_product_attr_varchar (`product_id`, `masterproduct_id`, `attribute_id`, `attribute_value`, `IsActive`, `lang_id`, `createdDate`, `modifiedDate`)  select ".$splastInserId.", ".$lastInserId.", `attribute_id`, `attribute_value`, `IsActive`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_attr_varchar where product_id = 2 ";			
		$rslt = $db->insert($stcombinationes2);

		$stcombinationpt3 = "insert into kr_product_attr_varchar (`product_id`, `masterproduct_id`, `attribute_id`, `attribute_value`, `IsActive`, `lang_id`, `createdDate`, `modifiedDate`)  select ".$ptlastInserId.", ".$lastInserId.", `attribute_id`, `attribute_value`, `IsActive`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_attr_varchar where product_id = 3";
		$rslt = $db->insert($stcombinationpt3);

		######### kr_product_categoryid #####
		$stcombinationss1c = "insert into kr_product_categoryid (`product_id`, `categoryID`, `IsActive`, `UserId`, `lang_id`, `createdDate`, `modifiedDate`)  select  ".$lastInserId.", `categoryID`, `IsActive`, `UserId`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_categoryid where product_id = 1 ";		
		$rslt = $db->insert($stcombinationss1c);

		$stcombinationes2c = "insert into kr_product_categoryid (`product_id`, `categoryID`, `IsActive`, `UserId`, `lang_id`, `createdDate`, `modifiedDate`)  select  ".$splastInserId.", `categoryID`, `IsActive`, `UserId`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_categoryid  where product_id = 2 ";				
		$rslt = $db->insert($stcombinationes2c);

		$stcombinationpt3c = "insert into kr_product_categoryid (`product_id`, `categoryID`, `IsActive`, `UserId`, `lang_id`, `createdDate`, `modifiedDate`)  select  ".$ptlastInserId.", `categoryID`, `IsActive`, `UserId`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_categoryid  where product_id = 3 ";		
		$rslt = $db->insert($stcombinationpt3c);
		
		######### kr_product_images #####
		$stcombinationssimg = "insert into kr_product_images (`product_id`, `sku`, `img_path`, `isthumbdefault`, `ismediumdefault`, `isbasedefault`, `ordering`, `IsActive`, `parent_id`, `lang_id`, `createdDate`, `modifiedDate`)  select ".$lastInserId.", `sku`, `img_path`, `isthumbdefault`, `ismediumdefault`, `isbasedefault`, `ordering`, `IsActive`, `parent_id`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_images  where product_id = 1 ";		
		$rslt = $db->insert($stcombinationssimg);

		$stcombinationssimg1 = "insert into kr_product_images (`product_id`, `sku`, `img_path`, `isthumbdefault`, `ismediumdefault`, `isbasedefault`, `ordering`, `IsActive`, `parent_id`, `lang_id`, `createdDate`, `modifiedDate`)  select ".$splastInserId.", `sku`, `img_path`, `isthumbdefault`, `ismediumdefault`, `isbasedefault`, `ordering`, `IsActive`, `parent_id`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_images where product_id = 1 ";		
		$rslt = $db->insert($stcombinationssimg1);

		$stcombinationssimg2 = "insert into kr_product_images (`product_id`, `sku`, `img_path`, `isthumbdefault`, `ismediumdefault`, `isbasedefault`, `ordering`, `IsActive`, `parent_id`, `lang_id`, `createdDate`, `modifiedDate`)  select ".$ptlastInserId.", `sku`, `img_path`, `isthumbdefault`, `ismediumdefault`, `isbasedefault`, `ordering`, `IsActive`, `parent_id`, `lang_id`, `createdDate`, `modifiedDate` from kr_product_images where product_id = 1 ";		
		$rslt = $db->insert($stcombinationssimg2);

}
?>
