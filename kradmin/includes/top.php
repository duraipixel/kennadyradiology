<?php 

$homeres_ed = getUserinfo($db,$_SESSION['UserId']);
$pagename= basename($_SERVER['PHP_SELF']);
$current_page_title = DisplaypageName($db,$pagename); 

?>

<header class="tabMobileView header navbar fixed-top d-lg-none">
  <div class="nav-toggle"> <a href="javascript:void(0);" class="nav-link sidebarCollapse" data-placement="bottom"> <i class="flaticon-menu-line-2"></i> </a> <a href="index.html" class=""> <img src="assets/img/logo-3.png" class="img-fluid" alt="logo"></a> </div>
  <ul class="nav navbar-nav">
    <li class="nav-item d-lg-none">
      <form class="form-inline justify-content-end" role="search">
        <input type="text" class="form-control search-form-control mr-3">
      </form>
    </li>
  </ul>
</header>
<header class="header navbar fixed-top navbar-expand-sm"> 
  <ul class="navbar-nav flex-row mr-lg-auto ml-lg-0  ml-auto">
    <!--<li class="nav-item dropdown notification-dropdown ml-3"> <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="flaticon-bell-4"></span><span class="badge badge-success">15</span> </a>
      <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown"> <a class="dropdown-item title" href="javascript:void(0);"> <i class="flaticon-bell-13 mr-3"></i> <span>You have 15 new notifications</span> </a> <a class="dropdown-item text-center  p-1" href="javascript:void(0);">
        <div class="notification-list ">
          <div class="notification-item position-relative  mb-3">
            <div class="c-dropdown text-right"> <span id="c-dropdonbtn" class="c-dropbtn mr-2"><i class="flaticon-dots"></i></span>
              <div class="c-dropdown-content">
                <div class="c-dropdown-item">View</div>
                <div class="c-dropdown-item">Delete</div>
              </div>
            </div>
            <h6 class="mb-1">5 new members joined today</h6>
            <p><span class="meta-time">1 minute ago</span> . <span class="meta-member-notification">4 members</span></p>
            <ul class="list-inline badge-collapsed-img mt-3">
              <li class="list-inline-item chat-online-usr"> <img src="assets/img/90x90.jpg" alt="admin-profile" class="ml-0"> </li>
              <li class="list-inline-item chat-online-usr"> <img src="assets/img/90x90.jpg" alt="admin-profile"> </li>
              <li class="list-inline-item chat-online-usr"> <img src="assets/img/90x90.jpg" alt="admin-profile"> </li>
              <li class="list-inline-item chat-online-usr"> <img src="assets/img/90x90.jpg" alt="admin-profile"> </li>
            </ul>
          </div>
        </div>
        </a> <a class="footer dropdown-item text-center p-2"> <span class="mr-1">View All</span>
        <div class="btn btn-gradient-warning rounded-circle"><i class="flaticon-arrow-right flaticon-circle-p"></i></div>
        </a> </div>
    </li>-->
  </ul>
  <ul class="navbar-nav flex-row ml-lg-auto">
    <li class="nav-item dropdown app-dropdown  ml-lg-4 mr-lg-2 order-lg-0 order-2"> <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="appDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="flaticon-bulb"></span> </a>
      <div class="dropdown-menu  position-absolute" aria-labelledby="appDropdown"> 
      
      <a class="dropdown-item" href="orders_mng.php"> <i class="flaticon-commerce"></i><span>Order</span> </a> <a class="dropdown-item" href="product_mng.php"> <i class="flaticon-edit-3"></i><span>Products</span> </a> 
      
      <a class="dropdown-item" href="coupons_mng.php"> <i class="flaticon-notes-3"></i><span>Coupon</span> </a> <a class="dropdown-item" href="category_mng"> <i class="flaticon-note-1"></i><span>Category</span> </a> 
      
      <a class="dropdown-item" href="bulkproductdownload_mng.php"> <i class="flaticon-file-upload-line"></i><span>Bulk Upload</span> </a> 
      
       
      
      <a class="dropdown-item" href="banners_mng.php"> <i class="flaticon-crop-1"></i><span>Banner</span> </a> 
      
       </div>
    </li>
    <li class="nav-item dropdown user-profile-dropdown ml-lg-0 mr-lg-2 ml-3 order-lg-0 order-1"> <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="flaticon-user-12"></span> </a>
      <div class="dropdown-menu  position-absolute" aria-labelledby="userProfileDropdown"> <a class="dropdown-item" href="profile.php">
        <?php if(file_exists(docroot.'adminusers/'.$homeres_ed['user_photo']) && $homeres_ed['user_photo'] != ''){?>
        <img width="50" height="50" class="img-circle" src="<?php echo IMG_BASE_URL;?>adminusers/<?php echo $homeres_ed['user_photo']; ?>" />
        <?php }else{?>
        <i class="mr-1 flaticon-user-6"></i>
        <?php }?>
        <span>My Profile</span> </a> 
        <!-- <a class="dropdown-item" href="user_lockscreen_1.html">
                        <i class="mr-1 flaticon-lock-2"></i> <span>Lock Screen</span>
                    </a>-->
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php"> <i class="mr-1 flaticon-power-button"></i> <span>Log Out</span> </a> </div>
    </li>
  </ul>
</header>
