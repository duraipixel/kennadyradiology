<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');?>
<?php //echo count($getbannerdisplay);// echo "<pre>";print_r($getbannerdisplay);?>

<div id="home-banner-carousel" class="carousel slide carousel-fade" data-ride="carousel"> 
  <!--Indicators-->
  <ol class="carousel-indicators">
    <?php $i = 0;foreach($getbannerdisplay as $bannerslider) { ?>
    <li data-target="#home-banner-carousel" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
    <?php $i++;}?>
  </ol>
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <?php $i = 1;foreach($getbannerdisplay as $bannerslider) { ?>
    <div class="carousel-item <?php echo ($i == 1) ? 'active' : '';?>">
      <?php if($bannerslider[''] != 'banner_link'){$banlink = $bannerslider['banner_link'];}else{$banlink='javascript:void(0);';}?>
      <picture>
        <source media="(max-width:960px)" srcset="<?php echo img_base;?>uploads/banners/mobile/<?php echo $bannerslider['mobileimage'];?>" />
        <img src="<?php echo img_base;?>uploads/banners/<?php echo $bannerslider['bannerimage'];?>"class="d-block w-100" alt="" /> </picture>
      <div class="carousel-caption">
        <?php if($bannerslider['banner_title'] != '' && $bannerslider['banner_title'] != '#'){?>
        <h1><?php echo $bannerslider['banner_title'];?></h1>
        <?php }?>
        <div class="animated fadeInUp"><a href="<?php echo $banlink;?>" class="banner-btn"><?php echo $homedisplaylanguage['shopnow'];?><i class="flaticon-right-arrow"></i></a></div>
      </div>
    </div>
    <?php $i++;}?>
    <a class="carousel-control-prev" href="#home-banner-carousel" role="button" data-slide="prev"> <span class="sr-only"><?php echo $homedisplaylanguage['shopnow'];?></span> </a> <a class="carousel-control-next" href="#home-banner-carousel" role="button" data-slide="next"> <span class="sr-only"><?php echo $homedisplaylanguage['shopnow'];?></span> </a> </div>
</div>

<?php if(count($trendingcategorys) > 0){?>
<section data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center"><?php echo $homedisplaylanguage['category'];?></h2>
        <h3 class="text-center"><span><?php echo $homedisplaylanguage['explore'];?></span></h3>
        <div class="explore-products">
          <?php foreach($trendingcategorys as $trendingcat){ 
				
				if($trendingcat['parentId']=='0'){
					$slug = $trendingcat['categoryCode'];
				}else{
					$slug = $trendingcat['parentslug'].'/'.$trendingcat['categoryCode'];
				}
			
			?>
          <div> <a href="<?php echo BASE_URL.$slug; ?>">
            <?php if($trendingcat['categorymenuimage']!=''){ ?>
            <div class="icon-box"><img src="<?php echo img_base_url."category/categorymenuimage/".$trendingcat['categorymenuimage']; ?>" alt="" /></div>
            <?php } else{ ?>
            <div class="icon-box"><img src="<?php echo img_base_url;?>noimage/photos/base/noimage.png"  alt="" /></div>
            <?php } ?>
            <h4><?php echo $trendingcat['categoryName']; ?></h4>
            </a> </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>


<?php
 

      $hmslider=$helper->displayhomeslider('2','2');
		 foreach( $hmslider as $s)
		{	
			$allpath='';
			if($s['type']==1){	
				$arrpath=array();			
				$helper->getProductPath($s['categoryid'],$arrpath); 
				$allpath =$helper->pathrevise($arrpath);
			}				
			$data=$helper->displayproductsilder($s['categoryid'],'homeslider',$s['title'],$allpath,'5','',$s['title'],'clsbestseller',$s['subtitle']);	 

		} ?>
		
		<?php
		if(count($fliter_list_apron)>0 ){ ?>
<section data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center"><?php echo $homedisplaylanguage['explore'];?></h2>
        <h3 class="text-center"><span><?php echo $homedisplaylanguage['chooseapron'];?></span></h3>
        <form id="frmcmnfilter">
          <div class="choose-products">
            <?php 


if(count($fliter_list_apron)>0 ){ 
	$strfilterhtml="";
	$prevattrid='';
	foreach($fliter_list_apron as $f) {
		//display only apron attributes
		if(in_array($f['attributeid'],apronids)) {		
		if($prevattrid!=$f['attributeid'])
		{
			if($prevattrid!='')
			{
				$strfilterhtml.='	  
								</div></div></div>';
				
			}
			  if(in_array($f['attributeid'],aproncolor)) {
				 $bgimage = '<img src="'.img_base.'/static/images/explore-products-image2.png" alt="" class="img-fluid" />';
				 $title = $homedisplaylanguage['aproncolor'];
				 $subtitle = $homedisplaylanguage['aproncolorsub'];
				 $classname="apcolor";
			 }else if(in_array($f['attributeid'],apronmaterial)) {
				 $bgimage = '<img src="'.img_base.'/static/images/explore-products-image3.png" alt="" class="img-fluid" />';
				 $title = $homedisplaylanguage['apronmaterial'];
				 $subtitle = $homedisplaylanguage['apronmaterialsub'];
				  $classname="apmaterial";
			 }else if(in_array($f['attributeid'],apronsize)) {
				 $bgimage = '<img src="'.img_base.'/static/images/explore-products-image1.png" alt="" class="img-fluid" />';
				 $title = $homedisplaylanguage['apronsize'];
				 $subtitle = $homedisplaylanguage['apronsizesub'];
				  $classname="apsize";
			 }
			 
			$strfilterhtml.='
			 <div><div class="choose-products-content">
                     <h2 class="text-center">'.$title.'</h2>
                     <p class="choose-products-description">'.$subtitle.'</p>
                     <div class="choose-products-image">'.$bgimage.'</div>
					 
					<p class="pt-2 mb-0">Choose '.$f['attributename'].'</p> 
			 <div class="d-flex">
			  ';
				//<input type="checkbox" onclick="fnAttrChanged();"   name="attr[]" id="'.$f['attributeid'].'_'.$f['dropdown_id'].'" value="'.$f['dropdown_id'].'" >
			$strfilterhtml.='  
				 <div class="chiller_cb">
                         <input type="checkbox" class="'.$classname.'"    name="attr[]" id="'.$f['attributeid'].'_'.$f['dropdown_id'].'" value="'.$f['dropdown_id'].'" >
                           <label for="'.$f['attributeid'].'_'.$f['dropdown_id'].'">'.$f['dropdown_values'].'</label>
                           <span></span>
                        </div> 	';
		}
		else{
			$strfilterhtml.='  <div class="chiller_cb">
                         <input type="checkbox" class="'.$classname.'"  name="attr[]" id="'.$f['attributeid'].'_'.$f['dropdown_id'].'" value="'.$f['dropdown_id'].'" >
                           <label for="'.$f['attributeid'].'_'.$f['dropdown_id'].'">'.$f['dropdown_values'].'</label>
                           <span></span>
                        </div>	';
			
		}
	  $prevattrid=$f['attributeid'];		
	}
}
	if($prevattrid!='')
			{
				$strfilterhtml.='	</div></div>';
				
			}
	echo $strfilterhtml; 		
	
?>
            <?php } ?>
          </div>
        </form>
      </div>
      <div class="text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"> <a onclick="return apronredirect();" href="#" class="yellow-btn"><?php echo $homedisplaylanguage['explore'];?></a> </div>
    </div>
  </div>
  </div>
</section>
<?php }?>
		
		
<?php if(count($homevideolists) > 0){?>
<section class="video-bg" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center"><?php echo $homedisplaylanguage['cateogry'];?></h2>
        <h3 class="text-center"><span><?php echo $homedisplaylanguage['explore'];?></span></h3>
        <div class="home-videos">
          <?php foreach($homevideolists as $videolist){?>
          <div>
            <div class="home-videos-content"> <a data-fancybox href="<?php echo $videolist['video_url'];?>" class="home-videos-img"> <img src="<?php echo img_base;?>/uploads/videoimages/<?php echo $videolist['video_image'];?>" alt="" class="img-fluid" /> <img src="<?php echo img_base;?>/static/images/play-icon.png" alt="" class="play-icon" /> </a>
              <h5><?php echo $videolist['video_title'];?></h5>
              <div class="text-center"> <a class="youtube-btn" data-fancybox href="<?php echo $videolist['video_url'];?>"><i class="flaticon-youtube-play-fill"></i> <?php echo $homedisplaylanguage['watchyoutube'];?></a> </div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>
<?php if(count($testimoniallist) > 0){?>
<section data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
  <div class="container">
    <div class="row">
      <div class="col">
        <h3 class="heading1"><?php echo $homedisplaylanguage['customersay'];?></h3>
        <div class="home-testimonials">
          <?php foreach($testimoniallist as $testimonialval){?>
          <div>
            <div class="home-testimonial-content"> <img src="<?php echo img_base;?>/static/images/quote.png" alt="" class="quote" />
              <div class="home-testimonial-image"> <img src="<?php echo img_base;?>/static/images/testimonial-image2.png" alt="" class="img-fluid" />
                <p class="home-testimonial-heading"><?php echo $testimonialval['customername'];?></p>
                <p class="home-testimonial-ratings"> <i class="flaticon-star-full"></i> <i class="flaticon-star-full"></i> <i class="flaticon-star-full"></i> <i class="flaticon-star-full"></i> <i class="flaticon-star-half"></i> </p>
              </div>
              <p class="home-testimonial-description"><?php echo $testimonialval['testimonialcontent'];?></p>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<script type="text/javascript">
function apronredirect(){
	
	var filters =  $('#frmcmnfilter').serialize();	
	//var colorid = $('input[class="apcolor"]:checked').val();	 
	//var material = $('input[class="apmaterial"]:checked').val();	
	//var size = $('input[class="apsize"]:checked').val();
	
	var colorid = [];
	$('input[class="apcolor"]:checked').each(function(){
    colorid.push($(this).val());
});
 
 var material = [];
	$('input[class="apmaterial"]:checked').each(function(){
    material.push($(this).val());
});

var size = [];
	$('input[class="apsize"]:checked').each(function(){
    size.push($(this).val());
});
 
 if($('input[class="apcolor"]:checked').length == 0 || colorid == 'undefined'){
		swal("Failure!", "Choose any apron color", "warning");return false;
	}else if($('input[class="apmaterial"]:checked').length == 0  || colorid == 'undefined'){
		swal("Failure!", "Choose any apron material", "warning");return false;
	}else if($('input[class="apsize"]:checked').length == 0  || colorid == 'undefined'){
		swal("Failure!", "Choose any apron size", "warning");return false;
	}
	window.location.href='<?php echo BASE_URL.apronname.'/filter/';?>'+colorid+'/'+material+'/'+size; 
}
</script>