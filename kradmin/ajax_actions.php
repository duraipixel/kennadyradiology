<?php 
include 'session.php';
include "common/dpselect-functions.php";
extract($_REQUEST);

 

if($action == "stateList")
{
    $reslt = getSelectBox_statelist($db,'StateID','jsrequired','','',$CountryID);
    echo json_encode(array('statelist'=>$reslt));
}

if($action == "CityList")
{
    $reslt =  getSelectBox_CityList($db, 'CityID', 'jsrequired','','',$stateid,$countryid);
    echo json_encode(array('citylist'=>$reslt));
}

if($action == "AreaList")
{
    $reslt =  getSelectBox_AreaList($db, 'AreaID', 'jsrequired','','',$cityid);
    echo json_encode(array('arealist'=>$reslt));
}

if($action == "PincodeList")
{
   
    $reslt =  getSelectBox_PincodeList($db, 'PincodeID', 'jsrequired','','',$areaid);
    echo json_encode(array('pincodelist'=>$reslt));
}

if($action == "shipping_flat")
{
	$countryid=$_REQUEST['countryid']; 
 	
	 echo json_encode(array("rslt"=>getSelectBox_statelistShip($db,'txtstateid','',$res_ed['stateid'],'',$countryid)));
}

	if($action == "mailtemplate"){
		
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = '".$tempcopy."' ";
		$res_ed = $db->get_a_line($str_ed);
		
		$str_eds = "select * from ".TPLPrefix."mailtemplate_master where IsActive != '2' and masterid = '".$temname."' ";
        $res_eds = $db->get_a_line($str_eds);
        $isconfirmtable = $res_eds['isconfirmtable'];
		
		$htmlcontent='<div class="form-group">
                      <label class="col-sm-2 control-label">Mail BCC</label>
                      <div class="col-sm-4">
					    <input type="text" class="form-control jsrequired" name="mailbcc" id="mailbcc" value="'.$res_ed['mailbcc'].'" />
					   </div>
                    </div>  					
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Mail Subject</label>
                      <div class="col-sm-4">
					    <input type="text" class="form-control jsrequired" name="mailsub" id="mailsub" value="'.$res_ed['mailsub'].'" />
					   </div>
                    </div>  
					
					<div class="form-group">
                      <label class="col-sm-2 control-label">Mail Content</label>
                      <div class="col-sm-6">
                          <div class="">
							 <textarea id="mailcontent" name = "mailcontent" class="texteditor">'.$res_ed['mailcontent'].'</textarea>	
						</div>   
                      </div>
                    </div>  
					
					<div class="form-group">
                      <label class="col-sm-2 control-label">Mail Footer</label>
                      <div class="col-sm-6">
                          <div class="">
							 <textarea id="mailfooter" name = "mailfooter" class="texteditor">'.$res_ed['mailfooter'].'</textarea>	
						</div>   
                      </div>
                    </div> ';  
					if($isconfirmtable==1){
			$htmlcontent.='<div class="form-group">
                      <label class="col-sm-2 control-label">After Table</label>
                      <div class="col-sm-6">
                          <div class="">
							 <textarea id="aftertable" name = "aftertable" class="texteditor">'.$res_ed['aftertable'].'</textarea>	
						</div>   
                      </div>
                    </div>';
					}
					
			$htmlcontent.=" <script src='plugins/jodit/jodit.min.js'></script>			<script>
 $(function () {
	 var editors = [].slice.call(document.querySelectorAll('.texteditor'));
	
	 editors.forEach(function (div) {
			var editor = new Jodit(div, {
				textIcons: false,
				iframe: false,
				iframeStyle: '*,.jodit_wysiwyg {color:red;}',
				height: 300,
				defaultMode: Jodit.MODE_WYSIWYG,
				observer: {
					timeout: 100
				},
				uploader: {
					url: 'fileupload.php?action=fileUpload'
				},
				filebrowser: {
					
					ajax: {
						url: 'includes/Get1.php'
					}
				},
				commandToHotkeys: {
					'openreplacedialog': 'ctrl+p'
				}				
			});
	});
 }); </script>";
            echo json_encode(array('htmlcontent'=>$htmlcontent));
			exit;
	}

if($action == "confirmtable"){
		
		$str_ed = "select * from ".TPLPrefix."mailtemplate_master where IsActive != '2' and masterid = '".$temname."' ";
        $res_ed = $db->get_a_line($str_ed);
        $isconfirmtable = $res_ed['isconfirmtable'];
		
		if($isconfirmtable==1){
			
			$htmlcontent="<div class='form-group'>
                      <label class='col-sm-2 control-label'>After Table</label>
                      <div class='col-sm-6'>
                          <div class=''>
							 <textarea id='aftertable' name = 'aftertable' class='texteditors'></textarea>	
						</div>   
                      </div>
                    </div>
					<script src='plugins/jodit/jodit.min.js'></script>			
					<script>
			 $(function () {
				 var editors = [].slice.call(document.querySelectorAll('.texteditors'));
				
				 editors.forEach(function (div) {
						var editor = new Jodit(div, {
							textIcons: false,
							iframe: false,
							iframeStyle: '*,.jodit_wysiwyg {color:red;}',
							height: 300,
							defaultMode: Jodit.MODE_WYSIWYG,
							observer: {
								timeout: 100
							},
							uploader: {
								url: 'fileupload.php?action=fileUpload'
							},
							filebrowser: {
								
								ajax: {
									url: 'includes/Get1.php'
								}
							},
							commandToHotkeys: {
								'openreplacedialog': 'ctrl+p'
							}				
						});
				});
			 }); 
			 </script>";
			echo json_encode(array('rslt'=>1,'htmlcontent'=>$htmlcontent));
			exit;
		}
		else{
			$htmlcontents='';
			echo json_encode(array('rslt'=>2,'htmlcontent'=>$htmlcontents));
			exit;
		}
    }

 
 if($action == "urlslug"){
    $reslt = generateslug($string);
    echo json_encode(array('slug'=>$reslt));
}


if($action == "practicelocation_view"){
 
 $data = array('tag' => 'practicelocationsingle','userid' => $_SESSION["UserId"],'practice_id'=>base64_decode($practiceid),'doctor_id'=>base64_decode($docid));
              $myJSON = json_encode($data);
           
              $response = httpRequestdoctor($db, $method= "POST", $myJSON);
              $response=  json_decode($response,true);
			 
		   echo json_encode(array("locaddress"=>encrpt_decrpt_data($response['doctor_branch_address'],'d'),"loccountry"=>$response['locationcountryname'],"locstate"=>$response['locationstatename'],"loccity"=>$response['locationcityname'],"locarea"=>$response['locationarea'],"locpincode"=>$response['locationpincode'],"locationfor"=>encrpt_decrpt_data($response['doctor_branch_name'],'d')));
			  	
}

if($action == "randompassword"){
    
	    $length = 5;
        $sum = 0;
        for($i=0;$i<$length;$i++)
        {
            $sum = $sum + rand(0,9)*pow(10,$i);
        
        }	    
			
	    $password = $sum;	
    echo json_encode(array('rslt'=>1,'paswd'=>$password));
}

if($action == "viewcontactdetails"){
	 
        //print_r($res_ed);	 exit;
		$data = array('tag' => 'viewcontactdetails','pharmacies_id'=>$pharmacies_id);
		$data =json_encode( $data);
		$resQry=httpRequest($db, "POST", $data);	
		$res_ed =json_decode($resQry);
	
		$htmldata ='';
		foreach($res_ed as $val){
			$htmldata.='<ul><li>'.encrpt_decrpt_data($val->telephone,'d').'</li></ul>';
		}
    
    echo json_encode(array('rslt'=>1,'htmaldata'=>$htmldata));
}

 if($action == "delpharmacytelephone"){
	  
		
		$data = array('tag' => 'delpharmacytelephone','tephone_id'=>$tephone_id);
		$data =json_encode( $data);
		$resQry=httpRequest($db, "POST", $data);	
		$res_ed =json_decode($resQry);		
    
    echo json_encode(array('rslt'=>1));
}

 if($action == "delpharmacylocationcontact"){	

		$data = array('tag' => 'delpharmacylocationcontact','contact_id'=>$contact_id);
		$data =json_encode( $data);
		$resQry=httpRequest($db, "POST", $data);	
		$res_ed =json_decode($resQry);		
    
    echo json_encode(array('rslt'=>1));
}

	if($action == "categoryliststree"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		
	  $str_Category = "SELECT group_concat(categoryID) as categoryID			
				FROM  ".TPLPrefix."pharmacy_product_categoryid t1				
				where t1.product_id = '".$id."' and IsActive=1 ";
		  //echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}
	
	if($action == "categoryliststree_product"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		
	  $str_Category = "SELECT group_concat(categoryID) as categoryID			
				FROM  ".TPLPrefix."product_categoryid t1				
				where t1.product_id = '".$id."' and IsActive=1 ";
		  //echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}	
	
	/*if($action == "autocomplete"){
		if($column == "orders_name"){
			$orderRef = "SELECT order_reference as name FROM ".TPLPrefix."orders where IsActive=1 and order_reference like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}	
    }*/
	
	if($action == "getminqtyvalue"){		
		echo json_encode(array("values"=>searchkeyvalue("minimumStock",$GLOBALS['allcon'])));		
	}	
	
	if($action == "delCombination"){
		$str = "DELETE FROM ".TPLPrefix."pharmacy_product_attr_combi WHERE attr_combi_id = '".$combiId."' AND base_productId = '".$productId."' LIMIT 1 ";
		$db->insert($str);
				
		$strAttrCollection  = "SELECT attr_combi_id FROM  ".TPLPrefix."pharmacy_product_attr_combi where base_productId  = '".$productId."' ";
		$resAttrCollection  = $db->get_rsltset($strAttrCollection);	
		$combinationCollection = array();
		foreach($resAttrCollection as $val){
			$combinationCollection[] = $val["attr_combi_id"];
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
		$combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  ".TPLPrefix."dropdown WHERE dropdown_id IN (".$combiSplit.") ";
		$optionRes = $db->get_a_line($combiOptionStr);
		
		$strCombiOptChk = "select count(*) as tot from ".TPLPrefix."pharmacy_product_attr_combi_opt where product_id = '$productId' ";
		$resltCombiChk = $db->get_a_line($strCombiOptChk);		
		
		if($resltCombiChk['tot'] == 0){
			$db->insert("INSERT INTO ".TPLPrefix."pharmacy_product_attr_combi_opt(optionId,product_id) VALUES('".$optionRes['attrIds']."','".$productId."')");
		}
		else{
			$db->insert("UPDATE ".TPLPrefix."pharmacy_product_attr_combi_opt  SET optionId = '".$optionRes['attrIds']."' WHERE product_id = '".$productId."' ");
		}			
		exit();
	}
	
	if($action == "autocomplete"){
		if($column == "orders_name"){
			$orderRef = "SELECT order_reference as name FROM ".TPLPrefix."orders where IsActive=1 and order_reference like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "email"){
			$orderRef = "SELECT customer_email as name FROM ".TPLPrefix."customers where IsActive=1 and  customer_email like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "product_name"){
		
			$orderRef = "SELECT product_name as name FROM ".TPLPrefix."pharmacy_product where IsActive<>2 and  product_name like '".$_REQUEST['phrase']."%' ";
			
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "product_name_product"){
			
			$orderRef = "SELECT product_name as name FROM ".TPLPrefix."product where IsActive<>2 and  product_name like '".$_REQUEST['phrase']."%' ";
			
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		
		else if($column == "category_name"){
			$orderRef = "SELECT categoryName as name FROM ".TPLPrefix."category where IsActive=1 and  categoryName like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		
		else if($column == "sku"){
			$orderRef = "SELECT sku as name FROM ".TPLPrefix."pharmacy_product where IsActive<>2 and  sku like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "attribute_groupName"){
			$orderRef = "SELECT attribute_groupName as name FROM ".TPLPrefix."attributegroup where IsActive=1 and  attribute_groupName like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		exit();
	}

//product bulk approval - START
	if($action == "pdtbulkapprove")
	{
		
		//print_r($_REQUEST['pricelist']); exit;
		$approveidlist=$_REQUEST['approveidlist'];
        $pricelist = $_REQUEST['pricelist'];		
		$arr_approveidlist = explode(",",$approveidlist);
		$arr_pricelist = explode(",",$pricelist);
		$today=date("Y-m-d H:i:s");
		$cnt=0;

		foreach($arr_approveidlist as $arr_approveidlist_S ){
			$arr_split = explode("@",$arr_approveidlist_S);
			$price = $arr_pricelist[$cnt];
			//$arr_split[0] - check table , $arr_split[1] - product id or sno , $arr_split[2] - product sku
			
			if(isset($arr_split[0])){
				
				if($arr_split[0] == "m"){
					//main table approve 
					if(isset($arr_split[1])){
						$db->insert("update ".TPLPrefix."pharmacy_product set IsActive='1' where product_url ='".$arr_split[1]."' ");
						
						$product_qrys = "select * from ".TPLPrefix."product where IsActive='1' and product_url ='".$arr_split[1]."' limit 0,1 ";
						$chk_pdt_count = $db->get_a_line($product_qrys);
						//print_r($chk_pdt_count); exit;
						if(count($chk_pdt_count) == 0){	

						// product table
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product(dropdown_id,product_name,description,longdescription,metaname,metadescription,metakeyword,sku,product_url,quantity,configqua,minquantity,isquaincrease,isfeaturedproduct,price,specialprice,spl_fromdate,spl_todate,isnewproduct,newprod_fromdate,newprod_todate,attributeMapId,taxId,related_products,suggested_products,iscustomized,uploadecustomizedimg,soldout,chkpvatt,IsActive,UserId,created_date,modified_date) select dropdown_id,product_name,description,longdescription,metaname,metadescription,metakeyword,sku,product_url,quantity,configqua,minquantity,isquaincrease,isfeaturedproduct,".$price.",specialprice,spl_fromdate,spl_todate,isnewproduct,newprod_fromdate,newprod_todate,attributeMapId,taxId,related_products,suggested_products,iscustomized,uploadecustomizedimg,soldout,chkpvatt,IsActive,'".$_SESSION["UserId"]."','".$today."','".$today."' from ".TPLPrefix."pharmacy_product where IsActive='1' and product_url ='".$arr_split[1]."' limit 0,1 ");
						$lastInserId = $db->insert_id;
                        $pharmacy_product_qry = "select * from ".TPLPrefix."pharmacy_product where IsActive='1' and product_url ='".$arr_split[1]."' limit 0,1 ";
						$rslt_product_id = $db->get_a_line($pharmacy_product_qry);
						//print_r($rslt_product_id); exit;
						// product category_ids
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product_categoryid(product_id,categoryID,IsActive,UserId,createdDate,modifiedDate) select  ".$lastInserId.",categoryID,IsActive,'".$_SESSION["UserId"]."','".$today."','".$today."' from ".TPLPrefix."pharmacy_product_categoryid where IsActive='1' and product_id ='".$rslt_product_id['product_id']."' ");	

						// Product Images 
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product_images(product_id,sku,img_path,isthumbdefault,ismediumdefault,isbasedefault,ordering,IsActive,createdDate,modifiedDate) select  ".$lastInserId.",sku,img_path,isthumbdefault,ismediumdefault,isbasedefault,ordering,IsActive,'".$today."','".$today."' from ".TPLPrefix."pharmacy_product_images where IsActive='1' and product_id ='".$rslt_product_id['product_id']."' ");

						// Product Attribute Combi 
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product_attr_combi(attr_combi_id,base_productId,quantity,price,sku,isDefault,IsActive,createdDate,modifiedDate) select  attr_combi_id,".$lastInserId.",quantity,price,sku,isDefault,IsActive,'".$today."','".$today."' from ".TPLPrefix."pharmacy_product_attr_combi where IsActive='1' and base_productId ='".$rslt_product_id['product_id']."' ");	

						// Product Attribute Combi Opt
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product_attr_combi_opt(optionId,product_id,IsActive,createdDate,modifiedDate) select  optionId,".$lastInserId.",IsActive,'".$today."','".$today."' from ".TPLPrefix."pharmacy_product_attr_combi_opt where product_id ='".$rslt_product_id['product_id']."' ");		

						// Product Attribute Dropdownid
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product_attr_dropdwid(product_id,attribute_id,dropdown_id,IsActive,createdDate,modifiedDate) select ".$lastInserId.",attribute_id,dropdown_id,IsActive,'".$today."','".$today."' from ".TPLPrefix."pharmacy_product_attr_dropdwid where product_id ='".$rslt_product_id['product_id']."' ");	

						// Product Attribute Varchar
						$rslt_product_insert=$db->get_rsltset("insert into ".TPLPrefix."product_attr_varchar(product_id,attribute_id,attribute_value,IsActive,createdDate,modifiedDate) select ".$lastInserId.",attribute_id,attribute_value,IsActive,'".$today."','".$today."' from ".TPLPrefix."pharmacy_product_attr_varchar where product_id ='".$rslt_product_id['product_id']."' ");						
						
						}else{
							$str = "update ".TPLPrefix."product set price='".$price."',modified_date = '".$today."' where product_id ='".$chk_pdt_count['product_id']."' ";
							$rslt = $db->insert($str);
						}
						
						
					}				
				}
				else{
				   //temp table to main table update 
				   if(isset($arr_split[1])){
					   
					   $get_pdt_details = $db->get_a_line(" select * from ".TPLPrefix."pdt_bulk_approval where sno = '".$arr_split[1]."' ");
					   
					   if(isset($get_pdt_details)){
						   
						   //tax detail get from ".TPLPrefix."taxmaster table by name from temp table - START
						   $tax_id = "2";
						   $get_tax_det = $db->get_a_line(" select taxId from ".TPLPrefix."taxmaster where taxName = '".$get_pdt_details['taxname']."' ");
						   if(isset($get_tax_det['taxId'])){
							   $tax_id = $get_tax_det['taxId'];
						   }
						   //tax detail get from ".TPLPrefix."taxmaster table by name from temp table - END
						   
						   
							//check the sku already there 
							$chk_sku = $db->get_a_line(" select count(product_id) from ".TPLPrefix."pharmacy_product where sku = '".$arr_split[2]."' ");
							if($chk_sku[0] == 0) {														
								//add product details from temp table to main table							
								$db->insert("insert into ".TPLPrefix."pharmacy_product(product_name, description, longdescription, metaname, metadescription, metakeyword, sku, quantity, price, tax_id, IsActive, userid)values('".$get_pdt_details['product_name']."', '".$get_pdt_details['description']."', '".$get_pdt_details['longdescription']."', '".$get_pdt_details['metaname']."', '".$get_pdt_details['metadescription']."', '".$get_pdt_details['metakeyword']."', '".$get_pdt_details['sku']."', '".$get_pdt_details['quantity']."', '".$get_pdt_details['price']."', '".$tax_id."', '1', '".$_SESSION["UserId"]."') ");
								
								$db->insert("delete from ".TPLPrefix."pdt_bulk_approval where sno='".$get_pdt_details['sno']."' ");
								//$db= mysql_query(" delete from ".TPLPrefix."pdt_bulk_approval where sno='".$get_pdt_details['sno']."' ");
							}
							else{
								//sku already there - update from temp table to main table					
								
								$db->insert("update ".TPLPrefix."pharmacy_product set product_name='".$get_pdt_details['product_name']."', description='".$get_pdt_details['description']."', longdescription='".$get_pdt_details['longdescription']."', metaname='".$get_pdt_details['metaname']."', metadescription='".$get_pdt_details['metadescription']."', metakeyword='".$get_pdt_details['metakeyword']."', quantity='".$get_pdt_details['quantity']."', price='".$get_pdt_details['price']."', tax_id='".$tax_id."', userid='".$_SESSION["UserId"]."'  where sku = '".$arr_split[2]."' ");
								
								$db->insert("delete from ".TPLPrefix."pdt_bulk_approval where sno='".$get_pdt_details['sno']."' ");							
							}
						   
					   }				   
				   }
				}
			}
			$cnt++;
		}     
		echo json_encode(array("rslt"=>"1")); //success			
	}
//product bulk approval - END

//product approval quantity changes - START
if($action == "pdtapprovalqtychange")
{
	$pdtsku=$_REQUEST['pdtsku']; 
	$pdtid=$_REQUEST['pdtid']; 
	$tblchange=$_REQUEST['tblchange']; 
	$change_value=$_REQUEST['change_value']; 
	
	if(isset($tblchange)){
		if($tblchange == "m"){
			//update to main table		
			$db->insert("update ".TPLPrefix."pharmacy_product set minquantity='".$change_value."' where product_id ='".$pdtid."' and sku ='".$pdtsku."' and IsActive ='0'  ");	
			echo json_encode(array("rslt"=>"1")); //success
		}
		else{
			//update to temp table	
			$db->insert("update ".TPLPrefix."pdt_bulk_approval set minquantity='".$change_value."' where sno ='".$pdtid."' and sku ='".$pdtsku."' ");		
			echo json_encode(array("rslt"=>"1")); //success
		}
	}
	
}

//product approval quantity changes - END	

//product approval price changes - START
if($action == "pdtapprovalpricechange")
{
	$pdtsku=$_REQUEST['pdtsku']; 
	$pdtid=$_REQUEST['pdtid']; 
	$tblchange=$_REQUEST['tblchange']; 
	$change_value=$_REQUEST['change_value']; 
	
	if(isset($tblchange)){
		if($tblchange == "m"){
			//update to main table
			$db->insert("update ".TPLPrefix."pharmacy_product set price='".$change_value."' where product_url ='".$pdtid."' ");				
			echo json_encode(array("rslt"=>"1")); //success
		}
		else{
			//update to temp table
			$db->insert("update ".TPLPrefix."pdt_bulk_approval set price='".$change_value."' where sno ='".$pdtid."' and sku ='".$pdtsku."' ");
			echo json_encode(array("rslt"=>"1")); //success
		}
	}
	
}

//product approval price changes - END

//product bulk Delete - START
if($action == "pdtbulkdelete")
{
	$approveidlist=$_REQUEST['approveidlist'];	
	$arr_approveidlist = explode(",",$approveidlist);
	
	foreach($arr_approveidlist as $arr_approveidlist_S ){
		$arr_split = explode("@",$arr_approveidlist_S);
		
		//$arr_split[0] - check table , $arr_split[1] - product id or sno , $arr_split[2] - product sku
		
		if(isset($arr_split[0])){
			
			if($arr_split[0] == "m"){
				//product details remove from main table 
				if(isset($arr_split[1])){					
					$db->insert("delete from ".TPLPrefix."pharmacy_product where product_url='".$arr_split[1]."' ");
				}				
			}
			else{
			   //product details remove from temp table 
			   if(isset($arr_split[1])){	
				   $db->insert("delete from ".TPLPrefix."pdt_bulk_approval where sno='".$arr_split[1]."' ");
			   }
			}
		}
	}     
	echo json_encode(array("rslt"=>"1")); //success			
}
//product bulk Delete - END

	if($action == "categorylistcoupon"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		//echo $id; die();
	  $str_Category = "SELECT 
				group_concat(CouponCategorys) as categoryID			
				FROM  ".TPLPrefix."coupons t1				
				where t1.CouponID = '".$id."' and IsActive=1 ";
		  //echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}
	
	if($action == "categorylistdiscount"){
		if($_REQUEST['id']!='')
			$id=base64_decode($_REQUEST['id']);
		//echo $id; die();
	  $str_Category = "SELECT 
				group_concat(DiscountCategorys) as categoryID			
				FROM  ".TPLPrefix."discount t1				
				where t1.DiscountID = '".$id."' and IsActive=1 ";
		  //echo $str_Category; exit;		
			$res_ed_category = $db->get_a_line($str_Category);
	
			$categoryID = explode(",",$res_ed_category['categoryID']);		
			//print_r($categoryID); die();
		echo getSelectBox_categorysublist($db,$id,$categoryID);
	}	
	
	if($action == "shipping_free")
	{
		$countryid=$_REQUEST['countryid']; 
		//echo $countryid;
		
		//echo getSelectBox_statelist($db,'txtstateid','jsrequired',$res_ed['stateid'],'',$countryid);
		
		 echo json_encode(array("rslt"=>getSelectBox_statelistShip($db,'txtstateid','',$res_ed['stateid'],'',$countryid)));
	}	


if($action == "themeview"){
	$html='';
  	$gettheme = $db->get_a_line("select * from ".TPLPrefix."themesetup where themeid = '".$_REQUEST['themeid']."' ");	
	$html = '<a href="'.IMG_BASE_URL.'theme/'.$gettheme['themeimage'].'" class="mr-0 image-popup-fit-width" title="Theme 1">
                                        <img alt="image-gallery" src="'.IMG_BASE_URL.'theme/'.$gettheme['themeimage'].'" class="mr-0" width="130" height="100">
                                    </a>';
	echo $html;
}

if($action == 'getsize'){
			
			if($categoryid!=''){
 				$StrQry="select categoryID AS Id,categoryname AS Name from ".TPLPrefix."product_attribute_multiple pm inner join ".TPLPrefix."dropdown s on s.attributeId = pm.producttype_attid where category_type='".$category_type."' and parentid ='".$categoryid."' and IsActive ='1' order by categoryname asc";
				$resQry = $db->get_rsltset($StrQry);		
				$strSelHtml =  "<option value=''>Select Subcategory</option>";
				
				if(!empty($resQry)) {
					foreach($resQry as $val) {
						$sel='';
						if($sizeval==$val['Id'])
							$sel=' selected="selected" ';
							$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
							$sublevel = getsubcat($db,$val['Id'],$category_type);
							if(count($sublevel) > 0){
								foreach($sublevel as $subcat){
								$strSelHtml=$strSelHtml."<option value=".$subcat['Id']." ".$sels.">"."&nbsp;&nbsp;&nbsp;&#x251c;&#x2500;".$subcat['Name']."</option>";
								}
							}
					}
				}
				
			echo json_encode(array("rslt"=>$strSelHtml));
			
			}
}
?>

