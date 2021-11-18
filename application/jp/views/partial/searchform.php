  
  <form id="frmminisearch" name="frmminisearch" action="<?php echo BASE_URL;?>search" method="GET" >
    <div class="input-group">
      <div class="input-group-btn">
		<select class="form-control" name="scat" id="category">
			<option value="">Category</option>
			<?php $parentcatlist=$helper->searchkeyArrays('0',$GLOBALS['allcategories'],'parentId'); 
			   foreach($parentcatlist as $cat) { 
			   $issel='';
			   if($_REQUEST['scat']==$cat['categoryID'])
				    $issel=' selected="selected" ';
			?>
			<option <?php echo $issel; ?> value="<?php echo $cat['categoryID']; ?>"><?php echo $cat['categoryName']; ?></option>
			   <?php } ?>
        </select>
      </div>
      <input type="text" name="q" id="searchfield" value="<?php echo $_REQUEST['q']; ?>" class="form-control" aria-label="..." placeholder="Hey, What are you looking for?" required=''>
	  <?php
	  $randomtoken = base64_encode( openssl_random_pseudo_bytes(32));
	  $_SESSION['csrfToken']=$randomtoken;
	  include('nocsrf.php');
	  $token = NoCSRF::generate( 'csrf_token' );
	  ?>
	
	  <span class="input-group-addon"><button type="submit" class="search-submit"><i class="fa fa-search"></i></button></span>
	  
    </div>
	</form>
  