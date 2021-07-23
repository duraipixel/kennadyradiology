<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

include "common/dpselect-functions.php";

switch($act)
{		
	case "stateList" :
		$stateList = getSelectBox_statelist($db,'StateID','jsrequired',$res_ed['StateID'],' required ',$CountryID);
		echo $stateList;
	break;
	
	case "cityList" :
		
		$cityList = getSelectBox_citieslist($db,'CityID','jsrequired','',' required ',$StateID);
		echo $cityList;
	break;
	
}

function date_range($first, $last, $step = '+1 day', $output_format = 'd-m-Y' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

?>
