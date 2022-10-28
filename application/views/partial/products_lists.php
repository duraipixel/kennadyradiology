<?php 	
// print_r( $productlists );die;
?>

<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?php if( count($productlists) > 0){ ?>
            <p class="filter-showing"><?php echo $catname;?> ( Showing 1 -
                <?php echo count($productlists);?> Products
                <?php echo $productscount;?>)</p>
            <?php }?>
        </div>
        <div class="col-sm-12 col-md-6">
            <p class="text-right">
				<?php 
				 if( isset( $_SESSION['product_filter'] ) && !empty( $_SESSION['product_filter'] )  ) {
				?>
                <a href="#" onclick="return ClearProductFilters();" class="clear-filter"><i class="flaticon-cancel-12"></i>
                    Clear Filters</a>
				
				<?php } ?>
            </p>
        </div>

        <div id="divproductlists">
            <div class="row prolistviewcontainer">
				<?php 
				if( isset( $productlists ) && !empty( $productlists ) ) {
					
					foreach ($productlists as $items ) {
						$product_link = BASE_URL.'products/'.$items->categoryCode.'/'.$items->product_url;
				?>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 prd-singles">
                    <div class="product-listing-div">
                        <a onclick="return recentview('<?= $items->product_id ?>')"
                            href="<?= $product_link ?>"
                            class="featured-products-items has-border">
                            <div class="featured-products-image">
                                <!-- <img src="https://pixel-studios.net/kennedy_radiology/uploads/productassest/<?= $items->product_id ?>/photos/base/<?= $items->product_id ?>_0_1659613739.jpg" -->
                                <img src="<?= img_base ?>uploads/productassest/<?= $items->product_id ?>/photos/<?= $items->img_path ?>"
                                    class="img-fluid" title="<?= $items->product_name ?>" alt="<?= $items->product_name ?>">
                            </div>
                            <input id="prices1_<?= $items->product_id ?>" name="prices1_<?= $items->product_id ?>" type="hidden"
                                class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched"
                                placeholder="1" maxlength="5" value="1" >
                            <span class="featured-products-name"><?= $items->product_name ?></span>
							
                            <span class="featured-products-price">
                                <strong>
                                    $<?= $items->productprice ?>
                                </strong>
							</span>
                        </a>
                        <button type="button" onclick="window.location.href='<?= $product_link ?>'" class="common-btn add-to-cart-btn"> 
							<i class="fa fa-eye"></i> 
						</button>
                        <!-- <button type="button"  onclick="addtocart('<?= $items->product_id ?>');" data-mdb-toggle="tooltip" title="" class="add-to-cart-btn">
								<i class="flaticon-cart-bag"></i>
							</button> --> 
                    </div>
                </div>
				<?php 
					}
				} else {
					?>
					<div>No Products Found.</div>
				<?php }
				?>
				<div class="productpagenation">
					<ul>
						<?php 
						$productscount = count($productlists);
							if(!empty($productscount)){
								$totpage=ceil($productscount / globalConfig('productsPerpage'));
							}		
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
</div>


<script src="<?php echo img_base; ?>static/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo img_base; ?>static/js/jquery-ias.min.js"></script>
<script>
var ias;
</script>
<script type="text/javascript">
$(document).ready(function() {
	ias = jQuery.ias({
		container: '.prolistviewcontainer',
		item: '.prd-singles',
		pagination: '.productpagenation',
		next: '.next-posts a',
		loader: 'Loadmore...',
	});

	ias.extension(new IASSpinnerExtension());
	ias.extension(new IASTriggerExtension({
		offset: 125
	}));
	// ias.extension(new IASNoneLeftExtension({text: 'Loading... '}));	
});

 function ClearProductFilters() {
	$.ajax({
		url: '<?php echo BASE_URL; ?>products/clearProductFilter',
		type:'POST',
		success: function(res){
			window.location.href="<?php echo BASE_URL; ?>products";
		}

	});
 }
</script>