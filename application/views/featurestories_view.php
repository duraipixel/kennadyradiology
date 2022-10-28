<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"> <?php echo $commondisplaylanguage['home'];?></a></li>
				<li class="breadcrumb-item active" aria-current="page">Feature Stories</li>
				 
			  </ol>
			</nav>
			<h1 class="heading1 text-center text-white"> Feature Stories</h1>
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
					<li class="nav-item active">
						<a class="nav-link active" href="<?php echo BASE_URL;?>feature-stories">Feature Story</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL;?>events">Events</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="<?php echo BASE_URL;?>news">News</a>
					</li>
									
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
			<div class="col-sm-12 col-md-6 col-lg-3">	
				<label>Select Year</label>
				  <?php
                          // set start and end year range
                          $yearArray = range(2000, 2050);
                          ?>
                          <!-- displaying the dropdown list -->
                          <select class="form-control select2" id="year-dropdown" onChange="return ChangeyearNews('','')">   
                              <option value="">Year</option>
                              <?php
                              foreach ($getyearlist as $year) {
                                  // if you want to select a particular year
                                 // $selected = ($year == date('Y')) ? 'selected' : '';
                                 // echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
								   echo '<option '.$selected.' value="'.$year['year'].'">'.$year['year'].'</option>';
                              }
                              ?>
                            </select>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-3">	
				<label>Select Month</label>
					 <?php
                        $monthArray = range(1, 12);
                    ?>
                    <select class="form-control select2" id="month-dropdown" onChange="return ChangeyearNews('','')">
                        <option value="">Month</option>
                        <?php
                        foreach ($monthArray as $month) {
                            // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                            // you can use whatever year you want
                            // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2016-$monthPadding-01"));
							//$selected1 = ($monthPadding == date('m')) ? 'selected' : '';
                            echo '<option '.$selected1.' value="'.$monthPadding.'">'.$fdate.'</option>';
                        }
                        ?>
                    </select> 
			</div>
		</div>
        <div class="row">
		
			<div class="col-sm-12 col-md-12 col-lg-12">	
			

 		<input type="hidden"  name="storypage" id="storypage" value="2" />
     	<input type="hidden"  name="newsoptionids" id="newsoptionids" value="" />
		
		
  <?php if(count($storylist) > 0){?>			
				 <span id="storynews">
   
    <?php 
	$i = 0;
	foreach($storylist as $storyval){?>
				 <a href="<?php echo BASE_URL; ?>feature-stories/<?php echo $storyval['storycode'];?>" class="features-stories-link">
					<div class="date"><strong><?php echo date('d',strtotime($storyval['StoryDate']));?></strong> <?php echo date('M Y',strtotime($storyval['StoryDate']));?></div>
					<h4><?php echo $storyval['StoryTitle'];?></h4>
					<p><?php echo substr(strip_tags($storyval['StoryDescription']),0,300); if(strlen($storyval['StoryDescription']) > 300){ echo '...';} ?></p> 
					<span>Read More <i class="fa fa-angle-right" aria-hidden="true"></i></span>
				</a>
				<?php }?>
				 </span>
         <div class="storycontent"></div>
				<?php }else{?>
				<div class="errormsg">No Result Found!</div>
				<?php }?>
			</div>
        </div>
		<?php if($storylist != '' && (count($storylistcount) >  $getpagecount)){?>
		<div class="load-more col-xs-12 no-padding" id="storyshow_more">
				<p><span class="inner-effect"></span>
				<span class="inner-text" onClick="return loadmore_news()" >Load more</span>
                </p>
		</div>
        <?php }?>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<script>
    $('.select2').select2();
	
		function ChangeyearNews(year,month){
			$("#storypage").val(1);
			
			if(year == ''){
				var year  = $('#year-dropdown').val();
			}
			else{
				var year = year;
			}
			var month = $('#month-dropdown').val();
			var page=parseInt($("#storypage").val());
		 
			$.ajax({
			method     : 'POST',
			dataType   : 'json',
			url: "<?php echo BASE_URL; ?>ajax/getFeaturestoriesList_ajax",
			data       : "year="+year+'&month='+month+'&action=filter&page='+page,
			//	beforesend:loading(), 		
			beforeSend: function() { loading()},	
			cache: false,			
			success: function(data){ 
				
				unloading();		
				$(".storycontent").html('');		
				if(data.story_cont.length>0){	
				   $("#storynews").html(data.story_cont);
				   $("#newsoptionids").val('');	
				//   $("#storypage").val(page+1);		
				   $("#storypage").val(2);	
				   $("#storyshow_more").css('display','inline-block');
				}
				var bb = data.maincount / <?php echo $getpagecount;?>;
				//	alert(<?php echo $getpagecount;?>);
				// alert(page);
				 //alert(bb.toFixed());
				
				 
			 	if(page>=bb.toFixed() || data.oppcnt == 0){	 	 			
				//if(page>=<?php echo round(count($storylistcount) /  $getpagecount) ;?>){	 	  
				//if(data.oppcnt<=<?php echo $getpagecount;?>){					
					$("#storyshow_more").css('display','none');		
				}
				   
			},
			error:function(msg) {
				unloading();
			}
		});
	}
		
		function loadmore_news()
	{
			var page=parseInt($("#storypage").val());	
			var year  = $('#year-dropdown').val();	
			var month = $('#month-dropdown').val();
			
			if(year == '') var year = '';
			if(month == '') var month = '';
			
			$.ajax({
					method     : 'POST',	
					dataType   : 'json',					
					url: "<?php echo BASE_URL; ?>ajax/getFeaturestoriesList_ajax",
					data       :  {action:'pagination',page:page,year:year,month:month},
					beforesend: loading(), 				
					cache: true,			
					success: function(data){
					unloading();
						if(data.story_cont.length>0){	
							$(".storycontent").append(data.story_cont);
							$("#newsoptionids").val(data.storyid);		
							$("#storypage").val(page+1);	
							$("#storyshow_more").css('display','inline-block');
						}	
						var bb = data.maincount / <?php echo $getpagecount;?>;
			 			if(page>=bb.toFixed()){	 	  
						//if(page>=<?php echo round(count($storylistcount) /  $getpagecount) ;?>){	 	  
					//	if(data.oppcnt<<?php echo $getpagecount;?>){					
							$("#storyshow_more").css('display','none');		
						}
					},
					error:function(msg) {
						 unloading();
					}
				});
	}
	
   	$(document).ready(function(){
		 $('#storypage').val(2);
	});
    
</script>