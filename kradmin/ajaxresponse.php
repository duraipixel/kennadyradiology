<?php 
$menudisp = "shippingprice";
include "session.php"; 
include('mailsend.php');
extract($_REQUEST);
$act = $action;

if($_SESSION["UserId"]){
	
	if($action == "getminqtyvalue"){		
		echo json_encode(array("values"=>searchkeyvalue("minimumStock",$GLOBALS['allcon'])));		
	}
	
	if($action == "homepagedisplaycat"){
		//print_r($_REQUEST); exit;
		/*$str_ed = "select t1.product_id AS Id, t1.product_name AS Name from ".TPLPrefix."product t1 inner join  ".TPLPrefix."product_categoryid t2 on t1.product_id=t2.product_id and t2.IsActive=1 inner join ".TPLPrefix."category t3 on t2.categoryID=t3.categoryID and t3.IsActive=1 and t3.parentId='".$catid."' and t3.parentId <>'0'  where t1.IsActive = '1' "; */
		$SelName='product';
		$Attr='';
		$selId='';
		 $chk_listarray = explode(",",$selId); 
		if($catid!=''){ 
			$childcatlist=$db->get_a_line( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
			   SELECT @Ids := (
			   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
			   FROM ".TPLPrefix."category
			   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
			   ) Level
			   FROM ".TPLPrefix."category
			   JOIN (SELECT @Ids := ".$catid.") temp1
			   WHERE IsActive=1
			) temp2 " );

			if(!empty($childcatlist['ids']))
			$childcatlist['ids'].=",".$catid;
				else
			$childcatlist['ids']=$catid;

			$conqry=" and  t3.categoryID in (".$childcatlist['ids'].") ";	
        }
			$str_ed = "select t1.product_id AS Id, t1.product_name AS Name,t3.categoryID from ".TPLPrefix."product t1 inner join  ".TPLPrefix."product_categoryid t2 on t1.product_id=t2.product_id and t2.IsActive=1 inner join ".TPLPrefix."category t3 on t2.categoryID=t3.categoryID and t3.IsActive=1 $conqry where t1.IsActive = '1' "; 

	/*	echo $str_ed;
		exit;*/
		//echo $str_ed; exit;
		$resQry = $db->get_rsltset($str_ed);
		//print_r($resQry); exit;
		$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$Attr." productarray' name='".$SelName."[]' onchange='productdisplay(this.value);'><option value=''>Select</option>";
		
		if(!empty($resQry)) {
			
			foreach($resQry as $val) {
				
			$sel='';
				if (in_array($val['Id'], $chk_listarray)) {
					
					$sel=' selected="selected" ';
				}	
				
			    $strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}
		}
		
		$strSelHtml=$strSelHtml."</select>";
		//print_r($strSelHtml); exit;

		echo json_encode(array('htmlcontent'=>$strSelHtml));
		exit;
	}
	
	if($action == "homepagedisplay"){
		//print_r($_REQUEST); exit;
		/*$str_ed = "select t1.product_id AS Id, t1.product_name AS Name from ".TPLPrefix."product t1 inner join  ".TPLPrefix."product_categoryid t2 on t1.product_id=t2.product_id and t2.IsActive=1 inner join ".TPLPrefix."category t3 on t2.categoryID=t3.categoryID and t3.IsActive=1 and t3.parentId='".$catid."' and t3.parentId <>'0'  where t1.IsActive = '1' "; */
		$SelName='product';
		$Attr='';
		$selId='';
		 $chk_listarray = explode(",",$selId); 
		if($catid!=''){ 
			$childcatlist= " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
			   SELECT @Ids := (
			   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
			   FROM ".TPLPrefix."category
			   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
			   ) Level
			   FROM ".TPLPrefix."category
			   JOIN (SELECT @Ids := ?) temp1
			   WHERE IsActive= ?
			) temp2 " ;
			
			$childcatlist = $db->get_a_line_bind($childcatlist,array($catid,1));
			if(!empty($childcatlist['ids']))
			$childcatlist['ids'].=",".$catid;
				else
			$childcatlist['ids']=$catid;

			$conqry=" and  t3.categoryID in (".$childcatlist['ids'].") ";	
        }
			$str_ed = "select t1.product_id AS Id, t1.product_name AS Name from ".TPLPrefix."product t1 inner join  ".TPLPrefix."product_categoryid t2 on t1.product_id=t2.product_id and t2.IsActive=1 inner join ".TPLPrefix."category t3 on t2.categoryID=t3.categoryID and t3.IsActive=1 $conqry where t1.IsActive = ? group by t1.product_id "; 

	/*	echo $str_ed;
		exit;*/
		//echo $str_ed; exit;
		$resQry = $db->get_rsltset_bind($str_ed,array(1));
		//print_r($resQry); exit;
		$strSelHtml =  "<select multiple='multiple' class='form-control select2 ".$Attr." productarray' name='".$SelName."[]' onchange='productdisplay(this.value);'><option value=''>Select</option>";
		
		if(!empty($resQry)) {
			
			foreach($resQry as $val) {
				
			$sel='';
				if (in_array($val['Id'], $chk_listarray)) {
					
					$sel=' selected="selected" ';
				}	
				
			    $strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
			}
		}
		
		$strSelHtml=$strSelHtml."</select>";
		//print_r($strSelHtml); exit;

		echo json_encode(array('htmlcontent'=>$strSelHtml));
		exit;
	}
		if($action == "homepagedisplay_productlist_cat"){
		
		//print_r($_REQUEST);
		//exit;
		
		
		$hmlbind = '<div class="row">
		<div class="col-md-12">     

		 <div class="box">
			<div class="box-header">                 
			 
			</div><!-- /.box-header -->
			<div class="box-body" id="divtable">
			  <table id="tblresult_modulesorting" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th>Product Name</th>
					<th>Sorting Order</th>	
                    <th>Action</th>					
				  </tr>
				</thead>
				<tbody>';
				    $con ='';
                    if(isset($eid) && $eid!=null){
						
						$con = " and t2.hpsid='".$eid."' ";
		
						//for delete single data query
						$delte_query = $db->get_a_line("select hpd_proid from ".TPLPrefix."homepagecatslider_product where IsActive =1  and hpsid='".$eid."' and productid NOT IN($productids) ");
						
						$delid='';
						if($delte_query['hpd_proid']!='')
						{
							$delid=$delte_query['hpd_proid'];
							
							$today = date("Y-m-d");
							$str="update ".TPLPrefix."homepagecatslider_product set IsActive = '2', ModifiedDate = '$today'  where hpd_proid = '".$delid."'  ";
							$db->insert($str); 
						}
					}
                     
					 
					$modulesorting_list = $db->get_rsltset("select t2.sortby,t2.hpd_proid,t1.product_name,t1.product_id from ".TPLPrefix."product t1 left join ".TPLPrefix."homepagecatslider_product t2 on t1.product_id=t2.productid and t2.IsActive=1 $con  where t1.IsActive =1 and t1.product_id IN($productids) group by t1.product_id");
                    $rowcount=1;
					foreach($modulesorting_list as $modulesorting_list_S)
					{
					$sort='';	
					if($eid!=''){
						$sort = $modulesorting_list_S['sortby'];
					}
				    $editid = base64_encode($modulesorting_list_S['hpd_proid']);
					$delurl = "'homepageslider_actions.php','Id=$editid&action=del_innerpagecat'";
					$hmlbind .= '<tr>
						<td>'.$modulesorting_list_S['product_name'].'</td>
						<td>
							<input type="text" name="sortby'.$modulesorting_list_S['product_id'].'" value="'.$sort.'" class="form-control" />
							
						</td>
						<td>
							
							<a href="javascript:void(0);" title="Delete" data-toggle="tooltip" class="btn btn-danger btn-sm" onClick="javascript:funStats(this,'.$delurl.')" ><i class="flaticon-circle-cross"></i></a>
							<input type="hidden" name="rowcount" value="'.$rowcount.'" class="form-control" />
						</td>
						
					</tr>';
					$rowcount++;
					}
				     
				$hmlbind .= '</tbody>
			  </table>
			</div>
		  </div>

		</div>
	  </div>';
		 echo json_encode(array('hmlbind'=>$hmlbind));
			exit;
	}
	
	if($action == "homepagedisplay_productlist"){
		
		//print_r($_REQUEST);
		//exit;
		
		
		$hmlbind = '<div class="row">
		<div class="col-md-12">     

		 <div class="box">
			<div class="box-header">                 
			 
			</div><!-- /.box-header -->
			<div class="box-body" id="divtable">
			  <table id="tblresult_modulesorting" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th>Product Name</th>
					<th>Sorting Order</th>	
                    <th>Action</th>					
				  </tr>
				</thead>
				<tbody>';
				    $con ='';
                    if(isset($eid) && $eid!=null){
						
						$con = " and t2.hpsid='".$eid."' ";
		
						//for delete single data query
						$delte_query = $db->get_a_line("select hpd_proid from ".TPLPrefix."homepageslider_product where IsActive =1  and hpsid='".$eid."' and productid NOT IN($productids) ");
						
						$delid='';
						if($delte_query['hpd_proid']!='')
						{
							$delid=$delte_query['hpd_proid'];
							
							$today = date("Y-m-d");
							$str="update ".TPLPrefix."homepageslider_product set IsActive = '2', ModifiedDate = '$today'  where hpd_proid = '".$delid."'  ";
							$db->insert($str); 
						}
					}
                     
					 
					$modulesorting_list = $db->get_rsltset("select t2.sortby,t2.hpd_proid,t1.product_name,t1.product_id from ".TPLPrefix."product t1 left join ".TPLPrefix."homepageslider_product t2 on t1.product_id=t2.productid and t2.IsActive=1 $con  where t1.IsActive =1 and t1.product_id IN($productids) group by t1.product_id");
                    $rowcount=1;
					foreach($modulesorting_list as $modulesorting_list_S)
					{
					$sort='';	
					if($eid!=''){
						$sort = $modulesorting_list_S['sortby'];
					}
				    $editid = base64_encode($modulesorting_list_S['hpd_proid']);
					$delurl = "'homepageslider_actions.php','Id=$editid&action=del_innerpage'";
					$hmlbind .= '<tr>
						<td>'.$modulesorting_list_S['product_name'].'</td>
						<td>
							<input type="text" name="sortby'.$modulesorting_list_S['product_id'].'" value="'.$sort.'" class="form-control" />
							
						</td>
						<td>
							
							<a href="javascript:void(0);" title="Delete" data-toggle="tooltip" class="btn btn-danger btn-sm" onClick="javascript:funStats(this,'.$delurl.')" ><i class="flaticon-circle-cross"></i></a>
							<input type="hidden" name="rowcount" value="'.$rowcount.'" class="form-control" />
						</td>
						
					</tr>';
					$rowcount++;
					}
				     
				$hmlbind .= '</tbody>
			  </table>
			</div>
		  </div>

		</div>
	  </div>';
		 echo json_encode(array('hmlbind'=>$hmlbind));
			exit;
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
	
	if($action == "imgOrdering"){
		$counter = 1;
		$ordering = explode(',',$ordering);
		foreach($ordering as $val){
			$str = "UPDATE ".TPLPrefix."product_images SET ordering = '".$counter."' WHERE product_img_id = ".$val."  ";
			$db->insert($str);
			$counter++;
		}
		exit();
	}
	
	if($action == "prodimgOrdering"){
		$counter = 1;
		$prod_img_id_arr=explode('_',$_REQUEST['name']);
		$ordering = $_REQUEST['ordering'];
		
		$str = "UPDATE ".TPLPrefix."product_images SET ordering = '".$ordering."' WHERE product_img_id = ".$prod_img_id_arr[1]."  ";
		$db->insert($str);
		
		exit();
	}
	
	if($action == "eventimgOrdering"){
		
		$strs = "UPDATE ".TPLPrefix."events_images SET isdefault = '0' WHERE newseventid = ".$eid."  ";
		$db->insert($strs);
		$counter = 1;
		$ordering = explode(',',$ordering);
		$imgid = $ordering[0];
		 $strss = "UPDATE ".TPLPrefix."events_images SET isdefault = '1' WHERE events_img_id = ".$imgid."  ";
		 $db->insert($strss);
		foreach($ordering as $val){
			 $str = "UPDATE ".TPLPrefix."events_images SET ordering = '".$counter."' WHERE events_img_id = ".$val."  ";
			
			$db->insert($str);

			
			$counter++;
		}
		exit();
	}
	
	if($action == "catimgOrdering"){
		$counter = 1;
		$ordering = explode(',',$ordering);
		foreach($ordering as $val){
			$str = "UPDATE ".TPLPrefix."categoryimage SET ordering = '".$counter."' WHERE catimgid = ".$val."  ";
			$db->insert($str);
			$counter++;
		}
		exit();
	}
	
	
		if($action == "catmobileimgOrdering"){
		$counter = 1;
		$ordering = explode(',',$ordering);
		foreach($ordering as $val){
			$str = "UPDATE ".TPLPrefix."category_mobimage SET ordering = '".$counter."' WHERE cat_mobimgid = ".$val."  ";
			$db->insert($str);
			$counter++;
		}
		exit();
	}
	
	else if($action == "delCombination"){
		$str = "DELETE FROM ".TPLPrefix."product_attr_combi WHERE attr_combi_id = '".$combiId."' AND base_productId = '".$productId."' LIMIT 1 ";
		$db->insert($str);
				
		$strAttrCollection  = "SELECT attr_combi_id FROM  `".TPLPrefix."product_attr_combi` where base_productId  = '".$productId."' ";
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
		$combiOptionStr = "SELECT group_concat(DISTINCT attributeId) attrIds FROM  `".TPLPrefix."dropdown` WHERE dropdown_id IN (".$combiSplit.") ";
		$optionRes = $db->get_a_line($combiOptionStr);
		
		$strCombiOptChk = "select count(*) as tot from ".TPLPrefix."product_attr_combi_opt where product_id = '$productId' ";
		$resltCombiChk = $db->get_a_line($strCombiOptChk);		
		
		if($resltCombiChk['tot'] == 0){
			$db->insert("INSERT INTO ".TPLPrefix."product_attr_combi_opt(optionId,product_id) VALUES('".$optionRes['attrIds']."','".$productId."')");
		}
		else{
			$db->insert("UPDATE ".TPLPrefix."product_attr_combi_opt  SET optionId = '".$optionRes['attrIds']."' WHERE product_id = '".$productId."' ");
		}			
		exit();
	}
	else if($action == "customerDetails"){
		$str = " SELECT t1.*,t2.customer_group_name customer_group_name				
				FROM ".TPLPrefix."customers t1	
				INNER JOIN ".TPLPrefix."customer_group t2 on t2.customer_group_id =  t1.customer_group_id and t2.IsActive=1	
				where t1.IsActive=1	and t1.customer_username like  '%".$_REQUEST['phrase']."%'
				";
				
		$res_sku = $db->get_rsltset($str);		
		$array[] = array();
		$counter = 0;
		foreach($res_sku  as  $key=>$val){
			$strAddress = "SELECT t1.*,
			t2.statename as  statename ,
			t3.countryname as countryname
			FROM  `".TPLPrefix."cus_address`  t1
			LEFT JOIN ".TPLPrefix."state t2 on t2.stateid = t1.stateid
			LEFT JOIN ".TPLPrefix."country t3 on t3.countryid = t1.countryid			
			WHERE  t1.`customer_id` ='".$val["customer_id"]."' and t1.IsActive = 1 order by t1.CreatedDate desc ";
			$res_skuAddress = $db->get_rsltset($strAddress);
			
			$array[$counter]["name"] = $val["customer_email"];
			$addressHtml = "";
			$addrcounter = 1;
			foreach($res_skuAddress as $addrVal){
				$addressHtml .= '<fieldset><h1>Address '.$addrcounter.'</h1>';
				$addressHtml .= "First Name:".$addrVal["firstname"]."<br/>";	
				$addressHtml .= "Last Name:".$addrVal["lastname"]."<br/>";
				$addressHtml .= "Email :".$addrVal["emailid"]."<br/>";
				$addressHtml .= "Address:".$addrVal["address"]."<br/>";				
				$addressHtml .= "Telephone :".$addrVal["telephone"]."<br/>";
				$addressHtml .= "Landmark :".$addrVal["landmark"]."<br/>";
				$addressHtml .= "City :".$addrVal["city"]."<br/>";
				$addressHtml .= "Postalcode :".$addrVal["postalcode"]."<br/>";
				$addressHtml .= "State Name :".$addrVal["statename"]."<br/>";
				$addressHtml .= "Country Name :".$addrVal["countryname"]."<br/>";
				$addressHtml .= "<div class='billing_product'><input type='radio' class='billingRadio' name='forbilling' value='".$addrVal['cus_addressid']."'  /> For Billing</div>";
				$addressHtml .= "<input type='radio' class='shippingRadio' name='forshipping' value='".$addrVal['cus_addressid']."' /> For Shipping<br/>";
				$addressHtml .= '</fieldset>';
				$addrcounter++;
				
			}
			$addressHtml .= "<input type='hidden' name='usercustomer_id' value='".$val["customer_id"]."' />";
			$addressHtml .= "<input type='hidden' name='customer_group_id' value='".$val["customer_group_id"]."' />";
			$array[$counter]["addressline1"] = $addressHtml;
			//$array[$counter]["address"] = $addressHtml;
			
			$counter++;
		}			
		echo json_encode($array);
		exit();
	}
	else if($action == "autocomplete"){
		if($column == "orders_name"){
			$orderRef = "SELECT order_reference as name FROM `".TPLPrefix."orders` where IsActive=1 and order_reference like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "email"){
			$orderRef = "SELECT customer_email as name FROM `".TPLPrefix."customers` where IsActive=1 and  customer_email like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "product_name"){
			$orderRef="SELECT 
				  t1.product_name as name  FROM  ".TPLPrefix."product t1 inner join ".TPLPrefix."product_categoryid t3 on t3.product_id = t1.product_id and t3.IsActive=1 inner join ".TPLPrefix."category t4 ON t3.categoryID = t4.categoryID and t4.IsActive=1 and t1.IsActive = 1 and t1. product_name like '".$_REQUEST['phrase']."%' group by t1.product_id"; 	
				  
			//$orderRef = "SELECT product_name as name FROM `".TPLPrefix."product` where IsActive=1 and  product_name like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "category_name"){
			$orderRef = "SELECT categoryName as name FROM `".TPLPrefix."category` where IsActive=1 and  categoryName like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "sku"){
			$orderRef = "SELECT sku as name FROM `".TPLPrefix."product` where IsActive=1 and  sku like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		else if($column == "attribute_groupName"){
			$orderRef = "SELECT attribute_groupName as name FROM `".TPLPrefix."attributegroup` where IsActive=1 and  attribute_groupName like '".$_REQUEST['phrase']."%' ";
			$res_Ref = $db->get_rsltset($orderRef);
			$resultCollection = Array();
			foreach($res_Ref as $valRef){
				$resultCollection[]['name'] = $valRef["name"]; 
			}
			echo json_encode($resultCollection);
		}
		exit();
	}
	if($action == "getProductDetails"){
		$strProducts = "SELECT * FROM  `".TPLPrefix."product` where IsActive=1 and  product_id IN(".$_REQUEST['relatedproductIds'].") ";
		$res_sku_products = $db->get_rsltset($strProducts);	
		$productHtml = "<table>";
		$productHtml .= "<tr><th>S.No</th><th>Product Name</th><th>Unit Price</th><th>Quantity</th></tr>";
		$counter = 1;
		foreach($res_sku_products as $key=>$val){
			$productHtml .= "<tr><td>".$counter."</td>";
			$productHtml .= "<td>".$val['product_name']."
			<input type='hidden' name='product_id[]' value='".$val['product_id']."' />
			<input type='hidden' name='productName[]' value='".$val['product_name']."' />
			<input type='hidden' name='product_sku[]' value='".$val['sku']."' />
			</td>";
			$productHtml .= "<td>".$val['price']."<input type='hidden' class='ptprice' name='productPrice[]' value='".$val['price']."' /></td>";
			$productHtml .= "<td><input type='text'  class='numonly ptQty jsrequired' name='productQty[]' value='' data-pid='".$val['product_id']."' /><span class='unitTotal'></span></td>";
			$productHtml .= "</tr>";			
			$counter++;
		}
		$productHtml .= "</table>";
		$productHtml .= "<div>Total:<span id='totalPrice'></span><input type='hidden' id='paymentTotal' name='paymentTotal' /></div>";
		echo $productHtml;
		exit();
	}
	
	//mail send function for all category's.
	if($action=="mailsend"){
 
        ordermailfunction($db,$_REQUEST['order_id'],$_REQUEST['order_text']);
	}
	
	if($action=="paymentmailsend"){
 
        paymentmailfunction($db,$_REQUEST['order_id'],$_REQUEST['status_id']);
	}
	
	if($action=="ordermailsend"){
 
        orderstatusmailfunction($db,$_REQUEST['order_id'],$_REQUEST['status_id']);
	}

	switch($column){
		case 'sku' :
		$str = "SELECT sku as name  FROM  `".TPLPrefix."product` where IsActive=1 and ".$column." like '".$phrase."%' ";
		break;
		case 'product_name' :
		$str = "SELECT product_name as name  FROM  `".TPLPrefix."product` where IsActive=1 and ".$column." like '".$phrase."%' ";
		break;
		case 'category_name' :	
		$str = "SELECT DISTINCT t3.categoryName AS name FROM  `".TPLPrefix."product` t1
				INNER JOIN ".TPLPrefix."product_categoryid t2 ON t2.product_id = t1.product_id and  t2.IsActive=1
				INNER JOIN ".TPLPrefix."category t3 ON t3.categoryID = t2.categoryID and  t3.IsActive=1
				WHERE t1.IsActive=1 and t3.categoryName LIKE  '".$phrase."%'  ";
		break;
		case 'attribute_groupName' :
		$str = "SELECT distinct t2.attribute_groupName as name FROM ".TPLPrefix."product t1 inner join ".TPLPrefix."attributegroup t2 on t2.attribute_groupID = t1.attributeMapId where t2.attribute_groupName like '".$phrase."%' ";
		break;
	}
	/*									
	$res_sku = $db->get_rsltset($str);	
	$resultCollection = Array();

	foreach($res_sku as $val){
		$resultCollection[]['name'] = $val["name"];
	}
	echo json_encode($resultCollection);
	*/
}

?>