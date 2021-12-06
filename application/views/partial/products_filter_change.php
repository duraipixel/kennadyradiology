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
								 // print_r($productfilter); die();
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								// print_r(); die();
							//	echo "<pre>"; print_r($productfilter); die();
								 $curdropdownarr=array();
								
								  $currattrarr=array();
								 foreach($productfilter as $f) {
									$fsku=$productdetails['sku'];
									//print_r($f); die();
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
														if(in_array($f['dropdown_id'],$olddropid))
														{  
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
													
													if($currattrarr[0]==$f['attributeid'] || $helper->checkdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid']) ) {		
													$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single homecheck '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\');">
																	<input type="radio"  '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'"  class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>	<span></span>							  
																 </div>';
													}		 
												 }
												 else{
													 
													
													 
													 if(($cntind%2))
													 {
														  														 
														 if($prevtype==0 && count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20 colors">
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
														if(in_array($f['dropdown_id'],$olddropid))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
														
															
														
														if($currattrarr[0]==$f['attributeid'] || $helper->checkdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'])) {	 	
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single homecheck '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\');">
																	<input type="radio" '.$chekradio.' id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'"  class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label><span></span>
																	</div>';
														}			
														 $cntind++;
													 }
													 else {
														 
														
														  if($prevtype==0)
															 $strattrHTML.='</div>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
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
														if(in_array($f['dropdown_id'],$olddropid))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
														
															if($currattrarr[0]==$f['attributeid'] || $helper->checkdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'])) {	
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single homecheck '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\');">
																	<input type="radio" '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
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
														if(in_array($f['dropdown_id'],$olddropid))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
														
													
														if($currattrarr[0]==$f['attributeid'] || $helper->checkdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'])) {		
												
													$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\');">
																	<input type="radio"  '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>	<span></span>							  
																 </div>';
														}		 
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</div>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
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
														if(in_array($f['dropdown_id'],$olddropid))
														{
															$curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked ';
														}
															if($currattrarr[0]==$f['attributeid'] || $helper->checkdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'])) { 	
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\');">
																	<input type="radio" '.$chekradio.' id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="'.$f['attributecode'].'_'.$f['dropdown_id'].'" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>	<span></span>							  
																 </div>';
															}		 
														 $cntind++;
													 }
													 else {
														  if($prevtype==0 || $prevtype==1)
															 $strattrHTML.='</div>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
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
														if(in_array($f['dropdown_id'],$olddropid))
														{
														   $curdropdownarr[$f['attributeid']]=$f['dropdown_id'];
														   $clssel='  ';
														    $chekradio=' checked';
														}
														if($currattrarr[0]==$f['attributeid'] || $helper->checkdrdwvalid($f['dropdown_id'],$curdropdownarr,$f['attr_combi_id'],$f['attributeid'])) {		
														$strattrHTML.='<div class="chiller_cb '.$f['attributecode'].'-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$f['attributecode'].'\');">
																	<input type="radio" '.$chekradio.'  id="'.$f['attributecode'].'_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
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
								?>
								
 
								</form>
<?php } ?>				