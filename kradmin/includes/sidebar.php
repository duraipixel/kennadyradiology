<?php include_once "navmenu-functions.php"; ?>
<?php $reslt_mnu = getTopMenuArray($db, $_SESSION['RoleId'],$admin_id);?>

<div class="sidebar-wrapper sidebar-theme">
  <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
  <div class="sidebar-wrapper sidebar-theme">
    <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
    <nav id="sidebar">
      <ul class="navbar-nav theme-brand flex-row  d-none d-lg-flex">
        <li class="nav-item d-flex"> <a href="dashboard.php" class="navbar-brand"> <img src="assets/img/logo-3.png" class="img-fluid" alt="logo"> </a> </li>
      </ul>
      <ul class="list-unstyled menu-categories" id="accordionExample">
        <li class="menu"> 
          <div class="btn btn-dark col-md-12"> <i class="flaticon-computer-6"></i> <span > &nbsp;<a class="text-warning" style="color:#ffffff" href="dashboard.php" >Dashboard Screen </a></span> </div>
          </li>
        <?php for($ii=0;$ii<count($reslt_mnu);$ii++) {
				if($reslt_mnu[$ii]['moduleicon'] != ''){$faicon = $reslt_mnu[$ii]['moduleicon'];}else{$faicon='icon-folder';}
				?>
        <li class="menu"> <a href="#mmenu<?php echo strtolower($reslt_mnu[$ii]['MenuId']); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <div class=""> <i class="<?php echo $faicon;?>"></i> <span><?php echo strtolower($reslt_mnu[$ii]['MenuName']); ?></span> </div>
          <div> <i class="flaticon-right-arrow"></i> </div>
          </a>
          <ul class="collapse submenu list-unstyled" id="mmenu<?php echo strtolower($reslt_mnu[$ii]['MenuId']); ?>" data-parent="#accordionExample">
            <?php	
							$mnuid = $reslt_mnu[$ii]['MenuId']; 
							$reslt_modm = getTopMenuModuleArray($db, $_SESSION['RoleId'],$admin_id,$mnuid);	
							$faicon= '';			
							for($nn=0;$nn<count($reslt_modm);$nn++)
							{
								$mdlnam = $reslt_modm[$nn]['ModuleName'];
								
								$mdlpath = $reslt_modm[$nn]['ModulePath'];	
 								$mdldispname = $reslt_modm[$nn]['Description'];  
						?>
            <li><a href="<?php echo $mdlpath; ?>"> <?php echo $mdlnam; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <?php			
				
			}
			?>
      </ul>
    </nav>
  </div>
</div>
