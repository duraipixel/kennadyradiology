<?php
class newsevents_model extends Model {
	################## NewsEvents Page ###############
	
	//for home and newsevents list page
	function getnewsevents($homepage=''){
	    if($homepage=='homepage' && $homepage!='')
		{
         $con=" limit 0,2 ";
		}			
		
	$str_all="select t1.*, date_format(t1.startson,'%d-%m-%Y') as sdate,t2.img_path from ".TPLPrefix."news_events t1 left join  ".TPLPrefix."events_images t2 on t1.newseventid= t2.newseventid and t2.IsActive = 1 and t2.isdefault=1  where  t1.IsActive=1 order by t1.startson desc ".$con." "; 
	//echo $str_all; exit;
	$resulst=$this->get_rsltset($str_all);	
	return $resulst;	
		
	}
	
	function newseventsdetails($slug)
	{
	$slug=$this->real_escape_string($slug);	
		$str_all="select t1.*, date_format(t1.startson,'%d-%m-%Y') as sdate,t2.img_path from ".TPLPrefix."news_events t1 inner join  ".TPLPrefix."events_images t2 on t1.newseventid= t2.newseventid and t2.IsActive = 1 where  t1.IsActive=1 and t1.eventsslug=? "; 
	//echo $str_all; exit;
	$resulst=$this->get_rsltset_bind($str_all,array($slug));	
	return $resulst;
	}
	
	
}