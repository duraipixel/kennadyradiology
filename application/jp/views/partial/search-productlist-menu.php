	
                 <?php
if($pagename=='productlist'){
	$subcat=array();
	//$catid='0';
	if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
	//echo $catid."catid".print_r($subcat);
   $helper->subCategories($catid,$subcat);
 //print_r($subcat); die();?>
 
  <form id="frmcmnfilter" class="<?php if(count($subcat) == 0){?>nocatdiv<?php }?>">
  <?php   
  }
if(count($fliter_list)>0 ){ ?> 
    <?php 
	$strfilterhtml="";
	$prevattrid='';
	//echo "<pre>";
	//print_r($fliter_list);
	foreach($fliter_list as $f) { 	
        $sel = '';	
		if($prevattrid!=$f['attributeid'])
		{
			if($prevattrid!=''){
				$strfilterhtml.='</select>';				
			}
			
			//multiselectcheck
			$strfilterhtml.='<select name="attr[]" class="form-control multiselectcheck"  data-placeholder="'.$f['attributename'].'" onChange="fnAttrChanged();" multiple  id="'.$helper->generateslug($f['attributecode']).'">';
			  
			  if(in_array($f['dropdown_id'],$did)){$sel = "selected='selected'";}
				//<input type="checkbox" onclick="fnAttrChanged();"   name="attr[]" id="'.$f['attributeid'].'_'.$f['dropdown_id'].'" value="'.$f['dropdown_id'].'" >
			$strfilterhtml.='  
				<option '.$sel.' value="'.$f['dropdown_id'].'">'.$f['dropdown_values'].'</option> 	';
		}
		else{
			 if(in_array($f['dropdown_id'],$did)){$sel = "selected='selected'";}
			$strfilterhtml.='  <option '.$sel.' value="'.$f['dropdown_id'].'">'.$f['dropdown_values'].'</option>	';
			
		}
	  $prevattrid=$f['attributeid'];		
	}
	if($prevattrid!='')
			{
				$strfilterhtml.='	</select>';
				
			}
	echo $strfilterhtml; 		
	} ?>
<div class="pricerange-wraper">
<span class="pricerange-text"><?php echo $productlistdisplaylanguage['pricerange'];?></span>
				  <div id="pricefilter1" style="">
					<div class="well">
					  <div class="price-range-block">
						<div id="slider-range" class="price-filter-range" name="rangeInput"></div>
						<div>
						  <input type="hidden" id="minval" value="<?php echo !empty($fliter_price['minprice'])? floor($fliter_price['minprice']):'0'; ?>" />
						  <input type="hidden" id="maxval" value="<?php echo !empty($fliter_price['maxprice'])? ceil($fliter_price['maxprice']):'0'; ?>" />
						  
						  <span class="minspan"><?php echo PRICE_SYMBOL;?><input  type="text" id="min_price" name="min_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'min_price');" />
						  </span>
						  <span class="maxspan">
						 <?php echo PRICE_SYMBOL;?> <input  type="text"  id="max_price" name="max_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'max_price');" />
						 </span>
						</div>
					  </div>
					</div>
				  </div>
			</div>  
</form>