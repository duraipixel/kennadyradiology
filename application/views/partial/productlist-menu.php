			
				<!-- <div class="categories-dropdown dropdown">
					  <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <span class="flaticon-menu-1"></span>
						Categories
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					  </div>
				  </div>
			-->
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
  if(count($subcat)>0){

?>

 

<div class="clearfix"></div>
<div class="categories-dropdown dropdown">
					  <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <span class="flaticon-menu-1"></span>
						Categories
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
 
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
                                                
											<a class="dropdown-item" href="#">	<div class="custom-control custom-checkbox">
						<input id="category<?php echo $subplus['categoryID'];?>" type="checkbox"  onchange="fnAttrChanged()"  name="subcatid[]" class="custom-control-input" value="<?php echo $subplus['categoryID'];?>">
						<label class="custom-control-label" for="category<?php echo $subplus['categoryID'];?>"><?php echo $subplus['categoryName'];?></label>
					</div></a>
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
                                           <a class="dropdown-item" href="#"> <div class="custom-control custom-checkbox">
						<input id="category<?php echo $subplus1['categoryID'];?>" type="checkbox" onchange="fnAttrChanged()" name="subcatid[]" class="custom-control-input" value="<?php echo $subplus1['categoryID'];?>">
						<label class="custom-control-label" for="category<?php echo $subplus1['categoryID'];?>"><?php echo $subplus1['categoryName'];?></label>
					</div></a>
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
                                                  <a class="dropdown-item" href="#">  <div class="custom-control custom-checkbox">
						<input id="category<?php echo $subplus['categoryID'];?>" type="checkbox"  onchange="fnAttrChanged()"  name="subcatid[]" class="custom-control-input" value="<?php echo $subplus['categoryID'];?>">
						<label class="custom-control-label" for="category<?php echo $subplus['categoryID'];?>"><?php echo $subplus['categoryName'];?></label>
					</div></a>
                                                    <?php
                                                    //$strcatefilter.='	<input type="checkbox" name="categoryID[]" onchange="fnCategoryChanged(this.value);"  value="'.$subplus['categoryID'].'">';
													// $strcatefilter.=' <option value="'.$subplus['categoryId'].'" >----'.$subplus['categoryName'].'</option>'; 
											
											}
									}
							}
						}
						echo $strcatefilter.''; 
						
					?>
                 
		   </div>
				  </div>
		
  <?php } 
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
<span class="pricerange-text">Price Range</span>
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