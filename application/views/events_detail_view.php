<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
      <div class="container">
    <div class="row">
          <div class="col">
        <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"> <?php echo $commondisplaylanguage['home'];?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo BASE_URL;?>events">Events</li>
            
          </ol>
            </nav>
        <h1 class="heading1 text-center text-white"><?php echo $newsDetail[0]['eventtitle'];?></h1>
      </div>
        </div>
  </div>
    </section>
	
<section class="light-gray-bg border-bottom my-account">
      <div class="container">
    <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="box-shadow features-stories-details">
              <div class="row">
            <div class="col-sm-12 col-md-12">
                  <h3><?php echo $newsDetail[0]['eventtitle'];?><small><?php echo date('d - F - Y',strtotime($newsDetail[0]['eventdate']));?></small></h3>
                </div>
            <div class="col-sm-12 col-md-8">
                  <p><?php echo $newsDetail[0]['eventdescription'];?></p>
                  
                  
				  	 <?php if($newsImg[0]['imgname'] != '' || $newsDetail[0]['eventvideourl'] != ''){?>
                <div id="news-detail-slider" class="news-detail-slider">
                <?php 
			 
				
				foreach($newsImg as $newsImgval){	if($newsImgval['imgname'] != ''){?>
					<div class="item">
						<img src="<?php echo img_url; ?>events/<?php echo $newsImgval['imgname'];?>" alt="<?php echo $newsDetail[0]['eventcode'];?>" class="img-responsive">
					</div>
                  <?php }}?> 
                  
                  <?php if($newsDetail[0]['eventvideourl'] != ''){?>
	                  <div class="item">
    		              <a class="owl-video" href="<?php echo $newsDetail[0]['eventvideourl'];?>"></a>
            	      </div>
                  <?php }?>
                  
				</div>
				<?php }?>
				
				
                  <?php if($newsDetail[0]['eventurl'] != ''){?> 
                  
				  <a href="<?php echo $newsDetail[0]['eventurl'];?>" class="yellow-btn" target="_blank">Visit Site</a>
				   
                  <?php  }?>
                </div>
             
          </div>
            </div>
      </div>

        </div>
		<?php
	 
	 	$nextnews = explode('@@',$newsnextprev['nextnews']);
		$nprodurl = $nextnews[1];
		$ncode = $nextnews[2];
		
		
		
		$prevnews = explode('@@',$newsnextprev['prevnews']);
		$pprodurl = $prevnews[1];
		$pcode = $prevnews[2];
		
		
		/*$pnews = explode('@@',$newsnextprev['pnewsname']);
		$prevnews = $pnews[0];
		$prevlink = $pnews[1];
		
		$nnews = explode('@@',$newsnextprev['nnewsname']);
		$nextnews = $nnews[0];
		$nextlink = $nnews[1];*/
		?>
        
		
    <div class="row">
	 <?php if($ncode != ''){?> 
	 <div class="col-sm-6 col-md-6 col-lg-6"> 
	 	<a href="<?php echo BASE_URL;?>events/<?php echo $ncode;?>" class="yellow-btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> &nbsp; Previous</a> </div>
	  <?php if($pcode == ''){?> <div class="col-sm-6 col-md-6 col-lg-6"></div> <?php }?>
	 <?php }?>
	  <?php if($pcode != ''){?>
	   <?php if($ncode == ''){?> <div class="col-sm-12 col-md-12 col-lg-12 text-right"> <?php }else{?>
	   <div class="col-sm-6 col-md-6 col-lg-6 text-right"><?php }?> 	<a href="<?php echo BASE_URL;?>events/<?php echo $pcode;?>" class="yellow-btn">Next &nbsp; <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> </div><?php }?>
        </div>
  </div>
    </section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>

 