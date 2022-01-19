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
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo BASE_URL;?>knowledgecenter-details/<?php echo $getknowledgecategory[0]['categoryslug'];?>"><?php echo $getknowledgecategory[0]['categoryname'];?></a></li>
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
							<ul class="list-style1">
								<li>
									<a href="#">Download PDF 1</a>
								</li>
								<li>
									<a href="#">Download PDF 2</a>
								</li>
								<li>
								<a href="#">Download PDF 3</a>
								</li>
							</ul>
							<a href="#" class="yellow-btn">Visit Site</a>
						</div>
						<div class="col-sm-12 col-md-4">
							<div id="carouselVideo" class="carousel slide carousel-fade" data-mdb-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<a data-fancybox="youtube" href="https://www.youtube.com/watch?v=IAIVaHicK8g">
										<i class="fa fa-play" aria-hidden="true"></i>
										<img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).jpg" class="d-block w-100" alt=""/>
									</a>
								</div>
								<div class="carousel-item">
									<a data-fancybox="youtube" href="https://www.youtube.com/watch?v=1E4joK14_es">
										<i class="fa fa-play" aria-hidden="true"></i>
										<img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).jpg" class="d-block w-100" alt=""/>
									</a>
								</div>
								<div class="carousel-item">
									<a data-fancybox="youtube" href="https://www.youtube.com/watch?v=d-l3--YRZ7o">
										<i class="fa fa-play" aria-hidden="true"></i>
										<img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).jpg" class="d-block w-100" alt=""/>
									</a>								
								</div>
							</div>
							<button	class="carousel-control-prev" type="button"	data-mdb-target="#carouselVideo"	data-mdb-slide="prev">
								<i class="fa fa-angle-left" aria-hidden="true"></i>
							</button>
							<button	class="carousel-control-next" type="button"	data-mdb-target="#carouselVideo"	data-mdb-slide="next">
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</button>
							</div>
						</div>
					</div>					
				</div>
			</div>
        </div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6">
				<a href="#" class="yellow-btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> &nbsp; Previous</a>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 text-right">
				<a href="#" class="yellow-btn">Next &nbsp; <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
			</div>
		</div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>