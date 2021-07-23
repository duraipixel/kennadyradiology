	<div class="row">
		<div class="col-sm-12 col-md-4">
			<div class="pricerange-wraper">
			  <ul class="collapsemenu">
				<li> <p class="filter-text1">Price</p> <a aria-controls="pricefilter1" aria-expanded="true" class="collapse-trigger" data-toggle="collapse" href="#pricefilter1" role="button"></a>
				  <div aria-expanded="true" class="collapse in" id="pricefilter1" style="">
					<div class="well">
					  <div class="price-range-block">
						<div id="slider-range" class="price-filter-range" name="rangeInput"></div>
						<div>
						  <input type="hidden" id="minval" value="<?php echo !empty($fliter_price['minprice'])? floor($fliter_price['minprice']):'0'; ?>" />
						  <input type="hidden" id="maxval" value="<?php echo !empty($fliter_price['maxprice'])? ceil($fliter_price['maxprice']):'0'; ?>" />
						  <input type="number" id="min_price" name="min_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'min_price');" />
						  <span>to</span>
						  <input type="number"  id="max_price" name="max_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'max_price');" />
						</div>
					  </div>
					</div>
				  </div>
				</li>
			  </ul>
			</div>
		</div>
		<div class="col-sm-12 col-md-4">
			<p class="filter-text1">Sub Categories</p>
			<select name="subcategory" id="filter1" class="form-control"  multiple="multiple">
                <option value="smartwearable">Smart Wearable</option>
                <option value="smartwatch">Smart Watch</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
			</select>
		</div>
		<div class="col-sm-12 col-md-4">
			<p class="filter-text1">Colors</p>
			<select name="colors" id="filter2" class="form-control"  multiple="multiple">
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="blue">Blue</option>
                <option value="green">Green</option>
                <option value="red">Red</option>
                <option value="yellow">Yellow</option>
			</select>
		</div>
	</div>

<?php
if($pagename=='productlist'){
	$subcat=array();
   $helper->subCategories($catid,$subcat);
  if(count($subcat)>0){
?>
<div class="categorylist-wraper">
  <ul class="collapsemenu">
    <li> <a class="firstlevel-collpase" href="javascript:void(0);"><?php echo $catid=='0'?'Categories':$catinfo['categoryName']; ?></a> <a aria-controls="collapseMenu1" aria-expanded="true" class="collapse-trigger" data-toggle="collapse" href="#collapseMenu1" id="flexible-packaging" role="button"></a>
      <div aria-expanded="true" class="collapse in" id="collapseMenu1" style="">
        <div class="well">
          <ul class="collapse-submenu">
            <?php
						$temparrlist=array();
						$strcatefilter="";
						$prevparent="";
						$Issubcatl1=0;
						foreach($subcat as $fcatid=>$sub)
						{
							
							
									foreach($sub as $subcatid=>$subplus)
									{
										if($subcat[$subplus['categoryID']]>0)
										{
											
											 if($Issubcatl1==1)
											 {
												$strcatefilter.=' </ul>
																	</div>
																</div>
															</li>';
											 }
											 else
											 {
												 $strcatefilter.=' </li>'; 
											 }
											 $arrpath=array();
											 $helper->getProductPath($subplus['categoryID'],$arrpath);
											 $path=BASE_URL;
											 for($j=count($arrpath)-1;$j>=0;$j--)
												 $path.=$arrpath[$j].'/';	
												$path=trim($path,'/');
												
											 $strcatefilter.='<li>
														<a class="firstlevel-collpase" href="'.$path.'">'.$subplus['categoryName'].'</a> 
														<a aria-controls="'.$subplus['categoryCode'].'" aria-expanded="true" class="collapse-trigger collapsed" data-toggle="collapse" href="#'.$subplus['categoryCode'].'"  role="button"></a>
														<div aria-expanded="true" class="collapse" id="'.$subplus['categoryCode'].'" style="">
														<div class="well">
														<ul class="collapse-submenu">';
														
														
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
														$strcatefilter.='<li>
																<a  href="'.$path.'">'.$subplus1['categoryName'].'</a> 
															</li> ';
														
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
											$strcatefilter.='<li>
																<a  href="'.$path.'">'.$subplus['categoryName'].'</a> 
															</li> ';
											}
									}
							}
						}
						echo $strcatefilter.''; 
						if(!(count($subcat)%2))
							echo  '</div>';
					?>
          </ul>
        </div>
      </div>
    </li>
  </ul>
</div>
<?php } ?>
<?php } ?>
<?php 
if(count($fliter_list)>0 ){ ?>
<div class="filtermain-wraper">

  <ul class="collapsemenu">
    <?php 
	$strfilterhtml="";
	$prevattrid='';
	foreach($fliter_list as $f) { 		
		if($prevattrid!=$f['attributeid'])
		{
			if($prevattrid!='')
			{
				$strfilterhtml.='	 </div>
									</div>
								  </div>
								</li>';
				
			}
			$strfilterhtml.=' <li>
			<a class="firstlevel-collpase" href="#">'.$f['attributename'].'</a> 
			<a aria-controls="'.$helper->generateslug($f['attributecode']).'" aria-expanded="true" class="collapse-trigger" data-toggle="collapse" href="#'.$helper->generateslug($f['attributecode']).'" role="button"></a>
			<div aria-expanded="true" class="collapse in" id="'.$helper->generateslug($f['attributecode']).'" style="">
				<div class="well">
				<div class="filterlist">';
				
			$strfilterhtml.=' <div>
				<input type="checkbox" onclick="fnAttrChanged();"   name="attr[]" id="'.$f['attributeid'].'_'.$f['dropdown_id'].'" value="'.$f['dropdown_id'].'" >
				<label for="'.$f['attributeid'].'_'.$f['dropdown_id'].'">'.$f['dropdown_values'].'</label>
			 </div>	';
		}
		else{
			$strfilterhtml.=' <div>
				<input type="checkbox" onclick="fnAttrChanged();" name="attr[]" id="'.$f['attributeid'].'_'.$f['dropdown_id'].'"  value="'.$f['dropdown_id'].'" >
				<label for="'.$f['attributeid'].'_'.$f['dropdown_id'].'">'.$f['dropdown_values'].'</label>
			 </div>	';
			
		}
	  $prevattrid=$f['attributeid'];		
	}
	if($prevattrid!='')
			{
				$strfilterhtml.='	 </div>
									</div>
								  </div>
								</li>';
				
			}
	echo $strfilterhtml; 		
	
?>
  </ul>
</div>
<?php } ?>
