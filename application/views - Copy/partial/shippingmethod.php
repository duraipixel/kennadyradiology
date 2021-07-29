 <div class="row">
                        <?php 

						if(count($shippingmethod)>0){
						
						foreach($shippingmethod as $value){ 
	   $chk =''; 
		if($_SESSION['shippingid']==$value['shippingId']){
			 
			$chk='checked';
		}
		
	  ?>
                        <div class="shippingmethod-single"> <span>
                          <input type="radio" id="shippingmethod_<?php echo $value['shippingId'];?>" name="shippingmethod" value="<?php echo $value['shippingCode']; ?>" onChange="shippingcharge('<?php echo $value['shippingId'];?>');" <?php echo $chk; ?>>
                          <label for="shippingmethod_<?php echo $value['shippingId'];?>">
                          <div class="shipping-icon"> <img src="<?php echo img_base;?>uploads/shippingimage/<?php echo $value['shippingimage']; ?>" class="img-responsive" alt="shippingmethod"></div>
                          <div class="shipping-caption"><small> <?php echo $value['shippingName']; ?></small></div>
                          </label>
                          </span> </div>
                        <?php }
					} else {
					?>
			<div> No Shipping available in your location </div>		
					
			<?php } ?>
						
                      </div>