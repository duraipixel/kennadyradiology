
          <!-- The slideshow -->
          <div class="carousel-inner">
            <?php    $pro_img = explode('|',$productdetails['img_names']);?>
            <div class="carousel-item active"> <img src="<?php echo img_base;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>" id="ProductImage1" alt="" /> </div>
            <?php $pro_img1 = explode('|',$productdetails['img_names']);
                           for($i=1;$i<=count($pro_img1);$i++){
							   if($pro_img1[$i] != ''){
							   ?>
            <div class="carousel-item"> <img src="<?php echo img_base;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img1[$i]; ?>" alt="" id="ProductImage2" /> </div>
            <?php }
						   }
						   ?>
          </div>
          <!-- Left and right controls --> 
          <a class="carousel-control-prev" href="#ProductCarousel" data-slide="prev"> <i class="lni lni-arrow-left"></i> </a> <a class="carousel-control-next" href="#ProductCarousel" data-slide="next"> <i class="lni lni-arrow-right"></i> </a>