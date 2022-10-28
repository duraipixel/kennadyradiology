<form id="frmcustomattr">
	<?php 
	// echo 'durai';die;
	$checked_product_type_id 		= $productdetails->product_type ?? '';
	$checked_size_id 				= $productdetails->size ?? '';
	$checked_leadeq_id 				= $productdetails->leadequivalnce ?? '';
	$checked_material_id 			= $productdetails->materialid ?? '';
	$defaultColorId 				= $productdetails->defaultColorId ?? '';
	$product_type 					= $repository->getProductTypeAttributes($product_id);
	$sizes 							= $repository->getSizeAttributes($product_id, $checked_product_type_id );
	$lead_eq 						= $repository->getLeadEquanceAttributes($product_id, $checked_product_type_id, $checked_size_id );
	$material  						= $repository->getCoreMaterialAttributes($product_id, $checked_product_type_id, $checked_size_id, $checked_leadeq_id );
	$color_attributes 				= $repository->getColorAttributes($product_id, $checked_product_type_id, $checked_size_id, $checked_leadeq_id, $checked_material_id  );
	$fabric 						= $repository->getFabricAttributes($product_id, $checked_product_type_id, $checked_size_id, $checked_leadeq_id, $checked_material_id );

	if( isset( $product_type ) && !empty( $product_type ) ) {
	?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
            <h6>
                Product Type </h6>
            <div class="divider2"></div>
			<?php 
			foreach ($product_type as $items) {
				$checked = '';
				if( isset( $attributeArray[$items->attribute_id]) && $attributeArray[$items->attribute_id]['id'] == $items->product_type ) {
					// $checked_product_type_id 		= $items->product_type;
					$checked = 'checked';
				}
			?>
			 <div class="d-flex flex-wrap align-items-start">
                <div class="chiller_cb Product Type-single   ">
                    <input type="radio" id="Product Type_<?= $items->product_type ?>" name="iconatt_<?= $items->attribute_id?>" <?= $checked ?>
                        onclick="prodattrchange('<?= $items->attribute_id?>','<?= $product_id ?>', '<?= $items->product_type ?>', 'Product Type' );" value="<?= $items->product_type ?>">
                    <label for="Product Type_<?= $items->product_type ?>" class="color-label">
						<?= $items->product_type_name ?? '' ?>
                    </label>
                    <span></span>
                </div>
            </div>
			<?php 
			}
			?>
        </div>
    </div>
	<?php 
	} 

	if( isset( $color_attributes ) && !empty( $color_attributes ) ) {
			
		$colorid = $color_attributes->colorid;
		$color_ids = explode(",", $colorid);
		
		$colorDetails = $repository->getColorImages($color_ids);
			
	?>
	<div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
            <h6>
                Color </h6>
            <div class="divider2"></div>
            <div class="d-flex flex-wrap align-items-start">
				<?php 
				if( isset( $colorDetails ) && !empty( $colorDetails ) ) {
					foreach ($colorDetails as $colo ) {

						$checked = '';
						if( isset( $attributeArray[$colo->attributeId]) && $attributeArray[$colo->attributeId]['id'] == $colo->dropdown_id ) {
							$color_id 		= $colo->dropdown_id;
							$checked = 'checked';
						}
						?>
					 <div class="chiller_cb Color-single  homecheck ">
						<input type="radio" id="Color_<?= $colo->dropdown_id ?>"
						<?= $checked ?>
						 name="iconatt_<?= $colo->attributeId ?>"
							onclick="prodattrchange('<?= $colo->attributeId ?>','<?= $product_id ?>', '<?= $colo->dropdown_id ?>', 'Color' );" 
							value="<?= $colo->dropdown_id ?>">
						<label for="Color_<?= $colo->dropdown_id ?>" class="color-label">
							<img src="<?= img_base.'uploads/attributes/'.$colo->dropdown_images ?>"
								class="color-img img-responsive" alt="">
						</label>
						<span></span>
					</div>
				<?php
					}
				}
				?>
            </div>
        </div>
    </div> 
	<?php 
	}

	if( isset( $sizes ) && !empty( $sizes ) ) {
	?>
	<!-- image div ends -->
   	<div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
            <h6>
                Size </h6>
            <div class="divider2"></div>
            <div class="d-flex flex-wrap align-items-start">
			<?php 
			foreach ($sizes as $item ) {
				$checked = '';
				
				if( isset( $attributeArray[$item->attribute_id]) && $attributeArray[$item->attribute_id]['id'] == $item->dropdown_id ) {
					$checked_size_id = $item->dropdown_id;
					$checked = 'checked';
				}
			?>
                <div class="chiller_cb Size-single">
                    <input type="radio" <?= $checked ?> 
					id="Size_<?= $item->dropdown_id ?? '' ?>" 
					name="iconatt_<?= $item->attribute_id ?? '' ?>"
                        onclick="prodattrchange('<?= $item->attribute_id ?? '' ?>', '<?= $product_id ?>', '<?= $item->dropdown_id ?? '' ?>', 'Size' );" value="<?= $item->dropdown_id ?? '' ?>">
                    <label for="Size_<?= $item->dropdown_id ?? '' ?>" class="color-label">
                        <?= $item->size_name ?? '' ?> </label>
                    <span></span>
                </div>
			<?php 
			}
			?>
            </div>
        </div>
    </div>
	
	<?php }  ?>
	<?php  
		if( $productsizechart['attribute_value'] != '' ) {?>
		<p><a href="javascript:void(0)" data-toggle="modal"
			data-target="#sizeChartModal"><strong class="text-orange"><i class="flaticon-resize"></i>
				Size Chart</strong></a></p>
	<?php  }
	?>
	<?php 
	if( isset( $lead_eq ) && !empty( $lead_eq ) ) {
	?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
            <h6>
                Lead Equivalnce </h6>
            <div class="divider2"></div>
            <div class="d-flex flex-wrap align-items-start">
				<?php 
				foreach ($lead_eq as $item) {
					$checked = '';
					
					if( isset( $attributeArray[$item->attribute_id]) && $attributeArray[$item->attribute_id]['id'] == $item->dropdown_id ) {
						$checked_leadeq_id 				= $item->dropdown_id;
						$checked = 'checked';
					}
				?>
                <div class="chiller_cb Lead Equivalnce-single">
                    <input type="radio" <?= $checked ?> id="Lead Equivalnce_<?= $item->dropdown_id ?>" name="iconatt_<?= $item->attribute_id ?>"
                        onclick="prodattrchange('<?= $item->attribute_id ?>','<?= $product_id ?>', '<?= $item->dropdown_id ?>', 'Lead Equivalnce' );" value="<?= $item->dropdown_id ?>">
                    <label for="Lead Equivalnce_<?= $item->dropdown_id ?>" class="color-label">
						<?= $item-> lead_equalance_name ?>
                	</label>
                    <span></span>
                </div>
				<?php 
				}
				?>
            </div>
        </div>
    </div>
	<?php 
	}

	if( isset( $material ) && !empty( $material ) ) {
	?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
            <h6> Core Material </h6>
            <div class="divider2"></div>
            <div class="d-flex flex-wrap align-items-start">
				<?php 
				foreach ($material as $item ) {
					$checked 					= '';
					if( isset( $attributeArray[$item->attribute_id]) && $attributeArray[$item->attribute_id]['id'] == $item->dropdown_id ) {
						$checked_material_id 	= $item->dropdown_id;
						$checked 				= 'checked';
					}
				?>
                <div class="chiller_cb Core Material-single ">
                    <input type="radio" id="Core Material_<?= $item->dropdown_id ?>" 
					name="iconatt_<?= $item->attribute_id ?>"
					<?= $checked ?>
					onclick="prodattrchange('<?= $item->attribute_id ?>','<?= $product_id ?>', '<?= $item->dropdown_id ?>', 'Core Material' );" 
					value="<?= $item->dropdown_id ?>">
                    <label for="Core Material_<?= $item->dropdown_id ?>" class="color-label">
						<?= $item->lead_name ?>
                    </label>
                    <span></span>
                </div>
				<?php } ?>
            </div>
        </div>
    </div>
	<?php }

	if( isset( $fabric ) && !empty( $fabric ) ) {
	 ?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 pad-bot-20">
            <h6>
                Fabric </h6>
            <div class="divider2"></div>
            <div class="d-flex flex-wrap align-items-start">
				<?php 
				foreach ($fabric as $key => $value) {
				
				?>
                <div class="chiller_cb Fabric-single   ">
                    <input type="radio" checked="" id="Fabric_<?= $value->dropdown_id ?>" name="iconatt_<?= $value->attribute_id ?>"
                        onclick="prodattrchange('<?= $value->attribute_id ?>','<?= $product_id ?>', '<?= $value->dropdown_id ?>', 'Fabric' );" value="<?= $value->dropdown_id ?>">
                    <label for="Fabric_<?= $value->dropdown_id ?>" class="color-label">
						<?= $value->fab_name ?>
                    </label>
                    <span></span>
                </div>
				<?php 
					}
				?>
            </div>
        </div>
    </div>
	<?php 
	}
	?>

    
</form>