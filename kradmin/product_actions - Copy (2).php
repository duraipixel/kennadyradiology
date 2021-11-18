<?php 
include 'sessionweb.php';
$_REQUEST['categoryIDs']=explode(",",$_REQUEST['categoryIDs']);
extract($_REQUEST);
$act = isset($action_)? $action_ : (isset($action)? $action :'');
$getlanguage = getLanguages($db);

$status =0;
if(!isset($chkslodout))
	$sdchk = '';
if($isbuynow !=null)
	$isbuynow =1;
else
	$isbuynow =0;

if($iscustomized !=null)
{
	$iscustom =1;
}
else{
	$iscustom =0;
} 
$chkpvatt_id = implode(',',$chkpvatt);
 

if(!isset($chkpvatt))
	$priceatt = '';
if($chkpvatt !=null)
	$priceatt =1;

else
	$priceatt =0;

if(!isset($chkpvattprice))
	$priceatt_combine = $priceatt_combine_id = '';

if($chkpvattprice !=null){
	$priceatt_combine =1;
	$priceatt_combine_id = implode(',',$chkpvattprice);
}
else{
	$priceatt_combine = $priceatt_combine_id =0;
}
 
 
 
 
if($ishome !=null)
 	$ishome =1;
else
 	$ishome =0;

if($isfeatured !=null)
 	$isfeaturedproduct =1;
else
 	$isfeaturedproduct =0;


################################## checking ############
//Updating attribute combination - starts
			
			
			 for($i=0;$i<=$option_max_count;$i++) {				
					  $pproducttype=$_POST['attributeproducttype'.$i];	
					  $pproductsize=$_POST['attributeproductsize'.$i];	
					  $pleadequivalnce=$_POST['attributeleadequivalnce'.$i];
					  $pematerial=$_POST['attributematerial'.$i];
					  $pproductattsku=$_POST['productattsku'.$i];
					  
					  $pattributecolor=explode(',',$_POST['attributecolor'.$i]);
					  $pattributefabric=explode(',',$_POST['attributefabric'.$i]);
					   
					  $pproductattprice=$_POST['productattprice'.$i];
					  
					  if(count($pattributecolor) > count($pattributefabric)){
						$attributecounts = count($pattributecolor);
					  }else if(count($pattributecolor) > count($pattributefabric)){
						$attributecounts = count($pattributefabric);
					  }else{
						$attributecounts = count($pattributecolor);
					  }
					  
				//	  echo "attributecounts".$attributecounts;
 					if($pproducttype!='') {
												
							//check highest value
					  for($j=0;$j<=$attributecounts;$j++){
						  
						  
					  
					   
					foreach($getlanguage as $languageval){ 
					 
					 $strCombilang = "select dropdown_id from ".TPLPrefix."dropdown where parent_id = '$combId' and lang_id = '".$languageval['languageid']."' ";
					 $resltCombilang = $db->get_a_line($strCombilang);
					 
					 
					 if($languageval['languageid'] == 1){
					 $insertidcheck = $lastInserId;
					 $combIds =$combId;
					 }else if($languageval['languageid'] == 2){
					 $insertidcheck = $splastInserId;
					 $combIds =$resltCombilang['dropdown_id'];
					 }else if($languageval['languageid'] == 3){
					 $insertidcheck = $ptlastInserId;
					 $combIds =$resltCombilang['dropdown_id'];
					 }
					 
					
					
					 
					$strCombiChk = "select count(*) as tot from ".TPLPrefix."product_attr_combi where attr_combi_id = '$combIds' and base_productId = '$insertidcheck' ";
					$resltCombi = $db->get_a_line($strCombiChk);
					if($resltCombi['tot'] == 0){						 						
						echo $combiStr = "INSERT INTO ".TPLPrefix."product_attr_combi(attr_combi_id,base_productId,quantity,price,sku,isDefault,createdDate,modifiedDate,IsActive,product_img_id,outofstock) ";
						$combiStr .= " VALUES ('".$combIds."','".$insertidcheck."','".$qua."','".$price."','".$sku."','".$default."','".$today."','".$today."','1','".$imattcombinationid."',0) ";
						$db->insert($combiStr);
						 $log = $db->insert_log("insert","".TPLPrefix."product_attr_combi","","product_attr_combi Add successfully","product_attr_combi",$combiStr);
					}
					else{
						$combiStr = "UPDATE ".TPLPrefix."product_attr_combi SET  product_img_id='".$imattcombinationid."',quantity= '".$qua."',price = '".$price."', sku = '".$sku."', modifiedDate='".$today."',isDefault =  '".$default."',IsActive='1' WHERE  base_productId = '".$insertidcheck."' AND  attr_combi_id =  '".$combIds."'  ";
                         $log = $db->insert_log("update","".TPLPrefix."product_attr_combi","","product_attr_combi updated","product_attr_combi",$combiStr);						
						$db->insert($combiStr);
					}
					 }
					 
					 }
					 
						}
				 }
				 
				 
				 die();
 


include 'includes/image_thumb.php';

if(isset($_REQUEST['getProductImage'])){
	$id = base64_decode($_REQUEST['productId']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  `".TPLPrefix."product_images` where product_id = '".$id."' order by ordering asc ";
         //echo "<pre>"; print_r($str_ed_images); exit; 		
		$res_ed_images = $db->get_rsltset($str_ed_images);		
		if(count($res_ed_images)){
			$counter = 1;?>
            <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){									
				?>
                
                <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
          <img  src="<?php echo IMG_BASE_URL."productassest/".$id."/photos/".$valimages['img_path']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
          <li><input type="text" style="width:30%; float:left" class="productImgOrderno form-control" name="productImgOrderno_<?php echo $valimages['product_img_id']; ?>" value="<?php echo $valimages['ordering']; ?>" /> &nbsp;&nbsp;<a onclick="delProductImg('<?php echo base64_encode($valimages['product_img_id']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>
  
  <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['product_img_id']; ?>" />
				 				
				<?php
				$counter++;
			}
			?>
             </ul>
</div>
			 <script>
			  $(function() {
				$( "#uploadedProducts" ).sortable({
				  connectWith: ".column",
				  handle: ".portlet-header",
				  cancel: ".portlet-toggle",
				  placeholder: "portlet-placeholder ui-corner-all",
				  update: function( event, ui ) {
					  var order = '';
					  $(".productImgOrder").each(function(){
						  order += $(this).val()+",";
					  })					  
					  var imgOrder = order.substring(0,order.length -1);
					  $.post("ajaxresponse.php",{action:'imgOrdering',ordering:imgOrder},function(){
						 // swal("Success!", 'Image Order Changed', "success");
					  })
				  }
				});
				$(".productImgOrderno").change(function() {				
					 $.post("ajaxresponse.php",{action:'prodimgOrdering',name:$(this).attr('name'),ordering:$(this).val()},function(){
						  //swal("Success!", 'Image Order Changed', "success");
					  })
				});
		 
				$( ".portlet" )
				  .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
				  .find( ".portlet-header" )
					.addClass( "ui-widget-header ui-corner-all" )
					.prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
			 
				$( ".portlet-toggle" ).click(function() {
				  var icon = $( this );
				  icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
				  icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
				});
			  });
			  </script>			 
			<?php
		}									
	}	
	exit();
}

$getsize = getimagesize_large($db,'customizedimage','customizedproduct');
//$sizes = getdynamicimage($db,$bannername);
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
list($width, $height, $type, $attr) = getimagesize($_FILES['uploadecustomizedimg']['tmp_name']);


$getsizes = getimagesize_large($db,'product','product_image');
$imagevals = explode('-',$getsizes);
$imgheights = $imagevals[1];
$imgwidths = $imagevals[0];

$today=date("Y-m-d H:i:s");	
//echo $today; exit;
switch($act)
{ 

	case 'insert':
	//echo $priceatt; exit;
	
	
	$dropdownid = implode(',',$customatt);
	//print_r($_POST); exit;
	//echo "reach";
	//print_r($_POST);
	//echo $product_name; exit;
	if(!empty($product_name)) {
		
		if(empty($_FILES['product_images'])){
					echo json_encode(array("rslt"=>"8",'msg'=>'image required'));  //no values
				    exit();
		}
	
		//print_r($_FILES); die();
	
		$product_url=generateslug($product_name).'-'.generateslug($sku);
		$strChk = "select count(product_id) from ".TPLPrefix."product where product_name = '$product_name' and sku = '$sku' and product_url = '$product_url' and IsActive != '2' and product_id != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			if(empty($_FILES['product_images'])){
			echo json_encode(array("rslt"=>"9","text"=>"Images"));
			    exit();
		    }
			
			 

            if(isset($_FILES['product_images'])){
                
				for($i=0;$i<count($_FILES["product_images"]["tmp_name"]); $i++){
					
					list($widths, $heights) = getimagesize($_FILES["product_images"]["tmp_name"][$i]);
					
					if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths)))
			        {
					    echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				        exit();
				    }
                }
				
				
            }		


			if(isset($_FILES['product_images_es'])){
                
				for($i=0;$i<count($_FILES["product_images_es"]["tmp_name"]); $i++){
					
					list($widths, $heights) = getimagesize($_FILES["product_images_es"]["tmp_name"][$i]);
					
					if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths)))
			        {
					    echo json_encode(array("rslt"=>"8",'msg'=>'Spanish Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				        exit();
				    }
                }
				
				
            }	

			if(isset($_FILES['product_images_pt'])){
                
				for($i=0;$i<count($_FILES["product_images_pt"]["tmp_name"]); $i++){
					
					list($widths, $heights) = getimagesize($_FILES["product_images_pt"]["tmp_name"][$i]);
					
					if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths)))
			        {
					    echo json_encode(array("rslt"=>"8",'msg'=>'Portuguese Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				        exit();
				    }
                }
				
				
            }
			

			$related_products = $suggested_products = "";
			if(isset($_REQUEST['relatedproductIds']))
				$related_products  = $_REQUEST['relatedproductIds'];
			if(isset($_REQUEST['suggestedProductIds']))
				$suggested_products  = $_REQUEST['suggestedProductIds'];
		 
			
			$spl_fromdate = date('Y-m-d',strtotime($spl_fromdate));
			$spl_todate =date('Y-m-d',strtotime($spl_todate));
			
			
			$isnewproduct = (isset($isnewproduct))? 1:0;
			$isquaincrease = (isset($isquaincrease))? 1:0;
			
			$configqua = (isset($configqua))? 1:0;
			 
			
			$newprod_fromdate =date('Y-m-d',strtotime($newprod_fromdate));
			$newprod_todate = date('Y-m-d',strtotime($newprod_todate));
									
			
		 	$str="insert into ".TPLPrefix."product(dropdown_id,product_name,description,longdescription,metaname,metadescription,metakeyword,sku,product_url,quantity,configqua,minquantity,isquaincrease,isfeaturedproduct,price,specialprice,spl_fromdate,spl_todate,isnewproduct,newprod_fromdate,newprod_todate,attributeMapId,taxId,related_products,suggested_products,iscustomized,uploadecustomizedimg,isbuynow,chkpvatt,chkpvattprice,chkpvattprice_id,IsActive,UserId,created_date,modified_date,isfeatured,parent_id,lang_id,manufacturerId,producttag)values('".getRealescape($dropdownid)."','".getRealescape($product_name)."','".getRealescape($description)."','".getRealescape($longdescription)."','".getRealescape($metaname)."','".getRealescape($metadescription)."','".getRealescape($metakeyword)."','".getRealescape($sku)."','".getRealescape($product_url)."','".getRealescape($quantity)."','".getRealescape($configqua)."','".getRealescape($minquantity)."','".getRealescape($isquaincrease)."','".getRealescape($isfeaturedproduct)."','".getRealescape($price)."','".getRealescape($specialprice)."','".getRealescape($spl_fromdate)."','".getRealescape($spl_todate)."','".getRealescape($isnewproduct)."','".getRealescape($newprod_fromdate)."','".getRealescape($newprod_todate)."','".getRealescape($attributeMapId)."','".getRealescape($tax_id)."','".$related_products."','".$suggested_products."','".$iscustom."','".getRealescape($path)."','".$isbuynow."','".$priceatt."','".$priceatt_combine."','".$priceatt_combine_id."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."','".$isfeatured."',0,1,'".$manufacturerId."','".getRealescape($producttag)."')";
         	 
			$rslt = $db->insert($str);
			$lastInserId = $db->insert_id;
			
			//spanish
			$str="insert into ".TPLPrefix."product(dropdown_id,product_name,description,longdescription,metaname,metadescription,metakeyword,sku,product_url,quantity,configqua,minquantity,isquaincrease,isfeaturedproduct,price,specialprice,spl_fromdate,spl_todate,isnewproduct,newprod_fromdate,newprod_todate,attributeMapId,taxId,related_products,suggested_products,iscustomized,uploadecustomizedimg,isbuynow,chkpvatt,chkpvattprice,chkpvattprice_id,IsActive,UserId,created_date,modified_date,isfeatured,parent_id,lang_id,manufacturerId,producttag)values('".getRealescape($dropdownid)."','".getRealescape($product_name_es)."','".getRealescape($description_es)."','".getRealescape($longdescription_es)."','".getRealescape($metaname_es)."','".getRealescape($metadescription_es)."','".getRealescape($metakeyword_es)."','".getRealescape($sku)."','".getRealescape($product_url)."','".getRealescape($quantity)."','".getRealescape($configqua)."','".getRealescape($minquantity)."','".getRealescape($isquaincrease)."','".getRealescape($isfeaturedproduct)."','".getRealescape($price)."','".getRealescape($specialprice)."','".getRealescape($spl_fromdate)."','".getRealescape($spl_todate)."','".getRealescape($isnewproduct)."','".getRealescape($newprod_fromdate)."','".getRealescape($newprod_todate)."','".getRealescape($attributeMapId_es)."','".getRealescape($tax_id)."','".$related_products."','".$suggested_products."','".$iscustom."','".getRealescape($path)."','".$isbuynow."','".$priceatt."','".$priceatt_combine."','".$priceatt_combine_id."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."','".$isfeatured."','".$lastInserId."',2,'".$manufacturerId."','".getRealescape($producttag_es)."')";
			$rslt = $db->insert($str);
			$splastInserId = $db->insert_id;
			
			//portuguese
			$str="insert into ".TPLPrefix."product(dropdown_id,product_name,description,longdescription,metaname,metadescription,metakeyword,sku,product_url,quantity,configqua,minquantity,isquaincrease,isfeaturedproduct,price,specialprice,spl_fromdate,spl_todate,isnewproduct,newprod_fromdate,newprod_todate,attributeMapId,taxId,related_products,suggested_products,iscustomized,uploadecustomizedimg,isbuynow,chkpvatt,chkpvattprice,chkpvattprice_id,IsActive,UserId,created_date,modified_date,isfeatured,parent_id,lang_id,manufacturerId,producttag)values('".getRealescape($dropdownid)."','".getRealescape($product_name_pt)."','".getRealescape($description_pt)."','".getRealescape($longdescription_pt)."','".getRealescape($metaname_pt)."','".getRealescape($metadescription_pt)."','".getRealescape($metakeyword_pt)."','".getRealescape($sku)."','".getRealescape($product_url)."','".getRealescape($quantity)."','".getRealescape($configqua)."','".getRealescape($minquantity)."','".getRealescape($isquaincrease)."','".getRealescape($isfeaturedproduct)."','".getRealescape($price)."','".getRealescape($specialprice)."','".getRealescape($spl_fromdate)."','".getRealescape($spl_todate)."','".getRealescape($isnewproduct)."','".getRealescape($newprod_fromdate)."','".getRealescape($newprod_todate)."','".getRealescape($attributeMapId_pt)."','".getRealescape($tax_id)."','".$related_products."','".$suggested_products."','".$iscustom."','".getRealescape($path)."','".$isbuynow."','".$priceatt."','".$priceatt_combine."','".$priceatt_combine_id."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."','".$isfeatured."','".$lastInserId."',3,'".$manufacturerId."','".getRealescape($producttag_pt)."')";
			$rslt = $db->insert($str);
			$ptlastInserId = $db->insert_id;
			
			$log = $db->insert_log("insert","".TPLPrefix."product","","product Add successfully","product",$str);
			
	
			
			//Updating the attribute values   - starts 

			foreach($_REQUEST as $key => $val){
									
				if(strpos($key,"customattrib")  !== false){
					$t = explode("_",$key);					
					$attrId = (isset($t[2]))? $t[2]: '';
					if(isset($t[1]) && $t[1] != ""){
						
						switch(trim($t[1])){
							
							case 'text' :
							$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values(0,'".$lastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,1)";                                 								
								 $db->insert($str);
								 break;
							case 'textarea':
								 $str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values(0,'".$lastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,1)";                                 								
								 $db->insert($str);
								 $textarealastInserId = $db->insert_id;
							 
                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar Add successfully","product_attr_varchar",$str);								 
							break;							
							case 'checkbox':							
								foreach($val as $attrVal){
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values(0,'".$lastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',1)";	
								// echo $str;
								$db->insert($str);	
                                $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);								
								}
							break;	
							case 'radio':	
											
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_idproduct_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values(0,'".$lastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',1)";
								// echo $str;
								$db->insert($str);
								 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);
							break;							
							case 'dropdown':
                                						
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate,lang_id) values(0,'".$lastInserId."','".$attrId."','".$val."',1,'".$today."','".$today."',1)";
								
								$db->insert($str);	
                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);								
							break;
							case 'multiselect':
							
								foreach($val as $attrVal){
								$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values(0,'".$lastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',1)";								
								// echo $str; exit;
								$db->insert($str);
								 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);
								}	
							break;
							default :
							
							           break;
						}
												
					}										
				}
				//spanish
				if(strpos($key,"customattribes")  !== false){
					$t = explode("_",$key);					
					$attrId = (isset($t[2]))? $t[2]: '';
					if(isset($t[1]) && $t[1] != ""){
						
						switch(trim($t[1])){
							
							case 'text' :
							 $str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,2)";                                 								
								 $db->insert($str);
								 break;
							case 'textarea':								  

							 	$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,2)";                                 								
								 $db->insert($str);
							break;							
							case 'checkbox':							
								foreach($val as $attrVal){
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',2)";	
								// echo $str;
								$db->insert($str);	
                                $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);								
								}
							break;	
							case 'radio':	
											
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',2)";
								// echo $str;
								$db->insert($str);
								 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);
							break;							
							case 'dropdown':
                                						
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$val."',1,'".$today."','".$today."',2)";
								
								$db->insert($str);	
                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);								
							break;
							case 'multiselect':
							
								foreach($val as $attrVal){
								$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',2)";								
								// echo $str; exit;
								$db->insert($str);
								 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);
								}	
							break;
							default :
							
							           break;
						}
												
					}										
				}
				
				//portugues
				if(strpos($key,"customattribpt")  !== false){
					$t = explode("_",$key);					
					$attrId = (isset($t[2]))? $t[2]: '';
					if(isset($t[1]) && $t[1] != ""){
						
						switch(trim($t[1])){
							
							case 'text' :
							$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,3)";                                 								
								 $db->insert($str);
								 break;
							case 'textarea':								  

								$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,3)";                                 								
								 $db->insert($str);
							break;							
							case 'checkbox':							
								foreach($val as $attrVal){
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$ptlastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',3)";	
								// echo $str;
								$db->insert($str);	
                                $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);								
								}
							break;	
							case 'radio':	
											
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',3)";
								// echo $str;
								$db->insert($str);
								 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);
							break;							
							case 'dropdown':
                                						
								 $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$val."',1,'".$today."','".$today."',3)";
								
								$db->insert($str);	
                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);								
							break;
							case 'multiselect':
							
								foreach($val as $attrVal){
								$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$attrVal."','".$val."','".$today."','".$today."',3)";								
								// echo $str; exit;
								$db->insert($str);
								 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid Add successfully","product_attr_dropdwid",$str);
								}	
							break;
							default :
							
							           break;
						}
												
					}										
				}
			}
			//Updating the attribute values   - ends
			uploadPortfolio_array_ids(array($lastInserId=>1,$splastInserId=>2,$ptlastInserId=>3),$db,$sku,array($lastInserId,$splastInserId,$ptlastInserId));
			
			//uploadPortfolio_array_ids(array($lastInserId,$splastInserId,$ptlastInserId),$db,$sku);
			//uploadPortfolio($lastInserId,$db,$sku);	
			//uploadPortfolio($splastInserId,$db,$sku,2);	
			//uploadPortfolio($ptlastInserId,$db,$sku,3);
			
			
		 foreach($getlanguage as $languageval){ 
				uploadbrochure($lastInserId,$db,'brochureimage'.$languageval['languagefield'],$languageval['languageid']);
				 
			 
			} 
			
			
				 
			$combinationCollection = array();
			$isDefault = substr($_REQUEST["combiIsDefault"],0,-1);		
			foreach($_REQUEST as $key => $val){
				if(strpos($key,"combiqua")  !== false){
					$qua = $val;
				}
				else if(strpos($key,"combiprice")  !== false){
					$price = $val;
				}
				else if(strpos($key,"combisku")  !== false){
					$sku = $val;
					$combIdSplitT = explode("combisku_",$key);
					$combId = substr($combIdSplitT[1],0,-1);						
					$default = ($isDefault == $combId)? 1: 0;
									
					if(isset($_REQUEST["combiIsActivee_".$combId."_"]))					
						$Activeacombi = 1;
					else
						$Activeacombi = 0;
					
					$combinationCollection[] = $combId;
					$combId=str_replace("_",",",$combId);
					$combimgids=implode(",",$_REQUEST['customimg_'.$combId]);
					
					 foreach($getlanguage as $languageval){ 
					 
					 $strCombilang = "select dropdown_id from ".TPLPrefix."dropdown where parent_id = '$combId' and lang_id = '".$languageval['languageid']."' ";
					 $resltCombilang = $db->get_a_line($strCombilang);
					 
					 
					 if($languageval['languageid'] == 1){
					 $insertidcheck = $lastInserId;
					 $combIds =$combId;
					 }else if($languageval['languageid'] == 2){
					 $insertidcheck = $splastInserId;
					 $combIds =$resltCombilang['dropdown_id'];
					 }else if($languageval['languageid'] == 3){
					 $insertidcheck = $ptlastInserId;
					 $combIds =$resltCombilang['dropdown_id'];
					 }
					 
					 if($languageval['languageid'] == 1){
						 $imattcombinationid = $combimgids;
					 }else{
					 $att_image_id = $db->get_a_line("select product_img_id from ".TPLPrefix."product_images where lang_id = '".$languageval['languageid']."' and parent_id = '".$combimgids."' and IsActive = 1");
					 $imattcombinationid = $att_image_id['product_img_id'];
					 }	
					 
					$strCombiChk = "select count(*) as tot from ".TPLPrefix."product_attr_combi where attr_combi_id = '$combIds' and base_productId = '$insertidcheck' ";
					$resltCombi = $db->get_a_line($strCombiChk);
					if($resltCombi['tot'] == 0){						 						
						$combiStr = "INSERT INTO ".TPLPrefix."product_attr_combi(attr_combi_id,base_productId,quantity,price,sku,isDefault,createdDate,modifiedDate,IsActive,product_img_id,outofstock) ";
						$combiStr .= " VALUES ('".$combIds."','".$insertidcheck."','".$qua."','".$price."','".$sku."','".$default."','".$today."','".$today."','1','".$imattcombinationid."',0) ";
						$db->insert($combiStr);
						 $log = $db->insert_log("insert","".TPLPrefix."product_attr_combi","","product_attr_combi Add successfully","product_attr_combi",$combiStr);
					}
					else{
						$combiStr = "UPDATE ".TPLPrefix."product_attr_combi SET  product_img_id='".$imattcombinationid."',quantity= '".$qua."',price = '".$price."', sku = '".$sku."', modifiedDate='".$today."',isDefault =  '".$default."',IsActive='1' WHERE  base_productId = '".$insertidcheck."' AND  attr_combi_id =  '".$combIds."'  ";
                         $log = $db->insert_log("update","".TPLPrefix."product_attr_combi","","product_attr_combi updated","product_attr_combi",$combiStr);						
						$db->insert($combiStr);
					}
					 }
				}			
			}
			
			$combiSplit = array();
			foreach($combinationCollection as $val){
				$t = explode("_",$val);
				foreach($t as $t1){
					$combiSplit[] = $t1;
				}
			}
			$combiSplit = array_unique($combiSplit);
			$combiSplit = implode(",",$combiSplit);
			
			
			 foreach($getlanguage as $languageval){

			 if($languageval['languageid'] == 1){
					  // $combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."dropdown` WHERE dropdown_id IN (".$combiSplit.") and lang_id = '".$languageval['languageid']."' ";
					   
					    $combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE attributeid IN (".$chkpvatt_id.") and lang_id = '".$languageval['languageid']."' ";
						
					  // $combiOptionStr_price = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."dropdown` WHERE dropdown_id IN (".$chkpvattprice.") and lang_id = '".$languageval['languageid']."' ";
					   
					   $combiOptionStr_price = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE attributeid IN (".implode(',',$chkpvattprice).") and lang_id = '".$languageval['languageid']."' ";  
					   
					   
					   
					 }else{
						// $combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."dropdown` WHERE parent_id IN (".$combiSplit.") and lang_id = '".$languageval['languageid']."' ";
						 
						  $combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE parent_id IN (".$chkpvatt_id.") and lang_id = '".$languageval['languageid']."' ";
						 
						 
							$combiOptionStr_price = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE parent_id IN (".implode(',',$chkpvattprice).") and lang_id = '".$languageval['languageid']."' ";  
					 }
			$optionRes = $db->get_a_line($combiOptionStr);
			$optionRes_price = $db->get_a_line($combiOptionStr_price);
			
			
//$combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."dropdown` WHERE dropdown_id IN (".$combiSplit.") and lang_id = '".$languageval['languageid']."'";
		
		 
					 
					 if($languageval['languageid'] == 1){
					 $insertidcheck = $lastInserId;
					 }else if($languageval['languageid'] == 2){
					 $insertidcheck = $splastInserId;
					 }else if($languageval['languageid'] == 3){
					 $insertidcheck = $ptlastInserId;
					 }
					 
					  
					 
			$strCombiOptChk = "select count(*) as tot from ".TPLPrefix."product_attr_combi_opt where product_id = '$insertidcheck' ";
		    $resltCombiChk = $db->get_a_line($strCombiOptChk);
			if($resltCombiChk['tot'] == 0){
				$str = "INSERT INTO ".TPLPrefix."product_attr_combi_opt(optionId,product_id,createdDate,modifiedDate,optionId_price,outofstock) VALUES('".$optionRes['attrIds']."','".$insertidcheck."','".$today."','".$today."','".$optionRes_price['attrIds']."',0)";
				
				$db->insert($str);
				$log = $db->insert_log("insert","".TPLPrefix."product_attr_combi_opt","","product_attr_combi_opt Add successfully","product_attr_combi_opt",$str);
			}
			else{
				$str = "UPDATE ".TPLPrefix."product_attr_combi_opt SET optionId = '".$optionRes['attrIds']."',optionId_price='".$optionRes_price['attrIds']."',modifiedDate='".$today."' WHERE product_id = '".$insertidcheck."' ";
				 $log = $db->insert_log("update","".TPLPrefix."product_attr_combi_opt","","product_attr_combi_opt updated","product_attr_combi_opt",$str);	
                $db->insert($str);				 
			}
			 }
			//Updating attribute combination - ends
			
					
			
			if(isset($_REQUEST["categoryIDs"])){
				foreach($categoryIDs as $val){
				 	$str = "insert into ".TPLPrefix."product_categoryid(product_id,categoryID,IsActive,UserId,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$val."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',1) ";						
					$db->insert($str);
					
					$getcategoryid_es = getlanguagecategoryid($db,$val,2);
					$getcategoryid_pt = getlanguagecategoryid($db,$val,3);
					
					$str = "insert into ".TPLPrefix."product_categoryid(product_id,categoryID,IsActive,UserId,createdDate,modifiedDate,lang_id) values('".$splastInserId."','".$getcategoryid_es['categoryID']."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',2) ";						
					$db->insert($str);
					
					$str = "insert into ".TPLPrefix."product_categoryid(product_id,categoryID,IsActive,UserId,createdDate,modifiedDate,lang_id) values('".$ptlastInserId."','".$getcategoryid_pt['categoryID']."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',3) ";						
					$db->insert($str);
					
					$log = $db->insert_log("insert","".TPLPrefix."product_categoryid","","product_categoryid Add successfully","product_categoryid",$str);
				}
			}
			
			$rslt = $db->insert($str);			
			//$log = $db->insert_log("insert","".TPLPrefix."product","","Product Added Newly","product",$str);						
			//echo json_encode(array("rslt"=>$rslt)); //success
			echo json_encode(array("rslt"=>"1")); //success
		}
		else {
			 echo json_encode(array("rslt"=>"3")); //same exists
		}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	
	break;
	
	
	case 'update':	

    
	$dropdownid = implode(',',$customatt); 	 
	if(!empty($product_name)) {	
		$product_url=generateslug($product_name).'-'.generateslug($sku);	
		 $strChk = "select count(product_id) from ".TPLPrefix."product where product_name = '$product_name' and IsActive != '2' and product_id != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			
			if(isset($_FILES['product_images'])){
                
				for($i=0;$i<count($_FILES["product_images"]["tmp_name"]); $i++){
					
					list($widths, $heights) = getimagesize($_FILES["product_images"]["tmp_name"][$i]);
					
					if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths)))
			        {
					    echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				        exit();
				    }
                }
            }

			$related_products = $suggested_products = "";
			if(isset($_REQUEST['relatedproductIds']))
				$related_products  = $_REQUEST['relatedproductIds'];
			if(isset($_REQUEST['suggestedProductIds']))
				$suggested_products  = $_REQUEST['suggestedProductIds'];
						
			
			$spl_fromdate =date('Y-m-d',strtotime($spl_fromdate));
		 	$spl_todate = date('Y-m-d',strtotime($spl_todate));
			
			 $isnewproduct = (isset($isnewproduct))? 1:0;
			$isquaincrease = (isset($isquaincrease))? 1:0;
			 
			$configqua = (isset($configqua))? 1:0;
		if($isnewproduct==1){	 
			  
			  $newprod_fromdate = date('Y-m-d',strtotime($newprod_fromdate));
			   $newprod_todate = date('Y-m-d',strtotime($newprod_todate));
		}
		else{
			$newprod_fromdate = 'null';
			$newprod_todate =	'null';		
		}
			 
			
			$prevsku=$db->get_a_line("select sku,price from ".TPLPrefix."product where  product_id = '".$edit_id."' ");
			
			
			 $str = "update ".TPLPrefix."product set  manufacturerId='".$manufacturerId."',dropdown_id = '".getRealescape($dropdownid)."' ,product_name = '".getRealescape($product_name)."',description='".getRealescape($description)."',longdescription='".getRealescape($longdescription)."',metaname='".getRealescape($metaname)."',metadescription='".getRealescape($metadescription)."',metakeyword='".getRealescape($metakeyword)."', sku='".getRealescape($sku)."', product_url='".getRealescape($product_url)."', quantity='".getRealescape($quantity)."', configqua='".getRealescape($configqua)."', minquantity='".getRealescape($minquantity)."', isquaincrease='".getRealescape($isquaincrease)."', isfeaturedproduct='".getRealescape($isfeaturedproduct)."', price='".getRealescape($price)."', specialprice='".getRealescape($specialprice)."', spl_fromdate='".getRealescape($spl_fromdate)."', spl_todate='".getRealescape($spl_todate)."', isnewproduct ='".$isnewproduct."', newprod_fromdate='".getRealescape($newprod_fromdate)."', newprod_todate='".getRealescape($newprod_todate)."',taxId='".getRealescape($tax_id)."', iscustomized='".getRealescape($iscustom)."',producttag='".getRealescape($producttag)."', ";

			if($price != $prevsku['price']){
				
			$str .= " IsActive='".getRealescape($status)."', ";
			}
			 
			$str .= " isbuynow='".getRealescape($isbuynow)."',chkpvatt='".getRealescape($priceatt)."',chkpvattprice='".getRealescape($priceatt_combine)."' , chkpvattprice_id='".$priceatt_combine_id."', UserId='".$_SESSION["UserId"]."', related_products='".$related_products."',suggested_products='".$suggested_products."',modified_date = '".$today."'  where product_id = '".$edit_id."'";
			  
			
			
           			
			$db->insert($str);
			
			//spanish
  		    $strs = "update ".TPLPrefix."product set  manufacturerId='".$manufacturerId."',dropdown_id = '".getRealescape($dropdownid)."' ,product_name = '".getRealescape($product_name_es)."',description='".getRealescape($description_es)."',longdescription='".getRealescape($longdescription_es)."',metaname='".getRealescape($metaname_es)."',metadescription='".getRealescape($metadescription_es)."',metakeyword='".getRealescape($metakeyword_es)."', sku='".getRealescape($sku)."', product_url='".getRealescape($product_url)."', quantity='".getRealescape($quantity)."', configqua='".getRealescape($configqua)."', minquantity='".getRealescape($minquantity)."', isquaincrease='".getRealescape($isquaincrease)."', isfeaturedproduct='".getRealescape($isfeaturedproduct)."', price='".getRealescape($price)."', specialprice='".getRealescape($specialprice)."', spl_fromdate='".getRealescape($spl_fromdate)."', spl_todate='".getRealescape($spl_todate)."', isnewproduct ='".$isnewproduct."', newprod_fromdate='".getRealescape($newprod_fromdate)."', newprod_todate='".getRealescape($newprod_todate)."',taxId='".getRealescape($tax_id)."', iscustomized='".getRealescape($iscustom)."',producttag='".getRealescape($producttag_es)."', ";
			if($price != $prevsku['price']){				
			$strs .= " IsActive='".getRealescape($status)."', ";
			}
			 
			$strs .= " isbuynow='".getRealescape($isbuynow)."',chkpvatt='".getRealescape($priceatt)."',chkpvattprice='".getRealescape($priceatt_combine)."' , chkpvattprice_id='".$priceatt_combine_id."' , UserId='".$_SESSION["UserId"]."', related_products='".$related_products_es."',suggested_products='".$suggested_products_es."',modified_date = '".$today."'  where product_id = '".$edit_id_es."'";		   		
			$db->insert($strs);
			
			//portugues
  		    $strs = "update ".TPLPrefix."product set  manufacturerId='".$manufacturerId."',dropdown_id = '".getRealescape($dropdownid)."' ,product_name = '".getRealescape($product_name_pt)."',description='".getRealescape($description_pt)."',longdescription='".getRealescape($longdescription_pt)."',metaname='".getRealescape($metaname_pt)."',metadescription='".getRealescape($metadescription_pt)."',metakeyword='".getRealescape($metakeyword_pt)."', sku='".getRealescape($sku)."', product_url='".getRealescape($product_url)."', quantity='".getRealescape($quantity)."', configqua='".getRealescape($configqua)."', minquantity='".getRealescape($minquantity)."', isquaincrease='".getRealescape($isquaincrease)."', isfeaturedproduct='".getRealescape($isfeaturedproduct)."', price='".getRealescape($price)."', specialprice='".getRealescape($specialprice)."', spl_fromdate='".getRealescape($spl_fromdate)."', spl_todate='".getRealescape($spl_todate)."', isnewproduct ='".$isnewproduct."', newprod_fromdate='".getRealescape($newprod_fromdate)."', newprod_todate='".getRealescape($newprod_todate)."',taxId='".getRealescape($tax_id)."', iscustomized='".getRealescape($iscustom)."',producttag='".getRealescape($producttag_pt)."', ";
			if($price != $prevsku['price']){				
			$strs .= " IsActive='".getRealescape($status)."', ";
			}
			 
			$strs .= " isbuynow='".getRealescape($isbuynow)."',chkpvattprice='".getRealescape($priceatt_combine)."',chkpvatt='".getRealescape($priceatt)."' , chkpvattprice_id='".$priceatt_combine_id."' , UserId='".$_SESSION["UserId"]."', related_products='".$related_products_pt."',suggested_products='".$suggested_products_pt."',modified_date = '".$today."'  where product_id = '".$edit_id_pt."'";		   		
			$db->insert($strs);
			
			 $str = "update ".TPLPrefix."product_images SET sku='".getRealescape($sku)."',isthumbdefault = '0', ismediumdefault = '0', isbasedefault = '0',modifiedDate = '".$today."' WHERE product_id = '".$edit_id."' and  sku='".$prevsku['sku']."'";
			
			//$log = $db->insert_log("update","".TPLPrefix."product_images","","product_images updated","product_images",$str);
            $db->insert($str);	
			
			
	$ptlastInserId = $edit_id_pt;
			$splastInserId = $edit_id_es;
$lastInserId = $edit_id;
			
			if(isset($isthumbdefault)){	
			
				$str = "update ".TPLPrefix."product_images SET isthumbdefault = 1,modifiedDate = '".$today."' WHERE product_img_id = '".$isthumbdefault."' ";	
				
				$log = $db->insert_log("update","".TPLPrefix."product_images","","product_images updated","product_images",$str);
				$db->insert($str);
			}
			if(isset($ismediumdefault)){				
				$str = "update ".TPLPrefix."product_images SET ismediumdefault = '1',modifiedDate = '".$today."' WHERE product_img_id = '".$ismediumdefault."' ";
				
				$log = $db->insert_log("update","".TPLPrefix."product_images","","product_images updated","product_images",$str);
				$db->insert($str);
			}
			if(isset($isbasedefault)){	
			
				$str = "update ".TPLPrefix."product_images SET isbasedefault = 1,modifiedDate = '".$today."' WHERE product_img_id = '".$isbasedefault."' ";
				
				$log = $db->insert_log("update","".TPLPrefix."product_images","","product_images updated","product_images",$str);
				$db->insert($str);
				
			}
			
			
			//Updating attribute combination - starts
			$combinationCollection = array();
			$isDefault = substr($_REQUEST["combiIsDefault"],0,-1);				
			foreach($_REQUEST as $key => $val){
				
			
					 
					 
				if(strpos($key,"combiqua")  !== false){
					$qua = $val;
				}
				else if(strpos($key,"combiprice")  !== false){
					$price = $val;
				}
				else if(strpos($key,"combisku")  !== false){
					
					
					$sku = $val;
					$combIdSplitT = explode("combisku_",$key);
					$combId = substr($combIdSplitT[1],0,-1);
					$combinationCollection[] = $combId;		
					$combId=str_replace("_",",",$combId);
					
					  	$strCombilangs = "select attributeId from ".TPLPrefix."dropdown where dropdown_id = '$combId' ";
					 $resltCombilangs = $db->get_a_line($strCombilangs);
					 
					   $isDefault = substr($_REQUEST['combiIsDefaultid_'.$resltCombilangs['attributeId'].'_0'],0,-1);	
					  
					   $isDefault1 = substr($_REQUEST['combiIsDefaultid_'.$resltCombilangs['attributeId'].'_1'],0,-1);						   
					 
				 	$default = ($isDefault == $combId || $isDefault1 == $combId)? 1: 0;
					 
					if(isset($_REQUEST["combiIsActive_".$combId."_"]))					
						$Activeacombi = 1;
					else
						$Activeacombi = 0;
				//				 echo "kk"."combiIssold_".$combId;
				 if(isset($_REQUEST["combiIssold_".$combId]))					
						$soldoutcombi = 1;
					else
						$soldoutcombi = 0;
					
					$combimgids=implode(",",$_REQUEST['customimg_'.$combId]);
					
					foreach($getlanguage as $languageval){ 
					 
					 $strCombilang = "select dropdown_id from ".TPLPrefix."dropdown where parent_id = '$combId' and lang_id = '".$languageval['languageid']."' ";
					 $resltCombilang = $db->get_a_line($strCombilang);					 
					 
					 if($languageval['languageid'] == 1){
					 $insertidcheck = $edit_id;
					 $combIds =$combId;
					 }else if($languageval['languageid'] == 2){
					 $insertidcheck = $edit_id_es;
					 $combIds =$resltCombilang['dropdown_id'];
					 }else if($languageval['languageid'] == 3){
					 $insertidcheck = $edit_id_pt;
					 $combIds =$resltCombilang['dropdown_id'];
					 }
					 
					 if($languageval['languageid'] == 1){
						 $imattcombinationid = $combimgids;
					 }else{
						//echo "select product_img_id from ".TPLPrefix."product_images where lang_id = '".$languageval['languageid']."' and parent_id = '".$combimgids."' and IsActive = 1";
					//	die();
						 
					 $att_image_id = $db->get_a_line("select product_img_id from ".TPLPrefix."product_images where lang_id = '".$languageval['languageid']."' and parent_id = '".$combimgids."' and IsActive = 1");
					 $imattcombinationid = $att_image_id['product_img_id'];
					 }					 
					 
				 	$strCombiChk = "select count(*) as tot from ".TPLPrefix."product_attr_combi where attr_combi_id = '$combIds' and base_productId = '$insertidcheck' ";
					$resltCombi = $db->get_a_line($strCombiChk);
					if($resltCombi['tot'] == 0){
						    $combiStr = "INSERT INTO ".TPLPrefix."product_attr_combi(attr_combi_id,base_productId,quantity,price,sku,isDefault,createdDate,modifiedDate,IsActive,product_img_id,outofstock) ";
						$combiStr .= " VALUES ('".$combIds."','".$insertidcheck."','".$qua."','".$price."','".$sku."','".$default."','".$today."','".$today."','1','".$imattcombinationid."',0) ";
						$db->insert($combiStr);
						$log = $db->insert_log("insert","".TPLPrefix."product_attr_combi","","product_attr_combi inserted","product_attr_combi",$combiStr);
					}
					else{
						  $combiStr = "UPDATE ".TPLPrefix."product_attr_combi SET product_img_id='".$imattcombinationid."',quantity= '".$qua."',price = '".$price."', sku = '".$sku."', isDefault =  '".$default."',modifiedDate = '".$today."',IsActive='1',outofstock = '".$soldoutcombi."' WHERE  base_productId = '".$insertidcheck."' AND  attr_combi_id =  '".$combIds."'  ";

                         $log = $db->insert_log("update","".TPLPrefix."product_attr_combi","","product_attr_combi updated","product_attr_combi",$combiStr);						
						$db->insert($combiStr);
					}
					}
				}			
			}
			
			$combiSplit = array();
			foreach($combinationCollection as $val){
				$t = explode("_",$val);
				foreach($t as $t1){
					$combiSplit[] = $t1;
				}
			}
			$combiSplit = array_unique($combiSplit);
			$combiSplit = implode(",",$combiSplit);
			
			foreach($getlanguage as $languageval){ 
					 if($languageval['languageid'] == 1){
					    //$combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."dropdown` WHERE dropdown_id IN (".$combiSplit.") and lang_id = '".$languageval['languageid']."' ";
						
						  $combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE attributeid IN (".$chkpvatt_id.") and lang_id = '".$languageval['languageid']."' "; 
					   
				  	   $combiOptionStr_price = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE attributeid IN (".implode(',',$chkpvattprice).") and lang_id = '".$languageval['languageid']."' ";
					 
					   
					 }else{
						 
						 $combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE parent_id IN (".$chkpvatt_id.") and lang_id = '".$languageval['languageid']."' ";
						 
						
					 	$combiOptionStr_price = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."m_attributes` WHERE parent_id IN (".implode(',',$chkpvattprice).") and lang_id = '".$languageval['languageid']."' ";  
					 }
			$optionRes = $db->get_a_line($combiOptionStr);
			$optionRes_price = $db->get_a_line($combiOptionStr_price);
			
					 if($languageval['languageid'] == 1){
					 $insertidcheck = $edit_id;
					 }else if($languageval['languageid'] == 2){
					 $insertidcheck = $edit_id_es;
					 }else if($languageval['languageid'] == 3){
					 $insertidcheck = $edit_id_pt;
					 }
			
			 $strCombiOptChk = "select count(*) as tot from ".TPLPrefix."product_attr_combi_opt where product_id = '$insertidcheck' ";
		    $resltCombiChk = $db->get_a_line($strCombiOptChk);
			if($resltCombiChk['tot'] == 0){
				
				$str = "INSERT INTO ".TPLPrefix."product_attr_combi_opt(optionId,product_id,createdDate,modifiedDate,optionId_price,outofstock) VALUES('".$optionRes['attrIds']."','".$insertidcheck."','".$today."','".$today."','".$optionRes_price['attrIds']."',0)";
				$db->insert($str);
				 $log = $db->insert_log("insert","".TPLPrefix."product_attr_combi_opt","","product_attr_combi_opt inserted","product_attr_combi_opt",$str);	
			}
			else{
				$str = "UPDATE ".TPLPrefix."product_attr_combi_opt SET optionId = '".$optionRes['attrIds']."',modifiedDate = '".$today."',optionId_price='".$optionRes_price['attrIds']."' WHERE product_id = '".$insertidcheck."' ";
				
				 $log = $db->insert_log("update","".TPLPrefix."product_attr_combi_opt","","product_attr_combi_opt updated","product_attr_combi_opt",$combiStr);	
				 $db->insert($str);
			}
			}
			//Updating attribute combination - ends
			
			
			//Updating the attribute values   - starts 
			foreach($_REQUEST as $key => $val){
				if(strpos($key,"customattriben")  !== false){
					$t = explode("_",$key);
					$attrId = (isset($t[2]))? $t[2]: '';
					if(isset($t[1]) && $t[1] != ""){
						switch($t[1]){
							case 'text':
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$edit_id."' and  attribute_id = '".$attrId."'  ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive) values(0,'".$edit_id."','".$attrId."','".$val."','".$today."','".$today."',1)";
                                        $db->insert($str);	
										 $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar inserted","product_attr_varchar",$str);	
										
									}else {
										$str = "update ".TPLPrefix."product_attr_varchar SET attribute_value = '".$val."',modifiedDate = '".$today."',IsActive=1 WHERE product_id = '".$edit_id."' AND attribute_id = '".$attrId."' ";		
										 $log = $db->insert_log("update","".TPLPrefix."product_attr_varchar","","product_attr_varchar updated","product_attr_varchar",$str);	
                                        $db->insert($str);										
									}
									
								}
							break;	
							case 'textarea':	
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$edit_id."' and  attribute_id = '".$attrId."'  ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values(0,'".$edit_id."','".$attrId."','".$val."','".$today."','".$today."',1,1)";
                                         $db->insert($str);	
										 
										  $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar inserted","product_attr_varchar",$str);	
										 
									}else {
										$str = "update ".TPLPrefix."product_attr_varchar SET attribute_value = '".$val."',modifiedDate = '".$today."',IsActive=1 WHERE product_id = '".$edit_id."' AND attribute_id = '".$attrId."' ";	

                                         $log = $db->insert_log("update","".TPLPrefix."product_attr_varchar","","product_attr_varchar updated","product_attr_varchar",$str);											
                                        $db->insert($str);										
									}
									
								}
							break;							
							case 'checkbox':
								$db->insert("delete from ".TPLPrefix."product_attr_dropdwid where product_id = '".$edit_id."' and  attribute_id = '".$attrId."'  ");
								foreach($val as $attrVal){
								   $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate) values(0,'".$edit_id."','".$attrId."','".$attrVal."','".$today."','".$today."')";	
									$db->insert($str);
                                    $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);									
								}
							break;	
							case 'radio':							
								$str = "update ".TPLPrefix."product_attr_dropdwid SET dropdown_id = '".$val."',modifiedDate = '".$today."' WHERE product_id = '".$edit_id."' AND attribute_id = '".$attrId."' ";
								
								$log = $db->insert_log("update","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid updated","product_attr_dropdwid",$str);
								$db->insert($str);								
							break;							
							case 'dropdown':														
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_dropdwid where product_id = '".$edit_id."' and  attribute_id = '".$attrId."'  ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate) values(0,'".$edit_id.	"','".$attrId."','".$val."',1,'".$today."','".$today."')";
                                        $db->insert($str);	
                                         $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);
										
									}else {
										$str = "update ".TPLPrefix."product_attr_dropdwid SET dropdown_id = '".$val."',IsActive=1,modifiedDate = '".$today."' WHERE product_id = '".$edit_id."' AND attribute_id = '".$attrId."' ";	
										
										$log = $db->insert_log("update","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid updated","product_attr_dropdwid",$str);
										
										$db->insert($str);
									}
											
								}								
							break;
							case 'multiselect':
								$str = "delete from ".TPLPrefix."product_attr_dropdwid where product_id = '".$edit_id."' and  attribute_id = '".$attrId."'  ";
								
								  $log = $db->insert_log("delete","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid deleted","product_attr_dropdwid",$str);
								
								$db->insert($str);	
								
								foreach($val as $attrVal){
								$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate) values(0,'".$edit_id."','".$attrId."','".$attrVal."','".$today."','".$today."')";	
								$db->insert($str);	

                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);								
								}	
							break;
						}						
					}										
				}
			}			
			
			//Updating the attribute values   - starts  - spanish
			foreach($_REQUEST as $key => $val){
				if(strpos($key,"customattribes")  !== false){
					$t = explode("_",$key);
					$attrId = (isset($t[2]))? $t[2]: '';
					if(isset($t[1]) && $t[1] != ""){
						 
						switch($t[1]){
							case 'text':
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$splastInserId."' and  attribute_id = '".$attrId."' and lang_id = 2 ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,2)";
                                        $db->insert($str);	
										 $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar inserted","product_attr_varchar",$str);	
										
									}else {
										$str = "update ".TPLPrefix."product_attr_varchar SET attribute_value = '".$val."',modifiedDate = '".$today."',IsActive=1 WHERE lang_id = 2 and product_id = '".$splastInserId."' AND attribute_id = '".$attrId."' ";		
										 $log = $db->insert_log("update","".TPLPrefix."product_attr_varchar","","product_attr_varchar updated","product_attr_varchar",$str);	
                                        $db->insert($str);										
									}
									
								}
							break;	
							case 'textarea':	
							
							//echo "select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$splastInserId."' and  attribute_id = '".$attrId."' and lang_id = 2  ";
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$splastInserId."' and  attribute_id = '".$attrId."' and lang_id = 2  ");
								 
								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
									  	$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,2)";
                                         $db->insert($str);	
										 
										  $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar inserted","product_attr_varchar",$str);	
										 
									}else {
									 	  $str = "update ".TPLPrefix."product_attr_varchar SET attribute_value = '".$val."',modifiedDate = '".$today."',IsActive=1 WHERE product_id = '".$splastInserId."' AND attribute_id = '".$attrId."' and lang_id = 2 ";	

                                         $log = $db->insert_log("update","".TPLPrefix."product_attr_varchar","","product_attr_varchar updated","product_attr_varchar",$str);											
                                        $db->insert($str);										
									}
									
								}
							break;							
							case 'checkbox':
								$db->insert("delete from ".TPLPrefix."product_attr_dropdwid where product_id = '".$splastInserId."' and  attribute_id = '".$attrId."' and lang_id = 2 ");
								foreach($val as $attrVal){
								   $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$attrVal."','".$today."','".$today."',2)";	
									$db->insert($str);
                                    $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);									
								}
							break;	
							case 'radio':							
								$str = "update ".TPLPrefix."product_attr_dropdwid SET dropdown_id = '".$val."',modifiedDate = '".$today."' WHERE lang_id = 2 and product_id = '".$splastInserId."' AND attribute_id = '".$attrId."' ";
								
								$log = $db->insert_log("update","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid updated","product_attr_dropdwid",$str);
								$db->insert($str);								
							break;							
							case 'dropdown':														
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_dropdwid where lang_id = 2 and product_id = '".$splastInserId."' and  attribute_id = '".$attrId."'  ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$val."',1,'".$today."','".$today."',2)";
                                        $db->insert($str);	
                                         $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);
										
									}else {
										$str = "update ".TPLPrefix."product_attr_dropdwid SET dropdown_id = '".$val."',IsActive=1,modifiedDate = '".$today."' WHERE lang_id = 2 and product_id = '".$splastInserId."' AND attribute_id = '".$attrId."' ";	
										
										$log = $db->insert_log("update","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid updated","product_attr_dropdwid",$str);
										
										$db->insert($str);
									}
											
								}								
							break;
							case 'multiselect':
								$str = "delete from ".TPLPrefix."product_attr_dropdwid where lang_id = 2 and product_id = '".$splastInserId."' and  attribute_id = '".$attrId."'  ";
								
								  $log = $db->insert_log("delete","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid deleted","product_attr_dropdwid",$str);
								
								$db->insert($str);	
								
								foreach($val as $attrVal){
								$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$splastInserId."','".$attrId."','".$attrVal."','".$today."','".$today."',2)";	
								$db->insert($str);	

                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);								
								}	
							break;
						}						
					}										
				}
			}			
			
			
			//Updating the attribute values   - starts  - portugues
			foreach($_REQUEST as $key => $val){
				if(strpos($key,"customattribpt")  !== false){
					$t = explode("_",$key);
					$attrId = (isset($t[2]))? $t[2]: '';
					if(isset($t[1]) && $t[1] != ""){
						switch($t[1]){
							case 'text':
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$ptlastInserId."' and  attribute_id = '".$attrId."' and lang_id = 3 ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,3)";
                                        $db->insert($str);	
										 $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar inserted","product_attr_varchar",$str);	
										
									}else {
										$str = "update ".TPLPrefix."product_attr_varchar SET attribute_value = '".$val."',modifiedDate = '".$today."',IsActive=1 WHERE lang_id = 3 and product_id = '".$ptlastInserId."' AND attribute_id = '".$attrId."' ";		
										 $log = $db->insert_log("update","".TPLPrefix."product_attr_varchar","","product_attr_varchar updated","product_attr_varchar",$str);	
                                        $db->insert($str);										
									}
									
								}
							break;	
							case 'textarea':	
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_varchar where product_id = '".$ptlastInserId."' and  attribute_id = '".$attrId."' and lang_id = 3  ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_varchar(masterproduct_id,product_id,attribute_id,attribute_value,createdDate,modifiedDate,IsActive,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$val."','".$today."','".$today."',1,3)";
                                         $db->insert($str);	
										 
										  $log = $db->insert_log("insert","".TPLPrefix."product_attr_varchar","","product_attr_varchar inserted","product_attr_varchar",$str);	
										 
									}else {
										$str = "update ".TPLPrefix."product_attr_varchar SET attribute_value = '".$val."',modifiedDate = '".$today."',IsActive=1 WHERE product_id = '".$ptlastInserId."' AND attribute_id = '".$attrId."' and lang_id = 3 ";	

                                         $log = $db->insert_log("update","".TPLPrefix."product_attr_varchar","","product_attr_varchar updated","product_attr_varchar",$str);											
                                        $db->insert($str);										
									}
									
								}
							break;							
							case 'checkbox':
								$db->insert("delete from ".TPLPrefix."product_attr_dropdwid where product_id = '".$ptlastInserId."' and  attribute_id = '".$attrId."' and lang_id = 3 ");
								foreach($val as $attrVal){
								   $str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$attrVal."','".$today."','".$today."',3)";	
									$db->insert($str);
                                    $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);									
								}
							break;	
							case 'radio':							
								$str = "update ".TPLPrefix."product_attr_dropdwid SET dropdown_id = '".$val."',modifiedDate = '".$today."' WHERE lang_id = 3 and product_id = '".$ptlastInserId."' AND attribute_id = '".$attrId."' ";
								
								$log = $db->insert_log("update","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid updated","product_attr_dropdwid",$str);
								$db->insert($str);								
							break;							
							case 'dropdown':														
								$checkDuplicate = $db->get_a_line("select count(*) totcount from ".TPLPrefix."product_attr_dropdwid where lang_id = 3 and product_id = '".$ptlastInserId."' and  attribute_id = '".$attrId."'  ");								
								if($val != ""){
									if($checkDuplicate['totcount'] == 0){
										$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$val."',1,'".$today."','".$today."',3)";
                                        $db->insert($str);	
                                         $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);
										
									}else {
										$str = "update ".TPLPrefix."product_attr_dropdwid SET dropdown_id = '".$val."',IsActive=1,modifiedDate = '".$today."' WHERE lang_id = 3 and product_id = '".$ptlastInserId."' AND attribute_id = '".$attrId."' ";	
										
										$log = $db->insert_log("update","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid updated","product_attr_dropdwid",$str);
										
										$db->insert($str);
									}
											
								}								
							break;
							case 'multiselect':
								$str = "delete from ".TPLPrefix."product_attr_dropdwid where lang_id = 3 and product_id = '".$ptlastInserId."' and  attribute_id = '".$attrId."'  ";
								
								  $log = $db->insert_log("delete","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid deleted","product_attr_dropdwid",$str);
								
								$db->insert($str);	
								
								foreach($val as $attrVal){
								$str = "insert into ".TPLPrefix."product_attr_dropdwid(masterproduct_id,product_id,attribute_id,dropdown_id,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$ptlastInserId."','".$attrId."','".$attrVal."','".$today."','".$today."',3)";	
								$db->insert($str);	

                                 $log = $db->insert_log("insert","".TPLPrefix."product_attr_dropdwid","","product_attr_dropdwid inserted","product_attr_dropdwid",$str);								
								}	
							break;
						}						
					}										
				}
			}		
			
				$splastInserId  = $edit_id_es;		
				$ptlastInserId  = $edit_id_pt;
				$lastInserId  = $edit_id;
		
			uploadPortfolio_array_ids(array($edit_id=>1,$splastInserId=>2,$ptlastInserId=>3),$db,$sku,array($edit_id,$splastInserId,$ptlastInserId));
			//uploadPortfolio($edit_id,$db,$sku);
			//uploadPortfolio('2',$db,$sku,2);	
			//uploadPortfolio('3',$db,$sku,3);
		//	echo "fff"; die();
	
					
		 foreach($getlanguage as $languageval){ 
				uploadbrochure($edit_id,$db,'brochureimage'.$languageval['languagefield'],$languageval['languageid']);				 			
			} 
			################### Specification start ##################
			  
									
			//$db->insert("delete from ".TPLPrefix."product_categoryid where product_id = '".$edit_id."' ");
			if(isset($categoryIDs)){
				$categoryIDses = $categoryIDspt = array();
			for($jj=0;$jj<count($categoryIDs);$jj++)
			{
				
				$chkmodulethere_ed = $db->get_a_line("select product_catiid from ".TPLPrefix."product_categoryid where product_id = '".$edit_id."' and categoryID='".$categoryIDs[$jj]."'  and  IsActive=1 and lang_id = 1  ");
						$chk_attrmapid = $chkmodulethere_ed['product_catiid'];
										
					
					$updateQry =" insert into ".TPLPrefix."product_categoryid (product_catiid, product_id, categoryID, IsActive, UserId, createdDate, modifiedDate,lang_id ) values('".$chk_attrmapid."','".$edit_id."','".$categoryIDs[$jj]."','1','".$_SESSION["UserId"]."','".$today."', '".$today."' ,1) 
					ON DUPLICATE KEY UPDATE product_id='".$edit_id."',categoryID='".$categoryIDs[$jj]."',IsActive='1',modifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."' ";
					
					
				/*	$chkmodulethere_ed = $db->get_a_line("select product_catiid from ".TPLPrefix."product_categoryid where product_id = '".$edit_id."' and categoryID='".$categoryIDs[$jj]."'  and  IsActive=1 and lang_id = 1 ");
						$chk_attrmapid = $chkmodulethere_ed['product_catiid'];
										
					
				 	$updateQry =" insert into ".TPLPrefix."product_categoryid (product_catiid, product_id, categoryID, IsActive, UserId, createdDate, modifiedDate,lang_id ) values('".$chk_attrmapid."','".$edit_id."','".$categoryIDs[$jj]."','1','".$_SESSION["UserId"]."','".$today."', '".$today."',1 ) 
					ON DUPLICATE KEY UPDATE product_id='".$edit_id."',categoryID='".$categoryIDs[$jj]."',IsActive='1',modifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."',lang_id =1 ";*/
					
					
					$db->insert($updateQry); 
				   $db->insert_log("insert","".TPLPrefix."product_categoryid",$insert_id,"Product Category added ","Product Category",$updateQry);	
				   
				   
				   $getcategoryid_es = getlanguagecategoryid($db,$categoryIDs[$jj],2);
					$getcategoryid_pt = getlanguagecategoryid($db,$categoryIDs[$jj],3);
					
					$categoryIDses[] = $getcategoryid_es['categoryID'];
					$categoryIDspt[] = $getcategoryid_pt['categoryID'];
				   
				   $chkmodulethere_es = $db->get_a_line("select product_catiid from ".TPLPrefix."product_categoryid where product_id = '".$edit_id."' and categoryID='".$getcategoryid_es['categoryID']."'  and  IsActive=1  ");
						$chk_attrmapides = $chkmodulethere_es['product_catiid'];
						
						$chkmodulethere_pt = $db->get_a_line("select product_catiid from ".TPLPrefix."product_categoryid where product_id = '".$edit_id."' and categoryID='".$getcategoryid_pt['categoryID']."'  and  IsActive=1  ");
						$chk_attrmapidpt = $chkmodulethere_pt['product_catiid'];
				   
			 	   $updateQry =" insert into ".TPLPrefix."product_categoryid (product_catiid, product_id, categoryID, IsActive, UserId, createdDate, modifiedDate,lang_id ) values('".$chk_attrmapides."','".$splastInserId."','".$getcategoryid_es['categoryID']."','1','".$_SESSION["UserId"]."','".$today."', '".$today."',2) 
					ON DUPLICATE KEY UPDATE product_id='".$splastInserId."',categoryID='".$getcategoryid_es['categoryID']."',IsActive='1',modifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."'  ";
					
					$db->insert($updateQry); 
					
			 		$updateQry =" insert into ".TPLPrefix."product_categoryid (product_catiid, product_id, categoryID, IsActive, UserId, createdDate, modifiedDate,lang_id ) values('".$chk_attrmapidpt."','".$ptlastInserId."','".$getcategoryid_pt['categoryID']."','1','".$_SESSION["UserId"]."','".$today."', '".$today."',3 ) 
					ON DUPLICATE KEY UPDATE product_id='".$ptlastInserId."',categoryID='".$getcategoryid_pt['categoryID']."',IsActive='1',modifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."' ";
					
					$db->insert($updateQry); 
			}	
			
			 
			$selqry = "select group_concat(categoryID) as id from   ".TPLPrefix."product_categoryid  where product_id = '".$edit_id."' and IsActive=1 and lang_id = 1 "; 
			$resattributeId=$db->get_a_line($selqry);
			$resattributeId=explode(",",$resattributeId['id']);
			
			$delattribute=array_diff($categoryIDs,$resattributeId);
		
			if(count($delattribute)>0)
			{
				foreach($delattribute as $d){
					
				   $str = "update ".TPLPrefix."product_categoryid set IsActive = 2, UserId='".$_SESSION["UserId"]."',modifiedDate='".$today."'  where product_id = '".$edit_id."' and categoryID= '".$d."' and lang_id = 1"; 
					$db->insert_log("delete","".TPLPrefix."product_categoryid",$edit_id,"Product Category deleted","Product Category",$str);
				   $db->insert($str);
				  
				}
				
			}

			$selqry = "select group_concat(categoryID) as id from   ".TPLPrefix."product_categoryid  where product_id = '".$splastInserId."' and IsActive=1 and lang_id = 2"; 
			$resattributeId=$db->get_a_line($selqry);
			$resattributeId=explode(",",$resattributeId['id']);
			
				$delattribute=array_diff($categoryIDses,$resattributeId); 
		
			if(count($delattribute)>0)
			{
				foreach($delattribute as $d){
					
				   $str = "update ".TPLPrefix."product_categoryid set IsActive = 2, UserId='".$_SESSION["UserId"]."',modifiedDate='".$today."'  where product_id = '".$splastInserId."' and categoryID= '".$d."' and lang_id =2"; 
					$db->insert_log("delete","".TPLPrefix."product_categoryid",$splastInserId,"Product Category deleted","Product Category",$str);
				   $db->insert($str);
				  
				}
				
			}

$selqry = "select group_concat(categoryID) as id from   ".TPLPrefix."product_categoryid  where product_id = '".$ptlastInserId."' and IsActive=1 and lang_id = 3 "; 
			$resattributeId=$db->get_a_line($selqry);
			$resattributeId=explode(",",$resattributeId['id']);
			
			//$delattribute=array_diff($resattributeId,$categoryIDspt);
			$delattribute=array_diff($categoryIDses,$categoryIDspt); 
			if(count($delattribute)>0)
			{
				foreach($delattribute as $d){
					
				   $str = "update ".TPLPrefix."product_categoryid set IsActive = 2, UserId='".$_SESSION["UserId"]."',modifiedDate='".$today."'  where product_id = '".$ptlastInserId."' and categoryID= '".$d."' and lang_id = 3"; 
					$db->insert_log("delete","".TPLPrefix."product_categoryid",$ptlastInserId,"Product Category deleted","Product Category",$str);
				   $db->insert($str);
				  
				}
				
			}			
					
			}
			
			echo json_encode(array("rslt"=>"2"));
		}
		else {
			echo json_encode(array("rslt"=>"3")); //same exists
		}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
		
	break;
	
	case 'del':
	 $edit_id = base64_decode($Id);
	  
	 // $today = date("Y-m-d");
	 $str="update ".TPLPrefix."product set IsActive = '2', modified_date = '$today' , UserId='".$_SESSION["UserId"]."'  where product_id = '".$edit_id."' ";
	 //echo $str; exit;
	 $db->insert_log("delete","".TPLPrefix."product",$edit_id,"Product deleted","Product",$str);
	 $db->insert($str); 	 
	  
	 $str="update ".TPLPrefix."product set IsActive = '2', modified_date = '$today' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' ";
	 $db->insert($str); 	
 	 echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	//$today = date("Y-m-d");
	$status = $actval;
		 
	$str="update ".TPLPrefix."product set IsActive = '".$status."', modified_date = '$today' , userid='".$_SESSION["UserId"]."'  where product_id = '".$edit_id."'  ";
	$db->insert_log("update","".TPLPrefix."product",$edit_id,"Product statuschanged","Product",$str);
	$db->insert($str); 	
	
	$str="update ".TPLPrefix."product set IsActive = '".$status."', modified_date = '$today' , userid='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."'  ";
	$db->insert($str); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
		
	
	break;
	
	
	case 'changeishome':
	  $edit_id = base64_decode($Id);
	  //$today = date("Y-m-d");
	  $ishome = $actval;
		  $str="update ".TPLPrefix."product set displayinhome = '".$ishome."',modified_date = '$today' , userid='".$_SESSION["UserId"]."'  where product_id = '".$edit_id."'  ";
		  $db->insert($str); 	
		  //echo $str; die();
		  $db->insert_log("ishome Change","".TPLPrefix."product",$edit_id,"change status ishome has been changed","Holding duration",$str);
		  echo json_encode(array("rslt"=>"6")); //status update success
	break;
	
	
	case 'deleteImg':
				
	$productId = base64_decode($_REQUEST['prodId']);
	$productImgId = base64_decode($_REQUEST['prodImgId']);
	$str_ed = "SELECT * FROM  `".TPLPrefix."product_images` where product_id = '".$productId."' and product_img_id = '".$productImgId."'  ";									
	$res_ed = $db->get_a_line($str_ed);
	
	//deleteing  the image from db and server
	 $str_delid = "DELETE FROM  `".TPLPrefix."product_images` where product_id = '".$productId."' and product_img_id = '".$productImgId."'  ";	
     
    $db->insert_log("delete","".TPLPrefix."product_images",$edit_id,"product_images deleted","product_images",$str_delid); 
	$res_delid = $db->get_a_line($str_delid);	
	
	$target_dir	= '../uploads/productassest/'.$productId."/photos/".$res_ed['img_path'];
	$target_dirt	= '../uploads/productassest/'.$productId."/photos/thumb/".$res_ed['img_path'];
	$target_dirm	= '../uploads/productassest/'.$productId."/photos/medium/".$res_ed['img_path'];
	$target_dirb	= '../uploads/productassest/'.$productId."/photos/base/".$res_ed['img_path'];
	unlink($target_dir);
	unlink($target_dirt);
	unlink($target_dirm);
	unlink($target_dirb);
	//header("Location: product_form.php?act=edit&id=".$_REQUEST['prodId']);
	exit;
	break;
	
	case 'deleteBrochure':
				
    	$productId = $_REQUEST['prodId'];
        $str_ed = "SELECT brochureimage FROM  ".TPLPrefix."product t1 where t1.product_id = '".$productId."'";
    	$res_ed = $db->get_a_line($str_ed);
        $db->insert("update ".TPLPrefix."product set brochureimage = '', userid='".$_SESSION["UserId"]."'  where product_id = '".$productId."'  ");
        unlink("../uploads/brochure/".$res_ed['brochureimage']); 
        
        $log = $db->insert_log("delete","".TPLPrefix."product","","product brochureimage deleted","product brochureimage",$str_ed);
        

	break;
	
	case 'attribute_groupID':		
		$_SESSION['attribute_Mapid'] = $attribute_groupID;
		echo json_encode(array("rslt"=>"1")); //success
	break;
}
 
function uploadPortfolio($edit_id,$db,$sku,$lang=null){
	//echo $sku; die();
//echo $edit_id."<br>";	print_r($_FILES['product_images']);
	
$today=date("Y-m-d H:i:s");	
$configinfo=getQuerys($db,"allconfigurable");
$getsize = getimagesize_large($db,'product','product_image');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
	
list($width, $height) = getimagesize($_FILES['product_images']['tmp_name'][0]);

	if(isset($_FILES) && count($_FILES)){
		if (!file_exists('../uploads/productassest/'.$edit_id)) {
			mkdir('../uploads/productassest/'.$edit_id, 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/thumb")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/thumb", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/medium")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/medium", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/base")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/base", 0777, true);
		}
			
		
		if(isset($_FILES['product_images'])){	
			//if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth))
			if((($width/$height)==($imgwidth/$imgheight)) || $lang != '')
        	 
			{			
				//$target_dir	= '../uploads/product_image/';
				$target_dir	= '../uploads/productassest/'.$edit_id."/photos/";
				for($i=0;$i<count($_FILES["product_images"]["name"]); $i++){
					$target_file_t = $target_dir . basename($_FILES["product_images"]["name"][$i]);	
					$file_info=pathinfo($target_file_t);
					$splitsku=explode("_",$file_info['filename']);
					
					$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
					$filename = $edit_id."_".$i."_".time().".".$imageFileType;
					$target_file = $target_dir . $filename;	
					if(searchkeyvalue("IsEnableWaterMark",$configinfo)==1){
						if ($_FILES["product_images"]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							$image = imagecreatefrompng($_FILES["product_images"]["tmp_name"][$i]);
							
							list($width, $height) = getimagesize($_FILES["product_images"]["tmp_name"][$i]);
							
							$watermark = imagecreatefrompng(docroot.'watermark/'.$GLOBALS['watermark']['value']);  
							 $watermark_width = imagesx($watermark);
							 $watermark_height = imagesy($watermark);
							
							 $wat_width =$width/1.5;
							 $x_ratio = $wat_width / $watermark_width;
							 $wat_height = ceil($x_ratio * $watermark_height);
							
							$new_watermark = imagecreatetruecolor($wat_width, $wat_height);

							imagealphablending($new_watermark, false);
							imagesavealpha($new_watermark, true);
							$color = imagecolorallocatealpha($new_watermark, 0, 0, 0, 127);
							imagefill($new_watermark, 0, 0, $color);
							imagecopyresized($new_watermark, $watermark, 0, 0, 0, 0, $wat_width, $wat_height, $watermark_width, $watermark_height);
							$wt_width = imagesx($new_watermark);
							$wt_height = imagesy($new_watermark);
							imagepng($new_watermark,$target_dir.'w'.$counter.'.png', 9);		
							
								imagealphablending($image, true);
							imagealphablending($new_watermark, true);
							imagesavealpha($new_watermark, true);
							$color = imagecolorallocatealpha($new_watermark, 0, 0, 0, 127);
							imagecolortransparent($new_watermark, $color); 
							imagefill($new_watermark, 0, 0, $color); 
							
							imagecopymerge($image, $new_watermark, 0.95*(($width/2) - ($wt_width/2)), 0.95*(($height/2) - ($wt_height/2)), 0, 0, $wt_width, $wt_height,35);
							
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
								imagegif($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
								imagepng($image,$target_file, 9);
					}
					else{
						if ($_FILES["product_images"]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							$image = imagecreatefrompng($_FILES["product_images"]["tmp_name"][$i]);
							list($width, $height) = getimagesize($_FILES["product_images"]["tmp_name"][$i]);
							$image_p = imagecreatetruecolor($width, $height);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
							
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
								imagegif($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
								imagepng($image,$target_file, 5);

					}	
					echo $target_file;
			//	 	move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], $target_file);
			 
					
					if(move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], $target_file));	
					//if(file_exists( $target_file))	
					{
							
						
						$str = "INSERT INTO ".TPLPrefix."product_images(product_id,sku,img_path,ordering,IsActive,createdDate,modifiedDate) values('".$edit_id."','".$splitsku[0]."','".$filename."','".($i+1)."',1,'".$today."','".$today."') ";
						//echo $str; 
						$db->insert($str);
						 $strChk = "select * from ".TPLPrefix."imageconfig where imageconfigModule = 'product' and IsActive != '2'";		
						$reslt = $db->get_rsltset($strChk);
						$counter = 0;
					
						for($mm=0;$mm<count($reslt);$mm++)
						{
							
							//list($width, $height) = getimagesize($target_file);
							
							
							// $new_width = $reslt[$mm]['imageconfigWidth']; 
							// $new_height = $reslt[$mm]['imageconfigHeight'];  

							$tn_w = $reslt[$mm]['imageconfigWidth']; 
							$tn_h = $reslt[$mm]['imageconfigHeight'];  

							$x_ratio = $tn_w / $width;
							$y_ratio = $tn_h / $height;

							if (($width <= $tn_w) && ($height <= $tn_h)) {							
								$new_width = $width;
								$new_height = $height;
							} elseif (($x_ratio * $height) < $tn_h) {
								$new_height = ceil($x_ratio * $height);
								$new_width = $tn_w;
							} else {
								$new_width = ceil($y_ratio * $width);
								$new_height = $tn_h;
							}	
							
							 $image_p = imagecreatetruecolor($new_width, $new_height);
							
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($target_file);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							{
								$image = imagecreatefrompng($target_file);
								imagealphablending($image_p, false);
								imagesavealpha($image_p,true);
								$transparent = imagecolorallocatealpha($image_p, 255, 255, 255, 127);
								imagefilledrectangle($image_p, 0, 0, $w, $h, $transparent);
						    }
						
							
							imagecopyresized($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							
						
							
							if($counter == 0)
								 $location = $target_dir."thumb/".$filename;
							else if($counter == 1)
								$location = $target_dir."medium/".$filename;
							else if($counter == 2)
								$location = $target_dir."base/".$filename;
						
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
								imagegif($image_p,$location, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							{
								imagepng($image_p,$location, 9);
								
								
							}
							imagedestroy($image);
							imagedestroy($image_p);
							
							$counter++;
						}
																
					}
				}
			}	
			else
			{
				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				exit();
			}
		}			
	}	
}



function uploadPortfolio_array_ids($edit_ids,$db,$sku,$imageid=null){
	//echo $sku; die();
//echo $edit_id."<br>";	print_r($_FILES['product_images']);

$today=date("Y-m-d H:i:s");	
$configinfo=getQuerys($db,"allconfigurable");
$getsize = getimagesize_large($db,'product','product_image');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
	
list($width, $height) = getimagesize($_FILES['product_images']['tmp_name'][0]);

	if(isset($_FILES) && count($_FILES)){
	 foreach($imageid as $edit_id){	
	   
		if (!file_exists('../uploads/productassest/'.$edit_id)) {
			mkdir('../uploads/productassest/'.$edit_id, 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/thumb")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/thumb", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/medium")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/medium", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/base")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/base", 0777, true);
		}
	  }
			
		
		if(isset($_FILES['product_images'])){	
			//if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth))
			if((($width/$height)==($imgwidth/$imgheight)) || $lang != '')
        	 
			{			
				//$target_dir	= '../uploads/product_image/';
$parentid=$edit_ids[0];
				for($i=0;$i<count($_FILES["product_images"]["name"]); $i++){
				//	foreach($edit_ids as $edit_id){	
				 foreach($edit_ids as $edit_id => $lang_id){
					
				// $edit_id=$edit_ids[0];
				if($lang_id == 1){
						$parentid = 0;
					}
					
					$target_dir	= '../uploads/productassest/'.$edit_id."/photos/";
					$target_file_t = $target_dir . basename($_FILES["product_images"]["name"][$i]);	
					$file_info=pathinfo($target_file_t);
					$splitsku=explode("_",$file_info['filename']);
					
					$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
					$filename = $edit_id."_".$i."_".time().".".$imageFileType;
					$target_file = $target_dir . $filename;	
					if(searchkeyvalue("IsEnableWaterMark",$configinfo)==1){
						if ($_FILES["product_images"]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							$image = imagecreatefrompng($_FILES["product_images"]["tmp_name"][$i]);
							
							list($width, $height) = getimagesize($_FILES["product_images"]["tmp_name"][$i]);
							
							$watermark = imagecreatefrompng(docroot.'watermark/'.$GLOBALS['watermark']['value']);  
							 $watermark_width = imagesx($watermark);
							 $watermark_height = imagesy($watermark);
							
							 $wat_width =$width/1.5;
							 $x_ratio = $wat_width / $watermark_width;
							 $wat_height = ceil($x_ratio * $watermark_height);
							
							$new_watermark = imagecreatetruecolor($wat_width, $wat_height);

							imagealphablending($new_watermark, false);
							imagesavealpha($new_watermark, true);
							$color = imagecolorallocatealpha($new_watermark, 0, 0, 0, 127);
							imagefill($new_watermark, 0, 0, $color);
							imagecopyresized($new_watermark, $watermark, 0, 0, 0, 0, $wat_width, $wat_height, $watermark_width, $watermark_height);
							$wt_width = imagesx($new_watermark);
							$wt_height = imagesy($new_watermark);
							imagepng($new_watermark,$target_dir.'w'.$counter.'.png', 9);		
							
								imagealphablending($image, true);
							imagealphablending($new_watermark, true);
							imagesavealpha($new_watermark, true);
							$color = imagecolorallocatealpha($new_watermark, 0, 0, 0, 127);
							imagecolortransparent($new_watermark, $color); 
							imagefill($new_watermark, 0, 0, $color); 
							
							imagecopymerge($image, $new_watermark, 0.95*(($width/2) - ($wt_width/2)), 0.95*(($height/2) - ($wt_height/2)), 0, 0, $wt_width, $wt_height,35);
							
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
								imagegif($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
								imagepng($image,$target_file, 9);
					}
					else{
						if ($_FILES["product_images"]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($_FILES["product_images"]["tmp_name"][$i]);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							$image = imagecreatefrompng($_FILES["product_images"]["tmp_name"][$i]);
							list($width, $height) = getimagesize($_FILES["product_images"]["tmp_name"][$i]);
							$image_p = imagecreatetruecolor($width, $height);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
							
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
								imagegif($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
								imagejpeg($image,$target_file, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
								imagepng($image,$target_file, 5);

					}	
					//echo $target_file;
			//	 	move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], $target_file);
			 
					
					if(move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], $target_file));	
					{
					  	 $str = "INSERT INTO ".TPLPrefix."product_images(product_id,sku,img_path,ordering,IsActive,createdDate,modifiedDate,lang_id,parent_id) values('".$edit_id."','".$splitsku[0]."','".$filename."','".($i+1)."',1,'".$today."','".$today."','".$lang_id."','".$parentid."') ";					
						$db->insert($str);
						 $strChk = "select * from ".TPLPrefix."imageconfig where imageconfigModule = 'product' and IsActive != '2'";		
						$reslt = $db->get_rsltset($strChk);
						
						if($lang_id == 1){
						$parentid = $db->insert_id;
						}
						
						
						$counter = 0;
					
						for($mm=0;$mm<count($reslt);$mm++)
						{
							
							//list($width, $height) = getimagesize($target_file);
							
							
							// $new_width = $reslt[$mm]['imageconfigWidth']; 
							// $new_height = $reslt[$mm]['imageconfigHeight'];  

							$tn_w = $reslt[$mm]['imageconfigWidth']; 
							$tn_h = $reslt[$mm]['imageconfigHeight'];  

							$x_ratio = $tn_w / $width;
							$y_ratio = $tn_h / $height;

							if (($width <= $tn_w) && ($height <= $tn_h)) {							
								$new_width = $width;
								$new_height = $height;
							} elseif (($x_ratio * $height) < $tn_h) {
								$new_height = ceil($x_ratio * $height);
								$new_width = $tn_w;
							} else {
								$new_width = ceil($y_ratio * $width);
								$new_height = $tn_h;
							}	
							
							 $image_p = imagecreatetruecolor($new_width, $new_height);
							
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($target_file);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							{
								$image = imagecreatefrompng($target_file);
								imagealphablending($image_p, false);
								imagesavealpha($image_p,true);
								$transparent = imagecolorallocatealpha($image_p, 255, 255, 255, 127);
								imagefilledrectangle($image_p, 0, 0, $w, $h, $transparent);
						    }
						
							
							imagecopyresized($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							
						
							
							if($counter == 0)
								 $location = $target_dir."thumb/".$filename;
							else if($counter == 1)
								$location = $target_dir."medium/".$filename;
							else if($counter == 2)
								$location = $target_dir."base/".$filename;
						
							if ($_FILES["product_images"]["type"][$i] == "image/gif")
								imagegif($image_p,$location, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/jpeg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES["product_images"]["type"][$i] == "image/png")
							{
								imagepng($image_p,$location, 9);
								
								
							}
							imagedestroy($image);
							imagedestroy($image_p);
							
							$counter++;
						}
						if(count($imageid)>1){
						for($v=1;$v<count($imageid);$v++)
						{ 
							$temp_target_file=$target_file;
							$target_dir1	= '../uploads/productassest/'.$imageid[$v]."/photos/";
							$target_file_t = $target_dir1 . basename($_FILES["product_images"]["name"][$i]);	
							$file_info=pathinfo($target_file_t);
							$splitsku=explode("_",$file_info['filename']);
							
							$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
							$filename1 = $imageid[$v]."_".$i."_".time().".".$imageFileType;
							
							 $target_file = $target_dir1 . $filename1;	
							 copy($temp_target_file, $target_file);
							for($mm=0;$mm<count($reslt);$mm++)
							{
								 copy($target_dir."thumb/".$filename,$target_dir1."thumb/".$filename1);
								 copy( $target_dir."medium/".$filename,$target_dir1."medium/".$filename1 );
								 copy( $target_dir."base/".$filename,$target_dir1."base/".$filename1 );
							}
						}
						
						}								
					}
				
			  }}
			}	
			else
			{
				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				exit();
			}
		
	}		
	}	
}
 

function uploadbrochure($edit_id,$db,$filename,$lang_id){	

 
			//$sizes = getdynamicimage($db,'brochure');
			 
			$a = 1;				
			//for($i=0;$i<count($_FILES[$filename]["name"]);$i++){	
				if( $_FILES[$filename]["name"] != '')
				{					
			 
				 $extension  =$_FILES[$filename]["type"];
				
				/* $obj=new Gthumb();	
				 $path =	$obj->resize_image($sizes,'brochure',$extension,$_FILES['brochureimage']);*/
				 
				 $obj=new Gthumb();	
				$path = $obj->getPDFfile($filename,'brochure');
						if($path != ''){
							if($lang_id == 1){
							  $str = "update ".TPLPrefix."product set brochureimage='".$path."' where product_id = '".$edit_id."'";
							}else{
								$str = "update ".TPLPrefix."product set brochureimage='".$path."' where parent_id = '".$edit_id."' and lang_id = '".$lang_id."' ";
							}
							
							$log = $db->insert_log("update","tri_product","","Product Brochure Image Added Newly","Product",$str);
							$db->insert($str);
						}
				}
			//}
}



?>