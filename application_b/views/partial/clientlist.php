<!-- <section class="brands">
         <div class="container">
            <ul class="brand-list">
              <?php foreach($getourclientslogo as $barndtieuplogo){ ?>  
              <li>
                  <a href="<?php echo $barndtieuplogo['mcurl']; ?>"  target="_balnk">
                 <img src="<?php echo BASE_URL;?>uploads/mcimage/<?php echo $barndtieuplogo['mcimage']; ?>"  alt=""> 
                  </a>
               </li>
               
               <?php }?>
            </ul>
         </div>
      </section>
       -->
	  
	  <section class="inthePress pb-5">
          <div class="container">
         <h4 class="main-title-dark in-the-press"><span>IN THE PRESS</span></h4>
            <div class="best-seller-wrap">
               <div class="inthePress-slider">
                  <?php foreach($getourclientslogo as $barndtieuplogo){ ?>
                   <div class="sell-wrap press-logos">
                      <a href="<?php echo $barndtieuplogo['mcurl']; ?>"  target="_balnk"> <img src="<?php echo BASE_URL;?>uploads/mcimage/<?php echo $barndtieuplogo['mcimage']; ?>"  alt=""> </a>
                   </div>
                      <?php }?>
               </div>
            </div>
         </div>
      </section>
 