<div id="search"> <span class="close">X</span>
  <form role="search" id="searchform" action="<?php echo BASE_URL;?>search" method="get">
   <input type="text" name="q" id="searchfield" value="<?php echo $_REQUEST['q']; ?>" class="form-control" aria-label="..." placeholder="Hey, What are you looking for?" required=''>
   <button class="close-icon" type="reset"></button>
    <!--<input value="" name="q" type="search" placeholder="type to search"/>-->
  </form>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="footer-logo"> <img src="<?php echo BASE_URL;?>static/images/footer-logo.png" alt=""> 
		<?php echo $helper->getdisplayblock('footer-follow-us'); ?> 
       
        </div>
      </div>
      <div class="col-md-2 col-sm-6">
        <div class="footerlink-wrap">
          <h5>Quick Links</h5>
          <?php echo $helper->getdisplayblock('footer-support'); ?>
			<?php if($_SESSION['cus_group_id']=='2'){ ?> <ul><li><a href="corporate-gifts">Corporate Gifting</a></li></ul> <?php }?>
		  </div>
      </div>
      <div class="col-md-2 col-sm-6">
        <div class="footerlink-wrap">
          <h5>Products</h5>
          <?php echo $helper->getdisplayblock('footer-product-catagory'); ?> </div>
      </div>
      <div class="col-md-2 col-sm-6">
        <div class="footerlink-wrap">
          <h5>Others</h5>
          <?php echo $helper->getdisplayblock('footer-inbase-gift-mart'); ?> </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="footerlink-wrap">
          <h5>Stay Connected</h5>
          <h6>Subscribe to get latest products launches, offers and exclusive news.</h6>
          <div class="subscribe-set">
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Your E-mail address" name="emails" id="emails" required=''>
			  <button type="submit" onclick="emailfun('emails');" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copyrights"> <?php echo $helper->getdisplayblock('inbase-copy-rights'); ?> </div>
</footer>
