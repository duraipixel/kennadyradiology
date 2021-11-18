<?php  
if(count($categorys)>0){ 
$isdata= 0;
foreach($categorys as $cat) {
			$getproducts = $helper->searchkeyArrays($cat['categoryID'],$products['prod_list'],'categoryID');
			if(count($getproducts) > 0){
				$isdata = 1;
				?>

<section class="products">
  <div class="container">
    <div class="product-tile">
      <h2 class="main-title-light">Products</h2>
      <?php  break;}
}?>
    </div>
<?php

	if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
	
	
?>

<div class="product-wrap">
<?php if($isdata == 1){?>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
   		 <?php  
		$k = 0;foreach($categorys as $cat) {
			$getproducts = $helper->searchkeyArrays($cat['categoryID'],$products['prod_list'],'categoryID');
			if(count($getproducts) > 0){
			?>
    <li class="nav-item"> <a class="nav-link <?php echo ($k == 0) ? 'active' : '';?>" id="tab-<?php echo $cat['categoryID'];?>" data-toggle="tab" href="#hreftab-<?php echo $cat['categoryID'];?>" role="tab" aria-controls="power" aria-selected="true"><?php echo $cat['categoryName'];?></a> </li>
    <?php $k++;}
		}?>
  </ul>
  <?php }?>
  <div class="tab-content" id="myTabContent">
    <?php   
		$k1 = 0;foreach($categorys as $cat) {
			$getproducts = $helper->searchkeyArrays($cat['categoryID'],$products['prod_list'],'categoryID');
			 
			?>
    <div class="tab-pane fade <?php echo ($k1 == 0) ? 'show active' : '';?>" id="hreftab-<?php echo $cat['categoryID'];?>" role="tabpanel" aria-labelledby="tab-<?php echo $cat['categoryID'];?>"> 
     
      <div class="your-class">
        <?php foreach($getproducts as $productlist){
 				$arrpath=array();
				//print_r($p);
				 $helper->getProductPath($productlist['categoryID'],$arrpath);
				
		  $imgs=explode("|",$productlist['img_names']);
			   ?>
        <div>
          <?php if($imgs[0] != ''){?>
          <a href="<?php echo $helper->pathrevise($arrpath).'/'.$productlist['product_url']; ?>" > <img src="<?php echo img_base;?>uploads/productassest/<?php echo $productlist['product_id']; ?>/photos/base/<?php echo $imgs[0]; ?>" alt=""></a>
          <?php }else{?>
          <a href="<?php echo $helper->pathrevise($arrpath).'/'.$productlist['product_url']; ?>" > <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /></a>
          <?php }?>
          <input id="prices1_<?php echo $productlist['product_id'];?>" name="prices1_<?php echo $productlist['product_id'];?>" type="hidden" class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched" placeholder="1" maxlength="5" value="1" style="">
          <div class="prod-content"> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$productlist['product_url']; ?>" >
            <h4><?php echo $productlist['product_name']; ?></h4>
            </a>
            <h6>
              <?php if($productlist['final_price']>0): ?>
              <?php if($productlist['totpent']>0): ?>
             <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($productlist['final_orgprice']),2); ?></span>  <span class="offerprice"><i class="fa fa-inr"></i> <?php echo  number_format(round($productlist['final_price_tax']),2); ?></span>
              <?php ELSE : ?>
              <span class="offerprice"><i class="fa fa-inr"></i> <?php echo number_format(round($productlist['final_orgprice']),2);  ?></span>
              <?php ENDIF; ?>
              <?php ELSE : ?>
              <span class="offerprice">Price on Request</span>
              <?php ENDIF; ?>
            </h6>
            <a  onclick="buynow('<?php echo $productlist['product_id'];?>');" href="javascript:void(0)" class="transparent-btn"> Buy Now</a> </div>
        </div>
        <?php }?>
      </div>
    </div>
    <?php $k1++; }?>
  </div>
</div>
</div></section>
<?php }?>
