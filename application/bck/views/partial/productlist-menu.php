	<div class="row">
		<div class="col-sm-12">		
			<div class="row">
			<div class="col-sm-12">
			<p class="filter-text1">Price</p>
				<!--<div id="price-container"></div>
				<div id="range-label"></div> -->
				
				 <div class="pricerange-wraper">  <a aria-controls="pricefilter1" aria-expanded="true" class="collapse-trigger" data-toggle="collapse" href="#pricefilter1" role="button"></a>
				  <div aria-expanded="true" class="collapse in" id="pricefilter1" style="">
					<div class="well">
					  <div class="price-range-block">
						<div id="slider-range" class="price-filter-range" name="rangeInput"></div>
						<div>
						  <input type="hidden" id="minval" value="<?php echo !empty($fliter_price['minprice'])? floor($fliter_price['minprice']):'0'; ?>" />
						  <input type="hidden" id="maxval" value="<?php echo !empty($fliter_price['maxprice'])? ceil($fliter_price['maxprice']):'0'; ?>" />
						  <input disabled type="text" id="min_price" name="min_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'min_price');" />
						  <span>to</span>
						  <input disabled type="text"  id="max_price" name="max_price" class="price-range-field"  onBlur="pricevaluechange(this.value,'max_price');" />
						</div>
					  </div>
					</div>
				  </div>
			</div> 
			
                 <?php
if($pagename=='productlist'){
	$subcat=array();
	//$catid='0';
	if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
   $helper->subCategories($catid,$subcat);
 //print_r($subcat); die();
  if(count($subcat)>0){

?>

 

<div class="clearfix"></div>
			<div class="filter-text1 mt-4">Categories</div>

<!--
						<select class="form-control select2 select2-hidden-accessible" autocomplete="false" name="categoryID" onchange="fnCategoryChanged(this.value);" id="sel1" tabindex="-1" aria-hidden="true">
					<option value="0" >Category</option>-->
                    
                  
 					<?php
						$temparrlist=array();
					//	$strcatefilter="";
						$prevparent="";
						$Issubcatl1=0;
						foreach($subcat as $fcatid=>$sub)
						{
							
							
									foreach($sub as $subcatid=>$subplus)
									{
										// echo "<pre>";
										// print_r($sub); die();
										//print_r($subcat[$subplus['categoryID']]); die();
										if($subcat[$subplus['categoryID']]>0)
										{
											
											/* if($Issubcatl1==1)
											 {
												$strcatefilter.='';
											 }
											 else
											 {
												 $strcatefilter.=''; 
											 }*/
											 $arrpath=array();
											 $helper->getProductPath($subplus['categoryID'],$arrpath);
											 $path=BASE_URL;
											 for($j=count($arrpath)-1;$j>=0;$j--)
												 $path.=$arrpath[$j].'/';	
												$path=trim($path,'/');
												?>
                                                
												<div class="custom-control custom-checkbox mt-3">
						<input id="category<?php echo $subplus['categoryID'];?>" type="checkbox"  onchange="fnAttrChanged()"  name="subcatid[]" class="custom-control-input" value="<?php echo $subplus['categoryID'];?>">
						<label class="custom-control-label" for="category<?php echo $subplus['categoryID'];?>"><?php echo $subplus['categoryName'];?></label>
					</div>
					<?php
									//		 $strcatefilter.='	<input type="checkbox" name="categoryID[]" onchange="fnCategoryChanged(this.value);"  value="'.$subplus['categoryID'].'">';
										//	 $strcatefilter.=' <option value="'.$subplus['categoryID'].'" ><strong>'.$subplus['categoryName'].'</strong></option>';
											 
											
														
											$Issubcatl1=0;	
											$Issubcatl2=0;	
												foreach($subcat[$subplus['categoryID']] as $lastcatid=>$subplus1)
												{	
													 $arrpath=array();
													 $helper->getProductPath($subplus1['categoryID'],$arrpath);
													 $path=BASE_URL;
													 
													 // echo "<pre>";
													
													 
													 for($j=count($arrpath)-1;$j>=0;$j--)
														 $path.=$arrpath[$j].'/';	
														$path=trim($path,'/');
											?>
                                            <div class="custom-control custom-checkbox mt-3">
						<input id="category<?php echo $subplus1['categoryID'];?>" type="checkbox" onchange="fnAttrChanged()" name="subcatid[]" class="custom-control-input" value="<?php echo $subplus1['categoryID'];?>">
						<label class="custom-control-label" for="category<?php echo $subplus1['categoryID'];?>"><?php echo $subplus1['categoryName'];?></label>
					</div>
                    <?php // $strcatefilter.='	<input type="checkbox" name="categoryID[]" onchange="fnCategoryChanged(this.value);"  value="'.$subplus1['categoryID'].'">';
											// $strcatefilter.=' <option value="'.$subplus1['categoryID'].'" ><span class="bppad">'.$subplus1['categoryName'].'</span></option>';
														
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
                                                    <div class="custom-control custom-checkbox mt-3">
						<input id="category<?php echo $subplus['categoryID'];?>" type="checkbox"  onchange="fnAttrChanged()"  name="subcatid[]" class="custom-control-input" value="<?php echo $subplus['categoryID'];?>">
						<label class="custom-control-label" for="category<?php echo $subplus['categoryID'];?>"><?php echo $subplus['categoryName'];?></label>
					</div>
                                                    <?php
                                                    //$strcatefilter.='	<input type="checkbox" name="categoryID[]" onchange="fnCategoryChanged(this.value);"  value="'.$subplus['categoryID'].'">';
													// $strcatefilter.=' <option value="'.$subplus['categoryId'].'" >----'.$subplus['categoryName'].'</option>'; 
											
											}
									}
							}
						}
						echo $strcatefilter.''; 
						
					?>
                 
			</div></div>	 
		
  <?php } ?>
<?php }
?>

				<!--<div class="category-filter">
					<div class="custom-control custom-checkbox mt-3">
						<input id="category1" type="checkbox" class="custom-control-input">
						<label class="custom-control-label" for="category1">Category 1</label>
					</div>
					<div class="custom-control custom-checkbox mt-3">
						<input id="category2" type="checkbox" class="custom-control-input">
						<label class="custom-control-label" for="category2">Category 2</label>
					</div>
					<div class="custom-control custom-checkbox mt-3">
						<input id="category3" type="checkbox" class="custom-control-input">
						<label class="custom-control-label" for="category3">Category 3</label>
					</div>
				</div>-->
			 		
		</div>
   
