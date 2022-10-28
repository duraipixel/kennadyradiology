  <?php

			if(($helper instanceof common_function) != true && empty($helper)){
					$helper=$this->loadHelper('common_function');
				}
			
			if(($product instanceof product_model) != true && empty($product)){
				  if (!class_exists("product_model")) {	
					$product=$this->loadModel('product_model');
				  }
				  else{
					$product=$this->loadModelObject('product_model');
				  }					
			}	
				
			if(($helper instanceof common_function) != true && empty($helper)){					
					$helper=$this->loadHelper('common_function');
			}
 ?>
<?php if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>

<form id="frmcustomattr" >
								<?php 
								//echo "<pre>"; 
								//  print_r($productfilter); die();
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								// print_r(); die();
								//echo "<pre>"; print_r($defaultattr); die();
							
								
								 $curdropdownarr=array();
								  $currattrarr=array();
								  $selecteddrpdwn=array();
								 foreach($productfilter as $f) {
									$fsku=$productdetails['sku'];
									
									if($f['sku']!='')
										$fsku=$f['sku'];
									if(!in_array($f['attributeid'],$currattrarr))
									{
								    	$currattrarr[]=$f['attributeid'];
									}
									$currlastattrid=$f['attributeid'];
									
									switch($f['iconsdisplay']){
										 case "1":
												 if(in_array($f['attributeid'],$arrattr))
												 {
													 
													 
													 
													  $clssel='';
													  $chekradio='';
														/*if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}*/
														if(in_array($f['dropdown_id'],$defaultattr))
														{  
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
													
												/*	if($f['dropdown_id']=='89'){
									echo "<br><br><br>joohn3";
								print_r($f['attr_combi_id']);
								var_dump($helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid));
echo "<pre>";									
									}*/
													
													if(($currattrarr[0]==$f['attributeid'] || $helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid)) && !in_array($f['dropdown_id'],$selecteddrpdwn)  ) {	
													$selecteddrpdwn[]=$f['dropdown_id'];
												//	echo "sttribute1---".$f['dropdown_id'];
													//echo "<br><br>";
													
													$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single homecheck '.$clssel.'" >
																	<input type="radio"  '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'"  onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\',\''.(count($currattrarr)-1).'\');">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'"  class="color-label">
																		<img src="'.img_base.'uploads/attributes/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>	<span></span>							  
																 </div>';
													}		 
												 }
												 else{
													 
													
													 
													 if(($cntind%2))
													 {
														 /* 	if($f['dropdown_id']=='89'){
									echo "<br><br><br>joohn1";
									
									print_r($f);
echo "<pre>";									
									}	*/												 
														 if($prevtype==0 && count($arrattr)!=0)
														 {
															 
															 $strattrHTML.='</div>';
														 }
														 
														 if(count($arrattr)!=0)
														 {	 
															
															 $strattrHTML.='</div>';
														 }	 
														 
														$strattrHTML.='<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20 colors">
																		<h6>
																				'.$f['attributename'].'
																			</h6>
																			<div class="divider2"></div>
																			<div class="d-flex flex-wrap align-items-start">
																			'; 
																			
														$clssel='';
													  $chekradio='';
														/*if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}*/
														if(in_array($f['dropdown_id'],$defaultattr))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
														
															
														
														if(($currattrarr[0]==$f['attributeid'] || $helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid)) && !in_array($f['dropdown_id'],$selecteddrpdwn)  ) {	
													$selecteddrpdwn[]=$f['dropdown_id'];
													
													//echo "sttribute2---".$f['dropdown_id'];
													//echo "<br><br>";
													
														
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single homecheck '.$clssel.'" >
																	<input type="radio" '.$chekradio.' id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\',\''.(count($currattrarr)-1).'\');">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'"  class="color-label">
																		<img src="'.img_base.'uploads/attributes/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label><span></span>
																	</div>';
														}			
														 $cntind++;
													 }
													 else {
														 
														 /*	if($f['dropdown_id']=='89'){
									echo "<br><br><br>joohn2";
									
									print_r($f);
echo "<pre>";									
									} */
														
														  if($prevtype==0){
															  	
															 $strattrHTML.='</div>';
														  } 
														  if(count($arrattr)!=0)
														  {
															  
															 $strattrHTML.='</div>';
														  }	 
														 
														 $strattrHTML.='<div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
																		<h6>
																				'.$f['attributename'].'
																			</h6><div class="divider2"></div><div class="d-flex flex-wrap align-items-start">
																			'; 
													$clssel='';
													  $chekradio='';
														/*if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}*/
														if(in_array($f['dropdown_id'],$defaultattr))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
														
																if(($currattrarr[0]==$f['attributeid'] || $helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid)) && !in_array($f['dropdown_id'],$selecteddrpdwn)  ) {	
													$selecteddrpdwn[]=$f['dropdown_id'];	
				//echo "sttribute3---".$f['dropdown_id'];
												//	echo "<br><br>";
													
													
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single homecheck '.$clssel.'" >
																	<input type="radio" '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\',\''.(count($currattrarr)-1).'\');">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>	<span></span>							  
																 </div>';
															}		 
																 
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
										case "0":
													 if(in_array($f['attributeid'],$arrattr))
												 {
													  $clssel='';
													  $chekradio='';
														/*if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}*/
														if(in_array($f['dropdown_id'],$defaultattr))
														{
														
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														   $chekradio=' checked ';
														}
														
													
														if(($currattrarr[0]==$f['attributeid'] || $helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid)) && !in_array($f['dropdown_id'],$selecteddrpdwn)  ) {	
													$selecteddrpdwn[]=$f['dropdown_id'];
								//echo "sttribute4---".$f['dropdown_id'];
									//				echo "<br><br>";					
										
													$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single  '.$clssel.'" >
																	<input type="radio"  '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\',\''.(count($currattrarr)-1).'\');">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>	<span></span>							  
																 </div>';
														}		 
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0  && $cntind!=1 ){
															
															 $strattrHTML.='</div>';
														 }
														 
														 if(count($arrattr)!=0){
															
															 $strattrHTML.='</div>';
														 }
														 
														$strattrHTML.='<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
																		<h6>
																				'.$f['attributename'].'
																			</h6><div class="divider2"></div><div class="d-flex flex-wrap align-items-start">
																			'; 
																			
														$clssel='';
													  $chekradio='';
														/*if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}*/
													if(in_array($f['dropdown_id'],$defaultattr))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														   $chekradio=' checked ';
														}
																if(($currattrarr[0]==$f['attributeid'] || $helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid)) && !in_array($f['dropdown_id'],$selecteddrpdwn)  ) {	
													$selecteddrpdwn[]=$f['dropdown_id'];	
												//	echo "sttribute5---".$f['dropdown_id'];
												//	echo "<br><br>";
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single  '.$clssel.'" >
																	<input type="radio" '.$chekradio.' id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\',\''.(count($currattrarr)-1).'\');">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>	<span></span>							  
																 </div>';
															}		 
														 $cntind++;
													 }
													 else {
														  if(($prevtype==0 || $prevtype==1) && $cntind!=1)
														  {
															
															 $strattrHTML.='</div>';
														  }
														  if(count($arrattr)!=0)
														  {
															  
															 $strattrHTML.='</div>';
														   }	 
														 
														 $strattrHTML.='<div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
																		<h6>
																				'.$f['attributename'].'
																			</h6><div class="divider2"></div><div class="d-flex flex-wrap align-items-start">

																			'; 
													$clssel='';
													  $chekradio='';
														/*if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}*/
													if(in_array($f['dropdown_id'],$defaultattr))
														{
														   $curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														   $chekradio=' checked';
														}
														if(($currattrarr[0]==$f['attributeid'] || $helper->ajaxcheckdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'],$olddropid)) && !in_array($f['dropdown_id'],$selecteddrpdwn)  ) {	
													$selecteddrpdwn[]=$f['dropdown_id'];	
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single  '.$clssel.'" >
																	<input type="radio" '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\',\''.(count($currattrarr)-1).'\');">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>	<span></span>							  
																 </div>';
														}		 
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
											} 

								  }
								  if($prevtype==0)
								  {
									  
									   $strattrHTML.='</div>';
									   $strattrHTML.='</div></div>';
								  }
								  else
								  {
									   
									   $strattrHTML.='</div></div>';
									  
								  }
								 echo $strattrHTML; 
								 
								
 
								if($productsizechart['attribute_value'] != ''){?><p><a href="javascript:void(0)" data-toggle="modal" data-target="#sizeChartModal"><strong class="text-orange"><i class="flaticon-resize" ></i> Size Chart</strong></a></p>
								<?php  }?>
 
								</form>
<?php } ?>				