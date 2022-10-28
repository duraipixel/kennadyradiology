<?php


 
		/******************* Feature Story Start ************************/

		function getStoreInfo($db,$storeid,$key=null){
	//ecomtLogo
 	$rslt= $db->get_a_line("select * from ".TPLPrefix."configuration where IsActive != '2' and  storeId = 1 and uniCode='".$key."'");
	return $rslt['value'];
}

function getFeaturestoriesList($db,$LIMIT,$storeID,$code,$filter=null) {
	
	 
	 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";
	 
	 if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}
	 if($code != ''){ $checkid = " and storycode = '".$code."'";}
	 
	if($filter['year'] != '') { $year = " and YEAR(StoryDate) ='".$filter['year']."'";}	
	if($filter['month'] != ''){ $month = " and MONTH(StoryDate) ='".$filter['month']."'";}	
	
	$limtstr="";
	$ordpag = '';
	if($filter['action'] == 'pagination'){
		if(isset($filter['page']))
	    $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	}
	
	//if($filter['action'] == 'pagination' || $filter['action'] == 'filter')	 {

	/*}
	else{
	  $ordpag = 'FsId desc';
	}*/
	
		$ordpag = 'StoryDate desc,FsId desc';
		
	 $strQry1 = "select FsId,StoryTitle,StoryDate,StoryDescription,StoryURL,storycode from ".TPLPrefix."feature_stories where   IsActive = 1  ".$year." ".$month."  ".$checkid." ".$StoreIdstr."  order by $ordpag ";
	 $rsltMenu1=$db->get_rsltset($strQry1);	
	 
	 
      $strQry = "select FsId,StoryTitle,StoryDate,StoryDescription,StoryURL,storycode from ".TPLPrefix."feature_stories where   IsActive = 1  ".$year." ".$month."  ".$checkid." ".$StoreIdstr."  order by $ordpag ".$LIMITS."";
	 $rsltMenu=$db->get_rsltset($strQry);	
	  
	  
    $FsId='';
	if(isset($filter['page']) && $filter['page']==1 && count($rsltMenu)>0  ){
			$FsId=$rsltMenu[0]['FsId']; 		
	}
		
	if($filter['action'] == 'pagination' || $filter['action'] == 'filter')	 {
		if(count($rsltMenu)>0){
			$strHtml ='';	
			$dots = '';$StoryDescription = '';
			
			foreach($rsltMenu as $storyval)	{ 
			
			if(strlen(strip_tags($storyval['StoryDescription'])) > 300){ $dots = '...';}

			$StoryDescription = strip_tags($storyval['StoryDescription']);

			 $strHtml .='
	 <a href="'.BASE_URL.'feature-stories/'.$storyval['storycode'].'" class="features-stories-link">
					<div class="date"><strong>'.date('d',strtotime($storyval['StoryDate'])).'</strong>'.date('M Y',strtotime($storyval['StoryDate'])).'</div>
					<h4>'.$storyval['StoryTitle'].'</h4>
					<p>'.substr(strip_tags($storyval['eventdescription']),0,300);
					if(strlen($storyval['StoryDescription']) > 300){ echo '...';}  
					$strHtml .='</p> 
					<span>Read More <i class="fa fa-angle-right" aria-hidden="true"></i></span>
				</a>';
				
				
 
        
			}
				echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"FsId"=>$FsId,"story_cont"=>$strHtml));	
			}
			else
			{
				echo json_encode(array("oppcnt"=>count($rsltMenu),"FsId"=>$FsId,"story_cont"=>' <div class="no-data-found"><p>No record Found</p></div>'));	
			}
	  }
	  else
	  {
		  return $rsltMenu;	
	  }
}



function getfeatureyear($db,$storeId){
	 
 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";

	  $strQry = "select DISTINCT YEAR(`StoryDate`) as year from  ".TPLPrefix."feature_stories where  IsActive = 1  ".$StoreIdstr."  order by StoryDate ";
	  
  	 $resulst1=$db->get_rsltset($strQry);	
	 
	 return $resulst1;
}
function getpreviousnext_Featurestories($db,$storeId,$FsId){
	
	$StoreIdstr = " and a.lang_id = '".$_SESSION['lang_id']."' ";
	 	 
 				    	$strQrypro =  "select (select concat(a.StoryTitle,'@@',a.FsId,'@@',a.storycode) from ".TPLPrefix."feature_stories a where IsActive = 1   ".$StoreIdstr." and a.StoryDate <= (select StoryDate from ".TPLPrefix."feature_stories where FsId='".$FsId."') and  a.FsId NOT IN (select FsId from ".TPLPrefix."feature_stories where StoryDate = (select StoryDate from ".TPLPrefix."feature_stories where FsId='".$FsId."' ) and FsId > '".$FsId."' ) and a.FsId <> '".$FsId."'
ORDER BY `a`.`StoryDate` DESC,a.FsId  DESC    limit 0,1) as nextstory,
 (select concat(a.StoryTitle,'@@',a.FsId,'@@',a.storycode) from ".TPLPrefix."feature_stories a where IsActive = 1  ".$StoreIdstr." and a.StoryDate >= (select StoryDate from ".TPLPrefix."feature_stories where FsId='".$FsId."') and  a.FsId NOT IN (select FsId from ".TPLPrefix."feature_stories where StoryDate = (select StoryDate from ".TPLPrefix."feature_stories where FsId='".$FsId."' ) and FsId < '".$FsId."' ) and a.FsId <> '".$FsId."'  ORDER BY `a`.`StoryDate` asc,a.FsId asc limit 0,1) as  prevstory from ".TPLPrefix."feature_stories a   where  a.IsActive = 1 ".$StoreIdstr." LIMIT 0,1";


    $rsltMenu=$db->get_a_line($strQrypro);	
	return $rsltMenu;	
}

									/******************* Events END ************************/
									
									

	/******************* Events Start ************************/

function getEventsList($db,$LIMIT,$storeID,$code,$filter=null) {
 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";
	 
	 if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}
	 
	 if($code != ''){ $checkid = " and eventcode = '".$code."'";}
	 
 	
	if($filter['year'] != '') { $year = " and YEAR(eventdate) ='".$filter['year']."'";}	
	if($filter['month'] != ''){ $month = " and MONTH(eventdate) ='".$filter['month']."'";}	
	
	
	$limtstr="";
	if($filter['action'] == 'pagination'){
		if(isset($filter['page']))
	    $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	}
	  
	  //  if($filter['action'] == 'pagination' || $filter['action'] == 'filter')	 {
	$ordpag = 'eventdate desc,eventid desc';
	/*}
	else{
	  $ordpag = 'eventid,eventdate desc';
	}*/
	
	    $strQry1 = "select eventid,eventtitle,eventdate,eventdescription,eventurl,eventvideourl,eventcode from ".TPLPrefix."events where   IsActive = 1   ".$StoreIdstr." ".$year." ".$month."  ".$checkid."  order by $ordpag";
	 $rsltMenu1=$db->get_rsltset($strQry1);	
	 
	
    	     $strQry = "select eventid,eventtitle,eventdate,eventdescription,eventurl,eventvideourl,eventcode from ".TPLPrefix."events where   IsActive = 1  ".$StoreIdstr." ".$year." ".$month."  ".$checkid."   order by $ordpag ".$LIMITS."";
	 $rsltMenu=$db->get_rsltset($strQry);	
	  
	  
    $newsid='';
	if(isset($filter['page']) && $filter['page']==1 && count($rsltMenu)>0  ){
			$newsid=$rsltMenu[0]['eventid']; 		
	}
		
	if($filter['action'] == 'pagination' || $filter['action'] == 'filter')	 {
		if(count($rsltMenu)>0){
			$strHtml ='';	
			$dots= '';
			$dd='';
			foreach($rsltMenu as $newsval)	{ 
			if(strlen(strip_tags($newsval['eventdescription'])) > 300){ $dots =  '...';}
			
  if($newsvals['eventdate'] > date('Y-m-d')){ $dd = '<span class="upcomingevent">Upcoming</span>';}
  
  $strHtml .='
	 <a href="'.BASE_URL.'events/'.$newsval['eventcode'].'" class="features-stories-link">
					<div class="date"><strong>'.date('d',strtotime($newsval['eventdate'])).'</strong>'.date('M Y',strtotime($newsval['eventdate'])).'</div>
					<h4>'.$newsval['eventtitle'].'</h4>
					<p>'.substr(strip_tags($newsval['eventdescription']),0,300);
					if(strlen($newsval['eventdescription']) > 300){ echo '...';}  
					$strHtml .='</p> 
					<span>Read More <i class="fa fa-angle-right" aria-hidden="true"></i></span>
				</a>';
				
				
	 
        
			}
				echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"newsid"=>$newsid,"news_cont"=>$strHtml,"strQry"=>$strQry));	
			}
			else
			{
				echo json_encode(array("oppcnt"=>count($rsltMenu),"newsid"=>$newsid,"news_cont"=>' <div class="no-data-found"><p>No record Found</p></div>'));	
			}
	  }
	  else
	  {
		  return $rsltMenu;	
	  }
}

function getEventsImage($db,$newsid) {
	 $strQry = "(select imgname from ".TPLPrefix."eventsimage where eventid = '".$newsid."' and IsActive = '1' order by imgorder asc) UNION ALL  (select eventimage from ".TPLPrefix."events where eventid = '".$newsid."' and IsActive = '1')";
	$rsltMenu=$db->get_rsltset($strQry);	
	return $rsltMenu;	
}


function getpreviousnext_events($db,$storeId,$newsid){
	 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";

	 
	 
 	$strQrypro =  "select (select concat(a.eventtitle,'@@',a.eventid,'@@',a.eventcode) from ".TPLPrefix."events a where IsActive = 1  ".$StoreIdstr. "  and a.eventdate <= (select eventdate from ".TPLPrefix."events where eventid='".$newsid."') and  a.eventid NOT IN (select eventid from ".TPLPrefix."events where eventdate = (select eventdate from ".TPLPrefix."events where eventid='".$newsid."' ) and eventid > '".$newsid."' ) and a.eventid <> '".$newsid."'
ORDER BY `a`.`eventdate` DESC,a.eventid  DESC    limit 0,1) as prevnews ,
 (select concat(a.eventtitle,'@@',a.eventid,'@@',a.eventcode) from ".TPLPrefix."events a where IsActive = 1   ".$StoreIdstr. "  and a.eventdate >= (select eventdate from ".TPLPrefix."events where eventid='".$newsid."') and  a.eventid NOT IN (select eventid from ".TPLPrefix."events where eventdate = (select eventdate from ".TPLPrefix."events where eventid='".$newsid."' ) and eventid < '".$newsid."' ) and a.eventid <> '".$newsid."'  ORDER BY `a`.`eventdate` asc,a.eventid asc limit 0,1) as nextnews from ".TPLPrefix."events a   where  a.IsActive = 1  ".$StoreIdstr. "  LIMIT 0,1";
 
 
     $rsltMenu=$db->get_a_line($strQrypro);	
	return $rsltMenu;	
}

	
	function geteventyear($db){
	 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";

	  $strQry = "select DISTINCT YEAR(`eventdate`) as year from ".TPLPrefix."events where  IsActive = 1 ".$StoreIdstr. "  order by eventdate ";
	  
  	 $resulst1=$db->get_rsltset($strQry);	
	 
	 return $resulst1;
}								/******************* Events END ************************/
									
	
function getNewsInitiativeList($db,$LIMIT,$storeID,$for,$code,$filter=null) {
	
	 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";
	 
	 if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}
	 
	 if($code != ''){ $checkid = " and newscode = '".$code."'";}
	 
 	
	if($filter['year'] != '') { $year = " and YEAR(newsdate) ='".$filter['year']."'";}	
	if($filter['month'] != ''){ $month = " and MONTH(newsdate) ='".$filter['month']."'";}	
	
	
	$limtstr="";
	if($filter['action'] == 'pagination'){
		if(isset($filter['page']))
	    $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	}
	  
	  $ordpag = 'newsdate desc,newsid desc';
	
	  $ul = 'news/';	
	  $strQry1 = "select newsid,newstitle,newsdate,newsdescription,newsurl,newsvideourl,newscode from ".TPLPrefix."news where 1=1  ".$year." ".$month."  and IsActive = 1   ".$StoreIdstr. "  ".$checkid."   order by $ordpag ";
	 $rsltMenu1=$db->get_rsltset($strQry1);	
	 
	    $strQry = "select newsid,newstitle,newsdate,newsdescription,newsurl,newsvideourl,newscode from ".TPLPrefix."news where   1=1 ".$year." ".$month."  and IsActive = 1  ".$StoreIdstr. " ".$checkid."  order by $ordpag  ".$LIMITS."";
	 $rsltMenu=$db->get_rsltset($strQry);	
	  
	
    $newsid='';
	if(isset($filter['page']) && $filter['page']==1 && count($rsltMenu)>0  ){
			$newsid=$rsltMenu[0]['newsid']; 		
	}
		
	if($filter['action'] == 'pagination' || $filter['action'] == 'filter')	 {
		if(count($rsltMenu)>0){
			$strHtml ='';	
			$dots = '';
			
			foreach($rsltMenu as $newsval)	{ 
			$description ='';
			
			if(strlen(strip_tags($newsval['newsdescription'])) > 300){ $dots = '...';}
			$description = strip_tags($newsval['newsdescription']);

	$strHtml .='
	 <a href="'.BASE_URL.'news/'.$newsval['newscode'].'" class="features-stories-link">
					<div class="date"><strong>'.date('d',strtotime($newsval['newsdate'])).'</strong>'.date('M Y',strtotime($newsval['newsdate'])).'</div>
					<h4>'.$newsval['newstitle'].'</h4>
					<p>'.substr(strip_tags($newsval['newsdescription']),0,300);
					if(strlen($newsval['newsdescription']) > 300){ echo '...';}  
					$strHtml .='</p> 
					<span>Read More <i class="fa fa-angle-right" aria-hidden="true"></i></span>
				</a>';
			 
			}
				echo json_encode(array("oppcnt"=>count($rsltMenu),"newsid"=>$newsid,"maincount" => count($rsltMenu1),"news_cont"=>$strHtml));	
			}
			else
			{
				echo json_encode(array("oppcnt"=>count($rsltMenu),"newsid"=>$newsid,"news_cont"=>'<div class="no-data-found"><p>No record Found</p></div>'));	
			}
	  }
	  else
	  {
		  return $rsltMenu;	
	  }
}				


function getnewyear($db,$for,$storeId){
	 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";
	 

	  $strQry = "select DISTINCT YEAR(`newsdate`) as year from ".TPLPrefix."news where   IsActive = 1   ".$StoreIdstr. "   order by newsdate ";
	  
  	 $resulst1=$db->get_rsltset($strQry);	
	 
	 return $resulst1;
}			


function getNewsImage($db,$newsid) {
	    $strQry = "(select imgname from ".TPLPrefix."newsimage where newsid = '".$newsid."' and IsActive = '1' order by imgorder asc) UNION ALL  (select newsimage from ".TPLPrefix."news where newsid = '".$newsid."' and IsActive = '1')";
 	$rsltMenu=$db->get_rsltset($strQry);	
	return $rsltMenu;	
}	


function getpreviousnext_news($db,$storeId,$newsid){
	 $StoreIdstr = " and lang_id = '".$_SESSION['lang_id']."' ";
	 	 
$strQrypro =  "select (select concat(a.newstitle,'@@',a.newsid,'@@',a.newscode) from ".TPLPrefix."news a where IsActive = 1  ".$StoreIdstr. "  and a.newsdate <= (select newsdate from ".TPLPrefix."news where newsid='".$newsid."') and  a.newsid NOT IN (select newsid from ".TPLPrefix."news where newsdate = (select newsdate from ".TPLPrefix."news where newsid='".$newsid."' ) and newsid > '".$newsid."' ) and a.newsid <> '".$newsid."'
ORDER BY `a`.`newsdate` DESC,a.newsid  DESC    limit 0,1) as prevnews ,
 (select concat(a.newstitle,'@@',a.newsid,'@@',a.newscode) from ".TPLPrefix."news a where IsActive = 1 ".$StoreIdstr. "  and a.newsdate >= (select newsdate from ".TPLPrefix."news where newsid='".$newsid."') and  a.newsid NOT IN (select newsid from ".TPLPrefix."news where newsdate = (select newsdate from ".TPLPrefix."news where newsid='".$newsid."' ) and newsid < '".$newsid."' ) and a.newsid <> '".$newsid."'  ORDER BY `a`.`newsdate` asc,a.newsid asc limit 0,1) as nextnews from ".TPLPrefix."news a   where  a.IsActive = 1 ".$StoreIdstr. "  LIMIT 0,1";
  
    $rsltMenu=$db->get_a_line($strQrypro);	
	return $rsltMenu;	
}


?>