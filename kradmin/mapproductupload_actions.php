<?php 
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
include 'session.php';
require_once "Psr4Autoloader.php";
extract($_REQUEST);
$act=$action;

switch($act)
{
	case 'upload':		
					
					
					
					$iserror=0;
					$loader = new \Autoloader\Psr4Autoloader;
					$loader->register();
					$loader->addNamespace('Box\Spout', 'Spout');
						
					$fileinfo=pathinfo($edit_id);
					$resfieldsupload=$db->get_rsltset(" Select * from ".TPLPrefix."productupload_fields where IsActive=1 order by fieldId ");
					
					$tablelist=$db->get_rsltset("SELECT distinct tablename  from ".TPLPrefix."productupload_fields where IsActive=1 and tablename!='product' ");
					
					
					$otherTableData=array();
					foreach($tablelist as $l)
					{
						$otherTableData[$l['tablename']]=$db->get_rsltset("select * from  ".TPLPrefix.$l['tablename']." where IsActive <> '2' ");
					}
					
					$arrAttrFields=$db->get_rsltset(" Select * from ".TPLPrefix."m_attributes where IsActive<>2 ");
					
					$arrAttrFields_Values=$db->get_rsltset(" Select * from ".TPLPrefix."dropdown where IsActive<>2 ");
					
					$arrAttrtype=$db->get_rsltset(" Select * from ".TPLPrefix."attributes where IsActive<>2 ");
													
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
													$prodsku='';
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
																	if(($cnt-$startindex)==1){
																	$insertfields[]="product_url";
																		}
																	
																}
															if($fieldsinfo['updatecolumn']=='sku')
																{
																	
																	$insertvalue[$cnt-$startindex][]="'".generateslug(getRealescape($f_value))."'";
																	$prodsku=generateslug(getRealescape($f_value));
																}	
															
														}
														else if(count($otherTableData)>0)
														{ 
																										   
														  if($fieldsinfo['updatetable']=='product' ) {

																$f_value=searchkeyvalue($row[$f_val],$otherTableData[$fieldsinfo['tablename']],$fieldsinfo['columnname'],$fieldsinfo['idname']);
																 
																 if($f_value=='' && $row[$f_val]!='')
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
																  
																catprevstep:
																//  $f_value=searchkeyvalue($row[$prod_attr[$f_ind][$f_val]],$otherTableData[$fieldsinfo['tablename']],$fieldsinfo['columnname'],$fieldsinfo['idname']);
															//  print_r($otherTableData[$fieldsinfo['tablename']]); die();	
																
																
															$f_value=searchkeyvalue($row[$f_val],$otherTableData[$fieldsinfo['tablename']],$fieldsinfo['columnname'],$fieldsinfo['idname']);
																	
																   if($f_value=='' && $row[$f_val]!='')
																   {
																	
																	/*if($row[$prod_attr[$f_ind][$f_val]]=='')
																	{
																	
																		for($previndex=count($prod_attr)-1;$previndex>=0;$previndex--)
																		{
																			print_r($row[$prod_attr[$f_ind][$f_val]]);
																				$f_ind=$f_ind-$previndex;
																				echo 'jjj';
																			print_r($row[$prod_attr[$f_ind][$f_val]]);	
																			if($row[$prod_attr[$f_ind][$f_val]]!=''){
																				print_r($row[$prod_attr[$f_ind][$f_val]]);  
																				 goto catprevstep;
																			}
																		}
																	} */
																	
																	/*   $f_value=0;
																	   $iserror=1;
																	$arrattr1=explode(",", $f_val);
																	if(in_array(($prod_attr[$f_ind][$f_val]-1),$arrattr1))
																	  $prevfieldvalue=$row[($prod_attr[$f_ind][$f_val]-1)];
																 
																   $errortype="prodattrrow";
																   $errorind=$prod_attr[$f_ind][$f_val];;
																   $errortab=$f_ind;
																   if(!in_array($cnt-$startindex,$errorrowindex))
																		$errorrowindex=$cnt-$startindex;
																   if(!in_array($f_ind,$errorvalue['f_ind']))
																	    $errorvalue['f_ind'][]=$f_ind;
																   if(!in_array($f_val,$errorvalue['value']))
																        $errorvalue['value'][]=$prod_attr[$f_ind][$f_val];
																	goto error; */
																	
																  $f_value=0;
																   $iserror=1;
																   $errortype="categoryrrow";
																   $errorind=$f_val;
																   $errortab=$f_ind;
																  // print_r($arrattr1); die();
																  // $arrattr1=explode(",", $f_val);
																	//if(in_array(($prod_attr[$f_ind][$f_val]-1),$arrattr1))
																	  $prevfieldvalue=$row[($f_val-1)];
																   if(!in_array($cnt-$startindex,$errorrowindex))
																		$errorrowindex=$cnt-$startindex;
																   if(!in_array($f_ind,$errorvalue['f_ind']))
																	    $errorvalue['f_ind'][]=$f_ind;
																   if(!in_array($f_val,$errorvalue['value']))
																        $errorvalue['value'][]=$f_val;
																	
																	goto error;
																	
																   } 
																else {
																	
																	
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
																   
																   $errortype="headrow";
																   $errorind=$f_val;
																   $errortab=$f_ind;
																   
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
																				$attrinsertfields[$cnt-$startindex][]=array("type"=>"text","attribute_id"=>$attrinfo['attributeid'],"attribute_value"=>$row[$f_val],"product_id"=>"product_id");	
																				 break;
																	case "dropdown":												
																	case "multiselect":
																	case "checkbox":
																	case "radio":	
																	//print_r($attrinfo); 
																	
																					$attrvalue_index=explode(",",$f_val);
																						
																	
																					foreach($attrvalue_index as $inx)
																					{
																						
																				//echo "<pre>";		
																				//print_r($row[$inx]);
																				//echo "<br>";
																				//print_r($inx);	
																						if(trim($row[$inx])!="" && trim($row[$inx])!="-")
																						{
																							//echo "jjj";
																							//echo '<pre>';
																						//print_r($inx);
																							 $attrname=$attrheaderrow[$inx];
																							if($attrname!=""){ 
																							 $dropdownid=searchkeyvalue_attrid($attrname,$attrinfo['attributeid'],$arrAttrFields_Values);																							
																							 if($dropdownid=='0')
																								{
																								   $dropdownid=0;
																								   $iserror=1;
																								   
																								    $errortype="attrrow";
																								    $attrbuteid=$attrinfo['attributeid'];
																								    $attrbutevalue=$attrname;																						   
																									$baseattrbutevalue=$attrinfo['attributename'];
																									
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
																										$arrDropdownids[$cnt-$startindex][]=$dropdownid;		
																										$attrinsertfields[$cnt-$startindex][]=array("type"=>"combined","attr_combi_id"=>$dropdownid,"base_productId"=>"product_id","price"=>$split_value[0],"sku"=>$prodsku.'-'.generateslug(getRealescape($attrname)),"quantity"=>$split_value[2]);	
																										
																									}
																									else
																									{
																										$attrinsertfields[$cnt-$startindex][]=array("type"=>"attr","attribute_id"=>$attrinfo['attributeid'],"product_id"=>"product_id","dropdown_id"=>$dropdownid);	
																										
																									}
																									
																								}
																							}
																							else {
																								
																								 $dropdownid=searchkeyvalue_attrid($row[$inx],$attrinfo['attributeid'],$arrAttrFields_Values);
																								 
																																																													if($dropdownid=='0')
																								{
																								   $dropdownid=0;
																								   $iserror=1;
																								   
																								    $errortype="attrrow";
																								    $attrbuteid=$attrinfo['attributeid'];
																								    $attrbutevalue=$attrname;																						   
																									$baseattrbutevalue=$attrinfo['attributename'];
																									
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
																									$attrinsertfields[$cnt-$startindex][]=array("type"=>"attr","attribute_id"=>$attrinfo['attributeid'],"product_id"=>"product_id","dropdown_id"=>$dropdownid);	
																								}
																								
																								
																							}
																						}				
																					}
																						break;																					
																	
																}
																
																
																
																
																
																}
																
															}
															//echo "vvvV";
															//die();
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
$prodQueryHeader = " insert into ".TPLPrefix."product ( ".implode(",",$insertfields).",dropdown_id,UserId,created_date,modified_date  )";
$rowind=0;
if(count($insertvalue)>0)
{
	$insertQuery="";
   foreach($insertvalue as $key=>$row)
   {
	
	  $insertQuery.= $prodQueryHeader." values (".implode(",",$row).",'".implode(",",$arrDropdownids[$key])."','".$_SESSION["UserId"]."','".$today."','".$today."' ); 
			  
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
	 
	 $arr_combined=array();
	  foreach($attrinsertfields[$key] as $a_row)
	  {
		 
		 //print_r($attrinsertfields[$key]); die();
		 
		  $attrfieldheader=array();
		  $attrfieldvalue=array();
		  foreach($a_row as $attr_field_col=>$attr_field_value)
		  {
			 // print_r($attr_field_col);
			  
			  if($attr_field_col!="type")
				{
					$attrfieldheader[]=$attr_field_col;
					if($attr_field_value=='')
						$attr_field_value="";
					$attrfieldvalue[]=$attr_field_value;
				}
		  }  
		  
			  switch($a_row['type'])
			  {
				  case "combined":
									$isdefault=count($arr_combined)=='0'?'1':'0';
									 $insertQuery.=" insert into ".TPLPrefix."product_attr_combi ( ".implode(",",$attrfieldheader).",isDefault,IsActive,createdDate,modifiedDate  ) ";
									 $insertQuery.=" values(  ".str_replace("'product_id'","@lastproducid".$rowind, "'" . implode("','",$attrfieldvalue). "'").",'".$isdefault."','1','".$today."','".$today."'  ); "; 	
									  $arr_combined[]=$a_row['attr_combi_id'];
									break;	
				  case "attr":
										$insertQuery.=" insert into ".TPLPrefix."product_attr_dropdwid ( ".implode(",",$attrfieldheader).",IsActive,createdDate,modifiedDate  ) ";
										$insertQuery.=" values(  ".str_replace("'product_id'","@lastproducid".$rowind, "'" . implode("','",$attrfieldvalue). "'").",'1','".$today."','".$today."'  ); ";	
				  
									break;	
				   case "text":
									
									 $insertQuery.=" insert into ".TPLPrefix."product_attr_varchar ( ".implode(",",$attrfieldheader).",IsActive,createdDate,modifiedDate  ) ";
									 $insertQuery.=" values(  ".str_replace("'product_id'","@lastproducid".$rowind, "'" . implode("','",$attrfieldvalue). "'").",'1','".$today."','".$today."'  ); ";
				  
									break;	
			  }
			 
			 
		 
			
	  }
	   if(count($arr_combined)>0)
			  {
				 
				  $insertQuery.=" update  ".TPLPrefix."product set dropdown_id='".implode(",",$arr_combined)."' where product_id=@lastproducid; "; 
				  
			  }
	
	 
	  
	 $rowind++;  
   }
}	
//echo "jjj"; die();
 //echo $insertQuery; die();
   $db->multi_query($insertQuery); 
   echo json_encode(array("error"=>"0","msg"=>" Products Successfully Uploaded."));	
exit();  
														
error:
$reader->close();

if($errortype=="headrow"){
	echo json_encode(array("error"=>"1","type"=>"headrow","tab"=>$errortab,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$headerrow[$errorind]." value ".$row[$errorind]." not in our database.<br/> Are you want add?"));
}
else if($errortype=="prodattrrow") {
	echo json_encode(array("error"=>"1","type"=>"prodattrrow","prevfieldvalue"=> $prevfieldvalue,"tab"=>$errortab,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$attrheaderrow[$errorind]." value ".$row[$errorind]." not in our database.<br/> Are you want add?"));
	
}
else if($errortype=="categoryrrow") {
	echo json_encode(array("error"=>"1","type"=>"prodattrrow","prevfieldvalue"=> $prevfieldvalue,"tab"=>$errortab,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$headerrow[$errorind]." value ".$row[$errorind]." not in our database.<br/> Are you want add?"));
	
}
else if($errortype=="attrrow") {
	echo json_encode(array("error"=>"1","type"=>"attrrow","attrbuteid"=> $attrbuteid,"attrbutevalue"=>$attrbutevalue,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$baseattrbutevalue." value ".$attrbutevalue." not in our database.<br/> Are you want add?"));
	
}


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



?>