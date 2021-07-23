<?php  
include 'session.php';
extract($_REQUEST);
//$today=date("Y-m-d");
$today=date("Y-m-d H:i:s");
try {
	
if(isset($txtMenu_name)){
	
	if(isset($prev_menuids)){		
		//delete previous Menu List are removed - START
		$arr_delmenus=array_diff($prev_menuids,$new_menuids_update);
		if(isset($arr_delmenus)){		
			foreach($arr_delmenus as $arr_delmenus_s){
				//echo $arr_delmenus_s; echo "<br/>\n\n";
				$str= "update ".TPLPrefix."forntmenu set IsActive = '2',modifieddate='".$today."', UserId ='".$_SESSION["UserId"]."' where frontmenuid='".$arr_delmenus_s."'  ";
				$db->insert_log("update","".TPLPrefix."forntmenu",$edit_id,"forntmenu updated","forntmenu",$str);
				
				$db->insert($str);
			}
		}		
		//delete previous Menu List are removed - END		
	
		//previous menu options are update or insert new menu - START
		for($i=0;$i <count($txtMenu_name); $i++ ){
			
			if(isset($new_menuids_update[$i])){
				//prev menus are update	
				if($txtMenu_name[$i] != null && $txtMenu_name[$i] != "" && $sel_menutype[$i] != null && $sel_menutype[$i] != "" && $sel_menulink[$i] != null && $sel_menulink[$i] != "" ){					
				
					if($sel_menutype[$i] == "4"){
						$str= "update ".TPLPrefix."forntmenu set f_menuname = '".getRealescape($txtMenu_name[$i])."', f_menutype = '".$sel_menutype[$i]."', f_link_id='',  f_link_name = '".getRealescape($sel_menulink[$i])."', sortingorder = '".$txtMenu_sortby[$i]."', UserId = '".$_SESSION["UserId"]."',modifieddate='".$today."',lang_id='".getRealescape($txtlanguage_name[$i])."' where frontmenuid='".$new_menuids_update[$i]."'  ";
					}
					else{
							
						 $str= "update ".TPLPrefix."forntmenu set f_menuname = '".getRealescape($txtMenu_name[$i])."', f_menutype = '".$sel_menutype[$i]."', f_link_name='', f_link_id = '".$sel_menulink[$i]."', sortingorder = '".$txtMenu_sortby[$i]."', UserId = '".$_SESSION["UserId"]."',modifieddate='".$today."',lang_id='".getRealescape($txtlanguage_name[$i])."' where frontmenuid='".$new_menuids_update[$i]."'  ";
						
					}
					$db->insert_log("update","".TPLPrefix."forntmenu",$edit_id,"forntmenu updated","forntmenu",$str);
					$db->insert($str);
				}
				
			}
			else{
				//insert menu options
				if($txtMenu_name[$i] != null && $txtMenu_name[$i] != "" && $sel_menutype[$i] != null && $sel_menutype[$i] != "" && $sel_menulink[$i] != null && $sel_menulink[$i] != "" ){
					
					if($sel_menutype[$i] == "4"){
						//Link save to dp
						$str=" insert into ".TPLPrefix."forntmenu (f_menuname, f_menutype, f_link_name, sortingorder, IsActive, UserId, createddate,modifieddate,lang_id)values('".getRealescape($txtMenu_name[$i])."','".$sel_menutype[$i]."','".getRealescape($sel_menulink[$i])."','".$txtMenu_sortby[$i]."','1','".$_SESSION["UserId"]."','".$today."','".$today."','".getRealescape($txtlanguage_name[$i])."') ";
					}
					else{
						//id save to dp
						$str=" insert into ".TPLPrefix."forntmenu (f_menuname, f_menutype, f_link_id, sortingorder, IsActive, UserId, createddate,modifieddate,lang_id)values('".getRealescape($txtMenu_name[$i])."','".$sel_menutype[$i]."','".getRealescape($sel_menulink[$i])."','".$txtMenu_sortby[$i]."','1','".$_SESSION["UserId"]."','".$today."','".$today."','".getRealescape($txtlanguage_name[$i])."') ";
					}								
					$db->insert($str);
					$db->insert_log("insert","".TPLPrefix."forntmenu",$edit_id,"forntmenu inserted","forntmenu",$str);
					
				}
				
			}
		}
		echo json_encode(array("rslt"=>"1")); //return insert successfully 
		
		//previous menu options are update or insert new menu - START
		
	}
	else{
		// All options are new
		for($i=0;$i <count($txtMenu_name); $i++ ){
			
			if($txtMenu_name[$i] != null && $txtMenu_name[$i] != "" && $sel_menutype[$i] != null && $sel_menutype[$i] != "" && $sel_menulink[$i] != null && $sel_menulink[$i] != "" ){
				
				if($sel_menutype[$i] == "4"){
					//Link save to dp
					$str=" insert into ".TPLPrefix."forntmenu (f_menuname, f_menutype, f_link_name, sortingorder, IsActive, UserId, createddate,modifieddate,lang_id)values('".getRealescape($txtMenu_name[$i])."','".$sel_menutype[$i]."','".getRealescape($sel_menulink[$i])."','".$txtMenu_sortby[$i]."','1','".$_SESSION["UserId"]."','".$today."','".$today."','".getRealescape($txtlanguage_name[$i])."') ";
				}
				else{
					//id save to dp
					$str=" insert into ".TPLPrefix."forntmenu (f_menuname, f_menutype, f_link_id, sortingorder, IsActive, UserId, createddate,modifieddate,lang_id)values('".getRealescape($txtMenu_name[$i])."','".$sel_menutype[$i]."','".getRealescape($sel_menulink[$i])."','".$txtMenu_sortby[$i]."','1','".$_SESSION["UserId"]."','".$today."','".$today."','".getRealescape($txtlanguage_name[$i])."') ";
				}								
				$rslt = $db->insert($str);	
				$db->insert_log("insert","".TPLPrefix."forntmenu",$edit_id,"forntmenu inserted","forntmenu",$str);
			}
		}
		echo json_encode(array("rslt"=>"1")); //return insert successfully 
	}
	
}
else{
	echo json_encode(array("rslt"=>"2")); //No Menu Name error 	
}		

}

catch (Exception $e) {
   // echo 'Caught exception: ',  $e->getMessage(), "\n";
	echo json_encode(array("rslt"=>$e->getMessage())); //return 
}

die();
?>