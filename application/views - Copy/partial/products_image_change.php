 <ul id="glasscase" class="gc-start">
		   
		 <?php 
							// echo "ggg";
						 //echo "<pre>";
							// print_r($productdetails);
							//print_r($productdetails['img_names']); die(); 
							if($productdetails['img_names']!=''){
							$pro_img = explode('|',$productdetails['img_names']);
                            // foreach($pro_img as $list_img){
						     ?>
							 
			
                    <li><img src="<?php echo img_base;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>" alt="Text" data-gc-caption="Product Caption 1" /></li>
                    
               
							<?php }else{?>
							<li><img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png" alt="Text" data-gc-caption="Product Caption 1" /></li>
							<?php }?>
							
							 </ul>