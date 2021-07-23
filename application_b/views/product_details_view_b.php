<?php  	
//echo "<pre>"; print_r($productdetails); exit;
include ('includes/top.php');

 ?>
 <link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
 <body class="productbg">
<?php include ('includes/header.php') ?>
<?php


//echo $helper->displaymenu();

//$price=$helper->calculateproductPrice($productdetails['price'],$productdetails['taxTyp'],$productdetails['taxRate']);
			
	// $arrdisvalue=$helper->calculateproductDiscountPrice($productdetails['price'],$productdetails['taxTyp'],$productdetails['taxRate'],$productdetails['specialprice'],$productdetails['spl_fromdate'],$productdetails['spl_todate'],$productdetails['prod_DiscountType'],$productdetails['prod_DiscountAmount'],$productdetails['cat_DiscountType'],$productdetails['cat_DiscountAmount'],$productdetails['cust_DiscountType'],$productdetails['cust_DiscountAmount'],$productdetails['deals_DiscountType'],$productdetails['deals_DiscountAmount']);
	
	//  echo "<pre>";
	//  print_r($productdetails); exit;
?>
  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
					  <?php
							$arrbread=array();
							$helper->getProductBread($productdetails['categoryID'],$arrbread);
							
							$breadpath='';
							for($a=count($arrbread)-1;$a>=0;$a--){
								$breadpath.=$arrbread[$a]['code'].'/';
					?>
					 <li><a href="<?php echo BASE_URL.$breadpath;?>"><?php echo $arrbread[$a]['name']; ?></a></li>
							<?php } ?>
					 <li><a href="javascript:void(0);"><?php echo $productdetails['product_name']; ?></a></li>		
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
    
	<section class="cmn-sctr n-pb btwn-gp">
		<div class="container">				
				<div class="pro-details">
					  <div class="row">
					  <div id="productimage">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 nopad">		
						
						<div class="singleprd-sliderwraper">
						
							<div class="singleprd-slider">
							<?php 
							/*echo "ggg";
							echo "<pre>";
							print_r($productdetails); die(); */
							if($productdetails['img_names']!=''){
							$pro_img = explode('|',$productdetails['img_names']);
                             foreach($pro_img as $list_img){
						     ?>
								<div class="singleprd">
									<a href="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>" class="products imgBox" data-lightbox="product">
										<img src="<?php echo BASE_URL?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $list_img; ?>" class="img-responsive center-block" data-origin="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>" alt="product"> 
																	
									</a>
								</div>
						    <?php } } else { ?>
							
							
								<div class="singleprd">
									<a href="<?php echo BASE_URL;?>uploads/noimage/photos/noimage.png" class="products imgBox" data-lightbox="product">
										<img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="img-responsive center-block" data-origin="<?php echo BASE_URL;?>uploads/noimage/photos/noimage.png" alt="product">
									</a>
								</div>
							
							<?php } ?>
							
					         </div>
						
						</div>	
						<div class="col-md-12 col-sm-12 col-xs-12 nopad thumbnailprd-slider">
						
						<?php 
						$customimage='';
						if($productdetails['uploadecustomizedimg']!='' )
						{
							 $customimage= BASE_URL.'uploads/customizedproduct/thumbnails/'.$productdetails['uploadecustomizedimg'];
							//$customimage= BASE_URL.'uploads/customizedproduct/thumbnails/1571732194210233_C.jpg';
							
						}							
						if($productdetails['img_names']!=''){
						  $pro_img = explode('|',$productdetails['img_names']);
                           foreach($pro_img as $list_img){
							if($customimage=="")   
							 $customimage= BASE_URL."uploads/productassest/".$productdetails['product_id']."/photos/base/".$list_img;
						   	 
						?>
						    
							<div class="singleprd">
						
								<div class="singleprd-inner">
									<img class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/thumb/<?php echo $list_img; ?>" alt="product">
								</div>
								
							</div>
						<?php } } else {  ?>
						<div class="singleprd">
						
								<div class="singleprd-inner">
									<img class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/noimage/photos/thumb/noimage.png" alt="product">
								</div>
								
							</div>
										
						<?php } ?>						
						</div>							  

							
						</div>
					</div>	
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 nopad productright-wraper">
						<div class="product-topdetails">																	
						<div class="row">																	
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="infotitle">
									<span><h1><?php echo $productdetails['product_name']; ?></h1></span>
									
								</div>
								
						<?php if($productdetails['totpent']>0): ?>	
						<span class="offerspan det-vew mt10"><?php echo $productdetails['totpent']; ?>% discount</span>
					    <?php ENDIF; ?>	
							</div> 
						</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prodec-wraper">
						<div class="row">
						
						
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="pro-detdec">
								
									<div class="pro-dec">
										 <div class="littit">Product Description</div>
										 
										<div>
											<p><?php echo $productdetails['description']; ?></p>
										</div>	
										 <ul class="dethedul">
									
									
										<li>
											<div class="dettit">
												Product Code												
											</div>
											<div class="detcnt">
												<p><?php echo $productdetails['sku']; ?></p>
											</div>
										</li> 
									</ul>									
									</div> 
									
									
									
									<div class="proc-attr">
									
									<?php foreach($productattributes as $attr) {
										if($attr['value']!='')
										{
										?>
										<div class="dettit">
											<?php echo $attr['attributename']; ?>	
										</div>
										<div class="detcnt">
										<?php echo $attr['value']; ?>	
										</div>
									<?php		
										}
									 } ?>
									</div>
									
								</div>
								</div>
								</div>
							
							
								<?php
								  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
								<div class="productcolor-details" id="divcustomattr">
								<form id="frmcustomattr" >
								<?php 
								//echo "<pre>"; 
								 // print_r($productfilter); die();
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								 
								// print_r($productfilter); die();
								 
								 foreach($productfilter as $f) {
									$fsku=$productdetails['sku'];
									if($f['sku']!='')
										$fsku=$f['sku'];
									switch($f['iconsdisplay']){
										 case "1":
												 if(in_array($f['attributeid'],$arrattr))
												 {
													  $clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</select>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-md-8">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-md-8">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
										case "0":
												if(in_array($f['attributeid'],$arrattr))
												 {
													 $clssel='';
													 if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
													 }else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
													   $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</select>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-md-8">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			<select class="select2 form-control required" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value);">
																			<!--<option value="">None</option>-->
																			'; 
														$clssel='';
														if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
														}else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
														  $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 $strattrHTML.='<div class="col-md-8">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			<select class="select2 form-control" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value);">
																			<option value="">select..</option>
																			'; 
														 	
														 $clssel='';
														if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
														}else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
														 
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
													 }													 
												 }
												$arrattr[]=$f['attributeid'];
												$prevtype=$f['iconsdisplay'];
												 break;			
											} 

								  }
								  if($prevtype==0)
								  {
									   $strattrHTML.='</select>';
									   $strattrHTML.='</div></div>';
								  }
								  else
								  {
									   $strattrHTML.='</div></div>';
									  
								  }
								 echo $strattrHTML; 	
								?>
								</form>
								</div>
								  <?php }
                                   $childsid= $helper->getChildsId();
							$arrexcludecat=explode(",",$childsid);
                                // print_r($productdetails); die(); 
								$max_dp = ($productdetails['final_price_tax']*$getmaximum_dp['max_discnt_slap'])/100;
								$maxdiscountamtfp = ($productdetails['final_price_tax'] - $max_dp);
                         
								  ?>
								 <?php if($productdetails['final_price_tax']>0): ?>									  
								 <?php if($productdetails['soldout']==0) : ?>
								 

								<div id="detailspricewraper" class="detailsprice-wraper">
								
										<div class="pricewraper">
									<!--	<span class="tager">M.R.P. : </span><span class="actualprice"><i class="fa fa-inr"></i><?php echo round($productdetails['final_orgprice'],2); ?></span><br> -->
											<?php if($productdetails['totpent']>0): ?>	
											<?php	 if(!in_array($productdetails['categoryID'],$arrexcludecat)){ ?>
										<span class="tager">Price : </span><span class="offerprice"><i class="fa fa-inr"></i> <?php echo  number_format($productdetails['final_price_tax'],2); ?>
											<?php } else { ?>
												<span class="offerprice"><i class='fa fa-inr'></i><?php echo number_format($productdetails['final_price_tax'],2); ?>
											<?php } ?>
											 
											</span><span class="offertext"> MOQ is <?php echo $productdetails['minquantity']; ?></span>
											<br/>
											
											<?php ELSE : ?>
												<span class="offerprice"><i class="fa fa-inr"></i><?php echo  number_format($productdetails['final_price_tax'],2); ?>
												 
												</span>
												 
										   <?php ENDIF; ?>
										</div>
										<small>* Inclusive of GST</small>
										 <div class="chk-avl">
									<div class="form-group">				   
									<div class="col-md-8 pl0">
									<form id="divcheckavail" onSubmit="return false">
									<div class="littit"><i class="fa fa-map-marker"></i> <small>Check Availability </small></div>
										<input type="hidden" name="checkout" value="checkoutaddress">
										<input type="text" class="form-control number required " value="<?php echo $_SESSION['shippincode'];?>" id="shippincode" name="shippincode" placeholder="Enter Deliver Pincode" required="" maxlength="6" data-parsley-error-message="Please enter valid pincode"   data-parsley-type="number" >
										<button type="submit" onClick="fnchkCodeAvailable();" class="button btn-primary">Check</button>
									</div> 
									</form>
									</div> 
								  </div>
								  <?php if(isset($_SESSION['shippincode']) || $_SESSION['shippincode']!='' ){	
										$clserror=" Style=' display:none;'";
										$clssucess=" Style=' display:block;'";
										//print_r($isshippingavail); die();
										if($isshippingavail==0)
										{
											$clserror=" Style=' display:block;'";
											$clssucess=" Style=' display:none;'";
										}
								      }	else{
											$clserror=" Style=' display:none;'";
										$clssucess=" Style=' display:none;'";
									  }										  
									?>
								  <div class="form-group mims" id="chkavallerror" <?php echo $clserror; ?>>				   
									<div class="col-md-8 pl0">
									<div class="error">
									<small>Delivery is not available in this Location <i class="fa fa-times" aria-hidden="true"></i> </small>
									</div>									
									</div> 
								  </div>
									
								   <div class="form-group mims" id="chkavallsucess" <?php echo $clssucess; ?>>				   
									<div class="col-md-8 pl0">
									<div class="success">
									<small>Delivery is available in this Location <i class="fa fa-check" aria-hidden="true"></i> </small>
									</div>									
									</div> 
								  </div>
										
								   
									</div>
                </div>
									</div>
								
								<?php ENDIF; ?>
									<?php ELSE : ?>
									<div id="detailspricewraper" class="detailsprice-wraper">
										<div class="pricewraper">
											<span class="offerprice">Price on Request</span>
										</div>
									</div>	
					   <?php ENDIF; ?>	
								
								<div class="detailsprice-wraper">
									<div class="quantity">
										<div class="quantity-button quantity-down">-</div>
									   <input type="number" id="prices1" min="<?php echo $productdetails['minquantity']; ?>" onChange="" onMouseMove="" onKeyPress="return validateQty(event);" onKeyDown="numberkeyvalid(event);" onBlur="checkminqty()" step="1" value="<?php echo $productdetails['minquantity']; ?>">
										<div class="quantity-button quantity-up">+</div>
									</div>
									
									<?php if($productdetails['soldout']==0)	: ?>	
								<?php	
									$clsdisable="";
									if(!isset($_SESSION['shippincode']) || $_SESSION['shippincode']=='' ){									  	
										$clsdisable=" disabled ";
									}else{
										if($isshippingavail==0)
										{
											$clsdisable=" disabled ";
										}
									}
								?>		
									
									<a href="javascript:void(0);" id="btnaddtocart" class="btn buynow-btn <?php echo $clsdisable; ?>" onClick="addtocart('<?php echo $productdetails['product_id'];?>');"><span>Add to Cart</span></a>
									<?php ELSE : ?>
										<a href="javascript:void(0);" class="btn buynow-btn disabled"><span>Add to Cart</span></a>
									<?php ENDIF; ?>
									
									
									
									 
								</div>
								</div>								
							</div>
				</div>
					
					<div  class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productspec-wraper">
							<!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">PRODUCT SPECIFICATION</a></li>
								 
								
							  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="tab1">
								<div class="col-lg-10 nopad">
								<div class="content-para">
								<div class="pro-dec">								
										<div>
											<p><?php echo $productdetails['longdescription']; ?></p>
										</div>										
									</div>
									<div class="proc-attr">
									<?php if(count($productattributes)>0){ ?>
										<table class="table table-bordered" >
										<col width="30%">
										<col width="70%">
										<tbody>
									<?php foreach($productattributes as $attr) {
										if($attr['value']!='')
										{
										?>
											
											<tr>
												<td>													
													<p><strong>
											<?php echo $attr['attributename']; ?></strong></p>
					
										</td>
										<td>
											
											<p>
										<?php echo $attr['value']; ?></p>										
										</td>
									</tr>
									<?php		
										}
									 } ?>
									 </tbody>
									 </table>
									<?php } ?> 
									</div>
								
								
																	</div>
								</div>
							</div>
 
							
							
						  </div>
						</div>
						</div>
					</div>
					</div>
				
		</div>
		
	</section>
	
<?php
	//	echo $data=$helper->displayproductsilder('','relatedproduct','Related Products','','10',$productdetails['product_id'],'related-section');	    
	?>	
<?php
		//$data=$helper->displayproductsilder('','bestselling','Customer who bought this also viewed this','','10');	    
		$data=$helper->displayproductsilder('','relatedproduct','Customer who bought this also viewed this','','10',$productdetails['product_id'])
		//$data=$helper->displayproductsilder('','suggestedproduct','Customer who bought this also viewed this','','10',$productdetails['product_id'])
	?>	
<?php
		$data=$helper->displayproductsilder('','bestselling','Related products','','10','','','nt-wtn');	    
	?>

 <!-- <div class="modal fade customize-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
       <?php //include('partial/customizetool.php')?>
   </div>
    
    </div>
  </div>
</div> -->




<div id="popwidg" class="pop">
<div class="pop-wrap-box clearfix">
<a class="clsbtn" href="javascript:closeiframe()"><span>x</span></a>
<div class="popwrapbox-inner">

 <?php include('partial/customizetool.php')?>
</div>
</div>
</div>

<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>

<script src="<?php echo BASE_URL;?>static/customsizetool/js/jquery-ui.min.js" type="text/javascript"></script>


	<!-- HTML5 canvas library - required -->
	<script src="<?php echo BASE_URL;?>static/customsizetool/js/fabric.min.js" type="text/javascript"></script>
	<!-- The plugin itself - required -->
	<script src="<?php echo BASE_URL;?>static/customsizetool/js/plugins.js" type="text/javascript"></script>

	<script src="<?php echo BASE_URL;?>static/js/jquery.fancybox.min.js" type="text/javascript"></script> 
	
	
    <script type="text/javascript">
	var yourDesigner,$yourDesigner;
	    jQuery(document).ready(function(){






	    	 $yourDesigner = $('#clothing-designer'),
	    		pluginOpts = {
		    		stageWidth: 580,
					stageHeight: 580,
		    		editorMode: false,
		    		smartGuides: true,
					langJSON:'<?php echo BASE_URL;?>static/customsizetool/lang/default.json',
					templatesDirectory:'<?php echo BASE_URL;?>html/',
		    		fonts: [
				    	{name: 'Helvetica'},
				    	{name: 'Times New Roman'},
				    	{name: 'Pacifico', url: 'Enter_URL_To_Pacifico'},
				    	{name: 'Arial'},
			    		{name: 'Lobster', url: 'google'}
			    	],
		    		customTextParameters: {
			    		colors: true,
			    		removable: true,
			    		resizable: true,
			    		draggable: true,
			    		rotatable: true,
			    		autoCenter: true,
			    		boundingBox: "Base",
						selectedColor: '#ff0000',
						fontSize:28,
						autoSelect : true
			    	},
		    		customImageParameters: {
			    		draggable: true,
			    		removable: true,
			    		resizable: true,
			    		rotatable: true,
			    		colors: '#000',
			    		autoCenter: true,
			    		boundingBox: "Base",
						autoSelect : true
			    	},
			    	actions:  {
						//'top': ['download','print', 'snap', 'preview-lightbox'],
						//'right': ['magnify-glass', 'zoom', 'reset-product', 'qr-code', 'ruler','snap'],
						'right': [ 'zoom', 'reset-product', 'ruler','snap'],
						'bottom': ['undo','redo'],
						//'left': ['manage-layers','save']
					},
					customImageAjaxSettings: {
						url: '<?php echo BASE_URL;?>ajax/customimghandler',
						method: 'POST',
						dataType: 'json',
						data: {
									saveOnServer: 1, //use integer as boolean value. 0=false, 1=true
									uploadsDir: 'uploads/customtoolsimg', 
									uploadsDirURL: '<?php echo BASE_URL;?>uploads/customtoolsimg' 
								}
					}
	    		},
				

	    	//yourDesigner = new FancyProductDesigner($yourDesigner, pluginOpts);

	    	//print button
			$('#print-button').click(function(){
				yourDesigner.print();
				return false;
			});


			//create an image
			$('#image-button').click(function(){
				var image = yourDesigner.createImage();
				return false;
			});

			//checkout button with getProduct()
			$('#checkout-button').click(function(){
				var product = yourDesigner.getProduct();
				console.log(product);
				return false;
			});

			//event handler when the price is changing
			$yourDesigner.on('priceChange', function(evt, price, currentPrice) {
				$('#thsirt-price').text(currentPrice);
			});

			//save image on webserver
			$('#save-image-php').click(function() {
				
				yourDesigner.getProductDataURL(function(dataURL) {
					$.post( "<?php echo BASE_URL;?>static/customsizetool/php/save_image.php", { base64_image: dataURL} );
				});

			});

			//send image via mail
			$('#send-image-mail-php').click(function() {
				
				yourDesigner.getProductDataURL(function(dataURL) {
					$.post( "<?php echo BASE_URL;?>static/customsizetool/php/send_image_via_mail.php", { base64_image: dataURL} );
				});

			});

	    });

function clearcustomimg()
{
	$.ajax({
				url        : '<?php echo BASE_URL; ?>ajax/clearcustomimg',			
				method     : 'POST',
				dataType   : 'text',   
						
				success: function(response){
				},
			});


}	
		
function addtocart_customimg(proid,wishproid='',wishlist='')
{               
	            var minqty = $("#prices1").val();	
				var json1={};				
				yourDesigner.getProductDataURL(function(dataURL) {
			
                var urll = '<?php echo BASE_URL; ?>ajax/addtocart_insert'
				var serializeData = serializeFormJSON($("#frmcustomattr").serializeArray());
				 json1={proid:proid,minqty:minqty,Iscustomimg:1,customimg:dataURL,wishproid:wishproid,wishlist:wishlist};
				Object.assign(json1, serializeData);
				$.ajax({
				url        : urll,
				contentType: "application/json",
				 
				method     : 'POST',
				dataType   : 'json',   
				data       : JSON.stringify(json1),//Object.assign(JSON.stringify({proid:proid,minqty:minqty,Iscustomimg:1,customimg:dataURL,wishproid:wishproid,wishlist:wishlist}),serializeData),
				//data       : 'proid='+proid+'&minqty='+minqty+'&Iscustomimg=1&customimg='+dataURL+'&wishproid='+wishproid+'&wishlist='+wishlist+"&"+$("#frmcustomattr").serialize(),
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					
					 // alert(response.rslt);
					if(response.rslt == "1"){
						$("#carcnt").html(response.cartcount);
						var sucmsg = "Product add to cart Successfully";
						listcartcount();
						
						closeiframe();
						
						//swal("Success!",sucmsg, "success");
						
						swal({
						title: "Success!",
						text: sucmsg,
						type: "success",
						confirmButtonText: "OK"
						},
						function(isConfirm){
							if (isConfirm) {
								location.reload();
							}
					    });
							
					}
					else if(response.rslt == "2"){
						var upmsg="   Product already exits";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					
					if(response.wishlist == "wishlistdelete"){
						Movewishlistpage(); 
					}


				},

			});
		});
}

 serializeFormJSON = function (data) {

        var o = {};
        var a = data;
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

		
		
    </script>

<script type="text/javascript">
	function prodattrchange(aid,sku,did)
	{
		
		var path =  '<?php echo BASE_URL; ?>ajax/prodattrchange'
		var tsku='';
		if(sku=='')
			 tsku='<?php echo $sku;?>'
		else
			 tsku=sku;
		 var data="";
	 if(did!='')	 
	 {	
		if($("#color_"+did).length){
			$("#color_"+did). prop("checked", "checked");
		 } 
		
		
	 }
	 data="proid=<?php echo $productdetails['product_url']; ?>&sku="+tsku+"&"+$("#frmcustomattr").serialize();
	 //console.log(path);
	 // location.href=path;
	 
	 $.ajax({
				url        : path,
				contentType: "application/json",
				method     : 'POST',
				dataType   : 'json',   
				data       : JSON.stringify(data),
				beforeSend: function() {
					
				},
				success: function(response){
				
				$("#detailspricewraper").html("");	
				$("#detailspricewraper").html(response.rslt);
				
				if ($('.singleprd-slider').hasClass('slick-initialized')) {
					$('.singleprd-slider').slick('destroy');
				}
				if ($('.thumbnailprd-slider').hasClass('slick-initialized')) {
					$('.thumbnailprd-slider').slick('destroy');
				}
				

				$("#productimage").html("");
				$("#productimage").html(response.changeimg);
				
				if ($(window).width() > 767){
						$('.imgBox').imgZoom({
						boxWidth: 400,
						boxHeight: 400,
						marginLeft: 15,
						});
					}
				
				$(".singleprd-slider").slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				asNavFor: '.thumbnailprd-slider'
			});

			$(".thumbnailprd-slider").slick({
				slidesToShow: 4,
				infinite: false,
				arrows: true,
				autoplay: false,
				vertical: false,
				verticalSwiping: true,
				autoplaySpeed: 4000,
				slidesToScroll: 1,
				asNavFor: '.singleprd-slider',
				focusOnSelect: true,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 6,
							slidesToScroll: 1,


						}
					},
					{
						breakpoint: 767,
						settings: {
							
							slidesToShow: 4,
							vertical: false,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							
							slidesToShow: 3,
							vertical: false,
							slidesToScroll: 1
						}
					}
				]
			});
								
				
				
				},

			});
	 
	}
	
	function prodattrchange1(aid,sku,did)
	{
		
	
			var path =  '<?php echo BASE_URL; ?>ajax/prodattrchange'
		var tsku='';
		if(sku=='')
			 tsku='<?php echo $sku;?>'
		else
			 tsku=sku;
		 var data="";
	 if(did!='')	 
	 {	
		if($("#color_"+did).length){
			$("#color_"+did). prop("checked", "checked");
		 } 
		
		
	 }
	 data="proid=<?php echo $productdetails['product_url']; ?>&sku="+tsku+"&"+$("#frmcustomattr1").serialize();
	 //console.log(path);
	 // location.href=path;
	 
	 $.ajax({
				url        : path,
				contentType: "application/json",
				method     : 'POST',
				dataType   : 'json',   
				data       : JSON.stringify(data),
				beforeSend: function() {
					
				},
				success: function(response){
				$("#customdetailsprice").html("");	
				$("#customdetailsprice").html(response.rslt);
				},

			});
	}
	/*
	function checkminqty(){
		input = $('input[type="number"]');
		var min = input.attr('min');
		var max = input.attr('max');
		
		var oldValue = parseFloat(input.val());
		if (oldValue <= min || isNaN(oldValue) || oldValue=="") {
			swal('The Minimum Order Quantity for this product is:'+' '+min);
			$('input[type="number"]').val(min);
		} 
		
	}
	
	function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;
	if (event.keyCode == 8 || event.keyCode == 46
	 || event.keyCode == 37 || event.keyCode == 39) {
		return true;
	}
	else if ( key < 48 || key > 57 ) {
		return false;
	}
	else return true;
	};
	*/
		$('.quantity').each(function () {
			var spinner = $(this),
				input = spinner.find('input[type="number"]'),
				btnUp = spinner.find('.quantity-up'),
				btnDown = spinner.find('.quantity-down'),
				min = input.attr('min'),
				max = input.attr('max'),
				step = parseFloat(input.attr('step'));
			//	console.log(step);

			btnUp.click(function () {
				//console.log(step);
				var oldValue = parseFloat(input.val());
				if (oldValue >= max) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue + step;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("change");
			});

			btnDown.click(function () {
		
				//	console.log(step);
				var oldValue = parseFloat(input.val());
				if (oldValue <= min) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue - step;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("change");
			});

		});
		
		
		if ($(window).width() > 767){
		$('.imgBox').imgZoom({
		boxWidth: 400,
		boxHeight: 400,
		marginLeft: 15,
		});
	}

	
	
	
	/*produtdeatil slider*/
			$(".singleprd-slider").slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				asNavFor: '.thumbnailprd-slider'
			});

			$(".thumbnailprd-slider").slick({
				slidesToShow: 4,
				infinite: false,
				arrows: true,
				autoplay: false,
				vertical: false,
				verticalSwiping: true,
				autoplaySpeed: 4000,
				slidesToScroll: 1,
				asNavFor: '.singleprd-slider',
				focusOnSelect: true,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 6,
							slidesToScroll: 1,


						}
					},
					{
						breakpoint: 767,
						settings: {
							
							slidesToShow: 4,
							vertical: false,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							
							slidesToShow: 3,
							vertical: false,
							slidesToScroll: 1
						}
					}
				]
			});
			/**/
			
			


	
		$(".color-single").click(function(){
			$(".color-single").removeClass("active");
			$(this).addClass("active");
		});
		
		
		$(".customize-product").click(function(){
			
			
		});

		
		
			 $('.branding-options').select2({
			   containerCssClass: "header-country-container",
			   dropdownCssClass: "header-dropdown-container"
			   
		   });

		

    function closeiframe() {
        document.getElementById("popwidg").style.display = "none"
		$("body").removeClass("modal-open");
		$(".fpd-container").removeClass("fpd-active");
		$(".fpd-navigation>div").removeClass("fpd-active");

    }

    function openiframe() {
        document.getElementById("popwidg").style.display = "block";
		$("body").addClass("modal-open");
		
		
		
		

		
    }
$(function(){

<?php if(isset($_REQUEST['customized'])) { ?>	
	openiframe();
<?php } ?>	
});


$('.products').fancybox({
	// Options will go here
});



$(".popwrapbox-inner").mCustomScrollbar({
	theme:"dark"
});

function fnchkCodeAvailable()
{
	
 	$('#divcheckavail').parsley().validate();
	
		
		if ($('#divcheckavail').parsley().isValid()){	
	
	var pcode=$("#shippincode").val();
	 $.ajax({
				url        :'<?php echo BASE_URL;?>ajax/chkzipcode',				
				method     : 'POST',
				dataType   : 'text',   
				data       :"pin="+pcode,
				beforeSend: function() {
					
				},
				success: function(response){					
					if(response==1)
					{
					  $("#chkavallerror").css("display","none");
					  $("#chkavallsucess").css("display","block");
					  $("#btnaddtocart").removeClass("disabled");
					}else{
					  $("#chkavallerror").css("display","block");
					  $("#chkavallsucess").css("display","none");						
					  $("#btnaddtocart").addClass("disabled");
					}
				}
				,

			});
		}	
	
}


</script>


  </body>
</html>
