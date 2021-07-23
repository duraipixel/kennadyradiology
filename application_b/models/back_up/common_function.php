<?php
    function getBannerSlider($db){ 	
     $strQry =" select * from ".tbl_banner."  where isactive=1 ";
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    } 
	
	function getThemeImage($db){ 	
     $strQry =" select * from ".tbl_themes."  where isactive=1 and dispcinhpage=1 order by sortingorder";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    } 
	
	function getEvents($db){ 	
     $strQry =" select e.*,em.imgname, DATE_FORMAT(e.startdate,'%d-%m-%y') as startdate from ".tbl_events." e inner join ".tbl_events_moreimg." em on e.evid=em.evid and em.showhomepage=1 and em.isactive=1 where e.showhomepage=1 and e.isactive=1  order by e.sortingorder";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    } 
	
	function getDestination($db){ 	
     $strQry =" select d.*,dm.imgname,dm.imgtitle from ".tbl_destination." d inner join ".tbl_destination_moreimg." dm on d.desid=dm.desid and dm.showhomepage=1 and dm.isactive=1 where d.isactive=1 limit 0,6 ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    } 
	
	function getActivities($db){ 	
     $strQry =" select f.*,fm.imgname,fm.imgtitle from ".tbl_festivals." f inner join ".tbl_festivals_moreimg." fm on f.fesid=fm.fesid and fm.showhomepage=1 and fm.isactive=1 where f.isactive=1";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    }

    function getmembers($db)
	{
     $strQry =" select h.*,c.categorytype from ".tbl_hoteliers." h left join ".tbl_categorytype." c on h.categorytype=c.categoryid and c.isactive=1 where h.isactive=1";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;

	}	
 
    function enquiryform_insert($db,$filters){
		
	    $today = date("Y-m-d H:i:s");
	    $strQry ="INSERT INTO ".tbl_enquiries." (name, mobileno, emailid, comments, date,isactive) VALUES ( '".trim(addslashes($filters['name']))."', '".trim(addslashes($filters['phone']))."',  '".trim(addslashes($filters['email']))."', '".trim(addslashes($filters['comments']))."',  '".trim(addslashes($today))."','1');";
	    $rsltMenu=$db->insert($strQry);	
	    if($rsltMenu){
			
			$to =  $filters['email'];
		    $subject = 'Tamil Nadu Travel Mart Society';
			//$txt = "";
			//$message = str_replace("\n.", "\n..", $txt); 
			$message = '<table width="500"  border="0" cellpadding="3" cellspacing="0" bordercolor="#000" bgcolor="#ffffff" style="border: solid 1px #4e3101">
  <tr>
    <td><table width="500" height="" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td height="24" colspan="3" valign="top" style="background:#ed1c24 " ><font face="Arial, Helvetica, sans-serif" size="4" color="#FFFFFF"><strong>General Enquiry</strong></font></td>
      </tr>
	  
      <tr>
        <td width="40%" height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Name</b></font></td>
        <td width="10%" valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font>  </td>
        <td width="50%" valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['name'].'</font>        </td>
      </tr>
	  
   
	  
      <tr>
        <td height="24" valign="top" bgcolor="#f7f7f7"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Email</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['email'].'</font></td>
      </tr>
      <tr>
        <td height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Phone</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['phone'].'</font></td>
      </tr>
	  
	   <tr>
        <td height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Subject</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$subject.'</font></td>
      </tr>
	
      <tr>
        <td height="24" valign="top" bgcolor="#f7f7f7"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Comments</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font></td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['comments'].'</font></td>
      </tr>
        </table></td>
  </tr>
</table>';
	  
			$headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From:ayyanar.pixel@gmail.com'. "\r\n";
            //$headers .= 'Bcc: "'.BCCEMAIL.'"' . "\r\n";
		 mail($to, $subject, $message, $headers);
		 echo json_encode(array("rslt"=>1));
	    }
		else{
			echo json_encode(array("rslt"=>2));
		}
    }
	
 
    function contactform_insert($db,$filters){
		
	    $today = date("Y-m-d H:i:s");
	    $strQry ="INSERT INTO ".tbl_contact_us." (name, mobileno, emailid, comments, date,isactive) VALUES ( '".trim(addslashes($filters['name']))."', '".trim(addslashes($filters['phone']))."',  '".trim(addslashes($filters['email']))."', '".trim(addslashes($filters['comments']))."',  '".trim(addslashes($today))."','1');";
	    $rsltMenu=$db->insert($strQry);	
	    if($rsltMenu){
			$to =  $filters['email'];
		    $subject = 'Tamil Nadu Travel Mart Society';
			$message = '<table width="500"  border="0" cellpadding="3" cellspacing="0" bordercolor="#000" bgcolor="#ffffff" style="border: solid 1px #4e3101">
  <tr>
    <td><table width="500" height="" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td height="24" colspan="3" valign="top" style="background:#ed1c24 " ><font face="Arial, Helvetica, sans-serif" size="4" color="#FFFFFF"><strong>Contactus Form</strong></font></td>
      </tr>
	  
      <tr>
        <td width="40%" height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Name</b></font></td>
        <td width="10%" valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font>  </td>
        <td width="50%" valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['name'].'</font>        </td>
      </tr>
	  
   
	  
      <tr>
        <td height="24" valign="top" bgcolor="#f7f7f7"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Email</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['email'].'</font></td>
      </tr>
      <tr>
        <td height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Phone</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['phone'].'</font></td>
      </tr>
	  
	   <tr>
        <td height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Subject</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$subject.'</font></td>
      </tr>
	
      <tr>
        <td height="24" valign="top" bgcolor="#f7f7f7"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Comments</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font></td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['comments'].'</font></td>
      </tr>
        </table></td>
  </tr>
</table>';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From:ayyanar.pixel@gmail.com'. "\r\n";
            //$headers .= 'Bcc: "'.BCCEMAIL.'"' . "\r\n";
		 mail($to, $subject, $message, $headers);
		 echo json_encode(array("rslt"=>1));
	    }
		else{
			echo json_encode(array("rslt"=>2));
		}
    }
	
	function subscribemail($db,$filters){
		
	     
	    $strQry ="INSERT INTO ".tbl_subscriptions." (emailid,isactive) VALUES ('".trim(addslashes($filters['mailid']))."','1');";
	    $rsltMenu=$db->insert($strQry);	
	    if($rsltMenu){
			$to =  $filters['mailid'];
		    $subject = 'Tamil Nadu Travel Mart Society';
			$message = '<table width="500"  border="0" cellpadding="3" cellspacing="0" bordercolor="#000" bgcolor="#ffffff" style="border: solid 1px #4e3101">
  <tr>
    <td><table width="500" height="" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td height="24" colspan="3" valign="top" style="background:#ed1c24 " ><font face="Arial, Helvetica, sans-serif" size="4" color="#FFFFFF"><strong>Subscribe Mail</strong></font></td>
      </tr>
	 
      <tr>
        <td height="24" valign="top" bgcolor="#f7f7f7"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Email</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$filters['mailid'].'</font></td>
      </tr>
      
	  
	   <tr>
        <td height="24" valign="top" bgcolor="#f4f4f4"><font face="Arial, Helvetica, sans-serif" size="2" color="#2e2e2e"><b>Subject</b></font></td>
        <td valign="top"><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">:</font> </td>
        <td valign="top" ><font face="Arial, Helvetica, sans-serif" size="2" color="#002a3a">'.$subject.'</font></td>
      </tr>
	
        </table></td>
  </tr>
</table>';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From:ayyanar.pixel@gmail.com'. "\r\n";
            //$headers .= 'Bcc: "'.BCCEMAIL.'"' . "\r\n";
		 mail($to, $subject, $message, $headers);
		 echo json_encode(array("rslt"=>1));
	    }
		else{
			echo json_encode(array("rslt"=>2));
		}
		
    }
	
	
	function getMembersload($db,$filter,$LIMIT){	
	//echo "reach"; exit;
   if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}	 
   
	  $limtstr="";
	  if($filter['action'] == 'pagination'){
		  if(isset($filter['page']))
		  $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	  }
	  
	 $strQry1 = " select h.*,c.categorytype from ".tbl_hoteliers." h left join ".tbl_categorytype." c on h.categorytype=c.categoryid and c.isactive=1 where h.isactive=1";
		//echo $strQry1;
	
	$rsltMenu1=$db->get_rsltset($strQry1);
	//echo $filter['action'];
	//print_r($rsltMenu1);
	  ########## Get Overall count ###########
	  
	$strQry = "select h.*,c.categorytype from ".tbl_hoteliers." h left join ".tbl_categorytype." c on h.categorytype=c.categoryid and c.isactive=1 where h.isactive=1".' '.$LIMITS."";
	
	

	$rsltMenu=$db->get_rsltset($strQry);	
	//print_r($rsltMenu);

				
		 
		  
		if($filter['action'] == 'pagination' || $filter['action'] == 'filter'){
			
		  if(count($rsltMenu)>0){
			  
			  $strHtml ='';	
			  $dots = '';
			  foreach($rsltMenu as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	 
				 
				  $strHtml .='
				  <div class="col-md-12 col-sm-12 col-xs-12  membersingle ">
				  <div class="row">
				  
				  <div class="col-md-4 col-sm-4 col-xs-12 membersingle-inner">
				  <p class="largecaption">Name</p>
				  <p class="mediumcaption">'.$value['hotelname'].'</p>			
				  <p class="mediumcaption">Member No.'.$value['memberno'].'</p>
				  <p class="smallcaption">'.$value['categorytype'].' - '.$value['location'].'</p>
				  </div>
				  
				  <div class="col-md-4 col-sm-4 col-xs-12 membersingle-inner">
				  <p class="largecaption"><span>Contact Person</span></p>
				  <p class="mediumcaption">
				  <span>';
				  
				  $contactper = explode(',',$value['contactperson']);
				  foreach($contactper as $con){
					  
				  $strHtml .=$con.'<br>';
				  }
				 $strHtml .='</span></p>
				  </div>
				  
				  <div class="col-md-4 col-sm-4 col-xs-12 membersingle-inner">
				  <p class="largecaption"><span>Contact Details</span></p>
				  <p class="mediumcaption">';
				  $contactno = explode(',',$value['contactno']);
							$cnt=1;	foreach($contactno as $contact){
				            if($cnt!=1){
							$strHtml .=' / ';	
							}
				  $strHtml .='<span>'.$contact.'</span>';
						$cnt++;		}
				  $strHtml .='</p>
				  
				  <p class="mediumcaption"><span>';
				  $email = explode(',',$value['email']);
								foreach($email as $ema){
				  
				  $strHtml .=$ema.'<br>';
								}
				  $strHtml .='<span></p
				  < p class="mediumcaption"><span>'.$value['urlname'].'</span></p>
				  </div>
				  
				  </div>
				  </div>';
				
				
		
			
						
				  }	
				  		
						 echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"product_cont"=>$strHtml));				
					
			  }
			  
			  else
				  {
					  echo json_encode(array("oppcnt"=>count($rsltMenu),"product_cont"=>'<div class="col-md-12 col-sm-12 col-xs-12 nopad common-msg"><div class="common-msginner"> No Objects Found</div></div>'));	
				  }
			  
		}
		else
		{	
			//echo "Check";
			//print_r($rsltMenu);		exit;
			return $rsltMenu;	
		}
  
  }	 
 
    /*
    function getelibrary($db){ 	
     $strQry =" select el.*,lc.categoriestitle from ".tbl_elibrary." el left join ".tbl_library_categories." lc on el.libcatid=lc.libcatid  and lc.isactive=1 where el.isactive=1 ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    } 
	*/
	
	 function getelibrary($db){ 	
     $strQry =" select * from ".tbl_elibrary."  where isactive=1 ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    } 
	
	 function getelibrarycat($db){ 	
     $strQry =" select * from ".tbl_library_categories."  where isactive=1 ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
    }
	
	//select date(e.startdate),date(now()) as dat, Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ttms_events e where e.isactive=1

function getEventsload($db,$filter,$LIMIT){	
	//echo date("y",mktime(0,0,0,0,0,2017)) exit;
   if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}	 
   
	  $limtstr="";
	  if($filter['action'] == 'pagination'){
		  if(isset($filter['page']))
		  $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	  }
	  
	  
	 $strQry1 = " select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where e.isactive=1";
		//echo $strQry1;exit;
	
	$rsltMenu1=$db->get_rsltset($strQry1);
	//echo $filter['action'];
	//print_r($rsltMenu1);
	  ########## Get Overall count ###########
	  
	$strQry = "select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where e.isactive=1".' '.$LIMITS."";
	
	//echo $strQry exit;

	$rsltMenu=$db->get_rsltset($strQry);	
	//print_r($rsltMenu);

				
		 
		  
		if($filter['action'] == 'pagination' || $filter['action'] == 'filter'){
			
		  if(count($rsltMenu)>0){
			  $dates = date('d');
			  $strHtml ='';	
			  $dots = '';
			  foreach($rsltMenu as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	 //if($dates <= $value['dat']){
					 if($dates == $value['dat']){ $eventstatus = "Ongoing";  } else{ $eventstatus = "Up Coming";  }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$eventstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutevents'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="#" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				// }
		
			
						
				  }	
				  		
						 echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"product_cont"=>$strHtml));				
					
			  }
			  
			  else
				  {
					  echo json_encode(array("oppcnt"=>count($rsltMenu),"product_cont"=>'<div class="col-md-12 col-sm-12 col-xs-12 nopad common-msg"><div class="common-msginner"> No Objects Found</div></div>'));	
				  }
			  
		}
		else
		{	
			//echo "Check";
			//print_r($rsltMenu);		exit;
			return $rsltMenu;	
		}
  
  }	


function getEventsarchiveload($db,$filter,$LIMIT){	
	//echo date("y",mktime(0,0,0,0,0,2017)) exit;
   if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}	 
   
	  $limtstr="";
	  if($filter['action'] == 'pagination'){
		  if(isset($filter['page']))
		  $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	  }
	  
	  
	 $strQry1 = " select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where e.isactive=1";
		//echo $strQry1;exit;
	
	$rsltMenu1=$db->get_rsltset($strQry1);
	//echo $filter['action'];
	//print_r($rsltMenu1);
	  ########## Get Overall count ###########
	  
	$strQry = "select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where e.isactive=1".' '.$LIMITS."";
	
	
    //echo $strQry;
	$rsltMenu=$db->get_rsltset($strQry);	
	//print_r($rsltMenu);
     /*
		if($filter['action'] == 'selectdy'){
			
           $serch_year = $filter['year'];
	       $search_month = $filter['month'];
	       if($search_month!='' && isset($search_month)){
           $months = "MONTH(e.startdate) = ".$search_month." and ";
           }  
	       if($serch_year!='' && isset($serch_year)){
           $years = "YEAR(e.startdate) = ".$serch_year." and  ";
           }  
           
		    $strQry2 = " select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where ".$years."  ".$months." e.isactive=1";
		//echo $strQry2;exit;
	
	     $rsltMenu2=$db->get_rsltset($strQry2);
		            if($rsltMenu2>0){
		              $dates = date('d');
			          $strHtml ='';	
		 			  foreach($rsltMenu2 as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	
					 if($dates == $value['dat']){ $eventstatus = "Ongoing";  } 
					 elseif($dates < $value['dat']){ $eventstatus = "Up Coming";  }
					 else{ $eventstatus = "Closed"; }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$eventstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutevents'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="#" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				}
				echo json_encode(array("str"=>$strHtml));
					
				}
				else{
					echo json_encode(array("str"=>'No Objects Found'));
				}

		}	
		*/
		 
		  
		if($filter['action'] == 'pagination'){
			
		  if(count($rsltMenu)>0){
			  $dates = date('d');
			  $strHtml ='';	
			  $dots = '';
			  foreach($rsltMenu as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	
					 if($dates == $value['dat']){ $eventstatus = "Ongoing";  } 
					 elseif($dates < $value['dat']){ $eventstatus = "Up Coming";  }
					 else{ $eventstatus = "Closed"; }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$eventstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutevents'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="#" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				
		
			
						
				  }	
				  		
						 echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"product_cont"=>$strHtml));				
					
			  }
			  
			  else
				  {
					  echo json_encode(array("oppcnt"=>count($rsltMenu),"product_cont"=>'<div class="col-md-12 col-sm-12 col-xs-12 nopad common-msg"><div class="common-msginner"> No Objects Found</div></div>'));	
				  }
			  
		}
		else
		{	
			//echo "Check";
			//print_r($rsltMenu);		exit;
			return $rsltMenu;	
		}
  
  }
  
  
  
  
  function getfestivalsload($db,$filter,$LIMIT){	
	//echo date("y",mktime(0,0,0,0,0,2017)) exit;
   if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}	 
   
	  $limtstr="";
	  if($filter['action'] == 'pagination'){
		  if(isset($filter['page']))
		  $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	  }
	  
	  
	 $strQry1 = " select *,Date_Format(startdate,'%d') as dat,Date_Format(startdate,'%Y-%m-%d') as month,Date_Format(startdate,'%y') as year from ".tbl_festivals."  where isactive=1";
		//echo $strQry1;exit;
	
	$rsltMenu1=$db->get_rsltset($strQry1);
	//echo $filter['action'];
	//print_r($rsltMenu1);
	  ########## Get Overall count ###########
	  
	$strQry = "select *,Date_Format(startdate,'%d') as dat,Date_Format(startdate,'%Y-%m-%d') as month,Date_Format(startdate,'%y') as year from ".tbl_festivals."  where isactive=1".' '.$LIMITS."";
	
	//echo $strQry exit;

	$rsltMenu=$db->get_rsltset($strQry);	
	//print_r($rsltMenu);

				
		 
		  
		if($filter['action'] == 'pagination' || $filter['action'] == 'filter'){
			
		  if(count($rsltMenu)>0){
			  $dates = date('d');
			  $strHtml ='';	
			  $dots = '';
			  foreach($rsltMenu as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	 //if($dates <= $value['dat']){
					 if($dates == $value['dat']){ $festivalstatus = "Ongoing";  } else{ $festivalstatus = "Up Coming";  }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$festivalstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutfestivals'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="#" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				// }
		
			
						
				  }	
				  		
						 echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"product_cont"=>$strHtml));				
					
			  }
			  
			  else
				  {
					  echo json_encode(array("oppcnt"=>count($rsltMenu),"product_cont"=>'<div class="col-md-12 col-sm-12 col-xs-12 nopad common-msg"><div class="common-msginner"> No Objects Found</div></div>'));	
				  }
			  
		}
		else
		{	
			//echo "Check";
			//print_r($rsltMenu);		exit;
			return $rsltMenu;	
		}
  
  }
  
  
function getfestivalsarchiveload($db,$filter,$LIMIT){	
	//echo date("y",mktime(0,0,0,0,0,2017)) exit;
   if($LIMIT != ''){ $LIMITS = " LIMIT 0,".$LIMIT."";}	 
   
	  $limtstr="";
	  if($filter['action'] == 'pagination'){
		  if(isset($filter['page']))
		  $LIMITS=" limit ".(((int)$filter['page']-1)*$LIMIT).", $LIMIT ";
	  }
	  
	  
	$strQry1 = " select *,Date_Format(startdate,'%d') as dat,Date_Format(startdate,'%Y-%m-%d') as month,Date_Format(startdate,'%y') as year from ".tbl_festivals."  where isactive=1";
		//echo $strQry1;exit;
	
	$rsltMenu1=$db->get_rsltset($strQry1);
	//echo $filter['action'];
	//print_r($rsltMenu1);
	  ########## Get Overall count ###########
	  
	$strQry = "select *,Date_Format(startdate,'%d') as dat,Date_Format(startdate,'%Y-%m-%d') as month,Date_Format(startdate,'%y') as year from ".tbl_festivals."  where isactive=1".' '.$LIMITS."";
	
	
    //echo $strQry;
	$rsltMenu=$db->get_rsltset($strQry);	
	//print_r($rsltMenu);
     /*
		if($filter['action'] == 'selectdy'){
			
           $serch_year = $filter['year'];
	       $search_month = $filter['month'];
	       if($search_month!='' && isset($search_month)){
           $months = "MONTH(e.startdate) = ".$search_month." and ";
           }  
	       if($serch_year!='' && isset($serch_year)){
           $years = "YEAR(e.startdate) = ".$serch_year." and  ";
           }  
           
		    $strQry2 = " select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where ".$years."  ".$months." e.isactive=1";
		//echo $strQry2;exit;
	
	     $rsltMenu2=$db->get_rsltset($strQry2);
		            if($rsltMenu2>0){
		              $dates = date('d');
			          $strHtml ='';	
		 			  foreach($rsltMenu2 as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	
					 if($dates == $value['dat']){ $eventstatus = "Ongoing";  } 
					 elseif($dates < $value['dat']){ $eventstatus = "Up Coming";  }
					 else{ $eventstatus = "Closed"; }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$eventstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutevents'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="#" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				}
				echo json_encode(array("str"=>$strHtml));
					
				}
				else{
					echo json_encode(array("str"=>'No Objects Found'));
				}

		}	
		*/
		 
		  
		if($filter['action'] == 'pagination'){
			
		  if(count($rsltMenu)>0){
			  $dates = date('d');
			  $strHtml ='';	
			  $dots = '';
			  foreach($rsltMenu as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	
					 if($dates == $value['dat']){ $eventstatus = "Ongoing";  } 
					 elseif($dates < $value['dat']){ $eventstatus = "Up Coming";  }
					 else{ $eventstatus = "Closed"; }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$eventstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutevents'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="#" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				
		
			
						
				  }	
				  		
						 echo json_encode(array("oppcnt"=>count($rsltMenu),"maincount" => count($rsltMenu1),"product_cont"=>$strHtml));				
					
			  }
			  
			  else
				  {
					  echo json_encode(array("oppcnt"=>count($rsltMenu),"product_cont"=>'<div class="col-md-12 col-sm-12 col-xs-12 nopad common-msg"><div class="common-msginner"> No Objects Found</div></div>'));	
				  }
			  
		}
		else
		{	
			//echo "Check";
			//print_r($rsltMenu);		exit;
			return $rsltMenu;	
		}
  
  }  
  
  
  
  
  
  
function getEventsarchiveloadfilter($db,$filter){	

    if($filter['action'] == 'selectdy'){
			
           $serch_year = $filter['year'];
	       $search_month = $filter['month'];
	       if($search_month!='' && isset($search_month)){
           $months = "MONTH(e.startdate) = ".$search_month." and ";
           }  
	       if($serch_year!='' && isset($serch_year)){
           $years = "YEAR(e.startdate) = ".$serch_year." and  ";
           }  
           
		    $strQry2 = " select e.*,Date_Format(e.startdate,'%d') as dat,Date_Format(e.startdate,'%Y-%m-%d') as month,Date_Format(e.startdate,'%y') as year from ".tbl_events." e where ".$years."  ".$months." e.isactive=1";
		//echo $strQry2;exit;
	
	     $rsltMenu2=$db->get_rsltset($strQry2);
		            if(count($rsltMenu2)>0){
		              $dates = date('d');
			          $strHtml ='';	
		 			  foreach($rsltMenu2 as $value){ 
			  //$testimoniallist['categoryslug']
				
			 	
					 if($dates == $value['dat']){ $eventstatus = "Ongoing";  } 
					 elseif($dates < $value['dat']){ $eventstatus = "Up Coming";  }
					 else{ $eventstatus = "Closed"; }
				 
				  $strHtml .='<div class="col-md-12 col-sm-12 col-xs-12  nopad event-single">
							<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 nopad">
							
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 eventimage-wraper">
								<div class="eventimage-inner">
									
									<img src="'.BASE_URL.'static/images/eventlist/1.jpg" class="img-responsive" alt="tamilnadutravelmart">
									<div class="eventdate-wrap">
									<span class="event-tag">'.$eventstatus.'</span>
									<div class="vertical-outer">
									<div class="vertical-inner">
										<span class="eventmonth datespan">'.date('M',strtotime($value['month'])).'</span>
										<span class="eventdate datespan">'.$value['dat'].'-'.$value['year'].'</span>
									</div>
									</div>
									</div>
								</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 eventcontent-wraper">
									<div class="medium-title">'.$value['title'].'</div>
									<div class="event-content">
									'.$value['aboutevents'].'
									</div>
									<div class="btns-wraper">
										<a href="#" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										<a href="" class="showmore-btn dark-btn"> <span>View Images</span> </a> 
									</div>
								</div>
							</div>
							
							</div>
					</div>';
				
				}
				echo json_encode(array("str"=>$strHtml));
					
				}
				else{
					echo json_encode(array("str"=>'No Objects Found'));
				}

		}

}  
  
  

function getThemedestinaionlist($db,$slug){

    $strQry =" select d.aboutdestination,l.city,l.locid,l.cityslug,dm.imgname from ".tbl_themes." t inner join ".tbl_places." p on t.themid=p.themid and p.isactive=1 inner join  ".tbl_destination." d on d.locid=p.locid and d.isactive=1 inner join ".tbl_location." l on l.locid=d.locid and l.isactive=1 inner join  ".tbl_destination_moreimg." dm on d.desid=dm.desid and dm.isactive=1 and dm.showhomepage=1 where t.isactive=1 and dispcinhpage=1 and t.themeslug='".$slug."' ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;

}

function settopdestinaionlist($db){
	/*
    $strQry =" select dm.imgname,dmv.url from ".tbl_destination." d inner join ".tbl_destination_moreimg." dm on d.desid=dm.desid and dm.showhomepage=1 and dm.isactive=1 inner join ".tbl_destination_morevideo." dmv on d.desid=dmv.desid and dmv.showhomepage=1 where d.settopdes='yes' and d.isactive=1 ";
	*/
	 $strQry =" select d.aboutdestination,l.city,l.cityslug,dm.imgname,dmv.url from ".tbl_themes." t inner join ".tbl_places." p on t.themid=p.themid and p.isactive=1 inner join  ".tbl_destination." d on d.locid=p.locid and d.settopdes='yes' and d.isactive=1 inner join ".tbl_location." l on l.locid=d.locid and l.isactive=1 inner join  ".tbl_destination_moreimg." dm on d.desid=dm.desid and dm.isactive=1 and dm.showhomepage=1 inner join ".tbl_destination_morevideo." dmv on d.desid=dmv.desid and dmv.showhomepage=1 where t.isactive=1 and dispcinhpage=1 ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
}	


function getplacedetails($db,$slug){

    $strQry =" select t.themeslug,p.aboutplaces,p.description,p.latitude,p.longitude,p.location,l.city,pm.imgname,pmv.url from ".tbl_themes." t inner join ".tbl_places." p on t.themid=p.themid and p.isactive=1  inner join ".tbl_location." l on l.locid=p.locid and l.cityslug='".$slug."' and l.isactive=1 inner join  ".tbl_places_moreimg." pm on p.placeid=pm.placeid and pm.isactive=1 and pm.showhomepage=1 inner join ".tbl_places_morevideo." pmv on p.placeid=pmv.placeid and pmv.showhomepage=1 where t.isactive=1 and dispcinhpage=1 ";
	//echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;

}

function getplacegallary($db,$slug){
	
	$strQry =" select pm.imgname from ".tbl_themes." t inner join ".tbl_places." p on t.themid=p.themid and p.isactive=1  inner join ".tbl_location." l on l.locid=p.locid and l.cityslug='".$slug."' and l.isactive=1 inner join  ".tbl_places_moreimg." pm on p.placeid=pm.placeid and pm.isactive=1 where t.isactive=1 and dispcinhpage=1 ";
	//echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
	
}


function getrelateddestination($db,$slug)
{
	
	$strQry =" select l.city,dm.imgname,p.places from ".tbl_themes." t inner join ".tbl_places." p on t.themid=p.themid and p.isactive=1 inner join  ".tbl_destination." d on d.locid=p.locid and d.isactive=1 inner join ".tbl_location." l on l.locid=d.locid and l.isactive=1 inner join  ".tbl_destination_moreimg." dm on d.desid=dm.desid and dm.isactive=1 and dm.showhomepage=1 where t.isactive=1 and dispcinhpage=1 ";
	 //echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);		 
 	 return $resulst;
	
}



function getsearchthemename_ajax($db,$filter)
{
	//echo $filter['slug']." ".$filter['themename']; exit;
	if($filter['themeid']!='' && isset($filter['themeid']))
	{
		 $slug = " and t.themeslug='".$filter['slug']."' GROUP by l.locid ";
		 $locid_location = " l.locid='".$filter['themeid']."' ";
		 $locid_des = " d.locid='".$filter['themeid']."' ";
		if($filter['dynastyid']!='')
		{
			$dynasid = " and d.dynastyid= '".$filter['dynastyid']."' ";
		}	
		 
	}
	else if($filter['dynastyid']!='' && isset($filter['dynastyid']))
	{
		$slug = " and t.themeslug='".$filter['slug']."' GROUP by l.locid ";	
		$dynasid = " and d.dynastyid= '".$filter['dynastyid']."' ";	
		if($filter['themeid']!='')
		{
			$locid_location = " l.locid='".$filter['themeid']."' ";
			$locid_des = " d.locid='".$filter['themeid']."' ";
		}
		else
		{
			$locid_location = " l.locid=d.locid ";
			$locid_des = " d.locid=p.locid ";
		}
	}
	
	else
	{
		$slug = " and t.themeslug='".$filter['slug']."' ";
		
		$locid_location = " l.locid=d.locid ";
		$locid_des = " d.locid=p.locid ";
	}
	
	
	$strQry =" select d.aboutdestination,l.city,l.locid,l.cityslug,dm.imgname from ".tbl_themes." t inner join ".tbl_places." p on t.themid=p.themid and p.isactive=1 inner join  ".tbl_destination." d on ".$locid_des." ".$dynasid." and d.isactive=1 inner join ".tbl_location." l on ".$locid_location." and l.isactive=1 inner join  ".tbl_destination_moreimg." dm on d.desid=dm.desid and dm.isactive=1 and dm.showhomepage=1 where t.isactive=1 and dispcinhpage=1 ".$slug." ";
	// echo $strQry; exit;
	 $resulst=$db->get_rsltset($strQry);	

	  $strHtml = '<div class="tab-content">
	  
		<div role="tabpanel" class="tab-pane active" id="grid-view">
		    <div class="col-md-12 col-sm-12 col-xs-12 nopad  explist-gridslider">';
	if(count($resulst)>0){
			$imgcount = count($resulst);
			
			 $cnt=1; 
			
			foreach($resulst as $des){ 
			if($cnt==1){
    $strHtml .= '<div class="slider-item">';
		    }   
	   $strHtml .= '<div class="col-md-6 col-sm-6 col-xs-6 destination-single expview">
					    <div class="destination-inner">
							<div class="imgcontainer">
								<div class="destination-overlay">
									<div class="vertical-outer">
										<div class="vertical-inner text-center text-white">
											<div class="heavyfont text-uppercase title">'.$des['city'].'</div>
											<div class="content-para">
											<p>'.$des['aboutdestination'].'</p>
										    </div>
										    <div >
											<a href="'.BASE_URL.'places/'.$des['cityslug'].'" class="showmore-btn"> <span>Read More</span> </a>
										    </div>

										</div>
							        </div>
								</div>
								<div class="exptitle">'.$des['city'].'</div>
							  <img src="'.BASE_URL.'uploads/destinationimg/'.$des['imgname'].'" class="img-responsive" alt="clock">
							</div>
						  
					    </div>
				    </div>';
			  
			if($cnt==8){ 
	 $strHtml .='</div> <!-- slider Proper -->';
	   $cnt=0; } $cnt++; } 
	 $imgcount = $imgcount/8;
	 if($imgcount<8){ 
		  $strHtml .='</div> <!-- slider un Proper -->';
		} 
$strHtml .= '</div> <!-- slider Proper after-->
		</div>';
		
$strHtml .='<div role="tabpanel" class="tab-pane" id="list-view">
		    <div class="col-md-12 col-sm-12 col-xs-12 nopad  explist-listslider" >';
			$imgcounts = count($resulst); $cnts=1; foreach($resulst as $des){ 
			if($cnts==1){
	$strHtml .= '<div class="slider-item">';
	        }
	   $strHtml .= '<div class="col-md-12 col-sm-12 col-xs-12  nopad explist-single">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopad">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="">
											<img src="'.BASE_URL.'uploads/destinationimg/'.$des['imgname'].'" class="img-responsive" alt="tamilnadu travelmart">
									</div>
								</div>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 eventcontent-wraper">
									<div class="small-title text-uppercase">'.$des['city'].'</div>
										<div class="explist-content">
												'.$des['aboutdestination'].'
										</div>
										<div class="btns-wraper">
											<a href="'.BASE_URL.'places/'.$des['cityslug'].'" class="showmore-btn dark-btn"> <span>Read More</span> </a> 
										</div>
								</div>
							</div>
						</div>
					</div>'; 
					
			if($cnts==5){ 
			 $strHtml .='</div>';
			 
	        $cnts=0; } $cnts++; }
            $imgcounts = $imgcounts/5;
	        if($imgcounts<5){		
			 $strHtml .='</div>';
			 } 
$strHtml .= '</div> 
		</div>
	</div>';	
			}
else{
$strHtml = '<div class="col-md-12 col-sm-12 col-xs-12 nopad common-msg"><div class="common-msginner"> No Objects Found</div></div>';
}	
	 //echo $strHtmls; 
 	 echo json_encode(array("rslt"=>$strHtml)); 
}

function getGallery($db)
{
	
	$strQry =" select imgname from ".tbl_themes_moreimg."  where isactive=1 ";
	$resulst=$db->get_rsltset($strQry);		 
 	return $resulst;
	
}

function getGalleryvideo($db)
{
	
	$strQry =" select * from ".tbl_destination_morevideo."  where showhomepage=1 ";
	
	$resulst=$db->get_rsltset($strQry);		 
 	return $resulst;
	
}

function getGallerydestination($db)
{
	
	$strQry =" select * from ".tbl_destination_moreimg."  ";
	
	$resulst=$db->get_rsltset($strQry);		 
 	return $resulst;
	
}

function getGalleryplaces($db)
{
	
	$strQry =" select * from ".tbl_places_moreimg."  ";
	
	$resulst=$db->get_rsltset($strQry);		 
 	return $resulst;
	
}
  
?>
