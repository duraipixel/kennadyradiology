<?php
if($pagename=='productlist') {
	$subcat 			= array();
	if ( ($helper instanceof common_function) != true ) {
		$helper 		= $this->loadHelper('common_function');
	}
   	$helper->subCategories($catid,$subcat);
	
 ?>

<form id="frmcmnfilter" class="<?php if(count($subcat) == 0){?>nocatdiv<?php }?>">
    <?php 
	if(count($subcat)>0){
?>
    <div class="clearfix"></div>
    <!-- <div class="categories-dropdown dropdown">
        <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="flaticon-menu-1"></span>
            <?php echo $homedisplaylanguage['category'];?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
					
			$temparrlist=array();
			$prevparent="";
			$Issubcatl1=0;
			foreach($subcat as $fcatid=>$sub)
			{
				foreach($sub as $subcatid=>$subplus)
				{
					if($subcat[$subplus['categoryID']]>0)
					{
						$arrpath=array();
						$helper->getProductPath($subplus['categoryID'],$arrpath);
						$path=BASE_URL;
						for($j=count($arrpath)-1;$j>=0;$j--)
							$path.=$arrpath[$j].'/';	
						$path=trim($path,'/');
						?>

            <a class="dropdown-item" href="#">
                <div class="custom-control custom-checkbox">
                    <input id="category<?php echo $subplus['categoryID'];?>" type="checkbox" onchange="fnAttrChanged()"
                        name="subcatid[]" class="custom-control-input" value="<?php echo $subplus['categoryID'];?>">
                    <label class="custom-control-label"
                        for="category<?php echo $subplus['categoryID'];?>"><?php echo $subplus['categoryName'];?></label>
                </div>
            </a>
            <?php
				$Issubcatl1=0;	
				$Issubcatl2=0;	
					foreach($subcat[$subplus['categoryID']] as $lastcatid=>$subplus1)
					{	
						$arrpath=array();
						$helper->getProductPath($subplus1['categoryID'],$arrpath);
						$path=BASE_URL;
							
						for($j=count($arrpath)-1;$j>=0;$j--)
							$path.=$arrpath[$j].'/';	
						$path=trim($path,'/');
			?>
            <a class="dropdown-item" href="#">
                <div class="custom-control custom-checkbox">
                    <input id="category<?php echo $subplus1['categoryID'];?>" type="checkbox" onchange="fnAttrChanged()"
                        name="subcatid[]" class="custom-control-input" value="<?php echo $subplus1['categoryID'];?>">
                    <label class="custom-control-label"
                        for="category<?php echo $subplus1['categoryID'];?>"><?php echo $subplus1['categoryName'];?></label>
                </div>
            </a>
            <?php 
					$Issubcatl1=1;	
				
				}		

			}
			else{
				if($Issubcatl1==0){
						$arrpath=array();
							$helper->getProductPath($subplus['categoryID'],$arrpath);
							$path=BASE_URL;
							for($j=count($arrpath)-1;$j>=0;$j--)
								$path.=$arrpath[$j].'/';	
							$path=trim($path,'/');
						?>
            <a class="dropdown-item" href="#">
                <div class="custom-control custom-checkbox">
                    <input id="category<?php echo $subplus['categoryID'];?>" type="checkbox" onchange="fnAttrChanged()"
                        name="subcatid[]" class="custom-control-input" value="<?php echo $subplus['categoryID'];?>">
                    <label class="custom-control-label"
                        for="category<?php echo $subplus['categoryID'];?>"><?php echo $subplus['categoryName'];?></label>
                </div>
            </a>
            <?php
									}
							}
					}
				}
				echo $strcatefilter.''; 
			?>
        </div>
    </div> -->
    <?php } 
  }?>
	<?php 
	
	if( isset( $allCategories ) && !empty( $allCategories ) ) {
	?>
    <!-- <div class="categories-dropdown dropdown">
        <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class="flaticon-menu-1"></span>
            Categories </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 62px, 0px);"
            x-placement="bottom-start">
			<?php 
			foreach ($allCategories as $cat) {
			?>
            <a class="dropdown-item" href="#">
                <div class="custom-control custom-checkbox">
                    <input id="category<?= $cat->categoryID?>" type="checkbox" onchange="fnAttrChanged()" name="subcatid[]"
                        class="custom-control-input" value="<?= $cat->categoryID ?>">
                    <label class="custom-control-label" for="category<?= $cat->categoryID ?>"><?= $cat->categoryName ?></label>
                </div>
            </a>
           <?php } ?>
        </div>
    </div>  -->
	<?php } ?>
    <?php  
if( isset( $fliter_list ) && !empty( $fliter_list )  ){ 

	$strfilterhtml 		= "";
	$prevattrid 		= '';
	
	foreach($fliter_list as $f ) { 	
		
        $sel = '';	
		if($prevattrid != $f->attributeid)
		{
			if($prevattrid!=''){
				$strfilterhtml.='</select>';				
			}
			
			$strfilterhtml.='<select name="attr_'.$f->attributeid.'[]" class="form-control multiselectcheck"  data-placeholder="'.$f->attributename.'" onChange="fnAttrChanged();" multiple  id="'.$helper->generateslug($f->attributecode).'">';
			  
			  if(in_array($f->dropdown_id,$did)){$sel = "selected='selected'";}
			$strfilterhtml.='  
				<option '.$sel.' value="'.$f->dropdown_id.'">'.$f->dropdown_values.'</option> 	';
		}
		else{
			 if(in_array($f->dropdown_id,$did)){$sel = "selected='selected'";}
			$strfilterhtml.='  <option '.$sel.' value="'.$f->dropdown_id.'">'.$f->dropdown_values.'</option>	';
			
		}
	  $prevattrid=$f->attributeid;		
	}
	if($prevattrid!='')
	{
		$strfilterhtml.='	</select>';
		
	}


	echo $strfilterhtml; 		
	} 
	
	?>

    <!-- <div class="pricerange-wraper">
        <span class="pricerange-text"><?php echo $productlistdisplaylanguage['pricerange'];?></span>
        <div id="pricefilter1" style="">
            <div class="well">
                <div class="price-range-block">
                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                    <div>
                        <input type="hidden" id="minval"
                            value="<?php echo !empty($fliter_price->min_price) ? floor($fliter_price->min_price):'0'; ?>" />
                        <input type="hidden" id="maxval"
                            value="<?php echo !empty($fliter_price->max_price) ? ceil($fliter_price->max_price):'0'; ?>" />

                        <span class="minspan"><?php echo PRICE_SYMBOL;?><input type="text" id="min_price"
                                name="min_price" class="price-range-field"
                                onBlur="pricevaluechange(this.value,'min_price');" />
                        </span>
                        <span class="maxspan">
                            <?php echo PRICE_SYMBOL;?> <input type="text" id="max_price" name="max_price"
                                class="price-range-field" onBlur="pricevaluechange(this.value,'max_price');" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>  -->
</form>