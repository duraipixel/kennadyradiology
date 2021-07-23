<?php if(count($products)>0){ ?>

<section class="commonthumb-wraper commontop-section <?php echo $addclass; ?>">
  <div class="container">
    <div class="col-md-12 col-sm-12 col-xs-12 nopad section-title text-center"> <?php echo $title; ?> </div>
    <div class="col-md-12 col-sm-12 col-xs-12 nopad commonthumb-slider">
      <?php
				
			if ( ($helper instanceof common_function) != true ) {
					
					$helper=$this->loadHelper('common_function');
				 	
				}
				
				//print_r($products); 
			
				 foreach($products as $p) {  
				//print_r($p); 
				// $arrdisvalue=$helper->calculateproductDiscountPrice($p['price'],$p['taxTyp'],$p['taxRate'],$p['specialprice'],$p['spl_fromdate'],$p['spl_todate'],$p['prod_DiscountType'],$p['prod_DiscountAmount'],$p['cat_DiscountType'],$p['cat_DiscountAmount'],$p['cust_DiscountType'],$p['cust_DiscountAmount'],$p['deals_DiscountType'],$p['deals_DiscountAmount']);
			
				$arrpath=array();
				//print_r($p);
				$helper->getProductPath($p['categoryID'],$arrpath);
					//print_r($arrpath);	 
			?>
      <div class="prd-single "> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" class="prdsingle-inner">
        <div class="prdimg-wraper carousel slide" data-ride="carousel" data-interval="1000">
          <button type="button" class="play"><span class="glyphicon glyphicon-play"></span></button>
          <button type="button" class="pause"><span class="glyphicon glyphicon-pause"></span></button>
          <?php if($p['img_names']!='') { ?>
          <div class="prdimginner-slider carousel-inner" role="listbox">
            <?php 
									$imgs=explode("|",	$p['img_names']);
									$ind=0;
								  foreach($imgs as $i ) {								  
								  ?>
            <div class="item <?php echo $ind==0? 'active' :''; ?> prdimginner"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $p['product_id']; ?>/photos/medium/<?php echo $i; ?>" class="img-responsive center-block prdimg img-responsive prd-im" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /> </div>
            <?php $ind++; } ?>
          </div>
          <?php }  else {  ?>
          <div class="item <?php echo $ind==0? 'active' :''; ?> prdimginner"> <img src="<?php echo BASE_URL;?>uploads/noimage/photos/medium/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /> </div>
          <?php  } ?>
          <?php if($p['totpent']>0): ?>
          <span class="offerspan"><?php echo $p['totpent']; ?>%</span>
          <?php ENDIF; ?>
          </a> </div>
        <div class="prdname-wraper">
          <div class="prd-cn">
            <h4><?php echo $p['product_name']; ?></h4>
            <div class="pricewraper">
              <?php if($p['dropdown_values']!=''): ?>
              <?php //echo $p['dropdown_values']." ".$p['dropdown_unit']." / " ; ?>
              <?php ENDIF; ?>
              <?php if($p['final_price']>0): ?>
              <?php if($p['totpent']>0): ?>
              <span class="offerprice"><i class="fa fa-inr"></i> <?php echo  $p['final_price']; ?></span> <span class="actualprice"><i class="fa fa-inr"></i><?php echo $p['final_orgprice']; ?></span>
              <?php ELSE : ?>
              <span class="offerprice"><i class="fa fa-inr"></i><?php echo $p['final_orgprice'];  ?></span>
              <?php ENDIF; ?>
              <?php ELSE : ?>
              <span class="offerprice">Price on Request</span>
              <?php ENDIF; ?>
            </div>
          </div>
        </div>
        <div class="prdtools-wraper">
          <ul class="prdtools">
            <li class="wishlist_<?php echo $p['product_id']; ?>">
              <?php if(!empty($p['wishlist_id']) && $p['wishlist_id']!="") { ?>
              <a href="javascript:void(0);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Wishlist" data-original-title="" title="" class="wishlist-icon commonicon"  > <img src="<?php echo BASE_URL;?>/static/images/icons/wishicon.png" class="img-responsive" alt=""> </a>
              <?php } else { ?>
              <a href="javascript:void(0);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Wishlist" data-original-title="" title="" class="wishlist-icon commonicon" onclick="addtowishlist('<?php echo $p['product_id'];?>',<?php echo $p['minquantity'];?>);" > <img src="<?php echo BASE_URL;?>/static/images/icons/wishlist-g.png" class="img-responsive" alt=""> </a>
              <?php } ?>
            </li>
            <?php if($_SESSSION['cus_group_id']==2) { ?>
            <li> <a href="javascript:void(0);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Catlog"> <img src="<?php echo BASE_URL;?>static/images/icons/file.png" class="img-responsive" alt="" /> </a> </li>
            <?php } ?>
            <li> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']."/?customized"; ?>" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Customize Product"> <img src="<?php echo BASE_URL;?>static/images/icons/edit.png" class="img-responsive" alt="" /> </a> </li>
          </ul>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="red-mre"> <a href="">Explore All</a> </div>
  </div>
</section>
<?php } ?>
