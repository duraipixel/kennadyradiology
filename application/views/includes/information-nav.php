<div class="col-sm-12 col-md-4 col-lg-3 d-none d-sm-block">
	<ul class="my-account">
		<!--<li>
			<a class="<?php if ($menu_disp == 'about_us'){ echo " active ";}?>"  href="<?php echo BASE_URL;?>about-us">
				<i class="flaticon-users"></i> About Us
			</a>
		</li>
		-->
		<li>
			<a class="<?php if ($menu_disp == 'shipping_information'){ echo " active ";}?>"  href="<?php echo BASE_URL;?>shipping-information">
				<i class="flaticon-logistics"></i> <?php echo $footdisplaylanguage['shippinginformation'];?>
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'return_policy'){ echo " active ";}?>" href="<?php echo BASE_URL;?>return-policy">
				<i class="flaticon-shuffle-2"></i> <?php echo $footdisplaylanguage['returnpolicy'];?>
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'terms_conditions'){ echo " active ";}?>" href="<?php echo BASE_URL;?>terms-conditions">
				<i class="flaticon-danger-3"></i> <?php echo $footdisplaylanguage['termscondition'];?>
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'privacy_policy'){ echo " active ";}?>" href="<?php echo BASE_URL;?>privacy-policy">
				<i class="flaticon-lock-3"></i> <?php echo $footdisplaylanguage['privacypolicy'];?>
			</a>
		</li>
	</ul>
</div>