<?php 
include 'session.php';
extract($_REQUEST);

$dbh = mysql_connect ("localhost", "root", "");
mysql_select_db("ecom",$dbh);

try{
	$action=$_REQUEST['hdnact'];
		
	if($action == "attributeselect_bygroupid"){
		$attribute_groupID = $_REQUEST['attribute_groupID'];		
		$_SESSION['attribute_Groupid'] = $attribute_groupID;
		echo "success";
	}
	else if($action == "download_excel"){		
		//$attrgroup_id , $attrgroup_name , $attributecheck_list, $combinedattributecheck_list
		
		//remove attribute appear both Attribute List and Combined Attribute - START
		$final_attribute_list = array_diff($attributecheck_list,$combinedattributecheck_list);	  
		sort($final_attribute_list);
		//remove attribute appear both Attribute List and Combined Attribute - END
		
		//temp table creation - START
		$tbl_name = "dwnexcel_".date('ymd').time();
		$tbl_name_cre = 'temp_'.$tbl_name;
		
		//common fields
		$header_sql = array("`attributegroup` TEXT", "`product_name` TEXT", "`category` TEXT", "`description` TEXT", "`longdescription` TEXT", "`metaname` TEXT", "`metadescription` TEXT", "`metakeyword` TEXT", "`sku` TEXT", "`quantity` TEXT", "`price` TEXT", "`gallery` TEXT", "`baseimage` TEXT", "`mediumimage` TEXT", "`thumbnailimage` TEXT", "`tax` TEXT");
		
		//attribute fields
		if(count($final_attribute_list) > 0){
			foreach($final_attribute_list as $final_attribute_list_S){
				$get_attrname = $db->get_a_line("select attributename from ".TPLPrefix."m_attributes where attributeid='".$final_attribute_list_S."' ");
				if(isset($get_attrname['attributename'])){
					$header_sql[] = '`'.trim($get_attrname['attributename']).'` TEXT';
				}
			}
		}
		
		$header_sql[] = '`attribute_variant` TEXT';
		
		//Combined Attribute fields
		$combined_attr_name = '';
		if(count($combinedattributecheck_list) > 0){			
			foreach($combinedattributecheck_list as $combinedattributecheck_list_S){
				$get_attrname = $db->get_a_line("select attributename from ".TPLPrefix."m_attributes where attributeid='".$combinedattributecheck_list_S."' ");
				
				if(isset($get_attrname['attributename'])){
					$header_sql[] = '`'.trim($get_attrname['attributename']).'` TEXT';
					
					if($combined_attr_name == ''){
						$combined_attr_name = trim($get_attrname['attributename']);
					}
					else{
						$combined_attr_name = $combined_attr_name.";".trim($get_attrname['attributename']);
					}					
				}				
			}			
			//Combined Attribute common fields
			$header_sql[] = '`att_qty` TEXT';
			$header_sql[] = '`att_price` TEXT';
			$header_sql[] = '`att_sku` TEXT';			
		}
								
		$sql = 'CREATE TABLE '.$tbl_name_cre.' ('.implode(',',$header_sql).')';				
		
		$result_create = mysql_query("$sql");
		if (!$result_create) {
			//table creation error	
			echo mysql_error();
			die();
		}
		else{
			//success	
			if($combined_attr_name !=''){
				mysql_query("insert into ".$tbl_name_cre." (attributegroup,attribute_variant)values('".$attrgroup_name."','".$combined_attr_name."')  " );
			}
			else{
				mysql_query("insert into ".$tbl_name_cre." (attributegroup)values('".$attrgroup_name."')    " );
			}			
			
			$_SESSION["CSVdownloadtbl"] = $tbl_name_cre;			
			
			echo "success";
		}			
		
		//temp table creation - END	
		
	}	
	else if($action == "upload_csv"){
		
		
		$file_name= $_FILES["file"]["name"];
		
		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		}
		else{			
			$tbl_name_cre = 'temp_upload_'.date('ymd').time();
			$newfilename = 'pduploadfile_'.round(microtime(true)).$file_name;
			
			//Read excel file for table field creation
			$handle = fopen($_FILES['file']['tmp_name'], "r"); 			
			move_uploaded_file($_FILES['file']['tmp_name'], 'pdtbulkupload/' . $newfilename);
			
			$header = fgetcsv($handle,1000,","); 
			if($header){
				if($header[0] == '' || $header[0] == null ){
					echo "empty";		    
				}
				else{
					//temp table creation - START	
					$header_sql = array();
					$header_txt = array();
					$header_sql[]= " sl_no int(11) primary key NOT NULL AUTO_INCREMENT ";
					foreach($header as $h){
						$header_sql[] = '`'.trim($h).'` TEXT';
						$header_txt[]= '`'.trim($h).'`';
					}
					$sql = 'CREATE TABLE '.$tbl_name_cre.' ('.implode(',',$header_sql).')';						
						
					$result_create = mysql_query("$sql");
					if (!$result_create) {					
						echo 'This upload cannot be process. There is Duplicate column name. Please try again.' . mysql_error();
					}
					else{
						mysql_query("LOAD DATA LOCAL INFILE 'pdtbulkupload/".$newfilename."' INTO TABLE ".$tbl_name_cre." FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (".implode(",",$header_txt).");",$dbh);
					}
					//temp table creation - END	
					
					
					
	//Product Details upload one by one - START				
		
		//get columns details on upload table	[attribute column and attribute variant column details] - START
		
		$temp_tblfields=$db->get_rsltset("SHOW COLUMNS FROM ".$tbl_name_cre."");	
		$cnt = count($temp_tblfields);		
		for($i=0; $i< $cnt-1; $i++){
			  $tbl_clmnname[]= $temp_tblfields[$i]['Field'];
		}
		$chk_attr_clumn=0;
		$chk_attr_grup_clumn=0;
		
		foreach($tbl_clmnname as $tbl_clmnname_S){
           // echo $tbl_clmnname_S; echo "\n";		
			if($chk_attr_clumn == 1){
				
				if($chk_attr_grup_clumn == 1){
					$tbl_attr_variant_clmnname[] = $tbl_clmnname_S;
				}
				else{
					if($tbl_clmnname_S == "attribute_variant"){
						$chk_attr_grup_clumn = 1;
					}
					else{
						$tbl_attr_clmnname[] = $tbl_clmnname_S;
					}
				}				
			}
			
			if($tbl_clmnname_S == "tax"){
				$chk_attr_clumn = 1;
			}
			
		}
		
		if(isset($tbl_attr_variant_clmnname)){
			foreach($tbl_attr_variant_clmnname as $tbl_attr_variant_clmnname_S){
				
			if($tbl_attr_variant_clmnname_S == "att_qty" || $tbl_attr_variant_clmnname_S == "att_price" || $tbl_attr_variant_clmnname_S == "att_sku"){
					//not vartiant attribute
				}
				else{
					$tbl_attr_variant_only[] = $tbl_attr_variant_clmnname_S;
				}
			}
		}		
        //get columns details on upload table	[attribute column and attribute variant column details] - END
		

		
		//get row values on upload table
        $get_uploadtblvalues=$db->get_rsltset("select * FROM ".$tbl_name_cre."");	
		
		//values insert to actual tables one by one - START
		foreach($get_uploadtblvalues as $get_uploadtblvalues_S){			
			
			if(isset($get_uploadtblvalues_S['attributegroup']) && $get_uploadtblvalues_S['attributegroup'] !="" && $get_uploadtblvalues_S['attributegroup'] !=null ){
				
				//get attribute group id by attribute group name
				$get_attrgroupDet = $db->get_a_line("select attribute_groupID, attribute_groupName from ".TPLPrefix."attributegroup where attribute_groupName='".$get_uploadtblvalues_S['attributegroup']."' ");
				
				if(isset($get_attrgroupDet['attribute_groupID'])){
					$S_attrgroupID = $get_attrgroupDet['attribute_groupID'];
					
					//insert new product details main table get productId and attribute groupID {tbl - ".TPLPrefix."product}  
					
					//check the sku already there 
					$chk_sku = $db->get_a_line(" select count(product_id) from ".TPLPrefix."product where sku = '".$get_uploadtblvalues_S['sku']."' and IsActive != '2' ");
					
					if($chk_sku[0] == 0) {
						//get product url remove space and replace "-" character						
						$final_pdtName = trim($get_uploadtblvalues_S['product_name']," ");
						$final_pdturl = preg_replace('/\s+/', '-', $final_pdtName);	
						
						$chk_pdtcnt = $db->get_a_line(" select count(*) from ".TPLPrefix."product where product_name = '".$final_pdtName."' and IsActive != '2' ");	
						if($chk_pdtcnt[0] > 0) {
							$final_pdturl = $final_pdturl."_".$chk_pdtcnt[0];
						}	
						
						//tax id get - START
						$tax_id = '';
						if(isset($get_uploadtblvalues_S['tax'])){
							$chk_taxid = $db->get_a_line(" select taxId from ".TPLPrefix."taxmaster where IsActive = 1 and taxName='".$get_uploadtblvalues_S['tax']."' ");
							if(isset($chk_taxid['taxId'])){
								$tax_id = $chk_taxid['taxId'];
							}
						}						
						//tax id get - END
						
						
						$db->insert("insert into ".TPLPrefix."product(product_name, description, longdescription, metaname, metadescription, metakeyword, sku, product_url, quantity, price, tax_id, IsActive, userid ) values ('".getRealescape($final_pdtName)."', '".getRealescape($get_uploadtblvalues_S['description'])."', '".getRealescape($get_uploadtblvalues_S['longdescription'])."', '".getRealescape($get_uploadtblvalues_S['metaname'])."', '".getRealescape($get_uploadtblvalues_S['metadescription'])."', '".getRealescape($get_uploadtblvalues_S['metakeyword'])."', '".getRealescape($get_uploadtblvalues_S['sku'])."', '".getRealescape($final_pdturl)."', '".$get_uploadtblvalues_S['quantity']."', '".$get_uploadtblvalues_S['price']."', '".$tax_id."', '3', '".$_SESSION["UserId"]."' ) ");					 	
						$S_productID = $db->insert_id;
						
						
						if(isset($S_productID)){
							
						    //category insert -START
							$get_category_all = $get_uploadtblvalues_S['category'];
							if(isset($get_category_all) && $get_category_all !="" && $get_category_all !=null){
								$get_cat_all = explode(";",$get_category_all);
								foreach($get_cat_all as $get_cat_all_S){
									
									if(isset($get_cat_all_S) && $get_cat_all_S !="" && $get_cat_all_S !=null){
										$get_cat_ID = $db->get_a_line(" select categoryID from ".TPLPrefix."category where categoryName = '".$get_cat_all_S."' and IsActive != '2' ");	
										
										if(isset($get_cat_ID['categoryID']) && $get_cat_ID['categoryID'] !="") {
											$db->insert(" insert into ".TPLPrefix."product_categoryid(product_id, categoryID) values('".$S_productID."','".$get_cat_ID['categoryID']."') ");
										}
									}
									
								}	
							}
							//category insert -END
							
							
							//attribute details insert [ check with master if it is text value means save ".TPLPrefix."product_attr_varchar otherwise id means save ".TPLPrefix."product_attr_dropdwid ]
							//attribute insert - START
							if(isset($tbl_attr_clmnname)){
								foreach($tbl_attr_clmnname as $tbl_attr_clmnname_S){
									$get_attr_type = $db->get_a_line(" select attributeid,attributename,attribute_type from ".TPLPrefix."m_attributes where 1=1 and IsActive = 1 and attributename='".$tbl_attr_clmnname_S."' ");	
									if(isset($get_attr_type['attributeid'])){
										
										if($get_attr_type['attribute_type'] == "text" || $get_attr_type['attribute_type'] == "textarea" ){
											//insert direct values [tbl - ".TPLPrefix."product_attr_varchar]
											
											$db->insert(" insert into ".TPLPrefix."product_attr_varchar(product_id, attribute_id, attribute_value) values('".$S_productID."','".$get_attr_type['attributeid']."', '".getRealescape($get_uploadtblvalues_S[$tbl_attr_clmnname_S])."') ");
																								
										}
										else{
											//check the dropdown id and insert id [tbl - ".TPLPrefix."product_attr_dropdwid]
											
											$get_dropdwnid = $db->get_a_line(" select dropdown_id from ".TPLPrefix."dropdown where attributeId='".$get_attr_type['attributeid']."' and dropdown_values='".$get_uploadtblvalues_S[$tbl_attr_clmnname_S]."'  ");
											
											if(isset($get_dropdwnid['dropdown_id'])){
												$db->insert(" insert into ".TPLPrefix."product_attr_dropdwid(product_id, attribute_id, dropdown_id) values('".$S_productID."','".$get_attr_type['attributeid']."', '".$get_dropdwnid['dropdown_id']."') ");
											}
											
										}
									}
									
								}
							}							
							//attribute insert - END
							
							
							//attribute variant insert - START
							if(isset($tbl_attr_variant_only)){	
								$attr_variant_dropdwnIDS = array();
								
								foreach($tbl_attr_variant_only as $tbl_attr_variant_only_S){
									
									$get_attr_Det = $db->get_a_line(" select attributeid,attributename,attribute_type from ".TPLPrefix."m_attributes where 1=1 and IsActive = 1 and attributename='".$tbl_attr_variant_only_S."' ");
									if(isset($get_attr_Det['attributeid'])){
										
										$get_attrvari_dpdnID = $db->get_a_line(" select dropdown_id from ".TPLPrefix."dropdown where attributeId='".$get_attr_Det['attributeid']."' and dropdown_values='".$get_uploadtblvalues_S[$tbl_attr_variant_only_S]."'  ");
										
										if(isset($get_attrvari_dpdnID['dropdown_id'])){
											$attr_variant_dropdwnIDS[] = $get_attrvari_dpdnID['dropdown_id'];
										}
										
									}
								}
								
								if(isset($attr_variant_dropdwnIDS)){
									//insert to ".TPLPrefix."product_attr_combi table for dropdown combinations ids
									$variant_combi_ids = implode("_",$attr_variant_dropdwnIDS);
									
									if(isset($variant_combi_ids) && $variant_combi_ids !="" && $variant_combi_ids !=null ){
										$db->insert(" insert into ".TPLPrefix."product_attr_combi(attr_combi_id, base_productId, quantity, price, sku, isDefault)values('".$variant_combi_ids."','".$S_productID."', '".$get_uploadtblvalues_S['att_qty']."', '0', '".$get_uploadtblvalues_S['att_sku']."','1' ) ");											
									}
										
								}
								
							}	
							
							//attribute variant insert - END
							
							
							
							//product images save to folder and update the database - START	
																			
								$get_Gallery_all = $get_uploadtblvalues_S['gallery'];								
								
								if(isset($get_Gallery_all) && $get_Gallery_all !="" && $get_Gallery_all !=null){								
									
									if (!file_exists('../uploads/productassest/'.$S_productID)) {
										mkdir('../uploads/productassest/'.$S_productID, 0777, true);
									}
									if (!file_exists('../uploads/productassest/'.$S_productID.'/photos')) {
										mkdir('../uploads/productassest/'.$S_productID.'/photos', 0777, true);
									}
									if (!file_exists('../uploads/productassest/'.$S_productID.'/photos/thumb')) {
										mkdir('../uploads/productassest/'.$S_productID.'/photos/thumb', 0777, true);
									}
									if (!file_exists('../uploads/productassest/'.$S_productID.'/photos/medium')) {
										mkdir('../uploads/productassest/'.$S_productID.'/photos/medium', 0777, true);
									}
									if (!file_exists('../uploads/productassest/'.$S_productID.'/photos/base')) {
										mkdir('../uploads/productassest/'.$S_productID.'/photos/base', 0777, true);
									}
									
									
									$image_list = explode(";",$get_Gallery_all);
									
									foreach($image_list as $image_list_S){
										
										if(isset($image_list_S)){
											if(file_exists('../importimg/'.$image_list_S))
											{
											   $target_dir	='../uploads/productassest/'.$S_productID.'/photos/';	
											   $target_file = 	'../uploads/productassest/'.$S_productID.'/photos/'.$image_list_S;					
											   copy('../importimg/'.$image_list_S, $target_file);
											   
											   $get_imgdetails = getimagesize($target_file);	
											   $width = $get_imgdetails[0];
											   $height = $get_imgdetails[1];
											   $imgtype = $get_imgdetails['mime'];
																   
											   if ($imgtype == "image/gif")
													$image = imagecreatefromgif($target_file);
												elseif ($imgtype == "image/jpg")
													$image = imagecreatefromjpeg($target_file);
												elseif ($imgtype == "image/jpeg")
													$image = imagecreatefromjpeg($target_file);
												elseif ($imgtype == "image/png")
													$image = imagecreatefrompng($target_file);			
												
											   
												//thumb image upload - START
												$get_thumb_Img = $db->get_a_line(" SELECT * FROM `".TPLPrefix."imageconfig` WHERE 1=1 and imageconfigModule = 'product' and imageconfigCode='config_product_thumb' and IsActive != '2' ");
											   
												$new_width = $get_thumb_Img['imageconfigWidth']; 
												$new_height = $get_thumb_Img['imageconfigHeight'];  
												
												$image_p = imagecreatetruecolor($new_width, $new_height);
												imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);	
												
												$location = $target_dir."thumb/".$image_list_S;
												
												if ($imgtype == "image/gif")
													imagegif($image_p,$location, 50);
												elseif ($imgtype == "image/jpg")
													imagejpeg($image_p,$location, 50);
												elseif ($imgtype == "image/jpeg")
													imagejpeg($image_p,$location, 50);
												elseif ($imgtype == "image/png")
													imagepng($image_p,$location, 9);
											
												//thumb image upload - END
													
											   
											   
											   //medium image upload - START
											   
											   $get_thumb_Img = $db->get_a_line(" SELECT * FROM `".TPLPrefix."imageconfig` WHERE 1=1 and imageconfigModule = 'product' and imageconfigCode='config_product_popup' and IsActive != '2' ");
											   
												$new_width = $get_thumb_Img['imageconfigWidth']; 
												$new_height = $get_thumb_Img['imageconfigHeight'];  
												
												$image_p = imagecreatetruecolor($new_width, $new_height);
												imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);	
												
												$location = $target_dir."medium/".$image_list_S;
												
												if ($imgtype == "image/gif")
													imagegif($image_p,$location, 50);
												elseif ($imgtype == "image/jpg")
													imagejpeg($image_p,$location, 50);
												elseif ($imgtype == "image/jpeg")
													imagejpeg($image_p,$location, 50);
												elseif ($imgtype == "image/png")
													imagepng($image_p,$location, 9);
											   
											   //medium image upload - END
											   
											   
											   //base image upload - START
											   
											   $get_thumb_Img = $db->get_a_line(" SELECT * FROM `".TPLPrefix."imageconfig` WHERE 1=1 and imageconfigModule = 'product' and imageconfigCode='config_product_cart' and IsActive != '2' ");
											   
												$new_width = $get_thumb_Img['imageconfigWidth']; 
												$new_height = $get_thumb_Img['imageconfigHeight'];  
												
												$image_p = imagecreatetruecolor($new_width, $new_height);
												imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);	
												
												$location = $target_dir."base/".$image_list_S;
												
												if ($imgtype == "image/gif")
													imagegif($image_p,$location, 50);
												elseif ($imgtype == "image/jpg")
													imagejpeg($image_p,$location, 50);
												elseif ($imgtype == "image/jpeg")
													imagejpeg($image_p,$location, 50);
												elseif ($imgtype == "image/png")
													imagepng($image_p,$location, 9);
											   
											   //base image upload - END
											   
											   
											   //insert to db [tbl - ".TPLPrefix."product_images]
											   
											   if($image_list_S == $get_uploadtblvalues_S['baseimage'] ){
												   //isbasedefault column set 1
												    $db->insert(" insert into ".TPLPrefix."product_images(product_id, img_path, isthumbdefault, ismediumdefault, isbasedefault, ordering)values('".$S_productID."', '".$image_list_S."', '0', '0', '1', '0') ");
											   }
											   else if($image_list_S == $get_uploadtblvalues_S['mediumimage'] ){
												   //ismediumdefault column set 1
												    $db->insert(" insert into ".TPLPrefix."product_images(product_id, img_path, isthumbdefault, ismediumdefault, isbasedefault, ordering)values('".$S_productID."', '".$image_list_S."', '0', '1', '0', '0') ");
											   }
											   else if($image_list_S == $get_uploadtblvalues_S['thumbnailimage'] ){
												   //isthumbdefault column set 1
												    $db->insert(" insert into ".TPLPrefix."product_images(product_id, img_path, isthumbdefault, ismediumdefault, isbasedefault, ordering)values('".$S_productID."', '".$image_list_S."', '1', '0', '0', '0') ");
											   }
											   else{
												  $db->insert(" insert into ".TPLPrefix."product_images(product_id, img_path, isthumbdefault, ismediumdefault, isbasedefault, ordering)values('".$S_productID."', '".$image_list_S."', '0', '0', '0', '0') ");		  
											   }

												//delete from import folder
												unlink('../importimg/'.$image_list_S);
																			   
											}
										}			
									}
																
									
								}
																
							//product images save to folder and update the database - END	
							
							
														
							
							
						}
						else{
							//product insert error [not show]
							echo "product insert error";
						}						
					
						//echo "insert new 1 row"; 
					}
					else{
						//sku already there [not show]
						//echo "sku already there ";
					}					
					
				}
				
			}
			else{
				//insert attribute variant for the same product previously insert {refer var - $S_productID, $S_attrgroupID  }
				//echo "---insert 1 subrow";
				
				//attribute variant insert - START
							if(isset($tbl_attr_variant_only)){		
								$attr_variant_dropdwnIDS = array();
								
								foreach($tbl_attr_variant_only as $tbl_attr_variant_only_S){
									
									$get_attr_Det = $db->get_a_line(" select attributeid,attributename,attribute_type from ".TPLPrefix."m_attributes where 1=1 and IsActive = 1 and attributename='".$tbl_attr_variant_only_S."' ");
									if(isset($get_attr_Det['attributeid'])){
										
										$get_attrvari_dpdnID = $db->get_a_line(" select dropdown_id from ".TPLPrefix."dropdown where attributeId='".$get_attr_Det['attributeid']."' and dropdown_values='".$get_uploadtblvalues_S[$tbl_attr_variant_only_S]."'  ");
										
										if(isset($get_attrvari_dpdnID['dropdown_id'])){
											$attr_variant_dropdwnIDS[] = $get_attrvari_dpdnID['dropdown_id'];
										}
										
									}
								}
								
								if(isset($attr_variant_dropdwnIDS)){
									//insert to ".TPLPrefix."product_attr_combi table for dropdown combinations ids
									$variant_combi_ids = implode("_",$attr_variant_dropdwnIDS);
									
									if(isset($variant_combi_ids) && $variant_combi_ids !="" && $variant_combi_ids !=null ){
										$db->insert(" insert into ".TPLPrefix."product_attr_combi(attr_combi_id, base_productId, quantity, price, sku, isDefault)values('".$variant_combi_ids."','".$S_productID."', '".$get_uploadtblvalues_S['att_qty']."', '".$get_uploadtblvalues_S['att_price']."', '".$get_uploadtblvalues_S['att_sku']."','0' ) ");	
									}									
								}
								
							}	
							
			 //attribute variant insert - END
											
			}	
			
		}
		//values insert to actual tables one by one - END		
       									
		//Product Details upload one by one - END
					
					//$tbl_name_cre
					
					$drop_tbl_qry ="drop table ".$tbl_name_cre.""; 
					mysql_query($drop_tbl_qry);
					 
					unlink('pdtbulkupload/'.$newfilename);		
					
					echo "success";					
				}
			}					
			
		}
		
	}
	
	else if($action == "productcsv_upload"){		
		
		$file_name= $_FILES["file"]["name"];
		
		if ( 0 < $_FILES['file']['error'] ) {
			echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		}
		else{
			$tbl_name_cre = 'temp_pdfupload_'.date('ymd').time();
			$newfilename = 'pduploadfile_'.round(microtime(true)).$file_name;
			
			
			//Read excel file for table field creation
			$handle = fopen($_FILES['file']['tmp_name'], "r"); 			
			move_uploaded_file($_FILES['file']['tmp_name'], 'pdtbulkupload/' . $newfilename);
			
			$header = fgetcsv($handle,1000,","); 
			if($header){
				if($header[0] == '' || $header[0] == null ){
					echo "empty";		    
				}
				else{
					
					//temp table creation - START	
					$header_sql = array();
					$header_txt = array();
					$header_sql[]= " sl_no int(11) primary key NOT NULL AUTO_INCREMENT ";
					foreach($header as $h){
						$header_sql[] = '`'.trim($h).'` TEXT';
						$header_txt[]= '`'.trim($h).'`';
					}

					$sql = 'CREATE TABLE '.$tbl_name_cre.' ('.implode(',',$header_sql).')';						
						
					$result_create = mysql_query("$sql");
					if (!$result_create) {					
						echo 'This upload cannot be process. There is Duplicate column name. Please try again.' . mysql_error();
					}
					else{
						
						mysql_query("LOAD DATA LOCAL INFILE 'pdtbulkupload/".$newfilename."' INTO TABLE ".$tbl_name_cre." FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (".implode(",",$header_txt).");",$dbh);
												
						$get_uploadtblvalues=$db->get_rsltset("select * FROM ".$tbl_name_cre."");					

						foreach($get_uploadtblvalues as $get_uploadtblvalues_S){
							
							if(isset($get_uploadtblvalues_S['sku']) && $get_uploadtblvalues_S['sku'] !="" && $get_uploadtblvalues_S['sku'] !=null ){								
								//check the sku already there 
								$chk_sku = $db->get_a_line(" select count(sno) from ".TPLPrefix."pdt_bulk_approval where sku = '".$get_uploadtblvalues_S['sku']."'  ");
								
								if($chk_sku[0] == 0) {
									//insert 									
									$db->insert("insert into ".TPLPrefix."pdt_bulk_approval(`product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `sku`, `quantity`, `price`, `taxname`, `IsActive`, `userid`) values('".$get_uploadtblvalues_S['product_name']."', '".$get_uploadtblvalues_S['description']."', '".$get_uploadtblvalues_S['longdescription']."', '".$get_uploadtblvalues_S['metaname']."', '".$get_uploadtblvalues_S['metadescription']."', '".$get_uploadtblvalues_S['metakeyword']."', '".$get_uploadtblvalues_S['sku']."', '".$get_uploadtblvalues_S['quantity']."', '".$get_uploadtblvalues_S['price']."', '".$get_uploadtblvalues_S['taxname']."', '0', '".$_SESSION["UserId"]."') ");
									
								}								
								else{
									//update 									
									$db->insert(" update ".TPLPrefix."pdt_bulk_approval set product_name='".$get_uploadtblvalues_S['product_name']."', description='".$get_uploadtblvalues_S['description']."', longdescription='".$get_uploadtblvalues_S['longdescription']."', metaname='".$get_uploadtblvalues_S['metaname']."', metadescription='".$get_uploadtblvalues_S['metadescription']."', metakeyword='".$get_uploadtblvalues_S['metakeyword']."', quantity='".$get_uploadtblvalues_S['quantity']."', price='".$get_uploadtblvalues_S['price']."', taxname='".$get_uploadtblvalues_S['taxname']."', IsActive='0', userid='".$_SESSION["UserId"]."' where sku = '".$get_uploadtblvalues_S['sku']."'   ");
								}
								
								
							}
						}			

							
						//mysql_query("INSERT INTO ".TPLPrefix."pdt_bulk_approval(`product_id`, `product_name`, `description`, `longdescription`, `metaname`, `metadescription`, `metakeyword`, `sku`, `quantity`, `price`, `taxname`, `IsActive`, `userid`) SELECT product_id, product_name, description, longdescription, metaname, metadescription, metakeyword, sku, quantity, price, taxname, '0', '".$_SESSION["UserId"]."' from ".$tbl_name_cre."  ");
						
						//mysql_query("LOAD DATA LOCAL INFILE 'pdtbulkupload/".$newfilename."' INTO TABLE ".TPLPrefix."pdt_bulk_approval FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (".implode(",",$header_txt).");",$dbh);
							
							
					}				
									
				
					$drop_tbl_qry ="drop table ".$tbl_name_cre.""; 
					mysql_query($drop_tbl_qry);
					unlink('pdtbulkupload/'.$newfilename);		
					
					echo "success";	
				
					//temp table creation - END	
				}
			}
						
		}
		
	}
	
	die();
}

catch (Exception $e) {
	$res = "server busy, try again later";
	echo $res;
}


?>