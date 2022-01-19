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
				<li class="breadcrumb-item active" aria-current="page"><?php echo $getknowledgecategory[0]['categoryname'];?></li>
				<?php }?>
			  </ol>
			</nav>
			<h1 class="heading1 text-center text-white"><?php echo ($getknowledgecategory[0]['categoryname'] != '')? $getknowledgecategory[0]['categoryname'] : 'Knowledge Center';?></h1>
		 </div>
	  </div>
	</div>
</section>
<section class="features-stories-links">
	<div class="container">
		<div class="row">
			<div class="col">
			<nav class="navbar navbar-expand-lg"> 				 
				<div class="collapse navbar-collapse" id="feat-stor-Nav">
				<ul class="navbar-nav mr-auto">
				<?php foreach($getknowledgecategory as $kcategory){?>
					<li class="nav-item active">
						<a class="nav-link <?php echo ($pagecode == $kcategory['categoryslug']) ? 'active' : '';?>" href="<?php echo BASE_URL;?>knowledgecenter/<?php echo $kcategory['categoryslug'];?>"><?php echo $kcategory['categoryname'];?></a>
					</li>
				<?php }?>
					
				</ul>
				</div>
				</nav>
			</div>
		</div>
	</div>
</section>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
        <div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">	
<?php if(count($knowledgecenterlist) > 0){?>			
				<?php foreach($knowledgecenterlist as $knowledgelist){?>
				<a href="<?php echo BASE_URL;?>knowledgecenter-details/<?php echo $knowledgelist['knowledgecentercode'];?>" class="features-stories-link">
					<div class="date"><strong><?php echo date('d',strtotime($knowledgelist['knowledgecenterdate']));?></strong> <?php echo date('M Y',strtotime($knowledgelist['knowledgecenterdate']));?></div>
					<h4><?php echo $knowledgelist['knowledgecentertitle'];?></h4>
					<p><?php echo substr(strip_tags($knowledgelist['knowledgecenterdescription']),0,300); if(strlen($knowledgelist['knowledgecenterdescription']) > 300){ echo '...';} ?></p> 
					<span>Read More <i class="fa fa-angle-right" aria-hidden="true"></i></span>
				</a>
				<?php }?>
				<?php }else{?>
				<div class="errormsg">No Result Found!</div>
				<?php }?>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>