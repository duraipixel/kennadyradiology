
<?php
if($pagename=='productlist'){
	$subcat=array();
   $helper->subCategories($catid,$subcat);
 // echo "<pre>";
 // print_r($subcat); die();
  if(count($subcat)>0){
?>

<div class="categorylist-wraper">
<ul class="collapsemenu">
		<li>
			<a class="firstlevel-collpase" href="javascript:void(0);"><?php echo $catid=='0'?'Categories':$catinfo['categoryName']; ?></a> 
			<a aria-controls="collapseMenu1" aria-expanded="true" class="collapse-trigger" data-toggle="collapse" href="#collapseMenu1" id="flexible-packaging" role="button"></a>
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
										// echo "<pre>";
										// print_r($sub); die();
										//print_r($subcat[$subplus['categoryID']]); die();
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
													 
													 // echo "<pre>";
													// print_r($subplus1); die();
													 
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

<?php
//echo "<pre>";
//print_r($fliter_list); die();

?>

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
	<!--<li>
			<a class="firstlevel-collpase" href="#">Occasions</a> 
			<a aria-controls="filterMenu1" aria-expanded="true" class="collapse-trigger" data-toggle="collapse" href="#filterMenu1" role="button"></a>
			<div aria-expanded="true" class="collapse in" id="filterMenu1" style="">
				<div class="well">
				
				
				<div class="filterlist">
			                     <div>
			                     	<input type="checkbox" id="chk10" >
    							 	<label for="chk10">Anniversary</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk11" >
    							 	<label for="chk11">Birthday</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk12" >
    							 	<label for="chk12">Christmas</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk13" >
    							 	<label for="chk13">Farewell</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk14" >
    							 	<label for="chk14">Mother's Day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk15" >
    							 	<label for="chk15">Valentine's Day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk16" >
    							 	<label for="chk16">Women's Day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk17" >
    							 	<label for="chk17">Wedding & Engagment</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk18" >
    							 	<label for="chk18">Independence day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk19" >
    							 	<label for="chk19">House Warming</label>
			                     </div>
			            	</div>
					
					</div>
				</div>
		</li>
		<li>
			<a class="firstlevel-collpase" href="#">Festivels</a> 
			<a aria-controls="filterMenu2" aria-expanded="true" class="collapse-trigger collapsed" data-toggle="collapse" href="#filterMenu2" role="button"></a>
			<div aria-expanded="true" class="collapse" id="filterMenu2" style="">
				<div class="well">
				
				
				<div class="filterlist">
			                     <div>
			                     	<input type="checkbox" id="chk10" >
    							 	<label for="chk10">Anniversary</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk11" >
    							 	<label for="chk11">Birthday</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk12" >
    							 	<label for="chk12">Christmas</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk13" >
    							 	<label for="chk13">Farewell</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk14" >
    							 	<label for="chk14">Mother's Day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk15" >
    							 	<label for="chk15">Valentine's Day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk16" >
    							 	<label for="chk16">Women's Day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk17" >
    							 	<label for="chk17">Wedding & Engagment</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk18" >
    							 	<label for="chk18">Independence day</label>
			                     </div>
			                     <div>
			                     	<input type="checkbox" id="chk19" >
    							 	<label for="chk19">House Warming</label>
			                     </div>
			            	</div>
					
					</div>
				</div>
		</li> -->
	</ul>
</div>
<?php } ?>
	