<?php
class common_function extends Model {
	
	function html_cut($text, $max_length)
	{
		$tags   = array();
		$result = "";

		$is_open   = false;
		$grab_open = false;
		$is_close  = false;
		$in_double_quotes = false;
		$in_single_quotes = false;
		$tag = "";

		$i = 0;
		$stripped = 0;

		$stripped_text = strip_tags($text);

		while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length)
		{
			$symbol  = $text{$i};
			$result .= $symbol;

			switch ($symbol)
			{
			   case '<':
					$is_open   = true;
					$grab_open = true;
					break;

			   case '"':
				   if ($in_double_quotes)
					   $in_double_quotes = false;
				   else
					   $in_double_quotes = true;

				break;

				case "'":
				  if ($in_single_quotes)
					  $in_single_quotes = false;
				  else
					  $in_single_quotes = true;

				break;

				case '/':
					if ($is_open && !$in_double_quotes && !$in_single_quotes)
					{
						$is_close  = true;
						$is_open   = false;
						$grab_open = false;
					}

					break;

				case ' ':
					if ($is_open)
						$grab_open = false;
					else
						$stripped++;

					break;

				case '>':
					if ($is_open)
					{
						$is_open   = false;
						$grab_open = false;
						array_push($tags, $tag);
						$tag = "";
					}
					else if ($is_close)
					{
						$is_close = false;
						array_pop($tags);
						$tag = "";
					}

					break;

				default:
					if ($grab_open || $is_close)
						$tag .= $symbol;

					if (!$is_open && !$is_close)
						$stripped++;
			}

			$i++;
		}

		while ($tags)
			$result .= "</".array_pop($tags).">";

		return $result;
	}
		

	function getStoreConfig()
	{
		$qryconfig="SELECT  cnfg.key, cnfg.value  FROM ".TPLPrefix."configuration cnfg 
					WHERE cnfg.IsActive <>2   ";

		$resinfo=$this->get_rsltset($qryconfig);
		
		$GLOBALS['allcon']=$resinfo;
 
		 $GLOBALS['allcategories'] = $this->get_rsltset("SELECT c.*, group_concat(DISTINCT i.catimage
        ORDER BY i.ordering ASC  SEPARATOR '|') as catimage ,group_concat(DISTINCT mi.mobimage
        ORDER BY mi.ordering ASC  SEPARATOR '|') as mobilcatimage ,
 (if(pc.product_catiid is not null,count(pc.product_catiid),'0')+ifnull(l2.cnt,'0')+ifnull(l1.cnt,'0')) as pcnt 

 FROM ".TPLPrefix."category c left join ".TPLPrefix."categoryimage i on i.categoryID=c.categoryID and i.IsActive = 1
 left join ".TPLPrefix."category_mobimage mi on mi.categoryID=c.categoryID and mi.IsActive = 1
 LEFT JOIN ".TPLPrefix."product_categoryid pc
        ON pc.categoryID = c.categoryID AND pc.IsActive = 1
     LEFT JOIN
     (SELECT t1.parentId, t1.cnt
      FROM (SELECT parentId, sum(cnt) AS cnt
            FROM (SELECT if(pc.product_catiid IS NOT NULL,
                            count(pc.product_catiid),
                            '0')
                            AS cnt,
                         c.categoryID,
                         c.parentId
                  FROM ".TPLPrefix."category c
                       INNER JOIN ".TPLPrefix."product_categoryid pc
                          ON pc.categoryID = c.categoryID AND pc.IsActive = 1
                  GROUP BY c.categoryID) t
            GROUP BY parentId) t1
           INNER JOIN ".TPLPrefix."category c1
              ON c1.categoryID = t1.parentId AND c1.IsActive = 1) l2
        ON l2.parentId = c.categoryID
     LEFT JOIN
     (SELECT c2.categoryID, sum(t2.cnt) AS cnt
      FROM (SELECT t1.parentId AS categoryID, t1.cnt, c1.parentId
            FROM (SELECT parentId, sum(cnt) AS cnt
                  FROM (SELECT if(pc.product_catiid IS NOT NULL,
                                  count(pc.product_catiid),
                                  '0')
                                  AS cnt,
                               c.categoryID,
                               c.parentId
                        FROM ".TPLPrefix."category c
                             INNER JOIN ".TPLPrefix."product_categoryid pc
                                ON     pc.categoryID = c.categoryID
                                   AND pc.IsActive = 1
                        GROUP BY c.categoryID) t
                  GROUP BY parentId) t1
                 INNER JOIN ".TPLPrefix."category c1
                    ON c1.categoryID = t1.parentId AND c1.IsActive = 1) t2
           INNER JOIN ".TPLPrefix."category c2
              ON c2.categoryID = t2.parentId AND c2.IsActive = 1
      GROUP BY c2.categoryID) l1
        ON l1.categoryID = c.categoryID
 
 WHERE c.IsActive = 1 and c.lang_id = '".$_SESSION['lang_id']."' group by c.categoryCode HAVING pcnt > 0 order by c.sortingOrder,c.categoryID ");
 
		
	}

	function getStoreConfigvalue($searchtext)
		{	
		 foreach ($GLOBALS['allcon'] as $arr) {
				
				   if (strtolower($arr["key"])==strtolower($searchtext)) {				 	
						 return $arr["value"];
				}			
			 }
		   return '';	
		}
		
		function searchkeyvalue($searchtext,$arrays,$fieldname="key",$returnvalue="value")
		{
			
			 foreach ($arrays as $arr) {
				 
				   if (strtolower($arr[$fieldname])==strtolower($searchtext)) { 
						 return $arr[$returnvalue];
				}
				//die();
			 }
		   return '';	
		}

		function searchkeyArray($searchtext,$arrays,$fieldname="key")
		{
			 foreach ($arrays as $arr) {
				   if (strtolower($arr[$fieldname])==strtolower($searchtext)) { 
						 return $arr;
				}
				//die();
			 }
		   return '';	
		}

		function searchkeyArrays($searchtext,$arrays,$fieldname="key")
		{
			$arraylist=array();
			 foreach ($arrays as $arr) {
				
				   if (strtolower($arr[$fieldname])==strtolower($searchtext)) { 
						$arraylist[]=$arr;
				}
			 }
		   return $arraylist;	
		}


		function getdateFormat($date)
		{
			$datetimezone=$this->getStoreConfigvalue("dateFormat");

		try{
			switch($datetimezone)
			{
			
			case "1":
			
			$changedate = date('Y-m-d',strtotime($date));
			
			break;
			
			case "2":
			  $date = str_replace('-', '/', $date);
			  $changedate = date('Y-m-d',strtotime($date));
			break;
			
			case "3":
				
			  $changedate = date('Y-m-d',strtotime($date));
			break;
			
			case "4":
			  $date = str_replace('/', '-', $date);
			  $changedate = date('Y-m-d',strtotime($date));
			  
			break;
			
			default:
				$changedate =  $date;
				
			}
		  }
			catch(Exception $e) {
					$changedate = '';
			}
		
			return $changedate;
		}
		
	function getdisplayblock($blockcode="''")
	{		
		$blockcode=$this->real_escape_string($blockcode);
			 $str_all="select * from ".TPLPrefix."cms_block where  IsActive =1 and cms_blogslug=? limit 0,1 " ; 			
			$result=$this->get_a_line_bind($str_all,array($blockcode));		
		//print_r($result['front_content']); 
		return $result['front_content'];
	}
	
function getSelectBox_CustomFieds($SelName, $Attr,$AttributeID,$selId=null) {	
	$AttributeID=$this->real_escape_string($AttributeID);	
	 $StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."formbuilderdgsn_attrvalues where IsActive = '1' and AttributeId=? order by SortBy asc  ";	
	
	$resQry = $this->get_rsltset_bind($StrQry,array($AttributeID));		
	$strSelHtml =  "<select class='form-control ".$Attr."' name='".$SelName.$AttributeID."' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getCheckBox_CustomFieds( $SelName, $Attr,$AttributeID,$selId=null) {
	
	$chk_listarray = explode(",",$selId); 
	$AttributeID=$this->real_escape_string($AttributeID);	
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId=? order by SortBy asc  ";	
	$resQry = $this->get_rsltset_bind($StrQry,array($AttributeID));
	$strSelHtml = "";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {			
			$chek='';
			if (in_array($val['Id'], $chk_listarray)) {
				$chek = 'checked';
			}			
			
			$strSelHtml=$strSelHtml.'<div class="checkbox icheck ">
							<label class="m-t-6">
							  <input '.$sel.' class="minimal" type="radio" name="'.$SelName.$AttributeID.'" value="'.$val['Id'].'" />
							  <span class="checkbox-material">
										<span class="check"></span>
									</span>
								'.$val['Name'].'
							</label>
						  </div>';
		}
	}
	
	return $strSelHtml;	
}

function getRadioBox_CustomFieds( $SelName, $Attr,$AttributeID,$selId=null) {
	$AttributeID=$this->real_escape_string($AttributeID);	
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId=? order by SortBy asc  ";	
	$resQry = $this->get_rsltset_bind($StrQry,array($AttributeID));
	$strSelHtml = "";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			$sel='';
			if($selId==$val['Id'])
				$sel=' checked ';
			
			$strSelHtml=$strSelHtml.'<div class="radio radio-primary m-t-6">
	<label class="m-t-6">
	<input '.$sel.' class="minimal" type="radio" name="'.$SelName.$AttributeID.'" value="'.$val['Id'].'" />
	<span class="circle"></span><span class="check "></span>
	'.$val['Name'].'
	</label>
</div>';
		}
	}
	
	return $strSelHtml;	
}


function getMultiSelectBox_CustomFieds( $SelName, $Attr,$AttributeID,$selId=null) {	
    $chk_listarray = explode(",",$selId); 
	$AttributeID=$this->real_escape_string($AttributeID);	
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."customfields_attrvalues where IsActive = '1' and AttributeId=? order by SortBy asc  ";	
	$resQry = $this->get_rsltset_bind($StrQry,array($AttributeID));		
	$strSelHtml =  "<select multiple='multiple' class='form-control ".$Attr."' name='".$SelName.$AttributeID."[]' ><option value=''>Select</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if (in_array($val['Id'], $chk_listarray)) {
				$sel=' selected="selected" ';
			}	
			
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	
	$strSelHtml=$strSelHtml."</select>";
	
	return $strSelHtml;	
}

function getSelectBox_countrylist_To_cus_address($Selbx_Name, $selId=null) {
	
	$StrQry="select countryid AS Id,countryname AS Name from ".TPLPrefix."country where IsActive=1 and countryid=1 order by countryname asc";		
	$resQry = $this->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2' id='".$Selbx_Name."' name='".$Selbx_Name."' onchange=' getstate(this.value); ' required='' >
	<option value=''>".countryname."</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}	
	$strSelHtml=$strSelHtml."</select>";	
	return $strSelHtml;	
}

function getSelectBox_state_To_cus_address($Selbx_Name,$countryid, $selId=null) {
	$countryid=$this->real_escape_string($countryid);
	$StrQry="select stateid AS Id,statename AS Name from  ".TPLPrefix."state where IsActive=1 and countryid=? order by statename asc";
	$resQry = $this->get_rsltset_bind($StrQry,array($countryid));		
	$strSelHtml =  "<select class='form-control select2' id='".$Selbx_Name."' name='".$Selbx_Name."'  required='' >
	<option value=''>".statename."</option>";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}	
	$strSelHtml=$strSelHtml."</select>";	
	return $strSelHtml;	
}


function getSelectBox_displaymastertable($AttributeName,$ValueCoumn,$ColumnName,$tablesname,$selId='1',$attr='',$class='',$afterscript,$additionalcond='') {	
     
	$cond='';
 //   $cond=" and countryid='".$selId."' ";
     //echo $attr; exit;
	 
	// if(!empty($selId))
	//	 $cond=" and ".$ValueCoumn."=".$selId." "; 
	 
	$StrQry="select ".$ValueCoumn." AS Id,".$ColumnName." AS Name from ".TPLPrefix.$tablesname." where IsActive=1 ".$cond." ".$additionalcond." ";
	//echo $StrQry; exit;
	$resQry = $this->get_rsltset($StrQry);	
    //echo "<pre>"; print_r($resQry);	
	$strSelHtml =  "<select data-placeholder='select' class='form-control  ".$class."' ".$attr." id='".$AttributeName."' name='".$AttributeName."[]' required='' >
				<option value='-1'>".$AttributeName."</option>
	";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml.="<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}		
	}	
	$strSelHtml.="</select>";	
	
	$strSelHtml.=$afterscript;
	
	return $strSelHtml;	
}


function getRadioBox_FormFieds( $SelName, $Attr,$AttributeID,$selId=null) {
	$AttributeID=$this->real_escape_string($AttributeID);	
	$StrQry="select AttributeOptionId AS Id, AttributeValue AS Name from ".TPLPrefix."formbuilderdgsn_attrvalues where IsActive = '1' and AttributeId=? order by SortBy asc  ";	
	$resQry = $this->get_rsltset_bind($StrQry,array($AttributeID));
	$strSelHtml = "";
	
	if(!empty($resQry)) {
		foreach($resQry as $val) {
			$sel='';
			if($selId==$val['Id'])
				$sel=' checked ';
			
			$strSelHtml=$strSelHtml.'<div class="radio radio-primary m-t-6">
	<label class="m-t-6">
	<input '.$sel.' class="minimal" type="radio" name="'.$SelName.$AttributeID.'" value="'.$val['Id'].'" />
	<span class="circle"></span><span class="check "></span>
	'.$val['Name'].'
	</label>
</div>';
		}
	}
	
	return $strSelHtml;	
}


	function displaymenu_old($activemenu='home')
	{
		
		$rslt_getfrontmenus = $this->get_rsltset("select * from ".TPLPrefix."forntmenu where 1=1 and IsActive =1 order by sortingorder asc ");
		$rslt_calegorylist = $GLOBALS['allcategories'];
		
		
		$subhtml='';
		$isdropdown='';
		/*<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'aboutus">About Us</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li>
		<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'media">Media</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li> 
	</li>
		<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'contactus">Contact Us</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li> */
		$menuhtml='<ul class="navbar-nav ml-auto">';
		$menuhtml.='
		<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'">Home</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li>
	

	';
	
		
		
		foreach($rslt_getfrontmenus as $rslt_getfrontmenus_S){
			$isdropdown='';
			$isactive='';
			$menulink='<a href="'.BASE_URL.'">';
		
			switch($rslt_getfrontmenus_S['f_menutype'])
			{
			   case "1":
							
			   
							break;
			   case "2":
						   
			   	
						
							break;
			   case "3":
							$catinfo=$this->searchkeyArray($rslt_getfrontmenus_S['f_link_id'],$rslt_calegorylist,"categoryID");
							$subcat=$this->searchkeyArrays($rslt_getfrontmenus_S['f_link_id'],$rslt_calegorylist,"parentId");
							//echo "<pre>";
						
							if($activemenu==$catinfo['categoryCode'] && trim($activemenu," ")!="" )
								$isactive=' active';
							
							if($activemenu=="products")
								$isactive=' active';
							
							$resactivemenu=$this->searchkeyArray($activemenu,$subcat,$fieldname="categoryCode");
							
							if( $resactivemenu['categoryCode']!="" )
								$isactive=' active';
							
							if(count($subcat)>0)
							{
								$isdropdown='dropdown';
								$subhtml='<ul class="dropdown-menu fullwidth-dropdown">
											<li>
												<div class="container">
													<div class="menulist-group">
														<div class="menugroup-inner">';
														if($catinfo['categoryCode'] != ''){
								$menulink='<a class="nav-link dropdown-toggle" href="'.BASE_URL.$catinfo['categoryCode'].'" >';
														}else{
								$menulink='<a class="nav-link dropdown-toggle" href="'.BASE_URL.'products">';
														}
								foreach($subcat as $sub)
								{
									$baseimgurl=BASE_URL.'static/images/noimage.jpg'; 
											 if($sub['catimage']!=''){
												 $imgs=explode("|",	$sub['catimage']);
												  $baseimgurl=BASE_URL.'uploads/category/'.$sub['categoryID']."/photos/menu/".$imgs['0'];
											 }
									
									 $subhtml.='<div class="menuinner">
									<div class="category-title"><a data-img="'.$baseimgurl.'" href="'.BASE_URL.'products'.$catinfo['categoryCode'].'/'.$sub['categoryCode'].'">'.$sub['categoryName'].'</a></div>';
									$subcatplus=$this->searchkeyArrays($sub['categoryID'],$rslt_calegorylist,"parentId");
									if(count($subcatplus)>0)
									{   $subhtml.='<ul class="customdropdown">';
										foreach($subcatplus as $plus)
										{
											 $baseimgurl=BASE_URL.'static/images/noimage.jpg'; 
											 if($plus['catimage']!=''){
												 $imgs=explode("|",	$plus['catimage']);
												  $baseimgurl=BASE_URL.'uploads/category/'.$plus['categoryID']."/photos/menu/". $imgs['0'];
											 }
											$subhtml.='<li>
														<a class="nav-link menuitem" href="'.BASE_URL.$catinfo['categoryCode'].''.$sub['categoryCode'].'/'.$plus['categoryCode'].'" data-img="'.$baseimgurl.'">'.$plus['categoryName'].'</a>
														</li>';
														
										}
										 $subhtml.='</ul>';
									}
									$subhtml.='</div>';
								}
								$subhtml.='</div>
														</div>
														
														<div class="hoverimg-wraper">
															<div class="hoverimg-outer">
																<div class="menucat-image">
																<span><a class="nav-link" href="'.BASE_URL.$catinfo['categoryCode'].'">'.$catinfo['categoryName'].'</a></span>
																
																</div>
																<div>
																 
															</div>
															</div>
														</div>
														
														
													</div>
													
												</li>
											  </ul>';
							}
							else{
								$menulink='<a class="nav-link" href="'.BASE_URL.$catinfo['categoryCode'].'">';
								
							}
							
						
							break;
			   case "4":														
							if($activemenu==$rslt_getfrontmenus_S['f_link_name'])
								$isactive=' active';
							if($rslt_getfrontmenus_S['f_link_name']=="home" && trim($activemenu," ")=="")
							{							
								$isactive=' active';
							}
							
							if (strpos($rslt_getfrontmenus_S['f_link_name'], 'http://') === false) {
								
									$menulink='<a class="nav-link" href="'.BASE_URL.$rslt_getfrontmenus_S['f_link_name'].'">';
							}
							else
							{
								if($rslt_getfrontmenus_S['f_link_name']!="home")
								{
									$menulink='<a class="nav-link" href="'.$rslt_getfrontmenus_S['f_link_name'].'">';
								}
								else
								   $menulink='<a class="nav-link" href="'.BASE_URL.'">';
							}
							break;
			}
			$clshidemobile='';
			//if($rslt_getfrontmenus_S['f_menutype']=='4')
					//$clshidemobile=' hidemenumobile ';

			$menuhtml.='<li class="'.$isdropdown.$isactive.$clshidemobile.'">'.$menulink.$rslt_getfrontmenus_S['f_menuname'].'</a><span  class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>';
			$menuhtml.=$subhtml;
			$menuhtml.='</li>';
		}
	/*	$menuhtml.='
		<li class="menumobileoption"><a href="'.BASE_URL.'contactus">Contact Us</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li> 
	';  */
		 $menuhtml.='</ul>';
		 
		 
		return $menuhtml;
		
		
	} 
	
		function displaymenu($activemenu='home')
	{
		
		 $rslt_getfrontmenus = $this->get_rsltset("select * from ".TPLPrefix."forntmenu where 1=1 and IsActive =1 and lang_id= '".$_SESSION['lang_id']."' order by sortingorder asc ");
		$rslt_calegorylist = $GLOBALS['allcategories'];
		
		
		$subhtml='';
		$isdropdown='';
		/*<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'aboutus">About Us</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li>
		<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'media">Media</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li> 
	</li>
		<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'contactus">Contact Us</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li> 	<li class="nav-item"><a class="nav-link" href="'.BASE_URL.'">Home</a></a>
	</li>*/
		$menuhtml=' <ul class="navbar-nav navbar-light">';
		$menuhtml.='
	
	

	';
	
		
		
		foreach($rslt_getfrontmenus as $rslt_getfrontmenus_S){
			$isdropdown='';
			$subhtml='';
			$isactive='';
			$catimg = '';
		 
			$menulink='<a href="'.BASE_URL.'">';
		
			switch($rslt_getfrontmenus_S['f_menutype'])
			{
			   case "1":
							
			   
							break;
			   case "2":
						   
			   	
						
							break;
			   case "3":
			   			   						
							$catinfo=$this->searchkeyArray($rslt_getfrontmenus_S['f_link_id'],$rslt_calegorylist,"categoryID");
							$subcat=$this->searchkeyArrays($rslt_getfrontmenus_S['f_link_id'],$rslt_calegorylist,"parentId");
							// echo "<pre>";
							//print_r($catinfo); 
						//echo $activemenu.'=='.$catinfo['categoryCode'];
							if($activemenu==$catinfo['categoryCode'] && trim($activemenu," ")!="" )
								$isactive=' active';
							
							if($activemenu=="products")
								$isactive=' active';
							
							$resactivemenu=$this->searchkeyArray($activemenu,$subcat,$fieldname="categoryCode");
							
							if( $resactivemenu['categoryCode']!="" )
								$isactive=' active';
							$arrow = '';
							if(count($subcat)>0)
							{
								if($catinfo['categorymenuimage'] != ''){
									$catimg=img_base_url.'category/categorymenuimage/'.$catinfo['categorymenuimage'];
								}else{
									$catimg=img_base_url.'noimage/photos/base/noimage.png';
								}
								$arrow='<i class="lni lni-chevron-down"></i>';
								$isdropdown='nav-item dropdown megamenu-li dmenu';
								/* <li class="product-image">  <a href="#" class="d-none">Sub Category</a><ul>
									<li><a href="'.BASE_URL.$catinfo['categoryCode'].'"> <img src="'.$catimg.'" class="img-fluid" alt=""> </a> </li>
									</ul>*/
						//$subhtml='<ul style="display: none; opacity:1;">';								
						$subhtml='<div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                                 <div class="row">
                                    <div class="col-sm-12">';
														if($catinfo['categoryCode'] != ''){
								$menulink='<a class="nav-link '.$active.'" href="'.BASE_URL.$catinfo['categoryCode'].'" id="dropdown01" aria-haspopup="true" aria-expanded="false"  href="'.BASE_URL.$catinfo['categoryCode'].'" >';
														}else{
								$menulink='<a class="nav-link '.$active.'" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="'.BASE_URL.'">';
														}
								foreach($subcat as $sub)
								{
									$baseimgurl=BASE_URL.'static/images/noimage.jpg'; 
											 if($sub['catimage']!=''){
												 $imgs=explode("|",	$sub['catimage']);
												  $baseimgurl=BASE_URL.'uploads/category/'.$sub['categoryID']."/photos/menu/".$imgs['0'];
											 }
											 if($sub['categorymenuimage'] != ''){
												 // <img src="'.img_base_url.'category/categorymenuimage/'.$sub['categorymenuimage'].'" class="img-fluid" alt="">
												  $subhtml.='<a class="dropdown-item" href="'.BASE_URL.$catinfo['categoryCode'].'/'.$sub['categoryCode'].'">'.$sub['categoryName'].'</a>';
											 }else{
												 $subhtml.='<a class="dropdown-item" href="'.BASE_URL.$catinfo['categoryCode'].'/'.$sub['categoryCode'].'">'.$sub['categoryName'].'</a>'; 
											 }
									
									
									$subcatplus=$this->searchkeyArrays($sub['categoryID'],$rslt_calegorylist,"parentId");
									if(count($subcatplus)>0)
									{   $subhtml.='<ul class="customdropdown">';
										foreach($subcatplus as $plus)
										{
											 $baseimgurl=BASE_URL.'static/images/noimage.jpg'; 
											 if($plus['catimage']!=''){
												 $imgs=explode("|",	$plus['catimage']);
												  $baseimgurl=BASE_URL.'uploads/category/'.$plus['categoryID']."/photos/menu/". $imgs['0'];
											 }
											  if($sub['categorymenuimage'] != ''){
												  //<img src="'.img_base_url.'category/categorymenuimage/'.$sub['categorymenuimage'].'" class="img-fluid" alt="">
											$subhtml.='<a class="dropdown-item" href="'.BASE_URL.$catinfo['categoryCode'].''.$sub['categoryCode'].'/'.$plus['categoryCode'].'">  </a> 
											
														 
														 ';
											  }else{
												  $subhtml.='<a class="dropdown-item" href="'.BASE_URL.$catinfo['categoryCode'].''.$sub['categoryCode'].'/'.$plus['categoryCode'].'"> </a> 
											
														 
														 ';
											  }
														
										}
										 $subhtml.='</div></div></div>';
									}
									//$subhtml.='</div>';
								}
								//</li>
								
								/*$subhtml.=' 
														<li>	<span><a class="nav-link" href="'.BASE_URL.$catinfo['categoryCode'].'">'.$catinfo['categoryName'].' </a></span></li>';*/
															
												
								 $subhtml.='</div></div></div>';
							}
							else{
								$isdropdown='nav-item dmenu';
								
								$menulink='<a class="nav-link" href="'.BASE_URL.$catinfo['categoryCode'].'">';
								
							}
							//print_r($subhtml); exit;
						
							break;
			   case "4":				
			   $isdropdown='nav-item dmenu';
							if($activemenu==$rslt_getfrontmenus_S['f_link_name'])
								$isactive=' active';
							if($rslt_getfrontmenus_S['f_link_name']=="home" && trim($activemenu," ")=="")
							{							
								$isactive=' active';
							}
							
							if (strpos($rslt_getfrontmenus_S['f_link_name'], 'http://') === false) {
								
									$menulink='<a class="nav-link" href="'.BASE_URL.$rslt_getfrontmenus_S['f_link_name'].'">';
							}
							else
							{
								if($rslt_getfrontmenus_S['f_link_name']!="home")
								{
									$menulink='<a class="nav-link" href="'.$rslt_getfrontmenus_S['f_link_name'].'">';
								}
								else
								   $menulink='<a class="nav-link" href="'.BASE_URL.'">';
							}
							break;
			}
			$clshidemobile='';
			//if($rslt_getfrontmenus_S['f_menutype']=='4')
					//$clshidemobile=' hidemenumobile ';
if($subhtml != ''){
			$menuhtml.='<li class="'.$isdropdown.$isactive.$clshidemobile.'">'.$menulink.$arrow.$rslt_getfrontmenus_S['f_menuname'].' <span class="dropdown-toggle"></span> </a>';
			$menuhtml.=$subhtml;
			$menuhtml.='</li>';
}else{
	$menuhtml.='<li class="'.$isdropdown.$isactive.$clshidemobile.'">'.$menulink.$arrow.$rslt_getfrontmenus_S['f_menuname'].' </a>';
			$menuhtml.=$subhtml;
			$menuhtml.='</li>';
}
		}
	/*	$menuhtml.='
		<li class="menumobileoption"><a href="'.BASE_URL.'contactus">Contact Us</a><span class="xsmenu-trigger" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span></a>
	</li> 
	';  */
		 $menuhtml.='</ul>';
		 
		 
		return $menuhtml;
		
		
	} 
	
	function calculateproductPrice($rate,$taxtype,$tax)
	{
		$total=$rate;
		switch($taxtype)
		{
			case "P" :
						$total=$rate+(($rate*$tax)/100);
						break;
			case "F" :
						$total=$rate-$tax;
						break;
			
		}
		return $total;
	} 
	function calculateproductDiscountPrice($rate,$taxtype,$tax,$specialprice,$spl_fromdate,$spl_todate,$prod_DiscountType,$prod_DiscountAmount,$cat_DiscountType,$cat_DiscountAmount,$cust_DiscountType,$cust_DiscountAmount,$deals_DiscountType,$deals_DiscountAmount)
	{
		$total=$rate;
		$sprice=0;
		$prod_price=0;
		$cat_price=0;
		$cust_price=0;
		switch($taxtype)
		{
			case "P" :
						$total=$rate+(($rate*$tax)/100);
						if(!empty($specialprice) && $specialprice!=''  && $specialprice!='0.00'){
						
							if(strtotime($spl_fromdate)<=strtotime(date('Y-m-d')) && strtotime($spl_fromdate)<=strtotime(date('Y-m-d')))
							{
								$sprice=$specialprice+($specialprice*$tax)/100;								
							}
						}
						if(!empty($deals_DiscountAmount) && $deals_DiscountAmount!='')
							switch($deals_DiscountType)
							{
								 case "1" :
																	
											$deals_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-(($rate*$deals_DiscountAmount)/100))*$tax)/100);
											
											break;
											
								 case "2" :
											$deals_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-$deals_DiscountAmount)*$tax)/100);;
											break;
							}						
						 if(!empty($prod_DiscountAmount) && $prod_DiscountAmount!='')
							switch($prod_DiscountType)
							{
								 case "1" :
											$prod_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-(($rate*$prod_DiscountAmount)/100))*$tax)/100);
											break;
											
								 case "2" :
											$prod_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-$prod_DiscountAmount)*$tax)/100);;
											break;
							}
						 if(!empty($cat_DiscountAmount) && $cat_DiscountAmount!='')
							switch($cat_DiscountType)
							{
								 case "1" :
											$cat_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-(($rate*$cat_DiscountAmount)/100))*$tax)/100);
											break;
											
								 case "2" :
											$cat_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-$cat_DiscountAmount)*$tax)/100);;
											break;
							}
						 if(!empty($cust_DiscountAmount) && $cust_DiscountAmount!='')
							switch($cust_DiscountType)
							{
								 case "1" :
											$cust_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-(($rate*$cust_DiscountAmount)/100))*$tax)/100);
											break;
											
								 case "2" :
											$cust_price=($rate-(($rate*$deals_DiscountAmount)/100))+((($rate-$cust_DiscountAmount)*$tax)/100);;
											break;
							}
							
						break;
			case "F" :
						$total=$rate-$tax;
						if(!empty($specialprice) && $specialprice!='' && $specialprice!='0.00'){
							if(strtotime($spl_fromdate)<=strtotime(date('Y-m-d')) && strtotime($spl_fromdate)<=strtotime(date('Y-m-d')))
							{
								$sprice=$specialprice-$tax;								
							}
						}
						 if(!empty($deals_DiscountAmount) && $deals_DiscountAmount!='')
							switch($deals_DiscountType)
							{
								 case "1" :
											$deals_price=($rate-(($rate*$deals_DiscountAmount)/100))-$tax;
											break;
											
								 case "2" :
											$deals_price=($rate-$deals_DiscountAmount)-$tax;
											break;
							}
						 if(!empty($prod_DiscountAmount) && $prod_DiscountAmount!='')
							switch($prod_DiscountType)
							{
								 case "1" :
											$prod_price=($rate-(($rate*$prod_DiscountAmount)/100))-$tax;
											break;
											
								 case "2" :
											$prod_price=($rate-$prod_DiscountAmount)-$tax;
											break;
							}
						 if(!empty($cat_DiscountAmount) && $cat_DiscountAmount!='')
							switch($cat_DiscountType)
							{
								 case "1" :
											$cat_price=($rate-(($rate*$cat_DiscountAmount)/100))-$tax;
											break;
											
								 case "2" :
											$cat_price=($rate-$cat_DiscountAmount)-$tax;
											break;
							}
						  if(!empty($cust_DiscountAmount) && $cust_DiscountAmount!='')
							switch($cust_DiscountType)
							{
								 case "1" :
											$cust_price=($rate-(($rate*$cust_DiscountAmount)/100))-$tax;
											break;
											
								 case "2" :
											$cust_price=($rate-$cust_DiscountAmount)-$tax;
											break;
							}
						break;
			
		}
		//print_r($total); die();
	
		$temptot=$total;
		
		if($temptot>$deals_price && $deals_price!=0)
		{				
			$temptot=$prod_price;
		}		
		else if($temptot>$sprice && $sprice!=0)
		{
			$temptot=$sprice;
		}
		else if($temptot>$prod_price && $prod_price!=0)
		{
			$temptot=$prod_price;
		}	
		else if($temptot>$cat_price && $cat_price!=0)
		{
			$temptot=$cat_price;
		}
		else if($temptot>$cust_price && $cust_price!=0)
		{
			$temptot=$cust_price;
		}
		$totpent=0;
		
		if($total>$temptot)
		{			
			$totpent=(($total-$temptot)/$total)*100;
			$total=$temptot;
		}
		
		return  array($total,$totpent);
	} 
	
	function getProductPath($catid,&$arrpath='')
	{
		
		foreach ($GLOBALS['allcategories'] as $arr) {
				 
				   if (strtolower($arr['categoryID'])==strtolower($catid)) { 
						if($arr['parentId']==0){
							$arrpath[]=$arr['categoryCode'];
						 return $arrpath;
						} 
						else{
							 $arrpath[]=$arr['categoryCode'];							
							 $this->getProductPath($arr['parentId'],$arrpath);							
						}
				}			
			 }
		   return '';	
		
	} 
	function getProductBread($catid,&$arrbread='')
	{
		
		foreach ($GLOBALS['allcategories'] as $arr) {
				 
				   if (strtolower($arr['categoryID'])==strtolower($catid)) { 
						if($arr['parentId']==0){
							$arrbread[]=array("name"=>$arr['categoryName'],"code"=>$arr['categoryCode']);
						 return $arrbread;
						} 
						else{
							 $arrbread[]=array("name"=>$arr['categoryName'],"code"=>$arr['categoryCode']);;							
							 $this->getProductBread($arr['parentId'],$arrbread);
						}
				}			
			 }
		   return '';	
		
	} 
	function subCategories($searchtext,&$subcat)
	{		//	echo "kk";echo $searchtext;exit;
	 //print_r($GLOBALS['allcategories']); exit;
		foreach ($GLOBALS['allcategories'] as $arr) {
			   if (strtolower($arr['parentId'])==strtolower($searchtext)) {
						$subcat[$searchtext][]=$arr;
						 $this->subCategories($arr['categoryID'],$subcat);
				}
		 }
	   return $subcat;	
	}
	
	function getsubCategories($searchtext,&$subcat)
	{			
		foreach ($GLOBALS['allcategories'] as $arr) {
			   if (strtolower($arr['parentId'])==strtolower($searchtext)) {
						$subcat[]=$arr;
						 $this->subCategories($arr['categoryID'],$subcat);
				}
		 }
	   return $subcat;	
	}
	
	function IsContainerSubcat($searchtext,$array)
	{
		foreach ($array as $arr) {
			   if (strtolower($arr['parentId'])==strtolower($searchtext)) {
				   return 1;
			   }
		}
		return 0;	
		
	}
	function generateslug($value){

		 $value = str_replace('—', '-', $value);
		 $value = str_replace('‒', '-', $value);
		 $value = str_replace('―', '-', $value);
		 $value = str_replace('_', '-', $value);
		 $value = str_replace(' ', '-', $value);
		 $accents   = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ',  'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',  'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ');
		 $noAccents = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'B', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'p', 'y');
	 	 $value = str_replace($accents, $noAccents, $value);
		 $value = preg_replace('/[^A-Za-z0-9-]+/', '', $value);
		 $value = strtolower($value);
		do {
		
			$value = str_replace('--', '-', $value);
		
		}
		while (mb_substr_count($value, '--') > 0);
		
		return $value;

	}
	function displayproductsilder($catid='',$type='',$title='',$viewall='',$limit='10',$productid='',$homeslidertitle='',$addclass='',$subtitle='')
	{
		
		if ( ($helper instanceof common_function) != true ) {	$helper=$this->loadHelper('common_function');} 
		$product=$this->loadModel('product_model');
		$commondisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'common');
		//echo $catid."kalai";
		$products=$product->productlists('',$catid,'','1',array("attr"=>''),$limit,'0',$type,$productid,$homeslidertitle);
		// echo "<pre>"; print_r($products); die();
		$template = $this->loadView('partial/productslider');
		$template->set('products', $products['prod_list']);	 
		$template->set('title',$title);
		$template->set('subtitle',$subtitle);
		$template->set('viewall',$viewall);
		$template->set('addclass',$addclass);
		$template->set('helper',$this);
		$template->set('commondisplaylanguage',$commondisplaylanguage);
		$template->render(); 
	}
	
	
	
	public function loadModel($name)
	{
		require_once(APP_DIR .'models/'. strtolower($name) .'.php');
		$modal = new $name;
		return $modal;
	}
	public function loadView($name)
	{	
		$view = new View($name);
		return $view;
	}
	public function pathrevise($arrpath)
	{	
		$path=BASE_URL;
		for($j=count($arrpath)-1;$j>=0;$j--)
		 $path.=$arrpath[$j].'/';
		$path=rtrim($path,"/");
		return $path;
	}
	public function displayDiscountSlap($colclass)
	{
		$product=$this->loadModel('product_model');
		$Discountslab=$product->Discountslab();
		$template = $this->loadView('partial/discountslap');
		$template->set('Discountslab',$Discountslab);
		$template->set('colclass',$colclass);
		$template->render();
	}
	
	public function displayattributecolor($id)
	{
	$id=$this->real_escape_string($id);	
	$select_pro_attri = "select Attribute_Name,Attribute_value_name,Attribute_price from ".TPLPrefix."orders_products_attribute where order_product_id=? ";
    $pro_attri_details=$this->get_rsltset_bind($select_pro_attri,array($id));
	 return $pro_attri_details;
	}
	public function getProducctAttribute_price($id)
	{
		$id=$this->real_escape_string($id);	
	$pro_attr_price = "select sum(Attribute_price) as amount from ".TPLPrefix."orders_products_attribute where order_product_id=? group by order_product_id";
	$attr_price=$this->get_rsltset_bind($pro_attr_price,array($id));
	echo $attr_price['amount']; exit;
	}		
	
	function chkDiscountSlap($grandtotal)
	{
		$product=$this->loadModel('checkout_model');
		$Discountslab=$product->chkDiscountSlap($grandtotal);
        return $Discountslab;
	}
	
	function encrpt_decrpt_data( $string, $action ) {
		
        $GLOBALS['secretkey']='EKxcgmNhagHZ5Qw4mSCW3z';
		$secret_key = $GLOBALS['secretkey']; 
		$finalkey = substr(hex2bin(hash( 'sha512', $secret_key )),0,15);

		$method = 'aes-128-ecb';
         
		 if( $action == 'e' ) {
			$output = base64_decode( openssl_encrypt($string, $method, $finalkey));
		$output =bin2hex( $output);
		}
		else if( $action == 'd' ){
		$string=hex2bin($string);	
			$output = openssl_decrypt(base64_encode($string) , $method, $finalkey);
		//echo $output; die();
		}
		if(empty($output) || $output==false)
		$output='';

		return $output;
    }
	
	function displayhomeslider($startpostion='',$endpostion='')
	{
	 
	  $conqry='';
		  if($startpostion!=='' && $endpostion!='')
			 $conqry = "	and sortby between '".$startpostion."' and '".$endpostion."' ";
		  else  if($startpostion !='' )
			 $conqry = "	and sortby >='".$startpostion."'  ";
		  else  if($endpostion !='' )
			 $conqry = "	and sortby <='".$endpostion."'  ";
	
 	$StrQry="select title,categoryid,hpsid,type,subtitle  from ".TPLPrefix."homepageslider where IsActive=1  ". $conqry." order by sortby asc ";	

		$resQry = $this->get_rsltset($StrQry);		
	
		return $resQry;	
	}	
	
	function displaysingle_product()
	{
	  $conqry='';
 	
		$StrQry="select *,pi.img_path from ".TPLPrefix."product p inner join ".TPLPrefix."product_images pi on pi.product_id = p.product_id and pi.IsActive = 1 where p.IsActive=1 and p.displayinhome = 1 order by p.product_id asc ";	
 
		$resQry = $this->get_a_line($StrQry);		
	
		return $resQry;	
	}	
	
	
	function displayhomesCategorylider($startpostion='',$endpostion='',$title='',$viewall='',$limit='10',$productid='',$homeslidertitle='',$addclass='' )
	{
		
	  $conqry='';
		  if($startpostion!=='' && $endpostion!='')
			 $conqry = "	and cs.sortby between '".$startpostion."' and '".$endpostion."' ";
		  else  if($startpostion !='' )
			 $conqry = "	and cs.sortby >='".$startpostion."'  ";
		  else  if($endpostion !='' )
			 $conqry = "	and cs.sortby <='".$endpostion."'  ";
	
		   $StrQry="SELECT group_concat(distinct hc.categoryID) as catid,
					group_concat(distinct hp.productid ) as prodid 
					FROM ib_homepagecatslider cs
					 INNER JOIN ib_homepagecatslider_category hc
					  ON hc.hpsid = cs.hpsid AND hc.IsActive = 1
					 
					   INNER JOIN ib_homepagecatslider_product hp
					  ON hp.hpsid = cs.hpsid AND hc.IsActive = 1
					  
					WHERE     cs.IsActive = 1 ";	
		
		
		$resQry = $this->get_a_line($StrQry);
		//print_r($GLOBALS['allcategories']);
		$catslist=array();		
		foreach(explode(",",$resQry['catid']) as $catid){
		 $catslist[]=$this->searchkeyArray($catid,$GLOBALS['allcategories'],"categoryID");
		}
		$catarr=explode(",",$resQry['catid']);
		$prodarr=explode(",",$resQry['prodid']);
		$product=$this->loadModel('product_model');
		
		$products=$product->productlists('','','','',array("attr"=>''),'','0','','','',$prodarr,$catarr);
		//echo "<pre>"; print_r($catslist); die();
		//echo "dfgfdg"; die();
		$template = $this->loadView('partial/categoryslider');
		
		
		$template->set('categorys', $catslist);	 
		$template->set('products',$products);
		$template->set('title',$title);
		$template->set('viewall',$viewall);
		$template->set('addclass',$addclass);
		$template->set('helper',$this);
		//print_r($template); die();
		$template->render(); 
		//return $resQry;	
	}	
	
	function getChildsId($catid='286')
	{
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
			$childcatlist=$this->get_a_line_bind( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ?) temp1
											   WHERE IsActive=1
											) temp2 ",array($catid) );
			
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
		return $childcatlist['ids'];
	}
		function unsetguestchkout()
		{
			
			unset($_SESSION['Isguestcheckout']);
			unset($_SESSION['guestckout_sess_id']);
			$this->insert("update ".TPLPrefix."cus_address set IsActive=2 where customer_id='".session_id()."'");
			

		}
		
		function dynamiclanguagepage($lang_id,$page){
			$StrQry="select pagecontent from ".TPLPrefix."language_pages where IsActive=1 and lang_id = '".$lang_id."' and pagecode = '".$page."' ";	

			$resQry = $this->get_a_line($StrQry);	
			 
			return $resQry['pagecontent'];
		}
		
		function languagepagenames($lang_id,$page){

			$StrQry="select shortcode,displayname from ".TPLPrefix."language_variables where IsActive=1 and lang_id = '".$lang_id."' and pagecode = '".$page."' ";	

			$resQry = $this->get_rsltset($StrQry);	
			
			$langnames = array();
			foreach ($resQry as $langdata) {
				$langnames[$langdata['shortcode']] = $langdata['displayname'];
			}

			return $langnames;
		}
		
		function languageshortnames($lang_id,$short){
			$StrQry="select shortcode,displayname from ".TPLPrefix."language_variables where IsActive=1 and lang_id = '".$lang_id."' and shortcode = '".$short."' ";	

			$resQry = $this->get_a_line($StrQry);
			return $resQry['displayname'];
		}
}
?>