<?php 
//use Box\Spout\Reader\ReaderFactory;
//use Box\Spout\Common\Type;
include 'session.php';
//require_once "Psr4Autoloader.php";
extract($_REQUEST[data]);
//print_r($_REQUEST[data]);

$act=$action;
if(trim($type)=="headrow"){
$resfieldsupload=$db->get_rsltset(" Select * from ".TPLPrefix."productupload_fields where IsActive=1 order by fieldId ");
$fieldsinfo=searchkeyArray($tab,$resfieldsupload,"fieldId");

$insqry= str_replace("value_of",$val_ind,str_replace("table_name",TPLPrefix.$fieldsinfo['tablename'],$fieldsinfo['insertqry']));
$insqry=str_replace("session_user",$_SESSION["UserId"],$insqry);
$insqry=str_replace("date_of_now",date("Y-m-d H:i:s"),$insqry);
echo $insqry; die();
$db->insert($insqry);
if(!empty($db->insert_id) && $db->insert_id!='')
	echo "done";
}
else if(trim($type)=="prodattrrow"){
	$resfieldsupload=$db->get_rsltset(" Select * from ".TPLPrefix."productupload_fields where IsActive=1 order by fieldId ");

	$fieldsinfo=searchkeyArray($tab,$resfieldsupload,"fieldId");

	$insqry= str_replace("table_name",TPLPrefix.$fieldsinfo['tablename'],$fieldsinfo['insertqry']);
	$insqry=str_replace("slug_value_of",generateslug($val_ind),$insqry);
	$insqry=str_replace("value_of",$val_ind,$insqry);
	$insqry=str_replace("prevfieldvalu",$prevfieldvalue,$insqry);
	$insqry=str_replace("session_user",$_SESSION["UserId"],$insqry);
	$insqry=str_replace("date_of_now",date("Y-m-d H:i:s"),$insqry);
	 $insqry=str_replace("date_of_now",date("Y-m-d H:i:s"),$insqry);
	$db->multi_query($insqry);
	if(!empty($db->insert_id) && $db->insert_id!='')
	   echo "done";
}
else if(trim($type)=="attrrow"){
	$insqry= "INSERT INTO ".TPLPrefix."dropdown( attributeId, dropdown_values,  isactive, userid, createdate, modifieddate) VALUES ( '".$attrbuteid."','".$attrbutevalue."','1','".$_SESSION["UserId"]."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."'); ";
	$db->multi_query($insqry);
	if(!empty($db->insert_id) && $db->insert_id!='')
	   echo "done";
}		
$db->disconnect();
/*
switch($act)
{
	case 'upload':		
					
					
					
					$iserror=0;
					$loader = new \Autoloader\Psr4Autoloader;
					$loader->register();
					$loader->addNamespace('Box\Spout', 'Spout');
						
					$fileinfo=pathinfo($edit_id);
					$resfieldsupload=$db->get_rsltset(" Select * from ".TPLPrefix."productupload_fields where IsActive=1 order by fieldId ");
					
					
					
					$arrAttrFields=$db->get_rsltset(" Select * from ".TPLPrefix."m_attributes where IsActive=1 ");
					
					$arrAttrFields_Values=$db->get_rsltset(" Select * from ".TPLPrefix."dropdown where IsActive=1 ");
					
					$arrAttrtype=$db->get_rsltset(" Select * from ".TPLPrefix."attributes where IsActive=1 ");
													
					switch(trim(strtolower($fileinfo['extension'])))
					{
						case "xlsx":
						case "xls":							
																					
									$reader = ReaderFactory::create(Type::XLSX);
										 $filePath=$edit_id;
										
										$reader->open($filePath);
										$insertfields=array();
										$insertvalue=array();
										$otherinsertfields=array();
										$otherinsertvalue=array();
										$attrinsertfields=array();
										$attrinsertvalue=array();
										$errorrowindex=array();
										$errorvalue=array();
										$attrheaderrow=array();
										$headerrow=array();
										foreach ($reader->getSheetIterator() as $sheet) {
		   
											if ($sheet->getIndex() == '0') {
												$cnt=0;
											if($isattrienable==1)	
												$startindex = 1;
											else
												$startindex = 0;
											  
												foreach ($sheet->getRowIterator() as $row) {
													
													if($isattrienable==1)
													{
														if($cnt==$startindex)
														{
															$attrheaderrow=$row;
														}
													}												
													if($cnt=="0")
														$headerrow=$row;
													if($cnt>$startindex){
														$prevfield='';
													
													 foreach($data_prod as $f_ind=>$f_val)
													 {
														
														$fieldsinfo=searchkeyArray($f_ind,$resfieldsupload,"fieldId");
														
														if($fieldsinfo['tablename']==$fieldsinfo['updatetable'] && $fieldsinfo['tablename']=='product' )
														{
															
															if(($cnt-$startindex)==1)
															   $insertfields[]=$fieldsinfo['updatecolumn'];
															switch(trim(strtolower($row[$f_val])))
															{
																case 'yes': 
																			$f_value="1";
																			break;
																case 'no': 
																			$f_value="0";
																			break;	
																default : 
																			$f_value=$row[$f_val];
																
															}
														
															$insertvalue[$cnt-$startindex][]="'".getRealescape($f_value)."'";
															if($fieldsinfo['updatecolumn']=='product_name')
																{
																	$insertfields[]="product_url";
																	$insertvalue[$cnt-$startindex][]="'".generateslug(getRealescape($f_value))."'";
																}
															
														}
														else if(count($otherTableData)>0)
														{ 
																										   
														  if($fieldsinfo['updatetable']=='product' ) {

																$f_value=searchkeyvalue($row[$f_val],$otherTableData[$fieldsinfo['tablename']],$fieldsinfo['columnname'],$fieldsinfo['idname']);
																 
																 if($f_value=='')
																{
																   $f_value=0;
																   $iserror=1;
																   $errortype="headrow";
																   $errorind=$f_val;
																   $errortab=$f_ind;
																   if(!in_array($cnt-$startindex,$errorrowindex))
																		$errorrowindex=$cnt-$startindex;
																   if(!in_array($f_ind,$errorvalue['f_ind']))
																	    $errorvalue['f_ind'][]=$f_ind;
																   if(!in_array($f_val,$errorvalue['value']))
																        $errorvalue['value'][]=$f_val;
																	
																	goto error;
																	
																} 
																else{
															if(($cnt-$startindex)==1)
															   $insertfields[]=$fieldsinfo['updatecolumn'];
														     
															$insertvalue[$cnt-$startindex][]="'".getRealescape($f_value)."'";
																															
															}
														  }
														  else 
														  {		
															
															  if($fieldsinfo['IsSubAttr']==1)
															  {
																
																  $f_value=searchkeyvalue($row[$prod_attr[$f_ind][$f_val]],$otherTableData[$fieldsinfo['tablename']],$fieldsinfo['columnname'],$fieldsinfo['idname']);
																
																
																   if($f_value=='')
																   {
																	   $f_value=0;
																	   $iserror=1;
																	   if(!in_array($cnt-$startindex,$errorrowindex))
																	    $errorrowindex[]=$cnt-$startindex;
																	 if(!in_array($f_ind,$errorvalue['f_ind']))
																		$errorvalue['f_ind'][]=$f_ind;
																	 if(!in_array($prod_attr[$f_ind][$f_val],$errorvalue['value']))
																		$errorvalue['value'][]=$prod_attr[$f_ind][$f_val];
																	goto error;
																	
																   } 
																else{
																	if(($cnt-$startindex)==1)
																		$otherinsertfields[$fieldsinfo['updatetable']]=array($fieldsinfo['updatecolumn'],$fieldsinfo['product_id_col']);
																	
																		$otherinsertvalue[$fieldsinfo['updatetable']][$cnt-$startindex]="'".getRealescape($f_value)."'"; 
																}																 
																  
															  }
															  else
															  {
																  
																  $f_value=searchkeyvalue($row[$f_val],$otherTableData[$fieldsinfo['tablename']],$fieldsinfo['columnname'],$fieldsinfo['idname']);
																 
																 if($f_value=='')
																{
																   $f_value=0;
																   $iserror=1;
																 if(!in_array($cnt-$startindex,$errorrowindex))  
																   $errorrowindex[]=$cnt-$startindex;
																  if(!in_array($f_ind,$errorvalue['f_ind']))  
																   $errorvalue['f_ind'][]=$f_ind;
																  if(!in_array($f_val,$errorvalue['value']))  
																   $errorvalue['value'][]=$f_val;
															   goto error;
															  
																} 
																else{
																if(($cnt-$startindex)==1)
																  $otherinsertfields[$fieldsinfo['updatetable']]=array($fieldsinfo['updatecolumn'],$fieldsinfo['product_id_col']);
																 $otherinsertvalue[$fieldsinfo['updatetable']][$cnt-$startindex]="'".getRealescape($f_value)."'"; 
																}
																  
															  }
															  
														  }
														}
														
														
													 }	

														 foreach($attr_prod as $f_ind=>$f_val)
															{
														
																
																if($f_val!=''){
																$attrinfo=searchkeyArray($f_ind,$arrAttrFields,"attributeid");
																
																switch($attrinfo['attribute_type'])
																{
																	case "text":
																	case "textarea":
																				$attrinsertfields[$cnt-$startindex][]=array("type"=>"text","attribute_id"=>$attrinfo['attributeid'],"value"=>$row[$f_val],"product_id"=>"product_id");	
																				 break;
																	case "dropdown":
																	case "multiselect":
																	case "checkbox":
																	case "radio":	
																					$attrvalue_index=explode(",",$f_val);
																					foreach($attrvalue_index as $inx)
																					{
																					
																						if($row[$inx]!="" && $row[$inx]!="-")
																						{
																							 $attrname=$attrheaderrow[$inx];
																							 $dropdownid=searchkeyvalue_attrid($attrname,$attrinfo['attributeid'],$arrAttrFields_Values);																							
																							 if($dropdownid=='0')
																								{
																								   $dropdownid=0;
																								   $iserror=1;
																								 if(!in_array($cnt-$startindex,$errorrowindex))  
																								   $errorrowindex[]=$cnt-$startindex;
																								  if(!in_array($f_ind,$errorvalue['f_ind']))  
																								   $attrerrorvalue['f_ind'][]=$f_ind;
																								  if(!in_array($f_val,$errorvalue['value']))  
																								   $attrerrorvalue['value'][]=$attrname;
																								  goto error;	
																								}
																								else
																								{
																									$chkIscombined=searchkeyvalue($attrinfo['attributeid'],$arrAttrtype,"attributeId","isCombined");
																									if($chkIscombined==1)
																									{
																										
																										$split_value=explode("|",$row[$inx]);																										
																										$attrinsertfields[$cnt-$startindex][]=array("type"=>"combined","attr_combi_id"=>$dropdownid,"base_productId"=>"product_id","price"=>$split_value[0],"sku"=>$split_value[1],"quantity"=>$split_value[2]);	
																										
																									}
																									else
																									{
																										$attrinsertfields[$cnt-$startindex][]=array("type"=>"attr","attribute_id"=>$attrinfo['attributeid'],"product_id"=>"product_id","dropdown_id"=>$dropdownid);	
																										
																									}
																									
																								}
																						}				
																					}																					
																					break;												
																	
																}
																
																
																
																
																
																}
																
															}
													}
													
												  $cnt++;
												}
												break; 
											}
										}
										
									
									break;
						case "csv":	
										break;
						default:
									
									$iserror=1;
									goto error;
									break;
					}			
							
					

	break;
	
}


$today=date("Y-m-d H:i:s");
$prodQueryHeader = " insert into ".TPLPrefix."product ( ".implode(",",$insertfields).",UserId,createdDate,modifiedDate  )";
$rowind=0;
if(count($insertvalue)>0)
{
	$insertQuery="";
   foreach($insertvalue as $key=>$row)
   {
	
	  $insertQuery.= $prodQueryHeader." values (".implode(",",$row).",'".$_SESSION["UserId"]."','".$today."','".$today."' ); 
			  
					 SET @lastproducid".$rowind."=LAST_INSERT_ID(); 	
	  ";
	 
	  if(count($otherinsertvalue)>0)
	  {
			 foreach($otherinsertfields as $o_tab=>$o)
			 {
				//foreach($otherinsertvalue[$o_tab][$key] as $single_id)
				//{
					
				  $insertQuery.=" insert into ".TPLPrefix.$o_tab." ( ".implode(",",$o).",IsActive,UserId,createdDate,modifiedDate ) ";
				  $insertQuery.=" values( ".$otherinsertvalue[$o_tab][$key].",@lastproducid".$rowind.",'1','".$_SESSION["UserId"]."','".$today."','".$today."' ); ";
			   // } 
			 }
	  }
	  
	  foreach($attrinsertfields[$key] as $a_row)
	  {
		 
		  $attrfieldheader=array();
		  $attrfieldvalue=array();
		  foreach($a_row as $attr_field_col=>$attr_field_value)
		  {
			 // print_r($attr_field_col);
			  
			  if($attr_field_col!="type")
				{
					$attrfieldheader[]=$attr_field_col;
					if($attr_field_value=='')
						$attr_field_value="''";
					$attrfieldvalue[]=$attr_field_value;
				}
		  }  
			  switch($a_row['type'])
			  {
				  case "combined":
									 $insertQuery.=" insert into ".TPLPrefix."product_attr_combi ( ".implode(",",$attrfieldheader)." ) ";
									 $insertQuery.=" values(  ".str_replace("product_id","@lastproducid".$rowind, implode(",",$attrfieldvalue))."  ); "; 	
									break;	
				  case "attr":
										$insertQuery.=" insert into ".TPLPrefix."product_attr_dropdwid ( ".implode(",",$attrfieldheader)." ) ";
										$insertQuery.=" values(  ".str_replace("product_id","@lastproducid".$rowind, implode(",",$attrfieldvalue))."  ); "; 	
				  
									break;	
				   case "text":
									 $insertQuery.=" insert into ".TPLPrefix."product_attr_varchar ( ".implode(",",$attrfieldheader)." ) ";
									 $insertQuery.=" values(  ".str_replace("product_id","@lastproducid".$rowind, implode(",",$attrfieldvalue))."  ); "; 	
				  
									break;	
			  }
			 
			  
		 
			
	  }
	
	 
	  
	 $rowind++;  
   }
}	
  echo  $insertQuery; die();

exit();  
														
error:
$reader->close();
if($errortype=="headrow")
	echo json_encode(array("error"=>"1","type"=>"headrow","tab"=>$errortab,"val_ind"=>$errorvalue,"rowindex"=>$errorrowindex,"msg"=>$headerrow[$errorind]." value ".$row[$errorind]." not in our database.<br/> Are you want add?"));
die();

function searchkeyvalue_attrid($searchtext,$attrbuteid,$arrays)
{
	
	 foreach ($arrays as $arr) {
		 
		   if (strtolower($arr['dropdown_values'])==strtolower(trim($searchtext)) && strtolower($arr['attributeId'])==strtolower($attrbuteid)) { 
		   		 return $arr['dropdown_id'];
		}
	
	 }
   return '0';	
}

*/

?>