 <ul id="glasscase" class="gc-start">
<?php 
if( isset( $productImages ) && !empty( $productImages ) ) {
	foreach ($productImages as $key => $value) {
		?>
		<li>
			<img src="<?php echo img_base;?>uploads/productassest/<?php echo $value->product_id; ?>/photos/base/<?php echo $value->img_path; ?>" alt="Text" data-gc-caption="Product Caption 1" />
		</li>
<?php	
	}
} else {
	?>
	<li>
		<img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png" alt="Text" data-gc-caption="Product Caption 1" />
	</li>
<?php }
?>
	
</ul>