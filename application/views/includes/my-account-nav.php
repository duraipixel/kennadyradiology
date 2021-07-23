<div class="col-sm-12 col-md-4 col-lg-3 d-none d-sm-block">
	<ul class="my-account">
		<li>
			<a class="<?php if ($menu_disp == 'my_account'){ echo " active ";}?>"  href="<?php echo BASE_URL;?>my-account">
				<i class="flaticon-user-11"></i> My Account
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'my_address'){ echo " active ";}?>" href="<?php echo BASE_URL;?>my-address">
				<i class="flaticon-location"></i> My Address
			</a>
		</li>
		<li>
			<a class="<?php if ($menu_disp == 'my_orders'){ echo " active ";}?>" href="<?php echo BASE_URL;?>my-orders">
				<i class="flaticon-menu-line-3"></i> My Orders
			</a>
		</li>
		<li>
			<a href="<?php echo BASE_URL;?>logout">
				<i class="flaticon-logout"></i> Logout
			</a>
		</li>
	</ul>
</div>