<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
      <div class="container">
    <div class="row">
          <div class="col">
        <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"> <?php echo $commondisplaylanguage['home'];?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo BASE_URL;?>feature-stories">Feature Story</li>
            
          </ol>
            </nav>
        <h1 class="heading1 text-center text-white"><?php echo $storyDetail[0]['StoryTitle'];?></h1>
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
                  <h3><?php echo $storyDetail[0]['StoryTitle'];?><small><?php echo date('d - F - Y',strtotime($storyDetail[0]['StoryDate']));?></small></h3>
                </div>
            <div class="col-sm-12 col-md-8">
                  <p><?php echo $storyDetail[0]['StoryDescription'];?></p>
                  
                  
                  <?php if($storyDetail[0]['StoryURL'] != ''){?> 
                  
				  <a href="<?php echo $storyDetail[0]['StoryURL'];?>" class="yellow-btn" target="_blank">Visit Site</a>
				   
                  <?php  }?>
                </div>
             
          </div>
            </div>
      </div>

        </div>
		  <?php
	 	$nextstory = explode('@@',$storynextprev['nextstory']);
		$nprodurl = $nextstory[1];
		$ncode = $nextstory[2];
		
		
		
		$prevstory = explode('@@',$storynextprev['prevstory']);
		$pprodurl = $prevstory[1];
		$pcode = $prevstory[2];
		
		
		/*$pstory = explode('@@',$storynextprev['pstoryname']);
		$prevstory = $pstory[0];
		$prevlink = $pstory[1];
		
		$nstory = explode('@@',$storynextprev['nstoryname']);
		$nextstory = $nstory[0];
		$nextlink = $nstory[1];*/
		?>
		
    <div class="row">
	 <?php if($ncode != ''){?> 
	 <div class="col-sm-6 col-md-6 col-lg-6"> 
	 	<a href="<?php echo BASE_URL;?>feature-stories/<?php echo $ncode;?>" class="yellow-btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> &nbsp; Previous</a> </div>
	  <?php if($pcode == ''){?> <div class="col-sm-6 col-md-6 col-lg-6"></div> <?php }?>
	 <?php }?>
	  <?php if($pcode != ''){?>
	   <?php if($ncode == ''){?> <div class="col-sm-12 col-md-12 col-lg-12 text-right"> <?php }else{?>
	   <div class="col-sm-6 col-md-6 col-lg-6 text-right"><?php }?> 	<a href="<?php echo BASE_URL;?>feature-stories/<?php echo $pcode;?>" class="yellow-btn">Next &nbsp; <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> </div><?php }?>
        </div>
  </div>
    </section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>

 