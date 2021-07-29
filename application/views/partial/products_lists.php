<?php 	if(count($productlists)>0){	?>

  <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
		<div class="col-sm-12 col-md-6">
					 <?php if( count($productlists) > 0){?>  <p class="filter-showing"><?php echo $catname;?> ( <?php echo $productlistdisplaylanguage['showing'];?> 1 - <?php echo count($productlists);?> <?php echo $productlistdisplaylanguage['productof'];?> <?php echo $productscount;?>)</p>
     <?php }?>
				</div>
				
          <div id="divproductlists">
		  
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
			
        
  <div class="row prolistviewcontainer">
      <?php 
	  
	  foreach($productlists as $p) { 
		$productfilter=$product->productPricevariationFilter('',$catinfo['categoryID'],$p['product_url']);
		
		 $arrpath=array();
	     $helper->getProductPath($p['categoryID'],$arrpath);
	?>
	
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 prd-singles"  >
				<div class="product-listing-div">
                <a onclick="return recentview('<?php echo $p['product_id'];?>')" href="<?php  echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" class="featured-products-items has-border">
                    <div class="featured-products-image">
						
          <?php 
		  //echo "kk".$p['img_names'];
		  if($p['img_names']!='') {
			    $imgs=explode("|",	$p['img_names']);
				$ind=0;
				$im=0;
				
				if(count($imgs)>0) {
					//foreach($imgs as $i ) {?>
                     
					<img src="<?php echo img_base;?>uploads/productassest/<?php echo $p['product_id']; ?>/photos/medium/<?php echo $imgs[0]; ?>"  class="img-fluid" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" />
					 
                    
          
          <?php // $im++;}
		  }else{?>
           <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png"  class="img-fluid"title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /> 
          <?php }?>
          <?php } else {?>
  <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png"  class="img-fluid"title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /> 
          <?php }?> 
                    </div>
					
					
					  <?php
								  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
          <div class="productcolor-details innper" id="divcustomattr" style="display:none">
            <form class="frmcustomattr_<?php echo $p['product_id']; ?>" id="frmcustomattr_<?php echo $p['product_url']; ?>" >
            
              <?php 
						
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
							 
								 
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
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img  title="'.$f['dropdown_values'].'" src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
														 
														$strattrHTML.='<!-- <div class="row"> -->
																		<div class="col-md-12">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div> -->
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img  title="'.$f['dropdown_values'].'" src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-md-12">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div>-->
																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img  title="'.$f['dropdown_values'].'" src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
													 if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1){
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
														 
														$strattrHTML.=' <!-- <div class="row"> -->
																		<div class="col-md-6 nopad cstm-resw">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div> -->
																			<select class="select2 form-control required" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value,\''.$p['product_url'].'\');">
																			<!-- <option value="">None</option> -->
																			'; 
														$clssel='';
														if(in_array($f['dropdown_id'],$did)|| $f['isDefault'] == 1){
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
														 $strattrHTML.='<div class="col-md-12">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div>-->
																			<select class="select2 form-control" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value,\''.$p['product_url'].'\');">
																			<option value="">select..</option>
																			'; 
														 	
														 $clssel='';
														if(in_array($f['dropdown_id'],$did)|| $f['isDefault'] == 1){
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
									   $strattrHTML.='</div> ';
									   //</div>';
								  }
								  else
								  {
									   $strattrHTML.='</div>';
									   //</div>';
									  
								  }
								  echo $strattrHTML; 	
								?>
            </form>
          </div>
          <?php } ?>
          <input id="prices1_<?php echo $p['product_id'];?>" name="prices1_<?php echo $p['product_id'];?>" type="hidden" class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched" placeholder="1" maxlength="5" value="1" style="">
		  
		  
                 <span class="featured-products-name"><?php echo $p['product_name']; ?></span> 
				 <span class="featured-products-price">
				 <strong>
					
					
            <?php if($p['final_price']>0): ?>
            <?php if($p['totpent']>0): ?>
          <span class="price-strip"><s><?php echo PRICE_SYMBOL . number_format(round($p['final_orgprice']),2);  ?>&nbsp;&nbsp;</s></span> <?php echo PRICE_SYMBOL;?><?php echo  number_format(round($p['final_price_tax']),2); ?> 
            <?php ELSE : ?>
           <?php echo PRICE_SYMBOL . number_format(round($p['final_price_tax']),2);  ?>
            <?php ENDIF; ?>
            <?php ELSE : ?>
            --
            <?php ENDIF; ?>
        
		</strong></span> 
                    
                  </a>
				  <button type="button"  onclick="addtocart('<?php echo $p['product_id'];?>');" data-mdb-toggle="tooltip" title="<?php echo $commondisplaylanguage['sortby'];?>" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
					</div>
				</div>
				
				
				
		 
      <?php }?>
   
<div class="productpagenation">
  <ul>
    <?php 
			
			if(!empty($productscount)){
				$totpage=ceil($productscount / $helper->getStoreConfigvalue('productsPerpage'));
				
			}		
		//	$totpage=10;
		
				for($i=1;$i<=$totpage;$i++)
				{ 
			      $additionfilter='';
				  if(isset($searchkey) && $searchkey!='')
				  {
					  $additionfilter.='/'.$searchkey;
				  }
			?>
    <li <?php echo $page==($i-1)?'class="next-posts"':'' ?>  ><a href="<?php echo BASE_URL; ?>ajax/products/<?php echo $catid; ?>/<?php echo $i; ?><?php echo $additionfilter; ?>"><?php echo $i; ?></a></li>
    <?php		
				 }
				?>
  </ul>
</div>
 </div>
        </div>
      </div>
<?php } else { ?>
<section class="filter mt-3 pb-5">
  <div class="container">
  <div class="row">
	<div class="col">
		<div class="text-center alert alert-danger"><?php echo $commondisplaylanguage['noproduct'];?></</div>
	</div>
  </div>
   </div>
</section>
<?php } ?>


<script src="<?php echo img_base; ?>static/js/jquery.min.js"></script> 
<script src="<?php echo img_base; ?>static/js/jquery-ias.min.js"></script> 
<script>
	var ias;
</script>
<script type="text/javascript">
$(document).ready(function() {
	ias=jQuery.ias({
	    container : '.prolistviewcontainer',
	    item: '.prd-singles',
	    pagination: '.productpagenation',
	    next: '.next-posts a',
	    loader: 'Loadmore...',	   
	});
	
	ias.extension(new IASSpinnerExtension());
    ias.extension(new IASTriggerExtension({offset: 125}));
 // ias.extension(new IASNoneLeftExtension({text: 'Loading... '}));	
});
</script> 
