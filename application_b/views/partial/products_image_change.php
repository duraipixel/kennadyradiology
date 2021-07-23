<div class="simpleLens-gallery-container pt-5" id="product-gallery">
       

          <div class="simpleLens-container">
            <div class="simpleLens-big-image-container">
              <?php 
							/*echo "ggg";
							echo "<pre>";
							print_r($productdetails); die(); */
							if($productdetails['img_names']!=''){
							$pro_img = explode('|',$productdetails['img_names']);
                            // foreach($pro_img as $list_img){
						     ?>
              <a href="#"  class="simpleLens-lens-image" 
                           data-lens-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $pro_img[0]; ?>"
                           data-big-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $pro_img[0]; ?>"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>" class="simpleLens-big-image" alt="product"> </a>
              <?php // }
			   } else { ?>
              <a data-lens-image="<?php echo BASE_URL;?>uploads/noimage/photos/noimage.png" class="simpleLens-lens-image"> <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="simpleLens-big-image"> </a>
              <?php } ?>
            </div>
            <!-- data-toggle="modal" data-target="#CustomizeModal"-->
        <?php    if($productdetails['iscustomized'] == 1){?><!--<a  href="javascript:openiframe()"  class="common-btn" >Customize this product</a> -->
        <?php }?>
        </div>
          <div class="simpleLens-thumbnails-container pt-5 mt-5">
            <?php 
						$customimage='';
						if($productdetails['uploadecustomizedimg']!=''){
							 $customimage= BASE_URL.'uploads/customizedproduct/thumbnails/'.$productdetails['uploadecustomizedimg']; 
							
						}							
						if($productdetails['img_names']!=''){
						  $pro_img1 = explode('|',$productdetails['img_names']);
                           foreach($pro_img1 as $list_img1){
							if($customimage=="")   
							 $customimage= BASE_URL."uploads/productassest/".$productdetails['product_id']."/photos/base/".$list_img1;
						   	 
						?>
            <a href="#" class="simpleLens-thumbnail-wrapper"
                           data-lens-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img1; ?>"
                           data-big-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img1; ?>"> 
                           <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/thumb/<?php echo $list_img1; ?>"> </a>
            <?php } } else {  ?>
            <img class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/noimage/photos/thumb/noimage.png" alt="product">
            <?php } ?>
          </div>
        </div>
         