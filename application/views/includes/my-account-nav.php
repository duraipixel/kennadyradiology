<div class="col-sm-12 col-md-4 col-lg-3">
	<ul class="my-account">
		<li>
			<a class="<?php if ($menu_disp == 'my_account'){ echo " active ";}?>"  href="<?php echo BASE_URL;?>my-account">
				<i class="flaticon-user-11"></i> <?php echo $headdisplaylanguage['myaccount'];?>
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'my_address'){ echo " active ";}?>" href="<?php echo BASE_URL;?>my-address">
				<i class="flaticon-location"></i> <?php echo $headdisplaylanguage['myaddress'];?>
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'my_orders'){ echo " active ";}?>" href="<?php echo BASE_URL;?>my-orders">
				<i class="flaticon-menu-line-3"></i> <?php echo $headdisplaylanguage['myorder'];?>
			</a>
		</li>
		<li>
			<a href="<?php echo BASE_URL;?>logout">
				<i class="flaticon-logout"></i> <?php echo $headdisplaylanguage['logout'];?>
			</a>
		</li>
	</ul>
</div>