<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
      <div class="container">
    <div class="row">
          <div class="col">
        <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"> <?php echo $commondisplaylanguage['home'];?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Knowledge Center</li>
            <?php if($getknowledgecategory[0]['categoryname'] != ''){?>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo BASE_URL;?>knowledgecenter/<?php echo $getknowledgecategory[0]['categoryslug'];?>"><?php echo $getknowledgecategory[0]['categoryname'];?></a></li>
            <?php }?>
          </ol>
            </nav>
        <h1 class="heading1 text-center text-white"><?php echo ($knowledgecenterlist[0]['knowledgecentertitle'] != '')? $knowledgecenterlist[0]['knowledgecentertitle'] : 'Knowledge Center';?></h1>
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
                  <h3><?php echo $knowledgecenterlist[0]['knowledgecentertitle'];?><small><?php echo date('d - F - Y',strtotime($knowledgecenterlist[0]['knowledgecenterdate']));?></small></h3>
                </div>
            <div class="col-sm-12 col-md-8">
                  <p><?php echo $knowledgecenterlist[0]['knowledgecenterdescription'];?></p>
                  <?php $getpdflist = $helper->knowledgecenteroptions($knowledgecenterlist[0]['knowledgecenterid'],1);
							 $getvideolist = $helper->knowledgecenteroptions($knowledgecenterlist[0]['knowledgecenterid'],2);
							  $geturllist = $helper->knowledgecenteroptions($knowledgecenterlist[0]['knowledgecenterid'],3);?>
                  <?php if(count($getpdflist) > 0){?>
                  <ul class="list-style1">
                <?php foreach($getpdflist as $pdflist){?>
                <li> <a  target="_blank" href="<?php echo img_base_url;?>knowledgecenter/pdf/<?php echo $pdflist['pdffile'];?>"><?php echo $pdflist['pdftitle'];?></a> </li>
                <?php }?>
              </ul>
                  <?php }?>
                  <?php if(count($geturllist) > 0){?>
                  <?php foreach($geturllist as $urllist){?>
                  <a href="<?php echo $urllist['urllink'];?>" target="_blank" class="yellow-btn"><?php echo $urllist['urltitle'];?></a>
                  <?php }}?>
                </div>
            <?php if(count($getvideolist) > 0){?>
            <div class="col-sm-12 col-md-4">
			    <div id="carouselVideo" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                <div class="carousel-inner">
                      <?php $i = 0;foreach($getvideolist as $videolist){?>
                      <div class="carousel-item <?php echo ($i == 0) ? 'active' : '';?>"> <a data-fancybox="youtube" href="https://www.youtube.com/watch?v=<?php echo $videolist['videolink'];?>"> <i class="fa fa-play" aria-hidden="true"></i>
					 <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).jpg" class="d-block w-100" alt=""/>-->
					 <iframe src="https://www.youtube.com/embed/<?php echo $videolist['videolink'];?>"></iframe>
					  </a> </div>
                      <?php $i++;}?>
                    </div>
                <?php if(count($getvideolist) > 1){?>
                <button	class="carousel-control-prev" type="button"	data-mdb-target="#carouselVideo"	data-mdb-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>
                <button	class="carousel-control-next" type="button"	data-mdb-target="#carouselVideo"	data-mdb-slide="next"> <i class="fa fa-angle-right" aria-hidden="true"></i> </button>
                <?php }?>
              </div>
                </div>
            <?php }?>
          </div>
            </div>
      </div>

        </div>
		
		 <?php
		 
	 	$nextknowledge = explode('@@',$knowledgenextprev['nextknowledge']);
		$nprodurl = $nextknowledge[1];
		$ncode = $nextknowledge[2];
		
		
		
		$prevknowledge = explode('@@',$knowledgenextprev['prevknowledge']);
		$pprodurl = $prevknowledge[1];
		$pcode = $prevknowledge[2];
		 
		?>
		
    <div class="row">
	 <?php if($ncode != ''){?> 
	 <div class="col-sm-6 col-md-6 col-lg-6"> <a href="<?php echo BASE_URL;?>knowledgecenter-details/<?php echo $ncode;?>" class="yellow-btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> &nbsp; Previous</a> </div>
	  <?php if($pcode == ''){?> <div class="col-sm-6 col-md-6 col-lg-6"></div> <?php }?>
	 <?php }?>
	  <?php if($pcode != ''){?>
	   <?php if($ncode == ''){?> <div class="col-sm-6 col-md-6 col-lg-6"></div> <?php }?>
          <div class="col-sm-6 col-md-6 col-lg-6 text-right"> <a href="<?php echo BASE_URL;?>knowledgecenter-details/<?php echo $pcode;?>" class="yellow-btn">Next &nbsp; <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> </div><?php }?>
        </div>
  </div>
    </section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>

 