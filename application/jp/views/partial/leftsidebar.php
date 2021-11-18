 <aside class="col-lg-3 col-md-4 col-sm-5 col-xs-12 nopad sss1">			   	
		   <div class="productlistaside accounttab">
		   		
							
								<div class="profile-image">
									<!--<img src="<?php echo BASE_URL;?>/static/images/portfolio-1.png" alt="" />-->
									<h3><?php echo $getmyaccountdetails[0]['customer_firstname'];?> <?php echo $getmyaccountdetails[0]['customer_lastname'];?></h3>
								</div>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			       
 
			            <div id="collapseOne" class="panel-collapse" role="tabpanel" aria-labelledby="headingOne">
			                <div class="panel-body">
			                     <ul class="panelbdyul">
			                     	<li><a href="<?php echo BASE_URL;?>my-account" class="<?php echo $getactmenu[0]=="my-account"?"active":'';?>"><i class="fa fa-user" aria-hidden="true"></i>My Profile</a></li>
									<li><a href="<?php echo BASE_URL;?>myorders" class="<?php echo $getactmenu[0]=="myorders"?"active":'';?>"><i class="fa fa-list-alt" aria-hidden="true"></i>My Orders</a></li>
			                     	<li><a href="<?php echo BASE_URL;?>manage-address" class="<?php echo $getactmenu[0]=="manage-address"?"active":'';?>"><i class="fa fa-map-marker" aria-hidden="true"></i>Manage Address</a></li>
									<li><a href="<?php echo BASE_URL;?>change-password" class="<?php echo $getactmenu[0]=="change-password"?"active":'';?>"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a></li>									
									<?php if($_SESSION['cus_group_id']==2) { ?>

									<?php } ?>
			                     </ul>
			            	</div>
			        </div> 
 
			</div>
		</aside>
		
		
		