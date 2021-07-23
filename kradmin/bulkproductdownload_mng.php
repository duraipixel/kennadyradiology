<?php 
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
  
  <?php include "includes/sidebar.php";?>
  
  <!--  END SIDEBAR  --> 
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Bulk Upload</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Bulk Upload</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-md-8">
                  <h4> Bulk Product Image Upload</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <form id="jvalidate_pdtcsvdownload" name="frmUploadcsv" role="form" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-11 control-label">Before Start Product Images Upload Process, kindly upload all product name under folder "uploadproductimages" inside Root Folder.</label>
                </div>
                <div class="form-group">
                  <div class="col-sm-12" align="center">
                    <button class="btn btn-warning btn-rounded mb-4 mr-2" type="button" onClick="ProductCSV_download();" ><span id="spSubmit"><i class="fa fa-download"></i> Upload Images </span></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      
            <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
               
                <div class="col-md-8"><h4> Product Bulk Upload</h4></div>
                  <div class="col-md-4 align-right"><h4>  <a  class="btn btn-warning btn-rounded mb-4 mr-2" href="sampleuploadfile.xlsx" download><i class="fa fa-download"></i> Download Sample File</a></h4></div>
                
                 
              </div>
            </div>
            <div class="widget-content widget-content-area">
            
            <form id="jvalidate" name="frmUploadcsv" role="form" class="form-horizontal" action="mapproductupload.php"  method="post" enctype="multipart/form-data" >	
				   <input type="hidden" name="hdnact" id="hdnact" value="productcsv_upload" />                    
                  <div class="form-group">
					<div class="col-sm-12" align="center">
					    <input type="file" name="filename" id="uploadfile" accept=".xls,.xlsx" class="common_upload_style_xl" required='' />
                      
                      <label class="col-sm-3 control-label" for="uploadfile">Upload your File (.xlsx)</label>
                    </div>  
                    </div>
					 
					  <div class="form-group">
                  <div class="col-sm-12" align="center">
                    <button class="btn btn-dark btn-rounded mb-4 mr-2" type="reset">Cancel</button>
                    <button class="btn btn-warning btn-rounded mb-4 mr-2" type="submit"  onclick="validation();" ><span id="spSubmit"><i class="fa fa-save"></i> Upload</span></button>
                     </div>
                  </div><!-- /.box-footer -->
										
				  </form>
                  
              
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <!--  END CONTENT PART  --> 
</div>
<!-- END MAIN CONTAINER --> 

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->

<script type="text/javascript">
function ProductCSV_download(){
	var url = "pdtimgupload_actions.php"; 
	$.ajax({
			url: url,				
			dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
				loading();
 			},
            type: 'post',
			success: function(result) {		
		
				if(result.error=='0'){	
					swal("Success!","Products images Upload Successfully", "success");	
				//	location.reload();
					unloading();					
				}				
				else {					
					swal("Failure!"," Timeout Error", "warning");
					//location.reload();					
					unloading();						
				}
			},
			error: function (error) {
					swal("Failure!"," Timeout Error, Please Click Upload Images ", "warning");
					//location.reload();					
					unloading();	
			}
	    }); 
	
	//$(location).attr('href',url);	
}

function validation(){
	if ($('#uploadfile').get(0).files.length === 0) {		  
		  swal("Failure!","Please select upload File.", "warning");
		  return false;
	 }
	
	return true;
} 

function ProductCSV_upload(){
	var chk = validation();
	
	if(chk == true){
		loading();
		var txt_hdnact = $('#hdnact').val();
		var file_data = $('#uploadfile').prop('files')[0];   
		var form_data = new FormData();  
		form_data.append('file', file_data);
		form_data.append('hdnact', txt_hdnact);	
		
		$.ajax({
			url: 'excel_download_actions.php',				
			dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
			success: function(result) {														
				if(result =='success'){	
					swal("Success!","Products Upload Successfully", "success");	
					location.reload();
					unloading();					
				}
				else if(result =='empty'){					
					swal("Failure!","Files header are empty", "warning");	
					unloading();
				}
				else {					
					swal("Failure!",result, "warning");	
					unloading();						
				}
			}
	    }); 
		
		
	}
	
}

</script>

	