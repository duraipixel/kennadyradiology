<?php if(count($categorys)>0){ ?>

<section class="commonthumb-wraper commontop-section rel-prdide  <?php echo $addclass; ?> ">
  <div class="container">
    <?php
	if ( ($helper instanceof common_function) != true ) {
					
					$helper=$this->loadHelper('common_function');
				 	
				}
				
	?>
    <div class="col-md-12 col-sm-12 col-xs-12 nopad section-title text-center"> <?php echo $title; ?> </div>
    <div class="col-md-12 col-sm-12 col-xs-12 nopad commonthumb-slider owl-carousel owl-theme owl-loaded owl-text-select-on">
      <?php  
		//print_r($categorys); die();
		foreach($categorys as $cat) {
			
					$catslist=array();
					if($cat['categoryid']=='-100')
					{
						$catslist=$GLOBALS['allcategories'];						
					}
					else{
						
						$catslist=$helper->getsubCategories($cat['categoryid'],$catslist);						
						if(count($catslist)==0)
						{
						  $catslist=$helper->searchkeyArray($cat['categoryid'],$GLOBALS['allcategories'],"categoryID");
						}
						else{							
						   $patientcat=$helper->searchkeyArray($cat['categoryid'],$GLOBALS['allcategories'],"categoryID");
											   
						}
					}
	//	print_r($catslist); die();	
		foreach($catslist as $list) {
		 
			$baseimgurl=img_base.'uploads/categorymobileimage/'.$sub['categoryID']."/photos/menu/".$imgs['0'];
			if(!isset($patientcat['categoryCode']))
				$cathref=BASE_URL.$list['categoryCode'];
			else
				$cathref=BASE_URL.$patientcat['categoryCode']."/".$list['categoryCode'];
			
		//print_r($list) ; die();
		?>
      <div class="owl-item">
        <div class="prd-single"> <a href="<?php echo $cathref; ?>" class="prdsingle-inner">
          <div class="prdimginner-slider carousel-inner" role="listbox">
            <div class="item active prdimginner">
              <?php if($list['catimage']!='') { ?>
              <img src="<?php echo img_base;?>uploads/categorymobileimage/<?php echo $list['categoryID']?>/photos/<?php echo $list['mobilcatimage']?>" class="img-responsive center-block prdimg" title="<?php echo $list['categoryName']; ?>" alt="<?php echo $list['categoryName']; ?>">
              <?php } else { ?>
              <img src="<?php echo img_base;?>uploads/noimage/photos/medium/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $list['categoryName']; ?>" alt="<?php echo $list['categoryName']; ?>" />
              <?php } ?>
            </div>
            <div class="cat-prdname"><?php echo $list['categoryName']; ?></div>
          </div>
          </a> </div>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</section>
<?php } ?>
