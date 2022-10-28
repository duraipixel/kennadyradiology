<form id="frmcustomattr">
	<?php 
	$fsku = $productdetails['sku'];
	if( isset( $productFilterDetails ) && !empty( $productFilterDetails ) ) {
		
		foreach ($productFilterDetails as $item) {
			
			?>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
					<h6>
						<?= $item->attributename ?>
					</h6>
					<div class="divider2"></div>
					<?php 
					$attributes = $repository->productPricevariationFilter($producturl, $item->attributeid );
					
					if( isset( $attributes ) && !empty( $attributes ) ) {
						?>
						<div class="d-flex flex-wrap align-items-start">
						<?php 
						foreach ($attributes as $att ) {
							$checked 			= '';
							
							if( isset( $checked_arr ) && array_key_exists($att->attributeid, $checked_arr) ) {
								if( $checked_arr[$att->attributeid] == $att->dropdown_id ) {$checked = 'checked';}
							}
						?>
							<div class="chiller_cb <?= $att->attributecode ?>-single  <?= isset( $att->dropdown_images ) && !empty( $att->dropdown_images ) ? 'homecheck' : '' ?> ">
								<input 
								type="radio" 
								<?= $checked ?>
								id="<?= $att->attributecode.'_'.$att->dropdown_id?>" 
								name="iconatt_<?= $att->attributeid ?>" 
								onclick="prodattrchange('<?= $att->attributeid ?>','<?= $fsku ?>', '<?= $att->dropdown_id ?>', '<?= $att->attributecode ?>' );"
								value="<?= $att->dropdown_id ?>"
								>
								<label for="<?= $att->attributecode.'_'.$att->dropdown_id?>" class="color-label">
									<?php 
									if( isset( $att->dropdown_images ) && !empty( $att->dropdown_images ) ) {
									?>
										<img src="<?= img_base.'uploads/attributes/'.$att->dropdown_images ?>" class="color-img img-responsive" alt="" />
									<?php 
									} else {
									?>
										<?= $att->dropdown_values ?>
									<?php 
									}
									?>
								</label>	
								<span></span>							  
							</div>
						<?php 
							}
						?>
					</div>
					<?php 
						}
					?>
				</div>
			</div>
	<?php 	
		}
	}
	?>
</form>