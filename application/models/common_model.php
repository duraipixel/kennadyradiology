<?php
class common_model extends Model {
	################## Home Page ###############

	function getbannerdisplay($position="''"){
	//$position=$this->real_escape_string($position);
	 $str_all="select t1.* from ".TPLPrefix."banners t1 inner join  ".TPLPrefix."bannerposition t2 on  t1.Bannerposition=t2.bannaerposition and t2.bannaername='".$position."' and t2.IsActive =1  where  t1.IsActive=1 and t1.lang_id = ".$_SESSION['lang_id']." order by t1.SortingOrder asc "; 
	//die();
	//$resulst=$this->get_rsltset_bind($str_all,array($position));
	$resulst=$this->get_rsltset($str_all);	
	//print_r($resulst);die();
	return $resulst;	
		
	}
	
	//Product Request quote		
 function saveproductQuote($exact_data){
		
	$created=date('Y-m-d H:i:s');

	$strunicode = "select count(*) as keycnt from ".TPLPrefix."prodenquire where EmailId = '".$exact_data['txtemail']."' and ProductId = '".$exact_data['eproductid']."' and IsActive != '2'";
	
	$reslt = $this->get_a_line($strunicode);
 	
	if($exact_data['eproductid'] != ''){
	$getstoreproductid = $this->get_a_line("select product_name from ".TPLPrefix."product where product_id = '".$exact_data['eproductid']."'"); 
	if( $reslt['keycnt'] == 0) {
		
	
	  $str = "insert into  ".TPLPrefix."prodenquire (ProductId, productname, organization, firstname, lastname, EmailId, MobileNo, Query, userId, IsActive, CreatedDate, ModifiedDate) VALUES ('".$exact_data['eproductid']."','".$getstoreproductid['product_name']."','".$exact_data['companyname']."','".$exact_data['txtname']."','".$exact_data['txtlname']."','".$this->getRealescape($exact_data['txtemail'])."','".$exact_data['txtmobile']."','".$this->getRealescape($exact_data['txtcomment'])."','0',1,'".trim($created)."','".trim($created)."')"; 
	 
		$rslt = $this->insert($str);	
		$last_insert = $this->lastInsertId();
		
		if($exact_data['txtemail'] != ''){
			 	require_once (__DIR__.'/mailsend.php');
			 echo productEnquiryquote($this,$last_insert);		
		}
		
	echo json_encode(array("rslt"=>"0")); //Success
	}
	else
	{
	echo json_encode(array("rslt"=>"1")); //failure
	}
  }
  else
  {
	     echo json_encode(array("rslt"=>"3")); //failure
	   
  }
  
  
	}
	
	
	function getourclientslogo($logoname="''"){
		
		switch($logoname)	
		{
			case "client":
			 
			$str_all="select * from ".TPLPrefix."manageclient where IsActive=1  order by SortingOrder asc "; 
			 //echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);	
			
			 
			break;
			
			case "memberof":
			 
			$str_all="select * from ".TPLPrefix."manage_memberof where IsActive=1  order by SortingOrder asc ";
			 //echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);	
			
			 
			break;
			
			case "brandtieup":
			 
			$str_all="select * from ".TPLPrefix."managetieup where IsActive=1  ";
			 //echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);	
			
			 
			break;
			
			case "manufacturer":
			 
			$str_all="select * from ".TPLPrefix."manufacturer where IsActive=1  ";
			 //echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);	
			
			 
			break;
		}
		return $resulst; 
	}
	
	function subscribemail($filters)
	{   
	     $today = date("Y-m-d H:i:s");
		//print_r($_REQUEST);
		 //echo $filters['mailid']; exit;
		
		//$position=$this->real_escape_string($position);
		
		  $select_email = "select subscribeid from ".TPLPrefix."subscribe where IsActive=1 and emailid= '".$this->getRealescape($filters['mailid'])."' ";
		 $rsltdata=$this->get_rsltset($select_email);
		 
		if(count($rsltdata)>0){
			 echo json_encode(array("rslt"=>2));
			 exit;
		}
		else{
			$strQry ="INSERT INTO  ".TPLPrefix."subscribe (emailid,  IsActive, UserId, createddate,modifiedDate ) VALUES ( '".$this->getRealescape($filters['mailid'])."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
			$rsltMenu=$this->insert($strQry);
		    $InsertId = $this->lastInsertId();
		    if($rsltMenu){
		    //echo APP_DIR .'models/mailsend.php'; die();
		    require_once(APP_DIR .'models/mailsend.php');
		    subscribmailsendfunction($this,$InsertId);
		    echo json_encode(array("rslt"=>1));
		    }
		}
	}
	
	function loginuser($filters)
	{
		session_start();
		// print_r($_SESSION); die();
	   $username = $this->getRealescape($filters['email']);
	   $password = md5($filters['pwd']); 
		$str_all="select * from ".TPLPrefix."customers  where  customer_username='".$username."' and customer_pwd = '".$password."' and  IsActive=1 "; 
	
	    $resulst=$this->get_rsltset($str_all);	
	    if($resulst){
			
		// print_r($resulst); exit;
	    $_SESSION['First_name'] = $resulst[0]['customer_firstname'];
		$_SESSION['Cus_ID']= $resulst[0]['customer_id'];
		$_SESSION['cus_group_id']= $resulst[0]['customer_group_id'];
		$_SESSION['emailid']= $resulst[0]['customer_email'];
		$sessionId=session_id();

		
		$IsCartSessionexist=$this->get_a_line("select count(*) as cnt from ".TPLPrefix."carts where IsActive=1 and sessionId='".$sessionId."' ");

	if($IsCartSessionexist['cnt']>0){	
		$IsCartexist=$this->get_a_line("select count(*) as cnt,max(cart_id) as cart_id  from ".TPLPrefix."carts where IsActive=1 and customer_id='".$_SESSION['Cus_ID']."'  ");
	//	print_r($IsCartexist); 
			if($IsCartexist['cnt']>0)
			{
							
				$this->insert(" update ".TPLPrefix."cart_products cp1 
				inner join (select t1.cart_id,t2.product_id from ".TPLPrefix."carts t1
				inner join ".TPLPrefix."cart_products t2 on t1.cart_id=t2.cart_id and t2.IsActive=1 
				where t1.sessionId='".$sessionId."' and t2.IsActive=1 and 
				t2.product_id not in (select t2.product_id from ".TPLPrefix."cart_products t2 
				where t2.cart_id='".$IsCartexist['cart_id']."' and t2.IsActive=1) ) cp2  on cp1.cart_id=cp2.cart_id and cp1.product_id=cp2.product_id
				set cp1.cart_id='".$IsCartexist['cart_id']."' 
				where cp1.IsActive=1 and cp2.product_id is not null and cp2.cart_id  is not null ");

			
				$this->insert(" update ".TPLPrefix."cart_products cp1 
				inner join ".TPLPrefix."carts c on  c.cart_id=cp1.cart_id and c.IsActive=1 
				set cp1.IsActive=2 ,c.IsActive=2
				where cp1.IsActive=1 and  c.sessionId='".$sessionId."'");
				
		
			}
			else{
				$updateqry=" update ".TPLPrefix."carts set customer_id='".$_SESSION['Cus_ID']."',customer_group_id='".$_SESSION['cus_group_id']."',sessionId='' where IsActive=1 and sessionId='".$sessionId."' ";
				$this->insert($updateqry);
			}	
		}
            //select cart_id
			
			/*  $str_qry="select t2.product_id from ".TPLPrefix."carts t1 inner join ".TPLPrefix."cart_products t2 on t1.cart_id=t2.cart_id and t2.IsActive=1 where  t1.customer_id='".$_SESSION['Cus_ID']."' and  t2.IsActive=1 "; 
	       // $cus_data=$this->get_rsltset($str_qry);
			//print_r($cus_data);
			 $str_qry="select t1.cart_id,t2.product_id from ".TPLPrefix."carts t1 inner join ".TPLPrefix."cart_products t2 on t1.cart_id=t2.cart_id and t2.IsActive=1 where  t1.sessionId='".$sessionId."' and  t2.IsActive=1 ";   exit;
	       // $sess_data=$this->get_rsltset($str_qry);
			//print_r($sess_data); exit;
			
			//in_array(search,array,type)!in_array(0,$genstatus_arr)
			//update Customer_id
			foreach($sess_data as $value){
				if(!in_array($value['product_id'],$cus_data)){
					
					$str_qryupdate="update ".TPLPrefix."carts  set customer_id ='".$_SESSION['Cus_ID']."', customer_group_id = '".$_SESSION['cus_group_id']."', sessionId ='' where cart_id = '".$value['cart_id']."' and IsActive=1 "; 
					//$data=$this->insert($str_qryupdate);
				}
			} */
 			
			$checkrecent=$this->get_a_line("select count(*) as cnt from ".TPLPrefix."recentview where IsActive=1 and session_id='".$sessionId."' "); 
	//	print_r($IsCartexist); 
			if($checkrecent['cnt']>0)
			{
				$updateqry=" update ".TPLPrefix."recentview set customer_id='".$_SESSION['Cus_ID']."',session_id='' where IsActive=1 and session_id='".$sessionId."' ";
				$this->insert($updateqry);
				
			}
         	//echo"sdhfrgd".$_SESSION['refererurlwish']; exit;	
			echo json_encode(array("rslt"=>1,"pid"=>$_SESSION['productid'],"wishlist"=>$_SESSION['type'],"url"=>$_SESSION['refererurl'],"minqty"=>$_SESSION['minqty'],'type'=>$_SESSION['typedpc'],'urldpc'=>$_SESSION['refererurldpc'])); //login success
	    }
		else{
			
			echo json_encode(array("rslt"=>2)); //login failure
		}
	}
	
	
	function getmyaccountdetails($cus_ID)
	{ 
	   $cus_ID=$this->real_escape_string($cus_ID);
		
		$str_all="select * from ".TPLPrefix."customers  where  customer_id=?  and  IsActive=1 "; 
	
	    $resulst=$this->get_rsltset_bind($str_all,array($cus_ID));	
		return $resulst;
	}
	
	function getsubscribedetails($emailid)
	{
		 $emailid=$this->real_escape_string($emailid);
		$str_all="select count(*) as cnt from ".TPLPrefix."subscribe  where  emailid='".$emailid."'  and  IsActive=1 "; 
	    $resulst=$this->get_a_line_bind($str_all,array($emailid));	
		return $resulst;
	}
	
	function getorderdetails_history()
	{

        $str_all= " SELECT t1.*,t2.order_statusName as order_status,(case when t1.order_status_id in ('1','5') then  'Unsuccess'
			else
			'Success' end) as paymentstatus  FROM  `".TPLPrefix."orders` t1 inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id where  t1.IsActive=1 order by order_id desc  "; 			
	   // echo $str_all; exit;
	    $resulst=$this->get_rsltset($str_all);	
		return $resulst;
	}
	
	function getorderdetails_vieworder($orderid)
	{
	  $orderid=$this->real_escape_string($orderid);
	  $conqry="";
	  
	  if($_SESSION['Cus_ID']==''){
		  	if($_SESSION['Isguestcheckout']=="1" && $_SESSION['guestckout_sess_id']!=""){	
			 $customer_id=session_id();
			}
	  }
	  else{
		  $customer_id=$_SESSION['Cus_ID'];
		$conqry=" inner join ".TPLPrefix."customers t3 on t3.customer_id = t1.customer_id ";
	  }
	  
        $str_all= " SELECT t1.*,Date_Format(t1.date_added,'%d-%m-%Y') as date,Date_Format(t1.date_added,'%H:%i') as time,t2.order_statusName as order_status,(case when t1.order_status_id in ('1','5') then  'Unsuccess'				
	  else 'Success' end) as paymentstatus,t4.product_sku,t4.order_product_id,t4.product_name,t4.product_qty,t4.product_price,t4.prod_attr_price,t4.prod_sub_total,t4.product_id,t4.tax_type,t4.tax_value,t4.tax_name,t5.img_path,t6.countryname as billingcountry,t7.statename as billingstate,t8.countryname as shippingcountry,t9.statename as shippingstate,t10.Attribute_Name,t10.Attribute_value_name,t4.IsCustomtool, t4.CustomtoolImg, (SELECT  group_concat(
					  DISTINCT img.img_path ORDER BY
											   img.ordering ASC SEPARATOR '|')  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."orders_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
				inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1     
					
           WHERE     adrp.base_productId =t4.product_id 
                 AND t10.order_product_id = t4.product_id
                 AND adrp.IsActive = 1)
          AS attr_images   FROM  ".TPLPrefix."orders t1  ".$conqry."    left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."orders_products t4 on t1.order_id=t4.order_id and t4.IsActive=1
      left join ".TPLPrefix."orders_products_attribute t10 on t10.order_product_id=t4.order_product_id and t10.IsActive=1 
	 left join ".TPLPrefix."product_images t5 on t5.product_id=t4.product_id and t5.IsActive=1 and t5.ordering=1 inner join ".TPLPrefix."country t6 on t1.payment_country_id=t6.countryid and t6.IsActive=1 inner join ".TPLPrefix."state t7 on t1.paymentStateId=t7.stateid and t7.IsActive=1 inner join ".TPLPrefix."country t8 on t1.shipping_country_id=t8.countryid and t8.IsActive=1 inner join ".TPLPrefix."state t9 on t1.shipping_state_id=t9.stateid and t9.IsActive=1  where t1.customer_id='".$customer_id."' and t1.IsActive=1 and t1.order_reference= ? group by t4.order_product_id "; 
	   
		//echo $str_all;
	    $resulst=$this->get_rsltset_bind($str_all,array($orderid));	
		return $resulst;
	}
	
	function contactform($filters)
	{ 
	
	    $today = date("Y-m-d H:i:s");
	 	$strQry ="INSERT INTO  ".TPLPrefix."contactform (contactname, contactemail,contactmobile,contactmessage,IsActive, userid, createdate,modifieddate,location ) VALUES ('".$this->getRealescape($filters['iname'])."','".$this->getRealescape($filters['iemail'])."','".$this->getRealescape($filters['iphone'])."','".$this->getRealescape($filters['amessage'])."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."','".$this->getRealescape($filters['location'])."');";
		$resulst=$this->insert($strQry);
	
        $insert_cusId = $this->lastInsertId();	
       if($resulst){  		
		   require_once (__DIR__.'/mailsend.php');
		   //send mail function -()
		   contactusform($this,$insert_cusId);
		echo json_encode(array("rslt"=>1));   
	   }
	   else{
		echo json_encode(array("rslt"=>2));  
        exit;		
	   }
		
	}
	
	
	function reachusform($filters)
	{ 
	    $today = date("Y-m-d H:i:s");
		$strQry ="INSERT INTO  ".TPLPrefix."reachusform (contactname, contactemail,contactmobile,IsActive, userid, createdate,modifieddate ) VALUES ('".$this->getRealescape($filters['iname'])."','".$this->getRealescape($filters['iemail'])."','".$this->getRealescape($filters['icontactno'])."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');";
		$resulst=$this->insert($strQry);
        $insert_cusId = $this->lastInsertId();	
       if($resulst){  		
		   require_once (__DIR__.'/mailsend.php');
		   //send mail function -()
		   reachusform($this,$insert_cusId);
		echo json_encode(array("rslt"=>1));   
	   }
	   else{
		echo json_encode(array("rslt"=>2));  
        exit;		
	   }
		
	}
	
	function forgetpasswords($filters)
	{ 
		$filters['emails']=$this->real_escape_string($filters['emails']);
	    $today = date("Y-m-d H:i:s");
	  	$str_all="select customer_id,customer_group_id from ".TPLPrefix."customers  where  customer_email=?  and  IsActive=1 "; 
	
	    $resulst=$this->get_a_line_bind($str_all,array($filters['emails']));
        $customerid = $resulst['customer_id'];	
         $cus_groupid = $resulst['customer_group_id'];		
		if($customerid){
			
			    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $verificationcode = array(); 
                $alpha_length = strlen($alphabet) - 1; 
                for ($i = 0; $i < 8; $i++) 
                    {
                    $n = rand(0, $alpha_length);
                    $verificationcode[] = $alphabet[$n];
                    }
                $verificationcodes = implode($verificationcode);
		        $verification = $verificationcodes.time();
				
			$strQry ="INSERT INTO  ".TPLPrefix."password_verification (cus_groupid, customerid, passverification, IsActive, createddate,modifieddate ) VALUES ( '".$cus_groupid."', '".$customerid."',  '".$verification."', '1','".$this->getRealescape($today)."','".$this->getRealescape($today)."')";
		    
	        $str_qry=$this->insert($strQry);
			
			 require_once (__DIR__.'/mailsend.php');
		   //send mail function -()
		   forgetpasswordmailfunction($this,$filters['emails'],$verification);
		
			 echo json_encode(array("rslt"=>1));
		}
		else
		{
			 echo json_encode(array("rslt"=>2));
		}
	}
	
	
	function reset_password($passwordid)
	{
		$passwordid=$this->real_escape_string($passwordid);
		 //select query
		 $select_qry = "select t1.customer_id from ".TPLPrefix."customers t1 inner join ".TPLPrefix."password_verification t2 on t1.customer_id=t2.customerid and t2.IsActive=1 and t2.passverification=? where t1.IsActive='1' ";
		
		 $rsltAdd=$this->get_a_line_bind($select_qry,array($passwordid));
	     $cus_id =  $rsltAdd['customer_id']; 
		 
		 /*
		$str=" update ".TPLPrefix."customers set IsActive= '1' where customer_id='".$cus_id."' ";		  
	    $rsltMenu = $this->insert($str);Mk59o2x31545832952
		return $rsltMenu;
		*/
		return $cus_id;
	}
	
	function resetpassword($filters) //by ajax update password
	{
		$password = md5($filters['newpassword']);
		$str=" update ".TPLPrefix."customers set customer_pwd= '".$password."' where customer_id='".$this->getRealescape($filters['customerid'])."' and IsActive=1 ";		  
	    $rsltMenu = $this->insert($str);
		
		if($rsltMenu){
			echo json_encode(array("rslt"=>1));
		}
		else{
			echo json_encode(array("rslt"=>2));
		}
	}
	
	function giftvoucher($filters)
	{
		$today = date("Y-m-d H:i:s");
		if($filters['nonrefundable'] !=null)
	    $status =1;
        else
		$status =0;
	
		$insert_qry = "INSERT INTO ".TPLPrefix."giftvoucher(recipientsname,recipientsemail,yourname,youremail,giftcertificatetheme,amount,message,nonrefundable,IsActive,createdate,modifidate)VALUES('".$this->getRealescape($filters['recipientsname'])."','".$this->getRealescape($filters['recipientsemail'])."','".$this->getRealescape($filters['yourname'])."','".$this->getRealescape($filters['youremail'])."','".$this->getRealescape($filters['giftcertificatetheme'])."','".$this->getRealescape($filters['amount'])."','".$this->getRealescape($filters['message'])."','".$status."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."')";
		$rsltMenu = $this->insert($insert_qry);
		echo json_encode(array("rslt"=>1));
	}
	
	
	function getdynamicformfields($tablename)
	{
		
		
		
			$tablename=$this->real_escape_string($tablename);
		$str_all="select t2.*,t3.elementid,t3.elementname,t3.element_type from ".TPLPrefix."formbuilder t1 inner join ".TPLPrefix."fb_attributes t2 on t1.FormId=t2.FormId and t2.IsActive=1 inner join ".TPLPrefix."m_elements t3 on t3.elementid=t2.AttributeType and t3.IsActive=1 where t1.fromtablename=? group by t2.AttributeCode order by sortBy asc ";
		
		
	$Get_customFields=$this->get_rsltset_bind($str_all,array($tablename));	
		
	//	echo"<pre>"; print_r($Get_customFields); exit;
	
          $customFields_cnt = count($Get_customFields);	
       if($customFields_cnt > 0)
        {
			$dynamic_html = '';
							   
			foreach($Get_customFields as $Get_customFields_S)
			{ 		
					
				if($Get_customFields_S['element_type'] == 1 )
				{
					//textbox, textarea field
					$edit_id=$this->real_escape_string($edit_id);

					$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
					//echo $get_editval
					if($Get_customFields_S['elementid'] == 1){
						//textbox
						$onlynum ='';
						if(in_array($Get_customFields_S['AttributeId'],array('17','21','22','23','24','25','28') ) ){
							$onlynum = 'numericvalidate';
						}
						
						if(in_array($Get_customFields_S['AttributeId'],array('18','29') ) ){
							$type='email';
						}
						else{
							$type='text';
						}
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />
						<input type="'.$type.'" class="form-control '.$onlynum.' '.$Get_customFields_S['MandatoryAttr'].'" name="'.$Get_customFields_S['AttributeName'].'" value="'.$get_editval['AttributeValue'].'" placeholder="'.$Get_customFields_S['AttributeCode'].'" /></div>'; 	
                     					
					}
					else if($Get_customFields_S['elementid'] == 2){
						//textarea
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><textarea      placeholder="'.$Get_customFields_S['AttributeCode'].'" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="'.$Get_customFields_S['AttributeName'].'" >'.$get_editval['AttributeValue'].'</textarea></div>'; 				
					}

                    else if($Get_customFields_S['elementid'] == 8){
						//File Type 
						$accepttype =$Get_customFields_S['accept_filetype'];
						$filecount = $Get_customFields_S['numberoffile'];
						
					    $dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /> <input type="hidden" name="actions" value="Filetype"  />
						<label class=" control-label">'.$Get_customFields_S['AttributeCode'].'</label><div class=""><input type="file" class="form-control '.$Get_customFields_S['MandatoryAttr'].' customfiledsfile" id="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" name="'.$Get_customFields_S['AttributeName'].'" value="'.$get_editval['AttributeValue'].'"  accept="'.$Get_customFields_S['accept_filetype'].'"  / ></div> <div class="form-upload" id="uploadedcustomer"></div>
                        <small>(accept file type : '.$accepttype.')</small>
						</div>'; 	

                    }	

                    else if($Get_customFields_S['elementid'] == 9){
                     
                        $get_editval = $this->get_a_line("select t2.*,t1.AttributeName,t1.AttributeId,t1.FormId,t1.masterid,t1.masterdependentid,t2.defaultvalue from ".TPLPrefix."fb_attributes t1 inner join ".TPLPrefix."mastertables t2 on t1.masterid=t2.MasterId and t1.IsActive=1 where t1.IsActive = 1 and t1.AttributeId ='".$Get_customFields_S['AttributeId']."'  ");
						
						//echo "<pre>"; print_r($get_editval); exit;
						if($get_editval['masterdependentid']!=''){
							
							 $get_tablename = $this->get_a_line("select t2.tablesname,t2.ColumnName,t2.ValueCoumn,t2.displayname,t2.defaultvalue from ".TPLPrefix."fb_attributes t1 inner join ".TPLPrefix."mastertables t2 on t2.MasterId = '".$get_editval['masterdependentid']."' and t1.IsActive=1 where t1.IsActive = 1 and t1.AttributeId ='".$get_editval['AttributeId']."' ");
							 
							
							 
							//echo "<pre>"; print_r($get_tablename); exit;
							
							//$action = "onchange='onchange_function(this.value,\"".$get_tablename['tablesname']."\",\"".$get_tablename['ColumnName']."\",\"".$get_tablename['ValueCoumn']."\",\"".$get_tablename['displayname']."\",\"".$get_editval['ValueCoumn']."\")' ";
							$action ="";
						}
						else{
							$action ="";
						}
						
						if($get_editval['masterdependentid']!='' && !empty($get_editval['defaultvalue']) ){
							
						  $afterscript="  <script> document.addEventListener('DOMContentLoaded', function(event) {
							 
							onchange_function('".$get_editval['defaultvalue']."',\"".$get_tablename['tablesname']."\",\"".$get_tablename['ColumnName']."\",\"".$get_tablename['ValueCoumn']."\",\"".$get_tablename['displayname']."\",\"".$get_editval['ValueCoumn']."\");
						  }); </script> ";	
							
						}
						
						$additionalcond ='';
						if($get_tablename['tablesname']=='category'){
							$additionalcond = " and parentId!=0 ";
						}
						$helper=$this->loadHelper('common_function');
						$selbx_html = $helper->getSelectBox_displaymastertable($get_editval['AttributeName'],$get_editval['ValueCoumn'],$get_editval['ColumnName'],$get_editval['tablesname'],$get_editval['defaultvalue'],$action,'',$afterscript,$additionalcond);
						if($get_editval['AttributeName']=="")
						{



						}			
						
							$dynamic_html .= ' <div class="" id="row1">
  <div class="form-group addsec remsec addsecne remsec remsecnew">
	<label class="control-label col-md-2 col-sm-4 col-xs-12 l-label" for="" >Contact Person<span class="required">*</span></label>
	<div class="col-md-3 col-sm-8 col-xs-12">
	  <input type="text" class="form-control" required  id="practice_contact_name0" name="practice_contact_name0" placeholder="Contact Name" />
	</div>
	<div class="col-md-3 col-sm-8 col-xs-12">
	  <input type="email" class="form-control" required  id="practice_contact_email0" name="practice_contact_email0" placeholder="Email" />
	</div>
	<div class="col-md-3 col-sm-8 col-xs-12">
	  <input type="text" class="form-control" required  id="practice_contact_phone0" name="practice_contact_phone0" placeholder="Phone"  onkeypress="return isNumber(event)" />
	</div>
	<a href="javascript:void(0);"  onclick="practicecontact_option();" ><span class="addthis"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></a> </div>
  <input type="hidden" name="practicecontact_option_count" id="practicecontact_option_count" value="1" />
  <input type="hidden" name="practicecontact_option_max_count" id="practicecontact_option_max_count" value="1" />
</div>

 <div id="practicecontactoption_div"> </div> ';
						
						
							
						$dynamic_html .= ' <div class="form-group"> <input type="hidden" name="'.$get_editval['AttributeName'].'" value="'.$get_editval['ValueCoumn'].'"  /><div class="">'.$selbx_html.'</div></div>'; 
                        }
					}						
				
				else if($Get_customFields_S['element_type'] == 3 )
				{
					//date time field
					$edit_id=$this->real_escape_string($edit_id);
					$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
										
					$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_datebxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class=""><input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="'.$Get_customFields_S['AttributeName'].'" onkeypress="return isNumber(event)" readonly placeholder="click to show calendar" value="'.$get_editval['AttributeValue'].'"   /></div></div>'; 			
				}	
				else
				{
					//multi options fields
					if($Get_customFields_S['elementid'] == 3)
					{				
						//dropdown field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$selbx_html = $helper->getSelectBox_CustomFieds($this,'cusfld_selbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
											
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_selbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="">'.$selbx_html.'</div></div>'; 			
											
					}
					else if($Get_customFields_S['elementid'] == 4)
					{
						//checkbox field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$chkbx_html = $helper->getCheckBox_CustomFieds($this,'cusfld_chkbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);				
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_chkbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-5 checkbox icheck" id="custom_idtype">'.$chkbx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 6)
					{
						//radio field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."formbuilderdgsn_attrvalues where IsActive = 1 and AttributeOptionId =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$helper=$this->loadHelper('common_function');					
						$radiobx_html = $helper->getRadioBox_FormFieds('cusfld_radiobxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);	
						
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_radiobxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="" id="custom_nationality">'.$radiobx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 7)
					{
						//multi select field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$multiselbx_html = $helper->getMultiSelectBox_CustomFieds($this,'cusfld_mulselbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_mulselbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="">'.$multiselbx_html.'</div></div>'; 	
					}
					
					
										
										
				} 
								
			}

             //echo "<pre>"; print_r($dynamic_html); exit;
 			return $dynamic_html;

		}
		
	}



	function getdynamicformfields_bulk_equiry($tablename)
	{
		
		$helper=$this->loadHelper('common_function');
		
			$tablename=$this->real_escape_string($tablename);
		$str_all="select t2.*,t3.elementid,t3.elementname,t3.element_type from ".TPLPrefix."formbuilder t1 inner join ".TPLPrefix."fb_attributes t2 on t1.FormId=t2.FormId and t2.IsActive=1 inner join ".TPLPrefix."m_elements t3 on t3.elementid=t2.AttributeType and t3.IsActive=1 where t1.fromtablename=? group by t2.AttributeCode order by sortBy asc ";
		
		
	$Get_customFields=$this->get_rsltset_bind($str_all,array($tablename));	
		
		//echo"<pre>"; print_r($Get_customFields); exit;
	
          $customFields_cnt = count($Get_customFields);	
       if($customFields_cnt > 0)
        {
			$dynamic_html = '';
							   
			foreach($Get_customFields as $Get_customFields_S)
			{ 		
					
				if($Get_customFields_S['element_type'] == 1 )
				{
					//textbox, textarea field
					$edit_id=$this->real_escape_string($edit_id);

					$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
					//echo $get_editval
					if($Get_customFields_S['elementid'] == 1){
						//textbox
					   if($Get_customFields_S['AttributeName']!="quantity"){
						$onlynum ='';
						if(in_array($Get_customFields_S['AttributeId'],array('17','21','22','23','24','25','28') ) ){
							$onlynum = 'numericvalidate';
						}
						
						if(in_array($Get_customFields_S['AttributeId'],array('18','29') ) ){
							$type='email';
						}
						else{
							$type='text';
						}
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  />
						<input type="'.$type.'" class="form-control '.$onlynum.' '.$Get_customFields_S['MandatoryAttr'].'" name="'.$Get_customFields_S['AttributeName'].'" value="'.$get_editval['AttributeValue'].'" placeholder="'.$Get_customFields_S['AttributeCode'].'" /></div>'; 	
                     			
					   }								
					}
					else if($Get_customFields_S['elementid'] == 2){
						//textarea
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><textarea      placeholder="'.$Get_customFields_S['AttributeCode'].'" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="'.$Get_customFields_S['AttributeName'].'" >'.$get_editval['AttributeValue'].'</textarea></div>'; 				
					}

                    else if($Get_customFields_S['elementid'] == 8){
						//File Type 
						$accepttype =$Get_customFields_S['accept_filetype'];
						$filecount = $Get_customFields_S['numberoffile'];
						
					    $dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_txtbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /> <input type="hidden" name="actions" value="Filetype"  />
						<label class=" control-label">'.$Get_customFields_S['AttributeCode'].'</label><div class=""><input type="file" class="form-control '.$Get_customFields_S['MandatoryAttr'].' customfiledsfile" id="cusfld_txtbxVal_'.$Get_customFields_S['AttributeId'].'" name="'.$Get_customFields_S['AttributeName'].'" value="'.$get_editval['AttributeValue'].'"  accept="'.$Get_customFields_S['accept_filetype'].'"  / ></div> <div class="form-upload" id="uploadedcustomer"></div>
                        <small>(accept file type : '.$accepttype.')</small>
						</div>'; 	

                    }	

                    else if($Get_customFields_S['elementid'] == 9){
                     
                        $get_editval = $this->get_a_line("select t2.*,t1.AttributeName,t1.AttributeId,t1.FormId,t1.masterid,t1.masterdependentid,t2.defaultvalue from ".TPLPrefix."fb_attributes t1 inner join ".TPLPrefix."mastertables t2 on t1.masterid=t2.MasterId and t1.IsActive=1 where t1.IsActive = 1 and t1.AttributeId ='".$Get_customFields_S['AttributeId']."'  ");
						
						//echo "<pre>"; print_r($get_editval); exit;
						if($get_editval['masterdependentid']!=''){
							
							 $get_tablename = $this->get_a_line("select t2.tablesname,t2.ColumnName,t2.ValueCoumn,t2.displayname,t2.defaultvalue from ".TPLPrefix."fb_attributes t1 inner join ".TPLPrefix."mastertables t2 on t2.MasterId = '".$get_editval['masterdependentid']."' and t1.IsActive=1 where t1.IsActive = 1 and t1.AttributeId ='".$get_editval['AttributeId']."' ");
							 
							
							 
							//echo "<pre>"; print_r($get_tablename); exit;
							
							//$action = "onchange='onchange_function(this.value,\"".$get_tablename['tablesname']."\",\"".$get_tablename['ColumnName']."\",\"".$get_tablename['ValueCoumn']."\",\"".$get_tablename['displayname']."\",\"".$get_editval['ValueCoumn']."\")' ";
							$action ="";
						}
						else{
							$action ="";
						}
						
						if($get_editval['masterdependentid']!='' && !empty($get_editval['defaultvalue']) ){
							
						  $afterscript="  <script> document.addEventListener('DOMContentLoaded', function(event) {
							 
							onchange_function('".$get_editval['defaultvalue']."',\"".$get_tablename['tablesname']."\",\"".$get_tablename['ColumnName']."\",\"".$get_tablename['ValueCoumn']."\",\"".$get_tablename['displayname']."\",\"".$get_editval['ValueCoumn']."\");
						  }); </script> ";	
							
						}
						
						$additionalcond ='';
						if($get_tablename['tablesname']=='category'){
							$additionalcond = " and parentId!=0 ";
						}
						
						$selbx_html = $helper->getSelectBox_displaymastertable($get_editval['AttributeName'],$get_editval['ValueCoumn'],$get_editval['ColumnName'],$get_editval['tablesname'],$get_editval['defaultvalue'],$action,'',$afterscript,$additionalcond);
											
						$dynamic_html .= ' <div class="form-group"> <input type="hidden" name="'.$get_editval['AttributeName'].'[]" value="'.$get_editval['ValueCoumn'].'"  /><div class="">'.$selbx_html.'</div></div>'; 
						
						if($Get_customFields_S['AttributeName']=='sub_category'){
						
							$dynamic_html .= '<input type="TextBox" class="form-control number required" name="quantity[]" value="" placeholder="Quantity" /></div>'; 
						
						
						
						$dynamic_html .= ' 	<a href="javascript:void(0);" onclick="practicecontact_option();" ><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						
								<a class="rm" href=""><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
							<input type="hidden" name="practicecontact_option_count" id="practicecontact_option_count" value="1" />	
							<div id="practicecontactoption_div"> </div>
							
							
								';
						}						
						
						

                        }
					}						
				
				else if($Get_customFields_S['element_type'] == 3 )
				{
					//date time field
					$edit_id=$this->real_escape_string($edit_id);
					$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl1 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
										
					$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_datebxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class=""><input type="text" class="form-control '.$Get_customFields_S['MandatoryAttr'].'" name="'.$Get_customFields_S['AttributeName'].'" onkeypress="return isNumber(event)" readonly placeholder="click to show calendar" value="'.$get_editval['AttributeValue'].'"   /></div></div>'; 			
				}	
				else
				{
					//multi options fields
					if($Get_customFields_S['elementid'] == 3)
					{		
						//print_r($Get_customFields_S); die();
						//dropdown field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl2 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$selbx_html = $helper->getSelectBox_CustomFieds('cusfld_selbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
											
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_selbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><div class="">'.$selbx_html.'</div></div>'; 	

						if($Get_customFields_S['AttributeName']=="purpose")
						{
							$dynamic_html .= '<br/>'; 	

						}			
											
					}
					else if($Get_customFields_S['elementid'] == 4)
					{
						//checkbox field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$chkbx_html = $helper->getCheckBox_CustomFieds($this,'cusfld_chkbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);				
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_chkbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="col-sm-5 checkbox icheck" id="custom_idtype">'.$chkbx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 6)
					{
						//radio field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."formbuilderdgsn_attrvalues where IsActive = 1 and AttributeOptionId =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
							
						$radiobx_html = $helper->getRadioBox_FormFieds('cusfld_radiobxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);	
						
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_radiobxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="" id="custom_nationality">'.$radiobx_html.'</div></div>'; 	
					}
					else if($Get_customFields_S['elementid'] == 7)
					{
						//multi select field
						$edit_id=$this->real_escape_string($edit_id);
						$get_editval = $this->get_a_line_bind("select * from ".TPLPrefix."cus_attribute_tbl3 where IsActive = 1 and customer_id =? and AttributeId ='".$Get_customFields_S['AttributeId']."' ",array($edit_id));
						
						$multiselbx_html = $helper->getMultiSelectBox_CustomFieds($this,'cusfld_mulselbxVal_',$Get_customFields_S['MandatoryAttr'],$Get_customFields_S['AttributeId'],$get_editval['AttributeValue']);
						$dynamic_html .= '<div class="form-group"> <input type="hidden" name="cusfld_mulselbxIDS[]" value="'.$Get_customFields_S['AttributeId'].'"  /><label class=" control-label">'.$Get_customFields_S['AttributeName'].'</label><div class="">'.$multiselbx_html.'</div></div>'; 	
					}
					
					
										
										
				} 
								
			}

             //echo "<pre>"; print_r($dynamic_html); exit;
 			return $dynamic_html;

		}
		
	}

	function dynamicformbuilder($filters) //insert function 
	{
		//print_r($_FILES);
		echo "<pre>"; print_r($_REQUEST); exit;
		$filters['tablename']=$this->real_escape_string($filters['tablename']);
		$str_all="select t2.*,t3.elementid,t3.elementname,t3.element_type from ".TPLPrefix."formbuilder t1 inner join ".TPLPrefix."fb_attributes t2 on t1.FormId=t2.FormId and t2.IsActive=1 inner join ".TPLPrefix."m_elements t3 on t3.elementid=t2.AttributeType and t3.IsActive=1 where t1.fromtablename=? group by t2.AttributeCode order by sortBy asc ";
		
		//echo $str_all; exit;
		$today = date("Y-m-d H:i:s");
	    $Get_formFields=$this->get_rsltset_bind($str_all,array($filters['tablename']));	
		
		//echo"<pre>"; print_r($Get_customFields); exit;
		$key = array();
		$value = array();
		$cnt=1;
		//echo "<pre>"; print_r($Get_formFields); exit;
		foreach($Get_formFields as $Get_formvalue){

			if($Get_formvalue['element_type'] == 1 ){
					
				foreach($filters as $formkey => $formvalue){
					
					//text
					if($Get_formvalue['elementid'] == 1){
						
						if($Get_formvalue['AttributeName'] == $formkey){
							
                            $key[]= $Get_formvalue['AttributeName'];
							$formvalue=$this->real_escape_string($formvalue);
                            $value[] = $formvalue;					
						}
					}
					
					//text area
					if($Get_formvalue['elementid'] == 2){
						
						if($Get_formvalue['AttributeName'] == $formkey){
							
                            $key[]= $Get_formvalue['AttributeName'];
							$formvalue=$this->real_escape_string($formvalue);
                            $value[] = $formvalue;					
						}
						
					}

					//mastertable
					if($Get_formvalue['elementid'] == 9){
						
						if($Get_formvalue['AttributeName'] == $formkey){
							
                            $key[]= $Get_formvalue['AttributeName'];
							$formvalue=$this->real_escape_string($formvalue);
                            $value[] = $formvalue;					
						}
						
					}
					
					
				}
				
				//file
			    if($Get_formvalue['elementid'] == 8){
				    $filename = $Get_formvalue['AttributeName'];
						  
							
					if(isset($_FILES[$filename])){
						
						$file_info = getimagesize($_FILES[$filename]['tmp_name']);
					    $file_mime = explode('/',$file_info['mime']);				
					    if(!in_array($file_mime[1],array('jpg','jpeg','gif','png') ) ){
							echo json_encode(array("rslt"=>"2"));
							exit();
					    }	
					
						$target_dir	= "uploads/fb_uploadfolder/";
									
						$target_file_t = $target_dir . basename($_FILES[$filename]["name"]);	
						$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
						$filenamegst = $filters['tablename'].'_'.time().rand(0,9).$cnt.".".$imageFileType;
						$target_file = $target_dir . $filenamegst;	
						move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file);
					}

					$key[]= $Get_formvalue['AttributeName'];
					$value[] = $filenamegst;					
			    }

			}elseif($Get_formvalue['element_type'] == 2 ){
					if($Get_formvalue['elementid'] == 6){
						
						if($Get_formvalue['AttributeName'] == $formkey){
							
                            $key[]= $Get_formvalue['AttributeName'];
							$formvalue=$this->real_escape_string($formvalue);
                            $value[] = $formvalue;					
						}
						
					}
			}
         $cnt++;
		}

		$arraykey = implode(',',$key);
		$Realescape = array();
		foreach($value as $data)
		{
			$Realescape[] = $this->getRealescape($data);
		}
		//print_r($Realescape); exit;
		$arrayvalue = "'".implode("','",$Realescape)."'";
		
		$strQry = "insert into ".TPLPrefix."fb_".$filters['tablename']." (".$arraykey.",IsActive,UserId,Createddate,Modifieddate)values(".$arrayvalue.",'1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."')";
       // echo $strQry; exit;
	    $rsltMenu=$this->insert($strQry);
		 $InsertId = $this->lastInsertId();
		 
		require_once (__DIR__.'/mailsend.php');
		dealersmailsendfunction($this,$filters['tablename'],$InsertId);
		echo json_encode(array("rslt"=>1));
	}
	
	
	function dynamicfieldappend($filters){
		
		 $list = "select ".$filters['ColumnId']." AS Id,".$filters['ColumnName']." AS Name from ".TPLPrefix.$filters['tablename']."  where ".$filters['conid']." = '".$filters['id']."' and IsActive = 1 " ;
		
        $res =$this->get_rsltset($list);
		
		//echo "<pre>"; print_r($res); exit;
		 
		 
	    $rslt_html="<option value=''> Select </option>";
        foreach($res as $each){
        $rslt_html .="<option value=".$each['Id']." >" .addslashes($each['Name'])." </option>";
		
        }
	    echo json_encode(array("rslt"=>$rslt_html)); //status update success
		
	}
	
	
	function common_metatag($case,$id=''){
		$id=$this->real_escape_string($id);
		switch($case)
		{
			case 'config':
			
                $list = "select storeId,max(case when uniCode='storeMetaKey' then value else '' end ) as keyword,max(case when uniCode='storeMetaDesc' then value else '' end ) as description,max(case when uniCode='storeMetaTitle' then value else '' end ) as title from ".TPLPrefix."configuration group by storeId " ;

                $res =$this->get_a_line($list);
		
		        //echo "<pre>"; print_r($res); exit;  
				  
            break;	
            
            case 'category':
			
                $list = "select categoryMetatitle,categoryMetadesc,categoryMetakey from ".TPLPrefix."category  where categoryID=? and IsActive = 1 " ;
		
                $res =$this->get_a_line_bind($list,array($id));
		
		        //echo "<pre>"; print_r($res); print_r($this); exit;			
			       

            break;
			
			case 'product':
			
                $list = "select metaname,metadescription,metakeyword from ".TPLPrefix."product  where product_url=? and IsActive = 1 " ;
		
                $res =$this->get_a_line_bind($list,array($id));
		
		        //echo "<pre>"; print_r($res); exit;			

            break;
              			
		}
		
		return $res;
		
	}
	
	function getcontactformdetails($cusid)
	{
		$cusid=$this->real_escape_string($cusid);
		$list = "select * from ".TPLPrefix."customers  where customer_id=? and IsActive = 1 " ;
		
        $res =$this->get_a_line_bind($list,array($cusid));
		return $res;
	}
	
	function businesscustomer_details()
	{
		$list = "select * from ".TPLPrefix."customers  where customer_id='".$_SESSION['Cus_ID']."' and customer_group_id='2' and IsActive = 1 " ;
		//echo $list;
        $res =$this->get_a_line($list);
		return $res;
		
	}

	function attributemaster_list($attributeId)
	{
		  $str_all="select a.*,d.dropdown_values,d.dropdown_images,d.dropdown_unit,d.sortingOrder,d.dropdown_id,d.isactive as IsActive  from ".TPLPrefix."m_attributes a  inner join ".TPLPrefix."dropdown d on a.attributeId=d.attributeId and d.isactive <> 2 where  a.attributeId ='".$attributeId."'  and a.IsActive <> 2 ";
			
          $res =$this->get_rsltset($str_all);
		return $res;
		
	}
	
	function testimoniallist(){
		  $selectQuery = "select t.customername,t.testimonialcontent,c.customerphoto from ".TPLPrefix."testimonial t inner join ".TPLPrefix."customers c on c.customer_id = t.customer_id where t.IsActive = 1 and  t.lang_id = '".$_SESSION['lang_id']."' group by t.testimonialid ";
		$res =$this->get_rsltset($selectQuery);
		return $res;
	}
	
	function productcatalogueEnquiry($filters)
	{ 
	
	    $today = date("Y-m-d H:i:s");
	 	
		 $strQry ="INSERT INTO  ".TPLPrefix."catalogue_enquiry (firstname, emailid, contactno, additionalmsg, companyname, typeofbusinessid, purchasereasonid, paymentmethodid, countryid, purchasebefore, deliverydate, IsActive, userid, createdate, modifieddate) VALUES ('".$this->getRealescape($filters['firstname'])."','".$this->getRealescape($filters['emailid'])."','".$this->getRealescape($filters['contactno'])."','".$this->getRealescape($filters['additionalmsg'])."','".$this->getRealescape($filters['companyname'])."','".$this->getRealescape($filters['typeofbusinessid'])."','".$this->getRealescape($filters['purchasereasonid'])."','".$this->getRealescape($filters['paymentmethodid'])."','".$this->getRealescape($filters['countryid'])."','".$this->getRealescape($filters['purchasebefore'])."','".$this->getRealescape($filters['deliverydate'])."','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');";
		$resulst=$this->insert($strQry);
	
        $insert_cusId = $this->lastInsertId();	
       if($resulst){  		 
		echo json_encode(array("rslt"=>1,"cid"=>$insert_cusId));   
	   }
	   else{
		echo json_encode(array("rslt"=>2));  
        exit;		
	   }
		
	}
	
	function categoryDetail(){
		
	}
}
?>