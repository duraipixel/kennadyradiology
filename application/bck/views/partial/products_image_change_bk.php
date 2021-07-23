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
										<img src="<?php echo BASE_URL?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $list_img; ?>" class="img-responsive center-block" data-origin="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>" lt="product"> 
																	
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
