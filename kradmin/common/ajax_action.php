<?php
error_reporting(0);
include_once("../include/config_db.php");

 if(isset($_REQUEST['state_id']) && $_REQUEST['act'] == 'getcity')
{
    $st_id=$_REQUEST['state_id'];
	$cityid=$_REQUEST['city_id'];
    $get_city=  $db->get_results("select * from ".tbl_city." where IsActive=1 and stateid=$st_id order by cityname asc");
     foreach ($get_city as $city)
    { ?>
	<option value="<?php echo $city->cityid; ?>" <?php echo ($cityid == $city->cityid) ? 'selected="selected"' : '';?>><?php echo $city->cityname; ?></option>
<?php
    }
}



 if(isset($_REQUEST['city_id']) && $_REQUEST['act'] == 'getarea')
{
    $st_id=$_REQUEST['city_id'];
	$areaid=$_REQUEST['area_id'];
    $get_area=  $db->get_results("select * from ".tbl_area." where IsActive=1 and cityid=$st_id order by areaname asc");
     foreach ($get_area as $area)
    { ?>
	<option value="<?php echo $area->areaid; ?>" <?php echo ($areaid == $area->areaid) ? 'selected="selected"' : '';?>><?php echo $area->areaname; ?></option>
<?php
    }
}
 if(isset($_REQUEST['txtClientId']) && $_REQUEST['act'] == 'getEmailId')
{
    $ClientId=$_REQUEST['txtClientId'];
	$getGrade=  $db->get_results("select ContactEmail from ".tbl_clientcontact_personemail." where IsActive=1 and ClientId =".$ClientId);
     foreach ($getGrade as $grade)
    { ?>
	<option value="<?php echo $grade->ContactEmail; ?>" ><?php echo $grade->ContactEmail; ?></option>
<?php
    }
}

 


 if(isset($_REQUEST['txtClientId']) && $_REQUEST['act'] == 'getAddressMap')
{
    $ClientId=$_REQUEST['txtClientId'];
	$getAddressMap=  $db->get_results("select id,ClientAddress from ".tbl_client_address." where IsActive=1 and ClientId =".$ClientId);
     foreach ($getAddressMap as $Maps)
    { ?>
	<option value="<?php echo $Maps->id; ?>" ><?php echo $Maps->ClientAddress; ?></option>
<?php
    }
}
if(isset($_REQUEST['txtClientId']) && $_REQUEST['act'] == 'locEmailIdEdit')
{
    $ClientId=$_REQUEST['txtClientId'];
	$EmailId=$_REQUEST['EmailId'];
    $getGrade=  $db->get_results("select ContactEmail from ".tbl_clientcontact_personemail." where IsActive=1 and ClientId =".$ClientId);
     foreach ($getGrade as $grade)
	 
    {
		$sel='';
		if(in_array($grade->ContactEmail,explode(',',$EmailId)) || $selId==$grade->ContactEmail)
				$sel=' selected="selected" ';
		 ?>
    
	<option value="<?php echo $grade->ContactEmail; ?>" <?php echo $sel; ?> ><?php echo $grade->ContactEmail; ?></option>
<?php
    }
}
if(isset($_REQUEST['txtClientId']) && $_REQUEST['act'] == 'locQusAnsIdEdit')
{
    $ClientId=$_REQUEST['txtClientId'];
	$QusAnsId=$_REQUEST['QusAnsId'];
    $getGrade=  $db->get_results("select id,QuestionTitle from ".tbl_questions_answer."  where IsActive=1 and ClientId =".$ClientId);
     foreach ($getGrade as $grade)
	 
    {
		$sel='';
		if(in_array($grade->id,explode(',',$QusAnsId)) || $selId==$grade->id)
				$sel=' selected="selected" ';
		 ?>
    
	<option value="<?php echo $grade->id; ?>" <?php echo $sel; ?> ><?php echo $grade->QuestionTitle; ?></option>
<?php
    }
}
if(isset($_REQUEST['txtClientId']) && $_REQUEST['act'] == 'locAddressMapedit')
{
    $ClientId=$_REQUEST['txtClientId'];
	$Mapid=$_REQUEST['Mapid'];
    $getGrade=  $db->get_results("select id,ClientAddress from ".tbl_client_address." where IsActive=1 and ClientId =".$ClientId);
     foreach ($getGrade as $grade)
	 
    {
		$sel='';
		if($Mapid==$grade->id)
				$sel=' selected="selected" ';
		 ?>
    
	<option value="<?php echo $grade->id; ?>" <?php echo $sel; ?> ><?php echo $grade->ClientAddress; ?></option>
<?php
    }
}
?>