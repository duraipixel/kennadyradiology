<?php 
require_once "Psr4Autoloader.php";
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
$menudisp = "bulkproductupload";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeBulkProductUpload($db,'');

$btn = 'Upload';?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "includes/sidebar.php"; //error_reporting(-1);?>
 
<?php
extract($_POST);



$iserror=0;
if($hdnact == "productcsv_upload"){
	 	
		$loader = new \Autoloader\Psr4Autoloader;
		$loader->register();
		$loader->addNamespace('Box\Spout', 'Spout');
		$file_name= $_FILES["filename"]["name"];
		if ( 0 < $_FILES['filename']['error'] ) {
			$iserror=1;
		}
		else{			
			$fileinfo=pathinfo($file_name);
			switch(strtolower($fileinfo['extension']))
			{
				case "xlsx":
				case "xls":							
							$newfilename = $fileinfo['filename'].round(microtime(true)).'.'.$fileinfo['extension'];
							 
							if(move_uploaded_file($_FILES['filename']['tmp_name'], 'pdtbulkupload/' . $newfilename))
							{
								 
								
								$reader = ReaderFactory::create(Type::XLSX);
								 
								  $filePath=__DIR__.'/pdtbulkupload/'.$newfilename;
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
								//print_r($attrfileds); die();
								$reader->close();
							}
							else
							{
								$iserror=1;
							}
							break;
					
				case "csv":	
								break;
				default:
							$iserror=1;
				
			}			
		}	
}		
 ?>

<?php if(count($basefileds)>0) { 

$resfieldsupload=$db->get_rsltset(" Select * from ".TPLPrefix."productupload_fields where IsActive=1 ");

$resattrfields=$db->get_rsltset(" Select * from ".TPLPrefix."m_attributes where IsActive=1 ");

$selectoptions="";
foreach($basefileds as $key=>$val)
{
  $selectoptions.="<option value=".$val['ind'].">".$key."</option>";
	
}	
$arrAttrSelect=array();
if(count($attrfileds)>0)
{
	
	foreach($attrfileds as $key=>$val){
		$vals=trim($val['val'],",");
			
		$arrvals=explode(",",$vals);		
		$optIndex=explode(",",$basefileds[$key]['ind']);
		
		$selecthtml= ' <select name="prod_attr['.$key.']" id="prod_attr_'.$key.'" class="form-control select2" required  >' ;
		$pos=0;
	
		foreach($arrvals as $opt)
		{
			$selecthtml.="<option value=".$optIndex[$pos].">".$opt."</option>";
			$pos++;
		}
		$selecthtml.="</select>";
		$arrAttrSelect[strtolower($key)]=$selecthtml;
	}
}

//echo $selectoptions; die();
?>

<div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Mapping Upload Products     </h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Bulk Upload</a></li>
              <li class="active"><a href="#">Mapping Upload Products     </a></li> 
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4><?php echo $operation; ?> Mapping Upload Products</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                
                <form id="jvalidate" name="frmprodupload" role="form" class="form-horizontal" action="#" method="post" >
				   <input type="hidden" name="action" value="<?php echo "upload" ?>" />
                   <input type="hidden" id="edit_id" name="edit_id" value="<?php echo $filePath; ?>"  />
				    <input type="hidden" name="isattrienable" value="<?php echo $isattriEnable; ?>"  />
                                    
					<?php foreach($resfieldsupload as $f) { ?>
					
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo $f['fieldname']  ?>  <?php if($f['IsRequired']==1): ?><span class="required-class">* </span> <?php ENDIF; ?></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                      <div class="row">
                        <div class=" col-md-12 control-group mb-4">
                          <div class="controls">
                          <select  name="data_prod[<?php echo $f['fieldId'] ?>]" id="data_prod_<?php echo $f['fieldId'] ?>" <?php echo $f['IsSubAttr']==1 ? ' onchange="chgexcelfield(this.id,this.value);" ': ''; ?>   class="select2 form-control"  <?php echo $f['IsRequired']==1 ? ' required ': ''; ?> >
                        	<option value="">Select</option>
                            <?php echo $selectoptions; ?>
                        </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                         <?php if( $f['IsSubAttr']==1): ?> 
                         <div class="col-md-6 control-group mb-4">
                          <div class="controls  prod_<?php echo $f['fieldId'] ?>">
                          
                          </div>
                         </div>
                         <?php ENDIF; ?>
                      </div>
                    </div>
                    </div>
                    <?php } ?>
					
					
					<?php foreach($resattrfields as $f) { ?>
					
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo $f['attributename']  ?>		</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <select name="attr_prod[<?php echo $f['attributeid'] ?>]" id="prod_<?php echo $f['attributeid'] ?>"   class="form-control select2"  >
                        	<option value="">Select</option>
                            <?php echo $selectoptions; ?>
                        </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
					
                    <?php } ?>  
					
		 
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            
                    <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmt('frmprodupload','mapproductupload_actions.php','jvalidate','Product Upload','bulkproductdownload_mng.php');"><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button> <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmprodupload','jvalidate','Product Upload','bulkproductdownload_mng.php');">Cancel</button>
									 
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 		  
          <!-- Main row -->
<?php } ?>

</div>
<?php include "includes/footer.php"; ?> 
<script src="js/sweetalert2.js" type="text/javascript"></script> 
<script>

function chgexcelfield(fid,val)
{
	
	url = "exceluploadsubattr.php";	
	
	$.post(url,{"fid":fid,"selval":val,"edit_id":$("#edit_id").val()},function(response){
	
		$("."+fid).html(response);
		 
	});
}


//Save data to db all page common function - START		
function funSubmt($frm,$urll,$acts,$stats,$lodlnk)
{    
		
	if ($('#'+$acts).valid()) {
		$("button").attr('disabled',true);
		$.ajax({
			url        : $urll,
			method     : 'POST',
			dataType   : 'json',
			data       : $("#"+$acts).serialize(),
			beforeSend: function() {
				loading();
 			},
			success: function(response){ 
					
			    if(response.error == "1"){
					
					Swal({
							  title: 'Are you sure?',
							  html: response.msg,
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, add it!'
							}).then((result) => {
							  if (result.value) {
								  url = "addexcelvalue.php";
									$.post(url,{"data":response},function(response){							
										funSubmt('frmprodupload','mapproductupload_actions.php','jvalidate','Product Upload','bulkproductdownload_mng.php');
									});
							  }
							});
					
					
					
															
					 //$("#"+$acts)[0].reset();
					//$(location).attr('href', $lodlnk);					
				}
				else if(response.error == "0"){	
					swal("Success!", response.msg, "success");
					$("#"+$acts)[0].reset();
					$(location).attr('href', $lodlnk);						
				}				    
				else{
					swal("Failure!", othmsg, "warning");
				} 
				
				unloading();
				$("button").attr('disabled',false); 	
			}
		});
	}	
}
//Save data to db all page common function - END	

</script> 