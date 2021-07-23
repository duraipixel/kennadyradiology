<?php
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
include 'session.php';
require_once "Psr4Autoloader.php";
extract($_REQUEST);
$act=$action;

					
$iserror=0;
$loader = new \Autoloader\Psr4Autoloader;
$loader->register();
$loader->addNamespace('Box\Spout', 'Spout');
	
$fileinfo=pathinfo($edit_id);

				
switch(trim(strtolower($fileinfo['extension'])))
{
	case "xlsx":
	case "xls":							
																
					$reader = ReaderFactory::create(Type::XLSX);
					 $filePath=$edit_id;
					
					$reader->open($filePath);
					$basefileds=array();
					$attrfileds=array();
					$prevrow=array();
					$isattriEnable=0;
					foreach ($reader->getSheetIterator() as $sheet) {
   
									if ($sheet->getIndex() == '0') {
									  $cnt = 0;
										foreach ($sheet->getRowIterator() as $row) {
											if($cnt==0){
												$prevfield='';
												$prevrow=$row;
										      foreach($row as $key=>$val)
											  {
													if($val!='')
													{
														$basefileds[$val]['ind']=$key;
														$prevfield=$val;
													}
													else{
															$basefileds[$prevfield]['ind']=$basefileds[$prevfield]['ind'].','.$key;
															$isattriEnable=1;
													    }
											  }											  
											}
											else if($cnt==1 && $isattriEnable==1)
											{
												$flag=0;
												$flagattrind=0;
												$mainattrind=0;
												foreach($row as $key=>$val)
												{
													if($val!='')
													{
													 back:
														$attrvalue=explode(",",$basefileds[$prevrow[$mainattrind+1]]['ind']); 
														if(in_array($key,$attrvalue))
														{
															$attrfileds[$prevrow[$mainattrind+1]]['val']=$attrfileds[$prevrow[$mainattrind+1]]['val'].','.$val;
															
															
														}
														else{		
															$mainattrind=$flagattrind;
															$mainattrind-=1;
															goto back;
														}		
													}
													else{
														
														$flag=1;
														$mainattrind=$flagattrind;
													}
													$flagattrind++;
												}
											}											
											else
											{
												break;
											}
											
											
										  $cnt++;
										}
										break; 
									}
								}
				
					
				
				break;
	case "csv":	
					break;
	default:
				
				$iserror=1;
				break;
}		
?>


<?php if(count($basefileds)>0) { 
 $find=substr($fid,5,strlen($fid)-1);

foreach($basefileds as $key=>$val)
{
  if($val['ind']==$selval)
  {
	  $vals=trim($attrfileds[$key]['val'],",");
	  $arrvals=explode(",",$vals);		
	  $optIndex=explode(",",$basefileds[$key]['ind']);
	  $selecthtml= ' <select name="prod_attr['.$find.']['.$basefileds[$key]['ind'].']" id="prod_attr_'.$key.'" class="form-control jsrequired "  >' ;
		$pos=0;
	
		foreach($arrvals as $opt)
		{
			$selecthtml.="<option value=".$optIndex[$pos].">".$opt."</option>";
			$pos++;
		}
		$selecthtml.="</select>";		
  }
	
}
	echo $selecthtml;
// $arrAttrSelect=array();
// if(count($attrfileds)>0)
// {
	
	// foreach($attrfileds as $key=>$val){
		// $vals=trim($val['val'],",");
			
		// $arrvals=explode(",",$vals);		
		// $optIndex=explode(",",$basefileds[$key]['ind']);
		
		// $selecthtml= ' <select name="prod_attr['.$key.']" id="prod_attr_'.$key.'" class="form-control jsrequired "  >' ;
		// $pos=0;
	
		// foreach($arrvals as $opt)
		// {
			// $selecthtml.="<option value=".$optIndex[$pos].">".$opt."</option>";
			// $pos++;
		// }
		// $selecthtml.="</select>";
		// $arrAttrSelect[strtolower($key)]=$selecthtml;
	// }
// }

//echo $selectoptions; die();
}
?>
