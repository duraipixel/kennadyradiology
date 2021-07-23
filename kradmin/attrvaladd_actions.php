<?php 
include 'session.php';
extract($_REQUEST);
$today=date("Y-m-d");

try {
	
	
if(isset($attribute_id)){	
	if(isset($txtAttr_val)){
		if(isset($prev_attroptionids)){
			
			//delete previous attribute options are removed - START
			$arr_delattropt=array_diff($prev_attroptionids,$new_attroptionids_update);			
			if(isset($arr_delattropt)){				
				foreach($arr_delattropt as $arr_delattropt_s){
					//echo $arr_delattropt_s; echo "<br/>\n\n";
					$str = "update ".TPLPrefix."customfields_attrvalues set IsActive = ?, UserId=?  where AttributeOptionId = ?";
					$db->insert_bind($str,array('2',$_SESSION["UserId"],$arr_delattropt_s));
				}
			}
			//delete previous attribute options are removed - END
			
			
			//previous attribute options are update or insert new attribute options  - START
			for($i=0;$i <count($txtAttr_val); $i++ ){
				
				if(isset($new_attroptionids_update[$i])){
					//prev options are update	
					if($txtAttr_val[$i] !="" ){
						$str = "update ".TPLPrefix."customfields_attrvalues set AttributeValue = ?, SortBy= ?, UserId= ?  where AttributeOptionId = ?";
						$db->insert_bind($str,array(getRealescape($txtAttr_val[$i]),$txtAttr_sortby[$i],$_SESSION["UserId"],$new_attroptionids_update[$i]));
					}
					
				}
				else{
					//insert new options					
					if($txtAttr_val[$i] !="" ){
						$str="insert into ".TPLPrefix."customfields_attrvalues  ( AttributeId, AttributeValue, SortBy, IsActive, UserId, CreateDate)values(?,?,?,?,?,?)";
						$rslt = $db->insert_bind($str,array($attribute_id,getRealescape($txtAttr_val[$i],$txtAttr_sortby[$i],'1',$_SESSION["UserId"],$today)));	
					}					
				}
			}
			//previous attribute options are update or insert new attribute options  - END
			
			echo json_encode(array("rslt"=>"1")); //return insert successfully 
			
		}
		else{
			// All options are new
			for($i=0;$i <count($txtAttr_val); $i++ ){
				//insert attibute options one by one
				
				if($txtAttr_val[$i] !="" ){
					$str="insert into ".TPLPrefix."customfields_attrvalues  ( AttributeId, AttributeValue, SortBy, IsActive, UserId, CreateDate)values(?,?,?,?,?,?)";
					$rslt = $db->insert_bind($str,array($attribute_id,getRealescape($txtAttr_val[$i]),$txtAttr_sortby[$i],'1',$_SESSION["UserId"],$today));	
				}
				
				//echo $txtAttr_val[$i]."--".$txtAttr_sortby[$i]; echo "<br/>\n";				
			}			
			echo json_encode(array("rslt"=>"1")); //return insert successfully 
			
		}
	}
	else{
		echo json_encode(array("rslt"=>"3")); // Attribute Options values empty 
	}
}
else{
	echo json_encode(array("rslt"=>"2")); //Attribute Missing error 	
}


}

catch (Exception $e) {
   // echo 'Caught exception: ',  $e->getMessage(), "\n";
	echo json_encode(array("rslt"=>$e->getMessage())); //return 
}

die();
?>